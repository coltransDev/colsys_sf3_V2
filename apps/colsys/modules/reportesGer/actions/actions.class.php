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
}
?>