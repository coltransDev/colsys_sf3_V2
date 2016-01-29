<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Andres Botero
 * @version    SVN: $Id: components.class.php 9301 2008-05-27 01:08:46Z abotero $
 */
class widgets5Components extends sfComponents {

    /**
     * Muestra un select con las modalidades
     */

    
    public function executeWgDocumentos( ){
        
        //$this->idsserie = ($this->getRequestParameter("serie")!="")?$this->getRequestParameter("serie"):"0";
        /*
        $q = Doctrine::getTable("TipoDocumental")
                    ->createQuery("t")
                    ->select("*")                            
                    ->where("ca_idsserie = ?", $this->idsserie )
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
        
                    //echo $q->getSqlQuery();
                    $tipoDocs=$q->execute();
        $this->tipoDocs=array();
        foreach($tipoDocs as $t)
        {
            $this->tipoDocs[]=array("id"=>$t["ca_iddocumental"],"name"=>$t["ca_documento"]);                    
        }
        //print_r($this->tipoDocs);
         * 
         */
        $q = Doctrine::getTable("TipoDocumental")
                    ->createQuery("t")
                    ->select("*")
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
        
                    //echo $q->getSqlQuery();
                    $tipoDocs=$q->execute();
        $this->data=array();
        foreach($tipoDocs as $t)
        {
            $this->data[]=array("id"=>$t["ca_iddocumental"],"name"=>  utf8_encode($t["ca_documento"]),"idsserie"=>$t["ca_idsserie"]  );
        }
    }
    
    public function executeWgEmpresas( ){
         
        $this->data = array();
        $empresas = Doctrine::getTable("Empresa")
                              ->createQuery("e")
                              ->select("e.*")
                              ->where("e.ca_activo=TRUE ")
                              ->execute();
        
        foreach( $empresas as $e ){
            $this->data[]=array("id"=>$e->getCaIdempresa(),"name"=>$e->getCaNombre());
        }
        
    }
    
    
    public function executeWgTipoComprobante( ){
        $user = $this->getUser();
        
        $this->tipoComprobante=array('F','C');        
        
        $q = Doctrine::getTable("InoTipoComprobante")
                ->createQuery("t")
                ->select("t.ca_idtipo, t.ca_tipo, t.ca_comprobante, t.ca_titulo, t.ca_idempresa")
                //->innerJoin("t.IdsSucursal s")
                //->innerJoin("s.Ids i")
                //->innerJoin("s.Empresa e")                
                ->whereIn("t.ca_tipo", $this->tipoComprobante)
                ->addwhere("ca_idempresa=?", array($user->getIdempresa()))
                ->addOrderBy("t.ca_tipo, t.ca_comprobante");

        $tipos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->data = array();
        foreach ($tipos as $tipo) {
            $tipoStr = "";
            if (!isset($this->empresa)) {
                //$tipoStr .= $tipo["e_ca_sigla"] . " » ";
            }
            $tipoStr .= $tipo["t_ca_tipo"] . "-" . str_pad($tipo["t_ca_comprobante"], 2, "0", STR_PAD_LEFT) . " " . $tipo["t_ca_titulo"];
            $this->data[] = array("id" => $tipo["t_ca_idtipo"], "name" => utf8_encode($tipoStr), "idempresa"=>$tipo["t_ca_idempresa"]);
        }

        //$this->tipos = array("root" => $tiposArray, "total" => count($tiposArray));
    }
    
    public function executeWgReporte( ){
        
    }
    
    public function executeWgCliente( ){
        
    }
    
    public function executeWgTercero( ){
        
    }
    
    
    public function executeWgBodega( ){
        
    }
    
    public function executeWgDeducible( ){
        $this->data = array();
        /*$user = $this->getUser();
        $datos = ParametroTable::retrieveByCaso("CU236" , user->getIdempresa() );
        */
        $deducciones = Doctrine_Query::create()
                ->select("*")
                ->from("Deduccion c")
                ->addWhere("c.ca_habilitado = ? AND ca_impoexpo=? AND ca_transporte=?", array(true,$this->impoexpo,$this->transporte))
                ->addOrderBy("ca_deduccion")
                ->execute();
        
        foreach( $deducciones as $d ){
            $this->data[]=array("id"=>$d->getCaIddeduccion(),"name"=>utf8_encode($d->getCaDeduccion()));
        }
    }
    
    public function executeWgParametros() {
        $this->data = array();
        
        $casos = explode(",", $this->caso_uso);
        $idvalor = explode(",", $this->idvalor);
        
        foreach ($casos as $k=>$caso) {
            $datos = ParametroTable::retrieveByCaso($caso);
            if(!isset($idvalor[$k]))
            {
                $id=utf8_encode($dato->getCaIdentificacion());
            }
            else if($idvalor[$k]=="id")
            {
                $id=utf8_encode($dato->getCaIdentificacion());
            }
            else if($idvalor[$k]=="valor")
            {
                $id=utf8_encode($dato->getCaValor());
            }
            else if($idvalor[$k]=="valor2")
            {
                $id=utf8_encode($dato->getCaValor2());
            }
            //$id=(!isset($idvalor[$k]))?utf8_encode($dato->getCaIdentificacion()):($id[$k]=="")
            foreach ($datos as $dato) {                
                $this->data[] = array("id" => $id , "name" => utf8_encode($dato->getCaValor()), "caso_uso" => $dato->getCaCasouso());
                //$this->data[] = array("id" => $id , "name" => ($dato->getCaValor()), "caso_uso" => $dato->getCaCasouso());
            }
        }        
        //print_r($this->data);
    }
    
}
?>
