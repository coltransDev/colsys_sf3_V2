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
        }
        
         $rows[] = array("ca_departamento" => "+", "ca_nombre" => "", "orden" => "Z");

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
                ->where("c.ca_idg=?",$ca_idg)
                ->addOrderBy("c.ca_idgconfig")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
        foreach($rows as $key=>$r)
        {
            $rows[$key]["s_ca_nombre"]=utf8_encode($r["s_ca_nombre"]);
        }
         $rows[] = array("ca_sucursal" => "+", "ca_lim1" => "", "orden" => "Z");

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
            $idconfig=$request->getParameter("idconfig");
            $config = Doctrine::getTable("IdgConfig")->find( $idconfig );
            $config->delete();
            $this->responseArray = array("success" => true);
       }
       catch(Exception $e)
       {
           $this->responseArray = array("success" => false,"errorInfo"=>$e->getMessage());
       }
       $this->setTemplate("responseTemplate");
        
    }
    
}
