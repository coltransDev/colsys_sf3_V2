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
                $cliente = Doctrine::getTable("IdsCliente")->find( $request->getParameter("idcliente") );
                $this->forward404Unless( $cliente );
                $ids = $cliente->getIds();
            }else{
                $ids = new Ids();                
                $cliente = new IdsCliente();                                
            }
            
            
            if( !$request->getParameter("idcliente") || $this->getNivel()>=4 ){
                $ids->setCaIdalterno( $request->getParameter("idalterno") );  
                if( $request->getParameter("tipo_identificacion")==1 ){
                    $ids->setCaDv( $request->getParameter("dv") );
                }
                $ids->setCaTipoidentificacion( $request->getParameter("tipo_identificacion") );
            }
            
            
           
            
            $ids->setCaNombre( strtoupper($request->getParameter("compania")) );
            $ids->setCaWebsite( $request->getParameter("website") );            
            //$cliente->setCaCompania( strtoupper($request->getParameter("compania")) );
            $cliente->setCaSaludo( utf8_decode($request->getParameter("title")) );
            $cliente->setCaPapellido( utf8_decode($request->getParameter("apellido")) );
            $cliente->setCaNombres( utf8_decode($request->getParameter("nombre")) );
            $cliente->setCaSexo( $request->getParameter("sexo") );
            $cliente->setCaCumpleanos( $request->getParameter("cumpleanos") );
            $cliente->setCaEmail( $request->getParameter("email") );
            
            
            if( $nivel>=2 ){
                $cliente->setCaVendedor( $request->getParameter("vendedor", null) );
            }else{
                $cliente->setCaVendedor( $this->getUser()->getUserId() );
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
                $cliente->setCaComplemento($request->getParameter("complemento") );
            }else{
                $cliente->setCaDireccion(utf8_decode($request->getParameter("dir_ot") ));                
            }
            
            
            $cliente->setCaTelefonos( $request->getParameter("phone")  );
            $cliente->setCaFax( $request->getParameter("fax")  );            
            $cliente->setCaIdciudad( $request->getParameter("idciudad")  );
            $cliente->setCaSectoreco( utf8_decode($request->getParameter("sectoreco")) );
            $cliente->setCaActividad( utf8_decode($request->getParameter("actividad")) );
            
            if( $request->getParameter("status") ){
                $cliente->setCaStatus( $request->getParameter("status") );
            }else{
                $cliente->setCaStatus( null );
            }
            
            $cliente->setCaCalificacion( $request->getParameter("calificacion") );
            $cliente->setCaComentario( $request->getParameter("comentario") );
            $cliente->setCaFchcotratoag( $request->getParameter("fchcotratoag") );
            $cliente->setCaEntidad( $request->getParameter("entidad") );
            $cliente->setCaPreferencias( utf8_decode($request->getParameter("preferencias")) );
            
            $cliente->setCaLeyinsolvencia( utf8_decode($request->getParameter("leyinsolvencia")) );
            $cliente->setCaListaclinton( utf8_decode($request->getParameter("listaclinton")) );

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
        $cliente = Doctrine::getTable("Cliente")->find( $request->getParameter("idcliente") );
        $this->forward404Unless( $cliente );


        $data = array();
        $ids = $cliente->getIds();
        $data["idcliente"] = $cliente->getCaIdcliente();
        $data["compania"] = ($ids->getCaNombre());
        $data["idalterno"] = $ids->getCaIdalterno();
        $data["tipo_identificacion"] = $ids->getCaTipoidentificacion();
        $data["idtrafico"] = $ids->getIdsTipoIdentificacion()->getCaIdtrafico();
        $data["dv"] = $ids->getCaDv();
        $data["website"] = $ids->getCaWebsite();
        
        $data["vendedor"] = $cliente->getCaVendedor();
        
        
        
        $data["title"] = utf8_encode($cliente->getCaSaludo());
        $data["apellido"] = utf8_encode($cliente->getCaPapellido());
        $data["nombre"] = utf8_encode($cliente->getCaNombres());
        $data["sexo"] = $cliente->getCaSexo();
        $data["cumpleanos"] = $cliente->getCaCumpleanos();
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
        
        
        if( $data["idtrafico"]=="CO-057" ){
            $direccion = explode("|",$cliente->getCaDireccion());

            for($i=0; $i<count( $direccion ); $i++){
                $data["dir_".($i+1)] = utf8_encode($direccion[$i]);
            }

            $data["bloque"] = $cliente->getCaBloque();
            $data["torre"] = $cliente->getCaTorre();
            $data["interior"] = $cliente->getCaInterior();
            $data["oficina"] = $cliente->getCaOficina();
            $data["complemento"] = $cliente->getCaComplemento();
        }else{
            $data["dir_ot"] = $cliente->getCaDireccion();
        }
        
        $data["idciudad"] = $cliente->getCaIdciudad();
        $data["ciudad"] = utf8_encode($cliente->getCiudad()->getCaCiudad());


        $data["phone"] = $cliente->getCaTelefonos();
        $data["fax"] = $cliente->getCaFax();

        $data["preferencias"] = utf8_encode($cliente->getCaPreferencias());
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }



    public function executeVerCliente( sfWebRequest $request ){
        
    }

}
