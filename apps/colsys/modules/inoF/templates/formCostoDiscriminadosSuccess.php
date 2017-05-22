<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

include_component("inoF", "formCostosDiscriminadosPanel", array("modo"=>$modo));
include_component("inoF", "formCostosDiscriminadosGridPanel", array("modo"=>$modo));


?>



<div class="content">  

    <div id="panel"></div>
    <div id="panel2"></div>
</div>



<script type="text/javascript">
    var panel = new FormCostosDiscriminadosPanel({
        title: 'Facturas de proveedores', 
        modo: '<?=$modo->getCaIdmodo()?>',
        impoexpo: '<?=$modo->getCaImpoexpo()?>',
        transporte: '<?=$modo->getCaTransporte()?>',
        modalidad: '<?=$referencia->getCaModalidad()?>',
        idmaster: '<?=$referencia->getCaIdmaster()?>',
        readOnly: <?=$referencia->getCaFchliquidado()||$referencia->getCaFchcerrado()?"true":"false"?>,
        idcomprobante: <?=$comprobante?$comprobante->getCaIdcomprobante():"null"?>
    });
    panel.render("panel");
    
    
    var panel2 = new FormCostosDiscriminadosGridPanel({
        modo: '<?=$modo->getCaIdmodo()?>',
        impoexpo: '<?=$modo->getCaImpoexpo()?>',
        transporte: '<?=$modo->getCaTransporte()?>',
        idmaster: '<?=$referencia->getCaIdmaster()?>',
        readOnly: <?=$referencia->getCaFchliquidado()||$referencia->getCaFchcerrado()?"true":"false"?>,
        idcomprobante: <?=$comprobante?$comprobante->getCaIdcomprobante():"null"?>,
        id: 'panel-discriminacion'
    });
    panel2.render("panel2");

</script>