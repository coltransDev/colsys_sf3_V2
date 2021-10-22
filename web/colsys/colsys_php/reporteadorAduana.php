<?
$programa = 55;

$titulo = 'Generador de Reportes Gerenciales - Colmas SAS.';
require_once("checklogin.php");                                                                 // Captura las variables de la sessión abierta
if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessión
    echo "<script>document.location.href = 'entrada.php';</script>";
}

echo "<HTML>";
echo "<HEAD>";
echo "<TITLE>$titulo</TITLE>";

echo "<style type='text/css'>";
echo "<!--";
echo ".mudacor { color: #0066FF}";
echo ".mudacor:hover { color: #FF6600}";
echo "-->";
echo "</style>";
?>
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<?php
echo "</HEAD>";
echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";
echo "<BODY>";
require_once("menu.php");
echo "<BR>";
echo "<CENTER>";
echo "<FORM METHOD=post NAME='tabla' ACTION='reporteadorAduana.php'>";
echo "<TABLE WIDTH=470 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
echo "<TR>";
echo "  <TH COLSPAN=2>Sistema Administrador de Referencias de Aduanas<BR>$titulo</TH>";
echo "</TR>";
echo "<TD Class=titulo WIDTH=110>Nombre</TD>";
echo "<TD Class=titulo>Detalle</TD>";
echo "<TR>";
echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepInoBrkEntradaAction.do'; class='mudacor'>Cuadro INO</A></TD><TD Class=mostrar>Informe para Gerencia Cuadro INO</TD>";
echo "</TR>";
echo "<TR>";
echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/ReporteBrkComisionAction.do?comision=1'; class='mudacor'>Comisiones</A></TD><TD Class=mostrar>Informe de Comisiones para Vendedores</TD>";
echo "</TR>";
echo "</TABLE><BR><BR>";

echo "<TABLE CELLSPACING=10>";
echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operación
echo "</TABLE>";
echo "</CENTER>";
require_once("footer.php");
echo "</BODY>";
echo "</HTML>";
?>