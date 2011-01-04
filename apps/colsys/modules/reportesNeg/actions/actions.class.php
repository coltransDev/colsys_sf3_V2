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
		/*if( !$this->modo){
			$this->forward( "reportesNeg", "seleccionModo" );
		}*/

		if( $this->modo==Constantes::AEREO  || utf8_decode($this->modo) == Constantes::AEREO ){
            $this->modo=Constantes::AEREO;
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_AEREO );
		}

		if( $this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO  ){
            $this->modo=Constantes::MARITIMO;
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_MARITIMO );
		}
		
        if( $this->modo==Constantes::EXPO || utf8_decode($this->modo)==Constantes::EXPO ){
            $this->modo=Constantes::EXPO;
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_EXPO );
		}

        if( $this->modo==Constantes::TRIANGULACION || utf8_decode($this->modo)==Constantes::TRIANGULACION ){
            $this->modo=Constantes::TRIANGULACION;
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA_AEREO );
		}

        if( $this->modo==Constantes::OTMDTA || utf8_decode($this->modo)==Constantes::OTMDTA ){
            $this->modo=Constantes::OTMDTA;
			$this->nivel = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );
		}

        $this->permiso = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );



/*		if( $this->nivel==-1 ){
			$this->forward404();
		}
 */
        return $this->nivel;
    }

    public function load_category()
    {
        $this->impoexpo=$this->getRequestParameter("impoexpo");

        if($this->impoexpo==Constantes::IMPO || utf8_decode($this->impoexpo)==Constantes::IMPO)
        {
            $this->impoexpo=Constantes::IMPO;
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO || utf8_decode($this->modo)==Constantes::AEREO)
            {
                $this->modo=Constantes::AEREO;
                $this->idcategory="31";
            }
            else if($this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO)
            {
                $this->modo=Constantes::MARITIMO;
                $this->idcategory="32";
            }
           
        }
        else if($this->impoexpo==Constantes::EXPO || utf8_decode($this->impoexpo)==Constantes::EXPO)
        {
            $this->impoexpo=Constantes::EXPO;
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO || utf8_decode($this->modo)==Constantes::AEREO)
            {
                $this->modo=Constantes::AEREO;
                $this->idcategory="34";
            }
            else if($this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO)
            {
                $this->modo=Constantes::MARITIMO;
                $this->idcategory="35";
            }
            else if($this->modo==Constantes::TRIANGULACION || utf8_decode($this->modo)==Constantes::TRIANGULACION)
            {
                $this->modo=Constantes::TRIANGULACION;
                $this->idcategory="35";
            }
        }
        else if($this->impoexpo==Constantes::TRIANGULACION || utf8_decode($this->impoexpo)==Constantes::TRIANGULACION)
        {
            $this->impoexpo=Constantes::TRIANGULACION;
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO || utf8_decode($this->modo)==Constantes::AEREO)
            {
                $this->modo=Constantes::AEREO;
                $this->idcategory="31";
            }
            else if($this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO)
            {
                $this->modo=Constantes::MARITIMO;
                $this->idcategory="32";
            }

        }
        else if($this->impoexpo==Constantes::OTMDTA || utf8_decode($this->impoexpo)==Constantes::OTMDTA)
        {
            $this->impoexpo=Constantes::OTMDTA;
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO || utf8_decode($this->modo)==Constantes::AEREO)
            {
                $this->modo=Constantes::AEREO;
                $this->idcategory="31";
            }
            else if($this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO)
            {
                $this->modo=Constantes::MARITIMO;
                $this->idcategory="32";
            }

        }
        else
        {
            $this->modo=$this->getRequestParameter("modo");
            if($this->modo==Constantes::AEREO || utf8_decode($this->modo)==Constantes::AEREO)
            {
                $this->modo=Constantes::AEREO;
                $this->idcategory="37";
            }
            else if($this->modo==Constantes::MARITIMO || utf8_decode($this->modo)==Constantes::MARITIMO)
            {
                $this->modo=Constantes::MARITIMO;
                $this->idcategory="38";
            }
            else if($this->modo==Constantes::TRIANGULACION || utf8_decode($this->modo)==Constantes::TRIANGULACION)
            {
                $this->modo=Constantes::TRIANGULACION;
                $this->idcategory="38";
            }
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

    public function executeIndexAg()
	{
        $this->permiso = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );
        $this->page=$this->getRequestParameter("page");
        if($this->permiso==-1)
            $this->forward404();
        $nregs=30;
        $con = Doctrine_Manager::getInstance()->connection();
		$sql="select * from vi_repconsulta  ";
        $sql1="select count(*) as nregs from vi_repconsulta  ";
        if($this->permiso<2)
        {
            $sql.="where ca_login='".$this->getUser()->getUserId()."'";
            $sql1.="where ca_login='".$this->getUser()->getUserId()."'";
        }

        $st1 = $con->execute($sql1);

        $count = $st1->fetch(PDO::FETCH_ASSOC);
        $this->pages=ceil($count["nregs"]/$nregs);
        //echo $this->count;

        if($this->page && $this->page>0)
        {
            $offset=($this->getRequestParameter("page")-1)*$nregs;
            $sql.="limit ".$nregs." offset ".$offset;
        }
        else
        {
            $this->page=1;
            $sql.="limit ".$nregs." offset 0";
        }


		$st = $con->execute($sql);
	//recuperamos las tuplas de resultados
		$this->reportesAg = $st->fetchAll();

/*        $q=Doctrine::getTable("Reporte")
                       ->createQuery("r")
                       ->distinct()
                       ->limit(200)
                       ->addOrderBy("r.ca_idreporte desc")
                       ->where("r.ca_incoterms is null or r.ca_incoterms=''");
        if($this->permiso<2)
            $q->addWhere("ca_login=?",$this->getUser()->getUserId());
        $this->reportesAg=$q->execute();
 * 
 */
        //echo count($this->reportesAg);
	}

    public function executeIndexOs()
	{
        $this->permiso = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );
        if($this->permiso==-1)
            $this->forward404();
	}


	/*
	* Muestra los resultados de la busqueda del reporte de negocios
	* @author Mauricio Quinche
	*/
	public function executeBusquedaReporte()
	{
        $this->opcion = $this->getRequestParameter("opcion");
        $this->modo = $this->getRequestParameter("modo");
        $this->impoexpo = $this->getRequestParameter("impoexpo");

        $opcion = $this->getRequestParameter("criterio");
        $criterio = trim($this->getRequestParameter("cadena"));
        $this->criterio = $this->getRequestParameter("criterio");
        $this->cadena = trim($this->getRequestParameter("cadena"));
        $this->idimpo =   $this->getRequestParameter("idimpo");

        $fechaInicial = $this->getRequestParameter("fechaInicial");
        $fechaFinal = $this->getRequestParameter("fechaFinal");


        $this->seguro = $this->getRequestParameter("seguro");
        $this->colmas = $this->getRequestParameter("colmas");

        $condicion="";
        if( $criterio ){
            if ($opcion == 'ca_consecutivo' or $opcion == 'ca_nombre_cli' or $opcion == 'ca_nombre_con' or $opcion == 'ca_nombre_pro' or $opcion == 'ca_orden_prov' or $opcion == 'ca_orden_clie' or $opcion == 'ca_idcotizacion' or $opcion == 'ca_login' or $opcion == 'ca_mercancia_desc' or $opcion == 'ca_traorigen' or $opcion == 'ca_ciuorigen') {
                $condicion= " and lower($opcion) like lower('%".$criterio."%')"; }
        }else {
            if ($opcion == 'ca_login') {
                $condicion= " and $opcion = '".$this->getUser()->getUserId()."'"; }
        }

        if($this->fechaInicial!="" && $this->fechaFinal!="")
        {
            $condicion.=" and ca_fchreporte between '".Utils::parseDate($this->fechaInicial)."' and '".Utils::parseDate($this->fechaFinal)."'";
        }

        if($this->seguro!="")
        {
            $condicion.=" and ca_seguro= '$this->seguro'";
        }

        if($this->colmas!="")
        {
            $condicion.=" and ca_colmas = '$this->colmas'";
        }


        if( ($this->idimpo && $criterio) || !$this->idimpo ){
            $con = Doctrine_Manager::getInstance()->connection();
                    $sql="select * from vi_reportes2 where 1=1 $condicion limit 80";

                    $st = $con->execute($sql);

                    $this->reportes = $st->fetchAll();
        }
        else
            $this->reportes=array();
    //        print_r($this->reportes[0]);
    //        exit;
	}

    /**
	* Permite consultar un reporte de negocio ya creado y permite
	* agregar nuevas
	* @author Mauricio Quinche
	*/
	public function executeConsultaReporte(){
        $this->opcion = $this->getRequestParameter("opcion");
		$reporte = Doctrine::getTable("Reporte")->find( $this->getRequestParameter("id") );
		$this->forward404Unless( $reporte );
        $this->load_category();

//        if( ($reporte->isNew() || $reporte->getCaVersion() == $reporte->getUltVersion()) &&!$reporte->existeReporteExteriorVersionActual() )

//        echo $reporte->getCaUsuanulado();
        if( $reporte->getCaUsuanulado() ){
            $this->redirect( "reportesNeg/verReporte?id=".$reporte->getCaIdreporte());
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
	* Permite ver una cotización en formato PDF
	*/
	public function executeVerReporte(){        
        $this->load_category();

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
        
        if($this->modo==Constantes::AEREO)
            $this->nomLinea="Aerolinea";
        else if($this->modo==Constantes::MARITIMO)
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

        //echo $this->editable;
        //No permite editar si el usuario no realizo el reporte
        if($this->permiso<2)
        {


            $user = $this->getUser();
            if( !$reporte->isNew() && ($user->getUserId()!=$reporte->getCaUsucreado() && $user->getUserId()!=$reporte->getCaLogin() ) ){
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
        }
        else
        {
            $this->editable = true;
            if( !$reporte->getCaIdreporte()){
                $this->editable = true;
                $this->nuevaVersion = false;
                $this->copiar = false;
            }else{
                $this->copiar = true;
            }
        }
        $this->reporte=$reporte;
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/RowExpander",'last');
		$response->addJavaScript("extExtras/CheckColumn",'last');
   }

   public function executeFormReporte1(sfWebRequest $request){

        $this->nivel = $this->getNivel();
        $this->impoexpo = $this->getRequestParameter("impoexpo");
        $this->load_category();

        if($this->modo==Constantes::AEREO)
            $this->nomLinea="Aerolinea";
        else if($this->modo==Constantes::MARITIMO)
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

        //echo $this->editable;
        //No permite editar si el usuario no realizo el reporte
        if($this->permiso<2)
        {


            $user = $this->getUser();
            if( !$reporte->isNew() && ($user->getUserId()!=$reporte->getCaUsucreado() && $user->getUserId()!=$reporte->getCaLogin() ) ){
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
        }
        else
        {
            $this->editable = true;
            if( !$reporte->getCaIdreporte()){
                $this->editable = true;
                $this->nuevaVersion = false;
                $this->copiar = false;
            }else{
                $this->copiar = true;
            }
        }
        $this->reporte=$reporte;
   }


    public function executeFormReporteAg(sfWebRequest $request){
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
        $this->nivel = $this->getNivel();
        $this->impoexpo = Constantes::IMPO;
        $this->load_category();
		$reporte = new Reporte();

        $this->reporte=$reporte;

        $this->dep=$this->getUser()->getIddepartamento();
        
        if( $this->getRequestParameter("id") ){
//                        echo $this->getRequestParameter("id");
			$this->reporte = Doctrine::getTable("Reporte")->findOneBy("ca_idreporte", $this->getRequestParameter("id")) ;
//                        print_r($reporte);
//                        exit;
			$this->forward404Unless( $reporte );
		}else{
			$this->reporte = new Reporte();
		}
       /* $this->pais2="todos";
        //echo $this->dep;
        if( $this->dep==14)
        {
            $this->modo=constantes::MARITIMO;
            $this->impoexpo=constantes::IMPO;
            $this->pais2="C0-057";
        }
        else if($this->dep==13 || $this->dep==18 )
        {
            $this->impoexpo=constantes::IMPO;
            $this->pais2="C0-057";           
        }
        else if($this->dep==3 )
        {
            $this->modo=constantes::AEREO;
            $this->impoexpo=constantes::IMPO;
        }
        else{
            $this->modo="";
            $this->impoexpo="";
        }*/
        //echo $this->pais2;
   }

    public function executeFormReporteOs(sfWebRequest $request){
//        $response = sfContext::getInstance()->getResponse();
//        $response->addJavaScript("extExtras/FileUploadField",'last');
        $this->nivel = $this->getNivel();
        $this->impoexpo = Constantes::IMPO;
        $this->load_category();


        if( $this->getRequestParameter("id") ){
                $reporte = Doctrine::getTable("Reporte")->findOneBy("ca_idreporte", $this->getRequestParameter("id")) ;
                $this->forward404Unless( $reporte );
        }else{
                $reporte = new Reporte();
        }

        $this->reporte=$reporte;

        $this->dep=$this->getUser()->getIddepartamento();
   }

    public function executeFormReporteAg1(sfWebRequest $request){
        $response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/FileUploadField",'last');
        $this->nivel = $this->getNivel();
        $this->impoexpo = Constantes::IMPO;
        $this->load_category();
		$reporte = new Reporte();

        $this->reporte=$reporte;        
    $this->dep=$this->getUser()->getIddepartamento();
        $this->pais2="todos";
        //echo $this->dep;
        if( $this->dep==14)
        {
            $this->modo=constantes::MARITIMO;
            $this->impoexpo=constantes::IMPO;
            $this->pais2="C0-057";
        }
        else if($this->dep==13 || $this->dep==18 )
        {
            $this->impoexpo=constantes::IMPO;
            $this->pais2="C0-057";
        }
        else if($this->dep==3 )
        {
            $this->modo=constantes::AEREO;
            $this->impoexpo=constantes::IMPO;
        }
        else{
            $this->modo="";
            $this->impoexpo="";
        }

   }

   /*
	* Valida y guarda el reporte
	* @author Mauricio Quinche
    * @param sfRequest $request A request object
    */
    public function executeCambioTransporte( sfWebRequest $request )
    {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";        
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );

        if($request->getParameter("transporte") )
        {
            $reporte->setCaTransporte(utf8_decode($request->getParameter("transporte")));
        }
        else
        {
            $errors["transporte"]="Debe seleccionar un transporte";
            $texto.="Transporte<br>";
        }

        $reporte->save();

        $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"redirect"=>"true","consecutivo"=>$reporte->getCaConsecutivo() );
        $this->setTemplate("responseTemplate");

    }

    public function executeGuardarReporte( sfWebRequest $request )
    {
    try
    {
        $this->permiso = $this->getUser()->getNivelAcceso( reportesNegActions::RUTINA );
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $tipo=$request->getParameter("tipo");
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $nuevo=true;
        if(!$reporte)
            $reporte = new Reporte();
        else
        {
             $reporte->setCaUsuactualizado($this->getUser()->getUserId());
             $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
            $nuevo=false;
        }

        $redirect=true;
        $opcion=$request->getParameter("opcion");
        $redirect=($request->getParameter("redirect")!="")?$request->getParameter("redirect"):"true";
        //$redirect=false;
        $errors =  array();
        $texto ="";
        switch( $opcion ){
            case 0:
                if( !$reporte->getCaIdreporte() ){
                    $reporte->setCaFchreporte( date("Y-m-d") );
                    $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                    $reporte->setCaVersion( 1 );                    
                }
                break;
            case 1:
                $reporte = $reporte->copiar(1);
                break;
            case 2:
                $reporte = $reporte->copiar(2);
                break;
        }
        $reporte->setCaTiporep( 1 );
//        echo $opcion;
/*        if( $opcion!=0 ) //Al copiar el reporte ya se coloco el usuario y la fecha
        {
            $reporte->stopBlaming();
        }*/
        //else
        if($tipo!="full")
        {
            if($request->getParameter("idcotizacion") )
            {
                $reporte->setCaIdcotizacion($request->getParameter("idcotizacion"));
            }
/*            else if($this->permiso<2)
            {
                $errors["cotizacion"]="Debe asignar un cotizacion";
                $texto.="Cotizacion<br>";
            }

*/
            else 
            {
                $reporte->setCaIdcotizacion(0);
            }


            if($request->getParameter("idcotizacionotm") )
            {
                $reporte->setCaIdcotizacionotm($request->getParameter("idcotizacionotm"));
            }
            else
            {
                $reporte->setCaIdcotizacionotm(0);
            }


            if($request->getParameter("idorigen") && $request->getParameter("idorigen")!="")
            {                
                $reporte->setCaOrigen($request->getParameter("idorigen"));
            }
            else
            {
                $errors["idorigen"]="Debe seleccionar un origen";
                $texto.="Origen<br>";
            }

            if($request->getParameter("iddestino") && $request->getParameter("iddestino")!="")
            {                
                $reporte->setCaDestino($request->getParameter("iddestino"));
            }
            else
            {
                $errors["iddestino"]="Debe seleccionar un destino";
                $texto.="Destino<br>";
            }

            if($request->getParameter("impoexpo"))
            {
                if($request->getParameter("impoexpo")==constantes::OTMDTA)
                    $reporte->setCaImpoexpo(constantes::OTMDTA1);
                else
                    $reporte->setCaImpoexpo(utf8_decode($request->getParameter("impoexpo")));
            }
            else
            {
                $errors["impoexpo"]="Debe seleccionar una clase";
                $texto.="Clase<br>";
            }

            if($request->getParameter("fchdespacho") )
            {
                $reporte->setCaFchdespacho(Utils::parseDate($request->getParameter("fchdespacho")));
            }else
            {
                $errors["fchdespacho"]="Debe seleccionar una fecha de despacho";
                $texto.="Fecha de despacho<br>";
            }


            if($request->getParameter("idconcliente") )
            {
                $reporte->setCaIdconcliente($request->getParameter("idconcliente"));

            }else
            {
                $errors["idconcliente"]="Debe seleccionar un cliente";
                $texto.="Cliente<br>";
            }

            if($request->getParameter("idclientefac") )
            {
                $reporte->setCaIdclientefac($request->getParameter("idclientefac"));
            }
            else
            {
                $reporte->setCaIdclientefac(null);
            }

            if($request->getParameter("idclienteag") )
            {
                $reporte->setCaIdclienteag($request->getParameter("idclienteag"));
            }
            else
            {
                $reporte->setCaIdclienteag(null);
            }

            if($request->getParameter("idclienteotro") )
            {
                $reporte->setCaIdclienteotro($request->getParameter("idclienteotro"));
            }
            else
            {
                $reporte->setCaIdclienteotro(null);
            }

            if($request->getParameter("idagente") && $request->getParameter("idagente")!="")
            {
                $reporte->setCaIdagente($request->getParameter("idagente"));
            }
            else if($request->getParameter("impoexpo")!=constantes::EXPO && utf8_decode($request->getParameter("impoexpo"))!=Constantes::EXPO)
            {
                $errors["idagente"]="Debe seleccionar un agente";
                $texto.="Agente<br>";
            }
            else{
                $reporte->setCaIdagente(null);
            }
            

            if($request->getParameter("ca_mercancia_desc") )
            {
                $reporte->setCaMercanciaDesc(utf8_decode($request->getParameter("ca_mercancia_desc")));
            }else
            {
                $errors["ca_mercancia_desc"]="Debe colocar un texto de descripcion de la mercacia";
                $texto.="Descripcion de Mercancia<br>";
            }
            
            $prov="";
            $incoterms="";
            $orden="";
            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("prov".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $prov.=($prov!="")?"|":"";
                    $prov.=$request->getParameter("prov".$i);
                }
            }

            if($prov!="" )
            {
                $reporte->setCaIdproveedor($prov);
            }
            else if($reporte->getCaImpoexpo()!= Constantes::EXPO)
            {
                $errors["proveedor0"]="Debe colocar un proveedor";
                $texto.="Proveedor<br>";
            }

            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("incoterms".$i)!="" && ($request->getParameter("prov".$i)!="" || $reporte->getCaImpoexpo() == Constantes::EXPO)  )
                {
                    $incoterms.=($incoterms!="")?"|":"";
                    $incoterms.=$request->getParameter("incoterms".$i);
                }
            }

            if($incoterms )
            {
                $reporte->setCaIncoterms($incoterms);
            }
            else if($reporte->getCaImpoexpo()!= Constantes::EXPO)
            {
                $errors["incoterms0"]="Debe colocar un incoterm";
                $texto.="Incoterms<br>";
            }

            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("orden_pro".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $orden.=($orden!="")?"|":"";
                    $orden.=utf8_decode($request->getParameter("orden_pro".$i));
                }
            }
            if($orden )
            {
                $reporte->setCaOrdenProv($orden);
            }
            else if($reporte->getCaImpoexpo()!= Constantes::EXPO)
            {
                $errors["orden_pro0"]="Debe colocar una orden de proveedor";
                $texto.="Orden de Proveedor<br>";
            }

            if($request->getParameter("orden_clie") )
            {
                $reporte->setCaOrdenClie(utf8_decode($request->getParameter("orden_clie")));
            }
            else
            {
                $errors["orden_clie"]="Debe colocar un texto de orden del cliente";
                $texto.="orden del cliente<br>";
            }
            $ca_confirmar_clie="";
            for($i=0;$i<20;$i++)
            {
                if($request->getParameter("chkcontacto_".$i)=="on")
                {
                    if(trim($request->getParameter("contacto_".$i))!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_".$i);
                    }
                }
                if($request->getParameter("chkcontacto_fijos".$i)=="on")
                {
                    if(trim($request->getParameter("contacto_fijos".$i))!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_fijos".$i);
                    }
                }
            }
            
            if($request->getParameter("ca_coordinador")!="")
            {                
                $coor=Doctrine::getTable("Usuario")->find( $request->getParameter("ca_coordinador") );
                if($coor)
                {
                    
                    if($ca_confirmar_clie!="")
                    {

                        if (stripos(strtolower($ca_confirmar_clie), $coor->getCaEmail()) === false)
                            $ca_confirmar_clie.=",".$coor->getCaEmail();
                    }
                    else
                        $ca_confirmar_clie=$coor->getCaEmail();
                }

            }


            if($ca_confirmar_clie!="" )
            {

                $reporte->setCaConfirmarClie($ca_confirmar_clie);
            }
            else
            {
                $errors["chkcontacto_0"]="Debe seleccionar almenos un contacto para informar";
                $errors["contacto_0"]="Debe seleccionar almeno un contacto para informar";
                $texto.="contacto de Informaciones<br>";
            }

            if($request->getParameter("idrepres") )
            {
                $reporte->setCaIdrepresentante($request->getParameter("idrepres"));
            }
            else
                $reporte->setCaIdrepresentante(null);

            if($request->getParameter("ca_informar_repr") )
            {
                $reporte->setCaInformarRepr( (($request->getParameter("ca_informar_repr")=="on")?"Sí":"No") );
            }

            if($request->getParameter("consig") )
            {
                $reporte->setCaIdconsignatario($request->getParameter("consig"));
                if($request->getParameter("continuacion")== "OTM")
                    $reporte->setCaIdconsignar(1);
            }
            else if($request->getParameter("continuacion")== "OTM")
            {
                $errors["idconsignatario"]="Cuando es OTM se debe ingresar un consignatario";
                $texto.="Consignatario<br>";
            }
            else
                $reporte->setCaIdconsignatario(null);
    //ca_informar_cons:
            if($request->getParameter("idnotify") )
            {
                $reporte->setCaIdnotify($request->getParameter("idnotify"));
                $reporte->setCaNotify("2");
                //
            }
            else
            {
                $reporte->setCaIdnotify(null);
                $reporte->setCaNotify("0");
            }
    //ca_informar_noti:
            if($request->getParameter("consigmaster") )
            {
                $reporte->setCaIdconsignarmaster($request->getParameter("consigmaster"));
            }
            else
            {
                $reporte->setCaIdconsignarmaster(null);
            }
    //ca_informar_mast:
			if($request->getParameter("ca_informar_mast") )
            {
                $reporte->setCaInformarMast($request->getParameter("ca_informar_mast"));
            }
    //ca_notify:
            if($request->getParameter("transporte") )
            {
                $reporte->setCaTransporte(utf8_decode($request->getParameter("transporte")));
                //$reporte->setCaTransporte($request->getParameter("transporte"));
            }
            else
            {
                $errors["transporte"]="Debe seleccionar un transporte";
                $texto.="Transporte<br>";
            }
            if($request->getParameter("idmodalidad") )
            {
                $reporte->setCaModalidad($request->getParameter("idmodalidad"));
            }
            else if($this->permiso<2 || $reporte->getCaVersion()>1)
            {
                $errors["idmodalidad"]="Debe seleccionar un tipo de envio";
                $texto.="Modalidad<br>";
            }
            else
            {
                $reporte->setCaModalidad(" ");
            }

            if($request->getParameter("seguros-checkbox") && $request->getParameter("seguros-checkbox")=="on"  )
            {
                $reporte->setCaSeguro("Sí");
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
            if($request->getParameter("ca_comodato") && $request->getParameter("ca_comodato")=="on"  )
            {
                $reporte->setCaComodato("Sí");
            }else
            {
                $reporte->setCaComodato("No");
            }

            if($request->getParameter("preferencias") )
            {
                $reporte->setCaPreferenciasClie(utf8_decode($request->getParameter("preferencias")));
            }else
                $reporte->setCaPreferenciasClie(null);

            if($request->getParameter("instrucciones") )
            {
                $reporte->setCaInstrucciones(utf8_decode($request->getParameter("instrucciones")));
            }else
            {
                $reporte->setCaInstrucciones(null);
            }

            if(($request->getParameter("idlinea") && $request->getParameter("idlinea")!="") || $request->getParameter("idlinea")=="0" )
            {                
                $reporte->setCaIdlinea($request->getParameter("idlinea"));
            }
            else
            {
                //if($reporte->getCaIdlinea()=="")
                    $reporte->setCaIdlinea(0);
//                $errors["linea"]="Debe seleccionar un linea";
            }

            if($request->getParameter("consignar") )
            {
                $reporte->setCaIdconsignar($request->getParameter("consignar"));
            }
            else
            {
                $reporte->setCaIdconsignar(1);
            }

            if($request->getParameter("idbodega_hd") )
            {
                $reporte->setCaIdbodega($request->getParameter("idbodega_hd"));
            }
            else
            {
                //if($reporte->getCaIdbodega()=="")                
                if(utf8_decode($request->getParameter("impoexpo"))==constantes::TRIANGULACION)
                    $reporte->setCaIdbodega(null);
                else
                    $reporte->setCaIdbodega(1);

            }
    //ca_mastersame:
            if($request->getParameter("continuacion")   )
            {
                $reporte->setCaContinuacion($request->getParameter("continuacion"));
            }
            else
            {
                $reporte->setCaContinuacion("N/A");
            }

            if($request->getParameter("continuacion_dest")   )
            {
                $reporte->setCaContinuacionDest($request->getParameter("continuacion_dest"));
            }
            else
            {
                $reporte->setCaContinuacionDest($request->getParameter("iddestino"));
            }

            if($request->getParameter("ca_continuacion_conf") && $reporte->getCaContinuacion()=="OTM" )
            {
                if($request->getParameter("ca_continuacion_conf")!="ninguno")
                    $reporte->setCaContinuacionConf(utf8_decode($request->getParameter("ca_continuacion_conf")));
                else
                    $reporte->setCaContinuacionConf(null);
            }
            else if($reporte->getCaContinuacion()=="OTM")
            {
                $errors["ca_continuacion_conf"]="Debe asignar un grupo de confirmaci&oacute;n ";
                $texto.="Confirmaci&oacute;n OTM<br>";
            }else
            {
                $reporte->setCaContinuacionConf(null);
            }

            if($request->getParameter("cont-origen") )
            {
                $reporte->setCaContOrigen($request->getParameter("cont-origen"));
            }
            else
            {
                $reporte->setCaContOrigen(null);
            }
            
            if($request->getParameter("cont-destino") )
            {
                $reporte->setCaContDestino($request->getParameter("cont-destino"));
            }
            else
            {
                $reporte->setCaContDestino(null);
            }

            if($request->getParameter("idvendedor") && $request->getParameter("idvendedor")!="")
            {
                $reporte->setCaLogin($request->getParameter("idvendedor"));
            }
            else
            {                
                $errors["vendedor"]="Debe asignar un vendedor ";
                $texto.="vendedor<br>";
            }

            if($request->getParameter("aduanas-checkbox") && $request->getParameter("aduanas-checkbox")=="on"  )
            {
                $reporte->setCaColmas("Sí");
            }
            else
            {
                $reporte->setCaColmas("No");
            }

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
        {
            $this->responseArray=array("success"=>false,"idreporte"=>$idreporte,"redirect"=>$redirect,"errors"=>$errors,"texto"=>$texto);
        }
        else
        {
            if($request->getParameter("idproducto") && $request->getParameter("idcotizacion")!="")
                $reporte->setCaIdproducto($request->getParameter("idproducto"));

            if($request->getParameter("idproductootm") && $request->getParameter("idcotizacionotm")!="")
                $reporte->setCaIdproductootm($request->getParameter("idproductootm"));


            $reporte->save();
            if($tipo!="full")
            {
                if($request->getParameter("idproducto"))
                {
                    $idproducto=$request->getParameter("idproducto");
                    $param=array();
                    $param["idproducto"]=$request->getParameter("idproducto");
                    $param["etapa"]="APR";
                    $param["seguimiento"]="";
                    $param["fchseguimiento"]="";
                    $param["user"]=$this->getUser()->getUserId();

                    $seg = Doctrine::getTable("CotSeguimiento")
                                             ->createQuery("s")                                             
                                             ->where("s.ca_idproducto = ? and s.ca_etapa=?", array($idproducto,'APR'))
                                             ->execute();
                    
                    if(count($seg)<=0)
                    {
                        $cotseguimientos = new CotSeguimiento();
                        $cotseguimientos->aprobarSeguimiento($param);
                    }
                }
                if($request->getParameter("idproductootm"))
                {
                    $idproductootm=$request->getParameter("idproductootm");
                    $param=array();
                    $param["idproducto"]=$request->getParameter("idproductootm");
                    $param["etapa"]="APR";
                    $param["seguimiento"]="";
                    $param["fchseguimiento"]="";
                    $param["user"]=$this->getUser()->getUserId();

                    $seg = Doctrine::getTable("CotSeguimiento")
                                             ->createQuery("s")
                                             ->where("s.ca_idproducto = ? and s.ca_etapa=?", array($idproductootm,'APR'))
                                             ->execute();

                    if(count($seg)<=0)
                    {
                        $cotseguimientos = new CotSeguimiento();
                        $cotseguimientos->aprobarSeguimiento($param);
                    }
                }
                if($request->getParameter("seguros-checkbox")== "on" )
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
                    }else
                    {
                        $repSeguro->setCaVlrasegurado(0);
                    }

                    if($request->getParameter("ca_idmoneda_vlr") )
                    {
                        $repSeguro->setCaIdmonedaVlr($request->getParameter("ca_idmoneda_vlr"));
                    }else
                    {
                        $repSeguro->setCaIdmonedaVlr(null);
                    }
                    if($request->getParameter("ca_obtencionpoliza") )
                    {
                        $repSeguro->setCaObtencionpoliza($request->getParameter("ca_obtencionpoliza"));
                    }
                    else
                    {
                        $repSeguro->setCaObtencionpoliza(0);
                    }

                    if($request->getParameter("ca_idmoneda_pol") )
                    {
                        $repSeguro->setCaIdmonedaPol($request->getParameter("ca_idmoneda_pol"));
                    }
                    else
                    {
                        $repSeguro->setCaIdmonedaPol(null);
                    }

                    if($request->getParameter("ca_primaventa") )
                    {
                        $repSeguro->setCaPrimaventa($request->getParameter("ca_primaventa"));
                    }
                    else
                    {
                        $repSeguro->setCaPrimaventa(0);
                    }

                    if($request->getParameter("ca_minimaventa") )
                    {
                        $repSeguro->setCaMinimaventa($request->getParameter("ca_minimaventa"));
                    }
                    else
                    {
                        $repSeguro->setCaMinimaventa(0);
                    }

                    if($request->getParameter("ca_idmoneda_vta") )
                    {
                        $repSeguro->setCaIdmonedaVta($request->getParameter("ca_idmoneda_vta"));
                    }
                    else
                    {
                        $repSeguro->setCaIdmonedaVta(null);
                    }
                    $repSeguro->save();
                }
                if($request->getParameter("aduanas-checkbox")== "on" )
                {
                    $repAduana = Doctrine::getTable("RepAduana")->findOneBy("ca_idreporte", $reporte->getCaIdreporte() );
                    if(!$repAduana)
                        $repAduana= new RepAduana();

                    $repAduana->setCaIdreporte($reporte->getCaIdreporte());

                    if($request->getParameter("ca_instrucciones") )
                    {
                        $repAduana->setCaInstrucciones(utf8_decode($request->getParameter("ca_instrucciones")));
                    }
                    else
                    {
                        $repAduana->setCaInstrucciones("");
                    }

                    if($request->getParameter("ca_coordinador") )
                    {
                        $repAduana->setCaCoordinador($request->getParameter("ca_coordinador"));
                    }
                    else
                    {
                        $repAduana->setCaCoordinador(null);
                    }
                    $repAduana->save();
                }

                if($reporte->getCaImpoexpo()== Constantes::EXPO || utf8_decode($reporte->getCaImpoexpo()) == Constantes::EXPO)
                {
                    $repExpo = Doctrine::getTable("RepExpo")->findOneBy("ca_idreporte", $reporte->getCaIdreporte() );
                    if(!$repExpo)
                        $repExpo= new RepExpo();

                    //$repExpo= new RepExpo();
                    $repExpo->setCaIdreporte($reporte->getCaIdreporte());
                    if($request->getParameter("npiezas") && $request->getParameter("mpiezas") )
                    {
                        $repExpo->setCaPiezas($request->getParameter("npiezas")."|".$request->getParameter("mpiezas"));
                    }
                    else
                        $repExpo->setCaPiezas(null);

                    if($request->getParameter("npeso") && $request->getParameter("mpeso") )
                    {
                        $repExpo->setCaPeso($request->getParameter("npeso")."|".$request->getParameter("mpeso"));
                    }
                    else
                        $repExpo->setCaPeso(null);

                    if($request->getParameter("nvolumen") && $request->getParameter("mvolumen") )
                    {
                        $repExpo->setCaVolumen($request->getParameter("nvolumen")."|".$request->getParameter("mvolumen"));
                    }
                    else
                        $repExpo->setCaVolumen(null);

                    if($request->getParameter("dimensiones") )
                    {
                        $repExpo->setCaDimensiones($request->getParameter("dimensiones"));
                    }
                    else
                        $repExpo->setCaDimensiones(null);

                    if($request->getParameter("valor_carga") )
                    {
                        $repExpo->setCaValorcarga($request->getParameter("valor_carga"));
                    }
                    else
                        $repExpo->setCaValorcarga(null);

                    if($request->getParameter("idsia") )
                    {
                        $repExpo->setCaIdsia($request->getParameter("idsia"));
                    }
                    else
                        $repExpo->setCaIdsia(null);

                    if($request->getParameter("idtipoexpo") )
                    {
                        $repExpo->setCaTipoexpo($request->getParameter("idtipoexpo"));
                    }
                    else
                        $repExpo->setCaTipoexpo(null);

                    if($request->getParameter("motonave") )
                    {
                        $repExpo->setCaMotonave($request->getParameter("motonave"));
                    }
                    else
                        $repExpo->setCaMotonave(null);

                    if($request->getParameter("idemisionbl") )
                    {
                        $repExpo->setCaEmisionbl($request->getParameter("idemisionbl"));
                    }
                    else
                        $repExpo->setCaEmisionbl(null);

                    if($request->getParameter("ca_numbl") )
                    {
                        $repExpo->setCaNumbl($request->getParameter("ca_numbl"));
                    }
                    else
                    {
                        $repExpo->setCaNumbl(null);
                    }

                    $repExpo->save();

                }
            }
            $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"redirect"=>$redirect,"consecutivo"=>$reporte->getCaConsecutivo() );
        }
    }
    catch(Exception $e)
    {
        //print_r($e);
        $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
    }

    $this->setTemplate("responseTemplate");
        //cuando se seleccion una cotizacion se debe marcar el campo aprobado, etapa='APR';
    }

    public function executeGuardarReporteAg( sfWebRequest $request )
    {
    try
    {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";        
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );        
        if(!$reporte)
            $reporte = new Reporte();

        $opcion=$request->getParameter("opcion");
        

        $errors =  array();
        $texto ="";
        if( $opcion =="1" ){            
            $reporte = $reporte->copiar(1);
        }


        $errors =  array();
        $email_send=$request->getParameter("email_send");



        $reporte->setCaFchreporte( date("Y-m-d") );
        $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
        $reporte->setCaVersion( 1 );
        $reporte->setCaTiporep( 2 );

        $reporte->setCaIdconsignar(1);
        $reporte->setCaIdbodega(1);
        $reporte->setCaIdconsignarmaster(0);
        $reporte->setCaIdlinea(0);

        $reporte->setCaContinuacion("N/A");

        $reporte->setCaContinuacionDest($request->getParameter("iddestino"));
        $texto="";
        if($request->getParameter("fchdespacho") )
        {
            $reporte->setCaFchdespacho(Utils::parseDate($request->getParameter("fchdespacho")));
        }else
        {
            $errors["fchdespacho"]="Debe seleccionar una fecha de despacho";
            $texto.="Fecha de Despacho <br>";
        }

        if($request->getParameter("idorigen") && $request->getParameter("idorigen")!="")
        {
            $reporte->setCaOrigen($request->getParameter("idorigen"));
        }
        else
        {
            $errors["idorigen"]="Debe seleccionar un origen";
            $texto.="Origen <br>";
        }

        if($request->getParameter("iddestino") && $request->getParameter("iddestino")!="")
        {
            $reporte->setCaDestino($request->getParameter("iddestino"));
        }
        else
        {
            $errors["iddestino"]="Debe seleccionar un destino";
            $texto.="Destino <br>";
        }

        if($request->getParameter("impoexpo"))
        {
            $reporte->setCaImpoexpo(($request->getParameter("impoexpo")));
        }
        else
        {
            $errors["impoexpo"]="Debe seleccionar una clase";
            $texto.="Clase <br>";
        }

        if($request->getParameter("idconcliente") )
        {
            $reporte->setCaIdconcliente($request->getParameter("idconcliente"));

        }else
        {
            $errors["idconcliente"]="Debe seleccionar un cliente";
            $texto.="Cliente <br>";
        }

        if($request->getParameter("idagente") && $request->getParameter("idagente")!="")
        {
            $reporte->setCaIdagente($request->getParameter("idagente"));
        }
        else
        {
            $errors["idagente"]="Debe seleccionar un agente";
            $texto.="Agente <br>";
        }

        if($request->getParameter("idmodalidad") )
        {
            $reporte->setCaModalidad($request->getParameter("idmodalidad"));
        }
        else
        {
            $errors["modalidad"]="Debe seleccionar una modalidad";
            $texto.="Modalidad <br>";
        }

/*        if($request->getParameter("incoterms") )
        {
            $reporte->setCaIncoterms($request->getParameter("incoterms"));

        }
 *
 */
        if($request->getParameter("ca_mercancia_desc")  )
        {
            $reporte->setCaMercanciaDesc($request->getParameter("ca_mercancia_desc"));
        }else
        {
            $errors["ca_mercancia_desc"]="Debe colocar un texto de descripcion de la mercancia";
            $texto.="Desripcion de Mercacia <br>";
        }


    //ca_orden_prov:  No aplica
/*            if($request->getParameter("idconcliente") )
        {
            $reporte->setCaIdconcliente($request->getParameter("idconcliente"));
        }
*/
        if($request->getParameter("orden_clie") )
        {
            $reporte->setCaOrdenClie(utf8_decode($request->getParameter("orden_clie")));
        }
        else
        {
            $errors["orden_clie"]="Debe colocar un un numero de orden del cliente";
            $texto.="Orden de cliente <br>";
        }

/*        if($request->getParameter("prov") )
        {
            $reporte->setCaIdproveedor($request->getParameter("prov"));
        }else
        {
            $errors["proveedor"]="Debe seleecionar un proveedor";

        }
*/

        $prov="";
        $incoterms="";
        $orden="";
        for($i=0;$i<10;$i++)
        {
            if($request->getParameter("prov".$i) && $request->getParameter("prov".$i)!=""  )
            {
                $prov.=($prov!="")?"|":"";
                $prov.=$request->getParameter("prov".$i);
            }
        }

        if($prov!="" )
        {
            $reporte->setCaIdproveedor($prov);
        }
        else
        {
            $errors["proveedor0"]="Debe colocar un proveedor";
            $texto.="Proveedor <br>";
        }

        for($i=0;$i<10;$i++)
        {
            if($request->getParameter("incoterms".$i) && $request->getParameter("prov".$i)!="" )
            {
                $incoterms.=($incoterms!="")?"|":"";
                $incoterms.=$request->getParameter("incoterms".$i);
            }
        }
        if($incoterms )
        {
            $reporte->setCaIncoterms($incoterms);
        }

        for($i=0;$i<10;$i++)
        {
            if($request->getParameter("orden_pro".$i) && $request->getParameter("prov".$i)!=""  )
            {
                $orden.=($orden!="")?"|":"";
                $orden.=$request->getParameter("orden_pro".$i);
            }
        }
        if($orden )
        {
            $reporte->setCaOrdenProv($orden);
        }
        $ca_confirmar_clie="";
        $cc="";
        for($i=0;$i<20;$i++)
        {
            if($request->getParameter("chkcontacto_".$i)=="on")
            {
                if(trim($request->getParameter("contacto_".$i))!="")
                {
                    $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                    $ca_confirmar_clie.=$request->getParameter("contacto_".$i);
                }

                if (stripos(strtolower($request->getParameter("contacto_".$i)), '@coltrans.com.co') !== false)
                {
                    $cc.=($cc!="")?",":"";
                    $cc.= $request->getParameter("contacto_".$i);
                }
            }
        }

        if($ca_confirmar_clie!="" )
        {
            $reporte->setCaConfirmarClie($ca_confirmar_clie);
        }
        else
        {
            $errors["contacto_0"]="Debe seleccionar un contacto";
            $texto.="Constacto de informaciones <br>";
        }

        if($request->getParameter("consig") )
        {
            $reporte->setCaIdconsignatario($request->getParameter("consig"));
        }

        if($request->getParameter("notify") )
        {
            $reporte->setCaIdnotify($request->getParameter("notify"));
            $reporte->setCaNotify("2");
        }

        if($request->getParameter("consigmaster") )
        {
            $reporte->setCaIdmaster($request->getParameter("consigmaster"));
        }

        if($request->getParameter("transporte") )
        {
            //echo utf8_decode($request->getParameter("transporte"));
            $reporte->setCaTransporte($request->getParameter("transporte"));
        }
        else
        {
            $errors["transporte"]="Debe seleccionar un agente";
            $texto.="Transporte <br>";
        }

        if($request->getParameter("ca_liberacion") )
        {
            $reporte->setCaLiberacion(($request->getParameter("ca_liberacion")));
        }
        if($request->getParameter("ca_tiempocredito") )
        {
            $reporte->setCaTiempocredito($request->getParameter("ca_tiempocredito"));
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


        if($request->getParameter("idvendedor") && $request->getParameter("idvendedor")!="")
        {
            $reporte->setCaLogin($request->getParameter("idvendedor"));
        }
        else
        {
            $errors["vendedor"]="Debe asignar un vendedor ";
            $texto.="vendedor<br>";
        }

        if($request->getParameter("ca_mcia_peligrosa") && $request->getParameter("ca_mcia_peligrosa")=="on"  )
        {
            $reporte->setCaMciaPeligrosa(true);
        }
        else
        {
            $reporte->setCaMciaPeligrosa(false);
        }


        if(count($errors)>0)
            $this->responseArray=array("success"=>false,"redirect"=>false,"errors"=>$errors,"texto"=>$texto);
        else
        {
            $reporte->save();

            $mail = new Email();
            $asunto=$request->getParameter("asunto")." - ".$reporte->getCaConsecutivo();
             if( isset( $_FILES["archivo"] )){
                $archivo = $_FILES["archivo"];

                $directorio = $mail->getDirectorio();

                if( !is_dir($directorio) ){
                    mkdir($directorio, 0777, true);
                }
                $adjunto=$directorio.DIRECTORY_SEPARATOR."Rep".$reporte->getCaIdreporte()."-".$archivo["name"];
                move_uploaded_file( $archivo["tmp_name"], $adjunto);

                $mail->setCaAttachment("Attachements/Rep".$reporte->getCaIdreporte()."-".$archivo["name"]);
            }
           

            $mail->setCaSubject($asunto);
            $mail->setCaIdcaso($reporte->getCaIdreporte());
            $mail->setCaTipo("Reporte Negocios AG");

            $ids=$reporte->getIdsAgente()->getIds();
            $agente=$ids->getCaNombre();
            $trayecto=$reporte->getOrigen()->getTrafico()->getCaNombre()."-".$reporte->getOrigen()->getCaCiudad()."&raquo;".$reporte->getDestino()->getTrafico()->getCaNombre()."-".$reporte->getDestino()->getCaCiudad();
            $proveedor="";
            if( $reporte->getCaIdproveedor() ){
                $values = explode("|", $reporte->getCaIdproveedor());
                $values1 = explode("|", $reporte->getCaIncoterms());
                $values2 = explode("|", $reporte->getCaOrdenProv());

                for($i=0;$i<count($values);$i++)
                {
                    $tercero = Doctrine::getTable("Tercero")->find($values[$i]);
                    if($tercero)
                    {
                        $proveedor .=Utils::replace($tercero->getCaNombre())." - ". $values1[$i]." - ". $values2[$i]."<br>";
                    }
                }
            }

            $html='<html>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<body>
    <style type="text/css" >

img.img{
    border: 0px;
}
span{
    font-size: 12px;
    font-family: Arial;
    color: #000000;
}
a.link:link {
   text-decoration:none;
   color:#0000FF;
}
a.link:active {
   text-decoration:none;
   color:#0000FF;
}
a.link:visited {
   text-decoration: none;
   color: #062A7D;
}
.entry {
    border-bottom: 1px solid #DDDDDD;
    clear:both;
    padding: 0 0 10px;
}
.entry-even {
    background-color:#F6F6F6;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;
}
.entry-odd {
    background-color:#FFFFFF;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;
}
span{
font-size: 12px;
font-family: arial, helvetica, sans-serif;
color="#000000";
}
.entry-yellow {
    background-color:#FFFFCC;
    border-color:#CCCCCC;
    border-style:dotted;
    border-width:1px ;
    margin:12px 0 0;
    padding:12px 12px 24px;
    font-size: 12px;
    font-family: arial, helvetica, sans-serif;
}
.entry-date{
    float: right;
    color: #0464BB;
}
</style>
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                    <!-- WHITE BACKGROUND -->
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                                <!-- MAIN CONTENT TABLE -->

                                <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                    <!-- LOGO -->
                                    <tr><td colspan="3"><table><tr><td width="135"><img src="https://www.coltrans.com.co/images/logo_colsys.gif" width="178" height="30" alt="COLSYS"></td>
                                                    <td><font size="4" face="arial, helvetica, sans-serif" color="#D99324"></font></td></tr></table></td></tr>
                                    <tr><td width="25"><img src="https://www.coltrans.com.co/images/spacer.gif" width="25" height="1" alt=""></td><td colspan="2"><hr noshade size="1"></td></tr>
                                    <!-- INTRO -->
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td >
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>No:'.$reporte->getCaConsecutivo().'</b></font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Agente:</b>'.$agente.'</font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Trayecto:</b>'.$trayecto.'</font><br />
                                                <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Proveedor:</b>'.$proveedor.'</font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Cliente:</b>'.$reporte->getContacto()->getCliente()->getCaCompania().' - '.$request->getParameter("orden_clie").'</font><br />
                                            <font size="2" face="arial, helvetica, sans-serif" color="#000000"><b>Mercancia:</b>'.$reporte->getCaMercanciaDesc().'</font><br />
                                         </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td ><font size="2" face="arial, helvetica, sans-serif" color="#000000">'.$request->getParameter("mensaje_comercial").'</font></td>
                                    </tr>
                                    <tr><td colspan="2"><hr noshade size="1"></td></tr>
                                    <tr><td>&nbsp;</td><td>
                                            <font size="1" face="arial, helvetica, sans-serif" color="#000000"> Si los links no estan funcionando, copie y pegue esta dirección en el navegador:<br>https://www.coltrans.com.co/pm/verTicket?id=2935 <br><br> Gracias por utilizar el sistema de tickets!<br><br>Coltrans S.A. - Colmas Ltda. Agencia de Aduanas Nivel 1<br>
                                                <a href="https://www.coltrans.com.co/">http://www.coltrans.com.co/</a>
                                            </font>
                                        </td>

                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666">&copy; Coltrans S.A. Colmas Ltda. Agencia de Aduanas Nivel 1</font></td></tr>

        </table>
        </body>
</html>
';
            $mail->setCaBodyhtml($html);

            if($email_send=="" || !$email_send)
            {
                $email_send=$this->getUser()->getEmail();
            }
            $mail->setCaFromname($this->getUser()->getNombre());
            $mail->setCaUsuenvio($this->getUser()->getUserId());
            $mail->setCaFrom($email_send);
            $mail->setCaReplyto($email_send);
            $mail->setCaAddress($cc);
            $mail->setCaCc($email_send.",".$reporte->getUsuario()->getCaEmail().",".$cc);
            $mail->save();

            $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"consecutivo"=>$reporte->getCaConsecutivo(),"transporte"=>utf8_encode($request->getParameter("transporte")),"impoexpo"=>utf8_encode($request->getParameter("impoexpo")));
        }
    }
    catch(Exception $e)
    {
        $this->responseArray=array("success"=>false,"err"=>utf8_encode($e->getMessage()));
    }
        
        $this->setTemplate("responseTemplate");
        //cuando se seleccion una cotizacion se debe marcar el campo aprobado, etapa='APR';
    }



    public function executeGuardarReporteOs( sfWebRequest $request )
    {
        try
        {
            $errors =  array();

            $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
            $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
            if(!$reporte)
                $reporte = new Reporte();
            else
            {
                 $reporte->setCaUsuactualizado($this->getUser()->getUserId());
                 $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
            }

            $redirect=true;
            $opcion=$request->getParameter("opcion");
            $redirect=($request->getParameter("redirect")!="")?$request->getParameter("redirect"):"true";

            $errors =  array();
            $texto ="";
            switch( $opcion ){
                case 0:
                    if( !$reporte->getCaIdreporte() ){
                        $reporte->setCaFchreporte( date("Y-m-d") );
                        $reporte->setCaConsecutivo( ReporteTable::siguienteConsecutivo(date("Y")) );
                        $reporte->setCaVersion( 1 );
                    }
                    break;
                case 1:
                    $reporte = $reporte->copiar(1);
                    break;
                case 2:
                    $reporte = $reporte->copiar(2);
                    break;
            }

            $reporte->setCaTiporep( 3 );

            if($request->getParameter("fchdespacho") )
            {
                $reporte->setCaFchdespacho(Utils::parseDate($request->getParameter("fchdespacho")));
            }else
            {
                $errors["fchdespacho"]="Debe seleccionar una fecha de despacho";
            }

            if($request->getParameter("impoexpo"))
            {
                $reporte->setCaImpoexpo(utf8_decode($request->getParameter("impoexpo")));
            }
            else
            {
                $errors["impoexpo"]="Debe alguna opcion de este campo";
            }

            if($request->getParameter("idconcliente") )
            {
                $reporte->setCaIdconcliente($request->getParameter("idconcliente"));

            }else
            {
                $errors["idconcliente"]="Debe seleccionar un cliente";
            }


            if($request->getParameter("ca_mercancia_desc")  )
            {
                $reporte->setCaMercanciaDesc(utf8_decode($request->getParameter("ca_mercancia_desc")));
            }else
            {
                $errors["ca_mercancia_desc"]="Debe colocar un texto de descripcion de la mercancia";
            }

            if($request->getParameter("orden_clie") )
            {
                $reporte->setCaOrdenClie(utf8_decode($request->getParameter("orden_clie")));
            }
            else
            {
                $errors["orden_clie"]="Debe colocar un un numero de orden del cliente";
            }

            if($request->getParameter("preferencias") )
            {
                $reporte->setCaPreferenciasClie(utf8_decode($request->getParameter("preferencias")));
            }else
                $reporte->setCaPreferenciasClie(null);

            if($request->getParameter("instrucciones") )
            {
                $reporte->setCaInstrucciones(utf8_decode($request->getParameter("instrucciones")));
            }else
            {
                $reporte->setCaInstrucciones(null);
            }

            $prov="";
            $incoterms="";
            $orden="";
            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("prov".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $prov.=($prov!="")?"|":"";
                    $prov.=$request->getParameter("prov".$i);
                }
            }

            if($prov!="" )
            {
                $reporte->setCaIdproveedor($prov);
            }
            else
                $reporte->setCaIdproveedor(null);
           

            for($i=0;$i<10;$i++)
            {
                if($request->getParameter("orden_pro".$i) && $request->getParameter("prov".$i)!=""  )
                {
                    $orden.=($orden!="")?"|":"";
                    $orden.=$request->getParameter("orden_pro".$i);
                }
            }
            if($orden )
            {
                $reporte->setCaOrdenProv($orden);
            }
            else
                $reporte->setCaIdproveedor(null);

            $ca_confirmar_clie="";
            $cc="";
            for($i=0;$i<20;$i++)
            {
                if($request->getParameter("chkcontacto_".$i)=="on")
                {
                    if($request->getParameter("contacto_".$i)!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_".$i);
                    }
                }
                if($request->getParameter("chkcontacto_fijos".$i)=="on")
                {
                    if($request->getParameter("contacto_fijos".$i)!="")
                    {
                        $ca_confirmar_clie.=($ca_confirmar_clie!="")?",":"";
                        $ca_confirmar_clie.=$request->getParameter("contacto_fijos".$i);
                    }
                }
            }

            if($ca_confirmar_clie!="" )
            {
                $reporte->setCaConfirmarClie($ca_confirmar_clie);
            }
            else
            {
                $errors["contacto_0"]="Debe seleccionar un contacto";
            }

            if($request->getParameter("transporte") )
            {
                $reporte->setCaTransporte(utf8_decode($request->getParameter("transporte")));
            }
            else
            {
                $errors["transporte"]="Debe seleccionar un agente";
            }

            if($request->getParameter("ca_liberacion") )
            {
                $reporte->setCaLiberacion(utf8_decode($request->getParameter("ca_liberacion")));
            }
            if($request->getParameter("ca_tiempocredito") )
            {
                $reporte->setCaTiempocredito($request->getParameter("ca_tiempocredito"));
            }

            if($request->getParameter("idvendedor") && $request->getParameter("idvendedor")!="")
            {
                $reporte->setCaLogin($request->getParameter("idvendedor"));
            }
            else
            {
                $errors["vendedor"]="Debe asignar un vendedor ";
                $texto.="vendedor<br>";
            }

            if($request->getParameter("ca_mcia_peligrosa") && $request->getParameter("ca_mcia_peligrosa")=="on"  )
            {
                $reporte->setCaMciaPeligrosa(true);
            }
            else
            {
                $reporte->setCaMciaPeligrosa(false);
            }

            if(count($errors)>0)
                $this->responseArray=array("success"=>false,"redirect"=>false,"errors"=>$errors);
            else
            {
                $reporte->save();
                $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"consecutivo"=>$reporte->getCaConsecutivo(),"redirect"=>$redirect);
            }
        }
        catch(Exception $e)
        {
            $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeImportarReporte( sfWebRequest $request )
    {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $idreportenew=($request->getParameter("idreportenew")!="")?$request->getParameter("idreportenew"):"0";
        $reporte = new Reporte();
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $reportenew = Doctrine::getTable("Reporte")->find( $idreportenew );
        if($reporte && $reportenew)
        {
            if($reporte->importar($reportenew))
                $this->responseArray=array("success"=>true,"idreporte"=>$idreporte,"impoexpo"=>utf8_encode($reportenew->getCaImpoexpo()),"transporte"=>utf8_encode($reportenew->getCaTransporte()));
            else
                $this->responseArray=array("success"=>false);
        }
        else
            $this->responseArray=array("success"=>false);

        $this->setTemplate("responseTemplate");

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
                $bindValues["ca_colmas"]="Sí";//($request->getParameter("aduanas-checkbox") && $request->getParameter("aduanas-checkbox")=="on" )?"Sí":"No";
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
/*            if( $bindValues["ca_colmas"]=="Sí" ){
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

            if( $bindValues["ca_seguro"]=="Sí" ){
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

                if( $bindValues["ca_comodato"]=="Sí" ){
                    $reporte->setCaComodato( "Sí" );

                }else{
                    $reporte->setCaComodato( "No" );
                }

                if( $bindValues["ca_colmas"]=="Sí" ){
                    $reporte->setCaColmas( "Sí" );

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
                            $reporte->setCaLiberacion( "Sí" );
                        }else{
                            $reporte->setCaLiberacion( "No" );
                        }
                        $reporte->setCaTiempocredito( $libCliente->getCaDiascredito()." Días" );
                    }
                }

                if( $opcion!=1 ){ //Al copiar el reporte ya se coloco el usuario y la fecha
                    $reporte->stopBlaming();
                }
                $reporte->save();
                $repaduana = Doctrine::getTable("RepAduana")->find( $reporte->getCaIdreporte() );
                if( $bindValues["ca_colmas"]=="Sí" ){
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
                if( $bindValues["ca_seguro"]=="Sí"  ){
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
            
            $data["cotizacion"]=$reporte->getCaIdcotizacion();
            $data["cotizacionotm"]=$reporte->getCaIdcotizacionotm();
            $data["continuacion"]=$reporte->getCaContinuacion();
            $data["continuacion_dest"]=$reporte->getCaContinuacionDest();
            if(!$reporte->getCaContinuacionConf())
                    $reporte->setCaContinuacionConf("ninguno");
            $data["ca_continuacion_conf_".utf8_encode($reporte->getCaContinuacionConf())]= utf8_encode( $reporte->getCaContinuacionConf() );

            $data["cont-origen"]=$reporte->getCaContOrigen();
            $data["cont-destino"]=$reporte->getCaContDestino();

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
            $data["cliente"]=utf8_encode($reporte->getContacto()->getCliente()->getCaCompania());

            $data["idconcliente"]=$reporte->getCaIdconcliente();
            $data["contacto"]=utf8_encode($reporte->getContacto()->getCaNombres(). " ".$reporte->getContacto()->getCaPapellido()." ".$reporte->getContacto()->getCaSapellido());

            $data["orden_clie"]=utf8_encode($reporte->getCaOrdenClie());

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
                $data["clienteag"]=$clienteAg->getCaCompania();
                $data["idclienteag"]=$clienteAg->getCaIdcliente();
            }
            else
            {
                $data["clienteag"]="";
                $data["idclienteag"]="";
            }

            $clienteOtro = $reporte->getClienteOtro();
            if($clienteOtro)
            {
                $data["clienteotro"]=$clienteOtro->getCaCompania();
                $data["idclienteotro"]=$clienteOtro->getCaIdcliente();
            }
            else
            {
                $data["clienteotro"]="";
                $data["idclienteotro"]="";
            }

            $cliente=$reporte->getContacto()->getCliente();

            $data["ca_liberacion"] =($cliente->getLibCliente()->getCaDiascredito()>0)?"Si":"No";
            $data["ca_tiempocredito"] =$cliente->getLibCliente()->getCaDiascredito();
            $data["preferencias"] =utf8_encode(($reporte->getCaPreferenciasClie()!="")?($reporte->getCaPreferenciasClie()):$cliente->getCaPreferencias());

            $data["ca_comodato"] =($reporte->getCaComodato()=="Sí" || $reporte->getCaComodato()=="on" )?true:false;
            if( $reporte->getCaIdproveedor() ){
                $values = explode("|", $reporte->getCaIdproveedor());
                for($i=0;$i<count($values);$i++)
                {
                    $tercero = Doctrine::getTable("Tercero")->find($values[$i]);
                    if($tercero)
                    {
                        $data["idproveedor".$i]=$values[$i];
                        $data["proveedor".$i] =Utils::replace($tercero->getCaNombre());
                    }
                }
            }

            if( $reporte->getCaIncoterms() ){
                $values = explode("|", $reporte->getCaIncoterms() );
                for($i=0;$i<count($values);$i++)
                {
                    $data["incoterms".$i]=$values[$i];
                }
            }

            if( $reporte->getCaOrdenProv() ){
                $values = explode("|", $reporte->getCaOrdenProv() );
                for($i=0;$i<count($values);$i++)
                {
                    $data["orden_pro".$i]=$values[$i];
                }
            }

            
            if( $reporte->getCaConfirmarClie() ){
                $values = explode(",", $reporte->getCaConfirmarClie() );
                $f=0;
                $c=0;
                if(count($values)>0)
                {
                    for($i=0;$i<count($values) ;$i++)
                    {
                        if($values[$i]!="")
                        {
                            $cfijo = Doctrine::getTable("Contacto")
                                    ->createQuery("c")
                                    ->select("c.ca_fijo")
                                    ->where("c.ca_email=? and c.ca_idcliente=? and c.ca_fijo=true", array($values[$i],$cliente->getCaIdcliente()))
                                    ->execute();

                            if(count($cfijo)>0)
                            {
                                $data["contacto_fijos".$f] =utf8_encode($values[$i]);
                                $data["chkcontacto_fijos".$f] =true;
                                $f++;
                            }else{
                                $data["contacto_".$c] =utf8_encode($values[$i]);
                                $data["chkcontacto_".$c] =true;
                                $c++;
                            }
                        }
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
            $data["ca_coordinador"]=utf8_encode($repaduana->getCaCoordinador());
            $data["ca_instrucciones"]=utf8_encode($repaduana->getCaInstrucciones());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$this->repseguro ){
                $this->repseguro = new RepSeguro();
            }
            $data["ca_seguro"]=utf8_encode($reporte->getCaSeguro());

            $repseguro = Doctrine::getTable("RepSeguro")->find( $reporte->getCaIdreporte());
            if( !$repseguro ){
                $repseguro = new RepSeguro();
            }
            $data["notificar"]=$repseguro->getCaSeguroConf();
            $data["ca_vlrasegurado"]=$repseguro->getCaVlrasegurado();
            $data["ca_idmoneda_vlr"]=$repseguro->getCaIdmonedaVlr();
            $data["ca_obtencionpoliza"]=Utils::formatNumber($repseguro->getCaObtencionpoliza(), 3);
            $data["ca_idmoneda_pol"]=$repseguro->getCaIdmonedaPol();
            $data["ca_primaventa"]=Utils::formatNumber($repseguro->getCaPrimaventa(), 3);
            $data["ca_minimaventa"]=Utils::formatNumber($repseguro->getCaMinimaventa(), 3);
            $data["ca_idmoneda_vta"]=$repseguro->getCaIdmonedaVta();


            $data["idconsignarmaster"]=$reporte->getCaIdconsignarmaster();
            $data["consignarmaster"]=utf8_encode($reporte->getConsignarmaster());
            $data["tipobodega"]=utf8_encode($reporte->getBodega()->getCaTipo());
            $data["idbodega_hd"]=$reporte->getCaIdbodega();
            $data["bodega_consignar"]=utf8_encode($reporte->getBodega()->getCaNombre());

            if($reporte->getCaIdconsignatario())
            {
                $data["idconsignatario"]=$reporte->getCaIdconsignatario();
                if($reporte->getCaIdconsignatario()=="1")
                {
                    $data["consignatario"]="Cliente/Consignatario";

                }
                else if($reporte->getCaIdconsignatario()=="2")
                {
                    $data["consignatario"]="Coltrans/Consignatario";
                }
                else
                    $data["consignatario"] =utf8_encode($reporte->getConsignatario()->getCaNombre());
            }
            else
            {
                $data["idconsignatario"]="";
                $data["consignatario"] ="";
            }

             if($reporte->getCaTiporep()>0)
                $idM=$reporte->getCaIdconsignarmaster();
            else
                $idM=$reporte->getCaIdmaster();

            $data["idconsigmaster"]=$idM;
            $data["consigmaster"]=utf8_encode($reporte->getConsignarmaster());
                        

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
            $data["representante"]=$reporte->getRepresentante();

            $repExpo=$reporte->getRepExpo();

            if($repExpo)
            {
				if($request->getParameter("motonave") )
				{
					$repExpo->setCaMotonave($request->getParameter("motonave"));
				}
                $tmp=explode("|",$repExpo->getCaPiezas());
                if(count($tmp)==2)
                {
                    $data["npiezas"]=$tmp[0];
                    $data["mpiezas"]=$tmp[1];
                }
                $tmp=explode("|",$repExpo->getCaPeso());
                if(count($tmp)==2)
                {
                    $data["npeso"]=$tmp[0];
                    $data["mpeso"]=$tmp[1];
                }
                $tmp=explode("|",$repExpo->getCaVolumen());
                if(count($tmp)==2)
                {
                    $data["nvolumen"]=$tmp[0];
                    $data["mvolumen"]=($tmp[1]);
                }
                $data["dimensiones"]=$repExpo->getCaDimensiones();
                $data["valor_carga"]=$repExpo->getCaValorcarga();
                $data["sia"]=$repExpo->getCaIdsia();
                $data["idtipoexpo"]=$repExpo->getCaTipoexpo();
                $data["tipoexpo"]=utf8_encode($repExpo->getTipoExpo());
                $data["motonave"]=utf8_encode($repExpo->getCaMotonave());

                $data["emisionbl"]=$repExpo->getCaEmisionbl();
                $data["ca_numbl"]=$repExpo->getCaNumbl();
//                $data[""]=$repExpo->getCa();
            }
            if($reporte->getCaTiporep()=="2")
                $data["asunto"]="Nuevo Reporte AG ".$data["proveedor0"]." / ".$data["cliente"];

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
        $tipo=($this->getRequestParameter("tipo"))?$this->getRequestParameter("tipo"):"1";

        $conceptos = array();

        $baseRow = array('idreporte'=>$reporte->getCaIdreporte());

        $tarifas = Doctrine::getTable("RepTarifa")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ? and t.ca_idconcepto!=9999 and t.ca_tipo=? ", array($reporte->getCaIdreporte(),$tipo))
                             ->orderBy("t.ca_fchcreado ASC")
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
            $row["observaciones"] = utf8_encode($tarifa->getCaObservaciones());
            $row['tipo']="concepto";
            $row['orden']=$tarifa->getCaIdconcepto();
            $conceptos[] = $row;

            $recargos = Doctrine::getTable("RepGasto")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ?", $reporte->getCaIdreporte())
                             ->addWhere("t.ca_idconcepto = ?", $tarifa->getCaIdconcepto() )
                             ->addWhere("t.ca_recargoorigen = true")
                             ->orderBy("t.ca_fchcreado ASC")
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
                            ->addWhere("t.ca_recargoorigen = true " )                            
                            ->orderBy("t.ca_fchcreado ASC")
                             ->execute();
        if($tipo=="1")
        {
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
                    $row["observaciones"] = utf8_encode($recargo->getCaDetalles());
                    $row['tipo']="recargo";
                    $row['orden']="Y-".utf8_encode($recargo->getTipoRecargo()->getCaRecargo());
                    $conceptos[] = $row;
                }
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
        $idreporte = $request->getParameter("idreporte");

        $tipo = $request->getParameter("tipo");

        if( $tipo=="concepto" ){
            $idconcepto = $request->getParameter("iditem");
            if($idconcepto!='9999')
            {                
//                $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));
                $tarifa = Doctrine::getTable("RepTarifa")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ? and t.ca_idconcepto=? ", array($idreporte,$idconcepto))
                             ->fetchOne();
                             //->execute();

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
                else
                {
                    $tarifa->setCaReportarTar( "0" );
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

                        $tarifa->setCaObservaciones( utf8_decode($request->getParameter("observaciones")) );
                }
                $tarifa->save();
            }
            $this->responseArray["success"]=true;
        }


        if( $tipo=="recargo" ){
            $idconcepto = $request->getParameter("idconcepto");
            $idrecargo = $request->getParameter("iditem");
            $idequipo=($request->getParameter("idequipo"))?$request->getParameter("idequipo"):"0";
            $tarifa = Doctrine::getTable("RepGasto")->find(array($idreporte, $idconcepto, $idrecargo,$idequipo ));
            if( !$tarifa ){
                $tarifa = new RepGasto();
                $tarifa->setCaIdreporte( $idreporte );
                //if($idconcepto==0 || $idconcepto=="0" || $idconcepto!="")
//                    $idconcepto="9999";
                
                $tarifa->setCaIdconcepto( $idconcepto );
                $tarifa->setCaIdrecargo( $idrecargo );
                
            }
            $tarifa->setCaIdequipo( $idequipo );

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
                $tarifa->setCaNetaMin( 0 );
            }


            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }else{
                $tarifa->setCaReportarTar( 0 );
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }else{
                $tarifa->setCaReportarMin( 0 ); 
            }

            if( $request->getParameter("reportar_tar")!==null ){
                $tarifa->setCaReportarTar( $request->getParameter("reportar_tar") );
            }else{
                $tarifa->setCaReportarTar( 0 );
            }

            if( $request->getParameter("reportar_min")!==null ){
                $tarifa->setCaReportarMin( $request->getParameter("reportar_min") );
            }else{
                $tarifa->setCaReportarMin( 0 );
            }


            if( $request->getParameter("reportar_idm")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("reportar_idm") );
            }


            if( $request->getParameter("cobrar_tar")!==null ){
                $tarifa->setCaCobrarTar( $request->getParameter("cobrar_tar") );
            }else{
                if(!$tarifa->getCaCobrarTar())
                    $tarifa->setCaCobrarTar( 0 );
            }

            if( $request->getParameter("cobrar_min")!==null ){
                $tarifa->setCaCobrarMin( $request->getParameter("cobrar_min") );
            }else{
                if($tarifa->getCaCobrarMin()=="")
                    $tarifa->setCaCobrarMin( 0 ); 
            }

            if( $request->getParameter("cobrar_idm")!==null ){
                $tarifa->setCaIdmoneda( $request->getParameter("cobrar_idm") );
            }

            if( $request->getParameter("observaciones")!==null ){
                //if( $request->getParameter("observaciones") ){
                    $tarifa->setCaDetalles( $request->getParameter("observaciones") );
                //}else{
                //    $tarifa->setCaDetalles( null );
                //}
            }

          
            if( $request->getParameter("ca_recargoorigen")!==null ){
                $tarifa->setCaRecargoorigen( $request->getParameter("ca_recargoorigen") );
            }

            

            $tarifa->save();

            $this->responseArray["success"]=true;
        }       
        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $reporte->setCaUsuactualizado($this->getUser()->getUserId());
        $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
        $reporte->save();

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarPanelConceptosFletes(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");
        $idreporte = $request->getParameter("idreporte");
        $success=true;
        if($tipo=="All-conceptos")
        {
            Doctrine_Query::create()
                   ->delete()
                   ->from("RepGasto g")
                   ->where("g.ca_idreporte = ? and ca_recargoorigen=true ", array($idreporte))
                   ->execute();

            Doctrine_Query::create()
                   ->delete()
                   ->from("RepTarifa t")
                   ->where("t.ca_idreporte = ? ", array($idreporte))
                   ->execute();

        }
        else if($tipo=="All-recargos")
        {
            Doctrine_Query::create()
                   ->delete()
                   ->from("RepGasto g")
                   ->where("g.ca_idreporte = ? and ca_recargoorigen=false and ca_idrecargo!=61 ", array($idreporte))
                   ->execute();


        }
        else if($tipo=="All-recargos-otm")
        {
            Doctrine_Query::create()
                   ->delete()
                   ->from("RepGasto g")
                   ->where("g.ca_idreporte = ? and ca_recargoorigen=false and ca_idrecargo=61 ", array($idreporte))
                   ->execute();


        }
        else
        {
            $idconcepto = $request->getParameter("idconcepto");

            if( $tipo=="concepto" ){
//                $tarifa = Doctrine::getTable("RepTarifa")->find(array($idreporte, $idconcepto));
                $tarifa = Doctrine::getTable("RepTarifa")
                             ->createQuery("t")
                             ->where("t.ca_idreporte = ? and t.ca_idconcepto=? ", array($idreporte,$idconcepto))
                             ->fetchOne();

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
                    $success=true;
    //                $tarifa->execute();
                }else
                    $success=false;
            }

            if( $tipo=="recargo" ){
                $idrecargo = $request->getParameter("idrecargo");

                $tarifas = Doctrine_Query::create()
                                    ->select("g.*")
                                    ->from("RepGasto g")
                                    ->where("(g.ca_idreporte = ? AND g.ca_idconcepto = ? AND ca_idrecargo = ?) or (g.ca_idreporte = ? AND g.ca_idconcepto = ? AND ca_idrecargo = ?)", array($idreporte, $idrecargo, $idrecargo,$idreporte, $idconcepto, $idrecargo))
                                    ->execute();

                foreach( $tarifas as $tarifa ){
                    $tarifa->delete();
                }
            }
        }

        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $reporte->setCaUsuactualizado($this->getUser()->getUserId());
        $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
        $reporte->save();


        $this->setTemplate("responseTemplate");
        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>$success);
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

        if($this->getRequestParameter("tipo")=="2")
        {
            $recargos = $reporte->getRecargos ( constantes::OTMDTA );

            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = $recargo->getCaIdconcepto();
                $row["item"] = ($recargo->getConcepto())?utf8_encode($recargo->getConcepto()->getCaConcepto()):"";
                $row["idequipo"] = $recargo->getCaIdequipo();
                $row["equipo"] = ($recargo->getEquipo())?utf8_encode($recargo->getEquipo()->getCaConcepto()):"";
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
                $row["cobrar_idm"] = $recargo->getCaIdequipo();
                $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
        }
        else
        {
            $recargos = $reporte->getRecargos ( "local" );

            foreach( $recargos as $recargo ){
                $row = $baseRow;
                $row["iditem"] = $recargo->getCaIdrecargo();
                $row["idconcepto"] = $recargo->getCaIdconcepto();
                $row["idequipo"] = $recargo->getCaIdequipo();
                $row["equipo"] = utf8_encode($recargo->getEquipo()->getCaConcepto());
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
                $row["cobrar_idm"] = $recargo->getCaIdequipo();
                $row['orden']="Y-".$recargo->getTipoRecargo()->getCaRecargo();
                $conceptos[] = $row;
            }
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
                             ->orderBy("t.ca_fchcreado ASC")
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
        $idreporte = $request->getParameter("idreporte");
        $tipo = $request->getParameter("tipo");

        if( $tipo=="costo" ){
            
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
            else
                $tarifa->setCaIdmoneda( "COP" );

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

        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $reporte->setCaUsuactualizado($this->getUser()->getUserId());
        $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
        $reporte->save();

        $this->setTemplate("responseTemplate");
    }


    /*
    * Datos para el panel de conceptos
    * @param sfRequest $request A request object
    */
    public function executeEliminarRecargosAduana(sfWebRequest $request){

        $tipo = $request->getParameter("tipo");
        $idreporte = $request->getParameter("idreporte");

        if( $tipo=="costo" ){
           
            $idcosto = $request->getParameter("iditem");
            $tarifa = Doctrine::getTable("RepCosto")->find(array($idreporte, $idcosto));

            if( $tarifa ){
                $tarifa->delete();
            }
        }

        $reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $reporte->setCaUsuactualizado($this->getUser()->getUserId());
        $reporte->setCaFchactualizado(date('Y-m-d H:i:s'));
        $reporte->save();

        $this->setTemplate("responseTemplate");

        $id = $request->getParameter("id");
        $this->responseArray=array("id"=>$id,  "success"=>true);

    }


	/**
	* Genera un archivo PDF con el reporte de negocio
	* @author Mauricio Quinche
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
	* @author: Mauricio Quinche
	*/
	public function executeAnularReporte( $request ){        
        $id=$request->getParameter("id") ;
        $consecutivo=$request->getParameter("consecutivo") ;

        $this->forward404Unless( trim($request->getParameter("motivo")) );

        if($id)
        {
            $reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("id") );
            $this->forward404Unless($reporte);

            $user = $this->getUser();
            $reporte->setCaUsuanulado( $user->getUserId() );
            $reporte->setCaFchanulado( date("Y-m-d H:i:s") );
            $reporte->setCaDetanulado( trim($request->getParameter("motivo")));
            $reporte->save();
        }
        else if($consecutivo)
        {
            Doctrine::getTable("Reporte")
                  ->createQuery("r")
                  ->update()
                  ->set("r.ca_fchanulado","'". date('Y-m-d H:i:s')."'")
                  ->set("r.ca_usuanulado","'". $this->getUser()->getUserId()."'")
                  ->set("r.ca_detanulado","'". trim(utf8_decode($request->getParameter("motivo")))."'")
                  ->where("r.ca_consecutivo =?", $consecutivo)
                  ->execute();
        }
        $this->responseArray = array("success"=>true);
        $this->setTemplate("responseTemplate");
	}

    /*
	* Revive un reporte anulado
	* @author: Mauricio Quinche
	*/
	public function executeRevivirReporte( $request ){
		$reporte = Doctrine::getTable("Reporte")->find( $request->getParameter("idreporte") );
		$this->forward404Unless($reporte);

		$user = $this->getUser();
		$reporte->setCaUsuanulado( null );
		$reporte->setCaFchanulado( null );
        $reporte->setCaDetanulado( "Revivido por: ".$user->getUserId()." ".date("Y-m-d H:i:s") );
		$reporte->save();

        $this->responseArray=array("success"=>true,"idreporte"=>$reporte->getCaIdreporte(),"impoexpo"=>utf8_encode($reporte->getCaImpoexpo()),"transporte"=>utf8_encode($reporte->getCaTransporte()));
        $this->setTemplate("responseTemplate");
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
		$email->setCaTipo( "Envío de reportes" );
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
	* @author Mauricio Quinche
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


        if( $reporte->getCaColmas()=="Sí" ){
			$repAduana = $reporte->getRepAduana();
			if( $repAduana && $repAduana->getCaCoordinador() ){
				$grupos["colmas"] = array($repAduana->getCaCoordinador());
			}
		}

		if( $reporte->getCaSeguro()=="Sí" ){
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
                $tarea->setTiempo( TimeUtils::getFestivos(), 57600); // dos días habiles

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
            $tarea->setTiempo( TimeUtils::getFestivos(), 57600); // dos días habiles
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
	* @author Mauricio Quinche
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
            $tmp="";
            if($reporte->getCaIdproveedor()!="")
            {
                $tmp=$reporte->getCaIdproveedor()."|";
            }

            $reporte->setCaIdproveedor($tmp.$reporte2->getCaIdproveedor());

            $tmp="";
            if($reporte->getCaIncoterms()!="")
                $tmp=$reporte->getCaIncoterms()."|";
            $reporte->setCaIncoterms($tmp.$reporte2->getCaIncoterms());

            $tmp="";
            if($reporte->getCaOrdenProv()!="")
                $tmp=$reporte->getCaOrdenProv()."|";
            $reporte->setCaOrdenProv($tmp.$reporte2->getCaOrdenProv());

            $tmp="";
            if($reporte->getCaOrdenClie()!="")
                $tmp=$reporte->getCaOrdenClie()."-";
            $reporte->setCaOrdenClie($tmp.$reporte2->getCaOrdenClie());

            $tmp="";
            if($reporte->getCaMercanciaDesc()!="")
                $tmp=$reporte->getCaMercanciaDesc()."--";
            $reporte->setCaMercanciaDesc($tmp.$reporte2->getCaMercanciaDesc());

            $reporte->save();

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

    public function executeDatosListReportes()
    {
        $data = array();

        for ($i = 1; $i <= 10; $i++) {
            $data[] = array(
                'id' => $i,
                'message' => 'Raw data number ' . $i
            );
        }

        //$o = array('data' => $data);
        $this->responseArray=array("success"=>true,"data"=>$data);
        $this->setTemplate("responseTemplate");

    }

    public function executeCerrarReporte( $request ){
        try
        {
            $this->forward404Unless( $request->getParameter( "id" ) );
            $reporte = Doctrine::getTable("Reporte")->find($request->getParameter( "id" ));

            if($request->getParameter( "tipo" )=="1")
            {
                Doctrine::getTable("Reporte")
                      ->createQuery("r")
                      ->update()
                      ->set("r.ca_fchcerrado","'". date('Y-m-d H:i:s')."'")
                      ->set("r.ca_usucerrado","'". $this->getUser()->getUserId()."'")
                      ->where("r.ca_consecutivo =?", $reporte->getCaConsecutivo())
                      ->execute();
            }
            else if($request->getParameter( "tipo" )=="2")
            {
                Doctrine::getTable("Reporte")
                      ->createQuery("r")
                      ->update()
                      ->set("r.ca_fchcerrado",'NULL')
                      ->set("r.ca_usucerrado",'NULL')
                      ->where("r.ca_consecutivo =?", $reporte->getCaConsecutivo())
                      ->execute();
            }            
            $this->responseArray=array("success"=>true);
        }
        catch(Exception $e)
        {
            $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeHelp( $request ){

    $idhelp=$request->getParameter( "idhelp" );
    $issue = Doctrine::getTable("KBIssue")->find($idhelp);
            $info="";
            if($issue)
                echo ($issue->getCaInfo());
            exit;
        $this->setTemplate("responseTemplate");
    }

}

?>
