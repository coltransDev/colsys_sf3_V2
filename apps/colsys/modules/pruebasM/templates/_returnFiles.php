<?php


$archivos = $sf_data->getRaw("archivos");




/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if($view!="email")
{
?>

<script src="/js/pdf.js/pdf.js"></script>
<script src="/js/ext4/ux/panel/PDF.js"></script>
<?
}
?>
<table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
    <tr>
        <th>No</th>
        <?
        if($view!="email")
        {
        ?>
        <th></th>
        <?
        }
        ?>
        <th>Documento</th>
        <th>Tipo</th>
        <th>Fecha<br>Creado</th>
        <th>Usuario<br>Creado</th>
        <th>Tamaño</th>
        <th>Opciones</th>
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
        <td><?
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
        <td style="text-align: center;"><a href="javascript:eliminar('<?=$a["ca_idarchivo"]?>')"><?=image_tag( "16x16/delete.gif" ,'size=18x18 border=0' )?></a></td>
    </tr>
<?
    }
    ?>
</table>
<?
//if($view!="email")
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
                            pageScale: 0.75//,
                            //src      : 'https://localhost/gestDocumental/verArchivo/id_archivo/19',

                        })
             });
        /*    Ext.create('Ext.ux.panel.PDF', {
                title    : 'PDF Panel',
                id:"pdfView",
                name:"pdfView",
                width    : 489,
                height   : 633,
                pageScale: 0.75,
                //src      : 'https://localhost/gestDocumental/verArchivo/id_archivo/19',
            
            });
            Ext.getCmp("pdfView").setSrc('https://localhost/gestDocumental/verArchivo/id_archivo/19');
            */
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
               
    if(window.confirm("Esta Seguro de Eliminar el archivo"))
    {
       Ext.Ajax.request({
           url: '/pruebas/eliminarArchivo',
           method: 'POST',                
           waitTitle: 'Connecting',
           waitMsg: 'Eliminando Archivo...',                                     
           params: {
               "idarchivo" : id
           },
           scope:this,
           success: function(a,b){                    
               //alert(a.toSource())
               //alert(b.toSource())
               location.href=location.href;
           },                                    
           failure: function(){console.log('failure');}
       });
    }
}
    </script>
