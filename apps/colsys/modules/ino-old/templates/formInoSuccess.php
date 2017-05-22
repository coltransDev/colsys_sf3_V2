<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("ino", "formMasterPanel",array("modo"=>$modo->getCaIdmodo()));
?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    // invalid markers to sides
    Ext.form.Field.prototype.msgTarget = 'side';
    
    var formPanel = new FormMasterPanel({
        title: "Sistema INO <?=$modo->getCaImpoexpo()?> <?=$modo->getCaTransporte()?> <?=$idmaster?"Edición de Referencia ".$referencia->getCaReferencia():"Nueva Referencia"?>",
        idmaster: <?=$idmaster?$idmaster:"null"?>,
        modo: '<?=$modo->getCaIdmodo()?>',
        impoexpo: "<?=$impoexpo?>",
        transporte: "<?=$transporte?>"
    });
    formPanel.render("panel");
});
</script>