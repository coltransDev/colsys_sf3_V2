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

<script>
    Ext.Loader.setConfig({
        enabled: true,
        disableCaching: true, /*FIX-ME REvisar el problema de la actualizacion de javascript en navegadores */
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext5/examples/ux',
            'Ext.ux.exporter':'/js/ext5/examples/ux/exporter/'
        }
    });
    
    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'
    ]);
    
    Ext.onReady(function () {
        Ext.tip.QuickTipManager.init();

        Ext.Ajax.request({
            url: '/prm/cargarPermisos',

            success: function (response, opts) {
                var obj = Ext.decode(response.responseText);

                if (obj.permisos.length == 0 || obj.permisos[0] == false) {
                    Ext.Msg.alert('Error', '<center>¡Usted no tiene acceso a este modulo!<br />Por favor consulte con el administrador del sistema.</center>');
                } else {
                    Ext.create("Ext.container.Viewport", {
                        layout: 'border',
                        scope: this,
                        items: [{
                                region: 'west',
                                xtype: 'Colsys.Prm.FormBusqueda',
                                permisosG: obj.permisos
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
                        ]
                    });

                }
            },

            failure: function (response, opts) {
                Ext.Msg.alert('Error', 'Se ha presentado un error al ingresas al modulo.<br /><center>ERROR ' + response.status + '</center>');
            }
        });
    });
</script>