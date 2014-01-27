<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("inoMaritimo", "panelGridHouse");

?>

<div class="content">    
    <div id="main-panel"></div>
    <div id="sub-panel"></div>
    <div id="resul"></div>
</div>

<script type="text/javascript">
    
    Ext.onReady(function(){        
       
        var subpanel = new PanelGridHouse({            
            bodyStyle: "pading: 5px",
            autoHeight: "auto",
            numRef: "<?=$numRef?>"
        });
        subpanel.render("sub-panel");
        
    });

</script>


