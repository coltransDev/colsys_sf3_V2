<?
$datos=array();
?>
<script type="text/javascript">
WidgetMultiDatos = function( config ){
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
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$datos, "total"=>count($datos), "success"=>true) )?> ),
                sortInfo: {field: 'id', direction: 'ASC'}
			});

    WidgetMultiDatos.superclass.constructor.call(this, {            	        
	        xtype:'superboxselect',	        
            valueField: 'id',
            displayField: 'valor', 
	        resizable: true,	        
	        anchor:'100%',
	        mode: 'local',
            submitValue: true
    });
};

Ext.extend(WidgetMultiDatos, Ext.ux.form.SuperBoxSelect, {
});	
</script>