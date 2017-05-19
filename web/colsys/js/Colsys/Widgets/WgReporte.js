 /**
    * @autor Felipe Nariño
    * @return ComboBox cargado con reportes de Negocio
    * @param 
    *        idtransporte : tipo de transporte
    *        idimpoexpo: impoexpo
    *        query : texto digitado para filtrar 
    * @date:  2016-03-28
*/


Ext.define('mdReporte',{
    extend: 'Ext.data.Model',
    fields: [
        {name: 'idreporte', mapping: 'r_ca_idreporte'},
        {name: 'consecutivo', mapping: 'r_ca_consecutivo'},
        {name: 'version', mapping: 'r_ca_version'},
        {name: 'mercancia_desc', mapping: 'r_ca_mercancia_desc'},
        {name: 'impoexpo', mapping: 'r_ca_impoexpo'},
        {name: 'transporte', mapping: 'r_ca_transporte'},
        {name: 'modalidad', mapping: 'r_ca_modalidad'},
        {name: 'idlinea', mapping: 'r_ca_idlinea'},
        {name: 'tra_origen', mapping: 'o_ca_idtrafico'},
        {name: 'tra_destino', mapping: 'd_ca_idtrafico'},
        {name: 'origen', mapping: 'o_ca_ciudad'},
        {name: 'destino', mapping: 'd_ca_ciudad'},
        {name: 'idorigen', mapping: 'o_ca_idciudad'},
        {name: 'iddestino', mapping: 'd_ca_idciudad'},
        {name: 'idcontacto', mapping: 'con_ca_idcontacto'},
        {name: 'compania', mapping: 'cl_ca_compania'},
        {name: 'idcliente', mapping: 'cl_ca_idcliente'},
        {name: 'cargo', mapping: 'con_ca_cargo'},
        {name: 'nombre', mapping: 'con_ca_nombres'},
        {name: 'papellido', mapping: 'con_ca_papellido'},
        {name: 'sapellido', mapping: 'con_ca_sapellido'},
        {name: 'preferencias', mapping: 'cl_ca_preferencias'},
        {name: 'confirmar', mapping: 'cl_ca_confirmar'},
        {name: 'vendedor', mapping: 'usu_ca_login'},
        {name: 'nombreVendedor', mapping: 'usu_ca_nombre'},
        {name: 'coordinador', mapping: 'cl_ca_coordinador'},
        {name: 'orden_clie', mapping: 'r_ca_orden_clie'},
        {name: 'bodega', mapping: 'r_ca_idbodega'},
        {name: 'nombrebodega', mapping: 'b_ca_nombre'},
    ]
});
Ext.define('Colsys.Widgets.WgReporte', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.Colsys.Widgets.WgReporte',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdReporte',        
        proxy: {
        type: 'ajax',
        url: '/widgets5/listaReportesJSON',
         reader: {
             type: 'json',
             rootProperty: 'root'
         }
        },
        autoLoad: false
    },
    qtip:'Listado ',
    queryMode: 'remote',
    displayField: 'consecutivo',
    valueField: 'idreporte',
    minChars:'3',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>';
        }
    },
    onRender: function(ct, position){
       Colsys.Widgets.WgReporte.superclass.onRender.call(this, ct, position);
    },
   onFocus : function( obj, the1, eOpts1 ){
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
    }
    
});

