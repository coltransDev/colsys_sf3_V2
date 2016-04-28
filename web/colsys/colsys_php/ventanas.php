<?
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       VENTANAS.PHP                                                \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Módulo de Rutinas para ejecutar en Ventanas.                \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */

$titulo = 'Sistema de Información - Colsys';
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
header("Cache-Control: no-store, must-revalidate");
session_cache_limiter('private_expire');

require_once("checklogin.php");

$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (isset($suf) and $suf == 'findDianDeposito') {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='ventanas' ACTION='ventanas.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='suf' VALUE='listDianDeposito'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=3 style='font-size: 12px; font-weight:bold;'><B>Base de Datos de Depósitos de la Dian</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='contents' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.window_div.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($suf) and $suf == 'listDianDeposito') {
    $condicion = "where lower(ca_nombre) like lower('%" . $contents . "%')";
    if (!$rs->Open("select ca_codigo, ca_nombre, ca_fchdesde, ca_fchhasta from tb_diandepositos $condicion order by ca_nombre")) {  // Selecciona todos lo registros de la tabla DianDepositos
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(nw, nm){";
    echo "    window.parent.document.getElementById('coddeposito').value = nw;";
    echo "    window.parent.document.getElementById('nomdeposito').value = nm;";
    echo "    window.parent.frames.window_div.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
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
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>" . COLTRANS . "<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Cod.Depósito</TH>";
    echo "<TH>Nombre</TH>";
    echo "<TH>Fch.Desde</TH>";
    echo "<TH>Fch.Hasta</TH>";
    $consecutivo = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR>";
        echo "  <TD Class=listar onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick=\"javascript:elegir('" . $rs->Value('ca_codigo') . "','" . $rs->Value('ca_nombre') . " Vigencia: " . $rs->Value('ca_fchdesde') . " Hasta: " . $rs->Value('ca_fchhasta') . "')\">" . $rs->Value('ca_codigo') . "</TD>";
        echo "  <TD Class=listar>" . $rs->Value('ca_nombre') . "</TD>";
        echo "  <TD Class=listar>" . $rs->Value('ca_fchdesde') . "</TD>";
        echo "  <TD Class=listar>" . $rs->Value('ca_fchhasta') . "</TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"ventanas.php?suf=findDianDeposito\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//			echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($suf) and $suf == 'Instructions_sea') {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function pasar_texto() {";
    echo "  i = 0;";
    echo "  cadena = '';";
    echo "  elemento = window.parent.document.getElementById('instrucciones');";
    echo "  while (isNaN(document.getElementById('text_predef_'+i))) {";
    echo "     objeto = document.getElementById('text_predef_'+i);";
    echo "     if (objeto.checked) {";
    echo "        cadena+= '\\n'+objeto.value+'\\n';";
    echo "     }";
    echo "     i++;";
    echo "  }";
    echo "  elemento.value+=cadena;";
    echo "  window.parent.frames.find_texts.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "</script>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    if (!$rs->Open("select ca_valor from tb_parametros where ca_casouso = 'CU024'")) {    // Selecciona los registros de la tabla parámetros
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }
    echo "<TR>";
    echo " <TH WIDTH=90%>Textos Predefinidos para el cuadro de Instrucciones Especiales</TH>";
    echo " <TH WIDTH=10%>Incluir</TH>";
    echo "</TR>";
    $z = 0;
    while (!$rs->Eof()) {
        echo "<TR>";
        echo " <TD Class=mostrar>" . $rs->Value('ca_valor') . "</TD>";
        echo " <TD Class=mostrar style='text-align:center;'><INPUT ID=text_predef_$z TYPE='CHECKBOX' NAME='text_predef[]' VALUE='" . $rs->Value('ca_valor') . "'></TD>";
        echo "</TR>";
        $rs->MoveNext();
        $z++;
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=2></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE=' Incluir ' ONCLICK='pasar_texto();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_texts.style.visibility = \"hidden\";window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($suf) and $suf == 'Instructions_air') {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function pasar_texto() {";
    echo "  i = 0;";
    echo "  cadena = '';";
    echo "  elemento = window.parent.document.getElementById('instrucciones');";
    echo "  while (isNaN(document.getElementById('text_predef_'+i))) {";
    echo "     objeto = document.getElementById('text_predef_'+i);";
    echo "     if (objeto.checked) {";
    echo "        cadena+= '\\n'+objeto.value+'\\n';";
    echo "     }";
    echo "     i++;";
    echo "  }";
    echo "  elemento.value+=cadena;";
    echo "  window.parent.frames.find_texts.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "</script>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    if (!$rs->Open("select ca_valor from tb_parametros where ca_casouso = 'CU039'")) {    // Selecciona los registros de la tabla parámetros
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }
    echo "<TR>";
    echo " <TH WIDTH=90%>Textos Predefinidos para el cuadro de Instrucciones Especiales</TH>";
    echo " <TH WIDTH=10%>Incluir</TH>";
    echo "</TR>";
    $z = 0;
    while (!$rs->Eof()) {
        echo "<TR>";
        echo " <TD Class=mostrar>" . $rs->Value('ca_valor') . "</TD>";
        echo " <TD Class=mostrar style='text-align:center;'><INPUT ID=text_predef_$z TYPE='CHECKBOX' NAME='text_predef[]' VALUE='" . $rs->Value('ca_valor') . "'></TD>";
        echo "</TR>";
        $rs->MoveNext();
        $z++;
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=2></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE=' Incluir ' ONCLICK='pasar_texto();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_texts.style.visibility = \"hidden\";window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Existe_reporte') {
    $p2 = (strlen($p2) == 0) ? 0 : $p2;
    $p5 = (strlen($p5) == 0) ? 0 : $p5;
    if (!$rs->Open("select ca_idreporte from tb_reportes where ca_fchreporte BETWEEN (date('$p0')-4) AND (date('$p0')+4) and ca_origen = '$p1' and ca_destino = '$p2' and ca_idagente = '$p3' and fun_texttokencompare(ca_idproveedor,'$p4','|') and ca_idconcliente = '$p5' and ca_transporte = '$p6'")) {    // Selecciona los registros de la tabla parámetros
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }
    $rs->MoveFirst();
    if (!$rs->Eof() and !$rs->IsEmpty()) {
        echo "<script>window.parent.document.getElementById('validado').value = confirm(\"Existe un reporte de negocios reciente con similares parámetros. ¿Desea continuar?\")?'true':'false'</script>";
    }
} else if (isset($opcion) and $opcion == 'valida_cantidades') {
    if (!$rs->Open("select ca_peso, ca_volumen, ca_peso_cap, ca_volumen_cap from vi_inomaestra_sea where ca_referencia = '$referencia'")) {    // Selecciona los registros de la tabla ino_maestra_sea
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }
    $rs->MoveFirst();
    if (!$rs->Eof() and !$rs->IsEmpty()) {
        if ($rs->Value('ca_peso') + $peso > $rs->Value('ca_peso_cap')) {
            echo "<script>window.parent.document.getElementById('explicacion').value = 'Peso Ref. " . $rs->Value('ca_peso') + $peso . " - Capacidad " . $rs->Value('ca_peso_cap') . "';</script>";
            echo "<script>window.parent.document.getElementById('validado').value = 'false';</script>";
        } else if ($rs->Value('ca_volumen') + $volumen > $rs->Value('ca_volumen_cap')) {
            echo "<script>window.parent.document.getElementById('explicacion').value = 'Volumen Ref. " . $rs->Value('ca_volumen') + $volumen . " - Capacidad " . $rs->Value('ca_volumen_cap') . "';</script>";
            echo "<script>window.parent.document.getElementById('validado').value = 'false';</script>";
        } else {
            echo "<script>window.parent.document.getElementById('validado').value = 'true';</script>";
        }
    }
} else if (isset($opcion) and $opcion == 'Email' and isset($id)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=90% CELLSPACING=1 BORDER='1' BGCOLOR='#D2D2D2'>";       // un boton de comando definido para hacer mantemientos
    if (!$rs->Open("select e.*, a.ca_idattachment, a.ca_header_file from vi_emails e LEFT OUTER JOIN tb_attachments a ON (e.ca_idemail = a.ca_idemail) where e.ca_idemail = $id")) {        // Selecciona los registros de la tabla emails
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        exit;
    }
    echo "<TR>";
    echo " <TH COLSPAN=2>CORREO ELECTRÓNICO ENVIADO</TH>";
    echo "</TR>";
    $idemail = null;
    $attachments = array();
    while (!$rs->Eof()) {
        $attachments[$rs->Value('ca_idattachment')] = $rs->Value('ca_header_file');
        if ($idemail == $rs->Value('ca_idemail')) {
            $rs->MoveNext();
            continue;
        }
        echo "<TR>";
        echo " <TD Class=mostrar><B>Fecha de Enviado:</B><BR>" . $rs->Value('ca_fchenvio') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Usuario que Envió:</B><BR>" . $rs->Value('ca_usuenvio') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Nombre del Usuario:</B><BR>" . $rs->Value('ca_nombre') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Email del Usuario:</B><BR>" . $rs->Value('ca_email') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Destinatarios:</B><BR>" . $rs->Value('ca_address') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>CC.:</B><BR>" . $rs->Value('ca_cc') . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Asunto:</B><BR>" . StripSlashes($rs->Value('ca_subject')) . "</TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=mostrar><B>Mensaje:</B><BR>" . StripSlashes($rs->Value('ca_body')) . "</TD>";
        echo "</TR>";
        $idemail = $rs->Value('ca_idemail');
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=2></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=mostrar>Ver Adjuntos: <TABLE WIDTH=95% CELLSPACING=1><TR>";
    foreach ($attachments as $key => $attachment) {
        echo "<TD Class=invertir><a href='ventanas.php?opcion=see_attachment&id=$key'>$attachment</a></TD>";
    }
    echo "  </TR></TABLE></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:window.close()'></TH>";  // Cierra la ventana
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Producto' and $id != 0) {
    $imporexpor = array("Importación", "Exportación");                              // Arreglo con los tipos de Trayecto
    $transportes = array("Aéreo", "Marítimo", "Terrestre");                          // Arreglo con los tipos de Transportes
    $formas = array("Por Item", "Puerto", "Concepto", "Trayecto");                                // Arreglo con los tipos de Impresion por
    $tm = & DlRecordset::NewRecordset($conn);

    if (!$tm->Open("select ca_valor from tb_parametros where ca_casouso = 'CU062'")) { // Selecciona los términos de la tabla Parametros
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $tincoterms = array(); // Arreglo con los términos Iconterms
    while (!$tm->Eof()) {
        $tincoterms[] = $tm->Value('ca_valor');
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=" . $tm->Value('ca_idtrafico') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='" . $tm->Value('ca_nombre') . "'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_puerto, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=" . $tm->Value('ca_idciudad') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='" . $tm->Value('ca_ciudad') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='tippuerto' VALUE='" . $tm->Value('ca_puerto') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='" . $tm->Value('ca_idtrafico') . "'>";
        $tm->MoveNext();
    }
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    a_conceptos = new Array();";
    echo "    j = 0;";
    echo "    target = document.getElementById('producto_b');";
    echo "    target.options[target.length] = new Option('','',false,false);";
    echo "    while (isNaN(window.parent.document.getElementById('fprod_'+j))) {";
    echo "    	source = window.parent.document.getElementById('fprod_'+j);";
    echo "    	found = false;";
    echo "    	for(var z=0; z<a_conceptos.length; z++) {";
    echo "			if (a_conceptos[z] == source.value){";
    echo "    			found = true;";
    echo "    			break;";
    echo "    		}";
    echo "    	}";
    echo "    	if (!found && source.value != ''){";
    echo "    		a_conceptos.push(source.value);";
    echo "  		target.options[target.length] = new Option(source.value,source.value,false,false);";
    echo "    	}";
    echo "      j++;";
    echo "    }";
    echo "    source = window.parent.document.getElementById('fprod_$i');";
    echo "    elegir_item('producto_b', source.value);";
    echo "    source = window.parent.document.getElementById('fimex_$i');";
    echo "    elegir_item('impoexpo', source.value);";
    echo "    llenar_traficos();";
    echo "    source = window.parent.document.getElementById('finct_$i');";
    echo "    elegir_item('incoterms', source.value);";
    echo "    source = window.parent.document.getElementById('ftrns_$i');";
    echo "    elegir_item('transporte', source.value);";
    echo "    source = window.parent.document.getElementById('ftorg_$i');";
    echo "    elegir_item('idtraorigen', source.value);";
    echo "    llenar_origenes();";
    echo "    source = window.parent.document.getElementById('fiorg_$i');";
    echo "    elegir_item('idciuorigen', source.value);";
    echo "    source = window.parent.document.getElementById('ftdst_$i');";
    echo "    elegir_item('idtradestino', source.value);";
    echo "    llenar_destinos();";
    echo "    source = window.parent.document.getElementById('fidst_$i');";
    echo "    elegir_item('idciudestino', source.value);";
    echo "    source = window.parent.document.getElementById('fmodl_$i');";
    echo "    elegir_item('modalidad', source.value);";
    echo "    source = window.parent.document.getElementById('fobsv_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "    source = window.parent.document.getElementById('fimpr_$i');";
    echo "    elegir_item('forma', source.value);";
    echo "}";
    echo "function registro() {";
    echo " if (validar()){";
    echo "    source = document.getElementById('producto_a');";
    echo "    if (source.value == '')";
    echo "        source = document.getElementById('producto_b');";
    echo "    target = window.parent.document.getElementById('fprod_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('impoexpo');";
    echo "    target = window.parent.document.getElementById('fimex_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('incoterms');";
    echo "    target = window.parent.document.getElementById('finct_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('transporte');";
    echo "    target = window.parent.document.getElementById('ftrns_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('modalidad');";
    echo "    target = window.parent.document.getElementById('fmodl_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idtraorigen');";
    echo "    target = window.parent.document.getElementById('ftorg_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idciuorigen');";
    echo "    target = window.parent.document.getElementById('fiorg_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcorg_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('idtradestino');";
    echo "    target = window.parent.document.getElementById('ftdst_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idciudestino');";
    echo "    target = window.parent.document.getElementById('fidst_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcdst_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('observaciones');";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('forma');";
    echo "    target = window.parent.document.getElementById('fimpr_$i');";
    echo "    target.value = source.value;";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('fdlte_$i');";
    echo "    target.value = window.parent.document.getElementById('fidpr_$i').value;";
    echo "    target = window.parent.document.getElementById('fprod_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fimex_$i');";
    echo "    target.value = '+ Productos';";
    echo "    target = window.parent.document.getElementById('finct_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftrns_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fmodl_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftorg_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fiorg_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcorg_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftdst_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fidst_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcdst_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fimpr_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "}";

    echo "function llenar_traficos(){";
    echo "  document.producto.idtraorigen.length=0;";
    echo "  document.producto.idtraorigen.options[document.producto.idtraorigen.length] = new Option();";
    echo "  document.producto.idtraorigen.length=0;";
    echo "  document.producto.idtradestino.length=0;";
    echo "  document.producto.idtradestino.options[document.producto.idtradestino.length] = new Option();";
    echo "  document.producto.idtradestino.length=0;";
    echo "  if (document.producto.impoexpo.value == 'Importación'){";
    echo "      for (cont=0; cont<idtraficos.length; cont++) {";
    echo "           if (idtraficos[cont].value != '$regional')";
    echo "               document.producto.idtraorigen[document.producto.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
    echo "           else";
    echo "               document.producto.idtradestino[document.producto.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "  else {";
    echo "      for (cont=0; cont<idtraficos.length; cont++) {";
    echo "           if (idtraficos[cont].value == '$regional')";
    echo "               document.producto.idtraorigen[document.producto.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
    echo "           else";
    echo "               document.producto.idtradestino[document.producto.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "  llenar_origenes();";
    echo "  llenar_destinos();";
    echo "}";
    echo "function llenar_origenes(){";
    echo "  document.producto.idciuorigen.length=0;";
    echo "  document.producto.idciuorigen.options[document.producto.idciuorigen.length] = new Option();";
    echo "  document.producto.idciuorigen.length=0;";
    echo "  if (isNaN(idciudades.length)){";
    echo "      if (document.producto.idtraorigen.value == ciutraficos.value){";
    echo "          document.producto.idciuorigen[document.producto.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<idciudades.length; cont++) {";
    echo "          if (document.producto.idtraorigen.value == ciutraficos[cont].value){";
    echo "              document.producto.idciuorigen[document.producto.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "}";
    echo "function llenar_destinos(){";
    echo "  document.producto.idciudestino.length=0;";
    echo "  document.producto.idciudestino.options[document.producto.idciudestino.length] = new Option();";
    echo "  document.producto.idciudestino.length=0;";
    echo "  if (isNaN(idciudades.length)){";
    echo "      if (document.producto.idtradestino.value == ciutraficos.value && (document.producto.transporte.value == tippuerto.value || tippuerto.value == 'Ambos')){";
    echo "          document.producto.idciudestino[document.producto.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<idciudades.length; cont++) {";
    echo "          if (document.producto.idtradestino.value == ciutraficos[cont].value && (document.producto.transporte.value == tippuerto[cont].value || tippuerto[cont].value == 'Ambos')){";
    echo "              document.producto.idciudestino[document.producto.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "  llenar_modalidades();";
    echo "}";
    echo "function llenar_modalidades(){";
    echo "	document.producto.modalidad.length=0;";
    echo "	document.producto.modalidad.options[document.producto.modalidad.length] = new Option();";
    echo "	document.producto.modalidad.length=0;";
    echo "	if (document.producto.impoexpo.value=='Exportación'){";
    echo "		if (document.producto.transporte.value=='Aéreo'){ ";
    echo "			document.producto.modalidad[document.producto.modalidad.length] = new Option('DIRECTO','DIRECTO',false,false);}";
    echo "		else{ ";
    echo "	    	document.producto.modalidad[document.producto.modalidad.length] = new Option('LCL','LCL',false,false);";
    echo "			document.producto.modalidad[document.producto.modalidad.length] = new Option('FCL','FCL',false,false);}";
    echo "	}else if (document.producto.transporte.value=='Aéreo'){";
    echo "		document.producto.modalidad[document.producto.modalidad.length] = new Option('CONSOLIDADO','CONSOLIDADO',false,false);";
    echo "	}else if (document.producto.transporte.value=='Marítimo'){";
    echo "	    document.producto.modalidad[document.producto.modalidad.length] = new Option('LCL','LCL',false,false);";
    echo "		document.producto.modalidad[document.producto.modalidad.length] = new Option('FCL','FCL',false,false);";
    echo "		document.producto.modalidad[document.producto.modalidad.length] = new Option('COLOADING','COLOADING',false,false);";
    echo "	}else if (document.producto.transporte.value=='Terrestre' || document.producto.impoexpo.value=='Exportación'){";
    echo "		document.producto.modalidad[document.producto.modalidad.length] = new Option('DIRECTO','DIRECTO',false,false);";
    echo "	}";
    echo "}";
    echo "function validar(){";
    echo "  if (document.producto.producto_a.value == '' && document.producto.producto_b.value == '')";
    echo "      alert('Debe ingresar el detalle del producto a transportar');";
    echo "  else if (document.producto.idciuorigen.value == '')";
    echo "      alert('Seleccione la Ciudad de Origen');";
    echo "  else if (document.producto.idciudestino.value == '')";
    echo "      alert('Seleccione la Ciudad de Destino');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='producto' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios

    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=5>Datos sobre el Producto a Transportar</TH>";
    echo "<TR>";
    echo "  <TD Class=captura>Producto:</TD>";
    echo "  <TD Class=mostrar COLSPAN=2><B>Producto Adicional :</B><BR><INPUT TYPE='TEXT' NAME='producto_a' SIZE=48 MAXLENGTH=255></TD>";
    echo "  <TD Class=mostrar COLSPAN=2><B>Productos Cotizados :</B><BR><CENTER><SELECT NAME='producto_b'></SELECT></CENTER></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=3>Trayecto:</TD>";
    echo "  <TD Class=mostrar><B>Impo/Exportación :</B><BR><CENTER><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
    for ($i = 0; $i < count($imporexpor); $i++) {
        echo " <OPTION VALUE=" . $imporexpor[$i] . ">" . $imporexpor[$i];
    }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar><B>Incoterms:</B><BR><SELECT NAME='incoterms'>";
    for ($i = 0; $i < count($tincoterms); $i++) {
        echo " <OPTION VALUE='" . $tincoterms[$i] . "'>" . substr($tincoterms[$i], 0, 18);
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar><B>Transporte :</B><BR><CENTER><SELECT NAME='transporte' ONCHANGE='llenar_destinos();'>";
    for ($i = 0; $i < count($transportes); $i++) {
        echo " <OPTION VALUE=" . $transportes[$i] . ">" . $transportes[$i];
    }
    echo "  </SELECT></CENTER></TD>";
    echo "  <TD Class=mostrar><B>Modalidad :</B><BR><CENTER><SELECT NAME='modalidad'>";
    echo "  </SELECT></CENTER></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=2>Ciudad de Origen</TH>";
    echo "  <TH Class=titulo COLSPAN=2>Ciudad de Destino</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciuorigen' SIZE=6>";          // Llena el cuadro de lista con los valores de la tabla Origenes
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='vertical-align:top; text-align:center;' WIDTH=100><SELECT NAME='idciudestino' SIZE=6>";         // Llena el cuadro de lista con los valores de la tabla Destinos
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=titulo></TD>";
    echo "  <TD Class=mostrar COLSPAN=3><B>Observaciones:<B><BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=4 COLS=75></TEXTAREA></TD>";
    echo "  <TD Class=listar style='vertical-align:bottom;'><B>Imprimir por:</B><BR><CENTER><SELECT NAME='forma'>";
    for ($i = 0; $i < count($formas); $i++) {
        echo " <OPTION VALUE='" . $formas[$i] . "'>" . $formas[$i];
    }
    echo "  </SELECT></CENTER></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>llenar_traficos();cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Opciones' and $id != 0) {
    $tm = & DlRecordset::NewRecordset($conn);
    $aplic = array("Aéreo" => array("", "x Kg ó 6 Dm³", "x Lb ó 166 Pul³"), "Marítimo" => array("", "x T/M³", "x Contenedor"));
    if (!$tm->Open("select ca_idconcepto, ca_concepto, p.ca_transporte from vi_conceptos c, vi_cotproductos p where c.ca_transporte = p.ca_transporte and c.ca_modalidad = p.ca_modalidad and ca_idproducto = '$pr'")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tra_mem = $tm->Value('ca_transporte');
    $tm->MoveFirst();
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    source = window.parent.document.getElementById('fidcn_$i');";
    echo "    elegir_item('idconcepto', source.value);";
    echo "    source = window.parent.document.getElementById('fflte_$i');";
    echo "    target = document.getElementById('tarifa_ofr');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('ffmin_$i');";
    echo "    target = document.getElementById('tarifa_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fmnda_$i');";
    echo "    elegir_item('tarifa_idm', source.value);";
    echo "    source = window.parent.document.getElementById('ffapl_$i');";
    echo "    elegir_item('aplicacion', source.value);";
    echo "    source = window.parent.document.getElementById('fdets_$i');";
    echo "    target = document.getElementById('detalles');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo " if (validar(\"tarifa_ofr,tarifa_min\")){";
    echo "    curren = document.getElementById('tarifa_idm');";
    echo "    source = document.getElementById('idconcepto');";
    echo "    target = window.parent.document.getElementById('fidcn_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcnpt_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('tarifa_ofr');";
    echo "    target = window.parent.document.getElementById('fflte_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tarifa_min');";
    echo "    target = window.parent.document.getElementById('ffmin_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = curren.value;";
    echo "    source = document.getElementById('aplicacion');";
    echo "    target = window.parent.document.getElementById('ffapl_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('detalles');";
    echo "    target = window.parent.document.getElementById('fdets_$i');";
    echo "    target.value = source.value;";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('fidcn_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcnpt_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fflte_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ffmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ffapl_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fdets_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='opciones' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=" . $pr . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=5>Tarifa a Ofrecer</TH>";

    echo "<TR>";
    echo "  <TD Class=invertir style='text-align:left; vertical-align:top;'><B>Concepto:</B><BR><SELECT NAME='idconcepto'>";
    while (!$tm->Eof()) {
        echo"<OPTION VALUE=\"" . $tm->Value('ca_idconcepto') . "\">" . $tm->Value('ca_concepto') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=invertir><B>Tarifa:</B><BR><INPUT TYPE='TEXT' NAME='tarifa_ofr' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='tarifa_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='tarifa_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "  <TD Class=invertir style='text-align:left; vertical-align:top;'><b>Aplicación:</b><br /><SELECT NAME='aplicacion'>";
    reset($aplic[$tra_mem]);
    while (list ($clave, $val) = each($aplic[$tra_mem])) {
        echo " <OPTION VALUE='$val'>" . $val;
    }
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=5><B>Detalles:</B><BR><INPUT TYPE='TEXT' NAME='detalles' SIZE=75 MAXLENGTH=150></TD>";  // Campos para captura de tarifas
    echo "</TR>";
    echo "<TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=5></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Continuacion' and $id != 0) {
    $tiposs = array("OTM", "DTA");          // Arreglo con los tipos de Continuaciones de Viaje
    $modals = array("LCL", "FCL");          // Arreglo con los tipos de Modalidades de Carga
    $pt = & DlRecordset::NewRecordset($conn);
    if (!$pt->Open("select ca_idciudad, ca_ciudad, ca_puerto from vi_puertos where ca_idtrafico = '$regional'")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $pt->MoveFirst();
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    if (!$rs->Open("select ca_idconcepto, ca_concepto, ca_transporte, ca_modalidad from vi_conceptos where ca_transporte in ('Marítimo','Terrestre')")) { // Selecciona todos lo registros de la tabla Conceptos
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $rs->MoveFirst();
    while (!$rs->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idconceptos' VALUE=" . $rs->Value('ca_idconcepto') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='conceptos' VALUE=\"" . $rs->Value('ca_concepto') . "\">";
        echo "<INPUT TYPE='HIDDEN' NAME='transportes' VALUE='" . $rs->Value('ca_transporte') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='modalidades' VALUE='" . $rs->Value('ca_modalidad') . "'>";
        $rs->MoveNext();
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    source = window.parent.document.getElementById('fiorg_$i');";
    echo "    elegir_item('idciuorigen', source.value);";
    echo "    source = window.parent.document.getElementById('fidst_$i');";
    echo "    elegir_item('idciudestino', source.value);";
    echo "    source = window.parent.document.getElementById('fidcn_$i');";
    echo "    elegir_item('idconcepto', source.value);";
    echo "    source = window.parent.document.getElementById('ftipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('fmodl_$i');";
    echo "    elegir_item('modalidad', source.value);";
    echo "    llenar_equipos();";
    echo "    source = window.parent.document.getElementById('fideq_$i');";
    echo "    elegir_item('idequipo', source.value);";
    echo "    source = window.parent.document.getElementById('ftrfa_$i');";
    echo "    target = document.getElementById('tarifa_ofr');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('ffmin_$i');";
    echo "    target = document.getElementById('tarifa_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fmnda_$i');";
    echo "    elegir_item('tarifa_idm', source.value);";
    echo "    source = window.parent.document.getElementById('ffrca_$i');";
    echo "    target = document.getElementById('frecuencia');";
    echo "    target.value = source.value;";
    echo "    source = window.parent.document.getElementById('fttrs_$i');";
    echo "    target = document.getElementById('tiempotransito');";
    echo "    target.value = source.value;";
    echo "    source = window.parent.document.getElementById('fobsv_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo " if (validar()){";
    echo "    source = document.getElementById('idciuorigen');";
    echo "    target = window.parent.document.getElementById('fiorg_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcorg_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('idciudestino');";
    echo "    target = window.parent.document.getElementById('fidst_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcdst_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('idconcepto');";
    echo "    target = window.parent.document.getElementById('fidcn_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('fcnpt_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('tipo');";
    echo "    target = window.parent.document.getElementById('ftipo_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('modalidad');";
    echo "    target = window.parent.document.getElementById('fmodl_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idequipo');";
    echo "    target = window.parent.document.getElementById('fideq_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('feqpo_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('tarifa_ofr');";
    echo "    target = window.parent.document.getElementById('ftrfa_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tarifa_min');";
    echo "    target = window.parent.document.getElementById('ffmin_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tarifa_idm');";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('frecuencia');";
    echo "    target = window.parent.document.getElementById('ffrca_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tiempotransito');";
    echo "    target = window.parent.document.getElementById('fttrs_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('observaciones');";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = source.value;";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('fiorg_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcorg_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fidst_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcdst_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fidcn_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcnpt_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftipo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fmodl_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fideq_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('feqpo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftrfa_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ffmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ffrca_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fttrs_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function llenar_equipos(){";
    echo "  document.continuacion.idequipo.length=0;";
    echo "  document.continuacion.idequipo.options[document.continuacion.idequipo.length] = new Option();";
    echo "  document.continuacion.idequipo.length=0;";
    echo "  if (isNaN(idconceptos.length)){";
    echo "      if (modalidades.value == document.continuacion.modalidad.value){";
    echo "          document.continuacion.idequipo[document.continuacion.idequipo.length] = new Option(conceptos.value,idconceptos.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<idconceptos.length; cont++) {";
    echo "          if (modalidades[cont].value == document.continuacion.modalidad.value){";
    echo "              document.continuacion.idequipo[document.continuacion.idequipo.length] = new Option(conceptos[cont].value,idconceptos[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function validar(){";
    echo "  if (document.continuacion.idciuorigen.value == '')";
    echo "      alert('Seleccione la Ciudad de Origen');";
    echo "  else if (document.continuacion.idciudestino.value == '')";
    echo "      alert('Seleccione la Ciudad de Destino');";
    echo "  else if (document.continuacion.tarifa_ofr.value == '')";
    echo "      alert('Error en valor del Flete');";
    echo "  else if (document.continuacion.tarifa_min.value == '')";
    echo "      alert('Error en valor mínimo del Flete');";
    echo "  else if (document.continuacion.frecuencia.value == '')";
    echo "      alert('Ingresó un valor no válido para el campo Frecuencia');";
    echo "  else if (document.continuacion.tiempotransito.value == '')";
    echo "      alert('Ingresó un valor no válido para el campo Tiempo');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='continuacion' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=5>Datos de la Continuación de Viaje</TH>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Puerto Origen :</B><BR><SELECT NAME='idciuorigen' SIZE=7>";
    $pt->MoveFirst();
    while (!$pt->Eof()) {
        if ($pt->Value('ca_puerto') == 'Marítimo' or $pt->Value('ca_puerto') == 'Ambos') {
            echo " <OPTION VALUE=" . $pt->Value('ca_idciudad') . ">" . $pt->Value('ca_ciudad');
        }
        $pt->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Ciudad Destino :</B><BR><SELECT NAME='idciudestino' SIZE=7>";
    $pt->MoveFirst();
    while (!$pt->Eof()) {
        if ($pt->Value('ca_puerto') != 'Marítimo') {
            echo " <OPTION VALUE=" . $pt->Value('ca_idciudad') . ">" . $pt->Value('ca_ciudad');
        }
        $pt->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Concepto :</B><BR><SELECT NAME='idconcepto' SIZE=7>";
    $rs->MoveFirst();
    while (!$rs->Eof()) {
        if ($rs->Value('ca_transporte') == 'Terrestre') {
            echo " <OPTION VALUE=" . $rs->Value('ca_idconcepto') . ">" . $rs->Value('ca_concepto');
        }
        $rs->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Tipo :</B><BR><CENTER><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tiposs); $i++) {
        echo " <OPTION VALUE=" . $tiposs[$i] . ">" . $tiposs[$i];
    }
    echo "  </SELECT>";
    echo "  <BR /><BR /><BR /><B>Modalidad :</B><BR><CENTER><SELECT NAME='modalidad' ONCHANGE='llenar_equipos();'>";
    for ($i = 0; $i < count($modals); $i++) {
        echo " <OPTION VALUE=" . $modals[$i] . ">" . $modals[$i];
    }
    echo "  </SELECT></CENTER></TD>";

    echo "  <TD Class=listar><B>Equipo :</B><BR><SELECT NAME='idequipo' SIZE=7>";         // Llena el cuadro de lista con los valores de la tabla Destinos
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
    echo "  <TR>";
    echo "  <TD Class=invertir><B>Tarifa:</B><BR><INPUT TYPE='TEXT' NAME='tarifa_ofr' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='tarifa_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='tarifa_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "  <TD Class=invertir><B>Frecuencia:</B><BR><INPUT TYPE='TEXT' NAME='frecuencia' SIZE=19 MAXLENGTH=20></TD>";
    echo "  <TD Class=invertir><B>Tiempo/Transito:</B><BR><INPUT TYPE='TEXT' NAME='tiempotransito' SIZE=19 MAXLENGTH=25></TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "  <TD Class=invertir style='vertical-align:top;'><B>Observaciones:</B></TD>";
    echo "  <TD Class=invertir COLSPAN=4><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=80></TEXTAREA></TD>";
    echo "  </TR>";
    echo "  </TABLE></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=5></TD>";
    echo "</TR>";

    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>llenar_equipos();cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Seguro' and $id != 0) {
    $tipos = array("$", "%");
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    source = window.parent.document.getElementById('ftipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('fprma_$i');";
    echo "    target = document.getElementById('prima_vlr');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fsmin_$i');";
    echo "    target = document.getElementById('prima_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fobtc_$i');";
    echo "    target = document.getElementById('obtencion');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fmnda_$i');";
    echo "    elegir_item('idmoneda', source.value);";
    echo "    source = window.parent.document.getElementById('fobsv_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo " if (validar()){";
    echo "    source = document.getElementById('tipo');";
    echo "    target = window.parent.document.getElementById('ftipo_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('prima_vlr');";
    echo "    target = window.parent.document.getElementById('fprma_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('prima_min');";
    echo "    target = window.parent.document.getElementById('fsmin_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('obtencion');";
    echo "    target = window.parent.document.getElementById('fobtc_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idmoneda');";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('observaciones');";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = source.value;";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('ftipo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fprma_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fsmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobtc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fmnda_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobsv_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function validar(){";
    echo "  if (document.seguro.prima_vlr.value == '')";
    echo "      alert('Error en valor del Seguro');";
    echo "  else if (document.seguro.prima_min.value == '')";
    echo "      alert('Error en valor mínimo del Seguro');";
    echo "  else if (document.seguro.obtencion.value == '')";
    echo "      alert('Error en el valor de Obtención de la Póliza');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='seguro' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=5>Datos del Seguro</TH>";
    echo "<TR>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Tipo:</B><BR><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tipos); $i++) {
        echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=invertir><B>Vlr.Prima:</B><BR><INPUT TYPE='TEXT' NAME='prima_vlr' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='prima_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Obtención:</B><BR><INPUT TYPE='TEXT' NAME='obtencion' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='idmoneda'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir COLSPAN=5><B>Observaciones:</B><BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=5 COLS=80></TEXTAREA></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=5></TD>";
    echo "</TR>";

    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Aduana' and $id != 0) {
    $tipos = array("$", "%");
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idcosto, ca_costo from tb_costos where ca_impoexpo = 'Aduanas' order by ca_costo")) {       // Selecciona todos lo registros de la tabla Costos de Aduana
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    source = window.parent.document.getElementById('atipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('aidco_$i');";
    echo "    elegir_item('idcosto', source.value);";
    echo "    source = window.parent.document.getElementById('avlrn_$i');";
    echo "    target = document.getElementById('netcosto');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('avlrc_$i');";
    echo "    target = document.getElementById('vlrcosto');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('avlrm_$i');";
    echo "    target = document.getElementById('mincosto');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('amnda_$i');";
    echo "    elegir_item('idmoneda', source.value);";
    echo "    source = window.parent.document.getElementById('aobsv_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo " if (validar(\"vlrcosto,mincosto,addrcosto\")){";
    echo "    target = window.parent.document.getElementById('adelt_$i');";
    echo "    target.value = 0;";
    echo "    source = document.getElementById('tipo');";
    echo "    target = window.parent.document.getElementById('atipo_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idcosto');";
    echo "    target = window.parent.document.getElementById('aidco_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('acsto_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('netcosto');";
    echo "    target = window.parent.document.getElementById('avlrn_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('vlrcosto');";
    echo "    target = window.parent.document.getElementById('avlrc_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('mincosto');";
    echo "    target = window.parent.document.getElementById('avlrm_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idmoneda');";
    echo "    target = window.parent.document.getElementById('amnda_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('observaciones');";
    echo "    target = window.parent.document.getElementById('aobsv_$i');";
    echo "    target.value = source.value;";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    source = window.parent.document.getElementById('aoids_$i');";
    echo "    target = window.parent.document.getElementById('adelt_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('atipo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('acsto_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('aidco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('avlrn_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('avlrc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('avlrm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('amnda_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('aobsv_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function validar(){";
    echo "  if (document.aduana.netcosto.value == '')";
    echo "      alert('Error en el valor Neto');";
    echo "  else if (document.aduana.vlrcosto.value == '')";
    echo "      alert('Error en valor del Concepto');";
    echo "  else if (document.aduana.mincosto.value == '')";
    echo "      alert('Error en valor mínimo del Concepto');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='aduana' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TH Class=titulo COLSPAN=6>Costos de Nacionalización</TH>";
    echo "<TR>";
    echo "  <TD Class=invertir style='text-align:left; vertical-align:top;'><B>Tipo:</B><BR><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tipos); $i++) {
        echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=invertir style='text-align:left; vertical-align:top;'>Concepto:<BR><SELECT NAME='idcosto'>";
    while (!$tm->Eof()) {
        echo"<OPTION VALUE=\"" . $tm->Value('ca_idcosto') . "\">" . $tm->Value('ca_costo') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=invertir><B>Neto:</B><BR><INPUT TYPE='TEXT' NAME='netcosto' VALUE=0 ONBLUR='valores(this);' SIZE=10 MAXLENGTH=12></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Vlr.Concepto:</B><BR><INPUT TYPE='TEXT' NAME='vlrcosto' VALUE=0 ONBLUR='valores(this);' SIZE=10 MAXLENGTH=12></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='mincosto' VALUE=0 ONBLUR='valores(this);' SIZE=10 MAXLENGTH=12></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='idmoneda'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'COP') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir COLSPAN=6><B>Observaciones:</B><BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=4 COLS=100></TEXTAREA></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=6></TD>";
    echo "</TR>";

    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Recargos' and $id != 0) {
    set_time_limit(600);
    $tipos = array("$", "%");
    $aplic = array("Aéreo" => array("", "x Kg ó 6 Dm³", "x Lb ó 166 Pul³", "x HAWB", "Sobre Flete", "Sobre Flete + Recargos"), "Marítimo" => array("", "x T/M³", "x Contenedor", "x HBL", "x Pieza", "Sobre Flete", "Sobre Flete + Recargos"));
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idrecargo, ca_recargo, r.ca_transporte from tb_tiporecargo r, vi_cotproductos p where r.ca_tipo like '%Recargo en Origen%' and r.ca_transporte = p.ca_transporte and r.ca_tipo = '$tp' and ca_idproducto = '$pr' order by ca_recargo")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    $tra_mem = $tm->Value('ca_transporte');
    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "j = 0;";
    echo "window.parent.document.body.style.visibility = \"hidden\";";
    echo "while (isNaN(window.parent.document.getElementById('fidrc[$i]_'+j))) {";
    echo "    (document.getElementById('rec_A_'+j)).style.display = 'block';";
    echo "    (document.getElementById('rec_B_'+j)).style.display = 'block';";
    echo "    (document.getElementById('rec_C_'+j)).style.display = 'block';";
    echo "    (document.getElementById('borrar_'+j)).style.display = 'block';";
    echo "    source = window.parent.document.getElementById('fidrc[$i]_'+j);";
    echo "    elegir_item('idrecargo_'+j, source.value);";
    echo "    source = window.parent.document.getElementById('frvlr[$i]_'+j);";
    echo "    target = document.getElementById('recargo_'+j);";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('ftipo[$i]_'+j);";
    echo "    elegir_item('tipo_'+j, source.value);";
    echo "    source = window.parent.document.getElementById('frapA[$i]_'+j);";
    echo "    elegir_item('apliA_'+j, source.value);";
    echo "    source = window.parent.document.getElementById('frmin[$i]_'+j);";
    echo "    target = document.getElementById('minimo_'+j);";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('frmnd[$i]_'+j);";
    echo "    elegir_item('idmoneda_'+j, source.value);";
    echo "    source = window.parent.document.getElementById('frapB[$i]_'+j);";
    echo "    elegir_item('apliB_'+j, source.value);";
    echo "    source = window.parent.document.getElementById('frdts[$i]_'+j);";
    echo "    target = document.getElementById('detalles_'+j);";
    echo "    target.value = source.value;";
    echo "    j++;";
    echo "  }";
    echo "}";
    echo "function registro() {";
    echo "j = 0;";
    echo "while (isNaN(document.getElementById('idrecargo_'+j))) {";
    echo "  if (document.getElementById('borrar_'+j).checked == true){";
    echo "    target = window.parent.document.getElementById('fdltr[$i]_'+j);";
    echo "    target.value = window.parent.document.getElementById('foidr[$i]_'+j).value;";
    echo "    target = window.parent.document.getElementById('fidrc[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frcgo[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frvlr[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frapA[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ftipo[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frmin[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frmnd[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frapB[$i]_'+j);";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frdts[$i]_'+j);";
    echo "    target.value = '';";
    echo "  }else if (document.getElementById('idrecargo_'+j).value != '' && validar(\"recargo_\"+j+\",minimo_\"+j)){";
    echo "    target = window.parent.document.getElementById('rec[$i]_'+j);";
    echo "    target.style.display = 'block';";
    echo "    target = window.parent.document.getElementById('fdltr[$i]_'+j);";
    echo "    target.value = '';";
    echo "    source = document.getElementById('idrecargo_'+j);";
    echo "    target = window.parent.document.getElementById('fidrc[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('frcgo[$i]_'+j);";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('recargo_'+j);";
    echo "    target = window.parent.document.getElementById('frvlr[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('apliA_'+j);";
    echo "    target = window.parent.document.getElementById('frapA[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tipo_'+j);";
    echo "    target = window.parent.document.getElementById('ftipo[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('minimo_'+j);";
    echo "    target = window.parent.document.getElementById('frmin[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idmoneda_'+j);";
    echo "    target = window.parent.document.getElementById('frmnd[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('apliB_'+j);";
    echo "    target = window.parent.document.getElementById('frapB[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('detalles_'+j);";
    echo "    target = window.parent.document.getElementById('frdts[$i]_'+j);";
    echo "    target.value = source.value;";
    echo "    }";
    echo "  j++;";
    echo "  }";
    echo "  window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='opciones' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<INPUT TYPE='HIDDEN' NAME='pr' VALUE=" . $pr . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";
    echo "<TR>";
    echo "<TH Class=titulo COLSPAN=8>Recargos por Tarifa</TH>";
    echo "</TR>";

    for ($x = 0; $x < 25; $x++) {
        echo "<TR ID='rec_A_$x' style='display: none'>";
        echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Recargo:</b><br /><SELECT NAME='idrecargo_$x'>";
        $tm->MoveFirst();
        echo "     <OPTION VALUE=\"\"></OPTION>";
        while (!$tm->Eof()) {
            echo " <OPTION VALUE=\"" . $tm->Value('ca_idrecargo') . "\">" . $tm->Value('ca_recargo') . "</OPTION>";
            $tm->MoveNext();
        }
        echo "  </SELECT></TD>";
        echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Tipo:</b><br /><SELECT NAME='tipo_$x'>";
        for ($i = 0; $i < count($tipos); $i++) {
            echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
        }
        echo "  </SELECT></TD>";
        echo "  <TD Class=listar><b>Mnd:</b><br /><SELECT NAME='idmoneda_$x'>";
        $mn->MoveFirst();
        while (!$mn->Eof()) {
            echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
            $mn->MoveNext();
        }
        echo "   </SELECT></TD>";
        echo "  <TD Class=listar><b>Valor:</b><br /><INPUT TYPE='TEXT' NAME='recargo_$x' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de recargos
        echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Aplicación:</b><br /><SELECT NAME='apliA_$x'>";
        reset($aplic[$tra_mem]);
        while (list ($clave, $val) = each($aplic[$tra_mem])) {
            echo " <OPTION VALUE='$val'>" . $val;
        }
        echo "  </SELECT></TD>";
        echo "  <TD Class=listar style='text-align:center;' WIDTH=5 ROWSPAN=2><b>Borrar</b><INPUT ID='borrar_$x' style='display: none' TYPE=CHECKBOX></TD>";
        echo "</TR>";
        echo "<TR ID='rec_B_$x' style='display: none'>";
        echo "  <TD Class=listar COLSPAN=3><b>Detalles:</b><br /><INPUT TYPE='TEXT' NAME='detalles_$x' SIZE=60 MAXLENGTH=150></TD>";  // Campos para captura de recargos
        echo "  <TD Class=listar><b>Vlr.Mínimo:</b><br /><INPUT TYPE='TEXT' NAME='minimo_$x' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de recargos
        echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Por:</b><br /><SELECT NAME='apliB_$x'>";
        reset($aplic[$tra_mem]);
        while (list ($clave, $val) = each($aplic[$tra_mem])) {
            echo " <OPTION VALUE='$val'>" . $val;
        }
        echo "  </SELECT></TD>";
        echo "</TR>";
        echo "<TR ID='rec_C_$x' style='display: none' HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=8></TD>";
        echo "</TR>";
    }
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'actualiza_facuras' and $oid != '' and $newfact != '') {
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("update tb_inocostos_sea set ca_factura = '$newfact' where oid = '$oid'")) {
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'inosea.php';</script>";
        exit;
    }
    echo "<script>window.parent.document.location.href = 'inosea.php?boton=Consultar&id=$referencia';</script>";
    // window.parent.document.body.
} else if (isset($opcion) and $opcion == 'RecargosLoc' and $id != 0) {
    $tipos = array("$", "%");
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select DISTINCT ca_idrecargo, ca_recargo, r.ca_transporte from tb_tiporecargo r, vi_cotproductos p where r.ca_tipo like '%Recargo Local%' and p.ca_idcotizacion = $id and r.ca_transporte = p.ca_transporte and r.ca_incoterms != '' and fun_texttokencompare(r.ca_incoterms ,p.ca_incoterms, '|') order by ca_transporte, ca_recargo")) {       // Selecciona todos lo registros de la tabla tb_tiporecargo
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'cotizaciones.php';</script>";
        exit;
    }
    $tra_mem = $tm->Value('ca_transporte');
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idrecargos' VALUE=" . $tm->Value('ca_idrecargo') . ">";
        echo "<INPUT TYPE='HIDDEN' NAME='recargos' VALUE='" . $tm->Value('ca_recargo') . "'>";
        echo "<INPUT TYPE='HIDDEN' NAME='transportes' VALUE='" . $tm->Value('ca_transporte') . "'>";
        $tm->MoveNext();
    }

    $mn = & DlRecordset::NewRecordset($conn);
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "    source = window.parent.document.getElementById('ftrns_$i');";
    echo "    elegir_item('idtransportes', source.value);";
    echo "    llenar_aplicaciones();";
    echo "    source = window.parent.document.getElementById('frmdl_$i');";
    echo "    elegir_item('modalidad', source.value);";
    echo "    source = window.parent.document.getElementById('fidrc_$i');";
    echo "    elegir_item('idrecargo', source.value);";
    echo "    source = window.parent.document.getElementById('frvlr_$i');";
    echo "    target = document.getElementById('recargo');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('ftipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('frapA_$i');";
    echo "    elegir_item('apliA', source.value);";
    echo "    source = window.parent.document.getElementById('frmin_$i');";
    echo "    target = document.getElementById('minimo');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('frmnd_$i');";
    echo "    elegir_item('idmoneda', source.value);";
    echo "    source = window.parent.document.getElementById('frapB_$i');";
    echo "    elegir_item('apliB', source.value);";
    echo "    source = window.parent.document.getElementById('frdts_$i');";
    echo "    target = document.getElementById('detalles');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo "  if (document.getElementById('idrecargo').value != '' && validar(\"recargo\",\"minimo\")){";
    echo "    source = document.getElementById('idtransportes');";
    echo "    target = window.parent.document.getElementById('ftrns_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('modalidad');";
    echo "    target = window.parent.document.getElementById('frmdl_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idrecargo');";
    echo "    target = window.parent.document.getElementById('fidrc_$i');";
    echo "    target.value = source.value;";
    echo "    target = window.parent.document.getElementById('frcgo_$i');";
    echo "    target.value = source.options[source.selectedIndex].text;";
    echo "    source = document.getElementById('recargo');";
    echo "    target = window.parent.document.getElementById('frvlr_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('apliA');";
    echo "    target = window.parent.document.getElementById('frapA_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('tipo');";
    echo "    target = window.parent.document.getElementById('ftipo_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('minimo');";
    echo "    target = window.parent.document.getElementById('frmin_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('idmoneda');";
    echo "    target = window.parent.document.getElementById('frmnd_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('apliB');";
    echo "    target = window.parent.document.getElementById('frapB_$i');";
    echo "    target.value = source.value;";
    echo "    source = document.getElementById('detalles');";
    echo "    target = window.parent.document.getElementById('frdts_$i');";
    echo "    target.value = source.value;";
    echo "  }";
    echo "  window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function eliminar() {";
    echo "  target = window.parent.document.getElementById('ftrns_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frmdl_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('fidrc_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frcgo_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frvlr_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frapA_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('ftipo_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frmin_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frmnd_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frapB_$i');";
    echo "  target.value = '';";
    echo "  target = window.parent.document.getElementById('frdts_$i');";
    echo "  target.value = '';";
    echo "  window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function llenar_aplicaciones(){";
    echo "	document.opciones.modalidad.length=0;";
    echo "	document.opciones.modalidad.options[document.opciones.idrecargo.length] = new Option();";
    echo "	document.opciones.modalidad.length=0;";
    echo "	document.opciones.idrecargo.length=0;";
    echo "	document.opciones.idrecargo.options[document.opciones.idrecargo.length] = new Option();";
    echo "	document.opciones.idrecargo.length=0;";
    echo "	document.opciones.apliA.length=0;";
    echo "	document.opciones.apliA.options[document.opciones.apliA.length] = new Option();";
    echo "	document.opciones.apliA.length=0;";
    echo "	document.opciones.apliB.length=0;";
    echo "	document.opciones.apliB.options[document.opciones.apliB.length] = new Option();";
    echo "	document.opciones.apliB.length=0;";
    echo "  if (document.opciones.idtransportes.value == 'Aéreo'){";
    echo "		document.opciones.modalidad[document.opciones.modalidad.length] = new Option('CONSOLIDADO','CONSOLIDADO',false,false);";
    echo "		document.opciones.modalidad[document.opciones.modalidad.length] = new Option('DIRECTO','DIRECTO',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('','',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x Kg ó 6 Dm³','x Kg ó 6 Dm³',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x Lb ó 166 Pul³','x Lb ó 166 Pul³',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x HAWB','x HAWB',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x Pieza','x Pieza',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('Sobre Flete','Sobre Flete',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('Sobre Flete + Recargos','Sobre Flete + Recargos',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('','',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x Kg ó 6 Dm³','x Kg ó 6 Dm³',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x Lb ó 166 Pul³','x Lb ó 166 Pul³',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x HAWB','x HAWB',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x Pieza','x Pieza',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('Sobre Flete','Sobre Flete',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('Sobre Flete + Recargos','Sobre Flete + Recargos',false,false);";
    echo "	}else if (document.opciones.idtransportes.value == 'Marítimo'){";
    echo "		document.opciones.modalidad[document.opciones.modalidad.length] = new Option('FCL','FCL',false,false);";
    echo "		document.opciones.modalidad[document.opciones.modalidad.length] = new Option('LCL','LCL',false,false);";
    echo "		document.opciones.modalidad[document.opciones.modalidad.length] = new Option('COLOADING','COLOADING',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('','',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x T/M³','x T/M³',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x Contenedor','x Contenedor',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x HBL','x HBL',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('x Pieza','x Pieza',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('Sobre Flete','Sobre Flete',false,false);";
    echo "		document.opciones.apliA[document.opciones.apliA.length] = new Option('Sobre Flete + Recargos','Sobre Flete + Recargos',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('','',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x T/M³','x T/M³',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x Contenedor','x Contenedor',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x HBL','x HBL',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('x Pieza','x Pieza',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('Sobre Flete','Sobre Flete',false,false);";
    echo "		document.opciones.apliB[document.opciones.apliB.length] = new Option('Sobre Flete + Recargos','Sobre Flete + Recargos',false,false);";
    echo "	}";
    echo "  if (isNaN(idrecargos.length)){";
    echo "      if (document.opciones.idtransportes.value == transportes.value){";
    echo "          document.opciones.idrecargo[document.opciones.idrecargo.length] = new Option(recargos.value,idrecargos.value,false,false);";
    echo "          }";
    echo "     }";
    echo "  else {";
    echo "     for (cont=0; cont<idrecargos.length; cont++) {";
    echo "          if (document.opciones.idtransportes.value == transportes[cont].value){";
    echo "              document.opciones.idrecargo[document.opciones.idrecargo.length] = new Option(recargos[cont].value,idrecargos[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "     }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='opciones' ACTION='ventanas.php' ONSUBMIT='return validar();'>"; // Crea una forma con datos vacios
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";              // Hereda el Id del registro que se esta modificando
    echo "<TABLE WIDTH=%100 CELLSPACING=1>";

    echo "<TR>";
    echo "	<TH Class=titulo COLSPAN=2>RECARGOS LOCALES</TH>";
    echo "	<TH Class=titulo COLSPAN=2>Transporte:<br /><SELECT NAME='idtransportes' ONCHANGE='llenar_aplicaciones();'>";
    echo "		<OPTION VALUE=\"Aéreo\">Aéreo</OPTION>";
    echo "		<OPTION VALUE=\"Marítimo\">Marítimo</OPTION>";
    echo "	</SELECT></TH>";
    echo "	<TH Class=titulo>Modalidad:<br /><SELECT NAME='modalidad'>";
    echo "	</SELECT></TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Recargo:</b><br /><SELECT NAME='idrecargo'>";
    $tm->MoveFirst();
    echo "     <OPTION VALUE=\"\"></OPTION>";
    while (!$tm->Eof()) {
        echo " <OPTION VALUE=\"" . $tm->Value('ca_idrecargo') . "\">" . $tm->Value('ca_recargo') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Tipo:</b><br /><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tipos); $i++) {
        echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><b>Mnd:</b><br /><SELECT NAME='idmoneda'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "  <TD Class=listar><b>Valor:</b><br /><INPUT TYPE='TEXT' NAME='recargo' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de recargos
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Aplicación:</b><br /><SELECT NAME='apliA'>";
    reset($aplic[$tra_mem]);
    while (list ($clave, $val) = each($aplic[$tra_mem])) {
        echo " <OPTION VALUE='$val'>" . $val;
    }
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3><b>Detalles:</b><br /><INPUT TYPE='TEXT' NAME='detalles' SIZE=60 MAXLENGTH=150></TD>";  // Campos para captura de recargos
    echo "  <TD Class=listar><b>Vlr.Mínimo:</b><br /><INPUT TYPE='TEXT' NAME='minimo' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de recargos
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><b>Por:</b><br /><SELECT NAME='apliB'>";
    reset($aplic[$tra_mem]);
    while (list ($clave, $val) = each($aplic[$tra_mem])) {
        echo " <OPTION VALUE='$val'>" . $val;
    }
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=8></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Tarifario' and $id != 0 and $pr != 0) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    window.parent.document.body.style.visibility = \"hidden\";";
    echo "}";
    echo "function habilitar(trayecto) {";
    echo "  cadena= trayecto.getAttribute('ID');";
    echo "  if (cadena.indexOf('_') != -1) {";
    echo "  	i = cadena.substring(cadena.indexOf('_')+1);";
    echo "		cadena = cadena.substring(0,cadena.indexOf('_'));";
    echo "		j = 0;";
    echo "  	while (isNaN(document.getElementById(cadena+'['+i+']_'+j))) {";
    echo "  		elemento = document.getElementById(cadena+'['+i+']_'+j);";
    echo "  		elemento.checked = trayecto.checked;";
    echo "			j++;";
    echo "		}";
    echo "  	elemento = document.getElementById(cadena+'['+i+']');";
    echo "  	elemento.checked = trayecto.checked;";
    echo "  }else if (cadena.indexOf('[') != -1) {";
    echo "		j = 0;";
    echo "  	while (isNaN(document.getElementById(cadena+'_'+j))) {";
    echo "  		elemento = document.getElementById(cadena+'_'+j);";
    echo "  		elemento.checked = trayecto.checked;";
    echo "			j++;";
    echo "		}";
    echo "	}else {";
    echo "  	i = 0;";
    echo "  	while (isNaN(document.getElementById(cadena+'_'+i))) {";
    echo "  		elemento = document.getElementById(cadena+'_'+i);";
    echo "  		elemento.checked = trayecto.checked;";
    echo "			j = 0;";
    echo "  		while (isNaN(document.getElementById(cadena+'['+i+']_'+j))) {";
    echo "  			elemento = document.getElementById(cadena+'['+i+']_'+j);";
    echo "  			elemento.checked = trayecto.checked;";
    echo "				j++;";
    echo "			}";
    echo "  		elemento = document.getElementById(cadena+'['+i+']');";
    echo "  		elemento.checked = trayecto.checked;";
    echo "			i++;";
    echo "		}";
    echo "	}";
    echo "}";
    echo "function registro() {";
    echo "  x = 0;";
    echo "  i = 0;";
    echo "  while (isNaN(document.getElementById('fchkb_'+i))) {";
    echo "     if (document.getElementById('fchkb_'+i).checked){";
    echo "			source = document.getElementById('fidcn_'+i);";
    echo "			target = window.parent.document.getElementById('fidcn_'+x);";
    echo "			target.value = source.value;";
    echo "			source = document.getElementById('fcnpt_'+i);";
    echo "			target = window.parent.document.getElementById('fcnpt_'+x);";
    echo "			target.value = source.value;";
    echo "			source = document.getElementById('fflte_'+i);";
    echo "			target = window.parent.document.getElementById('fflte_'+x);";
    echo "			target.value = source.value;";
    echo "			source = document.getElementById('ffmin_'+i);";
    echo "			target = window.parent.document.getElementById('ffmin_'+x);";
    echo "			target.value = source.value;";
    echo "			source = document.getElementById('fmnda_'+i);";
    echo "			target = window.parent.document.getElementById('fmnda_'+x);";
    echo "			target.value = source.value;";
    echo "			source = document.getElementById('fdets_'+i);";
    echo "			target = window.parent.document.getElementById('fdets_'+x);";
    echo "			target.value = source.value;";
    echo "			y = 0;";
    echo "			j = 0;";
    echo "  		while (isNaN(document.getElementById('fchkb['+i+']_'+j))) {";
    echo "     			if (document.getElementById('fchkb['+i+']_'+j).checked){";
    echo "					target = window.parent.document.getElementById('rec['+x+']_'+y);";
    echo "					target.style.display = 'block';";
    echo "					source = document.getElementById('fidrc['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('fidrc['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('frcgo['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('frcgo['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('ftipo['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('ftipo['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('frvlr['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('frvlr['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('frmin['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('frmin['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('frmnd['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('frmnd['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "					source = document.getElementById('frdts['+i+']_'+j);";
    echo "					target = window.parent.document.getElementById('frdts['+x+']_'+y);";
    echo "					target.value = source.value;";
    echo "     				y++;";
    echo "     			}";
    echo "     			j++;";
    echo "     		}";
    echo "     		x++;";
    echo "     }";
    echo "     i++;";
    echo "  }";
    echo "  window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "  window.parent.document.body.style.visibility = \"visible\";";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    if (isset($id) and isset($pr)) {                                                              // Switch que evalua cual botòn de comando fue pulsado por el usuario
        $cadena = "select ca_idtrayecto, ca_oid_f, ca_idconcepto, ca_concepto, ca_vlrminimo, ca_fleteminimo, ca_idmoneda_f, ca_observaciones_f, ca_idrecargo, ca_recargo, ca_vlrfijo, ca_porcentaje, ca_recargominimo, ca_idmoneda_r, ca_observaciones_r, ca_frecuencia, ca_tiempotransito, ca_nombre from vi_tarifario where ca_idtrayecto in ";
        $cadena.= "( select ca_idtrayecto from tb_trayectos ty LEFT OUTER JOIN";
        $cadena.= "		tb_cotproductos cp";
        $cadena.= "		ON (ty.ca_impoexpo = cp.ca_impoexpo and ty.ca_transporte = cp.ca_transporte and ty.ca_modalidad = cp.ca_modalidad and ty.ca_origen = cp.ca_origen and ty.ca_destino = cp.ca_destino)";
        $cadena.= "		where ca_idcotizacion = $id and ca_idproducto = '$pr' )";
        if (!$rs->Open("$cadena")) {    // Mueve el apuntador al registro que se desea modificar
            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
            exit;
        }
        $impr_tit = true;
        $impr_lin = '';
        $i = 0;
        while (!$rs->Eof() and !$rs->IsEmpty()) {
            if ($rs->Value('ca_nombre') != $impr_lin) {
                echo "<TR>";
                echo "  <TD Class=destacar COLSPAN=10><B>" . $rs->Value('ca_nombre') . "</B></TD>";
                echo "</TR>";
                $impr_lin = $rs->Value('ca_nombre');
            }
            echo "<TR>";
            echo "  <TD Class=invertir COLSPAN=6><TABLE WIDTH=300 CELLSPACING=1>";
            if ($impr_tit) {
                echo "<TR>";
                echo "  <TH WIDTH=5><INPUT ID='" . $rs->Value('ca_idtrayecto') . "' TYPE=CHECKBOX NAME='tchkb_$i' ONCLICK='habilitar(this);'></TH>";
                echo "  <TH WIDTH=100>Concepto</TH>";
                echo "  <TH WIDTH=50>Flete</TH>";
                echo "  <TH WIDTH=50>Mín.</TH>";
                echo "  <TH WIDTH=25>Mnd</TH>";
                echo "  <TH WIDTH=5><IMG src='graficos/admira.gif' alt='Detalles'></TH>";
                echo "</TR>";
            }
            echo "    <TR>";
            echo "      <INPUT TYPE='HIDDEN' NAME='fidcn_$i' VALUE=" . $rs->Value('ca_idconcepto') . ">";
            echo "      <INPUT TYPE='HIDDEN' NAME='fdets_$i' VALUE=" . $rs->Value('ca_observaciones_f') . ">";
            echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'><INPUT ID='" . $rs->Value('ca_idtrayecto') . "_$i' TYPE=CHECKBOX NAME='fchkb_$i' ONCLICK='habilitar(this);'>";
            echo "      <TD Class=mostrar WIDTH=100 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='fcnpt_$i' VALUE=\"" . $rs->Value('ca_concepto') . "\" READONLY></TD>";
            echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='fflte_$i' VALUE='" . formatNumber($rs->Value('ca_vlrminimo'), 3, ".", "") . "' READONLY></TD>";
            echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='ffmin_$i' VALUE='" . formatNumber($rs->Value('ca_fleteminimo'), 3, ".", "") . "' READONLY></TD>";
            echo "      <TD Class=mostrar WIDTH=25 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='fmnda_$i' VALUE='" . $rs->Value('ca_idmoneda_f') . "' READONLY></TD>";
            echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'>" . ((strlen($rs->Value('ca_observaciones_f')) != 0) ? "<IMG src='graficos/admira.gif' alt='" . $rs->Value('ca_observaciones_f') . "'>" : "") . "</TD>";
            echo "    </TR>";
            echo "    <TR>";
            echo "      <TD Class=mostrar COLSPAN=6 style='vertical-align=top; text-align: right'>Incluir todos los recargos de esta tarifa: <INPUT ID='" . $rs->Value('ca_idtrayecto') . "[$i]' TYPE=CHECKBOX NAME='rchkb_$i' ONCLICK='habilitar(this);'></TD>";
            echo "    </TR>";

            echo "  </TABLE></TD>";
            echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=300 CELLSPACING=0>";
            if ($impr_tit) {
                echo "<TR>";
                echo "  <TH WIDTH=5></TH>";
                echo "  <TH WIDTH=110>Recargo</TH>";
                echo "  <TH WIDTH=5>Tipo</TH>";
                echo "  <TH WIDTH=50>Valor</TH>";
                echo "  <TH WIDTH=50>Mínimo</TH>";
                echo "  <TH WIDTH=25>Mnd</TH>";
                echo "  <TH WIDTH=5><IMG src='graficos/admira.gif' alt='Detalles'></TH>";
                echo "</TR>";
                $impr_tit = false;
            }
            $oid_mem = $rs->Value('ca_oid_f');
            $j = 0;
            while ($oid_mem == $rs->Value('ca_oid_f') and !$rs->Eof()) {
                $tipo_mem = (($rs->Value('ca_vlrfijo') != 0) ? "$" : "%");
                $valr_mem = $rs->Value('ca_vlrfijo') + $rs->Value('ca_porcentaje');
                echo "    <TR>";
                echo "      <INPUT TYPE='HIDDEN' NAME='fidrc[$i]_$j' VALUE=" . $rs->Value('ca_idrecargo') . ">";
                echo "      <INPUT TYPE='HIDDEN' NAME='frdts[$i]_$j' VALUE=" . $rs->Value('ca_observaciones_f') . ">";
                echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'><INPUT ID='" . $rs->Value('ca_idtrayecto') . "[$i]_$j' TYPE=CHECKBOX NAME='fchkb[$i]_$j'>";
                echo "      <TD Class=mostrar WIDTH=110 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='frcgo[$i]_$j' VALUE='" . $rs->Value('ca_recargo') . "' READONLY></TD>";
                echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='ftipo[$i]_$j' VALUE='$tipo_mem' READONLY></TD>";
                echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='frvlr[$i]_$j' VALUE='" . formatNumber($valr_mem, 3, ".", "") . "' READONLY></TD>";
                echo "      <TD Class=mostrar WIDTH=50 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='frmin[$i]_$j' VALUE='" . formatNumber($rs->Value('ca_recargominimo'), 3, ".", "") . "' READONLY></TD>";
                echo "      <TD Class=mostrar WIDTH=25 style='vertical-align=top; text-align: left'><INPUT Class=field TYPE='TEXT' NAME='frmnd[$i]_$j' VALUE='" . $rs->Value('ca_idmoneda_r') . "' READONLY></TD>";
                echo "      <TD Class=mostrar WIDTH=5 style='vertical-align=top; text-align: left'>" . ((strlen($rs->Value('ca_observaciones_r')) != 0) ? "<IMG src='graficos/admira.gif' alt='" . $rs->Value('ca_observaciones_r') . "'>" : "") . "</TD>";
                echo "    </TR>";
                $rs->MoveNext();
                $j++;
            }
            $i++;
            echo "  </TABLE></TD>";
            echo "</TR>";
        }
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=10></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Novedad' and isset($accion)) {
    $formulario = false;
    switch (trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Nuevo': {                                                        // El Botón Nuevo Registro fue pulsado
                $formulario = true;
                if (!$rs->Open("select * from tb_colnovedades where false")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                break;
            }
        case 'Modifica': {                                                      // El Botón Modifica Registro fue pulsado
                $formulario = true;
                if (!$rs->Open("select * from tb_colnovedades where ca_idnovedad = $id")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                break;
            }
        case 'Elimina': {                                                      // El Botón Elimina Registro fue pulsado
                if (!$rs->Open("delete from tb_colnovedades where ca_idnovedad = $id")) {
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                break;
            }
        case 'Registrar': {                                                      // El Botón Registrar fue pulsado
                $adjunto = false;
                $uploadfile = /* $uploaddir. */ basename($_FILES['attachment']['name']);
                if (strlen($uploadfile) != 0) {
                    $file = str_replace('%20', ' ', $attachment);
                    $file_real = $attachment;
                    if (file_exists($file_real)) {
                        $extension = strtolower(substr(strrchr($uploadfile, "."), 1));
                        $header_file = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1) : $file;
                        $stream = fopen($file_real, 'rb');
                        $content = fread($stream, filesize($file_real));
                        $content_escaped = pg_escape_bytea($content);
                        fclose($stream);
                        $adjunto = true;
                    } else {
                        echo "<script>alert(\"No ha sido posible cargar el archivo\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                    }
                }

                if ($id == 'null') {
                    if (!$rs->Open("select nextval('tb_colnovedades_id')")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'traficos_sea.php';</script>";
                        exit;
                    }
                    $id = $rs->Value('nextval');
                    if (!$rs->Open("insert into tb_colnovedades (ca_idnovedad, ca_asunto, ca_detalle, ca_fcharchivar, ca_fchpublicacion, ca_fchpublicado, ca_usupublicado) values ('$id', '$asunto', '$detalle', '$fcharchivar', '$fchpublicacion', to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit;
                    }
                } else {
                    if (!$rs->Open("update tb_colnovedades set ca_asunto = '$asunto', ca_detalle = '$detalle', ca_fcharchivar = '$fcharchivar', ca_fchpublicacion = '$fchpublicacion', ca_fchpublicado = to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), ca_usupublicado = '$usuario' where ca_idnovedad = $id")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit;
                    }
                }

                if ($adjunto) {
                    if (!$rs->Open("update tb_colnovedades set ca_extension = '$extension', ca_header_file = '$uploadfile', ca_filesize = '" . filesize($file_real) . "', ca_content = '$content_escaped' where ca_idnovedad = $id")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit;
                    }
                }
                break;
            }
    }
    if ($formulario) {
        echo "<HTML>";
        echo "<HEAD>";
        echo "<TITLE>$titulo</TITLE>";
        echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
        echo "function validar(){";
        echo "  if (document.novedades.fchpublicacion.value == '')";
        echo "      alert('Debe registrar la fecha de publicación');";
        echo "  else if (document.novedades.fcharchivar.value == '')";
        echo "      alert('Debe registrar la fecha para archivar la novedad');";
        echo "  else if (document.novedades.asunto.value == '')";
        echo "      alert('El campo Asunto no es válido');";
        echo "  else if (document.novedades.detalle.value == '')";
        echo "      alert('El campo Detalle no es válido');";
        echo "  else";
        echo "      return (true);";
        echo "  return (false);";
        echo "}";
        echo "</script>";
        echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
        echo "</HEAD>";
        echo "<BODY ON>";
        echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador

        echo "<BR>";
        echo "<CENTER>";
        echo "<FORM METHOD=post NAME='novedades' ACTION='ventanas.php' ONSUBMIT='return validar();' enctype='multipart/form-data'>";           // Hace una llamado nuevamente a este script pero con
        echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
        echo "<INPUT TYPE='HIDDEN' NAME='opcion' VALUE='Novedad'>";
        echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='$id'>";
        echo "<TR>";
        echo "  <TH COLSPAN=4>PUBLICACIÓN DE NOVEDADES - SISTEMA COLSYS</TH>";
        echo "</TR>";
        echo "<TR>";
        echo "  <TD Class=captura>Publicación:</TD>";
        echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchpublicacion' SIZE=12 VALUE='" . ((strlen($rs->Value('ca_fchpublicacion')) != 0) ? $rs->Value('ca_fchpublicacion') : date("Y-m-d")) . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
        echo "  <TD Class=captura>Archivar:</TD>";
        echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fcharchivar' SIZE=12 VALUE='" . ((strlen($rs->Value('ca_fcharchivar')) != 0) ? $rs->Value('ca_fcharchivar') : date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d"), date("Y")))) . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
        echo "</TR>";
        echo "<TR>";
        echo "  <TD Class=captura>Asunto:</TD>";
        echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='asunto' SIZE=50 VALUE='" . $rs->Value('ca_asunto') . "' MAXLENGTH=50></TD>";
        echo "</TR>";
        echo "<TR>";
        echo "  <TD Class=captura>Detalle:</TD>";
        echo "  <TD Class=mostrar COLSPAN=3><TEXTAREA NAME='detalle' WRAP=virtual ROWS=8 COLS=90>" . $rs->Value('ca_detalle') . "</TEXTAREA></TD>";
        echo "</TR>";
        echo "<TR>";
        echo "  <TD Class=captura>Adjuntar Archivo:</TD>";
        echo "  <TD Class=listar COLSPAN=3><INPUT TYPE='FILE' NAME='attachment' SIZE=70></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=titulo COLSPAN=4></TD>";
        echo "</TR>";
        echo "</TABLE>";

        echo "<TABLE CELLSPACING=10>";
        echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar'></TH>";         // Ordena almacenar los datos ingresados
        echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";'></TH>";  // Cancela la operación
        echo "</TABLE>";

        echo "</FORM>";
        echo "</CENTER>";
        echo "</BODY>";
        echo "</HTML>";
    } else {
        echo "<script>window.parent.frames.captura.style.visibility = \"hidden\";window.parent.document.body.style.visibility = \"visible\";</script>";
        echo "<script>parent.document.creacion.submit();</script>";
    }
} else if (isset($opcion) and $opcion == 'Tarifas' and $cn != 0) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function seleccion(oid, trayecto, moneda, tarifa) {";
    echo "  op = window.parent.frames.adicionar.op.value;";
    echo "  elemento = window.parent.frames.elegir_item('idmoneda_' + op, moneda);";
    echo "  elemento = window.parent.document.getElementById('oferta_' + op);";
    echo "  elemento.value = tarifa;";
    echo "  elemento = window.parent.document.getElementById('recargos_' + op);";
    echo "  fuente = document.getElementById('rec_' + oid);";
    echo "  elemento.value = fuente.value;";
    echo "  elemento = window.parent.document.getElementById('habilita_' + op);";
    echo "  elemento.checked = true;";
    echo "  elemento = window.parent.document.getElementById('tarifa_' + op);";
    echo "  elemento.value = trayecto+' » '+tarifa;";
    echo "  elemento = window.parent.document.getElementById('frecuencia');";
    echo "  fuente = document.getElementById('fr');";
    echo "  elemento.value = fuente.value;";
    echo "  elemento = window.parent.document.getElementById('tiempotransito');";
    echo "  fuente = document.getElementById('tt');";
    echo "  elemento.value = fuente.value;";
    echo "}";
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand';";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
    echo "}";
    echo "function acumula(to, from) {";
    echo "    elemento = document.getElementById('rec_' + to);";
    echo "    elemento.value+= from;";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";           // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    $con_mem = true;
    if (isset($cn) and isset($id) and isset($pr)) {                                                              // Switch que evalua cual botòn de comando fue pulsado por el usuario
        if (!$rs->Open("select * from vi_tarifario f where ca_idconcepto = $cn and f.ca_idtrayecto in (select ca_idtarifas from vi_trayectos t, vi_cotproductos p where p.ca_idcotizacion = $id and p.ca_idproducto = '$pr' and t.ca_origen = p.ca_idorigen and t.ca_destino = p.ca_iddestino)")) {    // Mueve el apuntador al registro que se desea modificar
            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
            exit;
        }
        echo "<INPUT ID=fr TYPE='HIDDEN' NAME='fr' VALUE='" . $rs->Value('ca_frecuencia') . "'>";
        echo "<INPUT ID=tt TYPE='HIDDEN' NAME='tt' VALUE='" . $rs->Value('ca_tiempotransito') . "'>";
        $oid_mem = 0;
        while (!$rs->Eof()) {
            if ($con_mem) {
                echo "<TR>";
                echo " <TH>Concepto</TH>";
                echo " <TH>Tar.Neta</TH>";
                echo " <TH>Sug.Venta</TH>";
                echo " <TH>Mínimo</TH>";
                echo " <TH>Frecuencia</TH>";
                echo " <TH>T.Transito</TH>";
                echo "</TR>";
                $con_mem = false;
            }
            if ($oid_mem != $rs->Value('ca_oid_f')) {
                $sug_mem = ($rs->Value('ca_sugerida') == '*') ? 'FFFFC0' : 'F0F0F0';
                $sug_mem = ($rs->Value('ca_mantenimiento') == '*') ? 'FF6666' : $sug_mem;
                $nom_mem = (strlen($rs->Value('ca_nombre')) > 25 and $rs->Value('ca_sigla') != '') ? $rs->Value('ca_sigla') : substr($rs->Value('ca_nombre'), 0, 25);
                echo "<TR>";
                echo " <TD Class=invertir style='font-weight:bold; font-size: 9px;' COLSPAN=6>$nom_mem</TD>";
                echo "</TR>";
                echo "<dfn title=\"Vigencia para la Tarifa:\n" . $rs->Value('ca_fchinicio_f') . " » " . $rs->Value('ca_fchvencimiento_f') . "\nObservaciones:\n" . $rs->Value('ca_observaciones_f') . "\">";
                echo "<TR style='background:\"$sug_mem\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'$sug_mem');\" ONCLICK='javascript:seleccion(\"" . $rs->Value('ca_oid_f') . "\",\"" . $rs->Value('ca_idtrayecto') . "\",\"" . $rs->Value('ca_idmoneda_f') . "\",\"" . number_format($rs->Value('ca_vlrminimo'), 2) . "\")'>";
                echo " <TD style='font-weight:bold; font-size: 9px;'>" . $rs->Value('ca_concepto') . "</TD>";
                echo " <TD style='text-align:right;'>" . number_format($rs->Value('ca_vlrneto'), 2) . " " . $rs->Value('ca_idmoneda_f') . "</TD>";
                echo " <TD style='text-align:right;'>" . number_format($rs->Value('ca_vlrminimo'), 2) . " " . $rs->Value('ca_idmoneda_f') . "</TD>";
                echo " <TD style='text-align:right;'>" . number_format($rs->Value('ca_fleteminimo'), 2) . " " . $rs->Value('ca_idmoneda_f') . "</TD>";
                echo " <TD style='text-align:center;'>" . $rs->Value('ca_frecuencia') . "</TD>";
                echo " <TD style='text-align:center;'>" . $rs->Value('ca_tiempotransito') . "</TD>";
                echo "</TR>";
                echo "</dfn>";
                $oid_mem = $rs->Value('ca_oid_f');
                echo "<INPUT ID=rec_$oid_mem TYPE='HIDDEN' NAME='recargos[]' VALUE=''>";                  // Acumula la descripción de los recargos
            }
            if ($rs->Value('ca_vlrfijo') != 0) {
                $vlr_rec = $rs->Value('ca_idmoneda_r') . " " . sprintf("%01.2f", $rs->Value('ca_vlrfijo'));
                $bas_rec = '';
            } else if ($rs->Value('ca_porcentaje') != 0) {
                $vlr_rec = $rs->Value('ca_idmoneda_r') . " " . sprintf("%01.2f", $rs->Value('ca_porcentaje'));
                $bas_rec = $rs->Value('ca_baseporcentaje');
            } else if ($rs->Value('ca_vlrunitario') != 0) {
                $vlr_rec = $rs->Value('ca_idmoneda_r') . " " . sprintf("%01.2f", $rs->Value('ca_vlrunitario'));
                $bas_rec = $rs->Value('ca_baseunitario');
            }
            echo "<script>acumula($oid_mem,\"» $vlr_rec -> " . $rs->Value('ca_recargo') . "\\n\");</script>";
            $rs->MoveNext();
        }
    }
    if (!$con_mem) {
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=titulo COLSPAN=6></TD>";
        echo "</TR>";
    }
    echo "</TABLE><BR>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Liberar' and isset($oid)) {
    if (!$rs->Open("select * from vi_inoclientes_sea where ca_oid = $oid")) {  // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_valor from tb_parametros where ca_casouso = 'CU091'")) {    // Selecciona los registros de la tabla parámetros
        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='liberar_sea.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos

    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=" . $id . ">";
    echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=" . $oid . ">";
    echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE='" . $rs->Value('ca_referencia') . "'>";
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=5>Módulo para Registro de Liberaciones<BR>" . $rs->Value('ca_referencia') . "</TH>";
    echo "</TR>";
    echo "<TH>Cliente</TH>";
    echo "<TH>Factura</TH>";
    echo "<TH>Valor</TH>";
    echo "<TH>Rec.Caja</TH>";
    echo "<TH>Fch.Pago</TH>";
    $cli_mem = true;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR>";
        if ($cli_mem) {
            echo "  <TD Class=listar WIDTH=220 ROWSPAN=" . $rs->GetRowCount() . ">" . $rs->Value('ca_compania') . "</TD>";
            $cli_mem = false;
        }
        echo "  <TD Class=mostrar>" . $rs->Value('ca_factura') . "</TD>";
        echo "  <TD Class=valores style='vertical-align:middle;'>" . number_format($rs->Value('ca_valor')) . "</TD>";
        echo "  <TD Class=listar WIDTH=75><INPUT TYPE='TEXT' NAME='liberacion[" . $rs->Value('ca_factura') . "][reccaja]' VALUE='" . $rs->Value('ca_reccaja') . "' SIZE=13 MAXLENGTH=15 ONBLUR='habilitar(this);'></TD>";
        echo "  <TD Class=listar WIDTH=75><INPUT TYPE='TEXT' NAME='liberacion[" . $rs->Value('ca_factura') . "][fchpago]' SIZE=12 VALUE='" . date("Y-m-d") . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=5></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='text-align:right;'>Fecha de Liberación:<BR><INPUT TYPE='TEXT' NAME='fchliberacion' SIZE=12 VALUE='" . date("Y-m-d") . "' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    // echo "  <TD Class=listar COLSPAN=4>Nota de Liberación:<BR><INPUT TYPE='TEXT' NAME='notaliberacion' VALUE='".$rs->Value('ca_notaliberacion')."' SIZE=62 MAXLENGTH=250></TD>";
    echo "  <TD Class=listar COLSPAN=4>Nota de Liberación:<BR><SELECT NAME='notaliberacion'>";
    while (!$tm->Eof()) {
        echo"<OPTION VALUE=\"" . $tm->Value('ca_valor') . "\"";
        if ($tm->Value('ca_valor') == $rs->Value('ca_notaliberacion')) {
            echo " SELECT";
        }
        echo">" . $tm->Value('ca_valor') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=5></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Liberar' ONCLICK='return confirm(\"¿Esta seguro de Aplicar la Liberación?\")'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.liberar_sea.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Concepto' and isset($i) and isset($id)) {
    if (!$rs->Open("select ca_transporte, ca_modalidad from vi_reportes where ca_idreporte = $id")) {    // Selecciona todos lo registros de la tabla Reportes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    $co = & DlRecordset::NewRecordset($conn);
    $mn = & DlRecordset::NewRecordset($conn);
    $modalidad = ($rs->Value('ca_modalidad') == 'COLOADING') ? 'LCL' : $rs->Value('ca_modalidad');
    if (!$co->Open("select ca_idconcepto, substr(ca_concepto,1,25) as ca_concepto from vi_conceptos where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_modalidad = '$modalidad'")) {   // Selecciona todos lo registros de la tabla Conceptos
        echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $co->MoveFirst();
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    source = window.parent.document.getElementById('fidco_$i');";
    echo "    indice = source.value + '|';";
    echo "    source = window.parent.document.getElementById('fconc_$i');";
    echo "    indice+= source.value;";
    echo "    elegir_item('idconcepto', indice);";
    echo "    source = window.parent.document.getElementById('fcant_$i');";
    echo "    target = document.getElementById('cantidad');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fntar_$i');";
    echo "    target = document.getElementById('neta_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fnmin_$i');";
    echo "    target = document.getElementById('neta_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fnidm_$i');";
    echo "    elegir_item('neta_idm', source.value);";
    echo "    source = window.parent.document.getElementById('frtar_$i');";
    echo "    target = document.getElementById('reportar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('frmin_$i');";
    echo "    target = document.getElementById('reportar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fridm_$i');";
    echo "    elegir_item('reportar_idm', source.value);";
    echo "    source = window.parent.document.getElementById('fctar_$i');";
    echo "    target = document.getElementById('cobrar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fcmin_$i');";
    echo "    target = document.getElementById('cobrar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fcidm_$i');";
    echo "    elegir_item('cobrar_idm', source.value);";
    echo "    source = window.parent.document.getElementById('fobvs_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo "    if (validar(\"cantidad,neta_tar,neta_min,reportar_tar,reportar_min,cobrar_tar,cobrar_min\")){";
    echo "      source = document.getElementById('idconcepto');";
    echo "      element= source.value.split('|');";
    echo "      target = window.parent.document.getElementById('fidco_$i');";
    echo "      target.value = element[0];";
    echo "      target = window.parent.document.getElementById('fconc_$i');";
    echo "      target.value = element[1];";
    echo "      source = document.getElementById('cantidad');";
    echo "      target = window.parent.document.getElementById('fcant_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('neta_tar');";
    echo "      target = window.parent.document.getElementById('fntar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('neta_min');";
    echo "      target = window.parent.document.getElementById('fnmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('neta_idm');";
    echo "      target = window.parent.document.getElementById('fnidm_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_tar');";
    echo "      target = window.parent.document.getElementById('frtar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_min');";
    echo "      target = window.parent.document.getElementById('frmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_idm');";
    echo "      target = window.parent.document.getElementById('fridm_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_tar');";
    echo "      target = window.parent.document.getElementById('fctar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_min');";
    echo "      target = window.parent.document.getElementById('fcmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_idm');";
    echo "      target = window.parent.document.getElementById('fcidm_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('observaciones');";
    echo "      target = window.parent.document.getElementById('fobvs_$i');";
    echo "      target.value = source.value;";
    echo "      window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "      window.parent.document.body.scroll=\"yes\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('fidco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fconc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcant_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fntar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fnmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fnidm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frtar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fridm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fctar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcidm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobvs_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "function elegir_item(source, indice) {";
    echo "  elemento = document.getElementById(source);";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    if (elemento[cont].value == indice){";
    echo "          elemento[cont].selected = true;";
    echo "          return;";
    echo "      }";
    echo "    }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }else if ('$modalidad' == 'LCL'){";
    echo "        if (source.name.indexOf('_min') != -1) {";
    echo "        	  target = document.getElementById(source.name.substring(0, source.name.indexOf('_min'))+'_tar');";
    echo "        	  if (eval(source.value) < eval(target.value) && document.getElementById('aplicamin').checked) {";
    echo "        	      alert('El Valor Mínimo no puede ser inferior al valor del flete');";
    echo "        	      source.focus();";
    echo "        	      return (false);";
    echo "    	      }";
    echo "    	  }";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>Opción para Definición de Conceptos</TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Concepto:";                                           // Llena el cuadro de lista con los valores de la tabla Conceptos
    echo "  <TD Class=listar><SELECT NAME='idconcepto'>";
    while (!$co->Eof()) {
        echo"<OPTION VALUE=\"" . $co->Value('ca_idconcepto') . "|" . $co->Value('ca_concepto') . "\">" . $co->Value('ca_concepto') . "</OPTION>";
        $co->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Cantidad:</B></TD>";
    echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='cantidad' VALUE=0 SIZE=8 MAXLENGTH=10></TD>";
    echo "  <TD Class=listar>Aplica Mínimo<INPUT TYPE='CHECKBOX' NAME='aplicamin' CHECKED></TD>";
    echo "</TR>";
    echo "<TR><TD Class=invertir COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1><TR>";
    echo "  <TD Class=invertir><B>T.Neta:</B><BR><INPUT TYPE='TEXT' NAME='neta_tar' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='neta_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='neta_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";

    echo "  <TD Class=mostrar><B>T.Reportar:</B><BR><INPUT TYPE='TEXT' NAME='reportar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='reportar_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Moneda:</B><BR><SELECT NAME='reportar_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";

    echo "  <TD Class=invertir><B>T.Cobrar:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='cobrar_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR></TABLE></TD></TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Observaciones sobre Flete:</B></TD>";
    echo "  <TD Class=mostrar COLSPAN=5><INPUT TYPE='TEXT' NAME='observaciones' VALUE='' SIZE=80 MAXLENGTH=250></TD><TR>";
    echo "</TR>";

//  Definición de Conceptos
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=7></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=5>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Rangos' and isset($i) and isset($id)) {
    if (!$rs->Open("select ca_transporte, ca_modalidad from vi_reportes where ca_idreporte = $id")) {    // Selecciona todos lo registros de la tabla Reportes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    $co = & DlRecordset::NewRecordset($conn);
    $mn = & DlRecordset::NewRecordset($conn);
    $modalidad = ($rs->Value('ca_modalidad') == 'COLOADING') ? 'LCL' : $rs->Value('ca_modalidad');
    if (!$co->Open("select ca_idconcepto, substr(ca_concepto,1,25) as ca_concepto from vi_conceptos where ca_transporte = '" . $rs->Value('ca_transporte') . "' and ca_modalidad = '$modalidad'")) {   // Selecciona todos lo registros de la tabla Conceptos
        echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $co->MoveFirst();
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    source = window.parent.document.getElementById('fidco_$i');";
    echo "    indice = source.value + '|';";
    echo "    source = window.parent.document.getElementById('fconc_$i');";
    echo "    indice+= source.value;";
    echo "    elegir_item('idconcepto', indice);";
    echo "    source = window.parent.document.getElementById('frtar_$i');";
    echo "    target = document.getElementById('reportar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('frmin_$i');";
    echo "    target = document.getElementById('reportar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fridm_$i');";
    echo "    elegir_item('reportar_idm', source.value);";
    echo "    source = window.parent.document.getElementById('fctar_$i');";
    echo "    target = document.getElementById('cobrar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fcmin_$i');";
    echo "    target = document.getElementById('cobrar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('fcidm_$i');";
    echo "    elegir_item('cobrar_idm', source.value);";
    echo "    source = window.parent.document.getElementById('fobvs_$i');";
    echo "    target = document.getElementById('observaciones');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo "    if (validar(\"reportar_tar,reportar_min,cobrar_tar,cobrar_min\")){";
    echo "      source = document.getElementById('idconcepto');";
    echo "      element= source.value.split('|');";
    echo "      target = window.parent.document.getElementById('fidco_$i');";
    echo "      target.value = element[0];";
    echo "      target = window.parent.document.getElementById('fconc_$i');";
    echo "      target.value = element[1];";
    echo "      source = document.getElementById('reportar_tar');";
    echo "      target = window.parent.document.getElementById('frtar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_min');";
    echo "      target = window.parent.document.getElementById('frmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_idm');";
    echo "      target = window.parent.document.getElementById('fridm_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_tar');";
    echo "      target = window.parent.document.getElementById('fctar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_min');";
    echo "      target = window.parent.document.getElementById('fcmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_idm');";
    echo "      target = window.parent.document.getElementById('fcidm_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('observaciones');";
    echo "      target = window.parent.document.getElementById('fobvs_$i');";
    echo "      target.value = source.value;";
    echo "      window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "      window.parent.document.body.scroll=\"yes\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('fidco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fconc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frtar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('frmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fridm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fctar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fcidm_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('fobvs_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "function elegir_item(source, indice) {";
    echo "  elemento = document.getElementById(source);";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    if (elemento[cont].value == indice){";
    echo "          elemento[cont].selected = true;";
    echo "          return;";
    echo "      }";
    echo "    }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=8>Opción para Definición de Conceptos</TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Conceptos:";                                          // Llena el cuadro de lista con los valores de la tabla Conceptos
    echo "  <TD Class=invertir><B>Aéreos:</B><BR><SELECT NAME='idconcepto'>";
    while (!$co->Eof()) {
        echo"<OPTION VALUE=\"" . $co->Value('ca_idconcepto') . "|" . $co->Value('ca_concepto') . "\">" . $co->Value('ca_concepto') . "</OPTION>";
        $co->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar><B>T.Reportar:</B><BR><INPUT TYPE='TEXT' NAME='reportar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='reportar_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Moneda:</B><BR><SELECT NAME='reportar_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "  <TD Class=invertir><B>T.Cobrar:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";   // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_min' VALUE=0 ONBLUR='valores(this);' SIZE=8 MAXLENGTH=10></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Moneda:</B><BR><SELECT NAME='cobrar_idm'>";
    $mn->MoveFirst();
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=2 style='text-align:left; vertical-align:top;'><B>Observaciones sobre Flete:</B></TD>";
    echo "  <TD Class=mostrar COLSPAN=6><INPUT TYPE='TEXT' NAME='observaciones' VALUE='' SIZE=80 MAXLENGTH=250></TD><TR>";
    echo "</TR>";

//  Definición de Conceptos
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=8></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=5>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Recargos_Org' and isset($i) and isset($id)) {
    $tipos = array("$", "%");
    $aplicaciones = array("Valor Fijo", "Sobre Flete", "Sobre Flete + Recargos", "Unitario x Peso/Volumen", "Unitario x Pieza", "Unitario x BLs/HAWBs");
    if (!$rs->Open("select ca_transporte, ca_incoterms, ca_modalidad from vi_reportes where ca_idreporte = $id")) {    // Selecciona todos lo registros de la tabla Reportes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    $rc = & DlRecordset::NewRecordset($conn);
    $mn = & DlRecordset::NewRecordset($conn);
    $co = & DlRecordset::NewRecordset($conn);

    if (!$rc->Open("select ca_idrecargo, ca_recargo from tb_tiporecargo where ca_tipo like '%Recargo en Origen%' and ca_usueliminado IS NULL and ca_transporte = '" . $rs->Value('ca_transporte') . "' order by ca_recargo")) {   // Selecciona todos lo registros de la tabla Recargos
        echo "<script>alert(\"" . addslashes($rc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $rc->MoveFirst();
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    $modalidad = ($rs->Value('ca_modalidad') == 'COLOADING') ? 'LCL' : $rs->Value('ca_modalidad');

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    source = window.parent.document.getElementById('ridrc_$i');";
    echo "    target = document.getElementById('idrecargo');";
    echo "    elegir_item('idrecargo', source.value);";
    echo "    if (target.value != source.value){";
    echo "    	  finder = false;";
    echo "    	  source = window.parent.document.getElementById('rreco_$i');";
    echo "    	  for (i=0; i<target.options.length; i++){";
    echo "           var p = target.options[i].text;";
    echo "           if (p == source.value){";
    echo "    	  		 finder = true;";
    echo "           	 target.options[i].selected = true;";
    echo "           }";
    echo "        }";
    echo "    if (!finder && source.value!=''){";
    echo "        alert('El Recargo '+source.value+' no fue encontrado');";
    echo "        }";
    echo "    }";
    echo "    source = window.parent.document.getElementById('rapli_$i');";
    echo "    elegir_item('aplicacion', source.value);";
    echo "    source = window.parent.document.getElementById('rtipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('rntar_$i');";
    echo "    target = document.getElementById('neta_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('rnmin_$i');";
    echo "    target = document.getElementById('neta_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('rrtar_$i');";
    echo "    target = document.getElementById('reportar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('rrmin_$i');";
    echo "    target = document.getElementById('reportar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('rctar_$i');";
    echo "    target = document.getElementById('cobrar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('rcmin_$i');";
    echo "    target = document.getElementById('cobrar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('ridmn_$i');";
    echo "    elegir_item('idmoneda', source.value);";
    echo "    source = window.parent.document.getElementById('rdets_$i');";
    echo "    target = document.getElementById('detalles');";
    echo "    target.value = source.value;";
    echo "    i = 0;";
    echo "    target = document.getElementById('idconcepto');";
    echo "    while (true) {";
    echo "      source_a = window.parent.document.getElementById('fidco_'+i);";
    echo "      source_b = window.parent.document.getElementById('fconc_'+i);";
    echo "      if (!isNaN(source_a)) {";
    echo "        break;";
    echo "      } else if (source_b.value != '') {";
    echo "        target[target.length] = new Option(source_b.value,source_a.value,false,false);";
    echo "      }";
    echo "      i++;";
    echo "    }";
    echo "    source = window.parent.document.getElementById('ridco_$i');";
    echo "    elegir_item('idconcepto', source.value);";
    echo "}";
    echo "function registro() {";
    echo "    if (validar(\"neta_tar,neta_min,reportar_tar,reportar_min,cobrar_tar,cobrar_min\")){";
    echo "      source = document.getElementById('idrecargo');";
    echo "      target = window.parent.document.getElementById('ridrc_$i');";
    echo "      target.value = source.value;";
    echo "      target = window.parent.document.getElementById('rreco_$i');";
    echo "      target.value = source.options[source.selectedIndex].text;";
    echo "      source = document.getElementById('aplicacion');";
    echo "      target = window.parent.document.getElementById('rapli_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('tipo');";
    echo "      target = window.parent.document.getElementById('rtipo_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('neta_tar');";
    echo "      target = window.parent.document.getElementById('rntar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('neta_min');";
    echo "      target = window.parent.document.getElementById('rnmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_tar');";
    echo "      target = window.parent.document.getElementById('rrtar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('reportar_min');";
    echo "      target = window.parent.document.getElementById('rrmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_tar');";
    echo "      target = window.parent.document.getElementById('rctar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_min');";
    echo "      target = window.parent.document.getElementById('rcmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('idmoneda');";
    echo "      target = window.parent.document.getElementById('ridmn_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('idconcepto');";
    echo "      target = window.parent.document.getElementById('ridco_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('detalles');";
    echo "      target = window.parent.document.getElementById('rdets_$i');";
    echo "      target.value = source.value;";
    echo "      window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "      window.parent.document.body.scroll=\"yes\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('ridrc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rreco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rapli_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rtipo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rntar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rnmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rrtar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rrmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rctar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rcmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ridmn_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ridco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('rdets_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "function elegir_item(source, indice) {";
    echo "  elemento = document.getElementById(source);";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    if (elemento[cont].value == indice){";
    echo "          elemento[cont].selected = true;";
    echo "          return;";
    echo "      }";
    echo "    }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }else if ('$modalidad' == 'LCL'){";
    echo "        if (source.name.indexOf('_min') != -1) {";
    echo "        	  target = document.getElementById(source.name.substring(0, source.name.indexOf('_min'))+'_tar');";
    echo "        	  if (eval(source.value) < eval(target.value) && document.getElementById('aplicamin').checked) {";
    echo "        	      alert('El Valor Mínimo no puede ser inferior al valor del Recargo');";
    echo "        	      source.focus();";
    echo "        	      return (false);";
    echo "    	      }";
    echo "    	  }";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "function valores(elemento) {";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>Opción para Definición de Recargos</TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=titulo COLSPAN=7><TABLE WIDTH=100% CELLSPACING=0 BORDER=0>";
    echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Recargos: ";               // Llena el cuadro de lista con los valores de la tabla Conceptos
    echo "  <TD Class=listar><B>En Origen:</B><BR><SELECT NAME='idrecargo'>";
    while (!$rc->Eof()) {
        echo"<OPTION VALUE=\"" . $rc->Value('ca_idrecargo') . "\">" . $rc->Value('ca_recargo') . "</OPTION>";
        $rc->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Aplicación:</B><BR><SELECT NAME='aplicacion'>";
    for ($i = 0; $i < count($aplicaciones); $i++) {
        echo " <OPTION VALUE='" . $aplicaciones[$i] . "'>" . $aplicaciones[$i];
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Tipo:</B><BR><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tipos); $i++) {
        echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
    }
    echo "  </SELECT></TD>";
    if ($modalidad == "LCL") {
        echo "  <TD Class=listar><B>Aplica Mínimo</B><BR><CENTER><INPUT TYPE='CHECKBOX' NAME='aplicamin' CHECKED><CENTER></TD>";
    }
    echo "  </TABLE></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=invertir><B>Rec. Neto:</B><BR><INPUT TYPE='TEXT' NAME='neta_tar' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='neta_min' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>";    // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Rec. Reportar:</B><BR><INPUT TYPE='TEXT' NAME='reportar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='reportar_min' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Rec. Cobrar:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_min' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Moneda:</B><BR><SELECT NAME='idmoneda'>";
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=2 style='text-align:left; vertical-align:top;'><B>Concepto:</B><BR><SELECT NAME='idconcepto'>";
    echo "    <OPTION VALUE=9999>Igual para todos</OPTION>";
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=5><B>Detalles:</B><BR><INPUT TYPE='TEXT' NAME='detalles' SIZE=75 MAXLENGTH=150></TD>";  // Campos para captura de tarifas
    echo "</TR>";

//  Definición de Conceptos
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=7></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=3>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Recargos_Loc' and isset($i) and isset($id)) {
    $tipos = array("$", "%");
    $aplicaciones = array("Valor Fijo", "Sobre Flete", "Sobre Flete + Recargos", "Unitario x Peso/Volumen", "Unitario x Pieza", "Unitario x BLs/HAWBs");
    if (!$rs->Open("select ca_transporte, ca_incoterms, ca_modalidad from vi_reportes where ca_idreporte = $id")) {    // Selecciona todos lo registros de la tabla Reportes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    $rc = & DlRecordset::NewRecordset($conn);
    $mn = & DlRecordset::NewRecordset($conn);
    $co = & DlRecordset::NewRecordset($conn);
    if (!$rc->Open("select ca_idrecargo, ca_recargo from tb_tiporecargo where ca_tipo like '%Recargo Local%' and ca_usueliminado IS NULL and ca_transporte = '" . $rs->Value('ca_transporte') . "' order by ca_recargo")) {   // Selecciona todos lo registros de la tabla Recargos
        echo "<script>alert(\"" . addslashes($rc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $rc->MoveFirst();
    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
        echo "<script>alert(\"" . addslashes($mn->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $mn->MoveFirst();
    if (!$co->Open("select ca_idconcepto, substr(ca_concepto,1,25) as ca_concepto from vi_conceptos where ca_transporte = 'Terrestre' order by ca_liminferior")) {   // Selecciona todos lo registros de la tabla Conceptos
        echo "<script>alert(\"" . addslashes($co->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $co->MoveFirst();


    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function cargar() {";
    echo "    source = window.parent.document.getElementById('lidrc_$i');";
    echo "    target = document.getElementById('idrecargo');";
    echo "    elegir_item('idrecargo', source.value);";
    echo "    if (target.value != source.value){";
    echo "    	  finder = false;";
    echo "    	  source = window.parent.document.getElementById('lrecl_$i');";
    echo "    	  for (i=0; i<target.options.length; i++){";
    echo "           var p = target.options[i].text;";
    echo "           if (p == source.value){";
    echo "    	  		 finder = true;";
    echo "           	 target.options[i].selected = true;";
    echo "           }";
    echo "        }";
    echo "    if (!finder && source.value!=''){";
    echo "        alert('El Recargo '+source.value+' no fue encontrado');";
    echo "        }";
    echo "    }";
    echo "    source = window.parent.document.getElementById('lapli_$i');";
    echo "    elegir_item('aplicacion', source.value);";
    echo "    source = window.parent.document.getElementById('ltipo_$i');";
    echo "    elegir_item('tipo', source.value);";
    echo "    source = window.parent.document.getElementById('lctar_$i');";
    echo "    target = document.getElementById('cobrar_tar');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('lcmin_$i');";
    echo "    target = document.getElementById('cobrar_min');";
    echo "    target.value = (isNaN(parseFloat(source.value)))?0:parseFloat(source.value);";
    echo "    source = window.parent.document.getElementById('lidmn_$i');";
    echo "    elegir_item('idmoneda', source.value);";
    echo "    source = window.parent.document.getElementById('lidco_$i');";
    echo "    elegir_item('idconcepto', source.value);";
    echo "    source = window.parent.document.getElementById('ldets_$i');";
    echo "    target = document.getElementById('detalles');";
    echo "    target.value = source.value;";
    echo "}";
    echo "function registro() {";
    echo "    if (validar(\"cobrar_tar,cobrar_min\")){";
    echo "      source = document.getElementById('idrecargo');";
    echo "      target = window.parent.document.getElementById('lidrc_$i');";
    echo "      target.value = source.value;";
    echo "      target = window.parent.document.getElementById('lrecl_$i');";
    echo "      target.value = source.options[source.selectedIndex].text;";
    echo "      source = document.getElementById('aplicacion');";
    echo "      target = window.parent.document.getElementById('lapli_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('tipo');";
    echo "      target = window.parent.document.getElementById('ltipo_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_tar');";
    echo "      target = window.parent.document.getElementById('lctar_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('cobrar_min');";
    echo "      target = window.parent.document.getElementById('lcmin_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('idmoneda');";
    echo "      target = window.parent.document.getElementById('lidmn_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('idconcepto');";
    echo "      target = window.parent.document.getElementById('lidco_$i');";
    echo "      target.value = source.value;";
    echo "      source = document.getElementById('detalles');";
    echo "      target = window.parent.document.getElementById('ldets_$i');";
    echo "      target.value = source.value;";
    echo "      window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "      window.parent.document.body.scroll=\"yes\";";
    echo "    }";
    echo "}";
    echo "function eliminar() {";
    echo "    target = window.parent.document.getElementById('lidrc_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lrecl_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lapli_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ltipo_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lctar_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lcmin_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lidmn_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('lidco_$i');";
    echo "    target.value = '';";
    echo "    target = window.parent.document.getElementById('ldets_$i');";
    echo "    target.value = '';";
    echo "    window.parent.frames.captura.style.visibility = \"hidden\";";
    echo "    window.parent.document.body.scroll=\"yes\";";
    echo "}";
    echo "function elegir_item(source, indice) {";
    echo "  elemento = document.getElementById(source);";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    if (elemento[cont].value == indice){";
    echo "          elemento[cont].selected = true;";
    echo "          return;";
    echo "      }";
    echo "    }";
    echo "}";
    echo "function validar(cadena) {";
    echo "  elemento = cadena.split(',');";
    echo "  for (cont=0; cont<elemento.length; cont++) {";
    echo "    source = document.getElementById(elemento[cont]);";
    echo "    if (isNaN(parseInt(source.value))){";
    echo "        alert('Valor no válido para '+elemento[cont]);";
    echo "        source.focus();";
    echo "        return (false);";
    echo "    }";
    echo "  }";
    echo "  return (true);";
    echo "}";
    echo "function valores(elemento) {";
    echo "  if (isNaN(parseFloat(elemento.value)) || elemento.value.indexOf(',')!=-1){";
    echo "      alert('No es un valor número correcto para el campo. Favor intente nuevamente sin utilizar letras ni comas, sólo un punto para separar decimales.');";
    echo "      elemento.focus();";
    echo "  }else{";
    echo "      elemento.value = parseFloat(elemento.value);";
    echo "  }";
    echo "}";
    echo "</script>";
    echo "</HEAD>";
    echo "<BODY>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='consulta' ACTION='ventanas.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=100% CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>Opción para Definición de Recargos</TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Recargos:";               // Llena el cuadro de lista con los valores de la tabla Conceptos
    echo "  <TD Class=listar COLSPAN=3><B>Locales:</B><BR><SELECT NAME='idrecargo'>";
    while (!$rc->Eof()) {
        echo"<OPTION VALUE=\"" . $rc->Value('ca_idrecargo') . "\">" . $rc->Value('ca_recargo') . "</OPTION>";
        $rc->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=2 style='text-align:left; vertical-align:top;'><B>Aplicación:</B><BR><SELECT NAME='aplicacion'>";
    for ($i = 0; $i < count($aplicaciones); $i++) {
        echo " <OPTION VALUE='" . $aplicaciones[$i] . "'>" . $aplicaciones[$i];
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar style='text-align:left; vertical-align:top;'><B>Tipo:</B><BR><SELECT NAME='tipo'>";
    for ($i = 0; $i < count($tipos); $i++) {
        echo " <OPTION VALUE='" . $tipos[$i] . "'>" . $tipos[$i];
    }
    echo "  </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=4><B>Detalles:</B><BR><INPUT TYPE='TEXT' NAME='detalles' SIZE=65 MAXLENGTH=80></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Rec. Cobrar:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_tar' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>"; // Campos para captura de tarifas
    echo "  <TD Class=invertir><B>Mínimo:</B><BR><INPUT TYPE='TEXT' NAME='cobrar_min' VALUE=0 ONBLUR='valores(this);' SIZE=12 MAXLENGTH=10></TD>";  // Campos para captura de tarifas
    echo "  <TD Class=mostrar><B>Moneda:</B><BR><SELECT NAME='idmoneda'>";
    while (!$mn->Eof()) {
        echo"<OPTION VALUE=" . $mn->Value('ca_idmoneda') . " " . (($mn->Value('ca_idmoneda') == 'USD') ? 'SELECTED' : '') . ">" . $mn->Value('ca_idmoneda') . "</OPTION>";
        $mn->MoveNext();
    }
    echo "   </SELECT></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=7 style='text-align:left; vertical-align:top;'><B>Concepto:</B><BR><SELECT NAME='idconcepto'>";
    echo "    <OPTION VALUE=9999>Igual para todos</OPTION>";
    while (!$co->Eof()) {
        echo "<OPTION VALUE=\"" . $co->Value('ca_idconcepto') . "\">" . $co->Value('ca_concepto') . "</OPTION>";
        $co->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "</TR>";

//  Definición de Conceptos
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=7></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Registrar' ONCLICK='javascript:registro();'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='accion' VALUE='Eliminar' ONCLICK='javascript:eliminar();'></TH>";         // Elimina el Registro de la Pantalla de Captura
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.captura.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "<script>cargar();</script>";
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "</BODY>";
    echo "</HTML>";
} else if (isset($opcion) and $opcion == 'Imprimir' and isset($id) and isset($ci)) {
    require('include/fpdf.php');                                                   // Incorpora la librería de funciones, para generara Archivos en formato PDF
    require('include/cpdf.php');                                                   // Incorpora la plantilla con formato de Coltrans
    if (!$rs->Open("select * from vi_agentesxcont where ca_activo=true and ca_activo_con=true and ca_idtrafico_ag like '" . $id . "' and ca_idciudad_ag like '" . $ci . "'")) {    // Mueve el apuntador al registro que se desea eliminar
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'agentes.php';</script>";
        exit;
    }
    $pdf = new PDF();
    $pdf->Open();
    $pdf->AliasNbPages();
    $pdf->SetTopMargin(14);
    $pdf->SetLeftMargin(18);
    $pdf->SetRightMargin(12);
    $pdf->SetAutoPageBreak(true, 26);
    $pdf->AddPage();
    $pdf->SetHeight(4);
    $age_mem = 0;
    $ciu_mem = '';
    $saltar = false;

    $pdf->Ln(1);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetWidths(array(170));
    $pdf->SetAligns(array("C"));
    $pdf->Row(array("DIRECTORIO DE AGENTES"));
    $pdf->Ln(3);

    while (!$rs->Eof() and !$rs->IsEmpty()) {
        if ($age_mem != $rs->Value('ca_idagente')) {
            if ($saltar) {
                $pdf->AddPage();
            }
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetWidths(array(170));
            $pdf->SetAligns(array("L"));
            $pdf->Row(array(strtoupper($rs->Value('ca_nomtrafico_ag'))));

            list($iata_tra, $dis_int, $iata_ciu, $dis_nal) = sscanf($rs->Value('ca_idtrafico_ag') . " " . $rs->Value('ca_idciudad_ag'), "%2s-%d %3s-%d");
            $ind_mem = "(" . $dis_int . " - " . $dis_nal . ") ";
            $age_int = strtoupper($rs->Value('ca_nombre_ag')) . "\n  " . $rs->Value('ca_website') . "\n  " . $rs->Value('ca_email_ag');
            $age_dat = $rs->Value('ca_direccion_ag') . "\n" . $ind_mem . $rs->Value('ca_telefonos_ag') . "\n" . $ind_mem . $rs->Value('ca_fax_ag') . "\n" . $rs->Value('ca_ciudad_ag');
            $pdf->Ln(2);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetWidths(array(20, 65, 85));
            $pdf->SetAligns(array("L", "L", "L"));
            $pdf->Row(array($rs->Value('ca_idagente'), $age_int, $age_dat));
            $age_mem = $rs->Value('ca_idagente');
            $saltar = true;
        }
        if (strlen($rs->Value('ca_ciudad_co')) == 0) {
            $rs->MoveNext();
            continue;
        }

        if ($ciu_mem != $rs->Value('ca_ciudad_co')) {
            $pdf->Ln(3);
            $pdf->SetFont('Arial', 'BI', 8);
            $pdf->SetWidths(array(170));
            $pdf->SetAligns(array("L"));
            $pdf->Row(array(strtoupper($rs->Value('ca_ciudad_co'))));
            $ciu_mem = $rs->Value('ca_ciudad_co');
        }

        list($iata_tra, $dis_int, $iata_ciu, $dis_nal) = sscanf($rs->Value('ca_idtrafico_co') . " " . $rs->Value('ca_idciudad_co'), "%2s-%d %3s-%d");
        $ind_mem = "(" . $dis_int . " - " . $dis_nal . ") ";
        $con_int = strtoupper($rs->Value('ca_nombre_co')) . "\n  " . $rs->Value('ca_email_co');
        $con_dat = $rs->Value('ca_direccion_co') . "\n" . $ind_mem . $rs->Value('ca_telefonos_co') . "\n" . $ind_mem . $rs->Value('ca_fax_co');

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(20, 65, 85));
        $pdf->SetAligns(array("L", "L", "L"));
        $pdf->Row(array('', $con_int, $con_dat));

        $rs->MoveNext();
    }

    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d H:i:s"), "%d-%d-%d %d:%d:%d");
    $pdf->Ln(4);
    $pdf->Cell(0, 4, 'Impresión: ' . $meses[$mes - 1] . ' ' . $dia . ' de ' . $anno . ' ' . $tiempo . ':' . $minuto . ':' . $segundo, 0, 1);
    $pdf->Ln(8);
    $pdf->Output();
    $pdf->Close();
} else if (isset($opcion) and $opcion == 'Reporte' and isset($id)) {
    require('include/fpdf.php');                                                   // Incorpora la librería de funciones, para generara Archivos en formato PDF
    require('include/cpdf.php');                                                   // Incorpora la plantilla con formato de Coltrans

    if (!$rs->Open("select * from vi_enccliente where ca_idencuesta = $id")) {    // Selecciona todos lo registros de la tabla Clientes
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    if ($rs->Value('ca_vendedor')) {
        $suc = & DlRecordset::NewRecordset($conn);
        $sql = "select s.* from control.tb_usuarios u LEFT JOIN control.tb_sucursales s ON u.ca_idsucursal = s.ca_idsucursal WHERE u.ca_login = '" . $rs->Value('ca_vendedor') . "'";
        if (!$suc->Open($sql)) {
            echo "Error 3494: $sql";
            exit;
        };
    } else {
        $suc = & DlRecordset::NewRecordset($conn);
        $sql = "select s.* from control.tb_usuarios u LEFT JOIN control.tb_sucursales s ON u.ca_idsucursal = s.ca_idsucursal WHERE u.ca_login = 'Comercial'";
        if (!$suc->Open($sql)) {
            echo "Error 3500: $sql";
            exit;
        };
    }
    
    $emp = & DlRecordset::NewRecordset($conn);
    $sql = "select * from control.tb_empresas e where e.ca_idempresa = '" . $suc->Value('ca_idempresa') . "'";
    if (!$emp->Open($sql)) {
        echo "Error 3502: $sql";
        exit;
    }

    $txtSucursal=array();
    $txtSucursal["datos"][]= $suc->Value('ca_nombre');
    $dir= explode("  ", $suc->Value('ca_direccion'));

    foreach($dir as $d)
        $txtSucursal["datos"][]=$d;
    $txtSucursal["datos"][]=$suc->Value('ca_telefono')?"Pbx: ".$suc->Value('ca_telefono'):"";//"Pxb : (57 - 1) 4239300";
    $txtSucursal["datos"][]=$suc->Value('ca_fax')?"Fax: ".$suc->Value('ca_fax'):"";//"Pxb : (57 - 1) 4239300";
    $txtSucursal["datos"][] = $suc->Value('ca_codpostal')?"Cod. Postal: ". $suc->Value('ca_codpostal'):"";
    if($suc->Value('ca_email')!="")
        $txtSucursal["datos"][]= $suc->Value('ca_email');//"Email: bogota@coltrans.com.co";
    $txtSucursal["datos"][]= $emp->Value('ca_url');// "www.coltrans.com.co";
    $txtSucursal["datos"][]="NIT: ".$emp->Value('ca_id');// "800024075";
    $txtSucursal["datos"][]=$emp->Value('ca_coddian')?"Cod. DIAN ".$emp->Value('ca_coddian'):"";

    if($suc->Value('ca_iso')!="")
        $txtSucursal["imagenes"][]=$suc->Value('ca_iso');
    if($suc->Value('ca_basc')!="")
        $txtSucursal["imagenes"][]=$suc->Value('ca_basc');
    if($suc->Value('ca_iata')!="")
        $txtSucursal["imagenes"][]=$suc->Value('ca_iata');
    
    $idempresa = $emp->Value('ca_idempresa');

    $pdf = new PDF();
    $pdf->Open();
    $pdf->SetIdempresa($idempresa);
    if($idempresa ==1){
        $pdf->SetColmasHeader(true);
    }else if($idempresa ==2){
        $pdf->SetColtransHeader(true);
    }
    $pdf->AliasNbPages();
    $pdf->SetTopMargin(14);
    $pdf->SetLeftMargin(18);
    $pdf->SetRightMargin(12);
    $pdf->SetAutoPageBreak(true, 26);
    $pdf->AddPage();
    $pdf->SetHeight(4);
    $pdf->SetSucursal($suc->Value('ca_idsucursal'));
    $pdf->SetFooterSucursal($txtSucursal);
    $id_temp = 0;

    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetWidths(array(170));
    $pdf->SetAligns(array("C"));
    $pdf->Row(array("FORMATO DE VISITA DEL CLIENTE"));
    $pdf->Ln(3);

    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        if ($rs->Value('ca_idcliente') != $id_temp) {
            $complemento = (($rs->Value('ca_oficina') != '') ? " Oficina : " . $rs->Value('ca_oficina') : "") . (($rs->Value('ca_torre') != '') ? " Torre : " . $rs->Value('ca_torre') : "") . (($rs->Value('ca_interior') != '') ? " Interior : " . $rs->Value('ca_interior') : "") . (($rs->Value('ca_complemento') != '') ? " - " . $rs->Value('ca_complemento') : "");
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetWidths(array(100, 70));
            $pdf->SetAligns(array("L", "L"));
            $pdf->Row(array($rs->Value('ca_compania'), " Nit.: " . number_format($rs->Value('ca_idalterno')) . "-" . $rs->Value('ca_digito')));
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetWidths(array(50, 120));
            $pdf->SetAligns(array("L", "L"));
            $pdf->Row(array("Representante Legal : ", $rs->Value('ca_ncompleto_cl')));
            $pdf->SetWidths(array(50, 50, 35, 35));
            $pdf->SetAligns(array("L", "L", "L", "L"));
            $pdf->Row(array("Dirección: " . str_replace("|", " ", $rs->Value('ca_direccion_cl')) . $complemento, "Localidad: " . $rs->Value('ca_localidad'), "Teléfonos: " . $rs->Value('ca_telefonos_cl'), "Fax: " . $rs->Value('ca_fax_cl')));
            $id_temp = $rs->Value('ca_idcliente');
        }

        $pdf->Ln(4);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(30, 80, 30, 30));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("Contacto : ", $rs->Value('ca_ncompleto_cn'), "Fecha de la Visita :", $rs->Value('ca_fchvisita')));

        $pdf->SetWidths(array(65, 30, 65, 10));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("Tipo de Instalaciones :", $rs->Value('ca_instalaciones'), "¿Compartidas con otra Empresa? :", $rs->Value('ca_compartidas')));
        $pdf->Row(array("Condiciones físicas de las instalaciones :", $rs->Value('ca_condiciones'), "¿Es al mismo tiempo lugar de Vivienda? :", $rs->Value('ca_vivienda')));

        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("C"));
        $pdf->Row(array("Vigilancia"));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(65, 30, 65, 10));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("Vigilancia :", $rs->Value('ca_vigilancia'), "", ""));
        // $pdf->Row(array("Vigilancia :", $rs->Value('ca_vigilancia'), "¿Cuenta con un Sistema de Alarma? :", $rs->Value('ca_alarma')));
        $pdf->SetWidths(array(65, 30, 15, 60));
        $pdf->Row(array("Otros Sistemas de Seguridad :", $rs->Value('ca_masseguridad'), "Detalle :", $rs->Value('ca_detseguridad')));

        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("C"));
        $pdf->Row(array("Personal"));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(65, 30, 65, 10));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("¿Acorde al tamaño de la Empresa? :", $rs->Value('ca_peracorde'), "¿Está el personal Carnetizado? :", $rs->Value('ca_percarne')));
        // $pdf->Row(array("¿El personal se ve bien presentado? :", $rs->Value('ca_perpresentado'), "¿Está el personal Uniformado? :", $rs->Value('ca_peruniformado')));

        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("C"));
        $pdf->Row(array("Mercancia"));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(65, 30, 65, 10));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("¿Observó movimiento de Mercancia? :", $rs->Value('ca_mermovimiento'), "¿Tiene Control de Acceso? :", $rs->Value('ca_mercontrol')));
        $pdf->Row(array("¿Cargue dentro de las instalaciones? :", $rs->Value('ca_mercargue'), "", ""));

        // $pdf->Row(array("¿Observó movimiento de Mercancia? :", $rs->Value('ca_mermovimiento'), "¿Es éste movimiento organizado? :", $rs->Value('ca_merorganizado')));
        // $pdf->Row(array("¿Hay existencias de Mercancia? :", $rs->Value('ca_merexistencias'), "¿Tiene Control de Acceso? :", $rs->Value('ca_mercontrol')));
        // $pdf->Row(array("¿La bodega cuenta con infraestructura? :", str_replace("|", "\n", $rs->Value('ca_merinfraestructura')), "¿Se supervisa el cargue? :", $rs->Value('ca_mersupervision')));
        // $pdf->Row(array("¿Cargue dentro de las instalaciones? :", $rs->Value('ca_mercargue'), "¿Cargue supervisado con seguridad? :", $rs->Value('ca_merseguridad')));

        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("C"));
        $pdf->Row(array("Concepto para el Cliente"));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(65, 30, 65, 10));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("¿Recomienda Trabajar con esta firma? :", $rs->Value('ca_recomendable'), "¿Refleja operar bajo la Legalida? :", $rs->Value('ca_legalidad')));
        $pdf->Row(array("¿Ofrece algún peligro para Coltrans o Colmas? :", $rs->Value('ca_peligro'), "Explique :", $rs->Value('ca_explicacion')));

        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetWidths(array(170));
        $pdf->SetAligns(array("C"));
        $pdf->Row(array("Actividad"));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetWidths(array(30, 65, 15, 60));
        $pdf->SetAligns(array("L", "L", "L", "L"));
        $pdf->Row(array("Actividad Comercial :", $rs->Value('ca_actividad'), "Estado :", $rs->Value('ca_estado')));

        $rs->MoveNext();
    }

    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 4, "Representante Comercial", 0, 1);
    $pdf->Ln(14);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(0, 4, strtoupper($rs->Value('ca_vendedor_nom')), 0, 1);
    list($anno, $mes, $dia, $tiempo, $minuto, $segundo) = sscanf(date("Y-m-d H:i:s"), "%d-%d-%d %d:%d:%d");
    $pdf->SetFont('Arial', '', 9);
    $pdf->Ln(2);
    $pdf->Cell(0, 4, 'Impresión: ' . $meses[$mes - 1] . ' ' . $dia . ' de ' . $anno . ' ' . $tiempo . ':' . $minuto . ':' . $segundo, 0, 1);
    $pdf->Ln(8);
    $pdf->Output();
    $pdf->Close();
} else if (isset($opcion) and $opcion == 'Ref_sea' and isset($departamento) and isset($modalidad) and isset($origen) and isset($destino) and isset($mes)) {
    if (!$rs->Open("select fun_referencia('$departamento','$modalidad','$origen','$destino','$mes')")) {
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'inosea.php';</script>";
        exit;
    }
    if (!$rs->IsEmpty()) {
        echo "<script>window.parent.frames.llenar_referencia('" . $rs->Value('fun_referencia') . "');</script>";
    }
} else if (isset($opcion) and $opcion == 'see_attachment' and isset($id)) {
    if (isset($novedad)) {
        if (!$rs->Open("select * from tb_colnovedades where ca_idnovedad = $id")) {    // Selecciona todos lo registros de la tabla Clientes
            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
    } else {
        if (!$rs->Open("select * from tb_attachments where ca_idattachment = $id")) {    // Selecciona todos lo registros de la tabla Clientes
            echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
    }

    $extension = $rs->Value('ca_extension');
    $header_file = $rs->Value('ca_header_file');
    $filesize = $rs->Value('ca_filesize');
    $content = pg_unescape_bytea($rs->Value('ca_content'));

    if (!$rs->IsEmpty()) {
        // Determine correct MIME type
        switch ($extension) {
            case "gif": $type = "image/gif";
                break;
            case "jpeg": $type = "image/jpeg";
                break;
            case "jpeg": $type = "image/jpeg";
                break;
            case "jpeg": $type = "image/pjpeg";
                break;
            case "jpg": $type = "image/jpeg";
                break;
            case "jpg": $type = "image/pjpeg";
                break;
            case "tif": $type = "image/tiff";
                break;
            case "tif": $type = "image/x-tiff";
                break;
            case "tiff": $type = "image/tiff";
                break;
            case "tiff": $type = "image/x-tiff";
                break;
            case "asf": $type = "video/x-ms-asf";
                break;
            case "avi": $type = "video/x-msvideo";
                break;
            case "exe": $type = "application/octet-stream";
                break;
            case "pdf": $type = "application/pdf";
                break;
            case "mov": $type = "video/quicktime";
                break;
            case "mp3": $type = "audio/mpeg";
                break;
            case "mpg": $type = "video/mpeg";
                break;
            case "mpeg": $type = "video/mpeg";
                break;
            case "rar": $type = "encoding/x-compress";
                break;
            case "txt": $type = "text/plain";
                break;
            case "wav": $type = "audio/wav";
                break;
            case "wma": $type = "audio/x-ms-wma";
                break;
            case "wmv": $type = "video/x-ms-wmv";
                break;
            case "zip": $type = "application/x-zip-compressed";
                break;
            default: $type = "application/force-download";
                break;
        }

        // Prepare headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public", false);
        header("Content-Description: File Transfer");
        header("Content-Type: " . $type);
        header("Accept-Ranges: bytes");
        header("Content-Disposition: attachment; filename=\"" . $header_file . "\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $filesize);
        echo $content;
        flush();
    }
}
?>