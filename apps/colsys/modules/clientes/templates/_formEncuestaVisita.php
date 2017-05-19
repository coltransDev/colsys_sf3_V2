<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$contactos = $sf_data->getRaw("concliente");
$sucursales = $sf_data->getRaw("succliente");
?>
<style>
    .boxLabelTitle {
        font-weight: bold;
        font-style: italic;
        vertical-align: top;
    }
    .boxLabel {
        font-style: italic;
        text-align: justify;
    }
</style>
<script type="text/javascript">
    var win_encuesta = null;
    var win_imprimir = null;

    Ext.onReady(function () {

        Ext.define('EncuestaVisita', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idencuesta', type: 'string'},
                {name: 'idcontacto', type: 'string'},
                {name: 'idsucursal', type: 'string'},
                {name: 'contacto', type: 'string'},
                {name: 'fchvisita', type: 'string'},
                {name: 'instalaciones_tipo', type: 'string'},
                {name: 'instalaciones_otro', type: 'string'},
                {name: 'instalaciones_pertenencia', type: 'string'},
                {name: 'instalaciones_uso', type: 'string'},
                {name: 'instalaciones_vivienda', type: 'string'},
                {name: 'instalaciones_condiciones', type: 'string'},
                {name: 'sistema_seguridad', type: 'string'},
                {name: 'sistema_seguridad_otro', type: 'string'},
                {name: 'manejo_mercancias', type: 'string'},
                {name: 'manejo_mercancias_zona', type: 'string'},
                {name: 'manejo_mercancias_detalles', type: 'string'},
                {name: 'manejo_mercancias_procedimiento', type: 'string'},
                {name: 'areas_sensibles', type: 'string'},
                {name: 'control_empleados', type: 'string'},
                {name: 'control_visitantes', type: 'string'},
                {name: 'prevencion_lavado_activos', type: 'string'},
                {name: 'certificaciones', type: 'string'},
                {name: 'certificaciones_otro', type: 'string'},
                {name: 'implementacion_sistema', type: 'string'},
                {name: 'implementacion_sistema_detalles', type: 'string'},
                {name: 'recomienda_trabajar', type: 'string'},
                {name: 'concepto_seguridad', type: 'string'},
                {name: 'observaciones', type: 'string'},
            ]
        });

        Ext.define('ComboContactos', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-contactos',
            queryMode: 'local',
            valueField: 'idcontacto',
            displayField: 'nombre',
            store: {
                fields: [{name: 'idcontacto', type: 'string'}, {name: 'nombre', type: 'string'}],
                data: <?= json_encode($contactos) ?>
            }
        });

        Ext.define('ComboSucursales', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-sucursales',
            queryMode: 'local',
            valueField: 'idsucursal',
            displayField: 'direccion',
            store: {
                fields: [{name: 'idsucursal', type: 'string'}, {name: 'direccion', type: 'string'}],
                data: <?= json_encode($sucursales) ?>
            }
        });

        var checkBoxInstItems = [
            {boxLabel: 'Local', name: 'instalaciones_tipo', inputValue: 'Local'},
            {boxLabel: 'Oficina', name: 'instalaciones_tipo', inputValue: 'Oficina'},
            {boxLabel: 'Bodega', name: 'instalaciones_tipo', inputValue: 'Bodega'},
            {boxLabel: 'Casa', name: 'instalaciones_tipo', inputValue: 'Casa'},
            {boxLabel: 'Apartamento', name: 'instalaciones_tipo', inputValue: 'Apartamento'},
            {boxLabel: 'Planta/Producción', name: 'instalaciones_tipo', inputValue: 'Planta/Producción'},
        ];

        Ext.define('CheckInstalaciones', {
            id: 'checkboxInst',
            extend: 'Ext.form.CheckboxGroup',
            alias: 'widget.check-instalaciones',
            xtype: 'checkboxgroup',
            columns: 3,
            vertical: false,
            items: checkBoxInstItems,
            checkItems: function (itemsChecked) {
                var checked = itemsChecked.split(",");
                this.items.each(function (checkItem, index, totalCount) {
                    if (checked.indexOf(checkItem.boxLabel) != -1) {
                        checkItem.setValue(1);
                    }
                });
            }
        });

        Ext.define('ComboPertenencia', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-pertenencia',
            store: ['Propia', 'Arrendado', 'Otro']
        });

        Ext.define('ComboUso', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-uso',
            store: ['Exclusivo', 'Compartido']
        });

        Ext.define('ComboCondiciones', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-condiciones',
            store: ['Normal', 'Lujosas', 'Otro']
        });

        var checkBoxSeguItems = [
            {boxLabel: 'Alarma', name: 'sistema_seguridad', inputValue: 'Alarma'},
            {boxLabel: 'Biométricos', name: 'sistema_seguridad', inputValue: 'Biométricos'},
            {boxLabel: 'CCTV', name: 'sistema_seguridad', inputValue: 'CCTV'},
            {boxLabel: 'Vigilancia_Privada', name: 'sistema_seguridad', inputValue: 'Vigilancia_Privada'},
            {boxLabel: 'Todos', name: 'sistema_seguridad', inputValue: 'Todos'},
            {boxLabel: 'Ninguno', name: 'sistema_seguridad', inputValue: 'Ninguno'}
        ];

        Ext.define('CheckSeguridad', {
            id: 'checkboxSegu',
            extend: 'Ext.form.CheckboxGroup',
            alias: 'widget.check-seguridad',
            xtype: 'checkboxgroup',
            columns: 3,
            vertical: false,
            items: checkBoxSeguItems,
            listeners: {
                change: function (checkBox, newValue, oldValue, eOpts) {
                    if (Ext.Object.isEmpty(oldValue)) {
                        if (newValue.sistema_seguridad.indexOf('Todos') != -1) {
                            this.items.each(function (checkItem, index, totalCount) {
                                if (checkItem.inputValue != 'Ninguno' && checkItem.inputValue != 'Todos') {
                                    checkItem.setValue(1);
                                } else {
                                    checkItem.setValue(0);
                                }
                            });
                        }
                    } else if (!Ext.Object.isEmpty(oldValue)) {
                        if (newValue.sistema_seguridad) {
                            if (newValue.sistema_seguridad.indexOf('Ninguno') != -1) {
                                this.items.each(function (checkItem, index, totalCount) {
                                    if (checkItem.inputValue != 'Ninguno') {
                                        checkItem.setValue(0);
                                    }
                                });
                            }
                        }
                    }
                }
            },
            checkItems: function (itemsChecked) {
                var checked = itemsChecked.split(",");
                this.items.each(function (checkItem, index, totalCount) {
                    if (checked.indexOf(checkItem.boxLabel) != -1) {
                        checkItem.setValue(1);
                    }
                });
            }
        });

        var checkBoxCertItems = [
            {boxLabel: 'ISO_9001', name: 'certificacion', inputValue: 'ISO_9001'},
            {boxLabel: 'ISO_14001', name: 'certificacion', inputValue: 'ISO_14001'},
            {boxLabel: 'ISO_18001', name: 'certificacion', inputValue: 'ISO_18001'},
            {boxLabel: 'ISO_28000', name: 'certificacion', inputValue: 'ISO_28000'},
            {boxLabel: 'BASC', name: 'certificacion', inputValue: 'BASC'},
            {boxLabel: 'C-PAT', name: 'certificacion', inputValue: 'C-PAT'},
            {boxLabel: 'OEA', name: 'certificacion', inputValue: 'OEA'},
            {boxLabel: 'NINGUNO', name: 'certificacion', inputValue: 'NINGUNO'},
            {boxLabel: 'OTRA', name: 'certificacion', inputValue: 'OTRA'}
        ];

        Ext.define('CheckCertificaciones', {
            id: 'checkboxCert',
            extend: 'Ext.form.CheckboxGroup',
            alias: 'widget.check-certificaciones',
            xtype: 'checkboxgroup',
            columns: 5,
            vertical: true,
            items: checkBoxCertItems,
            listeners: {
                change: function (checkBox, newValue, oldValue, eOpts) {
                    if (Ext.Object.isEmpty(newValue)) {
                        Ext.getCmp("cert_otro").setDisabled(true);
                    } else {
                        this.items.each(function (checkItem, index, totalCount) {
                            if (checkItem.inputValue == 'OTRA') {
                                Ext.getCmp("cert_otro").setDisabled(!checkItem.checked);
                            }
                        });
                    }
                    if (!Ext.Object.isEmpty(oldValue)) {
                        if (newValue.certificacion) {
                            if (newValue.certificacion.indexOf('NINGUNO') != -1) {
                                Ext.getCmp("cert_otro").setDisabled(true);
                                this.items.each(function (checkItem, index, totalCount) {
                                    if (checkItem.inputValue != 'NINGUNO') {
                                        checkItem.setValue(0);
                                    }
                                });
                            }
                        }
                    }
                }
            },
            checkItems: function (itemsChecked) {
                var checked = itemsChecked.split(",");
                this.items.each(function (checkItem, index, totalCount) {
                    if (checked.indexOf(checkItem.boxLabel) != -1) {
                        checkItem.setValue(1);
                    }
                });
            }
        });

        Ext.define('ComboSiNo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-si-no',
            store: ['SI', 'NO']
        });


        var storeEncuestaVisita = Ext.create('Ext.data.Store', {
            autoLoad: true,
            model: 'EncuestaVisita',
            proxy: {
                type: 'ajax',
                url: '<?= url_for('clientes/datosEncuestaVisita') ?>',
                reader: {
                    type: 'json',
                    root: 'root'
                },
                extraParams: {
                    idcliente: '<?= $idcliente ?>'
                },
                // Parameter name to send filtering information in
                filterParam: 'query'
            }
        });

        var formEncuestaVisita = Ext.create('Ext.form.Panel', {
            items: {
                xtype: 'panel',
                height: 611,
                bodyPadding: 4,
                defaults: {
                    anchor: '100%',
                    labelWidth: 60
                },
                fieldDefaults: {
                    anchor: '100%'
                },
                layout: {
                    type: 'vbox',
                    align: 'stretch'
                },
                items: [{
                        xtype: 'fieldcontainer',
                        fieldLabel: 'Contacto',
                        combineErrors: true,
                        msgTarget: 'side',
                        layout: 'hbox',
                        defaults: {
                            allowBlank: false,
                            flex: 1
                        },
                        items: [{
                                xtype: 'combo-contactos',
                                name: 'idcontacto',
                                forceSelection: true,
                                allowBlank: false,
                                editable: false
                            }, {
                                fieldLabel: 'Suc.',
                                labelWidth: 30,
                                xtype: 'combo-sucursales',
                                name: 'idsucursal',
                                // forceSelection: true,    /*FIX-ME Habilitar con el nuevo módulo de clientes, para que exija la sucursal*/
                                allowBlank: true,
                                editable: false
                            }, {
                                fieldLabel: 'Fecha Visita',
                                labelWidth: 80,
                                xtype: 'datefield',
                                name: 'fchvisita'
                            }
                        ]
                    }, {
                        xtype: 'fieldset',
                        title: 'Infraestructura',
                        collapsible: false,
                        defaults: {
                            anchor: '100%',
                            margin: '1 2 0 2',
                            allowBlank: false
                        },
                        layout: 'column',
                        items: [{
                                fieldLabel: '¿Tipo de instalaciones?',
                                labelWidth: 145,
                                xtype: 'check-instalaciones',
                                forceSelection: true,
                                columnWidth: 0.72
                            }, {
                                xtype: 'textfield',
                                labelWidth: 40,
                                fieldLabel: 'Otras',
                                name: 'instalaciones_otro',
                                allowBlank: true,
                                columnWidth: 0.28
                            }, {
                                fieldLabel: '¿Uso de las instalaciones?',
                                labelWidth: 170,
                                xtype: 'combo-uso',
                                forceSelection: true,
                                name: 'instalaciones_uso',
                                columnWidth: 0.5
                            }, {
                                fieldLabel: '¿Tipo de pertenencia?',
                                labelWidth: 150,
                                xtype: 'combo-pertenencia',
                                forceSelection: true,
                                name: 'instalaciones_pertenencia',
                                columnWidth: 0.5
                            }, {
                                fieldLabel: '¿Es al mismo tiempo lugar de Vivienda?',
                                labelWidth: 170,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'instalaciones_vivienda',
                                columnWidth: 0.45
                            }, {
                                fieldLabel: '¿Condiciones físicas acorde con el objeto social?',
                                labelWidth: 230,
                                xtype: 'combo-condiciones',
                                forceSelection: true,
                                name: 'instalaciones_condiciones',
                                columnWidth: 0.55
                            }, {
                                fieldLabel: '¿Cuenta con sistemas de seguridad y/o Vigilancia?',
                                labelWidth: 160,
                                xtype: 'check-seguridad',
                                forceSelection: true,
                                columnWidth: 0.75
                            }, {
                                xtype: 'textfield',
                                labelWidth: 40,
                                fieldLabel: 'Otras',
                                name: 'sistema_seguridad_otro',
                                allowBlank: true,
                                columnWidth: 0.25
                            }
                        ]
                    }, {
                        xtype: 'fieldset',
                        title: 'Seguridad',
                        collapsible: false,
                        defaults: {
                            anchor: '100%',
                            margin: '1 2 0 2',
                            allowBlank: false
                        },
                        layout: 'column',
                        items: [{
                                fieldLabel: '¿Tiene control para el ingreso y/o salida de empleados?',
                                labelWidth: 250,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'control_empleados',
                                columnWidth: 0.50
                            }, {
                                fieldLabel: '¿Tiene control para el ingreso y/o salida de visitantes?',
                                labelWidth: 250,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'control_visitantes',
                                columnWidth: 0.50
                            }, {
                                fieldLabel: '¿Se realiza cargue y/o descargue de mercancía dentro de las instalaciones?',
                                labelWidth: 250,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias',
                                columnWidth: 0.50
                            }, {
                                fieldLabel: '¿Cuenta con un procedimiento para cargue y/o descargue de la mercancía?',
                                labelWidth: 250,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias_procedimiento',
                                columnWidth: 0.50
                            }, {
                                fieldLabel: '¿Tiene controles de acceso a la zona de cargue y descargue de mercancias?',
                                labelWidth: 250,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias_zona',
                                columnWidth: 0.50
                            }, {
                                xtype: 'textfield',
                                labelWidth: 70,
                                fieldLabel: '¿Cuales controles? ',
                                name: 'manejo_mercancias_detalles',
                                columnWidth: 0.50,
                                allowBlank: true
                            }, {
                                fieldLabel: '¿Dispone de un plano de áreas sensibles?',
                                labelWidth: 130,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'areas_sensibles',
                                columnWidth: 0.30
                            }, {
                                fieldLabel: '¿Tiene un procedimiento documentado para la prevención del lavado de activos y financiación del terrorismo?',
                                labelWidth: 340,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'prevencion_lavado_activos',
                                columnWidth: 0.70
                            }, {
                                fieldLabel: '¿Cuenta con certificación en sistemas de calidad?',
                                labelWidth: 150,
                                xtype: 'check-certificaciones',
                                columnWidth: 0.79
                            }, {
                                id: 'cert_otro',
                                xtype: 'textfield',
                                name: 'certificacion_otro',
                                allowBlank: false,
                                disabled: true,
                                columnWidth: 0.21
                            }, {
                                fieldLabel: '¿Tiene planeado implementar un sistema de calidad y/o seguridad?',
                                labelWidth: 210,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'implementacion_sistema',
                                columnWidth: 0.40
                            }, {
                                fieldLabel: '¿Cuál y Cuando?',
                                labelWidth: 60,
                                xtype: 'textfield',
                                maxLength: 128,
                                allowBlank: true,
                                name: 'implementacion_sistema_detalles',
                                columnWidth: 0.60
                            }
                        ]
                    }, {
                        xtype: 'container',
                        collapsible: false,
                        defaults: {
                            anchor: '100%',
                            margin: '1 2 0 2',
                            allowBlank: false
                        },
                        layout: 'column',
                        items: [{
                                fieldLabel: '¿Recomienda trabajar con el cliente?',
                                labelWidth: 220,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'recomienda_trabajar',
                                columnWidth: 0.40
                            }, {
                                xtype: 'displayfield',
                                columnWidth: 0.60
                            }, {
                                xtype: 'fieldset',
                                title: 'Concepto de seguridad',
                                collapsible: false,
                                anchor: '100%',
                                margin: '1 2 0 2',
                                columnWidth: 0.495,
                                items: {
                                    xtype: 'textareafield',
                                    width: 343,
                                    height: 55,
                                    name: 'concepto_seguridad',
                                    allowBlank: false
                                }
                            }, {
                                xtype: 'fieldset',
                                title: 'Observaciones',
                                collapsible: false,
                                anchor: '100%',
                                margin: '1 2 0 2',
                                columnWidth: 0.495,
                                items: {
                                    xtype: 'textareafield',
                                    name: 'observaciones',
                                    width: 343,
                                    height: 55,
                                    allowBlank: false
                                }
                            }
                        ]
                    }
                ]
            },
            setReadOnlyForAll: function (readOnly) {
                Ext.suspendLayouts();
                this.getForm().getFields().each(function (field) {
                    field.setReadOnly(readOnly);
                });
                if (readOnly)
                    Ext.getCmp('bntGuardar').setVisible(false);
                else
                    Ext.getCmp('bntGuardar').setVisible(true);

                Ext.resumeLayouts();
            },
            dockedItems: {
                xtype: 'toolbar',
                dock: 'bottom',
                ui: 'footer',
                buttonAlign: 'right',
                items: [{
                        xtype: 'label',
                        text: 'Importante',
                        maxWidth: 70,
                        cls: 'boxLabelTitle'
                    }, {
                        xtype: 'label',
                        text: 'Si el cliente tiene bodegas y/o planta de producción para el manejo de la carga en un lugar diferente al de esta visita, se debe realizar la visita de verificación a dichas instalaciones.',
                        maxWidth: 430,
                        cls: 'boxLabel'
                    }, '->', {
                        id: 'bntGuardar',
                        text: 'Guardar',
                        width: 120,
                        handler: function () {
                            var me = this;
                            var form = me.up('form').getForm();
                            var data = form.getFieldValues();

                            var inst = [];
                            for (var i = 0; i < data.instalaciones_tipo.length; i++) {
                                if (data.instalaciones_tipo[i]) {
                                    inst.push(checkBoxInstItems[i].inputValue);
                                }
                            }
                            data.instalaciones_tipo = inst.toString();

                            var segu = [];
                            for (var i = 0; i < data.sistema_seguridad.length; i++) {
                                if (data.sistema_seguridad[i]) {
                                    segu.push(checkBoxSeguItems[i].inputValue);
                                }
                            }
                            data.sistema_seguridad = segu.toString();

                            var cert = [];
                            for (var i = 0; i < data.certificacion.length; i++) {
                                if (data.certificacion[i]) {
                                    cert.push(checkBoxCertItems[i].inputValue);
                                }
                            }
                            data.certificacion = cert.toString();
                            var str = JSON.stringify(data);

                            if (form.isValid()) {
                                Ext.Ajax.request({
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?= url_for('clientes/guardarEncuestaVisita') ?>',
                                    params: {
                                        datos: str
                                    },
                                    failure: function (response, options) {
                                        var res = Ext.util.JSON.decode(response.responseText);
                                        if (res.errorInfo)
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                        else
                                            Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                    },
                                    success: function (response, options) {
                                        me.findParentByType('window').close();
                                        store = storeEncuestaVisita;
                                        store.reload();
                                        Ext.MessageBox.alert("Mensaje", 'Encuesta almacenada correctamente<br>');
                                    }
                                });
                            }
                        }
                    }, {
                        text: 'Cancelar',
                        width: 120,
                        handler: function () {
                            this.findParentByType('window').close();
                        }
                    }
                ]
            }
        });

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridEncuestaVisita',
            title: 'Control Encuestas de Visita a Clientes',
            store: storeEncuestaVisita,
            renderTo: 'se-form',
            stripeRows: true,
            height: 400,
            width: 1000,
            style: {
                "margin-top": "20px",
                "margin-left": "auto",
                "margin-right": "auto"
            },
            columns: [{
                    header: 'Contacto',
                    dataIndex: 'contacto',
                    width: 200
                }, {
                    header: 'Fecha Visita',
                    width: 120,
                    dataIndex: 'fchvisita'
                }, {
                    header: 'Observaciones',
                    flex: 1,
                    width: 120,
                    dataIndex: 'observaciones'
                }, {
                    header: 'Concepto de Seguridad',
                    flex: 1,
                    width: 180,
                    dataIndex: 'concepto_seguridad'
                }, {
                    header: 'Recomienda trabajar con el Cliente',
                    width: 240,
                    dataIndex: 'recomienda_trabajar'
                }, {
                    header: 'Opción',
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 60,
                    items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Consultar la Encuesta',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_encuesta == null) {
                                    win_encuesta = new Ext.Window({
                                        id: 'winEncuestaVisita',
                                        y: 40,
                                        width: 800,
                                        height: 680,
                                        header: false,
                                        initCenter : false,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formEncuestaVisita
                                        },
                                        listeners: {
                                            close: function (panel, eOpts) {
                                                win_encuesta = null;
                                            }
                                        }
                                    });
                                }
                                var checkBox = Ext.getCmp("checkboxInst");
                                checkBox.checkItems(rec.data.instalaciones_tipo);
                                var checkBox = Ext.getCmp("checkboxSegu");
                                checkBox.checkItems(rec.data.sistema_seguridad);
                                var checkBox = Ext.getCmp("checkboxCert");
                                checkBox.checkItems(rec.data.certificaciones);

                                win_encuesta.down('form').loadRecord(rec);
                                win_encuesta.down('form').setReadOnlyForAll(true);
                                win_encuesta.show();
                            }
                        }, {
                            iconCls: 'page_white_acrobat',
                            tooltip: 'Imprimir en PDF',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_imprimir == null) {
                                    win_imprimir = new Ext.Window({
                                        title: 'Vista Preliminar del Documento',
                                        closeAction: 'close',
                                        height: 900,
                                        width: 800,
                                        y: 40,
                                        items: [{
                                                xtype: 'component',
                                                itemId: 'panel-document-preview',
                                                autoEl: {
                                                    tag: 'iframe',
                                                    width: '100%',
                                                    height: '100%',
                                                    frameborder: '0',
                                                    scrolling: 'auto',
                                                    src: '<?= url_for('clientes/imprimirEncuestaVisita') ?>' + '/id/' + rec.data.idencuesta
                                                }
                                            }],
                                        listeners: {
                                            close: function (panel, eOpts) {
                                                win_imprimir = null;
                                            }
                                        }
                                    })
                                }
                                win_imprimir.show();
                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Anular la Encuesta',
                            handler: function (grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular la encuesta?', function (choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("clientes/anularEncuestaVisita") ?>',
                                            params: {
                                                idencuesta: rec.data.idencuesta
                                            },
                                            failure: function (response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function (response, options) {
                                                var res = Ext.JSON.decode(response.responseText);
                                                if (res.success) {
                                                    store = storeEncuestaVisita;
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
                                if (win_encuesta == null) {
                                    win_encuesta = new Ext.Window({
                                        id: 'winEncuestaVisita',
                                        y: 40,
                                        width: 800,
                                        height: 680,
                                        header: false,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formEncuestaVisita
                                        },
                                        listeners: {
                                            close: function (panel, eOpts) {
                                                win_encuesta = null;
                                            }
                                        }
                                    })
                                }
                                rec = Ext.create('EncuestaVisita', {});
                                win_encuesta.down('form').loadRecord(rec);
                                win_encuesta.down('form').setReadOnlyForAll(false);
                                win_encuesta.show();
                            }
                        }, {
                            text: 'Regresar',
                            tooltip: 'Regresar al Menú de Búsqueda',
                            iconCls: 'refresh',
                            scope: this,
                            handler: function () {
                                //document.location.href = "/colsys_php/clientes.php?modalidad=N.i.t.&criterio=<?= $idcliente ?>";
                            }
                        }, {
                            text: 'Encuesta Anterior',
                            tooltip: 'Ir al formato de Encuesta anterior',
                            iconCls: 'page_white_edit',
                            scope: this,
                            handler: function () {
                                document.location.href = "/colsys_php/enccliente.php?id=<?= $idcliente ?>";
                            }
                        }, {
                            text: 'Formato en Blanco',
                            tooltip: 'Imprimir un Formato en Blanco',
                            iconCls: 'page_white_edit',
                            scope: this,
                            handler: function () {
                                document.location.href = "/clientes/imprimirEncuestaVisita";
                            }
                        }]
                }],
            // paging bar on the bottom
            bbar: Ext.create('Ext.PagingToolbar', {
                store: storeEncuestaVisita,
                displayInfo: true,
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            })
        });

    });
</script>