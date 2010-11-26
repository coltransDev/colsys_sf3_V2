<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">
WidgetParametros = function( config ){
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
						{name: 'id'},
                        {name: 'name'}
					])
				)
			});

    WidgetParametros.superclass.constructor.call(this, {
        mode: 'local',
        displayField: 'name',
        valueField: 'id',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        listClass: 'x-combo-list-small',
        listeners: {
            focus: this.onFocusWdg            
        }
    });
};

Ext.extend(WidgetParametros, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){
        var list = new Array();
        
        if( this.caso_uso ){
       
            for( k in this.data ){
                var rec = this.data[k];
                if( rec.caso_uso==this.caso_uso ){
                    if(this.idvalor=="valor")
                        rec.id=rec.name;
                    list.push( rec );
                }
            }

            var data = new Object();
            data.root = list;
            this.store.loadData(data);
        }
    },
    

    getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',    
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,

    initComponent : function() {
        WidgetParametros.superclass.initComponent.call(this);

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
		this.onTriggerClick();
	}

});


</script>