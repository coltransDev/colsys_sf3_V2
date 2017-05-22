



Ext.define('Colsys.Permisos.GridMetodos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Permisos.GridMetodos',
    listeners: {
        datachanged: function (eOpts) {

        },
        beforerender: function () {

            this.reconfigure(
                    
                    
                    Ext.create('Ext.data.Store', {
                        autoLoad: true,
                        fields: [
                            {name: "ca_rutina" + this.idrutina, type: 'string', mapping: 'ca_rutina'},
                            {name: "ca_nivel" + this.idrutina, type: 'string', mapping: 'ca_nivel'},
                            {name: "ca_valor" + this.idrutina, type: 'string', mapping: 'ca_valor'},
                            {name: "ca_idrutina_niveles" + this.idrutina, type: 'string', mapping: 'ca_idrutina_niveles'},
                            {name: "ca_descripcion" + this.idrutina, type: 'string', mapping: 'ca_descripcion'},
                            {name: "seleccionado" + this.idrutina, type: 'boolean', mapping: 'seleccionado'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/users/datosMetodos',
                            reader: {
                                type: 'json',
                                root: 'root'
                            }//,
//                            filterParam: 'query'
                        }

                    }),
                    [{
                            header: 'ca_rutina',
                            width: 25,
                            dataIndex: 'ca_rutina' + this.idrutina,
                            hidden: true
                        }, {
                            header: 'Nivel',
                            width: 60,
                            dataIndex: 'ca_nivel' + this.idrutina

                        }, {
                            header: 'Valor',
                            width: 100,
                            dataIndex: 'ca_valor' + this.idrutina,
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: true
                            }
                        }, {
                            header: 'rutinaniveles',
                            width: 80,
                            dataIndex: 'ca_idrutina_niveles' + this.idrutina,
                            hidden: true
                        }, {
                            header: 'Descripci&oacute;n',
                            width: 280,
                            flex: 1,
                            dataIndex: 'ca_descripcion' + this.idrutina,
                            editor: {
                                xtype: 'textfield',
                                originalValue: '',
                                allowBlank: false
                            }
                        }
                    ]

                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'toolbar',
                dock: 'top',
                width: 690,
                height: 44,
                items: [{
                        xtype: 'button',
                        iconCls: 'add',
                        id: 'adicionmetodos' + this.idrutina,
                        handler: function () {
                            var store = this.up("grid").getStore();
                            if (store.getCount() > 0) {
                                var r = Ext.create(store.model);
                                r.set('ca_nivel' + this.up('grid').idrutina, store.getCount());
                                store.insert(0, r);
                            }
                        }

                    }, {
                        xtype: 'button',
                        text: 'Crear M&eacute;todos Predefinidos',
                        handler: function () {


                            var store = Ext.getCmp("grid" + this.up('grid').idrutina).getStore();

                            
                            if (store.getCount() == 0)
                            {
                                var r = Ext.create(store.model);
                                r.set('ca_valor' + this.up('grid').idrutina, 'Anular');
                                r.set('ca_nivel' + this.up('grid').idrutina, '3');
                                console.log(r);
                                store.insert(0, r);
                                var r = Ext.create(store.model);
                                r.set('ca_valor' + this.up('grid').idrutina, 'Editar');
                                r.set('ca_nivel' + this.up('grid').idrutina, '2');
                                store.insert(0, r);
                                var r = Ext.create(store.model);
                                r.set('ca_valor' + this.up('grid').idrutina, 'Crear');
                                r.set('ca_nivel' + this.up('grid').idrutina, '1');
                                store.insert(0, r);
                                var r = Ext.create(store.model);
                                r.set('ca_valor' + this.up('grid').idrutina, 'Consultar');
                                r.set('ca_nivel' + this.up('grid').idrutina, '0');
                                store.insert(0, r);
                                store.sort('ca_nivel');

                            }
                        }
                    }]
            });
            this.addDocked(tb);

            aumento = 1;
            var rutina = this.idrutina;
            this.getStore().load({
                params: {
                    rutina: rutina
                }
            });

        }

    },
    height: 350,
    width: 720,
    //dockedItems: [{],
    selType: 'cellmodel',
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        })
    ],
    guardar: function () {

        var me = this;
        var store = me.getStore();
        var idrutina = me.idrutina;
        falla = 0;
        x = 0;
        changes = [];

        var records = store.getRange(0, store.getCount() - 1);
        var r = Ext.create(store.getModel());
        fields = new Array();
        for (i = 0; i < r.fields.length; i++)
        {
            fields.push(r.fields[i].name.replace(idrutina, ""));
        }

        changes = [];
        changes1 = [];

        for (var i = 0; i < records.length; i++) {
            r = records[i];
            records[i].data.id = r.id
            changes1[i] = records[i].data;
            row = new Object();
            for (j = 0; j < fields.length; j++)
            {
                eval("row." + fields[j] + "=records[i].data." + fields[j] + idrutina + ";")

            }
            if (row.ca_nivel == "" || row.ca_valor == "") {
                falla = 1;
            }
            row.id = r.id
            changes[i] = row;
        }
        
        


        var strGrid = JSON.stringify(changes);
        if (falla == 0) {

            Ext.Ajax.request({
                waitMsg: 'Guardando cambios...',
                url: '/users/guardarMetodos',
                params: {
                    rutina: this.idrutina,
                    datosGrid: strGrid
                },
                failure: function (response, options) {
                    var res = Ext.util.JSON.decode(response.responseText);
                    if (res.errorInfo)
                        Ext.MessageBox.alert("Mensaje", 'Debe diligenciar completamente el formulario');
                },
                success: function (response, options) {
                    var res = Ext.decode(response.responseText);
                    ids = res.ids;
                    if (res.success) {
                        Ext.MessageBox.alert("Mensaje", 'Datos Almacenados Correctamente<br>');
                        store.reload();
                    } else {
                        Ext.MessageBox.alert("Mensaje", '...Datos Incompletos<br>');
                    }
                }
            });
        } else {
            Ext.MessageBox.alert("Mensaje", 'Datos Incompletos<br>');
        }
    }
});