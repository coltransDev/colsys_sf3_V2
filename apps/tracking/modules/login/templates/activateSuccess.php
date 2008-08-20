<?
use_helper("Validation");

?>
<?php echo form_error('name') ?>
<h3> Por favor ingrese su contrase&ntilde;a </h3>
<?=form_tag("login/doActivate?code=".$code);?>
<div id="loginBox">
<table width="430px" border="0">
	<tr>
		<td width="46%"><div align="right"><strong>Su correo electronico:</strong></div></td>
		<td width="54%"><?=$user->getCaEmail()?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Contrase&ntilde;a</strong>:</div></td>
		<td>
		<?=form_error("password1")?>
		<?=input_tag("password1", "", "type=password")?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Por favor confirme su contrase&ntilde;a</strong></div></td>
		<td>
		<?=form_error("password2")?>
		<?=input_tag("password2", "", "type=password")?></td>
	</tr>
	<tr>	
		<td colspan="2"><div align="center"><?=submit_tag("entrar")?></div></td>
	</tr>
</table>
</form>
</div>

