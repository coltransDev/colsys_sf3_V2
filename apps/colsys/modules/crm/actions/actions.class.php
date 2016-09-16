<?php

/**
 * crm actions.
 *
 * @package    symfony
 * @subpackage crm
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class crmActions extends sfActions {
    
    
    const RUTINA = 10;

    public function getNivel( ){ 
                       
        $this->nivel = $this->getUser()->getNivelAcceso( crmActions::RUTINA );		
        return $this->nivel;
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }
    
    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCliente(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
        $this->nivel = $this->getNivel();
    }



    /**
     * 
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarCliente(sfWebRequest $request) {
        
        try{
            $nivel = $this->getNivel();
            
            $conn = Doctrine::getTable("Cliente")->getConnection();
            $conn->beginTransaction();
            
            if( $request->getParameter("idcliente") ){
                
                $ids = Doctrine::getTable("Ids")->find( $request->getParameter("idcliente") );
                $this->forward404Unless( $ids );
                
                $cliente = Doctrine::getTable("IdsCliente")->find( $request->getParameter("idcliente") );
                if( !$cliente ){
                    $cliente = new IdsCliente();                    
                }else{
                    if( $nivel<2 && $cliente->getCaVendedor( ) && $cliente->getCaVendedor( )!= $this->getUser()->getUserId()){
                        throw new Exception("Esta tratando de modificar un cliente de otro comercial. Este cliente se encuentra actualmente asignado a ".$cliente->getCaVendedor( ));
                    }
                }
                
                $prov = Doctrine::getTable("IdsProveedor")->find( $request->getParameter("idcliente") );
                
            }else{
                $ids = new Ids();                
                $cliente = new IdsCliente();     
                $prov = null;
            }
            
            if( !$prov ){
                if( !$request->getParameter("idcliente") || $this->getNivel()>=4 ){
                    $ids->setCaIdalterno( $request->getParameter("idalterno") );  
                    if( $request->getParameter("tipo_identificacion")==1 ){
                        $ids->setCaDv( $request->getParameter("dv") );
                    }
                    $ids->setCaTipoidentificacion( $request->getParameter("tipo_identificacion") );
                }
                $ids->setCaNombre( utf8_decode(strtoupper($request->getParameter("compania"))) );
            }
            $ids->setCaWebsite( $request->getParameter("website") );
            $cliente->setCaWebsite( $request->getParameter("website") );
            //$cliente->setCaCompania( strtoupper($request->getParameter("compania")) );
            $cliente->setCaSaludo( utf8_decode($request->getParameter("title")) );
            $cliente->setCaPapellido( utf8_decode($request->getParameter("papellido")) );
            $cliente->setCaSapellido( utf8_decode($request->getParameter("sapellido")) );
            $cliente->setCaNombres( utf8_decode($request->getParameter("nombre")) );
            $cliente->setCaSexo( $request->getParameter("sexo") );
            $cliente->setCaCumpleanos( $request->getParameter("cumpleanos") );
            $cliente->setCaEmail( $request->getParameter("email") );
            
            if( $nivel>=2 ){
                if( $request->getParameter("vendedor") ){
                    $cliente->setCaVendedor( $request->getParameter("vendedor") );
                }else{
                    $cliente->setCaVendedor( null );
                }
            }else{
                $cliente->setCaVendedor( $this->getUser()->getUserId() );
            }
           
            if( $request->getParameter("coordinador") ){
                $cliente->setCaCoordinador( $request->getParameter("coordinador") );
            }else{
                $cliente->setCaCoordinador( null );
            }
            
            $idtrafico = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();
            
            if( $idtrafico=="CO-057" ){
                //Direccion
                $direccion = "";
                for($i=1; $i<=10; $i++){
                    ($i>1)?$direccion.="|":"";
                    $direccion.=$request->getParameter("dir_".$i);
                }
                $cliente->setCaDireccion(utf8_decode($direccion));

                $cliente->setCaBloque($request->getParameter("bloque") );
                $cliente->setCaTorre($request->getParameter("torre") );
                $cliente->setCaInterior($request->getParameter("interior") );
                $cliente->setCaOficina($request->getParameter("oficina") );
                $cliente->setCaComplemento(utf8_decode($request->getParameter("complemento")) );
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad")) );
            }else{
                $cliente->setCaDireccion(utf8_decode($request->getParameter("dir_ot") )); 
                $cliente->setCaLocalidad(utf8_decode($request->getParameter("localidad_ot")) );
            }
            
            
            $cliente->setCaTelefonos( $request->getParameter("phone") );
            $cliente->setCaFax( $request->getParameter("fax") );
            $cliente->setCaIdciudad( $request->getParameter("idciudad") );
            $cliente->setCaSectoreco( utf8_decode($request->getParameter("sectoreco")) );
            $cliente->setCaActividad( utf8_decode($request->getParameter("actividad")) );
            $cliente->setCaFchacuerdoconf( $request->getParameter("fchacuerdoconf") );
            $cliente->setCaZipcode( $request->getParameter("zipcode") );
            
            if( $nivel>=2 ){
                if( $request->getParameter("status") ){
                    $cliente->setCaStatus( $request->getParameter("status") );
                }else{
                    $cliente->setCaStatus( null );
                }
            }
            
            $cliente->setCaCalificacion( $request->getParameter("calificacion") );
            
            $cliente->setCaFchcotratoag( $request->getParameter("fchcotratoag") );
            $cliente->setCaEntidad( $request->getParameter("entidad") );
            $cliente->setCaPreferencias( utf8_decode($request->getParameter("preferencias")) );
            if( $request->getParameter("leyinsolvencia") ){
                $cliente->setCaLeyinsolvencia( utf8_decode($request->getParameter("leyinsolvencia")) );
            }else{
                $cliente->setCaLeyinsolvencia( null );
            }
            
            if( $request->getParameter("listaclinton") ){
                $cliente->setCaListaclinton( utf8_decode($request->getParameter("listaclinton")) );
            }else{
                $cliente->setCaListaclinton( null);
            }
            
            if( $request->getParameter("comentario") ){
                $cliente->setCaComentario( $request->getParameter("comentario") );
            }else{
                $cliente->setCaComentario( null );
            }
            
            if($request->getParameter("global")=="on"){
                $cliente->setProperty('cuentaglobal', "|true" );
            }else{
                $cliente->setProperty('cuentaglobal', "" );
            }
            
            if($request->getParameter("consolidar")=="on"){
                $cliente->setProperty('consolidar_comunicaciones', "|true" );
            }else{
                $cliente->setProperty('consolidar_comunicaciones', "" );
            }
            $cliente->setCaPropiedades( str_replace("|","",$cliente->getCaPropiedades( ))  );
            
            $ids->save( $conn );
            $cliente->setCaIdgrupo( $ids->getCaId() );
            $cliente->setCaIdcliente( $ids->getCaId() );
            $cliente->setIds( $ids );
            $cliente->save( $conn );
            
            $this->responseArray = array( "success"=>true, "idcliente"=>$ids->getCaId() );
            $conn->commit();
        }catch (Exception $e){
            $conn->rollBack();
            $this->responseArray = array( "success"=>false, "errorInfo"=>$e->getMessage() );
        }
        $this->setTemplate("responseTemplate");
    }


    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosClienteFormPanel(sfWebRequest $request) {
        $this->forward404Unless( $request->getParameter("idcliente") );        
        $ids = Doctrine::getTable("Ids")->find( $request->getParameter("idcliente") );
        $this->forward404Unless( $ids );        
        
        
        $data = array();        
        $data["idcliente"] = $ids->getCaId();        
        $data["compania"] = utf8_encode($ids->getCaNombre());
        $data["idalterno"] = $ids->getCaIdalterno();
        $data["tipo_identificacion"] = $ids->getCaTipoidentificacion();
        $data["idalterno_ant"] = $ids->getCaIdalterno();
        $data["tipo_identificacion_ant"] = $ids->getCaTipoidentificacion();
        $data["idtrafico"] = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();
        $data["dv"] = $ids->getCaDv();
        $data["website"] = $ids->getCaWebsite();
        
        $cliente = Doctrine::getTable("Cliente")->find( $request->getParameter("idcliente") );
        if( $cliente ){
            $data["vendedor"] = $cliente->getCaVendedor();
            $data["coordinador"] = $cliente->getCaCoordinador();


            $data["title"] = utf8_encode($cliente->getCaSaludo());
            $data["papellido"] = utf8_encode($cliente->getCaPapellido());
            $data["sapellido"] = utf8_encode($cliente->getCaSapellido());
            $data["nombre"] = utf8_encode($cliente->getCaNombres());
            $data["sexo"] = $cliente->getCaSexo();
            $data["cumpleanos"] = $cliente->getCaCumpleanos();
            $data["website"] = $cliente->getCaWebsite();
            $data["email"] = $cliente->getCaEmail();


            $data["sectoreco"] = utf8_encode($cliente->getCaSectoreco());
            $data["actividad"] = utf8_encode($cliente->getCaActividad());
            $data["status"] = $cliente->getCaStatus();
            $data["calificacion"] = $cliente->getCaCalificacion();
            $data["fchcotratoag"] = $cliente->getCaFchcotratoag();
            $data["entidad"] = $cliente->getCaEntidad();
            $data["comentario"] = $cliente->getCaComentario();
            $data["leyinsolvencia"] = utf8_encode($cliente->getCaLeyinsolvencia());
            $data["listaclinton"] = utf8_encode($cliente->getCaListaclinton());
            $data["fchacuerdoconf"] = $cliente->getCaFchacuerdoconf();

            if( $data["idtrafico"]=="CO-057" ){
                $direccion = explode("|",$cliente->getCaDireccion());

                for($i=0; $i<count( $direccion ); $i++){
                    $data["dir_".($i+1)] = utf8_encode($direccion[$i]);
                }

                $data["bloque"] = $cliente->getCaBloque();
                $data["torre"] = $cliente->getCaTorre();
                $data["interior"] = $cliente->getCaInterior();
                $data["oficina"] = $cliente->getCaOficina();
                $data["complemento"] = utf8_encode($cliente->getCaComplemento());
            }else{
                $data["dir_ot"] = $cliente->getCaDireccion();
            }

            $data["localidad"] = utf8_encode($cliente->getCaLocalidad());
            $data["localidad_ot"] = utf8_encode($cliente->getCaLocalidad());

            $data["idciudad"] = $cliente->getCaIdciudad();
            $data["ciudad"] = utf8_encode($cliente->getCiudad()->getCaCiudad());
            $data["zipcode"] = $cliente->getCaZipcode();

            $data["phone"] = $cliente->getCaTelefonos();
            $data["fax"] = $cliente->getCaFax();

            $data["preferencias"] = utf8_encode($cliente->getCaPreferencias());
            $data["global"] = $cliente->getProperty("cuentaglobal");
            $data["consolidar"] = $cliente->getProperty("consolidar_comunicaciones");
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }



    public function executeVerCliente( sfWebRequest $request ){
        
    }

}
