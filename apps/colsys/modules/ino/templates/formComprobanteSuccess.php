<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("ino", "formComprobantePanel", array("referencia"=>$referencia));
include_component("ino", "formComprobanteSubpanel", array("referencia"=>$referencia));
?>
<div class="content">
    <div id="main-panel"></div>
    <div id="sub-panel"></div>
</div>

<script language="javascript">
     var panel = new FormComprobantePanel();
     panel.render("main-panel");

     var subpanel = new FormComprobanteSubpanel();
     subpanel.render("sub-panel");
</script>



