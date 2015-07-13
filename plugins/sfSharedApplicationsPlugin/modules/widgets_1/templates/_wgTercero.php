<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//include_component("widgets", "widgetTerceroWindow");
?>
<script type="text/javascript">
/*Ext.define('Ext.colsys.wgTercero', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wTercero',
    store: new Ext.data.Store(
    {
        fields: [
            {name: 'idtercero', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
            {name: 'ciudad', mapping: 'c_ca_ciudad'},
            {name: 'pais', mapping: 'p_ca_nombre'},
            {name: 'direccion', mapping: 't_ca_direccion'},
            {name: 'contacto', mapping: 't_ca_contacto'},
            {name: 'idreporte'}
        ],
       proxy: {
          url: '<?=url_for('widgets/listaTercerosJSON')?>',
          type: 'ajax',
          reader: 
          {
             root: 'terceros',
             totalProperty: 'totalCount'
          }
       }
    }),
    valueField:'idtercero',
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
        emptyText: 'No matching posts found.',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item">',
        '<b><span style="font-size:9px">',
             '<tpl if="this.oficial(idreporte)">',
                '<span class="rojo">{nombre}</span>',
            '</tpl>',
             '<tpl if="!this.oficial(idreporte)">',
                '{nombre}',
            '</tpl>',
            '</span></b><span style="font-size: 9px"><br />{direccion} {ciudad} - {pais} {contacto}</span>',
        '</div></tpl>';
        }
    },    
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    onRender: function(ct, position){
        hideTrigger1 : true,
        //this.store.load();
        Ext.colsys.wgEmpresas.superclass.onRender.call(this, ct, position);
        var id = this.getId();
        this.triggerConfig = {
                  tag:'div', cls:'x-form-twin-triggers', style:'display:block;width:46px;', cn:[
                  {tag: "img", style: Ext.isIE?'margin-left:-3;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger1" + id, name:"trigger1" + id, cls: "x-form-trigger " + this.trigger1Class},
                  {tag: "img", style: Ext.isIE?'margin-left:-6;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger2" + id, name:"trigger2" + id, cls: "x-form-trigger " + this.trigger2Class},
                  {tag: "img", style: Ext.isIE?'margin-left:-6;height:19px':'', src: Ext.BLANK_IMAGE_URL, id:"trigger3" + id, name:"trigger3" + id, cls: "x-form-trigger " + this.trigger3Class}
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
    }
});*/
</script>


<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">
Ext.define('Ext.colsys.wgTercero', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wTercero',
    store: new Ext.data.Store(
    {
       fields: [
            {name: 'idtercero', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
            {name: 'ciudad', mapping: 'c_ca_ciudad'},
            {name: 'pais', mapping: 'p_ca_nombre'},
            {name: 'direccion', mapping: 't_ca_direccion'},
            {name: 'contacto', mapping: 't_ca_contacto'},
            {name: 'idreporte'}
        ],        
        proxy: {
            url: '<?=url_for('widgets/listaTercerosJSON')?>',
            baseParams: {tipo: this.tipo},
            type: 'ajax',            
              //autoLoad: true,
            reader: 
            {
                root: 'terceros',
                totalProperty: 'totalCount',
                id: 'id',
                type: 'json'
             }
        },
        baseParams: {tipo: this.tipo}
    }),
     valueField:'idtercero',
     displayField:'nombre', 
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',     
     selectOnFocus: true,
     allowBlank: false,     
     enableKeyEvents: true,    
     minChars: 3/*,     
     listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',                
                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item">',
                    '<b><span style="font-size:9px">',
                     '<tpl if="this.oficial(idreporte)">',
                        '<span class="rojo">{nombre}</span>',
                    '</tpl>',
                     '<tpl if="!this.oficial(idreporte)">',
                        '{nombre}',
                    '</tpl>',
                    '</span></b><span style="font-size: 9px"><br />{direccion} {ciudad} - {pais} {contacto}</span>',
                '</div></tpl>';
                }
            },
        */
    /*,onRender: function(ct, position){
        Ext.colsys.wgTercero.superclass.onRender.call(this, ct, position);
        alert(this.tipo);
   }*/
});

</script>

