<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


include_component("inocomprobantes", "formComprobantePanel", array("tipo"=>$tipo ));
include_component("inocomprobantes", "formComprobanteSubpanelF");


//if( $comprobante->getCaIdcomprobante() ){
    /*switch( $comprobante->getInoTipoComprobante()->getcaTipo() ){
        case "F":
           
            break;
        case "P":
            include_component("inocomprobantes", "formComprobanteSubpanelPConceptos", array("comprobante"=>$comprobante ));
            include_component("inocomprobantes", "formComprobanteSubpanelPDeducciones", array("comprobante"=>$comprobante ));
            include_component("inocomprobantes", "formComprobanteSubpanelP", array("comprobante"=>$comprobante ));
            break;
    }*/
//}
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



