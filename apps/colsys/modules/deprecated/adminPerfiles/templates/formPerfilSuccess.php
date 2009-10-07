

<div class="content" align="center">

<h3><?=$perfil?"Edici&oacute;n de ":"Nuevo "?>Perfil</h3>
<br />
<form action="<?=url_for("adminPerfiles/guardarPerfil")?>" method="post">
	<input type="hidden" name="perfil" value="<?=$perfil->getCaPerfil()?>" />
<table width="65%" border="1" class="tableList" >
	<tr>
		<th colspan="2">&nbsp;</th>
	</tr>
	<tr>
		<td width="50%" ><b>Nombre del perfil:</b></td>
		<td width="50%" ><input type="text" name="nombre" value="<?=$perfil->getCaNombre()?>" size="60" /></td>
	</tr>		
	<tr>
		<td ><b>Descripci&oacute;n:</b>
			<?=$perfil->getCaDescripcion()?>		</td>
		<td >
			<textarea name="descripcion" cols="55" rows="2"><?=$perfil->getCaDescripcion()?></textarea>
		</td>
	</tr>	
	
	<tr>
		<td ><b>Departamento:</b></td>
		<td >
			<select name="departamento">
				<option value=""  ></option>
				<?
				foreach( $departamentos as $departamento ){
				?>
				<option value="<?=$departamento->getCaNombre()?>" <?=$perfil->getCaDepartamento()==$departamento->getCaNombre()?'selected="selected"':''?>  ><?=$departamento->getCaNombre()?></option> 
				<?
				}
				?>
			</select>
		</td>
	</tr>	
	
	<tr>
		<td colspan="2" >
			<div align="center">
				<input type="submit" value="Guardar" class="button">
				&nbsp;
				<input type="button" value="Cancelar" class="button" onClick="document.location= '<?=url_for("adminPerfiles/index")?>'">
			</div>		</td>
	</tr>	
</table>
</form>
</div>




