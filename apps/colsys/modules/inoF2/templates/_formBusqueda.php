<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">


Ext.define('Colsys.Ino.FormBusqueda', {
    extend: 'Ext.form.Panel',
    alias: 'widget.wCIFBusqueda',            
            title: 'INO',
            autoScroll:true,
            width: 300,
            //collapsed:true,
            collapsible :true,
            //headerPosition:'bottom',
            //collapseMode:'mini',
            layout: 'border',
            id: 'layout-browser',
            border: false,
            split:true,
            margins: '2 0 5 5',            
            minSize: 100,
            maxSize: 500,
            items:[
                
                Ext.create('Ext.panel.Panel', {
                    region:'north',
                    title: 'Busqueda',
                    bodyPadding: 0,
                    //width: '100%',
                    //width: 350,
                    //autoScroll:true,
                    id:'tab-form111',
                    
                    items: [
                        {
                            xtype: 'textfield',
                            width: '100%',
                            //triggerCls : Ext.baseCSSPrefix + 'form-search-trigger',
                            //flex: 1,
                            name: 'artikel',
                            allowBlank: true,
                            style: 'margin-left: 5px',
                            triggers: {
                                clear: {
                                    cls: 'x-form-clear-trigger',
                                    handler: function() {                                        
                                        this.setValue('');
                                        
                                    }
                                },
                                search: {
                                    cls: Ext.baseCSSPrefix + 'form-search-trigger',
                                    handler: function() {
                                        Ext.getCmp("gind1").getStore().reload({
                                            params:{q:this.getValue()}
                                        });
                                        
                                        //alert(this.value)
                                    }
                                },
                                searchp: {
                                    cls: Ext.baseCSSPrefix + 'form-searchp-trigger',
                                    handler: function() {
                                        //alert(this.value)
                                        Ext.getCmp('bus-avan').setVisible(Ext.getCmp('bus-avan').hidden);

                                    }
                                }
                            },
                            listeners: {
                                specialkey: function(field, e){
                                    // e.HOME, e.END, e.PAGE_UP, e.PAGE_DOWN,
                                    // e.TAB, e.ESC, arrow keys: e.LEFT, e.RIGHT, e.UP, e.DOWN
                                    if (e.getKey() == e.ENTER) {
                                        Ext.getCmp("gind1").getStore().reload({
                                            params:{q:this.getValue()}
                                        });
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            title: 'Busqueda Avanzada',
                            id:'bus-avan',
                            name:'bus-avan',                            
                            hidden: true,
                            
                            /*headerCls: {
                                font-size: '8px'
                            },*/
                            items:[
                                {
                                    xtype: 'fieldset',
                                    title: 'Fecha Creacion',
                                    //defaultType: 'checkboxfield',
                                    layout:'column',
                                    labelWidth :60,
                                    defaults: {
                                        //anchor: '100%',
                                        columnWidth: 1/3,
                                        labelAlign:'right'
                                    },
                                    items: [
                                        
                                        {  
                                        boxLabel  : 'Anchovies11',
                                        //labelWidth :35,
                                        xtype: 'datefield',
                                        width:100,
                                        name:'1'
                                    },
                                    {                           
                                        boxLabel  : 'Anchoviesss',
                                        //labelWidth :35,
                                        xtype: 'datefield',
                                        name:'1',
                                        width:100,
                                    }
                                    ]
                                },
                                {
                                    xtype: 'fieldset',
                                    title: 'Buscar en',
                                    layout:'column',
                                    defaultType: 'checkboxfield',
                                    defaults: {
                                        //anchor: '100%',
                                        columnWidth: 1/2,
                                        labelAlign:'right'
                                    },
                                    items: [
                                        {
                                            boxLabel  : 'Referencia',
                                            name      : 'topping',
                                            inputValue: '1',
                                            id        : 'checkbox1'
                                        }, {
                                            boxLabel  : 'Clientes',
                                            name      : 'topping',
                                            inputValue: '2',
                                            checked   : true,
                                            id        : 'checkbox2'
                                        }, {
                                            boxLabel  : 'Master',
                                            name      : 'topping',
                                            inputValue: '3',
                                            id        : 'checkbox3'
                                        },
                                        {
                                            boxLabel  : 'Bl',
                                            name      : 'topping',
                                            inputValue: '4',
                                            id        : 'checkbox4'
                                        },
                                        {
                                            boxLabel  : 'Vendedor',
                                            name      : 'topping',
                                            inputValue: '5',
                                            id        : 'checkbox5'
                                        }
                                    ]
                                }
                            ]
                        }
                        
                    ]
                }
                ),

                {
                    title:"Resultados de la busqueda",
                    flex:1,
                    region:'south',
                    //floating: true,
                    items: [
                        Ext.create('Ext.grid.Panel', {
                            id:'gind1',
                            name:'gind1',
                            bufferedRenderer: false,
                            store: Ext.data.JsonStore({                        
                            fields: [
                                { name: 'm_ca_referencia'},
                                { name: 'm_ca_idmaster' },                                
                                { name: 'm_ca_transporte' },
                                { name: 'm_ca_impoexpo' }
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
                                    text: "Referencia", width: 150, dataIndex: 'm_ca_referencia', sortable: true,
                                    //xtype: 'templatecolumn',
                                    //,
                                     //tpl: '<a href="javascript:loadRef(\'{ca_referencia}\')">{ca_referencia}</a>'
                                }
                            ],
                            listeners:{
                                rowdblclick:function( obj, record, tr, rowIndex, e, eOpts )  
                                {
                                    
                                    tabpanel = Ext.getCmp('tabpanel1');
                                    ref=record.data.m_ca_idmaster;
                                    console.log(record.data);
                                    //alert(ref);
                                    if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
                                    {
                                        tabpanel.add(
                                        {
                                            title: record.data.m_ca_referencia,
                                            id:'tab'+ref,
                                            itemId:'tab'+ref,
                                            closable :true,
                                            autoScroll: true,
                                            items: [new Colsys.Ino.Mainpanel({ "idmaster":ref,"transporte":record.data.m_ca_transporte,"impoexpo":record.data.m_ca_impoexpo})]
                                        }).show();
                                    }
                                    tabpanel.setActiveTab('tab'+ref);
                                }
                            },
                            height:350,
                            split: true
                        })
                    ]
                }
            ],
                tools:[{
                type:'refresh',
                tooltip: 'Refresh form Data',
                // hidden:true,
                handler: function(event, toolEl, panelHeader) {
                    // refresh logic
                }
            },
            {
                type:'gear',
                tooltip: 'Configuracion',
                handler: function(event, toolEl, panelHeader) {
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
                            items:[
                                {
                                xtype: 'combo',
                                width: '100%',                                
                                name: 'user_style',
                                id: 'user_style',
                                fieldLabel: 'Estilo',
                                store: Ext.create('Ext.data.Store', {
                                    fields: ['path', 'name'],
                                    data : [
                                        {"path":"/js/ext5/packages/ext-theme-crisp/build/resources/ext-theme-crisp-all-debug.css", "name":"Crisp"},
                                        {"path":"/js/ext5/packages/ext-theme-classic/build/resources/ext-theme-classic-all-debug.css", "name":"Classic"},
                                        {"path":"/js/ext5/packages/ext-theme-gray/build/resources/ext-theme-gray-all-debug.css", "name":"gray"},
                                        {"path":"/js/ext5/packages/ext-theme-neptune/build/resources/ext-theme-neptune-all-debug.css", "name":"neptune"},
                                    ]
                                }),
                                queryMode: 'local',
                                displayField: 'name',
                                valueField: 'path'                            
                            }
                            ],
                            url: '/inoF2/guardarPreferencias',
                            buttons: [ {
                               text: 'guardar',
                               formBind: true, //only enabled once the form is valid
                               //disabled: true,
                               handler: function() {
                                   var form = this.up('form').getForm();
                                   if (form.isValid()) {
                                       form.submit({
                                           success: function(form, action) {
                                              Ext.Msg.alert('Success', "Se guardo la informacion correctamente");
                                              document.location='/inoF2/indexExt5';
                                           },
                                           failure: function(form, action) {
                                               Ext.Msg.alert('Failed', action.result.msg);
                                           }
                                       });
                                   }
                               }
                           }]})
                        ]
                    }).show();
                    //win.show();
                }
            }]
        });
        
function loadRef(ref1)
{
    ref=ref1;
    ref=ref.replace(/\./g,'');
    
    tabpanel = Ext.getCmp('tabpanel1');
    
    if(!tabpanel.getChildByElement('tab'+ref) && ref!="")
    {
        tabpanel.add(
        {
            title: ref,
            id:'tab'+ref,
            itemId:'tab'+ref,
            closable :true,
            autoScroll: true,
            items: [new Colsys.Ino.Mainpanel({"idmaster":12176})]
        }).show();
    }
    tabpanel.setActiveTab('tab'+ref);    
}
</script>