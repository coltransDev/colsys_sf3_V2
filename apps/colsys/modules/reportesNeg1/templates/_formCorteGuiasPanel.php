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
                    title: 'HAWB/HBL',
                    autoHeight:true,
                    
                    items: [                        
                        new WidgetTercero({fieldLabel:"Consignatario",
                                            tipo: 'Consignatario',
                                            width: 600,
                                            hiddenName: "consig",
                                            id:"idconsignatario"

                                           }),

                        new WidgetBodega({fieldLabel:"",
                                            id: "bodega_consignar",
                                            hiddenName: "idbodega_hd",
                                            width: 600,
                                            linkTransporte: "transporte",
                                            
                                           })
                       
                    ]
                },
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {
                    xtype:'fieldset',
                    title: 'MAWB',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        
                        new WidgetTercero({fieldLabel:"Consig. Master",
                                            tipo: 'Master',
                                            width: 600,
                                            id: "idconsigmaster",
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