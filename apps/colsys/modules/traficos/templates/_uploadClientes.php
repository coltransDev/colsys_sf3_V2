<style>
    .file-view .thumb img{
	height: 50px;
	width: 50px;
    }    

</style>
<script src="/js/extExtras/FileUploadMultipleField.js"></script>

<?
$dimension = 1855;
$dimVisual = 50;
$i = 0;
$j = 0;
if ($reporte) {
    $i++;
    $referencia = $reporte->getNumReferencia();
    
    // Archivos ubicados en el directorio antiguo
    $folderOld =  $reporte->getDirectorioBase();
    
    if($referencia){
        $archivos = $reporte->getFilesGestDoc();
        $narchivos=count($archivos);
    }
    
    $alto = ceil($narchivos / 4) * $dimVisual;
    
    ?>
    <tr>
        <td style="border-bottom: 0px;" id="fotos">
        </td>
    </tr>    

    <script>
    Ext.onReady(function () {       
        
        var store = new Ext.data.JsonStore({
            url: '<?=url_for('reportesNeg/datosImagenes?idreporte='.$reporte->getCaIdreporte())?>',
            root: 'images',            
            fields: ['name', 'url','id_base']
        });
        store.load();
        
        var tpl = new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="thumb-wrap" id="{name}">',
		    '<div class="thumb"><img src="{url}" title="{name}"></div>',
                '<span class="x-editable">{name}</span></div>',
            '</tpl>',
            '<div class="x-clear"></div>'
        );

        var panel = new Ext.FormPanel({
             id:'images-view',
            frame:true,
            width:535,
            autoHeight:true,
            collapsible:false,
            fileUpload: true,
            layout:'fit',
            title:'Adjuntar Fotos',            
            bodyStyle: 'padding: 10px 10px 0 10px;',
            labelWidth: 50,
            defaults: {
                anchor: '95%',                
                msgTarget: 'side'
                    },
            items: [
                {
                    xtype: 'hidden',
                    name: 'folder',
                    value: '<?= base64_encode($folderOld) ?>'
                },                
                new Ext.DataView({
                    store: store,
                    tpl: tpl,
                    id: 'dataview-fotos',
                    autoHeight:true,
                    multiSelect: true,
                    overClass:'x-view-over',
                    cls: 'file-view',
                    itemSelector:'div.thumb-wrap',
                    emptyText: 'No hay fotos para mostrar',
                    prepareData: function(data){
                        data.shortName = Ext.util.Format.ellipsis(data.name, 15);
                        data.sizeString = Ext.util.Format.fileSize(data.size);
                        //data.dateString = data.lastmod.format("m/d/Y g:i a");
                        return data;
                    },

                    listeners: {
                        selectionchange: {
                            fn: function(dv,nodes){                                
                                var l = nodes.length;
                                var s = l != 1 ? 's' : '';
                                panel.setTitle('Adjuntar Fotos ('+l+' foto'+s+' seleccionada'+s+')');
                                Ext.getCmp("button-delete").setDisabled(false);
                            }
                        }
                    }                    
                }),
                {
                    xtype: 'fileuploadmultiplefield',                    
                    multiple: true,
                    name: 'fotos[]',                    
                    width: 500,                    
                    emptyText: 'Seleccione las fotos que desee cargar',
                    buttonCfg: {
                        text: '',
                        iconCls: 'upload-icon'
                    },
                }               
            ],            
            buttons: [{
                text: 'Eliminar fotos',
                disabled: true,
                id: 'button-delete',
                iconCls: 'icon-picture_delete',
                handler: function() {
                    var sr = Ext.getCmp('dataview-fotos').getSelectedRecords();                    
                    
                    if(sr.length > 0){
                        if(window.confirm("Está seguro que desea eliminar los archivos?")){
                            Ext.MessageBox.wait('Eliminando archivos, Espere por favor', '');
                            /* Loop the array of records */
                                Ext.each(sr, function(r) {
                                    var file = r.data['id_base'];
                                    /* AJAX Request */
                                    Ext.Ajax.request({
                                        method: 'POST',
                                        url: '<?=url_for('gestDocumental/borrarArchivo')?>',
                                        params: {idarchivo: file},
                                        success: function() {
                                            Ext.Msg.alert("Eliminar","Archivos eliminados correctamente");
                                            Ext.getCmp('dataview-fotos').store.reload();                                        
                                        },
                                        failure: function () {
                                            Ext.MessageBox.alert('Error', 'Server error!');
                                        }
                });
                                }
                            );                        
                        }
                    }else{
                        Ext.Msg.alert("Error","Debe seleccionar al menos un archivo para eliminar");
                    }
                }
            },/*{
                text: 'Borrar selección',
                handler: function(){
                    panel.getForm().reset();
                }
            },*/{
                text: 'Guardar',
                handler: function(){
                    if(panel.getForm().isValid()){
                        panel.getForm().submit({
                            url: '<?=url_for('gestDocumental/uploadMultipleImages')?>',
                            waitMsg: 'Cargando fotos...',
                            success:function(form,action){                                                                   
                                var res = Ext.util.JSON.decode( action.response.responseText );
                                filenames = res.filenames;                                
                                var nameArchivos = "";
                                
                                Ext.each(filenames, function(filename){
                                    nameArchivos+=filename+"<br/>";                                    
                                });
                                
                                Ext.getCmp('dataview-fotos').store.reload();
                                Ext.Msg.alert("Fotos","Se han cargado las fotos correctamente<br/>"+nameArchivos);
                                panel.getForm().reset();
                            },
                            failure:function(form,action){
                                Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                            }
                        });
                    }
                }
            }]
        });
        panel.render("fotos");
    });
    
</script>
    <?
    if(count($archivos)>0){
        ?>
        <tr>
            <th class="titulo" ><b>Fotos asociadas a la referencia</b></th>
        </tr>	
        <tr height="<?= $alto + 20 ?>">
            <td colspan="6" style="vertical-align: top; border-bottom: 0px;" >
                <div id="thumbnails_<?= $i ?>">
                        <?
                        foreach ($archivos as $file) {
                            if(Utils::isImage($file->getCaNombre())){
                                $filename = $file->getCaNombre();
                                $folder = $reporte->getDirectorioBaseDocs($filename);                            
                                echo '<div style="width:' . $dimVisual . 'px;height:' . $dimVisual . 'px;float: left;margin: 5px;" id="file_' . $j . '">
                                    <div style="position:relative ">
                                        <div style="position:absolute;" >
                                            <img style=" vertical-align: middle;" src="/gestDocumental/verArchivo?idarchivo=' . base64_encode($folder) . '" width="' . $dimVisual . '" height="' . $dimVisual . '" />
                                        </div>                                    
                                        <div style="position:absolute;top:20px;right:0px;display:none" >
                                           <input type="checkbox" value="' . $folder . '" name="files_' . $reporte->getInoHouse()->getOid() . '[]" />
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
    }
}
?>
    
<script>
    function selTodasFotos(obj)
    {
        $('.imgS').attr("checked",!$('.imgS').attr("checked"));        
    }
</script>