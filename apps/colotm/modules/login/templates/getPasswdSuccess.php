<div align="center">
<form action="<?=url_for("login/getPasswd")?>" method="post">
<h3> Por favor coloque su correo electronico </h3>
<br />
		
<div class="box1" style="width:550px">
	<table width="550px" border="0">
	<tr>
		<td colspan="2">Enviaremos un correo de confirmaci&oacute;n a su cuenta de correo para activar su clave<br /><br /></td>
	</tr>
	<?
	echo $form;
	?>
	<tr>	
		<td colspan="2"><div align="center"><input type="submit" class="button" value="Continuar"/></div></td>
	</tr>
</table>
</div>
		
</form>
</div>