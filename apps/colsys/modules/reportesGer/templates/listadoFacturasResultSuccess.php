<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

$costos = $sf_data->getRaw("costos");
?>
<div class="content" align="center">
    <h2>Informe de Facturación Mar&iacute;timo</h2>
    <br />
    <table width="90%" CELLSPACING="1" class="tableList alignLeft">
     <tr>
       <th class="titulo" COLSPAN="12">
        <BR/>Informe de Facturaci&oacute;n Mar&iacute;tima
        <BR/>Fecha de Liquidaci&oacute;n desde <?=$fchInicial?> hasta <?=$fchFinal?>
       </th>
     </tr>
     <?
     if( count($costos)==0 ){
     ?>
     <tr>
        <td colspan="12">No existen referencias para ese criterio de busqueda.</td>
     </tr>
     <?
     }else{
     ?>
       <tr>
         <th>Referencia</th>
         <th>Factura</th>
         <th>Fecha de Factura</th>
         <th>Proveedor</th>
         <th>Moneda</th>
         <th>Tasa de Cambio</th>
         <th>Tasa de Cambio USD</th>
         <th>Neto</th>
         <th>Total Neto</th>
         <th>Venta</th>
         <th width="100">Fecha de Creaci&oacute;n</th>
         <th>Usuario de Creaci&oacute;n</th>
       </tr>
       <?
       foreach( $costos as $c ){
       ?>
         <tr>
           <td class="invertir" style='font-weight:bold; background: #F0F0F0'><?=$c->getCaReferencia()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c->getCaFactura()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c->getCaFchfactura()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="left"><?=$c->getCaProveedor()?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c->getCaIdmoneda()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=$c->getCaTcambio()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c->getCaTcambioUsd())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c->getCaNeto())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber(round($c->getCaNeto()*$c->getCaTcambio()/$c->getCaTcambioUsd()))?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c->getCaVenta())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::fechaMes($c->getCaFchcreado())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c->getCaUsucreado()?></td>
         </tr>
       </logic:iterate>
    <?
       }
     }
    ?>
    </table>
    <br />
    <table CELLSPACING=10>
    <tr>
      <th><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='document.location="<?=url_for("reportesGer/listadoFacturas")?>"'></th>
    </tr>
    </table>   
</div>