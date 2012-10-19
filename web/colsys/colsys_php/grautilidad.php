<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       GRAUTILIDAD.PHP                                             \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Distribición de Utilidades por Sucursal                     \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Distribición de Utilidades por Sucursal';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($sucursal) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='grautilidad.php'>";
	echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
	echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
	for ( $i=5; $i>=0; $i-- ){
		  echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
		}
	echo "  </SELECT></TD>";
	echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
	while (list ($clave, $val) = each ($meses)) {
		echo " <OPTION VALUE=$clave";
		if (date('m')==$clave) {
		    echo" SELECTED"; }
		echo ">$val</OPTION>";
		}
	echo "  <OPTION VALUE=%>Todo el Año</OPTION>";
	echo "  </SELECT></TD>";
	$tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
	    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
	    echo "<script>document.location.href = 'grautilidad.php';</script>";
	    exit; }
	$tm->MoveFirst();
	echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
	echo "  <OPTION VALUE=%>Todas las Sucursales</OPTION>";
	while ( !$tm->Eof()) {
			echo " <OPTION VALUE=".$tm->Value('ca_sucursal').">".$tm->Value('ca_sucursal')."</OPTION>";
	        $tm->MoveNext();
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
    }
elseif (!isset($boton) and !isset($accion) and isset($sucursal)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
	$condicion= "substr(ca_referencia,8,2) like '$mes' and substr(ca_referencia,15) = '".substr($ano, -1)."' and ca_sucursal like '%$sucursal%'";

    if (!$rs->Open("select * from vi_inocomisiones_sea where $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

	$log_ven = '';
	$ref_mem = '';
	$nom_cli = '';
	$hbl_cli = '';
	$sucursales = array();
	$utilidad = array();

    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
	 	if (!in_array($rs->Value('ca_sucursal'), $sucursales)) {
	 		array_push($sucursales, $rs->Value('ca_sucursal'));
	 	    array_push($utilidad, 0);
	 		}
       $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
	   if ($log_ven != $rs->Value('ca_login')) {
           if (!$us->Open("select ca_nombre from control.tb_usuarios where ca_login = '".$rs->Value('ca_login')."'")) {
               echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
               echo "<script>document.location.href = 'grautilidad.php';</script>";
               exit; 
			}
		   $utl_con = 0;
		   $sob_ven = 0;
		   $log_ven = $rs->Value('ca_login');
		   $nom_ven = $us->Value('ca_nombre');
	   }
	   $ref_mem = $rs->Value('ca_referencia');
	   $suc_mem = $rs->Value('ca_sucursal');
	   $nom_cli = $rs->Value('ca_compania');
	   $hbl_cli = $rs->Value('ca_hbls');
	   $utl_con+= $rs->Value('ca_volumen') * $utl_cbm;
	   $mul_lin = false;
	   $arr_fac = array();
	   while ($ref_mem == $rs->Value('ca_referencia') and $nom_cli == $rs->Value('ca_compania') and $hbl_cli == $rs->Value('ca_hbls') and !$rs->Eof()) {
		   $imp_mem = (in_array($rs->Value('ca_factura_ded'),$arr_fac))?false:true;
	       if ($imp_mem and $rs->Value('ca_valor_ded') != 0) {
			   $sob_ven+= $rs->Value('ca_valor_ded');
			   array_push($arr_fac,$rs->Value('ca_factura_ded'));
			   $mul_lin = true;
		      }
		   else if ($imp_mem) {
			   array_push($arr_fac,$rs->Value('ca_factura_ded'));
		      }
		   $rs->MoveNext();
	      }
		while (list ($clave, $val) = each ($sucursales)) {
	 		if ($val == $suc_mem) {
	 			break;
	 			}
	 		}
	 	$utilidad[$clave]+= $utl_cbm + $sob_ven;
       }
	reset($sucursales);
	while (list ($clave, $val) = each ($sucursales)) {
		echo "$clave => $val<br>";
		}
	reset($utilidad);
	while (list ($clave, $val) = each ($utilidad)) {
		echo "$clave => $val<br>";
		}
    }
?>