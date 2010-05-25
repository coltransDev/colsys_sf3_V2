<?
include_component("falabella", "mainPanel", array("fala_header"=>$fala_header) );

include_component("falabella", "panelDetalles", array("fala_header"=>$fala_header) );
?>


<div class="content" id="content">

    <div id="main-panel"></div>
    <div id="panel-detalles"></div>

    <script type="text/javascript">
        //new PanelDetalles()
        var panel = new MainPanel();
        panel.render("main-panel");


        var panelDetalles = new PanelDetalles();
        panelDetalles.render("panel-detalles");
        //panelDetalles.setWidth(Ext.get(document.getElementById("content")).getWidth());

    </script>

    <div id="result"></div>
</div>
