<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       MONEDAS.PHP                                                 \\
// Creado:        2004-04-27                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-27                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Monedas para cada     \\
//                tráfico                                                     \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Monedas para Tráficos';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_monedas")) {                              // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'monedas.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='monedas.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=400 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH>Nombre</TH>";
    echo "<TH>Moneda Ref.</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "<TD Class=mostrar>".$rs->Value('ca_idmoneda')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
       echo "<TD Class=mostrar>".$rs->Value('ca_nomreferencia')."</TD>";
       echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  \"".$rs->Value('ca_idmoneda')."\");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$rs->Value('ca_idmoneda')."\");'>";
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
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idmoneda, ca_nombre from tb_monedas")) {         // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='monedas.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre la nueva Moneda</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Moneda de Referencia:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='referencia'>";            // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idmoneda').">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"monedas.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.nombre.focus()</script>";
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
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select ca_idmoneda, ca_nombre from tb_monedas")) {         // Selecciona todos lo registros de la tabla Modelos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_monedas where ca_idmoneda = '$id'")) {   // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='monedas.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos sobre la Moneda</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idmoneda')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nombre')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Moneda de Referencia:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='referencia'>";            // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idmoneda');
                     if ($tm->Value('ca_idmoneda')==$rs->Value('ca_referencia')) {
                         echo" SELECTED"; }
					 echo">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"monedas.php\"'></TH>";  // Cancela la operación
             echo"<script>modificar.nombre.focus()</script>";
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
             if (!$rs->Open("select * from vi_monedas where ca_idmoneda = '$id'")) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='monedas.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos de la Moneda a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idmoneda')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Moneda de Referencia:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomreferencia')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"monedas.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_monedas (ca_nombre, ca_referencia) values('$nombre', '$referencia')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_monedas set ca_nombre = '$nombre', ca_referencia = '$referencia' where ca_idmoneda = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_monedas where ca_idmoneda = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'monedas.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'monedas.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>