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
<form name="form1" action="<?=url_for("adminUsers/guardarUsuario")?>" method="post" onsubmit="return checkForm()" enctype="multipart/form-data" >

<table width="80%" border="0" class="tableList">
	<tr>
		<th colspan="4" scope="col"><?=$usuario?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
	</tr>
    <tr>
		<td width="25%"><div align="left"><b>Login:</b></div></td>
		<td width="25%">
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
        <td  width="25%" rowspan="8" align="center">
            <div class="box1">
               <img src="<?=url_for('users/traerImagen?username='.$usuario->getCaLogin().'&tamano=120x150')?>" />
            </div>
        </td>
	</tr>
	
	<tr>
		<td><div align="left"><b>Nombre para mostrar:</b></div></td>
		<td><div align="left">
			<input type="text" name="nombre" value="<?=$usuario->getCaNombre()?>" size="60" />
		</div></td>
	</tr>
    <tr>
		<td><div align="left"><b>Empresa:</b></div></td>
		<td><div align="left">
			<input type="text" name="empresa" value="<?=$usuario->getCaEmpresa()?>" size="60" />
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
		<td><div align="left"><b>Correo Electronico </b></div></td>
		<td><div align="left">
			<input type="text" name="email" value="<?=$usuario->getCaEmail()?>" size="60" />
		</div></td>
	</tr>
    <tr>
		<td><div align="left"><b>Foto</b></div></td>
		<td><div align="left">
			<input type="file" name="foto" id="foto"  />
		</div></td>
    </tr>
    <tr>
        <td><div align="left"><b>Fecha de Ingreso </b></div></td>
		<td><div align="left">
			<input type="text" name="fchingreso" value="<?=$usuario->getCaFchingreso()?>" size="60" />
		</div></td>
		<td><div align="left"><b>Nombres </b></div></td>
		<td><div align="left">
			<input type="text" name="nombres" value="<?=$usuario->getCaNombres()?>" size="60" />
		</div></td>
	</tr>
    <tr>
        <td><div align="left"><b>Jefe Directo </b></div></td>
		<td><div align="left">
                <input type="text" name="manager" value="<?=$usuario->getCaManager()?>" size="60" />
            </div></td>
        <td><div align="left"><b>Apellidos </b></div></td>
		<td><div align="left">
			<input type="text" name="apellidos" value="<?=$usuario->getCaApellidos()?>" size="60" />
            </div></td>
	</tr>
     <tr>
        <td><div align="left"><b>Tel. Oficina </b></div></td>
		<td><div align="left">
                <input type="text" name="teloficina" value="<?=$usuario->getCaTeloficina()?>" size="60" />
            </div></td>
        <td><div align="left"><b>Fecha Nacimiento </b></div></td>
		<td><div align="left">
                <input type="text" name="cumpleanos" value="<?=$usuario->getCaCumpleanos()?>" size="60" />
            </div></td>
	</tr>
    <tr>
		<td><div align="left"><b>Extensi&oacute;n:</b></div></td>
		<td><div align="left">
			<input type="text" name="extension" value="<?=$usuario->getCaExtension()?>" size="60" />
		</div></td>
        <td><div align="left"><b>Tipo de Sangre:</b></div></td>
		<td><div align="left">
                <input type="text" name="tiposangre" value="<?=$usuario->getCaTiposangre()?>" size="60" />
		</div></td>

	</tr>
	<tr>
        <td><div align="left"><b>Metodo de autenticaci&oacute;n:</b></div></td>
		<td><div align="left">
			<select name="auth_method" id="auth_method" onchange='lockFields(this)'>			
				<option value="ldap" <?=$usuario->getCaAuthmethod()=="ldap"?'selected="selected"':''?>>LDAP con Perfiles</option>
				<option value="sha1" <?=$usuario->getCaAuthmethod()=="sha1"?'selected="selected"':''?>>Base de datos</option>
			</select>
		</div></td>
        <td><div align="left"><b>M&oacute;vil:</b></div></td>
		<td><div align="left">
                <input type="text" name="movil" value="<?=$usuario->getCaMovil()?>" size="60" />
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Contrase&ntilde;a (Dejar en blanco para mantener actual) </b></div></td>
		<td>
			<div align="left">
				<input type="password" name="passwd1" id="passwd1" Autocomplete="off" />		
			</div></td>
        <td><div align="left"><b>Direcci&oacute;n Particular:</b></div></td>
		<td>
            <div align="left">
                <input type="text" name="direccion" value="<?=$usuario->getCaDireccion()?>" size="60" />
            </div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Confirmaci&oacute;n Contrase&ntilde;a</b></div></td>
		<td>
			<div align="left">
				<input type="password" name="passwd2" id="passwd2" Autocomplete="off"  />		
			</div></td>
        <td><div align="left"><b>Tel. Particular:</b></div></td>
		<td>
            <div align="left">
                <input type="text" name="telparticular" value="<?=$usuario->getCaTelparticular()?>" size="60" />
            </div></td>

	</tr>	
	<tr>
		<td><div align="left"><b>Forzar cambio en el proximo inicio de sesión</b></div></td>
		<td>
			<div align="left">
				<input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?>/>		
			</div></td>
        <td><div align="left"><b>Familiar de Contacto:</b></div></td>
		<td>
            <div align="left">
                <input type="text" name="nombrefamiliar" value="<?=$usuario->getCaNombrefamiliar()?>" size="60" />
            </div></td>
	</tr>
	<tr>
		<td><div align="left"><b>Activo</b></div></td>
		<td><div align="left">
			<input type="checkbox" name="activo" id="activo"  <?=($usuario->getCaActivo()||!$usuario->getCaLogin())?'checked="checked"':''?>/>
		</div></td>
        <td><div align="left"><b>Tel. Familiar :</b></div></td>
		<td>
            <div align="left">
                <input type="text" name="telfamiliar" value="<?=$usuario->getCaTelfamiliar()?>" size="60" />
            </div></td>
    </tr>
    
	
	<tr>
		<td colspan="4"><div align="center">
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