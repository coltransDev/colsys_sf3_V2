<?php

/**
 * adminUsers actions.
 *
 * @package    colsys
 * @subpackage adminUsers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminUsersActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    const RUTINA_COLSYS = 73;
    const RUTINA_INTRANET = 98;

    public function getNivel() {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        //   return 5;
        switch ($app) {
            case "colsys":
                $rutina = adminUsersActions::RUTINA_COLSYS;
                break;
            case "intranet":
                $rutina = adminUsersActions::RUTINA_INTRANET;
                break;
        }

        $this->nivel = $this->getUser()->getNivelAcceso($rutina);
        if (!$this->nivel) {
            $this->nivel = 0;
        }

        $this->forward404Unless($this->nivel>=0);

        return $this->nivel;
    }

    public function executeDirectory(sfWebRequest $request) {
        $this->setLayout("layout2col");

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }
    }

    public function executeDoSearch(sfWebRequest $request) {

        $criterio = ('%' . strtolower($request->getParameter('criterio')) . '%');
        $opcion = $request->getParameter("opcion");
        $departamento = utf8_decode($request->getParameter("departamento"));
        $sucursal = utf8_decode($request->getParameter("sucursal"));
        $empresa = utf8_decode($request->getParameter("empresa"));
        $sangre = $request->getParameter("type");

        $q = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('u.ca_activo = ?', true);
        if ($criterio) {
            switch ($opcion) {
                case "login":
                    $q->addWhere('LOWER(u.ca_login) LIKE ?', $criterio);
                    break;
                case "nombre":
                    $q->addWhere('(LOWER(u.ca_nombre) LIKE ? OR LOWER(u.ca_nombres) LIKE ? OR LOWER(u.ca_apellidos) LIKE ? )', array($criterio, $criterio, $criterio));
                    break;
                case "apellido":
                    $q->addWhere('(LOWER(u.ca_apellidos) LIKE ?)', $criterio);
                    break;
                case "correo":
                    $q->addWhere('LOWER(u.ca_email) LIKE ?', $criterio);
                    break;
                case "tiposangre":
                    $q->addWhere('LOWER(u.ca_tiposangre) LIKE ?', $criterio);
                    break;
                case "cargo":
                    $q->addWhere('LOWER(u.ca_cargo) LIKE ?', $criterio);
                    break;
            }
        }
        if ($departamento) {
            $q->addWhere('LOWER(u.ca_departamento) LIKE ?', strtolower($departamento));
        }
        if ($sucursal) {
            $q->addWhere('u.ca_idsucursal = ?', $sucursal);
        }
        if ($empresa) {
            $q->addWhere('s.ca_idempresa = ?', $empresa);
        }
        $q->distinct();
        $this->usuarios = $q->execute();
    }

    public function executeFormUsuario($request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();

        if ($this->usuario) {
            $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
            $this->manager = $this->manager->getManager();
        }

        switch ($app) {
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
        if (!($this->nivel == 0 and $request->getParameter("login") == $this->getUser()->getUserId())) {
            if (!($this->nivel > 1)) {
                $this->forward("adminUsers", "noAccess");
            }
        }

        if (!$this->usuario) {
            $this->usuario = new Usuario();
        }

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }

        $this->cargos = Doctrine::getTable("Cargo")
                        ->createQuery("c")
                        ->select('c.ca_cargo, c.ca_idempresa')
                        ->innerJoin('c.Empresa e')
                        ->addWhere('c.ca_activo = ?', true)
                        ->addOrderBy("c.ca_cargo")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->cargos as $key => $val) {
            $this->cargos[$key]["ca_cargo"] = utf8_encode($this->cargos[$key]["ca_cargo"]);
        }

        $this->jefes = Doctrine::getTable("Usuario")
                        ->createQuery("j")
                        ->select('j.ca_login, j.ca_nombre, j.ca_cargo, c.ca_idempresa')
                        ->innerJoin('j.Cargo c')
                        ->innerJoin('c.Empresa e')
                        ->addWhere('j.ca_activo = ?', true)
                        ->addWhere('c.ca_manager= ?', true)
                        ->addOrderBy("j.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
                        ->execute();

        foreach ($this->jefes as $key => $val) {
            $this->jefes[$key]["j_ca_nombre"] = utf8_encode($this->jefes[$key]["j_ca_nombre"]);
        }

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();

        $m = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->addWhere('u.ca_activo = ?', true);

        $this->users = $m->execute();

        $p = Doctrine_Manager::getInstance()->connection();
        $query = "SELECT DISTINCT ca_tiposangre";
        $query.= "	from control.tb_usuarios";
        $query.= "  order by ca_tiposangre ASC";

        $this->tiposangre = $p->execute($query);




        $this->parentescos = ParametroTable::retrieveByCaso('CU093');


        $s = Doctrine_Manager::getInstance()->connection();
        $query = "SELECT DISTINCT ca_teloficina";
        $query.= "	from control.tb_usuarios";
        $query.= "  order by ca_teloficina ASC";

        $this->teloficinas = $s->execute($query);

        /*
          $this->teloficinas = Doctrine::getTable("Usuario")
          ->createQuery("u")
          ->select('u.ca_idsucursal, s.ca_telefono')
          ->innerJoin('u.Sucursal s')
          ->innerJoin('s.Empresa e')
          ->addWhere('e.ca_activo = ?', true)
          ->addOrderBy("u.ca_activo DESC")
          ->setHydrationMode(Doctrine::HYDRATE_SCALAR)
          ->execute();

          foreach( $this->teloficinas as $key=>$val){
          $this->teloficinas[$key]["s_ca_telefono"] = utf8_encode($this->teloficinas[$key]["s_ca_telefono"]);
          }
         * 
         */

        //$this->manager=Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        //$this->manager = $this->manager->getManager();
        //$this->usuarios = $this->manager->getSubordinado();
        //$this->manager = $this->manager->getManager();


        $response = sfContext::getInstance()->getResponse();
        $response->addJavaScript("tabpane/tabpane", 'last');
        $response->addStylesheet("tabpane/luna/tab", 'last');
    }

    public function executeIndex(sfWebRequest $request) {
        $app = sfContext::getInstance()->getConfiguration()->getApplication();

        switch ($app) {
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }

        $this->usuarios = Doctrine::getTable("Usuario")
                        ->createQuery("u")
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('e.ca_activo = ?', true)
                        ->addOrderBy("u.ca_activo DESC")
                        ->addOrderBy("u.ca_login")
                        ->execute();
    }

    public function executeGuardarUsuario($request) {
        switch ($app) {
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->nivel = $this->getNivel();
        $cambiodireccion = 0;
        $nuevo = 0;

        if ($usuario) {
            $direccion = $usuario->getCaDireccion();

            $suc = $usuario->getSucursal()->getCaNombre();

            $this->direccion = $direccion;
            $this->suc = $suc;

            $recips = Doctrine::getTable("Usuario")
                            ->createQuery('r')
                            ->innerJoin('r.Sucursal s')
                            ->addWhere('s.ca_nombre = ?', $suc)
                            ->addWhere('r.ca_activo=?', true)
                            ->addWhere('r.ca_cargo=?', 'Jefe Dpto. Administrativo')
                            ->execute();

            $this->recips = $recips;
        }
        if (!($this->nivel == 0 and $request->getParameter("login") == $this->getUser()->getUserId())) {
            if (!($this->nivel > 1)) {
                $this->forward("users", "noAccess");
            }
        }
        if (!$usuario) {
            $nuevo = 1;
            $usuario = new Usuario();
            $usuario->setCaLogin($request->getParameter("login"));
        }

        if ($request->getParameter("nombre")) {
            $usuario->setCaNombre(ucwords(strtolower($request->getParameter("nombre"))));
        }

        if ($request->getParameter("cargo")) {
            $usuario->setCaCargo($request->getParameter("cargo"));
        }

        if ($request->getParameter("departamento")) {
            $usuario->setCaDepartamento($request->getParameter("departamento"));
        }

        if ($request->getParameter("idsucursal")) {
            $usuario->setCaIdsucursal($request->getParameter("idsucursal"));

            /*
             * FIX-ME: Se deben arreglar las opciones del prrograma donde se use el nombre de la sucursal */

            $sucursal = Doctrine::getTable("Sucursal")->find($request->getParameter("idsucursal"));
            $usuario->setCaSucursal($sucursal->getCaNombre());
        }

        if ($request->getParameter("email")) {
            $usuario->setCaEmail($request->getParameter("email"));
        }

        if ($request->getParameter("extension")) {
            $usuario->setCaExtension($request->getParameter("extension"));
        }

        if ($request->getParameter("auth_method")) {
            $usuario->setCaAuthmethod($request->getParameter("auth_method"));
        }

        if ($request->getParameter("passwd1") && $request->getParameter("passwd1") == $request->getParameter("passwd2")) {
            $usuario->setPasswd($request->getParameter("passwd1"));
        }

        if ($request->getParameter("activo")) {
            $usuario->setCaActivo(true);
        } else {
            $usuario->setCaActivo(false);
        }

        if ($request->getParameter("forcechange")) {
            $usuario->setCaForcechange(true);
        } else {
            $usuario->setCaForcechange(false);
        }       
        if (isset($_FILES['foto'])) {
            if (is_uploaded_file($_FILES['foto']['tmp_name'])) {

                $directory = $usuario->getDirectorio() . DIRECTORY_SEPARATOR;
                if (!is_dir($directory)) {
                    @mkdir($directory, 0777, true);
                }
                
                $nombre_archivo = $directory . 'foto.jpg';
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $nombre_archivo)) {
                    
                    // Obtener nuevos tamaños
                    list($ancho, $alto) = getimagesize($nombre_archivo);
                    $nuevo_ancho = 120;
                    $nuevo_alto = 150;

                    // Cargar
                    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                    $origen = imagecreatefromjpeg($nombre_archivo);

                    // Cambiar el tamaño
                    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                    // Imprimir
                    imagejpeg($thumb, $usuario->getDirectorio() . DIRECTORY_SEPARATOR . 'foto120x150.jpg', 100);

                    $nuevo_ancho = 60;
                    $nuevo_alto = 80;

                    // Cargar
                    $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
                    $origen = imagecreatefromjpeg($nombre_archivo);

                    // Cambiar el tamaño
                    imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

                    // Imprimir
                    imagejpeg($thumb, $usuario->getDirectorio() . DIRECTORY_SEPARATOR . 'foto60x80.jpg', 100);
                }
            }
        }
        if ($request->getParameter("cumpleanos")) {
            $usuario->setCaCumpleanos($request->getParameter("cumpleanos"));
        }

        if ($request->getParameter("fchingreso")) {
            $usuario->setCaFchingreso($request->getParameter("fchingreso"));
        }

        if ($request->getParameter("nombres")) {
            $usuario->setCaNombres($request->getParameter("nombres"));
        }

        if ($request->getParameter("apellidos")) {
            $usuario->setCaApellidos($request->getParameter("apellidos"));
        }

        if ($request->getParameter("teloficina")) {
            $usuario->setCaTeloficina($request->getParameter("teloficina"));
        }

        if ($request->getParameter("telparticular")) {
            $usuario->setCaTelparticular($request->getParameter("telparticular"));
        }

        if ($request->getParameter("telfamiliar")) {
            $usuario->setCaTelfamiliar($request->getParameter("telfamiliar"));
        }

        if ($request->getParameter("nombrefamiliar")) {
            $usuario->setCaNombrefamiliar($request->getParameter("nombrefamiliar"));
        }

        if ($request->getParameter("movil")) {
            $usuario->setCaMovil($request->getParameter("movil"));
        }

        if ($request->getParameter("manager")) {
            $usuario->setCaManager($request->getParameter("manager"));
        }

        $this->direccion = $request->getParameter("direccion");
        if ($request->getParameter("direccion")) {
            $usuario->setCaDireccion($request->getParameter("direccion"));
        }

        if ($request->getParameter("tiposangre")) {
            $usuario->setCaTiposangre($request->getParameter("tiposangre"));
        }
        if ($request->getParameter("parentesco")) {
            $usuario->setCaParentesco($request->getParameter("parentesco"));
        }
        $usuario->save();

        $this->usuario = $usuario;

        if ($nuevo == 0) {
            if ($direccion != $usuario->getCaDireccion()) {
                $user = Doctrine::getTable('Usuario')->find($this->getUser()->getUserId());

                $email = new Email();
                $email->setCaUsuenvio($this->getUser()->getUserId());
                $email->setCaTipo("Cambio de Direccion"); //Envío de Avisos
                $email->setCaIdcaso(null);

                $email->setCaFrom($user->getCaEmail());

                $email->setCaFromname($user->getCaNombre());

                $email->setCaReplyto($user->getCaEmail());

                foreach ($recips as $recip) {
                    if ($recip->getCaEmail()) {
                        $email->addTo(str_replace(" ", "", $recip->getCaEmail()));
                    }
                }

                $texto = 'El usuario ' . $usuario->getCaNombre() . ' cambió de dirección. Direccion Antigua: ' . $direccion . '   Direccion nueva: ' . $usuario->getCaDireccion();
                $email->setCaSubject('Cambio de Direccion');
                $email->setCaBody($texto);
                $email->setCaBodyhtml(Utils::replace($texto));
                $email->save();

                $cambiodireccion = $cambiodireccion + 1;

                //$email->send();
            }
        }
        $this->cambiodireccion = $cambiodireccion;
    }

    /*
     * Permite cambiar el password de un usuario que se autentica por BD
     */

    public function executeChangePasswd($request) {
        $this->form = new CambioClaveForm();

        if ($request->isMethod('post')) {

            $this->form->bind(
                    array(
                        'clave_ant' => $request->getParameter('clave_ant'),
                        'clave1' => $request->getParameter('clave1'),
                        'clave2' => $request->getParameter('clave2')
                    )
            );

            if ($this->form->isValid()) {
                $user = $this->getUser()->getUserId();
                $user = Doctrine::getTable("Usuario")->find($this->getUser()->getUserId());
                $user->setPasswd($this->getRequestParameter("clave1"));
                $user->setCaForcechange(false);
                $user->save();

                $this->getUser()->setAttribute('forcechange', false);

                $this->setTemplate("changePasswdOk");
            }
        }
    }

    /*
     *
     */

    public function executeFormPermisos($request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();

        switch ($app) {
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }

        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $accesos = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->innerJoin("a.Rutina r")
                        ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                        ->addWhere("r.ca_aplicacion = ?", $app)
                        ->execute();
        $this->accesos = array();
        foreach ($accesos as $acceso) {
            $this->accesos[$acceso->getCaRutina()] = $acceso->getCaAcceso();
        }

        $accesos = Doctrine::getTable("AccesoPerfil")
                        ->createQuery("a")
                        ->innerJoin("a.UsuarioPerfil up")
                        ->innerJoin("a.Rutina r")
                        ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                        ->addWhere("r.ca_aplicacion = ?", $app)
                        ->addOrderBy("a.ca_acceso")
                        ->execute();

        $this->accesosPerfil = array();
        foreach ($accesos as $acceso) {
            $perfil = $acceso->getPerfil();
            $this->accesosPerfil[$acceso->getCaRutina()]['nivel'] = $acceso->getCaAcceso();
            $this->accesosPerfil[$acceso->getCaRutina()]['perfil'] = $perfil->getCaNombre();
        }
    }

    /*
     *
     */

    public function executeGuardarPermisos($request) {
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);

        $accesos = Doctrine::getTable("AccesoUsuario")
                        ->createQuery("a")
                        ->where("a.ca_login= ? ", $this->usuario->getCaLogin())
                        ->execute();

        foreach ($accesos as $acceso) {
            $acceso->delete();
        }

        $accesosForm = $request->getParameter("acceso");
        $niveles = $request->getParameter("nivel");

        foreach ($accesosForm as $key => $accesoForm) {
            $acceso = new AccesoUsuario();
            $acceso->setCaLogin($this->usuario->getCaLogin());
            $acceso->setCaRutina($key);
            $acceso->setCaAcceso($niveles[$key]);
            $acceso->save();
        }

        $this->redirect("adminUsers/formUsuario?login=" . $this->usuario->getCaLogin());
    }

    /*
     *
     */

    public function executeFormPerfiles($request) {
        $this->usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($this->usuario);


        $this->perfiles = Doctrine::getTable("Perfil")
                        ->createQuery("p")
                        ->addOrderBy("p.ca_departamento")
                        ->addOrderBy("p.ca_nombre")
                        ->execute();


        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                        ->createQuery("up")
                        ->where("up.ca_login= ? ", $this->usuario->getCaLogin())
                        ->execute();


        $this->perfilesUsuario = array();
        foreach ($perfilesUsuario as $perfilUsuario) {
            $this->perfilesUsuario[] = $perfilUsuario->getCaPerfil();
        }
    }

    /*
     *
     */

    public function executeGuardarPerfiles($request) {
        $usuario = Doctrine::getTable("Usuario")->find($request->getParameter("login"));
        $this->forward404Unless($usuario);

        $perfilesUsuario = Doctrine::getTable("UsuarioPerfil")
                        ->createQuery("up")
                        ->where("up.ca_login= ? ", $usuario->getCaLogin())
                        ->execute();

        foreach ($perfilesUsuario as $perfilUsuario) {
            $perfilUsuario->delete();
        }

        $perfiles = $request->getParameter('perfiles');

        foreach ($perfiles as $perfil) {
            $perfilObj = new UsuarioPerfil();
            $perfilObj->setCaLogin($usuario->getCaLogin());
            $perfilObj->setCaPerfil($perfil);
            $perfilObj->save();
        }

        $this->redirect("adminUsers/formUsuario?login=" . $usuario->getCaLogin());
    }

    public function executeListaExtensiones(sfWebRequest $request) {
        $this->setLayout("layout2col");
        $this->user = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->nivel = $this->getNivel();
        $criterio = $request->getParameter('criterio');
        $empresa = $request->getParameter('empresa');
        $sucursal = utf8_decode($request->getParameter("idsucursal"));
        $departamento = $request->getParameter("departamento");

        $q = Doctrine::getTable('Usuario')
                        ->createQuery('u')
                        ->innerJoin('u.Sucursal s')
                        ->innerJoin('s.Empresa e')
                        ->addWhere('u.ca_activo = ?', true);

        if ($criterio) {
            switch ($criterio) {
                case "buttondirnal":
                    $q->addOrderBy("e.ca_nombre");
                    $q->addOrderBy("u.ca_idsucursal");
                    $q->addOrderBy("u.ca_departamento");
                    $q->addOrderBy("u.ca_nombres");
                    break;
                case "buttoncom":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addOrderBy("u.ca_idsucursal");
                    $q->addOrderBy("u.ca_departamento");
                    break;
                case "buttonsuc":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addWhere('(u.ca_idsucursal) LIKE ?', $sucursal);
                    $q->addOrderBy("u.ca_departamento");
                    break;
                case "buttondep":
                    $q->addWhere('e.ca_idempresa = ?', $empresa);
                    $q->addWhere('(u.ca_idsucursal) LIKE ?', '%' . $sucursal . '%');
                    $q->addWhere('(u.ca_departamento) LIKE ?', $departamento);
                    $q->addOrderBy("u.ca_sucursal");
                    break;
            }
            $q->distinct();
            $this->usuarios = $q->execute();
            $this->criterio = $criterio;
        }
    }

    public function executeLogin($request) {
        //header("Location: /users/login");
        //exit();
        //echo "login".session_id();
        //$response = sfContext::getInstance()->getResponse();
        //$response->addStylesheet("login");

        if ($this->getUser()->isAuthenticated()) {
            $this->redirect("homepage/index");
        }

        $this->form = new LoginForm();
        if ($request->isMethod('post')) {
            $this->form->bind(
                    array(
                        'username' => $request->getParameter('username'),
                        'passwd' => $request->getParameter('passwd')
                    )
            );
            if ($this->form->isValid()) {
                //Se valido correctamente
                $this->redirect("homepage/index");
                //echo "OK";
            }
        }

        $this->setLayout("login");
    }

    public function executeLogout($request) {
        $this->getUser()->signOut();
        $this->redirect("adminUsers/login");
    }

    public function executeMainUsers(sfWebRequest $request) {
        $this->setLayout("layout2col");
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();
    }

    public function executePhoneBook(sfWebRequest $request) {

        $this->setLayout("layout2col");
        $this->criterio = $request->getParameter('criterio');

        $this->sucursales = Doctrine::getTable("Sucursal")
                        ->createQuery("s")
                        ->select("s.ca_idsucursal, s.ca_idempresa, s.ca_nombre")
                        ->innerJoin('s.Empresa e')
                        ->addOrderBy("s.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        foreach ($this->sucursales as $key => $val) {
            $this->sucursales[$key]["ca_nombre"] = utf8_encode($this->sucursales[$key]["ca_nombre"]);
        }

        $this->departamentos = Doctrine::getTable("Departamento")
                        ->createQuery("d")
                        ->select("d.ca_idempresa, d.ca_nombre")
                        ->innerJoin('d.Empresa e')
                        ->addOrderBy("d.ca_nombre")
                        ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                        ->execute();

        // Cambiar los campos NULOS que están con tílde a campos codificados.
        foreach ($this->departamentos as $key => $val) {
            $this->departamentos[$key]["ca_nombre"] = utf8_encode($this->departamentos[$key]["ca_nombre"]);
        }

        $this->empresas = Doctrine::getTable("Empresa")
                        ->createQuery("e")
                        ->addWhere('e.ca_activo=?', true)
                        ->addOrderBy("e.ca_nombre")
                        ->execute();
    }

    public function executeNoAccess($request) {

    }

    public function executeTraerImagen($request) {
        $username = $request->getParameter('username');
        $tamano = $request->getParameter('tamano');

        $user = Doctrine::getTable('Usuario')->find($username);

        $this->imagen = $user->getImagen($tamano);
    }

    public function executeViewOrganigrama(sfWebRequest $request) {
        $this->setLayout("layout2col");
        $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->forward404Unless($this->manager);

        $this->usuarios = $this->manager->getSubordinado();

        if (count($this->usuarios) == 0) {
            $this->manager = $this->manager->getManager();
            $this->usuarios = $this->manager->getSubordinado();
        }
    }

    public function executeViewUser(sfWebRequest $request) {

        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        switch ($app) {
            case "intranet":
                $this->setLayout("layout2col");
                break;
        }
        $this->userinicio = sfContext::getInstance()->getUser();
        $this->nivel = $this->getNivel();

        $this->user = Doctrine::getTable('Usuario')->find($request->getParameter('login'));

        $this->manager = Doctrine::getTable('Usuario')->find($request->getParameter('login'));
        $this->manager = $this->manager->getManager();

        //Obtiene direccion desde e-directory
        $ldap_server = sfConfig::get("app_ldap_host");
        $auth_user = "cn=" . sfConfig::get("app_ldap_user") . ",o=coltrans_bog";
        $passwd = sfConfig::get("app_ldap_passwd");

        $this->addresses = array();
        if ($connect = ldap_connect($ldap_server)) {
            if ($bind = ldap_bind($connect, $auth_user, $passwd)) {
                $searchString = "(&(cn=" . $request->getParameter('login') . "))";
                $sr = ldap_search($connect, "o=coltrans_bog", $searchString, array("networkAddress"));
                $entry = ldap_first_entry($connect, $sr);
                $attrs = ldap_get_attributes($connect, $entry);
                $result = $attrs["networkAddress"];
                foreach ($result as $key => $val) {
                    if (trim($key) != "count") {
                        $this->addresses[] = Utils::LDAPNetAddr($val);
                    }
                }
            }
        }
    }

    public function executeSearch(sfWebRequest $request) {

        $this->setLayout("layout2col");
        $query = trim($request->getParameter('buscar'));

        //$query = str_replace(' ', ' and ', $query);
        //$query = $query.'*';

        $queryarray=explode(' ',$query);

        foreach($queryarray as $key=>$value){
            if(strlen($queryarray[$key])>=3){
                $queryarray[$key].='*';
            }
        }

        $query = implode(' and ', $queryarray);


        //echo $query;
        $this->forwardUnless($query, "homepage", "index");

        $this->usuarios = Doctrine_Core::getTable('Usuario') ->getForLuceneQuery($query);
    }

}

?>