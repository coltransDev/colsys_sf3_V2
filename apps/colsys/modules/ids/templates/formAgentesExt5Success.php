<script>
//var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'Cerrar':true,'Liquidar':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}

Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Colsys':'/js/Colsys'
    }
});

</script>

<table align="center" width="70%" cellspacing="0" border="0" cellpading="0"><tr><td>
<div id="panel"></div>
<div id="sub-panel"></div>
</td></tr></table>
<script>

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();
    

    var resultsPanel =Ext.create('Ext.panel.Panel', {
        /*title: 'Hello',
        width: 600,
        height: 400,*/
         minHeight:400,
        //autoHeight:true,
        renderTo: 'panel',
        items:[
            {
                xtype: 'Colsys.Ids.FormAgentes'
                
            }
        ]
    });

/*    Ext.create("Ext.container.Viewport",{
        renderTo: 'panel',
        layout:'border',
        scope:this,
        items:[
            {
                region: 'west',
                xtype: 'Colsys.Ino.FormBusqueda',
                'permisosG':permisosG
            },
            {
                region: 'center',
                xtype: 'tabpanel',
                id:'tabpanel1',
                name:'tabpanel1',
                activeTab: 0
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
*/
    
});
</script>

