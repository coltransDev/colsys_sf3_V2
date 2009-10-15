<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TRANSPORTISTAS.PHP                                          \\
// Creado:        2004-04-30                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-30                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Transportistas con los\\
//                Coltrans S.A. tiene convenio                                \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$titulo = 'Maestra de Transportistas Coltrans S.A. en el mundo';
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_transportistas")) {                       // Selecciona todos lo registros de la tabla Trasportistas
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>Tabla de Transportistas Coltrans S.A.</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
	echo "    document.location.href = 'transportistas.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand'";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='transportistas.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID</TH>";
    echo "<TH COLSPAN=4>Nombre de Transportista</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "<TD WIDTH=44 Class=mostrar>".number_format($rs->Value('ca_idtransportista'))."</TD>";
       echo "<TD Class=mostrar COLSPAN=4><B>".$rs->Value('ca_nomtransportista')."</B></TD>";
       echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
	   echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idtransportista').");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idtransportista').");'>";
	   echo "  </TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar ROWSPAN=5></TD>";
       echo "  <TD Class=mostrar>Dirección :</TD>";
	   echo "  <TD Class=mostrar COLSPAN=3>".$rs->Value('ca_direccion')."</TD>";
       echo "  <TD Class=mostrar ROWSPAN=5></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar>Teléfonos :</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
       echo "  <TD Class=mostrar>Fax :</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar>Ciudad :</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
       echo "  <TD Class=mostrar>Pais :</TD>";
       echo "  <TD Class=mostrar>".$rs->Value('ca_trafico')."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar>Web Site :</TD>";
       echo "  <TD Class=mostrar COLSPAN=2><a href='http://".$rs->Value('ca_website')."'target='_blank'>".$rs->Value('ca_website')."</a></TD>";
       echo "  <TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"transporcontac.php?id=".$rs->Value('ca_idtransportista')."\"' style='color=blue;'>Contactos</TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=mostrar>Email :</TD>";
       echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_email')."</TD>";
       echo "  <TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"transporlineas.php?id=".$rs->Value('ca_idtransportista')."\"' style='color=blue;'>Líneas de Transporte</TD>";
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
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades where ca_idtrafico='CO-057'")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>Tabla de Contactos por Transportista</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.id.value == 0)";
			 echo "      alert('El campo Identificación no es válido');";
			 echo "  else if (document.adicionar.digito.value == '')";
			 echo "      alert('El campo Digito de Verificación no es válido');";
			 echo "  else if (document.adicionar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
			 echo "  else if (document.adicionar.telefonos.value == '')";
			 echo "      alert('El campo Teléfonos no es válido');";
			 echo "  else if (document.adicionar.fax.value == '')";
			 echo "      alert('El campo Fax no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='transportistas.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos para el nuevo Contacto</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='id' SIZE=11 MAXLENGTH=9>-<INPUT TYPE='TEXT' NAME='digito' SIZE=2 MAXLENGTH=1></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' SIZE=40 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' SIZE=60 MAXLENGTH=80></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad').">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='website' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transportistas.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.id.focus()</script>";
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
             if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_nombre from vi_ciudades where ca_idtrafico='CO-057'")) {       // Selecciona todos lo registros de la tabla Ciudades
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'agentes.php';</script>";
                 exit; }
             if (!$rs->Open("select * from vi_transportistas where ca_idtransportista = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<H3>$titulo</H3>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.nombre.value == '')";
			 echo "      alert('El campo Nombre no es válido');";
			 echo "  else if (document.modificar.direccion.value == '')";
			 echo "      alert('El campo Dirección no es válido');";
			 echo "  else if (document.modificar.telefonos.value == '')";
			 echo "      alert('El campo Teléfonos no es válido');";
			 echo "  else if (document.modificar.fax.value == '')";
			 echo "      alert('El campo Fax no es válido');";
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
             echo "<H3>Maestra de Transportistas Coltrans S.A.</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='transportistas.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Transportista</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idtransportista')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='nombre' VALUE='".$rs->Value('ca_nomtransportista')."' SIZE=40 MAXLENGTH=60 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='direccion' VALUE='".$rs->Value('ca_direccion')."' SIZE=60 MAXLENGTH=80></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='telefonos' VALUE='".$rs->Value('ca_telefonos')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fax' VALUE='".$rs->Value('ca_fax')."' SIZE=30 MAXLENGTH=30></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idciudad'>";             // Llena el cuadro de lista con los valores de la tabla Ciudades
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idciudad');
                     if ($tm->Value('ca_idciudad')==$rs->Value('ca_idciudad')) {
                         echo" SELECTED"; }
					 echo ">".$tm->Value('ca_ciudad')." «".$tm->Value('ca_nombre')."»</OPTION>";
                     $tm->MoveNext();
                   }
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='website' VALUE='".$rs->Value('ca_website')."' SIZE=60 MAXLENGTH=60 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='email' VALUE='".$rs->Value('ca_email')."' SIZE=40 MAXLENGTH=40 style='text-transform: lowercase'></TD>";
             echo "</TR>";
             echo"</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo"<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo"<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transportistas.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from vi_transportistas where ca_idtransportista = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='eliminar' ACTION='transportistas.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Transportista a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idtransportista')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Nombre:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomtransportista')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Dirección:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_direccion')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Teléfonos:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_telefonos')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Fax:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_fax')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Página Web:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_website')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Electrónico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_email')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"transportistas.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_transportistas (ca_idtransportista, ca_digito, ca_nombre, ca_direccion, ca_telefonos, ca_fax, ca_idciudad, ca_website, ca_email) values($id, $digito, upper('$nombre'), '$direccion', '$telefonos', '$fax', '$idciudad', lower('$website'), lower('$email'))")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_transportistas set ca_nombre = upper('$nombre'), ca_direccion = '$direccion', ca_telefonos = '$telefonos', ca_fax = '$fax', ca_idciudad = '$idciudad', ca_website = lower('$website'), ca_email = lower('$email') where ca_idtransportista = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_transportistas where ca_idtransportista = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'transportistas.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'transportistas.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>