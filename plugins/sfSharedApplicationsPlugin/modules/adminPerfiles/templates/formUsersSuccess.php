<?
$usuariosPerfil = $sf_data->getRaw("usuariosPerfil");
?>
<div class="content" align="center">

<h3><?=$perfil->getCaNombre()?></h3>
<br />

<form action="<?=url_for("adminPerfiles/guardarPerfilesUsuario?perfil=".$perfil->getCaPerfil())?>" method="post">
<table width="100%" border="1" class="tableList" >
	<tr>
		<th>&nbsp;</th>
		</tr>
	<tr>
		<td ><b>Descripci&oacute;n:</b>
			<?=$perfil->getCaDescripcion()?></td>
		</tr>
	<tr>
		<td >
			<table width="100%" border="1" class="tableList">
			<tr>
				<th scope="col">&nbsp;</th>
				<th scope="col">Login</th>
				<th scope="col">Nombre</th>
				<th scope="col">Cargo</th>
				<th scope="col">Departamento</th>
                                <th scope="col">Empresa</th>
				<th scope="col">Sucursal</th>
			</tr>
			
			
			<?
			$i=0;
			foreach( $usuarios as $usuario ){
			?>
		<tr class="row<?=$i++%2?>">
			<td >
				<div align="center">
					<input type="checkbox"  name="logins[]" value="<?=$usuario->getCaLogin()?>" 
						<?=in_array( $usuario->getCaLogin(), $usuariosPerfil)?'checked="checked"':''?> 
					/>
				</div>			</td>
			<td><?=$usuario->getCaLogin()?></td>
			<td><?=$usuario->getCaNombre()?></td>	
			<td><?=$usuario->getCaCargo()?></td>
			<td><?=$usuario->getCaDepartamento()?></td>
                        <td><?=$usuario->getSucursal()->getEmpresa()->getCaNombre()?></td>
			<td><?=$usuario->getSucursal()->getCaNombre()?></td>
		</tr>

	<?
	}
	?>
		</table></td>
	</tr>
	<tr>
		<td >
			<div align="center">
							<input type="submit" value="Guardar" class="button" />&nbsp;
							<input type="button" value="Cancelar" class="button" onClick="document.location= '<?=url_for("adminPerfiles/index")?>'">
						</div>
		</td>
	</tr>
	<tr>
</table>
</form>
</div>