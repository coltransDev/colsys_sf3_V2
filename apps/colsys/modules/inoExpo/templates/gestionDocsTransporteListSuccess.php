<center>
    <table width="600" border="1" cellspacing="1" cellpadding="5" class="tableList">
        <tbody>
            <tr>
                <th class="titulo" colspan="9">Sistema Administrador de Referencias de Exportación</th>
            </tr>
            <?
            foreach ($data as $key => $referencia) {
                ?>
                <tr>
                    <td class="listar" rowspan="3" style="vertical-align: top; font-weight: bold"><a href="/inoExpo/definicionDocsTransporteExt4/id/<?= base64_encode($referencia["ca_referencia"]) ?>/via/<?= $referencia["ca_via"] ?>"><?= $referencia["ca_referencia"] ?></a></td>
                    <td class="listar" colspan="6" style="font-weight: bold"><?= $referencia["ca_compania"] ?></td>
                </tr>
                <tr>
                    <td class="invertir" colspan="2" style="text-align: center">Origen</td>
                    <td class="invertir" colspan="2" style="text-align: center">Destino</td>
                    <td class="invertir">Fch.Referencia</td>
                    <td class="invertir">V&iacute;a</td>
                </tr>
                <tr>
                    <td class="listar"><?= $referencia["ca_traorigen"] ?></td>
                    <td class="listar"><?= $referencia["ca_ciuorigen"] ?></td>
                    <td class="listar"><?= $referencia["ca_tradestino"] ?></td>
                    <td class="listar"><?= $referencia["ca_ciudestino"] ?></td>
                    <td class="listar"><?= $referencia["ca_fchreferencia"] ?></td>
                    <td class="listar"><?= $referencia["ca_via"] ?></td>
                </tr>

                <tr style="height:5">
                    <td class="invertir" colspan='9'>
                    </td>
                </tr>
                <tr style="height:5">
                    <td class="imprimir" colspan='9'>
                    </td>
                </tr>
                <?
            }
            ?>

        </tbody>

    </table>
</center>