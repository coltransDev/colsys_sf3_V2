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
    const RUTINACARGASADUANA = 139;
    private $conReplica=null;
    public function executeIndex(sfWebRequest $request)
    {
        $this->forward('default', 'module');
    }
    
    public  function getConnReplica()
    {
        if(!$this->conReplica)
        {
            $databaseConf = sfYaml::load(sfConfig::get('sf_config_dir') . '/databases_replica.yml');
            $confCon=$databaseConf['prod']['doctrine'];            
            $dsn = $confCon['param']['dsn'];        
            $principal =  substr( $dsn, 0,  strpos( $dsn, ";") );            
            $servidor = substr( $dsn,  strlen( $principal )+6 );
            $database = substr( $principal, strpos( $principal, "dbname")+7 );
            $usuarioDb = $confCon['param']['username'];
            $password = $confCon['param']['password'];
            
            $this->conReplica = Doctrine_Manager::connection(new PDO("pgsql:dbname=".$database.";host=".$servidor, $usuarioDb, $password));

        }
        return $this->conReplica;
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
            //$con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'V9p0%rRc9$'));
            $conn=$this->getConnReplica();
            $st = $conn->execute($sql);
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

            $st = $conn->execute($sql);
            $rep_colotm = $st->fetchAll();
            $this->reportes = array_merge($rep_coltrans,$rep_colotm);
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
        
        $this->opcion=$request->getParameter("opcion");
        
        $etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")
                      ->addWhere("t.ca_departamento = ? ", array(constantes::OTMDTA1))
                      ->orderBy("ca_orden")
                      ->execute();
        $this->etapas=array();
        foreach($etapas as $e)
        {
            $this->etapas[]=array("id"=>$e->getCaIdetapa(),"nombre"=>  ($e->getCaEtapa()),"impoexpo"=>($e->getCaImpoexpo()),"departamento"=>($e->getCaDepartamento()),"transporte"=>($e->getCaTransporte()));
        }
        $this->etapas[]=array("id"=>"99999","nombre"=>"Cierre");

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
        if($this->modalidad!="")
            {
                if($this->modalidad=="LCL")
                {
                    $where.= " and r.ca_modalidad in ('{$this->modalidad}' , 'COLOADING')";
                }
                else
                {
                    $where.= " and r.ca_modalidad='{$this->modalidad}'";
                }
            }

                        
        $sql="select {$fields},COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_fcharribo,
        array_to_string( ARRAY(select distinct(ca_idetapa) from tb_repstatus s where 
    	s.ca_idreporte in (select ca_idreporte from tb_reportes rr where rr.ca_consecutivo=r.ca_consecutivo )),',' ) as etapas
            from tb_reportes r
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                left join tb_terceros t on o.ca_idimportador=t.ca_idtercero
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                where r.ca_tiporep=4
                and  r.ca_fchcreado >='{$fecha}'                 
                $where order by o.ca_fcharribo"; //and o.ca_presentacion= false

                //$con = Doctrine_Manager::getInstance()->connection();
                if($this->opcion)
                {
//                $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'V9p0%rRc9$'));
                  $conn=$this->getConnReplica();
        $st = $conn->execute($sql);
        //echo $sql;
        $this->reportes = $st->fetchAll();
        //echo $sql;
                }
//        echo count($this->reportes)."<br>";        
        
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
            
            $fecha="2012-04-01";
            $where.="and ca_version=( SELECT max(rr.ca_version) AS max
            FROM tb_reportes rr
            WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text and rr.ca_tiporep=4) ";

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
            
            if($this->modalidad!="")
            {
                if($this->modalidad=="LCL")
                {
                    $where.= " and r.ca_modalidad in ('{$this->modalidad}' , 'COLOADING')";
                }
                else
                {
                    $where.= " and r.ca_modalidad='{$this->modalidad}'";
                }
            }
            
            if($this->noreporte!="")
            {
                $where.= " and r.ca_consecutivo like '".$this->noreporte."%'";
            }
            

            $sql="select r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,COALESCE(i.ca_nombre,COALESCE(t.ca_nombre,cl.ca_compania)) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_iddtm,
                EXTRACT(DAY from (o.ca_fechavencimiento - now() )) as dia
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    left join tb_terceros i on o.ca_idimportador=i.ca_idtercero
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' 
                    and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                    and r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTPRC') and r.ca_consecutivo=rr.ca_consecutivo )
                    $where "; //and o.ca_presentacion= false

                    //$con = Doctrine_Manager::getInstance()->connection();                        
                    //$con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'V9p0%rRc9$'));
                    $conn=$this->getConnReplica();
                    //echo $sql;
            $st = $conn->execute($sql);
//            echo $sql;
            $this->reportes = $st->fetchAll();
        }
        
        /*$etapas = Doctrine::getTable("TrackingEtapa")
                      ->createQuery("t")  
                      ->whereNotIn("ca_idetapa", array('OTSDO','OTRDO','IMCOL','OTLIB','OTNDE'))
                      ->addWhere("t.ca_departamento = ? ", array(constantes::OTMDTA1))
                      ->orderBy("ca_orden")
                      ->execute();
        $this->etapas=array();
        foreach($etapas as $e)
        {
            $this->etapas[]=array("id"=>$e->getCaIdetapa(),"nombre"=>($e->getCaEtapa()),"impoexpo"=>($e->getCaImpoexpo()),"departamento"=>($e->getCaDepartamento()),"transporte"=>($e->getCaTransporte()));
        }*/
        //$this->reportes = array_merge($rep_coltrans,$rep_colotm);
    }
    
    
    public function executeListaTranspColmas(sfWebRequest $request)
	{
        $this->semanaIni=$request->getParameter("semanaIni");
        $this->semanaFin=$request->getParameter("semanaFin");
        //$this->transporte=$request->getParameter("transporte");        
        $this->modalidad=$request->getParameter("modalidad");
        
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");

        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");
                
        $this->opcion=$request->getParameter("opcion");
        
        if($this->opcion)
        {
            if($this->idorigen!="")
            {
                $where.=" and t.ca_origen='{$this->idorigen}'";
            }

            if($this->iddestino!="")
            {
                $where.=" and t.ca_destino='{$this->iddestino}'";
            }

            
            if($this->modalidad!="")
            {
                $where.= " and t.ca_modalidad='{$this->modalidad}'";
            }

            $q = Doctrine::getTable("TransporteAdu")
                            ->createQuery("t")
                            //->select("t.ca_id,t.ca_referencia,t.ca_semana,t.ca_peso,t.ca_piezas,t.ca_volumen,c.ca_compania,o.ca_ciudad as ciuOrigen,d.ca_ciudad as ciuDestino")
                            ->innerJoin("t.Cliente c")
                            ->innerJoin("t.Origen o")
                            ->innerJoin("t.Destino d")
                            ->orderBy("t.ca_semana");
            if($this->semanaIni!="")
                $q->addWhere ("ca_semana >=?",$this->semanaIni);
            
            if($this->semanaFin!="")
                $q->addWhere ("ca_semana <=?",$this->semanaFin);
            
            $this->cargas=$q->execute();

            /*$sql="select *
                from tb_brk_transporte t                    
                    where 1=1
                    $where "; //and o.ca_presentacion= false

//                    $con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'lmD125aC-c'));
            $con = Doctrine_Manager::connection();
            //echo $sql;
            $st = $con->execute($sql);

            $this->reportes = $st->fetchAll();
*/
            //print_r($this->reportes);
            
        }

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
            if($request->getParameter("fechafinalizacion"))
            {
                $repotm->setProperty("fechafinalizacion", $request->getParameter("fechafinalizacion") );
                $repotm->setCaFechafinalizacion($request->getParameter("fechafinalizacion"));
            }
            if($request->getParameter("fechavencimiento"))
            {
                $repotm->setProperty("fechavencimiento", $request->getParameter("fechavencimiento") );
                $repotm->setCaFechavencimiento($request->getParameter("fechavencimiento"));
            }
            if($request->getParameter("continuacion"))
                $repotm->setProperty("nocontinuacion", $request->getParameter("continuacion") );
            if($request->getParameter("observaciones"))
                $repotm->setProperty("observaciones", $request->getParameter("observaciones") );
            if($request->getParameter("nofactura"))
                $repotm->setProperty("nofactura", $request->getParameter("nofactura") );
            if($request->getParameter("nodestinofinal"))
                $repotm->setProperty("nodestinofinal", $request->getParameter("nodestinofinal") );
            if($request->getParameter("nocomodato"))
                $repotm->setProperty("nocomodato", $request->getParameter("nocomodato") );
            if($request->getParameter("manifiesto"))
                $repotm->setCaManifiesto($request->getParameter("manifiesto"));
            if($request->getParameter("fcharribo"))
                $repotm->setCaFcharribo($request->getParameter("fcharribo"));
            if($request->getParameter("adudestino"))
                $repotm->setProperty("adudestino",$request->getParameter("adudestino"));
            $repotm->save();
         }
         if($repotm)
         {
             $this->datos["fechafinalizacion"]=$repotm->getProperty("fechafinalizacion");
             $this->datos["fechavencimiento"]=$repotm->getProperty("fechavencimiento");
             $this->datos["nocontinuacion"]=$repotm->getProperty("nocontinuacion");
             $this->datos["observaciones"]=$repotm->getProperty("observaciones");             
             $this->datos["nofactura"]=$repotm->getProperty("nofactura");
             $this->datos["nocomodato"]=$repotm->getProperty("nocomodato");
             $this->datos["nodestinofinal"]=$repotm->getProperty("nodestinofinal");
             $this->datos["manifiesto"]=$repotm->getCaManifiesto();
             $this->datos["fcharribo"]=$repotm->getCaFcharribo();
             $this->adudestino = $repotm->getProperty("adudestino");
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
            {
                $repOtm->setCaContinuacion(true);
                $conse=$repOtm->getConsecutivoCv();
                $this->forward404Unless( $conse );
                $repOtm->setCaCv($conse);                
            }
            else if($tipo=="DTM")
            {
                if($repOtm->getCaConsecutivo()=="")
                {
                    $conse=$repOtm->getConsecutivoDtm();
                    $this->forward404Unless( $conse );
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
            $this->responseArray=array("success"=>true,"consecutivo"=>$conse);
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
                $repOtm->save();
                //$this->crearStatus($repOtm->getReporte());
            }            
        }
        $this->responseArray=array("success"=>true);
        $this->setTemplate("responseTemplate");
    }

    public function executeAsignarIdDtm(sfWebRequest $request)
    {
        try
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
        catch(Exception $e)
        {
            $this->responseArray=array("success"=>false);
            $this->setTemplate("responseTemplate");
        }
        
        
        
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
    }
    
    public function executePdfOTM1(sfWebRequest $request) {
        $idreporte=($request->getParameter("idreporte")!="")?$request->getParameter("idreporte"):"0";
        $this->reporte = Doctrine::getTable("Reporte")->find( $idreporte );
        $this->forward404Unless( $this->reporte );
        $this->setLayout("email");
        $this->iduser=$this->getUser()->getUserId();        
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
    
    public function executeEnviarChance(sfWebRequest $request) 
    {
        $email = new Email();

        $email->setCaUsuenvio($user->getUserId());
        $email->setCaTipo("InstruccionesOtm"); //Envío de Avisos
        $email->setCaIdcaso(null);

        $from = $request->getParameter("from");
        if ($from) {
            $email->setCaFrom($from);
        } else {
            $email->setCaFrom($user->getEmail());
        }
        $email->setCaFromname($user->getNombre());

        if ($request->getParameter("readreceipt")) {
            $email->setCaReadreceipt(true);
        } else {
            $email->setCaReadreceipt(false);
        }
        
        $email->setCaReplyto($user->getEmail());

        $recips = explode(",", $request->getParameter("destinatario"));
        
        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addTo($recip);
            }
        }
        
        $recips = explode(",", $request->getParameter("cc"));
        foreach ($recips as $recip) {
            $recip = str_replace(" ", "", $recip);
            if ($recip) {
                $email->addCc($recip);
            }
        }
        

        if ($from) {
            $email->addCc($from);
        } else {
            $email->addCc($this->getUser()->getEmail());
        }

        $email->setCaSubject($request->getParameter("asunto"));
        $email->setCaBody($request->getParameter("mensaje"));

        $mensaje = Utils::replace($request->getParameter("mensaje")) . "<br />";


        $html ="<div>
            <table class='tableList alignLeft'><tr><td>
            <table class='tableList alignLeft' width='1000' >
            <tr><th colspan='8'>Se Creo la Referencia No: ".$this->master->getCaReferencia()."</th></tr>
            <tr><th>NO REPORTE</th><th>HBL</th><th>IMPORTADOR</th><th>MUELLE</th><th>BODEGA</th><th>PIEZAS</th><th>PESO</th><th>VOLUMEN</th></tr>";
        $html.=implode("",$htmlReportes );
        $html."</table></td></tr></table></div>";

        $this->getRequest()->setParameter('tipo',"INSTRUCCIONES");
        $this->getRequest()->setParameter('mensaje',$request->getParameter("mensaje"));
        $this->getRequest()->setParameter('html',$html);
        $request->setParameter("format", "email");

        $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'emailReporte');
        $email->setCaBodyhtml($mensaje);

        $email->save($conn);
    }
    
    public function executePresentacionDian(sfWebRequest $request) {
        //$fields="r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,o.ca_propiedades";
        $fecha="2012-04-01";
        $this->idp=$request->getParameter("idp");
        
        $repOtm = Doctrine::getTable("RepOtm")
                      ->createQuery("r")
                      ->whereIn("ca_idreporte",$this->idp)                      
                      ->execute();
        foreach($repOtm as $r)
        {
            
            $r->setProperty("fechaPresentacionDian",date("Y-m-d"));
            $r->setCaFchpresentacion(date("Y-m-d H:i:s"));
            $r->setProperty("usuarioPresentacionDian",$this->getUser()->getUserId());
            $r->setCaUsupresentacion($this->getUser()->getUserId());
            $r->save();
        }

        $where=" and r.ca_idreporte in (".implode(",", $this->idp).")";
        $sql="select r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,o.ca_propiedades,
            o.ca_fcharribo,COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,
            cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_iddtm/*,ori.ca_ciudad ca_ciuorigen*/,des.ca_ciudad ca_ciudestino
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    left join tb_terceros t on o.ca_idimportador=t.ca_idtercero
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    /*inner join tb_ciudades ori on r.ca_origen=ori.ca_idciudad*/
                    inner join tb_ciudades des on r.ca_destino=des.ca_idciudad
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' 
                    and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                    and r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTLEV') and r.ca_consecutivo=rr.ca_consecutivo )
                    $where "; //and o.ca_presentacion= false

                //$con = Doctrine_Manager::getInstance()->connection();                        
        //$con = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'V9p0%rRc9$'));
        $conn=$this->getConnReplica();
        $st = $conn->execute($sql);
//        echo $sql;
        $this->reportes = $st->fetchAll();
    }

    public function executeReportesOtm(sfWebRequest $request) {
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
            
            $fecha="2012-04-01";
            $where.="and ca_version=( SELECT max(rr.ca_version) AS max
            FROM tb_reportes rr
            WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text ) ";

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
                $where.=" and o.ca_fchpresentacion>='{$this->fechaInicial}'";
            }

            if($this->fechaFinal!="")
            {
                $where.=" and o.ca_fchpresentacion<='{$this->fechaFinal}'";
            }
            
            if($this->modalidad!="")
            {
                if($this->modalidad=="LCL")
                {
                    $where.= " and r.ca_modalidad in ('{$this->modalidad}' , 'COLOADING')";
                }
                else
                {
                    $where.= " and r.ca_modalidad='{$this->modalidad}'";
                }
            }

            $sql="select r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,COALESCE(i.ca_nombre,COALESCE(t.ca_nombre,cl.ca_compania)) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_iddtm,o.ca_fchpresentacion,o.ca_usupresentacion
                from tb_reportes r
                    inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    left join tb_terceros t on o.ca_idcliente=t.ca_idtercero
                    inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                    left join tb_terceros i on o.ca_idimportador=i.ca_idtercero
                    inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                    where r.ca_tiporep=4
                    and  r.ca_fchcreado >='{$fecha}' 
                    and ( o.ca_dtm = true and o.ca_continuacion = true and (o.ca_presentacion= false or o.ca_presentacion is null)  )
                    and r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and ss.ca_idetapa in ('OTLEV') and r.ca_consecutivo=rr.ca_consecutivo )
                    $where "; //and o.ca_presentacion= false

                    $con = Doctrine_Manager::getInstance()->connection();                        
                    //$conn = Doctrine_Manager::connection(new PDO('pgsql:dbname=Coltrans;host=10.192.1.65', 'Administrador', 'V9p0%rRc9$'));
                    $conn=$this->getConnReplica();
                    
                    //echo Doctrine_Manager::getConnectionName($conn);
                    
                    /*$conn->setAttribute(Doctrine::ATTR_DEFAULT_TABLE_CHARSET,'utf8');
                    $conn->setAttribute(Doctrine::ATTR_DEFAULT_TABLE_COLLATE,'utf8_unicode_ci');
                    $conn->setCollate('utf8_unicode_ci');
                    $conn->setCharset('utf8');
                     * 
                     */
                    //$conn = Doctrine_Manager::getConnection('master');
                    //echo "xcvsxfsdfd<pre>";print_r(Doctrine_Manager::getArrayConnections());echo "</pre>";
            //Doctrine_Query::query('SET NAMES utf8'); 

                    
                   // $conn = $this->getDoctrine()->getEntityManager('replica');


            $st = $conn->execute($sql);
            echo $sql;
            $this->reportes = $st->fetchAll();
        }
    }
    
    public function executeCargaSinStatusOTM(sfWebRequest $request) {
        
        $this->setLayout("email");
        if(date("H")==10)
        {
            $horaini="00:00:00";
            $horafin="09:30:00";
        }
        else if(date("H")==16 || date("H")==17)
        {
            $horaini="13:00:00";
            $horafin="15:30:00";
        }else
        {
            $horaini="00:00:00";
            $horafin="09:30:00";
        }
        
        $sql="select
                r.ca_idreporte,r.ca_consecutivo,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,o.ca_hbls,
                COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,
                ( select ca_fchenvio from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and r.ca_consecutivo=rr.ca_consecutivo and ss.ca_idetapa in ('OTSDO','OTRDO','OTNDE','IMPOD','OTRVD','OTACP','OTINS','OTLEV','IMCMP','OTPRC','OTDES','OTTRA','IMCOL','OTLIB','OTNOV','88888') order by ca_fchenvio desc limit 1  ) as ca_fchenvio,cl.ca_propiedades
            from tb_reportes r 
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                left join tb_terceros t on o.ca_idimportador=t.ca_idtercero
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
            where 
                r.ca_tiporep=4 and (r.ca_fchcreado >='".Utils::addDate( date("Y-m-d"), 0,-1)."' and r.ca_fchcreado >='2012-10-31') and
                ca_version=( SELECT max(rr.ca_version) AS max FROM tb_reportes rr WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text and ca_tiporep=4) and 
                r.ca_consecutivo not in ( select (rr.ca_consecutivo) from tb_repstatus ss,tb_reportes rr where ss.ca_idreporte=rr.ca_idreporte and r.ca_consecutivo=rr.ca_consecutivo and (ss.ca_idetapa in ('99999','00000') or (ss.ca_idetapa in ('OTSDO','OTRDO','OTNDE','IMPOD','OTRVD','OTACP','OTINS','OTLEV','IMCMP','OTPRC','OTDES','OTTRA','IMCOL','OTLIB','OTNOV','88888') and ca_fchenvio between '".date("Y-m-d")." $horaini' and '".date("Y-m-d")." $horafin')  ) )
                and o.ca_fcharribo<='".date("Y-m-d")."'
                and (cl.ca_propiedades NOT LIKE '%cuentaglobal%' or cl.ca_propiedades is null)
            order by r.ca_modalidad,r.ca_origen,r.ca_destino";
//        echo $sql;
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $rep_colotm = $st->fetchAll();

        $htmlReportes=array();
        foreach($rep_colotm as $r)
        {
            $htmlReportes[]="<tr><td>".$r["ca_consecutivo"]."</td><td>".$r["ca_compania"]."</td><td>".$r["ca_hbls"]."</td><td>".$r["ca_origen"]."</td><td>".$r["ca_destino"]."</td><td>".$r["ca_modalidad"]."</td><td>".$r["ca_fchenvio"]."</td></tr>";
        }
        
        $email = new Email();
        $email->setCaUsuenvio("Administrador");
        $email->setCaTipo("InstruccionesOtm"); //Envío de Avisos
        $email->setCaIdcaso(null);

        $from = "no-reply@coltrans.com.co";        
        $email->setCaFrom($from);        
        $email->setCaFromname("Administrador");        
        $email->setCaReadreceipt(false);

        //$email->addTo("syepes@coltrans.com.co");
        $email->addTo("maquinche@coltrans.com.co");

        $msg="Listado RN sin Status ".$horaini." - ".$horafin;
        $email->setCaSubject($msg);
        $email->setCaBody($msg);

        $mensaje = Utils::replace($msg) . "<br />";

        $html ="<div>
            <table class='tableList alignLeft'><tr><td>
            <table class='tableList alignLeft' width='400' >
            <tr><th colspan='4'>Los siguientes son los reportes que no presentaron status </th></tr>
            <tr><th>NO REPORTE</th><th>Cliente</th><th>Hbl</th><th>Origen</th><th>Destino</th><th>Modalidad</th><th>Ult.Status</th></tr>";
        $html.=implode("",$htmlReportes );
        $html."</table></td></tr></table></div>";

        $this->getRequest()->setParameter('tipo',"INSTRUCCIONES");
        $this->getRequest()->setParameter('mensaje',$request->getParameter("mensaje"));
        $this->getRequest()->setParameter('html',$html);
        $request->setParameter("format", "email");

        $mensaje = sfContext::getInstance()->getController()->getPresentationFor( 'reportesNeg', 'emailReporte');
        $email->setCaBodyhtml($mensaje);
        $email->send();
        $email->save();
        exit;
    }
    
    public function executeTransportistasColmas(sfWebRequest $request) {
        //echo date("W");
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/CheckColumn",'last');
    }
    
    public function executeDatosPanelTransportistas(sfWebRequest $request) {
        
        $this->nivel = $this->getUser()->getNivelAcceso( self::RUTINACARGASADUANA );
        $user = $this->getUser();
        
        $start=($request->getParameter("start"))?$request->getParameter("fechafinalizacion"):"0";
        
        $this->fechaini=$request->getParameter("fechaini");
        $this->fechafin=$request->getParameter("fechafin");
        
        $this->semanaini=($request->getParameter("semanaini")!="")?$request->getParameter("semanaini"):date("W");
        $this->semanafin=($request->getParameter("semanafin")!="")?$request->getParameter("semanafin"):52;
        
        $this->transportador=$request->getParameter("transportador");        
        $this->origen=$request->getParameter("origen");        
        $this->doctransporte=$request->getParameter("doctransporte");        
        $this->destino=$request->getParameter("destino");        
        $where="";
        
        
        $q = Doctrine_Query::create()
            ->select("t.ca_id,t.ca_semana,t.ca_referencia,t.ca_idcliente,t.ca_volumen,t.ca_piezas,
                      t.ca_peso,t.ca_mercancia,t.ca_origen,t.ca_destino,t.ca_modalidad,t.ca_observaciones, t.ca_fchcreado,
                      t.ca_fchsalida,t.ca_doctransporte,t.ca_escolta,t.ca_vlrventa,t.ca_vlrneta,t.ca_idtransportista,p.ca_sigla as transportador,
                      c.ca_compania as cliente,o.ca_ciudad as origen,d.ca_ciudad as destino")
            ->from('TransporteAdu t')
            ->innerJoin("t.Cliente c")
            ->innerJoin("t.Origen o")
            ->innerJoin("t.Destino d")
            ->leftJoin("t.IdsProveedor p")            
            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        if($this->nivel==1)
        {
            $q->addWhere("t.ca_usucreado = ? ", $user->getUserId());
        }
        
        
        if($this->fechaini!="")
        {
            $q->addWhere("t.ca_fchsalida >= ? ", $this->fechaini);
        }
        
        if($this->fechafin!="")
        {
            $q->addWhere("t.ca_fchsalida <= ? ",$this->fechafin);
        }
        
        if($this->semanaini!="")
        {
            $q->addWhere("t.ca_semana >= ?", $this->semanaini);
        }
        
        if($this->semanafin!="")
        {
            $q->addWhere("t.ca_semana <=? ", $this->semanafin );
        }

        if($this->origen!="")
        {
            $q->addWhere("t.ca_origen=? ", $this->origen);
        }
        
        if($this->destino!="")
        {
            $q->addWhere("t.ca_destino = ? ", $this->destino);
        }
        
        if($this->transportador!="")
        {
            $q->addWhere("t.ca_idtransportista=? ", $this->transportador);
        }
        
        if($this->doctransporte!="")
        {
            $q->addWhere("t.ca_doctransporte= ? ", $this->doctransporte );
        }
        
        $debug= $q->getSqlQuery();
        $cargas = $q->execute();

        foreach ($cargas as $key => $val) {
            $cargas[$key]["idreg"] = utf8_encode($cargas[$key]["t_ca_id"]);
            $cargas[$key]["o_origen"] = utf8_encode($cargas[$key]["o_origen"]);
            $cargas[$key]["d_destino"] = utf8_encode($cargas[$key]["d_destino"]);
            $cargas[$key]["c_cliente"] = utf8_encode($cargas[$key]["c_cliente"]);
            $cargas[$key]["t_ca_mercancia"] = utf8_encode($cargas[$key]["t_ca_mercancia"]);
            $cargas[$key]["t_ca_observaciones"] = utf8_encode($cargas[$key]["t_ca_observaciones"]);
            $cargas[$key]["p_transportador"] = utf8_encode($cargas[$key]["p_transportador"]);
        }
        $cargas[] = array("t_ca_semana" => "+", "orden" => "Z");
        $this->responseArray = array("success" => true, "totalCount" => count($cargas), "rows" => $cargas,"debug"=>$debug);
        $this->setTemplate("responseTemplate");
    }
    
    public function executeGuardarDatosTransportistas(sfWebRequest $request) {
        
        $datos = $request->getParameter("datos");
        $cargas = json_decode($datos);
        $errorInfo="";
        $ids= array();
        foreach($cargas as $t)
        {
            $error="";
          //  try
            {
                if($t->semana=="+")
                    continue;
                if($t->idreg)
                    $transporteAdu = Doctrine::getTable("TransporteAdu")->find($t->idreg);

                if( !$transporteAdu ){
                    $transporteAdu = new TransporteAdu();                    
                }

                $transporteAdu->setCaSemana($t->semana);
                $transporteAdu->setCaReferencia($t->referencia);
                $transporteAdu->setCaIdcliente($t->idcliente);
                if($t->volumen!="")
                    $transporteAdu->setCaVolumen($t->volumen);
                else
                    $transporteAdu->setCaVolumen(0);
                
                if($t->piezas!="")
                    $transporteAdu->setCaPiezas($t->piezas);
                else
                    $transporteAdu->setCaPiezas(0);
                
                if($t->peso!="")
                    $transporteAdu->setCaPeso($t->peso);
                else
                    $transporteAdu->setCaPeso(0);
                
                $transporteAdu->setCaMercancia($t->mercancia);
                $transporteAdu->setCaOrigen($t->idorigen);
                $transporteAdu->setCaDestino($t->iddestino);
                $transporteAdu->setCaModalidad($t->modalidad);
                $transporteAdu->setCaObservaciones($t->observaciones);
                $transporteAdu->setCaFchsalida($t->fchsalida);
                $transporteAdu->setCaDoctransporte($t->doctransporte);
                
                if($t->venta!="")
                    $transporteAdu->setCaVlrventa($t->venta);
                else
                    $transporteAdu->setCaVlrventa(0);
                
                if($t->neta!="")
                    $transporteAdu->setCaVlrneta($t->neta);
                else
                    $transporteAdu->setCaVlrneta(0);
                
                $transporteAdu->setCaEscolta(($t->escolta!="")?true:false);
                
                if($t->idtransportador!="")
                    $transporteAdu->setCaIdtransportista($t->idtransportador);
                else
                    $transporteAdu->setCaIdtransportista(null);

                if($error!="")
                    $errorInfo.="Error en item".utf8_encode($t->item).": ".$error." <br>";
                else
                {
                    $transporteAdu->save();
                    $ids[]=$t->id;
                    $ids_reg[]=$transporteAdu->getCaId();
                }
            }
        }

        $this->responseArray=array("errorInfo"=>$errorInfo,"id"=>  implode(",", $ids),"idreg"=>  implode(",", $ids_reg),  "success"=>true);
        $this->setTemplate("responseTemplate");
    }
    
}