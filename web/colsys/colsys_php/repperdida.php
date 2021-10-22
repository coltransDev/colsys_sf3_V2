<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       REPGERENCIA.PHP                                             \\
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

$titulo = 'Informe para Gerencia Cuadro INO';
$meses  = array( "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );
$estados = array("Casos Cerrados" => "ca_usucerrado <> \"\"","Casos Abiertos" => "ca_referencia not in (select ca_referencia from tb_inomaestra_sea where ca_usucerrado <> \"\")","Todos los Casos" => "true");

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexiòn a la base de datos
if (!isset($traorigen) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    ?>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?php
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='repgerencia.php'>";
	echo "<TABLE WIDTH=550 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=7 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
	echo "  <TD Class=listar>Año a Consultar:<BR><SELECT NAME='ano'>";
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
	    echo "<script>document.location.href = 'repgerencia.php';</script>";
	    exit; }
	$tm->MoveFirst();
	echo "  <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
	echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
	while ( !$tm->Eof()) {
			echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
	        $tm->MoveNext();
	      }
    echo "  </TD>";
    echo "  <TD Class=listar ROWSPAN=2>Estados:<BR><SELECT NAME='casos'>";
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
elseif (!isset($boton) and !isset($accion) and isset($traorigen)){
	SetCookie ("cadena", $criterio);
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

	$condicion= "where substr(ca_referencia,8,2) = '$mes' and substr(ca_referencia,15) = ".substr($ano, -1)." and ca_traorigen like '%$traorigen%' and ". str_replace("\"","'",$casos)." order by ca_traorigen, ca_referencia";
	
    if (!$rs->Open("select * from vi_inomaestra_sea $condicion")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }

    $cl =& DlRecordset::NewRecordset($conn);
    $eq =& DlRecordset::NewRecordset($conn);
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
    echo "<FORM METHOD=post NAME='informe' ACTION='repgerencia.php'>";             // Hace una llamado nuevamente a este script pero con
    echo "<TABLE WIDTH=670 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TR>";
    echo "  <TH Class=titulo COLSPAN=7>".COLTRANS."<BR>$titulo<BR>$meses[$mes]/$ano</TH>";
    echo "</TR>";
    echo "<TH>Referencia</TH>";
    echo "<TH>Origen</TH>";
    echo "<TH>Destino</TH>";
    echo "<TH COLSPAN=2>Linea</TH>";
    echo "<TH COLSPAN=2>Carga</TH>";
	$nom_tra = '';
    while (!$rs->Eof() and !$rs->IsEmpty()) {                                                      // Lee la totalidad de los registros obtenidos en la instrucción Select
       if (!$eq->Open("select ca_concepto, sum(ca_cantidad) as ca_cantidad from vi_inoequipos_sea where ca_referencia = '".$rs->Value('ca_referencia')."' group by ca_concepto")) {       // Selecciona todos lo registros de la tabla Traficos
           echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'reporteventas.php';</script>";
           exit; }
       $eq->MoveFirst();

	   if ($nom_tra != $rs->Value('ca_traorigen')) {
	       echo "<TR>";
		   echo "  <TD Class=invertir style='font-weight:bold;' COLSPAN=7>".strtoupper($rs->Value('ca_traorigen'))."</TD>";
	       echo "</TR>";
		   $nom_tra = $rs->Value('ca_traorigen');
		   $sub_fac = 0; $sub_cos = 0; $sub_ded = 0; $sub_ing = 0; $sub_utl = 0;
		  }

	   $ext_mem = $rs->Value('ca_comisionable') + $rs->Value('ca_nocomisionable');
	   $utl_cbm = ($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad')) / $rs->Value('ca_volumen');
       echo "<TR>";
       echo "  <TD Class=titulo COLSPAN=7></TD>";
       echo "</TR>";
       echo "<TR>";
       echo "  <TD Class=listar style='font-weight:bold; font-size: 9px;' onMouseOver=\"uno(this,'CCCCCC');\" onMouseOut=\"dos(this,'F0F0F0');\" onclick='javascript:window.open(\"inosea.php?boton=Consultar\&id=".$rs->Value('ca_referencia')."\");'>".$rs->Value('ca_referencia')."</TD>";
       echo "  <TD Class=listar>".$rs->Value('ca_ciuorigen')."</TD>";
       echo "  <TD Class=listar>".$rs->Value('ca_ciudestino')."</TD>";
       echo "  <TD Class=listar COLSPAN=2>".$rs->Value('ca_nombre')."</TD>";
       echo "  <TD Class=listar COLSPAN=2>";
	   while (!$eq->Eof() and !$eq->IsEmpty()) {
	          echo $eq->Value('ca_cantidad')." ".$eq->Value('ca_concepto');
			  $eq->MoveNext();
			  if (!$eq->Eof()) {
			      echo "<BR>";
			  }
	         }
       echo "  </TD>";
       echo "</TR>";

       if (!$cl->Open("select * from vi_inoclientes_sea where ca_referencia = '".$rs->Value('ca_referencia')."'")) {       // Selecciona todos lo registros de la tabla Traficos
           echo "<script>alert(\"".addslashes($cl->mErrMsg)."\");</script>";      // Muestra el mensaje de error
           echo "<script>document.location.href = 'reporteventas.php';</script>";
           exit; }
       $cl->MoveFirst();
	   $imp_tit = true;
	   $num_reg = $cl->GetRowCount()+1;
	   $estados = ($rs->Value('ca_usucerrado')!='')?"background: #CCCCCC":"background: #FF6666";
	   $mensaje = ($rs->Value('ca_usucerrado')!='')?"Caso<br>Cerrado":"Caso<br>Abierto";
	   echo "<TR>";
	   echo " <TD Class=invertir COLSPAN=7>";
	   while (!$cl->Eof() and !$cl->IsEmpty()) {
		   if ($imp_tit) {
		       echo "<TABLE WIDTH=668 CELLSPACING=1>";
		       echo "<TR>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Cliente</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>No.Piezas</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Peso</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Volumen</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Vendedor</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Factura</TD>";
			   echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Valor</TD>";
		       echo "    <TD Class=invertir style='font-weight:bold; font-size: 8px; text-align: center;'>Util.xCliente:</TD>";
		       echo "    <TD Class=invertir ROWSPAN=$num_reg WIDTH=30 style='font-weight:bold; font-size: 8px; text-align: center; vertical-align:middle; $estados'>$mensaje</TD>";
			   echo "</TR>";
			   $imp_tit = false;
		      }
		   echo "<TR>";
	       echo "    <TD Class=imprimir style='font-size: 9px;'>".substr($cl->Value('ca_compania'),0,35)."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".$cl->Value('ca_numpiezas')."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".$cl->Value('ca_peso')."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".$cl->Value('ca_volumen')."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".$cl->Value('ca_login')."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".$cl->Value('ca_factura')."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".number_format($cl->Value('ca_valor'))."</TD>";
	       echo "    <TD Class=valores style='font-size: 9px; background: #FFFFFF'>".number_format($utl_cbm * $cl->Value('ca_volumen'))."</TD>";
		   echo "</TR>";
		   $cl->MoveNext();
		  }
	   if (!$cl->IsEmpty()) {
	       echo "  </TABLE>";
		  }
	   echo " </TD>";
	   echo "</TR>";

	   echo "<TR>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Facturación Clientes:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Costo Neto Embarque:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Menos Deducciones:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Ingr. Sobreventa:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Utilidad Consolidado:<BR></TD>";
       echo "  <TD Class=invertir style='font-weight:bold; font-size: 8px;'>Utilidad x CBM:<BR></TD>";
	   echo "</TR>";
	   $utl_mem  = ($rs->Value('ca_facturacion') - $rs->Value('ca_deduccion') - $rs->Value('ca_utilidad'));
	   $back_col = ($utl_mem<=0)?" background: #FF6666":" ";
	   
	   echo "<TR>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($rs->Value('ca_facturacion'))."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>(".number_format($rs->Value('ca_costoneto')).")</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>(".number_format($rs->Value('ca_deduccion')).")</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>(".number_format($ext_mem).")</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_mem)."</TD>";
       echo "  <TD Class=valores style='font-size: 9px;$back_col'>".number_format($utl_cbm)."</TD>";
	   echo "</TR>";
       $sub_fac+= $rs->Value('ca_facturacion');
	   $sub_cos+= $rs->Value('ca_costoneto');
	   $sub_ded+= $rs->Value('ca_deduccion');
	   $sub_ing+= $ext_mem;
	   $sub_utl+= $utl_mem;
       $rs->MoveNext();
	   if ($nom_tra != $rs->Value('ca_traorigen') or $rs->Eof()) {
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=7></TD>";
           echo "</TR>";
		   echo "<TR>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_fac)."</TD>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($sub_cos).")</TD>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($sub_ded).")</TD>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($sub_ing).")</TD>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($sub_utl)."</TD>";
	       echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>TOTAL ".strtoupper($nom_tra)."</TD>";
		   echo "</TR>";
           echo "<TR HEIGHT=5>";
           echo "  <TD Class=titulo COLSPAN=7></TD>";
           echo "</TR>";
           $tot_fac+= $sub_fac; $tot_cos+= $sub_cos; $tot_ded+= $sub_ded; $tot_ing+= $sub_ing; $tot_utl+= $sub_utl;
	      }
       }
      echo "<TR HEIGHT=5>";
      echo "  <TD Class=titulo COLSPAN=7></TD>";
      echo "</TR>";
      echo "<TR>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_fac)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($tot_cos).")</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($tot_ded).")</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>(".number_format($tot_ing).")</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>".number_format($tot_utl)."</TD>";
      echo "  <TD Class=valores style='font-weight:bold; font-size: 9px; background: #1D3F99; color: #FFFFFF;'>GRAN TOTAL ".strtoupper($meses[$mes])."</TD>";
      echo "</TR>";
      echo "<TR HEIGHT=5>";
      echo "  <TD Class=titulo COLSPAN=7></TD>";
      echo "</TR>";

    echo "</TABLE><BR><BR>";

    if (!$rs->Open("select count(ca_referencia) as ca_numero from vi_inomaestra_sea where ca_usucerrado != '' and substr(ca_referencia,8,2) = '$mes' and substr(ca_referencia,15) = ".substr($ano, -1))) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	$cas_cerrados = $rs->Value('ca_numero');

    if (!$rs->Open("select count(ca_referencia) as ca_numero from vi_inomaestra_sea where substr(ca_referencia,8,2) = '$mes' and substr(ca_referencia,15) = ".substr($ano, -1))) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	$cas_totales = $rs->Value('ca_numero');

    echo "<TABLE WIDTH=200 CELLSPACING=1>";                                    // un boton de comando definido para hacer mantemientos
    echo "<TH Class=titulo COLSPAN=2>RESUMEN PARA EL PERIODO $meses[$mes]/$ano</TH>";
    echo "<TR>";
	echo "  <TD Class=listar>Casos Cerrados :</TD>";
	echo "  <TD Class=listar>$cas_cerrados</TD>";
    echo "</TR>";
    echo "<TR>";
	echo "  <TD Class=listar>Casos Abiertos :</TD>";
	echo "  <TD Class=listar>".($cas_totales - $cas_cerrados)."</TD>";
    echo "</TR>";
    echo "<TR>";
	echo "  <TD Class=listar>Total Casos Trabajados:</TD>";
	echo "  <TD Class=listar>".$cas_totales."</TD>";
    echo "</TR>";
    echo "</TABLE><BR>";
	
    echo "<TABLE CELLSPACING=10>";
    echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"repgerencia.php\"'></TH>";  // Cancela la operación
    echo "</TABLE>";
    echo "</FORM>";
    echo "</CENTER>";
//  echo "<P DIR='RTL'><A HREF=\"#\" ONCLICK='javascript:window.open(\"./help/$modulo.html\",\"Ayuda\",\"scrollbars=yes,width=600,height=400,top=200,left=150\")'><IMG SRC='./graficos/help.gif' border=0 ALT='Ayuda en Línea'><BR>Ayuda</A></P>";  // Link que proporciona la Ayuda en línea
    require_once("footer.php");
echo "</BODY>";
    echo "</HTML>";
    }
?>