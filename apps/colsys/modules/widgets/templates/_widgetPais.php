<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetPais = function( config ){
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
						{name: 'idtrafico'},
                        {name: 'nombre'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
			})

    WidgetPais.superclass.constructor.call(this, {
        valueField: 'idtrafico',
        displayField: 'nombre',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small',
        listeners: {
            //change: this.onChange
        }
    });
}


Ext.extend(WidgetPais, Ext.form.ComboBox, {
    /*onChange :function( field,  newValue,  oldValue ){
        
        
        if( this.linkCiudad ){
            var cmp = this.getCmp(this.linkCiudad);
            if( cmp ){
                cmp.reload(newValue);
            }else{
                alert("El componente "+this.linkCiudad+" No existe");
            }
        }

    }*/
});

	
</script>