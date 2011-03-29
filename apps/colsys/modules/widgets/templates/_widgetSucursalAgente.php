<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$agentes = $sf_data->getRaw("agentes");
?>
<script type="text/javascript">
WidgetSucursalAgente = function( config ){
    Ext.apply(this, config);

    this.store = new Ext.data.Store({
				autoLoad : false,
                proxy: new Ext.data.HttpProxy({
                    url: '<?=url_for("widgets/datosSucAgente")?>'
                }),                
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                         totalProperty: 'total'
					},
					Ext.data.Record.create([
						{name: 'idsucursal'},
                        {name: 'ciudad'},
                        {name: 'direccion'}
					])
				)
			});

    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{ciudad}</b><br /><span style="font-size:9px">{direccion} </span> <br />',
            '</div></tpl>'
            ,{
                oficial: function(val){
                    return val == 'Oficial'
                }
            }

    );
    WidgetSucursalAgente.superclass.constructor.call(this, {
        valueField: 'idsucursal',
        displayField: 'ciudad',
        forceSelection: true,
        tpl: this.resultTpl,
        triggerAction: 'all',
        emptyText:'',
        itemSelector: 'div.search-item',
        selectOnFocus: true,
        lazyRender:true,                
        idAgente:0,
        listClass: 'x-combo-list-small',
        listeners: {
            focus: this.onFocusWdg
        }
    });
};

Ext.extend(WidgetSucursalAgente, Ext.form.ComboBox, {
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    hideTrigger1 : true,

    initComponent : function() {
        WidgetAgente.superclass.initComponent.call(this);
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
	},
    
    onFocusWdg: function( field, newVal, oldVal ){
        
        var cmp = Ext.getCmp(this.linkAgente);
        if( cmp ){
            
            if(this.idAgente!=cmp.getValue())
            {
                
                this.store.setBaseParam("idagente", cmp.getValue() );
                this.store.load();
            }
            this.idAgente=cmp.getValue();
        }else{
            alert( "arrrrg: No existe el componente id: "+this.linkAgente+"!");
        }
    }

});
</script>