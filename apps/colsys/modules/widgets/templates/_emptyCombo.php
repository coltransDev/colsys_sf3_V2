new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,				
	name: '<?=$id?>',
	id: '<?=$id?>',	
	lazyRender:true,
	allowBlank: <?=$allowBlank?>,
	listClass: 'x-combo-list-small',	
	store : []
})
