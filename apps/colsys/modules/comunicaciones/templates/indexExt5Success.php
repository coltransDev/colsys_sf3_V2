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
        'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/'
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

include_component("comunicaciones", "gridEnvios");

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
            url: '<?=url_for("comunicaciones/datosIndex")?>'
        }
    });

    
    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[{
            region: 'west',
            title: 'Comunicaciones',
            autoScroll:true,
            split: true,
            collapsible: true,
            width: 350,
            items:[{
                xtype:'treepanel',
                id:'tree-id',
                autoScroll:true,                
                rootVisible: false,
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

                            if(!tabpanel.getChildByElement('tab'+record.data.id) && record.data.id!=""){       
                                
                                obj=[new GridEnvios({id:'grid-dian-servicios',name:'grid-dian-servicios'})];
                                Ext.getCmp("grid-dian-servicios").getStore().reload({params : {idcom : record.data.id}});
                                
                                tabpanel.add({
                                    title: record.data.text,
                                    id:'tab'+record.data.id,
                                    itemId:'tab'+record.data.id,
                                    closable: true,
                                    autoScroll:true,
                                    items: [
                                        
                                            Ext.create('Ext.panel.Panel', {
                                            //title: 'Registro de Incidente',    
                                                bodyPadding: 10,
                                                //width: 350,
                                                autoScroll:true,                                                    
                                                id:'tab-form'+record.data.id,
                                                items: obj
                                            })
                                        
                                    ]
                                }).show();
                            }
                            tabpanel.setActiveTab('tab'+record.data.id);                            
                        }
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