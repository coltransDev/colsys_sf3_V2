<?php
$permisos = $sf_data->getRaw("permisos");
?>

<script>
    var win_cobrar = null;

    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext5/examples/ux'
        }
    });

    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer',
        'Ext.ux.CKeditor'
    ]);
</script>

<table align="center" width="98%" cellspacing="0" border="0" cellpading="0">
    <tr>
        <td>
            <div id="panel"></div>
        </td>
    </tr>
</table>

<script>
    var permisosG = Ext.decode('<?= json_encode($permisos) ?>');

    Ext.onReady(function () {
        Ext.tip.QuickTipManager.init();
        Ext.create('Ext.container.Viewport', {
            renderTo: 'panel',
            layout: 'border',
            scope: this,
            items: [{
                    region: 'north',
                    xtype: 'Colsys.Ino.FormComisionFiltrar',
                    border: false,
                    height: 60,
                    permisosG: permisosG
                }, {
                    region: 'west',
                    collapsible: true,
                    title: 'Comprobantes',
                    xtype: 'Colsys.Ino.GridComisiones',
                    width: 250,
                    permisosG: permisosG
                }, {
                    region: 'center',
                    xtype: 'tabpanel', // TabPanel itself has no title
                    activeTab: 0, // First tab active by default
                    id: 'tabDetalles',
                    items: [
                        Ext.create('Colsys.Ino.GridComisionDetalles', {
                            id: 'gridComisionDetalles',
                            title: 'Detalles de Comprobante',
                            permisosG: permisosG
                        }),
                        Ext.create('Colsys.Ino.GridComisionDetalles', {
                            id: 'gridComisionCobrar',
                            title: 'Cobrar Comisiones',
                            permisosG: permisosG
                        }),
                        Ext.create('Colsys.Ino.GridCasosAbiertos', {
                            id: 'gridCasosAbiertos',
                            title: 'Casos Abiertos',
                            permisosG: permisosG
                        })
                    ],
                    listeners: {
                        beforetabchange: function (tabPanel, newCard, oldCard, eOpts) {
//                            if (newCard.getId() == 'gridComisionCobrar' && !permisosG[1]) {
//                                Ext.MessageBox.alert("Mensaje", 'Usted no tiene acceso a Cobrar Comisiones!');
//                                return false;
//                            }
                        },
                        tabchange: function (tabPanel, newCard, oldCard, eOpts) {
                            if (newCard.id == "gridComisionCobrar") {
                                store = Ext.getCmp('gridComisionCobrar').getStore();
                                store.removeAll();

                                if (win_cobrar == null) {
                                    win_cobrar = new Ext.Window({
                                        id: 'winComisionesCobrar',
                                        title: 'Comprobante de Cobro de Comisiones',
                                        width: 300,
                                        closeAction: 'close',
                                        items: {
                                            xtype: 'Colsys.Ino.FormComisionCobrar'
                                        }
                                    });
                                }
                                win_cobrar.show();
                            }
                            if (newCard.id == "gridCasosAbiertos") {
                                console.log(Ext.getCmp('gridCasosAbiertos').getStore());
                                store = Ext.getCmp('gridCasosAbiertos').getStore();
                                store.removeAll();
                                store.getProxy().setExtraParam('idVendedor', Ext.getCmp('vendedor').value);
                                store.reload();
                            }
                        }
                    }
                }],
            listeners: {
                beforerender: function (obj, eOpts) {
//                    if ( !permisosG[0] ) {
//                        Ext.MessageBox.alert("Mensaje", 'Usted no tiene acceso a este m\u00F3dulo, solicite su autorizaci\u00F3n!');
//                        return false;
//                    }
                }
            }
        }
        );
    });

</script>