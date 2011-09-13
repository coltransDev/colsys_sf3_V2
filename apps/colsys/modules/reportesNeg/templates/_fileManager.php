<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_component("gestDocumental", "widgetUploadButton");
$i=1;
//echo $year;
?>



<table class="tableList alignCenter" width="60%" id="archivos">
    <tr>
       <th colspan="2">
           Archivos
       </th>
    </tr>

    <tr>
        <td >
           <div id="button1" name="button1" ></div>
        </td>
        <td>
            &nbsp;
        </td>
    </tr>

    <?

        foreach($filenames as $file)
        {
            $id_tr="tr_$i";
    ?>
    <tr id="<?=$id_tr?>" >
        <td >
            <b><?=$i++?>.</b>&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Archivo <?=$file["file"]?></b>
            <div id="hbl_defs">
            <?= link_to(basename($folder."/".$file["file"]), "gestDocumental/verArchivo?idarchivo=".base64_encode($folder."/".$file["file"]))?>
                
                &nbsp;&nbsp;
                <a href="#" onclick="eliminar('<?=base64_encode($folder."/".$file["file"])?>','<?=$id_tr?>')"><?=image_tag( "16x16/delete.gif" ,'size=18x18 border=0' )?></a>
                <input type="checkbox" name="files[]" id="files" value="<?=$folder."/".$file["file"]?>"/>
                
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
    
<script language="javascript" type="text/javascript">
    button=0;

        var uploadButton = new WidgetUploadButton({
            text: "Agregar Archivo",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("reportes/".$year."/".$reporte->getCaConsecutivo()."/instrucciones/")?>",
            filePrefix: "",
            confirm: true,
            callback:"actualizar"
        });
        uploadButton.render("button1");  


    function actualizar(file)
    {
        selec='<input type="checkbox" name="files[]" id="files" value="<?=$folder?>/'+file+'"/>';
//        alert(selec);
        $("#archivos").append("<tr><td ><b>"+(button++)+".</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Archivo "+file+" </b><div id='hbl_defs'><a href='<?=url_for("gestDocumental/verArchivo?idarchivo=")?>"+Base64.encode("<?=$folder?>/"+file)+"'>"+file+"</a>&nbsp;"+selec+"</div></td><td>&nbsp;</td></tr>");
    }

    function eliminar(file,idtr)
    {
        if(window.confirm("Realmente desea eliminar este archivo?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("gestDocumental/borrarArchivo") ?>',
                params :	{
                    idarchivo:file
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    $("#"+idtr).remove();
                    Ext.MessageBox.hide();
                }
            });
        }
    }

button=<?=$i?>;
</script>

