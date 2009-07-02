<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       TRAFICOS_AIR.PHP                                            \\
// Creado:        2005-04-20                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2005-06-01                                                  \\
//                                                                            \\
// Descripción:   Módulo para el control de Negocios Aéreos.                  \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Módulo de Tráficos';
$columnas = array("Número de Reporte"=>"ca_consecutivo", "Fecha del Reporte"=>"ca_fchreporte", "Nombre del Cliente"=>"ca_nombre_cli", "Nombre del Proveedor"=>"ca_nombre_pro", "No.Orden Proveedor"=>"ca_orden_prov", "No.Orden Cliente"=>"ca_orden_clie", "No. Cotización"=>"ca_idcotizacion", "Descripción Mercancia"=>"ca_mercancia_desc");                        // Arreglo con las opciones de busqueda
$tpiezas = array("Bultos","Cajas","Cartones","Pallets","Patines","Piezas","Rollos","Sacos","Tambores");
$tpesos  = array("Kilos");
$tvolumen= array("Kilos/Volumen");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php");                                                               // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>document.location.href = 'entrada.php';</script>";
   }

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "  document.location.href = 'traficos_air.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
    echo "}";
    echo "function habilitar(){";
    echo "  source = document.getElementById('opcion');";
    echo "  if (source.selectedIndex==0){";
    echo "      document.getElementById('fch_ini').style.visibility = \"visible\";";
    echo "      document.getElementById('fch_fin').style.visibility = \"visible\";";
    echo "  }else{";
    echo "      document.getElementById('fch_ini').style.visibility = \"hidden\";";
    echo "      document.getElementById('fch_fin').style.visibility = \"hidden\";";
    echo "  }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='traficos_air.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=6 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp;</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=5 ONCHANGE='habilitar();'>";
	$sel_mem = " SELECTED";
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."' $sel_mem>".$clave;
		$sel_mem = "";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' VALUE='$cadena' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar><DIV ID=fch_ini>Fecha Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></DIV></TD>";
    echo "  <TD Class=listar><DIV ID=fch_fin>Fecha Final :<BR><INPUT TYPE='TEXT' NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></DIV></TD>";
    echo "  <TD Class=listar WIDTH=150></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
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
    SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    $condicion = 'where ';
    if ($opcion == 'ca_fchreporte'){
        $condicion.= "$opcion between '$fchinicial' and '$fchfinal' and";
    }else if (isset($criterio) and strlen(trim($criterio)) != 0) {
        if ($opcion == 'ca_consecutivo' or $opcion == 'ca_nombre_cli' or $opcion == 'ca_nombre_pro' or $opcion == 'ca_orden_prov' or $opcion == 'ca_orden_clie' or $opcion == 'ca_idcotizacion' or $opcion == 'ca_mercancia_desc') {
            $condicion.= "lower($opcion) like lower('%".$criterio."%') and";
        }
    }
    if (!$rs->Open("select * from vi_reportes $condicion ca_transporte = 'Aéreo'")) {                       // Selecciona todos lo registros de la tabla Ino-Aéreo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'traficos_air.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='traficos_air.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=4>COLTRANS S.A.<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>ID Reporte</TH>";
    echo "<TH>Versión</TH>";
    echo "<TH>Trayecto</TH>";
    $consecutivo = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       echo "<TR>";
       if ($consecutivo <> $rs->Value('ca_consecutivo')){
            echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;'>".$rs->Value('ca_consecutivo')."</TD>";
            $consecutivo = $rs->Value('ca_consecutivo');
       }else {
            echo "  <TD Class=listar ROWSPAN=2></TD>";
       }
       echo "  <TD Class=listar ROWSPAN=2 onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"traficos_air.php?boton=Consultar\&id=".$rs->Value('ca_idreporte')."\";'>No.&nbsp;".$rs->Value('ca_version')."</TD>";
       echo "  <TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_nombre_cli')." (".$rs->Value('ca_transporte')." - ".$rs->Value('ca_modalidad').")</TD>";
       echo "</TR>";
       echo "<TR>";
       echo " <TD Class=listar>";
       echo "  <TABLE WIDTH=500 CELLSPACING=1>";
       echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Despacho</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>T.Incoterms</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Cotización</TD>";
       echo "  <TD Class=invertir style='font-weight:bold;'>Reporte</TD><TR>";
       echo "    <TD Class=listar>".$rs->Value('ca_ciuorigen')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_traorigen')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_ciudestino')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_tradestino')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_fchdespacho')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_incoterms')."</TD>";
       echo "    <TD Class=listar>".$rs->Value('ca_idcotizacion')."</TD>";
       echo "    <TD Class=listar></TD>";
       echo "  </TABLE>";
       echo " </TD>";
       echo "</TR>";
       echo "<TR HEIGHT=5>";
       echo "  <TD Class=invertir COLSPAN=4></TD>";
       echo "</TR>";
       $rs->MoveNext();
       }
    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"traficos_air.php\"'></TH>";  // Cancela la operación
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
             $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Aéreo
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $fch_mem = ($rs->Value('ca_fchactualizado')!='')?$rs->Value('ca_fchactualizado'):$rs->Value('ca_fchcreado');
             list($anno, $mes, $dia, $hor, $min, $seg) = sscanf($fch_mem,"%d-%d-%d %d:%d:%d");

             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id){";
             echo "    document.location.href = 'traficos_air.php?boton='+opcion+'\&id='+id;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<H3>$titulo</H3>";
             echo "<FORM METHOD=post NAME='adicionar' ACTION='traficos_air.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
             datos_basicos($rs,$tm);

             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_emails where ca_tipo = 'Rep.AéreoExterior' and ca_idcaso in (select ca_idreporte from tb_reportes where ca_consecutivo in (select ca_consecutivo from tb_reportes where ca_idreporte = '$id')) order by ca_fchenvio DESC")) { // Selecciona todos lo registros de la tabla Emails
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'traficos_sea.php';</script>";
                exit; }
             echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=6>Reporte Aéreo al Exterior</TH>";
             echo "</TR>";
             echo "<TH WIDTH=80>Usuario</TH>";
             echo "<TH WIDTH=300>Asunto</TH>";
             echo "<TH>Enviado</TH>";
             echo "<TH WIDTH=35><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Email\", \"".$rs->Value('ca_idreporte')."\");'></TH>";  // Botón para la creación de un Registro Nuevo
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
             echo "</TABLE><BR>";

             echo "<TABLE WIDTH=620 CELLSPACING=1>";                                   // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TD Class=invertir style='text-align:center; font-weight:bold;' COLSPAN=6>Relación de Status Enviados</TD>";
             echo "</TR>";
            
             echo "<TR HEIGHT=5>";
             echo "  <TD Class=invertir COLSPAN=6 align='center'> <div align='center'><a  HREF='#' onClick=window.open('/traficos/verHistorialStatus/idreporte/".$id."')>HAGA CLICK ACA</a></div></TD>";
             echo "</TR>";
             echo "</TABLE><BR>";

             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"traficos_air.php\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</FORM>";
             echo "</CENTER>";
//           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
             require_once("footer.php");
echo "</BODY>";
             echo "</HTML>";
             break;
             }
        case 'Imprimir': {                                                    // Opcion para Consultar un solo registro
             $modulo = "00100100";                                             // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                             // Control de Acceso al módulo
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<TABLE CELLSPACING=1 WIDTH='830' HEIGHT='650'>";
             echo "<TR>";
             echo "  <TD Class=invertir><iframe ID=consulta_tar src ='reporteneg.php?id=$id' width='100%' height='100%'></iframe></TD>";
             echo "</TR>";
             echo "</TABLE>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"traficos_air.php?boton=Consultar&id=$id\"'></TH>";  // Cancela la operación
             echo "</TABLE>";
             echo "</CENTER>";
             break;
             }
        case 'Email': {                                                    // Opcion para Consultar un solo registro
             $modulo = "00100100";                                         // Identificación del módulo para la ayuda en línea
//           include_once 'include/seguridad.php';                         // Control de Acceso al módulo
             if (!$rs->Open("select * from vi_reportes where ca_idreporte = $id")) {                       // Selecciona todos lo registros de la tabla Ino-Aéreo
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $gs =& DlRecordset::NewRecordset($conn);                      // Apuntador que permite manejar la conexiòn a la base de datos
             if (!$gs->Open("select * from vi_repgastos where ca_idreporte = $id and ca_tiporecargo = 'Recargo en Origen'")) {  // Selecciona todos lo registros de la tabla Recargos
                 echo "<script>alert(\"".addslashes($gs->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm =& DlRecordset::NewRecordset($conn);                      // Apuntador que permite manejar la conexiòn a la base de datos

             $contenido ="<TABLE WIDTH=100% CELLSPACING=1 BORDER=1>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=4><CENTER><B>AIRFREIGHT BUSINESS REPORT</B></CENTER></TD>\n";
             $contenido.="</TR>\n";

             if (!$tm->Open("select * from vi_terceros where ca_idtercero in (".str_replace("|",",",$rs->Value('ca_idproveedor')).")")) {
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                 echo "<script>document.location.href = 'traficos_air.php';</script>";
                 exit;
                }
             $tm->MoveFirst();

             $ordenes = array_combine(explode("|",$rs->Value('ca_idproveedor')), explode("|",$rs->Value('ca_orden_prov')));
             while (!$tm->Eof()) {
                 $contenido.="<TR>\n";
                 $contenido.="  <TD WIDTH=26%><B>SHIPPER ".(($tm->GetRowCount()>1)?"# ".$tm->GetCurrentRow():"").":</B></TD>\n";
                 $contenido.="  <TD WIDTH=74% COLSPAN=3>".$tm->Value('ca_nombre')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>ADDRESS :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$tm->Value('ca_direccion')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>PHONE :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$tm->Value('ca_telefonos')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>FAX :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$tm->Value('ca_fax')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>CONTACT :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$tm->Value('ca_contacto')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>E-MAIL :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$tm->Value('ca_email')."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD><B>SHIPPER ORDER :</B></TD>\n";
                 $contenido.="  <TD COLSPAN=3>".$ordenes[$tm->Value('ca_idtercero')]."</TD>\n";
                 $contenido.="</TR>\n";
                 $contenido.="<TR>\n";
                 $contenido.="  <TD COLSPAN=4>&nbsp;</TD>\n";
                 $contenido.="</TR>\n";
                 $tm->MoveNext();
             }

             $contenido.="<TR>\n";
             $contenido.="  <TD><B>CLIENT ORDER :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_orden_clie')."</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>INCOTERMS :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_incoterms')."</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>ORIGEN :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_ciuorigen')."</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>CARGO AVAILABLE :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_fchdespacho')."</TD>\n";
             $contenido.="</TR>\n";
             if ($rs->Value('ca_idlinea') != 0){
                $contenido.="<TR>\n";
                $contenido.="  <TD STYLE=\"vertical-align:top\"><B>AIRLINE:</B></TD>\n";
                $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_nombre')."</TD>\n";
                $contenido.="</TR>\n";
             }

			 if ($rs->Value('ca_idmaster') != 0){
	             $master = $rs->Value('ca_nombre_mas')."<BR>".$rs->Value('ca_contacto_mas')."<BR>Dirección: ".$rs->Value('ca_direccion_mas')."<BR>Teléfonos:".$rs->Value('ca_telefonos_mas')." Fax:".$rs->Value('ca_fax_mas')."<BR>Email: ".$rs->Value('ca_email_mas');
			 }else {
				 if (!$tm->Open("select cl.ca_idcliente, cl.ca_digito, cl.ca_compania, sc.ca_direccion, sc.ca_telefono, sc.ca_fax, sc.ca_nombre, cl.ca_pais from vi_clientes cl LEFT OUTER JOIN control.tb_sucursales sc ON (sc.ca_nombre = '".$rs->Value('ca_ciudestino')."') where ca_compania = 'COLTRANS S.A.'")) { // Selecciona todos los Datos de Coltrans / Sucursal
					 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
					 echo "<script>document.location.href = 'entrada.php';</script>";
					 exit; }
				 $master = $tm->Value('ca_compania')." Nit. ".number_format($tm->Value('ca_idcliente'),0)."-".$tm->Value('ca_digito')."<BR>".$tm->Value('ca_direccion')."<BR>Teléfonos:".$tm->Value('ca_telefono')." Fax:".$tm->Value('ca_fax')."<BR>".$tm->Value('ca_nombre')." - ".$tm->Value('ca_pais');
			 }

			 $consignatario_final = ($rs->Value('ca_idconsignatario')!=0)?$rs->Value('ca_nombre_con')." Nit. ".$rs->Value('ca_identificacion_con')."<BR>".$rs->Value('ca_contacto_con')."<BR>".$rs->Value('ca_direccion_con'):$rs->Value('ca_nombre_cli')." Nit. ".number_format($rs->Value('ca_idcliente'),0)."-".$rs->Value('ca_digito')."<BR>".$rs->Value('ca_contacto_cli')."<BR>".str_replace ("|"," ",$rs->Value('ca_direccion_cli'));
			 $hijo = (($rs->Value('ca_idconsignar')==1)?$consignatario_final:$rs->Value('ca_consignar'))." / ".$rs->Value('ca_tipobodega')." ".(($rs->Value('ca_bodega')!='N/A')?$rs->Value('ca_bodega'):"").(($rs->Value('ca_continuacion') == 'N/A')?"<BR>".$rs->Value('ca_ciudestino'):"")."<BR>".$tm->Value('ca_pais');

			 if ($rs->Value('ca_notify') == 0)
	             $consignatario_h = $rs->Value('ca_nombre_cli')."<BR>".$rs->Value('ca_contacto_cli')."<BR>".str_replace ("|"," ",$rs->Value('ca_direccion_cli'))."<BR>".$tm->Value('ca_pais');
			 else if ($rs->Value('ca_notify') == 1)
	             $consignatario_h = $rs->Value('ca_nombre_con')."<BR>".$rs->Value('ca_contacto_con')."<BR>".$rs->Value('ca_direccion_con');
			 else if ($rs->Value('ca_notify') == 2)
	             $consignatario_h = $rs->Value('ca_nombre_not')."<BR>".$rs->Value('ca_contacto_not')."<BR>".$rs->Value('ca_direccion_not');

             if ($rs->Value('ca_mastersame') == 'Sí'){
                $master = $hijo;
             }
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=4>&nbsp;</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=3><CENTER><B>MAWB INSTRUCTIONS</B></CENTER></TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD STYLE=\"vertical-align:top\"><B>CONSIGNED TO:</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>$master</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>FINAL DESTINATION:</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_ciudestino')."</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>NATURE OF GOODS :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>CONSOLIDATION AS PER ATTACHED CARGO MANIFEST.</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=4>&nbsp;</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=3><CENTER><B>HAWB INSTRUCTIONS</B></CENTER></TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD STYLE=\"vertical-align:top\"><B>CONSIGNED TO:</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>$hijo</TD>\n";
             $contenido.="</TR>\n";
			 if (strlen($consignatario_h) != 0){
				 $contenido.="<TR>\n";
				 $contenido.="  <TD STYLE=\"vertical-align:top\"><B>NOTIFY:</B></TD>\n";
				 $contenido.="  <TD COLSPAN=3>$consignatario_h</TD>\n";
				 $contenido.="</TR>\n"; }
			 if ($rs->Value('ca_continuacion') != 'N/A'){
				$contenido.="<TR>\n";
				$contenido.="  <TD><B>FINAL DESTINATION:</B></TD>\n";
				$contenido.="  <TD COLSPAN=3>".$rs->Value('ca_final_dest')."</TD>\n";
				$contenido.="</TR>\n"; }
             $contenido.="<TR>\n";
             $contenido.="  <TD><B>NATURE GOODS :</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>".$rs->Value('ca_mercancia_desc')."</TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD STYLE=\"vertical-align:top\"><B>FREIGHT:</B></TD>\n";
             $contenido.="  <TD COLSPAN=3>AS AGREED</TD>\n";
             $contenido.="</TR>\n";

             if (!$tm->Open("select * from vi_reptarifas where ca_idreporte = $id")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $tm->MoveFirst();
             $contenido.="<TR>\n";
             $contenido.="  <TD BGCOLOR=\"#CCCCCC\" COLSPAN=4><CENTER><B>SELLING RATES</B></CENTER></TD>\n";
             $contenido.="</TR>\n";
             $contenido.="<TR>\n";
             $contenido.="  <TD COLSPAN=4><TABLE BORDER=1 CELLSPACING=1 WIDTH=100%>\n";
             while (!$tm->Eof() and !$tm->IsEmpty()) {
                 $sub_conte ="<TABLE BORDER=1 CELLSPACING=0 WIDTH=100%>\n";
				 $sub_conte.="<TR>\n";
                 if ($tm->Value('ca_reportar_tar') > 0){
					$sub_conte.="  <TD BGCOLOR=\"#CCCCCC\"><B>Selling Rate :</B><BR>".number_format($tm->Value('ca_reportar_tar'),2)." ".$tm->Value('ca_reportar_idm')."</TD>\n";
                 }
                 if ($tm->Value('ca_reportar_min') > 0){
					$sub_conte.="  <TD BGCOLOR=\"#CCCCCC\"><B>Minimum :</B><BR>".number_format($tm->Value('ca_reportar_min'),2)." ".$tm->Value('ca_reportar_idm')."</TD>\n";
                 }
/*
                 if (strlen($tm->Value('ca_observaciones'))!=0){
					$sub_conte.="  <TD BGCOLOR=\"#CCCCCC\"><B>Details :</B><BR>".$tm->Value('ca_observaciones')."</TD>\n";
                 }
*/
				 $sub_conte.="</TR>\n";
				 $sub_conte.="</TABLE>\n";

                 $con_mem = "<B>Airfreight :</B><BR>".$tm->Value('ca_concepto').(($tm->Value('ca_cantidad')>0)?" [Cant.: ".formatNumber($tm->Value('ca_cantidad'),3)."]":"");
				 $contenido.="<TR>\n";
                 $contenido.="  <TD STYLE=\"vertical-align:bottom\" BGCOLOR=\"#CCCCCC\" WIDTH=30%>$con_mem</B></TD>\n";
                 $contenido.="  <TD STYLE=\"vertical-align:bottom\" BGCOLOR=\"#CCCCCC\" WIDTH=70%>$sub_conte</TD>\n";
                 $contenido.="</TR>\n";
                 $tm->MoveNext();
             }
             $contenido.="</TABLE>\n";

             $compressed= gzcompress($contenido, 9);
             session_start("mail");
			 $_SESSION["BodyMail"] = $compressed ;
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (document.email.asunto.value == '')";
             echo "      alert('El campo Asunto no es válido');";
             echo "  else{";
             echo "      i=0;";
             echo "      respuesta = false;";
             echo "      while (isNaN(document.getElementById('addess_'+i))) {";
             echo "         elemento = document.getElementById('addess_'+i);";
             echo "         if (elemento.type == 'checkbox'){";
             echo "             respuesta=(elemento.checked)?true:respuesta;";
             echo "         }else if(elemento.type == 'text'){";
             echo "             respuesta=(elemento.value.length > 1)?true:respuesta;";
             echo "         }";
             echo "         i++;";
             echo "      }";
             echo "      if (!respuesta){";
             echo "         alert('No ha especificado un destintario de Correo Electrónico');";
             echo "      }";
             echo "      return (respuesta);";
             echo "  }";
             echo "  return (false);";
             echo "}";
             echo "function terceros(ventana, sufijo, target){";
             echo "  document.body.scroll='no';";
             echo "  frame = document.getElementById(ventana + '_frame');";
             echo "  frame.style.height = document.body.clientHeight-16;";
             echo "  ventana = document.getElementById(ventana);";
             echo "  ventana.style.visibility = 'visible';";
             echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
             echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
             echo "  frame.src=target+'.php?suf='+sufijo;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; find_texts.style.top=dalt'>";
             echo "<DIV ID='find_texts' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
             echo "<IFRAME ID='find_texts_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<FORM METHOD=post NAME='email' ACTION='traficos_air.php' ONSUBMIT='return validar();' enctype='multipart/form-data'>";
             echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='$id'>";
             echo "<CENTER>";
             echo "<TABLE BORDER=0 CELLSPACING=1 WIDTH=600 CELLPADDING=3>";
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=4>Servicio de Mensajes en Línea de Coltrans</TH>";
             echo "</TR>";
             if (!$tm->Open("select * from vi_usuarios where ca_login = '$usuario'")) {                        // Selecciona todos lo registros de la tabla Usuarios
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             $firma = chr(13).chr(13).strtoupper($tm->Value('ca_nombre')).chr(13).$tm->Value('ca_cargo').chr(13)."COLTRANS S.A.".chr(13).$tm->Value('ca_direccion').chr(13)."Tel.:".$tm->Value('ca_telefono')." ".$tm->Value('ca_extension').chr(13)."Fax :".$tm->Value('ca_fax').chr(13).$tm->Value('ca_sucursal')." - Colombia".chr(13).$tm->Value('ca_email').chr(13)."www.coltrans.com.co";
             echo "<TR>";
             echo "  <TD Class=captura WIDTH=120>Nombre Remitente :</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='remitente' READONLY SIZE=40 VALUE='".$tm->Value('ca_nombre')."' MAXLENGTH=90></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Correo Remitente :</TD>";
             echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='recorreo' READONLY SIZE=40 VALUE='".$tm->Value('ca_email')."' MAXLENGTH=90></TD>";
             echo "</TR>";
             if (!$tm->Open("select ca_nombre, ca_email from vi_contactos where ca_idagente = '".$rs->Value('ca_idagente')."' and ca_impoexpo like '%".$rs->Value('ca_impoexpo')."%' and ca_transporte like '%".$rs->Value('ca_transporte')."%'")) { // Selecciona todos lo registros de la tabla Agentes
                 echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";                   // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<TR>";
             echo "  <TD Class=captura>Destinatarios</TD>";
             echo "  <TD Class=listar><TABLE WIDTH=100% CELLSPACING=1 BORDER=1>";
             echo "     <TH>Contacto Agente</TH>";
             echo "     <TH>Contacto Cliente</TH>";
             echo "     <TH>Enviar Copia a</TH>";
             echo "     <TR>";
             echo "     <TD Class=invertir>";
                  $j=0;
                  $tm->MoveFirst();
                  while (!$tm->Eof() and !$tm->IsEmpty()) {
                     echo "<INPUT ID=addess_$j TYPE=CHECKBOX NAME='contactos_ag[]' VALUE='".$tm->Value('ca_email')."'>".$tm->Value('ca_nombre')."<BR>";
                     $tm->MoveNext();
                     $j++;
                  }
             echo "     </TD>";
             echo "     <TD Class=invertir>";
/*
                  $emails = array_filter(explode(",", $rs->Value('ca_confirmar_clie')), "vacios");
                  while (list ($clave, $val) = each ($emails)) {
                     echo "<INPUT ID=addess_$j TYPE=CHECKBOX NAME='contactos_co[]' VALUE='$val'>$val<BR>";
                     $j++;
                  }
*/
             echo "     </TD>";
             echo "     <TD Class=invertir>";
                  for ($i=0; $i<5; $i++){
                     echo "<INPUT ID=addess_$j Class=field TYPE='TEXT' NAME='contactos_cc[]' VALUE=' ' SIZE=40 MAXLENGTH=50><BR>";
                  }
             echo "     </TD>";
             echo "     </TR>";
             echo "  </TABLE></TD>";
             echo "</TR>";            
             echo "<TR>";
             echo "  <TD Class=captura>Etapa :</TD>";
			 echo "  <TD Class=listar COLSPAN=2>Contacto con Nuestro Agente</TD>";	 
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura>Asunto :</TD>";
             echo "  <TD Class=listar colspan=2><INPUT TYPE='TEXT' NAME='asunto' SIZE=90 VALUE='".$rs->Value('ca_nombre_pro')." / ".$rs->Value('ca_nombre_cli')." [".$rs->Value('ca_ciuorigen')." -> ".$rs->Value('ca_ciudestino')."]  Id.: ".$rs->Value('ca_consecutivo')."' MAXLENGTH=255></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=captura ROWSPAN=4 STYLE='vertical-align:top'>Mensaje :</TD>";
             echo "  <TD Class=listar COLSPAN=2>Introducción al mensaje:<BR><TEXTAREA NAME='mensaje[]' WRAP=virtual ROWS=3 COLS=88></TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar STYLE='vertical-align:top'>$contenido</TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Instrucciones Especiales para el Agente:&nbsp;<IMG src='graficos/cerrado.gif' ALT='Click para incluir textos predefinidos' ONCLICK='terceros(\"find_texts\",\"Instructions_air\",\"ventanas\");'><BR><TEXTAREA ID=instrucciones NAME='mensaje[]' WRAP=virtual ROWS=5 COLS=88>".$rs->Value('ca_instrucciones')."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Adjuntar Documento: <BR><INPUT TYPE='FILE' NAME='attachment' SIZE=70></TD>";
             echo "</TR>";
             echo "<TR>";
             echo "  <TD Class=listar COLSPAN=2>Comentarios Adicionales:<BR><TEXTAREA NAME='mensaje[]' WRAP=virtual ROWS=3 COLS=88>Thks+Rgds,".$firma."</TEXTAREA></TD>";
             echo "</TR>";
             echo "<TH Class=titulo><INPUT TYPE='BUTTON' NAME='accion' VALUE='Cancelar ' ONCLICK='javascript:document.location.href = \"traficos_air.php?boton=Consultar\&id=$id\"'></TH>";
             echo "<TH Class=titulo><INPUT TYPE='SUBMIT' NAME='accion' VALUE='Enviar Mensaje'></TH>";
             echo "</FORM>";
             echo "<CENTER>";
             break;
             }
        }
    }
elseif (isset($accion)) {                                                       // Switch que evalua cual botòn de comando fue pulsado por el usuario
     if (isset($asunto)){                                                       // Controla el uso de comillas sencillas y dobles
        $asunto = AddSlashes($asunto);}
     if (isset($status)){
        $status = AddSlashes($status);}
     if (isset($introduccion)){
        $introduccion = AddSlashes($introduccion);}
     if (isset($notas)){
        $notas = AddSlashes($notas);}
     if (isset($comentarios)){
        $comentarios = AddSlashes($comentarios);}

     switch(trim($accion)) {                                                    // Switch que evalua cual botòn de comando fue pulsado por el usuario
        case 'Enviar Mensaje': {                                                // El Botón Enviar Mensaje fue pulsado
			/*$uploaddir  = '';*/
			$uploadfile = /*$uploaddir.*/ basename($_FILES['attachment']['name']);
			/*$hiddenPath = '';*/

			if (strlen($uploadfile) != 0){
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
				if (file_exists($file_real)){
					// Get extension of requested file
					$extension = strtolower(substr(strrchr($uploadfile, "."), 1));
					// Fix IE bug [0]
					$header_file = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1) : $file;
					// Read file to attach
					$stream = fopen($file_real, 'rb');
					$content = fread($stream, filesize($file_real));
					$content_escaped = pg_escape_bytea($content);
					fclose($stream);
				}else{
					// Requested file does not exist (File not found)
					echo("Requested file does not exist");
					die();
				}
			}

            $contenido ="<style type='text/css'>";
            $contenido.="td {font-size:9px; font-family:verdana, arial, helvetica, serif; line-height:1.4; border:solid 0.5px; vertical-align:top;}";
            $contenido.="</style>";

            $contenido.= $mensaje[0];
            $contenido.= "<TABLE BORDER=0 WIDTH=500 CELLSPACING=0 CELLPADDING=0>";
            $contenido.= "<TR><TD>";
			session_start("mail");
			$contenido.= gzuncompress($_SESSION["BodyMail"]);            
            $contenido.= "</TD></TR>";
            $contenido.= "</TABLE>";
            $contenido.= "<BR><B>Shipping Instructions :</B><BR>";
            $contenido.= nl2br($mensaje[1]);
            $contenido.= "<BR><B>Notes :</B><BR>";
            $contenido.= nl2br($mensaje[2]);
            $contenido = AddSlashes($contenido);
            if (isset($contactos_ag)){
               $address = implode(",",array_filter($contactos_ag, "vacios"));       // Retira las posiciones en blanco del arreglo
            }
            if (isset($contactos_co)){
               $cc = implode(",",array_filter($contactos_co, "vacios"));        // Retira las posiciones en blanco del arreglo
            }
            if (isset($contactos_cc)){
               $cc.= ((strlen($cc)<=1)?"":",").implode(",",array_filter($contactos_cc, "vacios"));      // Retira las posiciones en blanco del arreglo
            }
            if (!$rs->Open("select nextval('tb_emails_id')")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'traficos_sea.php';</script>";
                exit;
               }
            $id_email = $rs->Value('nextval');
            if (!$rs->Open("insert into tb_emails (ca_idemail, ca_fchenvio, ca_usuenvio, ca_tipo, ca_idcaso, ca_from, ca_fromname, ca_cc, ca_replyto, ca_address, ca_attachment, ca_subject, ca_body) values($id_email, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario', 'Rep.AéreoExterior', '$id', '$recorreo', '$remitente', '$cc', '$recorreo', '$address', '', '$asunto', '$contenido')")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'traficos_air.php';</script>";
                exit;
            }
			if (strlen($uploadfile) != 0){
				if (!$rs->Open("insert into tb_attachments (ca_idemail, ca_extension, ca_header_file, ca_filesize, ca_content) values('$id_email', '$extension', '$uploadfile', '".filesize($file_real)."', '$content_escaped')")) {
					echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
					echo "<script>parent.frames[2].location.href = 'traficos_sea.php';</script>";
					exit;
				}
			}
            if (!$rs->Open("update tb_reportes set ca_idetapa = 'IACAG', ca_fchultstatus=CURRENT_TIMESTAMP where ca_idreporte = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'traficos_air.php';</script>";
                exit;
            }
            enviar_email($rs, $id_email, $_FILES);                                           // Llamado a la función que envia los emails
			
			/*
			* Marca la tarea como completada
			*/ 
			if (!$rs->Open("select ca_idtarea_rext from tb_reportes where ca_idreporte = $id")) {
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                echo "<script>document.location.href = 'traficos_air.php';</script>";
                exit;
            }
			
			$rs->MoveFirst();
			
			$idtarea = $rs->Value('ca_idtarea_rext');
			
			if( $idtarea ){
				if (!$rs->Open("update notificaciones.tb_tareas set ca_fchterminada = CURRENT_TIMESTAMP, ca_usuterminada = '$usuario' where ca_idtarea = $idtarea")) {
					echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
					echo "<script>document.location.href = 'traficos_air.php';</script>";
					exit;
				}
			}
			
            break;
            }
        }
     if (isset($id)) {
        echo "<script>document.location.href = 'traficos_air.php?boton=Consultar\&id=$id';</script>";  // Retorna a la pantalla principal de la opción
     }else {
        echo "<script>document.location.href = 'traficos_air.php';</script>";  // Retorna a la pantalla principal de la opción
     }
   }


function enviar_email(&$rs, $id, &$attachment){
    if (!$rs->Open("select * from vi_emails where ca_idemail = $id")) {
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
        echo "<script>document.location.href = 'traficos_sea.php';</script>";
        exit;
       }
    require("include/class.phpmailer.php");
    $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
	$domin = chr(100-36)."coltrans.com.co";
	$name  = "tasas_cambios".$domin;
	$pass  = "tasas_cambios";
    $mail = new PHPMailer();
    $mail->IsSMTP();              // set mailer to use SMTP
	$mail->Host = "10.192.1.30";   // specify main and backup server
    $mail->SMTPAuth = true;       // turn on SMTP authentication

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
	if (strlen($attachment) != 0){
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
            echo "<script>document.location.href = 'traficos_sea.php';</script>";
            exit;
        }else{
            echo "<script>alert('¡El mensaje ha sido enviado satisfactoriamente!');</script>";
            }
        }
    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();
    $mail->ClearAttachments();
}

function datos_basicos(&$rs,&$tm){
     echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
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
     echo "  <TD Class=partir>1.&nbsp;Impor/Exportación</TD>";
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
     echo "  <TD Class=mostrar COLSPAN=3><B>5. Agente:</B><BR>".$rs->Value('ca_agente')."</TD>";
     echo "  <TD Class=invertir style='text-align: right; vertical-align: bottom;' onclick='elegir(\"Imprimir\", \"".$rs->Value('ca_idreporte')."\");'>Imprimir Reporte: <IMG src='./graficos/pdf.gif' alt='Genera archivo PFD del Reporte' border=0></TD>";
     echo "</TR>";
     echo "<TR>";
     echo "  <TD Class=mostrar COLSPAN=4><B>6. Descripción de la Mercancía:</B><BR>".nl2br($rs->Value('ca_mercancia_desc'))."</TD>";
     echo "</TR>";
     echo "<TR HEIGHT=5>";
     echo "  <TD Class=invertir COLSPAN=5></TD>";
     echo "</TR>";
     echo "</TABLE><BR>";
}
?>