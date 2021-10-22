<?php
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       repreportes.PHP                                           \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Reporte de Cuadro INO para Gerencia.                        \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */

$titulo = 'Informe de Reportes de Negocio por Vendedores';
$meses = array("%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
$transportes = array("%" => "Todos", "Aéreo" => "Aéreo", "Marítimo" => "Marítimo", "Terrestre" => "Terrestre");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>document.location.href = 'entrada.php';</script>";
}


set_time_limit(0);
$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($login) and !isset($boton) and !isset($accion)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function llenar_vendedores(){";
    echo "  source = document.getElementById('sucursal');";
    echo "  elemento = document.getElementById('login');";
    echo "  elemento.length = 0;";
    echo "  elemento.options[elemento.length] = new Option();";
    echo "  elemento.length = 0;";
    echo "  elemento[elemento.length] = new Option('Vendedores (Todos)','',false,true);";
    echo "     for (cont=0; cont<document.menuform.usu_login.length; cont++) {";
    echo "          if (source.value == document.menuform.usu_sucursal[cont].value){";
    echo "              elemento[elemento.length] = new Option(document.menuform.usu_nombre[cont].value,document.menuform.usu_login[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "}";
    echo "</script>";
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='repreportes.php'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";
    $tm = & DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repreportes.php';</script>";
        exit;
    }
    $us = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select ca_login, ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
        echo "<script>alert(\"" . addslashes($us->mErrMsg) . "\");</script>";
        echo "<script>document.location.href = 'repreportes.php';</script>";
        exit;
    }
    $us->MoveFirst();
    while (!$us->Eof()) {
        echo "<INPUT TYPE='HIDDEN' ID='usu_login' NAME='usu_login' VALUE='" . $us->Value('ca_login') . "'>";
        echo "<INPUT TYPE='HIDDEN' ID='usu_nombre' NAME='usu_nombre' VALUE='" . $us->Value('ca_nombre') . "'>";
        echo "<INPUT TYPE='HIDDEN' ID='usu_sucursal' NAME='usu_sucursal' VALUE='" . $us->Value('ca_sucursal') . "'>";
        $us->MoveNext();
    }

    echo "<TR>";
    /*echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
    for ($i = 5; $i >= 0; $i--) {
        echo " <OPTION VALUE=" . (date('Y') - $i) . " SELECTED>" . (date('Y') - $i) . "</OPTION>";
    }
    echo "  </SELECT></TD>";*/
    /*echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m') == $clave) {
            echo" SELECTED";
        }
        echo ">$val</OPTION>";
    }*/
    echo "  <TD Class=listar>Fch. Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar>Fch. Final:<BR><INPUT TYPE='TEXT' NAME='fchfinal' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar>Sucursal:<BR><SELECT ID='sucursal' NAME='sucursal' ONCHANGE='llenar_vendedores();'>";
    echo "  <OPTION VALUE=''>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<OPTION VALUE='" . $tm->Value('ca_sucursal') . "'>" . $tm->Value('ca_sucursal') . "</OPTION>";
        $tm->MoveNext();
    }

    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar>Vendedor:<BR><SELECT ID='login' NAME='login'>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=''>Vendedores (Todos)</OPTION>";
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Transporte:<BR><SELECT NAME='transporte'>";
    while (list ($clave, $val) = each($transportes)) {
        echo " <OPTION VALUE='" . $clave . "'>" . $val;
    }
    echo "  </SELECT></TD>";
    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (!isset($boton) and !isset($accion) and isset($login)) {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $rsi = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    $condicion = "where (ca_impoexpo = 'Importación' or ca_impoexpo = 'Triangulación')";
    $condicion.= " and ca_fchreporte BETWEEN '$fchinicial' and '$fchfinal'";
    
    if ($sucursal != "%")
        $condicion.= " and ca_sucursal like '%$sucursal%'";

    if ($login != "%")
        $condicion.= " and ca_login like '%$login%'";

    if ($transporte != "%")
        $condicion.= " and ca_transporte like '%$transporte%'";

    if (!$rsi->Open("select * from vi_repreportes $condicion")) {               // Selecciona todos lo registros de la vista Vi_Reportes Importación
        echo "<script>alert(\"" . addslashes($rsi->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    

    $condicion = str_replace("(ca_impoexpo = 'Importación' or ca_impoexpo = 'Triangulación')", "ca_impoexpo = 'Exportación'", $condicion);
    $rse = & DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$rse->Open("select * from vi_repreportes $condicion")) {               // Selecciona todos lo registros de la vista Vi_Reportes Importación
        echo "<script>alert(\"" . addslashes($rse->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    //$sql="select * from vi_repreportes $condicion";
    //echo $sql;
    
    $condicion = str_replace("ca_impoexpo = 'Exportación'", "ca_impoexpo = 'OTM-DTA'", $condicion);
    $condicion = str_replace("Marítimo", "Terrestre", $condicion);
    $condicion = str_replace("Aéreo", "Terrestre", $condicion);       
    $rso = & DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$rso->Open("select * from vi_repreportes_otm $condicion")) {               // Selecciona todos lo registros de la vista Vi_Reportes Importación
        echo "<script>alert(\"" . addslashes($rse->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }

    /* echo $condicion;
      exit(); */

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repreportes.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=900 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=13>COLTRANS S.A.<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir COLSPAN=13 style='font-weight:bold'>IMPORTACIÓN</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Ver.</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Fch.Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Nit</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Cliente</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Tráfico</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Origen</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Destino</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Transporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>T.Incoterms</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Usu.Creado</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Vendedor.</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Sucursal</TD>";
    echo "</TR>";
    
    $cantVendedor = 0;
    $lastReg = null;
    while (!$rsi->Eof() and !$rsi->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $incoterms = array_unique(explode("|", $rsi->Value('ca_incoterms')));
        $incoterms = implode("<br />", $incoterms);
        if ($rsi->Value('ca_login') != $lastReg) {
            if ($lastReg != null) {
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13 ><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
                echo "</TR>";
                $cantVendedor = 0;
            }
            //$lastReg=$rsi->Value('ca_login');
            echo "<TR>";
            echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=13><b>" . $rsi->Value('ca_nombre') . "</b></TD>";
            echo "<TR>";
        }
        echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;'>" . $rsi->Value('ca_consecutivo') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_version') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_fchreporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_idcliente') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_nombre_cli') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_traorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_ciuorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_ciudestino') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_transporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $incoterms . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_usucreado') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_login') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rsi->Value('ca_sucursal') . "</TD>";
        echo "</TR>";

        $cantVendedor++;
        $lastReg = $rsi->Value('ca_login');
        $nombreVendedor = $rsi->Value('ca_nombre');
        $rsi->MoveNext();
        $cant++;
    }
    
    if ($cantVendedor>0) {
        echo "<TR>";
        echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
        echo "</TR>";
    }
    echo "<TR>";
    echo "  <TD Class=listar style='font-size: 12px;' COLSPAN=13 style='text-align=right'><b>Total Importación: $cant</b></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=12></TD>";
    echo "</TR>";
    echo "</TABLE><BR><BR>";

    echo "<TABLE WIDTH=900 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TD Class=partir COLSPAN=12 style='font-weight:bold'>EXPORTACIÓN</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Ver.</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Fch.Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Nit</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Cliente</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Tráfico</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Origen</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Destino</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Transporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>T.Incoterms</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Vendedor..</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Sucursal</TD>";
    echo "</TR>";
    
    $cantVendedor = 0;
    $cant=0;
    $lastReg = null;
    while (!$rse->Eof() and !$rse->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $incoterms = array_unique(explode("|", $rsi->Value('ca_incoterms')));
        $incoterms = implode("<br />", $incoterms);
        if ($rse->Value('ca_login') != $lastReg) {
            if ($lastReg != null) {
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13 ><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
                echo "</TR>";
                $cantVendedor = 0;
            }
            //$lastReg=$rsi->Value('ca_login');
            echo "<TR>";
            echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=13><b>" . $rse->Value('ca_nombre') . "</b></TD>";
            echo "<TR>";
        }
        echo "<TR>";
        echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;'>" . $rse->Value('ca_consecutivo') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_version') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_fchreporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_idcliente') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_nombre_cli') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_traorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_ciuorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_ciudestino') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_transporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $incoterms . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_login') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rse->Value('ca_sucursal') . "</TD>";
        echo "</TR>";
        
        $cantVendedor++;
        $lastReg = $rse->Value('ca_login');
        $nombreVendedor = $rse->Value('ca_nombre');
        $rse->MoveNext();
        $cant++;
    }
    if ($cantVendedor>0) {
        echo "<TR>";
        echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
        echo "</TR>";
    }
    echo "<TR>";
    echo "  <TD Class=listar style='font-size: 12px;' COLSPAN=13 style='text-align=right'><b>Total Exportación: $cant</b></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=12></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    //inicio OTM
    echo "<TABLE WIDTH=900 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TD Class=partir COLSPAN=12 style='font-weight:bold'>OTM - DTA</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Ver.</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Fch.Reporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Nit</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Cliente</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Tráfico</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Origen</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Destino</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Transporte</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>T.Incoterms</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Vendedor..</TD>";
    echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Sucursal</TD>";
    echo "</TR>";
    $cantVendedor = 0;
    $cant=0;
    $lastReg = null;
    while (!$rso->Eof() and !$rso->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $incoterms = array_unique(explode("|", $rsi->Value('ca_incoterms')));
        $incoterms = implode("<br />", $incoterms);
        if ($rso->Value('ca_login') != $lastReg) {
            if ($lastReg != null) {
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13 ><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
                echo "</TR>";
                $cantVendedor = 0;
            }
            //$lastReg=$rsi->Value('ca_login');
            echo "<TR>";
            echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=13><b>" . $rso->Value('ca_nombre') . "</b></TD>";
            echo "<TR>";
        }
        echo "<TR>";
        echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;'>" . $rso->Value('ca_consecutivo') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_version') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_fchreporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_idcliente') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_nombre_cli') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_traorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_ciuorigen') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_ciudestino') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_transporte') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $incoterms . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_login') . "</TD>";
        echo "  <TD Class=listar style='font-size: 9px;'>" . $rso->Value('ca_sucursal') . "</TD>";
        echo "</TR>";
        $cantVendedor++;
        $lastReg = $rso->Value('ca_login');
        $nombreVendedor = $rso->Value('ca_nombre');
        $rso->MoveNext();
        $cant++;
    }
    if ($cantVendedor>0) {
        echo "<TR>";
        echo "  <TD Class=listar style='font-size: 11px;  text-align: right;' COLSPAN=13><b>Total " . $nombreVendedor . ": $cantVendedor</b></TD>";
        echo "</TR>";
    }
    echo "<TR>";
    echo "  <TD Class=listar style='font-size: 12px;' COLSPAN=13 style='text-align=right'><b>Total OTM - DTA: $cant</b></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=12></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repreportes.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
} elseif (isset($boton)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch (trim($boton)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'ComisionesXC': {                                                 // El Botón ComisionesXC fue pulsado
                $modulo = "00100100";                                              // Identificación del módulo para la ayuda en línea
//          include_once 'include/seguridad.php';                              // Control de Acceso al módulo
                list($mes, $ano, $sucursal, $login, $casos) = split('[|]', $cl); // sscanf($cl, "%d|%d|%s|%s|%s");
                $nmeses = '';
                $mes = ($mes == '%') ? 12 : $mes;
                for ($i = 1; $i <= $mes; $i++) {
                    $nmeses.= "'" . substr(100 + $i, 1, 2) . "',";
                }
                $nmeses = substr($nmeses, 0, strlen($nmeses) - 1);

                $condicion = "ca_ano like '$ano' and ca_mes in ($nmeses) and ca_login like '$id' and ca_estado <> 'Abierto'";
                if (!$rs->Open("select * from vi_inoingresos_sea where $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
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
                echo "  i = 0;";
                echo "  check = true;";
                echo "  while (isNaN(document.getElementById(indice+'_'+i))) {";
                echo "     objeto = document.getElementById(indice+'_'+i);";
                echo "     if (objeto.value == '') {";
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
                echo "  elemento = document.getElementById('VLR_'+indice);";
                echo "  if (elemento.value < 0)";
                echo "      campo.checked = true;";
                echo "  return;";
                echo "}";
                echo "function elegir(opcion, id, cl) {";
                echo "    document.location.href = 'repreportes.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
                echo "<FORM METHOD=post NAME='informe' ACTION='repreportes.php' ONSUBMIT='javascript:return confirm(\"¿Esta seguro de Registrar el Cobro de Comisiones?\")'>";             // Hace una llamado nuevamente a este script pero con
                echo "<INPUT TYPE='HIDDEN' NAME='id'>";
                echo "<TABLE CELLSPACING=1>";                                              // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=8>COLTRANS S.A.<BR>$titulo<BR>" . $meses[substr(100 + $mes, 1, 2)] . "/" . $ano . "</TH>";
                echo "</TR>";
                echo "<TH>Referencia</TH>";
                echo "<TH>Hbls</TH>";
                echo "<TH>Factura</TH>";
                echo "<TH>Fch.Factura</TH>";
                echo "<TH>Vlr.Facturado</TH>";
                echo "<TH>Rec.Caja</TH>";
                echo "<TH>Fch.Pago</TH>";
                echo "<TH>Com.Causada</TH>";
                $nom_cli = '';
                $tot_vlr = 0;
                $tot_sbr = 0;
                while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
                    $com_cas = round($rs->Value('ca_volumen') * $utl_cbm * $rs->Value('ca_porcentaje') / 100, 0);
                    $com_sbr = round($rs->Value('ca_sbrcomision') * $rs->Value('ca_porcentaje') / 100, 0);
                    if ($com_cas - $rs->Value('ca_vlrcomisiones') == 0 and $com_sbr - $rs->Value('ca_sbrcomisiones') == 0) {
                        $rs->MoveNext();
                        continue;
                    }
                    $back_col = ($rs->Value('ca_estado') == 'Provisional') ? " background: #CCCC99" : (($rs->Value('ca_estado') == 'Abierto') ? " background: #CCCCCC" : " ");
                    $back_col = ($utl_cbm <= 0) ? " background: #FF6666" : $back_col;
                    if ($rs->Value('ca_compania') != $nom_cli) {
                        echo "<TR>";
                        echo "  <TD Class=invertir style='font-weight:bold; font-size: 9px;' COLSPAN=7>" . $rs->Value('ca_compania') . "</TD>";
                        echo "  <TD Class=invertir>";
                        echo "    <TABLE CELLSPACING=1>";
                        echo "    <TR>";
                        echo "     <TD Class=listar style='font-weight:bold; text-align=center' WIDTH=70>Corriente</TD>";
                        echo "     <TD Class=listar style='font-weight:bold; text-align=center' WIDTH=70>Sobre/Vta</TD>";
                        echo "    </TR>";
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
                    echo "  <TD Class=listar  WIDTH=50 style='font-size: 9px;$back_col'>" . $rs->Value('ca_factura') . "</TD>";
                    echo "  <TD Class=listar  WIDTH=70 style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchfactura') . "</TD>";
                    echo "  <TD Class=valores WIDTH=75 style='font-size: 9px;$back_col'>" . number_format($rs->Value('ca_valor')) . "</TD>";
                    echo "  <TD Class=listar  WIDTH=75 style='font-size: 9px;$back_col'>" . $rs->Value('ca_reccaja') . "</TD>";
                    echo "  <TD Class=listar  WIDTH=75 style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchpago') . "</TD>";
                    if ($rec_com) {
                        echo "  <TD Class=invertir>";
                        echo "    <TABLE CELLSPACING=1>";
                        echo "    <TR>";
                        echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'>" . number_format($com_cas - $rs->Value('ca_vlrcomisiones')) . "</TD>";
                        echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'>" . number_format($com_sbr - $rs->Value('ca_sbrcomisiones')) . "</TD>";
                        echo "    <TR>";
                        echo "    </TABLE>";
                        echo "    <INPUT ID=VLR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][comision]' VALUE=" . ($com_cas - $rs->Value('ca_vlrcomisiones')) . ">";
                        echo "    <INPUT ID=SBR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][sobrevta]' VALUE=" . ($com_sbr - $rs->Value('ca_sbrcomisiones')) . ">";
                        echo "  </TD>";
                        $rec_com = false;
                        $tot_vlr+= ($com_cas - $rs->Value('ca_vlrcomisiones'));
                        $tot_sbr+= ($com_sbr - $rs->Value('ca_sbrcomisiones'));
                    } else {
                        echo "  <TD Class=listar></TD>";
                    }
                    echo "</TR>";
                    $rs->MoveNext();
                    $j++;
                }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=8></TD>";
                echo "</TR>";
                echo "";
                echo "<TR>";
                echo "  <TD COLSPAN=7 Class=invertir style='text-align:right'><B>TOTALES :</B>";
                echo "  </TD>";
                echo "  <TD Class=invertir>";
                echo "    <TABLE CELLSPACING=1>";
                echo "    <TR>";
                echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'><B>" . number_format($tot_vlr) . "</B></TD>";
                echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'><B>" . number_format($tot_sbr) . "</B></TD>";
                echo "    <TR>";
                echo "    </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "</B>";

                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repreportes.php?mes=$mes\&ano=$ano\&sucursal=$sucursal\&login=$login\&casos=" . str_replace("¬", chr(92) . chr(34), $casos) . "\"'></TH>";  // Cancela la operación
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
}
?>