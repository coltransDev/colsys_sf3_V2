<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">
Ext.define('Ext.colsys.wgCuentasParametros', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.wCuentasParametros',
  triggerTip: 'Click para limpiar',
  spObj:'',
  mode:'local',
  spForm:'',  
  spExtraParam:'',
  displayField: 'name',
  valueField: 'id',
  minChars:3,
  store: Ext.create('Ext.data.Store', {
            fields: ['id','name'],
            proxy: {
                type: 'ajax',
                url: '<?=url_for('widgets4/datosCuentasParametros')?>',
                baseParams:{
                    modo:this.modo
                },
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
        }),
  qtip:'Listado de Conceptos',
  trigger1Class: 'x-form-select-trigger',
    trigger2Class: 'x-form-clear-trigger',
        onRender: function(ct, position){
            Ext.colsys.wgCuentasParametros.superclass.onRender.call(this, ct, position);
            var id = this.getId();
            this.triggerConfig = {
                      tag:'div', cls:'x-form-twin-triggers', style:'display:block;width:46px;', cn:[
                      {tag: "img", style: Ext.isIE?'margin-left:-3;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger1" + id, name:"trigger1" + id, cls: "x-form-trigger " + this.trigger1Class},
                      {tag: "img", style: Ext.isIE?'margin-left:-6;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger2" + id, name:"trigger2" + id, cls: "x-form-trigger " + this.trigger2Class}
                  ]};
            this.triggerEl.replaceWith(this.triggerConfig);
            this.triggerEl.on('mouseup',function(e){
                if(e.target.name == "trigger1" + id ){
                  this.onTriggerClick();
                } else if(e.target.name == "trigger2" + id){
                    this.reset();
                    if(this.spObj!=='' && this.spExtraParam !== ''){
                            Ext.getCmp(this.spObj).store.setExtraParam(this.spExtraParam,'');
                      Ext.getCmp(this.spObj).store.load()
                      }
                    if(this.spForm!==''){
                      Ext.getCmp(this.spForm).getForm().reset();
                      }
                }
            },this);
          var trigger1 = Ext.get("trigger1" + id);
          var trigger2 = Ext.get("trigger2" + id);
          trigger1.addClsOnOver('x-form-trigger-over');
          trigger2.addClsOnOver('x-form-trigger-over');
      },
      initComponent: function() {
        var me = this;
 
        Ext.applyIf(me, {
            emptyText: 'Seleccione una cuenta',
            loadingText: 'Loading...',
            store: {type: 'roletemplateslocal'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        store.proxy.extraParams = {
            idempresa: this.idempresa
        }
    },
    setIdempresa: function(idempresa)
    {
        if(this.idempresa!=idempresa)
        {
            this.idempresa=idempresa;
            this.store.proxy.extraParams = {
                idempresa: this.idempresa
            };
            this.store.reload();
        }
    }
    
});
</script>