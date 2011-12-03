<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
?>
<div class="content" align="center">
<h3>Vencimiento Circular 0170 en Clientes Perido: <?=$inicio?> - <?=$final?></h3>

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
  <th>Fch.Circular</th>
  <th>Fch.Vencimiento</th>
  <th>Vendedor</th>
  <th>Sucursal</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientesCircular as $cliente): ?>
<tr >
      <td><?php echo $cliente["ca_idalterno"] ?></td>
      <td><?php echo $cliente["ca_digito"] ?></td>
      <td><?php echo $cliente["ca_compania"] ?></td>
      <td><?php echo $cliente["ca_direccion"]." ".$cliente["ca_oficina"]." ".$cliente["ca_torre"]." ".$cliente["ca_bloque"]." ".$cliente["ca_interior"]." ".$cliente["ca_complemento"] ?></td>
      <td><?php echo $cliente["ca_telefonos"] ?></td>
      <td><?php echo $cliente["ca_fax"] ?></td>
      <td><?php echo $cliente["ca_ciudad"] ?></td>
      <td><?php echo $cliente["ca_fchcircular"] ?></td>
      <td><?php echo $cliente["ca_vnccircular"] ?></td>
      <td><?php echo $cliente["ca_vendedor"] ?></td>
      <td><?php echo $cliente["ca_sucursal"] ?></td>
</tr>
<?php 
      endforeach;

	if( count($clientesCircular)==0 ){
?>
    <tr>
	    <td colspan="11"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>

</tbody>
</table>
<br />
<br />

<h3>Clientes con Circular 0170 VENCIDA</h3>

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
  <th>Fch.Circular</th>
  <th>Fch.Vencimiento</th>
  <th>Vendedor</th>
  <th>Sucursal</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientesVenCircular as $cliente): ?>
<tr >
      <td><?php echo $cliente["ca_idalterno"] ?></td>
      <td><?php echo $cliente["ca_digito"] ?></td>
      <td><?php echo $cliente["ca_compania"] ?></td>
      <td><?php echo $cliente["ca_direccion"]." ".$cliente["ca_oficina"]." ".$cliente["ca_torre"]." ".$cliente["ca_bloque"]." ".$cliente["ca_interior"]." ".$cliente["ca_complemento"] ?></td>
      <td><?php echo $cliente["ca_telefonos"] ?></td>
      <td><?php echo $cliente["ca_fax"] ?></td>
      <td><?php echo $cliente["ca_ciudad"] ?></td>
      <td><?php echo $cliente["ca_fchcircular"] ?></td>
      <td><?php echo $cliente["ca_vnccircular"] ?></td>
      <td><?php echo $cliente["ca_vendedor"] ?></td>
      <td><?php echo $cliente["ca_sucursal"] ?></td>
</tr>
<?php
      endforeach;

	if( count($clientesCircular)==0 ){
?>
    <tr>
	    <td colspan="11"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>

</tbody>
</table>
<br />
<br />

<h3>Clientes SIN Circular 0170</h3>

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
  <th>Vendedor</th>
  <th>Sucursal</th>
</tr>
</thead>
<tbody>

<?php foreach ($clientesSinCircular as $cliente): ?>
<tr >
      <td><?php echo $cliente["ca_idalterno"] ?></td>
      <td><?php echo $cliente["ca_digito"] ?></td>
      <td><?php echo $cliente["ca_compania"] ?></td>
      <td><?php echo $cliente["ca_direccion"]." ".$cliente["ca_oficina"]." ".$cliente["ca_torre"]." ".$cliente["ca_bloque"]." ".$cliente["ca_interior"]." ".$cliente["ca_complemento"] ?></td>
      <td><?php echo $cliente["ca_telefonos"] ?></td>
      <td><?php echo $cliente["ca_fax"] ?></td>
      <td><?php echo $cliente["ca_ciudad"] ?></td>
      <td><?php echo $cliente["ca_vendedor"] ?></td>
      <td><?php echo $cliente["ca_sucursal"] ?></td>
</tr>
<?php
      endforeach;

	if( count($clientesSinCircular)==0 ){
?>
    <tr>
	    <td colspan="11"><div align="center">Reporte sin Registros</div></td>
    </tr>

<?
	}
?>
</tbody>
</table>
<br />
<br />

<h3>Clientes SIN Encuesta de Visita</h3>

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
  <th>Vendedor</th>
  <th>Sucursal</th>
</tr>
</thead>
<tbody>

<?php foreach ($clientesSinVisita as $visita): ?>
<tr >
      <td><?php echo $visita["ca_idalterno"] ?></td>
      <td><?php echo $visita["ca_digito"] ?></td>
      <td><?php echo $visita["ca_compania"] ?></td>
      <td><?php echo $visita["ca_direccion"]." ".$visita["ca_oficina"]." ".$visita["ca_torre"]." ".$visita["ca_bloque"]." ".$visita["ca_interior"]." ".$visita["ca_complemento"] ?></td>
      <td><?php echo $visita["ca_telefonos"] ?></td>
      <td><?php echo $visita["ca_fax"] ?></td>
      <td><?php echo $visita["ca_ciudad"] ?></td>
      <td><?php echo $visita["ca_vendedor"] ?></td>
      <td><?php echo $visita["ca_sucursal"] ?></td>
</tr>
<?php
      endforeach;

	if( count($clientesSinVisita)==0 ){
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