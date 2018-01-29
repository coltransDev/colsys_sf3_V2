winModo = null;
Ext.define('Colsys.Ino.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Ino.FormBusqueda',
    title: 'INO',
    autoScroll: true,
    width: 300,
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
            
            //if (this.permisos.Crear == true)
            {
                this.addTool({
                    type: 'plus',
                    //iconCls:'add',
                    tooltip: 'nueva Referencia',
                    handler: function (event, toolEl, panelHeader)
                    {
                        if (winModo == null)
                        {
                            winModo = Ext.create('Ext.window.Window', {
                                title: 'Seleccion de Tipo de Referencia',
                                height: 200,
                                width: 400,
                                layout: 'fit',
                                closeAction: 'hide',
                                items: [
                                {
                                    xtype: "Colsys.Ino.FormModo"
                                }
                                ]
                            });
                        }
                        winModo.show();
                    }
                }
                );
            }
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
                            }
                        },
                        searchp: {
                            cls: Ext.baseCSSPrefix + 'form-searchp-trigger',
                            handler: function () {                                
                                Ext.getCmp('bus-avan').setVisible(Ext.getCmp('bus-avan').hidden);
                            }
                        }
                    },
                    listeners: {
                        specialkey: function (field, e) {
                            if (e.getKey() == e.ENTER) {
                                this.up('form').buscar(this.getValue());
                            }
                        }
                    }
                },
                {
                    xtype: 'fieldset',
                    title: 'Busqueda Avanzada',
                    id: 'bus-avan',
                    name: 'bus-avan',
                    hidden: false,
                    items: [
                        {
                            xtype: 'fieldset',
                            title: 'Fecha Creacion',
                            layout: 'column',
                            labelWidth: 60,
                            defaults: {                                
                                columnWidth: 1 / 3,
                                labelAlign: 'right'
                            },
                            items: [
                                {
                                    xtype: 'datefield',
                                    id: 'fchinicial',
                                    width: 100,
                                    name: 'fchinicial'
                                },
                                {
                                    xtype: 'datefield',
                                    id: 'fchfinal',
                                    name: 'fchfinal',
                                    width: 100,
                                }
                            ]
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Buscar en',
                            layout: 'column',
                            defaultType: 'checkboxfield',
                            defaults: {
                                //anchor: '100%',
                                columnWidth: 1 / 3,
                                labelAlign: 'right'
                            },
                            items: [
                                {
                                    boxLabel: 'Referencia',
                                    name: 'topping',
                                    inputValue: 'ca_referencia',
                                    checked: true,
                                    id: 'checkbox1',
                                    name        : 'opciones[]'
                                }, {
                                    boxLabel: 'Clientes',
                                    name: 'topping',
                                    inputValue: 'ca_compania',
                                    id: 'checkbox2',
                                    name        : 'opciones[]'
                                }, {
                                    boxLabel: 'Master',
                                    name: 'topping',
                                    inputValue: 'ca_master',
                                    id: 'checkbox3',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Bl',
                                    name: 'topping',
                                    inputValue: 'ca_doctransporte',
                                    id: 'checkbox4',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Vendedor',
                                    name: 'topping',
                                    inputValue: 'ca_vendedor',
                                    id: 'checkbox5',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Reporte Neg',
                                    name: 'topping',
                                    inputValue: 'ca_reporte',
                                    id: 'checkbox6',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Linea',
                                    name: 'topping',
                                    inputValue: 'ca_idlinea',
                                    id: 'checkbox7',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Proveedor',
                                    name: 'topping',
                                    inputValue: 'ca_proveedor',
                                    id: 'checkbox8',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Factura',
                                    name: 'topping',
                                    inputValue: 'ca_consecutivo',
                                    id: 'checkbox9',
                                    name        : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Fac Prov',
                                    name: 'topping',
                                    inputValue: 'ca_factura',
                                    id: 'checkbox10',
                                    name        : 'opciones[]'
                                }
                            ]
                        }                        
                    ]
                },
                {
                    xtype: 'fieldset',
                    title: 'Opciones',
                    id: 'opciones',
                    name: 'opciones',
                    html:'<div style:"padding:20px"><a href="/antecedentes/listadoReferencias/format/maritimo" target="_blank">Antecedentes</a></div>\n\
                          <div style:"padding:20px"><a href="/reportesGer/cargasPendientesxLiberar/new" target="_blank">Cargas Pendientes x Liberar</a></div>\n\
                          <div style:"padding:20px"><a href="/reportesGer/informeAerolineasExpoExt5" target="_blank">Informe Aeolineas Expo</a></div>\n\
                          <div style:"padding:20px"><a href="/contabilidad/indexExt5" target="_blank">M&oacute;dulo Contabilidad</a></div>'
                    
                }
            ],
            buscar: function (valor)
            {
                Ext.getCmp("gind1").setLoading(true);
                var form = this.getForm(); // get the form panel
                form.submit({
                    url: '/inoF2/datosBusqueda',
                    success: function (form, action) {
                        var res = action.result.root;
                        tipofactura=action.result.tipofacturacion;
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
        }
        ),
        {
            title: "Resultados de la busqueda",
            //flex: 1,
            height:'50%',
            region: 'south',
            //floating: true,
            items: [
                Ext.create('Ext.grid.Panel', {
                    id: 'gind1',
                    name: 'gind1',
                    bufferedRenderer: false,
                    viewConfig: {
                        getRowClass: function (record, rowIndex, rowParams, store) {
                                                        
                            if (record.get('m_ca_fchanulado') !="" && record.get('m_ca_fchanulado') !="null" &&  record.get('m_ca_fchanulado') !=null) {
                                return "row_purple";
                            }
                        }
                    },
                    store: Ext.data.JsonStore({
                        fields: [
                            {name: 'm_ca_referencia'},
                            {name: 'm_ca_idmaster'},
                            {name: 'm_ca_impoexpo'},
                            {name: 'm_ca_transporte'},
                            {name: 'm_ca_idticket'},
                            {name: 'm_ca_fchanulado'},
                            {name: 'm_ca_fchcerrado'},
                            {name: 'm_ca_fchliquidado'}                            
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/inoF2/datosBusqueda',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    columns: [
                        {
                            text: "Referencia", width: 150, dataIndex: 'm_ca_referencia', sortable: true                                
                        }
                    ],
                    listeners: {
                        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts)
                        {
                            permisosG = this.up('form').permisosG;
                            var tipofac = tipofactura;
                            tabpanel = Ext.getCmp('tabpanel1');
                            ref = record.data.m_ca_idmaster;
                            
                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                            {
                                var tmppermisos = null;
                                
                                if(record.data.m_ca_impoexpo=="INTERNO")
                                    tmppermisos=permisosG.terrestre;
                                else if(record.data.m_ca_impoexpo=="Exportaci\u00F3n")
                                    tmppermisos=permisosG.exportacion;
                                else if(record.data.m_ca_impoexpo=="Importaci\u00F3n")
                                {
                                    if(record.data.m_ca_transporte=="Mar\u00EDtimo")
                                    {
                                        tmppermisos=permisosG.maritimo;
                                    }
                                    if(record.data.m_ca_transporte=="A\u00E9reo")
                                        tmppermisos=permisosG.aereo;
                                }
                                else if(record.data.m_ca_impoexpo=="OTM-DTA")
                                    tmppermisos=permisosG.otm;
                                else{
                                    tmppermisos=null;
                                }

                                if(record.data.m_ca_fchcerrado)
                                {
                                    tmppermisos.Editar=false;
                                    tmppermisos.Crear=false;
                                    tmppermisos.Anular=false;
                                }
                                if ((record.get('m_ca_fchanulado') !="" && record.get('m_ca_fchanulado') !="null" &&  record.get('m_ca_fchanulado') !=null) || (record.get('m_ca_fchliquidado') !="" && record.get('m_ca_fchliquidado') !="null" &&  record.get('m_ca_fchliquidado') !=null)) {
                                    tmppermisos.Editar=false;
                                    tmppermisos.Crear=false;
                                    tmppermisos.Anular=false;
                                }
                                datos={"title":record.data.m_ca_referencia,"id":'tab' + ref};
                                obj=[
                                        new Colsys.Ino.Mainpanel(
                                        {
                                            "idmaster": ref, "idtransporte": record.data.m_ca_transporte,
                                            "idimpoexpo": record.data.m_ca_impoexpo, "idreferencia": record.data.m_ca_referencia,
                                            'permisos': tmppermisos, "tipofacturacion":tipofac, "idticket":record.data.m_ca_idticket,
                                            "modalidad":record.data.m_ca_modalidad
                                        }),
                                        {
                                            region: 'south',
                                            xtype: 'Colsys.Ino.FormCierre',
                                            id: 'formCierre' + ref,
                                            name: 'formCierre' + ref,
                                            idmaster: ref,
                                            'permisos': tmppermisos
                                        }];
                                
                                tabpanel.agregar(datos,obj)
                                
                                /*tabpanel.add(
                                {
                                    title: record.data.m_ca_referencia,
                                    id: 'tab' + ref,
                                    itemId: 'tab' + ref,
                                    closable: true,
                                    autoScroll: true,
                                    items: [
                                        new Colsys.Ino.Mainpanel(
                                        {
                                            "idmaster": ref, "idtransporte": record.data.m_ca_transporte, 
                                            "idimpoexpo": record.data.m_ca_impoexpo, "idreferencia": record.data.m_ca_referencia,
                                            'permisos': tmppermisos, "tipofacturacion":tipofac, "idticket":record.data.m_ca_idticket,
                                            "modalidad":record.data.m_ca_modalidad
                                        }),
                                        {
                                            region: 'south',
                                            xtype: 'Colsys.Ino.FormCierre',
                                            id: 'formCierre' + ref,
                                            name: 'formCierre' + ref,
                                            idmaster: ref,
                                            'permisos': tmppermisos
                                        }]
                                }).show();*/
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
                                            {"path": "/js/ext-6.5.0/build/classic/theme-classic/resources/theme-classic-all-debug.css", "name": "Classic"},
                                            {"path": "/js/ext-6.5.0/build/classic/theme-crisp/resources/theme-crisp-all-debug.css", "name": "Crisp"},
                                            {"path": "/js/ext-6.5.0/build/classic/theme-gray/resources/theme-gray-all-debug.css", "name": "Gray"},
                                            {"path": "/js/ext-6.5.0/build/classic/theme-neptune/resources/theme-neptune-all-debug.css", "name": "Neptune"},
                                            {"path": "/js/ext-6.5.0/build/classic/theme-triton/resources/theme-triton-all-debug.css", "name": "Triton"},
                                            {"path": "/js/ext-6.5.0/build/classic/theme-aria/resources/theme-aria-all-debug.css", "name": "Aria"}
                                        ]
                                    }),
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'path'
                                }, {
                                    xtype: 'combo',
                                    width: '100%',
                                    name: 'user_factuaIno',
                                    id: 'user_factuaIno',
                                    fieldLabel: 'Facturacion',
                                    store: Ext.create('Ext.data.Store',{
                                        fields:['name'],
                                        data: [
                                            {"name": "facturacion1"},
                                            {"name": "facturacion2"}
                                        ]
                                    }),
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'name'
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
                                                    document.location = '/inoF2/indexExt5';
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
        }]
});