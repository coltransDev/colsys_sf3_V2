<?
include_component("gestDocumental", "widgetUploadImages");
?>
<tr>
    <th class="titulo" colspan="7">Adjuntar Fotos de averias en la carga de los clientes</th>
</tr>
<tr height="5">
    <td class="captura" colspan="7">&nbsp;</td>
</tr>

<tr class="b">
    <td class="listar" ><b>Reporte:</b></td>
    <td class="listar">Doc. Transporte</td>
    <td class="listar"><b>Id Cliente:</b></td>
    <td class="listar" colspan="3" ><b>Nombre del Cliente:</b></td>
    <td class="listar">Imagenes</td>                
</tr>            
<?
$dimension = 640;
$dimVisual = 100;
$i = 0;
$j = 0;
$narchivos = 0;
foreach ($inoClientes as $inoCliente) {
    $i++;
    $reporte = $inoCliente->getReporte();    
    $comercial = $reporte->getCaLogin();
    
    $cliente = $inoCliente->getCliente();
    
    $importador = $reporte->getRepOtm()->getImportador()->getCaNombre(); 
    
    if($comercial=="consolcargo"){
        $cliente = $importador;
    }
    
    // Archivos ubicados en directorio de Gestion Documental    
    $folder = date('Y') . DIRECTORY_SEPARATOR . "Referencias/Otm/" . $inoCliente->getInoMaster()->getCaReferencia() . "/" . $inoCliente->getCaDoctransporte() . "/";
    $directory = sfConfig::get('app_digitalFile_root') . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
    
    $data = array();
    $data["ref1"] = $inoCliente->getInoMaster()->getCaReferencia();
    $data["ref2"] = $inoCliente->getCaDoctransporte();
    $data["prefijo"] = "otm";
    
    $archivos = ArchivosTable::getArchivosActivos($data);
    
    foreach($archivos as $archive){ 
        if(Utils::isImage($archive->getCaNombre())){
            $narchivos+=1;
        }
    }
    
    $alto = ceil($narchivos / 4) * $dimVisual;
    
    ?>
    <tr>
        <td class="listar"><?= $inoCliente->getCaDoctransporte() ?></td>
        <td class="listar" style='font-size: 11px; vertical-align:bottom'><span class="listar" style="font-size: 11px; vertical-align:bottom">
                <?= number_format($inoCliente->getCaIdcliente()) ?>
            </span></td>
        <td class="listar" style='font-size: 11px;' colspan="3">
            <?= Utils::replace($cliente) ?></td>
        <td>
            <form>
                <div style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                    <span id="but<?= $i ?>"></span>
                </div>
            </form>
            <div id="div<?= $i ?>"></div>
            <script>
                chart<?= $i ?> = new WidgetUploadImages({
                    post_params: {
                        "documento": "26",
                        "ref1":"<?=$inoCliente->getInoMaster()->getCaReferencia()?>",
                        "ref2":"<?=$inoCliente->getCaDoctransporte()?>",
                        "prefijo":"otm",
                        "tam_max": "<?=$dimension?>",
                        "tam_max_visual": <?=$dimVisual?>,
                        "thumbnails": "thumbnails_<?= $i ?>",                        
                    },
                    upload_url: "<?=url_for('gestDocumental/subirArchivoTRD')?>",
                    button_placeholder_id: "but<?= $i ?>",
                    upload_target: 'div<?= $i ?>'
                });
            </script>
        </td>
    </tr>	
    <tr height="<?= $alto + 20 ?>">
        <td colspan="6" style="vertical-align: top" >
            <div id="thumbnails_<?= $i ?>">
                <?php
                
                foreach ($archivos as $file) {                    
                    if(Utils::isImage($file->getCaNombre())){
                        $filename = $file->getCaNombre();
                        $id_base = base64_encode($folder . $filename);
                        echo '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 5px;" id="file_' . $j . '">
                            <div style="position:relative ">
                                <div style="position:absolute;" >
                                    <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder . "/" . $filename) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" />
                                </div>
                                <div style="position:absolute;top:0px;right:0px" >
                                    <img src="/images/16x16/button_cancel.gif" style="cursor: pointer" onclick="eliminar(&quot;' . $file->getCaIdarchivo() . '&quot;)" />
                                </div>
                                <div style="position:absolute;top:20px;right:0px;display:none" >
                                   <input type="checkbox" value="' . $folder . $filename . '" name="files_' . $inoCliente->getOid() . '[]" />
                                </div>
                        </div>                        
                      </div>';
                    }
                }                
                ?>
            </div>
        </td>
    </tr>
    <?
    $narchivos = 0;
}
?>
<script>
    // Anula archivo en el directorio de Gestión Documental
    function eliminar(id){
        Ext.MessageBox.show({
            title: 'Eliminacion de Archivo ',
            msg: 'Por favor ingrese el motivo de la eliminacion:',
            width:300,
            buttons: Ext.MessageBox.OKCANCEL,
            multiline: true,
            fn: function (btn, text){
                if( btn == "ok"){
                    if( $.trim(text)==""){
                        alert("Debe colocar un motivo");
                    }else{
                        if(btn=="ok"){
                            Ext.MessageBox.wait('Eliminando Archivo', '');
                            Ext.Ajax.request({
                                url: '/gestDocumental/eliminarArchivo',
                                method: 'POST',                
                                waitTitle: 'Connecting',
                                waitMsg: 'Eliminando Archivo...',                                     
                                params: {
                                    "idarchivo" : id,
                                    "observaciones": text
                                },
                                scope:this,
                                success: function(a,b){
                                    location.href=location.href;
                                },                                    
                                failure: function(){console.log('failure');alert("No fue posible eliminar el archivo");}
                            });
                        }
                    }
                }
            }                   
        })
    }
</script>