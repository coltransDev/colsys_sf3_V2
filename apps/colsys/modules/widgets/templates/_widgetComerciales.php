<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$comercialesJson = $sf_data->getRaw("comercialesJson");
?>
<script type="text/javascript">

WidgetComerciales = function( config ){
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
						{name: 'login'},
                        {name: 'nombre'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$comercialesJson, "total"=>count($comercialesJson), "success"=>true) )?> )
			})

    WidgetComerciales.superclass.constructor.call(this, {
        valueField: 'login',
        displayField: 'nombre',
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

Ext.extend(WidgetComerciales, Ext.form.ComboBox, {
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    hideTrigger2 : true,

    initComponent : function() {
        WidgetComerciales.superclass.initComponent.call(this);

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