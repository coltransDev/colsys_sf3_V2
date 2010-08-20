<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("ino", "formHousePanel");
include_component("ino", "gridHousePanel");

?>
<script type="text/javascript">






MainPanel = function(){
    

    this.gridHouse = new GridHousePanel({
        title: "House",
        idmaster: <?=$referencia->getCaIdmaster()?>
    });

    this.bs = 'padding: 5px 5px 5px 5px;';
    MainPanel.superclass.constructor.call(this, {        
        id: 'tpanel',
        plain:true,
        activeTab: 0,
        height:450,
        autoHeight: true,
        autoWidth : true,
        items:[
            {contentEl:'general', title: 'General', bodyStyle: this.bs},
            this.gridHouse
        ]
        

    });


};
//alert( panelArchivos );
Ext.extend(MainPanel, Ext.TabPanel, {
   

});



</script>
