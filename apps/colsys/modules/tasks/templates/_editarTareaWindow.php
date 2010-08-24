<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("tasks", "editarTareaPropiedadesPanel");
include_component("tasks", "editarTareaAsignacionesPanel");
include_component("tasks", "editarTareaAlarmasPanel");


?>
<script type="text/javascript">
EditarTareaWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;

    this.subpanel = new Ext.TabPanel({
       readOnly: this.readOnly,
       idtarea: this.idtarea,
       activeTab: 1,
       items: [
           new EditarTareaPropiedadesPanel({idtarea: this.idtarea}),
           new EditarTareaAsignacionesPanel({idtarea: this.idtarea}),
           new EditarTareaAlarmasPanel({idtarea: this.idtarea})
       ]


    });


    this.buttons = [
         {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     if( this.idtarea ){
         var title = "Editar tarea";
     }else{
         var title = "Nueva tarea";
     }

    EditarTareaWindow.superclass.constructor.call(this, {
        title: title,
        //id: 'asignar-milestone-win',
        autoHeight: true,
        width: 500,
        height: 400,
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

Ext.extend(EditarTareaWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        EditarTareaWindow.superclass.show.apply(this, arguments);
    }

});

</script>