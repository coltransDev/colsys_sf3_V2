<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$razonSocial = $sf_data->getRaw("razonSocial");
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">

    Ext.define('ControlFinanciero', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'iddocumento', type: 'string'},
            {name: 'empresa', type: 'string'},
            {name: 'documento', type: 'string'},
            {name: 'observaciones', type: 'string'},
            {name: 'fch_vigencia', type: 'date'},
            {name: 'fch_documento', type: 'date'}
        ]
    });

    var storeControlFinanciero = Ext.create('Ext.data.Store', {
        id: 'storeControlFinanciero',
        autoLoad: true,
        model: 'ControlFinanciero',
        proxy: {
            type: 'ajax',
            url: '<?= url_for('clientes/datosControlFinanciero') ?>',
            reader: {
                type: 'json',
                root: 'root'
            },
            extraParams: {
                idcliente: '<?= $idcliente ?>'
            },
            // Parameter name to send filtering information in
            filterParam: 'query',
        },
        groupField: 'empresa'
    });

    var gridControlFinanciero = new Ext.grid.GridPanel({
        id: 'gridControlFinanciero',
        store: storeControlFinanciero,
        height: 400,
        width: 650,
        features: [{
                ftype: 'groupingsummary',
                groupHeaderTpl: [
                    '<div style="text-align: left;">{name:this.formatName}</div>',
                    {
                        formatName: function (name) {
                            return Ext.String.trim(name);
                        }
                    }
                ]
            }],
        columns: [{
                header: 'Documento',
                width: 300,
                dataIndex: 'documento',
                hideable: false,
                summaryType: 'count',
                summaryRenderer: function (value, summaryData, dataIndex) {
                    return ((value === 0 || value > 1) ? '(' + value + ' Documentos)' : '(1 Documento)');
                }
            }, {
                header: 'Fecha Documento',
                flex: 1,
                width: 100,
                dataIndex: 'fch_documento',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
                    allowBlank: false,
                    format: 'Y-m-d',
                    useStrict: undefined
                })
            }, {
                header: 'Fecha de Vigencia',
                flex: 1,
                width: 100,
                dataIndex: 'fch_vigencia',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
                    allowBlank: false,
                    format: 'Y-m-d',
                    useStrict: undefined
                })
            }, {
                header: 'Observaciones',
                flex: 1,
                width: 120,
                dataIndex: 'observaciones',
                editor: {
                    xtype: 'textfield',
                    originalValue: '',
                    allowBlank: true
                }
            }
        ],
        selType: 'cellmodel',
        plugins: [
            Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit: 1
            })
        ],
        bbar: Ext.create('Ext.PagingToolbar', {
            displayInfo: true,
            displayMsg: 'Registros {0} - {1} of {2}',
            emptyMsg: "No hay registros"
        })
    });


    Ext.onReady(function () {

        Ext.define('ComboNit', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-nit',
            store: ['Agente', 'Proveedor', 'Excepción Temporal', 'Excepción Permanente']
        });

        Ext.define('ComboRiesgo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-riesgo',
            store: ['Mínimo', 'Medio', 'Alto']
        });

        Ext.define('ComboSiNo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-si-no',
            store: ['Sí', 'No']
        });

        var tabPanel = new Ext.tab.Panel({
            id: 'panelControlFianciero',
            items: [{
                    title: 'Documentos',
                    items: [{
                            xtype: 'fieldset',
                            title: 'Nuevos Datos para el Cliente',
                            width: 655,
                            collapsible: false,
                            defaults: {
                                labelWidth: 89,
                                anchor: '90%',
                                layout: {
                                    type: 'column',
                                    defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                }},
                            items: [{
                                    xtype: 'fieldset',
                                    title: 'Circular 170',
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'datefield',
                                                    fieldLabel: 'Diligenciado',
                                                    name: 'fchcircular',
                                                    width: 240,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'combo-riesgo',
                                                    hideLabel: false,
                                                    fieldLabel: 'Nivel de Riesgo',
                                                    labelWidth: 100,
                                                    name: 'nvlriesgo',
                                                    width: 240,
                                                    forceSelection: true
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Superintendencia de Sociedades',
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'Reportado',
                                                    name: 'leyinsolvencia',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: 'Comentario',
                                                    labelWidth: 100,
                                                    name: 'comentario',
                                                    width: 350,
                                                    allowBlank: false
                                                }]
                                        }]
                                }, {
                                    xtype: 'fieldset',
                                    title: 'Lista OFAC',
                                    width: 620,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'Reportado',
                                                    name: 'listaclinton',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'combo-nit',
                                                    hideLabel: false,
                                                    fieldLabel: 'Tipo de NIT',
                                                    labelWidth: 100,
                                                    name: 'tipo',
                                                    width: 350,
                                                    forceSelection: true
                                                }]
                                        }]

                                }, {
                                    xtype: 'fieldset',
                                    title: 'Certificaciones',
                                    width: 620,
                                    height: 120,
                                    collapsible: false,
                                    defaults: {
                                        labelWidth: 89,
                                        anchor: '90%',
                                        layout: {
                                            type: 'column',
                                            defaultMargins: {top: 0, right: 0, bottom: 0, left: 0}
                                        }},
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'hiddenfield',
                                                    name: 'idcliente'
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: 'ISO',
                                                    name: 'iso',
                                                    width: 160,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: '¿Cual?',
                                                    labelWidth: 100,
                                                    name: 'iso_detalles',
                                                    width: 160,
                                                    allowBlank: false
                                                }, {
                                                    xtype: 'combo-si-no',
                                                    hideLabel: false,
                                                    fieldLabel: 'BASC',
                                                    labelWidth: 100,
                                                    name: 'basc',
                                                    width: 160,
                                                    forceSelection: true
                                                }]
                                        }, {
                                            xtype: 'fieldcontainer',
                                            hideLabel: true,
                                            combineErrors: true,
                                            height: 45,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-si-no',
                                                    value: '',
                                                    fieldLabel: '¿Otro Certificado?',
                                                    labelWidth: 165,
                                                    name: 'otro_cert',
                                                    width: 260,
                                                    columnWidth: 0.4,
                                                    forceSelection: true
                                                }, {
                                                    xtype: 'textfield',
                                                    hideLabel: false,
                                                    fieldLabel: '¿Cual?',
                                                    labelWidth: 80,
                                                    name: 'otro_detalles',
                                                    width: 220,
                                                    allowBlank: false
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Documentos',
                    items: [
                        gridControlFinanciero
                    ]
                }]
        });

        Ext.create('Ext.form.Panel', {
            title: 'Control Financiero de Documentos.<br /><?=$razonSocial?>',
            stripeRows: true,
            height: 535,
            width: 660,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            // Fields will be arranged vertically, stretched to full width
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            // The fields
            defaultType: 'textfield',
            items: [
                tabPanel
            ],
            listeners: {
                afterRender: function (panel, eOpts) {
                    panel.getForm().setValues(<?= json_encode($data) ?>);
                }
            },
            buttons: [{
                    id: 'bntGuardar',
                    text: 'Guardar',
                    handler: function () {
                        var me = this;
                        var form = me.up('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            var store = storeControlFinanciero;
                            x = 0;
                            changes = [];
                            for (var i = 0; i < store.getCount(); i++) {
                                var record = store.getAt(i);
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
                            var strGrid = JSON.stringify(changes);

                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('clientes/actualizarControlFinanciero') ?>',
                                params: {
                                    datos: str,
                                    datosGrid: strGrid
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
                                    ids = res.ids;
                                    if (res.ids) {
                                        for (i = 0; i < ids.length; i++) {
                                            var rec = store.getById(ids[i]);
                                            rec.commit();
                                        }
                                        Ext.MessageBox.alert("Mensaje", 'Información almacenada correctamente<br>');
                                    }
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
            ],
            renderTo: Ext.get('se-form')
        });

    });
</script>