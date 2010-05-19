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
                                            name: "idconsignar",
                                            hiddenName: "consignar",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           }),
                        new WidgetTipoBodega({fieldLabel:"Transladar a",
                                            name: "tipobodega",
                                            id: "tipobodega",
                                            hiddenName: "tipobodega_hd",
                                            width: 600,
                                            linkTransporte: "transporte"
                                           }),
                        new WidgetBodega({fieldLabel:"",
                                            name: "idbodega",
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
                                            name: "idconsignatario",
                                            hiddenName: "consig"
                                           }),
                        new WidgetTercero({fieldLabel:"Consig. Master",
                                            tipo: 'Master',
                                            width: 600,
                                            name: "idmaster",
                                            hiddenName: "consigmaster"
                                           }),
                        new WidgetTercero({fieldLabel:"Notify",
                                            tipo: 'Notify',
                                            width: 600,
                                            name: "idnotify",
                                            hiddenName: "notify"
                                           }),
                        new WidgetTercero({fieldLabel:"Representante",
                                            tipo: 'Representante',
                                            width: 600,
                                            name: "idmaster",
                                            hiddenName: "consigmaster"
                                           })
                    ]
                }
            ]



        });


    };

    Ext.extend(FormCorteGuiasPanel, Ext.Panel, {
       

    });


</script>