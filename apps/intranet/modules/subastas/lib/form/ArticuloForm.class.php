<?
class ArticuloForm extends BaseForm{
	
	
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
						
		$this->setWidgets(array(
		  'idarticulo'    => new sfWidgetFormInputHidden(),		 
		  'titulo'      => new sfWidgetFormInputText(array(), array("maxlength"=>"255" ,"size"=>"60")),
          'descripcion' => new sfWidgetFormTextarea(array(), array("rows"=>20, "cols"=>80 ) ),   
          'formapago' => new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>80 ) ),
          'fchvencimiento' => new sfWidgetFormExtDate(),
          'valor' => new sfWidgetFormInputText(array(), array("maxlength"=>"15" ,"size"=>"20")),
          'directa' => new sfWidgetFormChoice(array(
										  'choices' => array('true'=>'Compra Directa', 'false'=>'Subasta Normal'),          
						)),
          'incremento'      => new sfWidgetFormInputText(array(), array("maxlength"=>"15" ,"size"=>"20"))
		));
	
		$this->setValidators(array(
		  'idarticulo'    => new sfValidatorDoctrineChoice(array('model' => 'SubArticulo', 'column' => 'ca_idarticulo', 'required' => false)),		  
		  'titulo'      => new sfValidatorString(array('required' => true, "max_length"=>"255")),
		  'descripcion'      => new sfValidatorString(array('required' => true)),
          'formapago'      => new sfValidatorString(array('required' => true)),
          'valor'      => new sfValidatorNumber(array('required' => true, 'min'=>1)),
          'directa'      => new sfValidatorBoolean(array('required' => true)),
          'incremento'      => new sfValidatorNumber(array('required' => true, 'min'=>1)),
		  //'direccion'   => new sfValidatorString(array('required' => true)),
          'fchvencimiento'   => new sfValidatorDate(array('required' => false ), 
                                    array('required' => 'Por favor coloque la fecha de vencimiento') )
		  
		));												
																												
				
				
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){		
        
		parent::bind($taintedValues,  $taintedFiles);
	}


   
	
	
}
?>