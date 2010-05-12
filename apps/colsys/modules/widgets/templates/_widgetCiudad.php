<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetCiudad = function( config ){
    
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
						{name: 'idciudad'},
                        {name: 'ciudad'},
                        {name: 'idtrafico'}
					])
				)				
			})

    WidgetCiudad.superclass.constructor.call(this, {
        valueField: 'idciudad',
        displayField: 'ciudad',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small',
        listeners: {
            focus: this.onFocusWdg
        }
    });

    this.reload();
}


Ext.extend(WidgetCiudad, Ext.form.ComboBox, {
    reload: function( parameter ){
        if( typeof(this.idtrafico)!="undefined" && this.idtrafico ){
            var list = new Array();
            for( k in this.data ){
                var rec = this.data[k];

                if( rec.idtrafico==this.idtrafico ){
                    list.push( rec );
                }
            }
            var data = new Object();
            data.root = list;
            
            this.store.loadData(data);
        }
    }
    ,
    onFocusWdg: function( field, newVal, oldVal ){
        if( typeof(this.linkPais)!="undefined" && this.linkPais ){
            var cmp = Ext.getCmp(this.linkPais);
            if( cmp ){

               
                this.idtrafico = Ext.getCmp(this.linkPais).getValue();
                this.reload();

            }else{
                alert( "arrrrg: No existe el componente id: "+e.combo.linkPais+"!");
            }
        }

    }
});

	
</script>