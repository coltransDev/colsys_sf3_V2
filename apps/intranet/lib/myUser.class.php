<?php

class myUser extends sfBasicSecurityUser {

    public function getUserId() {
        return $this->getAttribute('user_id');
    }

    public function signIn($login) {
        $this->setAuthenticated(true);
        $this->setUserId($login);
        $this->log("Login Intranet");
    }

    public function signOut() {

        $this->setAttribute('user_id', null);


        $this->setAuthenticated(false);
        $this->clearCredentials();
        //session_destroy();
    }

    public function getNivelAcceso($rutina) {
        $usuario = Doctrine::getTable('Usuario')->createQuery('u')->where('u.ca_login = ? ', $this->getUserId())->fetchOne();
        if ($usuario) {
            return $usuario->getNivelAcceso($rutina);
        }
    }

    public function getMenu() {
        
    }

    public function setUserId($userId) {
        $this->setAttribute('user_id', $userId);
        $user = Doctrine::getTable("Usuario")->find($userId);

        if ($user) {
            //$sucursal = $user->getSucursal();
            $this->setAttribute('idsucursal', $user->getCaIdsucursal());            
            $this->setAttribute('nombre', $user->getCaNombre());
            $this->setAttribute('email', $user->getCaEmail());
            $this->setAttribute('cargo', $user->getCaCargo());
            $this->setAttribute('extension', $user->getCaExtension());
            $this->setAttribute('nombres', $user->getCaNombres());
            $this->setAttribute('forcechange', $user->getCaForcechange());

            $departamento = Doctrine::getTable("Departamento")
                    ->createQuery("d")
                    ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                    ->fetchOne();
            
            $sucursal = Doctrine::getTable("Sucursal")
                    ->createQuery("s")
                    ->where("s.ca_idsucursal = ?", $user->getCaIdsucursal())
                    ->fetchOne();
            
            if($sucursal){
                $this->setAttribute('idempresa', $sucursal->getCaIdempresa());
                $this->setAttribute('sucursal', $sucursal->getCaNombre());
            }
            if ($departamento) {
                $this->setAttribute('iddepartamento', $departamento->getCaIddepartamento());
            }
        }
    }

    public function getNombre() {
        return $this->getAttribute('nombre');
    }

    public function getSucursal() {
        return $this->getAttribute('idsucursal');
    }
    
    public function getSucursalNombre() {
        return $this->getAttribute('sucursal');
    }

    public function getNombres() {
        return $this->getAttribute('nombres');
    }

    public function getIddepartamento() {
        return $this->getAttribute('iddepartamento');
    }

    public function getIdempresa() {
        return $this->getAttribute('idempresa');
    }
    
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
              ->addWhere("r.ca_aplicacion =  ? ", $app)
              ->addOrderBy("r.ca_grupo ASC")
              ->addOrderBy("r.ca_opcion ASC")
              ->distinct()
              ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
              ->execute();

      $grupos = array();
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
   
   public function signInLDAP($username) {
      $user = Doctrine::getTable("Usuario")->find($username);

      if ($user) {
         $this->setAttribute('user_id', $username);
         $this->setAuthenticated(true);
         $this->addCredential('colsys_user');
         $this->setCulture('es_CO');

         $sucursal = $user->getSucursal();
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
                 ->where("d.ca_nombre = ?", $user->getCaDepartamento())
                 ->fetchOne();
         if ($departamento) {
            $this->setAttribute('iddepartamento', $departamento->getCaIddepartamento());
         }

         $trafico = Doctrine::getTable("Trafico")->find($idtrafico);

         if ($trafico) {
            $this->setAttribute('idmoneda', $trafico->getCaIdmoneda());
         }

         $this->log("Login LDAP");
      }
   }
   
   public function signInAlternative($username) {
      $user = Doctrine::getTable("Usuario")->find($username);

      if ($user) {

         $this->setAttribute('user_id', $username);
         $this->setAuthenticated(true);
         $this->addCredential('colsys_user');
         $this->setCulture('es_CO');

         $sucursal = $user->getSucursal();
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


         $trafico = Doctrine::getTable("Trafico")->find($idtrafico);

         if ($trafico) {
            $this->setAttribute('idmoneda', $trafico->getCaIdmoneda());
         }

         $this->log("Login SHA1");
      }
   }
   
   public function log($event, $params = false) {

      $log = new UsuarioLog();
      $log->setCaLogin($this->getUserId());
      $log->setCaFchevento(date("Y-m-d H:i:s"));
      if (!$params) {
         $log->setCaUrl($_SERVER['REQUEST_URI']);
      } else {
         $log->setCaUrl($_SERVER['REQUEST_URI'] . $this->serializeArray($_POST));
      }

      $log->setCaEvent($event);
      $log->setCaIpaddress($_SERVER['REMOTE_ADDR']);
      $log->setCaUseragent($_SERVER['HTTP_USER_AGENT']);
      $log->save();
   }

}
