<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
    include_component("cotizaciones","panelProductos",array("cotizacion"=>$cotizacion));
    include_component("cotizaciones","panelRecargosCotizacion",array("cotizacion"=>$cotizacion,"tipo"=>"Recargo Local"));
}
?>
<script type="text/javascript">

function guardarDatosPaneles(){
    grid_productos.guardarItems();
    grid_recargos.guardarItems();
    updateContViajeModel();
    updateSeguroModel();
    guardarGridAgentes();

}

SubPanel = function(){
    
    

    <?


    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
        //mejor cambie grilla x grid, suena mejor                
        include_component("cotizaciones","grillaContViajes",array("cotizacion"=>$cotizacion));
        include_component("cotizaciones","grillaAgentes",array("cotizacion"=>$cotizacion));
    }
    include_component("cotizaciones","grillaSeguros",array("cotizacion"=>$cotizacion));
    
    /*
	* ================  Panel de archivos adjuntos  =======================
	* Crea el objeto $object que contine el panel solicitado
	*/
	
	if( $cotizacion->getCaIdcotizacion() ){
        include_component("gestDocumental", "panelArchivos",
						array("folder"=>$cotizacion->getDirectorioBase(),
							"object"=>"panelArchivos",
							"closable"=>false
						));
	}
    ?>

    <?
    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
    ?>
    grid_productos = new PanelProductos();
    grid_recargos = new PanelRecargosCotizacion();
    <?
    }
    ?>
    MainPanel.superclass.constructor.call(this, {
       labelAlign: 'top',
			bodyStyle:'padding:1px',

			items: [{
				xtype:'tabpanel',
				id: 'tpanel',
				plain:true,
				activeTab: 0,
				height:250,
				autoWidth : true,
				defaults:{bodyStyle:'padding:10px'},
				items:[
					<?
					if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS  ){
					?>
					   grid_productos,
                       grid_recargos,
					   grid_contviajes,
					   grid_seguros,
					   grid_agentes,
					<?
					}
					?>
					panelArchivos
				]
			}]

    });


};

Ext.extend(SubPanel, Ext.FormPanel, {
    

});

</script>