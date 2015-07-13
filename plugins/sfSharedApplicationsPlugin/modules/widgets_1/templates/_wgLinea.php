<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


?>


<script type="text/javascript">

Ext.define('Ext.colsys.wgLinea', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wLinea',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',
    trans:'',
    spExtraParam:'',
    selectOnFocus: true,
    enableKeyEvents: true,
    minChars: 3,
    displayField: 'linea',
    valueField: 'idlinea',
    labelWidth: 50,    
    store: Ext.create('Ext.data.Store', {
            fields: ['idlinea','linea','transporte'],
            proxy: {
                type: 'ajax',
                url: '<?=url_for('widgets/datosLineas')?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
        }),
        qtip:'Listado de lineas',        
        trigger1Class: 'x-form-select-trigger',
        trigger2Class: 'x-form-clear-trigger',
        onRender: function(ct, position){
            Ext.colsys.wgLinea.superclass.onRender.call(this, ct, position);
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
      onFocus: function( field, newVal, oldVal ){          
        this.store.filter('transporte', this.transporte, true, true);
        //this.store.filter('impoexpo', this.impoexpo, true, true);
    }
      /*onFocus : function( obj, the1, eOpts1 )
      {
          trans=Ext.getCmp(this.transporte).getValue();          
          if(this.trans!=trans)
          {
              this.store.load({
                params : {
                    transporte : trans
                }
            });
          }          
          this.trans=trans;          
      }*/
});
</script>