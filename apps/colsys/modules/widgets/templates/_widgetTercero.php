<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

$data = $sf_data->getRaw("data");

?>



<script type="text/javascript">


WidgetTercero = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaTercerosJSON")?>',
            
        }),
        baseParams: {tipo: this.tipo},
        reader: new Ext.data.JsonReader({
            root: 'terceros',
            totalProperty: 'totalCount',
            id: 'id'
        }, [
            {name: 'id', mapping: 't_ca_idtercero'},
            {name: 'nombre', mapping: 't_ca_nombre'},
			{name: 'ciudad', mapping: 'c_ca_ciudad'},
			{name: 'pais', mapping: 'p_ca_nombre'}


        ])
    });

    this.resultTpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item"><strong>{nombre}</strong><br /><span><br />{ciudad} - {pais}</span> </div></tpl>'
    );

    WidgetTercero.superclass.constructor.call(this, {        
        displayField:'nombre',
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


Ext.extend(WidgetTercero, Ext.form.ComboBox, {

});

	
</script>