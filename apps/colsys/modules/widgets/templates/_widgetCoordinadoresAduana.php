<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$usuarios = $sf_data->getRaw("usuarios");
?>
<script type="text/javascript">

WidgetCoordinadoresAduana = function( config ){
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
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$usuarios, "total"=>count($usuarios), "success"=>true) )?> )
			});

    WidgetCoordinadoresAduana.superclass.constructor.call(this, {
        valueField: 'login',
        displayField: 'nombre',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small'
       
    });
};

Ext.extend(WidgetCoordinadoresAduana, Ext.form.ComboBox, {
	
});
</script>