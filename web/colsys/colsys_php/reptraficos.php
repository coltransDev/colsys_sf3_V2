<?php

/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       REPTRAFICOS.PHP                                                \\
  // Creado:        2004-05-11                                                  \\
  // Autor:         Carlos Gilberto López M.                                    \\
  // Ver:           1.00                                                        \\
  // Updated:       2004-05-11                                                  \\
  //                                                                            \\
  // Descripción:   Reporte sobre Movimiento de Carga                           \\
  //                                                                            \\
  //                                                                            \\
  // Copyright:     Coltrans S.A. - 2004                                        \\
  /*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
 */
$programa = 58;
$titulo = 'Informe Movimiento de Carga por Tráfico';
$meses = array("%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta


$rs = & DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)) {
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='reptraficos.php'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=6 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año :<BR><SELECT NAME='ano'>";
    for ($i = 5; $i >= 0; $i--) {
        echo " <OPTION VALUE=" . (date('Y') - $i) . " SELECTED>" . (date('Y') - $i) . "</OPTION>";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes a Consultar:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m') == $clave) {
            echo" SELECTED";
        }
        echo ">$val</OPTION>";
    }
    echo "  </SELECT></TD>";
    $tm = & DlRecordset::NewRecordset($conn);

    if (!$tm->Open("select DISTINCT ca_identificacion as ca_trafico from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repreferencia.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sufijo :<BR><SELECT NAME='trafico'>";
    echo " <OPTION VALUE=%>Sufijos (Todos)</OPTION>";
    while (!$tm->Eof()) {
        echo " <OPTION VALUE=" . $tm->Value('ca_trafico') . ">" . $tm->Value('ca_trafico') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";

    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reptraficos.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo " <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while (!$tm->Eof()) {
        echo " <OPTION VALUE=" . $tm->Value('ca_nombre') . ">" . $tm->Value('ca_nombre') . "</OPTION>";
        $tm->MoveNext();
    }
    echo "  </TD>";
    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=5></TD>";
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
} elseif (!isset($boton) and !isset($accion) and isset($traorigen)) {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%'";
    if (!$rs->Open("select * from vi_traficos")) {            // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit;
    }
    $fc = & DlRecordset::NewRecordset($conn);
    $lc = & DlRecordset::NewRecordset($conn);
    if ($mes == '%') {
        //echo "select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, sum(ca_teus) as ca_teus from vi_inotrafico_fcl $condicion group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino";
        if (!$fc->Open("select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, sum(ca_teus) as ca_teus from vi_inotrafico_fcl $condicion group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino")) {            // Selecciona todos lo registros de la tabla Ino-Marítimo
            echo "<script>alert(\"" . addslashes($fc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
        if (!$lc->Open("select ca_ano, ca_trafico, ca_traorigen, ca_ciudestino, sum(ca_volumen) as ca_volumen, sum(ca_20pies) as ca_20pies, sum(ca_40pies) as ca_40pies, sum(ca_teus) as ca_teus from vi_inotrafico_lcl $condicion group by ca_ano, ca_trafico, ca_traorigen, ca_ciudestino order by ca_ano, ca_traorigen, ca_ciudestino")) {            // Selecciona todos lo registros de la tabla Ino-Marítimo
            echo "<script>alert(\"" . addslashes($lc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
    } else {
        //echo "select * from vi_inotrafico_fcl $condicion";
        if (!$fc->Open("select * from vi_inotrafico_fcl $condicion")) {            // Selecciona todos lo registros de la tabla Ino-Marítimo
            echo "<script>alert(\"" . addslashes($fc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }

        if (!$lc->Open("select * from vi_inotrafico_lcl $condicion")) {            // Selecciona todos lo registros de la tabla Ino-Marítimo
            echo "<script>alert(\"" . addslashes($lc->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit;
        }
    }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='reptraficos.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=540 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>" . COLTRANS . "<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Sucursal</TH>";
    echo "<TH>FCL</TH>";
    echo "<TH>LCL</TH>";
    $tot_20 = 0;
    $tot_40 = 0;
    $tot_teu = 0;
    $array_fcl = array_combine(array('Puerto'), array());
    $array_lcl = array_combine(array('Puerto'), array());
    set_time_limit(360);
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        if ($rs->Value('ca_nombre') == $fc->Value('ca_traorigen') or $rs->Value('ca_nombre') == $lc->Value('ca_traorigen')) {
            echo "<TR>";
            echo "<TD Class=listar style='font-weight:bold;'>" . $rs->Value('ca_nombre') . "</TD>";
            $nom_tra = $rs->Value('ca_nombre');
        } else {
            $rs->MoveNext();
            continue;
        }
        echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
        echo "<TH WIDTH=40%>Destino</TH>";
        echo "<TH WIDTH=20%>20 Pies</TH>";
        echo "<TH WIDTH=20%>40 Pies</TH>";
        echo "<TH WIDTH=20%>TEU's</TH>";
        $fcl_nom_des = '';
        $fcl_sub_20 = 0;
        $fcl_sub_40 = 0;
        $fcl_sub_teu = 0;
        while ($nom_tra == $fc->Value('ca_traorigen') and !$fc->Eof() and !$fc->IsEmpty()) {
            echo "<TR>";
            if ($fcl_nom_des != $fc->Value('ca_ciudestino')) {
                echo "<TD Class=listar>" . $fc->Value('ca_ciudestino') . "</TD>";
                $fcl_nom_des = $fc->Value('ca_ciudestino');
            } else {
                echo "<TD Class=listar>&nbsp;</TD>";
            }
            echo "<TD Class=valores>" . number_format($fc->Value('ca_20pies')) . "</TD>";
            echo "<TD Class=valores>" . number_format($fc->Value('ca_40pies')) . "</TD>";
            echo "<TD Class=valores>" . number_format($fc->Value('ca_teus')) . "</TD>";
            echo "</TR>";
            $fcl_sub_20+= $fc->Value('ca_20pies');
            $fcl_sub_40+= $fc->Value('ca_40pies');
            $fcl_sub_teu+= $fc->Value('ca_teus');
            $array_fcl[$fcl_nom_des][sub_20]+= $fc->Value('ca_20pies');
            $array_fcl[$fcl_nom_des][sub_40]+= $fc->Value('ca_40pies');
            $array_fcl[$fcl_nom_des][sub_teu]+= $fc->Value('ca_teus');
            $fc->MoveNext();
        }
        echo "<TR HEIGHT=3>";
        echo "  <TD Class=invertir COLSPAN=3></TD>";
        echo "</TR>";
        echo "<TR>";
        echo "<TD Class=listar style='font-weight:bold;'>Sub-Totales :</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($fcl_sub_20) . "</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($fcl_sub_40) . "</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($fcl_sub_teu) . "</TD>";
        echo "</TR>";
        echo "</TABLE></TD>";
        $fcl_tot_20+= $fcl_sub_20;
        $fcl_tot_40+= $fcl_sub_40;
        $fcl_tot_teu+= $fcl_sub_teu;

        echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
        echo "<TH WIDTH=40%>Destino</TH>";
        echo "<TH WIDTH=15%>CBM</TH>";
        echo "<TH WIDTH=15%>20 Pies</TH>";
        echo "<TH WIDTH=15%>40 Pies</TH>";
        echo "<TH WIDTH=15%>TEU's</TH>";
        $lcl_nom_des = '';
        $lcl_sub_vol = 0;
        $lcl_sub_20 = 0;
        $lcl_sub_40 = 0;
        $lcl_sub_teu = 0;
        while ($nom_tra == $lc->Value('ca_traorigen') and !$lc->Eof() and !$lc->IsEmpty()) {
            echo "<TR>";
            if ($lcl_nom_des != $lc->Value('ca_ciudestino')) {
                echo "<TD Class=listar>" . $lc->Value('ca_ciudestino') . "</TD>";
                $lcl_nom_des = $lc->Value('ca_ciudestino');
            } else {
                echo "<TD Class=listar>&nbsp;</TD>";
            }
            echo "<TD Class=valores>" . number_format($lc->Value('ca_volumen'), 1) . "</TD>";
            echo "<TD Class=valores>" . number_format($lc->Value('ca_20pies')) . "</TD>";
            echo "<TD Class=valores>" . number_format($lc->Value('ca_40pies')) . "</TD>";
            echo "<TD Class=valores>" . number_format($lc->Value('ca_teus')) . "</TD>";
            echo "</TR>";
            $lcl_sub_vol+= $lc->Value('ca_volumen');
            $lcl_sub_20+= $lc->Value('ca_20pies');
            $lcl_sub_40+= $lc->Value('ca_40pies');
            $lcl_sub_teu+= $lc->Value('ca_teus');
            $array_lcl[$lcl_nom_des][sub_vol]+= $lc->Value('ca_volumen');
            $array_lcl[$lcl_nom_des][sub_20]+= $lc->Value('ca_20pies');
            $array_lcl[$lcl_nom_des][sub_40]+= $lc->Value('ca_40pies');
            $array_lcl[$lcl_nom_des][sub_teu]+= $lc->Value('ca_teus');
            $lc->MoveNext();
        }
        echo "<TR HEIGHT=3>";
        echo "  <TD Class=invertir COLSPAN=3></TD>";
        echo "</TR>";
        echo "<TR>";
        echo "<TD Class=listar style='font-weight:bold;'>Sub-Totales :</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($lcl_sub_vol, 1) . "</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($lcl_sub_20) . "</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($lcl_sub_40) . "</TD>";
        echo "<TD Class=valores style='font-weight:bold;'>" . number_format($lcl_sub_teu) . "</TD>";
        echo "</TR>";
        echo "</TABLE></TD>";
        $lcl_tot_vol+= $lcl_sub_vol;
        $lcl_tot_20+= $lcl_sub_20;
        $lcl_tot_40+= $lcl_sub_40;
        $lcl_tot_teu+= $lcl_sub_teu;


        echo "</TR>";
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=3></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "<TD Class=invertir></TD>";
    echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
    echo "<TR>";
    echo "<TD Class=listar  WIDTH=40% style='font-weight:bold;'>Gran Total :</TD>";
    echo "<TD Class=valores WIDTH=20% style='font-weight:bold;'>" . number_format($fcl_tot_20) . "</TD>";
    echo "<TD Class=valores WIDTH=20% style='font-weight:bold;'>" . number_format($fcl_tot_40) . "</TD>";
    echo "<TD Class=valores WIDTH=20% style='font-weight:bold;'>" . number_format($fcl_tot_teu) . "</TD>";
    echo "</TR>";
    echo "</TABLE></TD>";
    echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
    echo "<TR>";
    echo "<TD Class=listar  WIDTH=40% style='font-weight:bold;'>Gran Total :</TD>";
    echo "<TD Class=valores WIDTH=15% style='font-weight:bold;'>" . number_format($lcl_tot_vol, 1) . "</TD>";
    echo "<TD Class=valores WIDTH=15% style='font-weight:bold;'>" . number_format($lcl_tot_20) . "</TD>";
    echo "<TD Class=valores WIDTH=15% style='font-weight:bold;'>" . number_format($lcl_tot_40) . "</TD>";
    echo "<TD Class=valores WIDTH=15% style='font-weight:bold;'>" . number_format($lcl_tot_teu) . "</TD>";
    echo "</TR>";
    echo "</TABLE></TD>";
    echo "</TABLE><BR>";

    echo "<TABLE WIDTH=540 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "<TH COLSPAN=3>RESUMEN POR PUERTO DE LLEGADA</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TD Class=invertir></TD>";
    echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
    echo "<TR>";
    echo "<TH COLSPAN=4>FCL</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH WIDTH=40%>Puerto</TH>";
    echo "<TH WIDTH=20%>20 Pies</TH>";
    echo "<TH WIDTH=20%>40 Pies</TH>";
    echo "<TH WIDTH=20%>TEU's</TH>";
    echo "</TR>";
    while (list ($clave, $val) = each($array_fcl)) {
        echo "<TR>";
        echo "<TD Class=listar  WIDTH=40% style='font-weight:bold;'>$clave</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_20']) . "</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_40']) . "</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_teu']) . "</TD>";
        echo "</TR>";
    }
    echo "</TABLE></TD>";
    echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
    echo "<TR>";
    echo "<TH COLSPAN=5>LCL</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH WIDTH=40%>Puerto</TH>";
    echo "<TH WIDTH=20%>CBM</TH>";
    echo "<TH WIDTH=20%>20 Pies</TH>";
    echo "<TH WIDTH=20%>40 Pies</TH>";
    echo "<TH WIDTH=20%>TEU's</TH>";
    echo "</TR>";
    while (list ($clave, $val) = each($array_lcl)) {
        echo "<TR>";
        echo "<TD Class=listar  WIDTH=40% style='font-weight:bold;'>$clave</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_vol'], 1) . "</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_20']) . "</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_40']) . "</TD>";
        echo "<TD Class=valores WIDTH=20%>" . number_format($val['sub_teu']) . "</TD>";
        echo "</TR>";
    }
    echo "</TABLE></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";





    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"reptraficos.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
?>