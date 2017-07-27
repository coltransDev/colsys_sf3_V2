Ext.define('Colsys.Users.GridHijos',{
    extend: 'Ext.grid.Panel',
    alias:'widget.Colsys.Users.GridHijos',
    bufferedRenderer: true,
    height:500,
    selModel: {
        pruneRemoved: false
    },
    store: Ext.create('Ext.data.Store', {            
        fields: [           
            { name: 'ca_idhijo',        type: 'integer',    mapping: 'h_ca_idhijo' },
            { name: 'ca_documento',     type: 'integer',    mapping: 'h_ca_documento' },
            { name: 'ca_nombres',       type: 'string',     mapping: 'h_ca_nombres' },
            { name: 'ca_fchnacimiento', type: 'date',       mapping: 'h_ca_fchnacimiento', dateFormat: 'Y-m-d'},
            { name: 'ca_edad',          type: 'string',    mapping: 'edad'},
            { name: 'ca_detalle',       type: 'string',     mapping: 'detalle'},
            { name: 'ca_padres',        type: 'string',     mapping: 'padres'},
            { name: 'ca_idpadres',      type: 'string',   mapping: 'idpadres'},
            { name: 'ca_sucursal',      type: 'string',     mapping: 's_ca_nombre'},
            { name: 'ca_empresa',       type: 'string',     mapping: 'e_ca_nombre'}
        ],        
        proxy: {
            type: 'ajax',
            url: '/adminUsers/datosHijos',            
            reader: {
                type: 'json',
                rootProperty: 'root'
            }
        }
    }),
    columns: [
        {xtype: 'rownumberer'},
        {dataIndex: 'ca_idhijo', xtype: 'hidden'}, 
        {text: "Documento",         dataIndex: 'ca_documento',      sortable: true, id:'ca_documento',      width:100, editor: {xtype: 'numberfield'}, renderer: function (value) {if(value==0)return null;else return value;}},            
        {text: "Nombres",           dataIndex: 'ca_nombres',        sortable: true, id:'ca_nombres',        width:300, editor: {xtype: 'textfield', maxLength: 255} },
        {text: "Fch. Nacimiento",   dataIndex: 'ca_fchnacimiento',  sortable: true, id:'ca_fchnacimiento',  width:110, editor: new Ext.form.DateField({allowBlank: false,format: 'Y-m-d'}), renderer: Ext.util.Format.dateRenderer('Y-m-d') },
        {text: "Colaborador(es)",   dataIndex: 'ca_padres',         sortable: true, id:'ca_padres',         width:210,  
            editor:{
                xtype: 'tagfield',                            
                store: Ext.create('Ext.data.Store', {
                    fields: ['u_ca_login','u_ca_nombre'],
                    proxy: {
                        type: 'ajax',
                        url: '/intranet/adminUsers/datosUsuarios',
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    },
                    autoLoad: true
                }),
                displayField: 'u_ca_nombre',
                valueField: 'u_ca_nombre',
                hiddenName: 'u_ca_login',
                queryMode: 'local',
                delimiter: '|'
            } 
        },
        {text: "Edad",              dataIndex: 'ca_edad',           sortable: true, id:'ca_edad',           width:80    },
        {text: "Detalle",           dataIndex: 'ca_detalle',        sortable: true, id:'ca_detalle',        width:230   },        
        {text: "Sucursal",          dataIndex: 'ca_sucursal',       sortable: true, id:'ca_sucursal',       width:120   },
        {text: "Empresa",           dataIndex: 'ca_empresa',        sortable: true, id:'ca_empresa',        width:200   }
    ],
    plugins: [
        'gridfilters',
        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
    ],
    viewConfig: {
        stripeRows: true
    },    
    tbar: [
        {
            text: 'Agregar',
            iconCls: 'add',
            handler: function () {
                var store = this.up('grid').store;                
                var r = Ext.create(store.model);
                r.set('ca_idpadres', this.up('grid').login);
                store.insert(0, r);
                this.up('grid').getView().focusRow(0);
            }
        },
        {
            text: 'Guardar',
            iconCls: 'disk',
            handler: function () {                        
                var login = this.up('grid').login;
                var store = this.up('grid').getStore();                        
                var records = store.getModifiedRecords();                        

                changes = [];                        
                for (var i = 0; i < records.length; i++) {
                    r = records[i];
                    if (r.getChanges()) {
                        records[i].data.id = r.id;
                        changes[i] = records[i].data;
                    }
                }   
                var str = JSON.stringify(changes);
                console.log(str);
                if (str.length > 5){
                    Ext.Ajax.request({
                        url: '/intranet/adminUsers/guardarHijos',
                        params: {
                            datos: str,
                            login: login
                        },
                        callback: function (options, success, response) {
                            var res = Ext.util.JSON.decode(response.responseText);
                            if (success) {
                                var res = Ext.decode(response.responseText);
                                var ids = res.ids;
                                if (res.ids && res.idhijos) {
                                    for (i = 0; i < ids.length; i++) {
                                        var rec = store.getById(ids[i]);                                        
                                        rec.commit();
                                        store.reload();                                                
                                    }
                                    Ext.MessageBox.alert("Mensaje", 'Informaci\u00F3n almacenada correctamente<br>');
                                }
                            } else {
                                Ext.MessageBox.alert("Error", 'Error al guardar<br>' + res.errorInfo);
                            }
                        }
                    });
                }
            }
        },
        {
            text: 'Recargar',
            iconCls: 'refresh',
            id:'btn-recargar-hijos',
            handler : function(){
                this.up("grid").getStore().reload();
            }
        },
        {
            xtype: 'exporterbutton',
            text: 'XLS',
            id: 'btn-xls-hijos',
            iconCls: 'csv',
            format:'excel'
        },
        {
            xtype: "textfield",
            fieldLabel: 'Buscar',
            id: 'btn-buscar-hijos',
            listeners:{
                change:function( obj, newValue, oldValue, eOpts ){
                    var store=this.up("grid").getStore();
                    store.clearFilter();
                    if(newValue!=""){
                        store.filterBy(function(record, id){
                            var str=record.get("ca_nombres");                            
                            var str1=record.get("ca_documento");
                            var str2=record.get("ca_padres");
                            
                            var txt=new RegExp(newValue,"ig");
                            if(str.search(txt) == -1 && str1.toString().search(txt) == -1 && str2.search(txt) == -1)
                                return false;
                            else
                                return true;
                        });
                    }
                }
            }
        },
        {
            text: 'Inactivos',
            id:'btn-inactivos-hijos',
            iconCls: 'refresh',  // reference to our css            
            handler: function(btn , e){
                var store = this.up("grid").getStore();
                
                if( btn.getText()==='Inactivos'){
                    btn.setText( "Activos" );
                    store.getProxy().setExtraParam("mostrarInactivos", true );                    
                }else{
                    btn.setText( "Inactivos" );                    
                    store.getProxy().setExtraParam("mostrarInactivos", false );                    
                }
                store.load();
            }
        },
        {
            text: 'Borrar Filtros',
            tooltip: 'Clear all filters',
            id: 'btn-clear-hijos',
            handler: function(){
                this.up("grid").getStore().clearFilter();
            }
        }
    ],    
    initComponent: function() {
        var me = this;        
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
    beforeTemplateLoad: function(store) {
        if(this.app=='intranet'){
            var url = store.proxy.url;
            if(url.indexOf("intranet")< 0)
                store.proxy.url="/intranet"+store.proxy.url;
        }        
    },
    listeners:{
        beforerender: function (ct, position) {            
            if(this.login){
                var login = this.login;
                var store = this.getStore();
                store.load();
                
                this.store.filterBy(function (record) {
                    if(record.data.ca_idpadres.indexOf(login)>=0)
                        return true;                    
                    else                        
                        return false;
                });
                
                Ext.getCmp("ca_detalle").setVisible(false);
                Ext.getCmp("ca_padres").setVisible(false);
                Ext.getCmp("ca_sucursal").setVisible(false);
                Ext.getCmp("ca_empresa").setVisible(false);     
                Ext.getCmp("ca_edad").setVisible(false);     
                Ext.getCmp("btn-xls-hijos").setVisible(false);     
                Ext.getCmp("btn-buscar-hijos").setVisible(false);     
                Ext.getCmp("btn-inactivos-hijos").setVisible(false);     
                Ext.getCmp("btn-clear-hijos").setVisible(false);
            }
        },
        beforeitemcontextmenu: function(view, record, item, index, e){
            e.stopEvent();
            var record = this.store.getAt(index);
            
            var menu = new Ext.menu.Menu({
                items: [{
                    text: 'Eliminar',
                    iconCls: 'delete',
                    handler: function() {                        
                       Ext.MessageBox.confirm('Confirmaci\u00F3n', 'Est\u00E1 seguro de eliminar el registro?', 
                        function(e){
                            if(e == 'yes'){
                                var box = Ext.MessageBox.wait('Procesando', 'Eliminando')
                                Ext.Ajax.request({
                                    url: '/intranet/adminUsers/eliminarHijo',
                                    params :{
                                        idhijo: record.get('ca_idhijo')
                                    },
                                    success: function(response, opts) {
                                        Ext.MessageBox.alert("Colsys", "El registro se elimin\u00F3 correctamente");                                        
                                        Ext.getCmp("grid-hijos").getStore().reload();
                                        box.hidebox();
                                    },
                                    failure: function(response, opts) {
                                        Ext.MessageBox.alert("Colsys", "Se presento el siguiente error " + response.status);
                                        box.hidebox();
                                    }
                                });
                            }
                        })
                    }
                }]
            }).showAt(e.getXY());
        }
    }
});