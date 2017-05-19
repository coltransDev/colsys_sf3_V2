<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}
</style>
<script>
//Ext.Loader.setPath('Ext.ux', '../js/ext5/examples/ux/');
Ext.Loader.setConfig({
    enabled: true,    
    paths: {
        'Ext.ux': '../js/ext5/examples/ux/',
        'Colsys':'/js/Colsys'
    }
});
    
    Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.form.field.Number',
    //'Ext.form.field.Date',
    'Ext.tip.QuickTipManager',
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox',
    'Ext.ux.form.SearchField',
    'Ext.ux.exporter.Exporter'
    ]);
</script>
<?
$permisos = $sf_data->getRaw("permisos");
include_component("config", "gridDianServicios");
include_component("config", "formNumerosRadicacion");
include_component("config", "gridBodegas");

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
            url: '<?=url_for("config/datosIndex")?>'
        }
    });

    
    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[{
            region: 'west',
            title: 'Administraci&oacute;n',
            autoScroll:true,
            width: 220,
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
                                    obj=[new GridDianServicios({id:'grid-dian-servicios',name:'grid-dian-servicios'})];
                                else if(record.data.id=="2")
                                {
                                    //obj={};
                                    //Ext.create('Ext.app.ContactForm', {});
                                    obj=[new FormNumerosRadicacion({id:'form-numeros-radicacion',name:'form-numeros-radicacion',frame:true})];
                                    //obj=new GridConsComprobantes({id:'grid-consulta-comprobantes',name:'grid-consulta-comprobantes'});
                                }
                                else if(record.data.id=="3")
                                {
                                    obj=[new GridBodegas({id:'form-bodegas',name:'form-bodegas',frame:true})];
                                }
                                else if(record.data.id=="4")
                                {
                                    obj=[
                                        {
                                                    xtype: 'Colsys.General.TreeClasificacion',
                                                    id: 'id-clasificacion',
                                                    name: 'id-clasificacion'                                                    
                                                    //height: 330,
                                                    //width: 800,
                                                    //ino:false
                                                },
                                        
                                    ];
                                }
                                
                                tabpanel.add(                                
                                    {
                                        title: record.data.text,
                                        id:'tab'+record.data.id,
                                        itemId:'tab'+record.data.id,
                                        items: [
                                        {
                                            items:[
                                                Ext.create('Ext.panel.Panel', {
                                                //title: 'Registro de Incidente',    
                                                    bodyPadding: 10,
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
            activeTab: 0,
            items: [/*{
                title: 'Default Tab',
                html:'Selecciona una opcion del menu'
            }*/
            

            //Ext.create('ReportsPanel', {closable: true,title:"Maritimo",id:'tab1',idsserie:"2"}),
            //Ext.create('ReportsPanel', {closable: true,title:"Aereo",id:'tab2',idsserie:"4"})

                            
            ]
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