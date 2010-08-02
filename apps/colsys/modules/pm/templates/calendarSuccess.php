<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("pm", "panelCalendar");


?>

<div class="content">
    <div id="panel"></div>
</div>

<script >


var panel = new PanelCalendar({height: 500});
panel.render("panel");

</script>



