/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

Ext.define('Colsys.General.GridTrm', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.General.GridTrm',
    store: Ext.create('Ext.data.Store', {
        autoLoad: true,
        fields: [
            {name: 'fecha', mapping: 'ca_fecha'},
            {name: 'pesos', mapping: 'ca_pesos'},
            {name: 'euro', mapping: 'ca_euro'}
        ],
        proxy: {
            type: 'ajax',
            url: '/inoparametros/datosTrms',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    }),    
    columns: [
        {
            header: 'Fecha',
            dataIndex: 'fecha',
            width: 130,
            renderer: function (a, b, c, d) {
                if (a) {
                    var formattedDate = new Date(a);
                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                    var d = formattedDate.getDate();
                    if (d < 10) {
                        d = "0" + d;
                    }
                    var m = formattedDate.getMonth();
                    m += 1;  // JavaScript months are 0-11
                    if (m < 10) {
                        m = "0" + m;
                    }
                    var y = formattedDate.getFullYear();
                    return y + "-" + m + "-" + d;
                }
            },
            editor: new Ext.form.DateField({
                width: 130,
                format: 'Y-m-d',
                useStrict: undefined
            })
        },
        {
            header: 'Trm',
            dataIndex: 'pesos',
            width: 120,
            align: 'right',
            //renderer: 'usMoney',
            editor: {
                xtype: 'numberfield',
                allowBlank: false,
                minValue: 0,
                maxValue: 5000
            }
        },
        {
            header: 'Euro',
            dataIndex: 'euro',
            width: 135,
            align: 'right',
            //renderer: 'usMoney',
            editor: {
                xtype: 'numberfield',
                allowBlank: false,
                minValue: 0,
                decimalPrecision: 4,
                maxValue: 5000
            }
        }
    ],
    selModel: {
        selType: 'cellmodel'
    },
    width: 400,
    height: 400,
    //frame: true,    
    listeners: {
        render: function (ct, position) {
            var me = this;
            tb = new Ext.toolbar.Toolbar();            
            tb.add({
                xtype: 'exporterbutton',
                text: 'Exportar CSV',
                iconCls: 'csv',
                format: 'excel'
            });
        
            if (this.permiso >= 0) {
                tb.add({
                    text: 'Agregar',
                    iconCls: 'add',
                    handler: function () {
                        var store = me.getStore();
                        var r = Ext.create(store.model, {
                            fecha: '',
                            pesos: '',
                            euro: ''
                        });
                        store.insert(0, r);
                    }
                }, {
                    text: 'Guardar',
                    iconCls: 'add',
                    handler: function () {
                        var store = me.getStore();
                        var records = store.getModifiedRecords();
                        var lenght = records.length;

                        changes = [];
                        for (var i = 0; i < lenght; i++) {
                            r = records[i];

                            if (r.data.fecha != "" && r.getChanges())
                            {
                                records[i].data.id = r.id,
                                        changes[i] = records[i].data;
                            }
                        }

                        var str = JSON.stringify(changes);
                        if (str.length > 5)
                        {
                            Ext.Ajax.request({
                                url: '/inoparametros/guardarGridTrms',
                                params: {
                                    datos: str
                                },
                                success: function (response, opts) {
                                    me.getStore().reload();
                                }
                            });
                        }
                        //alert(changes.toSource());
                    }
                });                
            }
            this.addDocked(tb);
            
            this.superclass.onRender.call(this, ct, position);
        }
    },
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1, id: 'celledit'})
    ]
});

