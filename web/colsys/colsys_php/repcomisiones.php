<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPCOMISIONES.PHP                                           \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   Reporte de Cuadro INO para Gerencia.                        \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Informe de Comisiones para Vendedores';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                               // Captura las variables de la sessi�n abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
    echo "<script>document.location.href = 'entrada.php';</script>";
   }


set_time_limit(0);    
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($login) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function llenar_vendedores(){";
	echo "  source = document.getElementById('sucursal');";
	echo "  elemento = document.getElementById('login');";
    echo "  elemento.length = 0;";
    echo "  elemento.options[elemento.length] = new Option();";
    echo "  elemento.length = 0;";
    echo "  elemento[elemento.length] = new Option('Vendedores (Todos)','%',false,true);";
    echo "     for (cont=0; cont<document.menuform.usu_login.length; cont++) {";
    echo "          if (source.value == document.menuform.usu_sucursal[cont].value){";
    echo "              elemento[elemento.length] = new Option(document.menuform.usu_nombre[cont].value,document.menuform.usu_login[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repcomisiones.php'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los par�metros para el Reporte</TH>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
    if (!$us->Open("select ca_login, ca_nombre, ca_sucursal from vi_usuarios where ca_login != 'Administrador' and (ca_cargo = 'Gerente Regional' or ca_cargo like '%Ventas%' or ca_departamento like '%Ventas%' or ca_departamento like '%Comercial%') order by ca_login")) {
        echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit;
       }
    $us->MoveFirst();
    while (!$us->Eof()) {
           echo "<INPUT TYPE='HIDDEN' NAME='usu_login' VALUE='".$us->Value('ca_login')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='usu_nombre' VALUE='".$us->Value('ca_nombre')."'>";
           echo "<INPUT TYPE='HIDDEN' NAME='usu_sucursal' VALUE='".$us->Value('ca_sucursal')."'>";
           $us->MoveNext();
          }

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
    echo "  <TD Class=listar>A�o:<BR><SELECT NAME='ano'>";
    for ( $i=5; $i>=0; $i-- ){
          echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar>Mes:<BR><SELECT NAME='mes'>";
    while (list ($clave, $val) = each ($meses)) {
        echo " <OPTION VALUE=$clave";
        if (date('m')==$clave) {
            echo" SELECTED"; }
        echo ">$val</OPTION>";
        }
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar>Sucursal:<BR><SELECT NAME='sucursal' ONCHANGE='llenar_vendedores();'>";
    echo "  <OPTION VALUE=%>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
		   echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
           $tm->MoveNext();
          }
	
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar>Vendedor:<BR><SELECT NAME='login'>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=%>Vendedores (Todos)</OPTION>";
    echo "  </SELECT></TD>";
    echo "  <TD Class=listar ROWSPAN=2>Estado:<BR><SELECT NAME='casos'>";
    while (list ($clave, $val) = each ($estados)) {
        echo " <OPTION VALUE='".$val."'>".$clave;
        }
    echo "  </SELECT></TD>";
    echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=6></TD>";
    echo "</TR>";

    echo "</TABLE><BR>";
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"reporteador.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
    echo "<script>menuform.ano.focus()</script>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (!isset($boton) and !isset($accion) and isset($login)){
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo
    $condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_sucursal like '%$sucursal%' and ca_login like '$login' and ".str_replace("\"","'",$casos);
    if (!$rs->Open("select * from vi_inocomisiones_sea $condicion order by ca_mes, ca_login, ca_compania, ca_referencia, ca_hbls")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
    $fc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // C�digo en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    window.open(\"repcomisiones.php?boton=\"+opcion+\"\&id=\"+id+\"\&cl=\"+cl);";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repcomisiones.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=680 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=13>COLTRANS S.A.<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    $log_ven = '';
    $cia_mem = '';
    $ref_mem = '';
    $nom_cli = '';
    $hbl_cli = '';
    $ino_tot = 0;
    $utl_tot = 0;
    $sbr_tot = 0;
    $sob_tot = 0;
    $con_tot = 0;
    $com_tot = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
       $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
       if ($log_ven != $rs->Value('ca_login')) {
           if (!$us->Open("select ca_nombre from control.tb_usuarios where ca_login = '".$rs->Value('ca_login')."'")) {
               echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
               echo "<script>document.location.href = 'repcomisiones.php';</script>";
               exit; }
           echo "<TR>";
           echo "  <TD Class=titulo COLSPAN=13 style='text-align:left; font-weight:bold; font-size: 10px;'>".strtoupper($us->Value('ca_nombre'))." �Comisiones por Cobrar <IMG style='visibility: $visible;' src='./graficos/details.gif' alt='Ver Comisiones Pendientes por Cobrar' border=0 onclick='elegir(\"ComisionesXC\",\"".$rs->Value('ca_login')."\",\"$mes|$ano|$sucursal|$login|".str_replace(chr(34),"�",$casos)."\");'>�</TD>";
           echo "</TR>";
           echo "<TR>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Cliente</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Referencia</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Facturas</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Vlr.Facturado</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Estado</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Vol.CMB</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Utilidad</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Comisiones</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;' COLSPAN=3>Comis/Sobreventa</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Comis/Cobradas</TD>";
           echo "  <TD Class=invertir style='text-align:center; font-weight:bold; font-size: 9px;'>Comprobantes</TD>";
           echo "</TR>";
           $cmb_ven = 0;
           $utl_ven = 0;
           $utl_con = 0;
           $sob_utl = 0;
           $sob_ven = 0;
           $com_ven = 0;
           $log_ven = $rs->Value('ca_login');
           $nom_ven = $us->Value('ca_nombre'); }
       $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" ");
       $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
       if (!$fc->Open("select ca_factura from vi_inoingresos_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_hbls = '".$rs->Value('ca_hbls')."'")) {
           echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";
           echo "<script>document.location.href = 'repcomisiones.php';</script>";
           exit; }
       $fc->MoveFirst();
       $fac_mem = '';
       while (!$fc->Eof() and !$fc->IsEmpty()) {
          $fac_mem.= $fc->Value('ca_factura').'<BR>';
          $fc->MoveNext();
       }
       $fac_mem = substr($fac_mem,0,strlen($fac_mem)-4);
       
       if (!$fc->Open("select DISTINCT ca_comprobante from tb_inocomisiones_sea where ca_referencia = '".$rs->Value('ca_referencia')."' and ca_idcliente = ".$rs->Value('ca_idcliente')." and ca_hbls = '".$rs->Value('ca_hbls')."'")) {
           echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";
           echo "<script>document.location.href = 'repcomisiones.php';</script>";
           exit; }
       $fc->MoveFirst();
       $arr_com = array();
       while (!$fc->Eof() and !$fc->IsEmpty()) {
          array_push($arr_com,$fc->Value('ca_comprobante'));
          $fc->MoveNext();
       }

       if ($cia_mem != $rs->Value('ca_compania')) {
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=invertir COLSPAN=13></TD>";
           echo "</TR>";
           echo "<TR>";
           echo "  <TD Class=invertir style='font-weight:bold; font-size:10px;' COLSPAN=13>&nbsp;&nbsp;".substr(ucwords(strtolower($rs->Value('ca_compania'))),0,30)."</TD>";
           echo "</TR>";
           $cia_mem = $rs->Value('ca_compania');
       }
       $ref_mem = $rs->Value('ca_referencia');
       $nom_cli = $rs->Value('ca_compania');
       $hbl_cli = $rs->Value('ca_hbls');
       $utl_cas = round($rs->Value('ca_volumen') * $utl_cbm * $rs->Value('ca_porcentaje') / 100, 0);
       $utl_con+= $utl_cas;
       $utl_par = round(($rs->Value('ca_facturacion_r')-$rs->Value('ca_deduccion_r')-$rs->Value('ca_utilidad_r'))/$rs->Value('ca_volumen_r')*$rs->Value('ca_volumen'),0);
       $utl_ven+= $utl_par;
       $cmb_ven+= $rs->Value('ca_volumen');
       $com_cas = $rs->Value('ca_vlrcomisiones')+$rs->Value('ca_sbrcomisiones');
       $com_ven+= $com_cas;

       echo "<TR>";
       echo "  <TD Class=listar></TD>";
       echo "  <TD Class=listar  style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'".substr($back_col,14,6)."');\" onclick='javascript:window.open(\"inosea_gere.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
       echo "  <TD Class=listar  style='font-size: 9px;$back_col'>$fac_mem</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor'))."</TD>";
       echo "  <TD Class=listar  style='font-size: 9px;$back_col'>".$rs->Value('ca_estado')."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_volumen')."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_par)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_cas)."</TD>";
       $mul_lin = false;
       $arr_fac = array();
       while ($ref_mem == $rs->Value('ca_referencia') and $nom_cli == $rs->Value('ca_compania') and $hbl_cli == $rs->Value('ca_hbls') and !$rs->Eof()) {
           $imp_mem = (in_array($rs->Value('ca_factura_ded'),$arr_fac))?false:true;
           if ($imp_mem and $mul_lin) {
               echo "  <TD Class=listar>&nbsp;</TD>";
               echo "  <TD Class=listar>&nbsp;</TD>";
               echo "</TR>";
               echo "<TR>";
               echo "  <TD Class=listar COLSPAN=8>&nbsp;</TD>";
           }
           if ($imp_mem and $rs->Value('ca_valor_ded') != 0) {
               $sob_cas = round($rs->Value('ca_valor_ded') * $rs->Value('ca_porcentaje') / 100, 0);
               echo "  <TD Class=listar style='font-size: 9px;$back_col'>".str_replace(" ","&nbsp;","&nbsp;".$rs->Value('ca_costo_ded'))."</TD>";
               echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor_ded'))."</TD>";
               echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($sob_cas)."</TD>";
               $sob_utl+= $rs->Value('ca_valor_ded');
               $sob_ven+= $sob_cas;
               array_push($arr_fac,$rs->Value('ca_factura_ded'));
               $mul_lin = true;
              }
           else if ($imp_mem) {
               echo "  <TD Class=listar>&nbsp;</TD>";
               echo "  <TD Class=listar>&nbsp;</TD>";
               echo "  <TD Class=listar>&nbsp;</TD>";
               array_push($arr_fac,$rs->Value('ca_factura_ded'));
              }
           $rs->MoveNext();
          }
       echo "  <TD Class=valores style='font-size: 9px;'>".number_format($com_cas)."</TD>";
       echo "  <TD Class=valores  style='font-size: 9px;'>";
       while (list ($clave, $val) = each ($arr_com)) {
          echo "<A HREF='comision.php?id=$val' TARGET='_blank'>$val&nbsp;</A>";
       }
       echo "  </TD>";
       echo "</TR>";
       if ($log_ven != $rs->Value('ca_login') or $rs->Eof()) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=13></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=5>Totales por Vendedor :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($cmb_ven,2)."</TD>";
            echo "  <TD Class=valores>".number_format($utl_ven)."</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_con)."</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>&nbsp;Sobreventa :</TD>";
            echo "  <TD Class=valores>&nbsp;&nbsp;".number_format($sob_utl)."</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;".number_format($sob_ven)."</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'></TD>";
            echo "  <TD Class=listar style='font-weight:bold;'></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=8>Gran Total para ".ucwords(strtolower($nom_ven))." :</TD>";
            echo "  <TD Class=valores COLSPAN=2>Comision&nbsp;Causada:</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_con+$sob_ven)."</TD>";
            echo "  <TD Class=valores>Comision&nbsp;Cobrada:</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;".number_format($com_ven)."</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'></TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=13></TD>";
            echo "</TR>";
            $ino_tot+= $utl_ven;
            $cmb_tot+= $cmb_ven;
            $utl_tot+= $utl_con;
            $sbr_tot+= $sob_utl;
            $sob_tot+= $sob_ven;
            $com_tot+= $com_ven;
           }
       }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=13></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=13></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=5>Totales del Informe:</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($cmb_tot,2)."</TD>";
    echo "  <TD Class=valores>".number_format($ino_tot)."</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_tot)."</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;Tot.Sobreventa:</TD>";
    echo "  <TD Class=valores>".number_format($sbr_tot)."</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($sob_tot)."</TD>";
    echo "  <TD Class=valores>Causado:&nbsp;<b>".number_format($utl_tot + $sob_tot)."</b></TD>";
    echo "  <TD Class=valores>Cobrado:&nbsp;<b>".number_format($com_tot)."</b></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=13></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcomisiones.php\"'></TH>";  // Cancela la operaci�n
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
elseif (isset($boton)) {                                                      // Rutina que registra los cambios en la tabla de la base de datos
    switch(trim($boton)) {                                                    // Switch que evalua cual bot�n de comando fue pulsado por el usuario
        case 'ComisionesXC': {                                                // El Bot�n ComisionesXC fue pulsado
		$modulo = "00100100";                                              // Identificaci�n del m�dulo para la ayuda en l�nea
//          include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
            list($mes, $ano, $sucursal, $login, $casos) = split('[|]', $cl);  // sscanf($cl, "%d|%d|%s|%s|%s");
            
            $annos = $ano;
            $nanos = '';
            while ($annos >= 2009){                                             // Trae lo pendiente x cobrar en comisiones desde el a�o 2009 hasta el a�o solicitado
                $nanos.= "'".$annos."',";
                $annos--;
            }
            $nanos = substr($nanos,0,strlen($nanos)-1);

            $nmeses = '';
            $mes = ($mes=='%')?12:$mes;
            for ($i=1; $i<=$mes; $i++){
                    $nmeses.= "'".substr(100+$i,1,2)."',";
            }
            $nmeses = substr($nmeses,0,strlen($nmeses)-1);
			
            $condicion = "ca_ano::text in ($nanos) and ca_mes::text in ($nmeses) and ca_login like '$id' and ca_estado <> 'Abierto'";
            if (!$rs->Open("select * from vi_inoingresos_sea where $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
                echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
                echo "<script>document.location.href = 'entrada.php';</script>";
                exit; }

            echo "<HTML>";
            echo "<HEAD>";
            echo "<TITLE>$titulo</TITLE>";
            echo "<script language='JavaScript' type='text/JavaScript'>";           // C�digo en JavaScript para validar las opciones de mantenimiento
            echo "function habilitar(campo){";
            echo "  cadena = campo.getAttribute('ID');";
            echo "  indice = cadena.substring(0, cadena.indexOf('_'));";            //, cadena.length
            echo "  elemento = document.getElementById('CHK_'+indice);";
            echo "  i = 0;";
            echo "  check = true;";
            echo "  while (isNaN(document.getElementById(indice+'_'+i))) {";
            echo "     objeto = document.getElementById(indice+'_'+i);";
            echo "     if (objeto.value == '') {";
            echo "        check = false;";
            echo "     }";
            echo "     i++;";
            echo "  }";
            echo "  elemento.checked = check;";
            echo "  elemento.style.visibility = (check)?\"visible\":\"hidden\";";
            echo "  sumarizar(document.informe);";
            echo "}";
            echo "function sumarizar(forma){";
            echo "  if (!isNaN(document.getElementById('TOT_vlr'))){;";
            echo "     return;";
            echo "  }";
            echo "  document.getElementById('TOT_vlr').value = 0;";
            echo "  document.getElementById('TOT_sbr').value = 0;";
            echo "  document.getElementById('GRN_tot').value = 0;";
            echo "  for (cont=0; cont<forma.elements.length; cont++){";
            echo "     nombre = forma.elements[cont].name.substring(0, 4);";
            echo "     if (nombre = 'CHK_'){";
            echo "        if (forma.elements[cont].checked){";
            echo "           cadena = forma.elements[cont].getAttribute('ID');";
            echo "           indice = cadena.substring(cadena.indexOf('_')+1);";
            echo "           vlrcomision = document.getElementById('VLR_'+indice);";
            echo "           sbrcomision = document.getElementById('SBR_'+indice);";
            echo "           document.getElementById('TOT_vlr').value = Math.round(document.getElementById('TOT_vlr').value) + Math.round(vlrcomision.value);";
            echo "           document.getElementById('TOT_sbr').value = Math.round(document.getElementById('TOT_sbr').value) + Math.round(sbrcomision.value);";
            echo "           document.getElementById('GRN_tot').value = eval(document.getElementById('TOT_vlr').value) + eval(document.getElementById('TOT_sbr').value);";
            echo "        }";
            echo "     }";
            echo "  }";
            echo "}";
            echo "function imprimir(id)";
            echo "{";
            echo "  document.informe.id.value = id;";
            echo "  document.informe.action = 'comision.php';";
            echo "  document.informe.target = '_blank';";   // Open in a new window
            echo "  document.informe.submit();";            // Submit the page
            echo "  return true;";
            echo "}";
            echo "function negativo(campo)";
            echo "{";
            echo "  cadena = campo.getAttribute('ID');";
            echo "  indice = cadena.substring(cadena.indexOf('_')+1);";
            echo "  elemento = document.getElementById('VLR_'+indice);";
            echo "  if (elemento.value < 0)";
            echo "      campo.checked = true;";
            echo "  return;";
            echo "}";
            echo "function elegir(opcion, id, cl) {";
            echo "    document.location.href = 'repcomisiones.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
            echo "}";
            echo "function uno(src,color_entrada) {";
            echo "    src.style.background=color_entrada;src.style.cursor='hand'";
            echo "}";
            echo "function dos(src,color_default) {";
            echo "    src.style.background=color_default;src.style.cursor='default';";
            echo "}";
            echo "</script>";
            echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
            echo "</HEAD>";
            echo "<BODY>";
require_once("menu.php");
            echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";                      // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
            echo "<CENTER>";
            echo "<FORM METHOD=post NAME='informe' ACTION='repcomisiones.php' ONSUBMIT='javascript:return confirm(\"�Esta seguro de Registrar el Cobro de Comisiones?\")'>";             // Hace una llamado nuevamente a este script pero con
            echo "<INPUT TYPE='HIDDEN' NAME='id'>";
            echo "<TABLE CELLSPACING=1>";                                              // un boton de comando definido para hacer mantemientos
            echo "<TR>";
            echo "  <TH Class=titulo COLSPAN=8>COLTRANS S.A.<BR>$titulo<BR>".$meses[substr(100+$mes,1,2)]."/".$ano."</TH>";
            echo "</TR>";
            echo "<TH>Referencia</TH>";
            echo "<TH>Hbls</TH>";
            echo "<TH>Factura</TH>";
            echo "<TH>Fch.Factura</TH>";
            echo "<TH>Vlr.Facturado</TH>";
            echo "<TH>Rec.Caja</TH>";
            echo "<TH>Fch.Pago</TH>";
            echo "<TH>Com.Causada</TH>";
            $nom_cli = '';
            $tot_vlr = 0;
            $tot_sbr = 0;
            while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucci�n Select
                $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
                $com_cas = round($rs->Value('ca_volumen') * $utl_cbm * $rs->Value('ca_porcentaje') / 100,0);
                $com_sbr = round($rs->Value('ca_sbrcomision') * $rs->Value('ca_porcentaje') / 100,0);
                if ($com_cas-$rs->Value('ca_vlrcomisiones') == 0 and $com_sbr-$rs->Value('ca_sbrcomisiones') == 0) {
                    $rs->MoveNext();
                    continue;
                }
                $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" ");
                $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
                if ($rs->Value('ca_compania') != $nom_cli) {
                    echo "<TR>";
                    echo "  <TD Class=invertir style='font-weight:bold; font-size: 9px;' COLSPAN=7>".$rs->Value('ca_compania')."</TD>";
                    echo "  <TD Class=invertir>";
                    echo "    <TABLE CELLSPACING=1>";
                    echo "    <TR>";
                    echo "     <TD Class=listar style='font-weight:bold; text-align=center' WIDTH=70>Corriente</TD>";
                    echo "     <TD Class=listar style='font-weight:bold; text-align=center' WIDTH=70>Sobre/Vta</TD>";
                    echo "    </TR>";
                    echo "    </TABLE>";
                    echo "  </TD>";
                    echo "</TR>";
                    $nom_cli = $rs->Value('ca_compania');
                    $num_ref = '';
                    $num_hbl = '';
                }
                echo "<TR>";
                if ($num_ref != $rs->Value('ca_referencia')) {
					echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;$back_col' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'".substr($back_col,14,6)."');\" onclick='javascript:window.open(\"inosea_gere.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
                    $num_ref = $rs->Value('ca_referencia');
                }else{
                    echo "  <TD Class=listar></TD>";
                }
                if ($num_hbl != $rs->Value('ca_hbls')) {
                    echo "  <TD Class=listar style='font-size: 9px;$back_col'>".$rs->Value('ca_hbls')."</TD>";
                    $num_hbl = $rs->Value('ca_hbls');
                    $num_oid = $rs->Value('ca_oid');
                    $rec_com = true;
                    $j = 0;
                }else{
                    echo "  <TD Class=listar></TD>";
                }
                echo "  <TD Class=listar  WIDTH=50 style='font-size: 9px;$back_col'>".$rs->Value('ca_factura')."</TD>";
                echo "  <TD Class=listar  WIDTH=70 style='font-size: 9px;$back_col'>".$rs->Value('ca_fchfactura')."</TD>";
                echo "  <TD Class=valores WIDTH=75 style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor'))."</TD>";
                echo "  <TD Class=listar  WIDTH=75 style='font-size: 9px;$back_col'>".$rs->Value('ca_reccaja')."</TD>";
                echo "  <TD Class=listar  WIDTH=75 style='font-size: 9px;$back_col'>".$rs->Value('ca_fchpago')."</TD>";
                if ($rec_com) {
                    echo "  <TD Class=invertir>";
                    echo "    <TABLE CELLSPACING=1>";
                    echo "    <TR>";
                    echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'>".number_format($com_cas-$rs->Value('ca_vlrcomisiones'))."</TD>";
                    echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'>".number_format($com_sbr-$rs->Value('ca_sbrcomisiones'))."</TD>";
                    echo "    <TR>";
                    echo "    </TABLE>";
                    echo "    <INPUT ID=VLR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][comision]' VALUE=".($com_cas-$rs->Value('ca_vlrcomisiones')).">";
                    echo "    <INPUT ID=SBR_$num_oid TYPE='HIDDEN' NAME='hbls[$num_oid][sobrevta]' VALUE=".($com_sbr-$rs->Value('ca_sbrcomisiones')).">";
                    echo "  </TD>";
                    $rec_com = false;
                    $tot_vlr+= ($com_cas-$rs->Value('ca_vlrcomisiones'));
                    $tot_sbr+= ($com_sbr-$rs->Value('ca_sbrcomisiones'));
                }else{
                    echo "  <TD Class=listar></TD>";
                }
                echo "</TR>";
                $rs->MoveNext();
                $j++;
                }
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=8></TD>";
            echo "</TR>";
			echo "";
            echo "<TR>";
			echo "  <TD COLSPAN=7 Class=invertir style='text-align:right'><B>TOTALES :</B>";
			echo "  </TD>";
			echo "  <TD Class=invertir>";
			echo "    <TABLE CELLSPACING=1>";
			echo "    <TR>";
			echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'><B>".number_format($tot_vlr)."</B></TD>";
			echo "     <TD Class=valores WIDTH=70 style='font-size: 9px;$back_col'><B>".number_format($tot_sbr)."</B></TD>";
			echo "    <TR>";
			echo "    </TABLE>";
			echo "  </TD>";
            echo "</TR>";
			echo "</B>";

            echo "</TABLE><BR>";
           
            echo "<TABLE CELLSPACING=10>";
            echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcomisiones.php?mes=$mes\&ano=$ano\&sucursal=$sucursal\&login=$login\&casos=".str_replace("�",chr(92).chr(34),$casos)."\"'></TH>";  // Cancela la operaci�n
            echo "</TABLE>";
            echo "</FORM>";
            echo "</CENTER>";
//          echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en L�nea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en l�nea
            require_once("footer.php");
echo "</BODY>";
            echo "</HTML>";
            break;
           }
		}
   }
?>