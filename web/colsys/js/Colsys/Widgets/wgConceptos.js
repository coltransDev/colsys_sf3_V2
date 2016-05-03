
/**
* @autor Felipe Nariño 
* @return Combobox cargado con proveedores filtrados por
* tipo de transporte
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               
*              
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.wgConceptos', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.WgProveedores',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',
  trans:'',
  spExtraParam:'',
  displayField: 'name',
  valueField: 'id',
  queryMode :'local',
  
  store: Ext.create('Ext.data.Store', {
            fields: ['id','name'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosConceptos',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
        }),
        qtip:'Listado de lineas',
        labelWidth: 60,
      
      boxready:  function ( me, width, height, eOpts )
      {          alert("HOLA");
              
              this.store.load({
                params : {
                    costo: this.costo,
                    transporte : this.up('grid').idtransporte,
                    impoexpo: this.up('grid').idimpoexpo
                }
            });
          
      }

});