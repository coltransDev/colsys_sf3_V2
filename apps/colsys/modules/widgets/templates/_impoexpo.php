
new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'',
	selectOnFocus: true,
	name: '<?=$id?>',
	id: '<?=$id?>',
	value: 'Importaci�n',
	lazyRender:true,
	listClass: 'x-combo-list-small',	
	store: [['Importaci�n', 'Importaci�n'],['Exportaci�n', 'Exportaci�n']]
})