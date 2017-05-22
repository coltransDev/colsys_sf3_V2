 /**
    * @autor Felipe Nariño
    * @return ComboBox cargado con reportes de Negocio
    * @param 
    *        idtransporte : tipo de transporte
    *        idimpoexpo: impoexpo
    *        query : texto digitado para filtrar 
    * @date:  2016-03-28
*/
Ext.define('Colsys.Widgets.WgReferencias', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgReferencias',
    triggerTip: 'Click para limpiar',    
    store: {
            fields: [
        {name: 'referencia'},
        {name: 'idmaster'}
    ],    
        proxy: {
        type: 'ajax',
        url: '/widgets5/datosComboListaReferencias',
         reader: {
             type: 'json',
             rootProperty: 'root'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    displayField: 'referencia',
    valueField: 'idmaster',
    minChars:'3',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros'/*,
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>';
        }*/
    },
    onRender: function(ct, position){
       Colsys.Widgets.WgReferencias.superclass.onRender.call(this, ct, position);
    },
    /*onFocus : function( obj, the1, eOpts1 ){
        if (Ext.getCmp("impoexpo"+this.idmaster) && Ext.getCmp(this.idtransporte)){
            impoExpo= Ext.getCmp("impoexpo"+this.idmaster).text;
            transporte=Ext.getCmp(this.idtransporte).getValue();
            
        }
        else{
            impoExpo = this.idimpoexpo;
            transporte = this.idtransporte;
            origen = this.origen;
            destino = this.destino;
        }
        
        
        this.store.proxy.extraParams = {            
            impoexpo: impoExpo,
            transporte: transporte,
            origen: origen,
            destino: destino
        }
    }*/
    
});

