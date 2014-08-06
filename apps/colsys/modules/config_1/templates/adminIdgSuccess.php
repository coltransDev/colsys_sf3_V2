<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("idg", "panelIdg");

?>

<div class="content">
    <div id="main-panel"></div>
    <br/></br>
    <div id="sub-panel"></div>
    <div id="resul"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
    var panel = new PanelIdg({
        title: "Administracion Idg ",
        bodyStyle: "pading: 5px"
    });
    panel.render("main-panel");

    var panel1 = new PanelConfig({
        title: "Configuracion Idg ",
        bodyStyle: "pading: 5px"
    });
    panel1.render("sub-panel");
});
</script>