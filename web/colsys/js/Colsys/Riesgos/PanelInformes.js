Ext.define('Colsys.Riesgos.PanelInformes', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelInformes',
    height: 750,    
    layout: {
        type: 'vbox', // Arrange child items vertically
        align: 'stretch',    // Each takes up full width ,
        pack: 'start'
    },
    bodyPadding: 10,    
    defaults: {
        frame: true,
        //collapsible: true,        
        bodyPadding: 10//,
        /*listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        }*/
    },
    items: [],    
    listeners: {        
        render: function (me, eOpts) {             
            var idproceso = this.idproceso;
            var t
            var proceso = this.proceso;
            var idempresa = this.idempresa;
            var permisos = this.permisos;
            var indexId = this.indexId;            
            var tipo = this.tipo
            
            console.log("tabpanelintopinformes",this.up());
            var src = "";
            
            switch(tipo){
                case "general":
                    subtitulo = "General";
                    break;
                case "empresa":
                    subtitulo = this.empresa;
                    break;
                case "proceso":
                    subtitulo = this.proceso;
                    break;
            }
            
            console.log("tipointopinformes",tipo);
            console.log("subtitulo",subtitulo);
            this.add(
                Ext.create('Ext.tab.Panel', {                    
                    id: 'tab-informe-pdf-' + indexId, 
                    bodyPadding: 5,                                        
                    margin: '0 0 10 0',
                    flex: 1,
                    defaults: {
                        bodyPadding: 10,
                        scrollable: true
                    },
                    items: [
                        Ext.create('Colsys.Riesgos.PanelPdf',{
                            iconCls: 'fa fa-file-pdf',
                            ui: 'footer',
                            tabConfig: {                    
                                tooltip: 'Informe PDF'
                            }, 
                            flex:1,
                            indexId: indexId + '-panel-pdf-' + tipo,
                            id: 'panel-informe-pdf-' + indexId,
                            tipo: tipo,
                            ano: me.ano,
                            idproceso: idproceso,
                            permisos: permisos,
                            idempresa: idempresa//,
                            //src: src
                        }),
                        Ext.create('Colsys.Riesgos.ChartRiesgo',{
                            tabConfig: {                    
                                tooltip: 'Mapa de Calor'
                            },
                            plugins: {
                                ptype: 'chartitemevents'                                
                            },
                            subtitulo: subtitulo,
                            ano: me.ano,
                            iconCls: 'fa fa-chart-area',
                            ui: 'footer',
                            flex:1,                            
                            id: 'grafica-informe-' + indexId,                            
                            indexId: 'grafica-informe-' + indexId,
                            idproceso: idproceso,
                            idempresa: idempresa,
                            permisos: permisos,
                            labelIcon: 'codigo',
                            listeners:{
                                itemclick: function (chart, item, event) {
                                    var idriesgo = item.record.data.idriesgo;
                                    var text = item.record.data.codigo;                                    
                                    console.log("item",item);
                                    var idproceso = item.record.data.idproceso;
                                    
                                    var tabpanel = Ext.getCmp('view-Riesgos').down('tabpanel');
                                    if(!tabpanel.getChildByElement('tab-'+idriesgo)){

                                        tabpanel.add({
                                            title: text,
                                            id:'tab-'+idriesgo,
                                            itemId:'tab-'+idriesgo,                                        
                                            closable: true,
                                            items:[{
                                                xtype:'Colsys.Riesgos.PanelGeneral',                                                    
                                                id:"general"+idriesgo,                                                
                                                indexId: "general"+idriesgo,
                                                idriesgo: idriesgo,
                                                idproceso: idproceso,
                                                text: text,
                                                idempresa: idempresa,                                                
                                                permisos: permisos,
                                                tipo: "riesgo"                                                
                                            }]
                                        }).show();
                                    }
                                }
                            }
                        }),
                        {
                            xtype: 'panel',
                            tabConfig: {                    
                                tooltip: 'Informe de Riesgos'
                            },
                            iconCls: 'fa fa-file-excel',
                            ui: 'footer',
                            titleAlign: 'center',
                            fullscreen: true,
                            id:'panel-grid-informe-' + indexId, 
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
                                Ext.create('Colsys.Riesgos.GridInforme', {
                                    margin: '0 0 5 0',                                    
                                    flex:1,
                                    indexId: 'grid-informe-' + indexId,
                                    id: 'grid-informe-' + indexId,                                                        
                                    border: true,
                                    permisos: permisos,
                                    idproceso: idproceso,
                                    idempresa: idempresa
                                })
                            ]
                        },
                        {
                            xtype: 'panel',
                            tabConfig: {                    
                                tooltip: 'Informe de Eventos'
                            },
                            iconCls: 'fa fa-calendar-alt',
                            ui: 'footer',
                            titleAlign: 'center',
                            fullscreen: true,
                            id:'panel-grid-eventos-' + indexId, 
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
                                Ext.create('Colsys.Riesgos.GridEventos', {
                                    id: 'grid-evento-' + indexId,
                                    indexId: 'grid-evento-' + indexId,                                    
                                    border: true,                                                                                            
                                    idproceso: idproceso,
                                    idempresa: idempresa,
                                    permisos: permisos
                                })
                            ]
                        },
                        {
                            xtype: 'panel',
                            tabConfig: {                    
                                tooltip: 'Versiones'
                            },
                            iconCls: 'fa fa-code-branch',
                            ui: 'footer',
                            titleAlign: 'center',
                            fullscreen: true,
                            id:'panel-versiones-' + indexId, 
                            layout: {
                                type: 'vbox',
                                pack: 'start',
                                align: 'stretch'
                            },
                            defaults: {                                
                                bodyPadding: 5
                            },
                            items:[
                                Ext.create('Colsys.Riesgos.GridVersiones', {
                                    margin: '0 0 5 0',
                                    id: 'grid-versiones-' + indexId,                                                        
                                    idgrid: 'grid-versiones-' + indexId,
                                    indexId: 'index-grid-versiones-' + indexId,
                                    flex:1,
                                    permisos: permisos,                                    
                                    border: true,
                                    idproceso: idproceso,
                                    idempresa: idempresa,
                                    tipo: tipo
                                })
                            ]
                        }
                    ]
                })
            );
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up('tabpanel').getHeight() - 50);
            //this.setWidth(this.up('tabpanel').getWidth() - 20);            
        }
    }
});