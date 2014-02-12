<?
include_component("falabella", "panelFacturacion" );
?>

<div class="content" id="content"  />

    <div id="panel-factura"></div>

    <script type="text/javascript">
        var panelFacturacion = new PanelFacturacion();
        panelFacturacion.render("panel-factura");
        panelFacturacion.setWidth(Ext.get(document.getElementById("content")).getWidth());

    </script>

    <div id="result"></div>
</div>
