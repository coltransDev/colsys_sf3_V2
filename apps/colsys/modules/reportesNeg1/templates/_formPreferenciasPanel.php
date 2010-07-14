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
            deferredRender:false,            
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
                    layout:'table',
                    columns: 2,
                    
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px',
                        hideLabels:true,
                        border:true
                    },
                    items: [                        
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            //columnWidth:0.2,
                            layout: 'form',                            
                            defaultType: 'textfield',                            
                            items: [
                            //defaults: {width: 210},

                                <?
                                for( $i=0; $i<15; $i++ ):
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                    xtype: "textfield",
                                    fieldLabel: "",
                                    name: "contacto_<?=$i?>",
                                    id: "contacto_<?=$i?>",
                                    readOnly: true,
                                    width: 550
                                }
                                <?
                                endfor;
                                ?>
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            //columnWidth:0.2,
                            layout: 'form',                            
                            defaultType: 'textfield',
                            defaults: {width: 20},
                            items: [


                                <?
                                for( $i=0; $i<15; $i++ ):
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "",                                    
                                    name: "chkcontacto_<?=$i?>",
                                    id: "chkcontacto_<?=$i?>",
                                    width: 20
                                   
                                }
                                <?
                                endfor;
                                ?>
                            ]
                        }
                    ]
                }
            ]
        });
    };

    Ext.extend(FormPreferenciasPanel, Ext.Panel, {


    });


</script>