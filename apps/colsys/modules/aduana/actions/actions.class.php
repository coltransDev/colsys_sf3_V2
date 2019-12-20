<?php

/**
 * aduana actions.
 *
 * @package    symfony
 * @subpackage aduana
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aduanaActions extends sfActions {
    
    const RUTINA_EXPOADUANA = 225;

    public function executeInoAduanaExpoExt5(sfWebRequest $request){
        $this->permisos = array();

        $user = $this->getUser();

        $permisosRutinas["expoaduana"] = $user->getControlAcceso(self::RUTINA_EXPOADUANA);
        
        $tipopermisos = 
                array('Consulta' => 0, 'Crear' => 1, 'Abrir/Cerrar' => 2, 'Auditoría' => 3);

        foreach ($permisosRutinas as $k => $p) {
            foreach ($tipopermisos as $index => $tp) {
                $this->permisos[utf8_encode($index)] = isset($permisosRutinas[$k][$tp]) ? true : false;
            }
        }        
    }
    
    public function executeGuardarReferenciaAduana(sfWebRequest $request){
        $conn = Doctrine::getTable("InoMaestraAdu")->getConnection();        
        $conn->beginTransaction();
        try 
        {

            $idreferencia = $request->getParameter("comboReferencia");
            
            $referencia = Doctrine::getTable("InoMaestraAdu")->find($idreferencia);
            
            if($referencia){
                
                $datos = json_decode(utf8_encode($referencia->getCaDatos()));
                $idreporte = $request->getParameter("comboReporte");                
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);                
                $repexpo = $reporte->getRepexpo();
                
                if($reporte->getCaConsecutivo() != $datos->consecutivo){
                    $q = new Doctrine_RawSql();

                    $q->select("{adu.ca_referencia}");
                    $q->from("tb_brk_maestra adu
                            inner join (
                                SELECT ca_referencia, case when count(ca_datos->'idreporte') >0 then true else false end
                                from tb_brk_maestra
                                where (ca_datos->'consecutivo')::text = '\"".$reporte->getCaConsecutivo()."\"' group by ca_referencia) v ON v.ca_referencia = adu.ca_referencia");

                    $q->limit(1);
                    $q->addComponent('adu', 'InoMaestraAdu adu');

                    //                echo $q->getSqlQuery();
                    //                exit;
                    //                
                    $refs = $q->execute();
                }
                
                if(count($refs) == 0){                
                    
                    $datos->agencia = $request->getParameter("agenciaad");
                    $datos->idg = $request->getParameter("aplicaidg");
                    $datos->modalidad = $request->getParameter("ca_modalidad");
                    $datos->idreporte = $idreporte;
                    $datos->consecutivo = $reporte->getCaConsecutivo();
                    $datos->impoexpo = utf8_encode($reporte->getCaImpoexpo());
                    $referencia->setCaTransporte(utf8_decode($request->getParameter("fmTransporte")));
                    $referencia->setCaDatos(json_encode($datos));
                    $referencia->save($conn);
                    
                    $repexpo->setCaRefaduana($referencia->getCaReferencia());
                    $repexpo->save($conn);
                    
                    $conn->commit();
                    $this->responseArray = array("success"=>true, "msg"=>utf8_decode("Los datos de la referencia han sido guardados correctamente"));
                }else{
                    $this->responseArray = array("success"=>false, "msg"=> utf8_encode("No es posible guardar. El reporte ya fué usado en otra referencia. ".$refs[0]->getCaReferencia()));
                }
            }else{
                $this->responseArray = array("success"=>false, "msg"=> utf8_encode("No se encontró la referencia seleccionada"));
            }
            
            
        }catch(Exception $e){
            $conn->rollback();
            $this->responseArray = array("success"=>false, "msg"=> utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }
    
//    public function executeDatosReferenciaAduana(sfWebRequest $request)
//    {   
//        $idreferencia = $request->getParameter("idreferencia");
//        $referencia = Doctrine::getTable("InoMaestraAdu")->find($idreferencia);
//        
//        $datos = json_decode(utf8_encode($referencia->getCaDatos()));
//        $data["idagencia"] = $datos->idagencia;
//        $data["aplicaidg"] = $datos->aplicaidg;
//        $data["id_modalidad"] = $datos->modalidad;
//        if ($datos->modalidad) {
//            $data["ca_modalidad"] = utf8_encode($datomod[0]->getCaValor());
//        } 
//        if (is_numeric($datos->idlinea)) {
//            $agencia = Doctrine::getTable("Ids")->find(utf8_encode($datos->idlinea));
//            if($agencia)
//                $data["agencia"] = utf8_encode($agencia->getCaNombre());
//        }
//        
//        $this->responseArray = array("success" => true, "data" => $data);
//        $this->setTemplate("responseTemplate");
//    }
    


    
}