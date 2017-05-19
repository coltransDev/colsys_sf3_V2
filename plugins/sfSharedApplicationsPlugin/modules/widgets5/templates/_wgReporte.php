<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$data = $sf_data->getRaw("data");
?>
<script type="text/javascript">


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
        {name: 'orden_clie', mapping: 'r_ca_orden_clie'}
    ]
});
Ext.define('Ext.colsys.wgReporte', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wReporte',
    triggerTip: 'Click para limpiar',    
    store: {
        model: 'mdReporte',        
        proxy: {
        type: 'ajax',
        url: '<?=url_for("widgets/listaReportesJSON")?>',        
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
    //itemSelector: 'div.search-item',
    listConfig: {
        loadingText: 'buscando...',
        emptyText: 'No existen registros',
        getInnerTpl: function() {
            return '<tpl for="."><div class="search-item"><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>';
        }
    },
    onRender: function(ct, position){
       //this.store.load();
        this.store.proxy.extraParams = {            
            impoexpo: this.impoexpo
        }
       Ext.colsys.wgReporte.superclass.onRender.call(this, ct, position);
   }
});
</script>