<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TRANSPORTLINEAS.PHP                                         \\
// Creado:        2004-09-24                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-09-24                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Lineas Aéreas y       \\
//                Maritimas que maneja cada Transportista                     \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$titulo = 'Líneas de Carga por Transportista';
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_transporlineas where ca_idtransportista = $id")) {       					   // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, co){";
	echo "    document.location.href = 'transporlineas.php?boton='+opcion+'\&id='+id+'\&co='+co;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='transportistas.php'>";     // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantenimientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID Transportista</TH>";
    echo "<TH>ID Línea</TH>";
    echo "<TH>Nombre de la Línea</TH>";
    echo "<TH>Sigla</TH>";
    echo "<TH>Trasporte</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", ".$id.", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$id_temp = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   if ($rs->Value('ca_idtransportista') != $id_temp) {
           echo "<TR>";
           echo "  <TD WIDTH=90 Class=mostrar style='font-weight:bold;'>".number_format($rs->Value('ca_idtransportista'))."</TD>";
           echo "  <TD Class=mostrar style='font-weight:bold;' COLSPAN=4>".$rs->Value('ca_nomtransportista')."</TD>";
           echo "  <TD Class=mostrar></TD>";
           echo "</TR>";
		   $id_temp = $rs->Value('ca_idtransportista');
    	   }
	   while($id_temp == $rs->Value('ca_idtransportista') and !$rs->Eof()){
             echo "<TR>";
             echo "  <TD Class=mostrar></TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idlinea')."</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_sigla')."</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
       	     echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", ".$id.", ".$rs->Value('ca_idlinea').");'>";
      	     echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", ".$id.", ".$rs->Value('ca_idlinea').");'>";
      	     echo "  </TD>";
             echo "</TR>";
      	     $rs->MoveNext();
      	    }
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"transportistas.php\"'></TH>";  // Cancela la operación
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='transporlineas.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=350 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Datos para la nueva Línea de Carga</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sigla:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sigla' SIZE=20 MAXLENGTH=20></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transporlineas.php?id=$id\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from vi_transporlineas where ca_idtransportista = $id and ca_idlinea = $co")) {  // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='transporlineas.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE='".$co."'>";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para la Línea de Carga</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Transportista:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomtransportista')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idlinea')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nombre')."' SIZE=40 MAXLENGTH=60></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sigla:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='sigla' VALUE='".$rs->Value('ca_sigla')."' SIZE=20 MAXLENGTH=20></TD>";
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
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transporlineas.php?id=$id\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from vi_transporlineas where ca_idtransportista = $id and ca_idlinea = $co")) { // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             echo "<TITLE>$titulo</TITLE>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='transporlineas.php'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<INPUT TYPE='HIDDEN' NAME='co' VALUE='".$co."'>";           // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos de la Línea de Carga a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Transportista:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomtransportista')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idlinea')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Sigla:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_sigla')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transporlineas.php?id=$id\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_transporlineas (ca_idtransportista, ca_nombre, ca_sigla, ca_transporte) values($id, '$nombre', '$sigla', '$transporte')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transporlineas.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_transporlineas set ca_nombre = '$nombre', ca_sigla = '$sigla', ca_transporte = '$transporte' where ca_idtransportista = $id and ca_idlinea = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transporlineas.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_transporlineas where ca_idtransportista = $id and ca_idlinea = $co")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transporlineas.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'transporlineas.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>