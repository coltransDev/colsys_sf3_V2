<?php

/*session_cache_limiter('public'); 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
define('SF_APP',         'tracking');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();



*/
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1')))
{
  die('Your are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}
require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('tracking', 'dev', true);
sfContext::createInstance($configuration)->dispatch();

