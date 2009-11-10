<?
class LoginForm extends BaseForm{
	public function configure(){
		//$this->setValidatorSchema(new RegisterValidatorSchema());
		//$this->setWidgetSchema(new RegisterWidgetFormSchema());
		
		$this->setWidgets(array(		  
		  'email' => new sfWidgetFormInputText(),
		  'clave' => new sfWidgetFormInputPassword(),
		));
		
		$this->widgetSchema->setLabels(array(
		  'email'    => 'Correo electr�nico',
		  'clave'   => 'Clave'
		));
		
		
		$this->setValidators(array(
				'clave'	=> new sfValidatorString(array('required' => true), array(
						  'required'   => 'La clave es requerida'				
						)),							  		  
			  	'email' => new  sfValidatorEmail(array('required' => true, 'trim' => true), array(
						  'required'   => 'El correo electr�nico es requerido'				
						))
		));
		
		$this->validatorSchema->setPostValidator(new myLoginValidator());
						
		
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