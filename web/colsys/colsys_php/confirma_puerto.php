<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONFIRMA_PUERTO.PHP                                          \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Sistema de Notificaciones de Llegada - Marítimo.            \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 28;

$titulo = 'Módulo de Notificaciones para Puerto';
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls", "Nombre del Cliente"=>"ca_compania", "Reporte de Negocio"=>"ca_consecutivo", "Factura Cliente"=>"ca_factura", "N.i.t."=>"ca_idcliente", "Factura Proveedor"=>"ca_factura_prov", "Observaciones"=>"ca_observaciones");  // Arreglo con las opciones de busqueda
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                     // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require("include/class.phpmailer.php");
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta

$mail = new PHPMailer();

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)) {
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
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='confirma_puerto.php' >";
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
elseif (!isset($boton) and !isset($accion) and isset($criterio)) {
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
    //  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    $condicion= "where lower($opcion) like lower('%".$criterio."%')";
    if (isset($sucursal)) {
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
    echo "    document.location.href = 'confirma_puerto.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='confirma_puerto.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Linea</TH>";
    echo "<TH>&nbsp</TH>";  // Botón para la creación de un Registro Nuevo
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
        echo "<TR>";
        echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"confirma_puerto.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\";'>".$rs->Value('ca_referencia')."</TD>";
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
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<FORM METHOD=post NAME='cabecera' ACTION='confirma_puerto.php' ONSUBMIT='return validar();' enctype='multipart/form-data'>";  // Hace una llamado nuevamente a este script pero con
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE='".$rs->Value('ca_referencia')."'>";              // Hereda el Id del registro que se esta modificando
                echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=6>".COLTRANS."<BR>$titulo</TH>";
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
                    echo "  <TD Class=listar><B>MBL's:</B><BR>".nl2br($rs->Value('ca_mbls')."|".$rs->Value('ca_fchmbls'))."</TD>";
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
                    if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."' order by ca_compania")) {                      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
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

                    echo "<TR>";
                    echo "  <TD Class=partir><INPUT TYPE=RADIO NAME='tipo_msg' VALUE='Llegada' CHECKED onclick=\"document.getElementById('notificacion_tbl').style.display='block';document.getElementById('desconsolidacion_tbl').style.display='none'\">Llegada:</TD>";
                    echo "  <TD Class=mostrar COLSPAN=4 ROWSPAN=2><TABLE ID=notificacion_tbl style='display: block' WIDTH=100% CELLSPACING=1>";
                    $saludo = (date('H')<12)?"Buenos días":((date('H')>18)?"Buenas noches":"Buenas tardes");
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=4><B>Notificación de Llegada:</B><BR><TEXTAREA NAME='intro_body' WRAP=virtual ROWS=3 COLS=93>$saludo:\n\n".$rs->Value('ca_ciudestino')." notifica la llegada a puerto de la(s) carga(s) con el siguiente registro:</TEXTAREA></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>Fecha Confirmación:<BR><INPUT TYPE='TEXT' NAME='fchconfirmacion' VALUE='".$rs->Value('ca_fchconfirmacion')."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "    <TD Class=mostrar>Hora en Formato 24h:<BR><INPUT TYPE='TEXT' NAME='horaconfirmacion' VALUE='".$rs->Value('ca_horaconfirmacion')."' ONBLUR='CheckTime(this)' SIZE=9 MAXLENGTH=8> 00-23hrs</TD>";
                    echo "    <TD Class=mostrar>Registro Aduanero:<BR><INPUT TYPE='TEXT' NAME='registroadu' VALUE='".$rs->Value('ca_registroadu')."' SIZE=22 MAXLENGTH=20></TD>";
                    echo "    <TD Class=mostrar>Fecha Registro:<BR><INPUT TYPE='TEXT' NAME='fchregistroadu' VALUE='".$rs->Value('ca_fchregistroadu')."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>Reg. Capitania:<BR><INPUT TYPE='TEXT' NAME='registrocap' VALUE='".$rs->Value('ca_registrocap')."' SIZE=20 MAXLENGTH=20></TD>";
                    echo "    <TD Class=mostrar>Bandera:<BR><INPUT TYPE='TEXT'  NAME='bandera' VALUE='".$rs->Value('ca_bandera')."' SIZE=20 MAXLENGTH=20></TD>";
                    echo "    <TD Class=mostrar>Fecha Desconsolidación:<BR><INPUT TYPE='TEXT' NAME='fchdesconsolidacion' VALUE='".$rs->Value('ca_fchdesconsolidacion')."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "    <TD Class=mostrar>Motonave Llegada:<BR><INPUT TYPE='TEXT' NAME='mnllegada' VALUE='".($rs->Value('ca_mnllegada')!=''?$rs->Value('ca_mnllegada'):$rs->Value('ca_motonave'))."' SIZE=20 MAXLENGTH=50></TD>";
                    echo "  </TR>";
                    echo "  </TABLE><TABLE ID=desconsolidacion_tbl style='display: none' WIDTH=100% CELLSPACING=1>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=4><B>Notificación de Desconsolidacion:</B><BR><TEXTAREA NAME='status_body' WRAP=virtual ROWS=3 COLS=93>$saludo:\n\n".$rs->Value('ca_ciudestino')." notifica del vaciado con los siguientes datos:</TEXTAREA></TD>";
                    echo "  </TR>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar>Fecha Vaciado:<BR><INPUT TYPE='TEXT' NAME='fchvaciado' VALUE='".$rs->Value('ca_fchvaciado')."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "    <TD Class=mostrar>Hora de Vaciado en Formato 24h:<BR><INPUT TYPE='TEXT' NAME='horavaciado' VALUE='".$rs->Value('ca_horavaciado')."' ONBLUR='CheckTime(this)' SIZE=9 MAXLENGTH=8> 00-23hrs</TD>";
                    echo "    <TD Class=mostrar>Cierre en SYGA:<BR><INPUT TYPE='TEXT' NAME='fchsyga' VALUE='' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "    <TD Class=mostrar></TD>";
                    echo "  </TR>";


                    echo "  </TABLE></TD>";
                    echo "  <TD Class=mostrar ROWSPAN=6>&nbsp</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=partir><INPUT TYPE=RADIO NAME='tipo_msg' VALUE='Desconsolidación' onclick=\"document.getElementById('desconsolidacion_tbl').style.display='block';document.getElementById('notificacion_tbl').style.display='none'\">Desconsolidacion:</TD>";
                    echo "</TR>";

                    echo "<TR>";
                    echo "  <TD Class=partir>Adjuntar&nbsp;Archivo:</TD>";
                    echo "  <TD Class=mostrar COLSPAN=4><INPUT TYPE='FILE' NAME='attachment' SIZE=75><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Incluir Adjunto General'></TD>";
                    echo "</TR>";

                    $query = "select ca_nombre, ca_email from control.tb_usuarios where ca_login in (select DISTINCT ca_usucreado as ca_usuario from tb_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'";
                    $query.= "UNION select DISTINCT ca_usuactualizado as ca_usuario from tb_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'
                              UNION select DISTINCT ca_usumuisca as ca_usuario from tb_inomaestra_sea where ca_referencia = '".$rs->Value('ca_referencia')."' 
                              UNION select DISTINCT ca_usucreado as ca_usuario from tb_dianclientes where ca_referencia = '".$rs->Value('ca_referencia')."'
                              UNION select DISTINCT ca_usuactualizado as ca_usuario from tb_dianclientes where ca_referencia = '".$rs->Value('ca_referencia')."'
                              UNION select DISTINCT ca_usucreado as ca_usuario from tb_inomaestra_sea where ca_referencia = '".$rs->Value('ca_referencia')."'
                        )";
                    if (!$in->Open($query)) {  // Selecciona todos los correos electrónicos para enviar confirmación
                        echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit; }
                    while (!$in->Eof()) {
                        echo "<INPUT TYPE='HIDDEN' NAME='correos[]' VALUE=".$in->Value('ca_email').">";
                        $in->MoveNext();
                    }
                    $rs->MoveNext();
                }
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=6><B>Ingrese mensaje adicional para el correo:</B><BR><TEXTAREA NAME='email_body' WRAP=virtual ROWS=3 COLS=113>La información ha sido registrada en el sistema, favor proceder a informar a los clientes.</TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6></TD>";
                echo "</TR>";

                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Enviar Correo'></TH>";     // Ordena eliminar el registro de forma permanente
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"confirma_puerto.php\"'></TH>";  // Cancela la operación
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
                foreach($_FILES as $key => $file_attached) {
                    $uploadfile = basename($file_attached['name']);

                    if (strlen($uploadfile) != 0) {
                    // VARIABLES
                        $file = str_replace('%20', ' ', $file_attached['tmp_name']);
                        $file_real = $file_attached['tmp_name'];

                        // If requested file exists
                        if (file_exists($file_real)) {
                        // Get extension of requested file
                            $extension = strtolower(substr(strrchr($uploadfile, "."), 1));
                            // Read file to attach
                            $stream = fopen($file_real, 'rb');
                            $content = fread($stream, filesize($file_real));
                            $content_var = basename($file_attached['tmp_name']);
                            $$content_var = pg_escape_bytea($content);
                            if (filesize($file_real)!=0) {
                                $files_attached[$key] = array("extension"=>$extension, "uploadfile"=>$uploadfile, "file_real"=>$file_real, "content_var"=>$content_var);
                            }
                            fclose($stream);
                        }else {
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
                    echo "<script>document.location.href = 'confirma_puerto.php';</script>";
                    exit; }
                $rf =& DlRecordset::NewRecordset($conn);
                if ( $tipo_msg == "Llegada" ) {
                    if (!$rf->Open("update tb_inomaestra_sea set ca_fchconfirmacion = '$fchconfirmacion', ca_horaconfirmacion = '$horaconfirmacion', ca_registroadu = '$registroadu', ca_fchregistroadu = '$fchregistroadu', ca_registrocap = '$registrocap', ca_bandera = '$bandera', ca_mensaje = '$email_body', ca_fchdesconsolidacion = '$fchdesconsolidacion', ca_mnllegada = '$mnllegada' where ca_referencia = '$id'")) {
                        echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'confirma_puerto.php';</script>";
                        exit; }
                } else if ( $tipo_msg == "Desconsolidación" ) {
                        if (!$rf->Open("update tb_inomaestra_sea set ca_fchvaciado = '$fchvaciado', ca_horavaciado = '$horavaciado' where ca_referencia = '$id'")) {
                            echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'confirma_puerto.php';</script>";
                            exit; }
                    }

                if (!$rf->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'confirma_puerto.php';</script>";
                    exit; }

                $confirmar = isset($correos)?implode(",",$correos):"";
                $subtit = "Not.$tipo_msg";
                $asunto = "Notificación de $tipo_msg desde el Puerto de ".$rf->Value('ca_ciudestino')." Ref.: ".$rf->Value('ca_referencia');

                $mensaje = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><HTML><HEAD><META http-equiv=Content-Type content=\"text/html; charset=iso-8859-1\"><META content=\MSHTML 6.00.2800.1106\ name=GENERATOR></HEAD>\n";

                $mensaje.= "<br/>".nl2br($intro_body)."<br/><br/>";

                $mensaje.="<TABLE WIDTH=100% CELLSPACING=1 BORDER=1>\n";
                $mensaje.="<TR>\n";
                $mensaje.="  <TD><B>Origen :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_ciuorigen')."</TD>\n";
                $mensaje.="  <TD><B>Nombre del Buque :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_mnllegada')."</TD>\n";
                $mensaje.="  <TD><B>Bandera :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_bandera')."</TD>\n";
                $mensaje.="</TR>\n";

                $mensaje.="<TR>\n";
                $mensaje.="  <TD><B>Destino :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_ciudestino')."</TD>\n";
                $mensaje.="  <TD><B>Fch.Llegada :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_fchconfirmacion')."\n<b>Hora: </b> ".$rf->Value('ca_horaconfirmacion')."</TD>\n";
                $mensaje.="  <TD><B>Fch.Desconsolidación:</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_fchdesconsolidacion')."</TD>\n";
                $mensaje.="</TR>\n";

                $mensaje.="<TR>\n";
                $mensaje.="  <TD><B>Reg.Aduanero :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_registroadu')."</TD>\n";
                $mensaje.="  <TD><B>Fch.Registro :</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_fchregistroadu')."</TD>\n";
                $mensaje.="  <TD><B>Reg.Capitania:</B></TD>\n";
                $mensaje.="  <TD>".$rf->Value('ca_registrocap')."</TD>\n";
                $mensaje.="</TR>\n";


                if ( $tipo_msg == "Desconsolidación" ) {
                    $mensaje.="<TR>\n";
                    $mensaje.="  <TD><B>Fecha Vaciado :</B></TD>\n";
                    $mensaje.="  <TD>".$rf->Value('ca_fchvaciado')."</TD>\n";
                    $mensaje.="  <TD><B>Hora de Vaciado :</B></TD>\n";
                    $mensaje.="  <TD>".$rf->Value('ca_horavaciado')."</TD>\n";
                    $mensaje.="  <TD><B>Cierre en SYGA:</B></TD>\n";
                    $mensaje.="  <TD>$fchsyga</TD>\n";
                    $mensaje.="</TR>\n";
                }

                $mensaje.="</TABLE>\n";
                $mensaje.= "<br/>".$email_body."<br/><br/>";
                $mensaje.= "Cordial Saludo.<br><br><br>";
                $mensaje.= "<b>".strtoupper($us->Value('ca_nombre'))."</b><br>";
                $mensaje.= $us->Value('ca_cargo')."<br>";
                $mensaje.= "".COLTRANS."<br>";
                $mensaje.= $us->Value('ca_direccion')."<br>";
                $mensaje.= "Tel.:".$us->Value('ca_telefono')." ".$us->Value('ca_extension')."<br>";
                $mensaje.= "Fax :".$us->Value('ca_fax')."<br>";
                $mensaje.= $us->Value('ca_sucursal')." - Colombia<br>";
                $mensaje.= $us->Value('ca_email')."<br>";
                $mensaje.= "www.coltrans.com.co<br>";
                $mensaje = AddSlashes($mensaje);

                if (!$rs->Open("select nextval('tb_emails_id')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'traficos_sea.php';</script>";
                    exit; }

                $id_email = $rs->Value('nextval');
                if (!$rs->Open("insert into tb_emails (ca_idemail, ca_fchenvio, ca_usuenvio, ca_tipo, ca_idcaso, ca_from, ca_fromname, ca_cc, ca_replyto, ca_address, ca_attachment, ca_subject, ca_bodyhtml) values($id_email, NULL, '$usuario', '$subtit', ".($oid[$i]?"'$oid[$i]'":"null").", '".$us->Value('ca_email')."', '".$us->Value('ca_nombre')."', '".$us->Value('ca_email')."', '".$us->Value('ca_email')."', '$confirmar', '', '$asunto', '$mensaje')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
				/* echo "<script>document.location.href = 'confirma_puerto.php';</script>";*/
                    exit; }
                if (array_key_exists("attachment", $files_attached)) {
                    $file_attached = $files_attached["attachment"];
                    if (!$rs->Open("insert into tb_attachments (ca_idemail, ca_extension, ca_header_file, ca_filesize, ca_content) values('$id_email', '".$file_attached['extension']."', '".$file_attached['uploadfile']."', '".filesize($file_attached['file_real'])."', '".${$file_attached['content_var']}."')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'traficos_sea.php';</script>";
                        exit; }
                }
                // enviar_email($mail, $rs, $id_email, $i, $_FILES);                                           // Llamado a la función que envia los emails
                break;
            }
    }
    echo "<script>document.location.href = 'confirma_puerto.php';</script>";  // Retorna a la pantalla principal de la opción
}

function enviar_email(&$mail, &$rs, $id, &$i, &$attachment) {
    global $smtpHost, $smtpUser, $smtpPasswd;
    if (!$rs->Open("select * from vi_emails e FULL OUTER JOIN tb_attachments a ON (e.ca_idemail = a.ca_idemail) where e.ca_idemail = $id")) {
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
        echo "<script>document.location.href = 'confirma_puerto.php';</script>";
        exit;
    }
    $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
    $domin = chr(100-36)."coltrans.com.co";
    $name  = $smtpUser.$domin;
    $pass  = $smtpPasswd;

    $mail->IsSMTP();              // set mailer to use SMTP
    $mail->Host = $smtpHost;   // specify main and backup server
    if( $smtpUser ) {
        $mail->SMTPAuth = true;       // turn on SMTP authentication
    }

    $mail->From = $rs->Value('ca_from');
    $mail->FromName = $rs->Value('ca_fromname');
    if ($i == 0) {
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
        if ($rs->Value('ca_idattachment') != null) {
            $att_mem = true;
            foreach($attachment as $key => $file_attached) {
                if ($rs->Value('ca_header_file') == $file_attached['name']) {
                    $mail->AddAttachment(str_replace(chr(92),'/',$file_attached['tmp_name']), $file_attached['name']);
                }
            }
        }
        $rs->MoveNext();
    } while( !$rs->Eof() );

    if ($att_mem) {
        $mail->AttachAll();
    }

    if ($send_it) {
        /*if(!$mail->Send()) {
            echo "<script>alert(\"".addslashes($mail->ErrorInfo)."\");</script>";  // Muestra el mensaje de error
            echo "<script>document.location.href = 'confirma_puerto.php';</script>";
            exit;
        }*/
    }
}
?>