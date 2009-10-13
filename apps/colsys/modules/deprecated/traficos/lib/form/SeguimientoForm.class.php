<?
class SeguimientoForm extends sfForm{
		
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		
		//Seguimientos				
		$widgets["fchseguimiento"] = new sfWidgetFormExtDate();
		$widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
		$this->setWidgets( $widgets );
		
										
		
		
		$validator['fchseguimiento'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
		$validator['txtseguimiento'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque un texto para el seguimiento'));
														
																												
		
		//echo isset($validator['fchdoctransporte'])."<br />";															
		$this->setValidators( $validator );
		
		
		/*$this->validatorSchema->setPostValidator(
		  new sfValidatorSchemaCompare('fchrecordar', '<=', 'fchseguimiento', array(), array("invalid"=>"Esta fecha debe ser menor que la fecha de seguimiento"))
		);*/
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		/*$request = sfContext::getInstance()->getRequest();
		if ($request->hasParameter(self::$CSRFFieldName)){
			$taintedValues[self::$CSRFFieldName] = $request->getParameter(self::$CSRFFieldName);
		}*/
			
		parent::bind($taintedValues,  $taintedFiles);
	}
	
}
?>