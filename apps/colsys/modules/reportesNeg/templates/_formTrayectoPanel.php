<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetCotizacion");

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

        this.widgetCotizacion = new WidgetCotizacion({
                                                      fieldLabel: "Cotización",
                                                      });
        this.widgetCotizacion.addListener("select", this.onSelectCotizacion, this );
        
        FormTrayectoPanel.superclass.constructor.call(this, {            
            title: 'General',            
            deferredRender:false,
            //layout:'form',
            autoHeight:true,
            
            items: [{
                        xtype:'fieldset',
                        title: 'General',
                        autoHeight:true,                       

                        layout:'form',
                        defaults: {width: 200},
                        items :
                        [
                            this.widgetCotizacion,
                            {
                                xtype: "datefield",
                                fieldLabel: "Fecha de Despacho",
                                id: "fchdespacho",
                                name: "fchdespacho"
                            },
                            {
                                xtype: "textfield",
                                fieldLabel: "Vendedor",
                                id: "vendedor",
                                name: "vendedor"
                            }
                        ]
                    },

                    {
                    xtype:'fieldset',                    
                    title: 'Información del trayecto',
                    autoHeight:true,
                   
                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',                        
                        border:false,
                        bodyStyle:'padding:4px'
                    },
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
        /*
         * Completa los datos del reporte con la cotización seleccionada.
         **/
        onSelectCotizacion: function( combo, record, index){
            alert("OK");
        }

    });


</script>