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
		
				
		
				
		$this->usuarios = Doctrine::getTable("Usuario")                                    
                                    ->createQuery("u")
                                    ->select("u.*")
                                    ->innerJoin("u.Cotizacion")
                                    ->distinct()
                                    ->orderBy("u.ca_nombre")
                                    ->execute();
				
		$this->sucursales = Doctrine::getTable("Sucursal")
                                    ->createQuery("s")
                                    ->orderBy("s.ca_nombre")
                                    ->execute();
		
		$this->estados = ParametroTable::retrieveByCaso( "CU074" );
		
	}
	
	
	
	/**
	* Muestra las estadisticas por sucurrsal o por usuario
	*
	* @param sfRequest $request A request object
	*/
	public function executeEstadisticas($request){
		$fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
		$fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));


        $checkboxVendedor = $request->getParameter( "checkboxVendedor" );
		$checkboxSucursal = $request->getParameter( "checkboxSucursal" );
		$this->login = $request->getParameter( "login" );


		$this->usuario = Doctrine::getTable("Usuario")->find( $this->login );
		
		$q = Doctrine_Query::create()                             
                             ->from("CotProducto p")                             
                             ->innerJoin("p.Cotizacion c")
                             ->innerJoin("c.Usuario u")
                             ->leftJoin("p.CotSeguimiento s" )                             
                             ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND p.ca_etapa IS NOT NULL", array($fechaInicial, $fechaFinal));
		
		if( $checkboxVendedor ){			
            $q->addWhere("c.ca_usuario = ?", $this->login );
		}
		
		if( $checkboxSucursal ){
			$this->sucursal = $request->getParameter( "sucursal_est" );
            $q->addWhere("u.ca_idsucursal = ?", $this->sucursal );
		}else{
			$this->sucursal = "";
		}


        $cotizaciones = $q->select("p.ca_idcotizacion")
                        ->distinct()
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();
        $this->numcotizaciones = count($cotizaciones);



        $this->rows = $q->select("COUNT(p.ca_idproducto) as count, count(s.ca_idproducto) as conseg, p.ca_etapa")
                        ->addGroupBy("p.ca_etapa")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        



        $q = Doctrine_Query::create()
                             ->select("COUNT(c.ca_idcotizacion) as count, count(s.ca_idcotizacion) as conseg, c.ca_etapa")
                             ->from("Cotizacion c")
                             ->innerJoin("c.Usuario u")
                             ->leftJoin("c.CotProducto p")                             
                             ->leftJoin("c.CotSeguimiento s" )
                             ->addGroupBy("c.ca_etapa")
                             ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND c.ca_etapa IS NOT NULL", array($fechaInicial, $fechaFinal))
                             ->addWhere("p.ca_idproducto IS NULL");
                             //->orderBy("c.ca_etapa");


		if( $checkboxVendedor ){
            $q->addWhere("c.ca_usuario = ?", $this->login );
		}

		if( $checkboxSucursal ){
			$this->sucursal = $request->getParameter( "sucursal_est" );
            $q->addWhere("u.ca_idsucursal = ?", $this->sucursal );
		}else{
			$this->sucursal = "";
		}

        $this->rows2 = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();



		$this->fechaInicial = $fechaInicial;
		$this->fechaFinal = $fechaFinal;

        $estados = ParametroTable::retrieveByCaso( "CU074" );
        $this->estados = array();

        foreach( $estados as $estado ){
            $this->estados[$estado->getCaValor()]=$estado->getCaValor2();
        }
		
	}
	
	
	
	public function executeVerSeguimiento( $request ){
		$this->cotizacion = Doctrine::gettable("Cotizacion")->find( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $this->cotizacion );
		
		
		$this->productos = $this->cotizacion->getCotProductos();
			
		/*
		*/
	}
	
	
	public function executeFormSeguimiento( $request ){
		$this->cotizacion = Doctrine::gettable("Cotizacion")->find( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $this->cotizacion );

        if( $request->getParameter("idproducto") ){
            $this->producto = Doctrine::gettable("CotProducto")->find( $request->getParameter("idproducto") );
            $this->forward404Unless( $this->producto );
            //$this->ultSeguimiento = $this->producto->getUltSeguimiento();
            $this->seguimientos = $this->producto->getSeguimientos();
        }else{
            //$this->ultSeguimiento = $this->cotizacion->getUltSeguimiento();

            $this->seguimientos = $this->cotizacion->getSeguimientos();
        }
		
		
		$this->form = new SeguimientoForm();				
		
		
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

        $cotizacion = Doctrine::gettable("Cotizacion")->find( $request->getParameter("idcotizacion") );
		$this->forward404Unless( $cotizacion );

        if( $request->getParameter("idproducto") ){
            $producto = Doctrine::gettable("CotProducto")->find( $request->getParameter("idproducto") );
            $this->forward404Unless( $producto );

            if( $producto->getCaIdtarea() ){
                $tarea  =  Doctrine::gettable("NotTarea")->find( $producto->getCaIdtarea() );
                $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
                $tarea->save();
            }
        }else{
             if( $cotizacion->getCaIdtarea() ){
                $tarea  =  Doctrine::gettable("NotTarea")->find( $cotizacion->getCaIdtarea() );
                $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
                $tarea->save();
            }

        }

		
		
		$seguimiento = new CotSeguimiento();
        if( $request->getParameter("idproducto") ){
            $seguimiento->setCaIdproducto( $request->getParameter("idproducto") );
            $producto->setCaEtapa( $request->getParameter("etapa") );
            $producto->save();
        }else{
            $seguimiento->setCaIdcotizacion( $request->getParameter("idcotizacion") );
            $cotizacion->setCaEtapa( $request->getParameter("etapa") );
            $cotizacion->save();
        }
		$seguimiento->setCaLogin( $this->getUser()->getUserId() );
		$seguimiento->setCaFchseguimiento( date("Y-m-d H:i:s") );
		$seguimiento->setCaSeguimiento( $request->getParameter("seguimiento") );
		$seguimiento->setCaEtapa( $request->getParameter("etapa") );
		$seguimiento->save();
		
		
		
		if( $request->getParameter("prog_seguimiento") ){
			
			$titulo = "Seguimiento Cotización ".$cotizacion->getCaConsecutivo()." ".$cotizacion->getCliente()->getCaCompania()."";
			$texto = "Ha programado un seguimiento para una cotización, por favor haga click en el link para realizar esta tarea";			
			$tarea = new NotTarea(); 
			$tarea->setCaUrl( "/cotseguimientos/verSeguimiento/idcotizacion/".$cotizacion->getCaIdcotizacion() );
			$tarea->setCaIdlistatarea( 7 );
											
			$tarea->setCaFchvencimiento( $request->getParameter("fchseguimiento")." 23:59:59" );
			$tarea->setCaFchvisible( $request->getParameter("fchseguimiento")." 00:00:00" );
			$tarea->setCaUsucreado( $this->getUser()->getUserId() );
			$tarea->setCaTitulo( $titulo );		
			$tarea->setCaTexto( $texto );
			$tarea->save();
			$loginsAsignaciones = array( $this->getUser()->getUserId(), $cotizacion->getCaUsuario() );
			$loginsAsignaciones = array_unique( $loginsAsignaciones );
            $tarea->setAsignaciones( $loginsAsignaciones );
			
			if( $request->getParameter("idproducto") ){
                $producto->setCaIdtarea( $tarea->getCaIdtarea() );
                $producto->save();
            }else{
                $cotizacion->setCaIdtarea( $tarea->getCaIdtarea() );
                $cotizacion->save();
            }
				
		}	
		
		$this->redirect( "cotseguimientos/verSeguimiento?idcotizacion=".$cotizacion->getCaIdcotizacion() );
	}
	

}
?>