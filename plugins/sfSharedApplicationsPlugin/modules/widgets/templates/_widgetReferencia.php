<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
WidgetReferencia = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{ca_referencia}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'
    );
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaReferencias")?>'
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
            {name: 'ca_referencia',mapping: 'm_ca_referencia'},
			{name: 'origen',mapping: 'o_ca_ciudad'},
            {name: 'destino',mapping: 'd_ca_ciudad'},
            {name: 'idorigen',mapping: 'o_ca_idciudad'},
			{name: 'iddestino',mapping: 'd_ca_idciudad'},
            {name: 'compania',mapping: 'cl_ca_compania'},
            {name: 'idcliente',mapping: 'm_ca_idcliente'},
			{name: 'ca_vendedor',mapping: 'm_ca_vendedor'},
			{name: 'ca_piezas',mapping: 'm_ca_piezas'},
			{name: 'ca_peso',mapping: 'm_ca_peso'},
            {name: 'ca_volumen',mapping: 'm_ca_volumen'},
			{name: 'ca_mercancia',mapping: 'm_ca_mercancia'}
        ])
    });

    WidgetReferencia.superclass.constructor.call(this, {
        valueField:'ca_referencia',
        displayField:'ca_referencia',
        typeAhead: false,
        loadingText: 'Buscando...',
        forceSelection: false,
        minChars: 3,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,
        lazyRender:true,
        tpl: this.resultTpl,
        itemSelector: 'div.search-item'
    });
}
Ext.extend(WidgetReferencia, Ext.form.ComboBox, {

});
</script>
