Ext.define('Colsys.Riesgos.PanelGeneral', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelGeneral',    
    height: 750,    
    layout: {
        type: 'vbox', // Arrange child items vertically
        align: 'stretch',    // Each takes up full width ,
        pack: 'start'
    },
    bodyPadding: 10,    
    defaults: {
        frame: true,
        collapsible: true,        
        bodyPadding: 10,
        listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        }
    },
    items: [],    
    cargar: function (me, idriesgo) {
        Ext.Ajax.request({
            url: 'general',
            method: 'POST',
            waitTitle: 'Connecting',
            waitMsg: 'Cargando...',
            params: {
                "idriesgo": idriesgo
            },
            scope: this,
            success: function (response, options) {
                me.setHtml(response.responseText);
            },
            failure: function () {
                Ext.Msg.alert('Error al cargar los datos del Riesgo!');
            }
        });
    },
    listeners: {        
        render: function (me, eOpts) {            
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;
            this.add(
                Ext.create('Ext.tab.Panel', {
                    title: 'Informaci\u00F3n General',
                    id: 'tabgeneral'+ idriesgo, 
                    bodyPadding: 5,                                        
                    margin: '0 0 10 0',
                    flex: 1,
                    defaults: {
                        bodyPadding: 10,
                        scrollable: true
                    },
                    items: [
                        Ext.create('Ext.panel.Panel', {
                            title: 'Resumen',                            
                            id: 'subpanel-general' + this.idriesgo,
                            name: 'subpanel-general' + this.idriesgo,
                            dockedItems: [{
                                xtype: 'toolbar',
                                dock: 'top',
                                id: 'toolbar-'+this.idriesgo,                                    
                                items: [{
                                    text: 'Editar',
                                    iconCls: 'application_form_edit',
                                    disabled: !permisos,
                                    handler : function(){
                                        var form = this.up('panel').up('panel').up("panel");                                        
                                        Ext.getCmp("tree-id").ventanaRiesgo2(form);
                                    }
                                }]                                
                            }]                            
                        }),
                        Ext.create('Colsys.Riesgos.ChartRiesgo',{
                            id: 'grafica'+this.idriesgo,
                            name: 'grafica'+this.idriesgo,
                            title: 'Mapa de Riesgos',
                            idriesgo: idriesgo,                                        
                            flex: 1                                        
                        })
                    ]
                }),
                Ext.create('Ext.tab.Panel', {
                    title: 'Registros',
                    id: 'tabregistros'+ idriesgo,
                    margin: '0 0 10 0',
                    bodyPadding: 5,                    
                    flex: 1,
                    items: [
                        Ext.create('Ext.panel.Panel', {
                            title: 'Valoraci\u00F3n',
                             layout: {
                                type: 'hbox',
                                pack: 'start',
                                align: 'stretch'
                            },
                            defaults: {                                
                                bodyPadding: 5
                            },
                            items:[
                                Ext.create('Colsys.Riesgos.GridValoracion', {
                                    id: 'grid-val' + idriesgo,
                                    name: 'grid-val' + idriesgo,
                                    border: true,
                                    flex: 1,
                                    idriesgo: idriesgo,
                                    permisos: permisos,                                        
                                    plugins: [
                                        new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                                    ]
                                })
                            ]                                
                        }),                            
                        Ext.create('Colsys.Riesgos.GridEventos', {
                            id: 'grid-eve' + this.idriesgo,
                            name: 'grid-eve' + this.idriesgo,
                            border: true,
                            title: 'Eventos',
                            idriesgo: this.idriesgo,
                            permisos: permisos
                        })
                    ]
                })
            )
            var panelResumen = Ext.getCmp("subpanel-general" + this.idriesgo);            
            this.cargar(panelResumen, this.idriesgo);
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up('tabpanel').getHeight() - 50);
            //this.setWidth(this.up('tabpanel').getWidth() - 20);            
        }
    }
})