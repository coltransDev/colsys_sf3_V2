<?php

/**
 * bavaria actions.
 *
 * @package    colsys
 * @subpackage bavaria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class bavariaActions extends sfActions {
	
	/*
	* Accion por defecto
	*/
	public function executeIndex() {
		return $this->forward ( 'bavaria', 'loadInfo' );
	}


	/*
	* Lista los Ordenes de Pedido de Bavaria
	*/
        public function executeList() {
            $this->bavaria_notifys = Doctrine::getTable("Bavaria")
                ->createQuery("b")
                ->where("b.ca_usuarchivado IS NULL")
                ->andWhere("b.ca_usuanulado IS NULL")
                ->addOrderBy("b.ca_zarpe_fch desc")
                //->getSqlQuery();
                ->execute();
        }
	

	/*
	* Carga en la Tabla Bavaria, la información de Reportes de Negocio del Grupo
	*/
        public function executeLoadInfo() {
            $idBavaria =  "860005224";
            $reportes = Doctrine::getTable("Reporte")
                ->createQuery("rp")
                ->innerJoin("rp.Contacto cc")
                ->leftJoin("rp.Bavaria bv")
                ->where("cc.ca_idcliente IN (SELECT cl.ca_idcliente FROM Cliente cl WHERE cl.ca_idgrupo = ?)", $idBavaria )
                ->andWhere("bv.ca_consecutivo IS NULL")
                ->andWhere("rp.ca_fchreporte >= '2010-01-01'")
                ->addOrderBy("rp.ca_fchreporte desc")
                ->addOrderBy("rp.ca_consecutivo desc")
                ->execute();

            foreach($reportes as $reporte){
                if (!$reporte->esUltimaVersion()){
                    continue;
                }
                $piezas_mem = ($reporte->getPiezas()!=NULL and $reporte->getPiezas()!="")?explode(" ",$reporte->getPiezas()):array(0,0);
                $peso_mem = ($reporte->getPeso()!=NULL and $reporte->getPeso()!="")?explode(" ",$reporte->getPeso()):array(0,0);
                $embalaje = "";

                $parametro = Doctrine::getTable("Parametro")->find(array("CU047",0,$piezas_mem[1]));
                if ($parametro) {
                    $embalaje = $parametro->getCaValor2();
                }

                $num_factura = ($reporte->getProperty("numfactproveedor")!=NULL)?$reporte->getProperty("numfactproveedor"):0;
                $bavaria = new Bavaria();

                $bavaria->setCaConsecutivo($reporte->getCaConsecutivo());
                $bavaria->setCaOrdenNro(substr($reporte->getCaOrdenClie(),0,10));
                $bavaria->setCaModalidad($reporte->getCaModalidad());
                $bavaria->setCaFacturaNro(substr($num_factura,0,15));
                $bavaria->setCaFacturaFch($reporte->getProperty("fchfactproveedor"));
                $bavaria->setCaZarpeFch($reporte->getETS());
                $bavaria->setCaDoctransporte($reporte->getDoctransporte());
                $bavaria->setCaDoctransporteFch($reporte->getProperty("fchdoctransporte"));
                $bavaria->setCaRecibocargaFch($reporte->getProperty("fchrecibocarga"));
                $bavaria->setCaPesoBruto($peso_mem[0]);
                $bavaria->setCaPesoNeto(round($peso_mem[0]*90/100,0));
                $bavaria->setCaPiezas($piezas_mem[0]);
                $bavaria->setCaTipoEmbalaje($embalaje);
                $bavaria->save();
            }

            $this->forward ( 'bavaria', 'list' );
        }


	/*
	* Permite ver los detalles de las Ordenes y editar los datos para generar el archivo de salida
	*/
        public function executeProcesarOrdenes() {
            $this->ordenes = Doctrine::getTable("Bavaria")
                    ->createQuery("bv")
                    ->where("bv.ca_usureportado IS NULL")
                    ->andwhere("bv.ca_usuarchivado IS NULL")
                    ->addOrderBy("bv.ca_orden_nro")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();
            
            $response = sfContext::getInstance()->getResponse();
            $response->addJavaScript("extExtras/CheckColumn",'last');
            $response->addJavaScript("extExtras/LockingGridView",'last');
            $response->addStylesheet("extExtras/LockingGridView",'last');
        }


	/*
	* Guarda los cambios en la orden
	*/
        public function executeObserveOrdenes() {
            if( $this->getRequestParameter ( 'idbavaria' ) ) {
                $bavaria = Doctrine::getTable("Bavaria")->find($this->getRequestParameter ( 'idbavaria' ) ) ;
                $this->forward404Unless($bavaria);
            }else{
                $bavaria = new Bavaria();
                $bavaria->setCaConsecutivo( $this->getRequestParameter ( 'consecutivo' ) );
            }

            $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

            if( $this->getRequestParameter ( 'orden_nro' )!==null ) {
                $bavaria->setCaOrdenNro( $this->getRequestParameter ( 'orden_nro' ) );
            }

            if( $this->getRequestParameter ( 'modalidad' )!==null ) {
                $bavaria->setCaModalidad( $this->getRequestParameter ( 'modalidad' ) );
            }

            if( $this->getRequestParameter ( 'factura_nro' )!==null ) {
                $bavaria->setCaFacturaNro( $this->getRequestParameter ( 'factura_nro' ) );
            }

            if( $this->getRequestParameter ( 'factura_fch' )!==null ) {
                $bavaria->setCaFacturaFch( $this->getRequestParameter ( 'factura_fch' ) );
            }

            if( $this->getRequestParameter ( 'zarpe_fch' )!==null ) {
                $bavaria->setCaZarpeFch( $this->getRequestParameter ( 'zarpe_fch' ) );
            }

            if( $this->getRequestParameter ( 'doctransporte' )!==null ) {
                $bavaria->setCaDoctransporte( $this->getRequestParameter ( 'doctransporte' ) );
            }

            if( $this->getRequestParameter ( 'doctransporte_fch' )!==null ) {
                $bavaria->setCaDoctransporteFch( $this->getRequestParameter ( 'doctransporte_fch' ) );
            }

            if( $this->getRequestParameter ( 'recibocarga_fch' )!==null ) {
                $bavaria->setCaRecibocargaFch( $this->getRequestParameter ( 'recibocarga_fch' ) );
            }

            if( $this->getRequestParameter ( 'peso_bruto' )!==null ) {
                $bavaria->setCaPesoBruto( $this->getRequestParameter ( 'peso_bruto' ) );
            }

            if( $this->getRequestParameter ( 'peso_neto' )!==null ) {
                $bavaria->setCaPesoNeto( $this->getRequestParameter ( 'peso_neto' ) );
            }

            if( $this->getRequestParameter ( 'tipo_embalaje' )!==null ) {
                $bavaria->setCaTipoEmbalaje( $this->getRequestParameter ( 'tipo_embalaje' ) );
            }

            if( $this->getRequestParameter ( 'piezas' )!==null ) {
                $bavaria->setCaPiezas( $this->getRequestParameter ( 'piezas' ) );
            }

            if( $this->getRequestParameter ( 'transportadora' )!==null ) {
                $bavaria->setCaTransportadora( $this->getRequestParameter ( 'transportadora' ) );
            }

            if( $this->getRequestParameter ( 'bandera' )!==null ) {
                $bavaria->setCaBandera( $this->getRequestParameter ( 'bandera' ) );
            }
            $bavaria->save();

            $this->responseArray["success"]=true;
            $this->setTemplate("responseTemplate");
        }


	/*
	* Elimina la Orden para nuevamente ser procesada
	*/
        public function executeArchivarOrden() {
            $bavaria = Doctrine::getTable("Bavaria")->find($this->getRequestParameter ( 'idbavaria' ) ) ;
            $this->forward404Unless($bavaria);

            $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

            $bavaria->setCaFchanulado(date("d M Y H:i:s"));
            $bavaria->setCaUsuanulado($this->getUser()->getUserId());
            $bavaria->save();

            $this->responseArray["success"]=true;
            $this->setTemplate("responseTemplate");
        }


	/*
	* Recargar Información de la Orden
	*/
        public function executeRecargarOrden() {
            $bavaria = Doctrine::getTable("Bavaria")->find($this->getRequestParameter ( 'idbavaria' ) ) ;
            $this->forward404Unless($bavaria);

            $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

            $reportes = Doctrine::getTable("Reporte")
                        ->createQuery("r")
                        ->where("r.ca_consecutivo like ?", $bavaria->getCaConsecutivo())
                        ->addWhere("r.ca_usuanulado IS NULL")
                        ->execute();
            foreach($reportes as $reporte){
                if(!$reporte->esUltimaVersion()){
                    continue;
                }

                $piezas_mem = ($reporte->getPiezas()!=NULL and $reporte->getPiezas()!="")?explode(" ",$reporte->getPiezas()):array(0,0);
                $peso_mem = ($reporte->getPeso()!=NULL and $reporte->getPeso()!="")?explode(" ",$reporte->getPeso()):array(0,0);
                $embalaje = "";

                $parametro = Doctrine::getTable("Parametro")->find(array("CU047",0,$piezas_mem[1]));
                if ($parametro) {
                    $embalaje = $parametro->getCaValor2();
                }

                $num_factura = ($reporte->getProperty("numfactproveedor")!=NULL)?$reporte->getProperty("numfactproveedor"):0;

                $this->responseArray["orden_nro"]=substr($reporte->getCaOrdenClie(),0,10);
                $this->responseArray["modalidad"]=$reporte->getCaModalidad();
                $this->responseArray["factura_nro"]=substr($num_factura,0,15);
                $this->responseArray["factura_fch"]=$reporte->getProperty("fchfactproveedor");
                $this->responseArray["recibocarga_fch"]=$reporte->getProperty("fchrecibocarga");
                $this->responseArray["zarpe_fch"]=$reporte->getETS();
                $this->responseArray["doctransporte"]=$reporte->getDoctransporte();
                $this->responseArray["doctransporte_fch"]=$reporte->getProperty("fchdoctransporte");
                $this->responseArray["peso_bruto"]=$peso_mem[0];
                $this->responseArray["peso_neto"]=round($peso_mem[0]*90/100,0);
                $this->responseArray["tipo_embalaje"]=$embalaje;
                $this->responseArray["piezas"]=$piezas_mem[0];
            }
            $this->responseArray["success"]=true;
            $this->setTemplate("responseTemplate");
        }


	/*
	* Elimina la Orden para nuevamente ser procesada
	*/
        public function executeEliminarOrden() {
            $bavaria = Doctrine::getTable("Bavaria")->find($this->getRequestParameter ( 'idbavaria' ) ) ;
            $this->forward404Unless($bavaria);

            $this->responseArray=array("id"=>$this->getRequestParameter ( 'id' ),  "success"=>false);

            $bavaria->delete();

            $this->responseArray["success"]=true;
            $this->setTemplate("responseTemplate");
        }


	/*
	* Genera el archivo para envio
	*/
	public function executeGenerarArchivo(){
            $idBavaria =  "860005224";
            $cod_empresas = array( "860005224"=>"0001", "890900168"=>"0002", ""=>"", "800172251"=>"0003", "900136638"=>"0004", "830101107"=>"0005", "860528319"=>"0006" );
            $cod_unipeso = array( ""=>"", "Kilos"=>"kg" );
            $mod_transporte = array( "Aéreo"=>"4", "Marítimo"=>"1", "Terrestre"=>"3" );
            $cod_embalaje = array( ""=>"", "Bultos"=>"PK", "Cajas"=>"CS", "Cartones"=>"CT", "Pallets"=>"PC", "Patines"=>"YY", "Piezas"=>"BT", "Rollos"=>"RO", "Sacos"=>"BG", "Tambores"=>"YY" );
            $frm_embarque = array( "FCL"=>"01", "CONSOLIDADO"=>"02", "LCL"=>"03", "COLOADING"=>"03" );
            $frm_transporte = array( "FCL"=>"Marítimo", "CONSOLIDADO"=>"Aéreo", "LCL"=>"Marítimo", "COLOADING"=>"Marítimo" );
            $tipo_contenedor = array( "10"=>"1", "15"=>"2", "21"=>"3", "11"=>"4", "16"=>"5", "12"=>"6", "18"=>"7" );

            $bavaria_notifys = Doctrine::getTable("Bavaria")
                ->createQuery("b")
                ->where("b.ca_usuarchivado IS NULL")
                ->andWhere("b.ca_usuanulado IS NULL")
                ->andWhere("b.ca_usureportado IS NULL")
                ->addOrderBy("b.ca_zarpe_fch desc")
                ->execute();

            $salida = "";
            set_time_limit(0);
            foreach( $bavaria_notifys as $notify ){
                $salida.= "1|";  // 1
                $salida.= "BA00|";  // 2
                $salida.= str_pad(substr($notify->getCaOrdenNro(),0,10),10, " ")."|"; // 3
                $salida.= str_pad($notify->getCaFacturaNro(),15, " ")."|"; // 4
                $salida.= str_pad(null,10, " ")."|"; // 5

                $fchfactProveedor = Utils::transformDate($notify->getCaFacturaFch(), $format="Ymd");
                $salida.= str_pad($fchfactProveedor,8, " ")."|"; // 6

                $fchETS = Utils::transformDate($notify->getCaZarpeFch(), $format="Ymd");
                $salida.= str_pad($fchETS,8, " ")."|"; // 7

                $salida.= str_pad($notify->getCaDoctransporte(),25, " ")."|"; // 8
                $fchdoctransporte = Utils::transformDate($notify->getCaDoctransporteFch(), $format="Ymd");
                $salida.= str_pad($fchdoctransporte,8, " ")."|"; // 9
                $salida.= str_pad(null,8, " ")."|"; // 10
                $salida.= str_pad(null,8, " ")."|"; // 11
                $fchrecibocarga = Utils::transformDate($notify->getCaRecibocargaFch(), $format="Ymd");
                $salida.= str_pad($fchrecibocarga,8, " ")."|"; // 12

                $salida.= str_pad($notify->getCaPesoBruto(),15, " ")."|"; // 13
                $salida.= str_pad("kg",4, " ")."|"; // 14
                $salida.= str_pad($notify->getCaPesoNeto(),15, " ")."|"; // 15
                
                $salida.= str_pad($mod_transporte[$frm_transporte[$notify->getCaModalidad()]], 1, " " )."|"; // 16

                $salida.= str_pad($notify->getCaTipoEmbalaje(),2, " ")."|"; // 17

                $salida.= str_pad($notify->getCaTransportadora(),10, " ")."|"; // 18 -> Empresa Transportadora
                $salida.= str_pad($notify->getCaBandera(),3, " ")."|"; // 19 -> Bandera Empresa Transportadora
                $salida.= str_pad($frm_embarque[$notify->getCaModalidad()], 2, " " )."|"; // 20
                $salida.= str_pad(null,5, " ")."|"; // 21 -> Clave de Moneda

                $spaces = array(15,13,13,13,13,13,13,5,11,8); // Campos del 22 al 31
                foreach( $spaces as $space ){
                        $salida.= str_pad(null,$space, " ")."|";
                }
                unset($space);

                $salida.= str_pad($notify->getCaPiezas(),15, " ")."|"; // 32
                $salida.= str_pad($notify->getCaPiezas(),13, " ")."|"; // 33

                $spaces = array(1,2,90,8,8,8,8,90,2,25,8,255,8,8,8,8,7,80,10,18,10,11); // Campos del 34 al 55
                foreach( $spaces as $space ){
                        $salida.= str_pad(null,$space, " ")."|";
                }
                $salida.= "\r\n";
                unset($space);

                $notify->setCaFchreportado(date("d M Y H:i:s"));
                $notify->setCaUsureportado($this->getUser()->getUserId());
                $notify->save();
            }

            $this->salida = $salida;

	}
	
	/*
	 * Func...
	*/
	public function executeNuevoMensaje(){
	}
	
	
	public function executeEnviarEmail(){
				
		$this->setLayout("ajax");
		
		$directory= sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
		$filename1 = $directory.DIRECTORY_SEPARATOR.'notificacion.txt';
		@unlink($filename1);
		
		$this->executeGenerarArchivo();
		
		$user = $this->getUser();
					
		//Crea el correo electronico
		$email = new Email();
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Fal Shipping Inst." ); 		
		$email->setCaIdcaso( '1' );
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
		$email->setCaBody( $this->getRequestParameter("mensaje") );	
		
		//**
		$email->AddAttachment( $filename1 );
		$email->AddAttachment( $filename2 );
		$email->AddAttachment( $filename3 );
		
		$email->save(); //guarda el cuerpo del mensaje
		/*$this->error = $email->send();	
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}*/
	}
}
?>
