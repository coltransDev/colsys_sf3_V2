<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       inosea.PHP                                                  \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   M�dulo de mantenimiento a la tabla de grupos para tr�fico.  \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/
$programa = 43;

$titulo = 'Sistema Administrador de Referencias Mar�timas';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$columnas = array("N�mero de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "Nombre Naviera"=>"ca_nombre", "Sigla Naviera"=>"ca_sigla", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls", "Nombre del Cliente"=>"ca_compania", "Reporte de Negocio"=>"ca_consecutivo", "Factura Cliente"=>"ca_factura", "N.i.t."=>"ca_idcliente", "Factura Proveedor"=>"ca_factura_prov", "Observaciones"=>"ca_observaciones");  // Arreglo con las opciones de busqueda
$imporexpor = array("Importaci�n","Triangulaci�n","OTM/DTA");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS","PARTICULARES");                     // Arreglo con los tipos de Modalidades de Carga
$continuaciones = array("N/A","OTM","DTA");                          // Arreglo con los tipos de Transportes
$tipos = array("Observaci�n", "Error Detectado", "Seguimiento", "Acci�n Tomada", "Cerrar el Evento");
include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php"); // Captura las variables de la sessi�n abierta

if( $nivel==0 ) {
    header("Location: inosea_cons.php");
    exit();
}

set_time_limit(0);
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)) {
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
    echo "}";
    echo "function habilitar() {";
    echo "	elemento = document.getElementById('rango');";
    echo "	if (elemento.checked){";
    echo "      document.getElementById('fchinicial').disabled = false;";
    echo "      document.getElementById('fchfinal').disabled = false;";
    echo "      document.getElementById('sucursal').disabled = false;";
    echo "	}else{";
    echo "      document.getElementById('fchinicial').disabled = true;";
    echo "      document.getElementById('fchfinal').disabled = true;";
    echo "      document.getElementById('sucursal').disabled = true;";
    echo "	}";
    echo "}";
    echo "</script>";
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='inosea.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Bot�n para la creaci�n de un Registro Nuevo
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp;</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=7>";
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."'".(($val=='ca_referencia')?" SELECTED":"").">".$clave;
    }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' VALUE='$cadena' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=3>B�squeda por ETA:  <INPUT TYPE=CHECKBOX NAME='rango' ONCLICK='habilitar();'><IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Servicio'><TABLE CELLSPACING=1 WIDTH=320>";
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
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.opcion.focus()</script>";
    //  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
elseif (!isset($boton) and !isset($accion) and isset($criterio)) {
    SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
    //  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

    $condicion= "where lower($opcion) like lower('%".$criterio."%')";
    if (isset($sucursal)) {
        $condicion.= " and (ca_fcharribo between '$fchinicial' and '$fchfinal') and ca_sucursal like '$sucursal'";
    }
    if (!$rs->Open("select DISTINCT ca_ano, ca_mes, ca_trafico, ca_modal, ca_referencia, ca_sigla, ca_nombre, ca_ciuorigen, ca_traorigen, ca_ciudestino, ca_tradestino, ca_fchembarque, ca_fcharribo, ca_motonave from vi_inoconsulta_sea $condicion order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia")) {           // Selecciona todos lo registros de la tabla Ino-Mar�timo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='inosea.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=3>COLTRANS S.A.<BR>$titulo</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Linea</TH>";
    echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0);'></TH>";  // Bot�n para la creaci�n de un Registro Nuevo
    $ano_mem = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
        if ($rs->Value('ca_ano') != $ano_mem) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=imprimir COLSPAN=3></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=titulo style='font-size: 11px; font-weight:bold;'>".($rs->Value('ca_ano')+2000)."</TD>";
            echo "  <TD Class=titulo COLSPAN=2></TD>";
            echo "</TR>";
            $ano_mem = $rs->Value('ca_ano');
        }
        echo "<TR>";
        echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"inosea.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\";'>".$rs->Value('ca_referencia')."</TD>";
        echo "  <TD Class=listar style='font-weight:bold;'>".$rs->Value('ca_sigla')." ".$rs->Value('ca_nombre')."</TD>";
        echo "  <TD Class=listar ROWSPAN=2></TD>";
        echo "</TR>";
        echo "<TR>";
        echo " <TD Class=listar>";
        echo "  <TABLE WIDTH=520 CELLSPACING=1>";
        echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Origen</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=2>Destino</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Embarque</TD>";
        echo "  <TD Class=invertir style='font-weight:bold;'>Fch.Arribo</TD>";
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
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"inosea.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    //  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
    echo "</BODY>";
    echo "</HTML>";
}
elseif (isset($boton)) {                                                       // Switch que evalua cual bot�n de comando fue pulsado por el usuario
    switch(trim($boton)) {
        case 'Consultar': {                                                    // Opcion para Consultar un solo registro
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $dm =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$dm->Open("select * from tb_dianmaestra where ca_referencia = '".$rs->Value('ca_referencia')."' order by ca_fchactualizado DESC limit 5")) {                      // Selecciona el registros del log de envio a la Dian
                    echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "<HTML>";
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function elegir(opcion, id, cl, hb){";
                echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl+'\&hb='+hb;";
                echo "}";
                echo "function apertura(opcion, id){";
                echo "    if (confirm(\"�Esta seguro que desea abrir la Referencia?\")) {";
                echo "        document.location.href = 'inosea.php?accion='+opcion+'\&id='+id;";
                echo "    }";
                echo "}";
                echo "function ver_pdf(id){";
                echo "    window.open(\"reporteneg.php?id=\"+id);"; //toolbar=no, location=no, directories=no, menubar=no
                echo "}";
                echo "</script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<FORM METHOD=post NAME='cabecera' ACTION='inosea.php' ONSUBMIT='javascript:return confirm(\"�Esta seguro que desea realizar la acci�n?\")'>";             // Hace una llamado nuevamente a este script pero con
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=6>COLTRANS S.A.<BR>$titulo</TH>";
                echo "</TR>";
                echo "<TH></TH>";
                echo "<TH COLSPAN=4>Descripci�n</TH>";
                echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Adicionar\", 0, 0, 0);'></TH>";  // Bot�n para la creaci�n de un Registro Nuevo
                while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    $visible = ($rs->Value('ca_usucerrado')=='')?'visible':'hidden';
                    $abrible = ($rs->Value('ca_usucerrado')!='' and $nivel >= 3)?'visible':'hidden';
                    echo "<TR>";
                    echo "  <TD Class=partir>Referencia:</TD>";
                    echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;' COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                    echo "  <TD Class=partir>Fecha de Registro :</TD>";
                    echo "  <TD style='font-size: 11px; text-align: center;' Class=listar>".$rs->Value('ca_fchreferencia')."</TD>";
                    echo "  <TD ROWSPAN=6 Class=listar style='text-align: center;'>";                                             // Botones para hacer Mantenimiento a la Tabla
                    echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Modificar\", \"".$rs->Value('ca_referencia')."\", 0, 0);'>";
                    echo "    <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Eliminar\", \"".$rs->Value('ca_referencia')."\", 0, 0);'><BR><BR>";
                    echo "    <IMG style='visibility: $visible;' src='./graficos/muisca.gif'  alt='Informacion Muisca' border=0 onclick='elegir(\"Muisca\", \"".$rs->Value('ca_referencia')."\", 0, 0);'><BR>";
                    if ($dm->value("ca_usuenvio") != ''){
                        $fch_envio = explode(" ",$dm->value("ca_fchenvio"));
                        echo "<br /><b>Radicado:</b><br />".$dm->value("ca_usuenvio")."<br />".$fch_envio[0]."<br />".$fch_envio[1]."<br />";
                    }
                    echo "  </TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=partir>&nbsp;</TD>";
                    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Origen</TD>";
                    echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Destino</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=partir style='text-align: center; vertical-align:top;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp;<BR>&nbsp;</TD>";
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
                    echo "  <TD Class=listar><B>MBL's:</B><BR>".str_replace("|","<br />",$rs->Value('ca_mbls'))."</TD>";
                    echo "  <TD Class=listar COLSPAN=2><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD COLSPAN=4 Class=invertir>";
                    $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                    if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {        // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                        echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit; }

                    $cl =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                    if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {                      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                        echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit; }
                    $lg =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                    if (!$lg->Open("select * from tb_inomaestralog_sea where ca_referencia = '".$rs->Value('ca_referencia')."' order by ca_fchactualizado DESC limit 5")) {                      // Selecciona todos lo registros del log de apertura y cierres de una referencia Ino-Mar�timo
                        echo "<script>alert(\"".addslashes($lg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit; }
                    echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                    echo "  <TH>Concepto</TH>";
                    echo "  <TH>Cantidad</TH>";
                    echo "  <TH>Id Equipo</TH>";
                    echo "  <TH>No.Precinto</TH>";
                    echo "  <TH COLSPAN=3>Contratos de Comodato</TH>";
                    $arr_equ = array();
                    list($mod, $tra, $mes, $con, $ano) = sscanf($rs->Value('ca_referencia'), "%d.%d.%d.%d.%d");
                    $ver = ($rs->Value('ca_modalidad') == 'FCL' and $cl->Value('ca_fchvencimiento') >= date("Y-m-d",mktime(0,0,0,$mes,$dia,$ano+2000)))?"visible":"hidden";
                    while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                        echo "<TR>";
                        echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_concepto')."</TD>";
                        echo "  <TD WIDTH=30 Class=listar>".formatNumber($co->Value('ca_cantidad'),3)."</TD>";
                        echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')." ".((strlen($co->Value('ca_observaciones')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones')."'>":"")."</TD>";
                        echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                        echo "  <TD WIDTH=90 Class=listar>".$co->Value('ca_idcontrato')." ".((strlen($co->Value('ca_observaciones_con')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones_con')."'>":"")."</TD>";
                        echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_fchcontrato')."</TD>";
                        if ($ver == 'visible') {
                            echo "  <TD WIDTH=25 Class=listar onclick='elegir(\"Contrato\", \"".$co->Value('ca_referencia')."\", \"".$co->Value('ca_idequipo')."\");'><IMG src='graficos/contrato.gif' alt='Contrato de Comodato'></TD>";
                        }else {
                            echo "  <TD WIDTH=25 Class=listar></TD>";
                        }

                        echo "</TR>";
                        if (!array_key_exists($co->Value('ca_concepto'),$arr_equ))
                            array_merge($arr_equ, array($co->Value('ca_concepto') => 0));
                        $arr_equ[$co->Value('ca_concepto')]+= $co->Value('ca_cantidad');
                        $co->MoveNext();
                    }
                    echo "  <TR HEIGHT=5>";
                    echo "    <TD Class=imprimir COLSPAN=7></TD>";
                    echo "  </TR>";
                    $sub_tit = "Cantidades Totales :";
                    while (list ($clave, $val) = each ($arr_equ)) {
                        echo "  <TR>";
                        echo "    <TD Class=listar style='font-weight:bold;'>$sub_tit</TD>";
                        echo "    <TD Class=listar style='font-weight:bold;'>".formatNumber($val,2)."</TD>";
                        echo "    <TD Class=listar style='font-weight:bold;' COLSPAN=3>$clave</TD>";
                        echo "    <TD Class=listar style='font-weight:bold;' COLSPAN=2></TD>";
                        echo "  </TR>";
                        $sub_tit = ""; }
                    echo "  <TR>";
                    echo "    <TD Class=listar>Sitio de Devoluci�n:</TD>";
                    echo "    <TD Class=listar COLSPAN=6>".$co->Value('ca_sitiodevolucion')."</TD>";
                    echo "  </TR>";
                    echo "  </TABLE>";
                    echo "  </TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=partir>Tr�nsito:<BR>&nbsp;</TD>";
                    echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Embarque:</TD>";
                    echo "  <TD Class=listar>".$rs->Value('ca_fchembarque')."</TD>";
                    echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Arribo:</TD>";
                    echo "  <TD Class=listar>".$rs->Value('ca_fcharribo')."</TD>";
                    echo "  <TD Class=listar style='text-align: center;'>";
                    echo "    <IMG style='visibility: $visible;' src='./graficos/xml.gif'  alt='nerar Informaci�n para el Prevalidador' border=0 onclick='elegir(\"Prevalidador\", \"".$rs->Value('ca_referencia')."\", 0, 0);'><BR>";
                    echo "  </TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=invertir COLSPAN=6></TD>";
                    echo "</TR>";

                    $ext_mem = $rs->Value('ca_comisionable') + $rs->Value('ca_nocomisionable');
                    $utl_mem = $rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_costoneto') - $ext_mem;
                    $utl_cbm = ($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad')) / $rs->Value('ca_volumen');
                    $col_mem = ($utl_mem <= 0)? 'background: #FF0000; color: #FFFFFF;':'';
                    echo "<TR>";
                    echo "  <TD Class=partir ROWSPAN=9>Balance:</TD>";
                    echo "  <TD Class=listar><B>No.Total Piezas:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_numpiezas'))."&nbsp;</TD>";
                    echo "  <TD Class=listar><B>Facturaci�n Clientes:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_facturacion'))."&nbsp;</TD>";
                    if ($abrible == 'visible') {
                        echo "  <TD Class=listar style='visibility: $abrible; text-align: center; vertical-align: bottom;' ROWSPAN=9><IMG src='./graficos/abrir.gif'  alt='Abrir la Referencia' border=0 onclick='apertura(\"Abrir\", \"".$rs->Value('ca_referencia')."\");'></TD>";
                    }else {
                        echo "  <TD Class=listar ROWSPAN=9></TD>";
                    }
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Peso Total en Kilos:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>".formatNumber($rs->Value('ca_peso'),3)."&nbsp;</TD>";
                    echo "  <TD Class=listar><B>Menos Deducciones:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>(".number_format($rs->Value('ca_deduccion')).")</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Volumen Total CBM:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>".formatNumber($rs->Value('ca_volumen'),3)."&nbsp;</TD>";
                    echo "  <TD Class=listar><B>Costo Neto Embarque:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>(".number_format($rs->Value('ca_costoneto')).")</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Total Hbl's Registradas:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>".$cl->Value('ca_nrohbls')."&nbsp;</TD>";
                    echo "  <TD Class=listar><B>Venta Extra:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;'>(".number_format($ext_mem).")</TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5><TD Class=invertir COLSPAN=4></TD></TR>";

                    echo "<TR>";
                    echo "  <TD Class=invertir COLSPAN=2 ROWSPAN=4 style='vertical-align:bottom;'><TABLE WIDTH=100% CELLSPACING=1></TD>";
                    echo "		<TR>";
                    echo "  		<TH style='font-size:8px;'>Acci�n</TD>";
                    echo "  		<TH style='font-size:8px;'>Usuario</TD>";
                    echo "  		<TH style='font-size:8px;'>Fecha</TD>";
                    echo "		</TR>";
                    while (!$lg->Eof() and !$lg->IsEmpty()) {
                        echo "<TR>";
                        echo "  <TD Class=listar style='font-size:8px;'><B>".((strlen($lg->Value('ca_usucerrado'))==0)?"Cerr�":"Abri�")."</B></TD>";
                        echo "  <TD Class=listar style='font-size:8px;'>".$lg->Value('ca_usuactualizado')."</TD>";
                        echo "  <TD Class=listar style='font-size:8px;'>".$lg->Value('ca_fchactualizado')."</TD>";
                        echo "</TR>";
                        $lg->MoveNext();
                    }
                    echo "  </TABLE></TD>";

                    echo "  <TD Class=listar><B>Utilidad Consolidado:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;$col_mem'>".number_format($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad'))."</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Ingr. x Sobreventa:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;$col_mem'>".number_format($rs->Value('ca_comisionable'))."</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Ingr. No Comisionable:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;$col_mem'>".number_format($rs->Value('ca_nocomisionable'))."</TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=listar><B>Utilidad x CBM:</B></TD>";
                    echo "  <TD Class=listar style='text-align: right;$col_mem'>".number_format($utl_cbm)."</TD>";
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=invertir COLSPAN=6></TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD Class=partir>Auditor�a:</TD>";
                    echo "  <TD Class=listar><B>Creaci�n:</B>&nbsp;".$rs->Value('ca_usucreado')."<BR>".$rs->Value('ca_fchcreado')."</TD>";
                    echo "  <TD Class=listar><B>Actualizaci�n:</B>&nbsp;".$rs->Value('ca_usuactualizado')."<BR>".$rs->Value('ca_fchactualizado')."</TD>";
                    if ($rs->Value('ca_usuliquidado')=='') {
                        echo "  <TD Class=invertir style='text-align: center; vertical-align: middle;'><INPUT Class=submit onMouseOver=\"this.style.cursor='hand'\" onMouseOut=\"this.style.cursor='default'\" TYPE='SUBMIT' NAME='accion' VALUE='Firmar Liquidaci�n'></TD>";
                    }else {
                        echo "  <TD Class=listar><B>Liquidaci�n:</B>&nbsp;".$rs->Value('ca_usuliquidado')."<BR>".$rs->Value('ca_fchliquidado')."</TD>";
                    }
                    if ($rs->Value('ca_usucerrado')=='') {
                        echo "  <TD Class=invertir style='text-align: center; vertical-align: middle;'><INPUT Class=submit onMouseOver=\"this.style.cursor='hand'\" onMouseOut=\"this.style.cursor='default'\" TYPE='SUBMIT' NAME='accion' VALUE='Cerrar Caso'></TD>";
                        echo "  <TD Class=invertir style='text-align: center; vertical-align: middle;'>Provisional:<BR><INPUT TYPE=CHECKBOX style='visibility=$ver;' NAME='provisional'></TD>";
                    }else {
                        echo "  <TD Class=listar><B>Cierre:</B>&nbsp;".$rs->Value('ca_usucerrado')."<BR>".$rs->Value('ca_fchcerrado')."</TD>";
                        echo "  <TD Class=listar style='font-weight:bold; text-align: center; vertical-align: middle;'><B>".(($rs->Value('ca_provisional')=="t")?"Cierre<br>Provisional":"")."</TD>";
                    }
                    echo "</TR>";
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=invertir COLSPAN=6></TD>";
                    echo "</TR>";

                    echo "<TR>";
                    echo "  <TD Class=imprimir COLSPAN=6>&nbsp;</TD>";
                    echo "</TR>";
                    echo "<TH Class=titulo COLSPAN=5>Cuadro de Clientes de la Referencia</TH>";
                    echo "<TH><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"AdicionarCl\",  \"".$rs->Value('ca_referencia')."\", 0, 0);'></TH>";  // Bot�n para la creaci�n de un Registro Nuevo
                    $cli_mem = 0;
                    $hbl_mem = 0;
                    while (!$cl->Eof() and !$cl->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                        if( $cl->Value('ca_idcliente') != $cli_mem or $cl->Value('ca_hbls') != $hbl_mem) {
                            echo "<TR HEIGHT=5>";
                            echo "  <TD Class=captura COLSPAN=6></TD>";
                            echo "</TR>";
                            echo "<TR>";
                            echo "  <TD Class=listar style='font-size: 11px; vertical-align:bottom'><B>Id Cliente:</B><BR>".number_format($cl->Value('ca_idcliente'))."</TD>";
                            echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=4><B>Nombre del Cliente:</B><BR>".$cl->Value('ca_compania')."</TD>";
                            echo "  <TD ROWSPAN=3 WIDTH=80 Class=listar style='text-align: center;'>";                                              // Botones para hacer Mantenimiento a la Tabla
                            echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"ModificarCl\", \"".$rs->Value('ca_referencia')."\", \"".$cl->Value('ca_idcliente')."\", \"".urlencode($cl->Value('ca_hbls'))."\");'>";
                            echo "   <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"EliminarCl\", \"".$rs->Value('ca_referencia')."\", \"".$cl->Value('ca_idcliente')."\", \"".urlencode($cl->Value('ca_hbls'))."\");'><BR><BR>";
                            echo "    <IMG style='visibility: $visible;' src='./graficos/muisca.gif'  alt='Informacion Muisca' border=0 onclick='elegir(\"MuiscaCl\", \"".$rs->Value('ca_referencia')."\", \"".$cl->Value('ca_idcliente')."\", \"".urlencode($cl->Value('ca_hbls'))."\");'><BR>";
                            echo "  </TD>";
                            echo "</TR>";
                            echo "<TR>";
                            echo "  <TD Class=listar><B>Vendedor:</B><BR>".$cl->Value('ca_login')."</TD>";
                            echo "  <TD Class=listar><B>HBL:</B><BR>".$cl->Value('ca_hbls')."</TD>";
                            echo "  <TD Class=listar><B>No.Piezas:</B><BR>".number_format($cl->Value('ca_numpiezas'))."</TD>";
                            echo "  <TD Class=listar><B>Peso en Kilos:</B><BR>".formatNumber($cl->Value('ca_peso'),3)."</TD>";
                            echo "  <TD Class=listar><B>Volumen CMB:</B><BR>".formatNumber($cl->Value('ca_volumen'),3)."</TD>";
                            echo "</TR>";
                            $pdf_icon = ((strlen($cl->Value('ca_consecutivo'))!=0)?"<IMG src='./graficos/pdf.gif' alt='Genera archivo PFD del Reporte' border=0 onclick='javascript:ver_pdf(\"".$cl->Value('ca_consecutivo')."\")'>":"");
                            echo "<TR>";
                            echo "  <TD Class=listar><B>ID Reporte:</B><BR>".$cl->Value('ca_consecutivo')." $pdf_icon</TD>";
                            echo "  <TD Class=listar><B>ID Proveedor:</B><BR>".$cl->Value('ca_idproveedor')."</TD>";
                            echo "  <TD Class=listar COLSPAN=2><B>Proveedor:</B><BR>".$cl->Value('ca_proveedor')."</TD>";
                            echo "  <TD Class=listar><B>Utilidad x Cliente:</B><BR>".number_format($utl_cbm * $cl->Value('ca_volumen'))."</TD>";
                            echo "</TR>";
                            echo "<TR HEIGHT=5>";
                            echo "  <TD Class=invertir COLSPAN=6></TD>";
                            echo "</TR>";
                            if ($cl->Value('ca_continuacion') != "N/A") {
                                echo "<TR>";
                                echo "  <TD Class=listar COLSPAN=2><B>Continua/Viaje: </B>".$cl->Value('ca_continuacion')."</TD>";
                                echo "  <TD Class=listar><B>Destino Final: </B>".$cl->Value('ca_ciudad_dest')."</TD>";
                                echo "  <TD Class=listar COLSPAN=2><B>Operador: </B>".$cl->Value('ca_bodega')."</TD>";
                                echo "  <TD Class=listar></TD>";
                                echo "</TR>";
                            }
                            if (strlen($cl->Value('ca_fchliberacion')) != 0) {
                                echo "<TR>";
                                echo "  <TD Class=destacar><B>Fch.Liberaci�n:</B><BR>".$cl->Value('ca_fchliberacion')."</TD>";
                                echo "  <TD Class=destacar COLSPAN=3><B>Anotaciones:</B><BR>".$cl->Value('ca_notaliberacion')."</TD>";
                                echo "  <TD Class=destacar COLSPAN=2><B>Liber�:</B>&nbsp;".$cl->Value('ca_usuliberado')."<BR>".$cl->Value('ca_fchliberado')."</TD>";
                                echo "</TR>";
                            }
                            $cli_mem = $cl->Value('ca_idcliente');
                            $hbl_mem = $cl->Value('ca_hbls');
                        }
                        echo "<TR>";
                        echo "  <TD Class=invertir><B>Factura Nro.:</B><BR>".$cl->Value('ca_factura')." <BR /><img src='graficos/image.gif' /><a href='colsys_sf/digitalFile/verReferencia?referencia=".$cl->Value('ca_referencia')."&factura=".$cl->Value('ca_factura')."'><strong>Imagen</strong></a> </TD>";
                        echo "  <TD Class=invertir><B>".$cl->Value('ca_idmoneda').":</B><BR>".number_format($cl->Value('ca_neto'),2)."<BR><B>Tasa Cambio:</B><BR>".number_format($cl->Value('ca_tcambio'),2)."</TD>";
                        echo "  <TD Class=invertir><B>Valor Factura:</B><BR>".number_format($cl->Value('ca_valor'),2)."</TD>";
                        echo "  <TD Class=invertir><B>Deducciones:</B><BR>".number_format($cl->Value('ca_deduccion'),2)."</TD>";
                        echo "  <TD Class=invertir><B>Fch.Factura:</B><BR>".$cl->Value('ca_fchfactura')."</TD>";
                        echo "  <TD Class=invertir><B>Rec.Caja:</B>".((strlen($cl->Value('ca_reccaja'))==0)?"<BR>":$cl->Value('ca_reccaja'))."<BR><B>Fch.Pago:</B>".$cl->Value('ca_fchpago')."</TD>";
                        echo "</TR>";
                        $con_mem = '';
                        $cl->MoveNext();
                    }
                    $cs =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                    if (!$cs->Open("select * from vi_inocostos_sea  where ca_referencia = '".$rs->Value('ca_referencia')."'")) {                        // Selecciona todos lo registros de la tabla de Costos de una referencia
                        echo "<script>alert(\"".addslashes($cs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                        echo "<script>document.location.href = 'entrada.php';</script>";
                        exit; }

                    $visible = ($rs->Value('ca_usucerrado')=='')?'visible':'hidden';
                    echo "<TR>";
                    echo "  <TD Class=imprimir COLSPAN=6>&nbsp;</TD>";
                    echo "</TR>";
                    echo "<TH Class=titulo COLSPAN=5>Cuadro de Costos de la Referencia</TH>";
                    echo "<TH><IMG style='visibility: $visible;' src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"AdicionarCs\",  \"".$rs->Value('ca_referencia')."\", 0);'>";  // Bot�n para la creaci�n de un Registro Nuevo
                    echo "<IMG src='./graficos/post.gif' onClick=\"document.location='/ids/formEventos?referencia=".$rs->Value('ca_referencia')."'\" title='Eventos Proveedores' ></TH>";
                    while (!$cs->Eof() and !$cs->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                        echo "<TR>";
                        echo "<TR HEIGHT=5>";
                        echo "  <TD Class=invertir COLSPAN=6></TD>";
                        echo "</TR>";
                        echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=2><B>".$cs->Value('ca_costo')."</B><BR></TD>";
                        echo "  <TD Class=listar><B>Factura:</B><BR>".$cs->Value('ca_factura')."</TD>";
                        echo "  <TD Class=listar COLSPAN=2><B>Proveedor:</B><BR>".$cs->Value('ca_proveedor')."</TD>";
                        echo "  <TD ROWSPAN=2 WIDTH=80 Class=listar>";                                              // Botones para hacer Mantenimiento a la Tabla
                        echo "    <IMG style='visibility: $visible;' src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"ModificarCs\", \"".$cs->Value('ca_referencia')."\", \"".$cs->Value('ca_oid')."\");'>";
                        echo "    <IMG style='visibility: $visible;' src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"EliminarCs\", \"".$cs->Value('ca_referencia')."\", \"".$cs->Value('ca_oid')."\");'>";
                        echo "  </TD>";
                        echo "</TR>";
                        $cos_mem = $cs->Value('ca_neto') * $cs->Value('ca_tcambio');
                        echo "<TR>";
                        echo "  <TD Class=listar><B>T.R.M.:</B><BR>$ ".number_format($cs->Value('ca_tcambio'), 2)."</TD>";
                        echo "  <TD Class=listar><B>Neto:</B><BR><B>".$cs->Value('ca_idmoneda').'</B> '.number_format($cs->Value('ca_neto'), 2)."</TD>";
                        echo "  <TD Class=listar><B>Costo en Pesos:</B><BR>$ ".number_format($cos_mem)."</TD>";
                        echo "  <TD Class=listar><B>Venta en Pesos:</B><BR>$ ".number_format($cs->Value('ca_venta'))."</TD>";
                        echo "  <TD Class=listar><B>Util. x Sobreventa:</B><BR>$ ".number_format($cs->Value('ca_utilidad'))."</TD>";
                        echo "</TR>";
                        $cs->MoveNext();
                    }
                    echo "<TR HEIGHT=5>";
                    echo "  <TD Class=captura COLSPAN=6></TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                }
                echo "</TABLE><BR><BR>";
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select * from vi_inoauditor_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
                echo "<TR>";
                echo "  <TH Class=titulo COLSPAN=6>Maestra de Registros de Auditor�a</TH>";
                echo "</TR>";
                echo "<TH WIDTH=80>Fecha</TH>";
                echo "<TH>Tipo</TH>";
                echo "<TH WIDTH=300 COLSPAN=3>Asunto</TH>";
                echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Evento\", \"".$rs->Value('ca_referencia')."\");'></TH>";  // Bot�n para la creaci�n de un Registro Nuevo
                $eve_ant = 0;
                while (!$tm->Eof()) {
                    if ($eve_ant != $tm->Value('ca_idevento_ant')) {
                        echo "<TR>";
                        echo "  <TD Class=mostrar COLSPAN=6><B>".$tm->Value('ca_asunto_ant')."</B></TD>";
                        echo "</TR>";
                        $eve_ant = $tm->Value('ca_idevento_ant');
                    }
                    echo "<TR>";
                    echo "  <TD WIDTH=80 Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_fchevento')."</TD>";
                    echo "  <TD Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_tipo')."</TD>";
                    echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=3>".$tm->Value('ca_asunto')."</TD>";
                    echo "  <TD Class=listar style='letter-spacing:-1px;'>".$tm->Value('ca_usuario');
                    if ($nivel >= 4) {
                        echo "  <BR>";
                        echo "  <IMG src='./graficos/edit.gif' alt='Editar el Registro' border=0 onclick='elegir(\"Evento_Mod\", \"".$tm->Value('ca_oid')."\");'>";
                        echo "  <IMG src='./graficos/del.gif'  alt='Eliminar el Registro' border=0 onclick='elegir(\"Evento_Eli\", \"".$tm->Value('ca_oid')."\");'>";
                    }
                    echo "  </TD>";
                    echo "</TR>";
                    echo "<TR>";
                    echo "  <TD WIDTH=80 Class=listar></TD>";
                    echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=2><B>Detalles:</B><BR>".nl2br($tm->Value('ca_detalle'))."</TD>";
                    echo "  <TD Class=listar style='letter-spacing:-1px;' COLSPAN=3><B>Compromisos:</B><BR>".nl2br($tm->Value('ca_compromisos'))."<BR>Plazo :".$rs->Value('ca_fchcompromiso')."</TD>";
                    echo "</TR>";
                    $tm->MoveNext();
                }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=6></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"inosea.php\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                echo "</HTML>";
                break;
            }
        case 'Evento': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idevento, ca_asunto from vi_inoauditor_sea where ca_referencia = '$id' and ca_idantecedente=0 order by ca_idevento desc")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>Tabla de Registros de Auditoria por Referencia</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.adicionar.asunto.value == '')";
                echo "      alert('El campo Asunto no es v�lido');";
                echo "  else if (document.adicionar.detalle.value == '')";
                echo "      alert('El campo Detalle no es v�lido');";
                echo "  else if (document.adicionar.compromisos.value == '')";
                echo "      alert('El campo Compromisos no es v�lido');";
                echo "  else if (!chkDate(document.adicionar.fchcompromiso))";
                echo "      document.adicionar.fchcompromiso.focus();";
                echo "  else";
                echo "      return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";
                echo "<TABLE CELLSPACING=1>";
                echo "<TH Class=titulo COLSPAN=2>Datos del Evento</TH>";
                echo "<TR>";
                echo "  <TD Class=captura>Tipo de Evento :</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
                for ($i=0; $i < count($tipos); $i++) {
                    echo " <OPTION VALUE='".$tipos[$i]."'>".$tipos[$i];
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Asunto:</TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='asunto' SIZE=40 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Detalle:</TD>";
                echo "  <TD Class=mostrar><TEXTAREA NAME='detalle' WRAP=virtual ROWS=5 COLS=50></TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Compromisos:</TD>";
                echo "  <TD Class=mostrar><TEXTAREA NAME='compromisos' WRAP=virtual ROWS=5 COLS=50></TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Cumplir Antes de:</TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchcompromiso' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "  <TD Class=captura>Evento Antecesor:</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='idantecedente'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                $tm->MoveFirst();
                while ( !$tm->Eof()) {
                    echo " <OPTION VALUE=".$tm->Value('ca_idevento').">".$tm->Value('ca_asunto')."</OPTION>";
                    $tm->MoveNext();
                }
                echo "  <OPTION VALUE=0>Evento Raiz</OPTION>";
                echo "</TABLE><BR>";
                $cadena = "?boton=Consultar\&id=$id";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Registrar'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php$cadena\"'></TH>";  // Cancela la operaci�n
                echo "<script>adicionar.tipo.focus()</script>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Evento_Mod': {                                                    // Opcion para modificar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inoauditor_sea where ca_oid = $id")) {       // Selecciona todos lo registros de la tabla Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idevento, ca_asunto from vi_inoauditor_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_idantecedente=0 order by ca_idevento desc")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>Tabla de Registros de Auditoria por Referencia</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.modificar.asunto.value == '')";
                echo "      alert('El campo Asunto no es v�lido');";
                echo "  else if (document.modificar.detalle.value == '')";
                echo "      alert('El campo Detalle no es v�lido');";
                echo "  else if (document.modificar.compromisos.value == '')";
                echo "      alert('El campo Compromisos no es v�lido');";
                echo "  else if (!chkDate(document.modificar.fchcompromiso))";
                echo "      document.modificar.fchcompromiso.focus();";
                echo "  else";
                echo "      return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='modificar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$rs->Value('ca_referencia')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=\"".$id."\">";
                echo "<TABLE CELLSPACING=1>";
                echo "<TH Class=titulo COLSPAN=2>Datos del Evento</TH>";
                echo "<TR>";
                echo "  <TD Class=captura>Tipo de Evento :</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='tipo'>";
                for ($i=0; $i < count($tipos); $i++) {
                    echo " <OPTION VALUE='".$tipos[$i]."'";
                    if ($rs->Value('ca_tipo')==$tipos[$i]) {
                        echo" SELECTED"; }
                    echo ">".$tipos[$i];
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Asunto:</TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='asunto' VALUE='".$rs->Value('ca_asunto')."' SIZE=40 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Detalle:</TD>";
                echo "  <TD Class=mostrar><TEXTAREA NAME='detalle' WRAP=virtual ROWS=5 COLS=50>".$rs->Value('ca_detalle')."</TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Compromisos:</TD>";
                echo "  <TD Class=mostrar><TEXTAREA NAME='compromisos' WRAP=virtual ROWS=5 COLS=50>".$rs->Value('ca_compromisos')."</TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Cumplir Antes de:</TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='fchcompromiso' SIZE=12 VALUE='".$rs->Value('ca_fchcompromiso')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "  <TD Class=captura>Evento Antecesor:</TD>";
                echo "  <TD Class=mostrar><SELECT NAME='idantecedente'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                echo "  <OPTION VALUE=0>Evento Raiz</OPTION>";
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    if ($tm->Value('ca_idevento')!=$rs->Value('ca_idevento')) {
                        echo " <OPTION VALUE=".$tm->Value('ca_idevento');
                        if ($tm->Value('ca_idevento')==$rs->Value('ca_idantecedente')) {
                            echo" SELECTED"; }
                        echo ">".$tm->Value('ca_asunto')."</OPTION>";
                    }
                    $tm->MoveNext();
                }
                echo "</TABLE><BR>";
                $cadena = "?boton=Consultar\&id=".$rs->Value('ca_referencia');
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Modificar Evento'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php$cadena\"'></TH>";  // Cancela la operaci�n
                echo "<script>modificar.tipo.focus()</script>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Evento_Eli': {                                                    // Opcion para eliminar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inoauditor_sea where ca_oid = $id")) {       // Selecciona todos lo registros de la tabla Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idevento, ca_asunto from vi_inoauditor_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_idantecedente=0 order by ca_idevento desc")) {       // Selecciona todos lo registros de la tabla Eventos Clientes
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";          // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>Tabla de Registros de Auditoria por Referencia</TITLE>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='eliminar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$rs->Value('ca_referencia')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=\"".$id."\">";
                echo "<TABLE WIDTH=250 CELLSPACING=1>";
                echo "<TH Class=titulo COLSPAN=2>Datos del Evento</TH>";
                echo "<TR>";
                echo "  <TD Class=captura>Tipo de Evento :</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_tipo')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Asunto:</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_asunto')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Detalle:</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_detalle')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Compromisos:</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_compromisos')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Cumplir Antes de:</TD>";
                echo "  <TD Class=mostrar>".$rs->Value('ca_fchcompromiso')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura>Evento Antecesor:</TD>";
                echo "  <TD Class=mostrar>";
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    if ($tm->Value('ca_idevento')==$rs->Value('ca_idantecedente')) {
                        echo $tm->Value('ca_asunto'); }
                    $tm->MoveNext();
                }
                echo "  </TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                $cadena = "?boton=Consultar\&id=".$rs->Value('ca_referencia');
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Evento'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php$cadena\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'AdicionarCs': {                                                  // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                $in =& DlRecordset::NewRecordset($conn);
                if (!$in->Open("select ca_idcliente, ca_hbls from vi_inoclientes_sea where ca_referencia = '$id' group by ca_idcliente, ca_hbls order by ca_hbls")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $cs =& DlRecordset::NewRecordset($conn);
                if (!$cs->Open("select c.ca_idcosto, c.ca_costo, c.ca_modalidad from tb_costos c, tb_inomaestra_sea i where c.ca_modalidad = i.ca_modalidad and c.ca_transporte = 'Mar�timo' and c.ca_impoexpo = 'Importaci�n' and i.ca_referencia = '$id' order by c.ca_costo")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($cs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $mn =& DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas where ca_idmoneda in ('COP','USD') order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function calc_utilidad(to){";
                echo "  to.value = Math.round(document.adicionar.venta.value - eval(document.adicionar.neto.value * document.adicionar.tcambio.value));";
                echo "}";
                echo "function calcular(){";
                echo "  document.adicionar.total.value=0;";
                echo "  for (cont=0; cont<adicionar.elements.length; cont++) {";
                echo "      if (adicionar.elements[cont].name == \"utilidades[]\"){";
                echo "          document.adicionar.total.value = eval(document.adicionar.total.value * 1) + eval(adicionar.elements[cont].value * 1);";
                echo "          adicionar.elements[cont].value = eval(adicionar.elements[cont].value * 1);";
                echo "         }";
                echo "      }";
                echo "}";
                echo "function validar(){";
                echo "  if (document.adicionar.factura.value == '' || document.adicionar.factura.value == 0)";
                echo "      alert('El campo Factura no puede ser Blanco igual a 0');";
                echo "  else if (!chkDate(document.adicionar.fchfactura))";
                echo "      document.adicionar.fchfactura.focus();";
                echo "  else if (document.adicionar.tcambio.value == '' || document.adicionar.tcambio.value == 0)";
                echo "      alert('El campo Tasa de Cambio no puede ser igual a 0');";
                echo "  else if (document.adicionar.neto.value == '' || document.adicionar.neto.value == 0)";
                echo "      alert('El campo Valor Neto no puede ser igual a 0');";
                echo "  else if (document.adicionar.venta.value == '' || document.adicionar.venta.value == 0)";
                echo "      alert('El campo Venta en Pesos no puede ser igual a 0');";
                echo "  else if (document.adicionar.utilidad.value !=  document.adicionar.total.value)";
                echo "      alert('No concuerda la utilidad en Venta con la Distribuci�n x Sobreventa');";
                echo "  else if (document.adicionar.proveedor.value == '')";
                echo "      alert('El Campo Proveedor debe ser diligenciado');";
                echo "  else";
                echo "      return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=610 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<TH Class=titulo COLSPAN=6 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n de la Factura</TH>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=2>Tabla de Costos:<BR><SELECT NAME='idcosto'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                while (!$cs->Eof()) {
                    echo"<OPTION VALUE=".$cs->Value('ca_idcosto').">".$cs->Value('ca_costo')."</OPTION>";
                    $cs->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Factura:<BR><INPUT TYPE='TEXT' NAME='factura' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar>Fecha Factura:<BR><INPUT TYPE='TEXT' NAME='fchfactura' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=listar>Moneda:<BR><SELECT NAME='idmoneda'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                while (!$mn->Eof()) {
                    echo"<OPTION VALUE=".$mn->Value('ca_idmoneda').">".$mn->Value('ca_nombre')."</OPTION>";
                    $mn->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Tasa de Cambio:<BR><INPUT TYPE='TEXT' NAME='tcambio' ONCHANGE='javascript:netopesos.value = Math.round(eval(neto.value * tcambio.value),2);' SIZE=9 MAXLENGTH=7></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Valor Neto:<BR><INPUT TYPE='TEXT' NAME='neto' SIZE=14 MAXLENGTH=15 ONCHANGE='javascript:netopesos.value = Math.round(eval(neto.value * tcambio.value),2);'></TD>";
                echo "  <TD Class=listar>Neto en Pesos:<BR><INPUT TYPE='TEXT' READONLY NAME='netopesos' SIZE=14 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar>Venta en Pesos:<BR><INPUT TYPE='TEXT' NAME='venta' SIZE=14 MAXLENGTH=15 ONCHANGE='javascript:utilidad.value=venta.value-Math.round(eval(neto.value * tcambio.value),2);' ONFOCUS='javascript:utilidad.value=venta.value-Math.round(eval(neto.value * tcambio.value),2);'></TD>";
                echo "  <TD Class=listar>Utilidad en Venta:<BR><INPUT TYPE='TEXT' READONLY NAME='utilidad' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar COLSPAN=2 ROWSPAN=3>Distribuci�n Utilidad x Sobreventa:<BR>";
                echo "  <TABLE CELLSPACING=1>";
                while (!$in->Eof()) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='hbls[]' VALUE='".$in->Value('ca_hbls')."' SIZE=23></TD>";
                    echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='utilidades[]' VALUE=0 ONCHANGE='calcular();' SIZE=13 MAXLENGTH=15></TD>";
                    echo "</TR>";
                    echo "<INPUT TYPE='HIDDEN' NAME='clientes[]' VALUE=".$in->Value('ca_idcliente').">";              // Hereda el Id del Cliente que se esta modificando
                    $in->MoveNext();
                }
                echo "<TR>";
                echo "  <TD Class=mostrar><B>Total Distribuci�n.... :</B></TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='total' VALUE=0 SIZE=13 MAXLENGTH=15></TD>";
                echo "</TR>";
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=4>Proveedor:<BR><INPUT TYPE='TEXT' NAME='proveedor' SIZE=70 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=4>".str_repeat("&nbsp;<BR>", $in->GetRowCount())."</TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Costo'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'ModificarCs': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                $in =& DlRecordset::NewRecordset($conn);
                if (!$in->Open("select ca_idcliente, ca_hbls from vi_inoclientes_sea where ca_referencia = '$id' group by ca_idcliente, ca_hbls order by ca_hbls")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $cs =& DlRecordset::NewRecordset($conn);
                if (!$cs->Open("select c.ca_idcosto, c.ca_costo, c.ca_modalidad from tb_costos c, tb_inomaestra_sea i where c.ca_modalidad = i.ca_modalidad and c.ca_transporte = 'Mar�timo' and c.ca_impoexpo = 'Importaci�n' and i.ca_referencia = '$id' order by c.ca_costo")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($cs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $mn =& DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas where ca_idmoneda in ('COP','USD') order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                if (!$rs->Open("select * from vi_inocostos_sea where ca_oid = ".$cl)) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $ut =& DlRecordset::NewRecordset($conn);
                if (!$ut->Open("select ca_idcliente, ca_hbls, ca_valor from tb_inoutilidad_sea where ca_referencia = '$id' and ca_idcosto = ".$rs->Value('ca_idcosto')." and ca_factura = '".$rs->Value('ca_factura')."' order by ca_hbls")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"".addslashes($ut->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function calc_utilidad(to){";
                echo "  to.value = Math.round(document.modificar.venta.value - eval(document.modificar.neto.value * document.modificar.tcambio.value));";
                echo "}";
                echo "function calcular(){";
                echo "  document.modificar.total.value=0;";
                echo "  for (cont=0; cont<modificar.elements.length; cont++) {";
                echo "      if (modificar.elements[cont].name == \"utilidades[]\"){";
                echo "          document.modificar.total.value = eval(document.modificar.total.value * 1) + eval(modificar.elements[cont].value * 1);";
                echo "          modificar.elements[cont].value = eval(modificar.elements[cont].value * 1);";
                echo "         }";
                echo "      }";
                echo "}";
                echo "function validar(){";
                echo "  if (document.modificar.factura.value == '' || document.modificar.factura.value == 0)";
                echo "      alert('El campo Factura no puede ser Blanco igual a 0');";
                echo "  else if (!chkDate(document.modificar.fchfactura))";
                echo "      document.modificar.fchfactura.focus();";
                echo "  else if (document.modificar.tcambio.value == '' || document.modificar.tcambio.value == 0)";
                echo "      alert('El campo Tasa de Cambio no puede ser igual a 0');";
                echo "  else if (document.modificar.neto.value == '' || document.modificar.neto.value == 0)";
                echo "      alert('El campo Valor Neto no puede ser igual a 0');";
                echo "  else if (document.modificar.venta.value == '' || document.modificar.venta.value == 0)";
                echo "      alert('El campo Venta en Pesos no puede ser igual a 0');";
                echo "  else if (document.modificar.utilidad.value !=  document.modificar.total.value)";
                echo "      alert('No concuerda la utilidad en Venta con la Distribuci�n x Sobreventa');";
                echo "  else if (document.modificar.proveedor.value == '')";
                echo "      alert('El Campo Proveedor debe ser diligenciado');";
                echo "  else";
                echo "      return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='modificar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=610 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";        // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=\"".$cl."\">";               // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='old_fact' VALUE=\"".$rs->Value('ca_factura')."\">";          // Controla el N�mero Actual de la Factura
                echo "<TH Class=titulo COLSPAN=6 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n de la Factura</TH>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=2>Tabla de Costos:<BR><SELECT NAME='idcosto'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                while (!$cs->Eof()) {
                    echo "<OPTION VALUE=".$cs->Value('ca_idcosto');
                    if ($rs->Value('ca_idcosto')==$cs->Value('ca_idcosto')) {
                        echo" SELECTED"; }
                    echo ">".$cs->Value('ca_costo')."</OPTION>";
                    $cs->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Factura:<BR><INPUT TYPE='TEXT' NAME='factura' VALUE='".$rs->Value('ca_factura')."' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar>Fecha Factura:<BR><INPUT TYPE='TEXT' NAME='fchfactura' VALUE='".$rs->Value('ca_fchfactura')."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=listar>Moneda:<BR><SELECT NAME='idmoneda'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                while (!$mn->Eof()) {
                    echo "<OPTION VALUE=".$mn->Value('ca_idmoneda');
                    if ($rs->Value('ca_idmoneda')==$mn->Value('ca_idmoneda')) {
                        echo" SELECTED"; }
                    echo ">".$mn->Value('ca_nombre')."</OPTION>";
                    $mn->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Tasa de Cambio:<BR><INPUT TYPE='TEXT' NAME='tcambio' VALUE='".$rs->Value('ca_tcambio')."' ONCHANGE='javascript:netopesos.value = Math.round(eval(neto.value * tcambio.value),2);' SIZE=9 MAXLENGTH=7></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Valor Neto:<BR><INPUT TYPE='TEXT' NAME='neto' VALUE='".$rs->Value('ca_neto')."' SIZE=14 MAXLENGTH=15 ONCHANGE='javascript:netopesos.value = Math.round(eval(neto.value * tcambio.value),2);'></TD>";
                echo "  <TD Class=listar>Neto en Pesos:<BR><INPUT TYPE='TEXT' READONLY NAME='netopesos' SIZE=14 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar>Venta en Pesos:<BR><INPUT TYPE='TEXT' NAME='venta' VALUE='".$rs->Value('ca_venta')."' SIZE=14 MAXLENGTH=15 ONCHANGE='javascript:utilidad.value=venta.value-Math.round(eval(neto.value * tcambio.value),2);' ONFOCUS='javascript:utilidad.value=venta.value-Math.round(eval(neto.value * tcambio.value),2);'></TD>";
                echo "  <TD Class=listar>Utilidad en Venta:<BR><INPUT TYPE='TEXT' READONLY NAME='utilidad' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar COLSPAN=2 ROWSPAN=3>Distribuci�n Utilidad x Sobreventa:<BR>";
                echo "  <TABLE CELLSPACING=1>";
                while (!$in->Eof()) {
                    $util = 0;
                    $ut->MoveFirst();
                    while (!$ut->Eof()) {
                        if ($in->Value('ca_hbls') == $ut->Value('ca_hbls') and $in->Value('ca_idcliente') == $ut->Value('ca_idcliente')) {
                            $util = $ut->Value('ca_valor');
                        }
                        $ut->MoveNext();
                    }
                    echo "<TR>";
                    echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='hbls[]' VALUE='".$in->Value('ca_hbls')."' SIZE=23></TD>";
                    echo "  <TD Class=mostrar><INPUT TYPE='TEXT' NAME='utilidades[]' VALUE=$util ONCHANGE='calcular();' SIZE=13 MAXLENGTH=15></TD>";
                    echo "</TR>";
                    echo "<INPUT TYPE='HIDDEN' NAME='clientes[]' VALUE=".$in->Value('ca_idcliente').">";              // Hereda el Id del Cliente que se esta modificando
                    $in->MoveNext();
                }
                echo "<TR>";
                echo "  <TD Class=mostrar><B>Total Distribuci�n.... :</B></TD>";
                echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='total' VALUE=0 SIZE=13 MAXLENGTH=15></TD>";
                echo "</TR>";
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=4>Proveedor:<BR><INPUT TYPE='TEXT' NAME='proveedor' VALUE='".$rs->Value('ca_proveedor')."' SIZE=71 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=4>".str_repeat("&nbsp;<BR>", $in->GetRowCount())."</TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<SCRIPT>javascript:modificar.netopesos.value = Math.round(eval(modificar.neto.value * modificar.tcambio.value),2); calcular();</SCRIPT>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Costo'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "<script>calc_utilidad(modificar.elements[\"utilidad\"])</script>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'EliminarCs': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inocostos_sea where ca_oid = ".$cl)) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='eliminar' ACTION='inosea.php'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";        // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=\"".$cl."\">";              // Hereda el Id de la Referencia que se esta modificando
                echo "<TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n de la Factura</TH>";

                $util_mem = number_format($rs->Value('ca_venta') - ($rs->Value('ca_neto') * $rs->Value('ca_tcambio')));
                echo "<TR>";
                echo "  <TD Class=listar ROWSPAN=3>Tabla de Costos:<BR>".$rs->Value('ca_costo')."</TD>";
                echo "  <TD Class=mostrar>Factura:<BR>".$rs->Value('ca_factura')."</TD>";
                echo "  <TD Class=mostrar>Fecha Factura:<BR>".$rs->Value('ca_fchfactura')."</TD>";
                echo "  <TD Class=mostrar>Moneda:<BR>".$rs->Value('ca_idmoneda')."</TD>";
                echo "  <TD Class=mostrar>Tasa de Cambio:<BR>".$rs->Value('ca_tcambio')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>Valor Neto:<BR>".$rs->Value('ca_neto')."</TD>";
                echo "  <TD Class=mostrar>Venta en Pesos:<BR>".$rs->Value('ca_venta')."</TD>";
                echo "  <TD Class=mostrar>Utilidad en Venta:<BR>$util_mem</TD>";
                echo "  <TD Class=mostrar>Vendedor:<BR>".$rs->Value('ca_login')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>Proveedor:<BR>".$rs->Value('ca_proveedor')."</TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Costo'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "<script>calc_utilidad(modificar.elements[\"utilidad\"])</script>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Contrato': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inoequipos_sea where ca_referencia = '".$id."' and ca_idequipo = '".$cl."'")) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.contrato.idcontrato.value == '')";
                echo "      alert('Debe ingresar un n�mero de Contrato de Comodato');";
                echo "  else if (document.contrato.fchcontrato.value == '')";
                echo "      alert('Ingrese la fecha del Contrato');";
                echo "  else if (document.contrato.inspeccion_fch.value != '' && document.contrato.inspeccion_nta.value == '')";
                echo "      alert('Ingrese el C�digo de la Nota de Inspecci�n');";
                echo "  else if (document.contrato.inspeccion_fch.value == '' && document.contrato.inspeccion_nta.value != '')";
                echo "      alert('Ingrese la fecha de la Nota de Inspecci�n');";
                echo "  else if (document.contrato.sitiodevolucion.value == '')";
                echo "      alert('Ingrese el nombre del Sitio para hacer la Devoluci�n');";
                echo "  else";
                echo "  	 return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='contrato' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=500 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";        // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='idequipo' VALUE=\"".$cl."\">";              // Hereda el Id de la Referencia que se esta modificando
                echo "<TH Class=titulo COLSPAN=4 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n del Contrato de Comodato</TH>";

                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=2><B>Concepto:</B><BR>".$rs->Value('ca_concepto')."</TD>";
                echo "  <TD Class=mostrar><B>Cantidad:</B><BR>".formatNumber($rs->Value('ca_cantidad'),3)."</TD>";
                echo "  <TD Class=mostrar><B>Id Equipo:</B><BR>".$rs->Value('ca_idequipo')."</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>No. Contrato:<BR><INPUT TYPE='TEXT' NAME='idcontrato' VALUE='".$rs->Value('ca_idcontrato')."' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=mostrar>Fch.Contrato:<BR><INPUT TYPE='TEXT' NAME='fchcontrato' VALUE='".$rs->Value('ca_fchcontrato')."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=mostrar>Nota Inspecci�n:<BR><INPUT TYPE='TEXT' NAME='inspeccion_nta' VALUE='".$rs->Value('ca_inspeccion_nta')."' SIZE=12 MAXLENGTH=10></TD>";
                echo "  <TD Class=mostrar>Fch. Nota:<BR><INPUT TYPE='TEXT' NAME='inspeccion_fch' VALUE='".$rs->Value('ca_inspeccion_fch')."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>Sitio de Devoluci�n:</TD>";
                echo "  <TD Class=mostrar COLSPAN=3><INPUT TYPE='TEXT' NAME='sitiodevolucion' VALUE='".$rs->Value('ca_sitiodevolucion')."' SIZE=70 MAXLENGTH=255></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=3 COLS=90>".$rs->Value('ca_observaciones_con')."</TEXTAREA></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Contrato'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'AdicionarCl': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$us->Open("select ca_impoexpo, ca_modalidad, ca_mbls from tb_inomaestra_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $impoexpo = $us->Value('ca_impoexpo');
                $modalidad= $us->Value('ca_modalidad');
                $mbls = explode("|",$us->Value('ca_mbls'));
                if (!$us->Open("select ca_valor from tb_parametros where ca_casouso = 'CU041'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $observaciones = array();
                $us->MoveFirst();
                while (!$us->Eof()) {
                    array_push($observaciones,$us->Value('ca_valor'));
                    $us->MoveNext();
                }
                $de =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$de->Open("select d.ca_iddeduccion, d.ca_deduccion from tb_deducciones d, tb_inomaestra_sea i where d.ca_habilitado = 't' and d.ca_transporte = 'Mar�timo' and d.ca_impoexpo = 'Importaci�n' and d.ca_modalidad = i.ca_modalidad and i.ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($de->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $mn =& DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.adicionar.idcliente.value == '')";
                echo "      alert('Debe seleccionar un cliente');";
                echo "  else if (document.adicionar.hbls.value == '')";
                echo "      alert('El N�mero de HBL no es v�lido');";
                echo "  else if (document.adicionar.fchhbls.value == '' || document.adicionar.fchhbls.value.length < 10)";
                echo "      alert('Ingrese la Fecha del Hbl, tenga en cuenta que deber�a ser la misma Fecha del Master.');";
                echo "  else if (document.adicionar.consecutivo.value == '' && document.adicionar.vigencia.value == 'true' && document.adicionar.impoexpo.value != 'OTM/DTA' && document.adicionar.modalidad.value != 'PARTICULARES')";
                echo "      alert('El N�mero de Reporte de Negocio no es v�lido');";
                echo "  else if (document.adicionar.numpiezas.value == '' || document.adicionar.numpiezas.value < 0)";
                echo "      alert('El n�mero de piezas no es v�lido');";
                echo "  else if (document.adicionar.peso.value == '' || document.adicionar.peso.value <= 0)";
                echo "      alert('El peso no es una cantidad v�lida');";
                echo "  else if (document.adicionar.volumen.value == '' || document.adicionar.volumen.value <= 0)";
                echo "      alert('El volumen no es una cantidad v�lida');";
                echo "  else if (document.adicionar.numorden.value == '')";
                echo "      alert('Debe ingresar el n�mero de Orden del Cliente');";
                echo "  else if (document.adicionar.numorden.value == '')";
                echo "      alert('Debe ingresar el n�mero de Orden del Cliente');";
                echo "  else if (document.adicionar.login.value == '')";
                echo "      alert('Debe seleccionar el nombre del Vendedor');";
                echo "  else if (document.adicionar.continuacion.value != 'N/A' && document.adicionar.idbodega.value == '')";
                echo "      alert('Debe seleccionar el Operador Multimodal');";
                echo "  else if (!eval(document.adicionar.validado.value))";
                echo "      alert('El peso o el volumen registrado superan la capacidad de carga total de la referencia. Ingrese nuevamente el volumen en M� y el peso en Kilos sin comas y utilizando el punto para separar decimales. Si se trata de un LCL aseg�rese de haber registrado en la master la cantidad de metros c�bicos y no el peso de mercancia en el concepto T/M3.');";
                echo "  else{";
                echo "      respuesta = true;";
                echo "      for (cont=0; cont<3; cont++) {";
                echo "           elemento = document.getElementById('factura_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               continue;";
                echo "              }";
                echo "           elemento = document.getElementById('fchfactura_' + cont);";
                echo "           if (!chkDate(elemento)){";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "           elemento = document.getElementById('valor_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               alert('Debe ingresar el Valor de la Factura del Cliente');";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "           elemento = document.getElementById('tcambio_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               alert('Debe ingresar la Tasa de Cambio de la Factura');";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "          }";
                echo "      i = 0;";
                echo "      pz = 0;";
                echo "      ps = 0;";
                echo "      while (isNaN(document.getElementById('contenedor_'+i+'_id'))) {";
                echo "          if (document.getElementById('contenedor_'+i+'_id').checked) {";
                echo "          	pz+= parseFloat(document.getElementById('contenedor_'+i+'_pz').value);";
                echo "          	ps+= parseFloat(document.getElementById('contenedor_'+i+'_ps').value);";
                echo "          }";
                echo "          i++;";
                echo "      }";
                echo "      if ((document.getElementById('numpiezas').value != roundNumber(pz,2) || document.getElementById('peso').value != roundNumber(ps,2)) && '$modalidad' != 'COLOADING' && '$modalidad' != 'PROYECTOS' && '$modalidad' != 'PARTICULARES' && '$impoexpo' != 'OTM/DTA'){";
                echo "               alert('Hay inconsistencia entre el Piezas/Peso y el desgloce en Contenedores');";
                echo "               respuesta = false;";
                echo "          }";
                echo "      if (respuesta){";
                echo "      	document.getElementById('continuacion_dest').disabled = false;";
                echo "      	document.getElementById('login').disabled = false;";
                echo "      	document.getElementById('idbodega').disabled = false;";
                echo "      	}";
                echo "      return (respuesta);";
                echo "      }";
                echo "  return (false);";
                echo "}";
                echo "function roundNumber(rnum, rlength) {"; // Arguments: number to round, number of decimal places
                echo "  var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);";
                echo "  return newnumber;"; // Output the result to the form field (change for your purposes)
                echo "}";
                echo "function llenar_select(){";
                echo "  for (cont=0; cont<5; cont++) {";
                echo "       elemento = document.getElementById('dedfactura_' + cont);";
                echo "       indice = elemento.selectedIndex;";
                echo "       elemento.length=0;";
                echo "       elemento.options[elemento.length] = new Option();";
                echo "       elemento.length=0;";
                echo "       for (numb=0; numb<3; numb++) {";
                echo "            fuente = document.getElementById('factura_' + numb);";
                echo "            opcion = (numb == indice) ? true : false;";
                echo "            if (fuente.value == '')continue;";
                echo "            elemento[elemento.length] = new Option(fuente.value,fuente.value,opcion,opcion);";
                echo "           }";
                echo "      }";
                echo "}";
                echo "function asignar(){";
                echo "  for (cont=0; cont<document.adicionar.login.length; cont++) {";
                echo "       if (document.adicionar.vendedor.value == document.adicionar.login[cont].value){";
                echo "           document.adicionar.login[cont].selected = true;";
                echo "       }else if (document.adicionar.vendedor.value == '' && document.adicionar.login[cont].value == 'Comercial'){";
                echo "           document.adicionar.login[cont].selected = true;";
                echo "       }";
                echo "  }";
                echo "}";
                echo "function buscar_cliente(){";
                echo "  findcliente.style.visibility = \"visible\";";
                echo "  findcliente.style.left = eval((document.body.clientWidth/2)-(600/2));";
                echo "  findcliente.style.top = document.body.clientHeight-152;";
                echo "}";
                echo "function buscar_reporte(){";
                echo "  idcliente = 0;";
                echo "  consecutivo = document.adicionar.consecutivo.value;";
                echo "  referencia = document.adicionar.referencia.value;";
                echo "  ventana = 'findreporte';";
                echo "  frame = document.getElementById(ventana + '_frame');";
                echo "  frame.style.height = document.body.clientHeight-16;";
                echo "  ventana = document.getElementById(ventana);";
                echo "  ventana.style.visibility = \"visible\";";
                echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
                echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
                echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
                echo "  frame.src='findreporte.php?opcion=find_reporte\&accion=Mar�timo'+'\&consecutivo='+consecutivo+'\&referencia='+referencia;";
                echo "}";
                echo "function valida_cantidades(){";
                echo "  frame = document.getElementById('findreporte_frame');";
                echo "  referencia = document.getElementById('referencia').value;";
                echo "  peso = document.getElementById('peso').value;";
                echo "  volumen = document.getElementById('volumen').value;";
                echo "  frame.src='ventanas.php?opcion=valida_cantidades&referencia='+referencia+'&peso='+peso+'&volumen='+volumen;";
                echo "}";
                echo "function asignar_vendedor(vendedor){";
                echo "  for (cont=0; cont<document.adicionar.login.length; cont++) {";
                echo "       if (document.adicionar.vendedor.value == vendedor){";
                echo "           document.adicionar.login[cont].selected = true;";
                echo "       }";
                echo "  }";
                echo "}";
                echo "function cambiar(element){";
                echo "  if(element.value != 'N/A'){";
                echo "     document.getElementById('idbodega').disabled = false;";
                echo "     document.getElementById('continuacion_dest').disabled = false;";
                echo "  }else{";
                echo "     document.getElementById('idbodega')[0].selected = true;";
                echo "     document.getElementById('idbodega').disabled = true;";
                echo "     document.getElementById('continuacion_dest')[0].selected = true;";
                echo "     document.getElementById('continuacion_dest').disabled = true;";
                echo "  }";
                echo "}";
                echo "function pesosCalc(element){";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  neto = document.getElementById('neto_'+index);";
                echo "  tcamb = document.getElementById('tcambio_'+index);";
                echo "  valor = document.getElementById('valor_'+index);";
                echo "  valor.value = Math.round(eval(neto.value) * eval(tcamb.value))";
                echo "}";
                echo "function aplica_trm(element){";
                echo "  i = 0;";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  factura = document.getElementById('dedfactura_'+index);";
                echo "  while (isNaN(document.getElementById('factura_'+i))) {";
                echo "     if (document.getElementById('factura_'+i).value == factura.value){";
                echo "         tcambio = document.getElementById('tcambio_'+i).value;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  document.getElementById('deduccion_'+index).value = document.getElementById('dedneto_'+index).value * tcambio;";
                echo "}";
                echo "function seldetails(element){";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  index = index.substring(0,index.indexOf('_'));";
                echo "  if(element.checked){";
                echo "  	document.getElementById('contenedor_'+index+'_pz').style.display = 'block';";
                echo "  	document.getElementById('contenedor_'+index+'_ps').style.display = 'block';";
                echo "  }else{";
                echo "  	document.getElementById('contenedor_'+index+'_pz').style.display = 'none';";
                echo "  	document.getElementById('contenedor_'+index+'_ps').style.display = 'none';";
                echo "  }";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<DIV ID='findcliente' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
                echo "  <IFRAME SRC='findcliente.php' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
                echo "  </IFRAME>";
                echo "</DIV>";
                echo "<DIV ID='findreporte' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
                echo "  <IFRAME ID='findreporte_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
                echo "  </IFRAME>";
                echo "</DIV>";
                list($mod, $tra, $mes, $con, $ano) = sscanf($id, "%d.%d.%d.%d.%d");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=550 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";              // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='impoexpo' VALUE=\"".$impoexpo."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='modalidad' VALUE=\"".$modalidad."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='vigencia' VALUE=\"".((mktime(0, 0, 0, $mes, 1, $ano)>=mktime(0, 0, 0, 4, 1, 2008))?'true':'false')."\">"; // Verifica si la Referencia es despu�s de 1 abril/2008
                echo "<INPUT TYPE='HIDDEN' NAME='vendedor'>";
                echo "<INPUT TYPE='HIDDEN' NAME='idreporte'>";
                echo "<INPUT TYPE='HIDDEN' NAME='validado'>";
                echo "<TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n del Cliente</TH>";
                echo "<TR>";
                echo "  <TD Class=mostrar>ID Reporte:<BR><INPUT TYPE='TEXT' NAME='consecutivo' SIZE=12 MAXLENGTH=10 READONLY>&nbsp;<a><IMG ID=report_lupa src='graficos/lupa.gif' onclick='buscar_reporte();' alt='Buscar' hspace='0' vspace='0'></a></TD>";
                echo "  <TD Class=listar>Vendedor:<BR><SELECT NAME='login'>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo "  <OPTION VALUE=''></OPTION>";
                if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_login').">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar>ID Proveedor:<BR><INPUT TYPE='TEXT' NAME='idproveedor' SIZE=10 MAXLENGTH=8></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Proveedor:<BR><INPUT TYPE='TEXT' NAME='proveedor' SIZE=40 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar style='vertical-align:bottom'>Id Cliente:<BR><INPUT TYPE='TEXT' NAME='idcliente' SIZE=11 MAXLENGTH=9>&nbsp;<a><IMG ID=client_lupa src='graficos/lupa.gif' onclick='buscar_cliente();' alt='Buscar' hspace='0' vspace='0'></a></TD>";
                echo "  <TD Class=mostrar COLSPAN=3>Nombre del Cliente:<BR><INPUT TYPE='TEXT' READONLY NAME='cliente' SIZE=60 MAXLENGTH=60></TD>";
                echo "  <TD Class=mostrar>Orden Cliente No.<BR><INPUT TYPE='TEXT' NAME='numorden' SIZE=17 MAXLENGTH=100></TD>";
                echo "</TR>";

                echo "<TR>";
                echo " <TD Class=invertir COLSPAN=2>";
                echo "  <TABLE WIDTH=100% CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>HBL:<BR><INPUT TYPE='TEXT' NAME='hbls' SIZE=25 MAXLENGTH=25></TD>";
                echo "    <TD Class=mostrar>Fch.HBL<BR><INPUT TYPE='TEXT' NAME='fchhbls' SIZE=12 VALUE='".((strlen($mbls[1])!=0)?$mbls[1]:date("Y-m-d"))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>No.Piezas:<BR><INPUT TYPE='TEXT' NAME='numpiezas' SIZE=6 MAXLENGTH=6></TD>";
                echo "    <TD Class=mostrar>No.Kilos:<BR><INPUT TYPE='TEXT' NAME='peso' SIZE=9 MAXLENGTH=9 ONCHANGE='valida_cantidades();'></TD>";
                echo "    <TD Class=mostrar>No.CMB:<BR><INPUT TYPE='TEXT' NAME='volumen' SIZE=13 MAXLENGTH=15 ONCHANGE='valida_cantidades();'></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "  <TD Class=mostrar>Continua/Viaje:<BR><SELECT NAME='continuacion' ONCHANGE='cambiar(this);'>";
                for ($i=0; $i<count($continuaciones); $i++) {
                    echo " <OPTION VALUE=".$continuaciones[$i].">".$continuaciones[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";

                if (!$us->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto not in ('Mar�timo', 'Ninguno')")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=2>Destino Final:<BR><SELECT NAME='continuacion_dest' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo"<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_idciudad').">".$us->Value('ca_ciudad')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  </TR>";
                echo "  <TR>";
                if (!$us->Open("select ca_idbodega, ca_nombre from tb_bodegas where ca_transporte = 'Mar�timo' and ca_tipo = 'Operador Multimodal'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=5>Operador:<BR><SELECT NAME='idbodega' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo"<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_idbodega').">".substr($us->Value('ca_nombre'),0,strpos($us->Value('ca_nombre'),' Nit.'))."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";

                echo "  </TR>";
                echo "  </TABLE>";
                echo " </TD>";

                echo " <TD Class=invertir COLSPAN=3>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '$id' and ca_idconcepto != 9")) {       // Selecciona todos lo registros de la tabla Equiposde una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Chk</TH>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                echo "  <TH>Piezas</TH>";
                echo "  <TH>Kilos</TH>";
                $i = 0;
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_id' TYPE='CHECKBOX' NAME='contenedores[$i][id]' VALUE='".$co->Value('ca_idequipo')."' ONCLICK='seldetails(this);'></TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_pz' TYPE='TEXT' NAME='contenedores[$i][pz]' SIZE=3 MAXLENGTH=6 style='display: none'></TD>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_ps' TYPE='TEXT' NAME='contenedores[$i][ps]' SIZE=3 MAXLENGTH=10 style='display: none'></TD>";
                    echo "</TR>";
                    $co->MoveNext();
                    $i++;
                }
                echo "  </TABLE>";
                echo " </TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><TABLE CELLSPACING=1 WIDTH=100%>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Datos de Facturaci�n del Cliente</B></TD>";
                echo "</TR>";
                for ($i=0; $i<3; $i++) {
                    echo "<TR>";
                    echo "  <INPUT ID=oid_fc_$i TYPE='HIDDEN' NAME='facturacion[$i][oid_fc]' VALUE=''>";
                    echo "  <TD Class=mostrar>Factura:<BR><INPUT ID=factura_$i TYPE='TEXT' NAME='facturacion[$i][factura]' SIZE=10 MAXLENGTH=15 ONCHANGE='llenar_select()'></TD>";
                    echo "  <TD Class=mostrar>Fch.Factura:<BR><INPUT ID=fchfactura_$i TYPE='TEXT' NAME='facturacion[$i][fchfactura]' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

                    echo "  <TD Class=mostrar>Valor:<BR><INPUT ID=neto_$i TYPE='TEXT' NAME='facturacion[$i][neto]' onchange='pesosCalc(this);' SIZE=8 MAXLENGTH=15></TD>";
                    echo "  <TD Class=mostrar>Moneda:<BR><SELECT NAME='facturacion[$i][moneda]'>";
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda')." ".(($mn->Value('ca_idmoneda')=='USD')?'SELECTED':'').">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext(); }
                    echo "   </SELECT></TD>";
                    echo "  <TD Class=mostrar>T.R.M.:<BR><INPUT ID=tcambio_$i TYPE='TEXT' NAME='facturacion[$i][tcambio]' onchange='pesosCalc(this);' SIZE=7 MAXLENGTH=7></TD>";
                    echo "  <TD Class=mostrar>Vlr.Pesos:<BR><INPUT ID=valor_$i TYPE='TEXT' NAME='facturacion[$i][valor]' SIZE=10 MAXLENGTH=15></TD>";
                    echo "  <TD Class=mostrar>Observaci�n IDG:<BR><SELECT ID=observacion_$i NAME='facturacion[$i][observacion]'>";
                    echo "  <OPTION VALUE=''></OPTION>";
                    for ($x=0; $x < count($observaciones); $x++) {
                        echo " <OPTION VALUE='".$observaciones[$x]."'>".$observaciones[$x]."</OPTION>";
                    }
                    echo "  </SELECT></TD>";
                    echo "</TR>";
                }
                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=6></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Conceptos Deducibles de la Factura</B></TD>";
                echo "</TR>";
                for ( $i=0; $i<5; $i++ ) {
                    echo "<TR>";
                    echo "  <TD Class=mostrar COLSPAN=2>Concepto a Deducir:<BR><SELECT ID=iddeduccion_$i NAME='deducibles[$i][iddeduccion]'>";
                    $de->MoveFirst();
                    while (!$de->Eof()) {
                        echo"<OPTION VALUE=".$de->Value('ca_iddeduccion').">".$de->Value('ca_deduccion')."</OPTION>";
                        $de->MoveNext();
                    }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=mostrar>Aplicar/Factura:<BR><SELECT ID=dedfactura_$i NAME='deducibles[$i][dedfactura]' ONCHANGE='aplica_trm(this);'></SELECT></TD>";
                    echo "  <TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' ID=dedneto_$i NAME='deducibles[$i][dedneto]' SIZE=10 MAXLENGTH=15 ONCHANGE='aplica_trm(this);'></TD>";
                    echo "  <TD Class=mostrar>Vlr.Pesos *:<BR><INPUT TYPE='TEXT' ID=deduccion_$i NAME='deducibles[$i][deduccion]' SIZE=10 MAXLENGTH=15 ONFOCUS='aplica_trm(this);'></TD>";
                    echo "</TR>";
                }
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>* Aplica la misma moneda y TRM de la factura</B></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar Cliente'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'ModificarCl': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inoclientes_sea where ca_referencia = '".$id."' and ca_idcliente = ".$cl." and ca_hbls = '".$hb."'")) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$us->Open("select ca_impoexpo, ca_modalidad, ca_mbls from tb_inomaestra_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $impoexpo = $us->Value('ca_impoexpo');
                $modalidad= $us->Value('ca_modalidad');
                $mbls = explode("|",$us->Value('ca_mbls'));
                if (!$us->Open("select ca_valor from tb_parametros where ca_casouso = 'CU041'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $observaciones = array();
                $us->MoveFirst();
                while (!$us->Eof()) {
                    array_push($observaciones,$us->Value('ca_valor'));
                    $us->MoveNext();
                }
                $de =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$de->Open("select d.ca_iddeduccion, d.ca_deduccion from tb_deducciones d, tb_inomaestra_sea i where d.ca_habilitado = 't' and d.ca_transporte = 'Mar�timo' and d.ca_impoexpo = 'Importaci�n' and d.ca_modalidad = i.ca_modalidad and i.ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($de->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $mn =& DlRecordset::NewRecordset($conn);
                if (!$mn->Open("select ca_idmoneda, ca_nombre from tb_monedas order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Monedas
                    echo "<script>alert(\"".addslashes($mn->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'reportenegocio.php';</script>";
                    exit; }
                $dd =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$dd->Open("select oid as ca_oid, ca_factura, ca_iddeduccion, ca_neto, ca_valor from tb_inodeduccion_sea where ca_referencia = '".$id."' and ca_idcliente = ".$cl." and ca_hbls = '".$hb."'")) {
                    echo "<script>alert(\"".addslashes($dd->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.modificar.consecutivo.value == '' && document.modificar.vigencia.value == 'true' && document.modificar.impoexpo.value != 'OTM/DTA')";
                echo "      alert('El N�mero de Reporte de Negocio no es v�lido');";
                echo "  else if (document.modificar.hbls.value == '')";
                echo "      alert('El N�mero de HBL no es v�lido');";
                echo "  else if (document.modificar.fchhbls.value == '' || document.modificar.fchhbls.value.length < 10)";
                echo "      alert('Ingrese la Fecha del Hbl, tenga en cuenta que deber�a ser la misma Fecha del Master.');";
                echo "  else if (document.modificar.numpiezas.value == '' || document.modificar.numpiezas.value < 0)";
                echo "      alert('El n�mero de piezas no es v�lido');";
                echo "  else if (document.modificar.peso.value == '' || document.modificar.peso.value <= 0)";
                echo "      alert('El peso no es una cantidad v�lida');";
                echo "  else if (document.modificar.volumen.value == '' || document.modificar.volumen.value <= 0)";
                echo "      alert('El volumen no es una cantidad v�lida');";
                echo "  else if (document.modificar.numorden.value == '')";
                echo "      alert('Debe ingresar el n�mero de Orden del Cliente');";
                echo "  else if (document.modificar.login.value == '')";
                echo "      alert('Debe seleccionar el nombre del Vendedor');";
                echo "  else if (!eval(document.modificar.validado.value))";
                echo "      alert('El peso o el volumen registrado superan la capacidad de carga total de la referencia. Ingrese nuevamente el volumen en M� y el peso en Kilos. Si se trata de un LCL aseg�rese de haber registrado en la master la cantidad de metros c�bicos y no el peso de mercancia en el concepto T/M3.');";
                echo "  else{";
                echo "      respuesta = true;";
                echo "      elementos = document.getElementById('num_reg');";
                echo "      for (cont=0; cont<elementos.value; cont++) {";
                echo "           elemento = document.getElementById('factura_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               continue;";
                echo "              }";
                echo "           elemento = document.getElementById('fchfactura_' + cont);";
                echo "           if (!chkDate(elemento)){";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "           elemento = document.getElementById('valor_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               alert('Debe ingresar el Valor de la Factura del Cliente');";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "           elemento = document.getElementById('tcambio_' + cont);";
                echo "           if (elemento.value == ''){";
                echo "               alert('Debe ingresar la Tasa de Cambio de la Factura');";
                echo "               elemento.focus();";
                echo "               respuesta = false;";
                echo "               break;";
                echo "              }";
                echo "          }";
                echo "      i = 0;";
                echo "      pz = 0;";
                echo "      ps = 0;";
                echo "      while (isNaN(document.getElementById('contenedor_'+i+'_id'))) {";
                echo "          if (document.getElementById('contenedor_'+i+'_id').checked) {";
                echo "          	pz+= parseFloat(document.getElementById('contenedor_'+i+'_pz').value);";
                echo "          	ps+= parseFloat(document.getElementById('contenedor_'+i+'_ps').value);";
                echo "          }";
                echo "          i++;";
                echo "      }";
                echo "      if ((document.getElementById('numpiezas').value != roundNumber(pz,2) || document.getElementById('peso').value != roundNumber(ps,2)) && '$modalidad' != 'COLOADING' && '$modalidad' != 'PROYECTOS' && '$modalidad' != 'PARTICULARES' && '$impoexpo' != 'OTM/DTA'){";
                echo "               alert('Hay inconsistencia entre el Piezas/Peso y el desgloce en Contenedores');";
                echo "               respuesta = false;";
                echo "          }";
                echo "      if (respuesta){";
                echo "      	document.getElementById('continuacion_dest').disabled = false;";
                echo "      	document.getElementById('login').disabled = false;";
                echo "      	document.getElementById('idbodega').disabled = false;";
                echo "      	}";
                echo "      return (respuesta);";
                echo "      }";
                echo "  return (false);";
                echo "}";
                echo "function roundNumber(rnum, rlength) {"; // Arguments: number to round, number of decimal places
                echo "  var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);";
                echo "  return newnumber;"; // Output the result to the form field (change for your purposes)
                echo "}";
                echo "function llenar_select(){";
                echo "  facturas  = document.getElementById('num_reg');";
                echo "  elementos = document.getElementById('num_ded');";
                echo "  for (cont=0; cont<elementos.value; cont++) {";
                echo "       elemento = document.getElementById('dedfactura_' + cont);";
                echo "       indice = elemento.selectedIndex;";
                echo "       elemento.length=0;";
                echo "       elemento.options[elemento.length] = new Option();";
                echo "       elemento.length=0;";
                echo "       for (numb=0; numb<facturas.value; numb++) {";
                echo "            fuente = document.getElementById('factura_' + numb);";
                echo "            opcion = (numb == indice) ? true : false;";
                echo "            if (fuente.value == '')continue;";
                echo "            elemento[elemento.length] = new Option(fuente.value,fuente.value,opcion,opcion);";
                echo "           }";
                echo "      }";
                echo "}";
                echo "function buscar_reporte(){";
                echo "  idcliente = 0;";
                echo "  consecutivo = document.modificar.consecutivo.value;";
                echo "  referencia = document.modificar.referencia.value;";
                echo "  ventana = 'findreporte';";
                echo "  frame = document.getElementById(ventana + '_frame');";
                echo "  frame.style.height = document.body.clientHeight-16;";
                echo "  ventana = document.getElementById(ventana);";
                echo "  ventana.style.visibility = \"visible\";";
                echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
                echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
                echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
                echo "  frame.src='findreporte.php?opcion=find_reporte\&accion=Mar�timo'+'\&consecutivo='+consecutivo+'\&referencia='+referencia;";
                echo "}";
                echo "function asignar(){";
                echo "  for (cont=0; cont<document.modificar.login.length; cont++) {";
                echo "       if (document.modificar.vendedor.value == document.modificar.login[cont].value){";
                echo "           document.modificar.login[cont].selected = true;";
                echo "       }else if (document.modificar.vendedor.value == '' && document.modificar.login[cont].value == 'Comercial'){";
                echo "           document.modificar.login[cont].selected = true;";
                echo "       }";
                echo "  }";
                echo "}";
                echo "function valida_cantidades(){";
                echo "  frame = document.getElementById('findreporte_frame');";
                echo "  referencia = document.getElementById('referencia').value;";
                echo "  peso = document.getElementById('peso').value - document.getElementById('peso_ant').value;";
                echo "  volumen = document.getElementById('volumen').value - document.getElementById('volumen_ant').value;;";
                echo "  frame.src='ventanas.php?opcion=valida_cantidades&referencia='+referencia+'&peso='+peso+'&volumen='+volumen;";
                echo "  if (document.getElementById('consecutivo').value == ''){";
                echo "		document.getElementById('login').disabled = false }";
                echo "}";
                echo "function cambiar(element){";
                echo "  if(element.value != 'N/A'){";
                echo "     document.getElementById('idbodega').disabled = false;";
                echo "     document.getElementById('continuacion_dest').disabled = false;";
                echo "  }else{";
                echo "     document.getElementById('idbodega')[0].selected = true;";
                echo "     document.getElementById('idbodega').disabled = true;";
                echo "     document.getElementById('continuacion_dest')[0].selected = true;";
                echo "     document.getElementById('continuacion_dest').disabled = true;";
                echo "  }";
                echo "}";
                echo "function pesosCalc(element){";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  neto = document.getElementById('neto_'+index);";
                echo "  tcamb = document.getElementById('tcambio_'+index);";
                echo "  valor = document.getElementById('valor_'+index);";
                echo "  valor.value = Math.round(eval(neto.value) * eval(tcamb.value))";
                echo "}";
                echo "function aplica_trm(element){";
                echo "  i = 0;";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  factura = document.getElementById('dedfactura_'+index);";
                echo "  while (isNaN(document.getElementById('factura_'+i))) {";
                echo "     if (document.getElementById('factura_'+i).value == factura.value){";
                echo "         tcambio = document.getElementById('tcambio_'+i).value;";
                echo "     }";
                echo "     i++;";
                echo "  }";
                echo "  document.getElementById('deduccion_'+index).value = document.getElementById('dedneto_'+index).value * tcambio;";
                echo "}";
                echo "function borrar_deduccion(element){";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  document.getElementById('dedneto_'+index).value = '';";
                echo "  document.getElementById('deduccion_'+index).value = '';";
                echo "}";
                echo "function seldetails(element){";
                echo "  index = element.id.substring(element.id.indexOf('_')+1);";
                echo "  index = index.substring(0,index.indexOf('_'));";
                echo "  if(element.checked){";
                echo "  	document.getElementById('contenedor_'+index+'_pz').style.display = 'block';";
                echo "  	document.getElementById('contenedor_'+index+'_ps').style.display = 'block';";
                echo "  }else{";
                echo "  	document.getElementById('contenedor_'+index+'_pz').style.display = 'none';";
                echo "  	document.getElementById('contenedor_'+index+'_ps').style.display = 'none';";
                echo "  }";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<DIV ID='findreporte' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
                echo "  <IFRAME ID='findreporte_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
                echo "  </IFRAME>";
                echo "</DIV>";
                list($mod, $tra, $mes, $con, $ano) = sscanf($id, "%d.%d.%d.%d.%d");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='modificar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con los datos del registro
                echo "<TABLE WIDTH=550 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='oid' VALUE=\"".$rs->Value('ca_oid')."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='impoexpo' VALUE=\"".$impoexpo."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='vigencia' VALUE=\"".((mktime(0, 0, 0, $mes, 1, $ano)>=mktime(0, 0, 0, 4, 1, 2008))?'true':'false')."\">"; // Verifica si la Referencia es despu�s de 1 abril/2008
                echo "<INPUT TYPE='HIDDEN' NAME='hbl' VALUE=\"".$rs->Value('ca_hbls')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='peso_ant' VALUE=\"".$rs->Value('ca_peso')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='volumen_ant' VALUE=\"".$rs->Value('ca_volumen')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='idreporte' VALUE=\"".$rs->Value('ca_idreporte')."\">";
                echo "<INPUT TYPE='HIDDEN' NAME='validado'>";
                echo "<TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n del Cliente</TH>";
                echo "<TR>";
                echo "  <TD Class=mostrar>ID Reporte:<BR><INPUT TYPE='TEXT' NAME='consecutivo' VALUE='".$rs->Value('ca_consecutivo')."' SIZE=12 MAXLENGTH=10 READONLY>&nbsp;<a><IMG ID=report_lupa src='graficos/lupa.gif' onclick='buscar_reporte();' alt='Buscar' hspace='0' vspace='0'></a></TD>";
                echo "  <TD Class=listar>Vendedor:<BR><SELECT NAME='login' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo"<OPTION VALUE=''></OPTION>";
                if (!$us->Open("select ca_login, ca_nombre from control.tb_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Sucursal' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_login');
                    if ($rs->Value('ca_login')==$us->Value('ca_login')) {
                        echo " SELECTED"; }
                    echo">".$us->Value('ca_nombre')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar>ID Proveedor:<BR><INPUT TYPE='TEXT' NAME='idproveedor' VALUE='".$rs->Value('ca_idproveedor')."' SIZE=10 MAXLENGTH=8></TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Proveedor:<BR><INPUT TYPE='TEXT' NAME='proveedor' VALUE='".$rs->Value('ca_proveedor')."' SIZE=40 MAXLENGTH=50></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar style='vertical-align:bottom'>Id Cliente:<BR><INPUT TYPE='TEXT' NAME='idcliente' VALUE='".$rs->Value('ca_idcliente')."' SIZE=11 MAXLENGTH=9 READONLY></TD>";
                echo "  <TD Class=mostrar COLSPAN=3>Nombre del Cliente:<BR><INPUT TYPE='TEXT' READONLY NAME='cliente' VALUE='".$rs->Value('ca_compania')."' SIZE=60 MAXLENGTH=60 READONLY></TD>";
                echo "  <TD Class=mostrar>Orden Cliente No.<BR><INPUT TYPE='TEXT' NAME='numorden' VALUE='".$rs->Value('ca_numorden')."' SIZE=17 MAXLENGTH=100></TD>";
                echo "</TR>";

                echo "<TR>";
                echo " <TD Class=invertir COLSPAN=2>";
                echo "  <TABLE WIDTH=100% CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>HBL:<BR><INPUT TYPE='TEXT' NAME='hbls' VALUE='".$rs->Value('ca_hbls')."' SIZE=25 MAXLENGTH=25></TD>";
                echo "    <TD Class=mostrar>Fch.HBL<BR><INPUT TYPE='TEXT' NAME='fchhbls' SIZE=12 VALUE='".((strlen($rs->Value('ca_fchhbls'))!=0)?$rs->Value('ca_fchhbls'):(strlen($mbls[1])!=0)?$mbls[1]:date("Y-m-d"))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>No.Piezas:<BR><INPUT ID=='numpiezas' TYPE='TEXT' NAME='numpiezas' VALUE='".$rs->Value('ca_numpiezas')."' SIZE=6 MAXLENGTH=6></TD>";
                echo "    <TD Class=mostrar>No.Kilos:<BR><INPUT TYPE='TEXT' NAME='peso' VALUE='".$rs->Value('ca_peso')."' SIZE=9 MAXLENGTH=9 ONCHANGE='valida_cantidades();'></TD>";
                echo "    <TD Class=mostrar>No.CMB:<BR><INPUT TYPE='TEXT' NAME='volumen' VALUE='".$rs->Value('ca_volumen')."' SIZE=13 MAXLENGTH=15 ONCHANGE='valida_cantidades();'></TD>";
                echo "  </TR>";

                echo "  <TR>";
                echo "  <TD Class=mostrar>Continua/Viaje:<BR><SELECT NAME='continuacion' ONCHANGE='cambiar(this);'>";
                for ($i=0; $i<count($continuaciones); $i++) {
                    echo " <OPTION VALUE=".$continuaciones[$i];
                    if ($rs->Value('ca_continuacion')==$continuaciones[$i]) {
                        echo " SELECTED"; }
                    echo">".$continuaciones[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";

                if (!$us->Open("select ca_idciudad, ca_ciudad from vi_ciudades where ca_idtrafico = 'CO-057' and ca_puerto not in ('Mar�timo', 'Ninguno')")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=2>Destino Final:<BR><SELECT NAME='continuacion_dest' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo"<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_idciudad');
                    if ($rs->Value('ca_continuacion_dest')==$us->Value('ca_idciudad')) {
                        echo " SELECTED"; }
                    echo">".$us->Value('ca_ciudad')."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  </TR>";
                echo "  <TR>";
                if (!$us->Open("select ca_idbodega, ca_nombre from tb_bodegas where ca_transporte = 'Mar�timo' and ca_tipo = 'Operador Multimodal'")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=5>Operador:<BR><SELECT NAME='idbodega' DISABLED>";  // Llena el cuadro de lista con los valores de la tabla Vendedores
                echo"<OPTION VALUE=''></OPTION>";
                while (!$us->Eof()) {
                    echo"<OPTION VALUE=".$us->Value('ca_idbodega');
                    if ($rs->Value('ca_idbodega')==$us->Value('ca_idbodega')) {
                        echo " SELECTED"; }
                    echo">".substr($us->Value('ca_nombre'),0,strpos($us->Value('ca_nombre'),' Nit.'))."</OPTION>";
                    $us->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <script>cambiar(document.getElementById('continuacion'));</script>";
                echo "  </TR>";
                echo "  </TABLE>";
                echo " </TD>";
                echo " <TD Class=invertir COLSPAN=3>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '$id' and ca_idconcepto != 9")) {       // Selecciona todos lo registros de la tabla Equiposde una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Chk</TH>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                echo "  <TH>Piezas</TH>";
                echo "  <TH>Kilos</TH>";
                $array_cont = array();
                foreach (explode("|",$rs->Value('ca_contenedores')) as $parcial) {
                    $sub_array = explode(";",$parcial);
                    $array_cont[$sub_array[0]]['pz'] = $sub_array[1];
                    $array_cont[$sub_array[0]]['ps'] = $sub_array[2];
                }
                $i = 0;
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    $cadena = (array_key_exists($co->Value('ca_idequipo'), $array_cont))?" CHECKED":"";
                    $vista = ($cadena=="")?"style='display: none'":"";
                    echo "<TR>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_id' TYPE='CHECKBOX' NAME='contenedores[$i][id]' VALUE='".$co->Value('ca_idequipo')."' ONCLICK='seldetails(this);' $cadena></TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_pz' TYPE='TEXT' NAME='contenedores[$i][pz]' VALUE='".$array_cont[$co->Value('ca_idequipo')]['pz']."' SIZE=3 MAXLENGTH=6 $vista></TD>";
                    echo "  <TD Class=listar><INPUT ID='contenedor_".$i."_ps' TYPE='TEXT' NAME='contenedores[$i][ps]' VALUE='".$array_cont[$co->Value('ca_idequipo')]['ps']."' SIZE=3 MAXLENGTH=10 $vista></TD>";
                    echo "</TR>";
                    $co->MoveNext();
                    $i++;
                }
                echo "  </TABLE>";
                echo " </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><TABLE CELLSPACING=1 WIDTH=505>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Datos de Facturaci�n del Cliente</B></TD>";
                echo "</TR>";
                $i = 0;
                $num_reg = $rs->mRowCount + 1;
                echo "<INPUT ID=num_reg TYPE='HIDDEN' NAME='num_reg' VALUE=".$num_reg.">";              // Hereda el Id del registro que se esta modificando
                do {
                    echo "<TR>";
                    echo "  <INPUT ID=oid_fc_$i TYPE='HIDDEN' NAME='facturacion[$i][oid_fc]' VALUE=".$rs->Value('ca_oid_fc').">";
                    echo "  <TD Class=mostrar>Factura:<BR><INPUT ID=factura_$i TYPE='TEXT' NAME='facturacion[$i][factura]' VALUE='".$rs->Value('ca_factura')."' SIZE=10 MAXLENGTH=15 ONCHANGE='llenar_select();'></TD>";
                    echo "  <TD Class=mostrar>Fch.Factura:<BR><INPUT ID=fchfactura_$i TYPE='TEXT' NAME='facturacion[$i][fchfactura]' VALUE='".(($rs->Value('ca_fchfactura')!='')?$rs->Value('ca_fchfactura'):date("Y-m-d"))."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                    echo "  <TD Class=mostrar>Valor:<BR><INPUT ID=neto_$i TYPE='TEXT' NAME='facturacion[$i][neto]' onchange='pesosCalc(this);' VALUE='".$rs->Value('ca_neto')."' SIZE=8 MAXLENGTH=15></TD>";
                    echo "  <TD Class=mostrar>Moneda:<BR><SELECT ID=moneda_$i NAME='facturacion[$i][moneda]'>";
                    $idm = (strlen($rs->Value('ca_idmoneda'))!=0)?$rs->Value('ca_idmoneda'):'USD';
                    $mn->MoveFirst();
                    while (!$mn->Eof()) {
                        echo "<OPTION VALUE=".$mn->Value('ca_idmoneda')." ".(($mn->Value('ca_idmoneda')==$idm)?'SELECTED':'').">".$mn->Value('ca_idmoneda')."</OPTION>";
                        $mn->MoveNext(); }
                    echo "   </SELECT></TD>";
                    echo "  <TD Class=mostrar>T.R.M.:<BR><INPUT ID=tcambio_$i TYPE='TEXT' NAME='facturacion[$i][tcambio]' onchange='pesosCalc(this);' VALUE='".$rs->Value('ca_tcambio')."' SIZE=9 MAXLENGTH=7></TD>";
                    echo "  <TD Class=mostrar>Vlr.Pesos:<BR><INPUT ID=valor_$i TYPE='TEXT' NAME='facturacion[$i][valor]' VALUE='".$rs->Value('ca_valor')."' SIZE=12 MAXLENGTH=15></TD>";
                    echo "  <TD Class=mostrar>Observaci�n IDG:<BR><SELECT ID=observacion_$i NAME='facturacion[$i][observacion]'>";
                    echo "  <OPTION VALUE=''></OPTION>";
                    for ($x=0; $x < count($observaciones); $x++) {
                        echo " <OPTION VALUE='".$observaciones[$x]."'";
                        if (trim($rs->Value('ca_observaciones_fact'))==$observaciones[$x]) {
                            echo" SELECTED"; }
                        echo ">".$observaciones[$x]."</OPTION>";
                    }
                    echo "  </SELECT></TD>";
                    echo "</TR>";
                    $con_mem = '';
                    $rs->MoveNext();
                    $i++;
                } while(!$rs->Eof());
                echo "<TR>";
                echo "  <INPUT ID=oid_fc_$i TYPE='HIDDEN' NAME='facturacion[$i][oid_fc]' VALUE=''>";
                echo "  <TD Class=mostrar>Factura:<BR><INPUT ID=factura_$i TYPE='TEXT' NAME='facturacion[$i][factura]' SIZE=10 MAXLENGTH=15 ONCHANGE='llenar_select()'></TD>";
                echo "  <TD Class=mostrar>Fch.Factura:<BR><INPUT ID=fchfactura_$i TYPE='TEXT' NAME='facturacion[$i][fchfactura]' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=mostrar>Valor:<BR><INPUT ID=neto_$i TYPE='TEXT' NAME='facturacion[$i][neto]' onchange='pesosCalc(this);' SIZE=8 MAXLENGTH=15></TD>";
                echo "  <TD Class=mostrar>Moneda:<BR><SELECT ID=moneda_$i NAME='facturacion[$i][moneda]'>";
                $mn->MoveFirst();
                while (!$mn->Eof()) {
                    echo "<OPTION VALUE=".$mn->Value('ca_idmoneda')." ".(($mn->Value('ca_idmoneda')=='USD')?'SELECTED':'').">".$mn->Value('ca_idmoneda')."</OPTION>";
                    $mn->MoveNext(); }
                echo "   </SELECT></TD>";
                echo "  <TD Class=mostrar>T.R.M.:<BR><INPUT ID=tcambio_$i TYPE='TEXT' NAME='facturacion[$i][tcambio]' onchange='pesosCalc(this);' SIZE=9 MAXLENGTH=7></TD>";
                echo "  <TD Class=mostrar>Vlr.Pesos:<BR><INPUT ID=valor_$i TYPE='TEXT' NAME='facturacion[$i][valor]' onchange='pesosCalc(this);' SIZE=12 MAXLENGTH=15></TD>";
                echo "  <TD Class=mostrar>Observaci�n IDG:<BR><SELECT ID=observacion_$i NAME='facturacion[$i][observacion]'>";
                echo "  <OPTION VALUE=''></OPTION>";
                for ($x=0; $x < count($observaciones); $x++) {
                    echo " <OPTION VALUE='".$observaciones[$x]."'>".$observaciones[$x]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "  </TABLE></TD>";

                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=5></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Conceptos Deducibles de la Factura</B></TD>";
                echo "</TR>";
                $j = 0;
                echo "<INPUT ID=num_ded TYPE='HIDDEN' NAME='num_ded' VALUE=".($dd->mRowCount + 5).">";              // Hereda el Id del registro que se esta modificando
                while (!$dd->Eof()) {
                    echo "<TR>";
                    echo "  <INPUT ID=oid_$j TYPE='HIDDEN' NAME='deducibles[$j][oid]' VALUE=".$dd->Value('ca_oid').">";
                    echo "  <TD Class=mostrar COLSPAN=2>Concepto a Deducir:<BR><SELECT ID=iddeduccion_$j NAME='deducibles[$j][iddeduccion]'>";
                    $de->MoveFirst();
                    while (!$de->Eof() ) {
                        echo"<OPTION VALUE=".$de->Value('ca_iddeduccion');
                        if ($de->Value('ca_iddeduccion')==$dd->Value('ca_iddeduccion')) {
                            echo " SELECTED"; }
                        echo">".$de->Value('ca_deduccion')."</OPTION>";
                        $de->MoveNext();
                    }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=mostrar>Aplicar/Factura:<BR><SELECT ID=dedfactura_$j NAME='deducibles[$j][dedfactura]' ONCHANGE='aplica_trm(this);'>";
                    $rs->MoveFirst();
                    while (!$rs->Eof()) {
                        echo"<OPTION VALUE=".$rs->Value('ca_factura');
                        if ($rs->Value('ca_factura')==$dd->Value('ca_factura')) {
                            echo " SELECTED"; }
                        echo">".$rs->Value('ca_factura')."</OPTION>";
                        $rs->MoveNext();
                    }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' ID=dedneto_$j NAME='deducibles[$j][dedneto]' VALUE='".$dd->Value('ca_neto')."' SIZE=10 MAXLENGTH=15 ONCHANGE='aplica_trm(this);'></TD>";
                    echo "  <TD Class=mostrar>Vlr.Pesos *:<BR><INPUT TYPE='TEXT' ID=deduccion_$j NAME='deducibles[$j][deduccion]' VALUE='".$dd->Value('ca_valor')."' SIZE=10 MAXLENGTH=15 ONFOCUS='aplica_trm(this);'>&nbsp;<IMG ID=borrar_$j src='graficos/no.gif' alt='Eliminar entrada' hspace='0' vspace='0' onclick='borrar_deduccion(this)'></TD>";
                    echo "</TR>";
                    $dd->MoveNext();
                    $j++;
                }
                for ($i=$j; $i<$j+5; $i++) {
                    echo "<TR>";
                    echo "  <INPUT ID=oid_$i TYPE='HIDDEN' NAME='deducibles[$i][oid]' VALUE=''>";
                    echo "  <TD Class=mostrar COLSPAN=2>Concepto a Deducir:<BR><SELECT ID=iddeduccion_$i NAME='deducibles[$i][iddeduccion]'>";
                    $de->MoveFirst();
                    while (!$de->Eof()) {
                        echo"<OPTION VALUE=".$de->Value('ca_iddeduccion').">".$de->Value('ca_deduccion')."</OPTION>";
                        $de->MoveNext();
                    }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=mostrar>Aplicar/Factura:<BR><SELECT ID=dedfactura_$i NAME='deducibles[$i][dedfactura]' ONCHANGE='aplica_trm(this);'>";
                    $rs->MoveFirst();
                    while (!$rs->Eof()) {
                        echo"<OPTION VALUE=".$rs->Value('ca_factura');
                        if ($rs->Value('ca_factura')==$dd->Value('ca_factura')) {
                            echo " SELECTED"; }
                        echo">".$rs->Value('ca_factura')."</OPTION>";
                        $rs->MoveNext();
                    }
                    echo "  </SELECT></TD>";
                    echo "  <TD Class=mostrar>Valor:<BR><INPUT TYPE='TEXT' ID=dedneto_$i NAME='deducibles[$i][dedneto]' SIZE=10 MAXLENGTH=15 ONCHANGE='aplica_trm(this);'></TD>";
                    echo "  <TD Class=mostrar>Vlr.Pesos *:<BR><INPUT TYPE='TEXT' ID=deduccion_$i NAME='deducibles[$i][deduccion]' SIZE=10 MAXLENGTH=15 ONFOCUS='aplica_trm(this);'></TD>";
                    echo "</TR>";
                }
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>* Aplica la misma moneda y TRM de la factura</B></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<script>valida_cantidades();</script>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar Cliente'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'EliminarCl': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inoclientes_sea where ca_referencia = '".$id."' and ca_idcliente = ".$cl." and ca_hbls = '".$hb."'")) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$us->Open("select ca_login from control.tb_usuarios where ca_login != 'Administrador' order by ca_login")) {
                    echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $us->MoveFirst();
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  return (true);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='eliminar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con los datos del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='idcliente' VALUE=\"".$cl."\">";              // Hereda el Id del Cliente que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='hbl' VALUE=\"".$hb."\">";                    // Hereda el Id del Cliente que se esta modificando
                echo "<TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n del Cliente</TH>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>ID Reporte:</B><BR>".$rs->Value('ca_consecutivo')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>Vendedor:</B><BR>".$rs->Value('ca_login')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>ID Proveedor:</B><BR>".$rs->Value('ca_idproveedor')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=2><B>Proveedor:</B><BR>".$rs->Value('ca_proveedor')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>Id Cliente:</B><BR>".number_format($rs->Value('ca_idcliente'))."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=3><B>Nombre del Cliente:</B><BR>".$rs->Value('ca_compania')."</TD>";
                echo "  <TD Class=mostrar>Orden Cliente No.<BR>".$rs->Value('ca_numorden')."</TD>";
                echo "</TR>";

                echo "<TR>";
                echo " <TD Class=invertir COLSPAN=2>";
                echo "  <TABLE WIDTH=100% CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>HBL:<BR>".$rs->Value('ca_hbls')."</TD>";
                echo "    <TD Class=mostrar>Fch.HBL<BR>".$rs->Value('ca_fchhbls')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>No.Piezas:<BR>".$rs->Value('ca_numpiezas')."</TD>";
                echo "    <TD Class=mostrar>No.Kilos:<BR>".$rs->Value('ca_peso')."</TD>";
                echo "    <TD Class=mostrar>No.CMB:<BR>".$rs->Value('ca_volumen')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "  <TD Class=mostrar>Continua/Viaje:<BR>".$rs->Value('ca_continuacion')."</TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Destino Final:<BR>".$rs->Value('ca_continuacion_dest')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "  <TD Class=mostrar COLSPAN=5>Operador:<BR>".$rs->Value('ca_bodega')."</TD>";

                echo "  </TR>";
                echo "  </TABLE>";
                echo " </TD>";

                echo " <TD Class=invertir COLSPAN=3>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '$id' and ca_idconcepto != 9")) {       // Selecciona todos lo registros de la tabla Equiposde una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                }
                echo "  </TABLE>";
                echo " </TD>";
                echo "</TR>";


                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5><TABLE CELLSPACING=1 WIDTH=100%>";
                $num_reg = $rs->mRowCount + 1;
                do {
                    echo "<TR>";
                    echo "  <TD Class=listar>Factura:<BR>".$rs->Value('ca_factura')."</TD>";
                    echo "  <TD Class=listar>Fch.Factura:<BR>".$rs->Value('ca_fchfactura')."</TD>";
                    echo "  <TD Class=listar>".$rs->Value('ca_idmoneda').":<BR>".$rs->Value('ca_neto')."</TD>";
                    echo "  <TD Class=listar>T.R.M.:<BR>".$rs->Value('ca_tcambio')."</TD>";
                    echo "  <TD Class=listar>Vlr.Pesos:<BR>".$rs->Value('ca_valor')."</TD>";
                    echo "  <TD Class=listar>Observaci�n IDG:<BR>".$rs->Value('ca_observaciones_fact')."</TD>";
                    echo "</TR>";
                    $rs->MoveNext();
                } while(!$rs->Eof());
                echo "</TABLE></TD></TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar Cliente'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Adicionar': {                                                    // Opcion para Adicionar Registros a la tabla
                $modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos where ca_puerto not in ('A�reo','Terrestre') order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
                    echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_puertos where ca_idtrafico = 'CO-057' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades Colombianas
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idlocales' VALUE=".$tm->Value('ca_idciudad').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomlocales' VALUE='".$tm->Value('ca_ciudad')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idlinea, ca_nombre, ca_transporte from vi_transporlineas where ca_transporte = 'Mar�timo' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='aidlinea' VALUE=".$tm->Value('ca_idlinea').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='anombre' VALUE='".$tm->Value('ca_nombre')."'>";
                    echo "<INPUT TYPE='HIDDEN' NAME='atransporte' VALUE='".$tm->Value('ca_transporte')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idconcepto, ca_concepto from vi_conceptos where ca_transporte = 'Mar�timo' and (ca_modalidad = 'FCL' or ca_idconcepto = 9) order by ca_modalidad DESC, ca_concepto")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function llenar_traficos(){";
                echo "  document.adicionar.idtraorigen.length=0;";
                echo "  document.adicionar.idtraorigen.options[document.adicionar.idtraorigen.length] = new Option();";
                echo "  document.adicionar.idtraorigen.length=0;";
                echo "  document.adicionar.idtradestino.length=0;";
                echo "  document.adicionar.idtradestino.options[document.adicionar.idtradestino.length] = new Option();";
                echo "  document.adicionar.idtradestino.length=0;";
                echo "  if (document.adicionar.impoexpo.value == 'Importaci�n'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++) {";
                echo "           if (idtraficos[cont].value != 'CO-057')";
                echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "           else";
                echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "      }";
                echo "  } else if (document.adicionar.impoexpo.value == 'OTM/DTA'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++) {";
                echo "           if (idtraficos[cont].value == 'CO-057') {";
                echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "           }";
                echo "      }";
                echo "  } else if (document.adicionar.impoexpo.value == 'Triangulaci�n'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++){";
                echo "           if (idtraficos[cont].value != 'CO-057'){";
                echo "               document.adicionar.idtraorigen[document.adicionar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "               document.adicionar.idtradestino[document.adicionar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,false);";
                echo "           }";
                echo "      }";
                echo "  }";
                echo "  llenar_origenes();";
                echo "  llenar_destinos();";
                echo "}";
                echo "function llenar_origenes(){";
                echo "  document.adicionar.idciuorigen.length=0;";
                echo "  document.adicionar.idciuorigen.options[document.adicionar.idciuorigen.length] = new Option();";
                echo "  document.adicionar.idciuorigen.length=0;";
                echo "  if (isNaN(idciudades.length)){";
                echo "      if (document.adicionar.idtraorigen.value == ciutraficos.value){";
                echo "          document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,false);";
                echo "      }";
                echo "  } else {";
                echo "     for (cont=0; cont<idciudades.length; cont++) {";
                echo "          if (document.adicionar.idtraorigen.value == ciutraficos[cont].value){";
                echo "              document.adicionar.idciuorigen[document.adicionar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
                echo "          }";
                echo "     }";
                echo "  }";
                echo "}";
                echo "function llenar_destinos(){";
                echo "  document.adicionar.idciudestino.length=0;";
                echo "  document.adicionar.idciudestino.options[document.adicionar.idciudestino.length] = new Option();";
                echo "  document.adicionar.idciudestino.length=0;";
                echo "  if (isNaN(idciudades.length)){";
                echo "      if (document.adicionar.idtradestino.value == ciutraficos.value){";
                echo "          document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);";
                echo "      }";
                echo "  } else if (document.adicionar.impoexpo.value != 'OTM/DTA'){";
                echo "     for (cont=0; cont<idciudades.length; cont++) {";
                echo "          if (document.adicionar.idtradestino.value == ciutraficos[cont].value){";
                echo "              document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,false);";
                echo "          }";
                echo "     }";
                echo "  } else {";
                echo "     for (cont=0; cont<idlocales.length; cont++) {";
                echo "          document.adicionar.idciudestino[document.adicionar.idciudestino.length] = new Option(nomlocales[cont].value,idlocales[cont].value,false,false);";
                echo "     }";
                echo "  }";
                echo "}";
                echo "function llenar_lineas(){";
                echo "  document.adicionar.idlinea.length=0;";
                echo "  document.adicionar.idlinea.options[document.adicionar.idlinea.length] = new Option();";
                echo "  document.adicionar.idlinea.length=0;";
                echo "  for (cont=0; cont<aidlinea.length; cont++) {";
                echo "       document.adicionar.idlinea[document.adicionar.idlinea.length] = new Option(anombre[cont].value,aidlinea[cont].value,false,false);";
                echo "      }";
                echo "}";
                echo "function validar(){";
                echo "  if (!chkDate(document.adicionar.fchreferencia))";
                echo "      document.adicionar.fchreferencia.focus();";
                echo "  else if (document.adicionar.idciuorigen.value == '')";
                echo "      alert('Seleccione la Ciudad de Origen');";
                echo "  else if (document.adicionar.idciudestino.value == '')";
                echo "      alert('Seleccione la Ciudad de Destino');";
                echo "  else if (document.adicionar.motonave.value == '' && document.getElementById('impoexpo').value != 'OTM/DTA')";
                echo "      alert('El campo Motonave no es v�lido');";
                echo "  else if (document.getElementById('mbls_1').value == '')";
                echo "      alert('El campo MBL no es v�lido');";
                echo "  else if (document.getElementById('mbls_2').value == '')";
                echo "      alert('El campo Fecha de MBL no es v�lido');";
                echo "  else if (!chkDate(document.adicionar.fchembarque))";
                echo "      document.adicionar.fchembarque.focus();";
                echo "  else if (!chkDate(document.adicionar.fcharribo))";
                echo "      document.adicionar.fcharribo.focus();";
                echo "  else if (document.adicionar.fchembarque.value >= document.adicionar.fcharribo.value)";
                echo "      alert('Inconsistencia con fechas de Embarque y Arribo');";
                echo "  else {";
                echo "      i = 0;";
                echo "      check = true;";
                echo "      none  = true;";
                echo "      while (isNaN(document.getElementById('idconcepto_'+i))) {";
                echo "         objeto = document.getElementById('idconcepto_'+i);";
                echo "         if (objeto.value != 'NULL') {";
                echo "             none = false;";
                echo "             if (objeto.value == 9) {";
                echo "                 if ( document.getElementById('cantidad_'+i).value <= 0 ) {";
                echo "                     alert('Ingrese la Cantidad de Metros C�bicos del Embarque');";
                echo "                     check = false;";
                echo "                 }";
                echo "             } else if (objeto.value != 9) {";
                echo "                 if (document.getElementById('idequipo1_'+i).value == '' || document.getElementById('idequipo2_'+i).value == '') {";
                echo "                     alert('Ingrese el C�digo de Identificaci�n del Contenedor ');";
                echo "                     check = false;";
                echo "                 } else if (document.getElementById('numprecinto_'+i).value == '') {";
                echo "                     alert('Ingrese el N�mero del Precinto utilizado en el Contenedor');";
                echo "                     check = false;";
                echo "                 }";
                echo "             }";
                echo "         }";
                echo "         i++;";
                echo "      }";
                echo "      if (check && !none)";
                echo "          return (confirm('El sistema ha asignado autom�ticamente el n�mero de Referencia\\n�Esta correcta la asignaci�n?'));";
                echo "      else if (none)";
                echo "          alert('Diligencie Cuadro Datos Relacionados con la Carga');";
                echo "  }";
                echo "  return (false);";
                echo "}";
                echo "function habilitar(campo){";
                echo "  cadena = campo.getAttribute('ID');";
                echo "  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);";
                echo "  objeto_1 = document.getElementById('cantidad_' + indice);";
                echo "  objeto_2 = document.getElementById('idequipo1_' + indice);";
                echo "  objeto_3 = document.getElementById('idequipo2_' + indice);";
                echo "  objeto_4 = document.getElementById('numprecinto_' + indice);";
                echo "  if (campo.value == 9){";
                echo "      objeto_1.style.visibility = 'visible';";
                echo "      objeto_2.style.visibility = 'hidden';";
                echo "      objeto_3.style.visibility = 'hidden';";
                echo "      objeto_4.style.visibility = 'hidden';";
                echo "      objeto_2.value = objeto_3.value = objeto_4.value = ''";
                echo "  } else {";
                echo "      objeto_1.style.visibility = 'hidden';";
                echo "      objeto_2.style.visibility = 'visible';";
                echo "      objeto_3.style.visibility = 'visible';";
                echo "      objeto_4.style.visibility = 'visible';";
                echo "      objeto_1.value = 0";
                echo "  }";
                echo "}";
                echo "function validacion(){";
                echo "  frame = document.getElementById('validref_frame');";
                echo "  modalidad = document.getElementById('modalidad').value;";
                echo "  destino = document.getElementById('idciudestino').value;";
                echo "  mes = document.getElementById('mes').value+'-'+document.getElementById('ano').value.charAt(3);";
                echo "  if (document.getElementById('impoexpo').value == 'OTM/DTA'){";
                echo "      departamento = 'Terrestre';";
                echo "      origen = document.getElementById('idciuorigen').value;";
                echo "      document.getElementById('idlinea').style.display = 'none';";
                echo "      document.getElementById('motonave').style.display = 'none';";
                echo "  } else {";
                echo "      departamento = 'Mar�timo';";
                echo "      origen = document.getElementById('idtraorigen').value;";
                echo "      document.getElementById('idlinea').style.display = 'block';";
                echo "      document.getElementById('motonave').style.display = 'block';";
                echo "  }";
                echo "  if (document.getElementById('impoexpo').value == 'OTM/DTA' || document.getElementById('modalidad').value == 'PARTICULARES'){";
                echo "      document.getElementById('viaje').style.display = 'none';";
                echo "  } else {";
                echo "      document.getElementById('viaje').style.display = 'block';";
                echo "  }";
                echo "  frame.src='ventanas.php?opcion=Ref_sea&departamento='+departamento+'&modalidad='+modalidad+'&origen='+origen+'&destino='+destino+'&mes='+mes;";
                echo "}";
                echo "function llenar_referencia(num_ref){";
                echo "  ref_mem = num_ref.split('.') ;";
                echo "  document.getElementById('POS_1').value = ref_mem[0];";
                echo "  document.getElementById('POS_2').value = ref_mem[1];";
                echo "  document.getElementById('POS_3').value = ref_mem[2];";
                echo "  document.getElementById('POS_4').value = ref_mem[3];";
                echo "  document.getElementById('POS_5').value = ref_mem[4];";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";

                echo "<BODY>";
                require_once("menu.php");
                echo "<DIV ID='validref' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
                echo "  <IFRAME ID='validref_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:150'>";
                echo "  </IFRAME>";
                echo "</DIV>";
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='adicionar' ACTION='inosea.php' ONSUBMIT='return validar();'>";// Crea una forma con datos vacios
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<TH Class=titulo COLSPAN=5>Datos Para la Nueva Referencia</TH>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=2><acronym title=\"El N�mero de la Referencia es Generado Autom�ticamente\">Referencia:<BR><CENTER>";
                echo "    <INPUT ID=POS_1 TYPE='TEXT' NAME='referencia[]' SIZE=3 MAXLENGTH=3 READONLY>.";
                echo "    <INPUT ID=POS_2 TYPE='TEXT' NAME='referencia[]' SIZE=2 MAXLENGTH=2 READONLY>.";
                echo "    <INPUT ID=POS_3 TYPE='TEXT' NAME='referencia[]' SIZE=2 MAXLENGTH=2 READONLY>.";
                echo "    <INPUT ID=POS_4 TYPE='TEXT' NAME='referencia[]' SIZE=3 MAXLENGTH=3 READONLY>.";
                echo "    <INPUT ID=POS_5 TYPE='TEXT' NAME='referencia[]' SIZE=2 MAXLENGTH=1 READONLY>";
                echo "  </CENTER></acronym></TD>";
                echo "  <TD Class=listar>Mes de Grabaci�n:<BR><CENTER><SELECT NAME='mes' ONCHANGE='validacion();'>";
                while (list ($clave, $val) = each ($meses)) {
                    echo " <OPTION VALUE=$clave";
                    if (date('m')==$clave) {
                        echo" SELECTED"; }
                    echo ">$val</OPTION>";
                }
                echo "  </SELECT></CENTER></TD>";
                echo "  <TD Class=listar>A�o de Grabaci�n:<BR><CENTER><SELECT NAME='ano' ONCHANGE='validacion();'>";
                for ( $i=-1; $i<=1; $i++ ) {
                    echo " <OPTION VALUE=".(date('Y')-$i).(($i==0)?" SELECTED":"").">".(date('Y')-$i)."</OPTION>";
                }
                echo "  </SELECT></CENTER></TD>";
                echo "  <TD Class=mostrar>Fecha de Registro :<BR><CENTER><INPUT TYPE='TEXT' NAME='fchreferencia' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo>Clase</TD>";
                echo "  <TD Class=titulo COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();validacion();'>";
                for ($i=0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=".$imporexpor[$i].">".$imporexpor[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();validacion();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' SIZE=7 ONCHANGE='validacion();'>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' SIZE=7 ONCHANGE='validacion();'>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura ROWSPAN=4>Informaci�n:</TD>";
                echo "  <TD Class=listar COLSPAN=3>L�nea<BR><SELECT NAME='idlinea'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='validacion();'>";
                for ($i=0; $i < count($modalidades); $i++) {
                    echo " <OPTION VALUE='".$modalidades[$i]."'>".$modalidades[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar>Fecha Estim.Embarque:<BR><INPUT TYPE='TEXT' NAME='fchembarque' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=listar>Fecha Estim.Arribo:<BR><INPUT TYPE='TEXT' NAME='fcharribo' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\" ONBLUR='validacion();'></TD>";
                echo "  <TD Class=listar>Motonave:<BR><INPUT TYPE='TEXT' NAME='motonave' SIZE=18 MAXLENGTH=50></TD>";
                echo "  <TD Class=listar>No.Ciclo-Rumbo:<BR><DIV ID='viaje'><INPUT ID='ciclo' TYPE='TEXT' NAME='ciclo[]' SIZE=5 MAXLENGTH=4 style='text-transform: uppercase'>-<INPUT ID='rumbo' TYPE='TEXT' NAME='ciclo[]' SIZE=3 MAXLENGTH=2 style='text-transform: uppercase'></DIV></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=3>MBL: S�lo debe ingresar un Master por cada Referencia<IMG SRC='./graficos/nuevo.gif' border=0 ALT=''><BR><INPUT ID=mbls_1 NAME='mbls[]' TYPE='TEXT' SIZE=50 MAXLENGTH=50></TD>";
                echo "  <TD Class=listar>Fecha MBL:<BR><INPUT ID=mbls_2 NAME='mbls[]' TYPE='TEXT' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=4 COLS=90></TEXTAREA></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Datos Relacionados con la Carga</B></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1>";
                for ($i=0; $i<5; $i++) {
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=2>Concepto:<BR><SELECT ID=idconcepto_$i NAME='inoequipos_sea[$i][idconcepto]' ONCHANGE='habilitar(this);'>";  // Llena el cuadro de lista con los valores de la tabla Conceptos
                    $tm->MoveFirst();
                    echo "<OPTION VALUE=NULL></OPTION>";
                    while (!$tm->Eof()) {
                        echo "<OPTION VALUE=".$tm->Value('ca_idconcepto').">".$tm->Value('ca_concepto')."</OPTION>";
                        $tm->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>Cantidad:<BR><INPUT style='visibility: \"hidden\";' ID=cantidad_$i TYPE='TEXT' NAME='inoequipos_sea[$i][cantidad]' VALUE=0 SIZE=8 MAXLENGTH=6></TD>";
                    echo "    <TD Class=mostrar>Id.Equipo:<BR><INPUT style='visibility: \"hidden\";' ID=idequipo1_$i TYPE='TEXT' NAME='inoequipos_sea[$i][idequipo_1]' VALUE='' SIZE=5 MAXLENGTH=4 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'>-<INPUT style='visibility: \"hidden\";' ID=idequipo2_$i TYPE='TEXT' NAME='inoequipos_sea[$i][idequipo_2]' VALUE='' SIZE=9 MAXLENGTH=7 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'></TD>";
                    echo "    <TD Class=mostrar>No.Precinto:<BR><INPUT style='visibility: \"hidden\";' ID=numprecinto_$i TYPE='TEXT' NAME='inoequipos_sea[$i][numprecinto]' VALUE='' SIZE=15 MAXLENGTH=25 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'></TD>";
                    echo "    <TD Class=mostrar>Observaciones:<BR><INPUT ID=observacion_$i TYPE='TEXT' NAME='inoequipos_sea[$i][observaciones]' SIZE=26 MAXLENGTH=50></TD>";
                    echo "  </TR>";
                }
                echo "  </TABLE>Si el concepto a registrar es <B>T/M3</B>, en la casilla cantidad ingrese el <B>total de metros c�bicos de la referencia</B> y no el peso. <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Item'></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Guardar'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php\"'></TH>";  // Cancela la operaci�n
                echo "<script>llenar_traficos();</script>";
                echo "<script>llenar_lineas();</script>";
                echo "<script>document.adicionar.mes.focus();</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Modificar': {
                $modulo = "00100200";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea modificar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while ( !$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idtraficos' VALUE=".$tm->Value('ca_idtrafico').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomtraficos' VALUE='".$tm->Value('ca_nombre')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idciudad, ca_ciudad, ca_idtrafico from vi_puertos where ca_puerto not in ('A�reo','Terrestre') order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while ( !$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idciudades' VALUE=".$tm->Value('ca_idciudad').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomciudades' VALUE='".$tm->Value('ca_ciudad')."'>";
                    echo "<INPUT TYPE='HIDDEN' NAME='ciutraficos' VALUE='".$tm->Value('ca_idtrafico')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idciudad, ca_ciudad from vi_puertos where ca_idtrafico = 'CO-057' order by ca_ciudad")) { // Selecciona todos lo registros de la tabla Ciudades Colombianas
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $tm->MoveFirst();
                while (!$tm->Eof()) {
                    echo "<INPUT TYPE='HIDDEN' NAME='idlocales' VALUE=".$tm->Value('ca_idciudad').">";
                    echo "<INPUT TYPE='HIDDEN' NAME='nomlocales' VALUE='".$tm->Value('ca_ciudad')."'>";
                    $tm->MoveNext();
                }
                if (!$tm->Open("select ca_idconcepto, ca_concepto from vi_conceptos where ca_transporte = 'Mar�timo' and (ca_modalidad = 'FCL' or ca_idconcepto = 9) order by ca_modalidad DESC, ca_concepto")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {       // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $li =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$li->Open("select ca_idlinea, ca_nombre, ca_transporte from vi_transporlineas where ca_transporte = 'Mar�timo' order by ca_nombre")) { // Selecciona todos lo registros de la tabla Ciudades
                    echo "<script>alert(\"".addslashes($li->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function llenar_traficos(){";
                echo "  document.modificar.idtraorigen.length=0;";
                echo "  document.modificar.idtraorigen.options[document.modificar.idtraorigen.length] = new Option();";
                echo "  document.modificar.idtraorigen.length=0;";
                echo "  document.modificar.idtradestino.length=0;";
                echo "  document.modificar.idtradestino.options[document.modificar.idtradestino.length] = new Option();";
                echo "  document.modificar.idtradestino.length=0;";
                echo "  if (document.modificar.impoexpo.value == 'Importaci�n'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++) {";
                echo "           if (idtraficos[cont].value != 'CO-057') {";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_traorigen')."') ? true : false;";
                echo "               document.modificar.idtraorigen[document.modificar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion); }";
                echo "           else {";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_tradestino')."') ? true : false;";
                echo "               document.modificar.idtradestino[document.modificar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion); }";
                echo "      }";
                echo "  } else if (document.modificar.impoexpo.value == 'Triangulaci�n'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++) {";
                echo "           if (idtraficos[cont].value != 'CO-057'){";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_traorigen')."') ? true : false;";
                echo "               document.modificar.idtraorigen[document.modificar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_tradestino')."') ? true : false;";
                echo "               document.modificar.idtradestino[document.modificar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);";
                echo "           }";
                echo "      }";
                echo "  } else if (document.modificar.impoexpo.value == 'OTM/DTA'){";
                echo "      for (cont=0; cont<idtraficos.length; cont++){";
                echo "           if (idtraficos[cont].value == 'CO-057'){";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_traorigen')."') ? true : false;";
                echo "               document.modificar.idtraorigen[document.modificar.idtraorigen.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);";
                echo "               seleccion = (nomtraficos[cont].value == '".$rs->Value('ca_tradestino')."') ? true : false;";
                echo "               document.modificar.idtradestino[document.modificar.idtradestino.length] = new Option(nomtraficos[cont].value,idtraficos[cont].value,false,seleccion);";
                echo "           }";
                echo "      }";
                echo "  }";
                echo "  llenar_origenes();";
                echo "  llenar_destinos();";
                echo "}";
                echo "function llenar_origenes(){";
                echo "  document.modificar.idciuorigen.length=0;";
                echo "  document.modificar.idciuorigen.options[document.modificar.idciuorigen.length] = new Option();";
                echo "  document.modificar.idciuorigen.length=0;";
                echo "  if (isNaN(idciudades.length)){";
                echo "      if (document.modificar.idtraorigen.value == ciutraficos.value){";
                echo "          document.modificar.idciuorigen[document.modificar.idciuorigen.length] = new Option(nomciudades.value,idciudades.value,false,true);";
                echo "          }";
                echo "     }";
                echo "  else {";
                echo "     for (cont=0; cont<idciudades.length; cont++) {";
                echo "          if (document.modificar.idtraorigen.value == ciutraficos[cont].value){";
                echo "              seleccion = (idciudades[cont].value == '".$rs->Value('ca_origen')."') ? true : false;";
                echo "              document.modificar.idciuorigen[document.modificar.idciuorigen.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,seleccion);";
                echo "           }";
                echo "       }";
                echo "     }";
                echo "}";
                echo "function llenar_destinos(){";
                echo "  document.modificar.idciudestino.length=0;";
                echo "  document.modificar.idciudestino.options[document.modificar.idciudestino.length] = new Option();";
                echo "  document.modificar.idciudestino.length=0;";
                echo "  if (isNaN(idciudades.length)){";
                echo "      if (document.modificar.idtradestino.value == ciutraficos.value){";
                echo "          document.modificar.idciudestino[document.modificar.idciudestino.length] = new Option(nomciudades.value,idciudades.value,false,false);";
                echo "      }";
                echo "  } else if (document.modificar.impoexpo.value != 'OTM/DTA'){";
                echo "     for (cont=0; cont<idciudades.length; cont++) {";
                echo "          if (document.modificar.idtradestino.value == ciutraficos[cont].value){";
                echo "              seleccion = (idciudades[cont].value == '".$rs->Value('ca_destino')."') ? true : false;";
                echo "              document.modificar.idciudestino[document.modificar.idciudestino.length] = new Option(nomciudades[cont].value,idciudades[cont].value,false,seleccion);";
                echo "          }";
                echo "     }";
                echo "  } else {";
                echo "     for (cont=0; cont<idlocales.length; cont++) {";
                echo "          seleccion = (idlocales[cont].value == '".$rs->Value('ca_destino')."') ? true : false;";
                echo "          document.modificar.idciudestino[document.modificar.idciudestino.length] = new Option(nomlocales[cont].value,idlocales[cont].value,false,seleccion);";
                echo "     }";
                echo "  }";
                echo "}";
                echo "function validar(){";
                echo "  if (!chkDate(document.modificar.fchreferencia))";
                echo "      document.modificar.fchreferencia.focus();";
                echo "  else if (document.modificar.motonave.value == '' && document.getElementById('impoexpo').value != 'OTM/DTA')";
                echo "      alert('El campo Motonave no es v�lido');";
                echo "  else if (document.getElementById('mbls_1').value == '')";
                echo "      alert('El campo MBL no es v�lido');";
                echo "  else if (document.getElementById('mbls_2').value == '')";
                echo "      alert('El campo Fecha del MBL no es v�lido');";
                echo "  else if (!chkDate(document.modificar.fchembarque))";
                echo "      document.modificar.fchembarque.focus();";
                echo "  else if (!chkDate(document.modificar.fcharribo))";
                echo "      document.modificar.fcharribo.focus();";
                echo "  else if (document.modificar.fchembarque.value >= document.modificar.fcharribo.value)";
                echo "      alert('Inconsistencia con fechas de Embarque y Arribo');";
                echo "  else {";
                echo "      i = 0;";
                echo "      check = true;";
                echo "      none  = true;";
                echo "      while (isNaN(document.getElementById('idconcepto_'+i))) {";
                echo "         objeto = document.getElementById('idconcepto_'+i);";
                echo "         if (objeto.value != 'NULL') {";
                echo "             none = false;";
                echo "             if (objeto.value == 9) {";
                echo "                 if ( document.getElementById('cantidad_'+i).value <= 0 ) {";
                echo "                     alert('Ingrese la Cantidad de Metros C�bicos del Embarque');";
                echo "                     check = false;";
                echo "                 }";
                echo "             } else if (objeto.value != 9) {";
                echo "                 if (document.getElementById('idequipo1_'+i).value == '' || document.getElementById('idequipo2_'+i).value == '') {";
                echo "                     alert('Ingrese el C�digo de Identificaci�n del Contenedor ');";
                echo "                     check = false;";
                echo "                 } else if (document.getElementById('numprecinto_'+i).value == '') {";
                echo "                     alert('Ingrese el N�mero del Precinto utilizado en el Contenedor');";
                echo "                     check = false;";
                echo "                 }";
                echo "             }";
                echo "         }";
                echo "         i++;";
                echo "      }";
                echo "      if (check && !none)";
                echo "          return (true);";
                echo "      else if (none)";
                echo "          alert('Diligencie Cuadro Datos Relacionados con la Carga');";
                echo "  }";
                echo "  return (false);";
                echo "}";
                echo "function validacion(){";
                echo "  if (document.getElementById('impoexpo').value == 'OTM/DTA'){";
                echo "      document.getElementById('idlinea').style.display = 'none';";
                echo "      document.getElementById('motonave').style.display = 'none';";
                echo "  } else {";
                echo "      document.getElementById('idlinea').style.display = 'block';";
                echo "      document.getElementById('motonave').style.display = 'block';";
                echo "  }";
                echo "  if (document.getElementById('impoexpo').value == 'OTM/DTA' || document.getElementById('modalidad').value == 'PARTICULARES'){";
                echo "      document.getElementById('viaje').style.display = 'none';";
                echo "  } else {";
                echo "      document.getElementById('viaje').style.display = 'block';";
                echo "  }";
                echo "}";
                echo "function habilitar(campo){";
                echo "  cadena = campo.getAttribute('ID');";
                echo "  indice = cadena.substring(cadena.indexOf('_') + 1, cadena.length);";
                echo "  objeto_1 = document.getElementById('cantidad_' + indice);";
                echo "  objeto_2 = document.getElementById('idequipo1_' + indice);";
                echo "  objeto_3 = document.getElementById('idequipo2_' + indice);";
                echo "  objeto_4 = document.getElementById('numprecinto_' + indice);";
                echo "  if (campo.value == 9){";
                echo "      objeto_1.style.visibility = 'visible';";
                echo "      objeto_2.style.visibility = 'hidden';";
                echo "      objeto_3.style.visibility = 'hidden';";
                echo "      objeto_4.style.visibility = 'hidden';";
                echo "      objeto_2.value = objeto_3.value = objeto_4.value = ''";
                echo "  } else {";
                echo "      objeto_1.style.visibility = 'hidden';";
                echo "      objeto_2.style.visibility = 'visible';";
                echo "      objeto_3.style.visibility = 'visible';";
                echo "      objeto_4.style.visibility = 'visible';";
                echo "      objeto_1.value = 0";
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
                echo "<FORM METHOD=post NAME='modificar' ACTION='inosea.php' ONSUBMIT='return validar();'>"; // Llena la forma con los datos actuales del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta modificando
                echo "<TH Class=titulo COLSPAN=5>Nuevos Datos Para la Referencia</TH>";
                echo "<TR>";
                echo "  <TD Class=captura>Referencia:</TD>";
                echo "  <TD Class=mostrar COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Fecha de Registro : <INPUT TYPE='TEXT' NAME='fchreferencia' SIZE=12 VALUE='".$rs->Value('ca_fchreferencia')."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo>Clase</TD>";
                echo "  <TD Class=titulo COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=titulo COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura style='vertical-align:top;'><SELECT NAME='impoexpo' ONCHANGE='llenar_traficos();validacion();'>";
                for ($i=0; $i < count($imporexpor); $i++) {
                    echo " <OPTION VALUE=".$imporexpor[$i];
                    if ($rs->Value('ca_impoexpo')==$imporexpor[$i]) {
                        echo " SELECTED"; }
                    echo ">".$imporexpor[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtraorigen' ONCHANGE='llenar_origenes();'>";  // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciuorigen' SIZE=7>";          // Llena el cuadro de lista con los valores de la tabla Origenes
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idtradestino' ONCHANGE='llenar_destinos();'>"; // Llena el cuadro de lista con los valores de la tabla Traficos
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar WIDTH=160><SELECT NAME='idciudestino' SIZE=7>";         // Llena el cuadro de lista con los valores de la tabla Destinos
                echo "  </SELECT></TD>";
                echo "</TR>";

                $oculto_1 = ($rs->Value('ca_impoexpo') == 'OTM/DTA')?'none':'block';
                $oculto_2 = ($rs->Value('ca_impoexpo') == 'OTM/DTA' or $rs->Value('ca_modalidad') == 'PARTICULARES')?'none':'block';
                echo "<TR>";
                echo "  <TD Class=captura ROWSPAN=4>Informaci�n:</TD>";
                echo "  <TD Class=listar COLSPAN=3>L�nea<BR><SELECT NAME='idlinea' style='display:$oculto_1'>";             // Llena el cuadro de lista con los valores de la tabla Transportistas
                $li->MoveFirst();
                while (!$li->Eof()) {
                    echo"<OPTION VALUE=".$li->Value('ca_idlinea');
                    if ($rs->Value('ca_idlinea')==$li->Value('ca_idlinea')) {
                        echo" SELECTED"; }
                    echo">".$li->Value('ca_nombre')."</OPTION>";
                    $li->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=listar>Modalidad:<BR><SELECT NAME='modalidad' ONCHANGE='validacion();'>";
                for ($i=0; $i < count($modalidades); $i++) {
                    echo " <OPTION VALUE='".$modalidades[$i]."'";
                    if ($rs->Value('ca_modalidad')==$modalidades[$i]) {
                        echo " SELECTED"; }
                    echo ">".$modalidades[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";
                $ciclo = explode("-",$rs->Value('ca_ciclo'));
                echo "<TR>";
                echo "  <TD Class=listar>Fecha Estim.Embarque:<BR><INPUT TYPE='TEXT' NAME='fchembarque' VALUE='".$rs->Value('ca_fchembarque')."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=listar>Fecha Estim.Arribo:<BR><INPUT TYPE='TEXT' NAME='fcharribo' VALUE='".$rs->Value('ca_fcharribo')."' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=listar>Motonave:<BR><INPUT TYPE='TEXT' NAME='motonave' VALUE='".$rs->Value('ca_motonave')."' style='display:$oculto_1' SIZE=18 MAXLENGTH=50></TD>";
                echo "  <TD Class=listar>No.Ciclo-Rumbo:<BR><DIV ID='viaje' style='display:$oculto_2'><INPUT TYPE='TEXT' NAME='ciclo[]' VALUE='".$ciclo[0]."' SIZE=5 MAXLENGTH=4 style='text-transform: uppercase'>-<INPUT TYPE='TEXT' NAME='ciclo[]' VALUE='".$ciclo[1]."' SIZE=3 MAXLENGTH=2 style='text-transform: uppercase'></DIV></TD>";
                echo "</TR>";
                echo "<TR>";
                $mbls = explode("|",$rs->Value('ca_mbls'));
                echo "  <TD Class=listar COLSPAN=3>MBL: S�lo debe ingresar un Master por cada Referencia<IMG SRC='./graficos/nuevo.gif' border=0 ALT=''><BR><INPUT ID=mbls_1 NAME='mbls[]' VALUE='$mbls[0]' TYPE='TEXT' SIZE=50 MAXLENGTH=50></TD>";
                echo "  <TD Class=listar>Fecha MBL:<BR><INPUT ID=mbls_2 NAME='mbls[]' TYPE='TEXT' SIZE=12 VALUE='$mbls[1]' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=4>Observaciones:<BR><TEXTAREA NAME='observaciones' WRAP=virtual ROWS=4 COLS=90>".$rs->Value('ca_observaciones')."</TEXTAREA></TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=captura COLSPAN=5 style='font-size: 11px; vertical-align:bottom'><B>Datos Relacionados con la Carga</B></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=titulo COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1>";
                $i = 0;
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    $idequipo = explode("-",$co->Value('ca_idequipo'));
                    echo "<INPUT TYPE='HIDDEN' NAME='inoequipos_sea[$i][oid]' VALUE=".$co->Value('ca_oid').">";
                    echo "<TR>";
                    echo "    <TD Class=mostrar COLSPAN=2>Concepto:<BR><SELECT ID=idconcepto_$i NAME='inoequipos_sea[$i][idconcepto]' ONCHANGE='habilitar(this);'>";
                    $tm->MoveFirst();
                    while (!$tm->Eof()) {
                        echo"<OPTION VALUE=".$tm->Value('ca_idconcepto');
                        if ($co->Value('ca_idconcepto')==$tm->Value('ca_idconcepto')) {
                            echo" SELECTED"; }
                        echo">".$tm->Value('ca_concepto')."</OPTION>";
                        $tm->MoveNext();
                    }
                    if ($co->Value('ca_idconcepto')==9) {
                        $visible1 = 'visible';
                        $visible2 = 'hidden';
                    }else {
                        $visible1 = 'hidden';
                        $visible2 = 'visible';
                    }

                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>Cantidad:<BR><INPUT style='visibility:$visible1;' ID=cantidad_$i TYPE='TEXT' NAME='inoequipos_sea[$i][cantidad]' VALUE=".formatNumber($co->Value('ca_cantidad'),3)." SIZE=8 MAXLENGTH=6></TD>";
                    echo "    <TD Class=mostrar>Id.Equipo:<BR><INPUT style='visibility:$visible2;' ID=idequipo1_$i TYPE='TEXT' NAME='inoequipos_sea[$i][idequipo_1]' VALUE='".$idequipo[0]."' SIZE=5 MAXLENGTH=4 style='text-transform: uppercase'>-<INPUT style='visibility:$visible2;' ID=idequipo2_$i TYPE='TEXT' $equ_mem NAME='inoequipos_sea[$i][idequipo_2]' VALUE='".$idequipo[1]."' SIZE=9 MAXLENGTH=7 style='text-transform: uppercase'></TD>";
                    echo "    <TD Class=mostrar>No.Precinto:<BR><INPUT style='visibility:$visible2;' ID=numprecinto_$i TYPE='TEXT' NAME='inoequipos_sea[$i][numprecinto]' VALUE='".$co->Value('ca_numprecinto')."' SIZE=15 MAXLENGTH=25 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'></TD>";
                    echo "    <TD Class=mostrar>Observaciones:<BR><INPUT ID=observacion_$i TYPE='TEXT' NAME='inoequipos_sea[$i][observaciones]' VALUE='".$co->Value('ca_observaciones')."' SIZE=26 MAXLENGTH=50></TD>";
                    echo "</TR>";
                    $co->MoveNext();
                    $i++;
                }
                $j = $i;
                for ($i=$j; $i<$j+5; $i++) {
                    echo "<INPUT TYPE='HIDDEN' NAME='inoequipos_sea[$i][oid]' VALUE=0>";
                    echo "  <TR>";
                    echo "    <TD Class=mostrar COLSPAN=2>Concepto:<BR><SELECT ID=idconcepto_$i NAME='inoequipos_sea[$i][idconcepto]' ONCHANGE='habilitar(this);'>";  // Llena el cuadro de lista con los valores de la tabla Conceptos
                    $tm->MoveFirst();
                    echo "<OPTION VALUE=NULL></OPTION>";
                    while (!$tm->Eof()) {
                        echo"<OPTION VALUE=".$tm->Value('ca_idconcepto').">".$tm->Value('ca_concepto')."</OPTION>";
                        $tm->MoveNext();
                    }
                    echo "    </SELECT></TD>";
                    echo "    <TD Class=mostrar>Cantidad:<BR><INPUT style='visibility: \"hidden\";' ID=cantidad_$i TYPE='TEXT' NAME='inoequipos_sea[$i][cantidad]' VALUE=0 SIZE=8 MAXLENGTH=6></TD>";
                    echo "    <TD Class=mostrar>Id.Equipo:<BR><INPUT style='visibility: \"hidden\";' ID=idequipo1_$i TYPE='TEXT' NAME='inoequipos_sea[$i][idequipo_1]' VALUE='' SIZE=5 MAXLENGTH=4 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'>-<INPUT style='visibility: \"hidden\";' ID=idequipo2_$i TYPE='TEXT' NAME='inoequipos_sea[$i][idequipo_2]' VALUE='' SIZE=9 MAXLENGTH=7 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'></TD>";
                    echo "    <TD Class=mostrar>No.Precinto:<BR><INPUT style='visibility: \"hidden\";' ID=numprecinto_$i TYPE='TEXT' NAME='inoequipos_sea[$i][numprecinto]' VALUE='' SIZE=15 MAXLENGTH=25 style='text-transform: uppercase' onkeyup='autotab(this.form,this)'></TD>";
                    echo "    <TD Class=mostrar>Observaciones:<BR><INPUT ID=observacion_$i TYPE='TEXT' NAME='inoequipos_sea[$i][observaciones]' SIZE=26 MAXLENGTH=50></TD>";
                    echo "  </TR>";
                }
                echo "  </TABLE>Si el concepto a registrar es <B>T/M3</B>, en la casilla cantidad ingrese el <B>total de metros c�bicos de la referencia</B> y no el peso. <IMG SRC='./graficos/nuevo.gif' border=0 ALT='Nuevo Item'></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";

                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Actualizar'></TH>";         // Ordena almacenar los datos ingresados
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "<script>llenar_traficos();</script>";
                echo "<BR>";
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Eliminar': {
                $modulo = "00100300";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea eliminar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='eliminar' ACTION='inosea.php'>";  // Llena la forma con los datos actuales del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta eliminando
                echo "<TH Class=titulo COLSPAN=5>Datos del Tipo de Recargo a Eliminar</TH>";
                echo "<TR>";
                echo "  <TD Class=partir>Referencia:</TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;' COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                echo "  <TD Class=partir>Fecha de Registro :</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center;'>".$rs->Value('ca_fchreferencia')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Clase</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir style='text-align: center; vertical-align:top;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp;<BR>&nbsp;</TD>";
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
                echo "  <TD Class=listar><B>MBL's:</B><BR>".str_replace("|","<br />",$rs->Value('ca_mbls'))."</TD>";
                echo "  <TD Class=listar COLSPAN=2><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD COLSPAN=4 Class=invertir>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {       // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                echo "  <TH>Observaciones</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=80 Class=listar>".formatNumber($co->Value('ca_cantidad'),3)."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_observaciones')."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                }
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir ROWSPAN=2>Tr�nsito:</TD>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Embarque:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fchembarque')."</TD>";
                echo "  <TD Class=listar><B>Creaci�n:</B><BR>&nbsp;&nbsp;".$rs->Value('ca_usucreado')."</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fchcreado')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Arribo:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fcharribo')."</TD>";
                echo "  <TD Class=listar><B>Actualizaci�n:</B><BR>&nbsp;&nbsp;".$rs->Value('ca_usuactualizado')."</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fchactualizado')."</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Eliminar'></TH>";     // Ordena eliminar el registro de forma permanente
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Muisca': {
                $modulo = "00100300";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea eliminar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$tm->Open("select DISTINCT dm.* from tb_inomaestra_sea im	LEFT OUTER JOIN (select * from tb_dianmaestra where ca_referencia = '".$id."') dm ON (im.ca_referencia = dm.ca_referencia AND true) order by ca_idinfodian DESC")) {    // Trae de la Tabla de la Dian por lo menos un registr vacio de la referencia.
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $cu =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$cu->Open("select ca_identificacion, ca_valor, ca_valor2 from tb_parametros where ca_casouso = 'CU073'")) {          // Selecciona los correos de la tabla Parametros
                    echo "<script>alert(\"".addslashes($cu->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $siono = array("S�","No");
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function window_find(){";
                echo "  document.body.scroll='no';";
                echo "  frame = document.getElementById('window_frame');";
                echo "  frame.style.height = document.body.clientHeight-16;";
                echo "  ventana = document.getElementById('window_div');";
                echo "  ventana.style.visibility = 'visible';";
                echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
                echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
                echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
                echo "  frame.src='ventanas.php?suf=findDianDeposito';";
                echo "}";
                echo "function validar(){";
                echo "  return (true);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; window_div.style.top=dalt'>";
                echo "<DIV ID='window_div' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='window_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='muisca' ACTION='inosea.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta actualizando
                echo "<TH Class=titulo COLSPAN=5>Datos del Master para Muisca</TH>";
                echo "<TR>";
                echo "  <TD Class=partir>Referencia:</TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;' COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                echo "  <TD Class=partir>Fecha de Registro :</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center;'>".$rs->Value('ca_fchreferencia')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Clase</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir style='text-align: center; vertical-align:top;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp;<BR>&nbsp;</TD>";
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
                echo "  <TD Class=listar><B>MBL's:</B><BR>".str_replace("|","<br />",$rs->Value('ca_mbls'))."</TD>";
                echo "  <TD Class=listar COLSPAN=2><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD COLSPAN=4 Class=invertir>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {       // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                echo "  <TH>Observaciones</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=80 Class=listar>".formatNumber($co->Value('ca_cantidad'),3)."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_observaciones')."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                }
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                if ($tm->GetRowCount() > 1) {
                    $tm->MoveNext();
                }
                echo "<TR>";
                echo "  <TD Class=partir>Informaci�n para Muisca:</TD>";
                echo "  <TD Class=listar COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='idinfodian' VALUE=".$tm->Value('ca_idinfodian').">";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=3>Concepto:<BR><SELECT NAME='codconcepto'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==0) {
                        $sel = ($tm->Value('ca_codconcepto')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar>Form.Anterior:<BR><INPUT TYPE='TEXT' NAME='iddocanterior' VALUE='".$tm->Value('ca_iddocanterior')."' SIZE=20 MAXLENGTH=20></TD>";
                echo "  <TD Class=mostrar>Doc.Transbordo:<BR><INPUT TYPE='TEXT' NAME='iddoctrasbordo' VALUE='".$tm->Value('ca_iddoctrasbordo')."' SIZE=20 MAXLENGTH=20></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=3>Tipo Doc.Viaje:<BR><SELECT NAME='tipodocviaje'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==7) {
                        $sel = ($tm->Value('ca_tipodocviaje')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Disposici�n/Carga:<BR><SELECT NAME='dispocarga'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==2) {
                        $sel = ($tm->Value('ca_dispocarga')==$cu->Value('ca_valor2') or (strlen($tm->Value('ca_dispocarga'))==0 and $cu->Value('ca_valor2')==21))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar>Cod.Administraci�n:<BR><SELECT NAME='codadministracion'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==1) {
                        $sel = ($tm->Value('ca_codadministracion')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                $fchinicial = (strlen($tm->Value('ca_fchinicial'))==0)?date(date("Y")."-"."01"."-"."01"):$tm->Value('ca_fchinicial');
                $fchfinal = (strlen($tm->Value('ca_fchfinal'))==0)?date(date("Y")."-"."12"."-"."31"):$tm->Value('ca_fchfinal');
                echo "  </TD>";
                echo "  <TD Class=mostrar>Dep�sito:<BR><INPUT TYPE='TEXT' NAME='coddeposito' VALUE='".$tm->Value('ca_coddeposito')."' SIZE=4 MAXLENGTH=4>&nbsp;<IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0' onclick='window_find();'></TD>";
                echo "  <TD Class=mostrar>Fch.Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' VALUE='$fchinicial' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=mostrar>Fch.Final:<BR><INPUT TYPE='TEXT' NAME='fchfinal' VALUE='$fchfinal' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "  <TD Class=mostrar>Condiciones:<BR><SELECT NAME='idcondiciones'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==4) {
                        $sel = ($tm->Value('ca_idcondiciones')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=2>Tipo Carga:<BR><SELECT NAME='tipocarga'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==6) {
                        $sel = ($tm->Value('ca_tipocarga')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar>Resp.Transp.:<BR><SELECT NAME='responsabilidad'>";
                for ($i=0; $i<count($siono); $i++) {
                    $sel = ($tm->Value('ca_responsabilidad')==substr($siono[$i],0,1))?'SELECTED':'';
                    echo " <OPTION VALUE=".$siono[$i]." $sel>".$siono[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar>Negociaci�n:<BR><SELECT NAME='tiponegociacion'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==5) {
                        $sel = ($tm->Value('ca_tiponegociacion')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar>Precursores:<BR><SELECT NAME='precursores'>";
                for ($i=0; $i<count($siono); $i++) {
                    $sel = ($tm->Value('ca_precursores')==substr($siono[$i],0,1))?'SELECTED':'';
                    echo " <OPTION VALUE=".$siono[$i]." $sel>".$siono[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "</TR>";

                echo "<TR>";
                if (!$cu->Open("select ca_idtransportista, ca_nombre from vi_transportistas where ca_idtransportista in (select ca_valor::int from tb_parametros where ca_casouso = 'CU073' and ca_identificacion = 10 and ca_valor2 like '%".$rs->Value("ca_destino")."%') order by ca_nombre")) {
                    echo "<script>alert(\"".addslashes($cu->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }
                $cu->MoveFirst();
                echo "  <TD Class=mostrar COLSPAN=5>Transportista:<BR><SELECT NAME='idtransportista'>";  // Llena el cuadro de lista transportistas
                echo "    <OPTION VALUE=''></OPTION>";
                while (!$cu->Eof()) {
                    $sel = ($tm->Value('ca_idtransportista')==$cu->Value('ca_idtransportista'))?'SELECTED':'';
                    echo "<OPTION VALUE=".$cu->Value('ca_idtransportista')." $sel>".$cu->Value('ca_nombre')." Nit. :".formatNumber($cu->Value('ca_idtransportista'),0)."</OPTION>";
                    $cu->MoveNext();
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar></TD>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                echo "</TR>";

                echo "  </TABLE></TD>";
                echo "</TR>";


                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Grabar Encabezado'></TH>";     // Ordena Grabar el registro de forma permanente
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'MuiscaCl': {
                $modulo = "00100300";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea eliminar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                $query = "select DISTINCT ic.ca_idreporte, ic.ca_login, ic.ca_idproveedor, ic.ca_proveedor, ic.ca_idcliente, cl.ca_compania, ic.ca_numorden, ic.ca_hbls, ic.ca_fchhbls, ic.ca_numpiezas, ic.ca_peso, ic.ca_volumen, ic.ca_continuacion, ic.ca_continuacion_dest, bg.ca_nombre as ca_bodega, dc.* from tb_inoclientes_sea ic";
                $query.= " LEFT OUTER JOIN tb_clientes cl ON (ic.ca_idcliente = cl.ca_idcliente) LEFT OUTER JOIN tb_bodegas bg ON (ic.ca_idbodega = bg.ca_idbodega)";
                $query.= " LEFT OUTER JOIN tb_dianclientes dc ON (ic.ca_referencia = dc.ca_referencia AND ic.ca_idcliente = dc.ca_idcliente AND ic.ca_hbls = dc.ca_house)";
                $query.= " where ic.ca_referencia = '$id' and ic.ca_idcliente = '$cl' and ic.ca_hbls = '$hb' order by ca_idinfodian DESC";
                if (!$tm->Open("$query")) {    // Trae de la Tabla de la Dian por lo menos un registr vacio de la referencia.
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $rp =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                $query = "select uv.ca_idconsignatario, cl.ca_idcliente, cl.ca_digito, cl.ca_compania as ca_nombre_cli, tr.ca_identificacion as ca_identificacion_con, tr.ca_nombre as ca_nombre_con, uv.ca_mercancia_desc, uv.ca_idconsignar, b1.ca_nombre as ca_consignar, b2.ca_tipo as ca_tipobodega, b2.ca_nombre as ca_bodega from tb_reportes uv ";
                $query.= " INNER JOIN tb_concliente cc ON (cc.ca_idcontacto = uv.ca_idconcliente) INNER JOIN tb_clientes cl ON (cl.ca_idcliente = cc.ca_idcliente) LEFT OUTER JOIN tb_terceros tr ON (tr.ca_idtercero = uv.ca_idconsignatario) LEFT OUTER JOIN tb_bodegas b1 ON (b1.ca_idbodega = uv.ca_idconsignar) LEFT OUTER JOIN tb_bodegas b2 ON (b2.ca_idbodega = uv.ca_idbodega) ";
                $query.= " INNER JOIN (select ca_consecutivo, max(ca_version) as ca_version from tb_reportes where ca_consecutivo = (select ca_consecutivo from tb_reportes where ca_idreporte = ".$tm->Value("ca_idreporte").") group by ca_consecutivo) sr ON (sr.ca_consecutivo = uv.ca_consecutivo and sr.ca_version = uv.ca_version)";
                if (!$rp->Open("$query")) {    // Trae de la Tabla de Reportes la Ultima Versi�n del Reporte.
                    echo "<script>alert(\"".addslashes($rp->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $consignatario = ($rp->Value('ca_idconsignatario')!=0)?$rp->Value('ca_nombre_con')." Nit. ".$rp->Value('ca_identificacion_con'):$rp->Value('ca_nombre_cli')." Nit. ".number_format($rp->Value('ca_idcliente'),0)."-".$rp->Value('ca_digito');
                $consignatario = (($rp->Value('ca_idconsignar')==1)?$consignatario:$rp->Value('ca_consignar')).(($rp->Value('ca_tipobodega')!= "Coordinador Logistico")?" / ".$rp->Value('ca_tipobodega')." ".(($rp->Value('ca_bodega')!='N/A')?$rp->Value('ca_bodega'):""):"");
                $descripcion_merc = (strlen(trim($tm->Value('ca_mercancia_desc')))!=0)?$tm->Value('ca_mercancia_desc'):$rp->Value('ca_mercancia_desc');
                $cu =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$cu->Open("select ca_identificacion, ca_valor, ca_valor2 from tb_parametros where ca_casouso = 'CU073'")) {          // Selecciona los correos de la tabla Parametros
                    echo "<script>alert(\"".addslashes($cu->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $siono = array("S�","No");
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function window_find(){";
                echo "  document.body.scroll='no';";
                echo "  frame = document.getElementById('window_frame');";
                echo "  frame.style.height = document.body.clientHeight-16;";
                echo "  ventana = document.getElementById('window_div');";
                echo "  ventana.style.visibility = 'visible';";
                echo "  ancho = frame.getAttribute('STYLE').width.substring( 0, frame.getAttribute('STYLE').width.indexOf('px') );";
                echo "  alto  = frame.getAttribute('STYLE').height.substring( 0, frame.getAttribute('STYLE').height.indexOf('px') );";
                echo "  ventana.style.left = eval((document.body.clientWidth/2)-(ancho/2));";
                echo "  frame.src='ventanas.php?suf=findDianDeposito';";
                echo "}";
                echo "function validar(){";
                echo "  return (true);";
                echo "}";
                echo "</script>";
                echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
                echo "</HEAD>";
                echo "<BODY ID=Cuerpo onscroll='dalt=document.body.scrollTop+3; window_div.style.top=dalt'>";
                echo "<DIV ID='window_div' STYLE='visibility:hidden; position:absolute; border-width:3; border-color:#666666; border-style:solid;'>";
                echo "<IFRAME ID='window_frame' SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:645; height:200'>";
                echo "</IFRAME>";
                echo "</DIV>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='muiscaCl' ACTION='inosea.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='referencia' VALUE=\"".$id."\">";             // Hereda el Id de la Referencia que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='idcliente' VALUE=\"".$cl."\">";              // Hereda el Id del Cliente que se esta modificando
                echo "<INPUT TYPE='HIDDEN' NAME='house' VALUE=\"".$hb."\">";                    // Hereda el Id del Cliente que se esta modificando
                echo "<TH Class=titulo COLSPAN=5 style='font-size: 11px; vertical-align:bottom'>$id<BR>Informaci�n del Cliente</TH>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>ID Reporte:</B><BR>".$rp->Value('ca_consecutivo')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>Vendedor:</B><BR>".$tm->Value('ca_login')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>ID Proveedor:</B><BR>".$tm->Value('ca_idproveedor')."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=2><B>Proveedor:</B><BR>".$tm->Value('ca_proveedor')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;'><B>Id Cliente:</B><BR>".number_format($tm->Value('ca_idcliente'))."</TD>";
                echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=3><B>Nombre del Cliente:</B><BR>".$tm->Value('ca_compania')."</TD>";
                echo "  <TD Class=mostrar>Orden Cliente No.<BR>".$tm->Value('ca_numorden')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=5><B>Carga Consignada a:</B><BR>$consignatario</TD>";
                echo "</TR>";
                echo "<TR>";
                echo " <TD Class=invertir COLSPAN=2>";
                echo "  <TABLE WIDTH=100% CELLSPACING=1>";
                echo "  <TR>";
                echo "    <TD Class=mostrar COLSPAN=2>HBL:<BR>".$tm->Value('ca_hbls')."</TD>";
                echo "    <TD Class=mostrar>Fch.HBL<BR>".$tm->Value('ca_fchhbls')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "    <TD Class=mostrar>No.Piezas:<BR>".$tm->Value('ca_numpiezas')."</TD>";
                echo "    <TD Class=mostrar>No.Kilos:<BR>".$tm->Value('ca_peso')."</TD>";
                echo "    <TD Class=mostrar>No.CMB:<BR>".$tm->Value('ca_volumen')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "  <TD Class=mostrar>Continua/Viaje:<BR>".$tm->Value('ca_continuacion')."</TD>";
                echo "  <TD Class=mostrar COLSPAN=2>Destino Final:<BR>".$tm->Value('ca_continuacion_dest')."</TD>";
                echo "  </TR>";
                echo "  <TR>";
                echo "  <TD Class=mostrar COLSPAN=5>Operador:<BR>".$tm->Value('ca_bodega')."</TD>";

                echo "  </TR>";
                echo "  </TABLE>";
                echo " </TD>";

                echo " <TD Class=invertir COLSPAN=3>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '$id' and ca_idconcepto != 9")) {       // Selecciona todos lo registros de la tabla Equiposde una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "</TR>";

                    $co->MoveNext();
                }
                echo "  </TABLE>";
                echo " </TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=5></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=invertir style='font-size: 11px; text-align: center; font-weight:bold;' COLSPAN=5>INFORMACI�N PARA MUISCA</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar COLSPAN=5><TABLE WIDTH=100% CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='idinfodian' VALUE=".$tm->Value('ca_idinfodian').">";

                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=2>Disposici�n/Carga:<BR><SELECT NAME='dispocarga'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==2) {
                        $sel = ($tm->Value('ca_dispocarga')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar COLSPAN=3>Tipo Doc.Viaje:<BR><SELECT NAME='tipodocviaje'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==7) {
                        $sel = ($tm->Value('ca_tipodocviaje')==$cu->Value('ca_valor2') or (strlen($tm->Value('ca_tipodocviaje'))==0 and $cu->Value('ca_valor2')==3))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=mostrar>Condiciones:<BR><SELECT NAME='idcondiciones'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==4) {
                        $sel = ($tm->Value('ca_idcondiciones')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar>Resp.Transp.:<BR><SELECT NAME='responsabilidad'>";
                for ($i=0; $i<count($siono); $i++) {
                    $sel = ($tm->Value('ca_responsabilidad')==substr($siono[$i],0,1))?'SELECTED':'';
                    echo " <OPTION VALUE=".$siono[$i]." $sel>".$siono[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar>Negociaci�n:<BR><SELECT NAME='tiponegociacion'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==5) {
                        $sel = ($tm->Value('ca_tiponegociacion')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "  <TD Class=mostrar>Precursores:<BR><SELECT NAME='precursores'>";
                for ($i=0; $i<count($siono); $i++) {
                    $sel = ($tm->Value('ca_precursores')==substr($siono[$i],0,1))?'SELECTED':'';
                    echo " <OPTION VALUE=".$siono[$i]." $sel>".$siono[$i]."</OPTION>";
                }
                echo "  </SELECT></TD>";
                echo "  <TD Class=mostrar>Tipo Carga:<BR><SELECT NAME='tipocarga'>";  // Llena el cuadro de lista con los valores de la tabla Parametros
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==6) {
                        $sel = ($tm->Value('ca_tipocarga')==$cu->Value('ca_valor2'))?'SELECTED':'';
                        echo"<OPTION VALUE=".$cu->Value('ca_valor2')." $sel>".$cu->Value('ca_valor')."</OPTION>";
                    }
                    $cu->MoveNext();
                }
                echo "  </TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=mostrar>Cod.Dep�sito:<BR><INPUT TYPE='TEXT' NAME='coddeposito' VALUE='".$tm->Value('ca_coddeposito')."' SIZE=4 MAXLENGTH=4>&nbsp;<IMG src='graficos/lupa.gif' alt='Buscar' hspace='0' vspace='0' onclick='window_find();'></TD>";
                echo "  <TD Class=mostrar>Vlr.FOB:<BR><INPUT TYPE='TEXT' NAME='vlrfob' VALUE='".((strlen($tm->Value('ca_vlrfob'))==0)?0:$tm->Value('ca_vlrfob'))."' SIZE=20 MAXLENGTH=20></TD>";
                echo "  <TD Class=mostrar>Vlr.Flete:<BR><INPUT TYPE='TEXT' NAME='vlrflete' VALUE='".((strlen($tm->Value('ca_vlrflete'))==0)?0:$tm->Value('ca_vlrflete'))."' SIZE=20 MAXLENGTH=20></TD>";
                if (!$cu->Open("select ca_idciudad, ca_ciudad from tb_ciudades where ca_idtrafico = 'CO-057' order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla ciudades
                    echo "<script>alert(\"".addslashes($cu->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'repgenerator.php';</script>";
                    exit; }
                $cu->MoveFirst();
                echo " <TD Class=listar COLSPAN=2>Destino DTA/OTM No Cord. por Coltrans:<BR><SELECT NAME='iddestino'>";
                echo " <OPTION VALUE=''></OPTION>";
                while ( !$cu->Eof()) {
                        $sel = ($cu->Value('ca_idciudad')==$tm->Value('ca_iddestino'))?'SELECTED':'';
                        echo " <OPTION VALUE='".$cu->Value('ca_idciudad')."' $sel>".$cu->Value('ca_ciudad')."</OPTION>";
                        $cu->MoveNext();
                      }
                echo "  </SELECT></TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=5>Descripci�n de la Mercanc�a:<BR><TEXTAREA NAME='mercancia_desc' WRAP=virtual ROWS=3 COLS=110>$descripcion_merc</TEXTAREA></TD>";
                echo "</TR>";

                echo "  </TABLE></TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='accion' VALUE='Grabar Cliente'></TH>";     // Ordena Grabar el Registro del Cliente
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";
                //           echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";   // Link que proporciona la Ayuda en l�nea
                require_once("footer.php");
                echo "</BODY>";
                break;
            }
        case 'Prevalidador': {
                $modulo = "00100300";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea eliminar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                echo "<HEAD>";
                echo "<TITLE>$titulo</TITLE>";
                echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
                echo "function validar(){";
                echo "  if (document.getElementById('NumEnvio').value == '')";
                echo "      alert('Ingrese el N�mero Consecutivo correspondiente, seg�n lo informa la p�gina de la Dian - M�dulo Muisca!');";
                echo "  else if (!confirm(\"�Esta seguro que desea generar el XML?\"))";
                echo "      alert('Ha decido cancelar la generaci�n del Archivo XML');";
                echo "  else";
                echo "      return (true);";
                echo "  return (false);";
                echo "}";
                echo "</script>";
                echo "</HEAD>";
                echo "<BODY>";
                require_once("menu.php");
                echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
                echo "<CENTER>";
                echo "<H3>$titulo</H3>";
                echo "<FORM METHOD=post NAME='muisca' ACTION='inosea.php' ONSUBMIT='return validar();'>";  // Llena la forma con los datos actuales del registro
                echo "<TABLE WIDTH=600 CELLSPACING=1>";
                echo "<INPUT TYPE='HIDDEN' NAME='id' VALUE=".$id.">";              // Hereda el Id del registro que se esta actualizando
                echo "<TH Class=titulo COLSPAN=5>Generar el Archivo XML para sistema Muisca</TH>";
                echo "<TR>";
                echo "  <TD Class=partir>Referencia:</TD>";
                echo "  <TD Class=listar style='font-size: 11px; font-weight:bold;' COLSPAN=2>".$rs->Value('ca_referencia')."</TD>";
                echo "  <TD Class=partir>Fecha de Registro :</TD>";
                echo "  <TD Class=listar style='font-size: 11px; text-align: center;'>".$rs->Value('ca_fchreferencia')."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Clase</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Origen</TD>";
                echo "  <TD Class=partir style='font-size: 11px; text-align: center;' COLSPAN=2>Ciudad de Destino</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir style='text-align: center; vertical-align:top;'>".$rs->Value('ca_impoexpo')."<BR>&nbsp;<BR>&nbsp;</TD>";
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
                echo "  <TD Class=listar><B>MBL's:</B><BR>".str_replace("|","<br />",$rs->Value('ca_mbls'))."</TD>";
                echo "  <TD Class=listar COLSPAN=2><B>Observaciones:</B><BR>".nl2br($rs->Value('ca_observaciones'))."</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD COLSPAN=4 Class=invertir>";
                $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$co->Open("select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {       // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Mar�timo
                    echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>No.Precinto</TH>";
                echo "  <TH>Observaciones</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                    echo "<TR>";
                    echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=80 Class=listar>".formatNumber($co->Value('ca_cantidad'),3)."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_numprecinto')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_observaciones')."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                }
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";

                echo "<TR>";
                echo "  <TD Class=partir>Nro.Envio:</TD>";
                echo "  <TD Class=listar><INPUT TYPE='TEXT' NAME='NumEnvio' SIZE=15 MAXLENGTH=15></TD>";
                echo "  <TD Class=listar COLSPAN=3><- Ingrese el N�mero de Env�o seg�n lo indique la P�gina de la Dian - M�dulo Muisca</TD>";
                echo "</TR>";

                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=5></TD>";
                echo "</TR>";
                echo "</TABLE><BR>";
                echo "<TABLE CELLSPACING=10>";
                echo "<TH><INPUT Class=submit TYPE='SUBMIT' NAME='boton' VALUE='Generar XML'></TH>";     // Ordena la Generaci�n del XML
                echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Cancelar' ONCLICK='javascript:document.location.href = \"inosea.php?boton=Consultar\&id=$id\"'></TH>";  // Cancela la operaci�n
                echo "</TABLE>";
                echo "</FORM>";
                echo "</CENTER>";

                break;
            }
        case 'Generar XML': {
                $modulo = "00100300";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
                //           include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
                if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '".$id."'")) {    // Mueve el apuntador al registro que se desea eliminar
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if ($rs->GetRowCount()==0) {
                    echo "<script>alert(\"No ha sido creada la informaci�n del Documento Consolidador para Muisca\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $ic =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$ic->Open("select DISTINCT ic.ca_referencia, ic.ca_idcliente, ic.ca_hbls, ic.ca_fchhbls, ic.ca_continuacion, ic.ca_continuacion_dest, ic.ca_contenedores, ic.ca_numpiezas, ic.ca_peso, rp.ca_consecutivo from tb_inoclientes_sea ic INNER JOIN tb_reportes rp ON (ic.ca_idreporte = rp.ca_idreporte) where ic.ca_referencia = '".$id."' order by ic.ca_idcliente")) {    // Trae de la Tabla de la Dian el �ltimo registro.
                    echo "<script>alert(\"".addslashes($dc->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $dm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$dm->Open("select * from tb_dianmaestra where ca_referencia = '".$id."' order by ca_idinfodian DESC limit 1")) {    // Trae de la Tabla de la Dian el �ltimo registro.
                    echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $cu =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$cu->Open("select ca_identificacion, ca_valor, ca_valor2 from tb_parametros where ca_casouso = 'CU073'")) {          // Selecciona los correos de la tabla Parametros
                    echo "<script>alert(\"".addslashes($cu->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit; }

                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos

                // Set the content type to be XML, so that the browser will   recognise it as XML.
                header( "content-type: application/xml; charset=ISO-8859-1" );

                // "Create" the document.
                $xml = new DOMDocument( "1.0", "ISO-8859-1" );

                // Se Crear el elemento mas
                $xml_mas = $xml->createElement( "mas" );
                $xml_mas->setAttributeNS("http://www.w3.org/2001/XMLSchema-instance" ,"xsi:noNamespaceSchemaLocation", "../xsd/1166.xsd");

                // Se Crear el elemento Cab
                $xml_cab = $xml->createElement( "Cab" );

                // Se Crear el elemento pal66
                $xml_pal66 = $xml->createElement( "pal66" );

                $FecEnvio = time();
                $ValorTotal = 0;
                $vlrfob = 0;
                $vlrflete = 0;
                $CantReg = 0;

                $xml_NumEnvio = $xml->createElement( "NumEnvio", $NumEnvio );
                if (!$tm->Open("update tb_dianmaestra set ca_numenvio = $NumEnvio, ca_fchenvio = '".date("d M Y H:i:s", $FecEnvio)."', ca_usuenvio = '$usuario' where ca_idinfodian = ".$dm->Value("ca_idinfodian"))) {    // Actualizar la Fecha y Hora de Envio
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$tm->Open("select ca_numenvio from tb_dianreservados where ca_numero_resv = '".$dm->Value("ca_iddocactual")."'")) {    // Toma el siguiente n�mero disponible de la tabla de Reservados.
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }

                if ($dm->Value("ca_iddocactual")=='' or $tm->Value("ca_numenvio")!=$NumEnvio) {
                    if (!$tm->Open("select fun_numreserva($NumEnvio, ".substr($dm->Value("ca_fchtrans"),0,4).", '$usuario') as ca_numero_resv")) {    // Toma el siguiente n�mero disponible de la tabla de Reservados.
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if ($tm->Value("ca_numero_resv") == "") {    // Verifica las Disponibilidad de N�meros de Documentos
                        echo "<script>alert(\"No hay N�meros de Documento Disponibles para este Env�o. Solicite un nuevo grupo en la P�gina de la Dian\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    $iddocactual = $tm->Value("ca_numero_resv");
                } else {
                    $iddocactual = $dm->Value("ca_iddocactual");
                }

                // Registra atributos del Elemento pal66
                if ($dm->Value("ca_codconcepto") == 3 or $dm->Value("ca_codconcepto") == 4) {
                    $xml_pal66->setAttribute("ftra", $dm->Value("ca_fchtrans"));
                }
                $xml_pal66->setAttribute("ideDoc", $iddocactual);
                if ($dm->Value("ca_iddocanterior") != "") {
                    $xml_pal66->setAttribute("nfan", $dm->Value("ca_iddocanterior"));
                }
                $ValorTotal+= $dm->Value("ca_tipodocviaje");
                $CantReg+= 1;
                $xml_pal66->setAttribute("tdv", $dm->Value("ca_tipodocviaje"));
                $xml_pal66->setAttribute("cope", ($rs->Value("ca_impoexpo")=="Importaci�n")?1:(($rs->Value("ca_impoexpo")=="Exportaci�n")?2:0));
                $xml_pal66->setAttribute("calo", 1);
                $xml_pal66->setAttribute("cres", 3);
                $xml_pal66->setAttribute("cadm", $dm->Value("ca_codadministracion"));
                $xml_pal66->setAttribute("dica", $dm->Value("ca_dispocarga"));

                $arribo_array = array();
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==9 and $cu->Value('ca_valor')==$rs->Value("ca_destino")) {
                        $arribo_array = explode("|",$cu->Value('ca_valor2'));
                        break;
                    }
                    $cu->MoveNext();
                }
                $xml_pal66->setAttribute("cdde", $arribo_array[0]);
                $xml_pal66->setAttribute("ccd", $arribo_array[1]);
                $xml_pal66->setAttribute("cpa", $arribo_array[2]);
                if ($dm->Value("ca_dispocarga") != "21" and strlen($dm->Value("ca_coddeposito"))!=0) {
                    $xml_pal66->setAttribute("cdep", $dm->Value("ca_coddeposito"));
                }

                $mbls = explode("|",$rs->Value('ca_mbls'));
                $xml_pal66->setAttribute("ndv", $mbls[0]);
                $xml_pal66->setAttribute("fdv", $mbls[1]);

                $num_hbls = $ic->GetRowCount();
                $xml_pal66->setAttribute("cdhi", $num_hbls);

                $mod_trans = "";
                $cu->MoveFirst();
                while (!$cu->Eof()) {
                    if ($cu->Value('ca_identificacion')==3 and $cu->Value('ca_valor')=='Mar�timo') {
                        $mod_trans = $cu->Value('ca_valor2');
                        break;
                    }
                    $cu->MoveNext();
                }
                $xml_pal66->setAttribute("mtr", $mod_trans);
                if ($dm->Value("ca_iddoctrasbordo") != "") {
                    $xml_pal66->setAttribute("ftrb", $dm->Value("ca_iddoctrasbordo"));
                }

                // =========================== Agente de Carga ===========================
                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$tm->Open("select ca_idtransportista, ca_digito from vi_transportistas where ca_idtransportista::text = '".$dm->Value("ca_idtransportista")."'")) {    // Trae la Informaci�n del Agente Genera de Carga / Transportista
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $xml_pal66->setAttribute("doc1", 31 );
                $xml_pal66->setAttribute("nid1", $tm->Value("ca_idtransportista"));
                $xml_pal66->setAttribute("dv1", $tm->Value("ca_digito"));

                // =========================== Remitente = Agente en el Exterior ===========================
                if (!$tm->Open("select ca_idagente, count(ca_idagente) from tb_reportes where ca_fchanulado is null and ca_idreporte in (select ca_idreporte from tb_inoclientes_sea where ca_referencia = '".$rs->Value("ca_referencia")."') group by ca_idagente")) {    // Calcula a partir de los reportes de Negocio quien es el Agente
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$tm->Open("select * from vi_agentes where ca_idagente = '".$tm->Value("ca_idagente")."'")) {    // Calcula a partir de los reportes de Negocio quien es el Agente
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $xml_pal66->setAttribute("doc2", 43);
                $xml_pal66->setAttribute("raz2", utf8_encode($tm->Value("ca_nombre")));

                // =========================== Consignatario ===========================
                $xml_pal66->setAttribute("doc3", 31);
                $xml_pal66->setAttribute("nid3", 800024075);
                $xml_pal66->setAttribute("dv3", 8);

                $xml_pal66->setAttribute("dir3", "CRA 98 NO 25 G 10 INT 18");
                $xml_pal66->setAttribute("cde3", "11");
                $xml_pal66->setAttribute("ccd3", "001");

                // =========================== Caracter�sticas de la Operaci�n ===========================
                $xml_pal66->setAttribute("cond", $dm->Value("ca_idcondiciones"));
                $xml_pal66->setAttribute("rtr", $dm->Value("ca_responsabilidad"));
                $xml_pal66->setAttribute("tneg", $dm->Value("ca_tiponegociacion"));
                $xml_pal66->setAttribute("tcar", $dm->Value("ca_tipocarga"));
                $xml_pal66->setAttribute("pre", $dm->Value("ca_precursores"));

                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$tm->Open("select count(ca_idequipo) as ca_numcontenedores from tb_inoequipos_sea where ca_idconcepto != 9 and ca_referencia = '".$rs->Value("ca_referencia")."'")) {    // Calcula en N�mero de Contenedores
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $xml_pal66->setAttribute("ntc", $tm->Value("ca_numcontenedores"));

                // Crea el Recordset con los Contenedores
                $ie =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$ie->Open("select * from vi_inoequipos_sea where ca_referencia = '".$id."'")) {    // Selecciona los Registros de la Tabala Equipos
                    echo "<script>alert(\"".addslashes($ie->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }

                $ntb = 0;  // N�mero Total Bultos
                $tpb = 0;  // Total Peso Bruto
                $unidades_carga = array();

                // Se Crear los elementos hijos
                $ic->MoveFirst();
                $dc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                $rp =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                while (!$ic->Eof() and !$ic->IsEmpty()) {
                // Se Crear el elemento hijo
                    $xml_hijo = $xml->createElement( "hijo" );

                    if (!$dc->Open("select * from tb_dianclientes where ca_idinfodian = ".$dm->Value("ca_idinfodian")." and ca_referencia = '".$ic->Value("ca_referencia")."' and ca_idcliente = '".$ic->Value("ca_idcliente")."' and ca_house = '".$ic->Value("ca_hbls")."'")) {    // Trae de la Tabla de la Dian Clientes.
                        echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if (!$rp->Open("select * from vi_reportes where ca_consecutivo = '".$ic->Value("ca_consecutivo")."' and ca_version = (select max(ca_version) as ca_version from tb_reportes where ca_fchanulado is null and ca_consecutivo = '".$ic->Value("ca_consecutivo")."')")) {    // Trae de la Tabla de la Reportes de Negocio �ltima version.
                        echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if (!$tm->Open("select ca_numenvio from tb_dianreservados where ca_numero_resv = '".$dc->Value("ca_iddocactual")."'")) {    // Toma el siguiente n�mero disponible de la tabla de Reservados.
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if ($dc->Value("ca_iddocactual") == '' or $tm->Value('ca_numenvio')!=$NumEnvio){
                        if (!$tm->Open("select fun_numreserva($NumEnvio, ".substr($dm->Value("ca_fchtrans"),0,4).", '$usuario') as ca_numero_resv")) {    // Toma el siguiente n�mero disponible de la tabla de Reservados.
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        if ($tm->Value("ca_numero_resv") == "") {    // Verifica las Disponibilidad de N�meros de Documentos
                            echo "<script>alert(\"No hay N�meros de Documento Disponibles para este Env�o. Solicite un nuevo grupo en la P�gina de la Dian\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        $iddocactual_clie = $tm->Value("ca_numero_resv");
                        if (!$tm->Open("update tb_dianclientes set ca_iddocactual = '$iddocactual_clie' where ca_idinfodian = ".$dm->Value("ca_idinfodian")." and ca_referencia = '".$ic->Value("ca_referencia")."' and ca_idcliente = '".$ic->Value("ca_idcliente")."' and ca_house = '".$ic->Value("ca_hbls")."'")) {    // Actualiza el N�mero de Reserva en DianClientes
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    } else {
                        $iddocactual_clie = $dc->Value("ca_iddocactual");
                    }

                    if ($dm->Value("ca_iddocanterior") != "") {
                        $xml_hijo->setAttribute("hnfa", $dm->Value("ca_iddocanterior"));
                    }
                    $xml_hijo->setAttribute("hdca", $dc->Value("ca_dispocarga"));

                    $destino = ($ic->Value("ca_continuacion")=="N/A")?$rs->Value("ca_destino"):$ic->Value("ca_continuacion_dest");
                    $destino = (strlen($dc->Value("ca_iddestino"))!=0)?$dc->Value("ca_iddestino"):$destino;

                    $arribo_array = array();
                    $cu->MoveFirst();
                    while (!$cu->Eof()) {
                        if ($cu->Value('ca_identificacion')==9 and $cu->Value('ca_valor')==$destino) {
                            $arribo_array = explode("|",$cu->Value('ca_valor2'));
                            break;
                        }
                        $cu->MoveNext();
                    }
                    $xml_hijo->setAttribute("hdpt", $arribo_array[0]);
                    $xml_hijo->setAttribute("hciu", $arribo_array[1]);
                    $xml_hijo->setAttribute("hpa", $arribo_array[2]);

                    if ($dc->Value("ca_dispocarga") != "21") {
                        $xml_hijo->setAttribute("hdep", $dc->Value("ca_coddeposito"));
                    }

                    $xml_hijo->setAttribute("tdv2", $dc->Value("ca_tipodocviaje"));
                    $xml_hijo->setAttribute("hijo", $ic->Value("ca_hbls"));
                    $xml_hijo->setAttribute("hfe", $ic->Value("ca_fchhbls"));

                    // =========================== Remitente ===========================
                    $xml_hijo->setAttribute("hdo2", 43);
                    if (strlen($rp->Value("ca_nombre_pro")) != 0) {
                        $xml_hijo->setAttribute("hrs2", utf8_encode($rp->Value("ca_nombre_pro")));
                    } else {
                        $xml_hijo->setAttribute("hrs2", utf8_encode($rp->Value("ca_agente")));
                    }

                    // =========================== Destinatario ===========================
                    if ($ic->Value("ca_continuacion")=="OTM") {
                        $xml_hijo->setAttribute("hdo3", 31);

                        $cadena = str_replace(array(",","."), "", $rp->Value("ca_consignar"));
                        $nit = substr($cadena, strpos($cadena, "Nit")+3);
                        $nit = explode("-",$nit);
                        $nit = $nit[0];

                        if (!$tm->Open("select * from vi_transportistas where ca_idtransportista = $nit")) {    // Trae la informaci�n del Operador Multimodal de la Tabla Transportistas.
                            echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        $xml_hijo->setAttribute("hni3", $tm->Value("ca_idtransportista"));
                        $xml_hijo->setAttribute("hdv3", $tm->Value("ca_digito"));
                        $arribo_array = array();
                        $cu->MoveFirst();
                        while (!$cu->Eof()) {
                            if ($cu->Value('ca_identificacion')==9 and $cu->Value('ca_valor')==$tm->Value("ca_idciudad")) {
                                $arribo_array = explode("|",$cu->Value('ca_valor2'));
                                break;
                            }
                            $cu->MoveNext();
                        }
                        if (strlen($arribo_array[0])!=0){
                            $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                        }
                        if (strlen($arribo_array[1])!=0){
                            $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                        }
                    } else if ($rp->Value("ca_idconsignatario")!=0) {
                            if (!$tm->Open("select * from tb_terceros where ca_idtercero = ".$rp->Value("ca_idconsignatario"))) {    //
                                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                                echo "<script>document.location.href = 'inosea.php';</script>";
                                exit;
                            }
                            $xml_hijo->setAttribute("hdo3", 31);
                            $idconsignatario = explode("-", str_replace(array(",","."), "", $tm->Value("ca_identificacion")));
                            $xml_hijo->setAttribute("hni3", $idconsignatario[0]);
                            $xml_hijo->setAttribute("hdv3", $idconsignatario[1]);

                            $arribo_array = array();
                            $cu->MoveFirst();
                            while (!$cu->Eof()) {
                                if ($cu->Value('ca_identificacion')==9 and $cu->Value('ca_valor')==$tm->Value("ca_idciudad")) {
                                    $arribo_array = explode("|",$cu->Value('ca_valor2'));
                                    break;
                                }
                                $cu->MoveNext();
                            }
                            if (strlen($arribo_array[0])!=0){
                                $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                            }
                            if (strlen($arribo_array[1])!=0){
                                $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                            }
                        } else {
                            $xml_hijo->setAttribute("hdo3", 31);
                            $xml_hijo->setAttribute("hni3", $rp->Value("ca_idcliente"));
                            $xml_hijo->setAttribute("hdv3", $rp->Value("ca_digito"));
                            // $xml_hijo->setAttribute("hdir", htmlentities($rp->Value("ca_direccion_cli")));

                            $arribo_array = array();
                            $cu->MoveFirst();
                            while (!$cu->Eof()) {
                                if ($cu->Value('ca_identificacion')==9 and $cu->Value('ca_valor')==$rp->Value("ca_idciudad_cli")) {
                                    $arribo_array = explode("|",$cu->Value('ca_valor2'));
                                    break;
                                }
                                $cu->MoveNext();
                            }
                            if (strlen($arribo_array[0])!=0){
                                $xml_hijo->setAttribute("hde3", $arribo_array[0]);
                            }
                            if (strlen($arribo_array[1])!=0){
                                $xml_hijo->setAttribute("hci3", $arribo_array[1]);
                            }
                        }

                    // =========================== Carga Peligrosa ===========================

                    // =========================== Informaci�n de la Carga ===========================
                    $xml_hijo->setAttribute("hcon", $dc->Value("ca_idcondiciones"));
                    $xml_hijo->setAttribute("hrt", $dc->Value("ca_responsabilidad"));
                    $xml_hijo->setAttribute("htn", $dc->Value("ca_tiponegociacion"));
                    $xml_hijo->setAttribute("htc", $dc->Value("ca_tipocarga"));
                    $xml_hijo->setAttribute("hpre", $dc->Value("ca_precursores"));

                    $xml_hijo->setAttribute("hmon", $dc->Value("ca_vlrfob"));
                    $xml_hijo->setAttribute("hvf", $dc->Value("ca_vlrflete"));

                    $vlrfob+= $dc->Value("ca_vlrfob");
                    $vlrflete+= $dc->Value("ca_vlrflete");

                    $contenedores = explode("|", $ic->Value("ca_contenedores"));

                    if ( $dc->Value("ca_tipocarga") == 2 ) {
                        $num_cont = count($contenedores);
                        $xml_hijo->setAttribute("htco", $num_cont);
                    }else {
                        $xml_hijo->setAttribute("htco", 0);
                    }

                    $xml_hijo->setAttribute("htb", $ic->Value("ca_numpiezas"));
                    $xml_hijo->setAttribute("htpb", round($ic->Value("ca_peso"),2));
                    $xml_hijo->setAttribute("htvo", 0);
                    $ntb+= $ic->Value("ca_numpiezas");  // N�mero Total Bultos
                    $tpb+= round($ic->Value("ca_peso"),2);  // Total Peso Bruto

                    $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                    if (!$tm->Open("select ca_idtrafico, ca_idciudad from vi_ciudades where ca_idciudad = '".$rp->Value("ca_origen")."'")) {    // Trae informaci�n de la Ciudad y Tr�fico de Origen
                        echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    $xml_hijo->setAttribute("hcpe", substr($tm->Value("ca_idtrafico"),0,2));
                    $xml_hijo->setAttribute("hcle", substr($tm->Value("ca_idtrafico"),0,2).substr($tm->Value("ca_idciudad"),0,3));
                    $xml_hijo->setAttribute("ideDoc", $iddocactual_clie);

                    $grp = 0;
                    // Se Crear el elemento h167
                    $xml_h167 = $xml->createElement( "h167" );

                    if ($dm->Value("ca_iddocanterior") != "") {
                        $xml_h167->setAttribute("fa67", $dm->Value("ca_iddocanterior"));
                    }
                    $xml_h167->setAttribute("cont", $dc->Value("ca_tipocarga"));
                    if ( $dc->Value("ca_tipocarga") == 2 ) {
                        $xml_h167->setAttribute("tun", 2);
                        $xml_h167->setAttribute("idu", str_replace("-","",$ie->Value("ca_idequipo")));

                        $tam_equipo = (strpos($ie->Value("ca_concepto"),'High Cube') !== false)?2:(($ie->Value("ca_liminferior")==20)?1:(($ie->Value("ca_liminferior")==40)?3:4));
                        $xml_h167->setAttribute("tam", $tam_equipo);
                        $tip_equipo = (strpos($ie->Value("ca_concepto"),'Flat Rack') !== false)?2:((strpos($ie->Value("ca_concepto"),'Open Top') !== false)?3:((strpos($ie->Value("ca_concepto"),'Collapsible') !== false)?4:((strpos($ie->Value("ca_concepto"),'Platform') !== false)?5:((strpos($ie->Value("ca_concepto"),'Tank') !== false)?6:((strpos($ie->Value("ca_concepto"),'Reefer') !== false)?8:1)))));
                        $xml_h167->setAttribute("teq", $tip_equipo);
                        $xml_h167->setAttribute("npr", $ie->Value("ca_numprecinto"));
                    }
                    $sub_ps = 0;
                    $sub_pz = 0;
                    $sub_cn = 0;
                    if ( $dm->Value("ca_tipocarga") == 2 ) {
                        $array_cont = array();
                        foreach (explode("|",$ic->Value('ca_contenedores')) as $parciales) {
                            $parcial = explode(";",$parciales);
                            $unidades_carga[$parcial[0]]['pz'] = $parcial[1];
                            $unidades_carga[$parcial[0]]['ps'] = round($parcial[2],2);
                            $unidades_carga[$parcial[0]]['cn'] = 1;

                            $ie->MoveFirst();
                            while (!$ie->Eof() and !$ie->IsEmpty()) {
                                if ($ie->Value("ca_idequipo") != $parcial[0]) {;
                                    $ie->MoveNext();
                                    continue;
                                }

                                $grp++;
                                $sub_ps+= $unidades_carga[$ie->Value("ca_idequipo")]['ps'];
                                $sub_pz+= $unidades_carga[$ie->Value("ca_idequipo")]['pz'];
                                $sub_cn+= 1;
                                // Se Crear el elemento h267
                                $xml_h267 = $xml->createElement( "h267" );
                                $xml_h267->setAttribute("grp", $grp);
                                $xml_h267->setAttribute("bul", $unidades_carga[$ie->Value("ca_idequipo")]['pz']);
                                $xml_h267->setAttribute("peso",$unidades_carga[$ie->Value("ca_idequipo")]['ps']);

                                // Se Crear el elemento item
                                $string = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs";
                                $string.= "	LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte)";
                                $string.= "	LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor)";
                                $string.= "	where rp.ca_consecutivo = '".$ic->Value("ca_consecutivo")."' and ca_idemail is not null order by ca_idemail DESC limit 1";

                                if (!$rp->Open("$string")) {    // Trae de la Tabla de la Reportes de Negocio �ltima version.
                                    echo "<script>alert(\"".addslashes($rp->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'inosea.php';</script>";
                                    exit;
                                }
                                $xml_item = $xml->createElement( "item" );
                                $item = 1;
                                $mercancia_peli = ($rp->Value("ca_mcia_peligrosa")=='t')?"S":"N";
                                $mercancia_desc = (strlen($dc->Value("ca_mercancia_desc"))!=0)?$dc->Value("ca_mercancia_desc"):$rp->Value("ca_mercancia_desc");
                                $mercancia_desc = utf8_encode(substr($mercancia_desc,0,200));
                                $xml_item->setAttribute("item", $item);
                                $xml_item->setAttribute("cemb", $rp->Value("ca_codembalaje"));
                                $xml_item->setAttribute("idg", $mercancia_desc);
                                $xml_item->setAttribute("mpel", $mercancia_peli);
                                $xml_h267->appendChild( $xml_item );
                                $xml_h167->appendChild( $xml_h267 );

                                $array_cont[] = str_replace("-","",$ie->Value("ca_idequipo"));
                                $ie->MoveNext();
                            }
                        }
                        // Se Crear el elemento contenedor
                        if ($dm->Value("ca_tipodocviaje") == 10) {
                            foreach($array_cont as $cont){
                                $xml_contenedor = $xml->createElement( "contenedor" );
                                $xml_contenedor->setAttribute("contp", $cont);
                                $xml_h167->appendChild( $xml_contenedor );
                            }
                        }
                    } else {
                        $grp++;
                        // Se Crear el elemento h267
                        $xml_h267 = $xml->createElement( "h267" );
                        $xml_h267->setAttribute("grp", $grp);
                        $xml_h267->setAttribute("bul", $ic->Value("ca_numpiezas"));
                        $xml_h267->setAttribute("peso",$ic->Value("ca_peso"));
                        $sub_ps+= $ic->Value("ca_peso");
                        $sub_pz+= $ic->Value("ca_numpiezas");
                        $sub_cn+= 1;

                        // Se Crear el elemento item
                        $string = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs";
                        $string.= "	LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte)";
                        $string.= "	LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor)";
                        $string.= "	where rp.ca_consecutivo = '".$ic->Value("ca_consecutivo")."' and ca_idemail is not null order by ca_idemail DESC limit 1";
                        if (!$rp->Open("$string")) {    // Trae de la Tabla de la Reportes de Negocio �ltima version.
                            echo "<script>alert(\"".addslashes($rp->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        $xml_item = $xml->createElement( "item" );
                        $item = 1;
                        $mercancia_peli = ($rp->Value("ca_mcia_peligrosa")=='t')?"S":"N";
                        $mercancia_desc = (strlen($dc->Value("ca_mercancia_desc"))!=0)?$dc->Value("ca_mercancia_desc"):$rp->Value("ca_mercancia_desc");
                        $mercancia_desc = utf8_encode(substr($mercancia_desc,0,200));
                        $xml_item->setAttribute("item", $item);
                        $xml_item->setAttribute("cemb", $rp->Value("ca_codembalaje"));
                        $xml_item->setAttribute("idg", $mercancia_desc);
                        $xml_item->setAttribute("mpel", $mercancia_peli);
                        $xml_h267->appendChild( $xml_item );

                        $xml_h167->appendChild( $xml_h267 );
                    }
                    $xml_h167->setAttribute("vpb", $sub_ps);
                    $xml_h167->setAttribute("nbul",$sub_pz);
                    $xml_h167->setAttribute("vol1",0);
                    $xml_h167->setAttribute("nreg",$sub_cn);
                    $xml_hijo->appendChild( $xml_h167 );

                    $xml_pal66->appendChild( $xml_hijo );
                    $ic->MoveNext();
                }


                if ( $dm->Value("ca_tipocarga") == 2 ) {
                // Se Crear los elementos h167
                    if (!$ie->Open("select * from vi_inoequipos_sea where ca_referencia = '".$id."'")) {    // Selecciona los Registros de la Tabala Equipos
                        echo "<script>alert(\"".addslashes($ie->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    $ie->MoveFirst();
                    while (!$ie->Eof() and !$ie->IsEmpty()) {
                    // Se Crear el elemento h167
                        $xml_h167 = $xml->createElement( "h167" );

                        if ($dm->Value("ca_iddocanterior") != "") {
                            $xml_h167->setAttribute("fa67", $dm->Value("ca_iddocanterior"));
                        }
                        $xml_h167->setAttribute("cont", $dm->Value("ca_tipocarga"));
                        if ( $dm->Value("ca_tipocarga") == 2 ) {
                            $xml_h167->setAttribute("tun", 2);
                            $xml_h167->setAttribute("idu", str_replace("-","",$ie->Value("ca_idequipo")));

                            $tam_equipo = (strpos($ie->Value("ca_concepto"),'High Cube') !== false)?2:(($ie->Value("ca_liminferior")==20)?1:(($ie->Value("ca_liminferior")==40)?3:4));
                            $xml_h167->setAttribute("tam", $tam_equipo);
                            $tip_equipo = (strpos($ie->Value("ca_concepto"),'Flat Rack') !== false)?2:((strpos($ie->Value("ca_concepto"),'Open Top') !== false)?3:((strpos($ie->Value("ca_concepto"),'Collapsible') !== false)?4:((strpos($ie->Value("ca_concepto"),'Platform') !== false)?5:((strpos($ie->Value("ca_concepto"),'Tank') !== false)?6:((strpos($ie->Value("ca_concepto"),'Reefer') !== false)?8:1)))));
                            $xml_h167->setAttribute("teq", $tip_equipo);
                            $xml_h167->setAttribute("npr", $ie->Value("ca_numprecinto"));
                        }

                        $grp = 0;
                        $unidades_carga = array();
                        // Se Crear el elemento h267
                        $ic->MoveFirst();
                        while (!$ic->Eof() and !$ic->IsEmpty()) {
                            if (!$dc->Open("select * from tb_dianclientes where ca_idinfodian = ".$dm->Value("ca_idinfodian")." and ca_referencia = '".$ic->Value("ca_referencia")."' and ca_idcliente = '".$ic->Value("ca_idcliente")."' and ca_house = '".$ic->Value("ca_hbls")."'")) {    // Trae de la Tabla de la Dian Clientes.
                                echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                                echo "<script>document.location.href = 'inosea.php';</script>";
                                exit;
                            }
                            $contenedores = explode("|",$ic->Value("ca_contenedores"));
                            foreach($contenedores as $cargas) {
                                $carga = explode(";",$cargas);
                                $unidades_carga[$carga[0]]['pz']+= $carga[1];
                                $unidades_carga[$carga[0]]['ps']+= round($carga[2],2);
                                $unidades_carga[$carga[0]]['cn']+= 1;
                                if ($ie->Value("ca_idequipo") == $carga[0]) {
                                    $grp++;
                                    $xml_h267 = $xml->createElement( "h267" );
                                    $xml_h267->setAttribute("grp", $grp);
                                    $xml_h267->setAttribute("bul", $carga[1]);
                                    $xml_h267->setAttribute("peso", round($carga[2],2));
                                    $xml_h167->appendChild( $xml_h267 );
                                    // Se Crear el elemento item
                                    $string = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs";
                                    $string.= "	LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte)";
                                    $string.= "	LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor)";
                                    $string.= "	where rp.ca_consecutivo = '".$ic->Value("ca_consecutivo")."' and ca_idemail is not null order by ca_idemail DESC limit 1";
                                    if (!$rp->Open("$string")) {    // Trae de la Tabla de la Reportes de Negocio �ltima version.
                                        echo "<script>alert(\"".addslashes($rp->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                                        echo "<script>document.location.href = 'inosea.php';</script>";
                                        exit;
                                    }
                                    $xml_item = $xml->createElement( "item" );
                                    $item = 1;
                                    $mercancia_peli = ($rp->Value("ca_mcia_peligrosa")=='t')?"S":"N";
                                    $mercancia_desc = (strlen($dc->Value("ca_mercancia_desc"))!=0)?$dc->Value("ca_mercancia_desc"):$rp->Value("ca_mercancia_desc");
                                    $mercancia_desc = utf8_encode(substr($mercancia_desc,0,200));
                                    $xml_item->setAttribute("item", $item);
                                    $xml_item->setAttribute("cemb", $rp->Value("ca_codembalaje"));
                                    $xml_item->setAttribute("idg", $mercancia_desc);
                                    $xml_item->setAttribute("mpel", $mercancia_peli);
                                    $xml_h267->appendChild( $xml_item );
                                }
                            }
                            $ic->MoveNext();
                        }

                        $xml_h167->setAttribute("vpb", $unidades_carga[$ie->Value("ca_idequipo")]['ps']);
                        $xml_h167->setAttribute("nbul",$unidades_carga[$ie->Value("ca_idequipo")]['pz']);
                        $xml_h167->setAttribute("nreg",$unidades_carga[$ie->Value("ca_idequipo")]['cn']);

                        $xml_pal66->appendChild( $xml_h167 );
                        $ie->MoveNext();
                    }
                } else {
                // Se Crear el elemento h167
                    $xml_h167 = $xml->createElement( "h167" );
                    $xml_h167->setAttribute("cont", $dm->Value("ca_tipocarga"));
                    $ic->MoveFirst();
                    $grp = 0;
                    $sub_ps = 0;
                    $sub_pz = 0;
                    $sub_cn = 0;
                    while (!$ic->Eof() and !$ic->IsEmpty()) {
                        $grp++;
                        if (!$dc->Open("select * from tb_dianclientes where ca_idinfodian = ".$dm->Value("ca_idinfodian")." and ca_referencia = '".$ic->Value("ca_referencia")."' and ca_idcliente = '".$ic->Value("ca_idcliente")."' and ca_house = '".$ic->Value("ca_hbls")."'")) {    // Trae de la Tabla de la Dian Clientes.
                            echo "<script>alert(\"".addslashes($dm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        // Se Crear el elemento h267
                        $xml_h267 = $xml->createElement( "h267" );
                        $xml_h267->setAttribute("grp", $grp);
                        $xml_h267->setAttribute("bul", $ic->Value("ca_numpiezas"));
                        $xml_h267->setAttribute("peso",$ic->Value("ca_peso"));
                        $sub_ps+= $ic->Value("ca_peso");
                        $sub_pz+= $ic->Value("ca_numpiezas");
                        $sub_cn+= 1;

                        // Se Crear el elemento item
                        $string = "select (string_to_array(ca_piezas,'|'))[2] as ca_embalaje, ca_mercancia_desc, ca_mcia_peligrosa, pr.ca_valor2 as ca_codembalaje from tb_repstatus rs";
                        $string.= "	LEFT OUTER JOIN tb_reportes rp ON (rp.ca_fchanulado is null and rs.ca_idreporte = rp.ca_idreporte)";
                        $string.= "	LEFT OUTER JOIN tb_parametros pr ON (pr.ca_casouso = 'CU047' and (string_to_array(ca_piezas,'|'))[2] = pr.ca_valor)";
                        $string.= "	where rp.ca_consecutivo = '".$ic->Value("ca_consecutivo")."' and ca_idemail is not null order by ca_idemail DESC limit 1";
                        if (!$rp->Open("$string")) {    // Trae de la Tabla de la Reportes de Negocio �ltima version.
                            echo "<script>alert(\"".addslashes($rp->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                        $xml_item = $xml->createElement( "item" );
                        $item = 1;
                        $mercancia_peli = ($rp->Value("ca_mcia_peligrosa")=='t')?"S":"N";
                        $mercancia_desc = (strlen($dc->Value("ca_mercancia_desc"))!=0)?$dc->Value("ca_mercancia_desc"):$rp->Value("ca_mercancia_desc");
                        $mercancia_desc = utf8_encode(substr($mercancia_desc,0,200));
                        $xml_item->setAttribute("item", $item);
                        $xml_item->setAttribute("cemb", $rp->Value("ca_codembalaje"));
                        $xml_item->setAttribute("idg", $mercancia_desc);
                        $xml_item->setAttribute("mpel", $mercancia_peli);
                        $xml_h267->appendChild( $xml_item );

                        $xml_h167->appendChild( $xml_h267 );
                        $ic->MoveNext();
                    }

                    $xml_h167->setAttribute("vpb", $sub_ps);
                    $xml_h167->setAttribute("nbul",$sub_pz);
                    $xml_h167->setAttribute("nreg",$sub_cn);

                    $xml_pal66->appendChild( $xml_h167 );
                }

                $xml_pal66->setAttribute("cmon", $vlrfob);		    // Valor FOB USD
                $xml_pal66->setAttribute("vfle", $vlrflete);		// Valor Fletes USD
                $xml_pal66->setAttribute("ntb", $ntb);
                $xml_pal66->setAttribute("tpb", $tpb);

                $tm =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
                if (!$tm->Open("select ca_idtrafico, ca_idciudad from vi_ciudades where ca_idciudad = '".$rs->Value("ca_origen")."'")) {    // Trae informaci�n de la Ciudad y Tr�fico de Origen
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                $xml_pal66->setAttribute("pemb", substr($tm->Value("ca_idtrafico"),0,2));
                $xml_pal66->setAttribute("lemb", substr($tm->Value("ca_idtrafico"),0,2).substr($tm->Value("ca_idciudad"),0,3));
                $xml_pal66->setAttribute("cpt", $dm->Value("ca_codconcepto"));

                if (!$tm->Open("update tb_dianmaestra set ca_iddocactual = '$iddocactual', ca_vlrtotal = $ValorTotal, ca_cantreg = $CantReg where ca_idinfodian = ".$dm->Value("ca_idinfodian"))) {    // Actualizar la Fecha y Hora de Envio
                    echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";     // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }

                // Sub Elementos del Cab
                $xml_Ano = $xml->createElement("Ano", substr($dm->Value("ca_fchtrans"),0,4));
                $xml_CodCpt = $xml->createElement("CodCpt", $dm->Value("ca_codconcepto"));
                $xml_Formato = $xml->createElement("Formato", "1166");
                $xml_Version = $xml->createElement("Version", "7");
                $xml_FecEnvio = $xml->createElement("FecEnvio", date("Y-m-d", $FecEnvio)."T".date("H:i:s", $FecEnvio));
                $xml_FecInicial = $xml->createElement("FecInicial", $dm->Value("ca_fchinicial"));
                $xml_FecFinal = $xml->createElement("FecFinal", $dm->Value("ca_fchfinal"));
                $xml_ValorTotal = $xml->createElement("ValorTotal", $ValorTotal);
                $xml_CantReg = $xml->createElement("CantReg", $CantReg);

                // Adiciona Elementos a Cab
                $xml_cab->appendChild( $xml_Ano );
                $xml_cab->appendChild( $xml_CodCpt );
                $xml_cab->appendChild( $xml_Formato );
                $xml_cab->appendChild( $xml_Version );
                $xml_cab->appendChild( $xml_NumEnvio );
                $xml_cab->appendChild( $xml_FecEnvio );
                $xml_cab->appendChild( $xml_FecInicial );
                $xml_cab->appendChild( $xml_FecFinal );
                $xml_cab->appendChild( $xml_ValorTotal );
                $xml_cab->appendChild( $xml_CantReg );

                $xml_mas->appendChild( $xml_cab );
                $xml_mas->appendChild( $xml_pal66 );
                $xml->appendChild( $xml_mas );

                // Valida contra el Esquema
                if (!$xml->schemaValidate('./xsd/1166.xsd')) {
                    $errors = libxml_get_errors();
                    foreach ($errors as $error) {
                        echo display_xml_error($error, $xml);
                    }
                // print $xml->saveXML();
                // libxml_display_errors();
                // print '<b>La Generaci�n del XML no ha pasado la primera prueba. A continuaci�n se listan los errores.</b>';
                }

                // Parse the XML.
                // "Dmuisca_".$xml_CodCpt;
                $filename = "Dmuisca_".substr($xml_CodCpt->nodeValue+100,1,2).substr($xml_Formato->nodeValue+100000,1,5).substr($xml_Version->nodeValue+100,1,2).$xml_Ano->nodeValue.substr($xml_NumEnvio->nodeValue+100000000,1,8).".xml";
                header( "content-disposition: attachment; filename=".$filename);
                print $xml->saveXML();
                break;
            }
    }
}
elseif (isset($accion)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($accion)) {                                                    // Switch que evalua cual bot�n de comando fue pulsado por el usuario
        case 'Guardar Contrato': {                                             // El Bot�n Guardar fue pulsado
                if (!$rs->Open("select ca_referencia from tb_inocontratos_sea where ca_referencia = '$referencia' and ca_idequipo = '$idequipo'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
                if (strlen($inspeccion_fch)!=0) {
                    if (!$rs->Eof()) {
                        if (!$rs->Open("update tb_inocontratos_sea set ca_idcontrato = '$idcontrato', ca_fchcontrato = '$fchcontrato', ca_inspeccion_nta = '$inspeccion_nta', ca_inspeccion_fch = '$inspeccion_fch', ca_observaciones = '$observaciones', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_referencia = '$referencia' and ca_idequipo = '$idequipo'")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'clientes.php';</script>";
                            exit;
                        }
                    }else {
                        if (!$rs->Open("insert into tb_inocontratos_sea (ca_referencia, ca_idequipo, ca_idcontrato, ca_fchcontrato, ca_inspeccion_nta, ca_inspeccion_fch, ca_observaciones, ca_fchcreado, ca_usucreado) values('$referencia', '$idequipo', '$idcontrato', '$fchcontrato', '$inspeccion_nta', '$inspeccion_fch', '$observaciones', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'clientes.php';</script>";
                            exit;
                        }
                    }
                }else {
                    if (!$rs->Eof()) {
                        if (!$rs->Open("update tb_inocontratos_sea set ca_idcontrato = '$idcontrato', ca_fchcontrato = '$fchcontrato', ca_observaciones = '$observaciones', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_referencia = '$referencia' and ca_idequipo = '$idequipo'")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'clientes.php';</script>";
                            exit;
                        }
                    }else {
                        if (!$rs->Open("insert into tb_inocontratos_sea (ca_referencia, ca_idequipo, ca_idcontrato, ca_fchcontrato, ca_observaciones, ca_fchcreado, ca_usucreado) values('$referencia', '$idequipo', '$idcontrato', '$fchcontrato', '$observaciones', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'clientes.php';</script>";
                            exit;
                        }
                    }
                }
                if (!$rs->Open("update tb_inomaestra_sea set ca_sitiodevolucion = '$sitiodevolucion' where ca_referencia = '$referencia'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                break;
            }
        case 'Registrar': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("insert into tb_inoauditor_sea (ca_referencia, ca_fchevento, ca_tipo, ca_asunto, ca_detalle, ca_compromisos, ca_fchcompromiso, ca_idantecedente, ca_usuario) values('$referencia', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$tipo', '".addslashes($asunto)."', '".addslashes($detalle)."', '".addslashes($compromisos)."', '$fchcompromiso', '$idantecedente', '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
                break;
            }
        case 'Modificar Evento': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("update tb_inoauditor_sea set ca_tipo = '$tipo', ca_asunto = '".addslashes($asunto)."', ca_detalle = '".addslashes($detalle)."', ca_compromisos = '".addslashes($compromisos)."', ca_fchcompromiso = '$fchcompromiso', ca_idantecedente = '$idantecedente' where oid = $oid")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
                break;
            }
        case 'Eliminar Evento': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("delete from tb_inoauditor_sea where oid = $oid")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
                break;
            }
        case 'Guardar': {                                                      // El Bot�n Guardar fue pulsado
                $referencia = isset($referencia)?implode(".",$referencia):"";
                $mes = $mes.'-'.substr($ano,3,1);
                $departamento = ($impoexpo != 'OTM/DTA')?'Mar�timo':'Terrestre';
                $origen  = ($impoexpo != 'OTM/DTA')?$idtraorigen:$idciuorigen;
                $idlinea = ($impoexpo != 'OTM/DTA')?$idlinea:0;
                $mbls = strtoupper(implode("|",$mbls));
                $ciclo = (!isset($ciclo))?'-':strtoupper($ciclo[0]."-".$ciclo[1]);
                if (!$rs->Open("select fun_referencia('$departamento','$modalidad','$origen','$idciudestino','$mes')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'clientes.php';</script>";
                    exit;
                }
                $referencia = $rs->Value('fun_referencia');
                if (!$rs->Open("insert into tb_inomaestra_sea (ca_fchreferencia, ca_referencia, ca_impoexpo, ca_origen, ca_destino, ca_fchembarque, ca_fcharribo, ca_modalidad, ca_idlinea, ca_motonave, ca_ciclo, ca_mbls, ca_observaciones, ca_fchcreado, ca_usucreado, ca_provisional) values('$fchreferencia', '$referencia', '$impoexpo', '$idciuorigen', '$idciudestino', '$fchembarque', '$fcharribo', '$modalidad', $idlinea, '$motonave', '$ciclo', '$mbls', '".addslashes($observaciones)."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario', 'FALSE')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                for ($i=0; $i < count($inoequipos_sea); $i++) {
                    $inoequipos_sea[$i]['cantidad'] = ($inoequipos_sea[$i]['cantidad']==0)?1:$inoequipos_sea[$i]['cantidad'];
                    $inoequipos_sea[$i]['idequipo_1'] = (strlen($inoequipos_sea[$i]['idequipo_1'])==0)?'*':strtoupper($inoequipos_sea[$i]['idequipo_1']);
                    $inoequipos_sea[$i]['idequipo_2'] = (strlen($inoequipos_sea[$i]['idequipo_2'])==0)?'*':strtoupper($inoequipos_sea[$i]['idequipo_2']);
                    $inoequipos_sea[$i]['numprecinto'] = strtoupper($inoequipos_sea[$i]['numprecinto'] );
                    if ($inoequipos_sea[$i]['cantidad'] != 0 and $inoequipos_sea[$i]['idconcepto'] != 'NULL') {
                        $idequipo = strtoupper($inoequipos_sea[$i]['idequipo_1']."-".$inoequipos_sea[$i]['idequipo_2']);
                        if (!$rs->Open("insert into tb_inoequipos_sea (ca_referencia, ca_idconcepto, ca_cantidad, ca_idequipo, ca_numprecinto, ca_observaciones, ca_fchcreado, ca_usucreado) values('$referencia', ".$inoequipos_sea[$i]['idconcepto'].", ".$inoequipos_sea[$i]['cantidad'].", '$idequipo', '".$inoequipos_sea[$i]['numprecinto']."', '".$inoequipos_sea[$i]['observaciones']."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Actualizar': {                                                   // El Bot�n Actualizar fue pulsado
                $ciclo = strtoupper($ciclo[0]."-".$ciclo[1]);
                $mbls = strtoupper(implode("|",$mbls));
                if (!$rs->Open("update tb_inomaestra_sea set ca_fchreferencia = '$fchreferencia', ca_impoexpo = '$impoexpo', ca_origen = '$idciuorigen', ca_destino = '$idciudestino', ca_fchembarque = '$fchembarque', ca_fcharribo = '$fcharribo', ca_modalidad = '$modalidad', ca_idlinea = $idlinea, ca_motonave = '$motonave', ca_ciclo = '$ciclo', ca_mbls = '$mbls', ca_observaciones = '".addslashes($observaciones)."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                for ($i=0; $i < count($inoequipos_sea); $i++) {
                    $inoequipos_sea[$i]['cantidad'] = ($inoequipos_sea[$i]['cantidad']==0)?1:$inoequipos_sea[$i]['cantidad'];
                    $inoequipos_sea[$i]['idequipo_1'] = (strlen($inoequipos_sea[$i]['idequipo_1'])==0)?'*':strtoupper($inoequipos_sea[$i]['idequipo_1']);
                    $inoequipos_sea[$i]['idequipo_2'] = (strlen($inoequipos_sea[$i]['idequipo_2'])==0)?'*':strtoupper($inoequipos_sea[$i]['idequipo_2']);
                    $inoequipos_sea[$i]['numprecinto'] = strtoupper($inoequipos_sea[$i]['numprecinto'] );
                    if ($inoequipos_sea[$i]['idconcepto'] == 'NULL') {
                        continue;
                    }
                    elseif ($inoequipos_sea[$i]['oid'] != 0 and $inoequipos_sea[$i]['cantidad'] != 0) {
                        $idequipo = strtoupper($inoequipos_sea[$i]['idequipo_1']."-".$inoequipos_sea[$i]['idequipo_2']);
                        if (!$rs->Open("update tb_inoequipos_sea set ca_idconcepto = ".$inoequipos_sea[$i]['idconcepto'].", ca_cantidad = ".$inoequipos_sea[$i]['cantidad'].", ca_idequipo = '$idequipo', ca_numprecinto = '".$inoequipos_sea[$i]['numprecinto']."', ca_observaciones = '".$inoequipos_sea[$i]['observaciones']."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$inoequipos_sea[$i]['oid'])) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                            exit;
                        }
                    }
                    elseif ($inoequipos_sea[$i]['oid'] != 0 and $inoequipos_sea[$i]['cantidad'] == 0) {
                        if (!$rs->Open("delete from tb_inocontratos_sea where oid in (select c.oid from tb_inocontratos_sea c, tb_inoequipos_sea e where c.ca_referencia = e.ca_referencia and c.ca_idequipo = e.ca_idequipo and e.oid = ".$inoequipos_sea[$i]['oid'].")")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                            exit;
                        }
                        if (!$rs->Open("delete from tb_inoequipos_sea where oid = ".$inoequipos_sea[$i]['oid'])) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                            exit;
                        }
                    }
                    elseif ($inoequipos_sea[$i]['oid'] == 0 and $inoequipos_sea[$i]['cantidad'] != 0) {
                        $idequipo = strtoupper($inoequipos_sea[$i]['idequipo_1']."-".$inoequipos_sea[$i]['idequipo_2']);
                        if (!$rs->Open("insert into tb_inoequipos_sea (ca_referencia, ca_idconcepto, ca_cantidad, ca_idequipo, ca_numprecinto, ca_observaciones, ca_fchcreado, ca_usucreado) values('$id', ".$inoequipos_sea[$i]['idconcepto'].", ".$inoequipos_sea[$i]['cantidad'].", '$idequipo', '".$inoequipos_sea[$i]['numprecinto']."', '".$inoequipos_sea[$i]['observaciones']."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Grabar Encabezado': {                                                      // El Bot�n Grabar Encabezado fue pulsado
                $idtransportista = ($idtransportista=='')?'NULL':$idtransportista;
                if ($idinfodian == '') {
                    $iddocactual = '';
                    if (!$rs->Open("insert into tb_dianmaestra (ca_referencia, ca_codconcepto, ca_fchtrans, ca_iddocactual, ca_iddocanterior, ca_tipodocviaje, ca_codadministracion, ca_dispocarga, ca_coddeposito, ca_idtransportista, ca_fchinicial, ca_fchfinal, ca_iddoctrasbordo, ca_idcondiciones, ca_responsabilidad, ca_tiponegociacion, ca_tipocarga, ca_precursores, ca_fchcreado, ca_usucreado) values ('$id', '$codconcepto', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$iddocactual', '$iddocanterior', '$tipodocviaje', '$codadministracion', '$dispocarga', '$coddeposito', $idtransportista, '$fchinicial', '$fchfinal', '$iddoctrasbordo', '$idcondiciones', '".substr($responsabilidad,0,1)."', '$tiponegociacion', '$tipocarga', '".substr($precursores,0,1)."', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                        exit;
                    }
                } else {
                    if (!$rs->Open("update tb_dianmaestra set ca_codconcepto = '$codconcepto', ca_fchtrans = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_iddocanterior = '$iddocanterior', ca_tipodocviaje = '$tipodocviaje', ca_codadministracion = '$codadministracion', ca_dispocarga = '$dispocarga', ca_coddeposito = '$coddeposito', ca_idtransportista = $idtransportista, ca_fchinicial = '$fchinicial', ca_fchfinal = '$fchfinal', ca_iddoctrasbordo = '$iddoctrasbordo', ca_idcondiciones = '$idcondiciones', ca_responsabilidad = '".substr($responsabilidad,0,1)."', ca_tiponegociacion = '$tiponegociacion', ca_tipocarga = '$tipocarga', ca_precursores = '".substr($precursores,0,1)."', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idinfodian = '$idinfodian'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php?id=$id';</script>";
                        exit;
                    }
                }
                break;
            }
        case 'Grabar Cliente': {                                                      // El Bot�n Grabar Encabezado fue pulsado
                $iddestino = ($iddestino=='')?'null':"'$iddestino'";
                if ($idinfodian == '') {
                    if (!$rs->Open("select max(ca_idinfodian) as ca_idinfodian from tb_dianmaestra where ca_referencia = '$referencia'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php?id=$referencia';</script>";
                        exit;
                    }
                    $idinfodian = $rs->Value("ca_idinfodian");
                    if ($idinfodian == '') {
                        echo "<script>alert(\"�No se encuentran datos de cabecera, de informaci�n para la Dian!\");</script>";  // Muestra el mensaje de error
                        exit;
                    }
                    if (!$rs->Open("insert into tb_dianclientes (ca_idinfodian, ca_referencia, ca_idcliente, ca_house, ca_dispocarga, ca_coddeposito, ca_tipodocviaje, ca_idcondiciones, ca_responsabilidad, ca_tiponegociacion, ca_tipocarga, ca_precursores, ca_vlrfob, ca_vlrflete, ca_mercancia_desc, ca_iddestino, ca_fchcreado, ca_usucreado) values ('$idinfodian', '$referencia', '$idcliente', '$house', '$dispocarga', '$coddeposito', '$tipodocviaje', '$idcondiciones', '".substr($responsabilidad,0,1)."', '$tiponegociacion', '$tipocarga', '".substr($precursores,0,1)."', '$vlrfob', '$vlrflete', '$mercancia_desc', $iddestino, to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php?id=$referencia';</script>";
                        exit;
                    }
                } else {
                    if (!$rs->Open("update tb_dianclientes set ca_idinfodian = '$idinfodian', ca_referencia = '$referencia', ca_idcliente = '$idcliente', ca_house = '$house', ca_dispocarga = '$dispocarga', ca_coddeposito = '$coddeposito', ca_tipodocviaje = '$tipodocviaje', ca_idcondiciones = '$idcondiciones', ca_responsabilidad = '".substr($responsabilidad,0,1)."', ca_tiponegociacion = '$tiponegociacion', ca_tipocarga = '$tipocarga', ca_precursores = '".substr($precursores,0,1)."', ca_vlrfob = '$vlrfob', ca_vlrflete = '$vlrflete', ca_mercancia_desc = '$mercancia_desc', ca_iddestino = $iddestino, ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where ca_idinfodian = '$idinfodian' and ca_referencia = '$referencia' and ca_idcliente = '$idcliente' and ca_house = '$house'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php?id=$referencia';</script>";
                        exit;
                    }
                }
                break;
            }
        case 'Abrir': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("update tb_inomaestra_sea set ca_usucerrado = null, ca_usuoperacion = '$usuario', ca_fchcerrado = null, ca_provisional = false where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea_abrir.php';</script>";
                    exit;
                }
                break;
            }
        case 'Cerrar Caso': {                                                // El Bot�n Firmar Liquidaci�n fue pulsado
                $provisional = (isset($provisional))?"true":"false";
                if (!$rs->Open("select i.ca_usuliquidado from vi_inomaestra_sea i where i.ca_referencia = '$referencia'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }else if ($rs->Value('ca_usuliquidado') == '') {
                        echo "<script>alert(\"No puede Cerrar el caso si no ha sido firmado como liquidado\");</script>";  // Muestra el mensaje de error
                    }else if (!$rs->Open("update tb_inomaestra_sea set ca_fchcerrado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usucerrado = '$usuario', ca_usuoperacion = '$usuario', ca_provisional = $provisional where ca_referencia = '$referencia'")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                break;
            }
        case 'Eliminar': {                                                     // El Bot�n Eliminar fue pulsado
                if (!$rs->Open("delete from tb_inocostos_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inoingresos_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inoclientes_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inoequipos_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inomaestra_sea where ca_referencia = '$id'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                break;
            }
        case 'Guardar Cliente': {                                                      // El Bot�n Guardar fue pulsado
                $idreporte = (strlen($idreporte)==0)?'null':$idreporte;
                settype($idproveedor,"integer");
                settype($numpiezas,"double");
                settype($peso,"double");
                settype($volumen,"double");
                settype($idbodega,"integer");
                $cadena = "";
                foreach($contenedores as $contenedor) {
                    $cadena.= implode(";",$contenedor)."|";
                }
                $contenedores = substr($cadena,0,strlen($cadena)-1);
                if (!$rs->Open("insert into tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_idreporte, ca_hbls, ca_fchhbls, ca_idproveedor, ca_proveedor, ca_numpiezas, ca_peso, ca_volumen, ca_numorden, ca_login, ca_continuacion, ca_continuacion_dest, ca_idbodega, ca_observaciones, ca_contenedores, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, $idreporte, '$hbls', '$fchhbls', $idproveedor, '$proveedor', $numpiezas, $peso, $volumen, '$numorden', '$login', '$continuacion', '$continuacion_dest', '$idbodega', '', '$contenedores', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                while (list ($clave, $val) = each ($facturacion)) {
                    if ($val[valor] != 0) {
                        if (!$rs->Open("insert into tb_inoingresos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_fchfactura, ca_idmoneda, ca_neto, ca_valor, ca_reccaja, ca_observaciones, ca_tcambio, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, '$hbls', '$val[factura]', '$val[fchfactura]', '$val[moneda]', '$val[neto]', '$val[valor]', '', '$val[observacion]', '$val[tcambio]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }
                }
                while (list ($clave, $val) = each ($deducibles)) {
                    if (strlen($val[deduccion]) != 0) {
                        if (!$rs->Open("insert into tb_inodeduccion_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion, ca_neto, ca_valor, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, '$hbls', '$val[dedfactura]', '$val[iddeduccion]', $val[dedneto], $val[deduccion], to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Actualizar Cliente': {                                                      // El Bot�n Guardar fue pulsado
                $idreporte = (strlen($idreporte)==0)?'NULL':$idreporte;
                settype($idproveedor,"integer");
                settype($numpiezas,"double");
                settype($peso,"double");
                settype($volumen,"double");
                settype($idbodega,"integer");
                $cadena = "";
                foreach($contenedores as $contenedor) {
                    $cadena.= implode(";",$contenedor)."|";
                }
                $contenedores = substr($cadena,0,strlen($cadena)-1);
                if ( $hbl != $hbls ) {
                    if (!$rs->Open("insert into tb_inoclientes_sea (ca_referencia, ca_idcliente, ca_idreporte, ca_hbls, ca_fchhbls, ca_idproveedor, ca_proveedor, ca_numpiezas, ca_peso, ca_volumen, ca_numorden, ca_login, ca_continuacion, ca_continuacion_dest, ca_idbodega, ca_observaciones, ca_contenedores, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, $idreporte, '$hbls', '$fchhbls', $idproveedor, '$proveedor', $numpiezas, $peso, $volumen, '$numorden', '$login', '$continuacion', '$continuacion_dest', '$idbodega', '', '$contenedores', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                }else {
                    if (!$rs->Open("update tb_inoclientes_sea set ca_idreporte = $idreporte, ca_idcliente = '$idcliente', ca_hbls = '$hbls', ca_fchhbls = '$fchhbls', ca_idproveedor = $idproveedor, ca_proveedor = '$proveedor', ca_numpiezas = $numpiezas, ca_peso = $peso, ca_volumen = $volumen, ca_numorden = '$numorden', ca_login = '$login', ca_continuacion = '$continuacion', ca_continuacion_dest = '$continuacion_dest', ca_idbodega = '$idbodega', ca_observaciones = '', ca_contenedores = '$contenedores', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = '$oid'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                }

                while (list ($clave, $val) = each ($facturacion)) {
                    if ($val[oid_fc] == '' and $val[valor] != 0) {
                        if (!$rs->Open("insert into tb_inoingresos_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_fchfactura, ca_idmoneda, ca_neto, ca_valor, ca_reccaja, ca_observaciones, ca_tcambio, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, '$hbls', '$val[factura]', '$val[fchfactura]', '$val[moneda]', '$val[neto]', '$val[valor]', '', '$val[observacion]', '$val[tcambio]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }else if ($val[oid_fc] != '' and $val[valor] != 0) {
                            if (!$rs->Open("update tb_inoingresos_sea set ca_hbls = '$hbls', ca_factura = '$val[factura]', ca_fchfactura = '$val[fchfactura]', ca_idmoneda = '$val[moneda]', ca_neto = '$val[neto]', ca_valor = '$val[valor]', ca_observaciones = '$val[observacion]', ca_tcambio = '$val[tcambio]', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[oid_fc])) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'inosea.php';</script>";
                                exit;
                            }
                        }else if ($val[oid_fc] != '' and $val[valor] == 0) {
                                if (!$rs->Open("delete from tb_inoingresos_sea where oid = ".$val[oid_fc])) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'inosea.php';</script>";
                                    exit;
                                }
                            }
                }
                while (list ($clave, $val) = each ($deducibles)) {
                    if ($val[oid] == '' and $val[deduccion] != 0) {
                        if (!$rs->Open("insert into tb_inodeduccion_sea (ca_referencia, ca_idcliente, ca_hbls, ca_factura, ca_iddeduccion, ca_neto, ca_valor, ca_fchcreado, ca_usucreado) values('$referencia', $idcliente, '$hbls', '$val[dedfactura]', '$val[iddeduccion]', $val[dedneto], $val[deduccion], to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }else if ($val[oid] != '' and $val[deduccion] != 0) {
                            if (!$rs->Open("update tb_inodeduccion_sea set ca_hbls = '$hbls', ca_factura = '$val[dedfactura]', ca_iddeduccion = '$val[iddeduccion]', ca_neto = $val[dedneto], ca_valor = '$val[deduccion]', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = ".$val[oid])) {
                                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                echo "<script>document.location.href = 'inosea.php';</script>";
                                exit;
                            }
                        }else if ($val[oid] != '' and $val[deduccion] == 0) {
                                if (!$rs->Open("delete from tb_inodeduccion_sea where oid = ".$val[oid])) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'inosea.php';</script>";
                                    exit;
                                }
                            }
                }

                if ( $hbl != $hbls ) {
                    if (!$rs->Open("update tb_inoutilidad_sea set ca_hbls = '$hbls' where ca_referencia = '$referencia' and ca_idcliente = '$idcliente' and ca_hbls = '$hbl'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("update tb_inocomisiones_sea set ca_hbls = '$hbls' where ca_referencia = '$referencia' and ca_idcliente = '$idcliente' and ca_hbls = '$hbl'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                    if (!$rs->Open("delete from tb_inoclientes_sea where oid = '$oid'")) {
                        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'inosea.php';</script>";
                        exit;
                    }
                }
                break;
            }
        case 'Eliminar Cliente': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("delete from tb_inoingresos_sea where ca_referencia = '$referencia' and ca_idcliente = $idcliente and ca_hbls = '$hbl'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inodeduccion_sea where ca_referencia = '$referencia' and ca_idcliente = $idcliente and ca_hbls = '$hbl'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inoutilidad_sea where ca_referencia = '$referencia' and ca_idcliente = $idcliente and ca_hbls = '$hbl'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inoclientes_sea where ca_referencia = '$referencia' and ca_idcliente = $idcliente and ca_hbls = '$hbl'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                break;
            }
        case 'Guardar Costo': {                                                      // El Bot�n Guardar fue pulsado
                settype($neto,"double");
                settype($venta,"double");
                if (!$rs->Open("insert into tb_inocostos_sea (ca_referencia, ca_idcosto, ca_factura, ca_fchfactura, ca_proveedor, ca_idmoneda, ca_tcambio, ca_neto, ca_venta, ca_login, ca_fchcreado, ca_usucreado) values('$referencia', $idcosto, '$factura', '$fchfactura', '$proveedor', '$idmoneda', $tcambio, $neto, $venta, '', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                for ($i=0; $i < count($utilidades); $i++) {
                    if ($utilidades[$i] != 0) {
                        if (!$rs->Open("insert into tb_inoutilidad_sea (ca_referencia, ca_idcliente, ca_hbls, ca_idcosto, ca_factura, ca_valor, ca_fchcreado, ca_usucreado) values('$referencia', $clientes[$i], '$hbls[$i]', $idcosto, '$factura', '$utilidades[$i]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Actualizar Costo': {                                                      // El Bot�n Guardar fue pulsado
                settype($neto,"double");
                settype($venta,"double");
                if (!$rs->Open("delete from tb_inoutilidad_sea where ca_referencia = '$referencia' and ca_idcosto = $idcosto and ca_factura = '$old_fact'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("update tb_inocostos_sea set ca_idcosto = $idcosto, ca_factura = '$factura', ca_fchfactura = '$fchfactura', ca_proveedor = '$proveedor', ca_idmoneda = '$idmoneda', ca_tcambio = $tcambio, ca_neto = $neto, ca_venta = $venta, ca_login = '$login', ca_fchactualizado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuactualizado = '$usuario' where oid = $oid")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                for ($i=0; $i < count($utilidades); $i++) {
                    if ($utilidades[$i] != 0) {
                        if (!$rs->Open("insert into tb_inoutilidad_sea (ca_referencia, ca_idcliente, ca_hbls, ca_idcosto, ca_factura, ca_valor, ca_fchcreado, ca_usucreado) values('$referencia', $clientes[$i], '$hbls[$i]', $idcosto, '$factura', '$utilidades[$i]', to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), '$usuario')")) {
                            echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                            echo "<script>document.location.href = 'inosea.php';</script>";
                            exit;
                        }
                    }
                }
                break;
            }
        case 'Firmar Liquidaci�n': {                                                // El Bot�n Firmar Liquidaci�n fue pulsado
                if (!$rs->Open("select i.ca_costoneto, i.ca_facturacion, i.ca_deduccion, i.ca_utilidad, i.ca_peso, i.ca_peso_cap, i.ca_volumen, i.ca_volumen_cap, e.ca_concepto from vi_inomaestra_sea i LEFT OUTER JOIN vi_inoequipos_sea e ON (i.ca_referencia = e.ca_referencia) where i.ca_referencia = '$referencia'")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if ($rs->Value('ca_costoneto') == 0) {
                    echo "<script>alert(\"No puede firmar un caso como liquidado, si no se tienen Facturas de Proveedores\");</script>";  // Muestra el mensaje de error
                //           }else if ($rs->Value('ca_facturacion') == 0) {
                //               echo "<script>alert(\"No puede firmar un caso como liquidado, si no se tienen Facturas de Clientes\");</script>";  // Muestra el mensaje de error
                }else if (($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad')) == 0) {
                        echo "<script>alert(\"No puede firmar un caso como liquidado, si la utilidad es igual a 0\");</script>";  // Muestra el mensaje de error
                    }else if ($rs->Value('ca_concepto') == '') {
                            echo "<script>alert(\"No puede firmar un caso como liquidado, si no se tienen Datos de la Carga\");</script>";  // Muestra el mensaje de error
                        }else if ($rs->Value('ca_peso') > $rs->Value('ca_peso_cap') or $rs->Value('ca_volumen') > $rs->Value('ca_volumen_cap')) {
                                echo "<script>alert(\"No puede firmar el caso ya que el volumen o peso registrado en los HBL's, supera la capacidad de carga de la guia Master\");</script>";  // Muestra el mensaje de error
                            }else if (!$rs->Open("update tb_inomaestra_sea set ca_fchliquidado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuliquidado = '$usuario' where ca_referencia = '$referencia'")) {
                                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                                    echo "<script>document.location.href = 'inosea.php';</script>";
                                    exit;
                                }
                break;
            }
        case 'Eliminar Costo': {                                                      // El Bot�n Guardar fue pulsado
                if (!$rs->Open("delete from tb_inoutilidad_sea where ca_factura = (select ca_factura from tb_inocostos_sea where oid = $oid)")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                if (!$rs->Open("delete from tb_inocostos_sea where oid = $oid")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'inosea.php';</script>";
                    exit;
                }
                break;
            }
    }
    if (isset($id)) {
        echo "<script>document.location.href = 'inosea.php?boton=Consultar\&id=$id';</script>";  // Retorna a la pantalla principal de la opci�n
    }elseif (isset($referencia)) {
        echo "<script>document.location.href = 'inosea.php?boton=Consultar\&id=$referencia';</script>";  // Retorna a la pantalla principal de la opci�n
    }else {
        echo "<script>document.location.href = 'inosea.php';</script>";  // Retorna a la pantalla principal de la opci�n
    }
}



function display_xml_error($error, $xml) {
    $return  = $xml[$error->line - 1] . "\n";
    $return .= str_repeat('-', $error->column) . "^\n";

    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "Warning $error->code: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "Error $error->code: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "Fatal Error $error->code: ";
            break;
    }

    $return .= trim($error->message) .
        "\n  Line: $error->line" .
        "\n  Column: $error->column";

    if ($error->file) {
        $return .= "\n  File: $error->file";
    }

    return "$return\n\n--------------------------------------------\n\n";
}

?>