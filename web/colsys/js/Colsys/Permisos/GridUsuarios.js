

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
Ext.define('Colsys.Permisos.GridUsuarios', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Permisos.GridUsuarios',
    listeners: {
        datachanged: function (eOpts) {

        },
        beforerender: function () {
            this.reconfigure(
                    Ext.create('Ext.data.Store', {
                        autoLoad: false,
                        fields: [
                            {name: "ca_rutina" + this.idusuario, type: 'string', mapping: 'ca_rutina'},
                            {name: "ca_nivel" + this.idusuario, type: 'string', mapping: 'ca_nivel'},
                            {name: "ca_valor" + this.idusuario, type: 'string', mapping: 'ca_valor'},
                            {name: "ca_idrutina_niveles" + this.idusuario, type: 'string', mapping: 'ca_idrutina_niveles'},
                            {name: "ca_descripcion" + this.idusuario, type: 'string', mapping: 'ca_descripcion'},
                            {name: "ca_seleccionado" + this.idusuario, type: 'boolean', mapping: 'ca_seleccionado'},
                            {name: "ca_permisos_usuario" + this.idusuario, type: 'boolean', mapping: 'ca_permisos_usuario'},
                            {name: "ca_denegar_usuario" + this.idusuario, type: 'boolean', mapping: 'ca_denegar_usuario'},
                            {name: "fecha" + this.idusuario}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/users/datosGridUsuarios',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            filterParam: 'query'
                        }

                    }),
                    [{
                            header: 'ca_rutina',
                            width: 25,
                            dataIndex: 'ca_rutina' + this.idusuario,
                            hidden: true
                        }, {
                            header: 'Nivel',
                            width: 60,
                            dataIndex: 'ca_nivel' + this.idusuario

                        }, {
                            header: 'Valor',
                            width: 100,
                            dataIndex: 'ca_valor' + this.idusuario
                        }, {
                            header: 'rutinaniveles',
                            width: 80,
                            dataIndex: 'ca_idrutina_niveles' + this.idusuario,
                            hidden: true
                        }, {
                            header: 'Descripci&oacute;n',
                            width: 280,
                            flex: 1,
                            dataIndex: 'ca_descripcion' + this.idusuario,
                            hidden: true
                        }, {
                            text: 'Heredados',
                            dataIndex: 'ca_seleccionado' + this.idusuario,
                            width: 120,
                            xtype: 'checkcolumn',
                            processEvent: function () {
                                return false;
                            }
                        }, {
                            text: 'Permisos',
                            dataIndex: 'ca_permisos_usuario' + this.idusuario,
                            width: 120,
                            xtype: 'checkcolumn'
                        },
                        {
                            text: 'Denegar',
                            dataIndex: 'ca_denegar_usuario' + this.idusuario,
                            width: 120,
                            xtype: 'checkcolumn'
                        }
                    ]
                    );
            tb = new Ext.toolbar.Toolbar();
            tb.add({xtype: 'toolbar',
                dock: 'top',
                height: 44,
                items: [{
                        xtype: 'combo-rutinas',
                        id: 'usuario' + this.idusuario,
                        hidden: false,
                        width: 400,
                        enableKeyEvents: true,
                        listeners: {
                            beforerender: function (me, eOpts) {
                                this.id = 'usuario' + this.up('grid').idusuario;
                            },
                            keyup: function (combo, e, eOpts) {
                                if (combo.value != null) {
                                    if (combo.value.toString().length > 3) {

                                        this.getStore().load({
                                            params: {
                                                nombre: combo.value
                                            }
                                        });
                                    }
                                }
                            },
                            select: function (combo, records, eOpts) {
                                var idusuario = this.up('grid').idusuario;
                                var datos = this.getStore().findRecord('ca_rutina', combo.value);
                                var rutina = datos.get('ca_rutina');
                                Ext.getCmp("gridusuario" + idusuario).getStore().load({
                                    params: {
                                        idrutina: rutina,
                                        idusuario: idusuario.replace(/_/g, "-")
                                    }
                                });
                            }
                        }

                    }, {
                        xtype: 'button',
                        text: 'Guardar',
                        height: 30,
                        iconCls: 'disk',
                        handler: function () {
                            var store = this.up('grid').getStore();
                            var idusuario = this.up('grid').idusuario;
                            var idrutina = Ext.getCmp('usuario' + idusuario).value;
                            var records = store.getRange(0, store.getCount() - 1);

                            var r = Ext.create(store.getModel());
                            fields = new Array();
                            for (i = 0; i < r.fields.length; i++)
                            {
                                fields.push(r.fields[i].name.replace(idusuario, ""));
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
                                    eval("row." + fields[j] + "=records[i].data." + fields[j] + idusuario + ";")

                                }
                                row.id = r.id
                                changes[i] = row;
                            }

                            var strGrid = JSON.stringify(changes);
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '/users/guardarUsuarios',
                                params: {
                                    idusuario: idusuario.replace(/_/g, "-"),
                                    idrutina: idrutina,
                                    datosGrid: strGrid
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
                    }]
            });
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
    ]
});