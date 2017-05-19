<?php
/* ================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
  // Archivo:       REPCARTGARANTIA.PHP                                           \\
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
// $programa = 53;
$titulo = 'Informe de Cartas de Garantía por Referencia';
$meses = array("01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
$cartas = array("Con Carta de Gtia." => "cm.ca_fchfirmado IS NOT NULL", "Sin Carta de Gtia." => "cm.ca_fchfirmado IS NULL", "Todos las Cartas" => "true");

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
   echo "<FORM METHOD=post NAME='menuform' ACTION='repcartgarantia.php'>";
   echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
   echo "<TH COLSPAN=9 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

   echo "<TR>";
   echo "  <TD Class=captura ROWSPAN=2></TD>";
   echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
   for ($i = 5; $i >= -1; $i--) {
      $sel = (date('Y') == date('Y') - $i) ? 'SELECTED' : '';
      echo " <OPTION VALUE=" . (date('Y') - $i) . " $sel>" . (date('Y') - $i) . "</OPTION>";
   }
   echo "  </SELECT></TD>";
   echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
   echo " <OPTION VALUE='%'>Todos los meses</OPTION>";
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
      echo "<script>document.location.href = 'repcartgarantia.php';</script>";
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
      echo "<script>document.location.href = 'repcartgarantia.php';</script>";
      exit;
   }
   $tm->MoveFirst();
   echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
   echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
   while (!$tm->Eof()) {
      echo " <OPTION VALUE=" . $tm->Value('ca_nombre') . ">" . $tm->Value('ca_nombre') . "</OPTION>";
      $tm->MoveNext();
   }
   echo "  </TD>";
   if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'repgenerator.php';</script>";
      exit;
   }
   $tm->MoveFirst();
   echo "  <TD Class=mostrar>Puerto de Destino :<BR><SELECT NAME='ciudestino'>";
   echo " <OPTION VALUE=%>Todos los Puertos</OPTION>";
   while (!$tm->Eof()) {
      echo " <OPTION VALUE=" . $tm->Value('ca_ciudad') . ">" . $tm->Value('ca_ciudad') . "</OPTION>";
      $tm->MoveNext();
   }
   echo "  </TD>";
   if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      echo "<script>document.location.href = 'repcomisiones.php';</script>";
      exit;
   }
   echo "  <TD Class=mostrar>Sucursal:<BR><SELECT NAME='sucursal'>";
   echo "  <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
   $tm->MoveFirst();
   while (!$tm->Eof()) {
      echo "<OPTION VALUE='" . $tm->Value('ca_sucursal') . "'>" . $tm->Value('ca_sucursal') . "</OPTION>";
      $tm->MoveNext();
   }

   echo "  </SELECT></TD>";
   echo "  <TD Class=listar>Carta de Gtia.:<BR><SELECT NAME='carta'>";
   while (list ($clave, $val) = each($cartas)) {
      echo " <OPTION VALUE='" . $val . "'>" . $clave;
   }
   echo "  </SELECT></TD>";
   echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
   echo "</TR>";

   echo "<TR HEIGHT=5>";
   echo "  <TD Class=captura COLSPAN=13></TD>";
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
   set_time_limit(0);
   $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea

   $sql = "select im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_estado, im.ca_traorigen, im.ca_ciuorigen, im.ca_tradestino, im.ca_ciudestino, im.ca_referencia, ";
   $sql.= "	im.ca_fchembarque, im.ca_fcharribo, cl.ca_idalterno, cl.ca_compania, ic.ca_hbls, ic.ca_login, cl.ca_sucursal, ";
   $sql.= "	cm.ca_fchfirmado, cm.ca_fchvencimiento, fc.ca_factura, fc.ca_fchfactura, fc.ca_vlrfactura ";
   $sql.= "from tb_inoclientes_sea ic ";
   $sql.= "	inner join vi_clientes cl on cl.ca_idcliente = ic.ca_idcliente ";
   $sql.= "	inner join vi_inomaestra_sea im on im.ca_referencia = ic.ca_referencia ";
   $sql.= "	left outer join tb_comcliente cm on cm.ca_idcliente = ic.ca_idcliente and im.ca_fcharribo between cm.ca_fchfirmado and cm.ca_fchvencimiento ";
   $sql.= "    left outer join (select ca_referencia, ca_factura, ca_fchfactura, round(ca_tcambio*ca_neto,0) as ca_vlrfactura from tb_inocostos_sea ic right join tb_costos cs on cs.ca_idcosto = ic.ca_idcosto and cs.ca_costo = 'Firma de Comodatos') fc on fc.ca_referencia = ic.ca_referencia";
   $sql.= "	where im.ca_modalidad = 'FCL'";

   $condicion = "and ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%' and ca_ciudestino like '%$ciudestino%' and $carta and ca_sucursal like '%$sucursal%' ";
   $condicion.= "order by im.ca_ano, im.ca_mes, im.ca_trafico, im.ca_traorigen, im.ca_ciuorigen, im.ca_ciudestino";
   
   // die("$sql $condicion");
   
   if (!$rs->Open("$sql $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
      echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
      //echo "<script>document.location.href = 'entrada.php';</script>";
      exit;
   }

   $eq = & DlRecordset::NewRecordset($conn);
   echo "<HTML>";
   echo "<HEAD>";
   echo "<TITLE>$titulo</TITLE>";
   echo "</HEAD>";
   echo "<BODY>";
   require_once("menu.php");
   echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
   echo "<CENTER>";
   echo "<FORM METHOD=post NAME='informe' ACTION='repcartgarantia.php'>";       // Hace una llamado nuevamente a este script pero con
   echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
   echo "<TR>";
   echo "  <TH Class=titulo COLSPAN=17>" . COLTRANS . "<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
   echo "</TR>";
   echo "<TH>Item</TH>";
   echo "<TH>Referencia</TH>";
   echo "<TH>Trafico Org.</TH>";
   echo "<TH>Puerto Org.</TH>";
   echo "<TH>Puerto Dst.</TH>";
   echo "<TH>Fch.Embarque</TH>";
   echo "<TH>Fch.Arribo</TH>";
   echo "<TH>Nit</TH>";
   echo "<TH>Cliente</TH>";
   echo "<TH>Hbl</TH>";
   echo "<TH>Vendedor</TH>";
   echo "<TH>Sucursal</TH>";
   echo "<TH COLSPAN=2>Carta de Garantía</TH>";
   echo "<TH COLSPAN=3>Factura Comodato</TH>";
   $nom_tra = '';
   $sub_ref = '';
   $num_ref = 0;
   $lin_mem = false;
   while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
      $back_col = ($rs->Value('ca_estado') == 'Provisional') ? " background: #CCCC99" : (($rs->Value('ca_estado') == 'Abierto') ? " background: #CCCCCC" : " ");

      if ($nom_tra != $rs->Value('ca_trafico')) {
         if ($lin_mem) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=17></TD>";
            echo "</TR>";
         }
         echo "<TR>";
         echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=17>TRAFICOS DEL CODIGO: " . $rs->Value('ca_trafico') . "</TD>";
         echo "</TR>";
         $nom_tra = $rs->Value('ca_trafico');
         $num_ref = 0;
         $lin_mem = true;
      }
      if ($sub_ref != substr($rs->Value('ca_referencia'), 0, 3)) {
         $sub_ref = substr($rs->Value('ca_referencia'), 0, 3);
      }
      $num_ref++;

      echo "<TR>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>$num_ref</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_referencia') . " </TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_traorigen') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_ciuorigen') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_ciudestino') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchembarque') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_fcharribo') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_idalterno') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_compania') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_hbls') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_login') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_sucursal') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchfirmado') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchvencimiento') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_factura') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col'>" . $rs->Value('ca_fchfactura') . "</TD>";
      echo "  <TD Class=listar style='font-size: 9px;$back_col; text-align: right;'>" . number_format($rs->Value('ca_vlrfactura'), 0) . "</TD>";
      echo "</TR>";
      $rs->MoveNext();
   }
   echo "<TR HEIGHT=5>";
   echo "  <TD Class=titulo COLSPAN=17></TD>";
   echo "</TR>";
   echo "</TABLE><BR>";

   echo "<TABLE CELLSPACING=10>";
   echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcartgarantia.php\"'></TH>";  // Cancela la operación
   echo "</TABLE>";
   echo "</FORM>";
   echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
   require_once("footer.php");
   echo "</BODY>";
   echo "</HTML>";
}
?>