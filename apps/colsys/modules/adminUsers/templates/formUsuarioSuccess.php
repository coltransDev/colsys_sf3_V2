<div align="center">
<script language="javascript">
	function lockFields( field ){
		if( field.value=="ldap" ){			
			document.getElementById("passwd1").disabled=true;
			document.getElementById("passwd2").disabled=true;
		}else{
			document.getElementById("passwd1").disabled=false;
			document.getElementById("passwd2").disabled=false;
		}	
	}
	
	function checkForm(){
		if( document.getElementById('auth_method').value!="ldap" ){			
			if( document.getElementById("passwd1").value!= document.getElementById("passwd2").value ){
				alert( "La claves no coinciden" );
				return false;
			}			
		}
		return true;
	}
</script>
<form name="form1" action="<?=url_for("adminUsers/guardarUsuario")?>" method="post" onsubmit="return checkForm()">
	<input type="hidden" name="login" value="<?=$usuario->getCaLogin()?>" />
<table width="80%" border="0" class="tableList">
	<tr>
		<th colspan="2" scope="col"><?=$usuario?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
	</tr>
	<tr>
		<td width="46%"><b>Login:</b> <?=$usuario->getCaLogin()?></td>
		<td width="54%"><b>Nombre:</b>
			<?=$usuario->getCaNombre()?></td>
	</tr>
	
	<tr>
		<td><b>Metodo de autenticaci&oacute;n:</b></td>
		<td><select name="auth_method" id="auth_method" onChange='lockFields(this)'>
			<option value="ldap" <?=$usuario->getCaAuthMethod()=="ldap"?'selected="selected"':''?>>LDAP de Novell</option>
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
		<td colspan="2"><div align="center"><input type="submit" value="Guardar" /></div></td>
		</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
	lockFields(document.getElementById('auth_method'));
</script>
</div>