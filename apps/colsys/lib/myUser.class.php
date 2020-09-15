<?php

class myUser extends sfBasicSecurityUser {

    public function signIn($login) {
        $this->setAuthenticated(true);
        $this->setAttribute('user_id', $login);
        $this->setAttribute('niveles', null);
        $this->setAttribute('permisos', null);
    }

    public function __toString() {
        return $this->getUserId();
    }

    public function getUserId() {
        return $this->getAttribute('user_id');
    }

    public function getEmail() {
        return $this->getAttribute('email');
    }

    public function getNombre() {
        return $this->getAttribute('nombre');
    }

    public function getIdSucursal() {
        return $this->getAttribute('idsucursal');
    }

    public function getIdmoneda() {
        return $this->getAttribute('idmoneda');
    }

    public function getIddepartamento() {
        return $this->getAttribute('iddepartamento');
    }

    public function getIdciudad() {
        return $this->getAttribute('idciudad');
    }

    public function getCargo() {
        return $this->getAttribute('cargo');
    }

    public function getExtension() {
        return $this->getAttribute('extension');
    }

    public function getIdtrafico() {
        return ($this->getAttribute('idtrafico')) ? $this->getAttribute('idtrafico') : "CO-057";
    }

    public function getIdempresa() {
        return $this->getAttribute('idempresa');
    }

    public function getDatos($dato = null) {

        if ($dato) {
            $d = json_decode($this->getAttribute('datos'));

            eval("\$v= \$d->" . $dato . ";");
            return $v;
        }
        return $this->getAttribute('datos');
    }

    public function setDatos($dato = null) {
        if ($dato) {
            $this->setAttribute("datos", $dato);
        }
    }

    public function getNivelAcceso($rutina) {

        $niveles = $this->getAttribute('niveles');
        if (!isset($niveles[$rutina])) {
            $usuario = Doctrine::getTable('Usuario')
                    ->createQuery('u')
                    ->select("ca_login")
                    ->where('u.ca_login = ? ', $this->getUserId())->fetchOne();
            
            if ($usuario) {
                $niveles[$rutina] = $usuario->getNivelAcceso($rutina);
                //$niveles[$rutina] = 10;
                $this->setAttribute('niveles', $niveles);
            } else
                $this->setAttribute('niveles', '');
        }

        return $niveles[$rutina];
    }

    public function getGrupos() {
        return $this->getAttribute('grupos');
    }

    public function setGrupos($grupos) {
        $this->setAttribute('grupos', $grupos);
    }

    public function getSucursal() {
        return $this->getAttribute('idsucursal');
    }

    /**
     * @autor Carlos G. López M.
     * @return entero que corresponde a la sumatoria de los niveles de acceso que tiene un usuario, 
     *         por asignación directa a su login y por su perfil
     * @param  $rutina : entero con el id de la rutina
     * @date:  2016-05-02
     */
    public function getAccesosRutina($rutina) {
        $permisos = $this->getAttribute('permisos')?$this->getAttribute('permisos'):array();
        $permisos = array(); /* FIX-ME Guardar nuevamente los accesos en la sesion*/
        if (!$permisos[$rutina]){
            $sql = "select distinct us.ca_login, au.ca_rutina, au.ca_acceso, false as ca_denegar"
                    . "  from control.tb_usuarios us"
                    . "  inner join control.tb_accesos_user au on au.ca_login = us.ca_login"
                    . "  where us.ca_login = '" . $this->getUserId() . "' and au.ca_rutina = $rutina "
                    . "union "
                    . "select distinct us.ca_login, au.ca_rutina, au.ca_denegar as ca_acceso, true as ca_denegar"
                    . "  from control.tb_usuarios us"
                    . "  inner join control.tb_accesos_user au on au.ca_login = us.ca_login "
                    . "  where us.ca_login = '" . $this->getUserId() . "' and au.ca_rutina = $rutina "
                    . "union "
                    . "select distinct us.ca_login, ap.ca_rutina, ap.ca_acceso, false as ca_denegar"
                    . "  from control.tb_usuarios us"
                    . "  inner join control.tb_usuarios_perfil up on up.ca_login = us.ca_login"
                    . "  inner join control.tb_accesos_perfiles ap on ap.ca_perfil = up.ca_perfil"
                    . "  where us.ca_login = '" . $this->getUserId() . "' and ap.ca_rutina = $rutina ";
            $con = Doctrine_Manager::getInstance()->connection();
            $st = $con->execute($sql);
            
            $acceso_usuario = $st->fetchAll();
            $acceso_total = 0;
            foreach ($acceso_usuario as $key => $acceso) {
                if ($acceso["ca_acceso"] !== 0) {
                    if ($acceso["ca_denegar"]) {
                        //$acceso_total = $acceso_total & ~$acceso["ca_acceso"];
                    } else {
                        $acceso_total = $acceso_total | $acceso["ca_acceso"];
                    }
                    
                }
            }
            $permisos[$rutina] = $acceso_total;
            $this->setAttribute('permisos', $permisos);
        }
        return $permisos[$rutina];
    }

    /**
     * @autor Carlos G. López M.
     * @return arreglo con todos los niveles de accesos de una rutina
     * @param  $rutina : entero con el id de la rutina
     * @date:  2016-05-02
     */
    public function getAccesoTotalRutina($rutina) {
        $rutinas = ($this->getAttribute('rutinas')?$this->getAttribute('rutinas'):array());
        if (!$rutinas[$rutina]){
            $acceso_rutina = array();
            $rutinasNiveles = Doctrine::getTable("RutinaNivel")
                    ->createQuery("n")
                    ->select("ca_nivel,ca_valor")
                    ->where("n.ca_rutina >= 200")
                    ->andWhere("n.ca_rutina = ?", $rutina)
                    ->execute();
            foreach ($rutinasNiveles as $acceso) {
                $acceso_rutina[$acceso->getCaNivel()] = $acceso->getCaValor();
            }
            $rutinas[$rutina] = $acceso_rutina;
            $this->setAttribute('rutinas', $rutinas);
        }

        return $rutinas[$rutina];
    }

    /**
     * @autor Carlos G. López M.
     * @return arreglo de permisos de un usuario, por cada opción de una rutina
     * @param  $rutina : entero con el id de la rutina
     * @date:  2016-05-02
     */
    public function getControlAcceso($rutina) {
        $acceso_usuario = $this->getAccesosRutina($rutina);
        $acceso_rutina = $this->getAccesoTotalRutina($rutina);
        
        $acceso_total = 0;
        foreach ($acceso_rutina as $key => $valor) {
            $acceso_total += pow(2, $key);
        }
        
        $opciones = array();
        $control = array_reverse(str_split(Utils::validacionBinaria($acceso_usuario, $acceso_total)));
        foreach ($control as $key => $bit) {
            if ($bit) {
                $opciones[$key] = $acceso_rutina[$key];
            }
        }
        return $opciones;
    }
    
    /**
     * @autor Andrea L. Ramírez C.
     * @return true o false // Acceso o no al método
     * @param  $permisos : arreglo con los permisos dados al usuario
     * @param  $bit : bit con el permiso solicitado
     * @date:  2017-02-28
     */
    public function getControlAccesoMetodo($permisos, $bit) {
        
        $acceso = false;        
        if(array_key_exists($bit, $permisos)){
            $acceso = true;
        }        
        return $acceso;
    }


    /*
     * Añade un archivo en la lista de archivos del usuario para enviar por correo 
     * o realizar otras tareas
     */

    public function addFile($file) {

        $userFiles = $this->getAttribute('userFiles');

        $idx = md5(count($userFiles) . time() . rand());

        $userFiles[$idx] = base64_encode($file);

        $this->setAttribute('userFiles', $userFiles);
        return $idx;
    }

    /*
     * Retorna un archivo en la lista de archivos del usuario para enviar por correo 
     * o realizar otras tareas
     */

    public function getFile($k) {
        $userFiles = $this->getAttribute('userFiles');
        if (isset($userFiles[$k])) {
            return base64_decode($userFiles[$k]);
        }
    }

    /*
     * Retorna todos los archivos en la lista de archivos del usuario para enviar por correo 
     * o realizar otras tareas
     */

    public function getFiles() {
        $files = $this->getAttribute('userFiles');

        foreach ($files as $key => $file) {
            $files[$key] = base64_decode($files[$k]);
        }

        return $this->getAttribute('userFiles');
    }

    /*
     * Borra todos los archivos en la lista de archivos del usuario para enviar por correo 
     * o realizar otras tareas
     */

    public function clearFiles() {
        $this->setAttribute('userFiles', array());
    }

    /*
     * Registra un evento para el usuario
     */

    public function log($event, $params = false,$data=array()) {

        $log = new UsuarioLog();
        $log->setCaLogin($this->getUserId());
        $log->setCaFchevento(date("Y-m-d H:i:s"));
        if (!$params) {
            $log->setCaUrl($_SERVER['REQUEST_URI']);
        } else {
            $log->setCaUrl($_SERVER['REQUEST_URI'] . $this->serializeArray($_POST));
        }
        if($data["url"])
            $log->setCaUrl($data["url"]);

        $log->setCaEvent($event);
        $log->setCaIpaddress($_SERVER['REMOTE_ADDR']);
        if($data["agent"])
            $log->setCaUseragent($data["agent"]);
        else
            $log->setCaUseragent($_SERVER['HTTP_USER_AGENT']);        
        $log->save();
    }

    public function serializeArray($array) {

        $keys = array_keys($array);
        $parameters = "";
        foreach ($keys as $key) {
            $parameters .= $key . "/" . $array[$key] . "/";
        }
        return $parameters;
    }

    /*
     * Inicia la sesion y verifica a los grupos a los que pertenece
     *  el usuario el el directorio LDAP
     */

    public function signInLDAP($username) {
        //$user = Doctrine::getTable("Usuario")->find($username);
        $user = Doctrine::getTable("Usuario")
            ->createQuery("u")
            ->select("ca_login,ca_idsucursal,ca_nombre,ca_email,ca_cargo,ca_extension,ca_authmethod,ca_departamento")
            ->where("u.ca_login = ?", $username)
            ->fetchOne();

        if ($user) {
            $this->setAttribute('user_id', $username);
            $this->setAuthenticated(true);
            $this->addCredential('colsys_user');
            $this->setCulture('es_CO');

            //$sucursal = $user->getSucursal();
            $this->setAttribute('idsucursal', $user->getCaIdsucursal());
            $this->setAttribute('nombre', $user->getCaNombre());
            $this->setAttribute('email', $user->getCaEmail());
            $this->setAttribute('cargo', $user->getCaCargo());
            $this->setAttribute('extension', $user->getCaExtension());
            $idtrafico = $user->getSucursal()->getEmpresa()->getCaIdtrafico();
            $this->setAttribute('idtrafico', $idtrafico);
            $this->setAttribute('idempresa', $user->getSucursal()->getEmpresa()->getCaIdempresa());
            $this->setAttribute('authmethod', $user->getCaAuthmethod());
            $this->setAttribute('forcechange', false);
            $this->setAttribute('niveles', null);

            $departamento = Doctrine::getTable("Departamento")
                    ->createQuery("d")
                    ->select("ca_iddepartamento")
                    ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                    ->fetchOne();
            if ($departamento) {
                $this->setAttribute('iddepartamento', $departamento->getCaIddepartamento());
            }

            //$trafico = Doctrine::getTable("Trafico")->find($idtrafico);
            $trafico = Doctrine::getTable("Trafico")
                    ->createQuery("t")
                    ->select("ca_idmoneda")
                    ->where("t.ca_idtrafico = ?", $idtrafico)
                    ->fetchOne();

            if ($trafico) {
                $this->setAttribute('idmoneda', $trafico->getCaIdmoneda());
            }

            $ciudad = Doctrine::getTable("Ciudad")
                    ->createQuery("c")
                    ->select("ca_idciudad")
                    ->where("c.ca_ciudad = ?", $user->getSucursal()->getCaNombre())
                    ->fetchOne();
            if ($ciudad) {
                $this->setAttribute('idciudad', $ciudad->getCaIdciudad());
            }

            $this->log("Login LDAP");
        }
    }

    /*
     * Inicia la sesion usando un metodo alternativo para usarios sin novell
     */

    public function signInAlternative($username) {
        //$user = Doctrine::getTable("Usuario")->find($username);
        $user = Doctrine::getTable("Usuario")
            ->createQuery("u")
            ->select("ca_login,ca_idsucursal,ca_nombre,ca_email,ca_cargo,ca_extension,ca_authmethod,ca_departamento,ca_forcechange")
            ->where("u.ca_login = ?", $username)
            ->fetchOne();

        if ($user) {

            $this->setAttribute('user_id', $username);
            $this->setAuthenticated(true);
            $this->addCredential('colsys_user');
            $this->setCulture('es_CO');

            //$sucursal = $user->getSucursal();
            $this->setAttribute('idsucursal', $user->getCaIdsucursal());
            $this->setAttribute('nombre', $user->getCaNombre());
            $this->setAttribute('email', $user->getCaEmail());
            $this->setAttribute('cargo', $user->getCaCargo());
            $this->setAttribute('extension', $user->getCaExtension());
            $idtrafico = $user->getSucursal()->getEmpresa()->getCaIdtrafico();
            $this->setAttribute('idtrafico', $idtrafico);
            $this->setAttribute('idempresa', $user->getSucursal()->getEmpresa()->getCaIdempresa());
            $this->setAttribute('authmethod', $user->getCaAuthmethod());
            $this->setAttribute('forcechange', $user->getCaForcechange());
            $this->setAttribute('niveles', null);

            $departamento = Doctrine::getTable("Departamento")
                    ->createQuery("d")
                    ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                    ->fetchOne();
            if ($departamento) {
                $this->setAttribute('iddepartamento', $departamento->getCaIddepartamento());
            }

            $trafico = Doctrine::getTable("Trafico")
                    ->createQuery("t")
                    ->select("ca_idmoneda")
                    ->where("t.ca_idtrafico = ?", $idtrafico)
                    ->fetchOne();

            if ($trafico) {
                $this->setAttribute('idmoneda', $trafico->getCaIdmoneda());
            }

            $ciudad = Doctrine::getTable("Ciudad")
                    ->createQuery("c")
                    ->select("ca_idciudad")
                    ->where("c.ca_ciudad = ?", $user->getSucursal()->getCaNombre())
                    ->fetchOne();
            if ($ciudad) {
                $this->setAttribute('idciudad', $ciudad->getCaIdciudad());
            }

            $this->log("Login SHA1");
        }
    }

    /*
     * Cierra la sesion
     */

    public function signOut() {
        //setcookie("menu", false, time()+3600);

        $this->setAuthenticated(false);

        $this->setAttribute('user_id', null);
        $this->setAttribute('nombre', null);
        $this->setAttribute('email', null);
        $this->setAttribute('cargo', null);
        $this->setAttribute('extension', null);
        $this->setAttribute('idtrafico', null);
        $this->setAttribute('idempresa', null);
        $this->setAttribute('iddepartamento', null);
        $this->setAttribute('idciudad', null);
        $this->setAttribute('authmethod', null);
        $this->setAttribute('menu', null);
        $this->setAttribute('niveles', null);

        //setcookie("JSESSIONID", "" );	
        $cache = myCache::getInstance();
        $cookie = isset($_COOKIE["colsys"]) ? $_COOKIE["colsys"] : "";
        list($session_id, $signature) = explode(':', $cookie, 2);
        $cache->set($session_id . "_menu", "");

        $this->setAuthenticated(false);
        $this->clearCredentials();
        //session_destroy();
    }

    /*
     * Recrea el menu y lo almacena en cache
     */

    public function buildMenu() {
        $app = sfContext::getInstance()->getConfiguration()->getApplication();
        $rutinas = Doctrine::getTable("Rutina")
                ->createQuery("r")
                ->select('r.*')
                ->leftJoin("r.AccesoPerfil ap")
                ->leftJoin("ap.UsuarioPerfil up")
                ->leftJoin("r.AccesoUsuario au")
                ->where(" (up.ca_login = ? or au.ca_login = ? )", array($this->getUserId(), $this->getUserId()))
                ->addWhere(" (ap.ca_acceso >= ? or ap.ca_acceso IS NULL )", 0)
                ->addWhere(" (au.ca_acceso >= ? or au.ca_acceso IS NULL )", 0)
                ->addWhere("r.ca_aplicacion =  ? AND r.ca_visible = ? ", array($app,true))                
                ->addOrderBy("r.ca_grupo ASC")
                ->addOrderBy("r.ca_opcion ASC")
                ->distinct()
                ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
                ->execute();

        $grupos = array();
        //echo "<pre>";print_r($rutinas);echo "</pre>";
        foreach ($rutinas as $rutina) {
            if (!isset($grupos[$rutina["ca_grupo"]])) {
                $grupos[$rutina["ca_grupo"]] = array();
            }
            $grupos[$rutina["ca_grupo"]][] = $rutina;
        }

        $cache = myCache::getInstance();
        $cookie = $_COOKIE["colsys"];
        list($session_id, $signature) = explode(':', $cookie, 2);
        $cache->set($session_id . "_menu", $grupos);
        return $grupos;
    }

    public function getMenu() {
        $cache = myCache::getInstance();
        $cookie = $_COOKIE["colsys"];
        list($session_id, $signature) = explode(':', $cookie, 2);
        $menu = $cache->get($session_id . "_menu", null);
        if (!$menu) {
            $menu = $this->buildMenu();
        }
        return $menu;
    }

}
?>