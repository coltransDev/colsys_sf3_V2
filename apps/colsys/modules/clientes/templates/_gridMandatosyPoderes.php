<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$ciudades = $sf_data->getRaw("ciudades");
include_component("clientes", "gridTiposMandatos");
include_component("clientes", "formSubirArchivos");
?>
<script type="text/javascript">
    var win_man = null;
    var win_doc = null;
    var win_arc = null;

    Ext.onReady(function () {

        Ext.define('Mandatos', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idcliente', type: 'string'},
                {name: 'idciudad', type: 'string'},
                {name: 'ciudad', type: 'string'},
                {name: 'idtipo', type: 'string'},
                {name: 'tipo', type: 'string'},
                {name: 'clase', type: 'string'},
                {name: 'fchradicado', type: 'string'},
                {name: 'fchvencimiento', type: 'string'},
                {name: 'detalle', type: 'string'},
                {name: 'idarchivo', type: 'string'},
                {name: 'nombre', type: 'string'},
                {name: 'observaciones', type: 'string'},
            ]
        });

        Ext.define('ComboCiudades', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-ciudades',
            queryMode: 'local',
            valueField: 'idciudad',
            displayField: 'ciudad',
            store: {
                fields: [{name: 'idciudad', type: 'string'}, {name: 'ciudad', type: 'string'}],
                data: <?= json_encode($ciudades) ?>
            }
        });

        var storeMandatos = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'Mandatos',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('clientes/datosMandatosyPoderes') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    id: <?= $id ?>
                },
                // Parameter name to send filtering information in
                filterParam: 'query',
            }
        });

        var formMandatos = Ext.create('Ext.form.Panel', {
            autoHeight: true,
            defaults: {
                anchor: '100%',
                labelWidth: 80,
                defaultType: 'container',
                collapsible: false,
            },
            layout: 'column',
            items: [{
                    columnWidth: .40,
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
                                    url: '<?= url_for('clientes/treeMandatosTipos') ?>',
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
                    columnWidth: .60,
                    items: [{
                            xtype: 'fieldset',
                            title: 'Datos del Documento',
                            items: [{
                                    xtype: 'combo-ciudades',
                                    name: 'idciudad',
                                    fieldLabel: 'Ciudad',
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
                }],
            buttons: [{
                    text: 'Cargar Tipos de Documentos',
                    handler: function () {
                        var tree = Ext.getCmp('idtipo');
                        tree.getStore().reload();
                    }
                }, {
                    text: 'Guardar',
                    handler: function () {
                        var me = this;
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
                                url: '<?= url_for('clientes/guardarMandatosyPoderes') ?>',
                                params: {
                                    id: <?= $id ?>,
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
                                success: function (response, options) {
                                    me.findParentByType('window').close();
                                    store = storeMandatos;
                                    store.reload();
                                }
                            });
                        }
                    }
                },
                {
                    text: 'Cancelar',
                    handler: function () {
                        this.findParentByType('window').close();
                    }
                }
            ],
            treeAvailable: function (option) {
                Ext.getCmp('idtipo').setDisabled(!option);
            }
        });

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridMandatos',
            title: 'Control de Mandatos y Poderes<br/><?= $nombre_cliente ?>',
            store: storeMandatos,
            renderTo: 'se-form',
            stripeRows: true,
            height: 400,
            width: 950,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [
                {
                    header: 'Ciudad',
                    dataIndex: 'ciudad',
                    width: 85
                }, {
                    header: 'Clase',
                    width: 130,
                    dataIndex: 'clase'
                }, {
                    header: 'Documento',
                    width: 250,
                    dataIndex: 'tipo'
                }, {
                    header: 'Radicado',
                    width: 90,
                    dataIndex: 'fchradicado'
                }, {
                    header: 'Vence Fch.',
                    width: 90,
                    dataIndex: 'fchvencimiento'
                }, {
                    header: 'Observaciones',
                    flex: 1,
                    dataIndex: 'observaciones'
                }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 40,
                    items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Editar el Registro',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_man == null) {
                                    win_man = new Ext.Window({
                                        id: 'winMandatos',
                                        title: 'Definición Mandato o Poder',
                                        width: 800,
                                        height: 380,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formMandatos
                                        }
                                    })
                                }
                                win_man.down('form').loadRecord(rec);
                                win_man.down('form').treeAvailable(false);
                                win_man.show();
                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Eliminar el Registro',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("clientes/eliminarMandatosyPoderes") ?>',
                                            params: {
                                                id: <?= $id ?>,
                                                idtipo: rec.data.idtipo,
                                                idciudad: rec.data.idciudad
                                            },
                                            failure: function (response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function (response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (res.success) {
                                                    store = storeMandatos;
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
            ],
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
                                        if (win_man == null) {
                                            win_man = new Ext.Window({
                                                id: 'winMandatos',
                                                title: 'Definición Mandato o Poder',
                                                width: 800,
                                                height: 380,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: formMandatos
                                                }
                                            })
                                        }
                                        rec = Ext.create('Mandatos', {});
                                        win_man.down('form').treeAvailable(true);
                                        win_man.down('form').loadRecord(rec);
                                        win_man.show();
                                    }
                                }, {
                                    text: 'Documentos Tipos',
                                    tooltip: 'Tabla de Documentos Tipo',
                                    iconCls: 'import',
                                    scope: this,
                                    handler: function () {
                                        if (win_doc == null) {
                                            win_doc = new Ext.Window({
                                                id: 'winTiposMandatos',
                                                title: 'Definición Tipos de Mandato o Poder',
                                                width: 600,
                                                height: 425,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: gridTiposMandatos
                                                }
                                            })
                                        }
                                        win_doc.show();
                                    }
                                }, {
                                    text: 'Archivo Digital',
                                    tooltip: 'Mandatos y Poderes',
                                    iconCls: 'note-add',
                                    scope: this,
                                    handler: function () {
                                        if (win_arc == null) {
                                            win_arc = new Ext.Window({
                                                id: 'winArchivos',
                                                title: 'Subir Archivos',
                                                width: 900,
                                                height: 500,
                                                closeAction: 'close',
                                                items: {
                                                    // layout: 'column',
                                                    autoScroll: true,
                                                    defaultType: 'container',
                                                    items: [{
                                                            // columnWidth: 4 / 6,
                                                            padding: '5 5 10 5',
                                                            items: {
                                                                xtype: 'wTreeGridFile',
                                                                id: 'tree-grid-file',
                                                                name: 'tree-grid-file',
                                                                title: 'Listado de Archivos',
                                                                height: 270,
                                                            }
                                                        }, {
                                                            // columnWidth: 2 / 6,
                                                            padding: '5 5 10 5',
                                                            items: {
                                                                xtype: 'formSubirArchivos',
                                                                title: 'Nuevo Archivo',
                                                                width: 380,
                                                                height: 160,
                                                            }
                                                        }]
                                                },
                                                listeners: {
                                                    'beforeShow': function (win, e) {
                                                        tree = Ext.getCmp("tree-grid-file");
                                                        store = tree.getStore();
                                                        store.load({
                                                            params: {
                                                                ref1: '<?= $id ?>',
                                                                idsserie: '<?= $idsserie ?>'
                                                            }
                                                        });
                                                    }
                                                }
                                            })
                                        }
                                        win_arc.show();
                                    }
                                }, {
                                    text: 'Regresar',
                                    tooltip: 'Regresar al Cliente',
                                    iconCls: 'refresh',
                                    scope: this,
                                    handler: function () {
                                        document.location.href = "/colsys_php/clientes.php?modalidad=N.i.t.&criterio=<?= $id ?>";
                                    }
                                }]
                        }],
            // paging bar on the bottom
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeMandatos,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });

    });
</script>
