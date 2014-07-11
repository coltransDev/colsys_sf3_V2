<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("inoMaritimo", "panelReferencias");
?>
<script type="text/javascript">
    
    Ext.onReady(function(){        
        var panel = new PanelReferencias({
            title:'Listado de Referencias',
            autoHeight: "auto",
            bodyStyle: "pading: 5px",
            anio: "<?=$anio?>",
            mes: "<?=$mes?>",
            sucursal: "<?=$sucursal?>",
            sufijo: "<?=$sufijo?>",
            trafico: "<?=$trafico?>",
            usuario: "<?=$usuario?>",
            casos: "<?=$casos?>"
        });
        panel.render("main-panel");
    });

</script>


<div class="content">    
    <div id="main-panel"></div>
</div>