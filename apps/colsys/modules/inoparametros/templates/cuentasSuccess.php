<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inoparametros","panelCuentas");
?>

<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
    Ext.onReady(function(){
        var panel = new PanelCuentas({autoHeight:true});
        panel.render("panel");
    });
</script>
