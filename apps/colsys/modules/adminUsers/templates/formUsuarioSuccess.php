<div align="center">
<script language="javascript">
	function lockFields( field ){
		if( field.value=="ldap" ){			
			document.getElementById("passwd1").disabled=true;
			document.getElementById("passwd2").disabled=true;
			document.getElementById("forcechange").disabled=true;
		}else{
			document.getElementById("passwd1").disabled=false;
			document.getElementById("passwd2").disabled=false;
			document.getElementById("forcechange").disabled=false;
		}	
	}
	
	function checkForm(){
		if( document.getElementById('auth_method').value=="sha1"){			
			if( document.getElementById("passwd1").value!= document.getElementById("passwd2").value ){
				alert( "La claves no coinciden" );
				return false;
			}			
		}
		return true;
	}
</script>
<form name="form1" action="<?=url_for("adminUsers/guardarUsuario")?>" method="post" onsubmit="return checkForm()">
	
<table width="80%" border="0" class="tableList">
	<tr>
		<th colspan="2" scope="col"><?=$usuario?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
	</tr>
	<tr>
		<td width="46%"><div align="left"><b>Login:</b></div></td>
		<td width="54%">		
			<div align="left">
				<?
			if( $usuario->getCaLogin() ){
				echo $usuario->getCaLogin();
				?>
				<input type="hidden" name="login" value="<?=$usuario->getCaLogin()?>" />	
				<?
			}else{
				?>
				<input type="text" name="login" value="<?=$usuario->getCaLogin()?>" />
				<?
			}
			
			?>		
			</div></td>
	</tr>
	
	<tr>
		<td><div align="left"><b>Nombre:</b></div></td>
		<td><div align="left">
			<input type="text" name="nombre" value="<?=$usuario->getCaNombre()?>" size="60" />
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Extensi&oacute;n:</b></div></td>
		<td><div align="left">
			<input type="text" name="extension" value="<?=$usuario->getCaExtension()?>" size="60" />
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Correo Electronico </b></div></td>
		<td><div align="left">
			<input type="text" name="email" value="<?=$usuario->getCaEmail()?>" size="60" />
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Cargo:</b></div></td>
		<td><div align="left">
			<input type="text" name="cargo" value="<?=$usuario->getCaCargo()?>" size="60" />
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Departamento:</b></div></td>
		<td>
			<div align="left">
				<select name="departamento">				
					<?
				foreach( $departamentos as $departamento ){
				?>
					<option value="<?=$departamento->getCaNombre()?>" <?=$usuario->getCaDepartamento()==$departamento->getCaNombre()?'selected="selected"':''?>  >
						<?=$departamento->getCaNombre()?>
						</option> 
					<?
				}
				?>
				</select>
			</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Sucursal:</b></div></td>
		<td><div align="left">
			<select name="idsucursal" >
				<?
				foreach( $sucursales as $sucursal ){
				?>
				<option value="<?=$sucursal->getCaIdsucursal()?>" <?=$usuario->getCaIdsucursal()==$sucursal->getCaIdsucursal()?'selected="selected"':''?>  >
					<?=$sucursal->getCaNombre()?>
					</option>
				<?
				}
				?>
			</select>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Metodo de autenticaci&oacute;n:</b></div></td>
		<td><div align="left">
			<select name="auth_method" id="auth_method" onchange='lockFields(this)'>			
				<option value="ldap" <?=$usuario->getCaAuthMethod()=="ldap"?'selected="selected"':''?>>LDAP con Perfiles</option>
				<option value="sha1" <?=$usuario->getCaAuthMethod()=="sha1"?'selected="selected"':''?>>Base de datos</option>
			</select>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Contrase&ntilde;a (Dejar en blanco para mantener actual) </b></div></td>
		<td>
			<div align="left">
				<input type="password" name="passwd1" id="passwd1" Autocomplete="off" />		
			</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Confirmaci&oacute;n Contrase&ntilde;a</b></div></td>
		<td>
			<div align="left">
				<input type="password" name="passwd2" id="passwd2" Autocomplete="off"  />		
			</div></td>
	</tr>	
	<tr>
		<td><div align="left"><b>Forzar cambio en el proximo inicio de sesión</b></div></td>
		<td>
			<div align="left">
				<input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?>/>		
			</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Activo</b></div></td>
		<td><div align="left">
			<input type="checkbox" name="activo" id="activo"  <?=($usuario->getCaActivo()||!$usuario->getCaLogin())?'checked="checked"':''?>/>
		</div></td>
	</tr>
	
	<tr>
		<td colspan="2"><div align="center">
							<input type="submit" value="Guardar" class="button" />&nbsp;
							<input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("adminUsers/index")?>'" />&nbsp;
						</div>		</td>
	</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
	lockFields(document.getElementById('auth_method'));
</script>
</div>