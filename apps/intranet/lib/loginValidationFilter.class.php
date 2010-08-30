<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{	
		$module = sfContext::getInstance()->getModuleName ();				
		$action = sfContext::getInstance()->getActionName ();
				//$filterChain->execute();	
		if( ($module=="adminUsers" && $action=="login") || sfContext::getInstance()->getConfiguration()->getEnvironment()=="cli" ){
			$filterChain->execute();
            
		}else{
            if( sfContext::getInstance()->getUser()->isAuthenticated() ){
                $filterChain->execute();
            }else{
                sfContext::getInstance()->getController()->forward("adminUsers","login");
                //header("Location: /adminUsers/login");
                exit();
            }
		}
	}
}

?>