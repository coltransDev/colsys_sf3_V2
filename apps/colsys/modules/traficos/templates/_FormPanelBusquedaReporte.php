new Ext.FormPanel({		
	id: 'form-panel-busqueda-reporte',
	layout: 'form',
	frame: true,
	title: 'Por reporte',
	autoHeight: true,
	bodyStyle: 'padding: 5px 5px 0 5px;',
	labelWidth: 40,
	frame: false,
	items: [			
		new Ext.form.ComboBox({			
			store: new Ext.data.Store({
							proxy: new Ext.data.HttpProxy({
								url: '<?=url_for('traficos/listaReportesJSON')?>'
							}),
							reader: new Ext.data.JsonReader({
									root: 'data',
									totalProperty: 'total'
								}
								,[							
									{name: 'consecutivo', mapping: 'consecutivo'}			
								]
								)
			}),			
			displayField:'consecutivo',
			valueField:'consecutivo',
			typeAhead: false,
			loadingText: 'Buscando...',
			width: 200,
			valueNotFoundText: 'No encontrado' ,
			minChars: 2,			
			emptyText:'Escriba el numero del reporte...',		
			forceSelection:true,		
			selectOnFocus:true,
			hideLabel :true,
			hiddenName: 'consecutivo'
		})
	],
	
	buttons: [{
			text     : 'Consultar',
			handler: function(){
				var fp = Ext.getCmp("form-panel-busqueda-reporte");									
				if( fp.getForm().isValid() ){																	
					consecutivo = fp.getForm().findField("consecutivo").getValue();	
					Ext.getCmp('status-grid').loadGrid('reporte',consecutivo);
				}
			}
		}]
})