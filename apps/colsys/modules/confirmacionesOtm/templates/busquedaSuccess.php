<?
/*
 * Muestra los resultados de la busqueda de la cotización 
 * @author Andres Botero
 */
?>
<div align="center">
    <?
    $url = "confirmacionesOtm/busqueda?criterio=" . $criterio;
    if ($cadena) {
        $url.="&cadena=" . str_replace(".", "-", $cadena);
    }

    if ($modo) {
        $url.="&modo=" . $modo;
    }

    $pagerLayout = new Doctrine_Pager_Layout(
            $pager, new Doctrine_Pager_Range_Sliding(array(
        'chunk' => 5
            )), url_for($url) . "?page={%page_number}"
    );

    $pagerLayout->setTemplate('<a href="{%url}">{%page}</a> ');
    $pagerLayout->setSelectedTemplate('{%page}');

    $pagerLayout->display();
    ?>
    <br />
    <br />

    <table class="tableList" width="800px" border="1" id="mainTable">
        <tr>
            <th width="57" scope="col">Referencia</th>
            <th width="668" scope="col">Linea</th>
        </tr>
        <?
        foreach ($referencias as $referencia) {
            $linea = $referencia->getIdsProveedor()->getIds();
            $origen = $referencia->getOrigen();
            $destino = $referencia->getDestino();
            ?>
                <tr>
                    <td rowspan="2"  ><?= link_to($referencia->getCaReferencia(), "confirmacionesOtm/consulta?referencia=" . $referencia->getCaIdmaster()) ?></td>
                    <td ><?= $linea->getCaNombre() ?></td>
                </tr>
                <tr>
                    <td >
                        <table class="tableList" width="100%" border="1">
                            <tr>
                                <td class="listar" ><b>Trayecto</b></td>
                                <td class="listar"><b>Fch.Salida</b></td>
                                <td class="listar"><b>Fch.Llegada</b></td>
                                <td class="listar"><b>Motonave</b></td>
                            </tr>
                            <tr>
                                <td width="40%" class="listar" ><?= $origen->getTrafico() . " " . $origen->getCaCiudad() ?>&raquo;<?= $destino->getTrafico() . " " . $destino->getCaCiudad() ?></td>
                                <td width="15%" class="listar"><?= $referencia->getCaFchsalida() ?></td>
                                <td width="11%" class="listar"><?= $referencia->getCaFchllegada() ?></td>
                                <td width="34%" class="listar"><?= $referencia->getCaMotonave() ?></td>
                            </tr>
                        </table></td>
                </tr>
            <?
        }
        if (count($referencias) == 0) {
            ?>
                <tr>
                    <td  colspan="2" scope="col"><div align="center">No hay resultados</div></td>
                </tr>
            <?
        }
    ?>
    </table><br /><br />
</div>