<?php
/*
session_cache_limiter('public'); 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
define('SF_APP',         'colsys');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


$string = sfContext::getInstance()->getRequest()->getCookie('coltranscookie')."asd";


if( $string ){
	sfContext::getInstance()->getUser()->setUserId( $string );
	sfContext::getInstance()->getUser()->setAuthenticated(true);
	sfContext::getInstance()->getResponse()->setHttpHeader('Cache-Control', "no-cache, no-store");
	sfContext::getInstance()->getResponse()->setHttpHeader('Expires', sfContext::getInstance()->getResponse()->getDate(time()-86400));
	sfContext::getInstance()->getController()->dispatch();
}


*/

if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1','10.192.1.4','172.194.4.2','172.16.1.21','190.25.189.210')))
{
  die('Your are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

//$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
if ($_SERVER['SERVER_NAME'] == 'colsys.consolcargo.com' || $_SERVER['SERVER_NAME'] == 'consolcargo.com'){
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'consolcargo', true);
}else{
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
}

sfContext::createInstance($configuration)->dispatch();

/*
 * este
 */

