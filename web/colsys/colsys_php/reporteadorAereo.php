<?
$programa = 56;
  
  require_once("checklogin.php");                                                                 // Captura las variables de la sessi�n abierta  
  $titulo = 'Generador de Reportes Gerenciales - '.COLTRANS;
  if (!isset($usuario)) {                                                        // Verifica si el usuario ya inicio su sessi�n
      echo "<script>document.location.href = 'entrada.php';</script>";
     }
?>
<HTML>
  <HEAD>
    <TITLE>COLSYS Sistema Reporteador</TITLE>
    <style type='text/css'></style>
  </HEAD>
  <STYLE>@import URL("Coltrans.css");</STYLE>
  <BODY>
  <?
  require("menu.php");
  ?>
  <BR>
  <CENTER>
  <FORM METHOD=post NAME='tabla' ACTION='reporteadorAereo.php'>
    <TABLE WIDTH=470 BORDER=0 CELLSPACING=1 CELLPADDING=5>
    <TR>
      <TH COLSPAN=2>Sistema Administrador de Referencias Aereas<BR><?=$titulo?></TH>
    </TR>
      <TD Class=titulo WIDTH=110>Nombre</TD>
      <TD Class=titulo>Detalle</TD>
    <TR>
      <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepInoAereoEntradaAction.do'; class='mudacor'>Cuadro INO</A></TD><TD Class=mostrar>Informe para Gerencia Cuadro INO</TD>
    </TR>
    <TR>
      <TD Class=mostrar><A HREF='repgeneratorair.php'; class='mudacor'>Generador de Informes</A></TD><TD Class=mostrar>M�dulo Contructor de Informes multiples opciones</TD>
    </TR>
    <TR>
      <TD Class=mostrar><A HREF='/Coltrans/Reportes/ReporteComisionAction.do?comision=1'; class='mudacor'>Comisiones</A></TD><TD Class=mostrar>Informe de Comisiones para Vendedores</TD>
  </TR>
  <TR>
      <TD Class=mostrar><A HREF='/Coltrans/Reportes/ReporteComisionAction.do?comision=2'; class='mudacor'>Movimiento Vendedor</A></TD><TD Class=mostrar>Informe de Movimiento de Carga y Comisiones para Vendedores</TD>
  </TR>
  <TR>
    <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepUtilidadAction.do'; class='mudacor'>An�lisis de Utilidades</A></TD><TD Class=mostrar>Informe An�lisis de Utilidades por Referencia</TD>
  </TR>
  <TR>
    <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepCargaSucLineaAction.do'; class='mudacor'>Carga por Surcursales</A></TD><TD Class=mostrar>Informe Movimiento de Carga por Sucursal y Aerolinea</TD>
  </TR>
  <TR>
  <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepConsolidadoAction.do'; class='mudacor'>Consolidado de Casos</A></TD><TD Class=mostrar>Consolidaci�n de Referencias detallada por Tr�ficos</TD>
  </TR>
  <TR>
    <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepFactHijaAction.do'; class='mudacor'>Facturaci�n a Clientes</A></TD><TD Class=mostrar>Informe con Sumatoria de Facturas y HAWB por Cliente</TD>
  </TR>
  <TR>
    <TD Class=mostrar><A HREF='/reportesGer/libroReferenciasAereo'; class='mudacor'>Libro de Referencias</A></TD><TD Class=mostrar>Informe de Referencias Procesadas</TD>
  </TR>
  <TR>
    <TD Class=mostrar><A HREF='/Coltrans/Reportes/RepAuditoriaAction.do?cliente=1'; class='mudacor'>Reporte de Auditoria</A></TD><TD Class=mostrar>Informe sobre Rastros de Auditor�a</TD>
  </TR>
  </TABLE><BR><BR>
  <TABLE CELLSPACING=10>
    <TH><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Terminar' ONCLICK='javascript:document.location.href = "/"'></TH>
  </TABLE>
  </CENTER>
  <?
  require("footer.php");
  ?>
  </BODY>
</HTML>