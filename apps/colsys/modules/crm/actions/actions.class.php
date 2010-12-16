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

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeFormCliente(sfWebRequest $request) {
        $this->idcliente = $request->getParameter("idcliente");
    }



    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarCliente(sfWebRequest $request) {

        try{

            $conn = Doctrine::getTable("Cliente")->getConnection();
            $conn->beginTransaction();
            if( $request->getParameter("idcliente") ){
                $cliente = Doctrine::getTable("Cliente")->find( $request->getParameter("idcliente") );
                $this->forward404Unless( $cliente );
                $ids = $cliente->getIds();
            }else{
                $ids = new Ids();                
                $cliente = new Cliente();                                
            }

            $ids->setCaIdalterno( $request->getParameter("idalterno") );
            $ids->setCaDv( $request->getParameter("dv") );
            $ids->setCaTipoidentificacion( $request->getParameter("tipo_identificacion") );
            $ids->setCaNombre( $request->getParameter("compania") );
            
            $ids->setCaWebsite( $request->getParameter("website") );
            $cliente->setCaSaludo( utf8_decode($request->getParameter("title")) );
            $cliente->setCaPapellido( utf8_decode($request->getParameter("apellido")) );
            $cliente->setCaNombres( utf8_decode($request->getParameter("nombre")) );
            $cliente->setCaSexo( $request->getParameter("sexo") );
            $cliente->setCaCumpleanos( $request->getParameter("cumpleanos") );
            $cliente->setCaEmail( $request->getParameter("email") );

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

            $cliente->setCaTelefonos( $request->getParameter("phone")  );
            $cliente->setCaFax( $request->getParameter("fax")  );
            //$cliente->setCaCiudad( $request->getParameter("")  );
            $cliente->setCaIdciudad( "BOG-0001" );

            $cliente->setCaSectoreco( utf8_decode($request->getParameter("sectoreco")) );
            $cliente->setCaActividad( utf8_decode($request->getParameter("actividad")) );
            $cliente->setCaStatus( $request->getParameter("status") );
            $cliente->setCaCalificacion( $request->getParameter("calificacion") );
            $cliente->setCaComentario( $request->getParameter("comentario") );
            $cliente->setCaFchcotratoag( $request->getParameter("fchcotratoag") );
            $cliente->setCaEntidad( $request->getParameter("entidad") );
            $cliente->setCaPreferencias( $request->getParameter("preferencias") );


            $ids->save( $conn );
            $cliente->setCaIdcliente( $ids->getCaId() );
            $cliente->setCaIdgrupo( $ids->getCaId() );
            $cliente->save( $conn );
            $this->responseArray = array( "success"=>true );
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
        $data["dv"] = $ids->getCaDv();
        $data["website"] = $ids->getCaWebsite();
        
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
        
        
        $direccion = explode("|",$cliente->getCaDireccion());
       
        for($i=0; $i<count( $direccion ); $i++){
            $data["dir_".($i+1)] = utf8_encode($direccion[$i]);
        }

        $data["bloque"] = $cliente->getCaBloque();
        $data["torre"] = $cliente->getCaTorre();
        $data["interior"] = $cliente->getCaInterior();
        $data["oficina"] = $cliente->getCaOficina();
        $data["complemento"] = $cliente->getCaComplemento();

        $data["phone"] = $cliente->getCaTelefonos();
        $data["fax"] = $cliente->getCaFax();

        $data["preferencias"] = utf8_encode($cliente->getCaPreferencias());
        
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

}