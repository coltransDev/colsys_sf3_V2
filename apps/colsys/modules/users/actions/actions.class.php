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


		
}



?>
