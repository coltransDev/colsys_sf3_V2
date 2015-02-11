<?
//echo count($inoClientes);
?>
<tr>
    <th class="titulo" style="font-size: 11px; font-weight:bold;" colspan="5">Seleccione los Clientes para enviar Confirmación</th>
</tr>
<tr height="5">
    <td class="invertir" colspan="5">&nbsp;</td>
</tr>
<?
$dimension = 100;
foreach ($inoClientes as $inoCliente) {
    $cliente = $inoCliente->getCliente();
    $reporte = $inoCliente->getReporte();
    $comercial = $reporte->getCaLogin();    
    $importador = $reporte->getRepOtm()->getImportador()->getCaNombre();    
    
    // Archivos que se encuentran en el directorio antiguo
    $folder = date('Y') . DIRECTORY_SEPARATOR . "Referencias/Otm/" . $inoCliente->getInoMaster()->getCaReferencia() . "/" . $inoCliente->getCaDoctransporte() . "/";
    $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
    $archivos = sfFinder::type('file')->maxDepth(0)->in($directory); 
    ?>
    <tr>
        <td class="listar" style='font-size: 11px; vertical-align:bottom'><b>Reporte:</b><br /><?= $reporte ? $reporte->getCaConsecutivo() : "&nbsp;" ?>
            <input type="hidden" id='consolidar_comunicaciones_<?= $inoCliente->getOid() ?>' value="<?= $cliente->getProperty("consolidar_comunicaciones") ?>" />
            <input type="hidden" id='nombre_cliente_<?= $inoCliente->getOid() ?>' value="<?= $cliente->getCaCompania() ?>" />
        </td>
        <td class="listar" style='font-size: 11px; vertical-align:bottom;'><span class="listar" style="font-size: 11px; vertical-align:bottom"><b>Id Cliente:</b><br />
            <?= number_format($inoCliente->getCaIdcliente()) ?>
            </span></td>
        <td class="listar" style='font-size: 11px; vertical-align:bottom;' colspan="2">
            <b>Nombre del Cliente:</b> &nbsp;&nbsp;&nbsp;<a href="<?= "/reportesNeg/emailInstruccionesOtm/idreporte/" . $reporte->getCaIdreporte() . "/impoexpo/" . $reporte->getCaImpoexpo() . "/modo/" . $reporte->getCaTransporte() ?>" target="_blank"><img src="/images/22x22/email.gif" title="Enviar Instrucciones" style="vertical-align:middle" ></a><br />
            <?= Utils::replace($cliente->getCaCompania())?><?=$comercial=="consolcargo"?" / ".$importador:""?>
        </td>
        <td class="listar" >
            <div align="right">
                <?
                if ($reporte) {
                    if ($cliente->getProperty("cuentaglobal") == "true") {
                        ?>	
                        <img src="/images/CG30.png" title="Cliente de Cuentas Globales" />
                        <?
                    }
                    if ($cliente->getProperty("consolidar_comunicaciones") == "true") {
                        ?>	
                        <img src="/images/consolidate.png" title="Cliente de Cuadro" />
                        <?
                    }
                    ?>
                    <input type="checkbox" name='oid[]' onclick="habilitar('<?= $inoCliente->getOid() ?>');" id="checkbox_<?= $inoCliente->getOid() ?>"  value="<?= $inoCliente->getOid() ?>" />
                    <input type="hidden" name='idinocliente_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaIdhouse() ?>" />
                    <input type="hidden" name='idcliente_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaIdcliente() ?>" />
                    <input type="hidden" name='hbls_<?= $inoCliente->getOid() ?>' value="<?= $inoCliente->getCaDoctransporte() ?>" />
                    <?
                } else {
                    echo "&nbsp;";
                }
                ?>				
            </div></td>
    </tr>
    <?
    if ($reporte) {
        ?>
        <tr>			
            <td class="invertir" colspan="5">
        <?
        include_component("confirmacionesOtm", "formConfirmacion", array("inoCliente" => $inoCliente, "modo" => $modo, "reporte" => $reporte->getRepUltVersion(), "cliente" => $cliente, "etapas" => $etapas, "coordinadores" => $coordinadores, "textos" => $textos, $bodegas = "bodegas", "dimension" => $dimension, "archivos" => $archivos, "folder" => $folder))
        ?>
            </td>
        </tr>
        <?
        $statusList = $reporte->getRepStatus();

        if (count($statusList) > 0) {
            ?>
            <tr id="rowstatusinfo_<?= $inoCliente->getOid() ?>">
                <td colspan="5" class="invertir"><a href="#rowstatusinfo_<?= $inoCliente->getOid() ?>" onclick="window.open('<?= url_for("traficos/verHistorialStatus?idreporte=" . $reporte->getCaIdreporte()) ?>')">Ver historial de status</a></td>
            </tr>
            <?
        }
    } else {//if( $reporte )
        ?>
        <tr height="5">
            <td class="invertir" colspan="5"><?= image_tag("22x22/alert.gif") ?>Debe tener reporte para poder hacer un status</td>
        </tr>
        <?
    }
}
?>