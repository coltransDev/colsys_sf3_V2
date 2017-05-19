/**
* @autor Felipe Nariño 
* @return Combobox cargado con lineas
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               idmaster: identificador del master
*               query : texto digitado para filtrar 
*               
*              
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgLinea', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgLinea',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',
    trans:'',
    spExtraParam:'',
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
            }
        },
        autoLoad: true
    }),
    qtip:'Listado de lineas',
    listeners: {
        beforerender: function (ct, position) {
            prefijo = this.prefijo;
            console.log('fasdfsd'+prefijo);
            if (prefijo) {
                store = this.getStore();
                store.proxy.url = prefijo + '/widgets5/datosLineas';
                store.load();
            }
        }
    },
    labelWidth: 60/*,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return new Ext.XTemplate(
                '<tpl for="."><div class="search-item"><b>{linea}</b><br /><br />',
                '<span style="font-size:9px">',
                '<tpl if="!this.activoImpo(activo_impo)">',
                '<p><span class="rojo">Inactivo Impo</span></p>',
                '</tpl>',
                '<tpl if="!this.activoExpo(activo_expo)">',
                '<p><span class="rojo">Inactivo Expo</span></p>',
                '</tpl>',
                '</span> </div></tpl>'
                , {
                    activoImpo: function (val) {
                        return val == true
                    },
                    activoExpo: function (val) {
                        return val == true
                    }
                }
        );  
        }
    }*/,  
      
    onFocus : function( obj, the1, eOpts1 ){
          
        trans=Ext.getCmp(this.idtransporte).getValue();
          
        if(this.trans!=trans){
            
            this.store.load({
                params : {
                    transporte : trans
                }
            });
            
            this.trans=trans;
        }
        else{
            return false;
        }
    }
});
