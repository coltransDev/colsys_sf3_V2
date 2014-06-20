<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$i=1;
?>

<table class="tableList alignCenter"  id="archivos" width='40%'>
    <tr>
        <th colspan="2">
            Archivos
        </th>
    </tr>
    <?
    foreach ($filenames as $file) {
        $id_tr = "tr_$i";
        ?>
        <tr id="<?= $id_tr ?>" >
            <td >
                <b><?= $i++ ?>.</b>&nbsp;&nbsp;&nbsp;&nbsp;
                <b>Archivo <?= $file["file"] ?></b>
                <div id="hbl_defs">
                    <?= link_to(basename($folder . "/" . $file["file"]), "gestDocumental/verArchivo?idarchivo=" . base64_encode($folder . "/" . $file["file"])) ?>
                    &nbsp;&nbsp;
                    <a href="#" onclick="eliminar('<?= base64_encode($folder . "/" . $file["file"]) ?>', '<?= $id_tr ?>')"><?= image_tag("16x16/delete.gif", 'size=18x18 border=0') ?></a>
                    <input type="checkbox" name="files[]" id="files" value="<?= $folder . "/" . $file["file"] ?>"/>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <?
    }
    ?>
</table>