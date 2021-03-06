<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
WidgetReporte = function( config ){
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

    WidgetReporte.superclass.constructor.call(this, {
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
Ext.extend(WidgetReporte, Ext.form.ComboBox, {

});
</script>
