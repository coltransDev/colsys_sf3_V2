<?php

/**
 * reportesGer actions.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reportesGerActions extends sfActions
{
    
    const RUTINA = 105;
	/**
	* Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar 
	*
	* @param sfRequest $request A request object
	*/
	public function executeReporteComisionesVendedor(sfWebRequest $request)
	{
		$this->userid = $this->getUser()->getUserId();	
	}


	public function executeReporteCargaTraficos(sfWebRequest $request)
	{
        
        $response = sfContext::getInstance()->getResponse();		
		$response->addJavaScript("extExtras/SuperBoxSelect",'last');
        
        
		$this->nivel = $this->getUser()->getNivelAcceso( reportesGerActions::RUTINA );
        //echo $this->nivel;
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		if($this->nivel=="1")
        {
        
            $origenes = Doctrine::getTable("TraficoUsers")
                                    ->createQuery("tu")
                                    ->select("tu.*")
									->where("tu.ca_login=? and tu.ca_impo=true",array($this->getUser()->getUserId()) )
                                    ->execute();
			$this->pais_origen="";
			if($origenes)
			{
				foreach($origenes as $origen)
				{
					$this->pais_origen.=($this->pais_origen!="")?",".$origen->getCaIdtrafico():$origen->getCaIdtrafico();
				}
			}
			if($this->pais_origen=="")
			{
				$this->pais_origen="CO-057";
			}
        }
        if($this->nivel=="2")
        {
            $this->pais_origen="todos";
        }
        
			
        
        $this->fechainicial=$request->getParameter("fechaInicial");
        $this->fechafinal=$request->getParameter("fechaFinal");
        $this->fechaembinicial=$request->getParameter("fechaEmbInicial");
        $this->fechaembfinal=$request->getParameter("fechaEmbFinal");
        $this->fechaarrinicial=$request->getParameter("fechaArrInicial");
        $this->fechaarrfinal=$request->getParameter("fechaArrFinal");

        $this->idpais_origen=$request->getParameter("idpais_origen");
        $this->origen=$request->getParameter("origen");
        $this->idorigen=$request->getParameter("idorigen");
        $this->idpais_destino=$request->getParameter("idpais_destino");
        $this->destino=$request->getParameter("destino");
        $this->iddestino=$request->getParameter("iddestino");
        $this->idmodalidad=$request->getParameter("idmodalidad");
        $this->opcion=$request->getParameter("opcion");
        $this->idlinea=$request->getParameter("idlinea");
        $this->linea=$request->getParameter("linea");        
        $this->incoterms=$request->getParameter("incoterms");

        $this->idagente=$request->getParameter("idagente");
        $this->agente=$request->getParameter("agente");
        $this->idsucursalagente=$request->getParameter("idsucursalagente");
        $this->sucursalagente=$request->getParameter("sucursalagente");
        
        $this->idcliente=$request->getParameter("idcliente");
        $this->cliente=$request->getParameter("cliente");

        if($this->opcion)
        {
            
            if($this->idmodalidad)
                $where.=" and m.ca_modalidad='".$this->idmodalidad."'";

            if($this->fechainicial && $this->fechafinal)
                    $where.=" and (m.ca_fchreferencia between '".$this->fechainicial."' and '".$this->fechafinal."')";
            if($this->fechaembinicial && $this->fechaembfinal)
                    $where.=" and (m.ca_fchembarque between '".$this->fechaembinicial."' and '".$this->fechaembfinal."')";
            if($this->fechaarrinicial && $this->fechaarrfinal)
                    $where.=" and (m.ca_fcharribo between '".$this->fechaarrinicial."' and '".$this->fechaarrfinal."')";
            
            if($this->idpais_origen)
                $where.=" and ori.ca_idtrafico='".$this->idpais_origen."'";
            else if($this->nivel=="1")
            {
                $paises="";
                $pais_origen=explode(",", $this->pais_origen);
                foreach($pais_origen as $pais)
                {
                    $paises.=($paises!="")?","."'".$pais."'":"'".$pais."'";
                }
                $where.=" and ori.ca_idtrafico in (".$paises.")";
            }
            if($this->idorigen)
                $where.=" and m.ca_origen='".$this->idorigen."'";
            if($this->idpais_destino)
                $where.=" and des.ca_idtrafico='".$this->idpais_destino."'";
            if($this->iddestino)
                $where.=" and m.ca_destino='".$this->iddestino."'";
            if($this->idlinea)
                $where.=" and m.ca_idlinea='".$this->idlinea."'";

            $joinreportes="JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            $joinclientes="";
            if($this->incoterms && count($this->incoterms)>0)
            {                
                $where.=" and (";
                foreach ($this->incoterms as $key => $inco)                    
                {
                    if($key>0)
                        $where.=" or ";
                    $where.=" r.ca_incoterms like '".$inco."%'";
                }
                $where.=" )";
                $joinreportes="JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
             }

            if($this->idagente)
            {
                $joinreportes="JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idagente = '".$this->idagente."'";
            }
            
            
            if($this->idsucursalagente)
            {
                $joinreportes="JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idsucursalagente = '".$this->idsucursalagente."'";
            }
            
            if($this->idcliente)
            {
                $joinreportes="JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $joinclientes="JOIN tb_concliente cc ON cc.ca_idcontacto=r.ca_idconcliente";
                $where.=" and cc.ca_idcliente = '".$this->idcliente."'";
            }
            
    $sql="SELECT m.ca_referencia, tt.ca_concepto,tt.ca_idconcepto, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, tra_ori.ca_idtrafico AS ori_ca_idtrafico, tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum
           FROM tb_inoequipos_sea eq
      JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
        WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
     
     ( SELECT count(*) AS count
           FROM tb_inoequipos_sea eq
          WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
    count(DISTINCT c.ca_hbls) AS nhbls,
    sum(c.ca_numpiezas) piezas,
	sum(c.ca_peso) peso,
	sum(c.ca_volumen) volumen

    FROM tb_inomaestra_sea m
    JOIN tb_inoclientes_sea c ON c.ca_referencia = m.ca_referencia
    $joinreportes
    $joinclientes
    JOIN tb_inoequipos_sea e ON e.ca_referencia = m.ca_referencia
    JOIN tb_conceptos tt ON e.ca_idconcepto = tt.ca_idconcepto   
    JOIN ids.tb_proveedores p ON p.ca_idproveedor = m.ca_idlinea
    JOIN ids.tb_ids ids ON p.ca_idproveedor = ids.ca_id
    JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
    JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
    JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
    JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
   
    WHERE date_part('year', m.ca_fchreferencia) > (date_part('year', m.ca_fchreferencia) - 2)  
    $where
    group by m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum
           FROM tb_inoequipos_sea eq
      JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
     WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
     
    ( SELECT count(*) AS count
           FROM tb_inoequipos_sea eq
          WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)
    ORDER BY m.ca_fchreferencia";            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }
		
	}
    
    public function executeEstadisticasTraficos(sfWebRequest $request)
	{
        $this->opcion=$request->getParameter("opcion");
        $this->mes=  Utils::parseDate($request->getParameter("fechaFinal"),"m");
        $this->fechafinal=Utils::addDate( Utils::addDate($request->getParameter("fechaFinal"), 0, 1, 0, "Y-m-01"),-1);

        $this->fechainicial=  Utils::addDate(Utils::addDate($this->fechafinal, 1, 0, 0,"Y-m-01"),0,-3,0,"Y-m-d");
        
        $this->fechainicial1=   Utils::addDate($request->getParameter("fechaInicial"),0,0,-1);
        $this->fechafinal1=     Utils::addDate($this->fechafinal,0,0,-1);
        
        $this->fechainicial2=   Utils::addDate($request->getParameter("fechaInicial"),0,0,-2);
        $this->fechafinal2=     Utils::addDate($this->fechafinal,0,0,-2);
		//$this->userid = $this->getUser()->getUserId();	
        if($this->opcion)
        {
            $this->nmeses=3;//ceil(Utils::diffTime($this->fechainicial,$this->fechafinal)/720);                        
            $sql="select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen from vi_reportes_estadisticas where ca_fchreporte between '".$this->fechainicial."' and '".$this->fechafinal."' and ca_sucursal='Bogotá D.C.'
                group by ca_year,ca_mes,ca_traorigen
                order by 4,2,3";
            //echo "<br>".$sql;
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            $origen="";
            $this->grid= array();
            $this->totales= array();
            foreach($this->resul as $r)
            {
                $this->grid[$r["origen"]][$r["ca_year"]."-".$r["ca_mes"]]=$r["valor"];
                $this->totales[$r["ca_year"]."-".$r["ca_mes"]]+=$r["valor"];
            }
            
            $sql="select count(*) as valor,ca_traorigen as origen,ca_year from vi_reportes_estadisticas 
            where (ca_fchreporte between '".  (Utils::parseDate($this->fechafinal,"Y").'-01-01')."' and '".$this->fechafinal."' or ca_fchreporte between '".  (Utils::parseDate($this->fechafinal1,"Y").'-01-01')."' and '".$this->fechafinal1."' or ca_fchreporte between '".  (Utils::parseDate($this->fechafinal2,"Y").'-01-01')."' and '".$this->fechafinal2."') and ca_sucursal='Bogotá D.C.'
            group by ca_traorigen,ca_year order by 2,3,1";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();
            
            $this->gridCompara= array();
            $this->totalesCompara= array();
            foreach($this->compara as $r)
            {
                $this->gridCompara[$r["origen"]][$r["ca_year"]]=$r["valor"];
                $this->totalesCompara[$r["ca_year"]]+=$r["valor"];
            }            
            

            $sql="select count(*) as valor,ca_traorigen as origen,ca_nombre_cli as cliente 
                from vi_reportes_estadisticas 
                where ca_fchreporte between '".Utils::parseDate($this->fechainicial,"Y-01-01")."' and '".$this->fechafinal."' and ca_sucursal='Bogotá D.C.'
                group by ca_traorigen,ca_nombre_cli
                order by 2 ,1 desc";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();
            
            
            $this->gridClientes= array();   
            $this->totalesCliente= array();
            foreach($this->clientes as $r)
            {
                $this->gridClientes[$r["origen"]][$r["cliente"]]["totales"]=$r["valor"];
                $this->totalesCliente[$r["origen"]]["totales"]+=$r["valor"];
                $this->totalesCliente["totales"]["totales"]+=$r["valor"];
            }
            
            
            $sql="select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen ,ca_nombre_cli as cliente 
                from vi_reportes_estadisticas 
                where ca_fchreporte between '".Utils::parseDate($this->fechainicial,"Y-01-01")."' and '".$this->fechafinal."' and ca_sucursal='Bogotá D.C.'
                group by ca_year,ca_mes,ca_traorigen,ca_nombre_cli
                order by 4,2,3,5";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();
            
                         
            foreach($this->clientes as $r)
            {
                $this->gridClientes[$r["origen"]][$r["cliente"]][$r["ca_year"]."-".$r["ca_mes"]]=$r["valor"];
                $this->totalesCliente[$r["origen"]][$r["ca_year"]."-".$r["ca_mes"]]+=$r["valor"];
                $this->totalesCliente["totales"][$r["ca_year"]."-".$r["ca_mes"]]+=$r["valor"];
            }
            
            
             $sql="select count(*) as valor,ca_year,ca_mes,ca_login as vendedor
                from vi_reportes_estadisticas 
                where ca_fchreporte between '".Utils::parseDate($this->fechainicial,"Y-01-01")."' and '".$this->fechafinal."' and ca_sucursal='Bogotá D.C.'
                group by ca_year,ca_mes,ca_login
                order by 4";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            
            $this->clientes = $st->fetchAll();

            $this->gridVendedores= array();   
            $this->totalesVendedores= array();
            foreach($this->clientes as $r)
            {
                $this->gridVendedores[$r["vendedor"]][$r["ca_year"]."-".$r["ca_mes"]]=$r["valor"];
                $this->gridVendedores[$r["vendedor"]]["totales"]+=$r["valor"];
                $this->totalesVendedores[$r["ca_year"]."-".$r["ca_mes"]]+=$r["valor"];
                $this->totalesVendedores["totales"]+=$r["valor"];
            }
            
            $this->fechainicial2=(Utils::parseDate($this->fechafinal,"Y").'-01-01');
//            echo $this->fechainicial. "  " . $this->fechainicial2. "   ". $this->fechafinal;
            //exit;
//            echo "<pre>";print_r($this->gridClientes);echo "</pre>";
//            echo "<pre>";print_r($this->compara);echo "</pre>";
            
//            exit;
        }
	}
    
}
?>