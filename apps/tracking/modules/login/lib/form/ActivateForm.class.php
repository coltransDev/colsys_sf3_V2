<?
class ActivateForm extends sfForm{
	public function configure(){
		//$this->setValidatorSchema(new RegisterValidatorSchema());
		//$this->setWidgetSchema(new RegisterWidgetFormSchema());
		
		$this->setWidgets(array(		  
		  'clave1' => new sfWidgetFormInputPassword(),
		  'clave2' => new sfWidgetFormInputPassword(),
		));
		
		$this->widgetSchema->setLabels(array(		 
		  'clave1'   => 'Nueva clave',
		  'clave2' => 'Confirme la nueva clave',
		));
		
		
		$this->setValidators(array(							  		  
			  'clave1' => new sfValidatorString(array('min_length' => 5), array(
				'required'   => 'La nueva clave es requerida',
				'min_length' => 'La clave es muy corta. debe contener al menos %min_length% caracteres.',
			  )),

			  'clave2' => new sfValidatorString(array('required' => true), array(
				'required'   => 'Por favor confirme la nueva clave'				
			  ))
		));
		
				
		$this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('clave1', '==', 'clave2', 
																				array(),
																				array('invalid' => 'Las dos contraseñas no concuerdan') ) );
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}
		parent::bind($taintedValues);
	}
}
?>