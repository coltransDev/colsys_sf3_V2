<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPORTENEGOCIO.PHP                                          \\
// Creado:        2005-04-20                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2005-06-01                                                  \\
//                                                                            \\
// Descripción:   Módulo para la creación de Reportes de Negocio.             \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
//$programa = 18;

$titulo = 'Sistema Reportes de Negocio';
$imporexpor = array("Importación","Triangulación","OTM/DTA");                              // Arreglo con los tipos de Trayecto
$modalstrans = array("Inland - Ocean/Air Freight - Inland","Inland - Ocean/Air Freight","Ocean/Air Freight","Ocean/Air Freight - Inland"); // Arreglo con las Modalidades de Transporte
$modalsventa = array("Door to Door","Door to Port","Port to Port","Port to Door");
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$columnas = array("Número de Reporte"=>"ca_consecutivo", "Nombre del Cliente"=>"ca_nombre_cli", "Nombre del Consignatario"=>"ca_nombre_con", "Mis Reportes"=>"ca_login", "Nombre del Proveedor"=>"ca_nombre_pro", "No.Orden Proveedor"=>"ca_orden_prov", "No.Orden Cliente"=>"ca_orden_clie", "No. Cotización"=>"ca_idcotizacion", "Descripción Mercancia"=>"ca_mercancia_desc", "Vendedor"=>"ca_login", "Borradores"=>"ca_contenido", "Tráficos"=>"ca_traorigen", "Puerto"=>"ca_ciuorigen");                        // Arreglo con las opciones de busqueda
$siono = array("Sí","No");
$transnatipos = array("Nacional y Urbano","Nacional","Urbano");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php");

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!$rs->Open("select ca_valor from tb_parametros where ca_casouso = 'CU062'")) { // Selecciona los términos de la tabla Parametros
    echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";      // Muestra el mensaje de error
    echo "<script>document.location.href = 'reportenegocio.php';</script>";
    exit;
}
$tincoterms = array(); // Arreglo con los términos Iconterms
while (!$rs->Eof()) {
    $tincoterms[] = $rs->Value('ca_valor');
    $rs->MoveNext();
}

if (!isset($criterio) and !isset($boton) and !isset($accion)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function validar(){";
    echo "  if (document.menuform.criterio.value == '')";
    echo "      alert('Debe ingresar por lo menos un criterio de busqueda!');";
    echo "  else";
    echo "      return (true);";
    echo "  return (false);";
    echo "}";
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'reportenegocio.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
    echo "}";
    echo "function uno(src,color_entrada) {";
    echo "    src.style.background=color_entrada;src.style.cursor='hand'";
    echo "}";
    echo "function dos(src,color_default) {";
    echo "    src.style.background=color_default;src.style.cursor='default';";
    echo "}";
    echo "function habilitar(elemento) {";
    echo "	if (elemento.name == 'rango') {";
    echo "		if (elemento.checked){";
    echo "      	document.getElementById('fchinicial').disabled = false;";
    echo "      	document.getElementById('fchfinal').disabled = false;";
    echo "		}else{";
    echo "      	document.getElementById('fchinicial').disabled = true;";
    echo "      	document.getElementById('fchfinal').disabled = true;";
    echo "		}";
    echo "   } else {";
    echo "		if (elemento.checked)";
    echo "      	document.getElementById('continuacion_dest').disabled = false;";
    echo "		else";
    echo "      	document.getElementById('continuacion_dest').disabled = true;";
    echo "   }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
    require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='reportenegocio.php' ONSUBMIT='return validar();'>";
    echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    $vista_1 = ($nivel >= 0)?'visible':'hidden'; 					// Habilita la opción para creación de reportes AG
    echo "<TH>";
    echo "   <TABLE CELLSPACING=1>";
    echo "      <TR>";
    //echo "          <TD><IMG src='./graficos/new_ag.gif' alt='Crear Reporte AG' border=0 onclick='elegir(\"Reporte_Ag\", 0, 0);' style='visibility: $vista_1;'></TH></TD>";  // Botón para la creación de un Registro Nuevo
    //echo "          <TD><IMG src='./graficos/new.gif' alt='Crear Reporte de Negocio' border=0 onclick='elegir(\"Adicionar\", 0, 0);'></TH></TD>";  // Botón para la creación de un Registro Nuevo
    echo " 	 </TR>";
    echo "   </TABLE>";
    echo "</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=3>&nbsp;</TH>";
    echo "  <TD Class=listar ROWSPAN=3><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=7>";
    $sel_mem = " SELECTED";
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."' $sel_mem>".$clave;
        $sel_mem = "";
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' VALUE='$cadena' size='60'></TD>";
    echo "  <TH ROWSPAN=3><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar WIDTH=160>Por Rango de Fechas:&nbsp;<INPUT TYPE=CHECKBOX NAME='rango' ONCLICK='habilitar(this);'></TD>";
    echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' DISABLED SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' NAME='fchfinal' DISABLED SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar WIDTH=160>Con Continuación/Viaje:&nbsp;<INPUT TYPE=CHECKBOX NAME='continuacion' ONCLICK='habilitar(this);'></TD>";
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_idtrafico = '$regional' and ca_puerto not in ('Marítimo','Ambos') order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcarga.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo " <TD Class=listar COLSPAN=2>Con Destino :<BR><SELECT NAME='continuacion_dest' DISABLED>";
    echo " <OPTION VALUE=''></OPTION>";
    while ( !$tm->Eof()) {
        echo " <OPTION VALUE='".$tm->Value('ca_idciudad')."'>".$tm->Value('ca_ciudad')."</OPTION>";
        $tm->MoveNext();
    }
    echo "  </SELECT></TD>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE><BR>";

    $filtro = (($nivel==0)?" and ca_vendedor = '$usuario'":"");
    if (!$rs->Open("select * from vi_repconsulta where ca_idetapa !='99999'  and ( (ca_incoterms NOT LIKE 'CIF%' and ca_incoterms NOT LIKE 'CIP%' and ca_incoterms NOT LIKE 'CPT%'  and ca_incoterms NOT LIKE 'CFR%' ) or ca_incoterms is null) $filtro")) {                       // Selecciona todos lo registros AG de la tabla Reportes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    echo "<TABLE WIDTH=550 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>Reportes de Negocio AG pendientes por ser trabajados</TH>";
    echo "</TR>";
    echo "<TR>";
    echo "<TD Class=titulo WIDTH=70>No.Reporte</TD>";
    echo "<TD Class=titulo COLSPAN=3>Cliente</TD>";
    echo "<TD Class=titulo COLSPAN=3>Proveedor</TD>";
    echo "</TR>";
    $ano_mem = intval(substr($rs->Value('ca_fchreporte'),0,4));
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        if ($ano_mem != $rs->Value('ca_fchreporte')) {
            $ano_mem = intval(substr($rs->Value('ca_fchreporte'),0,4));
            echo "<TR>";
            echo "  <TH Class=titulo COLSPAN=7>AÑO $ano_mem</TH>";
            echo "</TR>";
        }
        echo "<TR>";
        echo "  <TD style='font-size: 9px;' Class=listar ROWSPAN=2 onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick=\"javascript:location.href = 'reportenegocio.php?boton=Consultar&id=".$rs->Value('ca_idreporte')."'\">".$rs->Value('ca_consecutivo')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=listar COLSPAN=3>".$rs->Value('ca_nombre_cli')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=listar COLSPAN=3>".$rs->Value('ca_nombre_pro')."</TD>";
        echo "</TR>";
        echo "<TR>";
        echo "  <TD style='font-size: 9px;' Class=invertir>".$rs->Value('ca_ciuorigen')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=invertir>".$rs->Value('ca_ciudestino')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=invertir>".$rs->Value('ca_transporte')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=invertir>".$rs->Value('ca_fchreporte')."</TD>";
        echo "  <TD style='font-size: 9px;' Class=invertir COLSPAN=2>".$rs->Value('ca_mercancia_desc')."</TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=resaltar COLSPAN=7></TD>";
        echo "</TR>";
        $rs->MoveNext();
    }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=7></TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.opcion.focus()</script>";
    //  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
elseif (!isset($boton) and !isset($accion) and isset($criterio)) {
    set_time_limit(600);
    SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    //  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $tm =& DlRecordset::NewRecordset($conn);
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'reportenegocio.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='reportenegocio.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=670 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>".COLTRANS."<BR>$titulo</TH>";
    echo "</TR>";
    if ($opcion != 'ca_contenido') {
        if (isset($criterio) and strlen(trim($criterio)) != 0 and !isset($condicion)) {
            if ($opcion == 'ca_consecutivo' or $opcion == 'ca_nombre_cli' or $opcion == 'ca_nombre_con' or $opcion == 'ca_nombre_pro' or $opcion == 'ca_orden_prov' or $opcion == 'ca_orden_clie' or $opcion == 'ca_idcotizacion' or $opcion == 'ca_login' or $opcion == 'ca_mercancia_desc' or $opcion == 'ca_traorigen' or $opcion == 'ca_ciuorigen') {
                $condicion= "where lower($opcion) like lower('%".$criterio."%')"; }
        }else {
            if ($opcion == 'ca_login') {
                $condicion= "where $opcion = '$usuario'"; }
        }
        if ($rango) {
            $condicion.= ((strlen($condicion)!=0?' and ':' where '))." (ca_fchreporte between '$fchinicial' and '$fchfinal')"; }

        if ($continuacion) {
            $condicion.= ((strlen($condicion)!=0?' and ':' where '))." (ca_continuacion != 'N/A' and ca_continuacion_dest = '$continuacion_dest')"; }

        if (!$rs->Open("select * from vi_reportes $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit; }

        echo "<TH>ID Reporte</TH>";
        echo "<TH>Versión</TH>";
        echo "<TH>Trayecto</TH>";
        $vista_1 = ($nivel >= 0)?'visible':'hidden'; 					// Habilita la opción para creación de reportes AG
        echo "<TH>";
        echo "   <TABLE CELLSPACING=1>";
        echo "   <TR>";
//        echo "		<TD><IMG src='./graficos/new_ag.gif' alt='Crear Reporte AG' border=0 onclick='elegir(\"Reporte_Ag\", 0, 0);' style='visibility: $vista_1;'></TH></TD>";  // Botón para la creación de un Registro Nuevo
//        echo "		<TD><IMG src='./graficos/new.gif' alt='Crear Reporte de Negocio' border=0 onclick='elegir(\"Adicionar\", 0, 0);'></TH></TD>";  // Botón para la creación de un Registro Nuevo
        echo " 	 </TR>";
        echo "   </TABLE>";
        echo "</TH>";
        $consecutivo = '';
        while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
            echo "<TR>";
            if ($consecutivo <> $rs->Value('ca_consecutivo')) {
                echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;'>".$rs->Value('ca_consecutivo')."</TD>";
                $consecutivo = $rs->Value('ca_consecutivo');
                $cadena = (trim(strlen($rs->Value('ca_idproveedor'))) != 0)?"ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")":"false";
                if (!$tm->Open("select * from vi_terceros where $cadena")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
                while (!$tm->Eof()) {
                    $sub_str = "<TR>";
                    $sub_str.= "<TD Class=listar COLSPAN=2><B>Orden Proveedor:</B> ".$ordenes[$tm->Value('ca_idtercero')]."</TD><TD Class=listar COLSPAN=5><B>Proveedor:</B> ".$tm->Value('ca_nombre')."</TD>";
                    $sub_str.= "</TR>";
                    $tm->MoveNext();
                }

            }else {
                echo "  <TD Class=listar ROWSPAN=2></TD>";
            }
            echo "  <TD Class=listar ROWSPAN=2 onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"reportenegocio.php?boton=Consultar\&id=".$rs->Value('ca_idreporte')."\";'>No.&nbsp;".$rs->Value('ca_version')."</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_nombre_cli')." (".$rs->Value('ca_transporte')." - ".$rs->Value('ca_modalidad').") ".ucwords(strtolower($rs->Value('ca_nombre')))."</TD>";
            echo "  <TD Class=listar ROWSPAN=2></TD>";
            echo "</TR>";
            echo "<TR>";
            echo " <TD Class=listar>";
            echo "  <TABLE WIDTH=100% CELLSPACING=1>";
            echo "  <TR>";
            echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
            echo "    <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
            echo "    <TD Class=invertir style='font-weight:bold;'>Fch.Despacho</TD>";
            echo "    <TD Class=invertir style='font-weight:bold;'>T.Incoterms</TD>";
            echo "    <TD Class=invertir style='font-weight:bold;'>Orden</TD>";
            echo "    <TD Class=invertir style='font-weight:bold;'>Cotización</TD>";
            echo "  </TR>";
            echo "  <TR>";
            echo "    <TD Class=listar>".$rs->Value('ca_ciuorigen')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_traorigen')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_ciudestino')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_tradestino')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_fchdespacho')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_incoterms')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_orden_clie')."</TD>";
            echo "    <TD Class=listar>".$rs->Value('ca_idcotizacion')."</TD>";
            echo "  </TR>";
            echo $sub_str;
            echo "  </TABLE>";
            echo " </TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=4></TD>";
            echo "</TR>";
            $rs->MoveNext();
        }
    }else {
        if (!$rs->Open("select oid, * from tb_repborrador where ca_usucreado = '$usuario' and ca_contenido like '%$criterio%' order by ca_fchcreado DESC")) {         // Selecciona todos lo registros de la tabla Borradores de Reporte
            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
            echo "<script>document.location.href = 'entrada.php';</script>";
            exit; }
        echo "<TH>Usuario</TH>";
        echo "<TH COLSPAN=2>Fecha y Hora de Creación</TH>";
        $vista_1 = ($nivel >= 0)?'visible':'hidden'; 					// Habilita la opción para creación de reportes AG
        echo "<TH>";
        echo "   <TABLE CELLSPACING=1>";
        echo "   <TR>";
//        echo "		<TD><IMG src='./graficos/new_ag.gif' alt='Crear Reporte AG' border=0 onclick='elegir(\"Reporte_Ag\", 0, 0);' style='visibility: $vista_1;'></TH></TD>";  // Botón para la creación de un Registro Nuevo
//        echo "		<TD><IMG src='./graficos/new.gif' alt='Crear Reporte de Negocio' border=0 onclick='elegir(\"Adicionar\", 0, 0);'></TH></TD>";  // Botón para la creación de un Registro Nuevo
        echo " 	 </TR>";
        echo "   </TABLE>";
        echo "</TH>";
        while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
            echo "<TR>";
            echo "  <TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_usucreado')."</TD>";
            echo "  <TD Class=listar COLSPAN=2 onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"reportenegocio.php?boton=Adicionar\&br=".$rs->Value('oid')."\";'>".$rs->Value('ca_fchcreado')."</TD>";
            echo "  <TD Class=listar></TD>";
            echo "</TR>";
            $rs->MoveNext();
        }
    }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"reportenegocio.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //    echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Consultar': {                                                    // Opcion para Consultar un solo registro
                $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $fch_mem = ($rs->Value('ca_fchactualizado')!='')?$rs->Value('ca_fchactualizado'):$rs->Value('ca_fchcreado');
                $usu_mem = ($rs->Value('ca_fchactualizado')!='')?$rs->Value('ca_usuactualizado'):$rs->Value('ca_usucreado');
                list($anno, $mes, $dia, $hor, $min, $seg) = sscanf($fch_mem,"%d-%d-%d %d:%d:%d");
                $visible = ($rs->Value('ca_login')== $usuario or $nivel >= 1)?'visible':'hidden';

                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                echo "function elegir(opcion, id){";
                echo "    if (opcion == 'Cerrar'){";
                echo "        if (confirm(\"¿Esta seguro que desea Cerrar el Caso y establecer fecha/hora para entrega de antecedentes a operativo?\")) {";
                echo "            document.location.href = 'reportenegocio.php?accion='+opcion+'\&id='+id;";
                echo "        }";
                echo "    }else if (opcion == 'Abrir'){";
                echo "        if (confirm(\"¿Esta seguro que desea Re-Abrir el Caso?\")) {";
                echo "            document.location.href = 'reportenegocio.php?accion='+opcion+'\&id='+id;";
                echo "        }";
                echo "    }else if (opcion == 'Anular'){";
                echo "        if (confirm(\"¿Esta seguro que desea Anular el Reporte?\")) {";
                echo "            var det_mem = '';";
                echo "            while (det_mem.length == 0){";
                echo "                 det_mem = prompt('Por favor ingrese un breve detalle del motivo de la anulación:');";
                echo "                 if (det_mem.length != 0)";
                echo "                     document.location.href = 'reportenegocio.php?accion='+opcion+'\&id='+id+'\&det='+det_mem;";
                echo "            }";
                echo "        }";
                echo "    }else{";
                echo "        document.location.href = 'reportenegocio.php?boton='+opcion+'\&id='+id;";
                echo "    }";
                echo "}";
                echo "</script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                datos_basicos($visible,$rs,$tm);
                if (strlen($rs->Value('ca_usucerrado')) != 0) {
                    $visible = 'hidden';
                }
                if ($rs->Value('ca_seguro')== "Sí") {
                    $sg =& DlRecordset::NewRecordset($conn);
                    if (!$sg->Open("select * from tb_repseguro left join control.tb_usuarios on ca_seguro_conf=ca_login where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repseguro
                        echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    echo "<TR>";
                    echo "  <TD Class=partir style='text-align:left; vertical-align:top;'>Seguro:<BR></TD>";
                    echo "  <TD Class=invertir COLSPAN=4><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                    echo "  <TR>";
                    echo "    <TD Class=listar COLSPAN=3 style='text-align:center; font-weight:bold;'>INFORMACIÓN PARA LA ASEGURADORA</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar><B>20.1 Valor Asegurado:</B><BR>".formatNumber($sg->Value('ca_vlrasegurado'),3)." ".$sg->Value('ca_idmoneda_vlr')."</TD>";
                    echo "    <TD Class=listar><B>20.2 Obtención Póliza:</B><BR>".formatNumber($sg->Value('ca_obtencionpoliza'),3)." ".$sg->Value('ca_idmoneda_pol')."</TD>";
                    echo "    <TD Class=listar><B>20.3 Prima Venta:</B><BR>".$sg->Value('ca_primaventa')."% Min.".formatNumber($sg->Value('ca_minimaventa'))." ".$sg->Value('ca_idmoneda_vta')."</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar COLSPAN=3><B>20.4 Notificar Seguro:</B><BR>".str_replace(',','<br />',$sg->Value('ca_email'))."</TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                if ($rs->Value('ca_colmas')== "Sí") {
                    $sg =& DlRecordset::NewRecordset($conn);
                    if (!$sg->Open("select * from tb_repaduana ra LEFT OUTER JOIN tb_repaduanadet rad on (ra.ca_idreporte = rad.ca_idreporte and ra.ca_idrepaduana = rad.ca_idrepaduana) where ra.ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repseguro
                        echo "<script>alert(\"".addslashes($sg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    echo "<TR>";
                    echo "  <TD Class=partir style='text-align:left; vertical-align:top;'>Colmas Ltda.:<BR></TD>";
                    echo "  <TD Class=invertir COLSPAN=4><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=4 style='text-align:center; font-weight:bold;'>NACIONALIZACION CON COLMAS SIA LTDA.</TD>";
                    echo "  </TR>";

                    echo "  <TR>";
                    echo "    <TD Class=listar><B>Transporte de Carga Nacionalizada</B></TD>";
                    echo "    <TD Class=listar ROWSPAN=4><B>21.3 Instrucciones Especiales para Colmas:</B><BR>".$rs->Value('ca_instrucciones_ad')."</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar>21.1 Con Coltrans: <B>".$rs->Value('ca_transnacarga')."</B></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "  <TD Class=listar>21.2 Tipo: <B>".$rs->Value('ca_transnatipo')."</B></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar>21.4 Coordinador: <B>".$rs->Value('ca_namecoordinador')."</B></TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                $rm =& DlRecordset::NewRecordset($conn);
                if (!$rm->Open("select * from vi_reptarifas where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_reptarifas
                    echo "<script>alert(\"".addslashes($rm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                echo "      <TR>";
                echo "        <TD Class=invertir style='text-align:center; font-weight:bold;' WIDTH='98%'>EMBARQUE ".strtoupper($rs->Value('ca_transporte'))."</TD>";
                echo "        <TD Class=invertir style='text-align:center;' WIDTH='2%'><IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Liquidar\", $id);'>";
                echo "      </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    echo "  <TR>";
                    echo "    <TD Class=titulo><B>Concepto</B></TD>";
                    echo "    <TD Class=titulo COLSPAN=2><B>Reportar / Min</B></TD>";
                    echo "    <TD Class=titulo COLSPAN=2><B>Cobrar / Min</B></TD>";
                    echo "    <TD Class=titulo COLSPAN=3><B>Observaciones</B></TD>";
                    echo "  </TR>";
                    while (!$rm->Eof()) {
                        echo "  <TR>";
                        echo "    <TD Class=mostrar>".$rm->Value('ca_concepto')."</TD>";
                        echo "    <TD Class=valores WIDTH=75>".formatNumber($rm->Value('ca_reportar_tar'),3)." ".$rm->Value('ca_reportar_idm')."</TD>";
                        echo "    <TD Class=valores WIDTH=75>".formatNumber($rm->Value('ca_reportar_min'),3)." ".$rm->Value('ca_reportar_idm')."</TD>";
                        echo "    <TD Class=valores WIDTH=75>".formatNumber($rm->Value('ca_cobrar_tar'),3)." ".$rm->Value('ca_cobrar_idm')."</TD>";
                        echo "    <TD Class=valores WIDTH=75>".formatNumber($rm->Value('ca_cobrar_min'),3)." ".$rm->Value('ca_cobrar_idm')."</TD>";
                        echo "    <TD Class=mostrar COLSPAN=3>".$rm->Value('ca_observaciones')."</TD>";
                        echo "  </TR>";
                        $rm->MoveNext();
                    }
                }else if ($rs->Value('ca_transporte') == 'Marítimo') {
                        echo "  <TR>";
                        echo "    <TD Class=titulo><B>Concepto</B></TD>";
                        echo "    <TD Class=titulo><B>Cant.</B></TD>";
                        echo "    <TD Class=titulo COLSPAN=2><B>Neta / Min</B></TD>";
                        echo "    <TD Class=titulo COLSPAN=2><B>Reportar / Min</B></TD>";
                        echo "    <TD Class=titulo COLSPAN=2><B>Cobrar / Min</B></TD>";
                        echo "  </TR>";
                        while (!$rm->Eof()) {
                            $con_mem = "<b>".$rm->Value('ca_concepto')."</b>".((strlen($rm->Value('ca_observaciones'))!=0)?"<br>".$rm->Value('ca_observaciones'):"");
                            echo "  <TR>";
                            echo "    <TD Class=mostrar>$con_mem</TD>";
                            echo "    <TD Class=valores WIDTH=20>".formatNumber($rm->Value('ca_cantidad'))."</TD>";
                            echo "    <TD Class=valores WIDTH=70>".formatNumber($rm->Value('ca_neta_tar'),3)." ".$rm->Value('ca_neta_idm')."</TD>";
                            echo "    <TD Class=valores WIDTH=65>".formatNumber($rm->Value('ca_neta_min'),3)." ".$rm->Value('ca_neta_idm')."</TD>";
                            echo "    <TD Class=valores WIDTH=70>".formatNumber($rm->Value('ca_reportar_tar'),3)." ".$rm->Value('ca_reportar_idm')."</TD>";
                            echo "    <TD Class=valores WIDTH=65>".formatNumber($rm->Value('ca_reportar_min'),3)." ".$rm->Value('ca_reportar_idm')."</TD>";
                            echo "    <TD Class=valores WIDTH=70>".formatNumber($rm->Value('ca_cobrar_tar'),3)." ".$rm->Value('ca_cobrar_idm')."</TD>";
                            echo "    <TD Class=valores WIDTH=65>".formatNumber($rm->Value('ca_cobrar_min'),3)." ".$rm->Value('ca_cobrar_idm')."</TD>";
                            echo "  </TR>";
                            $rm->MoveNext();
                        }
                    }
                echo "  </TABLE></CENTER></TD>";
                echo "</TR>";

                $rg =& DlRecordset::NewRecordset($conn);
                if (!$rg->Open("select * from vi_repgastos where ca_idreporte = ".$rs->Value('ca_idreporte'))) {       // Selecciona todos lo registros de la tabla tb_repgastos
                    echo "<script>alert(\"".addslashes($rg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                $sub_mem = 'Recargo en Origen';
                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                echo "  <TD Class=invertir COLSPAN=8 style='text-align:center; font-weight:bold;'>RELACIÓN DE RECARGOS</TD>";
                echo "  <TR>";
                echo "    <TD Class=titulo><B>$sub_mem</B></TD>";
                echo "    <TD Class=titulo><B>Aplicación</B></TD>";
                echo "    <TD Class=titulo COLSPAN=2><B>Neta / Min</B></TD>";
                echo "    <TD Class=titulo COLSPAN=2><B>Reportar / Min</B></TD>";
                echo "    <TD Class=titulo COLSPAN=2><B>Cobrar / Min</B></TD>";
                echo "  </TR>";
                while (!$rg->Eof()) {
                    if ($rg->Value('ca_tiporecargo') != $sub_mem) {
                        $rg->MoveNext();
                        continue;
                    }
                    $des_rec = $rg->Value('ca_recargo').(($rg->Value('ca_idconcepto')!='9999')?" -> ".$rg->Value('ca_concepto'):"");
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>$des_rec</TD>";
                    echo "    <TD Class=mostrar WIDTH=65>".$rg->Value('ca_aplicacion')."</TD>";
                    if ($rg->Value('ca_tipo')=='$')
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_neta_tar'),3)." ".$rg->Value('ca_idmoneda')."</TD>";
                    else
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_neta_tar'),3)." ".$rg->Value('ca_tipo')."</TD>";
                    echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_neta_min'),3)." ".$rg->Value('ca_idmoneda')."</TD>";

                    if ($rg->Value('ca_tipo')=='$')
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_reportar_tar'),3)." ".$rg->Value('ca_idmoneda')."</TD>";
                    else
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_reportar_tar'),3)." ".$rg->Value('ca_tipo')."</TD>";
                    echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_reportar_min'),3)." ".$rg->Value('ca_idmoneda')."</TD>";

                    if ($rg->Value('ca_tipo')=='$')
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_idmoneda')."</TD>";
                    else
                        echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_tipo')."</TD>";
                    echo "    <TD Class=valores WIDTH=11%>".formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')."</TD>";

                    echo "  </TR>";
                    if ( strlen($rg->Value('ca_detalles'))!=0 ) {
                        echo "  <TR>";
                        echo "    <TD Class=mostrar></TD>";
                        echo "    <TD Class=invertir><B>Detalles :</B></TD>";
                        echo "    <TD Class=invertir COLSPAN=6>".$rg->Value('ca_detalles')."</TD>";
                        echo "  </TR>";
                    }
                    $rg->MoveNext(); }
                echo "  </TABLE></CENTER></TD>";
                echo "</TR>";
                $rg->MoveFirst();

                $sub_mem = 'Recargo Local';
                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";
                echo "  <TR>";
                echo "    <TD Class=titulo><B>$sub_mem</B></TD>";
                echo "    <TD Class=titulo><B>Aplicación</B></TD>";
                echo "    <TD Class=titulo COLSPAN=2><B>Cobrar / Min</B></TD>";
                echo "  </TR>";
                while (!$rg->Eof()) {
                    if ($rg->Value('ca_tiporecargo') != $sub_mem) {
                        $rg->MoveNext();
                        continue;
                    }
                    $des_rec = $rg->Value('ca_recargo').(($rg->Value('ca_idconcepto')!='9999')?" -> ".$rg->Value('ca_concepto'):"");
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>$des_rec</TD>";
                    echo "    <TD Class=mostrar>".$rg->Value('ca_aplicacion')."</TD>";
                    if ($rg->Value('ca_tipo')=='$')
                        echo "    <TD Class=valores>".formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_idmoneda')."</TD>";
                    else
                        echo "    <TD Class=valores>".formatNumber($rg->Value('ca_cobrar_tar'),3)." ".$rg->Value('ca_tipo')."</TD>";
                    echo "    <TD Class=valores>".formatNumber($rg->Value('ca_cobrar_min'),3)." ".$rg->Value('ca_idmoneda')."</TD>";
                    echo "  </TR>";
                    if ( strlen($rg->Value('ca_detalles'))!=0 ) {
                        echo "  <TR>";
                        echo "    <TD Class=invertir COLSPAN=4><B> * Detalles :</B> ".$rg->Value('ca_detalles')."</TD>";
                        echo "  </TR>";
                    }
                    $rg->MoveNext(); }
                echo "  </TABLE></CENTER></TD>";
                echo "</TR>";

                if ($rs->Value('ca_colmas')== "Sí") {
                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=7 style='text-align:center; font-weight:bold;'>CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.</TD>";
                    echo "  </TR>";

                    echo "<TH>Concepto</TH>";
                    echo "<TH>Tipo</TH>";
                    echo "<TH>Neta</TH>";
                    echo "<TH>Valor</TH>";
                    echo "<TH>Mínimo</TH>";
                    echo "<TH>Mnd</TH>";
                    echo "<TH WIDTH=200>Detalles</TH>";
                    if (!$tm->Open("select r.*, c.ca_costo from tb_repaduanadet r, tb_costos c where r.ca_idcosto = c.ca_idcosto and ca_idreporte = $id and ca_idrepaduana = ".((strlen($rs->Value('ca_idrepaduana'))!=0)?$rs->Value('ca_idrepaduana'):0))) {       // Selecciona todos lo registros de la tabla Costos
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    $tm->MoveFirst();
                    while (!$tm->Eof() and !$tm->IsEmpty()) {
                        echo "<TR>";
                        echo "  <TD Class=listar>".$tm->Value('ca_costo')."</TD>";
                        echo "  <TD Class=listar>".$tm->Value('ca_tipo')."</TD>";
                        echo "  <TD Class=valores>".formatNumber($tm->Value('ca_netcosto'),3)."</TD>";
                        echo "  <TD Class=valores>".formatNumber($tm->Value('ca_vlrcosto'),3)."</TD>";
                        echo "  <TD Class=valores>".formatNumber($tm->Value('ca_mincosto'),3)."</TD>";
                        echo "  <TD Class=valores>".$tm->Value('ca_idmoneda')."</TD>";
                        echo "  <TD Class=listar>".$tm->Value('ca_detalles')."</TD>";
                        echo "</TR>";
                        $tm->MoveNext();
                    }
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=5></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar><B>Ciudad :</B><BR><CENTER>".$rs->Value('ca_sucursal')."</CENTER></TD>";
                echo "  <TD Class=listar><B>Elaboró :</B><BR><CENTER>$usu_mem</CENTER></TD>";
                echo "  <TD Class=listar><B>Fecha:</B><BR><CENTER>".date("Y-m-d",mktime($hor,$min,$seg,$mes,$dia,$anno))."&nbsp;".date("h:i a",mktime($hor,$min,$seg,$mes,$dia,$anno))."</CENTER></TD>";
                echo "  <TD Class=listar COLSPAN=2><B>Rep. Comercial:</B><BR><CENTER>".$rs->Value('ca_vendedor')."</CENTER></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=divisor COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='BUTTON' NAME='boton' VALUE='Generar Reporte'  ONCLICK='elegir(\"Imprimir\", $id);'></TH>";         // Generar Documento en PDF
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"reportenegocio.php\"'></TH>";  // Cancela la operación
                echo "</TABLE><BR>";

                $tm =& DlRecordset::NewRecordset($conn);
                /*if (!$tm->Open("select * from vi_emails where ca_tipo = 'Rep.MarítimoExterior' and ca_idcaso in (select ca_idreporte from tb_reportes where ca_consecutivo in (select ca_consecutivo from tb_reportes where ca_idreporte = '$id')) order by ca_fchenvio DESC")) { // Selecciona todos lo registros de la tabla Emails
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=6>Reporte ".$rs->Value('ca_transporte')." al Exterior</TH>";
                echo "</TR>";
                echo "<TH WIDTH=80>Usuario</TH>";
                echo "<TH WIDTH=300>Asunto</TH>";
                echo "<TH>Enviado</TH>";
                echo "<TH WIDTH=35></TH>";  // Botón para la creación de un Registro Nuevo
                while (!$tm->Eof()) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar style='vertical-align:top;'>".$tm->Value('ca_usuenvio')."</TD>";
                    echo "  <TD Class=mostrar>".$tm->Value('ca_subject')."</TD>";
                    echo "  <TD Class=mostrar style='vertical-align:top;'>".$tm->Value('ca_fchenvio')."</TD>";
                    echo "  <TD Class=mostrar><CENTER><IMG src='./graficos/mail.gif' alt='Ver correo electrónico' border=0 onclick='javascript:window.open(\"ventanas.php?opcion=Email\&id=".$tm->Value('ca_idemail')."\",\"Email\",\"scrollbars=yes,width=650,height=400,top=200,left=150\")'></CENTER></TD>";
                    echo "</TR>";
                    $tm->MoveNext();
                }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=6></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";*/


                echo "<TABLE WIDTH=620 CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TD Class=invertir style='text-align:center; font-weight:bold;' COLSPAN=6>Relación de Status Enviados</TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6 align='center'> <div align='center'><a  HREF='#' onClick=window.open('/traficos/verHistorialStatus/idreporte/".$id."')>HAGA CLICK ACA</a></div></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
        case 'Imprimir': {                                                    // Opcion para Consultar un solo registro
                header("Location: /reportes/verReporte/id/".$id);
                break;
            }
        case 'Adicionar': {
            $url="/reportesNeg/index";
            echo "<script>location.href='".$url."'</script>";
            //    exit;// Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

                $tm =& DlRecordset::NewRecordset($conn);
                $us =& DlRecordset::NewRecordset($conn);
                carga_arreglos($tm);
                if (isset($br)) {
                    if (!$tm->Open("select * from tb_repborrador where oid = '$br'")) {        // Busca el registro de borrador
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    $contenido = unserialize($tm->Value('ca_contenido'));
                }

                $cambiar = ($nivel >= 1)?'':'DISABLED';
                if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and ca_activo = true and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (!$tm->Open("select ca_email, ca_login from vi_usuarios where ca_activo = true and ca_cargo like '%OTM%'")) {          // Selecciona los correos de la tabla Parametros
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt; find_texts.style.top=dalt'>";
                require_once("menu.php");
                echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_contacto_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";
                echo "<DIV ID='find_texts' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_texts_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";

                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validador();'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='validado' VALUE='false'>";              // Hereda el Id del registro que se esta modificando
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>REPORTE DE NEGOCIO</TH>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Información :</TD>";
                echo "  <TD Class=mostrar COLSPAN=2 style='text-align:left; vertical-align:bottom;'>Fecha del Reporte: <INPUT TYPE='TEXT' NAME='fchreporte' SIZE=12 VALUE='".date("Y-m-d")."' READONLY></TD>";
                echo "  <TD Class=mostrar COLSPAN=2 style='text-align:left; vertical-align:bottom;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"><INPUT TYPE='TEXT' NAME='idcotizacion' ONBLUR='valores(this);' SIZE=11 MAXLENGTH=10>&nbsp;<a onclick='terceros(\"find_contacto\",\"_pro\",\"findcotizacion\");'><IMG alt='Click aquí para Buscar Cotización' src='graficos/lupa.gif' hspace='0' vspace='0'>&nbsp;Buscar&nbsp;Cotización</a></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo>1. Importación</TD>";
                echo "  <TD Class=titulo COLSPAN=2>2. Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>3. Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT ID=impoexpo NAME='impoexpo' ONCHANGE='llenar_traficos();' ONMOUSEWHEEL='return false;'>";
                for ($i=0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i]."</OPTION>";
                }
                echo "  </SELECT>&nbsp;&nbsp;&nbsp;</TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();' ONMOUSEWHEEL='return false;'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' ONMOUSEWHEEL='return false;' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();' ONMOUSEWHEEL='return false;'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' ONMOUSEWHEEL='return false;' SIZE=7 ONCLICK='continuacion_dest.selectedIndex=idciudestino.selectedIndex'>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' NAME='fchdespacho' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                echo "  <TD Class=listar COLSPAN=4>5. Agente:&nbsp;&nbsp;[Listar Todos&nbsp;<INPUT TYPE='CHECKBOX' NAME='todos_ag' WIDTH=10 ONCHANGE='llenar_agentes();'>]<BR><SELECT NAME='idagente' ONMOUSEWHEEL='return false;'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>6. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93></TEXTAREA><BR>¿Es Mercancía Peligrosa? <INPUT TYPE=CHECKBOX NAME='mcia_peligrosa'><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Marque esta opción para indicar que Sí es Mercancia Peligrosa'></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_pro_1 TYPE='HIDDEN' NAME='idproveedor[]'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_pro_1 src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7. Nombre:<BR><INPUT ID=nombre_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>7.1 Orden:<BR><INPUT ID=orden_pro_1 TYPE='TEXT' NAME='orden_prov[]' SIZE=20 MAXLENGTH=500></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_pro_1\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'>&nbsp;Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>7.2 Contacto:<BR><INPUT ID=contacto_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7.3 Dirección:<BR><INPUT ID=direccion_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>7.4 Teléfono:<BR><INPUT ID=telefonos_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>7.5 Fax:<BR><INPUT ID=fax_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7.6 Correo Electrónico:<BR><INPUT ID=email_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>7.7 Incoterms:<BR><SELECT ID=incoterms_pro_1 NAME='incoterms[]'>";
                echo "    <OPTION VALUE=''></OPTION>";
                for ($i=0; $i < count($tincoterms); $i++) {
                    echo " <OPTION VALUE='".$tincoterms[$i]."'>".$tincoterms[$i]."</OPTION>";
                }
                echo "    </SELECT></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idconcliente'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_clie' SIZE=15 MAXLENGTH=255></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_cli\",\"findcontacto\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>8.7 Reportar como Notify: <INPUT NAME='repnotify' TYPE='radio' VALUE='0' CHECKED></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='cons_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consignatario:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='cons_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1 Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.1.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_con\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.1.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.1.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.1.7 Reportar como Notify: <INPUT NAME='repnotify' TYPE='radio' VALUE='1'></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_not TYPE='HIDDEN' NAME='idnotify'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='noti_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Notify:</TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='noti_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_not src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2 Nombre:<BR><INPUT ID=nombre_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.2.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_not\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.2 Contacto:<BR><INPUT ID=contacto_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.3 Dirección:<BR><INPUT ID=direccion_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.2.4 Teléfono:<BR><INPUT ID=telefonos_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.2.5 Fax:<BR><INPUT ID=fax_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.6 Correo Electrónico:<BR><INPUT ID=email_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.2.7 Reportar como Notify: <INPUT ID=default_not NAME='repnotify' TYPE='radio' VALUE='2'></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_mas TYPE='HIDDEN' NAME='idmaster'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='mast_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consigna.Master:</TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='mast_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_mas src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3 Nombre:<BR><INPUT ID=nombre_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.3.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_mas\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.2 Contacto:<BR><INPUT ID=contacto_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.3 Dirección:<BR><INPUT ID=direccion_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.3.4 Teléfono:<BR><INPUT ID=telefonos_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.3.5 Fax:<BR><INPUT ID=fax_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.6 Correo Electrónico:<BR><INPUT ID=email_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='repr_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Representante:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='repr_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=3 style='text-align:center; vertical-align:top;'><IMG ID=clean_rep src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_rep\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=4>11.1 Preferencias del Cliente:<BR><TEXTAREA ID=preferencias_clie NAME='preferencias_clie' WRAP=virtual ROWS=9 COLS=80></TEXTAREA><BR><INPUT TYPE='CHECKBOX' NAME='actualizar_pref' VALUE='true'> Actualizar preferencias en maestra de clientes</TD>";
                echo "  <TD Class=listar ROWSPAN=2>11.3 Informaciones a:<BR><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
                $z=0;
                for ($i=1; $i<=18; $i++) {
                    echo "  <TR>";
                    echo "    <TD Class=invertir style='vertical-align:bottom;' WIDTH=130><INPUT ID=conf_$z Class=field TYPE='TEXT' NAME='contactos[]' VALUE=' ' ONCHANGE='cambiar_email(this);' SIZE=40 MAXLENGTH=50></TD><TD Class=invertir><INPUT ID=email_$z TYPE='CHECKBOX' NAME='confirmar[]' WIDTH=10 ONCHANGE='asignar_email(this);'></TD>";
                    echo "  </TR>";
                    $z++;
                }
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=4>11.2 Instrucciones Especiales para el Agente:&nbsp;<IMG src='graficos/cerrado.gif' ALT='Click para incluir textos predefinidos' ONCLICK='terceros(\"find_texts\",\"Instructions_sea\",\"ventanas\");'><BR><TEXTAREA ID=instrucciones NAME='instrucciones' WRAP=virtual ROWS=9 COLS=80></TEXTAREA></TD>";
                echo "</TR>";

                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";

                echo "    <TR>";
                echo "      <TD Class=mostrar>12. Transporte:<BR><CENTER><SELECT ID=transporte NAME='transporte' ONCHANGE='llenar_modalidades();llenar_continuaciones();existe();'>";
                for ($i=0; $i < count($transportes); $i++) {
                    echo " <OPTION VALUE=".$transportes[$i].">".$transportes[$i];
                }
                echo "      </SELECT></CENTER></TD>";
                echo "      <TD Class=mostrar>13. Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='llenar_lineas();'>";
                echo "      </SELECT></TD>";
                echo "      <TD Class=mostrar COLSPAN=3>14. Línea Transporte:<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                echo "      </SELECT></TD>";
                echo "    </TR>";
                echo "    <TR HEIGHT=5>";
                echo "      <TD Class=invertir COLSPAN=4></TD>";
                echo "    </TR>";

                echo "    <TR>";
                echo "      <TD Class=mostrar>15. Colmas Ltda:<BR><CENTER><INPUT NAME='colmas' TYPE='radio' VALUE = 'Sí' CHECKED>Sí&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='colmas' TYPE='radio' VALUE = 'No'>No</CENTER></TD>";
                echo "      <TD Class=mostrar>16. Seguro:<BR><CENTER><INPUT NAME='seguro' TYPE='radio' VALUE = 'Sí' CHECKED>Sí&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='seguro' TYPE='radio' VALUE = 'No'>No</CENTER></TD>";
                echo "      <TD Class=mostrar>17. Lib. Automática:<BR><CENTER><INPUT ID=si NAME='liberacion' DISABLED TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT ID=no NAME='liberacion' DISABLED TYPE='radio' VALUE = 'No'>No</CENTER></TD>";
                echo "      <TD Class=mostrar>Tiempo de Crédito:<BR><CENTER><INPUT DISABLED TYPE='TEXT' NAME='tiempocredito' VALUE='-' SIZE=18 MAXLENGTH=20></CENTER></TD>";
                echo "    </TR>";
                echo "    <TR HEIGHT=5>";
                echo "      <TD Class=invertir COLSPAN=4></TD>";
                echo "    </TR>";
                echo "    <TR>";
                echo "      <TD Class=listar WIDTH=175>18.1 Continuación/Viaje:</TD>";
                echo "      <TD Class=listar><SELECT NAME='continuacion' ONCHANGE='llenar_finales();'></SELECT></TD>";  // Llena el cuadro de lista con la lista de continuaciones de viaje
                echo "      <TD Class=listar>18.2&nbsp;Destino&nbsp;Final:</TD>";
                echo "      <TD Class=listar><SELECT NAME='continuacion_dest'></SELECT></TD>";                          // Llena el cuadro de lista con la lista de ciudades destino de continuaciones de viaje
                echo "    </TR>";

                echo "    <TR>";
                echo "      <TD Class=listar>18.3 Notificar C/Viaje al email:</TD>";
                echo "      <TD Class=listar COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
                $tm->MoveFirst();
                for($i=0; $i<round($tm->GetRowCount()-(round($tm->GetRowCount()%3))/3)/3; $i++) {
                    echo "<TR>";
                    for($j=0; $j<3; $j++) {
                        $econf_mem = (!$tm->Eof() and !$tm->IsEmpty())?$tm->Value('ca_login'):'';
                        if (strlen($econf_mem)!=0) {
                            echo "<TD Class=invertir style='vertical-align:bottom;' WIDTH=130><INPUT ID=econt_$z TYPE='CHECKBOX' NAME='econt[]' VALUE='$econf_mem' WIDTH=10 $check_mem>".$tm->Value('ca_email')."</TD>";
                        }else {
                            echo "<TD Class=invertir style='vertical-align:bottom;' WIDTH=130></TD>";
                        }
                        $tm->MoveNext();
                    }
                    echo "</TR>";
                }
                echo "      </TABLE></TD>";
                echo "    </TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "    <TR>";
                echo "      <TD Class=mostrar>19.1 Consignar HAWB/HBL a :</TD>";                                       // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "      <TD Class=mostrar COLSPAN=3><SELECT NAME='idconsignar'></SELECT></TD>";
                echo "    </TR>";
                echo "    <TR>";
                echo "      <TD Class=mostrar>19.2 Trasladar a :</TD>";                                           // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "      <TD Class=mostrar COLSPAN=3><SELECT NAME='tipo' ONCHANGE='llenar_bodegas();'></SELECT></TD>";
                echo "    </TR>";
                echo "    <TR>";
                echo "      <TD Class=mostrar>19.3&nbsp;Igualar&nbsp;Master/Hijo:&nbsp;<SELECT NAME='mastersame'><OPTION VALUE='No'>No</OPTION><OPTION VALUE='Sí'>Sí</OPTION></SELECT></TD>";
                echo "      <TD Class=mostrar COLSPAN=4><SELECT NAME='idbodega'></SELECT></TD>";                   // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "    </TR>";
                echo "  </TABLE></TD>";

                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left;'>Rep. Comercial:";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo "  <TD Class=mostrar COLSPAN=2><SELECT ID=login NAME='login' $cambiar>";
                echo"<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE='".$us->Value('ca_login')."'".(($us->Value('ca_login')==$usuario)?" SELECTED":"").">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=invertir>Elabora: </TD>";
                echo "  <TD Class=invertir><B>$usuario</B></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar' ONCLICK='validar(this);'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Borrador' ONCLICK='validar(this);'></TH>";        // Ordena almacenar los datos ingresados en una tabla de borrador
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reportenegocio.php\"'></TH>";  // Cancela la operación
                echo "<script>llenar_traficos();</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                if (isset($contenido)) {                                                                                            // Recupera los contenidos del formulario
                    echo "<script>";
                    while (list ($clave, $val) = each ($contenido)) {
                        if (is_array($val) and count($val)>0) {
                            $arreglo = 'Array(';
                            while (list ($subclave, $subval) = each ($val)) {
                                $arreglo.= "'".$subval."',";
                            }
                            $arreglo = substr($arreglo,0,strlen($arreglo)-1).")";
                            echo "llenar_item('$clave', $arreglo);\n";
                        }else {
                            if ($clave != 'instrucciones') {
                                echo "llenar_item('$clave', '".$val."');\n";
                            }
                        }
                    }
                    echo "</script>";
                }
                break;
            }
        case 'Reporte_Ag': {

                $url="/reportesNeg/formReporteAg";
                echo "<script>location.href='".$url."'</script>";
                //exit;

                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al módulo

                $tm =& DlRecordset::NewRecordset($conn);
                $us =& DlRecordset::NewRecordset($conn);
                carga_arreglos($tm);
                if (isset($br)) {
                    if (!$tm->Open("select * from tb_repborrador where oid = '$br'")) {        // Busca el registro de borrador
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    $contenido = unserialize($tm->Value('ca_contenido'));
                }

                $cambiar = ($nivel >= 1)?'':'DISABLED';
                if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and ca_activo=true and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (!$tm->Open("select ca_valor from tb_parametros where ca_casouso = 'CU022'")) {          // Selecciona los correos de la tabla Parametros
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                $con_conf = "";
                while (!$tm->Eof()) {
                    $con_conf.= $tm->Value('ca_valor').",";
                    $tm->MoveNext();
                }
                $con_conf = substr($con_conf,0,strlen($con_conf)-1);
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt; find_texts.style.top=dalt'>";
                require_once("menu.php");
                echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_contacto_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";
                echo "<DIV ID='find_texts' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_texts_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";

                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validador();' enctype='multipart/form-data'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='validado' VALUE='false'>";              // Hereda el Id del registro que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='status' VALUE='false'>";              // Controla redireccionamiento a pagina de envio de status
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>REPORTE DE NEGOCIO</TH>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'>Información :</TD>";
                echo "  <TD Class=mostrar COLSPAN=2 style='text-align:left; vertical-align:bottom;'>Fecha del Reporte: <INPUT TYPE='TEXT' NAME='fchreporte' SIZE=12 VALUE='".date("Y-m-d")."' READONLY></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Transporte: <SELECT ID=transporte NAME='transporte' ONCHANGE='llenar_modalidades();'>";
                for ($i=0; $i < count($transportes); $i++) {
                    echo " <OPTION VALUE=".$transportes[$i].(($i==1)?" SELECTED":"").">".$transportes[$i];
                }
                echo "      </SELECT></CENTER></TD>";
                echo "</TR>";


                echo "<TR>";
                echo "  <TD Class=titulo>1. Importación</TD>";
                echo "  <TD Class=titulo COLSPAN=2>2. Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>3. Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT ID=impoexpo NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
                for ($i=0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i]."</OPTION>";
                }
                echo "  </SELECT>&nbsp;&nbsp;&nbsp;</TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();' ONMOUSEWHEEL='return false;'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' ONMOUSEWHEEL='return false;' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();' ONMOUSEWHEEL='return false;'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' ONMOUSEWHEEL='return false;' SIZE=7 ONCLICK='select_final();'>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' NAME='fchdespacho' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                echo "  <TD Class=listar COLSPAN=4>5. Agente:&nbsp;&nbsp;[Listar Todos&nbsp;<INPUT TYPE='CHECKBOX' NAME='todos_ag' WIDTH=10 ONCHANGE='llenar_agentes();'>]<BR><SELECT NAME='idagente' ONMOUSEWHEEL='return false;'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>6. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93></TEXTAREA><BR>¿Es Mercancía Peligrosa? <INPUT TYPE=CHECKBOX NAME='mcia_peligrosa'><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Marque esta opción para indicar que Sí es Mercancia Peligrosa'></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_pro_1 TYPE='HIDDEN' NAME='idproveedor[]'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_pro_1 src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7. Nombre:<BR><INPUT ID=nombre_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>7.1 Orden:<BR><INPUT ID=orden_pro_1 TYPE='TEXT' NAME='orden_prov[]' SIZE=20 MAXLENGTH=500></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_pro_1\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'>&nbsp;Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>7.2 Contacto:<BR><INPUT ID=contacto_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7.3 Dirección:<BR><INPUT ID=direccion_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>7.4 Teléfono:<BR><INPUT ID=telefonos_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>7.5 Fax:<BR><INPUT ID=fax_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>7.6 Correo Electrónico:<BR><INPUT ID=email_pro_1 READONLY TYPE='TEXT' NAME='proveedor[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>7.7 Incoterms:<BR><SELECT ID=incoterms_pro_1 NAME='incoterms[]' >";
                echo "    <OPTION VALUE=''></OPTION>";
                for ($i=0; $i < count($tincoterms); $i++) {
                    echo " <OPTION VALUE='".$tincoterms[$i]."'>".$tincoterms[$i]."</OPTION>";
                }
                echo "    </SELECT></TD>";

                echo "      <TD Class=mostrar COLSPAN=2>7.8 Modalidad:<BR><SELECT NAME='modalidad' >";
                echo "      </SELECT></TD>";

                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idconcliente'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=3 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_clie' SIZE=15 MAXLENGTH=255></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_cli\",\"findcontacto\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_cli READONLY TYPE='TEXT' NAME='cliente[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='cons_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consignatario:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='cons_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1 Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.1.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_con\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.1.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.1.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.1.7 Reportar como Notify: <INPUT NAME='repnotify' TYPE='radio' VALUE='1'></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_not TYPE='HIDDEN' NAME='idnotify'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='noti_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Notify:</TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='noti_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_not src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2 Nombre:<BR><INPUT ID=nombre_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.2.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_not\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.2 Contacto:<BR><INPUT ID=contacto_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.3 Dirección:<BR><INPUT ID=direccion_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.2.4 Teléfono:<BR><INPUT ID=telefonos_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.2.5 Fax:<BR><INPUT ID=fax_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.6 Correo Electrónico:<BR><INPUT ID=email_not READONLY TYPE='TEXT' NAME='notify[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.2.7 Reportar como Notify: <INPUT ID=default_not NAME='repnotify' TYPE='radio' VALUE='2'></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_mas TYPE='HIDDEN' NAME='idmaster'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='mast_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consigna.Master:</TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='mast_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_mas src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3 Nombre:<BR><INPUT ID=nombre_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.3.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_mas\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.2 Contacto:<BR><INPUT ID=contacto_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.3 Dirección:<BR><INPUT ID=direccion_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.3.4 Teléfono:<BR><INPUT ID=telefonos_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.3.5 Fax:<BR><INPUT ID=fax_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.6 Correo Electrónico:<BR><INPUT ID=email_mas READONLY TYPE='TEXT' NAME='master[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='repr_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Representante:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='repr_tbl' WIDTH=400 CELLSPACING=1 style='display: none'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=3 style='text-align:center; vertical-align:top;'><IMG ID=clean_rep src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí'>Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No' CHECKED>No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_rep\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left;'>Rep. Comercial:";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo "  <TD Class=mostrar COLSPAN=2><SELECT ID=login NAME='login' $cambiar>";
                echo "<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE='".$us->Value('ca_login')."'".(($us->Value('ca_login')==$usuario)?" SELECTED":"").">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=invertir>Elabora: </TD>";
                echo "  <TD Class=invertir><B>$usuario</B></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5>Mensaje para el Representante Comercial</TH>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Asunto :</TD>";
                echo "  <TD Class=listar COLSPAN=2><INPUT TYPE='TEXT' NAME='asunto' SIZE=50 VALUE='Nuevo Reporte AG' MAXLENGTH=255></TD>";
                echo "  <TD Class=invertir COLSPAN=2 ROWSPAN=3 STYLE='vertical-align:top'>Copiar mensaje a: <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Seleccionar los Contactos involucrados con este embarque'><BR><B>El reporte AG sólo será enviado a los buzones de dominio @coltrans.com.co</B><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
                $z=0;
                for ($i=1; $i<=11; $i++) {
                    echo "  <TR>";
                    echo "    <TD Class=invertir style='vertical-align:bottom;' WIDTH=230><INPUT ID=conf_$z Class=field TYPE='TEXT' NAME='contactos[]' VALUE=' ' ONCHANGE='cambiar_email(this);' SIZE=40 MAXLENGTH=50></TD><TD Class=invertir><INPUT ID=email_$z TYPE='CHECKBOX' NAME='confirmar[]' WIDTH=10 ONCHANGE='asignar_email(this);'></TD>";
                    echo "  </TR>";
                    $z++;
                }
                echo "  </TABLE></TD>";
                echo "</TR>";
                $saludo = (date('H')<12)?"buenos días":((date('H')>18)?"buenas noches":"buenas tardes");
                echo "<TR>";
                echo "  <TD Class=captura ROWSPAN=2 STYLE='vertical-align:top'>Mensaje Adicional:</TD>";
                echo "  <TD Class=listar COLSPAN=2><TEXTAREA NAME='mensaje' WRAP=virtual ROWS=21 COLS=50></TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=4>Adjuntar Documento: <BR><INPUT TYPE='FILE' NAME='attachment' SIZE=70></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=titulo COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Crear Reporte AG' ONCLICK='validar(this);'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reportenegocio.php\"'></TH>";  // Cancela la operación
                echo "<script>llenar_traficos();</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Editar': {                                                    // Opcion para Adicionar Registros a la tabla

                $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
                if (!isset($nw)) {
                    if (!$rs->Open("select * from vi_reportes where ca_idreporte = ".$id)) {    // Mueve el apuntador al registro que se desea modificar
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    else
                    {
                        ///echo "::".$rs->Value('ca_tiporep')."::";
                        if($rs->Value('ca_tiporep'))
                        {
                            $url="/reportesNeg/formReporte/id/" . $rs->Value('ca_idreporte') . "/impoexpo/" . $rs->Value('ca_impoexpo') . "/modo/" . $rs->Value('ca_transporte');
                            echo "<script>location.href='".$url."'</script>";
                        }
                    }
                }else {
                    if (!$rs->Open("select b.ca_idreporte, b.ca_version, b.ca_versiones, b.ca_fchreporte, b.ca_consecutivo, a.ca_idcotizacion, b.ca_origen, b.ca_ciuorigen, b.ca_idtraorigen, b.ca_traorigen, b.ca_destino, b.ca_ciudestino, b.ca_idtradestino, b.ca_tradestino, b.ca_impoexpo, b.ca_fchdespacho, b.ca_idagente,
                     b.ca_agente, b.ca_tiporep ,a.ca_incoterms, a.ca_mercancia_desc, a.ca_mcia_peligrosa, b.ca_idproveedor, b.ca_orden_prov, a.ca_idconcliente, b.ca_orden_clie, a.ca_confirmar_clie, a.ca_idconsignatario, a.ca_informar_cons, a.ca_idrepresentante, a.ca_informar_repr, a.ca_transporte, a.ca_modalidad, a.ca_colmas, a.ca_seguro,
                     a.ca_liberacion, a.ca_tiempocredito, a.ca_preferencias_clie, a.ca_instrucciones, a.ca_idconsignar, a.ca_consignar, a.ca_idbodega, a.ca_bodega, a.ca_tipobodega, a.ca_mastersame, a.ca_continuacion, a.ca_continuacion_dest, a.ca_final_dest, a.ca_continuacion_conf, a.ca_idlinea, a.ca_nombre,
                     b.ca_fchcreado, b.ca_usucreado, b.ca_fchactualizado, b.ca_usuactualizado, b.ca_fchanulado, b.ca_usuanulado, b.ca_nombre_pro, b.ca_contacto_pro, b.ca_direccion_pro, b.ca_telefonos_pro, b.ca_fax_pro, b.ca_email_pro, a.ca_nombre_cli, a.ca_idcliente, a.ca_digito, a.ca_contacto_cli, a.ca_telefonos_cli,
                     a.ca_fax_cli, a.ca_email_cli, a.ca_direccion_cli, a.ca_nombre_rep, a.ca_contacto_rep, a.ca_direccion_rep, a.ca_telefonos_rep, a.ca_fax_rep, a.ca_email_rep, a.ca_nombre_con, a.ca_contacto_con, a.ca_direccion_con, a.ca_telefonos_con, a.ca_fax_con, a.ca_email_con,
                     a.ca_vlrasegurado, a.ca_idmoneda_vlr, a.ca_primaventa, a.ca_minimaventa, a.ca_idmoneda_vta, a.ca_obtencionpoliza, a.ca_idmoneda_pol, a.ca_seguro_conf, a.ca_login, a.ca_vendedor, a.ca_sucursal
                     from (select * from vi_reportes where ca_idreporte = '$nw') a LEFT OUTER JOIN (select * from vi_reportes where ca_idreporte = '$id') b ON (true)")) {    // Mueve el apuntador al registro que se desea modificar
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }
                $tm =& DlRecordset::NewRecordset($conn);
                $us =& DlRecordset::NewRecordset($conn);
                carga_arreglos($tm);

                if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and ca_activo=true and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (!$tm->Open("select ca_confirmar from vi_concliente where ca_idcontacto = ".$rs->Value('ca_idconcliente'))) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $cambiar = ($nivel >= 1)?'':'DISABLED';
                $contactos = explode(",", $tm->Value('ca_confirmar'));
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/valreporte.js'></script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_contacto.style.top=dalt; find_texts.style.top=dalt'>";
                require_once("menu.php");
                echo "<DIV ID='find_contacto' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_contacto_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";
                echo "<DIV ID='find_texts' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='find_texts_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";

                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validador();'>";// Plantilla de Edición
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=\"".$rs->Value('ca_idreporte')."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='consecutivo' VALUE=\"".$rs->Value('ca_consecutivo')."\">";  // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='idetapa' VALUE=\"".$rs->Value('ca_idetapa')."\">"; // Hereda la etapa del reporte actual
                echo "<INPUT TYPE='HIDDEN' NAME='fchultstatus' VALUE=\"".$rs->Value('ca_fchultstatus')."\">"; // Hereda la etapa del reporte actual
                echo "<INPUT TYPE='HIDDEN' NAME='propiedades' VALUE=\"".$rs->Value('ca_propiedades')."\">"; // Hereda las variables del reporte actual
                echo "<INPUT TYPE='HIDDEN' NAME='validado' VALUE='false'>";              // Hereda el Id del registro que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='idseguimiento' VALUE=\"".$rs->Value('ca_idseguimiento')."\">"; // Hereda la idseguimiento del reporte actual
                if (isset($nw)) {
                    echo "<INPUT TYPE='HIDDEN' NAME='nw' VALUE='$nw'>";                   // Hereda el Id de la Referencia que se esta modificando
                }
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=5 style='font-weight:bold;'>REPORTE DE NEGOCIO</TH>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;'><B>ID. Reporte</B></CENTER></TD>";
                echo "  <TD Class=mostrar style='text-align:left; vertical-align:top;'>Reporte No.:<BR><CENTER><B>".$rs->Value('ca_consecutivo')."</B> Ver. ".$rs->Value('ca_version')."/".$rs->Value('ca_versiones')."</CENTER></TD>";
                echo "  <TD Class=mostrar style='text-align:left; vertical-align:top;'>Fecha del Reporte:<BR><CENTER><INPUT TYPE='TEXT' NAME='fchreporte' SIZE=12 VALUE='".$rs->Value('ca_fchreporte')."' READONLY></CENTER></TD>";
                echo "  <TD Class=mostrar style='text-align:left; vertical-align:top;'>Cotización No.:<BR><CENTER><INPUT TYPE='TEXT' NAME='idcotizacion' VALUE='".$rs->Value('ca_idcotizacion')."' ONBLUR='valores(this);' SIZE=11 MAXLENGTH=10></CENTER></TD>";
                echo "  <TD Class=invertir style='text-align:left; vertical-align:top;'><TABLE WIDTH=100% CELLSPACING=0>";
                echo "  	<TR><TD Class=mostrar style='text-align:left; vertical-align:bottom;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='terceros(\"find_texts\",\"impreporte\",\"findreporte\");'><CENTER><IMG alt='Click aquí para Buscar Reporte' src='graficos/importar.gif' hspace='0' vspace='0'>&nbsp;Importar&nbsp;un&nbsp;Reporte</CENTER></TD></TR>";
                echo "  	<TR><TD Class=mostrar style='text-align:left; vertical-align:bottom;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='terceros(\"find_contacto\",\"_pro_1\",\"findcotizacion\");'><CENTER><IMG alt='Click aquí para Buscar Cotización' src='graficos/lupa.gif' hspace='0' vspace='0'>&nbsp;Buscar&nbsp;Cotización</CENTER></TD></TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo>1. Importación</TD>";
                echo "  <TD Class=titulo COLSPAN=2>2. Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>3. Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT ID=impoexpo NAME='impoexpo' ONCHANGE='llenar_traficos();'>";
                for ($i=0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=".$imporexpor[$i];
                    if ($rs->Value('ca_impoexpo')==$imporexpor[$i]) {
                        echo " SELECTED"; }
                    echo ">".$imporexpor[$i]."</OPTION>";
                }
                echo "  </SELECT>&nbsp;&nbsp;&nbsp;</TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();' ONMOUSEWHEEL='return false;'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' ONMOUSEWHEEL='return false;' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();' ONMOUSEWHEEL='return false;'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' ONMOUSEWHEEL='return false;' SIZE=7 ONCLICK='continuacion_dest.selectedIndex=idciudestino.selectedIndex'>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' NAME='fchdespacho' SIZE=12 VALUE='".$rs->Value('ca_fchdespacho')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                echo "  <TD Class=listar COLSPAN=4>5. Agente:&nbsp;&nbsp;[Listar Todos&nbsp;<INPUT TYPE='CHECKBOX' NAME='todos_ag' WIDTH=10 ONCHANGE='llenar_agentes();'>]<BR><SELECT NAME='idagente' ONMOUSEWHEEL='return false;'>";                              // Llena el cuadro de lista con los valores de la tabla Agentes
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>6. Descripción de la Mercancía:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=93>".$rs->Value('ca_mercancia_desc')."</TEXTAREA><BR>¿Es Mercancía Peligrosa? <INPUT TYPE=CHECKBOX NAME='mcia_peligrosa' ".(($rs->Value("ca_mcia_peligrosa")=='t')?"CHECKED":"")."><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Marque esta opción para indicar que Sí es Mercancia Peligrosa'></TD>";
                echo "</TR>";
                $cadena = (trim(strlen($rs->Value('ca_idproveedor'))) != 0)?"ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")":"false";
                if (!$tm->Open("select * from vi_terceros where $cadena union (select vi_terceros.* from vi_terceros RIGHT OUTER JOIN tb_terceros on (null) limit 1)")) {
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
                $terminos= array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_incoterms')));
                $cadena  = "  <TD Class=titulo ROWSPAN=".($tm->GetRowCount()*2)." style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
                while (!$tm->Eof()) {
                    $pro = "_pro_".$tm->GetCurrentRow();
                    echo "<TR>";
                    echo "  <INPUT ID=id$pro TYPE='HIDDEN' NAME='idproveedor[]' VALUE='".$tm->Value('ca_idtercero')."'>";
                    echo $cadena;
                    echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean$pro src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                    echo "    <TD Class=mostrar COLSPAN=2>7. Nombre:<BR><INPUT ID=nombre$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_nombre')."' SIZE=50 MAXLENGTH=60></TD>";
                    echo "    <TD Class=mostrar>7.1 Orden:<BR><INPUT ID=orden$pro TYPE='TEXT' NAME='orden_prov[]' VALUE='".$ordenes[$tm->Value('ca_idtercero')]."' SIZE=20 MAXLENGTH=500></TD>";
                    echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"$pro\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=2>7.2 Contacto:<BR><INPUT ID=contacto$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_contacto')."' SIZE=50 MAXLENGTH=60></TD>";
                    echo "    <TD Class=mostrar COLSPAN=2>7.3 Dirección:<BR><INPUT ID=direccion$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_direccion')."' SIZE=40 MAXLENGTH=80></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>7.4 Teléfono:<BR><INPUT ID=telefonos$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_telefonos')."' SIZE=23 MAXLENGTH=30></TD>";
                    echo "    <TD Class=mostrar>7.5 Fax:<BR><INPUT ID=fax$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_fax')."' SIZE=23 MAXLENGTH=30></TD>";
                    echo "    <TD Class=mostrar COLSPAN=2>7.6 Correo Electrónico:<BR><INPUT ID=email$pro READONLY TYPE='TEXT' NAME='proveedor[]' VALUE='".$tm->Value('ca_email')."' SIZE=30 MAXLENGTH=40></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=4>7.7 Incoterms:<BR><SELECT ID=incoterms$pro NAME='incoterms[]'>";
                    echo "    <OPTION VALUE=''></OPTION>";
                    for ($i=0; $i < count($tincoterms); $i++) {
                        echo " <OPTION VALUE='".$tincoterms[$i]."'";
                        if ($terminos[$tm->Value('ca_idtercero')]==$tincoterms[$i]) {
                            echo " SELECTED"; }
                        echo ">".$tincoterms[$i]."</OPTION>";
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";

                    echo "  </TABLE></TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=invertir COLSPAN=4></TD>";
                    echo "</TR>";
                    $cadena = "";
                    $tm->MoveNext();
                }
                echo "<TR>";
                echo "  <INPUT ID=id_cli TYPE='HIDDEN' NAME='idconcliente' VALUE='".$rs->Value('ca_idconcliente')."'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=400 CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8. Nombre:<BR><INPUT ID=nombre_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_nombre_cli')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>8.1 Orden:<BR><INPUT TYPE='TEXT' NAME='orden_clie' VALUE='".$rs->Value('ca_orden_clie')."' SIZE=15 MAXLENGTH=255></TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_cli\",\"findcontacto\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>8.2 Contacto:<BR><INPUT ID=contacto_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_contacto_cli')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.3 Dirección:<BR><INPUT ID=direccion_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".str_replace ("|"," ",$rs->Value('ca_direccion_cli'))."' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>8.4 Teléfono:<BR><INPUT ID=telefonos_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_telefonos_cli')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>8.5 Fax:<BR><INPUT ID=fax_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_fax_cli')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>8.6 Correo Electrónico:<BR><INPUT ID=email_cli READONLY TYPE='TEXT' NAME='cliente[]' VALUE='".$rs->Value('ca_email_cli')."' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>8.7 Reportar como Notify: <INPUT NAME='repnotify' TYPE='radio' VALUE='0' ".(($rs->Value('ca_notify')==0)?'CHECKED':'')."></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_con TYPE='HIDDEN' NAME='idconsignatario' VALUE='".$rs->Value('ca_idconsignatario')."'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='cons_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consignatario:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='cons_tbl' WIDTH=400 CELLSPACING=1 style='display:".(($rs->Value('ca_idconsignatario')!=0 and $rs->Value('ca_idconsignatario')!=null)?"block":"none")."'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_con src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1 Nombre:<BR><INPUT ID=nombre_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_nombre_con')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.1.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_informar_cons')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_cons' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_informar_cons')=='No'?'CHECKED':'').">No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_con\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.2 Contacto:<BR><INPUT ID=contacto_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_contacto_con')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.3 Dirección:<BR><INPUT ID=direccion_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_direccion_con')."' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.1.4 Teléfono:<BR><INPUT ID=telefonos_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_telefonos_con')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.1.5 Fax:<BR><INPUT ID=fax_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_fax_con')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.1.6 Correo Electrónico:<BR><INPUT ID=email_con READONLY TYPE='TEXT' NAME='consignatario[]' VALUE='".$rs->Value('ca_email_con')."' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.1.7 Reportar como Notify: <INPUT NAME='repnotify' TYPE='radio' VALUE='1' ".(($rs->Value('ca_notify')==1)?'CHECKED':'')."></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_not TYPE='HIDDEN' NAME='idnotify' VALUE='".$rs->Value('ca_idnotify')."'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='noti_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Notify:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='noti_tbl' WIDTH=400 CELLSPACING=1 style='display:".(($rs->Value('ca_idnotify')!=0 and $rs->Value('ca_idnotify')!=null)?"block":"none")."'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_not src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2 Nombre:<BR><INPUT ID=nombre_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_nombre_not')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.2.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_informar_noti')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_noti' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_informar_noti')=='No'?'CHECKED':'').">No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_not\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.2 Contacto:<BR><INPUT ID=contacto_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_contacto_not')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.3 Dirección:<BR><INPUT ID=direccion_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_direccion_not')."' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.2.4 Teléfono:<BR><INPUT ID=telefonos_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_telefonos_not')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.2.5 Fax:<BR><INPUT ID=fax_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_fax_not')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.2.6 Correo Electrónico:<BR><INPUT ID=email_not READONLY TYPE='TEXT' NAME='notify[]' VALUE='".$rs->Value('ca_email_not')."' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=4>9.2.7 Reportar como Notify: <INPUT ID=default_not NAME='repnotify' TYPE='radio' VALUE='2' ".(($rs->Value('ca_notify')==2)?'CHECKED':'')."></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <INPUT ID=id_mas TYPE='HIDDEN' NAME='idmaster' VALUE='".$rs->Value('ca_idmaster')."'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='mast_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Consigna.Master:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='mast_tbl' WIDTH=400 CELLSPACING=1 style='display:".(($rs->Value('ca_idmaster')!=0 and $rs->Value('ca_idmaster')!=null)?"block":"none")."'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=4 style='text-align:center; vertical-align:top;'><IMG ID=clean_mas src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3 Nombre:<BR><INPUT ID=nombre_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_nombre_mas')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>9.3.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_informar_mast')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_mast' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_informar_mast')=='No'?'CHECKED':'').">No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_mas\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.2 Contacto:<BR><INPUT ID=contacto_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_contacto_mas')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.3 Dirección:<BR><INPUT ID=direccion_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_direccion_mas')."' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>9.3.4 Teléfono:<BR><INPUT ID=telefonos_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_telefonos_mas')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>9.3.5 Fax:<BR><INPUT ID=fax_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_fax_mas')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>9.3.6 Correo Electrónico:<BR><INPUT ID=email_mas READONLY TYPE='TEXT' NAME='master[]' VALUE='".$rs->Value('ca_email_mas')."' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <INPUT ID=id_rep TYPE='HIDDEN' NAME='idrepresentante' VALUE='".$rs->Value('ca_idrepresentante')."'>";
                echo "  <TD Class=titulo ROWSPAN=2 style='text-align:left; vertical-align:top;'><IMG id='repr_btn' SRC='./graficos/cerrado.gif' border=0 ALT='Pulse aquí para extender el cuadro' onclick='extender(this);'>&nbsp;Representante:<BR></TD>";
                echo "  <TD Class=mostrar COLSPAN=4><TABLE ID='repr_tbl' WIDTH=400 CELLSPACING=1 style='display:".(($rs->Value('ca_idrepresentante')!=0 and $rs->Value('ca_idrepresentante')!=null)?"block":"none")."'>";
                echo "  <TR>";
                echo "    <TD Class=mostrar ROWSPAN=3 style='text-align:center; vertical-align:top;'><IMG ID=clean_rep src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='clean_subform(this);'></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10. Nombre:<BR><INPUT ID=nombre_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_nombre_rep')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar>10.1 Enviar Información:<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_informar_repr')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;<INPUT NAME='informar_repr' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_informar_repr')=='No'?'CHECKED':'').">No</TD>";
                echo "    <TD Class=mostrar style='text-align:right;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='terceros(\"find_contacto\",\"_rep\",\"findtercero\");'><a><IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0'> Buscar</a></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>10.2 Contacto:<BR><INPUT ID=contacto_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_contacto_rep')."' SIZE=50 MAXLENGTH=60></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.3 Dirección:<BR><INPUT ID=direccion_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_direccion_rep')."' SIZE=40 MAXLENGTH=80></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>10.4 Teléfono:<BR><INPUT ID=telefonos_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_telefonos_rep')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar>10.5 Fax:<BR><INPUT ID=fax_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_fax_rep')."' SIZE=23 MAXLENGTH=30></TD>";
                echo "    <TD Class=mostrar COLSPAN=2>10.6 Correo Electrónico:<BR><INPUT ID=email_rep READONLY TYPE='TEXT' NAME='representante[]' VALUE='".$rs->Value('ca_email_rep')."' SIZE=30 MAXLENGTH=40></TD>";
                echo "  </TR>";
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1 BORDER=0>";

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=4>11.1 Preferencias del Cliente:<BR><TEXTAREA ID=preferencias_clie NAME='preferencias_clie' WRAP=virtual ROWS=9 COLS=80>".$rs->Value('ca_preferencias_clie')."</TEXTAREA><BR><INPUT TYPE='CHECKBOX' NAME='actualizar_pref' VALUE='true'> Actualizar preferencias en maestra de clientes</TD>";
                echo "  <TD Class=listar ROWSPAN=2>11.3 Informaciones a:<BR><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
                $z=0;
                $emails = str_replace(" ", "", $rs->Value('ca_confirmar_clie'));
                $emails = explode(",", $emails);
                for ($i=1; $i<=18; $i++) {
                    $contactos[$z] = trim($contactos[$z]);
                    $read_only = "";
                    $email = " ";
                    $cadena = (in_array($contactos[$z],$emails, false))?"VALUE='".$contactos[$z]."' CHECKED":"";
                    if (strlen($contactos[$z])!=0){
                        $email = $contactos[$z];
                        $read_only = "READONLY ";
                    }
                    echo "  <TR>";
                    echo "    <TD Class=invertir style='vertical-align:bottom;' WIDTH=130><INPUT ID=conf_$z Class=field TYPE='TEXT' NAME='contactos[]' VALUE='$email' $read_only ONCHANGE='cambiar_email(this);' SIZE=40 MAXLENGTH=50></TD><TD Class=invertir><INPUT ID=email_$z TYPE='CHECKBOX' NAME='confirmar[]' WIDTH=10 ONCHANGE='asignar_email(this);' $cadena></TD>";
                    echo "  </TR>";
                    $z++;
                }
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=4>11.2 Instrucciones Especiales para el Agente:&nbsp;<IMG src='graficos/cerrado.gif' ALT='Click para incluir textos predefinidos' ONCLICK='terceros(\"find_texts\",\"Instructions_sea\",\"ventanas\");'<BR><TEXTAREA ID=instrucciones NAME='instrucciones' WRAP=virtual ROWS=9 COLS=80>".$rs->Value('ca_instrucciones')."</TEXTAREA></TD>";
                echo "</TR>";

                echo "  </TABLE></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";

                echo "    <TR>";
                echo "      <TD Class=mostrar>12. Transporte:<BR><CENTER><SELECT ID=transporte NAME='transporte' ONCHANGE='llenar_modalidades();llenar_continuaciones();'>";
                for ($i=0; $i < count($transportes); $i++) {
                    echo " <OPTION VALUE=".$transportes[$i];
                    if ($rs->Value('ca_transporte')==$transportes[$i]) {
                        echo " SELECTED"; }
                    echo ">".$transportes[$i];
                }
                echo "      </SELECT></CENTER></TD>";
                echo "      <TD Class=mostrar>13. Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='llenar_lineas();'>";
                echo "      </SELECT></TD>";
                echo "      <TD Class=mostrar COLSPAN=2>14. Línea Transporte:<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                echo "      </SELECT></TD>";
                echo "    </TR>";
                echo "    <TR HEIGHT=5>";
                echo "      <TD Class=invertir COLSPAN=4></TD>";
                echo "    </TR>";

                if (!$tm->Open("select ca_diascredito, ca_cupo from tb_libcliente lc, tb_concliente cc where lc.ca_idcliente = cc.ca_idcliente and cc.ca_idcontacto = ".$rs->Value('ca_idconcliente'))) { // Hace un Select a la vista e uncluye un registro vacio
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                $lib_mem = ($tm->Value('ca_cupo') != 0 or $tm->Value('ca_diascredito') != 0)?true:false;
                echo "    <TR>";
                echo "      <TD Class=mostrar>15. Colmas Ltda:<BR><CENTER><INPUT ID='chk_colmas_0' NAME='colmas' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_colmas')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;&nbsp;<INPUT ID='chk_colmas_1' NAME='colmas' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_colmas')=='No'?'CHECKED':'').">No</CENTER></TD>";
                echo "      <TD Class=mostrar>16. Seguro:<BR><CENTER><INPUT ID='chk_seguro_0' NAME='seguro' TYPE='radio' VALUE = 'Sí' ".($rs->Value('ca_seguro')=='Sí'?'CHECKED':'').">Sí&nbsp;&nbsp;&nbsp;&nbsp;<INPUT ID='chk_seguro_1' NAME='seguro' TYPE='radio' VALUE = 'No' ".($rs->Value('ca_seguro')=='No'?'CHECKED':'').">No</CENTER></TD>";
                echo "      <TD Class=mostrar>17. Lib. Automática:<BR><CENTER><INPUT ID=si NAME='liberacion' TYPE='radio' VALUE = 'Sí' ".($lib_mem?'CHECKED':'')." DISABLED>Sí&nbsp;&nbsp;&nbsp;<INPUT ID=no NAME='liberacion' TYPE='radio' VALUE = 'No' ".(!$lib_mem?'CHECKED':'')." DISABLED>No</CENTER></TD>";
                echo "      <TD Class=mostrar>Tiempo de Crédito:<BR><CENTER><INPUT DISABLED TYPE='TEXT' NAME='tiempocredito' VALUE='".($tm->Value('ca_diascredito')!=0?$tm->Value('ca_diascredito').' Días':'-')."' SIZE=18 MAXLENGTH=20></CENTER></TD>";
                echo "    </TR>";
                echo "    <TR HEIGHT=5>";
                echo "      <TD Class=invertir COLSPAN=4></TD>";
                echo "    </TR>";

                echo "    <TR>";
                echo "      <TD Class=listar WIDTH=175>18.1 Continuación/Viaje:";
                echo "      <TD Class=listar><SELECT NAME='continuacion' ONCHANGE='llenar_finales();'></SELECT>";  // Llena el cuadro de lista con la lista de continuaciones de viaje
                echo "      <TD Class=listar>18.2 Destino Final:";
                echo "      <TD Class=listar><SELECT NAME='continuacion_dest'></SELECT>";                          // Llena el cuadro de lista con la lista de ciudades destino de continuaciones de viaje
                echo "    </TR>";

                echo "    <TR>";
                echo "      <TD Class=listar>18.3 Notificar C/Viaje al email:";
                echo "      <TD Class=listar COLSPAN=3><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
                if (!$tm->Open("select ca_email, ca_login from vi_usuarios where ca_cargo like '%OTM%'")) { // Hace un Select a la vista e uncluye un registro vacio
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $tm->MoveFirst();
                $econf_sel = explode(',',$rs->Value('ca_continuacion_conf'));
                for($i=0; $i<round($tm->GetRowCount()-(round($tm->GetRowCount()%3))/3)/3; $i++) {
                    echo "<TR>";
                    for($j=0; $j<3; $j++) {
                        $econf_mem = (!$tm->Eof() and !$tm->IsEmpty() and strlen($tm->Value('ca_login'))!=0)?$tm->Value('ca_login'):'';
                        $check_mem = (in_array($tm->Value('ca_login'),$econf_sel))?'CHECKED':'';
                        if (strlen($econf_mem)!=0) {
                            echo "<TD Class=invertir style='vertical-align:bottom;' WIDTH=130><INPUT ID=econt_$z TYPE='radio' NAME='econt[]' VALUE='$econf_mem' WIDTH=10 $check_mem>".$tm->Value('ca_email')."</TD>";
                        }else {
                            echo "<TD Class=invertir style='vertical-align:bottom;' WIDTH=130></TD>";
                        }
                        $tm->MoveNext();
                    }
                    echo "</TR>";
                }
                echo "      </TABLE></TD>";
                echo "    </TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "    <TR>";
                echo "      <TD Class=mostrar>19.1 Consignar HAWB/HBL a :</TD>";                                       // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "      <TD Class=mostrar COLSPAN=3><SELECT NAME='idconsignar'></SELECT></TD>";
                echo "    </TR>";
                echo "    <TR>";
                echo "      <TD Class=mostrar>19.2 Trasladar a :</TD>";                                           // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "      <TD Class=mostrar COLSPAN=3><SELECT NAME='tipo' ONCHANGE='llenar_bodegas();'></SELECT></TD>";
                echo "    </TR>";
                echo "    <TR>";
                echo "      <TD Class=mostrar>19.3 Igualar Master/Hijo: <SELECT NAME='mastersame'><OPTION VALUE='No'>No</OPTION><OPTION VALUE='Sí'>Sí</OPTION></SELECT></TD>";
                echo "      <TD Class=mostrar COLSPAN=4><SELECT NAME='idbodega'></SELECT></TD>";                   // Llena el cuadro de lista con las zonas o depósitos aduaneros
                echo "    </TR>";
                echo "  </TABLE></TD>";

                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=titulo style='text-align:left;'>Rep. Comercial:";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo "  <TD Class=mostrar COLSPAN=2><SELECT NAME='login' $cambiar>";
                while (!$us->Eof()) {
                    echo "<OPTION VALUE=".$us->Value('ca_login');
                    if ($rs->Value('ca_vendedor')==$us->Value('ca_nombre')) {
                        echo " SELECTED"; }
                    echo ">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=invertir>Elabora: </TD>";
                echo "  <TD Class=invertir><B>$usuario</B></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";

                if ( strlen($rs->Value('ca_usucerrado')) == 0  ) {
                    echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Modificación' ONCLICK='validar(this);'></TH>";    // Ordena almacenar los datos ingresados
                    echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Nueva Versión' ONCLICK='validar(this);'></TH>";         // Ordena almacenar los datos ingresados
                }
                //echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Reporte Nuevo' ONCLICK='validar(this);'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"reportenegocio.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operación
                echo "<script>llenar_traficos();</script>";
                echo "<script>elegir_traficos('".$rs->Value('ca_idtraorigen')."','".$rs->Value('ca_idtradestino')."');</script>";
                echo "<script>elegir_puertos('".$rs->Value('ca_origen')."','".$rs->Value('ca_destino')."');</script>";
                echo "<script>llenar_finales();</script>";
                echo "<script>llenar_agentes();</script>";
                echo "<script>elegir_item('idagente', '".$rs->Value('ca_idagente')."');</script>";
                echo "<script language='JavaScript' type='text/JavaScript'>";
                echo "  if (document.getElementById('idagente').value != '".$rs->Value('ca_idagente')."') {";
                echo "   	 document.getElementById('todos_ag').checked = true;";
                echo "   	 llenar_agentes();";
                echo "   	 elegir_item('idagente', '".$rs->Value('ca_idagente')."'); }";
                echo "</script>";
                echo "<script>elegir_item('modalidad', '".$rs->Value('ca_modalidad')."');</script>";
                echo "<script>llenar_lineas();</script>";
                echo "<script>elegir_item('idlinea', '".$rs->Value('ca_idlinea')."');</script>";
                echo "<script>elegir_item('continuacion', '".$rs->Value('ca_continuacion')."');</script>";
                echo "<script>elegir_item('idconsignar', '".$rs->Value('ca_idconsignar')."');</script>";
                echo "<script>elegir_item('tipo', '".$rs->Value('ca_tipobodega')."');</script>";
                echo "<script>llenar_bodegas();</script>";
                echo "<script>elegir_item('idbodega', '".$rs->Value('ca_idbodega')."');</script>";
                echo "<script>elegir_item('continuacion_dest', '".$rs->Value('ca_continuacion_dest')."');</script>";
                echo "<script>elegir_item('mastersame', '".$rs->Value('ca_mastersame')."');</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Liquidar': {                                                    // Opcion para Consultar un solo registro
                if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

                $modalidad = ($rs->Value('ca_modalidad') == 'COLOADING')?'LCL':$rs->Value('ca_modalidad');
                $union = ($rs->Value('ca_continuacion')<>"N/A")?" union select ca_idrecargo, ca_recargo, ca_tipo from tb_tiporecargo where ca_recargo = 'OTM/DTA'":"";
                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
                echo "function elegir(opcion, id){";
                echo "    document.location.href = 'reportenegocio.php?boton='+opcion+'\&id='+id;";
                echo "}";
                echo "function uno(src,color_entrada) {";
                echo "    src.style.background=color_entrada;src.style.cursor='hand'";
                echo "}";
                echo "function dos(src,color_default) {";
                echo "    src.style.background=color_default;src.style.cursor='default';";
                echo "}";
                echo "function validar(){";
                echo "  if (eval(document.getElementById('coltrans_usa').value)){";
                echo "      if (!confirm(\"En razón a que éste embarque va a ser manejado por Coltrans USA, tenga en cuenta que en reportar deben ser desglosados como mínimo los recargos BAF y GRI, SIN IMPORTAR que hayan sido incluidos en la venta dentro del Flete bajo el esquema All-In. ¿Tuvo en cuenta éste procedimiento?\")){";
                echo "        return (false);";
                echo "      }";
                echo "  }";
                echo "  i = 0;";
                echo "  check = false;";
                echo "  conceptos = new Array();";
                echo "  while (isNaN(document.getElementById('fidco_'+i))) {";
                echo "     objeto = document.getElementById('fidco_'+i);";
                echo "     if (!isNaN(parseInt(objeto.value)) && parseInt(objeto.value) > 0) {";
                echo "        conceptos.push(objeto.value);";
                echo "        check = true;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  if (!check){";
                echo "     alert('Debe registrar por lo menos un Concepto de Carga.');";
                echo "     return (false);";
                echo "  }";
                echo "  i = 0;";
                echo "  check = false;";
                echo "  while (isNaN(document.getElementById('ridrc_'+i))) {";
                echo "     objeto = document.getElementById('ridrc_'+i);";
                echo "     if (!isNaN(parseInt(objeto.value)) && objeto.value > 0) {";
                echo "        objeto = document.getElementById('ridco_'+i);";
                echo "        if (objeto.value != 9999 && !find_in_array(conceptos, objeto.value)) {";
                echo "           alert('Error - Un Recargo en Origen está asociado a un concepto de carga que no tiene valor de fletes!');";
                echo "           return (false);";
                echo "        }";
                echo "        check = true;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  if (!check){";
                echo "     alert('Debe registrar por lo menos un Recargo en Origen.');";
                echo "     return (false);";
                echo "  }";
                echo "  i = 0;";
                echo "  check = false;";
                echo "  while (isNaN(document.getElementById('lidrc_'+i))) {";
                echo "     objeto = document.getElementById('lidrc_'+i);";
                echo "     if (!isNaN(parseInt(objeto.value)) && objeto.value > 0) {";
                echo "        check = true;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  if (!check){";
                echo "     alert('Debe registrar por lo menos un Recargo Local.');";
                echo "     return (false);";
                echo "  }";
                if ($rs->Value('ca_colmas')== "Sí") {
                    echo "  if (document.adicionar.coordinador.value == ''){";
                    echo "      alert('Debe especificar el coordinador de aduanas');";
                    echo "  	 return (false);";
                    echo "  }";
                    echo "  i = 0;";
                    echo "  check = false;";
                    echo "  while (isNaN(document.getElementById('aidco_'+i))) {";
                    echo "     objeto = document.getElementById('aidco_'+i);";
                    echo "     if (!isNaN(parseInt(objeto.value)) && parseInt(objeto.value) > 0) {";
                    echo "        check = true;";
                    echo "     }";
                    echo "     i++;";
                    echo "  }";
                    echo "  if (!check){";
                    echo "     alert('Debe registrar por lo menos un Concepto de Aduanas.');";
                    echo "     return (false);";
                    echo "  }";
                }
                if ($rs->Value('ca_seguro')== "Sí") {
                    echo "  if (document.adicionar.vlrasegurado.value == '' || document.adicionar.vlrasegurado.value < 0)";
                    echo "      alert('El valor Asegurado no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.primaventa.value == '' || document.adicionar.primaventa.value < 0)";
                    echo "      alert('El Porcentaje de Venta Prima no es válido o no puede ser igual a 0');";
                    echo "  else if (document.adicionar.obtencionpoliza.value == '' || document.adicionar.obtencionpoliza.value < 0)";
                    echo "      alert('El Valor por Obtención de la Póliza no es válido o no puede ser igual a 0');";
                    echo "  else";
                    echo "      return (true);";
                    echo "  return (false);";
                }
                echo "}";
                echo "function capturas(objeto, i, id){";
                echo "  ventana = document.getElementById('captura');";
                echo "  ventana.style.visibility = \"visible\";";
                echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
                echo "  ventana = document.getElementById('frame_captura');";
                echo "  ventana.src='ventanas.php?opcion='+objeto+'\&i='+i+'\&id='+id;";
                echo "}";
                echo "function find_in_array(objeto, i){";
                echo "  for(j=0; j<objeto.length; j++){";
                echo "    if (objeto[j] == i)";
                echo "       return(true);";
                echo "  }";
                echo "  return(false);";
                echo "}";
                echo "</script>";

                echo "</HEAD>";
                echo "<BODY  onscroll='dalt=document.body.scrollTop+3; captura.style.top=dalt;'>";
                require_once("menu.php");
                echo "<DIV ID='captura' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
                echo "<IFRAME ID=frame_captura SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:175'>";
                echo "</IFRAME>";
                echo "</DIV>";
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='reportenegocio.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='coltrans_usa' VALUE=".(($rs->Value('ca_idagente')=='317')?'true':'false').">";                 // Condición especial para Coltrans MIA
                datos_basicos($nivel,$rs,$tm);
                if ($rs->Value('ca_seguro')== "Sí") {
                    $mn =& DlRecordset::NewRecordset($conn);
                    if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                        echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    if (!$tm->Open("select ca_email, ca_login, ca_nombre from vi_usuarios where ca_cargo like '%Pólizas%'")) {          // Selecciona los correos de la tabla Parametros
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }

                    echo "<TR>";
                    echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=4 style='text-align:center; font-weight:bold;'>INFORMACIÓN PARA LA ASEGURADORA</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar style='vertical-align:bottom;'>20.1 Valor Asegurado:<BR><INPUT TYPE='TEXT' NAME='vlrasegurado' VALUE=".($rs->Value('ca_vlrasegurado')+0)." SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_vlr'>";  // Llena el cuadro de lista con los valores de la tabla Monedas
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        if ($mn->Value("ca_idmoneda")=='COP') {
                            echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                            if ($mn->Value('ca_idmoneda')==$rs->Value('ca_idmoneda_vlr') or ($rs->Value('ca_idmoneda_vlr')=='' and $mn->Value('ca_idmoneda')=='USD')) {
                                echo" SELECTED"; }
                            echo ">".$mn->Value('ca_idmoneda')."</OPTION>";
                        }
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=listar style='vertical-align:bottom;'>20.2 Obtención Póliza:<BR><INPUT TYPE='TEXT' NAME='obtencionpoliza' VALUE='".($rs->Value('ca_obtencionpoliza')+0)."' SIZE=15 MAXLENGTH=15>";
                    echo "    <SELECT NAME='idmoneda_pol'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda')==$rs->Value('ca_idmoneda_pol') or ($rs->Value('ca_idmoneda_vlr')=='' and $mn->Value('ca_idmoneda')=='USD')) {
                            echo" SELECTED"; }
                        echo ">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar style='vertical-align:bottom;'>20.3 Prima Venta:<BR><INPUT TYPE='TEXT' NAME='primaventa' VALUE=".($rs->Value('ca_primaventa')+0)." SIZE=4 MAXLENGTH=4>% Min. <INPUT TYPE='TEXT' NAME='minimaventa' VALUE=".($rs->Value('ca_minimaventa')+0)." SIZE=8 MAXLENGTH=6>";
                    echo "    <SELECT NAME='idmoneda_vta'>";  // Llena el cuadro de lista con los valores de la tabla Monedas
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                        if ($mn->Value('ca_idmoneda')==$rs->Value('ca_idmoneda_vta') or ($rs->Value('ca_idmoneda_vta')=='' and $mn->Value('ca_idmoneda')=='USD')) {
                            echo" SELECTED"; }
                        echo ">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar COLSPAN=3>20.4 Notificar Seguro:<BR><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
                    $tm->MoveFirst();
                    $esegu_sel = explode(',',$rs->Value('ca_seguro_conf'));
                    for($i=0; $i<round($tm->GetRowCount()-(round($tm->GetRowCount()%3))/3)/3; $i++) {
                        echo "<TR>";
                        for($j=0; $j<3; $j++) {
                            $esegu_mem = (!$tm->Eof() and !$tm->IsEmpty() and strlen($tm->Value('ca_login'))!=0)?$tm->Value('ca_login'):'';
                            $check_mem = (in_array($tm->Value('ca_login'),$esegu_sel) || ($i==0&&$j==0))?'CHECKED':'';
                            if (strlen($esegu_mem)!=0) {
                                echo "<TD Class=invertir style='vertical-align:bottom;'><INPUT ID=esegu_$z TYPE='radio' NAME='esegu[]' VALUE='$esegu_mem' WIDTH=10 $check_mem>".$tm->Value('ca_email')."</TD>";
                            }else {
                                echo "<TD Class=invertir style='vertical-align:bottom;'></TD>";
                            }
                            $tm->MoveNext();
                        }
                        echo "</TR>";
                    }
                    echo "    </TABLE></TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                if ($rs->Value('ca_colmas')== "Sí") {
                    $us =& DlRecordset::NewRecordset($conn);
                    if (!$us->Open("select u.ca_login, u.ca_nombre, c.ca_coordinador from vi_usuarios u LEFT OUTER JOIN (select ca_coordinador from tb_clientes where ca_idcliente in (select ca_idcliente from tb_concliente where ca_idcontacto = ".$rs->Value('ca_idconcliente').")) c ON (u.ca_login = c.ca_coordinador) where ca_cargo like '%Coordinador%Aduana%' order by ca_login")) {
                        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }

                    $rp = (strlen($rs->Value('ca_idrepaduana')) == 0)?0:$rs->Value('ca_idrepaduana');
                    echo "<INPUT TYPE='HIDDEN' NAME='idrepaduana' VALUE=$rp>";
                    echo "<TR>";
                    echo "  <TD Class=mostrar COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=2 style='text-align:center; font-weight:bold;'>NACIONALIZACION CON COLMAS SIA LTDA.</TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar><B>Transporte de Carga Nacionalizada</B></TD>";
                    echo "    <TD Class=listar ROWSPAN=3>21.3 Instrucciones Especiales para Colmas:<BR><TEXTAREA NAME='instrucciones' WRAP=virtual ROWS=5 COLS=80>".$rs->Value('ca_instrucciones_ad')."</TEXTAREA></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "  <TD Class=listar>21.1 Con Coltrans: <SELECT NAME='transnacarga'>";
                    for ($i=0; $i<count($siono); $i++) {
                        echo " <OPTION VALUE=".$siono[$i];
                        if ($rs->Value('ca_transnacarga')==$siono[$i]) {
                            echo " SELECTED"; }
                        echo">".$siono[$i]."</OPTION>";
                    }
                    echo "  </SELECT></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "  <TD Class=listar>21.2 Tipo: <SELECT NAME='transnatipo'>";
                    for ($i=0; $i<count($transnatipos); $i++) {
                        echo " <OPTION VALUE='".$transnatipos[$i]."'";
                        if ($rs->Value('ca_transnatipo')==$transnatipos[$i]) {
                            echo " SELECTED"; }
                        echo">".$transnatipos[$i]."</OPTION>";
                    }
                    echo "  </SELECT></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=listar COLSPAN=2 style='text-align:right;'>21.4 Coordinador: <SELECT ID=login NAME='coordinador'>";
                    echo "    <OPTION VALUE=''></OPTION>";
                    $coo_mem = (strlen($rs->Value('ca_coordinador'))!=0)?$rs->Value('ca_coordinador'):$us->Value('ca_coordinador');
                    while (!$us->Eof()) {
                        echo "<OPTION VALUE='".$us->Value('ca_login')."'".(($us->Value('ca_login')==$coo_mem)?" SELECTED":"").">".$us->Value('ca_nombre')."</OPTION>";
                        $us->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "  </TR>";
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>EMBARQUE ".strtoupper($rs->Value('ca_transporte'))."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                if ($rs->Value('ca_transporte') == 'Marítimo') {
                    echo "<TH>Concepto</TH>";
                    echo "<TH>Cantidad</TH>";
                    echo "<TH>T.Neta</TH>";
                    echo "<TH>T.Mínimo</TH>";
                    echo "<TH>Mnd</TH>";
                    echo "<TH>T.Reportar</TH>";
                    echo "<TH>T.Mínimo</TH>";
                    echo "<TH>Mnd</TH>";
                    echo "<TH>T.Cobrar</TH>";
                    echo "<TH>T.Mínimo</TH>";
                    echo "<TH>Mnd</TH>";
                    if (!$tm->Open("select * from vi_reptarifas where ca_idreporte = $id")) {       // Selecciona todos lo registros de la tabla Conceptos
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    while (!$tm->Eof() and !$tm->IsEmpty()) {
                        $i = ($tm->GetCurrentRow()-1);
                        echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Concepto\",$i, $id);'>";
                        echo "  <INPUT ID=foidt_$i TYPE='HIDDEN' NAME='conceptos[$i][foidt]' VALUE=".$tm->Value('ca_oid').">";
                        echo "  <INPUT ID=fidco_$i TYPE='HIDDEN' NAME='conceptos[$i][fidco]' VALUE=".$tm->Value('ca_idconcepto').">";
                        echo "  <INPUT ID=fobvs_$i TYPE='HIDDEN' NAME='conceptos[$i][fobvs]' VALUE=\"".$tm->Value('ca_observaciones')."\">";
                        echo "  <TD align=left><INPUT ID=fconc_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY VALUE=\"".$tm->Value('ca_concepto')."\">&nbsp;</TD>";
                        echo "  <TD align=right WIDTH=40><INPUT ID=fcant_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcant]' VALUE=".$tm->Value('ca_cantidad')."></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fntar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fntar]' VALUE=".$tm->Value('ca_neta_tar')."></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fnmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fnmin]' VALUE=".$tm->Value('ca_neta_min')."></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fnidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fnidm]' VALUE=\"".$tm->Value('ca_neta_idm')."\"></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=frtar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frtar]' VALUE=".$tm->Value('ca_reportar_tar')."></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frmin]' VALUE=".$tm->Value('ca_reportar_min')."></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fridm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fridm]' VALUE=\"".$tm->Value('ca_reportar_idm')."\"></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fctar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fctar]' VALUE=".$tm->Value('ca_cobrar_tar')."></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fcmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcmin]' VALUE=".$tm->Value('ca_cobrar_min')."></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fcidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcidm]' VALUE=\"".$tm->Value('ca_cobrar_idm')."\"></TD>";
                        echo "</TR>";
                        $tm->MoveNext();
                    }
                    for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ) {
                        echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Concepto\",$i, $id);'>";
                        echo "  <INPUT ID=foidt_$i TYPE='HIDDEN' NAME='conceptos[$i][foidt]'>";
                        echo "  <INPUT ID=fidco_$i TYPE='HIDDEN' NAME='conceptos[$i][fidco]'>";
                        echo "  <INPUT ID=fobvs_$i TYPE='HIDDEN' NAME='conceptos[$i][fobvs]'>";
                        echo "  <TD align=left><INPUT ID=fconc_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY>&nbsp;</TD>";
                        echo "  <TD align=right WIDTH=40><INPUT ID=fcant_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcant]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fntar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fntar]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fnmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fnmin]'></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fnidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fnidm]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=frtar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frtar]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frmin]'></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fridm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fridm]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fctar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fctar]'></TD>";
                        echo "  <TD align=right WIDTH=65><INPUT ID=fcmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcmin]'></TD>";
                        echo "  <TD align=right WIDTH=25><INPUT ID=fcidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcidm]'></TD>";
                        echo "</TR>";
                    }
                }else if ($rs->Value('ca_transporte') == 'Aéreo') {
                        echo "<TD Class=invertir></TD>";
                        echo "<TH>Concepto</TH>";
                        echo "<TH>T.Reportar</TH>";
                        echo "<TH>T.Mínimo</TH>";
                        echo "<TH>Mnd</TH>";
                        echo "<TH>T.Cobrar</TH>";
                        echo "<TH>T.Mínimo</TH>";
                        echo "<TH>Mnd</TH>";
                        echo "<TD Class=invertir></TD>";
                        if (!$tm->Open("select * from vi_reptarifas where ca_idreporte = $id")) {       // Selecciona todos lo registros de la tabla Conceptos
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit; }
                        while (!$tm->Eof() and !$tm->IsEmpty()) {
                            $i = ($tm->GetCurrentRow()-1);
                            echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Rangos\",$i, $id);'>";
                            echo "  <INPUT ID=foidt_$i TYPE='HIDDEN' NAME='conceptos[$i][foidt]' VALUE=".$tm->Value('ca_oid').">";
                            echo "  <INPUT ID=fidco_$i TYPE='HIDDEN' NAME='conceptos[$i][fidco]' VALUE=".$tm->Value('ca_idconcepto').">";
                            echo "  <INPUT ID=fobvs_$i TYPE='HIDDEN' NAME='conceptos[$i][fobvs]' VALUE=\"".$tm->Value('ca_observaciones')."\">";
                            echo "  <TD Class=invertir WIDTH=50></TD>";
                            echo "  <TD align=left><INPUT ID=fconc_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY VALUE=\"".$tm->Value('ca_concepto')."\">&nbsp;</TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=frtar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frtar]' VALUE=".$tm->Value('ca_reportar_tar')."></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frmin]' VALUE=".$tm->Value('ca_reportar_min')."></TD>";
                            echo "  <TD align=right WIDTH=25><INPUT ID=fridm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fridm]' VALUE=\"".$tm->Value('ca_reportar_idm')."\"></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=fctar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fctar]' VALUE=".$tm->Value('ca_cobrar_tar')."></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=fcmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcmin]' VALUE=".$tm->Value('ca_cobrar_min')."></TD>";
                            echo "  <TD align=right WIDTH=25><INPUT ID=fcidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcidm]' VALUE=\"".$tm->Value('ca_cobrar_idm')."\"></TD>";
                            echo "  <TD Class=invertir WIDTH=50></TD>";
                            echo "</TR>";
                            $tm->MoveNext();
                        }
                        for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+8); $i++ ) {
                            echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Rangos\",$i, $id);'>";
                            echo "  <INPUT ID=foidt_$i TYPE='HIDDEN' NAME='conceptos[$i][foidt]'>";
                            echo "  <INPUT ID=fidco_$i TYPE='HIDDEN' NAME='conceptos[$i][fidco]'>";
                            echo "  <INPUT ID=fobvs_$i TYPE='HIDDEN' NAME='conceptos[$i][fobvs]'>";
                            echo "  <TD Class=invertir WIDTH=50></TD>";
                            echo "  <TD align=left><INPUT ID=fconc_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY>&nbsp;</TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=frtar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frtar]'></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=frmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][frmin]'></TD>";
                            echo "  <TD align=right WIDTH=25><INPUT ID=fridm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fridm]'></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=fctar_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fctar]'></TD>";
                            echo "  <TD align=right WIDTH=75><INPUT ID=fcmin_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcmin]'></TD>";
                            echo "  <TD align=right WIDTH=25><INPUT ID=fcidm_$i Class=field TYPE='TEXT' READONLY NAME='conceptos[$i][fcidm]'></TD>";
                            echo "  <TD Class=invertir WIDTH=50></TD>";
                            echo "</TR>";
                        }
                    }
                echo "  </TABLE></CENTER></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5 style='text-align:center; font-weight:bold;'>RELACIÓN DE RECARGOS</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                echo "    <TH>Recargo en Origen</TH>";
                echo "    <TH>Aplicación</TH>";
                echo "    <TH>Tipo</TH>";
                echo "    <TH>T.Neta</TH>";
                echo "    <TH>T.Mínimo</TH>";
                echo "    <TH>T.Reportar</TH>";
                echo "    <TH>T.Mínimo</TH>";
                echo "    <TH>T.Cobrar</TH>";
                echo "    <TH>T.Mínimo</TH>";
                echo "    <TH>Mnd</TH>";
                if (!$tm->Open("select * from vi_repgastos where ca_tiporecargo like '%Recargo en Origen%' and ca_idreporte = $id")) {       // Selecciona todos lo registros de la tabla Recargos
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof() and !$tm->IsEmpty()) {
                    $i = ($tm->GetCurrentRow()-1);
                    echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Recargos_Org\",$i, $id);'>";
                    echo "  <INPUT ID=roidr_$i TYPE='HIDDEN' NAME='recargos_org[$i][roidr]' VALUE=".$tm->Value('ca_oid').">";
                    echo "  <INPUT ID=ridrc_$i TYPE='HIDDEN' NAME='recargos_org[$i][ridrc]' VALUE=".$tm->Value('ca_idrecargo').">";
                    echo "  <TD align=left><INPUT ID=rreco_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY VALUE=\"".$tm->Value('ca_recargo')."\">&nbsp;</TD>";
                    echo "  <TD align=left WIDTH=80><INPUT ID=rapli_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rapli]' VALUE=\"".$tm->Value('ca_aplicacion')."\"></TD>";
                    echo "  <TD align=center WIDTH=10><INPUT ID=rtipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rtipo]' VALUE=\"".$tm->Value('ca_tipo')."\"></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rntar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rntar]' VALUE=".$tm->Value('ca_neta_tar')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rnmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rnmin]' VALUE=".$tm->Value('ca_neta_min')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rrtar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rrtar]' VALUE=".$tm->Value('ca_reportar_tar')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rrmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rrmin]' VALUE=".$tm->Value('ca_reportar_min')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rctar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rctar]' VALUE=".$tm->Value('ca_cobrar_tar')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rcmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rcmin]' VALUE=".$tm->Value('ca_cobrar_min')."></TD>";
                    echo "  <TD align=right WIDTH=25><INPUT ID=ridmn_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][ridmn]' VALUE=\"".$tm->Value('ca_idmoneda')."\"></TD>";
                    echo "  <INPUT ID=ridco_$i TYPE='HIDDEN' NAME='recargos_org[$i][ridco]' VALUE=".$tm->Value('ca_idconcepto').">";
                    echo "  <INPUT ID=rdets_$i TYPE='HIDDEN' NAME='recargos_org[$i][rdets]' VALUE=\"".$tm->Value('ca_detalles')."\">";
                    echo "</TR>";
                    $tm->MoveNext();
                }
                for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ) {
                    echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Recargos_Org\",$i, $id);'>";
                    echo "  <INPUT ID=roidr_$i TYPE='HIDDEN' NAME='recargos_org[$i][roidr]'>";
                    echo "  <INPUT ID=ridrc_$i TYPE='HIDDEN' NAME='recargos_org[$i][ridrc]'>";
                    echo "  <TD align=left><INPUT ID=rreco_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY>&nbsp;</TD>";
                    echo "  <TD align=left WIDTH=80><INPUT ID=rapli_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rapli]'></TD>";
                    echo "  <TD align=center WIDTH=10><INPUT ID=rtipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rtipo]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rntar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rntar]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rnmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rnmin]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rrtar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rrtar]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rrmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rrmin]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rctar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rctar]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=rcmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][rcmin]'></TD>";
                    echo "  <TD align=right WIDTH=25><INPUT ID=ridmn_$i Class=field TYPE='TEXT' READONLY NAME='recargos_org[$i][ridmn]'></TD>";
                    echo "  <INPUT ID=ridco_$i TYPE='HIDDEN' NAME='recargos_org[$i][ridco]'>";
                    echo "  <INPUT ID=rdets_$i TYPE='HIDDEN' NAME='recargos_org[$i][rdets]'>";
                    echo "</TR>";
                }
                echo "    </TABLE></CENTER></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=5><CENTER><TABLE WIDTH=378 CELLSPACING=1>";
                echo "    <TH>Recargo Local</TH>";
                echo "    <TH>Aplicación</TH>";
                echo "    <TH>Tipo</TH>";
                echo "    <TH>T.Cobrar</TH>";
                echo "    <TH>T.Mínimo</TH>";
                echo "    <TH>Mnd</TH>";
                if (!$tm->Open("select * from vi_repgastos where ca_tiporecargo like '%Recargo Local%' and ca_idreporte = $id")) {       // Selecciona todos lo registros de la tabla Recargos
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof() and !$tm->IsEmpty()) {
                    $i = ($tm->GetCurrentRow()-1);
                    echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Recargos_Loc\",$i, $id);'>";
                    echo "  <INPUT ID=loidr_$i TYPE='HIDDEN' NAME='recargos_loc[$i][loidr]' VALUE=".$tm->Value('ca_oid').">";
                    echo "  <INPUT ID=lidrc_$i TYPE='HIDDEN' NAME='recargos_loc[$i][lidrc]' VALUE=".$tm->Value('ca_idrecargo').">";
                    echo "  <TD align=left><INPUT ID=lrecl_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY VALUE=\"".$tm->Value('ca_recargo')."\">&nbsp;</TD>";
                    echo "  <TD align=left WIDTH=80><INPUT ID=lapli_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lapli]' VALUE=\"".$tm->Value('ca_aplicacion')."\"></TD>";
                    echo "  <TD align=center WIDTH=10><INPUT ID=ltipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][ltipo]' VALUE=\"".$tm->Value('ca_tipo')."\"></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=lctar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lctar]' VALUE=".$tm->Value('ca_cobrar_tar')."></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=lcmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lcmin]' VALUE=".$tm->Value('ca_cobrar_min')."></TD>";
                    echo "  <TD align=right WIDTH=25><INPUT ID=lidmn_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lidmn]' VALUE=\"".$tm->Value('ca_idmoneda')."\"></TD>";
                    echo "  <INPUT ID=lidco_$i TYPE='HIDDEN' NAME='recargos_loc[$i][lidco]' VALUE=".$tm->Value('ca_idconcepto').">";
                    echo "  <INPUT ID=ldets_$i TYPE='HIDDEN' NAME='recargos_loc[$i][ldets]' VALUE=\"".$tm->Value('ca_detalles')."\">";
                    echo "</TR>";
                    $tm->MoveNext();
                }
                for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+4); $i++ ) {
                    echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Recargos_Loc\",$i, $id);'>";
                    echo "  <INPUT ID=loidr_$i TYPE='HIDDEN' NAME='recargos_loc[$i][loidr]'>";
                    echo "  <INPUT ID=lidrc_$i TYPE='HIDDEN' NAME='recargos_loc[$i][lidrc]'>";
                    echo "  <TD align=left><INPUT ID=lrecl_$i Class=field style='text-align:left; font-weight:bold;' TYPE='TEXT' READONLY>&nbsp;</TD>";
                    echo "  <TD align=left WIDTH=80><INPUT ID=lapli_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lapli]'></TD>";
                    echo "  <TD align=center WIDTH=10><INPUT ID=ltipo_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][ltipo]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=lctar_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lctar]'></TD>";
                    echo "  <TD align=right WIDTH=50><INPUT ID=lcmin_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lcmin]'></TD>";
                    echo "  <TD align=right WIDTH=25><INPUT ID=lidmn_$i Class=field TYPE='TEXT' READONLY NAME='recargos_loc[$i][lidmn]'></TD>";
                    echo "  <INPUT ID=lidco_$i TYPE='HIDDEN' NAME='recargos_loc[$i][lidco]'>";
                    echo "  <INPUT ID=ldets_$i TYPE='HIDDEN' NAME='recargos_loc[$i][ldets]'>";
                    echo "</TR>";
                }
                echo "    </TABLE></CENTER></TD>";
                echo "</TR>";

                if ($rs->Value('ca_colmas')== "Sí") {
                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=5><CENTER><TABLE WIDTH=100% CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=invertir COLSPAN=7 style='text-align:center; font-weight:bold;'>CONCEPTOS DE COBRO EN AGENCIAMIENTO COLMAS SIA LTDA.</TD>";
                    echo "  </TR>";

                    echo "<TH>Concepto</TH>";
                    echo "<TH>Tipo</TH>";
                    echo "<TH>Neto</TH>";
                    echo "<TH>Valor</TH>";
                    echo "<TH>Mínimo</TH>";
                    echo "<TH>Mnd</TH>";
                    echo "<TH WIDTH=200>Detalles</TH>";
                    if (!$tm->Open("select r.oid as ca_oid, r.*, c.ca_costo from tb_repaduanadet r, tb_costos c where r.ca_idcosto = c.ca_idcosto and ca_idreporte = $id and ca_idrepaduana = $rp")) {       // Selecciona todos lo registros de la tabla Costos
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit; }
                    $i = 0;
                    $tm->MoveFirst();
                    while (!$tm->Eof() and !$tm->IsEmpty()) {
                        echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Aduana\",$i, $id);'>";
                        echo "  <INPUT ID=aoids_$i TYPE='HIDDEN' NAME='aduanas[$i][aoids]' VALUE=".$tm->Value('ca_oid').">";
                        echo "  <INPUT ID=aidco_$i TYPE='HIDDEN' NAME='aduanas[$i][aidco]' VALUE=".$tm->Value('ca_idcosto').">";
                        echo "  <INPUT ID=adelt_$i TYPE='HIDDEN' NAME='aduanas[$i][adelt]' VALUE=0>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=acsto_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][acsto]' VALUE='".$tm->Value('ca_costo')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=atipo_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][atipo]' VALUE='".$tm->Value('ca_tipo')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrn_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrn]' VALUE='".$tm->Value('ca_netcosto')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrc_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrc]' VALUE='".$tm->Value('ca_vlrcosto')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrm_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrm]' VALUE='".$tm->Value('ca_mincosto')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=amnda_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][amnda]' VALUE='".$tm->Value('ca_idmoneda')."'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=aobsv_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][aobsv]' VALUE='".$tm->Value('ca_detalles')."'></TD>";
                        echo "</TR>";
                        $tm->MoveNext();
                        $i++;
                    }
                    for ( $i=$tm->GetRowCount(); $i<($tm->GetRowCount()+5); $i++ ) {
                        echo "<TR style='background:\"F0F0F0\"' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\"  onclick='javascript:capturas(\"Aduana\",$i, $id);'>";
                        echo "  <INPUT ID=aoids_$i TYPE='HIDDEN' NAME='aduanas[$i][aoids]'>";
                        echo "  <INPUT ID=aidco_$i TYPE='HIDDEN' NAME='aduanas[$i][aidco]'>";
                        echo "  <INPUT ID=adelt_$i TYPE='HIDDEN' NAME='aduanas[$i][adelt]' VALUE=0>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=acsto_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][acsto]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=atipo_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][atipo]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrn_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrn]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrc_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrc]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=avlrm_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][avlrm]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=amnda_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][amnda]'></TD>";
                        echo "  <TD style='vertical-align=top; text-align: left'><INPUT ID=aobsv_$i Class=field TYPE='TEXT' READONLY NAME='aduanas[$i][aobsv]'></TD>";
                        echo "</TR>";
                    }
                    echo "  </TABLE></CENTER></TD>";
                    echo "</TR>";
                }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";

                echo "</TABLE>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Liquidación'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Ver Cotización' ONCLICK='window.open(\"cotizacion.php?id=".$rs->Value('ca_idcotizacion')."\",\"Cotizacion\",\"scrollbars=yes,width=800,height=600,top=200,left=150\")'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"reportenegocio.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operación
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
    }
}
elseif (isset($accion)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    if ($accion == 'Guardar Modificación' or $accion == 'Nueva Versión' or $accion == 'Guardar' or $accion == 'Borrador' or $accion == 'Reporte Nuevo') {
        $idconcliente = (strlen($idconcliente)==0)?0:$idconcliente;
        $contactos = (isset($contactos))?str_replace(" ","",implode(",",array_filter($contactos, "vacios"))):"";           // Retira las posiciones en blanco del arreglo
        if (isset($actualizar_pref)) {
            $comando = "update tb_clientes set ca_preferencias = '$preferencias_clie', ";
            $comando.= "ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' ";
            $comando.= "where ca_idcliente in (select ca_idcliente from tb_concliente where ca_idcontacto = $idconcliente)";
            if (!$rs->Open($comando)) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                exit;
            }
        }
        if (!$rs->Open("select fun_confirmarcli($idconcliente, '$contactos', '$usuario')")) {
            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
            echo "<script>document.location.href = 'reportenegocio.php';</script>";
            exit;
        }
        $idconsignatario = (strlen($idconsignatario)==0)?0:$idconsignatario;
        $informar_cons = (strlen($idconsignatario)==0)?"No":$informar_cons;
        $idnotify = (strlen($idnotify)==0)?0:$idnotify;
        $informar_noti = (strlen($idnotify)==0)?"No":$informar_noti;
        $idrepresentante = (strlen($idrepresentante)==0)?0:$idrepresentante;
        $informar_repr = (strlen($idrepresentante)==0)?"No":$informar_repr;
        $idmaster = (strlen($idmaster)==0)?0:$idmaster;
        $informar_mast = (strlen($idmaster)==0)?"No":$informar_mast;
        $idproveedor = (isset($idproveedor))?implode("|",array_filter($idproveedor, "vacios")):"";       // Retira las posiciones en blanco del arreglo
        $orden_prov = (isset($orden_prov))?implode("|",array_filter($orden_prov, "vacios")):"";         // Retira las posiciones en blanco del arreglo
        $incoterms = (isset($incoterms))?implode("|",array_filter($incoterms, "vacios")):"";         // Retira las posiciones en blanco del arreglo
        $confirmar = (isset($confirmar))?str_replace(" ","",implode(",",array_filter($confirmar, "vacios"))):""; // Retira las posiciones en blanco del arreglo
        $continuacion_conf = (isset($econt))?implode(",",array_filter($econt, "vacios")):"";           // Retira las posiciones en blanco del arreglo
    }else if ($accion == 'Crear Reporte AG') {
            $idconcliente = (strlen($idconcliente)==0)?0:$idconcliente;
            $contactos = (isset($contactos))?str_replace(" ","",implode(",",array_filter($contactos, "vacios"))):"";           // Retira las posiciones en blanco del arreglo
            if (!$rs->Open("select fun_confirmarcli($idconcliente, '$contactos', '$usuario')")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                exit;
            }
            $idconsignatario = (strlen($idconsignatario)==0)?0:$idconsignatario;
            $informar_cons = (strlen($idconsignatario)==0)?"No":$informar_cons;
            $idnotify = (strlen($idnotify)==0)?0:$idnotify;
            $informar_noti = (strlen($idnotify)==0)?"No":$informar_noti;
            $idrepresentante = (strlen($idrepresentante)==0)?0:$idrepresentante;
            $informar_repr = (strlen($idrepresentante)==0)?"No":$informar_repr;
            $idmaster = (strlen($idmaster)==0)?0:$idmaster;
            $informar_mast = (strlen($idmaster)==0)?"No":$informar_mast;
            $idproveedor = (isset($idproveedor))?implode("|",array_filter($idproveedor, "vacios")):"";       // Retira las posiciones en blanco del arreglo
            $orden_prov = (isset($orden_prov))?implode("|",array_filter($orden_prov, "vacios")):"";         // Retira las posiciones en blanco del arreglo
            $incoterms = (isset($incoterms))?implode("|",array_filter($incoterms, "vacios")):"";         // Retira las posiciones en blanco del arreglo
            $confirmar = (isset($confirmar))?str_replace(" ","",implode(",",array_filter($confirmar, "vacios"))):""; // Retira las posiciones en blanco del arreglo
            $modalidad = (isset($modalidad))?$modalidad:"";
            $repnotify = (isset($repnotify))?$repnotify:0;
        }
    if (isset($mcia_peligrosa) and $mcia_peligrosa == "on") {
        $mcia_peligrosa = "TRUE";
    }else {
        $mcia_peligrosa = "FALSE";
    }
    switch(trim($accion)) {                                                     // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Guardar Modificación': {                                          // El Botón Guardar fue pulsado
                if (!$rs->Open("update tb_reportes set ca_idcotizacion = $idcotizacion, ca_origen = '$idciuorigen', ca_destino = '$idciudestino', ca_impoexpo = '$impoexpo', ca_fchdespacho = '$fchdespacho', ca_idagente =  $idagente, ca_incoterms = '$incoterms', ca_mercancia_desc = '".AddSlashes($mercancia_desc)."', ca_mcia_peligrosa = '$mcia_peligrosa', ca_idproveedor = '$idproveedor', ca_orden_prov = '$orden_prov', ca_idconcliente = $idconcliente, ca_orden_clie = '$orden_clie', ca_confirmar_clie = '$confirmar', ca_idconsignatario = $idconsignatario, ca_informar_cons = '$informar_cons', ca_idnotify = $idnotify, ca_informar_noti = '$informar_noti', ca_idmaster = $idmaster, ca_informar_mast = '$informar_mast', ca_notify = $repnotify, ca_idrepresentante = $idrepresentante, ca_informar_repr = '$informar_repr', ca_transporte = '$transporte', ca_modalidad = '$modalidad', ca_colmas = '$colmas', ca_seguro = '$seguro', ca_liberacion = '$liberacion', ca_tiempocredito = '$tiempocredito', ca_preferencias_clie = '".addslashes($preferencias_clie)."', ca_instrucciones = '".addslashes($instrucciones)."', ca_idlinea = $idlinea, ca_idconsignar = $idconsignar, ca_idbodega = $idbodega, ca_mastersame = '$mastersame', ca_continuacion = '$continuacion', ca_continuacion_dest = '$continuacion_dest', ca_continuacion_conf = ".($continuacion_conf?"'$continuacion_conf'":"null").", ca_login = '$login', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idreporte = $id")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (isset($nw)) {
                    if (!$rs->Open("delete from tb_reptarifas where ca_idreporte = $id")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("delete from tb_repgastos where ca_idreporte = $id")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("delete from tb_repseguro where ca_idreporte = $id")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_reptarifas select $id, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario' from tb_reptarifas where ca_idreporte = $nw")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_detalles, ca_idconcepto, ca_recargoorigen) select $id, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_detalles, ca_idconcepto, ca_recargoorigen from tb_repgastos where ca_idreporte = $nw")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_repseguro select $id, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaventa, ca_minimaventa, ca_idmoneda_vta, ca_obtencionpoliza, ca_idmoneda_pol, ca_seguro_conf from tb_repseguro where ca_idreporte = $nw")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if ($colmas == 'Sí') {
                        if (!$rs->Open("select nextval('tb_repaduana_id')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'comisiones.php';</script>";
                            exit;
                        }
                        $id_adu = $rs->Value('nextval');
                        if (!$rs->Open("insert into tb_repaduana select $id, $id_adu, ca_coordinador, ca_transnacarga, ca_transnatipo, ca_instrucciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss') as ca_fchcreado, '$usuario' as ca_usucreado from tb_repaduana where ca_idreporte = $nw")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                        if (!$rs->Open("insert into tb_repaduanadet select $id, $id_adu, ca_idcosto, ca_tipo, ca_vlrcosto, ca_mincosto, ca_netcosto, ca_idmoneda, ca_detalles, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss') as ca_fchcreado, '$usuario' as ca_usucreado from tb_repaduanadet where ca_idreporte = $nw")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Guardar Liquidación': {                                                      // El Botón Guardar fue pulsado
                $id = $idreporte;
                if (!$rs->Open("delete from tb_repseguro where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (isset($obtencionpoliza) and $obtencionpoliza != 0) {
                    $seguro_conf = (isset($esegu))?implode(",",array_filter($esegu, "vacios")):"";           // Retira las posiciones en blanco del arreglo
                    if (!$rs->Open("insert into tb_repseguro (ca_idreporte, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaventa, ca_minimaventa, ca_idmoneda_vta, ca_obtencionpoliza, ca_idmoneda_pol, ca_seguro_conf) values($idreporte, $vlrasegurado, '$idmoneda_vlr', '$primaventa', '$minimaventa', '$idmoneda_vta', '$obtencionpoliza', '$idmoneda_pol', '$seguro_conf')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }
                if (!$rs->Open("select ca_transporte from tb_reportes where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if ($rs->Value('ca_transporte') == 'Aéreo') {
                    while (list ($clave, $val) = each ($conceptos)) {
                        if ($val[foidt] == '' and $val[fidco] != 0) {
                            if (!$rs->Open("insert into tb_reptarifas (ca_idreporte, ca_idconcepto, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, ca_fchcreado, ca_usucreado) values($idreporte, $val[fidco], $val[frtar], $val[frmin], '$val[fridm]', $val[fctar], $val[fcmin], '$val[fcidm]', '$val[fobvs]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                exit; }
                        } else if ($val[foidt] != '' and $val[fidco] != 0) {
                                if (!$rs->Open("update tb_reptarifas set ca_idconcepto = $val[fidco], ca_reportar_tar = $val[frtar], ca_reportar_min = $val[frmin], ca_reportar_idm = '$val[fridm]', ca_cobrar_tar = $val[fctar], ca_cobrar_min = $val[fcmin], ca_cobrar_idm = '$val[fcidm]', ca_observaciones = '$val[fobvs]', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = $val[foidt]")) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                    exit; }
                            } else if ($val[foidt] != '' and $val[fidco] == 0) {
                                    if (!$rs->Open("delete from tb_reptarifas where oid = $val[foidt]")) {
                                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                        exit; }
                                }
                    }
                }else if ($rs->Value('ca_transporte') == 'Marítimo') {
                        while (list ($clave, $val) = each ($conceptos)) {
                            if ($val[foidt] == '' and $val[fidco] != 0) {
                                if (!$rs->Open("insert into tb_reptarifas (ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, ca_fchcreado, ca_usucreado) values($idreporte, $val[fidco], $val[fcant], $val[fntar], $val[fnmin], '$val[fnidm]', $val[frtar], $val[frmin], '$val[fridm]', $val[fctar], $val[fcmin], '$val[fcidm]', '$val[fobvs]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                    exit; }
                            } else if ($val[foidt] != '' and $val[fidco] != 0) {
                                    if (!$rs->Open("update tb_reptarifas set ca_idconcepto = $val[fidco], ca_cantidad = $val[fcant], ca_neta_tar = $val[fntar], ca_neta_min = $val[fnmin], ca_neta_idm = '$val[fnidm]', ca_reportar_tar = $val[frtar], ca_reportar_min = $val[frmin], ca_reportar_idm = '$val[fridm]', ca_cobrar_tar = $val[fctar], ca_cobrar_min = $val[fcmin], ca_cobrar_idm = '$val[fcidm]', ca_observaciones = '$val[fobvs]', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = $val[foidt]")) {
                                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                        exit; }
                                } else if ($val[foidt] != '' and $val[fidco] == 0) {
                                        if (!$rs->Open("delete from tb_reptarifas where oid = $val[foidt]")) {
                                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                            exit; }
                                    }
                        }
                    }
                while (list ($clave, $val) = each ($recargos_org)) {
                    if ($val[roidr] == '' and $val[ridrc] != 0) {
                        if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_idconcepto, ca_detalles, ca_fchcreado, ca_usucreado, ca_recargoorigen) values($idreporte, $val[ridrc], '$val[rapli]', '$val[rtipo]', $val[rntar], $val[rnmin], $val[rrtar], $val[rrmin], $val[rctar], $val[rcmin], '$val[ridmn]', $val[ridco], '".AddSlashes($val[rdets])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario', true)")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit; }
                    }else if ($val[roidr] != '' and $val[ridrc] != 0) {
                            if (!$rs->Open("update tb_repgastos set ca_idrecargo = $val[ridrc], ca_aplicacion = '$val[rapli]', ca_tipo = '$val[rtipo]', ca_neta_tar = $val[rntar], ca_neta_min = $val[rnmin], ca_reportar_tar = $val[rrtar], ca_reportar_min = $val[rrmin], ca_cobrar_tar = $val[rctar], ca_cobrar_min = $val[rcmin], ca_idmoneda = '$val[ridmn]', ca_idconcepto = $val[ridco], ca_detalles = '".AddSlashes($val[rdets])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[roidr])) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                exit; }
                        }else if ($val[roidr] != '' and $val[ridrc] == 0) {
                                if (!$rs->Open("delete from tb_repgastos where oid = ".$val[roidr])) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                    exit; }
                            }
                }
                while (list ($clave, $val) = each ($recargos_loc)) {
                    if ($val[loidr] == '' and $val[lidrc] != 0) {
                        if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_idconcepto, ca_detalles, ca_fchcreado, ca_usucreado, ca_recargoorigen) values($idreporte, $val[lidrc], '$val[lapli]', '$val[ltipo]', 0, 0, 0, 0, $val[lctar], $val[lcmin], '$val[lidmn]', $val[lidco], '".AddSlashes($val[ldets])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario', false)")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit; }
                    }else if ($val[loidr] != '' and $val[lidrc] != 0) {
                            if (!$rs->Open("update tb_repgastos set ca_idrecargo = $val[lidrc], ca_aplicacion = '$val[lapli]', ca_tipo = '$val[ltipo]', ca_neta_tar = 0, ca_neta_min = 0, ca_reportar_tar = 0, ca_reportar_min = 0, ca_cobrar_tar = $val[lctar], ca_cobrar_min = $val[lcmin], ca_idmoneda = '$val[lidmn]', ca_idconcepto = $val[lidco], ca_detalles = '".AddSlashes($val[ldets])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[loidr])) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                exit; }
                        }else if ($val[loidr] != '' and $val[lidrc] == 0) {
                                if (!$rs->Open("delete from tb_repgastos where oid = ".$val[loidr])) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                    exit; }
                            }
                }

                if ($idrepaduana == 0 and strlen($coordinador) != 0) {
                    if (!$rs->Open("insert into tb_repaduana (ca_idreporte, ca_coordinador, ca_transnacarga, ca_transnatipo, ca_instrucciones, ca_fchcreado, ca_usucreado) values($idreporte, '$coordinador', '$transnacarga', '$transnatipo', '$instrucciones', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("select ca_idrepaduana from tb_repaduana where ca_idreporte = $idreporte")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    $idrepaduana = $rs->Value('ca_idrepaduana');
                }else if ($idrepaduana != 0 and strlen($coordinador) != 0) {
                        if (!$rs->Open("update tb_repaduana set ca_coordinador = '$coordinador', ca_transnacarga = '$transnacarga', ca_transnatipo = '$transnatipo', ca_instrucciones = '$instrucciones', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idreporte = $idreporte and ca_idrepaduana = $idrepaduana")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                    }
                if (isset($aduanas)) {
                    while (list ($clave, $val) = each ($aduanas)) {
                        if ($val[aoids] != 0 and $val[adelt] == 0) {
                            if (!$rs->Open("update tb_repaduanadet set ca_idcosto = '$val[aidco]', ca_tipo = '$val[atipo]', ca_netcosto = '$val[avlrn]', ca_vlrcosto = '$val[avlrc]', ca_mincosto = '$val[avlrm]', ca_idmoneda = '$val[amnda]', ca_detalles = '".AddSlashes($val[aobsv])."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[aoids])) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                exit;
                            }
                        }else if ($val[adelt] != 0) {
                                if (!$rs->Open("delete from tb_repaduanadet where oid = ".$val[adelt])) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                    exit;
                                }
                            }else if (strlen($val[aidco]) == 0) {
                                    continue;
                                }else {
                                    if (!$rs->Open("insert into tb_repaduanadet (ca_idreporte, ca_idrepaduana, ca_idcosto, ca_tipo, ca_netcosto, ca_vlrcosto, ca_mincosto, ca_idmoneda, ca_detalles, ca_fchcreado, ca_usucreado) values ($idreporte, $idrepaduana, '$val[aidco]', '$val[atipo]', '$val[avlrn]', '$val[avlrc]', '$val[avlrm]', '$val[amnda]', '".AddSlashes($val[aobsv])."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                                        exit;
                                    }
                                }
                    }
                }
                if (!$rs->Open("update tb_reportes set ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuactualizado = '$usuario' where ca_idreporte = $idreporte")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                break;
            }
        case 'Borrador': {                                                          // El Botón Guardar Borrador fue pulsado
                if (!$rs->Open("insert into tb_repborrador (ca_fchcreado, ca_accion, ca_usucreado, ca_contenido) values(to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$accion', '$usuario', '".serialize($HTTP_POST_VARS)."')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                break;
            }
        case 'Cerrar': {                                                          // El Botón Guardar Borrador fue pulsado
                if (!$rs->Open("update tb_reportes set ca_fchcerrado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usucerrado = '$usuario' where ca_idreporte = $id")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                break;
            }
        case 'Abrir': {                                                          // El Botón Guardar Borrador fue pulsado
                if (!$rs->Open("update tb_reportes set ca_fchcerrado = null, ca_usucerrado = null where ca_idreporte = $id")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                break;
            }
        case 'Anular': {                                                          // El Botón Guardar Borrador fue pulsado
                if (!$rs->Open("update tb_reportes set ca_fchanulado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuanulado = '$usuario', ca_detanulado = '$det' where ca_idreporte = $id")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                unset($id);
                break;
            }
        case 'Crear Reporte AG': {                                   // El Botón Reporte AG fue pulsado
             /*$uploaddir  = '';*/
                $uploadfile = /*$uploaddir.*/ basename($_FILES['attachment']['name']);
             /*$hiddenPath = '';*/

                if (strlen($uploadfile) != 0) {
                // VARIABLES
                    $file = str_replace('%20', ' ', $attachment);
                    // $file_real = $hiddenPath . $category . $file;
                    $file_real = $_FILES['attachment']['tmp_name'];


                    // echo $_FILES['attachment']['name'];

                    // HACK ATTEMPT CHECK
                    // Make sure the request isn't escaping to another directory
                 /*
                 if (substr($file, 0, 1) == '.' || strpos($file, '..') > 0 || substr($file, 0, 1) == '/' || strpos($file, '/') > 0){
                         // Display hack attempt error
                         echo("Hack attempt detected!");
                         die();
                 }
                 */
                    // If requested file exists
                    if (file_exists($file_real)) {
                    // Get extension of requested file
                        $extension = strtolower(substr(strrchr($uploadfile, "."), 1));
                        // Fix IE bug [0]
                        $header_file = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1) : $file;
                        // Read file to attach
                        $stream = fopen($file_real, 'rb');
                        $content = fread($stream, filesize($file_real));
                        $content_escaped = pg_escape_bytea($content);
                        fclose($stream);
                    }else {
                    // Requested file does not exist (File not found)
                        echo("Requested file does not exist");
                        die();
                    }
                }

                if (!$rs->Open("select nextval('tb_reportes_id')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'comisiones.php';</script>";
                    exit;
                }
                $id = $rs->Value('nextval');

                if( !$login ) {
                    if (!$rs->Open("select ca_vendedor from tb_clientes inner join tb_concliente on tb_clientes.ca_idcliente=tb_concliente.ca_idcliente where tb_concliente.ca_idcontacto=$idconcliente")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'comisiones.php';</script>";
                        exit;
                    }
                    $login = $rs->Value('ca_vendedor');
                }
                if (!$rs->Open("insert into tb_reportes (ca_idreporte, ca_fchreporte, ca_consecutivo, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_mcia_peligrosa, ca_idproveedor, ca_orden_prov, ca_idconcliente, ca_orden_clie, ca_confirmar_clie, ca_idconsignatario, ca_informar_cons, ca_idnotify, ca_informar_noti, ca_idmaster, ca_informar_mast, ca_notify, ca_idrepresentante, ca_informar_repr, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_login, ca_fchcreado, ca_usucreado) values($id, '$fchreporte', fun_reportecon('".substr($fchreporte,0,4)."'), 0, '$idciuorigen', '$idciudestino', '$impoexpo', '$fchdespacho', $idagente, '$incoterms', '".addslashes($mercancia_desc)."', '$mcia_peligrosa', '$idproveedor', '$orden_prov', $idconcliente, '$orden_clie', '$confirmar', $idconsignatario, '$informar_cons', $idnotify, '$informar_noti', $idmaster, '$informar_mast', $repnotify, $idrepresentante, '$informar_repr', '$transporte', '$modalidad', '', '', '', '', '', '', 0, 1, 1, 'No', 'N/A', '$idciudestino', '', '$login', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (!$rs->Open("select ca_idreporte, ca_consecutivo, ca_agente, ca_traorigen, ca_ciuorigen, ca_ciudestino, ca_nombre_pro, ca_orden_prov, ca_nombre_cli, ca_orden_clie, ca_idconsignatario, ca_nombre_con, ca_informar_cons, ca_idnotify, ca_nombre_not, ca_informar_noti, ca_idmaster, ca_nombre_mas, ca_informar_mast, ca_idrepresentante, ca_nombre_rep, ca_informar_repr, ca_mercancia_desc, ca_mcia_peligrosa from vi_reportes where ca_idreporte = $id")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $asunto.= " No. ".$rs->Value('ca_consecutivo');
                $contenido ="<TABLE WIDTH=600 CELLSPACING=1 BORDER=1>\n";
                $contenido.="<TR>\n";
                $contenido.="  <TD COLSPAN=4><CENTER><B>REPORTE AG No. ".$rs->Value('ca_consecutivo')."</B></CENTER></TD>\n";
                $contenido.="</TR>\n";

                $contenido.="<TR>\n";
                $contenido.="  <TD COLSPAN=4><B>".$rs->Value('ca_agente')."</B></TD>\n";
                $contenido.="</TR>\n";

                $contenido.="<TR>\n";
                $contenido.="  <TD><B>Trayecto :</B></TD>\n";
                $contenido.="  <TD>«".$rs->Value('ca_traorigen')."» ".$rs->Value('ca_ciuorigen')."</TD>\n";
                $contenido.="  <TD><CENTER>-><CENTER></TD>\n";
                $contenido.="  <TD>".$rs->Value('ca_ciudestino')."</TD>\n";
                $contenido.="</TR>\n";

                $contenido.="<TR>\n";
                $contenido.="  <TD><B>Proveedor :</B></TD>\n";
                $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_pro')." Orden No. ".$rs->Value('ca_orden_prov')."</TD>\n";
                $contenido.="</TR>\n";

                $contenido.="<TR>\n";
                $contenido.="  <TD><B>Cliente :</B></TD>\n";
                $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_cli')." Orden No. ".$rs->Value('ca_orden_clie')."</TD>\n";
                $contenido.="</TR>\n";

                if($rs->Value('ca_idconsignatario') != 0) {
                    $contenido.="<TR>\n";
                    $contenido.="  <TD><B>Cliente :</B></TD>\n";
                    $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_con')." Enviar Información: ".$rs->Value('ca_informar_cons')."</TD>\n";
                    $contenido.="</TR>\n";
                }
                if($rs->Value('ca_idnotify') != 0) {
                    $contenido.="<TR>\n";
                    $contenido.="  <TD><B>Cliente :</B></TD>\n";
                    $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_not')." Enviar Información: ".$rs->Value('ca_informar_noti')."</TD>\n";
                    $contenido.="</TR>\n";
                }
                if($rs->Value('ca_idmaster') != 0) {
                    $contenido.="<TR>\n";
                    $contenido.="  <TD><B>Cliente :</B></TD>\n";
                    $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_mas')." Enviar Información: ".$rs->Value('ca_informar_mast')."</TD>\n";
                    $contenido.="</TR>\n";
                }
                if($rs->Value('ca_idrepresentante') != 0) {
                    $contenido.="<TR>\n";
                    $contenido.="  <TD><B>Cliente :</B></TD>\n";
                    $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre_rep')." Enviar Información: ".$rs->Value('ca_informar_repr')."</TD>\n";
                    $contenido.="</TR>\n";
                }

                $contenido.="<TR>\n";
                $contenido.="  <TD><B>Mercancia :</B></TD>\n";
                $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_mercancia_desc')."<BR><BR>&laquo;".(($rs->value("ca_mcia_peligrosa")=='t')?"SÍ":"NO")." es Mercancía Peligrosa&raquo;</TD>\n";
                $contenido.="</TR>\n";
                $contenido.="</TABLE>\n";

                if (!$rs->Open("select u1.ca_nombre, u1.ca_email, u2.ca_email as ca_destino from control.tb_usuarios u1 LEFT OUTER JOIN control.tb_usuarios u2 ON (u2.ca_login = '$login') where u1.ca_login = '$usuario'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $remitente = $rs->Value('ca_nombre');
                $recorreo = $rs->Value('ca_email');
                $address = $rs->Value('ca_destino');
                $contenido.="<BR>".nl2br($mensaje)."<BR><BR>".$remitente."<BR>".$rs->Value('ca_email');
                $contenido = AddSlashes($contenido);

                if (isset($confirmar)) {
                    $cn = explode(",",$confirmar);
                    $cc = $recorreo.",";
                    while (list ($clave, $val) = each ($cn)) {
                        if (stripos(strtolower($val), '@coltrans.com.co') !== false) {
                            $cc.= $val.",";
                        }
                    }
                    if ( strlen($cc) != 0) {
                        $cc = substr($cc,0,strlen($c)-1);
                    }
                }

                if (!$rs->Open("select nextval('tb_emails_id')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                $id_email = $rs->Value('nextval');
                if (!$rs->Open("insert into tb_emails (ca_idemail, ca_fchenvio, ca_usuenvio, ca_tipo, ca_idcaso, ca_from, ca_fromname, ca_cc, ca_replyto, ca_address, ca_attachment, ca_subject, ca_bodyhtml) values($id_email, NULL, '$usuario', 'Reporte Negocios AG', '$id', '$recorreo', '$remitente', '$cc', '$recorreo', '$address', '', '$asunto', '$contenido')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit;
                }
                if (strlen($uploadfile) != 0) {
                    if (!$rs->Open("insert into tb_attachments (ca_idemail, ca_extension, ca_header_file, ca_filesize, ca_content) values('$id_email', '$extension', '$uploadfile', '".filesize($file_real)."', '$content_escaped')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }
                // enviar_email($rs, $id_email, $_FILES);                                           // Llamado a la función que envia los emails
                break;
            }
        case 'Guardar' or 'Reporte Nuevo' or 'Nueva Versión': {                                   // El Botón Guardar fue pulsado
                $id_old = $id;
                $fchreporte = ($accion =='Reporte Nuevo')?date("Y-m-d"):$fchreporte;
                $fchdespacho = ($accion =='Reporte Nuevo')?date("Y-m-d"):$fchdespacho;

                if (!$rs->Open("select nextval('tb_reportes_id')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'comisiones.php';</script>";
                    exit;
                }
                $id = $rs->Value('nextval');
                if ($accion !='Nueva Versión') {
                    if (!$rs->Open("insert into tb_reportes (ca_idreporte, ca_fchreporte, ca_consecutivo, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_mcia_peligrosa, ca_idproveedor, ca_orden_prov, ca_idconcliente, ca_orden_clie, ca_confirmar_clie, ca_idconsignatario, ca_informar_cons, ca_idnotify, ca_informar_noti, ca_idmaster, ca_informar_mast, ca_notify, ca_idrepresentante, ca_informar_repr, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_login, ca_fchcreado, ca_usucreado) values($id, '$fchreporte', fun_reportecon('".substr($fchreporte,0,4)."'), $idcotizacion, '$idciuorigen', '$idciudestino', '$impoexpo', '$fchdespacho', $idagente, '$incoterms', '".addslashes($mercancia_desc)."', '$mcia_peligrosa', '$idproveedor', '$orden_prov', $idconcliente, '$orden_clie', '$confirmar', $idconsignatario, '$informar_cons', $idnotify, '$informar_noti', $idmaster, '$informar_mast', $repnotify, $idrepresentante, '$informar_repr', '$transporte', '$modalidad', '$colmas', '$seguro', '$liberacion', '$tiempocredito', '".addslashes($preferencias_clie)."', '".addslashes($instrucciones)."', $idlinea, $idconsignar, $idbodega, '$mastersame', '$continuacion', '$continuacion_dest', ".($continuacion_conf?"'$continuacion_conf'":"null").", '$login', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario' )")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }else {
                    if (!$rs->Open("insert into tb_reportes (ca_idreporte, ca_fchreporte, ca_consecutivo, ca_version, ca_idcotizacion, ca_origen, ca_destino, ca_impoexpo, ca_fchdespacho, ca_idagente, ca_incoterms, ca_mercancia_desc, ca_mcia_peligrosa, ca_idproveedor, ca_orden_prov, ca_idconcliente, ca_orden_clie, ca_confirmar_clie, ca_idconsignatario, ca_informar_cons, ca_idnotify, ca_informar_noti, ca_idmaster, ca_informar_mast, ca_notify, ca_idrepresentante, ca_informar_repr, ca_transporte, ca_modalidad, ca_colmas, ca_seguro, ca_liberacion, ca_tiempocredito, ca_preferencias_clie, ca_instrucciones, ca_idlinea, ca_idconsignar, ca_idbodega, ca_mastersame, ca_continuacion, ca_continuacion_dest, ca_continuacion_conf, ca_idetapa,ca_fchultstatus, ca_propiedades, ca_idseguimiento,  ca_login, ca_fchcreado, ca_usucreado) values($id, '$fchreporte', '$consecutivo', fun_reportever('$consecutivo'), $idcotizacion, '$idciuorigen', '$idciudestino', '$impoexpo', '$fchdespacho', $idagente, '$incoterms', '".addslashes($mercancia_desc)."', '$mcia_peligrosa','$idproveedor', '$orden_prov', $idconcliente, '$orden_clie', '$confirmar', $idconsignatario, '$informar_cons', $idnotify, '$informar_noti', $idmaster, '$informar_mast', $repnotify, $idrepresentante, '$informar_repr', '$transporte', '$modalidad', '$colmas', '$seguro', '$liberacion', '$tiempocredito', '".addslashes($preferencias_clie)."', '".addslashes($instrucciones)."', $idlinea, $idconsignar, $idbodega, '$mastersame', '$continuacion', '$continuacion_dest', ".($continuacion_conf?"'$continuacion_conf'":"null").", ".($idetapa?"'$idetapa'":"null").", ".($fchultstatus?"'$fchultstatus'":"null").",'$propiedades', ".($idseguimiento?"'$idseguimiento'":"null").",  '$login', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }
             /*
             * Actualiza el valor idreporte en tb_inolientes_sea
             */
                if ( $accion =='Nueva Versión') {
                    if (!$rs->Open("update tb_inoclientes_sea set ca_idreporte = $id  where ca_idreporte = $id_old")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                }

                if ($accion =='Reporte Nuevo' or $accion =='Nueva Versión') {
                    if (!$rs->Open("insert into tb_reptarifas (ca_idreporte, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, ca_fchcreado, ca_usucreado)  select $id, ca_idconcepto, ca_cantidad, ca_neta_tar, ca_neta_min, ca_neta_idm, ca_reportar_tar, ca_reportar_min, ca_reportar_idm, ca_cobrar_tar, ca_cobrar_min, ca_cobrar_idm, ca_observaciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario' from tb_reptarifas where ca_idreporte = $id_old")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_repgastos (ca_idreporte, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_idconcepto, ca_detalles, ca_recargoorigen) select $id, ca_idrecargo, ca_aplicacion, ca_tipo, ca_neta_tar, ca_neta_min, ca_reportar_tar, ca_reportar_min, ca_cobrar_tar, ca_cobrar_min, ca_idmoneda, ca_idconcepto, ca_detalles, ca_recargoorigen from tb_repgastos where ca_idreporte = $id_old")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_repseguro (ca_idreporte, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaventa, ca_minimaventa, ca_idmoneda_vta, ca_obtencionpoliza, ca_idmoneda_pol, ca_seguro_conf) select $id, ca_vlrasegurado, ca_idmoneda_vlr, ca_primaventa, ca_minimaventa, ca_idmoneda_vta, ca_obtencionpoliza, ca_idmoneda_pol, ca_seguro_conf from tb_repseguro where ca_idreporte = $id_old")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("insert into tb_repaduana (ca_idreporte, ca_coordinador, ca_transnacarga, ca_transnatipo, ca_instrucciones, ca_fchcreado, ca_usucreado) select $id, ca_coordinador, ca_transnacarga, ca_transnatipo, ca_instrucciones, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario' from tb_repaduana where ca_idreporte = $id_old")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("select ca_idrepaduana from tb_repaduana where ca_idreporte = $id")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'reportenegocio.php';</script>";
                        exit;
                    }
                    if (!$rs->Eof() and !$rs->IsEmpty()) {
                        $idrepaduana = $rs->Value('ca_idrepaduana');
                        if (!$rs->Open("insert into tb_repaduanadet (ca_idreporte, ca_idrepaduana, ca_idcosto, ca_tipo, ca_netcosto, ca_vlrcosto, ca_mincosto, ca_idmoneda, ca_detalles, ca_fchcreado, ca_usucreado) select $id, $idrepaduana, ca_idcosto, ca_tipo, ca_netcosto, ca_vlrcosto, ca_mincosto, ca_idmoneda, ca_detalles, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), '$usuario' from tb_repaduanadet where ca_idreporte = $id_old")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'reportenegocio.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
    }
    if (isset($status) and $status != 'false') {
        if (!$rs->Open("select ca_consecutivo from tb_reportes where ca_idreporte = $id")) {
            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
            echo "<script>document.location.href = 'reportenegocio.php';</script>";
            exit;
        }
        $consecutivo = $rs->Value('ca_consecutivo');
        /*echo "<script>document.location.href = '../colsys_sf/index.php/traficos/verEstatusCarga/modo/impo/ver/reporte/numreporte/$consecutivo';</script>";  // Retorna a la pantalla principal de la opción
		*/

        echo "<script>document.location.href = '/traficos/listaStatus/modo/maritimo?reporte=$consecutivo';</script>";  // Retorna a la pantalla principal de la opción

    }else if (isset($id)) {
            echo "<script>document.location.href = 'reportenegocio.php?boton=Consultar\&id=$id';</script>";  // Retorna a la pantalla principal de la opción
        }else {
            echo "<script>document.location.href = 'reportenegocio.php';</script>";  // Retorna a la pantalla principal de la opción
        }
}


function enviar_email(&$rs, $id, &$attachment) {
    global $smtpHost, $smtpUser, $smtpPasswd;
    if (!$rs->Open("select * from vi_emails where ca_idemail = $id")) {
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
        echo "<script>document.location.href = reportenegocio.php';</script>";
        exit;
    }
    require("include/class.phpmailer.php");
    $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
    $domin = chr(100-36)."coltrans.com.co";
    $name  = $smtpUser.$domin;
    $pass  = $smtpPasswd;
    $mail = new PHPMailer();
    $mail->IsSMTP();              // set mailer to use SMTP
    $mail->Host = $smtpHost;   // specify main and backup server
    if( $smtpUser ) {
        $mail->SMTPAuth = true;       // turn on SMTP authentication
    }

    $mail->From = $rs->Value('ca_from');
    $mail->FromName = $rs->Value('ca_fromname');
    $mail->AddCC($rs->Value('ca_from'), $rs->Value('ca_fromname'));
    $mail->AddReplyTo($rs->Value('ca_from'), $rs->Value('ca_fromname'));

    $mail->Username = $name ;
    $mail->Password = $pass;

    $mail->WordWrap = 50;
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $rs->Value('ca_subject');
    $mail->Body    = $rs->Value('ca_body');
    $mail->AltBody = "«« Este mensaje está en formato HTML pero el equipo no está configurado para mostrarlo automáticamente. Active la opción HTML del menú Ver en su cliente de correo electrónico para una correcta visualización.>>";
    if (strlen($attachment) != 0) {
        $mail->AddAttachment(str_replace(chr(92),'/',$attachment['attachment']['tmp_name']), $attachment['attachment']['name']);
        $mail->AttachAll();
    }

    $mail->AddAddress($rs->Value('ca_from'), $rs->Value('ca_fromname'));
    $send_it = false;
    $mail->EmptyAddress();
    $address = explode(",",$rs->Value('ca_address'));
    while (list ($clave, $val) = each ($address)) {
        if ($val != '') {
            $send_it = true;
            $mail->AddAddress($val, $val);
        }
    }
    $address = explode(",",$rs->Value('ca_cc'));
    while (list ($clave, $val) = each ($address)) {
        if ($val != '') {
            $send_it = true;
            $mail->AddCC($val, $val);
        }
    }
    if ($send_it) {
        if(!$mail->Send()) {
            echo "<script>alert(\"".addslashes($mail->ErrorInfo)."\");</script>";  // Muestra el mensaje de error
            echo "<script>document.location.href = reportenegocio.php';</script>";
            exit;
        }else {
            echo "<script>alert('¡El mensaje ha sido enviado satisfactoriamente!');</script>";
        }
    }
    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();
    $mail->ClearAttachments();
}


function datos_basicos(&$visible,&$rs,&$tm) {
    echo "<INPUT TYPE='HIDDEN' NAME='idreporte' VALUE=\"".$rs->Value('ca_idreporte')."\">";             // Hereda el Id de la Referencia que se esta modificando
    echo "<INPUT TYPE='HIDDEN' NAME='consecutivo' VALUE=\"".$rs->Value('ca_consecutivo')."\">";             // Hereda el Id de la Referencia que se esta modificando
    echo "<TABLE WIDTH=600 CELLSPACING=1>";
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=2 ROWSPAN=2 style='font-weight:bold;'>REPORTE DE NEGOCIO</TH>";
    echo "  <TD Class=titulo style='text-align:center; font-weight:bold;'>Reporte No.:</TD>";
    echo "  <TD Class=titulo style='text-align:center; font-weight:bold;'>Versión No.:</TD>";
    echo "  <TD Class=titulo style='text-align:center; font-weight:bold;'>Cotización:</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar style='text-align:center; font-weight:bold;'>".$rs->Value('ca_consecutivo')."</TD>";
    echo "  <TD Class=mostrar style='text-align:center; font-weight:bold;'>".$rs->Value('ca_version')."/".$rs->Value('ca_versiones')."</TD>";
    echo "  <TD Class=mostrar style='text-align:center; font-weight:bold;'>".$rs->Value('ca_idcotizacion')."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TH Class=invertir COLSPAN=5 style='font-weight:bold;'>INFORMACION GENERAL</TH>";
    echo "<TR>";
    echo "  <TD Class=partir>1.&nbsp;Importación</TD>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>2. Origen</TD>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>3. Destino</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir style='font-size: 11px; text-align: center; font-weight:bold;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp;<BR>&nbsp;</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_ciuorigen')."</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_traorigen')."</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_ciudestino')."</TD>";
    echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_tradestino')."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=partir style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER>".$rs->Value('ca_fchdespacho')."</CENTER></TD>";
    echo "  <TD Class=mostrar COLSPAN=3><B>5. Agente: <a href='/ids/formEventos?idreporte=".$rs->Value('ca_idreporte')."'>Eventos</a></B><BR>".$rs->Value('ca_agente')."</TD>";
    echo "  <TD Class=listar ROWSPAN=2><TABLE CELLSPACING=1 WIDTH=100%>";
    echo "   <TR>";
    echo "  	<TD style='visibility: $visible;' Class=invertir style='text-align: right; vertical-align: bottom;' onclick='elegir(\"Editar\", \"".$rs->Value('ca_idreporte')."\");'>Editar Reporte:<br /><IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0></TD>";
    echo "   </TR>";
    if (strlen($rs->Value('ca_usucerrado')) != 0) {
        echo "   <TR>";
        echo "  	<TD style='visibility: $visible;' Class=invertir style='text-align: right; vertical-align: bottom;'><B>".$rs->Value('ca_usucerrado')."</B><br />".$rs->Value('ca_fchcerrado')."</TD>";
        echo "   </TR>";
        echo "   <TR>";
        echo "  	<TD style='visibility: $visible;' Class=invertir style='text-align: right; vertical-align: bottom;'>Abrir el Caso:<br /><IMG src='./graficos/lock_close.gif' onclick='elegir(\"Abrir\", \"".$rs->Value('ca_idreporte')."\");' alt='Abrir nuevamente el Reporte' border=0></TD>";
        echo "   </TR>";
    }else {
        echo "   <TR>";
        echo "  	<TD style='visibility: $visible;' Class=invertir style='text-align: right; vertical-align: bottom;'>Cierre del Caso:<br /><IMG src='./graficos/lock_open.gif' onclick='elegir(\"Cerrar\", \"".$rs->Value('ca_idreporte')."\");' alt='Cerrar el Caso y Entregar Antecedentes' border=0></TD>";
        echo "   </TR>";
        echo "   <TR>";
        echo "  	<TD style='visibility: $visible;' Class=invertir style='text-align: right; vertical-align: bottom;'>Anular Reporte:<br /><IMG src='./graficos/no.gif' onclick='elegir(\"Anular\", \"".$rs->Value('ca_idreporte')."\");' alt='Anular y Ocultar el Reporte' border=0></TD>";
        echo "   </TR>";
    }
    echo "	 </TABLE></TD>";

    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3><B>6. Descripción de la Mercancía:</B><BR>".nl2br($rs->Value('ca_mercancia_desc'))."<BR><BR>&laquo;".(($rs->value("ca_mcia_peligrosa")=='t')?"SÍ":"NO")." es Mercancía Peligrosa&raquo;</TD>";
    echo "</TR>";

    $cadena = (trim(strlen($rs->Value('ca_idproveedor'))) != 0)?"ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")":"false";
    if (!$tm->Open("select * from vi_terceros where $cadena")) {
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }

    $tm->MoveFirst();
    $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
    $terminos= array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_incoterms')));
    $cadena  = "  <TD Class=partir ROWSPAN=".($tm->GetRowCount()*2)." style='text-align:left; vertical-align:top;'>Proveedor:<BR></TD>";
    while (!$tm->Eof()) {
        $pro = "_pro_".$tm->GetCurrentRow();
        echo "<TR>";
        echo $cadena;
        echo "  <TD Class=mostrar COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1>";
        echo "  <TR>";
        echo "    <TD Class=mostrar COLSPAN=2 WIDTH=220><B>7. Nombre:</B><BR>".$tm->Value('ca_nombre')."</TD>";
        echo "    <TD Class=mostrar COLSPAN=2 WIDTH=280><B>7.1 Orden:</B><BR>".$ordenes[$tm->Value('ca_idtercero')]."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=mostrar COLSPAN=2><B>7.2 Contacto:</B><BR>".$tm->Value('ca_contacto')."</TD>";
        echo "    <TD Class=mostrar COLSPAN=2><B>7.3 Dirección:</B><BR>".$tm->Value('ca_direccion')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=mostrar><B>7.4 Teléfono:</B><BR>".$tm->Value('ca_telefonos')."</TD>";
        echo "    <TD Class=mostrar><B>7.5 Fax:</B><BR>".$tm->Value('ca_fax')."</TD>";
        echo "    <TD Class=mostrar COLSPAN=2><B>7.6 Correo Electrónico:</B><BR>".$tm->Value('ca_email')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=mostrar COLSPAN=4><B>7.7 Incoterms:</B><BR>".$terminos[$tm->Value('ca_idtercero')]."</TD>";
        echo "  </TR>";
        echo "  </TABLE></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
        $cadena = "";
        $tm->MoveNext();
    }
    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Cliente:<BR></TD>";
    echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1 BORDER=1>";
    echo "  <TR>";
    echo "    <TD Class=listar COLSPAN=2 WIDTH=220><B>8. Nombre:</B><BR>".$rs->Value('ca_nombre_cli')."</TD>";
    echo "    <TD Class=listar COLSPAN=2 WIDTH=280><B>8.1 Orden:</B><BR>".$rs->Value('ca_orden_clie')."</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=listar COLSPAN=2><B>8.2 Contacto:</B><BR>".$rs->Value('ca_contacto_cli')."</TD>";
    echo "    <TD Class=listar COLSPAN=2><B>8.3 Dirección:</B><BR>".str_replace ("|"," ",$rs->Value('ca_direccion_cli'))."</TD>";
    echo "  </TR>";
    echo "  <TR>";
    echo "    <TD Class=listar><B>8.4 Teléfono:</B><BR>".$rs->Value('ca_telefonos_cli')."</TD>";
    echo "    <TD Class=listar><B>8.5 Fax:</B><BR>".$rs->Value('ca_fax_cli')."</TD>";
    echo "    <TD Class=listar COLSPAN=2><B>8.6 Correo Electrónico:</B><BR>".$rs->Value('ca_email_cli')."</TD>";
    echo "  </TR>";
    echo "  </TABLE></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    if ($rs->Value('ca_idconsignatario') != 0) {
        echo "<TR>";
        echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consignatario:<BR></TD>";
        echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1 BORDER=1>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=220><B>9.1 Nombre:</B><BR>".$rs->Value('ca_nombre_con')."</TD>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=280><B>9.1.1 Enviar Información:</B><BR><CENTER>".$rs->Value('ca_informar_cons')."<CENTER></TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2><B>9.1.2 Contacto:</B><BR>".$rs->Value('ca_contacto_con')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.1.3 Dirección:</B><BR>".$rs->Value('ca_direccion_con')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar><B>9.1.4 Teléfono:</B><BR>".$rs->Value('ca_telefonos_con')."</TD>";
        echo "    <TD Class=listar><B>9.1.5 Fax:</B><BR>".$rs->Value('ca_fax_con')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.1.6 Correo Electrónico:</B><BR>".$rs->Value('ca_email_con')."</TD>";
        echo "  </TR>";
        echo "  </TABLE></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
    }
    if ($rs->Value('ca_idnotify') != 0) {
        echo "<TR>";
        echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Notify:<BR></TD>";
        echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1 BORDER=1>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=220><B>9.2 Nombre:</B><BR>".$rs->Value('ca_nombre_not')."</TD>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=280><B>9.2.1 Enviar Información:</B><BR><CENTER>".$rs->Value('ca_informar_noti')."<CENTER></TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2><B>9.2.2 Contacto:</B><BR>".$rs->Value('ca_contacto_not')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.2.3 Dirección:</B><BR>".$rs->Value('ca_direccion_not')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar><B>9.2.4 Teléfono:</B><BR>".$rs->Value('ca_telefonos_not')."</TD>";
        echo "    <TD Class=listar><B>9.2.5 Fax:</B><BR>".$rs->Value('ca_fax_not')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.2.6 Correo Electrónico:</B><BR>".$rs->Value('ca_email_not')."</TD>";
        echo "  </TR>";
        echo "  </TABLE></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
    }

    if ($rs->Value('ca_idmaster') != 0) {
        echo "<TR>";
        echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Consigna.Master:<BR></TD>";
        echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1 BORDER=1>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=220><B>9.3 Nombre:</B><BR>".$rs->Value('ca_nombre_mas')."</TD>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=280><B>9.3.1 Enviar Información:</B><BR><CENTER>".$rs->Value('ca_informar_mast')."<CENTER></TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2><B>9.3.2 Contacto:</B><BR>".$rs->Value('ca_contacto_mas')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.3.3 Dirección:</B><BR>".$rs->Value('ca_direccion_mas')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar><B>9.3.4 Teléfono:</B><BR>".$rs->Value('ca_telefonos_mas')."</TD>";
        echo "    <TD Class=listar><B>9.3.5 Fax:</B><BR>".$rs->Value('ca_fax_mas')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>9.3.6 Correo Electrónico:</B><BR>".$rs->Value('ca_email_mas')."</TD>";
        echo "  </TR>";
        echo "  </TABLE></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
    }

    if ($rs->Value('ca_idrepresentante') != 0) {
        echo "<TR>";
        echo "  <TD Class=partir ROWSPAN=2 style='text-align:left; vertical-align:top;'>Representante:<BR></TD>";
        echo "  <TD Class=imprimir COLSPAN=4><TABLE WIDTH=500 CELLSPACING=1 BORDER=1>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=220><B>10. Nombre:</B><BR>".$rs->Value('ca_nombre_rep')."</TD>";
        echo "    <TD Class=listar COLSPAN=2 WIDTH=280><B>10.1 Enviar Información:</B><BR><CENTER>".$rs->Value('ca_informar_repr')."<CENTER></TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar COLSPAN=2><B>10.2 Contacto:</B><BR>".$rs->Value('ca_contacto_rep')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>10.3 Dirección:</B><BR>".$rs->Value('ca_direccion_rep')."</TD>";
        echo "  </TR>";
        echo "  <TR>";
        echo "    <TD Class=listar><B>10.4 Teléfono:</B><BR>".$rs->Value('ca_telefonos_rep')."</TD>";
        echo "    <TD Class=listar><B>10.5 Fax:</B><BR>".$rs->Value('ca_fax_rep')."</TD>";
        echo "    <TD Class=listar COLSPAN=2><B>10.6 Correo Electrónico:</B><BR>".$rs->Value('ca_email_rep')."</TD>";
        echo "  </TR>";
        echo "  </TABLE></TD>";
        echo "</TR>";
        echo "<TR HEIGHT=5>";
        echo "  <TD Class=invertir COLSPAN=4></TD>";
        echo "</TR>";
    }
    echo "<TR>";
    echo "  <TD Class=partir ROWSPAN=4 style='text-align:left; vertical-align:top;'>Instrucciones:<BR></TD>";
    echo "  <TD Class=mostrar COLSPAN=4><B>11.1 Preferencias del Cliente:</B><BR>".nl2br($rs->Value('ca_preferencias_clie'))."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=4><B>11.2 Instrucciones Especiales para el Agente:</B><BR>".nl2br($rs->Value('ca_instrucciones'))."</TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=mostrar COLSPAN=4><B>11.3 Copiar comunicaciones a:</B><BR>";
    echo "    <TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
    $z=0;
    $emails = str_replace(" ", "", $rs->Value('ca_confirmar_clie'));
    $emails = explode(",", $emails);
    for ($i=0; $i<ceil(count($emails)/3); $i++){
        echo "  <TR>";
        for ($j=0; $j<3; $j++) {
            $cadena = (strlen($emails[$z])==0)?"&nbsp;":$emails[$z];
            echo "<TD Class=invertir>$cadena</TD>";
            $z++;
        }
        echo "  </TR>";
    }
    echo "    </TABLE>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=titulo ROWSPAN=5 style='text-align:left; vertical-align:top;'><B>12. Transporte:</B><BR><CENTER>".$rs->Value('ca_transporte')."</CENTER></TD>";
    echo "  <TD Class=listar>13. Modalidad:<BR><CENTER><B>".$rs->Value('ca_modalidad')."</B></CENTER></TD>";
    echo "  <TD Class=listar COLSPAN=3>14. Línea Transporte:<BR><B>".$rs->Value('ca_nombre')."</B></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>15.&nbsp;Colmas&nbsp;Ltda:<BR><CENTER><B>".$rs->Value('ca_colmas')."</B></CENTER></TD>";
    echo "  <TD Class=listar>16.&nbsp;Seguro:<BR><CENTER><B>".$rs->Value('ca_seguro')."</B></CENTER></TD>";
    echo "  <TD Class=listar COLSPAN=2>17.&nbsp;Lib.&nbsp;Automática:&nbsp;&nbsp;<B>".$rs->Value('ca_liberacion')."</B><BR>Tiempo de Crédito: <B>".$rs->Value('ca_tiempocredito')."</B></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=4></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=invertir COLSPAN=4><TABLE WIDTH=100% CELLSPACING=1 CELLPADDING=0 BORDER=0>";
    echo "    <TR>";
    echo "      <TD Class=listar WIDTH=175>18.1 Continuación/Viaje:";
    echo "      <TD Class=listar><CENTER><B>".$rs->Value('ca_continuacion')."</B></CENTER></TD>";  // Llena el cuadro de lista con la lista de continuaciones de viaje
    echo "      <TD Class=listar>18.2&nbsp;Destino&nbsp;Final:";
    echo "      <TD Class=listar><B>".$rs->Value('ca_final_dest')."</B></TD>";                         // Llena el cuadro de lista con la lista de ciudades destino de continuaciones de viaje
    echo "    </TR>";

    if (!$tm->Open("select ca_email, ca_login from vi_usuarios where ca_login='".$rs->Value('ca_continuacion_conf')."'")) { // Hace un Select a la vista e uncluye un registro vacio
        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit;
    }
    $tm->MoveFirst();
    echo "    <TR>";
    echo "      <TD Class=listar>18.3 Notificar C/Viaje al email:";
    echo "      <TD Class=listar COLSPAN=3><B>".$tm->Value('ca_email')."</B></TD>";
    echo "    </TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=5></TD>";
    echo "</TR>";


    echo "    <TR>";
    echo "      <TD Class=mostrar>19.1 Consignar HAWB/HBL a :</TD>";                                       // Llena el cuadro de lista con las zonas o depósitos aduaneros
    echo "      <TD Class=mostrar COLSPAN=3><B>".$rs->Value('ca_consignar')."</B></TD>";
    echo "    </TR>";
    echo "    <TR>";
    echo "      <TD Class=mostrar>19.2 Trasladar a :</TD>";                                           // Llena el cuadro de lista con las zonas o depósitos aduaneros
    echo "      <TD Class=mostrar COLSPAN=3><B>".$rs->Value('ca_tipobodega')."</B></TD>";
    echo "    </TR>";
    echo "    <TR>";
    echo "      <TD Class=mostrar>19.3&nbsp;Igualar&nbsp;Master/Hijo:&nbsp;<B>".$rs->Value('ca_mastersame')."</B></TD>";
    echo "      <TD Class=mostrar COLSPAN=4><B>".$rs->Value('ca_bodega')."</B></TD>";                  // Llena el cuadro de lista con las zonas o depósitos aduaneros
    echo "    </TR>";
    echo "  </TABLE></TD>";

    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=invertir COLSPAN=5></TD>";
    echo "</TR>";



}

function carga_arreglos(&$tm) {
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
        echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
        echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idagente, ca_nombre, ca_idtrafico from vi_agentes where ca_activo=true order by ca_nombre ")) { // Selecciona todos lo registros de la tabla Agentes
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }
    $tm->MoveFirst();
    while (!$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='idagentes' VALUE=".$tm->Value('ca_idagente').">";
        echo "<INPUT TYPE='HIDDEN' NAME='agentes' VALUE='".$tm->Value('ca_nombre')."'>";
        echo "<INPUT TYPE='HIDDEN' NAME='idtraficoags' VALUE='".$tm->Value('ca_idtrafico')."'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idlinea, ca_nombre, ca_transporte from vi_transporlineas where ca_activo_impo=true order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=0>";
    echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='PENDIENTE DE DEFINIR'>";
    echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='Aéreo'>";
    while ( !$tm->Eof()) {
        echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=".$tm->Value('ca_idlinea').">";
        echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='".$tm->Value('ca_nombre')."'>";
        echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='".$tm->Value('ca_transporte')."'>";
        $tm->MoveNext();
    }
    if (!$tm->Open("select ca_idbodega, ca_nombre, ca_tipo, ca_transporte from vi_bodegas")) { // Selecciona todos lo registros de la tabla Bodegas
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reportenegocio.php';</script>";
        exit; }
    $tm->MoveFirst();
    while ( !$tm->Eof()) {
        if ($tm->Value('ca_tipo') == 'Coordinador Logístico' or $tm->Value('ca_tipo') == 'Operador Multimodal') {
            echo "<INPUT TYPE='HIDDEN' NAME='aidconsigna' VALUE=".$tm->Value('ca_idbodega').">";
            echo "<INPUT TYPE='HIDDEN' NAME='aconsigna' VALUE='".$tm->Value('ca_nombre')."'>";
            echo "<INPUT TYPE='HIDDEN' NAME='aclase' VALUE='".$tm->Value('ca_tipo')."'>";
        }else {
            echo "<INPUT TYPE='HIDDEN' NAME='aidbodega' VALUE=".$tm->Value('ca_idbodega').">";
            echo "<INPUT TYPE='HIDDEN' NAME='abodega' VALUE='".$tm->Value('ca_nombre')."'>";
            echo "<INPUT TYPE='HIDDEN' NAME='atipo' VALUE='".$tm->Value('ca_tipo')."'>";
            echo "<INPUT TYPE='HIDDEN' NAME='atranspor' VALUE='".$tm->Value('ca_transporte')."'>";
        }
        $tm->MoveNext();
    }
}
?>