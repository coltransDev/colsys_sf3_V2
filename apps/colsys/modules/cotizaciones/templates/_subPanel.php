<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
    include_component("cotizaciones","panelProductos",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelRecargosCotizacion",array("cotizacion"=>$cotizacion));
//    include_component("cotizaciones","panelContViajes",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelSeguros",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelAgentes",array("cotizacion"=>$cotizacion));
}else if( $cotizacion->getCaEmpresa() == Constantes::COLMAS ){
    include_component("cotizaciones","panelProductos",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelTarifarioAduana",array("cotizacion"=>$cotizacion));
}



/*
*/
if( $cotizacion->getCaIdcotizacion() ){
    include_component("gestDocumental", "panelArchivos");
}


?>
<script type="text/javascript">



SubPanel = function(){
    this.gridProductos = new PanelProductos({tipo:'Trayecto',empresa:'<?=$cotizacion->getCaEmpresa()?>',id:'grid_productos',title:'Tarifas de trayectos'});
    <?
    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
        ?>
        this.gridRecargos = new PanelRecargosCotizacion();
        this.gridContviajes = new PanelProductos({tipo:'OTM/DTA',empresa:'<?=$cotizacion->getCaEmpresa()?>',id:'grid_productos1',title:'Tarifas para OTM/DTA'});
//        this.gridContviajes = new PanelContViajes();
        this.gridSeguros = new PanelSeguros();
        this.gridAgentes = new PanelAgentes();

        <?
    }else if( $cotizacion->getCaEmpresa() == Constantes::COLMAS ){
        ?>
        this.gridTarifarioAduana = new PanelTarifarioAduana();
        <?
    }
    ?>
    this.panelArchivos = new PanelArchivos({
                                                folder:"<?=base64_encode($cotizacion->getDirectorioBase())?>",
                                                autoHeight:true,
                                                title:"Archivos",
                                                closable:false
                                            });


    SubPanel.superclass.constructor.call(this, {
        labelAlign: 'top',
        bodyStyle:'padding:1px',
        id: 'subpanel-cotizaciones',
        items: [{
            xtype:'tabpanel',
            id: 'tpanel',
            plain:true,
            activeTab: 0,
            height:250,
            autoWidth : true,
            items:[
                this.gridProductos,
                <?
                if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
                ?>
                   this.gridRecargos,
                   this.gridContviajes,
                   this.gridSeguros,
                   this.gridAgentes,
                <?
                }else if( $cotizacion->getCaEmpresa() == Constantes::COLMAS  ){
                ?>

                   this.gridTarifarioAduana,

                <?
                }
                ?>
                this.panelArchivos
            ]
        }]

    });


};
//alert( panelArchivos );
Ext.extend(SubPanel, Ext.FormPanel, {
    guardarDatosPaneles: function(){
        <?
        if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
        ?>
            this.gridProductos.guardarItems();
            this.gridRecargos.guardarItems();
            this.gridContviajes.guardarItems();
            this.gridSeguros.guardarItems();
            this.gridAgentes.guardarItems();
        <?
        }else if($cotizacion->getCaEmpresa() == Constantes::COLMAS)
        {
        ?>
            this.gridProductos.guardarItems();
        <?
        }
        ?>
    }

});



</script>
