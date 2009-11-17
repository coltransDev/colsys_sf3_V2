<?
$accesos = $sf_data->getRaw("accesos");
$accesosPerfil = $sf_data->getRaw("accesosPerfil");

?>

<div class="content" align="center">

<h3>Permisos por Usuario</h3>
<br />
<form action="<?=url_for("adminUsers/guardarPermisos?login=".$usuario->getCaLogin())?>" method="post">
<table width="65%" border="1" class="tableList" >
	<tr>
		<th>&nbsp;</th>
		</tr>
	<tr>
		<td width="50%">Usuario:
			<?=$usuario->getCaNombre()?></td>
		</tr>
	<tr>
		<td>
			<?
			include_component( "adminPerfiles", "formPermisos", array("accesos"=>$accesos, "accesosPerfil"=>$accesosPerfil) );
			?>
	
		</td>
	</tr>
	
	<tr>
		<td>
			<div align="center">
				<input type="submit" value="Guardar" class="button">
				&nbsp;
				<input type="button" value="Cancelar" class="button" onClick="document.location= '<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>'">
				</div></td>
	</tr>
	
</table>
</form>
</div>





