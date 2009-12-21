<?
$fala_declaracion = $sf_data->getRaw( "fala_declaracion" );
$fala_detallesimp = $sf_data->getRaw( "fala_detallesimp" );
include_component("falabellaAdu", "topPanel", array("fala_declaracion"=>$fala_declaracion) );
include_component("falabellaAdu", "panelDeclaracion", array("fala_detallesimp"=>$fala_detallesimp) );
?>

<div class="content" id="content"  />

    <div id="top-panel"></div>
    <div id="panel-declaracion"></div>

    <script type="text/javascript">
        //new PanelDeclaracion()
        var panel = new TopPanel();
        panel.render("top-panel");

        var panelDeclaracion = new PanelDeclaracion();
        panelDeclaracion.render("panel-declaracion");
        panelDeclaracion.setWidth(Ext.get(document.getElementById("content")).getWidth());

    </script>

    <div id="result"></div>
</div>
