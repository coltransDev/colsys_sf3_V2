<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "editarTicketPropiedadesPanel");


?>

<script type="text/javascript">
NuevoSeguimientoWindow = function( config ) {
    Ext.apply(this, config);
    this.ctxRecord = null;


    

    this.subpanel = new Ext.FormPanel({
                            id: "seguimiento-activo-panel",
                            url: '<?=url_for('inventory/guardarSeguimiento')?>',
                            hideLabel: true,
                            items: [
                              {
                                xtype:'hidden',
                                name: 'idactivo',
                                value: this.idactivo
                              },
                              {

                                xtype:'htmleditor',
                                name:'text',
                                hideLabel: true,
                                height:200,
                                anchor:'98%',
                                enableFont: false,
                                enableFontSize: false,
                                enableLinks:  false,
                                enableSourceEdit : false,
                                enableColors : false,
                                enableLists: false,
                                allowBlank: false

                            }]
                    })


    this.buttons = [
        {
            text: 'Guardar',
            handler: this.guardar,
            scope: this
        },
        {
            text: 'Cancelar',
            handler: this.close.createDelegate(this, [])
        }
     ];

     

    NuevoSeguimientoWindow.superclass.constructor.call(this, {
        title: 'Nuevo Seguimiento Activo # '+this.idactivo,
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

Ext.extend(NuevoSeguimientoWindow, Ext.Window, {


    show : function(){
        if(this.rendered){
            //this.feedUrl.setValue('');
        }

        //this.grid.store.setBaseParam( "idproject", this.idproject);
        //this.grid.store.load();

        NuevoSeguimientoWindow.superclass.show.apply(this, arguments);
    },

    guardar: function(){
        var panel = Ext.getCmp("seguimiento-activo-panel");

        var form = panel.getForm();
        var win = this;

        var opener = this.opener;
        if( form.isValid() ){

            form.submit({
                success:function(form,action){

                    //Ext.Msg.alert( "Información" );
                    win.close();

                    if( opener ){
                        var cmp = Ext.getCmp(opener);
                        if( cmp ){
                            cmp.body.update(action.result.info);
                        }
                    }

                    //Ext.MessageBox.alert('Sistema de Activos:', 'El seguimiento se ha guardado correctamente');
                },
                // standardSubmit: false,
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                }//end failure block
            });
        }else{
            Ext.MessageBox.alert('Sistema de Activos:', '¡Por favor complete los campos subrayados!');
        }
        
    }

});

</script>