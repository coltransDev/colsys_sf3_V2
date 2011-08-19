<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       COTIZACIONES.PHP                                            \\
// Creado:        2004-04-21                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-04-21                                                  \\
//                                                                            \\
// Descripción:   Módulo para la creación de cotizaciones.                    \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Consulta a Maestra de Cotizaciones';
$campos = array("Mis Cotizaciones"=>"ca_usuario", "Nombre del Cliente"=>"ca_compania", "Nombre del Contacto"=>"ca_ncompleto_cn", "Asunto"=>"ca_asunto", "Por Vendedor"=>"ca_vendedor", "Nro.de Cotización"=>"c.ca_idcotizacion");  // Arreglo con los criterios de busqueda
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$transportes = array("Aéreo","Marítimo","Terrestre");                          // Arreglo con los tipos de Transportes
$tincoterms = array("EXW - EX Works","FCA - Free Carrier","FAS - Free Alongside Ship","FOB - Free On Board","CIF - Cost, Insuarance & Freight", "CIP - Carriage and Insurence Paid", "CPT - Carriage Paid To", "CFR - Cost and Freight", "DDP - Delivered Duty Paid", "DDU - Delivered Duty Unpaid", "DAF - Delivered at Frontier"); // Arreglo con los términos Iconterms

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY style='margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px; text-align: right; font-size: 11px; font-weight:bold;'>";
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
	echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='findCotizacion' ACTION='findcotizacion.php'>";
    echo "<INPUT TYPE='HIDDEN' NAME='boton' VALUE='Buscar'>";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=4 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='modalidad' SIZE=4>";
    while (list ($clave, $val) = each ($campos)) {
         echo " <OPTION VALUE='$clave'";
         if ($clave == 'Mis Cotizaciones') {
             echo " SELECTED";
             }
         echo ">$clave";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>";
    echo "  </TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:window.parent.frames.find_contacto.style.visibility = \"hidden\";'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //   echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Buscar':{
             $criterio = ($modalidad == "Mis Cotizaciones")?$usuario:$criterio;
             if (isset($criterio) and strlen($criterio)>0) {
                 $condicion= "and lower($campos[$modalidad]) like lower('%".$criterio."%')"; }
             if (!$rs->Open("select c.ca_idcotizacion, c.ca_idcontacto, c.ca_compania, c.ca_ncompleto_cn, c.ca_direccion_cl, c.ca_telefonos, c.ca_fax, c.ca_vendedor, c.ca_email, c.ca_complemento, c.ca_preferencias, c.ca_confirmar, c.ca_asunto, p.ca_idproducto, p.ca_producto, p.ca_impoexpo, p.ca_transporte, p.ca_modalidad, p.ca_incoterms, p.ca_idtraorigen, p.ca_traorigen, p.ca_idorigen, p.ca_ciuorigen, p.ca_idtradestino, p.ca_tradestino, p.ca_iddestino, p.ca_ciudestino, c.ca_cupo, c.ca_diascredito from vi_cotizaciones c, vi_cotproductos p where c.ca_idcotizacion = p.ca_idcotizacion and ca_impoexpo = 'Importación' $condicion order by c.ca_idcotizacion DESC")) {               // Selecciona todos lo registros de la tabla de Cotizaciones Potenciales
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function seleccion(idproducto) {";
             echo "    source = document.getElementById(idproducto + '_idcotizacion');";
             echo "    target = window.parent.document.getElementById('idcotizacion');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_id_con');";
             echo "    target = window.parent.document.getElementById('id_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_nombre_con');";
             echo "    target = window.parent.document.getElementById('nombre_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_contacto_con');";
             echo "    target = window.parent.document.getElementById('contacto_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_direccion_con');";
             echo "    target = window.parent.document.getElementById('direccion_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_telefonos_con');";
             echo "    target = window.parent.document.getElementById('telefonos_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_fax_con');";
             echo "    target = window.parent.document.getElementById('fax_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_email_con');";
             echo "    target = window.parent.document.getElementById('email_con');";
             echo "    target.value = source.value;";
             echo "    source = document.getElementById(idproducto + '_producto');";
             echo "    target = window.parent.document.getElementById('mercancia_desc');";
             echo "    target.value = source.value;";
             echo "    target = window.parent.document.getElementById('orden_cons');";
             echo "    target.focus();";
             echo "    source = document.getElementById(idproducto + '_impoexpo');";
             echo "    target = window.parent.document.getElementById('impoexpo');";
             echo "    target.selectedIndex = source.value;";
             echo "    source = document.getElementById(idproducto + '_transporte');";
             echo "    target = window.parent.document.getElementById('transporte');";
             echo "    target.selectedIndex = source.value;";
             echo "    source = document.getElementById(idproducto + '_idtraorigen');";
             echo "    target = document.getElementById(idproducto + '_idtradestino');";
             echo "    window.parent.elegir_traficos(source.value, target.value);";
             echo "    source = document.getElementById(idproducto + '_idorigen');";
             echo "    target = document.getElementById(idproducto + '_iddestino');";
             echo "    window.parent.elegir_puertos(source.value, target.value);";
             echo "    source = document.getElementById(idproducto + '_confirmar');";
             echo "    window.parent.llenar_conf(source.value);";
             echo "    window.parent.llenar_agentes();";
             echo "    window.parent.llenar_modalidades();";
             echo "    window.parent.llenar_continuaciones();";
             echo "    window.parent.llenar_consignar();";
             echo "    window.parent.llenar_bodegas();";
             echo "    source = document.getElementById(idproducto + '_modalidad');";
             echo "    window.parent.elegir_item('modalidad',source.value);";
             echo "    window.parent.llenar_lineas();";
             echo "    if (document.getElementById(idproducto + '_cupo').value != 0 || document.getElementById(idproducto + '_diascredito').value != 0){";
             echo "        elemento = window.parent.document.getElementById('si');";
             echo "        elemento.checked = true;";
             echo "        elemento = window.parent.document.getElementById('tiempocredito');";
             echo "        elemento.value = document.getElementById(idproducto + '_diascredito').value + ' Días';";
             echo "    }else{";
             echo "        elemento = window.parent.document.getElementById('no');";
             echo "        elemento.checked = true;";
             echo "        elemento = window.parent.document.getElementById('tiempocredito');";
             echo "        elemento.value = '-';";
             echo "    }";
             echo "    source = document.getElementById(idproducto + '_vendedor');";
             echo "    window.parent.elegir_item('login',source.value);";
             echo "    window.parent.document.body.scroll=\"yes\";";
             echo "    window.parent.frames.find_contacto.style.visibility = \"hidden\";";
             echo "}";
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand';";
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
			 echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='findcotizacion.php'>";       // Hace una llamado nuevamente a este script pero con
             echo "<TABLE CELLSPACING=1>";                                // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=7>$titulo</TH>";
             echo "</TR>";
             echo "<TH>Cotización</TH>";
             echo "<TH>Nombre del Cliente</TH>";
             echo "<TH>Contacto</TH>";
             echo "<TH>Trayecto</TH>";
             echo "<TH>Ver</TH>";
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                  // Lee la totalidad de los registros obtenidos en la instrucción Select
                $direccion = str_replace ("|"," ",$rs->Value('ca_direccion_cl')).(($rs->Value('ca_oficina')!='')?" Oficina : ".$rs->Value('ca_oficina'):"" . ($rs->Value('ca_torre')!='')?" Torre : ".$rs->Value('ca_torre'):"" . ($rs->Value('ca_interior')!='')?" Interior : ".$rs->Value('ca_interior'):"" . ($rs->Value('ca_complemento')!='')?" - ".$rs->Value('ca_complemento'):"");
                echo "<TR style='background:F0F0F0' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" ONCLICK='javascript:seleccion(".$rs->Value('ca_idproducto').");'>";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_idcotizacion TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[idcotizacion] VALUE=".$rs->Value('ca_idcotizacion').">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_id_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[id_con] VALUE=".$rs->Value('ca_idcontacto').">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_nombre_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[nombre_con] VALUE=\"".$rs->Value('ca_compania')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_contacto_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[contacto_con] VALUE=\"".$rs->Value('ca_ncompleto_cn')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_direccion_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[direccion_con] VALUE=\"".addslashes($direccion)."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_telefonos_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[telefonos_con] VALUE=\"".$rs->Value('ca_telefonos')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_fax_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[fax_con] VALUE=\"".$rs->Value('ca_fax')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_email_con TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[email_con] VALUE=\"".$rs->Value('ca_email')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_preferencias_clie TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[preferencias_clie] VALUE=\"".htmlspecialchars($rs->Value('ca_preferencias'))."\">"; //
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_confirmar TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[confirmar] VALUE=\"".htmlspecialchars($rs->Value('ca_confirmar'))."\">"; //
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_idtraorigen TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[idtraorigen] VALUE=\"".$rs->Value('ca_idtraorigen')."\">"; //
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_idtradestino TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[idtradestino] VALUE=\"".$rs->Value('ca_idtradestino')."\">"; //
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_idorigen TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[idorigen] VALUE=\"".$rs->Value('ca_idorigen')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_iddestino TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[iddestino] VALUE=\"".$rs->Value('ca_iddestino')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_producto TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[producto] VALUE=\"".$rs->Value('ca_producto')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_impoexpo TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[impoexpo] VALUE=\"".array_search($rs->Value('ca_impoexpo'),$imporexpor)."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_transporte TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[transporte] VALUE=\"".array_search($rs->Value('ca_transporte'),$transportes)."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_modalidad TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[modalidad] VALUE=\"".$rs->Value('ca_modalidad')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_incoterms TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[incoterms] VALUE=\"".array_search($rs->Value('ca_incoterms'),$tincoterms)."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_cupo TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[cupo] VALUE=\"".$rs->Value('ca_cupo')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_diascredito TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[diascredito] VALUE=\"".$rs->Value('ca_diascredito')."\">";
                echo "  <INPUT ID=".$rs->Value('ca_idproducto')."_vendedor TYPE='HIDDEN' NAME=".$rs->Value('ca_idproducto')."[vendedor] VALUE=\"".$rs->Value('ca_vendedor')."\">";
                echo "  <TD style='vertical-align:top;'>".$rs->Value('ca_idcotizacion')."</TD>";
                echo "  <TD style='vertical-align:top;'>".$rs->Value('ca_compania')."</TD>";
                echo "  <TD style='vertical-align:top;'>".$rs->Value('ca_ncompleto_cn')."</TD>";
                echo "  <TD style='vertical-align:top;'>".substr($rs->Value('ca_modalidad'),0,3)."» ".$rs->Value('ca_ciuorigen')." - ".$rs->Value('ca_ciudestino')."<BR>".$rs->Value('ca_transporte')."</TD>";
                echo "  <TD style='vertical-align:top;'><IMG src='./graficos/pdf.gif' alt='Ver Archivo PFD de la Cotización' border=0 onclick='window.open(\"cotizacion.php?id=".$rs->Value('ca_idcotizacion')."\",\"Cotizacion\",\"scrollbars=yes,width=800,height=600,top=200,left=150\")'></TD>";
                echo "</TR>";
                $rs->MoveNext();
               }
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:location.href = \"findcotizacion.php\"'></TH>";  // Cancela la operación
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
?>