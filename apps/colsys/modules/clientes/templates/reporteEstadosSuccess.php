<?php
// auto-generated by sfPropelCrud
// date: 2008/06/09 10:06:57
$i=1;
?>
<div class="content" align="center">
<h1>Estado de Clientes Perido: <?=$inicio?> - <?=$final?></h1>

<table class="tableList" border="1">
<thead>
<tr>
  <th>#</th>
  <th>Id Cliente</th>
  <th>Cliente</th>
  <th>Fecha Nuevo Estado</th>
  <th>Nuevo Estado</th>
  <th>Empresa</th>
  <th>Vendedor</th>
  <th>Sucursal</th>
  <th>Fecha Estado Anterior</th>
  <th>Estado Anterior</th>
  <th>
      <?php
      if ($empresa == 'Coltrans'){
            echo "&Uacute;ltimo Doc.Transporte";
      }else {
            echo "&Uacute;ltima Factura";
      }
      ?>
  </th>
  <th>N&uacute;mero Negocios</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientesEstados as $clienteEstado): ?>
<tr >
      <td><?php echo $i++ ?></td>
      <td><?php echo $clienteEstado["ca_idcliente"] ?></td>
      <td><?php echo $clienteEstado["ca_compania"] ?></td>
      <td><?php echo $clienteEstado["ca_fchestado"] ?></td>
      <td><?php echo $clienteEstado["ca_estado"] ?></td>
      <td><?php echo $clienteEstado["ca_empresa"] ?></td>
      <td><?php echo $clienteEstado["ca_vendedor"] ?></td>
      <td><?php echo $clienteEstado["ca_sucursal"] ?></td>
      <td><?php echo $clienteEstado["ca_fchestado_ant"] ?></td>
      <td><?php echo $clienteEstado["ca_estado_ant"] ?></td>
      <td><?php echo $clienteEstado["ca_fchnegocio"] ?></td>
      <td align="center"><?php echo "Perido: ".$clienteEstado["ca_numnegocios"]." Total: ".$clienteEstado["ca_totnegocios"] ?></td>

</tr>
<?php 
	endforeach; 
	
	if( count($clientesEstados)==0 ){
?>
	<tr>
	    <td colspan="12"><div align="center">Reporte sin Registros</div></td>
        </tr>
<?
	}else{
?>
	<tr>
	    <td colspan="12"><div align="left"><b>Total Clientes Potenciales al Iniciar el Periodo: <?=$poblacion?></b></div></td>
        </tr>
<?
	}
?>

<tr>
    <td colspan="12"><div align="center">Fin del Reporte</div></td>
</tr>
</tbody>
</table>

</div>