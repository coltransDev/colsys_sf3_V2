<?
$script = str_replace("/colsys_php/","",$_SERVER["PHP_SELF"]);



$ro = false;

$roScripts = array("repgerencia.php", 
                   "repgenerator.php",
                   "repcomisiones.php",
                   "reputilidades.php",
                   "repcarga.php",
                   "repnavieras.php",
                   "reptraficos.php",
                   "repconsolidado.php",
                   "repreferencia.php",
                   "repauditoria.php",
                   "repindicadores.php",
                   "repgeneratorair.php"
                  );

if( in_array($script, $roScripts ) ){
    $ro = true;
}


if( ($script=="clientes.php" || $script=="clientes_financ.php") && trim($_REQUEST["buscar"])=="Buscar"){
    $ro = true;   
}

if( $script=="reportenegocio.php" && trim($_REQUEST["buscar"])=="Buscar"){
    $ro = true;
}


if( $script=="comisiones.php" && trim(base64_decode($_REQUEST["accion"]))!="Registrar"){
    $ro = true;
}







require( '../../../config/ProjectConfiguration.class.php' );

if( $ro ){
    $config = '../../../config/databases_replica.yml';
}else{
    $config = '../../../config/databases.yml';
}


$databaseConfig = sfYaml::load($config);

/*
$database = "Coltrans";

$dsn = $databaseConfig['all']['doctrine']['param']['dsn'];


$dsn =  substr( $dsn,  strpos( $dsn, "dbname")+7 );
$principal = substr( $dsn, 0,  strpos( $dsn, ";") );
$servidor = substr( $dsn,  strlen( $principal )+6 );
$usuarioDb = $databaseConfig['all']['doctrine']['param']['username'];
$password = $databaseConfig['all']['doctrine']['param']['password'];
*/

$dsn = $databaseConfig['prod']['doctrine']['param']['dsn'];


//$dsn =  substr( $dsn,  strpos( $dsn, "dbname")+7 );
$principal = substr( $dsn, 0,  strpos( $dsn, ";") );
$servidor = substr( $dsn,  strlen( $principal )+6 );
$database = substr( $principal, strpos( $principal, "dbname")+7 );
$usuarioDb = $databaseConfig['prod']['doctrine']['param']['username'];
$password = $databaseConfig['prod']['doctrine']['param']['password'];

?>