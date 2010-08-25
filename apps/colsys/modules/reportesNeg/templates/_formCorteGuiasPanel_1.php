<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetConsignar");
include_component("widgets", "widgetTipoBodega");
include_component("widgets", "widgetBodega");

?>
<script type="text/javascript">


    FormCorteGuiasPanel = function( config ){

        Ext.apply(this, config);

        


        FormCorteGuiasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Corte Guias',
            buttonAlign: 'center',
            autoHeight:true,
            deferredRender:false,
            defaults: {labelWidth: 120},
            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {

                    xtype:'fieldset',
                    title: 'Instrucciones',
                    autoHeight:true,
                    
                    items: [                        
                        new WidgetConsignar({fieldLabel:"Consignar a",
                                            hiddenName: "consignar",
                                            width: 600,
                                            linkTransporte: "transporte",
                                            id:"consignarmaster"
                                            
                                           }),
                        new WidgetTipoBodega({fieldLabel:"Transladar a",                                            
                                            id: "tipobodega",
                                            hiddenName: "tipobodega_hd",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           }),
                        new WidgetBodega({fieldLabel:"",
                                            id: "bodega_consignar",
                                            hiddenName: "idbodega_hd",
                                            width: 600,
                                            linkTransporte: "transporte",
                                            linkTipo: "tipobodega"
                                           })
                       
                    ]
                },
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {
                    xtype:'fieldset',
                    title: 'Otros Datos',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        new WidgetTercero({fieldLabel:"Consignatario",
                                            tipo: 'Consignatario',
                                            width: 600,                                            
                                            hiddenName: "consig",
                                            id:"idconsignatario"

                                           }),
                        new WidgetTercero({fieldLabel:"Consig. Master",
                                            tipo: 'Master',
                                            width: 600,
                                            id: "idconsigmaster",
                                            hiddenName: "consigmaster"
                                           }),
                        new WidgetTercero({fieldLabel:"Notify",
                                            tipo: 'Notify',
                                            width: 600,
                                            id: "idnotify",
                                            hiddenName: "notify"
                                           }),
                        new WidgetTercero({fieldLabel:"Representante",
                                            tipo: 'Representante',
                                            width: 600,
                                            id: "idrepresentante",
                                            hiddenName: "idrepres"
                                           })
                    ]
                }
            ]



        });


    };

    Ext.extend(FormCorteGuiasPanel, Ext.Panel, {
       

    });


</script>