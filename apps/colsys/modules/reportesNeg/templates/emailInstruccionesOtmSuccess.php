<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("gestDocumental", "widgetUploadButton");
$i = 1;

$year = explode("-", $reporte->getCaConsecutivo());
$this->year = $year[1];
$folder = "reportes/" . $this->year . "/" . $reporte->getCaConsecutivo() . "/instrucciones";
?>


<div id="emailForm" align="center">     
    <form name="form1" id="form1" method="post" action="<?= url_for("reportesNeg/enviarEmailInstrucciones?idreporte=" . $reporte->getCaIdreporte()) ?>" onsubmit="return loadhtml()" >
        <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
        <?
        $cli_txt = ($this->repotm !== false) ? $reporte->getCliente()->getCaCompania() : (($repotm->getCaIdimportador() > 0) ? $repotm->getImportador()->getCaNombre() : $repotm->getCliente()->getCaNombre());
        $asunto = "DOCUMENTOS OTM:" . substr($reporte->getCaOrigen(), 0, 3) . "/" . substr($reporte->getCaDestino(), 0, 3) . " " . $cli_txt . " HBL No." . $repotm->getCaHbls() . " ETA " . $repotm->getCaFcharribo();

        $mensaje = "Señores:<br><br>" . (($reporte->getConsignatario()) ? $reporte->getConsignatario()->getCaNombre() : "") . "<br>Esta carga será entregada a ustedes para el manejo del OTM.<br>Nota importante: favor revisar la documentación y dejarnos saber hoy mismo si tiene algún inconveniente. ";
        $html = "<table class='tableList alignLeft' width='40%'>";
        $html .="<tr><th colspan='2'>Información General</th></tr>";
        $html .="<tr><th colspan='2'> <input style='width: 100%' id='cliente' name='cliente' value='" . $cli_txt . "'></th></tr>";
        $html .="<tr><td style='width: 30%'>HBL No. :</td><td><input style='width: 100%'  id='hbls' name='hbls' value='" . $repotm->getCaHbls() . "'></td></tr>";
        $html .="<tr><td>ETA: </td><td><input style='width: 100%' id='eta' name='eta' value='" . $repotm->getCaFcharribo() . "'></td></tr>";
        $html .="<tr><td>MOTONAVE : </td><td><input style='width: 100%' id='motonave' name='motonave' value='" . $repotm->getCaMotonave() . "'></td></tr>";
        $html .="<tr><td>MUELLE: </td><td><input style='width: 100%' id='muelle' name='muelle' value='" . $repotm->getInoDianDepositos()->getCaNombre() . "'></td></tr>";
        $html .="<tr><td>REF: </td><td><input style='width: 100%' id='ref' name='ref' value='" . $reporte->getCaOrdenClie() . "'></td></tr>";
        $html .="<tr><td>TERMINO DE NEGOCIACION: </td><td><input style='width: 100%' id='incoterm' name='incoterm' value='" . $reporte->getIncotermsStr() . "'></td></tr>";
        $html .="<tr><td>BODEGA: </td><td><input style='width: 100%' id='bodega' name='bodega' value='" . ($reporte->getBodega()->getCaNombre()) . "'></td></tr>";
        $html .="<tr><td>DESCRIPCION : </td><td><input style='width: 100%' id='mercancia' name='mercancia' value='" . $reporte->getCaMercanciaDesc() . "'></td></tr>";
        $html .="<tr><td>VALOR FOB : </td><td><input style='width: 100%' id='valorfob' name='valorfob' value='" . $reporte->getRepOtm()->getCaValorfob() . "'></td></tr>";
        $html .="<tr><td>Datos de liberación: </td><td>" . (($user->getIdempresa() == "4") ? "CONSOLCARGO" : "COLTRANS") . "</td></tr>";
        $html .="<tr><td>DATOS DEL ACI:</td><td>" . (($user->getIdempresa() == "4") ? "CONSOLCARGO" : "COLTRANS") . "</td></tr></table>";

        include_component("email", "formEmail", array("subject" => $asunto, "messageHtml" => $mensaje, "contacts" => $contactos));
        ?>
        <br />
        <div align="center"><?= $html ?></div><br />
        <div align="center"><? include_component("reportesNeg", "fileManager", array("reporte" => $reporte)); ?></div><br />
        
        <input type="submit" value="Enviar" class="button" /><br /><br />
    </form>
    <div id="button1" name="button1" align="center" ></div>
</div>
<script language="javascript" type="text/javascript">
    loadhtml = function(){
    }

    button = 0;

    var uploadButton = new WidgetUploadButton({
        text: "Agregar Archivo",
        iconCls: 'arrow_up',
        folder: "<?= base64_encode($folder) ?>",
        filePrefix: "",
        confirm: true,
        callback: "actualizar"
    });
    uploadButton.render("button1");


    function actualizar(file)
    {
        selec = '<input type="checkbox" name="files[]" id="files" value="<?= $folder ?>/' + file + '"/>';
        $("#archivos").append("<tr><td ><b>" + (button++) + ".</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Archivo " + file + " </b><div id='hbl_defs'><a href='<?= url_for("gestDocumental/verArchivo?idarchivo=") ?>" + Base64.encode("<?= $folder ?>/" + file) + "'>" + file + "</a>&nbsp;" + selec + "</div></td><td>&nbsp;</td></tr>");
    }

    function eliminar(file, idtr)
    {
        if (window.confirm("Realmente desea eliminar este archivo?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
                    {
                        waitMsg: 'Guardando cambios...',
                        url: '<?= url_for("gestDocumental/borrarArchivo") ?>',
                        params: {
                            idarchivo: file
                        },
                        failure: function(response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.err)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function(response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            $("#" + idtr).remove();
                            Ext.MessageBox.hide();
                        }
                    });
        }
    }

    button =<?= $i ?>;
</script>