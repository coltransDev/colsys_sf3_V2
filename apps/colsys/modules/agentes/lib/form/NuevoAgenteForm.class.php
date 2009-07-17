<?
class NuevoAgenteForm extends sfForm{
	
	
	
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
		
		$criteriaCiudades = new Criteria();
		$criteriaCiudades->addJoin( TraficoPeer::CA_IDTRAFICO, CiudadPeer::CA_IDTRAFICO );		
		$criteriaCiudades->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );		
				
		$this->setWidgets(array(
		  'idagente'    => new sfWidgetFormInputHidden(),
		  'nombre'      => new sfWidgetFormInput(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'direccion'   => new sfWidgetFormInput(array(), array("maxlength"=>"100" ,"size"=>"60")),
		  'telefonos'   => new sfWidgetFormInput(array(), array("maxlength"=>"30" ,"size"=>"60") ),
		  'fax'         => new sfWidgetFormInput(array(), array("maxlength"=>"30" ,"size"=>"60")),
		  'idciudad'    => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => false, 'criteria' => $criteriaCiudades)),
		  'zipcode'     => new sfWidgetFormInput( array(), array("maxlength"=>"10" ,"size"=>"20")),
		  'website'     => new sfWidgetFormInput(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'email'       => new sfWidgetFormInput( array(), array("maxlength"=>"40" ,"size"=>"60")),
		  'tipo' 		=> new sfWidgetFormChoice(array(
  'choices' => array('Oficial'=>'Oficial', 'No Oficial'=>'No Oficial'), 'expanded'=>true,
)),
		  'activo'      => new sfWidgetFormInputCheckbox(),
		));
	
		$this->setValidators(array(
		  'idagente'    => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
		  'nombre'      => new sfValidatorString(array('required' => true)),
		  'direccion'   => new sfValidatorString(array('required' => true)),
		  'telefonos'   => new sfValidatorString(array('required' => true)),
		  'fax'         => new sfValidatorString(array('required' => false)),
		  'idciudad'    => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => true)),
		  'zipcode'     => new sfValidatorString(array('required' => false)),
		  'website'     => new sfValidatorString(array('required' => false)),
		  'email'       => new sfValidatorEmail(array('required' => false), 
														array('invalid' => 'La dirección es invalida')),
		  'tipo' => new sfValidatorString(array('required' => true)),
		  'activo'      => new sfValidatorBoolean(array('required' => false)),
		));												
																												
		
		//echo isset($validator['fchdoctransporte'])."<br />";															
		//$this->setValidators( $validator );
		
		
		
				
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