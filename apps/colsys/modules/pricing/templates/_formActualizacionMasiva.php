<?php
include_component("widgets5", "wgMoneda");
include_component("widgets5", "wgAplicacion");

$impoexpo = $sf_data->getRaw("impoexpo");
$transportes = $sf_data->getRaw("transportes");
$traficos = $sf_data->getRaw("traficos");
$ciudades = $sf_data->getRaw("ciudades");
$estados = $sf_data->getRaw("estados");
$tipoConcepto = $sf_data->getRaw("tipoConcepto");
?>
<style>
    .x-grid-group-title {
        text-align: left;
        font-weight: bold;
    }

    .no-dirty.x-grid-dirty-cell {
        background-image: none;
    }

    .x-autocontainer-innerCt {
        vertical-align: bottom;
    }
</style>

<script type="text/javascript">
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Ext.ux': '../js/ext5/examples/ux/'
        }
    });

    Ext.require([
        'Ext.ux.form.MultiSelect'
    ]);

    Ext.onReady(function () {

        var cellEditing = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToEdit: 1,
            listeners: {
                beforeedit: function (editor, context, eOpts) {
                    if (context.field == "aplicacion") {
                        store = context.column.getEditor().store;
                        store.getProxy().setExtraParam('Transporte', context.record.get('transporte'));
                        store.load();
                    }
                },
                edit: function (editor, context, eOpts) {
                    /* FIX-ME Edición de número que no cambian */
//                    if (context.field == "valor" || context.field == "valor_sug" || context.field == "valor_min") {
//                        if (parseFloat(context.value) == parseFloat(context.originalValue)) {
//                            console.log(context.value+" "+context.originalValue);
//                            editor.cancelEdit = true;
//                            return false;
//                        }
//                    }
                    store = grid.getStore();
                    store.each(function (record, idx) {
                        if (record.get('sel')) {
                            record.set(context.field, context.value);
                        }
                    });
                }
            }
        });

        var comboEstados = new Ext.form.ComboBox({
            store: {
                fields: [{name: 'idestado', type: 'string'}, {name: 'estado', type: 'string'}],
                data: <?= json_encode($estados) ?>
            },
            displayField: 'estado',
            valueField: 'idestado',
            queryMode: 'local',
        });

        Ext.util.Format.comboRenderer = function (combo) {
            return function (value) {
                var record = combo.findRecord(combo.valueField || combo.displayField, value);
                return record ? record.get(combo.displayField) : combo.valueNotFoundText;
            }
        }

        Ext.define('Modalidad', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'impoexpo', type: 'string'},
                {name: 'transporte', type: 'string'},
                {name: 'modalidad', type: 'string'}
            ]
        });

        var storeModalidad = Ext.create('Ext.data.Store', {
            autoLoad: false,
            model: 'Modalidad',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('widgets/datosModalidades') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        });

        Ext.define('Concepto', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idconcepto', type: 'string'},
                {name: 'concepto', type: 'string'}
            ]
        });

        var storeConcepto = Ext.create('Ext.data.Store', {
            autoLoad: false,
            model: 'Concepto',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('conceptos/datosConceptos') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            }
        });

        Ext.define('ModelIds', {
            extend: 'Ext.data.Model',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('reportesGer/busquedaIds') ?>',
                reader: {
                    type: 'json',
                    root: 'root',
                    totalProperty: 'total'
                }
            },
            fields: [
                {name: 'id', type: 'string'},
                {name: 'name', type: 'string'}
            ]
        });

        Ext.define('ComboTransportistas', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-transportistas',
            store: {
                pageSize: 10,
                model: 'ModelIds',
                listeners: {
                    beforeload: function (store, operation, eOpts) {
                        store.getProxy().setExtraParam('Tipo', 'Proveedor');
                        store.getProxy().setExtraParam('Estado', 'Activo');
                    }
                }
            },
            displayField: 'name',
            valueField: 'id',
            typeAhead: false,
            hideTrigger: true,
            anchor: '100%',
            listConfig: {
                loadingText: 'Buscando...',
                emptyText: 'No hay resultados'
            }
        });

        Ext.define('Masiva', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'sel', type: 'string'},
                {name: 'idtrayecto', type: 'string'},
                {name: 'idconcepto', type: 'string'},
                {name: 'origen', type: 'string'},
                {name: 'destino', type: 'string'},
                {name: 'concepto', type: 'string'},
                {name: 'idlinea', type: 'string'},
                {name: 'proveedor', type: 'string'},
                {name: 'idequipo', type: 'string'},
                {name: 'equipo', type: 'string'},
                {name: 'idrecargo', type: 'string'},
                {name: 'recargo', type: 'string'},
                {name: 'valor', type: 'string'},
                {name: 'valor_sug', type: 'string'},
                {name: 'aplicacion', type: 'string'},
                {name: 'valor_min', type: 'string'},
                {name: 'aplicacion_min', type: 'string'},
                {name: 'observaciones', type: 'string'},
                {name: 'estado', type: 'string'},
                {name: 'idmoneda', type: 'string'},
                {name: 'fchinicio', type: 'date', format:'Y-m-d'},
                {name: 'fchvencimiento', type: 'date', format:'Y-m-d'},
                {name: 'transporte', type: 'string'},
                {name: 'tipoConcepto', type: 'string'},
                {name: 'consecutivo', type: 'string'}
            ]
        });

        var storeMasiva = Ext.create('Ext.data.Store', {
            autoLoad: false,
            model: 'Masiva',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('pricing/actualizacionMasivaGrid') ?>',
                reader: {
                    type: 'json',
                    root: 'data'
                },
                // Parameter name to send filtering information in
                filterParam: 'query'
            },
            groupField: 'proveedor'
        });

        Ext.define('GridMasiva', {
            extend: 'Ext.grid.GridPanel',
            alias: 'widget.gridMasiva',
            store: storeMasiva,
            stripeRows: true,
            height: 600,
            features: [{
                    id: 'group',
                    ftype: 'groupingsummary',
                    groupHeaderTpl: '{name}',
                    hideGroupedHeader: true,
                    enableGroupingMenu: false
                }],
            plugins: [cellEditing],
            columns: [
                {
                    xtype: 'checkcolumn',
                    menuDisabled: true,
                    tdCls: 'no-dirty',
                    dataIndex: 'sel',
                    width: 30
                }, {
                    header: 'Idtrayecto',
                    dataIndex: 'idtrayecto',
                    hidden: true
                }, {
                    header: 'Idconcepto',
                    dataIndex: 'idconcepto',
                    hidden: true
                }, {
                    header: 'Proveedor',
                    dataIndex: 'proveedor',
                    width: 100,
                    summaryType: 'count',
                    summaryRenderer: function (value, summaryData, dataIndex) {
                        return ((value === 0 || value > 1) ? '(' + value + ' Conceptos)' : '(1 Concepto)');
                    }
                }, {
                    header: 'Origen',
                    dataIndex: 'origen',
                    width: 100
                }, {
                    header: 'Destino',
                    dataIndex: 'destino',
                    width: 100
                }, {
                    header: 'Concepto',
                    dataIndex: 'concepto',
                    width: 100,
                    flex: 1
                }, {
                    header: 'Idequipo',
                    dataIndex: 'idequipo',
                    hidden: true
                }, {
                    header: 'Equipo',
                    dataIndex: 'equipo',
                    width: 100
                }, {
                    header: 'Idrecargo',
                    dataIndex: 'idrecargo',
                    hidden: true
                }, {
                    header: 'Recargo',
                    dataIndex: 'recargo',
                    width: 100
                }, {
                    header: 'Valor',
                    width: 100,
                    align: 'right',
                    dataIndex: 'valor',
                    renderer: Ext.util.Format.usMoney,
                    editor: new Ext.form.NumberField({
                        allowBlank: false,
                        allowNegative: false,
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,
                        style: 'text-align:right',
                        decimalPrecision: 2
                    })
                }, {
                    header: 'Valor Sug.',
                    width: 100,
                    align: 'right',
                    dataIndex: 'valor_sug',
                    renderer: Ext.util.Format.usMoney,
                    editor: new Ext.form.NumberField({
                        allowBlank: false,
                        allowNegative: false,
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,
                        style: 'text-align:right',
                        decimalPrecision: 2
                    })
                }, {
                    header: 'Aplicación',
                    width: 90,
                    dataIndex: 'aplicacion',
                    flex: 1,
                    editor: {
                        xtype: 'wAplicacion',
                        allowBlank: false
                    }
                }, {
                    header: 'Valor Min.',
                    width: 100,
                    align: 'right',
                    dataIndex: 'valor_min',
                    renderer: Ext.util.Format.usMoney,
                    editor: new Ext.form.NumberField({
                        allowBlank: false,
                        allowNegative: false,
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,
                        style: 'text-align:right',
                        decimalPrecision: 2
                    })
                }, {
                    header: 'Aplicación Min.',
                    width: 70,
                    align: 'right',
                    dataIndex: 'aplicacion_min'
                }, {
                    header: 'Estado',
                    width: 120,
                    dataIndex: 'estado',
                    editor: comboEstados,
                    renderer: Ext.util.Format.comboRenderer(comboEstados)
                }, {
                    header: 'Moneda',
                    width: 70,
                    dataIndex: 'idmoneda',
                    editor: {
                        xtype: 'wMoneda',
                        allowBlank: false
                    }
                }, {
                    header: 'Vence Ini.',
                    width: 90,
                    dataIndex: 'fchinicio',
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    editor: {
                        xtype: 'datefield',
                        format: 'Y-m-d'
                    }
                }, {
                    header: 'Vence Fch.',
                    width: 90,
                    dataIndex: 'fchvencimiento',
                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                    editor: {
                        xtype: 'datefield',
                        format: 'Y-m-d'
                    }
                }, {
                    header: 'Observaciones',
                    flex: 1,
                    dataIndex: 'observaciones',
                    editor: {
                        xtype: 'textfield',
                        allowBlank: false
                    }
                }
            ],
            selModel: {
                selType: 'cellmodel'
            },
            showColumns: function (tipoConcepto) {
                if (tipoConcepto[0] === "Fletes") {
                    this.columns[8].hide();             // equipo
                    this.columns[10].hide();             // recargo
                    this.columns[14].hide();            // valor_min
                    this.columns[15].hide();            // aplicacion_min
                    this.columns[20].hide();            // observaciones
                } else if (tipoConcepto[0] === "Recargos") {
                    this.columns[8].hide();             // equipo
                    this.columns[10].show();             // recargo
                    this.columns[14].show();            // valor_min
                    this.columns[15].show();            // aplicacion_min
                    this.columns[16].hide();            // estado
                    this.columns[20].show();            // observaciones
                }
            },
//            colocarEstilo: function (rec, val) {
//                rec.set("style", val);
//
//                if (rec.data.sel) {
//                    var records = this.store.getModifiedRecords();
//                    var lenght = records.length;
//
//                    for (var i = 0; i < lenght; i++) {
//                        r = records[i];
//                        if (r.data.sel && r.data.tipo == "concepto") {
//                            r.set("style", val);
//                        }
//                    }
//                }
//            },
            bbar: [{
                    xtype: 'container',
                    layout: 'column',
                    width: '100%',
                    margin: '0 0 0 0',
                    items: [{
                            xtype: 'pagingtoolbar',
                            store: storeMasiva,
                            displayInfo: true,
                            displayMsg: 'Registros {0} - {1} of {2}',
                            emptyMsg: "No hay registros",
                            columnWidth: 0.65
                        }, {
                            xtype: 'fieldset',
                            height: 40,
                            collapsible: false,
                            columnWidth: 0.34,
                            layout: 'column',
                            items: [{
                                    xtype: 'button',
                                    text: 'Regresar',
                                    name: 'regresar',
                                    id: 'regresar',
                                    width: 70,
                                    columnWidth: 0.49,
                                    margin: '0 10 0 10',
                                    handler: function () {
                                        Ext.getCmp('formFiltros').up('fieldset').expand();
                                        Ext.getCmp('gridMasiva').up('fieldset').collapse();
                                    }
                                }, {
                                    xtype: 'button',
                                    text: 'Guardar Cambios',
                                    width: 70,
                                    columnWidth: 0.49,
                                    margin: '0 10 0 10',
                                    handler: function () {
                                        grid = Ext.getCmp('gridMasiva');
                                        grid.showColumns(Ext.getCmp('tipoConcepto').getValue());
                                        store = grid.getStore();

                                        x = 0;
                                        changes = [];
                                        for (var i = 0; i < store.getCount(); i++) {
                                            var record = store.getAt(i);
                                            if (Ext.Object.getSize(record.getChanges()) != 0) {
                                                record.data.id = record.id
                                                changes[x] = record.data;
                                                x++;
                                            }
                                        }

                                        var str = JSON.stringify(changes);
                                        if (str.length > 5) {
                                            Ext.Ajax.request({
                                                waitMsg: 'Guardando cambios...',
                                                url: '<?= url_for("pricing/actualizacionMasivaGuardar") ?>',
                                                params: {
                                                    datos: str
                                                },
                                                success: function (response, opts) {
                                                    var res = Ext.decode(response.responseText);
                                                    if (res.id && res.success) {
                                                        id = res.id.split(",");
                                                        idreg = res.idreg.split(",");
                                                        for (i = 0; i < id.length; i++) {
                                                            var rec = store.getById(id[i]);
                                                            rec.set("iddetalle", idreg[i]);
                                                            rec.commit();
                                                        }
                                                        Ext.MessageBox.alert("Mensaje", 'Se guardo Correctamente la información');
                                                    }
                                                    if (res.errorInfo != "") {
                                                        Ext.MessageBox.alert("Mensaje", 'No fue posible el guardar la fila <br>' + res.errorInfo);
                                                    }
                                                },
                                                failure: function (response, opts) {
                                                    Ext.MessageBox.alert("Coltrans", "Se presento el siguiente error " + response.status);
                                                    box.hide();
                                                }
                                            });
                                        }

                                    }
                                }]
                        }]
                }]
        });

        Ext.define('FormFiltros', {
            extend: 'Ext.panel.Panel',
            alias: 'widget.formFiltros',
            layout: 'column',
            margin: '0 0 0 0',
            border: 0,
            defaults: {height: 160},
            items: [{
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Impo/Expo',
                    name: 'impoexpo',
                    id: 'impoexpo',
                    allowBlank: false,
                    columnWidth: 0.10,
                    store: <?= json_encode($impoexpo) ?>,
                    style: 'text-align: left',
                    ddReorder: false,
                    listeners: {
                        change: function (comboMulti, newValue, oldValue, eOpts) {
                            store = Ext.getCmp('modalidad').getStore();
                            store.load({
                                params: {
                                    impoexpo: newValue
                                }
                            });
                        }
                    }
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Transporte',
                    name: 'transporte',
                    id: 'transporte',
                    allowBlank: false,
                    columnWidth: 0.10,
                    store: <?= json_encode($transportes) ?>,
                    style: 'text-align: left',
                    ddReorder: false,
                    listeners: {
                        change: function (comboMulti, newValue, oldValue, eOpts) {
                            store = Ext.getCmp('modalidad').getStore();
                            store.load({
                                params: {
                                    transporte: newValue,
                                    impoexpo: Ext.getCmp('impoexpo').value
                                }
                            });
                        }
                    }
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Trafico',
                    name: 'trafico',
                    id: 'trafico',
                    allowBlank: false,
                    columnWidth: 0.15,
                    store: {
                        fields: [{name: 'idTrafico', type: 'string'}, {name: 'trafico', type: 'string'}],
                        data: <?= json_encode($traficos) ?>
                    },
                    style: 'text-align: left',
                    valueField: 'idTrafico',
                    displayField: 'trafico',
                    ddReorder: false,
                    listeners: {
                        change: function (comboMulti, newValue, oldValue, eOpts) {
                            store = Ext.getCmp('origen').getStore();
                            store.filtrar(newValue);
                            store = Ext.getCmp('destino').getStore();
                            store.filtrar(Ext.getCmp('impoexpo').value, Ext.getCmp('transporte').value, newValue);
                        }
                    }
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Origen',
                    name: 'origen',
                    id: 'origen',
                    allowBlank: false,
                    columnWidth: 0.15,
                    store: {
                        fields: [{name: 'idCiudad', type: 'string'}, {name: 'ciudad', type: 'string'}],
                        data: <?= json_encode($ciudades) ?>,
                        filtrar: function (trafico) {
                            me = this;
                            me.filterBy(function (record, id) {
                                return (record.data.idtrafico == trafico);
                            });
                        }
                    },
                    style: 'text-align: left',
                    valueField: 'idCiudad',
                    displayField: 'ciudad',
                    ddReorder: false
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Destino',
                    name: 'destino',
                    id: 'destino',
                    allowBlank: false,
                    columnWidth: 0.15,
                    store: {
                        fields: [{name: 'idCiudad', type: 'string'}, {name: 'ciudad', type: 'string'}],
                        data: <?= json_encode($ciudades) ?>,
                        filtrar: function (impoexpo, puerto, trafico) {
                            me = this;
                            me.filterBy(function (record, id) {
                                res = false;
                                if (impoexpo == "Importación") {
                                    if (record.data.idtrafico == "CO-057")
                                        res = true;
                                } else {
                                    if (record.data.idtrafico != "CO-057")
                                        res = true;
                                }
                                if (res && puerto == "Marítimo" && (record.data.puerto == puerto || record.data.puerto == "Ambos")) {
                                    res = true;
                                } else if (res && puerto == "Aéreo" && (record.data.puerto == puerto || record.data.puerto == "Ambos")) {
                                    res = true;
                                } else if (res && puerto == "Terrestre" && (record.data.puerto == puerto || record.data.puerto == "Ambos")) {
                                    res = true;
                                } else {
                                    res = false;
                                }
                                return (res);
                            });
                        }
                    },
                    style: 'text-align: left',
                    valueField: 'idCiudad',
                    displayField: 'ciudad',
                    ddReorder: false
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Estado',
                    name: 'estado',
                    id: 'estado',
                    columnWidth: 0.10,
                    store: {
                        fields: [{name: 'idestado', type: 'string'}, {name: 'estado', type: 'string'}],
                        data: <?= json_encode($estados) ?>
                    },
                    style: 'text-align: left',
                    valueField: 'idestado',
                    displayField: 'estado',
                    ddReorder: false
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Modalidad',
                    name: 'modalidad',
                    id: 'modalidad',
                    columnWidth: 0.15,
                    store: storeModalidad,
                    style: 'text-align: left',
                    valueField: 'modalidad',
                    displayField: 'modalidad',
                    ddReorder: false
                }, {
                    xtype: 'multiselect',
                    msgTarget: 'side',
                    title: 'Tipo Concepto',
                    name: 'tipoConcepto',
                    id: 'tipoConcepto',
                    allowBlank: false,
                    columnWidth: 0.10,
                    store: <?= json_encode($tipoConcepto) ?>,
                    style: 'text-align: left',
                    ddReorder: false,
                    listeners: {
                        change: function (comboMulti, newValue, oldValue, eOpts) {
                            if (Ext.getCmp('transporte').value) {
                                transporte = Ext.getCmp('transporte').value;
                                if (Ext.getCmp('modalidad').value) {
                                    modalidad = Ext.getCmp('modalidad').value;
                                    if (Ext.getCmp('impoexpo').value) {
                                        modo = newValue.toString().toLowerCase();
                                        impoexpo = Ext.getCmp('impoexpo').value;
                                        store = Ext.getCmp('gridConcepto').getStore();
                                        store.load({
                                            params: {
                                                transporte: Ext.getCmp('transporte').value,
                                                modalidad: Ext.getCmp('modalidad').value,
                                                impoexpo: Ext.getCmp('impoexpo').value,
                                                modo: modo
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    }
                }, {
                    xtype: 'fieldset',
                    title: 'Conceptos',
                    collapsible: false,
                    columnWidth: 0.30,
                    height: 230,
                    items: {
                        xtype: 'gridpanel',
                        name: 'gridConcepto',
                        id: 'gridConcepto',
                        store: storeConcepto,
                        hideHeaders: true,
                        columns: [
                            {text: 'Sel', dataIndex: 'sel', xtype: 'checkcolumn', width: 25},
                            {text: 'Id', dataIndex: 'idconcepto', hidden: true},
                            {text: 'Concepto', dataIndex: 'concepto', flex: 1}
                        ],
                        height: 200,
                        width: 350
                    }
                }, {
                    xtype: 'fieldset',
                    title: 'Transportista',
                    collapsible: false,
                    columnWidth: 0.57,
                    height: 230,
                    layout: 'column',
                    items: [{
                            xtype: 'combo-transportistas',
                            name: 'transportista',
                            id: 'transportista',
                            width: 250
                        }, {
                            xtype: 'button',
                            text: '->',
                            margin: '0 5 0 5',
                            handler: function () {
                                if (Ext.getCmp('transportista').value) {
                                    store = Ext.getCmp('gridTransport').getStore();
                                    store.add({id: Ext.getCmp('transportista').value, name: Ext.getCmp('transportista').rawValue});
                                }
                            }
                        }, {
                            xtype: 'gridpanel',
                            name: 'gridTransport',
                            id: 'gridTransport',
                            hideHeaders: true,
                            columns: [
                                {text: 'Id', dataIndex: 'id', hidden: true},
                                {text: 'Transportador', dataIndex: 'name', flex: 1}
                            ],
                            height: 200,
                            width: 400
                        }]
                }, {
                    xtype: 'fieldset',
                    title: 'Acción',
                    height: 110,
                    collapsible: false,
                    columnWidth: 0.127,
                    items: [{
                            xtype: 'button',
                            margin: '10, 0, 10, 0',
                            text: 'Realizar Búsqueda',
                            name: 'buscar',
                            id: 'buscar',
                            width: 140,
                            handler: function () {
                                if ((Ext.getCmp('tipoConcepto').getValue()).length == 0) {
                                    Ext.MessageBox.alert('Mensaje de Alerta', 'Debe elegir el tipo de búsqueda entre Fletes o Recargos', function () {
                                        return false;
                                    });
                                }
                                Ext.getCmp('formFiltros').up('fieldset').collapse();
                                Ext.getCmp('gridMasiva').up('fieldset').expand();

                                conceptos = [];
                                store = Ext.getCmp('gridConcepto').getStore();
                                store.each(function (record, idx) {
                                    if (record.get('sel')) {
                                        conceptos.push(record.get('idconcepto'));
                                    }
                                });

                                transportistas = [];
                                store = Ext.getCmp('gridTransport').getStore();
                                store.each(function (record, idx) {
                                    transportistas.push(record.get('id'));
                                });

                                grid = Ext.getCmp('gridMasiva');
                                grid.showColumns(Ext.getCmp('tipoConcepto').getValue());
                                store = grid.getStore();
                                store.reload({
                                    params: {
                                        impoexpo: JSON.stringify(Ext.getCmp('impoexpo').getValue()),
                                        transporte: JSON.stringify(Ext.getCmp('transporte').getValue()),
                                        tipoConcepto: Ext.getCmp('tipoConcepto').getValue(),
                                        trafico: JSON.stringify(Ext.getCmp('trafico').getValue()),
                                        estado: JSON.stringify(Ext.getCmp('estado').getValue()),
                                        modalidad: JSON.stringify(Ext.getCmp('modalidad').getValue()),
                                        origen: JSON.stringify(Ext.getCmp('origen').getValue()),
                                        destino: JSON.stringify(Ext.getCmp('destino').getValue()),
                                        conceptos: JSON.stringify(conceptos),
                                        transportistas: JSON.stringify(transportistas)
                                    }
                                });
                            }
                        }, {
                            xtype: 'button',
                            margin: '10, 0, 10, 0',
                            text: 'Nueva Búsqueda',
                            name: 'nueva',
                            id: 'nueva',
                            width: 140,
                            handler: function () {
                                Ext.getCmp('formFiltros').up('fieldset').expand();
                                Ext.getCmp('gridMasiva').up('fieldset').collapse();
                                Ext.getCmp('impoexpo').reset();
                                Ext.getCmp('transporte').reset();
                                Ext.getCmp('trafico').reset();
                                Ext.getCmp('estado').reset();
                                Ext.getCmp('modalidad').reset();
                                Ext.getCmp('origen').getStore().clearFilter();
                                Ext.getCmp('destino').getStore().clearFilter();
                                Ext.getCmp('tipoConcepto').reset();
                                Ext.getCmp('gridConcepto').getStore().removeAll();
                                Ext.getCmp('gridTransport').getStore().removeAll();
                                Ext.getCmp('gridMasiva').getStore().removeAll();
                            }
                        }]
                }
            ]
        });

        Ext.create('Ext.panel.Panel', {
            items: [{
                    title: 'Actualización Masiva de Tarifas',
                    xtype: 'fieldset',
                    collapsible: true,
                    layout: 'anchor',
                    items: [{
                            id: 'formFiltros',
                            xtype: 'formFiltros'
                        }]
                }, {
                    xtype: 'fieldset',
                    collapsible: true,
                    collapsed: true,
                    layout: 'anchor',
                    items: [{
                            id: 'gridMasiva',
                            xtype: 'gridMasiva'
                        }]
                }],
            renderTo: Ext.get('se-form')
        });
    });
</script>
