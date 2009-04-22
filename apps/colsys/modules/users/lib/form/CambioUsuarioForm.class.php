<?
class CambioUsuarioForm extends sfForm{
	public function configure(){
		//$this->setValidatorSchema(new RegisterValidatorSchema());
		//$this->setWidgetSchema(new RegisterWidgetFormSchema());
		
		$this->setWidgets(array(		  
		  'username' => new sfWidgetFormPropelChoice(
		  					array(
								'model'     => 'Usuario',
								'add_empty' => false,
								'method'=>'getCaNombre',
								'key_method'=>'getCaLogin',
								'order_by'=>array('CaNombre', 'ASC')
  						    ) )
		  
		));
		
		$this->widgetSchema->setLabels(array(
		  'username'    => 'Usuario'
		 
		));
		
		$this->setValidators(array(										  		  
			  	'username' => new sfValidatorString(array('required' => true, 'trim' => true), array(
						  'required'   => 'El usuario requerido'				
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