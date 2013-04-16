<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPCONSOLIDADO.PHP                                          \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte de Libro de Referencias                             \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Consolidado de Casos detallado por Tráfico';
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='repconsolidado.php'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=6 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año a Consultar:<BR><SELECT NAME='ano'>";
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
        echo "<script>document.location.href = 'repauditoria.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</OPTION>";
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
    }
elseif (!isset($boton) and !isset($accion) and isset($traorigen)){
    set_time_limit(360);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

	$condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_sufijo like '%$trafico%' and ca_traorigen like '%$traorigen%'";
    if (!$rs->Open("select * from vi_inotraficos_sea $condicion")) {        // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repconsolidado.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=500 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=8>".COLTRANS."<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH WIDTH=30>No.</TH>";
    echo "<TH>Tráfico</TH>";
    echo "<TH>Sufijo</TH>";
    echo "<TH>No. Referencias</TH>";
    echo "<TH>No. Hbls</TH>";
    echo "<TH>No. Clientes</TH>";
    echo "<TH WIDTH=100>Total Facturado</TH>";
    $ano_mem = '';
	$mes_mem = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($ano_mem != $rs->Value('ca_ano') or $mes_mem != $rs->Value('ca_mes')) {
		   echo "<TR>";
		   echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=7>".$meses[$rs->Value('ca_mes')]."/".$rs->Value('ca_ano')."</TD>";
		   echo "</TR>";
		   $ano_mem = $rs->Value('ca_ano');
           $mes_mem = $rs->Value('ca_mes');
           $num_ref = 1;
           $sub_ref = 0;
           $sub_hbl = 0;
           $sub_cli = 0;
           $sub_fac = 0;
          }
       echo "<TR>";
       echo "  <TD Class=listar>$num_ref</TD>";
       echo "  <TD Class=listar>".$rs->Value('ca_traorigen')."</TD>";
       echo "  <TD Class=listar>".$rs->Value('ca_sufijo')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_referencias')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_hbls')."</TD>";
       echo "  <TD Class=listar style='text-align:center;'>".$rs->Value('ca_clientes')."</TD>";
       echo "  <TD Class=valores>".number_format($rs->Value('ca_facturacion'))."</TD>";
       echo "</TR>";
       $num_ref++;
       $sub_ref+= $rs->Value('ca_referencias');
       $sub_hbl+= $rs->Value('ca_hbls');
       $sub_cli+= $rs->Value('ca_clientes');
       $sub_fac+= $rs->Value('ca_facturacion');
       
       $tot_ref+= $rs->Value('ca_referencias');
       $tot_hbl+= $rs->Value('ca_hbls');
       $tot_cli+= $rs->Value('ca_clientes');
       $tot_fac+= $rs->Value('ca_facturacion');

       $rs->MoveNext();
       if ($mes_mem != $rs->Value('ca_mes') or $rs->Eof()) {
           echo "<TR>";
           echo "  <TD Class=invertir COLSPAN=3 style='text-align:right;'>Sub-Totales :</TD>";
           echo "  <TD Class=invertir style='text-align:center;'>$sub_ref</TD>";
           echo "  <TD Class=invertir style='text-align:center;'>$sub_hbl</TD>";
           echo "  <TD Class=invertir style='text-align:center;'>$sub_cli</TD>";
           echo "  <TD Class=invertir style='text-align:right;'>".number_format($sub_fac)."</TD>";
           echo "</TR>";
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=8></TD>";
           echo "</TR>";
       }
    }
    echo "<TR>";
    echo "  <TD Class=invertir COLSPAN=3 style='font-size: 10px; font-weight:bold; text-align:right;'>Totales :</TD>";
    echo "  <TD Class=invertir style='font-size: 10px; font-weight:bold; text-align:center;'>$tot_ref</TD>";
    echo "  <TD Class=invertir style='font-size: 10px; font-weight:bold; text-align:center;'>$tot_hbl</TD>";
    echo "  <TD Class=invertir style='font-size: 10px; font-weight:bold; text-align:center;'>$tot_cli</TD>";
    echo "  <TD Class=invertir style='font-size: 10px; font-weight:bold; text-align:right;'>".number_format($tot_fac)."</TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repconsolidado.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>