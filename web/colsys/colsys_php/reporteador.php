<?
  $programa = 58;  
  require_once("checklogin.php");                                                               // Captura las variables de la sessi�n abierta
  $titulo = 'Generador de Reportes Gerenciales - '.COLTRANS;
  if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
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

  echo "</HEAD>";
  echo "<STYLE>@import URL(\"Coltrans.css\");</STYLE>";
  echo "<BODY>";
require_once("menu.php");
  echo "<BR>";
  echo "<CENTER>";
  echo "<FORM METHOD=post NAME='tabla' ACTION='reporteador.php'>";
  echo "<TABLE WIDTH=510 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
  echo "<TR>";
  echo "  <TH COLSPAN=2>Sistema Administrador de Referencias Mar�timas<BR>$titulo</TH>";
  echo "</TR>";
  echo "<TD Class=titulo WIDTH=110>Nombre</TD>";
  echo "<TD Class=titulo>Detalle</TD>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repgerencia.php'; class='mudacor'>Cuadro INO</A></TD><TD Class=mostrar>Informe para Gerencia Cuadro INO</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repgenerator.php'; class='mudacor'>Generador de Informes</A></TD><TD Class=mostrar>M�dulo Contructor de Informes multimples opciones</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repcomisiones.php'; class='mudacor'>Comisiones</A></TD><TD Class=mostrar>Informe de Comisiones para Vendedores</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='reputilidades.php'; class='mudacor'>An�lisis de Utilidades</A></TD><TD Class=mostrar>Informe An�lisis de Utilidades por Referencia</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repcarga.php'; class='mudacor'>Carga por Surcursales</A></TD><TD Class=mostrar>Informe Movimiento de Carga por Sucursal</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repnavieras.php'; class='mudacor'>Carga por Navieras</A></TD><TD Class=mostrar>Informe Movimiento de Carga por Naviera</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='reptraficos.php'; class='mudacor'>Carga por Tr�ficos</A></TD><TD Class=mostrar>Informe Movimiento de Carga por Tr�fico</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repconsolidado.php'; class='mudacor'>Consolidado de Casos</A></TD><TD Class=mostrar>Consolidaci�n de Referencias detallada por Tr�ficos</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/reportesGer/listadoFacturas'; class='mudacor'>Elaboraci�n de Facturas</A></TD><TD Class=mostrar>Informe con Fecha de Creaci�n de facturas</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repreferencia.php'; class='mudacor'>Libro de Referencias</A></TD><TD Class=mostrar>Informe de Referencias Procesadas</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='repauditoria.php'; class='mudacor'>Reporte de Auditoria</A></TD><TD Class=mostrar>Informe sobre Rastros de Auditor�a</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='/reportesGer/reporteCargaTraficos'; class='mudacor'>Listado carga por Tr�ficos</A></TD><TD Class=mostrar>lista de cargas por tr�ficos</TD>";
  echo "</TR>";
  echo "</TABLE><BR><BR>";

  echo "<TABLE WIDTH=510 BORDER=0 CELLSPACING=1 CELLPADDING=5>";
  echo "<TR>";
  echo "  <TH COLSPAN=2>Gr�ficas Estadisticas</TH>";
  echo "</TR>";
  echo "<TD Class=titulo WIDTH=110>Nombre</TD>";
  echo "<TD Class=titulo>Detalle</TD>";
//  echo "<TR>";
//  echo "  <TD Class=mostrar><A HREF='grautilidad.php'; class='mudacor'>Distribuci�n Utilidad</A></TD><TD Class=mostrar>Estadistica sobre Distribuci�n de Utilidad por Sucursal</TD>";
//  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='gratraficosfcl.php'; class='mudacor'>Carga FCL por Tr�fico</A></TD><TD Class=mostrar>Estadistica del movimiento de Carga FCL por Tr�fico</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='gratraficoslcl.php'; class='mudacor'>Carga LCL por Tr�fico</A></TD><TD Class=mostrar>Estadistica del movimiento de Carga LCL por Tr�fico</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='grasucursalfcl.php'; class='mudacor'>Carga FCL por Sucursales</A></TD><TD Class=mostrar>Estadistica del movimiento de Carga FCL por Sucursales</TD>";
  echo "</TR>";
  echo "<TR>";
  echo "  <TD Class=mostrar><A HREF='grasucursallcl.php'; class='mudacor'>Carga LCL por Sucursales</A></TD><TD Class=mostrar>Estadistica del movimiento de Carga LCL por Sucursales</TD>";
  echo "</TR>";
  echo "</TABLE><BR>";
  echo  "<BR/>\n<BR/>\n";
  echo "<TABLE CELLSPACING=10>";
  echo "<TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = \"/\"'></TH>";  // Cancela la operaci�n
  echo "</TABLE>";
  echo "</CENTER>";
  require_once("footer.php");
echo "</BODY>";
  echo "</HTML>";
?>