/*
    * @autor Nataly Puentes
    * @return ComboBox tercero según filtro ingresado
    * @param
    *        tipo: tipo de tercero (proveedor,representante)
    *        query : texto digitado para filtrar 
    * @date:  2016-03-31
*/
Ext.define('mdTercero',{
    extend: 'Ext.data.Model',
    fields: [
            {name: 'idtercero', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
            {name: 'ciudad', mapping: 'c_ca_ciudad'},
            {name: 'pais', mapping: 'p_ca_nombre'},
            {name: 'direccion', mapping: 't_ca_direccion'},
            {name: 'contacto', mapping: 't_ca_contacto'},
            {name: 'idreporte'}
    ]
});
Ext.define('Colsys.Widgets.wgTercero', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'Colsys.Widgets.wgReporte',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdTercero',
        proxy: {
        type: 'ajax',
        url: '/widgets/listaTercerosJSON',
         reader: {
             type: 'json',
             rootProperty: 'terceros'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    valueField:'idtercero',
    displayField:'nombre',
    minChars: 3,/*,
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{compania}</strong><br /><span><br />{nombre_ven}</span> </div></tpl>';
        }
    }*/
    onRender: function(ct, position){
       Colsys.Widgets.wgTercero.superclass.onRender.call(this, ct, position);
       //console.log(this.tipoT);
       
    },
    onFocus : function( obj, the1, eOpts1){//
       
       this.store.proxy.extraParams = {           
            tipo: this.tipo
        }
    }
});



