<?
class NuevoContactoForm extends sfForm{
	
	
	
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
				
		$this->setWidgets(array(
		  'idagente'    => new sfWidgetFormInputHidden(),
		  'idcontacto'    => new sfWidgetFormInputHidden(),
		  'nombre'      => new sfWidgetFormInput(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'apellido'      => new sfWidgetFormInput(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'direccion'   => new sfWidgetFormInput(array(), array("maxlength"=>"100" ,"size"=>"60")),
		  'telefonos'   => new sfWidgetFormInput(array(), array("maxlength"=>"30" ,"size"=>"60") ),
		  'fax'         => new sfWidgetFormInput(array(), array("maxlength"=>"30" ,"size"=>"60")),
		  'idciudad'    => new sfWidgetFormPropelChoice(array('model' => 'Ciudad', 'add_empty' => false, 'order_by'=>array('CaCiudad', 'ASC'))),
		  'email'       => new sfWidgetFormInput( array(), array("maxlength"=>"40" ,"size"=>"60")),
		  'impoexpo'     => new sfWidgetFormChoice(array(
  								'choices' => array( Constantes::IMPO=>Constantes::IMPO,
													Constantes::EXPO=>Constantes::EXPO), 
								 'expanded'=>true, "multiple"=>true)),
		  'transporte'     => new sfWidgetFormChoice(array(
  								'choices' => array( Constantes::AEREO=>Constantes::AEREO, 
													Constantes::MARITIMO=>Constantes::MARITIMO, 
													Constantes::TERRESTRE=>Constantes::TERRESTRE), 
								 'expanded'=>true, "multiple"=>true)),
		  'cargo'     => new sfWidgetFormChoice(array(
  								'choices' => array('Jefe de Oficina'=>'Jefe de Oficina', 
													'Jefe Importación'=>'Jefe Importación', 
													'Jefe Exportación'=>'Jefe Exportación', 
													'Contacto Operativo'=>'Contacto Operativo'
												
												), 'expanded'=>true)),
		  						
		 
		  'tipo' 		=> new sfWidgetFormChoice(array(
  								'choices' => array('Oficial'=>'Oficial', 'No Oficial'=>'No Oficial'), 'expanded'=>true)),
  		  'sugerido'      => new sfWidgetFormInputCheckbox(),
		  'activo'      => new sfWidgetFormInputCheckbox(),
		));
	
		$this->setValidators(array(
		  'idcontacto'    => new sfValidatorPropelChoice(array('model' => 'ContactoAgente', 'column' => 'ca_idcontacto', 'required' => false)),	
		  'idagente'    => new sfValidatorPropelChoice(array('model' => 'Agente', 'column' => 'ca_idagente', 'required' => false)),
		  'nombre'      => new sfValidatorString(array('required' => true)),
		  'apellido'      => new sfValidatorString(array('required' => true)),
		  'direccion'   => new sfValidatorString(array('required' => true)),
		  'telefonos'   => new sfValidatorString(array('required' => true)),
		  'fax'         => new sfValidatorString(array('required' => false)),
		  'idciudad'    => new sfValidatorPropelChoice(array('model' => 'Ciudad', 'column' => 'ca_idciudad', 'required' => true)),
		  'email'       => new sfValidatorEmail(array('required' => false), 
														array('invalid' => 'La dirección es invalida')),
		  'impoexpo'     => new sfValidatorString(array('required' => true)),
		  'transporte'     => new sfValidatorString(array('required' => true)),
		  
		  'cargo' => new sfValidatorString(array('required' => true)),
		  'sugerido'      => new sfValidatorBoolean(array('required' => false)),
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