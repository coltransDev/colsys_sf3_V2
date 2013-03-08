<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{
        //$filterChain->execute();
		$module = sfContext::getInstance()->getModuleName ();
		$action = sfContext::getInstance()->getActionName ();
				//$filterChain->execute();	
		if( ($module=="users" && $action=="login") || ($module=="users" && $action=="checkLogin") ||  ($module=="users" && $action=="validateLogin") || sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){            
			$filterChain->execute();
            
		}
        elseif( ($module=="formulario" && $action=="servicios"  || $module=="formulario" && $action=="encuesta"  ||  $module=="formulario" && $action=="guardado" || $module=="formulario" && $action=="exito" || $module=="formulario" && $action=="proceso") /*|| sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli"*/ ){
			$filterChain->execute();
		}
        else{
            if($module=="gestDocumental" && $action=="verArchivo"){
               
                $folders = explode(",",sfConfig::get('app_gestDocumental_noAuth'));
                                
                
                $folder = base64_decode(sfContext::getInstance()->getRequest()->getParameter("folder"));

                if( in_array($folder, $folders) ){
                    $filterChain->execute();
                }
            }

            
            $cache = myCache::getInstance();


            $cookie = isset($_COOKIE["colsys"])?$_COOKIE["colsys"]:"";
            list($session_id, $signature) = explode(':', $cookie, 2);
            $time = $cache->get($session_id."_lr", "");

            if( $time+sfConfig::get("app_session_maxinactive")>time() ){

                if( sfContext::getInstance()->getUser()->isAuthenticated() ){
                    $module = sfContext::getInstance()->getModuleName ();
                    $action = sfContext::getInstance()->getActionName ();

                    if( sfContext::getInstance()->getUser()->getAttribute("forcechange")==true && $module!="adminUsers" && $action!="changePasswd" ){
                        if( !($module=="users" && $action=="logout") ){
                            sfContext::getInstance()->getController()->redirect("/adminUsers/changePasswd");
                        }
                    }

                    $filterChain->execute();
                }else{
                    sfContext::getInstance()->getController()->forward("users","login");
                    //header("Location: /users/login");
                    exit();
                }
            }else{
                sfContext::getInstance()->getUser()->signOut();
                sfContext::getInstance()->getController()->forward("users", "login");
                exit();
            }
        }
		
	}
}

?>