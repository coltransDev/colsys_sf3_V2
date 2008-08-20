<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesComponents extends sfComponents
{	
	/*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executeRelacionDeConceptos()
	{
		
		$via = $this->reporteNegocio->getCaTransporte();
				
			
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RepTarifaPeer::OID );
		$this->conceptos = $this->reporteNegocio->getRepTarifas( $c );	
		
		$c = new Criteria();
		$this->monedas = MonedaPeer::doSelect($c);
				
		$via = $this->reporteNegocio->getCaTransporte();
				
		$c = new Criteria();
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_CONCEPTO  );
		
		$c->add(ConceptoPeer::CA_TRANSPORTE, $this->reporteNegocio->getCaTransporte() , Criteria::LIKE);
		if(  $this->reporteNegocio->getCaTransporte()!= 'Terrestre'){
			$c->add( ConceptoPeer::CA_MODALIDAD , $this->reporteNegocio->getCaModalidad() );
		}
		
	
		$this->conceptosSel = ConceptoPeer::doSelect( $c );
		
		
	}
	
	/*
	* Muestra los recargos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/	
	public function executeRelacionDeRecargos()
	{			
		$this->gastos = $this->reporteNegocio->getRecargos( $this->tipo );	
		
		$c = new Criteria();
		
		if( $this->reporteNegocio->getCaImpoExpo()=="Importación" ){
			if( $this->tipo == "local" ){
				$c->add( TipoRecargoPeer::CA_TIPO, "Recargo Local" );		
			}else{
				$c->add( TipoRecargoPeer::CA_TIPO, "Recargo en Origen" );		
			}
		}				
		
		$c->add( TipoRecargoPeer::CA_TRANSPORTE , $this->reporteNegocio->getCaTransporte() , Criteria::LIKE );				
		$c->add( TipoRecargoPeer::CA_IMPOEXPO , "%".$this->reporteNegocio->getCaImpoExpo()."%" , Criteria::LIKE );
				
		/*
		if( $this->reporteNegocio->getCaIncoterms()=="EX-WORK" ){
			$incoterms = "EXW";
		}else{
			$incoterms = $this->reporteNegocio->getCaIncoterms();
		}
		$c->add( TipoRecargoPeer::CA_INCOTERMS , "%".$incoterms."%", Criteria::LIKE );*/
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_TRANSPORTE );
		$c->addAscendingOrderByColumn( TipoRecargoPeer::CA_RECARGO );
		$this->recargos = TipoRecargoPeer::doSelect($c);
		
		
		$c = new Criteria();
		$this->monedas = MonedaPeer::doSelect($c);
		
		$via = $this->reporteNegocio->getCaTransporte();
				
		$c = new Criteria();
		$c->addAscendingOrderByColumn( ConceptoPeer::CA_CONCEPTO  );
		
		$c->add( ConceptoPeer::CA_TRANSPORTE , $this->reporteNegocio->getCaTransporte(), Criteria::LIKE );			
		$c->add( ConceptoPeer::CA_MODALIDAD , $this->reporteNegocio->getCaModalidad() );	
			
		$this->conceptosSel = ConceptoPeer::doSelect( $c );
	}
	
	/*
	* Muestra los recargos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executeRelacionDeCostos()
	{				
		
		$this->costos = $this->reporteNegocio->getCostos( );		
		
		$c = new Criteria();	
						
		
		$c->add( CostoPeer::CA_IMPOEXPO , "Aduanas" );			
				
		if( $this->reporteNegocio->getCaImpoExpo()=="Exportación" ){
			$c->addOr( CostoPeer::CA_IMPOEXPO , "Exportacion" );
		}
			
		if( $this->reporteNegocio->getCaTransporte()=="Marítimo"){
			$c->add(CostoPeer::CA_TRANSPORTE,  "Marítimo", Criteria::LIKE);
			$c->addOr(CostoPeer::CA_TRANSPORTE,  "Maritimo", Criteria::LIKE);
		}
		
		if( $this->reporteNegocio->getCaTransporte()=="Aéreo"){
			$c->add(CostoPeer::CA_TRANSPORTE,  "Aéreo", Criteria::LIKE);
			$c->addOr(CostoPeer::CA_TRANSPORTE,  "Aereo", Criteria::LIKE);
		}
				
		if( $this->reporteNegocio->getCaTransporte()=="Terrestre"){
			$c->add(CostoPeer::CA_TRANSPORTE,  "Terrestre", Criteria::LIKE);			
		}
							
		$c->addAscendingOrderByColumn( CostoPeer::CA_IMPOEXPO );	
		$c->addAscendingOrderByColumn( CostoPeer::CA_COSTO );
						
		$this->conceptos = CostoPeer::doSelect( $c ); 
		
		$c = new Criteria();
		$this->monedas = MonedaPeer::doSelect($c);
	}
	
	/*
	* Muestra un formulario con los campos especiales de exportaciones 
	* @author: Andres Botero
	*/
	public function executeFormExpo(){
		
		$this->tiposexpo = ParametroPeer::retrieveByCaso( "CU011" );	
				
		$this->tipo_piezas = ParametroPeer::retrieveByCaso( "CU047" );	
		$this->tipo_pesos = ParametroPeer::retrieveByCaso( "CU049" );			
		$this->tipo_volumen = ParametroPeer::retrieveByCaso( "CU050" );
		
		
		$this->repexpo = $this->reporteNegocio->getRepExpo();
		
		$c=new Criteria();
		$c->addAscendingOrderByColumn( SiaPeer::CA_NOMBRE );
		$this->sias = SiaPeer::doSelect( $c );
	}
	
	/*	
	* Muestra el formulario con los campos para el transporte terrestre nal
	*/
	public function executeFormTransporteNal(){		
		$this->transnatipo = ParametroPeer::retrieveByCaso( "CU056" , null, $this->reporteNegocio->getCaImpoExpo());		
		
	}
	
		
}
?>