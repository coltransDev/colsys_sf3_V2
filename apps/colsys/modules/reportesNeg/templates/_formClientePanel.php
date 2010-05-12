<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetContactoCliente");

?>
<script type="text/javascript">


    FormClientePanel = function( config ){

        Ext.apply(this, config);

        this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Cliente',
                                                   width: 600,
                                                   name: "cliente",
                                                   id: "cliente"
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);

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
                        this.wgContactoCliente,
                        {
                            xtype: "hidden",
                            id: "idconcliente",
                            id: "idconcliente"

                        },
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
                        new WidgetTercero({fieldLabel:"Proveedor",
                                            tipo: 'Proveedor',
                                            width: 600})
                    ]
                }
            ]



        });


    };

    Ext.extend(FormClientePanel, Ext.Panel, {
        onSelectContactoCliente: function( combo, record, index){ // override default onSelect to do redirect

            /*if(this.fireEvent('beforeselect', this, record, index) !== false){
                this.setValue(record.data[this.valueField || this.displayField]);
                this.collapse();
                this.fireEvent('select', this, record, index);
            }*/
            
            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );

            /*Ext.getCmp("usuario").setValue(record.get("vendedor"));
            Ext.getCmp("vendedor_id").setValue(record.get("nombre_ven"));*/
            <?
            /*if( $user->getIddepartamento()!=5 ){
            ?>
                //Ext.getCmp("vendedor_id").setRawValue(record.get("nombre_ven"));
                //Ext.getCmp("vendedor_id").hiddenField.value = record.get("vendedor");
            <?
            }*/
            ?>

            //Ext.getCmp("listaclinton").setValue(record.get("listaclinton"));
            //Ext.getCmp("status").setValue(record.get("status"));

            combo.alertaCliente(record);

        }

    });


</script>