<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONFIRMA_OTM.PHP                                          \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Sistema de Confirmaciones de Llegada - Marítimo.            \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
header("Location: /confirmaciones/index/modo/otm");
$programa = 27;

$titulo = 'Módulo de Avisos de OTM';
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls","Nombre del Cliente"=>"ca_compania", "N.i.t."=>"ca_idcliente");  // Arreglo con las opciones de busqueda
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls","Nombre del Cliente"=>"ca_compania", "Reporte de Negocio"=>"ca_consecutivo", "Factura Cliente"=>"ca_factura", "N.i.t."=>"ca_idcliente", "Factura Proveedor"=>"ca_factura_prov", "Observaciones"=>"ca_observaciones");  // Arreglo con las opciones de busqueda

$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                     // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require("include/class.phpmailer.php");
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$mail = new PHPMailer();

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='confirma_otm.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Botón para la creación de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=7>";
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."'".(($val=='ca_referencia')?" SELECTED":"").">".$clave;
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' VALUE='$cadena' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3>Búsqueda por ETA:  <INPUT TYPE=CHECKBOX NAME='rango' ONCLICK='habilitar();'><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'><TABLE CELLSPACING=1 WIDTH=320>";
	echo "	<TR>";
    echo "    <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' DISABLED SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "    <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' NAME='fchfinal' DISABLED SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

	echo "    <TD Class=listar>Referencia Creada por:<BR><SELECT NAME='sucursal' DISABLED>";
    echo "    <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    while ( !$tm->Eof()) {
    	echo "    <OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
        $tm->MoveNext();
    }
    echo "    </SELECT></TD>";
	echo "	</TR>";
    echo "	</TABLE></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cerrar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.opcion.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($criterio)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $condicion= "where lower($opcion) like lower('%".$criterio."%')";
	if (isset($sucursal)){
		$condicion.= " and (ca_fcharribo between '$fchinicial' and '$fchfinal') and ca_sucursal like '$sucursal'";
	}
    if (!$rs->Open("select DISTINCT ca_ano, ca_mes, ca_trafico, ca_modal, ca_referencia, ca_sigla, ca_nombre, ca_ciuorigen, ca_traorigen, ca_ciudestino, ca_tradestino, ca_fchembarque, ca_fcharribo, ca_motonave from vi_inoconsulta_sea $condicion order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia")) {           // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'confirma_otm.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='confirma_otm.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>COLTRANS S.A.<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Linea</TH>";
    echo "<TH>&nbsp</TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"confirma_otm.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\";'>".$rs->Value('ca_referencia')."</TD>";
       echo "  <TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_sigla')." ".$rs->Value('ca_nombre')."</TD>";
       echo "  <TD Class=listar ROWSPAN=2></TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=listar>";
       echo "  <TABLE WIDTH=520 CELLSPACING=1>";
       echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Embarque</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Arrivo</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Motonave</TD><TR>";
       echo "    <TD Class=listar>".$rs->Value('ca_ciuorigen')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_traorigen')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_ciudestino')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_tradestino')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_fchembarque')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_fcharribo')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_motonave')."</TD>";
       echo "  </TABLE>";
       echo " </TD>";
       echo "</TR>";
       echo "<TR HEIGHT=5>";
       echo "  <TD Class=invertir COLSPAN=3></TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Consultar': {                                                    // Opcion para Consultar un solo registro
             if (!$rs->Open("select ca_idbodega, ca_nombre from tb_bodegas where ca_tipo in ('Zona Franca', 'Zona Aduanera','Depósito Aduanero', 'Depósito Privado', 'Industria Militar') order by ca_tipo, ca_nombre")) {                       // Selecciona todos lo registros de la tabla Bodegas
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $bodegas = array();
			 while (!$rs->Eof()) {
			 	 $bodegas = array_merge($bodegas, array($rs->Value('ca_idbodega') => substr($rs->Value('ca_nombre'),0,60)));
                 $rs->MoveNext(); }

             if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
			 $rs->MoveFirst();
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  return (true);";
             echo "}";
             echo "function asignar_email(campo){";
             echo "  cadena = campo.getAttribute('ID');";
             echo "  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);";
             echo "  objeto = document.getElementById('ar_' + indice);";
             echo "  if(campo.checked && objeto.value.length > 1) {";
             echo "     campo.value = objeto.value; }";
             echo "  else {";
             echo "     campo.value = '' };";
             echo "}";
             echo "function habilitar(campo){";
             echo "  objeto = document.getElementById('tb_' + campo.value);";
             echo "  if(campo.checked) {";
             echo "     objeto.style.display = \"block\"; }";
             echo "  else {";
             echo "     objeto.style.display = \"none\"; }";
             echo "}";
             echo "function mostrar(campo){";
             echo "  cadena = campo.getAttribute('NAME');";
             echo "  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);";
             echo "  objeto_1 = document.getElementById('ciudad_dest_' + indice);";
             echo "  objeto_2 = document.getElementById('fchllegada_' + indice);";
             echo "  objeto_3 = document.getElementById('bodega_' + indice);";
             echo "  if(campo.value == \"Confirmación\") {";
             echo "     objeto_1.style.display = 'block';";
             echo "     objeto_2.style.display = 'block';";
             echo "     objeto_3.style.display = 'block'; }";
             echo "  else {";
             echo "     objeto_1.style.display = 'none';";
             echo "     objeto_2.style.display = 'none';";
             echo "     objeto_3.style.display = 'none'; }";
             echo "}";
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='confirma_otm.php' ONSUBMIT='return validar();' enctype='multipart/form-data'>";  // Hace una llamado nuevamente a este script pero con
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$rs->Value('ca_referencia')."'>";              // Hereda el Id del registro que se esta modificando
             echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=6>COLTRANS S.A.<BR>$titulo</TH>";
             echo "</TR>";
             echo "<TH></TH>";
             echo "<TH COLSPAN=4>Descripción</TH>";
             echo "<TH></TH>";  // Botón para la creación de un Registro Nuevo
             while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD Class=partir>Referencia:</TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;' COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                echo "  <TD Class=partir>Fecha de Registro :</TD>";
                echo "  <TD style='font-size: 11px; text-align: center;' Class=listar>".$rs->Value('ca_fchreferencia')."</TD>";
                echo "  <TD WIDTH=44 ROWSPAN=7 Class=listar></TD>";                                            // Botones para hacer Mantenimiento a la Tabla
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>&nbsp</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir style='text-align: center; vertical-align:top;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp<BR>&nbsp</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_ciuorigen')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_traorigen')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_ciudestino')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center; font-weight:bold;' WIDTH=160>".$rs->Value('ca_tradestino')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Transportista:</TD>";
                echo "  <TD Class=listar COLSPAN=2>".$rs->Value('ca_nombre')."<BR>".$rs->Value('ca_sigla')."</TD>";
                echo "  <TD Class=listar COLSPAN=2>".$rs->Value('ca_nomtransportista')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir ROWSPAN=2>Modalidad:<BR><CENTER>".$rs->Value('ca_modalidad')."</CENTER></TD>";
                echo "  <TD Class=listar><B>Motonave:</B><BR>".$rs->Value('ca_motonave')."</TD>";
                echo "  <TD Class=listar><B>MBL's:</B><BR>".nl2br($rs->Value('ca_mbls'))."</TD>";
                echo "  <TD Class=listar COLSPAN=2><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD COLSPAN=4 Class=invertir>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {        // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }

                $cl =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_continuacion != 'N/A' order by ca_compania")) {                      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
                    echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }

                $in =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH COLSPAN=3>Contratos de Comodato</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=30 Class=listar>".$co->Value('ca_cantidad')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
					echo "  <TD WIDTH=90 Class=listar>".$co->Value('ca_idcontrato')." ".((strlen($co->Value('ca_observaciones_con')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones_con')."'>":"")."</TD>";
					echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_fchcontrato')."</TD>";
					echo "  <TD WIDTH=25 Class=listar>".((strlen($co->Value('ca_observaciones')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones')."'>":"")."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                    }
				echo "  <TR>";
				echo "    <TD Class=listar>Sitio de Devolución:</TD>";
				echo "    <TD Class=listar COLSPAN=5>".$co->Value('ca_sitiodevolucion')."</TD>";
				echo "  </TR>";
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Tránsito:&nbsp</TD>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Embarque:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fchembarque')."</TD>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Arribo:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fcharribo')."</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6></TD>";
                echo "</TR>";

				$saludo = (date('H')<12)?"buenos días":((date('H')>18)?"buenas noches":"buenas tardes");
                echo "<TR>";
                echo "  <TD Class=partir>Avisos ".$cl->Value('ca_continuacion').":&nbsp</TD>";
				echo "  <TD Class=mostrar COLSPAN=4><B>Introducción al Mensaje:</B><BR><TEXTAREA NAME='intro_body' WRAP=virtual ROWS=3 COLS=93>Respetado cliente $saludo, nos complace suministrarle nueva información en relación a su carga en ".$cl->Value('ca_continuacion').".</TEXTAREA></TD>";
                echo "  <TD Class=mostrar>&nbsp</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Adjuntar&nbsp;Archivo:</TD>";
				echo "  <TD Class=mostrar COLSPAN=4><INPUT TYPE='FILE' NAME='attachment' SIZE=75><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Incluir Adjunto General'></TD>";
                echo "  <TD Class=mostrar></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=imprimir COLSPAN=6>&nbsp</TD>";
                echo "</TR>";
                echo "<TH Class=titulo COLSPAN=6>Seleccione los Clientes para enviar Confirmación</TH>";
                $cli_mem = 0;
                $hbl_mem = 0;
                while (!$cl->Eof() and !$cl->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                   if( $cl->Value('ca_idcliente') != $cli_mem or $cl->Value('ca_hbls') != $hbl_mem){
                       if (strlen($cl->Value('ca_consecutivo')) == 0) {
						   if (!$in->Open("select ca_confirmar from tb_clientes where ca_idcliente = ".$cl->Value('ca_idcliente'))) {  // Selecciona todos los correos electrónicos para enviar confirmación según Maestra Clientes
							   echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
							   echo "<script>document.location.href = 'entrada.php';</script>";
							   exit; }
					   }else {
						   if (!$in->Open("select ca_etapa_actual, ca_confirmar_clie as ca_confirmar from tb_reportes rp1 where ca_consecutivo = '".$cl->Value('ca_consecutivo')."' and ca_version = (select max(ca_version) from tb_reportes where ca_consecutivo = '".$cl->Value('ca_consecutivo')."')")) {  // Selecciona todos los correos electrónicos para enviar confirmación según Maestra Clientes
							   echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
							   echo "<script>document.location.href = 'entrada.php';</script>";
							   exit; }
					   }
					   echo "<TR HEIGHT=5>";
                       echo "  <TD Class=captura COLSPAN=6></TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar style='font-size: 11px; vertical-align:bottom'><B>Id Cliente:</B><BR>".number_format($cl->Value('ca_idcliente'))."</TD>";
                       echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=4><B>Nombre del Cliente:</B><BR>".$cl->Value('ca_compania')."</TD>";
                       echo "  <TD Class=listar><INPUT TYPE=CHECKBOX NAME='oid[]' ONCLICK='habilitar(this);' VALUE=".$cl->Value('ca_oid')."></TD>";
                       echo "</TR>";

                       echo "<TR><TD Class=invertir COLSPAN=6><TABLE ID=tb_".$cl->Value('ca_oid')." style='display: none' WIDTH=100% CELLSPACING=1>";
					   echo "<TR>";
                       echo "  <TD Class=listar><B>Vendedor:</B><BR>".$cl->Value('ca_login')."</TD>";
                       echo "  <TD Class=listar><B>HBL:</B><BR>".$cl->Value('ca_hbls')."</TD>";
                       echo "  <TD Class=listar><B>No.Piezas:</B><BR>".number_format($cl->Value('ca_numpiezas'))."</TD>";
                       echo "  <TD Class=listar><B>Peso en Kilos:</B><BR>".number_format($cl->Value('ca_peso'),3)."</TD>";
                       echo "  <TD Class=listar><B>Volumen CMB:</B><BR>".number_format($cl->Value('ca_volumen'),3)."</TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar><B>ID Proveedor:</B><BR>".$cl->Value('ca_idproveedor')."</TD>";
                       echo "  <TD Class=listar COLSPAN=2><B>Proveedor:</B><BR>".$cl->Value('ca_proveedor')."</TD>";
                       echo "  <TD Class=listar COLSPAN=2 ROWSPAN=4><B>Correos Electrónicos a enviar Confirmación:</B><BR>";
                       $confirmar = explode(",", $in->Value('ca_confirmar'));
                       $emails = explode(",", $cl->Value('ca_confirmar'));
                       for ($i= 0; $i< 8; $i++){
                            $chequear = (in_array($confirmar[$i],$emails) and $confirmar[$i]!="")?"CHECKED":"";
                            echo "<INPUT ID=ar_".$cl->Value('ca_oid')."_$i TYPE='TEXT' NAME='ar_".$cl->Value('ca_oid')."[]' VALUE='".$confirmar[$i]."' SIZE=35 MAXLENGTH=50>";
                            echo "<INPUT ID=em_".$cl->Value('ca_oid')."_$i TYPE=CHECKBOX NAME='em_".$cl->Value('ca_oid')."[]' VALUE='".$confirmar[$i]."' ONCHANGE='asignar_email(this);' $chequear><BR>";
                       }
                       echo "  </TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar><INPUT NAME='tipo_".$cl->Value('ca_oid')."' TYPE='radio' VALUE = 'Status' CHECKED ONCLICK='mostrar(this);'>Status<BR><INPUT NAME='tipo_".$cl->Value('ca_oid')."' TYPE='radio' VALUE = 'Confirmación' ONCLICK='mostrar(this);'>Confirmación<BR><INPUT NAME='tipo_".$cl->Value('ca_oid')."' TYPE='radio' VALUE = 'Cierre' ONCLICK='mostrar(this);'>Cierre</TD>";
                       echo "  <TD Class=listar style='vertical-align:bottom;'><B>Destino ".$cl->Value('ca_continuacion').":</B><BR><INPUT style='display: none;' TYPE='TEXT' NAME='ciudad_dest_".$cl->Value('ca_oid')."' VALUE='".$cl->Value('ca_ciudad_dest')."' SIZE=18 READONLY></TD>";
                       echo "  <TD Class=listar style='vertical-align:bottom;'><B>Fecha llegada:</B><BR><INPUT style='display: none;' TYPE='TEXT' NAME='fchllegada_".$cl->Value('ca_oid')."' VALUE='".date("Y-m-d")."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar COLSPAN=3 style='vertical-align:bottom;'><B>Bodega:</B><BR><SELECT style='display: none' NAME='bodega_".$cl->Value('ca_oid')."'>";
					   reset($bodegas);
                       while (list ($clave, $val) = each ($bodegas)) {
                       		echo " <OPTION VALUE='".$clave.'|'.$val."'>$val"; }
                       echo "</SELECT></TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar COLSPAN=3><B>Ingrese mensaje exclusivo para este cliente:</B><BR><TEXTAREA NAME='mensaje_".$cl->Value('ca_oid')."' WRAP=virtual ROWS=5 COLS=65>".$cl->Value('ca_mensaje')."</TEXTAREA></TD>";
                       echo "</TR>";
					   echo "<TR>";
					   echo "  <TD Class=invertir>Adjunto para Cliente : <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Incluir Adjunto para el Cliente'></TD>";
					   echo "  <TD Class=mostrar COLSPAN=4><INPUT TYPE='FILE' NAME='attachment_".$cl->Value('ca_oid')."' SIZE=75></TD>";
					   echo "</TR>";
					   echo "</TABLE></TD></TR>";

                       echo "<TR HEIGHT=5>";
                       echo "  <TD Class=invertir COLSPAN=6></TD>";
                       echo "</TR>";
					   
                       if (!$in->Open("select * from vi_emails where ca_idcaso = ".$cl->Value('ca_oid')."::text and ca_tipo in ('StatusCargaOTM','CierreDocumentos','Conf.LlegadaOTM')")) {  // Selecciona todos los correos electrónicos para enviar confirmación
                           echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                           echo "<script>document.location.href = 'entrada.php';</script>";
                           exit; }
                       while (!$in->Eof()) {
                           echo "<TR>";
                           echo "  <TD Class=listar style='vertical-align:top;'>".$in->Value('ca_usuenvio')."</TD>";
                           echo "  <TD Class=listar COLSPAN=3>".$in->Value('ca_subject')."</TD>";
                           echo "  <TD Class=listar style='vertical-align:top;'>".$in->Value('ca_fchenvio')."</TD>";
                           echo "  <TD Class=listar><CENTER><IMG src='./graficos/mail.gif' alt='Ver correo electrónico' border=0 onclick='javascript:window.open(\"ventanas.php?opcion=Email\&id=".$in->Value('ca_idemail')."\",\"Email\",\"scrollbars=yes,width=650,height=400,top=200,left=150\")'></CENTER></TD>";
                           echo "</TR>";
                           $in->MoveNext();
                           }
					   
                       $cli_mem = $cl->Value('ca_idcliente');
                       $hbl_mem = $cl->Value('ca_hbls');
                   }
                   $cl->MoveNext();
                }
                $rs->MoveNext();
               }
               
             echo "<TR>";
             echo "  <TD Class=mostrar COLSPAN=6><B>Ingrese mensaje adicional para el correo:</B><BR><TEXTAREA NAME='email_body' WRAP=virtual ROWS=3 COLS=113></TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=6></TD>";
             echo "</TR>";

             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Enviar Correo'></TH>";     // Ordena eliminar el registro de forma permanente
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"confirma_otm.php\"'></TH>";  // Cancela la operación
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
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Enviar Correo': {                                                      // El Botón Guardar fue pulsado
             $files_attached = array();
			 foreach($_FILES as $key => $file_attached){
				 $uploadfile = basename($file_attached['name']);
	
				 if (strlen($uploadfile) != 0){
					// VARIABLES
					$file = str_replace('%20', ' ', $file_attached['tmp_name']);
					$file_real = $file_attached['tmp_name'];
	
					// If requested file exists
					if (file_exists($file_real)){
						// Get extension of requested file
						$extension = strtolower(substr(strrchr($uploadfile, "."), 1));
						// Read file to attach
						$stream = fopen($file_real, 'rb');
						$content = fread($stream, filesize($file_real));
						$content_var = basename($file_attached['tmp_name']);
						$$content_var = pg_escape_bytea($content);
						if (filesize($file_real)!=0){
							$files_attached[$key] = array("extension"=>$extension, "uploadfile"=>$uploadfile, "file_real"=>$file_real, "content_var"=>$content_var);
						}
						fclose($stream);
					}else{
						// Requested file does not exist (File not found)
						echo "<script>alert(\"El Archivo '".$file_attached['name']."' no pudo ser cargado. Proceso Cancelado!\");</script>";
						exit;
					}
				 }
			 }

             $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
             $us =& DlRecordset::NewRecordset($conn);
             if (!$us->Open("select * from vi_usuarios where ca_login = '$usuario'")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'confirmaciones.php';</script>";
                 exit; }
             $rp =& DlRecordset::NewRecordset($conn);
             $rf =& DlRecordset::NewRecordset($conn);

             if (!$rf->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")){
                 echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'confirma_otm.php';</script>";
                 exit; }
             if ($rf->Value('ca_modalidad')=="FCL") {
                 $eq =& DlRecordset::NewRecordset($conn);
                 if (!$eq->Open("select * from vi_inoequipos_sea where ca_referencia = '$id'")) {
                     echo "<script>alert(\"".addslashes($eq->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     echo "<script>document.location.href = 'confirmaciones.php';</script>";
                     exit; }
                 $equipos = "<table width=100% cellspacing=1 border=1>\n";
                 $equipos.= "<th colspan=4>Relación de Contenedores</th>\n";
                 $equipos.= "<tr><th>Concepto</th><th>Cantidad</th><th>ID Equipo</th><th>Observaciones</th></tr>\n";
                 while (!$eq->Eof() and !$eq->IsEmpty()) {
                    $equipos.= "<tr><td>".$eq->Value('ca_concepto')."</td><td>".$eq->Value('ca_cantidad')."</td><td>".$eq->Value('ca_idequipo')."</td><td>".$eq->Value('ca_observaciones')."&nbsp</td></tr>\n";
                    $eq->MoveNext();
                 }
                 $equipos.= "</table>\n";
             } else {
                 $equipos = "";
             }

             for ($i=0; $i < count($oid); $i++) {
                $correo = "em_".$oid[$i];
                $confirmar = isset($$correo)?implode(",",$$correo):"";
                $personal = 'mensaje_'.$oid[$i];
				$tipo = 'tipo_'.$oid[$i];
				$ciudad = 'ciudad_dest_'.$oid[$i];
				$fecha = 'fchllegada_'.$oid[$i];
				$bodega = 'bodega_'.$oid[$i];

                if (!$rs->Open("select * from vi_inoclientes_sea where ca_oid = ".$oid[$i])) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'confirma_otm.php';</script>";
                    exit;
                    }
                $id_etapa = (($$tipo == 'Status')?"16":($$tipo == 'Cierre')?"21":"20");
                if (!$rp->Open("update tb_reportes set ca_etapa_actual = (select ca_valor from tb_parametros where ca_casouso = 'CU045' and ca_identificacion = $id_etapa) where ca_consecutivo = '".$rs->Value('ca_consecutivo')."' and ca_version = (select max(ca_version) from tb_reportes where ca_consecutivo = '".$rs->Value('ca_consecutivo')."')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'confirmaciones.php';</script>";
                    exit;
                    }
                $asunto = (($$tipo == 'Status')?"Status de":(($$tipo == 'Cierre')?"Cierre Documental":"Confirmación Llegada"))." Carga en ".$rs->Value('ca_continuacion')." - Destino: ".$$ciudad;
				
                $mensaje = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><HTML><HEAD><META http-equiv=Content-Type content=\"text/html; charset=iso-8859-1\"><META content=\MSHTML 6.00.2800.1106\ name=GENERATOR></HEAD>\n";
                $mensaje.= "Señores:<br />\n";
                $mensaje.= "<b>".strtoupper($rs->Value('ca_compania'))."</b><br /><br />\n";

				$mensaje.="<TABLE WIDTH=100% CELLSPACING=1 BORDER=1>\n";
				$mensaje.="<TR>\n";
				$mensaje.="  <TD COLSPAN=6>".nl2br($intro_body)."</TD>\n";
				$mensaje.="</TR>\n";

				if ( $rs->Value('ca_numorden')!='' ) {
					$mensaje.="<TR>\n";
					$mensaje.="  <TD><B>Orden :</B></TD>\n";
					$mensaje.="  <TD COLSPAN=5>".$rs->Value('ca_numorden')."</TD>\n";
					$mensaje.="</TR>\n"; }

				$mensaje.="<TR>\n";
				$mensaje.="  <TD><B>Proveedor :</B></TD>\n";
				$mensaje.="  <TD COLSPAN=5>".$rs->Value('ca_proveedor')."</TD>\n";
				$mensaje.="</TR>\n";

				$mensaje.="<TR>\n";
				$mensaje.="  <TD><B>Origen :</B></TD>\n";
				$mensaje.="  <TD>".$rf->Value('ca_ciuorigen')."</TD>\n";
				$mensaje.="  <TD><B>Fch.Salida :</B></TD>\n";
				$mensaje.="  <TD>".$rf->Value('ca_fchembarque')."</TD>\n";
				$mensaje.="  <TD><B>Nombre del Buque :</B></TD>\n";
				$mensaje.="  <TD>".$rf->Value('ca_mnllegada')."</TD>\n";
				$mensaje.="</TR>\n";

				$mensaje.="<TR>\n";
				$mensaje.="  <TD><B>Destino :</B></TD>\n";
				$mensaje.="  <TD>".$rf->Value('ca_ciudestino')."</TD>\n";
				$mensaje.="  <TD><B>Fch.Llegada :</B></TD>\n";
				$mensaje.="  <TD>".$rf->Value('ca_fchconfirmacion')."\n<b>Hora: </b> ".$rf->Value('ca_horaconfirmacion')."</TD>\n";
				$mensaje.="  <TD><B>Destino Final :</B></TD>\n";
				$mensaje.="  <TD>".$$ciudad."</TD>\n";
				$mensaje.="</TR>\n";

                if ($$tipo == 'Confirmación'){
				    $idbodega= explode("|", $$bodega);
					$mensaje.="<TR>\n";
					$mensaje.="  <TD><B>No. HBL :</B></TD>\n";
					$mensaje.="  <TD>".$rs->Value('ca_hbls')."</TD>\n";
					$mensaje.="  <TD><B>Bodega :</B></TD>\n";
					$mensaje.="  <TD>".$idbodega[1]."</TD>\n";
					$mensaje.="  <TD><B>Fch.Llegada :</B></TD>\n";
					$mensaje.="  <TD>".$$fecha."</TD>\n";
					$mensaje.="</TR>\n";
				}

				$mensaje.="<TR>\n";
				$mensaje.="  <TD><B>No.Piezas :</B></TD>\n";
				$mensaje.="  <TD>".$rs->Value('ca_numpiezas')."</TD>\n";
				$mensaje.="  <TD><B>Volumen :</B></TD>\n";
				$mensaje.="  <TD>".$rs->Value('ca_volumen')."</TD>\n";
				$mensaje.="  <TD><B>Peso :</B></TD>\n";
				$mensaje.="  <TD>".$rs->Value('ca_peso')."</TD>\n";
				$mensaje.="</TR>\n";

				$$personal = nl2br($$personal);
				if ($$tipo == 'Status' or $$tipo == 'Cierre'){
                 	$st =& DlRecordset::NewRecordset($conn);
					if (!$st->Open("select * from tb_inoavisos_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_hbls = '".$rs->Value('ca_hbls')."' and nullvalue(ca_idbodega) order by ca_fchenvio DESC")) {
						echo "<script>alert(\"".addslashes($st->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'confirma_otm.php';</script>";
						exit;
						}
					$status = "<table width=100% cellspacing=1 border=1>\n";
					$status.= "<th colspan=4>Status de la Carga</th>\n";
					$status.= "<tr><th>Fecha</th><th>Status</th><th>Enviado</th></tr>\n";
					$status.= "<tr><td>".date("Y-M-d")."</td><td>".$$personal."</td><td>".date("Y-M-d H:i:s")."</td></tr>\n";
					while (!$st->Eof() and !$st->IsEmpty()) {
						$status.= "<tr><td>".$st->Value('ca_fchaviso')."</td><td>".$st->Value('ca_aviso')."</td><td>".$st->Value('ca_fchenvio')."</td></tr>\n";
						$st->MoveNext();
						}
					$status.= "</table>\n";
					if (strlen($status) != 0){
						$mensaje.="<TR>\n";
						$mensaje.="  <TD COLSPAN=6>".$status."</TD>\n";
						$mensaje.="</TR>\n";
					}
				}

				if (strlen($equipos) != 0){
					$mensaje.="<TR>\n";
					$mensaje.="  <TD COLSPAN=6>".$equipos."</TD>\n";
					$mensaje.="</TR>\n";
				}
				if ($$tipo == 'Confirmación' and strlen($$personal) != 0){
					$mensaje.="<TR>\n";
					$mensaje.="  <TD COLSPAN=6>".$$personal."</TD>\n";
					$mensaje.="</TR>\n";
				}

				$mensaje.="</TABLE>\n";
                $mensaje.= $email_body."<br><br>";
                $mensaje.= "Gracias por contar con nuestro servicio.<br><br>";
                $mensaje.= "Cordial Saludo.<br><br><br>";
                $mensaje.= "<b>".strtoupper($us->Value('ca_nombre'))."</b><br>";
                $mensaje.= $us->Value('ca_cargo')."<br>";
                $mensaje.= "COLTRANS S.A.<br>";
                $mensaje.= $us->Value('ca_direccion')."<br>";
                $mensaje.= "Tel.:".$us->Value('ca_telefono')." ".$us->Value('ca_extension')."<br>";
                $mensaje.= "Fax :".$us->Value('ca_fax')."<br>";
                $mensaje.= $us->Value('ca_sucursal')." - Colombia<br>";
                $mensaje.= $us->Value('ca_email')."<br>";
                $mensaje.= "www.coltrans.com.co<br>";
				$mensaje = AddSlashes($mensaje);

				$subtit = ($$tipo == 'Status')?"StatusCargaOTM":(($$tipo == 'Cierre')?"CierreDocumentos":"Conf.LlegadaOTM");
				if (!$rs->Open("select nextval('tb_emails_id')")) {
					echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
					echo "<script>document.location.href = 'traficos_sea.php';</script>";
					exit;
				}
				$id_email = $rs->Value('nextval');
				if (!$rs->Open("insert into tb_emails (ca_idemail, ca_fchenvio, ca_usuenvio, ca_tipo, ca_idcaso, ca_from, ca_fromname, ca_cc, ca_replyto, ca_address, ca_attachment, ca_subject, ca_body) values($id_email, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario', '$subtit', '".$oid[$i]."', '".$us->Value('ca_email')."', '".$us->Value('ca_nombre')."', '', '".$us->Value('ca_email')."', '$confirmar', '', '$asunto', '$mensaje')")) {
					echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
					echo "<script>document.location.href = 'confirma_otm.php';</script>";
					exit;
				}
				if ( array_key_exists("attachment", $files_attached) ){
					$file_attached = $files_attached["attachment"];
					if (!$rs->Open("insert into tb_attachments (ca_idemail, ca_extension, ca_header_file, ca_filesize, ca_content) values('$id_email', '".$file_attached['extension']."', '".$file_attached['uploadfile']."', '".filesize($file_attached['file_real'])."', '".${$file_attached['content_var']}."')")) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'traficos_sea.php';</script>";
						exit;
					}
				}
				if ( array_key_exists("attachment_".$oid[$i], $files_attached) ){
					$file_attached = $files_attached["attachment_".$oid[$i]];
					if (!$rs->Open("insert into tb_attachments (ca_idemail, ca_extension, ca_header_file, ca_filesize, ca_content) values('$id_email', '".$file_attached['extension']."', '".$file_attached['uploadfile']."', '".filesize($file_attached['file_real'])."', '".${$file_attached['content_var']}."')")) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'traficos_sea.php';</script>";
						exit;
					}
				}
				
				if ($$tipo == 'Status' or $$tipo == 'Cierre'){
					if (!$rs->Open("insert into tb_inoavisos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_idemail, ca_fchaviso, ca_aviso, ca_fchenvio, ca_usuenvio) select ca_referencia, ca_idcliente, ca_hbls, $id_email, '".date("Y-M-d")."', '".$$personal."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_inoclientes_sea where oid = ".$oid[$i])) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'confirma_otm.php';</script>";
						exit;
						}
				}else{
					if (!$rs->Open("insert into tb_inoavisos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_idemail, ca_fchaviso, ca_aviso, ca_idbodega, ca_fchllegada, ca_fchenvio, ca_usuenvio) select ca_referencia, ca_idcliente, ca_hbls, $id_email, '".date("Y-M-d")."', '".$$personal."', ".$idbodega[0].", '".$$fecha."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario' from tb_inoclientes_sea where oid = ".$oid[$i])) {
						echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
						echo "<script>document.location.href = 'confirma_otm.php';</script>";
						exit;
						}
				}
				enviar_email($mail, $rs, $id_email, $i, $_FILES);                                           // Llamado a la función que envia los emails
                }
            break;
           }
        }
    echo "<script>document.location.href = 'confirma_otm.php';</script>";  // Retorna a la pantalla principal de la opción
  }

function enviar_email(&$mail, &$rs, $id, &$i, &$attachment){
    if (!$rs->Open("select * from vi_emails e FULL OUTER JOIN tb_attachments a ON (e.ca_idemail = a.ca_idemail) where e.ca_idemail = $id")) {
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
        echo "<script>document.location.href = 'confirmaciones.php';</script>";
        exit;
       }
    $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
	$domin = chr(100-36)."coltrans.com.co";
	$name  = "tasas_cambios".$domin;
	$pass  = "tasas_cambios";

    $mail->IsSMTP();              // set mailer to use SMTP
	$mail->Host = "10.192.1.30";   // specify main and backup server
    $mail->SMTPAuth = true;       // turn on SMTP authentication

	$mail->From = $rs->Value('ca_from');
	$mail->FromName = $rs->Value('ca_fromname');
	if ($i == 0){
		$mail->AddCC($rs->Value('ca_from'), $rs->Value('ca_fromname'));
		$mail->AddReplyTo($rs->Value('ca_from'), $rs->Value('ca_fromname'));
	}

    $mail->Username = $name ;
    $mail->Password = $pass;

    $mail->WordWrap = 50;
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = $rs->Value('ca_subject');
    $mail->Body    = $rs->Value('ca_body');
    $mail->AltBody = "«« Este mensaje está en formato HTML pero el equipo no está configurado para mostrarlo automáticamente. Active la opción HTML del menú Ver en su cliente de correo electrónico para una correcta visualización.>>";
	
    $mail->ClearAllRecipients();
	$mail->ClearAttachments();

    $mail->AddAddress($rs->Value('ca_from'), $rs->Value('ca_fromname'));
    $send_it = false;
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
	$att_mem = false;
	do {
		if ($rs->Value('ca_idattachment') != null){
			$att_mem = true;
			foreach($attachment as $key => $file_attached){
				if ($rs->Value('ca_header_file') == $file_attached['name']){
					$mail->AddAttachment(str_replace(chr(92),'/',$file_attached['tmp_name']), $file_attached['name']);
				}
			}
		}
		$rs->MoveNext();
	} while( !$rs->Eof() );

	if ($att_mem){
		$mail->AttachAll();
	}

    if ($send_it) {
        if(!$mail->Send()) {
            echo "<script>alert(\"".addslashes($mail->ErrorInfo)."\");</script>";  // Muestra el mensaje de error
            echo "<script>document.location.href = 'confirmaciones.php';</script>";
            exit;
        }
	}
}
?>