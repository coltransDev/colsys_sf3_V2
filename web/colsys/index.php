<?php 

session_cache_limiter('public');

$startTime = microtime(  true );

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();


$time = round(microtime( true )-$startTime, 2 );

$user = sfContext::getInstance()->getUser();
if( $user ){    
    $user->log("Time: ".$time );
}



?>