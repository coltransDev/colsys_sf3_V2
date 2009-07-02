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
		
		$this->estados = ParametroPeer::retrieveByCaso( "CU074" );		
		
	}
	
	/*
	* Muestra un listado de las cotizaciones 
	*
	* @param sfRequest $request A request object
	*/
	public function executeListadoCotizaciones($request)
	{		
		$this->nivel = $this->getUser()->getNivelAcceso( cotseguimientosActions::RUTINA );
		
		if( $request->getParameter("fechaInicialCons") ){
			$fechaInicialCons = Utils::parseDate($request->getParameter("fechaInicialCons"));
		}else{
			$fechaInicialCons = null;
		}
		if( $request->getParameter("fechaFinalCons") ){
			$fechaFinalCons = Utils::parseDate($request->getParameter("fechaFinalCons"));
		}else{
			$fechaFinalCons = "";
		}
		$estadoCons = $request->getParameter("estadoCons");
		
		$checkboxConsecutivo = $request->getParameter("checkboxConsecutivo");
		$checkboxSucursal = $request->getParameter("checkboxSucursal");
		$checkboxVendedor = $request->getParameter("checkboxVendedor");

		if( $this->nivel>=1 || ($checkboxConsecutivo || $checkboxSucursal || $checkboxVendedor) ){			
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
		
		$c->add( CotizacionPeer::CA_CONSECUTIVO, null, Criteria::ISNOTNULL );
		
				
		if( $estadoCons ){
			$c->add( CotProductoPeer::CA_ETAPA , $estadoCons  );	
		}else{
			$c->add( CotProductoPeer::CA_ETAPA , Cotizacion::EN_SEGUIMIENTO  );
		}
		
		if( $fechaInicialCons ){
			$c->add( CotizacionPeer::CA_FCHCREADO,$fechaInicialCons , Criteria::GREATER_EQUAL );
		}
		
		if( $fechaFinalCons ){
			$c->addAnd( CotizacionPeer::CA_FCHCREADO,$fechaFinalCons , Criteria::LESS_EQUAL );
		}
		
		$c->add(CotizacionPeer::CA_USUANULADO, null, Criteria::ISNULL);
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
				
				$estado = $producto->getEtapa();
				$ultSeguimiento = $producto->getUltSeguimiento();
				if( $ultSeguimiento ){
					
					$etapa = $ultSeguimiento->getCaEtapa();
					$seguimiento = $ultSeguimiento->getCaSeguimiento();
				}else{
					
					$etapa = "";
					$seguimiento = "";
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
									"etapa"=>utf8_encode($etapa),
									"estado"=>utf8_encode($estado),
									"seguimiento"=>utf8_encode($seguimiento)
							);
			}
		} 
				
		$this->estados = ParametroPeer::retrieveByCaso( "CU074" );						
	}
	/**
	* guarda los cambios realizados en la grilla
	*
	* @param sfRequest $request A request object
	*/
	public function executeObserveListadocotizaciones($request){
		$cotproducto = CotProductoPeer::retrieveByPk( $request->getParameter("idproducto"),$request->getParameter("idcotizacion") );
		$this->forward404Unless( $cotproducto );
		
		$etapa = $request->getparameter( "etapa" );
		$estado = $request->getparameter( "estado" );
		$seguimientoTxt = $request->getparameter( "seguimiento" );
		if( $etapa ){
			
			$seguimiento = new CotSeguimiento();
			$seguimiento->setCaIdcotizacion( $cotproducto->getCaIdcotizacion() );
			$seguimiento->setCaIdproducto( $cotproducto->getCaIdProducto()  );		
			$seguimiento->setCaLogin( $this->getUser()->getUserId() );
			$seguimiento->setCaFchseguimiento( time() );
			if( $seguimiento!==null ){		
				$seguimiento->setCaSeguimiento( utf8_decode($seguimientoTxt) );
			}
			$seguimiento->setCaEtapa( $etapa );
			$seguimiento->save();	
			$cotproducto->setCaEtapa( $etapa );	
			$cotproducto->save();			
		}
		
		
		
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
	
		$sql="SELECT count(*) as count, ca_etapa FROM (".CotizacionPeer::TABLE_NAME." INNER JOIN ".CotProductoPeer::TABLE_NAME." ON ".CotizacionPeer::CA_IDCOTIZACION."=".CotProductoPeer::CA_IDCOTIZACION." ) INNER JOIN ".UsuarioPeer::TABLE_NAME." ON ".CotizacionPeer::CA_USUARIO."=".UsuarioPeer::CA_LOGIN." ";
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
		
		$sql.=" GROUP BY ca_etapa";		
		//print_r( $_POST );
		
		$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
	
		$this->stmt = $con->prepare($sql);
		$this->stmt->execute();	 
		$this->fechaInicial = $fechaInicial;
		$this->fechaFinal = $fechaFinal;
		
	}
	
	
	
	public function executeVerSeguimiento( $request ){
		$this->cotizacion = CotizacionPeer::retrieveByPk( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $this->cotizacion );
		
		
		$this->productos = $this->cotizacion->getCotProductos();
			
		/*
		*/
	}
	
	
	public function executeFormSeguimiento( $request ){
		$this->cotizacion = CotizacionPeer::retrieveByPk( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $this->cotizacion );
		
		$this->producto = CotProductoPeer::retrieveByPk( $request->getParameter("idproducto"), $request->getParameter("idcotizacion") );
		$this->forward404Unless( $this->producto );
		
		$this->ultSeguimiento = $this->producto->getUltSeguimiento();
		$this->form = new SeguimientoForm();				
		$this->form->setCriteriaEtapas( ParametroPeer::getCriteriaByCu( "CU074" ) );	
		$this->form->configure();
		
		if ($request->isMethod('post')){	
		
			$bindValues = array();
			$bindValues["seguimiento"] = $request->getParameter("seguimiento"); 
			$bindValues["etapa"] = $request->getParameter("etapa"); 			
			$bindValues["prog_seguimiento"] = $request->getParameter("prog_seguimiento");
			if( $request->getParameter("prog_seguimiento") ){
				$bindValues["fchseguimiento"] = $request->getParameter("fchseguimiento");				
			}
			
			$this->form->bind( $bindValues );
			
			if( $this->form->isValid() ){					
				$this->executeGuardarSeguimiento( $request );				
				return sfView::SUCCESS;
			}				
		}
	}
	
	public function executeGuardarSeguimiento( $request ){
		$cotizacion = CotizacionPeer::retrieveByPk( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $cotizacion );
		
		$producto = CotProductoPeer::retrieveByPk( $request->getParameter("idproducto"), $request->getParameter("idcotizacion") );
		$this->forward404Unless( $producto );
		
		if( $producto->getCaIdtarea() ){
			$tarea  = NotTareaPeer::retrieveByPk( $producto->getCaIdtarea() );
			$tarea->setCaFchterminada( time() );
			$tarea->save();
		}
		
		
		$seguimiento = new CotSeguimiento();
		$seguimiento->setCaIdcotizacion( $cotizacion->getCaIdcotizacion() );
		$seguimiento->setCaIdproducto( $request->getParameter("idproducto") );		
		$seguimiento->setCaLogin( $this->getUser()->getUserId() );
		$seguimiento->setCaFchseguimiento( time() );
		$seguimiento->setCaSeguimiento( $request->getParameter("seguimiento") );
		$seguimiento->setCaEtapa( $request->getParameter("etapa") );
		$seguimiento->save();
		
		$producto->setCaEtapa( $request->getParameter("etapa") );
		$producto->save();
		
		if( $request->getParameter("prog_seguimiento") ){
			
			$titulo = "Seguimiento Cotización ".$cotizacion->getCaConsecutivo()." ".$cotizacion->getCliente()->getCaCompania()."";
			$texto = "Ha programado un seguimiento para una cotización, por favor haga click en el link para realizar esta tarea";			
			$tarea = new NotTarea(); 
			$tarea->setCaUrl( "/cotseguimientos/verSeguimiento/idcotizacion/".$cotizacion->getCaIdcotizacion() );
			$tarea->setCaIdlistatarea( 7 );
			$tarea->setCaFchcreado( time() );								
			$tarea->setCaFchvencimiento( $request->getParameter("fchseguimiento")." 23:59:59" );
			$tarea->setCaFchvisible( $request->getParameter("fchseguimiento")." 00:00:00" );
			$tarea->setCaUsucreado( $this->getUser()->getUserId() );
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->save();
			$loginsAsignaciones = array( $this->getUser()->getUserId() );
			$tarea->setAsignaciones( $loginsAsignaciones );	
			
			
			$producto->setCaIdtarea( $tarea->getCaIdtarea() );
			$producto->save();
				
		}	
		
		$this->redirect( "cotseguimientos/verSeguimiento?idcotizacion=".$this->cotizacion->getCaIdcotizacion() );
	}
	

}
?>