<div class="content" align="center">
    <table width="100%"  class="tableList" >
        <tr>
            <td style="border:none; border-bottom: 1px solid #D0D0D0;text-align:left" <?if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1){?>colspan="3"<?}else{?>colspan="2"<?}?> scope="col">Perfil del usuario</td>
            <td></td>
                <?
                if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1 ){
                ?>
            <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" align="right" title="Editar"><?=link_to(image_tag("page_white_edit.png"),"adminUsers/formUsuario?login=".$user->getCaLogin())?></td>
                <?
                }
                ?>
            <td width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Organigrama"><?=link_to(image_tag("Organigrama.jpg"),"adminUsers/viewOrganigrama?login=".$user->getCaLogin())?></td>
        </tr>
        <tr>
            <td width="150">
                <div class="box1" align="center">
                    <img src="<?=url_for('adminUsers/traerImagen?username='.$user->getCaLogin().'&tamano=120x150')?>" />
                </div>
            </td>
            <td valign="top" align="left" <?if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1){?>colspan="3"<?}else{?>colspan="2"<?}?> >
                <b><?=(strtoupper($user->getCaNombre())) ?></b><br/>
                <b><?=($user->getCaCargo()) ?></b><br />
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
                <td align="left">Empresa:</td><td align="left"><b><?=($user->getSucursal()->getEmpresa()->getCaNombre())?></b></td>
            </tr>
            <tr>
                <td align="left">Tel. Oficina:</td><td align="left"><b><?=($user->getCaTeloficina().' '.$user->getCaExtension())?></b></td>
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
            if( $user->getEsJefe( $userinicio->getUserId() ) or $userinicio->getUserId()==$user->getCaLogin() or $nivel>=1 ){
            ?>
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
        
        <br />
        <?
        include_component("adminUsers", "directorio");
        ?>
        <br />
    
</div>