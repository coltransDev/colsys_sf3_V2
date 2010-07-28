<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");


?>

<script type="text/javascript">
EditarTicketWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    this.items = [
        new EditarTicketPropiedadesPanel({idticket: this.idticket,
                                             nivel: <?=isset($nivel)?$nivel:0?>
                                            })
    ];
    /*
    if( this.idticket ){        
        this.items.push( new PanelArchivos({
                                folder: this.folder,
                                closable: false,
                                title: "Archivos",
                                height: 400
                                
                            })
                       );
    }*/

    this.subpanel = new Ext.TabPanel({
       readOnly: this.readOnly,
       idticket: this.idticket,
       activeTab: 0,
       items: this.items
       
    });


    this.buttons = [
        {
            text: 'Enviar',
            handler: this.enviarTicket,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     if( this.idticket ){
         var title = "Editar ticket";
     }else{
         var title = "Nuevo ticket";
     }

    EditarTicketWindow.superclass.constructor.call(this, {
        title: title,
        id: 'editar-ticket-win',
        autoHeight: true,
        width: 800,
        //height: 400,
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        buttons: this.buttons,
        items: this.subpanel
    });

    this.addEvents({add:true});
}

Ext.extend(EditarTicketWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        EditarTicketWindow.superclass.show.apply(this, arguments);
    },

    enviarTicket: function(){
        var panel = Ext.getCmp("form-ticket-panel");
        panel.guardar();
        
    }

});

</script>