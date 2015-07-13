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
            }
});


/*
Ext.define('Ext.colsys.wgReporte', {
    extend: 'Ext.form.field.ComboBox',
    alias: 'widget.wReporte',
    triggerTip: 'Click para limpiar',
    spObj:'',
    spForm:'',  
    spExtraParam:'',
    valueField:'idreporte',
    displayField:'consecutivo',
    typeAhead: false,
    loadingText: 'Buscando...',
    forceSelection: true,
    minChars: 3,
    triggerAction: 'all',
    emptyText:'',
    selectOnFocus: true,
    lazyRender:true,    
    itemSelector: 'div.search-item',
    store: Ext.create('Ext.data.Store', {
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
            proxy: 
            {                
                url: '<?=url_for('widgets/listaReportesJSON')?>',
                reader: {
                    type: 'json',
                    root: 'topics',
                    totalProperty: 'totalCount'
                }
            }
        })
});

*/

/*WgReporte = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'
    );
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaReportesJSON")?>'
        }),
        baseParams: {
            transporte: this.transporte,
            impoexpo: this.impoexpo,
            openedOnly: this.openedOnly            
        },
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
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
        ])
    });

    WgReporte.superclass.constructor.call(this, {
        valueField:'idreporte',
        displayField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        forceSelection: true,
        minChars: 3,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        tpl: this.resultTpl,
        itemSelector: 'div.search-item'
    });
}

Ext.extend(WgReporte, Ext.form.field.ComboBox, {

});
*/
</script>

