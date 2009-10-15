<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       GRASUCURSAL.PHP                                             \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto L�pez M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripci�n:   Reporte sobre Movimiento de Carga por Sucursales            \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Movimiento de Carga FCL por Sucursales';
$meses  = array( "%" => "Todos los Meses", "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio", "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre" );

include_once 'include/datalib.php';                                            // Incorpora la libreria de funciones, para accesar leer bases de datos
require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
 

$rs =& DlRecordset::NewRecordset($conn);                                       // Apuntador que permite manejar la conexi�n a la base de datos
if (!isset($sucursal) and !isset($boton) and !isset($accion)){
    echo "<HTML>";
    echo "<HEAD>";
    echo "<TITLE>$titulo</TITLE>";
    echo "</HEAD>";
    echo "<BODY>";
require_once("menu.php");
    echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
    echo "<CENTER>";
    echo "<H3>$titulo</H3>";
    echo "<FORM METHOD=post NAME='menuform' ACTION='grasucursalfcl.php'>";
	echo "<TABLE WIDTH=500 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=5 style='font-size: 12px; font-weight:bold;'><B>Ingrese los par�metros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
	echo "  <TD Class=listar>A�o a Consultar:<BR><SELECT NAME='ano'>";
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
	if (!$tm->Open("select ca_nombre as ca_sucursal from control.tb_sucursales order by ca_sucursal")) {       // Selecciona todos lo registros de la tabla Sucursales
	    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
	    echo "<script>document.location.href = 'grasucursalfcl.php';</script>";
	    exit; }
	echo "  <TD Class=mostrar>Sucursal :<BR><SELECT NAME='sucursal'>";
	echo " <OPTION VALUE=%>Todas las Sucursales</OPTION>";
	while ( !$tm->Eof()) {
			echo " <OPTION VALUE=".$tm->Value('ca_sucursal').">".$tm->Value('ca_sucursal')."</OPTION>";
	        $tm->MoveNext();
	      }
    echo "  </TD>";
	echo "  <TH style='vertical-align:bottom;'><INPUT Class=submit TYPE='SUBMIT' NAME='buscar' VALUE='  Buscar  ' ONCLIK='menuform.submit();'></TH>";
    echo "</TR>";

    echo "<TR HEIGHT=5>";
    echo "  <TD Class=captura COLSPAN=4></TD>";
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
elseif (!isset($boton) and !isset($accion) and isset($sucursal)){
	$modulo = "00100100";                                             // Identificaci�n del m�dulo para la ayuda en l�nea
//	include_once 'include/seguridad.php';                             // Control de Acceso al m�dulo
	echo "<HEAD>";
	echo "<TITLE>$titulo</TITLE>";
	echo "</HEAD>";
	echo "<BODY>";
require_once("menu.php");
	echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";             // Carga una hoja de estilo que estandariza las pantallas den sistema graficador
	echo "<CENTER>";
	echo "<TABLE CELLSPACING=1 WIDTH='830' HEIGHT='650'>";
	echo "<TR>";
	echo "  <TD Class=invertir><iframe ID=consulta_tar src ='grasucursalfcl.php?accion=Imprimir&ano=$ano&mes=$mes&sucursal=$sucursal' width='100%' height='100%'></iframe></TD>";
	echo "</TR>";
	echo "</TABLE>";
	echo "<TABLE CELLSPACING=10>";
	echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='accion' VALUE='Regresar' ONCLICK='javascript:document.location.href = \"grasucursalfcl.php\"'></TH>";  // Cancela la operaci�n
	echo "</TABLE>";
	echo "</CENTER>";
    }
elseif (!isset($boton) and isset($accion) and isset($sucursal)){
    $modulo = "00100000";                                                      // Identificaci�n del m�dulo para la ayuda en l�nea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al m�dulo

	$condicion= "where ca_mes like '".$mes."-".substr($ano, -1)."' and ca_sucursal like '$sucursal'";

    $fc =& DlRecordset::NewRecordset($conn);
    if (!$fc->Open("select substr(ca_mes,4,1) as ca_ano, ca_sucursal, ca_capacidad, sum(ca_cantidad) as ca_cantidad from vi_inocarga_fcl $condicion group by ca_ano, ca_sucursal, ca_capacidad order by ca_sucursal, ca_capacidad")) {                       // Selecciona todos lo registros de la tabla Ino-Mar�timo
        echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	$sucursales = array();
	$cont_20  = array();
	$cont_40  = array(); 
	while (!$fc->Eof() and !$fc->IsEmpty()) {
	 	if (!in_array($fc->Value('ca_sucursal'), $sucursales)) {
	 		array_push($sucursales, $fc->Value('ca_sucursal'));
	 	    array_push($cont_20, 0);
	 	    array_push($cont_40, 0);
	 		}
	 	$pos_mem = 0;
	 	reset($sucursales);
	 	while (list ($clave, $val) = each ($sucursales)) {
	 		if ($val == $fc->Value('ca_sucursal')) {
	 			$pos_mem = $clave;
	 			break;
	 			}
	 		}
		 	if ($fc->Value('ca_capacidad') == 20) {
		 	    $cont_20[$clave]+= $fc->Value('ca_cantidad');
		 		}
		 	else if ($fc->Value('ca_capacidad') == 40 or $fc->Value('ca_capacidad') == 45) {
		 	    $cont_40[$clave]+= $fc->Value('ca_cantidad');
		 		}
	 	$fc->MoveNext();
   	}
	
	include ("include/jpgraph.php");
	include ("include/jpgraph_bar.php");
	
	// Create the basic graph
	$graph = new Graph(800,600,'auto');    
	$graph->SetScale("textlin");
	$graph->img->SetMargin(40,40,100,70);
	
	// Adjust the position of the legend box
	$graph->legend->Pos(0.02,0.15);
	
	// Adjust the color for theshadow of the legend
	$graph->legend->SetShadow('darkgray@0.5');
	$graph->legend->SetFillColor('lightblue@0.3');
	
	// Get localised version of the month names
	$graph->xaxis->SetTickLabels($sucursales);
	
	// Set a nice summer (in Stockholm) image
	$graph->SetBackgroundImage('graficos/FondoColtrans.jpg',BGIMG_COPY);
	
	$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
	$graph->xaxis->SetColor('white');
	$graph->xaxis->SetLabelAngle(40);
	
	$graph->yaxis->SetFont(FF_FONT1,FS_BOLD);
	$graph->yaxis->SetColor('white');
	
	//$graph->ygrid->Show(false);
	$graph->ygrid->SetColor('white@0.5');
	
	// Setup graph title
	$graph->title->Set($titulo);
	// Some extra margin (from the top)
	$graph->title->SetMargin(50);
	$graph->title->SetFont(FF_COMIC,FS_NORMAL,12);
	
	$graph->subtitle->Set($meses[$mes].'/'.$ano);
	
	// Create the three var series we will combine
	$bplot1 = new BarPlot($cont_20);
	$bplot2 = new BarPlot($cont_40);
	
	// Setup the colors with 40% transparency (alpha channel)
	$bplot1->SetFillColor('orange@0.4');
	$bplot2->SetFillColor('brown@0.4');
	
	// Setup legends
	$bplot1->SetLegend('Contenedores 20\'');
	$bplot2->SetLegend('Contenedores 40\'');
	
	// Setup each bar with a shadow of 50% transparency
	$bplot1->SetShadow('black@0.4');
	$bplot2->SetShadow('black@0.4');
	
	// Setup the values that are displayed on top of each bar
	$bplot1->value->Show();
	$bplot1->value->SetFont(FF_ARIAL,FS_NORMAL,8);
	$bplot1->value->SetFormat('%d');
	$bplot1->value->SetColor('orange');
	$bplot1->value->SetAngle(45);
	
	// Setup the values that are displayed on top of each bar
	$bplot2->value->Show();
	$bplot2->value->SetFont(FF_ARIAL,FS_NORMAL,8);
	$bplot2->value->SetFormat('%d');
	$bplot2->value->SetColor('darkorange');
	$bplot2->value->SetAngle(45);
	
	$gbarplot = new GroupBarPlot(array($bplot1,$bplot2));
	$gbarplot->SetWidth(0.6);
	$graph->Add($gbarplot);
	
	$graph->Stroke();
    }
?>