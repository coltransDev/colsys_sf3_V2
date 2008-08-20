<?
echo form_tag("login/register");
use_helper("Validation");
?>
<h3> Bienvenido a nuestro sistema de Tracking </h3>

<table width="90%" border="0">
	<tr>
		<td><?=image_tag("contenedor.jpg")?></td>
		<td>		
			<div class="box1" style="width:550px">
				<table width="550px" border="0">
				<tr>
					<td colspan="2"><div align="right"><strong>Su correo electr&oacute;nico:</strong></div></td>
					<td width="70%">
					<?=form_error("user_email")?>
					<?=input_tag("user_email", "", "size=50")?></td>
				</tr>
				<tr>
					<td colspan="3"><div align="left"><strong>&iquest;Ya tiene su clave? </strong></div></td>
					</tr>
				<tr>
					<td width="21%"><div align="right">
						<?=radiobutton_tag("register","register")?>
					</div></td>
					<td colspan="2"><div align="left">No, todav&iacute;a no tengo una clave </div></td>
					</tr>
				<tr>
					<td><div align="right">
						<?=radiobutton_tag("register","login", true)?>
					</div></td>
					<td colspan="2"><div align="left">S&iacute;, mi clave es: 
					
						<?=form_error("clave_invalida")?>
						<?=input_tag("password", "", "type=password")?>
					</div></td>
					</tr>
				<tr>
					<td colspan="3"><div align="center"><?=link_to("&iquest;Olvido su clave?, haga click aca","login/rememberPasswd")?> </div></td>
				</tr>
				<tr>	
					<td colspan="3"><div align="center"><?=submit_tag("entrar", "class=button")?></div></td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>

</form>

<p>
	<?=link_to(image_tag("logoNovell.gif")." <br />Usuarios de Novell click aca ", "login/novell")?> 
</p>
