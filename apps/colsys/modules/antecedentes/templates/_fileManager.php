<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_component("gestDocumental", "widgetUploadButton");
?>

<script language="javascript" type="text/javascript">
	
   
    Ext.onReady(function(){
        var wd = Ext.getBody().getWidth();


        var uploadButton = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Referencias/".$ref->getCaReferencia())?>",
            filePrefix: "MBL",
            update: "master_bl",
            confirm: true
        });
        uploadButton.render("button1");

        var uploadButton2 = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Referencias/".$ref->getCaReferencia())?>",
            filePrefix: "HBL",
            update: "hbl_defs",
            confirm: true
        });
        uploadButton2.render("button2");

        var uploadButton3 = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Referencias/".$ref->getCaReferencia())?>",
            filePrefix: "Other",
            update: "other",
            confirm: true
        });
        uploadButton3.render("button3");

     });
   

</script>


<table class="tableList alignLeft" width="100%">
    <tr>
       <th colspan="2">
           Archivos
       </th>
    </tr>
    <tr>
        <td width="130px">
           <b>Imagen BL <?=$ref->getCaMbls()?>:</b>
           <div id="master_bl"><?=isset($filenames["MBL"])?link_to(basename($filenames["MBL"]["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($filenames["MBL"]["file"])):"<span class='rojo'>No se ha subido el archivo</span>"?></div>
           <div id="button1" ></div>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="130px">
            <b>Imagen HBL Definitivos:</b>
            <div id="hbl_defs"><?=isset($filenames["HBL"])?link_to(basename($filenames["HBL"]["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($filenames["HBL"]["file"])):"<span class='rojo'>No se ha subido el archivo</span>"?></div>
           <div id="button2" ></div>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="130px">
            <b>Imagen otros:</b>
            <div id="other"><?=isset($filenames["Other"])?link_to(basename($filenames["Other"]["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($filenames["Other"]["file"])):"<span class='rojo'>No se ha subido el archivo</span>"?></div>
           <div id="button3" ></div>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
</table>
