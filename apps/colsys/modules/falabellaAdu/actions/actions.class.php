<?php

/**
 * falabellaAdu actions.
 *
 * @package    colsys
 * @subpackage falabellaAdu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class falabellaAduActions extends sfActions {

	/*
	* Accion por defecto
	*/
    public function executeIndex() {
        return $this->forward ( 'falabellaAdu', 'list' );
    }

	/*
	* Lista los PO disponibles
	*/
    public function executeList() {
        $this->fala_headers = Doctrine::getTable("FalaHeaderAdu")
            ->createQuery("f")
            ->select("f.*, i.*")
            ->addWhere("f.ca_fcharchivado is null")
            ->leftJoin("f.FalaInstructionAdu i")
            ->addOrderBy("f.ca_reqd_delivery desc")
            ->addOrderBy("f.ca_referencia")
            ->addOrderBy("f.ca_archivo_origen")
            //->getSqlQuery();
            ->execute();
    }

	/*
	* Lista los PO disponibles
	*/
    public function executeReferences() {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');
        $response->addJavaScript("extExtras/LockingGridView",'last');
    }

	/*
	* Permite ver las intrucciones de embarque
	*/
    public function executeShippingInstructions() {
        $this->header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
        $this->forward404Unless($this->header);
        $this->instructions = $this->header->getFalaInstructionAdu();
        $this->info = $this->header->getFalaShipmentInfoAdu();
    }

    /*
    * Permite archivar la Orden de Pedido
    */
    public function executeArchivarOrden(){
            if ($this->getRequestParameter('id')){
                $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $this->getRequestParameter ( 'iddoc' ) );
                $this->forward404Unless($fala_header);

                $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);
            }else{
                $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
                $this->forward404Unless($fala_header);
            }

            $fala_header->setCaFcharchivado(date("d M Y H:i:s"));
            $fala_header->setCaUsuarchivado($this->getUser()->getUserId());
            $fala_header->save();

            if ($this->getRequestParameter('id')){
                $this->responseArray["success"]=true;
                $this->setTemplate("responseTemplate");
            }else{
                $this->redirect("falabellaAdu/list");
            }

    }

	/*
	* Permite ver los detalles del PO y confirmar los datos para generar el archivo de salida
	*/
    public function executeDetails() {
        $this->fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
        $this->forward404Unless($this->fala_header);

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');
        $response->addJavaScript("extExtras/LockingGridView",'last');
        $response->addStylesheet("extExtras/LockingGridView",'last');
    }

	/*
	* Permite ver los detalles de la DIM y confirmar los datos para generar el archivo de salida
	*/
    public function executeDeclaracion() {
        $fala_declaracion = Doctrine::getTable("FalaDeclaracionImp")->find ( base64_decode($this->getRequestParameter ( 'referencia' )) );
        $this->forward404Unless($fala_declaracion);

        $this->fala_declaracion = Doctrine::getTable("FalaDeclaracionImp")
            -> createQuery("d")
            ->where ( "d.ca_referencia = ?",base64_decode($this->getRequestParameter ( 'referencia' )) )
            ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
            ->fetchOne();
        $this->fala_declaracion['vlrFobDeclaracion'] = $fala_declaracion->getValorFobDeclaracion();
        $this->fala_declaracion['vlrFobSkus'] = $fala_declaracion->getValorFobSkus();

        $this->forward404Unless($this->fala_declaracion);

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/LockingGridView",'last');
        $response->addStylesheet("extExtras/LockingGridView",'last');
    }


	/*
	* Guarda los cambios en el encabezado del documento
	*/
    public function executeObserveHeader() {
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $this->getRequestParameter ( 'iddoc' ) );
        $this->forward404Unless($fala_header);

        $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);

        if( $this->getRequestParameter ( 'referencia' )!==null ) {
            $fala_header->setCaReferencia( $this->getRequestParameter ( 'referencia' ) );
        }

        if( $this->getRequestParameter ( 'reqd_delivery' )!==null ) {
            $fala_header->setCaReqdDelivery( $this->getRequestParameter ( 'reqd_delivery' ) );
        }

        $fala_header->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }


	/*
	* Guarda los cambios en el encabezado de la Declaración de Importación
	*/
    public function executeObserveDeclaracion() {
        $fala_declaracion = Doctrine::getTable("FalaDeclaracionImp")->find ( $this->getRequestParameter ( 'referencia' ) );
        $this->forward404Unless($fala_declaracion);

        $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);

        if( $this->getRequestParameter ( 'numdeclaracion' )!==null ) {
            $fala_declaracion->setCaNumdeclaracion( $this->getRequestParameter ( 'numdeclaracion' ) );
        }

        if( $this->getRequestParameter ( 'numinternacion' )!==null ) {
            $fala_declaracion->setCaNuminternacion( $this->getRequestParameter ( 'numinternacion' ) );
        }

        $fala_declaracion->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }

	/*
	* Guarda los cambios en el encabezado de la Declaración de Importación
	*/
    public function executeObserveReference() {
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $this->getRequestParameter ( 'iddoc' ) );
        $this->forward404Unless($fala_header);

        $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);

        if(!$this->getRequestParameter ( 'limpiar' )){
            if( $this->getRequestParameter ( 'referencia' )!==null ) {
                $fala_header->setCaReferencia( $this->getRequestParameter ( 'referencia' ) );
            }

            if( $this->getRequestParameter ( 'reqd_delivery' )!==null ) {
                $fala_header->setCaReqdDelivery( $this->getRequestParameter ( 'reqd_delivery' ) );
            }
        }else{
            $fala_header->setCaReferencia( null );
            $fala_header->setCaReqdDelivery( null );
        }

        $fala_header->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }


	/*
	* Guarda los cambios en el detalle del documento
	*/
    public function executeObserveDetail() {
        $faladetail = Doctrine::getTable("FalaDetailAdu")->find(array( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ) ) ) ;
        $this->forward404Unless($faladetail);

        $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

        if( $this->getRequestParameter ( 'subpartida' )!==null ) {
            $faladetail->setCaSubpartida( $this->getRequestParameter ( 'subpartida' ) );
        }

        if( $this->getRequestParameter ( 'descripcion_item' )!==null ) {
            $faladetail->setCaDescripcionItem( $this->getRequestParameter ( 'descripcion_item' ) );
        }

        if( $this->getRequestParameter ( 'descripcion_mcia' )!==null ) {
            $faladetail->setCaDescripcionMcia( $this->getRequestParameter ( 'descripcion_mcia' ) );
        }

        if( $this->getRequestParameter ( 'preinspeccion' )!==null ) {
            $faladetail->setCaPreinspeccion( $this->getRequestParameter ( 'preinspeccion' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_pedido' )!==null ) {
            $faladetail->setCaCantidadPedido( $this->getRequestParameter ( 'cantidad_pedido' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_dav' )!==null ) {
            $faladetail->setCaCantidadDav( $this->getRequestParameter ( 'cantidad_dav' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_dim' )!==null ) {
            $faladetail->setCaCantidadDim( $this->getRequestParameter ( 'cantidad_dim' ) );
        }

        if( $this->getRequestParameter ( 'valor_fob' )!==null ) {
            $faladetail->setCaValorFob( $this->getRequestParameter ( 'valor_fob' ) );
        }

        if( $this->getRequestParameter ( 'radicado_num' )!==null ) {
            $faladetail->setCaRadicadoNum( $this->getRequestParameter ( 'radicado_num' ) );
        }

        if( $this->getRequestParameter ( 'registro_num' )!==null ) {
            $faladetail->setCaRegistroNum( $this->getRequestParameter ( 'registro_num' ) );
        }

        if( $this->getRequestParameter ( 'unidad_comercial' )!==null ) {
            $faladetail->setCaUnidadComercial( $this->getRequestParameter ( 'unidad_comercial' ) );
        }

        if( $this->getRequestParameter ( 'marca' )!==null ) {
            $faladetail->setCaMarca( $this->getRequestParameter ( 'marca' ) );
        }

        if( $this->getRequestParameter ( 'tipo' )!==null ) {
            $faladetail->setCaTipo( $this->getRequestParameter ( 'tipo' ) );
        }

        if( $this->getRequestParameter ( 'clase' )!==null ) {
            $faladetail->setCaClase( $this->getRequestParameter ( 'clase' ) );
        }

        if( $this->getRequestParameter ( 'modelo' )!==null ) {
            $faladetail->setCaModelo( $this->getRequestParameter ( 'modelo' ) );
        }

        if( $this->getRequestParameter ( 'ano' )!==null ) {
            $faladetail->setCaAno( $this->getRequestParameter ( 'ano' ) );
        }

        if( $this->getRequestParameter ( 'factura_nro' )!==null ) {
            $faladetail->setCaFacturaNro( $this->getRequestParameter ( 'factura_nro' ) );
        }

        if( $this->getRequestParameter ( 'factura_fch' )!==null ) {
            $faladetail->setCaFacturaFch( $this->getRequestParameter ( 'factura_fch' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_paquetes_miles' )!==null ) {
            $faladetail->setCaCantidadPaquetesMiles( $this->getRequestParameter ( 'cantidad_paquetes_miles' ) );
        }

        if( $this->getRequestParameter ( 'unidad_medida_paquetes' )!==null ) {
            $faladetail->setCaUnidadMedidaPaquetes( $this->getRequestParameter ( 'unidad_medida_paquetes' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_peso_miles' )!==null ) {
            $faladetail->setCaCantidadPesoMiles( $this->getRequestParameter ( 'cantidad_peso_miles' ) );
        }

        if( $this->getRequestParameter ( 'unidad_medida_peso' )!==null ) {
            $faladetail->setCaUnidadMedidaPeso( $this->getRequestParameter ( 'unidad_medida_peso' ) );
        }

        if( $this->getRequestParameter ( 'cantidad_volumen_miles' )!==null ) {
            $faladetail->setCaCantidadVolumenMiles( $this->getRequestParameter ( 'cantidad_volumen_miles' ) );
        }

        if( $this->getRequestParameter ( 'unidad_medida_volumen' )!==null ) {
            $faladetail->setCaUnidadMedidaVolumen( $this->getRequestParameter ( 'unidad_medida_volumen' ) );
        }

        $faladetail->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }


	/*
	* Guarda los cambios en el detalle del documento
	*/
    public function executeEliminarDetail() {
        if ($this->getRequestParameter ( 'subpartida' )==null){
            $faladetail = Doctrine::getTable("FalaDetailAdu")->find(array( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' )) ) ;
        }else{
            $faladetail = Doctrine::getTable("FalaDetailAdu")->find(array( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ), $this->getRequestParameter ( 'subpartida' )) ) ;
        }
        $this->forward404Unless($faladetail);

        $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

        $faladetail->delete();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }

	/*
	* Permite anular la Orden de Pedido
	*/
    public function executeAnularOrden() {
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
        $this->forward404Unless($fala_header);
        $fala_header->setCaFchanulado(date("d M Y H:i:s"));
        $fala_header->setCaUsuanulado($this->getUser()->getUserId());
        $fala_header->save();
        $this->redirect("falabellaAdu/list");
    }


	/*
	* Permite Duplicar un registro de la Orden de Pedido
	*/
    public function executeDuplicateRecord() {
        $faladetail = FalaDetailPeer::retrieveByPk( base64_decode($this->getRequestParameter ( 'iddoc' )), $this->getRequestParameter ( 'sku' ));
        $this->forward404Unless($faladetail);
        $doc_mem = $this->getRequestParameter ( 'iddoc' );
        $sku_mem = $faladetail->getSkuNeto();

        $c = new Criteria();
        $c->add( FalaDetailPeer::CA_IDDOC, FalaDetailPeer::CA_IDDOC." = '$doc_mem'" , Criteria::CUSTOM );
        $c->addAnd( FalaDetailPeer::CA_SKU, FalaDetailPeer::CA_SKU." LIKE '$sku_mem%'" , Criteria::CUSTOM );
        $sku_num = FalaDetailPeer::doCount($c);

        $sku_mem.= "-".$sku_num;

        $new_faladetail = $faladetail->copy(FALSE);
        $new_faladetail->setCaIddoc($this->getRequestParameter ( 'iddoc' ));
        $new_faladetail->setCaSku($sku_mem);
        $new_faladetail->setCaCantidadPedido(0);
        $new_faladetail->setCaCantidadMiles(0);
        $new_faladetail->save();
        $this->redirect("falabellaAdu/details?iddoc=".base64_encode($doc_mem));
        return sfView::NONE;
    }


	/*
	* Generar una Nueva Orden con los productos faltantes
	*/
    public function executeGenerarNuevaOrden()
    {
        $doc_mem = base64_decode($this->getRequestParameter ( 'iddoc' ));
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $doc_mem );
        $this->forward404Unless($fala_header);

        $c = new Criteria();
        $c->add( FalaHeaderPeer::CA_IDDOC, FalaHeaderPeer::CA_IDDOC." LIKE '$doc_mem%'" , Criteria::CUSTOM );
        $doc_mem = $fala_header->getIdDocNeto();
        $doc_num = FalaHeaderPeer::doCount($c);
        $doc_mem.= "-".$doc_num;

        $new_falaheader = $fala_header->copy(FALSE);
        $new_falaheader->setCaIddoc($doc_mem);
        $new_falaheader->setCaProcesado(FALSE);
        $new_falaheader->setCaFchanulado(NULL);
        $new_falaheader->setCaUsuanulado(NULL);
        $new_falaheader->save();

        $faladetails = $fala_header->getFalaDetails();
        foreach( $faladetails as $detail ) {
            if ($detail->getCaCantidadMiles() < $detail->getCaCantidadPedido()) {
                $new_faladetail = $detail->copy(FALSE);
                $new_faladetail->setCaIddoc($doc_mem);
                $new_faladetail->setCaSku($detail->getCaSku());
                $new_faladetail->setCaCantidadPedido($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
                $new_faladetail->setCaCantidadMiles($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
                $new_faladetail->save();
            }
        }
        $falashippings = $fala_header->getFalaShipmentInfos();
        foreach( $falashippings as $shipping ) {
            $new_shipping = $shipping->copy(FALSE);
            $new_shipping->setCaIddoc($doc_mem);
            $new_shipping->save();
        }
        $this->redirect("falabellaAdu/generarArchivo?iddoc=".$this->getRequestParameter ( 'iddoc' ));
        return sfView::NONE;
    }


	/*
	* Exportar a Excel el contenido de las ordenes asociadas con el DO
	*/
    public function executeExportaExcel()
    {
            $doc_mem = base64_decode($this->getRequestParameter ( 'iddoc' ));
            $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $doc_mem );
            $this->referencia = $fala_header->getCaReferencia();
            $this->forward404Unless($fala_header);

            $fala_details = Doctrine::getTable("FalaHeaderAdu")
                           ->createQuery("h")
                           ->innerJoin("h.FalaDetailAdu d")
                           ->select("h.ca_referencia, d.*")
                           ->where("h.ca_referencia = ? ", $fala_header->getCaReferencia())
                           ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                           ->execute();

            $salida = "ca_iddoc\t";
            $salida.= "ca_sku\t";
            $salida.= "ca_vpn\t";
            $salida.= "ca_cantidad_pedido\t";
            $salida.= "ca_cantidad_dav\t";
            $salida.= "ca_cantidad_dim\t";
            $salida.= "ca_valor_fob\t";
            $salida.= "ca_unidad_medidad_cantidad\t";
            $salida.= "ca_descripcion_item\t";
            $salida.= "ca_cantidad_paquetes_miles\t";
            $salida.= "ca_unidad_medida_paquetes\t";
            $salida.= "ca_cantidad_volumen_miles\t";
            $salida.= "ca_unidad_medida_volumen\t";
            $salida.= "ca_cantidad_peso_miles\t";
            $salida.= "ca_unidad_medida_peso\t";
            $salida.= "ca_unidad_comercial\t";
            $salida.= "ca_referencia_prov\t";
            $salida.= "ca_subpartida\t";
            $salida.= "ca_radicado_num\t";
            $salida.= "ca_registro_num\t";
            $salida.= "ca_descripcion_mcia\t";
            $salida.= "ca_preinspeccion\t";
            $salida.= "ca_marca\t";
            $salida.= "ca_tipo\t";
            $salida.= "ca_clase\t";
            $salida.= "ca_modelo\t";
            $salida.= "ca_ano\t";
            $salida.= "ca_factura_nro\t";
            $salida.= "ca_factura_fch\t";
            $salida.= "\r\n";

            foreach( $fala_details as $fala_detail ){
                $salida.= $fala_detail["d_ca_iddoc"]."\t"; // 3
                $salida.= $fala_detail["d_ca_sku"]."\t"; // 4
                $salida.= $fala_detail["d_ca_vpn"]."\t"; // 5
                $salida.= $fala_detail["d_ca_cantidad_pedido"]."\t"; // 6
                $salida.= $fala_detail["d_ca_cantidad_dav"]."\t"; // 7
                $salida.= $fala_detail["d_ca_cantidad_dim"]."\t"; // 8
                $salida.= floatval($fala_detail["d_ca_valor_fob"])."\t"; // 9
                $salida.= $fala_detail["d_ca_unidad_medidad_cantidad"]."\t"; // 10
                $salida.= $fala_detail["d_ca_descripcion_item"]."\t"; // 11
                $salida.= $fala_detail["d_ca_cantidad_paquetes_miles"]."\t"; // 12
                $salida.= $fala_detail["d_ca_unidad_medida_paquetes"]."\t"; // 13
                $salida.= $fala_detail["d_ca_cantidad_volumen_miles"]."\t"; // 14
                $salida.= $fala_detail["d_ca_unidad_medida_volumen"]."\t"; // 15
                $salida.= $fala_detail["d_ca_cantidad_peso_miles"]."\t"; // 16
                $salida.= $fala_detail["d_ca_unidad_medida_peso"]."\t"; // 17
                $salida.= $fala_detail["d_ca_unidad_comercial"]."\t"; // 18
                $salida.= $fala_detail["d_ca_referencia_prov"]."\t"; // 19
                $salida.= $fala_detail["d_ca_subpartida"]."\t"; // 20
                $salida.= $fala_detail["d_ca_radicado_num"]."\t"; // 21
                $salida.= $fala_detail["d_ca_registro_num"]."\t"; // 22
                $salida.= $fala_detail["d_ca_descripcion_mcia"]."\t"; // 23
                $salida.= $fala_detail["d_ca_preinspeccion"]."\t"; // 24
                $salida.= $fala_detail["d_ca_marca"]."\t"; // 25
                $salida.= $fala_detail["d_ca_tipo"]."\t"; // 26
                $salida.= $fala_detail["d_ca_clase"]."\t"; // 27
                $salida.= $fala_detail["d_ca_modelo"]."\t"; // 28
                $salida.= $fala_detail["d_ca_ano"]."\t"; // 29
                $salida.= $fala_detail["d_ca_factura_nro"]."\t"; // 30
                $salida.= $fala_detail["d_ca_factura_fch"]."\t"; // 31
                $salida.= "\r\n";
            }

            $this->salida = $salida;
    }


	/*
	* Importa desde Excel el contenido de las ordenes asociadas con el DO
	*/
    public function executeImportaExcel( $request ){

        if ($request->isMethod('post')){
            $referencia = substr($_FILES['archivo']['name'],0,3).".".substr($_FILES['archivo']['name'],3,2).".".substr($_FILES['archivo']['name'],5,2).".".substr($_FILES['archivo']['name'],7,3).".".substr($_FILES['archivo']['name'],10,1);

            $ref_mem = NULL;
            $file = $_FILES['archivo']['tmp_name'];

            $handle = fopen($file, "r");
            $input = fread($handle, filesize($file));
            $input = str_replace(chr(13),"",str_replace(chr(34), "", $input));

            $records = explode(chr(10),$input); // Divide el archivo por los Saltos de Línea

            foreach($records as $record){       // Hace una primera lectura para verificar la estructura del archivo

                if(stristr($record, 'ca_iddoc') === FALSE and strlen(trim($record)) != 0) {

                    $fields = explode(chr($this->getRequestParameter( 'separador' )), $record); // Divide el archivo en campos por el separador

                    if ( count($fields) != 29 ){
                        echo "¡El archivo tiene errores en su estructura, por tanto no se puede importar! ";
                        exit;
                    }

                }else if(stristr($record, 'ca_iddoc') !== FALSE) {

                    $nameFields = explode(chr($this->getRequestParameter( 'separador' )), $record); // Toma los nombres de los campos

                }

            }

            $details = Doctrine::getTable("FalaDetailAdu") // Elimina los registros anteriores
                           ->createQuery("d")
                           ->delete()
                           ->where("ca_iddoc IN (SELECT h.ca_iddoc FROM FalaHeaderAdu h WHERE h.ca_referencia=?)", $referencia )
                           ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                           ->execute();

            $records = explode(chr(10),$input); // Divide el archivo por los Saltos de Línea

            foreach($records as $record){

                if(stristr($record, 'ca_iddoc') === FALSE and strlen(trim($record)) != 0) {

                    $fields = explode(chr($this->getRequestParameter( 'separador' )), $record); // Divide el archivo en campos por el separador

                    $falaDetailAdu = new FalaDetailAdu();
                    $i = 0;
                    foreach($fields as $field){
                        $set = ucwords(str_replace("_"," ",$nameFields[$i]));
                        $set = "set".str_replace(" ","",$set);
                        $i++;

                        $field = ($set=='setCaSubpartida' and $field==null)?"":$field;
                        $falaDetailAdu->$set($field);
                    }
                    $falaDetailAdu->save();

                }

            }

            $this->redirect("falabellaAdu/list");
        }

    }



	/*
	* Genera el archivo de salida para Aprocom
	*/
    public function executeGeneraAprocom()
    {
        $doc_mem = base64_decode($this->getRequestParameter ( 'iddoc' ));
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $doc_mem );
        $this->referencia = $fala_header->getCaReferencia();
        $this->forward404Unless($fala_header);

        $fala_details = Doctrine::getTable("FalaHeaderAdu")
                       ->createQuery("h")
                       ->innerJoin("h.FalaDetailAdu d")
                       ->select("h.ca_referencia, d.*")
                       ->where("h.ca_referencia = ? ", $fala_header->getCaReferencia())
                       ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                       ->execute();

        $i = 1;
        $salida = '';
        foreach( $fala_details as $fala_detail ){
            $salida.= $i++."\t"; //1
            $salida.= $fala_detail["h_ca_referencia"]."\t"; // 2
            $salida.= $fala_detail["d_ca_sku"]."\t"; // 3
            $salida.= $fala_detail["d_ca_referencia_prov"]."\t"; // 4
            $salida.= $fala_detail["d_ca_subpartida"]."\t"; // 5
            $salida.= $fala_detail["d_ca_descripcion_item"]."\t"; // 6
            $salida.= $fala_detail["d_ca_descripcion_mcia"]."\t"; // 7
            $salida.= $fala_detail["d_ca_preinspeccion"]."\t"; // 8
            $salida.= $fala_detail["d_ca_cantidad_dav"]."\t"; // 9
            $salida.= $fala_detail["d_ca_cantidad_dim"]."\t"; // 10
            $salida.= $fala_detail["d_ca_valor_fob"]."\t"; // 11
            $salida.= "\t"; // 12
            $salida.= "\t"; // 13
            $salida.= $fala_detail["d_ca_registro_num"]."\t"; // 14
            $salida.= "999\t"; // 15
            $salida.= $fala_detail["d_ca_unidad_comercial"]."\t"; // 16
            $salida.= $fala_detail["d_ca_marca"]."\t"; // 17
            $salida.= $fala_detail["d_ca_tipo"]."\t"; // 18
            $salida.= $fala_detail["d_ca_clase"]."\t"; // 19
            $salida.= $fala_detail["d_ca_modelo"]."\t"; // 20
            $salida.= $fala_detail["d_ca_ano"]."\t"; // 21
            $salida.= $fala_detail["d_ca_factura_nro"]."\t"; // 22
            list($anno,$mes,$dia) = sscanf($fala_detail["d_ca_factura_fch"],"%d-%d-%d");
            $salida.= date("d/m/Y", mktime(0,0,0,$mes,$dia,$anno)); // 23
            $salida.= "\r\n";
        }

        $this->salida = $salida;
    }


	/*
	* Genera el archivo plano para Falabella con datos de la Declaración de Importación
	*/
    public function executeGeneraDeclaracion()
    {
        $referencia = base64_decode($this->getRequestParameter ( 'referencia' ));
        $stmt = FalaDeclaracionImpTable::declaracionImportacion($referencia);

        $directory=sfConfig::get('app_falabella_output_adu');
        $numdeclaracion = null;
        $reportar = true;
        $salida = '';
        $sum_array = $sub_array = array();
        while ( $row = $stmt->fetch() ) {
            $valor_trm = floatval($row["ca_valor_trm"]);
            $valor_otr = floatval($row["ca_sancion"]) + floatval($row["ca_rescate"]);
            $valor_tot = floatval($row["ca_iva"]) + floatval($row["ca_arancel"]) + floatval($row["ca_compensa"]) + floatval($row["ca_antidump"]) + floatval($row["ca_salvaguarda"]) + $valor_otr;

            if ($numdeclaracion != $row["ca_numdeclaracion"]){
                $sum_array['vlr_fob'] = round($valor_tot, 0);
                $sum_array['vlr_iva'] = round(floatval($row["ca_iva"]), 0);
                $sum_array['arancel'] = round(floatval($row["ca_arancel"]), 0);
                $sum_array['compensa'] = round(floatval($row["ca_compensa"]), 0);
                $sum_array['otros'] = round($valor_otr, 0);
                $sum_array['antidump'] = round(floatval($row["ca_antidump"]), 0);
                $sum_array['salvaguarda'] = round(floatval($row["ca_salvaguarda"]), 0);
                $ctr_count = $row["ca_registros"];
            }
            if ($numdeclaracion != $row["ca_numdeclaracion"] and $numdeclaracion != null){
                if ($reportar){
                    $filename = $directory.DIRECTORY_SEPARATOR.'DI_'.$numdeclaracion.'.txt';
                    $handle = fopen($filename , 'w');
                    if (fwrite($handle, $salida) === FALSE) {
                        echo "No se puede escribir al archivo {filename}";
                        exit;
                    }
                }
                $reportar = true;
                $salida = '';
            }
            $ctr_count--;
            $orderComments = null;
            $numdeclaracion = $row["ca_numdeclaracion"];
            $salida.= "51"; // 1
            $salida.= str_pad(null,10, " "); // 2
            $salida.= " "; // 3
            $salida.= str_pad("900017447",10, " "); // 4
            $salida.= "8"; // 5
            $salida.= str_pad("830003960",10, " "); // 6
            $salida.= "0"; // 7

            $salida.= str_pad($numdeclaracion,30, " "); // 8
            $salida.= str_pad(null,10, " "); // 9
            $salida.= str_pad(null,2, " "); // 10

            list($anno,$mes,$dia) = sscanf(date("Y-m-d"),"%d-%d-%d");
            $emision = date("dmY", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $emision; // 11

            $vencimiento = date("dmY", mktime(0,0,0,$mes+1,5,$anno));
            $salida.= $vencimiento; // 12

            list($anno,$mes,$dia) = sscanf($row["ca_aceptacion_fch"],"%d-%d-%d");
            $aceptacion = date("dmY", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $aceptacion; // 13

            list($anno,$mes,$dia) = sscanf($row["ca_pago_fch"],"%d-%d-%d");
            $pago = date("dmY", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $pago; // 14

            $salida.= str_pad("COP",3, " "); // 15
            $salida.= str_pad(1, 15, "0", STR_PAD_LEFT); // 16

            $salida.= str_pad(number_format($valor_tot,2,'.',''), 15, "0", STR_PAD_LEFT); // 17
            $salida.= str_pad(number_format(floatval($row["ca_iva"]),2,'.',''), 15, "0", STR_PAD_LEFT); // 18
            $salida.= str_pad(number_format(floatval($row["ca_arancel"]),2,'.',''), 15, "0", STR_PAD_LEFT); // 19
            $salida.= str_pad(number_format(floatval($row["ca_compensa"]),2,'.',''), 15, "0", STR_PAD_LEFT); // 20
            $salida.= str_pad(number_format($valor_otr,2,'.',''), 15, "0", STR_PAD_LEFT); // 21
            $salida.= str_pad(number_format(floatval($row["ca_antidump"]),2,'.',''), 15, "0", STR_PAD_LEFT); // 22
            $salida.= str_pad(number_format(floatval($row["ca_salvaguarda"]),2,'.',''), 15, "0", STR_PAD_LEFT); // 23
            $salida.= str_pad(number_format(0,2,'.',''), 15, "0", STR_PAD_LEFT); // 24
            $salida.= str_pad(null,15, " "); // 25

            $valor_fob = floatval($row["ca_valor_fob"]) + floatval($row["ca_gastos_despacho"]) + floatval($row["ca_ajuste_valor"]);
            $valor_fle = floatval($row["ca_flete"]);
            $valor_seg = floatval($row["ca_seguro"]);
            $valor_gas = floatval($row["ca_gastos_embarque"]);

            $salida.= str_pad(number_format($valor_fob,2,'.',''), 15, "0", STR_PAD_LEFT); // 26
            $salida.= str_pad(number_format($valor_fle,2,'.',''), 15, "0", STR_PAD_LEFT); // 27
            $salida.= str_pad(number_format($valor_seg,2,'.',''), 15, "0", STR_PAD_LEFT); // 28

            $valor_cif = ($valor_fob + $valor_fle + $valor_seg);

            $salida.= str_pad(number_format($valor_cif,2,'.',''), 15, "0", STR_PAD_LEFT); // 29
            $salida.= str_pad(number_format($valor_gas,2,'.',''), 15, "0", STR_PAD_LEFT); // 30
            $salida.= str_pad(number_format($valor_cif + $valor_gas,2,'.',''), 15, "0", STR_PAD_LEFT); // 31
            $salida.= str_pad(substr($row["ca_iddoc"],0,15),20, " "); // 32
            $salida.= str_pad($row["ca_embarque"], 2, " "); // 33

            $factor = $row["ca_prorrateo_fob"] / $row["ca_valor_fob"];

            $sub_array['vlr_fob'] = round($valor_tot * $factor, 0);
            $sub_array['vlr_iva'] = round(floatval($row["ca_iva"]) * $factor, 0);
            $sub_array['arancel'] = round(floatval($row["ca_arancel"]) * $factor, 0);
            $sub_array['compensa'] = round(floatval($row["ca_compensa"]) * $factor, 0);
            $sub_array['otros'] = round($valor_otr * $factor, 0);
            $sub_array['antidump'] = round(floatval($row["ca_antidump"]) * $factor, 0);
            $sub_array['salvaguarda'] = round(floatval($row["ca_salvaguarda"]) * $factor, 0);

            foreach($sum_array as $key => $value){  // Descuenta los valores parciales del Valor Total
                $sum_array[$key]-= $sub_array[$key];
            }

            if ($ctr_count == 0){
                if ($sum_array['vlr_fob']!=0 and abs($sum_array['vlr_fob'])<=5){
                    $sub_array['vlr_fob']+= $sum_array['vlr_fob'];
                    $orderComments.= "Ajuste en Total :".$sum_array['vlr_fob']."\r\n";
                }else if (abs($sum_array['vlr_fob'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Total :".$sum_array['vlr_fob']."\r\n";
                }
                if ($sum_array['vlr_iva']!=0 and abs($sum_array['vlr_iva'])<=5){
                    $sub_array['vlr_iva']+= $sum_array['vlr_iva'];
                    $orderComments.= "Ajuste en IVA :".$sum_array['vlr_iva']."\r\n";
                }else if (abs($sum_array['vlr_iva'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en IVA :".$sum_array['vlr_iva']."\r\n";
                }
                if ($sum_array['arancel']!=0 and abs($sum_array['arancel'])<=5){
                    $sub_array['arancel']+= $sum_array['arancel'];
                    $orderComments.= "Ajuste en Arancel :".$sum_array['arancel']."\r\n";
                }else if (abs($sum_array['arancel'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Arancel :".$sum_array['arancel']."\r\n";
                }
                if ($sum_array['compensa']!=0 and abs($sum_array['compensa'])<=5){
                    $sub_array['compensa']+= $sum_array['compensa'];
                    $orderComments.= "Ajuste en Compesancion :".$sum_array['compensa']."\r\n";
                }else if (abs($sum_array['compensa'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Compensacion :".$sum_array['compensa']."\r\n";
                }
                if ($sum_array['otros']!=0 and abs($sum_array['otros'])<=5){
                    $sub_array['otros']+= $sum_array['otros'];
                    $orderComments.= "Ajuste en Otros :".$sum_array['otros']."\r\n";
                }elseif (abs($sum_array['otros'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Otros :".$sum_array['otros']."\r\n";
                }
                if ($sum_array['antidump']!=0 and abs($sum_array['antidump'])<=5){
                    $sub_array['antidump']+= $sum_array['antidump'];
                    $orderComments.= "Ajuste en Antidumping :".$sum_array['antidump']."\r\n";
                }else if (abs($sum_array['antidump'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Antidumping :".$sum_array['antidump']."\r\n";
                }
                if ($sum_array['salvaguarda']!=0 and abs($sum_array['salvaguarda'])<=5){
                    $sub_array['salvaguarda']+= $sum_array['salvaguarda'];
                    $orderComments.= "Ajuste en Salvaguarda :".$sum_array['salvaguarda']."\r\n";
                }else if (abs($sum_array['salvaguarda'])>5){
                    $reportar = false;
                    $orderComments.= "Diferencia en Salvaguarda :".$sum_array['salvaguarda']."\r\n";
                }
            }

            $salida.= str_pad(number_format($sub_array['vlr_fob'],2,'.',''), 15, "0", STR_PAD_LEFT); // 34
            $salida.= str_pad(number_format($sub_array['vlr_iva'],2,'.',''), 15, "0", STR_PAD_LEFT); // 35
            $salida.= str_pad(number_format($sub_array['arancel'],2,'.',''), 15, "0", STR_PAD_LEFT); // 36
            $salida.= str_pad(number_format($sub_array['compensa'],2,'.',''), 15, "0", STR_PAD_LEFT); // 37

            $salida.= str_pad(number_format($sub_array['otros'],2,'.',''), 15, "0", STR_PAD_LEFT); // 38
            $salida.= str_pad(number_format($sub_array['antidump'],2,'.',''), 15, "0", STR_PAD_LEFT); // 39
            $salida.= str_pad(number_format($sub_array['salvaguarda'],2,'.',''), 15, "0", STR_PAD_LEFT); // 40
            $salida.= str_pad(number_format(0,2,'.',''), 15, "0", STR_PAD_LEFT); // 41
            $salida.= str_pad(null,15, " "); // 42
            $salida.= str_pad(null,20, " "); // 43

            $spaces = array(15,15,15,15); // Campos del 42 al 47
            foreach( $spaces as $space ){
                    $salida.= str_pad(number_format(0,2,'.',''), $space, "0", STR_PAD_LEFT);
            }
            unset($space);
            $salida.= str_pad($row["ca_aceptacion_nro"],17, " "); // 48
            $salida.= "\r\n";

            $orderComments = ($orderComments==null)?"Archivo DI OK  ":$orderComments;
            $falaHeaderAdu = Doctrine::getTable("FalaHeaderAdu")->find ( $row["ca_iddoc"]);
            $falaHeaderAdu->setCaOrdenComments(substr($orderComments,0,strlen($orderComments)-2));
            $falaHeaderAdu->setCaProcesado(TRUE);
            $falaHeaderAdu->save();
        }

        if ($reportar){
            $filename = $directory.DIRECTORY_SEPARATOR.'DI_'.$numdeclaracion.'.txt';
            $handle = fopen($filename , 'w');
            if (fwrite($handle, $salida) === FALSE) {
                echo "No se puede escribir al archivo {filename}";
                exit;
            }
        }
        $this->redirect("falabellaAdu/list");

    }


	/*
	* Genera el archivo de facturacion
	*/
    public function executeGeneraFactura() {
        $referencia = base64_decode($this->getRequestParameter ( 'referencia' ));
        $stmt = FalaDeclaracionImpTable::facturacionNacionalizacion($referencia);

        $directory=sfConfig::get('app_falabella_output_adu');
        $numdocumento = null;
        $salida = '';
        $adicion= '';
        $acumula= array();
        $valor_carpeta = 0;
        $ctr_count = $chk_count = $stmt->rowCount();
        $chk_sum = 0;
        while ( $row = $stmt->fetch() ) {
            $chk_count--;
            if ($numdocumento != $row["ca_numdocumento"] and $numdocumento != null){
                $filename = $directory.DIRECTORY_SEPARATOR.'Fac_'.$numdocumento.'.txt';
                $handle = fopen($filename , 'w');
                if (fwrite($handle, $salida) === FALSE) {
                    echo "No se puede escribir al archivo {filename}";
                    exit;
                }
                $salida = '';
            }
            $numdocumento = $row["ca_numdocumento"];

            $salida.= "42"; // 1
            $salida.= "830003960 "; // 2
            $salida.= "0"; // 3
            $salida.= "900017447 "; // 4
            $salida.= "8"; // 5
            $salida.= str_pad($row["ca_numdocumento"],10, " "); // 6

            $salida.= str_pad(null,10, " "); // 7
            list($anno,$mes,$dia) = sscanf($row["ca_emision_fch"],"%d-%d-%d");
            $emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $emision; // 8
            list($anno,$mes,$dia) = sscanf($row["ca_vencimiento_fch"],"%d-%d-%d");
            $vencimiento = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $vencimiento; // 9
            $salida.= str_pad($row["ca_moneda"],3, " "); // 10
            $salida.= str_pad(floatval($row["ca_tipo_cambio"]), 10, "0", STR_PAD_LEFT); // 11

            $vlr_afecto = floatval($row["ca_afecto_vlr"]);
            $vlr_iva = floatval($row["ca_iva_vlr"]);
            $vlr_exento = floatval($row["ca_exento_vlr"]);
            $vlr_total  = $vlr_afecto + $vlr_iva + $vlr_exento;

            $salida.= str_pad($vlr_total, 10, "0", STR_PAD_LEFT); // 12
            $salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 13
            $salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 14
            $salida.= str_pad("18",5, " "); // 15
            $salida.= str_pad(substr($row["ca_iddoc"],0,15),20, " "); // 16
            $salida.= str_pad($row["ca_embarque"], 2, " "); // 17

            $factor = $row["ca_prorrateo_fob"] / $row["ca_valor_fob"];
            $valor_carpeta = round($vlr_total * $factor,0);
            $chk_sum+= $valor_carpeta;

            if ($chk_count == 0 and abs($chk_sum-$vlr_total) > 0 and abs($chk_sum-$vlr_total) <= 5 ){ // Tolerancia de 5 pesos de diferencia
                $valor_carpeta-= $chk_sum-$vlr_total;
            }
            $salida.= str_pad($valor_carpeta, 10, "0", STR_PAD_LEFT); // 18

            $spaces = array(8,30,30,4,20,20,10); // Campos del 19 al 27
            foreach( $spaces as $space ) {
                $salida.= str_pad(null,$space, " ");
            }

            $salida.= str_pad($vlr_exento, 10, "0", STR_PAD_LEFT); // 28
            $salida.= str_pad("650_BOG_DIRECCION_GENERAL", 30, " "); // 29
            $salida.= "\r\n";

            if(!isset($acumula[$row["ca_numdocumento"]])){
/*
                if($vlr_exento != 0){
                    $adicion.= "11"; // 1
                    $adicion.= "830003960"; // 2
                    $adicion.= "900017447 "; // 3
                    $adicion.= str_pad($row["ca_numdocumento"],10, " "); // 4
                    $adicion.= str_pad("006",50, " "); // 5 Concepto de Afecto y Exento
                    $adicion.= str_pad($vlr_exento, 10, "0", STR_PAD_LEFT); // 6
                    $adicion.= "\r\n";
                }

                $adicion.= "12"; // 1
                $adicion.= "830003960"; // 2
                $adicion.= "900017447 "; // 3
                $adicion.= str_pad($row["ca_numdocumento"],10, " "); // 4
                $adicion.= str_pad("006",50, " "); // 5 Concepto de Retención en la Fuente
                $adicion.= str_pad(0, 10, "0", STR_PAD_LEFT); // 6  $vlr_afecto Se deja en 0 por ser autoretenedores
                $adicion.= "\r\n";
*/
                $adicion.= "13"; // 1
                $adicion.= "830003960"; // 2
                $adicion.= "900017447 "; // 3
                $adicion.= str_pad($row["ca_numdocumento"],10, " "); // 4
                $adicion.= str_pad("002",50, " "); // 5 Concepto del IVA
                $adicion.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 6
                $adicion.= "\r\n";
                $acumula[$row["ca_numdocumento"]] = $adicion;
            }
        }


        foreach($acumula as $key => $value){
            $salida.= $value;
        }

        $filename = $directory.DIRECTORY_SEPARATOR.'Fac_'.$numdocumento.'.txt';
        $handle = fopen($filename , 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {filename}";
            exit;
        }

        $stmt = FalaDeclaracionImpTable::notaAgenteNacionalizacion($referencia);

        $numdocumento = null;
        $iddoc = null;
        $adicion = '';
        $salida= '';
        $acumula= array();
        $chk_doc = $chk_sum = 0;
        $chk_count = 0;
        $valor_carpeta = 0;
        $prorrateos = array();
        while ( $row = $stmt->fetch() ) {
            $chk_count++;
            if ($numdocumento != $row["ca_numdocumento"] and $numdocumento != null){
                $filename = $directory.DIRECTORY_SEPARATOR.'Not_'.$numdocumento.'.txt';
                $handle = fopen($filename , 'w');
                if (fwrite($handle, $adicion) === FALSE) {
                    echo "No se puede escribir al archivo {filename}";
                    exit;
                }
            }
            $adicion = '';
            $numdocumento = $row["ca_numdocumento"];
            $factor = $row["ca_prorrateo_fob"] / $row["ca_valor_fob"];

            if (!isset($acumula[$row["ca_iddoc"]])){
                $adicion.= "01"; // 1
                $adicion.= "830003960"; // 2
                $adicion.= "900017447 "; // 3
                $adicion.= str_pad($row["ca_numdocumento"], 7, " "); // 4
                $adicion.= str_pad(1, 7, "0", STR_PAD_LEFT); // 5
                $adicion.= str_pad(null,2, " "); // 6
                $adicion.= str_pad($row["ca_embarque"], 8, " "); // 7
                list($anno,$mes,$dia) = sscanf($row["ca_emision_fch"],"%d-%d-%d");
                $emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
                $adicion.= $emision; // 8

                $spaces = array(25,3,15,20); // Campos del 9 al 12
                foreach( $spaces as $space ) {
                    $adicion.= str_pad(null,$space, " ");
                }

                $adicion.= str_pad(floatval($row["ca_vlrdocumento"]), 10, "0", STR_PAD_LEFT); // 13

                $spaces = array(4,10,4); // Campos del 14 al 16
                foreach( $spaces as $space ) {
                    $adicion.= str_pad(0,$space, "0");
                }

                $adicion.= str_pad(intval($row["ca_tipo_cambio"]), 4, "0", STR_PAD_LEFT); // 17

                $spaces = array(4,10); // Campos del 18 al 19
                foreach( $spaces as $space ) {
                    $adicion.= str_pad(0,$space, "0");
                }

                $total_documento = floatval($row["ca_vlrdocumento"]);
                $adicion.= str_pad($total_documento, 10, "0", STR_PAD_LEFT); // 20

                $spaces = array(10,10,3); // Campos del 21 al 23
                foreach( $spaces as $space ) {
                    $adicion.= str_pad(0,$space, "0");
                }

                $adicion.= str_pad(substr($row["ca_iddoc"],0,15),20, " "); // 24

                $valor_documento = round(floatval($row["ca_vlrdocumento"]) * $factor,0);
                $chk_doc+= $valor_documento;

                if (($chk_count%$ctr_count)==0){
                    if (abs($chk_doc-$total_documento) > 0 and abs($chk_doc-$total_documento) <= 5){ // Tolerancia de 5 pesos de diferencia
                        $valor_documento-= $chk_doc-$total_documento;
                    }
                    $chk_doc = 0;
                }
                $adicion.= str_pad($valor_documento, 10, "0", STR_PAD_LEFT); // 25
                $adicion.= "\r\n";

                $acumula[$row["ca_iddoc"]] = $adicion;
            }

            $salida.= "04"; // 1
            $salida.= "830003960"; // 2
            $salida.= "900017447 "; // 3
            $salida.= str_pad($row["ca_numdocumento"], 7, " "); // 4
            $salida.= str_pad(floatval($row["ca_idconcepto"]),50, " "); // 5

            $spaces = array(10,4,10,4); // Campos del 6 al 9
            foreach( $spaces as $space ) {
                $salida.= str_pad(0,$space, "0");
            }

            $salida.= str_pad($row["ca_factura_ter"],20, " "); // 10
            $salida.= str_pad($row["ca_nit_ter"],10, " "); // 11

            list($anno,$mes,$dia) = sscanf($row["ca_factura_fch"],"%d-%d-%d");
            $emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
            $salida.= $emision; // 12
            $salida.= str_pad(floatval($row["ca_factura_vlr"]), 10, "0", STR_PAD_LEFT); // 13
            $salida.= str_pad(floatval($row["ca_factura_iva"]), 10, "0", STR_PAD_LEFT); // 14

            $tot_doc = floatval($row["ca_factura_vlr"])+floatval($row["ca_factura_iva"]);
            $salida.= str_pad($tot_doc, 10, "0", STR_PAD_LEFT); // 15
            $salida.= str_pad($row["ca_tipo"],1, " "); // 16
            $salida.= str_pad(0, 10, "0", STR_PAD_LEFT); // 17
            $salida.= str_pad(substr($row["ca_iddoc"],0,15),20, " "); // 18
            $salida.= str_pad($row["ca_embarque"], 2, " "); // 19

            $valor_carpeta = round($tot_doc * $factor,0);
            echo "<br />",$valor_carpeta;
            $prorrateos[$row["ca_factura_ter"]]+= $valor_carpeta;

            if (($chk_count%$ctr_count)==0){
                $prorrateos[$row["ca_factura_ter"]]-= $tot_doc;
                $valor_carpeta-= $prorrateos[$row["ca_factura_ter"]];
            }

            $salida.= str_pad($valor_carpeta, 15, "0", STR_PAD_LEFT); // 20
            $salida.= "\r\n";
        }

        foreach($acumula as $key => $value){
            $salida = $value.$salida;
        }

        $filename = $directory.DIRECTORY_SEPARATOR.'Not_'.$numdocumento.'.txt';
        $handle = fopen($filename , 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {filename}";
            exit;
        }
        $this->redirect("falabellaAdu/list");
    }



	/*
	* Genera el archivo de salida
	*/
    public function executeGenerarArchivo()
    {
        $fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
        $this->forward404Unless($fala_header);
        $c = new Criteria();
        $c->addAscendingOrderByColumn( FalaDetailPeer::CA_SKU );
        $details = $fala_header->getFalaDetails($c);

        $status = $reporte->getUltimoStatus();
        $salida = '';
        foreach( $details as $detail ) {
            $salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 1
            $salida.= $fala_header->getCaArchivoOrigen()."|"; // Archivo de Origen 2
            $salida.= "ASN|"; // 3
            $salida.= "COL|"; // 4
            $salida.= "|"; // Correlativo Coltrans 5
            $salida.= (($reporte->getcaTransporte() != 'Aéreo')?"MB":"AW")."|"; // 6
            $salida.= $reporte->getDoctransporte()."|"; // 7
            $salida.= "|"; // Contact 8  /blanco
            $salida.= "|"; // Contact Number 9
            $salida.= "|"; // Lloyd  10
            $salida.= (($reporte->getcaTransporte() == "Aéreo")?"AIR":$reporte->getIdnave() )."|"; // Vessel 11
            $salida.= $fala_header->getCaNumViaje()."|"; // NÃºmero de Viaje 12
            $salida.= "COLT|"; // Carrier 13
            $salida.= (($reporte->getcaTransporte() == "Aéreo")?"L":"")."|"; // Vessel 14
            $salida.= (($reporte->getcaTransporte() == "Aéreo")?"A":"S")."|"; // Vessel 15
            $salida.= "UN|"; // Vessel 16
            $salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 17
            $salida.= "UN|"; // Vessel 18
            $salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 19
            $salida.= "UN|"; // Vessel 20
            $salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 21
            $salida.= "UN|"; // Vessel 22
            $salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 23

            $ets_mem= (strlen(trim($reporte->getETS("Ymd")))==0 and $status)?$status->getCaFchsalida("Ymd"):$reporte->getETS("Ymd");
            $eta_mem= (strlen(trim($reporte->getETA("Ymd")))==0 and $status)?$status->getCaFchllegada("Ymd"):$reporte->getETA("Ymd");
            $salida.= $ets_mem."|"; // 24
            $salida.= $ets_mem."|"; // 25
            $salida.= $eta_mem."|"; // 26
            $salida.= $eta_mem."|"; // 27

            $salida.= str_replace("-","",$detail->getCaNumContPart1())."|"; // Id Cont 4 Car  28
            $salida.= str_replace("-","",$detail->getCaNumContPart2())."|"; // Id Cont 10 Car  29
            $salida.= $detail->getCaNumContSell()."|"; // Sello de Cont Car  30
            $salida.= $detail->getCaContainerIso()."|"; // Cod ISO 31
            $salida.= (($reporte->getcaTransporte() != "Aéreo")?$fala_header->getCaContainerMode():"")."|"; // Container Mode 32
            $salida.= (($reporte->getcaTransporte() == "Aéreo")?"AIR":"")."|"; // Vessel 33
            $salida.= "|"; // 34
            $salida.= "|"; // 35
            $salida.= "|"; // 36
            $salida.= substr($fala_header->getCaIddoc(),0,15)."|"; // 37
            $salida.= $fala_header->getCaFechaCarpeta("Ymd")."|"; // 38
            $salida.= $detail->getSkuNeto()."|"; // 39
            $salida.= $detail->getCaVpn()."|"; // 40
            $salida.= number_format($detail->getCaCantidadMiles()*10000, 0, '', '')."|"; // 41
            $salida.= $detail->getCaUnidadMedidadCantidad()."|"; // 42
            $salida.= $detail->getCaDescripcionItem()."|"; // 43
            $salida.= number_format($detail->getCaCantidadPaquetesMiles()*10000, 0, '', '')."|"; // 44
            $salida.= $detail->getCaUnidadMedidaPaquetes()."|"; // 45
            $salida.= number_format($detail->getCaCantidadVolumenMiles()*10000, 0, '', '')."|"; // 46
            $salida.= $detail->getCaUnidadMedidaVolumen()."|"; // 47
            $salida.= number_format($detail->getCaCantidadPesoMiles()*10000, 0, '', '')."|"; // 48
            $salida.= $detail->getCaUnidadMedidaPeso()."|"; // 49
            $salida.= "01-01|"; // Vessel 50
            $salida.= "|"; // 51
            $salida.= "|"; // 52
            $salida.= "|"; // 53
            $salida.= "|"; // 54
            $salida.= "UN|"; // Vessel 55
            $salida.= $fala_header->getCaCodigoPuertoPickup()."|"; // 56
            $salida.= "UN|"; // Vessel 57
            $salida.= $fala_header->getCaCodigoPuertoDescarga()."|"; // 58
            $salida.= $fala_header->getCaNombreProveedor()."|"; // 59
            $salida.= $fala_header->getCaCampo59()."|";// 60
            $salida.= $fala_header->getCaCodigoProveedor()."|"; // 61
            $salida.= $fala_header->getCaCampo61()."|";// 62
            $salida.= number_format($fala_header->getCaMontoInvoiceMiles()*10000, 0, '', '')."|";// 63
            $salida.= $fala_header->getCaProformaNumber();// 64
            $salida.= "\r\n";
        }
        $directory=sfConfig::get('app_falabellaAdu_outputfac');
        $filename = $directory.DIRECTORY_SEPARATOR.'ASN'.date('ymdHis').'.txt';
        $handle = fopen($filename , 'w');

        if (fwrite($handle, $salida) === FALSE) {
            echo "No se puede escribir al archivo {filename}";
            exit;
        }else {
            $fala_header->setCaProcesado(true);
            $fala_header->save();
        }
        $this->redirect("falabellaAdu/list");
    }


    public function executeEnviarEmail() {
        $this->setLayout("ajax");
        $content  = sfContext::getInstance()->getController()->getPresentationFor( 'falabellaAdu', 'shippingInstructions', 'email') ;

        $user = $this->getUser();

        //Crea el correo electronico
        $email = new Email();
        $email->setCaFchenvio( date("Y-m-d H:i:s") );
        $email->setCaUsuenvio( $user->getUserId() );
        $email->setCaTipo( "Fal Shipping Inst." );
        $email->setCaIdcaso( substr(-20,20,base64_decode($this->getRequestParameter('iddoc'))) );
        $email->setCaFrom( $user->getEmail() );
        $email->setCaFromname( $user->getNombre() );

        if( $this->getRequestParameter("readreceipt") ) {
            $email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
        }

        $email->setCaReplyto( $user->getEmail() );

        $recips = explode(",",$this->getRequestParameter("destinatario"));
        if( is_array($recips) ) {
            foreach( $recips as $recip ) {
                $recip = str_replace(" ", "", $recip );
                if( $recip ) {
                    $email->addTo( $recip );
                }
            }
        }

        $recips =  explode(",",$this->getRequestParameter("cc")) ;
        if( is_array($recips) ) {
            foreach( $recips as $recip ) {
                $recip = str_replace(" ", "", $recip );
                if( $recip ) {
                    $email->addCc( $recip );
                }
            }
        }

        $email->addCc( $this->getUser()->getEmail() );
        $email->setCaSubject( $this->getRequestParameter("asunto") );
        $email->setCaBody( $this->getRequestParameter("mensaje")."<br />".$content );

        $email->save(); //guarda el cuerpo del mensaje
        /*$this->error = $email->send();
        if($this->error) {
            $this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
        }*/
    }

    /*
     * Panel de Declararion
     */
    public function executeObservePanelDeclaracion( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $item = $request->getParameter("item");

        $declaracionDts = Doctrine::getTable("FalaDeclaracionDts")->find(array($referencia, $item));
        if( $declaracionDts ){
            if( $this->getRequestParameter ( 'numdeclaracion' )!==null ) {
                $declaracionDts->setCaNumdeclaracion( $this->getRequestParameter ( 'numdeclaracion' ) );
            }

            if( $this->getRequestParameter ( 'emision_fch' )!==null ) {
                $declaracionDts->setCaEmisionFch( $this->getRequestParameter ( 'emision_fch' ) );
            }

            if( $this->getRequestParameter ( 'vencimiento_fch' )!==null ) {
                $declaracionDts->setCaVencimientoFch( $this->getRequestParameter ( 'vencimiento_fch' ) );
            }

            if( $this->getRequestParameter ( 'aceptacion_nro' )!==null ) {
                $declaracionDts->setCaAceptacionNro( $this->getRequestParameter ( 'aceptacion_nro' ) );
            }

            if( $this->getRequestParameter ( 'aceptacion_fch' )!==null ) {
                $declaracionDts->setCaAceptacionFch( $this->getRequestParameter ( 'aceptacion_fch' ) );
            }

            if( $this->getRequestParameter ( 'pago_fch' )!==null ) {
                $declaracionDts->setCaPagoFch( $this->getRequestParameter ( 'pago_fch' ) );
            }

            if( $this->getRequestParameter ( 'salvaguarda_porcntj' )!==null ) {
                $declaracionDts->setCaSalvaguardaPorcntj( $this->getRequestParameter ( 'salvaguarda_porcntj' ) );
            }

            if( $this->getRequestParameter ( 'salvaguarda' )!==null ) {
                $declaracionDts->setCaSalvaguarda( $this->getRequestParameter ( 'salvaguarda' ) );
            }

            if( $this->getRequestParameter ( 'compensa_porcntj' )!==null ) {
                $declaracionDts->setCaCompensaPorcntj( $this->getRequestParameter ( 'compensa_porcntj' ) );
            }

            if( $this->getRequestParameter ( 'compensa' )!==null ) {
                $declaracionDts->setCaCompensa( $this->getRequestParameter ( 'compensa' ) );
            }

            if( $this->getRequestParameter ( 'antidump_porcntj' )!==null ) {
                $declaracionDts->setCaAntidumpPorcntj( $this->getRequestParameter ( 'antidump_porcntj' ) );
            }

            if( $this->getRequestParameter ( 'antidump' )!==null ) {
                $declaracionDts->setCaAntidump( $this->getRequestParameter ( 'antidump' ) );
            }

            $declaracionDts->save();
            $this->responseArray["success"]=true;
        }

        $this->setTemplate("responseTemplate");
    }

    /*
     * Panel de facturacion
     */
    public function executeObservePanelFacturacion( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("olddocumento");

        $factura = Doctrine::getTable("FalaFacturacionAdu")->find(array($referencia, $numdocumento));
        if( !$factura ){
            $factura = new FalaFacturacionAdu();
            $factura->setCaReferencia( $referencia );
        }
        if( $this->getRequestParameter ( 'numdocumento' ) ) {
            $factura->setCaNumdocumento( $this->getRequestParameter ( 'numdocumento' ) );
        }
        if( $this->getRequestParameter ( 'emision_fch' ) ) {
            $factura->setCaEmisionFch( $this->getRequestParameter ( 'emision_fch' ) );
        }
        if( $this->getRequestParameter ( 'vencimiento_fch' ) ) {
            $factura->setCaVencimientoFch( $this->getRequestParameter ( 'vencimiento_fch' ) );
        }
        if( $this->getRequestParameter ( 'moneda' ) ) {
            $factura->setCaMoneda( $this->getRequestParameter ( 'moneda' ) );
        }
        if( $this->getRequestParameter ( 'tipo_cambio' ) ) {
            $factura->setCaTipoCambio( $this->getRequestParameter ( 'tipo_cambio' ) );
        }
        if( $this->getRequestParameter ( 'afecto_vlr' ) ) {
            $factura->setCaAfectoVlr( $this->getRequestParameter ( 'afecto_vlr' ) );
        }
        if( $this->getRequestParameter ( 'iva_vlr' ) ) {
            $factura->setCaIvaVlr( $this->getRequestParameter ( 'iva_vlr' ) );
        }
        if( $this->getRequestParameter ( 'exento_vlr' ) ) {
            $factura->setCaExentoVlr( $this->getRequestParameter ( 'exento_vlr' ) );
        }
        $factura->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }


    public function executeEliminarFactura( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaFacturacionAdu")->find(array($referencia, $numdocumento));
        if( $factura )
        {
            $factura->delete();
        }
        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }

     /*
     * Panel de Notas
     */
    public function executeObservePanelNotasCab( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaNotaCab")->find(array($referencia, $numdocumento));
        if( !$factura ){
            $factura = new FalaNotaCab();
            $factura->setCaReferencia( $referencia );
            $factura->setCaNumdocumento( $numdocumento );
        }
        if( $this->getRequestParameter ( 'emision_fch' ) ) {
            $factura->setCaEmisionFch( $this->getRequestParameter ( 'emision_fch' ) );
        }
        if( $this->getRequestParameter ( 'vlrdocumento' ) ) {
            $factura->setCaVlrdocumento( $this->getRequestParameter ( 'vlrdocumento' ) );
        }
        if( $this->getRequestParameter ( 'tipo_cambio' ) ) {
            $factura->setCaTipoCambio( $this->getRequestParameter ( 'tipo_cambio' ) );
        }
        $factura->save();

        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }

    public function executeNotaCab( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");

        $factura = Doctrine::getTable("FalaNotaCab")->find(array($referencia, $numdocumento));
        if( $factura )
        {
            $factura->delete();
        }

        $this->responseArray["success"]=true;

        $this->setTemplate("responseTemplate");
    }

    public function executePanelNotasDetData( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");
        $facturas = array();
        if( $numdocumento ){
        $facturas = Doctrine::getTable("FalaNotaDet")
                    ->createQuery("d")
                    ->select("d.*")
                    ->where("d.ca_referencia = ? AND d.ca_numdocumento = ?",array($referencia, $numdocumento))
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $facturas[] = array("d_ca_concepto"=>"", "d_ca_numdocumento"=>$numdocumento, "orden"=>"Z");
        }
        $this->responseArray["root"]=$facturas;
        $this->responseArray["success"]=true;

        $this->setTemplate("responseTemplate");
    }

    public function executeObservePanelNotasDet( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");
        $idconcepto = $request->getParameter("idconcepto");
        $detalle = Doctrine::getTable("FalaNotaDet")->find(array($referencia, $numdocumento, $idconcepto));

        if (!$detalle){
            $detalle = new FalaNotaDet();
            $detalle->setCaReferencia( $referencia );
            $detalle->setCaNumdocumento( $numdocumento );
            $detalle->setCaIdconcepto( $idconcepto );
        }

        if( $this->getRequestParameter ( 'nit_ter' ) ) {
            $detalle->setCaNitTer( $this->getRequestParameter ( 'nit_ter' ) );
        }
        if( $this->getRequestParameter ( 'tipo' ) ) {
            $detalle->setCaTipo( $this->getRequestParameter ( 'tipo' ) );
        }
        if( $this->getRequestParameter ( 'factura_ter' ) ) {
            $detalle->setCaFacturaTer( $this->getRequestParameter ( 'factura_ter' ) );
        }
        if( $this->getRequestParameter ( 'factura_fch' ) ) {
            $detalle->setCaFacturaFch( $this->getRequestParameter ( 'factura_fch' ) );
        }
        if( $this->getRequestParameter ( 'factura_vlr' ) ) {
            $detalle->setCaFacturaVlr( $this->getRequestParameter ( 'factura_vlr' ) );
        }
        if( $this->getRequestParameter ( 'factura_iva' ) ) {
            $detalle->setCaFacturaIva( $this->getRequestParameter ( 'factura_iva' ) );
        }
        $detalle->save();

        $this->responseArray["idconcepto"]=$detalle->getCaIdconcepto();
        $this->responseArray["success"]=true;
        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarPanelNotasDet( sfWebRequest $request ){
        $this->responseArray=array("success"=>false, "id"=>$request->getParameter("id"));

        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");
        $idconcepto = $request->getParameter("idconcepto");

        $detalle = Doctrine::getTable("FalaNotaDet")->find(array($referencia, $numdocumento, $idconcepto));
        if( $detalle )
        {
            $detalle->delete();
        }

        $this->responseArray["success"]=true;

        $this->setTemplate("responseTemplate");
    }

    public function executeEliminarNotaCab( sfWebRequest $request ){
        $id = $request->getParameter("id");
        $referencia = base64_decode($request->getParameter("referencia"));
        $numdocumento = $request->getParameter("numdocumento");

        $this->forward404Unless( $referencia );
        $this->forward404Unless( $numdocumento );
//        echo $referencia. "--".$numdocumento;
        try
        {
            $factura = Doctrine::getTable("FalaNotaCab")->find(array($referencia, $numdocumento));
//            echo "<br>c:".count($factura);
            if($factura)
            {
                $factura->getCaReferencia();
                $factura->delete();
                $this->responseArray=array("success"=>true,"id"=>$id);
            }
            else
                $this->responseArray=array("success"=>false,"err"=>"Registro no encontrado");
        }
        catch(Exception $e)
        {
  //          echo $e->getMessage();
            $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
        }
//        $this->responseArray=array("success"=>true);
//        print_r($this->responseArray);
//        exit;

        $this->setTemplate("responseTemplate");
    }

}
?>
