<?php

$archivos = $sf_data->getRaw("archivos");
$eliminar=($sf_data->getRaw("eliminar")!="")?$sf_data->getRaw("eliminar"):"0";

if($view!="email" && $view!="email1")
{
?>
<script src="/js/pdf.js/compatibility.js"></script>
<script src="/js/pdf.js/pdf.js"></script>
<script src="/js/ext4/ux/panel/PDF.js"></script>
<?
}
if ($archivos){
?>
<table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
    <tr>
        <th style="text-align: center;">No</th>
        <?
        if($view!="email")
        {
        ?>
        <th style="text-align: center;">Previo</th>
        <?
        }
        ?>
        <th style="text-align: center;">Documento</th>
        <th style="text-align: center;">Tipo</th>
        <th style="text-align: center;">Fecha<br>Creado</th>
        <th style="text-align: center;">Usuario<br>Creado</th>
        <th style="text-align: center;">Tamaño</th>
        <th style="text-align: center;">Elegir</th>
        <th style="text-align: center;">Eliminar</th>
    </tr>
    <?
    $i=1;
    foreach($archivos as $a)
    {
?>
    <tr>
        <td><?=$i++?></td>
        <?
        if($view!="email")
        {
        ?>
        <td style="text-align: center;"><?
            if($a["ca_mime"]=='"application/pdf"' ||  $a["ca_mime"]=='application/pdf')
            {
        ?><a href="javascript:aa('<?="/gestDocumental/verArchivo?id_archivo=".$a["ca_idarchivo"]?>')">ver</a>
        <?
            }
            else if($a["ca_mime"]=='image/png' || $a["ca_mime"]=='image/gif' || $a["ca_mime"]=='image/jpg' || $a["ca_mime"]=='image/jpeg')
            {
         ?>
        <img src="<?="/gestDocumental/verArchivo?id_archivo=".$a["ca_idarchivo"]?>" width="50" height="50">
        <?
            }
        ?>
        </td>
        <?
        }
        ?>
        <td><?= link_to($a["ca_nombre"], "gestDocumental/verArchivo?id_archivo=".$a["ca_idarchivo"])?></td>
        <td><?=$a ["TipoDocumental"]["ca_documento"]?></td>
        <td><?=$a["ca_fchcreado"]?></td>
        <td><?=$a["ca_usucreado"]?></td>
        <td><?=$a["ca_size"]?>b</td>
        <td style="text-align: center;">
            <?
            if($format=="coloader" || $format == "confirmaciones" ){
            ?>
            <input type="checkbox" name="<?=($nameInput!="")?$nameInput:"files[]"?>" id="files" value="<?=  str_replace("/srv/www/digitalFile/", "", $a["ca_path"])?>"/>
            <?
            }
            ?>
        </td>
        <td style="text-align: center;" >
            <?
            if($format!="coloader" )
            {
            ?>
            <a href="javascript:eliminar('<?=$a["ca_idarchivo"]?>')"><?=image_tag( "16x16/delete.gif" ,'size=18x18 border=0' )?></a>
            <?
            }
            ?>
        </td>
    </tr>
<?
    }
    ?>
</table>
<?
}
if($format!="confirmaciones" && $view!="email1")
{
?>
<script>
     var win=null;
        Ext.onReady(function(){
            Ext.tip.QuickTipManager.init();
            Ext.create('Ext.window.Window', {
                title: 'Archivo',
                height: 560,
                width: 600,
                closeAction :'hide',
                id:"wpdf",
                name:"wpdf",
                layout: 'fit',
                items: 
                        Ext.create('Ext.ux.panel.PDF', {
                            title    : 'PDF Panel',
                            id:"pdfView",
                            name:"pdfView",
                            width    : 550,
                            height   : 633,
                            pageScale: 0.75
                        })
             });
        });
        
        function aa(src)
        {
            Ext.getCmp("pdfView").setSrc(src);            
            Ext.getCmp("wpdf").show();            
        }
    </script>
<?
}
?>
<script>
function eliminar(id)
{
    if( <?=$eliminar?>=="1")
    if(window.confirm("Esta Seguro de Eliminar el archivo"))
    {
       Ext.Ajax.request({
           url: '/gestDocumental/eliminarArchivo',
           method: 'POST',                
           waitTitle: 'Connecting',
           waitMsg: 'Eliminando Archivo...',                                     
           params: {
               "idarchivo" : id
           },
           scope:this,
           success: function(a,b){                    
               location.href=location.href;
           },                                    
           failure: function(){console.log('failure');}
       });
    }else
    {
        Ext.MessageBox.show({
            title: 'Eliminacion de Archivo ',
            msg: 'Por favor ingrese el motivo de la eliminacion:',
            width:300,
            buttons: Ext.MessageBox.OKCANCEL,
            multiline: true,
            fn: function (btn, text){

                if( btn == "ok"){
                    if( <?=$eliminar?>!="1" && $.trim(text)==""){
                        alert("Debe colocar un motivo");
                    }else{
                        if(btn=="ok")
                        {
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
                                    //Ext.getCmp("tree-grid-file").getStore().reload();
                                    //alert(a.toSource())
                                    //alert(b.toSource())
                                    //location.href=location.href;
                                    //Ext.MessageBox.hide();
                                    location.href=location.href;
                                },                                    
                                failure: function(){console.log('failure');}
                            });
                        }
                    }
                }


            }                   
        })
    }
}
    </script>
