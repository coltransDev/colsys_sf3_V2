
winTercero = null;
Ext.define('Colsys.Crm.GridSeguimientosClientes', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.Colsys.Crm.GridSeguimientosClientes',
    plugins:{
       cellediting: true
    },
    autoHeight: true,
    autoScroll: true,    
    features: [{
        id: 'feature-seguimiento',
        ftype: 'grouping',
        startCollapsed: true,
        hideGroupedHeader: true,
        groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'
    }],
    listeners: {
        activate: function (me, eOpts ){
            if(!this.login && !this.idsucursal){
                var storeAfter = this.getStore();
                storeAfter.load({
                    params: {
                        idcliente: this.idcliente
                    }
                });
            }
        }, 
        beforerender: function(ct, position){            
            var me = this;
            
            if(me.login)
                var id = me.login
            
            if(me.idcliente)
                var id = me.idcliente
            
            if(me.idsucursal)
                var id = me.idsucursal
            
            var obj = {
                xtype: 'toolbar',
                dock: 'top',                    
                id: 'bar-grid-out'+id,
                items: []
            }
            
            if(me.idcliente){
                obj.items.push({
                    xtype: 'button',
                    text: 'Nuevo Seguimiento',                    
                    iconCls: 'add',
                    id: 'nuevoSeguimiento' + id,
                    handler: function () {
                        if (winTercero == null){
                            winTercero = Ext.create('Ext.window.Window', {
                                title: 'Datos del Seguimiento',
                                closeAction: 'destroy',
                                height: 400,
                                width: 610,
                                id: "winFormEdit",
                                name: "winFormEdit",
                                items:{
                                    xtype: "Colsys.Crm.FormSeguimiento",
                                    idcliente: this.up('grid').idcliente
                                },
                                listeners: {
                                    destroy: function (obj, eOpts){
                                        winTercero = null;
                                    }
                                }
                            });
                            winTercero.show();
                        } else{
                            Ext.Msg.alert("Clientes Ver.2", "Existe una ventana abierta de Seguimientos<br>Por favor cierrela primero");
                        }
                    }
                });
            }
            
            if(me.login || me.idsucursal){
                obj.items.push({
                    text: 'Expandir',                    
                    id: 'bar-group-'+ id,
                    iconCls: 'switch',                    
                    handler : function(t){
                        var me = t;                        
                        t.up('grid').onToggle(me);
                    }
                });
            }
                
            obj.items.push({
                text: 'Recargar',
                id: 'refresh-'+id,
                iconCls: 'refresh',
                handler: function () {
                    me.getStore().reload();
                }
            },
            {
                xtype: "textfield",                    
                labelAlign: 'right',
                fieldLabel: 'B\u00fasqueda',
                id: 'indice-'+id,
                listeners:{
                    change:function( obj, newValue, oldValue, eOpts ){
                        
                        var store=this.up("grid").getStore();
                        store.clearFilter();
                        if(newValue!=""){
                            store.filterBy(function(record, id){                                    
                                var str=record.get("compania");
                                var str1=record.get("comercial");
                                var str2=record.get("asunto");
                                var str3=record.get("detalle");
                                var str4=record.get("compromisos");                                
                                var str5=record.get("tipo");
                                var str6=record.get("empresas");

                                var txt=new RegExp(newValue,"ig");
                                if(str.search(txt) == -1 && str1.search(txt) == -1 && str2.search(txt) == -1 && str3.search(txt) == -1 && str4.search(txt) == -1 && str5.search(txt) == -1 && str6.search(txt) == -1)
                                    return false;
                                else
                                    return true;
                            });
                        }
                    }
                }
            },             
            {
                xtype:'fieldset',
                id: 'bar-fieldset-'+ id,
                title: 'Buscar x Fecha',
                layout: {
                    type: 'hbox',
                    align: 'stretch'
                },
                defaults:{
                    padding: 3
                },
                items:[
                    {
                        xtype: 'datefield',                        
                        labelAlign : 'right',
                        flex: 1,                        
                        fieldLabel: 'Desde',
                        id: 'date-ini-'+id,
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d'
                    },
                    {
                        xtype: 'datefield',                        
                        labelAlign : 'right',
                        flex: 1,
                        fieldLabel: 'Hasta',
                        id: 'date-end-'+id,
                        format: "Y-m-d",
                        altFormat: "Y-m-d",
                        renderer: Ext.util.Format.dateRenderer('Y-m-d'),
                        submitFormat: 'Y-m-d'
                    }
                ]
            },
            {
                xtype: 'button',
                hideLabel: false,
                id: 'bar-search-'+ id,
                iconCls: 'search',
                width: 100,
                tooltip: 'Buscar',
                allowBlank: false,                
                handler: function(t) {

                    var fchini = Ext.util.Format.date(Ext.getCmp("date-ini-"+id).getValue(),'Y-m-d');
                    var fchend = Ext.util.Format.date(Ext.getCmp("date-end-"+id).getValue(),'Y-m-d');

                    var store =  t.up('grid').getStore();                        
                    if(fchini != null && fchend != null){
                        store.getProxy().extraParams.login = me.login;
                        store.getProxy().extraParams.idsucursal = me.idsucursal;
                        store.getProxy().extraParams.fchini = fchini;
                        store.getProxy().extraParams.fchend = fchend;
                    }
                    //store.load();
                    store.load({
                        callback: function (records, operation, success) {                            
                            if(success == true){
                                if(records.length == 0){
                                    Ext.Msg.alert('Resultado', 'No se ha encontrado informaci&oacute;n');
                                }
                                Ext.Msg.alert('Resultado', 'Se han encontrado '+records.length+' registros.');
                                t.up('grid').getView().getFeature('feature-seguimiento').expandAll();                    
                                Ext.getCmp('bar-group-'+ id).setText("Contraer");
                            }
                            if(success == false){
                                try{
                                    Ext.Msg.alert('Error', 'La consulta solicitada devuelve más de 8000 registros'); // way more elegant than ussing rawData etc ...
                                }catch(e){
                                    Ext.Msg.alert('Error', 'Error  inesperado en el servidor.');
                                }
                            }
                        }
                    });
                    
                    
                    
                }                    
            }, {
                xtype: 'button',
                text: 'Exportar XLXS',
                id: 'bar-exporter-'+ id,
                iconCls: 'csv',
                handler: function(){       
                    this.cfg = {
                        type: 'excel07',
                        ext: 'xlsx'
                    }
                    this.addExporter(this.up("grid"), this.cfg, "Informe de Seguimientos", 15000);
                }
            });            
            this.addDocked(obj);        
        },
        render: function (me, position) {
            
            this.reconfigure(
                    store = Ext.create('Ext.data.Store', {
                    id: 'store-grid-seguimientos',
                        fields: [
                            {name: 'idcliente', type: 'integer', mapping: 'idcliente'},
                            {name: 'compania', type: 'string', mapping: 'compania'},
                            {name: 'sucursal', type: 'string', mapping: 'sucursal'},
                            {name: 'comercial', type: 'string', mapping: 'comercial'},
                            {name: 'usuario', type: 'string', mapping: 'usuario'},
                            {name: 'fecha', type: 'string', mapping: 'fecha'},
                            {name: 'tipo', type: 'string', mapping: 'tipo'},
                            {name: 'empresas', type: 'string', mapping: 'empresas'},
                            {name: 'asunto', type: 'string', mapping: 'asunto'},
                            {name: 'detalle', type: 'string', mapping: 'detalle'},
                            {name: 'compromisos', type: 'string', mapping: 'compromisos'}
                        ],
                        proxy: {
                            type: 'ajax',
                            url: '/crm/datosSeguimientoClientes',
                            timeout: '120000',
                            reader: {
                                type: 'json',
                                root: 'root'
                            },
                            autoLoad: true
                        }
                    }),
                    [
                        {
                            header: "Usu. Creado",
                            dataIndex: 'usuario',
                            width: 130
                        },
                        {
                            header: "Fecha",
                            dataIndex: 'fecha',
                            width: 130
                        },
                        {
                            header: "Tipo",
                            dataIndex: 'tipo',
                            width: 120
                        },
                        {
                            header: "Empresas",
                            dataIndex: 'empresas',
                            width: 240
                        },
                        {
                            header: "Asunto",
                            dataIndex: 'asunto',
                            width: 120
                        },
                        {
                            header: "Detalle",
                            dataIndex: 'detalle',
                            width: 350
                        }, {
                            header: "Compromisos",
                            dataIndex: 'compromisos',
                            width: 250
                        }
                ]
            );
            if(this.login){
                var companiaColumn = Ext.create('Ext.grid.column.Column', {
                    header: "Compania",
                    dataIndex: 'compania',
                    width: 250
                });

                var openColumn = Ext.create('Ext.grid.column.Action', {                            
                    iconCls: 'link',
                    width: 25,
                    tooltip: 'Editar forma de pago',
                    handler: function (view, rowIndex, colIndex, item, e, record, row) {
                        
                        var permisos = view.up().permisos;

                        tabpanel = Ext.getCmp('tabpanel1');

                        ref = record.data.idcliente;

                        if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                            tabpanel.add({
                                title: record.data.compania,
                                id: 'tab' + ref,
                                itemId: 'tab' + ref,
                                closable: true,
                                autoScroll: true,
                                items: [{
                                    xtype: 'Colsys.Crm.FormPrincipal',
                                    id: ref+'id',
                                    idcliente: ref,
                                    permisos: permisos
                                }]
                            }).show();
                        }
                        tabpanel.setActiveTab('tab' + ref);
                    }
                });

                this.headerCt.insert(0, companiaColumn);
                this.headerCt.insert(this.columns.length, openColumn);
                this.store.setGroupField(['compania']);
                this.getView().refresh();
                    }
            
            if(this.idsucursal){
                  
                var companiaColumn = Ext.create('Ext.grid.column.Column', {
                    header: "Compania",
                    dataIndex: 'compania',
                    width: 250
                });

                var comercialColumn = Ext.create('Ext.grid.column.Column', {
                    header: "Comercial",
                    dataIndex: 'comercial',
                    width: 250
                });

                var openColumn1 = Ext.create('Ext.grid.column.Action', {                            
                    iconCls: 'link',
                    width: 25,
                    tooltip: 'Editar forma de pago',
                    handler: function (view, rowIndex, colIndex, item, e, record, row) {
                        
                        var permisos = view.up().permisos;

                        tabpanel = Ext.getCmp('tabpanel1');

                        ref = record.data.idcliente;

                        if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                            tabpanel.add({
                                title: record.data.compania,
                                id: 'tab' + ref,
                                itemId: 'tab' + ref,
                                closable: true,
                                autoScroll: true,
                                items: [{
                                    xtype: 'Colsys.Crm.FormPrincipal',
                                    id: ref+'id2',
                                    idcliente: ref,
                                    permisos: permisos
                                }]
                            }).show();
                        }
                        tabpanel.setActiveTab('tab' + ref);
                    }
                });

                this.headerCt.insert(0, comercialColumn);
                this.headerCt.insert(1, companiaColumn);
                this.headerCt.insert(this.columns.length, openColumn1);
                this.store.setGroupField(['comercial']);
                this.getView().refresh();
        }
    }
    },
    onToggle: function(t,eOpts){
         
        var tipo = t.text;        
        switch(tipo){
            case "Expandir":                
                t.setText("Contraer");                
                t.up('grid').getView().getFeature('feature-seguimiento').expandAll();
                break;
            case "Contraer":         
                t.setText("Expandir");
                t.up('grid').getView().getFeature('feature-seguimiento').collapseAll();
                break;
        }
    }
});
