<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/


/*
* Se incluyen los panales
*/
include_component("reportesNeg", "formReportePanel");


include_component("widgets", "widgetTercero");


?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">
Ext.onReady(function(){
    
    

    var formPanel = new FormReportePanel({
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?>"
    });

    formPanel.render("panel");

});
</script>
<?



/*
* Modulos de Tooltips
*/
include_component("kbase","tooltipById", array("idcategory"=>18));
if( $opcion=="ayudas" ) {
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
}
?>
