<?php
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{
		
		if( sfContext::getInstance()->getConfiguration()->getEnvironment()!="batch" ){
			$cookie = sfContext::getInstance()->getRequest()->getCookie($this->getParameter('cookie_name'));
			echo "".$this->getParameter('cookie_name');
			print_r( $cookie );
			exit("asd");
			if ($cookie)
			{		
				sfContext::getInstance()->getUser()->setUserId( $cookie );
				sfContext::getInstance()->getUser()->setAuthenticated(true);
				sfContext::getInstance()->getResponse()->setHttpHeader('Cache-Control', "no-cache, no-store");
				sfContext::getInstance()->getResponse()->setHttpHeader('Expires', sfContext::getInstance()->getResponse()->getDate(time()-86400));
				// Execute next filter
				$filterChain->execute();	
				
			}else{
				header("Location: /index.html");
				exit("exit: loginValidationFilter");
			}
		}
		$filterChain->execute();	
	}
}

?>