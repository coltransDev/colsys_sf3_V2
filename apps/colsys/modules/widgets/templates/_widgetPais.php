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
			});

    WidgetPais.superclass.constructor.call(this, {
        valueField: 'idtrafico',
        displayField: 'nombre',        
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
            },
            focus: this.onFocusWdg
        }



    });
};


Ext.extend(WidgetPais, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){

            var data = new Object();
            var list = new Array();            
            if(this.tipo!="undefined" && this.tipo!="")
            {
                var cmp = Ext.getCmp(this.linkImpoexpo);
                if( cmp ){                    
                    if(this.tipo=='destino' && cmp.getValue()=='<?=constantes::IMPO?>')
                    {
                        var data1 = new Object();
                            data1.idtrafico="CO-057";
                            data1.nombre="COLOMBIA";                           
                            list.push( data1 );

                       
                        data.root = list;
                        this.store.loadData(data);
                    }
                    else if(this.tipo=='origen' && cmp.getValue()=='<?=constantes::EXPO?>')
                    {
                        var data1 = new Object();
                            data1.idtrafico="CO-057";
                            data1.nombre="COLOMBIA";

                            list.push( data1 );

                        
                        data.root = list;
                        this.store.loadData(data);
                    }
                    else
                    {
                        
                        if(this.todos)
                        {                            
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
    },
    
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',    
    trigger2Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    initComponent : function() {
        WidgetPais.superclass.initComponent.call(this);

        this.triggerConfig = {
			tag : 'span',
			cls : 'x-form-twin-triggers',
			cn : [{
				tag : 'img',
				src : Ext.BLANK_IMAGE_URL,
				cls : 'x-form-trigger ' + this.trigger1Class
			},
			{
				tag : 'img',
				src : Ext.BLANK_IMAGE_URL,
				cls : 'x-form-trigger ' + this.trigger2Class
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
		this.onTriggerClick();
	}
});

	
</script>