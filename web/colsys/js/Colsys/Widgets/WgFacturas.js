/*
    * @autor Felipe Nariño
    * @return ComboBox Facturas (tb_comprobantes)
    * @param
    *        query : texto digitado para filtrar 
    * @date:  2016-06-20
*/
Ext.define('Colsys.Widgets.WgFacturas', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgFacturas',
    store: new Ext.data.Store(
    {
        fields: [
            {name: 'consecutivo'},
            {name: 'id'},
            {name: 'nombre'},
            {name: 'cuentaformapago'},
            {name: 'referencia'}
            
         ],
        proxy: {
            url: '/widgets5/datosFacturas',    
            type: 'ajax',        
            reader: 
            {
                rootProperty: 'root',
                totalProperty: 'total'
            }
        }
    }),
     valueField:'consecutivo',
     //queryMode: 'remote',
     displayField:'consecutivo',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',     
     selectOnFocus: true,
     allowBlank: false,
     enableKeyEvents: true,
     minChars: 3,
     submitValue: true,
     triggers: {
        clear: {
            cls: 'x-form-clear-trigger',
            handler: function () {
                this.setValue(' ');
            }
        }
    },
     listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',

                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item"><b>{consecutivo} <br> Cliente: {cliente} <br> Valor :$ {valor} </div></tpl>';
                }
            },
     onFocus : function( obj, the1, eOpts1 ){
     this.store.proxy.extraParams = {            
         tipo: this.tipo
        }
    }  
});

