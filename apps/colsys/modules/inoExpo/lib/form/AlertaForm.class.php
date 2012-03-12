<?
class AlertaForm extends BaseForm{
	    
    
	public function configure(){
		
		sfValidatorBase::setCharset('ISO-8859-1');
				
		$widgets = array();		
		$validator = array();	
		
        
       
        $widgets["referencia"] = new sfWidgetFormInputHidden();
        $widgets["idalerta"] = new sfWidgetFormInputHidden();
        $widgets["fchrecordatorio"] = new sfWidgetFormExtDate();
        $widgets["fchvencimiento"] = new sfWidgetFormExtDate();
        $widgets['cuerpoalerta'] = new sfWidgetFormTextarea(array(), array("rows"=>5, "cols"=>50 ));
        $widgets["copiarChkbox"] = new sfWidgetFormInputCheckbox(array(), array("onClick"=>"copiarNotificacion()") );
        
        $queryUsuario = Doctrine::getTable("Usuario")
                        ->createQuery("c")                      
                        ->addWhere("c.ca_activo = ? ", true)                                     
                        ->addOrderBy("c.ca_nombre");
        $widgets['notificar'] = new sfWidgetFormDoctrineChoice(array(
															  'model' => 'Usuario',
															  'add_empty' => false,
															  'method' => "getCaNombre",
															  'query' => $queryUsuario
															) );
        
        $widgets["notificar_jefe"] = new sfWidgetFormInputCheckbox();
        
		$this->setWidgets( $widgets );
		
        
        $validator['idalerta'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['referencia'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['fchrecordatorio'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
        
        
        $validator['fchvencimiento'] = new sfValidatorDate(array('required' => true ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
        

        
        $validator['cuerpoalerta'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['notificar'] = new sfValidatorString(array('required' => false ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['notificar_jefe'] = new sfValidatorBoolean(array('required' => false ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
        
        $validator['copiarChkbox'] = new sfValidatorBoolean(array('required' => false ), 
														array('required' => 'Requerido',
																'invalid' => 'No valido'));	
																
		$this->setValidators( $validator );
        
        
       
	}	
	
	
    
	
}
?>