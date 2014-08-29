<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<script type="text/javascript">


WidgetUsuario = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/datosComboUsuario")?>'
            
        }),
        baseParams: {idempresa: this.idempresa},
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
            {name: 'login'},
            {name: 'nombre'},
			{name: 'cargo'},
            {name: 'sucursal'},
			{name: 'icon'}


        ])
    });

    this.resultTpl = new Ext.XTemplate(
        '<tpl for=".">',
        '<div class="search-item">',
            '<div style="float:left; clear:left" class="userthumb" align="left"><img src="{icon}" height="80" /></div>',
            '<div style="margin-left: 80px; height: 90px"  ><b>{nombre}</b><br /><span>{cargo}</span><br /><span>{sucursal}</span></div>',
            
            
         '</div></tpl>'
    );

    WidgetUsuario.superclass.constructor.call(this, {
        valueField:'login',
        displayField:'nombre',
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
        submitValue: true
    });
};


Ext.extend(WidgetUsuario, Ext.form.ComboBox, {
   

});

	
</script>