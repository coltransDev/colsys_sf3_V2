<?
class NuevoIdsForm extends BaseForm{

		
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	

        $q = Doctrine_Query::create()
                             ->from("IdsTipoIdentificacion c")
                             ->leftJoin("c.Trafico t")
                             ->addOrderBy("c.ca_tipoidentificacion");
        $widgets['tipo_identificacion'] = new sfWidgetFormDoctrineChoice(array('model' => 'IdsTipoIdentificacion',                                                                               
                                                                               'add_empty' => false,
                                                                               'query' => $q),
                                                                         array("onChange"=>"getDV(true)"));
        
       
        $widgets['id'] = new sfWidgetFormInputHidden();
        $widgets['idalterno'] = new sfWidgetFormInputText(array(), array("size"=>30, "onChange"=>"getDV(true)" ));
        $widgets['dv'] = new sfWidgetFormInputText(array(), array("size"=>3, "readOnly"=>"true" ));
        $widgets['nombre'] = new sfWidgetFormInputText(array(), array("size"=>80 ));
        $widgets['website'] = new sfWidgetFormInputText(array(), array("size"=>60 ));
        
        
		$this->setWidgets( $widgets );


        $validator["tipo_identificacion"] =new sfValidatorString( array('required' => true ), array('required' => 'El tipo de identificación es requerido'));

        $validator["id"] =new sfValidatorInteger( array('required' => false ) );
        
        $validator["idalterno"] =new sfValidatorInteger( array('required' => true ), array('required' => 'La identificación es requerida'));
        
        $validator["dv"] =new sfValidatorInteger( array('required' => false ), array('required' => 'El DV es requerido'));

        $validator["nombre"] =new sfValidatorString( array('required' => true ), array('required' => 'El nombre es requerido', "max_length"=>255));

        $validator["website"] =new sfValidatorString( array('required' => false, "max_length"=>200 ));

        $validator["idgrupo"] =new sfValidatorInteger( array('required' => false ));
        
        $this->setValidators( $validator );
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		
            if( $taintedValues["tipo_identificacion"]==1 ){
                $this->validatorSchema['dv']->setOption('required', true);
            } else if( $taintedValues["tipo_identificacion"]==3 ){
                $this->validatorSchema['idalterno']->setOption('required', false);
            } else {
                $this->validatorSchema['idalterno'] = new sfValidatorString( array('required' => true ), array('required' => 'La identificación es requerida'));
            }
	
            parent::bind($taintedValues,  $taintedFiles);
	}
	
}
?>