<?php
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
// Archivo:       GRATRAFICOS.PHP                                             \\
// Creado:        2004-05-11                                                  \\
// Autor:         Carlos Gilberto López M.                                    \\
// Ver:           1.00                                                        \\
// Updated:       2004-05-11                                                  \\
//                                                                            \\
// Descripción:   Reporte sobre Movimiento de Carga por Tráfico               \\
//                                                                            \\
//                                                                            \\
// Copyright:     Coltrans S.A. - 2004                                        \\
/*================-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
*/

$titulo = 'Movimiento de Carga FCL por Tráfico';

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
    echo "<FORM METHOD=post NAME='menuform' ACTION='gratraficos.php'>";
	echo "<TABLE WIDTH=400 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
    echo "<TH COLSPAN=6 style='font-size: 12px; font-weight:bold;'><B>Ingrese los parámetros para el Reporte</TH>";

    echo "<TR>";
    echo "  <TD Class=captura ROWSPAN=2></TD>";
	echo "  <TD Class=listar>Año a Consultar:<BR><SELECT NAME='ano'>";
	for ( $i=5; $i>=0; $i-- ){
		  echo " <OPTION VALUE=".(date('Y')-$i)." SELECTED>".(date('Y')-$i)."</OPTION>";
		}
	echo "  </SELECT></TD>";
	$tm =& DlRecordset::NewRecordset($conn);
	if (!$tm->Open("select ca_idtrafico, ca_nombre from vi_traficos order by ca_nombre")) {       // Selecciona todos lo registros de la tabla Traficos
	    echo "<script>alert(\"".addslashes($rs->mErrMsg)."\");</script>";      // Muestra el mensaje de error
	    echo "<script>document.location.href = 'gratraficos.php';</script>";
	    exit; }
	$tm->MoveFirst();
	echo " <TD Class=mostrar>Tráfico :<BR><SELECT NAME='traorigen'>";
	echo " <OPTION VALUE=%>Todos los Tráficos</OPTION>";
	while ( !$tm->Eof()) {
			echo " <OPTION VALUE=".$tm->Value('ca_nombre').">".$tm->Value('ca_nombre')."</OPTION>";
	        $tm->MoveNext();
	      }
    echo "  </TD>";
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
    $modulo = "00100000";                                                      // Identificación del módulo para la ayuda en línea
//  include_once 'include/seguridad.php';                                      // Control de Acceso al módulo

	$condicion= "where substr(ca_mes,4,1) = '".substr($ano, -1)."' and ca_traorigen like '%$traorigen%'";

    $fc =& DlRecordset::NewRecordset($conn);
    if (!$fc->Open("select substr(ca_mes,4,1) as ca_ano, ca_traorigen, ca_capacidad, sum(ca_cantidad) as ca_cantidad from vi_inocarga_fcl $condicion group by ca_ano, ca_traorigen, ca_capacidad order by ca_traorigen, ca_capacidad")) {                       // Selecciona todos lo registros de la tabla Ino-Marítimo
        echo "<script>alert(\"".addslashes($fc->mErrMsg)."\");</script>";      // Muestra el mensaje de error
        echo "<script>document.location.href = 'entrada.php';</script>";
        exit; }
	$traficos = array();
	$cont_20  = array();
	$cont_40  = array(); 
	while (!$fc->Eof() and !$fc->IsEmpty()) {
 	if (!in_array($fc->Value('ca_traorigen'), $traficos)) {
 		array_push($traficos, $fc->Value('ca_traorigen'));
 	    array_push($cont_20, 0);
 	    array_push($cont_40, 0);
 		}
 	$pos_mem = 0;
 	reset($traficos);
 	while (list ($clave, $val) = each ($traficos)) {
 		if ($val == $fc->Value('ca_traorigen')) {
 			$pos_mem = $clave;
 			break;
 			}
 		}
	 	if ($fc->Value('ca_capacidad') == 20) {
	 	    $cont_20[$clave] = $fc->Value('ca_cantidad');
	 		}
	 	else if ($fc->Value('ca_capacidad') == 40) {
	 	    $cont_40[$clave] = $fc->Value('ca_cantidad');
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
	$graph->xaxis->SetTickLabels($traficos);
	
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
	
	$graph->subtitle->Set('Acumulado Año '.$ano);
	
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
	$bplot1->value->SetColor('white');
	$bplot1->value->SetAngle(45);
	
	// Setup the values that are displayed on top of each bar
	$bplot2->value->Show();
	$bplot2->value->SetFont(FF_ARIAL,FS_NORMAL,8);
	$bplot2->value->SetFormat('%d');
	$bplot2->value->SetColor('white');
	$bplot2->value->SetAngle(45);
	
	$gbarplot = new GroupBarPlot(array($bplot1,$bplot2));
	$gbarplot->SetWidth(0.6);
	$graph->Add($gbarplot);
	
	$graph->Stroke();
    }
?>