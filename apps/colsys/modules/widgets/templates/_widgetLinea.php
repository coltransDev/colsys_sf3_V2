<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetLinea = function( config ){
    Ext.apply(this, config);
    this.data = <?=json_encode($data)?>;
    this.store = new Ext.data.Store({
				autoLoad : false,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                        totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'idlinea'},
                        {name: 'linea'}
					])
				)
			})

    WidgetLinea.superclass.constructor.call(this, {
        valueField: 'idlinea',
        displayField: 'linea',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small'  ,
        listeners: {
            focus: this.onFocusWdg
        }
    });
}


Ext.extend(WidgetLinea, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){
        var cmp = Ext.getCmp(this.linkTransporte);
        if( cmp ){

            var list = new Array();
            var transporte = Ext.getCmp(this.linkTransporte).getValue();           
            for( k in this.data ){
                var rec = this.data[k];

                if( transporte && rec.transporte==transporte ){
                    list.push( rec );
                }
            }
            var data = new Object();
            data.root = list;

            this.store.loadData(data);
        }else{
            alert( "arrrrg: No existe el componente id: "+e.combo.linkTransporte+"!");
        }



    }
});

	
</script>