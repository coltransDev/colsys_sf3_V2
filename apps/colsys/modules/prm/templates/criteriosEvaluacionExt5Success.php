<script>
    Ext.Loader.setConfig({
        enabled: true,
        disableCaching: true, /*FIX-ME REvisar el problema de la actualizacion de javascript en navegadores */
        paths: {
            'Colsys': '/js/Colsys'
        }
    });
</script>

<center>
    <table align="center" width="955px" cellspacing="0" border="0" cellpading="0">
        <tr>
            <td>
                <div id="content-div"></div>
            </td>
        </tr>
    </table>
</center>

<script>
    Ext.onReady(function () {
        Ext.tip.QuickTipManager.init();

        Ext.create("Ext.Panel", {
            renderTo: 'content-div',
            scope: this,
            items: [{
                    xtype: 'Colsys.Prm.TreeCriterios',
                }]
        })
    })
</script>