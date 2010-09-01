<div align="center">
    <table width="700"  class="tableList" >
        <tr>
            <th style="border:none; border-bottom: 1px solid #D0D0D0" colspan="2" scope="col">Perfil del usuario</th>
            <?
                if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1 ){
            ?>
            <th width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Nuevo"><?=link_to(image_tag("new.png"),"adminUsers/formUsuario")?></th>
            <?
            }
            ?>
            <?
                if(($userinicio->getUserId()==$user->getCaLogin()) or $nivel>=1 ){
            ?>
            <th width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Editar"><?=link_to(image_tag("page_white_edit.png"),"adminUsers/formUsuario?login=".$user->getCaLogin())?></th>
            <?
            }
            ?>
			<th width="5" style="border:none; border-bottom: 1px solid #D0D0D0;text-align:right" title="Organigrama"><?=link_to(image_tag("Organigrama.jpg"),"adminUsers/viewOrganigrama?login=".$user->getCaLogin())?></th>
	     </tr>
        <tr>
			<td width="150">
				<div class="box1">
					<img src="<?=url_for('adminUsers/traerImagen?username='.$user->getCaLogin().'&tamano=120x150')?>" />
				</div>
			</td>
			<td valign="top" align="left">
				<b><?=(strtoupper($user->getCaNombre())) ?></b><br/>
				<b><?=($user->getCaCargo()) ?></b><br />
			</td>
			<td>&nbsp;</td>
		</tr>
    </table>
</div>
<br />

<div class="box1">
    <?//echo $nivel;?>
    <table width="700" border="0" class="tableList">
        <tr>
            <td>Login:</td><td><b><?=$user->getCaLogin()?></b></td>
        </tr>
        <tr>
            <td>Nombre Completo:</td><td><b><?=($user->getCaNombres())?> <?=($user->getCaApellidos())?></b></td>
        </tr>
        <tr>
            <td>Empresa:</td><td><b><?=($user->getCaEmpresa())?></b></td>
        </tr>
        <tr>
            <td>Tel. Oficina:</td><td><b><?=($user->getCaTeloficina().' '.$user->getCaExtension())?></b></td>
        </tr>
        <tr>
            <td>Departamento:</td><td><b><?=$user->getCaDepartamento()?></b></td>
        </tr>
        <tr>
            <td>Sucursal:</td><td><b><?=$user->getSucursal()->getCa_Nombre()?></b></td>
        </tr>
        <tr>
            <td>Email:</td><td><b><?=$user->getCa_Email()?></b></td>
        </tr>
        <tr>
            <td>M&oacute;vil:</td><td><b><?=$user->getCa_Movil()?></b></td>
        </tr>
        <tr>
            <td>Jefe Inmediato:</td><td><b><a href="<?=url_for('adminUsers/viewUser?login='.$manager->getCaLogin()) ?>"><?=($manager->getCaNombres())?> <?=($manager->getCaApellidos())?></a></b></td>
        </tr>
        <tr>
            <td>Fch. Cumplea&ntilde;os:</td><td><b><?=(Utils::getMonth(Utils::parseDate($user->getCaCumpleanos(), 'm'))."-".Utils::parseDate($user->getCaCumpleanos(), 'd'))?></b></td>
        </tr>
        <?
        if( $user->getEsJefe( $userinicio->getUserId() ) or $userinicio->getUserId()==$user->getCaLogin() ){
        ?>
        <tr>
            <td>Fch. Ingreso:</td><td><b><?=(Utils::parseDate($user->getCa_Fchingreso(), 'Y-m-d'))?></b></td>
        </tr>
        <tr>
            <td>Tel. Particular:</td><td><b><?=$user->getCa_Telparticular()?></b></td>
        </tr>
        <tr>
            <td>Tipo de Sangre:</td><td><b><?=$user->getCa_Tiposangre()?></b></td>
        </tr>
        <tr>
            <td>Familiar de Contacto:</td><td><b><?=$user->getCa_Nombrefamiliar()?></b></td>
        </tr>
        <tr>
            <td>Tel. Familiar:</td><td><b><?=$user->getCa_Telfamiliar()?></b></td>
        </tr>
        <tr>
            <td>Parentesco:</td><td><b><?=$user->getCa_Parentesco()?></b></td>
        </tr>
        <?
        }
        ?>
</table>
</div>