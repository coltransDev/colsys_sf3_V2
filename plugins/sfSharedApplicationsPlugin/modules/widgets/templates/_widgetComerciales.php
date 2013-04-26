<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$comercialesJson = $sf_data->getRaw("comercialesJson");
?>
<script type="text/javascript">

WidgetComerciales = function( config ){
    Ext.apply(this, config);

    this.store = new Ext.data.Store({
				autoLoad : true,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                        totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'login'},
                        {name: 'nombre'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$comercialesJson, "total"=>count($comercialesJson), "success"=>true) )?> )
			});

    WidgetComerciales.superclass.constructor.call(this, {
        valueField: 'login',
        displayField: 'nombre',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        submitValue: true,
        listClass: 'x-combo-list-small'
       
    });
};

Ext.extend(WidgetComerciales, Ext.form.ComboBox, {
	
});
</script>