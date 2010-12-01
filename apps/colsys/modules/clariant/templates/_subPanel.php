<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$clariant = $sf_data->getRaw( "clariant" );
include_component("clariant", "panelDetalles", array("clariant"=>$clariant) );
include_component("clariant", "panelFacturacion", array("clariant"=>$clariant) );
include_component("clariant", "panelNotas", array("clariant"=>$clariant) );

?>
<script type="text/javascript">

    SubPanel = function(){

        this.panelDetalles = new PanelDetalles();
        this.panelFacturacion = new PanelFacturacion();
        this.panelNotas = new PanelNotas();

        SubPanel.superclass.constructor.call(this, {
            id:'subpanel-tabs',
            labelAlign: 'top',
            bodyStyle:'padding:1px',
            activeTab: 0,
            //fileUpload: true,
            items: [
                this.panelDetalles,
                this.panelFacturacion,
                this.panelNotas
            ]

        });

    };

    Ext.extend(SubPanel, Ext.TabPanel, {

    });

</script>