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
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
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
                    $this->pais_origen .= ( $this->pais_origen != "") ? "," . $origen->getCaIdtrafico() : $origen->getCaIdtrafico();
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
        $this->fecharepinicial = $request->getParameter("fechaRepInicial");
        $this->fecharepfinal = $request->getParameter("fechaRepFinal");
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

        $this->ntipo = $request->getParameter("ntipo");
        $this->tipo = $request->getParameter("tipo");


        if ($this->opcion) {

            if ($this->idmodalidad)
                $where .= " and m.ca_modalidad='" . $this->idmodalidad . "'";

            if ($this->fechainicial && $this->fechafinal)
                $where .= " and (m.ca_fchreferencia between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
            if ($this->fechaembinicial && $this->fechaembfinal)
                $where .= " and (m.ca_fchembarque between '" . $this->fechaembinicial . "' and '" . $this->fechaembfinal . "')";
            if ($this->fechaarrinicial && $this->fechaarrfinal)
                $where .= " and (m.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";

            if ($this->idpais_origen)
                $where .= " and ori.ca_idtrafico='" . $this->idpais_origen . "'";
            else if ($this->nivel == "1") {
                $paises = "";
                $pais_origen = explode(",", $this->pais_origen);
                foreach ($pais_origen as $pais) {
                    $paises .= ( $paises != "") ? "," . "'" . $pais . "'" : "'" . $pais . "'";
                }
                $where .= " and ori.ca_idtrafico in (" . $paises . ")";
            }
            if ($this->idorigen)
                $where .= " and m.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where .= " and des.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where .= " and m.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where .= " and m.ca_idlinea='" . $this->idlinea . "'";
            if (!$this->proyectos)
                $where .= " and m.ca_modalidad NOT IN ('PROYECTOS','PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            else
                $where .= " and m.ca_modalidad NOT IN ('PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";

            $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            $joinclientes = "";
            if ($this->incoterms && count($this->incoterms) > 0) {
                if (implode("", $this->incoterms) != "") {
                    $where .= " and (";
                    foreach ($this->incoterms as $key => $inco) {
                        if ($key > 0)
                            $where .= " or ";
                        $where .= " vpr.ca_incoterms like '" . $inco . "%'";
                    }
                    $where .= " )";
                }
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            }

            if ($this->idagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where .= " and r.ca_idagente = '" . $this->idagente . "'";
            }

            if ($this->fecharepinicial && $this->fecharepfinal) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where .= " and (r.ca_fchreporte between '" . $this->fecharepinicial . "' and '" . $this->fecharepfinal . "')";
            }

            if ($this->idsucursalagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where .= " and r.ca_idsucursalagente = '" . $this->idsucursalagente . "'";
            }

            if ($this->idcliente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $joinclientes = "JOIN tb_concliente cc ON cc.ca_idcontacto=r.ca_idconcliente";
                $where .= " and cc.ca_idcliente = '" . $this->idcliente . "'";
            }
            $joinreportes .= "JOIN vi_repproveedores vpr ON r.ca_idreporte = vpr.ca_idreporte ";
            if ($this->ntipo > 0)
                $where .= " and m.ca_tipo='" . $this->ntipo . "'";

            /*
             *                      Nov-09-2017  Se delimita la sub-consulta solo a la referencia y el id de reporte y no se tiene en cuenta ni el Incoterm ni el Agente
              ( SELECT sum(ca_peso) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS peso,
              ( SELECT sum(ca_numpiezas) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS piezas,
              ( SELECT sum(ca_volumen) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte in (select tr.ca_idreporte from tb_inoclientes_sea tics,tb_reportes tr where tics.ca_idreporte=tr.ca_idreporte and ca_referencia=m.ca_referencia and tr.ca_incoterms=r.ca_incoterms and r.ca_idagente=tr.ca_idagente ) ) AS volumen

             */
            $sql = "SELECT tt.ca_liminferior,m.ca_referencia, tt.ca_concepto,tt.ca_idconcepto, r.ca_fchreporte, m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, 
                        m.ca_origen, ori.ca_ciudad AS ori_ca_ciudad, m.ca_destino, des.ca_ciudad AS des_ca_ciudad, tra_ori.ca_idtrafico AS ori_ca_idtrafico, 
                        tra_ori.ca_nombre AS ori_ca_nombre, tra_des.ca_idtrafico AS des_ca_idtrafico, tra_des.ca_nombre AS des_ca_nombre, 
                        m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,ids1.ca_nombre as agente,r.ca_idreporte,vpr.ca_incoterms,r.ca_idagente,
                        (( SELECT sum(t.ca_liminferior) AS sum
                            FROM tb_inoequipos_sea eq
                                JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
                            WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 AS teus, 
                        ( SELECT count(*) AS count
                            FROM tb_inoequipos_sea eq
                            WHERE eq.ca_referencia::text = m.ca_referencia::text AND eq.ca_idconcepto = tt.ca_idconcepto) AS ncontenedores, 
                        count(DISTINCT c.ca_hbls) AS nhbls,
                        ( SELECT sum(CASE WHEN ca_peso IS NULL THEN 0::numeric ELSE ca_peso END) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte = r.ca_idreporte ) AS peso,
                        ( SELECT sum(CASE WHEN ca_numpiezas IS NULL THEN 0::numeric ELSE ca_numpiezas END) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte = r.ca_idreporte ) AS piezas,
                        ( SELECT sum(CASE WHEN ca_volumen IS NULL THEN 0::numeric ELSE ca_volumen END) AS count FROM tb_inoclientes_sea ics WHERE ics.ca_referencia::text = m.ca_referencia::text and ics.ca_idreporte = r.ca_idreporte ) AS volumen
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
                    GROUP BY tt.ca_liminferior,m.ca_referencia, tt.ca_concepto, tt.ca_idconcepto ,m.ca_fchembarque, m.ca_fcharribo, m.ca_fchreferencia, m.ca_origen, ori.ca_ciudad , m.ca_destino, des.ca_ciudad , tra_ori.ca_idtrafico , tra_ori.ca_nombre , tra_des.ca_idtrafico , tra_des.ca_nombre , m.ca_modalidad, m.ca_idlinea, ids.ca_nombre,ids1.ca_nombre,r.ca_idreporte,vpr.ca_incoterms,r.ca_idagente,
                            (( SELECT sum(t.ca_liminferior) AS sum FROM tb_inoequipos_sea eq JOIN tb_conceptos t ON eq.ca_idconcepto = t.ca_idconcepto
                                WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)) / 20 , 
                            ( SELECT count(*) AS count FROM tb_inoequipos_sea eq
                                WHERE eq.ca_referencia = m.ca_referencia AND eq.ca_idconcepto = tt.ca_idconcepto)
                    ORDER BY m.ca_fchreferencia, vpr.ca_incoterms ,r.ca_idagente";
            $con = Doctrine_Manager::getInstance()->connection();

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
                $where .= " and m.ca_modalidad='" . $this->idmodalidad . "'";
            if ($this->fechainicial && $this->fechafinal)
                $where .= " and (m.ca_fchreferencia between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
            if ($this->fechaembinicial && $this->fechaembfinal)
                $where .= " and (m.ca_fchsalida between '" . $this->fechaembinicial . "' and '" . $this->fechaembfinal . "')";
            if ($this->fechaarrinicial && $this->fechaarrfinal)
                $where .= " and (m.ca_fchllegada between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
            if ($this->idpais_origen)
                $where .= " and ori.ca_idtrafico='" . $this->idpais_origen . "'";
            else if ($this->nivel == "1") {
                $paises = "";
                $pais_origen = explode(",", $this->pais_origen);
                foreach ($pais_origen as $pais) {
                    $paises .= ( $paises != "") ? "," . "'" . $pais . "'" : "'" . $pais . "'";
                }
                $where .= " and ori.ca_idtrafico in (" . $paises . ")";
            }
            if ($this->idorigen)
                $where .= " and m.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where .= " and des.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where .= " and m.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where .= " and m.ca_idlinea='" . $this->idlinea . "'";
            if ($this->impoexpo)
                $where .= " and m.ca_impoexpo='" . $this->impoexpo . "'";
            if (!$this->proyectos)
                $where .= " and m.ca_modalidad NOT IN ('PROYECTOS','PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";
            else
                $where .= " and m.ca_modalidad NOT IN ('PARTICULARES') and m.ca_impoexpo <> 'OTM/DTA'";

            $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            $joinclientes = "";
            if ($this->incoterms && count($this->incoterms) > 0) {
                $where .= " and (";
                foreach ($this->incoterms as $key => $inco) {
                    if ($key > 0)
                        $where .= " or ";
                    $where .= " r.ca_incoterms like '" . $inco . "%'";
                }
                $where .= " )";
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
            }

            if ($this->idagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where .= " and r.ca_idagente = '" . $this->idagente . "'";
            }

            if ($this->idsucursalagente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $where .= " and r.ca_idsucursalagente = '" . $this->idsucursalagente . "'";
            }

            if ($this->idcliente) {
                $joinreportes = "JOIN tb_reportes r ON c.ca_idreporte = r.ca_idreporte ";
                $joinclientes = "JOIN tb_concliente cc ON cc.ca_idcontacto=r.ca_idconcliente";
                $where .= " and cc.ca_idcliente = '" . $this->idcliente . "'";
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

            Doctrine_Manager::getInstance()->setCurrentConnection('replica');
            $con = Doctrine_Manager::getInstance()->connection();
            echo $sql;
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();
        }

        if (count($this->incoterms) <= 0) {
            $this->incoterms = array();
        }
    }

    public function executeEstadisticasMaritimo(sfWebRequest $request) {


        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

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
                $where .= " and ca_ano in ('" . ($this->year) . "','" . ($this->year - 1) . "')";

            if (count($this->nmes) > 0) {
                $this->nmes = array_diff($this->nmes, array(""));
                if ($this->nmes[0] != "")
                    $where .= " and ca_mes::integer in (" . (implode(",", $this->nmes)) . ")";
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

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');

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
        //$this->fechafinal = Utils::addDate(Utils::addDate($ano . "-" . $this->mes . "-01", 0, 0, 0, "Y-m-01"), -1);
        //$this->fechainicial = Utils::addDate(Utils::addDate($this->fechafinal, 1, 0, 0, "Y-m-01"), 0, 0, 0, "Y-m-d");

        $this->fechafinal = $request->getParameter("fechaFinal");
        $this->fechainicial = $request->getParameter("fechaInicial");

        $this->fechafinal3 = Utils::addDate(Utils::addDate($ano . "-" . $this->mes . "-01", 0, 0, 0, "Y-m-01"), -1);
        $this->fechainicial3 = Utils::addDate(Utils::addDate($this->fechafinal3, 1, 0, 0, "Y-m-01"), 0, 0, 0, "Y-m-d");

        $this->fechainicial1 = Utils::addDate($request->getParameter("fechaInicial"), 0, 0, -1);
        $this->fechafinal1 = Utils::addDate($this->fechafinal3, 0, 0, -1);

        $this->fechainicial2 = Utils::addDate($request->getParameter("fechaInicial"), 0, 0, -2);
        $this->fechafinal2 = Utils::addDate($this->fechafinal3, 0, 0, -2);



        if ($this->opcion) {

            if ($this->idsucursal) {
                if ($this->idsucursal == "BOG")
                    $where .= " and ca_idsucursal in('" . $this->idsucursal . "','ABO')";
                else
                    $where .= " and ca_idsucursal='" . $this->idsucursal . "'";
            }
            if ($this->departamento == "Cuentas Globales")
                $where .= " and ca_idcliente in (select ca_idcliente from vi_clientes_reduc where (ca_propiedades like '%cuentaglobal=true%' OR ca_propiedades like '%cuentaglobal=1%')) ";
            else if ($this->departamento == "Tráficos")
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where (ca_propiedades like '%cuentaglobal=true%' OR ca_propiedades like '%cuentaglobal=1%')) ";
            else if ($this->departamento == "Aéreo")
                $where .= " and ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where (ca_propiedades like '%cuentaglobal=true%' OR ca_propiedades like '%cuentaglobal=1%')) ";
            if ($this->transporte)
                $where .= " and ca_transporte ='" . $this->transporte . "'";

            //$this->nmeses = 3;
            $tra_principal = "'Alemania','Argentina','Belgica','Brasil','Chile','China','España','Estados Unidos','Inglaterra', 'Italia', 'Mexico','Taiwan'";

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_traorigen as origen
                    from vi_reportes_estadisticas where ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
                    group by ca_year,ca_mes,ca_traorigen
                    order by 4,2,3";

            Doctrine_Manager::getInstance()->setCurrentConnection('replica');
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            $origen = "";
            $this->grid = array();
            $this->totales = array();
            foreach ($this->resul as $r) {
                $this->grid[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totales[$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
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
                $this->totales[$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
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
                $this->totales_s[$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
            }

            $sql = "select count(*) as valor,ca_traorigen as origen,ca_year 
                    from vi_reportes_estadisticas
                    where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal3, "Y") . '-01-01') . "' and '" . $this->fechafinal3 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_traorigen in ($tra_principal) and ca_ciuorigen!='Shanghai'
                    group by ca_traorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            $this->gridCompara = array();
            $this->totalesCompara = array();

            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]] += $r["valor"];
            }

            $sql = "select count(*) as valor,ca_ciuorigen as origen,ca_year 
                    from vi_reportes_estadisticas
                    where (ca_fchreporte between '" . (Utils::parseDate($this->fechafinal3, "Y") . '-01-01') . "' and '" . $this->fechafinal3 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal1, "Y") . '-01-01') . "' and '" . $this->fechafinal1 . "' or ca_fchreporte between '" . (Utils::parseDate($this->fechafinal2, "Y") . '-01-01') . "' and '" . $this->fechafinal2 . "') $where and ca_ciuorigen='Shanghai'
                    group by ca_ciuorigen,ca_year order by 2,3,1";
            $st = $con->execute($sql);
            $this->compara = $st->fetchAll();

            foreach ($this->compara as $r) {
                $this->gridCompara[$r["origen"]][$r["ca_year"]] = $r["valor"];
                $this->totalesCompara[$r["ca_year"]] += $r["valor"];
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
                $this->totalesCompara_s[$r["ca_year"]] += $r["valor"];
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
                $this->totalesCliente[$r["origen"]]["totales"] += $r["valor"];
                $this->totalesCliente["totales"]["totales"] += $r["valor"];
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
                $this->totalesCliente[$r["origen"]][$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
                $this->totalesCliente["totales"][$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
            }
            /* CLIENTES X TRANSPORTE */
            $sql = "select count(*) as valor,ca_nombre_cli as cliente, ca_transporte
                    from vi_reportes_estadisticas 
                    where ca_fchreporte between '" . Utils::parseDate($this->fechainicial, "{$ano}-01-01") . "' and '" . $this->fechafinal . "' $where
                    group by ca_nombre_cli, ca_transporte
                    order by 2 ,1 desc";
            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();

            $this->gridClientes_t = array();
            $this->totalesCliente_t = array();
            foreach ($this->clientes as $r) {
                $this->gridClientes_t[$r["cliente"]][$r["ca_transporte"]]["totales"] = $r["valor"];
                $this->totalesCliente_t[$r["cliente"]]["totales"] += $r["valor"];
                $this->totalesCliente_t["totales"]["totales"] += $r["valor"];
            }

            $sql = "select count(*) as valor,ca_year,ca_mes,ca_transporte ,ca_nombre_cli as cliente
                    from vi_reportes_estadisticas 
                    where ca_fchreporte between '" . Utils::parseDate($this->fechainicial, "{$ano}-01-01") . "' and '" . $this->fechafinal . "' $where
                    group by ca_year,ca_mes,ca_transporte,ca_nombre_cli
                    order by 4,2,3,5";

            $st = $con->execute($sql);
            $this->clientes = $st->fetchAll();

            foreach ($this->clientes as $r) {
                $this->gridClientes_t[$r["cliente"]][$r["ca_transporte"]][$r["ca_year"] . "-" . $r["ca_mes"]] = $r["valor"];
                $this->totalesCliente_t[$r["cliente"]][$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
                $this->totalesCliente_t["totales"][$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
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
                $this->gridVendedores[$r["vendedor"]]["totales"] += $r["valor"];
                $this->totalesVendedores[$r["ca_year"] . "-" . $r["ca_mes"]] += $r["valor"];
                $this->totalesVendedores["totales"] += $r["valor"];
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
        $where1 .= "and ca_version=( SELECT max(rr.ca_version) AS max
           FROM tb_reportes rr
          WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text) ";

        if ($this->opcion) {

            if ($this->idmodalidad) {
                if ($this->idmodalidad == "LCL") {
                    $where .= " and m.ca_modalidad in ('" . $this->idmodalidad . "','" . Constantes::COLOADING . "')";
                    $where1 .= " and r.ca_modalidad in ('" . $this->idmodalidad . "','" . Constantes::COLOADING . "')";
                } else {
                    $where .= " and m.ca_modalidad='" . $this->idmodalidad . "'";
                    $where1 .= " and r.ca_modalidad='" . $this->idmodalidad . "'";
                }
            }

            if ($this->fechaarrinicial && $this->fechaarrfinal) {
                $where .= " and (m.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
                $where1 .= " and (o.ca_fcharribo between '" . $this->fechaarrinicial . "' and '" . $this->fechaarrfinal . "')";
            }
            if ($this->idorigen) {
                $where .= " and m.ca_destino='" . $this->idorigen . "'";
                $where1 .= " and r.ca_origen='" . $this->idorigen . "'";
            }
            if ($this->iddestino) {
                $where .= " and r.ca_continuacion_dest='" . $this->iddestino . "'";
                $where1 .= " and r.ca_destino='" . $this->iddestino . "'";
            }
            if ($this->idlinea) {
                $where .= " and m.ca_idlinea='" . $this->idlinea . "'";
                $where1 .= " and r.ca_idlinea='" . $this->idlinea . "'";
            }

            /* if ($this->incoterms && count($this->incoterms) > 0) {

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
              } */

            if ($this->idcliente)
                $where .= " and c.ca_idcliente = '" . $this->idcliente . "'";

            if ($this->sucursal) {
                $where .= " and u.ca_sucursal = '" . $this->sucursal . "'";
                $where1 .= " and u.ca_sucursal = '" . $this->sucursal . "'";
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
                    $select4 = ", ca_carga_disponible";
                    $join2 = "LEFT JOIN (select max(ca_idreporte) as ca_idreporte, max(substr(est.ca_propiedades, strpos(est.ca_propiedades, 'cargaDisponible=')+16,10)) as ca_carga_disponible FROM tb_repstatus est WHERE strpos(est.ca_propiedades, 'cargaDisponible=')>0 GROUP BY ca_idreporte) pro ON pro.ca_idreporte = rs.ca_idreporte";
                    $group2 = ", pro.ca_carga_disponible ORDER BY rp.ca_consecutivo";
                    break;
                case 2:
                    $select1 = ",ca_fchsalida_cd, (CASE WHEN sqa.ca_fchllegada-ca_fchsalida_cd = 0 THEN 1 ELSE sqa.ca_fchllegada-ca_fchsalida_cd END) as ca_diferencia";
                    $select2 = ",ca_fchsalida as ca_fchsalida_cd";
                    $where1 = "WHERE rs.ca_idetapa in ('IMCPD','IACAD')";
                    $where2 = "WHERE rs.ca_idetapa in ('IMETA','IMETT','IACCR','IMCEM')";
                    break;
                case 3:
                    $select1 = ",ca_fchsalida_eta, ca_fchsalida_ccr, (ca_fchsalida_eta-ca_fchsalida_ccr) as ca_diferencia";
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
                    $select1 = $this->transporte == "Marítimo" ? ",(select ca_factura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente order by ca_fchcreado ASC limit 1) as ca_factura, (select ca_fchfactura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente order by ca_fchcreado ASC limit 1) as ca_fchfactura, ((select ca_fchfactura FROM tb_inoingresos_sea ii WHERE ic.ca_idinocliente = ii.ca_idinocliente order by ca_fchcreado ASC limit 1)-sqa.ca_fchllegada) as ca_diferencia" : ",(select ca_factura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb order by ca_fchcreado ASC limit 1) as ca_factura, (select ca_fchfactura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb order by ca_fchcreado ASC limit 1) as ca_fchfactura, ((select ca_fchfactura FROM tb_inoingresos_air ii WHERE ic.ca_referencia = ii.ca_referencia and ic.ca_idcliente = ii.ca_idcliente and ic.ca_hawb= ii.ca_hawb order by ca_fchcreado ASC limit 1)-sqa.ca_fchllegada) as ca_diferencia";
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

            $wherePpal .= $this->transporte ? "AND v.ca_transporte IN ('" . $this->transporte . "')" : "";
            $wherePpal .= $this->pais_origen ? "AND v.ca_traorigen= '" . $this->pais_origen . "'" : "";
            $wherePpal .= $this->corigen ? "AND v.ca_ciuorigen = '" . $this->corigen . "'" : "";
            $wherePpal .= $this->cdestino ? "AND v.ca_ciudestino = '" . $this->cdestino . "'" : "";

            $sql = "SELECT DISTINCT sqa.ca_ano1, sqa.ca_mes1, v.ca_consecutivo, v.ca_orden_clie as ca_orden, date(v.ca_fchcreado) as ca_fchcreado, v.ca_idreporte, v.ca_traorigen, v.ca_ciuorigen, v.ca_ciudestino,v.ca_modalidad,v.ca_transporte, v.ca_nombre as proveedor, v.ca_propiedades, 
                            (CASE WHEN v.ca_modalidad = 'COLOADING' THEN 'LCL' ELSE v.ca_modalidad END) as nva_modalidad,  sqa.ca_fchllegada, sqa.ca_peso, sqa.ca_piezas as ca_piezas, sqa.ca_volumen, sqa.ca_doctransporte
                            $select1
                    FROM vi_repindicadores v
                        RIGHT OUTER JOIN ( SELECT extract(YEAR from rs.ca_fchllegada) as ca_ano1 ,extract(MONTH from rs.ca_fchllegada) as ca_mes1, ca_idreporte, ca_consecutivo, ca_fchllegada, ca_piezas, ca_peso, ca_volumen, ca_doctransporte
                                            $select2
                                            FROM tb_repstatus rs 
                                                RIGHT JOIN ( SELECT rp.ca_consecutivo, min(rs.ca_idstatus) as ca_idstatus 
                                                        FROM tb_repstatus rs 
                                                            INNER JOIN tb_reportes rp on rp.ca_idreporte = rs.ca_idreporte 
                                                        $where1 
                                                        GROUP BY rp.ca_consecutivo) sf on rs.ca_idstatus = sf.ca_idstatus)  sqa ON v.ca_consecutivo = sqa.ca_consecutivo
                        RIGHT OUTER JOIN (SELECT ca_consecutivo $select3 
                                            FROM tb_repstatus rs 
                                        RIGHT JOIN (SELECT rp.ca_consecutivo, max(rs.ca_idstatus) as ca_idstatus $select4
                                                    FROM tb_repstatus rs 
                                                        INNER JOIN tb_reportes rp on rp.ca_idreporte = rs.ca_idreporte
                                                        $join2
                                                    $where2 
                                            GROUP BY rp.ca_consecutivo $group2) sf on rs.ca_idstatus = sf.ca_idstatus)  sq ON v.ca_consecutivo = sq.ca_consecutivo
                        $joinPpal
                        $joinSec
                     WHERE v.ca_impoexpo IN ('" . Constantes::IMPO . "','" . Constantes::OTMDTA1 . "')                            
                           AND v.ca_idcliente = " . $this->idcliente . "                           
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
                        if ($this->typeidg != 6) {
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
                } else {
                    if ($r[$this->dataIdg] > $this->indi_AIR[$this->pais_origen ? $this->pais_origen : null] || $r[$this->dataIdg] > $this->indi_FCL[$this->pais_origen ? $this->pais_origen : null] || $r[$this->dataIdg] > $this->indi_LCL[$this->pais_origen ? $this->pais_origen : null])
                        $this->indicador[(int) ($r["ca_mes1"])]["incumplimiento"] ++;
                    else
                        $this->indicador[(int) ($r["ca_mes1"])]["cumplimiento"] ++;
                }

                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"] = (isset($this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"])) ? ($this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["conta"] + 1) : "1";
                if (count($this->resul) == 1) {
                    if (!$r[$this->dataIdg]) {
                        $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["diferencia"] = 1;
                    }
                }
                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["diferencia"] += $r[$this->dataIdg];

                list($peso, $medida) = explode("|", $r["ca_peso"]);
                $this->grid[$r["ca_ano1"]][$r["nva_modalidad"]][(int) ($r["ca_mes1"])]["peso"] += $peso;
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
                if ($sucursal != "%") {
                    $q->innerJoin("c.Vendedor v");
                    $q->innerJoin("v.Sucursal s");
                    $q->addWhere("s.ca_nombre LIKE ?", $sucursal);
                }

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
        //echo "Este informe está temporalmente fuera de Servicio. Por favor comunicarse al área de Sistemas";
        //exit();
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
                $where .= " and rp.ca_modalidad='" . $this->idmodalidad . "'";
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
                    $where .= " and (rp.ca_fchreporte between '" . $this->fechainicial . "' and '" . $this->fechafinal . "')";
                $filtroTipoInforme = "INNER JOIN (select rpt.ca_consecutivo, substr(rpt.ca_fchreporte::text,1,4) as ca_ano, substr(rpt.ca_fchreporte::text,6,2) as ca_mes, rps.ca_usuenvio, count(rps.ca_idemail) as ca_cant_emails from tb_repstatus rps, tb_reportes rpt where rpt.ca_idreporte = rps.ca_idreporte group by ca_ano, ca_mes, ca_consecutivo, ca_usuenvio) rf ON (rp.ca_consecutivo = rf.ca_consecutivo)";
            }
            if ($this->idpais_origen)
                $where .= " and tro.ca_idtrafico='" . $this->idpais_origen . "'";
            if ($this->idorigen)
                $where .= " and rp.ca_origen='" . $this->idorigen . "'";
            if ($this->idpais_destino)
                $where .= " and trd.ca_idtrafico='" . $this->idpais_destino . "'";
            if ($this->iddestino)
                $where .= " and rp.ca_destino='" . $this->iddestino . "'";
            if ($this->idlinea)
                $where .= " and rp.ca_idlinea='" . $this->idlinea . "'";

            /* if ($this->incoterms && count($this->incoterms) > 0) {

              $where.=" and (";
              foreach ($this->incoterms as $key => $inco) {
              if ($key > 0)
              $where.=" or ";
              $where.=" rp.ca_incoterms like '" . $inco . "%'";
              }
              $where.=" )";
              } */

            if ($this->idcliente)
                $where .= " and ccl.ca_idcliente = '" . $this->idcliente . "'";

            if ($this->idagente)
                $where .= " and agt.ca_idagente = '" . $this->idcliente . "'";

            if ($this->sucursal)
                $where .= " and sc.ca_nombre = (select ca_nombre from control.tb_sucursales where ca_idsucursal = '" . $this->sucursal . "')";

            if ($this->usuenvio)
                $where .= " and rf.ca_usuenvio = '" . $this->usuenvio . "'";

            if ($this->idDepartamento)
                $where .= " and op.ca_departamento = '" . $this->idDepartamento . "'";

            $sql = "SELECT distinct 
                        rf.ca_ano, rf.ca_mes, rp.ca_idreporte, rp.ca_fchreporte, rp.ca_consecutivo, rx.ca_version, sc.ca_nombre as ca_sucursal,
                        tro.ca_idtrafico, tro.ca_nombre as ca_traorigen, rp.ca_origen, cio.ca_ciudad as ca_ciuorigen, trd.ca_idtrafico, trd.ca_nombre as ca_tradestino, cid.ca_ciudad as ca_ciudestino, rp.ca_transporte,
                        rp.ca_modalidad, rp.ca_impoexpo, ccl.ca_idcliente, ccl.ca_compania, lin.ca_idlinea, lin.ca_nomtransportista, agt.ca_idagente, agt.ca_nombre as ca_nomagente, nn.ca_referencia, nn.ca_cant_negocios,
                        rf.ca_cant_emails, rf.ca_usuenvio, op.ca_nombre as ca_nomoperativo, op.ca_departamento, to_number(substr(rp.ca_consecutivo,0,position('-' in rp.ca_consecutivo)),'99999999') as ca_numero_rep

                    from tb_reportes rp
                        -- La última versión del reporte
                        INNER JOIN (select ca_consecutivo, ca_fchreporte, max(ca_version) as ca_version, min(ca_fchcreado) as ca_fchcreado from tb_reportes where ca_usuanulado IS NULL group by ca_consecutivo, ca_fchreporte order by ca_consecutivo) rx ON (rp.ca_consecutivo = rx.ca_consecutivo and rp.ca_version = rx.ca_version)
                        -- Dependiendo el tipo de Informe, toma los registros
                        $filtroTipoInforme
                       -- Calcula el numero de negocios
                        LEFT OUTER JOIN (select ca_referencia, ca_consecutivo, count(ca_doctransporte) as ca_cant_negocios from (select ca_referencia, ca_hbls as ca_doctransporte, ca_consecutivo::text from tb_inoclientes_sea ics INNER JOIN tb_reportes rpt ON rpt.ca_idreporte = ics.ca_idreporte union  select ca_referencia, ca_hawb as ca_doctransporte, ca_idreporte::text as ca_consecutivo from tb_inoclientes_air) as cn where ca_consecutivo IS NOT NULL group by ca_referencia, ca_consecutivo order by ca_consecutivo) nn ON (rp.ca_consecutivo = nn.ca_consecutivo)
                        INNER JOIN control.tb_usuarios us ON (rp.ca_login = us.ca_login)
                        INNER JOIN control.tb_sucursales sc ON (us.ca_idsucursal = sc.ca_idsucursal)
                        INNER JOIN control.tb_usuarios op ON (rf.ca_usuenvio = op.ca_login)
                        INNER JOIN tb_ciudades cio ON (rp.ca_origen = cio.ca_idciudad)
                        INNER JOIN tb_traficos tro ON (cio.ca_idtrafico = tro.ca_idtrafico)
                        INNER JOIN tb_ciudades cid ON (rp.ca_destino = cid.ca_idciudad)
                        INNER JOIN tb_traficos trd ON (cid.ca_idtrafico = trd.ca_idtrafico)
                        INNER JOIN vi_agentes agt ON (rp.ca_idagente = agt.ca_idagente)
                        INNER JOIN tb_concliente ccn ON (rp.ca_idconcliente = ccn.ca_idcontacto)
                        INNER JOIN vi_transporlineas lin ON (rp.ca_idlinea = lin.ca_idlinea)
                        INNER JOIN vi_clientes_reduc ccl ON (ccn.ca_idcliente = ccl.ca_idcliente)
                    $where
                    order by ca_ano, ca_mes, ca_compania, ca_traorigen, ca_numero_rep";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            //echo $sql;
            //exit;
            $this->resul = $st->fetchAll();

            //echo "<pre>";print_r($this->resul);echo "</pre>";
        }
    }

    public function executeReporteDesconsolidacion(sfWebRequest $request) {

        $this->opcion = $request->getParameter("opcion");
        if ($this->opcion) {
            $this->fechainicial = $request->getParameter("fechaInicial");
            $this->fechafinal = $request->getParameter("fechaFinal");

            $sql = "select (ca_fchvaciado-ca_fchconfirmacion) as diferencia , ca_referencia, m.ca_fchcreado, ca_fchvaciado, ca_fchconfirmacion, des.ca_ciudad
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
            $tiposC = array("t.ca_login", "t.ca_loginvendedor", "ic.ca_loginvendedor", "t.ca_vendedor");

            if ($this->tipo >= 0 && $this->tipo < 4) {
                if ($this->fechainicial && $this->fechafinal)
                    $where = " and t.ca_fchcreado between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  ";
                $innerJoin = "INNER JOIN vi_clientes_reduc c ON c.ca_idcliente = t.ca_idcliente
                                  INNER JOIN control.tb_usuarios u on u.ca_login = " . $tiposC[$this->tipo] . "
                                  INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal";
                $join = "";
                if ($this->tipo == 0) {
                    $join = "INNER JOIN tb_inoingresos_sea ic ON t.ca_idinocliente = ic.ca_idinocliente ";
                    if ($this->vendedor) {
                        $where .= " and t.ca_login ='" . $this->vendedor . "'  ";
                    }
                } elseif ($this->tipo == 1) {
                    $join = "INNER JOIN tb_inoingresos_air ic ON t.ca_referencia = ic.ca_referencia and t.ca_idcliente = ic.ca_idcliente and t.ca_hawb = ic.ca_hawb ";
                    if ($this->vendedor) {
                        $where .= " and t.ca_loginvendedor ='" . $this->vendedor . "'  ";
                    }
                } elseif ($this->tipo == 2) {
                    $join = "INNER JOIN tb_expo_ingresos ic ON t.ca_referencia = ic.ca_referencia and t.ca_idcliente = ic.ca_idcliente  ";
                    if ($this->vendedor) {
                        $where .= " and ic.ca_loginvendedor ='" . $this->vendedor . "'  ";
                    }
                } else if ($this->tipo == 3) {
                    $join = "INNER JOIN tb_brk_ingresos ic on t.ca_referencia = ic.ca_referencia ";
                    if ($this->vendedor) {
                        $where .= " and t.ca_vendedor ='" . $this->vendedor . "'  ";
                    }
                }

                if ($this->sucursal) {
                    $where .= "and s.ca_nombre ='" . $this->sucursal . "'  ";
                }
                /* if ($this->vendedor) {
                  $where.= " u.ca_login ='" . $this->vendedor . "' and ";
                  } */
                $sql = "SELECT ic.*,t.ca_referencia, c.ca_compania, u.ca_nombre as ca_vendedor, s.ca_nombre as ca_sucursal
                      FROM " . $tipos[$this->tipo] . " t
                        $join
                        $innerJoin
                      WHERE 1=1 $where  and (ic.ca_reccaja='' or ic.ca_reccaja IS NULL)
                      ORDER BY ic.ca_fchfactura";
            } else {
                if ($this->fechainicial && $this->fechafinal)
                    $where = " and c.ca_fchcomprobante between '" . $this->fechainicial . "' and '" . $this->fechafinal . "'  ";

                $sql = "SELECT c.*,m.ca_referencia,c.ca_fchcomprobante as ca_fchfactura,c.ca_consecutivo as ca_factura,cl.ca_compania, 
                        u.ca_nombre as ca_vendedor, s.ca_nombre as ca_sucursal,c.ca_idccosto,cc.ca_ccostosap as dat,tc.ca_tipo,tc.ca_comprobante,tc.ca_idempresa
                        FROM ino.tb_comprobantes c
                        INNER JOIN ino.tb_tipos_comprobante tc on c.ca_idtipo = tc.ca_idtipo and tc.ca_tipo='F'
                        INNER JOIN ino.tb_house h on h.ca_idhouse = c.ca_idhouse
                        INNER JOIN ino.tb_master m on m.ca_idmaster = h.ca_idmaster AND ca_impoexpo <> 'OTM-DTA'
                        INNER JOIN vi_clientes_reduc cl ON cl.ca_idcliente = c.ca_id
                        INNER JOIN control.tb_usuarios u on u.ca_login = h.ca_vendedor
                        INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                        LEFT JOIN ino.tb_ccostos cc ON c.ca_idccosto = cc.ca_idccosto
                      WHERE 1=1 $where  and ca_idcomprobante_cruce is null /*and c.ca_idccosto is not  null*/ and ca_estado=5
                      ORDER BY c.ca_idccosto,c.ca_fchcomprobante ";
            }
            //echo $sql;
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->ref = $st->fetchAll();
            $datos = array();


            /* ProjectConfiguration::registerZend();        
              $config = sfConfig::get('app_soap_sap');
              $client = new Zend_Soap_Client($config["wsdl_uri"], array('encoding' => 'ISO-8859-1', 'soap_version' => SOAP_1_2));


              foreach($this->ref as $k=>$d)
              {

              $datos["User"]= "manager";
              $datos["Password"]="912e79cd13c64069d91da65d62fbb78c";
              $datos["Company"]= ($d["ca_idempresa"]=="2")?"COLTRANS_PROD":"COLOTM_PROD";
              $datos["System"]="2";
              $datos["NumeroReferencia"]=$d["ca_referencia"];
              $datos["NumeroInterno"]=$d["ca_idcomprobante"];
              $datos["TipoDoc"]="V";
              //echo json_encode($datos);
              //exit;
              $resComp=$client->getDocuments(array('jsonDoc' =>json_encode($datos)));
              $l=json_decode($resComp->getDocumentsResult);
              $l=$l[0];
              //echo "<pre>";print_r($l);echo "</pre>";
              //exit;
              $this->ref[$k]["estado"]=$l->Estado;

              } */
            /* $datos["NumeroReferencia"]=$master->getCaReferencia();//"500.05.06.0108.18";
              //$datos["TipoDoc"]="V";
              $datos["Company"]=$path;
              echo "<pre>";
              $this->logs =IntTransaccionesOut::getDocumentsxParam($datos); */
            //echo "<pre>";print_r($this->ref);echo "</pre>";
        }
    }

    public function executeListadoFacturas(sfWebRequest $request) {

        $this->tipo = $request->getParameter("tipo");
        if ($request->isMethod("post")) {
            //print_r($request->getParameter("costo"));
            if ($this->tipo == "expo") {
                $q = Doctrine::getTable("InoCostoExpo")
                        ->createQuery("c")
                        //->select("*,c.ca_neta as ca_neto,c.ca_moneda as ca_idmoneda")
                        ->innerJoin("c.Costo cs")
                        ->innerJoin("c.UsuCreado u")
                        ->addWhere("ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                        ->addWhere("ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

                if ($request->getParameter("login")) {
                    $q->addWhere("ca_usucreado like ?", $request->getParameter("login"));
                }
            } else if ($this->tipo == "aereo") {
                $q = Doctrine::getTable("InoCostosAir")
                        ->createQuery("c")
                        //->select("*,c.ca_neta as ca_neto,c.ca_moneda as ca_idmoneda")
                        ->innerJoin("c.Costo cs")
                        //->leftJoin("c.Proveedor p")
                        ->innerJoin("c.UsuCreado u")
                        ->addWhere("ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                        ->addWhere("ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY);

                if ($request->getParameter("login")) {
                    $q->addWhere("ca_usucreado like ?", $request->getParameter("login"));
                }
            } else {
                $q = Doctrine::getTable("InoCostosSea")
                        ->createQuery("c")
                        ->innerJoin("c.Costo cs")
                        ->innerJoin("c.UsuCreado u")
                        ->addWhere("substr(ca_referencia,5,2) like ?", $request->getParameter("sufijo"))
                        ->addWhere("ca_fchfactura >= ?", $request->getParameter("fchInicial"))
                        ->addWhere("ca_fchfactura <= ?", $request->getParameter("fchFinal"))
                        ->addWhere("ca_usucreado like ?", $request->getParameter("login"))
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY);
            }

            if ($request->getParameter("proveedor")) {
                $q->addWhere("UPPER(ca_proveedor) like ?", strtoupper($request->getParameter("proveedor")) . "%");
            }
            if ($request->getParameter("factura")) {
                $q->addWhere("UPPER(ca_factura) like ?", strtoupper($request->getParameter("factura")) . "%");
            }

            if (count($request->getParameter("costo")) > 0) {
                $q->andWhereIn("ca_idcosto", $request->getParameter("costo"));
            }

            if ($request->getParameter("sucursal") != "") {
                $q->addWhere("u.ca_idsucursal = ?", $request->getParameter("sucursal"));
            }

            if ($request->getParameter("destino") != "%" && $request->getParameter("destino") != "") {
                if ($this->tipo == "expo")
                    $q->innerJoin("c.InoMaestraExpo m");
                else
                    $q->innerJoin("c.InoMaestraSea m");
                $q->addWhere("m.ca_destino = ?", $request->getParameter("destino"));
                $destino = Doctrine::getTable("Ciudad")->find($request->getParameter("destino"));
                if ($destino) {
                    $this->destino = $destino->getCaCiudad();
                }
            }
            $this->fchInicial = $request->getParameter("fchInicial");
            $this->fchFinal = $request->getParameter("fchFinal");
            //echo $q->getSqlQuery();
            $this->costos = $q->execute();
            //echo "<pre>";print_r($this->costos);echo "</pre>";

            $this->setTemplate("listadoFacturasResult");
        } else {
            if ($this->tipo == "expo") {
                $this->costos = Doctrine::getTable("Costo")
                        ->createQuery("c")
                        ->where("c.ca_impoexpo = ?  ", array('Exportacion'))
                        ->OrderBy("c.ca_costo")
                        ->addOrderBy("c.ca_modalidad")
                        ->execute();
                $this->destinos = Doctrine::getTable("Ciudad")
                        ->createQuery("c")
                        ->where("c.ca_idtrafico = ?", "CO-057")
                        //->addWhere("c.ca_puerto in ('Marítimo','Ambos')")
                        ->orderBy("c.ca_ciudad")
                        ->execute();
            } else if ($this->tipo == "aereo") {
                $this->costos = Doctrine::getTable("Costo")
                        ->createQuery("c")
                        ->where("c.ca_impoexpo = ? and c.ca_transporte=? ", array(Constantes::IMPO, Constantes::AEREO))
                        ->OrderBy("c.ca_costo")
                        ->addOrderBy("c.ca_modalidad")
                        ->execute();
                $this->destinos = Doctrine::getTable("Ciudad")
                        ->createQuery("c")
                        ->where("c.ca_idtrafico = ?", "CO-057")
                        ->addWhere("c.ca_puerto in ('Aéreo','Ambos')")
                        ->orderBy("c.ca_ciudad")
                        ->execute();
            } else {
                $this->costos = Doctrine::getTable("Costo")
                        ->createQuery("c")
                        ->where("c.ca_impoexpo = ? and c.ca_transporte=? ", array(Constantes::IMPO, Constantes::MARITIMO))
                        ->OrderBy("c.ca_costo")
                        ->addOrderBy("c.ca_modalidad")
                        ->execute();

                $this->destinos = Doctrine::getTable("Ciudad")
                        ->createQuery("c")
                        ->where("c.ca_idtrafico = ?", "CO-057")
                        ->addWhere("c.ca_puerto in ('Marítimo','Ambos')")
                        ->orderBy("c.ca_ciudad")
                        ->execute();
            }

            $this->usuarios = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    //->addWhere("u.ca_activo = ? ", true)
                    ->addOrderBy("u.ca_nombre")
                    ->execute();

            $this->sucursales = Doctrine::getTable("Sucursal")
                    ->createQuery("s")
                    ->addOrderBy("s.ca_nombre")
                    ->addWhere("s.ca_idempresa=?", $this->getUser()->getIdempresa())
                    ->execute();
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
                $q->innerJoin("ics.Cliente cl");
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
                $where .= "and SUBSTR(a.ca_referencia,16,2) IN ('" . str_pad(substr($this->aa, -2), 2, "0", STR_PAD_LEFT) . "')";
            }

            if ($mm) {
                if (count($mm) > 0) {
                    $mes = "";
                    for ($i = 0; $i < count($mm); $i++) {
                        $mes .= "'" . $mm[$i] . "',";
                    }
                    if (strpos($mes, 'Todos los meses') != true)
                        $where .= " and SUBSTR(a.ca_referencia,8,2) IN (" . substr($mes, 0, -1) . ")";
                }
            }

            if ($this->transporte != "Todos")
                $where .= " and a.ca_via ='" . $this->transporte . "'";

            if ($this->idmodalidad && $this->transporte == "Maritimo")
                $where .= " and em.ca_modalidad='" . $this->idmodalidad . "'";

            if ($this->ciu_origen)
                $where .= " and a.ca_origen='" . $this->ciu_origen . "'";

            if ($this->idpais_destino)
                $where .= " and tra_des.ca_idtrafico='" . $this->idpais_destino . "'";

            if ($this->idagente)
                $where .= " and a.ca_idagente='" . $this->idagente . "'";

            if ($this->idlinea) {
                if ($this->transporte == "Maritimo") {
                    $where .= " and em.ca_idnaviera='" . $this->idlinea . "'";
                } else if ($this->transporte == "Aereo") {
                    $where .= " and ea.ca_idaerolinea='" . $this->idlinea . "'";
                }
            }

            if ($this->sucursal) {
                if ($this->sucursal != "999")
                    $where .= " and s.ca_nombre='" . $this->idSucursal . "'";
            }

            if ($this->idcliente)
                $where .= " and a.ca_idcliente='" . $this->idcliente . "'";

            if ($this->login)
                $where .= " and u.ca_login='" . $this->login . "'";

            if ($this->estado) {
                if ($this->estado == "Abierto")
                    $where .= " and a.ca_fchcerrado IS NULL";
                else if ($this->estado == "Cerrado")
                    $where .= " and a.ca_fchcerrado IS NOT NULL";
                else if ($this->estado == "Sin Facturar")
                    $where .= " and ei.ca_loginvendedor IS NULL";
                else {
                    $where .= " and q.ca_consecutivo IS NOT NULL";
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

            $tipo_transporte[] = "Aereo";
            $tipo_transporte[] = "Maritimo";
            $tipo_transporte[] = "Maritimo/Terrestre";
            $tipo_transporte[] = "Terrestre";

            foreach ($this->resul as $r) {

                $this->tipo[($r["via"])][($r["sucursal"])][($r["mes"])] ++;

                $this->grid[($r["total_negocios"])][($r["sucursal"])][($r["mes"])] ++;
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["total_negocios"] ++;
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["peso"] += $r["peso"];
                $this->origen[($r["via"])][($r["sucursal"])][($r["mes"])]["ino"] += $r["ca_ino"];

                $this->trafico[$r["ciuorigen"]][$r["tradestino"]][$r["mes"]] ++;

                foreach ($tipo_transporte as $key => $val_trans) {
                    if ($val_trans == $r["via"])
                        $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$r["via"]] += $r["ca_ino"];
                    else
                        $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans] = $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans] ? $this->cliente[$r["sucursal"]][$r["cliente"]][$r["mes"]][$val_trans] : null;
                }

                $this->resumen[($r["sucursal"])][($r["mes"])]["peso"] += $r["peso"];
                $this->resumen[($r["sucursal"])][($r["mes"])]["volumen"] += $r["peso_volumen"];
                $this->resumen[($r["sucursal"])][($r["mes"])]["teus"] += $r["teus"];

                $this->traficos[$r["via"]][$r["ciuorigen"]][$r["tradestino"]][$r["mes"]] ++;


                if ($r["via"] == "Maritimo") {
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["casos"] ++;
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["peso"] += $r["peso"];
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["volumen"] += $r["peso_volumen"];
                    $this->sea[$r["modalidad"]][$r["naviera"]][$r["mes"]]["teus"] += $r["teus"];
                } else if ($r["via"] == "Aereo") {
                    $this->air[$r["aerolinea"]][$r["mes"]]["casos"] ++;
                    $this->air[$r["aerolinea"]][$r["mes"]]["peso"] += $r["peso"];
                    $this->air[$r["aerolinea"]][$r["mes"]]["volumen"] += $r["peso_volumen"];
                }

                $this->vendedores[$r["comercial"]][$r["via"]][$r["cliente"]][$r["mes"]] += $r["ca_ino"];
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
        if ($this->pais_origen) {
            $andWhere .= " and im.ca_traorigen = '" . $this->pais_origen . "'";
        }
        if ($this->destino) {
            $andWhere .= " and im.ca_ciudestino = '" . $this->destino . "'";
        }
        if ($this->idlinea) {
            $andWhere .= " and im.ca_idlinea = '" . $this->idlinea . "'";
        }
        if ($this->idmodalidad) {
            $andWhere .= " and im.ca_modalidad = '" . $this->idmodalidad . "'";
        }

        if ($this->opcion) {
            $annos = array();
            $meses = array();
            while ($this->fechaInicial <= $this->fechaFinal) {
                list($ano, $mes, $dia) = sscanf($this->fechaInicial, "%d-%d-%d");
                if (!in_array($ano, $annos)) {
                    $annos[] = $ano;
                }
                if (!in_array($mes, $meses)) {
                    $meses[] = $mes;
                }
                $this->fechaInicial = date("Y-m-d", mktime(0, 0, 0, $mes, $dia + 1, $ano));
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

        if ($this->opcion) {
            $andWhere = "";
            if ($this->nmes) {
                foreach ($this->nmes as $m) {
                    if ($m != "")
                        $mm[] = str_pad($m, 2, "0", STR_PAD_LEFT);
                }
            }
            if ($mm) {
                if (count($mm) > 0) {
                    $mes = "";
                    for ($i = 0; $i < count($mm); $i++) {
                        $mes .= "'" . $mm[$i] . "',";
                    }
                    if (strpos($mes, 'Todos los meses') != true)
                        $andWhere .= " and ca_mes IN (" . substr($mes, 0, -1) . ")";
                }
            }
            if ($this->pais_origen) {
                $andWhere .= " and ca_traorigen = '" . $this->pais_origen . "'";
            }
            if ($this->ciuorigen) {
                $andWhere .= " and ca_ciuorigen = '" . $this->ciuorigen . "'";
            }
            if ($this->idcliente) {
                $andWhere .= " and ca_compania like '%" . $this->cliente . "%'";
            }
            if ($this->idsucursal) {
                if ($this->idsucursal != "999")
                    $andWhere .= " and ca_sucursal like '%" . $this->sucursal . "%'";
            }
            if ($this->estado) {
                $andWhere .= " and ca_estado = '" . $this->estado . "'";
            }

            $sql = "SELECT ca_sucursal, ca_ano, ca_mes, ca_traorigen, ca_ciuorigen, (CASE WHEN rg.ca_modalidad = 'COLOADING' THEN 'LCL' ELSE rg.ca_modalidad END) as ca_modalidad, ca_referencia, ca_hbls, ca_compania, ca_cbm, ca_teus, ca_estado, r.ca_idproveedor, tr1.ca_nombre AS ca_nombre_pro "
                    . "FROM vi_repgerencia_sea rg"
                    . "  LEFT JOIN tb_reportes r ON rg.ca_idreporte = r.ca_idreporte
                        LEFT JOIN tb_terceros tr1 ON tr1.ca_idtercero::text = array_to_string(string_to_array(r.ca_idproveedor::text, '|'::text), ','::text) "
                    . "WHERE ca_ano = '" . $this->aa . "' $andWhere"
                    . "ORDER BY ca_ano, ca_mes, ca_referencia";

            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            $this->resul = $st->fetchAll();

            //echo "<pre>";print_r($this->data);echo "</pre>";

            $this->fcl = array();
            $this->lcl = array();

            foreach ($this->resul as $r) {

                if ($r["ca_modalidad"] == "FCL") {
                    $this->fcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["teus"] += $r["ca_teus"];
                    $this->fcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["hbls"] ++;
                }

                if ($r["ca_modalidad"] == "LCL") {
                    $this->lcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["hbls"] ++;
                    $this->lcl[$r["ca_sucursal"]][$r["ca_estado"]][$r["ca_traorigen"]][$r["ca_ciuorigen"]][$r["ca_compania"]]["cbm"] += $r["ca_cbm"];
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
        $response->addJavaScript("extExtras/CheckColumn", 'last');
        $response->addJavaScript("extExtras/GroupSummary", 'last');

        $this->anio = $request->getParameter("anio");
        $this->mes = $request->getParameter("mes");
        $this->sucursal = $request->getParameter("selSucursal");
        $this->usuario = $request->getParameter("selUsuario");
        $this->circular = $request->getParameter("selCircular");
        $this->resultado = $request->getParameter("selResultado");
        $this->casos = $request->getParameter("selCasos");
        $this->incoterms = $request->getParameter("selIncoterms");
    }

    /**
     * Lista de referencias con opción de apertura
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosComisionesXCobrar(sfWebRequest $request) {
        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $sucursal = utf8_decode($request->getParameter("sucursal"));
        $usuario = $request->getParameter("usuario");
        $circular = $request->getParameter("circular");
        $resultado = $request->getParameter("resultado");
        $casos = $request->getParameter("casos");
        $incoterms = json_decode($request->getParameter("incoterms"));

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
            $condicion .= " and ca_sucursal = '$sucursal' ";
        }

        if ($usuario != "%") {
            $condicion .= " and ca_login like '$usuario' ";
        }

        if ($circular != "%") {
            $condicion .= " and ca_stdcircular = '$circular' ";
        }

        if ($casos != "%") {
            $condicion .= " and ca_estado = '$casos' ";
        }

        $columnas = "ca_oid, ca_idinocliente, ca_referencia, ca_compania, ca_hbls, ca_incoterms, ca_factura, ca_fchfactura, ca_valor, ca_reccaja, ca_fchpago, ca_vlrcomisiones, ca_sbrcomisiones, ca_estado, ca_fchcerrado, ca_facturacion_r, ca_deduccion_r, ca_utilidad_r, ca_volumen_r, ca_vlrutilidad_liq, ca_volumen, ca_porcentaje, ca_sbrcomision, ca_stdcircular, ca_login, ca_sucursal";

        $conn = Doctrine_Manager::getInstance()->connection();
        $sql = "select $columnas from vi_inoingresos_sea where $condicion";

        set_time_limit(0);
        $rs = $conn->execute($sql);
        $comisiones_rs = $rs->fetchAll();

        $data = array();
        $key_tmp = null;
        $columnas = explode(", ", $columnas);
        foreach ($comisiones_rs as $key => $comision) {
            $row = array();
            foreach ($columnas as $columna) {
                $row[$columna] = utf8_encode($comision[$columna]);
            }

            $ca_vlrcomisiones_caus = 0;
            if ($row["ca_vlrutilidad_liq"] != 0) {
                $ca_vlrcomisiones_caus = round($row["ca_vlrutilidad_liq"] * $row["ca_porcentaje"] / 100, 0);
            } else {
                $ca_vlrcomisiones_caus = round(($row["ca_facturacion_r"] - $row["ca_deduccion_r"] - $row["ca_utilidad_r"]) * ($row["ca_volumen"] / $row["ca_volumen_r"]) * $row["ca_porcentaje"] / 100, 0);
            }
            $ca_sbrcomisiones_caus = round($row["ca_sbrcomision"] * $row["ca_porcentaje"] / 100, 0);

            if ($row["ca_referencia"] . "|" . $row["ca_hbls"] != $key_tmp) {
                $row["ca_vlrcomisiones_caus"] = $ca_vlrcomisiones_caus;
                $row["ca_sbrcomisiones_caus"] = $ca_sbrcomisiones_caus;
                $ca_corrientes_dif = $ca_vlrcomisiones_caus - $row["ca_vlrcomisiones"];
                $ca_sobreventa_dif = $ca_sbrcomisiones_caus - $row["ca_sbrcomisiones"];

                $row["ca_corrientes_dif"] = $ca_corrientes_dif;
                $row["ca_sobreventa_dif"] = $ca_sobreventa_dif;
            } else {
                $row["ca_vlrcomisiones_caus"] = 0;
                $row["ca_sbrcomisiones_caus"] = 0;
                $row["ca_corrientes_dif"] = 0;
                $row["ca_sobreventa_dif"] = 0;
            }
            $key_tmp = $row["ca_referencia"] . "|" . $row["ca_hbls"];

            $condicion_utilidad = false;
            if ($ca_corrientes_dif != 0 or $ca_sobreventa_dif != 0) {
                if ($resultado == "Perdida" and ( $ca_corrientes_dif < 0 or $ca_sobreventa_dif < 0)) {
                    $condicion_utilidad = true;
                } else if ($resultado == "Utilidad" and ( $ca_corrientes_dif > 0 or $ca_sobreventa_dif > 0)) {
                    $condicion_utilidad = true;
                } else if ($resultado == "%") {
                    $condicion_utilidad = true;
                }
            }

            $condicion_incoterm = false;
            if ($incoterms[0] !== "%") {
                $incoterm_array = explode("|", $row["ca_incoterms"]);
                foreach ($incoterm_array as $incoterm) {
                    if (in_array($incoterm, $incoterms)) {
                        $condicion_incoterm = true;
                        break;
                    }
                }
            } else {
                $condicion_incoterm = true;
            }

            if ($condicion_utilidad and $condicion_incoterm) {
                $data[] = $row;
            }
        }
        $this->responseArray = array("success" => true, "total" => count($data), "root" => $data);
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo de entrada al Generador de Reportes sobre Reportes de Negocio
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteReportesDeNegocioExt5(sfWebRequest $request) {
        
    }

    function validaEstadoArreglo(&$arreglo, $valor) {
        $respuesta = in_array($valor, $arreglo);
        if (!$respuesta) {
            $arreglo[] = $valor;
        }
        return $respuesta;
    }

    function printArray($arreglo, $crlf) {
        $cadena = "";
        foreach ($arreglo as $key => $value) {
            $cadena .= "$key $value" . $crlf;
        }
        return $cadena;
    }

    public function executeReporteReportesDeNegocioListExt5(sfWebRequest $request) {
        $this->params = array();
        $this->params["anio"] = $anio = $request->getParameter("anio");
        $this->params["mes"] = $mes = $request->getParameter("mes");
        $this->params["trafico"] = $trafico = $request->getParameter("trafico");
        $this->params["impoexpo"] = $impoexpo = $request->getParameter("impoexpo");
        $this->params["transporte"] = $transporte = $request->getParameter("transporte");
        $this->params["sucursal"] = $sucursal = $request->getParameter("sucursal");
        $this->params["vendedor"] = $vendedor = $request->getParameter("vendedor");
        $this->params["destino"] = $destino = $request->getParameter("destino");
        $this->params["modalidad"] = $modalidad = $request->getParameter("modalidad");
        $this->params["cliente"] = $cliente = $request->getParameter("cliente");
        $this->params["agente"] = $agente = $request->getParameter("agente");
        $this->params["transportista"] = $transportista = $request->getParameter("transportista");
        $this->params["fchRepIni"] = $fchRepIni = $request->getParameter("fchRepIni");
        $this->params["fchRepFin"] = $fchRepFin = $request->getParameter("fchRepFin");
        $this->params["fchEtdIni"] = $fchEtdIni = $request->getParameter("fchEtdIni");
        $this->params["fchEtdFin"] = $fchEtdFin = $request->getParameter("fchEtdFin");
        $this->params["fchCnfIni"] = $fchCnfIni = $request->getParameter("fchCnfIni");
        $this->params["fchCnfFin"] = $fchCnfFin = $request->getParameter("fchCnfFin");
        $this->params["filters"] = utf8_encode($request->getParameter("filters"));
        $this->params["columns"] = utf8_encode($request->getParameter("columns"));
        $filtros = json_decode(utf8_encode($request->getParameter("filters")));
        $columns = json_decode(utf8_encode($request->getParameter("columns")));

        $q = Doctrine::getTable("Reporte")
                ->createQuery("rp");

        $con_reporteag = false;
        $con_status = false;
        $con_equipos = false;
        $con_tarifas = false;

        $joins = array();
        $this->filters = array();
        $this->columns = array();
        $this->columns[] = array("xtype" => "treecolumn", "text" => "Agrupamiento", "flex" => "2", "sortable" => true, "dataIndex" => "text");

        foreach ($columns as $column) {
            $is_filter = false;
            foreach ($filtros as $filtro) {
                if ($filtro->alias == $column->alias) {
                    $is_filter = true;
                }
            }
            if (!$is_filter) {
                $this->columns[] = array("text" => $column->titulo, "dataIndex" => $column->alias);
            }
            switch ($column->alias) {
                case "rp_annio":
                    $q->addSelect($column->sql . " as annio");
                    break;
                case "rp_mes":
                    $q->addSelect($column->sql . " as mes");
                    break;
                case "trg_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->innerJoin("rp.Origen org");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Traorigen")) {
                        $q->innerJoin("org.Trafico trg");
                    }
                    $q->addSelect($column->sql);
                    $q->addSelect("org.ca_ciudad");
                    $q->addSelect("trg.ca_nombre");
                    break;
                case "org_ca_ciudad":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->innerJoin("rp.Origen org");
                    }
                    $q->addSelect($column->sql);
                    $q->addSelect("org.ca_ciudad");
                    break;
                case "tds_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Destino")) {
                        $q->innerJoin("rp.Destino dst");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Tradestino")) {
                        $q->innerJoin("dst.Trafico tds");
                    }
                    $q->addSelect($column->sql);
                    $q->addSelect("tds.ca_nombre");
                    break;
                case "dst_ca_ciudad":
                    if (!$this->validaEstadoArreglo($joins, "Destino")) {
                        $q->innerJoin("rp.Destino dst");
                    }
                    $q->addSelect($column->sql);
                    $q->addSelect("dst.ca_ciudad");
                    break;
                case "cli_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Contacto")) {
                        $q->innerJoin("rp.Contacto cto");
                        $q->innerJoin("cto.IdsCliente ids1");
                        $q->innerJoin("ids1.Ids cli");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "agt_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Agente")) {
                        $q->innerJoin("rp.IdsAgente ids2");
                        $q->innerJoin("ids2.Ids agt");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "prv_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Proveedor")) {
                        $q->innerJoin("rp.IdsProveedor ids3");
                        $q->innerJoin("ids3.Ids prv");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "rprv_ca_incoterms":
                    if (!$this->validaEstadoArreglo($joins, "RepProveedores")) {
                        $q->leftJoin("rp.RepProveedores rprv");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "usr_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->innerJoin("rp.Usuario usr");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "suc_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->innerJoin("rp.Usuario usr");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                        $q->innerJoin("usr.Sucursal suc");
                    }
                    $q->addSelect($column->sql);
                    break;
                case "rp_ca_ag":
                    $con_reporteag = true;
                    break;
                case "status":
                    $con_status = true;
                    $q->addSelect("rp.ca_fchsalida");
                    $q->addSelect("rp.ca_fchllegada");
                    break;
                case "equipos":
                    $this->columns[] = array("text" => "Volumen", "dataIndex" => "volumen");
                    $this->columns[] = array("text" => "Peso", "dataIndex" => "peso");
                    $con_equipos = true;
                    break;
                case "tarifas":
                    $con_tarifas = true;
                    break;
                default:
                    $q->addSelect($column->sql);
                    break;
            }
        }
        $q->addSelect("rp.ca_idreporte");   // Selecciona siempre la llave primaria para búsquedas

        if ($anio) {
            $q->andWhereIn("to_char(ca_fchreporte, 'YYYY')", explode(",", $anio));
        }
        if (strpos($mes, "%") === false) {
            $q->andWhereIn("to_char(ca_fchreporte, 'MM')", explode(",", $mes));
        }
        if (strpos($trafico, "%") === false) {
            if (!$this->validaEstadoArreglo($joins, "Origen")) {
                $q->innerJoin("rp.Origen org");
            }
            $q->andWhereIn("org.ca_idtrafico", explode(",", $trafico));
        }
        if ($impoexpo) {
            $q->andWhereIn("rp.ca_impoexpo", explode(",", $impoexpo));
        }
        if ($transporte) {
            $q->andWhereIn("rp.ca_transporte", explode(",", $transporte));
        }
        if (strpos($sucursal, "Sucursales (Todas)") === false) {
            if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                $q->innerJoin("rp.Usuario usr");
            }
            if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                $q->innerJoin("usr.Sucursal suc");
            }
            $q->andWhereIn("suc.ca_nombre", explode(",", $sucursal));
        }
        if ($vendedor) {
            $q->andWhereIn("rp.ca_login", explode(",", $vendedor));
        }
        if ($destino) {
            $q->andWhereIn("rp.ca_destino", explode(",", $destino));
        }
        if ($modalidad) {
            $q->andWhereIn("rp.ca_modalidad", explode(",", $modalidad));
        }
        if ($cliente) {
            if (!$this->validaEstadoArreglo($joins, "Contacto")) {
                $q->addSelect("cli.ca_nombre");
                $q->innerJoin("rp.Contacto cto");
                $q->innerJoin("cto.IdsCliente ids1");
                $q->innerJoin("ids1.Ids cli");
            }
            $q->andWhere("cto.ca_idcliente = ?", $cliente);
        }
        if ($agente) {
            $q->andWhere("rp.ca_idagente = ?", $agente);
        }
        if ($transportista) {
            $q->andWhere("rp.ca_idlinea = ?", $transportista);
        }
        $q->andWhere("rp.ca_usuanulado IS NULL");

        if ($fchRepIni and $fchRepFin) {
            $q->addWhere("ca_fchreporte BETWEEN ? AND ?", array($fchRepIni, $fchRepFin));
        }
        if ($fchEtdIni and $fchEtdFin) {
            $q->addWhere("ca_fchsalida BETWEEN ? AND ?", array($fchEtdIni, $fchEtdFin));
        }

        $orderBy = "";
        foreach ($filtros as $filtro) {
            switch ($filtro->alias) {
                case "trg_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->innerJoin("rp.Origen org");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Traorigen")) {
                        $q->addSelect("trg.ca_nombre");
                        $q->innerJoin("org.Trafico trg");
                    }
                    $orderBy .= "trg.ca_nombre, ";
                    break;
                case "org_ca_ciudad":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->addSelect("org.ca_ciudad");
                        $q->innerJoin("rp.Origen org");
                    }
                    $orderBy .= "org.ca_ciudad, ";
                    break;
                case "dst_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Destino")) {
                        $q->addSelect("tds.ca_nombre");
                        $q->innerJoin("rp.Destino dst");
                    }
                    $orderBy .= "dst.ca_ciudad, ";
                    break;
                case "cli_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Contacto")) {
                        $q->addSelect("cli.ca_nombre");
                        $q->innerJoin("rp.Contacto cto");
                        $q->innerJoin("cto.IdsCliente ids1");
                        $q->innerJoin("ids1.Ids cli");
                    }
                    $orderBy .= "cli.ca_nombre, ";
                    break;
                case "agt_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Agente")) {
                        $q->addSelect("agt.ca_nombre");
                        $q->innerJoin("rp.IdsAgente ids2");
                        $q->innerJoin("ids2.Ids agt");
                    }
                    $orderBy .= "agt.ca_nombre, ";
                    break;
                case "prv_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Proveedor")) {
                        $q->addSelect("prv.ca_nombre");
                        $q->innerJoin("rp.IdsProveedor ids3");
                        $q->innerJoin("ids3.Ids prv");
                    }
                    $orderBy .= "prv.ca_nombre, ";
                    break;
                case "usr_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->addSelect("usr.ca_nombre");
                        $q->innerJoin("rp.Usuario usr");
                    }
                    $orderBy .= "usr.ca_nombre, ";
                    break;
                case "suc_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->innerJoin("rp.Usuario usr");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                        $q->addSelect("suc.ca_nombre");
                        $q->innerJoin("usr.Sucursal suc");
                    }
                    $orderBy .= "suc.ca_nombre, ";
                    break;
                case "rp_ca_usucreado":
                    $q->addSelect("rp.ca_usucreado");
                    $orderBy .= "rp.ca_usucreado, ";
                    break;
                case "rp_ca_transporte":
                    $q->addSelect("rp.ca_transporte");
                    $orderBy .= "rp.ca_transporte, ";
                    break;
                default:
                    $orderBy .= $filtro->sql . ", ";
                    break;
            }
        }
        $orderBy = substr($orderBy, 0, -2);
        $q->addOrderBy($orderBy);

        // $q->limit(100);
        // $sql = $q->getSqlQuery();
        // echo $sql;
        // die($sql);

        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $reportes_rs = $q->execute();
        $id_reportes = array_column($reportes_rs, 'rp_ca_idreporte');

        $con = Doctrine_Manager::connection();
        if ($con_equipos) {
            $sql = "select rs.ca_idreporte, rp.ca_transporte, rp.ca_modalidad, rs.ca_volumen, rs.ca_peso, eq.ca_cantidad, cn.ca_unidad
                    from (
                            select ca_idreporte, max(ca_idstatus) as ca_idstatus from tb_repstatus where ca_idreporte in (" . implode(",", $id_reportes) . ")  group by ca_idreporte
                    ) mx
                    inner join tb_repstatus rs on mx.ca_idstatus = rs.ca_idstatus
                    inner join tb_reportes rp on rs.ca_idreporte = rp.ca_idreporte
                    left  join tb_repequipos eq on rs.ca_idreporte = eq.ca_idreporte
                    left  join tb_conceptos cn on eq.ca_idconcepto = cn.ca_idconcepto
                    order by rs.ca_idreporte";
            $rs = $con->execute($sql);
            $reportes_eq = $rs->fetchAll();
        }

        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        $this->registros = array();
        $this->expor_data = array();
        $this->expor_cols = array();
        foreach ($reportes_rs as $reporte_sc) {
            $reporte = null;
            $sql = "select fun_is_last_version from fun_is_last_version(" . $reporte_sc["rp_ca_idreporte"] . ")";
            $st = $con->execute($sql);
            $resul = $st->fetch();

            if (!$resul[0]) {
                continue;
            }
            if (array_key_exists("rp_mes", $reporte_sc)) {
                $reporte_sc["rp_mes"] = Utils::mesLargo($reporte_sc["rp_mes"]);
            }
            if (array_key_exists("rprv_ca_incoterms", $reporte_sc)) {
                $incoterms = htmlentities($reporte_sc["rprv_ca_incoterms"]);
                $incoterms = explode("|", $incoterms);
                $reporte_sc["rprv_ca_incoterms"] = implode("|", array_unique($incoterms));
            }

            if ($con_reporteag) {
                $reporte = Doctrine::getTable("Reporte")->find($reporte_sc["rp_ca_idreporte"]);
                $reporte_sc["rp_ca_ag"] = (($reporte->getFueAG()) ? "SI" : "NO");
            }
            if ($con_status) {
                $confirma = array();
                if ($fchCnfIni and $fchCnfFin) {
                    $documento = $medio = $dep_confirm = $arr_confirm = $doctransporte = null;
                    if (!$reporte) {
                        $reporte = Doctrine::getTable("Reporte")->find($reporte_sc["rp_ca_idreporte"]);
                    }
                    $repStatus = $reporte->getRepStatus();
                    foreach ($repStatus as $status) {
                        if ($status->getCaIdnave()) {
                            $motonave = trim($status->getCaIdnave());
                        }
                        if ($status->getCaDoctransporte()) {
                            $doctransporte = $status->getCaDoctransporte();
                        }
                        if ($reporte->getCaTransporte() == "Aéreo") {
                            $documento = "HAWB: ";
                            $medio = "Aeronave: ";
                            if ($status->getCaIdetapa() == "IACCR") {
                                $dep_confirm = $status->getCaFchsalida();
                            } elseif ($status->getCaIdetapa() == "IACAD") {
                                $arr_confirm = $status->getCaFchllegada();
                            }
                        } elseif ($reporte->getCaTransporte() == "Marítimo") {
                            $documento = "HBL: ";
                            $medio = "Motonave: ";
                            if ($status->getCaIdetapa() == "IMETA") {
                                $dep_confirm = $status->getCaFchsalida();
                            } elseif ($status->getCaIdetapa() == "IMCPD") {
                                $arr_confirm = $status->getCaFchllegada();
                            }
                        }
                        $confirma[$documento] = $doctransporte;
                        $confirma[$medio] = $motonave;
                        $confirma["Salida: "] = $dep_confirm;
                        $confirma["Llegada: "] = $arr_confirm;
                    }
                    if ($dep_confirm < $fchCnfIni or $dep_confirm > $fchCnfFin) {
                        continue;
                    }
                }

                $status = array(
                    "ETD: " => $reporte_sc["rp_ca_fchsalida"],
                    "ETA: " => $reporte_sc["rp_ca_fchllegada"]
                );
                $reporte_sc["status"] = $this->printArray(array_merge($status, $confirma), "<br />");
            }
            if ($con_equipos) {
                $equipos = array();

                foreach ($reportes_eq as $reporte_eq) {
                    if ($reporte_eq["ca_idreporte"] == $reporte_sc["rp_ca_idreporte"]) {
                        if ($reporte_eq["ca_unidad"]) {
                            $equipos[$reporte_eq["ca_unidad"] . " X "] += $reporte_eq["ca_cantidad"];
                        }
                        if ($reporte_eq["ca_transporte"] == Constantes::MARITIMO and ( $reporte_eq["ca_modalidad"] == Constantes::LCL or $reporte_eq["ca_modalidad"] == Constantes::COLOADING)) {
                            $reporte_sc["volumen"] = str_replace("M&sup3;", "M3", str_replace("|", " ", $reporte_eq["ca_volumen"]));
                        } else {
                            $reporte_sc["volumen"] = 0;
                        }
                        if ($reporte_eq["ca_transporte"] == Constantes::AEREO) {
                            $reporte_sc["peso"] = $reporte_eq["ca_peso"];
                        } else {
                            $reporte_sc["peso"] = 0;
                        }
                    }
                }

                $reporte_sc["equipos"] = $this->printArray($equipos, "<br />");
            }
            if ($con_tarifas) {
                $tarifas = array();
                if (!$reporte) {
                    $reporte = Doctrine::getTable("Reporte")->find($reporte_sc["rp_ca_idreporte"]);
                }
                $reptarifas = $reporte->getRepTarifa();
                foreach ($reptarifas as $tarifa) {
                    $tarifas[$tarifa->getConcepto()->getCaConcepto() . ": "] = $tarifa->getCaNetaTar() . " / " . $tarifa->getCaReportarTar() . " / " . $tarifa->getCaCobrarTar();
                }
                $reporte_sc["tarifas"] = $this->printArray($tarifas, "<br />");
            }
            $reporte_sc = array_map('utf8_encode', $reporte_sc);
            $this->expor_data[] = $reporte_sc;

            $uid = $root;
            foreach ($filtros as $filtro) {
                $value = $reporte_sc[$filtro->alias];
                unset($reporte_sc[$filtro->alias]);
                $node_uid = $tree->findValue($uid, $value);
                if (!$node_uid) {
                    $nodo = $tree->createNode($value);
                    $tree->addChild($uid, $nodo);
                    $uid = $nodo;
                } else {
                    $uid = $node_uid;
                }
            }
            $nodo = $tree->getNode($uid);

            // Quita el primer elemento que no es filtro y lo usa para el campo text
            list($keys) = array_keys($reporte_sc);
            $reporte_sc["text"] = $reporte_sc[$keys];
            $reporte_sc["leaf"] = true;
            // $key generalmente va a ser tb.reporte.ca_consecutivo
            unset($reporte_sc[$keys]);
            $nodo->setAttribute("children", $reporte_sc);
        }

        foreach ($filtros as $filtro) {
            $this->expor_cols[] = array("title" => $filtro->titulo, "name" => $filtro->alias, "xtype" => "string");
        }
        foreach ($this->columns as $column) {
            if ($column["text"] != "Agrupamiento") {
                $this->expor_cols[] = array("title" => $column["text"], "name" => $column["dataIndex"], "xtype" => "string");
            }
        }

        // Retira el campo key del cuerpo del informe
        $columns = array();
        foreach ($this->columns as $k => $v) {
            if ($v["dataIndex"] != $keys) {
                $columns[] = $v;
            }
        }
        // Lo hace con este ciclo para renumerar los id del arreglo
        $this->columns = $columns;
        $this->registros = $tree->getTreeNodes();
    }

    /**
     * Executes guardarComprobanteAjuste action
     *
     * @param sfRequest $request A request object
     */
    public function executeBusquedaIds(sfWebRequest $request) {
        $query = $request->getParameter("query");
        $tipo = $request->getParameter("tipo");
        $estado = $request->getParameter("estado");

        $q = Doctrine::getTable("Ids")
                ->createQuery("i");
        if ($tipo == "Cliente") {
            $q->innerJoin("i.IdsCliente cl");
        } else if ($tipo == "Agente") {
            $q->innerJoin("i.IdsAgente ag");
        } else if ($tipo == "Proveedor") {
            $q->innerJoin("i.IdsProveedor pr");
        }
        if ($estado == "Activo" && ($tipo == "Agente" || $tipo == "Proveedor")) {
            $q->addWhere("ca_activo = ?", true);
        } else if ($estado != "Activo" && ($tipo == "Agente" || $tipo == "Proveedor")) {
            $q->addWhere("ca_activo = ?", false);
        }
        $q->addWhere("UPPER(i.ca_nombre) like ?", '%' . strtoupper($query) . '%');
        $q->addOrderBy("i.ca_nombre ASC");

        $ids = $q->execute();
        $data = array();
        foreach ($ids as $id) {
            $data[] = array("id" => $id->getCaId(), "name" => utf8_encode($id->getCaNombre()));
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    /**
     * Executes guardarComprobanteAjuste action
     *
     * @param sfRequest $request A request object
     */
    public function executeGuardarComprobanteAjuste(sfWebRequest $request) {
        $datos = $request->getParameter("datos");

        $ajustes = json_decode($datos);
        $errorInfo = "";
        $ids = array();
        if ($ajustes) {
            $conn = Doctrine_Manager::getInstance()->connection();
            $sql = "select nextval('tb_inocomisiones_sea_id') as ca_consecutivo";
            $st = $conn->execute($sql);
            $consecutivos_rs = $st->fetchAll();

            $conn->beginTransaction();
            try {
                foreach ($consecutivos_rs as $key => $consecutivo) {
                    foreach ($ajustes as $ajuste) {
                        $comprobante = new InoComisionesSea();
                        $comprobante->setCaComprobante($consecutivo["ca_consecutivo"]);
                        $comprobante->setCaFchliquidacion(date("Y-m-d"));
                        $comprobante->setCaVlrcomision($ajuste->ca_corrientes_dif);
                        $comprobante->setCaSbrcomision($ajuste->ca_sobreventa_dif);
                        $comprobante->setCaIdinocliente($ajuste->ca_idinocliente);
                        $comprobante->save();
                    }
                }
                $conn->commit();
                $this->responseArray = array("success" => true);
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
            }
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeReporteElaboracionCotizacionesExt5(sfWebRequest $request) {
        
    }

    public function executeDatosVendedores(sfWebRequest $request) {
        $this->responseArray = "";
        if ($request->getParameter("verificacion") == 1) {
            $nombresucursal = $request->getParameter("nombresucursal");
            $nombresucursal = utf8_decode($nombresucursal);
            $vendedores = array();

            $where = "";

            if ($nombresucursal == '') {
                $where = "and s.ca_nombre like '%'";
            }

            if ($nombresucursal != "Todas Las sucursales") {
                $where = "and s.ca_nombre = '" . $nombresucursal . "'";
            }

            $usuarios_rs = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.Sucursal s")
                    ->addWhere("(u.ca_departamento='Comercial' or u.ca_cargo='Representante de Ventas')  " . $where)
                    ->orderBy("u.ca_login")
                    ->execute();

            $vendedores[] = array("id" => "%", "text" => "Usuarios (Todos)", "leaf" => true, "checked" => false);

            foreach ($usuarios_rs as $usuario) {
                $vendedores[] = array("id" => $usuario->getCaLogin(), "text" => utf8_encode($usuario->getCaNombre()), "leaf" => true, "checked" => false);
            }

            // $this->responseArray = array("success" => true, "root" => $vendedores);
            $tree = array("text" => "Vendedores",
                "leaf" => false,
                "id" => "0",
                "children" => $vendedores);

            //$this->responseArray = array("success" => true, "root" => $tree);
            $this->responseArray = $tree;
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeDatosOperativos(sfWebRequest $request) {
        $this->responseArray = "";
        if ($request->getParameter("verificacion") == 1) {

            $nombresucursal = $request->getParameter("nombresucursal");
            $nombresucursal = utf8_decode($nombresucursal);
            $vendedores = array();

            $where = "";

            if ($nombresucursal == '') {
                $where = "and s.ca_nombre like '%'";
            }

            if ($nombresucursal != "Todas Las sucursales") {
                $where = "and s.ca_nombre = '" . $nombresucursal . "'";
            }
            $usuarios_rs = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->innerJoin("u.Sucursal s")
                    ->addWhere("(u.ca_departamento='Servicio al Cliente' or u.ca_departamento='Inside Sales' or u.ca_cargo='Asistente Servicio al Cliente')  " . $where)
                    ->orderBy("u.ca_login")
                    ->execute();


            $vendedores[] = array("id" => "%", "text" => utf8_encode("Usuarios (Todos)"), "leaf" => true, "checked" => false);

            foreach ($usuarios_rs as $usuario) {
                $vendedores[] = array("id" => utf8_encode($usuario->getCaLogin()), "text" => utf8_encode($usuario->getCaNombre()), "leaf" => true, "checked" => false);
            }
            $tree = array("text" => "Operativos",
                "leaf" => false,
                "id" => "0",
                "children" => $vendedores);

            //$this->responseArray = array("success" => true, "root" => $tree);
            $this->responseArray = $tree;
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeReporteElaboracionCotizacionesListExt5(sfWebRequest $request) {

        $anio = $request->getParameter("anio");
        $mes = $request->getParameter("mes");
        $sucursal = $request->getParameter("sucursal");
        $vendedores = $request->getParameter("vendedores");
        $operativos = $request->getParameter("operativos");
        $vendedores = json_decode(utf8_encode($vendedores));
        $operativos = json_decode(utf8_encode($operativos));

        $where = array();
        foreach ($vendedores as $vendedor) {
            $where[] = "'" . $vendedor->id . "'";
        }

        foreach ($operativos as $operativo) {
            $where[] = "'" . $operativo->id . "'";
        }

        $whereUsuarios = implode(",", $where);

        if ($whereUsuarios != "") {
            $whereUsuarios = "tr.ca_usucreado in (" . $whereUsuarios . ") and ";
        }

        if ($mes == "%") {
            $dateInicial = $anio . "-01-01";
            $ultimodia = date("d", mktime(0, 0, 0, 12, 31, $anio));
            $mes = 12;
        } else {
            $dateInicial = $anio . "-" . $mes . "-01";
            $ultimodia = date("d", (mktime(0, 0, 0, $mes + 1, 1, $anio) - 1));
        }

        $dateFinal = $anio . "-" . $mes . "-" . $ultimodia;

        $sql = "select tr.ca_fchcreado  , cc.ca_idalterno, cc.ca_digito, ";
        $sql .= "cc.ca_compania, cc.ca_ncompleto_cn, cc.ca_cargo, ct.ca_consecutivo,tr.ca_usucreado ";
        $sql .= "from tb_cotizaciones ct ";
        $sql .= "inner join vi_concliente cc on cc.ca_idcontacto = ct.ca_idcontacto ";
        $sql .= "inner join notificaciones.tb_tareas tr on tr.ca_idtarea = ct.ca_idg_envio_oportuno ";
        $sql .= "where " . $whereUsuarios;
        $sql .= "tr.ca_fchcreado between '" . $dateInicial . "' and '" . $dateFinal . "'";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll();

        $listaReporte = array();
        foreach ($rs as $result) {
            $creador = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->select("*")
                    ->where("u.ca_login = ?", utf8_encode($result["ca_usucreado"]))
                    ->fetchOne();
            if ($creador) {
                $listaReporte[] = array("ca_fchcreado" => utf8_encode($result["ca_fchcreado"]),
                    "ca_nit" => utf8_encode($result["ca_idalterno"] . "-" . ($result["ca_digito"])),
                    "ca_compania" => utf8_encode($result["ca_compania"]),
                    "ca_ncompleto_cn" => utf8_encode($result["ca_ncompleto_cn"]),
                    "ca_consecutivo" => utf8_encode($result["ca_consecutivo"]),
                    "ca_usucreado" => utf8_encode($creador->getCaNombres() . " " . $creador->getCaApellidos()),
                );
            }
        }

        $this->rs = $listaReporte;
        $this->dateInicial = $dateInicial;
        $this->dateFinal = $dateFinal;
    }

    public function executeCargasPendientesxLiberar(sfWebRequest $request) {

        $fecha = date('Y-m-d');
        $nuevafecha = strtotime('-9 day', strtotime($fecha));
        $nuevafecha = date('Y-m-d', $nuevafecha);
        $nuevo = $request->getParameter("new"); // INO Nuevo
        //echo $nuevafecha;
        if ($nuevo) {
            $sql = "SELECT DISTINCT 
                    m.ca_referencia,                    
                    ori.ca_ciudad as origen, 
                    dest.ca_ciudad as destino, 
                    m.ca_master as ca_mbls, 
                    h.ca_doctransporte as ca_hbls,
                    i.ca_nombre as ca_compania,
                        (SELECT string_agg(rs.ca_idetapa::text, '|'::text) AS ca_idetapa
                        FROM tb_repstatus rs
                                left join tb_reportes rr ON rs.ca_idreporte = rr.ca_idreporte
                        where r.ca_consecutivo::text = rr.ca_consecutivo::text) as ca_idetapa,
                        m.ca_modalidad, 
                    s.ca_nombre as ca_sucursal, 
                    m.ca_fchllegada as ca_fcharribo,
                    hs.ca_fchliberacion, 
                    m.ca_fchcerrado, 
                    m.ca_usucerrado, 
                    hs.ca_continuacion, 
                    b.ca_nombre as ca_bodega,
                    r.ca_consecutivo,
                    array_to_string(ARRAY( SELECT ((tt.ca_serial::text)) 
                                                    FROM ino.tb_equipos tt
                                                    WHERE tt.ca_idmaster = m.ca_idmaster), '|'::text) AS ca_contenedores,
                    hs.ca_fchlibero
                FROM ino.tb_master m
                        JOIN ino.tb_master_sea ms ON m.ca_idmaster = ms.ca_idmaster
                        LEFT JOIN ino.tb_house h ON m.ca_idmaster = h.ca_idmaster
                        LEFT JOIN tb_bodegas b ON h.ca_idbodega = b.ca_idbodega
                        JOIN ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse
                        JOIN control.tb_usuarios u ON u.ca_login = h.ca_vendedor
                        JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                        JOIN ids.tb_ids i ON i.ca_id = h.ca_idcliente

                        LEFT JOIN tb_reportes r ON r.ca_idreporte = h.ca_idreporte
                        JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen
                        JOIN tb_ciudades dest ON dest.ca_idciudad = m.ca_destino                
                WHERE m.ca_transporte = 'Marítimo' 
                        AND m.ca_impoexpo = 'Importación'
                        AND hs.ca_fchlibero is null 
                        AND CAST(m.ca_fchllegada AS DATE) < '$nuevafecha'     
                        AND SUBSTR(m.ca_referencia,1,3) NOT IN ('700','710','720','800','810','820')
                        AND ms.ca_estado is not null AND ms.ca_estado != 'R' AND ms.ca_estado != 'A'
                        AND m.ca_impoexpo <> 'Triangulación'        
                        AND m.ca_fchllegada > '2017-01-01'
                ORDER BY dest.ca_ciudad, m.ca_fchllegada, ca_referencia";

            $sql = "SELECT DISTINCT m.ca_referencia, ori.ca_ciudad as origen, dest.ca_ciudad as destino, m.ca_master as ca_mbls, h.ca_doctransporte as ca_hbls, i.ca_nombre as ca_compania, 
                t.ca_idetapa,
               m.ca_modalidad, s.ca_nombre as ca_sucursal, m.ca_fchllegada as ca_fcharribo, hs.ca_fchliberacion, m.ca_fchcerrado, m.ca_usucerrado, hs.ca_continuacion, b.ca_nombre as ca_bodega, r.ca_consecutivo, 
               array_to_string(ARRAY( SELECT ((tt.ca_serial::text)) FROM ino.tb_equipos tt WHERE tt.ca_idmaster = m.ca_idmaster), ' '::text) AS ca_contenedores, hs.ca_fchlibero 

               FROM ino.tb_master m 
               JOIN ino.tb_master_sea ms ON m.ca_idmaster = ms.ca_idmaster 
               LEFT JOIN ino.tb_house h ON m.ca_idmaster = h.ca_idmaster 
               LEFT JOIN tb_bodegas b ON h.ca_idbodega = b.ca_idbodega 
               JOIN ino.tb_house_sea hs ON hs.ca_idhouse = h.ca_idhouse 
               JOIN control.tb_usuarios u ON u.ca_login = h.ca_vendedor 
               JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal 
               JOIN ids.tb_ids i ON i.ca_id = h.ca_idcliente 
               LEFT JOIN tb_reportes r ON r.ca_idreporte = h.ca_idreporte

               --LEFT JOIN tb_repstatus rs ON rs.ca_idreporte = h.ca_idreporte  
               LEFT JOIN 
                       (select rs1.ca_idreporte,rs1.ca_idetapa
                               FROM tb_repstatus rs1
                               --inner join tb_reportes r1 ON r1.ca_idreporte=rs1.ca_idreporte
                               WHERE rs1.ca_idetapa = 'OTTRA'--r.ca_consecutivo=r1.ca_consecutivo 
                       ) t ON r.ca_idreporte=t.ca_idreporte --AND  t.ca_idetapa != 'OTTRA'

               JOIN tb_ciudades ori ON ori.ca_idciudad = m.ca_origen 
               JOIN tb_ciudades dest ON dest.ca_idciudad = m.ca_destino 
               WHERE 
                       m.ca_transporte = 'Marítimo' AND m.ca_impoexpo = 'Importación' AND hs.ca_fchlibero is null AND 
                       m.ca_fchllegada < '$nuevafecha' AND m.ca_modalidad !='PARTICULARES' AND m.ca_fchanulado IS NULL 
                       AND ms.ca_estado is not null AND ms.ca_estado not in('R' ,'A' ) AND NOT (ms.ca_estado = 'E' and ca_referencia is null)

               ORDER BY dest.ca_ciudad, m.ca_fchllegada, ca_referencia";
            //echo $sql;
            //exit;
        } else {
            $sql = "SELECT DISTINCT 
                        im.ca_referencia,                    
                        ori.ca_ciudad as origen, 
                        dest.ca_ciudad as destino, 
                        im.ca_mbls, ics.ca_hbls, 
                        ics.ca_compania,
                        /*( SELECT ca_tiporep
                        FROM tb_reportes rr
                        WHERE r.ca_consecutivo::text = rr.ca_consecutivo::text order by ca_version DESC LIMIT 1) AS ca_tiporeporte,*/
                        (SELECT string_agg(rs.ca_idetapa::text, '|'::text) AS ca_idetapa
                            FROM tb_repstatus rs
                                    left join tb_reportes rr ON rs.ca_idreporte = rr.ca_idreporte
                            where r.ca_consecutivo::text = rr.ca_consecutivo::text) as ca_idetapa,
                        im.ca_modalidad, 
                        ics.ca_sucursal, 
                        im.ca_fcharribo, 
                        ics.ca_fchliberacion, 
                        im.ca_fchcerrado, 
                        im.ca_usucerrado, 
                        ics.ca_continuacion, 
                        ics.ca_bodega,
                        r.ca_consecutivo,
                        array_to_string(ARRAY( SELECT ((tt.ca_idequipo::text)) 
                                                FROM tb_inoequiposxcliente tt
                                                WHERE tt.ca_idinocliente = ics.ca_idinocliente), '|'::text) AS ca_contenedores,
                        ics.ca_fchlibero
                FROM tb_inomaestra_sea im
                        LEFT JOIN vi_inoclientes_sea ics ON ics.ca_referencia = im.ca_referencia
                        LEFT JOIN tb_reportes r ON r.ca_idreporte = ics.ca_idreporte
                        JOIN tb_ciudades ori ON ori.ca_idciudad = im.ca_origen
                        JOIN tb_ciudades dest ON dest.ca_idciudad = im.ca_destino                
                WHERE ics.ca_fchlibero is null 
                        AND CAST(ca_fcharribo AS DATE) < '$nuevafecha'     
                        AND SUBSTR(im.ca_referencia,1,3) NOT IN ('700','710','720','800','810','820')
                        AND ca_estado is not null AND ca_estado != 'R' AND ca_estado != 'A'
                        AND im.ca_impoexpo <> 'Triangulación'        
                        AND ca_fcharribo > '2017-01-01'                    
                ORDER BY dest.ca_ciudad, ca_fcharribo, ca_referencia";
        }
        //echo $sql;
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $this->cargas = $st->fetchAll();
    }

    /**
     * Módulo de entrada al Informe de Referencias Procesadas o Libro de Referencias
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteReferenciasProcesadasExt5(sfWebRequest $request) {
        
    }

    public function executeReporteReferenciasProcesadasListExt5(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $estado = $datos->estado;
        $impoexpo = utf8_decode($datos->impoexpo);
        $transporte = utf8_decode($datos->transporte);

        /* Sub-Consulta de Referencias */
        $anios = array();
        foreach ($datos->anio as $anio) {
            $anios[] = "'" . substr($anio, 2, 2) . "'";
        }

        $inner = "";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster "
                    . "inner join control.tb_usuarios u on h.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }
        $sql = "select m.ca_referencia from ino.tb_master m $inner where "
                . "substr(m.ca_referencia, 16, 2) in (" . implode(",", $anios) . ") ";

        if ($datos->mes[0] != "%") {
            $sql .= "and substr(ca_referencia, 8, 2) in ('" . implode("','", $datos->mes) . "') ";
        }

        if ($datos->sufijo[0] != "Sufijos (Todos)") {
            $sufijos = array();
            foreach ($datos->sufijo as $sufijo) {
                $sufijos[] = "'" . substr($sufijo + 100, 1, 2) . "'";
            }
            $sql .= "and substr(ca_referencia, 5, 2) in (" . implode(",", $sufijos) . ") ";
        }

        if ($impoexpo) {
            $sql .= "and m.ca_impoexpo = '" . $impoexpo . "' ";
        }

        if ($transporte) {
            $sql .= "and m.ca_transporte = '" . $transporte . "' ";
        }

        if ($estado == "Abierto") {
            $sql .= "and m.ca_fchcerrado IS NULL ";
        } else if ($estado == "Cerrado") {
            $sql .= "and m.ca_fchcerrado IS NOT NULL ";
        }

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoMaster")
                    ->createQuery("m")
                    ->whereIn("m.ca_referencia", $rs);

            if ($datos->trafico[0] != '%') {
                $q->innerJoin("m.Origen o WITH o.ca_idciudad = m.ca_origen");
                $q->whereIn("o.ca_idtrafico", $datos->trafico);
            }

            if ($datos->destino[0] != '%') {
                $q->whereIn("m.ca_destino", $datos->destino);
            }
            $inoMasters = $q->execute();

            $data = array();
            foreach ($inoMasters as $inoMaster) {
                $row = array();
                $row["idmaster"] = $inoMaster->getCaIdmaster();
                $row["referencia"] = $inoMaster->getCaReferencia();
                $row["std_cerrado"] = ($inoMaster->getCerrado()) ? "Cerrado" : "Abierto";
                $row["fchllegada"] = $inoMaster->getCaFchllegada();
                $row["doctransporte"] = utf8_encode($inoMaster->getCaMaster());
                $row["fchcerrado"] = $inoMaster->getCaFchcerrado();
                $row["usucerrado"] = $inoMaster->getCaUsucerrado();

                $row["observaciones"] = htmlspecialchars(utf8_encode($inoMaster->getCaObservaciones()));

                $startArry = date_parse(date('Y-m-d H:i:s'));
                $endArry = date_parse($inoMaster->getCaFchllegada() . " 00:00:00");

                $tstamp_actual = mktime($startArry[hour], $startArry[minute], $startArry[second], $startArry[month], $startArry[day], $startArry[year]);
                $tstamp_fcharribo = mktime($endArry[hour], $endArry[minute], $endArry[second], $endArry[month], $endArry[day], $endArry[year]);

                $master = json_decode(utf8_encode($inoMaster->getInoMasterSea()->getCaDatosmuisca()));
                if ($master->numenvio) {
                    $row["fchmuisca"] = $master->fchenvio;
                    $row["usumuisca"] = $master->usuenvio;
                    $row["nomuisca"] = $master->iddocactual;
                }

                $festivos = TimeUtils::getFestivos(date("Y"));
                if ($master->iddocactual) {
                    $row["color"] = "rowOk";
                } elseif ($tstamp_actual > $tstamp_fcharribo and ! $master->iddocactual) {
                    $row["color"] = "rowVencido";
                } else {
                    $dif_mem = TimeUtils::workDiff($festivos, date('Y-m-d'), $inoMaster->getCaFchllegada());
                    if ($dif_mem > 2) {
                        $row["color"] = "rowVerde";
                    } else {
                        $dif_mem = TimeUtils::calcDiff($festivos, $tstamp_actual, $tstamp_fcharribo);
                        $dif_hou = date_parse($dif_mem);

                        if ($dif_hou[hour] > 8) {
                            $row["color"] = "rowAmarillo";
                        } else if ($dif_hou[hour] <= 8 and ! $master->iddocactual) {
                            $row["color"] = "rowRojo";
                        } else {
                            $row["color"] = "rowOk";
                        }
                    }
                }
                $data[] = $row;
            }

            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo de entrada al Informe de Contenedores
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteContenedoresExt5(sfWebRequest $request) {
        
    }

    public function executeReporteContenedoresListExt5(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $impoexpo = 'Importación';
        $transporte = 'Marítimo';

//        $this->continuacion = $request->getParameter("continuacion");
//        $this->patio = $request->getParameter("patio");
//        $this->cliente = $request->getParameter("cliente");

        /* Sub-Consulta de Referencias */
        $anios = array();
        foreach ($datos->anio as $anio) {
            $anios[] = "'" . substr($anio, 2, 2) . "'";
        }

        $inner = "";
        if ($datos->continuacion[0] != "%") {
            $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster "
                    . "inner join ino.tb_house_sea s on h.ca_idhouse = s.ca_idhouse "
                    . "     and s.ca_continuacion in ('" . implode("','", $datos->continuacion) . "')";
        }
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            if ($inner == "") {
                $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster ";
            }
            $inner .= "inner join control.tb_usuarios u on h.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }
        $sql = "select m.ca_referencia from ino.tb_master m $inner where "
                . "substr(m.ca_referencia, 16, 2) in (" . implode(",", $anios) . ") ";

        if ($datos->mes[0] != "%") {
            $sql .= "and substr(m.ca_referencia, 8, 2) in ('" . implode("','", $datos->mes) . "') ";
        }

        if ($datos->sufijo[0] != "Sufijos (Todos)") {
            $sufijos = array();
            foreach ($datos->sufijo as $sufijo) {
                $sufijos[] = "'" . substr($sufijo + 100, 1, 2) . "'";
            }
            $sql .= "and substr(m.ca_referencia, 5, 2) in (" . implode(",", $sufijos) . ") ";
        }
        if ($datos->transportista) {
            $sql .= "and m.ca_idlinea = " . $datos->transportista;
        }
        $sql .= "and m.ca_modalidad in ('FCL', 'LCL')";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoMaster")
                    ->createQuery("m")
                    ->addWhere("m.ca_impoexpo = ?", $impoexpo)
                    ->addWhere("m.ca_transporte = ?", $transporte)
                    ->whereIn("m.ca_referencia", $rs);

            if ($datos->trafico[0] != '%') {
                $q->innerJoin("m.Origen o WITH o.ca_idciudad = m.ca_origen");
                $q->whereIn("o.ca_idtrafico", $datos->trafico);
            }

            if ($datos->destino[0] != '%') {
                $q->whereIn("m.ca_destino", $datos->destino);
            }
            if ($datos->fchArriboIni && $datos->fchArriboFin) {
                $q->addWhere("m.ca_fchllegada between ? and ?", array($datos->fchArriboIni, $datos->fchArriboFin));
            } else if ($datos->fchArriboIni && !$datos->fchArriboFin) {
                $q->addWhere("m.ca_fchllegada >= ?", $datos->fchArriboIni);
            } else if (!$datos->fchArriboIni && $datos->fchArriboFin) {
                $q->addWhere("m.ca_fchllegada <= ?", $datos->fchArriboFin);
            }
            $inoMasters = $q->execute();

            $data = array();
            foreach ($inoMasters as $inoMaster) {
                $row = array();
                $row["idmaster"] = $inoMaster->getCaIdmaster();
                $row["referencia"] = $inoMaster->getCaReferencia();
                $row["trafico"] = utf8_encode($inoMaster->getOrigen()->getTrafico()->getCaNombre());
                $row["origen"] = utf8_encode($inoMaster->getOrigen()->getCaCiudad());
                $row["destino"] = utf8_encode($inoMaster->getDestino()->getCaCiudad());
                $row["std_cerrado"] = ($inoMaster->getCerrado()) ? "Cerrado" : "Abierto";
                $row["fchllegada"] = $inoMaster->getCaFchllegada();
                $row["doctransporte"] = utf8_encode($inoMaster->getCaMaster());
                $row["transportista"] = utf8_encode($inoMaster->getIdsProveedor()->getIds()->getCaNombre());
                $row["motonave"] = utf8_encode($inoMaster->getCaMotonave());

                $row["observaciones"] = utf8_encode($inoMaster->getCaObservaciones());

                $html_cli = "<table class=\"tableList alignLeft\">"
                        . "<th>Cliente</th>"
                        . "<th>Doc.Transporte</th>"
                        . "<th>Cont.Viaje</th>";
                $houses = $inoMaster->getInoHouse();
                foreach ($houses as $house) {
                    $html_cli .= "<tr>"
                            . "     <td>" . $house->getCliente()->getIds()->getCaNombre() . "</td>"
                            . "     <td>" . $house->getCaDoctransporte() . "</td>"
                            . "     <td>" . $house->getInoHouseSea()->getCaContinuacion() . "</td>"
                            . "</tr>";
                }
                $html_cli .= "</table>";
                $row["clientes"] = utf8_encode($html_cli);

                $html_equ = "<table class=\"tableList alignLeft\">"
                        . "<th>Equipo</th>"
                        . "<th>Serial</th>"
                        . "<th>Precinto</th>"
                        . "<th>Días Lib.</th>"
                        . "<th>Límite Dev.</th>"
                        . "<th>Devolución</th>"
                        . "<th>Patio</th>"
                        . "<th>Observaciones</th>";

                $dias_libres = array();
                $equipos = $inoMaster->getInoEquipo();
                foreach ($equipos as $equipo) {
                    $datos = json_decode($equipo->getCaDatos());
                    $html_equ .= "<tr>"
                            . "     <td>" . $equipo->getConcepto()->getCaConcepto() . "</td>"
                            . "     <td>" . $equipo->getCaSerial() . "</td>"
                            . "     <td>" . $equipo->getCaNumprecinto() . "</td>"
                            . "     <td>" . $datos->dias_libres . "</td>"
                            . "     <td>" . $datos->limite_devolucion . "</td>"
                            . "     <td>" . $datos->devolucion_fch . "</td>"
                            . "     <td>" . $datos->patio . "</td>"
                            . "     <td>" . $equipo->getCaObservaciones() . "</td>"
                            . "</tr>";
                    if (!in_array($datos->dias_libres, $dias_libres)) {
                        $dias_libres[] = $datos->dias_libres;
                    }
                }
                $html_equ .= "</table>";
                $row["equipos"] = utf8_encode($html_equ);

                $intervalo = Utils::diffDays($inoMaster->getCaFchllegada(), date("Y-m-d"));
                if (count($dias_libres) == 0) {
                    $row["color"] = "rowVencido";
                } else if ($datos->devolucion_fch) {
                    $row["color"] = null;
                } else if ($intervalo >= round(min($dias_libres) * 0.6666666666, 0)) {
                    $row["color"] = "rowRojo";
                } else if ($intervalo >= round(min($dias_libres) * 0.3333333333, 0)) {
                    $row["color"] = "rowAmarillo";
                } else {
                    $row["color"] = "rowOk";
                }
                $data[] = $row;
            }
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo de entrada al Informe de Aérolineas Exportaciones
     *
     * @param sfRequest $request A request object
     */
    public function executeInformeAerolineasExpoExt5(sfWebRequest $request) {
        
    }

    public function executeDatosInformeAerolineasExpo(sfWebRequest $request) {
        $idCarrier = $request->getParameter("idCarrier");
        $fechaInicial = $request->getParameter("fechaInicial");
        $fechaFinal = $request->getParameter("fechaFinal");

        $documentos = Doctrine::getTable("ExpoAwbtransporte")
                ->createQuery("a")
                ->addWhere("a.ca_idmaster IS NOT NULL")
                ->addWhere("a.ca_idcarrier_uno = ?", $idCarrier)
                ->addWhere("a.ca_fchdoctransporte BETWEEN ? AND ?", array($fechaInicial, $fechaFinal))
                ->execute();

        $data = array();
        $subt = array();

        foreach ($documentos as $documento) {
            $master = $documento->getInoMaster();
            $houses = $master->getInoHouse();
            foreach ($houses as $house) {
                $reporte = $house->getReporte();
                if ($reporte) {
                    $reporte = $reporte->getRepUltVersion();
                    break;
                }
            }
            $flat = null;
            $tarifa = $incentivo = 0;
            if ($reporte) {
                $repTarifas = $reporte->getRepTarifa();
                foreach ($repTarifas as $repTarifa) {
                    if ($documento->getCaChargesCode() == "CC") {
                        $tarifa = $repTarifa->getCaCobrarTar() - $repTarifa->getCaNetaTar();
                        if ($repTarifa->getConcepto()->getCaConcepto() == "Flat" || $repTarifa->getConcepto()->getCaConcepto() == "Mínimo") {
                            $flat = $repTarifa->getCaCobrarTar() - $repTarifa->getCaNetaTar();
                        }
                    } else if ($documento->getCaChargesCode() == "PP") {
                        $tarifa = ($repTarifa->getCaReportarTar() != 0) ? $repTarifa->getCaReportarTar() : $repTarifa->getCaCobrarTar();
                        if ($repTarifa->getConcepto()->getCaConcepto() == "Flat" || $repTarifa->getConcepto()->getCaConcepto() == "Mínimo") {
                            $flat = ($repTarifa->getCaReportarTar() != 0) ? $repTarifa->getCaReportarTar() : $repTarifa->getCaCobrarTar();
                        }
                        $incentivo = (($flat) ? $flat : $tarifa) - $repTarifa->getCaNetaTar();
                    }
//                    $tarifa = ($documento->getCaChargesCode()=="CC")?$repTarifa->getCaCobrarTar()-$repTarifa->getCaNetaTar():$repTarifa->getCaNetaTar();
//                    if ($repTarifa->getConcepto()->getCaConcepto() == "Flat" || $repTarifa->getConcepto()->getCaConcepto() == "Mínimo") {
//                        $flat = ($documento->getCaChargesCode()=="CC")?$repTarifa->getCaCobrarTar()-$repTarifa->getCaNetaTar():$repTarifa->getCaNetaTar();
//                    }
                    break;
                }
            }

            $tcambio = $documento->getCaAccountingInfo();
            $pos = stripos($tcambio, "T.C.");
            $tcambio = substr($tcambio, $pos, 14);
            $tcambio = floatval(preg_replace('/[^0-9]+/', '', $tcambio) / 100);

            $peso = $documento->getCaGrossWeight();
            if ($documento->getCaWeightCharge() > $documento->getCaGrossWeight()) {
                $peso = $documento->getCaWeightCharge();
            }
            if ($flat) {
                $flete = $flat;
            } else {
                $flete = $peso * $tarifa;      // $documento->getCaRateCharge();
                $incentivo = $peso * $incentivo;
            }
            $dagent = ($documento->getCaChargesCode() == "CC") ? $documento->getCaDueAgent() : 0;
            $dcarrier = ($documento->getCaChargesCode() == "PP") ? $documento->getCaDueCarrier() : 0;
            $total = $flete + $dagent + $dcarrier;

            $data[] = array("idmaster" => $documento->getCaIdmaster(),
                "referencia" => $documento->getInoMaster()->getCaReferencia(),
                "master" => $documento->getInoMaster()->getCaMaster(),
                "origen" => utf8_encode($documento->getInoMaster()->getOrigen()->getCaCiudad()),
                "destino" => utf8_encode($documento->getInoMaster()->getDestino()->getCaCiudad()),
                "fchsalida" => $documento->getCaFchdoctransporte(),
                "peso" => $peso,
                "charges_code" => $documento->getCaChargesCode(),
                "tarifa" => $tarifa, // $documento->getCaRateCharge(),
                "tcambio" => $tcambio,
                "incentivo" => round($incentivo * $tcambio, 0),
                "flete_usd" => round($flete, 2),
                "flete_cop" => round($flete * $tcambio, 0),
                "dagent_usd" => round($dagent, 2),
                "dagent_cop" => round($dagent * $tcambio, 0),
                "dcarrier_usd" => round($dcarrier, 2),
                "dcarrier_cop" => round($dcarrier * $tcambio, 0),
                "otros_usd" => round(0, 2),
                "otros_cop" => round(0, 0),
                "total_usd" => round($total, 2),
                "total_cop" => round($total * $tcambio, 0)
            );

            $subt[$documento->getCaChargesCode()]["charges_code"] = ($documento->getCaChargesCode() == "CC") ? "Collect" : "Prepaid";
            $subt[$documento->getCaChargesCode()]["incentivo"] += round($incentivo * $tcambio, 2);
            $subt[$documento->getCaChargesCode()]["flete_usd"] += round($flete, 2);
            $subt[$documento->getCaChargesCode()]["flete_cop"] += round($flete * $tcambio, 0);
            $subt[$documento->getCaChargesCode()]["dagent_usd"] += round($dagent, 2);
            $subt[$documento->getCaChargesCode()]["dagent_cop"] += round($dagent * $tcambio, 0);
            $subt[$documento->getCaChargesCode()]["dcarrier_usd"] += round($dcarrier, 2);
            $subt[$documento->getCaChargesCode()]["dcarrier_cop"] += round($dcarrier * $tcambio, 0);
            $subt[$documento->getCaChargesCode()]["total_usd"] += round($total, 2);
            $subt[$documento->getCaChargesCode()]["total_cop"] += round($total * $tcambio, 0);
        }
        $tots = array();
        foreach ($subt as $sub) {
            $tots[] = $sub;
        }

        $this->responseArray = array("success" => true, "root" => $data, "tots" => $tots, "total" => count($data));

        $this->setTemplate("responseTemplate");
    }

    public function executeGenerarPasivos(sfWebRequest $request) {
        $comprobante_fch = $request->getParameter("comprobante_fch");
        $idproveedor = $request->getParameter("idproveedor");
        $datos = $request->getParameter("datos");

        $conn = Doctrine::getTable("InoComprobante")->getConnection();
        try {
            $referencias = json_decode($datos);
            $conn->beginTransaction();

            foreach ($referencias as $referencia) {
                $house = Doctrine::getTable("InoHouse")->findOneBy("ca_idmaster", $referencia->idmaster);
                $sucursal = $house->getVendedor()->getSucursal();
                if ($sucursal->getCaNombre() == "Cartagena") {      // Si es Cartagena, redirecciona a sucursal Barranquilla
                    $sucursal = Doctrine::getTable("Sucursal")->findOneBy("ca_idsucursal", "BAQ");
                }

                $sucProveedor = Doctrine::getTable("IdsSucursal")->findOneBy("ca_id", $idproveedor);
                if ($referencia->charges_code == "PP") {
                    $tipo = "P";
                    $flete_cod = 81;
                    $incentivo_cod = 28;
                    $dcarrier_cod = 60;
                    $consecutivo = $referencia->master;
                } else if ($referencia->charges_code == "CC") {
                    $tipo = "F";
                    $flete_cod = 28;
                    $dagent_cod = 138;
                    $dcarrier_cod = 60;
                    $consecutivo = NULL;
                } else {
                    continue;
                }
                $tipoComprobante = Doctrine::getTable("InoTipoComprobante")
                        ->createQuery("t")
                        ->innerJoin("t.Sucursal s")
                        ->addWhere("t.ca_tipo = ?", $tipo)
                        ->addWhere("t.ca_idempresa = ?", 2)
                        ->addWhere("s.ca_nombre = ?", $sucursal->getCaNombre())
                        ->fetchOne();

                $ccosto = Doctrine::getTable("InoCentroCosto")
                        ->createQuery("c")
                        ->select("*")
                        ->where('ca_impoexpo = ? and ca_transporte = ? and ca_idsucursal is null and ca_idempresa = ?', array($house->getInoMaster()->getCaImpoexpo(), $house->getInoMaster()->getCaTransporte(), $tipoComprobante->getCaIdempresa()))
                        ->fetchOne();
                $cc = $ccosto->getCaIdccosto();

                $comprobante = new InoComprobante();
                $comprobante->setCaId($idproveedor);
                $comprobante->setCaIdtipo($tipoComprobante->getCaIdtipo());
                $comprobante->setCaConsecutivo($consecutivo);
                $comprobante->setCaFchcomprobante($comprobante_fch);
                if ($referencia->charges_code == "CC") {
                    $comprobante->setCaIdhouse($house->getCaIdhouse());
                }
                $comprobante->setCaIdccosto($cc);
                $comprobante->setCaPlazo(0);
                $comprobante->setCaTcambio(1);
                $comprobante->setCaEstado(0);
                $comprobante->setCaIdsucursal($sucProveedor->getCaIdsucursal());
                $comprobante->setCaIdmoneda('COP');
                $comprobante->save($conn);

                $com_detalle = new InoDetalle();
                $com_detalle->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                $com_detalle->setCaIdconcepto($flete_cod); // Flete Internacional
                $com_detalle->setCaIdmaster($referencia->idmaster);
                $com_detalle->setCaIdhouse($house->getCaIdhouse());
                $com_detalle->setCaId($idproveedor);
                $com_detalle->setCaCr($referencia->flete_cop);
                $com_detalle->save($conn);

                if ($referencia->charges_code != "PP" && $referencia->dagent_cop && $referencia->dagent_cop <> 0) {
                    $com_detalle = new InoDetalle();
                    $com_detalle->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                    $com_detalle->setCaIdconcepto($dagent_cod); // Due Agent
                    $com_detalle->setCaId($idproveedor);
                    $com_detalle->setCaCr($referencia->dagent_cop);
                    $com_detalle->save($conn);
                }

                if ($referencia->dcarrier_cop && $referencia->dcarrier_cop <> 0) {
                    $com_detalle = new InoDetalle();
                    $com_detalle->setCaIdcomprobante($comprobante->getCaIdcomprobante());
                    $com_detalle->setCaIdconcepto($dcarrier_cod); // Due Carrier
                    $com_detalle->setCaIdmaster($referencia->idmaster);
                    // $com_detalle->setCaIdhouse($house->getCaIdhouse());
                    $com_detalle->setCaId($idproveedor);
                    $com_detalle->setCaCr($referencia->dcarrier_cop);
                    $com_detalle->save($conn);
                }

                if ($referencia->charges_code == "PP" && $referencia->incentivo <> 0) {     // Genera Factura a la aerolinea por el valor del incentivo
                    $tipoComprobante = Doctrine::getTable("InoTipoComprobante")
                            ->createQuery("t")
                            ->innerJoin("t.Sucursal s")
                            ->addWhere("t.ca_tipo = ?", "F")
                            ->addWhere("t.ca_idempresa = ?", 2)
                            ->addWhere("s.ca_nombre = ?", $sucursal->getCaNombre())
                            ->fetchOne();

                    $incentivo = $comprobante->copy(); // new InoComprobante($comprobante);
                    $incentivo->setCaIdtipo($tipoComprobante->getCaIdtipo());
                    $incentivo->setCaConsecutivo(null);
                    $incentivo->setCaIdhouse($house->getCaIdhouse());
                    $incentivo->save($conn);

                    $com_detalle = new InoDetalle();
                    $com_detalle->setCaIdcomprobante($incentivo->getCaIdcomprobante());
                    $com_detalle->setCaIdconcepto($incentivo_cod); // Flete Internacional
                    $com_detalle->setCaIdmaster($referencia->idmaster);
                    $com_detalle->setCaIdhouse($house->getCaIdhouse());
                    $com_detalle->setCaId($idproveedor);
                    $com_detalle->setCaCr($referencia->incentivo);
                    $com_detalle->save($conn);
                }

                $this->responseArray = array("success" => true, "errorInfo" => "");
            }
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo de entrada al Reporte Cuadro Ino Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteCuadroInoV2Ext5(sfWebRequest $request) {
        
    }

    /**
     * Reporte de Salida de Cuadro Ino Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeSalidaCuadroInoV2Ext5(sfWebRequest $request) {
        $anio = explode(",", $request->getParameter("anio"));
        $mes = explode(",", $request->getParameter("mes"));
        $estado = explode(",", $request->getParameter("estado"));
        $impoexpo = explode(",", $request->getParameter("impoexpo"));
        $transporte = explode(",", $request->getParameter("transporte"));
        $trafico = explode(",", $request->getParameter("trafico"));
        $puerto = explode(",", $request->getParameter("puerto"));
        $vendedor = explode(",", $request->getParameter("vendedor"));
        $sucursal = explode(",", $request->getParameter("sucursal"));
        $modalidad = explode(",", $request->getParameter("modalidad"));

        $cliente = $request->getParameter("cliente");
        $agente = $request->getParameter("agente");
        $transportista = $request->getParameter("transportista");
        $filtros = json_decode(utf8_encode($request->getParameter("filters")));
        $columnas = json_decode(utf8_encode($request->getParameter("columns")));
        $inner = "";

        $sql = "select m.ca_idmaster from ino.tb_master m $inner where "
                . "2000 + substr(m.ca_referencia, 16, 2)::int in (" . implode(",", $anio) . ") ";

        if ($mes[0] != "%") {
            $sql .= "and substr(ca_referencia, 8, 2) in ('" . implode("','", $mes) . "') ";
        }

        if ($impoexpo) {
            /* Controla el listado de datos de COLOTM */
            if (!in_array(Constantes::COLOTM, $impoexpo)) {
                $sql .= "and left(m.ca_referencia, 1) <> '7' ";
            }
            if (!in_array(Constantes::OTMDTA, $impoexpo)) {
                $sql .= "and left(m.ca_referencia, 2) <> '49' ";
            }
            if (in_array(Constantes::COLOTM, $impoexpo)) {
                $impoexpo[] = Constantes::OTMDTA;
            }
            $sql .= "and m.ca_impoexpo in ('" . implode("','", $impoexpo) . "') ";
        }

        if ($transporte) {
            $sql .= "and m.ca_transporte in ('" . implode("','", $transporte) . "') ";
        }

        if ($modalidad[0]) {
            $sql .= "and m.ca_modalidad in ('" . implode("','", $modalidad) . "') ";
        }

        if (count($estado) == 1) {
            if ($estado[0] == "Abierto") {
                $sql .= "and m.ca_fchcerrado IS NULL ";
            } else if ($estado[0] == "Cerrado") {
                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
            }
        }
        // die($sql);
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoMaster")
                    ->createQuery("mst")
                    ->innerJoin("mst.InoHouse hst")
                    ->addWhere("mst.ca_fchanulado is null")
                    ->whereIn("mst.ca_idmaster", $rs);

            $joins = array();
            $this->filters = array();
            $this->columns = array();
            $this->columns[] = array("xtype" => "treecolumn", "text" => "Agrupamiento", "flex" => "2", "sortable" => true, "dataIndex" => "text");
            $ingresos = $costos = $deducciones = $utilidad = $carga = $vehiculo = $terceros = false;

            foreach ($columnas as $key => $columna) {
                $is_filter = false;
                foreach ($filtros as $filtro) {
                    if ($filtro->alias == $columna->alias) {
                        $is_filter = true;
                    }
                }
                if (!$is_filter) {
                    if ($columna->alias == "datos_carga") {
                        $this->columns[] = array("text" => "Peso", "dataIndex" => "hst_ca_peso");
                        $this->columns[] = array("text" => "Volumen", "dataIndex" => "hst_ca_volumen");
                        $this->columns[] = array("text" => "Teus", "dataIndex" => "hst_ca_teus");
                    } else {
                        $this->columns[] = array("text" => $columna->titulo, "dataIndex" => $columna->alias);
                    }
                }

                switch ($columna->alias) {
                    case "mst_annio":
                        $q->addSelect($columna->sql . " as annio");
                        break;
                    case "mst_mes":
                        $q->addSelect($columna->sql . " as mes");
                        break;
                    case "trg_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Origen")) {
                            $q->innerJoin("mst.Origen org");
                        }
                        if (!$this->validaEstadoArreglo($joins, "Traorigen")) {
                            $q->innerJoin("org.Trafico trg");
                        }
                        $q->addSelect($columna->sql);
                        $q->addSelect("org.ca_ciudad");
                        $q->addSelect("trg.ca_nombre");
                        break;
                    case "org_ca_ciudad":
                        if (!$this->validaEstadoArreglo($joins, "Origen")) {
                            $q->innerJoin("mst.Origen org");
                        }
                        $q->addSelect($columna->sql);
                        $q->addSelect("org.ca_ciudad");
                        break;
                    case "tds_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Destino")) {
                            $q->innerJoin("mst.Destino dst");
                        }
                        if (!$this->validaEstadoArreglo($joins, "Tradestino")) {
                            $q->innerJoin("dst.Trafico tds");
                        }
                        $q->addSelect($columna->sql);
                        $q->addSelect("tds.ca_nombre");
                        break;
                    case "dst_ca_ciudad":
                        if (!$this->validaEstadoArreglo($joins, "Destino")) {
                            $q->innerJoin("mst.Destino dst");
                        }
                        $q->addSelect($columna->sql);
                        $q->addSelect("dst.ca_ciudad");
                        break;
                    case "cli_ca_compania":
                        if (!$this->validaEstadoArreglo($joins, "Cliente")) {
                            $q->innerJoin("hst.Cliente cli");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "cli_ca_stdcircular":
                        if (!$this->validaEstadoArreglo($joins, "Cliente")) {
                            $q->innerJoin("hst.Cliente cli");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "agt_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Agente")) {
                            $q->leftJoin("mst.IdsAgente ids1");
                            $q->leftJoin("ids1.Ids agt");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "prv_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Proveedor")) {
                            $q->innerJoin("mst.IdsProveedor ids2");
                            $q->innerJoin("ids2.Ids prv");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "rot_ca_consecutivo":
                        if (!$this->validaEstadoArreglo($joins, "Reporte")) {
                            $q->leftJoin("hst.Reporte rep");
                            $q->leftJoin("rep.RepOtm rot");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "imp_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Reporte")) {
                            $q->leftJoin("hst.Reporte rep");
                            $q->leftJoin("rep.RepOtm rot");
                        }
                        if (!$this->validaEstadoArreglo($joins, "Importador")) {
                            $q->leftJoin("rot.Importador imp");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "mst_ca_vehiculo":
                        $vehiculo = true;
                        break;
                    case "hst_ca_terceros":
                        $terceros = true;
                        break;
                    case "rpn_ca_incoterms":
                        $q->addSelect($columna->sql);
                        break;
                    case "usr_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                            $q->innerJoin("hst.Vendedor usr");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    case "hst_ca_ingresos":
                        $ingresos = true;
                        break;
                    case "hst_ca_costos":
                        $costos = true;
                        break;
                    case "hst_ca_deducciones":
                        $deducciones = true;
                        break;
                    case "hst_ca_utilidad":
                        $utilidad = true;
                        break;
                    case "datos_carga":
                        $carga = true;
                        break;
                    case "suc_ca_nombre":
                        if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                            $q->innerJoin("hst.Vendedor usr");
                        }
                        if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                            $q->innerJoin("usr.Sucursal suc");
                        }
                        $q->addSelect($columna->sql);
                        break;
                    default:
                        $q->addSelect($columna->sql);
                        break;
                }
            }
            $q->addSelect("mst.ca_idmaster");   // Selecciona siempre la llave primaria del master para búsquedas
            $q->addSelect("hst.ca_idhouse");   // Selecciona siempre la llave primaria del house para búsquedas

            if (count($impoexpo) == 1) {
                if ($impoexpo[0] == Constantes::IMPO) {
                    if ($trafico[0] != '%') {
                        if (!$this->validaEstadoArreglo($joins, "Origen")) {
                            $q->innerJoin("mst.Origen org WITH org.ca_idciudad = mst.ca_origen");
                        }
                        $q->whereIn("org.ca_idtrafico", $trafico);
                    }
                    if ($puerto[0]) {
                        if (!$this->validaEstadoArreglo($joins, "Destino")) {
                            $q->whereIn("mst.ca_destino", $puerto);
                        }
                    }
                } else if ($impoexpo[0] == Constantes::EXPO) {
                    if ($trafico[0] != '%') {
                        if (!$this->validaEstadoArreglo($joins, "Destino")) {
                            $q->innerJoin("mst.Destino dst WITH dst.ca_idciudad = mst.ca_destino");
                        }
                        $q->whereIn("dst.ca_idtrafico", $trafico);
                    }
                    if ($puerto[0]) {
                        $q->whereIn("mst.ca_origen", $puerto);
                    }
                }
            } else {
                if ($trafico[0] != '%') {
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->innerJoin("mst.Origen org");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Destino")) {
                        $q->innerJoin("mst.Destino dst");
                    }
                    if (in_array(Constantes::IMPO, $impoexpo)) {
                        $q->whereIn("org.ca_idtrafico", $trafico);
                    } else if (in_array(Constantes::EXPO, $impoexpo)) {
                        $q->whereIn("dst.ca_idtrafico", $trafico);
                    } else {
                        $q->orWhereIn("org.ca_idtrafico", $trafico);
                        $q->orWhereIn("dst.ca_idtrafico", $trafico);
                    }
                }
                if ($puerto[0]) {
                    $q->orWhereIn("mst.ca_origen", $puerto);
                    $q->orWhereIn("mst.ca_destino", $puerto);
                }
            }

            if ($cliente) {
                $q->addWhere("hst.ca_idcliente = ?", $cliente);
            }

            if ($agente) {
                if (!$this->validaEstadoArreglo($joins, "Agente")) {
                    $q->leftJoin("mst.IdsAgente ids1");
                    $q->leftJoin("ids1.Ids agt");
                }
                $q->addWhere("ids1.ca_idagente = ?", $agente);
            }

            if ($transportista) {
                if (!$this->validaEstadoArreglo($joins, "Proveedor")) {
                    $q->innerJoin("mst.IdsProveedor ids2");
                    $q->innerJoin("ids2.Ids prv");
                }
                $q->addWhere("ids2.ca_idproveedor = ?", $transportista);
            }

            if ($vendedor[0]) {
                $q->whereIn("hst.ca_vendedor", $vendedor);
            }

            if ($sucursal[0] != 'Sucursales (Todas)') {
                if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                    $q->innerJoin("hst.Vendedor usr");
                }
                if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                    $q->innerJoin("usr.Sucursal suc");
                }
                $q->whereIn("suc.ca_nombre", $sucursal);
            }
        }

        $orderBy = "";
        foreach ($filtros as $filtro) {
            switch ($filtro->alias) {
                case "mst_annio":
                    $orderBy .= "right(mst.ca_referencia, 2), ";
                    break;
                case "trg_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->innerJoin("mst.Origen org");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Traorigen")) {
                        $q->innerJoin("org.Trafico trg");
                        $q->addSelect("trg.ca_nombre");
                    }
                    $orderBy .= "trg.ca_nombre, ";
                    break;
                case "org_ca_ciudad":
                    if (!$this->validaEstadoArreglo($joins, "Origen")) {
                        $q->addSelect("org.ca_ciudad");
                        $q->innerJoin("mst.Origen org");
                    }
                    $orderBy .= "org.ca_ciudad, ";
                    break;
                case "dst_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Destino")) {
                        $q->addSelect("tds.ca_nombre");
                        $q->innerJoin("mst.Destino dst");
                    }
                    $orderBy .= "dst.ca_ciudad, ";
                    break;
                case "cli_ca_compania":
                    if (!$this->validaEstadoArreglo($joins, "Cliente")) {
                        $q->innerJoin("hst.Cliente cli");
                    }
                    if (strpos('cli.ca_compania', json_encode($columnas)) === false) {
                        $q->addSelect("cli.ca_compania");
                    }
                    $orderBy .= "cli.ca_compania, ";
                    break;
                case "agt_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Agente")) {
                        $q->leftJoin("mst.IdsAgente ids1");
                        $q->leftJoin("ids1.Ids agt");
                    }
                    if (strpos('agt.ca_nombre', json_encode($columnas)) === false) {
                        $q->addSelect("agt.ca_nombre");
                    }
                    $orderBy .= "agt.ca_nombre, ";
                    break;
                case "prv_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Proveedor")) {
                        $q->innerJoin("mst.IdsProveedor ids2");
                        $q->innerJoin("ids2.Ids prv");
                    }
                    if (strpos('prv.ca_nombre', json_encode($columnas)) === false) {
                        $q->addSelect("prv.ca_nombre");
                    }
                    $orderBy .= "prv.ca_nombre, ";
                    break;
                case "usr_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->addSelect("usr.ca_nombre");
                        $q->innerJoin("mst.Usuario usr");
                    }
                    $orderBy .= "usr.ca_nombre, ";
                    break;
                case "suc_ca_nombre":
                    if (!$this->validaEstadoArreglo($joins, "Vendedor")) {
                        $q->innerJoin("mst.Usuario usr");
                    }
                    if (!$this->validaEstadoArreglo($joins, "Sucursal")) {
                        $q->addSelect("suc.ca_nombre");
                        $q->innerJoin("usr.Sucursal suc");
                    }
                    $orderBy .= "suc.ca_nombre, ";
                    break;
                case "rp_ca_transporte":
                    $q->addSelect("mst.ca_transporte");
                    $orderBy .= "mst.ca_transporte, ";
                    break;
                default:
                    $orderBy .= $filtro->sql . ", ";
                    break;
            }
        }
        $orderBy .= "mst.ca_referencia";
        $q->addOrderBy($orderBy);

        $q->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $referencias_rs = $q->execute();

        $tree = new JTree();
        $root = $tree->createNode(".");
        $tree->addFirst($root);

        $ref = null;
        $this->registros = array();
        $this->expor_data = array();
        $this->expor_cols = array();
        foreach ($referencias_rs as $referencia_sc) {
            if (array_key_exists("mst_mes", $referencia_sc)) {
                $referencia_sc["mst_mes"] = Utils::mesLargo($referencia_sc["mst_mes"]);
            }
            if (array_key_exists("mst_ca_fchcerrado", $referencia_sc)) {
                $referencia_sc["mst_ca_fchcerrado"] = $referencia_sc["mst_ca_fchcerrado"] == "" ? "Abierto" : "Cerrado";
            }
            if ($ingresos || $costos || $deducciones || $utilidad || $carga || $vehiculo || $terceros) {
                $house = Doctrine::getTable("InoHouse")->findOneBy("ca_idhouse", $referencia_sc["hst_ca_idhouse"]);
                if ($ingresos) {
                    $referencia_sc["hst_ca_ingresos"] = $house->getIngresoPorHouse();
                }
                if ($costos) {
                    $referencia_sc["hst_ca_costos"] = $house->getCostoPorHouse();
                }
                if ($deducciones) {
                    $referencia_sc["hst_ca_deducciones"] = $house->getDeduccionPorHouse();
                }
                if ($utilidad) {
                    $referencia_sc["hst_ca_utilidad"] = $house->getUtilidadPorHouse();
                    if ($house->getInoMaster()->getCaTransporte() == Constantes::MARITIMO) {
                        $referencia_sc["hst_ca_utilidad"] += $house->getUtilidadPorSobreventa();
                    }
                }
                if ($terceros) {
                    $referencia_sc["hst_ca_terceros"] = $house->getTercerosFacturacion();
                }
                if ($carga) {
                    if ($house->getInoMaster()->getCaModalidad() == Constantes::FCL && $house->getInoMaster()->getCaImpoexpo() == Constantes::IMPO) {
                        $referencia_sc["hst_ca_peso"] = 0;
                        $referencia_sc["hst_ca_volumen"] = 0;
                    } else {
                        $referencia_sc["hst_ca_peso"] = $house->getCaPeso();
                        $referencia_sc["hst_ca_volumen"] = $house->getCaVolumen();
                    }
                    $referencia_sc["hst_ca_teus"] = $house->getTeusPorHouse();
                }
                if ($vehiculo) {
                    $tipovehiculo = null;
                    $datos = json_decode($house->getInoMaster()->getCaDatos());
                    if ($datos->tipovehiculo) {
                        $sql = "select distinct ca_value from control.tb_config_values where ca_idconfig = 111 and ca_ident = " . $datos->tipovehiculo;

                        $q = Doctrine_Manager::getInstance()->connection();
                        $stmt1 = $q->execute($sql);
                        $tipovehiculo = $stmt1->fetchAll(PDO::FETCH_COLUMN);
                    }
                    $referencia_sc["mst_ca_vehiculo"] = $tipovehiculo[0];
                }
            }
            if (array_key_exists("hst_ca_idreporte", $referencia_sc)) {
                $incoterms = array();
                if ($referencia_sc["hst_ca_idreporte"]) {
                    $sql = "select distinct left(ca_incoterms,3) from tb_repproveedores where ca_idreporte = " . $referencia_sc["hst_ca_idreporte"] . " order by 1";

                    $q = Doctrine_Manager::getInstance()->connection();
                    $stmt1 = $q->execute($sql);
                    $incoterms = $stmt1->fetchAll(PDO::FETCH_COLUMN);
                }
                $referencia_sc["rpn_ca_incoterms"] = implode(", ", $incoterms);
            }
            $referencia_sc["ca_count_ref"] = ($referencia_sc["mst_ca_referencia"] != $ref) ? 1 : 0; /* Columna para contar las referencias */
            $ref = $referencia_sc["mst_ca_referencia"];

            $referencia_sc = array_map('utf8_encode', $referencia_sc);
            $this->expor_data[] = $referencia_sc;

            $uid = $root;
            foreach ($filtros as $filtro) {
                $value = $referencia_sc[$filtro->alias];
                unset($referencia_sc[$filtro->alias]);
                $node_uid = $tree->findValue($uid, $value);
                if (!$node_uid) {
                    $nodo = $tree->createNode($value);
                    $tree->addChild($uid, $nodo);
                    $uid = $nodo;
                } else {
                    $uid = $node_uid;
                }
            }
            $nodo = $tree->getNode($uid);

            // Quita el primer elemento que no es filtro y lo usa para el campo text
            list($keys) = array_keys($referencia_sc);
            $referencia_sc["text"] = $referencia_sc[$keys];
            $referencia_sc["leaf"] = true;
            // $key generalmente va a ser tb.reporte.ca_consecutivo
            unset($referencia_sc[$keys]);
            $nodo->setAttribute("children", $referencia_sc);
        }

        $this->leftAxis = array();
        $this->topAxis = array();
        $this->aggregate = array();

        $valores_cols = array("Ingresos", "Costos", "Deducciones", "Ino", "Peso", "Volumen", "Teus");
        if (!count($this->topAxis)) {
            $this->topAxis[] = array("header" => utf8_encode("Año"), "dataIndex" => "mst_annio", "direction" => "DES");
        }
        foreach ($filtros as $filtro) {
            $this->expor_cols[] = array("title" => $filtro->titulo, "name" => $filtro->alias, "xtype" => in_array($filtro->titulo, $valores_cols) ? "numbercolumn" : "string");
            $this->leftAxis[] = array("header" => $filtro->titulo, "dataIndex" => $filtro->alias, "direction" => "ASD");
        }
        $this->expor_cols[] = array("title" => "Referencias", "name" => "ca_count_ref", "type" => "integer", "allowNull" => "true");
        $this->leftAxis[] = array("header" => "Referencia", "dataIndex" => "mst_ca_referencia", "direction" => "ASD");

        $this->aggregate[] = array("header" => "Referencias", "dataIndex" => "ca_count_ref", "aggregator" => "sum");
        $this->aggregate[] = array("header" => "Houses", "dataIndex" => "mst_ca_doctransporte", "aggregator" => "count");
        foreach ($this->columns as $key => $column) {
            if ($column["text"] != "Agrupamiento") {
                if (in_array($column["text"], $valores_cols)) {
                    $this->expor_cols[] = array("title" => $column["text"], "name" => $column["dataIndex"], "type" => "float", "allowNull" => "true");
                } else {
                    $this->expor_cols[] = array("title" => $column["text"], "name" => $column["dataIndex"], "type" => "string");
                }
            }
            if (in_array($column["text"], $valores_cols)) {
                $this->aggregate[] = array("header" => $column["text"], "dataIndex" => $column["dataIndex"], "aggregator" => "sum");
                $this->columns[$key]["xtype"] = "numbercolumn";
                $this->columns[$key]["align"] = "right";
            }
        }

        // Retira el campo key del cuerpo del informe
        $columns = array();
        foreach ($this->columns as $k => $v) {
            if ($v["dataIndex"] != $keys) {
                $columns[] = $v;
            }
        }
        // Lo hace con este ciclo para renumerar los id del arreglo
        $this->columns = $columns;
        $this->registros = $tree->getTreeNodes();
    }

    /**
     * Módulo Valifacion de Comisiones Ino Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteComisionesV2Ext5(sfWebRequest $request) {
        
    }

    public function executeReporteComisionesList(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $cliente = $request->getParameter("cliente");

        $anios = array();
        foreach ($datos->anio as $anio) {
            $anios[] = "'" . substr($anio, 2, 2) . "'";
        }

        $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster ";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner .= "inner join control.tb_usuarios u on h.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }

        if ($datos->fch_ini && $datos->fch_fin) {
            $fch_ini = substr($datos->fch_ini, 0, 10) . " 00:00:00";
            $fch_fin = substr($datos->fch_fin, 0, 10) . " 23:59:59";
            $sql = "select h.ca_idhouse from ino.tb_master m $inner where "
                    . "m.ca_fchcerrado between '" . $fch_ini . "' and '" . $fch_fin . "'";
        } else {
            $sql = "select h.ca_idhouse from ino.tb_master m $inner where "
                    . "substr(m.ca_referencia, 16, 2) in (" . implode(",", $anios) . ") ";

            if (!in_array("%", $datos->mes)) {
                $sql .= "and substr(m.ca_referencia, 8, 2) in ('" . implode("','", $datos->mes) . "') ";
            }
        }

        if ($datos->impoexpo) {
            /* Controla el listado de datos de COLOTM */
            if (!in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 1) <> '7' ";
            }
            if (!in_array(Constantes::OTMDTA, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 2) <> '49' ";
            }
            if (in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $datos->impoexpo[] = Constantes::OTMDTA;
            }
            $sql .= "and m.ca_impoexpo in ('" . utf8_decode(implode("','", $datos->impoexpo)) . "') ";
        }

        if ($datos->transporte) {
            $sql .= "and m.ca_transporte in ('" . utf8_decode(implode("','", $datos->transporte)) . "') ";
        }

        if ($datos->vendedor) {
            $sql .= "and h.ca_vendedor in ('" . implode("','", $datos->vendedor) . "') ";
        }

        if ($cliente) {
            $sql .= "and h.ca_idcliente in ('" . $cliente . "') ";
        }

        if (count($datos->estado) == 1) {
            if ($datos->estado[0] == "Abierto") {
                $sql .= "and m.ca_fchcerrado IS NULL ";
            } else if ($datos->estado[0] == "Cerrado") {
                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
            }
        }
        // die($sql);

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoHouse")
                    ->createQuery("hst")
                    ->innerJoin("hst.InoMaster mst")
                    ->whereIn("hst.ca_idhouse", $rs)
                    ->addWhere("mst.ca_fchanulado is null")
                    ->orderBy("mst.ca_referencia, hst.ca_doctransporte");
            $inoHouses = $q->execute();

            $data = array();
            foreach ($inoHouses as $inoHouse) {
                $referencia = explode(".", $inoHouse->getInoMaster()->getCaReferencia());
                $row = array();
                $row["idmaster"] = $inoHouse->getInoMaster()->getCaIdmaster();

                $row["anio"] = 2000 + $referencia[4];
                $row["mes"] = Utils::mesLargo($referencia[2]);
                $row["referencia"] = $inoHouse->getInoMaster()->getCaReferencia();
                $row["cliente"] = utf8_encode($inoHouse->getCliente()->getIds()->getCaNombre());
                $row["doctransporte"] = utf8_encode($inoHouse->getCaDoctransporte());

                $incoterms = array();
                $q = Doctrine_Manager::getInstance()->connection();
                if ($inoHouse->getCaIdreporte()) {
                    $sql = "select distinct left(ca_incoterms,3) from tb_repproveedores where ca_idreporte = " . $inoHouse->getCaIdreporte() . " order by 1";

                    $stmt1 = $q->execute($sql);
                    $incoterms = $stmt1->fetchAll(PDO::FETCH_COLUMN);
                }
                $row["incoterms"] = utf8_encode(implode(", ", $incoterms));

                $row["comercial"] = utf8_encode($inoHouse->getVendedor()->getCaLogin());
                $row["vendedor"] = utf8_encode($inoHouse->getVendedor()->getCaNombre());
                $row["sucursal"] = utf8_encode($inoHouse->getVendedor()->getSucursal()->getCaNombre());

                // La fecha de corte, debe corresponder a la primera factura del house, en su defecto la fecha actual
                $fch_corte = (!$inoHouse->getFechaPrimeraFactura())?date("Y-m-d"):$inoHouse->getFechaPrimeraFactura();
                
                $sql = "SELECT public.fun_circular_fecha(".$inoHouse->getCaIdcliente().", '$fch_corte')";
                $stmt1 = $q->execute($sql);
                $circular = $stmt1->fetchAll(PDO::FETCH_COLUMN);

                $row["circular0170"] = $circular[0];
                $sql = "select ca_estado, ca_fchestado from ids.tb_clientes_estados where ca_idcliente = " . $inoHouse->getCaIdcliente();
                if ($inoHouse->getInoMaster()->getCaTransporte() == Constantes::TERRESTRE and $inoHouse->getInoMaster()->getCaImpoexpo() == Constantes::OTMDTA) {
                    $datos_master = json_decode($inoHouse->getInoMaster()->getCaDatos());   // Evalua el Estado del Cliente para COLOTM dependiendo la empresa COLTRANS o COLOTM
                            $sql.= " and ca_idempresa = " . $datos_master->idempresa . " and ca_fchestado <= '" . $fch_corte ."'";
                } else {
                    $sql.= " and ca_idempresa = 2 and ca_fchestado <= '" . $fch_corte ."'";
                }
                $sql.= " order by ca_fchestado desc limit 1";
                $stmt1 = $q->execute($sql);
                $estado = $stmt1->fetchAll();
                $row["std_cliente_emp"] = $estado[0]["ca_estado"];       // Estado Cliente en Coltrans
                $row["std_cliente_fch"] = $estado[0]["ca_fchestado"];    // Fecha de Estado Cliente

                $row["std_cerrado"] = ($inoHouse->getInoMaster()->getCerrado()) ? "Cerrado" : "Abierto";
                $row["ino_valor"] = $inoHouse->getUtilidadPorHouse();
                if ($inoHouse->getInoMaster()->getCaTransporte() == Constantes::MARITIMO) {
                    $row["ino_valor"] += $inoHouse->getUtilidadPorSobreventa();
                }
                $row["ino_comision"] = round($row["ino_valor"] * 0.10, 0);
                $comision_pag = 0;
                $comision_pen = 0;
                $comprobantes = array();

                $q = Doctrine::getTable("InoComision")
                        ->createQuery("cmn")
                        ->addWhere("cmn.ca_idhouse = ?", $inoHouse->getCaIdhouse());
                $comisiones = $q->execute();
                if ($comisiones) {
                    foreach ($comisiones as $comision) {
                        if ($comision->getCaConsecutivo()) {
                            if (!in_array($comision->getCaConsecutivo(), $comprobantes))
                                $comprobantes[] = $comision->getCaConsecutivo();
                            $comision_pag += $comision->getCaComision();
                        } else {
                            $comision_pen += $comision->getCaComision();
                        }
                    }
                }
                $row["comprobantes"] = utf8_encode(implode(", ", $comprobantes));
                $row["comision_pag"] = $comision_pag;
                $row["comision_pen"] = $comision_pen;
                $row["diferencia"] = round($row["ino_valor"] * 0.10 - $comision_pag - $comision_pen, 0);

                $data[] = $row;
            }
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeReporteComisionesDets(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $idcliente = $request->getParameter("cliente");

        $inner = "inner join ino.tb_house h on c.ca_idhouse = h.ca_idhouse ";
        $inner.= "inner join ino.tb_master m on h.ca_idmaster = m.ca_idmaster ";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner .= "inner join control.tb_usuarios u on c.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }

        if ($datos->fch_ini && $datos->fch_fin) {
            $fch_ini = substr($datos->fch_ini, 0, 10) . " 00:00:00";
            $fch_fin = substr($datos->fch_fin, 0, 10) . " 23:59:59";
            $sql = "select c.ca_idcomision from ino.tb_comisiones c $inner where "
                    . "m.ca_fchcerrado between '" . $fch_ini . "' and '" . $fch_fin . "'";
        } else {
            $sql = "select c.ca_idcomision from ino.tb_comisiones c $inner where "
                    . "date_part('Year', c.ca_fchliquidado) in (" . implode(",", $datos->anio) . ") ";

            if (!in_array("%", $datos->mes)) {
                $sql .= "and substring(c.ca_fchliquidado::text from 6 for 2) in ('" . implode("','", $datos->mes) . "') ";
            }
        }

        if ($datos->impoexpo) {
            $sql .= "and m.ca_impoexpo in ('" . utf8_decode(implode("','", $datos->impoexpo)) . "') ";
        }

        if ($datos->transporte) {
            $sql .= "and m.ca_transporte in ('" . utf8_decode(implode("','", $datos->transporte)) . "') ";
        }

        if ($datos->vendedor) {
            $sql .= "and c.ca_vendedor in ('" . implode("','", $datos->vendedor) . "') ";
        }

        if ($cliente) {
            $sql .= "and h.ca_idcliente in ('" . $cliente . "') ";
        }

        if (count($datos->estado) == 1) {
            if ($datos->estado[0] == "Abierto") {
                $sql .= "and m.ca_fchcerrado IS NULL ";
            } else if ($datos->estado[0] == "Cerrado") {
                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
            }
        }
        // die($sql);

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoComision")
                    ->createQuery("cm")
                    ->whereIn("cm.ca_idcomision", $rs)
                    ->orderBy("cm.ca_consecutivo, cm.ca_idhouse, cm.ca_idutilidad");
            $comprobantes = $q->execute();
            
            $idhouse = null;
            $data = array();
            $tot_comision = 0;
            foreach ($comprobantes as $comprobante) {
                if ($idhouse != $comprobante->getCaIdhouse()) {
                    if ($idhouse != null) {
                        if ($row["ino_total"] < 0) {
                            $bgcolor = "row_pink"; // Color Rosado no se puede comisionar
                            $comentario = "Caso con Pérdida";
                        } else if ($row["ino_total"] > 0 && $tot_comision < 0) {
                            $bgcolor = "row_gray"; // Color Rosado no se puede comisionar
                            $comentario = "Caso con Ajuste Negativo";
                        } else {
                            $bgcolor = null;
                            $comentario = null;
                        }
                        $row["bgcolor"] = $bgcolor;
                        $row["comentario"] = utf8_encode($comentario);
                        $row["comision"] = $tot_comision;
                        $tot_comision = 0;
                        $data[] = $row;
                    }
                    $row = array();
                    $row["comprobante"] = $comprobante->getCaConsecutivo(). " [ Liquidado: " . $comprobante->getCaUsuliquidado(). " " . substr($comprobante->getCaFchliquidado(),0,10) . "]";
                    $row["consecutivo"] = $comprobante->getCaConsecutivo();
                    $row["cliente"] = utf8_encode($comprobante->getInoHouse()->getCliente()->getIds()->getCaNombre());
                    $row["comercial"] = $comprobante->getCaVendedor();
                    $row["vendedor"] = utf8_encode($comprobante->getVendedor()->getCaNombre());
                    $row["sucursal"] = utf8_encode($comprobante->getVendedor()->getSucursal()->getCaNombre());
                    $row["doctransporte"] = $comprobante->getInoHouse()->getCaDoctransporte();
                    $row["reporte_neg"] = $comprobante->getInoHouse()->getReporte()->getCaConsecutivo()?$comprobante->getInoHouse()->getReporte()->getCaConsecutivo():"";
                    $row["reporte_fch"] = $comprobante->getInoHouse()->getReporte()->getCaFchreporte();
                    $row["idmaster"] = $comprobante->getInoHouse()->getInoMaster()->getCaIdmaster();
                    $row["referencia"] = $comprobante->getInoHouse()->getInoMaster()->getCaReferencia();
                    $row["estado_ref"] = $comprobante->getInoHouse()->getInoMaster()->getCaFchcerrado()?"Cerrado":"Abierto";

                    $incoterms = array();
                    $q = Doctrine_Manager::getInstance()->connection();
                    if ($comprobante->getInoHouse()->getCaIdreporte()) {
                        $sql = "select distinct left(ca_incoterms,3) from tb_repproveedores where ca_idreporte = " . $comprobante->getInoHouse()->getCaIdreporte() . " order by 1";

                        $stmt1 = $q->execute($sql);
                        $incoterms = $stmt1->fetchAll(PDO::FETCH_COLUMN);
                    }
                    $row["incoterms"] = utf8_encode(implode(", ", $incoterms));

                    // La fecha de corte, debe corresponder a la primera factura del house, en su defecto la fecha actual
                    $fch_corte = (!$comprobante->getInoHouse()->getFechaPrimeraFactura())?date("Y-m-d"):$comprobante->getInoHouse()->getFechaPrimeraFactura();

                    $sql = "SELECT public.fun_circular_fecha(".$comprobante->getInoHouse()->getCaIdcliente().", '$fch_corte')";
                    $stmt1 = $q->execute($sql);
                    $circular = $stmt1->fetchAll(PDO::FETCH_COLUMN);

                    $row["circular0170"] = $circular[0];
                    $sql = "select ca_estado, ca_fchestado from ids.tb_clientes_estados where ca_idcliente = " . $comprobante->getInoHouse()->getCaIdcliente();
                    if ($comprobante->getInoHouse()->getInoMaster()->getCaTransporte() == Constantes::TERRESTRE and $comprobante->getInoHouse()->getInoMaster()->getCaImpoexpo() == Constantes::OTMDTA) {
                        $datos_master = json_decode($comprobante->getInoHouse()->getInoMaster()->getCaDatos());   // Evalua el Estado del Cliente para COLOTM dependiendo la empresa COLTRANS o COLOTM
                                $sql.= " and ca_idempresa = " . $datos_master->idempresa . " and ca_fchestado <= '" . $fch_corte ."'";
                    } else {
                        $sql.= " and ca_idempresa = 2 and ca_fchestado <= '" . $fch_corte ."'";
                    }
                    $sql.= " order by ca_fchestado desc limit 1";
                    $stmt1 = $q->execute($sql);
                    $estado = $stmt1->fetchAll();
                    $row["std_cliente_emp"] = $estado[0]["ca_estado"];       // Estado Cliente en Coltrans
                    $row["std_cliente_fch"] = $estado[0]["ca_fchestado"];    // Fecha de Estado Cliente
                    $row["std_cerrado"] = ($comprobante->getInoHouse()->getInoMaster()->getCerrado()) ? "Cerrado" : "Abierto";
                    
                    $facturas = $comprobante->getInoHouse()->getFacturasConPagosxHouse();
                    $crucescomp = null;
                    if (count($facturas["cru_docs"]) >= count($facturas["num_facs"])){
                        $comisionable = true;
                        $crucescomp = implode(", ", $facturas["cru_docs"]);
                    }
                    $row["ino_total"] = $comprobante->getInoHouse()->getUtilidadPorHouse();
                    $row["facturas"] = implode(", ", $facturas["num_facs"]);
                    $row["crucedocs"] = implode(", ", $facturas["cru_docs"]);
                    $row["fchcausado"] = $comprobante->getCaFchactualizado()?$comprobante->getCaFchactualizado():$comprobante->getCaFchcreado();
                    $row["fchliquidado"] = $comprobante->getCaFchliquidado();

                    $idhouse = $comprobante->getCaIdhouse();
                }
                $tot_comision+= $comprobante->getCaComision();
            }
            
            if ($row["ino_total"] < 0) {
                $bgcolor = "row_pink"; // Color Rosado no se puede comisionar
                $comentario = "Caso con Pérdida";
            } else if ($row["ino_total"] > 0 && $tot_comision < 0) {
                $bgcolor = "row_gray"; // Color Rosado no se puede comisionar
                $comentario = "Caso con Ajuste Negativo";
            }
            $row["bgcolor"] = $bgcolor;
            $row["comentario"] = utf8_encode($comentario);
            $row["comision"] = $tot_comision;
            $data[] = $row;
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }
    
    /**
     * Módulo Reporteador de Cargas Ino Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteCargaV2Ext5(sfWebRequest $request) {
        
    }

    public function executeReporteCargaListExt5(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $filtros = $request->getParameter("filtros");
        $filtros = json_decode($filtros);
        $columnas = $request->getParameter("columnas");
        $columnas = json_decode($columnas);
        $cliente = $request->getParameter("cliente");
        $agente = $request->getParameter("agente");
        $transportista = $request->getParameter("transportista");

        $anios = array();
        foreach ($datos->anio as $anio) {
            $anios[] = "'" . substr($anio, 2, 2) . "'";
        }

        $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster ";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner .= "inner join control.tb_usuarios u on h.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }

        $sql = "select h.ca_idhouse from ino.tb_master m $inner where "
                . "substr(m.ca_referencia, 16, 2) in (" . implode(",", $anios) . ") ";

        if ($datos->mes[0] != "%") {
            $sql .= "and substr(m.ca_referencia, 8, 2) in ('" . implode("','", $datos->mes) . "') ";
        }

        if ($datos->impoexpo) {
            /* Controla el listado de datos de COLOTM */
            if (!in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 1) <> '7' ";
            }
            if (!in_array(Constantes::OTMDTA, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 2) <> '49' ";
            }
            if (in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $datos->impoexpo[] = Constantes::OTMDTA;
            }
            $sql .= "and m.ca_impoexpo in ('" . utf8_decode(implode("','", $datos->impoexpo)) . "') ";
        }

        if ($datos->transporte) {
            $sql .= "and m.ca_transporte in ('" . utf8_decode(implode("','", $datos->transporte)) . "') ";
        }

        if ($cliente) {
            $sql .= "and h.ca_idcliente in ('" . $cliente . "') ";
        }
        
        if ($agente) {
            $sql .= "and m.ca_idagente in ('" . $agente . "') ";
        }

        if ($transportista) {
            $sql .= "and m.ca_idlinea in ('" . $transportista . "') ";
        }

        if (count($datos->estado) == 1) {
            if ($datos->estado[0] == "Abierto") {
                $sql .= "and m.ca_fchcerrado IS NULL ";
            } else if ($datos->estado[0] == "Cerrado") {
                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
            }
        }
        // die($sql);

        $data = array();
        $fields = array();
        $leftAxis = array();
        $topAxis = array();
        $aggregate = array();

        $topAxis[] = array("header" => "Transporte", "dataIndex" => "mst_ca_transporte", "direction" => "ASC");
        $topAxis[] = array("header" => "Estado", "dataIndex" => "mst_ca_estado", "direction" => "ASC");

        foreach ($columnas as $columna) {
            $fields[] = array("title" => $columna->text, "name" => $columna->alias, "type" => $columna->type);
            if (in_array($columna->alias, array_column($topAxis, 'dataIndex'))) {   // Previene que una columna de TopAxis (Agrupamiento por defecto) se incluya en LeftAxis
                continue;
            }
            $modalidad = false;
            foreach ($filtros as $filtro) {
                if ($columna->alias == $filtro->alias) {
                    $modalidad = ($columna->alias == "mst_ca_modalidad")?true:$modalidad;
                    $leftAxis[] = array("header" => $columna->text, "dataIndex" => $columna->alias, "direction" => "ASD");
                }
            }
        }
        if (!$modalidad) {
            $leftAxis[] = array("header" => "Modalidad", "dataIndex" => "mst_ca_modalidad", "direction" => "ASD");
        }
        $fields[] = array("title" => "Piezas", "name" => "hst_ca_piezas", "type" => "integer");
        $fields[] = array("title" => "Peso", "name" => "hst_ca_peso", "type" => "float");
        $fields[] = array("title" => "Volumen", "name" => "hst_ca_volumen", "type" => "float");
        $fields[] = array("title" => "IdHouse", "name" => "hst_ca_idhouse", "type" => "integer");
        $fields[] = array("title" => "IdMaster", "name" => "mst_ca_idmaster", "type" => "integer");
        
        $aggregate[] = array("header" => "Piezas", "dataIndex" => "hst_ca_piezas", "aggregator" => "sum");
        $aggregate[] = array("header" => "Peso", "dataIndex" => "hst_ca_peso", "aggregator" => "sum");
        $aggregate[] = array("header" => "Volumen", "dataIndex" => "hst_ca_volumen", "aggregator" => "sum");
        
        $only_air = (count($datos->transporte) == 1 && utf8_decode($datos->transporte[0]) == Constantes::AEREO)?true:false;
        if (!$only_air) {
            $fields[] = array("title" => "20'", "name" => "hst_ca_20", "type" => "float");
            $fields[] = array("title" => "40'", "name" => "hst_ca_40", "type" => "float");
            $fields[] = array("title" => "Teus", "name" => "hst_ca_teus", "type" => "float");
        
            $aggregate[] = array("header" => "20'", "dataIndex" => "hst_ca_20", "aggregator" => "sum");
            $aggregate[] = array("header" => "40'", "dataIndex" => "hst_ca_40", "aggregator" => "sum");
            $aggregate[] = array("header" => "Teus", "dataIndex" => "hst_ca_teus", "aggregator" => "sum");
        }
        
        $data['fields'] = $fields;
        $data['topAxis'] = $topAxis;
        $data['leftAxis'] = $leftAxis;
        $data['aggregate'] = $aggregate;

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoHouse")
                    ->createQuery("hst")
                    ->innerJoin("hst.InoMaster mst")
                    ->whereIn("hst.ca_idhouse", $rs)
                    ->addWhere("mst.ca_fchanulado is null")
                    ->orderBy("mst.ca_referencia, hst.ca_doctransporte");
            $inoHouses = $q->execute();

            foreach ($inoHouses as $inoHouse) {
                $row = array();
                $referencia = explode(".", $inoHouse->getInoMaster()->getCaReferencia());
                $row['mst_annio'] = 2000+$referencia[4];
                $row['mst_mes'] = Utils::mesLargo($referencia[2]);
                $row['mst_ca_impoexpo'] = utf8_encode($inoHouse->getInoMaster()->getCaImpoexpo());
                $row['mst_ca_modalidad'] = utf8_encode($inoHouse->getInoMaster()->getCaModalidad());
                $row['mst_ca_transporte'] = utf8_encode($inoHouse->getInoMaster()->getCaTransporte());
                $row['mst_ca_estado'] = ($inoHouse->getInoMaster()->getCaFchcerrado())?"Cerrado":"Abierto";
                $row['hst_ca_idhouse'] = $inoHouse->getCaIdhouse();
                $row['mst_ca_idmaster'] = $inoHouse->getCaIdmaster();
                $row['trg_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getOrigen()->getTrafico()->getCaNombre());
                $row['suc_ca_nombre'] = utf8_encode($inoHouse->getVendedor()->getSucursal()->getCaNombre());
                $row['cli_ca_compania'] = utf8_encode($inoHouse->getCliente()->getIds()->getCaNombre());
                $row['agt_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getIdsAgente()->getIds()->getCaNombre());
                $row['prv_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getIdsProveedor()->getIds()->getCaNombre());
                $row['hst_ca_piezas'] = utf8_encode($inoHouse->getCaNumpiezas());
                $row['hst_ca_peso'] = utf8_encode($inoHouse->getCaPeso());
                $row['hst_ca_volumen'] = utf8_encode($inoHouse->getCaVolumen());
                if (!$only_air) {
                    $row['hst_ca_20'] = utf8_encode($inoHouse->get20PorHouse());
                    $row['hst_ca_40'] = utf8_encode($inoHouse->get40PorHouse());
                    $row['hst_ca_teus'] = utf8_encode($inoHouse->getTeusPorHouse());
                }
                $data['datos'][] = $row;
            }
            $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }


    /**
     * Módulo Reporteador de Concentos de Venta y Costos Ino Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteConceptosV2Ext5(sfWebRequest $request) {
        
    }

    public function executeReporteConceptosListExt5(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $filtros = $request->getParameter("filtros");
        $filtros = json_decode($filtros);
        $columnas = $request->getParameter("columnas");
        $columnas = json_decode($columnas);
        $cliente = $request->getParameter("cliente");
        $agente = $request->getParameter("agente");
        $transportista = $request->getParameter("transportista");

        $anios = array();
        foreach ($datos->anio as $anio) {
            $anios[] = "'" . substr($anio, 2, 2) . "'";
        }

        $inner = "inner join ino.tb_house h on m.ca_idmaster = h.ca_idmaster ";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner .= "inner join control.tb_usuarios u on h.ca_vendedor = u.ca_login "
                    . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal "
                    . "     and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }

        $sql = "select h.ca_idhouse from ino.tb_master m $inner where "
                . "substr(m.ca_referencia, 16, 2) in (" . implode(",", $anios) . ") ";

        if ($datos->mes[0] != "%") {
            $sql .= "and substr(m.ca_referencia, 8, 2) in ('" . implode("','", $datos->mes) . "') ";
        }

        if ($datos->impoexpo) {
            /* Controla el listado de datos de COLOTM */
            if (!in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 1) <> '7' ";
            }
            if (!in_array(Constantes::OTMDTA, $datos->impoexpo)) {
                $sql .= "and left(m.ca_referencia, 2) <> '49' ";
            }
            if (in_array(Constantes::COLOTM, $datos->impoexpo)) {
                $datos->impoexpo[] = Constantes::OTMDTA;
            }
            $sql .= "and m.ca_impoexpo in ('" . utf8_decode(implode("','", $datos->impoexpo)) . "') ";
        }

        if ($datos->transporte) {
            $sql .= "and m.ca_transporte in ('" . utf8_decode(implode("','", $datos->transporte)) . "') ";
        }

        if ($cliente) {
            $sql .= "and h.ca_idcliente in ('" . $cliente . "') ";
        }
        
        if ($agente) {
            $sql .= "and m.ca_idagente in ('" . $agente . "') ";
        }

        if ($transportista) {
            $sql .= "and m.ca_idlinea in ('" . $transportista . "') ";
        }

        if (count($datos->estado) == 1) {
            if ($datos->estado[0] == "Abierto") {
                $sql .= "and m.ca_fchcerrado IS NULL ";
            } else if ($datos->estado[0] == "Cerrado") {
                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
            }
        }
        // die($sql);

        $data = array();
        $fields = array();
        $leftAxis = array();
        $topAxis = array();
        $aggregate = array();

        $topAxis[] = array("header" => "Transporte", "dataIndex" => "mst_ca_transporte", "direction" => "ASC");
        $topAxis[] = array("header" => "Estado", "dataIndex" => "mst_ca_estado", "direction" => "ASC");
        
        $leftAxis[] = array("header" => "Concepto", "dataIndex" => "cst_ca_concepto", "direction" => "ASD");

        foreach ($columnas as $columna) {
            $fields[] = array("title" => $columna->text, "name" => $columna->alias, "type" => $columna->type);
            if (in_array($columna->alias, array_column($topAxis, 'dataIndex'))) {   // Previene que una columna de TopAxis (Agrupamiento por defecto) se incluya en LeftAxis
                continue;
            }
            foreach ($filtros as $filtro) {
                if ($columna->alias == $filtro->alias) {
                    $leftAxis[] = array("header" => $columna->text, "dataIndex" => $columna->alias, "direction" => "ASD");
                }
            }
        }
        $fields[] = array("title" => "Concepto", "name" => "cst_ca_concepto", "type" => "string");
        $fields[] = array("title" => "Compra", "name" => "hst_ca_compra", "type" => "integer");
        $fields[] = array("title" => "Venta", "name" => "hst_ca_venta", "type" => "integer");
        $fields[] = array("title" => "Rentabilidad", "name" => "hst_ca_rentabilidad", "type" => "integer");
        
        $aggregate[] = array("header" => "Compra", "dataIndex" => "hst_ca_compra", "aggregator" => "sum");
        $aggregate[] = array("header" => "Venta", "dataIndex" => "hst_ca_venta", "aggregator" => "sum");
        $aggregate[] = array("header" => "Rentabilidad", "dataIndex" => "hst_ca_rentabilidad", "aggregator" => "sum");
        
        $data['fields'] = $fields;
        $data['topAxis'] = $topAxis;
        $data['leftAxis'] = $leftAxis;
        $data['aggregate'] = $aggregate;

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $rs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($rs) > 0) {
            $q = Doctrine::getTable("InoHouse")
                    ->createQuery("hst")
                    ->innerJoin("hst.InoMaster mst")
                    ->whereIn("hst.ca_idhouse", $rs)
                    ->addWhere("mst.ca_fchanulado is null")
                    ->orderBy("mst.ca_referencia, hst.ca_doctransporte");
            $inoHouses = $q->execute();

            $idmaster = null;
            foreach ($inoHouses as $inoHouse) {
                if ($inoHouse->getCaIdmaster() != $idmaster) {
                    $idmaster = $inoHouse->getCaIdmaster();
                    $q = Doctrine::getTable("InoCosto")
                            ->createQuery("cst")
                            ->addWhere("cst.ca_idmaster = ?", $idmaster)
                            ->addWhere("cst.ca_fchanulado is null")
                            ->whereIn("cst.ca_idcosto", $datos->concepto)
                            ->orderBy("cst.ca_idcosto");
                    $costos = $q->execute();
                }
                foreach ($datos->concepto as $concepto) {
                    foreach ($costos as $costo) {
                        if ($costo->getCaIdcosto() != $concepto && $costo->getCaIdhouse() != 0 && $costo->getCaIdhouse() != $inoHouse->getCaIdhouse()) {
                            continue;
                        }
                        $inoConcepto = "";
                        if ($costo->getInoConcepto()) {
                            $inoConcepto = utf8_encode($costo->getInoConcepto()->getCaConceptoEsp());
                        }
                        $row = array();
                        $referencia = explode(".", $inoHouse->getInoMaster()->getCaReferencia());
                        $row['mst_annio'] = 2000+$referencia[4];
                        $row['mst_mes'] = Utils::mesLargo($referencia[2]);
                        $row['mst_ca_impoexpo'] = utf8_encode($inoHouse->getInoMaster()->getCaImpoexpo());
                        $row['mst_ca_modalidad'] = utf8_encode($inoHouse->getInoMaster()->getCaModalidad());
                        $row['mst_ca_transporte'] = utf8_encode($inoHouse->getInoMaster()->getCaTransporte());
                        $row['mst_ca_estado'] = ($inoHouse->getInoMaster()->getCaFchcerrado())?"Cerrado":"Abierto";
                        $row['hst_ca_idhouse'] = $inoHouse->getCaIdhouse();
                        $row['mst_ca_idmaster'] = $inoHouse->getCaIdmaster();
                        $row['trg_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getOrigen()->getTrafico()->getCaNombre());
                        $row['suc_ca_nombre'] = utf8_encode($inoHouse->getVendedor()->getSucursal()->getCaNombre());
                        $row['cli_ca_compania'] = utf8_encode($inoHouse->getCliente()->getIds()->getCaNombre());
                        $row['agt_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getIdsAgente()->getIds()->getCaNombre());
                        $row['prv_ca_nombre'] = utf8_encode($inoHouse->getInoMaster()->getIdsProveedor()->getIds()->getCaNombre());
                        $row['cst_ca_concepto'] = $inoConcepto;
                        if ($costo->getCaIdhouse() == 0) {
                            if ($inoHouse->getInoMaster()->getCaTransporte() == Constantes::AEREO) {
                                $factor = $inoHouse->getCaPeso() / $inoHouse->getInoMaster()->getCargaTotal();
                            } else {
                                $factor = $inoHouse->getCaVolumen() / $inoHouse->getInoMaster()->getCargaTotal();
                            }
                            $compra_pro = round($costo->getCaNeto() * $costo->getCaTcambio() / $costo->getCaTcambioUsd() * $factor, 2);
                            $venta_pro  = round($costo->getCaVenta() * $factor, 2);
                            $row['hst_ca_compra'] = $compra_pro;
                            $row['hst_ca_venta'] = $venta_pro;
                        } else {
                            $row['hst_ca_compra'] = $costo->getCaNeto() * $costo->getCaTcambio() / $costo->getCaTcambioUsd();
                            $row['hst_ca_venta'] = $costo->getCaVenta();
                        }
                        $row['hst_ca_rentabilidad'] = $row['hst_ca_venta'] - $row['hst_ca_compra'];
                        $data['datos'][] = $row;
                    }
                }
            }
            $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo Reporteador de Carga Operativa Versión 2
     *
     * @param sfRequest $request A request object
     */
    public function executeReporteColaboradorV2Ext5(sfWebRequest $request) {
        
    }

    public function executeReporteColaboradorList(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $cliente = $request->getParameter("cliente");

        $inner = "";
        if ($datos->sucursal[0] != "Sucursales (Todas)") {
            $inner .= "and s.ca_nombre in ('" . utf8_decode(implode("','", $datos->sucursal)) . "')";
        }

        $sql = "select u.ca_login, u.ca_nombre, u.ca_departamento, s.ca_nombre as ca_sucursal from control.tb_usuarios u "
                . "inner join control.tb_sucursales s on u.ca_idsucursal = s.ca_idsucursal $inner "
                . "where trim(translate(u.ca_departamento, '.', '')) in ('" . utf8_decode(implode("','", $datos->departamento)) . "') ";

        if ($datos->colaborador) {
            $sql .= "and u.ca_login in ('" . implode("','", $datos->colaborador) . "') ";
        }
        $sql .= "and u.ca_activo = true";

//        if ($datos->impoexpo) {
//            /* Controla el listado de datos de COLOTM */
//            if (!in_array(Constantes::COLOTM, $datos->impoexpo)) {
//                $sql .= "and left(m.ca_referencia, 1) <> '7' ";
//            }
//            if (!in_array(Constantes::OTMDTA, $datos->impoexpo)) {
//                $sql .= "and left(m.ca_referencia, 2) <> '49' ";
//            }
//            if (in_array(Constantes::COLOTM, $datos->impoexpo)) {
//                $datos->impoexpo[] = Constantes::OTMDTA;
//            }
//            $sql .= "and m.ca_impoexpo in ('" . utf8_decode(implode("','", $datos->impoexpo)) . "') ";
//        }
//
//        if ($datos->transporte) {
//            $sql .= "and m.ca_transporte in ('" . utf8_decode(implode("','", $datos->transporte)) . "') ";
//        }
//
//        if ($cliente) {
//            $sql .= "and h.ca_idcliente in ('" . $cliente . "') ";
//        }
//
//        if (count($datos->estado) == 1) {
//            if ($datos->estado[0] == "Abierto") {
//                $sql .= "and m.ca_fchcerrado IS NULL ";
//            } else if ($datos->estado[0] == "Cerrado") {
//                $sql .= "and m.ca_fchcerrado IS NOT NULL ";
//            }
//        }
        // die($sql);

        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $usuarios = $stmt->fetchAll();

        $data = array();
        $select = array();
        $fields = array();
        $leftAxis = array();
        $topAxis = array();
        $aggregate = array();
        foreach ($datos->anio as $anio) {
            if ($datos->mes[0] == "%") {
                $meses = array();
                for($i=1; $i<13; $i++) {
                    $meses[] = str_pad($i, 2, "0", STR_PAD_RIGHT);
                }
            } else {
                $meses = $datos->mes;
            }
            foreach ($meses as $mes) {
                foreach ($usuarios as $usuario) {
                    $row = array();
                    $row["ca_anio"] = $anio;
                    $row["ca_mes"]  = $mes;
                    $row["ca_login"] = $usuario["ca_login"];
                    $row["ca_nombre"] = $usuario["ca_nombre"];
                    $row["ca_departamento"] = $usuario["ca_departamento"];
                    $row["ca_sucursal"] = $usuario["ca_sucursal"];
                    
                    /* Conteo de Cotizaciones */
                    $sql = "select ca_usuario as ca_vendedor_cot, count(distinct ca_consecutivo) as ca_consecutivo_cot, count(ca_version) as ca_version_cot from tb_cotizaciones "
                            . "where ca_usucreado = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchcreado) = " . $anio . " "
                            . "and substr(ca_fchcreado::text, 6, 2) = '" . $mes . "' "
                            . "group by ca_usuario";

                    $stmt = $q->execute($sql);
                    $cotizaciones = $stmt->fetchAll();
                    $row["ca_cotizaciones"] = $cotizaciones;
                    
                    
                    /* Conteo de Reportes de Negocio */
                    $sql = "select ca_login as ca_vendedor_rep, count(distinct ca_consecutivo) as ca_consecutivo_rep, count(ca_version) as ca_version_rep from tb_reportes "
                            . "where ca_usucreado = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchcreado) = " . $anio . " "
                            . "and substr(ca_fchcreado::text, 6, 2) = '" . $mes . "' "
                            . "group by ca_login";

                    $stmt = $q->execute($sql);
                    $reportes = $stmt->fetchAll();
                    $row["ca_reportes"] = $reportes;
                    
                    
                    /* Conteo de Antecedentes Reporte de Negocios */
                    $sql = "select count(ca_idantecedente) as ca_antecedentes_rpn from public.tb_repantecedentes "
                            . "where ca_usucreado = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchcreado) = " . $anio . " "
                            . "and substr(ca_fchcreado::text, 6, 2) = '" . $mes . "'";

                    $stmt = $q->execute($sql);
                    $status = $stmt->fetch();
                    $row["ca_antecedentes_rpn"] = $status["ca_antecedentes_rpn"];
                    
                    
                    /* Conteo de Antecedentes Operativos */
                    $sql = "select count(ca_idmaster) as ca_antecedentes_ino from ino.tb_master "
                            . "where ca_usucreado = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchcreado) = " . $anio . " "
                            . "and substr(ca_fchcreado::text, 6, 2) = '" . $mes . "'";

                    $stmt = $q->execute($sql);
                    $status = $stmt->fetch();
                    $row["ca_antecedentes_ino"] = $status["ca_antecedentes_ino"];
                    
                    
                    /* Conteo de Envio de Status */
                    $sql = "select count(ca_idstatus) as ca_status from public.tb_repstatus "
                            . "where ca_usuenvio = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchenvio) = " . $anio . " "
                            . "and substr(ca_fchenvio::text, 6, 2) = '" . $mes . "'";

                    $stmt = $q->execute($sql);
                    $status = $stmt->fetch();
                    $row["ca_status_num"] = $status["ca_status"];
                    
                    
                    /* Conteo de Facturacion */
                    $sql = "select count(ca_idcomprobante) as ca_idcomprobante from ino.tb_comprobantes "
                            . "where ca_usucreado = '" . $usuario["ca_login"] . "' and date_part('year', ca_fchcreado) = " . $anio . " "
                            . "and substr(ca_fchcreado::text, 6, 2) = '" . $mes . "'";

                    $stmt = $q->execute($sql);
                    $comprobantes = $stmt->fetch();
                    $row["ca_comprobantes_num"] = $comprobantes["ca_idcomprobante"];

                    $select[] = $row;
                }
            }
        }
        
        $datos = array();           /* Esta rutina iguala con nulos, los arreglos de Cotizaciones y Reportes */
        foreach ($select as $key => $record) {
            if (count($record["ca_cotizaciones"]) > count($record["ca_reportes"])) {
                $nulos = array_fill(0, count($record["ca_cotizaciones"])-count($record["ca_reportes"]), array("ca_vendedor_rep" => null, 0 => null, "ca_consecutivo_rep" => null, 1 => null, "ca_version_rep" => null, 2 => null));
                $select[$key]["ca_reportes"] = array_merge($record["ca_reportes"], $nulos);
            } else if (count($record["ca_reportes"]) > count($record["ca_cotizaciones"])) {
                $nulos = array_fill(0, count($record["ca_reportes"])-count($record["ca_cotizaciones"]), array("ca_vendedor_cot" => null, 0 => null, "ca_consecutivo_cot" => null, 1 => null, "ca_version_cot" => null, 2 => null));
                $select[$key]["ca_cotizaciones"] = array_merge($record["ca_cotizaciones"], $nulos);
            }
            foreach ($select[$key]["ca_cotizaciones"] as $sub => $value) {
                $record = $select[$key];
                $temp = $datos[] = array_merge(
                            array("ca_anio" => $record["ca_anio"], "ca_mes" => Utils::mesLargo($record["ca_mes"]), "ca_login" => $record["ca_login"], "ca_nombre" => utf8_encode($record["ca_nombre"]), "ca_departamento" => utf8_encode($record["ca_departamento"]), "ca_sucursal" => utf8_encode($record["ca_sucursal"]),  "ca_antecedentes_rpn" => $record["ca_antecedentes_rpn"],  "ca_antecedentes_ino" => $record["ca_antecedentes_ino"], "ca_status_num" => $record["ca_status_num"], "ca_comprobantes_num" => $record["ca_comprobantes_num"]),
                            array("ca_vendedor_cot" => $value["ca_vendedor_cot"], "ca_consecutivo_cot" => $value["ca_consecutivo_cot"], "ca_version_cot" => $value["ca_version_cot"], "ca_vendedor_cot" => $value["ca_vendedor_cot"], "ca_consecutivo_cot" => $value["ca_consecutivo_cot"], "ca_version_cot" => $value["ca_version_cot"]),
                            array("ca_vendedor_rep" => $record["ca_reportes"][$key]["ca_vendedor_rep"], "ca_consecutivo_rep" => $record["ca_reportes"][$key]["ca_consecutivo_rep"], "ca_version_rep" => $record["ca_reportes"][$key]["ca_version_rep"], "ca_vendedor_rep" => $record["ca_reportes"][$key]["ca_vendedor_rep"], "ca_consecutivo_rep" => $record["ca_reportes"][$key]["ca_consecutivo_rep"], "ca_version_rep" => $record["ca_reportes"][$key]["ca_version_rep"])
                        );
            }
        }
        
        $fields[] = array("title" => utf8_encode("Año"), "name" => "ca_anio", "type" => "string");
        $fields[] = array("title" => "Mes", "name" => "ca_mes", "type" => "string");
        $fields[] = array("title" => "Sucursal", "name" => "ca_sucursal", "type" => "string");
        $fields[] = array("title" => "Departamento", "name" => "ca_departamento", "type" => "string");
        $fields[] = array("title" => "Colaborador", "name" => "ca_nombre", "type" => "string");
        $fields[] = array("title" => "Vendedor Cot.", "name" => "ca_vendedor_cot", "type" => "string");
        $fields[] = array("title" => "Cotizaciones", "name" => "ca_consecutivo_cot", "type" => "integer");
        $fields[] = array("title" => "Versiones Cot.", "name" => "ca_version_cot", "type" => "integer");
        $fields[] = array("title" => "Vendedor Rep.", "name" => "ca_vendedor_rep", "type" => "string");
        $fields[] = array("title" => "Reportes Neg.", "name" => "ca_consecutivo_rep", "type" => "integer");
        $fields[] = array("title" => "Versiones Rep.", "name" => "ca_version_rep", "type" => "integer");
        $fields[] = array("title" => "Antecedentes Rep.", "name" => "ca_antecedentes_rpn", "type" => "integer");
        $fields[] = array("title" => "Antecedentes Ino", "name" => "ca_antecedentes_ino", "type" => "integer");
        $fields[] = array("title" => "Comunicaciones", "name" => "ca_status_num", "type" => "integer");
        $fields[] = array("title" => "Comprobantes", "name" => "ca_comprobantes_num", "type" => "integer");
        
        $aggregate[] = array("header" => "Cotizaciones", "dataIndex" => "ca_consecutivo_cot", "aggregator" => "sum");
        $aggregate[] = array("header" => "Versiones Cot.", "dataIndex" => "ca_version_cot", "aggregator" => "sum");
        $aggregate[] = array("header" => "Reportes Neg.", "dataIndex" => "ca_consecutivo_rep", "aggregator" => "sum");
        $aggregate[] = array("header" => "Versiones Rep.", "dataIndex" => "ca_version_rep", "aggregator" => "sum");
        $aggregate[] = array("header" => "Notificacion Rep.", "dataIndex" => "ca_antecedentes_rpn", "aggregator" => "sum");
        $aggregate[] = array("header" => "Antecedentes Ino", "dataIndex" => "ca_antecedentes_ino", "aggregator" => "sum");
        $aggregate[] = array("header" => "Comunicaciones", "dataIndex" => "ca_status_num", "aggregator" => "sum");
        $aggregate[] = array("header" => "Comprobantes", "dataIndex" => "ca_comprobantes_num", "aggregator" => "sum");

        $topAxis[] = array("header" => utf8_encode("Año"), "dataIndex" => "ca_anio", "direction" => "ASC");
        $topAxis[] = array("header" => "Mes", "dataIndex" => "ca_mes", "direction" => "ASC");
        
        $leftAxis[] = array("header" => "Sucursal", "dataIndex" => "ca_sucursal", "direction" => "ASD");
        $leftAxis[] = array("header" => "Departamento", "dataIndex" => "ca_departamento", "direction" => "ASD");
        $leftAxis[] = array("header" => "Colaborador", "dataIndex" => "ca_nombre", "direction" => "ASD");
        
        $data['datos'] = $datos;
        $data['fields'] = $fields;
        $data['topAxis'] = $topAxis;
        $data['leftAxis'] = $leftAxis;
        $data['aggregate'] = $aggregate;
        
        if (count($datos)) {
            $this->responseArray = array("success" => true, "data" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => false, "errorInfo" => "Consulta sin Resultados");
        }
        $this->setTemplate("responseTemplate");
    }

    /**
     * Módulo para listar Carga de Trabajo de Operativos
     *
     * @param sfRequest $request A request object
     */
    public function executeCargaOperativa(sfWebRequest $request) {
        Doctrine_Manager::getInstance()->setCurrentConnection('replica');
        $con = Doctrine_Manager::getInstance()->connection();

        /* 'Envío de cotización', */
        $sql = "select e.* from public.tb_emails e
                inner join control.tb_usuarios u on e.ca_usuenvio = u.ca_login and u.ca_idsucursal in ('BOG','PER')
                    where e.ca_fchcreado between '2018-10-01' and '2018-10-31' and e.ca_tipo in
                    (
                    'Rep.MarítimoExterior',
                    'Envío de cuadro',
                    'Envío de Status',
                    'Envío de reportes',
                    'Rep.AéreoExterior',
                    'Reporte Negocios AG',
                    'EnvioRNPrincipal',
                    'RNIncompleto',
                    'Respuesta a Status'
                    )
                    order by ca_tipo";

        echo "<table border='1'>";
        echo "<tr>";
        echo "  <td>TIPO</td>";
        echo "  <td>FECHA ENVIO</td>";
        echo "  <td>HORA ENVIO</td>";
        echo "  <td>USUARIO</td>";
        echo "  <td>NOMBRE</td>";
        echo "  <td>ASUNTO</td>";
        echo "  <td>CLIENTE</td>";
        echo "  <td>VENDEDOR</td>";
        echo "  <td>NOMBRE</td>";
        echo "</tr>";
        $rs = $con->execute($sql);
        $correos = $rs->fetchAll();
        foreach ($correos as $correo) {
            $usuario = Doctrine::getTable("Usuario")->find($correo["ca_usuenvio"]);
            if ($correo["ca_tipo"] == "Envío de cotización") {
                $sql = "select id.ca_nombre, ct.ca_usuario, us.ca_nombre as ca_vendedor from tb_cotizaciones ct "
                        . "inner join tb_concliente cn on cn.ca_idcontacto = ct.ca_idcontacto "
                        . "inner join ids.tb_ids id on id.ca_id = cn.ca_idcliente "
                        . "inner join control.tb_usuarios us on us.ca_login = ct.ca_usuario "
                        . "where ca_idcotizacion = " . $correo["ca_idcaso"];
                $rs = $con->execute($sql);
                $cotizacion = $rs->fetchAll();

                $cliente = $cotizacion[0]['ca_nombre'];
                $login = $cotizacion[0]['ca_usuario'];
                $vendedor = $cotizacion[0]['ca_vendedor'];
            } else if ($correo["ca_tipo"] == "Rep.MarítimoExterior" || $correo["ca_tipo"] == "Envío de cuadro" || $correo["ca_tipo"] == "Envío de Status" || $correo["ca_tipo"] == "Envío de reportes" || $correo["ca_tipo"] == "Reporte Negocios AG" || $correo["ca_tipo"] == "EnvioRNPrincipal" || $correo["ca_tipo"] == "RNIncompleto" || $correo["ca_tipo"] == "Respuesta a Status") {
                if ($correo["ca_idcaso"]) {
                    $sql = "select id.ca_nombre, rp.ca_login, us.ca_nombre as ca_vendedor from tb_reportes rp "
                            . "inner join tb_concliente cn on cn.ca_idcontacto = rp.ca_idconcliente "
                            . "inner join ids.tb_ids id on id.ca_id = cn.ca_idcliente "
                            . "inner join control.tb_usuarios us on us.ca_login = rp.ca_login "
                            . "where ca_idreporte = " . $correo["ca_idcaso"];
                    $rs = $con->execute($sql);
                    $reporte = $rs->fetchAll();

                    $cliente = $reporte[0]['ca_nombre'];
                    $login = $reporte[0]['ca_usuario'];
                    $vendedor = $reporte[0]['ca_vendedor'];
                }
            } else if (false) {
                print_r($correo);
            }
            echo "<tr>";
            echo "  <td>" . $correo["ca_tipo"] . "</td>";
            echo "  <td>" . substr($correo["ca_fchenvio"], 0, 10) . "</td>";
            echo "  <td>" . substr($correo["ca_fchenvio"], 10, 8) . "</td>";
            echo "  <td>" . $correo["ca_usuenvio"] . "</td>";
            echo "  <td>" . $usuario->getCaNombre() . "</td>";
            echo "  <td>" . $correo["ca_subject"] . "</td>";
            echo "  <td>" . $cliente . "</td>";
            echo "  <td>" . $login . "</td>";
            echo "  <td>" . $vendedor . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        die("Fin");
    }

}

?>
