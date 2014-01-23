<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       IDG_MARITIMO.PHP                                           \\
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

$programa = 42;

$titulo = 'IDG Departamento Marítimo';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($reporte) and !isset($boton) and !isset($accion)){
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='idg_maritimo.php'>";
    echo "<TABLE WIDTH=570 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura></TD>";
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
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'idg_maritimo.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sufijo :<BR><SELECT NAME='trafico'>";
    echo " <OPTION VALUE=%>Sufijos (Todos)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_trafico').">".$tm->Value('ca_trafico')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'idg_maritimo.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
    echo " <OPTION VALUE=%>Todas las Sucursales</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";

    echo "  <TD Class=mostrar>Reporte:<BR><SELECT NAME='reporte'>";                 // Seleciona el tipo de reporte a listar
    echo "  <OPTION VALUE='Facturacion'>Facturación Oportuna</OPTION>";
    echo "  <OPTION VALUE='Confirmacion'>Confirmación de Llegada</OPTION>";
    echo "  </SELECT></TD>";

    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
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
    }
elseif (!isset($boton) and !isset($accion) and $reporte == 'Facturacion'){
	set_time_limit(0);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    $sql="select ca_fchfestivo from tb_festivos where date_part('year',ca_fchfestivo)::text = '".(2000+substr($ano, -1))."' and date_part('month',ca_fchfestivo)::text like '".intval($mes)."'";
    if (!$rs->Open($sql)) {
        echo "error: 113  $sql";
        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $festi = array();
    while (!$rs->Eof() and !$rs->IsEmpty()) {
       array_push($festi, $rs->Value('ca_fchfestivo'));
       $rs->MoveNext();
    }
    $rs->MoveFirst();
	$trafico = ($trafico == '%')?'%':substr($trafico+100,1,2);
	
	/*$queries = "select DISTINCT m.ca_ano, m.ca_mes, m.ca_trafico, i.ca_referencia, i.ca_idcliente, i.ca_compania, i.ca_hbls, i.ca_continuacion, f.ca_fchllegada, f.ca_fchenvio, g.ca_fchfactura, g.ca_factura, g.ca_observaciones from vi_inoclientes_sea i ";
	$queries.= "LEFT OUTER JOIN (select g.ca_referencia, g.ca_idcliente, g.ca_hbls, g.ca_factura, g.ca_fchfactura, g.ca_observaciones from tb_inoingresos_sea g ";
	$queries.= "	RIGHT OUTER JOIN (select ca_referencia, ca_idcliente, ca_hbls, min(ca_fchfactura) as ca_fchfactura from tb_inoingresos_sea group by ca_referencia, ca_idcliente, ca_hbls order by ca_referencia, ca_idcliente, ca_hbls) ii ON (ii.ca_referencia = g.ca_referencia and ii.ca_idcliente = g.ca_idcliente and ii.ca_hbls = g.ca_hbls and ii.ca_fchfactura = g.ca_fchfactura)) g ON (g.ca_referencia = i.ca_referencia and g.ca_idcliente = i.ca_idcliente and g.ca_hbls = i.ca_hbls) ";
	$queries.= "LEFT OUTER JOIN (select ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, rs.ca_fchllegada, max(ca_fchenvio) as ca_fchenvio from tb_repstatus rs ";
	$queries.= "	LEFT OUTER JOIN (select ca_idreporte, ca_consecutivo from tb_reportes order by ca_idreporte) rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa in ('IMCOL','IMCPD')) ";
	$queries.= "	RIGHT OUTER JOIN (select DISTINCT ca_referencia, ca_idcliente, ca_hbls, ca_continuacion, ca_consecutivo from vi_inoclientes_sea order by ca_consecutivo) ic on (rp.ca_consecutivo = ic.ca_consecutivo) 	group by ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, rs.ca_fchllegada order by ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls ) f ON (f.ca_referencia = i.ca_referencia and f.ca_idcliente = i.ca_idcliente and f.ca_hbls = i.ca_hbls) ";
	$queries.= ", vi_inomaestra_sea m where i.ca_referencia = m.ca_referencia and substr(ca_mes,1,2) like '$mes' and substr(ca_mes,4)::text = '".($ano-2000)."' and ca_trafico like '$trafico' and ca_sucursal like '$sucursal' ";
     * 
     */
	//die("$queries");
    $queries = "
         select 
	DISTINCT m.ca_ano, m.ca_mes, m.ca_trafico, i.ca_referencia, i.ca_idcliente, i.ca_compania, i.ca_hbls, 
	i.ca_continuacion, f.ca_fchllegada, f.ca_fchenvio, g.ca_fchfactura, g.ca_factura, g.ca_observaciones 
from vi_inoclientes_sea i 
LEFT OUTER JOIN 
	( 
	  select 
		g.ca_idinocliente, g.ca_idinoingreso ,g.ca_factura, g.ca_fchfactura, g.ca_observaciones 
		from tb_inoingresos_sea g 
	  RIGHT OUTER JOIN (
		select ca_idinocliente,ca_idinoingreso, min(ca_fchfactura) as ca_fchfactura 
		from tb_inoingresos_sea 
		group by ca_idinocliente,ca_idinoingreso order by  ca_idinocliente,ca_idinoingreso ) 

		ii ON 
			(ii.ca_idinocliente = g.ca_idinocliente and ii.ca_idinoingreso = g.ca_idinoingreso)) g ON 
			(g.ca_idinocliente = i.ca_idinocliente) 
	  LEFT OUTER JOIN (select ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, rs.ca_fchllegada, max(ca_fchenvio) as ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN (select ca_idreporte, ca_consecutivo from tb_reportes order by ca_idreporte) rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa in ('IMCOL','IMCPD')) RIGHT OUTER JOIN (select DISTINCT ca_referencia, ca_idcliente, ca_hbls, ca_continuacion, ca_consecutivo from vi_inoclientes_sea order by ca_consecutivo) ic on (rp.ca_consecutivo = ic.ca_consecutivo) group by ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, rs.ca_fchllegada order by ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls ) f ON 
			(f.ca_referencia = i.ca_referencia and f.ca_idcliente = i.ca_idcliente and f.ca_hbls = i.ca_hbls) , 
		vi_inomaestra_sea m 
	  where 
		i.ca_referencia = m.ca_referencia and substr(m.ca_mes,1,2) like '$mes' and m.ca_ano = '".($ano)."' and ca_trafico like '$trafico' and ca_sucursal like '$sucursal' ";
	if (!$rs->Open($queries)) {
        echo "Error 135: $queries";
        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

	echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='idg_maritimo.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=720 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=10>".COLTRANS."<BR>$titulo - $reporte - ".(($sucursal=='%')?'Todas las Sucursales':$sucursal)."</TH>";
    echo "</TR>";
    echo "<TH>No.</TH>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Id Cliente</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>OTM</TH>";
    echo "<TH>Fch.Llegada</TH>";
    echo "<TH>Factura No.</TH>";
    echo "<TH>Fch.Factura</TH>";
    echo "<TH>Diferencia</TH>";
    echo "<TH>Observaciones</TH>";
    $mes_mem = '';
    $ref_mem = '';
    $cli_mem = '';
    $tot_mem = 0;

    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($mes_mem != $rs->Value('ca_mes')) {
           list($mes, $ano) = sscanf($rs->Value('ca_mes'), "%2s-%d");
           echo "<TR>";
           echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=10>".$meses[$mes]."/".(2000+$ano)."</TD>";
           echo "</TR>";
           $mes_mem = $rs->Value('ca_mes');
           $num_ref = 1;
		   $com_mem = '';
          }
       echo "<TR>";
       echo "  <TD Class=listar style='font-size: 8px;'>$num_ref</TD>";
       if ($com_mem != $rs->Value('ca_compania')) {
          echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_referencia')."</TD>";
          echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_idcliente')."</TD>";
          echo "  <TD Class=listar style='font-size: 8px;'>".substr($rs->Value('ca_compania'),0,25)."</TD>";
          $ref_mem = $rs->Value('ca_referencia');
          $cli_mem = $rs->Value('ca_compania');
       }else{
          echo "  <TD Class=listar style='font-size: 8px;' COLSPAN=3></TD>";
       }

       if ( $rs->Value('ca_fchllegada')== '' or $rs->Value('ca_fchfactura')== '' ){
	       $dif_mem = 0;
	   }else if ($rs->Value('ca_fchfactura') >= $rs->Value('ca_fchllegada')){
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchllegada'), "%d-%d-%d");
		   $tstamp_llegado = mktime(8, 0, 0, $mes, $dia, $ano);
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchfactura'), "%d-%d-%d");
		   $tstamp_confirm = mktime(17, 0, 0, $mes, $dia, $ano);
	       $dif_mem = calc_dif($festi, $tstamp_llegado, $tstamp_confirm);
	       $dif_mem = $dif_mem / (60 * 60 * 9);
	   }else{
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchllegada'), "%d-%d-%d");
		   $tstamp_llegado = mktime(17, 0, 0, $mes, $dia, $ano);
		   list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchfactura'), "%d-%d-%d");
		   $tstamp_confirm = mktime(8, 0, 0, $mes, $dia, $ano);
	       $dif_mem = calc_dif($festi, $tstamp_confirm, $tstamp_llegado);
	       $dif_mem = $dif_mem / (60 * 60 * 9);
		   $dif_mem = $dif_mem * -1;
	   }

       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_continuacion')."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_fchllegada')."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_factura')."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_fchfactura')."</TD>";
       echo "  <TD Class=valores style='font-size: 8px;'>".$dif_mem."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_observaciones')."</TD>";
       echo "</TR>";
	   $tot_mem+= $dif_mem;
       $num_ref++;
       $rs->MoveNext();
    }

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=10></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE WIDTH=400 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TD Class=invertir style='font-size: 9px; text-align: center;'></TD>";
    echo "  <TD Class=invertir style='font-size: 9px; text-align: center;'>Promedio</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='font-size: 9px;'>Promedio Ponderado de Días:</TD>";
    echo "  <TD Class=valores style='font-size: 9px;'>".number_format(($tot_mem/($num_ref-1))*100,2)."</TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=3></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"idg_maritimo.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and $reporte == 'Confirmacion'){
    set_time_limit(0);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $sql="select ca_fchfestivo from tb_festivos where date_part('year',ca_fchfestivo)::text = '".(2000+substr($ano, -1))."' and date_part('month',ca_fchfestivo)::text like '".intval($mes)."'";
    if (!$rs->Open($sql)) {
        echo "Error 237: $sql";
        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $festi = array();
    while (!$rs->Eof() and !$rs->IsEmpty()) {
       array_push($festi, $rs->Value('ca_fchfestivo'));
       $rs->MoveNext();
    }

	$trafico = ($trafico == '%')?'%':substr($trafico+100,1,2);
	$queries = "select 	DISTINCT m.ca_ano, m.ca_mes, m.ca_trafico, i.ca_referencia, i.ca_idcliente, i.ca_compania, i.ca_hbls, i.ca_continuacion, m.ca_fchconfirmacion, m.ca_horaconfirmacion, e.ca_fchenvio	from vi_inoclientes_sea i ";
	// $queries.= "LEFT OUTER JOIN (select ia.ca_referencia, ia.ca_idcliente, ia.ca_hbls, min(ia.ca_fchenvio) as ca_fchenvio from tb_inoavisos_sea ia, tb_emails em where ia.ca_idemail = em.ca_idemail and em.ca_subject like 'Confirmación de Llegada%' group by ia.ca_referencia, ia.ca_idcliente, ia.ca_hbls) e ON (i.ca_referencia = e.ca_referencia and i.ca_idcliente = e.ca_idcliente and i.ca_hbls = e.ca_hbls), ";
	$queries.= "LEFT OUTER JOIN ( select rp.ca_consecutivo, min(ca_fchenvio) as ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rs.ca_idreporte = rp.ca_idreporte and rs.ca_idetapa = 'IMCPD') group by rp.ca_consecutivo ) e ON (i.ca_consecutivo = e.ca_consecutivo), ";
	$queries.= "vi_inomaestra_sea m where i.ca_referencia = m.ca_referencia and substr(ca_mes,1,2) like '$mes' and substr(ca_mes,4)::text = '".substr($ano, -1)."' and ca_trafico like '$trafico' and ca_sucursal like '".$sucursal."'";
//    die("$queries");    
    if (!$rs->Open("$queries")) {        
        echo "Error 237: $queries";
        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='idg_maritimo.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=680 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=10>".COLTRANS."<BR>$titulo - $reporte - ".(($sucursal=='%')?'Todas las Sucursales':$sucursal)."</TH>";
    echo "</TR>";
    echo "<TH>No.</TH>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Id Cliente</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>OTM</TH>";
    echo "<TH>Hbl</TH>";
    echo "<TH>Fch.<br>Llegada</TH>";
	echo "<TH>&nbsp</TH>";
    echo "<TH>Fch.<br>Confirmación</TH>";
    echo "<TH>Diferencia</TH>";
    $mes_mem = '';
    $ref_mem = '';
    $cli_mem = '';
    $con_mem = 0;
    $tot_mem = 0;

    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($mes_mem != $rs->Value('ca_mes')) {
           list($mes, $ano) = sscanf($rs->Value('ca_mes'), "%2s-%d");
           echo "<TR>";
           echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=10>".$meses[$mes]."/".(2000+$ano)."</TD>";
           echo "</TR>";
           $mes_mem = $rs->Value('ca_mes');
           $num_ref = 1;
          }
       echo "<TR>";
       echo "  <TD Class=listar style='font-size: 8px;'>$num_ref</TD>";
       if ($com_mem != $rs->Value('ca_compania')) {
          echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_referencia')."</TD>";
          echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_idcliente')."</TD>";
          echo "  <TD Class=listar style='font-size: 8px;'>".substr($rs->Value('ca_compania'),0,25)."</TD>";
          $ref_mem = $rs->Value('ca_referencia');
          $cli_mem = $rs->Value('ca_compania');
       }else{
          echo "  <TD Class=listar style='font-size: 8px;' COLSPAN=3></TD>";
       }

       list($hor, $min, $seg) = sscanf($rs->Value('ca_horaconfirmacion'), "%d:%d:%d");
       list($ano, $mes, $dia) = sscanf($rs->Value('ca_fchconfirmacion'), "%d-%d-%d");
       $tstamp_llegado = ($rs->Value('ca_fchconfirmacion')!='')?mktime($hor, $min, $seg, $mes, $dia, $ano):0;

       list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
       $tstamp_confirm = ($rs->Value('ca_fchenvio')!='')?mktime($hor, $min, $seg, $mes, $dia, $ano):0;
	   
       $dif_mem = ($tstamp_llegado!=0 and $tstamp_confirm!=0)?secs_to_string(calc_dif($festi, $tstamp_llegado, $tstamp_confirm)):0;

       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_continuacion')."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".$rs->Value('ca_hbls')."</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".(($tstamp_llegado!=0)?date("Y-m-d H:i",$tstamp_llegado):'')."</TD>";
       echo "  <TD Class=invertir style='font-size: 8px;'>&nbsp</TD>";
       echo "  <TD Class=listar style='font-size: 8px;'>".(($tstamp_confirm!=0)?date("Y-m-d H:i",$tstamp_confirm):'')."</TD>";
       echo "  <TD Class=invertir style='font-size: 8px; text-align: right;'>$dif_mem</TD>";
	   $tot_mem+= $dif_mem;
       $num_ref++;
       $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=10></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE WIDTH=400 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TD Class=invertir style='font-size: 9px; text-align: center;'></TD>";
    echo "  <TD Class=invertir style='font-size: 9px; text-align: center;'>Promedio</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar style='font-size: 9px;'>Promedio Ponderado de Horas:</TD>";
    echo "  <TD Class=valores style='font-size: 9px;'>".secs_to_string($tot_mem*60/$num_ref)."</TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=3></TD>";
    echo "</TR>";
    echo "</TABLE>";
	echo "<br />";
	echo ($tot_mem*60)."<br />";
	echo ($num_ref)."<br />";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"idg_maritimo.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }

/*
function calc_dif(&$festiv, $inicio, $final){
    $difer = 0;
    $start = $inicio;
//    echo date("F j, Y, H:i:s", $final)."<BR>";
//    echo date("F j, Y, H:i:s", $start)."<BR>";
    while (date("Y-m-d H:i", $start) < date("Y-m-d H:i", $final)){
       list($ano, $mes, $dia, $hor, $min, $seg) = sscanf(date("Y-m-d H:i:s", $start), "%d-%d-%d %d:%d:%d");
       if (date("N", $start)> 5){                                    // Evalua si es un fin de semana
           $start = mktime(8,0,0,$mes,$dia+1,$ano);
           continue;
       }else if (in_array(date("Y-m-d", $start),$festiv)){           // Evalua si es un día festivo
           $start = mktime(8,0,0,$mes,$dia+1,$ano);
           continue;
       }else if ($start < mktime(8,0,0,$mes,$dia,$ano)){             // Evalua si es antes de las 8:00 am
           $start = mktime(8,0,0,$mes,$dia,$ano);
           continue;
       }else if ($start > mktime(16,59,0,$mes,$dia,$ano)){            // Evalua si es después de las 5:00 pm
           $start = mktime(8,0,0,$mes,$dia+1,$ano);
           continue;
       }else{
		   $difer+=60;
		   $start+=60;
	   }
//    echo date("Y-m-d H:i:s", $start)." -> $difer"."<BR>";
    }
    return($difer);
}
*/

function secs_to_string ($secs)
{
  // reset hours, mins, and secs we'll be using
  $hours = 0;
  $mins = 0;
  $secs = intval ($secs);
  $t = array(); // hold all 3 time periods to return as string
  
  // take care of mins and left-over secs
  if ($secs >= 60) {
    $mins += (int) floor ($secs / 60);
    $secs = (int) $secs % 60;
        
    // now handle hours and left-over mins    
    if ($mins >= 60) {
      $hours += (int) floor ($mins / 60);
      $mins = $mins % 60;
    }
    // we're done! now save time periods into our array
    $t['hours'] = (intval($hours) < 10) ? "0" . $hours : $hours;
    $t['mins'] = (intval($mins) < 10) ? "0" . $mins : $mins;
  }

  // what's the final amount of secs?
  $t['secs'] = (intval ($secs) < 10) ? "0" . $secs : $secs;
  
  // build the pretty time string in an ugly way
  $time_string = $t['hours'].":".$t['mins'].":".$t['secs'];
  return empty($time_string) ? 0 : $time_string;
}
?>