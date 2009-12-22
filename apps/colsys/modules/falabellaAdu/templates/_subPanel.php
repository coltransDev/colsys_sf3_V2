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

        SubPanel.superclass.constructor.call(this, {
            id:'subpanel-tabs',
            labelAlign: 'top',
            bodyStyle:'padding:1px',

            //fileUpload: true,
            items: [
                this.panelDeclaracion
            ]
             

        });

    };

    Ext.extend(SubPanel, Ext.TabPanel, {

        


    });

</script>