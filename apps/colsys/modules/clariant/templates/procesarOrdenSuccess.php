<?
include_component("clariant", "mainPanel", array("clariant"=>$clariant) );
include_component("clariant", "subPanel", array("clariant"=>$clariant) );
?>


<div class="content" id="content"  />

    <div id="main-panel"></div>
    <div id="sub-panel"></div>

    <script type="text/javascript">
        var panel = new MainPanel();
        panel.render("main-panel");
        panel.setWidth(Ext.get(document.getElementById("content")).getWidth());
        panel.setHeight(Ext.get(document.getElementById("content")).getHeight());

        var subPanel = new SubPanel();
        subPanel.render("sub-panel");
        subPanel.setWidth(Ext.get(document.getElementById("content")).getWidth());

    </script>


    <div id="result"></div>
</div>
