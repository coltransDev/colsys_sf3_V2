Ext.define('Colsys.Riesgos.PanelPdf', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.Colsys.Riesgos.PanelPdf',
    
     layout: {
        type: 'vbox',
        pack: 'start',
        align: 'stretch'
    },
    defaults: {                                
        bodyPadding: 5
    },
    dockedItems: [{
        xtype: 'toolbar',
        dock: 'top'                         
    }],
    listeners:{
        render: function (me, eOpts) { 
            
            //var src = this.src;
            var permisos = this.permisos;
            var idproceso = this.idproceso;
            var idriesgo = this.idriesgo?this.idriesgo:0;
            var idempresa = this.idempresa;
            var tipo = this.tipo;
            console.log("anoPdf", this.ano);
            
            var indexId = this.indexId;
            
            var src = "";
            
            switch(tipo){
                case "general":
                    src = "/riesgos/pdfProceso?ano=" + this.ano;
                    break;
                case "empresa":
                    src = "/riesgos/pdfProceso?ano=" + this.ano +"&idempresa=" + idempresa;
                    break;
                case "proceso":
                    src = "/riesgos/pdfProceso?ano=" + this.ano +"&idproceso=" + idproceso;
                    break;
                case "riesgo":
                    src = "/riesgos/pdfProceso?idriesgo=" + idriesgo
                    break;
            }
            console.log("indexIdintoPanel",indexId);
            console.log("srcintopanelpdf",src);
            
            
            
            this.add({
                xtype: 'uxiframe',
                id: 'iframe-pdf-' + indexId,
                flex: 1,
                src: src,
                loadMask: 'Cargando... Por favor espere!',
                listeners:{
                    load:{
                        element: 'el',
                        fn: function () {
                            this.parent().unmask();
                            console.log('done');
                        }
                    },
                    render: function () {
                        this.mask('Cargando... Por favor espere!');
                    }
                }
            });
            
            tb = this.getDockedItems()[0] ;
            
            tb.add({
                text: 'Recargar',
                iconCls: 'refresh', 
                id: 'bar-informe-pdf-' + indexId,
                indexId: this.indexId,
                handler : function(){                        
                    console.log("srcintopdf",src);
                    var myFrame = Ext.ComponentQuery.query('#iframe-pdf-' + indexId)[0];
                    myFrame.load(src);
                }
            },
            {
                xtype: 'Colsys.Indicadores.Internos.Widget.ComboCheckbox',
                width: 300,                
                id:'ca_clasificacion-'+ indexId,                    
                store: Ext.create('Ext.data.Store', {
                    fields: [{type: 'string', name: 'name'},{type: 'integer',name: 'id'}],
                    proxy: {
                        type: 'ajax',
                        url: '/widgets5/datosParametros',
                        extraParams:{
                            caso_uso: 'CU286'
                        },
                        reader: {
                            type: 'json',
                            rootProperty: 'root'
                        }
                    },
                    autoLoad: true
                }),
                listeners:{
                    change: function (me, newValue, oldValue, eOpts){                            
                        me.nextSibling('button').enable();
                    }
                }
            },
            {
                xtype: 'button',
                id:'button-tab-pdf'+ indexId,
                hideLabel: false,
                text: 'Clasificar por',
                iconCls: 'search',
                width: 120,
                tooltip: 'Filtrar',
                disabled: true,
                allowBlank: false,                
                handler: function(me, e) {
                    
                    idclasificacion = JSON.stringify(me.previousSibling('combobox').getValue());
                    var src = "";
                    
                    switch(tipo){
                        case "general":
                            src = "/riesgos/pdfProceso/idclasificacion/" + idclasificacion;
                            break;
                        case "empresa":
                            src = "/riesgos/pdfProceso/idempresa/" + idempresa + "/idclasificacion/" + idclasificacion;
                            break;
                        case "proceso":
                            src = "/riesgos/pdfProceso/idproceso/" + idproceso + "/idclasificacion/" + idclasificacion;
                            break;
                    }
                    
                    //var src = "/riesgos/pdfProceso/idproceso/"+idproceso+"/idclasificacion/"+idclasificacion;
                    var myFrame = Ext.ComponentQuery.query('#iframe-pdf-' + indexId)[0];
                    myFrame.load(src);

//                        console.log("idclasificacion", idclasificacion);
//                        console.log("gridinforme", this.up("panel").down("grid"));
////                      
//                        var gridInforme = this.up("panel").down("panel").down("panel");
//                        var src = "/riesgos/pdfProceso/idproceso/"+idproceso+"/idclasificacion/"+idclasificacion;
//                        var myFrame = Ext.ComponentQuery.query('#iframe-pdf-' + gridInforme.indexId)[0];
//                        myFrame.load(src);
//                        
//                        var graficaInforme = this.up("panel").down("chart");                        
//                        var store =  graficaInforme.getStore();                        
//                        if(store.getProxy().extraParams){
//                            store.getProxy().extraParams.idclasificacion =  idclasificacion;
//                            store.load();
//                        }
//                        
//                        storeGrid = this.up("panel").down("grid").getStore();
//                        storeGrid.getProxy().extraParams.idclasificacion =  idclasificacion;
//                        storeGrid.load();
                } 
            });
            
            if(permisos.informes.crearversion && this.tipo == "proceso"){
                tb = me.getDockedItems()[0];
                tb.add({                     
                    xtype: 'button', 
                    text: 'Guardar Versi&oacute;n',
                    iconCls: 'disk',
                    handler: function(){
                        Ext.create('Colsys.Riesgos.WindowVersion',{
                            title: 'Guardar &eacute;sta versi&oacute;n como:',
                            id: 'winversion-'+me.idproceso,
                            width: 600,
                            heigth: 500,
                            idproceso: me.idproceso
                        }).show();
                    }
                });
                
            }
        }
    }    
});