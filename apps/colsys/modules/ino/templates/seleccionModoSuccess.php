<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
		<th scope="col"><div align="left"><b>Seleccione el modo de operaci�n del programa</b></div></th>
	</tr>
	<?
	if( $nivelAereo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("A�reo", "ino/index?modo=aereo")?>
		</div></td>
	</tr>
	<?
	}

	if( $nivelMaritimo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Mar�timo", "ino/index?modo=maritimo")?>
		</div></td>
	</tr>
	<?
	}


    if( $nivelExpo>=0 ){
	?>
	<tr>
		<td><div align="left">
			<?=link_to("Exportaciones", "ino/index?modo=expo")?>
		</div></td>
	</tr>
	<?
	}
	?>
	
</table>

</div>