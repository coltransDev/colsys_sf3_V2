<?
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       CONFIRMA_OTM.PHP                                            \\
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

$titulo = 'Módulo de Confirmaciones de OTM';
$columnas = array("Número de Referencia"=>"ca_referencia", "BL Master"=>"ca_mbls", "Motonave"=>"ca_motonave", "No. Contenedor"=>"ca_idequipo", "BL Hijo"=>"ca_hbls","Nombre del Cliente"=>"ca_compania", "N.i.t."=>"ca_idcliente");  // Arreglo con las opciones de busqueda
$imporexpor = array("Importación","Exportación");                              // Arreglo con los tipos de Trayecto
$modalidades= array("LCL","FCL","COLOADING","PROYECTOS");                     // Arreglo con los tipos de Modalidades de Carga

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

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
    echo "<FORM METHOD=post NAME='menuform' ACTION='confirma_otm.php' >";
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

    if (isset($criterio) and strlen(trim($criterio)) != 0 and !isset($condicion)) {
        if ($opcion == 'ca_referencia' or $opcion == 'ca_mbls' or $opcion == 'ca_motonave') {
            $condicion= "where lower($opcion) like lower('%".$criterio."%')"; }
        elseif ($opcion == 'ca_idequipo') {
            $condicion= "where ca_referencia in (select ca_referencia from vi_inoequipos_sea where lower($opcion) like lower('%".$criterio."%'))"; }
        elseif ($opcion == 'ca_hbls' or $opcion == 'ca_idcliente' or $opcion == 'ca_compania') {
            $condicion= "where ca_referencia in (select ca_referencia from vi_inoclientes_sea where lower($opcion) like lower('%".$criterio."%'))"; }
       }
    if (!$rs->Open("select * from vi_inomaestra_sea $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
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
             if (!$rs->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
                 echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                 echo "<script>document.location.href = 'entrada.php';</script>";
                 exit; }
             echo "<HTML>";
             echo "<HEAD>";
             echo "<TITLE>$titulo</TITLE>";
             echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
             echo "function validar(){";
             echo "  if (!chkDate(document.cabecera.fchconfirmacion))";
             echo "      alert('Debe Especificar la Fecha de llegada de la Carga');";
             echo "  else if (document.cabecera.horaconfirmacion.value == '')";
             echo "      alert('Debe Especificar la Hora exacta de llegada de la Carga');";
             echo "  else if (document.cabecera.registroadu.value == '')";
             echo "      alert('Debe ingresar el Registro Aduanero');";
             echo "  else if (document.cabecera.registrocap.value == '')";
             echo "      alert('Ingrese el Número de Registro de Capitania');";
             echo "  else if (document.cabecera.bandera.value == '')";
             echo "      alert('Ingrese la Bandera del Buque');";
             echo "  else if (document.cabecera.mnllegada.value == '')";
             echo "      alert('Ingrese el nombre de la Motonoave de Llegada');";
             echo "  else";
             echo "      return (true);";
             echo "  return (false);";
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
             echo "</script>";
             echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
             echo "</HEAD>";
             echo "<BODY>";
require_once("menu.php");
             echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
             echo "<CENTER>";
             echo "<FORM METHOD=post NAME='cabecera' ACTION='confirma_otm.php' ONSUBMIT='return validar();'>";  // Hace una llamado nuevamente a este script pero con
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
                if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."' order by ca_compania")) {                      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
                    echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'entrada.php';</script>";
                    exit; }

                $in =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
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
                echo "  <TD Class=partir ROWSPAN=3>Confirmación&nbspOTM:&nbsp</TD>";
                echo "  <TD Class=mostrar COLSPAN=4>Asunto:<BR><INPUT TYPE='TEXT' NAME='asunto_otm' VALUE='".$rs->Value('ca_asunto_otm')."' SIZE=95 MAXLENGTH=255></TD>";
                echo "  <TD Class=mostrar ROWSPAN=3></TD>";
                echo "</TR>";
                echo "<TR>";
                echo "  <TD Class=mostrar COLSPAN=3 ROWSPAN=2>Mensaje:<BR><TEXTAREA NAME='mensaje_otm' WRAP=virtual ROWS=5 COLS=70>".$rs->Value('ca_mensaje_otm')."</TEXTAREA></TD>";
                echo "  <TD Class=listar>Fecha Llegada:<BR><INPUT TYPE='TEXT' NAME='fchllegada_otm' VALUE='".$rs->Value('ca_fchllegada_otm')."' SIZE=12 ONKEYDOWN=\"chkDate(this)\" ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
                echo "</TR>";
                echo "<TR>";
                $tm =& DlRecordset::NewRecordset($conn);
                if (!$tm->Open("select ca_idciudad, ca_ciudad from tb_ciudades where ca_idtrafico = 'CO-057' order by ca_ciudad")) {       // Selecciona todos lo registros de la tabla Traficos
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                    echo "<script>document.location.href = 'repcarga.php';</script>";
                    exit; }
                $tm->MoveFirst();
                echo "  <TD Class=mostrar>Ciudad :<BR><SELECT NAME='ciudad_otm'>";
                while ( !$tm->Eof()) {
                    echo " <OPTION VALUE='".$tm->Value('ca_ciudad')."'";
                    if (($rs->Value('ca_ciudad_otm')==$tm->Value('ca_ciudad') and $rs->Value('ca_ciudad_otm')!='') or ($tm->Value('ca_idciudad')=='BOG-0001' and $rs->Value('ca_ciudad_otm')=='')) {
                        echo" SELECTED"; }
                    echo ">".$tm->Value('ca_ciudad')."</OPTION>";
                    $tm->MoveNext(); }
                echo "  </SELECT></TD>";
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
                       if (!$in->Open("select ca_confirmar from tb_clientes where ca_idcliente = ".$cl->Value('ca_idcliente'))) {  // Selecciona todos los correos electrónicos para enviar confirmación
                           echo "<script>alert(\"".addslashes($in->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                           echo "<script>document.location.href = 'entrada.php';</script>";
                           exit; }

                       echo "<INPUT TYPE='HIDDEN' NAME='oid[]' VALUE=".$cl->Value('ca_oid').">";
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
                       echo "  <TD Class=listar><B>ID Proveedor:</B><BR>".$cl->Value('ca_idproveedor')."</TD>";
                       echo "  <TD Class=listar COLSPAN=2><B>Proveedor:</B><BR>".$cl->Value('ca_proveedor')."</TD>";
                       echo "  <TD Class=listar COLSPAN=2><B>Correos Electrónicos a enviar Confirmación:</B><BR>";
                       $confirmar = explode(",", $in->Value('ca_confirmar'));
                       $emails = explode(",", $cl->Value('ca_confirmar'));
                       for ($i= 0; $i< 8; $i++){
                            $chequear = (in_array($confirmar[$i],$emails) and $confirmar[$i]!="")?"CHECKED":"";
                            echo "<INPUT ID=ar_".$cl->Value('ca_oid')."_$i TYPE='TEXT' NAME='ar_".$cl->Value('ca_oid')."[]' VALUE='".$confirmar[$i]."' SIZE=35 MAXLENGTH=50>";
                            echo "<INPUT ID=em_".$cl->Value('ca_oid')."_$i TYPE=CHECKBOX NAME='em_".$cl->Value('ca_oid')."[]' VALUE='".$confirmar[$i]."' ONCHANGE='asignar_email(this);' $chequear><BR>";
                       }
                       echo "  </TD>";
                       echo "</TR>";
                       
                       echo "<TR HEIGHT=5>";
                       echo "  <TD Class=invertir COLSPAN=6></TD>";
                       echo "</TR>";
                       $cli_mem = $cl->Value('ca_idcliente');
                       $hbl_mem = $cl->Value('ca_hbls');
                   }
                   $cl->MoveNext();
                }
                $rs->MoveNext();
               }
               
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
             require("include/class.phpmailer.php");
             // Telmex //
/*           $domin = chr(100-36)."colmas.com.co";
             $name  = "bogota-aduana".$domin;
             $pass  = "gbvFR5";
             $mail = new PHPMailer();
             $mail->IsSMTP();              // set mailer to use SMTP
             $mail->Host = "tank.telmexla.net.co";   // specify main and backup server
             $mail->SMTPAuth = true;       // turn on SMTP authentication */
             
             // Telecom //
             $domin = chr(100-36)."coltrans.com.co";
             $name  = "tasas_cambios".$domin;
             $pass  = "tasas_cambios";
             $mail = new PHPMailer();
             $mail->IsSMTP();              // set mailer to use SMTP
             $mail->Host = "10.192.1.3";   // specify main and backup server
             $mail->SMTPAuth = true;       // turn on SMTP authentication

             $fchregistroadu = (!isset($fchregistroadu))?null:$fchregistroadu;
             $us =& DlRecordset::NewRecordset($conn);
             if (!$us->Open("select * from control.tb_usuarios where ca_login = '$usuario'")) {
                 echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'confirma_otm.php';</script>";
                 exit;
                }
             $rf =& DlRecordset::NewRecordset($conn);
             if (!$rf->Open("update tb_inomaestra_sea set ca_asunto_otm = '$asunto_otm', ca_mensaje_otm = '$mensaje_otm', ca_fchllegada_otm = '$fchllegada_otm', ca_ciudad_otm = '$ciudad_otm', ca_fchconfirma_otm = to_timestamp('".date("d M Y H:i:s")."', 'DD Mon YYYY hh:mi:ss'), ca_usuconfirma_otm = '$usuario' where ca_referencia = '$id'")) {
                 echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'confirma_otm.php';</script>";
                 exit;
                }
             if (!$rf->Open("select * from vi_inomaestra_sea where ca_referencia = '$id'")){
                 echo "<script>alert(\"".addslashes($rf->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                 echo "<script>document.location.href = 'confirma_otm.php';</script>";
                 exit;
                }
             if ($rf->Value('ca_modalidad')=="FCL") {
                 $eq =& DlRecordset::NewRecordset($conn);
                 if (!$eq->Open("select * from vi_inoequipos_sea where ca_referencia = '$id'")) {
                     echo "<script>alert(\"".addslashes($eq->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                     echo "<script>document.location.href = 'confirma_otm.php';</script>";
                     exit;
                    }
                 $equipos = "<br><table cellspacing=1 border=1>";
                 $equipos.= "<th colspan=4>Relación de Contenedores</th>";
                 $equipos.= "<tr><th>Concepto</th><th>Cantidad</th><th>ID Equipo</th><th>Observaciones</th></tr>";
                 while (!$eq->Eof() and !$eq->IsEmpty()) {
                    $equipos.= "<tr><td>".$eq->Value('ca_concepto')."</td><td>".$eq->Value('ca_cantidad')."</td><td>".$eq->Value('ca_idequipo')."</td><td>".$eq->Value('ca_observaciones')."&nbsp</td></tr>";
                    $eq->MoveNext();
                    }
                 $equipos.= "</table><br><br>";
                 }
             else {
                 $equipos = "<br><br>";
                 }
             $mail->From = $us->Value('ca_email');
             $mail->FromName = $us->Value('ca_nombre');
             $mail->AddCC($us->Value('ca_email'), $us->Value('ca_nombre'));
             $mail->AddReplyTo($us->Value('ca_email'), $us->Value('ca_nombre'));

             $mail->Username = $name ;
             $mail->Password = $pass;

             $mail->WordWrap = 50;
             $mail->IsHTML(true);                                  // set email format to HTML
             
             for ($i=0; $i < count($oid); $i++) {
                $caso = "ar_".$oid[$i];
                $correo = "em_".$oid[$i];
                $confirmar = isset($$caso)?implode(",",$$caso):"";
                if (!$rs->Open("update tb_clientes set ca_confirmar = '$confirmar' where ca_idcliente = (select ca_idcliente from tb_inoclientes_sea where oid = ".$oid[$i].")")) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'confirmaciones.php';</script>";
                    exit;
                    }
                if (!$rs->Open("select * from vi_inoclientes_sea where ca_oid = ".$oid[$i])) {
                    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";  // Muestra el mensaje de error
                    echo "<script>document.location.href = 'confirma_otm.php';</script>";
                    exit;
                    }
                $asunto  = $rf->Value('ca_asunto_otm')." - Ref: ".$rf->Value('ca_referencia');
                $mensaje = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\"><HTML><HEAD><META http-equiv=Content-Type content=\"text/html; charset=iso-8859-1\"><META content=\MSHTML 6.00.2800.1106\ name=GENERATOR></HEAD>";
                $mensaje.= "Señores:<br>";
                $mensaje.= "<b>".strtoupper($rs->Value('ca_compania'))."</b><br><br>";
                $mensaje.= $rf->Value('ca_mensaje_otm')."<br>";
                if ($rs->Value('ca_numorden')!='') {
                    $mensaje.= "<b>Número de Orden : </b>".$rs->Value('ca_numorden')."<br>"; }
                $mensaje.= "<b>Proveedor : </b>".$rs->Value('ca_proveedor')."<br>";
                $mensaje.= "<b>Puerto de Origen : </b>".$rf->Value('ca_ciuorigen')." - ".$rf->Value('ca_traorigen')."<br>";
                $mensaje.= "<b>Nombre del Buque : </b>".$rf->Value('ca_mnllegada')."<br>";
                $mensaje.= "<b>Fecha Salida : </b>".$rf->Value('ca_fchembarque')."<br>";
                $mensaje.= "<b>Puerto de Llegada : </b>".$rf->Value('ca_ciudestino')." - ".$rf->Value('ca_tradestino')."<br><br>";
                $mensaje.= "<b>Destino Final : </b>".$rf->Value('ca_ciudad_otm')."<br>";
                $mensaje.= "<b>Fecha Llegada : </b>".$rf->Value('ca_fchllegada_otm')."<br>";
                $mensaje.= "<b>Número de HBL : </b>".$rs->Value('ca_hbls')."<br>";
                $mensaje.= "<b>Número de Piezas : </b>".$rs->Value('ca_numpiezas')."<br>";
                $mensaje.= "<b>Volumen : </b>".$rs->Value('ca_volumen')."<br>";
                $mensaje.= "<b>Peso : </b>".$rs->Value('ca_peso')."<br>";
                $mensaje.= $equipos;
                $mensaje.= "Gracias por contar con nuestro servicio.<br><br>";
                $mensaje.= "Cordial Saludo.<br><br><br>";
                $mensaje.= "<b>".strtoupper($us->Value('ca_nombre'))."</b><br>";
                $mensaje.= $us->Value('ca_cargo')."<br>";
                $mensaje.= $us->Value('ca_email')."<br>";
                
                $mail->Subject = $asunto;
                $mail->Body    = $mensaje;
                $mail->AltBody = "«« Este mensaje está en formato HTML pero el equipo no está configurado para mostrarlo automáticamente. Active la opción HTML del menú Ver en su cliente de correo electrónico para una correcta visualización.>>";
        
                $send_it = false;
                $mail->EmptyAddress();
                for ($j=0; $j < count($$correo); $j++) {
                    if (${$correo}[$j] != '') {
                        $send_it = true;
                        $mail->AddAddress(${$correo}[$j], ${$correo}[$j]);
                        }
                    }
                if ($send_it) {
                    if(!$mail->Send()) {
                        echo "<script>alert(\"".addslashes($mail->ErrorInfo)."\");</script>";  // Muestra el mensaje de error
                        echo "<script>document.location.href = 'confirma_otm.php';</script>";
                        exit;
                        }
                    }
                }
            break;
           }
        }
    echo "<script>document.location.href = 'confirma_otm.php';</script>";  // Retorna a la pantalla principal de la opción
  }
?>