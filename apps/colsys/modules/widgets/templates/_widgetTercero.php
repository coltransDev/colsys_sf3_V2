<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetTerceroWindow");
?>
<script type="text/javascript">

WidgetTercero = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaTercerosJSON")?>'
            
        }),
        baseParams: {tipo: this.tipo},
        reader: new Ext.data.JsonReader({
            root: 'terceros',
            totalProperty: 'totalCount'           
        }, [
            {name: 'idtercero', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
			{name: 'ciudad', mapping: 'c_ca_ciudad'},
			{name: 'pais', mapping: 'p_ca_nombre'},
            {name: 'direccion', mapping: 't_ca_direccion'},
            {name: 'contacto', mapping: 't_ca_contacto'}

        ])
    });

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><b>{nombre}</b><br /><span style="font-size: 9px"><br />{direccion} {ciudad} - {pais} {contacto}</span> </div></tpl>'
    );
    WidgetTercero.superclass.constructor.call(this, {
        valueField:'idtercero',
        displayField:'nombre',        
        loadingText: 'Buscando...',
        forceSelection: true,
        minChars: 3,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        tpl: this.resultTpl,
        itemSelector: 'div.search-item',
        listeners: {
        }
    });
};

Ext.extend(WidgetTercero, Ext.form.ComboBox, {
    getTrigger : Ext.form.TwinTriggerField.prototype.getTrigger,
    initTrigger : Ext.form.TwinTriggerField.prototype.initTrigger,
    trigger1Class : 'x-form-clear-trigger',
    trigger2Class : 'x-form-search-trigger',
    trigger3Class : 'x-form-select-trigger',
    hideTrigger1 : true,
    
    initComponent : function() {
        WidgetTercero.superclass.initComponent.call(this);

        this.triggerConfig = {
        tag : 'span',
        cls : 'x-form-twin-triggers',
        cn : [{
            tag : 'img',
            src : Ext.BLANK_IMAGE_URL,
            cls : 'x-form-trigger ' + this.trigger1Class
        }, {
            tag : 'img',
            src : Ext.BLANK_IMAGE_URL,
            cls : 'x-form-trigger ' + this.trigger2Class
        },
        {
            tag : 'img',
            src : Ext.BLANK_IMAGE_URL,
            cls : 'x-form-trigger ' + this.trigger3Class
        }
      ]
    };
  },

  reset : Ext.form.Field.prototype.reset.createSequence(function() {
    this.triggers[0].hide();    
  }),

  onViewClick : Ext.form.ComboBox.prototype.onViewClick.createSequence(function() {
    this.triggers[0].show();    
  }),

 
  onTrigger1Click : function() {
    this.clearValue();
    this.triggers[0].hide();   
    this.fireEvent('clear', this);
  },
  onTrigger2Click : function() {

    var titulo = "";
    if( this.getValue() ){
        titulo = "Editar ";
    }else{
        titulo = "Nuevo ";
    }
    titulo+=this.tipo;

    idtercero = this.hiddenField?this.hiddenField.value:this.getValue();
    win1 = Ext.getCmp("tercero-window");
    if(!win1)
    {
        win1 = new WidgetTerceroWindow({idcomponent: this.id,
                                        title: titulo,                                        
                                        tipo: this.tipo
                                       });
        
    }    
    win1.show();
    win1.cargar(idtercero);
  },
  onTrigger3Click : function() {
    this.onTriggerClick();
  }

});	
</script>