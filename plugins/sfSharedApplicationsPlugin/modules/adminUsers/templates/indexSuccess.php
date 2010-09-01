<div align="center">
<table class="tableList" border="1">
<tr >
	<th>Login</th>
	<th>Nombre</th>
	<th>Cargo</th>
	<th>Departamento</th>
    <th>Empresa</th>
	<th>Activo</th>
	
</tr>
<?
foreach( $usuarios as $usuario ){
?>
<tr <?=$usuario->getCaActivo()?"":"class='row0'"?>>
	<td ><a href="<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>"><?=$usuario->getCaLogin()?></a></td>
	<td><a href="<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>"><?=$usuario->getCaNombres()?> <?=$usuario->getCaApellidos()?></a></td>
	<td><?=$usuario->getCaCargo()?></td>
	<td><?=$usuario->getCaDepartamento()?></td>
    <td><?=$usuario->getCaEmpresa()?></td>
	<td><?=$usuario->getCaActivo()?"Activo":"Inactivo"?></td>
</tr>
<?
}
?>
</table>
</div>