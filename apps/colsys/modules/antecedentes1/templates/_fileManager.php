<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



include_component("gestDocumental", "widgetUploadButton");
$i=1;
?>

<script language="javascript" type="text/javascript">
button=0;
 Ext.onReady(function(){
     <?
     if($format!="coloader")
     {
     ?>
        /*var uploadButton = new WidgetUploadButton({
            text: "Agregar Archivo",
            iconCls: 'arrow_up',
            folder: "<?=base64_encode("Referencias/".ArchivosTable::getReferenciaAntigua($ref->getCaReferencia()))?>",
            filePrefix: "",
            confirm: true,
            callback:"actualizar"
        });
        uploadButton.render("button1");  */
     <?
     }
     ?>
});
    function actualizar(file)
    {
        $("#archivos").append("<tr><td ><b>"+(button++)+".</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Archivo "+file+" </b><div id='hbl_defs'><a href='<?=url_for("gestDocumental/verArchivo?idarchivo=")?>"+Base64.encode("<?=$folder?>/"+file)+"'>"+file+"</a></div></td><td>&nbsp;</td></tr>");
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
</script>

<?
if(count($filenames)>0)
{
?>
<table class="tableList alignLeft" width="100%" id="archivos">
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
                <? if($edit)
                {
                ?>
                &nbsp;&nbsp;
                <a href="#" onclick="eliminar('<?=base64_encode($folder."/".$file["file"])?>','<?=$id_tr?>')"><?=image_tag( "16x16/delete.gif" ,'size=18x18 border=0' )?></a>
                <?
                }
                else if($format=="coloader")
                {
                ?>
                <input type="checkbox" name="files[]" id="files" value="<?=$folder."/".$file["file"]?>"/>
                <?
                }
                ?>
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
<?
}
?>
<script>
button=<?=$i?>;
</script>

