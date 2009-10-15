<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPGENERATOR.PHP                                           \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   Reporte de Cuadro INO para Gerencia.                        \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Generador de Informes M�dulo Mar�timo';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$criterios = array( "ca_ano" => "A�o", "ca_mes" => "Mes", "ca_sucursal" => "Sucursal", "ca_traorigen" => "Tr�fico", "ca_vendedor" => "Vendedor", "ca_compania" => "Clientes", "ca_estado" => "Estado", "ca_ciudestino" => "Puerto/Destino", "ca_nomlinea" => "Naviera");
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                     // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessi�n abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
    echo "<script>document.location.href = 'entrada.php';</script>";
   }


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($boton) and !isset($agrupamiento)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
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
    echo "function llenar_vendedores(){";
	echo "  source = document.getElementById('sucursal');";
	echo "  elemento = document.getElementById('login');";
    echo "  elemento.length = 0;";
    echo "  elemento.options[elemento.length] = new Option();";
    echo "  elemento.length = 0;";
    echo "  elemento[elemento.length] = new Option('Vendedores (Todos)','%',false,true);";
    echo "     for (cont=0; cont<document.menuform.usu_nombre.length; cont++) {";
    echo "          if (source.value == document.menuform.usu_sucursal[cont].value){";
    echo "              elemento[elemento.length] = new Option(document.menuform.usu_nombre[cont].value,document.menuform.usu_nombre[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repgenerator.php' ONSUBMIT='return validar();'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los par�metros para el Reporte</B></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TH COLSPAN=7 style='font-size: 10px;'>Pulse la tecla control para seleccionar varios �tems <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'></TH>";
    echo "</TR>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }

    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
    if (!$us->Open("select ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_nombre")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit;
       }
    $us->MoveFirst();
    while (!$us->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='usu_nombre' VALUE='".$us->Value('ca_nombre')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='usu_sucursal' VALUE='".$us->Value('ca_sucursal')."'>";
           $us->MoveNext();
          }

    $nv =& DlRecordset::NewRecordset($conn);
    if (!$nv->Open("select distinct ca_idlinea, ca_nombre from vi_transporlineas where ca_transporte = 'Mar�timo' order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($nv->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=5></TD>";
    echo "  <TD Class=listar ROWSPAN=2>A�o:<BR><SELECT NAME='ano[]' SIZE=5 MULTIPLE>";
	$sel = "SELECTED";
    for ( $i=0; $i<5; $i++ ){
          echo " <OPTION VALUE=".(date('Y')-$i-2000)." $sel>".(date('Y')-$i)."</OPTION>";
		  $sel = "";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Mes:<BR><SELECT NAME='mes[]' SIZE=13 MULTIPLE>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Sucursal:<BR><SELECT ID=sucursal NAME='sucursal[]' ONCHANGE='llenar_vendedores();' SIZE=10 MULTIPLE>";
    echo "  <OPTION VALUE=% SELECTED>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
		   echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."' $sel>".$tm->Value('ca_sucursal')."</OPTION>";
           $tm->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Vendedor:<BR><SELECT ID=login NAME='vendedor[]' SIZE=8 MULTIPLE>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=% SELECTED>Vendedores (Todos)</OPTION>";
    echo "  </SELECT></TD>";

    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=mostrar>Tr�fico :<BR><SELECT NAME='traorigen[]' SIZE=10 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Tr�ficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_nombre')."'>".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";

    echo "  <TH style='vertical-align:bottom;' ROWSPAN=5><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'><BR /><BR /></TH>";
    echo "</TR>";

    echo "<TR>";
    if (!$tm->Open("select DISTINCT ca_identificacion as ca_trafico from tb_parametros p, tb_traficos t where ca_casouso = 'CU010' and p.ca_valor = t.ca_idtrafico order by ca_identificacion")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sufijo :<BR><SELECT NAME='sufijo'>";
    echo " <OPTION VALUE=% SELECTED>Sufijos (Todos)</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_trafico')."'>".$tm->Value('ca_trafico')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar>Cliente: </TD>";
    echo "  <TD Class=listar COLSPAN=4><INPUT TYPE='text' NAME='cliente' size='100'></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar>Naviera: </TD>";
    echo "  <TD Class=listar COLSPAN=4><SELECT ID=nomlinea NAME='nomlinea'>";                 // Llena el cuadro de lista con los valores de la tabla Lineas Navieras
    echo "  <OPTION VALUE='%' SELECTED>Listar Todas</OPTION>";
    $nv->MoveFirst();
    while (!$nv->Eof()) {
		   echo "<OPTION VALUE=\"".$nv->Value('ca_nombre')."\">".$nv->Value('ca_nombre')."</OPTION>";
           $nv->MoveNext();
          }
    echo "  </SELECT></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar></TD>";
    echo "  <TD Class=listar>Modalidad:<BR><SELECT NAME='modalidad[]'>";
	echo " <OPTION VALUE=% SELECTED>(Todas)</OPTION>";
	for ($i=0; $i < count($modalidades); $i++) {
		echo " <OPTION VALUE=".$modalidades[$i].">".$modalidades[$i]."</OPTION>"; }
    echo "  </SELECT></TD>";

    if (!$tm->Open("select ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto in ('Mar�timo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repgenerator.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar>Puerto Destino :<BR><SELECT NAME='ciudestino[]' SIZE=6 MULTIPLE>";
    echo " <OPTION VALUE=% SELECTED>Todos los Puertos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE='".$tm->Value('ca_ciudad')."'>".$tm->Value('ca_ciudad')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </SELECT></TD>";
	
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
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"repgenerator.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($agrupamiento)){
	set_time_limit(600);
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

	$ano_mem = implode(',',$ano);
	$mes_mem = implode(',',$mes);
	
	$ano = "substr(ca_referencia,15) ".((count($ano)==1)?"like '$ano[0]'":"in ('".implode("','",$ano)."')");
	$mes = "substr(ca_referencia,8,2) ".((count($mes)==1)?"like '$mes[0]'":"in ('".implode("','",$mes)."')");
	$sucursal = "ca_sucursal ".((count($sucursal)==1)?"like '$sucursal[0]'":"in ('".implode("','",$sucursal)."')");
	$vendedor = "ca_vendedor ".((count($vendedor)==1)?"like '$vendedor[0]'":"in ('".implode("','",$vendedor)."')");
	$cliente = ((strlen($cliente)!=0)?"and upper(ca_compania) like upper('%$cliente%')":"");
	$traorigen = "ca_traorigen ".((count($traorigen)==1)?"like '$traorigen[0]'":"in ('".implode("','",$traorigen)."')");
	$nomlinea = "and ca_nomlinea like '$nomlinea'";
	$sufijo = "substr(ca_referencia,5,2) like '$sufijo'";
	$modalidad = "ca_modalidad ".((count($modalidad)==1)?"like '$modalidad[0]'":"in ('".implode("','",$modalidad)."')");
	$ciudestino = "ca_ciudestino ".((count($ciudestino)==1)?"like '$ciudestino[0]'":"in ('".implode("','",$ciudestino)."')");

	$campos = "";
	while (list ($clave, $val) = each ($agrupamiento)) {
		$campos.= $val.",";
	}
	$campos = substr($campos,0,strlen($campos)-1);
	$queries = "select $campos";
	$queries.= ", count(ca_hbls) as ca_hbls, sum(ca_facturacion) as ca_facturacion, sum(ca_utilidad) as ca_utilidad, sum(ca_sobreventa) as ca_sobreventa, sum(ca_cbm) as ca_cbm, sum(ca_teus) as ca_teus ";
	$queries.= "from vi_repgerencia_sea where $sucursal and $vendedor $cliente $nomlinea ";
    $queries.= "and ca_referencia in (select ca_referencia from vi_inomaestra_sea where $ano and $mes and $sufijo and $traorigen and $modalidad and $ciudestino) ";
	$queries.= "group by $campos ";
	$queries.= "order by $campos ";
	// die ("$queries");
    if (!$rs->Open("$queries")) {                       							// Selecciona todos lo registros de la vista vi_repgerencia_sea 
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      		// Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
    $fc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'repgenerator.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repgenerator.php'>";        // Hace una llamado nuevamente a este script pero con
    echo "<TABLE CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos

    $num_cols = $rs->GetColumnCount();
	echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=$num_cols>COLTRANS S.A.<BR>$titulo<BR>$mes_mem / $ano_mem</TH>";
    echo "</TR>";
	echo "<TR>";
	$saltos = array();
	$titems = array();
	reset($agrupamiento);
	while (list ($clave, $val) = each ($agrupamiento)) {
		$saltos = array_merge($saltos, array($val => ""));
		echo "<TH>$criterios[$val]</TH>";
	}
	$claves = array_values($agrupamiento);
	$gran_tot = false;
	echo "<TH># Hbls</TH>";
	echo "<TH>Facturaci�n</TH>";
	echo "<TH>Utilidad</TH>";
	echo "<TH>Sobreventa</TH>";
	echo "<TH>CBM's</TH>";
	echo "<TH>TEU's</TH>";
	echo "</TR>";
	$rs->MoveFirst();
    while (!$rs->Eof() and !$rs->IsEmpty()){                                  // Lee la totalidad de los registros obtenidos en la instrucci�n Select
		reset($agrupamiento);
		while (list ($clave, $val) = each ($agrupamiento)){
			if ($saltos[$val] != $rs->Value($val)){
				for($j=0; $j<($lst_prn - $clave); $j++){
					if(!isset(${$lst_prn-1})){
						${$lst_prn-1} = array();
					}
					print_totals($num_cols,$lst_prn+1,${$lst_prn-$j},${$lst_prn-$j-1},$titems,$gran_tot);
				}

				echo "<TR>";
				for($i=0; $i<$num_cols; $i++){
					$campo = ($val=='ca_ano')?($rs->Value($val)+2000):(($val=='ca_mes')?($meses[$rs->Value($val)]):$rs->Value($val));
					if ($i == $clave){
						$bold = false;
						if ($i < count($agrupamiento)-1){
							array_push($titems, $campo);
							$bold = true;
						}
						echo "  <TD Class=invertir style='font-size: 9px;$back_col ".(($bold)?"font-weight:bold;":"")."'>$campo</TD>";
						$saltos[$val] = $rs->Value($val);
						reset($claves);
						while (list ($clave_sub, $val_sub) = each ($claves)){
							if ($clave_sub > $clave){
								$saltos[$val_sub] = "";
								$lst_prn = $clave;
							}
						}
					}else{
						if ($clave == ($i - 1) and $i >= count($claves)){
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_hbls'))."</TD>";
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_facturacion'))."</TD>";
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_utilidad'))."</TD>";
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_sobreventa'))."</TD>";
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_cbm'),2)."</TD>";
							echo "  <TD Class=mostrar style='font-size: 9px; text-align:right;'>".number_format($rs->Value('ca_teus'),2)."</TD>";
							$lst_prn = $clave;
							if(!isset(${$lst_prn})){
								${$lst_prn} = array();
							}
							${$lst_prn}['hbls']+= $rs->Value('ca_hbls');
							${$lst_prn}['facturacion']+= $rs->Value('ca_facturacion');
							${$lst_prn}['utilidad']+= $rs->Value('ca_utilidad');
							${$lst_prn}['sobreventa']+= $rs->Value('ca_sobreventa');
							${$lst_prn}['cbm']+= $rs->Value('ca_cbm');
							${$lst_prn}['teus']+= $rs->Value('ca_teus');
							break;
						}else{
							echo "  <TD Class=invertir style='font-size: 9px;$back_col'></TD>";
						}
					}
				}
				echo "</TR>";
			}
		}
    	$rs->MoveNext();
    }
	$imp_tot = (count($agrupamiento)>1)?count($agrupamiento)-1:count($agrupamiento);
	for($j=0; $j<=$imp_tot; $j++){
		if(!isset(${$lst_prn-1})){
			${$lst_prn-1} = array();
		}
		print_totals($num_cols,$lst_prn+1,${$lst_prn-$j},${$lst_prn-$j-1},$titems,$gran_tot);
	}
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repgenerator.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }

function print_totals($nc,$ns,&$arreglo_1,&$arreglo_2,&$titulos,&$impr_grn){
	if ($impr_grn){
		return;
	}
	$campo = array_pop($titulos);
	$tipo_tot = is_null($campo)?"GRAN TOTAL ":strtoupper("Subtotal ").$campo;
	$impr_grn = is_null($campo)?true:$impr_grn;
	// $tipo_tot = strtoupper("Subtotal ").$campo;
	echo "<TR HEIGHT=5>";
	echo "  <TD Class=resaltar COLSPAN=$nc></TD>";
	echo "</TR>";
	echo "<TR>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;' COLSPAN=$ns>$tipo_tot</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['hbls'])."</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['facturacion'])."</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['utilidad'])."</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['sobreventa'])."</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['cbm'],2)."</TD>";
	echo "  <TD Class=resaltar style='font-weight:bold; font-size: 10px; text-align:right;'>".number_format($arreglo_1['teus'],2)."</TD>";
	echo "</TR>";
	$arreglo_2['hbls']+= $arreglo_1['hbls'];
	$arreglo_2['facturacion']+= $arreglo_1['facturacion'];
	$arreglo_2['utilidad']+= $arreglo_1['utilidad'];
	$arreglo_2['sobreventa']+= $arreglo_1['sobreventa'];
	$arreglo_2['cbm']+= $arreglo_1['cbm'];
	$arreglo_2['teus']+= $arreglo_1['teus'];
	$arreglo_1 = array();
}
?>