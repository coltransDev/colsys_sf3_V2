<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$clases = $sf_data->getRaw("clases");
?>
<script type="text/javascript">

    Ext.define('MandatosTipo', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'idtipo', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'clase', type: 'string'},
        ]
    });

    Ext.define('ComboClases', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-clases',
        queryMode: 'local',
        valueField: 'clase',
        displayField: 'clase',
        forceSelection: true,
        store: {
            fields: [{name: 'clase', type: 'string'}],
            data: <?= json_encode($clases) ?>
        }
    });

    var storeMandatosTipo = Ext.create('Ext.data.Store', {
        autoLoad: true,
        model: 'MandatosTipo',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosMandatosTipo') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            // Parameter name to send filtering information in
            filterParam: 'query',
        }
    });

    var rowEditing = Ext.create('Ext.grid.plugin.CellEditing', {
        clicksToEdit: 1
    });

    Ext.define('gridTiposMandatos', {
        extend: 'Ext.grid.Panel',
        xtype: 'gridTiposMandatos',
        store: storeMandatosTipo,
        plugins: [rowEditing],
        height: 380,
        initComponent: function () {
            this.columns = [{
                    header: 'Tipo',
                    dataIndex: 'tipo',
                    flex: 1,
                    editor: {
                        xtype: 'textfield',
                        allowBlank: false
                    }
                }, {
                    header: 'Clase',
                    dataIndex: 'clase',
                    width: 150,
                    editor: {
                        xtype: 'combo-clases',
                        allowBlank: false
                    }
                }, {
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 25,
                    items: [{
                            iconCls: 'delete',
                            tooltip: 'Eliminar',
                            handler: function (grid, rowIndex, colIndex) {
                                var record = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea borrar el registro?', function (choice) {
                                    if (choice == 'yes') {
                                        if (record.data.idtipo){
                                            Ext.Ajax.request({
                                                waitMsg: 'Eliminado...',
                                                url: '<?= url_for("clientes/eliminarMandatosTipo") ?>',
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
                                        }else{
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
        dockedItems: [{
                xtype: 'toolbar',
                items: [{
                        text: 'Adicionar',
                        tooltip: 'Adicionar un registro',
                        iconCls: 'add',
                        scope: this,
                        handler: function () {
                            var record = Ext.create('MandatosTipo', {});
                            storeMandatosTipo.insert(0, record);
                            rowEditing.startEdit(record, 0);
                        }
                    }, {
                        text: 'Guardar',
                        tooltip: 'Guardar Cambios',
                        iconCls: 'disk',
                        scope: this,
                        handler: function () {
                            var store = storeMandatosTipo;
                            x = 0;
                            changes = [];
                            for (var i = 0; i < store.getCount(); i++) {
                                var record = store.getAt(i);
                                if (record.get('tipo') == "" || record.get('clase') == ''){
                                    Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                    return;
                                }
                                if (record.isValid()) {
                                    if (Ext.Object.getSize(record.getChanges()) != 0) {
                                        record.data.id = record.id
                                        changes[x] = record.data;
                                        x++;
                                    }
                                } else {
                                    Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                    return;
                                }
                            }
                            var str = JSON.stringify(changes);
                            if (str.length > 5) {
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?= url_for("clientes/guardarMandatosTipo") ?>',
                                    params: {
                                        datos: str
                                    },
                                    success: function (response, opts) {
                                        var res = Ext.decode(response.responseText);
                                        ids = res.ids;
                                        ids_reg = res.ids_reg;
                                        if (res.ids && res.success) {
                                            for (i = 0; i < ids.length; i++) {
                                                var rec = store.getById(ids[i]);
                                                rec.set("idtipo", ids_reg[i]);
                                                rec.commit();
                                            }
                                            Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la información');
                                        }else if (!res.success){
                                            Ext.MessageBox.alert("Error", 'Se presentó el siguiente error: ' + res.errorInfo);
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
            store: storeMandatosTipo,
            displayInfo: true,
            displayMsg: 'Registros {0} - {1} of {2}',
            emptyMsg: "No hay registros"
        })
    });

</script>

