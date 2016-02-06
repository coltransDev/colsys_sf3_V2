<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$razonSocial = $sf_data->getRaw("razonSocial");
include_component("widgets", "wgDocumentos");
include_component("widgets4", "wgAgentesAduana");
include_component("clientes", "formSubirArchivoAgente");
?>
<script type="text/javascript">
    var win_encuesta = null;
    var win_arc = null;
    var id_ag = 0;

    var comboBoxRenderer = function (combo) {
        return function (value) {
            var idx = combo.store.find(combo.valueField, value);
            var rec = combo.store.getAt(idx);
            return (rec === null ? value : rec.get(combo.displayField));
        };
    }

    Ext.onReady(function () {
        Ext.define('MandatosTipo', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idtipo', type: 'string'},
                {name: 'tipo', type: 'string'},
                {name: 'clase', type: 'string'},
            ]
        });

        Ext.define('AgaduanaAutorizado', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idcliente', type: 'string'},
                {name: 'id_agente', type: 'string'},
                {name: 'nombre_agente', type: 'string'},
                {name: 'fecha_vigencia', type: 'date'},
                {name: 'fecha_autorizacion', type: 'date'},
                {name: 'iddocumento', type: 'string'}
            ]
        });

        var storeAgaduanaAutorizado = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'AgaduanaAutorizado',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('clientes/datosAgaduanaAutorizado') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    idcliente: '<?= $idcliente ?>'
                },
                filterParam: 'query',
            }
        });

        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1,
            listeners: {
                'validateedit': function (editor, e) {
                    if (e.field == "nombre_agente") {
                        if (e.column.getEditor().displayTplData[0]) {
                            var id_agente = e.column.getEditor().displayTplData[0].id;
                            e.record.data["id_agente"] = id_agente;
                        }
                    }
                }
            }
        });

        new Ext.grid.GridPanel({
            id: 'gridAgaduanaAutorizado',
            title: 'Agentes de Aduana Autorizados<br /><?=$razonSocial?>',
            store: storeAgaduanaAutorizado,
            renderTo: 'se-form',
            stripeRows: true,
            height: 400,
            width: 950,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [{
                    header: 'Nombre Agente',
                    dataIndex: 'nombre_agente',
                    flex: 1,
                    width: 200,
                    editor: {
                        xtype: 'wAgentesAduana',
                    },
                }, {
                    header: 'Fecha Autorización',
                    width: 140,
                    dataIndex: 'fecha_autorizacion',
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    editor: new Ext.form.DateField({
                        width: 90,
                        allowBlank: false,
                        format: 'Y-m-d',
                        useStrict: undefined
                    })
                }, {
                    header: 'Fin de Vigencia',
                    width: 120,
                    dataIndex: 'fecha_vigencia',
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    editor: new Ext.form.DateField({
                        width: 90,
                        allowBlank: false,
                        format: 'Y-m-d',
                        useStrict: undefined
                    })
                }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 40,
                    items: [{
                            getClass: function (v, meta, rec) {
                                if (rec.get('idcliente')) {
                                    return 'import';
                                } else {
                                    return 'buy-col';
                                }
                            },
                            getTip: function (v, meta, rec) {
                                if (rec.get('idcliente')) {
                                    return 'Registro Creado';
                                } else {
                                    return 'Nuevo registro';
                                }
                            },
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                id_ag = rec.data.id_agente;
                                if (win_arc == null) {
                                    win_arc = new Ext.Window({
                                        id: 'winArchivos',
                                        title: 'Subir Archivos',
                                        width: 900,
                                        height: 500,
                                        closeAction: 'close',
                                        items: {
                                            autoScroll: true,
                                            defaultType: 'container',
                                            items: [{
                                                    padding: '5 5 10 5',
                                                    items: {
                                                        xtype: 'wTreeGridFile',
                                                        id: 'tree-grid-file',
                                                        name: 'tree-grid-file',
                                                        title: 'Listado de Archivos',
                                                        height: 250,
                                                    }
                                                }, {
                                                    padding: '5 5 10 5',
                                                    items: {
                                                        xtype: 'formSubirArchivos',
                                                        title: 'Nuevo Archivo',
                                                        id: 'subirArchivo',
                                                        width: 380,
                                                        height: 180,
                                                    }
                                                }]
                                        },
                                        listeners: {
                                            'beforeshow': function (win, e) {
                                                archivo = Ext.getCmp("subirArchivo");
                                                storeArchivo = archivo.store;
                                                storeArchivo.id_agente = id_ag;
                                                storeArchivo.idcliente = '<?= $idcliente ?>';

                                                tree = Ext.getCmp("tree-grid-file");
                                                store = tree.getStore();
                                                store.load({
                                                    params: {
                                                        idsserie: 11,   /*Constante para Autorizaciones Clientes*/
                                                        ref1: <?= $idcliente ?>,
                                                        ref2: id_ag
                                                    }
                                                });
                                            }
                                        }
                                    })
                                }
                                win_arc.show();
                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Anular la Encuesta',
                            id: 'btnAnular',
                            disabled: false,
                            getClass: function (v, meta, rec) {
                                if (rec.get('idcliente')) {
                                    return 'delete';
                                } else {
                                    return 'buy-col';
                                }
                            },
                            getTip: function (v, meta, rec) {
                                if (rec.get('idcliente')) {
                                    return 'Registro Creado';
                                } else {
                                    return 'Nuevo registro';
                                }
                            },
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (rec.get('idcliente')) {
                                    Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular el agente?', function (choice) {
                                        if (choice == 'yes') {
                                            Ext.Ajax.request({
                                                waitMsg: 'Eliminado...',
                                                url: '<?= url_for("clientes/anularAgaduanaAutorizado") ?>',
                                                params: {
                                                    idcliente: '<?= $idcliente ?>',
                                                    id_agente: rec.data.id_agente
                                                },
                                                failure: function (response, options) {
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                    success = false;
                                                },
                                                success: function (response, options) {
                                                    var res = Ext.JSON.decode(response.responseText);
                                                    if (res.success) {
                                                        store = storeAgaduanaAutorizado;
                                                        store.reload();
                                                    } else {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.responseInfo);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }
                            }
                        }]
                }
            ],
            plugins: [cellEditing],
            renderTo: Ext.get('se-form'),
                    // inline buttons
                    dockedItems: [{
                            xtype: 'toolbar',
                            items: [{
                                    text: 'Adicionar',
                                    tooltip: 'Adicionar un registro',
                                    iconCls: 'add',
                                    scope: this,
                                    handler: function () {
                                        var store = Ext.getCmp("gridAgaduanaAutorizado").getStore();
                                        var r = Ext.create(store.model);
                                        console.log(r);
                                        store.insert(0, r);
                                    }
                                }, {
                                    text: 'Guardar',
                                    tooltip: '',
                                    iconCls: 'add',
                                    scope: this,
                                    handler: function () {
                                        var store = Ext.getCmp("gridAgaduanaAutorizado").getStore();
                                        var records = store.getModifiedRecords();
                                        var lenght = records.length;
                                        changes = [];
                                        for (var i = 0; i < lenght; i++) {
                                            r = records[i];
                                            if (r.getChanges()) {
                                                records[i].data.id = r.id;
                                                changes[i] = records[i].data;
                                            }
                                        }
                                        var str = JSON.stringify(changes);
                                        if (str.length > 5) {
                                            Ext.Ajax.request({
                                                url: '<?= url_for("clientes/guardarAgaduanaAutorizado") ?>',
                                                params: {
                                                    datos: str,
                                                    idcliente:<?= $idcliente ?>
                                                },
                                                success: function (response, opts) {
                                                    var res = Ext.decode(response.responseText);
                                                    if (res.id && res.success) {
                                                        var idclientes = res.idclientes;
                                                        id = res.id;
                                                        for (i = 0; i < id.length; i++) {
                                                            var rec = store.getById(id[i]);
                                                            rec.set('idcliente', idclientes[i]);
                                                            rec.commit();
                                                        }
                                                        Ext.MessageBox.alert("Mensaje", 'Se guardó Correctamente la información');
                                                    } else {
                                                        Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                                    }
                                                },
                                                failure: function (response, opts) {
                                                    Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                    box.hide();
                                                }
                                            });
                                        }


                                    }
                                }]
                        }],
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeAgaduanaAutorizado,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });
    });
</script>