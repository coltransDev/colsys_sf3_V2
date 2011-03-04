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


if( $script=="comisiones.php" && trim($_REQUEST["buscar"])=="Buscar"){
    $ro = true;
}

if( $script=="comisiones.php" && trim($_REQUEST["boton"])=="Liquidar Comisiones"){
    $ro = true;
}






require( '../../../config/ProjectConfiguration.class.php' );

if( $ro ){
    $config = '../../../config/databases_replica.yml';
}else{
    $config = '../../../config/databases.yml';
}

$databaseConfig = sfYaml::load($config);



$dsn = $databaseConfig['prod']['doctrine']['param']['dsn'];


$principal = substr( $dsn, 0,  strpos( $dsn, ";") );
$servidor = substr( $dsn,  strlen( $principal )+6 );
$database = substr( $principal, strpos( $principal, "dbname")+7 );
$usuarioDb = $databaseConfig['prod']['doctrine']['param']['username'];
$password = $databaseConfig['prod']['doctrine']['param']['password'];

?>