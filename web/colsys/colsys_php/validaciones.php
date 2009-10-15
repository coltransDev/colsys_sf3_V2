<?

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

if (isset($opcion) and $opcion == 'Clientes') {
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
}else if (isset($opcion) and $opcion == 'Tarifas') {
	if (isset($cn) and isset($id) and isset($pr)) {                                                              // Switch que evalua cual botòn de comando fue pulsado por el usuario
		if (!$rs->Open("select f.ca_idtrayecto, t.ca_nombre, f.ca_vlrneto, f.ca_vlrminimo, f.ca_fleteminimo, ca_idmoneda from vi_fletes f, vi_trayectos t where f.ca_idtrayecto = t.ca_idtrayecto and ca_idconcepto = $cn and f.ca_idtrayecto in (select ca_idtrayecto from vi_trayectos t, vi_cotproductos p where p.ca_idcotizacion = $id and p.ca_idproducto = $pr and t.ca_origen = p.ca_idorigen and t.ca_destino = p.ca_iddestino)")) {    // Mueve el apuntador al registro que se desea modificar
		    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
		    exit;
			}
		$cadena = '|';
		while (!$rs->Eof()) {
			$cadena.= substr($rs->Value('ca_nombre'),0,20).", ".$rs->Value('ca_vlrneto').", ".$rs->Value('ca_vlrminimo').", ".$rs->Value('ca_fleteminimo').", ".$rs->Value('ca_idmoneda')."|";
			$rs->MoveNext();
		}
		echo "<script>window.parent.frames.uptarifas('$cadena',$nu);</script>";
	}
}
?>