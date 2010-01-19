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
?>
<script type="text/javascript">

function guardarDatosPaneles(){
    <?
    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
    ?>
        gridProductos.guardarItems();
        gridRecargos.guardarItems();
        gridContviajes.guardarItems();
        gridSeguros.guardarItems();
        gridAgentes.guardarItems();
    <?
    }
    ?>
}

SubPanel = function(){
    <?       
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
    gridProductos = new PanelProductos();
    gridRecargos = new PanelRecargosCotizacion();
    gridContviajes = new PanelContViajes();
    gridSeguros = new PanelSeguros();
    gridAgentes = new PanelAgentes();
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
					   gridProductos,
                       gridRecargos,
					   gridContviajes,
					   gridSeguros,
					   gridAgentes,
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