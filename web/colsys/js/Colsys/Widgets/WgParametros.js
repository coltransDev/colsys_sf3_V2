
/**
* @autor Felipe Nariño 
* @return Combobox cargado con Parametros dependiendo el caso de uso que se envíe
* @param sfRequest $request A request 
*               caso_uso: el codigo del caso de uso 
*              
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgParametros', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgParametros',
    triggerTip: 'Click para limpiar',    
    
    store: Ext.create('Ext.data.Store', {
           fields: ['id','name','caso_uso'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosParametros',
                reader: {
                    type: 'json',
                    root: 'root'
                }
            },
            autoLoad: false
   }),
    qtip:'Listado ',
    queryMode: 'local',
    displayField: 'name',
    valueField: 'id',
    forceSelection:true,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item1">{name}</div></tpl>';
        }
    },
    onFocus: function( field, newVal, oldVal ){   
       this.store.load({
            params : {  
                caso_uso: this.caso_uso   
            }
        });
    }
});
