<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");

?>

<script type="text/javascript">


WidgetModalidad = function( config ){
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
                        {name: 'idmodalidad'},
                        {name: 'impoexpo'},
                        {name: 'transporte'},
						{name: 'modalidad'}
					])
				)
				,proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
			});
    WidgetModalidad.superclass.constructor.call(this, {
        valueField: 'modalidad',
        displayField: 'modalidad',
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
};

Ext.extend(WidgetModalidad, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){
        
        var cmp = Ext.getCmp(this.linkTransporte);
        if( cmp ){
            var cmp2 = Ext.getCmp(this.linkImpoexpo);
            var impoexpoVal = this.impoexpo;
            if( cmp2 || impoexpoVal){

                var list = new Array();
                var transporte = Ext.getCmp(this.linkTransporte).getValue();
                if( impoexpoVal ){
                    var impoexpo = impoexpoVal;
                }else{
                    var impoexpo = Ext.getCmp(this.linkImpoexpo).getValue();
                }

                if(impoexpo=='<?=constantes::OTMDTA?>' || impoexpo=='<?=constantes::OTMDTA1?>' )
                {
                    impoexpo='<?=Constantes::OTMDTA?>'
                }
                for( k in this.data ){
                    var rec = this.data[k];					
                    if( transporte && impoexpo && rec.transporte==transporte && rec.impoexpo==impoexpo ){
                        list.push( rec );
                    }
                }
                
                var data = new Object();
                data.root = list;

                this.store.loadData(data);
            }else{
                alert( "arrrrg: No existe el componente id: "+e.combo.linkImpoexpo+"!");
            }
        }else{
            alert( "arrrrg: No existe el componente id: "+e.combo.linkTransporte+"!");
        }
    },
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',   
    trigger2Class : 'x-form-select-trigger',
    hideTrigger1 : true,
   

    initComponent : function() {
        WidgetModalidad.superclass.initComponent.call(this);

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