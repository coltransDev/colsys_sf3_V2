<?php

/**
 * reportesGer actions.
 *
 * @package    colsys
 * @subpackage reportesGer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class reportesGerActions extends sfActions {
    const RUTINA = 105;
    const ESTADISTICAS = 129;
    
    /**
     * Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }
    
    /**
     * Muestra un menu donde el usuario puede seleccionar las comisiones que desa sacar
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteComisionesVendedor(sfWebRequest $request) {
        $this->userid = $this->getUser()->getUserId();
    }

    public function executeReporteCargaTraficos(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');


        $this->nivel = $this->getUser()->getNivelAcceso(reportesGerActions::RUTINA);
        //echo $this->nivel;
        if ($this->nivel == -1) {
            $this->forward404();
        }
        if ($this->nivel == "1") {

            $origenes = Doctrine::getTable("TraficoUsers")
                            ->createQuery("tu")
                            ->select("tu.*")
                            ->where("tu.ca_login=? and tu.ca_impo=true", array($this->getUser()->getUserId()))
                            ->execute();
            $this->pais_origen = "";
            if ($origenes) {
                foreach ($origenes as $origen) {
                    $this->pais_origen.= ( $this->pais_origen != "") ? "," . $origen->getCaIdtrafico() : $origen->getCaIdtrafico();
                }
            }
            if ($this->pais_origen == "") {
                $this->pais_origen = "CO-057";
            }
        }
        if ($this->nivel == "2") {
            $this->pais_origen = "todos";
        }



        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->fechaembinicial = $request->getParameter("fechaEmbInicial");
        $this->fechaembfinal = $request->getParameter("fechaEmbFinal");
        $this->fechaarrinicial = $request->getParameter("fechaArrInicial");
        $this->fechaarrfinal = $request->getParameter("fechaArrFinal");

        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->origen = $request->getParameter("origen");
        $this->idorigen = $request->getParameter("idorigen");
        $this->idpais_destino = $request->getParameter("idpais_destino");
        $this->destino = $request->getParameter("destino");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->opcion = $request->getParameter("opcion");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");
        $this->incoterms = $request->getParameter("incoterms");

        $this->idagente = $request->getParameter("idagente");
        $this->agente = $request->getParameter("agente");
        $this->idsucursalagente = $request->getParameter("idsucursalagente");
        $this->sucursalagente = $request->getParameter("sucursalagente");

        $this->idcliente = $request->getParameter("idcliente");
        $this->cliente = $request->getParameter("cliente");
        $this->proyectos = ($request->getParameter("proyectos"))?TRUE:FALSE;

        if ($this->opcion) {

            if ($this->idmodalidad)
                $where.=" and m.ca_modalidad='" . $this->idmodalidad . "'";

            if ($this->fechainicial && $this->fechafinal)
                $where.=" and (m.ca_fchreferencia between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
            if ($this->fechaembinicial && $this->fechaembfinal)
                $where.=" and (m.ca_fchembarque between '" . $this->fechaembinicial . "' and '" . $this->fechaembfinal . "')";
            if ($this->fechaarrinicial && $this->fechaarrfinal)
                $where.=" and (m.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";

            if ($this->idpais_origen)
                $where.=" and ori.ca_idtrafico='" . $this->idpais_origen . "'";
            else if ($this->nivel == "1") {
                $paises = "";
                $pais_origen = explode(",", $this->pais_origen);
                foreach ($pais_origen as $pais) {
                    $paises.= ( $paises != "") ? "," . "'" . $pais . "'" : "'" . $pais . "'";
                }
                $where.=" and ori.ca_idtrafico in (" . $paises . ")";
            }
            if ($this->idorigen)
                $where.=" and m.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where.=" and des.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where.=" and m.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where.=" and m.ca_idlinea='" . $this->idlinea . "'";
            if (!$this->proyectos)
                $where.=" and m.ca_modalidad NOT IN ('PROYECTOS','PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            else
                $where.=" and m.ca_modalidad NOT IN ('PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            
            $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            $joinclientes = "";
            if ($this->incoterms && count($this->incoterms) > 0) {
                $where.=" and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0)
                        $where.=" or ";
                    $where.=" r.ca_incoterms like '" . $inco . "%'";
                }
                $where.=" )";
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            }

            if ($this->idagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idagente = '" . $this->idagente . "'";
            }


            if ($this->idsucursalagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idsucursalagente = '" . $this->idsucursalagente . "'";
            }

            if ($this->idcliente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $joinclientes = "JOIN tb_concliente cc ON cc.ca_idcontacto=r.ca_idconcliente";
                $where.=" and cc.ca_idcliente = '" . $this->idcliente . "'";
            }

            $sql = "SELECT tt.ca_liminferior,m.ca_referencia, tt.ca_concepto,tt.ca_idconcepto, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, tra_ori.ca_idtrafico AS ori_ca_idtrafico, tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum
           FROM tb_inoequipos_sea eq
      JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
        WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
     
     ( SELECT count(*) AS count
           FROM tb_inoequipos_sea eq
          WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
    count(DISTINCT c.ca_hbls) AS nhbls,
    ( SELECT sum(ca_peso) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS peso, 
( SELECT sum(ca_numpiezas) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS piezas, 
( SELECT sum(ca_volumen) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text ) AS volumen

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
    group by tt.ca_liminferior,m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum
           FROM tb_inoequipos_sea eq
      JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
     WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
     
    ( SELECT count(*) AS count
           FROM tb_inoequipos_sea eq
          WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)
    ORDER BY m.ca_fchreferencia";
            $con = Doctrine_Manager::getInstance()->connection();
            // echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }
        
        if (count($this->incoterms)<= 0) {
            $this->incoterms=array();
        }
    }
    
    public function executeReporteCargaTraficos2(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');

        $this->nivel = $this->getUser()->getNivelAcceso(reportesGerActions::RUTINA);
        //echo $this->nivel;
        /*if ($this->nivel == -1) {
            $this->forward404();
        }
        if ($this->nivel == "1") {

            $origenes = Doctrine::getTable("TraficoUsers")
                            ->createQuery("tu")
                            ->select("tu.*")
                            ->where("tu.ca_login=? and tu.ca_impo=true", array($this->getUser()->getUserId()))
                            ->execute();
            $this->pais_origen = "";
            if ($origenes) {
                foreach ($origenes as $origen) {
                    $this->pais_origen.= ( $this->pais_origen != "") ? "," . $origen->getCaIdtrafico() : $origen->getCaIdtrafico();
                }
            }
            if ($this->pais_origen == "") {                
                //$this->pais_origen = "CO-057";
                $this->pais_origen = $this->getUser()->getIdtrafico();
            }
        }
        if ($this->nivel == "2") {
            $this->pais_origen = "todos";
        }*/
        $this->pais_origen = "todos";

        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->fechaembinicial = $request->getParameter("fechaEmbInicial");
        $this->fechaembfinal = $request->getParameter("fechaEmbFinal");
        $this->fechaarrinicial = $request->getParameter("fechaArrInicial");
        $this->fechaarrfinal = $request->getParameter("fechaArrFinal");

        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->origen = $request->getParameter("origen");
        $this->idorigen = $request->getParameter("idorigen");
        $this->idpais_destino = $request->getParameter("idpais_destino");
        $this->destino = $request->getParameter("destino");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->impoexpo = $request->getParameter("impoexpo");
        $this->opcion = $request->getParameter("opcion");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");
        $this->incoterms = $request->getParameter("incoterms");

        $this->idagente = $request->getParameter("idagente");
        $this->agente = $request->getParameter("agente");
        $this->idsucursalagente = $request->getParameter("idsucursalagente");
        $this->sucursalagente = $request->getParameter("sucursalagente");

        $this->idcliente = $request->getParameter("idcliente");
        $this->cliente = $request->getParameter("cliente");
        $this->proyectos = ($request->getParameter("proyectos"))?TRUE:FALSE;

        if ($this->opcion) {

            if ($this->idmodalidad)
                $where.=" and m.ca_modalidad='" . $this->idmodalidad . "'";
            if ($this->fechainicial && $this->fechafinal)
                $where.=" and (m.ca_fchreferencia between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
            if ($this->fechaembinicial && $this->fechaembfinal)
                $where.=" and (m.ca_fchsalida between '" . $this->fechaembinicial . "' and '" . $this->fechaembfinal . "')";
            if ($this->fechaarrinicial && $this->fechaarrfinal)
                $where.=" and (m.ca_fchllegada between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
            if ($this->idpais_origen)
                $where.=" and ori.ca_idtrafico='" . $this->idpais_origen . "'";
            else if ($this->nivel == "1") {
                $paises = "";
                $pais_origen = explode(",", $this->pais_origen);
                foreach ($pais_origen as $pais) {
                    $paises.= ( $paises != "") ? "," . "'" . $pais . "'" : "'" . $pais . "'";
                }
                $where.=" and ori.ca_idtrafico in (" . $paises . ")";
            }
            if ($this->idorigen)
                $where.=" and m.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where.=" and des.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where.=" and m.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where.=" and m.ca_idlinea='" . $this->idlinea . "'";
            if ($this->impoexpo)
                $where.=" and m.ca_impoexpo='" . $this->impoexpo . "'";
            if (!$this->proyectos)
                $where.=" and m.ca_modalidad NOT IN ('PROYECTOS','PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            else
                $where.=" and m.ca_modalidad NOT IN ('PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            
            $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            $joinclientes = "";
            if ($this->incoterms && count($this->incoterms) > 0) {
                $where.=" and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0)
                        $where.=" or ";
                    $where.=" r.ca_incoterms like '" . $inco . "%'";
                }
                $where.=" )";
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            }

            if ($this->idagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idagente = '" . $this->idagente . "'";
            }

            if ($this->idsucursalagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where.=" and r.ca_idsucursalagente = '" . $this->idsucursalagente . "'";
            }

            if ($this->idcliente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $joinclientes = "JOIN tb_concliente cc ON cc.ca_idcontacto=r.ca_idconcliente";
                $where.=" and cc.ca_idcliente = '" . $this->idcliente . "'";
            }
                
            $sql = "SELECT tt.ca_liminferior,m.ca_referencia, tt.ca_concepto,tt.ca_idconcepto, m.ca_fchsalida, m.ca_fchllegada, 
	m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, 	
	tra_ori.ca_idtrafico AS ori_ca_idtrafico, tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, 
	tra_des.ca_nombre AS des_ca_nombre, m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum FROM ino.tb_equipos eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
	( SELECT count(*) AS count FROM ino.tb_equipos eq WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
	count(DISTINCT c.ca_doctransporte) AS nhbls, 
	( SELECT sum(ca_peso) AS count FROM ino.tb_house ics WHERE ics.ca_idmaster = m.ca_idmaster ) AS peso, 
	( SELECT sum(ca_numpiezas) AS count FROM ino.tb_house ics WHERE ics.ca_idmaster = m.ca_idmaster ) AS piezas, 
	( SELECT sum(ca_volumen) AS count FROM ino.tb_house ics WHERE ics.ca_idmaster = m.ca_idmaster ) AS volumen, 
md.ca_idmodo,m.ca_idmaster

    FROM ino.tb_master m
    JOIN ino.tb_house c ON c.ca_idmaster = m.ca_idmaster
    JOIN tb_modos md ON m.ca_impoexpo=md.ca_impoexpo and m.ca_transporte=md.ca_transporte
    $joinreportes
    $joinclientes
    JOIN ino.tb_equipos e ON e.ca_idmaster = m.ca_idmaster
    JOIN tb_conceptos tt ON e.ca_idconcepto = tt.ca_idconcepto   
    JOIN ids.tb_proveedores p ON p.ca_idproveedor = m.ca_idlinea
    JOIN ids.tb_ids ids ON p.ca_idproveedor = ids.ca_id
    JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
    JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
    JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
    JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
   
    WHERE date_part('year', m.ca_fchreferencia) > (date_part('year', m.ca_fchreferencia) - 2)  
    $where

    group by tt.ca_liminferior,m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchsalida, m.ca_fchllegada, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
    (( SELECT sum(t.ca_liminferior) AS sum FROM ino.tb_equipos eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
	( SELECT count(*) AS count FROM ino.tb_equipos eq WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto) , 
    md.ca_idmodo,m.ca_idmaster
    ORDER BY m.ca_fchreferencia";
            $con = Doctrine_Manager::getInstance()->connection();
            //echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }
        
    if (count($this->incoterms)<= 0) {
        $this->incoterms=array();
    }
    }
    
    public function executeEstadisticasMaritimo(sfWebRequest $request) {
        

        $this->opcion = $request->getParameter("opcion");
        $this->year = ($request->getParameter("year")!="")?$request->getParameter("year"):date("Y");
        $this->mes = $request->getParameter("mes");
        $this->nmes = $request->getParameter("nmes");
        
        $this->meses = array();
        $this->meses[]=array("valor"=>"a-Enero"       ,"id"=>1);
        $this->meses[]=array("valor"=>"b-Febrero"     ,"id"=>2);
        $this->meses[]=array("valor"=>"c-Marzo"       ,"id"=>3);
        $this->meses[]=array("valor"=>"d-Abril"       ,"id"=>4);
        $this->meses[]=array("valor"=>"e-Mayo"        ,"id"=>5);
        $this->meses[]=array("valor"=>"f-Junio"       ,"id"=>6);
        $this->meses[]=array("valor"=>"g-Julio"       ,"id"=>7);
        $this->meses[]=array("valor"=>"h-Agosto"      ,"id"=>8);
        $this->meses[]=array("valor"=>"i-Septiembre"  ,"id"=>9);
        $this->meses[]=array("valor"=>"j-Octubre"     ,"id"=>10);
        $this->meses[]=array("valor"=>"k-Noviembre"   ,"id"=>11);
        $this->meses[]=array("valor"=>"l-Diciembre"   ,"id"=>12);

        foreach ($traficos_rs as $trafico) {
            $row = array("id" => $trafico->getCaIdTrafico(), "valor" => $trafico->getCaNombre());
            $this->traficos[] = $row;
        }
        
        
        if ($this->opcion) {

            if ($this->year!="")
                $where.=" and ca_ano in (".($this->year).",".($this->year-1).")";
            
            if (count($this->nmes)>0)
            {
               $this->nmes = array_diff($this->nmes, array(""));
                if( $this->nmes[0]!="" )                    
                    $where.=" and ca_mes::integer in (".(implode (",", $this->nmes)).")";
            }
                //$where.=" and ca_ano in (" . $this->year. ",".($this->year-1).")";

/*            $sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_lcl where 1=1 and ca_impoexpo='".constantes::IMPO."' and ca_trafico='05' $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";*/
            $sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_volumen) as ca_volumen, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_lcl where 1=1  $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
            //echo $sql;
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->lcl = $st->fetchAll();
            //echo "<pre>";print_r($this->lcl);echo "</pre>";
            /*$sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_fcl where 1=1 and ca_impoexpo='".constantes::IMPO."' and ca_trafico='05' $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
             * 
             */
            $sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_fcl where 1=1  $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
                        
            $st = $con->execute($sql);
            $this->fcl = $st->fetchAll();
            //echo "<pre>";print_r($this->fcl);echo "</pre>";
            $this->grid=array();
            $this->puertos=array("Barranquilla","Buenaventura","Cartagena","Santa Marta","Otros");
            $this->grid["destino"]["Barranquilla"]=array();
            
            $this->grid["destino"]["Buenaventura"]=array();
            $this->grid["destino"]["Cartagena"]=array();
            $this->grid["destino"]["Santa Marta"]=array();
            $this->grid["destino"]["Otros"]=array();
            foreach($this->lcl as $l)
            {             
                if(!in_array($l["ca_ciudestino"],$this->puertos))
                {
                    $l["ca_ciudestino"]="Otros";
                }
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_volumen"]   += (int)$l["ca_volumen"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_20pies"]    += (int)$l["ca_20pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_teus"]      += (int)$l["ca_teus"];                
                
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_volumen"]    += (int)$l["ca_volumen"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_20pies"]    += (int)$l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_teus"]      += (int)$l["ca_teus"];
                
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_volumen"]    += (int)$l["ca_volumen"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_20pies"]    += (int)$l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_teus"]      += (int)$l["ca_teus"];
                
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_volumen"] += (int)$l["ca_volumen"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_20pies"] += (int)$l["ca_20pies"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_40pies"] += (int)$l["ca_40pies"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_teus"] += (int)$l["ca_teus"];                
            }
            
            foreach($this->fcl as $l)
            {                
                if(!in_array($l["ca_ciudestino"],$this->puertos))
                {
                    $l["ca_ciudestino"]="Otros";
                }
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_20pies"]    += (int)$l["ca_20pies"];    
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_teus"]      += (int)$l["ca_teus"];
                
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_20pies"]    += (int)$l["ca_20pies"];    
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_teus"]      += (int)$l["ca_teus"];
                
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_20pies"]    += (int)$l["ca_20pies"];    
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_teus"]      += (int)$l["ca_teus"];
                
                
                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_20pies"]    += (int)$l["ca_20pies"];    
                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_40pies"]    += (int)$l["ca_40pies"];
                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_teus"]      += (int)$l["ca_teus"];                
            }
            //echo "<pre>";print_r($this->grid["origen"]);echo "</pre>";
        }
    }

    public function executeEstadisticasTraficos(sfWebRequest $request) {
        $this->opcion = $request->getParameter("opcion");
        //list($nom_mes, $ano) = explode("-", $request->getParameter("fechaFinal"));
        //list(,$this->mes, $ano) = explode("-", $request->getParameter("fechaFinal"));
        list($ano,$this->mes, $dia) = explode("-", $request->getParameter("fechaFinal"));

        //$this->mes = Utils::nmes($nom_mes);
        $this->idsucursal = $request->getParameter("idsucursal");
        $this->departamento = $request->getParameter("departamento");
        $this->iddepartamento = $request->getParameter("iddepartamento");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        $this->fechafinal = Utils::addDate(Utils::addDate($ano . "-" . $this->mes . "-01", 0, 1, 0, "Y-m-01"), -1);

        $this->fechainicial = Utils::addDate(Utils::addDate($this->fechafinal, 1, 0, 0, "Y-m-01"), 0, -3, 0, "Y-m-d");

        $this->fechainicial1 = Utils::addDate($request->getParameter("fechaInicial"), 0, 0, -1);
        $this->fechafinal1 = Utils::addDate($this->fechafinal, 0, 0, -1);

        $this->fechainicial2 = Utils::addDate($request->getParameter("fechaInicial"), 0, 0, -2);
        $this->fechafinal2 = Utils::addDate($this->fechafinal, 0, 0, -2);

        if ($this->opcion) {

            if ($this->idsucursal)
            {
                if($this->idsucursal=="BOG")
                    $where .= " and ca_idsucursal in('" . $this->idsucursal . "','ABO')";
                else
                    $where .= " and ca_idsucursal='" . $this->idsucursal . "'";
            }
            if($this->departamento=="Cuentas Globales")
                $where .= " and ca_idcliente in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            else if($this->departamento=="Tráficos")                
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            else if($this->departamento=="Aéreo")
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            if($this->transporte)
                $where .= " and ca_transporte ='".$this->transporte."'";
            
            $this->nmeses = 3;
            $tra_principal="'Alemania','Argentina','Belgica','Brasil','Chile','China','España','Estados Unidos','Inglaterra', 'Italia', 'Mexico','Taiwan'";
            
            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
                group by ca_year,ca_mes,ca_traorigen
                order by 4,2,3";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            $origen = "";
            $this->grid = array();
            $this->totales = array();
            foreach ($this->resul as $r) {
                $this->grid[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totales[$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
            }
            
            $sql = "select count(*) as valor,ca_year,ca_mes,ca_ciuorigen as origen from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_ciuorigen='Shanghai'
                group by ca_year,ca_mes,ca_ciuorigen
                order by 4,2,3";
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            $origen = "";
            foreach ($this->resul as $r) {
                $this->grid[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totales[$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_traorigen not in ($tra_principal)
                group by ca_year,ca_mes,ca_traorigen
                order by 4,2,3";
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            $origen = "";
            $this->grid_s = array();
            $this->totales = array();
            foreach ($this->resul as $r) {
                $this->grid_s[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totales_s[$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_traorigen as origen,ca_year from vi_reportes_estadisticas
            where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal, "Y") . '-01-01') . "' and '" . $this->fechafinal . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
            group by ca_traorigen,ca_year order by 2,3,1";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            $this->gridCompara = array();
            $this->totalesCompara = array();
            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]]+=$r["valor"];
            }
            
            $sql = "select count(*) as valor,ca_ciuorigen as origen,ca_year from vi_reportes_estadisticas
            where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal, "Y") . '-01-01') . "' and '" . $this->fechafinal . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_ciuorigen='Shanghai'
            group by ca_ciuorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();
            
            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]]+=$r["valor"];
            }
            
            $sql = "select count(*) as valor,ca_traorigen as origen,ca_year from vi_reportes_estadisticas
            where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal, "Y") . '-01-01') . "' and '" . $this->fechafinal . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_traorigen not in ($tra_principal) 
            group by ca_traorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            $this->gridCompara_s = array();
            $this->totalesCompara_s = array();
            foreach ($this->compara as $r) {
                $this->gridCompara_s[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara_s[$r["ca_year"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_traorigen as origen,ca_nombre_cli as cliente
                from vi_reportes_estadisticas 
                where ca_fchreporte between '" . Utils::parseDate($this->fechainicial, "{$ano}-01-01") . "' and '" . $this->fechafinal . "' $where
                group by ca_traorigen,ca_nombre_cli
                order by 2 ,1 desc";
            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();

            $this->gridClientes = array();
            $this->totalesCliente = array();
            foreach ($this->clientes as $r) {
                $this->gridClientes[$r["origen"]][$r["cliente"]]["totales"] = $r["valor"];
                $this->totalesCliente[$r["origen"]]["totales"]+=$r["valor"];
                $this->totalesCliente["totales"]["totales"]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen ,ca_nombre_cli as cliente
                from vi_reportes_estadisticas 
                where ca_fchreporte between '" . Utils::parseDate($this->fechainicial, "{$ano}-01-01") . "' and '" . $this->fechafinal . "' $where
                group by ca_year,ca_mes,ca_traorigen,ca_nombre_cli
                order by 4,2,3,5";
            //echo "<br>".$sql;
            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();

            foreach ($this->clientes as $r) {
                $this->gridClientes[$r["origen"]][$r["cliente"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totalesCliente[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
                $this->totalesCliente["totales"][$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_login as vendedor
                from vi_reportes_estadisticas 
                where ca_fchreporte between '" . Utils::parseDate($this->fechainicial, "{$ano}-01-01") . "' and '" . $this->fechafinal . "' $where
                group by ca_year,ca_mes,ca_login
                order by 4";
            //echo "<br>".$sql;
            $st = $con->execute($sql);

            $this->clientes = $st->fetchAll();

            $this->gridVendedores = array();
            $this->totalesVendedores = array();
            foreach ($this->clientes as $r) {
                $this->gridVendedores[$r["vendedor"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->gridVendedores[$r["vendedor"]]["totales"]+=$r["valor"];
                $this->totalesVendedores[$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
                $this->totalesVendedores["totales"]+=$r["valor"];
            }

            $this->fechainicial2 = (Utils::parseDate($this->fechafinal, "Y") . '-01-01');
//            echo $this->fechainicial. "  " . $this->fechainicial2. "   ". $this->fechafinal;
            //exit;
//            echo "<pre>";print_r($this->gridClientes);echo "</pre>";
//            echo "<pre>";print_r($this->compara);echo "</pre>";
//            exit;
        }
    }

    public function executeReporteCargaEnContinuacion(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');

        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->fechaembinicial = $request->getParameter("fechaEmbInicial");
        $this->fechaembfinal = $request->getParameter("fechaEmbFinal");
        $this->fechaarrinicial = $request->getParameter("fechaArrInicial");
        $this->fechaarrfinal = $request->getParameter("fechaArrFinal");

        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->origen = $request->getParameter("origen");
        $this->idorigen = $request->getParameter("idorigen");
        $this->idpais_destino = $request->getParameter("idpais_destino");
        $this->destino = $request->getParameter("destino");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->opcion = $request->getParameter("opcion");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");
        $this->incoterms = $request->getParameter("incoterms");

        $this->idcliente = $request->getParameter("idcliente");
        $this->sucursal = $request->getParameter("sucursal");
        $where="";
        $where1.="and ca_version=( SELECT max(rr.ca_version) AS max
           FROM tb_reportes rr
          WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";

        if ($this->opcion) {

            if ($this->idmodalidad)
            {
                if($this->idmodalidad=="LCL")
                {
                    $where.=" and m.ca_modalidad in ('" . $this->idmodalidad . "','".Constantes::COLOADING."')";
                    $where1.=" and r.ca_modalidad in ('" . $this->idmodalidad . "','".Constantes::COLOADING."')";
                }
                else
                {
                    $where.=" and m.ca_modalidad='" . $this->idmodalidad . "'";
                    $where1.=" and r.ca_modalidad='" . $this->idmodalidad . "'";
                }
            }
            
            if ($this->fechaarrinicial && $this->fechaarrfinal)
            {
                $where.=" and (m.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
                $where1.=" and (o.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
            }
            if ($this->idorigen)
            {
                $where.=" and m.ca_destino='" . $this->idorigen . "'";
                $where1.=" and r.ca_origen='" . $this->idorigen . "'";
            }
            if ($this->iddestino)
            {
                $where.=" and r.ca_continuacion_dest='" . $this->iddestino . "'";
                $where1.=" and r.ca_destino='" . $this->iddestino . "'";
            }
            if ($this->idlinea)
            {
                $where.=" and m.ca_idlinea='" . $this->idlinea . "'";
                $where1.=" and r.ca_idlinea='" . $this->idlinea . "'";
            }

            if ($this->incoterms && count($this->incoterms) > 0) {

                $where.=" and (";
                $where1.=" and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0)
                    {
                        $where.=" or ";
                        $where1.=" or ";
                    }
                    $where.=" r.ca_incoterms like '" . $inco . "%'";
                    $where1.=" r.ca_incoterms like '" . $inco . "%'";
                }
                $where.=" )";
                $where1.=" )";
            }

            if ($this->idcliente)
                $where.=" and c.ca_idcliente = '" . $this->idcliente . "'";

            if ($this->sucursal)
            {
                $where.=" and u.ca_sucursal = '" . $this->sucursal . "'";
                $where1.=" and u.ca_sucursal = '" . $this->sucursal . "'";
            }

            $sql = "SELECT m.ca_referencia, cl.ca_compania, u.ca_sucursal, c.ca_hbls, r.ca_consecutivo, r.ca_seguro, r.ca_colmas, b1.ca_nombre as ca_bodega, t.ca_nombre as ca_operador, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, tra_ori.ca_idtrafico AS ori_ca_idtrafico, tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, m.ca_modalidad, desfin.ca_ciudad AS desfin_ca_ciudad,
                count(DISTINCT c.ca_hbls) AS nhbls,
                (c.ca_numpiezas) piezas,
                    (c.ca_peso) peso,
                    (c.ca_volumen) volumen
                FROM tb_inomaestra_sea m
                JOIN tb_inoclientes_sea c ON c.ca_referencia = m.ca_referencia
                JOIN vi_clientes_reduc cl ON c.ca_idcliente = cl.ca_idcliente
                JOIN vi_usuarios u ON c.ca_login = u.ca_login
                JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte
                JOIN tb_bodegas b1 ON r.ca_idbodega = b1.ca_idbodega
                JOIN tb_terceros t ON r.ca_idconsignatario = t.ca_idtercero
                JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
                JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                JOIN tb_ciudades desfin ON desfin.ca_idciudad = r.ca_continuacion_dest
                JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
                WHERE date_part('year', m.ca_fchreferencia) > (date_part('year', m.ca_fchreferencia) - 2) and r.ca_continuacion = 'OTM'
                $where
                group by m.ca_referencia, cl.ca_compania, u.ca_sucursal, c.ca_hbls, r.ca_consecutivo, r.ca_seguro, r.ca_colmas, b1.ca_nombre, t.ca_nombre, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad, tra_ori.ca_idtrafico, tra_ori.ca_nombre, tra_des.ca_idtrafico, tra_des.ca_nombre, m.ca_modalidad,desfin.ca_ciudad,c.ca_numpiezas,c.ca_peso,c.ca_volumen";

            $con = Doctrine_Manager::getInstance()->connection();
            //echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

        $sql="select r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_fcharribo,
            ori.ca_ciudad ca_ciuorigen,des.ca_ciudad ca_ciudestino,o.ca_volumen,o.ca_numpiezas,o.ca_peso,u.ca_sucursal
            from tb_reportes r
                inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                left join tb_terceros t on o.ca_idimportador=t.ca_idtercero
                inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                inner join tb_ciudades ori on r.ca_origen=ori.ca_idciudad
                inner join tb_ciudades des on r.ca_destino=des.ca_idciudad
                JOIN vi_usuarios u ON r.ca_login = u.ca_login
                where r.ca_tiporep=4
                and  r.ca_fchcreado >='2012-04-01' and r.ca_login='consolcargo'
                $where1 order by o.ca_fcharribo";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul2 = $st->fetchAll();
            
        }
    }

    public function executeEstadisticasIndicadoresTT(sfWebRequest $request) {

        $this->opcion = $request->getParameter("opcion");
        $this->idpais_origen=$this->getRequestParameter("idpais_origen");
        $this->pais_origen=$this->getRequestParameter("pais_origen");
        $this->idcliente=$this->getRequestParameter("idcliente");
        $this->fechafinal = $request->getParameter("fechaFinal");        
        if($this->fechafinal){
            list($nom_mes, $ano) = explode("-", $this->fechafinal);
            $this->nom_mes=$nom_mes;
            $this->ano=$ano;
            $this->mes = Utils::nmes($nom_mes);
            $this->mesp = $this->mes;
        }

        $this->indi_LCL=array();
        $this->indi_FCL=array();

        $this->indi_LCL["Estados Unidos"] = 4;
        $this->indi_FCL["Estados Unidos"] = 8;

        $this->indi_LCL["Mexico"] = 5;
        $this->indi_FCL["Mexico"] = 5;
        
        $this->indi_LCL["Chile"] = 10;
        $this->indi_FCL["Chile"] = 10;
        
        $this->indi_LCL["Holanda"] = 22;
        $this->indi_FCL["Holanda"] = 22;
        
        $this->grid = array();
        $this->indicador = array();
        
        if ($this->opcion) {
            $sql = "select * 
                from vi_repindicadores 
                LEFT OUTER JOIN (select rp.ca_consecutivo as ca_consecutivo_sub, rs.ca_fchsalida, rs.ca_fchllegada, max(to_date((rs.ca_fchenvio::timestamp)::text,'yyyy-mm-dd')) as ca_fchenvio, rs.ca_fchllegada-rs.ca_fchsalida as ca_diferencia , rs.ca_peso as ca_peso,extract(YEAR from rs.ca_fchsalida) as ca_ano1 ,extract(MONTH from rs.ca_fchsalida) as ca_mes1 from tb_repstatus rs INNER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where rs.ca_idetapa in ('IACAD','IMCPD') group by ca_consecutivo, ca_fchsalida, ca_fchllegada, ca_diferencia,ca_peso,extract(YEAR from rs.ca_fchsalida) ,extract(MONTH from rs.ca_fchsalida)) sq ON (vi_repindicadores.ca_consecutivo = sq.ca_consecutivo_sub) 
                where ca_impoexpo = '" . Constantes::IMPO . "' and ca_transporte = '" . constantes::MARITIMO . "'
                and ca_idcliente = ".$this->idcliente."   
                and ca_ano::numeric = " . $ano . " and ca_mes::numeric <= " . $this->mes . " and ca_traorigen='".$this->pais_origen."'
                order by ca_ano,ca_mes";
            
            //exit;
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
            foreach ($this->resul as $r) {
                if (!$r["ca_diferencia"])
                    continue;
                if ($r["ca_modalidad"] == Constantes::FCL) {
                    if ($r["ca_diferencia"] > $this->indi_FCL[$this->pais_origen]) {
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"]++;
                    } else {
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"]++;
                    }
                } else if ($r["ca_modalidad"] == Constantes::LCL) {
                    if ($r["ca_diferencia"] > $this->indi_LCL[$this->pais_origen]) {
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"]++;
                    } else {
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"]++;
                    }
                }
                $this->grid[$r["ca_ano1"]][$r["ca_modalidad"]][(int) ($r["ca_mes1"])]["conta"] = (isset($this->grid[$r["ca_ano1"]][$r["ca_modalidad"]][(int) ($r["ca_mes1"])]["conta"])) ? ($this->grid[$r["ca_ano1"]][$r["ca_modalidad"]][(int) ($r["ca_mes1"])]["conta"] + 1) : "1";
                $this->grid[$r["ca_ano1"]][$r["ca_modalidad"]][(int) ($r["ca_mes1"])]["diferencia"]+=$r["ca_diferencia"];
                list($peso, $medida) = explode("|", $r["ca_peso"]);
                $this->grid[$r["ca_ano1"]][$r["ca_modalidad"]][(int) ($r["ca_mes1"])]["peso"]+=$peso;
//                        []=array("diferencia"=>$r["ca_diferencia"],"peso"=>$r["ca_peso"]);
            }
            
            //echo "<pre>";print_r($this->resul);echo "</pre>";
        }
    }

    public function executeLibroReferenciasAereo(sfWebRequest $request) {
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $idtrafico = $request->getParameter("idtrafico");

        $this->detalle = $request->getParameter("detalle");

        if ($request->isMethod("post")) {

            $q = Doctrine::getTable("InoMaestraAir")
                            ->createQuery("m")
                            ->innerJoin("m.Origen o")
                            ->addWhere("SUBSTR(m.ca_referencia, 8,2) LIKE ?", $mes)
                            ->addWhere("SUBSTR(m.ca_referencia, 15,1) LIKE ?", $anio)
                            ->addWhere("o.ca_idtrafico LIKE ?", $idtrafico);

            if ($this->detalle) {
                $q->innerJoin("m.InoClientesAir c");
                $q->innerJoin("c.Cliente cl");
            }

            $this->refs = $q->execute();

            $this->setTemplate("libroReferenciasAereoResult");
        } else {
            $this->traficos = Doctrine::getTable("Trafico")
                            ->createQuery("t")
                            ->addOrderBy("t.ca_nombre")
                            ->execute();
        }
    }
    

    public function executeReporteCargaOperativa(sfWebRequest $request) {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');

        $this->tipoInforme = $request->getParameter("tipoInforme");
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");

        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->origen = $request->getParameter("origen");
        $this->idorigen = $request->getParameter("idorigen");
        $this->idpais_destino = $request->getParameter("idpais_destino");
        $this->destino = $request->getParameter("destino");
        $this->iddestino = $request->getParameter("iddestino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->opcion = $request->getParameter("opcion");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");
        $this->incoterms = $request->getParameter("incoterms");

        $this->idcliente = $request->getParameter("idcliente");
        $this->sucursal = $request->getParameter("sucursal");
        $this->idSucursal = $request->getParameter("idSucursal");
        $this->usuenvio = $request->getParameter("usuenvio");
        $this->idDepartamento = $request->getParameter("idDepartamento");
        $this->nomoperativo = $request->getParameter("nomoperativo");
        $this->tipoInforme = $request->getParameter("tipoInforme");

        if ($this->opcion) {
            if ($this->idmodalidad)
                $where.=" and rp.ca_modalidad='" . $this->idmodalidad . "'";
            if ($this->fechainicial && $this->fechafinal){
                list($ano, $mes, $dia) = sscanf($this->fechainicial, "%d-%d-%d");
                $fechainicial = date("Y-m-d H:i:s", mktime( 0, 0, 0, $mes, $dia, $ano));
                list($ano, $mes, $dia) = sscanf($this->fechafinal, "%d-%d-%d");
                $fechafinal = date("Y-m-d H:i:s", mktime( 23, 59, 59, $mes, $dia, $ano));
            }
            if ($this->tipoInforme == "Volumen de Trabajo"){
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rps.ca_fchenvio::text,1,4) as ca_ano, substr(rps.ca_fchenvio::text,6,2) as ca_mes, rps.ca_usuenvio, count(rps.ca_idemail) as ca_cant_emails from tb_repstatus rps, tb_reportes rpt where rps.ca_fchenvio between '$fechainicial' and '$fechafinal' and  rpt.ca_idreporte = rps.ca_idreporte group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo)";
            }else if ($this->tipoInforme == "Reporte al Exterior"){
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rpa.ca_fchenvio::text,1,4) as ca_ano, substr(rpa.ca_fchenvio::text,6,2) as ca_mes, rpa.ca_usuenvio, count(rpa.ca_idemail) as ca_cant_emails from tb_emails rpa, tb_reportes rpt where rpa.ca_tipo like '%Rep.%Exterior%' and rpa.ca_fchenvio between '$fechainicial' and '$fechafinal' and rpt.ca_idreporte = rpa.ca_idcaso group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo) ";
            }else if ($this->tipoInforme == "Reportes AG"){
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rpa.ca_fchenvio::text,1,4) as ca_ano, substr(rpa.ca_fchenvio::text,6,2) as ca_mes, rpa.ca_usuenvio, count(rpa.ca_idemail) as ca_cant_emails from tb_emails rpa, tb_reportes rpt where rpa.ca_tipo like '%Reporte Negocios AG%' and rpa.ca_fchenvio between '$fechainicial' and '$fechafinal' and rpt.ca_idreporte = rpa.ca_idcaso group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo) ";
            }else if ($this->tipoInforme == "Negocios nuevos"){
                if ($this->fechainicial && $this->fechafinal)
                    $where.=" and (rp.ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
                $filtroTipoInforme = "INNER JOIN (select rpt.ca_consecutivo, substr(rpt.ca_fchreporte::text,1,4) as ca_ano, substr(rpt.ca_fchreporte::text,6,2) as ca_mes, rps.ca_usuenvio, count(rps.ca_idemail) as ca_cant_emails from tb_repstatus rps, tb_reportes rpt where rpt.ca_idreporte = rps.ca_idreporte group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo)";
            }
            if ($this->idpais_origen)
                $where.=" and tro.ca_idtrafico='" . $this->idpais_origen . "'";
            if ($this->idorigen)
                $where.=" and rp.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where.=" and trd.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where.=" and rp.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where.=" and rp.ca_idlinea='" . $this->idlinea . "'";

            if ($this->incoterms && count($this->incoterms) > 0) {

                $where.=" and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0)
                        $where.=" or ";
                    $where.=" rp.ca_incoterms like '" . $inco . "%'";
                }
                $where.=" )";
            }

            if ($this->idcliente)
                $where.=" and ccl.ca_idcliente = '" . $this->idcliente . "'";

            if ($this->idagente)
                $where.=" and agt.ca_idagente = '" . $this->idcliente . "'";

            if ($this->sucursal)
                $where.=" and sc.ca_nombre = (select ca_nombre from control.tb_sucursales where ca_idsucursal = '" . $this->sucursal . "')";

            if ($this->usuenvio)
                $where.=" and rf.ca_usuenvio = '" . $this->usuenvio . "'";

            if ($this->idDepartamento)
                $where.=" and op.ca_departamento = '" . $this->idDepartamento . "'";

            $sql = "SELECT
                rf.ca_ano, rf.ca_mes, rp.ca_idreporte, rp.ca_fchreporte, rp.ca_consecutivo, rx.ca_version, sc.ca_nombre as ca_sucursal,
                tro.ca_idtrafico, tro.ca_nombre as ca_traorigen, rp.ca_origen, cio.ca_ciudad as ca_ciuorigen, trd.ca_idtrafico, trd.ca_nombre as ca_tradestino, cid.ca_ciudad as ca_ciudestino, rp.ca_transporte,
                rp.ca_modalidad, rp.ca_impoexpo, ccl.ca_idcliente, ccl.ca_compania, lin.ca_idlinea, lin.ca_nomtransportista, agt.ca_idagente, agt.ca_nombre as ca_nomagente, nn.ca_referencia, nn.ca_cant_negocios,
                rf.ca_cant_emails, rf.ca_usuenvio, op.ca_nombre as ca_nomoperativo, op.ca_departamento

                from tb_reportes rp
                -- La última versión del reporte
                        INNER JOIN (select ca_consecutivo, ca_fchreporte, max(ca_version) as ca_version, min(ca_fchcreado) as ca_fchcreado from tb_reportes where ca_usuanulado IS NULL group by ca_consecutivo, ca_fchreporte order by ca_consecutivo) rx ON (rp.ca_consecutivo = rx.ca_consecutivo and rp.ca_version = rx.ca_version)
                -- Dependiendo el tipo de Informe, toma los registros
                        $filtroTipoInforme
                -- Calcula el numero de negocios
                        LEFT OUTER JOIN (select ca_referencia, ca_consecutivo, count(ca_doctransporte) as ca_cant_negocios from (select ca_referencia, ca_hbls as ca_doctransporte, ca_consecutivo::text from tb_inoclientes_sea ics INNER JOIN tb_reportes rpt ON rpt.ca_idreporte = ics.ca_idreporte union  select ca_referencia, ca_hawb as ca_doctransporte, ca_idreporte::text as ca_consecutivo from tb_inoclientes_air) as cn where ca_consecutivo IS NOT NULL group by ca_referencia, ca_consecutivo order by ca_consecutivo) nn ON (rp.ca_consecutivo = nn.ca_consecutivo)

                        INNER JOIN vi_usuarios us ON (rp.ca_login = us.ca_login)
                        INNER JOIN vi_usuarios op ON (rf.ca_usuenvio = op.ca_login)
                        INNER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal)
                        INNER JOIN tb_ciudades cio ON (rp.ca_origen = cio.ca_idciudad)
                        INNER JOIN tb_traficos tro ON (cio.ca_idtrafico = tro.ca_idtrafico)
                        INNER JOIN tb_ciudades cid ON (rp.ca_destino = cid.ca_idciudad)
                        INNER JOIN tb_traficos trd ON (cid.ca_idtrafico = trd.ca_idtrafico)
                        INNER JOIN vi_agentes agt ON (rp.ca_idagente = agt.ca_idagente)
                        INNER JOIN tb_concliente ccn ON (rp.ca_idconcliente = ccn.ca_idcontacto)
                        INNER JOIN vi_transporlineas lin ON (rp.ca_idlinea = lin.ca_idlinea)
                        INNER JOIN vi_clientes_reduc ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)
                $where
                order by ca_ano, ca_mes, ca_compania, ca_traorigen, to_number(substr(rp.ca_consecutivo,0,position('-' in rp.ca_consecutivo)),'99999999')";
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }
    }
    
    
    public function executeReporteDesconsolidacion(sfWebRequest $request) {
        
        $this->opcion = $request->getParameter("opcion");
        if ($this->opcion) {        
            $this->fechainicial = $request->getParameter("fechaInicial");
            $this->fechafinal = $request->getParameter("fechaFinal");
            //ca_fchvaciado-ca_fcharribo
            $sql = "select (ca_fchvaciado-ca_fchconfirmacion) as diferencia , ca_referencia, ca_fchcreado,ca_fchvaciado,ca_fchconfirmacion,des.ca_ciudad
                from tb_inomaestra_sea m
                inner join tb_ciudades des on m.ca_destino=des.ca_idciudad
                where m.ca_fcharribo between '" . $this->fechainicial . "' and '" . $this->fechafinal . "' and m.ca_modalidad='LCL' and m.ca_fchconfirmacion is not null            
                order by m.ca_fchconfirmacion desc, 3 desc";
            //echo "<br>".$sql;
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->ref = $st->fetchAll();
            //print_r($this->ref);
        }        
    }
    
    
    public function executeReporteRecibosCaja(sfWebRequest $request) {        
        $this->opcion = $request->getParameter("opcion");
        if ($this->opcion) {
            $this->fechainicial = $request->getParameter("fechaInicial");
            $this->fechafinal = $request->getParameter("fechaFinal");
            $this->tipo = $request->getParameter("tipo");
            $tipos=array("tb_inoingresos_sea","tb_inoingresos_air","tb_expo_ingresos","tb_brk_ingresos");
            
            if($this->tipo >=0 && $this->tipo<4)
            {
                if($this->fechainicial && $this->fechafinal)
                    $where=" t.ca_fchcreado between '" . $this->fechainicial . "' and '" . $this->fechafinal . "' and ";
                $join="";
                if($this->tipo<3)
                        $join="inner join vi_clientes_reduc c on t.ca_idcliente=c.ca_idcliente";
                else if($this->tipo==3)
                {
                    $join="inner join tb_brk_maestra m on t.ca_referencia = m.ca_referencia
                        inner join vi_clientes_reduc c on m.ca_idcliente=c.ca_idcliente";
                }
                $sql="select t.*,c.ca_compania from ".$tipos[$this->tipo]." t
                        $join
                        where $where (t.ca_reccaja is null or t.ca_reccaja='') ";

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $this->ref = $st->fetchAll();
            }
            
        }
    }
    
    public function executeListadoFacturas(sfWebRequest $request) {   
        
        if( $request->isMethod("post") ){           
            
            $q = Doctrine::getTable("InoCostosSea")
                            ->createQuery("c")
                            ->addWhere("substr(ca_referencia,5,2) like ?", $request->getParameter("sufijo") )
                            ->addWhere("ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                            ->addWhere("ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                            ->addWhere("ca_usucreado like ?", $request->getParameter("login"));
            
            if( $request->getParameter("proveedor") ){
                $q->addWhere("UPPER(ca_proveedor) like ?", strtoupper($request->getParameter("proveedor"))."%");
            }
            $this->costos = $q->execute();
            
           
            
            $this->setTemplate("listadoFacturasResult");
            //$sql = "select ca_referencia, ca_factura, ca_fchfactura, ca_proveedor, ca_idmoneda, ca_tcambio, ca_tcambio_usd, ca_neto, ca_venta, ca_fchcreado, ca_usucreado from tb_inocostos_sea where order by substr(ca_referencia,5,2)";
        }else{
            $this->usuarios = Doctrine::getTable("Usuario")
                                    ->createQuery("u")
                                    ->addWhere("u.ca_activo = ? ", true)
                                    ->addOrderBy("u.ca_nombre")
                                    ->execute();
        }
    }
    
    public function executeImpresionbl(sfWebRequest $request) {
        
        $this->opcion = $request->getParameter("opcion");
        
        if ($this->opcion) {    
            $this->fechaInicial = $request->getParameter("fechaInicial");
            $this->fechaFinal = $request->getParameter("fechaFinal");
            
            $this->origen = $request->getParameter("origen");
            $this->idorigen = $request->getParameter("idorigen");
           
            $this->idagente = $request->getParameter("idagente");
            $this->agente = $request->getParameter("agente");
            
            $this->sucursal = $request->getParameter("sucursal");
            $this->idsucursal = $request->getParameter("idsucursal");
            
            $q = Doctrine::getTable("Reporte")
                            ->createQuery("r")
                            ->select("r.ca_consecutivo , im.ca_fcharribo, ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, r.ca_idagente, r.ca_origen, c.ca_ciudad, r.ca_idagente, d.ca_nombre, ic.ca_idcliente, cl.ca_compania, r.ca_login, u.ca_idsucursal, s.ca_nombre")
                            ->innerjoin("r.InoClientesSea ic")
                            ->innerJoin("ic.InoMaestraSea im")
                            ->innerJoin("ic.Cliente cl")
                            ->innerJoin("r.IdsAgente i")
                            ->innerJoin("i.Ids d")
                            ->innerJoin("r.Origen c")
                            ->innerJoin("r.Usuario u")
                            ->innerJoin("u.Sucursal s")
                            ->addWhere("ic.ca_imprimirorigen = true")
                            ->addWhere("im.ca_fcharribo BETWEEN ? AND ?", array($this->fechaInicial, $this->fechaFinal))
                            ->orderby("im.ca_fcharribo")
                            ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
                            
                            if($this->idorigen && $this->idorigen != '999-9999'){
                                $q->addWhere("r.ca_origen = ?", $this->idorigen);
                            }
                            if($this->idagente){
                                $q->addWhere("r.ca_idagente = ?", $this->idagente);
                            }
                            if($this->sucursal){
                                $q->addWhere("u.ca_idsucursal = ?", $this->sucursal);
                            }
                            
                            $this->bls=$q->execute();
        }
    }
    
    public function executeMenuEstadisticas(sfWebRequest $request) {
        
        $this->setLayout("layout");
        
        $this->nivel = $this->getUser()->getNivelAcceso(reportesGerActions::ESTADISTICAS);
        //echo $this->nivel;
        if ($this->nivel < 1) {
            $this->forward404();
        }
        
    }
    
}

?>