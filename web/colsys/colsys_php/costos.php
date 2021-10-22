<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COSTOS.PHP                                                  \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de costos para Embarques \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Costos de Costos';
$imporexpor = array("Importación","Exportacion", "Aduanas" );                              // Arreglo con los tipos de Trayecto
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$modalidades= array("CONSOLIDADO","DIRECTO","LCL","FCL","COLOADING","PROYECTOS"); // Arreglo con los tipos de Modalidades de Carga
$comisionables = array("Sí","No");                                             // Arreglo para Si es Comisionable o No el Costo
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from tb_costos")) {                            // Selecciona todos lo registros de la tabla Costos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'costos.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='costos.php'>";          // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH>Costo</TH>";
    echo "<TH>Transporte</TH>";
    echo "<TH>Impo/Expo</TH>";
    echo "<TH>Modalidad</TH>";
    echo "<TH>Comisionable</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$tra_mem = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "<TD Class=mostrar>".$rs->Value('ca_idcosto')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_costo')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_impoexpo')."</TD>";
       echo "<TD Class=mostrar style='text-align: center;'>".$rs->Value('ca_modalidad')."</TD>";
       echo "<TD Class=mostrar style='text-align: center;'>".$rs->Value('ca_comisionable')."</TD>";
       echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idcosto').");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idcosto').");'>";
	   echo "  </TD>";
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
			 echo "  if (document.adicionar.costo.value == '')";
			 echo "      alert('El campo Costo no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='costos.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre el nuevo Costo para Carga</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Costo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='costo' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Impor/Exportación:</TD>";
             echo "  <TD Class=mostrar style='vertical-align:top;'><SELECT NAME='impoexpo'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i];
                  }
             echo "  </SELECT></TD>";
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
             echo "  <TD Class=captura>Comisionable:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='comisionable'>";
             for ($i=0; $i < count($comisionables); $i++) {
                  echo " <OPTION VALUE=".$comisionables[$i].">".$comisionables[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"costos.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.costo.focus()</script>";
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
             if (!$rs->Open("select * from tb_costos where ca_idcosto = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'costos.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.costo.value == '')";
			 echo "      alert('El campo Costo no es válido');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='costos.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Costo para Carga</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idcosto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Costo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='costo' VALUE=\"".$rs->Value('ca_costo')."\" SIZE=30 MAXLENGTH=30></TD>";
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
             echo "  <TD Class=captura>Impor/Exportación:</TD>";
             echo "  <TD Class=mostrar style='vertical-align:top;'><SELECT NAME='impoexpo'>";
             for ($i=0; $i < count($imporexpor); $i++) {
                  echo " <OPTION VALUE=".$imporexpor[$i];
                  if ($rs->Value('ca_impoexpo')==$imporexpor[$i]) {
                      echo " SELECTED"; }
				  echo ">".$imporexpor[$i];
                  }
             echo "  </SELECT></TD>";
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
             echo "  <TD Class=captura>Comisionable:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='comisionable'>";
             for ($i=0; $i < count($comisionables); $i++) {
                  echo " <OPTION VALUE=".$comisionables[$i];
                  if ($rs->Value('ca_comisionable')==$comisionables[$i]) {
                      echo " SELECTED"; }
				  echo ">".$comisionables[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"costos.php\"'></TH>";  // Cancela la operación
             echo"<script>modificar.costo.focus()</script>";
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
             if (!$rs->Open("select * from tb_costos where ca_idcosto = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'costos.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='costos.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Costo para Carga a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idcosto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Costo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_costo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Impor/Exportación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_impoexpo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Modalidad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_modalidad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Comisionable:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_comisionable')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"costos.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_costos (ca_costo, ca_transporte, ca_impoexpo, ca_modalidad, ca_comisionable) values('$costo', '$transporte', '$impoexpo', '$modalidad', '$comisionable')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'costos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_costos set ca_costo = '$costo', ca_transporte = '$transporte', ca_impoexpo = '$impoexpo', ca_modalidad = '$modalidad', ca_comisionable = '$comisionable' where ca_idcosto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'costos.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_costos where ca_idcosto = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'costos.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'costos.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>