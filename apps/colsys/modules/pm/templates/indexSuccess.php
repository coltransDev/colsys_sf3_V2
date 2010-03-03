<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "panelTickets");

include_component("pm", "mainPanel");



?>
<div class="content">

    <div id="panel1"></div>

</div>

<script type="text/javascript">







var panel = new MainPanel({

});




//panelTickets


panel.render("panel1");


</script>