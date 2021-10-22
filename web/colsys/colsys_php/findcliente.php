<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       FINDCLIENTE.PHP                                             \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo para la creación de cotizaciones.                    \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Consulta a Maestra de Clientes';
$campos = array("Nombre del Cliente", "Ciudad", "Representante Legal", "N.i.t.");  // Arreglo con los criterios de busqueda
$bdatos = array("Clientes Coltrans", "Mis Clientes");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
//  echo "<script>alert(window.parent.frames.adicionar.fchcotizacion.value);</script>";
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
	echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='findCliente' ACTION='findcliente.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
    for ($i=0; $i < count($campos); $i++) {
         echo " <OPTION VALUE='".$campos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; 
      }
         echo ">".$campos[$i];
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Buscar en:</B><BR><SELECT NAME='buscaren'>";
    for ($i=0; $i < count($bdatos); $i++) {
         echo " <OPTION VALUE='".$bdatos[$i]."'";
         if ($i==0) {
             echo " SELECTED"; 
      }
         echo ">".$bdatos[$i];
        }
    echo "  </SELECT>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.findcliente.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Buscar':{
             if (isset($criterio) and !isset($condicion)) {
                 $columnas = array("N.i.t."=>"ca_idcliente", "Nombre del Cliente"=>"ca_compania", "Representante Legal"=>"ca_ncompleto", "Ciudad"=>"ca_ciudad");
                 $condicion= "where lower($columnas[$modalidad]) like lower('%".$criterio."%')"; }
             if ($buscaren == 'Mis Clientes') {
                 $condicion = $condicion." and ca_vendedor = '".$usuario."'"; }
             else if ($buscaren == 'Clientes Libres') {
                 $condicion = $condicion." and ca_vendedor = ''"; }
             if (!$rs->Open("select ca_idcliente, ca_idalterno, ca_compania, ca_vendedor, ca_ciudad from vi_clientes $condicion")) {               // Selecciona todos lo registros de la tabla de Clientes
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function seleccion(idcliente, idalterno, cliente, vendedor) {";
             echo "    window.parent.frames.adicionar.idcliente.value=idcliente;";
             echo "    window.parent.frames.adicionar.idalterno.value=idalterno;";
             echo "    window.parent.frames.adicionar.cliente.value=cliente;";
             echo "    window.parent.frames.adicionar.vendedor.value=vendedor;";
             echo "    window.parent.frames.asignar();";
             echo "    window.parent.frames.findcliente.style.visibility = \"hidden\";";
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
			 echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='findclientes.php'>";       // Hace una llamado nuevamente a este script pero con
             echo "<TABLE CELLSPACING=1>";                                // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>$titulo</TH>";
             echo "</TR>";
             echo "<TH>ID</TH>";
             echo "<TH>Nombre del Cliente</TH>";
             echo "<TH>Vendedor</TH>";
             echo "<TH>Ciudad</TH>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" ONCLICK=\"javascript:seleccion(".$rs->Value('ca_idcliente').",".$rs->Value('ca_idalterno').",'".AddSlashes($rs->Value('ca_compania'))."','".$rs->Value('ca_vendedor')."')\">";
                echo "  <TD>".number_format($rs->Value('ca_idcliente'))."</TD>";
                echo "  <TD>".$rs->Value('ca_compania')."</TD>";
                echo "  <TD>".$rs->Value('ca_vendedor')."</TD>";
                echo "  <TD>".$rs->Value('ca_ciudad')."</TD>";
                echo "</TR>";
                $rs->MoveNext();
               }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"findcliente.php\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             echo "</HTML>";
             break;
             }
        }
}
?>