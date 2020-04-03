<?php
$archivos = $sf_data->getRaw("archivos");
if(count($mandatos)==0){
    ?>
    <span style="color:red;">Este cliente no tiene mandatos registrados en Colsys!</span>
    <?
}else{
    ?>
    <table width="100%">
        <tr><th>Clase</th><th>Tipo</th><th>Fch. Radicado</th><th>Fch. Vencimiento</th></tr>
        <?

        foreach($mandatos as $mandato){
            ?>
            <tr class="<?=$mandato["color"]?>"><td><?=$mandato["clase"]?></td><td><?=$mandato["tipo"]?></td><td><?=$mandato["fchradicado"]?></td><td><?=$mandato["fchvencimiento"]?></td></tr>
            <?
        }
        if(count($archivos) > 0){
            ?>
            <tr><td colspan="4">                    
                <ul style="list-style-type:none;">
                <?
                foreach ($archivos as $file) {
                    if (!Utils::isImage($file->getCaNombre())) {
                        if (substr($file, -3, 3) == ".gz") {
                            $nombreArchivo = substr($file->getCaNombre(), 0, strlen($file->getCaNombre()) - 3);
                        } else {
                            $nombreArchivo = $file->getCaNombre();
                        }
                        ?>
                        <li>
                            <?=image_tag("22x22/mimetypes/pdf_document.gif") ?>                     
                            <a href="/gestDocumental/verArchivo?id_archivo=<?=$file->getCaIdarchivo()?>"  target="_blank"><?= basename($nombreArchivo) ?></a>
                        </li>
                        <?            
                    }
                }
                ?>
            </ul></td></tr>   
            <?        
        }
        ?>        
    </table>
    <?
}