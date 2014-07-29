<?
include_component("gestDocumental", "widgetUploadImages");
?>
<tr>
    <th class="titulo" >Adjuntar Fotos</th>
</tr>

<?
$dimension = 640;
$dimVisual = 50;
$i = 0;
$j = 0;
if ($reporte) {
    $i++;
    $cliente = $reporte->getCliente();
    $referencia = $reporte->getNumReferencia();
    
    // Archivos ubicados en el directorio antiguo
    $folderOld =  $reporte->getDirectorioBase();
    $directoryOld =$reporte->getDirectorio();
    $archivosOld = sfFinder::type('file')->maxDepth(0)->name(array('*.jpeg*', '*.jpg*', '*.png*', '*.gif*', '*.JPEG*', '*.JPG*', '*.PNG*', '*.GIF*'))->in($directoryOld);
    
    $narchivos = count($archivosOld);
    
    //Archivos Gestión Documental
    if($referencia){
        $archivos = $reporte->getFilesGestDoc();
        $narchivos+=count($archivos);
    }
    
    $alto = ceil($narchivos / 4) * $dimVisual;
    ?>

    <tr>
        <td style="border-bottom: 0px;">
            <form>
                <div style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                    <span id="but<?= $i ?>"></span>
                </div>
            </form>
            <div id="div<?= $i ?>"></div>
            <script>

                chart<?= $i ?> = new WidgetUploadImages({
                    post_params: {
                        "folder": "<?= base64_encode($folderOld) ?>",
                        "tam_max": "<?= $dimension ?>",
                        "tam_max_visual": <?= $dimVisual ?>,
                        "thumbnails": "thumbnails_<?= $i ?>"
                    },
                    button_placeholder_id: "but<?= $i ?>",
                    upload_target: 'div<?= $i ?>',
                    debug: true
                });
            </script>
        </td>
    </tr>	
    <tr height="<?= $alto + 20 ?>">
        <td colspan="6" style="vertical-align: top; border-bottom: 0px;" >
            <div id="thumbnails_<?= $i ?>">
                <?php
                foreach ($archivosOld as $file) {
                    $archivo = explode("/", $file);
                    $filename = $archivo[count($archivo) - 1];
                    if(Utils::isImage($filename)){
                        $id_base = base64_encode($folderOld . "/" . $filename);
                        echo '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 5px;" id="file_' . $j . '">
                            <div style="position:relative ">
                                <div style="position:absolute;" >
                                    <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folderOld . "/" . $filename) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" />
                                </div>
                                <div style="position:absolute;top:0px;right:0px" >
                                    <img src="/images/16x16/button_cancel.gif" style="cursor: pointer" onclick="deleteFile(&quot;' . $id_base . '&quot;,&quot;file_' . $j++ . '&quot;)" />
                                </div>
                                <div style="position:absolute;top:20px;right:0px;display:none" >
                                    <input type="checkbox" value="' . $folderOld . '"/"' . $filename . '" name="files[]" />
                                </div>
                            </div>                        
                          </div>';
                    }
                }
                if(count($archivos)){
                    foreach ($archivos as $file) {
                        if(Utils::isImage($file->getCaNombre())){
                            $filename = $file->getCaNombre();
                            $folder = $reporte->getDirectorioBaseDocs($filename);                            
                            echo '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 5px;" id="file_' . $j . '">
                                <div style="position:relative ">
                                    <div style="position:absolute;" >
                                        <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" />
                                    </div>                                    
                                    <div style="position:absolute;top:20px;right:0px;display:none" >
                                       <input type="checkbox" value="' . $folder . '" name="files_' . $reporte->getInoClientesSea()->getOid() . '[]" />
                                    </div>
                            </div>                        
                          </div>';
                        }
                    }
                }
                ?>
            </div>
        </td>
    </tr>
    <?
    //break;
}
?>
<script>

    function deleteFile(file, idtr)
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
</script>