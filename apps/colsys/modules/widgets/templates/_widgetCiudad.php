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
               
                this.idtrafico = Ext.getCmp(this.linkPais).hiddenValue;
                this.reload();

            }else{
                alert( "arrrrg: No existe el componente id: "+e.combo.linkPais+"!");
            }
        }

    },
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    hideTrigger2 : true,

    initComponent : function() {
        WidgetCiudad.superclass.initComponent.call(this);

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