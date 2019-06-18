<?
$comites = $sf_data->getRaw("comites");
?>

<div class="content" align="center" id="resultado">
    <?if($user){?>
    <table width="100%"  class="tableList" >
        <?
        if($vacaciones){
            ?>
        <tr bgcolor="#CD5C5C">
            <td colspan="10" style="color: white; font-weight:  bold;">Colaborador en Vacaciones. <a onclick="infoVacaciones()">Ver mensaje</a></td>
            </tr>
            <?
        }        
        ?>
        <tr>
            <td style="border:none; border-bottom: 1px solid #D0D0D0;text-align:left" <?if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1){?>colspan="3"<?}else{?>colspan="2"<?}?> scope="col">Perfil del usuario</td>
            <td></td>
                <?
                
                if(($userinicio->getUserId()==$user->getCaLogin()) or( $nivel>=2 && in_array($user->getSucursal()->getCaIdempresa(),$sf_data->getRaw("grupoEmp"))) or $nivel>=3){
                ?>
            <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" align="right" title="Editar"><?=link_to(image_tag("page_white_edit.png"),"adminUsers/formUsuario?login=".$user->getCaLogin())?></td>
                <?
                }
                ?>
                <?
                if( $nivel==1 ){
                ?>
            <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" align="right" title="Editar"><?=link_to(image_tag("32x32/agt_web.png"),"adminUsers/formColmas?login=".$user->getCaLogin())?></td>
                <?
                }
                ?>
            <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Organigrama"><?=link_to(image_tag("Organigrama.jpg"),"adminUsers/viewOrganigrama?login=".$user->getCaLogin())?></td>
            <?
            if($userinicio->getUserId()==$user->getCaLogin()) { 
                ?>
                <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Vacaciones"><img src="/intranet/images/32x32/vacations.png" onclick="formVacaciones()"></td>
                <?
            }
            if($userinicio->getUserId()==$user->getCaLogin()) { 
                ?>
                <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Hijos"><img src="/intranet/images/32x32/children.png" onclick="formHijos()"></td>
                <?
            }
            ?>
        </tr>
        <tr>
            <td width="150">
                <div class="box1" align="center">
                    <!--<img src="<?=url_for('adminUsers/traerImagen?username='.$user->getCaLogin().'&tamano=120x150')?>" />-->
                    <img src="<?=$user->getImagenUrl()?>"
                </div>
            </td>
            <td valign="top" align="left" <?if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1){?>colspan="3"<?}else{?>colspan="2"<?}?> >
                <b><?= (strtoupper($user->getCaNombre())) ?></b><br/>
                    <b><?= ($user->getCaCargo()) ?></b><br /><br />
                    <?//Brigadista
                    if (in_array(1, $comites)) {
                        ?> 
                        <img src="<?= url_for("images/22x22") ?>/brigadas.png" alt="Brigada de Emergencia" title="Brigada de Emergencia">
                    <?}//Convivencia 
                    if (in_array(2, $comites)) {
                        ?>
                        <img src="<?= url_for("images/22x22") ?>/convivencia.png" alt="Comité de Convivencia" title="Comité de Convivencia">
                    <?}//Comité de Etica
                    if (in_array(3, $comites)) {  
                        ?>
                        <img src="<?= url_for("images/22x22") ?>/etica.png" alt="Comité de Etica" title="Comité de Etica">
                    <?}//Copass
                    if (in_array(4, $comites)) {  
                        ?>
                        <img src="<?= url_for("images/22x22") ?>/copass.png" alt="Copass" title="Copass">
                        <?
                    }
                    ?>
            </td>
            
            <td align="left">&nbsp;</td>
        </tr>
    </table>

    <br />

   
        <?//echo $nivel;?>
        <table width="100%" border="0" class="tableList" >
            <tr>
                <td align="left">Login:</td><td align="left"><b><?=$user->getCaLogin()?></b></td>
            </tr>
            <tr>
                <td align="left">Nombre Completo:</td><td align="left"><b><?=($user->getCaNombres())?> <?=($user->getCaApellidos())?></b></td>
            </tr>
            <tr>
                <td align="left">Empresa:</td><td align="left"><b><?=($user->getSucursal()->getEmpresa()->getCaNombre())?></b><?=$subc?" (Subcontratado)":null?></td>
            </tr>
            <tr>
                <td align="left">Tel. Oficina:</td><td align="left"><b><?=($user->getSucursal()->getCaTelefono().' Ext. '.$user->getCaExtension())?></b></td>
            </tr>
            <tr>
                <td align="left">Departamento:</td><td align="left"><b><?=$user->getCaDepartamento()?></b></td>
            </tr>
            <tr>
                <td align="left">Sucursal:</td><td align="left"><b><?=$user->getSucursal()->getCaNombre()?></b></td>
            </tr>
            <tr>
                <td align="left">Email:</td><td align="left"><b><?=$user->getCa_Email()?></b></td>
            </tr>
            <tr>
                <td align="left">M&oacute;vil:</td><td align="left"><b><?=$user->getCa_Movil()?></b></td>
            </tr>
            <tr>
                <td align="left">Jefe Inmediato:</td><td align="left"><b><a href="<?=url_for('adminUsers/viewUser?login='.$manager->getCaLogin()) ?>"><?=($manager->getCaNombre())?></a></b></td>
            </tr>
            <tr>
                <td align="left">Fch. Cumplea&ntilde;os:</td><td align="left"><b><?=(Utils::getMonth(Utils::parseDate($user->getCaCumpleanos(), 'm'))."-".Utils::parseDate($user->getCaCumpleanos(), 'd'))?></b></td>
            </tr>
            
            <?
            foreach( $addresses as $address ){
            ?>
            <tr>
                <td align="left">Network Address:</td><td align="left"><b><?=$address["protocol"]." ".$address["address"]?></b></td>
            </tr>
            <?
            }
            if( $user->getEsJefe( $userinicio->getUserId() ) or $userinicio->getUserId()==$user->getCaLogin() or ($nivel>=2 && in_array($user->getSucursal()->getCaIdempresa(),$sf_data->getRaw("grupoEmp"))) or $nivel>=3){
            ?>
            <tr>
                <td align="left">Nivel de estudios:</td><td align="left"><b><?=$user->getCaNivestudios()?></b></td>
            </tr>
            <tr>
                <td align="left">Fch. Ingreso:</td><td align="left"><b><?=(Utils::parseDate($user->getCa_Fchingreso(), 'Y-m-d'))?></b></td>
            </tr>
            <tr>
                <td align="left">Direcci&oacute;n:</td><td align="left"><b><?=$user->getCa_Direccion()?></b></td>
            </tr>
            <tr>
                <td align="left">Tel. Particular:</td><td align="left"><b><?=$user->getCa_Telparticular()?></b></td>
            </tr>
            <tr>
                <td align="left">Ti po de Sangre:</td><td align="left"><b><?=$user->getCaTiposangre()?></b></td>
            </tr>
            <tr>
                <td align="left">Familiar de Contacto:</td><td align="left"><b><?=$user->getCa_Nombrefamiliar()?></b></td>
            </tr>
            <tr>
                <td align="left">Tel. Familiar:</td><td align="left"><b><?=$user->getCa_Telfamiliar()?></b></td>
            </tr>
            <tr>
                <td align="left">Parentesco:</td><td align="left"><b><?=$user->getCa_Parentesco()?></b></td>
            </tr>
            <?
            }
            ?>
        </table>
    <?}?>
        <br />
        <?
        include_component("adminUsers", "directorio");
        ?>
        <br />
    
</div>

<script>   
    
    
    Ext.Loader.setConfig({
        enabled: true,    
        paths: {
            'Ext.ux': '/intranet/js/ext5/examples/ux/',
            'Ext.ux.exporter':'/intranet/js/ext5/examples/ux/exporter/',
            'Colsys':'/js/Colsys'
        }
    });
    
    Ext.require([        
        'Ext.ux.form.SearchField',
        'Ext.ux.exporter.Exporter'
    ]);
    
    var formVacaciones = function(){
        Ext.create('Ext.window.Window', {
            title: 'VACACIONES',
            height: 600,
            width: 600,
            id:'win',
            layout: 'anchor',
            maximizable: true,
            items: {  // Let's put an empty grid in just to illustrate fit layout
                xtype: 'Colsys.Users.FormVacaciones',
                border: false,
                id:'form-vacaciones',
                name:'form-vacaciones',
                frame:true,
                login: "<?=$user->getCaLogin()?>"                
            }
        }).show();
    }
    
    var formHijos = function(){
        Ext.create('Ext.window.Window', {
            title: 'Hijos',
            height: 300,
            width: 600,
            id:'win',
            layout: 'anchor',
            maximizable: true,
            items: {  // Let's put an empty grid in just to illustrate fit layout
                xtype: 'Colsys.Users.GridHijos',
                border: false,
                id:'grid-hijos',
                name:'grid-hijos',
                frame:true,
                app: 'intranet',
                login: "<?=$user->getCaLogin()?>"                
            }
        }).show();
    }
    
    
    
    var infoVacaciones = function(mensaje){
        console.log(Object(mensaje));
        Ext.create('Ext.window.Window', {
            title: 'Mensaje de Vacaciones',
            id: 'info-vacaciones',
            height: 620,
            width: 600,
            id:'win',
            layout: 'anchor',
            html: 'Mensaje de vacaciones',
            listeners:{
                beforerender: function(t, eOpts){
                    var me = t;
                    Ext.Ajax.request({
                        url: '/intranet/adminUsers/infoVacaciones',
                        params: {
                            login : '<?=$user->getCaLogin()?>'                                      
                        },                                
                        method: 'POST',
                        waitTitle: 'Connecting',
                        waitMsg: 'Cargando Archivo...',
                        scope: me,
                        success: function (response, options) { 
                            var res = Ext.decode(response.responseText);                            
                            var html = res.html;                                    
                            me.update(html);                                    
                        },
                        failure: function () {
                           console.log('failure');
                        }
                    });
                }
            }
        }).show();
    }
    
        
</script>