<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("ino", "formHousePanel");
include_component("ino", "gridHousePanel");

include_component("ino", "gridFacturacionPanel" );
include_component("ino", "gridCostosPanel");
include_component("ino", "gridCostosPanel");
//include_component("ino", "gridAuditoriaPanel");

include_component("ino", "gridDeduccionesPanel");
?>
<script type="text/javascript">






MainPanel = function( config ){
    Ext.apply(this, config); 
    
    this.gridHouse = new GridHousePanel({
        title: "House",
        modo: this.modo,
        impoexpo: this.impoexpo,
        transporte: this.transporte,        
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });

    this.gridFacturacion = new GridFacturacionPanel({
        title: "Facturación",
        modo: this.modo,
        monedaLocal: '<?=$monedaLocal?>',
        impoexpo: this.impoexpo,
        transporte: this.transporte, 
        modalidad: this.modalidad,
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });

    this.gridCostos = new GridCostosPanel({
        title: "Costos",
        modo: this.modo,
        monedaLocal: '<?=$monedaLocal?>',
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });


    /*this.gridAuditoria = new GridAuditoriaPanel({
        title: "Auditoria",
        modo: this.modo,
        idmaster: <?=$referencia->getCaIdmaster()?>
    });*/

    this.bs = 'padding: 5px 5px 5px 5px;';
    MainPanel.superclass.constructor.call(this, {        
        id: 'tpanel',
        plain:true,
        activeTab: 2,
        height:450,
        autoHeight: true,
        autoWidth : true,
        deferredRender: false,
        items:[
            {contentEl:'general', title: 'General', bodyStyle: this.bs},
            this.gridHouse,
            this.gridFacturacion,
            this.gridCostos,
            {contentEl:'balance', title: 'Balance', bodyStyle: this.bs},
            /*,
            this.gridAuditoria*/
        ]
        

    });


};
//alert( panelArchivos );
Ext.extend(MainPanel, Ext.TabPanel, {
   

});



</script>


