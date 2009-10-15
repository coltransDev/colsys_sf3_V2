<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
		<th scope="col"><div align="left"><b>Seleccione el modo de operación del programa</b></div></th>
	</tr>
	<?
	if( $nivelMaritimo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Mar&iacute;timo", "traficos/index?modo=maritimo")?>
		</div></td>
	</tr>
	<?
	}
	?>
	<?
	if( $nivelAereo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("A&eacute;reo", "traficos/index?modo=aereo")?>
		</div></td>
	</tr>
	<?
	}
	?>
	<?
	if( $nivelExpo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Exportaciones", "traficos/index?modo=expo")?>
		</div></td>
	</tr>
	<?
	}
	?>
</table>

</div>