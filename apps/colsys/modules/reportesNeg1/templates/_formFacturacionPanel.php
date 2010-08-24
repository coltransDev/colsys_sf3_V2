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
		var campos = new Array();

			this.wgContactoCliente1 = new WidgetContactoCliente({fieldLabel: 'Cliente ',
                                                   width: 600,
                                                   id: "cliente-impoexpo",
                                                   hiddenName: "idclientefac"
                                                  });
		this.wgContactoCliente1.addListener("select", this.onSelectContactoCliente, this);
		campos.push( this.wgContactoCliente1 );
		<?
		if($impoexpo== Constantes::EXPO)
		{
		?>
			this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Agente ',
                                                   width: 600,
                                                   id: "agente-impoexpo",
                                                   hiddenName: "idclienteag"
                                                  });
        
			this.wgContactoCliente2 = new WidgetContactoCliente({fieldLabel: 'Otro ',
                                                   width: 600,
                                                   id: "otro-aduana",
                                                   hiddenName: "idclienteotro"
                                                  });
			this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);
			this.wgContactoCliente2.addListener("select", this.onSelectContactoCliente, this);
			campos[0]= this.wgContactoCliente ;
			campos.push( this.wgContactoCliente1 );
			campos.push( this.wgContactoCliente2 );
		<?
		}
		?>
		
		

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
                    items: campos
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