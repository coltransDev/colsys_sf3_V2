<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TIPORECARGO.PHP                                             \\
// Creado:        2004-04-30                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-30                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de tipos de recargo en   \\
//                fletes.                                                     \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Tabla de Tipos de Recargo para Fletes';
$tipos = array("Recargo Local","Recargo en Origen");                          // Arreglo con los tipos de Transportes
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$tincoterms = array("EXW - EX Works","FCA - Free Carrier","FAS - Free Alongside Ship","FOB - Free On Board","CIF - Cost, Insuarance & Freight", "CIP - Carriage and Insurence Paid", "CPT - Carriage Paid To", "CFR - Cost and Freight", "DDP - Delivered Duty Paid", "DDU - Delivered Duty Unpaid", "DAF - Delivered at Frontier"); // Arreglo con los términos Iconterms

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!$rs->Open("select ca_valor from tb_parametros where ca_casouso = 'CU062'")) { // Selecciona los términos de la tabla Parametros
    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
    echo "<script>document.location.href = 'reportenegocio.php';</script>";
    exit;
}
$tincoterms = array(); // Arreglo con los términos Iconterms
while (!$rs->Eof()) {
    $tincoterms[] = $rs->Value('ca_valor');
    $rs->MoveNext();
}

if (!isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (!$rs->Open("select * from tb_tiporecargo order by ca_transporte, ca_recargo")) {                   // Selecciona todos lo registros de la tabla Modelos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'tiporecargo.php?boton='+opcion+'\&id='+id;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='cabecera' ACTION='tiporecargo.php'>";            // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=580 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=6>SISTEMA TARIFARIO<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Transporte</TH>";
    echo "<TH>ID</TH>";
    echo "<TH>Recargo</TH>";
    echo "<TH>Tipo</TH>";
    echo "<TH>Incoterms</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    $tra_mem = "";
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($rs->Value('ca_transporte') != $tra_mem) {
           echo "<TR>";
           echo "<TD Class=listar style='font-size: 15px; font-weight:bold;' COLSPAN=5>".$rs->Value('ca_transporte')."</TD>";
           echo "<TD Class=mostrar></TD>";
           $tra_mem = $rs->Value('ca_transporte');
           echo "</TR>";
          }
       echo "<TR>";
       echo "<TD Class=listar></TD>";
       echo "<TD Class=listar>".$rs->Value('ca_idrecargo')."</TD>";
       echo "<TD Class=listar>".$rs->Value('ca_recargo')."</TD>";
       echo "<TD Class=listar>".$rs->Value('ca_tipo')."</TD>";
       echo "<TD Class=listar>".str_replace ("|","<BR>",$rs->Value('ca_incoterms'))."</TD>";
       echo "  <TD WIDTH=44 Class=listar>";                                            // Botones para hacer Mantenimiento a la Tabla
       echo "    <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\",  ".$rs->Value('ca_idrecargo').");'>";
       echo "    <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\",  ".$rs->Value('ca_idrecargo').");'>";
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
             echo "  if (document.adicionar.recargo.value == '')";
             echo "      alert('El campo Recargo no es válido');";
//           echo "  else if (!document.modificar[4].checked)";
//           echo "      alert('Debe seleccionar por lo menos uno de los Términos de Negociación');";
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
             echo "<FORM METHOD=post NAME='adicionar' ACTION='tiporecargo.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             echo "<TABLE CELLSPACING=1>";
             echo "<TH Class=titulo COLSPAN=2>Datos sobre el nuevo Tipo de Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Recargo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='recargo' SIZE=30 MAXLENGTH=50></TD>";
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
             echo "  <TD Class=captura>Tipo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
             for ($i=0; $i < count($tipos); $i++) {
                  echo " <OPTION VALUE='".$tipos[$i]."'>".$tipos[$i];
                  }
             echo "</SELECT></TD>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  echo " <INPUT TYPE=CHECKBOX NAME='incoterms[]' VALUE='".$tincoterms[$i]."'>".$tincoterms[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
			  echo "<TR>";
             echo "  <TD Class=captura>Impo/Expo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='impoexpo'>";
            
             echo "   <OPTION VALUE='Importación'>Importación</OPTION>";
             echo "   <OPTION VALUE='Exportación'>Exportación</OPTION>";
			 echo "   <OPTION VALUE='Importación|Exportación'>Ambos</OPTION>";     
             echo "</SELECT></TD>";
             echo "<TR>";			 
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"tiporecargo.php\"'></TH>";  // Cancela la operación
             echo "<script>adicionar.recargo.focus()</script>";
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
             if (!$rs->Open("select * from tb_tiporecargo where ca_idrecargo = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'tiporecargo.php';</script>";
                 exit;
                }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.modificar.recargo.value == '')";
             echo "      alert('El campo Recargo no es válido');";
//           echo "  else if (!document.modificar[4].checked)";
//           echo "      alert('Debe seleccionar por lo menos uno de los Términos de Negociación');";
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
             echo "<FORM METHOD=post NAME='modificar' ACTION='tiporecargo.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
             echo "<TH Class=titulo COLSPAN=2>Nuevos Datos sobre el Tipo de Recargo</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idrecargo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Recargo:</TD>";
             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='recargo' VALUE='".$rs->Value('ca_recargo')."' SIZE=30 MAXLENGTH=50></TD>";
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
             echo "  <TD Class=captura>Tipo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
             for ($i=0; $i < count($tipos); $i++) {
                  echo " <OPTION VALUE='".$tipos[$i]."'";
                  if ($rs->Value('ca_tipo')==$tipos[$i]) {
                      echo " SELECTED"; }
                  echo ">".$tipos[$i];
                  }
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>";
             for ($i=0; $i < count($tincoterms); $i++) {
                  $chequear = (in_array($tincoterms[$i],explode("|",$rs->Value('ca_incoterms'))))?"CHECKED":" ";
                  echo " <INPUT TYPE=CHECKBOX NAME='incoterms[]' VALUE='".$tincoterms[$i]."' ".$chequear.">".$tincoterms[$i]."<BR>";
                  }
             echo "  </TD>";
             echo "</TR>";
			 echo "<TR>";
             echo "  <TD Class=captura>Impo/Expo:</TD>";
             echo "  <TD Class=mostrar><SELECT NAME='impoexpo'>";
            
             echo "   <OPTION VALUE='Importación'";
			 if ($rs->Value('ca_impoexpo')=="Importación") {
                      echo " SELECTED"; 
			 }                
			 echo ">Importación</OPTION>";
             echo "   <OPTION VALUE='Exportación'";
			 if ($rs->Value('ca_impoexpo')=="Exportación") {
                      echo " SELECTED"; 
			 }
			 echo ">Exportación</OPTION>";			 
			 echo "   <OPTION VALUE='Importación|Exportación'";
			  if ($rs->Value('ca_impoexpo')=="Importación|Exportación") {
                      echo " SELECTED"; 
			 }
			 echo ">Ambos</OPTION>";     
             echo "</SELECT></TD>";
             echo "<TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";  // Ordena que se actualice el registro
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"tiporecargo.php\"'></TH>";  // Cancela la operación
             echo "<script>modificar.recargo.focus()</script>";
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo"<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             break;
             }
        case 'Eliminar': {
             $modulo = "00100300";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             if (!$rs->Open("select * from tb_tiporecargo where ca_idrecargo = ".$id)) {    // Mueve el apuntador al registro que se desea eliminar
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'tiporecargo.php';</script>";
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
             echo "<FORM METHOD=post NAME='eliminar' ACTION='tiporecargo.php'>";  // Llena la forma con los datos actuales del registro
             echo "<TABLE CELLSPACING=1>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
             echo "<TH Class=titulo COLSPAN=2>Datos del Tipo de Recargo a Eliminar</TH>";
             echo "<TR>";
             echo "  <TD Class=captura>Identificación:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_idrecargo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Recargo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_recargo')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Transporte:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_transporte')."</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Tipo:</TD>";
             echo "  <TD Class=mostrar>".$rs->Value('ca_tipo')."</TD>";
             echo "</SELECT></TD>";
             echo "<TR>";
             echo "  <TD Class=captura style='vertical-align:top;'>Incoterms:</TD>";
             echo "  <TD Class=mostrar>".str_replace ("|","<BR>",$rs->Value('ca_incoterms'))."</TD>";
             echo "</SELECT></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"tiporecargo.php\"'></TH>";  // Cancela la operación
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
             $incoterms = isset($incoterms)?implode("|",$incoterms):"";
             if (!$rs->Open("insert into tb_tiporecargo (ca_recargo, ca_tipo, ca_transporte, ca_incoterms, ca_impoexpo) values('$recargo', '$tipo', '$transporte', '$incoterms', '$impoexpo')")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 /*echo "<script>document.location.href = 'tiporecargo.php';</script>";*/
                 exit;
                }
             break;
             }
        case 'Actualizar': {                                                   // El Botón Actualizar fue pulsado
             $incoterms = isset($incoterms)?implode("|",$incoterms):"";
			 $sql = "update tb_tiporecargo set ca_recargo = '$recargo', ca_tipo = '$tipo', ca_transporte = '$transporte', ca_incoterms = '$incoterms', ca_impoexpo= '$impoexpo' where ca_idrecargo = $id";
			 //echo $sql;	
             if (!$rs->Open( $sql )) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 /*echo "<script>document.location.href = 'tiporecargo.php';</script>";*/
                 exit;
                }
             break;
             }
        case 'Eliminar': {                                                     // El Botón Eliminar fue pulsado
             if (!$rs->Open("delete from tb_tiporecargo where ca_idrecargo = $id")) {
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'tiporecargo.php';</script>";
                 exit;
                }
             break;
             }
        }
   echo "<script>document.location.href = 'tiporecargo.php';</script>";  // Retorna a la pantalla principal de la opción
   }
?>