<?
use_helper( "Ext2" );
?>

 
 
<script type="text/javascript">
	
Ext.onReady(function(){
	/*
	* Se muestra el panel de notificaciones 
	*/
	<?
	include_component("pricing", "panelNoticias");		
	?>
		   
	//Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
	  
	var treePanelOnclickHandler = function(n){			
		//var sn = this.selModel.selNode || {}; // selNode is null on initial selection							
		if( n.leaf ){  // ignore clicks on folders 				
			var nodeoptions = n.id.split("_");
			var opcion = nodeoptions[0];
			var impoexpo = nodeoptions[1];
			var transporte = nodeoptions[2];
			var modalidad = nodeoptions[3];
			
			if( impoexpo=="impo" ){
				impoexpo = "Importación";
			}
			
			if( impoexpo=="expo" ){
				impoexpo = "Exportación";
			}
			
			
			switch( opcion ){										
				case "recgen":
					/*
					* Se muestran los recargos generales para el pais seleccionado
					*/
					<?
					$url = "pricing/recargosGenerales";
					if( $opcion=="consulta" ){
						$url.= "?opcion=consulta";
					}
					?>
					var url = '<?=url_for( $url )?>';						
					break;
					
				case "reclin":
					/*
					* Se muestran los recargos generales para el pais seleccionado
					*/
					<?
					$url = "pricing/recargosPorLinea";
					if( $opcion=="consulta" ){
						$url.= "?opcion=consulta";
					}
					?>
					var url = '<?=url_for( $url )?>';						
					break;	
				case "admtraf":
					/*
					* Se muestran la administracion de trayectos para el pais seleccionado
					*/
					<?
					$url = "pricing/adminTrayectos";
					if( $opcion=="consulta" ){
						$url.= "?opcion=consulta";
					}						
					?>
					var url = '<?=url_for( $url )?>';						
					break;	
				case "files":
					/*
					* Se muestran la administracion de trayectos para el pais seleccionado
					*/
					<?
					$url = "pricing/archivosPais";
					if( $opcion=="consulta" ){
						$url.= "?opcion=consulta";
					}						
					?>
					var url = '<?=url_for( $url )?>';						
					break;								
				default: 
					/*
					*  Se muestra una grilla con la información de fletes 
					*  del trafico seleccionado
					*/	
					<?
					$url = "pricing/grillaPorTrafico";
					if( $opcion=="consulta" ){
						$url.= "?opcion=consulta";
					}						
					?>						
					var url = '<?=url_for( $url )?>';
					break;						
			}
			
			var idcomponent = opcion+"_"+impoexpo+"_"+transporte+"_"+modalidad
			
			if( nodeoptions[4] ){
				idtrafico = nodeoptions[4];
				idcomponent+="_"+idtrafico;	
			}else{
					idtrafico = "";
			}
							
			if( nodeoptions[5] ){
				if( opcion=="fletesciudad" ){
					var idciudad = nodeoptions[5]; 
					var idlinea = "";							
				}
				
				if( opcion=="fleteslinea" ){
					var idciudad = ""; 
					var idlinea = nodeoptions[5];							
				}
				
				idcomponent+="_"+nodeoptions[5];
							
			}
			
			
			if( Ext.getCmp('tab-panel').findById(idcomponent)!=null ){
				Ext.getCmp('tab-panel').activate(idcomponent);		
				//Ext.getCmp('tab-panel').show();			 
				return 0;
			}	
			
			Ext.Ajax.request({
				url: url,
				params: {			
					impoexpo: impoexpo,			
					idtrafico: idtrafico,
					transporte:transporte,
					modalidad: modalidad,
					idlinea: idlinea,
					idciudad: idciudad
				},
				success: function(xhr) {			
					//alert( xhr.responseText );			
					var newComponent = eval(xhr.responseText);
					Ext.getCmp('tab-panel').add(newComponent);
					Ext.getCmp('tab-panel').setActiveTab(newComponent);
					
				},
				failure: function() {
					Ext.Msg.alert("Tab creation failed", "Server communication failure");
				}
			});				
			
		}else{
			n.expand();
		}
	}
			
	
	var viewport = new Ext.Viewport({
		layout:'border',
		items:[
		   {
				region:'west',
				id:'west-panel',
				title:'Consultas',
				split:true,
				width: 200,
				minSize: 175,
				maxSize: 400,
				collapsible: true,
				margins:'0 0 0 5',
				layout:'accordion',
				layoutConfig:{
					animate:true
				}
				,
				items: [
					<?	
										
					include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>Constantes::IMPO, "transporte"=>Constantes::MARITIMO, "titulo"=>"Importaciones Marítimas"));						
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>Constantes::IMPO, "transporte"=>Constantes::AEREO, "titulo"=>"Importaciones Aéreas"));						
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>Constantes::EXPO, "transporte"=>Constantes::MARITIMO, "titulo"=>"Exportaciones Marítimas"));						
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>Constantes::EXPO, "transporte"=>Constantes::AEREO, "titulo"=>"Exportaciones Aéreas"));						
					?>								
					,
					<?						
					include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>Constantes::IMPO, "transporte"=>"", "titulo"=>"Cargas Nacionales"));						
					?>
					
					<?	
								
					//include_partial("formConsulta", array("opcion"=>$opcion));						?>					
					,	
					<?
					include_partial("formSeguros", array("opcion"=>$opcion));						?>								
					
					<?
					//include_partial("formOTMDTA", array("opcion"=>$opcion));						?>			
						
					<?
					//include_partial("formAduana", array("opcion"=>$opcion));						?>									
					
				]
			},
			new Ext.TabPanel({
				id:'tab-panel',
				region:'center',
				deferredRender:false,
				enableTabScroll:true,
				activeTab:0,
				items:[{
					contentEl:'center1',
					title: 'Acerca de',
					closable:false,
					autoScroll:true
				}]
			})
		 ]
	});	
});
	
	
</script>
<div id="traficos"></div>
<div id="center1">
	<br />	 	
	<h3>&nbsp;&nbsp;&nbsp;Bienvenido al sistema de administracion del tarifario. </h3><br />
	<hr />
	&nbsp;&nbsp;&nbsp;Para comenzar a trabajar por favor seleccione una ciudad del panel de traficos.
	<br />
	&nbsp;&nbsp;&nbsp;Por favor tenga en cuenta las observaciones.
	
	<br /><br />
	
	<div id="panel-noticias-wrap" >
		<div id="panel-noticias" ></div>
	</div>
</div>