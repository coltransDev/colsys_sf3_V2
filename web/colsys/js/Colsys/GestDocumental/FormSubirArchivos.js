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
        labelWidth: 70
    },
    listeners: {
        beforerender: function () {
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
            }, {
                xtype: 'Colsys.Widgets.WgDocumentos',
                id: 'documento',
                name: 'documento',
                fieldLabel: 'Documento',
                queryMode: 'local',
                displayField: 'name',
                valueField: 'id',
                idimpoexpo: this.idimpoexpo,
                idtransporte: this.idtransporte
            }, {
                xtype: 'textfield',
                fieldLabel: 'Subcarpeta',
                id: 'ref2',
                name: 'ref2',
                allowBlank: true
            });
        }
    },
    buttons: [{
            text: 'Guardar',
            handler: function () {
                var idreferencia = this.up('form').idreferencia;
                var idmaster = this.up('form').idmaster;
                var dcto = Ext.getCmp("documento").rawValue;
                var form = this.up('form').getForm();

                if (form.isValid()) {
                    form.submit({
                        waitMsg: 'Guardando',
                        url: '/gestDocumental/subirArchivoTRD',
                        params: {
                            ref1: idreferencia
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
