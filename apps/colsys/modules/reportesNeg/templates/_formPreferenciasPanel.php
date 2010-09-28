<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("reportesNeg", "gridPanelInstruccionesWindow",array("modo"=>$modo));

?>
<script type="text/javascript">
    FormPreferenciasPanel = function( config ){
        Ext.apply(this, config);

        FormPreferenciasPanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Preferencias',
            buttonAlign: 'center',
            autoHeight:true,
            
            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {

                    xtype:'fieldset',
                    title: 'Preferencias',
                    autoHeight:true,
					labelWidth: 120,
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
                            fieldLabel: "Instrucciones especiales (Agente)",
                            name: "instrucciones",
                            id: "instrucciones",
                            width: 600,
                            grow: true
                        },
                        {
                            xtype: "button",
                            text: "Agregar",
                            id: "bagregar",
                            handler:function()
                            {
                                win = new gridWindow();
                                win.show();
                            }
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: '',
                    autoHeight:true,
                    items: [
                         new WidgetTercero({fieldLabel:"Representante",
                                            tipo: 'Representante',
                                            width: 600,
                                            id: "idrepresentante",
                                            hiddenName: "idrepres"
                                           })
                         ,
                        {
                            xtype       :   'checkbox',
                            fieldLabel  :   'Notificar',
                            id          :   'ca_informar_repr',
                            name        :   'ca_informar_repr'
                        }
                        ]
                },
                {
                    xtype:'fieldset',
                    title: 'Informaciones a:',
                    autoHeight:true,
                    items: [
                    <?
                    for( $i=0; $i<20; $i++ )
                    {
                        if( $i!=0){
                            echo ",";
                        }
                    ?>
                    {
                       border:false,
                        title: '',
                        autoHeight:true,
                        layout:'column',
                        columns: 2,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                           /* bodyStyle:'padding:4px',*/
                            hideLabels:true,
                            border:true
                        },
                        items: [
                            {
                                defaultType: 'textfield',
                                items: [
                                    {
                                        xtype: "textfield",
                                        fieldLabel: "",
                                        name: "contacto_<?=$i?>",
                                        id: "contacto_<?=$i?>",
                                        readOnly: true,
                                        width: 550,
                                        height :20
                                    }

                                ]
                            },
                            {
                                defaults: {width: 20},
                                items: [
                                    {
                                        xtype: "checkbox",
                                        fieldLabel: "",
                                        name: "chkcontacto_<?=$i?>",
                                        id: "chkcontacto_<?=$i?>",
                                        width: 20,
                                        height :20
                                    }

                                ]
                            }
                        ]
                    }
                    <?
                    }
                    ?>
                    ]

                }
            ]
        });
    };

    Ext.extend(FormPreferenciasPanel, Ext.Panel, {

    });
</script>