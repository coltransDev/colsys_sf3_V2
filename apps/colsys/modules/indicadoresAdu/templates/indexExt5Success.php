<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}

.x-grid3-cell-inner, .x-grid3-hd-inner { white-space:normal !important; }
.x-column-header {
background-color: #e2e2e2;
}



</style>
    <script type="text/javascript" src="/js/jquery/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/js/highcharts4.1/js/highcharts.js"></script>    
    <script type="text/javascript" src="/js/highcharts4.1/js/modules/exporting.js"></script>
    <script type="text/javascript" src="/js/highcharts4.1/js/highcharts-3d.js"></script>
<script>

Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Chart':'../js/ext5/src/',
        'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
        'Colsys':'/js/Colsys'
    }
});

    Ext.require([
    'Ext.grid.*',    
    'Ext.form.Panel',    
    'Chart.ux.Highcharts',
    //'Chart.ux.Highcharts.PieSerie',
    'Chart.ux.Highcharts.ColumnSerie',
    'Ext.ux.exporter.Exporter'
    ]);


</script>
<?
$permisos = $sf_data->getRaw("permisos");

include_component("indicadoresAdu", "formCabControl");
include_component("indicadoresAdu", "gridConsultaCabControl",array("permisos"=>$permisos) );

include_component("indicadoresAdu", "formIndicadores");

include_component("indicadoresAdu", "gridFiltros");

include_component("indicadoresAdu", "gridFechaCierre");
include_component("indicadoresAdu", "gridCabPlantilla");
include_component("indicadoresAdu", "gridDetPlantilla");



?>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

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
            url: '<?=url_for("indicadoresAdu/datosIndex")?>'
        }
    });

    
    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        id:'viewport',
        layout:'border',
        scope:this,
        items:[{
            region: 'west',
            title: '<img src="/images/clientes/logotipoCliente1.jpg">',
            autoScroll:true,
            width: 200,
            id:'region-west',
            //collapsed :true,
            collapsible :false,
            split: false,
            //collapseMode :  'header',
            //stateful: true,
            items:[{
                xtype:'treepanel',
                id:'tree-id',
                autoScroll:true,                
                rootVisible: false,
                border:false,
                store: store,
                dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'top'
                }],
                listeners:{
                    itemclick: function(t,record,item,index){
                        //alert(!isNaN(record.data.id))
                        if(!isNaN(record.data.id))
                        {
                            var vport = t.up('viewport');
                            tabpanel = vport.down('tabpanel');

                            if(!tabpanel.getChildByElement('tab'+record.data.id) && record.data.id!="")
                            {       
                                if(record.data.id=="1")
                                {
                                    obj=[new FormCabControl({id:'form-numeros-radicacion',name:'form-numeros-radicacion',frame:true}),
                                        new GridConsCabControl({id:'grid-consulta-cabcontrol',name:'grid-consulta-cabcontrol'})
                                    ];
                                    //obj=new GridConsComprobantes({id:'grid-consulta-comprobantes',name:'grid-consulta-comprobantes'});
                                }
                                else if(record.data.id=="2")
                                {
                                       obj=[new FormIndicadores({id:'form-indicadores',name:'form-indicadores',frame:true}),
                                           {
                                                xtype: 'tabpanel',
                                                id:'tab-panel-id-indicadores',
                                                activeTab: 0,
                                                items: [
                                                ]
                                            }
                                           
                                       ];
                                }
                                else if(record.data.id=="3")
                                {
                                    obj=[new GridToGrid({id:'grid111',name:'grid111',frame:true})];
                                    
                                }
                                else if(record.data.id=="4")
                                {
                                    
                                    obj=[new GridFechaCierre({id:'grid-fecha-cierre',name:'grid-fecha-cierre',frame:true})];
                                }
                                else if(record.data.id=="5")
                                {
                                    
                                    obj=[new GridCabPlantilla({id:'grid-cab-plantilla',name:'grid-cab-plantilla',frame:true}),
                                        new GridDetPlantilla({id:'grid-det-plantilla',name:'grid-det-plantilla'})
                                    ];
                                }
                                
                                tabpanel.add(
                                    {
                                        title: record.data.text,
                                        id:'tab'+record.data.id,
                                        itemId:'tab'+record.data.id,
                                        closable :true,
                                        autoScroll: true,
                                        items: [
                                        {
                                            items:[
                                                Ext.create('Ext.panel.Panel', {
                                                //title: 'Registro de Incidente',    
                                                    bodyPadding: 10,
                                                    //height:700,
                                                    //width: 350,
                                                    autoScroll:true,
                                                    id:'tab-form'+record.data.id,
                                                    items: obj
                                                })
                                            ]
                                        }
                                    ]
                                }                                
                                ).show();
                            }
                            tabpanel.setActiveTab('tab'+record.data.id);
                            //box.hide();
                        }
                    },
                    itemmouseenter: function( t, record, item, index, e, eOpts ){
                        //alert()
                        /*if(record.data.depth==2)
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
                            
                         }*/


                    }
                }
            }]
        },{
            region: 'center',
            xtype: 'tabpanel',
            id:'tab-panel-id',
            activeTab: 0,
            //autoScroll: true,
            items: [/*{
                title: 'Default Tab',
                html:'Selecciona una opcion del menu'
            }*/
            

            //Ext.create('ReportsPanel', {closable: true,title:"Maritimo",id:'tab1',idsserie:"2"}),
            //Ext.create('ReportsPanel', {closable: true,title:"Aereo",id:'tab2',idsserie:"4"})

                            
            ]
            ,
            listeners:{
            afterrender:function( obj, eOpts )
            {
                var tabpanel=Ext.getCmp("tab-panel-id");                     
                obj=[new GridToGrid({id:'grid111',name:'grid111',frame:true})];
                tabpanel.add(
                    {
                        title: "Generador",
                        id:'tab3',
                        itemId:'tab3',
                        closable :true,
                        autoScroll: true,
                        items: [
                        {
                            items:[
                                Ext.create('Ext.panel.Panel', {
                                //title: 'Registro de Incidente',    
                                    bodyPadding: 10,
                                    //width: 350,
                                    //autoScroll:true,
                                    id:'tab-form3',
                                    items: obj
                                })
                            ]
                        }]
                    }
                ).show();
                tabpanel.setActiveTab('tab3');
                
                //opcion(28,'prueba');
                
            }
        
        }
        },
        {
            region: 'north',
            html: '',
            border: false,
            height: 30,
            style: {
                display: 'none'
            }            
        }
        ]
        
    });
});


</script>