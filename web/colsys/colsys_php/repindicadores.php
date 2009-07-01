<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPINDICADORES.PHP                                           \\
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

$titulo = 'Generador de Indicadores de Gestión';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$criterios = array( "ca_ano" => "Año", "ca_mes" => "Mes", "ca_sucursal" => "Sucursal", "ca_traorigen" => "Tráfico", "ca_compania" => "Clientes");
$transportes= array("Aéreo","Marítimo");                          // Arreglo con los tipos de Transportes

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>document.location.href = 'entrada.php';</script>";
   }


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($boton) and !isset($agrupamiento)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
	echo "function validar(){";
	echo "  elemento = document.getElementById('cri_elegido');";
	echo "  if (elemento.value == '') {";
	echo "      alert('Debe seleccionar por lo menos un criterio de Ordenamiento');";
	echo "  	elemento = document.getElementById('cri_seleccion');";
	echo "		elemento.focus(); }";
	echo "  else";
	echo "      return (true);";
	echo "  return (false);";
	echo "}";
	echo "function addTable(from,to){";
	echo "if (from.selectedIndex >= 0) {";
	echo "    to.options[to.length] = new Option(from[from.selectedIndex].text,from.value,false,false);";
	echo "    from[from.selectedIndex] = null;";
	echo "    from.focus();";
	echo "    to.options[to.length-1].selected=true; }";
	echo "}";
	echo "function llenar_modalidades(){";
	echo "  modal_element = document.getElementById('modalidad');";
	echo "  trans_element = document.getElementById('transporte');";
	echo "	modal_element.length=0;";
	echo "	modal_element.options[modal_element.length] = new Option();";
	echo "	modal_element.length=0;";
	echo "	modal_element[modal_element.length] = new Option('(Todas)','%',false,false);";
	echo "	if (trans_element.value=='Aéreo'){";
	echo "		modal_element[modal_element.length] = new Option('CONSOLIDADO','CONSOLIDADO',false,false);";
	echo "	}else if (trans_element.value=='Marítimo'){";
	echo "	    modal_element[modal_element.length] = new Option('LCL','LCL',false,false);";
	echo "		modal_element[modal_element.length] = new Option('FCL','FCL',false,false);";
	echo "		modal_element[modal_element.length] = new Option('COLOADING','COLOADING',false,false);";
	echo "		modal_element[modal_element.length] = new Option('PROYECTOS','PROYECTOS',false,false);";
	echo "	}";
	echo "}";
    echo "</script>";


    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repindicadores.php' ONSUBMIT='return validar();'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</B></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 10px;'>Pulse la tecla control para seleccionar varios ítems <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'></TH>";
    echo "</TR>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }

    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$us->Open("select ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_nombre")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit;
       }
    $us->MoveFirst();
    while (!$us->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='usu_nombre' VALUE='".$us->Value('ca_nombre')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='usu_sucursal' VALUE='".$us->Value('ca_sucursal')."'>";
           $us->MoveNext();
          }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=4></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano[]' SIZE=5 MULTIPLE>";
	$sel = "SELECTED";
    for ( $i=0; $i<5; $i++ ){
          echo " <OPTION VALUE=".(date('Y')-$i)." $sel>".(date('Y')-$i)."</OPTION>";
		  $sel = "";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes[]' SIZE=13 MULTIPLE>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Sucursal:<BR><SELECT ID=sucursal NAME='sucursal[]' SIZE=10 MULTIPLE>";
    echo "  <OPTION VALUE=% SELECTED>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
		   echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."' $sel>".$tm->Value('ca_sucursal')."</OPTION>";
           $tm->MoveNext();
          }
    echo "  </SELECT></TD>";
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar>Tráfico :<BR><SELECT NAME='traorigen[]' SIZE=10 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repindicadores.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar>Puerto Destino :<BR><SELECT NAME='ciudestino[]' SIZE=6 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Puertos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_ciudad')."'>".$tm->Value('ca_ciudad')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";
	

    echo "  <TH style='vertical-align:bottom;' ROWSPAN=5><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'><BR /><BR /></TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar>Cliente: </TD>";
    echo "  <TD Class=listar COLSPAN=4><INPUT TYPE='text' NAME='cliente' size='100'></TD>";
    echo "</TR>";

    if (!$tm->Open("select ca_valor from tb_parametros where ca_casouso = 'CU072'")) {    // Selecciona los registros de la tabla parámetros
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        exit;
        }
    echo "  <TD Class=listar>Indicador: </TD>";
    echo "  <TD Class=listar COLSPAN=4><SELECT NAME='indicador'>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_valor')."'>".$tm->Value('ca_valor')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";

    echo "<TR>";
    echo "  <TD Class=listar></TD>";

    echo "  <TD Class=listar>Transporte:<BR><SELECT ID='transporte' NAME='transporte[]' ONCHANGE='llenar_modalidades();'>";
	for ($i=0; $i < count($transportes); $i++) {
		echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i]."</OPTION>"; }
    echo "  </SELECT></TD>";

    echo "  <TD Class=listar>Modalidad:<BR><SELECT ID='modalidad' NAME='modalidad[]'></SELECT></TD>";

    echo "  <TD Class=destacar COLSPAN=2>Criterios de Agrupamiento: <BR/><TABLE CELLSPACING=1>";
	echo"     <TD Class=invertir WIDTH='100' style='text-align:right;'><SELECT ID=cri_seleccion NAME='criterio' SIZE=6>";   // Llena el cuadro de lista con los valores de la tabla campos
    while (list ($clave, $val) = each ($criterios)) {
        echo "   <OPTION VALUE='$clave'>$val</OPTION>";
        }
	echo"     </SELECT>";
	echo"     </TD>";
    echo "    <TD Class=invertir WIDTH='20' style='text-align:center;'>";
	echo"       <INPUT TYPE='BUTTON' NAME='pasar' VALUE='>>' ONCLICK='addTable(document.getElementById(\"cri_seleccion\"),document.getElementById(\"cri_elegido\"));'><br>"; // Controles para trasladar elementos seleccionados
	echo"       <INPUT TYPE='BUTTON' NAME='pasar'  VALUE='<<' ONCLICK='addTable(document.getElementById(\"cri_elegido\"),document.getElementById(\"cri_seleccion\"));'>";
	echo"     </TD>";
    echo "    <TD Class=invertir WIDTH='100'>";
	echo"       <SELECT ID=cri_elegido NAME='agrupamiento[]' MULTIPLE SIZE=6></SELECT>";         // Cuadro de lista receptor de campos elegidos
	echo"     </TD>";

	echo"   </TD></TABLE>";
	echo"</TD></TR>";
	
    echo "  <TD Class=listar COLSPAN=3></TD>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
	echo "<script language='javascript'>llenar_modalidades();</script>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"repindicadores.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($agrupamiento)){
	set_time_limit(0);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
	include_once 'include/functions.php';                                      // Módulo de Funciones Varias
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

	$ano_mem = implode(',',$ano);
	$mes_mem = implode(',',$mes);
	
	$ano_fes = "to_char(ca_fchfestivo,'YYYY') ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
	$ano = "ca_ano ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
	$mes_fes = "to_char(ca_fchfestivo,'MM') ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
	$mes = "ca_mes ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
	$sucursal = "ca_sucursal ".((count($sucursal)==1)?"like '$sucursal[0]'":"in ('".implode("','",$sucursal)."')");
	$cliente = ((strlen($cliente)!=0)?"and upper(ca_compania) like upper('%$cliente%')":"");
	$traorigen = "ca_traorigen ".((count($traorigen)==1)?"like '$traorigen[0]'":"in ('".implode("','",$traorigen)."')");
	$modalidad = "ca_modalidad ".((count($modalidad)==1)?"like '$modalidad[0]'":"in ('".implode("','",$modalidad)."')");
	$transporte = "ca_transporte ".((count($transporte)==1)?"like '$transporte[0]'":"in ('".implode("','",$transporte)."')");

	$campos = "";
	while (list ($clave, $val) = each ($agrupamiento)) {
		$campos.= $val.",";
	}
	$campos = substr($campos,0,strlen($campos)-1);
    $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'repindicadores.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repindicadores.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos

	switch ($indicador) {
		case "Confirmación Salida de la Carga":
			$source   = "vi_repindicadores";
			$ind_mem  = 1;
			$add_cols = 3;
			break;
		case "Tiempo de Tránsito":
			$source   = "vi_repindicadores";
			$ind_mem  = 2;
			$add_cols = 3;
			break;
		case "Tiempo de Desconsolidación":
			$source   = "vi_repindicadores";
			$ind_mem  = 3;
			$add_cols = 4;
			break;
		case "Información Oportuna":
			$source   = "vi_repindicadores";
			if (!$tm->Open("select ca_fchfestivo from tb_festivos where $ano_fes and $mes_fes")) {        // Selecciona todos lo registros de la tabla Festivos
				echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'entrada.php';</script>";
				exit; }
			$festi = array();
			while (!$tm->Eof() and !$tm->IsEmpty()) {
				$festi[] = $tm->Value('ca_fchfestivo');
				$tm->MoveNext();
			}
			$tm->MoveFirst();
			$ind_mem  = 4;
			$add_cols = 3;
			break;
		case "Oportunidada de Primer Status":
			$source   = "vi_repindicadores";
			if (!$tm->Open("select ca_fchfestivo from tb_festivos where $ano_fes and $mes_fes")) {        // Selecciona todos lo registros de la tabla Festivos
				echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
				echo "<script>document.location.href = 'entrada.php';</script>";
				exit; }
			$festi = array();
			while (!$tm->Eof() and !$tm->IsEmpty()) {
				$festi[] = $tm->Value('ca_fchfestivo');
				$tm->MoveNext();
			}
			$tm->MoveFirst();
			$ind_mem  = 5;
			$add_cols = 3;
			break;
		case "Cumplimiento de Proveedores":
			$source   = "vi_repindicadores";
			$ind_mem  = 6;
			$add_cols = 3;
			break;
		case "Oportunidad en Entrega de Cotizaciones":
			$source   = "vi_cotindicadores";
			$ind_mem  = 7;
			$add_cols = 3;
			break;
		case "Emisión de Factura":
			$source   = "vi_repindicadores";
			$ind_mem  = 8;
			$add_cols = 3;
			break;
	}

	$queries = "select * from $source where $sucursal $cliente and $transporte and $ano and $mes";
	$queries.= " order by $campos";
	// echo $queries."<br />";
    if (!$rs->Open("$queries")) {                       							// Selecciona todos lo registros de la vista vi_repgerencia_sea 
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      		// Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }


	echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=".(10+$add_cols).">COLTRANS S.A.<BR>$titulo<BR>$mes_mem / $ano_mem</TH>";
    echo "</TR>";
	echo "<TR>";
	$saltos = array();
	$titems = array();
	echo "	<TH>Reporte</TH>";
	echo "	<TH>Ver.</TH>";
	echo "	<TH>Año</TH>";
	echo "	<TH>Mes</TH>";
	echo "	<TH>Sucursal</TH>";
	echo "	<TH>T.Origen</TH>";
	echo "	<TH>Destino</TH>";
	echo "	<TH>Transporte</TH>";
	echo "	<TH>Modalidad</TH>";
	echo "	<TH>Cliente</TH>";
	switch ($ind_mem) {
		case 1:
			echo "	<TH>Fch.Salida</TH>";
			echo "	<TH>Envío Msg</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 2:
			echo "	<TH>Fch.Salida</TH>";
			echo "	<TH>Fch.Llegada</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 3:
			echo "	<TH>Referencia</TH>";
			echo "	<TH>Fch.Llegada</TH>";
			echo "	<TH>Fch.Desconsolidación</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 4:
			echo "	<TH>Fch.Status</TH>";
			echo "	<TH>Envío Msg</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 5:
			echo "	<TH>Fch.Reporte</TH>";
			echo "	<TH>Primer Status</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 6:
			echo "	<TH>E.T.A.</TH>";
			echo "	<TH>Fch.Llegada</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 7:
			echo "	<TH>Fch.Solicitud</TH>";
			echo "	<TH>Fch.Envio</TH>";
			echo "	<TH>Dif.</TH>";
			break;
		case 8:
			echo "	<TH>Fch.Llegada</TH>";
			echo "	<TH>Fch.Factura</TH>";
			echo "	<TH>Dif.</TH>";
			break;
	}
	echo "</TR>";
	$rs->MoveFirst();
    while (!$rs->Eof() and !$rs->IsEmpty()){                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
		if ($ind_mem == 3 and ($rs->Value('ca_transporte') != 'Marítimo' or $rs->Value('ca_modalidad') != 'LCL')){
			$rs->MoveNext();
			continue;
		}
		echo "<TR>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_consecutivo')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_version')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_ano')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_mes')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_sucursal')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_traorigen')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_ciudestino')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_transporte')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_modalidad')."</TD>";
		echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_compania')."</TD>";
		switch ($ind_mem) {
			case 1:
				if (!$tm->Open("select ca_fchsalida, to_date((ca_fchenvio::timestamp)::text,'yyyy-mm-dd') as ca_fchenvio, to_date((ca_fchenvio::timestamp)::text,'yyyy-mm-dd')-ca_fchsalida as ca_diferencia from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte)	where not nullvalue(ca_fchsalida) and ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_consecutivo ASC limit 1")) {       // Selecciona todos lo registros de la tabla Status
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchsalida')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchenvio')."</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$tm->Value('ca_diferencia')."</TD>";
				break;
			case 2:
				if (!$tm->Open("select ca_fchsalida, ca_fchllegada, ca_fchllegada-ca_fchsalida as ca_diferencia from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where not nullvalue(ca_fchllegada) and ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_fchenvio DESC limit 1")) {       // Selecciona todos lo registros de la tabla Status
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchsalida')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchllegada')."</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$tm->Value('ca_diferencia')."</TD>";
				break;
			case 3:
				if (!$tm->Open("select ic.ca_referencia, rp.ca_consecutivo, im.ca_fchconfirmacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END) as ca_fchdesconsolidacion, (CASE WHEN to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') < im.ca_fchconfirmacion THEN NULL ELSE to_date(im.ca_fchdesconsolidacion,'YYYY-MM-DD') END)-im.ca_fchconfirmacion as ca_diferencia from tb_inoclientes_sea ic LEFT OUTER JOIN tb_reportes rp ON (ic.ca_idreporte::text = rp.ca_idreporte::text) LEFT OUTER JOIN tb_inomaestra_sea im ON (ic.ca_referencia = im.ca_referencia) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ic.ca_referencia, im.ca_fchconfirmacion")) {       // Selecciona todos lo registros de la tabla InoClientes / InoMaestra
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_referencia')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchconfirmacion')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchdesconsolidacion')."</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$tm->Value('ca_diferencia')."</TD>";
				break;
			case 4:
				if (!$tm->Open("select ca_fchrecibo, ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_fchrecibo")) {       // Selecciona todos lo registros de la tabla Status
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				$adicionales = false;
				while (!$tm->Eof() and !$tm->IsEmpty()) {
					if ($adicionales){
						echo "<TR>";
						echo "  <TD Class=mostrar COLSPAN=10></TD>";
					}
					echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchrecibo')."</TD>";
					echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchenvio')."</TD>";

					list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($tm->Value('ca_fchrecibo'), "%d-%d-%d %d:%d:%d");
					$tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
					list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($tm->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
					$tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
					$dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado);
					echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
					if ($adicionales){
						echo "</TR>";
					}
					$adicionales = true;
					$tm->MoveNext();
				}
				if (!$adicionales){
					echo "  <TD Class=mostrar></TD>";
					echo "  <TD Class=mostrar></TD>";
					echo "  <TD Class=invertir></TD>";
				}
				break;
			case 5:
				if (!$tm->Open("select ca_fchcreado as ca_fchreporte, ca_fchenvio from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_fchenvio ASC limit 1 order by ca_fchcreado")) {       // Selecciona todos lo registros de la tabla Status
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchreporte')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchenvio')."</TD>";
				list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($tm->Value('ca_fchreporte'), "%d-%d-%d %d:%d:%d");
				$tstamp_recibido = mktime($hor, $min, $seg, $mes, $dia, $ano);
				list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($tm->Value('ca_fchenvio'), "%d-%d-%d %d:%d:%d");
				$tstamp_enviado = mktime($hor, $min, $seg, $mes, $dia, $ano);
				$dif_mem = calc_dif($festi, $tstamp_recibido, $tstamp_enviado);
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".$dif_mem."</TD>";
				break;
			case 6:
				if (!$tm->Open("select ca_fchllegada from tb_repstatus rs LEFT OUTER JOIN tb_reportes rp ON (rp.ca_idreporte = rs.ca_idreporte) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' order by ca_fchllegada")) {       // Selecciona todos lo registros de la tabla Status
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				$first_date = true;
				$fch_eta = $fch_llegada = null;
				while (!$tm->Eof() and !$tm->IsEmpty()) {
					if ($first_date and strlen($tm->Value('ca_fchllegada'))!= 0){
						$fch_eta = $tm->Value('ca_fchllegada');
						$first_date = false;
					}
					$fch_llegada = $tm->Value('ca_fchllegada');
					$tm->MoveNext();
				}
				echo "  <TD Class=mostrar style='font-size: 9px;'>$fch_eta</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>$fch_llegada</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".dateDiff($fch_eta,$fch_llegada)."</TD>";
				break;
			case 7:
				list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($rs->Value('ca_fchpresentacion'), "%d-%d-%d %d:%d:%d");
				$fch_presenta = (strlen($ano)!=0)?date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $ano)):null;
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$rs->Value('ca_fchsolicitud')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$fch_presenta."</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".dateDiff($rs->Value('ca_fchsolicitud'),$fch_presenta)."</TD>";
				break;
			case 8:
				if ($rs->Value('ca_transporte') == 'Aéreo' and $rs->Value('ca_continuacion') == 'N/A'){
					$script = "select iia.ca_fchfactura, rs.ca_fchllegada from tb_inoingresos_air iia LEFT OUTER JOIN tb_inoclientes_air ica ON (iia.ca_referencia = ica.ca_referencia and iia.ca_idcliente = ica.ca_idcliente and iia.ca_hawb = ica.ca_hawb)";
					$script.= "	LEFT OUTER JOIN tb_repstatus rs ON (rs.ca_idemail::text = '".$rs->Value('ca_idemail')."') where ica.ca_idreporte = '".$rs->Value('ca_consecutivo')."'";
					$script.= "	order by ca_fchfactura ASC limit 1";
				} else if ($rs->Value('ca_transporte') == 'Marítimo' and $rs->Value('ca_continuacion') == 'N/A'){
					$script = "select iis.ca_fchfactura, rs.ca_fchllegada from tb_inoingresos_sea iis";
					$script.= "	LEFT OUTER JOIN tb_inoclientes_sea ics ON (iis.ca_referencia = ics.ca_referencia and iis.ca_idcliente = ics.ca_idcliente and iis.ca_hbls = ics.ca_hbls)";
					$script.= "	LEFT OUTER JOIN tb_reportes rp ON (ics.ca_idreporte = rp.ca_idreporte)";
					$script.= "	LEFT OUTER JOIN tb_repstatus rs ON (rs.ca_idemail::text = '".$rs->Value('ca_idemail')."') where rp.ca_consecutivo = '".$rs->Value('ca_consecutivo')."'";
					$script.= "	order by ca_fchfactura ASC limit 1";
				}
				if (!$tm->Open("$script")) {       // Selecciona todos lo registros de la tabla InoIngresos
					echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
					echo "<script>document.location.href = 'repindicadores.php';</script>";
					exit; }
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchfactura')."</TD>";
				echo "  <TD Class=mostrar style='font-size: 9px;'>".$tm->Value('ca_fchllegada')."</TD>";
				echo "  <TD Class=invertir style='font-size: 9px; text-align:right;'>".dateDiff($tm->Value('ca_fchfactura'),$tm->Value('ca_fchllegada'))."</TD>";
				break;
		}
		
    	$rs->MoveNext();
    }
	echo "<TR HEIGHT=5>";
    echo "  <TH Class=titulo COLSPAN=".(10+$add_cols)."></TH>";
    echo "</TR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repindicadores.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
    }

?>