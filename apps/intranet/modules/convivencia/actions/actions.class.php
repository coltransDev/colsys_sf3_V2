<?php

/**
 * subastas actions.
 *
 * @package    symfony
 * @subpackage subastas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class convivenciaActions extends sfActions {
    
    const RUTINA = 108;

    public function getNivel() {

        $rutina = self::RUTINA;

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        

        return $this->nivel;
    }
    
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();
        
        $response = sfContext::getInstance()->getResponse();        
        $response->addJavaScript("flowplayer/flowplayer-3.2.6.min.js",'last');   
        
        $usersConvivencia = Doctrine::getTable("Usuario")
                    ->createQuery("u")
                    ->leftJoin("u.UsuBrigadas ub")
                    ->addWhere("(ub.ca_comites) LIKE ?", '%'. 2 . '%')
                    ->execute(); 
        
        $this->permitidos = array();
        foreach($usersConvivencia as $userc){
            $this->permitidos[] = $userc->getCaLogin();
        }
        
    }
    
    public function executeDocumentos(sfWebRequest $request) {
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $grupoEmp = $usuario->getGrupoEmpresarial();
        $this->idempresa = $usuario->getSucursal()->getEmpresa()->getCaIdempresa();
        
        $this->nivel = $this->getNivel();
        $this->user = $this->getUser();
        
        $this->tipo = $request->getParameter("tipo");
        
        $this->quejas = Doctrine::getTable("Convivencia")
                ->createQuery()
                ->addWhere("ca_usucreado = ?",$usuario->getCaLogin())
                ->orderBy("ca_fchcreado")
                ->execute();
        
        $this->reportes = Doctrine::getTable("Convivencia")
                ->createQuery()                
                ->orderBy("ca_fchcreado")
                ->execute();
        
        $integrantes = Doctrine::getTable("Usuario")
                ->createQuery("u")
                ->select("u.ca_nombres, s.ca_idsucursal, e.ca_idempresa, u.ca_cargo, e.ca_nombre")
                ->leftJoin("u.UsuBrigadas ub")
                ->leftJoin("u.Sucursal s")
                ->leftJoin("s.Empresa e")
                ->where("ub.ca_comites like ?","%" . 2 . "%")
                ->andWhereIn("e.ca_idempresa", $grupoEmp)
                ->andWhere("u.ca_activo =?", true)
                ->orderBy("e.ca_idsap, ub.ca_propiedades")
                ->execute();
        
        $this->data = array();
        
        foreach($integrantes as $integrante){
            $datos = explode("|", $integrante->getUsuBrigadas()->getProperty("comite2"));
            if(strpos($integrante->getUsuBrigadas()->getCaPropiedades(),"Empleados")){                                
                $this->data[$integrante->getSucursal()->getEmpresa()->getCaNombre()]["Empleados"][] = array(
                    "nombres"=>"<b>".$integrante->getCaNombre()."</b>",
                    "login"=>$integrante->getCaLogin(),
                    "tipo"=>$datos[1],
                    "adicional"=>$datos[2]
                );
            }else if(strpos($integrante->getUsuBrigadas()->getCaPropiedades(),"Empresa")){                
                $this->data[$integrante->getSucursal()->getEmpresa()->getCaNombre()]["Empresa"][] = array(
                    "nombres"=>"<b>".$integrante->getCaNombre()."</b>",
                    "login"=>$integrante->getCaLogin(),
                    "tipo"=>$datos[1],
                    "adicional"=>$datos[2]
                );
            }
        }
    }
    
    public function executeGuardarFormulario(sfWebRequest $request) {
        
        $login = $request->getParameter("login");
        $detalle = $request->getParameter("detalle");
        $detalle_add = $request->getParameter("detalle_add");
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        $userDen = Doctrine::getTable("Usuario")->find($login);
        
        if($userDen){
            $conn = Doctrine::getTable("Convivencia")->getConnection();
            $conn->beginTransaction();
            try {
                $form = new Convivencia();
                $form->setCaDenunciado($login);
                $form->setCaDetalle($detalle."<br/><br/><b>PRUEBAS</b></br>".$detalle_add);                
                $form->save($conn);                
                
                if (isset($_FILES)) {
                    $archivo = $_FILES["archivo"];
                    $directorio = $form->getDirectorio();

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0777, true);
                    }
                    move_uploaded_file($archivo["tmp_name"], $directorio . DIRECTORY_SEPARATOR . $archivo["name"]);
                    $attachment = $form->getDirectorioBase().DIRECTORY_SEPARATOR.$archivo["name"];
                }
                
                $q = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->leftJoin("u.UsuBrigadas ub")
                        ->leftJoin("u.Sucursal s")
                        ->where("ca_email IS NOT NULL")
                        ->addWhere("ub.ca_comites LIKE ? AND ub.ca_propiedades LIKE ? AND (ub.ca_propiedades LIKE ? OR ub.ca_propiedades LIKE ?  )", array('%2%','%Empresa%', '%Secretario%', '%Presidente%'))                        
                        ->addWhere("s.ca_idempresa = ?", $usuario->getSucursal()->getCaIdempresa());;
                
                $usersxEmpresa = $q->execute();
                     
                
                $q = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->leftJoin("u.UsuBrigadas ub")
                        ->leftJoin("u.Sucursal s")                        
                        ->addWhere("ub.ca_comites LIKE ? AND ub.ca_propiedades LIKE ? AND (ub.ca_propiedades LIKE ? OR ub.ca_propiedades LIKE ?  )", array('%2%','%Empleados%', '%Secretario%', '%Presidente%'))
                        ->addWhere("s.ca_idempresa = ?", $usuario->getSucursal()->getCaIdempresa());
                
                $usersxEmpleados = $q->execute();    
                
                $emails = [];
                        
                foreach($usersxEmpresa as $user){  
                    if(!in_array($user->getCaEmail(), $emails))
                        $emails[] = $user->getCaEmail();
                }

                foreach($usersxEmpleados as $user){
                    if(!in_array($user->getCaEmail(), $emails))
                        $emails[] = $user->getCaEmail();
                }
                
                if(count($emails)<=0){
                    $conn->rollback();
                    $this->responseArray = array("success" => false, "errorInfo" => utf8_encode("Agradecemos diligenciar éste formulario por escrito dado que los representantes del comité no están habilitados para recibirlo electrónicamente."));
                }else{

                    if($form->getCaId()){
                        $email = new Email();
                        $email->setCaUsuenvio("Administrador");
                        $email->setCaTipo("Convivencia");
                        $email->setCaIdcaso($form->getCaId());
                        $email->setCaFrom("no-reply@coltrans.com.co");
                        $email->setCaFromname($usuario->getCaNombre());
                        $email->setCaSubject("COMITE DE CONVIVENCIA - REPORTE DE QUEJAS: Formulario No ".$form->getCaId());

                        $request = sfContext::getInstance()->getRequest();
                        $request->setParameter("id", $form->getCaId());
                        $request->setParameter("format", 'email');
                        $texto.= sfContext::getInstance()->getController()->getPresentationFor('convivencia', 'verFormulario');
                        $email->setCaBodyhtml($texto);
                        $email->setCaAttachment($attachment);
                        
                        foreach($emails as $key => $val){
                            $email->addTo($val);
                        }
                        $email->save($conn);
                    }
                    $conn->commit();

                    $this->responseArray = array( "success" => true, "idform" => $form->getCaId(), "directorio" => $directorio, "login" => $login);
                }
            } catch (Exception $e) {
                $conn->rollback();
                $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
            }
        }else{
            $this->responseArray = array("success" => false, "errorInfo" => "Debe diligenciar completamente el formulario");
        }
        
        $this->setTemplate("responseTemplate");
        $this->setLayout("none");        
    }
    
    public function executeVerFormulario(sfWebRequest $request) {
        
        $this->user = $this->getUser();
        if($request->getParameter("format") && $request->getParameter("format")=="email")
            $this->setLayout("none");
        
        $usuario = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
        
        $comites = array();
        
        if($usuario->getUsuBrigadas()->getCaComites() && strrpos($usuario->getUsuBrigadas()->getCaComites(), "|"))
            $comites = explode("|",$usuario->getUsuBrigadas()->getCaComites());
        else
            $comites[] = $usuario->getUsuBrigadas()->getCaComites();
        
        $this->formulario = Doctrine::getTable("Convivencia")->find($request->getParameter("id"));
        
        if (!in_array(2 , $comites) && $usuario->getCaLogin()!=$this->formulario->getCaUsucreado())
            $this->forward("adminUsers", "noAccess");
        
        $this->usuario = Doctrine::getTable("Usuario")->find($this->formulario->getCaUsucreado());        
        $this->logo = $this->usuario->getLogoHtml($this->usuario->getSucursal()->getCaIdempresa());
        
        $directorio = $this->formulario->getDirectorio();
        $this->files = sfFinder::type('file')->maxDepth(0)->in($directorio);    
    }
}