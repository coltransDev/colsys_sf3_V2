<?
class LoginFormNovell extends sfForm{
	public function configure(){
		//$this->setValidatorSchema(new RegisterValidatorSchema());
		//$this->setWidgetSchema(new RegisterWidgetFormSchema());
		
		$this->setWidgets(array(		  
		  'username' => new sfWidgetFormInput(array(), array("Autocomplete"=>"off")),
		  'passwd' => new sfWidgetFormInputPassword(),
		));
		
		$this->widgetSchema->setLabels(array(
		  'username'    => 'Usuario',
		  'passwd'   => 'Clave'
		));
		
		
		$this->setValidators(array(
				'passwd'	=> new sfValidatorString(array('required' => true), array(
						  'required'   => 'La clave es requerida'				
						)),							  		  
			  	'username' => new sfValidatorString(array('required' => true, 'trim' => true), array(
						  'required'   => 'El usuario requerido'				
						))
						
		));
		
		$this->validatorSchema->setPostValidator(new myLoginValidatorNovell());
						
		
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