<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPCOMISIONES_SUC.PHP                                       \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte de Cuadro INO para Gerencia.                        \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$programa = 25;

$titulo = 'Informe de Comisiones para Vendedores';
$meses  = array( "" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_estado <> \"Abierto\"","Cierre Provisional" => "ca_estado = \"Provisional\"","Casos Abiertos" => "ca_estado = \"Abierto\"","Todos los Casos" => "true");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 
set_time_limit(0);
$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($login) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";     // Código en JavaScript para validar las opciones de mantenimiento
    echo "function llenar_vendedores(){";
	echo "  source = document.getElementById('sucursal');";
	echo "  elemento = document.getElementById('login');";
    echo "  elemento.length = 0;";
    echo "  elemento.options[elemento.length] = new Option();";
    echo "  elemento.length = 0;";
    echo "  elemento[elemento.length] = new Option('Vendedores (Todos)','',false,true);";
    echo "     for (cont=0; cont<document.menuform.usu_login.length; cont++) {";
    echo "          if (source.value == document.menuform.usu_sucursal[cont].value){";
    echo "              elemento[elemento.length] = new Option(document.menuform.usu_nombre[cont].value,document.menuform.usu_login[cont].value,false,false);";
    echo "           }";
    echo "       }";
    echo "}";
    echo "</script>";
    echo "<script language='javascript' src='javascripts/popcalendar.js'></script>";
    echo "</HEAD>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repcomisiones_suc.php'>";
    echo "<TABLE WIDTH=530 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
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
    echo "  <TD Class=listar>Año:<BR><SELECT NAME='ano'>";
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
    $tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select distinct ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'repcomisiones_suc.php';</script>";
        exit; }
    $tm->MoveFirst();
    echo "  <TD Class=mostrar>Sucursal:<BR><SELECT NAME='sucursal' ONCHANGE='llenar_vendedores();'>";
    echo "  <OPTION VALUE=''>Sucursales (Todas)</OPTION>";
    $tm->MoveFirst();
    while (!$tm->Eof()) {
		   echo "<OPTION VALUE='".$tm->Value('ca_sucursal')."'>".$tm->Value('ca_sucursal')."</OPTION>";
           $tm->MoveNext();
          }
	
    echo "  </SELECT></TD>";
    echo "  <TD Class=mostrar>Vendedor:<BR><SELECT NAME='login'>";                 // Llena el cuadro de lista con los valores de la tabla Vendedores
    echo "  <OPTION VALUE=''>Vendedores (Todos)</OPTION>";
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
elseif (!isset($boton) and !isset($accion) and isset($login)){
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo
    
    $condicion="where 1=1 ";
    if($mes)
        $condicion.=" and ca_mes::text = '$mes' ";
    if($ano)
        $condicion.=" and ca_ano::text = '$ano' ";
    if($sucursal)
        $condicion.=" and ca_sucursal = '$sucursal' ";
    if($login)
        $condicion.=" and ca_login = '$login' ";
    
    $condicion .= "   and ".str_replace("\"","'",$casos);
    
    $sql="select * 
        ,(array_to_string(ARRAY( select ca_factura from vi_inoingresos_sea i where i.ca_idinocliente=c.ca_idinocliente),'<br>')) as ca_facturas
        from vi_inocomisiones_sea c $condicion ";

    //$condicion = "where ca_mes::text like '$mes' and ca_ano::text = '$ano' and ca_sucursal like '%$sucursal%' and ca_login like '$login' and ".str_replace("\"","'",$casos);
    //echo $sql;
    if (!$rs->Open($sql)) {
        echo "Error 137: $sql";
        //echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        //echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
    $us =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
    $fc =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos

    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "<script language='JavaScript' type='text/JavaScript'>";              // Código en JavaScript para validar las opciones de mantenimiento
    echo "function elegir(opcion, id, cl){";
    echo "    document.location.href = 'repcomisiones_suc.php?boton='+opcion+'\&id='+id+'\&cl='+cl;";
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repcomisiones_suc.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=780 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=9>".COLTRANS."<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Cliente</TH>";
    echo "<TH>Facturas</TH>";
    echo "<TH>Vlr Facturado</TH>";
    echo "<TH>Estado</TH>";
    echo "<TH>Volumen CMB</TH>";
    echo "<TH>Utilidad</TH>";
    echo "<TH COLSPAN=2>Util. en Sobreventa</TH>";
    $log_ven = '';
    $ref_mem = '';
    $nom_cli = '';
    $hbl_cli = '';
    $utl_tot = 0;
    $sob_tot = 0;
    $con_tot = 0;
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       $utl_cbm = ($rs->Value('ca_facturacion_r') - $rs->Value('ca_deduccion_r') - $rs->Value('ca_utilidad_r')) / $rs->Value('ca_volumen_r');
       if ($log_ven != $rs->Value('ca_login')) {
           if (!$us->Open("select ca_nombre from control.tb_usuarios where ca_login = '".$rs->Value('ca_login')."'")) {
               echo "<script>alert(\"".addslashes($us->mErrMsg)."\");</script>";
               echo "<script>document.location.href = 'repcomisiones_suc.php';</script>";
               exit; }
           echo "<TR>";
           echo "  <TD Class=listar COLSPAN=9 style='font-weight:bold; font-size: 10px;'>".strtoupper($us->Value('ca_nombre'))."</TD>";
           echo "</TR>";
           $cmb_ven = 0;
           $utl_con = 0;
           $sob_ven = 0;
           $log_ven = $rs->Value('ca_login');
           $nom_ven = $us->Value('ca_nombre'); }
       $back_col= ($rs->Value('ca_estado')=='Provisional')?" background: #CCCC99":(($rs->Value('ca_estado')=='Abierto')?" background: #CCCCCC":" ");
       $back_col= ($utl_cbm<=0)?" background: #FF6666":$back_col;
       
       /*if (!$fc->Open("select ca_factura from vi_inoingresos_sea where ca_idinocliente = '".$rs->Value('ca_idinocliente')."' ")) {
           echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";
           echo "<script>document.location.href = 'repcomisiones_suc.php';</script>";
           exit; }
       $fc->MoveFirst();
       $fac_mem = '';
       while (!$fc->Eof()) {
          $fac_mem.= $fc->Value('ca_factura').'<BR>';
          $fc->MoveNext();
       }
       $fac_mem = substr($fac_mem,0,strlen($fac_mem)-4);
        * 
        */
       $utl_net = ($rs->Value('ca_vlrutilidad_liq') != 0) ? $rs->Value('ca_vlrutilidad_liq') : $rs->Value('ca_volumen') * $utl_cbm;
       echo "<TR>";
       echo "  <TD Class=listar  style='font-weight:bold; font-size: 9px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
       echo "  <TD Class=listar  style='font-size: 9px;$back_col'>".substr(ucwords(strtolower($rs->Value('ca_compania'))),0,30)."</TD>";
       echo "  <TD Class=listar  style='font-size: 9px;$back_col'>".$rs->Value('ca_facturas')."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_valor'))."</TD>";
       echo "  <TD Class=listar  style='font-size: 9px;$back_col'>".$rs->Value('ca_estado')."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".$rs->Value('ca_volumen')."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_net)."</TD>";
       $ref_mem = $rs->Value('ca_referencia');
       $nom_cli = $rs->Value('ca_compania');
       $hbl_cli = $rs->Value('ca_hbls');
       $utl_con+= $utl_net;
       $cmb_ven+= $rs->Value('ca_volumen');
       $mul_lin = false;
       $arr_fac = array();
       while ($ref_mem == $rs->Value('ca_referencia') and $nom_cli == $rs->Value('ca_compania') and $hbl_cli == $rs->Value('ca_hbls') and !$rs->Eof()) {
           $imp_mem = (in_array($rs->Value('ca_factura_ded'),$arr_fac))?false:true;
           if ($imp_mem and $mul_lin) {
               echo "</TR>";
               echo "<TR>";
               echo "  <TD Class=listar COLSPAN=7>&nbsp;</TD>";
           }
           if ($imp_mem and $rs->Value('ca_valor_ded') != 0) {
               echo "  <TD Class=listar style='font-size: 9px;'>".str_replace(" ","&nbsp;","&nbsp;".$rs->Value('ca_costo_ded'))."</TD>";
               echo "  <TD Class=valores style='font-size: 9px;'>".number_format($rs->Value('ca_valor_ded'))."</TD>";
               $sob_ven+= $rs->Value('ca_valor_ded');
               array_push($arr_fac,$rs->Value('ca_factura_ded'));
               $mul_lin = true;
              }
           else if ($imp_mem) {
               echo "  <TD Class=listar>&nbsp;</TD>";
               echo "  <TD Class=listar>&nbsp;</TD>";
               array_push($arr_fac,$rs->Value('ca_factura_ded'));
              }
           $rs->MoveNext();
          }
       echo "</TR>";
       if ($log_ven != $rs->Value('ca_login') or $rs->Eof()) {
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=9></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=5>Totales por Vendedor :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($cmb_ven,2)."</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_con)."</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>&nbsp;Sobreventa :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;".number_format($sob_ven)."</TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=invertir COLSPAN=9></TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=6>Comisión en Ventas :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_con*$rs->Value('ca_porcentaje'))."</TD>";
            echo "  <TD Class=listar style='font-weight:bold;'>&nbsp;Com. Sobreventa :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;&nbsp;".number_format($sob_ven*$rs->Value('ca_porcentaje'))."</TD>";
            echo "</TR>";
            echo "<TR>";
            echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=8>Gran Total para ".ucwords(strtolower($nom_ven))." :</TD>";
            echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_con*$rs->Value('ca_porcentaje')+$sob_ven*$rs->Value('ca_porcentaje'))."</TD>";
            echo "</TR>";
            echo "<TR HEIGHT=5>";
            echo "  <TD Class=titulo COLSPAN=9></TD>";
            echo "</TR>";
            $cmb_tot+= $cmb_ven;
            $utl_tot+= $utl_con;
            $sob_tot+= $sob_ven;
           }
       }
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=imprimir COLSPAN=9></TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=9></TD>";
    echo "</TR>";
    echo "<TR>";
    echo "  <TD Class=Valores style='font-weight:bold;' COLSPAN=5>Totales del Informe:</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($cmb_tot,2)."</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($utl_tot)."</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>&nbsp;Total Sobreventa:</TD>";
    echo "  <TD Class=valores style='font-weight:bold;'>".number_format($sob_tot)."</TD>";
    echo "</TR>";
    echo "<TR HEIGHT=5>";
    echo "  <TD Class=titulo COLSPAN=9></TD>";
    echo "</TR>";
    echo "</TABLE><BR>";

    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repcomisiones_suc.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>