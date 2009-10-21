<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{	
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
				//$filterChain->execute();	
		if( $module=="users" && $action=="login" ){
			$filterChain->execute();
		}else{
		
			if( sfContext::getInstance()->getConfiguration()->getEnvironment()!="cli" ){
				
				if( sfContext::getInstance()->getUser()->isAuthenticated() ){
					$module = sfContext::getInstance()->getModuleName ();
					$action = sfContext::getInstance()->getActionName ();	
						
					if( sfContext::getInstance()->getUser()->getAttribute("forcechange")==true && $module!="adminUsers" && $action!="changePasswd" ){
						sfContext::getInstance()->getController()->redirect("/adminUsers/changePasswd");
					}
					$filterChain->execute();
				}else{					
					sfContext::getInstance()->getController()->redirect("users/login");
                    //header("Location: /users/login");
                    exit();
				}
				
				
			}else{
				$filterChain->execute();	
			}
		}
	}
}

?>