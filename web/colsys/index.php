<?php 

session_cache_limiter('public'); 

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'prod', false);
sfContext::createInstance($configuration)->dispatch();


?>