<?

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

if (isset($id) and strlen($id) > 0) {                                                              // Switch que evalua cual botòn de comando fue pulsado por el usuario
	if (!$rs->Open("select ca_idcliente from vi_clientes where ca_idcliente = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
	    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
	    echo "<script>document.location.href = 'clientes_adm.php';</script>";
	    exit;
		}
	if ($rs->IsEmpty()) {
		echo "<script>window.parent.frames.adicionar.existe.value=false;</script>";
	}else {
		echo "<script>window.parent.frames.adicionar.existe.value=true;</script>";
	}
}
?>