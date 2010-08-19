<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>



<script type="text/javascript">


widgetBusquedaKB = Ext.extend(Ext.form.TwinTriggerField, {
    initComponent : function(){
        widgetBusquedaKB.superclass.initComponent.call(this);
        this.on('specialkey', function(f, e){
            if(e.getKey() == e.ENTER){
                this.onTrigger2Click();
            }
        }, this);
    },

    validationEvent:false,
    validateOnBlur:false,
    trigger1Class:'x-form-clear-trigger',
    trigger2Class:'x-form-search-trigger',
    hideTrigger1:true,
    width:500,
    hasSearch : false,    

    onTrigger1Click : function(){
        if(this.hasSearch){
            this.el.dom.value = '';
            var o = {start: 0};            
            this.triggers[0].hide();
            this.hasSearch = false;
        }
    },

    onTrigger2Click : function(){
        var v = this.getRawValue();
        if(v.length < 1){
            this.onTrigger1Click();
            return;
        }
        var o = {start: 0};
        /*this.store.baseParams = this.store.baseParams || {};
        this.store.baseParams[this.paramName] = v;
        this.store.reload({params:o});*/

        
        var storeGrid = Ext.getCmp("kbase-search-grid").store;
        storeGrid.setBaseParam("query", v);
        storeGrid.reload();
        
        this.hasSearch = true;
        this.triggers[0].show();
    }
});


</script>