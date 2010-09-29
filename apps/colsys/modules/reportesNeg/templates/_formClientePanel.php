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
                                                   width: 500,
                                                   id: "cliente",
                                                   hiddenName: "idcliente",
                                                   allowBlank:false,                                                   
                                                   displayField:"compania"
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
                            width: 500
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
                        if($modo==Constantes::MARITIMO && $impoexpo!=constantes::TRIANGULACION)
                        {
                        ?>
                        ,
                        {
                            xtype       :   'checkbox',
                            fieldLabel  :   'Contrato de Comodato',
                            id          :   'ca_comodato',
                            name        :   'ca_comodato'
                        }

                        <?
                        }
                        ?>
                    ]
                }
				<?
				if($impoexpo != Constantes::EXPO)
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
                    id:'panel-proveedor',
                    //defaults: {width: 210},
                    items: [
                        {
                           xtype:'button',
                           text: "Agregar",
                           handler:this.agregarProv
                        },
                        {
                            xtype:'fieldset',
                            border:false,
                            layout:'column',

                            items: [
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Proveedor ",
                                    items: [
                                        new WidgetTercero({
                                            tipo: 'Proveedor',
                                            width: 300,
                                            name: "idproveedor0",
                                            hiddenName: "prov0",
                                            id:"proveedor0"
                                           })
                                    ]
                                },
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Incoterms ",
                                    items: [
                                       new WidgetIncoterms(
                                               {
                                                  id: 'terminos0',
                                                  hiddenName:"incoterms0",
												  width:180
                                                })
                                    ]
                                },
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Orden",
                                    items: [
                                        {
                                            xtype: "textfield",
                                            name: "orden_pro0",
                                            id: "orden_pro0",
                                            width:150
                                        }
                                    ]
                                }
                            ]
                        }
                        <?
                        if($nprov>1)
                        {
                            for($i=1;$i<$nprov;$i++)
                            {
                        ?>
                                ,{
                                    xtype:'fieldset',
                                    border:false,
                                    layout:'column',
                                    items: [
                                        new WidgetTercero({
                                                    tipo: 'Proveedor',
                                                    width: 300,
                                                    hiddenName: "prov<?=$i?>",
                                                    id:"proveedor<?=$i?>"
                                                   }),
                                            new WidgetIncoterms({
                                              id: 'terminos<?=$i?>',
                                              hiddenName:"incoterms<?=$i?>",
                                              width:180
                                            }),
                                             {
                                                xtype: "textfield",
                                                name: "orden_pro<?=$i?>",
                                                id: "orden_pro<?=$i?>",
                                                width:150
                                            }
                                    ]
                                }
                        <?
                            }
                        }
                        ?>
                        
                    ]
                }
				<?
				}
				?>
            ]
        });
    };
var i=<?=($nprov>0)?($nprov-1):"1"?>;
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

/*            diascredito=0;
            if(record.data.diascredito && record.data.diascredito!="null")
                diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);
  */
            diascredito=(record.get("diascredito"))?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);

            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"Sí":"No";
            else
                cupo="No";
            
            Ext.getCmp("ca_liberacion").setValue(cupo);

			Ext.getCmp("preferencias").setValue(record.get("preferencias"));
   
            combo.alertaCliente(record);

        },
        agregarProv:function()
        {
           tb=new Ext.Panel( {
                            border:false,
                            xtype:'fieldset',
                            layout:'column',
                            bodyCssClass:'x-fieldset',
                            items: [
                                new WidgetTercero({
                                            tipo: 'Proveedor',
                                            width: 300,
                                            name: "idproveedor"+(++i),
                                            hiddenName: "prov"+i,
                                            id:"proveedor"+i
                                           }),
                                new WidgetIncoterms({
                                      id: 'terminos'+i,
                                      hiddenName:"incoterms"+i,
                                      width:180
                                    }),
                                 {
                                    xtype: "textfield",
                                    name: "orden_pro"+i,
                                    id: "orden_pro"+i,
                                    width:150
                                }

                            ]
                        });
            tb.render('panel-proveedor');  // toolbar is rendered
        }
    });
</script>