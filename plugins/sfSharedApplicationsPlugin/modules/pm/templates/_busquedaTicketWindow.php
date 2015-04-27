<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "widgetBusquedaTicket");

?>

<script type="text/javascript">
BusquedaTicketWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    this.items = [
        new PanelBusquedaTicket({height:350,
                        y:100,
                        id: 'ticket-search-grid',
                        opener: this.opener,
                        autoload: false
                        })
    ];
    
    this.searchFld = new widgetBusquedaTicket();
    this.optionsFld = new Ext.form.ComboBox({
    fieldLabel: 'Opcion',
    typeAhead: true,
    width: 140,
    forceSelection: true,
    triggerAction: 'all',
    emptyText:'Seleccione',
    selectOnFocus: true,
    id: 'search-ticket-option',
    lazyRender:true,
    listClass: 'x-combo-list-small',
    value: "idticket",
    store : [
        ["idticket","# ticket"],        
        ["texto","Entre los textos"],
        ["reportedBy","Reportado por"],
        ["documento","Documento"],
        ["index","Indexada"]
	 ]})

    
    this.tbar = [ this.searchFld, this.optionsFld ];


    this.buttons = [        
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

    

    BusquedaTicketWindow.superclass.constructor.call(this, {
        title: "Busqueda de Tickets",
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        id: 'ticket-search-win',
        buttons: this.buttons,
        items: this.items,
        tbar: this.tbar
    });

    //this.addEvents({add:true});
}

Ext.extend(BusquedaTicketWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        BusquedaTicketWindow.superclass.show.apply(this, arguments);
    }

    

});

</script>