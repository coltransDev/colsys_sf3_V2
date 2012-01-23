<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
?>
<div class="content" align="center">
<h3>Vencimiento Carta de Garant�a en Clientes Perido: <?=$inicio?> - <?=$final?></h3>

<table class="tableList" border="1">
<thead>
<tr>
  <th>Id Cliente</th>
  <th>D&iacute;gito</th>
  <th>Cliente</th>
  <th>Direcci&oacute;n</th>
  <th>Tel&eacute;fono</th>
  <th>Fax</th>
  <th>Ciudad</th>
  <th>Fch.Firmado</th>
  <th>Fch.Vencimiento</th>
  <th>Vendedor</th>
  <th>Sucursal</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientesCartaGarantia as $cliente): ?>
<tr >
      <td><?php echo $cliente["ca_idalterno"] ?></td>
      <td><?php echo $cliente["ca_digito"] ?></td>
      <td><?php echo $cliente["ca_compania"] ?></td>
      <td><?php echo $cliente["ca_direccion"]." ".$cliente["ca_oficina"]." ".$cliente["ca_torre"]." ".$cliente["ca_bloque"]." ".$cliente["ca_interior"]." ".$cliente["ca_complemento"] ?></td>
      <td><?php echo $cliente["ca_telefonos"] ?></td>
      <td><?php echo $cliente["ca_fax"] ?></td>
      <td><?php echo $cliente["ca_ciudad"] ?></td>
      <td><?php echo $cliente["ca_fchfirmado"] ?></td>
      <td><?php echo $cliente["ca_fchvencimiento"] ?></td>
      <td><?php echo $cliente["ca_vendedor"] ?></td>
      <td><?php echo $cliente["ca_sucursal"] ?></td>
</tr>
<?php 
      endforeach;

	if( count($clientesCartaGarantia)==0 ){
?>
    <tr>
	    <td colspan="11"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>

</tbody>
</table>

</div>