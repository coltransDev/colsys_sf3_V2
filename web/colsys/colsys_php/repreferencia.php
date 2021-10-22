<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPREFERENCIA.PHP                                           \\
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
$programa = 53;
$titulo = 'Informe de Referencias Procesadas';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");

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
    echo "<FORM METHOD=post NAME='menuform' ACTION='repreferencia.php'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=9 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";    
    for ( $i=5; $i>=-1; $i-- ){
          $sel = (date('Y')==date('Y')-$i)?'SELECTED':'';
          echo " <OPTION VALUE=".(date('Y')-$i)." $sel>".(date('Y')-$i)."</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
    echo " <OPTION VALUE='%'>Todos los meses</OPTION>";
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
        echo "<script>document.location.href = 'repreferencia.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Puerto de Destino :<BR><SELECT NAME='ciudestino'>";
    echo " <OPTION VALUE=%>Todos los Puertos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_ciudad').">".$tm->Value('ca_ciudad')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    echo "  <TD Class=mostrar>Sucursal:<BR><SELECT NAME='sucursal'>";
    echo "  <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
		   echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
           $tm->MoveNext();
          }
	
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Estado:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each ($estados)) {
        echo " <OPTION VALUE='".$val."'>".$clave;
        }
    echo "  </SELECT></TD>";
    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=8></TD>";
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
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
/*	
	$query = "select im.ca_referencia, substr(im.ca_referencia,5,2) as ca_trafico, tr.ca_nombre as ca_traorigen, substr(im.ca_referencia,1,3) as ca_modal, im.ca_observaciones,";
	$query.= "  (case when im.ca_provisional then 'Provisional' else (case when nullvalue(im.ca_usucerrado) = false and length(im.ca_usucerrado) != 0 then 'Cerrado' else 'Abierto' end) end) as ca_estado";
	$query.= "  from tb_inomaestra_sea im";
	$query.= "  LEFT OUTER JOIN tb_ciudades cd ON (im.ca_origen = cd.ca_idciudad)";
	$query.= "  LEFT OUTER JOIN tb_traficos tr ON (cd.ca_idtrafico = tr.ca_idtrafico)";
	$query.= "  where substr(im.ca_referencia,8,2)::text = '$mes' and substr(im.ca_referencia,15)::text = '".($ano-2000)."' and  substr(im.ca_referencia,5,2)::text like '%$trafico%'"." and tr.ca_nombre like '%$traorigen%' and ".str_replace("\\","", str_replace("\"","'",$casos))." and ";
	$query.= "  ca_referencia in (select ca_referencia from tb_inoclientes_sea ic LEFT OUTER JOIN control.tb_usuarios us ON (ic.ca_login = us.ca_login) where us.ca_sucursal like '%$sucursal%')";
	
    if (!$rs->Open("$query order by ca_trafico, ca_modal, ca_referencia")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
*/
    
    
	$condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_trafico like '%$trafico%' and ca_traorigen like '%$traorigen%' and ca_ciudestino like '%$ciudestino%' and ".str_replace("\\","", str_replace("\"","'",$casos))." and ca_sucursal like '%$sucursal%'";
    
    if (!$rs->Open("select DISTINCT ca_referencia, ca_trafico, ca_traorigen, ca_modal, ca_observaciones, ca_fcharribo, ca_iddocactual, ca_fchenvio, ca_usuenvio from vi_inoconsulta_sea $condicion order by ca_trafico, ca_modal, ca_referencia")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

	$tm =& DlRecordset::NewRecordset($conn);
    $sql = "select ca_fchfestivo from tb_festivos where to_char(ca_fchfestivo,'YYYY')::int = $ano ";
    
    if( $mes!="%"){
       $sql.=" and to_char(ca_fchfestivo,'mm')::int = $mes"; 
    }
    
    
	if (!$tm->Open( $sql )) {        // Selecciona todos lo registros de la tabla Festivos
		echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
		//echo "<script>document.location.href = 'entrada.php';</script>";
		exit; }
	$festi = array();
	while (!$tm->Eof() and !$tm->IsEmpty()) {
		$festi[] = $tm->Value('ca_fchfestivo');
		$tm->MoveNext();
	}

    $cl =& DlRecordset::NewRecordset($conn);
    $eq =& DlRecordset::NewRecordset($conn);
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<FORM METHOD=post NAME='informe' ACTION='repreferencia.php'>";       // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH WIDTH=50>Item</TH>";
    echo "<TH WIDTH=100>Referencia</TH>";
    echo "<TH WIDTH=80>Estado</TH>";
    echo "<TH WIDTH=70>E.T.A.</TH>";
    echo "<TH WIDTH=150>Id.Doc</TH>";
    echo "<TH WIDTH=70>Pres.Muisca</TH>";
    echo "<TH WIDTH=70>Usu.Envío</TH>";
    $nom_tra = '';
    $sub_ref = '';
    $num_ref = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" ");

       if ($nom_tra != $rs->Value('ca_trafico')) {
           echo "<TR>";
           echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=7>TRAFICOS DEL CODIGO: ".$rs->Value('ca_trafico')."</TD>";
           echo "</TR>";
           $nom_tra = $rs->Value('ca_trafico');
           $num_ref = 0;
          }
       if ($sub_ref != substr($rs->Value('ca_referencia'),0,3)) {
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=7></TD>";
           echo "</TR>";
           $sub_ref = substr($rs->Value('ca_referencia'),0,3);
           $num_ref = 0;
          }
       $num_ref++;

       $startArry = date_parse(date('Y-m-d H:i:s'));
	   $endArry = date_parse($rs->Value('ca_fcharribo')." 00:00:00");
	   
       $tstamp_actual = mktime($startArry[hour], $startArry[minute], $startArry[second], $startArry[month], $startArry[day], $startArry[year]);
       $tstamp_fcharribo = mktime($endArry[hour], $endArry[minute], $endArry[second], $endArry[month], $endArry[day], $endArry[year]);

	   if ($tstamp_actual > $tstamp_fcharribo and $rs->Value('ca_iddocactual')==""){
	       $class = "resaltar";
	   }else{
	       $dif_mem = workDiff($festi, date('Y-m-d'), $rs->Value('ca_fcharribo'));
		   if ($dif_mem > 2){
		       $class = "normal";
		   }else {
		       $dif_mem = calc_dif($festi, $tstamp_actual, $tstamp_fcharribo);
			   $dif_hou = date_parse($dif_mem);
		   
			   if ($dif_hou[hour] > 8 and $rs->Value('ca_iddocactual')==""){
				   $class = "destacar";
			   }else if ($dif_hou[hour] <= 8 and $rs->Value('ca_iddocactual')==""){
				   $class = "negativo";
			   }else{
				   $class = "listar";
			   }
		   }
	   }

       echo "<TR>";
       echo "  <TD Class=listar style='font-size: 9px;$back_col'>$num_ref</TD>";
       echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_referencia')." </TD>";
       echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_estado')."</TD>";
       echo "  <TD Class=$class style='font-size: 9px;$back_col'>".$rs->Value('ca_fcharribo')."</TD>";
       echo "  <TD Class=$class style='font-size: 9px;$back_col'>".$rs->Value('ca_iddocactual')."</TD>";
       echo "  <TD Class=$class style='font-size: 9px;$back_col'>".$rs->Value('ca_fchenvio')."</TD>";
       echo "  <TD Class=$class style='font-size: 9px;$back_col'>".$rs->Value('ca_usuenvio')."</TD>";
       echo "</TR>";
	   if ($rs->Value('ca_observaciones') != ''){
		   echo "<TR>";
		   echo "  <TD Class=listar></TD>";
		   echo "  <TD Class=listar COLSPAN=6 style='font-size: 9px;$back_col'><b>Observaciones: </b>".nl2br($rs->Value('ca_observaciones'))."</TD>";
		   echo "</TR>";
	   }
       $rs->MoveNext();
      }
    echo "</TABLE><BR>";

    echo "<TABLE WIDTH=600 CELLSPACING=1>";
	echo "<TR>";
    echo "  <TD Class=titulo COLSPAN=5 style='font-size: 9px;$back_col font-weight:bold;'>Convenciones</TD>";
	echo "</TR>";
	echo "<TR>";
    echo "  <TD WIDTH='20%' Class=resaltar style='text-align: center; font-size: 9px;$back_col'>No se Reportó</TD>";
    echo "  <TD WIDTH='20%' Class=destacar style='text-align: center; font-size: 9px;$back_col'>Próximo a vencer</TD>";
    echo "  <TD WIDTH='20%' Class=negativo style='text-align: center; font-size: 9px;$back_col'>Menos de 24 Horas</TD>";
    echo "  <TD WIDTH='20%' Class=normal style='text-align: center; font-size: 9px;$back_col'>Normal</TD>";
    echo "  <TD WIDTH='20%' Class=listar style='text-align: center; font-size: 9px;$back_col'>Reportado</TD>";
	echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repreferencia.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>