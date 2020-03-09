<?php

/**
 * idgsistemas actions.
 *
 * @package    symfony
 * @subpackage idgsistemas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class idgsistemasActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
    }

    /*
     * Informe Promedio de Tickets total
     *
     */

    public function executeInformePromedioTicketsForm(sfWebRequest $request) {
        
    }

    public function executeInformePromedioTickets(sfWebRequest $request) {

        $fchinicio = $request->getParameter("fchinicio");
        $fchfin = $request->getParameter("fchfin");
        $iddepartamento = $request->getParameter("departamento");
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");


        $q = Doctrine_Query::create()
                ->select("c.ca_idcriterio,c.ca_criterio, us.ca_login, us.ca_nombre, AVG(ca_valor) as promedio, COUNT(*) as numeval")
                ->from("SurvCriterio c")
                ->innerJoin("c.SurvEvaluacionxCriterio exc")
                ->innerJoin("exc.SurvEvaluacion ev")
                ->innerJoin("ev.HdeskTicket t")
                ->innerJoin("t.HdeskGroup g")
                ->innerJoin("t.AssignedTo us")
                ->addGroupBy("c.ca_criterio")
                ->addGroupBy("us.ca_login")
                ->addGroupBy("us.ca_nombre")
                ->addGroupBy("c.ca_idcriterio")
                ->addOrderBy("us.ca_nombre")
                ->addOrderBy("c.ca_criterio");
        if ($iddepartamento) {
            $q->addWhere("g.ca_iddepartament=?", $iddepartamento);
            if ($idgroup) {
                $q->addWhere("t.ca_idgroup=?", $idgroup);
                if ($login) {
                    $q->addWhere("t.ca_assignedto=?", $login);
                }
            }
        }

        if ($fchinicio) {
            $q->addWhere("ev.ca_fchcreado>=?", $fchinicio);
        }

        if ($fchfin) {
            $q->addWhere("ev.ca_fchcreado<=?", $fchfin);
        }

        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->fchinicio = $fchinicio;
        $this->fchfin = $fchfin;
        $this->idgroup = $idgroup;
        $this->login = $login;
    }

    /*
     * Informe Listado de Evaluaciones
     *
     */

    public function executeInformeListadoEvaluacionesForm(sfWebRequest $request) {
        
    }

    public function executeInformeListadoEvaluaciones(sfWebRequest $request) {

        $fchinicio = $request->getParameter("fchinicio");
        $fchfin = $request->getParameter("fchfin");
        $iddepartamento = $request->getParameter("departamento");
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");

        $q = Doctrine_Query::create()
                ->select("ev.ca_idevaluacion, AVG(ca_valor) as promedio, ev.ca_titulo, us.ca_nombre, us2.ca_nombre, ev.ca_comentarios")
                ->from("SurvEvaluacion ev")
                ->innerJoin("ev.SurvEvaluacionxCriterio exc")
                ->innerJoin("ev.HdeskTicket t")
                ->innerJoin("t.HdeskGroup g")
                ->innerJoin("t.AssignedTo us")
                ->innerJoin("t.Usuario us2")
                ->addGroupBy("ev.ca_idevaluacion")
                ->addGroupBy("ev.ca_titulo")
                ->addGroupBy("us.ca_nombre")
                ->addGroupBy("us2.ca_nombre")
                ->addGroupBy("ev.ca_comentarios")
                ->addOrderBy("us.ca_nombre");

        if ($iddepartamento) {
            $q->addWhere("g.ca_iddepartament=?", $iddepartamento);
            if ($idgroup) {
                $q->addWhere("t.ca_idgroup=?", $idgroup);
                if ($login) {
                    $q->addWhere("t.ca_assignedto=?", $login);
                }
            }
        }

        if ($fchinicio) {
            $q->addWhere("ev.ca_fchcreado>=?", $fchinicio);
        }

        if ($fchfin) {
            $q->addWhere("ev.ca_fchcreado<=?", $fchfin);
        }

        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->fchinicio = $fchinicio;
        $this->fchfin = $fchfin;
        $this->idgroup = $idgroup;
        $this->login = $login;
    }

    public function executeVerEvaluacion(sfWebRequest $request) {

        $idevaluacion = $request->getParameter("idevaluacion");
        $this->forward404Unless($idevaluacion);
        $this->evaluacion = Doctrine::getTable("SurvEvaluacion")->find($idevaluacion);
        $this->forward404Unless($this->evaluacion);


        $this->ticket = Doctrine::getTable("HDeskTicket")
                ->createQuery("h")
                ->addWhere("h.ca_idevaluacion=?", $this->evaluacion->getCaIdevaluacion())
                ->fetchOne();
    }

    public function executeInformeListadoEvaluacionesCriterio(sfWebRequest $request) {

        $fchinicio = $request->getParameter("fchinicio");
        $fchfin = $request->getParameter("fchfin");
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");
        $idcriterio = $request->getParameter("idcriterio");


        $q = Doctrine_Query::create()
                ->select("cr.ca_criterio,  ev.ca_idevaluacion, ev.ca_titulo, cr.ca_criterio, exc.ca_valor, exc.ca_ponderacion, us.ca_nombre, us2.ca_nombre, exc.ca_observaciones")
                ->from("SurvEvaluacionxCriterio exc")
                ->innerJoin("exc.SurvCriterio cr")
                ->innerJoin("exc.SurvEvaluacion ev")
                ->innerJoin("ev.HdeskTicket t")
                ->innerJoin("t.AssignedTo us")
                ->innerJoin("t.Usuario us2")
                ->addOrderBy("ev.ca_idevaluacion");

        if ($idgroup) {
            $q->addWhere("t.ca_idgroup=?", $idgroup);
            if ($login) {
                $q->addWhere("t.ca_assignedto=?", $login);
            }
        }

        if ($fchinicio) {
            $q->addWhere("ev.ca_fchcreado>=?", $fchinicio);
        }

        if ($fchfin) {
            $q->addWhere("ev.ca_fchcreado<=?", $fchfin);
        }

        if ($idcriterio) {
            $q->addWhere("exc.ca_idcriterio=?", $idcriterio);
        }

        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $this->fchinicio = $fchinicio;
        $this->fchfin = $fchfin;
        $this->idgroup = $idgroup;
        $this->login = $login;
    }

    public function executeReporteIdgSistemas($request) {

        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("extExtras/SuperBoxSelect", 'last');

        $this->narea = $request->getParameter("narea");
        $iddepartamento = $request->getParameter("departamento");
        
        $this->type_est = $request->getParameter("type_est");
        $this->porcentaje = $request->getParameter("porcentaje");
        $this->fechaInicial = Utils::parseDate($request->getParameter("fechaInicial"));
        $this->fechaFinal = Utils::parseDate($request->getParameter("fechaFinal"));
        $this->fechaUltSeg = Utils::parseDate($request->getParameter("ultimoseg"));
        $this->lcs = $request->getParameter("lcs");
        $this->lc = $request->getParameter("lc");
        $this->lci = $request->getParameter("lci");
        $opcion = $request->getParameter("opcion");

        $checkboxOpenTicket = $request->getParameter("checkboxOpenTicket");
        $this->checkboxStatus = $request->getParameter("checkboxStatus");
        $this->idetapa1 = $request->getParameter("status1");
        $this->idetapa2 = $request->getParameter("status2");        

        $this->idgsistemas = "";
        $type_est = $this->type_est;
        $porcentaje = $this->porcentaje;        
        $checkboxStatus = $this->checkboxStatus;
        
        if (is_array($this->narea) && array_sum($this->narea) > 0) {
            
            $sql_grupo = "";
            $sql_grupo.=" and (";
            foreach ($this->narea as $key => $area) {
                if ($key > 0)
                    $sql_grupo.=" or ";
                $sql_grupo.=" gr.ca_idgroup = " . $area;
            }
            $sql_grupo.=" )";            
        }else {
            $this->idgroup = "";
            $sql_grupo = "";
        }

        if ($checkboxGrupo && $this->login) {
            $assigned = " AND tk.ca_assignedto = '" . $this->login . "'";
        } else {
            $this->login = "";
            $assigned = "";
        }

        if ($opcion == "buscar") {
            $this->departamento = Doctrine::getTable("Departamento")->find($iddepartamento);

            $con = Doctrine_Manager::getInstance()->connection();
            switch ($type_est) {
                case 1: // Indicadores de Gestión
                    $select = $innerJoin = $leftJoin = "";
                    if(in_array(25, $this->narea)){ // Transporte Terrestre Internacional
                        $select = " ,pricing.ca_traorigen,pricing.ca_ciuorigen,pricing.ca_tradestino,pricing.ca_ciudestino,pricing.fcl,
                            pricing.lcl, pricing.tipodestino, pricing.exw";
                        
                        $innerJoin = "
                            INNER JOIN helpdesk.vi_tkpricing as pricing on pricing.ca_idticket = tk.ca_idticket";
                    }
                    if($checkboxStatus == "on"){                        
                        $q1 = ParametroTable::retrieveByCaso("CU110", null, null, $this->idetapa1);
                        $q2 = ParametroTable::retrieveByCaso("CU110", null, null, $this->idetapa2);
                        
                        if($this->idetapa1 == 999){
                            $this->etapa1 = "Creación del ticket";
                            $this->etapa2 = $q2[0]->getCaValor();
                            
                            $select.= " ,ca_opened as ca_status1, idgsta2.ca_createdat as ca_status2";
                            $leftJoin = "                                
                                LEFT JOIN ( SELECT res.ca_idticket, res.ca_createdat
                                    FROM helpdesk.tb_responses res
                                      INNER JOIN ( 
                                         SELECT rp.ca_idticket, min(rp.ca_idresponse) AS ca_idresponse
                                         FROM helpdesk.tb_responses rp                     
                                         WHERE rp.ca_idstatus = $this->idetapa2
                                         GROUP BY rp.ca_idticket) sta ON res.ca_idresponse = sta.ca_idresponse) idgsta2 ON idgsta2.ca_idticket = tk.ca_idticket";
                        }else{
                            $this->etapa1 = $q1[0]->getCaValor();
                            $this->etapa2 = $q2[0]->getCaValor();
                            
                            $select.= " ,idgsta1.ca_createdat as ca_status1, idgsta2.ca_createdat as ca_status2";                        

                            $leftJoin = "
                                LEFT JOIN ( SELECT res.ca_idticket, res.ca_createdat
                                    FROM helpdesk.tb_responses res
                                      INNER JOIN ( 
                                         SELECT rp.ca_idticket, min(rp.ca_idresponse) AS ca_idresponse
                                         FROM helpdesk.tb_responses rp                     
                                                 WHERE rp.ca_idstatus = $this->idetapa1 
                                         GROUP BY rp.ca_idticket) sta ON res.ca_idresponse = sta.ca_idresponse) idgsta1 ON idgsta1.ca_idticket = tk.ca_idticket
                                LEFT JOIN ( SELECT res.ca_idticket, res.ca_createdat
                                    FROM helpdesk.tb_responses res
                                      INNER JOIN ( 
                                         SELECT rp.ca_idticket, min(rp.ca_idresponse) AS ca_idresponse
                                         FROM helpdesk.tb_responses rp                     
                                         WHERE rp.ca_idstatus = $this->idetapa2
                                         GROUP BY rp.ca_idticket) sta ON res.ca_idresponse = sta.ca_idresponse) idgsta2 ON idgsta2.ca_idticket = tk.ca_idticket";
                        }
                    }
                    
                    $sql = "SELECT date_part('month',tk.ca_opened) as mes, tk.ca_idticket, tk.ca_title, tk.ca_type, tk.ca_assignedto,
                            to_char( nt.ca_fchcreado, 'YYYY-MM-DD') as fechacreado,to_char( nt.ca_fchcreado, 'HH24:MI:SS') as horacreado,
                            to_char( nt.ca_fchterminada, 'YYYY-MM-DD') as fechaterminada, to_char( nt.ca_fchterminada, 'HH24:MI:SS') as horaterminada,
                            CASE WHEN tk.ca_closedat IS NULL THEN 'Abierto' ELSE 'Cerrado' END as ca_estado, gr.ca_name, tk.ca_login, nt.ca_observaciones, nt.ca_fchcreado, nt.ca_fchterminada, s.ca_nombre, e.ca_nombre as empresa $select
                        FROM helpdesk.tb_tickets tk
                            LEFT OUTER JOIN helpdesk.tb_groups gr ON (tk.ca_idgroup = gr.ca_idgroup)
                            LEFT OUTER JOIN notificaciones.tb_tareas nt ON nt.ca_idtarea = tk.ca_idtarea
                            INNER JOIN control.tb_usuarios u ON u.ca_login = tk.ca_login
                            INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                            INNER JOIN control.tb_empresas e ON s.ca_idempresa = e.ca_idempresa
                            $innerJoin
                            $leftJoin
                        WHERE to_char( nt.ca_fchcreado, 'YYYY-MM-DD') BETWEEN '" . $this->fechaInicial . "' AND '" . $this->fechaFinal . "' AND gr.ca_iddepartament = $iddepartamento $sql_grupo $assigned
                        ORDER BY tk.ca_opened, tk.ca_idticket";
                    break;
                case 2: // Tickets Cerrados
                    $sql = "SELECT date_part('month',tk.ca_opened) as mes,tk.ca_idticket, tk.ca_title, tk.ca_assignedto,
                            to_char( tk.ca_opened, 'YYYY-MM-DD') as fechacreado, to_char( tk.ca_opened, 'HH24:MI:SS') as horacreado,
                            to_char(tk.ca_closedat, 'YYYY-MM-DD') as close_fch, to_char(tk.ca_closedat, 'HH24:MI:SS') as close_hou,
                            gr.ca_name, tk.ca_login, tk.ca_opened as ca_fchcreado, tk.ca_closedat as fch_close, s.ca_nombre, e.ca_nombre as empresa
                        FROM helpdesk.tb_tickets tk
                            LEFT OUTER JOIN helpdesk.tb_groups gr ON (tk.ca_idgroup = gr.ca_idgroup)
                            INNER JOIN control.tb_usuarios u ON u.ca_login = tk.ca_login
                            INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                            INNER JOIN control.tb_empresas e ON s.ca_idempresa = e.ca_idempresa
                        WHERE tk.ca_closedat IS NOT NULL and to_char(tk.ca_closedat, 'YYYY-MM-DD') BETWEEN '" . $this->fechaInicial . "' AND '" . $this->fechaFinal . "' AND gr.ca_iddepartament = $iddepartamento $sql_grupo $assigned
                        ORDER BY tk.ca_idticket";
                    break;
                case 3: // Tickets Abiertos
                    $sql = "SELECT *
                        FROM (
                            SELECT date_part('month',tk.ca_opened) as mes,tk.ca_idticket, tk.ca_title, tk.ca_assignedto,
                                to_char( tk.ca_opened, 'YYYY-MM-DD') as fechacreado, to_char( tk.ca_opened, 'HH24:MI:SS') as horacreado,
                                to_char(MAX(rs.ca_createdat), 'YYYY-MM-DD') as ult_fch, to_char(MAX(rs.ca_createdat), 'HH24:MI:SS') as ult_hou,
                                gr.ca_iddepartament, gr.ca_name, tk.ca_login, tk.ca_opened as ca_fchcreado, MAX(rs.ca_createdat) as fch_ultseg, tk.ca_percentage, s.ca_nombre, e.ca_nombre as empresa
                            FROM helpdesk.tb_tickets tk
                                INNER JOIN helpdesk.tb_responses rs ON tk.ca_idticket=rs.ca_idticket
                                LEFT OUTER JOIN helpdesk.tb_groups gr ON (tk.ca_idgroup = gr.ca_idgroup)
                                INNER JOIN control.tb_usuarios u ON u.ca_login = tk.ca_login
                                INNER JOIN control.tb_sucursales s ON s.ca_idsucursal = u.ca_idsucursal
                                INNER JOIN control.tb_empresas e ON s.ca_idempresa = e.ca_idempresa
                            WHERE tk.ca_closedat IS NULL $sql_grupo $assigned
                            GROUP BY tk.ca_opened, tk.ca_idticket, tk.ca_title, tk.ca_assignedto, fechacreado, horacreado, tk.ca_login, gr.ca_iddepartament, gr.ca_name, tk.ca_percentage,s.ca_nombre, e.ca_nombre
                            ORDER BY tk.ca_idticket
                             ) as consulta
                        WHERE ult_fch <= '" . $this->fechaUltSeg . "' AND consulta.ca_iddepartament = $iddepartamento AND ca_percentage<='" . $porcentaje . "'";
                    break;
            }
//            print($sql);
            $st = $con->execute($sql);
            $this->idgsistemas = $st->fetchAll();            
        }
    }

    public function executeDatosAreas($request) {

        $departamento = $request->getParameter("departamento");
        $query = $request->getParameter("query");
        $gruposArray = array();

        if ($departamento) {
            $grupos = Doctrine::getTable("HdeskGroup")
                    ->createQuery("g")
                    ->where("g.ca_iddepartament = ?", $departamento)
                    ->addOrderBy("g.ca_name")
                    ->execute();

            foreach ($grupos as $grupo) {
                $gruposArray[] = array("idgrupo" => $grupo->getCaIdgroup(), "nombre" => utf8_encode($grupo->getCaName()));
            }
        }

        if ($query) {
            $this->query = $query;
            $grupos = Doctrine::getTable("HdeskGroup")
                    ->createQuery("g")
                    ->where("g.ca_idgroup IN ('" . str_replace("|", "','", $query) . "')")
                    ->addOrderBy("g.ca_name")
                    ->execute();

            foreach ($grupos as $grupo) {
                $gruposArray[] = array("idgrupo" => $grupo->getCaIdgroup(), "nombre" => utf8_encode($grupo->getCaName()));
            }
        }

        $this->responseArray = array("root" => $gruposArray, "success" => true);
        $this->setTemplate("responseTemplate");
    }
}