<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$incoterms = $sf_data->getRaw("incoterms");

?>
<script type="text/javascript">




WidgetIncoterms = function( config ){
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
						{name: 'valor'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$incoterms, "total"=>count($incoterms), "success"=>true) )?> )
			})

    WidgetIncoterms.superclass.constructor.call(this, {
        fieldLabel: 'Incoterms',
        valorField: 'valor',
        displayField: 'valor',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small'        
    });
}


Ext.extend(WidgetIncoterms, Ext.form.ComboBox, {

});

	
</script>