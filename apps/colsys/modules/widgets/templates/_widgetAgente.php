<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$agentes = $sf_data->getRaw("agentes");
?>
<script type="text/javascript">
WidgetAgente = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
				autoLoad : true,
				reader: new Ext.data.JsonReader(
					{
						root: 'root'
					},
					Ext.data.Record.create([
						{name: 'idagente'},
                        {name: 'nombre'},
                        {name: 'idtrafico'},
                        {name: 'pais'},
                        {name: 'ciudad'},
                        {name: 'direccion'}
					])
				),
				proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$agentes, "total"=>count($agentes), "success"=>true) )?> )
			});
    
    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{nombre}</b><br /><span style="font-size:9px">{pais}-{ciudad}-{direccion} </span> </div></tpl>'
    );
    WidgetAgente.superclass.constructor.call(this, {
        valueField: 'idagente',
        displayField: 'nombre',
        typeAhead: true,
        forceSelection: true,
        tpl: this.resultTpl,
        triggerAction: 'all',
        emptyText:'',
        itemSelector: 'div.search-item',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small',
        listeners: {            
            expand : this.onBeforeQuery
        }

    });
};

Ext.extend(WidgetAgente, Ext.form.ComboBox, {
    onBeforeQuery: function(  ){
        var impoexpo = Ext.getCmp(this.linkImpoExpo).getValue();
        if( impoexpo=="<?=Constantes::EXPO?>" ){
            var link = this.linkDestino;
        }else{
            var link = this.linkOrigen;
        }        
        var trafico =  Ext.getCmp(link).getValue();        
        var agentList = new Array();
        var listarTodos = false;
        if( Ext.getCmp(this.linkListarTodos) && Ext.getCmp(this.linkListarTodos)){
            var listarTodos = Ext.getCmp(this.linkListarTodos).getValue();
        };
        if(!listarTodos)
            this.store.filter("idtrafico",trafico,true,true);
        else
            this.store.filter("","",true,true);

    },
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
	}
});
</script>