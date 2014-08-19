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
    const ENTREGAREPORTES = 146;

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
        $this->proyectos = ($request->getParameter("proyectos")) ? TRUE : FALSE;

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

            $sql = "SELECT tt.ca_liminferior,m.ca_referencia, tt.ca_concepto,tt.ca_idconcepto, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, 
                        m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, tra_ori.ca_idtrafico AS ori_ca_idtrafico, 
                        tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, 
                        m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,ids1.ca_nombre as agente,r.ca_idreporte,r.ca_incoterms,r.ca_idagente,
                        (( SELECT sum(t.ca_liminferior) AS sum
                            FROM tb_inoequipos_sea eq
                                JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
                            WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
                        ( SELECT count(*) AS count
                            FROM tb_inoequipos_sea eq
                            WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
                        count(DISTINCT c.ca_hbls) AS nhbls,
                        ( SELECT sum(ca_peso) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS peso, 
                        ( SELECT sum(ca_numpiezas) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS piezas, 
                        ( SELECT sum(ca_volumen) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS volumen
                    FROM tb_inomaestra_sea m
                        JOIN tb_inoclientes_sea c ON c.ca_referencia = m.ca_referencia
                        $joinreportes
                        $joinclientes
                        JOIN tb_inoequipos_sea e ON e.ca_referencia = m.ca_referencia
                        JOIN tb_conceptos tt ON e.ca_idconcepto = tt.ca_idconcepto   
                        JOIN ids.tb_proveedores p ON p.ca_idproveedor = m.ca_idlinea
                        JOIN ids.tb_ids ids ON p.ca_idproveedor = ids.ca_id

                        JOIN ids.tb_agentes ag ON ag.ca_idagente = r.ca_idagente
                        JOIN ids.tb_ids ids1 ON ag.ca_idagente = ids1.ca_id

                        JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                        JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
                        JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                        JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
                    WHERE date_part('year', m.ca_fchreferencia) > (date_part('year', m.ca_fchreferencia) - 2)  
                        $where
                    GROUP BY tt.ca_liminferior,m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,ids1.ca_nombre,r.ca_idreporte,r.ca_incoterms,r.ca_idagente,
                            (( SELECT sum(t.ca_liminferior) AS sum FROM tb_inoequipos_sea eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
                                WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
                            ( SELECT count(*) AS count FROM tb_inoequipos_sea eq
                                WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)
                    ORDER BY m.ca_fchreferencia, r.ca_incoterms ,r.ca_idagente";
            $con = Doctrine_Manager::getInstance()->connection();
            //echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }

        if (count($this->incoterms) <= 0) {
            $this->incoterms = array();
        }
    }

    public function executeReporteCargaTraficos2(sfWebRequest $request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');

        $this->nivel = $this->getUser()->getNivelAcceso(reportesGerActions::RUTINA);
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
        $this->proyectos = ($request->getParameter("proyectos")) ? TRUE : FALSE;

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
                        ( SELECT sum(ca_volumen) AS count FROM ino.tb_house ics WHERE ics.ca_idmaster = m.ca_idmaster ) AS volumen, md.ca_idmodo,m.ca_idmaster
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
                    GROUP BY tt.ca_liminferior,m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchsalida, m.ca_fchllegada, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,
                        (( SELECT sum(t.ca_liminferior) AS sum FROM ino.tb_equipos eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
                        ( SELECT count(*) AS count FROM ino.tb_equipos eq WHERE eq.ca_idmaster = m.ca_idmaster AND eq.ca_idconcepto = tt.ca_idconcepto) , 
                        md.ca_idmodo,m.ca_idmaster
                    ORDER BY m.ca_fchreferencia";
            $con = Doctrine_Manager::getInstance()->connection();
            //echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }

        if (count($this->incoterms) <= 0) {
            $this->incoterms = array();
        }
    }

    public function executeEstadisticasMaritimo(sfWebRequest $request) {


        $this->opcion = $request->getParameter("opcion");
        $this->year = ($request->getParameter("year") != "") ? $request->getParameter("year") : date("Y");
        $this->mes = $request->getParameter("mes");
        $this->nmes = $request->getParameter("nmes");

        $this->meses = array();
        $this->meses[] = array("valor" => "a-Enero", "id" => 1);
        $this->meses[] = array("valor" => "b-Febrero", "id" => 2);
        $this->meses[] = array("valor" => "c-Marzo", "id" => 3);
        $this->meses[] = array("valor" => "d-Abril", "id" => 4);
        $this->meses[] = array("valor" => "e-Mayo", "id" => 5);
        $this->meses[] = array("valor" => "f-Junio", "id" => 6);
        $this->meses[] = array("valor" => "g-Julio", "id" => 7);
        $this->meses[] = array("valor" => "h-Agosto", "id" => 8);
        $this->meses[] = array("valor" => "i-Septiembre", "id" => 9);
        $this->meses[] = array("valor" => "j-Octubre", "id" => 10);
        $this->meses[] = array("valor" => "k-Noviembre", "id" => 11);
        $this->meses[] = array("valor" => "l-Diciembre", "id" => 12);

        if ($traficos_rs) {
            foreach ($traficos_rs as $trafico) {
                $row = array("id" => $trafico->getCaIdTrafico(), "valor" => $trafico->getCaNombre());
                $this->traficos[] = $row;
            }
        }

        if ($this->opcion) {

            if ($this->year != "")
                $where.=" and ca_ano in ('" . ($this->year) . "','" . ($this->year - 1) . "')";

            if (count($this->nmes) > 0) {
                $this->nmes = array_diff($this->nmes, array(""));
                if ($this->nmes[0] != "")
                    $where.=" and ca_mes::integer in (" . (implode(",", $this->nmes)) . ")";
            }
            $sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_volumen) as ca_volumen, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_lcl where 1=1  $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->lcl = $st->fetchAll();

            $sql = "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, 
                sum(ca_teus) as ca_teus from vi_inotrafico_fcl where 1=1  $where group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
            $st = $con->execute($sql);
            $this->fcl = $st->fetchAll();

            $this->grid = array();
            $this->puertos = array("Barranquilla", "Buenaventura", "Cartagena", "Santa Marta", "Otros");
            $this->grid["destino"]["Barranquilla"] = array();

            $this->grid["destino"]["Buenaventura"] = array();
            $this->grid["destino"]["Cartagena"] = array();
            $this->grid["destino"]["Santa Marta"] = array();
            $this->grid["destino"]["Otros"] = array();
            foreach ($this->lcl as $l) {
                if (!in_array($l["ca_ciudestino"], $this->puertos)) {
                    $l["ca_ciudestino"] = "Otros";
                }
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_volumen"] += (int) $l["ca_volumen"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["LCL"][$l["ca_ano"]]["ca_teus"] += (int) $l["ca_teus"];

                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_volumen"] += (int) $l["ca_volumen"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_teus"] += (int) $l["ca_teus"];

                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_volumen"] += (int) $l["ca_volumen"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["LCL"][$l["ca_ano"]]["totales"]["ca_teus"] += (int) $l["ca_teus"];

                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_volumen"] += (int) $l["ca_volumen"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["LCL"][$l["ca_ano"]]["totales"]["ca_teus"] += (int) $l["ca_teus"];
            }

            foreach ($this->fcl as $l) {
                if (!in_array($l["ca_ciudestino"], $this->puertos)) {
                    $l["ca_ciudestino"] = "Otros";
                }
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["destino"][$l["ca_ciudestino"]]["FCL"][$l["ca_ano"]]["ca_teus"] += (int) $l["ca_teus"];

                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]][$l["ca_ciudestino"]]["ca_teus"] += (int) $l["ca_teus"];

                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["origen"][$l["ca_traorigen"]]["FCL"][$l["ca_ano"]]["totales"]["ca_teus"] += (int) $l["ca_teus"];


                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_20pies"] += (int) $l["ca_20pies"];
                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_40pies"] += (int) $l["ca_40pies"];
                $this->grid["FCL"][$l["ca_ano"]]["totales"]["ca_teus"] += (int) $l["ca_teus"];
            }
            //echo "<pre>";print_r($this->grid["origen"]);echo "</pre>";
        }
    }

    public function executeEstadisticasEntregaReportes(sfWebRequest $request) {

        $this->permiso = $this->getUser()->getNivelAcceso(reportesGerActions::ENTREGAREPORTES);
        if ($this->permiso == -1)
            $this->forward404();

        $this->opcion = $request->getParameter("opcion");

        $this->idsucursal = $request->getParameter("idsucursal");
       
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");

        if ($this->opcion) {

            if ($this->idsucursal) {
                if ($this->idsucursal == "BOG")
                    $where .= " and u.ca_idsucursal in('" . $this->idsucursal . "','ABO')";
                else
                    $where .= " and u.ca_idsucursal='" . $this->idsucursal . "'";
            }
            
            if ($this->fechainicial)
                $where .= " and a.ca_fchcreado>='$this->fechainicial'";

            if ($this->fechafinal)
                $where .= " and a.ca_fchcreado<='$this->fechafinal' ";

            $con = Doctrine_Manager::getInstance()->connection();

            $sql = "select s.ca_nombre as sucursal, a.ca_usucreado, a.ca_fchcreado,(r.ca_consecutivo||' V'||r.ca_version) reporte,a.ca_fchrechazo,
                        a.ca_usurechazo,a.ca_motrechazo,a.ca_propiedades, u.ca_nombre
                    from tb_reportes r 
                        inner join tb_repantecedentes a on a.ca_idreporte=r.ca_idreporte
                        inner join control.tb_usuarios u on u.ca_login = a.ca_usucreado
                        inner join control.tb_sucursales s on s.ca_idsucursal = u.ca_idsucursal
                    where 1=1 $where
                    order by s.ca_nombre, a.ca_usucreado, a.ca_fchcreado";
            $st = $con->execute($sql);
            $this->reportes = $st->fetchAll();
            //echo "<pre>";print_r($this->reportes);echo "</pre>";
        }
    }

    public function executeEstadisticasTraficos(sfWebRequest $request) {

        $this->opcion = $request->getParameter("opcion");
        list($ano, $this->mes, $dia) = explode("-", $request->getParameter("fechaFinal"));

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

            if ($this->idsucursal) {
                if ($this->idsucursal == "BOG")
                    $where .= " and ca_idsucursal in('" . $this->idsucursal . "','ABO')";
                else
                    $where .= " and ca_idsucursal='" . $this->idsucursal . "'";
            }
            if ($this->departamento == "Cuentas Globales")
                $where .= " and ca_idcliente in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            else if ($this->departamento == "Tráficos")
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            else if ($this->departamento == "Aéreo")
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where ca_propiedades like '%cuentaglobal=true%') ";
            if ($this->transporte)
                $where .= " and ca_transporte ='" . $this->transporte . "'";

            $this->nmeses = 3;
            $tra_principal = "'Alemania','Argentina','Belgica','Brasil','Chile','China','España','Estados Unidos','Inglaterra', 'Italia', 'Mexico','Taiwan'";

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen
                    from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
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

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_ciuorigen as origen
                    from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_ciuorigen='Shanghai'
                    group by ca_year,ca_mes,ca_ciuorigen
                    order by 4,2,3";
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            $origen = "";
            foreach ($this->resul as $r) {
                $this->grid[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totales[$r["ca_year"] . "-" . $r["ca_mes"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen
                    from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_traorigen not in ($tra_principal)
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

            $sql = "select count(*) as valor,ca_traorigen as origen,ca_year 
                    from vi_reportes_estadisticas
                    where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal, "Y") . '-01-01') . "' and '" . $this->fechafinal . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
                    group by ca_traorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            $this->gridCompara = array();
            $this->totalesCompara = array();

            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_ciuorigen as origen,ca_year 
                    from vi_reportes_estadisticas
                    where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal, "Y") . '-01-01') . "' and '" . $this->fechafinal . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_ciuorigen='Shanghai'
                    group by ca_ciuorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]]+=$r["valor"];
            }

            $sql = "select count(*) as valor,ca_traorigen as origen,ca_year 
                    from vi_reportes_estadisticas
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
        $where = "";
        $where1.="and ca_version=( SELECT max(rr.ca_version) AS max
           FROM tb_reportes rr
          WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";

        if ($this->opcion) {

            if ($this->idmodalidad) {
                if ($this->idmodalidad == "LCL") {
                    $where.=" and m.ca_modalidad in ('" . $this->idmodalidad . "','" . Constantes::COLOADING . "')";
                    $where1.=" and r.ca_modalidad in ('" . $this->idmodalidad . "','" . Constantes::COLOADING . "')";
                } else {
                    $where.=" and m.ca_modalidad='" . $this->idmodalidad . "'";
                    $where1.=" and r.ca_modalidad='" . $this->idmodalidad . "'";
                }
            }

            if ($this->fechaarrinicial && $this->fechaarrfinal) {
                $where.=" and (m.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
                $where1.=" and (o.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
            }
            if ($this->idorigen) {
                $where.=" and m.ca_destino='" . $this->idorigen . "'";
                $where1.=" and r.ca_origen='" . $this->idorigen . "'";
            }
            if ($this->iddestino) {
                $where.=" and r.ca_continuacion_dest='" . $this->iddestino . "'";
                $where1.=" and r.ca_destino='" . $this->iddestino . "'";
            }
            if ($this->idlinea) {
                $where.=" and m.ca_idlinea='" . $this->idlinea . "'";
                $where1.=" and r.ca_idlinea='" . $this->idlinea . "'";
            }

            if ($this->incoterms && count($this->incoterms) > 0) {

                $where.=" and (";
                $where1.=" and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0) {
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

            if ($this->sucursal) {
                $where.=" and u.ca_sucursal = '" . $this->sucursal . "'";
                $where1.=" and u.ca_sucursal = '" . $this->sucursal . "'";
            }

            $sql = "SELECT m.ca_referencia, cl.ca_compania, u.ca_sucursal, c.ca_hbls, r.ca_consecutivo, r.ca_seguro, 
                        r.ca_colmas, b1.ca_nombre as ca_bodega, t.ca_nombre as ca_operador, m.ca_fchembarque, m.ca_fcharribo, 
                        m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, 
                        tra_ori.ca_idtrafico AS ori_ca_idtrafico, tra_ori.ca_nombre AS ori_ca_nombre, 
                        tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, m.ca_modalidad, desfin.ca_ciudad AS desfin_ca_ciudad,
                        count(DISTINCT c.ca_hbls) AS nhbls,
                        (c.ca_numpiezas) piezas,
                        (c.ca_peso) peso,
                        (c.ca_volumen) volumen,
                        (select o.ca_consecutivo from tb_repotm o where ca_idreporte in (select ca_idreporte from tb_reportes rr where rr.ca_consecutivo=r.ca_consecutivo ) and o.ca_consecutivo is not null limit 1 ) as nodtm
                    FROM tb_inomaestra_sea m
                    JOIN tb_inoclientes_sea c ON c.ca_referencia = m.ca_referencia
                    JOIN vi_clientes_reduc cl ON c.ca_idcliente = cl.ca_idcliente
                    JOIN vi_usuarios u ON c.ca_login = u.ca_login
                    JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte
                    LEFT join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                    JOIN tb_bodegas b1 ON r.ca_idbodega = b1.ca_idbodega
                    JOIN tb_terceros t ON r.ca_idconsignatario = t.ca_idtercero and trim(t.ca_nombre)=trim('COL OTM S.A.S.') 
                    JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                    JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
                    JOIN tb_ciudades des ON des.ca_idciudad = m.ca_destino
                    JOIN tb_ciudades desfin ON desfin.ca_idciudad = r.ca_continuacion_dest
                    JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
                    WHERE date_part('year', m.ca_fchreferencia) > (date_part('year', m.ca_fchreferencia) - 2) and r.ca_continuacion = 'OTM'
                    $where
                    GROUP BY m.ca_referencia, cl.ca_compania, u.ca_sucursal, c.ca_hbls, r.ca_consecutivo, r.ca_seguro, r.ca_colmas, b1.ca_nombre, t.ca_nombre, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad, tra_ori.ca_idtrafico, tra_ori.ca_nombre, tra_des.ca_idtrafico, tra_des.ca_nombre, m.ca_modalidad,desfin.ca_ciudad,c.ca_numpiezas,c.ca_peso,c.ca_volumen,nodtm";

            $con = Doctrine_Manager::getInstance()->connection();
            //echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            $sql = "select r.ca_idreporte,r.ca_origen,r.ca_destino,r.ca_consecutivo,r.ca_modalidad,COALESCE(t.ca_nombre,cl.ca_compania) as ca_compania, COALESCE(t.ca_identificacion,cl.ca_idalterno) as ca_idalterno,o.ca_hbls,o.ca_fcharribo,
                        ori.ca_ciudad ca_ciuorigen,des.ca_ciudad ca_ciudestino,o.ca_volumen,o.ca_numpiezas,o.ca_peso,u.ca_sucursal,o.ca_consecutivo as nodtm
                    from tb_reportes r
                        inner join tb_repotm o on r.ca_idreporte=o.ca_idreporte 
                        left join tb_terceros t on o.ca_idimportador=t.ca_idtercero
                        inner join tb_concliente ct on r.ca_idconcliente=ct.ca_idcontacto
                        inner join vi_clientes_reduc cl on cl.ca_idcliente::text=ct.ca_idcliente::text
                        inner join tb_ciudades ori on r.ca_origen=ori.ca_idciudad
                        inner join tb_ciudades des on r.ca_destino=des.ca_idciudad
                        JOIN vi_usuarios u ON r.ca_login = u.ca_login
                    where r.ca_tiporep=4 and  r.ca_fchcreado >='2012-04-01' and r.ca_login='consolcargo'
                    $where1
                    order by o.ca_fcharribo";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul2 = $st->fetchAll();
        }
    }

    public function executeEstadisticasIndicadoresClientes(sfWebRequest $request) {

        $this->opcion = $request->getParameter("opcion");
        $this->idpais_origen = $this->getRequestParameter("idpais_origen");
        $this->pais_origen = $this->getRequestParameter("pais_origen");
        $this->corigen = $this->getRequestParameter("corigen");
        $this->cdestino = $this->getRequestParameter("cdestino");
        $this->idcorigen = $this->getRequestParameter("idorigen");
        $this->idcdestino = $this->getRequestParameter("iddestino");
        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        $this->idcliente = $this->getRequestParameter("idcliente");
        $this->cliente = $this->getRequestParameter("Cliente");
        $this->fechainicial = $request->getParameter("fechaInicial");
        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->metalcl = $request->getParameter("meta_lcl");
        $this->metafcl = $request->getParameter("meta_fcl");
        $this->meta_air = $request->getParameter("meta_air");
        $this->typeidg = $request->getParameter("type_idg");
        $this->checkOrigen = $request->getParameter("checkOrigen");
        $this->checkDestino = $request->getParameter("checkDestino");
        
        if ($this->fechainicial) {
            list($ano_ini, $mes_ini) = explode("-", $this->fechainicial);
            $this->mesinicial = $mes_ini;
            $this->ano_ini = $ano_ini;
        }
        if ($this->fechafinal) {
            list($ano_fin, $mes_fin) = explode("-", $this->fechafinal);
            $this->mesfinal = $mes_fin;
        }

        $this->indi_LCL = array();
        $this->indi_FCL = array();
        $this->indi_AIR = array();

        $this->indi_LCL[$this->pais_origen] = $this->metalcl;
        $this->indi_FCL[$this->pais_origen] = $this->metafcl;
        $this->indi_AIR[$this->pais_origen] = $this->meta_air;

        $this->grid = array();
        $this->indicador = array();
        $this->peso = array();
        $wherePpal = "";

        if ($this->opcion) {
            switch ($this->typeidg) {
                case 1:
                    $select1 = ",(ca_fchllegada- (CASE WHEN sq.ca_carga_disponible != '' THEN date(sq.ca_carga_disponible) ELSE date(v.ca_fchcreado) END)) as ca_diferencia";
                    $where1 = "WHERE rs.ca_idetapa in ('IMCPD','IACAD','IMETA','IMETT','IACCR')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR','IMCEM')";
                    $select3 = ", ca_carga_disponible";
                    $select4 = ",substr(pro.ca_propiedades, strpos(pro.ca_propiedades, 'cargaDisponible=')+16,10) as ca_carga_disponible";
                    $join2 = "LEFT JOIN (select max(ca_idreporte) as ca_idreporte, est.ca_propiedades FROM tb_repstatus est WHERE strpos(est.ca_propiedades, 'cargaDisponible=')>0 GROUP BY est.ca_propiedades) pro ON pro.ca_idreporte = rs.ca_idreporte";
                    $group2 = ", pro.ca_propiedades ORDER BY rp.ca_consecutivo";
                    break;
                case 2:
                    $select1 = ",ca_fchsalida_cd, (CASE WHEN sqa.ca_fchllegada-ca_fchsalida_cd = 0 THEN 1 ELSE sqa.ca_fchllegada-ca_fchsalida_cd END) as ca_diferencia";
                    $select2 = ",ca_fchsalida as ca_fchsalida_cd";
                    $where1 = "WHERE rs.ca_idetapa in ('IMCPD','IACAD')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR','IMCEM')";
                    break;
                case 3:
                    $select1 = ",ca_fchsalida_eta, ca_fchsalida_ccr, (ca_fchsalida_ccr-ca_fchsalida_eta) as ca_diferencia";
                    $select2 = ",ca_fchsalida as ca_fchsalida_eta";
                    $select3 = ",ca_fchsalida as ca_fchsalida_ccr";
                    $where1 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACAD','IMCEM')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMCCR','IACCR') ";
                    break;
                case 4:
                    $select1 = ",ca_fchllegada_eta, ca_fchllegada_cd, (ca_fchllegada_cd-ca_fchllegada_eta) as ca_diferencia";
                    $select2 = ",ca_fchllegada as ca_fchllegada_eta";
                    $select3 = ",ca_fchllegada as ca_fchllegada_cd";
                    $where1 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMCPD','IACAD') ";
                    break;
                case 5:
                    $select1 = $this->transporte == "Marítimo" ? ",(select ca_factura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente limit 1) as ca_factura, (select ca_fchfactura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente limit 1) as ca_fchfactura, ((select ca_fchfactura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente limit 1)-sqa.ca_fchllegada) as ca_diferencia" : ",(select ca_factura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb limit 1) as ca_factura, (select ca_fchfactura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb limit 1) as ca_fchfactura, ((select ca_fchfactura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb limit 1)-sqa.ca_fchllegada) as ca_diferencia";
                    $where1 = "WHERE rs.ca_idetapa in ('IMCPD','IMETT','IACAD')";
                    $where2 = " WHERE rs.ca_idetapa in ('IMETA','IACCR','IMCEM')";
                    $joinPpal = $this->transporte == "Marítimo" ? "JOIN tb_inoclientes_sea ic ON ic.ca_idreporte = sqa.ca_idreporte" : "JOIN tb_inoclientes_air ic ON ic.ca_idreporte = sqa.ca_consecutivo";
                    break;
                case 6:
                    $select1 = ",im.ca_fchvaciado, im.ca_fchconfirmacion,(im.ca_fchvaciado-im.ca_fchconfirmacion) as ca_diferencia";
                    $where1 = "WHERE rs.ca_idetapa in ('IMCPD','IACAD')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR','IMCEM')";
                    $joinPpal = "JOIN tb_inoclientes_sea ic ON ic.ca_idreporte = sqa.ca_idreporte";
                    $joinSec = "JOIN tb_inomaestra_sea im ON ic.ca_referencia = im.ca_referencia";
                    break;
            }
            
            $wherePpal.= $this->corigen?"AND v.ca_ciuorigen = '".$this->corigen."'":"";
            $wherePpal.= $this->cdestino?"AND v.ca_ciudestino = '".$this->cdestino."'":"";

            $sql = "SELECT DISTINCT sqa.ca_ano1, sqa.ca_mes1, v.ca_consecutivo, v.ca_orden_clie as ca_orden, date(v.ca_fchcreado) as ca_fchcreado, v.ca_idreporte, v.ca_traorigen, v.ca_ciuorigen, v.ca_ciudestino,v.ca_modalidad,v.ca_transporte, v.ca_nombre as proveedor, v.ca_propiedades, 
                            (CASE WHEN v.ca_modalidad = 'COLOADING' THEN 'LCL' ELSE v.ca_modalidad END) as nva_modalidad,  sqa.ca_fchllegada, sqa.ca_peso, sqa.ca_piezas as ca_piezas, sqa.ca_volumen
                            $select1
                    FROM vi_repindicadores v
                        RIGHT OUTER JOIN ( SELECT extract(YEAR from rs.ca_fchllegada) as ca_ano1 ,extract(MONTH from rs.ca_fchllegada) as ca_mes1, ca_idreporte, ca_consecutivo, ca_fchllegada, ca_piezas, ca_peso, ca_volumen
                                            $select2
                                            FROM tb_repstatus rs 
                                                RIGHT JOIN ( SELECT rp.ca_consecutivo, min(rs.ca_idstatus) as ca_idstatus 
                                                        FROM tb_repstatus rs 
                                                            INNER JOIN tb_reportes rp on rp.ca_idreporte = rs.ca_idreporte 
                                                        $where1 
                                                        GROUP BY rp.ca_consecutivo) sf on rs.ca_idstatus = sf.ca_idstatus)  sqa ON v.ca_consecutivo = sqa.ca_consecutivo
                        RIGHT OUTER JOIN (SELECT ca_consecutivo $select3 
                                            FROM tb_repstatus rs 
                                        RIGHT JOIN (SELECT rp.ca_consecutivo, min(rs.ca_idstatus) as ca_idstatus $select4
                                                    FROM tb_repstatus rs 
                                                        INNER JOIN tb_reportes rp on rp.ca_idreporte = rs.ca_idreporte
                                                        $join2
                                                    $where2 
                                            GROUP BY rp.ca_consecutivo $group2) sf on rs.ca_idstatus = sf.ca_idstatus)  sq ON v.ca_consecutivo = sq.ca_consecutivo
                        $joinPpal
                        $joinSec
                     WHERE v.ca_impoexpo IN ('" . Constantes::IMPO . "','" . Constantes::OTMDTA1 . "') 
                           AND v.ca_transporte IN ('" . $this->transporte . "') 
                           AND v.ca_idcliente = " . $this->idcliente . "
                           AND v.ca_traorigen= '" . $this->pais_origen . "'
                           AND ca_ano1::numeric = " . $this->ano_ini . "
                           AND ca_mes1::numeric BETWEEN " . $this->mesinicial . " and " . $this->mesfinal . " $wherePpal 
                    ORDER BY sqa.ca_fchllegada";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            $this->dataIdg = "ca_diferencia";

            foreach ($this->resul as $r) {

                /* if (!$r[$this->dataIdg])
                  continue; */

                if ($this->transporte == Constantes::AEREO) {
                    if ($r[$this->dataIdg] > $this->indi_AIR[$this->pais_origen]) {
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"] ++;
                    } else {
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"] ++;
                    }
                } else if ($this->transporte == Constantes::MARITIMO) {
                    if ($r["nva_modalidad"] == Constantes::FCL) {
                        if($this->typeidg!=6){
                            if ($r[$this->dataIdg] > $this->indi_FCL[$this->pais_origen]) {
                                $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"] ++;
                            } else {
                                $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"] ++;
                            }
                        }
                    } else if ($r["nva_modalidad"] == Constantes::LCL) {
                        if ($r[$this->dataIdg] > $this->indi_LCL[$this->pais_origen]) {
                            $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"] ++;
                        } else {
                            $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"] ++;
                        }
                    }
                }

                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"] = (isset($this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"])) ? ($this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"] + 1) : "1";
                if (count($this->resul) == 1) {
                    if (!$r[$this->dataIdg]) {
                        $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["diferencia"] = 1;
                    }
                }
                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["diferencia"]+=$r[$this->dataIdg];

                list($peso, $medida) = explode("|", $r["ca_peso"]);
                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["peso"]+=$peso;
            }
            //echo "<pre>";print_r($this->grid);echo "</pre>";
        }
    }

    public function executeGuardarObservaciones(sfWebRequest $request) {

        $oids = $request->getParameter("oid");

        foreach ($oids as $oid) {

            $idreporte = $oid;
            $reporte = Doctrine::getTable("Reporte")->find($idreporte);
            $typeIdg = $this->getRequestParameter("typeIdg");
            $idg = "idg" . $typeIdg;

            if ($reporte) {
                if ($this->getRequestParameter("obsIdg" . $typeIdg . "_" . $oid))
                    $reporte->setProperty($idg, utf8_decode($this->getRequestParameter("obsIdg" . $typeIdg . "_" . $oid)));
                $reporte->save();
            }
        }
        $this->responseArray = array("success" => true);
        $this->setTemplate("responseTemplate");
    }

    public function executeLibroReferenciasAereo(sfWebRequest $request) {
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $idtrafico = $request->getParameter("idtrafico");
        $sucursal = $request->getParameter("sucursal");

        $this->detalle = $request->getParameter("detalle");

        if ($request->isMethod("post")) {

            $array_refs = array();
            if ($sucursal != "%") {
                $referencias = Doctrine::getTable("InoClientesAir")
                        ->createQuery("c")
                        ->select("DISTINCT c.ca_referencia")
                        ->innerJoin("c.Vendedor v")
                        ->innerJoin("v.Sucursal s")
                        ->addWhere("SUBSTR(c.ca_referencia, 8,2) LIKE ?", $mes)
                        ->addWhere("SUBSTR(c.ca_referencia, 16,2) LIKE ?", $anio)
                        ->addWhere("s.ca_nombre LIKE ?", $sucursal)
                        ->execute();
                foreach ($referencias as $referencia) {
                    $array_refs[] = $referencia->getCaReferencia();
                }
            }

            $array_refs = array();
            if ($sucursal != "%") {
                $referencias = Doctrine::getTable("InoClientesAir")
                        ->createQuery("c")
                        ->select("DISTINCT c.ca_referencia")
                        ->innerJoin("c.Vendedor v")
                        ->innerJoin("v.Sucursal s")
                        ->addWhere("SUBSTR(c.ca_referencia, 8,2) LIKE ?", $mes)
                        ->addWhere("SUBSTR(c.ca_referencia, 16,2) LIKE ?", $anio)
                        ->addWhere("s.ca_nombre LIKE ?", $sucursal)
                        ->execute();
                foreach ($referencias as $referencia) {
                    $array_refs[] = $referencia->getCaReferencia();
                }
            }

            $q = Doctrine::getTable("InoMaestraAir")
                    ->createQuery("m")
                    ->innerJoin("m.Origen o")
                    ->addWhere("SUBSTR(m.ca_referencia, 8,2) LIKE ?", $mes)
                    ->addWhere("SUBSTR(m.ca_referencia, 16,2) LIKE ?", $anio)
                    ->addWhere("o.ca_idtrafico LIKE ?", $idtrafico);

            if ($this->detalle) {
                $q->innerJoin("m.InoClientesAir c");
                $q->innerJoin("c.Cliente cl");

                if (count($array_refs) != 0) {
                    $q->whereIn("c.ca_referencia", $array_refs);
                }
            }

            $this->refs = $q->execute();

            $this->setTemplate("libroReferenciasAereoResult");
        } else {
            $this->traficos = Doctrine::getTable("Trafico")
                    ->createQuery("t")
                    ->addOrderBy("t.ca_nombre")
                    ->execute();

            $this->sucursales = Doctrine::getTable("Sucursal")
                    ->createQuery("s")
                    ->select("DISTINCT s.ca_nombre")
                    ->addWhere("s.ca_idsucursal <> ?", "999")
                    ->addOrderBy("s.ca_nombre")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                    ->execute();

            $this->sucursales = Doctrine::getTable("Sucursal")
                    ->createQuery("s")
                    ->select("DISTINCT s.ca_nombre")
                    ->addWhere("s.ca_idsucursal <> ?", "999")
                    ->addOrderBy("s.ca_nombre")
                    ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
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
        $where = "";

        if ($this->opcion) {
            if ($this->idmodalidad)
                $where.=" and rp.ca_modalidad='" . $this->idmodalidad . "'";
            if ($this->fechainicial && $this->fechafinal) {
                list($ano, $mes, $dia) = sscanf($this->fechainicial, "%d-%d-%d");
                $fechainicial = date("Y-m-d H:i:s", mktime(0, 0, 0, $mes, $dia, $ano));
                list($ano, $mes, $dia) = sscanf($this->fechafinal, "%d-%d-%d");
                $fechafinal = date("Y-m-d H:i:s", mktime(23, 59, 59, $mes, $dia, $ano));
            }
            if ($this->tipoInforme == "Volumen de Trabajo") {
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rps.ca_fchenvio::text,1,4) as ca_ano, substr(rps.ca_fchenvio::text,6,2) as ca_mes, rps.ca_usuenvio, count(rps.ca_idemail) as ca_cant_emails from tb_repstatus rps, tb_reportes rpt where rps.ca_fchenvio between '$fechainicial' and '$fechafinal' and  rpt.ca_idreporte = rps.ca_idreporte group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo)";
            } else if ($this->tipoInforme == "Reporte al Exterior") {
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rpa.ca_fchenvio::text,1,4) as ca_ano, substr(rpa.ca_fchenvio::text,6,2) as ca_mes, rpa.ca_usuenvio, count(rpa.ca_idemail) as ca_cant_emails from tb_emails rpa, tb_reportes rpt where rpa.ca_tipo like '%Rep.%Exterior%' and rpa.ca_fchenvio between '$fechainicial' and '$fechafinal' and rpt.ca_idreporte = rpa.ca_idcaso group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo) ";
            } else if ($this->tipoInforme == "Reportes AG") {
                $filtroTipoInforme = "RIGHT JOIN (select rpt.ca_consecutivo, substr(rpa.ca_fchenvio::text,1,4) as ca_ano, substr(rpa.ca_fchenvio::text,6,2) as ca_mes, rpa.ca_usuenvio, count(rpa.ca_idemail) as ca_cant_emails from tb_emails rpa, tb_reportes rpt where rpa.ca_tipo like '%Reporte Negocios AG%' and rpa.ca_fchenvio between '$fechainicial' and '$fechafinal' and rpt.ca_idreporte = rpa.ca_idcaso group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo) ";
            } else if ($this->tipoInforme == "Negocios nuevos") {
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

            //echo "<pre>";print_r($this->resul);echo "</pre>";
        }
    }

    public function executeReporteDesconsolidacion(sfWebRequest $request) {

        $this->opcion = $request->getParameter("opcion");
        if ($this->opcion) {
            $this->fechainicial = $request->getParameter("fechaInicial");
            $this->fechafinal = $request->getParameter("fechaFinal");
            
            $sql = "select (ca_fchvaciado-ca_fchconfirmacion) as diferencia , ca_referencia, ca_fchcreado,ca_fchvaciado,ca_fchconfirmacion,des.ca_ciudad
                from tb_inomaestra_sea m
                inner join tb_ciudades des on m.ca_destino=des.ca_idciudad
                where m.ca_fcharribo between '" . $this->fechainicial . "' and '" . $this->fechafinal . "' and m.ca_modalidad='LCL' and m.ca_fchconfirmacion is not null            
                order by m.ca_fchconfirmacion desc, 3 desc";
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->ref = $st->fetchAll();
        }
    }

    public function executeReporteRecibosCaja(sfWebRequest $request) {
        $this->opcion = $request->getParameter("opcion");
        if ($this->opcion) {
            $this->fechainicial = $request->getParameter("fechaInicial");
            $this->fechafinal = $request->getParameter("fechaFinal");
            $this->vendedor = $request->getParameter("login");
            $this->sucursal = $request->getParameter("sucursal");
            $this->tipo = $request->getParameter("tipo");

            $tipos = array("tb_inoclientes_sea", "tb_inoclientes_air", "tb_expo_maestra", "tb_brk_maestra");

            if ($this->tipo >= 0 && $this->tipo < 4) {
                if ($this->fechainicial && $this->fechafinal)
                    $where = " t.ca_fchcreado between '" . $this->fechainicial . "' and '" . $this->fechafinal . "' and ";
                $innerJoin = "INNER JOIN vi_clientes_reduc c ON c.ca_idcliente = t.ca_idcliente
                                  INNER JOIN control.tb_usuarios u on u.ca_login = c.ca_vendedor
                                  INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal";
                $join = "";
                if ($this->tipo == 0) {
                    $join = "INNER JOIN tb_inoingresos_sea ic ON t.ca_idinocliente = ic.ca_idinocliente ";
                } elseif ($this->tipo == 1) {
                    $join = "INNER JOIN tb_inoingresos_air ic ON t.ca_referencia = ic.ca_referencia and t.ca_idcliente = ic.ca_idcliente and t.ca_hawb = ic.ca_hawb ";
                } elseif ($this->tipo == 2) {
                    $join = "INNER JOIN tb_expo_ingresos ic ON t.ca_referencia = ic.ca_referencia and t.ca_idcliente = ic.ca_idcliente  ";
                } else if ($this->tipo == 3) {
                    $join = "INNER JOIN tb_brk_ingresos ic on t.ca_referencia = ic.ca_referencia ";
                }

                if ($this->sucursal) {
                    $where.= "s.ca_nombre ='" . $this->sucursal . "' and ";
                }
                if ($this->vendedor) {
                    $where.= " u.ca_login ='" . $this->vendedor . "' and ";
                }
                $sql = "SELECT ic.*,t.ca_referencia, c.ca_compania, u.ca_nombre as ca_vendedor, s.ca_nombre as ca_sucursal
                      FROM " . $tipos[$this->tipo] . " t
                        $join
                        $innerJoin
                      WHERE $where (ic.ca_reccaja='' or ic.ca_reccaja IS NULL)
                      ORDER BY ic.ca_fchfactura";

                $con = Doctrine_Manager::getInstance()->connection();
                $st = $con->execute($sql);
                $this->ref = $st->fetchAll();
            }
        }
    }

    public function executeListadoFacturas(sfWebRequest $request) {

        if ($request->isMethod("post")) {

            //print_r($request->getParameter("costo"));
            
            $q = Doctrine::getTable("InoCostosSea")
                    ->createQuery("c")
                    ->innerJoin("c.Costo cs")
                    ->innerJoin("c.UsuCreado u")
                    ->addWhere("substr(ca_referencia,5,2) like ?", $request->getParameter("sufijo"))
                    ->addWhere("ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                    ->addWhere("ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                    ->addWhere("ca_usucreado like ?", $request->getParameter("login"))                    
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY);


            if ($request->getParameter("proveedor")) {
                $q->addWhere("UPPER(ca_proveedor) like ?", strtoupper($request->getParameter("proveedor")) . "%");
            }
            if ($request->getParameter("factura")) {
                $q->addWhere("UPPER(ca_factura) like ?", strtoupper($request->getParameter("factura")) . "%");
            }
            
            if(count($request->getParameter("costo"))>0)
            {
                $q->andWhereIn("ca_idcosto", $request->getParameter("costo") );                
            }
            
            if($request->getParameter("sucursal")!="")
            {
                $q->addWhere("u.ca_idsucursal = ?", $request->getParameter("sucursal"));
            }
            

            $this->costos = $q->execute();

            $this->setTemplate("listadoFacturasResult");
            
        } else {
            $this->costos = Doctrine::getTable("Costo")
                    ->createQuery("c")
                    ->where("c.ca_impoexpo = ? and c.ca_transporte=? ", array(Constantes::IMPO,Constantes::MARITIMO))
                    ->OrderBy("c.ca_costo")
                    ->addOrderBy("c.ca_modalidad")
                    ->execute();
            
            $this->usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->addWhere("u.ca_activo = ? ", true)
                    ->addOrderBy("u.ca_nombre")
                    ->execute();
            
            $this->sucursales = Doctrine::getTable("Sucursal")
                ->createQuery("s")                
                ->addOrderBy("s.ca_nombre")
                ->addWhere("s.ca_idempresa=?", $this->getUser()->getIdempresa())                
                ->execute();
            //print_r(count($this->sucursales));

        }
    }

    public function executeListadoFacturasClie(sfWebRequest $request) {

        if ($request->isMethod("post")) {

            $q = Doctrine::getTable("InoIngresosSea")
                    ->createQuery("ii")
                    ->innerJoin("ii.InoClientesSea ics")
                    ->addWhere("substr(ics.ca_referencia,5,2) like ?", $request->getParameter("sufijo"))
                    ->addWhere("ii.ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                    ->addWhere("ii.ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                    ->addWhere("ii.ca_usucreado like ?", $request->getParameter("login"));

            if ($request->getParameter("cliente")) {
                $q->innerJoin("ii.Cliente cl");
                $q->innerJoin("cl.Ids id");
                $q->addWhere("UPPER(id.ca_nombre) like ?", strtoupper($request->getParameter("cliente")) . "%");
            }
            if ($request->getParameter("factura")) {
                $q->addWhere("UPPER(ca_factura) like ?", strtoupper($request->getParameter("factura")) . "%");
            }
            $this->ingresos = $q->execute();

            $this->setTemplate("listadoFacturasClieResult");
        } else {
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

            if ($this->idorigen && $this->idorigen != '999-9999') {
                $q->addWhere("r.ca_origen = ?", $this->idorigen);
            }
            if ($this->idagente) {
                $q->addWhere("r.ca_idagente = ?", $this->idagente);
            }
            if ($this->sucursal) {
                $q->addWhere("u.ca_idsucursal = ?", $this->sucursal);
            }

            $this->bls = $q->execute();
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

    public function executeEstadisticasExportaciones(sfWebRequest $request) {

        $this->aa = $request->getParameter("aa");
        $this->nmm = $request->getParameter("nmes");

        if ($this->nmm) {
            foreach ($this->nmm as $m) {
                if ($m != "")
                    $mm[] = str_pad($m, 2, "0", STR_PAD_LEFT);
            }
        }

        $this->idtransporte = $this->getRequestParameter("idtransporte");
        $this->transporte = $this->getRequestParameter("transporte");
        $this->idmodalidad = $request->getParameter("idmodalidad");

        $this->pais_origen = "CO-057";
        $this->origen = $request->getParameter("origen");
        $this->ciu_origen = $request->getParameter("ciu_origen");

        $this->idpais_destino = $request->getParameter("idpais_destino");

        $this->idagente = $request->getParameter("idagente");
        $this->agente = $request->getParameter("agente");

        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");

        $this->sucursal = $request->getParameter("sucursal");
        $this->idSucursal = $request->getParameter("idSucursal");

        $this->idcliente = $request->getParameter("idcliente");
        $this->cliente = $request->getParameter("cliente");
        
        $this->estado = $request->getParameter("estado");
        $this->vendedor = $request->getParameter("vendedor");
        $this->login = $request->getParameter("login");
        $this->opcion = $request->getParameter("opcion");
        

        if ($this->opcion) {

            if ($this->transporte && $this->transporte == "Aéreo") {
                $this->transporte = "Aereo";
            } else if ($this->transporte == "Marítimo") {
                $this->transporte = "Maritimo";
            }

            if ($this->aa) {
                $where.= "and SUBSTR(a.ca_referencia,16,2) IN ('" . ($this->aa % 100) . "')";
            }

            if ($mm) {
                if (count($mm) > 0) {
                    $mes = "";
                    for ($i = 0; $i < count($mm); $i++) {
                        $mes.= "'" . $mm[$i] . "',";
                    }
                    if (strpos($mes, 'Todos los meses') != true)
                        $where.= " and SUBSTR(a.ca_referencia,8,2) IN (" . substr($mes, 0, -1) . ")";
                }
            }

            if ($this->transporte!="Todos")
                $where.= " and a.ca_via ='" . $this->transporte . "'";

            if ($this->idmodalidad && $this->transporte == "Maritimo")
                $where.=" and em.ca_modalidad='" . $this->idmodalidad . "'";

            if ($this->ciu_origen)
                $where.=" and a.ca_origen='" . $this->ciu_origen . "'";

            if ($this->idpais_destino)
                $where.=" and tra_des.ca_idtrafico='" . $this->idpais_destino . "'";

            if ($this->idagente)
                $where.=" and a.ca_idagente='" . $this->idagente . "'";

            if ($this->idlinea) {
                if ($this->transporte == "Maritimo") {
                    $where.=" and em.ca_idnaviera='" . $this->idlinea . "'";
                } else if ($this->transporte == "Aereo") {
                    $where.=" and ea.ca_idaerolinea='" . $this->idlinea . "'";
                }
            }

            if ($this->sucursal){
                if($this->sucursal != "999")
                    $where.=" and s.ca_nombre='" . $this->idSucursal . "'";
            }

            if ($this->idcliente)
                $where.=" and a.ca_idcliente='" . $this->idcliente . "'";
            
            if ($this->login)
                $where.=" and u.ca_login='" . $this->login . "'";
            
            if ($this->estado){
                if($this->estado == "Abierto")
                    $where.=" and a.ca_fchcerrado IS NULL";
                else if($this->estado == "Cerrado")
                    $where.=" and a.ca_fchcerrado IS NOT NULL";
                else if($this->estado == "Sin Facturar")
                    $where.=" and ei.ca_loginvendedor IS NULL";
                else{
                    $where.=" and q.ca_consecutivo IS NOT NULL";
                    $select = ", q.ca_consecutivo as ca_anulado";
                    $join = "LEFT JOIN (
                            SELECT max(r.ca_consecutivo) as ca_consecutivo
                            FROM tb_repstatus rs
                                    LEFT JOIN tb_reportes r ON rs.ca_idreporte = r.ca_idreporte
                            WHERE rs.ca_idetapa = '00000' and ca_impoexpo = 'Exportación'
                            group by r.ca_consecutivo) AS q ON q.ca_consecutivo = a.ca_consecutivo";
                    $groupBy = ", ca_anulado";
                    
                }
            }

            $sql = "SELECT DISTINCT '201'||SUBSTR(a.ca_referencia,17,1) as ANO, 
                    SUBSTR(a.ca_referencia,8,2) as MES, 
                    a.ca_referencia AS REFERENCIA, 
                    a.ca_idcliente AS NIT, 
                    i.ca_nombre as CLIENTE,
                    id.ca_nombre as AGENTE, 
                    a.ca_producto AS PRODUCTO, 
                    tra_ori.ca_nombre AS TRAORIGEN, 
                    ori.ca_ciudad as CIUORIGEN, 
                    tra_des.ca_nombre AS TRADESTINO, 
                    des.ca_ciudad AS CIUDESTINO,
                    max(round(ca_ino,0)) as ca_ino, 
                    a.ca_valorcarga AS VALOR_CARGA, 
                    em.ca_modalidad AS MODALIDAD,
                    (select ca_concepto from tb_conceptos c join tb_expo_equipos e on c.ca_idconcepto = e.ca_idconcepto where c.ca_idconcepto = e.ca_idconcepto and e.ca_referencia = a.ca_referencia limit 1) AS CONCEPTO,
                    a.ca_peso AS PESO, 
                    a.ca_pesovolumen AS PESO_VOLUMEN, 
                    rp.ca_idreporte AS IDREPORTE,
                    a.ca_consecutivo AS RN, 
                    a.ca_nombrecons AS CONSIGNATARIO, 
                    u.ca_nombre as COMERCIAL,
                    s.ca_nombre AS SUCURSAL,
                    a.ca_via AS VIA,
                    ida.ca_nombre as AEROLINEA,
                    ids.ca_nombre as NAVIERA,
                    CASE WHEN a.ca_fchcerrado IS NULL  THEN  'Abierto'  ELSE  'Cerrado'  END,
                    (CASE WHEN em.ca_modalidad = 'FCL' THEN 
                        (( SELECT sum(t.ca_liminferior) AS sum 
                           FROM tb_expo_equipos eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto 
                           WHERE eq.ca_referencia = a.ca_referencia AND eq.ca_idconcepto = t.ca_idconcepto limit 1)/ 20)
                    ELSE null END ) as TEUS
                    $select
                    $select
                    FROM tb_expo_maestra as a 
                        LEFT OUTER JOIN tb_reportes rp ON rp.ca_idreporte = (SELECT ca_idreporte FROM tb_reportes WHERE ca_consecutivo = a.ca_consecutivo ORDER BY ca_version DESC limit 1)
                        LEFT OUTER JOIN (SELECT DISTINCT ca_referencia, ca_idnaviera, max(ca_modalidad) as ca_modalidad FROM tb_expo_maritimo GROUP BY ca_referencia, ca_idnaviera) as em ON a.ca_referencia = em.ca_referencia
                        LEFT OUTER JOIN tb_expo_aerea ea ON a.ca_referencia = ea.ca_referencia
                        LEFT OUTER JOIN ids.tb_ids ida ON ida.ca_id = ea.ca_idaerolinea
                        LEFT OUTER JOIN ids.tb_ids i ON a.ca_idcliente = i.ca_id
                        LEFT OUTER JOIN ids.tb_agentes ag ON a.ca_idagente = ag.ca_idagente
                        LEFT OUTER JOIN ids.tb_ids id ON id.ca_id = ag.ca_idagente 	
                        LEFT OUTER JOIN tb_expo_equipos ep ON a.ca_referencia = ep.ca_referencia
                        LEFT OUTER JOIN tb_conceptos cp ON ep.ca_idconcepto = cp.ca_idconcepto
                        LEFT OUTER JOIN tb_expo_ingresos ei ON ei.ca_referencia = a.ca_referencia
                        LEFT OUTER JOIN control.tb_usuarios u ON u.ca_login = ei.ca_loginvendedor
                        LEFT OUTER JOIN CONTROL.tb_sucursales s ON u.ca_idsucursal = s.ca_idsucursal
                        LEFT OUTER JOIN (select e.ca_referencia, sum((case when e.ca_moneda = 'COP' then 1 else f.ca_tasacambio end) * e.ca_venta - (case when e.ca_moneda = 'COP' then 1 else f.ca_tasacambio end) * e.ca_neta) as CA_INO from tb_expo_costos e left outer join tb_expo_ingresos f on e.ca_referencia = f.ca_referencia and f.ca_factura = e.ca_facturaing group by e.ca_referencia) ut ON ut.ca_referencia = a.ca_referencia
                        JOIN tb_ciudades ori ON ori.ca_idciudad = a.ca_origen
                        JOIN tb_traficos tra_ori ON tra_ori.ca_idtrafico = ori.ca_idtrafico
                        JOIN tb_ciudades des ON des.ca_idciudad = a.ca_destino
                        JOIN tb_traficos tra_des ON tra_des.ca_idtrafico = des.ca_idtrafico
                        LEFT OUTER JOIN ids.tb_proveedores p ON p.ca_idproveedor = em.ca_idnaviera
                        $join                        
                        LEFT OUTER JOIN ids.tb_ids ids ON p.ca_idproveedor = ids.ca_id,
                        tb_clientes as b
                    WHERE a.ca_idcliente=b.ca_idcliente and a.ca_origen=ori.ca_idciudad and a.ca_destino=des.ca_idciudad " . $where . "
                    GROUP BY ANO, MES, a.ca_referencia, a.ca_idcliente, CLIENTE, AGENTE, AEROLINEA, ca_producto, traorigen, ciuorigen, tradestino, ciudestino, ca_valorcarga, ca_via, em.ca_modalidad, cp.ca_concepto, ca_peso, ca_pesovolumen, idreporte, a.ca_fchcerrado, a.ca_consecutivo, a.ca_nombrecons, u.ca_nombre, s.ca_nombre,
                         (( SELECT sum(t.ca_liminferior) AS sum
                            FROM tb_expo_equipos eq
                                  JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
                            WHERE eq.ca_referencia = a.ca_referencia AND eq.ca_idconcepto = t.ca_idconcepto limit 1) / 20), NAVIERA $groupBy
                    ORDER BY ANO, MES, a.ca_referencia
                    ";

            $con = Doctrine_Manager::getInstance()->connection();
            // echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            $this->grid = array();
            $this->tipo = array();
            $this->origen = array();
            $this->cliente = array();
            $this->resumen = array();
            $this->traficos = array();
            $this->sea = array();
            $this->air = array();
            $this->vendedores = array();
            $tipo_transporte = array();
            
            $tipo_transporte[]="Aereo";
            $tipo_transporte[]="Maritimo";
            $tipo_transporte[]="Maritimo/Terrestre";
            $tipo_transporte[]="Terrestre";

            foreach ($this->resul as $r) {

                $this->tipo[($r["via"])][($r["sucursal"])][($r["mes"])] ++;
                
                $this->grid[($r["total_negocios"])][($r["sucursal"])][($r["mes"])] ++;
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["total_negocios"] ++;
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["peso"]+=$r["peso"];
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["ino"]+=$r["ca_ino"];
                
                $this->trafico[$r["ciuorigen"]][$r["tradestino"]][$r["mes"]]++;
            
                foreach($tipo_transporte as $key=>$val_trans){
                    if($val_trans==$r["via"])
                        $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$r["via"]]+=$r["ca_ino"];
                    else
                        $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans] = $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans]?$this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans]:null;                    
                }
                
                $this->resumen[($r["sucursal"])][($r["mes"])]["peso"]+=$r["peso"];
                $this->resumen[($r["sucursal"])][($r["mes"])]["volumen"]+=$r["peso_volumen"];
                $this->resumen[($r["sucursal"])][($r["mes"])]["teus"]+=$r["teus"];
                
                $this->traficos[$r["via"]][$r["ciuorigen"]][$r["tradestino"]][$r["mes"]]++;
                
                
                if($r["via"]=="Maritimo"){
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["casos"]++;
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["peso"]+=$r["peso"];
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["volumen"]+=$r["peso_volumen"];
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["teus"]+=$r["teus"];                        
                }else if($r["via"]=="Aereo"){
                    $this->air[$r["aerolinea"]][$r["mes"]]["casos"]++;
                    $this->air[$r["aerolinea"]][$r["mes"]]["peso"]+=$r["peso"];
                    $this->air[$r["aerolinea"]][$r["mes"]]["volumen"]+=$r["peso_volumen"];                    
                }
                
                $this->vendedores[$r["comercial"]][$r["via"]][$r["cliente"]][$r["mes"]]+=$r["ca_ino"];                
                                
            }
            ksort($this->tipo);            
        }
    }
    
    public function executeReporteMonitoreoRecargos(sfWebRequest $request) {
        $response = sfContext::getInstance()->getResponse();

        $this->fechaInicial = $request->getParameter("fechaInicial");
        $this->fechaFinal = $request->getParameter("fechaFinal");

        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->pais_origen = $request->getParameter("pais_origen");
        $this->iddestino = $request->getParameter("iddestino");
        $this->destino = $request->getParameter("destino");
        $this->idmodalidad = $request->getParameter("idmodalidad");
        $this->idlinea = $request->getParameter("idlinea");
        $this->linea = $request->getParameter("linea");
        $this->opcion = $request->getParameter("opcion");
        
        $andWhere = "";
        if ($this->pais_origen){
            $andWhere.= " and im.ca_traorigen = '".$this->pais_origen."'";
        }
        if ($this->destino){
            $andWhere.= " and im.ca_ciudestino = '".$this->destino."'";
        }
        if ($this->idlinea){
            $andWhere.= " and im.ca_idlinea = '".$this->idlinea."'";
        }
        if ($this->idmodalidad){
            $andWhere.= " and im.ca_modalidad = '".$this->idmodalidad."'";
        }
           
        if ($this->opcion) {
            $annos = array();
            $meses = array();
            while ($this->fechaInicial <= $this->fechaFinal){
                list($ano, $mes, $dia) = sscanf($this->fechaInicial, "%d-%d-%d");
                if (!in_array($ano, $annos)){
                    $annos[] = $ano;
                }
                if (!in_array($mes, $meses)){
                    $meses[] = $mes;
                }
                $this->fechaInicial = date("Y-m-d", mktime(0, 0, 0, $mes, $dia+1, $ano));
            }
            $this->fechaInicial = $request->getParameter("fechaInicial");
            
            $sql = "select im.ca_ano, im.ca_mes, im.ca_referencia, im.ca_fchreferencia, im.ca_traorigen, im.ca_ciuorigen, im.ca_ciudestino, im.ca_volumen, im.ca_idlinea, ic.ca_idcosto, cs.ca_costo, ic.ca_factura, ic.ca_fchfactura, ic.ca_proveedor, "
               . "      ic.ca_idmoneda, ic.ca_tcambio, ic.ca_neto, ic.ca_tcambio_usd, round(ic.ca_neto * ic.ca_tcambio / ic.ca_tcambio_usd,0) as ca_total_costo "
               . "      from tb_inocostos_sea ic inner join vi_inomaestra_sea im on im.ca_referencia = ic.ca_referencia inner join tb_costos cs on cs.ca_idcosto = ic.ca_idcosto and cs.ca_parametros = 'Monitoreado' "
               . "where im.ca_fchcerrado IS NOT NULL and im.ca_ano in (" . implode(",", $annos) . ") and im.ca_mes::int in (" . implode(",", $meses) . ") $andWhere"
               . "      order by im.ca_ano, im.ca_mes, im.ca_traorigen, im.ca_ciuorigen, im.ca_ciudestino, ic.ca_referencia, cs.ca_costo"; 
            
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();           
        }
        
    }
    
    public function executeCargaPorSucursal(sfWebRequest $request) {
        
        $this->aa = $request->getParameter("aa");
        $this->nmes = $request->getParameter("nmes");
        $this->mes = $request->getParameter("mes");
        $this->idpais_origen = $request->getParameter("idpais_origen");
        $this->pais_origen = $request->getParameter("pais_origen");
        $this->idciuorigen = $request->getParameter("idciuorigen");
        $this->ciuorigen = $request->getParameter("ciuorigen");
        $this->idcliente = $request->getParameter("idcliente");
        $this->cliente = $request->getParameter("Cliente");
        $this->idsucursal = $request->getParameter("idsucursal");
        $this->sucursal = $request->getParameter("sucursal");
        $this->estado = $request->getParameter("estado");
        $this->opcion = $request->getParameter("opcion");
        
        if($this->opcion){
            $andWhere = "";        
            if ($mm) {
                if (count($mm) > 0) {
                    $mes = "";
                    for ($i = 0; $i < count($mm); $i++) {
                        $mes.= "'" . $mm[$i] . "',";
                    }
                    if (strpos($mes, 'Todos los meses') != true)
                        $where.= " and ca_mes IN (" . substr($mes, 0, -1) . ")";
                }
            }
            if ($this->pais_origen){
                $andWhere.= " and ca_traorigen = '".$this->pais_origen."'";
            }
            if ($this->ciuorigen){
                $andWhere.= " and ca_ciuorigen = '".$this->ciuorigen."'";
            }
            if ($this->idcliente){
                $andWhere.=" and ca_compania like '%" . $this->cliente . "%'";
            }
            if ($this->idsucursal){
                if($this->idsucursal != "999")
                    $andWhere.=" and ca_sucursal like '%" . $this->sucursal . "%'";
            }
            if ($this->estado){
                $andWhere.= " and ca_estado = '".$this->estado."'";
            }

            $sql = "SELECT ca_sucursal, ca_ano, ca_mes, ca_traorigen, ca_ciuorigen, (CASE WHEN ca_modalidad = 'COLOADING' THEN 'LCL' ELSE ca_modalidad END) as ca_modalidad, ca_referencia, ca_hbls, ca_compania, ca_cbm, ca_teus, ca_estado "               
                   . "FROM vi_repgerencia_sea rg "
                   . "where ca_ano = '".$this->aa."' $andWhere" ; 

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            //echo "<pre>";print_r($this->data);echo "</pre>";
            
            $this->fcl = array();
            $this->lcl = array();
            
            foreach ($this->resul as $r) {                
                
                if($r["ca_modalidad"]=="FCL"){
                    $this->fcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["teus"]+=$r["ca_teus"];
                    $this->fcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["hbls"]++;                    
                }
                
                if($r["ca_modalidad"]=="LCL"){
                    $this->lcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["hbls"]++;
                    $this->lcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["cbm"]+=$r["ca_cbm"];
                }
            }            
        }
    }

    /**
     * Esta accion permitirá la apertura de varias referencias
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteComisionesXCobrar(sfWebRequest $request) {
        $this->annos = array();
        for ($i = (date("Y")); $i >= (date("Y") - 5); $i--) {
            $this->annos[] = $i;
        }

        // "%" => "Todos los Meses", 
        $this->meses = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");

        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select DISTINCT ca_nombre as ca_sucursal from control.tb_sucursales where ca_idempresa = 2 order by ca_sucursal";
        $rs = $con->execute($sql);
        $sucursales_rs = $rs->fetchAll();
        $this->sucursales = array();
        foreach ($sucursales_rs as $sucursal) {
            $this->sucursales[$sucursal["ca_sucursal"]] = $sucursal["ca_sucursal"];
        }

        $usuarios_rs = Doctrine::getTable("Usuario")
           ->createQuery("u")
           ->innerJoin("u.Sucursal s")
           ->addWhere("u.ca_departamento='Comercial' or u.ca_cargo='Representante de Ventas'")
           ->orderBy("u.ca_login")
           ->execute();
        $this->vendedores = array();
        $this->vendedores["%"] = "Usuarios (Todos)";
        foreach ($usuarios_rs as $usuario) {
            $this->vendedores[$usuario->getCaLogin()] = $usuario->getCaNombre();
        }

        $this->resultados = array("%" => "Todos los Casos", "Perdida" => "Casos con Perdida", "Utilidad" => "Casos con Utilidad");
        $this->estados = array("%" => "Todos los Casos", "Cerrado" => "Casos Cerrados", "Abierto" => "Casos Abiertos");
        $this->circulares = array("%" => "Todos los Casos", "Vigente" => "Vigente", "Vencido" => "Vencido", "Sin" => "Sin");
        
        $incoterms_rs = ParametroTable::retrieveByCaso("CU062");
        
        $this->incoterms = array();
        $this->incoterms["%"] = "Incoterms (Todos)";
        foreach ($incoterms_rs as $incoterm) {
            $this->incoterms[$incoterm->getCaValor()] = $incoterm->getCaValor();
        }
    }

    /**
     * Lista de referencias con opción de apertura
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteComisionesXCobrarList(sfWebRequest $request) {
        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/GroupSummary",'last');
        
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $sucursal = $request->getParameter("selSucursal");
        $usuario = $request->getParameter("selUsuario");
        $circular = $request->getParameter("selCircular");
        $resultado = $request->getParameter("selResultado");
        $casos = $request->getParameter("selCasos");
        $incoterms = $request->getParameter("selIncoterms");
        
        if ($mes == "%") {
            $mes = date('m');
        }

        $meses = array();
        $fch_fin = mktime(0, 0, 0, $mes, 1, $anio);

        $fch_ini = mktime(0, 0, 0, 1, 1, $anio - 5); // FIX Menos el # de años que se desea analizar = 5
        list($anio, $mes, $dia) = sscanf(date('Y-m-d', $fch_ini), "%d-%d-%d");

        while ($fch_ini <= $fch_fin) {
            $fch_ini = mktime(0, 0, 0, $mes, $dia, $anio);
            list($anio, $mes, $dia) = sscanf(date('Y-m-d', $fch_ini), "%d-%d-%d");

            $meses[] = date('Y-m', $fch_ini);
            $mes++;
        }

        $meses = implode("','", $meses);
        $condicion = "ca_ano::text||'-'||ca_mes::text in ('$meses')";
        
        if ($sucursal != "Todas Las sucursales") {
            $condicion.= " and ca_sucursal = '$sucursal' ";
        }

        if ($usuario != "%") {
            $condicion.= " and ca_login like '$usuario' ";
        }
        
        if ($circular != "%") {
            $condicion.= " and ca_stdcircular = '$circular' ";
        }
        
        if ($casos != "%") {
            $condicion.= " and ca_estado = '$casos' ";
        }
        
        $columnas = "ca_oid, ca_referencia, ca_compania, ca_hbls, ca_incoterms, ca_factura, ca_fchfactura, ca_valor, ca_reccaja, ca_fchpago, ca_vlrcomisiones, ca_sbrcomisiones, ca_estado, ca_fchcerrado, ca_facturacion_r, ca_deduccion_r, ca_utilidad_r, ca_volumen_r, ca_vlrutilidad_liq, ca_volumen, ca_porcentaje, ca_sbrcomision, ca_stdcircular, ca_login, ca_sucursal";
        
        $con = Doctrine_Manager::getInstance()->connection();
        $sql = "select $columnas from vi_inoingresos_sea where $condicion";
        $rs = $con->execute($sql);
        $comisiones_rs = $rs->fetchAll();
        
        $data = array();
        $key_tmp = null;
        foreach ($comisiones_rs as $key => $comision) {
            $row = array();
            foreach (split(", ", $columnas) as $columna){
                $row[$columna] = utf8_encode($comision[$columna]);
            }
            
            $ca_vlrcomisiones_caus = 0;
            if ($row["ca_vlrutilidad_liq"] != 0){
                $ca_vlrcomisiones_caus = round($row["ca_vlrutilidad_liq"] * $row["ca_porcentaje"] / 100, 0);
            }else{
                $ca_vlrcomisiones_caus = round(($row["ca_facturacion_r"] - $row["ca_deduccion_r"] - $row["ca_utilidad_r"]) * ($row["ca_volumen"] / $row["ca_volumen_r"]) * $row["ca_porcentaje"] / 100, 0);
            }
            $ca_sbrcomisiones_caus = round($row["ca_sbrcomision"] * $row["ca_porcentaje"] / 100, 0);
            
            if ($row["ca_referencia"]."|".$row["ca_hbls"] != $key_tmp){
                $row["ca_vlrcomisiones_caus"] = $ca_vlrcomisiones_caus;
                $row["ca_sbrcomisiones_caus"] = $ca_sbrcomisiones_caus;
                $ca_corrientes_dif = $ca_vlrcomisiones_caus - $row["ca_vlrcomisiones"];
                $ca_sobreventa_dif = $ca_sbrcomisiones_caus - $row["ca_sbrcomisiones"];

                $row["ca_corrientes_dif"] = $ca_corrientes_dif;
                $row["ca_sobreventa_dif"] = $ca_sobreventa_dif;
            }else{
                $row["ca_vlrcomisiones_caus"] = 0;
                $row["ca_sbrcomisiones_caus"] = 0;
                $row["ca_corrientes_dif"] = 0;
                $row["ca_sobreventa_dif"] = 0;
            }
            $key_tmp = $row["ca_referencia"]."|".$row["ca_hbls"];
            
            $condicion_utilidad = false;
            if ($ca_corrientes_dif != 0 or $ca_sobreventa_dif != 0){
                if ($resultado == "Perdida" and ($ca_corrientes_dif < 0 or $ca_sobreventa_dif < 0)){
                    $condicion_utilidad = true;
                }else if ($resultado == "Utilidad" and ($ca_corrientes_dif > 0 or $ca_sobreventa_dif > 0)){
                    $condicion_utilidad = true;
                }else if ($resultado == "%"){
                    $condicion_utilidad = true;
                }
            }
            
            $condicion_incoterm = false;
            if ($incoterms[0] !== "%"){
                $incoterm_array = explode("|", $row["ca_incoterms"]);
                foreach ($incoterm_array as $incoterm){
                    if (in_array($incoterm, $incoterms)){
                        $condicion_incoterm = true;
                        break;
                    }
                }
            }else{
                $condicion_incoterm = true;
            }
            
            if ($condicion_utilidad and $condicion_incoterm){
                $data[] = $row;
            }
        }
        $this->comisiones = $data;
    }
}
?>
