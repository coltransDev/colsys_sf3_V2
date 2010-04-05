<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{	
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
				//$filterChain->execute();	
		if( ($module=="users" && $action=="login") || ($module=="users" && $action=="checkLogin") ||  ($module=="users" && $action=="validateLogin") || sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
			$filterChain->execute();
            
		}else{
            if( sfContext::getInstance()->getUser()->isAuthenticated() ){
                $module = sfContext::getInstance()->getModuleName ();
                $action = sfContext::getInstance()->getActionName ();

                if( sfContext::getInstance()->getUser()->getAttribute("forcechange")==true && $module!="adminUsers" && $action!="changePasswd" ){
                    sfContext::getInstance()->getController()->redirect("/adminUsers/changePasswd");
                }
                $filterChain->execute();
            }else{
                sfContext::getInstance()->getController()->forward("users","login");
                //header("Location: /users/login");
                exit();
            }
		}
	}
}

?>