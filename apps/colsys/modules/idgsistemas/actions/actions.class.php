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
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");

        
        $q = Doctrine_Query::create()
                            ->select("c.ca_idcriterio,c.ca_criterio, us.ca_login, us.ca_nombre, AVG(ca_valor) as promedio, COUNT(*) as numeval")
                            ->from("SurvCriterio c")
                            ->innerJoin("c.SurvEvaluacionxCriterio exc")
                            ->innerJoin("exc.SurvEvaluacion ev")                            
                            ->innerJoin("ev.UsuCreado us")
                            ->addGroupBy("c.ca_criterio")
                            ->addGroupBy("us.ca_login")
                            ->addGroupBy("us.ca_nombre")
                            ->addGroupBy("c.ca_idcriterio")
                            ->addOrderBy("us.ca_nombre")
                            ->addOrderBy("c.ca_criterio");
                           
        if( $idgroup ){
            $q->innerJoin( "ev.HdeskTicket t" );
            $q->addWhere("t.ca_idgroup=?",$idgroup );

            if( $login ){
                $q->addWhere("t.ca_assignedto=?",$login );
            }
        }

        if( $fchinicio ){
            $q->addWhere("ev.ca_fchcreado>=?",$fchinicio );
        }
        
        if( $fchfin ){
            $q->addWhere("ev.ca_fchcreado<=?",$fchfin );
        }



        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

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
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");

        $q = Doctrine_Query::create()
                            ->select("ev.ca_idevaluacion, AVG(ca_valor) as promedio, ev.ca_titulo, us.ca_nombre, ev.ca_comentarios")
                            ->from("SurvEvaluacion ev")
                            ->innerJoin("ev.SurvEvaluacionxCriterio exc")
                            ->innerJoin("ev.UsuCreado us")
                            ->addGroupBy("ev.ca_idevaluacion")
                            ->addGroupBy("ev.ca_titulo")
                            ->addGroupBy("us.ca_nombre")
                            ->addGroupBy("ev.ca_comentarios")
                            ->addOrderBy("us.ca_nombre");
                            
        if( $idgroup ){
            $q->innerJoin( "ev.HdeskTicket t" );
            $q->addWhere("t.ca_idgroup=?",$idgroup );
            if( $login ){
                $q->addWhere("t.ca_assignedto=?",$login );
            }
        }
        
        if( $fchinicio ){
            $q->addWhere("ev.ca_fchcreado>=?",$fchinicio );
        }

        if( $fchfin ){
            $q->addWhere("ev.ca_fchcreado<=?",$fchfin );
        }



        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        $this->fchinicio = $fchinicio;
        $this->fchfin = $fchfin;
        $this->idgroup = $idgroup;
        $this->login = $login;



    }



    public function executeVerEvaluacion(sfWebRequest $request) {

        $idevaluacion = $request->getParameter("idevaluacion");
        $this->forward404Unless( $idevaluacion );
        $this->evaluacion = Doctrine::getTable("SurvEvaluacion")->find( $idevaluacion );
        $this->forward404Unless( $this->evaluacion );

    }


    public function executeInformeListadoEvaluacionesCriterio(sfWebRequest $request) {


        $fchinicio = $request->getParameter("fchinicio");
        $fchfin = $request->getParameter("fchfin");
        $idgroup = $request->getParameter("idgroup");
        $login = $request->getParameter("login");
        $idcriterio = $request->getParameter("idcriterio");


        $q = Doctrine_Query::create()
                            ->select("cr.ca_criterio, ev.ca_titulo, cr.ca_criterio, exc.ca_valor, exc.ca_ponderacion, exc.ca_observaciones")
                            ->from("SurvEvaluacionxCriterio exc")
                            ->innerJoin("exc.SurvCriterio cr")
                            ->innerJoin("exc.SurvEvaluacion ev")
                            ->addOrderBy("ev.ca_idevaluacion");

        if( $idgroup ){
            $q->innerJoin( "ev.HdeskTicket t" );
            $q->addWhere("t.ca_idgroup=?",$idgroup );
            if( $login ){
                $q->addWhere("t.ca_assignedto=?",$login );
            }
        }

        if( $fchinicio ){
            $q->addWhere("ev.ca_fchcreado>=?",$fchinicio );
        }


        if( $fchfin ){
            $q->addWhere("ev.ca_fchcreado<=?",$fchfin );
        }

        if( $idcriterio ){
            $q->addWhere("exc.ca_idcriterio=?",$idcriterio );
        }


        $this->eval = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        $this->fchinicio = $fchinicio;
        $this->fchfin = $fchfin;
        $this->idgroup = $idgroup;
        $this->login = $login;

 

    }
}
