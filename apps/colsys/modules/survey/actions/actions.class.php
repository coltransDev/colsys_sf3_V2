<?php

/**
 * survey actions.
 *
 * @package    symfony
 * @subpackage survey
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class surveyActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('default', 'module');
    }

    /*
     * Crea una nueva evaluación
     *
     * @param sfRequest $request A request object
     */

    public function executeFormEvaluacion(sfWebRequest $request) {


        $this->ticket = null;
        if ($request->getParameter("idevaluacion")) {
            $evaluacion = Doctrine::getTable("SurvEvaluacion")->find($request->getParameter("idevaluacion"));
            $this->forward404Unless($evaluacion);

            if( $evaluacion->getCaNotificar()!=$this->getuser()->getUserid() ){
                $this->redirect("users/noAccess");
            }

            $this->ticket = Doctrine::getTable("HDeskTicket")
                    ->createQuery("h")
                    ->addWhere("h.ca_idevaluacion=?", $evaluacion->getCaIdevaluacion())
                    ->fetchOne();


        } else {
            $evaluacion = new SurvEvaluacion();
        }






        if ($evaluacion->getCaEstado() == SurvEvaluacion::ESTADO_RESUELTA) {
            $this->redirect("survey/finalizarEvaluacion");
        }
        
        $grupo = $this->ticket->getHdeskGroup();
        $tipos = array("Defecto", "Mejora");
        
        $q = Doctrine::getTable("SurvCriterio")->createQuery("c")
            ->addWhere("c.ca_activo = ?", true)
            ->addWhere("c.ca_idtipo = ?", $grupo->getCaIdtipo());
        
        if(in_array($this->ticket->getCaType(), $tipos) && $grupo->getCaIdtipo() != 2 ){
            $q->addWhere("c.ca_tipocriterio = ?", $this->ticket->getCaType());
        }else{
            $q->addWhere("c.ca_tipocriterio = '-'");
        }
            
        $this->criterios = $q->execute();

        $this->form = new NuevaEvaluacionForm();
        $this->form->setCriterios($this->criterios);
        $this->form->configure();

        if ($request->isMethod('post')) {

            $bindValues = array();

            $bindValues["idtipo"] = $request->getParameter("idtipo");
            $bindValues["comentarios"] = $request->getParameter("comentarios");

            if (!$request->getParameter("comentarios_check")) {
                $bindValues["comentarios"] = "";
            }

            foreach ($this->criterios as $criterio) {
                $bindValues["ponderacion_" . $criterio->getCaIdcriterio()] = $request->getParameter("ponderacion_" . $criterio->getCaIdcriterio());
                $bindValues["calificacion_" . $criterio->getCaIdcriterio()] = $request->getParameter("calificacion_" . $criterio->getCaIdcriterio());
                $bindValues["observaciones_" . $criterio->getCaIdcriterio()] = $request->getParameter("observaciones_" . $criterio->getCaIdcriterio());
            }

            $this->form->bind($bindValues);
            if ($this->form->isValid()) {

                if (!$request->getParameter("idevaluacion")) {
                    $evaluacion->setCaIdtipo($request->getParameter('idtipo'));
                }

                if ($bindValues["comentarios"]) {
                    $evaluacion->setCaComentarios($bindValues["comentarios"]);
                }


                $evaluacion->setCaEstado(SurvEvaluacion::ESTADO_RESUELTA);
                $evaluacion->save();

                $evaluacionxCriterios = $evaluacion->getSurvEvaluacionxCriterio();
                foreach ($evaluacionxCriterios as $evaluacionxCriterio) {
                    $evaluacionxCriterio->delete();
                }

                $criterios = $request->getParameter("idcriterio");

                foreach ($criterios as $idcriterio) {
                    $evaluacionxcriterio = new SurvEvaluacionxCriterio();
                    $evaluacionxcriterio->setCaIdcriterio($idcriterio);
                    $evaluacionxcriterio->setCaPonderacion(trim($request->getParameter("ponderacion_" . $idcriterio)));
                    $evaluacionxcriterio->setCaValor(trim($request->getParameter("calificacion_" . $idcriterio)));
                    $evaluacionxcriterio->setCaIdevaluacion($evaluacion->getCaIdevaluacion());
                    if ($request->getParameter("observaciones_" . $idcriterio)) {
                        $evaluacionxcriterio->setCaObservaciones($request->getParameter("observaciones_" . $idcriterio));
                    } else {
                        $evaluacionxcriterio->setCaObservaciones(null);
                    }
                    $evaluacionxcriterio->save();
                }

                $this->redirect("survey/finalizarEvaluacion");
            }
        }

        $this->evaluacion = $evaluacion;

        $this->evaluacionxCriterios = array();
        $evaluacionxCriterios = $evaluacion->getSurvEvaluacionxCriterio();
        foreach ($evaluacionxCriterios as $evaluacionxCriterio) {
            $this->evaluacionxCriterios[$evaluacionxCriterio->getCaIdcriterio()] = $evaluacionxCriterio;
        }
    }

    public function executeFinalizarEvaluacion(sfWebRequest $request) {
        
    }

    /*
     * Muestra una evaluacion
     *
     * @param sfRequest $request A request object
     */

    public function executeVerEvaluacion(sfWebRequest $request) {
        $this->evaluacion = Doctrine::getTable("SurvEvaluacion")->find($request->getParameter("idevaluacion"));

        $this->forward404Unless($this->evaluacion);

        $this->ids = $this->evaluacion->getIds();
        $this->modo = $request->getParameter("modo");

        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();
    }

    /*
     * Email que notifica al usuario que se ha creado una evaluacion
     *
     * @param sfRequest $request A request object
     */

    public function executeEmailEvaluacion(sfWebRequest $request) {

        $this->evaluacion = Doctrine::getTable("SurvEvaluacion")->find($request->getParameter("idevaluacion"));
        $this->forward404Unless($this->evaluacion);

        $this->setLayout("email");

        $this->ticket = Doctrine::getTable("HDeskTicket")
                ->createQuery("h")
                ->addWhere("h.ca_idevaluacion=?", $this->evaluacion->getCaIdevaluacion())
                ->fetchOne();

        //$datos = sfContext::getInstance()->getController()->getPresentationFor( 'traficos', 'informeTraficosFormato1');
    }

    public function executeNotificarEvaluacion(sfWebRequest $request) {

        $this->setLayout("email");

        $fecha = date("Y-m-d H:i:s", time() - (8 * 86400));

        $evaluaciones = Doctrine::getTable("SurvEvaluacion")
                ->createQuery("e")
                ->addWhere("e.ca_estado = ? ", SurvEvaluacion::ESTADO_SINCONTESTAR)
                ->addWhere("e.ca_fchnotificacion <= ? OR e.ca_fchnotificacion IS NULL", $fecha)
                ->addWhere("e.ca_numnotificacion < ?", SurvEvaluacion::MAX_NOTIFICACIONES)
                ->execute();

        foreach ($evaluaciones as $evaluacion) {
            $conn = Doctrine::getTable("Reporte")->getConnection();
            $conn->beginTransaction();
            try {
                $email = new Email();
                $email->setCaUsuenvio($evaluacion->getCaUsucreado());
                $email->setCaTipo("Notificación Eval.");
                $email->setCaIdcaso($evaluacion->getCaIdevaluacion());
                $email->setCaFrom("no-reply@coltrans.com.co");
                $email->setCaFromname("Colsys Notificaciones");

                $email->addTo($evaluacion->getUsuario()->getCaEmail());


                $email->setCaSubject($evaluacion->getCaTitulo());

                $request->setParameter("idevaluacion", $evaluacion->getCaIdevaluacion());
                $contenido = sfContext::getInstance()->getController()->getPresentationFor('survey', 'emailEvaluacion');
                $email->setCaBodyhtml($contenido);
                $email->save($conn);
                $email->send();
                $evaluacion->setCaFchnotificacion(date("Y-m-d H:i:s"));
                $evaluacion->setCaNumnotificacion($evaluacion->getCaNumnotificacion() + 1);
                $evaluacion->save($conn);
                $conn->commit();
            } catch (Exception $e) {
                $conn->rollBack();
                throw $e;
            }
        }
        return sfView::NONE;
        //
    }
}
