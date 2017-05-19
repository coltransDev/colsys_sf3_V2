<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$fchInicial = $sf_data->getRaw("fchInicial");
$fchFinal = $sf_data->getRaw("fchFinal");
$costos = $sf_data->getRaw("costos");
$destino = $sf_data->getRaw("destino");
$tipo = $sf_data->getRaw("tipo");
?>
<div class="content" align="center">
    <h2>Informe de Facturación Proveedores</h2>
    <br />
    <table width="90%" CELLSPACING="1" class="tableList alignLeft">
     <tr>
       <th class="titulo" COLSPAN="13">
        <BR/>Informe de Facturaci&oacute;n 
        <BR/>Fecha de Liquidaci&oacute;n desde <?=$fchInicial?> hasta <?=$fchFinal?>
        <?
        if ($destino){
            ?>
            <BR/>Cargas con Puerto de Destino: <?=$destino?>
            <?
        }
        ?>
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
         <th>Costo</th>
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
       $tot_net = 0;
       $tot_vta = 0;
       foreach( $costos as $c ){
           $c['ca_idmoneda']= isset($c['ca_idmoneda'])?$c['ca_idmoneda']:$c['ca_moneda'];
           $c['ca_neto']=isset($c['ca_neto'])?$c['ca_neto']:$c['ca_neta'];
           $c['ca_tcambio']=isset($c['ca_tcambio'])?$c['ca_tcambio']:$c['ca_trm'];
           $c['ca_tcambio_usd']=isset($c['ca_tcambio_usd'])?$c['ca_tcambio_usd']:$c['ca_trm_usd'];
       ?>
         <tr> 
           <td class="invertir" style='font-weight:bold; background: #F0F0F0'><?=$c['ca_referencia']?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c['ca_factura']?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c['ca_fchfactura']?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="left"><?=$c['ca_proveedor']?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="left"><?=$c['Costo']['ca_costo']?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c['ca_idmoneda']?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=$c['ca_tcambio']?></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c['ca_tcambio_usd'])?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c['ca_neto'])?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber(round($c['ca_neto']*$c['ca_tcambio']/$c['ca_tcambio_usd']))?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($c['ca_venta'])?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::fechaMes($c['ca_fchcreado'])?></div></td>
           <td class="valores" style='font-size: 9px; background: #F0F0F0'><?=$c['ca_usucreado']?></td>
         </tr>       
    <?
        $tot_net+= round($c['ca_neto']*$c['ca_tcambio']/$c['ca_tcambio_usd']);
        $tot_vta+= $c['ca_venta'];
       }
       ?>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0' colspan="9"><div align="right">TOTALES :</div></td>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($tot_net)?></div></td>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0'><div align="right"><?=Utils::formatNumber($tot_vta)?></div></td>
        <td class="valores" style='font-weight: bold; font-size: 9px; background: #F0F0F0' colspan="2"><div align="right"></div></td>
       <?
     }
    ?>
    </table>
    <br />
    <table CELLSPACING=10>
    <tr>
      <th><INPUT Class=button TYPE='BUTTON' NAME='boton' VALUE='Regresar' ONCLICK='document.location="<?=url_for("reportesGer/listadoFacturas?tipo=".$tipo)?>"'></th>
    </tr>
    </table>   
</div>
