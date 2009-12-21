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
	public function executeIndex()
        {
		return $this->forward ( 'falabellaAdu', 'list' );
	}

	/*
	* Lista los PO disponibles
	*/
	public function executeList()
        {
		$this->fala_headers = Doctrine::getTable("FalaHeaderAdu")
                                        ->createQuery("f")
                                        ->leftJoin("f.FalaDeclaracionImp d")
                                        ->addOrderBy("f.ca_fecha_carpeta")
                                        ->execute();
	}

	/*
	* Permite ver las intrucciones de embarque
	*/
	public function executeShippingInstructions()
        {
		$this->header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($this->header);
		$this->instructions = $this->header->getFalaInstruction();
		$this->info = $this->header->getFalaShipmentInfo();
	}


	/*
	* Permite ver los detalles del PO y confirmar los datos para generar el archivo de salida
	*/
	public function executeDetails()
        {
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
	public function executeDeclaracion()
        {
                $this->fala_declaracion = Doctrine::getTable("FalaDeclaracionImp")
                                                   -> createQuery("d")
                                                   ->where ( "d.ca_referencia = ?",base64_decode($this->getRequestParameter ( 'referencia' )) )
                                                   ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                                   ->execute();
		$this->forward404Unless($this->fala_declaracion);
                $this->fala_detallesimp = Doctrine::getTable("FalaDeclaracionDts")
                                                   -> createQuery("d")
                                                   ->where ( "d.ca_referencia = ?",base64_decode($this->getRequestParameter ( 'referencia' )) )
                                                   ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                                   ->execute();
                                                   
		$response = sfContext::getInstance()->getResponse();
                $response->addJavaScript("extExtras/LockingGridView",'last');
                $response->addStylesheet("extExtras/LockingGridView",'last');
	}


	/*
	* Guarda los cambios en el encabezado del documento
	*/
	public function executeObserveHeader()
        {
		$fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);

		if( $this->getRequestParameter ( 'referencia' )!==null ){
			$fala_header->setCaReferencia( $this->getRequestParameter ( 'referencia' ) );
                }

		$fala_header->save();

                $this->responseArray=array("success"=>true);
                $this->setTemplate("responseTemplate");
	}


	/*
	* Guarda los cambios en el encabezado de la Declaración de Importación
	*/
	public function executeObserveDeclaracion()
        {
                $fala_declaracion = Doctrine::getTable("FalaDeclaracionImp")->find ( $this->getRequestParameter ( 'referencia' ) );
		$this->forward404Unless($fala_declaracion);
                
                $this->responseArray=array("id"=>$this->getRequestParameter('id'), "success"=>false);

		if( $this->getRequestParameter ( 'numdeclaracion' )!==null ){
			$fala_declaracion->setCaNumdeclaracion( $this->getRequestParameter ( 'numdeclaracion' ) );
                }

		if( $this->getRequestParameter ( 'numinternacion' )!==null ){
			$fala_declaracion->setCaNuminternacion( $this->getRequestParameter ( 'numinternacion' ) );
                }

		if( $this->getRequestParameter ( 'emision_fch' )!==null ){
			$fala_declaracion->setCaEmisionFch( $this->getRequestParameter ( 'emision_fch' ) );
                }

		if( $this->getRequestParameter ( 'vencimiento_fch' )!==null ){
			$fala_declaracion->setCaVencimientoFch( $this->getRequestParameter ( 'vencimiento_fch' ) );
                }

		if( $this->getRequestParameter ( 'aceptacion_fch' )!==null ){
			$fala_declaracion->setCaAceptacionFch( $this->getRequestParameter ( 'aceptacion_fch' ) );
                }

		if( $this->getRequestParameter ( 'pago_fch' )!==null ){
			$fala_declaracion->setCaPagoFch( $this->getRequestParameter ( 'pago_fch' ) );
                }

		$fala_declaracion->save();

                $this->responseArray["success"]=true;
                $this->setTemplate("responseTemplate");
	}


	/*
	* Guarda los cambios en el detalle del documento
	*/
        public function executeObserveDetail()
        {
            $faladetail = Doctrine::getTable("FalaDetailAdu")->find(array( $this->getRequestParameter ( 'iddoc' ), $this->getRequestParameter ( 'sku' ) ) ) ;
            $this->forward404Unless($faladetail);

            $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

            if( $this->getRequestParameter ( 'subpartida' ) ) {
                $faladetail->setCaSubpartida( $this->getRequestParameter ( 'subpartida' ) );
            }

            if( $this->getRequestParameter ( 'descripcion_item' ) ) {
                $faladetail->setCaDescripcionItem( $this->getRequestParameter ( 'descripcion_item' ) );
            }

            if( $this->getRequestParameter ( 'descripcion_mcia' ) ) {
                $faladetail->setCaDescripcionMcia( $this->getRequestParameter ( 'descripcion_mcia' ) );
            }

            if( $this->getRequestParameter ( 'preinspeccion' ) ) {
                $faladetail->setCaPreinspeccion( $this->getRequestParameter ( 'preinspeccion' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_pedido' ) ) {
                $faladetail->setCaCantidadPedido( $this->getRequestParameter ( 'cantidad_pedido' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_dav' ) ) {
                $faladetail->setCaCantidadDav( $this->getRequestParameter ( 'cantidad_dav' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_dim' ) ) {
                $faladetail->setCaCantidadDim( $this->getRequestParameter ( 'cantidad_dim' ) );
            }

            if( $this->getRequestParameter ( 'valor_fob' ) ) {
                $faladetail->setCaValorFob( $this->getRequestParameter ( 'valor_fob' ) );
            }

            if( $this->getRequestParameter ( 'radicado_num' ) ) {
                $faladetail->setCaRadicadoNum( $this->getRequestParameter ( 'radicado_num' ) );
            }

            if( $this->getRequestParameter ( 'registro_num' ) ) {
                $faladetail->setCaRegistroNum( $this->getRequestParameter ( 'registro_num' ) );
            }

            if( $this->getRequestParameter ( 'unidad_comercial' ) ) {
                $faladetail->setCaUnidadComercial( $this->getRequestParameter ( 'unidad_comercial' ) );
            }

            if( $this->getRequestParameter ( 'marca' ) ) {
                $faladetail->setCaMarca( $this->getRequestParameter ( 'marca' ) );
            }

            if( $this->getRequestParameter ( 'tipo' ) ) {
                $faladetail->setCaTipo( $this->getRequestParameter ( 'tipo' ) );
            }

            if( $this->getRequestParameter ( 'clase' ) ) {
                $faladetail->setCaClase( $this->getRequestParameter ( 'clase' ) );
            }

            if( $this->getRequestParameter ( 'modelo' ) ) {
                $faladetail->setCaModelo( $this->getRequestParameter ( 'modelo' ) );
            }

            if( $this->getRequestParameter ( 'ano' ) ) {
                $faladetail->setCaAno( $this->getRequestParameter ( 'ano' ) );
            }

            if( $this->getRequestParameter ( 'factura_nro' ) ) {
                $faladetail->setCaFacturaNro( $this->getRequestParameter ( 'factura_nro' ) );
            }

            if( $this->getRequestParameter ( 'factura_fch' ) ) {
                $faladetail->setCaFacturaFch( $this->getRequestParameter ( 'factura_fch' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_paquetes_miles' ) ) {
                $faladetail->setCaCantidadPaquetesMiles( $this->getRequestParameter ( 'cantidad_paquetes_miles' ) );
            }

            if( $this->getRequestParameter ( 'unidad_medida_paquetes' ) ) {
                $faladetail->setCaUnidadMedidaPaquetes( $this->getRequestParameter ( 'unidad_medida_paquetes' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_peso_miles' ) ) {
                $faladetail->setCaCantidadPesoMiles( $this->getRequestParameter ( 'cantidad_peso_miles' ) );
            }

            if( $this->getRequestParameter ( 'unidad_medida_peso' ) ) {
                $faladetail->setCaUnidadMedidaPeso( $this->getRequestParameter ( 'unidad_medida_peso' ) );
            }

            if( $this->getRequestParameter ( 'cantidad_volumen_miles' ) ) {
                $faladetail->setCaCantidadVolumenMiles( $this->getRequestParameter ( 'cantidad_volumen_miles' ) );
            }

            if( $this->getRequestParameter ( 'unidad_medida_volumen' ) ) {
                $faladetail->setCaUnidadMedidaVolumen( $this->getRequestParameter ( 'unidad_medida_volumen' ) );
            }

            $faladetail->save();

            $this->responseArray["success"]=true;
            $this->setTemplate("responseTemplate");
        }


	/*
	* Permite anular la Orden de Pedido
	*/
	public function executeAnularOrden()
        {
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
	public function executeDuplicateRecord()
        {
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
		foreach( $faladetails as $detail ){
			if ($detail->getCaCantidadMiles() < $detail->getCaCantidadPedido()){
				$new_faladetail = $detail->copy(FALSE);
				$new_faladetail->setCaIddoc($doc_mem);
				$new_faladetail->setCaSku($detail->getCaSku());
				$new_faladetail->setCaCantidadPedido($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
				$new_faladetail->setCaCantidadMiles($detail->getCaCantidadPedido() - $detail->getCaCantidadMiles());
				$new_faladetail->save();
			}
		}
		$falashippings = $fala_header->getFalaShipmentInfos();
		foreach( $falashippings as $shipping ){
			$new_shipping = $shipping->copy(FALSE);
			$new_shipping->setCaIddoc($doc_mem);
			$new_shipping->save();
		}
		$this->redirect("falabellaAdu/generarArchivo?iddoc=".$this->getRequestParameter ( 'iddoc' ));
		return sfView::NONE;
	}


	/*
	* Genera el archivo de salida para Aprocom
	*/
	public function executeGeneraAprocom()
        {
		$doc_mem = base64_decode($this->getRequestParameter ( 'iddoc' ));
		$fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( $doc_mem );
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
                    $salida.= $i++."|"; //1
                    $salida.= $fala_detail["h_ca_referencia"]."|"; // 2
                    $salida.= $fala_detail["d_ca_sku"]."|"; // 3
                    $salida.= $fala_detail["d_ca_referencia_prov"]."|"; // 4
                    $salida.= $fala_detail["d_ca_subpartida"]."|"; // 5
                    $salida.= $fala_detail["d_ca_descripcion_item"]."|"; // 6
                    $salida.= $fala_detail["d_ca_descripcion_mcia"]."|"; // 7
                    $salida.= $fala_detail["d_ca_preinspeccion"]."|"; // 8
                    $salida.= $fala_detail["d_ca_cantidad_dav"]."|"; // 9
                    $salida.= $fala_detail["d_ca_cantidad_dim"]."|"; // 10
                    $salida.= $fala_detail["d_ca_valor_fob"]."|"; // 11
                    $salida.= "|"; // 12
                    $salida.= "|"; // 13
                    $salida.= $fala_detail["d_ca_registro_num"]."|"; // 14
                    $salida.= "999|"; // 15
                    $salida.= $fala_detail["d_ca_unidad_comercial"]."|"; // 16
                    $salida.= $fala_detail["d_ca_marca"]."|"; // 17
                    $salida.= $fala_detail["d_ca_tipo"]."|"; // 18
                    $salida.= $fala_detail["d_ca_clase"]."|"; // 19
                    $salida.= $fala_detail["d_ca_modelo"]."|"; // 20
                    $salida.= $fala_detail["d_ca_ano"]."|"; // 21
                    $salida.= $fala_detail["d_ca_factura_nro"]."|"; // 22
                    $salida.= $fala_detail["d_ca_factura_fch"]."|"; // 23
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

            $array_constantes = array();
            $array_totales = array();
            $array_subtotales = array();
            $constantes = true;
            while($row = $stmt->fetch()) {
                if ($constantes){
                    $array_constantes["numdeclaracion"] =  $row["ca_numdeclaracion"];
                    $array_constantes["numinternacion"] =  $row["ca_numinternacion"];
                    $array_constantes["emision"] =  $row["ca_emision_fch"];
                    $array_constantes["vencimiento"] =  $row["ca_vencimiento_fch"];
                    $array_constantes["aceptacion"] =  $row["ca_aceptacion_fch"];
                    $array_constantes["pago"] =  $row["ca_pago_fch"];
                    $array_constantes["moneda"] =  $row["ca_moneda"];
                    $array_constantes["trm"] =  floatval($row["ca_valor_trm"]);
                    $constantes = false;
                }
                $array_totales["total"]+= floatval($row["ca_arancel"]) + floatval($row["ca_iva"]) + floatval($row["ca_compensa"]) + floatval($row["ca_antidump"]) + floatval($row["ca_salvaguarda"]) + floatval($row["ca_sancion"]) + floatval($row["ca_rescate"]);
                $array_totales["iva"]+= floatval($row["ca_iva"]);
                $array_totales["arancel"]+= floatval($row["ca_arancel"]);

                $array_totales["compensa"]+= floatval($row["ca_compensa"]);
                $array_totales["antidump"]+= floatval($row["ca_antidump"]);
                $array_totales["salvaguarda"]+= floatval($row["ca_salvaguarda"]);

                $array_totales["otros"]+= floatval($row["ca_sancion"]) + floatval($row["ca_rescate"]);

                $array_totales["fob"]+= floatval($row["ca_valor_fob"]) + floatval($row["ca_gastos_despacho"]);
                $array_totales["flete"]+= floatval($row["ca_flete"]);
                $array_totales["seguro"]+= floatval($row["ca_seguro"]);

                $array_totales["cif"]+= round(floatval($row["ca_valor_aduana"]) * floatval($row["ca_valor_trm"]),0);
                $array_totales["ajuste"]+= floatval($row["ca_ajuste_valor"]);
                $array_totales["aduana"]+= floatval($row["ca_valor_aduana"]);

                $factor = round($row["ca_valor_fob"] / $row["ca_subtotal_fob"],2);

                $array_subtotales[$row["ca_iddoc"]]["total"]+= round($factor * (floatval($row["ca_arancel"]) + floatval($row["ca_iva"]) + floatval($row["ca_compensa"]) + floatval($row["ca_antidump"]) + floatval($row["ca_salvaguarda"]) + floatval($row["ca_sancion"]) + floatval($row["ca_rescate"])), 0);
                $array_subtotales[$row["ca_iddoc"]]["iva"]+= round($factor * floatval($row["ca_iva"]), 0);
                $array_subtotales[$row["ca_iddoc"]]["arancel"]+= round($factor * floatval($row["ca_arancel"]), 0);

                $array_subtotales[$row["ca_iddoc"]]["compensa"]+= round($factor * floatval($row["ca_compensa"]), 0);
                $array_subtotales[$row["ca_iddoc"]]["otros"]+= round($factor * (floatval($row["ca_sancion"]) + floatval($row["ca_rescate"])), 0);

                $array_subtotales[$row["ca_iddoc"]]["antidump"]+= round($factor * floatval($row["ca_antidump"]), 0);
                $array_subtotales[$row["ca_iddoc"]]["salvaguarda"]+= round($factor * floatval($row["ca_salvaguarda"]), 0);
            }

            $salida = '';
            foreach($array_subtotales as $carpeta => $array_carpeta){
                $salida.= "51|"; // 1
                $salida.= "830003960|"; // 2
                $salida.= "0|"; // 3
                $salida.= "900017447|"; // 4
                $salida.= "8|"; // 5
                $salida.= "830003960|"; // 6
                $salida.= "0|"; // 7

                $salida.= str_pad($array_constantes["numdeclaracion"],30, " ")."|"; // 8
                $salida.= str_pad(null,10, " ")."|"; // 9
                $salida.= str_pad($array_constantes["numinternacion"],2, " ")."|"; // 10

                list($anno,$mes,$dia) = sscanf($array_constantes["emision"],"%d-%d-%d");
                $emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
                $salida.= $emision; // 11

                list($anno,$mes,$dia) = sscanf($array_constantes["vencimiento"],"%d-%d-%d");
                $vencimiento = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
                $salida.= $vencimiento; // 12

                list($anno,$mes,$dia) = sscanf($array_constantes["aceptacion"],"%d-%d-%d");
                $aceptacion = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
                $salida.= $aceptacion; // 13

                list($anno,$mes,$dia) = sscanf($array_constantes["pago"],"%d-%d-%d");
                $pago = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
                $salida.= $pago; // 14

                $salida.= str_pad($array_constantes["moneda"],3, " ")."|"; // 15
                $salida.= str_pad($array_constantes["trm"], 15, "0", STR_PAD_LEFT); // 16
                $salida.= str_pad($array_totales["total"], 15, "0", STR_PAD_LEFT); // 17
                $salida.= str_pad($array_totales["iva"], 15, "0", STR_PAD_LEFT); // 18
                $salida.= str_pad($array_totales["arancel"], 15, "0", STR_PAD_LEFT); // 19
                $salida.= str_pad($array_totales["compensa"], 15, "0", STR_PAD_LEFT); // 20
                $salida.= str_pad($array_totales["otros"], 15, "0", STR_PAD_LEFT); // 21
                $salida.= str_pad($array_totales["antidump"], 15, "0", STR_PAD_LEFT); // 22
                $salida.= str_pad($array_totales["salvaguarda"], 15, "0", STR_PAD_LEFT); // 23
                $salida.= str_pad(null,30, " ")."|"; // 24

                $salida.= str_pad($carpeta,20, " ")."|"; // 25
                $salida.= str_pad(null,2, " ")."|"; // 25                                   No de Embarque
                $salida.= str_pad($array_carpeta["total"], 15, "0", STR_PAD_LEFT); // 26
                $salida.= str_pad($array_carpeta["iva"], 15, "0", STR_PAD_LEFT); // 27
                $salida.= str_pad($array_carpeta["arancel"], 15, "0", STR_PAD_LEFT); // 28
                $salida.= str_pad($array_carpeta["compensa"], 15, "0", STR_PAD_LEFT); // 29
                $salida.= str_pad($array_carpeta["otros"], 15, "0", STR_PAD_LEFT); // 30
                $salida.= str_pad($array_carpeta["antidump"], 15, "0", STR_PAD_LEFT); // 31
                $salida.= str_pad($array_carpeta["salvaguarda"], 15, "0", STR_PAD_LEFT); // 32

                $salida.= str_pad(null,30, " ")."|"; // 33
                $salida.= "\r\n";
            }
            $directory=sfConfig::get('app_falabella_output');
            $filename = $directory.DIRECTORY_SEPARATOR.'DI_'.$array_constantes["numdeclaracion"].'.txt';
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
		foreach( $details as $detail ){
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
		}else{
			$fala_header->setCaProcesado(true);
			$fala_header->save();
		}
    	$this->redirect("falabellaAdu/list");
	}


	/*
	* Genera el archivo de facturacion
	*/
	public function executeGenerarFactura()
        {

		$fala_header = Doctrine::getTable("FalaHeaderAdu")->find ( base64_decode($this->getRequestParameter ( 'iddoc' )) );
		$this->forward404Unless($fala_header);

//		$reporte = ReportePeer::retrieveByConsecutivo( $fala_header->getcaReporte() );
//		$this->forward404unless( $reporte );

		$c = new Criteria();

		if ($reporte->getcaTransporte() == 'Marítimo'){
			$c->addSelectColumn(InoClientesSeaPeer::CA_REFERENCIA );
			$c->addSelectColumn(InoClientesSeaPeer::CA_IDCLIENTE );
			$c->addSelectColumn(InoClientesSeaPeer::CA_HBLS );
			$c->addSelectColumn(InoClientesSeaPeer::CA_IDREPORTE );
			$c->addSelectColumn(ReportePeer::CA_CONSECUTIVO );

			$c->addSelectColumn(InoIngresosSeaPeer::CA_FACTURA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_FCHFACTURA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_TCAMBIO );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_IDMONEDA );
			$c->addSelectColumn(InoIngresosSeaPeer::CA_VALOR );
			$c->setDistinct();

			$c->addJoin( ReportePeer::CA_IDREPORTE, InoClientesSeaPeer::CA_IDREPORTE );
			$c->addJoin( InoClientesSeaPeer::CA_REFERENCIA, InoIngresosSeaPeer::CA_REFERENCIA );
			$c->addJoin( InoClientesSeaPeer::CA_IDCLIENTE, InoIngresosSeaPeer::CA_IDCLIENTE );
			$c->addJoin( InoClientesSeaPeer::CA_HBLS, InoIngresosSeaPeer::CA_HBLS );

			$c->add( ReportePeer::CA_CONSECUTIVO, ReportePeer::CA_CONSECUTIVO." = '".$reporte->getcaConsecutivo()."'" , Criteria::CUSTOM );
			$stmt = InoClientesSeaPeer::doSelectStmt( $c );
		}else if ($reporte->getcaTransporte() == 'Aéreo'){
			$c->addSelectColumn(InoClientesAirPeer::CA_REFERENCIA );
			$c->addSelectColumn(InoClientesAirPeer::CA_IDCLIENTE );
			$c->addSelectColumn(InoClientesAirPeer::CA_HAWB );
			$c->addSelectColumn(InoClientesAirPeer::CA_IDREPORTE );
			$c->addSelectColumn(ReportePeer::CA_CONSECUTIVO );

			$c->addSelectColumn(InoIngresosAirPeer::CA_FACTURA );
			$c->addSelectColumn(InoIngresosAirPeer::CA_FCHFACTURA );
			$c->addAsColumn("CA_TCAMBIO",InoIngresosAirPeer::CA_TCALAICO);
			$c->addAsColumn("CA_IDMONEDA", "'USD'::TEXT");
			$c->addSelectColumn(InoIngresosAirPeer::CA_VALOR );
			$c->setDistinct();

			$c->addJoin( ReportePeer::CA_CONSECUTIVO, InoClientesAirPeer::CA_IDREPORTE );
			$c->addJoin( InoClientesAirPeer::CA_REFERENCIA, InoIngresosAirPeer::CA_REFERENCIA );
			$c->addJoin( InoClientesAirPeer::CA_IDCLIENTE, InoIngresosAirPeer::CA_IDCLIENTE );
			$c->addJoin( InoClientesAirPeer::CA_HAWB, InoIngresosAirPeer::CA_HAWB );

			$c->add( ReportePeer::CA_CONSECUTIVO, ReportePeer::CA_CONSECUTIVO." = '".$reporte->getcaConsecutivo()."'" , Criteria::CUSTOM );
			$stmt = InoClientesSeaPeer::doSelectStmt( $c );
		}

		$salida = '';
		while ( $row = $stmt->fetch() ) {
			$salida.= "88"; // 1
			$salida.= "800024075 "; // 2
			$salida.= "8"; // 3
			$salida.= "900017447 "; // 4
			$salida.= "8"; // 5
			$salida.= str_pad($row["ca_factura"],10, " "); // 6
			$salida.= str_pad(null,10, " "); // 7
			list($anno,$mes,$dia) = sscanf($row["ca_fchfactura"],"%d-%d-%d");
			$emision = date("Ymd", mktime(0,0,0,$mes,$dia,$anno));
			$salida.= $emision; // 8
			list($anno,$mes,$dia) = sscanf($row["ca_fchfactura"],"%d-%d-%d");
			$vencimiento = date("Ymd", mktime(0,0,0,$mes+1,$dia,$anno));
			$salida.= $vencimiento; // 9
			$salida.= str_pad("COP",3, " "); // 10  Siempre en Pesos Colombianos
			$salida.= str_pad(1, 10, "0", STR_PAD_LEFT); // 11

			$vlr_afecto = floatval($reporte->getProperty("vlrAfecto"));
                        $vlr_exento = floatval($reporte->getProperty("vlrExento"));
                        $vlr_iva    = floatval($reporte->getProperty("vlrIVA"));
                        $vlr_total  = $vlr_afecto + $vlr_exento + $vlr_iva;

			$salida.= str_pad($vlr_total, 10, "0", STR_PAD_LEFT); // 12
			$salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 13
			$salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 14

			$salida.= str_pad("21",5, " "); // 15 Concepto
			$salida.= str_pad(substr($fala_header->getCaIddoc(),0,15),20, " "); // 16

			$salida.= str_pad(floatval($reporte->getProperty("numEmbarque")), 2, "0", STR_PAD_LEFT); // 17 Embarque
			$salida.= str_pad(floatval($reporte->getProperty("vlrEmbarque")), 10, "0", STR_PAD_LEFT); // 18 Valor del Embarque

			$spaces = array(8,30,30,4,20,20,10); // Campos del 19 al 27
			foreach( $spaces as $space ){
				$salida.= str_pad(null,$space, " ");
			}

                        $salida.= str_pad($vlr_exento, 10, "0", STR_PAD_LEFT); // 28
                        $salida.= str_pad("650_BOG_DIRECCION_GENERAL", 30, " "); // 29
			$salida.= "\r\n";

			$salida.= "12"; // 1
			$salida.= "800024075"; // 2
			$salida.= "900017447 "; // 3
			$salida.= str_pad($row["ca_factura"],10, " "); // 4
			$salida.= str_pad("003",50, " "); // 5 Concepto de Retención en la Fuente
			$salida.= str_pad($vlr_afecto, 10, "0", STR_PAD_LEFT); // 6
			$salida.= "\r\n";

			$salida.= "13"; // 1
			$salida.= "800024075"; // 2
			$salida.= "900017447 "; // 3
			$salida.= str_pad($row["ca_factura"],10, " "); // 4
			$salida.= str_pad("002",50, " "); // 5 Concepto del IVA
			$salida.= str_pad($vlr_iva, 10, "0", STR_PAD_LEFT); // 6
			$salida.= "\r\n";

			$directory=sfConfig::get('app_falabellaAdu_output');
			$filename = $directory.DIRECTORY_SEPARATOR.'FAC_'.$row["ca_factura"].'.txt';
			$handle = fopen($filename , 'w');

			if (fwrite($handle, $salida) === FALSE) {
				echo "No se puede escribir al archivo {filename}";
				exit;
			}
		}

    	$this->redirect("falabellaAdu/list");
	}

	public function executeEnviarEmail()
        {
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

		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );

		$recips = explode(",",$this->getRequestParameter("destinatario"));
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addTo( $recip );
				}
			}
		}

		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addCc( $recip );
				}
			}
		}

		$email->addCc( $this->getUser()->getEmail() );
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$email->setCaBody( $this->getRequestParameter("mensaje")."<br />".$content );

		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
	}
}
?>
