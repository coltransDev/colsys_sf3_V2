
/**
* @autor Felipe Nari�o 
* @return Combobox cargado con Agentes
* @param sfRequest $request A request 
*               idtransporte : tipo de transporte
*               idimpoexpo: impoexpo
*               idmaster: identificador del master
*              
* @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgAgentes', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.Colsys.Widgets.WgAgentes',
  triggerTip: 'Click para limpiar',
  spObj:'',
  spForm:'',  
  spExtraParam:'',
  displayField: 'nombre',
  valueField: 'idagente',
  queryMode :'local',

  store: Ext.create('Ext.data.Store', {
            fields: ['idagente','nombre','pais','idtrafico','ciudad','direccion','tipo','tplogistics'],
            proxy: {
                type: 'ajax',
                url: '/widgets5/datosAgentes',
                reader: {
                    type: 'json',
                    rootProperty: 'root'
                }
            },
            autoLoad: true
   }),
  qtip:'Listado ',
  labelWidth: 60,
  listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            //console.log(tipo);
            //return '<tpl for="."><div class="search-item"><b>{nombre} <br> {pais} </div></tpl>';
            
            return '<tpl for="."><div class="search-item"><b>{nombre} <br> {pais} <br><span style="font-size:9px"><span class="rojo">{tipo}</span></span></div></tpl>';
            
             /*return '<tpl for="."><div class="search-item"><b>{nombre}</b><br /><span style="font-size:9px">{pais}</span> <br />',
                '<span style="font-size:9px">',
                '<tpl if="this.oficial(tipo)">',
                '<p>{tipo}</p>',
                '</tpl>',
                '<tpl if="!this.oficial(tipo)">',
                '<p><span class="rojo">{tipo}</span></p>',
                '</tpl>',
                '<tpl if="this.tplogistics(tplogistics)">',
                '<p><span class="rojo">Agente TPLogistics</span></p>',
                '</tpl>',
                '<tpl if="this.tplogistics(consolcargo)">',
                '<p><span class="rojo">Agente Consolcargo</span></p>',
                '</tpl>',
                '</span> </div></tpl>'
        , {
                    oficial: function (val) {
                        return val == 'Oficial'
                    },
                    tplogistics: function (val) {
                        return val == true
                    },
                    consolcargo: function (val) {
                        return val == true
                    }
                }*/
        }
    },
    
    onFocus : function( obj, the1, eOpts1 ){
     
        this.store.load({
            params : {  
                origen: Ext.getCmp("idorigen"+this.idmaster).getValue(),
                destino: Ext.getCmp("iddestino"+this.idmaster).getValue(),
                impoExpo: Ext.getCmp("impoexpo"+this.idmaster).text,
                listarTodos : Ext.getCmp("listar_todos"+this.idmaster).getValue()
            }
        });

      }
});


