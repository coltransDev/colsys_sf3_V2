var win_encuesta = null;
Ext.define('Colsys.Crm.GridEncuestaVisita', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridEncuestaVisita',
    id: 'gridEncuestaVisita',
    listeners: {
        afterrender: function (ct, position) {
            var me = this;
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                        autoLoad: true,
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
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/clientes/datosEncuestaVisita',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            extraParams: {
                                idcliente: me.idcliente
                            },
                            // Parameter name to send filtering information in
                            filterParam: 'query'
                        }
                    }),
                    [{
                            header: 'idencuesta',
                            dataIndex: 'idencuesta',
                            hidden: true,
                            editable: false,
                            hiddeable: false
                        }, {
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
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        if (win_encuesta == null) {
                                            win_encuesta = new Ext.Window({
                                                id: 'winEncuestaVisita',
                                                title: 'Encuesta de Visita',
                                                width: 750,
                                                height: 610,
                                                closeAction: 'destroy',
                                                listeners: {
                                                    destroy: function (obj, eOpts)
                                                    {
                                                        win_encuesta = null;
                                                    }
                                                },
                                                items: {
                                                    xtype: 'Colsys.Crm.FormEncuestaVisita',
                                                    id: 'formEncuestaVisita',
                                                    idcliente: me.idcliente,
                                                    idencuesta: rec.get("idencuesta")
                                                }
                                            });
                                        }

                                        // win_encuesta.down('form').loadRecord(rec);
                                        //win_encuesta.down('form').setReadOnlyForAll(true);
                                        win_encuesta.show();
                                    }
                                }, {
                                    iconCls: 'delete',
                                    tooltip: 'Anular la Encuesta',
                                    handler: function (grid, rowIndex, colIndex) {
                                        var rec = grid.getStore().getAt(rowIndex);
                                        Ext.MessageBox.confirm('Confirmaci&oacute;n de Eliminaci&oacute;n', 'Est&aacute; seguro que desea anular la encuesta?', function (choice) {
                                            if (choice == 'yes') {
                                                Ext.Ajax.request({
                                                    waitMsg: 'Eliminado...',
                                                    url: '/clientes/anularEncuestaVisita',
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
                    ]);

            tb = new Ext.toolbar.Toolbar();
            tb.add(
                    {
                        text: 'Adicionar',
                        tooltip: 'Adicionar un registro',
                        iconCls: 'add',
                        scope: this,
                        handler: function () {
                            if (win_encuesta == null) {
                                win_encuesta = new Ext.Window({
                                    id: 'winEncuestaVisita',
                                    title: 'Encuesta de Visita',
                                    width: 750,
                                    height: 610,
                                    closeAction: 'destroy',
                                    listeners: {
                                        destroy: function (obj, eOpts)
                                        {
                                            win_encuesta = null;
                                        }
                                    },
                                    items: {
                                        xtype: 'Colsys.Crm.FormEncuestaVisita',
                                        id: 'formEncuestaVisita',
                                        idcliente: me.idcliente
                                    }
                                });
                            }
//                            rec = Ext.create('EncuestaVisita', {});
                            //rec = Ext.create(me.getStore().getModel(), {});
                            //win_encuesta.down('form').loadRecord(rec);
                            //win_encuesta.down('form').setReadOnlyForAll(false);
                            win_encuesta.show();
                        }
                    },
                    {
                        text: 'Encuesta Anterior',
                        tooltip: 'Ir al formato de Encuesta anterior',
                        iconCls: 'page_white_edit',
                        scope: this,
                        handler: function () {
                            var win = window.open("/colsys_php/enccliente.php?id=" + me.idcliente, '_blank');
                            win.focus();
                        }
                    }
            );
            this.addDocked(tb);
            bbar = new Ext.PagingToolbar({
                dock: 'bottom',
                displayInfo: true,
                store: me.getStore(),
                displayMsg: 'Registros {0} - {1} of {2}',
                emptyMsg: "No hay registros"
            });
            me.addDocked(bbar);
        }
    }
});
