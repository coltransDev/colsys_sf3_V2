<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("antecedentes", "panelReportesAntecedentes");
include_component("antecedentes", "panelMasterAntecedentes");

?>

<div class="content">    
    <div id="main-panel"></div>
    <div id="sub-panel"></div>
</div>

<script type="text/javascript">
    
    Ext.onReady(function(){
    

        
        var panel = new PanelMasterAntecedentes({
            title: "Asignaci�n de Master",
            bodyStyle: "pading: 5px",
            numRef: "<?=$numRef?>"
        });
        panel.render("main-panel");
       
        var subpanel = new PanelReportesAntecedentes({            
            bodyStyle: "pading: 5px",
            autoHeight: "auto",
            numRef: "<?=$numRef?>"
        });
        subpanel.render("sub-panel");
        
    });

</script>


