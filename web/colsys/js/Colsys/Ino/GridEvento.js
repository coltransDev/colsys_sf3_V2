/**
 * @autor Felipe Nariño
 Administración de eventos
 para referencias en INO
 
 @comment Muestra una Grilla con los eventos para cada referencia
 permitiendo al usuario asignar la fecha, si fue realizado o no
 y documentos para los casos SAE y DEX.
 */

var win_sae = null;
var win_dex = null;
var constrainedWin2 = null;
Ext.Loader.setConfig({
    enabled: true
});
Ext.define('ComboSiNo', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.combo-si-no',
    store: ['SI', 'NO']
});

Ext.define('evento', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'idevento', type: 'string'},
        {name: 'evento', type: 'string'},
        {name: 'fchevento'},
        {name: 'seleccionado'},
        {name: 'opcion', type: 'string'},
        {name: 'tiposespecial', type: 'string'},
        {name: 'documentos', type: 'string'}
    ]
});

store = Ext.create('Ext.data.Store', {
    id: 'storeEventos',
    autoLoad: false,
    model: 'evento',
    proxy: {
        type: 'ajax',
        url: '/inoF2/datosEventos',
        reader: {
            type: 'json',
            root: 'root'
        },
        filterParam: 'query'
    }
});

Ext.define('Colsys.Ino.GridEvento', {
    extend: 'Ext.grid.Panel',
    id: 'gridEventos' + this.idreferencia,
    alias: 'widget.Colsys.Ino.GridEvento',
    store: store,
    plugins: [
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],

    columns: [{
            xtype: "checkcolumn",
            dataIndex: 'seleccionado',
            width: 40,
            listeners: {
                checkchange: function (grid, rowIndex, colIndex) {

                    var record = store.getAt(rowIndex);
                    if (record.get('seleccionado')) {
                        var formattedDate = new Date();
                        var d = formattedDate.getDate();
                        if (d < 10) {
                            d = "0" + d;
                        }
                        var m = formattedDate.getMonth();
                        m += 1;
                        if (m < 10) {
                            m = "0" + m;
                        }
                        var y = formattedDate.getFullYear();
                        var fch = y + "-" + m + "-" + d;
                        record.set('fchevento', fch);
                    } else {
                        record.set('fchevento', '');
                    }
                }
            }
        }, {
            header: "idevento",
            dataIndex: 'idevento',
            sortable: true,
            hidden: true
        }, {
            header: 'Realizado',
            dataIndex: 'opcion',
            sortable: true,
            width: 80,
            editor: {
                xtype: 'combo-si-no',
                allowBlank: 'true',
                forceSelection: 'false'
            }
        }, {
            header: "Evento",
            dataIndex: 'evento',
            sortable: true,
            width: 300
        }, {
            header: "Fecha",
            dataIndex: 'fchevento',
            sortable: true,
            width: 90,
            renderer: function (a, b, c, d) {
                if (a) {
                    var formattedDate = new Date(a);
                    var formattedDate = new Date(formattedDate.valueOf() + formattedDate.getTimezoneOffset() * 60000);
                    var d = formattedDate.getDate();
                    if (d < 10) {
                        d = "0" + d;
                    }
                    var m = formattedDate.getMonth();
                    m += 1;
                    if (m < 10) {
                        m = "0" + m;
                    }
                    var y = formattedDate.getFullYear();
                    return y + "-" + m + "-" + d;
                }
            },
            editor: {
                xtype: 'datefield'
            }
        }, {
            header: "tipoespecial",
            dataIndex: 'tipoespecial',
            hidden: true
        }, {
            menuDisabled: true,
            sortable: false,
            xtype: 'actioncolumn',
            width: 40,
            items: [{
                    getClass: function (v, meta, rec) {
                        if (rec.get('tipoespecial')) {
                            return 'import';
                        }
                    },
                    handler: function (grid, rowIndex, colIndex) {
                        var rec = grid.getStore().getAt(rowIndex);
                        rec.set('seleccionado', true);
                        var ref = this.up('grid').idreferencia;

                        win_dex = new Ext.Window({
                            title: 'Documentos',
                            width: 535,
                            height: 450,
                            tipoespecial: rec.get('tipoespecial'),
                            idevento: rec.get('idevento'),
                            closeAction: 'destroy',
                            items: {
                                autoScroll: true,
                                items: [
                                    {
                                        xtype: 'Colsys.Ino.GridDocEventos',
                                        id: 'grid-doc-eventos' + ref,
                                        name: 'grid-doc-eventos',
                                        idreferencia: ref
                                    }
                                ]
                            },
                            listeners: {
                                beforeshow: function (eOpts) {
                                    Ext.getCmp('grid-doc-eventos' + ref).cargar(rec.get('idevento'), this.tipoespecial);
                                },
                                close: function (win, eOpts) {
                                    win_dex = null;
                                }
                            }
                        })
                        win_dex.show();
                    }
                }]
        }, {
            header: "Documentos",
            dataIndex: 'documentos',
            width: 550
        }],
    selModel: {
        selType: 'cellmodel'
    },
    width: 600,
    //height: 300,
    frame: true,

    listeners: {
        activate: function (ct, position) {
            this.getStore().load({
                params: {
                    caso_uso: this.caso_uso,
                    referencia: this.idreferencia
                }
            });
        },
        beforeitemcontextmenu: function (view, record, item, index, e) {
            e.stopEvent();
            var record = this.store.getAt(index);
        },
        
        beforerender: function () {
            
            if (this.permisos.Crear == true || this.permisos.Editar == true){
            tb = new Ext.toolbar.Toolbar();
                tb.add({
                        id: 'bntGuardar',
                        text: 'Guardar',
                        iconCls: 'add',
                        handler: function () {

                            var ref = this.up('grid').idreferencia;
                            var datosincompletos = false;
                            x = 0;
                            changes = [];
                            var storG = this.up('grid').getStore();
                            for (var i = 0; i < storG.getCount(); i++) {
                                var record = storG.getAt(i);


                                if (Ext.Object.getSize(record.getChanges()) != 0) {
                                    record.data.id = record.id
                                    changes[x] = record.data;
                                    x++;

                                    if (record.get('fchevento') == "") {
                                        datosincompletos = true;
                                    }
                                }
                            }
                            var strGrid = JSON.stringify(changes);
                            if (!datosincompletos) {
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '/inoF2/guardarEventos',
                                    params: {
                                        datosGrid: strGrid,
                                        referencia: ref
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
                                        Ext.MessageBox.alert("Mensaje", ' Eventos almacenados correctamente<br>');
                                        storG.reload();
                                    }
                                });
                            } else {
                                Ext.MessageBox.alert("Mensaje", 'La Fecha es un Campo Obligatorio<br>');
                            }
                        }
                    }
            );
     this.addDocked(tb);
        }
        }
        
    }

});