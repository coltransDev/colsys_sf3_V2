<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<script type="text/javascript">

    
    SubPanel = function(){

        

        this.panelDeclaracion = new PanelDeclaracion();
        this.panelFacturacion = new PanelFacturacion();

        SubPanel.superclass.constructor.call(this, {
            id:'subpanel-tabs',
            labelAlign: 'top',
            bodyStyle:'padding:1px',
            activeTab: 1,
            //fileUpload: true,
            items: [
                this.panelDeclaracion,
                this.panelFacturacion
            ]
             

        });

    };

    Ext.extend(SubPanel, Ext.TabPanel, {

        


    });

</script>