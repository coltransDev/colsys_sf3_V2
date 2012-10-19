<?php
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       REPORTEVENTAS.PHP                                           \\
  // Creado:        2005-04-20                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2005-06-01                                                  \\
  //                                                                            \\
  // Descripción:   Módulo para la creación de Reportes de Venta.               \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */

$titulo = 'Sistema Reporte de Ventas';
$imporexpor = array("Importación", "Exportación");                              // Arreglo con los tipos de Trayecto
$modalstrans = array("Inland - Ocean/Air Freight - Inland", "Inland - Ocean/Air Freight", "Ocean/Air Freight", "Ocean/Air Freight - Inland"); // Arreglo con las Modalidades de Transporte
$modalsventa = array("Door to Door", "Door to Port", "Port to Port", "Port to Door");
$transitos = array("  ", "OTM", "DTA");                                           // Arreglo con los tipos de Modalidades de Transporte Terrestre
$transportes = array("Aéreo", "Marítimo", "Terrestre");                          // Arreglo con los tipos de Transportes
$columnas = array("Número de Reporte" => "ca_idreporte");                        // Arreglo con las opciones de busqueda

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
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

if (!isset($criterio) and !isset($boton) and !isset($accion)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='reporteventas.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=5>";
    while (list ($clave, $val) = each($columnas)) {
        echo " <OPTION VALUE='" . $val . "'" . (($val == 'ca_idreporte') ? " SELECTED" : "") . ">" . $clave;
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' VALUE='$cadena' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='" . date(date("Y") . "-" . date("m") . "-" . "01") . "' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='" . date("Y-m-d", mktime(0, 0, 0, date("m") + 1, 0, date("Y"))) . "' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar WIDTH=150></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"entrada.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.opcion.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (!isset($boton) and !isset($accion) and isset($criterio)) {
    SetCookie("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (isset($criterio) and strlen(trim($criterio)) != 0 and !isset($condicion)) {
        if ($opcion == 'ca_idreporte') {
            $condicion = "where lower($opcion) like lower('%" . $criterio . "%')";
        }
    }
    if (!$rs->Open("select * from vi_reportes $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'reporteventas.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='reporteventas.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=3>" . COLTRANS . "<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID Reporte</TH>";
    echo "<TH>Trayecto</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR>";
        echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"reporteventas.php?boton=Consultar\&id=" . $rs->Value('ca_idreporte') . "\";'>" . $rs->Value('ca_idreporte') . "</TD>";
        echo "  <TD Class=listar style='font-weight:bold;'>" . $rs->Value('ca_agente') . " " . $rs->Value('ca_nombre') . "</TD>";
        echo "  <TD Class=listar ROWSPAN=2></TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=listar>";
        echo "  <TABLE WIDTH=520 CELLSPACING=1>";
        echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Despacho</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;'>T.Incoterms</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;'>ca_idcotizacion</TD><TR>";
        echo "    <TD Class=listar>" . $rs->Value('ca_ciuorigen') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_traorigen') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_ciudestino') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_tradestino') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_fchdespacho') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_incoterms') . "</TD>";
        echo "    <TD Class=listar>" . $rs->Value('ca_idcotizacion') . "</TD>";
        echo "  </TABLE>";
        echo " </TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=3></TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"reporteventas.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch (trim($boton)) {
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

                $tm = & DlRecordset::NewRecordset($conn);
                carga_arreglos($tm);
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_tercero.style.top=dalt'>";
                echo "<DIV ID='find_tercero' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_tercero_frame' SRC='findtercero.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";

                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reporteventas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=3 style='font-weight:bold;'>REPORTE DE NEGOCIOS</TH>";
                echo "  <TD Class=mostrar style='text-align:center;'><B>Cotización:</B><BR><INPUT TYPE='TEXT' NAME='idcotizacion' SIZE=13 MAXLENGTH=10></TD>";
                echo "  <TD Class=mostrar style='text-align:center;'><B>Reporte No.:</B><BR><INPUT TYPE='TEXT' NAME='idreporte' SIZE=13 MAXLENGTH=10></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>INFORMACION GENERAL</TH>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo>1. Impor/Exportación</TD>";
                echo "  <TD Class=titulo COLSPAN=2>2. Ciudad de Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>3. Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'>&nbsp&nbsp&nbsp&nbsp<SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
                for ($i = 0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=" . $imporexpor[$i] . ">" . $imporexpor[$i] . "</OPTION>";
                }
                echo "  </SELECT>&nbsp&nbsp&nbsp</TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' SIZE=7>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchdespacho' SIZE=12 VALUE='" . date("Y-m-d") . "' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                echo "  <TD Class=listar COLSPAN=2>5. Agente Coltrans:<BR><SELECT NAME='idagente'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>6. Incoterms:<BR><SELECT NAME='incoterms'>";
                for ($i = 0; $i < count($tincoterms); $i++) {
                    echo " <OPTION VALUE='" . $tincoterms[$i] . "'>" . $tincoterms[$i] . "</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>7. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93></TEXTAREA></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_pro TYPE='HIDDEN' NAME='idproveedor'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_pro' SIZE=15 MAXLENGTH=15></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_pro\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_pro READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consignatario:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9. Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_cons' SIZE=15 MAXLENGTH=15></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_con\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Representante:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí' CHECKED>Sí&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No'>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_rep\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4>11. Preferencias del Cliente:<BR><TEXTAREA NAME='preferencias_clie' WRAP=virtual ROWS=4 COLS=93></TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo ROWSPAN=3 style='text-align:left; vertical-align:top;'>12. Transporte:<BR><CENTER><SELECT NAME='transporte' ONCHANGE='llenar_modalidades();'>";
                for ($i = 0; $i < count($transportes); $i++) {
                    echo " <OPTION VALUE=" . $transportes[$i] . ">" . $transportes[$i];
                }
                echo "  </SELECT></CENTER></TD>";
                echo "  <TD Class=mostrar>13. Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='llenar_lineas();'>";
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar COLSPAN=3>14. Línea Transporte:<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>15.&nbspColmas&nbspS.I.A.&nbspLtda:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'Sí' CHECKED>Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'No'>No</TD>";
                echo "  <TD Class=mostrar>16.&nbspSeguro&nbspcon&nbspAnker:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'Sí' CHECKED>Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'No'>No</TD>";
                echo "  <TD Class=mostrar>17. Lib. Automática:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT ID=si NAME='liberacion' TYPE='radio' VALUE = 'Sí' CHECKED ONCLICK='liberar(this);'>Sí&nbsp&nbsp&nbsp&nbsp<INPUT ID=no NAME='liberacion' TYPE='radio' VALUE = 'No' ONCLICK='liberar(this);' CHECKED>No</TD>";
                echo "  <TD Class=mostrar>Tiempo de Crédito:<BR><INPUT READONLY TYPE='TEXT' NAME='tiempocredito' VALUE='-' SIZE=18 MAXLENGTH=20></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>18. Zona/Depósito Aduanero:<BR><SELECT NAME='zonadeposito'>";             // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reporteventas.php\"'></TH>";  // Cancela la operación
                echo "<script>llenar_traficos();</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Editar': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm = & DlRecordset::NewRecordset($conn);
                carga_arreglos($tm);
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_tercero.style.top=dalt'>";
                echo "<DIV ID='find_tercero' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_tercero_frame' SRC='findtercero.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";

                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reporteventas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=$id>";     // Trae el id del Contacto para el Cliente
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=3 style='font-weight:bold;'>REPORTE DE NEGOCIOS</TH>";
                echo "  <TD Class=mostrar style='text-align:center;'><B>Cotización:</B><BR><INPUT TYPE='TEXT' NAME='idcotizacion' VALUE=" . $rs->Value('ca_idcotizacion') . " SIZE=13 MAXLENGTH=10></TD>";
                echo "  <TD Class=mostrar style='text-align:center;'><B>Reporte No.:</B><BR><INPUT TYPE='TEXT' NAME='idreporte' VALUE=" . $rs->Value('ca_idreporte') . " SIZE=13 MAXLENGTH=10></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>INFORMACION GENERAL</TH>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo>1. Impor/Exportación</TD>";
                echo "  <TD Class=titulo COLSPAN=2>2. Ciudad de Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>3. Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'>&nbsp&nbsp&nbsp&nbsp<SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
                for ($i = 0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=" . $imporexpor[$i];
                    if ($rs->Value('ca_impoexpo') == $imporexpor[$i]) {
                        echo " SELECTED";
                    }
                    echo ">" . $imporexpor[$i] . "</OPTION>";
                }
                echo "  </SELECT>&nbsp&nbsp&nbsp</TD>";
                if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos where ca_nombre = '" . $rs->Value('ca_traorigen') . "' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idtrafico') . "'>" . $tm->Value('ca_nombre') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_nombre = '" . $rs->Value('ca_traorigen') . "' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idciudad') . "'";
                    if ($rs->Value('ca_origen') == $tm->Value('ca_idciudad')) {
                        echo " SELECTED";
                    }
                    echo ">" . $tm->Value('ca_ciudad') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos where ca_nombre = '" . $rs->Value('ca_tradestino') . "' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idtrafico') . "'>" . $tm->Value('ca_nombre') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_nombre = '" . $rs->Value('ca_tradestino') . "' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' SIZE=7>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idciudad') . "'";
                    if ($rs->Value('ca_destino') == $tm->Value('ca_idciudad')) {
                        echo " SELECTED";
                    }
                    echo ">" . $tm->Value('ca_ciudad') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchdespacho' SIZE=12 VALUE='" . $rs->Value('ca_fchdespacho') . "' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                if (!$tm->Open("select ca_idagente, ca_nombre from vi_agentes where ca_nomtrafico = '" . $rs->Value('ca_traorigen') . "' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
                    echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";                   // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=listar COLSPAN=2>5. Agente Coltrans:<BR><SELECT NAME='idagente'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idagente') . "'";
                    if ($rs->Value('ca_idagente') == $tm->Value('ca_idagente')) {
                        echo " SELECTED";
                    }
                    echo ">" . $tm->Value('ca_nombre') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>6. Incoterms:<BR><SELECT NAME='incoterms'>";
                for ($i = 0; $i < count($tincoterms); $i++) {
                    echo " <OPTION VALUE='" . $tincoterms[$i] . "'";
                    if ($rs->Value('ca_incoterms') == $tincoterms[$i]) {
                        echo " SELECTED";
                    }
                    echo " >" . $tincoterms[$i] . "</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>7. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93>" . $rs->Value('ca_mercancia_desc') . "</TEXTAREA></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_pro TYPE='HIDDEN' NAME='idproveedor' VALUE=" . $rs->Value('ca_idproveedor') . ">";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_nombre_pro') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_pro' VALUE='" . $rs->Value('ca_orden_prov') . "' SIZE=15 MAXLENGTH=15></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_pro\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_contacto_pro') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_direccion_pro') . "' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_telefonos_pro') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_fax_pro') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='" . $rs->Value('ca_email_pro') . "' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario' VALUE=" . $rs->Value('ca_idconsignatario') . ">";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consignatario:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9. Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_nombre_con') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_cons' VALUE='" . $rs->Value('ca_orden_cons') . "' SIZE=15 MAXLENGTH=15></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_con\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_contacto_con') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_direccion_con') . "' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_telefonos_con') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_fax_con') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='" . $rs->Value('ca_email_con') . "' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante' VALUE=" . $rs->Value('ca_idrepresentante') . ">";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Representante:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_nombre_rep') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí' " . (($rs->Value('ca_informar_repr') == "Sí") ? "CHECKED" : "") . ">Sí&nbsp&nbsp&nbsp<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No' " . (($rs->Value('ca_informar_repr') == "No") ? "CHECKED" : "") . ">No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_tercero\",\"_rep\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_contacto_rep') . "' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_direccion_rep') . "' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_telefonos_rep') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_fax_rep') . "' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='" . $rs->Value('ca_email_rep') . "' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE><TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4>11. Preferencias del Cliente:<BR><TEXTAREA NAME='preferencias_clie' WRAP=virtual ROWS=4 COLS=93>" . $rs->Value('ca_preferencias_clie') . "</TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo ROWSPAN=3 style='text-align:left; vertical-align:top;'>12. Transporte:<BR><CENTER><SELECT NAME='transporte' ONCHANGE='llenar_modalidades();'>";
                for ($i = 0; $i < count($transportes); $i++) {
                    echo " <OPTION VALUE=" . $transportes[$i];
                    if ($rs->Value('ca_transporte') == $transportes[$i]) {
                        echo " SELECTED";
                    }
                    echo ">" . $transportes[$i];
                }
                echo "  </SELECT></CENTER></TD>";
                echo "  <TD Class=mostrar>13. Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='llenar_lineas();'>";
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    echo " <OPTION VALUE=CONSOLIDADO SELECTED>CONSOLIDADO</OPTION>";
                } else if ($rs->Value('ca_transporte') == 'Marítimo') {
                    echo " <OPTION VALUE=LCL " . (($rs->Value('ca_modalidad') == "LCL") ? "SELECTED" : "") . ">LCL</OPTION>";
                    echo " <OPTION VALUE=FCL " . (($rs->Value('ca_modalidad') == "FCL") ? "SELECTED" : "") . ">FCL</OPTION>";
                }
                echo "  </SELECT></TD>";
                if (!$tm->Open("select ca_idlinea, ca_nombre from vi_transporlineas where ca_transporte = '" . $rs->Value('ca_transporte') . "' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'trayectos.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=3>14. Línea Transporte:<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                while (!$tm->Eof()) {
                    echo " <OPTION VALUE='" . $tm->Value('ca_idlinea') . "'";
                    if ($rs->Value('ca_idlinea') == $tm->Value('ca_idlinea')) {
                        echo " SELECTED";
                    }
                    echo ">" . $tm->Value('ca_nombre') . "</OPTION>";
                    $tm->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>15.&nbspColmas&nbspS.I.A.&nbspLtda:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'Sí' " . (($rs->Value('ca_colmas') == "Sí") ? "CHECKED" : "") . ">Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='colmas' TYPE='radio' VALUE = 'No' " . (($rs->Value('ca_colmas') == "No") ? "CHECKED" : "") . ">No</TD>";
                echo "  <TD Class=mostrar>16.&nbspSeguro&nbspcon&nbspAnker:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'Sí' " . (($rs->Value('ca_seguro') == "Sí") ? "CHECKED" : "") . ">Sí&nbsp&nbsp&nbsp&nbsp<INPUT NAME='seguro' TYPE='radio' VALUE = 'No' " . (($rs->Value('ca_seguro') == "No") ? "CHECKED" : "") . ">No</TD>";
                echo "  <TD Class=mostrar>17. Lib. Automática:<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<INPUT ID=si NAME='liberacion' TYPE='radio' VALUE = 'Sí' " . (($rs->Value('ca_liberacion') == "Sí") ? "CHECKED" : "") . " ONCLICK='liberar(this);'>Sí&nbsp&nbsp&nbsp&nbsp<INPUT ID=no NAME='liberacion' TYPE='radio' VALUE = 'No' " . (($rs->Value('ca_liberacion') == "No") ? "CHECKED" : "") . " ONCLICK='liberar(this);'>No</TD>";
                echo "  <TD Class=mostrar>Tiempo de Crédito:<BR><INPUT READONLY TYPE='TEXT' NAME='tiempocredito' VALUE='" . $rs->Value('ca_tiempocredito') . "' SIZE=18 MAXLENGTH=20></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>18. Zona/Depósito Aduanero:<BR><SELECT NAME='zonadeposito'>";             // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<script>llenar_zonas();</script>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reporteventas.php\"'></TH>";  // Cancela la operación
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Liquidar': {                                                    // Opcion para Consultar un solo registro
                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $mn = & DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }

                $rg = & DlRecordset::NewRecordset($conn);
                if (!$rg->Open("select ca_idrecargo, ca_recargo, ca_tipo from tb_tiporecargo where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_reporte like '%" . $rs->Value('ca_modalidad') . "%' order by ca_tipo, ca_recargo")) {       // Selecciona todos lo registros de la tabla Tipos de Recargo
                    echo "<script>alert(\"" . addslashes($rg->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }

                $co = & DlRecordset::NewRecordset($conn);
                if (!$co->Open("select ca_idconcepto, substr(ca_concepto,1,25) as ca_concepto from vi_conceptos where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_modalidad = '" . $rs->Value('ca_modalidad') . "'")) {   // Selecciona todos lo registros de la tabla Conceptos
                    echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                $co->MoveFirst();

                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                if ($rs->Value('ca_seguro') == "Sí") {
                    echo "function validar(){";
                    echo "  if (document.adicionar.vlrasegurado.value == '' || document.adicionar.vlrasegurado.value <= 0)";
                    echo "      alert('El valor Asegurado no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.primaneta.value == '' || document.adicionar.primaneta.value <= 0)";
                    echo "      alert('El Porcentaje de Prima no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.primaventa.value == '' || document.adicionar.primaventa.value <= 0)";
                    echo "      alert('El Porcentaje de Venta Prima no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.obtencionpoliza.value == '' || document.adicionar.obtencionpoliza.value <= 0)";
                    echo "      alert('El Valor por Obtención de la Póliza no es válido o no puede ser igual a 0');";
                    echo "  else";
                    echo "      return (true);";
                    echo "  return (false);";
                    echo "}";
                }
                echo "</script>";

                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reporteventas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
                datos_basicos($rs);
                if ($rs->Value('ca_seguro') == "Sí") {
                    echo "<TR>";
                    echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=540 CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>INFORMACIÓN PARA LA ASEGURADORA</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>19. Modalidad Vendida:<BR><SELECT NAME='modalventa' ONCHANGE='modaltrans.selectedIndex=modalventa.selectedIndex'>";
                    for ($i = 0; $i < count($modalsventa); $i++) {
                        echo " <OPTION VALUE='" . $modalsventa[$i] . "'>" . $modalsventa[$i] . "</OPTION>";
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar COLSPAN=3>19.1 Modalidad de Transporte:<BR><SELECT NAME='modaltrans' ONCHANGE='modalventa.selectedIndex=modaltrans.selectedIndex'>";
                    for ($i = 0; $i < count($modalstrans); $i++) {
                        echo " <OPTION VALUE='" . $modalstrans[$i] . "'>" . $modalstrans[$i] . "</OPTION>";
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>19.2 Valor Asegurado:<BR><INPUT TYPE='TEXT' NAME='vlrasegurado' VALUE=0 SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_vlr'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>19.3 Prima Neta:<BR><INPUT TYPE='TEXT' NAME='primaneta' VALUE=0 SIZE=8 MAXLENGTH=6>%</TD>";
                    echo "    <TD Class=mostrar>19.4 Prima Venta:<BR><INPUT TYPE='TEXT' NAME='primaventa' VALUE=0 SIZE=8 MAXLENGTH=6>%</TD>";
                    echo "    <TD Class=mostrar>19.5 Obtención Póliza:<BR><INPUT TYPE='TEXT' NAME='obtencionpoliza' VALUE=0 SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_pol'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=540 CELLSPACING=1";
                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=4 style='text-align:center; font-weight:bold;'>EMBARQUE " . strtoupper($rs->Value('ca_transporte')) . "</TD>";
                echo "  </TR>";

                if ($rs->Value('ca_transporte') == 'Marítimo') {
                    for ($i = 0; $i < 3; $i++) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo"<OPTION VALUE=" . $co->Value('ca_idconcepto') . ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Cantidad:<BR><INPUT TYPE='TEXT' NAME='cantidad[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar COLSPAN=2><TD>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        echo "  </TR>";

                        echo "  <TR>";
                        echo "    <TD Class=mostrar>21. Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='neta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.3 Moneda:<BR><SELECT NAME='idmoneda_tar[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar>22. BAF Neto:<BR><INPUT TYPE='TEXT' NAME='neta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.1 BAF Agente:<BR><INPUT TYPE='TEXT' NAME='agente_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.2 BAF Venta:<BR><INPUT TYPE='TEXT' NAME='venta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.3 Moneda:<BR><SELECT NAME='idmoneda_baf[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR HEIGHT=5>";
                        echo "    <TD Class=invertir COLSPAN=4></TD>";
                        echo "  </TR>";
                    }
                } else if ($rs->Value('ca_transporte') == 'Aéreo') {
                    for ($i = 0; $i < 6; $i++) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo"<OPTION VALUE=" . $co->Value('ca_idconcepto') . ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar>20.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        if ($i == 0) {
                            echo "  <TD Class=mostrar>21.3 Moneda:<BR><SELECT NAME='idmoneda_tar'>";
                            $mn->MoveFirst();
                            while (!$mn->Eof()) {
                                echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                                $mn->MoveNext();
                            }
                            echo "  </SELECT></TD>";
                        } else {
                            echo "  <TD Class=mostrar><TD>";
                        }
                        echo "  </TR>";
                    }
                }

                echo "  <TR>";
                echo "    <TD Class=mostrar>22. Gastos en Origen:<BR><INPUT TYPE='TEXT' NAME='gastos_org' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>22.1 Gastos Neto:<BR><INPUT TYPE='TEXT' NAME='neta_org' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                echo "    <TD Class=mostrar>22.2 Gastos Venta:<BR><INPUT TYPE='TEXT' NAME='venta_org' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                echo "    <TD Class=mostrar>22.3 Moneda:<BR><SELECT NAME='idmoneda_org'>";
                $mn->MoveFirst();
                while (!$mn->Eof()) {
                    echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                    $mn->MoveNext();
                }
                echo "    </SELECT></TD>";
                echo "  </TR>";
                echo "  </TABLE></CENTER></TD>";

                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>RELACIÓN DE GASTOS</TD>";
                echo "  </TR>";
                $rg->MoveFirst();
                while (!$rg->Eof()) {
                    echo "  <TR>";
                    echo "    <INPUT TYPE='HIDDEN' NAME='idrecargo_gas[]' VALUE=" . $rg->Value('ca_idrecargo') . ">";              // Hereda el Id del Cliente que se esta modificando
                    echo "    <TD Class=mostrar COLSPAN=2>" . $rg->Value('ca_tipo') . "<BR><INPUT READONLY TYPE='TEXT' NAME='gasto_gas[]' VALUE='" . $rg->Value('ca_recargo') . "' SIZE=40 MAXLENGTH=40></TD>";
                    echo "    <TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' NAME='valor_gas[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                    echo "    <TD Class=mostrar>Moneda:<BR><SELECT NAME='idmoneda_gas[]'>";
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>Detalles:<BR><INPUT TYPE='TEXT' NAME='detalles_gas[]' SIZE=25 MAXLENGTH=30></TD>";
                    echo "  </TR>";
                    $rg->MoveNext();
                }
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";


                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Liquidación'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"reporteventas.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
        case 'Reliquidar': {                                                    // Opcion para Consultar un solo registro
                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $mn = & DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }

                $rg = & DlRecordset::NewRecordset($conn);
                if (!$rg->Open("select ca_idrecargo, ca_recargo, ca_tipo from tb_tiporecargo where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_reporte like '%" . $rs->Value('ca_modalidad') . "%' order by ca_tipo, ca_recargo")) {       // Selecciona todos lo registros de la tabla Tipos de Recargo
                    echo "<script>alert(\"" . addslashes($rg->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }

                $co = & DlRecordset::NewRecordset($conn);
                if (!$co->Open("select ca_idconcepto, substr(ca_concepto,1,25) as ca_concepto from vi_conceptos where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_modalidad = '" . $rs->Value('ca_modalidad') . "'")) {   // Selecciona todos lo registros de la tabla Conceptos
                    echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                $co->MoveFirst();

                $gs = & DlRecordset::NewRecordset($conn);
                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                if ($rs->Value('ca_seguro') == "Sí") {
                    echo "function validar(){";
                    echo "  if (document.adicionar.vlrasegurado.value == '' || document.adicionar.vlrasegurado.value <= 0)";
                    echo "      alert('El valor Asegurado no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.primaneta.value == '' || document.adicionar.primaneta.value <= 0)";
                    echo "      alert('El Porcentaje de Prima no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.primaventa.value == '' || document.adicionar.primaventa.value <= 0)";
                    echo "      alert('El Porcentaje de Venta Prima no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.obtencionpoliza.value == '' || document.adicionar.obtencionpoliza.value <= 0)";
                    echo "      alert('El Valor por Obtención de la Póliza no es válido o no puede ser igual a 0');";
                    echo "  else";
                    echo "      return (true);";
                    echo "  return (false);";
                    echo "}";
                }
                echo "</script>";

                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reporteventas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
                datos_basicos($rs);
                if ($rs->Value('ca_seguro') == "Sí") {
                    echo "<TR>";
                    echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=540 CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>INFORMACIÓN PARA LA ASEGURADORA</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>19. Modalidad Vendida:<BR><SELECT NAME='modalventa' ONCHANGE='modaltrans.selectedIndex=modalventa.selectedIndex'>";
                    for ($i = 0; $i < count($modalsventa); $i++) {
                        echo " <OPTION VALUE='" . $modalsventa[$i] . "'";
                        if ($modalsventa[$i] == $rs->Value('ca_modalventa')) {
                            echo" SELECTED";
                        }
                        echo ">" . $modalsventa[$i] . "</OPTION>";
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar COLSPAN=3>19.1 Modalidad de Transporte:<BR><SELECT NAME='modaltrans' ONCHANGE='modalventa.selectedIndex=modaltrans.selectedIndex'>";
                    for ($i = 0; $i < count($modalstrans); $i++) {
                        echo " <OPTION VALUE='" . $modalstrans[$i] . "'";
                        if ($modalstrans[$i] == $rs->Value('ca_modaltrans')) {
                            echo" SELECTED";
                        }
                        echo ">" . $modalstrans[$i] . "</OPTION>";
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>19.2 Valor Asegurado:<BR><INPUT TYPE='TEXT' NAME='vlrasegurado' VALUE=" . ($rs->Value('ca_vlrasegurado') + 0) . " SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_vlr'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda') == $rs->Value('ca_idmoneda_vlr')) {
                            echo" SELECTED";
                        }
                        echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>19.3 Prima Neta:<BR><INPUT TYPE='TEXT' NAME='primaneta' VALUE=" . ($rs->Value('ca_primaneta') + 0) . " SIZE=8 MAXLENGTH=6>%</TD>";
                    echo "    <TD Class=mostrar>19.4 Prima Venta:<BR><INPUT TYPE='TEXT' NAME='primaventa' VALUE=" . ($rs->Value('ca_primaventa') + 0) . " SIZE=8 MAXLENGTH=6>%</TD>";
                    echo "    <TD Class=mostrar>19.5 Obtención Póliza:<BR><INPUT TYPE='TEXT' NAME='obtencionpoliza' VALUE='" . $rs->Value('ca_obtencionpoliza') . "' SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_pol'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda') == $rs->Value('ca_idmoneda_pol')) {
                            echo" SELECTED";
                        }
                        echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=540 CELLSPACING=1";
                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=4 style='text-align:center; font-weight:bold;'>EMBARQUE " . strtoupper($rs->Value('ca_transporte')) . "</TD>";
                echo "  </TR>";

                $lq = & DlRecordset::NewRecordset($conn);
                $lq->MoveFirst();
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    if (!$lq->Open("select * from vi_repaereo where ca_idreporte = $id")) {   // Selecciona todos lo registros de la tabla Conceptos
                        echo "<script>alert(\"" . addslashes($lq->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    $mod_mem = true;
                    while (!$lq->Eof()) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo "<OPTION VALUE=" . $co->Value('ca_idconcepto');
                            if ($co->Value('ca_idconcepto') == $lq->Value('ca_idconcepto')) {
                                echo" SELECTED";
                            }
                            echo ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=" . $lq->Value('ca_agente_tar') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar>20.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=" . $lq->Value('ca_venta_tar') . " SIZE=12 MAXLENGTH=10></TD>";
                        if ($mod_mem) {
                            echo "  <TD Class=mostrar>20.3 Moneda:<BR><SELECT NAME='idmoneda_tar'>";
                            $mn->MoveFirst();
                            while (!$mn->Eof()) {
                                echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                                $mn->MoveNext();
                            }
                            echo "  </SELECT></TD>";
                            $mod_mem = false;
                        } else {
                            echo "  <TD Class=mostrar><TD>";
                        }
                        echo "  </TR>";
                        echo "  <TR HEIGHT=5>";
                        echo "    <TD Class=invertir COLSPAN=4></TD>";
                        echo "  </TR>";
                        $lq->MoveNext();
                    }
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=4 style='text-align:center; font-weight:bold;'>NUEVOS CONCEPTOS</TD>";
                    echo "  </TR>";
                    for ($i = 0; $i < 3; $i++) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo"<OPTION VALUE=" . $co->Value('ca_idconcepto') . ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar>20.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        if ($mod_mem) {
                            echo "  <TD Class=mostrar>20.3 Moneda:<BR><SELECT NAME='idmoneda_tar'>";
                            $mn->MoveFirst();
                            while (!$mn->Eof()) {
                                echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                                $mn->MoveNext();
                            }
                            echo "  </SELECT></TD>";
                            $mod_mem = false;
                        } else {
                            echo "  <TD Class=mostrar><TD>";
                        }
                        echo "  </TR>";
                    }
                } else if ($rs->Value('ca_transporte') == 'Marítimo') {
                    if (!$lq->Open("select * from vi_repmaritimo where ca_idreporte = $id")) {   // Selecciona todos lo registros de la tabla Conceptos
                        echo "<script>alert(\"" . addslashes($lq->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    while (!$lq->Eof()) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo "<OPTION VALUE=" . $co->Value('ca_idconcepto');
                            if ($co->Value('ca_idconcepto') == $lq->Value('ca_idconcepto')) {
                                echo" SELECTED";
                            }
                            echo ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Cantidad:<BR><INPUT TYPE='TEXT' NAME='cantidad[]' VALUE=" . $lq->Value('ca_cantidad') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar COLSPAN=2><TD>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar>21. Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='neta_tar[]' VALUE=" . $lq->Value('ca_neta_tar') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=" . $lq->Value('ca_agente_tar') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=" . $lq->Value('ca_venta_tar') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.3 Moneda:<BR><SELECT NAME='idmoneda_tar[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                            if ($mn->Value('ca_idmoneda') == $lq->Value('ca_idmoneda_tar')) {
                                echo" SELECTED";
                            }
                            echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar>22. BAF Neto:<BR><INPUT TYPE='TEXT' NAME='neta_baf[]' VALUE=" . $lq->Value('ca_neta_baf') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.1 BAF Agente:<BR><INPUT TYPE='TEXT' NAME='agente_baf[]' VALUE=" . $lq->Value('ca_agente_baf') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.2 BAF Venta:<BR><INPUT TYPE='TEXT' NAME='venta_baf[]' VALUE=" . $lq->Value('ca_venta_baf') . " SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.3 Moneda:<BR><SELECT NAME='idmoneda_baf[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                            if ($mn->Value('ca_idmoneda') == $lq->Value('ca_idmoneda_baf')) {
                                echo" SELECTED";
                            }
                            echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR HEIGHT=5>";
                        echo "    <TD Class=invertir COLSPAN=4></TD>";
                        echo "  </TR>";
                        $lq->MoveNext();
                    }
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=4 style='text-align:center; font-weight:bold;'>NUEVOS CONCEPTOS</TD>";
                    echo "  </TR>";
                    for ($i = 0; $i < 3; $i++) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar>20. Concepto:<BR><SELECT NAME='idconcepto[]'>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        $co->MoveFirst();
                        while (!$co->Eof()) {
                            echo"<OPTION VALUE=" . $co->Value('ca_idconcepto') . ">" . $co->Value('ca_concepto') . "</OPTION>";
                            $co->MoveNext();
                        }
                        echo "  </SELECT></TD>";
                        echo "  <TD Class=mostrar>20.1 Cantidad:<BR><INPUT TYPE='TEXT' NAME='cantidad[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "  <TD Class=mostrar COLSPAN=2><TD>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        echo "  </TR>";

                        echo "  <TR>";
                        echo "    <TD Class=mostrar>21. Tarifa Neta:<BR><INPUT TYPE='TEXT' NAME='neta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.1 Tarifa Agente:<BR><INPUT TYPE='TEXT' NAME='agente_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.2 Tarifa Venta:<BR><INPUT TYPE='TEXT' NAME='venta_tar[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>21.3 Moneda:<BR><SELECT NAME='idmoneda_tar[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar>22. BAF Neto:<BR><INPUT TYPE='TEXT' NAME='neta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.1 BAF Agente:<BR><INPUT TYPE='TEXT' NAME='agente_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.2 BAF Venta:<BR><INPUT TYPE='TEXT' NAME='venta_baf[]' VALUE=0 SIZE=12 MAXLENGTH=10></TD>";
                        echo "    <TD Class=mostrar>22.3 Moneda:<BR><SELECT NAME='idmoneda_baf[]'>";
                        $mn->MoveFirst();
                        while (!$mn->Eof()) {
                            echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                            $mn->MoveNext();
                        }
                        echo "    </SELECT></TD>";
                        echo "  </TR>";
                        echo "  <TR HEIGHT=5>";
                        echo "    <TD Class=invertir COLSPAN=4></TD>";
                        echo "  </TR>";
                    }
                }
                echo "  <TR>";
                echo "    <TD Class=mostrar>23. Gastos en Origen:<BR><INPUT TYPE='TEXT' NAME='gastos_org' VALUE=" . $rs->Value('ca_gastos_org') . " SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>23.1 Gastos Neto:<BR><INPUT TYPE='TEXT' NAME='neta_org' VALUE=" . $rs->Value('ca_neta_org') . " SIZE=12 MAXLENGTH=10></TD>";
                echo "    <TD Class=mostrar>23.2 Gastos Venta:<BR><INPUT TYPE='TEXT' NAME='venta_org' VALUE=" . $rs->Value('ca_venta_org') . " SIZE=12 MAXLENGTH=10></TD>";
                echo "    <TD Class=mostrar>23.3 Moneda:<BR><SELECT NAME='idmoneda_org'>";
                $mn->MoveFirst();
                while (!$mn->Eof()) {
                    echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                    if ($mn->Value('ca_idmoneda') == $rs->Value('ca_idmoneda_org')) {
                        echo" SELECTED";
                    }
                    echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                    $mn->MoveNext();
                }
                echo "    </SELECT></TD>";
                echo "  </TR>";
                echo "  </TABLE></CENTER></TD>";

                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>RELACIÓN DE GASTOS</TD>";
                echo "  </TR>";
                $rg->MoveFirst();
                while (!$rg->Eof()) {
                    if (!$gs->Open("select * from vi_repgastos where ca_idreporte = $id and ca_idrecargo = " . $rg->Value('ca_idrecargo'))) {                           // Selecciona todos lo registros de la tabla Conceptos
                        echo "<script>alert(\"" . addslashes($gs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    echo "  <TR>";
                    echo "    <INPUT TYPE='HIDDEN' NAME='idrecargo_gas[]' VALUE=" . $rg->Value('ca_idrecargo') . ">";              // Hereda el Id del Cliente que se esta modificando
                    echo "    <TD Class=mostrar COLSPAN=2>" . $rg->Value('ca_tipo') . "<BR><INPUT READONLY TYPE='TEXT' NAME='gasto_gas[]' VALUE='" . $rg->Value('ca_recargo') . "' SIZE=40 MAXLENGTH=40></TD>";
                    echo "    <TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' NAME='valor_gas[]' VALUE=" . ($gs->Value('ca_valor') + 0) . " SIZE=12 MAXLENGTH=10></TD>";
                    echo "    <TD Class=mostrar>Moneda:<BR><SELECT NAME='idmoneda_gas[]'>";
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=" . $mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda') == $gs->Value('ca_idmoneda')) {
                            echo" SELECTED";
                        }
                        echo ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>Detalles:<BR><INPUT TYPE='TEXT' NAME='detalles_gas[]' VALUE='" . $gs->Value('ca_detalles') . "' SIZE=25 MAXLENGTH=30></TD>";
                    echo "  </TR>";
                    $rg->MoveNext();
                }
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Liquidación'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"reporteventas.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
        case 'Consultar': {                                                    // Opcion para Consultar un solo registro
                $us = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                $usu_mem = ($rs->Value('ca_usuactualizado') != '') ? $rs->Value('ca_usuactualizado') : $rs->Value('ca_usucreado');
                $fch_mem = ($rs->Value('ca_fchactualizado') != '') ? $rs->Value('ca_fchactualizado') : $rs->Value('ca_fchcreado');
                list($anno, $mes, $dia, $hor, $min, $seg) = sscanf($fch_mem, "%d-%d-%d %d:%d:%d");

                if (!$us->Open("select ca_login, ca_sucursal from control.tb_usuarios where ca_login = '$usu_mem'")) {
                    echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $ciu_mem = $us->Value('ca_sucursal');

                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                echo "function elegir(opcion, id){";
                echo "    document.location.href = 'reporteventas.php?boton='+opcion+'\&id='+id;";
                echo "}";
                echo "</script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reporteventas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
                datos_basicos($rs);
                if ($rs->Value('ca_seguro') == "Sí") {
                    $sg = & DlRecordset::NewRecordset($conn);
                    if (!$sg->Open("select * from tb_repseguro where ca_idreporte = " . $rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repseguro
                        echo "<script>alert(\"" . addslashes($sg->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    echo "<TR>";
                    echo "  <TD Class=invertir><B>Seguro:</B></TD>";
                    echo "  <TD Class=imprimir COLSPAN=4><CENTER><TABLE WIDTH=490 CELLSPACING=1 BORDER=1>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=4 style='text-align:center; font-weight:bold;'>INFORMACIÓN PARA LA ASEGURADORA</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar><B>19. Modalidad Vendida:</B><BR>" . $sg->Value('ca_modalventa') . "</TD>";
                    echo "    <TD Class=mostrar COLSPAN=3><B>19.1 Modalidad de Transporte:</B><BR>" . $sg->Value('ca_modaltrans') . "</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar><B>19.2 Valor Asegurado:</B><BR>" . number_format($sg->Value('ca_vlrasegurado')) . " " . $sg->Value('ca_idmoneda_vlr') . "</TD>";
                    echo "    <TD Class=mostrar><B>19.3 Prima Neta:</B><BR>" . $sg->Value('ca_primaneta') . "%</TD>";
                    echo "    <TD Class=mostrar><B>19.4 Prima Venta:</B><BR>" . $sg->Value('ca_primaventa') . "%</TD>";
                    echo "    <TD Class=mostrar><B>19.5 Obtención Póliza:</B><BR>" . number_format($sg->Value('ca_obtencionpoliza')) . " " . $sg->Value('ca_idmoneda_pol') . "</TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                echo "<TR>";
                echo "  <TD Class=invertir><B>Cantidades:</B></TD>";
                echo "  <TD Class=imprimir COLSPAN=4><CENTER><TABLE WIDTH=490 CELLSPACING=1 BORDER=1>";
                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=3 style='text-align:center; font-weight:bold;'>EMBARQUE " . strtoupper($rs->Value('ca_transporte')) . "</TD>";

                $rm = & DlRecordset::NewRecordset($conn);
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    if (!$rm->Open("select * from vi_repaereo where ca_idreporte = " . $rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repmaritimo
                        echo "<script>alert(\"" . addslashes($rm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    if ($rm->IsEmpty()) {
                        echo "    <TD Class=mostrar WIDTH=44 style='text-align:center;'><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Liquidar\", $id);'></TD>";  // Botón para la creación de un Registro Nuevo
                    } else {
                        echo "    <TD Class=invertir style='text-align:center;'><IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Reliquidar\", $id);'>";
                    }
                    echo "  </TR>";
                    while (!$rm->Eof()) {
                        echo "  <TR>";
                        echo "    <TD Class=mostrar><B>20. Concepto:</B><BR>" . $rm->Value('ca_concepto') . "</TD>";
                        echo "    <TD Class=mostrar><B>20.1 Tarifa Agente:</B><BR>" . number_format($rm->Value('ca_agente_tar')) . "</TD>";
                        echo "    <TD Class=mostrar><B>20.2 Tarifa Venta:</B><BR>" . number_format($rm->Value('ca_venta_tar')) . "</TD>";
                        echo "    <TD Class=mostrar><B>20.3 Moneda:</B><BR>" . $rm->Value('ca_idmoneda_tar') . "</TD>";
                        echo "  </TR>";
                        $rm->MoveNext();
                    }
                } else if ($rs->Value('ca_transporte') == 'Marítimo') {
                    if (!$rm->Open("select * from vi_repmaritimo where ca_idreporte = " . $rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repmaritimo
                        echo "<script>alert(\"" . addslashes($rm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                    if ($rm->IsEmpty()) {
                        echo "    <TD Class=mostrar WIDTH=44 style='text-align:center;'><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Liquidar\", $id);'></TD>";  // Botón para la creación de un Registro Nuevo
                    } else {
                        echo "    <TD Class=invertir style='text-align:center;'><IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Reliquidar\", $id);'>";
                    }
                    echo "  </TR>";
                    while (!$rm->Eof()) {
                        echo "  <TR>";
                        echo "  <TD Class=mostrar><B>20. Concepto:</B><BR>" . $rm->Value('ca_concepto') . "</TD>";
                        echo "  <TD Class=mostrar><B>20.1 Cantidad:</B><BR>" . number_format($rm->Value('ca_cantidad')) . "</TD>";
                        echo "  <TD Class=mostrar COLSPAN=2><TD>";           // Llena el cuadro de lista con los valores de la tabla Conceptos
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar><B>21. Tarifa Neta:</B><BR>" . number_format($rm->Value('ca_neta_tar')) . "</TD>";
                        echo "    <TD Class=mostrar><B>21.1 Tarifa Agente:</B><BR>" . number_format($rm->Value('ca_agente_tar')) . "</TD>";
                        echo "    <TD Class=mostrar><B>21.2 Tarifa Venta:</B><BR>" . number_format($rm->Value('ca_venta_tar')) . "</TD>";
                        echo "    <TD Class=mostrar><B>21.3 Moneda:</B><BR>" . $rm->Value('ca_idmoneda_tar') . "</TD>";
                        echo "  </TR>";
                        echo "  <TR>";
                        echo "    <TD Class=mostrar><B>22. BAF Neto:</B><BR>" . number_format($rm->Value('ca_neta_baf')) . "</TD>";
                        echo "    <TD Class=mostrar><B>22.1 BAF Agente:</B><BR>" . number_format($rm->Value('ca_agente_baf')) . "</TD>";
                        echo "    <TD Class=mostrar><B>22.2 BAF Venta:</B><BR>" . number_format($rm->Value('ca_venta_baf')) . "</TD>";
                        echo "    <TD Class=mostrar><B>22.3 Moneda:</B><BR>" . $rm->Value('ca_idmoneda_baf') . "</TD>";
                        echo "  </TR>";
                        echo "  <TR HEIGHT=5>";
                        echo "    <TD Class=imprimir COLSPAN=4></TD>";
                        echo "  </TR>";
                        $rm->MoveNext();
                    }
                }

                if ($rs->Value('ca_gastos_org') == '' and $rs->Value('ca_neta_org') == 0 and $rs->Value('ca_venta_org') == 0) {
                    echo "  <TR>";
                    echo "    <TD Class=mostrar><B>23. Gastos en Origen:</B><BR>" . $rs->Value('ca_gastos_org') . "</TD>";
                    echo "    <TD Class=mostrar><B>23.1 Gastos Neto:</B><BR>" . number_format($rs->Value('ca_neta_org')) . "</TD>";
                    echo "    <TD Class=mostrar><B>23.2 Gastos Venta:</B><BR>" . number_format($rs->Value('ca_venta_org')) . "</TD>";
                    echo "    <TD Class=mostrar><B>23.3 Moneda:</B><BR>" . $rs->Value('ca_idmoneda_org') . "</TD>";
                    echo "  </TR>";
                }
                echo "  </TABLE></CENTER></TD>";
                echo "</TR>";

                echo "  <TR>";
                echo "    <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>RELACIÓN DE GASTOS</TD>";
                echo "  </TR>";
                $rg = & DlRecordset::NewRecordset($conn);
                if (!$rg->Open("select * from vi_repgastos where ca_idreporte = " . $rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repgastos
                    echo "<script>alert(\"" . addslashes($rg->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }

                while (!$rg->Eof()) {
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=2><B>Concepto</B><BR>" . $rg->Value('ca_recargo') . "</TD>";
                    echo "    <TD Class=mostrar><B>Valor:</B><BR>" . $rg->Value('ca_valor') . "</TD>";
                    echo "    <TD Class=mostrar><B>Moneda:</B><BR>" . $rg->Value('ca_idmoneda') . "</TD>";
                    echo "    <TD Class=mostrar><B>Detalles:</B><BR>" . $rg->Value('ca_detalles') . "</TD>";
                    echo "  </TR>";
                    $rg->MoveNext();
                }
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=mostrar><B>Ciudad :</B><BR><CENTER>$ciu_mem</CENTER></TD>";
                echo "  <TD Class=mostrar><B>Fecha:</B><BR><CENTER>" . date("Y-m-d", mktime($hor, $min, $seg, $mes, $dia, $anno)) . "</CENTER></TD>";
                echo "  <TD Class=mostrar><B>Hora:</B><BR><CENTER>" . date("h:i:s a", mktime($hor, $min, $seg, $mes, $dia, $anno)) . "</CENTER></TD>";
                echo "  <TD Class=mostrar COLSPAN=2><B>Representante Comercial:</B><BR><CENTER>$usu_mem</CENTER></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"reporteventas.php\"'></TH>";  // Cancela la operación
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
} elseif (isset($accion)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch (trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar': {                                                      // El Botón Guardar fue pulsado
                if (!$rs->Open("insert into tb_reportes (ca_fchregistro, ca_idreporte, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_idproveedor, ca_orden_prov, ca_idconsignatario, ca_orden_cons, ca_idrepresentante, ca_informar_repr, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_idlinea, ca_zonadeposito, ca_gastos_org, ca_neta_org, ca_venta_org, ca_idmoneda_org, ca_fchcreado, ca_usucreado) values(to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), nextval('tb_reportes_id'), $idcotizacion, '$idciuorigen', '$idciudestino', '$impoexpo', '$fchdespacho', $idagente, '$incoterms', '$mercancia_desc', $idproveedor, '$orden_pro', $idconsignatario, '$orden_cons', $idrepresentante, '$informar_repr', '$transporte', '$modalidad', '$colmas', '$seguro', '$liberacion', '$tiempocredito', '$preferencias_clie', $idlinea, '$zonadeposito', 0, 0, 0, 'USD', to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                if (!$rs->Open("select last_value from tb_reportes_id")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                $id = $rs->Value('last_value');
                break;
            }
        case 'Actualizar': {                                                      // El Botón Guardar fue pulsado
                if (!$rs->Open("update tb_reportes set ca_idcotizacion = $idcotizacion, ca_origen = '$idciuorigen', ca_destino = '$idciudestino', ca_impoexpo = '$impoexpo', ca_fchdespacho = '$fchdespacho', ca_idagente = $idagente, ca_incoterms = '$incoterms', ca_mercancia_desc = '$mercancia_desc', ca_idproveedor = $idproveedor, ca_orden_prov = '$orden_pro', ca_idconsignatario = $idconsignatario,  ca_orden_cons = '$orden_cons',  ca_idrepresentante = $idrepresentante, ca_informar_repr = '$informar_repr', ca_transporte = '$transporte', ca_modalidad = '$modalidad', ca_colmas = '$colmas', ca_seguro = '$seguro',  ca_liberacion = '$liberacion', ca_tiempocredito = '$tiempocredito', ca_preferencias_clie = '$preferencias_clie', ca_idlinea = $idlinea, ca_zonadeposito = '$zonadeposito', ca_fchactualizado = to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idreporte = $id")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                break;
            }
        case 'Guardar Liquidación': {                                                      // El Botón Guardar fue pulsado
                if (isset($neta_org) and $neta_org != 0) {
                    if (!$rs->Open("update tb_reportes set ca_gastos_org = '$gastos_org', ca_neta_org = $neta_org, ca_venta_org = $venta_org, ca_idmoneda_org = '$idmoneda_org' where ca_idreporte = $idreporte")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                }
                if (isset($vlrasegurado) and $vlrasegurado != 0) {
                    if (!$rs->Open("insert into tb_repseguro (ca_idreporte, ca_modalventa, ca_modaltrans, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaneta, ca_primaventa, ca_obtencionpoliza, ca_idmoneda_pol) values($idreporte, '$modalventa', '$modaltrans', $vlrasegurado, '$idmoneda_vlr', $primaneta, $primaventa, $obtencionpoliza, '$idmoneda_pol')")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                }
                if (!$rs->Open("select ca_transporte from tb_reportes where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    for ($i = 0; $i < count($agente_tar); $i++) {
                        if ($agente_tar[$i] != 0) {
                            if (!$rs->Open("insert into tb_repaereo (ca_idreporte, ca_idconcepto, ca_agente_tar, ca_venta_tar, ca_idmoneda_tar) values($idreporte, $idconcepto[$i], $agente_tar[$i], $venta_tar[$i], '$idmoneda_tar')")) {
                                echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reporteventas.php';</script>";
                                exit;
                            }
                        }
                    }
                } else if ($rs->Value('ca_transporte') == 'Marítimo') {
                    for ($i = 0; $i < count($cantidad); $i++) {
                        if ($cantidad[$i] != 0) {
                            if (!$rs->Open("insert into tb_repmaritimo (ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_agente_tar, ca_venta_tar, ca_idmoneda_tar, ca_neta_baf, ca_agente_baf, ca_venta_baf, ca_idmoneda_baf) values($idreporte, $idconcepto[$i], $cantidad[$i], $neta_tar[$i], $agente_tar[$i], $venta_tar[$i], '$idmoneda_tar[$i]', $neta_baf[$i], $agente_baf[$i], $venta_baf[$i], '$idmoneda_baf[$i]')")) {
                                echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reporteventas.php';</script>";
                                exit;
                            }
                        }
                    }
                }
                for ($i = 0; $i < count($valor_gas); $i++) {
                    if ($valor_gas[$i] != 0) {
                        if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_valor, ca_idmoneda, ca_detalles) values($idreporte, $idrecargo_gas[$i], $valor_gas[$i], '$idmoneda_gas[$i]', '$detalles_gas[$i]')")) {
                            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reporteventas.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Actualizar Liquidación': {                                                      // El Botón Guardar fue pulsado
                $id = $idreporte;
                if (isset($neta_org) and $neta_org != 0) {
                    if (!$rs->Open("update tb_reportes set ca_gastos_org = '$gastos_org', ca_neta_org = $neta_org, ca_venta_org = $venta_org, ca_idmoneda_org = '$idmoneda_org' where ca_idreporte = $idreporte")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                }
                if (!$rs->Open("delete from tb_repseguro where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                if (isset($vlrasegurado) and $vlrasegurado != 0) {
                    if (!$rs->Open("insert into tb_repseguro (ca_idreporte, ca_modalventa, ca_modaltrans, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaneta, ca_primaventa, ca_obtencionpoliza, ca_idmoneda_pol) values($idreporte, '$modalventa', '$modaltrans', $vlrasegurado, '$idmoneda_vlr', $primaneta, $primaventa, $obtencionpoliza, '$idmoneda_pol')")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reporteventas.php';</script>";
                        exit;
                    }
                }
                if (!$rs->Open("delete from tb_repmaritimo where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                for ($i = 0; $i < count($cantidad); $i++) {
                    if ($cantidad[$i] != 0) {
                        if (!$rs->Open("insert into tb_repmaritimo (ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_agente_tar, ca_venta_tar, ca_idmoneda_tar, ca_neta_baf, ca_agente_baf, ca_venta_baf, ca_idmoneda_baf) values($idreporte, $idconcepto[$i], $cantidad[$i], $neta_tar[$i], $agente_tar[$i], $venta_tar[$i], '$idmoneda_tar[$i]', $neta_baf[$i], $agente_baf[$i], $venta_baf[$i], '$idmoneda_baf[$i]')")) {
                            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reporteventas.php';</script>";
                            exit;
                        }
                    }
                }
                if (!$rs->Open("delete from tb_repgastos where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reporteventas.php';</script>";
                    exit;
                }
                for ($i = 0; $i < count($valor_gas); $i++) {
                    if ($valor_gas[$i] != 0) {
                        if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_valor, ca_idmoneda, ca_detalles) values($idreporte, $idrecargo_gas[$i], $valor_gas[$i], '$idmoneda_gas[$i]', '$detalles_gas[$i]')")) {
                            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reporteventas.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
    }
    if (isset($id)) {
        echo "<script>document.location.href = 'reporteventas.php?boton=Consultar\&id=$id';</script>";  // Retorna a la pantalla principal de la opción
    } else {
        echo "<script>document.location.href = 'reporteventas.php';</script>";  // Retorna a la pantalla principal de la opción
    }
}

function datos_basicos(&$rs) {
    echo "<INPUT TYPE='HIDDEN' NAME='idreporte' VALUE=\"" . $rs->Value('ca_idreporte') . "\">";             // Hereda el Id de la Referencia que se esta modificando
    echo "<TABLE WIDTH=600 CELLSPACING=1>";
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=3 ROWSPAN=2 style='font-weight:bold;'>REPORTE DE NEGOCIOS</TH>";
    echo "  <TD Class=titulo style='text-align:center; font-weight:bold;'>Cotización:</TD>";
    echo "  <TD Class=titulo style='text-align:center; font-weight:bold;'>Reporte No.:</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar style='text-align:center; font-weight:bold;'>" . $rs->Value('ca_idcotizacion') . "</TD>";
    echo "  <TD Class=mostrar style='text-align:center; font-weight:bold;'>" . $rs->Value('ca_idreporte') . "</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TH Class=invertir COLSPAN=5 style='font-weight:bold;'>INFORMACION GENERAL</TH>";
    echo "<TR>";
    echo "  <TD Class=partir>1.&nbspImpor/Exportación</TD>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>2. Ciudad de Origen</TD>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>3. Ciudad de Destino</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center; font-weight:bold;'>" . $rs->Value('ca_impoexpo') . "<BR>&nbsp<BR>&nbsp</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>" . $rs->Value('ca_ciuorigen') . "</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>" . $rs->Value('ca_traorigen') . "</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>" . $rs->Value('ca_ciudestino') . "</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>" . $rs->Value('ca_tradestino') . "</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER>" . $rs->Value('ca_fchdespacho') . "</CENTER></TD>";
    echo "  <TD Class=listar COLSPAN=2><B>5. Agente Coltrans:</B><BR>" . $rs->Value('ca_agente') . "</TD>";
    echo "  <TD Class=mostrar><B>6. Incoterms:</B><BR>" . $rs->Value('ca_incoterms') . "</TD>";
    echo "  <TD Class=invertir style='text-align: right; vertical-align: bottom;'>Editar el Reporte: <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Editar\", \"" . $rs->Value('ca_idreporte') . "\");'></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=4><B>7. Descripción de la Mercancía:</B><BR>" . nl2br($rs->Value('ca_mercancia_desc')) . "</TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
    echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=490 CELLSPACING=1 BORDER=1>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=220><B>8. Nombre:</B><BR>" . $rs->Value('ca_nombre_pro') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=300><B>8.1 Orden:</B><BR>" . $rs->Value('ca_orden_prov') . "</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2><B>8.2 Contacto:</B><BR>" . $rs->Value('ca_contacto_pro') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>8.3 Dirección:</B><BR>" . $rs->Value('ca_direccion_pro') . "</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar><B>8.4 Teléfono:</B><BR>" . $rs->Value('ca_telefonos_pro') . "</TD>";
    echo "    <TD Class=mostrar><B>8.5 Fax:</B><BR>" . $rs->Value('ca_fax_pro') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>8.6 Correo Electrónico:</B><BR>" . $rs->Value('ca_email_pro') . "</TD>";
    echo "  </TR>";
    echo "  </TABLE><TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consignatario:<BR></TD>";
    echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=490 CELLSPACING=1 BORDER=1>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=220><B>9. Nombre:</B><BR>" . $rs->Value('ca_nombre_con') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=300><B>9.1 Orden:</B><BR>" . $rs->Value('ca_orden_cons') . "</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2><B>9.2 Contacto:</B><BR>" . $rs->Value('ca_contacto_con') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>9.3 Dirección:</B><BR>" . $rs->Value('ca_direccion_con') . "</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar><B>9.4 Teléfono:</B><BR>" . $rs->Value('ca_telefonos_con') . "</TD>";
    echo "    <TD Class=mostrar><B>9.5 Fax:</B><BR>" . $rs->Value('ca_fax_con') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>9.6 Correo Electrónico:</B><BR>" . $rs->Value('ca_email_con') . "</TD>";
    echo "  </TR>";
    echo "  </TABLE><TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Representante:<BR></TD>";
    echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=490 CELLSPACING=1 BORDER=1>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=220><B>10. Nombre:</B><BR>" . $rs->Value('ca_nombre_rep') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2 WIDTH=300><B>10.1 Enviar Información:</B><BR><CENTER>" . $rs->Value('ca_informar_repr') . "<CENTER></TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar COLSPAN=2><B>10.2 Contacto:</B><BR>" . $rs->Value('ca_contacto_rep') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>10.3 Dirección:</B><BR>" . $rs->Value('ca_direccion_rep') . "</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=mostrar><B>10.4 Teléfono:</B><BR>" . $rs->Value('ca_telefonos_rep') . "</TD>";
    echo "    <TD Class=mostrar><B>10.5 Fax:</B><BR>" . $rs->Value('ca_fax_rep') . "</TD>";
    echo "    <TD Class=mostrar COLSPAN=2><B>10.6 Correo Electrónico:</B><BR>" . $rs->Value('ca_email_rep') . "</TD>";
    echo "  </TR>";
    echo "  </TABLE><TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
    echo "  <TD Class=mostrar COLSPAN=4><B>11. Preferencias del Cliente:</B><BR>" . nl2br($rs->Value('ca_preferencias_clie')) . "</TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>12. Transporte:<BR><CENTER>" . $rs->Value('ca_transporte') . "</CENTER></TD>";
    echo "  <TD Class=mostrar><B>13.&nbspModalidad:</B><BR><CENTER>" . $rs->Value('ca_modalidad') . "</CENTER></TD>";
    echo "  <TD Class=mostrar COLSPAN=3><B>14.&nbspLínea&nbspTransporte:</B><BR>" . $rs->Value('ca_nombre') . "</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar><B>15.&nbspColmas&nbspS.I.A.&nbspLtda:</B><BR><CENTER>" . $rs->Value('ca_colmas') . "</CENTER></TD>";
    echo "  <TD Class=mostrar><B>16.&nbspSeguro&nbspcon&nbspAnker:</B><BR><CENTER>" . $rs->Value('ca_seguro') . "</CENTER></TD>";
    echo "  <TD Class=mostrar><B>17.&nbspLib.&nbspAutomática:</B><BR><CENTER>" . $rs->Value('ca_liberacion') . "&nbsp&nbsp-&nbsp&nbsp" . $rs->Value('ca_tiempocredito') . "</CENTER></TD>";
    echo "  <TD Class=mostrar><B>18.&nbspZona/Depósito:</B><BR><CENTER>" . $rs->Value('ca_zonadeposito') . "</CENTER></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=partir COLSPAN=5></TD>";
    echo "</TR>";
}

function carga_arreglos(&$tm) {
    $zonas = array("Descargue Directo", "Aintercarga", "Air Cargo", "Alcomex", "Almacenar 22", "Almacenar 60", "Almagran", "Almagrario Cra 100", "Almaviva", "Almincarga", "Consimex", "Dapsa", "Greencargo", "Repremundo 1", "Repremundo 2", "Roldan", "Snider", "Uticolcarga"); // Arreglos Con Las Zonas Aduaneras
    $depositos = array("Alcomex", "Almagrario", "Alservicios", "Bioquim", "Fotomoriz", "Fotomoriz ZF", "Industrias Phatra", "Logimat", "Logistica", "Melyak", "Repremundo", "Sky", "Stair Zona", "Trading", "Zona Franca");
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reporteventas.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=" . $tm->Value('ca_idtrafico') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='" . $tm->Value('ca_nombre') . "'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_ciudades order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reporteventas.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=" . $tm->Value('ca_idciudad') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='" . $tm->Value('ca_ciudad') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='" . $tm->Value('ca_idtrafico') . "'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idagente, ca_nombre, ca_idtrafico from vi_agentes order by ca_nombre")) { // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reporteventas.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idagentes' VALUE=" . $tm->Value('ca_idagente') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='agentes' VALUE='" . $tm->Value('ca_nombre') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='idtraficoags' VALUE='" . $tm->Value('ca_idtrafico') . "'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idlinea, ca_nombre, ca_transporte from vi_transporlineas order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'trayectos.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=" . $tm->Value('ca_idlinea') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='" . $tm->Value('ca_nombre') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='" . $tm->Value('ca_transporte') . "'>";
        $tm->MoveNext();
    }
    for ($i = 0; $i < count($zonas); $i++) {
        echo "<INPUT TYPE='HIDDEN' NAME='azonas' VALUE='" . $zonas[$i] . "'>";
    }
    for ($i = 0; $i < count($depositos); $i++) {
        echo "<INPUT TYPE='HIDDEN' NAME='adepositos' VALUE='" . $depositos[$i] . "'>";
    }
}
?>