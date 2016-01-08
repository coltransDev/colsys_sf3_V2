<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$idcliente = $sf_data->getRaw("idcliente");
$contactos = $sf_data->getRaw("concliente");
?>
<script type="text/javascript">
    var win_encuesta = null;

    Ext.onReady(function() {

        Ext.define('EncuestaVisita', {
            extend: 'Ext.data.Model',
            fields: [
                {name: 'idencuesta', type: 'string'},
                {name: 'idcontacto', type: 'string'},
                {name: 'contacto', type: 'string'},
                {name: 'fchvisita', type: 'string'},
                {name: 'politica_seguridad_salud', type: 'string'},
                {name: 'mano_obra_infantil', type: 'string'},
                {name: 'peligros_riesgos_identificados', type: 'string'},
                {name: 'peligros_riesgos_identificar', type: 'string'},
                {name: 'riesgos_control', type: 'string'},
                {name: 'requisitos_legales_conocimiento', type: 'string'},
                {name: 'requisitos_legales_aplicacion', type: 'string'},
                {name: 'requisitos_legales_detalles', type: 'string'},
                {name: 'pago_seguridad_social', type: 'string'},
                {name: 'panorama_riesgos', type: 'string'},
                {name: 'respuesta_emergencias', type: 'string'},
                {name: 'numero_personas', type: 'string'},
                {name: 'instalaciones_tipo', type: 'string'},
                {name: 'instalaciones_pertenencia', type: 'string'},
                {name: 'instalaciones_uso', type: 'string'},
                {name: 'areas_sensibles', type: 'string'},
                {name: 'areas_autorizadas', type: 'string'},
                {name: 'sistema_seguridad', type: 'string'},
                {name: 'manejo_mercancias', type: 'string'},
                {name: 'certificacion', type: 'string'},
                {name: 'certificacion_detalles', type: 'string'},
                {name: 'implementacion_plan', type: 'string'},
                {name: 'implementacion_plan_detalles', type: 'string'},
                {name: 'evaluacion_terceros', type: 'string'},
                {name: 'evaluacion_personal', type: 'string'},
                {name: 'programas_capacitacion', type: 'string'},
                {name: 'manejo_mercancias_proceso', type: 'string'},
                {name: 'prevencion_lavado_activos', type: 'string'},
                {name: 'manejo_mercancias_zona', type: 'string'},
                {name: 'manejo_mercancias_detalles', type: 'string'},
                {name: 'control_empleados', type: 'string'},
                {name: 'control_empleados_detalles', type: 'string'},
                {name: 'control_visitantes', type: 'string'},
                {name: 'control_visitantes_detalles', type: 'string'},
                {name: 'seguridad_informatica', type: 'string'},
                {name: 'seguridad_informatica_detalles', type: 'string'},
                {name: 'personal_calificado', type: 'string'},
                {name: 'observaciones', type: 'string'},
                {name: 'concepto_seguridad', type: 'string'},
                {name: 'recomienda_trabajar', type: 'string'},
                {name: 'idcontacto', type: 'string'},
                {name: 'fchvisita', type: 'string'}
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

        Ext.define('ComboSiNo', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-si-no',
            store: ['SI', 'NO']
        });

        Ext.define('ComboPertenencia', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-pertenencia',
            store: ['Propias', 'En Arriendo']
        });

        Ext.define('ComboInstalaciones', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-instalaciones',
            store: ['Local', 'Oficina', 'Bodega', 'Apartamento', 'Casa', 'Planta de Produccion', 'Otra']
        });

        Ext.define('ComboUso', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-uso',
            store: ['Exclusivo', 'Compartido']
        });

        Ext.define('ComboCertificaciones', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-certificaciones',
            store: ['ISO', 'BASC', 'OEA', 'OTRA', 'NINGUNA']
        });

        Ext.define('ComboSeguridadInformatica', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-seguridadinformatica',
            store: ['Claves de acceso a computadores', 'Software de proteccion informatica', 'OTRA', 'NINGUNA']
        });

        Ext.define('ComboSeguridadIVigilancia', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-seguridadvigilancia',
            store: ['Alarma', 'CCV', 'Vigilancia Privada', 'OTRA', 'NINGUNA']
        });

        Ext.define('ComboLiberacion', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-liberacion',
            store: ['EXPRESS RELEASE', 'TELEX RELEASE', 'AS AGREED']
        });

        Ext.define('ComboPagadero', {
            extend: 'Ext.form.field.ComboBox',
            alias: 'widget.combo-pagadero',
            store: ['ORIGEN', 'DESTINO']
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
                filterParam: 'query',
            }
        });

        var formEncuestaVisita = Ext.create('Ext.form.Panel', {
            items: {
                xtype: 'tabpanel',
                width: 700,
                height: 525,
                activeTab: 0,
                labelWidth: 400,
                bodyPadding: 10,
                items: [{
                        title: 'Empresa',
                        layout: 'column',
                        items: [{
                                xtype: 'hiddenfield',
                                name: 'idencuesta'
                            }, {
                                fieldLabel: 'Contacto ',
                                labelWidth: 120,
                                xtype: 'combo-contactos',
                                name: 'idcontacto'
                            }, {
                                fieldLabel: 'Fecha de visita ',
                                labelWidth: 110,
                                xtype: 'datefield',
                                name: 'fchvisita'
                            }, {
                                fieldLabel: '¿Tienen documentada una política de seguridad y salud en el trabajo?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'politica_seguridad_salud'
                            }, {
                                fieldLabel: '¿Contrata mano de obra infantil?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'mano_obra_infantil'
                            }, {
                                fieldLabel: '¿Estan identificados plenamente los peligros y riesgos de las actividades de la empresa?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'peligros_riesgos_identificados'
                            }, {
                                fieldLabel: '¿Se tiene establecido un procedimiento para identificar peligros y evaluar los riesgos de las actividades, productos o servicios?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'peligros_riesgos_identificar'
                            }, {
                                fieldLabel: '¿Se ha definido un control a los riesgos identificados?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'riesgos_control'
                            }, {
                                fieldLabel: '¿Conoce los requisitos legales de seguridad y salud ocupacional que le aplican a su organización?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'requisitos_legales_conocimiento'
                            }, {
                                fieldLabel: '¿Se actualiza en los requisitos legales que le aplican?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'requisitos_legales_aplicacion'
                            }, {
                                fieldLabel: '¿Cómo?',
                                labelWidth: 400,
                                xtype: 'textfield',
                                name: 'requisitos_legales_detalles',
                                allowBlank: true,
                                maxLength: 128,
                                maxLengthText: 'Excede el tamaño permitido'
                            }, {
                                fieldLabel: '¿Se realizan pagos oportunos de afiliaciones a todo lo relacionado con seguridad social (ARL,EPS,parafiscales,etc.)?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'pago_seguridad_social'
                            }, {
                                fieldLabel: '¿Existe un panorama de riesgos de todas las actividades de la empresa?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'panorama_riesgos'
                            }, {
                                fieldLabel: '¿Existen planes o procedimientos para responder a situaciones de emergencia y accidentes reduciendo o mitigando los posibles impactos sobre el medio ambiente y la integridad de las personas?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'respuesta_emergencias'
                            }]
                    }, {
                        title: 'Instalaciones',
                        items: [{
                                fieldLabel: '¿Número de personas que labora en la empresa?',
                                labelWidth: 400,
                                xtype: 'numberfield',
                                allowBlank: false,
                                minValue: 0,
                                name: 'numero_personas'
                            }, {
                                fieldLabel: '¿Tipo de las instalaciones?',
                                labelWidth: 400,
                                xtype: 'combo-instalaciones',
                                forceSelection: true,
                                name: 'instalaciones_tipo'
                            }, {
                                fieldLabel: '¿Tipo de pertenencia de las instalaciones?',
                                labelWidth: 400,
                                xtype: 'combo-pertenencia',
                                forceSelection: true,
                                name: 'instalaciones_pertenencia'
                            }, {
                                fieldLabel: '¿Uso de las instalaciones?',
                                labelWidth: 400,
                                xtype: 'combo-uso',
                                forceSelection: true,
                                name: 'instalaciones_uso'
                            }, {
                                fieldLabel: '¿Dispone de un plano con la ubicación de áreas sensibles?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'areas_sensibles'
                            }, {
                                fieldLabel: '¿Estan identificadas y controladas estas áreas para prevenir el acceso no autorizado?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'areas_autorizadas'
                            }, {
                                fieldLabel: '¿Cuenta con sistemas de seguridad y/o Vigilancia?',
                                labelWidth: 400,
                                xtype: 'combo-seguridadvigilancia',
                                forceSelection: true,
                                name: 'sistema_seguridad'
                            }, {
                                fieldLabel: '¿El cargue y descargue de mercancía se realiza dentro de las instalaciones?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias'
                            }]
                    }, {
                        title: 'Procesos',
                        items: [{
                                fieldLabel: '¿Cuenta con certificación en sistemas de calidad?',
                                labelWidth: 400,
                                xtype: 'combo-certificaciones',
                                forceSelection: true,
                                name: 'certificacion'
                            }, {
                                fieldLabel: '   Observaciones',
                                labelWidth: 200,
                                xtype: 'textareafield',
                                name: 'certificacion_detalles',
                                allowBlank: true,
                                width: 555,
                                anchor: '-15',
                                maxLength: 128,
                                maxLengthText: 'Excede el tamaño permitido'
                            }, {
                                fieldLabel: '¿Tiene planteado utilizar un sistema de gestión? (Solo si la respuesta anterior fue NO)',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'implementacion_plan'
                            }, {
                                fieldLabel: '¿Cuál? ¿Cuando?',
                                labelWidth: 400,
                                xtype: 'textfield',
                                maxLength: 128,
                                allowBlank: true,
                                name: 'implementacion_plan_detalles'
                            }, {
                                fieldLabel: '¿Cuenta la empresa con procesos de contratación y evaluación de proveedores, clientes y asociados de negocios?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'evaluacion_terceros'
                            }, {
                                fieldLabel: '¿Cuenta con un procedimiento documentado para evaluar personal propio, subcontratado y temporal?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'evaluacion_personal'
                            }, {
                                fieldLabel: '¿Cuenta con programas de capacitación para sus empleados que incluya entre otros temas: Identificación y reporte de situaciones inusuales y/o sospechosas, actividades ilícitas, procedimientos de seguridad en la cadena logística, etc?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'programas_capacitacion'
                            }, {
                                fieldLabel: '¿Cuenta la empresa con procesos para el cargue y descargue de mercancía?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'manejo_mercancias_proceso'

                            }]
                    }, {
                        title: 'Seguridad',
                        items: [{
                                fieldLabel: '¿Existe un procedimiento documentado para la prevención del Lavado de activos y Financiación del terrorismo?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'prevencion_lavado_activos'
                            }, {
                                xtype: 'fieldset',
                                title: 'Tiene Control de Acceso a',
                                width: 650,
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
                                        fieldLabel: '¿La zona de cargue y descargue?',
                                        combineErrors: true,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 2,
                                            hideLabel: true
                                        },
                                        items: [{
                                                xtype: 'combo-si-no',
                                                value: '',
                                                name: 'manejo_mercancias_zona',
                                                width: 100,
                                                columnWidth: 0.2,
                                                forceSelection: true
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: '¿Qué control?',
                                                name: 'manejo_mercancias_detalles',
                                                columnWidth: 0.8,
                                                width: 400,
                                                allowBlank: true
                                            }]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: '¿Ingreso y salida de Empleados?',
                                        combineErrors: true,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 2,
                                            hideLabel: true
                                        },
                                        items: [{
                                                xtype: 'combo-si-no',                             
                                                name: 'control_empleados',
                                                width: 100,
                                                columnWidth: 0.2,
                                                forceSelection: true
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: '¿Qué control?',
                                                name: 'control_empleados_detalles',
                                                width: 400,
                                                columnWidth: 0.8,
                                                allowBlank: true
                                            }]
                                    }, {
                                        xtype: 'fieldcontainer',
                                        fieldLabel: '¿Ingreso y salida de visitantes?',
                                        combineErrors: true,
                                        msgTarget: 'under',
                                        layout: 'column',
                                        defaults: {
                                            flex: 2,
                                            hideLabel: true
                                        },
                                        items: [{
                                                xtype: 'combo-si-no',
                                                width: 200,
                                                columnWidth: 0.2,
                                                value: '',
                                                name: 'control_visitantes',
                                                forceSelection: true
                                            }, {
                                                xtype: 'textfield',
                                                hideLabel: false,
                                                fieldLabel: '¿Qué control?',
                                                name: 'control_visitantes_detalles',
                                                width: 400,
                                                columnWidth: 0.8,
                                                allowBlank: true
                                            }]
                                    }]
                            }, {
                                fieldLabel: '¿Tiene implementado algún sistema de protección y seguridad informática?',
                                labelWidth: 400,
                                xtype: 'combo-seguridadinformatica',
                                forceSelection: true,
                                name: 'seguridad_informatica'
                            }, {
                                fieldLabel: '¿Cual?',
                                labelWidth: 400,
                                xtype: 'textareafield',
                                allowBlank: true,
                                name: 'seguridad_informatica_detalles'
                            }, {
                                fieldLabel: '¿Cuenta con personal calificado que efectúe el control de calidad, seguridad a los productos y/o servicios que ofrece?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                name: 'personal_calificado'
                            }]
                    }, {
                        title: 'Observaciones',
                        items: [{
                                fieldLabel: 'Observaciones',
                                labelWidth: 300,
                                xtype: 'textareafield',
                                name: 'observaciones',
                                allowBlank: false,
                                width: 555,
                                maxLength: 180,
                                maxLengthText: 'Excede el tamaño permitido'
                            }, {
                                fieldLabel: 'Concepto de seguridad',
                                labelWidth: 300,
                                xtype: 'textareafield',
                                allowBlank: false,
                                width: 555,
                                name: 'concepto_seguridad'
                            }, {
                                fieldLabel: '¿Recomienda trabajar con el cliente?',
                                labelWidth: 400,
                                xtype: 'combo-si-no',
                                forceSelection: true,
                                name: 'recomienda_trabajar'
                            }]
                    }]
            },
            setReadOnlyForAll: function(readOnly) {
                Ext.suspendLayouts();
                this.getForm().getFields().each(function(field) {
                    field.setReadOnly(readOnly);
                });
                if (readOnly)
                    Ext.getCmp('bntGuardar').setVisible(false); 
                else
                    Ext.getCmp('bntGuardar').setVisible(true); 
                    
                Ext.resumeLayouts();
            },
            buttons: [{
                    id: 'bntGuardar',
                    text: 'Guardar', 
                    handler: function() {
                        var me = this;
                        var form = me.up('form').getForm();
                        var data = form.getFieldValues();
                        var str = JSON.stringify(data);

                        if (form.isValid()) {
                            Ext.Ajax.request({
                                waitMsg: 'Guardando cambios...',
                                url: '<?= url_for('clientes/guardarEncuestaVisita') ?>',
                                params: {
                                    datos: str
                                },
                                failure: function(response, options) {
                                    var res = Ext.util.JSON.decode(response.responseText);
                                    if (res.errorInfo)
                                        Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando por favor informe al Depto. de Sistemas<br>' + res.errorInfo);
                                    else
                                        Ext.MessageBox.alert("Mensaje", 'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>' + res.texto);
                                },
                                success: function(response, options) {                     
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
                    handler: function() {
                        this.findParentByType('window').close();
                    }
                }
            ]

        });

        // create the grid
        new Ext.grid.GridPanel({
            id: 'gridEncuestaVisita',
            title: 'Control Encuestas de Visita a Clientes',
            store: storeEncuestaVisita,
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
                    menuDisabled: true,
                    sortable: false,
                    xtype: 'actioncolumn',
                    width: 40,
                    items: [{
                            iconCls: 'page_white_edit',
                            tooltip: 'Consultar la Encuesta',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                if (win_encuesta == null) {
                                    win_encuesta = new Ext.Window({
                                        id: 'winEncuestaVisita',
                                        title: 'Encuesta de Visita',
                                        width: 700,
                                        height: 610,
                                        closeAction: 'close',
                                        items: {
                                            xtype: formEncuestaVisita
                                        }
                                    })
                                }                               
                               
                                win_encuesta.down('form').loadRecord(rec);
                                win_encuesta.down('form').setReadOnlyForAll(true);
                                win_encuesta.show();
                            }
                        }, {
                            iconCls: 'delete',
                            tooltip: 'Anular la Encuesta',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = grid.getStore().getAt(rowIndex);
                                Ext.MessageBox.confirm('Confirmación de Eliminación', 'Está seguro que desea anular la encuesta?', function(choice) {
                                    if (choice == 'yes') {
                                        Ext.Ajax.request({
                                            waitMsg: 'Eliminado...',
                                            url: '<?= url_for("clientes/anularEncuestaVisita") ?>',
                                            params: {                                                
                                                idencuesta: rec.data.idencuesta
                                            },
                                            failure: function(response, options) {
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error guardando los registros.<br>' + response.errorInfo);
                                                success = false;
                                            },
                                            success: function(response, options) {
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
                                    handler: function() {
                                        if (win_encuesta == null) {
                                            win_encuesta = new Ext.Window({
                                                id: 'winEncuestaVisita',
                                                title: 'Encuesta de Visita',
                                                width: 700,
                                                height: 610,
                                                closeAction: 'close',
                                                items: {
                                                    xtype: formEncuestaVisita
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
                                    handler: function() {
                                        document.location.href = "/inoExpo/GestionDocsTransport";
                                    }
                                }, {
                                    text: 'Encuesta Anterior',
                                    tooltip: 'Ir al formato de Encuesta anterior',
                                    iconCls: 'page_white_edit',
                                    scope: this,
                                    handler: function() {
                                        document.location.href = "/colsys_php/enccliente.php?id=<?=$idcliente?>";
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