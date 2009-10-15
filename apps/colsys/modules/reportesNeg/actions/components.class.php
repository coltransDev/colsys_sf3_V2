<?php

/**
 * clientes components.
 *
 * @package    colsys
 * @subpackage reportes
 * @author     Andres Botero
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportesNegComponents extends sfComponents
{	
	/*
	* Muestra los conceptos del reporte y un formulario para agregar un nuevo registro, tambien 
	* permite editar un campo haciendo doble click en el.
	* @author: Andres Botero
	*/
	public function executeRelacionDeConceptos()
	{
		
		$via = $this->reporteNegocio->getCaTransporte();
				
			
		
		$this->conceptos = $this->reporteNegocio->getRepTarifa();	
		
		
		$this->monedas = Doctrine::getTable("Moneda")->findAll();
				
		$via = $this->reporteNegocio->getCaTransporte();
				
		$q = Doctrine::getTable("Concepto")
                  ->createQuery("c")
                  ->where("c.ca_transporte = ? ", $this->reporteNegocio->getCaTransporte());

       
		
		
		if(  $this->reporteNegocio->getCaTransporte()!= 'Terrestre'){
            $q->addWhere("c.ca_modalidad = ?", $this->reporteNegocio->getCaModalidad());
		}
		
	
		$this->conceptosSel = $q->execute();
		
		
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
		
		$this->tiposexpo = ParametroTable::retrieveByCaso( "CU011" );
				
		$this->tipo_piezas = ParametroTable::retrieveByCaso( "CU047" );
		$this->tipo_pesos = ParametroTable::retrieveByCaso( "CU049" );
		$this->tipo_volumen_maritimo = ParametroTable::retrieveByCaso( "CU050" );
		$this->tipo_volumen_aereo = ParametroTable::retrieveByCaso( "CU058" );
		
		$this->repexpo = $this->reporteNegocio->getRepExpo();
		
		$this->sias = Doctrine::getTable("Sia")
                                ->createQuery("s")
                                ->addOrderBy("s.ca_nombre")
                                ->execute();
	}
	
	/*	
	* Muestra el formulario con los campos para el transporte terrestre nal
	*/
	public function executeFormTransporteNal(){		
		$this->transnatipo = ParametroTable::retrieveByCaso( "CU056" , null, $this->reporteNegocio->getCaImpoExpo());
		
	}
	
		
}
?>