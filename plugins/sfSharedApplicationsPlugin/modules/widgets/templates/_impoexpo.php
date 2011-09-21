
new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	name: '<?=$id?>',
	id: '<?=$id?>',
    allowBlank: <?=$allowBlank?>,
	value: 'Importación',
	lazyRender:true,
	listClass: 'x-combo-list-small',	
	store: [['Importación', 'Importación'],['Exportación', 'Exportación']]
})