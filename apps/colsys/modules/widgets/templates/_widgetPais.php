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

                    if(this.todos)
                    {
                        //alert(this.data)
                        var data1 = new Object();
                        data1.idtrafico="99-999";
                        data1.nombre="Todos los Tráficos del Mundo";

                        var list = new Array();
                        list.push( data1 );
                        for( k in this.data ){
                            var rec = this.data[k];
                            list.push( rec );
                        }
                        data.root = list;
                    }
                    else
                    {
                        data.root = this.data;
                    }
                    this.store.loadData(data);
                }
            }
        }
    });
}


Ext.extend(WidgetPais, Ext.form.ComboBox, {
    
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    hideTrigger2 : true,

    initComponent : function() {
        WidgetPais.superclass.initComponent.call(this);

        this.triggerConfig = {
			tag : 'span',
			cls : 'x-form-twin-triggers',
			cn : [{
				tag : 'img',
				src : Ext.BLANK_IMAGE_URL,
				cls : 'x-form-trigger ' + this.trigger1Class
			}, {
				tag : 'img',
				src : Ext.BLANK_IMAGE_URL,
				cls : 'x-form-trigger ' + this.trigger2Class
			},
			{
				tag : 'img',
				src : Ext.BLANK_IMAGE_URL,
				cls : 'x-form-trigger ' + this.trigger3Class
			}]
		};
	},
	reset : Ext.form.Field.prototype.reset.createSequence(function() {
		this.triggers[0].hide();
	}),

	onViewClick : Ext.form.ComboBox.prototype.onViewClick.createSequence(function() {
		this.triggers[0].show();
	}),
	onTrigger1Click : function(a,b,c) {
		this.clearValue();
		this.triggers[0].hide();
		this.fireEvent('clear', this);
		this.fireEvent('select', this);
	},
	onTrigger2Click : function() {
	},
	onTrigger3Click : function() {
		this.onTriggerClick();
	}
});

	
</script>