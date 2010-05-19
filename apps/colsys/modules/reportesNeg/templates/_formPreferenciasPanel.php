<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/


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
                    layout:'column',
                    columns: 2,
                    
                    items: [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            labelWidth: 5,
                            items: [
                            //defaults: {width: 210},

                                <?
                                for( $i=0; $i<14; $i++ ):
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
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            labelWidth: 5,
                            items: [
                            //defaults: {width: 210},

                                <?
                                for( $i=0; $i<14; $i++ ):
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "",
                                    name: "chkcontacto_<?=$i?>",
                                    id: "chkcontacto_<?=$i?>"                                   
                                   
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