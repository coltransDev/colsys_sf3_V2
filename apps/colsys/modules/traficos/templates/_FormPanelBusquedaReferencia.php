new Ext.FormPanel({		
	id: 'form-panel-busqueda-referencia',
	layout: 'form',
	frame: true,
	title: 'Por referencia',
	autoHeight: true,
	bodyStyle: 'padding: 5px 5px 0 5px;',
	labelWidth: 40,
	frame: false,
	items: [			
		new Ext.form.ComboBox({			
			store: new Ext.data.Store({
							proxy: new Ext.data.HttpProxy({
								url: '<?=url_for('traficos/listaReferenciasJSON')?>'
							}),
							reader: new Ext.data.JsonReader({
									root: 'data',
									totalProperty: 'total'									
								}, [
									{name: 'referencia', mapping: 'referencia'}
								])
			}),			
			displayField:'referencia',
			valueField:'referencia',
			typeAhead: false,
			loadingText: 'Buscando...',
			width: 200,
			valueNotFoundText: 'No encontrado' ,
			minChars: 9,
			hideTrigger:true,
			emptyText:'Escriba el numero de la referencia...',		
			forceSelection:true,		
			selectOnFocus:true,
			hideLabel :true,
			hiddenName: 'referencia'
		})
	],
	
	buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("form-panel-busqueda-referencia");									
				if( fp.getForm().isValid() ){																	
					referencia = fp.getForm().findField("referencia").getValue();	
					Ext.getCmp('status-grid').loadGrid('referencia',referencia);
				}
			}
		}]
})