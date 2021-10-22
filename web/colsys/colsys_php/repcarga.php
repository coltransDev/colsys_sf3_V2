<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPCARGA.PHP                                                \\
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

$titulo = 'Informe Movimiento de Carga por Sucursal';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)){
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='repcarga.php'>";
    echo "<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=8 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año :<BR><SELECT NAME='ano'>";
    for ( $i=5; $i>=0; $i-- ){
          echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes a Consultar:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcarga.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
    echo " <OPTION VALUE=%>Sucursal (Todas)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_sucursal').">".$tm->Value('ca_sucursal')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";

    if (!$tm->Open("select DISTINCT ca_identificacion as ca_trafico from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repreferencia.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sufijo :<BR><SELECT NAME='trafico'>";
    echo " <OPTION VALUE=%>Sufijos (Todos)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_trafico').">".$tm->Value('ca_trafico')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";

    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcarga.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    echo "  <TD Class=mostrar>Con Proyectos :<BR><CENTER><INPUT TYPE='CHECKBOX' NAME='proyectos'></CENTER></TD>";
    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
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
    }
elseif (!isset($boton) and !isset($accion) and isset($traorigen)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_sucursal like '%$sucursal%' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%'";
    $subcond = "";
    if (!$proyectos){
        $subcond = " and ca_modalidad != 'PROYECTOS'";
    }
    if (!$rs->Open("select distinct ca_sucursal from vi_usuarios where ca_sucursal like '%$sucursal%' order by ca_sucursal")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    
    $fc =& DlRecordset::NewRecordset($conn);
    if (!$fc->Open("select * from vi_inocarga_fcl $condicion $subcond")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    $lc =& DlRecordset::NewRecordset($conn);
    if (!$lc->Open("select * from vi_inocarga_lcl $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($lc->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repcarga.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=540 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Sucursal</TH>";
    echo "<TH>FCL</TH>";
    echo "<TH>LCL</TH>";
    $nom_suc = '';
    $tot_20  = 0;
    $tot_40  = 0;
    $tot_teu = 0;
    $tot_vol  = 0;
    set_time_limit(0);
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       if ($nom_suc != $rs->Value('ca_sucursal')) {
           echo "<TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_sucursal')."</TD>";
           $nom_suc = $rs->Value('ca_sucursal');
          }
       echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
       echo "<TH>Origen</TH>";
       echo "<TH>Destino</TH>";
       echo "<TH>Equipo</TH>";
       echo "<TH>Cantidad</TH>";
       $nom_tra = '';
       $nom_des = '';
       $sub_20  = 0;
       $sub_40  = 0;
       $sub_teu = 0;
       $fc->MoveFirst();
       while (!$fc->Eof() and !$fc->IsEmpty()) {
          if ($fc->Value('ca_sucursal') != $rs->Value('ca_sucursal')) {
              $fc->MoveNext();
              continue;
          }
          echo "<TR>";
          if ($nom_tra != $fc->Value('ca_traorigen')) {
              echo "<TD Class=listar>".$fc->Value('ca_traorigen')."</TD>";
              $nom_tra = $rs->Value('ca_traorigen');
          }else {
              echo "<TD Class=listar>&nbsp;</TD>";
          }
          if ($nom_des != $fc->Value('ca_ciudestino')) {
              echo "<TD Class=listar>".$fc->Value('ca_ciudestino')."</TD>";
              $nom_des = $rs->Value('ca_ciudestino');
          }else {
              echo "<TD Class=listar>&nbsp;</TD>";
          }
          echo "<TD Class=listar>".$fc->Value('ca_capacidad')."</TD>";
          echo "<TD Class=valores>".number_format($fc->Value('ca_cantidad'),2)."</TD>";
          echo "</TR>";
          if ($fc->Value('ca_capacidad') == 20) {
              $sub_20+= $fc->Value('ca_cantidad');
          }else if ($fc->Value('ca_capacidad') == 40 or $fc->Value('ca_capacidad') == 45) {
              $sub_40+= $fc->Value('ca_cantidad');
          }
          $sub_teu+= $fc->Value('ca_teus');
          $fc->MoveNext();
       }
       echo "<TR HEIGHT=3>";
       echo "  <TD Class=invertir COLSPAN=4></TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=valores COLSPAN=3>Total Contenedores 20 pies:</TD>";
       echo " <TD Class=valores>".number_format($sub_20,2)."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=valores COLSPAN=3>Total Contenedores 40 pies:</TD>";
       echo " <TD Class=valores>".number_format($sub_40,2)."</TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=valores COLSPAN=3>Equivalencia en TEU's:</TD>";
       echo " <TD Class=valores>".number_format($sub_teu,2)."</TD>";
       echo "</TR>";
       echo "</TABLE></TD>";
       $tot_20+= $sub_20;
       $tot_40+= $sub_40;
       $tot_teu+= $sub_teu;

       echo "<TD Class=invertir><TABLE WIDTH=270 CELLSPACING=1>";
       echo "<TH>Origen</TH>";
       echo "<TH>Destino</TH>";
       echo "<TH>Volumen</TH>";
       $nom_tra = '';
       $nom_des = '';
       $sub_vol  = 0;
       $lc->MoveFirst();
       while (!$lc->Eof() and !$lc->IsEmpty()) {
          if ($lc->Value('ca_sucursal') != $rs->Value('ca_sucursal')) {
              $lc->MoveNext();
              continue;
          }
          echo "<TR>";
          if ($nom_tra != $lc->Value('ca_traorigen')) {
              echo "<TD Class=listar>".$lc->Value('ca_traorigen')."</TD>";
              $nom_tra = $rs->Value('ca_traorigen');
          }else {
              echo "<TD Class=listar>&nbsp;</TD>";
          }
          if ($nom_des != $lc->Value('ca_ciudestino')) {
              echo "<TD Class=listar>".$lc->Value('ca_ciudestino')."</TD>";
              $nom_des = $rs->Value('ca_ciudestino');
          }else {
              echo "<TD Class=listar>&nbsp;</TD>";
          }
          echo "<TD Class=valores>".number_format($lc->Value('ca_volumen'),2)."</TD>";
          echo "</TR>";
          $sub_vol+= $lc->Value('ca_volumen');
          $lc->MoveNext();
       }
       echo "<TR HEIGHT=3>";
       echo "  <TD Class=invertir COLSPAN=3></TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=valores COLSPAN=2>Total Carga Suelta CBM: </TD>";
       echo " <TD Class=valores>".number_format($sub_vol,2)."</TD>";
       echo "</TR>";
       echo "</TABLE></TD>";
       $tot_vol+= $sub_vol;

       echo "</TR>";
       $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=3></TD>";
    echo "</TR>";
    echo "<TR>";
    echo " <TD Class=valores>&nbsp;</TD>";
    echo " <TD Class=valores style='font-weight:bold;'>Gran Total Contenedores 20 pies:&nbsp;&nbsp;&nbsp;".number_format($tot_20,2)."</TD>";
    echo " <TD Class=valores style='font-weight:bold;'>Gran Total Volumen CBM:&nbsp;&nbsp;&nbsp;".number_format($tot_vol,2)."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo " <TD Class=valores>&nbsp;</TD>";
    echo " <TD Class=valores style='font-weight:bold;'>Gran Total Contenedores 40 pies:&nbsp;&nbsp;&nbsp;".number_format($tot_40,2)."</TD>";
    echo " <TD Class=valores style='font-weight:bold;'></TD>";
    echo "</TR>";
    echo "<TR>";
    echo " <TD Class=valores>&nbsp;</TD>";
    echo " <TD Class=valores style='font-weight:bold;'>Gran Total en TEU's:&nbsp;&nbsp;&nbsp;".number_format($tot_teu,2)."</TD>";
    echo " <TD Class=valores style='font-weight:bold;'></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcarga.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>