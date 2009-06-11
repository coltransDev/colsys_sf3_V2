<?php

/**
 * widgets actions.
 *
 * @package    colsys
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class widgetsActions extends sfActions
{
	/**
	* Retorna un objeto JSON con la información de todos los paises
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosPaises($request)
	{		
		$c=new Criteria();
		$c->add( TraficoPeer::CA_IDTRAFICO, '99-999', Criteria::NOT_EQUAL );			
		$c->addAscendingOrderByColumn( TraficoPeer::CA_NOMBRE );
		$traficos_rs = TraficoPeer::doSelect( $c );
		
		$this->traficos = array();
		
		foreach($traficos_rs as $trafico){
			$row = array("idtrafico"=>$trafico->getCaIdTrafico(),"trafico"=>utf8_encode($trafico->getCaNombre()));
			$this->traficos[]=$row;
		}
		$this->setLayout("ajax");
	}
	
	/**
	* Retorna un objeto JSON con la información de todas las ciudades
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosCiudades($request)
	{		
		$idpais = utf8_decode($this->getRequestParameter("idpais"));
		$query = utf8_decode($this->getRequestParameter("query"));
		$c=new Criteria();
		$c->add( CiudadPeer::CA_IDTRAFICO, $idpais );
		$c->addAscendingOrderByColumn( CiudadPeer::CA_CIUDAD );
		if( $query ){
			$c->add( CiudadPeer::CA_CIUDAD, "LOWER(".CiudadPeer::CA_CIUDAD.") LIKE '".strtolower($query)."%'", Criteria::CUSTOM );
		}
		
		$ciudades_rs = CiudadPeer::doSelect( $c );
		
		$this->ciudades = array();		
		foreach($ciudades_rs as $ciudad){
			$row = array('idciudad'=>$ciudad->getCaIdCiudad(),"ciudad"=>utf8_encode($ciudad->getCaCiudad()));
			$this->ciudades[]=$row;
		}
		$this->setLayout("ajax");		
	}
	
	/**
	* Retorna un objeto JSON con la información de todas las lineas
	*
	* @param sfRequest $request A request object
	*/
	public function executeDatosLineas($request)
	{		
		$idlinea = utf8_decode($this->getRequestParameter("idlinea"));
		$transporte = utf8_decode($this->getRequestParameter("transporte"));
		$query = utf8_decode($this->getRequestParameter("query"));
		
		$lineas = TransportadorPeer::retrieveByTransporte( $transporte, $query );			
		$this->lineas = array();	
		foreach( $lineas as $linea ){
			$this->lineas[] = array(  "idlinea"=>$linea->getCaIdLinea(),
									"linea"=>$linea->getCaNombre()
								);	
		}						
		
		$this->setLayout("ajax");		
	}
	
	/*
	* Datos de las modalidades según sea el medio de transporte
	*/
	public function executeDatosModalidades(){
		$transport_parameter = utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo_parameter = utf8_decode($this->getRequestParameter("impoexpo"));
		
		if ( $transport_parameter == Constantes::MARITIMO)	{
			$transportes = ParametroPeer::retrieveByCaso( "CU051",null, $impoexpo_parameter);
		}else if ( $transport_parameter == Constantes::AEREO )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU052",null, $impoexpo_parameter);
		}else if ( $transport_parameter ==  Constantes::TERRESTRE )	{
			$transportes = ParametroPeer::retrieveByCaso( "CU053",null, $impoexpo_parameter);
		}
		$this->modalidades = array();
		
		foreach($transportes as $transporte){
			$row = array("modalidad"=>$transporte->getCaValor());
			$this->modalidades[]=$row;
		}
		$this->setLayout("ajax");
	}
	
	
	
	/*
	* 
	*/	
	public function executeDatosComboClientes(){
		$criterio =  $this->getRequestParameter("query");
		$c = new Criteria();
		$c->addSelectColumn(ClientePeer::CA_IDCLIENTE );
		$c->addSelectColumn(ClientePeer::CA_COMPANIA );		
		$c->addSelectColumn(ClientePeer::CA_PREFERENCIAS );
		$c->addSelectColumn(ClientePeer::CA_CONFIRMAR );
		
		$c->setDistinct();			
		$c->add( ClientePeer::CA_COMPANIA , "lower(".ClientePeer::CA_COMPANIA.") LIKE '%".strtolower( $criterio )."%'", Criteria::CUSTOM );	
		
		$c->addAscendingOrderByColumn( ClientePeer::CA_COMPANIA );		
		$c->setLimit(40);
		$stmt = ClientePeer::doSelectStmt( $c );
		
		$this->clientes = array();
 
   		while ( $row = $stmt->fetch( PDO::FETCH_NUM ) ) {
      		$this->clientes[] = array('ca_idcliente'=>$row[0],
                                      'ca_compania'=>utf8_encode($row[1]),
									  'ca_preferencias'=>utf8_encode($row[2]),
									  'ca_confirmar'=>utf8_encode($row[3]),
                                 );
		}					
		$this->setLayout("none");
	}
	
	/*
	* 
	*/	
	public function executeDatosComboReportes(){
		$criterio =  $this->getRequestParameter("query");
		
		$transporte =  utf8_decode($this->getRequestParameter("transporte"));
		$impoexpo =  utf8_decode($this->getRequestParameter("impoexpo"));
		
		$c = new Criteria();
			
		if( $transporte ){			
			$c->add( ReportePeer::CA_TRANSPORTE, $transporte );
		}
		
		if( $impoexpo ){
			$c->add( ReportePeer::CA_IMPOEXPO, $impoexpo );
		}
		
		$c->add( ReportePeer::CA_CONSECUTIVO, $criterio."%", Criteria::LIKE );
		$c->add( ReportePeer::CA_USUANULADO, null, Criteria::ISNULL );
		$c->addDescendingOrderByColumn( ReportePeer::CA_FCHCREADO );
		$c->setLimit(40);
		$reportes = ReportePeer::doSelect( $c );
		
		$this->reportes = array();
 
   		foreach ( $reportes as $reporte ) {
			if( $reporte->esUltimaVersion() ){
      			$this->reportes[] = array('ca_consecutivo'=>$reporte->getCaConsecutivo(),
										  'ca_idreporte'=>$reporte->getCaIdreporte()
										 
									 );
			}
		}					
		$this->setLayout("none");
	}

}
?>