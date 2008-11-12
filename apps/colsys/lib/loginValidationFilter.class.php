<?
class loginValidationFilter extends sfFilter
{
	public function execute($filterChain)
	{
		
	/*	$cookie = sfContext::getInstance()->getRequest()->getCookie($this->getParameter('cookie_name'));
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
			exit();
		}
		*/
		$filterChain->execute();	
	}
}
?>
