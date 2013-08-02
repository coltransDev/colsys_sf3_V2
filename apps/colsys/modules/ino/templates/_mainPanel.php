<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("ino", "formHousePanel",array("modo"=>$modo));
include_component("ino", "gridHousePanel");

include_component("ino", "gridFacturacionPanel" );
include_component("ino", "gridCostosPanel_1",array("referencia"=>$referencia));
include_component("ino", "gridCostosDiscriminadosPanel");
//include_component("ino", "gridAuditoriaPanel");

include_component("ino", "gridDeduccionesPanel");
if($referencia->getCaModalidad()==Constantes::FCL ){
    include_component("ino", "formEquiposPanel");
    include_component("ino", "gridEquiposPanel");
}
?>
<script type="text/javascript">

MainPanel = function( config ){
    Ext.apply(this, config); 
    this.items = [{contentEl:'general', title: 'General', bodyStyle: this.bs}];
    
    
    <?
    if($referencia->getCaModalidad()==Constantes::FCL ){
    ?>    
        this.gridEquipos = new GridEquiposPanel({
            title: "Contenedores",
            modo: this.modo,        
            idmaster: <?=$referencia->getCaIdmaster()?>,
            readOnly: this.readOnly
        });
        this.items.push( this.gridEquipos );
    <?
    }
    ?>
    
    this.gridHouse = new GridHousePanel({
        title: "House",
        modo: this.modo,
        impoexpo: this.impoexpo,
        transporte: this.transporte,        
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });    
    this.items.push( this.gridHouse );

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
    this.items.push( this.gridFacturacion );
    
    /*
    this.gridCostos = new GridCostosDiscriminadosPanel({
        title: "Costos",
        modo: this.modo,
        monedaLocal: '<?=$monedaLocal?>',
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });*/
            
    this.gridCostos = new GridCostosPanel({
        title: "Costos",
        modo: this.modo,
        monedaLocal: '<?=$monedaLocal?>',
        idmaster: <?=$referencia->getCaIdmaster()?>,
        readOnly: this.readOnly
    });
            
    this.items.push( this.gridCostos );
    
    this.items.push( {contentEl:'balance', title: 'Balance', bodyStyle: this.bs} );


    /*this.gridAuditoria = new GridAuditoriaPanel({
        title: "Auditoria",
        modo: this.modo,
        idmaster: <?=$referencia->getCaIdmaster()?>
    });*/
        /*,
        this.gridAuditoria*/
      
    this.bs = 'padding: 5px 5px 5px 5px;';
    MainPanel.superclass.constructor.call(this, {        
        id: 'tpanel',
        plain:true,
        activeTab: 0,
        height:450,
        autoHeight: true,
        autoWidth : true,
        deferredRender: false,
        items: this.items
        

    });


};
//alert( panelArchivos );
Ext.extend(MainPanel, Ext.TabPanel, {
   

});



</script>


