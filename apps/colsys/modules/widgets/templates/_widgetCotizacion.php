<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



?>



<script type="text/javascript">


WidgetCotizacion = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'

    );
        
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaCotizacionesJSON")?>'
        }),        
        reader: new Ext.data.JsonReader({
            root: 'terceros',
            totalProperty: 'totalCount'           
        }, [
            {name: 'idcotizacion', mapping: 'c_ca_idcotizacion'},
            {name: 'consecutivo', mapping: 'c_ca_consecutivo'},
            {name: 'idproducto', mapping: 'p_ca_idproducto'},
            {name: 'producto', mapping: 'p_ca_producto'},
            {name: 'impoexpo', mapping: 'p_ca_impoexpo'},
            {name: 'transporte', mapping: 'p_ca_transporte'},
            {name: 'modalidad', mapping: 'p_ca_modalidad'},
            {name: 'idlinea', mapping: 'p_ca_idlinea'},
            {name: 'idmodalidad'},
            {name: 'tra_origen', mapping: 'o_ca_idtrafico'},
            {name: 'tra_destino', mapping: 'd_ca_idtrafico'},
			{name: 'origen', mapping: 'o_ca_ciudad'},
            {name: 'destino', mapping: 'd_ca_ciudad'},
            {name: 'idorigen', mapping: 'o_ca_idciudad'},
			{name: 'iddestino', mapping: 'd_ca_idciudad'},
			{name: 'idcontacto', mapping: 'con_ca_idcontacto'},
            {name: 'compania', mapping: 'cl_ca_compania'},
			{name: 'cargo', mapping: 'con_ca_cargo'},
			{name: 'nombre', mapping: 'con_ca_nombres'},
			{name: 'papellido', mapping: 'con_ca_papellido'},
			{name: 'sapellido', mapping: 'con_ca_sapellido'},
			{name: 'preferencias', mapping: 'cl_ca_preferencias'},
			{name: 'confirmar', mapping: 'cl_ca_confirmar'},
            {name: 'vendedor', mapping: 'c_ca_usuario'},
            {name: 'coordinador', mapping: 'cl_ca_coordinador'}


        ])
    });

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{nombre}</strong><br /><span><br />{ciudad} - {pais}</span> </div></tpl>'
    );

    WidgetCotizacion.superclass.constructor.call(this, {
        valueField:'idproducto',
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


Ext.extend(WidgetCotizacion, Ext.form.ComboBox, {
    

});

	
</script>