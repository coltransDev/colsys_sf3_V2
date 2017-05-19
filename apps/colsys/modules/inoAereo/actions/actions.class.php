<?php

/**
 * inoAereo actions.
 *
 * @package    symfony
 * @subpackage inoAereo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inoAereoActions extends sfActions
{
    const RUTINA = 6;
    
    /**
	* 
	*/
	public function getNivel(){		
        
		
		$this->user = $this->getUser();
		
		$this->nivel = $this->getUser()->getNivelAcceso( inoAereoActions::RUTINA );
		
		if( $this->nivel<0 ){            
			$this->redirect("users/noAccess");
		}
        
        return $this->nivel;
        
	}
    
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request){
        
    }
    
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeFormMaster(sfWebRequest $request){
        $nivel = $this->getNivel();
        
        if( $nivel<=0 ){
			$this->redirect("users/noAccess");
		}
        if( $request->getParameter("referencia") ){
            $this->referencia = Doctrine::getTable("InoMaestraAir")->find( $request->getParameter("referencia") );
            $this->forward404Unless($this->referencia);
        }else{        
            $this->referencia = new InoMaestraAir();
        }
        $this->id = null;
    }
    
    
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarMaster(sfWebRequest $request) {
        $errors = array();

        if (count($errors) > 0) {
            $this->responseArray = array("success" => false, "errors" => $errors);
        }

        try {
            $impoexpo = utf8_decode($request->getParameter("impoexpo"));
            $transporte = utf8_decode($request->getParameter("transporte"));
            $modalidad = utf8_decode($request->getParameter("modalidad"));
            $idorigen = $request->getParameter("idorigen");
            $iddestino = $request->getParameter("iddestino");
            $fchreferencia = $request->getParameter("fchreferencia");
            $fchreferenciaTm = strtotime($fchreferencia);

            $referencia=$request->getParameter("referencia");
            
            if( $referencia ){                
                $ino = Doctrine::getTable("InoMaestraAir")->find($referencia);
                $this->forward404Unless( $ino );
            }else{
                $ino = new InoMaestraAir();
                //Se trae el numero del INO Nuevo
                $numRef = InoMaestraAirTable::getNumReferencia($impoexpo, $transporte, $modalidad, $idorigen, $iddestino, date("m", $fchreferenciaTm), date("Y", $fchreferenciaTm));
                $ino->setCaReferencia($numRef);
                $ino->setCaImpoexpo($impoexpo);            
                $ino->setCaModalidad($modalidad);
            }
                        
            $ino->setCaFchreferencia($fchreferencia);
            $ino->setCaOrigen($idorigen);
            $ino->setCaDestino($iddestino);
            $ino->setCaIdlinea($request->getParameter("idlinea")?$request->getParameter("idlinea"):0);
            $ino->setCaIdagente($request->getParameter("idagente"));

            $ino->setCaMawb($request->getParameter("ca_master"));
            //$ino->setCaFchmaster($request->getParameter("ca_fchmaster"));

            $ino->setCaFchpreaviso($request->getParameter("ca_fchsalida"));
            $ino->setCaFchllegada($request->getParameter("ca_fchllegada"));
            
            //$ino->setCaIdnave( utf8_decode($request->getParameter("ca_idnave")) );
            $ino->setCaPiezas( $request->getParameter("ca_piezas") );
            $ino->setCaPeso( $request->getParameter("ca_peso") );
            $ino->setCaPesovolumen( $request->getParameter("ca_volumen") );
            $ino->setCaObservaciones( utf8_decode($request->getParameter("ca_observaciones")) );
            
            
            
            $ino->save();
            
           
            $this->responseArray = array("success" => true, "referencia" => $ino->getCaReferencia()  );
            
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage().$numRef.$iddestino);
        }
        $this->setTemplate("responseTemplate");
    }
    /**
     *
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosMaster(sfWebRequest $request) {        
        $referencia = $request->getParameter("referencia");
        $this->forward404Unless($referencia);

        $ino = Doctrine::getTable("InoMaestraAir")->find($referencia);
        $this->forward404Unless($ino);
     
        try {
            $data["referencia"]=$ino->getCaReferencia();
            $data["impoexpo"]=utf8_encode($ino->getCaImpoexpo());
            //$data["transporte"]=utf8_encode($ino->getCaTransporte());
            $data["modalidad"]=$ino->getCaModalidad();
            $data["fchreferencia"]=$ino->getCaFchreferencia();
            $data["idorigen"]=$ino->getCaOrigen();
            $data["iddestino"]=$ino->getCaDestino();

            $data["idlinea"]=$ino->getCaIdlinea();
            $data["linea"]=utf8_encode($ino->getIdsProveedor()->getIds()->getCaNombre());

            $data["idagente"]=$ino->getCaIdagente();
            

            $data["ca_master"]=$ino->getCaMawb();
            //$data["ca_fchmaster"]=$ino->getCaFchmaster();

            //$data["ca_idnave"]=utf8_encode($ino->getCaIdnave());
            $data["ca_fchsalida"]=$ino->getCaFchpreaviso();
            $data["ca_fchllegada"]=$ino->getCaFchllegada();
            
            $data["ca_piezas"]=$ino->getCaPiezas();
            $data["ca_peso"]=$ino->getCaPeso();
            $data["ca_volumen"]=$ino->getCaPesovolumen();
            
            $data["ca_observaciones"]=utf8_encode($ino->getCaObservaciones());
            
            $this->responseArray = array("success" => true,"data"=>$data);
        } catch (Exception $e) {
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeDatosReporteCarga(sfWebRequest $request) {

        $data=array();
        $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte")  );

        $prov=$reporte->getProveedores();
        if(count($prov)>0)
        {
            $data["idproveedor"]=$prov[0]->getCaIdtercero();
            $data["proveedor"]=$prov[0]->getCaNombre();
        }
        
        $data["origen"]=$reporte->getDocTransporte();

        $data["impoexpo"]=utf8_encode($reporte->getCaImpoexpo());
        $data["transporte"]=utf8_encode($reporte->getCaTransporte());
        $data["modalidad"]=$reporte->getCaModalidad();
        $data["origen"]=$reporte->getCaOrigen();
        $data["destino"]=$reporte->getCaDestino();
        $data["idlinea"]=$reporte->getCaIdlinea();
        $data["linea"]=utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());
        
        $data["idagente"]=$reporte->getCaIdagente();
        //$data["ca_idnave"]=$reporte->getIdnave();
        $data["ca_fchsalida"]=$reporte->getEts();
        $data["ca_fchllegada"]=$reporte->getEta();
        $data["ca_master"]=$reporte->getCaDocmaster();
        
        
        $this->responseArray=array("success"=>true,"data"=>$data);
        $this->setTemplate("responseTemplate");


    }
}
