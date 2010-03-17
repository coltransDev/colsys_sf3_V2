<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
    include_component("cotizaciones","panelProductos",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelRecargosCotizacion",array("cotizacion"=>$cotizacion,"tipo"=>"Recargo Local"));
    include_component("cotizaciones","panelContViajes",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelSeguros",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelAgentes",array("cotizacion"=>$cotizacion));
}


if( $cotizacion->getCaEmpresa() == Constantes::COLMAS ){
    include_component("cotizaciones","panelTransporteAduana",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelTarifarioAduana",array("cotizacion"=>$cotizacion));
}



/*
* ================  Panel de archivos adjuntos  =======================
*/
if( $cotizacion->getCaIdcotizacion() ){
    include_component("gestDocumental", "panelArchivos");
}


?>
<script type="text/javascript">



SubPanel = function(){
    <?
    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
        ?>
        this.gridProductos = new PanelProductos();
        this.gridRecargos = new PanelRecargosCotizacion();
        this.gridContviajes = new PanelContViajes();
        this.gridSeguros = new PanelSeguros();
        this.gridAgentes = new PanelAgentes();
        
        <?
    }

    if( $cotizacion->getCaEmpresa() == Constantes::COLMAS ){
        ?>
        this.gridTransporte = new PanelTransporteAduana();
        this.gridTarifarioAduana = new PanelTarifarioAduana();
        <?
    }
    ?>
    this.panelArchivos = new PanelArchivos({
                                                folder:"<?=base64_encode($cotizacion->getDirectorioBase())?>",
                                                closable:true,
                                                autoHeight:true,
                                                title:"Archivos",
                                                closable:false
                                            });
    

    MainPanel.superclass.constructor.call(this, {
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
                <?
                if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
                ?>
                   this.gridProductos,
                   this.gridRecargos,
                   this.gridContviajes,
                   this.gridSeguros,
                   this.gridAgentes,                   
                <?
                }
                if( $cotizacion->getCaEmpresa() == Constantes::COLMAS  ){
                ?>
                   this.gridTransporte,
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
        }
        ?>
    }

});



</script>