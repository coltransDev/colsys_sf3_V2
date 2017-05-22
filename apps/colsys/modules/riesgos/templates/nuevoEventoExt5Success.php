
<link rel="stylesheet" type="text/css"  href="/js/ext6/build/packages/charts/classic/classic/resources/charts-all.css"/>
<table  align="center">
    <td><div id="idPrincipal" style="margin: 10px"></div></td>
</table>
<script>   
    Ext.Loader.setConfig({
        enabled: true,
        paths: {
            //'Ext.ux.exporter':'../js/ext5/examples/ux/exporter/',
            'Colsys':'/js/Colsys',
            'Ext.ux':'../js/ext5/examples/ux'
        }
    });

    Ext.require([
        'Ext.ux.exporter.Exporter',
        'Ext.ux.Explorer'    
    ]);

    Ext.onReady(function(){

        var idriesgo = <?=$idriesgo?>;    
        var idproceso = <?=$idproceso?>;
        var idevento = null;

        var eventoPanel = Ext.create('Ext.panel.Panel', {
            bodyPadding: 5,        
            renderTo: 'idPrincipal',
            title: 'Nuevo Evento '+'<?=$proceso->getCaNombre()?>',
            width: 500,
            height: 700,
            items: [            
                {
                    xtype:'Colsys.Riesgos.FormEvento',
                    id: 'form-evento'+ idriesgo,
                    name: 'form-evento'+ idriesgo,
                    title: '<?=$nombre?>',
                    border: true,
                    layout: 'anchor',
                    anchor: '90% 90%',
                    idriesgo: idriesgo,
                    idevento: idevento,
                    nuevo: true
                }
             ]
        });

        var data = new Array;
        data['nuevo'] = true;
        data['iddoc'] = <?=$iddoc?>; // 
        data['documento'] = '<?=$documento?>';
        data['idcliente'] = <?=$idcliente?>;
        data['idsucursal'] = '<?=$idsucursal?>';

        Ext.getCmp("form-evento" +  idriesgo).llenarCampos(idriesgo, data);
    });
</script>