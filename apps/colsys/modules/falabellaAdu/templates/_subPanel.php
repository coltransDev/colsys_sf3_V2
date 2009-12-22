<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$fala_declaracion = $sf_data->getRaw( "fala_declaracion" );
include_component("falabellaAdu", "panelDeclaracion", array("fala_declaracion"=>$fala_declaracion) );
include_component("falabellaAdu", "panelFacturacion", array("fala_declaracion"=>$fala_declaracion) );
include_component("falabellaAdu", "panelNotas", array("fala_declaracion"=>$fala_declaracion) );

?>
<script type="text/javascript">

    
    SubPanel = function(){

        

        this.panelDeclaracion = new PanelDeclaracion();
        this.panelFacturacion = new PanelFacturacion();
        this.panelNotas = new PanelNotas();

        SubPanel.superclass.constructor.call(this, {
            id:'subpanel-tabs',
            labelAlign: 'top',
            bodyStyle:'padding:1px',
            activeTab: 2,
            //fileUpload: true,
            items: [
                this.panelDeclaracion,
                this.panelFacturacion,
                this.panelNotas
            ]
             

        });

    };

    Ext.extend(SubPanel, Ext.TabPanel, {

        


    });

</script>