<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       GRUPOS.PHP                                                  \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de grupos para tráfico.  \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Grupos para Tráfico';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
$tr =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador

    if (!$rs->Open("select * from tb_potenciales where ca_idcliente not in (select ca_idcliente from vi_clientes_reduc where ca_idcliente in (select DISTINCT ca_idcliente from tb_inoingresos_sea)) and ca_idcliente in (select DISTINCT ca_idcliente from tb_inoingresos_sea)")) {
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	$i = 0;

    if (!$tr->Open("select ca_idcliente, ca_compania from vi_clientes_reduc order by ca_idcliente")) {                  // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($tr->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
		echo "<TR>";
		echo "  <TD Class=mostrar>".$i++."</TD>";
		echo "  <TD Class=mostrar>".$rs->Value('ca_idcliente')."</TD>";
		echo "  <TD Class=mostrar>".$rs->Value('ca_compania')."</TD>";
		echo "</TR>";
//		$tr->MoveFirst();
//	    while (!$tr->Eof() and !$tr->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
//			if (strlen($tr->Value('ca_idcliente')) > strlen($rs->Value('ca_idcliente'))) {
//			    break;
//			}
//			similar_text($rs->Value('ca_idcliente'), $tr->Value('ca_idcliente'), $nit);
//			similar_text($rs->Value('ca_compania'), $tr->Value('ca_compania'), $nom);
//			if ($nit > 70 and $nom > 40) {
//				echo "<TR>";
//				echo "  <TD Class=mostrar></TD>";
//				echo "  <TD Class=mostrar COLSPAN=2>".$tr->Value('ca_idcliente')." -> ".$tr->Value('ca_compania')." -> ".number_format($nom,2)."</TD>";
//				echo "</TR>";
//			}
//			$tr->MoveNext();
//	       }
		$rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "</CENTER>";
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>