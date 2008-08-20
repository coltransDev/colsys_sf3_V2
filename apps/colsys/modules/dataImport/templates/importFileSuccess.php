<table width="100" border="0" cellspacing="0" cellpadding="0">
	<?
	foreach( $datos as $dato ){
		?>
		<tr>
		<?
		foreach( $dato as $item ){
		?>	
			<td><?=$item?></td>
		<?
		}
		?>
		</tr>
		<?
	}
	?>

</table>
