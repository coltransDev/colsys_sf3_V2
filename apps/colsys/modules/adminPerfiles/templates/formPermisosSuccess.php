

<div class="content" align="center">

<h3><?=$perfil->getCaNombre()?></h3>
<br />
<form action="<?=url_for("adminPerfiles/guardarPermisos?perfil=".$perfil->getCaPerfil())?>" method="post">
<table width="65%" border="1" class="tableList" >
	<tr>
		<th>&nbsp;</th>
		</tr>
	<tr>
		<td width="50%"><b>Descripci&oacute;n:</b>
			<?=$perfil->getCaDescripcion()?></td>
		</tr>
	<tr>
		<td>
			<?
			include_component( "adminPerfiles", "formPermisos", array("accesos"=>$accesos) );
			?>
	
		</td>
	</tr>
	
	<tr>
		<td>
			<div align="center">
				<input type="submit" value="Guardar" class="button">
				&nbsp;
				<input type="button" value="Cancelar" class="button" onClick="document.location= '<?=url_for("adminPerfiles/index")?>'">
				</div></td>
	</tr>
	
</table>
</form>
</div>





