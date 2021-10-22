<?php 
//print_r(getdate());
//echo strftime("%D");
session_cache_limiter('public');

$startTime = microtime(  true );

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

//$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'prod', true);
if ($_SERVER['SERVER_NAME'] == 'www.consolcargo.com' || $_SERVER['SERVER_NAME'] == 'consolcargo.com'){
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'consolcargo', false);
}else{
    $configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'coltrans', true);
}

sfContext::createInstance($configuration)->dispatch();


$time = round(microtime( true )-$startTime, 2 );

/*$user = sfContext::getInstance()->getUser();
if( $user ){    
    $user->log("Time: ".$time );
}*/



?>
