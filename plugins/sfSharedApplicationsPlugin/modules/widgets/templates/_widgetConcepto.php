<?php
/*
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
$data = $sf_data->getRaw("data");
?>

<script type="text/javascript">

    WidgetConcepto = function( config ){
        Ext.apply(this, config);
        this.data = <?= json_encode($data) ?>;
        this.store = new Ext.data.Store({
            autoLoad : true,
            reader: new Ext.data.JsonReader(
            {
                root: 'root',
                totalProperty: 'total',
                successProperty: 'success'
            },
            Ext.data.Record.create([
                {name: 'idconcepto'},
                {name: 'concepto'},
                {name: 'transporte'},
                {name: 'modalidad'}
            ])
        )
            ,proxy: new Ext.data.MemoryProxy( <?= json_encode(array("root" => $data, "total" => count($data), "success" => true)) ?> )
        });

        WidgetConcepto.superclass.constructor.call(this, {
            valueField: 'idconcepto',
            displayField: 'concepto',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,        
            lazyRender:true,
            mode: 'local',
            listClass: 'x-combo-list-small',
            submitValue: true
        });
    };

    Ext.extend(WidgetConcepto, Ext.form.ComboBox, {
    
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

                var modalidad = (Ext.getCmp(this.linkModalidad))?Ext.getCmp(this.linkModalidad).getValue():this.linkModalidad;
                var transporte = (Ext.getCmp(this.linkTransporte))?Ext.getCmp(this.linkTransporte).getValue():this.linkTransporte;

                
                this.store.filterBy(function(record, id) {
                    if(record.get("modalidad")==modalidad && record.get("transporte")==transporte)
                    {
                        var str=record.get("concepto");
                        var txt=new RegExp(q,"ig");
                        if(str.search(txt) == -1 )
                            return false;
                        else
                            return true;
                    }
                    else
                        return false;
                });
                this.onLoad();
            }
        }
        ,
        getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
        initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
        trigger1Class : 'x-form-clear-trigger',   
        trigger2Class : 'x-form-select-trigger',
        hideTrigger1 : true,
   

        initComponent : function() {
            WidgetConcepto.superclass.initComponent.call(this);

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