
Ext.define('Colsys.Widgets.WgImpoexpo', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.WgImpoexpo',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',  
  spExtraParam:'',
  displayField: 'valor',
  valueField: 'valor',

  store: Ext.create('Ext.data.Store', {
            fields: ['valor'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosImpoexpo',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: true
   }),
  qtip:'Listado ',
  labelWidth: 60
  
});