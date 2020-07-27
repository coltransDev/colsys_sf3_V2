<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */



?>



<script type="text/javascript">


WidgetHBLAntecedentes = function( config ){
    Ext.apply(this, config);

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{doctransporte}</strong><br /><span><br /><strong>{consecutivo}-V{version}</strong><br /><span><br />{origen} - {destino}</span> </div></tpl>',
        '<tpl if="this.referencia">',
         '<span class="rojo">{referencia}</span>',
        '</tpl>'



    );
        
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("antecedentes/listaReportesJSON")?>'
        }),
        baseParams: {queryType: 'hbl'},
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
            {name: 'orden_clie', mapping: 'r_ca_orden_clie'},
            {name: 'idetapa', mapping: 'r_ca_idetapa'},
            {name: 'referencia', mapping: 'ic_ca_referencia'},
            {name: 'doctransporte', mapping: 's_ca_doctransporte'},
            {name: 'emisionhbl', mapping: 's_ca_emisionhbl'}
        ])
    });

    
    WidgetHBLAntecedentes.superclass.constructor.call(this, {
        valueField:'doctransporte',
        displayField:'doctransporte',
        typeAhead: false,
        loadingText: 'Buscando...',
        forceSelection: true,
        minChars: 2,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        tpl: this.resultTpl,
        itemSelector: 'div.search-item',
        listeners: {
            focus: this.onFocusWdg
        }
    });
}


Ext.extend(WidgetHBLAntecedentes, Ext.form.ComboBox, {
    onFocusWdg: function( field, newVal, oldVal ){

        var cmp = Ext.getCmp(this.linkModalidad);
        if( cmp ){
            this.store.setBaseParam("modalidad",cmp.getValue());
        }

        var cmp = Ext.getCmp(this.linkOrigen);
        if( cmp ){
            combo=cmp.getRecord();
            this.store.setBaseParam("origen",combo.data.idtrafico);
        }

        var cmp = Ext.getCmp(this.linkDestino);
        if( cmp ){
            this.store.setBaseParam("destino",cmp.getValue());
        }

           
    }

});

	
</script>
