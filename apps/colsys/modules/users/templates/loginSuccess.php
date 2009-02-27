
<form action="<?=url_for("users/login")?>" method="post">
<table width="200" border="1" class="tableForm">
	<tr>
		<th colspan="2">&nbsp;</th>		
	</tr>
	<tr>
		<td>Usuario:</td>
		<td>
		
		
		<input type="text" name="username" />
		</td>
	</tr>
	<tr>
		<td>Clave:</td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center">
			<input type="submit" value="Entrar" />
		</div></td>
	</tr>
</table>
</form>