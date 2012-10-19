<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPRESENTANTES.PHP                                          \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Contactos por Tipo de \\
//                transporte para cada ciudad de un tráfico                   \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Contactos por Ciudad de Tráfico';
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select * from vi_ciudades where ca_idciudad='$id'")) {     // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'representantes.php';</script>";
        exit; }
    
    if (!$rs->Open("select * from vi_representantes where ca_idciudad='$id'")) {  // Selecciona todos lo registros de la tabla Representantes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";         // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, oid){";
	echo "    document.location.href = 'representantes.php?boton='+opcion+'\&id='+id+'\&oid='+oid;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='representantes.php'>";     // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=550 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TD Class=captura style='font-size: 11px; font-weight:bold;'>Tráfico :</TD>";
	echo "<TD Class=mostrar style='font-size: 11px;'>".$tm->Value('ca_nombre')."</TD>";
    echo "<TD Class=captura style='font-size: 11px; font-weight:bold;'>Ciudad :</TD>";
	echo "<TD Class=mostrar style='font-size: 11px;'>".$tm->Value('ca_ciudad')."</TD>";
    echo "<TD Class=captura style='font-size: 11px; font-weight:bold;'>Grupo :</TD>";
	echo "<TD Class=mostrar style='font-size: 11px;'>".$tm->Value('ca_descripcion')."</TD>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", \"".$id."\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$tra_mem = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                              // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($rs->Value('ca_transporte') != $tra_mem) {
	       echo "<TR>";
           echo "<TD Class=partir style='font-size: 12px;' COLSPAN=7>Terminales ".$rs->Value('ca_transporte')."s</TD>";
           $tra_mem = $rs->Value('ca_transporte');
		   echo "</TR>";
	      }
       if ($rs->Value('ca_terminal') != "") {
           echo "<TR>";
           echo "<TD Class=mostrar style='font-size: 11px; font-weight:bold;' COLSPAN=7>".$rs->Value('ca_terminal')."</TD>";
           echo "</TR>";
		  }
       echo "<TR>";
       echo "<TD Class=listar style='font-weight:bold;'>Agente :</TD>";
       echo "<TD Class=listar COLSPAN=2><B>".$rs->Value('ca_nomagente')."</B><BR>".$rs->Value('ca_diragente')."<BR>".$rs->Value('ca_telagente')."<BR>".$rs->Value('ca_faxagente')."<BR>".$rs->Value('ca_maiagente')."</TD>";
       echo "<TD Class=listar style='font-weight:bold;'>Contacto :</TD>";
       echo "<TD Class=listar COLSPAN=2><B>".$rs->Value('ca_nomcontacto')."</B><BR>".$rs->Value('ca_dircontacto')."<BR>".$rs->Value('ca_telcontacto')."<BR>".$rs->Value('ca_faxcontacto')."<BR>".$rs->Value('ca_maicontacto')."</TD>";
       echo "  <TD WIDTH=44 Class=mostrar style='text-align:center'>";											   // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", \"".$id."\", ".$rs->Value('ca_oid').");'>";
	   echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$id."\", ".$rs->Value('ca_oid').");'>";
	   echo "  </TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
	if ($rs->IsEmpty()) {
        echo "<TR>";
		echo "<TH Class=mostrar COLSPAN=7>&nbsp;</TH>";
        echo "</TR>";
	   }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"ciudades.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("select * from vi_ciudades where ca_idciudad='$id'")) {    // Mueve el apuntador al registro
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_contactos where ca_idtrafico = '".$rs->Value('ca_idtrafico')."'")) { // Selecciona todos lo registros de la tabla Contactos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='representantes.php'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Datos sobre el nuevo Contacto para esta Ciudad</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar style='font-size: 13px; font-weight:bold;'><IMG src='".$rs->Value('ca_bandera')."' width=\"103\" height=\"69\">&nbsp;&nbsp;".$rs->Value('ca_nombre')."</TD>";      // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar style='font-size: 11px; font-weight:bold;'>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Contacto:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idcontacto'>";            // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idcontacto').">".$tm->Value('ca_nomagente')." - ".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Terminal:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='terminal' SIZE=50 MAXLENGTH=50></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='transporte'>";
             for ($i=0; $i < count($transportes); $i++) {
                  echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                  }
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"representantes.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.idcontacto.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Modificar': {                                                    // Opcion para Adicionar Registros a la tabla
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$rs->Open("select * from vi_ciudades where ca_idciudad='$id'")) {    // Mueve el apuntador al registro
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_contactos where ca_idtrafico = '".$rs->Value('ca_idtrafico')."'")) { // Selecciona todos lo registros de la tabla Contactos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='modificar' ACTION='representantes.php'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";           // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos para el Contacto en esta Ciudad</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar style='font-size: 13px; font-weight:bold;'><IMG src='".$rs->Value('ca_bandera')."' width=\"103\" height=\"69\">&nbsp;&nbsp;".$rs->Value('ca_nombre')."</TD>";      // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar style='font-size: 11px; font-weight:bold;'>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             if (!$rs->Open("select * from vi_representantes where ca_oid = ".$oid)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             echo "<TR>";
             echo "  <TD Class=captura>Contacto:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idcontacto'>";            // Llena el cuadro de lista con los valores de la tabla Agentes
             while ( !$tm->Eof()) {
                     echo"<OPTION VALUE=".$tm->Value('ca_idcontacto');
                     if ($rs->Value('ca_idcontacto')==$tm->Value('ca_idcontacto')) {
                         echo " SELECTED"; }
					 echo">".$tm->Value('ca_nomagente')." - ".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Terminal:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='terminal' VALUE='".$rs->Value('ca_terminal')."' SIZE=50 MAXLENGTH=50></TD>";
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
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"representantes.php?id=$id\"'></TH>";  // Cancela la operación
             echo "<script>modificar.idcontacto.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_ciudades where ca_idciudad='$id'")) {    // Mueve el apuntador al registro
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='representantes.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=300 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$id."'>";              // Hereda el Id del registro que se esta modificando
             echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=".$oid.">";           // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Contacto en esta Ciudad a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar style='font-size: 13px; font-weight:bold;'><IMG src='".$rs->Value('ca_bandera')."' width=\"103\" height=\"69\">&nbsp;&nbsp;".$rs->Value('ca_nombre')."</TD>";      // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar style='font-size: 11px; font-weight:bold;'>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             if (!$rs->Open("select * from vi_representantes where ca_oid = ".$oid)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             echo "<TR>";
             echo "  <TD Class=captura>Contacto :</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nomcontacto')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Terminal :</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_terminal')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte :</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"representantes.php?id=$id\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_representantes (ca_idciudad, ca_idcontacto, ca_terminal, ca_transporte) values('$id', '$idcontacto', '$terminal', '$transporte')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'representantes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_representantes set ca_idcontacto = '$idcontacto', ca_terminal = '$terminal', ca_transporte = '$transporte' where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'representantes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_representantes where oid = $oid")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'representantes.php?id=$id';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'representantes.php?id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>