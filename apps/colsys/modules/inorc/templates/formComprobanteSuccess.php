<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("inorc", "formComprobantePanel", array("tipo"=>$tipo ));
include_component("inorc", "formComprobanteSubpanel");


?>
<div class="content">
    <div id="main-panel"></div>
    <div id="sub-panel"></div>
</div>

<script language="javascript">
     var panel = new FormComprobantePanel({
         idcomprobante: <?=$comprobante->getCaIdcomprobante()?$comprobante->getCaIdcomprobante():"null"?>
     });
     panel.render("main-panel");
     <?
    // if( $comprobante->getCaIdcomprobante() ){
         ?>
         var subpanel = new FormComprobanteSubpanel({
             idcomprobante: <?=$comprobante->getCaIdcomprobante()?$comprobante->getCaIdcomprobante():"null"?>             
         });
         subpanel.render("sub-panel");
         <?
     //}


     ?>
    
</script>



