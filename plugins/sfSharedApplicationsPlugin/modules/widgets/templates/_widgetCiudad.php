<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
//echo $trafico."widget";
?>

<script type="text/javascript">
WidgetCiudad = function( config ){
    Ext.apply(this, config);
    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{ciudad}</b><br />{trafico}</div></tpl>'
    );
    this.trafico = "<?=$trafico?>";
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
        forceSelection: true,        
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        mode: 'local',
        tpl: this.resultTpl,
        itemSelector: 'div.search-item',
        listClass: 'x-combo-list-small',
        submitValue: true,
        filterBy: this.filterFn
    });
};


Ext.extend(WidgetCiudad, Ext.form.ComboBox, {
    setIdtrafico: function( v ){        
        if( v && this.idtrafico!=v ){
            this.setValue("");
        }
        this.idtrafico = v;
    },    
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
            if(1==1)
            {
                this.lastQuery = q;
                if(this.mode == 'local'){
                    this.selectedIndex = -1;
                    if(forceAll){
                        this.store.clearFilter();
                    }else{
                        var tipo=this.tipo;
                        var trafico=this.trafico;                        
                        var impoexpo=this.impoexpo;
                        
                        var idtrafico=this.idtrafico;

                        var nomimpoexpo=(Ext.getCmp(impoexpo))?Ext.getCmp(impoexpo).getValue():impoexpo;
                        var traf=Ext.getCmp(this.traficoParent)?Ext.getCmp(this.traficoParent).getValue():"";
                        i=0;
                        if(nomimpoexpo=="<?=constantes::OTMDTA?>")
                            nomimpoexpo="<?=constantes::TRIANGULACION?>";
                        
                        if(this.tipo && this.impoexpo){                        
                            
                            this.store.filterBy(function(record, id){                          

                                if( nomimpoexpo=="<?=constantes::IMPO?>"){

                                    var str=record.get("ciudad_trafico");
                                    var txt=new RegExp(q,"ig");
                                    if(tipo=="1")
                                    {
                                        if(record.get("idtrafico")!=trafico)
                                        {
                                            if(str.search(txt) == -1  )
                                                return false;
                                            else
                                                return true;
                                        }
                                        else
                                            return false;
                                    }
                                    else if(tipo=="2")
                                    {                                    
                                        if(record.get("idtrafico")==trafico)
                                        {
                                            if(str.search(txt) == -1 )
                                                return false;
                                            else
                                                return true;
                                        }
                                        else
                                            return false;
                                    }
                                    else if(tipo=="3")
                                    {
                                        if(record.get("idtrafico")==traf)
                                        {
                                            if(str.search(txt) == -1  )
                                                return false;
                                            else
                                                return true;
                                        }
                                        else
                                            return false;
                                    }
                                     return true;
                                }
                                else if( nomimpoexpo=="<?=constantes::EXPO?>")
                                {
                                    var str=record.get("ciudad_trafico");
                                    var txt=new RegExp(q,"ig");
                                    if(tipo=="2")
                                    {
                                            if(str.search(txt) == -1  )
                                                return false;
                                            else
                                                return true;
                                        /*if(record.get("idtrafico")!=trafico)
                                        {
                                            if(str.search(txt) == -1  )
                                                return false;
                                            else
                                                return true;
                                        }
                                        else
                                            return false;
                                         */
                                    }
                                    else if(tipo=="1")
                                    {
                                        if(record.get("idtrafico")==trafico)
                                        {
                                            if(str.search(txt) == -1  )
                                                return false;
                                            else
                                                return true;
                                        }
                                        else
                                            return false;
                                    }
                                        return true;
                                }
                                else if( nomimpoexpo=="<?=constantes::TRIANGULACION?>")
                                {
                                    var str=record.get("ciudad_trafico");
                                    var txt=new RegExp(q,"ig");
                                    if(str.search(txt) == -1  )
                                        return false;
                                    else
                                        return true;
                                }
                                else
                                    return true;
                                }
                            );
                         }
                         else if( idtrafico ){
                            this.store.filterBy(function(record, id){                          

                                
                                if(record.get("idtrafico")==idtrafico)
                                {
                                    var str=record.get("ciudad_trafico");
                                    var txt=new RegExp(q,"ig");
                                    if(str.search(txt) == -1  ){
                                        return false;
                                    }else{
                                        return true;
                                    }
                                }
                            });
                                        
                         }else{
                            this.store.filter(this.searchField, q, true);
                         }
                         
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