Ext.define('Colsys.Widgets.wgMoneda', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.wgMoneda',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',  
  spExtraParam:'',
   queryMode:'local',
   valueField:'id',
   displayField:'name',
  store: Ext.create('Ext.data.Store', {
            fields: ['id','name','sugerido'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosMonedas',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            },
            autoLoad: true
        }),
  qtip:'Listado ',
  labelWidth: 60


});
