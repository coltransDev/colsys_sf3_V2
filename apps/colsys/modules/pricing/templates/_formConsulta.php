new Ext.FormPanel({
		id: 'consulta-form',
		layout: 'form',
		frame: true,
		title: 'Fletes',
		autoHeight: true,
		bodyStyle: 'padding: 5px 5px 0 5px;',
		labelWidth: 100,
		
		items: [	                
				<?=include_component("widgets", "impoexpo" ,array("id"=>"impoexpo", "label"=>"Impo/Expo"))?>				
				,<?=extTransporte("transporte")?>
				,<?=extModalidad("modalidad", "Ext.getCmp('transporte')", "Importación")?>
				
				,<?=include_component("widgets", "paises" ,array("id"=>"tra_origen", "label"=>"Pais Origen", "allowBlank"=>"false"))?>										
				,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_origen", "label"=>"Ciudad Origen", "link"=>"tra_origen", "allowBlank"=>"false"))?>
						
				
				,<?=include_component("widgets", "paises" ,array("id"=>"tra_destino", "label"=>" Pais Destino", "value"=>"C0-057", "allowBlank"=>"true"))?>									
				,<?=include_component("widgets", "ciudades" ,array("id"=>"ciu_destino", "label"=>"Ciudad Destino", "link"=>"tra_destino", "allowBlank"=>"true"))?>			
				,<?=include_component("widgets", "lineas" ,array("id"=>"idlinea", "label"=>"Linea", "link"=>"transporte", "allowBlank"=>"true"))?>
				,
				new Ext.form.ComboBox({		
					fieldLabel: 'Tipo de consulta',			
					typeAhead: true,
					forceSelection: true,
					triggerAction: 'all',
					emptyText:'Seleccione',
					selectOnFocus: true,					
					lazyRender:true,
					allowBlank: 'false',
					listClass: 'x-combo-list-small',	
					id: 'tipoconsulta',
					name: 'tipoconsulta',
					value: 'fletes',
					store : [
								['fletes','Fletes'],
								['recgen','Recargos Generales'],
								['recloc','Recargos Locales'],
								['admtraf','Trayectos']
							]
				})
				
								
			]
			,

		buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("consulta-form");									
				if( fp.getForm().isValid() ){
						
					idtrafico = fp.getForm().findField("tra_origen").getValue();								
					transporte = fp.getForm().findField("transporte").getValue();								
					impoexpo = fp.getForm().findField("impoexpo").getValue();								
					modalidad = fp.getForm().findField("modalidad").getValue();								
					idlinea = fp.getForm().findField("idlinea").getValue();
					idciudad = fp.getForm().findField("ciu_origen").getValue();		
					idciudaddestino = fp.getForm().findField("ciu_destino").getValue();	
					tipoconsulta = fp.getForm().findField("tipoconsulta").getValue();					
									
					switch( tipoconsulta ){										
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
						case "recloc":
							/*
							* Se muestran los recargos locales
							*/
							<?
							$url = "pricing/recargosGenerales";
							if( $opcion=="consulta" ){
								$url.= "?opcion=consulta";
							}
							?>
							idtrafico=null; //cuando no se envia el trafico muestra los recargos locales
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
									
					Ext.Ajax.request({
						url: url,
						params: {	
							impoexpo: impoexpo,					
							idtrafico: idtrafico,
							transporte: transporte,
							modalidad: modalidad,
							idlinea: idlinea,
							idciudad: idciudad,
							idciudaddestino: idciudaddestino
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
					Ext.MessageBox.alert('Tarifario', '¡Por favor coloque los valores requeridos!');
				}	            	
			}
		}]
				
		
	})