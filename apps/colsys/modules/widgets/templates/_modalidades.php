<?

?>	
new Ext.form.ComboBox({
	fieldLabel: 'Modalidad',			
	typeAhead: true,
	forceSelection: true,
	triggerAction: 'all',
	emptyText:'Seleccione',
	selectOnFocus: true,	
	name: '<?=$id?>',
	id: '<?=$id?>',
	displayField: 'modalidad',
	valueField: 'modalidad',
	lazyRender:true,
	listClass: 'x-combo-list-small',
	listeners:{focus:function( field, newVal, oldVal ){
						modalidad = Ext.getCmp('<?=$id?>');
						modalidad.store.baseParams = {transporte:Ext.getCmp('<?=$transporte?>').getValue(),impoexpo:Ext.getCmp('<?=$impoexpo?>').getValue()};
						modalidad.store.reload();
				  }
			 },
	store : new Ext.data.Store({
		autoLoad : false,
		url: '<?=url_for("cotizaciones/datosModalidades")?>',
		reader: new Ext.data.JsonReader(
			{
				id: 'modalidad',
				root: 'root',
				totalProperty: 'total',
				successProperty: 'success'
			}, 
			Ext.data.Record.create([
				{name: 'modalidad'}  
			])
		),
		baseParams:{transporte:Ext.getCmp('<?=$transporte?>').getValue(),impoexpo:Ext.getCmp('<?=$impoexpo?>').getValue()}
	})
})
