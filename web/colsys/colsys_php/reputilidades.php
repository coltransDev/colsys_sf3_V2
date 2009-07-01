<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPUTILIDADES.PHP                                           \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte de Análisis de Utilidad.                            \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Reporte de Análisis de Utilidades';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");
$modalidades = array( "%" => "Listar Todas", "FCL" => "FCL", "LCL" => "LCL", "COLOADING" => "COLOADING", "PROYECTOS" => "PROYECTOS");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='reputilidades.php'>";
    echo "<TABLE WIDTH=600 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=8 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=3></TD>";
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
    for ( $i=5; $i>=0; $i-- ){
          echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes a Consultar:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    $tm =& DlRecordset::NewRecordset($conn);
    if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'reputilidades.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
    echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
    while ( !$tm->Eof()) {
            echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
            $tm->MoveNext();
          }
    echo "  </TD>";
    echo "  <TD Class=listar>Modalidad:<BR><SELECT NAME='modalidad'>";
    while (list ($clave, $val) = each ($modalidades)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Estados:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each ($estados)) {
        echo " <OPTION VALUE='".$val."'>".$clave;
        }
    echo "  </SELECT></TD>";
    echo "  <TH style='vertical-align:center;' ROWSPAN=2><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR>";
    echo "  <TD Class=listar COLSPAN=2>Con Utilidad x CBM:<BR>&nbsp&nbsp<SELECT NAME='signo'><OPTION VALUE='<='><=<OPTION VALUE='>='>>=</SELECT>&nbsp&nbsp<INPUT TYPE='text' NAME='comparable' size='15'></TD>";
    echo "  <TD Class=listar COLSPAN=3>Nombre del Cliente:<BR><INPUT TYPE='text' NAME='compania' size='60'></TD>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=7></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($traorigen)){
    set_time_limit(360);
    SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

    if (isset($compania) and $compania != '') {
        $condicion= "* from vi_inocomisiones_sea where upper(ca_compania) like upper('%".strtolower($compania)."%') and ";
    }else{
        $condicion= "* from vi_inoutilidades_sea where";
        if (isset($comparable) and $comparable != 0) {
            $condicion.= " ca_utilxcbm ".$signo." ".$comparable. " and";
        }
    }
    $condicion.= " substr(ca_referencia,8,2) like '$mes' and substr(ca_referencia,15) = ".substr($ano, -1)." and ca_traorigen like '%$traorigen%' and ca_modalidad like '%$modalidad%' and ". str_replace("\"","'",$casos);
    $co =& DlRecordset::NewRecordset($conn);                                   // Apuntador que permite manejar la conexiòn a la base de datos
    if (!$rs->Open("select $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    $eq =& DlRecordset::NewRecordset($conn);
    $cl =& DlRecordset::NewRecordset($conn);
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
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
    echo "<FORM METHOD=post NAME='informe' ACTION='reputilidades.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=670 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    if (isset($compania) and strlen($compania) == 0) {
		echo "<TR>";
		echo "  <TH Class=titulo COLSPAN=8>COLTRANS S.A.<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
		echo "</TR>";
        echo "<TH>Puerto</TH>";
        echo "<TH>Destino</TH>";
        echo "<TH>Modalidad</TH>";
        echo "<TH>Utilidad</TH>";
        echo "<TH>Util.x CBM</TH>";
        echo "<TH>Equipos</TH>";
        echo "<TH>Clientes</TH>";
        echo "<TH>Referencia</TH>";
        $mes_mem = '';
        $nom_tra = '';
        $mod_mem = $rs->Value('ca_modalidad');
        while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
           $utl_cbm = $rs->Value('ca_utilcons');
           $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" background: #F0F0F0");
           $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
           if ($mes_mem != $rs->Value('ca_mes')) {
               list($mes, $ano) = sscanf($rs->Value('ca_mes'), "%2s-%d");
               echo "<TR>";
               echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=8>".$meses[$mes]."/".(2000+$ano)."</TD>";
               echo "</TR>";
               $mes_mem = $rs->Value('ca_mes');
               $num_ref = 1;
               $sub_hbl = 0;
               $sub_fac = 0;
              }
           if ($nom_tra != $rs->Value('ca_traorigen')) {
               echo "<TR>";
               echo "  <TD Class=invertir style='font-size: 10px;font-weight:bold;' COLSPAN=5>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
               echo "  <TD Class=invertir style='font-size: 9px;'>";
               echo "   <TABLE CELLSPACING=1 style='letter-spacing:-1px;'>";
               echo "    <TH WIDTH=90>Concepto</TH>";
               echo "    <TH WIDTH=35>Cantidad</TH>";
               echo "   </TABLE>";
               echo "  </TD>";
               echo "  <TD Class=invertir style='font-size: 9px;' COLSPAN=2></TD>";
               echo "</TR>";
               $nom_tra = $rs->Value('ca_traorigen');
           }
           echo "<TR>";
           echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_ciuorigen')."</TD>";
           echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_ciudestino')."</TD>";
           echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_modalidad')."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_cbm)."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_utilxcbm'))."</TD>";
    
           if (!$eq->Open("select ca_referencia, ca_concepto, sum(ca_cantidad) as ca_cantidad from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."' group by ca_referencia, ca_concepto")) {       // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
               echo "<script>alert(\"".addslashes($eq->mErrMsg)."\");</script>";      // Muestra el mensaje de error
               echo "<script>document.location.href = 'entrada.php';</script>";
               exit; }
           
           echo "  <TD Class=listar style='font-size: 9px;$back_col'>";
           echo "  <TABLE CELLSPACING=1 style='letter-spacing:-1px;'>";
           while (!$eq->Eof() and !$eq->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD WIDTH=90 Class=listar style='letter-spacing:-1px;$back_col'>".$eq->Value('ca_concepto')."</TD>";
                echo "  <TD WIDTH=35 Class=valores style='letter-spacing:-1px;$back_col'>".$eq->Value('ca_cantidad')."</TD>";
                echo "</TR>";
                $eq->MoveNext();
                }
           echo "  </TABLE>";
           echo "  </TD>";
    
           if (!$cl->Open("select ca_compania from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."' group by ca_referencia, ca_compania")) {      // Selecciona todos lo registros de la tabla Clientes de una referencia Ino-Marítimo
               echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
               echo "<script>document.location.href = 'entrada.php';</script>";
               exit; }
           
           echo "  <TD WIDTH=125 Class=listar style='font-size: 9px;$back_col'>";
           echo "  <TABLE CELLSPACING=1 style='letter-spacing:-1px;'>";
           while (!$cl->Eof() and !$cl->IsEmpty()) {                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
                echo "<TR>";
                echo "  <TD WIDTH=125 Class=listar style='letter-spacing:-1px;$back_col'>".$cl->Value('ca_compania')."</TD>";
                echo "</TR>";
                $cl->MoveNext();
                }
           echo "  </TABLE>";
           echo "  </TD>";
           
           echo "  <TD Class=listar  style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'".substr($back_col,14,7)."');\" onclick='javascript:window.open(\"inosea_gere.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
           echo "</TR>";
           $rs->MoveNext();
           if ($mod_mem != $rs->Value('ca_modalidad')) {
               echo "<TR HEIGHT=5>";
               echo "  <TD Class=titulo COLSPAN=8></TD>";
               echo "</TR>";
               $mod_mem = $rs->Value('ca_modalidad');
           }
        }
    }else {
		echo "<TR>";
		echo "  <TH Class=titulo COLSPAN=9>COLTRANS S.A.<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
		echo "</TR>";
        echo "<TH>ID Cliente</TH>";
        echo "<TH>Referencia</TH>";
        echo "<TH>Estado</TH>";
        echo "<TH>Sucursal</TH>";
        echo "<TH>Hbl's</TH>";
        echo "<TH>Volumen</TH>";
        echo "<TH>Facturación</TH>";
        echo "<TH>Util/Cliente</TH>";
        echo "<TH>Util/Sobreventa</TH>";
        $cli_mem = 0;
        $ref_mem = '';
        $mes_mem = '';
        $ano_mem = '';
        $dat_imp = '';
        $tot_mes = 0;
        while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
           if ($cli_mem != $rs->Value('ca_idcliente')) {
               echo "<TR>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 11px;'>".number_format($rs->Value('ca_idcliente'))."</TD>";
               echo "  <TD Class=invertir style='font-weight:bold; font-size: 11px;' COLSPAN=8>".$rs->Value('ca_compania')."</TD>";
               echo "</TR>";
               $cli_mem = $rs->Value('ca_idcliente');
               $tot_fac = 0;
               $tot_utl = 0;
			   $tot_sob = 0;
              }
           if ($hbl_mem == $rs->Value('ca_hbls')) {
			   $sub_sob+= $rs->Value('ca_valor_ded');
			   $rs->MoveNext();
			   continue;
              }

           $condicion.= " and substr(ca_referencia,8,2) like '$mes' and substr(ca_referencia,15) = ".substr($ano, -1);
           if ($mes_mem != substr($rs->Value('ca_referencia'),7,2) or $ano_mem != substr($rs->Value('ca_referencia'),-1)){
               $ano_mem = substr($rs->Value('ca_referencia'),-1);
               $mes_mem = substr($rs->Value('ca_referencia'),7,2);
               $dat_imp = $meses[$mes_mem]."/".(2000+$ano_mem);
           }else{
               $dat_imp = '';
           }
           $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');             
           $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" background: #F0F0F0");
           $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
           echo "<TR>";
           if ($ref_mem != $rs->Value('ca_referencia')) {
               echo "  <TD Class=mostrar style='font-weight:bold; font-size: 9px;$back_col'>$dat_imp</TD>";
               echo "  <TD Class=listar  style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'".substr($back_col,14,7)."');\" onclick='javascript:window.open(\"inosea_gere.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
               echo "  <TD Class=listar  style='font-size: 9px;$back_col'>".$rs->Value('ca_estado')."</TD>";
               echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_sucursal')."</TD>";
               $ref_mem = $rs->Value('ca_referencia');
           }else{
               echo "  <TD Class=mostrar style='font-size: 9px;$back_col' COLSPAN=4></TD>";
            }
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_hbls')."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_volumen')."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor'))."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_volumen') * $utl_cbm)."</TD>";
           echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor_ded'))."</TD>";
           echo "</TR>";
           $hbl_mem = $rs->Value('ca_hbls');
           $sub_fac+= $rs->Value('ca_valor');
           $sub_utl+= ($rs->Value('ca_volumen') * $utl_cbm);
		   $sub_sob+= $rs->Value('ca_valor_ded');
           $rs->MoveNext();
           if ($mes_mem != substr($rs->Value('ca_referencia'),7,2) or $ano_mem != substr($rs->Value('ca_referencia'),-1) or $rs->Eof()){
               echo "<TR>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;' COLSPAN=6>Sub-Totales</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($sub_fac)."</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($sub_utl)."</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($sub_sob)."</TD>";
               echo "</TR>";
               echo "<TR HEIGHT=5>";
               echo "  <TD Class=imprimir COLSPAN=8></TD>";
               echo "</TR>";
               $tot_fac+= $sub_fac;
               $tot_utl+= $sub_utl;
               $tot_sob+= $sub_sob;
               $sub_fac = $sub_utl = $sub_sob = 0;
              }
           if ($cli_mem != $rs->Value('ca_idcliente') or $rs->Eof()) {
               echo "<TR HEIGHT=5>";
               echo "  <TD Class=titulo COLSPAN=9></TD>";
               echo "</TR>";
               echo "<TR>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;' COLSPAN=6>Totales</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($tot_fac)."</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($tot_utl)."</TD>";
               echo "  <TD Class=invertir style='text-align:right; font-weight:bold; font-size: 10px;'>".number_format($tot_sob)."</TD>";
               echo "</TR>";
              }
           }
    }
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"reputilidades.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>