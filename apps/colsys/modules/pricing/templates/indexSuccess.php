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
		/*
		* Panel de administracion de archivos del cada trafico
		*/
		var storeFileView = new Ext.data.JsonStore({
			url: '<?=url_for("pricing/archivosPaisDatos")?>',
			root: 'files',
			fields: ['idarchivo','name', 'descripcion', 'icon',{name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}]
			//proxy: new Ext.data.MemoryProxy(data)
		});
		//store.load();
		
		var tpl = new Ext.XTemplate(
			'<tpl for=".">',
				
				'<div class="thumb-wrap" id="{name}">',
				'<div class="thumb">{icon}</div>',
				'<span class="x-editable">{name}</span></div>',
				
			'</tpl>',
			'<div class="x-clear"></div>'
		);
		
		var nuevoBtnHandler = function(){
			
			win = new Ext.Window({
				//applyTo     : 'hello-win',
				//layout      : 'fit',
				width       : 400,
				height      : 200,
				closeAction :'close',
				plain       : true,		
				
				items       : new Ext.FormPanel({
					fileUpload: true,
					enctype:  'multipart/form-data',			
					id: 'file-panel-form',
					//width: 500,
					frame: true,
					title: 'Por favor seleccione un archivo',
					autoHeight: true,
					bodyStyle: 'padding: 10px 10px 0 10px;',
					labelWidth: 50, 
					
					/*
					defaults: {
						anchor: '95%',
						allowBlank: false,
						msgTarget: 'side'
					},*/
					items: [{
						xtype: 'fileuploadfield',
						id: 'form-file',
						emptyText: 'Seleccione un archivo',
						fieldLabel: 'Archivo',
						//hiddenName: 'file',
						name: 'file',
						buttonCfg: {
							text: '',
							iconCls: 'upload-icon'
						}
					}]
					
				}),
		
				buttons: [{
					text     : 'Guardar',
					handler: function(){						
						var panelactivoid = Ext.getCmp('tab-panel').getActiveTab().id;	
						var nodeoptions = panelactivoid.split("_");												
						var fp = Ext.getCmp("file-panel-form");					
						if(fp.getForm().isValid()){
							fp.getForm().submit({
								url: '<?=url_for("pricing/subirArchivo")?>',
								params: {idtrafico:nodeoptions[1], transporte:nodeoptions[2]},
								waitMsg: 'Cargando el archivo...',
								success: function(fp, o){	
									storeFileView.reload();								
									win.close();						
									Ext.Msg.alert('Success', 'El archivo "'+o.result.file+'" se ha guardado en el servidor');																															
											
								},
								failure: function(xhr){  
									Ext.Msg.alert('Error', 'Ha ocurrido un error al guardar el archivo');					
								}
							});
						}
					}
				},{
					text     : 'Cancelar',
					handler  : function(){
						win.close();
					}
				}]
			});
			
			win.show( );
		
		}
		
		var panelArchivos = new Ext.Panel({
			id:'file-panel-view',
			frame:false,
			width:535,
			autoHeight:true,
			collapsible:true,
			layout:'fit',
			title:'Archivos',
			
			items: new Ext.DataView({
				store: storeFileView,
				tpl: tpl,
				id: 'file-view',
				autoHeight:true,
				singleSelect : true,
				overClass:'x-view-over',
				itemSelector:'div.thumb-wrap',
				emptyText: 'No hay archivos en este tr&aacute;fico',
						
				/*
				plugins: [
					new Ext.DataView.DragSelector(),
					new Ext.DataView.LabelEditor({dataIndex: 'name'})
				],
				*/
				prepareData: function(data){
					data.shortName = Ext.util.Format.ellipsis(data.name, 15);
					data.sizeString = Ext.util.Format.fileSize(data.size);
					data.dateString = data.lastmod.format("m/d/Y g:i a");
					return data;
				},
				
				listeners: {
					selectionchange: {
						fn: function(dv,nodes){
							/*var l = nodes.length;
							var s = l != 1 ? 's' : '';
							panel.setTitle('Simple DataView ('+l+' item'+s+' selected)');*/
						}
					}
				}
			}),
			tbar: [			  
			{
				text: 'Nuevo',
				tooltip: 'Sube un nuevo archivo',
				iconCls:'add',
				handler: nuevoBtnHandler
			}
			,
			{
				text: 'Abrir',
				tooltip: 'Abre el archivo seleccionado',
				iconCls:'folder',  // reference to our css
				handler: function(){
					var fv = Ext.getCmp("file-view");	
					records =  fv.getSelectedRecords();			
					for( var i=0;i<records.length; i++){				
						popup( "<?=url_for("pricing/verArchivo")?>?idarchivo="+records[i].data.idarchivo );
					}
				}
			},
			{
				text: 'Borrar',
				tooltip: 'Elimina el archivo seleccionado',
				iconCls:'delete',  // reference to our css
				handler: function(){
					var fv = Ext.getCmp("file-view");	
					records =  fv.getSelectedRecords();			
					for( var i=0;i<records.length; i++){				
						if( confirm( 'Esta seguro que desea borrar el archivo seleccionado?') ){									
		
							Ext.Ajax.request({
								url: '<?=url_for("pricing/borrarArchivo")?>',
								params: {						
									idarchivo: records[i].data.idarchivo						
								},
								success: function(xhr) {	
									storeFileView.reload();	
									Ext.Msg.alert("Success", "Se ha eliminado el archivo");							
									
								},
								failure: function() {
									Ext.Msg.alert("Error", "No se ha podido eliminar el archivo");
								}
							});
						}
					}
						
				}
			}
			]
		});
	   /*
	   * Se crea un combo para los recargos 
	   */
	   	   
	   
	   
	   
	   
	   
       Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
       
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
	    
		var tabPanelOnTabchangeHandler = function( panel , component ){
			/*
			* Se muestra panel con los archivos del pais
			*/						
			var nodeoptions = component.id.split("_");		
			if(nodeoptions[0]=="fletes"){							
				storeFileView.reload( {params:{idtrafico:nodeoptions[1], transporte: nodeoptions[2]}} );				
				
			}else{
				storeFileView.removeAll();
			}
			//alert("asdasd"+p);
		}
		
		var viewport = new Ext.Viewport({
            layout:'border',
            items:[
               {
                    region:'east',
                    title: 'Información adicional',
                    collapsible: true,
                    split:true,
                    width: 225,
                    minSize: 175,
                    maxSize: 400,
                    layout:'fit',
                    margins:'0 5 0 0',
                    items:
                        new Ext.TabPanel({
                            border:false,
                            activeTab:0,
                            tabPosition:'bottom',	
							id: 'panel-info',						
                            items:[ panelArchivos ]
                        })
                 },{
                    region:'west',
                    id:'west-panel',
                    title:'Consultas',
                    split:true,
                    width: 290,
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
						include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>"Importación", "transporte"=>"Marítimo", "titulo"=>"Importaciones Marítimas"));						
						?>								
						,
						<?						
						include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>"Importación", "transporte"=>"Aéreo", "titulo"=>"Importaciones Aéreas"));						
						?>								
						,
						<?						
						include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>"Exportación", "transporte"=>"Marítimo", "titulo"=>"Exportaciones Marítimas"));						
						?>								
						,
						<?						
						include_component("pricing","panelConsultaCiudades", array("opcion"=>$opcion, "impoexpo"=>"Exportación", "transporte"=>"Aéreo", "titulo"=>"Exportaciones Aéreas"));						
						?>								
						,
						<?				
						//include_partial("formConsulta", array("opcion"=>$opcion));						?>						
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
                    //deferredRender:false,
					enableTabScroll:true,
                    activeTab:0,
                    items:[{
                        contentEl:'center1',
                        title: 'Acerca de',
                        closable:false,
                        autoScroll:true
                    }],
					listeners:{ 
						 tabchange : tabPanelOnTabchangeHandler 
					} 
                })
             ]
        });
        
    });
	
	
</script>
  
<div id="traficos"></div>

<div id="center2">
   &nbsp;        
</div>
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
<div id="props-panel" style="width:200px;height:200px;overflow:hidden;">
</div>
 
