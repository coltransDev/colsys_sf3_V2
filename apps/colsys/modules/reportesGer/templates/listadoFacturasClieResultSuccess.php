<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

$ingresos = $sf_data->getRaw("ingresos");
?>
<div class="content" align="center">
    <h2>Informe de Facturación Proveedores Mar&iacute;timo</h2>
    <br />
    <table width="90%" CELLSPACING="1" class="tableList alignLeft">
     <tr>
       <th class="titulo" COLSPAN="12">
        <BR/>Informe de Facturaci&oacute;n Mar&iacute;tima
        <BR/>Fecha de Liquidaci&oacute;n desde <?=$fchInicial?> hasta <?=$fchFinal?>
       </th>
     </tr>
     <?
     if( count($ingresos)==0 ){
     ?>
     <tr>
        <td colspan="12">No existen referencias para ese criterio de busqueda.</td>
     </tr>
     <?
     }else{
     ?>
       <tr>
         <th>Referencia</th>
         <th>Doc.Transporte</th>
         <th>Factura</th>
         <th>Fecha de Factura</th>
         <th>Cliente</th>
         <th>Moneda</th>
         <th>Tasa de Cambio</th>
         <th>Neto</th>
         <th>Valor</th>
         <th width="100">Fecha de Creaci&oacute;n</th>
         <th>Usuario de Creaci&oacute;n</th>
         <th>Observaci&oacute;n</th>
       </tr>
       <?
       $tot_mem = 0;
       foreach( $ingresos as $i ){
       ?>
         <tr>
           <td class="invertir" style='font-weight:bold; background: #F0F0F0'><?=$i->getInoClientesSea()->getCaReferencia()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getInoClientesSea()->getCaHbls()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getCaFactura()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getCaFchfactura()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="left"><?=$i->getInoClientesSea()->getCliente()->getCaCompania()?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getCaIdmoneda()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=$i->getCaTcambio()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($i->getCaNeto())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($i->getCaValor())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::fechaMes($i->getCaFchcreado())?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getCaUsucreado()?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$i->getCaObservaciones()?></td>
         </tr>
       </logic:iterate>
    <?
        $tot_mem+= $i->getCaValor();
       }
       ?>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0' colspan="8"><div align="right">TOTAL :</div></td>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($tot_mem)?></div></td>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0' colspan="3"><div align="right"></div></td>
       <?
     }
    ?>
    </table>
    <br />
    <table CELLSPACING=10>
    <tr>
      <th><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='document.location="<?=url_for("reportesGer/listadoFacturasClie")?>"'></th>
    </tr>
    </table>   
</div>