winModo = null;
Ext.define('Colsys.Status.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Status.FormBusqueda',
    title: 'CONFIRMACIONES INO',
    autoScroll: true,
    width: 300,
    collapsible: true,
    layout: 'border',
    id: 'layout-browser',
    border: false,
    margins: '2 0 5 5',
    minSize: 100,
    maxSize: 500,
//    listeners: {
//        beforerender: function () {
//            me = this;
//            if (!this.permisosC[0]) {
//                Ext.Msg.alert('Alerta', 'Usted no tiene permiso para ingresar a este m&oacute;dulo!');
//                this.setDisabled(true);
//            }
//        }
//    },
    items: [
        Ext.create('Ext.form.Panel', {
            region: 'north',
            title: 'Busqueda',
            bodyPadding: 5,
            id: 'form-busqueda',
            items: [{
                    xtype: 'textfield',
                    width: '100%',
                    name: 'q',
                    allowBlank: true,
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
                            if (e.getKey() === e.ENTER) {
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
                    width: '90%',
                    items: [{
                            xtype: 'fieldset',
                            title: 'Fecha Creacion',
                            layout: 'column',
                            labelWidth: 60,
                            defaults: {
                                columnWidth: 1 / 2,
                                labelAlign: 'right',
                                style: 'margin:5px;'
                            },
                            items: [{
                                    xtype: 'datefield',
                                    id: 'fchinicial',
                                    name: 'fchinicial',
                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                    format: 'Y-m-d',
                                    width: 90
                                },
                                {
                                    xtype: 'datefield',
                                    id: 'fchfinal',
                                    name: 'fchfinal',
                                    renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                                    format: 'Y-m-d',
                                    width: 90
                                }]
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Buscar en',
                            layout: 'column',
                            defaultType: 'checkboxfield',
                            defaults: {
                                columnWidth: 1 / 3,
                                labelAlign: 'right'
                            },
                            items: [{
                                    boxLabel: 'Referencia',
                                    //name: 'topping',
                                    inputValue: 'ca_referencia',
                                    checked: true,
                                    id: 'checkbox1',
                                    name: 'opciones[]'
                                }, {
                                    boxLabel: 'Clientes',
                                    //name: 'topping',
                                    inputValue: 'ca_compania',
                                    id: 'checkbox2',
                                    name: 'opciones[]'
                                }, {
                                    boxLabel: 'Master',
                                    //name: 'topping',
                                    inputValue: 'ca_master',
                                    id: 'checkbox3',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Bl',
                                    //name: 'topping',
                                    inputValue: 'ca_doctransporte',
                                    id: 'checkbox4',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Vendedor',
                                    //name: 'topping',
                                    inputValue: 'ca_vendedor',
                                    id: 'checkbox5',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'R.N.',
                                    //name: 'topping',
                                    inputValue: 'ca_reporte',
                                    id: 'checkbox6',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Linea',
                                    //name: 'topping',
                                    inputValue: 'ca_nomlinea',
                                    id: 'checkbox7',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Proveedor',
                                    //name: 'topping',
                                    inputValue: 'ca_proveedor',
                                    id: 'checkbox8',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Factura',
                                    //name: 'topping',
                                    inputValue: 'ca_consecutivo',
                                    id: 'checkbox9',
                                    name: 'opciones[]'
                                },
                                {
                                    boxLabel: 'Fac Prov',
                                    //name: 'topping',
                                    inputValue: 'ca_factura',
                                    id: 'checkbox10',
                                    name: 'opciones[]'
                                }]
                        }]
                }],
            buscar: function (valor)
            {
                Ext.getCmp("resul").setLoading(true);
                var form = this.getForm(); // get the form panel
                form.submit({
                    url: '/status/datosBusqueda',
                    success: function (form, action) {
                        var res = action.result.root;
                        tipofactura = action.result.tipofacturacion;
                        Ext.getCmp("resul").getStore().loadData(res);
                        Ext.getCmp("resul").setLoading(false);
                    },
                    failure: function (form, action) {
                        Ext.Msg.alert('Failed', action.result.msg);
                        Ext.getCmp("resul").setLoading(false);
                    }
                });
            }
        }
        ),
        {
            title: "Enlaces",
            region: 'south',
            height:'10%',
            id: 'enlaces-status',
            autoScroll: true,
            listeners:{
                beforerender: function () {
                    this.permisos = this.up('form').permisosC;                                        
                    this.html='<div style:"padding:0px"><a href="javascript:findescargue()" >Finalizaci\u00f3n Descargue DIAN</a></div>';        
                }
            }
        },
        {
            title: "Resultados de la busqueda",
            flex: 1,
            region: 'south',
            items: [
                Ext.create('Ext.grid.Panel', {
                    id: 'resul',
                    name: 'resul',
                    bufferedRenderer: false,
                    store: Ext.data.JsonStore({
                        fields: [
                            {name: 'm_ca_referencia'},
                            {name: 'm_ca_idmaster'},
                            {name: 'm_ca_impoexpo'},
                            {name: 'm_ca_transporte'},
                            {name: 'm_ca_idticket'},
                            {name: 'm_ca_fchanulado'}
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
                        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts) {

                            var tabpanel = Ext.getCmp('tabpanel-conf');
                            var idmaster = record.data.m_ca_idmaster;
                            var permisosC = this.up('form').permisosC;
                            //console.log(permisosC);
                            //console.log(permisosC.maritimo);
                            if (!tabpanel.getChildByElement('tab' + idmaster) && idmaster !== "") {
                                if (record.data.m_ca_impoexpo === "Importaci\u00F3n" || record.data.m_ca_impoexpo === "Triangulaci\u00F3n") {
                                    if (record.data.m_ca_transporte === "Mar\u00EDtimo")
                                        var tmppermisos = permisosC.maritimo;
                                } else if (record.data.m_ca_impoexpo === "OTM-DTA")
                                    var tmppermisos = permisosC.otm;

                                //alert(tmppermisos.toSource());
                                /*if(record.data.m_ca_fchcerrado){
                                 tmppermisos.Editar=false;
                                 tmppermisos.Crear=false;
                                 tmppermisos.Anular=false;
                                 }*/

                                tabpanel.add(
                                        {
                                            title: record.data.m_ca_referencia,
                                            id: 'tab' + idmaster,
                                            itemId: 'tab' + idmaster,
                                            closable: true,
                                            autoScroll: true,
                                            items: [{
                                                    xtype: 'Colsys.Status.PanelPrincipal',
                                                    id: 'panel-principal-' + idmaster,
                                                    idmaster: idmaster,
                                                    idtransporte: record.data.m_ca_transporte,
                                                    idimpoexpo: record.data.m_ca_impoexpo,
                                                    idreferencia: record.data.m_ca_referencia,
                                                    permisos: tmppermisos
                                                }/*,
                                                 {
                                                 region: 'south',
                                                 xtype: 'Colsys.Ino.FormCierre',
                                                 id: 'formCierre' + idmaster,
                                                 name: 'formCierre' + idmaster,
                                                 idmaster: idmaster,
                                                 permisos: tmppermisos
                                                 }*/]
                                        }).show();
                            }
                            tabpanel.setActiveTab('tab' + idmaster);
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
                                            {"path": "/js/ext5/packages/ext-theme-crisp/build/resources/ext-theme-crisp-all-debug.css", "name": "Crisp"},
                                            {"path": "/js/ext5/packages/ext-theme-classic/build/resources/ext-theme-classic-all-debug.css", "name": "Classic"},
                                            {"path": "/js/ext5/packages/ext-theme-gray/build/resources/ext-theme-gray-all-debug.css", "name": "gray"},
                                            {"path": "/js/ext5/packages/ext-theme-neptune/build/resources/ext-theme-neptune-all-debug.css", "name": "neptune"}
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
                                    store: Ext.create('Ext.data.Store', {
                                        fields: ['name'],
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

function findescargue(){   
    tabpanel = Ext.getCmp('tabpanel-conf');    
        
   var permisos = Ext.getCmp('enlaces-status').permisos;

    if (!tabpanel.getChildByElement('tab_findescargue') ){
        
        tabpanel.add({
                xtype: 'Colsys.Status.GridFinDescargue',
                title: "Finalizacion Dian",
                id: "tab_findescargue",
                closable: true,
                name: "tab_findescargue",                
                iconCls: 'calculator',
                permisos: permisos
            }            
        ); // Array returned
        tabpanel.show();//4174894 scotiankbank
    }
    tabpanel.setActiveTab('tab_findescargue');
}