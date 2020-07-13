<?
$anos = json_encode($sf_data->getRaw("annos"));
$meses = json_encode($sf_data->getRaw("meses"));
$sucursales = json_encode($sf_data->getRaw("sucursales"));
$traficos = json_encode($sf_data->getRaw("traficos"));

//echo $sucursales;
//exit();
?>
<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<script type="text/javascript" src="/js/ext6/build/packages/charts/classic/charts.js"></script>

<!--Libreria necesaria para convertir Html en formato para pasar a pdf con la librería pdfmake-->
<script type="text/javascript" src="/js/Colsys/Functions/browser.js"></script>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr><td><div id="panel1"></div></td></tr>
</table>
<style>
    .x-hidden-node {display: none !important;}
    .x-grid-cell-inner {    
        white-space: pre-line !important;
    }    
</style>
<script>
 
Ext.Loader.setConfig({
    enabled: true,
    paths: {
        'Chart':'../js/ext5/src/',        
        'Colsys':'/js/Colsys',    
        'Ext.ux':'/js/ext5/examples/ux',
        'Ext':'../js/ext6/classic/classic/src/',
        'Ext.plugin':'../js/ext6/classic/classic/src/plugin/'
    }
});

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();
                    
    Ext.create('Ext.container.Viewport', {
        layout: 'border',
        renderTo: 'panel',
        id: 'viewport-indicadores',
        scope:this,
        items: [{
            region: 'west',
            collapsible: true,
            title: 'Indicadores',
            split: true,
            width: 300,
            bodyPadding: 5,
            layout: {
                type: 'vbox', // Arrange child items vertically
                align: 'stretch',    // Each takes up full width ,
                pack: 'start'
            },
            items:[                
                Ext.create('Colsys.Indicadores.Internos.PanelBusqueda',{                    
                    id: 'panel-busqueda',
                    flex: 6,
                    anos: <?=$anos?>,
                    meses: <?=$meses?>,
                    sucursales: <?=$sucursales?>,
                    traficos: <?=$traficos?>
                }),
                Ext.create('Colsys.Indicadores.Internos.TreeIndicadores',{
                    id: 'tree-indicadores',
                    flex: 4
                })
               
            ]
            // could use a TreePanel or AccordionLayout for navigational items
        }, /*{
            region: 'south',
            title: 'South Panel',
            collapsible: true,
            html: 'Information goes here',
            split: true,
            height: 100,
            minHeight: 100
        },*/ {
            region: 'east',
            title: 'East Panel',
            collapsible: true,
            collapsed: true,
            split: true,
            width: 150
        }, {
            region: 'center',
            xtype: 'tabpanel',
            id:'tabpanel-center',// TabPanel itself has no title
            activeTab: 0,      // First tab active by default            
            items: [
                Ext.create('Colsys.Indicadores.Internos.TreeGridArchivos',{
                    title: "Repositorio General",
                    flex:1,
                    margin: '0 0 5 0',
                    id: 'grid-archivos-principal-',
                    url: '/indicadores/datosTreeGridArchivosPorProceso',
                    indice: '1'
                })  
            ]
        },{
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
</script>