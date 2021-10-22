<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
?>

<script type="text/javascript">


WidgetColdepositos = function( config ){
    Ext.apply(this, config);
    this.data = <?=json_encode($data)?>;
    this.store = new Ext.data.Store({
        autoLoad : true,
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
        ,proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
    });

    WidgetColdepositos.superclass.constructor.call(this, {
        valueField: 'name',
        displayField: 'id',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        submitValue: true,
        mode: 'local',
        listClass: 'x-combo-list-small'
    });
};

Ext.extend(WidgetColdepositos, Ext.form.ComboBox, {
    
    getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',   
    trigger2Class : 'x-form-select-trigger',
    hideTrigger1 : true,   
    initComponent : function() {
        WidgetColdepositos.superclass.initComponent.call(this);
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