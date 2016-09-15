<?
class NuevoContactoForm extends BaseForm{
    
    
	
	private $cargos = 
            array('Jefe de Oficina'=>'Jefe de Oficina',
													'Jefe Importación'=>'Jefe Importación',
													'Jefe Exportación'=>'Jefe Exportación',
													'Contacto Operativo'=>'Contacto Operativo',
                                                    'Ventas'=>'Ventas',
													''=>'Otro'
												);
	
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
		
        $request = sfContext::getInstance()->getRequest();
        
        if($request->getParameter("modo")=="prov"){
            $this->cargos["Representante Legal"] = "Representante Legal";
            $this->cargos["Socio"] = "Socio";
        }
        
		$this->setWidgets(array(
		  'idsucursal'    => new sfWidgetFormInputHidden(),
		  'idcontacto'    => new sfWidgetFormInputHidden(),
          'identificacion' => new sfWidgetFormInputText(array(), array("maxlength"=>"30" ,"size"=>"30")),  
		  'nombre'      => new sfWidgetFormInputText(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  'apellido'      => new sfWidgetFormInputText(array(), array("maxlength"=>"60" ,"size"=>"60")),
		  //'direccion'   => new sfWidgetFormInputText(array(), array("maxlength"=>"100" ,"size"=>"60")),
          'codigoarea'   => new sfWidgetFormInputText(array(), array("maxlength"=>"4" ,"size"=>"10") ),
		  'telefonos'   => new sfWidgetFormInputText(array(), array("maxlength"=>"50" ,"size"=>"60") ),
		  'fax'         => new sfWidgetFormInputText(array(), array("maxlength"=>"50" ,"size"=>"60")),
          'celular'   => new sfWidgetFormInputText(array(), array("maxlength"=>"50" ,"size"=>"60") ),  
          'skype'   => new sfWidgetFormInputText(array(), array("maxlength"=>"30" ,"size"=>"60") ),  
		  'email'       => new sfWidgetFormInputText( array(), array("maxlength"=>"50" ,"size"=>"60")),
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
  								'choices' => $this->cargos, 'expanded'=>true), array("onclick"=>"verificarCargo()", "maxlenght"=>40)),
          'otro_cargo'      => new sfWidgetFormInputText(array(), array("maxlength"=>"60" ,"size"=>"60")),
          'visibilidad'     => new sfWidgetFormChoice(array(
  								'choices' => array('1'=>'Todos',													
													'2'=>'Admon. Proveedores',
                                                    //'3'=>'Solo yo',
													
												), 'expanded'=>true)),
		  'tipo' 		=> new sfWidgetFormChoice(array(
  								'choices' => array('Oficial'=>'Oficial', 'No Oficial'=>'No Oficial'), 'expanded'=>true)),
  		  'sugerido'      => new sfWidgetFormInputCheckbox(),
		  'activo'      => new sfWidgetFormInputCheckbox(),
          'notificar_vencimientos'      => new sfWidgetFormInputCheckbox(),
		  'detalles' => new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) )
		));
	
		$this->setValidators(array(
		  'idcontacto'    => new sfValidatorDoctrineChoice(array('model' => 'IdsContacto', 'column' => 'ca_idcontacto', 'required' => false)),
		  'idsucursal'    => new sfValidatorDoctrineChoice(array('model' => 'IdsSucursal', 'column' => 'ca_idsucursal', 'required' => false)),
          'identificacion'      => new sfValidatorInteger(array('required' => false)),
          'nombre'      => new sfValidatorString(array('required' => true, "max_length"=>"60")),
		  'apellido'      => new sfValidatorString(array('required' => true, "max_length"=>"60")),
		  //'direccion'   => new sfValidatorString(array('required' => true)),
          'codigoarea'   => new sfValidatorString(array('required' => false)),
		  'telefonos'   => new sfValidatorString(array('required' => true)),
		  'fax'         => new sfValidatorString(array('required' => false)),
          'celular'         => new sfValidatorString(array('required' => false)),
          'skype'         => new sfValidatorString(array('required' => false)),
		
		  'email'       => new sfValidatorEmail(array('required' => false), 
														array('invalid' => 'La dirección es invalida')),
		  'impoexpo'     => new sfValidatorString(array('required' => true)),
		  'transporte'     => new sfValidatorString(array('required' => true)),
		  'visibilidad' => new sfValidatorString(array('required' => true)),
		  'cargo' => new sfValidatorString(array('required' => false)),
          'otro_cargo' => new sfValidatorString(array('required' => false)),
		  'sugerido'      => new sfValidatorBoolean(array('required' => false)),
		  'activo'      => new sfValidatorBoolean(array('required' => false)),
          'notificar_vencimientos'      => new sfValidatorBoolean(array('required' => false)),
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

        if( $taintedValues["cargo"]=="" ){
            $this->validatorSchema['cargo']->setOption('required', false);
            $this->validatorSchema['otro_cargo']->setOption('required', true);
        }
        
        if( $taintedValues["notificar_vencimientos"] ){
            $this->validatorSchema['email']->setOption('required', true);
        }
        
		parent::bind($taintedValues,  $taintedFiles);
	}


    public function getCargos(){
        return $this->cargos;
    }
	
	
}
?>