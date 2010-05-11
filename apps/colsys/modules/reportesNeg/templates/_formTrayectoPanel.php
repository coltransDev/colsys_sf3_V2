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
                                                    id: 'impoexpo'
                                                    }),
                                new WidgetTransporte({fieldLabel: 'Transporte'}),
                                new WidgetPais({fieldLabel: 'País Origen',
                                                id: 'tra_origen_id'
                                               }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen'}),
                                new WidgetAgente({fieldLabel: 'Agente',
                                                  linkImpoExpo: "impoexpo",
                                                  linkOrigen: "tra_origen_id",
                                                  linkDestino: "tra_destino_id",
                                                  linkListarTodos: "listar_todos",
                                                  name:"idagente",

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
                                new WidgetModalidad({fieldLabel: 'Modalidad'}),
                                new WidgetLinea({fieldLabel: 'Linea'}),                                
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id'
                                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino'})
                                
                            ]
                        }

                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Continuación de viaje',
                    autoHeight:true
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