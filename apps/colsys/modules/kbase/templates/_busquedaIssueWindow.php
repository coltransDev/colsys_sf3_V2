<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("kbase", "widgetBusquedaKB");

?>

<script type="text/javascript">
BusquedaIssueWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    this.items = [
        new PanelIssues({height:300,
                        y:20,
                        id: 'kbase-search-grid',
                        idticket: this.idticket,
                        opener: this.opener
                        })
    ];
    
    this.searchFld = new widgetBusquedaKB();
    
    this.tbar = [ this.searchFld ];


    this.buttons = [        
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

    

    BusquedaIssueWindow.superclass.constructor.call(this, {
        title: "Busqueda Base de Datos de Conocimiento",
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        id: 'kbase-search-win',
        buttons: this.buttons,
        items: this.items,
        tbar: this.tbar
    });

    //this.addEvents({add:true});
}

Ext.extend(BusquedaIssueWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        BusquedaIssueWindow.superclass.show.apply(this, arguments);
    }

    

});

</script>