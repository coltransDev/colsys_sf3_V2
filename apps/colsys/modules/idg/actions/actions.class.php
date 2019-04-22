<?php

/**
 * idg actions.
 *
 * @package    symfony
 * @subpackage idg
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class idgActions extends sfActions
{
    
    public function executeAdminIdg($request)
    {

    }

    public function executeDatosPanelIdg($request) {
        $rows = array();
        $rows = Doctrine::getTable("Idg")
                ->createQuery("i")
                ->select("i.ca_idg as idreg,i.*,d.ca_nombre")
                ->innerJoin("i.Departamento d")
                ->addOrderBy("i.ca_nombre")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach($rows as $key=>$r)
        {
            $rows[$key]["d_ca_nombre"]=utf8_encode($r["d_ca_nombre"]);
            $rows[$key]["i_ca_nombre"]=utf8_encode($r["i_ca_nombre"]);
            $rows[$key]["i_ca_impoexpo"]=utf8_encode($r["i_ca_impoexpo"]);
            $rows[$key]["i_ca_transporte"]=utf8_encode($r["i_ca_transporte"]);            
            $rows[$key]["i_ca_datos"]=utf8_encode($r["i_ca_datos"]);            
        }
        
         $rows[] = array("ca_departamento" => "+", "ca_nombre" => "", "orden" => "Z");
         
         //print_r($rows);
         //exit();

        $this->responseArray = array("success" => true, "total" => count($rows), "root" => $rows);

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosPanelConfig($request) {
        $rows = array();
        
        $ca_idg = $request->getParameter("ca_idg");
        $rows = Doctrine::getTable("IdgConfig")
                ->createQuery("c")
                ->select("c.ca_idgconfig as idreg ,c.*,s.ca_nombre")
                ->innerJoin("c.Sucursal s")
                ->where("c.ca_idg=? and ca_fcheliminado IS NULL",$ca_idg)
                ->addOrderBy("c.ca_fchini")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach($rows as $key=>$r)
        {
            $rows[$key]["s_ca_nombre"]=utf8_encode($r["s_ca_nombre"]);
        }
         //$rows[] = array("ca_sucursal" => "+", "ca_lim1" => "", "orden" => "Z");
         
        //echo "<pre>";print_r($rows);echo "</pre>";

        $this->responseArray = array("success" => true, "total" => count($rows), "root" => $rows);

        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarIdg($request)
    {
        $idreg=array();
        $id=array();
        $errorInfo="";
        $datos = $request->getParameter("datos");
        $ididg= $request->getParameter("ididg");
        
        $idgs = json_decode($datos);
        //print_r($idgs);
       try
       {
            foreach($idgs as $idg)
            {
                if(!$idg->iddepartamento)
                    continue;
                if(!$idg->nombre)
                    continue;

                $obj = Doctrine::getTable("Idg")->find($idg->idreg);

                if( !$obj ){
                    $obj = new Idg();
                }            
                $obj->setCaIddepartamento($idg->iddepartamento);
                $obj->setCaNombre($idg->nombre);
                $obj->setCaTipo($idg->tipo);
                $obj->save();
                $idreg[]=$obj->getCaIdg();
                $id[]=$idg->id;
            }
        }
        catch(Exception $e)
        {
            $errorInfo.="Error en item ".utf8_encode($t->item).": ".$error." ".utf8_encode($e->getMessage())."<br>";
        }
        $this->responseArray = array("errorInfo"=>$errorInfo,"success" => true,"id"=>  implode(",", $id),"idreg"=>  implode(",", $idreg) );

        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarConfig($request)
    {
        $idreg=array();
        $id=array();
        $errorInfo="";
        $datos = $request->getParameter("datos");
        $ididg= $request->getParameter("ididg");
        
        $idgs = json_decode($datos);
        try
        {
            foreach($idgs as $idg)
            {
                if(!$idg->idsucursal)
                    continue;
                if(!$idg->lim1)
                    continue;

                $obj = Doctrine::getTable("IdgConfig")->find($idg->idreg);

                if( !$obj ){
                    $obj = new IdgConfig();
                }

                $obj->setCaIdg($ididg);
                $obj->setCaIdsucursal($idg->idsucursal);
                $obj->setCaLim1($idg->lim1);
                $obj->setCaFchini($idg->fechaini);
                $obj->setCaFchfin($idg->fechafin);
                $obj->setCaTiempo($idg->tiempo);
                $obj->save();
                $idreg[]=$obj->getCaIdgconfig();
                $id[]=$idg->id;
            }
        }
        catch(Exception $e)
        {
            $errorInfo.="Error en item ".utf8_encode($t->item).": ".$error." ".utf8_encode($e->getMessage())."<br>";
        }
        $this->responseArray = array("errorInfo"=>$errorInfo,"success" => true,"id"=>  implode(",", $id),"idreg"=>  implode(",", $idreg) );

        $this->setTemplate("responseTemplate");
    }
    
    public function executeEliminarIdg($request)
    {
        
        
    }
    
    public function executeEliminarIdgconfig($request)
    {
        try{
            $user = $this->getUser();
            $idconfig=$request->getParameter("idconfig");
            $config = Doctrine::getTable("IdgConfig")->find( $idconfig );
            
            $config->setCaFcheliminado(date("Y-m-d H:i:s"));
            $config->setCaUsueliminado($user->getUserId());
            $config->save();
            $this->responseArray = array("success" => true);
       }
       catch(Exception $e)
       {
           $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
       }
       $this->setTemplate("responseTemplate");
        
    }
    
    public function executeCalcularNuevoIdg($request){
        
        print_r(json_decode($request->getParameter("idcomprobante"),1));
        exit();
        try{
            $idcomprobante = $request->getParameter("idcomprobante");
            $tipo = $request->getParameter("tipo");
            
            
            $options = array();                        
            $options["idg_sigla"] = $request->getParameter("idg");
            $options["fecha"] = date("Y-m-d");;            
            $options["impoexpo"] = NULL;
            $options["transporte"] = NULL;
            
            if($idcomprobante){                
                //$comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                $comprobantes = Doctrine::getTable("InoComprobante")
                    ->createQuery("m")
                    ->whereIn("m.ca_idcomprobante", json_decode($idcomprobante))                    
                    ->execute();                
                
                $idhouse = $comprobante->getCaIdhouse()?$comprobante->getCaIdhouse():0;
                
                if($idhouse >0){
                    $house = Doctrine::getTable("InoHouse")->find($idhouse);
                    $master = Doctrine::getTable("InoMaster")->find($house->getCaIdmaster());
                    $idcliente = $house->getCliente()->getCaIdcliente();
                    
                    $options["impoexpo"] = $master->getCaImpoexpo();
                    $options["transporte"] = $master->getCaTransporte();
                    
                    $fecha = $comprobante->getCaFchcomprobante();
                    $fchllegada = $master->getCaFchllegada();                    
                    
                    if($house->getCliente()->getCaVendedor() != null && $house->getCliente()->getCaVendedor() != "")
                        $idsucursal = $house->getCliente()->getUsuario()->getSucursal()->getCaIdsucursal();
                    else
                        $idsucursal = $house->getUsuCreado()->getSucursal()->getCaIdsucursal();
                }else{
                    if($tipo == "calculo")
                        $this->responseArray = array("success" => true, "txt"=>"No requiere calculo de indicador");
                    else if($tipo == "ino")
                        return array("val"=>0, "estado"=>-1);
}
                
            }
            
            //echo 'Idg:'.$idg.' Sigla:'.$sigla.' Fecha:'.$fecha.' Vendedor:'.$vendedor.' Idcliente:'.$idcliente.' Idsucursal:'.$idsucursal.' Impoexpo:'.$impoexpo.' Transporte'.$transporte;
            //exit();
            
            $idg = IdgTable::getNuevoIndicador($options);
            
            
              
            if(is_a($object, $idg)){            
                $options = array();
                $num_dias = intval($idg->getCaLim1());

                $festivos = Doctrine::getTable("Festivo")->createQuery("f")->select("ca_fchfestivo")->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();                
                $dif_mem = TimeUtils::workDiff($festivos, $fchllegada, $fecha);//     workDiff($festivos, $fch_llegada, $fecha);
                if ($dif_mem > $num_dias) {                    
                    $cumple = 0;
                }else{                    
                    $cumple = 1;
                }
                
                $options["idg_sigla"] = $idg_sigla;
                $options["estado"] = $cumple;
                $options["indicador"] = $num_dias;
                $options["key"] = $idcomprobante;
                $options["value"] = $idcomprobante;
                $options["tabla"] = "InoComprobante";                
                
                if($tipo == "calculo"){
                    $registro = IdgTable::registrarIdg($options);
                    
                    if($registro["success"]){
                        $txt = "Indicador registrado correctamente: ".$num_dias;
                    }else{
                        $txt = "Error al registrar indicador: ".$registro["errorInfo"];
                    }                    
                    $this->responseArray = array("success" => true, "dif_mem"=>$dif_mem, "num_dias"=>$num_dias, "txt"=>$txt, "consecutivo"=>$registro["consecutivo"]);
                }else if($tipo == "ino"){
                    return array("val"=>$dif_mem, "estado"=>$cumple);
                }
            }else{
                if($tipo == "calculo")
                    $this->responseArray = array("success" => false, "txt"=> utf8_encode ($idg));
                else if($tipo == "ino")
                    return array("val"=>0, "estado"=>-1);
            }
        }catch(Exception $e){
            if($tipo == "calculo")
                $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
            else if($tipo == "ino")
                return array("val"=>0, "estado"=>-1);
        }
        $this->setTemplate("responseTemplate");
    }
    
    
}
