new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,				
	name: '<?=$id?>',
	id: '<?=$id?>',
	displayField: 'aplicacion',
	valueField: 'aplicacion',
	lazyRender:true,
	allowBlank: <?=$allowBlank?>,
	listClass: 'x-combo-list-small'
	,
	store : new Ext.data.Store({
		autoLoad : false,
		url: '<?=url_for("cotizaciones/datosAplicacion")?>',
		reader: new Ext.data.JsonReader(
			{
				id: 'aplicacion',
				root: 'root',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			Ext.data.Record.create([
				{name: 'aplicacion'}
			])
		),
		baseParams:{transporte:'Marítimo'}
	})	
	
	
	
})
