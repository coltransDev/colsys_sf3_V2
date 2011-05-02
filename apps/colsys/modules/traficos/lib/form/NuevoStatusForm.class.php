<?
class NuevoStatusForm extends BaseForm{
	
	
	const NUM_CC = 7;
	const NUM_EQUIPOS = 5;
	
	private $queryIdEtapa  = null;
	private $queryPiezas  = null;
	private $queryPeso = null;
	private $queryVolumen = null;
	private $queryConcepto = null;
	private $destinatarios = array();
    private $destinatariosFijos = array();
	private $widgetsClientes = array();
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		
		$destinatarios = $this->getDestinatarios();
        $destinatariosFijos = $this->getDestinatariosFijos();
		for( $i=0; $i< count($destinatarios) ; $i++ ){
			$widgets["destinatarios_".$i] = new sfWidgetFormInputCheckbox(array(), array("size"=>60, "style"=>"margin-bottom:3px", "value"=>trim($destinatarios[$i])));
		}

        for( $i=0; $i< count($destinatariosFijos) ; $i++ ){
            
            $widgets["destinatariosfijos_".$i] = new sfWidgetFormInputCheckbox(array(), array("size"=>60, "style"=>"margin-bottom:3px", "value"=>trim($destinatariosFijos[$i]->getCaEmail())));
            
		}
		
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$widgets["cc_".$i] = new sfWidgetFormInputText(array(), array("size"=>60, "style"=>"margin-bottom:3px"));			
		}		
					
		$widgets['idetapa'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'TrackingEtapa',
															  'add_empty' => false,
															  'method' => "getCaEtapa",
															  'query' => $this->queryIdEtapa
															)
															,
															array("onChange"=>"mostrar()")
															);
		
		$widgets['remitente'] = new sfWidgetFormChoice(array(
															  'choices' => array('traficos1@coltrans.com.co'=>'traficos1@coltrans.com.co', 'traficos2@coltrans.com.co'=>'traficos2@coltrans.com.co'),
															));
										
		$widgets['asunto'] = new sfWidgetFormInputText(array(), array("size"=>120 ));
		$widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		$widgets['mensaje'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>140, "onChange"=>"validarMensaje()" ));
		$widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
		$widgets['mensaje_dirty'] = new sfWidgetFormInputHidden();
		$widgets['mensaje_mask'] = new sfWidgetFormInputHidden();
		
		
		$widgets['piezas'] = new sfWidgetFormInputText(array(), array("size"=>8 ));
		$widgets['peso'] = new sfWidgetFormInputText(array(), array("size"=>8 ));
		$widgets['volumen'] = new sfWidgetFormInputText(array(), array("size"=>8 ));
		
		$widgets['fchsalida'] = new sfWidgetFormExtDate();
		$widgets['horasalida'] = new sfWidgetFormTime();
		$widgets['fchllegada'] = new sfWidgetFormExtDate();
		$widgets['fchcontinuacion'] = new sfWidgetFormExtDate();
		
		
		$widgets['doctransporte'] = new sfWidgetFormInputText(array(), array("size"=>40, "maxlength"=>50 ));
		$widgets['docmaster'] = new sfWidgetFormInputText(array(), array("size"=>40, "maxlength"=>100 ));
		$widgets['idnave'] = new sfWidgetFormInputText(array(), array("size"=>40, "maxlength"=>50 ));
		
		$widgets['un_piezas'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'query' => $this->queryPiezas
															));
		$widgets['un_peso'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'query' => $this->queryPeso
															));		
		$widgets['un_volumen'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'query' => $this->queryVolumen
															));																										
		
		$widgets['fchrecibo'] = new sfWidgetFormExtDate();
		$widgets['horarecibo'] = new sfWidgetFormTime();
				
		for( $i=0; $i< self::NUM_EQUIPOS ; $i++ ){
			$widgets["equipos_tipo_".$i] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Concepto',
															  'add_empty' => false,
															  'method' => "getCaConcepto",
															   'key_method' => "getCaIdconcepto",
															  'query' => $this->queryConcepto,
															  "add_empty" => true
															));	
			$widgets["equipos_serial_".$i] = new sfWidgetFormInputText(array(), array("size"=>14, "style"=>"margin-bottom:3px"));
			$widgets["equipos_cant_".$i] = new sfWidgetFormInputText(array(), array("size"=>5, "style"=>"margin-bottom:3px"));		
		}	
		
		$widgets['datosbl'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		foreach( $this->widgetsClientes as $name=>$val ){
			
			$type = $val["type"];
			if( $type=="date" ){				
				$widgets[$name] = new sfWidgetFormExtDate();	
				$validator[$name] = new sfValidatorDate(array('required' => false ) ) ;		
							
			}else{
				$widgets[$name] = new sfWidgetFormInputText();	
				$validator[$name] = new sfValidatorString(array('required' => false ) ) ;			
			}				
		}


        $widgets['observaciones_idg'] = new sfWidgetFormInputText(array(), array("size"=>120 ));

		//Seguimientos		
		$widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox( array(), array("onClick"=>"crearSeguimiento()") );
		$widgets["fchseguimiento"] = new sfWidgetFormExtDate();
		$widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
        $widgets['inspeccion_fisica'] = new sfWidgetFormInputCheckbox();

		$this->setWidgets( $widgets );
		
		
		
		for( $i=0; $i< count($destinatarios) ; $i++ ){
			$validator["destinatarios_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
            $this->widgetSchema->setLabel("destinatarios_".$i, $destinatarios[$i]);
		}


        for( $i=0; $i< count($destinatariosFijos) ; $i++ ){
			
            
            $validator["destinatariosfijos_".$i] =new sfValidatorEmail( array('required' => false ),
                                                    array('invalid' => 'La dirección es invalida'));
            if( $destinatariosFijos[$i]->getCaEmail() ){
                $this->widgetSchema->setLabel("destinatariosfijos_".$i, $destinatariosFijos[$i]->getNombre()." [".$destinatariosFijos[$i]->getCaCargo()."]");
            }else{
                $this->widgetSchema->setLabel("destinatariosfijos_".$i, $destinatariosFijos[$i]->getNombre()." <span class='rojo'>Destinatario sin e-mail</span>");
            }
            
		}
			
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$validator["cc_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}
		
		
		$validator["remitente"] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		
		$validator['idetapa'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'La etapa es obligatoria'));
		$validator['asunto'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el asunto'));	
		
		$validator['introduccion'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque la introducción o el saludo del mensaje'));	
		
		$validator['mensaje'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el status'));	
		$validator['mensaje_dirty'] = new sfValidatorString(array('required' => false ));
		$validator['notas'] = new sfValidatorString(array('required' => false ));
		
		$validator['piezas'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque las piezas',
																'invalid' => 'No valido'));	
		$validator['peso'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque el peso',
																'invalid' => 'No valido'));	
		$validator['volumen'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque el volumen',
																'invalid' => 'No valido'
																));	
		$validator['un_piezas'] = new sfValidatorString(array('required' => false ));		
		$validator['un_peso'] = new sfValidatorString(array('required' => false ));		
		$validator['un_volumen'] = new sfValidatorString(array('required' => false ));		
		$validator['doctransporte'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque el HBL/HAWB'));	
		$validator['idnave'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque la motonave o el vuelo'));
		$validator['docmaster'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque el BL'));	
		$validator['fchsalida'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de salida'));			
		$validator['fchllegada'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de llegada'));			
		
		$validator['fchcontinuacion'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de continuación'));																	

		$validator['fchrecibo'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en la fecha en que usted recibió este status'));			
		$validator['horarecibo'] = new sfValidatorTime(array('required' => true ), 
														array('required' => 'Por favor coloque en la hora que usted recibió este status'));																												
		
		$validator['horasalida'] = new sfValidatorTime(array('required' => false ));		
		
		
		for( $i=0; $i< self::NUM_EQUIPOS ; $i++ ){
			$validator["equipos_tipo_".$i] = new sfValidatorString(array('required' => false ));
			$validator["equipos_serial_".$i] = new sfValidatorString(array('required' => false ));
			$validator["equipos_cant_".$i] = new sfValidatorNumber(array('required' => false, "min"=>0 ), 
														array('invalid' => 'No valido'));	
		}
		
		$validator['mensaje_mask'] = new sfValidatorString(array('required' => false ));
		
		
		$validator['datosbl'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque los datos para reclamar el BL en destino'));
														
		$validator['prog_seguimiento'] = new sfValidatorString(array('required' => false ) );												
		
		$validator['fchseguimiento'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
		$validator['txtseguimiento'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque un texto para el seguimiento'));
														
		$validator['observaciones_idg'] = new sfValidatorString(array('required' => false ));

        $validator['ca_inspeccion_fisica'] = new sfValidatorBoolean(array('required' => false ));

		//echo isset($validator['fchdoctransporte'])."<br />";															
		$this->setValidators( $validator );
		
		
		$this->validatorSchema->setPostValidator(
		  new sfValidatorSchemaCompare('fchrecordar', '<=', 'fchseguimiento', array(), array("invalid"=>"Esta fecha debe ser menor que la fecha de seguimiento"))
		);
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		/*$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}*/
		
		if( $taintedValues["mensaje_mask"] ){
			$this->validatorSchema['mensaje']->setOption('required', false);
		}
		
		if( $taintedValues["idetapa"]=="IAETA"||$taintedValues["idetapa"]=="IMETA" || $taintedValues["idetapa"]=="EEETD" ){
			 $this->validatorSchema['piezas']->setOption('required', true);
			 $this->validatorSchema['peso']->setOption('required', true);
			 $this->validatorSchema['volumen']->setOption('required', true);
			 $this->validatorSchema['fchsalida']->setOption('required', true);
			 $this->validatorSchema['fchllegada']->setOption('required', true);	 			 			 			 
			 $this->validatorSchema['fchllegada']->setOption('required', true);
			 $this->validatorSchema['doctransporte']->setOption('required', true);
			 $this->validatorSchema['idnave']->setOption('required', true);
			 
		}	
				
		if( $taintedValues["idetapa"]!="IAETA" ){
			$this->validatorSchema['fchrecibo']->setOption('required', true);
			$this->validatorSchema['horarecibo']->setOption('required', true);
		}
		
		if( $taintedValues["prog_seguimiento"] ){
			$this->validatorSchema['fchseguimiento']->setOption('required', true);
			$this->validatorSchema['txtseguimiento']->setOption('required', true);
		}


        $horaRecibo = $taintedValues["horarecibo"];

        if( !$horaRecibo['minute'] ){
            $horaRecibo['minute']='00';
        }

        $horaRecibo['hour']=str_pad($horaRecibo['hour'],2, "0", STR_PAD_LEFT );
        $horaRecibo['minute']=str_pad($horaRecibo['minute'],2, "0", STR_PAD_LEFT );
        $horaRecibo = implode(":", $horaRecibo ).":00";
        $fch = $taintedValues["fchrecibo"]." ".$horaRecibo;
        //echo $fch;
        $fest = TimeUtils::getFestivos();
        $dif = TimeUtils::calcDiff( $fest, strtotime($fch), time() );
        
        if( !$taintedValues["observaciones_idg"] && $dif>RepStatus::IDG ){
			$this->validatorSchema['observaciones_idg']->setOption('required', true);
		}


        $destinatariosFijos = $this->getDestinatariosFijos();
        		
		parent::bind($taintedValues,  $taintedFiles);
	}
	
	
	public function setQueryIdEtapa( $c ){
		$this->queryIdEtapa = $c;
	}
	
	public function setQueryPiezas( $c ){
		$this->queryPiezas = $c;
	}
	
	public function setQueryPeso( $c ){
		$this->queryPeso = $c;
	}
	
	public function setQueryVolumen( $c ){
		$this->queryVolumen = $c;
	}
	
	public function setDestinatarios( $c ){
		$this->destinatarios = $c;			
	}

    public function setDestinatariosFijos( $c ){
		$this->destinatariosFijos = $c;
	}
	
	
	public function setQueryConceptos( $c ){
		$this->queryConcepto = $c;
	}
	
	public function getWidgetsClientes( ){
		return $this->widgetsClientes;
	}
	
	public function getDestinatarios( ){
		return $this->destinatarios;
	}

    public function getDestinatariosFijos( ){
		return $this->destinatariosFijos;
	}
	
	public function setWidgetsClientes( $parametros ){
		
		foreach( $parametros as $parametro ){			
			
			$valor = explode(":",$parametro->getCaValor());
			$name = $valor[0];
			$type = $valor[1];	
									
			$this->widgetsClientes[$name] = array("type"=>$type, "label"=>$parametro->getCaValor2());		 
		}				
	}


}
?>