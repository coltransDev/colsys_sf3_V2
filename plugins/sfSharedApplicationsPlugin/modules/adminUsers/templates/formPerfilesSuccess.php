<?
$perfiles = $sf_data->getRaw("perfiles");
$perfilesUsuario = $sf_data->getRaw("perfilesUsuario");

?>
<div class="content" align="center">
<form name="form1" action="<?=url_for("adminUsers/guardarPerfiles")?>" method="post" >
	<input type="hidden" name="login" value="<?=$usuario->getCaLogin()?>" />
<table width="80%" border="0" class="tableList">
	<tr>
		<th scope="col">Perfiles del Usuario</th>
		</tr>
	<tr>
		<td><b>Login:</b> <?=$usuario->getCaLogin()?></td>
		</tr>
	
	<tr>
		<td><b>Nombre:</b>
			<?=$usuario->getCaNombre()?>
		</td>
	</tr>
	<tr>
		<td><table width="100%" border="1" class="tableList">
			<tr>
				<th scope="col">&nbsp;</th>
				<th scope="col">Perfil</th>				
				<th width="60%" scope="col">Descripci&oacute;n</th>
			</tr>
			<?	
            
            $lastDep = null;
			foreach( $perfiles as $perfil ){
                if( $lastDep!=$perfil->getCaDepartamento()  ){
                    $lastDep=$perfil->getCaDepartamento();
                    ?>
                    <tr class="row0">
                        <td colspan="3">
                            <div align="left">
                                <b><?=$lastDep?$lastDep:"Sin departamento"?></b>
                            </div>
                        </td>
                        
                    </tr>
                    <?
                }
			?>
			<tr>
				<td width="13%">
					<div align="center">
						<input type="checkbox" name="perfiles[]" value="<?=$perfil->getCaPerfil()?>" <?=in_array($perfil->getCaPerfil(), $perfilesUsuario )?'checked="checked"':'' ?> />
						</div></td>
				<td width="22%"><?=$perfil->getCaNombre()?></td>
				
				<td><?=$perfil->getCaDescripcion()?></td>
			</tr>
			<?
			}
			?>
		</table></td>
		</tr>
	<tr>
		<td><div align="center"><input type="submit" value="Guardar" class="button">&nbsp;
			<input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("adminUsers/formUsuario?login=".$usuario->getCaLogin())?>'" />
			</div></td>
		</tr>
</table>
</form>
</div>	
