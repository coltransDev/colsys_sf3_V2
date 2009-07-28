<?
class NuevoIdsForm extends sfForm{
	
		
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	

        
        $widgets['tipo_identificacion'] = new sfWidgetFormChoice(array(
															  'choices' => array('1'=>'R.U.T',
                                                                                 '2'=>'C.C.',
                                                                                 '3'=>'Consecutivo Interno Colsys',
                                                                                 '4'=>'Otro'
                                                                                ),
															),
                                                            array("onChange"=>"getDV()")
                                                    );

        $widgets['id'] = new sfWidgetFormInput(array(), array("size"=>30, "onChange"=>"getDV()" ));
        $widgets['dv'] = new sfWidgetFormInput(array(), array("size"=>3, "readOnly"=>"true" ));
        $widgets['nombre'] = new sfWidgetFormInput(array(), array("size"=>80 ));
        $widgets['website'] = new sfWidgetFormInput(array(), array("size"=>80 ));
		/*
		$widgets['idetapa'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'TrackingEtapa',
															  'add_empty' => false,
															  'method' => "getCaEtapa",
															  'criteria' => $this->criteriaIdEtapa
															)
															,
															array("onChange"=>"mostrar()")
															);
		
		
										
		
		$widgets['introduccion'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		$widgets['mensaje'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>140, "onChange=validarMensaje" ));
		$widgets['notas'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		$widgets['mensaje_dirty'] = new sfWidgetFormInputHidden();
		$widgets['mensaje_mask'] = new sfWidgetFormInputHidden();
				
		$widgets['piezas'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['peso'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		$widgets['volumen'] = new sfWidgetFormInput(array(), array("size"=>8 ));
		
		$widgets['fchsalida'] = new sfWidgetFormExtDate();
		$widgets['horasalida'] = new sfWidgetFormTime();
		$widgets['fchllegada'] = new sfWidgetFormExtDate();
		$widgets['fchcontinuacion'] = new sfWidgetFormExtDate();
		
		
		$widgets['doctransporte'] = new sfWidgetFormInput(array(), array("size"=>40, "maxlength"=>50 ));
		$widgets['docmaster'] = new sfWidgetFormInput(array(), array("size"=>40, "maxlength"=>100 ));
		$widgets['idnave'] = new sfWidgetFormInput(array(), array("size"=>40, "maxlength"=>50 ));
		
		$widgets['un_piezas'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaPiezas
															));
		$widgets['un_peso'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaPeso
															));		
		$widgets['un_volumen'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaVolumen
															));																										
		
		$widgets['fchrecibo'] = new sfWidgetFormExtDate();
		$widgets['horarecibo'] = new sfWidgetFormTime();
				
		for( $i=0; $i< self::NUM_EQUIPOS ; $i++ ){
			$widgets["equipos_tipo_".$i] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Concepto',
															  'add_empty' => false,
															  'method' => "getCaConcepto",
															   'key_method' => "getCaIdconcepto",
															  'criteria' => $this->criteriaConcepto,
															  "add_empty" => true
															));	
			$widgets["equipos_serial_".$i] = new sfWidgetFormInput(array(), array("size"=>14, "style"=>"margin-bottom:3px"));
			$widgets["equipos_cant_".$i] = new sfWidgetFormInput(array(), array("size"=>5, "style"=>"margin-bottom:3px"));		
		}	
		
		$widgets['datosbl'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		foreach( $this->widgetsClientes as $name=>$val ){
			
			$type = $val["type"];
			if( $type=="date" ){				
				$widgets[$name] = new sfWidgetFormExtDate();	
				$validator[$name] = new sfValidatorDate(array('required' => false ) ) ;		
							
			}else{
				$widgets[$name] = new sfWidgetFormInput();	
				$validator[$name] = new sfValidatorString(array('required' => false ) ) ;			
			}				
		}
		
		//Seguimientos		
		$widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox( array(), array("onClick"=>"crearSeguimiento()") );
		$widgets["fchseguimiento"] = new sfWidgetFormExtDate();
		$widgets['txtseguimiento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		*/
		
		$this->setWidgets( $widgets );


        $validator["tipo_identificacion"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de identificación es requerido'));

        $validator["id"] =new sfValidatorString( array('required' => true ),
														array('required' => 'La identificación es requerida'));
        

        $validator["dv"] =new sfValidatorString( array('required' => false ),
														array('required' => 'El DV es requerido'));

        $validator["nombre"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El nombre es requerido'));

        $validator["website"] =new sfValidatorString( array('required' => false ));

        $validator["idgrupo"] =new sfValidatorString( array('required' => false ));

        $this->setValidators( $validator );
		/*
		
		for( $i=0; $i< count($destinatarios) ; $i++ ){
			$validator["destinatarios_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}
			
		for( $i=0; $i< self::NUM_CC ; $i++ ){
			$validator["cc_".$i] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		}
		
		
		$validator["remitente"] =new sfValidatorEmail( array('required' => false ), 
														array('invalid' => 'La dirección es invalida'));
		
		$validator['idetapa'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'La etapa es obligatoria'));
		$validator['asunto'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el asunto'));	
		
		$validator['introduccion'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque la introducción o el saludo del mensaje'));	
		
		$validator['mensaje'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque el status'));	
		
		$validator['notas'] = new sfValidatorString(array('required' => false ));
		
		$validator['piezas'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque las piezas',
																'invalid' => 'No valido'));	
		$validator['peso'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque el peso',
																'invalid' => 'No valido'));	
		$validator['volumen'] = new sfValidatorNumber(array('required' => false ), 
														array('required' => 'Por favor coloque el volumen',
																'invalid' => 'No valido'
																));	
		$validator['un_piezas'] = new sfValidatorString(array('required' => false ));		
		$validator['un_peso'] = new sfValidatorString(array('required' => false ));		
		$validator['un_volumen'] = new sfValidatorString(array('required' => false ));		
		$validator['doctransporte'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque el HBL/HAWB'));	
		$validator['idnave'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque la motonave o el vuelo'));
		$validator['docmaster'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque el BL'));	
		$validator['fchsalida'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de salida'));			
		$validator['fchllegada'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de llegada'));			
		
		$validator['fchcontinuacion'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque la fecha de continuación'));																	

		$validator['fchrecibo'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en la fecha en que usted recibió este status'));			
		$validator['horarecibo'] = new sfValidatorTime(array('required' => true ), 
														array('required' => 'Por favor coloque en la hora que usted recibió este status'));																												
		
		$validator['horasalida'] = new sfValidatorTime(array('required' => false ));		
		
		
		for( $i=0; $i< self::NUM_EQUIPOS ; $i++ ){
			$validator["equipos_tipo_".$i] = new sfValidatorString(array('required' => false ));
			$validator["equipos_serial_".$i] = new sfValidatorString(array('required' => false ));
			$validator["equipos_cant_".$i] = new sfValidatorNumber(array('required' => false, "min"=>0 ), 
														array('invalid' => 'No valido'));	
		}
		
		$validator['mensaje_mask'] = new sfValidatorString(array('required' => false ));
		
		
		$validator['datosbl'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque los datos para reclamar el BL en destino'));
														
		$validator['prog_seguimiento'] = new sfValidatorString(array('required' => false ) );												
		
		$validator['fchseguimiento'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
		$validator['txtseguimiento'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Por favor coloque un texto para el seguimiento'));
														
																												
		
		//echo isset($validator['fchdoctransporte'])."<br />";															
		
		
		
		$this->validatorSchema->setPostValidator(
		  new sfValidatorSchemaCompare('fchrecordar', '<=', 'fchseguimiento', array(), array("invalid"=>"Esta fecha debe ser menor que la fecha de seguimiento"))
		);*/
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		
        if( $taintedValues["tipo_identificacion"]==1 ){
            $this->validatorSchema['dv']->setOption('required', true);
        }

		if( $taintedValues["tipo_identificacion"]==3 ){
			$this->validatorSchema['identificacion']->setOption('required', false);
		}
		
		parent::bind($taintedValues,  $taintedFiles);
	}
	
}
?>