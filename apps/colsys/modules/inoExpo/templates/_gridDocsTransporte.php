<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$referencia = $sf_data->getRaw("referencia");
include_component("inoExpo", "gridItemsDocs");
?>
<script type="text/javascript">
    var win_header = null;
    var win_items = null;

    Ext.onReady(function () {

        Ext.define('DocsTransporte', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'iddoctransporte', type: 'string'},
                {name: 'referencia', type: 'string'},
                {name: 'traorigen', type: 'string'},
                {name: 'ciuorigen', type: 'string'},
                {name: 'tradestino', type: 'string'},
                {name: 'ciudestino', type: 'string'},
                {name: 'consecutivo', type: 'string'},
                {name: 'fchdoctransporte', type: 'string'},
                {name: 'place_delivery', type: 'string'},
                {name: 'terminos_transporte', type: 'string'},
                {name: 'liberacion', type: 'string'},
                {name: 'ocean_vessel', type: 'string'},
                {name: 'declaration_interest', type: 'string'},
                {name: 'declared_value', type: 'string'},
                {name: 'freight_amount', type: 'string'},
                {name: 'freight_payable', type: 'string'},
                {name: 'number_original', type: 'string'},
                {name: 'delivery_goods', type: 'string'},
                {name: 'font_size', type: 'string'}
            ]
        });

        Ext.define('ModelCiudad', {
            extend: 'Ext.data.Model',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('inoExpo/datosPlaceDelivery') ?>',
                reader: {
                    type: 'json',
                    root: 'root',
                    totalProperty: 'total'
                }
            },
            fields: [
                {name: 'idciudad', type: 'string'},
                {name: 'ciudad', type: 'string'},
                {name: 'trafico', type: 'string'}
            ]
        });

        Ext.define('ComboCiudades', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-ciudades',
            store: {
                pageSize: 10,
                model: 'ModelCiudad'
            },
            displayField: 'ciudad',
            valueField: 'idciudad',
            typeAhead: false,
            hideLabel: true,
            hideTrigger: true,
            anchor: '100%',
            listConfig: {
                loadingText: 'Buscando...',
                emptyText: 'No hay resultados',
                // Custom rendering template for each item
                getInnerTpl: function () {
                    return '<strong>{trafico}</strong><br />{ciudad}';
                }
            }
        });

        Ext.define('Numeros', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'consecutivo', type: 'string'},
            ]
        });

        var storeNumeros = Ext.create('Ext.data.Store', {
            autoLoad: false,
            model: 'Numeros',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('inoExpo/consecutivosDisponibles') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        });

        Ext.define('ComboNumeros', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-numeros',
            store: storeNumeros,
            queryMode: 'local',
            displayField: 'consecutivo',
            forceSelection: true,
            typeAhead: true
        });

        Ext.define('ComboTerminos', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-terminos',
            store: ['FCL/FCL', 'FCL/LCL', 'LCL/LCL', 'LCL/FCL', 'BREAK BULK'],
            forceSelection: true
        });

        Ext.define('ComboLiberacion', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-liberacion',
            store: ['EXPRESS RELEASE', 'TELEX RELEASE', 'ORIGINA Y COPIA'],
            forceSelection: true
        });

        Ext.define('ComboPagadero', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-pagadero',
            store: ['ORIGEN', 'DESTINO'],
            forceSelection: true
        });

        var storeDocsTransporte = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'DocsTransporte',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('inoExpo/datosDocsTransporte') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    id: '<?= $referencia ?>'
                },
                // Parameter name to send filtering information in
                filterParam: 'query',
            }
        });

        var formDocsTransporte = Ext.create('Ext.form.Panel', {
            bodyPadding: 5,
            defaults: {
                anchor: '100%',
                labelWidth: 50,
                defaultType: 'container',
                collapsible: false,
            },
            layout: 'column', // arrange fieldsets side by side
            items: [{
                    xtype: 'hiddenfield',
                    name: 'iddoctransporte'
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Fch.Documento',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'datefield',
                        name: 'fchdoctransporte',
                        format: 'Y-m-d',
                        allowBlank: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Place Delivery',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'combo-ciudades',
                        name: 'place_delivery',
                        allowBlank: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Términos de Transporte',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'combo-terminos',
                        name: 'terminos_transporte',
                        allowBlank: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Liberación',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'combo-liberacion',
                        name: 'liberacion',
                        allowBlank: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.7,
                    title: 'Ocean Vessel',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textfield',
                        name: 'ocean_vessel',
                        allowBlank: false,
                        maxLength: 30,
                        maxLengthText: 'Excede el tamaño permitido'
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.3,
                    title: 'Tamaño de Letra',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'numberfield',
                        name: 'font_size',
                        maxValue: 14,
                        minValue: 7
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Declaration of interest of the consigner',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textareafield',
                        name: 'declaration_interest',
                        allowBlank: true,
                        maxLength: 128,
                        maxLengthText: 'Excede el tamaño permitido'
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Declared value for ad valorem rate',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textareafield',
                        name: 'declared_value',
                        allowBlank: true,
                        maxLength: 128,
                        maxLengthText: 'Excede el tamaño permitido'
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Freight Amount',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textfield',
                        name: 'freight_amount',
                        allowBlank: true,
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'Freight Payable at',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'combo-pagadero',
                        name: 'freight_payable'
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.2,
                    title: 'Doc.Number',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'combo-numeros',
                        name: 'consecutivo',
                        allowBlank: false
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.3,
                    title: 'Number of Original FBL\'s',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textfield',
                        name: 'number_original',
                        allowBlank: false,
                        maxLength: 12,
                        maxLengthText: 'Excede el tamaño permitido'
                    }
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.5,
                    title: 'For delivery of goods please apply to',
                    defaults: {anchor: '100%'},
                    layout: 'anchor',
                    items: {
                        xtype: 'textareafield',
                        name: 'delivery_goods',
                        allowBlank: true,
                        maxLength: 512,
                        maxLengthText: 'Excede el tamaño permitido'
                    }
                }
            ],
            buttons: [{
                    text: 'Guardar',
                    handler: function () {
                        var me = this;
                        var form = me.up('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('inoExpo/guardarDocsTransporte') ?>',
                                params: {
                                    id: '<?= $referencia ?>',
                                    datos: str
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
                                    store = storeDocsTransporte;
                                    store.reload();
                                }
                            });
                        }
                    }
                }, {
                    text: 'Cancelar',
                    handler: function () {
                        this.findParentByType('window').close();
                    }
                }
            ]
        });

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridDocsTransporte',
            title: 'Documentos de Transporte<br/><?= $referencia ?>',
            store: storeDocsTransporte,
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
                    header: 'Consecutivo',
                    dataIndex: 'consecutivo',
                    width: 95
                }, {
                    header: 'Fch.Documento',
                    width: 120,
                    dataIndex: 'fchdoctransporte'
                }, {
                    header: 'Término',
                    dataIndex: 'terminos_transporte',
                    flex: 1
                }, {
                    header: 'Trafico Origen',
                    width: 120,
                    dataIndex: 'traorigen'
                }, {
                    header: 'Ciudad Origen',
                    width: 120,
                    dataIndex: 'ciuorigen'
                }, {
                    header: 'Trafico Destino',
                    width: 120,
                    dataIndex: 'tradestino'
                }, {
                    header: 'Ciudad Destino',
                    width: 120,
                    dataIndex: 'ciudestino'
                }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 60,
                    items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Editar el Registro',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_header == null) {
                                    win_header = new Ext.Window({
                                        id: 'winDocsTransporte',
                                        title: 'Cabecera del Documento',
                                        width: 600,
                                        //height: 400,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formDocsTransporte
                                        }
                                    })
                                }
                                storeNumeros.proxy.extraParams.consecutivo = rec.get('consecutivo');
                                storeNumeros.reload();
                                win_header.down('form').loadRecord(rec);
                                win_header.show();
                            }
                        }, {
                            iconCls: 'event-add',
                            tooltip: 'Items Documento de Transporte',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_items == null) {
                                    win_items = new Ext.Window({
                                        id: 'winItemsDoc',
                                        title: 'Items de Documento de Transporte',
                                        width: 1100,
                                        height: 430,
                                        closeAction: 'close',
                                        items: {
                                            iddoctransporte: rec.data.iddoctransporte,
                                            xtype: gridItemsDocs
                                        }
                                    })
                                }
                                win_items.down('grid').setIddoctransporte(rec.data.iddoctransporte);
                                win_items.show();
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
                                            url: '<?= url_for("clientes/eliminarDocsTransporte") ?>',
                                            params: {
                                                id: '<?= $referencia ?>',
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
                                                    store = storeDocsTransporte;
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
                                        if (win_header == null) {
                                            win_header = new Ext.Window({
                                                id: 'winDocsTransporte',
                                                title: 'Cabecera del Documento',
                                                width: 600,
                                                height: 590,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: formDocsTransporte
                                                }
                                            })
                                        }
                                        rec = Ext.create('DocsTransporte', {});
                                        win_header.down('form').loadRecord(rec);
                                        win_header.show();
                                    }
                                }, {
                                    text: 'Regresar',
                                    tooltip: 'Regresar al Menú de Búsqueda',
                                    iconCls: 'refresh',
                                    scope: this,
                                    handler: function () {
                                        document.location.href = "/inoExpo/gestionDocsTransporte";
                                    }
                                }]
                        }],
            // paging bar on the bottom
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeDocsTransporte,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });

    });
</script>