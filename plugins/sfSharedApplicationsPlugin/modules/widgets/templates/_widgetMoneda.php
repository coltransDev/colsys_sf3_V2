<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");

?>

<script type="text/javascript">


WidgetMoneda = function( config ){
    Ext.apply(this, config);


    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{valor}</b><br /><span style="font-size:9px">{nombre} </span> </div></tpl>'
    );

    this.store = new Ext.data.Store({
				autoLoad : true,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                        totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'valor'},
                        {name: 'nombre'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
			});

    WidgetMoneda.superclass.constructor.call(this, {
        valorField: 'valor',
        displayField: 'valor',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        itemSelector: 'div.search-item',
        tpl: this.resultTpl,
        listClass: 'x-combo-list-small'        
    });
};


Ext.extend(WidgetMoneda, Ext.form.ComboBox, {
});


</script>