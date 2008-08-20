<?
echo form_tag("login/novell");
use_helper("Validation");
?>
<h3> Bienvenido a nuestro sistema de Tracking </h3>

<table width="90%" border="0" cellpadding="5">
	<tr>
		<td><?=image_tag("contenedor.jpg")?></td>
		<td>		
			<div class="box1" style="width:550px">
				<table width="550px" border="0">
				<tr>
					<td width="21" rowspan="2">
					<?=image_tag("logo_colsys.gif")?>
					<br>
					<?=image_tag("logoNovell.gif")?>
					</td>
					<td width="21"><div align="right"><strong>Usuario:</strong></div></td>
					<td width="70%">
					<?=form_error("clave_invalida")?>
					<?=form_error("username")?>
					<?=input_tag("username", "", "size=20")?></td>
				</tr>
				<tr>
					<td><div align="right"><strong>Clave:</strong></div></td>
					<td>
						<?=form_error("password")?>
						<?=input_tag("password", "", "type=password size=20")?></td>
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
	 
</p>
