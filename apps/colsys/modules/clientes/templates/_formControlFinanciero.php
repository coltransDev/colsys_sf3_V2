<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$razonSocial = $sf_data->getRaw("razonSocial");
$data = $sf_data->getRaw("data");
$sectorfinanciero = $sf_data->getRaw("sectorfinanciero");
$tipopersona = $sf_data->getRaw("tipopersona");
$minimo = $sf_data->getRaw("minimo");
?>
<script type="text/javascript">

    Ext.define('ControlFinanciero', {
        extend: 'Ext.data.Model',
        fields: [
            {name: 'idtipo', type: 'string'},
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
        autoLoad: false,
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
            filterParam: 'query',
        },
        groupField: 'empresa'
    });

    var fieldsetPersonaJuridica = Ext.create('Ext.form.FieldSet', {
        xtype: 'fieldset',
        title: 'Persona jurídica',
        id: 'personajuridica',
        hidden: true,
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
                combineErrors: true,
                height: 50,
                width: 200,
                msgTarget: 'under',
                items: [{
                        xtype: 'tbspacer',
                        columnWidth: 0.2,
                    }, {
                        xtype: 'fieldset',
                        title: '',
                        columnWidth: 0.6,
                        defaultType: 'checkbox',
                        layout: 'column',
                        items: [{
                                id: 'grancontribuyente',
                                name: 'grancontribuyente',
                                fieldLabel: 'Gran contribuyente',
                                boxLabel: '',
                            }, {
                                fieldLabel: 'UAP',
                                boxLabel: '',
                                name: 'uap',
                                id: 'uap',
                            }]
                    }]
            }]
    });

    var gridControlFinanciero = new Ext.grid.GridPanel({
        id: 'gridControlFinanciero',
        store: storeControlFinanciero,
        hidden: true,
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
                header: 'idtipo',
                width: 300,
                dataIndex: 'idtipo',
                hidden: true
            }, {
                header: 'Fecha Documento',
                width: 120,
                dataIndex: 'fch_documento',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
                    format: 'Y-m-d',
                    useStrict: undefined
                })
            }, {
                header: 'Fecha Vigencia',
                width: 120,
                dataIndex: 'fch_vigencia',
                renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                editor: new Ext.form.DateField({
                    width: 90,
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

        Ext.define('ComboSectorEconomico', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-sectoreconomico',
            queryMode: 'local',
            valueField: 'id',
            displayField: 'sector',
            store: {
                fields: [{name: 'sector', type: 'string'}, {name: 'id', type: 'string'}],
                data: <?= json_encode($sectorfinanciero) ?>
            }
        });

        Ext.define('ComboPersona', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-persona',
            queryMode: 'local',
            valueField: 'id',
            displayField: 'tipo',
            store: {
                fields: [{name: 'tipo', type: 'string'}, {name: 'id', type: 'string'}],
                data: <?= json_encode($tipopersona) ?>
            }
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
                    title: 'General',
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
                                                }]
                                        }]
                                }]
                        }]
                }, {
                    title: 'Supersociedades',
                    autoScroll: true,
                    height: 400,
                    items: [{
                            xtype: 'fieldset',
                            title: 'Nuevos Datos para el Cliente',
                            width: 640,
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
                                    title: 'Persona',
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
                                            height: 80,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'combo-persona',
                                                    hideLabel: false,
                                                    fieldLabel: 'Tipo Persona',
                                                    labelWidth: 100,
                                                    id: 'tipopersona',
                                                    name: 'tipopersona',
                                                    width: 240,
                                                    forceSelection: true,
                                                    listeners: {
                                                        select: {
                                                            fn: function (combo, record, eOpts) {
                                                                //alert(combo.value);
                                                                if (combo.value == "2") {
                                                                    fieldsetPersonaJuridica.setVisible(true);
                                                                } else {
                                                                    fieldsetPersonaJuridica.setVisible(false);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'combo-sectoreconomico',
                                                    hideLabel: false,
                                                    fieldLabel: 'Sector Económico',
                                                    labelWidth: 100,
                                                    id: 'sectoreconomico',
                                                    name: 'sectoreconomico',
                                                    width: 280,
                                                    forceSelection: true,
                                                    listeners: {
                                                        select: {
                                                            fn: function (combo, record, eOpts) {

                                                            }
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'datefield',
                                                    fieldLabel: 'Fecha de Constitución',
                                                    name: 'fechaconstitucion',
                                                    id: 'fechaconstitucion',
                                                    width: 235,
                                                    forceSelection: false
                                                }]
                                        }]
                                },
                                fieldsetPersonaJuridica
                            ]
                        }]
                }, {
                    title: 'Info. financiera',
                    autoScroll: true,
                    height: 400,
                    items: [{
                            xtype: 'fieldset',
                            title: 'Información financiera',
                            width: 640,
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
                                    title: '',
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
                                            height: 150,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Activos Totales',
                                                    name: 'activostotales',
                                                    id: 'activostotales',
                                                    width: 220,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Activos Corrientes',
                                                    name: 'activoscorrientes',
                                                    id: 'activoscorrientes',
                                                    width: 260,
                                                    labelWidth: 150,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10,
                                                    width: 500,
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Pasivos Totales',
                                                    name: 'pasivostotales',
                                                    id: 'pasivostotales',
                                                    width: 220,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Pasivos Corrientes',
                                                    name: 'pasivoscorrientes',
                                                    id: 'pasivoscorrientes',
                                                    width: 260,
                                                    labelWidth: 150,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10,
                                                    width: 500,
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Inventarios',
                                                    name: 'inventarios',
                                                    id: 'inventarios',
                                                    width: 220,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Patrimonios',
                                                    name: 'patrimonios',
                                                    id: 'patrimonios',
                                                    width: 260,
                                                    labelWidth: 150,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10,
                                                    width: 500,
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Utilidades',
                                                    name: 'utilidades',
                                                    id: 'utilidades',
                                                    width: 220,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }, {
                                                    xtype: 'numberfield',
                                                    value: '0',
                                                    fieldLabel: 'Ventas',
                                                    name: 'ventas',
                                                    id: 'ventas',
                                                    width: 260,
                                                    labelWidth: 150,
                                                    listeners: {
                                                        blur: function (e, eOpts) {
                                                            calculo();
                                                        }
                                                    }
                                                }]
                                        }]

                                }]
                        }, {
                            xtype: 'fieldset',
                            title: 'Información financiera',
                            width: 640,
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
                                    title: '',
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
                                            height: 150,
                                            msgTarget: 'under',
                                            layout: 'column',
                                            defaults: {
                                                flex: 2,
                                                hideLabel: false
                                            },
                                            items: [{
                                                    xtype: 'textfield',
                                                    value: '0',
                                                    fieldLabel: 'Activos en SMMLV',
                                                    name: 'activosSMMLV',
                                                    id: 'activosSMMLV',
                                                    editable: false,
                                                    width: 220,
                                                }, {
                                                    xtype: 'textfield',
                                                    value: '0',
                                                    fieldLabel: 'Indice de liquidez',
                                                    name: 'indiceliquidez',
                                                    id: 'indiceliquidez',
                                                    editable: false,
                                                    width: 275,
                                                    labelWidth: 150,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10,
                                                    width: 500,
                                                }, {
                                                    xtype: 'textfield',
                                                    value: '0',
                                                    fieldLabel: 'Indice endeudamiento',
                                                    name: 'indiceendeudamiento',
                                                    id: 'indiceendeudamiento',
                                                    editable: false,
                                                    width: 220,
                                                }, {
                                                    xtype: 'textfield',
                                                    value: '0',
                                                    fieldLabel: 'Prueba ácida',
                                                    name: 'pruebaacida',
                                                    id: 'pruebaacida',
                                                    editable: false,
                                                    width: 275,
                                                    labelWidth: 150,
                                                }, {
                                                    xtype: 'tbspacer',
                                                    height: 10,
                                                    width: 500,
                                                }, {
                                                    xtype: 'textfield',
                                                    value: '0',
                                                    fieldLabel: 'INO',
                                                    id: 'ino',
                                                    editable: false,
                                                    name: 'ino',
                                                    width: 220,
                                                }]
                                        }]

                                }]
                        }]
                }, {
                    title: 'Documentos',
                    id: 'documentosTab',
                    items: [
                        gridControlFinanciero
                    ]
                }]
        });

        Ext.create('Ext.form.Panel', {
            title: 'Control Financiero de Documentos.<br /><?= $razonSocial ?>',
            stripeRows: true,
            height: 535,
            width: 660,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            defaultType: 'textfield',
            items: [
                tabPanel
            ],
            listeners: {
                afterRender: function (panel, eOpts) {
                    panel.getForm().setValues(<?= json_encode($data) ?>);
                    recarga();
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
                                    var store = gridControlFinanciero.getStore();
                                    ids = res.ids;
                                    if (res.ids) {
                                        for (i = 0; i < ids.length; i++) {
                                            var rec = store.getById(ids[i]);
                                            rec.commit();
                                        }
                                        Ext.MessageBox.alert("Mensaje", 'Información almacenada correctamente<br>');
                                        recarga();
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
    function calculo() {
        var activosSMMLV = Ext.getCmp("activosSMMLV");
        var indiceliquidez = Ext.getCmp("indiceliquidez");
        var indiceendeudamiento = Ext.getCmp("indiceendeudamiento");
        var pruebaacida = Ext.getCmp("pruebaacida");
        var ino = Ext.getCmp("ino");

        var activostotales = Ext.getCmp("activostotales").value;
        var activoscorrientes = Ext.getCmp("activoscorrientes").value;
        var pasivostotales = Ext.getCmp("pasivostotales").value;
        var pasivoscorrientes = Ext.getCmp("pasivoscorrientes").value;
        var inventarios = Ext.getCmp("inventarios").value;
        var patrimonios = Ext.getCmp("patrimonios").value;
        var utilidades = Ext.getCmp("utilidades").value;
        var ventas = Ext.getCmp("ventas").value;

        <? if ($minimo) { ?>
            activosSMMLV.setValue(activostotales /<?= $minimo ?>);
        <? } ?>
        if (pasivoscorrientes != 0) {
            indiceliquidez.setValue(activoscorrientes / pasivoscorrientes);
        } else {
            indiceliquidez.setValue("Imposible Calcular");
        }
        if (activostotales != 0) {
            indiceendeudamiento.setValue(pasivostotales / activostotales);
        } else {
            indiceendeudamiento.setValue("Imposible Calcular");
        }
        if (pasivoscorrientes != 0) {
            pruebaacida.setValue((activoscorrientes - inventarios) / pasivoscorrientes);
        } else {
            pruebaacida.setValue("Imposible Calcular");
        }
    }
    function recarga() {

        var tip = Ext.getCmp("tipopersona");

        if (tip != "") {
            var activostotales = Ext.getCmp("activostotales").value;
            var fechconstitucion = Ext.getCmp("fechaconstitucion").value;
            var tipopersona = Ext.getCmp("tipopersona");
            var sectoreconomico = Ext.getCmp("sectoreconomico");
            var grancontribuyente = Ext.getCmp("grancontribuyente");
            var sectoreconomico = Ext.getCmp("sectoreconomico");
            var uap = Ext.getCmp("uap");

            if (tipopersona.value == 2) {
                fieldsetPersonaJuridica.setVisible(true);
            }

            var tipo = "";

            if (tipopersona.value == 1 && sectoreconomico.value == 10) {  //comercio y persona natural
                tipo = "ca_persona_natural_comerciante";
            } else {
                if (tipopersona.value == 1) {
                    tipo = "ca_persona_natural";
                } else {
                    if (tipopersona.value == 2) {
                        tipo = "ca_perjuridica";

                        if (grancontribuyente.value || uap.value) {
                            tipo = "ca_gran_contribuyente";
                        }
                    }
                }
            }
            if (tipo.toString() != "" && fechconstitucion.toString() != "") {
                var store = gridControlFinanciero.getStore();
                store.load({
                    params: {
                        idcliente: <?= $idcliente ?>,
                        tipo: tipo,
                        fechconstitucion: fechconstitucion,
                        activostotales: activostotales
                    }
                });
                gridControlFinanciero.setVisible(true);
                calculo();



            }
        }
    }
</script>