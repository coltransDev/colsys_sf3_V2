<?
include_component("gestDocumental", "widgetUploadImages");
?>
<tr>
    <th class="titulo" colspan="7">Notificar planillas de envio a los clientes</th>
</tr>
<tr height="5">
    <td class="captura" colspan="7">&nbsp;</td>
</tr>

<tr class="b">
    <td class="listar" ><b>Reporte:</b></td>
    <td class="listar">Hbl</td>
    <td class="listar"><b>Id Cliente:</b></td>
    <td class="listar" colspan="3" ><b>Nombre del Cliente:</b></td>
    <td class="listar">Planilla</td>                
</tr>            
<?
$dimension = 640;
$dimVisual = 100;
$i = 0;
$j = 0;
foreach ($inoClientes as $inoCliente) {
    $i++;
    $cliente = $inoCliente->getCliente();
    $reporte = $inoCliente->getReporte();
    $idreporte = $inoCliente->getCaIdreporte();
    ?>
    <tr>
        <td class="listar"  style='font-size: 11px; vertical-align:bottom'>
            <?= $reporte ? $reporte->getCaConsecutivo() : "&nbsp;" ?>
            <input type="hidden" id='consolidar_comunicaciones_<?= $inoCliente->getOid() ?>' value="<?= $cliente->getProperty("consolidar_comunicaciones") ?>" />
            <input type="hidden" id='nombre_cliente_<?= $inoCliente->getOid() ?>' value="<?= $cliente->getCaCompania() ?>" />
        </td>
        <td class="listar"><?= $inoCliente->getCaHbls() ?></td>
        <td class="listar" style='font-size: 11px; vertical-align:bottom'><span class="listar" style="font-size: 11px; vertical-align:bottom">
                <?= number_format($inoCliente->getCaIdcliente()) ?>
            </span></td>
        <td class="listar" style='font-size: 11px;' colspan="3"><?= Utils::replace($cliente->getCaCompania()) ?></td>
        <td class="listar" style='font-size: 11px;' colspan="3">
            <input type="hidden" name='oid[]' id="checkbox_<?= $inoCliente->getOid() ?>"  value="<?= $inoCliente->getOid() ?>" />
            <input type="hidden" name='idcliente_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaIdcliente() ?>" />
            <input type="hidden" name='hbls_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaHbls() ?>" />
            Planilla Envio # &nbsp;<input type="text" name='idplanilla_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaPlanilla() ?>" /><?=$inoCliente->getCaContinuacion() != "N/A"?"<span style='color:red'>OTM: Este número no se notificará a los usuarios</span>":""?>
        </td>
    </tr>	
    <tr height="<?= $alto + 20 ?>">
        <td colspan="6" style="vertical-align: top" >
            <div id="thumbnails_<?= $i ?>"></div>
        </td>
    </tr>
<?
}
?>
