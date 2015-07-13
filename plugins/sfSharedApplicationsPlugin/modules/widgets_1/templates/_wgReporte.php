<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript">
Ext.define('Ext.colsys.wgReporte', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wReporte',
    store: new Ext.data.Store(
    {
       //model: 'ClientesModel',       
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
     ],
       proxy: {
          url: '<?=url_for('widgets/listaReportesJSON')?>',    
          type: 'ajax',
          //autoLoad: true,
          reader: 
          {
             root: 'root',
             totalProperty: 'totalCount',
             id: 'id',
             type: 'json'
          }
       }
    }),
     displayField: 'consecutivo',
     valueField: 'idreporte',
     typeAhead: false,
     loadingText: 'buscando...',
     triggerAction: 'all',     
     selectOnFocus: true,
     allowBlank: false,
     //anchor: '98%',
     //width: 500,
     enableKeyEvents: true,
     //pageSize: true,
     //minListWidth: 220,
     minChars: 3,     
     //labelWidth: 60,
     listConfig: {
                loadingText: 'buscando...',
                emptyText: 'No matching posts found.',

                // Custom rendering template for each item
                getInnerTpl: function() {
                    return '<tpl for="."><div class="search-item"><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>';
                }
            },
    initComponent: function() {
        var me = this;
 
        Ext.applyIf(me, {
            emptyText: 'Seleccione un Reporte',
            loadingText: 'Loading...',
            store: {type: 'roletemplatesremote'}
        });
        me.callParent(arguments);
        me.getStore().on('beforeload', this.beforeTemplateLoad, this);
    },
 
    beforeTemplateLoad: function(store) {
        store.proxy.extraParams = {
            impoexpo: this.impoexpo,
            transporte: this.transporte
        }
    }
            
});

</script>

