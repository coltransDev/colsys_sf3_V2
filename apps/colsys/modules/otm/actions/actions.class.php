<?php

/**
 * otm actions.
 *
 * @package    symfony
 * @subpackage otm
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class otmActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward('default', 'module');
    }
  
    public function executeListaAprobacion(sfWebRequest $request)
    {
        
        $this->fechaInicial=$request->getParameter("fechaInicial");
        $this->fechaFinal=$request->getParameter("fechaFinal");        
        //$this->transporte=$request->getParameter("transporte");        
        $this->modalidad=$request->getParameter("modalidad");
        
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");

        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");

        $this->etapa=$request->getParameter("etapa");
        $this->idetapa=$request->getParameter("idetapa");
        
        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");

        $where1= "";
        $where2= "";
        
        $this->opcion=$request->getParameter("opcion");
		
        
        if($this->opcion)
        {
            $where=$where1=$where2="";
            if($this->modalidad!="")
            {
                if($this->modalidad=="LCL")
                {
                    $where= " and r.ca_modalidad in ('{$this->modalidad}' , 'COLOADING')";
                }
                else
                {
                    $where= " and r.ca_modalidad='{$this->modalidad}'";
                }
            }

            if($this->idetapa!="")
            {
                //$where.= " and r.ca_idreporte in (select ca_idreporte from tb_repstatus s where s.ca_idreporte=r.ca_idreporte and s.ca_idetapa='{$this->idetapa}')";
                $where.= " and r.ca_idetapa='{$this->idetapa}' ";
            }

            if($this->noreporte!="")
            {
                $where.= " and r.ca_consecutivo like '".$this->noreporte."%'";
            }

            if($this->noreferencia!="")
            {
                $where1.= " and m.ca_referencia like '".$this->noreferencia."%'";
                $where2.= " and 1=2 ";
            }

            if($this->idorigen!="")
            {
                $where1.=" and r.ca_destino='{$this->idorigen}'";
                $where2.=" and r.ca_origen='{$this->idorigen}'";
            }

            if($this->iddestino!="")
            {
                $where1.=" and r.ca_continuacion_dest='{$this->iddestino}'";
                $where2.=" and r.ca_destino='{$this->iddestino}'";
            }

            if($this->fechaInicial!="")
            {
                $where1.=" and m.ca_fcharribo>='{$this->fechaInicial}'";
                $where2.=" and o.ca_fcharribo>='{$this->fechaInicial}'";
            }

            if($this->fechaFinal!="")
            {
                $where1.=" and m.ca_fcharribo<='{$this->fechaFinal}'";
                $where2.=" and o.ca_fcharribo<='{$this->fechaFinal}'";
            }
            $where.="and ca_version=( SELECT max(rr.ca_version) AS max
            FROM tb_reportes rr
            WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";

            $fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad";
            $fecha="2012-04-01";
            $sql="select {$fields},cl.ca_compania, cl.ca_idalterno,m.ca_referencia,m.ca_muelle,dp.ca_nombre as ca_bodega,m.ca_fcharribo
                from tb_reportes r
                left join tb_repotm o on r.ca_idreporte=o.ca_idreporte         
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text             
                ,
                tb_inoclientes_sea c, tb_inomaestra_sea  m
                left join tb_diandepositos dp on m.ca_muelle=dp.ca_codigo
                where c.ca_idreporte=r.ca_idreporte and  c.ca_referencia=m.ca_referencia and ca_fchmuisca is not null
                and (r.ca_impoexpo='OTM/DTA' or r.ca_continuacion='OTM')  and r.ca_fchcreado >='{$fecha}' ";
                if($this->idetapa=="" && $this->noreporte=="" && $this->noreferencia=="")
                {    
                    $sql.=" and ( (o.ca_dtm is null or o.ca_dtm is null) or (o.ca_dtm = false or o.ca_dtm = false) )  ";
                }

                $sql.=" $where $where1
                order by o.ca_fcharribo desc , 3";
            //echo $sql;
            //$con = Doctrine_Manager::getInstance()->connection();
            $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
            $st = $con->execute($sql);
            $rep_coltrans = $st->fetchAll();

            $sql="select {$fields},COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_muelle,dp.ca_nombre as ca_bodega,o.ca_fcharribo,i.ca_nombre as ca_importador
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                    left join tb_terceros i on o.ca_idimportador=i.ca_idtercero
                    left join tb_diandepositos dp on o.ca_muelle=dp.ca_codigo 
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' ";
                if($this->idetapa=="" && $this->noreporte=="" && $this->noreferencia=="")
                {    
                    $sql.=" and ( (o.ca_dtm = false or o.ca_dtm is null) or (o.ca_dtm = false or o.ca_dtm is null) ) ";
                }
            $sql.="$where $where2
                    order by o.ca_fcharribo desc, 3 ";
                    //echo $sql;

            $st = $con->execute($sql);
            $rep_colotm = $st->fetchAll();
            $this->reportes = array_merge($rep_coltrans,$rep_colotm);
        }

        $etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")                      
                      ->addWhere("t.ca_departamento = ?", constantes::OTMDTA1)                      
                      ->orderBy("ca_orden")
                      ->execute();
        $this->etapas=array();
        foreach($etapas as $e)
        {
            $this->etapas[]=array("id"=>$e->getCaIdetapa(),"nombre"=>($e->getCaEtapa()),"impoexpo"=>($e->getCaImpoexpo()),"departamento"=>($e->getCaDepartamento()),"transporte"=>($e->getCaTransporte()));
        }
	}

    public function executeEtapasCarga(sfWebRequest $request)
    {
        $this->fechaInicial=$request->getParameter("fechaInicial");
        $this->fechaFinal=$request->getParameter("fechaFinal");        
        //$this->transporte=$request->getParameter("transporte");        
        $this->modalidad=$request->getParameter("modalidad");
        
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");

        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");

        $this->etapa=$request->getParameter("etapa");
        $this->idetapa=$request->getParameter("idetapa");
        
        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");

        $fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad";
        $fecha="2012-04-01";
        
        $where.="and ca_version=( SELECT max(rr.ca_version) AS max
           FROM tb_reportes rr
          WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";
        
        if($this->idorigen!="")
        {
            $where.=" and r.ca_origen='{$this->idorigen}'";
        }
        
        if($this->iddestino!="")
        {
            $where.=" and r.ca_destino='{$this->iddestino}'";
        }
        if($this->fechaInicial!="")
        {
            $where.=" and o.ca_fcharribo>='{$this->fechaInicial}'";
        }
        
        if($this->fechaFinal!="")
        {
            $where.=" and o.ca_fcharribo<='{$this->fechaFinal}'";
        }

        $sql="select {$fields},COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,
        array_to_string( ARRAY(select distinct(ca_idetapa) from tb_repstatus s where 
    	s.ca_idreporte in (select ca_idreporte from tb_reportes rr where rr.ca_consecutivo=r.ca_consecutivo )),',' ) as etapas
            from tb_reportes r
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                where r.ca_tiporep=4
                and  r.ca_fchcreado >='{$fecha}' 
                and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                $where "; //and o.ca_presentacion= false
        
                //$con = Doctrine_Manager::getInstance()->connection();
                $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
        $st = $con->execute($sql);
//        echo $sql;
        $this->reportes = $st->fetchAll();
//        echo count($this->reportes)."<br>";
        
        $etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")
                      ->addWhere("t.ca_departamento = ? ", array(constantes::OTMDTA1))
                      ->orderBy("ca_orden")
                      ->execute();
        $this->etapas=array();
        foreach($etapas as $e)
        {
            $this->etapas[]=array("id"=>$e->getCaIdetapa(),"nombre"=>($e->getCaEtapa()),"impoexpo"=>($e->getCaImpoexpo()),"departamento"=>($e->getCaDepartamento()),"transporte"=>($e->getCaTransporte()));
        }
        $this->etapas[]=array("id"=>"99999","nombre"=>"Cierre");
        //$this->reportes = array_merge($rep_coltrans,$rep_colotm);
    }
    

    public function executeListaPuerto(sfWebRequest $request)
	{
        $this->fechaInicial=$request->getParameter("fechaInicial");
        $this->fechaFinal=$request->getParameter("fechaFinal");        
        //$this->transporte=$request->getParameter("transporte");        
        $this->modalidad=$request->getParameter("modalidad");
        
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");

        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");

        $this->etapa=$request->getParameter("etapa");
        $this->idetapa=$request->getParameter("idetapa");
        
        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");
        
        $this->opcion=$request->getParameter("opcion");
        
        if($this->opcion)
        {

            $fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad";
            $fecha="2012-04-01";

            $where.="and ca_version=( SELECT max(rr.ca_version) AS max
            FROM tb_reportes rr
            WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";

            if($this->idorigen!="")
            {
                $where.=" and r.ca_origen='{$this->idorigen}'";
            }

            if($this->iddestino!="")
            {
                $where.=" and r.ca_destino='{$this->iddestino}'";
            }
            if($this->fechaInicial!="")
            {
                $where.=" and o.ca_fcharribo>='{$this->fechaInicial}'";
            }

            if($this->fechaFinal!="")
            {
                $where.=" and o.ca_fcharribo<='{$this->fechaFinal}'";
            }


            $sql="select {$fields},COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_iddtm
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' 
                    and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                    and r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTLEV') and r.ca_consecutivo=rr.ca_consecutivo )
                    $where "; //and o.ca_presentacion= false

                    //$con = Doctrine_Manager::getInstance()->connection();                        
                    $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
            $st = $con->execute($sql);
    //        echo $sql;
            $this->reportes = $st->fetchAll();
        }
        
        $etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")  
                      ->whereNotIn("ca_idetapa", array('OTSDO','OTRDO','IMCOL','OTLIB','OTNDE'))
                      ->addWhere("t.ca_departamento = ? ", array(constantes::OTMDTA1))
                      ->orderBy("ca_orden")
                      ->execute();
        $this->etapas=array();
        foreach($etapas as $e)
        {
            $this->etapas[]=array("id"=>$e->getCaIdetapa(),"nombre"=>($e->getCaEtapa()),"impoexpo"=>($e->getCaImpoexpo()),"departamento"=>($e->getCaDepartamento()),"transporte"=>($e->getCaTransporte()));
        }
        //$this->reportes = array_merge($rep_coltrans,$rep_colotm);
    }

    public function executeGenerarPdf(sfWebRequest $request)
    {
         $consecutivo=$request->getParameter("id");
         $this->tipo=$request->getParameter("tipo");
         $this->opcion=$request->getParameter("opcion");
         $reporte=ReporteTable::retrieveByConsecutivo($consecutivo);
         
         $otm=$reporte->getRepOtm();
         if(!$otm)
             $otm=new RepOtm();

         if($this->tipo=="OTM")
         {
            $this->valido=$otm->getCaContinuacion();
         }
         else if($this->tipo=="DTM")
             $this->valido=$otm->getCaDtm();
         else if($this->tipo=="CP")
         {
             $this->valido="false";
         }

         $this->idreporte=$reporte->getCaIdreporte();
         $this->tipo=$request->getParameter("tipo");

         $this->url="/otm/pdf{$this->tipo}/idreporte/{$this->idreporte}";
         
         $repotm=$reporte->getRepOtm();
         $this->datos=array();
         if ($this->opcion!="") { 
            $this->forward404Unless( $repotm );
            $repotm->setProperty("fechafinalizacion", $request->getParameter("fechafinalizacion") );
            $repotm->setProperty("fechavencimiento", $request->getParameter("fechavencimiento") );
            $repotm->setProperty("nocontinuacion", $request->getParameter("continuacion") );
            $repotm->setProperty("observaciones", $request->getParameter("observaciones") );            
            $repotm->save();
         }
         if($repotm)
         {
             $this->datos["fechafinalizacion"]=$repotm->getProperty("fechafinalizacion");
             $this->datos["fechavencimiento"]=$repotm->getProperty("fechavencimiento");
             $this->datos["nocontinuacion"]=$repotm->getProperty("nocontinuacion");
             $this->datos["observaciones"]=$repotm->getProperty("observaciones");
             
             //print_r($this->datos);
         }
         
    }
    
    public function executeAprobarReporte(sfWebRequest $request)
    {
        try
        {
            $idreporte=$request->getParameter("id");
            $repOtm = Doctrine::getTable("RepOtm")->find( $idreporte );
            $tipo = $request->getParameter("tipo");

            if(!$repOtm)
            {
                $repOtm=new RepOtm();
                $repOtm->setCaIdreporte($idreporte);                
            }
            if($tipo=="OTM")
                $repOtm->setCaContinuacion(true);
            else if($tipo=="DTM")
            {
                if($repOtm->getCaConsecutivo()=="")
                {
                    $conse=$repOtm->getConsecutivoDtm();
                    $repOtm->setCaConsecutivo($conse);
                    $reporte=$repOtm->getReporte();
                    if($reporte)
                    {    
                        $reporte->setCaMercanciaDesc($reporte->getCaMercanciaDesc());
                        $reporte->save();
                    }
                }    
                $repOtm->setCaDtm(true);            
            }
            $repOtm->save();
            $this->responseArray=array("success"=>true);
        }
        catch(Exception $e)
        {
            $this->responseArray=array("success"=>false,"err"=>$e->getMessage());
        }
        $this->setTemplate("responseTemplate");
        
    }
    

    public function executeEventoPresentacion(sfWebRequest $request)
    {
        $reportes=$request->getParameter("reportes");
        foreach($reportes as $r)
        {
            $rep = explode("|", $r);
            $repOtm = Doctrine::getTable("RepOtm")->find( $rep[1] );
            if(!$repOtm)
                continue;
            
            if($rep[0]=="Aprobar")
            {
                $repOtm->setCaPresentacion(true);                                
                $this->crearStatus($repOtm->getReporte());
                $repOtm->save();
            }            
        }
        $this->responseArray=array("success"=>true);
        $this->setTemplate("responseTemplate");
    }

    public function executeAsignarIdDtm(sfWebRequest $request)
    {
        $iddtm=$request->getParameter("ca_iddtm");
        $idreporte=$request->getParameter("ca_idreporte");

        $repOtm = Doctrine::getTable("RepOtm")->find( $idreporte );

        if($repOtm)
        {
            $repOtm->setCaIddtm($iddtm);
            $repOtm->save();
        }
        $this->responseArray=array("success"=>true);
        $this->setTemplate("responseTemplate");
    }
    
    
    public function executeGenerarStatus(sfWebRequest $request)
    {
        $idetapa=$request->getParameter("idetapa");
        $ids=$request->getParameter("ids");
        $observaciones=$request->getParameter("observaciones");

        foreach($ids as $key=>$i)
        {
            $reporte=ReporteTable::retrieveByConsecutivo($i);
            if($reporte)
            {
                $this->crearStatus($reporte,$idetapa,$observaciones[$key]);
            }
        }
        $this->redirect( "otm/listaAprobacion");
         $this->setTemplate("listaAprobacion");

        exit;
    }

    public function crearStatus($reporte,$idetapa="IMPOD",$observaciones=""){	

        $ultimostatus = $reporte->getUltimoStatus();

        $status = new RepStatus();

        $status->setCaIdreporte( $reporte->getCaIdreporte() );
        $status->setCaFchstatus( date("Y-m-d H:i:s") );

        $etapa = Doctrine::getTable("TrackingEtapa")->find( $idetapa );
        
        $status->setCaComentarios( $observaciones );
        $status->setCaFchenvio( date("Y-m-d H:i:s") );
        $status->setCaUsuenvio( $this->getUser()->getUserId() );

        if( $ultimostatus ){
            $status->setCaPiezas( $ultimostatus->getCaPiezas() );
            $status->setCaPeso( $ultimostatus->getCaPeso() );
            $status->setCaVolumen( $ultimostatus->getCaVolumen() );
            $status->setCaIdnave( $ultimostatus->getCaIdnave() );
            $status->setCaFchsalida( $ultimostatus->getCaFchsalida() );
            $status->setCaFchllegada( $ultimostatus->getCaFchllegada() );
            $status->setCaFchcontinuacion( $ultimostatus->getCaFchcontinuacion() );
            $status->setCaDoctransporte( $ultimostatus->getCaDoctransporte() );
        }

        $status->setCaIdetapa($idetapa);

        $status->setCaIntroduccion( $etapa->getCaPreasunto() );
        $status->setStatus( $observaciones."<br>".$etapa->getCaMessageDefault() );
                

        $destinatarios = array();

        
        $contactos=  explode(",", $reporte->getCaConfirmarClie());
        foreach($contactos as $c)
        {
            if($c!="")
                $destinatarios[]=$c;
        }
        $status->save();
        $options=array();

        
        $user = Doctrine::getTable("Usuario")->find( $this->getUser()->getUserId() );
        if(!$user)
            $email=$this->getUser()->getEmail();
        else
        {
            $host="coltrans.com.co";
            $repotm=$reporte->getRepOtm();
            if(!$repotm || $user->getProperty("alias")=="")
                $email=$user->getProperty("alias")."@".$host;
            else 
            {
                $email=$user->getProperty("alias")."@".$repotm->getCaLiberacion();
            }
        }
        $options["from"]=$email;

        $status->send($destinatarios,array(),  array(),$options);        
    }
    
    
    public function executePdfDTM(sfWebRequest $request) {    

        $idreporte=$request->getParameter("idreporte");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');

        $pdf->SetMargins(1, 1, 1,true);

        $pdf->setPrintHeader(false);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage('', '',true);

        $pdf->setCellPaddings(1, 1, 1, 1);
        $pdf->setCellMargins(1, 1, 1, 1);
        $pdf->SetFillColor(255, 255, 127);
        $this->getRequest()->setParameter('idreporte',$idreporte);
        $html=sfContext::getInstance()->getController()->getPresentationFor( 'otm', 'htmlDTM');
        $html=utf8_encode($html);
        $html=  str_replace("#E1E1E1", "", $html);
        
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->lastPage();


        $pdf->Output('example.pdf', 'I');

       exit;
    }
    
    public function executeHtmlDTM(sfWebRequest $request) {    

        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        $this->repotm=$this->reporte->getRepOtm();
        if($this->reporte->getCaModalidad()=="FCL")
        {
            $this->marcas=$this->reporte->getCliente()->getCaCompania()."<br>Contenedor<br> ".$this->repotm->getCaContenedor()."<br>FCL-FCL";
        }
        else
        {
            $this->marcas="Carga Suelta<br>LCL-LCL";
        }
        
        $this->setLayout("none");
    }
    
    public function executePdfOTM(sfWebRequest $request) {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        $this->setLayout("email");
        $this->iduser=$this->getUser()->getUserId();
        $reporte = new Reporte();
    }
    
    
        public function executePdfCP(sfWebRequest $request) {    

        $idreporte=$request->getParameter("idreporte");
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "LETTER", true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Coltrans');

        $pdf->SetMargins(1, 1, 1,true);

        $pdf->setPrintHeader(false);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', 10);

        $pdf->AddPage('', '',true);

        $pdf->setCellPaddings(1, 1, 1, 1);
        $pdf->setCellMargins(1, 1, 1, 1);
        $pdf->SetFillColor(255, 255, 127);
        $this->getRequest()->setParameter('idreporte',$idreporte);
        $html=sfContext::getInstance()->getController()->getPresentationFor( 'otm', 'htmlCP');
        $html=utf8_encode($html);
        $html=  str_replace("#E1E1E1", "", $html);
        
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->lastPage();


        $pdf->Output('example.pdf', 'I');

       exit;
    }
    
    public function executeHtmlCP(sfWebRequest $request) {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        $this->repotm=$this->reporte->getRepOtm();
        
        if($this->getUser()->getUserId()=="maquinche")
        {
            $house = Doctrine::getTable("InoHouse")
                      ->createQuery("h")
                      ->select("h.ca_idreporte,m.ca_referencia")
                      ->innerJoin("h.InoMaster m")
                      ->addWhere("h.ca_idreporte = ?", $this->repotm->getCaIdreporte() )
                      ->fetchOne();
            if($house)
            {
                $this->referencia=$house->getProperty("ca_referencia");
            }
        }        
        
        $this->setLayout("none");
    }
    public function executePresentacionDian(sfWebRequest $request) {
        
        $fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad";
        $fecha="2012-04-01";
        $this->idp=$request->getParameter("idp");
        
        $repOtm = Doctrine::getTable("RepOtm")
                      ->createQuery("r")
                      ->whereIn("ca_idreporte",$this->idp)                      
                      ->execute();
        foreach($repOtm as $r)
        {
            echo $r->getCaIdreporte().",";
            $r->setProperty("fechaPresentacionDian",date("Y-m-d"));
            $r->setProperty("usuarioPresentacionDian",$this->getUser()->getUserId());
            $r->save();
        }
        
        $where=" and r.ca_idreporte in (".implode(",", $this->idp).")";
        
        $sql="select {$fields},COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_iddtm
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' 
                    and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                    and r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTLEV') and r.ca_consecutivo=rr.ca_consecutivo )
                    $where "; //and o.ca_presentacion= false

                //$con = Doctrine_Manager::getInstance()->connection();                        
        $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
        $st = $con->execute($sql);
//        echo $sql;
        $this->reportes = $st->fetchAll();
    }
    
    
    
}
