<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inoparametros","panelParametrosCuentas");
?>

<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
    Ext.onReady(function(){
        var panel = new PanelParametrosCuentas({height:600});
        panel.render("panel");
    });
</script>
