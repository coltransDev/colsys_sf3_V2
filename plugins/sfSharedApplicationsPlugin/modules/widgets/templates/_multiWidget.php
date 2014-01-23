<script type="text/javascript">
MultiWidget = function( config ){
    Ext.apply(this, config);

    this.store = new Ext.data.Store({
				autoLoad : false,
				reader: new Ext.data.JsonReader(
					{
						root: 'root'
					},
					Ext.data.Record.create([
						{name: 'id'},
                        {name: 'valor'}
					])
				),
				proxy: new Ext.data.MemoryProxy( {"root":[],"total":0,"success":true} ),
                sortInfo: {field: 'id', direction: 'ASC'}
			});

    MultiWidget.superclass.constructor.call(this, {
        valueField: 'id', 
		displayField: 'valor', 
		forceSelection: true, 
		triggerAction: 'all', 
		emptyText:'', 
		selectOnFocus: true, 
		lazyRender:true, 
		mode: 'local', listClass: 'x-combo-list-small',
        submitValue: true
    });
};

Ext.extend(MultiWidget, Ext.form.ComboBox, {
});	
</script>
