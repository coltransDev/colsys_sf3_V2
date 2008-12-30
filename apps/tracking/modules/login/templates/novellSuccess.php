<div align="center">
<?
echo form_tag("login/novell");
use_helper("Validation");
?>
<h3> Bienvenido a nuestro sistema de Tracking </h3>

		
			<div class="box1" style="width:550px" align="center">
				<table width="550px" border="0">
				<tr>
					<td width="21" rowspan="2">
					<?=image_tag("logo_colsys.gif")?>
					
					</td>
					<td width="21"><div align="right"><strong>Usuario:</strong></div></td>
					<td width="70%">				
					<?=input_tag("username", "", "size=20")?></td>
				</tr>
				<tr>
					<td><div align="right"><strong>Clave:</strong></div></td>
					<td>
						
						<?=input_tag("password", "", "type=password size=20")?></td>
				</tr>
			
				<tr>	
					<td colspan="3"><div align="center"><?=submit_tag("Entrar", "class=button")?></div></td>
				</tr>
			</table>
			</div>
		

</form>

</div>
