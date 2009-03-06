<?


?>
<div align="center">
<h3>Cambio de clave</h3>
<br />
<form action="<?php echo url_for('cuenta/cambiarClave') ?>" method="POST">

<table width="70%" border="0" cellspacing="0" cellpadding="0" class="table1">
	<tr>
		<th colspan="2" scope="col">&nbsp; </th>
	</tr>	
	<?
	echo $form;
	?>	
	<tr>
		<td colspan="2"><div align="center"><input type="submit" class="button" value="Continuar" /></div></td>
	</tr>
</table>
</form>
</div>