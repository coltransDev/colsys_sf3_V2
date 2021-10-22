<?php

/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       COMISIONES.PHP                                              \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Reporte de Comisiones para Vendedores.                      \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */

$titulo = 'Cuadro de Comisiones para Vendedores';
$meses = array("%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
$comisiones = array("Sin Comisionar" => "(case when ca_vlrcomisiones <> 0 then ca_vlrcomisiones else 0 end) = 0 and (case when ca_sbrcomisiones <> 0 then ca_sbrcomisiones else 0 end) = 0", "Sólo Comisionados" => "(ca_vlrcomisiones <> 0 or ca_sbrcomisiones <> 0)", "Todos los Casos" => "");
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"", "Cierre Provisional" => "ca_estado = \"Provisional\"", "Casos Abiertos" => "ca_estado = \"Abierto\"", "Todos los Casos" => "");
$months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");

$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
$cm = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

if (!isset($boton) and !isset($accion) and !isset($buscar)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='comisiones.php'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";
    $sql="select DISTINCT c.ca_comprobante, c.ca_fchliquidacion from tb_inocomisiones_sea c, tb_inoclientes_sea i where c.ca_idinocliente = i.ca_idinocliente and i.ca_login = '$usuario' order by c.ca_comprobante DESC";
    if (!$rs->Open($sql)) {
        echo "Error 47: $sql";
        //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
    for ($i = 5; $i >= 0; $i--) {
        echo " <OPTION VALUE=" . (date('Y') - $i) . " SELECTED>" . (date('Y') - $i) . "</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m') == $clave) {
            echo" SELECTED";
        }
        echo ">$val</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Nombre del Cliente:<BR><INPUT TYPE='text' NAME='compania' size='40'></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Comisiones:<BR><SELECT NAME='comision'>";
    while (list ($clave, $val) = each($comisiones)) {
        echo " <OPTION VALUE='" . $val . "'>" . $clave;
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Estado:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each($estados)) {
        echo " <OPTION VALUE='" . $val . "'>" . $clave;
    }
    echo "  </SELECT></TD>";

    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH><B>Cuadro de Comprobantes de Comisiones Cobradas</TH>";

    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR>";
        echo "  <TD Class=mostrar><A HREF='comision.php?id=" . $rs->Value('ca_comprobante') . "' TARGET='_blank'>Comprobante No.: " . $rs->Value('ca_comprobante') . "&nbsp;&nbsp;de Fecha : " . $rs->Value('ca_fchliquidacion') . "</A></TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (!isset($boton) and !isset($accion) and isset($buscar)) {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    $compania = (strlen($compania) != 0) ? "and lower(ca_compania) like lower('%$compania%')" : "";
    $casos = (strlen($casos) != 0) ? "and " . str_replace("\"", "'", $casos) : "";
    $comision = (strlen($comision) != 0) ? "and " . $comision : "";
    $condicion = "ca_mes like '$mes' and ca_ano = '$ano'  $compania and ca_login like '$usuario' $casos $comision";
    //echo "select * from vi_inocomisiones_sea where $condicion";
//        exit;
    $sql="select * from vi_inocomisiones_sea where $condicion";
    if (!$rs->Open($sql)) {
        echo "Error 123: $sql";
        //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    $us = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl) {";
    echo "    document.location.href = 'comisiones.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='comisiones.php'>";          // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                              // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=10>" . COLTRANS . "<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>Hbl</TH>";
    echo "<TH>Termino Neg.</TH>";
    echo "<TH>Vlr Facturado</TH>";
    echo "<TH>Estado</TH>";
    echo "<TH>Volumen CMB</TH>";
    echo "<TH>Utilidad</TH>";
    echo "<TH COLSPAN=2>Util. en Sobreventa</TH>";
    $log_ven = '';
    $ref_mem = '';
    $nom_cli = '';
    $hbl_cli = '';
    $utl_tot = 0;
    $sob_tot = 0;
    $con_tot = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
        $utl_mem = ($rs->Value('ca_vlrutilidad_liq') != 0)?$rs->Value('ca_vlrutilidad_liq'):$rs->Value('ca_volumen') * $utl_cbm;
        if ($log_ven != $rs->Value('ca_login')) {
            if (!$us->Open("select ca_nombre from control.tb_usuarios where ca_login = '" . $rs->Value('ca_login') . "'")) {
                echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
                echo "<script>document.location.href = 'comisiones.php';</script>";
                exit;
            }
            echo "<TR>";
            echo "  <TD Class=listar COLSPAN=10 style='font-weight:bold; font-size: 10px;'>" . strtoupper($us->Value('ca_nombre')) . "</TD>";
            echo "</TR>";
            $utl_con = 0;
            $sob_ven = 0;
            $log_ven = $rs->Value('ca_login');
            $nom_ven = $us->Value('ca_nombre');
        }
        $back_col = ($rs->Value('ca_estado') == 'Provisional') ? " background: #CCCC99" : (($rs->Value('ca_estado') == 'Abierto') ? " background: #CCCCCC" : " ");
        $back_col = ($utl_cbm <= 0) ? " background: #FF6666" : $back_col;
        echo "<TR>";
        echo "  <TD Class=listar  style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'" . substr($back_col, 14, 6) . "');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=" . $rs->Value('ca_referencia') . "\");'>" . $rs->Value('ca_referencia') . "</TD>";
        echo "  <TD Class=listar  style='font-size: 9px;$back_col'>" . substr(ucwords(strtolower($rs->Value('ca_compania'))), 0, 30) . "</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>" . $rs->Value('ca_hbls') . "</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>" . $rs->Value('ca_incoterms') . "</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>" . number_format($rs->Value('ca_valor')) . "</TD>";
        echo "  <TD Class=listar  style='font-size: 9px;$back_col'>" . $rs->Value('ca_estado') . "</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>" . $rs->Value('ca_volumen') . "</TD>";
        echo "  <TD Class=valores style='font-size: 9px;$back_col'>" . number_format($utl_mem) . "</TD>";
        $ref_mem = $rs->Value('ca_referencia');
        $nom_cli = $rs->Value('ca_compania');
        $hbl_cli = $rs->Value('ca_hbls');
        $utl_con+= $utl_mem;
        $mul_lin = false;
        $arr_fac = array();
        while ($ref_mem == $rs->Value('ca_referencia') and $nom_cli == $rs->Value('ca_compania') and $hbl_cli == $rs->Value('ca_hbls') and !$rs->Eof()) {
            $imp_mem = (in_array($rs->Value('ca_factura_ded'), $arr_fac)) ? false : true;
            if ($imp_mem and $mul_lin) {
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=8>&nbsp;</TD>";
            }
            if ($imp_mem and $rs->Value('ca_valor_ded') != 0) {
                echo "  <TD Class=listar style='font-size: 9px;'>" . str_replace(" ", "&nbsp;", "&nbsp;" . $rs->Value('ca_costo_ded')) . "</TD>";
                echo "  <TD Class=valores style='font-size: 9px;'>" . number_format($rs->Value('ca_valor_ded')) . "</TD>";
                $sob_ven+= $rs->Value('ca_valor_ded');
                array_push($arr_fac, $rs->Value('ca_factura_ded'));
                $mul_lin = true;
            } else if ($imp_mem) {
                echo "  <TD Class=listar>&nbsp;</TD>";
                echo "  <TD Class=listar>&nbsp;</TD>";
                array_push($arr_fac, $rs->Value('ca_factura_ded'));
            }
            $rs->MoveNext();
        }
        echo "</TR>";
        if ($log_ven != $rs->Value('ca_login') or $rs->Eof()) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=10></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=7>Totales por Vendedor :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>" . number_format($utl_con) . "</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>&nbsp;Sobreventa :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;" . number_format($sob_ven) . "</TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=10></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=7>Comisión en Ventas :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>" . number_format($utl_con * $rs->Value('ca_porcentaje') / 100) . "</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>&nbsp;Com. Sobreventa :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;" . number_format($sob_ven * $rs->Value('ca_porcentaje') / 100) . "</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=9>Gran Total para " . ucwords(strtolower($nom_ven)) . " :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>" . number_format(($utl_con * $rs->Value('ca_porcentaje') / 100) + ($sob_ven * $rs->Value('ca_porcentaje') / 100)) . "</TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=10></TD>";
            echo "</TR>";
            $utl_tot+= $utl_con;
            $sob_tot+= $sob_ven;
        }
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=10></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=10></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=7>Totales del Informe:</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>" . number_format($utl_tot) . "</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;Total Sobreventa:</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>" . number_format($sob_tot) . "</TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=10></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Liquidar Comisiones' ONCLICK='javascript:document.location.replace(\"comisiones.php?boton=" . base64_encode('Liquidar') . "&var=" . base64_encode($ano) . "\")'></TH>";         // Ordena almacenar los datos ingresados
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"comisiones.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    $boton = base64_decode($boton);
    switch (trim($boton)) {
        case 'Liquidar': {                                          // Opcion para Liquidar Comisiones
                setcookie("control", TRUE, time() + 3600);     //* expire in 1 hour */
                $modulo = "00100100";                                              // Identificación del módulo para la ayuda en línea
//          include_once 'include/seguridad.php';                              // Control de Acceso al módulo

                $ano = base64_decode($var);
                $annos_mem = '';
                for ($i = $ano; $i >= $ano - 2; $i--) {
                    $annos_mem.="'" . substr($i, -2) . "',";
                }
                
                $annos_mem = substr($annos_mem, 0, strlen($annos_mem) - 1);
                $condicion = "substr(ca_referencia,16,2)::text in ($annos_mem) and ca_login like '$usuario' and ca_estado <> 'Abierto' ";
                //$condicion = "(string_to_array('ca_referencia','.'))[5]::text in ($annos_mem) and ca_login like '$usuario' and ca_estado <> 'Abierto' ";
                
                $condicion.= "and (CASE WHEN ca_observaciones = 'Contenedores' and ca_fchpago is not null or ca_observaciones != 'Contenedores' THEN true ELSE false END)";
                $sql="select * from vi_inoingresos_sea where $condicion";
                if (!$rs->Open($sql)) {
                    echo "Error 301: $sql";
                    //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'entrada.php';</script>";
                    exit;
                }
                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";           // Código en JavaScript para validar las opciones de mantenimiento
                echo "function habilitar(campo){";
                echo "  cadena = campo.getAttribute('ID');";
                echo "  indice = cadena.substring(0, cadena.indexOf('_'));";            //, cadena.length
                echo "  elemento = document.getElementById('CHK_'+indice);";
                echo "  circular = document.getElementById('CIR_'+indice);";
                echo "  i = 0;";
                echo "  check = true;";
                echo "  while (isNaN(document.getElementById(indice+'_'+i))) {";
                echo "     objeto = document.getElementById(indice+'_'+i);";
                echo "     if (objeto.value == '' || circular.value != 'Vigente') {";
                echo "        check = false;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  elemento.checked = check;";
                echo "  elemento.style.visibility = (check)?\"visible\":\"hidden\";";
                echo "  sumarizar(document.informe);";
                echo "}";
                echo "function sumarizar(forma){";
                echo "  if (!isNaN(document.getElementById('TOT_vlr'))){;";
                echo "     return;";
                echo "  }";
                echo "  document.getElementById('TOT_vlr').value = 0;";
                echo "  document.getElementById('TOT_sbr').value = 0;";
                echo "  document.getElementById('GRN_tot').value = 0;";
                echo "  for (cont=0; cont<forma.elements.length; cont++){";
                echo "     nombre = forma.elements[cont].name.substring(0, 4);";
                echo "     if (nombre = 'CHK_'){";
                echo "        if (forma.elements[cont].checked){";
                echo "           cadena = forma.elements[cont].getAttribute('ID');";
                echo "           indice = cadena.substring(cadena.indexOf('_')+1);";
                echo "           vlrcomision = document.getElementById('VLR_'+indice);";
                echo "           sbrcomision = document.getElementById('SBR_'+indice);";
                echo "           document.getElementById('TOT_vlr').value = Math.round(document.getElementById('TOT_vlr').value) + Math.round(vlrcomision.value);";
                echo "           document.getElementById('TOT_sbr').value = Math.round(document.getElementById('TOT_sbr').value) + Math.round(sbrcomision.value);";
                echo "           document.getElementById('GRN_tot').value = eval(document.getElementById('TOT_vlr').value) + eval(document.getElementById('TOT_sbr').value);";
                echo "        }";
                echo "     }";
                echo "  }";
                echo "}";
                echo "function procesar()";
                echo "{";
                echo "  if (confirm(\"¿Esta seguro de Registrar el Cobro de Comisiones?\")){";
                // echo "   document.location.replace('comisiones.php?accion=" . base64_encode('Registrar') . "');";
                echo "      document.informe.submit();";            // Submit the page
                echo "  }";
                echo "}";
                echo "function imprimir(id)";
                echo "{";
                echo "  document.informe.id.value = id;";
                echo "  document.informe.action = 'comision.php';";
                echo "  document.informe.target = '_blank';";   // Open in a new window
                echo "  document.informe.submit();";            // Submit the page
                echo "  return true;";
                echo "}";
                echo "function negativo(campo)";
                echo "{";
                echo "  cadena = campo.getAttribute('ID');";
                echo "  indice = cadena.substring(cadena.indexOf('_')+1);";
                echo "  venta = document.getElementById('VLR_'+indice).value;";
                echo "  if (venta < 0)";
                echo "      campo.checked = true;";
                echo "  sbrvt = document.getElementById('SBR_'+indice).value;";
                echo "  if (sbrvt < 0)";
                echo "      campo.checked = true;";
                echo "  return;";
                echo "}";
                echo "function elegir(opcion, id, cl) {";
                echo "    document.location.href = 'comisiones.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
                echo "}";
                echo "function uno(src,color_entrada) {";
                echo "    src.style.background=color_entrada;src.style.cursor='hand'";
                echo "}";
                echo "function dos(src,color_default) {";
                echo "    src.style.background=color_default;src.style.cursor='default';";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<FORM METHOD=post NAME='informe' ACTION='comisiones.php' ONSUBMIT='return confirm(\"¿Esta seguro de Registrar el Cobro de Comisiones?\")'>";             // Hace una llamado nuevamente a este script pero con
                echo "<INPUT TYPE='HIDDEN' NAME='id'>";
                echo "<INPUT TYPE='HIDDEN' NAME='accion' VALUE='" . base64_encode('Registrar') . "'>";
                echo "<TABLE CELLSPACING=1>";                                              // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=9>" . COLTRANS . "<BR>$titulo<BR>$ano</TH>";
                echo "</TR>";
                echo "<TH>Referencia</TH>";
                echo "<TH>Hbls</TH>";
                echo "<TH>Termino Neg.</TH>";
                echo "<TH>Factura</TH>";
                echo "<TH>Fch.Factura</TH>";
                echo "<TH>Vlr.Facturado</TH>";
                echo "<TH>Rec.Caja</TH>";
                echo "<TH>Fch.Pago</TH>";
                echo "<TH>Com.Causada</TH>";
                $nom_cli = '';
                while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
                    $utl_net = ($rs->Value('ca_vlrutilidad_liq') != 0) ? $rs->Value('ca_vlrutilidad_liq') : $rs->Value('ca_volumen') * $utl_cbm;
                    $com_cas = round($utl_net * $rs->Value('ca_porcentaje') / 100, 0);
                    $com_sbr = round($rs->Value('ca_sbrcomision') * $rs->Value('ca_porcentaje') / 100, 0);
                    if ($com_cas - $rs->Value('ca_vlrcomisiones') == 0 and $com_sbr - $rs->Value('ca_sbrcomisiones') == 0) {
                        $rs->MoveNext();
                        continue;
                    }
                    $back_col = ($rs->Value('ca_estado') == 'Provisional') ? " background: #CCCC99" : (($rs->Value('ca_estado') == 'Abierto') ? " background: #CCCCCC" : " ");
                    $back_col = ($utl_cbm <= 0) ? " background: #FF6666" : $back_col;
                    if ($rs->Value('ca_compania') != $nom_cli) {
                        echo "<TR>";
                        echo "  <TD Class=invertir style='font-weight:bold; font-size: 9px;' COLSPAN=8>" . $rs->Value('ca_compania') . "</TD>";
                        echo "  <TD Class=invertir WIDTH=140>";
                        echo "    <TABLE CELLSPACING=1>";
                        echo "    <TR>";
                        echo "     <TD Class=listar WIDTH=50>Corriente</TD>";
                        echo "     <TD Class=listar WIDTH=50>Sobre/Vta</TD>";
                        echo "     <TD Class=listar>Pedir</TD>";
                        echo "    <TR>";
                        echo "    </TABLE>";
                        echo "  </TD>";
                        echo "</TR>";
                        $nom_cli = $rs->Value('ca_compania');
                        $num_ref = '';
                        $num_hbl = '';
                    }
                    echo "<TR>";
                    if ($num_ref != $rs->Value('ca_referencia')) {
                        echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'" . substr($back_col, 14, 6) . "');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=" . $rs->Value('ca_referencia') . "\");'>" . $rs->Value('ca_referencia') . "</TD>";
                        $num_ref = $rs->Value('ca_referencia');
                    } else {
                        echo "  <TD Class=listar></TD>";
                    }
                    if ($num_hbl != $rs->Value('ca_hbls')) {
                        echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_hbls') . "</TD>";
                        $num_hbl = $rs->Value('ca_hbls');
                        $num_oid = $rs->Value('ca_oid');
                        $rec_com = true;
                        $j = 0;
                    } else {
                        echo "  <TD Class=listar></TD>";
                    }
                    echo "  <TD Class=listar  WIDTH=50 style='font-size: 9px;$back_col'>" . $rs->Value('ca_incoterms') . "</TD>";
                    echo "  <TD Class=listar  WIDTH=50 style='font-size: 9px;$back_col'>" . $rs->Value('ca_factura') . "</TD>";
                    echo "  <TD Class=listar  WIDTH=70 style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchfactura') . "</TD>";
                    echo "  <TD Class=valores WIDTH=75 style='font-size: 9px;$back_col'>" . number_format($rs->Value('ca_valor')) . "</TD>";
                    echo "  <TD Class=listar  WIDTH=75><INPUT ID=" . $num_oid . "_" . $j . " TYPE='hidden' NAME='reccaja[" . $rs->Value('ca_oid') . "][recibo]' VALUE='" . $rs->Value('ca_reccaja') . "' SIZE=13 MAXLENGTH=15 READONLY>" . $rs->Value('ca_reccaja') . "</TD>";
                    echo "  <TD Class=listar  WIDTH=75><INPUT TYPE='hidden' NAME='reccaja[" . $rs->Value('ca_oid') . "][fchpago]' SIZE=12 VALUE='" . $rs->Value('ca_fchpago') . "' READONLY>" . $rs->Value('ca_fchpago') . "</TD>";
                    if ($rec_com) {
                        echo "  <TD Class=invertir WIDTH=140>";
                        echo "    <TABLE CELLSPACING=1>";
                        echo "    <TR>";
                        echo "     <TD Class=valores WIDTH=50 style='font-size: 9px;$back_col'>" . number_format($com_cas - $rs->Value('ca_vlrcomisiones')) . "</TD>";
                        echo "     <TD Class=valores WIDTH=50 style='font-size: 9px;$back_col'>" . number_format($com_sbr - $rs->Value('ca_sbrcomisiones')) . "</TD>";
                        echo "     <TD Class=valores style='font-size: 9px;$back_col'>" . (($rs->Value('ca_stdcircular') != "Vigente") ? "Circular 0170 Vencida" : "<INPUT ID=CHK_$num_oid TYPE=CHECKBOX style='visibility:hidden;' NAME='hbls[$num_oid][oid]' VALUE=$num_oid ONCLICK='negativo(this);sumarizar(document.informe);'>") . "</TD>";
                        echo "    <TR>";
                        echo "    </TABLE>";
                        echo "    <INPUT ID=VLR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][comision]' VALUE=" . ($com_cas - $rs->Value('ca_vlrcomisiones')) . ">";
                        echo "    <INPUT ID=SBR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][sobrevta]' VALUE=" . ($com_sbr - $rs->Value('ca_sbrcomisiones')) . ">";
                        echo "    <INPUT ID=CIR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][circular]' VALUE=" . $rs->Value('ca_stdcircular') . ">";
                        echo "  </TD>";
                        $rec_com = false;
                    } else {
                        echo "  <TD Class=listar></TD>";
                    }
                    echo "</TR>";
                    echo "<script language='javascript'>habilitar(document.getElementById('" . $num_oid . "_" . $j . "'));</script>";
                    $rs->MoveNext();
                    $j++;
                }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=9></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=6 ROWSPAN=3></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Comisión x Venta :</TD>";
                echo "  <TD Class=mostrar><INPUT ID=TOT_vlr READONLY TYPE='TEXT' NAME='tot_vlrcomisiones' SIZE=20 MAXLENGTH=15></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=2>Comisión x Sobreventa :</TD>";
                echo "  <TD Class=mostrar><INPUT ID=TOT_sbr READONLY TYPE='TEXT' NAME='tot_sbrcomisiones' SIZE=20 MAXLENGTH=15></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=2><B>Total a Comisionar :<B></TD>";
                echo "  <TD Class=mostrar><INPUT ID=GRN_tot READONLY TYPE='TEXT' NAME='grn_total' SIZE=20 MAXLENGTH=15></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=9></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<script language='javascript'>sumarizar(document.informe);</script>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='botones' VALUE='Registrar' ONCLICK='procesar();'></TH>";    // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='botones' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"comisiones.php\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
//          echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
    }
} elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    $accion = base64_decode($accion);
    switch (trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Registrar': {
                if (isset($_COOKIE['control'])) {
                    setcookie("control", FALSE, time() - 3600);
                    if (!$rs->Open("select nextval('tb_inocomisiones_sea_id')")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'comisiones.php';</script>";
                        exit;
                    }
                    $comprobante = $rs->Value('nextval');

                    if (!$rs->Open("BEGIN")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'comisiones.php';</script>";
                        exit;
                    }
                    while (list ($clave, $val) = each($hbls)) {
                        if (isset($val[oid])) {
                            if (!$rs->Open("select ca_idinocliente from tb_inoingresos_sea where oid = " . $val[oid] . " limit 1")) {
                                echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'comisiones.php';</script>";
                                exit;
                            }
                            if (!$cm->Open("insert into tb_inocomisiones_sea (ca_idinocliente, ca_comprobante, ca_fchliquidacion, ca_vlrcomision, ca_sbrcomision, ca_fchcreado, ca_usucreado) values ('" . $rs->Value('ca_idinocliente') . "',  $comprobante, '" . date("Y-m-d") . "', " . (strlen($val[comision]) > 0 ? $val[comision] : 0) . ", " . (strlen($val[sobrevta]) > 0 ? $val[sobrevta] : 0) . ", to_timestamp('" . date("d M Y H:i:s") . "', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                                echo "<script>alert(\"" . addslashes($cm->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'comisiones.php';</script>";
                                exit;
                            }
                        }
                    }
                    if (!$rs->Open("COMMIT")) {
                        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'comisiones.php';</script>";
                        exit;
                    }
                    echo "<script>document.location.replace(\"comisiones.php?accion=" . base64_encode('Imprimir') . "&var=" . base64_encode($comprobante) . "\");</script>";
                }else{
                    echo "<script>document.location.replace(\"comisiones.php\");</script>";
                }
                break;
            }
        case 'Imprimir': {
                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
                $comprobante = base64_decode($var);
//          include_once 'include/seguridad.php';                             // Control de Acceso al módulo
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<TABLE CELLSPACING=1 WIDTH='830' HEIGHT='650'>";
                echo "<TR>";
                echo "  <TD Class=invertir><iframe ID=consulta_tar src ='comision.php?id=$comprobante' width='100%' height='100%'></iframe></TD>";
                echo "</TR>";
                echo "</TABLE>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"comisiones.php\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</CENTER>";
                break;
            }
        default: {                                                    // El Botón Guardar fue pulsado
                echo "<script>alert('Falló el registro del comprobante');</script>";  // Retorna a la pantalla principal de la opción
                echo "<script>document.location.href = 'comisiones.php';</script>";  // Retorna a la pantalla principal de la opción
                break;
            }
    }
}
?>
