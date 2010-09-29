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
    this.data = <?=json_encode($agentes)?>;
    this.store = new Ext.data.Store({
				autoLoad : false,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                        totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'idagente'},
                        {name: 'nombret'},
                        {name: 'nombrei'},
                        {name: 'pais'}
					])
				)//,
				//proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$agentes, "total"=>count($agentes), "success"=>true) )?> )
			})
    

    WidgetAgente.superclass.constructor.call(this, {
        valueField: 'idagente',
        displayField: 'nombrei',
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        listClass: 'x-combo-list-small',
        listeners: {
            beforequery: this.onBeforeQuery
        }

    });
}

Ext.extend(WidgetAgente, Ext.form.ComboBox, {
    onBeforeQuery: function( e ){
        var impoexpo = Ext.getCmp(e.combo.linkImpoExpo).getValue();
        if( impoexpo=="<?=Constantes::EXPO?>" ){
            var link = e.combo.linkDestino;
        }else{
            var link = e.combo.linkOrigen;
        }        
        var trafico =  Ext.getCmp(link).getValue();        
        var agentList = new Array();
        var listarTodos = false;
        if( Ext.getCmp(e.combo.linkListarTodos) && Ext.getCmp(e.combo.linkListarTodos)){
            var listarTodos = Ext.getCmp(e.combo.linkListarTodos).getValue();
        }

        for( k in this.data ){
            var agent = this.data[k];
            if( agent.idtrafico==trafico || listarTodos ){
                agentList.push( agent );
            }            
        }        
        var data = new Object();
        data.root = agentList;
       
       
        e.combo.store.loadData(data);
        //this.resultTpl.overwrite(this.id, e.combo.store.data);
        //this.resultTpl.o
    },
	getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    hideTrigger2 : true,

    initComponent : function() {
        WidgetAgente.superclass.initComponent.call(this);
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