<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
		<th scope="col"><div align="left"><b>Seleccione el modo de operación del programa</b></div></th>
	</tr>
	<?
	if( $nivelAgentes>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Agentes", "ids/index?modo=agentes")?>
		</div></td>
	</tr>
	<?
	}
	
	if( $nivelProveedores>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Proveedores", "ids/index?modo=prov")?>
		</div></td>
	</tr>
	<?
	}
	?>
</table>

</div>