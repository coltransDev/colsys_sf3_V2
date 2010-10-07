<script>

listReportesPanel = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{consecutivo}-{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>'

    );

    this.storeData = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaReportesJSON?query=1478")?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
            {name: 'idreporte', mapping: 'r_ca_idreporte'},
            {name: 'consecutivo', mapping: 'r_ca_consecutivo'},
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
			{name: 'cargo', mapping: 'con_ca_cargo'},
			{name: 'nombre', mapping: 'con_ca_nombres'},
			{name: 'papellido', mapping: 'con_ca_papellido'},
			{name: 'sapellido', mapping: 'con_ca_sapellido'},
			{name: 'preferencias', mapping: 'cl_ca_preferencias'},
			{name: 'confirmar', mapping: 'cl_ca_confirmar'},
            {name: 'vendedor', mapping: 'c_ca_usuario'},
            {name: 'coordinador', mapping: 'cl_ca_coordinador'},
            {name: 'version', mapping: 'r_ca_version'}
        ])
    });
    this.storeData.load();
    listReportesPanel.superclass.constructor.call(this, {
        title: 'List Data View', 
        frame: true,
        width: 400,
        height: 340, 
        id: 'panelBottom',
        style: 'margin: 0 auto;',        
        items: [
            new Ext.DataView({
                autoScroll: true,
                store: this.storeData,
                tpl: this.resultTpl,
                autoHeight: false,
                height: 265,
                multiSelect: true,
                itemSelector: 'div.thumb-wrap',
                emptyText: 'No data to display',
                loadingText: 'Please Wait...',
                style: 'border:1px solid #99BBE8;background:#fff;'
            })
        ]
        ,
        buttons: [{
            text: 'Get Checked',
            handler: this.checkvalue
        }]
    });
}


Ext.extend(listReportesPanel, Ext.form.FormPanel, {
    
});
</script>