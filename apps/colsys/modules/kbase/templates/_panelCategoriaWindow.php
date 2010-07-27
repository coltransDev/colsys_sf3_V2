<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetAgente");
?>
<script type="text/javascript">
 /**
 * PanelCategoriaWindow object definition
 **/
PanelCategoriaWindow = function( config ) {

    Ext.apply(this, config);

    PanelCategoriaWindow.superclass.constructor.call(this, {
        title: 'Ingrese los datos de la categoria',
        //id: 'costos-aduana-win',
        autoHeight: true,
        width: 400,
        //height: 600,
        resizable: true,
        plain:true,
        modal: true,
        y: 100,
        autoScroll: true,
        closeAction: 'close',

        buttons:[
             {
                text: 'Guardar',
                handler: this.guardar,
                scope: this
             },
             {
                text: 'Cancel',
                handler: this.close.createDelegate(this, [])
             }
        ],
        items: new Ext.FormPanel({
            id: 'categoria-form',
            layout: 'form',
            frame: true,
            autoHeight: true,
            bodyStyle: 'padding: 5px 5px 0 5px;',
            labelWidth: 100,

            items: [{
                        id: 'idcategory',
                        xtype:'hidden',
                        name: 'idcategory',
                        value: '',
                        allowBlank:false
                    },
                    {
                        id: 'parent',
                        xtype:'hidden',
                        name: 'parent',
                        value: '',
                        allowBlank:false
                    },
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Nombre',
                        name: 'name',
                        value: '',
                        allowBlank:false
                    },
                    {
                        xtype: 'checkbox',
                        width: 100,
                        fieldLabel: 'Folder',
                        id: 'main',
                        value: '',
                        checked: false,
                        allowBlank:false
                    }
                   
                    
                ]
        })

    });

    this.addEvents({add:true});
}

Ext.extend(PanelCategoriaWindow, Ext.Window, {


    show : function(){
        if(this.rendered){

        }

        PanelCategoriaWindow.superclass.show.apply(this, arguments);
    },

    guardar: function() {


        var fp = Ext.getCmp("categoria-form");
        if( fp.getForm().isValid() ){

            var win = this;
            var node = this.node;
            var action = this.action;
            var name = fp.getForm().findField("name").getValue();
            fp.getForm().submit({url:'<?=url_for('kbase/panelCategoriaGuardar')?>',
                waitMsg:'Salvando Datos...',
                // standardSubmit: false,

                success:function(form,action){
                    //Ext.Msg.alert( "","Se ha guardado correctamente, es necesario actualizar la pagina para ver los cambios." );
                    win.close();
                    if( node ){
                        if( action=="add"){
                            node.reload();
                        }else{
                            node.setText(name);
                        }
                    }


                },
                failure:function(form,action){
                    Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                }//end failure block
           });
            

        }else{
            Ext.MessageBox.alert('Trayectos - Error:', '¡Atención: La información no es válida o está incompleta!');
        }



    }


});

</script>