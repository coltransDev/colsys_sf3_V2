<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
$modo = $sf_data->getRaw("modo");
?>
<script type="text/javascript">
WidgetBodega = function( config ){
    Ext.apply(this, config);
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaBodegas')?>'
        }),
        baseParams: {modo:'<?=$modo?>'},
        reader: new Ext.data.JsonReader(
		{
                    root: 'root',
                    totalProperty: 'totalC'
		},[
                {name:'b_ca_idbodega'  },
                {name:'b_ca_nombre'    },
                {name:'b_ca_tipo'      },
                {name:'b_ca_direccion' },
                {name:'b_ca_transporte'}   
            ])
    });
    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{b_ca_nombre}</b><br /><span>{nombre}  <br />{b_ca_direccion}</span> </div></tpl>'
    );
    WidgetBodega.superclass.constructor.call(this, {
        valueField: 'b_ca_idbodega',
        displayField: 'b_ca_nombre',
        forceSelection: true,
        minChars:3,
        tpl: this.resultTpl,
        triggerAction: 'all',
        emptyText:'Escriba el nombre de la bodega...',
        itemSelector: 'div.search-item',
        selectOnFocus: true,
        lazyRender:true,
        submitValue: true,
        mode: 'remote',
        listClass: 'x-combo-list-small'
    });
};
Ext.extend(WidgetBodega, Ext.form.ComboBox, {
    getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    hideTrigger1 : true,
    initComponent : function() {
        WidgetBodega.superclass.initComponent.call(this);
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