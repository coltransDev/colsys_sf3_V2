<?
use_helper('ExtCalendar');
?>
<script language="javascript" type="text/javascript">
	Ext.onReady(function(){
        new Ext.form.DateField({
            applyTo: 'fchingreso',
            value: '<?=$usuario->getCaFchingreso()?>',
            width: 100,
            format: 'Y-m-d',
            disabled: <?if($nivel==0){echo 'true';}else{echo 'false';}?>
        });
    });

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
<div align="center">
    <table width="700" border="0" class="tableList">
        <tr>
            <th colspan="4" scope="col"><?=$usuario?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
        </tr>
        <tr>
			<td width="100">
				<div class="box1">
					<img src="<?=url_for('adminUsers/traerImagen?username='.$usuario->getCaLogin().'&tamano=120x150')?>" />
				</div>
			</td>
			<td valign="top" align="left">
				<b><?=(strtoupper($usuario->getCaNombre())) ?></b><br/>
				<b><?=($usuario->getCaCargo()) ?></b><br />
			</td>
		</tr>
	</table>

	<table width="700" border="0" class="tableList">
        <tr>
            <td colspan="2">
                <div class="tab-pane" id="tab-pane-1">
                    <div class="tab-page">
                        <h2 class="tab">Laboral</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
							<tr class="row0">
								<td>
									<div align="left">
										<b>Login</b>
									</div>
								</td>
								<td>
									<div align="left">
										<?
										if( $usuario->getCaLogin() ){
											 ?>
											<input type="hidden" name="login" value="<?=$usuario->getCaLogin()?>" />
											<?
											echo $usuario->getCaLogin();
										}else{
										?>
											<input type="text" name="login" value="<?=$usuario->getCaLogin()?>" />
										<?
										}
										?>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Nombres</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="nombres" value="<?=$usuario->getCaNombres()?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Apellidos</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="apellidos" value="<?=$usuario->getCaApellidos()?>" />
									</div>
								</td>
							</tr>
                            <tr class="row0">
								<td>
									<div align="left">
										<b>Nombre para mostrar</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="nombre" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaNombre()?>" />
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Empresa</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="empresa" <?if($nivel==0){?>disabled="disabled"<?}?> >
											<?
											foreach( $empresas as $empresa ){
											?>
											<option value="<?=$empresa['ca_empresa']?>"<?=$usuario->getCaEmpresa()==$empresa['ca_empresa']?'selected="selected"':''?> > <?=($empresa['ca_empresa'])?></option>
											<?
											}
											?>
										</select>
										<!--<input type="text" name="empresa" value="<?//=$usuario->getCaEmpresa()?>"/>-->
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Sucursal</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="idsucursal" <?if($nivel==0){?>disabled="disabled"<?}?>>
											<?
											foreach( $sucursales as $sucursal ){
											?>
											<option value="<?=$sucursal->getCaIdsucursal()?>" <?=$usuario->getCaIdsucursal()==$sucursal->getCaIdsucursal()?'selected="selected"':''?>  >
												<?=($sucursal->getCaNombre())?>
												</option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Departamento</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="departamento" <?if($nivel==0){?>disabled="disabled"<?}?>>
												<?
													foreach( $departamentos as $departamento ){
												?>
												<option value="<?=$departamento->getCaNombre()?>" <?=$usuario->getCaDepartamento()==$departamento->getCaNombre()?'selected="selected"':''?>  >
													<?=($departamento->getCaNombre())?>
												</option>
												<?
												}
												?>
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Cargo</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input <?if($nivel==0){?>disabled="disabled"<?}?> type="text" name="cargo" value="<?=$usuario->getCaCargo()?>" size="40"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Jefe Directo</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input <?if($nivel==0){?>disabled="disabled"<?}?> type="text" name="manager" value="<?=($usuario->getCaManager())?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Correo Electr&oacute;nico</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input <?if($nivel==0){?>disabled="disabled"<?}?> type="text" name="email" value="<?=$usuario->getCaEmail()?>" size="40" />
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Fecha de Ingreso</b>
									</div>
								</td>
								<td>
									<input style="width: 75px;" class=" x-form-text x-form-field " id="fchingreso" name="fchingreso" type="text" />
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Tel. Oficina</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input <?if($nivel==0){?>disabled="disabled"<?}?> type="text" name="teloficina" value="<?=$usuario->getCaTeloficina()?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Extensi&oacute;n:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="extension" value="<?=$usuario->getCaExtension()?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Foto</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input <?if($nivel==0){?>disabled="disabled"<?}?> type="file" name="foto" id="foto"  />
									</div>
								</td>
							</tr>
						</table>
                    </div>
                    <div class="tab-page">
                        <h2 class="tab">Personal</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
							<tr class="row0">
								<td>
									<div align="left">
										<b>M&oacute;vil</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="movil" value="<?=$usuario->getCaMovil()?>" />
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Fecha de Nacimiento</b>
									</div>
								</td>
								<td>
									<div align="left">
										 <?echo extDatePicker("cumpleanos", ($usuario?$usuario->getCaCumpleanos("Y-m-d"):date("Y-m-d")));?>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Tipo de Sangre</b>
									</div>
								</td>
								<td>
									<div align="left">
									   <select name="tiposangre"                    >
											<?
											foreach( $tiposangre as $sangre ){
											?>
											<option value="<?=$sangre['ca_tiposangre']?>"<?=$usuario->getCaTiposangre()==$sangre['ca_tiposangre']?'selected="selected"':''?> > <?=($sangre['ca_tiposangre'])?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
										<b>Direcci&oacute;n Particular</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="direccion" value="<?=$usuario->getCaDireccion()?>" size="40"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Tel. Particular:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="telparticular" value="<?=$usuario->getCaTelparticular()?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Familiar de Contacto:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="nombrefamiliar" value="<?=$usuario->getCaNombrefamiliar()?>" size="40"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Tel. Familiar:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="telfamiliar" value="<?=$usuario->getCaTelfamiliar()?>"/>
									</div>
								</td>
							</tr>
                            <tr class="row0">
								<td>
									<div align="left">
											<b>Parentesco:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="parentesco"                    >
											<?
											foreach( $parentescos as $parentesco ){
											?>
											<option value="<?=$parentesco['ca_parentesco']?>"<?=$usuario->getCaParentesco()==$parentesco['ca_parentesco']?'selected="selected"':''?> > <?=($parentesco['ca_parentesco'])?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
					   </table>
                    </div>
                    <?
                    if($nivel>=1 ){
                    ?>
                    <div class="tab-page">
						<h2 class="tab">Sistemas</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
							<tr class="row0">
								<td>
									<div align="left">
										<b>Metodo de autenticaci&oacute;n:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="auth_method" id="auth_method" onchange='lockFields(this)' <?if(!($nivel==3)){?>disabled="disabled"<?}?>  >
											<option value="ldap" <?=$usuario->getCaAuthmethod()=="ldap"?'selected="selected"':''?>>LDAP con Perfiles</option>
                                            <option value="sha1" <?if($usuario->getCaAuthmethod()=="sha1" or !($usuario->getCaAuthmethod()=="ldap")){echo 'selected="selected"';}?>>Base de datos</option>
                                        </select>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Contrase&ntilde;a (Dejar en blanco para mantener actual)</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="password" name="passwd1" id="passwd1" Autocomplete="off" <?if(!($nivel==3)){?>disabled="disabled"<?}?>/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Confirmaci&oacute;n Contrase&ntilde;a</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="password" name="passwd2" id="passwd2" Autocomplete="off"  <?if(!($nivel==3)){?>disabled="disabled"<?}?>/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Forzar cambio en el proximo inicio de sesión</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?> <?if(!($nivel==3)){?>disabled="disabled"<?}?>/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>
									<div align="left">
											<b>Activo</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" name="activo" id="activo"  <?=($usuario->getCaActivo()||!$usuario->getCaLogin())?'checked="checked"':''?> />
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
                <?
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" value="Guardar" class="button" />&nbsp;
                    <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("users/directory")?>'" />&nbsp;
                </div>
            </td>
        </tr>
    </table>
</div>
</form>
<script language="javascript" type="text/javascript">
	lockFields(document.getElementById('auth_method'));
</script>