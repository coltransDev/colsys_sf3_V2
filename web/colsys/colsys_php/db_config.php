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
                   "repindicadornew.php",
                   "repgeneratorair.php",
                   "repantecedentes.php"
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


if ($_SERVER['SERVER_NAME'] == 'www.tplogistics.com.pe'){
    $environment = 'all';
}else if ($_SERVER['SERVER_NAME'] == 'www.consolcargo.com'){
    $environment = 'consolcargo';
}else{
    $environment = 'coltrans';
}


require( '../../../config/ProjectConfiguration.class.php' );

if( $ro ){
    $config = '../../../config/databases_replica.yml';
}else{
    $config = '../../../config/databases.yml';
}


$databaseConfig = sfYaml::load($config);

$dsn = $databaseConfig[$environment]['doctrine']['param']['dsn'];
$principal = substr( $dsn, 0,  strpos( $dsn, ";") );
$servidor = substr( $dsn,  strlen( $principal )+6 );
$database = substr( $principal, strpos( $principal, "dbname")+7 );
$usuarioDb = $databaseConfig[$environment]['doctrine']['param']['username'];
$password = $databaseConfig[$environment]['doctrine']['param']['password'];
?>
