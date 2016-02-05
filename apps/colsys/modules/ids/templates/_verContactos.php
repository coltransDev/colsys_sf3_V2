<table class="tableList" width="100%">
    <tr class="row0">
        <td width="15%"><div class="qtip" title="Para copiar información, por favor haga doble click sobre el contacto requerido"><b>Nombre</b></div></td>
        <td width="10%"><b>C&oacute;digo &Aacute;rea</b></td>
        <td width="10%"><b>Tel&eacute;fono</b></td>
        <td width="10%"><b>Fax</b></td>
        <td width="20%"><b>e-mail</b></td>
        <td width="12%"><b>Cargo</b></td>
        <td width="8%"><b>Impo/Expo</b></td>
        <td width="10%"><b>Transporte</b></td>
        <td width="5%">
            <div align="center">
                <?
                if ($nivel >= 3) {
                    echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=" . $sucursal->getCaIdsucursal() . "&modo=" . $modo, array("title" => "Nuevo contacto"));
                }
                ?>
            </div>
        </td>
    </tr>
    <?
    $i = 0;
    foreach ($contactos as $contacto) {
        if ($contacto->getCaVisibilidad() == 3 && ($user->getUserId() != $contacto->getCaUsucreado() || $user->getUserId() != $contacto->getCaUsuactualizado())) {
            continue;
        }

        if ($contacto->getCaVisibilidad() == 2 && $nivel < 2) {
            continue;
        }
        //TODO $contacto->getCavisibilidad()==2
        $i++;

        if (!$contacto->getCaActivo()) {
            $class = "";
        } elseif ($contacto->getCaSugerido()) {
            $class = "yellow";
        } elseif ($contacto->getCaIdentificacion()) {
            $class = "greentwo";
        } else {
            $class = "";
        }

        $text = $contacto->getCaObservaciones() ? "<br />" . $contacto->getCaObservaciones() . " " : "";

        if ($contacto->getCaIdentificacion()) {
            $text.="Identificacion:" . $contacto->getCaIdentificacion() . " ";
        }
        if ($contacto->getCaCelular()) {
            $text.="Celular:" . $contacto->getCaCelular() . " ";
        }
        if ($contacto->getCaSkype()) {
            $text.="Skype:" . $contacto->getCaSkype();
        }
        ?>
        <tr class="<?= $class ?>">
            <td id="name<?= $i . $contacto->getIdsSucursal()->getCaIdsucursal() ?>" ondblclick='changeText(<?= $i . $contacto->getIdsSucursal()->getCaIdsucursal() ?>, "<?= $sucursal->getCiudad()->getCaCiudad() . "(" . $sucursal->getCiudad()->getTrafico()->getCaNombre() . ")" ?>", "<?= $contacto->getIdsSucursal()->getCaDireccion() ?>", "<?= $contacto->getCaTelefonos() ?>", "<?= $contacto->getCaFax() ?>", "<?= $contacto->getCaEmail() ?>", "<?= $contacto->getCaTransporte() ?>")'>
                <div align="left">
                    <div class="qtip" title="<?= $text ?>"><?= $contacto->getNombre() ?> <?= !$contacto->getCaActivo() ? "(INACTIVO)" : "" ?> <?= $contacto->getCaCelular() ? image_tag("16x16/mobile.gif") : "" ?> <?= $contacto->getCaSkype() ? image_tag("16x16/skype.png") : "" ?></div>
                </div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>">(<?= $sucursal->getCiudad()->getTrafico()->getCodigoarea() ?>)(<?= $contacto->getCodigoarea() ?>)</div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= $contacto->getCaTelefonos() ?></div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= $contacto->getCaFax() ?></div></td>           
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= $contacto->getCaEmail() ?></div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= $contacto->getCaCargo() ?></div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= str_replace("|", ",", $contacto->getCaImpoexpo()) ?></div></td>
            <td><div align="left" class="qtip" title="<?= $text ?>"><?= str_replace("|", ",", $contacto->getCaTransporte()) ?></div></td>
            <td><div align="center">
                    <?
                    if ($nivel >= 3) {
                        echo link_to(image_tag("16x16/edit.gif"), "ids/formContactosIds?modo=" . $modo . "&idcontacto=" . $contacto->getCaIdcontacto() . "");
                        echo link_to(image_tag("16x16/delete.gif"), "ids/eliminarContactoIds?modo=" . $modo . "&idcontacto=" . $contacto->getCaIdcontacto() . "", array("confirm" => "Esta seguro?"));
                    }
                    ?>
                </div></td>
        </tr>
        <?
    }
    if ($i == 0) {
        ?>
        <tr >

            <td colspan="8">

                <div align="center">No hay contactos
                    <?
                    if ($nivel >= 3) {
                        echo link_to(image_tag("16x16/add_user.gif"), "ids/formContactosIds?idsucursal=" . $sucursal->getCaIdsucursal() . "&modo=" . $modo, array("title" => "Nuevo contacto"));
                    }
                    ?>

                </div></td>
        </tr>
        <?
    }
    ?>
</table>

<script type="text/javascript">
    function changeText(id, sucursal, direccion, telefono, fax, email, transporte) {
        var oldHTML = document.getElementById('name' + id).innerHTML;
        var newHTML = "<table class='tableList'><tr><td><b><?= utf8_decode($ids->getCaNombre()) ?></b></td></tr>\n\
                        <tr><td><b>Suc:</b>" + sucursal + "</td></tr>\n\
                        <tr><td><b>Dir:</b>" + direccion + "</td></tr>\n\
                        <tr><td><b>Contacto:</b>" + oldHTML + "</td></tr>\n\
                        <tr><td><b>Tel:</b>" + telefono + "</td></tr>\n\
                        <tr><td><b>Fax:</b>" + fax + "</td></tr>\n\
                        <tr><td><b>Email:</b>" + email + "</td></tr>\n\
                        <tr><td><b>" + transporte + "</b></td></tr>\n\
                        </table>";
        document.getElementById('name' + id).innerHTML = newHTML;
    }
</script>