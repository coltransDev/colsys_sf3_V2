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
                        {name: 'nombre'}
					])
				)//,
				//proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$agentes, "total"=>count($agentes), "success"=>true) )?> )
			})

    WidgetAgente.superclass.constructor.call(this, {        
        
        typeAhead: true,
        forceSelection: true,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        mode: 'local',
        displayField: 'nombre',
        valueField: 'idagente',
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
        
        
    }
});

	
</script>