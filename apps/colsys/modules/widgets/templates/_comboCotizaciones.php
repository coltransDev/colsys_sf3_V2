<input type="text" name="cotizacion" id="cotizacion" value="" size="10" Autocomplete="off" />	
<script type="text/javascript">
Ext.onReady(function(){

    var ds = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaCotizacionesJSON")?>'
        }),
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

	var resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'

    );

    new Ext.form.ComboBox({
        id: 'combo-cotizacion',
        store: ds,
        displayField:'consecutivo',
        typeAhead: false,
        loadingText: 'Buscando...',
        width: 100,
        valueNotFoundText: 'No encontrado' ,
		minChars: 3,
        hideTrigger:true,
        tpl: resultTpl,
        applyTo: 'cotizacion',
        itemSelector: 'div.search-item',
	    emptyText:'numero...',
	    forceSelection:true,
		selectOnFocus:true
        <?=isset($value)?",value: '".$value."'":""?>


    });
});
</script>