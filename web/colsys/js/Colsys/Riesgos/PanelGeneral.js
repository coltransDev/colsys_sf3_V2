Ext.define('Colsys.Riesgos.PanelGeneral', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelGeneral',    
    height: 750,    
    layout: {
        type: 'vbox', // Arrange child items vertically
        align: 'stretch',    // Each takes up full width ,
        pack: 'start'
    },
    bodyPadding: 5,    
    defaults: {
        frame: true,
        /*collapsible: true,        
        bodyPadding: 10,
        listeners: {
            collapse: function () {
                this.up().doLayout();
            },
            expand: function () {
                this.up().doLayout();
            }
        }*/
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
            var idproceso = this.idproceso;
            var permisos = this.permisos;
            var idempresa = this.idempresa;
            
            console.log("permisosintopanelgeneral",permisos);
            
            this.add(
                Ext.create('Ext.tab.Panel', {
                    //title: 'Informaci\u00F3n General',
                    id: 'tabgeneral'+ idriesgo, 
                    bodyPadding: 5,                                        
                    margin: '0 0 10 0',
                    flex: 1,
                    defaults: {
                        bodyPadding: 10,
                        scrollable: true
                    },
                    items: [
                    ]
                })
            );
            
            if(permisos.riesgos.ver){
                this.down("panel").add(
                    Ext.create('Ext.panel.Panel', {
                        iconCls: 'fa fa-clipboard',
                        title: 'Resumen',                            
                        id: 'subpanel-general' + this.idriesgo,
                        name: 'subpanel-general' + this.idriesgo,
                        dockedItems: [{
                            xtype: 'toolbar',
                            dock: 'top',
                            id: 'toolbar-'+this.idriesgo,                                    
                            items: [{
                                text: 'Recargar',
                                iconCls: 'refresh',
                                handler : function(){                                    
                                    Ext.getCmp('general'+idriesgo).cargar(this.up("panel"), idriesgo);                            
                                }
                            },{
                                text: 'Editar',
                                iconCls: 'application_form_edit',
                                disabled: !permisos.riesgos.editar,
                                handler : function(t,eOpts){
//                                        var form = this.up('panel').up('panel').up("panel");                                        
//                                        Ext.getCmp("tree-id").ventanaRiesgo2(form);
                                    var text = 'Editar Riesgo: '+ me.text;
                                    var vport = t.up('viewport');
                                    tabpanel = vport.down('tabpanel');

                                    if(!tabpanel.getChildByElement('tab-editar-riesgo-'+idriesgo)){
//                                                    //indice=record.data.id;
                                        tabpanel.add({
                                            title: text,
                                            id:'tab-editar-riesgo-'-+idriesgo,
                                            itemId:'tab-editar-riesgo-'+idriesgo,
                                            //closable: false,
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
                                                    id: 'form-riesgo-' + idproceso + idriesgo,                                                        
                                                    flex: 1,
                                                    border: false,
                                                    itemId: 'form-riesgo-idproceso-'+idproceso +'-idriesgo-'+ idriesgo,
                                                    layout: 'anchor',
                                                    anchor: '100% 100%',
                                                    idriesgo: idriesgo,
                                                    idproceso: idproceso,                                                        
                                                    permisos: permisos
                                                })
                                            ]
                                        }).show();
                                    }
                                    tabpanel.setActiveTab('tab-editar-riesgo-'+idriesgo);
                                }
                            }]                                
                        }]                            
                    })
                ); 
                var panelResumen = Ext.getCmp("subpanel-general" + this.idriesgo);            
                this.cargar(panelResumen, this.idriesgo);
                
                if(!this.aprobado && permisos.riesgos.aprobar){                    
                    tb = panelResumen.getDockedItems()[0];
                    tb.add({
                        text: 'Aprobar',
                        iconCls: 'fa fa-thumbs-up',
                        handler : function(me, eOpts){
                            Ext.MessageBox.confirm('Confirmaci\u00F3n de Aprobaci\u00F3n', 'Est\u00E1 seguro que desea aprobar &eacute;ste riesgo?', function (choice) {
                                if (choice == 'yes') {
                                    Ext.Ajax.request({
                                        waitMsg: 'Guardando cambios...',
                                        url: '/riesgos/aprobarRiesgo',
                                        params: {
                                            idriesgo: idriesgo
                                        },
                                        failure: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);
                                            if (res.errorInfo)
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error eliminando<br>' + res.errorInfo);                
                                        },
                                        success: function (response, options) {
                                            var res = Ext.util.JSON.decode(response.responseText);
                                            
                                            if(res.success){
                                                Ext.MessageBox.alert("Mensaje", res.mensaje);
                                                Ext.getCmp('tree-id').getStore().reload();                                                
                                                me.up("tabpanel").up("panel").up("panel").close();                                                
                                            }else{
                                                Ext.MessageBox.alert("Mensaje", 'Se presento un error aprobando<br>' + res.errorInfo);   
                                            }                                            
                                            
                                        }       
                                    });   
                                }
                            });
                            
                        }
                    });
                }
            }
            
            if(permisos.valoracion.ver){
                this.down("panel").add(
                    Ext.create('Ext.panel.Panel', {
                        iconCls: 'fa fa-chart-area',
                        title: 'Valoracion',                            
                        id: 'panel-valoracion' + this.idriesgo,
                         layout: {
                            type: 'vbox',
                            pack: 'start',
                            align: 'stretch'
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
                        //name: 'subpanel-general' + this.idriesgo,
                        items:[
                            Ext.create('Colsys.Riesgos.GridValoracion', {
                                id: 'grid-val' + idriesgo,
                                title: 'Calificaci&oacute;n',
                                border: true,
                                flex: 1,
                                idriesgo: idriesgo,
                                permisos: permisos,
                                idempresa: idempresa,
                                plugins: [
                                    new Ext.grid.plugin.CellEditing({clicksToEdit: 1})
                                ]                                    
                            }),
                            Ext.create('Colsys.Riesgos.ChartRiesgo',{
                                id: 'grafica'+this.idriesgo,                                
                                title: 'Mapa de Calor',
                                idriesgo: idriesgo,
                                subtitulo: "Riesgo " + me.text,
                                ano: me.ano,
                                indexId: 'chart-riesgo-' + me.indexId + me.idriesgo,
                                //idproceso: idproceso,
                                permisos: permisos,
                                labelIcon: 'score',
                                flex: 3                                       
                            })
                        ]
                    })
                );
            }
            
            if(permisos.eventos.ver){
                this.down("panel").add(
                    Ext.create('Colsys.Riesgos.GridEventos', {
                        iconCls: 'fa fa-calendar-alt',
                        id: 'grid-eve' + this.idriesgo,                        
                        border: true,
                        title: 'Eventos',
                        idriesgo: this.idriesgo,
                        permisos: permisos
                    })
                );
            }
            
            if(permisos.informes.ver){
                //console.log()
                this.down("panel").add(
                    Ext.create('Colsys.Riesgos.PanelPdf',{
                        iconCls: 'fa fa-file-pdf',
                        //ui: 'footer',
                        title: 'Informe PDF',
                        flex:1,
                        id: 'panel-pdf-' + this.idriesgo,                            
                        indexId: me.indexId + '-panel-pdf-' + me.tipo + me.idriesgo,
                        tipo: 'riesgo',               
                        idriesgo: idriesgo,
                        idproceso: me.idproceso,
                        permisos: permisos
                        //src: "/riesgos/pdfProceso/idproceso/"+idproceso+"/idriesgo/"+idriesgo
                    })
                );
            }
            
            this.down("panel").setActiveTab(0); 
    
            console.log("downintopanelgeneral", this.down("panel"));
    
            
        },
        beforerender: function (ct, position) {            
            this.setHeight(this.up('tabpanel').getHeight() - 50);            
        }
    }
});