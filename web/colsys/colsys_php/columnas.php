<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COLUMNAS.PHP                                                \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la maestra de columnas para tablas\\
//                de Gastos                                                   \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$titulo = 'Maestra de Columnas para Tablas de Gastos';
$tipos = array("Numérico","Caracter","Fecha","Hora","Texto");     			   // Arreglo con los tipos de campo que maneja el Sistema para columnas de Plantilla
$contenidos = array("Selector","Información","Valor");                         // Arreglo con los tipos de contenido de cada Columna
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_columnas where ca_idtblgastos = $id")) {  // Selecciona todos lo registros de la tabla Grupos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, co){";
	echo "    document.location.href = 'columnas.php?boton='+opcion+'\&id='+id+'\&co='+co;";
    echo "}";
    echo "</script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='columnas.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Nombre Columna</TH>";
    echo "<TH>Mascara</TH>";
    echo "<TH>Tipo</TH>";
    echo "<TH>Longitud</TH>";
    echo "<TH>Contenido</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", ".$id.", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "<TD Class=mostrar>".$rs->Value('ca_columna')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_mascara')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_tipo')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_longitud')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_contenido')."</TD>";
       echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$id.", ".$rs->Value('ca_idcolumna').");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", ".$id.", ".$rs->Value('ca_idcolumna').");'>";
	   echo "  </TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"gastos.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             include_once 'include/val_campo.php';                             // Carga una rutina JavaScript de validaciones
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.columna.value == '')";
			 echo "      alert('El campo Descripción no es válido');";
			 echo "  else";
			 echo "      return (true);";
			 echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='columnas.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";
             echo "<TH Class=titulo COLSPAN=2>Datos para la nueva Columna</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre de Columna:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='columna' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Dato:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipo' ONCHANGE='llenar(adicionar.tipo,adicionar.enteros,adicionar.decimales);'>";
             for ($i=0; $i < count($tipos); $i++) {
                  echo"  <OPTION VALUE=".$tipos[$i].">".$tipos[$i];
                  }
             echo "</SELECT>";
             echo "&nbsp;&nbsp;<SELECT NAME='enteros'>";
             echo "  <OPTION>Cifras Enteras";
             for ($i=1; $i <= 20; $i++) {
                  echo"  <OPTION VALUE=".$i.">".$i;
                  }
             echo "</SELECT>";
             echo "&nbsp;&nbsp;<SELECT NAME='decimales'>";
             echo "  <OPTION>Cifras Decimales";
             for ($i=0; $i <= 5; $i++) {
                  echo"  <OPTION VALUE=".$i.">".$i;
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tamaño de Columna:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='longitud' SIZE=10 MAXLENGTH=10></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contenido de Columna:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='contenido'>";
             for ($i=0; $i < count($contenidos); $i++) {
                  echo " <OPTION VALUE='".$contenidos[$i]."'>".$contenidos[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"columnas.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.columna.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Modificar': {
             $modulo = "00100200";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from tb_columnas where ca_idtblgastos = ".$id." and ca_idcolumna = ".$co)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'columnas.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             include_once 'include/val_campo.php';                             // Carga una rutina JavaScript de validaciones
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.columna.value == '')";
			 echo "      alert('El campo Descripción no es válido');";
			 echo "  else";
			 echo "      return (true);";
			 echo "  return (false);";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='columnas.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE=".$co.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos sobre el Tipo de Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre de Columna:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='columna' VALUE='".$rs->Value('ca_columna')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo"<TR>";
             echo"  <TD Class=captura>Tipo de Dato:</TD>";
             echo"  <TD Class=mostrar COLSPAN=2><SELECT NAME='tipo' ONCHANGE='llenar(adicionar.tipo,adicionar.enteros,adicionar.decimales);'>";
             for ($i=0; $i < count($tipos); $i++) {
                  $ele = ($tipos[$i] == $rs->Value('ca_tipo'))?(" SELECTED"):(" ");
                  echo"  <OPTION VALUE=".$tipos[$i].$ele.">".$tipos[$i];
                  }
             echo"</SELECT>";
             if ($rs->Value('ca_tipo') == "Numérico") {
                 $enteros  = array('Cifras Enteras',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
                 $decimales= array('Cifras Decimales',0,1,2,3,4,5);
                 $valor1   = strpos($rs->Value('ca_mascara'),'.');
                 $valor1   = ($valor1 > 0)?($valor1):($rs->Value('ca_longitud'));
                 $valor2   = strlen($rs->Value('ca_mascara')) - $valor1 - 1;
                }
             elseif ($rs->Value('ca_tipo') == "Caracter") {
                 $enteros  = array('Ingrese la longitud de campo');
                 $decimales= array('en el siguiente renglón');
                 $valor1   = 0;
                 $valor2   = 0;
                }
             elseif ($rs->Value('ca_tipo') == "Fecha") {
                 $enteros  = array("Formato","dd mm yy","yy mm dd","mm dd yy","dd mm yyyy","yyyy mm dd","mm dd yyyy");
                 $decimales= array("Separador","-","/",".");
                 $valor1   = strtr($rs->Value('ca_mascara'), '-/.', '   ');
                 for ($i=0; $i<3; $i++){
                      if (strrpos($rs->Value('ca_mascara'), $decimales[$i])) {
                          $valor2 = $decimales[$i];
                          break;
                         }
                     }
                }
             elseif ($rs->Value('ca_tipo') == "Hora") {
                 $enteros  = array("hh:mm:ss","hh:mm","hh");
                 $decimales= array("12 horas","24 horas");
                 for ($i=0; $i<3; $i++) {
                      if (!strcasecmp($enteros[$i], $rs->Value('ca_mascara'))) {
                          $valor1 = $enteros[$i];
                          if (!strcmp($enteros[$i], $rs->Value('ca_mascara')))
                              $valor2 = $decimales[0];
                          else
                              $valor2 = $decimales[1];
                          break;
                         }
                     }
                }
             else {
                 $enteros  = array();
                 $decimales= array();
                }
             echo"&nbsp;&nbsp;<SELECT NAME='enteros'>";
             for ($i=0; $i < count($enteros); $i++) {
                  $ele = ($enteros[$i] == $valor1)?(" SELECTED"):(" ");
                  echo"  <OPTION VALUE=".$enteros[$i].$ele.">".$enteros[$i];
                  }
             echo"</SELECT>";
             echo"&nbsp;&nbsp;<SELECT NAME='decimales'>";
             for ($i=0; $i < count($decimales); $i++) {
                  $ele = ($decimales[$i] == $valor2)?(" SELECTED"):(" ");
                  echo"  <OPTION VALUE=".$decimales[$i].$ele.">".$decimales[$i];
                  }
             echo"</SELECT>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tamaño de Columna:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='longitud' VALUE=".$rs->Value('ca_longitud')." SIZE=10 MAXLENGTH=10></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contenido de Columna:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='contenido'>";
             for ($i=0; $i < count($contenidos); $i++) {
                  echo " <OPTION VALUE='".$contenidos[$i]."'";
                  if ($rs->Value('ca_contenido')==$contenidos[$i]) {
                      echo " SELECTED"; }
				  echo ">".$contenidos[$i];
                  }
             echo "</SELECT>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"columnas.php?id=$id\"'></TH>";  // Cancela la operación
             echo"<script>adicionar.columna.focus()</script>";
             echo"</TABLE>";
             echo"</FORM>";
             echo"</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from tb_columnas where ca_idtblgastos = ".$id." and ca_idcolumna = ".$co)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'columnas.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='columnas.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE=".$co.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Datos de la Columna a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre de Columna:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_columna')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Mascara:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_mascara')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo de Dato:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_tipo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Longitud:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_longitud')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contenido:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_contenido')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"columnas.php?id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
      }
   }
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
             if ($tipo == 'Numérico')
                 if($decimales > 0) {
                    $longitud= $enteros+$decimales+1;
                    $mascara = str_repeat("9", $enteros).".".str_repeat("9", $decimales); }
                 else {
                    $longitud= $enteros;
                    $mascara = str_repeat("9", $enteros); }
             elseif ($tipo == 'Caracter')
                 $mascara = '';
             elseif ($tipo == 'Fecha') {
                 $mascara = str_replace(" ",$decimales,$enteros);
                 $longitud= strlen($mascara); }
             elseif ($tipo == 'Hora') {
                 if ($decimales == '12 horas')
                     $mascara = strtolower($enteros);
                 else
                     $mascara = strtoupper($enteros);
                 $longitud= strlen($mascara); }
             else {
                 $mascara = '';
                 $longitud= 0;
                 }
             if (!$rs->Open("insert into tb_columnas (ca_idtblgastos, ca_columna, ca_mascara, ca_tipo, ca_longitud, ca_contenido) values($id, '$columna', '$mascara', '$tipo', $longitud, '$contenido')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'columnas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if ($tipo == 'Numérico')
                 if($decimales > 0) {
                    $longitud= $enteros+$decimales+1;
                    $mascara = str_repeat("9", $enteros).".".str_repeat("9", $decimales); }
                 else {
                    $longitud= $enteros;
                    $mascara = str_repeat("9", $enteros); }
             elseif ($tipo == 'Caracter')
                 $mascara = '';
             elseif ($tipo == 'Fecha') {
                 $mascara = str_replace(" ",$decimales,$enteros);
                 $longitud= strlen($mascara); }
             elseif ($tipo == 'Hora') {
                 if ($decimales == '12 horas')
                     $mascara = strtolower($enteros);
                 else
                     $mascara = strtoupper($enteros);
                 $longitud= strlen($mascara); }
             else {
                 $mascara = '';
                 $longitud= 0;
                 }
             if (!$rs->Open("update tb_columnas set ca_columna = '$columna', ca_mascara = '$mascara', ca_tipo = '$tipo', ca_longitud = $longitud, ca_contenido = '$contenido' where ca_idtblgastos = $id and ca_idcolumna = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'columnas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_columnas where ca_idtblgastos = $id and ca_idcolumna = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'columnas.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'columnas.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>