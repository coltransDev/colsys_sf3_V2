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
	?>
	<?
	if( $nivelTransportadores>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Transportadores", "ids/index?modo=transp")?>
		</div></td>
	</tr>
	<?
	}
	?>
	<?
	if( $nivelOtrosproveedores>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Otros Proveedores", "ids/index?modo=otrosp")?>
		</div></td>
	</tr>
	<?
	}
	?>
</table>

</div>