
<style>
.x-grid-row {
    font: normal 11px/15px tahoma,arial,verdana,sans-serif;
}

.bluenode{
    color: blue;
}

.blue{
    background: silver;
}

.x-column-header {
    font-size: 11px;

}

</style>
<script type="text/javascript" src="/js/ext6/build/packages/charts/classic/charts.js"></script>
<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<script>    
    var indice;
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Chart':'../js/ext5/src/',
            'Colsys':'/js/Colsys',
            'Ext.ux':'../js/ext5/examples/ux',
            'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/'/*,
            'Graph':'../js/ext5/packages/ext-charts/src/chart/series',
            'Ext.chart':'../js/ext5/packages/ext-charts/src/chart',
            'Ext.draw':'../js/ext5/packages/ext-charts/src/draw'*/
        }
    });

    Ext.require([    
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer',
        'Ext.ux.CKeditor',
        'Ext.ux.exporter.Exporter'/*,                
        'Graph.Cartesian',
        'Graph.Series',
        'Ext.chart.series.Series',
        'Ext.draw.Color'*/
    ]);
</script>

<script  src="../../js/ckeditor/ckeditor.js" ></script>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td><div id="panel"></div></td></tr>
</table>


<script>
    winRiesgo = null;
    
    Ext.onReady(function() {
        Ext.tip.QuickTipManager.init();

        var msg = function(title, msg) {
            Ext.Msg.show({
                title: title,
                msg: msg,
                minWidth: 200,
                modal: true,
                icon: Ext.Msg.INFO,
                buttons: Ext.Msg.OK
            });
        };

        var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
        var store = Ext.create('Ext.data.TreeStore', {
            root: {
                expanded: false
            },
            proxy: {
                type: 'ajax',
                url: '<?=url_for("riesgos/datosProcesos")?>'
            }
        });


        Ext.create("Ext.container.Viewport",{
            renderTo: 'panel',
            layout:'border',
            id: 'view-Riesgos',
            name: 'view-Riesgos',
            scope:this,
            items:[{
                region: 'west',
                title: 'Riesgos',
                width: 180,
                collapsible: true,
                items:[{
                    xtype:'treepanel',
                    id:'tree-id',
                    rootVisible: false,
                    border:false,                    
                    store: store,
                    cls : 'rednode',
                    dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top'
                    }],
                    listeners:{
                        itemclick: function(t,record,item,index){
                            
                            
                            if(record.data.depth==2){                                
                                var vport = t.up('viewport');
                                tabpanel = vport.down('tabpanel');

                                if(!tabpanel.getChildByElement('tab-'+record.data.id)){
                                    indice=record.data.id;
                                    tabpanel.add({
                                        title: record.data.text,
                                        id:'tab-'+record.data.id,
                                        itemId:'tab-'+record.data.id,                                        
                                        closable: true,
                                        items:[                                            
                                            new Ext.tab.Panel({
                                                bodyPadding: 5,
                                                //autoScroll:true,                                                
                                                items: [{
                                                    xtype:'Colsys.Riesgos.PanelGeneral',
                                                    title: "General",
                                                    id:"general"+record.data.id,
                                                    name:"general"+record.data.id,
                                                    idriesgo: record.data.id,
                                                    idproceso: record.data.idproceso,
                                                    text: record.data.text,
                                                    permisos: record.data.permisos
                                                }],
                                                /*bbar: [
                                                    {
                                                        text: 'Guardar',
                                                        handler: function(){
                                                            var form = this.up('form').getForm();
                                                            if(form.isValid()){
                                                                form.submit({
                                                                    url: '/gestDocumental/subirArchivoTRD',
                                                                    waitMsg: 'Guardando',
                                                                    success: function(fp, o) {
                                                                        msg('Mensaje', 'Archivo Procesado "' + o.result.file + '" en el servidor');
                                                                        //Ext.getCmp("tree-grid-file").getStore().load({params : {'ref1' : Ext.getCmp("ref1").getValue(),'idsserie' : Ext.getCmp("idsserie").getValue()}});
                                                                        //location.href=location.href;
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    },            
                                                    {
                                                        text: 'Limpiar',
                                                        handler: function() {
                                                            this.up('form').getForm().reset();
                                                        }
                                                    }],*/
                                                listeners:{
                                                    afterrender:function( obj, eOpts ){
                                                        //Ext.getCmp("descripcion1"+record.data.id).setText(record.data.descripcion1,false);
                                                    }
                                                }
                                            })
                                        ]
                                    }).show();
                                }
                                tabpanel.setActiveTab('tab-'+record.data.id);
                            }
                        },
                        itemmouseenter: function( t, record, item, index, e, eOpts ){
                            if(record.data.depth==2)
                            {
                                view=t;
                                 var tip = Ext.create('Ext.tip.ToolTip', {
                                     target: item,                                 
                                     delegate: view.itemSelector,                                 
                                     trackMouse: true,                                 
                                     renderTo: Ext.getBody(),
                                     listeners: {                                     
                                          beforeshow: function updateTipBody(tip) {                                         
                                             tip.update(record.data.descripcion);                                         
                                         }

                                     }
                                 });                            
                             }
                        },
                        itemcontextmenu: function ( t, record, item, index, e, eOpts ){
                            e.stopEvent();                            
                            var idproceso = record.data.idproceso;
                            var proceso = record.data.text; 
                            var permisos = false;
                            var data = record.data;
                            
                            $.each(data, function( index, value ) {                                
                                if(index==="children"){                                    
                                    $.each(value, function( index1, value1 ) {
                                        $.each(value1, function( index2, value2 ) {                                            
                                            if(index2==="permisos"){
                                                permisos = value2;
                                            }
                                        });
                                    });
                                }
                            });                            
                            if(record.data.depth==1){                                
                                var menu = new Ext.menu.Menu({
                                    id: 'menuContextual'+idproceso,
                                    items: [
                                        {
                                            text: 'Nuevo Riesgo',
                                            iconCls: 'add',
                                            id: 'button1-'+idproceso,
                                            disabled: !permisos,
                                            handler: function() {
                                                var vport = t.up('viewport');                                                
                                                Ext.getCmp("tree-id").ventanaRiesgo(null, record.data)                                                
                                            }
                                        },
                                        {
                                            text: 'Informe de Riesgos LAFT',
                                            iconCls: 'pdf',
                                            id: 'button2-'+idproceso,
                                            handler: function () {                                                
                                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                    title: 'Informe de Riesgos LAFT',
                                                    sorc: "/riesgos/pdfProceso?idproceso=" + idproceso + "&laft=si"
                                                });
                                                windowpdf.show();
                                            }
                                        },
                                        {
                                            text: 'Informe de Riesgos '+ proceso,
                                            iconCls: 'pdf',
                                            id: 'button3-'+idproceso,
                                            handler: function () {                                                
                                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                    title: 'Informe de Riesgos '+ proceso,
                                                    sorc: "/riesgos/pdfProceso/idproceso/" + idproceso
                                                });
                                                windowpdf.show();
                                            }
                                        },
                                        {
                                            text: 'Informe de Riesgos General',
                                            iconCls: 'pdf',
                                            id: 'button4-'+idproceso,
                                            handler: function () {                                                
                                                var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                    title: 'Informe de Riesgos General',
                                                    sorc: "/riesgos/pdfProceso/"
                                                });
                                                windowpdf.show();
                                            }
                                        },                                        
                                        {
                                            text: 'Mapa de Riesgos '+ proceso,
                                            iconCls: 'map',
                                            id: 'button5-'+idproceso,
                                            handler: function() {                                                
                                                Ext.getCmp("tree-id").mapaRiesgos(idproceso,proceso);
                                            }
                                        },
                                        {
                                            text: 'Mapa de Riesgos General',
                                            iconCls: 'map',
                                            id: 'button6-'+idproceso,
                                            handler: function() {
                                                Ext.getCmp("tree-id").mapaRiesgos();
                                            }
                                        }
                                    ]
                                }).showAt(e.getXY());
                            }
                        }
                    },
                    renderer: function (value, metaData) {
                        console.log(value);
                            //TODO Apply your logic here...
                            /*if(value==='Thread1'){
                                metaData.tdAttr = 'bgcolor="red"';
                          }
                          return value;*/
                    },
                    ventanaRiesgo: function (form, record) {

                        var idriesgo = form ? form.idriesgo : null;
                        var text = form ? 'Editar Riesgo -' + form.text : 'Nuevo Riesgo: '+ record.text;
                        var idproceso = record ? record.idproceso : form.idproceso;
                        
                        if (winRiesgo == null) {
                            var array = [];
                            array.push({title: "Controles", name: "ca_controles", pref: "trl"});
                            array.push({title: "Acciones", name: "ca_ap", pref: "acc"});
                            array.push({title: "Contingencia", name: "ca_contingencia", pref: "gen"});

                            winRiesgo = Ext.create('Ext.window.Window', {
                                title: text,
                                width: 700,
                                height: 500,
                                id: 'winRiesgo',
                                name: 'winRiesgo',
                                maximizable: true,
                                layout: 'anchor',
                                closeAction: 'destroy',
                                items: [// Let's put an empty grid in just to illustrate fit layout                        
                                    Ext.create('Colsys.Riesgos.FormGeneral', {
                                        id: 'form-general',
                                        name: 'form-general',
                                        border: false,
                                        layout: 'anchor',
                                        anchor: '100% 100%',
                                        idriesgo: idriesgo,
                                        idproceso: idproceso
                                    })
                                ],
                                listeners: {
                                    close: function (win, eOpts) {
                                        winRiesgo = null;
                                    },
                                    show: function () {
                                        winRiesgo.superclass.show.apply(this, arguments);
                                    }
                                }
                            });

                            winRiesgo.show();

                            //Carga cada pestaña en el tab correspondiente
                            $.each(array, function (index, value) {
                                var obj = null;
                                obj = Ext.create('Ext.form.HtmlEditor', {
                                    id: value.name,
                                    name: value.name,
                                    anchor: '100% 100%',
                                    enableFontSize: false,
                                    enableAlignments: false,
                                    enableFont: false,
                                    enableLinks: false,
                                    enableLists: false,
                                    enableSourceEdit: false 
                                });

                                Ext.getCmp('form-general').setCkeditor(value.pref, obj);
                            });

                        } else {
                            alert("Ya existe una ventana de edici\u00F3n abierta")
                        }
                    },
                    mapaRiesgos: function(id, proceso){
                        var idproceso = id?id:"";
                        var nombre = proceso?'Proceso '+proceso:"Grupo Empresarial Coltrans";
                        var now = new Date().toJSON().slice(0,10);
                        
                        Ext.create('Ext.window.Window', {
                            title: 'Mapa de Riesgos',
                            height: 768,
                            width: 1024,
                            id: 'winImpacto'+idproceso,
                            layout: 'fit',
                            items: [  // Let's put an empty grid in just to illustrate fit layout
                                Ext.create('Colsys.Chart.Area1',{
                                    id: 'graficaProceso'+idproceso,
                                    name: 'graficaProceso'+idproceso,                                                            
                                    plugins: {
                                        ptype: 'chartitemevents',
                                        moveEvents: true
                                    },
                                    interactions: {
                                        type: 'itemedit'
                                    },
                                    /*legend: {
                                        docked: 'bottom'
                                    },*/
                                    store : Ext.create('Ext.data.JsonStore', {                                            
                                        fields: ['x', 'aceptable','tolerable','critico','mcritico','impacto','probabilidad'],
                                        proxy: {
                                            url: '/riesgos/datosGraficaAreaxRiesgo',
                                            extraParams: {
                                                idproceso: idproceso
                                            },
                                            type: 'ajax',                            
                                            reader: {
                                                 type: 'json',
                                                 rootProperty: 'root'
                                            }                            
                                        },
                                        autoLoad: true
                                    }),
                                    sprites : [{
                                        type: 'text',
                                        text: nombre,
                                        fontSize: 22,
                                        width: 100,
                                        height: 30,
                                        x: 400, // the sprite x position
                                        y: 30  // the sprite y position
                                    },{
                                        type: 'text',
                                        text: 'Generado el '+now,
                                        fontSize: 9,
                                        width: 50,
                                        height: 10,
                                        x: 850, // the sprite x position
                                        y: 680  // the sprite y position
                                    }],
                                    dockedItems: [{
                                        xtype: 'toolbar',
                                        dock: 'bottom',
                                        items: [{
                                            xtype: 'button',
                                            text: 'Descargar Imagen',
                                            handler: function(btn, e, eOpts) {
                                                var panel = Ext.getCmp("graficaProceso"+idproceso);
                                                panel.download({
                                                    filename: "Grafica_Proceso_"+proceso
                                                })
                                            }
                                        }, {
                                            xtype: 'button',
                                            text: 'Vista Previa',
                                            handler: function(btn, e, eOpts) {
                                                Ext.getCmp("graficaProceso"+idproceso).preview()
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
                                                    rx: 20,
                                                    ry: 6 
                                                },
                                                style: {
                                                    renderer: function (sprite, config, rendererData, index) {
                                                        config.fill = 'white'               
                                                    }
                                                },
                                                label: {
                                                    field: 'codigo',
                                                    display: 'over',                                                                                    
                                                    fontSize: '9px',
                                                    fillStyle: 'black',
                                                    translationY: 17
                                                }
                                            }];
                                            
                                            chart.addSeries(serie);
                                        },
                                        itemclick: function (chart, item, event) {
                                            var idriesgo = item.record.data.idriesgo;
                                            var text = item.record.data.codigo;                                                                    

                                            var tabpanel = Ext.getCmp('view-Riesgos').down('tabpanel');
                                            if(!tabpanel.getChildByElement('tab-'+idriesgo)){

                                                tabpanel.add({
                                                    title: text,
                                                    id:'tab-'+idriesgo,
                                                    itemId:'tab-'+idriesgo,                                        
                                                    closable: true,
                                                    items:[                                            
                                                        new Ext.tab.Panel({
                                                            bodyPadding: 5,
                                                            autoScroll:true,                                                
                                                            items: [{
                                                                xtype:'Colsys.Riesgos.PanelGeneral',
                                                                title: "General",
                                                                id:"general"+idriesgo,
                                                                name:"general"+idriesgo,
                                                                idriesgo: idriesgo,                                                                                        
                                                                text: text
                                                            }]
                                                        })
                                                    ]
                                                }).show();
                                            }
                                        }

                                    }
                            })
                                /*Ext.create('Colsys.Chart.Scatter1',{
                                    id: 'graficaProceso'+idproceso,
                                    name: 'graficaProceso'+idproceso,                                                            
                                    plugins: {
                                        ptype: 'chartitemevents',
                                        moveEvents: true
                                    },
                                    interactions: {
                                        type: 'itemedit'
                                    },                                                            
                                    store : Ext.create('Ext.data.JsonStore', {                                            
                                        fields: ['ano', 'data1','data2','score','codigo'],                                    
                                        proxy: {
                                            url: '/riesgos/datosGraficaxRiesgo',
                                            extraParams: {
                                                idproceso: idproceso
                                            },
                                            type: 'ajax',                            
                                            reader: {
                                                 type: 'json',
                                                 rootProperty: 'root'
                                            }                            
                                        },
                                        autoLoad: true
                                    }),
                                    sprites : [{
                                        type: 'text',
                                        text: nombre,
                                        fontSize: 22,
                                        width: 100,
                                        height: 30,
                                        x: 400, // the sprite x position
                                        y: 30  // the sprite y position
                                    },{
                                        type: 'text',
                                        text: 'Generado el '+now,
                                        fontSize: 9,
                                        width: 50,
                                        height: 10,
                                        x: 850, // the sprite x position
                                        y: 680  // the sprite y position
                                    }],
                                    dockedItems: [{
                                        xtype: 'toolbar',
                                        dock: 'bottom',
                                        items: [{
                                            xtype: 'button',
                                            text: 'Descargar Imagen',
                                            handler: function(btn, e, eOpts) {
                                                var panel = Ext.getCmp("graficaProceso"+idproceso);
                                                panel.download({
                                                    filename: "Grafica_Proceso_"+proceso
                                                })
                                            }
                                        }, {
                                            xtype: 'button',
                                            text: 'Vista Previa',
                                            handler: function(btn, e, eOpts) {
                                                Ext.getCmp("graficaProceso"+idproceso).preview()
                                            }
                                        }]
                                    }],
                                    listeners:{
                                        afterrender: function(){
                                            var chart = this;

                                            var serie = [{
                                                type: 'scatter',
                                                xField: 'data1',
                                                yField: 'data2',
                                                showInLegend: true,
                                                marker:{
                                                    type: 'ellipse',                                                                            
                                                    cx: 0,
                                                    cy: 0,
                                                    rx: 26,
                                                    ry: 10            
                                                },
                                                tooltip: {            
                                                    width: 140,
                                                    height: 28,
                                                    scope: this,
                                                    renderer: function (toolTip, storeItem, item) {
                                                        var color = "";
                                                        var text = "";

                                                        if(storeItem.get('score') >=1 && storeItem.get('score') <=5.9){
                                                            color = '#3366FF';
                                                            text =  "Aceptable";
                                                        }else if(storeItem.get('score') >=6 && storeItem.get('score') <=24.9){
                                                                color = '#008000';
                                                                text = "Tolerable"
                                                        }else if(storeItem.get('score') >=25 && storeItem.get('score') <=59.9){
                                                                color = '#FFCC00';
                                                                text = "Cr\u00EDtico"
                                                        }else if(storeItem.get('score') >=60 && storeItem.get('score') <=100){
                                                                color = '#FF0000';
                                                                text = 'Muy Cr\u00EDtico';
                                                        }
                                                        toolTip.setHtml(storeItem.get('score') + ': ' + '<span style="color:'+color+'">'+text+'</span>');
                                                    }
                                                },
                                                style: {
                                                    renderer: function (sprite, config, rendererData, index) {
                                                        var store = rendererData.store;                                                                                                                                                                

                                                        storeItem = store.getData().items[index];                                                                                
                                                        if(storeItem.data.score >=1 && storeItem.data.score <=5.9)
                                                            config.fill = '#3366FF';                                                                                    
                                                        else if(storeItem.data.score >=6 && storeItem.data.score <=24.9)
                                                            config.fill = '#008000';
                                                        else if(storeItem.data.score >=25 && storeItem.data.score <=59.9)
                                                            config.fill = '#FFCC00';
                                                        else if(storeItem.data.score >=60 && storeItem.data.score <=100)
                                                            config.fill = '#FF0000';
                                                    }
                                                },
                                                label: {
                                                    field: 'codigo',
                                                    display: 'over',                                                                                    
                                                    font: '10px',   
                                                    fillStyle: 'black',
                                                    translationY: 18/
                                                }                                                                        
                                            }];
                                            chart.addSeries(serie);
                                        },
                                        itemclick: function (chart, item, event) {
                                            var idriesgo = item.record.data.idriesgo;
                                            var text = item.record.data.codigo;                                                                    

                                            var tabpanel = Ext.getCmp('view-Riesgos').down('tabpanel');
                                            if(!tabpanel.getChildByElement('tab-'+idriesgo)){

                                                tabpanel.add({
                                                    title: text,
                                                    id:'tab-'+idriesgo,
                                                    itemId:'tab-'+idriesgo,                                        
                                                    closable: true,
                                                    items:[                                            
                                                        new Ext.tab.Panel({
                                                            bodyPadding: 5,
                                                            autoScroll:true,                                                
                                                            items: [{
                                                                xtype:'Colsys.Riesgos.PanelGeneral',
                                                                title: "General",
                                                                id:"general"+idriesgo,
                                                                name:"general"+idriesgo,
                                                                idriesgo: idriesgo,                                                                                        
                                                                text: text
                                                            }]
                                                        })
                                                    ]
                                                }).show();
                                            }
                                        }

                                    }
                            })*/
                            ]
                        }).show();
                    }
                }]
            },{
                region: 'center',
                xtype: 'tabpanel',
                activeTab: 0,
                items: []
            },
            {
                region: 'north',
                html: '',
                border: false,
                height: 30,
                style: {
                    display: 'none'
                }            
            }/*,
            {
                region: 'south',
                title: 'South Panel',
                collapsible: true,
                html: 'Information goes here',
                split: true,
                height: 100,
                minHeight: 100
            }*/]
        });
    });    
</script>