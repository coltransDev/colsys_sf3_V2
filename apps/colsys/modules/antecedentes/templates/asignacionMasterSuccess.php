<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("gestDocumental", "widgetUploadButton");
include_component("antecedentes", "panelReportesAntecedentes");
include_component("antecedentes", "panelMasterAntecedentes", array("master"=>$master));
include_component("antecedentes", "gridDropZone", array("master"=>$master));
?>

<div class="content">
    <div >
        <table class="tableList" width="100%">
            <tr>
                <th colspan="2">
                    Informaci&oacute;n
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Master:</b> <?=$master?>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    Archivos
                </th>
            </tr>
            <tr>
                <td width="130px">
                   <b>Imagen BL <?=$master?>:</b> 
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
        </table>
    </div>
    <br />
    <div id="main-panel"></div>
</div>
<script type="text/javascript">
    Ext.onReady(function(){
        var wd = Ext.getBody().getWidth();


        var uploadButton = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Antecedentes/".$master)?>",
            filePrefix: "MBL",
            update: "master_bl",
            confirm: true
        });
        uploadButton.render("button1");

        var uploadButton2 = new WidgetUploadButton({
            text: "Subir",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Antecedentes/".$master)?>",
            filePrefix: "HBL",
            update: "hbl_defs",
            confirm: true
        });
        uploadButton2.render("button2");
        
        var panel = new Ext.Panel({
            layout: 'border',
            height: 500,
            items: [               
                new PanelReportesAntecedentes({
                    region: 'west',
                    split: true,
                    width: wd/2
                }),
                new PanelMasterAntecedentes({
                    region: 'center'
                })
            ]
        });

        panel.render("main-panel");
    });

</script>


