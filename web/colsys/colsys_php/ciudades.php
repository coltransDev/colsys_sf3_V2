<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CIUDADES.PHP                                                \\
// Creado:        2004-04-28                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-28                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de Ciudades para cada    \\
//                tráfico                                                     \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 65;
  
$titulo = 'Maestra de Ciudades para Tráfico';
$puertos = array("Aéreo","Marítimo","Ambos","Terrestre","Ninguno");                        // Arreglo con los tipos de Ciudades
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // 
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from vi_ciudades")) {                             // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, idciudad){";
  	echo "    document.location.href = 'ciudades.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand'";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='ciudades.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Tráfico</TH>";
    echo "<TH>IdCiudad</TH>";
    echo "<TH>Ciudad</TH>";
    echo "<TH>Puerto</TH>";
    echo "<TH>Contactos</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
	$nom_tra = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	   if ($rs->Value('ca_nombre') != $nom_tra) {
           echo "<TR>";
           echo "<TD WIDTH=105 Class=listar><IMG src='".$rs->Value('ca_bandera')."' width=\"103\" height=\"69\"></TD>";
           echo "<TD Class=mostrar COLSPAN=4 style='font-size: 15px; font-weight:bold;'>".$rs->Value('ca_nombre')."&nbsp&nbsp(".$rs->Value('ca_idtrafico').")</TD>";
           echo "<TD Class=mostrar></TD>";
		   $nom_tra = $rs->Value('ca_nombre');
           echo "</TR>";
	      }
	   while ($rs->Value('ca_nombre')== $nom_tra and !$rs->Eof()){
             echo "<TR>";
             echo "<TD Class=mostrar></TD>";
 			 echo "<TD Class=mostrar>".$rs->Value('ca_idciudad')."</TD>";
			 echo "<TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
			 echo "<TD Class=mostrar>".$rs->Value('ca_puerto')."</TD>";
             echo "<TD Class=mostrar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href = \"representantes.php?id=".$rs->Value('ca_idciudad')."\"' style='color=blue;'>Contactos</TD>";
             echo "  <TD WIDTH=44 Class=mostrar>";											   // Botones para hacer Mantenimiento a la Tabla
             echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", \"".$rs->Value('ca_idciudad')."\");'>";
             echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$rs->Value('ca_idciudad')."\");'>";
             echo "  </TD>";
             echo "</TR>";
             $rs->MoveNext();
		     }
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
             if (!$tm->Open("select ca_idtrafico, ca_nombre from tb_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }             
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.adicionar.ciudad.value == '')";
			 echo "      alert('El campo Ciudad no es válido');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='ciudades.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE WIDTH=270 CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre la nueva Ciudad</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Id:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='id' SIZE=10 MAXLENGTH=8 style='text-transform: uppercase'></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idtrafico'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo " <OPTION VALUE=".$tm->Value('ca_idtrafico').">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='ciudad' SIZE=40 MAXLENGTH=50></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Puerto:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='puerto'>";
             for ($i=0; $i < count($puertos); $i++) {
                  echo " <OPTION VALUE=".$puertos[$i].">".$puertos[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"ciudades.php\"'></TH>";  // Cancela la operación
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
             if (!$tm->Open("select ca_idtrafico, ca_nombre from tb_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit; }             
             if (!$rs->Open("select * from vi_ciudades where ca_idciudad = '$id'")) {  // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
			 echo "  if (document.modificar.ciudad.value == '')";
			 echo "      alert('El campo Ciudad no es válido');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='ciudades.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=270 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";             // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos sobre la Ciudad</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Id:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='idtrafico'>";             // Llena el cuadro de lista con los valores de la tabla Traficos
             while ( !$tm->Eof()) {
                     echo "<OPTION VALUE=".$tm->Value('ca_idtrafico');
                     if ($tm->Value('ca_idtrafico')==$rs->Value('ca_idtrafico')) {
                         echo " SELECTED"; }
					 echo ">".$tm->Value('ca_nombre')."</OPTION>";
                     $tm->MoveNext();
                   }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='ciudad' VALUE='".$rs->Value('ca_ciudad')."' SIZE=40 MAXLENGTH=50></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Puerto:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='puerto'>";
             for ($i=0; $i < count($puertos); $i++) {
                  echo " <OPTION VALUE=".$puertos[$i];
                  if ($rs->Value('ca_puerto')==$puertos[$i]) {
                      echo " SELECTED"; }
				  echo ">".$puertos[$i];
                  }
             echo "  </SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"ciudades.php\"'></TH>";  // Cancela la operación
             echo "<script>modificar.idtrafico.focus()</script>";
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
             if (!$rs->Open("select * from vi_ciudades where ca_idciudad = '$id'")) {  // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='ciudades.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE WIDTH=270 CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";             // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Datos de la Ciudad a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Id:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tráfico:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_nombre')."</TD>";      // Llena el cuadro de lista con los valores de la tabla Traficos
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Ciudad:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_ciudad')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Puerto:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_puerto')."</TD>";
             echo "</TR>";
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"ciudades.php\"'></TH>";  // Cancela la operación
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
             if (!$rs->Open("insert into tb_ciudades (ca_idciudad, ca_ciudad, ca_idtrafico, ca_puerto) values(upper('$id'), '$ciudad', '$idtrafico', '$puerto')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             if (!$rs->Open("update tb_ciudades set ca_ciudad = '$ciudad', ca_idtrafico = '$idtrafico', ca_puerto = '$puerto' where ca_idciudad = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_ciudades where ca_idciudad = '$id'")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'ciudades.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'ciudades.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>