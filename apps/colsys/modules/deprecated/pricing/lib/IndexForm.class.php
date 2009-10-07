<?
class IndexForm extends sfForm
{
	protected static $impoexpoChoices = array("Importación"=>"Importaci&oacute;n", "Exportación"=>"Exportaci&oacute;n");
	protected static $transporteChoices = array("Marítimo"=>"Mar&iacute;timo", "Aéreo"=>"A&eacute;reo");
	protected static $mod_mar;
	protected static $mod_aer;
	protected static $traficos;
	protected static $aerolineas;
	protected static $navieras;
		
	public function __construct(){
		self::$mod_mar = ParametroPeer::retrieveByCaso("CU051");
		self::$mod_aer = ParametroPeer::retrieveByCaso("CU052");
		
		$c = new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		
		self::$traficos = TraficoPeer::doSelect( $c );
		
		self::$aerolineas = TransportadorPeer::retrieveByTransporte( "Aéreo" );							
		self::$navieras = TransportadorPeer::retrieveByTransporte( "Marítimo" );
		
		parent::__construct();
	}
			
	public function configure()
	{
				
		$this->setWidgets(array(
		  'impoexpo'    => new sfWidgetFormSelect( array('choices' => self::$impoexpoChoices) ),
		  'transporte'   => new sfWidgetFormSelect(array('choices' => self::$transporteChoices), array("onChange"=>"cambiarTransporte(this.value)")),
		  'modalidad_mar' => new sfWidgetFormObjectSelect(array("objects"=>self::$mod_mar, "value"=>"getCaValor", "method"=>"getCaValor")),
		  'modalidad_aer' => new sfWidgetFormObjectSelect(array("objects"=>self::$mod_aer, "value"=>"getCaValor", "method"=>"getCaValor")),	
		  'trafico_id' => new sfWidgetFormObjectSelect(array("objects"=>self::$traficos )),	
		  'idnaviera' => new sfWidgetFormObjectSelect(array("objects"=>self::$navieras, "method"=>"getCaNombre" , "add_empty"=>true )),
		  'idaerolinea' => new sfWidgetFormObjectSelect(array("objects"=>self::$aerolineas, "method"=>"getCaNombre", "add_empty"=>true ))
		  
		  
		));
	}
}
?>