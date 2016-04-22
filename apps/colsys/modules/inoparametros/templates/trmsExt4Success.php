<?php

include_component("inoparametros", "gridTrmsExt4",array("permiso"=>$permiso));


?>
<table width="440" align="center">
    <td><div id="idPrincipal" style="margin: 10px"></div></td>
</table>

<script>   

Ext.onReady(function(){
    
    var filterPanel = Ext.create('Ext.panel.Panel', {
        bodyPadding: 5,        
        renderTo: 'idPrincipal',
        items: [            
            {
                xtype:'gTrms',
                title: "Historico de Trms"
            }
         ]
    });
});
</script>