<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");

include_component("widgets", "widgetContinuacion");
?>
<script type="text/javascript">


    FormTrayectoPanel = function( config ){

        Ext.apply(this, config);


        FormTrayectoPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'General',
            
            
            items: [{
                    xtype:'fieldset',                    
                    title: 'Información del trayecto',
                    autoHeight:true,
                    //defaults: {width: 210},

                    layout:'column',
                    columns: 2,
                    items :
                        [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetImpoexpo({fieldLabel: 'Clase',
                                                    id: 'impoexpo',
                                                    name: 'impoexpo'
                                                    }),
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                                    id: 'modalidad',
                                                    name: 'modalidad',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    }),
                                
                                new WidgetPais({fieldLabel: 'País Origen',
                                                id: 'tra_origen_id',
                                                linkCiudad: 'origen'
                                               }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                                  linkPais: 'tra_origen_id',
                                                  name: 'origen',
                                                  id: 'origen'
                                                }),
                                new WidgetAgente({fieldLabel: 'Agente',
                                                  linkImpoExpo: "impoexpo",
                                                  linkOrigen: "tra_origen_id",
                                                  linkDestino: "tra_destino_id",
                                                  linkListarTodos: "listar_todos",
                                                  name:"idagente"
                                                }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos"
                                }
                                
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                
                                new WidgetTransporte({fieldLabel: 'Transporte',
                                                      id: 'transporte'
                                                    }),
                                new WidgetLinea({fieldLabel: 'Linea',
                                                 linkTransporte: "transporte"
                                                }),
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id'
                                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  linkPais: 'tra_destino_id',
                                                  name: 'destino',
                                                  id: 'destino'
                                                })
                                
                            ]
                        }

                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Continuación de viaje',
                    autoHeight:true,
                    items: [

                        new WidgetContinuacion({fieldLabel: 'Continuación',
                                                    id: 'continuacion',
                                                    name: 'continuacion',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    }),
                        new WidgetCiudad({fieldLabel: 'Destino Final',
                                                  name: 'continuacion_dest',
                                                  id: 'continuacion_dest',
                                                  idtrafico: 'CO-057'
                                                }),
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Información de la Mercancia',
                    autoHeight:true,
                    layout:'form',
                    labelWidth: 200,
                    items: [
                        {
                            xtype: 'textarea',
                            fieldLabel: 'Descripción',
                            hideLabel: true,
                            name: 'ca_mercancia_desc',
                            width: 600,
                            grow: true

                        },
                        {                            
                            xtype: "checkbox",
                            fieldLabel: "¿Es mercancía peligrosa?",
                            id: "ca_mcia_peligrosa"
                        }
                    ]
                }
            ]
        });






    };

    Ext.extend(FormTrayectoPanel, Ext.Panel, {


    });


</script>