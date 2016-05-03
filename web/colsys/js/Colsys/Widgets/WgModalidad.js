/**
* @autor Felipe Nariño 
* @return Combobox cargado con modalidades (ej. FCL, consolidado,local) 
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               idimpoexpo: impoexpo
*               idmaster: identificador del master
*              
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgModalidad', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.WgModalidad',
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
                url: '/widgets/datosModalidades',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: true
        }),
        qtip:'Listado de Modalidades',
    
    onFocus: function( field, newVal, oldVal ){
        this.store.filter([
            {property: 'impoexpo' , value:  Ext.getCmp('impoexpo_'+this.idmaster).getValue()},
            {property: 'transporte' , value:  Ext.getCmp('transporte'+this.idmaster).getValue()}
        ]);  
    }
});
