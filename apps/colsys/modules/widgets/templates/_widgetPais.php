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
						{name: 'idtrafico'},
                        {name: 'nombre'}
					])
				)
                //,proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
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
            render  : function(a ){
                if( this.pais && this.pais!="todos" ){
					pais=this.pais.split(",");


                    var list = new Array();
                    for( k in this.data ){
                        var rec = this.data[k];

                        //if( rec.idtrafico==this.pais )
						if(jQuery.inArray(rec.idtrafico, pais)>=0)
						{
                            list.push( rec );
                        }
                    }
                    var data = new Object();
                    data.root = list;                    
                    this.store.loadData(data);
                }
                else if( this.pais=="todos" )
                {
                    var data = new Object();
                    data.root = this.data;
                    this.store.loadData(data);
                }
            }
        }
    });
}


Ext.extend(WidgetPais, Ext.form.ComboBox, {
    
/*
    onRender: function(){

    }
*/
       //alert(this.pais)

/*        if( typeof(this.idtrafico)!="undefined" && this.idtrafico ){
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
*/
    
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