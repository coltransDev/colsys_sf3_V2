<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
?>
<center><h1>M&oacute;dulo de Interfase Clariant</h1></center>
<br />
<table class="tableList" border="1" align="center">
<thead>
<tr>
  <th>ID</th>
  <th>Pais</th>
  <th>Proveedor</th>
  <th>Reporte Neg.</th>
  <th>Fch.Documento</th>
  <th>Incoterm</th>
  <th>Importado</th>
</tr>
</thead>
<tbody>
<?php foreach ($clariant_notifys as $clariant_notify): ?>
<tr  >
    	<td><?php echo link_to($clariant_notify->getCaOrden(), 'clariant/procesarOrden?idclariant='.$clariant_notify->getCaIdclariant())?></td>
        
        <td><?php echo $clariant_notify->getCaPais() ?></td>
        <td><?php echo $clariant_notify->getCaProveedor() ?></td>
        <td><?php echo $clariant_notify->getCaConsecutivo() ?></td>
        <td><?php echo $clariant_notify->getCaDocumentoFch() ?></td>
        <td><?php echo $clariant_notify->getCaIncoterm() ?></td>
        <td><?php echo $clariant_notify->getCaFchimportado() ?></td>
</tr>
<?php 
	endforeach; 
	
	if( count($clariant_notifys)==0 ){
?>
	<tr>
    <td colspan="12"><div align="center">No se han generado archivos </div></td>
      </tr>
	 <?
	 }
	 ?>
</tbody>
</table>

