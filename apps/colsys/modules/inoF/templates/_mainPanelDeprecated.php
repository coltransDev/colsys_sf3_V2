<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//print_r($permisos);
include_component("inoF", "formHousePanel", array("modo" => $modo));
include_component("inoF", "gridHousePanel");

include_component("inoF", "gridFacturacionPanel");
include_component("widgets", "widgetIds");
if($permisos["restringido"]!=true)
{
    include_component("widgets", "widgetCostos",array("impoexpo"=>$referencia->getCaImpoexpo(),"transporte"=>$referencia->getCaTransporte(),"modalidad"=>$referencia->getCaModalidad()));
    include_component("inoF", "gridCostosPanel");
    include_component("inoF", "gridCostosDiscriminadosPanel");
    include_component("inoF", "gridAuditoriaPanel");
}

include_component("inoF", "gridDeduccionesPanel");
if ($referencia->getCaModalidad() == Constantes::FCL) {
    include_component("inoF", "formEquiposPanel");
    include_component("inoF", "gridEquiposPanel");
}
?>
<script type="text/javascript">

    MainPanel = function( config ){
        Ext.apply(this, config); 
        this.items = [{contentEl:'general', title: 'General', bodyStyle: this.bs}];
    
    
<?
if ($referencia->getCaModalidad() == Constantes::FCL) {
    ?>    
                this.gridEquipos = new GridEquiposPanel({
                    title: "Contenedores",
                    modo: this.modo,        
                    idmaster: <?= $referencia->getCaIdmaster() ?>,
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
                idmaster: <?= $referencia->getCaIdmaster() ?>,
                readOnly: this.readOnly
            });    
            this.items.push( this.gridHouse );

            this.gridFacturacion = new GridFacturacionPanel({
                title: "Facturación",
                modo: this.modo,
                monedaLocal: '<?= $monedaLocal ?>',
                impoexpo: this.impoexpo,
                transporte: this.transporte, 
                modalidad: this.modalidad,
                idmaster: <?= $referencia->getCaIdmaster() ?>,
                readOnly: this.readOnly
            });
            this.items.push( this.gridFacturacion );
    
            /*
    this.gridCostos = new GridCostosDiscriminadosPanel({
        title: "Costos",
        modo: this.modo,
        monedaLocal: '<?= $monedaLocal ?>',
        idmaster: <?= $referencia->getCaIdmaster() ?>,
        readOnly: this.readOnly
    });*/
            <?
            if($permisos["restringido"]!=true)
            {
            ?>
            this.gridCostos = new GridCostosPanel({
                title: "Costos",
                modo: this.modo,
                monedaLocal: '<?= $monedaLocal ?>',
                idmaster: <?= $referencia->getCaIdmaster() ?>,
                transporte:'<?=$referencia->getCaTransporte()?>',
                modalidad:'<?=$referencia->getCaModalidad()?>',                
                readOnly: this.readOnly
            });
 
            
            this.items.push( this.gridCostos );
    
            this.items.push( {contentEl:'balance', title: 'Balance', bodyStyle: this.bs} );

            this.gridAuditoria = new GridAuditoriaPanel({
                title: "Auditoria",
                modo: this.modo,
                idmaster: <?= $referencia->getCaIdmaster() ?>
            });

            this.items.push( this.gridAuditoria );
            <?
            }
            ?>
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
        Ext.extend(MainPanel, Ext.TabPanel, {
   

        });



</script>


