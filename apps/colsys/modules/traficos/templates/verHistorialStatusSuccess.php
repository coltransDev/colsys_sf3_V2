
<div class="content" align="center">

<table class="tableList"  width="100%">
	<tr>
		<th colspan="2">Informaci&oacute;n basica del reporte </th>
		</tr>
	<tr>
		<td width="29%"><b>Numero de reporte:</b>
			<?=$reporte->getCaConsecutivo()?></td>
		<td width="71%"><b>Cliente:</b>
			<?=$reporte->getCliente()->getCaCompania()?>
		</td>
	</tr>
	<tr>
		<td><b>Proveedor:</b> <?=$reporte->getProveedoresStr()?></td>
		<td><b>Orden:</b>
			<?=$reporte->getCaOrdenClie()?>
	</td>
	</tr>
</table>
<br />

<?
include_component("traficos", "listaStatus", array("reporte"=>$reporte,"linkEmail"=>true));
?>




</div>