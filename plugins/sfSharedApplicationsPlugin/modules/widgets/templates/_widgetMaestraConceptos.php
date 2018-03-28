<script type="text/javascript">
    
    WidgetMaestraConceptos = function( config ){
        Ext.apply(this, config);
        
        this.store = new Ext.data.Store({
            autoLoad: true,
            proxy: new Ext.data.HttpProxy({
                url: '<?=url_for("contabilidad/datosMaestraConceptos")?>'
            }),
//            baseParams: {
//                casouso: this.caso
//            },
            reader: new Ext.data.JsonReader(
                    {
                        root: 'root',
                        totalProperty: 'total',
                        successProperty: 'success'
                    },
                    Ext.data.Record.create([
                        {name: 'mc_ca_idconcepto'},
                        {name: 'mc_ca_concepto_esp'},
                        {name: 'mc_ca_concepto_eng'}
                    ])
                    )
        });
        
        WidgetMaestraConceptos.superclass.constructor.call(this, {            
            forceSelection: true,
            triggerAction: 'all',
            //emptyText:'',
            //width: 500, 
            selectOnFocus: true,
            displayField: 'mc_ca_concepto_esp',
            valueField: 'mc_ca_idconcepto',                        
            lazyRender:true,
            allowBlank: true,                                
            typeAhead: true,            
            listClass: 'x-combo-list-small',
         });
    };
    
    Ext.extend(WidgetMaestraConceptos, Ext.form.ComboBox, {
        doQuery : function(q, forceAll){
            q = Ext.isEmpty(q) ? '' : q;
            var qe = {
                query: q,
                forceAll: forceAll,
                combo: this,
                cancel:false
            };
            /*if(this.fireEvent('beforequery', qe)===false || qe.cancel){
                return false;
            }*/
            q = qe.query;
            forceAll = qe.forceAll;
            
            if(forceAll === true || (q.length >= this.minChars)){

                //var modalidad = (Ext.getCmp(this.linkModalidad))?Ext.getCmp(this.linkModalidad).getValue():this.linkModalidad;
                //var transporte = (Ext.getCmp(this.linkTransporte))?Ext.getCmp(this.linkTransporte).getValue():this.linkTransporte;


                this.store.filterBy(function(record, id) {
                    //console.log(record);
                    /*if(record.get("modalidad")==modalidad && record.get("transporte")==transporte)
                    {*/
                        var str=record.get("mc_ca_concepto_esp");
                        var txt=new RegExp(q,"ig");
                        if(str.search(txt) == -1 )
                            return false;
                        else
                            return true;
                    
                    /*else
                        return false;*/
                    });
                this.onLoad();
            }
        }           
    });
</script>