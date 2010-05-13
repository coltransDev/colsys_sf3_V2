<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/


/*
* Se incluyen los panales
*/
include_component("reportesNeg", "mainPanel");

include_component("reportesNeg", "formTrayectoPanel");
include_component("reportesNeg", "formClientePanel");
include_component("reportesNeg", "formPreferenciasPanel");


include_component("widgets", "widgetTercero");


?>
<div class="content">
    <div id="panel"></div>
</div>

<script type="text/javascript">

    var bodyStyle = 'padding: 5px 5px 5px 5px;';
    tabpanel = new Ext.TabPanel({
        activeTab: 1,
        frame:true,
        defaults:{autoHeight: true},
        buttonAlign: 'center',
        title: "Reportes de Negocio <?=$reporte->getCaIdreporte()?$reporte->getCaConsecutivo()." ".$reporte->getCaVersion()."/".$reporte->numVersiones():""?>",
        items:[
            new FormTrayectoPanel({bodyStyle: bodyStyle}),
            new FormClientePanel({bodyStyle: bodyStyle}),
            new FormPreferenciasPanel({bodyStyle: bodyStyle})
        ],
        buttons: [
            {
                text   : 'Guardar'
            },
            {
                text   : 'Cancelar'
            }
        ]
    });

    tabpanel.render("panel");


</script>
<?



/*
* Modulos de Tooltips
*/
include_component("kbase","tooltipById", array("idcategory"=>18));
//if( $opcion=="ayudas" ) {
    include_component("kbase","tooltipCreator", array("idcategory"=>18));
//}
?>