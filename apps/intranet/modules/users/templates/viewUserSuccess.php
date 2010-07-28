Este es el perfil del usuario 
<br/>
<br/>
<div>
    <table border="0" width="320" class="tableList">
        <tr align="left">
            <td width="220" valign="top">
                <b><?=utf8_encode(strtoupper($user->getCaNombre())) ?></b><br/>
                <b><?=$user->getCaCargo() ?></b><br />
                <b><a href="<?=url_for('users/viewOrganigrama?login='.$user->getCaLogin()) ?>">Organigrama</a></b>
            </td>
            <td width="100" align="right">
                <img src="<?=url_for('users/traerImagen?username='.$user->getCaLogin())?>" />
            </td>
        </tr>
    </table>
</div>
<br />
<div class="box1">
    <table width="320">
        <tr>
            <td width="150">Nombre Completo:</td><td width="200"><b><?=utf8_encode($user->getCaNombre())?></b></td>
        </tr>
        <tr>
            <td width="120">Empresa:</td><td width="200"><b><?=utf8_encode($user->getCaEmpresa())?></b></td>
        </tr>
        <tr>
            <td width="120">Tel. Oficina:</td><td width="200"><b><?=utf8_encode($user->getCaTeloficina().' '.$user->getCaExtension())?></b></td>
        </tr>
        <tr>
            <td width="120">Departamento:</td><td width="200"><b><?=utf8_encode($user->getCaDepartamento())?></b></td>
        </tr>
        <tr>
            <td  width="120">Sucursal:</td><td width="200"><b><?=utf8_encode($user->getSucursal()->getCa_Nombre())?></b></td>
        </tr>
        <tr>
            <td  width="120">Email:</td><td width="300"><b><?=utf8_encode($user->getCa_Email())?></b></td>
        </tr>
        <tr>
            <td  width="120">M&oacute;vil:</td><td width="300"><b><?=utf8_encode($user->getCa_Movil())?></b></td>
        </tr>
        <tr>
            <td  width="120">Tel. Particular:</td><td width="300"><b><?=utf8_encode($user->getCa_Telparticular())?></b></td>
        </tr>
        <tr>
            <td  width="120">Jefe Inmediato:</td><td width="300"><b><a href="<?=url_for('users/viewUser?login='.$manager->getCaLogin()) ?>"><?=utf8_encode($manager->getCaNombre())?></a></b></td>
        </tr>
        <tr>
            <td  width="120">Tipo de Sangre:</td><td width="300"><b><?=utf8_encode($user->getCa_Tiposangre())?></b></td>
        </tr>
        <tr>
            <td  width="120">Fch. Cumplea&ntilde;os:</td><td width="300"><b><?=utf8_encode(Utils::parseDate($user->getCaCumpleanos(), 'm-d'))?></b></td>
        </tr>
        <tr>
            <td  width="120">Tel. Familiar:</td><td width="300"><b><?=utf8_encode($user->getCa_Telfamiliar())?></b></td>
        </tr>
        <tr>
            <td  width="120">Nombre Familiar:</td><td width="300"><b><?=utf8_encode($user->getCa_Nombrefamiliar())?></b></td>
        </tr>
        


    </table>
</div>

