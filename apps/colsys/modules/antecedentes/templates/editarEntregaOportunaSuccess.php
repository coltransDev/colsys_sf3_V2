<?php
include_component("antecedentes", "panelEntregaAntecedentes", array('antecedente' => $antecedente));
?>

<div class="content">
    <div id="main-panel"></div>
</div>
<script type="text/javascript">
    Ext.onReady(function(){        
        var panel = new PanelEntregaAntecedentes({
            title: "Entrega Oportuna",
            bodyStyle: "pading: 5px"
        });
        panel.render("main-panel");
       
    });

</script>