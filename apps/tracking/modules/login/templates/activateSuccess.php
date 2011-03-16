<?

?>
<?php 
//echo form_error('name') ?>
<div align="center">
<h3> Por favor ingrese su contrase&ntilde;a </h3>
<form action="<?=url_for("login/activate?code=".$code)?>" method="post">
<br />

<table width="430px" border="0" class="table1">
	<tr>
	  <th colspan="2">&nbsp;</th>
    </tr>
	<tr>
		<th width="46%"><strong>Su correo electronico</strong></th>
		<td width="54%"><?=$user->getCaEmail()?></td>
	</tr>
	<?
	echo $form
	?>
	<tr>	
		<td colspan="2"><div align="center"><input type="submit" value="Continuar" class="button" /></div></td>
	</tr>
</table>
</form>

</div>

