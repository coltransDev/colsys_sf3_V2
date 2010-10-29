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

    /*this.data = <?=json_encode($data)?>;*/

    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{ciudad}</b><br />{trafico}</div></tpl>'
    );
    this.store = new Ext.data.Store({
				autoLoad : true,
				reader: new Ext.data.JsonReader(
					{
						root: 'root',
                        totalProperty: 'total',
						successProperty: 'success'
					},
					Ext.data.Record.create([
						{name: 'idciudad'},
                        {name: 'ciudad'},
                        {name: 'idtrafico'},
                        {name: 'trafico'},
                        {name: 'ciudad_trafico'}
					])
				),
                proxy: new Ext.data.MemoryProxy( <?=json_encode(array("root"=>$data, "total"=>count($data), "success"=>true) )?> )
			});

    WidgetCiudad.superclass.constructor.call(this, {
        valueField: 'idciudad',
        displayField: 'ciudad',
        searchField: 'ciudad_trafico',
        typeAhead: false,
        forceSelection: true,
        /*triggerAction: 'all',*/
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        tpl: this.resultTpl,
        itemSelector: 'div.search-item',
        listClass: 'x-combo-list-small',
        submitValue: true,
        filterBy: this.filterFn,
        listeners: {
            /*focus: this.onFocusWdg*/
        }
    });   
};


Ext.extend(WidgetCiudad, Ext.form.ComboBox, {

    doQuery : function(q, forceAll){
        q = Ext.isEmpty(q) ? '' : q;
        var qe = {
            query: q,
            forceAll: forceAll,
            combo: this,
            cancel:false
        };
        if(this.fireEvent('beforequery', qe)===false || qe.cancel){
            return false;
        }
        q = qe.query;
        forceAll = qe.forceAll;
        if(forceAll === true || (q.length >= this.minChars)){
            if(this.lastQuery !== q){
                this.lastQuery = q;
                if(this.mode == 'local'){
                    this.selectedIndex = -1;
                    if(forceAll){
                        this.store.clearFilter();
                    }else{
                        this.store.filter(this.searchField, q, true);
                    }
                    this.onLoad();
                }else{
                    this.store.baseParams[this.queryParam] = q;
                    this.store.load({
                        params: this.getParams(q)
                    });
                    this.expand();
                }
            }else{
                this.selectedIndex = -1;
                this.onLoad();
            }
        }
    },
    getRecord: function(){        
        if( this.hiddenField ){
            var val = this.hiddenField.value;
        }else{
            var val = this.getValue();
        }        
        if( val ){
            var record = this.findRecord(this.valueField, val);
            return record;
        }
        return null;
    }
});


</script>