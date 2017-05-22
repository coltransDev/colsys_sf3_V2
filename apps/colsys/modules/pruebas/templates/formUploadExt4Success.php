<?
include_component("widgets", "wgDocumentos");
$back = $sf_data->getRaw("back");
?>
<script>
Ext.require([
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox'
]);
Ext.onReady(function(){
    
    

    var msg = function(title, msg) {
        Ext.Msg.show({
            title: title,
            msg: msg,
            minWidth: 200,
            modal: true,
            icon: Ext.Msg.INFO,
            buttons: Ext.Msg.OK
        });
    };

    Ext.create('Ext.form.Panel', {
        renderTo: 'fi-form',
        width: 500,
        frame: true,
        title: 'Archivos',
        bodyPadding: '10 10 0',

        defaults: {
            anchor: '100%',
            allowBlank: false,
            msgTarget: 'side',
            labelWidth: 50
        },
        items: [        
        {
            xtype: 'hidden',            
            id:'ref1',
            name:'ref1',
            value:'<?=$ref1?>'
        },
        {
            xtype: 'hidden',            
            id:'ref2',
            name:'ref2',
            value:'<?=$ref2?>'
        },
        {
            xtype: 'hidden',
            id:'ref3',
            name:'ref3',
            value:'<?=$ref3?>'
        },
        {
            xtype: 'textfield',
            fieldLabel: 'Name',
            id:'nombre',
            name:'nombre',
            allowBlank:true
            
        },{
            xtype: 'filefield',
            id: 'form-file',
            emptyText: 'Seleccione un archivo',
            fieldLabel: 'Archivo',
            name: 'archivo',
            buttonText: '',
            buttonConfig: {
                iconCls: 'upload-icon'
            }             
        },
        {
            xtype: 'wDocumentos',
            id:'documento',
            name:'documento',
            fieldLabel: 'Documento',
            fieldLabel: 'Documento',
            queryMode: 'local',
            displayField: 'name',
            valueField: 'id',
            idsserie:'<?=$idsserie?>'
        }
    ],

        buttons: [{
            text: 'Guardar',
            handler: function(){
                var form = this.up('form').getForm();
                if(form.isValid()){
                    form.submit({
                        url: '<?=url_for("pruebas/subirArchivo")?>',
                        waitMsg: 'Guardando',
                        success: function(fp, o) {
                            if(o.result.success)
                            {
                            msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                            location.href=location.href;
                            }
                            else
                            {
                                msg('Error',  o.result.error);
                            }
                        }
                    });
                }
            }
        },{
            text: 'Reset',
            handler: function() {
                this.up('form').getForm().reset();
            }
        }]
    });

});
</script>
<table width="100%" align="center">
    <td style="text-align: center">        
<div id="fi-form"></div><br>
<a href="/pruebas/backRefer">Volver</a>
</td>
</table>
<?
include_component("pruebas", "returnFiles",array("serie"=>$serie,"subserie"=>$subserie,"ref1"=>$ref1,"ref2"=>$ref2,"ref3"=>$ref3));
?>