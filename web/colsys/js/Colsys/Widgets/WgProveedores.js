
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
Ext.define('Colsys.Widgets.WgProveedores', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.WgProveedores',
  triggerTip: 'Click para limpiar',  
  displayField: 'linea',
  valueField: 'idlinea',
  queryMode :'local',     
  store: Ext.create('Ext.data.Store', {
            fields: ['idlinea','linea'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosLineas',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                },
                extraParams:{
                    //tipo: this.tipo
                }
            },
            autoLoad: true
        }),
        qtip:'Listado de lineas',
        //labelWidth: 60,
      
      onFocus : function( obj, the1, eOpts1 )
      {/*
          if(Ext.getCmp(this.idtransporte)){
            trans=Ext.getCmp(this.idtransporte).getValue();
          }
          else{
              trans= this.idtransporte;
             
          }
          
          if(this.trans!=trans)
          {
              this.store.load({
                params : {
                    transporte : trans,
                    tipo: this.tipo
                }
            });
              this.trans=trans;
          }
          else
          { 
              return false;
          }*/
      }

});