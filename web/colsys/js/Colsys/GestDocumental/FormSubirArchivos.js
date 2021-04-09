/**
 * @autor Felipe Nariño 
 * @return Formulario para subir nuevos archivos
 * @param sfRequest $request A request 
 *               idtransporte : tipo de transporte
 *               idimpoexpo: impoexpo
 
 * @date:  2016-04-07
 */

var msg = function (title, msg) {
    Ext.Msg.show({
        title: title,
        msg: msg,
        minWidth: 200,
        modal: true,
        icon: Ext.Msg.INFO,
        buttons: Ext.Msg.OK
    });
};


Ext.define('Colsys.GestDocumental.FormSubirArchivos', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.GestDocumental.FormSubirArchivos',
    defaults: {
        anchor: '100%',
        allowBlank: false,
        msgTarget: 'side',
        labelWidth: 75
    },
    listeners: {
        beforerender: function () {
            me=this;
            this.add({
                xtype: 'textfield',
                fieldLabel: 'Name',
                id: 'nombre',
                name: 'nombre',
                allowBlank: true
            }, {
                xtype: 'filefield',
                id: 'form-file',
                emptyText: 'Seleccione un archivo',
                fieldLabel: 'Archivo',
                name: 'archivo',
                buttonText: '',
                buttonConfig: {
                    style: 'position:relative',
                    iconCls: 'upload-icon'
                }
            },
             {
                xtype: 'Colsys.Widgets.WgDocumentos',
                id: 'documento',
                name: 'documento',
                fieldLabel: 'Documento',
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                idsserie: me.idsserie,
                idimpoexpo: me.idimpoexpo,
                idtransporte: me.idtransporte
            });
            
            //console.log(me.idtransporte);
            //console.log(me.idimpoexpo);
            //console.log(me.idmodalidad);
            if(me.idimpoexpo == "OTM-DTA")
            {
                if(me.idmodalidad=="LCL")
                {
                    this.add(
                        Ext.create('Ext.form.ComboBox', {
                        fieldLabel: 'Subcarpeta',
                        id:'ref2',
                        name:'ref2',
                        store: Ext.create('Ext.data.Store', {
                            fields: ['id', 'name'],
                            data : [
                                {"id":"DOCUMENTOS SOPORTE", "name":"DOCUMENTOS SOPORTE"},
                                {"id":"DOCUMENTOS MUISCA", "name":"DOCUMENTOS MUISCA"},
                                {"id":"LIBERACION", "name":"LIBERACION"},
                                {"id":"CARTA PORTE", "name":"CARTA PORTE"},
                                {"id":"AUTORIZACION", "name":"AUTORIZACION"},
                                {"id":"COSTOS", "name":"COSTOS"},
                                {"id":"CIERRE", "name":"CIERRE"}
                                
                            ]
                        }),
                        width:150,
                        //labelWidth:50,
                        queryMode: 'local',
                        displayField: 'name',
                        valueField: 'id'
                        })
                    );
                }
                else
                {
                    this.add({
                        xtype: 'textfield',
                        fieldLabel: 'Subcarpeta 2',
                        id: 'ref2',
                        name: 'ref2',
                        allowBlank: false,
                        value:me.ref2
                    });
                    
                    this.add(
                        Ext.create('Ext.form.ComboBox', {
                        fieldLabel: 'Subcarpeta',
                        id:'ref3',
                        name:'ref3',
                        store: Ext.create('Ext.data.Store', {
                            fields: ['id', 'name'],
                            data : [
                                {"id":"DOCUMENTOS SOPORTE", "name":"DOCUMENTOS SOPORTE"},
                                {"id":"DOCUMENTOS MUISCA", "name":"DOCUMENTOS MUISCA"},
                                {"id":"LIBERACION", "name":"LIBERACION"},
                                {"id":"CARTA PORTE", "name":"CARTA PORTE"},
                                {"id":"AUTORIZACION", "name":"AUTORIZACION"},
                                {"id":"COSTOS", "name":"COSTOS"},
                                {"id":"CIERRE", "name":"CIERRE"}
                                
                            ]
                        }),
                        width:150,
                        //labelWidth:50,
                        queryMode: 'local',
                        displayField: 'name',
                        valueField: 'id'
                        })
                    );
                    
                }
            }
            else
            {
                this.add({
                    xtype: 'textfield',
                    fieldLabel: 'Subcarpeta',
                    id: 'ref2',
                    name: 'ref2',
                    allowBlank: true,
                    value:me.ref2
                });
            }
        }
    },
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var idreferencia = this.up('form').idreferencia;
                var idmaster = this.up('form').idmaster;
                var dcto = Ext.getCmp("documento").rawValue;
                var form = this.up('form').getForm();
                console.log(idreferencia);
                
                if (form.isValid()) {
                    form.submit({
                        waitMsg: 'Guardando',
                        url: '/gestDocumental/subirArchivoTRD',
                        params: {
                            ref1: idreferencia,
                            tam_max: 800
                        },
                        success: function (fp, o) {
                            if (o.result.success) {
                                msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                Ext.getCmp("Documentos-" + idmaster).getStore().reload();
                            } else {
                                alert("error");
                            }
                        }
                    });
                }
            }
        }, {
            text: 'Reset',
            handler: function () {
                this.up('form').getForm().reset();
            }
        }]

});

Ext.define('formTreeArchivos', {
    extend: 'Ext.form.Panel',
    xtype: 'formTreeArchivos',
    frame: true,
    bodyPadding: '10 10 0',
    defaults: {
        anchor: '100%',
        msgTarget: 'side'
    },
    items: [{
            xtype: 'wTreeGridFile',
            id: 'tree-grid-file',
            height: 380,
            name: 'tree-grid-file'
        }
    ]
});
