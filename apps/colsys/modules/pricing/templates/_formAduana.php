new Ext.FormPanel({
		id: 'consultaaduanas-form',
		layout: 'form',
		frame: true,
		title: 'Aduanas',
		autoHeight: true,
		bodyStyle: 'padding: 5px 5px 0 5px;',
		labelWidth: 70,
		frame: false,
		items: [			
				new Ext.form.ComboBox({
                fieldLabel: 'Consulta',
                typeAhead: true,
                width: 150,
                forceSelection: true,
                triggerAction: 'all',
                emptyText:'Seleccione',
                selectOnFocus: true,
                name: 'consulta-aduana',
                id: 'consulta-aduana',
                allowBlank: true,
                lazyRender:true,
                listClass: 'x-combo-list-small',
                store : [
                   ['tarifario-aduana','Tarifario Aduana']
             	 ]
               })
			]
			,

		buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("consultaaduanas-form");
				if( fp.getForm().isValid() ){
						
												
					var consulta = fp.getForm().findField("consulta-aduana").getValue();


                    var newComponent = new PanelCostosAduana({
                                                             closable: true,
                                                             title: 'Tarifario Aduana'
                                                            });
                    Ext.getCmp('tab-panel').add(newComponent);
                    Ext.getCmp('tab-panel').setActiveTab(newComponent);



								
													
				}else{
					Ext.MessageBox.alert('Tarifario', '¡Por favor coloque los valores requeridos!');
				}	            	
			}
		}]
				
		
	})