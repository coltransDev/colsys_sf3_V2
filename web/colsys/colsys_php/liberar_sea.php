<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       LIBERAR_SEA.PHP                                             \\
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
$programa = 16;

$titulo = 'Sistema Administrador de Referencias Marítimas';
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls", "Nombre del Cliente"=>"ca_compania", "Factura Cliente"=>"ca_factura", "N.i.t."=>"ca_idcliente", "Factura Proveedor"=>"ca_factura_prov", "Observaciones"=>"ca_observaciones");  // Arreglo con las opciones de busqueda
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                      // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($criterio) and !isset($boton) and !isset($accion)){
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
    echo "<FORM METHOD=post NAME='menuform' ACTION='liberar_sea.php' >";
    echo "<TABLE WIDTH=450 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese un criterio para realizar las busqueda</TH>";
    echo "<TR>";
    echo "  <TH ROWSPAN=2>&nbsp</TH>";
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

    $condicion = "where ca_fchreferencia between '$fchinicial' and '$fchfinal' ";
    if (isset($criterio) and strlen(trim($criterio)) != 0) {
        if ($opcion == 'ca_referencia') {
            $condicion = "where $opcion like lower('%".$criterio."%')"; }
        elseif ($opcion == 'ca_mbls' or $opcion == 'ca_motonave') {
            $condicion.= "and lower($opcion) like lower('%".$criterio."%')"; }
        elseif ($opcion == 'ca_idequipo') {
            $condicion.= "and ca_referencia in (select ca_referencia from vi_inoequipos_sea where lower($opcion) like lower('%".$criterio."%') order by ca_referencia)"; }
        elseif ($opcion == 'ca_hbls' or $opcion == 'ca_idcliente' or $opcion == 'ca_compania' or $opcion == 'ca_factura') {
            $condicion.= "and ca_referencia in (select ca_referencia from vi_inoclientes_sea where lower($opcion) like lower('%".$criterio."%') order by ca_referencia)"; }
        elseif ($opcion == 'ca_factura_prov') {
            $condicion.= "and ca_referencia in (select ca_referencia from vi_inocostos_sea where lower(".substr($opcion,0,10).") like lower('%".$criterio."%') order by ca_referencia)"; }
       }
    // die("select * from vi_inomaestra_sea $condicion");
       $sql="select * from vi_inomaestra_sea $condicion";
    if (!$rs->Open($sql)) {
        echo "Error 94: $sql";
//        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
//        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id){";
    echo "    document.location.href = 'liberar_sea.php?boton='+opcion+'\&id='+id;";
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
    echo "<FORM METHOD=post NAME='cabecera' ACTION='liberar_sea.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=600 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Linea</TH>";
    echo "<TH>&nbsp</TH>";  // Botón para la creación de un Registro Nuevo
    $ano_mem = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
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
       echo "  <TD Class=listar ROWSPAN=2 style='font-weight:bold;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:elegir(\"Consultar\",\"".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
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
        case 'Consultar': { 
            $sql="select * from vi_inomaestra_sea where ca_referencia = '$id'";
             if (!$rs->Open($sql)) {
                 echo "Error 181: $sql";
                 //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function uno(src,color_entrada) {";
             echo "    src.style.background=color_entrada;src.style.cursor='hand'";
             echo "}";
             echo "function dos(src,color_default) {";
             echo "    src.style.background=color_default;src.style.cursor='default';";
             echo "}";
             echo "function dar_liberacion(id,oid){";
             echo "  ventana = document.getElementById('liberar_sea');";
             echo "  ventana.style.visibility = \"visible\";";
             echo "  ventana.style.left = eval((document.body.clientWidth/2)-(600/2));";
             echo "  ventana = document.getElementById('frame_liberar');";
             echo "  ventana.src='ventanas.php?opcion=Liberar&id='+id+'&oid='+oid;";
             echo "}";
             echo "</script>";
             echo "</HEAD>";
             echo "<BODY onscroll='dalt=document.body.scrollTop+3; liberar_sea.style.top=dalt;'>";
             echo "<DIV ID='liberar_sea' STYLE='visibility:hidden; position:absolute; border-width:1; border-color:#445599; border-style:solid;'>";  // left:150; top:25; width:600; height:200
             echo "<IFRAME ID=frame_liberar SRC='blanco.html' MARGINWIDTH=0 MARGINHEIGHT=0 FRAMEBORDER='NO' SCROLLING='YES' STYLE='width:600; height:200'>";
             echo "</IFRAME>";
             echo "</DIV>";
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='liberar_sea.php'>";        // Hace una llamado nuevamente a este script pero con
             echo "<TABLE WIDTH=620 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
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
                $sql="select * from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."'";
                if (!$co->Open($sql)) {
                    echo "Error 256: $sql";
                    //echo "<script>alert(\"".addslashes($co->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    //echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }

                $cl =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
                $sql="select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'";
                if (!$cl->Open($sql)) {
                    echo "Error 264: $sql";
                //    echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                //    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }
                echo "  <TABLE CELLSPACING=1 style='letter-spacing:-1px;'>";
                echo "  <TH>Concepto</TH>";
                echo "  <TH>Cantidad</TH>";
                echo "  <TH>Id Equipo</TH>";
                echo "  <TH>Observaciones</TH>";
                while (!$co->Eof() and !$co->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                    echo "<TR>";
                    echo "  <TD WIDTH=85 Class=listar>".$co->Value('ca_concepto')."</TD>";
                    echo "  <TD WIDTH=80 Class=listar>".$co->Value('ca_cantidad')."</TD>";
                    echo "  <TD WIDTH=100 Class=listar>".$co->Value('ca_idequipo')."</TD>";
                    echo "  <TD WIDTH=200 Class=listar>".$co->Value('ca_observaciones')."</TD>";
                    echo "</TR>";
                    $co->MoveNext();
                    }
                echo "  </TABLE>";
                echo "  </TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Tránsito:<BR>&nbsp</TD>";
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
                echo "  <TD Class=partir ROWSPAN=4>Balance:</TD>";
                echo "  <TD Class=listar><B>No.Total Piezas:</B></TD>";
                echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_numpiezas'))."&nbsp</TD>";
                echo "  <TD Class=listar COLSPAN=2 ROWSPAN=4>&nbsp</TD>";
                echo "  <TD Class=listar ROWSPAN=4>&nbsp</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar><B>Peso Total en Kilos:</B></TD>";
                echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_peso'),3)."&nbsp</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar><B>Volumen Total CBM:</B></TD>";
                echo "  <TD Class=listar style='text-align: right;'>".number_format($rs->Value('ca_volumen'),3)."&nbsp</TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=listar><B>Total Hbl's Registradas:</B></TD>";
                echo "  <TD Class=listar style='text-align: right;'>".$cl->Value('ca_nrohbls')."&nbsp</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=partir>Auditoría:</TD>";
                echo "  <TD Class=listar><B>Creación:</B>&nbsp".$rs->Value('ca_usucreado')."<BR>".$rs->Value('ca_fchcreado')."</TD>";
                echo "  <TD Class=listar><B>Actualización:</B>&nbsp".$rs->Value('ca_usuactualizado')."<BR>".$rs->Value('ca_fchactualizado')."</TD>";
                echo "  <TD Class=listar><B>Liquidación:</B>&nbsp".$rs->Value('ca_usuliquidado')."<BR>".$rs->Value('ca_fchliquidado')."</TD>";
                echo "  <TD Class=listar><B>Cierre:</B>&nbsp".$rs->Value('ca_usucerrado')."<BR>".$rs->Value('ca_fchcerrado')."</TD>";
                echo "  <TD Class=listar>&nbsp</TD>";
                echo "</TR>";
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=invertir COLSPAN=6></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=imprimir COLSPAN=6>&nbsp</TD>";
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
                       echo "  <TD Class=listar><B>Peso en Kilos:</B><BR>".number_format($cl->Value('ca_peso'),3)."</TD>";
                       echo "  <TD Class=listar><B>Volumen CMB:</B><BR>".number_format($cl->Value('ca_volumen'),3)."</TD>";
                       echo "</TR>";
                       echo "<TR>";
                       echo "  <TD Class=listar><B>ID Reporte:</B><BR>".$cl->Value('ca_idreporte')."</TD>";
                       echo "  <TD Class=listar><B>ID Proveedor:</B><BR>".$cl->Value('ca_idproveedor')."</TD>";
                       echo "  <TD Class=listar COLSPAN=3><B>Proveedor:</B><BR>".$cl->Value('ca_proveedor')."</TD>";
                       echo "</TR>";
                       echo "<TR HEIGHT=5>";
                       echo "  <TD Class=invertir COLSPAN=6></TD>";
                       echo "</TR>";
                       if (strlen($cl->Value('ca_fchliberacion')) != 0){
                            echo "<TR>";
                            echo "  <TD Class=destacar><B>Fch.Liberación:</B><BR>".$cl->Value('ca_fchliberacion')."</TD>";
                            echo "  <TD Class=destacar COLSPAN=3><B>Anotaciones:</B><BR>".$cl->Value('ca_notaliberacion')."</TD>";
                            echo "  <TD Class=destacar COLSPAN=2><B>Liberó:</B>&nbsp".$cl->Value('ca_usuliberado')."<BR>".$cl->Value('ca_fchliberado')."</TD>";
                            echo "</TR>";
                            $libero = true;
                            $mostrar = false;
                       }else if (strlen($cl->Value('ca_factura')) == 0){
                            $libero = false;
                            $mostrar = false; 
                       }else{
                            $libero = false;
                            $mostrar = true; 
                       }
                       $cli_mem = $cl->Value('ca_idcliente');
                       $hbl_mem = $cl->Value('ca_hbls');
                   }
                   echo "<TR>";
                   echo "  <TD Class=invertir><B>Factura Nro.:</B><BR>".$cl->Value('ca_factura')."</TD>";
                   echo "  <TD Class=invertir><B>Valor Factura:</B><BR>".number_format($cl->Value('ca_valor'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Deducciones:</B><BR>".number_format($cl->Value('ca_deduccion'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Tasa Cambio:</B><BR>".number_format($cl->Value('ca_tcambio'),2)."</TD>";
                   echo "  <TD Class=invertir><B>Fch.Factura:</B><BR>".$cl->Value('ca_fchfactura')."</TD>";
                   if ($mostrar and !$libero){
                        echo "  <TD Class=invertir style='text-align: center;' onMouseOver=\"uno(this,'969696');\" onMouseOut=\"dos(this,'D2D2D2');\" onclick='javascript:dar_liberacion(\"$id\", ".$cl->Value('ca_oid').");' style='color=blue;'><IMG src='graficos/si.gif'><BR>Liberar</TD>";
                        $mostrar = false;
                    }else if ($libero){
                        echo "  <TD Class=invertir><B>Rec.Caja:</B>".$cl->Value('ca_reccaja')."<BR>".$cl->Value('ca_fchpago')."</TD>";
                    }else{
                        echo "  <TD Class=invertir>&nbsp</TD>";
                    }
                   echo "</TR>";
                   $con_mem = '';
                   $cl->MoveNext();
                  }
                echo "<TR HEIGHT=5>";
                echo "  <TD Class=captura COLSPAN=6></TD>";
                echo "</TR>";
                $rs->MoveNext();
               }
             echo "</TABLE><BR><BR>";
             $tm =& DlRecordset::NewRecordset($conn);
             $sql="select * from vi_inoauditor_sea where ca_referencia = '".$rs->Value('ca_referencia')."'";
             if (!$tm->Open($sql)) {
                 echo "Error 410: $sql";
                //echo "<script>alert(\"".addslashes($tm->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                //echo "<script>document.location.href = 'inosea.php';</script>";
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
             echo "</TABLE><BR>";
             echo "<TABLE CELLSPACING=10>";
             echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE=' Regresar ' ONCLICK='javascript:document.location.href = \"liberar_sea.php\"'></TH>";  // Cancela la operación
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
        case 'Liberar': {                                                      // El Botón Liberar fue pulsado
            $sql="update tb_inoclientes_sea set ca_fchliberacion = '$fchliberacion', ca_notaliberacion = '$notaliberacion', ca_fchliberado = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY HH24:mi:ss'), ca_usuliberado = '$usuario' where oid = '$oid'";
             if (!$rs->Open($sql)) {
                 echo "Error 471: $sql";
                 //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 //echo "<script>document.location.href = 'grupos.php';</script>";
                 exit;
             }
             
            $sql="select ca_idinocliente from tb_inoclientes_sea where oid = '$oid'";
            $tm = & DlRecordset::NewRecordset($conn);
            if (!$tm->Open($sql)) {
                echo "Error 480: $sql";
                //echo "<script>alert(\"" . addslashes($rs->mErrMsg) . "\");</script>";
                //echo "<script>document.location.href = 'repcomisiones.php';</script>";
                exit;
            }
            //echo "$sql.<br>";
            $ca_idinocliente=$tm->Value('ca_idinocliente');
             
             while (list ($clave, $val) = each ($liberacion)) {
                if (strlen($val[reccaja]) != 0){
                    $sql="update tb_inoingresos_sea set ca_reccaja = '".$val[reccaja]."', ca_fchpago = '".$val[fchpago]."' 
                        where ca_idinocliente = '$ca_idinocliente' and ca_factura = '".$clave."'";
                    if (!$rs->Open($sql)) {
                        echo "Error 493: $sql";
                        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                        //echo "<script>document.location.href = 'grupos.php';</script>";
                        exit;
                    }
                }
             }
             break;
             }
        }
   echo "<script>window.parent.frames.location.href = 'liberar_sea.php?boton=Consultar\&id=$id';</script>";  // Retorna a la pantalla principal de la opción
   }
?>