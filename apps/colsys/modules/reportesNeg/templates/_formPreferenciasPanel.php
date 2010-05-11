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


    FormPreferenciasPanel = function( config ){

        Ext.apply(this, config);


        FormPreferenciasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Preferencias',
            buttonAlign: 'center',

            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {

                    xtype:'fieldset',
                    title: 'Preferencias',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [                        
                        {
                            xtype: "textarea",
                            fieldLabel: "Preferencias del cliente",
                            name: "preferencias",
                            id: "preferencias",                            
                            width: 600,
                            grow: true
                        },
                        {
                            xtype: "textarea",
                            fieldLabel: "Instrucciones especiales",
                            name: "instrucciones",
                            id: "instrucciones",
                            width: 600,
                            grow: true
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Informaciones a:',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [                        
                        {
                            xtype: "textfield",
                            fieldLabel: "Contacto",
                            name: "contacto",
                            id: "contacto1",
                            readOnly: true,
                            width: 600
                        }                        
                    ]
                }
            ]
        });
    };

    Ext.extend(FormPreferenciasPanel, Ext.Panel, {


    });


</script>