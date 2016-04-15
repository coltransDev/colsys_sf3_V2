<?php

/**
 * conceptos actions.
 *
 * @package    colsys
 * @subpackage conceptos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class conceptosActions extends sfActions {

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosPanelParametrosConceptos(sfWebRequest $request) {
        $readOnly = $request->getParameter("readOnly");
        //$nivel = $this->getNivel();

        $idccosto = $request->getParameter("idccosto");

        $q = Doctrine::getTable("InoConcepto")
                ->createQuery("c")
                ->select("c.*") //,
                ->addWhere("c.ca_recargoorigen=true OR c.ca_recargolocal=true")
                ->addWhere("c.ca_usueliminado IS NULL")
                ->addOrderBy("c.ca_concepto");


        $conceptos = $q->setHydrationMode(Doctrine::HYDRATE_SCALAR)->execute();

        $k = 0;
        foreach ($conceptos as $key => $val) {
            $conceptos[$key]["c_ca_concepto"] = utf8_encode($conceptos[$key]["c_ca_concepto"]);
            $conceptos[$key]["orden"] = str_pad($k, 4, "0", STR_PAD_LEFT);
            $k++;


            $modalidadesConcepto = Doctrine_Query::create()
                    ->select("cm.ca_idmodalidad")
                    ->from("InoConceptoModalidad cm")
                    ->where("cm.ca_idconcepto = ? ", $conceptos[$key]["c_ca_idconcepto"])
                    ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                    ->execute();
            $modalidades = array();

            foreach ($modalidadesConcepto as $modalidadConcepto) {
                $modalidades[] = $modalidadConcepto["ca_idmodalidad"];
            }
            $conceptos[$key]["modalidades"] = implode("|", $modalidades);
        }

        if ($readOnly == "false") {
            $conceptos[] = array("ca_idconcepto" => "", "ca_concepto" => "", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($conceptos), "root" => $conceptos);

        $this->setTemplate("responseTemplate");
    }

    /*
     * guarda el panel de conceptos
     * @param sfRequest $request A request object
     */

    public function executeGuardarPanelParametros(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);

        $modo = $request->getParameter("modo");

        $tipo = $request->getParameter("tipo");

        $idconcepto = $request->getParameter("idconcepto");

        if ($idconcepto) {
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
        } else {
            $concepto = new InoConcepto();
            $concepto->setCaTipo($request->getParameter("tipo"));
        }

        if ($request->getParameter("concepto") !== null) {
            $concepto->setCaConcepto(utf8_decode($request->getParameter("concepto")));
        }

        if ($request->getParameter("parametros") !== null) {
            $concepto->setCaParametros(utf8_decode($request->getParameter("parametros")));
        }

        if ($request->getParameter("recargoorigen") !== null) {
            if ($request->getParameter("recargoorigen") == "true") {
                $concepto->setCaRecargoorigen(true);
            } else {
                $concepto->setCaRecargoorigen(false);
            }
        }

        if ($request->getParameter("recargolocal") !== null) {
            if ($request->getParameter("recargolocal") == "true") {
                $concepto->setCaRecargolocal(true);
            } else {
                $concepto->setCaRecargolocal(false);
            }
        }

        if ($request->getParameter("observaciones") !== null) {
            if ($request->getParameter("observaciones")) {
                $concepto->setCaDetalles($request->getParameter("observaciones"));
            } else {
                $concepto->setCaDetalles(null);
            }
        }

        if ($request->getParameter("aka") !== null) {
            if ($request->getParameter("aka")) {
                $concepto->setCaAka($request->getParameter("aka"));
            } else {
                $concepto->setCaAka(null);
            }
        }

        if ($concepto->getCaIdconcepto()) {
            if ($request->getParameter("modalidades") !== null) {
                Doctrine_Query::create()
                        ->delete()
                        ->from("InoConceptoModalidad cm")
                        ->where("cm.ca_idconcepto = ? ", $concepto->getCaIdconcepto())
                        ->execute();

                $modalidadesParam = explode("|", $request->getParameter("modalidades"));

                foreach ($modalidadesParam as $val) {
                    $cm = new InoConceptoModalidad();
                    $cm->setCaIdconcepto($concepto->getCaIdconcepto());
                    $cm->setCaIdmodalidad($val);
                    $cm->save();
                }
            }
        }
        $concepto->save();
        $this->responseArray["success"] = true;
        $this->responseArray["idconcepto"] = $concepto->getCaIdconcepto();
        $this->setTemplate("responseTemplate");
    }

    /*
     * guarda el panel de conceptos
     * @param sfRequest $request A request object
     */

    public function executeEliminarPanelParametros(sfWebRequest $request) {
        $id = $request->getParameter("id");
        $this->responseArray = array("id" => $id, "success" => false);
        //$nivel = $this->getNivel();
        //if( $nivel==1 ){
        $idconcepto = $request->getParameter("idconcepto");
        if ($idconcepto) {
            $concepto = Doctrine::getTable("InoConcepto")->find($idconcepto);
            $this->forward404Unless($concepto);
            $concepto->setCaFcheliminado(date("Y-m-d H:i:s"));
            $concepto->setCaUsueliminado($this->getUser()->getUserid());
            $concepto->save();
            $this->responseArray["success"] = true;
        }
        //}
        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosModalidadGrid(sfWebRequest $request) {
        $tipo = $request->getParameter("tipo");
        $readOnly = $request->getParameter("readOnly");
        $conceptos = array();
        if ($request->getParameter("modalidades")) {

            $modalidadesParam = explode("|", $request->getParameter("modalidades"));
            if (count($modalidadesParam) > 0) {
                $q = Doctrine::getTable("Modalidad")
                        ->createQuery("m")
                        ->select("m.ca_idmodalidad, m.ca_impoexpo, m.ca_transporte, m.ca_modalidad")
                        ->whereIn("m.ca_idmodalidad", $modalidadesParam)
                        ->addOrderBy("m.ca_impoexpo")
                        ->addOrderBy("m.ca_transporte")
                        ->addOrderBy("m.ca_modalidad");
                $modalidades = $q->setHydrationMode(Doctrine::HYDRATE_ARRAY)->execute();
                $k = 0;
                foreach ($modalidades as $modalidad) {
                    $conceptos[] = array("idmodalidad" => $modalidad["ca_idmodalidad"], "modalidad" => utf8_encode($modalidad["ca_impoexpo"] . " " . $modalidad["ca_transporte"] . " " . $modalidad["ca_modalidad"]), "orden" => $k++);
                }
            }
        }
        //$nivel = $this->getNivel();
        if ($readOnly == "false") {
            $conceptos[] = array("idmodalidad" => "", "modalidad" => "+", "orden" => "Z");
        }
        $this->responseArray = array("totalCount" => count($conceptos), "root" => $conceptos);

        $this->setTemplate("responseTemplate");
    }

    /**
     * Datos de los conceptos para usar en pricing cotizaciones etc.
     *
     * @param sfRequest $request A request object
     */
    public function executeDatosConceptos(sfWebRequest $request) {
        $transporte = utf8_decode($request->getParameter("transporte"));
        $modalidad = utf8_decode($request->getParameter("modalidad"));
        $parametro = utf8_decode($request->getParameter("parametro"));
        $impoexpo = utf8_decode($request->getParameter("impoexpo"));
        $tipo = utf8_decode($request->getParameter("tipo"));
        $modo = $request->getParameter("modo");

        if ($impoexpo == constantes::TRIANGULACION)
            $impoexpo = constantes::IMPO;

        if ($modo == "recargos") {
            $this->forward404Unless($impoexpo);
            $this->forward404Unless($transporte);
            //echo $tipo;
            //$c->setLimit(3);

            if ($transporte == Constantes::OTMDTA || $transporte == Constantes::TERRESTRE || $transporte == Constantes::OTMAIR) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
                $transporte = Constantes::TERRESTRE;
                if($modalidad == Constantes::CONTINUACION)
                    $impoexpo = Constantes::OTMAIR;
                else
                    $modalidad = Constantes::OTMDTA;
            }            
            if ($modalidad == Constantes::ADUANAFCL || $modalidad == Constantes::ADUANALCL) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
                $modalidad = Constantes::OTMDTA;
            }

            $q = Doctrine::getTable("InoConcepto")
                    ->createQuery("c")
                    ->innerJoin("c.InoConceptoModalidad cm")
                    ->innerJoin("cm.Modalidad m")
                    ->addWhere("m.ca_impoexpo like ? ", "%" . $impoexpo . "%")
                    ->addWhere("m.ca_transporte = ? ", $transporte)
                    ->addWhere("c.ca_usueliminado IS NULL")
                    ->distinct()
                    ->addOrderBy("c.ca_concepto");

            if ($tipo) {
                if ($tipo == Constantes::RECARGO_EN_ORIGEN) {
                    $q->addWhere("c.ca_recargoorigen = ? ", true);
                }
                if ($tipo == Constantes::RECARGO_LOCAL) {
                    $q->addWhere("c.ca_recargolocal = ? ", true);
                }
                if ($tipo == Constantes::RECARGO_OTM_DTA) {
                    $q->addWhere("c.ca_recargootmdta = ? ", true);
                }
            }

            $recargos = $q->execute();
            $this->conceptos = array();
            foreach ($recargos as $recargo) {
                $row = array("idconcepto" => $recargo->getCaIdconcepto(),
                    "concepto" => utf8_encode($recargo->getCaConcepto()),
                    "aka" => utf8_encode(str_replace("|", ",", $recargo->getCaAka()))
                );
                $this->conceptos[] = $row;
            }
        } elseif ($modo == "costos") {
            $this->forward404Unless($impoexpo);
            //echo $tipo;
            //$c->setLimit(3);
            $q = Doctrine::getTable("Costo")
                    ->createQuery("c")
                    ->addWhere("c.ca_impoexpo = ? ", $impoexpo)
                    ->addWhere("c.ca_transporte = ? ", $transporte)
                    ->distinct()
                    ->addOrderBy("c.ca_costo");

            $costos = $q->execute();
            $this->conceptos = array();
            foreach ($costos as $costo) {
                $row = array("idconcepto" => $costo->getCaIdcosto(),
                    "concepto" => utf8_encode($costo->getCaCosto())
                );
                $this->conceptos[] = $row;
            }
        } elseif ($modo == "parametros") {
            $this->forward404Unless($impoexpo);
            //echo $tipo;
            //$c->setLimit(3);
            $q = Doctrine::getTable("Costo")
                    ->createQuery("c")
                    ->addWhere("c.ca_impoexpo = ? ", $impoexpo)
                    ->addWhere("c.ca_parametros = ? ", $parametro)
                    ->distinct()
                    ->addOrderBy("c.ca_costo");

            $costos = $q->execute();
            $this->conceptos = array();
            foreach ($costos as $costo) {
                $row = array("idconcepto" => $costo->getCaIdcosto(),
                    "concepto" => utf8_encode($costo->getCaCosto())
                );
                $this->conceptos[] = $row;
            }
        } else {
            $this->forward404Unless($transporte);
            $this->forward404Unless($modalidad);
            if ($transporte == Constantes::OTMDTA || $transporte == Constantes::TERRESTRE || $transporte == Constantes::OTMAIR) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
                $transporte = Constantes::TERRESTRE;
                if($modalidad == Constantes::CONTINUACION)
                    $modalidad = Constantes::CONTINUACION;
                else
                    $modalidad = Constantes::OTMDTA;
            }            
            if ($modalidad == Constantes::ADUANAFCL || $modalidad == Constantes::ADUANALCL) { //FIX-ME [Actualizar los registros de la tabla para que coincidan y arreglar las cotizaciones]
                $modalidad = Constantes::OTMDTA;
            }
            $conceptos = Doctrine::getTable("Concepto")
                    ->createQuery("c")
                    ->where("c.ca_transporte = ? AND c.ca_modalidad = ?", array($transporte, $modalidad))
                    ->addOrderBy("c.ca_liminferior")
                    ->addOrderBy("c.ca_concepto")
                    ->execute();
            $this->conceptos = array();
            foreach ($conceptos as $concepto) {
                $row = array("idconcepto" => $concepto->getCaIdconcepto(),
                    "concepto" => utf8_encode($concepto->getCaConcepto())
                );
                $this->conceptos[] = $row;
            }

            $this->conceptos[] = array("idconcepto" => 9999,
                "concepto" => utf8_encode("Recargos generales del trayecto")
            );
        }

        $this->responseArray = array("totalCount" => count($this->conceptos), "root" => $this->conceptos);
        $this->setTemplate("responseTemplate");
    }

}

?>