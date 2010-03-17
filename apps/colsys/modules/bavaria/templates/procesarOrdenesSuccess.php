<?
include_component("bavaria", "mainPanel", array("ordenes"=>$ordenes) );
?>


<div class="content" id="content"  />

    <div id="main-panel"></div>

    <script type="text/javascript">
        var panel = new MainPanel();
        panel.render("main-panel");
        panel.setWidth(Ext.get(document.getElementById("content")).getWidth());
        panel.setHeight(Ext.get(document.getElementById("content")).getHeight());

    </script>


    <div id="result"></div>
</div>
