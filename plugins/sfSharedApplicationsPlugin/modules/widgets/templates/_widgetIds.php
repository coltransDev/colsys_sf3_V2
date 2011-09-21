<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<script type="text/javascript">


WidgetIds = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for('widgets/listaIdsJSON')?>'
        }),
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'totalCount'
        }, [
            {name: 'id', mapping: 'ca_id'},
            {name: 'nombre', mapping: 'ca_nombre'}
        ])
    });

    this.resultTpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item"><b>{nombre}</b></div></tpl>'
    );
    
    WidgetIds.superclass.constructor.call(this, {
        displayField:'nombre',
        valueField:'id',
        loadingText: 'Buscando...',        
        forceSelection: true,
        selectOnFocus:true,
        minChars: 3,
        tpl: this.resultTpl,
        triggerAction: 'all',
        emptyText:'',              
        lazyRender:true,                
        emptyText: 'Escriba el nombre del cliente...',
        itemSelector: 'div.search-item'
        

    });



}


Ext.extend(WidgetIds, Ext.form.ComboBox, {
    
});
</script>