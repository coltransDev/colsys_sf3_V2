<?
use_helper('ExtCalendar');

$sucursales = $sf_data->getRaw("sucursales");
$departamentos = $sf_data->getRaw("departamentos");
$cargos = $sf_data->getRaw("cargos");
$jefes = $sf_data->getRaw("jefes");
//$teloficinas = $sf_data->getRaw("teloficinas");
//$hijos = $sf_data->getRaw("hijos");

//echo $nivel;

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

    Ext.onReady(function(){
        new Ext.form.DateField({
            applyTo: 'cumpleanos',
            value: '<?=$usuario->getCaCumpleanos()?>',
            width: 100,
            format: 'Y-m-d',
            disabled: <?if($nivel==0){echo 'true';}else{echo 'false';}?>
        });
    });

	function lockFields( field ){
		if(field&&typeof(field)!='undefined'){
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
	}
    
    function showFieldsEnf( field ){
		if(field&&typeof(field)!='undefined'){
            if( field.checked){
				document.getElementById("enfermedad").disabled=false;
			}else{
				document.getElementById("enfermedad").disabled=true;
			}
		}
	}
    
    function showFieldsAle( field ){
		if(field&&typeof(field)!='undefined'){
            if( field.checked){
				document.getElementById("alergico").disabled=false;
			}else{
				document.getElementById("alergico").disabled=true;
			}
		}
	}
    
     function validarSiNumero(e){
         tecla = (document.all) ? e.keyCode : e.which;
         if (tecla==8) return true;
         patron =/[0-9\s]/;
         te = String.fromCharCode(tecla);
         return patron.test(te);
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


    function cambiarValores(defaultValSuc, defaultValDep, defaultValCar, defaultValJef){
        //Actualizamos sucursales
        var idempresa = document.getElementById("empresa").value;       

        var sucursales = <?=json_encode($sucursales)?>;
        
        var sucursalesFld = document.getElementById("idsucursal");
        sucursalesFld.length=0;
        for( i in sucursales ){
            if( typeof(sucursales[i]['ca_idsucursal'])!="undefined" ){
                
                if( idempresa == sucursales[i]['ca_idempresa'] ){                   
                    if( defaultValSuc == sucursales[i]["ca_idsucursal"] ){
                        var selected = true;
                    }else{
                        var selected = false;
                    }
                    
                    sucursalesFld[sucursalesFld.length] = new Option(sucursales[i]['ca_nombre'],sucursales[i]['ca_idsucursal'], selected);
                }
            }
        }
        sucursalesFld.value = defaultValSuc;

        var departamentos = <?=json_encode($departamentos)?>;
//        alert(departamentos.toSource());
        var departamentosFld = document.getElementById("departamento");
        departamentosFld.length=0;
        for( i in departamentos ){

            if( typeof(departamentos[i]['ca_nombre'])!="undefined" ){
                if( idempresa == departamentos[i]['ca_idempresa'] ){
                    if( defaultValDep == departamentos[i]["ca_nombre"] ){
                        var selected = true;
                    }else{
                        var selected = false;
                    }

                    departamentosFld[departamentosFld.length] = new Option(departamentos[i]['ca_nombre'],departamentos[i]['ca_nombre'], selected);
                }
            }
        }
        departamentosFld.value = defaultValDep;
		
		var cargos = <?=json_encode($cargos)?>;
        var cargosFld = document.getElementById("cargo");
        cargosFld.length=0;
        for( i in cargos ){

            if( typeof(cargos[i]['ca_cargo'])!="undefined" ){
                if( idempresa == cargos[i]['ca_idempresa'] ){
                    if( defaultValCar == cargos[i]["ca_cargo"] ){
                        var selected = true;
                    }else{
                        var selected = false;
                    }

                    cargosFld[cargosFld.length] = new Option(cargos[i]['ca_cargo'],cargos[i]['ca_cargo'], selected);
                }
            }
        }
        cargosFld.value = defaultValCar;
        
        cambiarValoresManager(defaultValJef);

       

    }


    function cambiarValoresManager(defaultValJef){
        //Actualizamos sucursales
        var idempresa = document.getElementById("empresa").value;
        var sucursalesFld = document.getElementById("idsucursal");        
        var departamentosFld = document.getElementById("departamento");
        
        //alert( departamentosFld.value );
        var jefes = <?=json_encode($jefes)?>;
        var jefesFld = document.getElementById("manager");
        jefesFld.length=0;
        for( i in jefes ){
            if( typeof(jefes[i]['j_ca_cargo'])!="undefined" ){
                //alert(defaultValJef);
                if( idempresa == jefes[i]['c_ca_idempresa'] || idempresa == 1 || idempresa == 2 || idempresa == 8){
                    //alert(jefes[i]["j_ca_login"]);

                    if( defaultValJef == jefes[i]["j_ca_login"]){
                        var selected = true;
                    }else{
                        var selected = false;
                    }

                    jefesFld[jefesFld.length] = new Option(jefes[i]['j_ca_nombre'],jefes[i]['j_ca_login'], selected);

                }
            }
        }
        jefesFld.value = defaultValJef;



    }

</script>

<?if($key){$param="key=".$key;}else{$param="";}?>

<form name="form1" action="<?=url_for("adminUsers/guardarUsuario?".$param)?>" method="post" onsubmit="return checkForm()" enctype="multipart/form-data" >
<div class="content" align="center">
    
    <table width="100%" border="0" class="tableList">
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

	<table width="100%" border="0" class="tableList">
        <tr>
            <td colspan="2">
                <div class="tab-pane" id="tab-pane-1">
                    <div class="tab-page">
                        <h2 class="tab">Laboral</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>Informaci&oacute;n Laboral</b>
									</div>
								</td>
                            </tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Nombres</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" size="30" name="nombres" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaNombres()?>"/>
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Apellidos</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" size="30" name="apellidos" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaApellidos()?>" />
									</div>
								</td>
							</tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Nombre para mostrar</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" size="30" name="nombre" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaNombre()?>" />
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Empresa</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="empresa" id="empresa" <?if($nivel==0){?>disabled="disabled"<?}?> onChange="cambiarValores('<?=$usuario->getCaIdsucursal()?>','<?=$usuario->getCaDepartamento()?>','<?=$usuario->getCaCargo()?>','<?=$usuario->getCaManager()?>')">
<?
											foreach( $empresas as $empresa ){
?>
                                                <option value="<?=$empresa->getCaIdempresa()?>" <?=$usuario->getSucursal()->getEmpresa()->getCaNombre()==$empresa->getCaNombre()?'selected="selected"':''?> >
                                                        <?=$empresa->getCaNombre()?>
                                                </option>
<?
											}
?>
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Sucursal</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="idsucursal" id="idsucursal" <?if($nivel==0){?>disabled="disabled"<?}?>>
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Departamento</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="departamento" id="departamento" <?if($nivel==0){?>disabled="disabled"<?}?> onChange="cambiarValoresManager('<?=$usuario->getCaManager()?>')">
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Cargo</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="cargo" id="cargo" <?if($nivel==0){?>disabled="disabled"<?}?>>												
										</select>
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Jefe Directo</b>
									</div>
								</td>
								<td>
                                    <div align="left">
										<select name="manager" id="manager" <?if($nivel==0){?>disabled="disabled"<?}?>>
										</select>
									</div>
                                </td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Fecha de Ingreso</b>
									</div>
								</td>
								<td>
									<input align="left" style="width: 75px;" class=" x-form-text x-form-field " id="fchingreso" name="fchingreso" type="text" />
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Tel. Oficina</b>
									</div>
								</td>
								<td>
									<div align="left">
											<?
											//foreach( $teloficinas as $teloficina ){
											?>
                                                <!--<option value="<?//=$teloficina['u_ca_teloficina']?>"<?//=$usuario->getCaTeloficina()==$teloficina['u_ca_teloficina']?'selected="selected"':''?> > <?//=($teloficina['u_ca_teloficina'])?></option>-->
											<?
											//}                                            
											?>
                                        <input type="text" name="teloficina" disabled="disabled" value="<?=$usuario->getSucursal()->getCaTelefono()?>"/>
									</div>
								</td>
							</tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Fondo de Cesantias:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="fcesantias">
                                            <option value="">Por favor seleccione una opci&oacute;n</option>
											<?
											foreach( $fcesantias as $fcesantia ){
											?>
                                                <option value="<?=$fcesantia->getCaIdentificacion()?>" <?=$usuario->getCaFcesantias()==$fcesantia->getCaIdentificacion()?'selected="selected"':''?>> <?=$fcesantia->getCaValor()?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
                            <?
                            if(!$nivel==0){
                            ?>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
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
                            <?
                            }
                            ?>
						</table>
                    </div>
                    <div class="tab-page">
                        <h2 class="tab">Personal</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>Datos Personales</b>
									</div>
								</td>
                            </tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
                                        <b>Documento de Identidad</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="docidentidad" onkeypress="return validarSiNumero(event)" value="<?=$usuario->getCaDocidentidad()?>" />
									</div>
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Fecha de Nacimiento</b>
									</div>
								</td>
								<td>
                                    <input align="left" style="width: 75px;" class=" x-form-text x-form-field " id="cumpleanos" name="cumpleanos" type="text" />
								</td>
							</tr>
							<tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Estrato:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="estrato">
											<?
											for( $i=1; $i<7;$i++){
											?>
                                                <option value="<?=$i?>"<?=$usuario->getCaEstrato()==$i?'selected':''?> >    <?=($i)?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">  
										<b>Sexo</b>
									</div>
								</td>
								 <td>
									<div align="left">
										<select name="sexo" id="sexo">
                                            <option value="" <?=$usuario->getCaSexo()==""?'selected="selected"':''?>></option>
											<option value="F" <?=$usuario->getCaSexo()=="F"?'selected="selected"':''?>>Femenino</option>
                                            <option value="M" <?=$usuario->getCaSexo()=="M"?'selected="selected"':''?>>Masculino</option>
                                        </select>
									</div>
								</td>
							</tr>
							<tr class="row2" >
                                <td colspan="3">
									<div align="left">  
										<b>Escolaridad</b>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Nivel de Estudios:</b>
									</div>
								</td>
                                <td>
									<div align="left">
										<select name="nivestudio">
                                            <option value="">Por favor seleccione una opci&oacute;n</option>
											<?
											foreach( $nivestudios as $nivestudio ){
											?>
                                                <option value="<?=$nivestudio->getCaValor()?>"<?=$usuario->getCaNivestudios()==$nivestudio->getCaValor()?'selected="selected"':''?> > <?=($nivestudio->getCaValor())?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
                            </tr>
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>Brigada de Emergencia</b>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
										<b>Tipo de Sangre</b>
									</div>
								</td>
								<td>
									<div align="left">
									   <select name="tiposangre" >
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
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Donante de Sangre</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" name="donante" id="donante"  <?=($usuario->getCaDonante()||!$usuario->getCaLogin())?'checked="checked"':''   ?>/>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Padece alguna Enfermedad</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" onclick='showFieldsEnf(this)' name="chk_enfermedad" id="chk_enfermedad" <?=$usuario->getCaEnfermedad()!=null?'checked="checked"':''?>/>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Especifique</b>
									</div>
								</td>
								<td>
									<div align="left">
                                        <input type="text" name="enfermedad" id="enfermedad" value="<?$usuario->getCaEnfermedad()?>" size="40" />
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Al�rgico alg�n medicamento</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" onclick='showFieldsAle(this)' name="chk_alergico" id="chk_alergico" <?=$usuario->getCaAlergico()!=null?'checked="checked"':''?>/>
									</div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Especifique</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="text" name="alergico" id="alergico" disabled="disabled" value="<?=$usuario->getCaAlergico()?>" size="40"/>
									</div>
								</td>
                            </tr>
					   </table>
                    </div>
                    <div class="tab-page">
                        <h2 class="tab">Familiar</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
<!--                            <tr class="row2" >
								<td colspan="2">
									<div align="left"> 
										<b>Hijos</b><br />
                                        
                                        <?=link_to(image_tag("page_white_edit.png"),"adminUsers/formUsuario?login=".$usuario->getCaLogin())?>
									</div>
								</td>
                                
                            </tr>-->
                            <?
							/*foreach( $hijos as $hijo ){
                            ?>
                            <tr class="row0">
                                
                                <td>
									<div align="left">
                                        <b><?=$hijo['h_ca_nombres'];?></b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <?
                                        $fecha_actual = date("Y-m-d");
                                        $fecha_nacimiento = $hijo['h_ca_fchnacimiento'];
                                        $edad_dias = TimeUtils::dateDiff( $fecha_nacimiento,$fecha_actual);
                                        $edad_meses = $edad_dias/30;
                                        $edad_a�os = $edad_meses/12;
                                        ?>
                                        <?=$edad_meses<12?round($edad_meses)." meses":floor($edad_a�os)." a�os";?>
                                    </div>
                                </td>
                            </tr>
                            <?
                            }*/
                            ?>                             
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>Contacto</b>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
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
                                <td>&nbsp;</td>
								<td width="40%">
									<div align="left">
											<b>Parentesco:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="parentesco">
											<?
											foreach( $parentescos as $parentesco ){
											?>
											<option value="<?=$parentesco->getCaValor()?>" <?=$usuario->getCaParentesco()==$parentesco->getCaValor()?'selected="selected"':''?> > <?=($parentesco->getCaValor())?></option>
											<?
											}
											?>
										</select>
									</div>
								</td>
							</tr>
                         </table>
                    </div>
                    <div class="tab-page">
                        <h2 class="tab">T.Humano</h2>
                        <table width="100%" cellspacing="0"  class="tableList alignLeft">
                            <tr class="row2" >
                                <td colspan="3">
                                    <div align="left">  
                                        <b>Desvinculaci�n de Usuario</b>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a title="Email a nivel Nacional Coltrans, Colmas y ColOtm" href="<?=url_for('adminUsers/emailDesvinculacion?login='.$usuario->getCaLogin())?>">Enviar notificaci&oacute;n de desvinculaci&oacute;n del Usuario <b><?=$usuario->getCaNombre();?></b></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <?
                    if($nivel>=2 ){
                    ?>
                    <div class="tab-page">
						<h2 class="tab">Sistemas</h2>
						<table width="100%" cellspacing="0"  class="tableList alignLeft">
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>COLSYS</b>
									</div>
								</td>
                            </tr>
							<tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
										<b>Metodo de autenticaci&oacute;n:</b>
									</div>
								</td>
								<td>
									<div align="left">
										<select name="auth_method" id="auth_method" onchange='lockFields(this)' <?if(!($nivel==3)){?>disabled="disabled"<?}?>  >
											<option value="ldap" <?=$usuario->getCaAuthmethod()=="ldap"?'selected="selected"':''?>>LDAP con Perfiles</option>
                                            <option value="sha1" <?=$usuario->getCaAuthmethod()=="sha1"?'selected="selected"':''?>>Base de datos</option>
                                        </select>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
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
								<td>&nbsp;</td>
                                <td width="40%">
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
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Forzar cambio en el proximo inicio de sesi�n</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?> <?if(!($nivel==3)){?>disabled="disabled"<?}?>/>
									</div>
								</td>
							</tr>
							<tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Activo</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="checkbox" name="activo" id="activo"  <?=($usuario->getCaActivo()||!$usuario->getCaLogin())?'checked="checked"':''?> <?if(!($nivel==3)){?>disabled="disabled"<?}?>/>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Fecha y Usuario de creaci&oacute;n</b>
									</div>
								</td>
								<td>
                                    <div align="left">
										<?=$usuario->getCaFchcreado()?>&nbsp;&nbsp;<?=$usuario->getCaUsucreado()?>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Fecha y Usuario de Actualizaci&oacute;n</b>
									</div>
								</td>
								<td>
                                    <div align="left">
										<?=$usuario->getCaFchactualizado()?>&nbsp;&nbsp;<?=$usuario->getCaUsuactualizado()?>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Ultimo Cambio de Contrase&ntilde;a</b>
									</div>
								</td>
								<td>
                                    <?foreach($claves as $clave){?>
									<div align="left">
										<?=$clave->getCaFchcreado()?>
									</div>
                                    <?}?>
								</td>
                            </tr>
                            <tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
											<b>Pr&oacute;ximo Cambio de Contrase&ntilde;a</b>
									</div>
								</td>
								<td>
                                    <div align="left">
										<?=$usuario->getCaFchvencimiento()?>
									</div>
								</td>
							</tr>
                            <tr class="row2" >
								<td colspan="3">
									<div align="left">  
										<b>GOOGLE APPS</b>
									</div>
								</td>
                            </tr>
                            <tr class="row0">
								<td>&nbsp;</td>
                                <td width="40%">
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
								<td>&nbsp;</td>
                                <td width="40%">
									<div align="left">
										<b>Clave Email</b>
									</div>
								</td>
								<td>
									<div align="left">
										<input type="password" name="clave_email" id="clave_email" Autocomplete="off" <?if(!($nivel==3)||!($usuario->getCaEmail())||$usuario->getCaMailpasw()){?>disabled="disabled"<?}?> />
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
                    <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("adminUsers/directory")?>'" />&nbsp;
                </div>
            </td>
        </tr>
    </table>
</div>
</form>
<script language="javascript" type="text/javascript">
	lockFields(document.getElementById('auth_method'));
    showFieldsEnf(document.getElementById('chk_enfermedad'));
    showFieldsAle(document.getElementById('chk_alergico'));
    cambiarValores('<?=$usuario->getCaIdsucursal()?>','<?=$usuario->getCaDepartamento()?>','<?=$usuario->getCaCargo()?>','<?=$usuario->getCaManager()?>');
</script>