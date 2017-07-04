Ext.define('Colsys.Crm.FormMandatos', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormMandatos',
    defaults: {
        anchor: '100%',
        labelWidth: 80,
        defaultType: 'container',
        collapsible: false
    },
    layout: 'column',
    listeners: {
        beforerender: function (ct, position) {
            var me = this;
            me.add({
                columnWidth: .39,
                items: [{
                        xtype: 'hiddenfield',
                        name: 'idtipo'
                    }, {
                        id: 'idtipo',
                        xtype: 'treepanel',
                        width: 400,
                        height: 300,
                        rootVisible: false,
                        store: new Ext.data.TreeStore({
                            proxy: {
                                type: 'ajax',
                                url: '/clientes/treeMandatosTipos'
                            },
                            root: {
                                text: 'Tipo Documento',
                                id: 'src',
                                expanded: true
                            },
                            folderSort: true,
                            sorters: [{
                                    property: 'text',
                                    direction: 'ASC'
                                }]
                        })
                    }]
            }, {
                columnWidth: .59,
                items: [{
                        xtype: 'fieldset',
                        title: 'Datos del Documento',
                        items: [
                            {
                                fieldLabel: 'Ciudad',
                                xtype: 'Colsys.Widgets.WgCiudades2',
                                id: 'idciudad',
                                name: 'idciudad',
                                clientes: true,
                                columnWidth: 0.5,
                                renderer: comboBoxRenderer(this),
                                allowBlank: false
                            }, {
                                xtype: 'fieldcontainer',
                                fieldLabel: 'Vigencia',
                                combineErrors: true,
                                msgTarget: 'side',
                                layout: 'hbox',
                                defaults: {
                                    flex: 1,
                                    hideLabel: true
                                },
                                items: [
                                    {
                                        xtype: 'datefield',
                                        name: 'fchradicado',
                                        fieldLabel: 'Radicado',
                                        format: 'Y-m-d',
                                        allowBlank: false
                                    },
                                    {
                                        xtype: 'datefield',
                                        name: 'fchvencimiento',
                                        fieldLabel: 'Vence',
                                        format: 'Y-m-d',
                                        allowBlank: false
                                    }
                                ]
                            }
                        ]
                    }, {
                        xtype: 'fieldset',
                        title: 'Observaciones',
                        height: 202,
                        items: [{
                                xtype: 'textarea',
                                hideLabel: true,
                                maxLength: 255,
                                style: 'margin:0',
                                name: 'observaciones',
                                anchor: '-5 -5'  // anchor width and height
                            }]

                    }]
            });
            tb = new Ext.toolbar.Toolbar({
                dock: 'bottom'
            });
            tb.add({
                text: 'Cargar Tipos de Documentos',
                id: 'botonCargarMandatos',
                iconCls: 'refresh',
                handler: function () {
                    var tree = Ext.getCmp('idtipo');
                    tree.getStore().reload();
                }
            },
                    {
                        text: 'Guardar',
                        iconCls: 'disk',
                        id: 'botonGuardarMandatos',
                        handler: function () {
                            var form = this.up('form').getForm();
                            var data = form.getFieldValues();
                            var tree = Ext.getCmp('idtipo');
                            var idtipo = data.idtipo;
                            if (!tree.isDisabled()) {
                                if (tree.getSelectionModel().hasSelection()) {
                                    var selectedNode = tree.getSelectionModel().getSelection();
                                    if (selectedNode[0].childNodes.length != 0) {
                                        Ext.MessageBox.alert("Error", 'Debe tipo de Documento no es valido!');
                                        return;
                                    }
                                } else {
                                    Ext.MessageBox.alert("Error", 'Debe seleccionar un tipo de Documento');
                                    return;
                                }
                                idtipo = selectedNode[0].data.children.idtipo;
                            }
                            if (data.fchradicado >= data.fchvencimiento) {
                                Ext.MessageBox.alert("Error", 'Error en la fechas de vigencia del Documento');
                                return;
                            }

                            if (form.isValid()) {
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '/clientes/guardarMandatosyPoderes',
                                    params: {
                                        id: me.idcliente,
                                        idtipo: idtipo,
                                        idciudad: data.idciudad,
                                        fchradicado: data.fchradicado,
                                        fchvencimiento: data.fchvencimiento,
                                        observaciones: data.observaciones
                                    },
                                    failure: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.err)
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.err);
                                        else
                                            Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                    },
                                    callback: function (response, options) {
                                        //me.findParentByType('window').close();
                                        Ext.getCmp("formMandatos").destroy();
                                        Ext.getCmp("winMandatos").destroy();
                                        Ext.getCmp("GridControlMandatos" + me.idcliente).getStore().reload();
//                            store.reload();
                                    }
                                });
                            }
                        }
                    }/*,
                     {
                     text: 'Cancelar',
                     handler: function () {
                     //this.findParentByType('window').destroy();
                     Ext.getCmp("formMandatos").destroy();
                     Ext.getCmp("winMandatos").destroy();
                     }
                     }*/);
            me.addDocked(tb);

        },
        afterrender: function (ct, position) {
            var me = this;
            //Habilitar el arbol en creacion u desabilitarlo en modificacion
            if (!me.treeAvailable){
                Ext.getCmp('idtipo').setDisabled(true);
                Ext.getCmp('botonCargarMandatos').setVisible(false);
            }else{
                Ext.getCmp('idtipo').setDisabled(false);
                Ext.getCmp('botonCargarMandatos').setVisible(true);
            }

            if (me.idcliente && me.idtipo && me.idciudad) {
                form = me.getForm();
                form.load({
                    url: '/clientes/datosUnMandatoyPoder',
                    params: {
                        idcliente: me.idcliente,
                        idtipo: me.idtipo,
                        idciudad: me.idciudad
                    }
                });
            }
        }
    }
});