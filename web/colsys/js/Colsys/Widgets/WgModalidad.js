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
  displayField: 'modalidad',
  valueField: 'modalidad',  
  //queryMode:'local',
  store: Ext.create('Ext.data.Store', {
            fields: ['idmodalidad','modalidad','impoexpo','transporte'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosModalidades',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            },
            autoLoad: true
        }),
        //qtip:'Listado de Modalidades',
    
    onFocus: function( field, newVal, oldVal ){
        //this.store.reload()
        //alert("on focus" + this.idmaster + Ext.getCmp('impoexpo_'+this.idmaster).getValue() + Ext.getCmp('transporte'+this.idmaster).getValue());
        
        this.store.filter([
            {property: 'impoexpo' , value:  Ext.getCmp('impoexpo_'+this.idmaster).getValue()},
            {property: 'transporte' , value:  Ext.getCmp('transporte'+this.idmaster).getValue()}
        ]); 
    }
});
