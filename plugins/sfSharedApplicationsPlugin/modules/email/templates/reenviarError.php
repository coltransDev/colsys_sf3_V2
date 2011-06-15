<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<div class="content" align="center">
    <div class="box1"   style="width: 830px">
       <?=image_tag("22x22/agt_update_critical.gif")?> <b>Atencion:</b> <?=$mensaje?>
       <br />
       <?=link_to("Volver", "email/verEmail?id=".$email->getCaIdemail())?>
</div>
</div> 