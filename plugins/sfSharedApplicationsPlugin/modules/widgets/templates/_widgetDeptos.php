<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">


WidgetDeptos = function( config ){
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
            {name: 'id'},{name: 'valor'}
        ])
    ),
        proxy: new Ext.data.MemoryProxy( <?= json_encode(array("root" => $data, "total" => count($data), "success" => true)) ?> )
    });

    WidgetDeptos.superclass.constructor.call(this, {
        valueField: 'id',
        displayField: 'valor',
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


Ext.extend(WidgetDeptos, Ext.form.ComboBox, {

});

	
</script>