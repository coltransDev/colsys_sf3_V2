<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


//include_component("ino", "formHousePanel");
include_component("ino", "gridHousePanel");

/*
include_component("ino", "gridFacturacionPanel", array("referencia"=>$referencia) );
include_component("ino", "gridCostosPanel");
include_component("ino", "gridCostosPanel");
include_component("ino", "gridAuditoriaPanel");*/
?>
<script type="text/javascript">







    
    /*
    this.gridFacturacion = new GridFacturacionPanel({
        title: "Facturación",
        idmaster: <?=$referencia->getCaIdmaster()?>
    });

    this.gridCostos = new GridCostosPanel({
        title: "Costos",
        idmaster: <?=$referencia->getCaIdmaster()?>
    });


    this.gridAuditoria = new GridAuditoriaPanel({
        title: "Auditoria",
        idmaster: <?=$referencia->getCaIdmaster()?>
    });*/

    
    



//alert( panelArchivos );

Ext.define('MainPanel', {
    extend: 'Ext.tab.Panel',
   
   
    initComponent: function(){
        
        
        this.bs = 'padding: 5px 5px 5px 5px;';
        
        this.gridHouse = Ext.create('GridHousePanel', {
            title: "House",
            idmaster: <?=$referencia->getCaIdmaster()?>
        });
        
        Ext.apply(this, {
            id: 'tpanel',
            plain:true,
            activeTab: 0,
            height:450,
            autoHeight: true,
            autoWidth : true,
            items:[
                {contentEl:'general', title: 'General', bodyStyle: this.bs},
                this.gridHouse
                /*,
                this.gridFacturacion,
                this.gridCostos,
                this.gridAuditoria*/
            ]
             
         });


        
        this.callParent(arguments);

    }


});



</script>


