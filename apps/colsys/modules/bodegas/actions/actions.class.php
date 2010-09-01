<?php

/**
 * bodegas actions.
 *
 * @package    symfony
 * @subpackage bodegas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bodegasActions extends sfActions {

    const RUTINA = 93;
    private $nivel;

    public function getNivel( ){

        $this->nivel = $this->getUser()->getNivelAcceso( bodegasActions::RUTINA );
        return $this->nivel;
    }

    public function executeIndex(sfWebRequest $request) {
        

        if( $this->getNivel()==-1 ){
                $this->forward404();
        }

        $q = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->distinct();

        $tbodegas = $q->select("ca_tipo")
                ->execute();

        $transportes = $q->select("ca_transporte")
                ->execute();

        $this->transportes = array();
        $this->tbodegas = array();

        foreach ($transportes as $transporte) {
            $this->transportes[] = array("name" => utf8_encode($transporte["b_ca_transporte"]));
        }
        foreach ($tbodegas as $tbodega) {
            $this->tbodegas[] = array("name1" => utf8_encode($tbodega["b_ca_tipo"]));
        }
    }

    public function executeFormClientePanel(sfWebRequest $request) {
        $this->idbodega = $this->getRequestParameter("idbodega");

        if ($this->idbodega) {
            $bodega = Doctrine::getTable('Bodega')->find($this->getRequestParameter("idbodega"));
            if (!($this->getUser()->getUserId()==$bodega->getCaUsucreado() && strtotime($bodega->getCaFchcreado())>= ( time() - 86400) )) {
                $this->noeditable = true;
            } else {
                $this->noeditable = "false";
            }
        } else {
            $this->noeditable = "false";
        }

        $q = Doctrine::getTable("Bodega")
                ->createQuery("b")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                ->distinct();

        $tbodegas = $q->select("ca_tipo")
                ->execute();

        $transportes = $q->select("ca_transporte")
                ->execute();

        $this->transportes = array();
        $this->tbodegas = array();

        foreach ($transportes as $transporte) {
            $this->transportes[] = array("name" => utf8_encode($transporte["b_ca_transporte"]));
        }
        foreach ($tbodegas as $tbodega) {
            $this->tbodegas[] = array("name1" => utf8_encode($tbodega["b_ca_tipo"]));
        }
    }

    public function executeBusqueda(sfWebRequest $request) {
        $this->bodegas = Doctrine::getTable('Bodega');

        $user = $this->getUser();
        $criterio = $this->getRequestParameter("criterio");
        $cadena = $this->getRequestParameter("cadena");
        $tipo = $this->getRequestParameter("tipo");
        $transporte = $this->getRequestParameter("transporte");

        $q = Doctrine_Query::create()
                ->select("*")
                ->from('Bodega b');


        switch ($criterio) {
            case "nombre":
                $q->addWhere('lower(b.ca_nombre) like ?', strtolower($cadena . '%'));
                break;
            case "tipo":
                $q->addWhere('lower(b.ca_tipo) like ?', strtolower($tipo . '%'));
                break;
            case "transporte":
                $q->addWhere('lower(b.ca_transporte) like ?', strtolower($transporte . '%'));
                break;
        }


        $q->addOrderBy("b.ca_nombre ASC");
        // Defining initial variables
        $currentPage = $this->getRequestParameter('page', 1);
        $resultsPerPage = 50;

        // Creating pager object
        $this->pager = new Doctrine_Pager(
                        $q,
                        $currentPage,
                        $resultsPerPage
        );

        $this->bodegas = $this->pager->execute();
        if ($this->pager->getResultsInPage()==1 && $this->pager->getPage()==1) {
            $bodega = $this->bodegas;
        }


        $this->criterio = $criterio;
        $this->cadena = $cadena;
        $this->tipo = $tipo;
        $this->transporte = $transporte;
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new BodegaForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new BodegaForm();
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($bodega = Doctrine::getTable('Bodega')->find(array($request->getParameter('ca_idbodega'))), sprintf('Object bodega does not exist (%s).', $request->getParameter('ca_idbodega')));
        $this->form = new BodegaForm($bodega);


        if (!($this->getUser()->getUserId()==$bodega->getCaUsucreado() && strtotime($bodega->getCaFchcreado())>= ( time() - 86400) )) {
            $this->redirect("bodegas/show?ca_idbodega=" . $bodega->getCaIdbodega() . "&noeditable=true");
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($bodega = Doctrine::getTable('Bodega')->find(array($request->getParameter('ca_idbodega'))), sprintf('Object bodega does not exist (%s).', $request->getParameter('ca_idbodega')));
        $this->form = new BodegaForm($bodega);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($bodega = Doctrine::getTable('Bodega')->find(array($request->getParameter('ca_idbodega'))), sprintf('Object bodega does not exist (%s).', $request->getParameter('ca_idbodega')));
        $bodega->delete();

        $this->redirect('bodegas/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $bodega = $form->save();
            $this->redirect('bodegas/edit?ca_idbodega=' . $bodega->getCaIdbodega());
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->forward404Unless($this->bodega = Doctrine::getTable('Bodega')->find(array($request->getParameter('ca_idbodega'))), sprintf('Object bodega does not exist (%s).', $request->getParameter('ca_idbodega')));

        $this->noeditable = $request->getParameter("noeditable");
    }

    public function executeVerificarBodega(sfWebRequest $request) {
        $bodega = utf8_decode($request->getParameter('bodega'));
        $tipo = utf8_decode($request->getParameter('tipo'));
        $transporte = utf8_decode($request->getParameter('transporte'));


        $sql = "SELECT * FROM tb_bodegas WHERE fun_similarpercent('$bodega' , ca_nombre)>90 and ca_tipo='$tipo' and ca_transporte = '$transporte'";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);

        $this->datos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->datos[] = $row;
        }
    }

    public function executeGuardarDatosBodega(sfWebRequest $request) {

        $error="";
        if( $this->getNivel()<1 ){
                $error="No posee Permisos";
        }
        else
        {
            $bodega= Doctrine::getTable('Bodega')->createQuery("b")
                                        ->addwhere("b.ca_nombre=?",utf8_decode($this->getRequestParameter("nombre")))
                                        ->addwhere("b.ca_tipo=?",utf8_decode($this->getRequestParameter("tipo")))
                                        ->addwhere("b.ca_transporte=?",utf8_decode($this->getRequestParameter("transporte")))
                                        ->execute();
            if ($bodega){
                $error = "La bodega ya existe";
            }
            else {
                $idbodega=($this->getRequestParameter("idbodega")!="")?$this->getRequestParameter("idbodega"):0;
                $form_bodega = Doctrine::getTable('Bodega')->find($idbodega);
                if (!$form_bodega) {
                    $form_bodega = new Bodega();
                }

                $form_bodega->setCaNombre(utf8_decode($this->getRequestParameter("nombre")));
                $form_bodega->setCaTipo(utf8_decode($this->getRequestParameter("tipo")));
                $form_bodega->setCaTransporte(utf8_decode($this->getRequestParameter("transporte")));

                $form_bodega->save();
                $this->responseArray = array("success" => true, "idbodega" => $form_bodega->getCaIdbodega());
            }
        }

        if($error!="")
        {
            $this->responseArray = array("success" => false, "error" => $error);
        }
        
        $this->setTemplate("responseTemplate");
    }

    public function executeCargarDatosBodega(sfWebRequest $request) {
        $bodega = Doctrine::getTable('Bodega')->find($this->getRequestParameter("idbodega"));

        $data = array();
        if ($bodega) {
            $data["nombre"] = utf8_encode($bodega->getCaNombre());
            $data["tipo"] = utf8_encode($bodega->getCaTipo());
            $data["transporte"] = utf8_encode($bodega->getCaTransporte());
            $data["idbodega"] = utf8_encode($bodega->getCaIdbodega());
        }
        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    /*
     * Buscar una bodega
     */

    public function executeDatosComboNombreBodega() {
        $bodega = $this->getRequestParameter("query");


        $bodegas = Doctrine_Query::create()
                ->select("b.ca_nombre")
                ->from("Bodega b")
                ->addWhere("lower(b.ca_nombre) like ?", "%".strtolower($bodega) . "%")
                ->addOrderBy("b.ca_nombre ASC")
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->limit(40)
                ->execute();

        $data=array();
        foreach($bodegas as $bodega){
            $data[]=array("ca_nombre"=>utf8_decode($bodega["ca_nombre"]));
        }



        $this->responseArray = array("totalCount" => count($data), "root" => $data, "success" => true);
        $this->setTemplate("responseTemplate");
/*
        $sql = "SELECT * FROM tb_bodegas WHERE fun_similarpercent('$bodega' , ca_nombre)>90 and ca_tipo='$tipo' and ca_transporte = '$transporte'";
        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);

        $this->datos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->datos[] = $row;
        }

        $this->responseArray = array("totalCount" => count($bodegas), "root" => $bodegas, "success" => true);
        $this->setTemplate("responseTemplate");
 * */

    }

}

