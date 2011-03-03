<?
include_component("falabellaAdu", "panelReferencias" );
?>

<div class="content" id="content"  />

    <div id="panel-referencias"></div>

    <script type="text/javascript">
        var panelReferencias = new PanelReferencias();
        panelReferencias.render("panel-referencias");
        panelReferencias.setWidth(Ext.get(document.getElementById("content")).getWidth());

    </script>

    <div id="result"></div>
</div>
