<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//include_component("widgets", "widgetTerceroWindow");
?>
<script type="text/javascript">
Ext.define('Ext.colsys.wgUsuario', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wUsuario',
    store: new Ext.data.Store(
    {
        fields: [
            {name: 'login'},
            {name: 'nombre'},
            {name: 'cargo'},
            {name: 'sucursal'},
            {name: 'email'},
            {name: 'empresa'},
            {name: 'extension'},            
            {name: 'icon'},
            {name: 'app'}
        ],
        proxy: {
            type: 'ajax',
            url: '<?=url_for('widgets/datosComboUsuario')?>',
            reader:{
               root: 'root',
               totalProperty: 'total'
            }
        }
    }),
    valueField:'login',
    displayField:'nombre',        
    typeAhead: false,
    loadingText: 'buscando...',
    triggerAction: 'all',     
    selectOnFocus: true,
    allowBlank: false,
    enableKeyEvents: true,
    minChars: 3,
    listConfig: {
        loadingText: 'Buscando...',
        emptyText: 'No hay usuarios que respondan al criterio',
        getInnerTpl: function() {
             var tpl = '<div class="search-item">'+
            '<div style="border: 1px solid #EEE; border-color: #EEE #EEE #DDD #EEE; padding: 2px;"><div style="float:left; border: 1px solid #EEE; border-color: #EEE #EEE #DDD #EEE; line-height: 1.5; padding: 2px; clear:left" class="userthumb" align="left"><img src="{icon}" height="80" width="60"/></div>'+
            '<div style="font-family: Myriad pro,Arial,Helvetica,sans-serif; margin-left: 80px; height: 88px; line-height: 92%; vertical-align: middle;"><b>{nombre}</b><br /><span style="color:#062A7D;">{empresa}</span><br/>{cargo}<br/>{sucursal}<br/>{email}<br/>Ext: {extension}</div></div>';
            return tpl;
        }
    },    
    trigger1Class : 'x-form-clear-trigger',
    //trigger2Class : 'x-form-select-trigger',
    //trigger3Class : 'x-form-select-trigger',
    onRender: function(ct, position){
        hideTrigger1 : true,
        //this.store.load();
        Ext.colsys.wgUsuario.superclass.onRender.call(this, ct, position);
        var id = this.getId();
        this.triggerConfig = {
            tag:'div', cls:'x-form-twin-triggers', style:'display:block;width:46px;', cn:[
                {tag: "img", style: Ext.isIE?'margin-left:-3;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger1" + id, name:"trigger1" + id, cls: "x-form-trigger " + this.trigger1Class},
                //{tag: "img", style: Ext.isIE?'margin-left:-6;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger2" + id, name:"trigger2" + id, cls: "x-form-trigger " + this.trigger2Class},
                //{tag: "img", style: Ext.isIE?'margin-left:-6;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger3" + id, name:"trigger3" + id, cls: "x-form-trigger " + this.trigger3Class}
            ]};
        this.triggerEl.replaceWith(this.triggerConfig);
        this.triggerEl.on('mouseup',function(e){
            if(e.target.name == "trigger1" + id ){
                this.onTriggerClick();
            }/* else if(e.target.name == "trigger2" + id){
                this.reset();
                if(this.spObj!=='' && this.spExtraParam !== ''){
                    Ext.getCmp(this.spObj).store.setExtraParam(this.spExtraParam,'');
                    Ext.getCmp(this.spObj).store.load()
                }
                if(this.spForm!==''){
                  Ext.getCmp(this.spForm).getForm().reset();
                }
            }*/
        },this);
        var trigger1 = Ext.get("trigger1" + id);
        //var trigger2 = Ext.get("trigger2" + id);
        trigger1.addClsOnOver('x-form-trigger-over');
        //trigger2.addClsOnOver('x-form-trigger-over');
    }
});
</script>