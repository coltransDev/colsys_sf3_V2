<?php
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       FINDREPORTE.PHP                                             \\
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

$titulo = 'Consulta a Maestra de Reportes';
$columnas = array("Nombre del Cliente" => "ca_nombre_cli", "Mis Reportes" => "ca_login", "Nombre del Proveedor" => "ca_nombre_pro", "Número de Reporte" => "ca_consecutivo", "No.Orden Proveedor" => "ca_orden_prov", "No.Orden Cliente" => "ca_orden_clie", "No. Cotización" => "ca_idcotizacion", "Descripción Mercancia" => "ca_mercancia_desc", "Vendedor" => "ca_login");                        // Arreglo con las opciones de busqueda
//$opciones = array("Número de Reporte"=>"ca_consecutivo", "Nombre del Cliente"=>"ca_nombre_cli", "Número de Hbl"=>"ca_doctransporte", "Proveedor"=>"ca_nombre_pro", "No.Orden Proveedor"=>"ca_orden_prov", "No.Orden Cliente"=>"ca_orden_clie", "Naviera"=>"ca_nombre", "Motonave"=>"ca_idnave");                        // Arreglo con las opciones de busqueda
$opciones = array("Número de Reporte" => "ca_consecutivo", "Número de Hbl" => "ca_doctransporte");                        // Arreglo con las opciones de busqueda

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

if (!isset($contents) and !isset($boton) and !isset($accion)) {
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
    echo "<FORM METHOD=post NAME='findReporte' ACTION='findreporte.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=5>";
    $sem_mem = "SELECTED";
    while (list ($clave, $val) = each($columnas)) {
        echo " <OPTION VALUE='" . $val . "' $sem_mem>" . $clave;
        $sem_mem = "";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='contents' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_texts.style.visibility = \"hidden\"; window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} else if (!isset($contents) and !isset($boton) and isset($accion)) {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='findReporte' ACTION='findreporte.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='$referencia'>";
    echo "<INPUT TYPE='HIDDEN' NAME='consecutivo' VALUE='$consecutivo'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=6>";
    $sem_mem = "SELECTED";
    while (list ($clave, $val) = each($opciones)) {
        echo " <OPTION VALUE='" . $val . "' $sem_mem>" . $clave;
        $sem_mem = "";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='contents' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='Consultar' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.findreporte.style.visibility = \"hidden\";window.parent.document.body.scroll=\"yes\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch (trim($boton)) {
        case 'Buscar': {
                $tm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                if (isset($contents) and strlen(trim($contents)) != 0 and !isset($condicion)) {
                    if ($opcion == 'ca_consecutivo' or $opcion == 'ca_nombre_cli' or $opcion == 'ca_nombre_pro' or $opcion == 'ca_orden_prov' or $opcion == 'ca_orden_clie' or $opcion == 'ca_idcotizacion' or $opcion == 'ca_login' or $opcion == 'ca_mercancia_desc') {
                        $condicion = "where lower($opcion) like lower('%" . $contents . "%')";
                    }
                } else {
                    if ($opcion == 'ca_login') {
                        $condicion = "where $opcion = '$usuario'";
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
                echo "function elegir(opcion, nw){";
                echo "    id = window.parent.document.getElementById('id').value;";
                echo "    if (confirm(\"¿Esta seguro que desea importar el reporte \"+document.getElementById(nw + '_consecutivo').value+\"?\")) {";
                echo "    	  top.document.location.href = 'reportenegocio.php?boton='+opcion+'\&id='+id+'\&nw='+nw;";
                echo "    }";
                echo "    window.parent.frames.find_texts.style.visibility = \"hidden\";";
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
                echo "  <TH Class=titulo COLSPAN=4>".COLTRANS."<BR>$titulo</TH>";
                echo "</TR>";
                echo "<TH>ID Reporte</TH>";
                echo "<TH>Versión</TH>";
                echo "<TH>Trayecto</TH>";
                $consecutivo = '';
                while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<INPUT ID=" . $rs->Value('ca_idreporte') . "_consecutivo TYPE='HIDDEN' NAME=" . $rs->Value('ca_idreporte') . "[consecutivo] VALUE=" . $rs->Value('ca_consecutivo') . ">";
                    echo "<TR>";
                    if ($consecutivo <> $rs->Value('ca_consecutivo')) {
                        echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;'>" . $rs->Value('ca_consecutivo') . "</TD>";
                        $consecutivo = $rs->Value('ca_consecutivo');
                        $cadena = (trim(strlen($rs->Value('ca_idproveedor'))) != 0) ? "ca_idtercero in (" . str_replace("|", ",", $rs->Value('ca_idproveedor')) . ")" : "false";
                        if (!$tm->Open("select * from vi_terceros where $cadena")) {
                            echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                        $tm->MoveFirst();
                        $ordenes = array_combine(explode("|", $rs->Value('ca_idproveedor')), explode("|", $rs->Value('ca_orden_prov')));
                        while (!$tm->Eof()) {
                            $sub_str = "<TR>";
                            $sub_str.= "<TD Class=listar COLSPAN=2><B>Orden:</B> " . $ordenes[$tm->Value('ca_idtercero')] . "</TD><TD Class=listar COLSPAN=5><B>Proveedor:</B> " . $tm->Value('ca_nombre') . "</TD>";
                            $sub_str.= "</TR>";
                            $tm->MoveNext();
                        }
                    } else {
                        echo "  <TD Class=listar ROWSPAN=2></TD>";
                    }
                    echo "  <TD Class=listar ROWSPAN=2 onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick=\"javascript:elegir('Editar','" . $rs->Value('ca_idreporte') . "')\">No.&nbsp" . $rs->Value('ca_version') . "</TD>";
                    echo "  <TD Class=listar style='font-weight:bold;'>" . $rs->Value('ca_nombre_cli') . " (" . $rs->Value('ca_transporte') . " - " . $rs->Value('ca_modalidad') . ") " . ucwords(strtolower($rs->Value('ca_nombre'))) . "</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo " <TD Class=listar>";
                    echo "  <TABLE WIDTH=500 CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>Fch.Despacho</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>T.Incoterms</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>Cotización</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_ciuorigen') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_traorigen') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_ciudestino') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_tradestino') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_fchdespacho') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_incoterms') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_idcotizacion') . "</TD>";
                    echo "  </TR>";
                    echo $sub_str;
                    echo "  </TABLE>";
                    echo " </TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=invertir COLSPAN=4></TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                }
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"findreporte.php\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//			echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
        case 'Consultar': {
                $tm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                $im = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$im->Open("select ca_traorigen, ca_ciudestino, ca_modalidad, ca_idlinea from vi_inomaestra_sea where ca_referencia = '$id'")) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"" . addslashes($im->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $condicion = "ca_traorigen = '" . $im->Value('ca_traorigen') . "' and ca_ciudestino = '" . $im->Value('ca_ciudestino') . "' and ca_modalidad = '" . $im->Value('ca_modalidad') . "'";
                if (isset($contents) and strlen(trim($contents)) != 0) {
                    if ($opcion == 'ca_consecutivo' or $opcion == 'ca_nombre_cli' or $opcion == 'ca_nombre_pro' or $opcion == 'ca_orden_prov' or $opcion == 'ca_orden_clie' or $opcion == 'ca_nombre' or $opcion == 'ca_idnave' or $opcion == 'ca_doctransporte') {
                        $condicion.= " and lower($opcion) like lower('%" . $contents . "%')";
                    }
                }
                $command = "select rp.ca_idreporte, rp.ca_consecutivo, re.ca_referencia, rp.ca_version, rf.ca_idemail, rp.ca_idcliente, rp.ca_idalterno, rp.ca_idclientefac, rp.ca_nombre_cli, rp.ca_idconsignatario, rp.ca_identificacion_con, rp.ca_orden_clie, rp.ca_transporte, rp.ca_modalidad, rp.ca_nombre, rp.ca_ciuorigen, rp.ca_traorigen, rp.ca_ciudestino,";
                $command.= "  rp.ca_tradestino, rp.ca_fchdespacho, rp.ca_incoterms, rp.ca_idcotizacion, rp.ca_idproveedor, rp.ca_orden_prov, rp.ca_continuacion, rp.ca_continuacion_dest, rp.ca_final_dest, rp.ca_idconsignar, rp.ca_idbodega, rp.ca_login, ra.ca_idemail, ra.ca_idnave, ra.ca_doctransporte, ra.ca_piezas, ra.ca_peso, ra.ca_volumen from vi_reportes rp";
                $command.= "  RIGHT JOIN (select ca_consecutivo as ca_consecutivo_f, max(ca_idreporte) as ca_idreporte from tb_reportes where ca_usuanulado IS NULL and ca_transporte in ('Marítimo','Terrestre') group by ca_consecutivo_f) rx ON (rp.ca_idreporte = rx.ca_idreporte)";
                $command.= "  LEFT JOIN (select srp.ca_consecutivo as ca_consecutivo_r, sic.ca_referencia from tb_reportes srp INNER JOIN tb_inoclientes_sea sic ON srp.ca_idreporte = sic.ca_idreporte) re ON (rp.ca_consecutivo = re.ca_consecutivo_r)";
                $command.= "  LEFT JOIN (select ca_consecutivo as ca_consecutivo_n from tb_reportes srp INNER JOIN tb_inoclientes_sea sic ON srp.ca_idreporte = sic.ca_idreporte) ns ON (rp.ca_consecutivo = ns.ca_consecutivo_n and ns.ca_consecutivo_n IS NULL)";
                $command.= "  LEFT JOIN (select rpt.ca_consecutivo as ca_consecutivo_f, max(rpa.ca_idemail) as ca_idemail from tb_reportes rpt, tb_repstatus rpa where rpt.ca_usuanulado IS NULL and rpt.ca_idreporte = rpa.ca_idreporte group by ca_consecutivo_f) rf ON (rp.ca_consecutivo = rf.ca_consecutivo_f)";
                $command.= "  LEFT JOIN tb_repstatus ra ON (ra.ca_idemail = rf.ca_idemail)";
                $command.= "  where $condicion order by rp.ca_idreporte DESC";

                if (!$rs->Open("$command")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }

                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                echo "function seleccion(i) {";
                echo "    source = document.getElementById('idcliente_'+i);";
                echo "    elemento = window.parent.document.getElementById('idcliente');";
                echo "  if (elemento.value.length != 0 && elemento.value != source.value){";
                echo "    	alert('Error - El número de Nit del Reporte no corresponde con el Nit de la Referencia!');";
                echo "    	return;";
                echo "    }else if (document.getElementById('idconsignatario_'+i).value != '' && document.getElementById('identificacion_'+i).value == '') {";
                echo "    	alert('Error - El reporte de negocio tiene definido un Consignatario pero NO su número de Nit!');";
                echo "    	return;";
                echo "    }else{";
                echo "    	elemento.value = source.value;";
                echo "    }";
                echo "    source = document.getElementById('idalterno_'+i);";
                echo "    elemento = window.parent.document.getElementById('idalterno');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('idreporte_'+i);";
                echo "    elemento = window.parent.document.getElementById('idreporte');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('consecutivo_'+i);";
                echo "    elemento = window.parent.document.getElementById('consecutivo');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('idproveedor_'+i);";
                echo "    elemento = window.parent.document.getElementById('idproveedor');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('proveedor_'+i);";
                echo "    elemento = window.parent.document.getElementById('proveedor');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('nombre_con_'+i);";
                echo "    elemento = window.parent.document.getElementById('cliente');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('hbls_'+i);";
                echo "    if (source.value.length > 1){";
                echo "    	elemento = window.parent.document.getElementById('hbls');";
                echo "    	if (elemento.value.length == 0){";
                echo "    		elemento.value = source.value;";
                echo "    	}";
                echo "    }";
                echo "    source = document.getElementById('numpiezas_'+i);";
                echo "    if (source.value.length >= 1){";
                echo "    	elemento = window.parent.document.getElementById('numpiezas');";
                echo "    	elemento.value = source.value;";
                echo "    }";
                echo "    source = document.getElementById('peso_'+i);";
                echo "    if (source.value.length >= 1){";
                echo "    	elemento = window.parent.document.getElementById('peso');";
                echo "    	elemento.value = source.value;";
                echo "    }";
                echo "    source = document.getElementById('volumen_'+i);";
                echo "    if (source.value.length >= 1){";
                echo "    	elemento = window.parent.document.getElementById('volumen');";
                echo "    	elemento.value = source.value;";
                echo "    }";
                echo "    source = document.getElementById('numorden_'+i);";
                echo "    elemento = window.parent.document.getElementById('numorden');";
                echo "    elemento.value = source.value;";
                echo "    source = document.getElementById('continuacion_'+i);";
                echo "    window.parent.elegir_item('continuacion',source.value);";
                echo "    habilita = (source.value != 'N/A')?false:true;";
                echo "    source = document.getElementById('continuacion_dest_'+i);";
                echo "    if(!habilita)"
                   . "      window.parent.elegir_item('continuacion_dest',source.value);";
                echo "    elemento = window.parent.document.getElementById('continuacion_dest');";
                echo "    elemento.disabled = habilita;";
                echo "    if(document.getElementById('continuacion_'+i).value != 'DTA'){";
                echo "      source = document.getElementById('idbodega_'+i);";
                echo "      window.parent.elegir_item('idbodega',source.value);";
                echo "    }";
                echo "    source = document.getElementById('login_'+i);";
                echo "    window.parent.elegir_item('login',source.value);";
                echo "    window.parent.frames.findreporte.style.visibility = \"hidden\";";
                echo "    window.parent.document.body.scroll=\"yes\";";
                echo "    window.parent.valida_cantidades();";
                echo "    if (isNaN(window.parent.document.getElementById('client_lupa'))) {";
                echo "    	window.parent.document.getElementById('client_lupa').style.visibility = \"hidden\";";
                echo "    }";
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
                echo "<TABLE WIDTH=100% CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=4>".COLTRANS."<BR>$titulo</TH>";
                echo "</TR>";
                echo "<TH>ID Reporte</TH>";
                echo "<TH>Trayecto</TH>";
                $consecutivo = '';
                $i = 0;
                while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    if ($consecutivo <> $rs->Value('ca_consecutivo')) {
                        $i++;
                        $ref_use = ($rs->Value('ca_referencia') != "") ? "<br/><br/>Usado en Ref.:<br/>" . $rs->Value('ca_referencia') : "";
                        echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' " . (($rs->Value('ca_referencia') == "" or $rs->Value('ca_referencia') == $id) ? "onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick=\"javascript:seleccion($i)\"" : "") . ">" . $rs->Value('ca_consecutivo') . "$ref_use</TD>";
                        $consecutivo = $rs->Value('ca_consecutivo');
                        $cadena = (trim(strlen($rs->Value('ca_idproveedor'))) != 0) ? "ca_idtercero in (" . str_replace("|", ",", $rs->Value('ca_idproveedor')) . ")" : "false";
                        if (!$tm->Open("select * from vi_terceros where $cadena")) {
                            echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                        $tm->MoveFirst();
                        $proveedor = '';
                        $ordenes = array_combine(explode("|", $rs->Value('ca_idproveedor')), explode("|", $rs->Value('ca_orden_prov')));
                        while (!$tm->Eof()) {
                            $proveedor.= $tm->Value('ca_nombre') . ", ";
                            $sub_str = "<TR>";
                            $sub_str.= "<TD Class=listar COLSPAN=7><B>Proveedor:</B> " . $tm->Value('ca_nombre') . "</TD>";
                            $sub_str.= "</TR>";
                            // <TD Class=listar COLSPAN=5><B>Orden:</B> ".$ordenes[$tm->Value('ca_idtercero')]."</TD>
                            $tm->MoveNext();
                        }
                        $proveedor = substr($proveedor, 0, strlen($proveedor) - 2);
                    } else {
                        echo "  <TD Class=listar ROWSPAN=2></TD>";
                    }
                    
                    $nit = intval(preg_replace('/[^0-9]+/', '', $rs->Value('ca_identificacion_con')), 10);
                    $sql = "select ca_idbodega, ca_nombre from tb_bodegas where ca_transporte = 'Marítimo' and ca_tipo = 'Operador Multimodal' and regexp_replace(ca_nombre, '[^0-9]+', '', 'g') like '%$nit%'";
                    if (!$tm->Open($sql)) {
                        echo "<script>alert(\"" . addslashes($tm->mErrMsg) . "\");</script>";
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    $tm->MoveFirst();

                    echo "  <TD Class=listar style='font-weight:bold;'>" . $rs->Value('ca_nombre_cli') . " (" . $rs->Value('ca_transporte') . " - " . $rs->Value('ca_modalidad') . ") " . ucwords(strtolower($rs->Value('ca_nombre'))) . "</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo " <TD Class=listar>";
                    echo "  <TABLE WIDTH=100% CELLSPACING=1>";

                    $piezas = $rs->Value('ca_piezas');
                    if (strlen($piezas) != 0) {
                        if (strpos($piezas, ".") === true) {
                            $pattern = "([0-9]{1,6})?([.]{1})?([0-9]{1,6}())?( )?";
                        } else {
                            $pattern = "([0-9]{1,6})";                         // Expresion Regular que Extrael el valor numerico de las piezas
                        }
                        //$pattern = "[-+]?\b[0-9]*\.?[0-9]+\b";
                        if (ereg($pattern, trim($piezas), $regs)) {
                            $piezas = $regs[0];
                        }
                    } else {
                        $piezas = 0;
                    }
                    $peso = $rs->Value('ca_peso');     // Expresion Regular que Extrael el valor numerico de las peso
                    if (strlen($peso) != 0) {
                        $pattern = "([0-9]{1,6})?([.]{1})?([0-9]{1,6}())?( )?";
                        if (ereg($pattern, trim($peso), $regs)) {
                            $peso = $regs[0];
                        }
                    } else {
                        $peso = 0;
                    }
                    $volumen = $rs->Value('ca_volumen');    // Expresion Regular que Extrael el valor numerico del volumen
                    if (strlen($volumen) != 0) {
                        $pattern = "([0-9]{1,6})?([.]{1})?([0-9]{1,6}())?( )?";
                        if (ereg($pattern, trim($volumen), $regs)) {
                            $volumen = $regs[0];
                        }
                    } else {
                        $volumen = 0;
                    }

                    echo "  <INPUT ID=consecutivo_$i TYPE='HIDDEN' NAME='consecutivo_$i' VALUE='" . $rs->Value('ca_consecutivo') . "'>";
                    if ($rs->Value('ca_idclientefac') != "") {
                        echo "  <INPUT ID=idcliente_$i TYPE='HIDDEN' NAME='idcliente_$i' VALUE='" . $rs->Value('ca_idclientefac') . "'>";
                    } else {
                        echo "  <INPUT ID=idcliente_$i TYPE='HIDDEN' NAME='idcliente_$i' VALUE='" . $rs->Value('ca_idcliente') . "'>";
                    }
                    echo "  <INPUT ID=idalterno_$i TYPE='HIDDEN' NAME='idalterno_$i' VALUE='" . $rs->Value('ca_idalterno') . "'>";
                    echo "  <INPUT ID=nombre_con_$i TYPE='HIDDEN' NAME='nombre_con_$i' VALUE='" . $rs->Value('ca_nombre_cli') . "'>";
                    echo "  <INPUT ID=hbls_$i TYPE='HIDDEN' NAME='hbls_$i' VALUE='" . $rs->Value('ca_doctransporte') . "'>";
                    echo "  <INPUT ID=numpiezas_$i TYPE='HIDDEN' NAME='numpiezas_$i' VALUE='$piezas'>";
                    echo "  <INPUT ID=peso_$i TYPE='HIDDEN' NAME='peso_$i' VALUE='$peso'>";
                    echo "  <INPUT ID=volumen_$i TYPE='HIDDEN' NAME='volumen_$i' VALUE='$volumen'>";
                    echo "  <INPUT ID=numorden_$i TYPE='HIDDEN' NAME='numorden_$i' VALUE='" . $rs->Value('ca_orden_clie') . "'>";
                    echo "  <INPUT ID=idreporte_$i TYPE='HIDDEN' NAME='idreporte_$i' VALUE='" . $rs->Value('ca_idreporte') . "'>";
                    echo "  <INPUT ID=idproveedor_$i TYPE='HIDDEN' NAME='idproveedor_$i' VALUE='" . $rs->Value('ca_idproveedor') . "'>";
                    echo "  <INPUT ID=idconsignatario_$i TYPE='HIDDEN' NAME='idconsignatario_$i' VALUE='" . $rs->Value('ca_idconsignatario') . "'>";
                    echo "  <INPUT ID=identificacion_$i TYPE='HIDDEN' NAME='identificacion_$i' VALUE='" . $rs->Value('ca_identificacion_con') . "'>";
                    echo "  <INPUT ID=proveedor_$i TYPE='HIDDEN' NAME='proveedor_$i' VALUE='$proveedor'>";
                    echo "  <INPUT ID=continuacion_$i TYPE='HIDDEN' NAME='continuacion_$i' VALUE='" . $rs->Value('ca_continuacion') . "'>";
                    echo "  <INPUT ID=continuacion_dest_$i TYPE='HIDDEN' NAME='continuacion_dest_$i' VALUE='" . $rs->Value('ca_continuacion_dest') . "'>";

                    if ($rs->Value('ca_continuacion') != 'N/A' and $rs->Value('ca_idconsignar') == 1) {
                        echo "  <INPUT ID=idbodega_$i TYPE='HIDDEN' NAME='idbodega_$i' VALUE='" . $tm->Value('ca_idbodega') . "'>";
                    } else {
                        echo "  <INPUT ID=idbodega_$i TYPE='HIDDEN' NAME='idbodega_$i' VALUE='" . $rs->Value('ca_idconsignar') . "'>";
                    }

                    echo "  <INPUT ID=login_$i TYPE='HIDDEN' NAME='login_$i' VALUE='" . $rs->Value('ca_login') . "'>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>Fch.Despacho</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>T.Incoterms</TD>";
                    echo "    <TD Class=invertir style='font-weight:bold;'>Cotización</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_ciuorigen') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_traorigen') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_ciudestino') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_tradestino') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_fchdespacho') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_incoterms') . "</TD>";
                    echo "    <TD Class=listar>" . $rs->Value('ca_idcotizacion') . "</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar><b>Cont.Viaje: </b><br />" . $rs->Value('ca_continuacion') . "</TD>";
                    echo "    <TD Class=listar><b>Destino: </b><br />" . (($rs->Value('ca_continuacion') != 'N/A') ? $rs->Value('ca_final_dest') : '') . "</TD>";
                    echo "    <TD Class=invertir><b>Hbl's:</b><br />" . $rs->Value('ca_doctransporte') . "</TD>";
                    echo "    <TD Class=invertir><b>Piezas:</b><br />$piezas</TD>";
                    echo "    <TD Class=invertir><b>Peso:</b><br />$peso</TD>";
                    echo "    <TD Class=invertir><b>Volumen:</b><br />$volumen</TD>";
                    echo "    <TD Class=invertir><b>Vendedor:</b><br />" . $rs->Value('ca_login') . "</TD>";
                    echo "  </TR>";
                    echo $sub_str;
                    echo "  </TABLE>";
                    echo " </TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=divisor COLSPAN=4></TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                }
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"findreporte.php?opcion=find_reporte\&accion=Marítimo\&consecutivo=$consecutivo\&referencia=$id\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//			echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
    }
}
?>