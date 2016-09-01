<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>



<script type="text/javascript">


WidgetTicket = function( config ){
    Ext.apply(this, config);
    
    this.store = new Ext.data.Store({
        proxy: new Ext.data.HttpProxy({
            url: '<?=url_for("widgets/listaTicketsJSON")?>'            
        }),
        baseParams: {iddepartament: this.iddepartament},
        reader: new Ext.data.JsonReader({
            root: 'root',
            totalProperty: 'total'
        }, [
            {name: 'h_ca_idticket'},
            {name: 'h_ca_title'},
            {name: 'h_ca_text'},
            {name: 'e_idemail'}
        ])
    });

    this.resultTpl = new Ext.XTemplate(
       '<tpl for="."><div class="search-item"><span style="color:green; font-weight: bold;">{h_ca_idticket} ({h_ca_title})</span><br /><span><br />{h_ca_text}</span></div><div><span color:gray;><a href="/email/verEmail?id={e_idemail}" target="_blank">Ver Ticket # {h_ca_idticket}</a></span></div></tpl>'
    );

    WidgetTicket.superclass.constructor.call(this, {
        valueField:'h_ca_idticket',
        displayField:'h_ca_idticket',
        typeAhead: false,
        loadingText: 'Buscando...',
        forceSelection: true,
        minChars: 2,
        triggerAction: 'all',
        emptyText:'',
        selectOnFocus: true,        
        lazyRender:true,
        tpl: this.resultTpl,
        itemSelector: 'div.search-item'
    });
};


Ext.extend(WidgetTicket, Ext.form.ComboBox, {
   

});

	
</script>