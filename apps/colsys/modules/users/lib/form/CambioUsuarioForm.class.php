<?
class CambioUsuarioForm extends BaseForm{
	public function configure(){
		//$this->setValidatorSchema(new RegisterValidatorSchema());
		//$this->setWidgetSchema(new RegisterWidgetFormSchema());
		
		$this->setWidgets(array(		  
		  'username' => new sfWidgetFormDoctrineChoice(
		  					array(
								'model'     => 'Usuario',
								'add_empty' => false,								
								'key_method'=>'getCaLogin',
								'order_by'=>array('ca_nombre', 'ASC')
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