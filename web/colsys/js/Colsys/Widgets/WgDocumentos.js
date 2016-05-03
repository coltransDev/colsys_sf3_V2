/**
* @autor Felipe Nariño 
* @return ComboBox cargados con los tipos de documentos correspondientes a un modo
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               idimpoexpo: impoexpo
  
* @date:  2016-04-07
*/

Ext.define('Colsys.Widgets.WgDocumentos', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.wDocumentos',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',  
  spExtraParam:'',
  store: Ext.create('Ext.data.Store', {
            fields: ['id','name'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosDocumentos',
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
    
        
         
            this.store.load({
                params : {
                    idsserie : this.idsserie,
                    idimpoexpo: idimpoe,
                    idtransporte: idtrans
                }
            });

            this.superclass.onRender.call(this, ct, position);
            
      }
});
