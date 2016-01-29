<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

include_component("widgets", "widgetAgente");

include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");

?>
<script type="text/javascript">
 /**
 * PanelTrayectoWindow object definition
 **/
PanelTrayectoWindow = function( config ) {

    Ext.apply(this, config);

    PanelTrayectoWindow.superclass.constructor.call(this, {
        title: 'Ingrese los datos del trayecto',
        //id: 'costos-aduana-win',
        autoHeight: true,        
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
            id: 'trayecto-form',
            //layout: 'form',
            frame: true,
            autoHeight: true,
            bodyStyle: 'padding: 5px 5px 0 5px;',
            labelWidth: 100,

            items: [{
                        id: 'idtrayecto',
                        xtype:'hidden',
                        name: 'idtrayecto',
                        value: '',
                        allowBlank:false
                    },
                     new WidgetImpoexpo({fieldLabel: 'Impo/Expo',
                                                    id: 'impoexpo',
                                                    name: 'impoexpo',
                                                    allowBlank: false
                                                    }),

                    new WidgetTransporte({fieldLabel: 'Transporte',
                                                      id: 'transporte',
                                                      allowBlank: false
                                                    }),
                    new WidgetModalidad({fieldLabel: 'Modalidad',
                                                    id: 'modalidad',
                                                    name: 'modalidad',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo",
                                                    allowBlank: false
                                                    }), 
                    new WidgetLinea({fieldLabel: 'Linea',
                                                 linkTransporte: "transporte",
                                                 impoexpo:"impoexpo",
                                                 activoImpo: true,
                                                 activoExpo: true,
                                                 name: 'linea',
                                                 id: 'idlinea',
                                                 hiddenName: 'idlinea',
                                                 allowBlank: false
                                                }),
                    new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                                  id: 'origen',
                                                  name: 'origen',
                                                  hiddenName: 'idorigen',                                                  
                                                  allowBlank: false
                                                }),
                    new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  id: 'destino',
                                                  name: 'destino',
                                                  hiddenName: 'iddestino',
                                                  allowBlank: false
                                                }),

                    new WidgetAgente({fieldLabel: 'Agente',
                                                  linkImpoExpo: "impoexpo",
                                                  linkOrigen: "origen",
                                                  linkDestino: "destino",
                                                  linkListarTodos: "listar_todos",
                                                  name:"agente",
                                                  id: 'idagente',
                                                  hiddenName: 'idagente',
                                                  allowBlank: true,
                                                  width: 350
                                                }),
                   
                    {
                        xtype: 'checkbox',
                        width: 100,
                        fieldLabel: 'Listar Todos',
                        id: 'listar_todos',
                        value: '',
                        checked: false,
                        allowBlank:false
                    }
                    ,{
                        xtype: 'textarea',
                        width: 310,
                        height: 40,
                        fieldLabel: 'Observaciones',
                        name: 'observaciones',
                        id: 'observaciones',
                        value: '',
                        allowBlank:true
                    }
                    ,{
                        xtype: 'textfield',
                        width: 100,
                        fieldLabel: 'Frecuencia',
                        name: 'frecuencia',
                        id: 'frecuencia',
                        value: '',
                        allowBlank:true
                    }
                    ,{
                        xtype: 'textfield',
                        width: 100,
                        fieldLabel: 'T/Transito',
                        name: 'ttransito',
                        id: 'ttransito',
                        value: '',
                        allowBlank:true
                    },{
                        xtype: 'textfield',
                        width: 100,
                        fieldLabel: 'No. Contrato',
                        name: 'ncontrato',
                        id: 'ncontrato',
                        value: '',
                        allowBlank:true
                    },
                    {
                        xtype: 'checkbox',
                        width: 100,
                        fieldLabel: 'Activo',
                        name: 'activo',
                        value: '',
                        checked: true,
                        allowBlank:false
                    }

                ]
        })

    });

    this.addEvents({add:true});
}

Ext.extend(PanelTrayectoWindow, Ext.Window, {


    show : function(){
        if(this.rendered){

        }

        PanelTrayectoWindow.superclass.show.apply(this, arguments);
    },

    guardar: function() {


        var fp = Ext.getCmp("trayecto-form");
        if( fp.getForm().isValid() ){

            ttransito = fp.getForm().findField("ttransito").getValue();
            frecuencia = fp.getForm().findField("frecuencia").getValue();
            impoexpo = fp.getForm().findField("impoexpo").getValue();
            transporte = fp.getForm().findField("transporte").getValue();


            
            var node = this.node;
            if( ttransito=="" && frecuencia=="" && ((impoexpo=="<?=Constantes::IMPO?>" && (transporte!="<?=Constantes::AEREO?>"|| transporte!="<?=Constantes::OTMDTA?>")) || impoexpo=="<?=Constantes::EXPO?>" ) ){ // Solamente cuando es importación aérea se permite en blanco
                Ext.MessageBox.alert('Trayectos - Error:', 'Por favor indique el tiempo de transito y la frecuencia');
            }else{
                fp.getForm().findField("impoexpo").enable();
                fp.getForm().findField("transporte").enable();
                fp.getForm().findField("modalidad").enable();
                fp.getForm().findField("origen").enable();
                fp.getForm().findField("destino").enable();
                fp.getForm().findField("idlinea").enable();
                var win = this;
                fp.getForm().submit({url:'<?=url_for('pricing/panelTrayectoGuardar')?>',
                    waitMsg:'Salvando Datos de Productos...',
                    // standardSubmit: false,

                    success:function(form,action){
                        //Ext.Msg.alert( "","Se ha guardado correctamente, es necesario actualizar la pagina para ver los cambios." );
                        win.close();
                        if( node ){
                            node.reload();
                        }


                    },
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error: "+action.result.errorInfo+" \n Codigo HTTP "+action.response.status);
                    }//end failure block
               });
            }

        }else{
            Ext.MessageBox.alert('Trayectos - Error:', '¡Atención: La información no es válida o está incompleta!');
        }
    }


});

</script>