<div align="center">
<script language="javascript">
	function lockFields( field ){
		if( field.value=="ldap" || field.value=="ldapP"){			
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
		<td width="46%"><b>Login:</b></td>
		<td width="54%">		
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
			
			?>		</td>
	</tr>
	
	<tr>
		<td><b>Nombre:</b></td>
		<td><input type="text" name="nombre" value="<?=$usuario->getCaNombre()?>" size="60" /></td>
	</tr>
	<tr>
		<td><b>Extensi&oacute;n:</b></td>
		<td><input type="text" name="extension" value="<?=$usuario->getCaExtension()?>" size="60" /></td>
	</tr>
	<tr>
		<td><b>Correo Electronico </b></td>
		<td><input type="text" name="email" value="<?=$usuario->getCaEmail()?>" size="60" /></td>
	</tr>
	<tr>
		<td><b>Cargo:</b></td>
		<td><input type="text" name="cargo" value="<?=$usuario->getCaCargo()?>" size="60" /></td>
	</tr>
	<tr>
		<td><b>Departamento:</b></td>
		<td>
			<select name="departamento">				
				<?
				foreach( $departamentos as $departamento ){
				?>
				<option value="<?=$departamento->getCaNombre()?>" <?=$usuario->getCaDepartamento()==$departamento->getCaNombre()?'selected="selected"':''?>  ><?=$departamento->getCaNombre()?></option> 
				<?
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>Sucursal:</b></td>
		<td><select name="idsucursal" >
			<?
				foreach( $sucursales as $sucursal ){
				?>
			<option value="<?=$sucursal->getCaIdsucursal()?>" <?=$usuario->getCaIdsucursal()==$sucursal->getCaIdsucursal()?'selected="selected"':''?>  >
				<?=$sucursal->getCaNombre()?>
				</option>
			<?
				}
				?>
		</select></td>
	</tr>
	<tr>
		<td><b>Metodo de autenticaci&oacute;n:</b></td>
		<td><select name="auth_method" id="auth_method" onchange='lockFields(this)'>
			<option value="ldapP" <?=$usuario->getCaAuthMethod()=="ldapP"?'selected="selected"':''?>>LDAP con Perfiles</option>
			<option value="ldap" <?=$usuario->getCaAuthMethod()=="ldap"?'selected="selected"':''?>>LDAP con grupos de Novell</option>
			<option value="sha1" <?=$usuario->getCaAuthMethod()=="sha1"?'selected="selected"':''?>>Base de datos</option>
		</select></td>
	</tr>
	<tr>
		<td><b>Contrase&ntilde;a (Dejar en blanco para mantener actual) </b></td>
		<td>
			<input type="password" name="passwd1" id="passwd1" Autocomplete="off" />		</td>
	</tr>
	<tr>
		<td><b>Confirmaci&oacute;n Contrase&ntilde;a</b></td>
		<td>
			<input type="password" name="passwd2" id="passwd2" Autocomplete="off"  />		</td>
	</tr>
	
	<tr>
		<td><b>Forzar cambio en el proximo inicio de sesión</b></td>
		<td>
			<input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?>/>		</td>
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