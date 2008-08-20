<?
use_helper("Validation");
?>
<h3> Su cuenta ya se encuentra activa </h3>
<?
echo form_tag("login/register");
?>
<table width="90%" border="0">
	<tr>
		<td><?=image_tag("contenedor.jpg")?></td>
		<td>		
			<div class="box1" style="width:550px">
				<table width="550px" border="0">
				<tr>
					<td colspan="2">Por favor coloque su clave </td>
					</tr>
				<tr>
					<td width="21"><div align="right"><strong>Su correo electr&oacute;nico:</strong></div></td>
					<td width="70%">
									
					<?=input_hidden_tag("user_email", $email)?>
					<?=input_hidden_tag("register","login")?>
					<?=input_hidden_tag("location","alreadyRegistered")?>
					<?=$email?></td>
				</tr>
				<tr>
					<td><div align="right"><strong>Clave:</strong></div></td>
					<td><?=form_error("clave_invalida")?><?=input_tag("password", "", "type=password")?></td>
				</tr>
				<tr>
					<td colspan="2"><div align="center"><?=link_to("&iquest;Olvido su clave?, haga click aca","login/rememberPasswd")?> </div></td>
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
