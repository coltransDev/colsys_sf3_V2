<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
?>
<script type="text/javascript">
WidgetHbls = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{referencia}-{hbls}</strong></div></tpl>'
    );
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaHblsJSON")?>'
        }),
        baseParams:{},
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
            {name: 'referencia'  , mapping: 'm_ca_referencia'},
            {name: 'idcliente'   , mapping: 'ic_ca_idcliente'},
            {name: 'idreporte'   , mapping: 'ic_ca_idreporte'},
            {name: 'hbls'        , mapping: 'ic_ca_hbls'},
            {name: 'idproveedor' , mapping: 'ic_ca_idproveedor'},
            {name: 'numpiezas'   , mapping: 'ic_ca_numpiezas'},
            {name: 'peso'        , mapping: 'ic_ca_peso'},
            {name: 'volumen'     , mapping: 'ic_ca_volumen'},
            {name: 'fcharribo'   , mapping: 'm_ca_fcharribo'},
			{name: 'manifiesto'  , mapping: 'ic_ca_registroadu'}                                    
        ])
    });

    WidgetHbls.superclass.constructor.call(this, {
        valueField:'hbls',
        displayField:'hbls',
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
Ext.extend(WidgetHbls, Ext.form.ComboBox, {

});
</script>
