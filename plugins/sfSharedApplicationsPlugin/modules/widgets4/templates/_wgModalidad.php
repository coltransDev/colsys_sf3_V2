<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">

Ext.define('Ext.colsys.wgModalidad', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.wModalidad',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',
  trans:'',
  spExtraParam:'',
  displayField: 'modalidad',
  valueField: 'modalidad',
  labelWidth: 60,
  store: Ext.create('Ext.data.Store', {
            fields: ['idmodalidad','modalidad','impoexpo','transporte'],
            proxy: {
                type: 'ajax',
                url: '<?=url_for('widgets/datosModalidades')?>',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
        }),
        qtip:'Listado de Modalidades',
        //labelWidth: 60,
        trigger1Class: 'x-form-select-trigger',
        trigger2Class: 'x-form-clear-trigger',
        onRender: function(ct, position){
            Ext.colsys.wgModalidad.superclass.onRender.call(this, ct, position);
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
    /*onFocus : function( obj, e, eOpts1 )
    {
        
         //var rec = obj.record;
         //alert(rec.toSource());
         //alert(e.field)
        alert(obj.toSource());
        alert(the1.toSource());
        alert(eOpts1.toSource());
               
        if(this.transporte)
        {
            trans=Ext.getCmp(this.transporte).getValue();          
            if( trans && this.trans!=trans)
            {
                this.store.load({
                  params : {
                      transporte : trans,
                      impoexpo : this.impoexpo
                  }
              });
            }            
            this.trans=trans;
        }
    },*/
    onFocus: function( field, newVal, oldVal ){          
        this.store.filter('transporte', this.transporte, true, true);
        this.store.filter('impoexpo', this.impoexpo, true, true);
    }
      /*doQuery: function( queryString, forceAll, rawQuery )
      {
          
      }*/
});
</script>