<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetBodega = function( config ){
    Ext.apply(this, config);
    this.data = <?=json_encode($data)?>;
    this.store = new Ext.data.Store({
				autoLoad : false,
				reader: new Ext.data.JsonReader(
					{
						root: 'root'                        
					},
					Ext.data.Record.create([
                        {name: 'b_ca_idbodega'},
                        {name: 'b_ca_tipo'},
                        {name: 'b_ca_transporte'},
						{name: 'b_ca_nombre'}
					])
				)				
			});

    WidgetBodega.superclass.constructor.call(this, {
        valueField: 'b_ca_idbodega',
        displayField: 'b_ca_nombre',
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
}


Ext.extend(WidgetBodega, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){
        
        var cmp = Ext.getCmp(this.linkTransporte);
        
        if( cmp ){


            var cmp2 = Ext.getCmp(this.linkTipo);

            //if( cmp2 ){
                     
                var list = new Array();
                var transporte = Ext.getCmp(this.linkTransporte).getValue();
              //  var tipo = Ext.getCmp(this.linkTipo).getValue();
                
                for( k in this.data ){
                    var rec = this.data[k];

//                    if( transporte && rec.b_ca_transporte==transporte && rec.b_ca_tipo==tipo ){
                        list.push( rec );
//                    }
                }

                var data = new Object();
                data.root = list;

                this.store.loadData(data);
/*            }else{
                alert( "arrrrg: No existe el componente id: "+e.combo.linkTipo+"!");
            }
*/
        }else{
            alert( "arrrrg: No existe el componente id: "+e.combo.linkTransporte+"!");
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
        WidgetBodega.superclass.initComponent.call(this);

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