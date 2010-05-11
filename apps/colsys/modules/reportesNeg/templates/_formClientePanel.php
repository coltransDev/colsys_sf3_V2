<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetCliente");
include_component("widgets", "widgetTercero");
?>
<script type="text/javascript">


    FormClientePanel = function( config ){

        Ext.apply(this, config);


        FormClientePanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Cliente',
            buttonAlign: 'center',

            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {

                    xtype:'fieldset',
                    title: 'Información del Cliente',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        new WidgetCliente({fieldLabel: 'Cliente', width: 600}),
                        {
                            xtype: "textfield",
                            fieldLabel: "Contacto",
                            name: "contacto",
                            id: "contacto",
                            readOnly: true,
                            width: 600
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Orden Cliente",
                            name: "orden_clie",
                            id: "orden_clie",
                            width: 300
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Lib. Automatica",
                            name: "ca_liberacion",
                            id: "ca_liberacion",
                            readOnly: true,
                            width: 100
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Tiempo de Crédito",
                            name: "ca_tiempocredito",
                            id: "ca_tiempocredito",
                            readOnly: true,
                            width: 100
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Contrato de Comodato",
                            name: "ca_comodato",
                            id: "ca_comodato",
                            readOnly: true,
                            width: 100
                        }
                    ]
                },
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {
                    xtype:'fieldset',
                    title: 'Información del Proveedor',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        new WidgetTercero({fieldLabel:"Proveedor", width: 550})
                    ]
                }
            ]



        });






    };

    Ext.extend(FormClientePanel, Ext.Panel, {


    });


</script>