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

	const RUTINA = 19;
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex($request)
	{		
		$this->nivel = $this->getUser()->getNivelAcceso( cotseguimientosActions::RUTINA );
		
		if( $this->nivel==-1 ){
		//	$this->forward404();
		}	
		
		
		if( $this->nivel<1 ){
			$this->redirect("cotseguimientos/listadoCotizaciones");
		}	
		
		
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
			$c->add(  UsuarioPeer::CA_IDSUCURSAL, $sucursal );	
		}		
		$c->addAscendingOrderByColumn( CotizacionPeer::CA_CONSECUTIVO );
		$c->addJoin( CotizacionPeer::CA_IDCOTIZACION , CotProductoPeer::CA_IDCOTIZACION );
		$c->add( CotProductoPeer::CA_ESTADO , Cotizacion::EN_SEGUIMIENTO  );
		$c->add( CotizacionPeer::CA_CONSECUTIVO, null, Criteria::ISNOTNULL );
		$c->setDistinct();
				
		$cotizaciones = CotizacionPeer::doSelect( $c );
		
		$this->data = array();
		
		foreach( $cotizaciones as $cotizacion ){
				
			$cliente = $cotizacion->getCliente();
			$productos = $cotizacion->getCotProductos();
			foreach( $productos as $producto ){
				$origen = $producto->getOrigen();
				$destino = $producto->getDestino();
				$escala = $producto->getEscala();	
				$linea = $producto->getTransportador();
					
				
				$trayecto =  $origen->getCaCiudad() ." - ".$origen->getTrafico()->getCaNombre()." » ";
				
				if( $escala ){
					$trayecto .= $escala->getCaCiudad()." - ".$escala->getTrafico()->getCaNombre()." » ";
				}
				
				$trayecto .= $destino->getCaCiudad()." - ".$destino->getTrafico()->getCaNombre();
				if( $linea ){
					$trayecto .= " » ".$linea->getCaNombre();
				}
				
				
				
				$this->data[] = array("id"=>$cotizacion->getCaIdCotizacion()."-".$producto->getCaIdProducto(),				
									"idcotizacion"=>$cotizacion->getCaIdCotizacion(),
									"idproducto"=>$producto->getCaIdProducto(),
									"impoexpo"=>utf8_encode($producto->getCaImpoExpo()),
									"transporte"=>utf8_encode($producto->getCaTransporte()),
									"modalidad"=>utf8_encode($producto->getCaModalidad()),
									"trayecto"=>utf8_encode($trayecto),
									"consecutivo"=>str_pad($cotizacion->getCaConsecutivo(),5,"0",STR_PAD_LEFT),
									"cliente"=>utf8_encode($cliente->getCaCompania()),									
									"usuario"=>$cotizacion->getCaUsuario(),
									"estado"=>$producto->getCaEstado(),
									"motivonoaprobado"=>$producto->getCaMotivonoaprobado()				
							);
			}
		} 
				
		$this->estados = ParametroPeer::retrieveByCaso( "CU068" );
		$this->motivos = ParametroPeer::retrieveByCaso( "CU069" );					
	}
	/**
	* guarda los cambios realizados en la grilla
	*
	* @param sfRequest $request A request object
	*/
	public function executeObserveListadocotizaciones($request){
		$cotproducto = CotProductoPeer::retrieveByPk( $request->getParameter("idproducto"),$request->getParameter("idcotizacion") );
		$this->forward404Unless( $cotproducto );
		
		$estado = $request->getparameter( "estado" );
		$motivonoaprobado = $request->getparameter( "motivonoaprobado" );
		if( $estado ){
			$cotproducto->setCaEstado( $estado );			
		}
		
		if( $motivonoaprobado!==null ){
			$cotproducto->setCaMotivonoaprobado( utf8_decode($motivonoaprobado) );			
		}
		$cotproducto->save();
		$this->responseArray = array( "success"=>true,"idcotizacion"=>$cotproducto->getCaIdcotizacion(), "idproducto"=>$cotproducto->getCaIdproducto() );
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
	
		$sql="SELECT count(*) as count, ca_estado, ca_motivonoaprobado FROM (".CotizacionPeer::TABLE_NAME." INNER JOIN ".CotProductoPeer::TABLE_NAME." ON ".CotizacionPeer::CA_IDCOTIZACION."=".CotProductoPeer::CA_IDCOTIZACION." ) INNER JOIN ".UsuarioPeer::TABLE_NAME." ON ".CotizacionPeer::CA_USUARIO."=".UsuarioPeer::CA_LOGIN." ";
		$sql.=" WHERE ".CotizacionPeer::CA_FCHCREADO." BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' AND ca_estado IS NOT NULL ";
		
		
		
		$checkboxVendedor = $request->getParameter( "checkboxVendedor" );
		$checkboxSucursal = $request->getParameter( "checkboxSucursal" );
		$this->login = $request->getParameter( "login" );
		
		
		$this->usuario = UsuarioPeer::retrieveByPk( $this->login );
		
		if( $checkboxVendedor ){
			$sql.=" AND ".CotizacionPeer::CA_USUARIO."='".$this->login."'";
		}
		
		if( $checkboxSucursal ){
			$this->sucursal = $request->getParameter( "sucursal_est" );
			$sql.=" AND ".UsuarioPeer::CA_IDSUCURSAL."='".$this->sucursal."'";
		}else{
			$this->sucursal = "";
		}
		
		$sql.=" GROUP BY ca_estado, ca_motivonoaprobado";		
		//print_r( $_POST );
		
		$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
	
		$this->stmt = $con->prepare($sql);
		$this->stmt->execute();	 
		$this->fechaInicial = $fechaInicial;
		$this->fechaFinal = $fechaFinal;
		
	}
	


}
?>