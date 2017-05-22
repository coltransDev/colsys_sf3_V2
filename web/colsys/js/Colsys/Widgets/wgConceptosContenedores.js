Ext.define('Colsys.Widgets.wgConceptosContenedores', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.wgConceptosContenedores',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',  
  spExtraParam:'',
   queryMode:'local',
   valueField:'idconcepto',
   displayField:'concepto'  ,
  store: Ext.create('Ext.data.Store', {
            fields: ['idconcepto','concepto'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosConceptosContenedores',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
        }),
        onRender: function(ct, position){
            idtrans =   this.idtransporte;
            idimpoe =   this.idimpoexpo;
            idmaster=   this.idmaster;
                this.store.load({
                    params : {
                    idtransporte : idtrans,
                    idimpoexpo : idimpoe,
                    idmaster: idmaster
                    }
                });
                this.superclass.onRender.call(this, ct, position);
      },
        
        
  qtip:'Listado ',
  labelWidth: 60


});
