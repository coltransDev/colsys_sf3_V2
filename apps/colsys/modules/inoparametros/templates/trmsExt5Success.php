<?php

//include_component("inoparametros", "gridTrmsExt5",array("permiso"=>$permiso));
?>
<table width="440" align="center">
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
    
    
    var filterPanel = Ext.create('Ext.panel.Panel', {
        bodyPadding: 5,        
        renderTo: 'idPrincipal',
        items: [            
            {
                xtype:'Colsys.General.GridTrm',
                title: "Historico de Trms",
                permiso: '<?=$permiso?>'
            }
         ]
    });
});
</script>