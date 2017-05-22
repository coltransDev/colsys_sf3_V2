Ext.define('Colsys.Riesgos.PanelGeneral', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelGeneral',
    autoScroll: true,
    height: 750,
    layout: {
        type: 'vbox', // Arrange child items vertically
        align: 'stretch'    // Each takes up full width        
    },
    defaults: {
        frame: true,
        collapsible: true,        
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
                console.log('failure');
            }
        });
    },
    listeners: {        
        render: function (me, eOpts) {            
            var idriesgo = this.idriesgo;
            var permisos = this.permisos;
            this.add(                    
                    {// Details Panel specified as a config object (no xtype defaults to 'panel').
                        title: 'Resumen',                        
                        autoScroll: true,                        
                        bodyPadding: 10,                        
                        id: 'subpanel-general' + this.idriesgo,
                        name: 'subpanel-general' + this.idriesgo,
                        flex: 1, // Use 2/3 of Container's height (hint to Box layout)                        
                        dockedItems: [{
                            xtype: 'toolbar',
                            dock: 'bottom',
                            ui: 'footer',
                            id: 'toolbar-'+this.idriesgo,
                            hidden: true,
                            defaults: {
                                minWidth: 200
                            },
                            items: [
                                { xtype: 'component', flex: 1 },
                                { xtype: 'button', text: 'Editar',
                                    iconCls: 'application_form_edit',
                                    id: 'edit-'+this.idriesgo,
                                    handler: function () {
                                        var form = this.up('panel').up('panel');
                                        var idriesgo = form.idriesgo;
                                        Ext.getCmp("tree-id").ventanaRiesgo(form);
                                    } 
                                }
                            ]
                        }]
                    }, {
                        xtype: 'splitter'   // A splitter between the two child items
                    },
                    new Ext.tab.Panel({
                        title: 'Registros',
                        bodyPadding: 5,
                        autoScroll: true,
                        flex: 1,
                        items: [
                            Ext.create('Ext.panel.Panel', {
                                title: 'Valoraci\u00F3n',
                                layout: 'column',
                                items:[
                                    Ext.create('Colsys.Riesgos.GridValoracion', {
                                        id: 'grid-val' + idriesgo,
                                        name: 'grid-val' + idriesgo,
                                        border: true,
                                        width: '70%',                                                                                
                                        idriesgo: idriesgo,
                                        permisos: permisos,
                                        columnWidth: 0.6,
                                        plugins: [
                                            new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                                        ]
                                    }),                                    
                                    Ext.create('Colsys.Chart.Area1',{
                                        id: 'grafica'+this.idriesgo,
                                        name: 'grafica'+this.idriesgo,
                                        title: 'Mapa de Riesgos: '+this.text,
                                        columnWidth: 0.4,                                         
                                        width: '100%',
                                        height: 290,
                                        legend: {
                                            docked: 'bottom'
                                        },
                                        store : Ext.create('Ext.data.JsonStore', {                                            
                                            fields: ['x', 'aceptable','tolerable','critico','mcritico','impacto','probabilidad'],
                                            proxy: {
                                                url: '/riesgos/datosGraficaAreaxRiesgo',
                                                extraParams: {
                                                    idriesgo: idriesgo
                                                },
                                                type: 'ajax',                            
                                                reader: {
                                                     type: 'json',
                                                     rootProperty: 'root'
                                                }                            
                                            },
                                            autoLoad: true
                                        }),
                                        dockedItems: [{
                                            xtype: 'toolbar',
                                            dock: 'top',
                                            items: [{
                                                xtype: 'button',
                                                text: 'Descargar Imagen',
                                                handler: function(btn, e, eOpts) {
                                                    var panel = Ext.getCmp("grafica"+idriesgo);
                                                    panel.downloadCanvas(/*{
                                                        //filename: "Grafica_Proceso_"+proceso
                                                    }*/)
                                                }
                                            }, {
                                                xtype: 'button',
                                                text: 'Vista Previa',
                                                handler: function(btn, e, eOpts) {
                                                    Ext.getCmp("grafica"+idriesgo).preview()
                                                }
                                            }]
                                        }],
                                        listeners:{
                                            afterrender: function(){
                                                var chart = this;

                                                var serie = [{
                                                    type: 'scatter',
                                                    xField: 'impacto',
                                                    yField: 'probabilidad',
                                                    showInLegend: false,
                                                    axis: 'right',
                                                    marker: {
                                                        type: 'ellipse',                                                                            
                                                        cx: 0,
                                                        cy: 0,
                                                        rx: 16,
                                                        ry: 5 
                                                    },
                                                    style: {
                                                        renderer: function (sprite, config, rendererData, index) {
                                                            config.fill = 'white'               
                                                        }
                                                    },
                                                    label: {
                                                        field: 'score',
                                                        display: 'over',                                                                                    
                                                        font: '6px',   
                                                        fillStyle: 'black',
                                                        translationY: 18
                                                    }
                                                }];

                                                chart.addSeries(serie);
                                            }
                                        }
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
                    }))
            
            if(permisos===true){                
                Ext.getCmp('toolbar-'+this.idriesgo).setVisible(true);
            }       
        },
        activate: function (ct, position) {
            me = Ext.getCmp("subpanel-general" + this.idriesgo);
             if (this.load == false || this.load == "undefined" || !this.load) {
             this.cargar(me, this.idriesgo);
             }
        }
    }
})