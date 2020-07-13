Ext.define('Colsys.Indicadores.Internos.PanelBusqueda', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Indicadores.Internos.PanelBusqueda',    
    layout: {
        type: 'vbox',
        pack: 'start',
        align: 'stretch'
    },
    bodyPadding: 5,
    listeners:{
        render: function (me, eOpts){
            
            this.add({
                xtype: 'fieldset',
                title: 'Panel de B\u00FAsqueda',
                id: 'fieldset-principal',
                layout: {
                    type: 'vbox',
                    pack: 'start',
                    align: 'stretch'
                },
                items:[{
                    id:'container-1',
                    flex: 1,
                    margin: '0 0 10 0',
                    border: 0,
                    layout: {
                        type: 'hbox',
                        pack: 'start',
                        align: 'stretch'
                    },     
                    items: [{
                        xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                        flex:1,
                        id: 'ano',
                        margin: '0 10 0 0',                        
                        fieldLabel: 'A\u00f1o',                    
                        store: Ext.create('Ext.data.Store', {
                            fields: [{type: 'string', name: 'name'},{type: 'string',name: 'id'}],                        
                            data: this.anos,                        
                        })                    
                    },{
                        xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                        id: 'mes',
                        flex:2,                                        
                        fieldLabel: 'Mes',           
                        store: Ext.create('Ext.data.Store', {
                            fields: [{type: 'string', name: 'id'},{type: 'string',name: 'name'}],                        
                            data: this.meses                        
                        })                    
                    }]
                },{
                    xtype: 'panel',
                    id:'container-2',
                    flex: 1,
                    margin: '0 0 10 0',
                    border: 0,
                    referenceHolder: true,
                    viewModel: true,
                    layout: {
                        type: 'vbox',
                        pack: 'start',
                        align: 'stretch'
                    },     
                    items: [{
                        xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                        flex:1,
                        id: 'sucursal',
                        margin: '0 0 10 0',
                        fieldLabel: 'Sucursal',                    
                        store: Ext.create('Ext.data.Store', {
                            fields: [{type: 'string', name: 'name'},{type: 'string',name: 'id'}],                        
                            data: this.sucursales,                        
                        })                    
                    },
                    {
                        xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                        id: 'traorigen',
                        flex:1,
                        margin: '0 0 10 0',
                        fieldLabel: 'Trafico',
                        displayField: 'name',                        
                        valueField: 'idpais',
                        reference: 'country',
                        publishes: 'value',
                        store: Ext.create('Ext.data.Store', {
                            fields: [{type: 'string', name: 'name'},{type: 'string',name: 'idpais'}],                        
                            data: this.traficos,                        
                        })                    
                    }/*,
                    {
                        xtype: 'combo',
                        flex:1,
                        id: 'ciudestino',
                        margin: '0 0 10 0',
                        labelAlign: 'top',
                        fieldLabel: 'Puerto Destino',                        
                        displayField: 'ciudad',
                        valueField: 'idciudad',
                        queryMode: 'remote',
                        forceSelection: true,
                        bind: {
                            visible: '{country.value}',
                            filters: {
                                property: 'idpais',
                                value: '{country.value}'
                            }
                        },
                        store: Ext.create('Ext.data.Store', {                            
                            fields: [
                                {name: 'idciudad', type: 'string'},
                                {name: 'ciudad', type: 'string'},
                                {name: 'idpais', type: 'string'}
                            ],
                            proxy: {
                                type: 'ajax',
                                url: '/widgets/datosCiudades',                                
                                reader: {
                                    type: 'json',
                                    root: 'root'
                                }
                            }
                        })
                    }*/]
                },
                {
                    id:'container-3',
                    flex: 1,
                    margin: '0 0 10 0',
                    border: 0,
                    layout: {
                        type: 'hbox',
                        pack: 'start',
                        align: 'stretch'
                    },     
                    items: [{
                        xtype: 'Colsys.Widgets.WgClientes',
                        fieldLabel: 'Cliente',
                        labelAlign: 'top',
                        name: 'cliente',
                        id: 'cliente',
                        flex: 1
                    }]
                },
                {
                    id:'container-4',
                    flex: 1,
                    margin: '0 0 10 0',
                    border: 0,
                    layout: {
                        type: 'hbox',
                        pack: 'start',
                        align: 'stretch'
                    },     
                    items: [{                            
                        xtype: 'Colsys.Widgets.wgUsuario',
                        fieldLabel: 'Usuario',
                        labelAlign: 'top',
                        name: 'login',
                        id: 'login_usuario',
                        flex: 1
                    }]
                }]
            });
        }
    }    
});