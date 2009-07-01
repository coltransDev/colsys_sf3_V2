<?
class SeguimientoForm extends sfForm{
	private $criteriaEtapas = null;

	public function configure(){
		sfValidatorBase::setCharset('ISO-8859-1');
						
		$widgets = array();		
		
		$widgets['seguimiento'] = new sfWidgetFormTextarea(array(), array("rows"=>3, "cols"=>140 ));
		
		$widgets['etapa'] = new sfWidgetFormPropelChoice(array(
															  'model' => 'Parametro',
															  'add_empty' => false,
															  'method' => "getCaValor2",
															   'key_method' => "getCaValor",
															  'criteria' => $this->criteriaEtapas
															));		
		
		$widgets["prog_seguimiento"] = new sfWidgetFormInputCheckbox( array(), array("onClick"=>"crearSeguimiento()") );
		$widgets["fchseguimiento"] = new sfWidgetFormExtDate();
		
		$this->setWidgets( $widgets );
		
		
		$validator = array();	
		
		$validator['seguimiento'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque un texto para el seguimiento'));
		$validator['etapa'] = new sfValidatorString(array('required' => true ), 
														array('required' => 'Por favor coloque la etapa'));												
		$validator['prog_seguimiento'] = new sfValidatorString(array('required' => false ) );												
		
		$validator['fchseguimiento'] = new sfValidatorDate(array('required' => false ), 
														array('required' => 'Por favor coloque en una fecha valida'));	
														
		$this->setValidators( $validator );
	}	
	
	
	public function bind(array $taintedValues = null, array $taintedFiles = null){
		
		if( $taintedValues["etapa"]=="APR"){
			 $this->validatorSchema['seguimiento']->setOption('required', false);	 
		}	
		
		if( $taintedValues["prog_seguimiento"] ){
			$this->validatorSchema['fchseguimiento']->setOption('required', true);		
		}
		
		parent::bind($taintedValues);
	}
	
	public function setCriteriaEtapas( $c ){
		$this->criteriaEtapas = $c;		
	}
}
?>