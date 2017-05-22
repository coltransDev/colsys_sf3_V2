winRutinas = null;
Ext.define('Colsys.Permisos.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Permisos.FormBusqueda',
    title: 'PERMISOS',
    autoScroll: true,
    width: 300,
    collapsible: true,
    layout: 'border',
    id: 'layout-browser',
    border: false,
    split: true,
    margins: '2 0 5 5',
    minSize: 100,
    maxSize: 500,
    listeners: {
        beforerender: function () {
            this.addTool({
                type: 'plus',
                //iconCls:'add',
                tooltip: 'nueva Referencia',
                handler: function (event, toolEl, panelHeader)
                {
                    if (winRutinas == null)
                    {
                        winRutinas = Ext.create('Ext.window.Window', {
                            title: 'Creaci&oacute;n de Rutinas',
                            width: 720,
                            height: 325,
                            layout: 'fit',
                            items: [
                                {
                                    xtype: "Colsys.Permisos.FormRutinas"
                                }
                            ],
                            listeners: {
                                close: function (win, eOpts) {
                                    winRutinas = null;
                                }
                            }
                        });
                    }
                    winRutinas.show();
                }
            }
            );

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
                        }
                    },
                    listeners: {
                        specialkey: function (field, e) {
                            if (e.getKey() == e.ENTER) {
                                this.up('form').buscar(this.getValue());
                            }
                        }
                    }
                }
            ],
            buscar: function (valor)
            {
                Ext.getCmp("gind1").setLoading(true);
                var form = this.getForm(); // get the form panel
                form.submit({
                    url: '/users/datosBusqueda',
                    success: function (form, action) {
                        var res = action.result.root;
                        Ext.getCmp("gind1").getStore().loadData(res);
                        Ext.getCmp("gind1").setLoading(false);
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
                            {name: 'id'},
                            {name: 'ca_nombre'},
                            {name: 'ca_tipo'},
                            {name: 'ca_comentario'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/users/datosBusqueda',
                            reader: {
                                type: 'json',
                                rootProperty: 'root'
                            }
                        },
                        autoLoad: false
                    }),
                    columns: [
                        {
                            text: "Resultado", width: 300, dataIndex: 'ca_nombre', sortable: true,
                            tpl: '{ca_nombre}',
                        }
                    ],
                    listeners: {
                        render: function(grid) {
                                grid.view.tip = Ext.create('Ext.tip.ToolTip', {
                                target: grid.getEl(),                                
                                delegate: ".x-grid-cell-last",
                                items: [], // add items later based on the record                                
                                listeners: {                                    
                                    beforeshow: function updateTipBody(tip){
                                        tip.update(
                                            grid.view.getRecord(tip.triggerElement).get('ca_comentario')
                                        );
                                    }
                                }                                    
                            });
                         },
                        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts)
                        {
                            tabpanel = Ext.getCmp('tabpanel1');
                            ref = record.data.id.replace(/-/g, "_");


                            if (record.data.ca_tipo == "usuario") {

                                if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {

                                    tabpanel.add(
                                            {
                                                width: 900,
                                                title: record.data.ca_nombre,
                                                id: 'tab' + ref,
                                                itemId: 'tab' + ref,
                                                closable: true,
                                                autoScroll: true,
                                                items: [
                                                    Ext.create("Colsys.Permisos.GridUsuarios", {
                                                        id: "gridusuario" + record.data.id.replace(/-/g, "_"),
                                                        idusuario: record.data.id.replace(/-/g, "_")

                                                    })
                                                ]

                                            }).show();
                                }
                            }
                            if (record.data.ca_tipo == "perfil") {
                                {
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                                        tabpanel.add(
                                                {
                                                    width: 900,
                                                    title: record.data.ca_nombre,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [
                                                        Ext.create("Colsys.Permisos.GridPerfiles", {
                                                            id: "gridperfil" + record.data.id.replace(/-/g, "_"),
                                                            idperfil: record.data.id.replace(/-/g, "_")
                                                        })
                                                    ]

                                                }).show();
                                    }
                                }

                            }
                            if (record.data.ca_tipo == "rutina") {
                                {
                                    if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                                        tabpanel.add(
                                                {
                                                    width: 900,
                                                    title: record.data.ca_nombre,
                                                    id: 'tab' + ref,
                                                    itemId: 'tab' + ref,
                                                    closable: true,
                                                    autoScroll: true,
                                                    items: [
                                                        Ext.create("Colsys.Permisos.FormMetodos", {
                                                            id: "form" + record.data.id,
                                                            idrutina: record.data.id
                                                        }),
                                                        Ext.create("Colsys.Permisos.GridMetodos", {
                                                            id: "grid" + record.data.id,
                                                            idrutina: record.data.id
                                                        })
                                                    ],
                                                    dockedItems: [{
                                                            xtype: 'toolbar',
                                                            dock: 'top',
                                                            height: 44,
                                                            items: [{
                                                                    xtype: 'button',
                                                                    text: 'Guardar',
                                                                    iconCls: 'disk',
                                                                    handler: function () {
                                                                        var g = Ext.getCmp("form" + record.data.id).guardar();
                                                                        if (g == 0)
                                                                            Ext.getCmp("grid" + record.data.id).guardar();
                                                                    }
                                                                }]
                                                        }]

                                                }).show();
                                    }
                                }
                            }
                            // if (!tabpanel.getChildByElement('tab' + ref) && ref != "")

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
                                            {"path": "/js/ext5/packages/ext-theme-crisp/build/resources/ext-theme-crisp-all-debug.css", "name": "Crisp"},
                                            {"path": "/js/ext5/packages/ext-theme-classic/build/resources/ext-theme-classic-all-debug.css", "name": "Classic"},
                                            {"path": "/js/ext5/packages/ext-theme-gray/build/resources/ext-theme-gray-all-debug.css", "name": "gray"},
                                            {"path": "/js/ext5/packages/ext-theme-neptune/build/resources/ext-theme-neptune-all-debug.css", "name": "neptune"},
                                        ]
                                    }),
                                    queryMode: 'local',
                                    displayField: 'name',
                                    valueField: 'path'
                                }
                            ],
                            url: '/inoF2/guardarPreferencias',
                            buttons: [{
                                    text: 'guardar',
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
function loadRef(ref1)
{

}