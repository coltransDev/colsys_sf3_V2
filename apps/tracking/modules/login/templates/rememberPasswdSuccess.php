<?
echo form_tag("login/rememberPasswdDo");
use_helper("Validation");
?>
<h3> Por favor coloque su correo electronico </h3>

<table width="90%" border="0">
	<tr>
		<td><?=image_tag("contenedor.jpg")?></td>
		<td>		
			<div class="box1" style="width:550px">
				<table width="550px" border="0">
				<tr>
					<td colspan="2">Enviaremos un correo de confirmaci&oacute;n a su cuenta de correo para activar su clave</td>
					</tr>
				<tr>
					<td width="21"><div align="right"><strong>Su correo electr&oacute;nico:</strong></div></td>
					<td width="70%">
					<?=form_error("no_encontrada")?>
					<?=form_error("user_email")?>					
					<?=input_tag("user_email", "", "size=50")?></td>
				</tr>
				<tr>	
					<td colspan="2"><div align="center"><?=submit_tag("entrar", "class=button")?></div></td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>

</form>


