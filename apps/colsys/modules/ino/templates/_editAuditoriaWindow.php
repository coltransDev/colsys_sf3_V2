<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("pm", "widgetBusquedaTicket");
?>

<script type="text/javascript">
    EditAuditoriaWindow = function( config ) {
        Ext.apply(this, config);
        this.ctxRecord = null;


        this.items = [
            {
                columnWidth:.5,
                layout: 'form',
                labelAlign: "top",
                items: [{
                        xtype:'textfield',
                        fieldLabel: 'Tipo',
                        name: 'tipo',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textarea',
                        fieldLabel: 'Asunto',
                        name: 'asunto',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textfield',
                        fieldLabel: 'Detalle',
                        name: 'detalle',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textfield',
                        fieldLabel: 'Compromisos',
                        name: 'compromisos',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textfield',
                        fieldLabel: 'Respuesta Operativo',
                        name: 'respuesta',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textfield',
                        fieldLabel: 'Estado',
                        name: 'estado',
                        anchor:'95%',
                        allowBlank: false
                    },
                    {
                        xtype:'textfield',
                        fieldLabel: 'Antecesor',
                        name: 'idantecedente',
                        anchor:'95%',
                        allowBlank: false
                    }

                ]
            }
        ];

    

        this.buttons = [
            {
                text: 'Cancelar',
                handler: this.close.createDelegate(this, [])
            }
        ];



        EditAuditoriaWindow.superclass.constructor.call(this, {
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
            id: 'edit-auditoria-win',
            buttons: this.buttons,
            items: this.items
        
        });

        //this.addEvents({add:true});
    }

    Ext.extend(EditAuditoriaWindow, Ext.Window, {


        show : function(){
            if(this.rendered){
                //this.feedUrl.setValue('');
            }

            //this.grid.store.setBaseParam( "idproject", this.idproject);
            //this.grid.store.load();

            EditAuditoriaWindow.superclass.show.apply(this, arguments);
        }



    });

</script>
