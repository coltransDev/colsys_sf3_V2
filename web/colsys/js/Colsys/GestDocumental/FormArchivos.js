
/**
* @autor Felipe Nariño 
* @return Formulario para subir nuevos archivos
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               idimpoexpo: impoexpo
  
* @date:  2016-04-07
*/


Ext.define('Colsys.GestDocumental.FormArchivos', {
        extend: 'Ext.form.Panel',
        alias: 'widget.wFormArchivo',
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
                xtype: 'Colsys.Widgets.WgDocumentos',
                id:'_documento',
                name:'documento',
                fieldLabel: 'Documento',                
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                linkSerie:'idsserie',
                allowBlank:false,
                width: 400,
                idimpoexpo: this.idimpoexpo,
                idtransporte: this.idtransporte
                
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
                hidden: 'true',
                name:'ref3'
            },
            {
                xtype: 'hidden',      
                id:'idtransp',
                value:this.idtransporte,
                name:'idtransp'
            },
            {
                xtype: 'hidden',      
                id:'idimpo',
                value:this.idimpoexpo,
                name:'idimpo'
            }
            ],

            bbar: [{
                    text: 'Guardar',
                    handler: function(){
                        var idtransporte = this.up('form').idtransporte ;
                        var idimpoexpo = this.up('form').idimpoexpo;
                        var idmaster = this.up('form').idmaster;
                        var form = this.up('form').getForm();

                        if(form.isValid()){
                            form.submit({
                                url: '/gestDocumental/editarArchivo',
                                waitMsg: 'Guardando',
                                success: function(fp, o) {
                                    
                                    Ext.getCmp("winFormEdit").hide();
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