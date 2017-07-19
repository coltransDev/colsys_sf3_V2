<?php
 
/**
 * users actions.
 *
 * @package    colsys
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class usersActions extends sfActions
{
	const RUTINA = "1";
	const RUTINA_CONTROL = "72";
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex($request)
	{
		$this->forward('users', 'login');
	}
  
	/**
	* Muestra un formulario donde un usuario puede iniciar sesion
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogin(sfWebRequest $request)
	{
        
        //header("Location: /users/login");
        //exit();
		
		$response = sfContext::getInstance()->getResponse();
		$response->addStylesheet("login");
		
		if($this->getUser()->isAuthenticated()){
			$this->redirect("homepage/index");
		}


        if( $request->isMethod("get")){            
            $this->getUser()->setAttribute("path_info", $request->getPathInfo());
            $this->getUser()->setAttribute("request_parameters", $request->getGetParameters());
        }



					
		$this->form = new LoginForm();		
		if ($request->isMethod('post')){		
			$this->form->bind(
				array(						
						'username' => $request->getParameter('username'),
						'passwd' => $request->getParameter('passwd')		
					)
				); 
			if( $this->form->isValid() ){	
				//Se valido correctamente                
                if( $this->getUser()->getAttribute("path_info") && $this->getUser()->getAttribute("path_info")!="/users/logout"){
                    $url = $this->getUser()->getAttribute("path_info");
                    $params = $this->getUser()->getAttribute("request_parameters");
                    
                    $p = "";
                    $i=0;
                    foreach( $params as $key=>$val ){
                        if( $i++==0 ){
                            $p.="?";
                        }else{
                            $p.="&";
                        }

                        $p.=$key."=".$val;
                        $request->setParameter($key, $val);
                    }
                    
                    $url.= $p;                   
                   
                }else{
                    $url = "homepage/index";
                }
                
                
               
                
				$this->redirect( $url );
				//echo "OK";	
			}
		}
		
		$this->setLayout("login");
	}
	
    public function executePermisosExt5(sfWebRequest $request) {
        
    }

    public function executeDatosBusqueda(sfWebRequest $request) {
        $parametro = $request->getParameter("q");
        $mayus = strtoupper($parametro);


        $sql = "select * from";
        $sql .= "(";
        $sql .= "select ca_rutina::varchar(50) as ca_id , ca_opcion as ca_nombre ,'rutina' as ca_tipo,ca_descripcion as ca_comentario from control.tb_rutinas ";
        $sql .= "UNION select ca_login as ca_id,ca_nombre , 'usuario' as ca_tipo,ca_cargo as ca_comentario  from control.tb_usuarios ";
        $sql .= "UNION select ca_perfil as ca_id, ca_nombre, 'perfil' as ca_tipo,ca_descripcion as ca_comentario from control.tb_perfiles ";
        $sql .= ") as data ";
        $sql .= " WHERE upper (ca_nombre ) like '%$mayus%'";
        $sql .= " ORDER BY ca_nombre ASC";
        $q = Doctrine_Manager::getInstance()->connection();

        $stmt = $q->execute($sql);

        $listas = $stmt->fetchAll();


        $data = array();
        foreach ($listas as $lista) {
            $data[] = array(
                "id" => utf8_encode($lista["ca_id"]),
                "ca_nombre" => utf8_encode($lista["ca_nombre"])." (".utf8_encode($lista["ca_tipo"]).")",
                "ca_tipo" => utf8_encode($lista["ca_tipo"]),
                "ca_comentario" => utf8_encode($lista["ca_comentario"])
            );
        }

        $this->responseArray = array("success" => true, 'root' => $data,"debug"=>$sql);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGrupo(sfWebRequest $response) {
        $q = Doctrine::getTable("Rutina")
                ->createQuery("s")
                ->select("DISTINCT s.ca_grupo")
                ->addOrderBy("s.ca_grupo")
                ->setHydrationMode(Doctrine::HYDRATE_SCALAR);
        $grupos = $q->execute();

        $data = array();

        foreach ($grupos as $grupo) {
            $data[] = array("grupo" => utf8_encode($grupo["s_ca_grupo"]));
        }
        $this->responseArray = array("success" => true, "root" => $data);
        $this->setTemplate("responseTemplate");
    }

	/**
	* Muestra un formulario donde un usuario puede iniciar sesion
	*
	* @param sfRequest $request A request object
	*/
	public function executeLogout($request)
	{
		$this->getUser()->signOut();
		$this->redirect("users/login");
	}
		
		
	/*
	* Administración de rutinas
	*/
	public function executeAdminRutinas(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );
			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
		
		
		$response = sfContext::getInstance()->getResponse();
		$response->addJavaScript("extExtras/CheckColumn",'last');
		
		$this->data = array();
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn( RutinaPeer::CA_GRUPO );
		$c->addAscendingOrderByColumn( RutinaPeer::CA_OPCION );
		$rutinas = RutinaPeer::doSelect( $c );
		foreach(  $rutinas as $rutina ){
			
			$row = array(			 
				'rutina'=>"".$rutina->getCaRutina(),
				'grupo'=>utf8_encode($rutina->getCaGrupo()),
				'opcion'=>utf8_encode($rutina->getCaOpcion()),
				'programa'=>utf8_encode($rutina->getCaPrograma()),
				'descripcion'=>utf8_encode($rutina->getCaDescripcion())
			);
			
			$this->data[] = $row;
		}		
	}
	
	/*
	* guarda los cambios en las rutinas 
	*/
	public function executeObserveAdminRutinas(){
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
	
		$rutina = $this->getRequestParameter( 'rutina' );
		$grupo = $this->getRequestParameter( 'grupo' );
		$opcion = $this->getRequestParameter( 'opcion' );
		$programa = $this->getRequestParameter( 'programa' );
		$descripcion = $this->getRequestParameter( 'descripcion' );
		$id = $this->getRequestParameter( 'id' );
		
		$rutinaObj = RutinaPeer::retrieveByPk( $rutina );
		
		if( !$rutinaObj ){
			$rutinaObj = new Rutina();	
			$rutinaObj->setCaRutina( RutinaPeer::getConsecutivo() );
		}	
		
		if( $grupo ){
			$rutinaObj->setCaGrupo( $grupo );
		}
		
		if( $opcion ){
			$rutinaObj->setCaOpcion( $opcion );
		}
		
		if( $programa ){
			$rutinaObj->setCaPrograma( $programa );
		}
		
		if( $descripcion ){
			$rutinaObj->setCaDescripcion( $descripcion );
		}
		$rutinaObj->save();
		$this->responseArray = array("id"=>$id, "rutina"=>$rutinaObj->getCaRutina());
		
	}
	
	public function executeEliminarAdminRutina(){
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<2 ){
			$this->forward404();
		}
		
		$rutina = $this->getRequestParameter( 'rutina' );	
		$rutinaObj = RutinaPeer::retrieveByPk( $rutina );
		if( $rutinaObj ){
			$rutinaObj->delete(); 
		}
		return sfView::NONE;
	}
	
	/******************************************************************
	* Administración de usuarios y grupos
	*
	*******************************************************************/
		
	/*
	* Muestra una lista de usuarios y grupos con un checkbox 
	* para seleccionar los permisos
	*/
	public function executePermisosRutinas(){
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel==-1 ){
			$this->forward404();
		}
				
		$this->setLayout("ajax");
		
		$this->rutina = RutinaPeer::retrieveByPk($this->getRequestParameter("rutina"));
		$this->forward404Unless( $this->rutina );		
	}
	
	/*
	* Guarda los accesos de un grupo y su nivel de acceso a cada opción
	*/
	public function executeObserveRutinasGrupos(){
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
		$grupos=$this->getRequestParameter("grupos");
		$this->forward404Unless( $grupos );
		
		$rutina=$this->getRequestParameter("rutina");
		$this->forward404Unless( $rutina );
		
		$c = new Criteria();
		$c->add( AccesoGrupoPeer::CA_RUTINA, $rutina );
		$accesoGrupos = AccesoGrupoPeer::doSelect( $c );
		foreach( $accesoGrupos as $accesoGrupo ){
			$accesoGrupo->delete();
		}
		
		$opciones = explode( "|", $grupos );
		foreach( $opciones as $opcion ){
			$op = explode(",", $opcion );
			$accesoGrupo = new AccesoGrupo();
			$accesoGrupo->setCaRutina($rutina);
			$accesoGrupo->setCaGrupo($op[0]);
			$accesoGrupo->setCaAcceso($op[1]);
			$accesoGrupo->save();			
		}
		
		$this->setLayout("ajax");
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");				
	}
	
	/*
	* Guarda los accesos de un grupo y su nivel de acceso a cada opción
	*/
	public function executeObserveRutinasUsuarios(){
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA );			
		if( $this->nivel<1 ){
			$this->forward404();
		}
		
		$usuarios=utf8_decode($this->getRequestParameter("usuarios"));
		$this->forward404Unless( $usuarios );
		
		$rutina=$this->getRequestParameter("rutina");
		$this->forward404Unless( $rutina );
		
		$c = new Criteria();
		$c->add( AccesoUsuarioPeer::CA_RUTINA, $rutina );
		$accesoUsuarios = AccesoUsuarioPeer::doSelect( $c );
		foreach( $accesoUsuarios as $accesoUsuario ){
			$accesoUsuario->delete();
		}
		
		$opciones = explode( "|", $usuarios );
		foreach( $opciones as $opcion ){
			$op = explode(",", $opcion );
			$accesoUsuario = new AccesoUsuario();
			$accesoUsuario->setCaRutina($rutina);
			$accesoUsuario->setCaLogin($op[0]);
			$accesoUsuario->setCaAcceso($op[1]);
			$accesoUsuario->save();			
		}
		
		$this->setLayout("ajax");
		$this->responseArray = array("success"=>true);	
		$this->setTemplate("responseTemplate");				
	}	
	
	
	/*
	* Permite simular ser otro usuario, esto para facilitar la tarea de revisión de comisiones
	* o hacer test de los programas.
	*/
	public function executeTomarControl( $request ){
		
		$this->nivel = $this->getUser()->getNivelAcceso( usersActions::RUTINA_CONTROL );			
		if( $this->nivel<3 ){
			$this->forward404();
		}
		
		$this->form = new CambioUsuarioForm();	
		
		if ($request->isMethod('post')){
			
			$this->form->bind(
				array(
						'username' => $request->getParameter('username')
						
		
					)
				); 
			
			if ($this->form->isValid()){
				
				$username = $request->getParameter('username');				
				$user = Doctrine::getTable("Usuario")->find( $username );
				if( $user->getCaAuthmethod()=="ldap" ){
					$this->getUser()->signInLDAP( $username );				
				}else{
					$this->getUser()->signInAlternative( $username );					
				}

                $this->getUser()->buildMenu();
                
				$this->forward("homepage","index");
				
			}
		}
	}
	
	
	/*
	* Informa al usuario que no tiene acceso
	*/
	public function executeNoAccess( $request ){
	
	}
    
    
    /*
	* Verifica si el usuario esta logueado.
	*/
	public function executeCheckLogin( $request ){
        if( $this->getUser()->isAuthenticated() ){
            $cache = myCache::getInstance();
            $cookie = $_COOKIE["colsys"];
            list($session_id, $signature) = explode(':', $cookie, 2);
            $time = $cache->get($session_id."_lr", "");

            if( $time+sfConfig::get("app_session_maxinactive")>time() ){
                $timeLeft = $time+sfConfig::get("app_session_maxinactive")-time();
                $this->responseArray = array( "success"=>true, "login"=>true, "timeLeft"=>$timeLeft );
            }else{
                $this->responseArray = array( "success"=>true, "login"=>false );
            }
        }else{
           $this->responseArray = array( "success"=>true, "login"=>false );
        }
        $this->setTemplate("responseTemplate");
	}

    /*
	* Verifica si el usuario esta logueado.
	*/
	public function executeValidateLogin( $request ){
        $this->responseArray = array( "success"=>true, "login"=>false );

        $username = $request->getParameter("username");
        $passwd = $request->getParameter("passwd");

        if( $username && $passwd ){

			$usuario = Doctrine::getTable("Usuario")->find( $username );
			if( $usuario && $usuario->checkPasswd( $passwd ) ){
				if( $usuario->getCaAuthmethod()=="ldap" ){
                    sfContext::getInstance()->getUser()->signInLDAP( $username );
                    $this->responseArray["login"] = true;
				}

				if( $usuario->getCaAuthmethod()=="sha1" ){
                    sfContext::getInstance()->getUser()->signInAlternative( $username );
                    $this->responseArray["login"] = true;
				}
			}
		}

        $this->setTemplate("responseTemplate");
	}


    public function executeLoginWindow(){
        $this->setLayout("none");
        sfConfig::set('sf_web_debug', false) ;			
    }
    public function executeTraerImagen($request)
    {
        $username=$request->getParameter('username');
        $tamano=$request->getParameter('tamano');

        $user=Doctrine::getTable('Usuario')->find($username);
        $this->imagen=$user->getImagen($tamano);
    }
    public function executeLoggedInUsers(){
        
        $sfMemcache = myCache::getInstance();
        $memcache = $sfMemcache->getBackend();

        $sessions = array();
        $i = 0;
        
	    $allSlabs = $memcache->getExtendedStats('slabs');
	    $items = $memcache->getExtendedStats('items');
	    foreach($allSlabs as $server => $slabs) {
    	    foreach($slabs AS $slabId => $slabMeta) {                
                if( is_int($slabId) ){
                    $cdump = $memcache->getExtendedStats('cachedump',(int)$slabId);

                    foreach($cdump AS $server => $entries) {
                        if($entries) {
                            foreach($entries AS $eName => $eData) {
                                if( substr($eName, 0, 7) == "colsess" && strpos($eName, "_menu")===false && strpos($eName, "_lr")===false ){
                                    /*$list[$eName] = array(
                                         'key' => $eName,
                                         'server' => $server,
                                         'slabId' => $slabId,
                                         'detail' => $eData,
                                         'age' => $items[$server]['items'][$slabId]['age'],
                                     );*/

                                    $session["id"] = substr($eName, 8);
                                    $session["userdata"] = $memcache->get( $eName );
                                    $session["lastRequest"] = $memcache->get( $eName."_lr" );
                                    $session["ipAddress"] = $memcache->get( $eName."_ip", null );

                                    if( isset($session["userdata"]["symfony/user/sfUser/authenticated"]) && is_array($session["userdata"]) && $session["userdata"]["symfony/user/sfUser/authenticated"] ){
                                        if( time()-$session["lastRequest"]<=sfConfig::get("app_session_maxinactive")  ){
                                            $sessions[] = $session;
                                        }else{
                                            //$sfMemcache->remove( $eName );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
    	    }
	    }
        //print_r( $data );
        //ksort($sessions);

        $k=count($sessions);
        for( $i=1; $i<$k; $i++){
            for( $j=0; $j<$k-1; $j++){
               $prov1 = $sessions[$j]["userdata"]["symfony/user/sfUser/attributes"]["symfony/user/sfUser/attributes"]["user_id"];
               $prov2 = $sessions[$j+1]["userdata"]["symfony/user/sfUser/attributes"]["symfony/user/sfUser/attributes"]["user_id"];
               if( $prov1>$prov2 ){
                   $tmp = $sessions[$j];
                   $sessions[$j] = $sessions[$j+1];
                   $sessions[$j+1] = $tmp;
               }
            }
        }



        $this->sessions = $sessions;
        /*
	    ksort($list);


        foreach( $list as $row ){

            echo "<b>".$row["key"]."</b>";
            print_r($row["detail"]);
            echo " age: ".$row["age"]."<br />";

        }*/

    }

    public function executeKickUser( $request ){
        $id = $request->getParameter("id");
        $this->forward404Unless( $id );


        $sfMemcache = myCache::getInstance();
        //echo $id;
        $sfMemcache->remove( $id );
        
        $this->redirect("users/loggedInUsers");
    }


    public function executeParamUsuariosExt4( $request ){
        
    }
    
    public function executeDatosParamUsuarios( $request ){
        
        //$impoexpo= Constantes::IMPO;
        //$transporte=Constantes::MARITIMO;
        $q=Doctrine::getTable("UsuParametros")
                    ->createQuery("r")
                    ->select("r.*,u.ca_nombre as ca_usuario,t.ca_nombre as trafico,c.ca_ciudad as ciudad,cl.ca_compania as cliente")
                    ->leftJoin("r.Usuario u")
                    ->leftJoin("r.Trafico t")
                    ->leftJoin("r.Ciudad c")
                    ->leftJoin("r.Cliente cl")
                    //->where("r.ca_impoexpo = ? and r.ca_transporte = ?   ", array( $impoexpo , $transporte ) )
                    ->addOrderBy("r.ca_ciudad DESC,r.ca_trafico ")
                    ->fetchArray();
        
        for($i=0;$i<count($q);$i++)
        {
            $q[$i]["ca_usuario"] =  utf8_encode($q[$i]["ca_usuario"]);
            $q[$i]["ca_impoexpo"] =  utf8_encode($q[$i]["ca_impoexpo"]);
            $q[$i]["ca_transporte"] =  utf8_encode($q[$i]["ca_transporte"]);
        }

        $this->responseArray = array("success" => true,"root"=>$q);
        $this->setTemplate("responseTemplate");
    }

    public function executeAdminMetodosExt5(sfWebRequest $request) {
        
    }

    public function executeDatosRutinaId(sfWebRequest $request) {
        $idrutina = $request->getParameter("idrutina");


        $rutina = Doctrine::getTable("Rutina")->find($idrutina);


        $visibilidad = "";
        if ($rutina->getCaVisible() == true) {
            $visibilidad = "SI";
        } else {
            $visibilidad = "NO";
        }
        $data = array();

        $data["ca_rutina"] = $rutina->getCaRutina();
        $data["ca_opcion"] = utf8_encode($rutina->getCaOpcion());
        $data["ca_opcion"] = utf8_encode($rutina->getCaOpcion());
        $data["ca_descripcion"] = utf8_encode($rutina->getCaDescripcion());
        $data["ca_programa"] = utf8_encode($rutina->getCaPrograma());
        $data["ca_grupo"] = utf8_encode($rutina->getCaGrupo());
        $data["ca_icon"] = utf8_encode($rutina->getCaIcon());
        $data["ca_aplicacion"] = utf8_encode($rutina->getCaAplicacion());
        $data["ca_url"] = utf8_encode($rutina->getCaUrl());
        $data["ca_visible"] = $visibilidad;

        $this->responseArray = array("success" => true, "data" => $data);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGridUsuarios(sfWebRequest $request) {
        $idusuario = $request->getParameter("idusuario");
        $idrutina = $request->getParameter("idrutina");

        $perfiles = Doctrine::getTable("UsuarioPerfil")
                ->createQuery("a")
                ->addWhere("a.ca_login = ?", $idusuario)
                ->execute();

        $suma = 0;
        $cadenasuma = "";
        $arraybinarios = array();

        foreach ($perfiles as $perfil) {
            $accesoperfil = Doctrine::getTable("AccesoPerfil")
                    ->createQuery("a")
                    ->addWhere("a.ca_perfil = ?", $perfil->getCaPerfil())
                    ->addWhere("a.ca_rutina = ?", $idrutina)
                    ->fetchOne();
            if ($accesoperfil) {
                $arraybinarios[] = decbin($accesoperfil->getCaAcceso());
            }
        }


        $sql = " select RN.ca_idrutina_niveles as idrutina_niveles, RN.ca_valor as valor ,RN.ca_rutina as rutina,";
        $sql .= " RN.ca_nivel as nivel, RN.ca_descripcion as descripcion";
        $sql .= " from control.tb_rutinas_niveles RN where RN.ca_rutina = $idrutina ORDER BY RN.ca_nivel ASC";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $datos = $stmt->fetchAll();

        $arraybinariosdef = array();
        foreach ($arraybinarios as $bin) {
            $resta = count($datos) - strlen($bin);
            $ceros = "";
            for ($a = 0; $a < $resta; $a++) {
                $ceros .= "0";
            }
            $arraybinariosdef[] = $ceros . $bin;
        }
        $cadenasuma = "";

        if ($arraybinariosdef[0] != null) {
            $suma = $arraybinariosdef[0];
        }

        foreach ($arraybinariosdef as $binarios) {
            $cadenasuma .= $binarios . "|";
            $suma = $suma | $binarios;
        }
        $accesobinario = $suma;



        $data = array();
        $i = 0;
        $cadena = "";
        $accesobinario = strrev($accesobinario);


        $accesousuario = Doctrine::getTable("AccesoUsuario")
                ->createQuery("a")
                ->addWhere("a.ca_login = ?", $idusuario)
                ->addWhere("a.ca_rutina = ?", $idrutina)
                ->fetchOne();

        $permisosusuario = 0;
        if ($accesousuario) {
            $permisosusuario = $accesousuario->getCaAcceso();
            $denegarusuario = $accesousuario->getCaDenegar();
        }
        $permisosusuariobinario = strrev(decbin($permisosusuario));
        $denegarusuariobinario = strrev(decbin($denegarusuario));


        foreach ($datos as $dato) {
            $valor = substr($accesobinario, $i, 1);

            if (!$valor) {
                $valor = 0;
            }

            if ($valor == 0) {
                $seleccionado = false;
            } else {
                $seleccionado = true;
            }

            $valorusuario = substr($permisosusuariobinario, $i, 1);

            if (!$valorusuario) {
                $valorusuario = 0;
            }

            if ($valorusuario == 0) {
                $permisousuario = false;
            } else {
                $permisousuario = true;
            }

            $valordenegar = substr($denegarusuariobinario, $i, 1);

            if (!$valordenegar) {
                $valordenegar = 0;
            }

            if ($valordenegar == 0) {
                $valordenegar = false;
            } else {
                $valordenegar = true;
            }

            $data [] = array(
                "ca_rutina" => $dato["rutina"],
                "ca_nivel" => $dato["nivel"],
                "ca_idrutina_niveles" => $dato["idrutina_niveles"],
                "ca_descripcion" => utf8_encode($dato["descripcion"]),
                "ca_valor" => utf8_encode($dato["valor"]),
                "ca_seleccionado" => $seleccionado,
                "ca_permisos_usuario" => $permisousuario,
                "ca_denegar_usuario" => $valordenegar
            );
            $i = $i + 1;
        }
        $this->responseArray = array("success" => true, "root" => $data, "suma" => $suma);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRutina(sfWebRequest $request) {
        $nombre = $request->getParameter("nombre");
        $nombre = strtolower($nombre);
        //print_r($nombre);

        $q = Doctrine::getTable("Rutina")
                ->createQuery("d")
                ->select("d.*");
        if ($nombre) {
            $q->addWhere("lower(d.ca_opcion) like '%$nombre%'");
        }
        $rutinas = $q->execute();
        // print_r($q->getSqlQuery());

        $data = array();
        foreach ($rutinas as $rutina) {

            $visibilidad = "";
            if ($rutina->getCaVisible() == true) {
                $visibilidad = "SI";
            } else {
                $visibilidad = "NO";
            }

            $data[] = array(
                "ca_rutina" => $rutina->getCaRutina(),
                "ca_opcion" => utf8_encode($rutina->getCaOpcion()),
                "ca_descripcion" => utf8_encode($rutina->getCaDescripcion()),
                "ca_programa" => utf8_encode($rutina->getCaPrograma()),
                "ca_grupo" => utf8_encode($rutina->getCaGrupo()),
                "ca_icon" => utf8_encode($rutina->getCaIcon()),
                "ca_aplicacion" => utf8_encode($rutina->getCaAplicacion()),
                "ca_url" => utf8_encode($rutina->getCaUrl()),
                "ca_visible" => $visibilidad
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarUsuarios(sfWebRequest $request) {
        $idusuario = $request->getParameter("idusuario");
        $idrutina = $request->getParameter("idrutina");

        $datos = json_decode($request->getParameter("datosGrid"));
        $total = 0;
        $i = 0;
        foreach ($datos as $dato) {
            $valor = 0;
            if ($dato->ca_permisos_usuario == true) {
                $valor = 1;
            }
            $total = $total + ($valor * (pow(2, $i)));
            $i = $i + 1;
        }

        $totaldenegar = 0;
        $i = 0;

        foreach ($datos as $dato) {
            $valor = 0;
            if ($dato->ca_denegar_usuario == true) {
                $valor = 1;
            }
            $totaldenegar = $totaldenegar + ($valor * (pow(2, $i)));
            $i = $i + 1;
        }

        $conn = Doctrine::getTable("AccesoUsuario")->getConnection();
        $conn->beginTransaction();
        try {
            $accesousuario = Doctrine::getTable("AccesoUsuario")
                    ->createQuery("a")
                    ->addWhere("a.ca_login = ?", $idusuario)
                    ->addWhere("a.ca_rutina = ?", $idrutina)
                    ->fetchOne();
            if (!$accesousuario) {
                $accesousuario = new AccesoUsuario();
                $accesousuario->setCaRutina($idrutina);
                $accesousuario->setCaLogin($idusuario);
                //$accesoperfil->setCaUsucreado($this->getUser()->getUserId());
                //$accesoperfil->setCaFchcreado(date("Y-m-d H:i:s"));
            }
            $accesousuario->setCaAcceso($total);
            $accesousuario->setCaDenegar($totaldenegar);
            // $accesoperfil->setCaUsuactualizado($this->getUser()->getUserId());
            //$accesoperfil->setCaFchactualizado(date("Y-m-d H:i:s"));
            $accesousuario->save();
            $conn->commit();

            $this->responseArray = array("success" => true, "root" => $total, "total" => count($data));
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarPerfiles(sfWebRequest $request) {
        $idperfil = utf8_decode($request->getParameter("idperfil"));
        $idrutina = $request->getParameter("idrutina");

        $datos = json_decode($request->getParameter("datosGrid"));
        $total = 0;
        $i = 0;
        foreach ($datos as $dato) {
            $valor = 0;
            if ($dato->ca_seleccionado == true) {
                $valor = 1;
            }
            $total = $total + ($valor * (pow(2, $i)));
            $i = $i + 1;
        }
        $conn = Doctrine::getTable("AccesoPerfil")->getConnection();
        $conn->beginTransaction();
        try {
            $accesoperfil = Doctrine::getTable("AccesoPerfil")
                    ->createQuery("a")
                    ->addWhere("a.ca_perfil = ?", $idperfil)
                    ->addWhere("a.ca_rutina = ?", $idrutina)
                    ->fetchOne();
            if (!$accesoperfil) {
                $accesoperfil = new AccesoPerfil();
                $accesoperfil->setCaRutina($idrutina);
                $accesoperfil->setCaPerfil($idperfil);
                //$accesoperfil->setCaUsucreado($this->getUser()->getUserId());
                //$accesoperfil->setCaFchcreado(date("Y-m-d H:i:s"));
            }
            $accesoperfil->setCaAcceso($total);
            // $accesoperfil->setCaUsuactualizado($this->getUser()->getUserId());
            //$accesoperfil->setCaFchactualizado(date("Y-m-d H:i:s"));
            $accesoperfil->save();
            $conn->commit();

            $this->responseArray = array("success" => true, "root" => $total, "total" => count($data));
        } catch (Exception $e) {
            $conn->rollBack();
            $this->responseArray = array("success" => false, "errorInfo" => $e->getMessage());
        }


        $this->setTemplate("responseTemplate");
    }

    public function executeDatosGridPerfiles(sfWebRequest $request) {
        $idrutina = $request->getParameter("idrutina");
        
        $idperfil = utf8_decode($request->getParameter("idperfil"));


        $sql = " select RN.ca_idrutina_niveles as idrutina_niveles, RN.ca_valor as valor ,RN.ca_rutina as rutina,";
        $sql .= " RN.ca_nivel as nivel, RN.ca_descripcion as descripcion";
        $sql .= " from control.tb_rutinas_niveles RN where RN.ca_rutina = $idrutina ORDER BY RN.ca_nivel ASC";

        $q = Doctrine_Manager::getInstance()->connection();
        $stmt = $q->execute($sql);
        $datos = $stmt->fetchAll();



        $accesoperfil = Doctrine::getTable("AccesoPerfil")
                ->createQuery("a")
                ->addWhere("a.ca_perfil = ?", $idperfil)
                ->addWhere("a.ca_rutina = ?", $idrutina)
                ->fetchOne();

        if ($accesoperfil) {
            $acceso = $accesoperfil->getCaAcceso();
            $accesobinario = decbin($acceso);
            //print_r($accesobinario);
        }

        $data = array();
        $i = 0;
        $cadena = "";
        $accesobinario = strrev($accesobinario);




        foreach ($datos as $dato) {
            $valor = substr($accesobinario, $i, 1);

            if (!$valor) {
                $valor = 0;
            }

            if ($valor == 0) {
                $seleccionado = false;
            } else {
                $seleccionado = true;
            }

            $cadena .= $seleccionado . " | ";

            $data [] = array(
                "ca_rutina" => $dato["rutina"],
                "ca_nivel" => $dato["nivel"],
                "ca_idrutina_niveles" => $dato["idrutina_niveles"],
                "ca_descripcion" => utf8_encode($dato["descripcion"]),
                "ca_valor" => $dato["valor"],
                "ca_seleccionado" => $seleccionado
            );
            $i = $i + 1;
        }
        $this->responseArray = array("success" => true, "root" => $data, "cadena" => $cadena, "binario" => $accesobinario);
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosMetodos(sfWebRequest $request) {
        $rutina = $request->getParameter("rutina");
        if ($rutina) {
            $niveles = Doctrine::getTable("RutinaNivel")
                    ->createQuery("d")
                    ->where("d.ca_rutina = ?", $rutina)
                    ->OrderBy("d.ca_nivel")
                    ->execute();

            $data = array();
            foreach ($niveles as $nivel) {
                $data[] = array("ca_rutina" => utf8_encode($nivel->getCaRutina()),
                    "ca_nivel" => utf8_encode($nivel->getCaNivel()),
                    "ca_valor" => utf8_encode($nivel->getCaValor()),
                    "ca_idrutina_niveles" => utf8_encode($nivel->getCaIdrutinaNiveles()),
                    "ca_descripcion" => utf8_encode($nivel->getCaDescripcion()),
                    "seleccionado" => false);
            }
            $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        } else {
            $this->responseArray = array("success" => true, "root" => "");
        }

        $this->setTemplate("responseTemplate");
    }

    public function executeAnularMetodo(sfWebRequest $request) {
        $rutina = $request->getParameter("rutina");
        $id = $request->getParameter("ca_idrutina_niveles");
        if ($id) {
            $RutinaNivel = Doctrine::getTable("RutinaNivel")
                    ->createQuery("d")
                    ->where("d.ca_idrutina_niveles = ?", $id)
                    ->fetchOne();
            if ($RutinaNivel) {
                $conn = Doctrine::getTable("AduCliente")->getConnection();
                $conn->beginTransaction();

                try {
                    //$metodo->setCaFcheliminado(date("Y-m-d H:i:s"));
                    //$metodo->setCaUsueliminado($this->getUser()->getUserId());
                    $RutinaNivel->delete();
                    $this->responseArray = array("success" => true);
                    $conn->commit();
                } catch (Exception $e) {
                    $conn->rollback();
                    $this->responseArray = array("success" => false, "responseInfo" => $e->getMessage());
                }
            }
        } else {
            $this->responseArray = array("success" => true);
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeDatosRutinaCompleto(sfWebRequest $request) {
        $rutina = $request->getParameter("rutina");


        $q = Doctrine::getTable("Rutina")
                ->createQuery("d")
                ->select("d.*");
        $q->addWhere("d.ca_rutina = ?", $rutina);

        $rutina = $q->fetchOne();

        $data = array();

        if ($rutina) {

            $visibilidad = "";
            if ($rutina->getCaVisible() == true) {
                $visibilidad = "SI";
            } else {
                $visibilidad = "NO";
            }

            $data[] = array(
                "ca_rutina" => $rutina->getCaRutina(),
                "ca_opcion" => utf8_encode($rutina->getCaOpcion()),
                "ca_descripcion" => utf8_encode($rutina->getCaDescripcion()),
                "ca_programa" => utf8_encode($rutina->getCaPrograma()),
                "ca_grupo" => utf8_encode($rutina->getCaGrupo()),
                "ca_icon" => utf8_encode($rutina->getCaIcon()),
                "ca_aplicacion" => utf8_encode($rutina->getCaAplicacion()),
                "ca_url" => utf8_encode($rutina->getCaUrl()),
                "ca_visible" => $visibilidad
            );
        }
        $this->responseArray = array("success" => true, "root" => $data, "total" => count($data));
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarFormRutinas(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $conn = Doctrine::getTable("AduCliente")->getConnection();
        $conn->beginTransaction();
        try {
            $rutina = Doctrine::getTable("Rutina")
                    ->createQuery("d")
                    ->where("d.ca_opcion = ?", $datos->ca_opcion)
                    ->fetchOne();
            if(!$rutina){
                $rutina = new Rutina();
                $rutina->setCaOpcion(utf8_decode($datos->ca_opcion));
                $rutina->setCaDescripcion(utf8_decode($datos->ca_descripcion));
                $rutina->setCaPrograma(utf8_decode($datos->ca_programa));
                $rutina->setCaGrupo(utf8_decode($datos->ca_grupo));
                $rutina->setCaUrl(utf8_decode($datos->ca_url));
                $rutina->setCaIcon(utf8_decode($datos->ca_icon));
                $rutina->setCaAplicacion(utf8_decode($datos->ca_aplicacion));
                if ($datos->ca_visible == "SI") {
                    $rutina->setCaVisible(true);
                } else {
                    $rutina->setCaVisible(false);
                }

                $rutina->save();
                $conn->commit();
                $this->responseArray = array("success" => true, "idrutina" => $rutina->getCaRutina() ,"nombre" => $rutina->getCaOpcion());
            }
            else{
                $this->responseArray = array("success" => false, "errorInfo" => "Ya existe una Rutina con este nombre.");
            }
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarFormMetodos(sfWebRequest $request) {
        $datos = $request->getParameter("datos");
        $datos = json_decode($datos);
        $conn = Doctrine::getTable("AduCliente")->getConnection();
        $conn->beginTransaction();
        try {
            if ($datos->ca_rutina) {

                $rutina = Doctrine::getTable("Rutina")
                        ->createQuery("d")
                        ->where("d.ca_rutina = ?", $datos->ca_rutina)
                        ->fetchOne();
            } else {
                $rutina = new Rutina();
            }
            $rutina->setCaOpcion(utf8_decode($datos->ca_opcion));
            $rutina->setCaDescripcion(utf8_decode($datos->ca_descripcion));
            $rutina->setCaPrograma(utf8_decode($datos->ca_programa));
            $rutina->setCaGrupo(utf8_decode($datos->ca_grupo));
            $rutina->setCaUrl(utf8_decode($datos->ca_url));
            $rutina->setCaIcon(utf8_decode($datos->ca_icon));
            $rutina->setCaAplicacion(utf8_decode($datos->ca_aplicacion));
            if ($datos->ca_visible == "SI") {
                $rutina->setCaVisible(true);
            } else {
                $rutina->setCaVisible(false);
            }

            $rutina->save();
            $conn->commit();
            $this->responseArray = array("success" => true, "id" => $ids);
        } catch (Exception $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

    public function executeGuardarMetodos(sfWebRequest $request) {
        $idrutina = $request->getParameter("rutina");
        $datosGrid = $request->getParameter("datosGrid");
        $datosGrid = json_decode($datosGrid);

        $ids = array();

        $conn = Doctrine::getTable("AduCliente")->getConnection();
        $conn->beginTransaction();

        try {
            $rutina = Doctrine::getTable("Rutina")
                    ->createQuery("d")
                    ->where("d.ca_rutina = ?", $idrutina)
                    ->fetchOne();

            if ($rutina) {

                foreach ($datosGrid as $record) {

                    if ($record->ca_idrutina_niveles) {

                        $RutinaNivel = Doctrine::getTable("RutinaNivel")
                                ->createQuery("d")
                                ->where("d.ca_idrutina_niveles = ?", $record->ca_idrutina_niveles)
                                ->fetchOne();
                        if (!$RutinaNivel) {
                            $RutinaNivel = new RutinaNivel();
                        }
                    } else {
                        $RutinaNivel = new RutinaNivel();
                    }
                    $RutinaNivel->setCaRutina(utf8_decode($rutina->getCaRutina()));
                    $RutinaNivel->setCaNivel(utf8_decode($record->ca_nivel));
                    $RutinaNivel->setCaDescripcion(utf8_decode($record->ca_descripcion));
                    $RutinaNivel->setCaValor(utf8_decode($record->ca_valor));
                    $RutinaNivel->save();
                    $ids[] = $record->id;
                }
            }
            $conn->commit();
            $this->responseArray = array("success" => true, "id" => $ids);
        } catch (Ex $e) {
            $conn->rollback();
            $this->responseArray = array("success" => false, "errorInfo" => utf8_encode($e->getMessage()));
        }
        $this->setTemplate("responseTemplate");
    }

}

?>
