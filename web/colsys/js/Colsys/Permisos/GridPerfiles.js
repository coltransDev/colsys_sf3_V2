

Ext.define('ComboRutinas', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-rutinas',
    queryMode: 'local',
    valueField: 'ca_rutina',
    displayField: 'ca_opcion',
    store: Ext.create('Ext.data.Store', {
        autoLoad: false,
        fields: [
            {name: 'ca_rutina', type: 'string'},
            {name: 'ca_opcion', type: 'string'},
            {name: 'ca_descripcion', type: 'string'},
            {name: 'ca_programa', type: 'string'},
            {name: 'ca_grupo', type: 'string'},
            {name: 'ca_url', type: 'string'},
            {name: 'ca_icon', type: 'string'},
            {name: 'ca_aplicacion', type: 'string'}
        ],
        proxy: {
            type: 'ajax',
            url: '/users/datosRutina',
            reader: {
                type: 'json',
                root: 'root'
            },
            filterParam: 'query'
        }
    })
});
Ext.define('Colsys.Permisos.GridPerfiles', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Permisos.GridPerfiles',
    listeners: {
        datachanged: function (eOpts) {

        },
        beforerender: function () {
            this.reconfigure(
                    Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: "ca_rutina" + this.idperfil, type: 'string', mapping: 'ca_rutina'},
                            {name: "ca_nivel" + this.idperfil, type: 'string', mapping: 'ca_nivel'},
                            {name: "ca_valor" + this.idperfil, type: 'string', mapping: 'ca_valor'},
                            {name: "ca_idrutina_niveles" + this.idperfil, type: 'string', mapping: 'ca_idrutina_niveles'},
                            {name: "ca_descripcion" + this.idperfil, type: 'string', mapping: 'ca_descripcion'},
                            {name: "ca_seleccionado" + this.idperfil, type: 'boolean', mapping: 'ca_seleccionado'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/users/datosGridPerfiles',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            filterParam: 'query'
                        }

                    }),
                    [
                        {
                            header: 'ca_rutina',
                            width: 25,
                            dataIndex: 'ca_rutina' + this.idperfil,
                            hidden: true
                        }, {
                            header: 'Nivel',
                            width: 60,
                            dataIndex: 'ca_nivel' + this.idperfil

                        }, {
                            header: 'Valor',
                            width: 100,
                            dataIndex: 'ca_valor' + this.idperfil
                        }, {
                            header: 'rutinaniveles',
                            width: 80,
                            dataIndex: 'ca_idrutina_niveles' + this.idperfil,
                            hidden: true
                        }, {
                            header: 'Descripci&oacute;n',
                            width: 280,
                            flex: 1,
                            dataIndex: 'ca_descripcion' + this.idperfil
                        }, {
                            text: 'Permitido',
                            dataIndex: 'ca_seleccionado' + this.idperfil,
                            width: 120,
                            name: 'ca_seleccionado',
                            xtype: 'checkcolumn'
                        }
                    ]
                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({
                xtype: 'toolbar',
                dock: 'top',
                height: 44,
                items: [{
                        xtype: 'combo-rutinas',
                        id: 'rutina' + this.idperfil,
                        hidden: false,
                        width: 400,
                        enableKeyEvents: true,
                        listeners: {
                            beforerender: function (me, eOpts) {
                                this.id = 'rutina' + this.up('grid').idperfil;
                                this.up('grid').getStore().id = 'storerutina' + this.up('grid').idperfil;
                            },
                            keyup: function (combo, e, eOpts) {
                                if (combo.value.toString().length > 3 && combo.value != null) {

                                    this.getStore().load({
                                        params: {
                                            nombre: combo.value
                                        }
                                    });
                                }
                            },
                            select: function (combo, records, eOpts) {

                                var idperfil = this.up('grid').idperfil;
                                var datos = this.getStore().findRecord('ca_rutina', combo.value);
                                var rutina = datos.get('ca_rutina');
                                Ext.getCmp("gridperfil" + idperfil).getStore().load({
                                    params: {
                                        idrutina: rutina,
                                        idperfil: idperfil.replace(/_/g, "-"),
                                    }
                                });
                            }
                        }

                    }]
            },
                    {
                        xtype: 'button',
                        text: 'Guardar',
                        height: 30,
                        iconCls: 'disk',
                        handler: function () {
                            var store = this.up('grid').getStore();
                            var idperfil = this.up('grid').idperfil;
                            var idrutina = Ext.getCmp('rutina' + this.up('grid').idperfil).value;
                            var records = store.getRange(0, store.getCount() - 1);
                            var r = Ext.create(store.getModel());
                            fields = new Array();
                            for (i = 0; i < r.fields.length; i++)
                            {
                                fields.push(r.fields[i].name.replace(idperfil, ""));
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
                                    eval("row." + fields[j] + "=records[i].data." + fields[j] + idperfil + ";")

                                }
                                row.id = r.id
                                changes[i] = row;
                            }

                            var strGrid = JSON.stringify(changes);

                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '/users/guardarPerfiles',
                                params: {
                                    datosGrid: strGrid,
                                    idperfil: idperfil.replace(/_/g, "-"),
                                    idrutina: idrutina
                                },
                                failure: function (response, options) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (res.errorInfo)
                                        Ext.MessageBox.alert("Mensaje", 'Error');
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
                        }
                    }

            );
            this.addDocked(tb);
        }
    },
    height: 350,
    width: 720,
    selType: 'cellmodel',
    plugins: [
        Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1
        })
    ],
    guardar: function () {

        var me = this;
        var store = me.getStore();
        console.log(store);
        falla = 0;
        x = 0;
        changes = [];
        for (var i = 0; i < store.getCount(); i++) {
            var record = store.getAt(i);
            if (record.data.ca_nivel == "" || record.data.ca_valor == "") {
                falla = 1;
            }
            record.data.id = record.id
            changes[x] = record.data;
            x++;
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