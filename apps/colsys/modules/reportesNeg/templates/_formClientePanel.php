    <?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/    
include_component("widgets", "widgetContactoCliente");
//echo $nprov;
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
                    title: 'Informaci�n del Cliente',
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
                            fieldLabel: "Tiempo de Cr�dito",
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
                 *========================= Informaci�n del Proveedor =========================
                 **/
                {
                    xtype:'fieldset',
                    title: 'Informaci�n del Proveedor',
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
var ij=parseInt(<?=($nprov>1)?($nprov-1):1?>);

    Ext.extend(FormClientePanel, Ext.Panel, {
        onSelectContactoCliente: function( combo, record, index){ // override default onSelect to do redirect
            store=combo.store;
            j=0;
            store.each( function( r ){
                if(r.data.compania==record.get("compania") && r.data.fijo && r.data.email!="")
                {
                    if( Ext.getCmp("contacto_fijos"+j) ){
                        Ext.getCmp("contacto_fijos"+j).setValue(r.data.email);
                        Ext.getCmp("contacto_fijos"+j).setReadOnly( false );
                        Ext.getCmp("chkcontacto_fijos"+j).setValue( true );
                        j++;
                    }
                }
            });
            //alert(combo.store.data[0].fijo)

            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );


            var confirmar =  record.get("confirmar") ;
			var brokenconfirmar="";
			if(confirmar)
			{
				brokenconfirmar=confirmar.split(",");
				var i=0;
                var j=0;
				for(i=0; i<brokenconfirmar.length; i++){
                    if(brokenconfirmar[i])
                    {
                        Ext.getCmp("contacto_"+j).setValue(brokenconfirmar[i]);
                        Ext.getCmp("contacto_"+j).setReadOnly( true );
                        Ext.getCmp("chkcontacto_"+j).setValue( true );
                        j++;
                    }
					
				}
			}
            
			for( i=j; i<20; i++ ){
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
/*            diascredito=(record.get("diascredito"))?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);

            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"S�":"No";
            else
                cupo="No";
            
            Ext.getCmp("ca_liberacion").setValue(cupo);
*/
            diascredito=0;
            if(record.data.diascredito && record.data.diascredito!="null")
                diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";

            Ext.getCmp("ca_tiempocredito").setValue(diascredito);

            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"S�":"No";
            else
                cupo="No";
            //alert(cupo);
            Ext.getCmp("ca_liberacion").setValue(cupo);


			Ext.getCmp("preferencias").setValue(record.get("preferencias"));
            Ext.getCmp("vendedor").onTrigger1Click();
            Ext.getCmp("vendedor").setValue(record.data.vendedor);
            $("#vendedor").val(record.data.nombre_ven);

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
                                            name: "idproveedor"+ij,
                                            hiddenName: "prov"+ij,
                                            id:"proveedor"+ij
                                           }),
                                new WidgetIncoterms({
                                      id: 'terminos'+ij,
                                      hiddenName:"incoterms"+ij,
                                      width:180
                                    }),
                                 {
                                    xtype: "textfield",
                                    name: "orden_pro"+ij,
                                    id: "orden_pro"+ij,
                                    width:150
                                }

                            ]
                        });
            tb.render('panel-proveedor');  // toolbar is rendered
            ij++;
        }
    });
</script>