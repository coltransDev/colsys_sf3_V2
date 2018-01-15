comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};
Ext.define('Colsys.Ino.GridDeducciones', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Ino.GridDeducciones',
    plugins: [
        {
            ptype : 'cellediting',
            clicksToEdit: 1
        }
    ],
    width: 640,
    //id: 'gridrespuestas' + this.idmaster,
    listeners: {
        /*render: function (ct, position){
         Ext.getCmp("comboCosto"+this.idmaster).getStore().reload({
         params: {
         costo: 'true',
         transporte: this.idtransporte,
         impoexpo: this.idimpoexpo
         }
         });  
         },*/
        
       
        afterrender: function(ct, position){
            this.getStore().reload({
                params: {
                    idcomprobante: this.idcomprobante
                }
            });
        },
        render: function (ct, position) {


            // this.setHeight(this.up('tabpanel').up('tabpanel').getHeight() - 150);
            // this.setWidth(this.up('tabpanel').up('tabpanel').getWidth() - 50);
            this.reconfigure(
                    //     this.superclass.onRender.call(this, ct, position),
                    store = Ext.create('Ext.data.Store', {
                        fields: [
                            {name: 'iddeduccion', type: 'string', mapping: 'iddeduccion'},
                            {name: 'neto', type: 'string', mapping: 'neto'},
                            {name: 'valor', type: 'string', mapping: 'valor'},
                            {name: 'tcambio', type: 'string', mapping: 'tcambio'}        
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosDeducciones',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        }
                    }),
                    [
                        {
                            header: "Concepto",
                            dataIndex: 'iddeduccion',
                            width: 300,
                            editor: Ext.create('Colsys.Widgets.wgDeduccion', {
                                //displayField: 'concepto',
                                //valueField: 'idconcepto',
                                id: 'combodeduccion',
                                idmaster: this.idmaster,
                                idtransporte: this.idtransporte,
                                idimpoexpo: this.idimpoexpo
                            }),
                            renderer: comboBoxRenderer(Ext.getCmp('combodeduccion'))
                        },
                        {
                            header: "Valor",
                            dataIndex: 'neto',
                            width: 158,
                            editor: {
                                xtype: 'numberfield'
                                
                            }
                        },
                         {
                            header: "Observaciones",
                            dataIndex: 'observaciones',
                            width: 158,
                            editor: {
                                xtype: 'textfield'
                                
                            }
                        },
                        /*{
                            header: "Valor",
                            dataIndex: 'valor',
                            width: 158,
                            readOnly: true
                        },*/ {
                            menuDisabled: true,
                            sortable: false,
                            xtype: 'actioncolumn',
                            width: 20,
                            items: [{
                                    iconCls: 'delete',
                                    tooltip: 'Eliminar deduccion',
                                    handler: function (grid, rowIndex, colIndex) {
                                        me = this;
                                        var store = me.up('grid').getStore();
                                        idcomprobante = me.up('grid').idcomprobante;
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmación de Eliminación', 'Est&aacute; seguro que desea anular el registro?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/inoF2/eliminarDeduccion',
                                                    params: {
                                                        iddeduccion: rec.data.iddeduccion,
                                                        idcomprobante: idcomprobante

                                                    },
                                                    failure: function (response, options) {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error Eliminando el registro.<br>' + response.errorInfo);
                                                        success = false;
                                                    },
                                                    success: function (response, options) {
                                                        var res = Ext.JSON.decode(response.responseText);
                                                        if (res.success) {
                                                            store.reload();
                                                        } else {
                                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }]
                        }

                    ]);
            

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'button',
                text: 'Nueva Deduccion',
                height: 30,
                iconCls: 'add',
                handler: function () {
                    var store = this.up('grid').store;
                    var r = Ext.create(store.model);
                    r.set('idmaster' + this.up('grid').idmaster, this.up('grid').idmaster);
                    store.insert(0, r);
                }
            }, {
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {
                    var me = this;
                    idcomprobante = me.up('grid').idcomprobante;
                    var store = me.up('grid').getStore();
                    x = 0;
                    changes = [];
                    for (var i = 0; i < store.getCount(); i++) {
                        var record = store.getAt(i);
                        if (Ext.Object.getSize(record.getChanges()) != 0) {

                            record.data.id = record.id
                            changes[x] = record.data;
                            x++;
                        }
                    }
                    var gridDeducciones = JSON.stringify(changes);
                    Ext.Ajax.request({
                        waitMsg: 'Guardando cambios...',
                        url: '/inoF2/guardarDeducciones',
                        params: {
                            gridDeducciones: gridDeducciones,
                            idcomprobante: idcomprobante

                        },
                        failure: function (response, options) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (res.errorInfo)
                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                            else
                                Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                        },
                        success: function (response, options) {
                            var res = Ext.decode(response.responseText);
                            ids = res.ids;
                            if (res.ids) {
                                for (i = 0; i < ids.length; i++) {
                                    var rec = store.getById(ids[i]);
                                    rec.commit();
                                }
                                Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                            }
                        }
                    });
                }
            }

            );
            this.addDocked(tb);

            Ext.getCmp("combodeduccion").getStore().reload({
                params: {
                    idtransporte: this.idtransporte,
                    idimpoexpo: this.idimpoexpo,
                    idmaster: this.idmaster
                }
            });
            
            
        },
        edit: function (editor, e, eOpts){
            var store = this.getStore();
            if (e.field == 'neto'){
                store.data.items[e.rowIdx].set('valor', (store.data.items[e.rowIdx].get('neto') * store.data.items[e.rowIdx].get('tcambio')));
            }
        }
    }
});