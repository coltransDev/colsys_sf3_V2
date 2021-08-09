<style>
    input:invalid {
        border: 1px solid red;
    }

    input:invalid:required {
        border: 1px solid red;    
    }

    /*input:valid {
        border: 1px solid black;
    }*/
    
</style>

    <?
if($app=="intranet"){
    sfContext::getInstance()->getResponse()->removeStylesheet("/js/ext4/resources/css/ext-all-neptune.css");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
    sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");
    use_stylesheet('ext/css/ext-all.css');
    use_javascript('ext/adapter/ext/ext-base.js');
    use_javascript('ext/ext-all.js');
    use_javascript('ext/src/locale/ext-lang-es.js');
}
use_helper('ExtCalendar');

$sucursales = $sf_data->getRaw("sucursales");
$departamentos = $sf_data->getRaw("departamentos");
$cargos = $sf_data->getRaw("cargos");
$jefes = $sf_data->getRaw("jefes");
//$teloficinas = $sf_data->getRaw("teloficinas");
//$hijos = $sf_data->getRaw("hijos");

//echo $nivel."key =>".$key;

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
    
    /*function showFieldsEnf( name ){
        if(field&&typeof(field)!='undefined'){
            if( field.checked){
                document.getElementById(name).disabled=false;
            }else{
                document.getElementById(name).disabled=true;
            }
        }
    }*/
    
    function showFields( field, nombre ){
        if(field&&typeof(field)!='undefined'){            
            if( field.checked){
                document.getElementById(nombre).disabled=false;
            }else{
                document.getElementById(nombre).disabled=true;
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
        <?
        if($key == "new"){
            ?>
            var nombres = $("#nombres").val();
            var papellido = $("#papellido").val();

            Ext.Ajax.request({
                waitMsg: 'Enviando...',
                url: '/intranet/adminUsers/validarLogin',
                params: {
                    nombres: nombres,
                    papellido: papellido
                },
                failure: function (response, options) {
                    alert(response.responseText);
                    Ext.Msg.hide();
                    alert("Surgio un problema al tratar de registrar el login.")
                    return false;
                },
                success: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);

                    if(res.success){
                        Ext.MessageBox.show({
                            title: 'Validar Login',
                            msg: 'Por favor verifique que el login: <span style="color:blue; font-size:15px;">'+res.login+'</span> este correcto. Si le parece inapropiado o está mal elaborado, verifique el nombre del colaborador o sugiera un nuevo login en este espacio:',
                            buttons:{
                                ok: "Login OK!",
                                no: "Sugerir Nuevo Login!",
                                cancel: "Cancelar"
                            },                        
                            multiline: true,
                            fn: function(btn, text, opt){            
                                if( btn == "ok"){
                                   $("#login").val(opt.login); 
                                   document.getElementById("formUser").submit();
                                }else if(btn == "no"){                
                                    if( text.trim()==""){
                                        alert("Debe colocar login válido");
                                        return false;
                                    }else{
                                        Ext.Ajax.request({
                                            waitMsg: 'Enviando...',
                                            url: '/intranet/adminUsers/validarLogin',
                                            params: {
                                                nuevologin: text
                                            },
                                            failure: function (response, options) {
                                                alert(response.responseText);
                                                Ext.Msg.hide();
                                                alert("Surgio un problema al tratar de registrar el login.")
                                                return false;
                                            },
                                            success: function (response, options) {
                                                var res = Ext.util.JSON.decode(response.responseText);

                                                if(res.success){
                                                    $("#login").val(res.login); 
                                                    Ext.Msg.alert('Login Sugerido OK', 'Se ha asignado al formulario el login sugerido: <span style="color:blue; font-size:15px;">'+res.login+'</span>');
                                                    document.getElementById("formUser").submit();
                                                }else{
                                                   Ext.Msg.alert('Login Inv&aacute;lido', res.errorInfo);
                                                   return false;
                                                }
                                            }
                                        });
                                    }
                                }else{
                                   $("#login").val(null);
                                   return false;
                                }
                            },
                            animEl: 'form-login',
                            modal: true,
                            login: res.login
                        });
                    }else{
                       Ext.Msg.alert('Login Inv&aacute;lido', 'Por favor valide el nombre del colaborador &oacute; comun&iacute;quese con el &aacute;rea de sistemas.');
                       return false;
                    }
                }
            });
            <?
        }else{
            ?>
            document.getElementById("formUser").submit();
            <?
        }
        ?>         
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
                if( idempresa == jefes[i]['c_ca_idempresa'] || idempresa == 1 || idempresa == 2 || idempresa == 8 || idempresa == 11 || idempresa == 12){
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

<form name="form1" action="<?=url_for("adminUsers/guardarUsuario?".$param)?>" method="post" id="formUser" onsubmit='return false;' enctype="multipart/form-data" >
<div class="content" align="center">
    
    <table width="100%" border="0" class="tableList">
        <tr>
            <th colspan="4" scope="col"><?=!$key?"Edici&oacute;n de ":"Creaci&oacute;n de "?>usuario</th>
            <?
            if($key){
                ?>
                <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" align="right" title="Editar"><a href="/intranet/images/docs/CONSTRUCCION_LOGIN_INTRANET.pdf" target="_blank"><img src="/intranet/images/help.png"/></a></td>
                <?
            }   
            ?>
        </tr>
        <tr>
            <td width="100">
                <div class="box1">
                        <!--<img src="<?=url_for('adminUsers/traerImagen?username='.$usuario->getCaLogin().'&tamano=120x150')?>" />-->
                    <img src="<?=$usuario->getImagenUrl()?>"
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
                                            <input type="text" readonly="readonly" id="login" name="login" required="required" value="<?=$usuario->getCaLogin()?>" />
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
                                        <input type="text" size="30" id="nombres" required="required" name="nombres" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaNombres()?>"/>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                    <div align="left">
                                        <b>Primer Apellido</b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <input type="text" size="30" id="papellido" required="required" name="papellido" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaPapellido()?>" />
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                    <div align="left">
                                        <b>Segundo Apellido</b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <input type="text" size="30" name="sapellido" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaSapellido()?>" />
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
                                        <input type="text" size="30" required="required" name="nombre" <?if($nivel==0){?>disabled="disabled"<?}?> value="<?=$usuario->getCaNombre()?>" />
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
                                        <select name="empresa" required="required" id="empresa" <?if($nivel==0){?>disabled="disabled"<?}?> onChange="cambiarValores('<?=$usuario->getCaIdsucursal()?>','<?=$usuario->getCaDepartamento()?>','<?=$usuario->getCaCargo()?>','<?=$usuario->getCaManager()?>')">
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
                                        <b>Subcontratado</b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">                                        
                                        <?
                                        //echo $subc;
                                        
                                        ?>
                                        <input type="checkbox" name="subcontrato" id="subcontrato"  <?=($subc==true || $subc==1)?'checked':''?>/>                                         
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
                                        <select name="idsucursal" required="required" id="idsucursal" <?if($nivel==0){?>disabled="disabled"<?}?>>
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
                                            <select name="departamento" required="required" id="departamento" <?if($nivel==0){?>disabled="disabled"<?}?> onChange="cambiarValoresManager('<?=$usuario->getCaManager()?>')">
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
                                        <select name="cargo" required="required" id="cargo" <?if($nivel==0){?>disabled="disabled"<?}?>>												
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
                                        <select name="manager" required="required" id="manager" <?if($nivel==0){?>disabled="disabled"<?}?>>
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
                                        <input type="text" name="teloficina" disabled="disabled" value="<?=$usuario->getSucursal()->getCaTelefono()?>"/>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                        <div align="left">
                                                <b>M&oacute;vil Corporativo</b>
                                        </div>
                                </td>
                                <td>
                                    <div align="left">                                                        
                                        <input type="text" name="celcorp" value="<?=$usuario->getDatosJson("celcorp")?>"/>
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
                                        <input type="text" name="docidentidad" onkeypress="return validarSiNumero(event)" value="<?=$usuario->getCaDocidentidad()?>" required />
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
                                        <b>M&oacute;vil Particular</b>
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
                                        <b>Estado Civil</b>
                                    </div>
                                </td>
                                 <td>
                                    <div align="left">
                                        <select name="estado">
                                            <option value="">Por favor seleccione una opci&oacute;n</option>
                                                <?
                                                foreach( $estados as $estado ){
                                                    ?>
                                                    <option value="<?=$estado->getCaIdentificacion()?>"<?=$usuario->getUsuBrigadas()->getCaEcivil()==$estado->getCaIdentificacion()?'selected="selected"':''?> > <?=($estado->getCaValor())?></option>
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
                                        <b>Zona de Evacuaci&oacute;n</b>
                                    </div>
                                </td>
                                 <td>
                                    <div align="left">
                                        <select name="zona"  style="width: 400px">
                                            <option value="">Por favor seleccione una opci&oacute;n</option>
                                                <?
                                                foreach( $zonas as $zona ){
                                                    ?>
                                                    <option value="<?=$zona->getCaIdentificacion()?>"<?=$usuario->getUsuBrigadas()->getCaZona()==$zona->getCaIdentificacion()?'selected="selected"':''?> > <?=($zona->getCaValor())?></option>
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
                                        <input type="checkbox" onclick='showFields(this, "enfermedad")' name="chk_enfermedad" id="chk_enfermedad" <?=$usuario->getCaEnfermedad()!=null?'checked="checked"':''?>/>
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
                                        <input type="text" name="enfermedad" id="enfermedad" disabled="disabled" value="<?$usuario->getCaEnfermedad()?>" size="40" />
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                    <div align="left">
                                        <b>Alérgico algún medicamento</b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <input type="checkbox" onclick='showFields(this, "alergico")' name="chk_alergico" id="chk_alergico" <?=$usuario->getCaAlergico()!=null?'checked="checked"':''?>/>
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
                            <tr class="row2" >
                                <td colspan="3">
                                    <div align="left">  
                                        <b>Pertenece a:</b>
                                    </div>
                                </td>
                            </tr>
                            <? 
                            $usuComites = explode("|",$usuario->getUsuBrigadas()->getCaComites());    
                            
                            foreach ($comites as $comite) { ?>
                                <tr class="row0">                                
                                    <td>&nbsp;</td>
                                    <td width="40%">
                                        <div align="left">
                                            <b><?= $comite->getCaValor() ?></b>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="left">
                                            <input type="checkbox" onclick='showFields(this, "comite_pr<?=$comite->getCaIdentificacion()?>")' name="comite<?=$comite->getCaIdentificacion()?>" id="comite<?=$comite->getCaIdentificacion()?>" <?=in_array($comite->getCaIdentificacion(), $usuComites)  ? 'checked="checked"' : '' ?>/>
                                            <input type="text" disabled="disabled" name="comite_pr<?=$comite->getCaIdentificacion()?>" id="comite_pr<?=$comite->getCaIdentificacion()?>" value="<?=$usuario->getUsuBrigadas()->getProperty("comite".$comite->getCaIdentificacion())?>" />
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </table>
                    </div>
                    <div class="tab-page">
                        <h2 class="tab">Familiar</h2>
                        <table width="100%" cellspacing="0"  class="tableList alignLeft">
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
                    <?
                if($nivel>=1){
                    ?>
                    <div class="tab-page">
                        <h2 class="tab">T.Humano</h2>
                        <table width="100%" cellspacing="0"  class="tableList alignLeft">
                            <tr class="row2" >
                                <td colspan="3">
                                    <div align="left">  
                                        <b>Desvinculación de Usuario</b>
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
                }
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
                                        <select name="auth_method" id="auth_method" onchange='lockFields(this)' <?if(!($nivel>=2) || !in_array($usuario->getSucursal()->getCaIdempresa(), $sf_data->getRaw("grupoEmp"))){?>disabled="disabled"<?}?>  >
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
                                        <input type="password" name="passwd1" id="passwd1" Autocomplete="off" <?if(!($nivel>=2) || !in_array($usuario->getSucursal()->getCaIdempresa(), $sf_data->getRaw("grupoEmp"))){?>disabled="disabled"<?}?>/>
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
                                        <input type="password" name="passwd2" id="passwd2" Autocomplete="off"  <?if(!($nivel>=2) || !in_array($usuario->getSucursal()->getCaIdempresa(), $sf_data->getRaw("grupoEmp"))){?>disabled="disabled"<?}?>/>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                    <div align="left">
                                        <b>Forzar cambio en el proximo inicio de sesión</b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <input type="checkbox" name="forcechange" id="forcechange"  <?=$usuario->getCaForcechange()?'checked="checked"':''?> <?if(!($nivel>=2) || !in_array($usuario->getSucursal()->getCaIdempresa(), $sf_data->getRaw("grupoEmp"))){?>disabled="disabled"<?}?>/>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row0">
                                <td>&nbsp;</td>
                                <td width="40%">
                                    <div align="left">
                                        <b>Bloqueado<?=$usuario->getCaBloqueado()?". ".utf8_decode($usuario->getDatosJson("bloqueado")):""?></b>
                                    </div>
                                </td>
                                <td>
                                    <div align="left">
                                        <input type="checkbox" name="activo" id="activo"  <?=$usuario->getCaBloqueado()?'checked="checked"':''?> <?if(!($nivel>=2)){?>disabled="disabled"<?}?>/>
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
                                        <input type="checkbox" name="activo" id="activo"  <?=($usuario->getCaActivo()||!$usuario->getCaLogin())?'checked="checked"':''?> <?if(!($nivel>=2)){?>disabled="disabled"<?}?>/>
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
                                    <?
                                    if($usuario->getCaAuthmethod()=="sha1"){
                                        foreach($claves as $clave){
                                            ?>
                                            <div align="left">
                                                <?=$clave->getCaFchcreado()?>
                                            </div>
                                            <?
                                        }
                                    }else
                                        echo "Administrado por LDAP";
                                    ?>
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
                                        <?
                                        if($usuario->getCaAuthmethod()=="sha1")
                                            echo $usuario->getCaFchvencimiento();
                                        else
                                            echo "Administrado por LDAP";
                                        ?>
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
                                        <input type="password" name="clave_email" id="clave_email" Autocomplete="off" <?if(!($nivel>=2)||!($usuario->getCaEmail())||$usuario->getCaMailpasw() ){?>disabled="disabled"<?}?> />
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
                    <input type="submit" value="Guardar" class="button" onClick="javascript:checkForm()" />&nbsp;
                    <input type="button" value="Cancelar" class="button" onclick="document.location='<?=url_for("adminUsers/directory")?>'" />&nbsp;
                </div>
            </td>
        </tr>
    </table>
</div>
</form>
<script language="javascript" type="text/javascript">
    lockFields(document.getElementById('auth_method'));
    showFields(document.getElementById('chk_enfermedad'),'enfermedad');
    showFields(document.getElementById('chk_alergico'),'alergico');
    <?foreach($comites as $comite){?>
        var idComite = <?=$comite->getCaIdentificacion()?> 
        showFields(document.getElementById('comite'+idComite),'comite_pr<?=$comite->getCaIdentificacion()?>');
    <?}?>
    cambiarValores('<?=$usuario->getCaIdsucursal()?>','<?=$usuario->getCaDepartamento()?>','<?=$usuario->getCaCargo()?>','<?=$usuario->getCaManager()?>');
</script>