<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
// Archivo:       RECARGOS.PHP                                                   \\
// Creado:        2004-06-25                                                     \\
// Autor:         Carlos Gilberto López M.                                       \\
// Ver:           1.00                                                           \\
// Updated:       2004-06-25                                                     \\
//                                                                               \\
// Descripción:   Módulo de mantenimiento a la tabla de Recargos de cada Trayecto\\
//                atendido por los transportista.                                \\
//                                                                               \\
// Copyright:     Coltrans S.A. - 2004                                           \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*\
*/

$titulo = 'Tabla de Recargos';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_trayectos where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(programa, opcion, id, oid){";
	echo "  if (programa == 0) ";
	echo "      document.location.href = 'fletes.php?boton='+opcion+'\&id='+id+'\&oid='+oid;";
	echo "  else";
	echo "      document.location.href = 'recargos.php?boton='+opcion+'\&id='+id+'\&oid='+oid;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH COLSPAN=8 style='font-size: 13px; font-weight:bold;'>Relación de Recargos Locales y En Origen</TH>";
    echo "</TABLE>";
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$rs->Open("select * from vi_fletes where ca_idtrayecto = $id")) {  // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $rs->MoveFirst();
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if (!$tm->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_idconcepto = ".$rs->Value('ca_idconcepto'))) {  // Selecciona todos lo registros de la tabla Modelos
           echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'entrada.php';</script>";
           exit; }
       $tm->MoveFirst();
       echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
       echo "<TR HEIGHT=5>";
       echo "<TD Class=imprimir COLSPAN=8></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=invertir COLSPAN=8 style='font-size: 12px; font-weight:bold;'>".$rs->Value('ca_concepto')."</TD>";
       echo "</TR>";
       while (!$tm->Eof() and !$tm->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
          echo "<TR>";
          echo "  <TD Class=invertir COLSPAN=4 style='font-size: 10px; font-weight:bold;'>".$tm->Value('ca_recargo')."</TD>";
          echo "  <TD Class=invertir COLSPAN=2 style='font-size: 10px; font-weight:bold;'>".$tm->Value('ca_tipo')."</TD>";
          echo "  <TD Class=invertir WIDTH=44></TD>";											   // Botones para hacer Mantenimiento a la Tabla
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=mostrar WIDTH=30></TD>";
		  if ($tm->Value('ca_vlrfijo')!= 0)
              echo "  <TD Class=mostrar>Valor Fijo:<BR><B>".number_format($tm->Value('ca_vlrfijo'),2)."</B></TD>";
		  else
              echo "  <TD Class=mostrar>Valor Fijo:<BR>&nbsp;</TD>";
		  if ($tm->Value('ca_porcentaje')!= 0) {
              echo "  <TD Class=mostrar>Porcentaje:<BR><B>".number_format($tm->Value('ca_porcentaje'),2)."%</B></TD>";
              echo "  <TD Class=mostrar>Base de Porcentaje:<BR><B>".$tm->Value('ca_baseporcentaje')."</B></TD>"; }
		  else {
              echo "  <TD Class=mostrar>Porcentaje:<BR>&nbsp;</TD>";
              echo "  <TD Class=mostrar>Base de Porcentaje:<BR>&nbsp;</TD>";
		  }
		  if ($tm->Value('ca_vlrunitario')!= 0) {
              echo "  <TD Class=mostrar>Valor Unitario:<BR><B>".number_format($tm->Value('ca_vlrunitario'),2)."</B></TD>";
              echo "  <TD Class=mostrar>Base de VlrUnitario:<BR><B>".$tm->Value('ca_baseunitario')."</B></TD>"; }
		  else {
              echo "  <TD Class=mostrar>Valor Unitario:<BR>&nbsp;</TD>";
              echo "  <TD Class=mostrar>Base de VlrUnitario:<BR>&nbsp;</TD>";
		  }
          echo "  <TD Class=mostrar ROWSPAN=2></TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=mostrar WIDTH=30></TD>";
		  if ($tm->Value('ca_observaciones')!= '')
              echo "  <TD Class=mostrar COLSPAN=4><B>Observaciones:</B><BR>".$tm->Value('ca_observaciones')."</TD>";
		  else
              echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR>&nbsp;</TD>";
          echo "  <TD Class=mostrar>Recargo Mínimo:<BR><B>".number_format($tm->Value('ca_recargominimo'),2)."</B></TD>";
          echo "</TR>";
          $tm->MoveNext();
          }
       echo "</TABLE>";
       $rs->MoveNext();
       }
    if (!$tm->Open("select * from vi_recargos where ca_idtrayecto = $id and ca_idconcepto = 9999")) {
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $tm->MoveFirst();
	echo "<BR>";
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH COLSPAN=8 style='font-size: 13px; font-weight:bold;'>Relación de Recargos Generales del Trayecto</TH>";
    while (!$tm->Eof() and !$tm->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
          echo "<TR>";
          echo "  <TD Class=invertir COLSPAN=3 style='font-size: 9px;'>Recargo:<BR><B>".$tm->Value('ca_recargo')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Tipo de Recargo:<BR><B>".$tm->Value('ca_tipo')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Aplicación:<BR><B>".$tm->Value('ca_aplicacion')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Fecha Inicio:<BR><B>".($tm->Value('ca_aplicacion')=='Temporal'?$tm->Value('ca_fchinicio'):'&nbsp;')."</B></TD>";
          echo "  <TD Class=invertir style='font-size: 9px;'>Vencimiento:<BR><B>".($tm->Value('ca_aplicacion')=='Temporal'?$tm->Value('ca_fchvencimiento'):'&nbsp;')."</B></TD>";
          echo "  <TD Class=invertir WIDTH=44>";											   // Botones para hacer Mantenimiento a la Tabla
          echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(1, \"Modificar\", $id,  \"".$tm->Value('ca_oid')."\");'>";
          echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(1, \"Eliminar\", $id, \"".$tm->Value('ca_oid')."\");'>";
          echo "  </TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=listar WIDTH=30></TD>";
          echo "  <TD Class=listar>Valor Fijo:<BR><B>".number_format($tm->Value('ca_vlrfijo'),2)."</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Porcentaje:<BR><B>".number_format($tm->Value('ca_porcentaje'),2)."%</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Base de Porcentaje:<BR><B>".$tm->Value('ca_baseporcentaje')."</B>&nbsp;</TD>";
          echo "  <TD Class=listar>Valor Unitario:<BR><B>".number_format($tm->Value('ca_vlrunitario'),2)."</B>&nbsp;</TD>";
          echo "  <TD Class=listar COLSPAN=2>Base de VlrUnitario:<BR><B>".$tm->Value('ca_baseunitario')."</B>&nbsp;</TD>";
          echo "  <TD Class=listar ROWSPAN=3></TD>";
          echo "</TR>";
          echo "<TR>";
          echo "  <TD Class=listar ROWSPAN=2 WIDTH=30></TD>";
          echo "  <TD Class=listar COLSPAN=4 ROWSPAN=2><B>Observaciones:</B><BR>".nl2br($tm->Value('ca_observaciones'))."&nbsp;</TD>";
          echo "  <TD Class=listar COLSPAN=2>Recargo Mínimo:<BR><B>".$tm->Value('ca_recargominimo')."</B>&nbsp;</TD>";
          echo "<TR>";
          echo "  <TD Class=listar COLSPAN=2>Moneda:<BR><B>".$tm->Value('ca_nombre')."</B></TD>";
          echo "</TR>";
          $tm->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>