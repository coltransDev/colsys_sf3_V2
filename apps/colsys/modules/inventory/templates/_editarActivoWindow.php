<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inventory", "editarActivoPropiedadesPanel");
include_component("gestDocumental", "panelArchivos", array("readOnly"=>false) );


?>

<script type="text/javascript">
EditarActivoWindow = function( config ) {
    Ext.apply(this, config);
    
    this.ctxRecord = null;

    
    this.items = [
        new EditarActivoPropiedadesPanel({idactivo: this.idactivo,
                                          idcategory: this.idcategory,
                                          gridopener: this.gridopener
                                         })
    ];

    

    this.subpanel = new Ext.TabPanel({
       readOnly: this.readOnly,
       idactivo: this.idactivo,
       idcategory: this.idcategory,
       activeTab: 0,
       items: this.items
    });
    
   

     if( this.idactivo ){
         var title = "Editar activo";
     }else{
         var title = "Nuevo activo";
     }

    EditarActivoWindow.superclass.constructor.call(this, {
        title: title,
        id: 'editar-activo-win',
        autoHeight: true,
        width: 800,
        //height: 400,
        autoHeight: true, 
        resizable: false,
        plain:true,
        modal: true,        
        y: 100,
        autoScroll: true,
        closeAction: 'close',
        
        items: this.subpanel
    });

    this.addEvents({add:true});
}

Ext.extend(EditarActivoWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        EditarActivoWindow.superclass.show.apply(this, arguments);
    },

    guardar: function(){
        var panel = Ext.getCmp("form-activo-panel");
        panel.guardar( this.gridopener );        
    }

});

</script>