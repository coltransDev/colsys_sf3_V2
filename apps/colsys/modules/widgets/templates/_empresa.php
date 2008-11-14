
new Ext.form.ComboBox({		
	fieldLabel: '<?=$label?>',
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,
	valueField:'empresa',
	displayField:'razon',
	name: '<?=$id?>',
	id: '<?=$id?>',
	value: '<?=Constantes::COLTRANS?>',
	lazyRender:true,
	listClass: 'x-combo-list-small',
	mode: 'local',			
	store :  [['<?=Constantes::COLTRANS?>', '<?=Constantes::COLTRANS?>'],['<?=Constantes::COLMAS?>', '<?=Constantes::COLMAS?>']]
	
})