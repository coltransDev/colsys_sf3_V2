    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
include_component("widgets", "widgetCliente");
?>
<script type="text/javascript">
    FormFacturacionPanel = function( config ){

        Ext.apply(this, config);
		var campos = new Array();

			this.wgCliente1 = new WidgetCliente({fieldLabel: 'Cliente ',
                                                   width: 500,
                                                   id: "cliente-impoexpo",
                                                   hiddenName: "idclientefac"
                                                  });
		this.wgCliente1.addListener("select", this.onSelectCliente, this);
		campos.push( this.wgCliente1 );
		<?
		if($impoexpo== Constantes::EXPO)
		{
		?>
			this.wgCliente = new WidgetCliente({fieldLabel: 'Agente ',
                                                   width: 500,
                                                   id: "agente-impoexpo",
                                                   hiddenName: "idclienteag",
                                                   tipo:"Agente"
                                                  });
        
			this.wgCliente2 = new WidgetCliente({fieldLabel: 'Otro ',
                                                   width: 500,
                                                   id: "otro-aduana",
                                                   hiddenName: "idclienteotro"
                                                  });
			this.wgCliente.addListener("select", this.onSelectCliente, this);
			this.wgCliente2.addListener("select", this.onSelectCliente, this);
			campos[0]= this.wgCliente ;
			campos.push( this.wgCliente1 );
			campos.push( this.wgCliente2 );
		<?
		}
		?>
		
		

        FormFacturacionPanel.superclass.constructor.call(this, {
			labelWidth: 120,
            activeTab: 0,
            title: 'Facturaci&oacute;n',
            buttonAlign: 'center',
            autoHeight:true,
            items: [
                
                {

                    xtype:'fieldset',
                    title: 'Informaci&oacute;n del Facturaci&oacute;n',
                    autoHeight:true,                    
                    items: campos
                }

            ]



        });


    };

    Ext.extend(FormFacturacionPanel, Ext.Panel, {
		onSelectCliente: function( combo, record, index){
            combo.alertaCliente(record);
        }
    });


</script>