<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$annos = $sf_data->getRaw("annos");
$meses = $sf_data->getRaw("meses");
$sucursales = $sf_data->getRaw("sucursales");
$vendedores = $sf_data->getRaw("vendedores");
$operativos = $sf_data->getRaw("operativos");
?>


<table width="900" align="center">
    <td style="text-align: center">
        <div id="se-form"></div><br>
    </td>
</table>

<script type="text/javascript">


    Ext.define('ComboMeses', {
        extend: 'Ext.form.field.ComboBox',
        alias: 'widget.combo-meses',
        valueField: 'idmes',
        displayField: 'nommes',
        store: {
            fields: [{name: 'idmes', type: 'string'}, {name: 'nommes', type: 'string'}],
            data: <?= json_encode($meses) ?>
        }
    });

    Ext.define('modelOperativo', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'id', type: 'string'},
            {name: 'text', type: 'string'},
            {name: 'leaf', type: 'string'},
            {name: 'checked', type: 'string'}
        ]
    });

    var storeOperativo = Ext.create('Ext.data.Store', {
        id: 'storeOperativo',
        autoLoad: false,
        model: 'modelOperativo',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('reportesGer/datosOperativos') ?>',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    });

    Ext.define('modelVendedor', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'id', type: 'string'},
            {name: 'text', type: 'string'},
            {name: 'leaf', type: 'string'},
            {name: 'checked', type: 'string'}
        ]
    });

    var storeVendedor = Ext.create('Ext.data.TreeStore', {
        autoLoad: false,
        model: 'modelVendedor',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('reportesGer/datosVendedores') ?>',
            reader: {
                type: 'json',
                root: 'root'
            }
        }
    });

    Ext.define('ComboVendedores', {
        extend: 'Ext.tree.Panel',
        alias: 'widget.combo-vendedores',
        useArrows: true,
        enableLocking : false,
        autoLoad: false,
        id: 'comboVendedoresI',
        valueField: 'id',
        displayField: 'text',
        rootVisible: false,
        store: Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'id', type: 'string'},
                {name: 'text', type: 'string'},
                {name: 'leaf', type: 'boolean'},
                {name: 'checked', type: 'boolean'}
            ],
            proxy: {
                type: 'ajax',
                url: '<?= url_for('reportesGer/datosVendedores') ?>'
            }

        }),
        listeners: {
            
            beforeitemdblclick: function (me, record, item, index, e, eOpts) {
                return false;
            }
        }
    });


    Ext.define('ComboOperativos', {
        extend: 'Ext.tree.Panel',
        alias: 'widget.combo-operativos',
        useArrows: true,
        enableLocking : false,
        autoLoad: false,
        id: 'comboOperativosI',
        valueField: 'id',
        displayField: 'text',
        rootVisible: false,
        store: Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'id', type: 'string'},
                {name: 'text', type: 'string'},
                {name: 'leaf', type: 'boolean'},
                {name: 'checked', type: 'boolean'}
            ],
            proxy: {
                type: 'ajax',
                url: '<?= url_for('reportesGer/datosOperativos') ?>'
            }

        }),
        listeners: {
            
            beforeitemdblclick: function (me, record, item, index, e, eOpts) {
                return false;
            }
        }
    });

    Ext.define('User', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'id', type: 'int'},
            {name: 'nombre', type: 'string'}
        ]
    });

    Ext.onReady(function () {
        Ext.create('Ext.form.Panel', {
            renderTo: Ext.get('se-form'),
            title: 'Reporte Elaboración Cotizaciones',
            height: 500,
            width: 800,
            bodyPadding: 10,
            layout: 'column', // arrange fieldsets side by side
            items: [{
                    xtype: 'fieldset',
                    columnWidth: 0.7,
                    title: '',
                    collapsible: false,
                    height: 380,
                    defaultType: 'textfield',
                    defaults: {anchor: '100%'},
                    layout: 'column',
                    items: [{
                            xtype: 'tbspacer',
                            height: 20,
                            width: 800
                        }, {
                            fieldLabel: 'Año',
                            xtype: 'combo',
                            store: <?= json_encode($annos) ?>,
                            name: 'anio',
                            forceSelection: true,
                            allowBlank: false,
                            width: 120,
                            labelWidth: 50,
                            height: 20
                        }, {
                            fieldLabel: 'Mes',
                            name: 'mes',
                            xtype: 'combo-meses',
                            forceSelection: true,
                            allowBlank: false,
                            width: 150,
                            labelWidth: 50,
                            height: 20
                        }, {
                            xtype: 'tbspacer',
                            width: 15
                        }, {
                            fieldLabel: 'Sucursal',
                            id: 'sucursal',
                            name: 'sucursal',
                            xtype: 'combo',
                            forceSelection: true,
                            allowBlank: true,
                            store: <?= json_encode($sucursales) ?>,
                            width: 195,
                            labelWidth: 70,
                            height: 20,
                            listeners: {
                                select: {
                                    fn: function (combo, record, eOpts) {
                                        if (combo.id == 'sucursal') {
                                            store = Ext.getCmp('comboVendedoresI').store;
                                            store.load({
                                                params: {
                                                    nombresucursal: combo.getValue(),
                                                    verificacion: 1
                                                },
                                                /*callback: function (records, operation, success) {
                                                    respuesta = Ext.JSON.decode(operation._response.responseText);
                                                    store.setData(respuesta.root);
                                                }*/
                                            });

                                            storeO = Ext.getCmp('comboOperativosI').store;
                                            storeO.load({
                                                params: {
                                                    nombresucursal: combo.getValue(),
                                                    verificacion: 1
                                                },
                                                /*
                                                 * callback: function (records, operation, success) {
                                                    respuesta = Ext.JSON.decode(operation._response.responseText);
                                                   // storeO.setData(respuesta.root);
                                                    //storeO.setData([{"id":1 , "text": "ddd" , "leaf" : true , "checked" : true}]);
                                                }*/
                                            });

                                        }
                                    }
                                }
                            }
                        }, {
                            xtype: 'tbspacer',
                            height: 20,
                            width: 800
                        }, {
                            title: 'Operativos',
                            fieldLabel: 'Operativos',
                            name: 'operativos',
                            xtype: 'combo-operativos',
                            width: 230,
                            labelWidth: 50,
                            height: 290
                        }, {
                            xtype: 'tbspacer',
                            width: 40
                        }, {
                            title: 'Vendedor',
                            fieldLabel: 'Vendedor',
                            multiSelect: true,
                            name: 'vendedor',
                            xtype: 'combo-vendedores',
                            width: 230,
                            labelWidth: 50,
                            height: 290
                        }]
                }, {
                    xtype: 'fieldset',
                    columnWidth: 0.28,
                    title: '',
                    collapsible: false,
                    height: 380,
                    defaultType: 'textfield',
                    defaults: {anchor: '100%'},
                    layout: 'column',
                    items: [{
                            xtype: 'tbspacer',
                            height: 180,
                            width: 800
                        }, {
                            text: 'Buscar',
                            multiSelect: true,
                            name: 'vendedor',
                            xtype: 'button',
                            width: 190,
                            height: 30,
                            handler: function () {
                                var store = Ext.getCmp('comboVendedoresI').store;
                                x = 0;
                                changes = [];
                                var record0 = store.getAt(0);

                                if (record0) {

                                    if (record0.data.checked) {
                                        for (var i = 0; i < store.getCount(); i++) {
                                            var record = store.getAt(i);
                                            if (record.isValid()) {
                                                changes[x] = record.data;
                                                x++;
                                            } else {
                                                Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                                return;
                                            }
                                        }
                                    } else {
                                        for (var i = 0; i < store.getCount(); i++) {
                                            var record = store.getAt(i);
                                            if (record.isValid()) {
                                                if (record.data.checked) {
                                                    changes[x] = record.data;
                                                    x++;
                                                }
                                            } else {
                                                Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                                return;
                                            }
                                        }
                                    }
                                }
                                var vendedores = JSON.stringify(changes);

                                var store2 = Ext.getCmp('comboOperativosI').store;
                                x = 0;
                                changes = [];
                                var record0 = store2.getAt(0);
                                if (record0) {
                                    if (record0.data.checked) {
                                        for (var i = 0; i < store2.getCount(); i++) {
                                            var record = store2.getAt(i);
                                            if (record.isValid()) {
                                                changes[x] = record.data;
                                                x++;
                                            } else {
                                                Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                                return;
                                            }
                                        }
                                    } else {

                                        for (var i = 0; i < store2.getCount(); i++) {
                                            var record = store2.getAt(i);
                                            if (record.isValid()) {
                                                if (record.data.checked) {
                                                    changes[x] = record.data;
                                                    x++;
                                                }
                                            } else {
                                                Ext.MessageBox.alert("Error", 'La información está incompleta o no es válida.');
                                                return;
                                            }
                                        }
                                    }
                                }

                                var operativos = JSON.stringify(changes);

                                var form = this.up('form').getForm();

                                form.doAction('standardsubmit', {
                                    url: '<?= url_for('reportesGer/reporteElaboracionCotizacionesListExt5') ?>',
                                    standardSubmit: true,
                                    method: 'POST',
                                    params: {
                                        vendedores: vendedores,
                                        operativos: operativos
                                    }
                                });
                            }
                        }]
                }]
        });
    });
</script>
