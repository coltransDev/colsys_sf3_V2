<?

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';   

$session_id = $_COOKIE["colsys"];

if( !$session_id ){
	header("Location: /");
	exit("");
}



require( '../../../config/ProjectConfiguration.class.php' );

$config = '../../../config/databases.yml';
$databaseConfig = sfYaml::load($config);	


$database = "Coltrans"; 

$dsn = $databaseConfig['all']['propel']['param']['dsn'];


$dsn =  substr( $dsn,  strpos( $dsn, "dbname")+7 );
$principal = substr( $dsn, 0,  strpos( $dsn, ";") );
$servidor = substr( $dsn,  strlen( $principal )+6 );
$usuarioDb = $databaseConfig['all']['propel']['param']['username'];
$password = $databaseConfig['all']['propel']['param']['password'];


/*
$usuarioDb = "Administrador";
$password = "cglti\$col91";
$servidor = "10.192.1.127";
*/



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



//session_register("usuario", "password", "nivel", "database", "principal", "servidor", "hora"); 
$conn =& DlDatabase::NewConnection("PGSQL", $usuarioDb, $password, $database, $servidor);


if($conn->Open()){
	$rs =& DlRecordset::NewRecordset($conn); 		
	$rs->Open("SELECT * FROM control.tb_sessions WHERE sess_id='".$session_id."'" );
		
	if( $rs->Value('sess_id') ){
		$time = $rs->Value('sess_time');
		$data = pg_unescape_bytea($rs->Value('sess_data'));	
		$max_inactive = $rs->Value('max_inactive');
				
		if( $time+$max_inactive>time() ) {
			$str = "symfony/user/sfUser/authenticated|b:";
			$k = strpos( $data, $str );			
	        if( $k!==false ){
				$value = substr( $data, $k+strlen( $str ), 1 );				
				if( $value=="1" ){
					$rs->Open("UPDATE control.tb_sessions SET sess_time=".time()." WHERE sess_id='".$session_id."'" );
					
					$data = substr( $data, strpos( $data , "\"user_id\";s:" )+12);
					$idx = strpos( $data , ":" );
					$len = substr( $data , 0, $idx );
					$usuario = substr( $data, $idx+2, $len );
					
					
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
			} 			
		}else{
			//Timeout
			header( "Location: /index.php" ); 
			exit("Timeout");
		}		
	}else{
		//No se ha creado la sesion
		header( "Location: /index.php" ); 
		exit("No session id");
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