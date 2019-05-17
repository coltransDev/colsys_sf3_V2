Ext.define('Colsys.Riesgos.FormGeneral', {
    extend: 'Ext.form.Panel',
    alias: 'widget.Colsys.Riesgos.FormGeneral',
    bodyPadding: 5,
    autoScroll: true,    
    defaults: {        
        bodyStyle:'padding:4px',
        labelWidth:100
    },
    //url: '/riesgos/guardarFormGeneral',
    setCkeditor : function(prefijo, ckeditor){     
        Ext.getCmp('tab-'+prefijo).add(ckeditor);        
    },    
    listeners: {        
        render: function (me, eOpts) {            
            this.add(
                {xtype: 'hidden', id: 'idriesgo', name: 'idriesgo', value: this.idriesgo},
                {xtype: 'hidden', id: 'ca_idproceso', name: 'ca_idproceso', value: this.idproceso},
                {
                    xtype:'textfield',
                    fieldLabel: 'C\u00F3digo',
                    id:'ca_codigo',
                    name:'ca_codigo',
                    allowBlank: false
                },
                {
                    xtype:'checkboxfield',
                    fieldLabel: 'Aplica LA/FT-FPADM',
                    id:'ca_laft',
                    name:'ca_laft'
                },
                {
                    xtype:'tabpanel',
                    id: 'tab-panel-general',
                    name: 'tab-panel-general', 
                    layout: 'anchor',
                    anchor: '100% 90%',
                    autoScroll: true,
                    collapsible: false,
                    defaults: {
                        autoScroll: true,
                        layout: 'anchor',
                        anchor: '100% 100%'
                    },                    
                    items: [{
                        title:'Descripcion',
                        id:'tab-des',                        
                        name:'tab-des',                        
                        items:[
                            Ext.create('Ext.form.HtmlEditor', {
                                fieldLabel: 'Riesgo',
                                labelAlign: 'left',
                                id: 'ca_riesgo',
                                name: 'ca_riesgo',
                                anchor: '100% 28%',
                                enableFontSize: false,
                                enableAlignments: false,
                                enableFont: false,
                                enableLinks: false,
                                enableLists: false,
                                enableSourceEdit: false          
                            }),
                            Ext.create('Ext.form.ComboBox', {
                                fieldLabel: 'Factor Generador',
                                id: 'factor',
                                name: 'nfactor[]',
                                multiSelect: true,                                
                                store: Ext.create('Ext.data.Store', {
                                        fields: ['valor'],
                                        proxy: {
                                            type: 'ajax',
                                            url: '/riesgos/datosFactor',
                                            extraParams:{
                                                idriesgo: this.idriesgo
                                            },
                                            reader: {
                                                type: 'json',
                                                rootProperty: 'root'
                                            }
                                         },
                                         autoLoad: true
                                    }),                    
                                displayField: 'valor',
                                valueField: 'valor',                    
                                qtip:'Listado',
                                anchor: '100%',
                                queryMode: 'local',
                                forceSelection: true,                                
                                listConfig: {
                                    loadingText: 'buscando...',
                                    emptyText: 'No existen registros',
                                    getInnerTpl: function() {
                                        return '<tpl for="."><div class="search-item"><strong>{valor}</strong><br /><span><br />{empresa}</span> </div></tpl>';
                                    }
                                }
                            }),
                            Ext.create('Ext.form.HtmlEditor', {
                                fieldLabel: 'Etapa del Proceso',
                                labelAlign: 'left',
                                id: 'ca_etapa',
                                name: 'ca_etapa',
                                anchor: '100% 28%',
                                enableFontSize: false,
                                enableAlignments: false,
                                enableFont: false,
                                enableLinks: false,
                                enableLists: false,
                                enableSourceEdit: false                                
                            }),
                            Ext.create('Ext.form.HtmlEditor', {
                                fieldLabel: 'Factor Potenciador',
                                labelAlign: 'left',
                                id: 'ca_potenciador',
                                name: 'ca_potenciador',
                                anchor: '100% 28%',
                                enableFontSize: false,
                                enableAlignments: false,
                                enableFont: false,
                                enableLinks: false,
                                enableLists: false,
                                enableSourceEdit: false          
                            })
                        ]
                    },
                    {
                        title:'Causas',                                                
                        id:'tab-cau',
                        name:'tab-cau',                        
                        items:[                            
                            Ext.create('Ext.grid.Panel', {
                                id: 'gridCausas',
                                name: 'gridCausas',
                                iconCls: 'icon-grid',                                
                                plugins: [{
                                    ptype : 'cellediting',
                                    clicksToEdit: 1,
                                    id: 'myplugin'
                                }],
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id',     type: 'integer'},
                                        {name: 'valor',  type: 'string'},
                                        {name: 'nueva',  type: 'boolean'},
                                    ],
                                    proxy: {
                                        type: 'ajax',
                                        url: '/riesgos/datosCausas',
                                        extraParams:{
                                            idriesgo: this.idriesgo
                                        },
                                        reader: {
                                            type: 'json',
                                            rootProperty: 'root',
                                            totalProperty: 'total'
                                        }
                                    },        
                                    sorters: [{
                                        property: 'valor',
                                        direction: 'ASC'
                                    }],
                                    autoLoad: true
                                }),
                                columns: [
                                    {dataIndex: 'id', hidden: true},        
                                    {header: "Causa", dataIndex: 'valor', flex:1, editor: {xtype: 'textareafield'}},
                                    {header: "Nueva", xtype:"checkcolumn", dataIndex: 'nueva', editor: {xtype: 'checkboxfield'}}
                                ],
                                tbar: [{
                                    text: 'Agregar',
                                    iconCls: 'add',
                                    handler : function(){
                                        var store = this.up("grid").getStore();
                                        var r = Ext.create(store.getModel());            
                                        store.insert(0, r);
                                    }
                                }]
                            })
                        ]
                    },
                    {
                        title:'Controles',                        
                        id:'tab-trl',
                        name:'tab-trl',                        
                        items:[]
                    },
                    {
                        title:'AP',                        
                        id:'tab-acc',
                        name:'tab-acc',                        
                        items:[]
                    },
                    {
                        title:'Contingencia',                        
                        id:'tab-gen',
                        name:'tab-gen',                        
                        items:[]
                    }]
                }
            );
            
            tb = Ext.create('Ext.toolbar.Toolbar', {});
            tb.add({
                xtype: 'button',
                text: 'Guardar',
                height: 30,
                iconCls: 'disk',
                handler: function () {                    
                    var form = this.up('form');
                    var idriesgo = form.idriesgo;
                    
                    var data = form.getForm().getValues();
                    var str = JSON.stringify(data);
                    var grid = Ext.getCmp("gridCausas");

                    if (form.isValid()) {
                        var store = grid.getStore();
                        x = 0;
                        changes = [];
                        for (var i = 0; i < store.getCount(); i++) {
                            var record = store.getAt(i);
                            if (record.isValid()) {
                                changes[x] = record.data;
                                x++;
                            }
                        }
                        var strGrid = JSON.stringify(changes);
                        
                        Ext.Ajax.request({
                            waitMsg: 'Guardando cambios...',
                            url: '/riesgos/guardarFormGeneral',
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
                                var res = Ext.util.JSON.decode(response.responseText);
                                
                                if(res.success==false){
                                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+res.errorInfo);
                                }else{
                                    if(res.nuevo){                                        
                                        var tabpanel = Ext.getCmp('view-Riesgos').down('tabpanel');                                        
                                        Ext.getCmp('tree-id').getStore().reload();                                        
                                        
                                        indice=res.idriesgo;
                                        if(!tabpanel.getChildByElement('tab-'+indice)){
                                            
                                            tabpanel.add({
                                                title: res.text,
                                                id:'tab-'+indice,
                                                itemId:'tab-'+indice,                                        
                                                closable: true,
                                                items:[                                            
                                                    Ext.create('Ext.tab.Panel', {
                                                        bodyPadding: 5,
                                                        autoScroll:true,                                                
                                                        items: [{
                                                            xtype:'Colsys.Riesgos.PanelGeneral',
                                                            title: "General",
                                                            id:"general"+indice,
                                                            name:"general"+indice,
                                                            idriesgo: indice,                                                            
                                                            text: res.texts
                                                        }]
                                                    })
                                                ]
                                            }).show();
                                        }
                                    }else{
                                        me = Ext.getCmp("subpanel-general"+idriesgo);                                
                                        Ext.getCmp('general'+idriesgo).cargar(me, idriesgo);
                                    }
                                    Ext.getCmp('winRiesgo').close();                                
                                    Ext.MessageBox.alert("Mensaje", 'Los cambios se han guardado \u00E9xitosamente');                                  
                                }                                
                            }
                        });                        
                    }
                }
            },{
                xtype: 'button',
                text: 'Cerrar',
                height: 30,
                iconCls: 'close',
                handler: function () {                    
                    
                    Ext.getCmp('winRiesgo').close(); 
                }
            });
            this.addDocked(tb);
        },
        afterrender: function(me, eOpts){
            var f = Ext.getCmp('form-general').getForm();            
            f.load({
                url: '/riesgos/datosFormGeneral',
                params: {
                    idriesgo : this.idriesgo
                },
                success: function () {
                    //alert("si");
                },
                failure: function(){
                    //alert("mo");
                }
            });
            
        }
    }
})
