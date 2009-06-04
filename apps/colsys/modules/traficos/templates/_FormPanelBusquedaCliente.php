new Ext.FormPanel({		
	id: 'form-panel-busqueda-cliente',
	layout: 'form',
	frame: true,
	title: 'Por cliente',
	autoHeight: true,
	bodyStyle: 'padding: 5px 5px 0 5px;',
	labelWidth: 40,
	frame: false,
	items: [			
		new Ext.form.ComboBox({			
			store: new Ext.data.Store({
							proxy: new Ext.data.HttpProxy({
								url: '<?=url_for('clientes/listaClientesJSON')?>'
							}),
							reader: new Ext.data.JsonReader({
									root: 'clientes',
									totalProperty: 'totalCount',
									id: 'id'
								}, [
									{name: 'id', mapping: 'ca_idcliente'},
									{name: 'compania', mapping: 'ca_compania'},									
									{name: 'preferencias', mapping: 'ca_preferencias'},
									{name: 'confirmar', mapping: 'ca_confirmar'},
								   
								])
			}),			
			displayField:'compania',
			valueField:'id',
			typeAhead: false,
			loadingText: 'Buscando...',
			width: 200,
			valueNotFoundText: 'No encontrado' ,
			minChars: 1,
			hideTrigger:true,
			emptyText:'Escriba el nombre del cliente...',		
			forceSelection:true,		
			selectOnFocus:true,
			hideLabel :true,
			hiddenName: 'idcliente'
		})
	],
	
	buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("form-panel-busqueda-cliente");									
				if( fp.getForm().isValid() ){																	
					idcliente = fp.getForm().findField("idcliente").getValue();	
					Ext.getCmp('status-grid').loadGrid('cliente',idcliente);
				}
			}
		}]
})