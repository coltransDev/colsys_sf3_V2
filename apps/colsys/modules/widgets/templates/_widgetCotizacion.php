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
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaCotizacionesJSON")?>'            
        }),
        baseParams:{transporte:config.modo,impoexpo:config.impoexpo},
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'           
        }, [
            {name: 'idcotizacion', mapping: 'c_ca_idcotizacion'},
            {name: 'consecutivo', mapping: 'c_ca_consecutivo'},
            {name: 'idproducto', mapping: 'p_ca_idproducto'},
            {name: 'producto', mapping: 'p_ca_producto'},
            {name: 'impoexpo', mapping: 'p_ca_impoexpo'},
            {name: 'transporte', mapping: 'p_ca_transporte'},
            {name: 'modalidad', mapping: 'p_ca_modalidad'},
            {name: 'incoterms', mapping: 'p_ca_incoterms'},
            {name: 'idlinea', mapping: 'p_ca_idlinea'},
            {name: 'linea', mapping: 'p_ca_linea'},
            {name: 'idmodalidad'},
            {name: 'tra_origen', mapping: 'o_ca_idtrafico'},
            {name: 'tra_destino', mapping: 'd_ca_idtrafico'},
			{name: 'origen', mapping: 'o_ca_ciudad'},
            {name: 'destino', mapping: 'd_ca_ciudad'},
            {name: 'idorigen', mapping: 'o_ca_idciudad'},
			{name: 'iddestino', mapping: 'd_ca_idciudad'},
			{name: 'idcontacto', mapping: 'con_ca_idcontacto'},
            {name: 'idcliente', mapping: 'cl_ca_idcliente'},
            {name: 'compania', mapping: 'cl_ca_compania'},
            {name: 'dias_credito', mapping: 'libcli_ca_diascredito'},
            {name: 'cupo', mapping: 'libcli_ca_cupo'},
			{name: 'cargo', mapping: 'con_ca_cargo'},
			{name: 'nombre', mapping: 'con_ca_nombres'},
			{name: 'papellido', mapping: 'con_ca_papellido'},
			{name: 'sapellido', mapping: 'con_ca_sapellido'},
			{name: 'preferencias', mapping: 'cl_ca_preferencias'},
			{name: 'confirmar', mapping: 'cl_ca_confirmar'},
            {name: 'idvendedor', mapping: 'c_ca_usuario'},
            {name: 'coordinador', mapping: 'cl_ca_coordinador'},
            {name: 'vendedor', mapping: 'usu_ca_nombre'},
            {name: 'idmoneda', mapping: 's_ca_idmoneda'},
            {name: 'idmonedaobtencion', mapping: 's_ca_idmonedaobtencion'},
            {name: 'prima_vlr', mapping: 's_ca_prima_vlr'},
            {name: 'prima_min', mapping: 's_ca_prima_min'},
            {name: 'obtencion', mapping: 's_ca_obtencion'},


        ])
    });

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'
    );

    WidgetCotizacion.superclass.constructor.call(this, {
        valueField:(config.valueField)?config.valueField:'idcotizacion',
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