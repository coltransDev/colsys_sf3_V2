<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{	
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
		
		if( $module=="users" && $action=="login" ){
			$filterChain->execute();
		}else{
		
			if( sfContext::getInstance()->getConfiguration()->getEnvironment()!="batch" ){		
				
				if( sfContext::getInstance()->getUser()->isAuthenticated() ){
					$filterChain->execute();
				}else{					
					sfContext::getInstance()->getController()->redirect("users/login"); 
				}
				
				/*
				$cookie = sfContext::getInstance()->getRequest()->getCookie($this->getParameter('cookie_name'));			
				if ($cookie)
				{		
					sfContext::getInstance()->getUser()->setUserId( $cookie );
					sfContext::getInstance()->getUser()->setAuthenticated(true);
					sfContext::getInstance()->getResponse()->setHttpHeader('Cache-Control', "no-cache, no-store");
					sfContext::getInstance()->getResponse()->setHttpHeader('Expires', sfContext::getInstance()->getResponse()->getDate(time()-86400));
					
					//$module = sfContext::getInstance()->getModuleName ();				
					//$action = sfContext::getInstance()->getActionName ();
					// Execute next filter				
					$filterChain->execute();	
					
				}else{
					header("Location: /index.html");
					exit("exit: loginValidationFilter");
				}*/
			}else{
				$filterChain->execute();	
			}
		}
	}
}

?>