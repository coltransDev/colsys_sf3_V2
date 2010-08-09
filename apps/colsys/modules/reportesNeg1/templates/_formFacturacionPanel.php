    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetContactoCliente");

?>
<script type="text/javascript">


    FormFacturacionPanel = function( config ){

        Ext.apply(this, config);

        this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Cliente <?=$impoexpo?>',
                                                   width: 600,
                                                   id: "cliente-impoexpo",
                                                   hiddenName: "idcliente-impoexpo"
                                                  });
        this.wgContactoCliente1 = new WidgetContactoCliente({fieldLabel: 'Cliente Aduana',
                                                   width: 600,
                                                   id: "cliente-aduana",
                                                   hiddenName: "idcliente-aduana"
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);

        FormFacturacionPanel.superclass.constructor.call(this, {
			labelWidth: 120,
            activeTab: 0,
            title: 'Facturaci&oacute;n',
            buttonAlign: 'center',
            autoHeight:true,
//            deferredRender:false,
            items: [
                /*
                 *========================= Información del Proveedor =========================
                 **/
                {

                    xtype:'fieldset',
                    title: 'Informaci&oacute;n del Facturaci&oacute;n',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [                        
                        this.wgContactoCliente,
						this.wgContactoCliente1
                    ]
                }

            ]



        });


    };

    Ext.extend(FormFacturacionPanel, Ext.Panel, {

		onSelectContactoCliente: function( combo, record, index){

            combo.alertaCliente(record);

        }

    });


</script>