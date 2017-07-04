// Form de Consulta Principal del Cliente - contiene todos los tab panels de informaci�n 
// y men� de opciones x cliente.
winTercero = null;
i = 0;
Ext.define('Colsys.Crm.FormMaster', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormMaster',
    bodyPadding: 5,
    layout: 'anchor',
    autoHeight: true,
    defaults: {
        columnWidth: 1,
        style: "text-align: left",
        labelAlign: 'right'
    },
    listeners: {
        render: function (me, eOpts) {
            this.add(
                    [
                        {
                            xtype: 'fieldset',
                            title: 'Datos Basicos',
                            defaults: {
                                layout: {
                                    type: 'hbox',
                                    defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                                }
                            },
                            items: [{
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Direcci&oacute;n: ', width: 90, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'direccion',
                                            id: "direccion" + this.idcliente,
                                            flex: 1,
                                            border: false
                                        },
                                        {xtype: 'displayfield', value: 'Tel&eacute;fonos: ', width: 95, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'telefonos',
                                            id: "telefonos" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Fax: ', width: 75, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            fieldLabel: '',
                                            name: 'fax',
                                            id: "fax" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Web Site: ', width: 90, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'website',
                                            id: "website" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Email: ', width: 95, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'email',
                                            id: "email" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Tipo NIT: ', width: 75, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'tipoNit',
                                            id: "tipoNit" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Ciudad: ', width: 90, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'ciudad',
                                            id: "ciudad" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Localidad: ', width: 95, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'localidad',
                                            id: "localidad" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Entidad: ', width: 75, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'entidad',
                                            id: "entidad" + this.idcliente,
                                            flex: 1
                                        },
                                    ]
                                }, {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Vendedor: ', width: 90, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'vendedor',
                                            id: "vendedor" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Coord.Aduana: ', width: 95, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'coordinador',
                                            id: "coordinador" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Status: ', width: 75, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'status',
                                            id: "status" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
//                                }, {
//                                    xtype: 'fieldcontainer',
//                                    msgTarget: 'under',
//                                    defaults: {
//                                        hideLabel: true,
//                                        readOnly: true
//                                    },
//                                    items: [
//                                        {xtype: 'displayfield', value: 'Sector: ', width: 85, fieldStyle: 'font-weight:bold;'},
//                                        {
//                                            xtype: 'displayfield',
//                                            cls: 'x-display-field',
//                                            name: 'sector',
//                                            id: "sector" + this.idcliente,
//                                            flex: 1
//                                        }
//                                    ]
                                }
                            ]
                        }, {
                            xtype: 'fieldset',
                            title: 'Perfil Organizacional',
                            defaults: {
                                layout: {
                                    type: 'hbox',
                                    defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
                                }
                            },
                            items: [{
                                    
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Tipo Persona: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'tipo_persona',
                                            id: "tipo_persona" + this.idcliente,
                                            width:  60
                                        },
                                        {xtype: 'displayfield', value: 'Fch.Constituci&oacute;n: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'fechaconstitucion',
                                            id: "fechaconstitucion" + this.idcliente,
                                            width: 90
                                        },
                                        {xtype: 'displayfield', value: 'R&eacute;gimen: ', width: 80, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'regimen',
                                            id: "regimen" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'UAP: ', width: 40, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'uap',
                                            id: "uap" + this.idcliente,
                                            width: 40
                                        },
                                        {xtype: 'displayfield', value: 'Altex: ', width: 40, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'altex',
                                            id: "altex" + this.idcliente,
                                            width: 40
                                        }
                                    ]
                                }, {
                                    
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Nivel Riesgo: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'nivel_riesgo',
                                            id: "nivel_riesgo" + this.idcliente,
                                            width: 60
                                        },
                                        {xtype: 'displayfield', value: 'Actividad Cial.: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'actividad_economica',
                                            id: "actividad_economica" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'C&oacute;digos Ciiu: ', width: 110, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'codigo_ciiu_1',
                                            id: "codigos_ciiu" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Listas Restrictivas: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'lista_clinton',
                                            id: "lista_clinton" + this.idcliente,
                                            width: 60
                                        },
                                        {xtype: 'displayfield', value: '&Uacute;ltima Consulta: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'ultima_consulta',
                                            id: "ultima_consulta" + this.idcliente,
                                            width: 140
                                        },
                                        {xtype: 'displayfield', value: 'Comentario: ', width: 90, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'comentario',
                                            id: "comentario" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {xtype: 'displayfield', value: 'Certificaciones: ', width: 120, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'certificaciones',
                                            id: "certificaciones" + this.idcliente,
                                            flex: 1
                                        },
                                        {xtype: 'displayfield', value: 'Futura Implementaci&oacute;n: ', width: 160, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'plan_implementa',
                                            id: "plan_implementa" + this.idcliente,
                                            width: 40
                                        },
                                        {xtype: 'displayfield', value: '&iquest;Cu&aacute;l y Cuando?: ', width: 130, fieldStyle: 'font-weight:bold;'},
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'estm_implementa',
                                            id: "estm_implementa" + this.idcliente,
                                            flex: 1
                                        }
                                    ]
                                }
                            ]
                        }, {
                            xtype: 'fieldset',
                            title: 'Preferencias',
                            columnWidth: 0.8,
                            style: 'background: #F2F2F2;',
                            items: [
                                {
                                    xtype: 'fieldcontainer',
                                    msgTarget: 'under',
                                    defaults: {
                                        hideLabel: true,
                                        autoHeight: true,
                                        readOnly: true
                                    },
                                    items: [
                                        {
                                            xtype: 'displayfield',
                                            cls: 'x-display-field',
                                            name: 'preferencias',
                                            style: 'height: 100px;',
                                            id: "preferencias" + this.idcliente
                                        }
                                    ]
                                }
                            ]
                        }, {
                            xtype: 'fieldcontainer',
                            msgTarget: 'under',
                            layout: 'hbox',
                            defaults: {
                                hideLabel: true,
                                readOnly: true,
                                title: '',
                                style: 'background: #F2F2F2;',
                                height: 45
                            },
                            items: [{
                                    xtype: 'fieldset',
                                    id: 'fieldset_coltrans' + this.idcliente,
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            msgTarget: 'under',
                                            defaults: {
                                                hideLabel: true,
                                                readOnly: true
                                            },
                                            items: [{
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'coltrans_fecha',
                                                    id: "coltrans_fecha" + this.idcliente
                                                }
                                            ]
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldset',
                                    id: 'fieldset_colmas' + this.idcliente,
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            msgTarget: 'under',
                                            defaults: {
                                                hideLabel: true,
                                                readOnly: true
                                            },
                                            items: [{
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'colmas_fecha',
                                                    id: "colmas_fecha" + this.idcliente
                                                }
                                            ]
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldset',
                                    id: 'fieldset_colotm' + this.idcliente,
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            msgTarget: 'under',
                                            defaults: {
                                                hideLabel: true,
                                                readOnly: true
                                            },
                                            items: [{
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'colotm_fecha',
                                                    id: "colotm_fecha" + this.idcliente
                                                }
                                            ]
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldset',
                                    id: 'fieldset_coldepositos' + this.idcliente,
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            msgTarget: 'under',
                                            defaults: {
                                                hideLabel: true,
                                                readOnly: true
                                            },
                                            items: [{
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'coldepositos_fecha',
                                                    id: "coldepositos_fecha" + this.idcliente
                                                }
                                            ]
                                        }
                                    ]
                                }, {
                                    xtype: 'fieldset',
                                    id: 'fieldset_circular_0170' + this.idcliente,
                                    flex: 1,
                                    items: [{
                                            xtype: 'fieldcontainer',
                                            msgTarget: 'under',
                                            layout: 'hbox',
                                            defaults: {
                                                hideLabel: true,
                                                readOnly: true
                                            },
                                            items: [
                                                {xtype: 'displayfield', value: 'Coltrans: ', id: "labelColtrans" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                                {
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'coltrans',
                                                    flex: 1,
                                                    id: "coltrans" + this.idcliente
                                                },
                                                {xtype: 'displayfield', value: 'Colmas: ', id: "labelColmas" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                                {
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'colmas',
                                                    flex: 1,
                                                    id: "colmas" + this.idcliente
                                                },
                                                {xtype: 'displayfield', value: 'ColOTM: ', id: "labelColOTM" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                                {
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'colotm',
                                                    flex: 1,
                                                    id: "colotm" + this.idcliente
                                                },
                                                {xtype: 'displayfield', value: 'ColDep&oacute;sitos: ', id: "labelColdepositos" + this.idcliente, fieldStyle: 'font-weight:bold;'},
                                                {
                                                    xtype: 'displayfield',
                                                    cls: 'x-display-field',
                                                    name: 'coldepositos',
                                                    flex: 1,
                                                    id: "coldepositos" + this.idcliente
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        }, {
                            xtype: 'fieldcontainer',
                            msgTarget: 'under',
                            layout: 'hbox',
                            defaults: {
                                hideLabel: true,
                                readOnly: true
                            },
                            items: [{
                                    xtype: 'displayfield',
                                    fieldStyle: 'text-align:right;font-size:10px;',
                                    cls: 'x-display-field',
                                    name: 'auditorias',
                                    flex: 1,
                                    id: "auditorias" + this.idcliente
                                }
                            ]
                        }]
                    );

            tb = new Ext.toolbar.Toolbar();
            tb.add({
                text: 'Editar',
                tooltip: 'Editar Cliente',
                iconCls: 'page_white_edit',
                id: 'editarCliente' + me.idcliente,
                align: 'left',
                width: 85,
                handler: function () {
                    if (winTercero == null)
                    {
                        winTercero = new Ext.Window({
                            title: 'Datos del Cliente',
                            height: 600,
                            width: 800,
                            closeAction: 'destroy',
                            id: "winFormEdit" /*+ me.idcliente*/,
                            items: [
                                Ext.create('Colsys.Crm.FormClienteMaster',
                                        {
                                            id: 'FormClienteMaster' + me.idcliente,
                                            name: 'FormClienteMaster' + me.idcliente,
                                            idcliente: me.idcliente,
                                            validacion: false
                                        })
                            ],
                            listeners: {
                                destroy: function (obj, eOpts)
                                {
                                    winTercero = null;
                                    /*Ext.getCmp('FormClienteMaster' + me.idcliente).close();*/
                                }
                            }
                        });
                        winTercero.show();
                    } else
                    {
                        Ext.Msg.alert("Crm", "Existe una ventana abierta de Clientes<br>Por favor cierrela primero");
                    }
                }
            }, {
                text: 'Formatos',
                tooltip: 'Formatos de Informaci&oacute;n del Cliente',
                iconCls: 'application_form_edit',
                id: 'menuFormatos' + me.idcliente,
                //width: 120,
                menu: {
                    xtype: 'menu',
                    items: [{
                            text: 'Encuesta Visita V2',
                            tooltip: 'Nueva Encuesta de Visita',
                            height: 30,
                            iconCls: 'table',
                            id: 'botonNuevaEncuesta' + me.idcliente,
                            handler: function () {

                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('nuevaEncuesta' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Encuestas de Visita',
                                                id: 'nuevaEncuesta' + me.idcliente,
                                                itemId: 'nuevaEncuesta' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [
                                                    Ext.create('Colsys.Crm.GridEncuestaVisita',
                                                            {
                                                                idcliente: me.idcliente,
                                                                id: 'gridNuevaEncuesta' + me.idcliente
                                                            })
                                                ]/*,
                                                 items: [{
                                                 xtype: 'Colsys.Crm.GridEncuestaVisita',
                                                 idcliente: me.idcliente,
                                                 id: 'gridNuevaEncuesta' + me.idcliente
                                                 }
                                                 ]*/
                                            }).show();
                                }
                                tabpanel.setActiveTab('nuevaEncuesta' + me.idcliente);
                            }
                        }, {
                            text: 'Mandatos',
                            tooltip: 'Control Mandatos',
                            height: 30,
                            iconCls: 'report_edit',
                            id: 'botonControlMandatos' + me.idcliente,
                            handler: function () {
                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('ControlMandatos' + me.idcliente) && me.idcliente != "") {
                                    tabpanel.add(
                                            {
                                                title: 'Mandatos y Poderes',
                                                id: 'ControlMandatos' + me.idcliente,
                                                itemId: 'ControlMandatos' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.GridControlMandatos',
                                                        idcliente: me.idcliente,
                                                        id: 'GridControlMandatos' + me.idcliente
                                                    }
                                                ]
                                            }).show();

                                }
                                tabpanel.setActiveTab('ControlMandatos' + me.idcliente);
                            }
                        }, {
                            text: 'Ficha Tecnica',
                            tooltip: 'Ficha Tecnica',
                            height: 30,
                            iconCls: 'page_white_acrobat',
                            id: 'botonFicha' + me.idcliente,
                            handler: function () {

                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('fichaTecnica' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Ficha Tecnica',
                                                id: 'fichaTecnica' + me.idcliente,
                                                itemId: 'fichaTecnica' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.TabFichaTecnica',
                                                        idcliente: me.idcliente,
                                                        id: 'tabFichaTecnica' + me.idcliente
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('fichaTecnica' + me.idcliente);
                            }
                        }, {
                            text: 'Agentes de Aduana',
                            tooltip: 'Agentes Aduana Autorizados',
                            height: 30,
                            iconCls: 'group_add',
                            id: 'botonAduana' + me.idcliente,
                            handler: function () {

                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('agenteAduana' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Agentes Aduana Autorizados',
                                                id: 'agenteAduana' + me.idcliente,
                                                itemId: 'agenteAduana' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.GridAgenteAduana',
                                                        idcliente: me.idcliente,
                                                        id: 'gridagenteAduana' + me.idcliente,
                                                        plugins: [Ext.create('Ext.grid.plugin.CellEditing', {
                                                                clicksToEdit: 1,
                                                                listeners: {
                                                                    'validateedit': function (editor, e) {
                                                                        if (e.field == "nombre_agente") {
                                                                            if (e.column.getEditor().displayTplData) {
                                                                                var id_agente = e.column.getEditor().displayTplData.id;
                                                                                e.record.data["id_agente"] = id_agente;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            })],
                                                        store: Ext.create('Ext.data.Store', {
                                                            autoLoad: true,
                                                            fields: [
                                                                {name: 'idcliente', type: 'string'},
                                                                {name: 'id_agente', type: 'string'},
                                                                {name: 'nombre_agente', type: 'string'},
                                                                {name: 'fecha_vigencia', type: 'date'},
                                                                {name: 'fecha_autorizacion', type: 'date'},
                                                                {name: 'iddocumento', type: 'string'}
                                                            ],
                                                            proxy: {
                                                                type: 'ajax',
                                                                url: '/clientes/datosAgaduanaAutorizado',
                                                                reader: {
                                                                    type: 'json',
                                                                    root: 'root'
                                                                },
                                                                extraParams: {
                                                                    idcliente: me.idcliente
                                                                },
                                                                filterParam: 'query'
                                                            }
                                                        })
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('agenteAduana' + me.idcliente);
                            }
                        }
                    ]
                }
            }, {
                text: 'Servicios',
                tooltip: 'M&oacute;dulos de Servicios',
                iconCls: 'star',
                id: 'menuServicios' + me.idcliente,
                //width: 120,
                menu: {
                    xtype: 'menu',
                    items: [{
                            text: 'Cotizaciones',
                            tooltip: 'Cotizaciones',
                            height: 30,
                            iconCls: 'table_multiple',
                            id: 'botonCotizaciones' + me.idcliente,
                            handler: function () {
                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('Cotizaciones' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Cotizaciones',
                                                id: 'Cotizaciones' + me.idcliente,
                                                itemId: 'Cotizaciones' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.TreeCotizaciones',
                                                        store: Ext.create('Ext.data.TreeStore', {
                                                            root: "root",
                                                            fields: [
                                                                {name: 'text', type: 'string'}
                                                            ],
                                                            proxy: {
                                                                type: 'ajax',
                                                                url: '/crm/datosCotizaciones',
                                                                autoLoad: true,
                                                                extraParams: {
                                                                    idcliente: me.idcliente
                                                                }
                                                            }
                                                        }),
                                                        idcliente: me.idcliente,
                                                        id: 'CotizacionesTree' + me.idcliente
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('Cotizaciones' + me.idcliente);
                            }
                        }, {
                            text: 'Reportes de Negocio',
                            tooltip: 'Reportes de Negocio',
                            height: 30,
                            iconCls: 'folder_table',
                            id: 'botonReportes' + me.idcliente,
                            handler: function () {
                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('Reportes' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Reporte de negocios',
                                                id: 'Reportes' + me.idcliente,
                                                itemId: 'Reportes' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.TreeReportes',
                                                        store: Ext.create('Ext.data.TreeStore', {
                                                            root: "root",
                                                            fields: [
                                                                {name: 'text', type: 'string'}
                                                            ],
                                                            proxy: {
                                                                type: 'ajax',
                                                                url: '/crm/datosReportes',
                                                                autoLoad: true,
                                                                extraParams: {
                                                                    idcliente: me.idcliente
                                                                }
                                                            }
                                                        }),
                                                        idcliente: me.idcliente,
                                                        id: 'ReportesTree' + me.idcliente
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('Cotizaciones' + me.idcliente);
                            }
                        }, {
                            text: 'Consulta de Status',
                            tooltip: 'M&oacute;dulo de Status',
                            height: 30,
                            iconCls: 'refresh',
                            id: 'statusBoton' + me.idcliente,
                            handler: function () {
                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('Status' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Status',
                                                id: 'Status' + me.idcliente,
                                                itemId: 'Status' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.GridStatus',
                                                        idcliente: me.idcliente,
                                                        id: 'gridStatus' + me.idcliente,
                                                        plugins: [{
                                                                ptype: 'rowexpander',
                                                                id: 'rowexpanderStatus',
                                                                pluginId: 'rowexpanderStatus',
                                                                rowBodyTpl: new Ext.XTemplate(
                                                                        '<table align=center width="100%" height="99%" border=0>' +
                                                                        '<tbody>' +
                                                                        '<tr>' +
                                                                        '<th align="left" width="25%" >Inventarios</th>' +
                                                                        '<td  width="40%" align="left" >{fecha_rep}</td>' +
                                                                        '</tr>' +
                                                                        /*'<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Patrimonios</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Utilidades</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Ventas</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Activos en SMMLV</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Indice de Liquidez</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Indice de Endeudamiento</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT"></td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Prueba &aacute;cida</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT">{ca_pbaacida}</td>' +
                                                                         '</tr>' +
                                                                         '<tr>' +
                                                                         '<th align="left" width="25%" class="tableTEXT2">Ino</th>' +
                                                                         '<td  width="40%" align="left" class="tableTEXT">{ca_ino}</td>' +
                                                                         '</tr>' +*/
                                                                        '</tbody>' +
                                                                        '</table>')
                                                            }
                                                        ],
                                                        requires: [
                                                            'Path.to.RowExpander'
                                                        ]
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('Status' + me.idcliente);
                            }
                        }, {
                            text: 'Servicio de Tracking',
                            tooltip: 'Servicio de Tracking',
                            height: 30,
                            iconCls: 'page_world',
                            id: 'botonTracking' + me.idcliente,
                            handler: function () {
                                var win = window.open("/clientes/clavesTracking?id=" + me.idcliente);
                                win.focus();
                            }
                        }]
                }
            }, {
                text: 'Administrativos',
                tooltip: 'Par&acute;metros Administrativos',
                iconCls: 'wrench_orange',
                id: 'menuAdministrativos' + me.idcliente,
                //width: 150,
                menu: {
                    xtype: 'menu',
                    items: [{
                            text: '% Comisi&oacute;n',
                            tooltip: 'Porcentaje de Comisi&oacute;n',
                            height: 30,
                            iconCls: 'money',
                            id: 'botonPorcentaje' + me.idcliente,
                            handler: function () {

                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('porcentajeComision' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Porcentaje de Comisi&oacute;n',
                                                id: 'porcentajeComision' + me.idcliente,
                                                itemId: 'porcentajeComision' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.GridPorcetajeComision',
                                                        idcliente: me.idcliente,
                                                        id: 'gridPorcetajeComision' + me.idcliente
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('porcentajeComision' + me.idcliente);
                            }
                        }, {
                            text: 'Liberar Cliente',
                            tooltip: 'Remover Represntante de Ventas asignado',
                            height: 30,
                            iconCls: 'delete',
                            id: 'botonLiberar' + me.idcliente,
                            handler: function () {
                                Ext.MessageBox.confirm('Confirmacion', 'esta seguro de Liberar el cliente',
                                        function (e) {
                                            if (e == 'yes') {
                                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando');
                                                Ext.Ajax.request({
                                                    url: '/crm/liberarCliente',
                                                    params: {
                                                        idcliente: me.idcliente
                                                    },
                                                    success: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Cliente Liberado Correctamente");
                                                        Ext.getCmp("vendedor" + me.idcliente).setValue("");
                                                    },
                                                    failure: function (response, opts) {
                                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                                        box.hide();
                                                    }
                                                });
                                            }
                                        });
                            }
                        }, {
                            text: 'Control Financiero',
                            tooltip: 'M&oacute;dulo de Control Financiero',
                            height: 30,
                            iconCls: 'calculator',
                            id: 'botonControlFinanciero' + me.idcliente,
                            handler: function () {
                                tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                                if (!tabpanel.getChildByElement('controlFinanciero' + me.idcliente)) {
                                    tabpanel.add(
                                            {
                                                title: 'Control Financiero',
                                                id: 'controlFinanciero' + me.idcliente,
                                                itemId: 'controlFinanciero' + me.idcliente,
                                                closable: true,
                                                closeAction: 'destroy',
                                                items: [{
                                                        xtype: 'Colsys.Crm.TabControlFinanciero',
                                                        idcliente: me.idcliente,
                                                        id: 'tabcontrolFinanciero' + me.idcliente
                                                    }
                                                ]
                                            }).show();
                                }
                                tabpanel.setActiveTab('controlFinanciero' + me.idcliente);
                            }
                        }]
                }
            }, {
                text: 'Documentos',
                tooltip: 'Documentos del Cliente',
                iconCls: 'folder',
                id: 'botonDocs' + me.idcliente,
                handler: function () {
                    tabpanel = Ext.getCmp('tab-panel-id-indicadores' + me.idcliente);
                    if (!tabpanel.getChildByElement('Docs' + me.idcliente)) {
                        tabpanel.add(
                                {
                                    title: 'Documentos',
                                    id: 'Docs' + me.idcliente,
                                    itemId: 'Docs' + me.idcliente,
                                    closable: true,
                                    closeAction: 'destroy',
                                    items: [{
                                            xtype: 'Colsys.Crm.PanelDocs',
                                            idcliente: me.idcliente,
                                            id: 'tabDocs' + me.idcliente
                                        }
                                    ]
                                }).show();
                    }
                    tabpanel.setActiveTab('Docs' + me.idcliente);
                }
            });
            this.addDocked(tb);
        },
        beforerender: function (me, eOpts) {
            idcliente = this.idcliente;
            form = this.getForm();
            form.load({
                url: '/crm/datosCliente',
                params: {
                    idcliente: idcliente
                },
                success: function (response, options) {
                    res = Ext.JSON.decode(options.response.responseText);
                    Ext.getCmp('fieldset_coltrans' + idcliente).setTitle('<b>Coltrans:</b> ' + res.data.coltrans_estado);
                    Ext.getCmp('fieldset_colmas' + idcliente).setTitle('<b>Colmas:</b> ' + res.data.colmas_estado);
                    Ext.getCmp('fieldset_colotm' + idcliente).setTitle('<b>Colotm:</b> ' + res.data.colotm_estado);
                    Ext.getCmp('fieldset_coldepositos' + idcliente).setTitle('<b>Coldepositos:</b> ' + res.data.coldepositos_estado);
                    Ext.getCmp('fieldset_circular_0170' + idcliente).setTitle('<b>Circular 0170:</b> ' + res.data.circular + ' - <b>Estado:</b> ' + res.data.estado_circular);
                    Ext.getCmp('form-master-' + idcliente).setTitle(res.data.identificacion);
                }
            });
        }
    }
});