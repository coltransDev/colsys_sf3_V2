<div align="center">
<table class="tableList" >
<tr >
	<th>Login</th>
	<th>Nombre</th>
	<th>Extensi&oacute;n</th>
	<th>Cargo</th>
	<th>Departamento</th>
	<th>Activo</th>
	<th>Metodo de Autenticaci&oacute;n</th>
</tr>
<?
foreach( $usuarios as $usuario ){
?>
<tr <?=$usuario->getCaActivo()?"":"class='row0'"?>>
	<td ><a href="<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>"><?=$usuario->getCaLogin()?></a></td>
	<td><a href="<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>"><?=$usuario->getCaNombre()?></a></td>
	<td><?=$usuario->getCaExtension()?></td>
	<td><?=$usuario->getCaCargo()?></td>
	<td><?=$usuario->getCaDepartamento()?></td>
	<td><?=$usuario->getCaActivo()?"Activo":"Inactivo"?></td>
	<td><?=strtoupper($usuario->getCaAuthmethod())?></td>
</tr>
<?
}
?>
</table>
</div>