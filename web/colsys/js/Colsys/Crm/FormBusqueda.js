winModo = null;
winTercero = null;
Ext.define('Colsys.Crm.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Crm.FormBusqueda',
    title: 'CRM',
    width: 250,
    //collapsed:true,
    collapsible: true,
    //headerPosition:'bottom',
    //collapseMode:'mini',
    layout: 'border',
    id: 'layout-browser',
    border: false,
    split: true,
    margins: '2 0 5 5',
    minSize: 100,
    maxSize: 500,
    listeners: {
        beforerender: function () {
        }
    },
    items: [
        Ext.create('Ext.form.Panel', {
            region: 'north',
            title: 'Busqueda',
            bodyPadding: 0,
            id: 'tab-form111',
            items: [
                {
                    xtype: 'textfield',
                    width: '100%',
                    name: 'q',
                    value: '',
                    allowBlank: true,
                    style: 'margin-left: 5px',
                    triggers: {
                        clear: {
                            cls: 'x-form-clear-trigger',
                            handler: function () {
                                this.setValue('');
                            }
                        },
                        search: {
                            cls: Ext.baseCSSPrefix + 'form-search-trigger',
                            handler: function () {

                                this.up('form').buscar(this.getValue());
                                //alert(this.value)
                            }
                        },
                        searchp: {
                            cls: Ext.baseCSSPrefix + 'form-searchp-trigger',
                            handler: function () {
                                Ext.getCmp('busqueda-avanzada').setVisible(Ext.getCmp('busqueda-avanzada').hidden);
                                Ext.getCmp('busqueda-especializada').setVisible(Ext.getCmp('busqueda-especializada').hidden);
                            }
                        }
                    },
                    listeners: {
                        specialkey: function (field, e) {
                            // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                            // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                            if (e.getKey() == e.ENTER) {
                                this.up('form').buscar(this.getValue());
                            }
                        }
                    }
                }, {
                    xtype: 'fieldset',
                    title: 'Busqueda Avanzada',
                    id: 'busqueda-avanzada',
                    name: 'busqueda-avanzada',
                    collapsible: true,
                    hidden: true,
                    items: [{
                            xtype: 'label',
                            text: 'Estado'
                        }, {
                            id: 'chkEstado',
                            xtype: 'checkboxgroup',
                            vertical: false,
                            columns: 3,
                            items: [
                                {
                                    boxLabel: 'Potencial',
                                    name: 'estado[]',
                                    inputValue: 'Potencial'
                                }, {
                                    boxLabel: 'Activo',
                                    name: 'estado[]',
                                    inputValue: 'Activo'
                                }, {
                                    boxLabel: 'Vetado',
                                    name: 'estado[]',
                                    inputValue: 'Vetado'
                                }
                            ]
                        }, {
                            xtype: 'label',
                            text: 'Empresa'
                        }, {
                            xtype: 'fieldcontainer',
                            msgTarget: 'side',
                            layout: 'hbox',
                            items: [{
                                    xtype: 'Colsys.Widgets.wgEmpresas',
                                    id: 'idEmpresa',
                                    name: 'idEmpresa',
                                    flex: 1
                                }
                            ]
                        }, {
                            xtype: 'label',
                            text: 'Nivel de Riesgo'
                        }, {
                            id: 'chkNivel',
                            xtype: 'checkboxgroup',
                            vertical: false,
                            columns: 4,
                            items: [
                                {
                                    boxLabel: 'Sin',
                                    name: 'nivel[]',
                                    inputValue: 'Sin'
                                }, {
                                    boxLabel: 'M\u00EDnimo',
                                    name: 'nivel[]',
                                    inputValue: 'M\u00EDnimo'
                                }, {
                                    boxLabel: 'Medio',
                                    name: 'nivel[]',
                                    inputValue: 'Medio'
                                }, {
                                    boxLabel: 'Alto',
                                    name: 'nivel[]',
                                    inputValue: 'Alto'
                                }
                            ]
                        }, {
                            xtype: 'label',
                            text: 'Circular 0170'
                        }, {
                            id: 'chkCircular',
                            xtype: 'checkboxgroup',
                            vertical: false,
                            columns: 3,
                            items: [
                                {
                                    boxLabel: 'Sin',
                                    name: 'circular[]',
                                    inputValue: 'Sin'
                                }, {
                                    boxLabel: 'Vencida',
                                    name: 'circular[]',
                                    inputValue: 'Vencido'
                                }, {
                                    boxLabel: 'Vigente',
                                    name: 'circular[]',
                                    inputValue: 'Vigente'
                                }
                            ]
                        }, {
                            xtype: 'label',
                            text: 'Cumplimiento'
                        }, {
                            id: 'chkCumplimiento',
                            xtype: 'checkboxgroup',
                            vertical: false,
                            columns: 2,
                            items: [
                                {
                                    boxLabel: 'Restrictivas',
                                    name: 'cumplimiento[]',
                                    inputValue: 'Restrictivas'
                                }, {
                                    boxLabel: 'No Objetivo',
                                    name: 'cumplimiento[]',
                                    inputValue: 'No Objetivo'
                                }
                            ]
                        }, {
                            xtype: 'label',
                            text: 'Fecha Creacion'
                        }, {
                            xtype: 'fieldcontainer',
                            combineErrors: true,
                            msgTarget: 'side',
                            layout: 'hbox',
                            defaults: {
                                flex: 1,
                                hideLabel: true
                            },
                            items: [
                                {
                                    xtype: 'datefield',
                                    id: 'fchinicial',
                                    name: 'fchinicial',
                                    width: 100
                                }, {
                                    xtype: 'datefield',
                                    id: 'fchfinal',
                                    name: 'fchfinal',
                                    width: 100
                                }
                            ]
                        }
                    ]
                }, {
                    xtype: 'fieldset',
                    title: 'Busqueda por',
                    id: 'busqueda-especializada',
                    name: 'busqueda-especializada',
                    collapsible: true,
                    hidden: true,
                    items: [{
                            id: 'chkBuscarEn',
                            xtype: 'checkboxgroup',
                            vertical: false,
                            columns: 3,
                            items: [
                                {
                                    boxLabel: 'Clientes',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_idcliente'
                                }, {
                                    boxLabel: 'Vendedor',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_vendedor'
                                }, {
                                    boxLabel: 'Referencia',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_referencia'
                                }, {
                                    boxLabel: 'Master',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_master'
                                }, {
                                    boxLabel: 'Hbl/Hawb',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_doctransporte'
                                }, {
                                    boxLabel: 'Factura',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_factura'
                                }, {
                                    boxLabel: 'R.Negocio',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_reporte'
                                }, {
                                    boxLabel: 'Cotizacion',
                                    name: 'buscarEn[]',
                                    inputValue: 'ca_cotizacion'
                                }
                            ]
                        }
                    ]
                }
            ],
            buscar: function (valor) {
                //var myMask = new Ext.LoadMask(Ext.getCmp("gind1").el, {useMsg: false});
                //myMask.show();
                //console.log(this.getForm());
                Ext.getCmp("gind1").setLoading(true);
                var form = this.getForm(); // get the form panel
                form.submit({
                    url: '/crm/datosBusqueda',
                    success: function (form, action) {
                        var res = action.result.root;
                        tipofactura = action.result.tipofacturacion;
                        Ext.getCmp("gind1").getStore().loadData(res);
                        Ext.getCmp("gind1").setLoading(false);
                        //     myMask.hide();
                    },
                    failure: function (form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                        Ext.getCmp("gind1").setLoading(false);
                    }
                });
            }
        }), {
            title: "Resultados de la busqueda",
            flex: 1,
            region: 'south',
            //floating: true,
            items: [
                Ext.create('Ext.grid.Panel', {
                    id: 'gind1',
                    name: 'gind1',
                    bufferedRenderer: false,
                    store: Ext.data.JsonStore({
                        fields: [
                            {name: 'idcliente'},
                            {name: 'nombre'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosBusqueda',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    columns: [
                        {
                            text: "Cliente", width: 600, dataIndex: 'nombre', sortable: true
                                    //xtype: 'templatecolumn',
                                    //,
                                    //tpl: '<a href="javascript:loadRef(\'{ca_referencia}\')">{ca_referencia}</a>'
                        }
                    ],
                    listeners: {
                        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts)
                        {
                            //var tipofac = tipofactura;
                            tabpanel = Ext.getCmp('tabpanel1');
                            ref = record.data.idcliente;
                            //permisosG=this.up('form').permisosG;
                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                            {
                                //if(record.data.m_ca_impoexpo=="INTERNO")
                                //    tmppermisos=permisosG.terrestre;
                                //else if(record.data.m_ca_impoexpo=="Exportaci\u00F3n")
                                //    tmppermisos=permisosG.exportacion;
                                //else if(record.data.m_ca_impoexpo=="Importaci\u00F3n")
                                //{
                                //if(record.data.m_ca_transporte=="Mar\u00EDtimo")
                                //    tmppermisos=permisosG.maritimo;
                                //if(record.data.m_ca_transporte=="A\u00E9reo")
                                //    tmppermisos=permisosG.aereo;
                                //}
                                //else if(record.data.m_ca_impoexpo=="OTM-DTA")
                                //tmppermisos=permisosG.otm;
                                tabpanel.add(
                                        {
                                            title: record.data.nombre,
                                            id: 'tab' + ref,
                                            itemId: 'tab' + ref,
                                            closable: true,
                                            autoScroll: true,
                                            items: [
                                                //new Colsys.Crm.Mainpanel(
                                                {
                                                    xtype: 'wCRMMainpanel',
                                                    id: ref,
                                                    idcliente: ref,
                                                    // layout: 'anchor',
                                                    // anchor: '100% 100%',
                                                    // width: 1095,

                                                    permisos: ""
                                                }/*)*/
                                            ]
                                        }).show();
                            }
                            tabpanel.setActiveTab('tab' + ref);
                        }
                    },
                    height: 350,
                    split: true
                })
            ]
        }
    ],
    tools: [
        {
            type: 'gear',
            tooltip: 'Configuracion',
            handler: function (event, toolEl, panelHeader) {
                Ext.create('widget.window', {
                    height: 300,
                    width: 300,
                    title: 'Preferencias',
                    closable: true,
                    items: [
                        Ext.create('Ext.form.Panel', {
                            //title: 'Simple Form',
                            bodyPadding: 5,
                            height: 260,
                            items: [
                                {
                                    xtype: 'combo',
                                    width: '100%',
                                    name: 'user_style',
                                    id: 'user_style',
                                    fieldLabel: 'Estilo',
                                    store: Ext.create('Ext.data.Store', {
                                        fields: ['path', 'name'],
                                        data: [
                                            {"path": "/js/ext6/build/classic/theme-crisp/resources/theme-crisp-all-debug.css", "name": "Crisp"},
                                            {"path": "/js/ext6/build/classic/theme-classic/resources/theme-classic-all-debug.css", "name": "Classic"},
                                            {"path": "/js/ext6/build/classic/theme-gray/resources/theme-gray-all-debug.css", "name": "gray"},
                                            {"path": "/js/ext6/build/classic/theme-neptune/resources/theme-neptune-all-debug.css", "name": "neptune"}
//                                            {"path": "/js/ext6/build/classic/theme-triton/resources/theme-triton-all-debug.css", "name": "triton"}
                                        ]
                                    }),
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'path'
                                }
                            ],
                            url: '/inoF2/guardarPreferencias',
                            buttons: [{
                                    text: 'Guardar',
                                    formBind: true, //only enabled once the form is valid
                                    //disabled: true,
                                    handler: function () {
                                        var form = this.up('form').getForm();
                                        if (form.isValid()) {
                                            form.submit({
                                                success: function (form, action) {
                                                    Ext.Msg.alert('Success', "Se guardo la informacion correctamente");
                                                    document.location = '/crm/indexExt5';
                                                },
                                                failure: function (form, action) {
                                                    Ext.Msg.alert('Failed', action.result.msg);
                                                }
                                            });
                                        }
                                    }
                                }]})
                    ]
                }).show();
            }
        },
        {
            type: 'plus',
            tooltip: 'Nuevo Cliente',
            handler: function (event, toolEl, panelHeader) {
                if (winTercero == null)
                {
                    winTercero = new Ext.Window({
                        title: 'Datos del Nuevo Cliente',
                        height: 600,
                        width: 800,
                        closeAction: 'destroy',
                        id: "winFormEdit",
                        items: [
                            Ext.create('Colsys.Crm.FormClienteMaster',
                                    {
                                        id: 'FormClienteMaster',
                                        name: 'FormClienteMaster',
                                        idcliente: null,
                                        validacion: true
                                    })
                        ],
                        listeners: {
                            destroy: function (obj, eOpts)
                            {
                                winTercero = null;
                                //Ext.getCmp('FormClienteMaster' + me.idcliente).close();
                            }
                        }
                    });
                    winTercero.show();
                } else {
                    Ext.Msg.alert("Crm", "Existe una ventana abierta de Clientes<br>Por favor cierrela primero");
                }
            }
        }]
});
