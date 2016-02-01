<script>

Ext.define('Ext.colsys.formArchivo', {
        extend: 'Ext.form.Panel',
        alias: 'widget.wFormArchivo',
            title: 'Subir Archivos',    
            bodyPadding: 5,
            anchor: '100%',
            
            items: [
            {
                xtype: 'hidden',
                id:'_idsserie',
                name:'idsserie'
            },
            {
                xtype: 'hidden',
                id:'_idarchivo',
                name:'idarchivo'
            },
            {
                xtype: 'hidden',
                id:'_iddocumental',
                name:'iddocumental'
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Nombre',
                id:'_nombre',
                name:'nombre',
                allowBlank:true
            },
            {
                xtype: 'wDocumentos',
                id:'_documento',
                name:'documento',
                fieldLabel: 'Documento',                
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                linkSerie:'idsserie',
                allowBlank:false,
                width: 400
                
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Referencia 1',
                id:'_ref1',
                name:'ref1',                
                allowBlank:false
            },
            {
                xtype: 'textfield',
                fieldLabel: 'Referencia 2',
                id:'_ref2',
                name:'ref2'                
            },
            {
                xtype: 'textfield',      
                fieldLabel: 'Referencia 3',
                id:'_ref3',
                name:'ref3'
            }
            ],

            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        var form = this.up('form').getForm();
                        if(form.isValid()){
                            form.submit({
                                url: '/gestDocumental/editarArchivo',
                                waitMsg: 'Guardando',
                                success: function(fp, o) {
                                    //msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                    
                                    Ext.getCmp("winFormEdit").hide();
                                    //location.href=location.href;
                                }
                            });
                        }
                    }
                }],
            cargar: function(data)
            {
                this.getForm( ).setValues(
                {
                    "_idsserie":data.idserie,
                    "_idarchivo":data.idarchivo,
                    "_nombre":data.nombre,                        
                    "_documento":data.documento,
                    "_iddocumental":data.iddocumental,
                    "_ref1":data.ref1,
                    "_ref2":data.ref2,
                    "_ref3":data.ref3
                });

            }                
})
</script>