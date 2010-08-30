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
                                                   id: "cliente",
                                                   hiddenName: "idcliente",
                                                   allowBlank:false
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);

        FormClientePanel.superclass.constructor.call(this, {
            activeTab: 0,
            title: 'Cliente',
            buttonAlign: 'center',
            autoHeight:true,
//            deferredRender:false,
            items: [
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
                            name: "idconcliente"

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
                        }
                        <?
                        if($modo==Constantes::MARITIMO)
                        {
                        ?>
                        ,
                        {
                        xtype: "textfield",
                        fieldLabel: "Contrato de Comodato",
                        name: "ca_comodato",
                        id: "ca_comodato",
                        readOnly: true,
                        width: 100
                        }
                        <?
                        }
                        ?>
                    ]
                }
				<?
				if($impoexpo ==Constantes::IMPO)
				{
				?>
				,
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
                                            width: 600,
                                            name: "idproveedor",
                                            hiddenName: "prov",
                                            id:"proveedor",
                                            name:"proveedor"
                                           })
                    ]
                }
				<?
				}
				?>
            ]



        });


    };

    Ext.extend(FormClientePanel, Ext.Panel, {
        onSelectContactoCliente: function( combo, record, index){ // override default onSelect to do redirect
                       
            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );


            var confirmar =  record.get("confirmar") ;
			var brokenconfirmar="";
			if(confirmar)
			{
				brokenconfirmar=confirmar.split(",");
				var i=0;
				for(i=0; i<brokenconfirmar.length; i++){
					Ext.getCmp("contacto_"+i).setValue(brokenconfirmar[i]);
					Ext.getCmp("contacto_"+i).setReadOnly( true );
					Ext.getCmp("chkcontacto_"+i).setValue( true );
				}
			}
			for( i=brokenconfirmar.length; i<20; i++ ){
				if( Ext.getCmp("contacto_"+i) ){
					Ext.getCmp("contacto_"+i).setValue("");
					Ext.getCmp("contacto_"+i).setReadOnly( false );
					Ext.getCmp("chkcontacto_"+i).setValue( false );
				}
			}
			
            diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);
            cupo=(record.get("cupo")!="")?"Sí":"No";
            //alert(cupo);
            Ext.getCmp("ca_liberacion").setValue(cupo);

			Ext.getCmp("preferencias").setValue(record.get("preferencias"));

            /*
             * <?
                                if($nivel>=2){
                                ?>
                                    document.getElementById("reporte_ca_login").value=record.data.vendedor;
                                <?
                                }else{
                                ?>
                                    document.getElementById("comercial").innerHTML=record.data.vendedor;
                                <?
                                }
                                ?>
                                document.getElementById("ca_idconcliente").value = record.get("idcontacto");
                                document.getElementById("div_contacto").innerHTML = record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") ;
                                if( record.get("diascredito") ){
                                    document.getElementById("div_diascredito").innerHTML = record.get("diascredito")+" D&iacute;as";
                                }else{
                                    document.getElementById("div_diascredito").innerHTML = "";
                                }

                                if( record.get("cupo")!=0 || record.get("diascredito")!=0 ){
                                    document.getElementById("div_libautomatica").innerHTML = "S&iacute;";
                                }else{
                                    document.getElementById("div_libautomatica").innerHTML = "No";
                                }

                                document.getElementById("reporte_ca_preferencias_clie").value=record.data.preferencias;

                                for(i=0; i< <?=ReporteForm::NUM_CC?>; i++){
                                    document.getElementById("reporte_contactos_"+i).value="";
                                    document.getElementById("reporte_confirmar_"+i).checked=false;
                                    document.getElementById("reporte_contactos_"+i).readOnly=false;
                                }




                                document.getElementById("rep_aduana_ca_coordinador").value=record.data.coordinador;

                                if( record.data.ca_listaclinton=="Sí" ){
                                    alert("Este cliente se encuentra en lista Clinton");
                                }
             */

            combo.alertaCliente(record);

        }

    });


</script>