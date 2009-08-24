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
        $widgets['id'] = new sfWidgetFormInputHidden();
        $widgets['idalterno'] = new sfWidgetFormInput(array(), array("size"=>30, "onChange"=>"getDV()" ));
        $widgets['dv'] = new sfWidgetFormInput(array(), array("size"=>3, "readOnly"=>"true" ));
        $widgets['nombre'] = new sfWidgetFormInput(array(), array("size"=>80 ));
        $widgets['website'] = new sfWidgetFormInput(array(), array("size"=>80 ));
		
		
		$this->setWidgets( $widgets );


        $validator["tipo_identificacion"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El tipo de identificación es requerido'));

        $validator["id"] =new sfValidatorString( array('required' => false ) );
        $validator["idalterno"] =new sfValidatorString( array('required' => true ),
														array('required' => 'La identificación es requerida'));
        

        $validator["dv"] =new sfValidatorString( array('required' => false ),
														array('required' => 'El DV es requerido'));

        $validator["nombre"] =new sfValidatorString( array('required' => true ),
														array('required' => 'El nombre es requerido'));

        $validator["website"] =new sfValidatorString( array('required' => false ));

        $validator["idgrupo"] =new sfValidatorString( array('required' => false ));

        $this->setValidators( $validator );
		
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		
        if( $taintedValues["tipo_identificacion"]==1 ){
            $this->validatorSchema['dv']->setOption('required', true);
        }

        if( $taintedValues["tipo_identificacion"]==3 ){
            $this->validatorSchema['idalterno']->setOption('required', false);
        }
		
		
		parent::bind($taintedValues,  $taintedFiles);
	}
	
}
?>