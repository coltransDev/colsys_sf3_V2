<?
$programa = 57;
  
  require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta
  $titulo = 'Generador de Reportes Gerenciales - '.COLTRANS;
  if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
      echo "<script>document.location.href = 'entrada.php';</script>";
     }

  echo "<HTML>";
  echo "<HEAD>";
  echo "<TITLE>$titulo</TITLE>";

  echo "<style type='text/css'>";
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
  echo "<FORM METHOD=post NAME='tabla' ACTION='reporteadorExpo.php'>";

  echo "<TABLE WIDTH=470 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
  echo "<TR>";
  echo "  <TH COLSPAN=2>Sistema Administrador de Referencias de Exportaci�n<BR>$titulo</TH>";
  echo "</TR>";
  echo "<TD Class=titulo WIDTH=110>Nombre</TD>";
  echo "<TD Class=titulo>Detalle</TD>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepInoExpoEntradaAction.do'; class='mudacor'>Cuadro INO</A></TD><TD Class=mostrar>Informe para Gerencia Cuadro INO</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/ReporteExpoComisionAction.do?comision=1'; class='mudacor'>Comisiones</A></TD><TD Class=mostrar>Informe de Comisiones para Vendedores</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/ReporteExpoComisionAction.do?comision=2'; class='mudacor'>Movimiento Vendedor</A></TD><TD Class=mostrar>Informe de Movimiento de Carga y Comisiones para Vendedores</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepExpoUtilidadAction.do'; class='mudacor'>An�lisis de Utilidades</A></TD><TD Class=mostrar>Informe An�lisis de Utilidades por Referencia</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepExpoCargaSucLineaAction.do'; class='mudacor'>Carga por Surcursales</A></TD><TD Class=mostrar>Informe Movimiento de Carga por Sucursal y Transportador</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepExpoConsolidadoAction.do'; class='mudacor'>Consolidado de Casos</A></TD><TD Class=mostrar>Consolidaci�n de Referencias detallada por Tr�ficos</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RExpoFactHijaEntrada.jsp'; class='mudacor'>Facturaci�n a Clientes</A></TD><TD Class=mostrar>Informe con Sumatoria de Facturas y referencias por Cliente</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/BusquedaRepExpoRefAction.do'; class='mudacor'>Libro de Referencias</A></TD><TD Class=mostrar>Informe de Referencias Procesadas</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepAuditoriaAction.do?cliente=2'; class='mudacor'>Reporte de Auditoria</A></TD><TD Class=mostrar>Informe sobre Rastros de Auditor�a</TD>";
  echo "</TR>";
  echo "</TABLE><BR><BR>";

  echo "<TABLE CELLSPACING=10>";
  echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
  echo "</TABLE>";
  echo "</CENTER>";
  require_once("footer.php");
echo "</BODY>";
  echo "</HTML>";
?>