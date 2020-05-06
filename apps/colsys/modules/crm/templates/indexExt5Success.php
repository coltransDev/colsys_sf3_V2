<style>
    .x-grid-cell-inner {    
        white-space: pre-line !important;
    }

    .x-panel-header-title-default1
    {
        color: #157fcc;
        font-family: helvetica,arial,verdana,sans-serif;    
        font-weight: 300;
        line-height: 16px;
        font-size: 11px !important;
        margin: 15px;
    }

    .x-toolbar-spacer-default {
        width: 2px;
        height: 4px !important;
    }

    .x-panel-body-default {
        color: #3e4752;
        font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 13px !important;
        font-weight: 300;
    }



    /*nuevo*/
    .thumb {
        background-color: white;
        border-radius: 3px;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.60);
        display: table-cell;
        padding: 12px;
        box-sizing: border-box;
    }

    .thumb-title {
        color: #3e4752;
        font-weight: 800;
    }

    .thumb-title-small {
        color: #878ea2;
        font-size: 10px;
        font-weight: 500;
    }

    .statement-type {
        color: #878ea2;
        float: left;
        font-size: 14px;
        font-weight: bold;
        margin: 20px 5px 0;
        width: 100%;
    }

    .x-panel-body-default {
        /*background: #ececec none repeat scroll 0 0;*/
        /*background: #fff none repeat scroll 0 0;*/
        border-color: #cecece;
        border-style: solid;
        border-width: 1px;
        color: #3e4752;
        font-family: "Proxima Nova","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 15px;
        font-weight: 300;
    }

    .x-table-plain {
        border-collapse: collapse;
        border-spacing: 0;
        font-size: 0.9em;
    }

    .x-display-field{
        background-color: #F2F2F2;
        margin: 0px 5px 0 0;
        padding-left: 5px;
    }

    .x-status-line-a{
        background-color: #F2F2F2;
        margin: 0px 0px 0 0;
        padding-left: 1px;
    }

    .x-status-line-b{
        background-color: #FFFFFF;
        margin: 0px 0px 0 0;
        padding-left: 1px;
    }

    .verticaltab {    
        .x-tab-wrap{
            position: absolute;
            display: block;
            padding-left: 20px;
            transform: rotate(90deg);
        }

        .x-tab-button{
            position: absolute;
            display: block;
            padding-left: 0px;
            padding-top: 2px;
        }
    }

</style>

<?
$login=$sf_data->getRaw("login");
$idsucursal=$sf_data->getRaw("idsucursal");
$permisos=$sf_data->getRaw("permisos");
$idcliente=$sf_data->getRaw("idcliente");
$nombre=$sf_data->getRaw("nombre");
?>
<script  src="/js/ckeditor/ckeditor.js" ></script>
<script type="text/javascript" src="/js/Colsys/Functions/ExportGridToExcel.js"></script>
<script>
    Ext.Ajax.setTimeout(250000);
    var permisosG = Ext.decode('<?= json_encode($permisos) ?>');
    Ext.Loader.setConfig({
        enabled: true,
        disableCaching: true,  /*FIX-ME REvisar el problema de la actualizacion de javascript en navegadores */
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext5/examples/ux',
            'Ext.ux.exporter':'/js/ext5/examples/ux/exporter/',
            'Ext.grid.plugin.Exporter':'../js/ext6/classic/classic/src/grid/plugin/Exporter.js',
            'Ext.grid.plugin':'../js/ext6/classic/classic/src/grid/plugin/',            
            'Ext.exporter':'../js/ext6/classic/classic/src/exporter/',
            'Ext.view.grid':'../js/ext6/classic/classic/src/view/grid/',
            'Ext.overrides':'../js/ext6/classic/classic/src/overrides/'
        }
    });
    
    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
    ]);

</script>
<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr>
        <td>
            <div id="panel"></div>
            <div id="sub-panel"></div>
        </td>
    </tr>
</table>

<script>

    Ext.onReady(function () {
        Ext.tip.QuickTipManager.init();


        //var permisos={'Consultar':true,'Crear':true,'Editar':true,'Anular':true,'General':true,'House':true,'Facturacion':true,'Costos':true,'Documentos':true}

        Ext.create("Ext.container.Viewport", {
            renderTo: 'panel',
            layout: 'border',
            scope: this,
            items: [{
                    region: 'west',
                    xtype: 'Colsys.Crm.FormBusqueda',
                    'permisosG': permisosG,
                    login: '<?=$login?>',
                    idsucursal: '<?=$idsucursal?>'
                }, {
                    region: 'center',
                    xtype: 'tabpanel',
                    id: 'tabpanel1',
                    name: 'tabpanel1',
                    activeTab: 0
                }, {
                    region: 'north',
                    html: '',
                    border: false,
                    height: 30,
                    style: {
                        display: 'none'
                    }
                }
            ],
            listeners: {
                afterrender: function (obj, eOpts) {
                    var id = eval('<?=$idcliente?>');
                    if (id !== null){
                        tabpanel = Ext.getCmp('tabpanel1');
                        ref = '<?=$idcliente?>';
                        if (!tabpanel.getChildByElement('tab' + ref) && ref != "") {
                            tabpanel.add({
                                title: '<?=$nombre?>',
                                id: 'tab' + ref,
                                itemId: 'tab' + ref,
                                closable: true,
                                autoScroll: true,
                                items: [{
                                        xtype: 'Colsys.Crm.FormPrincipal',
                                        id: ref,
                                        idcliente: ref,
                                        permisos: permisosG
                                    }
                                ]
                            }).show();
                        }
                        tabpanel.setActiveTab('tab' + ref);
                    }
                }
            }
        });
    });

    function openFile(val) {
        var windowpdf = Ext.create('Colsys.Widgets.WgVerPdf', {
            sorc: val
        });
        windowpdf.show();
    }
</script>