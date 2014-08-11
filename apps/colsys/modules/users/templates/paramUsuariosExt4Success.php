<?php

include_component("users", "gridParamUsuariosExt4");


?>
<div id="idPrincipal" style="margin: 10px"></div>


<script>   

Ext.onReady(function(){
    
    var filterPanel = Ext.create('Ext.panel.Panel', {
        bodyPadding: 5,        
        renderTo: 'idPrincipal',
        items: [            
            {
                xtype:'gParamUsuarios',
                title: "Parametros de Usuarios"
            }
         ]
    });
});
</script>