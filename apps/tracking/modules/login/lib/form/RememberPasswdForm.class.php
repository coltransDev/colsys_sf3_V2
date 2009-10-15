<?
class RememberPasswdForm extends sfForm{
	public function configure(){
		
		
		$this->setWidgets(array(		  
		  'email' => new sfWidgetFormInput()
		
		));
		
		$this->widgetSchema->setLabels(array(
		  'email'    => 'Correo electrónico'		 
		));
		
		
		$this->setValidators(array(										  		  
			  	'email' => new  sfValidatorEmail(array('required' => true, 'trim' => true), array(
						  'required'   => 'El correo electrónico es requerido'				
						))
		));		
		
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