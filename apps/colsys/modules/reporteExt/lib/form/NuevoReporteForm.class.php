<?
class NuevoReporteForm extends BaseForm{
	
	
	const NUM_CC = 7;
	
	private $contactosAg=array();
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		
		$contactos = $this->getContactosAg();
		
		foreach( $contactos as $contacto ){
			$widgets["destinatarios_".$contacto->getCaIdcontacto()] = new sfWidgetFormInputCheckbox(array(), array("size"=>60, "style"=>"margin-bottom:3px", "value"=>trim($contacto->getCaEmail() )));
		}
		
		
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$widgets["cc_".$i] = new sfWidgetFormInputText(array(), array("size"=>60, "style"=>"margin-bottom:3px"));			
		}		
		
		
		$widgets['remitente'] = new sfWidgetFormChoice(array(
															  'choices' => array('traficos1@coltrans.com.co'=>'traficos1@coltrans.com.co', 'traficos2@coltrans.com.co'=>'traficos2@coltrans.com.co'),
															));
										
		$widgets['asunto'] = new sfWidgetFormInputText(array(), array("size"=>120 ));
		$widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows"=>4, "cols"=>140 ));		
		$widgets['instrucciones'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>140 ));		
		$widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows"=>4, "cols"=>140 ));				
		$widgets['archivo'] = new sfWidgetFormInputFile(array(), array("size"=>120 ));
                $widgets['hbltxt'] = new sfWidgetFormTextarea(array(), array("rows"=>4, "cols"=>140 ));
				
		
		
		
		//Seguimientos		
		$widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox( array(), array("onClick"=>"crearSeguimiento()") );
		$widgets["fchseguimiento"] = new sfWidgetFormExtDate();
		$widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		
		$this->setWidgets( $widgets );
		
		foreach( $contactos as $contacto ){
			$validator["destinatarios_".$contacto->getCaIdcontacto()] =new sfValidatorEmail( array('required' => false ),
														array('invalid' => 'La dirección es invalida'));
		}
					
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$validator["cc_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}
		
		
		$validator["remitente"] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		
		
		$validator['asunto'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el asunto'));	
		$validator['instrucciones'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque las instrucciones'));
		$validator['introduccion'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque la introducción o el saludo del mensaje'));	
		
		
		
		$validator['notas'] = new sfValidatorString(array('required' => false ));
                $validator['hbltxt'] = new sfValidatorString(array('required' => false ));
		
		
														
		$validator['prog_seguimiento'] = new sfValidatorString(array('required' => false ) );												
		
		$validator['fchseguimiento'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
		$validator['txtseguimiento'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque un texto para el seguimiento'));
														
		$validator['archivo'] = new sfValidatorFile(array('required' => false));																									
		
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
		
		
		if( $taintedValues["prog_seguimiento"] ){
			$this->validatorSchema['fchseguimiento']->setOption('required', true);
			$this->validatorSchema['txtseguimiento']->setOption('required', true);
		}
		
		parent::bind($taintedValues,  $taintedFiles);
	}
	
	
	public function getContactosAg( ){
		return $this->contactosAg;
	}
	
	public function setContactosAg( $c ){
		$this->contactosAg = $c;			
	}
	
	
}
?>