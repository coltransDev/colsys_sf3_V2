<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
?>
<table>
<tbody>
<tr>
<th>Ca iddoc: </th>
<td><?php echo $fala_header->getCaIddoc() ?></td>
</tr>
<tr>
<th>Ca fecha carpeta: </th>
<td><?php echo $fala_header->getCaFechaCarpeta() ?></td>
</tr>
<tr>
<th>Ca archivo origen: </th>
<td><?php echo $fala_header->getCaArchivoOrigen() ?></td>
</tr>
<tr>
<th>Ca reporte: </th>
<td><?php echo $fala_header->getCaReporte() ?></td>
</tr>
<tr>
<th>Ca codigo puerto pickup: </th>
<td><?php echo $fala_header->getCaCodigoPuertoPickup() ?></td>
</tr>
<tr>
<th>Ca codigo puerto descarga: </th>
<td><?php echo $fala_header->getCaCodigoPuertoDescarga() ?></td>
</tr>
<tr>
<th>Ca container mode: </th>
<td><?php echo $fala_header->getCaContainerMode() ?></td>
</tr>
<tr>
<th>Ca nombre proveedor: </th>
<td><?php echo $fala_header->getCaNombreProveedor() ?></td>
</tr>
<tr>
<th>Ca campo59: </th>
<td><?php echo $fala_header->getCaCampo59() ?></td>
</tr>
<tr>
<th>Ca codigo proveedor: </th>
<td><?php echo $fala_header->getCaCodigoProveedor() ?></td>
</tr>
<tr>
<th>Ca campo61: </th>
<td><?php echo $fala_header->getCaCampo61() ?></td>
</tr>
<tr>
<th>Ca monto invoice miles: </th>
<td><?php echo $fala_header->getCaMontoInvoiceMiles() ?></td>
</tr>
<tr>
<th>Ca numero invoice: </th>
<td><?php echo $fala_header->getCaNumeroInvoice() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'falabella/edit?ca_iddoc='.$fala_header->getCaIddoc()) ?>
&nbsp;<?php echo link_to('list', 'falabella/list') ?>
