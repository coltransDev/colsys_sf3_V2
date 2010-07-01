<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{	
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
				//$filterChain->execute();	
		if( ($module=="users" && $action=="login") || sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
			$filterChain->execute();
            
		}else{
            if( sfContext::getInstance()->getUser()->isAuthenticated() ){
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