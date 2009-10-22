<?
class NuevoContactoForm extends BaseForm{
	
	
	
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
		
		
				
		$this->setWidgets(array(
		  'idsucursal'    => new sfWidgetFormInputHidden(),
		  'idcontacto'    => new sfWidgetFormInputHidden(),
		  'nombre'      => new sfWidgetFormInputText(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'apellido'      => new sfWidgetFormInputText(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  //'direccion'   => new sfWidgetFormInputText(array(), array("maxlength"=>"100" ,"size"=>"60")),
          'codigoarea'   => new sfWidgetFormInputText(array(), array("maxlength"=>"4" ,"size"=>"10") ),
		  'telefonos'   => new sfWidgetFormInputText(array(), array("maxlength"=>"30" ,"size"=>"60") ),
		  'fax'         => new sfWidgetFormInputText(array(), array("maxlength"=>"30" ,"size"=>"60")),
		
		  'email'       => new sfWidgetFormInputText( array(), array("maxlength"=>"40" ,"size"=>"60")),
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
													'Contacto Operativo'=>'Contacto Operativo',
                                                    'Ventas'=>'Ventas',
													''=>'Otro'												
												), 'expanded'=>true)),
		  						
          'visibilidad'     => new sfWidgetFormChoice(array(
  								'choices' => array('1'=>'Todos',													
													'2'=>'Admon. Proveedores',
                                                    //'3'=>'Solo yo',
													
												), 'expanded'=>true)),
		  'tipo' 		=> new sfWidgetFormChoice(array(
  								'choices' => array('Oficial'=>'Oficial', 'No Oficial'=>'No Oficial'), 'expanded'=>true)),
  		  'sugerido'      => new sfWidgetFormInputCheckbox(),
		  'activo'      => new sfWidgetFormInputCheckbox(),
		  'detalles' => new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) )
		));
	
		$this->setValidators(array(
		  'idcontacto'    => new sfValidatorDoctrineChoice(array('model' => 'IdsContacto', 'column' => 'ca_idcontacto', 'required' => false)),
		  'idsucursal'    => new sfValidatorDoctrineChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false)),
		  'nombre'      => new sfValidatorString(array('required' => true)),
		  'apellido'      => new sfValidatorString(array('required' => true)),
		  //'direccion'   => new sfValidatorString(array('required' => true)),
          'codigoarea'   => new sfValidatorString(array('required' => false)),
		  'telefonos'   => new sfValidatorString(array('required' => true)),
		  'fax'         => new sfValidatorString(array('required' => false)),
		
		  'email'       => new sfValidatorEmail(array('required' => false), 
														array('invalid' => 'La dirección es invalida')),
		  'impoexpo'     => new sfValidatorString(array('required' => true)),
		  'transporte'     => new sfValidatorString(array('required' => true)),
		  'visibilidad' => new sfValidatorString(array('required' => true)),
		  'cargo' => new sfValidatorString(array('required' => false)),
		  'sugerido'      => new sfValidatorBoolean(array('required' => false)),
		  'activo'      => new sfValidatorBoolean(array('required' => false)),
		   'detalles'      => new sfValidatorString(array('required' => false)),
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