<?php

/**
 * cotseguimientos actions.
 *
 * @package    colsys
 * @subpackage cotseguimientos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class cotseguimientosActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex($request)
	{		
		$c = new Criteria();
		$c->addJoin( UsuarioPeer::CA_LOGIN, CotizacionPeer::CA_USUARIO );
		$c->addAscendingOrderByColumn( UsuarioPeer::CA_NOMBRE );
		$c->setDistinct();
		$this->usuarios = UsuarioPeer::doSelect( $c );
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( SucursalPeer::CA_NOMBRE );
		$this->sucursales = SucursalPeer::doSelect( $c );		
	}
	
	/*
	* Muestra un listado de las cotizaciones 
	*
	* @param sfRequest $request A request object
	*/
	public function executeListadoCotizaciones($request)
	{		
		$checkboxConsecutivo = $request->getParameter("checkboxConsecutivo");
		$checkboxSucursal = $request->getParameter("checkboxSucursal");
		$checkboxVendedor = $request->getParameter("checkboxVendedor");
		if( $checkboxConsecutivo || $checkboxSucursal || $checkboxVendedor ){			
			$login = $this->getRequestParameter("login");
			$sucursal = $this->getRequestParameter("sucursal");
			$consecutivo = $this->getRequestParameter("consecutivo");
		}else{
			//En este caso saca el listado del usuario actual
			$user = $this->getUser();
			$checkboxVendedor = "on";
			$login = $user->getUserId();
		}
		$c = new Criteria();		
		if( $checkboxConsecutivo ){
			$c->add( CotizacionPeer::CA_CONSECUTIVO, $consecutivo.'%', Criteria::LIKE );			
		}
		
		if( $checkboxVendedor ){
			$c->add( CotizacionPeer::CA_USUARIO, $login );	
		}
		
		if( $checkboxSucursal ){
			$c->addJoin( CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN );	
			$c->add(  UsuarioPeer::CA_SUCURSAL, $sucursal );	
		}		
		$c->addAscendingOrderByColumn( CotizacionPeer::CA_CONSECUTIVO );
		$c->add( CotizacionPeer::CA_ESTADO , Cotizacion::EN_SEGUIMIENTO  );
				
		$cotizaciones = CotizacionPeer::doSelect( $c );
		
		$this->data = array();
		
		foreach( $cotizaciones as $cotizacion ){
			$cliente = $cotizacion->getCliente();
			$this->data[] = array( "idcotizacion"=>$cotizacion->getCaIdCotizacion(),
									"consecutivo"=>$cotizacion->getCaConsecutivo(),
									"cliente"=>$cliente->getCaCompania(),
									"usuario"=>$cotizacion->getCaUsuario(),
									"estado"=>$cotizacion->getCaEstado(),
									"motivonoaprobado"=>$cotizacion->getCaMotivonoaprobado()
				
							);
		} 
				
		$this->estados = ParametroPeer::retrieveByCaso( "CU065" );
		$this->motivos = ParametroPeer::retrieveByCaso( "CU066" );					
	}
	/**
	* guarda los cambios realizados en la grilla
	*
	* @param sfRequest $request A request object
	*/
	public function executeObserveListadocotizaciones($request){
		$cotizacion = CotizacionPeer::retrieveByPk( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $cotizacion );
		
		$estado = $request->getparameter( "estado" );
		$motivonoaprobado = $request->getparameter( "motivonoaprobado" );
		if( $estado ){
			$cotizacion->setCaEstado( $estado );			
		}
		
		if( $motivonoaprobado!==null ){
			$cotizacion->setCaMotivonoaprobado( utf8_decode($motivonoaprobado) );			
		}
		$cotizacion->save();
		$this->responseArray = array( "success"=>true, "idcotizacion"=>$cotizacion->getCaIdcotizacion() );
		$this->setTemplate( "responseTemplate" );		
	}
	
	/**
	* Muestra las estadisticas por sucurrsal o por usuario
	*
	* @param sfRequest $request A request object
	*/
	public function executeEstadisticas($request){
		$fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
		$fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));
	
		$sql="SELECT count(*) as count, ca_estado, ca_motivonoaprobado FROM ".CotizacionPeer::TABLE_NAME." INNER JOIN ".UsuarioPeer::TABLE_NAME." ON ".CotizacionPeer::CA_USUARIO."=".UsuarioPeer::CA_LOGIN." ";
		$sql.=" WHERE ".CotizacionPeer::CA_FCHCREADO." BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' AND ca_estado IS NOT NULL ";
		
		
		
		$checkboxVendedor = $request->getParameter( "checkboxVendedor" );
		$checkboxSucursal = $request->getParameter( "checkboxSucursal" );
		$this->login = $request->getParameter( "login" );
		
		
		$this->usuario = UsuarioPeer::retrieveByPk( $this->login );
		
		if( $checkboxVendedor ){
			$sql.=" AND ".CotizacionPeer::CA_USUARIO."='".$this->login."'";
		}
		
		if( $checkboxSucursal ){
			$this->sucursal = $request->getParameter( "sucursal" );
			$sql.=" AND ".UsuarioPeer::CA_SUCURSAL."='".$this->sucursal."'";
		}else{
			$this->sucursal = "";
		}
		
		$sql.=" GROUP BY ca_estado, ca_motivonoaprobado";		
		//print_r( $_POST );
		
		$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
	
		$stmt = $con->prepareStatement($sql);
		$this->rs = $stmt->executeQuery();	 
		$this->fechaInicial = $fechaInicial;
		$this->fechaFinal = $fechaFinal;
		
	}
	
	
}
?>