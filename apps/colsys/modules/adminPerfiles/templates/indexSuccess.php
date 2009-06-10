<div class="content"  align="center">
<br />
<h3>Administraci&oacute;n de Perfiles</h3>
<br />
<br />


<table class="tableList" width="90%" >
<tr >
	<th width="12%">Perfil</th>
	<th width="49%">Descripci&oacute;n</th>	
	<th width="25%">Departamento</th>	
	<th width="14%">Opciones</th>
</tr>
<?
foreach( $perfiles as $perfil ){
?>
<tr >
	<td><a href="<?=url_for("adminPerfiles/formPerfil?perfil=".$perfil->getCaPerfil())?>"><?=$perfil->getCaNombre()?></a></td>
	<td><?=$perfil->getCaDescripcion()?></td>
	<td><?=$perfil->getCaDepartamento()?></td>
	<td><?=link_to(image_tag("16x16/unlock.gif")."Permisos", "adminPerfiles/formPermisos?perfil=".$perfil->getCaPerfil())?>&nbsp;<?=link_to(image_tag("16x16/add_user.gif")."Usuarios", "adminPerfiles/formUsers?perfil=".$perfil->getCaPerfil())?></td>
</tr>
<?
}
?>
</table>
</div>