<script type="text/javascript">
    var verificarCargo = function () {
        var cargoChk = document.getElementById("cargo_").checked;
        if (cargoChk) {
            document.getElementById("otro_cargo_div").style.display = "";
        } else {
            document.getElementById("otro_cargo_div").style.display = "none";
        }

    }
</script>
<div class="content" align="center">
    <h3>Maestra de <?= $modo ?></h3>
    <br />
    <form action="<?= url_for("ids/formContactosIds?modo=" . $modo . "&idsucursal=" . $sucursal->getCaIdsucursal()) ?>" method="post">
        <?
        echo $form['idsucursal']->renderError();
        $form->setDefault('idsucursal', $sucursal->getCaIdsucursal());
        echo $form['idsucursal']->render();
        ?>
        <table cellspacing="1" width="50%" class="tableList alignLeft">
            <tbody>
                <tr>
                    <th colspan="4">Nuevos Datos para el Contacto</th>
                </tr>
                <?
                if ($form->renderGlobalErrors()) {
                    ?>
                    <tr>
                        <td colspan="4" >
                            <div align="left"><?php echo $form->renderGlobalErrors() ?></div></td>
                    </tr>
                    <?
                }
                ?>
                <tr>
                    <td width="22%"><b>Proveedor</b></td>
                    <td colspan="3">
                        <?
                        $ids = $sucursal->getIds();
                        echo $ids->getcaNombre() . " [";

                        echo $sucursal->getCiudad()->getCaCiudad() . "]";
                        ?>
                    </td>
                </tr>
                <?
                if ($contacto) {
                    ?>
                    <tr>
                        <td><b>Id:</b></td>
                        <td colspan="3">
                            <?
                            echo $contacto->getCaIdcontacto();

                            echo $form['idcontacto']->renderError();
                            if ($contacto) {
                                $form->setDefault('idcontacto', $contacto->getCaIdcontacto());
                            }
                            echo $form['idcontacto']->render();
                            ?>				</td>
                    </tr>
                    <?
                }if ($modo == "proveedores") {
                    ?>
                    <tr>
                        <td><b>Identificaci&oacute;n:</b></td>
                        <td colspan="3">
                            <?
                            echo $form['identificacion']->renderError();
                            if ($contacto) {
                                $form->setDefault('identificacion', $contacto->getCaIdentificacion());
                            }
                            echo $form['identificacion']->render() . " Aplica sólo para Representantes legales y socios";
                            ?>				</td>
                    </tr>
                <? } ?>
                <tr>
                    <td><b>Nombre:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['nombre']->renderError();
                        if ($contacto) {
                            $form->setDefault('nombre', $contacto->getCaNombres());
                        }
                        echo $form['nombre']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Apellido:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['apellido']->renderError();
                        if ($contacto) {
                            $form->setDefault('apellido', $contacto->getCaPapellido());
                        }
                        echo $form['apellido']->render();
                        ?>				</td>
                </tr>

                <tr>
                    <td><b>C&oacute;digo de &Aacute;rea:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['codigoarea']->renderError();
                        if ($contacto) {
                            $form->setDefault('codigoarea', $contacto->getCodigoarea());
                        } else {
                            $form->setDefault('codigoarea', $sucursal->getCiudad()->getCodigoarea());
                        }
                        echo $form['codigoarea']->render();
                        ?>				 </td>
                </tr>
                <tr>
                    <td><b>Tel&eacute;fono:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['telefonos']->renderError();
                        if ($contacto) {
                            $form->setDefault('telefonos', $contacto->getCaTelefonos());
                        }
                        echo $form['telefonos']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Fax:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['fax']->renderError();
                        if ($contacto) {
                            $form->setDefault('fax', $contacto->getCaFax());
                        }
                        echo $form['fax']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Celular:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['celular']->renderError();
                        if ($contacto) {
                            $form->setDefault('celular', $contacto->getCaCelular());
                        }
                        echo $form['celular']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Skype:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['skype']->renderError();
                        if ($contacto) {
                            $form->setDefault('skype', $contacto->getCaSkype());
                        }
                        echo $form['skype']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Correo Electr&oacute;nico:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['email']->renderError();
                        if ($contacto) {
                            $form->setDefault('email', $contacto->getCaEmail());
                        }
                        echo $form['email']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Atiende Impo/Expo:</b></td>
                    <td width="31%">
                        <?
                        echo $form['impoexpo']->renderError();
                        if ($contacto) {
                            $form->setDefault('impoexpo', explode("|", $contacto->getCaImpoexpo()));
                        }
                        echo $form['impoexpo']->render();
                        ?>				</td>
                    <td width="22%"><b>Transporte</b></td>
                    <td width="25%"><?
                        echo $form['transporte']->renderError();
                        if ($contacto) {
                            $form->setDefault('transporte', explode("|", $contacto->getCaTransporte()));
                        }
                        echo $form['transporte']->render();
                        ?></td>
                </tr>

                <tr>
                    <td><b>Cargo:</b></td>
                    <td>
                        <?
                        $cargos = $form->getCargos();

                        $otro = false;
                        echo $form['cargo']->renderError();
                        if ($contacto) {
                            $form->setDefault('cargo', $contacto->getCaCargo());
                            if (in_array($contacto->getCaCargo(), $cargos)) {
                                $form->setDefault('cargo', $contacto->getCaCargo());
                            } else {
                                $form->setDefault('cargo', "");
                                $otro = true;
                            }
                        } else {
                            $form->setDefault('cargo', $cargos[0]);
                        }
                        echo $form['cargo']->render();
                        ?>

                        <div id="otro_cargo_div" style="<?= !$otro ? "display:none" : "" ?>">
                            <?
                            echo $form['otro_cargo']->renderError();
                            if ($contacto && $otro) {
                                $form->setDefault('otro_cargo', $contacto->getCaCargo());
                            } else {
                                $form->setDefault('otro_cargo', '');
                            }
                            echo $form['otro_cargo']->render();
                            ?>
                        </div>

                    </td>

                    <td><b>Visibilidad:</b></td>
                    <td>

                        <?
                        echo $form['visibilidad']->renderError();
                        if ($contacto) {
                            $form->setDefault('visibilidad', $contacto->getCaVisibilidad());
                        } else {
                            $form->setDefault('visibilidad', 1);
                        }
                        echo $form['visibilidad']->render();
                        ?>				</td>
                </tr>
                <tr>
                    <td><b>Observaciones:</b></td>
                    <td colspan="3">
                        <?
                        echo $form['detalles']->renderError();
                        if ($contacto) {
                            $form->setDefault('detalles', $contacto->getCaObservaciones());
                        }
                        echo $form['detalles']->render();
                        ?>				</td>
                </tr>

                <tr>
                    <td><b>Sugerido :</b></td>
                    <td colspan="3"><?
                        echo $form['sugerido']->renderError();
                        if ($contacto) {
                            $form->setDefault('sugerido', $contacto->getCaSugerido());
                        }
                        echo $form['sugerido']->render();
                        ?> Sugerir en Colsys
                    </td>
                </tr>
                <tr>
                    <td><b>Activo: </b></td>
                    <td colspan="3">
                        <?
                        echo $form['activo']->renderError();
                        if ($contacto) {
                            $form->setDefault('activo', $contacto->getCaActivo());
                        } else {
                            $form->setDefault('activo', true);
                        }
                        echo $form['activo']->render();
                        ?>
                        Activo<br /></td>
                </tr>
                <?
                if ($modo == "prov") {
                    ?>
                    <tr>
                        <td><b>Notificar Vencimiento de documentos: </b></td>
                        <td colspan="3">
                            <?
                            echo $form['notificar_vencimientos']->renderError();
                            if ($contacto) {
                                $form->setDefault('notificar_vencimientos', $contacto->getCaNotificarVencimientos());
                            } else {
                                $form->setDefault('notificar_vencimientos', false);
                            }
                            echo $form['notificar_vencimientos']->render();
                            ?>
                            <br />
                        </td>
                    </tr>
                    <?
                }
                ?>
                <tr>
                    <td colspan="4" ><div align="center">
                            <input type="submit" value="Guardar" class="button" />&nbsp;

                            <input type="button" value="Cancelar" class="button"
                                   onClick="document.location = '<?= url_for("ids/verIds?modo=" . $modo . "&id=" . $sucursal->getCaId()) ?>'" />
                        </div></td>
                </tr>

                <?
                if ($contacto && $contacto->getCaUsucreado()) {
                    ?>
                    <tr>
                        <td colspan="2">
                            <div align="left"><b>Creado:</b> <?= $contacto->getCaUsucreado() . " " . Utils::fechaMes($contacto->getCaFchcreado()) ?></div>
                        </td>
                        <td colspan="2">
                            <div align="left"><?= $contacto->getCaUsuactualizado() ? "<b>Actualizado:</b>" : "&nbsp;" ?> <?= $contacto->getCaUsuactualizado() . " " . Utils::fechaMes($contacto->getCaFchactualizado()) ?></div>
                        </td>           
                    </tr>
                    <?
                }
                ?>

            </tbody>
        </table>
    </form>


</div>

<script type="text/javascript">
    verificarCargo();
</script>