<?php

/**
* Modulo de creacion de reportes Basado en el modulo de reportes de Carlos Lopez y
* solo que ademas permite crear reportes de exportaciones, adicionalmente entra el
* concepto de embarque.
*
* @package    colsys
* @subpackage reportes
* @author     Your name here
* @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
*/
class reportesNegActions extends sfActions
{
    const RUTINA = 87;
    const RUTINA_AEREO = 15;
    const RUTINA_MARITIMO = 15;
    const RUTINA_ADUANA = 15;
    const RUTINA_EXPO = 15;

/*    public function getNivel( ){

		$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );

		if( $this->nivel==-1 ){
			$this->forward404();
		}
        return $this->nivel;

    }
*/
    public function getNivel( ){
        $this->modo = $this->getRequestParameter("modo");

        $this->nivel = -1;
		if( !$this->modo){
			$this->forward( "reportesNeg", "seleccionModo" );
		}

		if( $this->modo=="A�reo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_AEREO );
		}

		if( $this->modo=="Mar�timo" ){
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_MARITIMO );
		}
		
        if( $this->modo=="Exportaci�n" ){
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_EXPO );
		}

        if( $this->modo=="Triangulaci�n" ){
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_AEREO );
		}

        $this->permiso = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );



		if( $this->nivel==-1 ){
			$this->forward404();
		}
 
        return $this->nivel;
    }

    public function load_category()
    {
        $this->impoexpo=$this->getRequestParameter("impoexpo");
        if($this->impoexpo==Constantes::IMPO)
        {
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO)
                $this->idcategory="31";
            else if($this->modo==Constantes::MARITIMO)
                $this->idcategory="32";
        }
        else if($this->impoexpo==Constantes::EXPO)
        {
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO)
                $this->idcategory="34";
            else if($this->modo==Constantes::MARITIMO)
                $this->idcategory="35";
        }
        else
        {
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO)
                $this->idcategory="37";
            else if($this->modo==Constantes::MARITIMO)
                $this->idcategory="38";
        }
    }
	/**
	* Pantalla de bienvenida para el modulo de reportes
	* @author Mauricio Quinche
	*/
	public function executeIndex()
	{
        $this->nivel = $this->getNivel();
        $this->opcion = $this->getRequestParameter("opcion");
        $this->modo = $this->getRequestParameter("modo");
        $this->impoexpo = $this->getRequestParameter("impoexpo");
        $this->load_category();

//        $this->setRequestParameter("idcategory",$this->idcategory);
        //echo ":".$this->modo.":";
		/*$this->modo = $this->getRequestParameter("modo");
		$this->forward404Unless( $this->modo );*/
	}



	/*
	* Muestra los resultados de la busqueda del reporte de negocios
	* @author Andres Botero
	*/
	public function executeBusquedaReporte()
	{
        $this->opcion = $this->getRequestParameter("opcion");
        $this->modo = $this->getRequestParameter("modo");
        $this->impoexpo = $this->getRequestParameter("impoexpo");


		$criterio = $this->getRequestParameter("criterio");
		$cadena = $this->getRequestParameter("cadena");


        $q = Doctrine::getTable("Reporte")
                       ->createQuery("r")
                       ->distinct()
                       ->limit(200)
                       ->addOrderBy("r.ca_consecutivo");
		switch( $criterio ){
			case "numero_de_reporte":
                $q->addWhere("r.ca_consecutivo like ?", $cadena."%");
				break;
			case "cliente":
                $q->innerJoin("r.Contacto con");
                $q->innerJoin("con.Cliente cl");
                $q->addWhere("UPPER(cl.ca_compania) LIKE ?",strtoupper( $cadena )."%");
				break;
            case "login":
                $q->innerJoin("r.Usuario usu");
                $q->addWhere("usu.ca_login = ?",$this->getUser()->getUserId());
  //              echo "usuario:<b>".$this->getUser()->getCaLogin()."</b><br>";
               break;
           case "proveedor":
                //$q->innerJoin("r.Proveedor prov");
                //$q->addWhere("UPPER(prov.ca_nombre) LIKE ? ",strtoupper( $cadena )."%");
               break;
           case "orden_proveedor":
               $q->addWhere("r.ca_orden_prov LIKE ?",( $cadena )."%");
               break;
           case "orden_cliente":
               $q->addWhere("r.ca_orden_clie LIKE ?",( $cadena )."%");
               break;
           case "cotizacion":
               $q->addWhere("r.ca_idcotizacion LIKE ?",( $cadena )."%");
               break;
           case "mercancia_desc":
               $q->addWhere("r.ca_mercancia_desc LIKE ?",( $cadena )."%");
               break;
           case "vendedor":
               case "login":
                $q->innerJoin("r.Usuario usu");
                $q->addWhere("usu.ca_nombre LIKE ?",( $cadena )."%");
               break;
           case "ciudadorigen":
                $q->innerJoin("r.Origen ori");
                $q->addWhere("UPPER(ori.ca_ciudad) LIKE ?",strtoupper( $cadena )."%");
                break;
		}



		$this->reportes = $q->execute();
	}

    /**
	* Permite consultar un reporte de negocio ya creado y permite
	* agregar nuevas
	* @author Andres Botero
	*/
	public function executeConsultaReporte(){
        $this->opcion = $this->getRequestParameter("opcion");
		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $reporte );

        if( $reporte->getCaUsuanulado() ){
            $this->redirect( "reportesNeg/verReporte?id=".$reporte->getCaIdreporte().($this->opcion?"&opcion=".$this->opcion:"") );
        }
		$this->reporte = $reporte;


        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');

        $this->grupoReportes = Doctrine::getTable("Reporte")
                      ->createQuery("r")
                      ->innerJoin("r.GrupoReporte g")
                      ->addWhere("g.ca_consecutivo = ?", $reporte->getCaConsecutivo())
                      ->distinct()
                      ->execute();


        //exit();

        if( ($reporte->isNew() || $reporte->getCaVersion() == $reporte->getUltVersion())
                &&!$reporte->existeReporteExteriorVersionActual() ){
            $this->editable = true;
        }else{
            $this->editable = false;
        }

        //No permite editar si el usuario no realizo el reporte
        $user = $this->getUser();
        if( !$reporte->isNew() && $user->getUserId()!=$reporte->getCaUsucreado() ){
            $this->editable = false;
        }

        //No permite editar reportes que se hayan agrupado
        if( $reporte->getCaIdgrupo()){
            $this->editable = false;
        }




	}


	/*
	* Permite ver una cotizaci�n en formato PDF
	*/
	public function executeVerReporte(){

        $this->opcion = $this->getRequestParameter("opcion");

		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $reporte );
        $this->user = $this->getUser();

        /* Marca como finalizada una tarea */

		$tareas = Doctrine::getTable("NotTarea")
                            ->createQuery("t")
                            ->innerJoin("t.NotTareaAsignacion a")
                            ->innerJoin("t.RepAsignacion r")
                            ->where("a.ca_login = ? ", $this->getUser()->getUserId())
                            ->addWhere("r.ca_idreporte = ? ", $reporte->getCaIdreporte() )
                            ->distinct()
                            ->execute();

		foreach( $tareas as $tarea ){
			if( $tarea && !$tarea->getCaFchterminada() ){
				$tarea->setCaFchterminada( date("Y-m-d H:i:s") );
				$tarea->setCaUsuterminada( $this->getUser()->getUserId() );
				$tarea->save();
			}
		}



		if( $reporte->getCaIdtareaRext() ){
			$this->tarea = Doctrine::getTable("NotTarea")->find( $reporte->getCaIdtareaRext() );
		}else{
			$this->tarea = null;
		}

		$this->asignaciones = $reporte->getRepAsignacion();
		$this->reporte = $reporte;

	}

	/*
	* Permite crear y editar el encabezado de un reporte de negocios
	* @author Mauricio Quinche
    * @param sfRequest $request A request object
    */
    public function executeFormReporte(sfWebRequest $request){

        $this->nivel = $this->getNivel();        
        $this->impoexpo = $this->getRequestParameter("impoexpo");
        $this->load_category();
        
        if($this->modo=="A�reo")
            $this->nomLinea="Aerolinea";
        else if($this->modo=="Mar�timo")
            $this->nomLinea="Naviera";
        else
            $this->nomLinea="Linea";
        /*
        * Se inicializa el objeto
        */
		if( $this->getRequestParameter("id") ){
//                        echo $this->getRequestParameter("id");
			$reporte = Doctrine::getTable("Reporte")->findOneBy("ca_idreporte", $this->getRequestParameter("id")) ;
//                        print_r($reporte);
//                        exit;
			$this->forward404Unless( $reporte );
		}else{
			$reporte = new Reporte();
		}
        
        $this->nuevaVersion = true;
        if( ($reporte->isNew() || $reporte->getCaVersion() == $reporte->getUltVersion())
                &&!$reporte->existeReporteExteriorVersionActual() ){
            $this->editable = true;
        }else{
            $this->editable = false;
        }

        //No permite editar si el usuario no realizo el reporte
        $user = $this->getUser();
        if( !$reporte->isNew() && $user->getUserId()!=$reporte->getCaUsucreado() ){
            $this->editable = false;
        }

        //No permite editar reportes que se hayan agrupado
        if( $reporte->getCaIdgrupo()){
            $this->editable = false;
            $this->nuevaVersion = false;
        }

        //No permite copiar ni generar nuevas versiones de nuevos reportes
        if( !$reporte->getCaIdreporte()){
            $this->editable = true;
            $this->nuevaVersion = false;
            $this->copiar = false;
        }else{
            $this->copiar = true;
        }
        
        $this->reporte=$reporte;       
   }

   /*
	* Valida y guarda el reporte
	* @author Mauricio Quinche
    * @param sfRequest $request A request object
    */

    public function executeGuardarReporte( sfWebRequest $request )
    {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        if(!$reporte)
            $reporte = new Reporte();        

        $redirect=true;
        $opcion=$request->getParameter("opcion");
        //$redirect=false;
        switch( $opcion ){
            case 0:
                if( !$reporte->getCaIdreporte() ){
                    $reporte->setCaFchreporte( date("Y-m-d") );
                    $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                    $reporte->setCaVersion( 1 );
                }
                //$redirect=false;
                $redirect=true;
                break;
            case 1:
                $reporte = $reporte->copiar(1);
                //$reporte->setCaVersion( $reporte->getCaVersion( )+1 );
                $redirect=true;
                break;
            case 2:
                $reporte = $reporte->copiar(2);
                $redirect=true;
                break;
        }
//        echo $opcion;
        if( $opcion!=0 ) //Al copiar el reporte ya se coloco el usuario y la fecha
        {
            $reporte->stopBlaming();
        }else
        {
            $errors =  array();

            if($request->getParameter("idcotizacion") && $request->getParameter("idcotizacion")>0)
            {
                $reporte->setCaIdcotizacion($request->getParameter("idcotizacion"));
            }
            else
            {
                $errors["cotizacion"]="Debe asignar un cotizacion";
            }

            if($request->getParameter("idorigen") && $request->getParameter("idorigen")!="")
            {                
                $reporte->setCaOrigen($request->getParameter("idorigen"));
            }
            else
            {
                $errors["idorigen"]="Debe seleccionar un origen";
            }

            if($request->getParameter("iddestino") && $request->getParameter("iddestino")!="")
            {                
                $reporte->setCaDestino($request->getParameter("iddestino"));
            }
            else
            {
                $errors["iddestino"]="Debe seleccionar un destino";
            }

            if($request->getParameter("impoexpo"))
            {
                $reporte->setCaImpoexpo(utf8_decode($request->getParameter("impoexpo")));
            }
            else
            {
                $errors["iddestino"]="Debe seleccionar una clase";
            }

            if($request->getParameter("fchdespacho") )
            {
                $reporte->setCaFchdespacho(Utils::parseDate($request->getParameter("fchdespacho")));
            }else
            {
                $errors["fchdespacho"]="Debe seleccionar una fecha de despacho";
            }

            if($request->getParameter("incoterms") )
            {                
                $reporte->setCaIncoterms($request->getParameter("incoterms"));

            }else
            {
                $errors["incoterms"]="Debe seleccionar un termino";
            }

            if($request->getParameter("idconcliente") )
            {
                $reporte->setCaIdconcliente($request->getParameter("idconcliente"));

            }else
            {
                $errors["idconcliente"]="Debe seleccionar un termino";
            }

			if($request->getParameter("idclientefac") )
            {
                $reporte->setCaIdclientefac($request->getParameter("idclientefac"));
            }

			if($request->getParameter("idclienteag") )
            {
                $reporte->setCaIdclienteag($request->getParameter("idclienteag"));
            }

			if($request->getParameter("idclienteotro") )
            {
                $reporte->setCaIdclienteotro($request->getParameter("idclienteotro"));
            }

            if($request->getParameter("idagente") && $request->getParameter("idagente")!="")
            {
                if(is_numeric($request->getParameter("idagente")))
                    $reporte->setCaIdagente($request->getParameter("idagente"));
            }
            else
            {
                $errors["idagente"]="Debe seleccionar un agente";
            }

            if($request->getParameter("ca_mercancia_desc") && $request->getParameter("ca_mercancia_desc")!="" )
            {
                $reporte->setCaMercanciaDesc($request->getParameter("ca_mercancia_desc"));
            }else
            {
                $errors["ca_mercancia_desc"]="Debe colocar un texto de descripcion de la mercacia";
            }
            if($request->getParameter("prov") )
            {
                $reporte->setCaIdproveedor($request->getParameter("prov"));
            }
        //ca_orden_prov:  No aplica
/*            if($request->getParameter("idconcliente") )
            {
                $reporte->setCaIdconcliente($request->getParameter("idconcliente"));
            }
*/
            if($request->getParameter("orden_clie") )
            {
                $reporte->setCaOrdenClie($request->getParameter("orden_clie"));
            }
            $ca_confirmar_clie="";
            for($i=0;$i<15;$i++)
            {
                if($request->getParameter("contacto_".$i))
                {
                    $ca_confirmar_clie=($ca_confirmar_clie!="")?",":"";
                    $ca_confirmar_clie=$request->getParameter("contacto_".$i);
                }
            }

            if($ca_confirmar_clie!="" )
            {
                $reporte->setCaConfirmarClie($ca_confirmar_clie);
            }

            if($request->getParameter("idrepres") )
            {
                $reporte->setCaIdrepresentante($request->getParameter("idrepres"));
            }

            if($request->getParameter("ca_informar_repr") )
            {
                $reporte->setCaInformarRepr( (($request->getParameter("ca_informar_repr")=="on")?"S�":"No") );
            }

            if($request->getParameter("consig") )
            {
                $reporte->setCaIdconsignatario($request->getParameter("consig"));
            }
    //ca_informar_cons:
            if($request->getParameter("notify") )
            {
                $reporte->setCaIdnotify($request->getParameter("notify"));
            }
    //ca_informar_noti:
            if($request->getParameter("consigmaster") )
            {
                $reporte->setCaIdmaster($request->getParameter("consigmaster"));
            }
    //ca_informar_mast:
			if($request->getParameter("ca_informar_mast") )
            {
                $reporte->setCaInformarMast($request->getParameter("ca_informar_mast"));
            }
    //ca_notify:
            if($request->getParameter("transporte") )
            {
                $reporte->setCaTransporte("Mar�timo");
                //$reporte->setCaTransporte($request->getParameter("transporte"));
            }
            else
            {
                $errors["transporte"]="Debe seleccionar un agente";
            }
            if($request->getParameter("idmodalidad") )
            {
                $reporte->setCaModalidad($request->getParameter("idmodalidad"));
            }

            if($request->getParameter("seguros-checkbox") && $request->getParameter("seguros-checkbox")=="on"  )
            {
                $reporte->setCaSeguro("S�");
            }
            else
            {
                $reporte->setCaSeguro("No");
            }
            if($request->getParameter("ca_liberacion") )
            {
                $reporte->setCaLiberacion(utf8_decode($request->getParameter("ca_liberacion")));
            }
            if($request->getParameter("ca_tiempocredito") )
            {
                $reporte->setCaTiempocredito($request->getParameter("ca_tiempocredito"));
            }
            if($request->getParameter("ca_comodato") )
            {
                $reporte->setCaComodato($request->getParameter("ca_comodato"));
            }
            if($request->getParameter("preferencias") )
            {
                $reporte->setCaPreferenciasClie($request->getParameter("preferencias"));
            }
            if($request->getParameter("instrucciones") )
            {
                $reporte->setCaInstrucciones($request->getParameter("instrucciones"));
            }


            if($request->getParameter("idlinea") && $request->getParameter("idlinea")!="")
            {
                if(is_numeric($request->getParameter("idlinea")))
                    $reporte->setCaIdlinea($request->getParameter("idlinea"));
            }
            else
            {
                $errors["linea"]="Debe seleccionar un linea";
            }

            if($request->getParameter("consignar") && $request->getParameter("consignar")>0  )
            {
                $reporte->setCaIdconsignar($request->getParameter("consignar"));
            }
            else
            {
                //revisar
                $reporte->setCaIdconsignar(1);
            }

            if($request->getParameter("idconsigmaster") && $request->getParameter("idconsigmaster")>0  )
            {
                $reporte->setCaIdconsignarmaster($request->getParameter("idconsigmaster"));
            }
            else
                $reporte->setCaIdconsignarmaster(0);

            if($request->getParameter("idbodega_hd") && $request->getParameter("idbodega_hd")>0  )
            {
                $reporte->setCaIdbodega($request->getParameter("idbodega_hd"));
            }
            else
            {
                //revisar
//                $reporte->setCaIdbodega(81);
            }
    //ca_mastersame:
            if($request->getParameter("continuacion")   )
            {
                $reporte->setCaContinuacion($request->getParameter("continuacion"));
            }
            if($request->getParameter("continuacion_dest")   )
            {
                $reporte->setCaContinuacionDest($request->getParameter("continuacion_dest"));
            }

            if($request->getParameter("idvendedor") && $request->getParameter("idvendedor")!="")
            {
                $reporte->setCaLogin($request->getParameter("idvendedor"));
            }
            else
            {
                if($request->getParameter("vendedor") && $request->getParameter("vendedor")=="")
                $errors["vendedor"]="Debe asignar una cotizacion con vendedor";
            }

            if($request->getParameter("ca_continuacion_conf") )
            {
                $reporte->setCaContinuacionConf(utf8_decode($request->getParameter("ca_continuacion_conf")));
            }
    //    ca_continuacion_conf
    //    ca_etapa_actual:

            if($request->getParameter("aduanas-checkbox") && $request->getParameter("aduanas-checkbox")=="on"  )
            {
                $reporte->setCaColmas("S�");
            }
            else
            {
                $reporte->setCaColmas("No");
            }
    //ca_propiedades:
    //ca_idetapa:

            if($request->getParameter("ca_mcia_peligrosa") && $request->getParameter("ca_mcia_peligrosa")=="on"  )
            {
                $reporte->setCaMciaPeligrosa(true);
            }
            else
            {
                $reporte->setCaMciaPeligrosa(false);
            }
        }

        if(count($errors)>0)
            $this->responseArray=array("success"=>false,"idreporte"=>$idreporte,"redirect"=>$redirect,"errors"=>$errors);
        else
        {
            $reporte->save();
			
            if($request->getParameter("seguros-checkbox")== "on")
			{
                $repSeguro = Doctrine::getTable("RepSeguro")->findOneBy("ca_idreporte", $reporte->getCaIdreporte() );
                if(!$repSeguro)
                    $repSeguro= new RepSeguro();

				$repSeguro->setCaIdreporte($reporte->getCaIdreporte());

                if($request->getParameter("ca_seguro_conf") )
				{
					$repSeguro->setCaSeguroConf($request->getParameter("ca_seguro_conf"));
				}

				if($request->getParameter("ca_vlrasegurado") )
				{
					$repSeguro->setCaVlrasegurado($request->getParameter("ca_vlrasegurado"));
				}

                if($request->getParameter("ca_idmoneda_vlr") )
				{
					$repSeguro->setCaIdmonedaVlr($request->getParameter("ca_idmoneda_vlr"));
				}

                if($request->getParameter("ca_obtencionpoliza") )
				{
					$repSeguro->setCaObtencionpoliza($request->getParameter("ca_obtencionpoliza"));
				}

                if($request->getParameter("ca_idmoneda_pol") )
				{
					$repSeguro->setCaIdmonedaPol($request->getParameter("ca_idmoneda_pol"));
				}

                if($request->getParameter("ca_primaventa") )
				{
					$repSeguro->setCaPrimaventa($request->getParameter("ca_primaventa"));
				}

                if($request->getParameter("ca_minimaventa") )
				{
					$repSeguro->setCaMinimaventa($request->getParameter("ca_minimaventa"));
				}
                
                if($request->getParameter("ca_idmoneda_vta") )
				{
					$repSeguro->setCaIdmonedaVta($request->getParameter("ca_idmoneda_vta"));
				}
				$repSeguro->save();
			}

            if($reporte->getCaModalidad()== Constantes::EXPO)
			{
				$repExpo= new RepExpo();
				$repExpo->setCaIdreporte($reporte->getCaIdreporte());
				if($request->getParameter("npiezas") && $request->getParameter("mpiezas") )
				{
					$repExpo->setCaPiezas($request->getParameter("npiezas")." ".$request->getParameter("mpiezas"));
				}

				if($request->getParameter("npeso") && $request->getParameter("mpeso") )
				{
					$repExpo->setCaPeso($request->getParameter("npeso")." ".$request->getParameter("mpeso"));
				}

				if($request->getParameter("nvolumen") && $request->getParameter("mvolumen") )
				{
					$repExpo->setCaVolumen($request->getParameter("nvolumen")." ".$request->getParameter("mvolumen"));
				}

				if($request->getParameter("dimensiones") )
				{
					$repExpo->setCaDimensiones($request->getParameter("dimensiones"));
				}

				if($request->getParameter("valor_carga") )
				{
					$repExpo->setCaValorcarga($request->getParameter("valor_carga"));
				}
				if($request->getParameter("sia") )
				{
					$repExpo->setCaIdsia($request->getParameter("sia"));
				}

				if($request->getParameter("tipoexpo") )
				{
					$repExpo->setCaTipoexpo($request->getParameter("tipoexpo"));
				}

				if($request->getParameter("motonave") )
				{
					$repExpo->setCaMotonave($request->getParameter("motonave"));
				}

				$repExpo->save();

			}


            $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"redirect"=>$redirect);
        }

        $this->setTemplate("responseTemplate");
        //cuando se seleccion una cotizacion se debe marcar el campo aprobado, etapa='APR';
    }


   public function executeGuardarReporte1( sfWebRequest $request ){


        /*
        * Parametros que se mantienen en caso de que ocurra un error
        */
        $bindValues = $request->getParameter("reporte");
        $bindValues["ca_origen"]=$request->getParameter("idorigen");
        $bindValues["ca_destino"]=$request->getParameter("iddestino");
        $bindValues["ca_idcotizacion"]=$request->getParameter("cotizacion");
        $bindValues["ca_modalidad"]=$request->getParameter("idmodalidad");
        $bindValues["ca_continuacion"]=$request->getParameter("continuacion");


        $this->origen = $request->getParameter("origen");
        $this->destino = $request->getParameter("destino");
        $this->idconcliente = $request->getParameter("idconcliente");
        $this->ca_idconcliente = $request->getParameter("ca_idconcliente");

        $country_reporte = $request->getParameter("country_reporte");
        $this->ca_traorigen = $country_reporte["ca_origen"];
        $this->ca_tradestino = $country_reporte["ca_destino"];

        $this->ca_origen = $bindValues["ca_origen"];
        $this->ca_destino = $bindValues["ca_destino"];

        $this->contactos = array();

        for( $i=0; $i<ReporteForm::NUM_CC; $i++ ){
            if( isset( $bindValues["contacto_".$i] )){
                $bindValues["contacto_".$i] = trim($bindValues["contacto_".$i]);
                $this->contactos[] = $bindValues["contactos_".$i];
            }
        }


        if( $request->getParameter("idproveedor") ){
            $proveedores = $request->getParameter("idproveedor");
            $orden_prov = $request->getParameter("orden_prov");
            $incoterms = $request->getParameter("incoterms");

            foreach( $proveedores as $key=>$val){ //Despues de agregar y elimianr proveedores esto evita un error
                if( !$val ){
                    unset($proveedores[$key]);
                    unset($orden_prov[$key]);
                    unset($incoterms[$key]);
                }
            }
            $this->idproveedor = implode("|", $proveedores );
            $bindValues["ca_idproveedor"] = $this->idproveedor;
            $this->orden_prov = implode("|", $orden_prov );

            $bindValues["ca_orden_prov"] = $this->orden_prov;
            $this->incoterms = implode("|", $incoterms );
            $bindValues["ca_incoterms"] = $this->incoterms;
        }else{
            $this->idproveedor = "";
            $this->orden_prov = "";
            $this->incoterms = "";
        }

        $this->idconsignatario = $request->getParameter("consig");
        $bindValues["ca_idconsignatario"] = $this->idconsignatario;
        $this->idnotify = $request->getParameter("notify");
        $this->idrepresentante = $request->getParameter("idrepresentante");
        $this->idmaster = $request->getParameter("consigmaster");
        $this->ca_notify = $request->getParameter("idrepres");
        @$this->ca_continuacion = $bindValues["ca_continuacion"];


        $this->seguro_conf = $request->getParameter("seguro_conf");

        $this->idcotizacion =  isset($bindValues["ca_idcotizacion"])?$bindValues["ca_idcotizacion"]:null;

        /*
        *  Datos que se utilizan en el formulario
        */

        $this->modalidadesAduana = array();
        $modalidadesAduana = Doctrine::getTable("Modalidad")
                                             ->createQuery("m")
                                             ->select("m.ca_idmodalidad")
                                             ->where("m.ca_modalidad LIKE ?", array("ADUANA%"))
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();
        foreach( $modalidadesAduana as $row ){
            $this->modalidadesAduana[]=$row["m_ca_idmodalidad"];
        }

        $this->bodegas = Doctrine::getTable("Bodega")
                                             ->createQuery("b")
                                             ->select("b.*")
                                             ->addOrderBy("b.ca_tipo ASC")
                                             ->addOrderBy("b.ca_nombre ASC")
                                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                                             ->execute();

        foreach( $this->bodegas as $key=>$val ){
            $this->bodegas[$key]["b_ca_tipo"] = utf8_encode($this->bodegas[$key]["b_ca_tipo"]);
            $this->bodegas[$key]["b_ca_transporte"] = utf8_encode($this->bodegas[$key]["b_ca_transporte"]);
            $this->bodegas[$key]["b_ca_nombre"] = utf8_encode($this->bodegas[$key]["b_ca_nombre"]);
        }

        $this->traficos = Doctrine::getTable('Trafico')->createQuery('t')
                            ->select("t.ca_idtrafico, t.ca_nombre")
                            ->where('t.ca_idtrafico != ?', '99-999')
                            ->addOrderBy('t.ca_nombre ASC')
                            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                            ->execute();

        foreach($this->traficos as $key=>$val){
			$this->traficos[$key]["ca_nombre"] = utf8_encode( $this->traficos[$key]["ca_nombre"] );
		}

        $agentes = Doctrine_Query::create()
                             ->select("a.*, i.ca_nombre, t.ca_idtrafico, t.ca_nombre")
                             ->from("IdsAgente a")
                             ->innerJoin("a.Ids i")
                             ->innerJoin("i.IdsSucursal s")
                             ->innerJoin("s.Ciudad c")
                             ->innerJoin("c.Trafico t")
                             ->where("s.ca_principal = ?", true)
                             ->addWhere("a.ca_activo = ?", true)
                             ->addOrderBy("t.ca_nombre")
                             ->addOrderBy("i.ca_nombre")
                             ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                             ->execute();
        $this->agentes = array();
        foreach( $agentes as $agente ){
            $this->agentes[ $agente["t_ca_idtrafico"] ][]=array("idagente" => $agente["a_ca_idagente"],
                                                                "nombre" => utf8_encode($agente["i_ca_nombre"]),
                                                                "pais" => utf8_encode($agente["t_ca_nombre"]),
                                                                "idtrafico" => $agente["t_ca_idtrafico"]);
        }
        /*
        * Se inicializan los formularios
        */

        $form = new ReporteForm();
        $formAduana = new RepAduanaForm();
        $formSeguro = new RepSeguroForm();
        $formExpo = new RepExpoForm();


       /*
        * Se procesa la forma
        */
//        if ($request->isMethod('post'))
        {

            /**********************************************
            * Validaciones los datos
            ***********************************************/


            $bindValues["ca_modalidad"] = $bindValues["ca_modalidad"];
            $bindValues["ca_transporte"] = $request->getParameter("transporte");
            $bindValues["ca_impoexpo"] = $request->getParameter("impoexpo");

/*            if( $bindValues["ca_impoexpo"] ){
                $reporte->setCaImpoexpo( $bindValues["ca_impoexpo"] );
            }

            if( $bindValues["ca_transporte"] ){
                $reporte->setCaTransporte( $bindValues["ca_transporte"] );
            }

            if( $bindValues["ca_modalidad"] ){
                $reporte->setCaModalidad( $bindValues["ca_modalidad"] );
            }
*/
//            $soloAduana = $reporte->esSoloAduana();

/*            if( $soloAduana ){
                $bindValues["ca_idagente"] = null;
                $bindValues["ca_colmas"]="S�";//($request->getParameter("aduanas-checkbox") && $request->getParameter("aduanas-checkbox")=="on" )?"S�":"No";
                $bindValues["ca_continuacion"]="N/A";
            }
*/
//            $bindValues["ca_idconcliente"] = $request->getParameter("ca_idconcliente");


            //Coloca el Rep. Comercial
/*//maqr revisar
             if( $this->nivel<2 ){
                $contancto = Doctrine::getTable("Contacto")->find( $bindValues["ca_idconcliente"] );
                $cliente = $contancto->getCliente();
                $bindValues["ca_login"] = $cliente->getCaVendedor();
            }
*/
            $form->bind( $bindValues );
/*            if( $bindValues["ca_colmas"]=="S�" ){
                $bindValuesAduana = $request->getParameter( $formAduana->getName() );

                $formAduana->bind( $bindValuesAduana );

                if( $formAduana->isValid() ){
                    $aduanaValido = true;
                }else{
                    $aduanaValido = false;
                }
            }else{
                $aduanaValido = true;
            }

            if( $bindValues["ca_seguro"]=="S�" ){
                $bindValuesSeguro = $request->getParameter( $formSeguro->getName() );
                $formSeguro->bind( $bindValuesSeguro );

                if( $formSeguro->isValid() ){
                    $seguroValido = true;
                }else{
                    $seguroValido = false;
                }
            }else{
                $seguroValido = true;
            }
*/
            if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                $bindValuesExpo = $request->getParameter( $formExpo->getName() );
                $formExpo->bind( $bindValuesExpo );

                if( $formExpo->isValid() ){
                    $expoValido = true;
                }else{
                    $expoValido = false;
                }
            }else{
                $expoValido = true;
            }

			if( $form->isValid() && $aduanaValido && $seguroValido && $expoValido ){
                /**********************************************
                * Guarda los datos
                ***********************************************/
                $opcion = $request->getParameter("opcion");

                switch( $opcion ){
                    case 1:
                        if( !$reporte->getCaIdreporte() ){
                            $reporte->setCaFchreporte( date("Y-m-d") );
                            $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                            $reporte->setCaVersion( 1 );
                        }
                        break;
                    case 2:
                        $reporte = $reporte->copiar(2);
                        break;
                    case 3:
                        $reporte = $reporte->copiar(1);
                        break;
                }


                if( $this->ca_idconcliente ){
                    $reporte->setCaIdconcliente( $this->ca_idconcliente );
                }

                if( $bindValues["ca_idlinea"]!==null ){
                    $reporte->setCaIdlinea( $bindValues["ca_idlinea"] );
                }

                if( $bindValues["ca_origen"] ){
                    $reporte->setCaOrigen( $bindValues["ca_origen"] );
                }

                if( $bindValues["ca_destino"] ){
                    $reporte->setCaDestino( $bindValues["ca_destino"] );
                }

                if( $bindValues["ca_orden_clie"] ){
                    $reporte->setCaOrdenClie( $bindValues["ca_orden_clie"] );
                }

                if( $bindValues["ca_fchdespacho"] ){
                    $reporte->setCaFchdespacho( $bindValues["ca_fchdespacho"] );
                }

                if( $bindValues["ca_login"] ){
                    $reporte->setCaLogin( $bindValues["ca_login"] );
                }

                if( $bindValues["ca_mercancia_desc"] ){
                    $reporte->setCaMercanciaDesc( $bindValues["ca_mercancia_desc"] );
                }

                if( isset($bindValues["ca_mcia_peligrosa"]) ){
                    $reporte->setCaMciaPeligrosa( true );
                }else{
                    $reporte->setCaMciaPeligrosa( false );
                }

                if( $bindValues["ca_preferencias_clie"]!==null ){
                    $reporte->setCaPreferenciasClie( $bindValues["ca_preferencias_clie"] );
                }

                if( $bindValues["ca_instrucciones"]!==null ){
                    $reporte->setCaInstrucciones( $bindValues["ca_instrucciones"] );
                }

                for( $i=0; $i<ReporteForm::NUM_CC; $i++ ){
                    if( isset( $bindValues["contactos_".$i] ) && isset( $bindValues["confirmar_".$i] ) && $bindValues["confirmar_".$i] ){
                        $contactos[] = $bindValues["contactos_".$i];
                    }
                }

                if( count( $contactos )>0 ){
                    $reporte->setCaConfirmarClie( implode(",",$contactos) );

                }

                /*
                * Datos de proveedores y consignatarios
                */
                if( $bindValues["ca_impoexpo"]==Constantes::IMPO ){
                    if( $this->idproveedor ){
                        $reporte->setCaIdproveedor( $this->idproveedor );
                    }else{
                        $reporte->setCaIdproveedor( null );
                    }

                    if( $this->orden_prov ){
                        $reporte->setCaOrdenProv( $this->orden_prov );
                    }else{
                        $reporte->setCaOrdenProv( null );
                    }

                    if( $this->incoterms ){
                        $reporte->setCaIncoterms( $this->incoterms );
                    }else{
                        $reporte->setCaIncoterms( null );
                    }
                }else{
                    $reporte->setCaIdproveedor( null );
                    $reporte->setCaOrdenProv( null );
                    $reporte->setCaIncoterms( $bindValues["ca_incoterms"] );
                    $reporte->setCaNotify( null );
                    $reporte->setCaIdnotify( null );
                }

                //Notify solo aplica para impo maritimo o expo
                if( $bindValues["ca_transporte"]==Constantes::MARITIMO||$bindValues["ca_impoexpo"]==Constantes::EXPO ){
                    if( $this->ca_notify ){
                        $reporte->setCaNotify( $this->ca_notify );
                    }
                    if( $this->idnotify ){
                        $reporte->setCaIdnotify( $this->idnotify );
                    }
                }else{
                    $reporte->setCaNotify( null );
                    $reporte->setCaIdnotify( null );
                }


                if( $this->idconsignatario ){
                    $reporte->setCaIdconsignatario( $this->idconsignatario );
                }else{
                    $reporte->setCaIdconsignatario( null );
                }

                if( $this->idmaster ){
                    $reporte->setCaIdmaster( $this->idmaster );
                }else{
                    $reporte->setCaIdmaster( null );
                }



                if( $this->idrepresentante ){
                    $reporte->setCaIdrepresentante( $this->idrepresentante );
                }else{
                    $reporte->setCaIdrepresentante( null );
                }

                if( $bindValues["ca_idagente"] ){
                    $reporte->setCaIdagente( $bindValues["ca_idagente"] );
                }else{
                    $reporte->setCaIdagente( null );
                }


                if( $bindValues["ca_informar_noti"] ){
                    $reporte->setCaInformarNoti( $bindValues["ca_informar_noti"] );
                }else{
                    $reporte->setCaInformarNoti( null );
                }

                if( $bindValues["ca_informar_cons"] ){
                    $reporte->setCaInformarCons( $bindValues["ca_informar_cons"] );
                }else{
                    $reporte->setCaInformarCons( null );
                }

                if( $bindValues["ca_informar_repr"] ){
                    $reporte->setCaInformarRepr( $bindValues["ca_informar_repr"] );
                }else{
                    $reporte->setCaInformarRepr( null );
                }

                if( $bindValues["ca_informar_mast"] ){
                    $reporte->setCaInformarMast( $bindValues["ca_informar_mast"] );
                }else{
                    $reporte->setCaInformarMast( null );
                }


                if( $bindValues["ca_idcotizacion"] ){
                    $reporte->setCaIdcotizacion( $bindValues["ca_idcotizacion"] );
                }else{
                    $reporte->setCaIdcotizacion( null );
                }


                if( $bindValues["ca_idproducto"] ){
                    $reporte->setCaIdproducto( $bindValues["ca_idproducto"] );
                }else{
                    $reporte->setCaIdproducto( null );
                }

                if( $bindValues["ca_comodato"]=="S�" ){
                    $reporte->setCaComodato( "S�" );

                }else{
                    $reporte->setCaComodato( "No" );
                }

                if( $bindValues["ca_colmas"]=="S�" ){
                    $reporte->setCaColmas( "S�" );

                }else{
                    $reporte->setCaColmas( "No" );
                }


                if( $bindValues["ca_seguro"]!==null ){
                    $reporte->setCaSeguro( $bindValues["ca_seguro"] );
                }

                //Continuacion
                $reporte->setCaContinuacion( $bindValues["ca_continuacion"] );
                $reporte->setCaContinuacionDest( $bindValues["ca_continuacion_dest"] );
                if( $bindValues["ca_transporte"]==Constantes::MARITIMO ){
                    $reporte->setCaContinuacionConf( $bindValues["ca_continuacion_conf"] );
                }else{
                    $reporte->setCaContinuacionConf( null );
                }

                //Corte de documentos
                if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                    $reporte->setCaIdconsignar( $bindValues["ca_idconsignar_expo"] );
                    $reporte->setCaIdconsignarmaster( $bindValues["ca_idconsignarmaster"] );
                }else{
                    $reporte->setCaIdconsignar( $bindValues["ca_idconsignar_impo"] );
                    $reporte->setCaIdbodega( $bindValues["ca_idbodega"] );

                }

                $reporte->setCaLiberacion( null );
                $reporte->setCaTiempocredito( null );
                $cliente = $reporte->getCliente();
                if( $cliente ){
                    $libCliente = $cliente->getLibCliente();
                    if( $libCliente ){
                        if( $libCliente->getCaCupo()!=0 || $libCliente->getCaDiascredito() ){
                            $reporte->setCaLiberacion( "S�" );
                        }else{
                            $reporte->setCaLiberacion( "No" );
                        }
                        $reporte->setCaTiempocredito( $libCliente->getCaDiascredito()." D�as" );
                    }
                }

                if( $opcion!=1 ){ //Al copiar el reporte ya se coloco el usuario y la fecha
                    $reporte->stopBlaming();
                }
                $reporte->save();
                $repaduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_colmas"]=="S�" ){
                    if( !$repaduana ){
                        $repaduana = new RepAduana();
                        $repaduana->setCaIdreporte( $reporte->getCaIdreporte() );
                    }
                    $repaduana->setCaInstrucciones( $bindValuesAduana["ca_instrucciones"] );
                    if( $reporte->getCaImpoexpo()!=Constantes::EXPO ){
                        $repaduana->setCaTransnacarga( $bindValuesAduana["ca_transnacarga"] );
                        $repaduana->setCaCoordinador( $bindValuesAduana["ca_coordinador"] );
                    }else{
                        $repaduana->setCaTransnacarga( null );
                    }
                    $repaduana->setCaTransnatipo( $bindValuesAduana["ca_transnatipo"] );
                    $repaduana->save();

                }else{
                    if( $repaduana ){
                        $repaduana->delete();
                    }
                }


                $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_seguro"]=="S�"  ){
                    if( !$repseguro ){
                        $repseguro = new RepSeguro();
                        $repseguro->setCaIdreporte( $reporte->getCaIdreporte() );
                    }
                    $repseguro->setCaVlrasegurado( $bindValuesSeguro["ca_vlrasegurado"] );
                    $repseguro->setCaIdmonedaVlr( $bindValuesSeguro["ca_idmoneda_vlr"] );
                    $repseguro->setCaPrimaventa( $bindValuesSeguro["ca_primaventa"] );
                    $repseguro->setCaMinimaventa( $bindValuesSeguro["ca_minimaventa"] );
                    $repseguro->setCaIdmonedaVta( $bindValuesSeguro["ca_idmoneda_vta"] );
                    $repseguro->setCaObtencionpoliza( $bindValuesSeguro["ca_obtencionpoliza"] );
                    $repseguro->setCaIdmonedaPol( $bindValuesSeguro["ca_idmoneda_pol"] );
                    $repseguro->setCaSeguroConf( $bindValuesSeguro["ca_seguro_conf"] );
                    $repseguro->save();

                }else{
                    if( $repseguro ){
                        $repseguro->delete();
                    }
                }

                $repexpo = Doctrine::getTable("RepExpo")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_impoexpo"]==Constantes::EXPO ){
                    if( !$repexpo ){
                        $repexpo = new RepExpo();
                        $repexpo->setCaIdreporte( $reporte->getCaIdreporte() );
                    }

                    $repexpo->setCaPiezas( $bindValuesExpo["ca_piezas"]."|".$bindValuesExpo["tipo_piezas"] );
                    $repexpo->setCaPeso( $bindValuesExpo["ca_peso"] );
                    $repexpo->setCaVolumen( $bindValuesExpo["ca_volumen"] );
                    $repexpo->setCaDimensiones( $bindValuesExpo["ca_dimensiones"] );
                    if( $bindValuesExpo["ca_valorcarga"] ){
                        $repexpo->setCaValorcarga( $bindValuesExpo["ca_valorcarga"] );
                    }else{
                        $repexpo->setCaValorcarga( null );
                    }
                    $repexpo->setCaIdsia( $bindValuesExpo["ca_idsia"] );
                    if( $bindValuesExpo["ca_emisionbl"] ){
                        $repexpo->setCaEmisionbl( $bindValuesExpo["ca_emisionbl"] );
                    }else{
                        $repexpo->setCaEmisionbl( null );
                    }

                    if( $bindValuesExpo["ca_numbl"] ){
                        $repexpo->setCaNumbl( $bindValuesExpo["ca_numbl"] );
                    }else{
                        $repexpo->setCaNumbl( null );
                    }
                    $repexpo->setCaTipoexpo( $bindValuesExpo["ca_tipoexpo"] );
                    $repexpo->setCaMotonave( $bindValuesExpo["ca_motonave"] );
                    $repexpo->setCaAnticipo( $bindValuesExpo["ca_anticipo"] );
                    $repexpo->save();


                }else{
                    if( $repexpo ){
                        $repexpo->delete();
                    }
                }

                $this->redirect("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte().($this->opcion?"&opcion=".$this->opcion:""));
            }
        }




        
/*
        $errors =  array();
        $errors["ca_liberacion"]="Last Name has to have at least 2 characters";
        $errors["impoexpo"]="Last Name has to have at least 2 characters";

        $this->responseArray=array("success"=>false,"errors"=>$errors);
        $this->setTemplate("responseTemplate");
 *
 */

//        $this->responseArray=array("success"=>true,"errors"=>$errors);
        $this->responseArray=array("success"=>true);
        $this->setTemplate("responseTemplate");
        //cuando se seleccion una cotizacion se debe marcar el campo aprobado, etapa='APR';
    }

    public function executeDatosReporte(sfWebRequest $request)
    {
        $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte")  );
        $data=array();
        if($reporte)
        {
            $data["idreporte"]=$reporte->getCaIdreporte();
            $data["impoexpo"]=utf8_encode($reporte->getCaImpoexpo());
            $data["transporte"]=utf8_encode($reporte->getCaTransporte());
            $data["idmodalidad"]=$reporte->getCaModalidad();
            $data["incoterms"]=$reporte->getCaIncoterms();

            $data["cotizacion"]=$reporte->getCaIdcotizacion();
            $data["continuacion"]=$reporte->getCaContinuacion();
            $data["continuacion_dest"]=$reporte->getCaContinuacionDest();
            $data["ca_continuacion_conf_".utf8_encode($reporte->getCaContinuacionConf())]= utf8_encode( $reporte->getCaContinuacionConf() );
            //$reporte->setCaContinuacionConf

            $data["idlinea"]=$reporte->getCaIdlinea();
            $data["linea"]=utf8_encode($reporte->getIdsProveedor()->getIds()->getCaNombre());

            $data["idtra_origen_id"]=utf8_encode($reporte->getOrigen()->getTrafico()->getCaIdtrafico());
            $data["tra_origen_id"]=utf8_encode($reporte->getOrigen()->getTrafico()->getCaNombre());
            $data["origen"]=utf8_encode($reporte->getOrigen()->getCaCiudad());
            $data["idorigen"]=$reporte->getCaOrigen();

            $data["idtra_destino_id"]=utf8_encode($reporte->getDestino()->getTrafico()->getCaIdtrafico());
            $data["tra_destino_id"]=utf8_encode($reporte->getDestino()->getTrafico()->getCaNombre());
            $data["destino"]=utf8_encode($reporte->getDestino()->getCaCiudad());
            $data["iddestino"]=$reporte->getCaDestino();

            $ids=$reporte->getIdsAgente()->getIds();
            $data["idagente"]=$reporte->getCaIdagente();
            $data["agente"]=utf8_encode(/*$ids->getIdsSucursal()->getCiudad()->getCaCiudad() .*/" ".$ids->getCaNombre());


            $data["idcliente"]=$reporte->getContacto()->getCaIdcliente();
            $data["cliente"]=$reporte->getContacto()->getCliente()->getCaCompania();


            $data["idconcliente"]=$reporte->getCaIdconcliente();
            $data["contacto"]=$reporte->getContacto()->getCaNombres(). " ".$reporte->getContacto()->getCaPapellido()." ".$reporte->getContacto()->getCaSapellido();

            $data["orden_clie"]=$reporte->getCaOrdenClie();

            $clienteFac = $reporte->getClienteFac();
            if($clienteFac)
            {
                $data["idclientefac"]=$clienteFac->getCaIdcliente();
                $data["clientefac"]=$clienteFac->getCaCompania();
                
            }
            else
            {
                $data["clientefac"]="";
                $data["idclientefac"]="";
            }

            $clienteAg = $reporte->getClienteAg();
            if($clienteAg)
            {
                $data["clienteag"]=$clienteFac->getCaCompania();
                $data["idclienteag"]=$clienteFac->getCaIdcliente();
            }
            else
            {
                $data["clienteag"]="";
                $data["idclienteag"]="";
            }

            $clienteOtro = $reporte->getClienteOtro();
            if($clienteOtro)
            {
                $data["clienteotro"]=$clienteFac->getCaCompania();
                $data["idclienteotro"]=$clienteFac->getCaIdcliente();
            }
            else
            {
                $data["clienteotro"]="";
                $data["idclienteotro"]="";
            }

            //$cliente = new Cliente();
            $cliente=$reporte->getContacto()->getCliente();

            $data["ca_liberacion"] =($cliente->getLibCliente()->getCaDiascredito()>0)?"Si":"No";
            $data["ca_tiempocredito"] =$cliente->getLibCliente()->getCaDiascredito();
            $data["preferencias"] =($reporte->getCaPreferenciasClie()!="")?utf8_encode($reporte->getCaPreferenciasClie()):$cliente->getCaPreferencias();

            //$data["preferencias"]=utf8_encode($reporte->getCaPreferenciasClie());

           $data["ca_comodato"] =utf8_encode($reporte->getCaComodato());

            if( $reporte->getCaIdproveedor() ){
                $values = explode("|", $reporte->getCaIdproveedor() );
                if(count($values)>0)
                {
                    $tercero = Doctrine::getTable("Tercero")->find($values[0]);
                    if($tercero)
                        $data["proveedor"] =Utils::replace($tercero->getCaNombre());

                }
            }
            
            if( $reporte->getCaConfirmarClie() ){
                $values = explode(",", $reporte->getCaConfirmarClie() );
                if(count($values)>0)
                {
                    for($i=0;$i<count($values) && $i<15;$i++)
                    {
                        $data["contacto_".$i] =utf8_encode($values[$i]);
                        $data["chkcontacto_".$i] =true;

                    }
                }
            }



            $data["fchdespacho"]=$reporte->getCaFchdespacho();
            $data["idvendedor"]=utf8_encode($reporte->getCaLogin());
            $data["vendedor"]=utf8_encode($reporte->getUsuario()->getCaNombre());
            

            $data["ca_mercancia_desc"]=utf8_encode($reporte->getCaMercanciaDesc());
            $data["ca_mcia_peligrosa"]=$reporte->getCaMciaPeligrosa();


            
            $data["instrucciones"]=utf8_encode($reporte->getCaInstrucciones());


            $data["ca_colmas"]=utf8_encode($reporte->getCaColmas());
            $repaduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte());
            if( !$repaduana ){
                $repaduana = new RepAduana();
            }
            $data["ca_transnacarga"]=utf8_encode($repaduana->getCaTransnacarga());
            $data["ca_transnatipo"]=utf8_encode($repaduana->getCaTransnatipo());
            $data["ca_coordinador"]=utf8_encode($repaduana->getCaCoordinador());
            $data["ca_instrucciones"]=utf8_encode($repaduana->getCaInstrucciones());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$this->repseguro ){
                $this->repseguro = new RepSeguro();
            }

//            
//            $usuario = Doctrine::getTable("Usuario")->find( $repseguro->getCaSeguroConf() );
            $data["ca_seguro"]=utf8_encode($reporte->getCaSeguro());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$repseguro ){
                $repseguro = new RepSeguro();
            }
            $data["notificar"]=$repseguro->getCaSeguroConf();
            $data["ca_vlrasegurado"]=Utils::formatNumber($repseguro->getCaVlrasegurado(), 3);
            $data["ca_idmoneda_vlr2"]=$repseguro->getCaIdmonedaVlr();
            $data["ca_obtencionpoliza"]=Utils::formatNumber($repseguro->getCaObtencionpoliza(), 3);
            $data["ca_idmoneda_pol"]=$repseguro->getCaIdmonedaPol();
            $data["ca_primaventa"]=Utils::formatNumber($repseguro->getCaPrimaventa(), 3);
            $data["ca_minimaventa"]=Utils::formatNumber($repseguro->getCaMinimaventa(), 3);
            $data["ca_idmoneda_vta"]=$repseguro->getCaIdmonedaVta();



            $data["consignarmaster"]=$reporte->getConsignarmaster();
            $data["tipobodega"]=utf8_encode($reporte->getBodega()->getCaTipo());
            $data["bodega_consignar"]=utf8_encode($reporte->getBodega()->getCaNombre());

            $data["idconsignatario"]=$reporte->getCaIdconsignatario();
            if($reporte->getCaIdconsignatario())
            {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdconsignatario());
                if($tercero)
                    $data["consignatario"] =utf8_encode($tercero->getCaNombre());
            }
            else
                $data["consignatario"]="";


            $data["idconsigmaster"]=$reporte->getCaIdmaster();
            if($reporte->getCaIdmaster())
            {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdmaster());
                if($tercero)
                    $data["consigmaster"] =utf8_encode($tercero->getCaNombre());
            }
            else
                $data["consigmaster"]="";

            $data["idnotify"]=$reporte->getCaIdnotify();
            if($reporte->getCaIdnotify())
            {
                $tercero = Doctrine::getTable("Tercero")->find($reporte->getCaIdnotify());
                if($tercero)
                    $data["notify"] =utf8_encode($tercero->getCaNombre());
            }
            else
                $data["notify"]="";
            $data["idrepresentante"]=$reporte->getCaIdrepresentante();


            
/*            $aduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte() );
            if($aduana)
            {

            }
*/

        }


        $this->responseArray=array("success"=>true,"data"=>$data);
        $this->setTemplate("responseTemplate");
    }

    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executePanelConceptosData(sfWebRequest $request){
        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array('idreporte'=>$reporte->getCaIdreporte());

        $tarifas = Doctrine::getTable("RepTarifa")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->execute();

        foreach( $tarifas as $tarifa ){
            $row = $baseRow;
            $row["iditem"] = $tarifa->getCaIdconcepto();
            $row["item"] = utf8_encode($tarifa->getConcepto()->getCaConcepto());
            $row["cantidad"] = $tarifa->getCaCantidad();
            $row["neta_tar"] = $tarifa->getCaNetaTar();
            $row["neta_min"] = $tarifa->getCaNetaMin();
            $row["neta_idm"] = $tarifa->getCaNetaIdm();
            $row["reportar_tar"] = $tarifa->getCaReportarTar();
            $row["reportar_min"] = $tarifa->getCaReportarMin();
            $row["reportar_idm"] = $tarifa->getCaReportarIdm();
            $row["cobrar_tar"] = $tarifa->getCaCobrarTar();
            $row["cobrar_min"] = $tarifa->getCaCobrarMin();
            $row["cobrar_idm"] = $tarifa->getCaCobrarIdm();
            $row["observaciones"] = $tarifa->getCaObservaciones();
            $row['tipo']="concepto";
            $row['orden']=$tarifa->getConcepto()->getCaConcepto();
            $conceptos[] = $row;

            $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $tarifa->getCaIdconcepto() )
                             ->execute();
            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = $tarifa->getCaIdconcepto();
                $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
                $row["tipo_app"] = $recargo->getCaTipo();
                $row["aplicacion"] = $recargo->getCaAplicacion();
                $row["neta_tar"] = $recargo->getCaNetaTar();
                $row["neta_min"] = $recargo->getCaNetaMin();
                $row["reportar_tar"] = $recargo->getCaReportarTar();
                $row["reportar_min"] = $recargo->getCaReportarMin();
                $row["cobrar_tar"] = $recargo->getCaCobrarTar();
                $row["cobrar_min"] = $recargo->getCaCobrarMin();
                $row["cobrar_idm"] = $recargo->getCaIdmoneda();
                $row["observaciones"] = $recargo->getCaDetalles();
                $row['tipo']="recargo";
                $row['orden']=$tarifa->getConcepto()->getCaConcepto()."-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
        }

        $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo tr")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", 9999 )
                             ->addWhere("tr.ca_tipo like ?", "%".Constantes::RECARGO_EN_ORIGEN."%" )
                             ->execute();

        if( count($recargos)>0){

            $row = $baseRow;
            $row["iditem"] = 9999;

            $row["item"] = "Recargo general del trayecto";
            $row['tipo']="concepto";
            $row['orden']="Y";
            $conceptos[] = $row;

            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = 9999;
                $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
                $row["tipo_app"] = $recargo->getCaTipo();
                $row["aplicacion"] = $recargo->getCaAplicacion();
                $row["neta_tar"] = $recargo->getCaNetaTar();
                $row["neta_min"] = $recargo->getCaNetaMin();
                $row["reportar_tar"] = $recargo->getCaReportarTar();
                $row["reportar_min"] = $recargo->getCaReportarMin();
                $row["cobrar_tar"] = $recargo->getCaCobrarTar();
                $row["cobrar_min"] = $recargo->getCaCobrarMin();
                $row["cobrar_idm"] = $recargo->getCaIdmoneda();
                $row["observaciones"] = $recargo->getCaDetalles();
                $row['tipo']="recargo";
                $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
        }

        $row = $baseRow;
        $row['iditem']="";
        $row['item']="+";
        $row['tipo']="concepto";
        $row['orden']="Z";
        $conceptos[] = $row;

        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeObservePanelConceptoFletes(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);

        $tipo = $request->getParameter("tipo");

        if( $tipo=="concepto" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));
            if( !$tarifa ){
                $tarifa = new RepTarifa();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdconcepto( $idconcepto );
            }


            if( $request->getParameter("cantidad")!==null ){
                $tarifa->setCaCantidad( $request->getParameter("cantidad") );
            }

            if( $request->getParameter("neta_tar")!==null ){
                $tarifa->setCaNetaTar( $request->getParameter("neta_tar") );
            }
            if( $request->getParameter("neta_min")!==null ){
                $tarifa->setCaNetaMin( $request->getParameter("neta_min") );
            }

            if( $request->getParameter("neta_idm")!==null ){
                $tarifa->setCaNetaIdm( $request->getParameter("neta_idm") );
            }


            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }

            if( $request->getParameter("reportar_idm")!==null ){
                $tarifa->setCaReportarIdm( $request->getParameter("reportar_idm") );
            }

            if( $request->getParameter("cobrar_tar")!==null ){
                $tarifa->setCaCobrarTar( $request->getParameter("cobrar_tar") );
            }

            if( $request->getParameter("cobrar_min")!==null ){
                $tarifa->setCaCobrarMin( $request->getParameter("cobrar_min") );
            }

            if( $request->getParameter("cobrar_idm")!==null ){
                $tarifa->setCaCobrarIdm( $request->getParameter("cobrar_idm") );
            }

            if( $request->getParameter("observaciones")!==null ){
                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaObservaciones( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaObservaciones( null );
                }
            }

            $tarifa->save();
            $this->responseArray["success"]=true;
        }


        if( $tipo=="recargo" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $idrecargo = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepGasto")->find(array($idreporte, $idconcepto, $idrecargo ));
            if( !$tarifa ){
                $tarifa = new RepGasto();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdconcepto( $idconcepto );
                $tarifa->setCaIdrecargo( $idrecargo );
            }

            if( $request->getParameter("aplicacion")!==null ){
                $tarifa->setCaAplicacion( $request->getParameter("aplicacion") );
            }

            if( $request->getParameter("tipo_app")!==null ){
                $tarifa->setCaTipo( $request->getParameter("tipo_app") );
            }

            if( $request->getParameter("neta_tar")!==null ){
                $tarifa->setCaNetaTar( $request->getParameter("neta_tar") );
            }else{
                $tarifa->setCaNetaTar( 0 ); //[TODO] permitir null
            }


            if( $request->getParameter("neta_min")!==null ){
                $tarifa->setCaNetaMin( $request->getParameter("neta_min") );
            }else{
                $tarifa->setCaNetaMin( 0 ); //[TODO] permitir null
            }


            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }else{
                $tarifa->setCaReportarTar( 0 ); //[TODO] permitir null
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }else{
                $tarifa->setCaReportarMin( 0 ); //[TODO] permitir null
            }


            if( $request->getParameter("cobrar_tar")!==null ){
                $tarifa->setCaCobrarTar( $request->getParameter("cobrar_tar") );
            }

            if( $request->getParameter("cobrar_min")!==null ){
                $tarifa->setCaCobrarMin( $request->getParameter("cobrar_min") );
            }

            if( $request->getParameter("cobrar_idm")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("cobrar_idm") );
            }

            if( $request->getParameter("observaciones")!==null ){
                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaDetalles( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaDetalles( null );
                }
            }

            $tarifa->save();
            $this->responseArray["success"]=true;
        }

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarPanelConceptosFletes(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");

        if( $tipo=="concepto" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));


            $gastos = Doctrine_Query::create()
                                ->select("g.*")
                                ->from("RepGasto g")
                                ->innerJoin("g.TipoRecargo t")
                                ->where("g.ca_idreporte = ? AND g.ca_idconcepto = ?", array($idreporte, $idconcepto))
                                ->addWhere("t.ca_tipo like ?", "%".Constantes::RECARGO_EN_ORIGEN."%")
                                ->execute();

            foreach( $gastos as $gasto ){
                $gasto->delete();
            }

            if( $tarifa ){

                $tarifa->delete();
            }
        }


        if( $tipo=="recargo" ){
            $idreporte = $request->getParameter("idreporte");
            $idconcepto = $request->getParameter("idconcepto");
            $idrecargo = $request->getParameter("idrecargo");
            $tarifa = Doctrine::getTable("RepGasto")->find(array($idreporte, $idconcepto, $idrecargo ));

            if( $tarifa ){
                $tarifa->delete();
            }
        }

        $this->setTemplate("responseTemplate");

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>true);

    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executePanelRecargosData(sfWebRequest $request){
        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array('idreporte'=>$reporte->getCaIdreporte());

        $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->innerJoin("t.TipoRecargo tr")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             //->addWhere("t.ca_idconcepto = ?", 9999 )
                             ->addWhere("tr.ca_tipo like ?", "%".Constantes::RECARGO_LOCAL."%" )
                             ->execute();

        foreach( $recargos as $recargo ){
            $row = $baseRow;
            $row["iditem"] = $recargo->getCaIdrecargo();
            $row["idconcepto"] = 9999;
            $row["item"] = utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
            $row["tipo_app"] = $recargo->getCaTipo();
            $row["aplicacion"] = $recargo->getCaAplicacion();
            $row["neta_tar"] = $recargo->getCaNetaTar();
            $row["neta_min"] = $recargo->getCaNetaMin();
            $row["reportar_tar"] = $recargo->getCaReportarTar();
            $row["reportar_min"] = $recargo->getCaReportarMin();
            $row["cobrar_tar"] = $recargo->getCaCobrarTar();
            $row["cobrar_min"] = $recargo->getCaCobrarMin();
            $row["cobrar_idm"] = $recargo->getCaIdmoneda();
            $row["observaciones"] = $recargo->getCaDetalles();
            $row['tipo']="recargo";
            $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
            $conceptos[] = $row;
        }

        $row = $baseRow;
        $row['iditem']="";
        $row['item']="+";
        $row['tipo']="recargo";
        $row['orden']="Z";
        $conceptos[] = $row;

        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");

    }


    /*
    * Datos para el panel de recargos de aduana
    * @param sfRequest $request A request object
    */
    public function executePanelRecargosAduanaData(sfWebRequest $request){

        $reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
	    $this->forward404Unless( $reporte );

        $conceptos = array();

        $baseRow = array(
	 					 'idreporte'=>$reporte->getCaIdreporte()
						);



        $recargos = Doctrine::getTable("RepCosto")
                             ->createQuery("t")
                             //->innerJoin("t.Costo c")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             //->addWhere("t.ca_idconcepto = ?", 9999 )
                             //->addWhere("tr.ca_tipo = ?", Constantes::RECARGO_LOCAL )
                             ->execute();



        foreach( $recargos as $recargo ){
            $row = $baseRow;
            $row["iditem"] = $recargo->getCaIdcosto();
            $row["item"] = utf8_encode($recargo->getCosto()->getCaCosto());
            $row["tipo_app"] = $recargo->getCaTipo();
            $row["vlrcosto"] = $recargo->getCaVlrcosto();
            $row["mincosto"] = $recargo->getCaMincosto();
            $row["netcosto"] = $recargo->getCaNetcosto();
            $row["idmoneda"] = $recargo->getCaIdmoneda();
            $row["aplicacion"] = $recargo->getCaAplicacion();
            $row["aplicacionminimo"] = $recargo->getCaAplicacionminimo();

            $row["observaciones"] = $recargo->getCaDetalles();
            $row['tipo']="costo";
            $row['orden']="Y-".$recargo->getCosto()->getCaCosto();
            $conceptos[] = $row;
        }

        $row = $baseRow;
        $row['iditem']="";
        $row['item']="+";
        $row['tipo']="costo";
        $row['orden']="Z";
        $conceptos[] = $row;
        $this->responseArray=array("items"=>$conceptos, "total"=>count($conceptos), "success"=>true);
        $this->setTemplate("responseTemplate");
    }



    /*
    * Guarda para el panel de recargos de aduana
     *
    * @param sfRequest $request A request object
    */
    public function executeObservePanelRecargosAduana(sfWebRequest $request){
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>false);

        $tipo = $request->getParameter("tipo");

        if( $tipo=="costo" ){
            $idreporte = $request->getParameter("idreporte");
            $idcosto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepCosto")->find(array($idreporte, $idcosto ));
            if( !$tarifa ){
                $tarifa = new RepCosto();
                $tarifa->setCaIdreporte( $idreporte );
                $tarifa->setCaIdcosto( $idcosto );
            }

            if( $request->getParameter("tipo_app")!==null ){
                $tarifa->setCaTipo( $request->getParameter("tipo_app") );
            }

            if( $request->getParameter("vlrcosto")!==null ){
                $tarifa->setCaVlrcosto( $request->getParameter("vlrcosto") );
            }

            if( $request->getParameter("mincosto")!==null ){
                $tarifa->setCaMincosto( $request->getParameter("mincosto") );
            }

            if( $request->getParameter("netcosto")!==null ){
                $tarifa->setCaNetcosto( $request->getParameter("netcosto") );
            }



            if( $request->getParameter("idmoneda")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("idmoneda") );
            }

            if( $request->getParameter("observaciones")!==null ){

                if( $request->getParameter("observaciones") ){
                    $tarifa->setCaDetalles( $request->getParameter("observaciones") );
                }else{
                    $tarifa->setCaDetalles( null );
                }
            }

            if( $request->getParameter("parametro")!==null ){
                $tarifa->setCaParametro( $request->getParameter("parametro") );
            }

            if( $request->getParameter("aplicacion")!==null ){
                $tarifa->setCaAplicacion( $request->getParameter("aplicacion") );
            }

            if( $request->getParameter("aplicacionminimo")!==null ){
                $tarifa->setCaAplicacionminimo( $request->getParameter("aplicacionminimo") );
            }


            $tarifa->save();
            $this->responseArray["success"]=true;
        }

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarRecargosAduana(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");

        if( $tipo=="costo" ){
            $idreporte = $request->getParameter("idreporte");
            $idcosto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepCosto")->find(array($idreporte, $idcosto));

            if( $tarifa ){
                $tarifa->delete();
            }
        }

        $this->setTemplate("responseTemplate");

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>true);

    }








	/**
	* Genera un archivo PDF con el reporte de negocio
	* @author Andres Botero
	*/
	public function executeGenerarPDF( $request ){
        $this->opcion = $this->getRequestParameter("opcion");
		$this->forward404Unless( $request->getParameter("id") );
        $this->reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($this->reporte);
		$this->filename = $this->getrequestparameter("filename");
	}

	/*
	* Anula un reporte
	* @author: Andres Botero
	*/
	public function executeAnularReporte( $request ){
        $this->opcion = $this->getRequestParameter("opcion");
        $this->forward404Unless( $request->getParameter("id") );
        $this->forward404Unless( trim($request->getParameter("motivo")) );
		$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($reporte);

		$user = $this->getUser();
		$reporte->setCaUsuanulado( $user->getUserId() );
		$reporte->setCaFchanulado( date("Y-m-d H:i:s") );
        $reporte->setCaDetanulado( trim($request->getParameter("motivo")));
		$reporte->save();

        $this->responseArray = array("success"=>true);
        $this->setTemplate("responseTemplate");
	}

    /*
	* Revive un reporte anulado
	* @author: Andres Botero
	*/
	public function executeRevivirReporte( $request ){
        $this->opcion = $this->getRequestParameter("opcion");
        $this->forward404Unless( $request->getParameter("id") );
		$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
		$this->forward404Unless($reporte);

		$user = $this->getUser();
		$reporte->setCaUsuanulado( null );
		$reporte->setCaFchanulado( null );
        $reporte->setCaDetanulado( "Revivido por: ".$user->getUserId()." ".date("Y-m-d H:i:s") );
		$reporte->save();

        $this->redirect( "reportesNeg/verReporte?id=".$reporte->getCaIdreporte().($this->opcion?"&opcion=".$this->opcion:"") );
	}



	/*
	* Envia un reporte por correo
	*/
	public function executeEnviarReporteEmail(){
        $this->opcion = $this->getRequestParameter("opcion");
		$this->reporteNegocio =  Doctrine::getTable("Reporte")->find( $this->getRequestParameter("reporteId") );
		$fileName = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR."reporte".$this->getRequestParameter("reporteId").".pdf" ;
		if(file_exists($fileName)){
			@unlink( $fileName );
		}
		$this->getRequest()->setParameter('filename',$fileName);
		sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'generarPDF') ;
		$this->setLayout("ajax");


		$user = $this->getUser();

		//Crea el correo electronico
		$email = new Email();
		$email->setCaFchenvio( date("Y-m-d H:i:s") );
		$email->setCaUsuenvio( $user->getUserId() );
		$email->setCaTipo( "Env�o de reportes" );
		$email->setCaIdcaso( $this->getRequestParameter("reporteId") );
		$email->setCaFrom( $user->getEmail() );
		$email->setCaFromname( $user->getNombre() );

		if( $this->getRequestParameter("readreceipt") ){
			$email->setCaReadReceipt( $this->getRequestParameter("readreceipt") );
		}

		$email->setCaReplyto( $user->getEmail() );

		$recips = explode(",",$this->getRequestParameter("destinatario"));
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addTo( $recip );
				}
			}
		}

		$recips =  explode(",",$this->getRequestParameter("cc")) ;
		if( is_array($recips) ){
			foreach( $recips as $recip ){
				$recip = str_replace(" ", "", $recip );
				if( $recip ){
					$email->addCc( $recip );
				}
			}
		}

		$email->addCc( $this->getUser()->getEmail() );
		$email->setCaSubject( $this->getRequestParameter("asunto") );
		$email->setCaBody( $this->getRequestParameter("mensaje") );
		$email->addAttachment( $fileName );
		$email->save(); //guarda el cuerpo del mensaje
		$this->error = $email->send();
		if($this->error){
			$this->getRequest()->setError("mensaje", "no se ha enviado correctamente");
		}
		@unlink( $fileName );
	}


    /**
	* Envia una notificacion a los usuarios relacionados en el reporte
	* @author Andres Botero
	*/

    public function executeEnviarNotificacion( $request ){
        if( $request->getParameter( "idreporte" ) ){
			$reporte = Doctrine::getTable("Reporte")->find($request->getParameter( "idreporte" ));
		}

		$this->forward404Unless( $reporte );

        $grupos = array( );

        $usuarios  = $reporte->getUsuariosOperativos();

        if( $reporte->getCaImpoexpo()==Constantes::IMPO ||  $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){
            $grupos["operativo"] = array();
            foreach(  $usuarios as $usuario ){
                $grupos["operativo"][] = $usuario->getCaLogin();
            }
        }else{
            $grupos["exportaciones"] = array();
			foreach(  $usuarios as $usuario ){
				$grupos["exportaciones"][] = $usuario->getCaLogin();
			}
        }


        $grupos["vendedor"] = array( $reporte->getCaLogin() );


        if( $reporte->getCaColmas()=="S�" ){
			$repAduana = $reporte->getRepAduana();
			if( $repAduana && $repAduana->getCaCoordinador() ){
				$grupos["colmas"] = array($repAduana->getCaCoordinador());
			}
		}

		if( $reporte->getCaSeguro()=="S�" ){
			$repSeguro = $reporte->getRepSeguro();
			if( $repSeguro && $repSeguro->getCaSeguroConf() ){
				$grupos["seguros"] = array($repSeguro->getCaSeguroConf());
			}
		}

		if( $reporte->getCaContinuacion()!="N/A" ){

			if( $reporte->getCaContinuacionConf() ){
				$grupos["otm"] = array( $reporte->getCaContinuacionConf());
			}
		}

        //Crea la tarea para los usuarios seleccionados
        if ($request->isMethod('post')){
            $notificar = $request->getParameter("notificar");
            //Reporte al exterior
            if( $reporte->getCaIdtareaRext() ){
                $tarea = Doctrine::getTable("NotTarea")->find( $reporte->getCaIdtareaRext() );
                $tarea->delete();
            }

            if( $reporte->getCaImpoexpo()==Constantes::IMPO ||  $reporte->getCaImpoexpo()==Constantes::TRIANGULACION ){

                $tarea = new NotTarea();
                $tarea->setCaUrl( "reporteExt/crearReporte/idreporte/".$reporte->getCaIdreporte() );
                $tarea->setCaIdlistatarea( 4 );
                $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
                $festivos = TimeUtils::getFestivos();
                $tarea->setTiempo( TimeUtils::getFestivos(), 57600); // dos d�as habiles

                $tarea->setCaPrioridad( 1 );
                $tarea->setCaUsucreado( "Administrador" );

                $titulo = "Crear Reporte al Ext. RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";

                $tarea->setCaTitulo( $titulo );
                $tarea->setCaTexto( "Debe crear el reporte al exterior del reporte de negocio en referencia para cumplir esta tarea" );
                $tarea->save();

                if( isset($grupos["operativo"]) ){
                    $logins =  $grupos["operativo"];
                    $asignaciones = array();

                    foreach( $logins as $login ){
                        if( in_array($login, $notificar ) ){
                            $asignaciones[]=$login;
                        }
                    }
                    $tarea->setAsignaciones( $asignaciones );
                    $reporte->setCaIdtareaRext( $tarea->getCaIdtarea() );
                    $reporte->stopBlaming();
                    $reporte->save();
                }
            }
            //Ver reporte
            $asignacionesReporte = $reporte->getRepAsignacion();
            //Borra las tareas existentes
            foreach( $asignacionesReporte as $asignacion ){
                $asignacion->delete();
            }

            $tarea = new NotTarea();
            $tarea->setCaUrl( "/reportes/verReporte/id/".$reporte->getCaIdreporte() );
            $tarea->setCaIdlistatarea( 6 );
            $tarea->setCaFchcreado( date("Y-m-d H:i:s") );
            $tarea->setCaPrioridad( 1 );
            $festivos = TimeUtils::getFestivos();
            $tarea->setTiempo( TimeUtils::getFestivos(), 57600); // dos d�as habiles
            $tarea->setCaUsucreado( "Administrador" );
            $titulo = "Se ha creado el RN".$reporte->getCaConsecutivo()." [".$reporte->getCaModalidad()." ".$reporte->getOrigen()->getCaCiudad()."->".$reporte->getDestino()->getCaCiudad()."]";
            $tarea->setCaTitulo( $titulo );
            $tarea->setCaTexto( "Debe abrir el reporte haciendo click en el link para cumplir esta tarea" );

            foreach( $grupos as $key =>$logins ){
                if( $key=="operativo" ){
                    continue;
                }
                foreach( $logins as $login ){
                    if( in_array($login, $notificar ) ){
                        $newTarea = $tarea->copy();
                        $newTarea->save();
                        $newTarea->setAsignaciones( array($login) );
                        $asignaciones[] = $login;

                        $asignacion = new RepAsignacion();
                        $asignacion->setCaIdreporte( $reporte->getCaIdreporte() );
                        $asignacion->setCaIdtarea( $newTarea->getCaIdtarea() );
                        $asignacion->save();
                    }
                }
            }
            $this->asignaciones = $asignaciones;
            $this->setTemplate("enviarNotificacionResult");
        }

        $this->grupos = $grupos;
        $this->reporte = $reporte;
    }


	/**
	*
	* @author Andres Botero
	*/
    public function executeUnificarReporte( $request ){
        $this->forward404Unless( $request->getParameter( "id" ) );
		$reporte = Doctrine::getTable("Reporte")->find($request->getParameter( "id" ));
		$this->forward404Unless( $reporte );


        $consecutivo = $request->getParameter( "reporte" );

        if( $consecutivo ){
            $reporte2 = Doctrine::getTable("Reporte")->retrieveByConsecutivo($consecutivo);
            $this->forward404Unless( $reporte2 );
            //Mueve los status al nuevo reporte
            Doctrine::getTable("RepStatus")
                      ->createQuery("s")
                      ->update()
                      ->set("s.ca_idreporte", $reporte->getCaIdreporte())
                      ->where("s.ca_idreporte IN (SELECT r2.ca_idreporte FROM Reporte r2 WHERE r2.ca_consecutivo = ?)", $consecutivo)
                      ->execute();

            //Coloca el grupo a los reportes y los anula
            Doctrine::getTable("Reporte")
                      ->createQuery("r")
                      ->update()
                      ->set("ca_idgrupo", $reporte->getCaIdreporte())
                      ->set("ca_usuanulado", "'".$this->getuser()->getUserId()."'")
                      ->set("ca_fchanulado", "'".date("Y-m-d H:i:s")."'")
                      ->set("ca_detanulado", "'Unificado con el reporte ".$reporte->getCaConsecutivo()."'")
                      ->where("ca_consecutivo = ?", $consecutivo)
                      ->execute();


            $this->redirect("reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte());
        }

        $this->reporte = $reporte;
    }


    public function executeSeleccionModo()
	{
		$this->nivelAereo = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_AEREO );
		$this->nivelMaritimo = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_MARITIMO );
        $this->nivelAduana = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_ADUANA );
        $this->nivelExpo = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_EXPO );
	}

}

?>
