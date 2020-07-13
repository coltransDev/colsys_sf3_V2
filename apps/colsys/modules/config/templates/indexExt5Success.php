<style>
.x-grid-cell-inner {    
    white-space: pre-line !important;
}
</style>
<?
$permisos = $sf_data->getRaw("permisos");
//echo json_encode($permisos);

//print_r($permisos);
//echo $permisos;
//exit;
include_component("config", "gridDianServicios");
include_component("config", "formNumerosRadicacion");
include_component("config", "gridBodegas");

?>
<script>

var permisosC = Ext.decode('<?= json_encode($permisos) ?>');
Ext.Loader.setConfig({
    enabled: true,    
    paths: {
        'Ext.ux': '../js/ext5/examples/ux/',
        'Colsys':'/js/Colsys',
        'Ext.grid.plugin.Exporter':'../js/ext6/classic/classic/src/grid/plugin/Exporter.js',
        'Ext.grid.plugin':'../js/ext6/classic/classic/src/grid/plugin/',            
        'Ext.exporter':'../js/ext6/classic/classic/src/exporter/',
        'Ext.view.grid':'../js/ext6/classic/classic/src/view/grid/',
        'Ext.overrides':'../js/ext6/classic/classic/src/overrides/', 
    }
});
    
    Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.form.field.Number',
    'Ext.tip.QuickTipManager',
    'Ext.form.field.File',
    'Ext.form.Panel',
    'Ext.window.MessageBox',
    'Ext.ux.form.SearchField',
    'Ext.ux.exporter.Exporter'
    ]);
</script>

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
            collapsible: true,
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
                                    }];
                                }else if(record.data.id=="5"){
                                    console.log(permisosC);
                                    obj = [
                                    {
                                        xtype: 'Colsys.General.PanelMaestraConceptos',
                                        id: 'form-conceptos',
                                        name: 'form-conceptos',
                                        idgrid: record.data.id,
                                        permisos: permisosC
                                    }];
                                }else if(record.data.id=="6"){
                                    //console.log(permisosC);
                                    obj = [
                                    {
                                        xtype: 'Colsys.Users.GridParamUsuarios',
                                        title: "Parametros de Usuarios",
                                        idgrid: record.data.id,
                                        permisos: permisosC
                                    }];
                                }
                                
                                tabpanel.add(                                
                                    {
                                        title: record.data.text,
                                        id:'tab'+record.data.id,
                                        itemId:'tab'+record.data.id,
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
        }
        ]
    });
});


</script>