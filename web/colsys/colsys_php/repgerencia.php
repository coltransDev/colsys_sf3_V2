<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPGERENCIA.PHP                                             \\
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
$programa = 58;

$titulo = 'Informe para Gerencia Cuadro INO';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Casos con Perdida" => "ca_volumen > 0 and ((ca_facturacion - ca_deduccion - ca_utilidad) / ca_volumen) < 0","Todos los Casos" => "true");

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
    echo "<FORM METHOD=post NAME='menuform' ACTION='repgerencia.php'>";
    echo "<TABLE WIDTH=580 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=8 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
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
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgerencia.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    if (!$tm->Open("select ca_sucursal from vi_usuarios where ca_login = '$usuario'")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    $sucursal = $tm->Value('ca_sucursal');
	if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
    echo " <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    while ( !$tm->Eof()) {
            if ($nivel >= 2 or $sucursal == $tm->Value('ca_sucursal')){
               echo " <OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
            }
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Estados:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each ($estados)) {
        echo " <OPTION VALUE='".$val."'>".$clave;
        }
    echo "  </SELECT></TD>";
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
    set_time_limit(0);
    SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $condicion= "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%' and ". str_replace("\"","'",$casos)." and ca_referencia in (select DISTINCT ca_referencia from vi_inoclientes_sea c where m.ca_referencia=c.ca_referencia and ca_sucursal like '$sucursal') order by ca_traorigen, ca_referencia";
    $sql="select * from vi_inomaestra_sea m $condicion";
//    echo $sql;
//    exit;
    if (!$rs->Open($sql)) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    $cl =& DlRecordset::NewRecordset($conn);
    $eq =& DlRecordset::NewRecordset($conn);
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repgerencia.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=690 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo<BR>$sucursal - $meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Origen</TH>";
    echo "<TH>Destino</TH>";
    echo "<TH COLSPAN=2>Linea</TH>";
    echo "<TH COLSPAN=2>Carga</TH>";
    $nom_tra = '';
    $tot_hbl = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        $sql="select ca_referencia, ca_concepto, sum(ca_cantidad) as ca_cantidad from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."' group by ca_referencia, ca_concepto";
       if (!$eq->Open($sql)) {       // Selecciona todos lo registros de la tabla Traficos
            echo $sql;
           //echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           //echo "<script>document.location.href = 'repgerencia.php?id=178';</script>";
           exit; }
       $eq->MoveFirst();

       if ($nom_tra != $rs->Value('ca_traorigen')) {
           echo "<TR>";
           echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=7>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
           echo "</TR>";
           $nom_tra = $rs->Value('ca_traorigen');
           $sub_fac = 0; $sub_cos = 0; $sub_ded = 0; $sub_ing = 0; $sub_utl = 0;
          }

       $ext_mem = $rs->Value('ca_comisionable') + $rs->Value('ca_nocomisionable');
       $utl_cbm = ($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad')) / $rs->Value('ca_volumen');
       $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" background: #F0F0F0");
       $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
       echo "<TR>";
       echo "  <TD Class=titulo COLSPAN=7></TD>";
       echo "</TR>";
       echo "<TR>";
	   echo "  <TD Class=invertir COLSPAN=7><TABLE WIDTH=100% CELLSPACING=1><TR>";
       echo "  <TD Class=listar WIDTH=100 style='font-weight:bold; font-size: 9px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
       echo "  <TD Class=listar WIDTH=80>".$rs->Value('ca_ciuorigen')."</TD>";
       echo "  <TD Class=listar WIDTH=80>".$rs->Value('ca_ciudestino')."</TD>";
       echo "  <TD Class=listar COLSPAN=2>".$rs->Value('ca_nombre')."</TD>";
       echo "  <TD Class=listar WIDTH=150 COLSPAN=2>";
       while (!$eq->Eof() and !$eq->IsEmpty()) {
              echo $eq->Value('ca_cantidad')." ".$eq->Value('ca_concepto');
              $eq->MoveNext();
              if (!$eq->Eof()) {
                  echo "<BR>";
              }
             }
       echo "  </TABLE></TR></TD>";
       echo "</TR>";
       $sql="select ic.*, iu.ca_sbrventa from vi_inoclientes_sea ic 
           LEFT OUTER JOIN 
                (select ca_idinocliente, sum(ca_valor) as ca_sbrventa 
                    from tb_inoutilidad_sea group by ca_idinocliente) iu ON (ic.ca_idinocliente = iu.ca_idinocliente) where ic.ca_referencia = '".$rs->Value('ca_referencia')."' and ic.ca_sucursal like '$sucursal'";
       if (!$cl->Open($sql)) {       // Selecciona todos lo registros de la tabla Traficos
           echo $sql;
           //echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           //echo "<script>document.location.href = 'repgerencia.php?id=218';</script>";
           exit; }
       $cl->MoveFirst();
       $imp_tit = true;
       $num_reg = $cl->GetRowCount()+1;
       echo "<TR>";
       echo " <TD Class=invertir COLSPAN=7>";
       while (!$cl->Eof() and !$cl->IsEmpty()) {
           if ($imp_tit) {
               echo "<TABLE WIDTH=100% CELLSPACING=1>";
               echo "<TR>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Cliente</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>No.Piezas</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Peso</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Volumen</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Vendedor</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Factura</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Valor</TD>";
               echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Util.xCliente:</TD>";
               echo "    <TD Class=invertir ROWSPAN=$num_reg WIDTH=30 style='font-weight:bold; font-size: 8px; $back_col text-align: center; vertical-align:middle;'>".$rs->Value('ca_estado')."</TD>";
               echo "</TR>";
               $imp_tit = false;
               $par_hbl = array();
               $par_fac = 0;
               $par_sbr = 0;
               $par_utl = 0;
              }
           echo "<TR>";
           echo "    <TD Class=imprimir style='font-size: 9px;'>".substr($cl->Value('ca_compania'),0,35)."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".$cl->Value('ca_numpiezas')."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".$cl->Value('ca_peso')."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".$cl->Value('ca_volumen')."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".$cl->Value('ca_login')."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".$cl->Value('ca_factura')."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".number_format($cl->Value('ca_valor'))."</TD>";
           echo "    <TD Class=valores style='font-size: 9px;'>".number_format($utl_cbm * $cl->Value('ca_volumen'))."</TD>";
           echo "</TR>";
           $par_fac+= $cl->Value('ca_valor');
           if (!in_array($cl->Value('ca_idcliente').'-'.$cl->Value('ca_hbls'), $par_hbl)) {
               array_push($par_hbl, $cl->Value('ca_idcliente').'-'.$cl->Value('ca_hbls'));
               $par_sbr+= $cl->Value('ca_sbrventa');
               $par_utl+= $utl_cbm * $cl->Value('ca_volumen');
               $tot_hbl++;
           }
           $cl->MoveNext();
          }
       if (!$cl->IsEmpty()) {
           echo "  </TABLE>";
          }
       echo " </TD>";
       echo "</TR>";

       echo "<TR>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>Factura Clientes:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>(-) Costo Neto:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>(-) Deducciones:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>(-) Util. Sobreventa: «A»<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>(=) Util. Consolidado: «B»<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center'>(*) Util. Coltrans: «A+B»<BR></TD>";
       echo "</TR>";
       $utl_mem  = ($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad'));
       $back_col = ($utl_mem<=0)?" background: #FF6666":" ";

       echo "<TR>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($par_fac)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_costoneto'))."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_deduccion'))."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($par_sbr)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($par_utl)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($par_sbr + $par_utl)."</TD>";
       echo "</TR>";
	   
       /*
       // Módulo para detectar incosistencias en el calculo de la utilidad
       $vl =& DlRecordset::NewRecordset($conn);
       if (!$vl->Open("select ca_referencia, ca_facturacion, ca_deduccion, ca_utilidad, ca_comisionable from vi_inomaestra_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {
           echo "<script>alert(\"".addslashes($vl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'repgerencia.php';</script>";
           exit; }
       $vl->MoveFirst();
       echo "<TR>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_facturacion')- $par_fac)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_utilidad') - $vl->Value('ca_comisionable') - $rs->Value('ca_costoneto'))."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_deduccion') - $rs->Value('ca_deduccion'))."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_comisionable') - $par_sbr)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_facturacion') - $vl->Value('ca_utilidad') - $vl->Value('ca_deduccion') - $par_utl)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>";

       if (abs(($vl->Value('ca_facturacion')- $par_fac) + ($vl->Value('ca_utilidad') - $vl->Value('ca_comisionable') - $rs->Value('ca_costoneto')) + ($vl->Value('ca_deduccion') - $rs->Value('ca_deduccion')) + ($vl->Value('ca_comisionable') - $par_sbr) + ($vl->Value('ca_facturacion') - $vl->Value('ca_utilidad') - $vl->Value('ca_deduccion') - $par_utl)) > 1){
            echo "ERROR ";
       }
       */
       /*
       $vl =& DlRecordset::NewRecordset($conn);
	   $query = "select ca_referencia, sum(ca_ino) as ca_ino, sum(ca_valor_ded) as ca_valor_ded from ";
	   $query.= "(select ca_referencia, max(ca_ino) as ca_ino, sum(ca_valor_ded) as ca_valor_ded, ca_sucursal from ";
	   $query.= "  ( select ic.ca_referencia, ca_idcliente, ca_hbls, round(((ic.ca_facturacion_r::float-ic.ca_deduccion_r::float-ic.ca_utilidad_r::float)/ic.ca_volumen_r::float*ic.ca_volumen::float)::numeric,0) as ca_ino, (ic.ca_valor_ded::float) as ca_valor_ded, us.ca_sucursal ";
	   $query.= "  from vi_inocomisiones_sea ic inner join vi_usuarios us on ic.ca_login::text = us.ca_login::text and ic.ca_referencia = '".$rs->Value('ca_referencia')."' ) as sb ";
	   $query.= "  group by ca_referencia, ca_idcliente, ca_hbls, ca_sucursal) sc ";
	   $query.= "where ca_sucursal like '$sucursal' group by ca_referencia ";
	   
       if (!$vl->Open("$query")) {
           echo "<script>alert(\"".addslashes($vl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'repgerencia.php';</script>";
           exit; }
       $vl->MoveFirst();
       echo "<TR>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'></TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'></TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'></TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_valor_ded') - $par_sbr)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($vl->Value('ca_ino') - $par_utl)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>";

       if (abs(($vl->Value('ca_valor_ded') - $par_sbr) + ($vl->Value('ca_ino') - $par_utl)) > 1){
            echo "ERROR ";
	   }
	   
       echo "</TD>";
       echo "</TR>";
       *
       */

       $sub_fac+= $par_fac;
       $sub_cos+= $rs->Value('ca_costoneto');
       $sub_ded+= $rs->Value('ca_deduccion');
       $sub_ing+= $par_sbr;
       $sub_utl+= $par_utl;
       $rs->MoveNext();
       if ($nom_tra != $rs->Value('ca_traorigen') or $rs->Eof()) {
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=7></TD>";
           echo "</TR>";
           echo "<TR>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_fac)."</TD>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_cos)."</TD>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_ded)."</TD>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_ing)."</TD>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_utl)."</TD>";
           echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>Utilidad ".$nom_tra." ".number_format($sub_ing + $sub_utl)."</TD>";
           echo "</TR>";
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=7></TD>";
           echo "</TR>";
           $tot_fac+= $sub_fac; $tot_cos+= $sub_cos; $tot_ded+= $sub_ded; $tot_ing+= $sub_ing; $tot_utl+= $sub_utl;
          }
       }
      echo "<TR HEIGHT=5>";
      echo "  <TD Class=titulo COLSPAN=7></TD>";
      echo "</TR>";
      echo "<TR>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_fac)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_cos)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_ded)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_ing)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_utl)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>UTILIDAD ".strtoupper($meses[$mes])." ".number_format($tot_ing + $tot_utl)."</TD>";
      echo "</TR>";
      echo "<TR HEIGHT=5>";
      echo "  <TD Class=titulo COLSPAN=7></TD>";
      echo "</TR>";

    echo "</TABLE><BR><BR>";

    if ($sucursal != '%') {
		if (!$rs->Open("select ca_estado, count(ca_estado) as ca_numero from vi_inomaestra_sea where substr(ca_referencia,8,2)::text like '$mes' and ca_ano::text = '$ano' and ca_traorigen like '%$traorigen%' and ca_referencia in (select DISTINCT ca_referencia from vi_inoclientes_sea where ca_sucursal like '$sucursal') group by ca_estado order by ca_estado")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
	        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
	        echo "<script>document.location.href = 'entrada.php';</script>";
	        exit; }
    }else{
		if (!$rs->Open("select ca_estado, count(ca_estado) as ca_numero from vi_inomaestra_sea where substr(ca_referencia,8,2)::text like '$mes' and ca_ano::text = '$ano' and ca_traorigen like '%$traorigen%' group by ca_estado order by ca_estado")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
	        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
	        echo "<script>document.location.href = 'entrada.php';</script>";
	        exit; }
	}

    echo "<TABLE WIDTH=200 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH Class=titulo COLSPAN=2>RESUMEN PARA EL PERIODO<BR>".(($sucursal=='%')?'Todas las Sucursales - ':$sucursal.' - ')."$meses[$mes]/$ano</TH>";
    $cas_totales = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {
          echo "<TR>";
          echo "  <TD Class=listar>En Estado ".$rs->Value('ca_estado')."</TD>";
          echo "  <TD Class=valores>".number_format($rs->Value('ca_numero'))."</TD>";
          echo "</TR>";
          $cas_totales+= $rs->Value('ca_numero');
          $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=2></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Total Casos Trabajados:</B></TD>";
    echo "  <TD Class=valores><B>".$cas_totales."</B></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><B>Hbls en ".array_search($casos,$estados).":</B></TD>";
    echo "  <TD Class=valores><B>".$tot_hbl."</B></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repgerencia.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>