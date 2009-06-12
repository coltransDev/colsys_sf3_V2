<?
class NuevoStatusForm extends sfForm{
	
	
	const NUM_CC = 7;
	
	private $criteriaIdEtapa  = null;
	private $criteriaPiezas  = null;
	private $criteriaPeso = null;
	private $criteriaVolumen = null;
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$widgets["cc_".$i] = new sfWidgetFormInput(array(), array("size"=>60, "style"=>"margin-bottom:3px"));			
		}		
		
		
		
				
		$widgets['idetapa'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'TrackingEtapa',
															  'add_empty' => false,
															  'method' => "getCaEtapa",
															  'criteria' => $this->criteriaIdEtapa
															));
		$widgets['asunto'] = new sfWidgetFormInput(array(), array("size"=>145 ));
		$widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		$widgets['mensaje'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>140 ));
		$widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
		$widgets['piezas'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['peso'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['volumen'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		
		
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
		
		$widgets['horarecibo'] = new sfWidgetFormTime();
		
		$this->setWidgets( $widgets );
			
		$validator = array();		
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$validator["cc_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}		
		$this->setValidators( $validator );
		
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		/*$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}*/
		
		/*
		if ( $this->object->isNew() ) {
	      $this->validatorSchema['password']->setOption('required', true);
    	}
		*/
		
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
}
?>