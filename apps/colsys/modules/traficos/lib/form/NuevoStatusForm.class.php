<?
class NuevoStatusForm extends sfForm{
	
	
	const NUM_CC = 7;
	const NUM_EQUIPOS = 5;
	
	private $criteriaIdEtapa  = null;
	private $criteriaPiezas  = null;
	private $criteriaPeso = null;
	private $criteriaVolumen = null;
	private $criteriaConcepto = null;
	private $widgetsClientes = array();
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		
		
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$widgets["cc_".$i] = new sfWidgetFormInput(array(), array("size"=>60, "style"=>"margin-bottom:3px"));			
		}		
					
		$widgets['idetapa'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'TrackingEtapa',
															  'add_empty' => false,
															  'method' => "getCaEtapa",
															  'criteria' => $this->criteriaIdEtapa
															)
															,
															array("onChange"=>"mostrar()")
															);
		
		
										
		//$widgets['asunto'] = new sfWidgetFormInput(array(), array("size"=>145 ));
		$widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		$widgets['mensaje'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>140, "onChange=validarMensaje" ));
		$widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
		$widgets['mensaje_dirty'] = new sfWidgetFormInputHidden();
		$widgets['mensaje_mask'] = new sfWidgetFormInputHidden();
		
		
		$widgets['piezas'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['peso'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['volumen'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		
		$widgets['fchsalida'] = new sfWidgetFormExtDate();
		$widgets['horasalida'] = new sfWidgetFormTime();
		$widgets['fchllegada'] = new sfWidgetFormExtDate();
		$widgets['fchcontinuacion'] = new sfWidgetFormExtDate();
		
		
		$widgets['doctransporte'] = new sfWidgetFormInput(array(), array("size"=>40 ));
		$widgets['docmaster'] = new sfWidgetFormInput(array(), array("size"=>40 ));
		$widgets['idnave'] = new sfWidgetFormInput(array(), array("size"=>40 ));
		
		$widgets['un_piezas'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaPiezas
															));
		$widgets['un_peso'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaPeso
															));		
		$widgets['un_volumen'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaVolumen
															));																										
		
		$widgets['fchrecibo'] = new sfWidgetFormExtDate();
		$widgets['horarecibo'] = new sfWidgetFormTime();
				
		for( $i=0; $i< self::NUM_EQUIPOS ; $i++ ){
			$widgets["equipos_tipo_".$i] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Concepto',
															  'add_empty' => false,
															  'method' => "getCaConcepto",
															   'key_method' => "getCaIdconcepto",
															  'criteria' => $this->criteriaConcepto,
															  "add_empty" => true
															));	
			$widgets["equipos_serial_".$i] = new sfWidgetFormInput(array(), array("size"=>14, "style"=>"margin-bottom:3px"));
			$widgets["equipos_cant_".$i] = new sfWidgetFormInput(array(), array("size"=>5, "style"=>"margin-bottom:3px"));		
		}	
		
		$widgets['datosbl'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		foreach( $this->widgetsClientes as $name=>$val ){
			
			$type = $val["type"];
			if( $type=="date" ){				
				$widgets[$name] = new sfWidgetFormExtDate();	
				$validator[$name] = new sfValidatorDate(array('required' => false ) ) ;		
							
			}else{
				$widgets[$name] = new sfWidgetFormInput();	
				$validator[$name] = new sfValidatorString(array('required' => false ) ) ;			
			}				
		}
		
		$this->setWidgets( $widgets );
			
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$validator["cc_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}
		
		$validator['idetapa'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'La etapa es obligatoria'));
		/*$validator['asunto'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el asunto'));	*/
		
		$validator['introduccion'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque la introducción o el saludo del mensaje'));	
		
		$validator['mensaje'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el status'));	
		
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
		
		//echo isset($validator['fchdoctransporte'])."<br />";															
		$this->setValidators( $validator );
		
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		/*$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}*/
		
		if( $taintedValues["mensaje_mask"] ){
			$this->validatorSchema['mensaje']->setOption('required', false);
		}
		
		if( $taintedValues["idetapa"]=="IAETA"||$taintedValues["idetapa"]=="IMETA" || $taintedValues["idetapa"]=="EEETA" ){
			 $this->validatorSchema['piezas']->setOption('required', true);
			 $this->validatorSchema['peso']->setOption('required', true);
			 $this->validatorSchema['volumen']->setOption('required', true);
			 $this->validatorSchema['fchsalida']->setOption('required', true);
			 $this->validatorSchema['fchllegada']->setOption('required', true);
			 $this->validatorSchema['doctransporte']->setOption('required', true);
			 $this->validatorSchema['idnave']->setOption('required', true);
			 
		}	
				
		if( $taintedValues["idetapa"]!="IAETA" ){
			$this->validatorSchema['fchrecibo']->setOption('required', true);
			$this->validatorSchema['horarecibo']->setOption('required', true);
		}
		
		parent::bind($taintedValues,  $taintedFiles);
	}
	
	
	public function setCriteriaIdEtapa( $c ){
		$this->criteriaIdEtapa = $c;
	}
	
	public function setCriteriaPiezas( $c ){
		$this->criteriaPiezas = $c;		
	}
	
	public function setCriteriaPeso( $c ){
		$this->criteriaPeso = $c;		
	}
	
	public function setCriteriaVolumen( $c ){
		$this->criteriaVolumen = $c;			
	}
	
	public function setCriteriaConceptos( $c ){
		$this->criteriaConcepto = $c;		
	}
	
	public function getWidgetsClientes( ){
		return $this->widgetsClientes;
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