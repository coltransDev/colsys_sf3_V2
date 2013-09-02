<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



include_component("inoReportes", "formConsultaPanelComplemento");

?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){


    Ext.QuickTips.init();
    // invalid markers to sides
    Ext.form.Field.prototype.msgTarget = 'side';
    
    var formPanel = new FormConsultaPanelComplemento({
        title: "Cuadro INO",
        url: "<?=url_for("inoReportes/cuadroInoComplementoResult") ?>"
    });
        

    formPanel.render("panel");

});
</script>