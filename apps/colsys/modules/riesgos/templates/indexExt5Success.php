<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<script type="text/javascript" src="/js/ext6/build/packages/charts/classic/charts.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
<?
$criterios = $sf_data->getRaw("criterios");
$headers = $sf_data->getRaw("headers");
$criterios = json_encode($criterios);
$headers = json_encode($headers);
//exit();
?>
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

.x-column-header-inner {    
    text-align:center;
}

.x-column-header-text-container, .x-column-header-text{
    white-space : normal !important;
}
/* wrap strings w/o spaces */  
.x-grid-cell-inner{
    white-space: normal;
    word-wrap: break-word;
    word-break: break-all;
}


</style>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td><div id="panel"></div></td></tr>
</table>


<script>
    winRiesgo = null;
    
    var indice;
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Chart':'../js/ext5/src/',
            'Colsys':'/js/Colsys',
            'Ext.grid.plugin.Exporter':'../js/ext6/classic/classic/src/grid/plugin/Exporter.js',
            'Ext.grid.plugin':'../js/ext6/classic/classic/src/grid/plugin/',            
            'Ext.exporter':'../js/ext6/classic/classic/src/exporter/',
            'Ext.view.grid':'../js/ext6/classic/classic/src/view/grid/',
            'Ext.overrides':'../js/ext6/classic/classic/src/overrides/',                             
        }
    });

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
                width: 300,
                collapsible: true,
                scrollable: true,
                split: true,
                items:[{
                    xtype:'treepanel',
                    id:'tree-id',
                    rootVisible: false,
                    border:false,                    
                    store: store,
                    cls : 'rednode',                    
                    dockedItems: [{
                        xtype: 'toolbar',
                        dock: 'top',
                        items: [
                            { 
                                xtype: 'button', 
                                text: 'Cargos Críticos',
                                iconCls: 'fa fa-critical-role',
                                handler: function(t, eOpts){
                                    var vport = t.up("treepanel").up('viewport');
                                    tabpanel = vport.down('tabpanel');
                                    
                                    if(!tabpanel.getChildByElement('tab-criticos')){
                                        tabpanel.add({
                                                title: "Cargos Criticos",
                                                id:'tab-criticos',  
                                                scrollable: true,
                                                closable: true,
                                                layout: {
                                                    type: 'vbox', // Arrange child items vertically
                                                    align: 'stretch',    // Each takes up full width ,
                                                    pack: 'start'
                                                },
                                                bodyPadding: 10,                                                                    
                                                items:[{
                                                    xtype:'Colsys.Riesgos.GridCriticos',                                                    
                                                    id:"grid-criticos",
                                                    criterios: '<?=$criterios?>',
                                                    headers: '<?=$headers?>'                                                    
                                                }]
                                            }).show();
                                        tabpanel.setActiveTab('tab-criticos');
                                    }
                                    
                                }
                            },
                            { 
                                xtype: 'button', 
                                text: 'Informes Generales',
                                iconCls: 'fa fa-info',
                                menu: {
                                    items: [{
                                        text: 'Informe de Riesgos General',
                                        iconCls: 'pdf',
                                        id: 'button-riesgosgeneral',
                                        handler: function () {                                                
                                            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                title: 'Informe de Riesgos General',
                                                sorc: "/riesgos/pdfProceso/"
                                            });
                                            windowpdf.show();
                                        }
                                    }, {
                                        text: 'Informe LAFT General',
                                        iconCls: 'pdf',
                                        id: 'button-laftgeneral',
                                        handler: function () {                                                
                                            var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
                                                title: 'Informe General de Riesgos LAFT',
                                                sorc: "/riesgos/pdfProceso?laft=si"
                                            });
                                            windowpdf.show();
                                        }
                                    },{
                                        text: 'Mapa de Riesgos General',
                                        iconCls: 'map',
                                        id: 'button-mapageneral',
                                        handler: function() {
                                            Ext.getCmp("tree-id").mapaRiesgos();
                                        }
                                    },{
                                        text: 'Informe de Eventos General',
                                        iconCls: 'fa fa-window-maximize green',
                                        id: 'button-eventosgeneral',
                                        handler: function() {
                                            Ext.create('Ext.window.Window', {
                                                title: 'Informe de Eventos General',
                                                width: 1300,
                                                height: 500,
                                                id: 'winEventos',
                                                name: 'winEventos',
                                                maximizable: true,
                                                layout: {
                                                    type: 'vbox', // Arrange child items vertically
                                                    align: 'stretch',    // Each takes up full width ,
                                                    pack: 'start'
                                                },
                                                scrollable: true,                                                
                                                closeAction: 'destroy',
                                                items: [// Let's put an empty grid in just to illustrate fit layout                        
                                                    Ext.create('Colsys.Riesgos.GridEventos', {
                                                        id: 'grid-eve' + 0,
                                                        name: 'grid-eve' + 0,
                                                        border: true,                                                        
                                                        idriesgo: 0,
                                                        permisos: true
                                                    })
                                                ]
                                            }).show();
                                        }
                                    }]
                                }
                            }
                        ]
                    }],                
                    listeners:{
                        itemclick: function(t,record,item,index){                            
                            
                            switch(record.data.depth){ 
                                case 2: //Riesgo            
                                    if(record.data.text != "Versiones"){
                                        var vport = t.up('viewport');
                                        tabpanel = vport.down('tabpanel');

                                        if(!tabpanel.getChildByElement('tab-'+record.data.id)){
                                            indice=record.data.id;
                                            tabpanel.add({
                                                title: record.data.text,
                                                id:'tab-'+record.data.id,
                                                itemId:'tab-'+record.data.id,                                        
                                                closable: true,
                                                items:[{
                                                    xtype:'Colsys.Riesgos.PanelGeneral',                                                    
                                                    id:"general"+record.data.id,
                                                    name:"general"+record.data.id,
                                                    idriesgo: record.data.id,
                                                    idproceso: record.data.idproceso,
                                                    text: record.data.text,
                                                    permisos: record.data.permisos
                                                }]
                                            }).show();
                                        }
                                        tabpanel.setActiveTab('tab-'+record.data.id);
                                    }
                                    break;
                                case 3: // Versiones
                                    //console.log(utf8Decode(record.data.text));
                                    var idarchivo = utf8Decode(record.data.text)+".pdf";
                                    var archivo = Base64.encode("Procesos/"+record.data.idproceso+"/versiones/"+idarchivo);
                                    //console.log(archivo);
                                    window.open("/gestDocumental/verArchivo?idarchivo="+archivo);
                                    break;
                            }
                        },
                        itemmouseenter: function( t, record, item, index, e, eOpts ){
                            //if(record.data.depth==2)
                            //{
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
                             //}
                        },
                        itemcontextmenu: function ( t, record, item, index, e, eOpts ){
                            e.stopEvent();                            
                            var idproceso = record.data.idproceso;
                            var proceso = record.data.text; 
                            var permisos = false;
                            var data = record.data;
                            console.log(data);
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
                                                Ext.getCmp("tree-id").ventanaRiesgo2(null, record.data)                                                
                                            }
                                        },
                                        {
                                            text: 'Informe de Riesgos LAFT '+ proceso,
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
                                                    id: 'window-pdf-'+idproceso,
                                                    title: 'Informe de Riesgos '+ proceso,
                                                    sorc: "/riesgos/pdfProceso/idproceso/" + idproceso
                                                });
                                                
                                                if(permisos){
                                                    windowpdf.insertDocked(0, {
                                                        xtype: 'toolbar',
                                                        dock: 'top',
                                                        items: [{ 
                                                            xtype: 'button', 
                                                            text: 'Guardar Versión',
                                                            iconCls: 'disk',
                                                            handler: function(){
                                                                Ext.create('Colsys.Riesgos.WindowVersion',{
                                                                    title: 'Guardar ésta versión como:',
                                                                    id: 'winversion-'+idproceso,
                                                                    width: 500,
                                                                    heigth: 500,
                                                                    idproceso: idproceso
                                                                }).show();
                                                            }
                                                        }]
                                                    });
                                                }                                                
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
                                        }
                                    ]
                                }).showAt(e.getXY());
                            }
                        }
                    },
                    ventanaRiesgo2: function (form, record) {
                        console.log(form);
                        var idriesgo = form ? form.idriesgo : null;
                        var nuevo = form ? false: true;
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
                                    Ext.create('Colsys.Riesgos.FormRiesgo', {
                                        id: 'form-riesgo',
                                        name: 'form-riesgo',
                                        border: false,                                        
                                        layout: 'anchor',
                                        anchor: '100% 100%',
                                        idriesgo: idriesgo,
                                        idproceso: idproceso,
                                        nuevo: nuevo
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
                                                            autoScroll:true, 
                                                            layout: {
                                                                type: 'vbox', // Arrange child items vertically
                                                                align: 'stretch',    // Each takes up full width ,
                                                                pack: 'start'
                                                            },
                                                            bodyPadding: 10, 
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
                            ]
                        }).show();
                    }
                }]
            },{
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
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
            }]
        });
    });    
    
    function utf8Encode(unicodeString) {
        if (typeof unicodeString != 'string') throw new TypeError('parameter ‘unicodeString’ is not a string');
        const utf8String = unicodeString.replace(
            /[\u0080-\u07ff]/g,  // U+0080 - U+07FF => 2 bytes 110yyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xc0 | cc>>6, 0x80 | cc&0x3f); }
        ).replace(
            /[\u0800-\uffff]/g,  // U+0800 - U+FFFF => 3 bytes 1110xxxx, 10yyyyyy, 10zzzzzz
            function(c) {
                var cc = c.charCodeAt(0);
                return String.fromCharCode(0xe0 | cc>>12, 0x80 | cc>>6&0x3F, 0x80 | cc&0x3f); }
        );
        return utf8String;
    }

    /**
     * Decodes utf-8 encoded string back into multi-byte Unicode characters.
     *
     * Can be achieved JavaScript by decodeURIComponent(escape(str)),
     * but this approach may be useful in other languages.
     *
     * @param   {string} utf8String - UTF-8 string to be decoded back to Unicode.
     * @returns {string} Decoded Unicode string.
     */
    function utf8Decode(utf8String) {
        if (typeof utf8String != 'string') throw new TypeError('parameter ‘utf8String’ is not a string');
        // note: decode 3-byte chars first as decoded 2-byte strings could appear to be 3-byte char!
        const unicodeString = utf8String.replace(
            /[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,  // 3-byte chars
            function(c) {  // (note parentheses for precedence)
                var cc = ((c.charCodeAt(0)&0x0f)<<12) | ((c.charCodeAt(1)&0x3f)<<6) | ( c.charCodeAt(2)&0x3f);
                return String.fromCharCode(cc); }
        ).replace(
            /[\u00c0-\u00df][\u0080-\u00bf]/g,                 // 2-byte chars
            function(c) {  // (note parentheses for precedence)
                var cc = (c.charCodeAt(0)&0x1f)<<6 | c.charCodeAt(1)&0x3f;
                return String.fromCharCode(cc); }
        );
        return unicodeString;
    }
</script>

