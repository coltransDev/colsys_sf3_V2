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
        
        $this->etapa=$request->getParameter("etapa");
        $this->idetapa=$request->getParameter("idetapa");
        
        $this->noreporte    = $this->getRequestParameter("noreporte");
        $this->noreferencia  = $this->getRequestParameter("noreferencia");
        
        
        $this->opcion=$request->getParameter("opcion");
		
        $where=$where1=$where2="";
        if($this->modalidad!="")
        {
            $where= " and r.ca_modalidad='{$this->modalidad}'";
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
            $where1=" and r.ca_destino='{$this->idorigen}'";
            $where2=" and r.ca_origen='{$this->idorigen}'";
        }
        
		$fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad";
        $fecha="2012-04-01";
		$sql="select {$fields},cl.ca_compania, cl.ca_idalterno,m.ca_referencia,m.ca_muelle,dp.ca_nombre as ca_bodega,m.ca_fcharribo
            from tb_reportes r
            left join tb_repotm o on r.ca_idreporte=o.ca_idreporte         
            inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
            inner join vi_clientes_reduc cl on cl.ca_idalterno::text=ct.ca_idcliente::text             
            ,
            tb_inoclientes_sea c, tb_inomaestra_sea  m
            left join tb_diandepositos dp on m.ca_muelle=dp.ca_codigo
            where c.ca_idreporte=r.ca_idreporte and  c.ca_referencia=m.ca_referencia and ca_fchmuisca is not null
            and (r.ca_impoexpo='OTM/DTA' or r.ca_continuacion='OTM')  and r.ca_fchcreado >='{$fecha}' ";
            if($this->idetapa=="")
             {    
                $sql.=" and ( (o.ca_dtm is null or o.ca_dtm is null) or (o.ca_dtm = false or o.ca_dtm = false) )  ";
             }
            
            $sql.=" $where $where1
            order by o.ca_fcharribo desc , 3";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $rep_coltrans = $st->fetchAll();
        
        $sql="select {$fields},t.ca_nombre as ca_compania, t.ca_identificacion as ca_idalterno,o.ca_muelle,dp.ca_nombre as ca_bodega,o.ca_fcharribo,i.ca_nombre as ca_importador
            from tb_reportes r
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                inner join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                left join tb_terceros i on o.ca_idimportador=i.ca_idtercero
                left join tb_diandepositos dp on o.ca_muelle=dp.ca_codigo 
                where r.ca_tiporep=4
                and  r.ca_fchcreado >='{$fecha}' ";
             if($this->idetapa=="")
             {    
                $sql.=" and ( o.ca_dtm = false or o.ca_dtm = false ) ";
             }
        $sql.="$where $where2
                order by o.ca_fcharribo desc, 3 ";
                //echo $sql;
                        
        $st = $con->execute($sql);
        $rep_colotm = $st->fetchAll();
        $this->reportes = array_merge($rep_coltrans,$rep_colotm);

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
    
    public function executeListaPuerto()
	{
        
        $fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo, o.ca_fcharribo,o.ca_iddtm";        
        $fecha="2012-04-01";
		$sql="select {$fields},cl.ca_compania, cl.ca_idalterno
            from tb_reportes r
            left join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
            inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
            inner join vi_clientes_reduc cl on cl.ca_idalterno::text=ct.ca_idcliente::text
            ,
            tb_inoclientes_sea c, tb_inomaestra_sea  m
            where c.ca_idreporte=r.ca_idreporte and  c.ca_referencia=m.ca_referencia and ca_fchmuisca is not null
            and (r.ca_impoexpo='OTM/DTA' or r.ca_continuacion='OTM')  and r.ca_fchcreado >='{$fecha}' 
            and  (o.ca_dtm = true and o.ca_continuacion = true and o.ca_presentacion= false ) 
            order by 3";
        //
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $rep_coltrans = $st->fetchAll();            
        
        $sql="select {$fields},t.ca_nombre as ca_compania, t.ca_identificacion as ca_idalterno
            from tb_reportes r
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                inner join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                where r.ca_tiporep=4
                and  r.ca_fchcreado >='{$fecha}' 
                and ( o.ca_dtm = true and o.ca_continuacion = true and o.ca_presentacion= false  ) "; //and o.ca_presentacion= false
        $st = $con->execute($sql);
        $rep_colotm = $st->fetchAll();
        $this->reportes = array_merge($rep_coltrans,$rep_colotm);
    }

    public function executeGenerarPdf(sfWebRequest $request)
    {
         $consecutivo=$request->getParameter("id");
         $this->tipo=$request->getParameter("tipo");
         $reporte=ReporteTable::retrieveByConsecutivo($consecutivo);
         
         $otm=$reporte->getRepOtm();
         if(!$otm)
             $otm=new RepOtm();
         if($this->tipo=="OTM")         
         {
            $this->valido=$otm->getCaContinuacion();
            //echo "==".$otm->getCaContinuacion()."==";
         }
         else
             $this->valido=$otm->getCaDtm();
         
         $this->idreporte=$reporte->getCaIdreporte();         
         $this->tipo=$request->getParameter("tipo");
         $this->url="/reportesNeg/pdf{$this->tipo}/idreporte/{$this->idreporte}";
         //echo $url;
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
                $repOtm->setCaDtm (true);            
            
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
        //print_r($ids);
        
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
        //print_r($ids);
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
                
/*
                if( $etapa=="IMCOL" || $this->getRequestParameter("modfchllegada_".$oid) ){
                    $status->setCaFchcontinuacion( Utils::parseDate($this->getRequestParameter("fchllegada_".$oid)));	
                }
                if( $etapa=="IMCOL" ){
                    $idbodega = $this->getRequestParameter("bodega_".$oid);
                    $status->setProperty("idbodega", $idbodega);				
                }
                if( $etapa=="99999" ){
                    $fchplanilla = $this->getRequestParameter("fchplanilla_".$oid);						
                    $status->setProperty("fchplanilla", Utils::parseDate($fchplanilla));
                }
  */              

        /*
        if( $tipo_msg=="Conf" || $tipo_msg=="Puerto" ){
            $status->setCaIntroduccion( $this->getRequestParameter("intro_body") );
            $status->setStatus( $this->getRequestParameter("mensaje_".$oid) );
        }else{
            $status->setCaIntroduccion( $this->getRequestParameter("status_body_intro") );				
            $mensaje = $this->getRequestParameter("status_body");
            if( $this->getRequestParameter("mensaje_".$oid) ){
                $mensaje .= "\n".$this->getRequestParameter("mensaje_".$oid);
            }
            $status->setStatus( $mensaje );			
        }
*/
        $destinatarios = array();

        //$destinatarios[]="maquinche@coltrans.com.co";
        
        $contactos=  explode(",", $reporte->getCaConfirmarClie());
        foreach($contactos as $c)
        {
            if($c!="")
                $destinatarios[]=$c;
        }
        //print_r($destinatarios);
        //exit;
        /*
         * $checkbox = $request->getParameter("em_".$oid);
        if( $checkbox ){
            foreach($checkbox as $check ){
                $destinatarios[]=$request->getParameter("ar_".$oid."_".$check);
            }
        }
         * 
         */
        $status->save();
        $options=array();
        //$options["subject"]="Prueba";
        
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
        
        
        //$options["from"] =  $request->getParameter("remitente");
        $status->send($destinatarios,array(),  array(),$options);        
    }	
    
}
