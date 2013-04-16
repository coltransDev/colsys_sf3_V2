<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONCEPTOS.PHP                                                  \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de conceptos para tráfico.  \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Conceptos de Tarifas';
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$modalidades= array("CONSOLIDADO","DIRECTO","LCL","FCL","COLOADING","PROYECTOS"); // Arreglo con los tipos de Modalidades de Carga
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_conceptos")) {                            // Selecciona todos lo registros de la tabla Conceptos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'conceptos.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='conceptos.php'>";          // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH WIDTH=10></TH>";
    echo "<TH>ID</TH>";
    echo "<TH>Concepto</TH>";
    echo "<TH>Unidad</TH>";
    echo "<TH>Modalidad</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$tra_mem = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   if ($rs->Value('ca_transporte') != $tra_mem) {
           echo "<TR>";
           echo "<TD Class=listar COLSPAN=6 style='font-size: 15px; font-weight:bold;'>".$rs->Value('ca_transporte')."</TD>";
		   $tra_mem = $rs->Value('ca_transporte');
           echo "</TR>";
	      }
       echo "<TR>";
       echo "<TD Class=mostrar></TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_idconcepto')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_concepto')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_unidad')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
       echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idconcepto').");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idconcepto').");'>";
	   echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar COLSPAN=2></TD>";
       echo "  <TD Class=mostrar COLSPAN=3>".$rs->Value('ca_pregunta')."</TD>";
       echo "  <TD Class=mostrar></TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
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
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.concepto.value == '')";
			 echo "      alert('El campo Concepto no es válido');";
			 echo "  else if (document.adicionar.unidad.value == '')";
			 echo "      alert('El campo Unidad no es válido');";
			 echo "  else if (document.adicionar.pregunta.value == '')";
			 echo "      alert('El campo Pregunta no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='conceptos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre el nuevo Concepto para Tarifa</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Concepto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='concepto' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Unidad:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='unidad' SIZE=20 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                  }
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i].">".$modalidades[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Pregunta:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='pregunta' SIZE=40 MAXLENGTH=250></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Límite Inferior:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='liminferior' SIZE=10 MAXLENGTH=8></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"conceptos.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.concepto.focus()</script>";
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
             if (!$rs->Open("select * from tb_conceptos where ca_idconcepto = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'conceptos.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.concepto.value == '')";
			 echo "      alert('El campo Concepto no es válido');";
			 echo "  else if (document.modificar.unidad.value == '')";
			 echo "      alert('El campo Unidad no es válido');";
			 echo "  else if (document.modificar.pregunta.value == '')";
			 echo "      alert('El campo Pregunta no es válido');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='conceptos.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Concepto de Tarifa</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idconcepto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Concepto:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='concepto' VALUE=\"".$rs->Value('ca_concepto')."\" SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Unidad:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='unidad' VALUE=\"".$rs->Value('ca_unidad')."\" SIZE=20 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i];
                  if ($rs->Value('ca_transporte')==$transportes[$i]) {
                      echo " SELECTED"; }
				  echo ">".$transportes[$i];
                  }
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='modalidad'>";
             for ($i=0; $i < count($modalidades); $i++) {
                  echo " <OPTION VALUE=".$modalidades[$i];
                  if ($rs->Value('ca_modalidad')==$modalidades[$i]) {
                      echo " SELECTED"; }
				  echo ">".$modalidades[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Pregunta:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='pregunta' VALUE='".$rs->Value('ca_pregunta')."' SIZE=40 MAXLENGTH=250></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Límite Inferior:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='liminferior' VALUE='".$rs->Value('ca_liminferior')."' SIZE=10 MAXLENGTH=8></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"conceptos.php\"'></TH>";  // Cancela la operación
             echo"<script>modificar.concepto.focus()</script>";
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
             if (!$rs->Open("select * from tb_conceptos where ca_idconcepto = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'conceptos.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='conceptos.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Concepto de Tarifa a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idconcepto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Concepto:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_concepto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Unidad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_unidad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Pregunta:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_pregunta')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Límite Inferior:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_liminferior')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"conceptos.php\"'></TH>";  // Cancela la operación
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
    settype($liminferior,"double");
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
		     $concepto = addslashes($concepto);
		     $unidad = addslashes($unidad);
             if (!$rs->Open("insert into tb_conceptos (ca_concepto, ca_unidad, ca_transporte, ca_modalidad, ca_pregunta, ca_liminferior) values('$concepto', '$unidad', '$transporte', '$modalidad', '$pregunta', $liminferior)")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'conceptos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
		     $concepto = addslashes($concepto);
		     $unidad = addslashes($unidad);
             if (!$rs->Open("update tb_conceptos set ca_concepto = '$concepto', ca_unidad = '$unidad', ca_transporte = '$transporte', ca_modalidad = '$modalidad', ca_pregunta = '$pregunta', ca_liminferior = $liminferior where ca_idconcepto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'conceptos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_conceptos where ca_idconcepto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'conceptos.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'conceptos.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>