<?
use_helper("MimeType");
?>
<ul>
    <?
    foreach ($files as $file) {
        //$fileIdx = $user->addFile( $file );
        if (substr($file, -3, 3) == ".gz") {
            $nombreArchivo = substr($file, 0, strlen($file) - 3);
        } else {
            $nombreArchivo = $file;
        }
        ?>
        <li>
            <?= mime_type_icon(basename($file)) ?> 
            <a href="<?= url_for("traficos/fileViewer?idreporte=" . $reporte->getCaIdreporte() . "&file=" . base64_encode(basename($file))) ?>" target="_blank"><?= basename($nombreArchivo) ?></a>
            <?
            if ($nivel > 0) {
                ?>
                <a href="#" onclick="eliminarArchivos('<?= $reporte->getCaIdreporte() ?>', '<?= base64_encode(basename($file)) ?>')"><?= image_tag("16x16/delete.gif") ?></a>
                <?
            }
            ?>
        </li>
        <?
        echo "</li>";
    }
    foreach ($archivos as $file) {
        if (!Utils::isImage($file->getCaNombre())) {
            //$fileIdx = $user->addFile( $file );
            if (substr($file, -3, 3) == ".gz") {
                $nombreArchivo = substr($file->getCaNombre(), 0, strlen($file->getCaNombre()) - 3);
            } else {
                $nombreArchivo = $file->getCaNombre();
            }
            $tagIdg = '<p></p>';
                                
            $tipodoc = $file->getTipoDocumental();                                
            
            if(strpos($tipodoc->getCaDocumento(), "Factura") !== false){                   
                $iddoc = $file->getCaIddocumental();                
                $idcomprobante = $idcomprobantes[$file->getCaIdarchivo()];
                
                if($idcomprobante){                
                    $comprobante = Doctrine::getTable("InoComprobante")->find($idcomprobante);
                    $idg = $comprobante->getResultadoIndicador();

                    if($idg["sucess"] == true){
                        $tagIdg = utf8_decode($idg["tag"]); 
                    }
                }
            }
                    
            ?>
            <li>
                <?= mime_type_icon(basename($nombreArchivo)) ?> 
                <a href="<?= url_for("traficos/fileViewer?idreporte=" . $reporte->getCaIdreporte() . "&gestDoc=true&file=" . base64_encode(basename($nombreArchivo))) ?>" target="_blank"><?= basename($nombreArchivo) ?></a>&nbsp;<?=$tagIdg?>
            </li>
            <?
            echo "</li>";
        }
    }
    ?>
</ul>
<?
if ($nivel > 0) {
    ?>
    <div class="box1" style="margin: 3px;">
        <form action="<?= url_for("traficos/cargarArchivo") ?>"  target="uploadFrame" enctype="multipart/form-data" method="post" >
            <input type="hidden" name="idreporte" value="<?= $reporte->getCaIdreporte() ?>" />
            <table width="100%" border="0">
                <tr style="border-width: 0px;">
                    <td style="border-bottom: 0px;"><div align="right"><b>Buscar archivo </b></div></td>
                    <td style="border-bottom: 0px;"><input type="file" name="file" /></td>
                    <td style="border-bottom: 0px;"><div align="center"><input type="submit" class="button" value="Subir" /></div></td>
                </tr>
            </table>
        </form>
    </div>
    <?
}
?>