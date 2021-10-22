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
                    xtype: 'Colsys.Ino.FormSegurosFiltrar',
                    border: false,
                    height: 60,
                    permisosG: permisosG
                }, {
                    region: 'center',
                    id: 'gridSeguros',
                    collapsible: false,
                    xtype: 'Colsys.Ino.GridSeguros',
                    permisosG: permisosG
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