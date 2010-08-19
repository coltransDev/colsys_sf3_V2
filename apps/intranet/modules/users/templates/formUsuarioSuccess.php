<?
use_helper('ExtCalendar');
?>

<form name="form1" action="<?=url_for("users/guardarUsuario")?>" method="post" onsubmit="return checkForm()" enctype="multipart/form-data" >
<div align="center">
    <table width="700" border="0" class="tableList">
        <tr>
            <th colspan="4" scope="col"><?=$usuario?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
        </tr>
        <tr>
			<td width="100">
				<div class="box1">
					<img src="<?=url_for('users/traerImagen?username='.$usuario->getCaLogin().'&tamano=120x150')?>" />
				</div>
			</td>
			<td valign="top" align="left">
				<b><?=utf8_encode(strtoupper($usuario->getCaNombre())) ?></b><br/>
				<b><?=utf8_encode($usuario->getCaCargo()) ?></b><br />
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
                                            <b>Empresa</b>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="left">
                                            <select name="empresa" disabled="disabled" >
                                                <?
                                                foreach( $empresas as $empresa ){
                                                ?>
                                                <option value="<?=$empresa['ca_empresa']?>"<?=$usuario->getCaEmpresa()==$empresa['ca_empresa']?'selected="selected"':''?> > <?=utf8_encode($empresa['ca_empresa'])?></option>
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
                                            <select name="idsucursal" disabled="disabled">
                                                <?
                                                foreach( $sucursales as $sucursal ){
                                                ?>
                                                <option value="<?=$sucursal->getCaIdsucursal()?>" <?=$usuario->getCaIdsucursal()==$sucursal->getCaIdsucursal()?'selected="selected"':''?>  >
                                                    <?=utf8_encode($sucursal->getCaNombre())?>
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
                                            <select name="departamento" disabled="disabled">
                                                    <?
                                                        foreach( $departamentos as $departamento ){
                                                    ?>
                                                    <option value="<?=$departamento->getCaNombre()?>" <?=$usuario->getCaDepartamento()==$departamento->getCaNombre()?'selected="selected"':''?>  >
                                                        <?=utf8_encode($departamento->getCaNombre())?>
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
                                            <input disabled="disabled" type="text" name="cargo" value="<?=$usuario->getCaCargo()?>" size="40"/>
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
                                            <input disabled="disabled" type="text" name="manager" value="<?=utf8_encode($manager->getCaNombre())?>"/>
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
                                            <input disabled="disabled" type="text" name="email" value="<?=$usuario->getCaEmail()?>" size="40" />
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
                                        <?echo extDatePicker("fchingreso", ($usuario?$usuario->getCaFchingreso("Y-m-d"):date("Y-m-d")));?>
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
                                            <input type="text" name="teloficina" value="<?=$usuario->getCaTeloficina()?>"/>
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
                                            <input type="file" name="foto" id="foto"  />
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
                                            <input type="text" name="tiposangre" value="<?=$usuario->getCaTiposangre()?>"/>
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
                           </table>
                    </div>
                </div>
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