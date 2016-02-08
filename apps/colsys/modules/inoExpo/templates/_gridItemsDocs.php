<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">
    var win_item = null;
    var win_file = null;

    Ext.define('ItemsDocs', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'iddoctransporte', type: 'string'},
            {name: 'item_number', type: 'string'},
            {name: 'container_number', type: 'string'},
            {name: 'number_packages', type: 'string'},
            {name: 'kind_packages', type: 'string'},
            {name: 'gross_weight', type: 'string'},
            {name: 'gross_unit', type: 'string'},
            {name: 'net_weight', type: 'string'},
            {name: 'net_unit', type: 'string'},
            {name: 'measurement_weight', type: 'string'},
            {name: 'measurement_unit', type: 'string'},
            {name: 'seals', type: 'string'},
            {name: 'marks_numbers', type: 'string'},
            {name: 'description_goods', type: 'string'},
            {name: 'same_goods', type: 'string'}
        ]
    });

    Ext.define('ComboUnidadesPaquete', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-unidades-paquete',
        store: ['Cajas', 'Cartones', 'Estuches', 'Jaulas', 'Palets', 'Tamores', 'Barriles', 'Bidones', 'Rollos', 'Bobina', 'Laminas', ]
    });

    Ext.define('ComboUnidadesPeso', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-unidades-peso',
        store: ['TONS', 'LBR', 'KGS']
    });

    Ext.define('ComboUnidadesMedida', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-unidades-medida',
        store: ['M3']
    });

    var storeItemsDocs = Ext.create('Ext.data.Store', {
        autoLoad: false,
        model: 'ItemsDocs',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('inoExpo/datosItemsDocs') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            // Parameter name to send filtering information in
            filterParam: 'query',
        }
    });

    var formItemDocs = Ext.create('Ext.form.Panel', {
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
                xtype: 'hiddenfield',
                name: 'item_number'
            }, {
                xtype: 'fieldset',
                columnWidth: 0.5,
                title: 'Container Number',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'textfield',
                    name: 'container_number',
                    allowBlank: true,
                    maxLength: 17,
                    maxLengthText: 'Excede el tamaño permitido'
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.5,
                title: 'Seals',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'textareafield',
                    name: 'seals',
                    allowBlank: true,
                    height: 62,
                    maxLength: 128,
                    maxLengthText: 'Excede el tamaño permitido'
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.3,
                title: 'Marks and Numbers',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'textareafield',
                    name: 'marks_numbers',
                    allowBlank: false,
                    height: 115
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.70,
                title: 'Description of goods',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: [{
                    id: 'description_goods',
                    xtype: 'textareafield',
                    name: 'description_goods',
                    allowBlank: false,
                    height: 86
                },{
                    xtype: 'checkbox',
                    boxLabel: 'Usar la misma descripción del ítem anterior',
                    name: 'same_goods',
                    listeners:{
                        change: function (check, newValue, oldValue, eOpts){
                            Ext.getCmp('description_goods').setDisabled(newValue);
                            Ext.getCmp('number_packages').setDisabled(newValue);
                            Ext.getCmp('kind_packages').setDisabled(newValue);
                        }
                    }
                }]
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Net Weight',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'numberfield',
                    name: 'net_weight',
                    allowBlank: false,
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Net Unit',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'combo-unidades-peso',
                    name: 'net_unit',
                    forceSelection: true,
                    allowBlank: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Gross Weight',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'numberfield',
                    name: 'gross_weight',
                    allowBlank: false,
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Gross Unit',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'combo-unidades-peso',
                    name: 'gross_unit',
                    forceSelection: true,
                    allowBlank: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Number Packages',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    id: 'number_packages',
                    xtype: 'numberfield',
                    name: 'number_packages',
                    allowBlank: false,
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Kind Packages',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    id: 'kind_packages',
                    xtype: 'combo-unidades-paquete',
                    name: 'kind_packages',
                    forceSelection: true,
                    allowBlank: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Measurement Weight',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'numberfield',
                    name: 'measurement_weight',
                    allowBlank: true,
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                }
            }, {
                xtype: 'fieldset',
                columnWidth: 0.25,
                title: 'Measurement Unit',
                defaults: {anchor: '100%'},
                layout: 'anchor',
                items: {
                    xtype: 'combo-unidades-medida',
                    name: 'measurement_unit',
                    forceSelection: false,
                    allowBlank: true
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
                            url: '<?= url_for('inoExpo/guardarItemsDocs') ?>',
                            params: {
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
                                store = storeItemsDocs;
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

    Ext.define('gridItemsDocs', {
        extend: 'Ext.grid.Panel',
        xtype: 'gridItemsDocs',
        store: storeItemsDocs,
        height: 380,
        initComponent: function () {
            this.columns = [{
                    header: 'Container',
                    dataIndex: 'container_number',
                    width: 120
                }, {
                    header: 'Marks and Numbers',
                    dataIndex: 'marks_numbers',
                    width: 180
                }, {
                    header: 'No.Pks',
                    dataIndex: 'number_packages',
                    width: 80
                }, {
                    header: 'Tipo',
                    dataIndex: 'kind_packages',
                    width: 100
                }, {
                    header: 'Sellos',
                    dataIndex: 'seals',
                    flex: 1
                }, {
                    header: 'Seriales',
                    dataIndex: 'marks_numbers',
                    flex: 1
                }, {
                    header: 'Descripción',
                    dataIndex: 'description_goods',
                    flex: 1
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
                                if (win_item == null) {
                                    win_item = new Ext.Window({
                                        id: 'winItemDoc',
                                        title: 'Item del Documento',
                                        width: 600,
                                        height: 460,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formItemDocs
                                        }
                                    })
                                }
                                win_item.down('form').loadRecord(rec);
                                win_item.show();
                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Eliminar',
                            handler: function (grid, rowIndex, colIndex) {
                                var record = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        if (record.data.idtipo) {
                                            Ext.Ajax.request({
                                                waitMsg: 'Eliminado...',
                                                url: '<?= url_for("inoExpo/eliminarItemsDocs") ?>',
                                                params: {
                                                    idtipo: record.data.idtipo
                                                },
                                                success: function (response, options) {
                                                    var res = Ext.JSON.decode(response.responseText);
                                                    if (res.success) {
                                                        grid.getStore().reload();
                                                    } else {
                                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + res.errorInfo);
                                                    }
                                                },
                                                failure: function (response, options) {
                                                    Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                    success = false;
                                                }
                                            });
                                        } else {
                                            grid.getStore().removeAt(rowIndex);
                                        }
                                    }
                                });
                            }
                        }]
                }
            ];
            this.callParent(arguments);
        },
        setIddoctransporte: function (iddoctransporte) {
            storeItemsDocs.getProxy().extraParams = {
                id: iddoctransporte
            };
            storeItemsDocs.load();
        },
        dockedItems: [{
                xtype: 'toolbar',
                items: [{
                        text: 'Adicionar',
                        tooltip: 'Adicionar un registro',
                        iconCls: 'add',
                        scope: this,
                        handler: function () {
                            if (win_item == null) {
                                win_item = new Ext.Window({
                                    id: 'winItemDocs',
                                    title: 'Items del Documento',
                                    width: 600,
                                    height: 460,
                                    closeAction: 'close',
                                    items: {
                                        xtype: formItemDocs
                                    }
                                })
                            }
                            rec = Ext.create('ItemsDocs', {});
                            rec.data.iddoctransporte = storeItemsDocs.proxy.extraParams.id;
                            win_item.down('form').loadRecord(rec);
                            win_item.show();
                        }
                    }, {
                        text: 'Imprimir',
                        tooltip: 'Generar Documento de Transporte',
                        iconCls: 'page_white_acrobat',
                        handler: function () {
                            console.log();
                            var id = storeItemsDocs.proxy.extraParams.id;
                            if (win_file == null) {
                                win_file = new Ext.Window({
                                    title: 'Vista Preliminar del Documento',
                                    height: 600,
                                    width: 900,
                                    items: [{
                                            xtype: 'component',
                                            itemId: 'panel-document-preview',
                                            autoEl: {
                                                tag: 'iframe',
                                                width: '100%',
                                                height: '100%',
                                                frameborder: '0',
                                                scrolling: 'auto',
                                                src: '<?= url_for('inoExpo/imprimirDocsTransporte') ?>' + '/id/' + id + '/borrador/' + Ext.getCmp('borradorChk').value + '/plantilla/' + Ext.getCmp('plantillaChk').value
                                            }
                                        }],
                                    listeners: {
                                        close: function (panel, eOpts) {
                                            win_file = null;
                                        }
                                    }
                                })
                            }
                            win_file.show();
                        }
                    }, {
                        xtype: 'tbspacer'
                    }, {
                        xtype: 'fieldcontainer',
                        defaultType: 'checkboxfield',
                        layout: 'hbox',
                        items: [{
                                boxLabel: 'Con Plantilla&nbsp;&nbsp;',
                                name: 'plantilla',
                                checked: true,
                                id: 'plantillaChk'
                            }, {
                                boxLabel: 'Borrador&nbsp;&nbsp;',
                                name: 'borrador',
                                id: 'borradorChk'
                            }
                        ]
                    }]
            }],
        bbar: Ext.create('Ext.PagingToolbar', {
            store: storeItemsDocs,
            displayInfo: true,
            displayMsg: 'Registros {0} - {1} of {2}',
            emptyMsg: "No hay registros"
        })
    });

</script>