<?php

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'colsys');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       true);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');



$db = sfContext::getInstance()->getDatabaseManager()->getDatabase("propel")->getParameter("database");
//$user = sfContext::getInstance()->getDatabaseManager()->getDatabase("propel")->getParameter("username");
$user = "postgres";
//$password = sfContext::getInstance()->getDatabaseManager()->getDatabase("propel")->getParameter("password");
$password = "sistemassrv";
$backupPath =  "/srv/dbbackups/";


$date = date('D');	

$file = $backupPath.$date . ".dump";

$logFile = $backupPath."logs/".$date."pgdump-error-output.txt";

$cmd = "/usr/bin/expect -f  ".sfConfig::get("sf_root_dir")."/".sfConfig::get("sf_bin_dir_name")."/databaseBackup.exp {$file} {$db} {$user} {$password} ";

system( $cmd );
 
?>