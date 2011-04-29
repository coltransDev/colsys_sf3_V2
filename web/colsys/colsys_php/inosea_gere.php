<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       INOSEA_CONS.PHP                                             \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Módulo de mantenimiento a la tabla de grupos para tráfico.  \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Sistema Administrador de Referencias Marítimas';
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "Nombre Naviera"=>"ca_nombre", "Sigla Naviera"=>"ca_sigla", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls", "Nombre del Cliente"=>"ca_compania", "Reporte de Negocio"=>"ca_consecutivo", "Factura Cliente"=>"ca_factura", "N.i.t."=>"ca_idcliente", "Factura Proveedor"=>"ca_factura_prov", "Observaciones"=>"ca_observaciones");  // Arreglo con las opciones de busqueda
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                     // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
include_once 'include/functions.php';                                          // Funciones de Usuarios para PHP
require_once("checklogin.php"); // Captura las variables de la sessión abierta


$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='inosea_cons.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp;</TH>";
    echo "  <TD Class=listar ROWSPAN=2><B>Buscar por:</B><BR><SELECT NAME='opcion' SIZE=5>";
    while (list ($clave, $val) = each ($columnas)) {
        echo " <OPTION VALUE='".$val."'".(($val=='ca_referencia')?" SELECTED":"").">".$clave;
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar COLSPAN=3><B>Que contenga la cadena:</B><BR><INPUT TYPE='text' NAME='criterio' size='60'></TD>";
    echo "  <TH ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
    echo "  <TD Class=listar WIDTH=150></TD>";
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
    if (!$rs->Open("select DISTINCT ca_ano, ca_mes, ca_trafico, ca_modal, ca_referencia, ca_sigla, ca_nombre, ca_ciuorigen, ca_traorigen, ca_ciudestino, ca_tradestino, ca_fchembarque, ca_fcharribo, ca_motonave from vi_inoconsulta_sea $condicion order by ca_ano DESC, ca_mes, ca_trafico, ca_modal, ca_referencia")) {           // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'inosea_cons.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='inosea_cons.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>COLTRANS S.A.<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Linea</TH>";
    echo "<TH>&nbsp;</TH>";  // Botón para la creación de un Registro Nuevo
    $ano_mem = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if ($rs->Value('ca_ano') != $ano_mem) {
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=imprimir COLSPAN=3></TD>";
           echo "</TR>";
           echo "<TR>";
           echo "  <TD Class=titulo style='font-size: 11px; font-weight:bold;'>".($rs->Value('ca_ano'))."</TD>";
           echo "  <TD Class=titulo COLSPAN=2></TD>";
           echo "</TR>";
           $ano_mem = $rs->Value('ca_ano');
       }
       echo "<TR>";
       echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:document.location.href=\"inosea_cons.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\";'>".$rs->Value('ca_referencia')."</TD>";
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
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function elegir(opcion, id, cl, hb){";
             echo "    document.location.href = 'inosea.php?boton='+opcion+'\&id='+id+'\&cl='+cl+'\&hb='+hb;";
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
             echo "<FORM METHOD=post NAME='cabecera' ACTION='inosea.php'>";             // Hace una llamado nuevamente a este script pero con
             echo "<TABLE WIDTH=650 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
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
                if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {                      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
                    echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                $lg =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$lg->Open("select * from tb_inomaestralog_sea where ca_referencia = '".$rs->Value('ca_referencia')."' order by ca_fchactualizado DESC limit 5")) {                      // Selecciona todos lo registros del log de apertura y cierres de una referencia Ino-Marítimo
                    echo "<script>alert(\"".addslashes($lg->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE WIDTH=100% CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH COLSPAN=3>Contratos de Comodato</TH>";
				$arr_equ = array();
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=30 Class=listar>".$co->Value('ca_cantidad')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
					echo "  <TD WIDTH=90 Class=listar>".$co->Value('ca_idcontrato')." ".((strlen($co->Value('ca_observaciones_con')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones_con')."'>":"")."</TD>";
					echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_fchcontrato')."</TD>";
					echo "  <TD WIDTH=25 Class=listar>".((strlen($co->Value('ca_observaciones')))?"<IMG src='graficos/admira.gif' alt='".$co->Value('ca_observaciones')."'>":"")."</TD>";
                    echo "</TR>";
					if (!array_key_exists($co->Value('ca_concepto'),$arr_equ))
						array_merge($arr_equ, array($co->Value('ca_concepto') => 0));
					$arr_equ[$co->Value('ca_concepto')]+= $co->Value('ca_cantidad');
                    $co->MoveNext();
                    }
                echo "  <TR HEIGHT=5>";
                echo "    <TD Class=imprimir COLSPAN=6></TD>";
                echo "  </TR>";
				$sub_tit = "Cantidades Totales :";
				while (list ($clave, $val) = each ($arr_equ)) {
					echo "  <TR>";
					echo "    <TD Class=listar style='font-weight:bold;'>$sub_tit</TD>";
					echo "    <TD Class=listar style='font-weight:bold;'>".formatNumber($val,2)."</TD>";
					echo "    <TD Class=listar style='font-weight:bold;' COLSPAN=2>$clave</TD>";
					echo "    <TD Class=listar style='font-weight:bold;' COLSPAN=2></TD>";
					echo "  </TR>";
					$sub_tit = ""; }
				echo "  <TR>";
				echo "    <TD Class=listar>Sitio de Devolución:</TD>";
				echo "    <TD Class=listar COLSPAN=5>".$co->Value('ca_sitiodevolucion')."</TD>";
				echo "  </TR>";
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Tránsito:<BR>&nbsp;</TD>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Embarque:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fchembarque')."</TD>";
                echo "  <TD Class=listar style='font-weight:bold;'>Fecha Estim.Arribo:</TD>";
                echo "  <TD Class=listar>".$rs->Value('ca_fcharribo')."</TD>";
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
                echo "  <TD Class=listar><B>Facturación Clientes:</B></TD>";
                echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_facturacion'))."&nbsp;</TD>";
                echo "  <TD Class=listar ROWSPAN=9>&nbsp;</TD>";
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
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=4></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=invertir COLSPAN=2 ROWSPAN=4 style='vertical-align:bottom;'><TABLE WIDTH=100% CELLSPACING=1></TD>";
				echo "		<TR>";
				echo "  		<TH style='font-size:8px;'>Acción</TD>";
				echo "  		<TH style='font-size:8px;'>Usuario</TD>";
				echo "  		<TH style='font-size:8px;'>Fecha</TD>";
				echo "		</TR>";
                while (!$lg->Eof() and !$lg->IsEmpty()) {
					echo "<TR>";
					echo "  <TD Class=listar style='font-size:8px;'><B>".((strlen($lg->Value('ca_usucerrado'))==0)?"Cerró":"Abrió")."</B></TD>";
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
                echo "  <TD Class=partir>Auditoría:</TD>";
                echo "  <TD Class=listar><B>Creación:</B>&nbsp;".$rs->Value('ca_usucreado')."<BR>".$rs->Value('ca_fchcreado')."</TD>";
                echo "  <TD Class=listar><B>Actualización:</B>&nbsp;".$rs->Value('ca_usuactualizado')."<BR>".$rs->Value('ca_fchactualizado')."</TD>";
                echo "  <TD Class=listar><B>Liquidación:</B>&nbsp;".$rs->Value('ca_usuliquidado')."<BR>".$rs->Value('ca_fchliquidado')."</TD>";
                echo "  <TD Class=listar><B>Cierre:</B>&nbsp;".$rs->Value('ca_usucerrado')."<BR>".$rs->Value('ca_fchcerrado')."</TD>";
                echo "  <TD Class=listar style='font-weight:bold; text-align: center; vertical-align: middle;'><B>".(($rs->Value('ca_provisional')=="t")?"Cierre<br>Provisional":"")."</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6></TD>";
                echo "</TR>";
        
                echo "<TR>";
                echo "  <TD Class=imprimir COLSPAN=6>&nbsp;</TD>";
                echo "</TR>";
                echo "<TH Class=titulo COLSPAN=5>Cuadro de Clientes de la Referencia</TH>";
                echo "<TH></TH>";  // Botón para la creación de un Registro Nuevo
                $cli_mem = 0;
                $hbl_mem = 0;
                while (!$cl->Eof() and !$cl->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                   if( $cl->Value('ca_idcliente') != $cli_mem or $cl->Value('ca_hbls') != $hbl_mem){
                       echo "<TR HEIGHT=5>";
                       echo "  <TD Class=captura COLSPAN=6></TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar style='font-size: 11px; vertical-align:bottom'><B>Id Cliente:</B><BR>".number_format($cl->Value('ca_idcliente'))."</TD>";
                       echo "  <TD Class=listar style='font-size: 11px;' COLSPAN=4><B>Nombre del Cliente:</B><BR>".$cl->Value('ca_compania')."</TD>";
                       echo "  <TD ROWSPAN=3 WIDTH=80 Class=listar></TD>";                                             // Botones para hacer Mantenimiento a la Tabla
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
					   if ($cl->Value('ca_continuacion') != "N/A"){
						   echo "<TR>";
						   echo "  <TD Class=listar COLSPAN=2><B>Continua/Viaje: </B>".$cl->Value('ca_continuacion')."</TD>";
						   echo "  <TD Class=listar><B>Destino Final: </B>".$cl->Value('ca_ciudad_dest')."</TD>";
						   echo "  <TD Class=listar COLSPAN=2><B>Operador: </B>".$cl->Value('ca_bodega')."</TD>";
						   echo "  <TD Class=listar></TD>";
						   echo "</TR>";
					   }
                       if (strlen($cl->Value('ca_fchliberacion')) != 0){
                            echo "<TR>";
                            echo "  <TD Class=destacar><B>Fch.Liberación:</B><BR>".$cl->Value('ca_fchliberacion')."</TD>";
                            echo "  <TD Class=destacar COLSPAN=3><B>Anotaciones:</B><BR>".$cl->Value('ca_notaliberacion')."</TD>";
                            echo "  <TD Class=destacar COLSPAN=2><B>Liberó:</B>&nbsp;".$cl->Value('ca_usuliberado')."<BR>".$cl->Value('ca_fchliberado')."</TD>";
                            echo "</TR>";
                       }
                       $cli_mem = $cl->Value('ca_idcliente');
                       $hbl_mem = $cl->Value('ca_hbls');
                      }
                   echo "<TR>";
                   echo "  <TD Class=invertir><B>Factura Nro.:</B><BR>".$cl->Value('ca_factura')." <BR /><img src='graficos/image.gif' /><a href='colsys_sf/digitalFile/verReferencia?referencia=".$cl->Value('ca_referencia')."&factura=".$cl->Value('ca_factura')."'><strong>Imagen</strong></a> </TD>";
                   echo "  <TD Class=invertir><B>Dolares:</B><BR>".number_format($cl->Value('ca_neto'),2)."<BR><B>Tasa Cambio:</B><BR>".number_format($cl->Value('ca_tcambio'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Valor Factura:</B><BR>".number_format($cl->Value('ca_valor'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Deducciones:</B><BR>".number_format($cl->Value('ca_deduccion'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Fch.Factura:</B><BR>".$cl->Value('ca_fchfactura')."</TD>";
                   echo "  <TD Class=invertir><B>Rec.Caja:</B>".((strlen($cl->Value('ca_reccaja'))==0)?"<BR>":$cl->Value('ca_reccaja'))."<BR><B>Fch.Pago:</B>".$cl->Value('ca_fchpago')."</TD>";
                   echo "</TR>";
                   $con_mem = '';
                   $cl->MoveNext();
                  }
                $cs =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                if (!$cs->Open("select * from vi_inocostos_sea  where ca_referencia = '".$rs->Value('ca_referencia')."'")) {                        // Selecciona todos lo registros de la tabla de Costos de una referencia
                    echo "<script>alert(\"".addslashes($cs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "<TR>";
                echo "  <TD Class=imprimir COLSPAN=6>&nbsp;</TD>";
                echo "</TR>";
                echo "<TH Class=titulo COLSPAN=5>Cuadro de Costos de la Referencia</TH>";
                echo "<TH></TH>";  // Botón para la creación de un Registro Nuevo
                while (!$cs->Eof() and !$cs->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                   echo "<TR>";
                   echo "<TR HEIGHT=5>";
                   echo "  <TD Class=invertir COLSPAN=6></TD>";
                   echo "</TR>";
                   echo "  <TD Class=invertir style='font-size: 12px;' COLSPAN=2><B>".$cs->Value('ca_costo')."</B><BR></TD>";
                   echo "  <TD Class=listar><B>Factura:</B><BR>".$cs->Value('ca_factura')."</TD>";
                   echo "  <TD Class=listar COLSPAN=2><B>Proveedor:</B><BR>".$cs->Value('ca_proveedor')."</TD>";
                   echo "  <TD ROWSPAN=2 WIDTH=80 Class=listar></TD>";                                             // Botones para hacer Mantenimiento a la Tabla
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
             echo "</TABLE><BR>";
             echo "</TABLE><BR><BR>";
             $tm =& DlRecordset::NewRecordset($conn);
             if (!$tm->Open("select * from vi_inoauditor_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) { // Selecciona todos lo registros de la tabla Ciudades
                echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'inosea.php';</script>";
                exit; }
             echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
             echo "<TR>";
             echo "  <TH Class=titulo COLSPAN=6>Maestra de Registros de Auditoría</TH>";
             echo "</TR>";
             echo "<TH WIDTH=80>Fecha</TH>";
             echo "<TH>Tipo</TH>";
             echo "<TH WIDTH=300 COLSPAN=3>Asunto</TH>";
             echo "<TH><IMG src='./graficos/new.gif' alt='Crear un Nuevo Registro' border=0 onclick='elegir(\"Evento\", \"".$rs->Value('ca_referencia')."\");'></TH>";  // Botón para la creación de un Registro Nuevo
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
                if ($usuario == 'pizquierdo' or $usuario == 'Administrador') {
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
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Cerrar ' ONCLICK='javascript:window.close()'></TH>";  // Cancela la operación
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