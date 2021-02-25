comboBoxRenderer = function (combo) {
    return function (value) {

        var idx = combo.store.find(combo.valueField, value);
        var rec = combo.store.getAt(idx);
        return (rec === null ? value : rec.get(combo.displayField));
    };
};

Ext.define('Colsys.Riesgos.GridMaestraProcesos', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Riesgos.GridMaestraProcesos',    
    autoHeight: true,
    autoScroll: true,    
    features: [{
        id: 'feature-procesos',
        ftype: 'grouping',
        startCollapsed: true,
        hideGroupedHeader: true,
        //groupHeaderTpl: '{columnName}: {name} ({rows.length} Proceso{[values.rows.length > 1 ? "s" : ""]})'
        groupHeaderTpl: '{name}'
    }],
    listeners: {            
        beforerender: function(ct, position){            
            this.reconfigure(
                store = Ext.create('Ext.data.Store', {
                    id: 'store-grid-procesos',
                    fields: [
                        { name: 'idproceso',        type: 'integer',    mapping: 'ca_idproceso' },
                        { name: 'idempresa',        type: 'integer',    mapping: 'ca_idempresa' },
                        { name: 'empresa',          type: 'string',     mapping: 'ca_empresa' },
                        { name: 'orden',            type: 'integer',    mapping: 'ca_orden' },
                        { name: 'prefijo',          type: 'string',     mapping: 'ca_prefijo' },
                        { name: 'proceso',          type: 'string',     mapping: 'ca_proceso' },
                        { name: 'nriesgos',         type: 'integer',    mapping: 'ca_nriesgos'}           
                    ],
                    autoLoad: true,        
                    remoteSort: false,
                    groupField: 'empresa',
                    proxy: {
                        type: 'ajax',
                        url: '/riesgos/datosProcesos',            
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    }
                }),
                [
        //            {text : '',             dataIndex : 'sel',              xtype : 'checkcolumn',                  width:30 },
                    {
                        dataIndex: 'idproceso',                                
                        hidden: true
                    },
                    {
                        dataIndex: 'idempresa',                                
                        hidden: true
                    },            
                    {
                        text: "Empresa",
                        dataIndex: 'empresa',
                        flex: 1,
                        sortable: true,
                        editor: Ext.create('Colsys.Widgets.wgEmpresas', {
                            id: 'wg-empresas',
                            name: 'wg-empresas',
                            allowBlank: true,                    
                            forceSelection: false
                        }),
                        renderer: comboBoxRenderer(Ext.getCmp('wg-empresas'))
                    },
                    {
                        text: "Orden",
                        dataIndex: 'orden',
                        sortable: true, 
                        width:80
                    },
                    {
                        text: "Prefijo",
                        dataIndex: 'prefijo',
                        sortable: true,
                        width:80
                    },
                    {
                        text: "Proceso",
                        dataIndex: 'proceso',
                        sortable: true, 
                        flex: 1        
                    },
                    {
                        text : 'Activo',
                        dataIndex : 'ca_activo',
                        xtype : 'checkcolumn',
                        width:60 
                    }
                ]
            );
        },
        afterrender: function(ct, position){

            var items = [];
            items.push(
                {
                    text: 'Nuevo Proceso',
                    iconCls: 'add',
                    id:'btn-add-maestra-procesos',
                    handler: function(t){
                        t.up("grid").ventanaProceso();
                    }
                },                    
                {
                    text: 'Recargar',
                    iconCls: 'refresh',
                    id:'btn-reload-maestra-procesos',
                    handler : function(){
                        this.up("grid").getStore().reload();
                    }
                },                    
                {
                    xtype: "textfield",
                    fieldLabel: 'Buscar',
                    id:'btn-search-maestra-procesos',
                    listeners:{
                        change:function( obj, newValue, oldValue, eOpts ){
                            var idgrid = this.up("grid").idgrid;                            
                            var store=this.up("grid").getStore();
                            store.clearFilter();
                            if(newValue!=""){
                                store.filterBy(function(record, id){                                    

                                    var str=record.get("empresa");
                                    var str1=record.get("proceso");                                        
                                    var str2=record.get("prefijo");

                                    var txt=new RegExp(newValue,"ig");
                                    if(str.search(txt) == -1 && str1.search(txt) == -1 && str2.search(txt) == -1)
                                        return false;
                                    else
                                        return true;
                                });
                            }
                        }
                    }
                }
            );

            tbar = [{
                xtype: 'toolbar',
                dock: 'top',
                id: 'bar-maestra-procesos',                
                items:items
            }];

            this.addDocked(tbar);


        },
        rowclick: function (t, record, element, rowIndex, e, eOpts ) {

            var idprocesoMaestra = record.data.ca_idproceso;
            var idgridPermisos = Ext.getCmp('grid-permisos-procesos').idgrid;

            Ext.getCmp('grid-permisos-procesos').store.clearFilter();
            Ext.getCmp('grid-permisos-procesos').store.filterBy(function(recordp) {                    
                eval("var idproceso = recordp.data.ca_idproceso"+idgridPermisos+";");                                        
                if(idproceso === idprocesoMaestra) {
                    return true;
                } else {
                    return false;
                }
            });
            Ext.getCmp('grid-permisos-procesos').store.reload();   
            Ext.getCmp('grid-permisos-procesos').idpadre = idprocesoMaestra;
            Ext.getCmp('grid-permisos-procesos').setTitle("Permisos "+ record.data.proceso);

            Ext.getCmp('button-add-permisos').enable();
            Ext.getCmp('button-save-permisos').enable();
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            var me = this;                
            e.stopEvent();
            var idproceso = record.data.ca_idproceso;
            var nriesgos = record.data.ca_nriesgos;
            console.log("recordintogridprocesos",record);

            var menu = new Ext.menu.Menu({
                items: [{
                    text: 'Editar',
                    //disabled: !permisos,
                    iconCls: 'application_form',
                    id:'btn-edit-maestra-procesos',
                    handler: function() {
                      me.ventanaProceso(idproceso);
                    }
                }]
            });

            if(nriesgos == 0){
                menu.add({
                    text: 'Eliminar',
                    id:'btn-delete-maestra-procesos',
                    iconCls: 'fa fa-trash-alt',
                    handler: function() {
                        Ext.MessageBox.confirm('Confirmacion', 'Est&aacute; seguro que desea eliminar este proceso?',function (e) {
                            if (e == 'yes') {
                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando Proceso');
                                Ext.Ajax.request({
                                    url: '/riesgos/eliminarProceso',
                                    params: {
                                        idproceso: idproceso
                                    },
                                    success: function (response, opts) {
                                        var res = Ext.util.JSON.decode(response.responseText);

                                        if(res.success){
                                            Ext.MessageBox.alert("Mensaje", res.mensaje);
                                        }else{
                                            Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);   
                                        }
                                        me.getStore().reload();
                                        //Ext.getCmp('grid-permisos-procesos').getStore().reload();
                                        Ext.getCmp('grid-permisos-procesos').store.filterBy(function(recordp) {                                            
                                            if(recordp.data.ca_idproceso === idproceso) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                        });                            
                                        Ext.getCmp("tree-id").getStore().reload();
                                    },
                                    failure: function (response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hide();
                                    }
                                });
                            }
                        })                            
                    }
                },{
                    text: 'Nuevo Riesgo',
                    iconCls: 'fa fa-plus-circle',
                    id: 'button-nuevo-riesgo-'+idproceso,                        
                    handler: function() {                                                
                        var text = 'Nuevo Riesgo: '+ record.data.proceso;                                                
                        var vport = me.up('viewport');
                        tabpanel = vport.down('tabpanel');

                        if(!tabpanel.getChildByElement('tab-nuevo-riesgo-'+idproceso)){
                            tabpanel.add({
                                title: text,
                                id:'tab-nuevo-riesgo-'+idproceso,
                                itemId:'tab-nuevo-riesgo-'+idproceso,
                                closable: true,
                                fullscreen: true,
                                layout: {
                                    type: 'vbox', // Arrange child items vertically
                                    align: 'stretch',    // Each takes up full width ,
                                    pack: 'start'
                                },
                                bodyPadding: 5,
                                defaults: {
                                    frame: true,                                    
                                },
                                scrollable: true,
                                items:[
                                    Ext.create('Colsys.Riesgos.FormRiesgo', {                                                                
                                        id: 'form-riesgo-' + idproceso,
                                        //name: 'form-riesgo-' + idproceso,
                                        flex: 1,
                                        border: false,                                        
                                        layout: 'anchor',
                                        anchor: '100% 100%',
                                        idriesgo: null,
                                        idproceso: idproceso,
                                        nuevo: true,
                                        permisos: record.data.ca_permisos
                                    })
                                ]
                            }).show();
                        }
                        tabpanel.setActiveTab('tab-nuevo-riesgo-' + idproceso);
                    }
                });
            }       
            menu.showAt(e.getXY());

        }
    },
    viewConfig: {
        stripeRows: true,
        getRowClass: function (record, rowIndex, rowParams, store) {            
            if(!record.data.ca_activo){
                return "row_pink";
            }
            if(!record.data.ca_nriesgos > 0){
                return "row_green";
            }
        }
    },
    ventanaProceso : function(idproceso){            
            
            var title = idproceso?"Editar Proceso":"Nuevo Proceso";            
            Ext.create('Ext.window.Window', {
                title: title,                
                id: 'win-grid-nvoproceso',                                                
                maximizable: true,
                layout: {
                    type: 'vbox', // Arrange child items vertically
                    align: 'stretch',    // Each takes up full width ,
                    pack: 'start'
                },
                scrollable: true,                                                
                closeAction: 'destroy',
                bodyStyle:'padding:10px',                
                items: [// Let's put an empty grid in just to illustrate fit layout                        
                    Ext.create('Colsys.Riesgos.FormProceso', {
                        id: 'form-nvoproceso',
                        border: true,
                        idproceso: idproceso
                    })
                ],
                listeners: {
                    close: function (win, eOpts) {
                        win.destroy();
                    },
                    show: function(){
                        win.superclass.show.apply(this, arguments);
                    }
                }
            }).show();
            
            if (idproceso) {
                Ext.getCmp("form-nvoproceso").cargar(idproceso);
            } else {
                Ext.getCmp("form-nvoproceso").getForm().reset();
            }            
        }        
});