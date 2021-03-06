new Ext.FormPanel({
		id: 'consultaseguros-form',
		layout: 'form',
		frame: true,
		title: 'Seguros',
		autoHeight: true,
		bodyStyle: 'padding: 5px 5px 0 5px;',
		labelWidth: 70,
		frame: false,
		items: [			
				<?
                include_component("widgets","transportes", array( "id"=>"transporteSeguros"));
                ?>
			]
			,

		buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("consultaseguros-form");									
				if( fp.getForm().isValid() ){
						
												
					transporte = fp.getForm().findField("transporteSeguros").getValue();													
					<?
						$url = "pricing/grillaSeguros";
						if( $opcion=="consulta" ){
							$url.= "?opcion=consulta";
						}
						?>
						
						var url = '<?=url_for( $url )?>';				
								
					Ext.Ajax.request({
						url: url,
						params: {							
							transporte: transporte
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
					Ext.MessageBox.alert('Tarifario', '?Por favor coloque los valores requeridos!');
				}	            	
			}
		}]
				
		
	})