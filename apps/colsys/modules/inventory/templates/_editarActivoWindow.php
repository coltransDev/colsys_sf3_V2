<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("inventory", "editarActivoPropiedadesPanel");
include_component("inventory", "editarActivoHardwarePropiedadesPanel");
include_component("inventory", "editarActivoSoftwarePropiedadesPanel");
include_component("gestDocumental", "panelArchivos", array("readOnly"=>false) );


?>

<script type="text/javascript">
EditarActivoWindow = function( config ) {
    Ext.apply(this, config);
    
    this.ctxRecord = null;

    
       
    switch( this.parameter ){   
        case "Hardware":
            this.subpanel = new EditarActivoHardwarePropiedadesPanel({
               readOnly: this.readOnly,
               idactivo: this.idactivo,
               idcategory: this.idcategory,
               idsucursal: this.idsucursal,
               gridopener: this.gridopener,
               items: this.items,
               copy: this.copy
            });
            break;
        case "Software":
            this.subpanel = new EditarActivoSoftwarePropiedadesPanel({
               readOnly: this.readOnly,
               idactivo: this.idactivo,
               idcategory: this.idcategory,
               idsucursal: this.idsucursal,
               gridopener: this.gridopener,
               items: this.items,
               copy: this.copy
            });
            break;
        default: 
            this.subpanel = new EditarActivoPropiedadesPanel({
               readOnly: this.readOnly,
               idactivo: this.idactivo,
               idcategory: this.idcategory,
               idsucursal: this.idsucursal,
               gridopener: this.gridopener,
               items: this.items,
               copy: this.copy
            });
        break;
    }
    
   

     if( this.idactivo ){
         var title = "Editar activo";
     }else{
         var title = "Nuevo activo";
     }

    EditarActivoWindow.superclass.constructor.call(this, {
        title: title,
        id: 'editar-activo-win',
        autoHeight: true,
        width: 900,
        //height: 400,
        autoHeight: true, 
        resizable: false,
        plain:true,
        modal: true,        
        y: 10,
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