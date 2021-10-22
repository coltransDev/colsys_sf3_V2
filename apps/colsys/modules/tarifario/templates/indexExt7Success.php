<link type="text/css" rel="stylesheet" href="/css/logistic.css">
<!--<script type="text/javascript" src="/js/ext6/build/packages/charts/classic/charts.js"></script>
<link type="text/css" rel="stylesheet" href="/css/Tarifario-all_1.css">
<link type="text/css" rel="stylesheet" href="/css/Tarifario-all_2.css">-->

<script>


    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            'Colsys': '/js/Colsys',
            'Ext.ux': '/js/ext7/classic/classic/src/ux/',
            'Chart': '/js/ext5/src/'
        }
    });
    Ext.onReady(function () {
        Ext.application({
            name: 'Tarifario',

            extend: 'Colsys.Tarifario.Application',

            autoCreateViewport: 'Colsys.Tarifario.app.view.main.Main',

            //-------------------------------------------------------------------------
            // Most customizations should be made to ExecDashboard.Application. If you need to
            // customize this file, doing so below this section reduces the likelihood
            // of merge conflicts when upgrading to new versions of Sencha Cmd.
            //-------------------------------------------------------------------------

//                requires: [
//                    'Colsys.Tarifario.*'
//                ]
        });
    });

</script>