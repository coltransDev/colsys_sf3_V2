winModo = null;
htmlLink="";
Ext.define('Colsys.Aduana.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Aduana.FormBusqueda',
    title: 'INO ADUANA',
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
            
            var me = this;            
                  
            if(this.permisosG1.expoaduana.Consultar==true)            {
                htmlLink+='<div style:"padding:0px"><a href="/inoF2/indexExt5" target="_blank">Ino Coltrans</a></div>';
            }
             
            if (this.permisosG1.expoaduana.Crear == true){
                this.addTool({
                    type: 'plus',                    
                    tooltip: 'Crear Referencia Aduana',
                    handler: function (event, toolEl, panelHeader){
                        if (winModo == null){
                            winModo = Ext.create('Ext.window.Window', {
                                title: 'Crear Referencia Aduana',
                                height: 700,
                                width: 1000,
                                layout: 'fit',
                                closeAction: 'hide',                                
                                items:[
                                    Ext.create('Ext.ux.IFrame',{
                                        id: 'refaduana',
                                        height: '100%',
                                        width: '100%',
                                        //src: '/Coltrans/Aduanas/AgregarReferenciaAction.do'
                                        src: '/Coltrans/Aduanas/BusquedaReferenciaAction.do'
                                    })
                                ],
                                listeners:{
                                    afterrender: function(t, eOpts){
                                        tb = new Ext.toolbar.Toolbar({dock: 'top'});

                                        tb.add({
                                            dock: 'top',
                                            xtype: 'button',
                                            text: 'Completar Referencia Exportaciones',                                                
                                            id: 'btn-save-1',
                                            handler: function() {
                                                var uxiframe = this.up("window").down("uxiframe");                                                
                                                var document = uxiframe.getEl().dom.firstElementChild.contentDocument.all;
                                                //var referencia = uxiframe.getEl().dom.firstElementChild.contentDocument.all[177].value;
                                                
                                                for (i = 0; i < document.length; i++) {
                                                    if(document[i].tagName == "INPUT" && document[i].name == "referencia"){
                                                        var referencia = document[i].value;
                                                        break;
                                                    }
                                                }
                                                console.log(referencia);
//                                                exit;
//                                                var referencia = '300.50.01.0002.20';
                                                
                                                Ext.MessageBox.confirm('Confirmacion', 'Est\u00e1 seguro que quiere modificar la referencia #'+referencia+"?.", 
                                                    function(e){
                                                        if(e == 'yes'){
                                                        Ext.Ajax.request({
                                                            url: '/widgets5/datosComboReferenciasAduana/impoexpo/expo/',
                                                            params: {                            
                                                                query:referencia
                                                            },

                                                            callback :function(options, success, response){
                                                                var res = Ext.util.JSON.decode( response.responseText );                                                        
                                                                console.log(res.datos);
                                                                Ext.Array.each(res.root, function(datos, index) {

                                                                    if(datos.m_ca_fchcerrado == null && datos.m_ca_fchliquidado == null){
                                                                        ref='0';

                                                                        tabpanel = Ext.getCmp('tabpanel1');

                                                                        if(!tabpanel.getChildByElement('tab'+ref) && ref!=""){

                                                                            //if(datos.m_ca_impoexpo == "Exportaci\u00F3n"){
                                                                                tmppermisos=me.permisosG1.expoaduana;
                                                                                permisoscrm=me.permisoscrm;
                                                                            //}

                                                                            tabpanel.add({
                                                                                title: ref,
                                                                                id:'tab'+ref,
                                                                                itemId:'tab'+ref,
                                                                                closable :true,
                                                                                autoScroll: true,
                                                                                items: [new Colsys.Aduana.Mainpanel({
                                                                                    "idmaster": ref,                                                                
                                                                                    "idimpoexpo": 'Exportaci\u00f3n',
                                                                                    //"idimpoexpo": datos.m_ca_impoexpo,                                                                            
                                                                                    //"origen": datos.m_ca_destino,
                                                                                    "destino": datos.m_ca_origen,
        //                                                                            "destino": datos.m_ca_destino,
                                                                                    "idreferencia": datos.m_ca_referencia,
                                                                                    'permisos': tmppermisos, 
                                                                                    'permisoscrm': permisoscrm

                                                                                })]
                                                                            }).show();
                                                                        }

                                                                        tabpanel.setActiveTab('tab'+ref);

                                                                    }else{
                                                                        Ext.Msg.alert('Error', "No se puede editar una referencia cerrada o liquidada!");
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                })
                                            this.up('window').close();
                                            }
                                        });
                                        t.addDocked(tb, 'top');
                                    }
                                }
                            });
                        }
                        winModo.show();
                    }
                });   
            }
        }
    },
    items: [
        Ext.create('Ext.form.Panel', {
            region: 'north',
            title: 'Busqueda',
            bodyPadding: 0,
            id: 'tab-form111',
            height:'50%',
            autoScroll: true,
            scrollable :true,
            items: [
                {
                    xtype: 'textfield',
                    width: '100%',
                    name: 'q',
                    allowBlank: true,
                    //style: 'margin-left: 5px',
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
                    autoScroll: true,
                    scrollable :true,
                    hidden: false,
                    items: [
                        
                        {
                            xtype: 'fieldset',                            
                            layout: 'column',
                            defaultType: 'checkboxfield',
                            defaults: {
                                //anchor: '100%',
                                columnWidth: 1 / 3,
                                labelAlign: 'right'
                            },
                            items: [
                                {
                                    labelWidth: 40,
                                    columnWidth: 1 / 2,
                                    xtype: 'datefield',
                                    id: 'fchinicial',
                                    width: 60,
                                    name: 'fchinicial',
                                    fieldLabel: 'Fecha',
                                },
                                {
                                    columnWidth: 1 / 3,
                                    xtype: 'datefield',
                                    id: 'fchfinal',
                                    name: 'fchfinal',
                                    width: 60,
                                },
                                {
                                    boxLabel: 'Referencia',
                                    name: 'topping',
                                    inputValue: 'ca_referencia',
                                    checked: true,
                                    id: 'checkbox1',
                                    name : 'opciones[]'
                                }, {
                                    boxLabel: 'Clientes',
                                    name: 'topping',
                                    inputValue: 'ca_compania',
                                    id: 'checkbox2',
                                    name : 'opciones[]'
                                }, 
                                {
                                    boxLabel: 'Vendedor',
                                    name: 'topping',
                                    inputValue: 'ca_vendedor',
                                    id: 'checkbox5',
                                    name : 'opciones[]'
                                },
                                {
                                    boxLabel: 'Reporte Neg',
                                    name: 'topping',
                                    inputValue: 'ca_consecutivo',
                                    id: 'checkbox6',
                                    name: 'opciones[]'
                                },                                
                                {
                                    boxLabel: 'Factura',
                                    name: 'topping',
                                    inputValue: 'ca_factura',
                                    id: 'checkbox9',
                                    name : 'opciones[]'
                                }
                            ]
                        }                        
                    ]
                },
                
            ],
            buscar: function (valor)
            {
                Ext.getCmp("gind1").setLoading(true);
                var form = this.getForm(); // get the form panel
                //var data = form.getFieldValues();
                //console.log(Ext.getCmp("fieldsearch").getValue());
                form.submit({
                    url: '/aduana/datosBusqueda',
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
            title: "Enlaces",
            region: 'south',
            height:'20%',
            autoScroll: true,
            listeners:{
                beforerender: function () {
                    this.html=htmlLink;
                    //console.log(this.html)
                }
            }           
            
        },
            
        {
            title: "Resultados de la busqueda",
            //flex: 1,
            height:'40%',
            region: 'south',
            autoScroll: true,
            //floating: true,
            items: [
                Ext.create('Ext.grid.Panel', {
                    id: 'gind1',
                    name: 'gind1',
                    bufferedRenderer: false,
                    viewConfig: {
                        getRowClass: function (record, rowIndex, rowParams, store) {
                                                        
                            /*if (record.get('m_ca_fchanulado') !="" && record.get('m_ca_fchanulado') !="null" &&  record.get('m_ca_fchanulado') !=null) {
                                return "row_purple";
                            }*/
                            if(record.get('class')!="")
                                return record.get('class');
                            
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
                            {name: 'm_ca_fchliquidado'},
                            {name: 'class'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/aduana/datosBusqueda',
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
                        rowdblclick: function (obj, record, tr, rowIndex, e, eOpts){
                           
                            var data=JSON.stringify(this.up('form').permisosG);                            
                            
                            tabpanel = Ext.getCmp('tabpanel1');
                            ref = record.data.m_ca_idmaster;
                            
                            if (!tabpanel.getChildByElement('tab' + ref) && ref != "")
                            {
                                tmp= new Object();
                                tmp.referencia=record.data.m_ca_referencia;
                                tmp.idmaster=ref;
                                tmp.impoexpo=record.data.m_ca_impoexpo;
                                tmp.transporte=record.data.m_ca_transporte;
                                tmp.origen=record.data.m_ca_origen;
                                tmp.destino=record.data.m_ca_destino;                                
                                tmp.fchcerrado=record.data.m_ca_fchcerrado;                                
                                tmp.fchliquidado=record.get('m_ca_fchliquidado');
                                datos={"title":record.data.m_ca_referencia,"id":'tab' + ref,"datos":tmp};                                
                                
                                tabpanel.agregar(datos);
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
                                            {"name": "Panel"},
                                            {"name": "Grid"}
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


function traslado()
{   
    tabpanel = Ext.getCmp('tabpanel1');
    //console.log(tabpanel);

    if (!tabpanel.getChildByElement('tab_traslado') )
    {        
        /* tabpanel.add(
        {            
            id: 'traslado',
            itemId: 'traslado',
            closable: true,
            autoScroll: true,         
            items: [{
                xtype: 'Colsys.ReportesGer.PanelCargasTraslado',
                title: "Traslados",
                id: "traslado"  ,
                name: "traslado",                
                iconCls: 'calculator'
            }]
        }).show();*/
        var myPanel = Ext.create('Ext.Panel', {
            html: 'This will be added to a Container'
        });

        tabpanel.add([{
                xtype: 'Colsys.ReportesGer.PanelCargasTraslado',
                title: "Traslados",
                id: "traslado"  ,
                name: "traslado",                
                iconCls: 'calculator'
            }            
        ]); // Array returned
        tabpanel.show();//4174894 scotiankbank
        
        
    }
    tabpanel.setActiveTab('tab_traslado');

}