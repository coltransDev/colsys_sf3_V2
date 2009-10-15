<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>
<script type="text/javascript">


SubPanel = function(){
    
    function guardarItems(){		
		guardarGridProductos();
		updateRecargosModel();
		updateContViajeModel();		
		updateSeguroModel();
		guardarGridAgentes();
		
	}

    <?


    if( $cotizacion->getCaEmpresa() == Constantes::COLTRANS ){
        include_component("cotizaciones","grillaProductos",array("cotizacion"=>$cotizacion));
        include_component("cotizaciones","grillaRecargos",array("cotizacion"=>$cotizacion,"tipo"=>"Recargo Local"));
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