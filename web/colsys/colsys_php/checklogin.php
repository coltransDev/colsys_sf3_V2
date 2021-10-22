<?

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';

$cookie = $_COOKIE["colsys"];
list($session_id, $signature) = explode(':', $cookie, 2);


if( !$session_id ){
	header("Location: /");
	exit("");
}


require("db_config.php");




$config = '../../../apps/colsys/config/app.yml';
$appConfig = sfYaml::load($config);


$smtpHost = $appConfig["all"]["smtp"]["host"];
$smtpUser = $appConfig["all"]["smtp"]["user"];
$smtpPasswd = $appConfig["all"]["smtp"]["passwd"];

define("COLTRANS",$appConfig["all"]["branding"]["name1"]);

if( isset($programa) ){ //Si esta definido quiere decir que esta en una opcion del menu
	$nivel = -1;
}else{
	$nivel = 0;
}


while(list($key,$value)=each($_REQUEST)) {
	if( $key!="programa" && $key!="usuario"){
		$$key=$value;
	}
}

$memcacheHost = $appConfig["all"]["memcache"]["host"];
$memcachePort = $appConfig["all"]["memcache"]["port"];
$memServers = array("localserver"=>array("host"=>$memcacheHost." port: ".$memcachePort.""));
$cache = new sfMemcacheCache(  array( "servers"=>$memServers, "prefix"=>"colsess" ) );



$data = $cache->get($session_id, array());

//session_register("usuario", "password", "nivel", "database", "principal", "servidor", "hora");


$conn =& DlDatabase::NewConnection("PGSQL", $usuarioDb, $password, $database, $servidor);


if($conn->Open()){
    $rs =& DlRecordset::NewRecordset($conn);
    $time = $cache->get($session_id."_lr", "");           
    $max_inactive = $appConfig["all"]["session"]["maxinactive"];
   
    if( $time+$max_inactive>time() ) {

        if( $data["symfony/user/sfUser/authenticated"]!==false ){

            /*$rs->Open("UPDATE control.tb_sessions SET sess_time=".time()." WHERE sess_id='".$session_id."'" );*/

            $attributes = $data["symfony/user/sfUser/attributes"]["symfony/user/sfUser/attributes"];           
            $usuario = $attributes["user_id"];
            $regional = $attributes["idtrafico"];
            $usuario_sucursal = $attributes["idsucursal"] ;
            //print_r($attributes);
            $cache->set($session_id."_lr", time());
            
            if( isset($programa) ){
                $sql = "SELECT control.tb_accesos_user.CA_ACCESO FROM  control.tb_accesos_user WHERE control.tb_accesos_user.CA_RUTINA='$programa' AND control.tb_accesos_user.CA_LOGIN = '$usuario'";

                $rs->Open( $sql );

                if ($rs->mRowCount == 0) {

                    $rs->Open("SELECT * FROM control.tb_usuarios WHERE ca_login='".$usuario."'" );

                    $sql = "SELECT DISTINCT control.tb_accesos_perfiles.CA_ACCESO FROM control.tb_accesos_perfiles LEFT JOIN control.tb_usuarios_perfil ON (control.tb_accesos_perfiles.CA_PERFIL=control.tb_usuarios_perfil.CA_PERFIL) WHERE control.tb_accesos_perfiles.CA_RUTINA='$programa' AND control.tb_usuarios_perfil.CA_LOGIN = '$usuario' ORDER BY control.tb_accesos_perfiles.ca_acceso DESC LIMIT 1";

                    // echo $sql;
                    $rs->Open( $sql );
                    while (!$rs->Eof()) {
                        $nivel = $rs->Value('ca_acceso');
                        $rs->MoveNext();
                    }

                }else{
                    while (!$rs->Eof()) {
                        $nivel = $rs->Value('ca_acceso');
                        $rs->MoveNext();
                    }
                }

            }
        }else{
            //No se ha autenticado
            header( "Location: /index.php" );
            exit("No login");
        }
        
    }else{
        //Timeout
        header( "Location: /users/logout" );
        exit("Timeout");
    }

}else{
	exit("No se pudo conectar a la BD");
}

if( $nivel==-1){
	echo "No tiene acceso a este modulo";
	exit();
}

//print_r($_COOKIE);
?>
