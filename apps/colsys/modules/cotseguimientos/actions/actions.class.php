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

        public function executeAprobarSeguimiento( $param ){
            $idproducto=$param["idproducto"];
            $etapa=$param["etapa"];
            $seguimientos=(isset($param["seguimiento"])?$param["seguimiento"]:"");
            //$prog_seguimiento=(isset($param["prog_seguimiento"])?$param["prog_seguimiento"]:"");
            $fchseguimiento=(isset($param["fchseguimiento"])?$param["fchseguimiento"]:"");

            if( $idproducto ){
                $producto = Doctrine::gettable("CotProducto")->find( $idproducto );
                $this->forward404Unless( $producto );

                if( $producto->getCaIdtarea() ){
                    $tarea  =  Doctrine::gettable("NotTarea")->find( $producto->getCaIdtarea() );
                    $tarea->setCaFchterminada( date("Y-m-d H:i:s") );
                    $tarea->save();
                }
            }

            $cotizacion = Doctrine::gettable("Cotizacion")->find( $producto->getCaIdcotizacion() );
            $this->forward404Unless( $cotizacion );

            $seguimiento = new CotSeguimiento();
            if( $idproducto ){
                $seguimiento->setCaIdproducto( $idproducto );
                $producto->setCaEtapa( $etapa );
                $producto->save();
            }

            $seguimiento->setCaLogin( $this->getUser()->getUserId() );
            $seguimiento->setCaFchseguimiento( date("Y-m-d H:i:s") );
            $seguimiento->setCaSeguimiento( $seguimientos );
            $seguimiento->setCaEtapa( $etapa );
            $seguimiento->save();

            if( $fchseguimiento )
            {
                $titulo = "Seguimiento Cotización ".$cotizacion->getCaConsecutivo()." ".$cotizacion->getCliente()->getCaCompania()."";
                $texto = "Ha programado un seguimiento para una cotización, por favor haga click en el link para realizar esta tarea";
                $tarea = new NotTarea();
                $tarea->setCaUrl( "/cotseguimientos/verSeguimiento/idcotizacion/".$cotizacion->getCaIdcotizacion() );
                $tarea->setCaIdlistatarea( 7 );

                $tarea->setCaFchvencimiento( $fchseguimiento." 23:59:59" );
                $tarea->setCaFchvisible( $fchseguimiento." 00:00:00" );
                $tarea->setCaUsucreado( $this->getUser()->getUserId() );
                $tarea->setCaTitulo( $titulo );
                $tarea->setCaTexto( $texto );
                $tarea->save();
                $loginsAsignaciones = array( $this->getUser()->getUserId(), $cotizacion->getCaUsuario() );
                $loginsAsignaciones = array_unique( $loginsAsignaciones );
                $tarea->setAsignaciones( $loginsAsignaciones );

                if( $idproducto ){
                    $producto->setCaIdtarea( $tarea->getCaIdtarea() );
                    $producto->save();
                }
            }
	}

        public function executeAprobarSeguimientos( $request){
            $idproductos=$request->getParameter("idproducto");
            $etapa=$request->getParameter("etapa");
            $seguimientos=$request->getParameter("seguimiento");
            //$prog_seguimientos=$request->getParameter("prog_seguimiento");
            $fchseguimientos=$request->getParameter("fchseguimiento");
            for($i=0;$i<count($idproductos);$i++)
            {
                $param["idproducto"]=$idproductos[$i];
                $param["etapa"]=$etapa[$i];
                if($seguimientos[$i]!="")
                    $param["seguimiento"]=$seguimientos[$i];
                else
                    $param["seguimiento"]="";
                //if($prog_seguimientos[$i]!="")
                    //$param["prog_seguimiento"]=$prog_seguimientos[$i];
                if($fchseguimientos[$i]!="")
                    $param["fchseguimiento"]=$fchseguimientos[$i];
                else
                    $param["fchseguimiento"]="";
                //echo "<pre>";print_r($param);echo "</pre>";
                $this->executeAprobarSeguimiento( $param );
            }
            $this->responseArray = array("success"=>true);
            $this->setTemplate("responseTemplate");
        }

        public function executeReporteSeguimientosEmail( $request)
        {

            $ultimo_dia = mktime(0, 0, 0, date("m"), 0, 2010);
            $last_day=date("Y-m-d",$ultimo_dia);
            $first_day=date("Y-m-01",$ultimo_dia);
            //echo $first_day."-".$last_day;


            $seguimientos = Doctrine_Query::create()
                ->select("cli.ca_compania,p.ca_idproducto,c.ca_consecutivo,p.ca_transporte,o.ca_ciudad,d.ca_ciudad,c.ca_usuario,u.ca_email")
                ->from("CotProducto p")
                ->innerJoin("p.Origen o")
                ->innerJoin("p.Destino d")
                ->innerJoin("p.Cotizacion c")
                ->innerJoin("c.Contacto con")
                ->innerJoin("con.Cliente cli ON cli.ca_idcliente=con.ca_idcliente")
                ->innerJoin("c.Usuario u")
                ->leftJoin("p.CotSeguimiento s" )
                ->addWhere("c.ca_fchcreado BETWEEN ? AND ? AND p.ca_etapa IS NOT NULL", array($first_day, $last_day))
                ->addWhere("(s.ca_etapa<>'NAP' and s.ca_etapa<>'APR' or s.ca_etapa is null)" )
                ->orderBy("c.ca_usuario")
                ->addOrderBy("c.ca_consecutivo DESC")
                ->addOrderBy("p.ca_idproducto ")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->execute();
            $this->emails=array();
            foreach($seguimientos as $seguimiento)
            {
                if(!isset($this->emails[$seguimiento["c_ca_usuario"]]))
                {
                        $this->emails[$seguimiento["c_ca_usuario"]]["html"]="<tr bgcolor='#EAEAEA'><td colspan='4'>Usuario : ".$seguimiento["c_ca_usuario"]."</td></tr><tr bgcolor='#EAEAEA' ><td>Cotizaci&oacute;n</td><td>Cliente</td><td>Transporte</td><td>Trayecto</td></tr>";
                        $this->emails[$seguimiento["c_ca_usuario"]]["email"]=$seguimiento["u_ca_email"];
                }
                $this->emails[$seguimiento["c_ca_usuario"]]["html"].="<tr><td>".$seguimiento["c_ca_consecutivo"]."</td><td>".$seguimiento["cli_ca_compania"]."</td><td>".$seguimiento["p_ca_transporte"]."</td><td>".$seguimiento["o_ca_ciudad"]."-".$seguimiento["d_ca_ciudad"]."::".$seguimiento["p_ca_idproducto"]."</td></tr>";
            }
            $keys= array_keys($this->emails);

            foreach($keys as $key)
            {
                $this->emails[$key]["html"]="<table width='90%' cellspacing='1' border='1'>".$this->emails[$key]["html"]."</table>";
                $email = new Email();
                $email->setCaUsuenvio( "Administrador" );
                $email->setCaTipo( "SDNList Compair" );
                $email->setCaIdcaso( "1" );
                $email->setCaFrom( "admin@coltrans.com.co" );
                $email->setCaFromname( "Administrador Sistema Colsys" );
                $email->setCaReplyto( "admin@coltrans.com.co" );
                $email->setCaCc( "maquinche@coltrans.com.co" );
                $email->setCaSubject( "Seguimientos de Cotizaciones de $first_day a $last_day" );
                $email->setCaBodyhtml( $this->emails[$key]["html"] );
                $email->addTo( $this->emails[$key]["email"] );
                //$email->addTo( "maquinche@coltrans.com.co" );
                $email->save(); //guarda el cuerpo del mensaje
                $email->send(); //envia el mensaje de correo
                //break;
            }
//            print_r($this->emails);
    //$email->save();  
        }
}
?>
