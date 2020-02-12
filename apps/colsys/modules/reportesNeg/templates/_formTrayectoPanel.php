<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetCotizacion");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursalAgente");
include_component("widgets", "widgetIncoterms");
include_component("reportesNegPlug", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"tipo"=>$tipo));
if($impoexpo!= Constantes::TRIANGULACION )
{
	include_component("reportesNeg", "formContinuacionPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
}

if($impoexpo==Constantes::OTMDTA)
{
    include_component("widgets", "widgetHbls");
}

include_component("widgets", "widgetComerciales");
include_component("widgets", "widgetTicket");
            
?>
<script type="text/javascript">
    FormTrayectoPanel = function( config ){
        Ext.apply(this, config);
        this.widgetCotizacion = new WidgetCotizacion({
                                              fieldLabel: "Cotización",
                                              id:"cotizacion",
                                              hiddenName: "idcotizacion",
                                              modo:"<?=$modo?>",
                                              impoexpo:"<?=$impoexpo?>",
                                              valueField:"consecutivo"
                                              });
        this.widgetCotizacion.addListener("select", this.onSelectCotizacion, this );
        
        this.widgetTicket = new WidgetTicket({
                                    fieldLabel: "Tarifa pactada",
                                    id:"idticket",
                                    hiddenName: "idticket",
                                    iddepartament: 11,                                            
                                    valueField:"idticket"
                            });
        
        <?
        if($tipo=="4")
        {
        ?>
            this.widgetReferencia = new WidgetHbls({
                                              fieldLabel: "Referencia",
                                              id:"referencia",
                                              hiddenName: "ca_referencia"
                                              });
            this.widgetReferencia.addListener("select", this.onSelectHbls, this );
                
            this.widgetHbls = new WidgetHbls({
                                              fieldLabel: "Hbl",
                                              id:"hbls",
                                              hiddenName: "idhbl"
                                              });
            this.widgetHbls.addListener("select", this.onSelectHbls, this );
        <?
        }
        ?>
        

		this.wgModalidad=new WidgetModalidad({fieldLabel: 'Tipo Envio',
                                        id: 'modalidad',
                                        hiddenName: "idmodalidad",
                                        linkTransporte: "transporte",
                                        linkImpoexpo: "impoexpo"
                                        });
        <?
		if($impoexpo == Constantes::EXPO || ($impoexpo== Constantes::IMPO && $modo== Constantes::AEREO) || ($impoexpo== Constantes::TRIANGULACION ))
		{
		?>
		this.wgModalidad.addListener("select", this.onSelectModalidad, this );
		<?
		}
		?>
        FormTrayectoPanel.superclass.constructor.call(this, {
			labelWidth: 100,
            title: 'General',
            deferredRender:false,
            id:"form-trayecto-panel",
            
            autoHeight:true,
            
            items: [{
                        xtype:'fieldset',
                        title: 'General',
                        autoHeight:true,

                        layout:'form',
                        defaults: {width: 200},
                        items :
                        [
                            {
                                xtype: "hidden",
                                id: "idproducto",
                                name: "idproducto"
                            }
                            ,
                            this.widgetCotizacion,
                            <?
                            if($modo== Constantes::MARITIMO || $modo == Constantes::AEREO){
                                ?>
                                this.widgetTicket,
                                <?
                            }
                            if ($tipo == "4") {
                                ?>
                                this.widgetReferencia,
                                this.widgetHbls,
                                {
                                    xtype: "datefield",
                                    fieldLabel: "Fecha de Arribo",
                                    id: "fcharribo",
                                    name: "fcharribo",
                                    format: 'Y-m-d'
                                },
                                {
                                    xtype:"textfield",
                                    fieldLabel:"Manifiesto",
                                    name:"manifiesto",
                                    id:"manifiesto",
                                    width:300
                                },
                                new WidgetCiudad({fieldLabel: 'Puerto Origen',
                                                          id: 'porigen',
                                                          idciudad:"porigen",
                                                          hiddenName:"pidorigen",
                                                          tipo:"2",
                                                          impoexpo:"impoexpo"
                                                        }),
                                <?
                            }
                            else
                            {
                            ?>
                            {
                                xtype: "datefield",
                                fieldLabel: "Fecha de Despacho",
                                id: "fchdespacho",
                                name: "fchdespacho",
                                format: 'Y-m-d'
                            },
                            
                            <?
                            }
                            ?>
                            new WidgetComerciales({fieldLabel: 'Vendedor',
                                                    id: 'vendedor',
                                                    name: 'vendedor',
                                                    hiddenName: "idvendedor",
                                                     readOnly: <?=($permiso<2)?"true":"false"?>
                                                    })
                        ]
                    },
                    {
                        xtype:'fieldset',
                        title: 'Información del trayecto',
                        autoHeight : true,
                        layout : 'column',
                        columns : 2,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                            bodyStyle:'padding:4px'
                        },
                        items :
                        [
                            {
                                columnWidth:.4,                                
                                border:false,                                
                                items:
                                [
                                    {
                                        xtype:"hidden",
                                        id: 'impoexpo',
                                        name: 'impoexpo',
                                        value:'<?=$impoexpo?>'
                                    },
                                    this.wgModalidad,                                   
                                    new WidgetCiudad({fieldLabel: '<?=$origen?>',                                                      
                                                      id: 'origen',
                                                      idciudad:"origen",
                                                      hiddenName:"idorigen",
                                                      tipo:<?=($impoexpo==constantes::OTMDTA)?"3":"1"?>,
                                                      impoexpo:"impoexpo"
                                                    })
                                ]
                            },                       
                            {
                                columnWidth : .6,
                                layout : 'form',
                                border : false,
                                items:
                                [
                                    {
                                        xtype:"hidden",
                                        id: 'transporte',
                                        name: 'transporte',
                                        value:'<?=$modo?>'
                                    },
                                    new WidgetLinea({fieldLabel: '<?=$nomLinea?>',
                                                     linkTransporte: "transporte",
                                                     impoexpo:"impoexpo",
                                                     activoImpo: true,
                                                     activoExpo: true,
                                                     id:"linea",
                                                     hiddenName: "idlinea",
                                                     width:300
                                                    }),
                                    new WidgetCiudad({fieldLabel: '<?=$destino?>',
                                                      id: 'destino',
                                                      idciudad:"destino",
                                                      hiddenName:"iddestino",
                                                      tipo:<?=($impoexpo==constantes::OTMDTA)?"3":"2"?>,
                                                      impoexpo:"impoexpo"
                                                    })
    <?
                                    if($impoexpo==constantes::EXPO)
                                    {
    ?>
                                        ,new WidgetIncoterms({title: 'Terminos',
                                                      fieldLabel:"Terminos",
                                                      id: 'terminos0',
                                                      hiddenName:"incoterms0",
                                                      width:250
                                                    })
    <?
                                    }
    ?>
                                ]
                            },
                            {
                                columnWidth : 1,
                                layout : 'form',
                                border : false,
                                items:
                                [
                                    new WidgetAgente({fieldLabel: 'Agente',
                                                      linkImpoExpo: "impoexpo",
                                                      linkOrigen: "origen",
                                                      linkDestino: "destino",
                                                      linkListarTodos: "listar_todos",
                                                      id:"agente",
                                                      hiddenName:"idagente",
                                                      width:350
                                                    }),
                                    new WidgetSucursalAgente({fieldLabel: 'Sucursal',
                                                      linkAgente: "agente",
                                                      id:"sucursalagente",
                                                      hiddenName:"idsucursalagente",
                                                      width:250
                                                    }),
                                    {
                                        xtype: "checkbox",
                                        fieldLabel: "Listar todos",
                                        id: "listar_todos",
                                        name:"listar_todos"
                                    }
                                ]
                            }
                        ]
                    },
                <?
                if($impoexpo!= Constantes::TRIANGULACION )
                {

                ?>
                    new FormContinuacionPanel(),
                <?
                }
                ?>
                    new FormMercanciaPanel()
                ]
        });
    };

    Ext.extend(FormTrayectoPanel, Ext.Panel, {
        /*
         * Completa los datos del reporte con la cotización seleccionada.
         **/
        onSelectCotizacion: function( combo, record, index){
            if(Ext.getCmp("modalidad").getValue()=="")
            Ext.getCmp("modalidad").setValue(record.data.modalidad);

            if(Ext.getCmp("linea").getValue()=="")
            {
                Ext.getCmp("linea").setValue(record.data.idlinea);
                $("#linea").val(record.data.linea);
            }

            /*Ext.getCmp("tra_origen_id").setValue(record.data.tra_origen);*/
            if(Ext.getCmp("origen").getValue()=="")
            {
                Ext.getCmp("origen").setValue(record.data.idorigen);
                $("#origen").val(record.data.origen);
            }
            /*Ext.getCmp("tra_destino_id").setValue(record.data.tra_destino);*/
            if(Ext.getCmp("destino").getValue()=="")
            {
                Ext.getCmp("destino").setValue(record.data.iddestino);
                $("#destino").val(record.data.destino);
            }
            if(Ext.getCmp("vendedor").getValue()=="")
            {
                Ext.getCmp("vendedor").setValue(record.data.idvendedor);
                $("#vendedor").val(record.data.vendedor);
            }
            if(Ext.getCmp("ca_mercancia_desc").getValue()=="")
            {
                Ext.getCmp("ca_mercancia_desc").setValue(record.data.producto);
            }

            if(Ext.getCmp("chkcontacto_0").getValue()==false)
            {
                confirmacionesF=record.data.cfijo.split(",");
                confirmaciones=record.data.confirmar.split(",");
                for(i=0;i<confirmaciones.length || i<20;i++)
                {
                    if(confirmaciones[i]!="" && jQuery.inArray(confirmaciones[i], confirmacionesF)<0 )
                    Ext.getCmp("contacto_"+i).setValue(confirmaciones[i]);
                }

                for(i=0;i<confirmaciones.length || i<20;i++)
                {
                    if(confirmacionesF[i]!="")
                        Ext.getCmp("contacto_fijos"+i).setValue(confirmacionesF[i]);
                }
            }
            if(Ext.getCmp("destino").getValue()=="")
            {
                Ext.getCmp("destino").setValue(record.data.iddestino);
            }
            if(Ext.getCmp("contacto").getValue()=="")
            {
                Ext.getCmp("contacto").setValue(record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido);
            }
            if(Ext.getCmp("cliente").getValue()=="")
            {
                Ext.getCmp("cliente").setValue(record.data.idcliente);
                $("#cliente").attr("value",record.data.compania);
                $("#idconcliente").attr("value",record.data.idcontacto);
            }

            if(Ext.getCmp("terminos"))
            {
                if(Ext.getCmp("terminos").getValue()=="")
                {
                    Ext.getCmp("terminos").setValue(record.data.incoterms);
                }
            }

            if(Ext.getCmp("ca_obtencionpoliza").getValue()=="")
            {
                Ext.getCmp("ca_obtencionpoliza").setValue(record.data.obtencion);
            }
            if(Ext.getCmp("ca_idmoneda_vta").getValue()=="")
            {
                Ext.getCmp("ca_idmoneda_vta").setValue(record.data.idmoneda);
            }
            if(Ext.getCmp("ca_idmoneda_pol").getValue()=="")
            {
                Ext.getCmp("ca_idmoneda_pol").setValue(record.data.idmonedaobtencion);
            }
            if(Ext.getCmp("ca_primaventa").getValue()=="")
            {
                Ext.getCmp("ca_primaventa").setValue(record.data.prima_vlr);
            }
            if(Ext.getCmp("ca_minimaventa").getValue()=="")
            {
                Ext.getCmp("ca_minimaventa").setValue(record.data.prima_min);
            }
            
            if((record.data.obtencion) || (record.data.idmoneda) || (record.data.idmonedaobtencion) || (record.data.prima_vlr) || (record.data.prima_min))
            {
                Ext.getCmp('seguros').expand();
            }

            if(Ext.getCmp("destino").getValue()=="")
            {
                $("#destino").val(record.data.destino);
            }
            Ext.getCmp("idproducto").setValue(record.data.idproducto);
            diascredito=0;
            if(record.data.diascredito && record.data.diascredito!="null")
                diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";

            if(Ext.getCmp("ca_tiempocredito").getValue()=="")
            {
                Ext.getCmp("ca_tiempocredito").setValue(diascredito);
            }
            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")=="" || record.get("cupo")=="0")?"No":"Sí";
            else
                cupo="No";

            if(Ext.getCmp("ca_liberacion").getValue()=="")
            {
                Ext.getCmp("ca_liberacion").setValue(cupo);
            }

            if(Ext.getCmp("preferencias").getValue()=="")
                Ext.getCmp("preferencias").setValue(record.get("preferencias"));
        }
        <?
        if($impoexpo== Constantes::OTMDTA)
        {
        ?>,
        onSelectHbls: function( combo, record, index){
            
             Ext.getCmp("referencia").setValue(record.data.referencia);
             Ext.getCmp("hbls").setValue(record.data.hbls);
            
            if(record.data.idreporte )
            {
                Ext.getCmp("idFormReportePanel").load({
                    url:'<?=url_for("reportesNeg/datosReporte")?>',
                    waitMsg:'cargando...',
                    params:{idreporte:record.data.idreporte},
                    success:function(response,options){
                        res = Ext.util.JSON.decode( options.response.responseText );
                        if(Ext.getCmp('ca_colmas'))
                        {
                            if(Ext.getCmp('ca_colmas').getValue()=="Sí")
                                Ext.getCmp('aduanas').expand();
                            else
                                Ext.getCmp('aduanas').collapse();
                        }

                        if(Ext.getCmp('ca_seguro').getValue()=="Sí")
                            Ext.getCmp('seguros').expand();
                        else
                            Ext.getCmp('seguros').collapse();
                        

                        Ext.getCmp("cotizacion").setValue(res.data.cotizacion);
                        if(Ext.getCmp("cotizacionotm"))
                            Ext.getCmp("cotizacionotm").setValue(res.data.cotizacionotm);

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").val(res.data.linea);
                        
                        Ext.getCmp("cliente").setValue(res.data.idcliente);
                        $("#cliente").attr("value",res.data.cliente);

                        Ext.getCmp("bodega_consignar").setValue(res.data.idbodega_hd);
                        $("#bodega_consignar").attr("value",res.data.bodega_consignar);
                        for(i=0;i<<?=($nprov>0)?$nprov:0?>;i++)
                        {
                            {
                                if(Ext.getCmp("proveedor"+i))
                                {
                                    Ext.getCmp("proveedor"+i).setValue(eval("res.data.idproveedor"+i));
                                    $("#proveedor"+i).attr("value",eval("res.data.proveedor"+i));
                                }
                            }
                        };
                        for( i=0; i<20; i++ ){
                            if( Ext.getCmp("contacto_"+i) && Ext.getCmp("contacto_"+i).getValue()!="" ){
                                Ext.getCmp("contacto_"+i).setReadOnly( true );
                            };
                            if( Ext.getCmp("contacto_fijos"+i) && Ext.getCmp("contacto_fijos"+i).getValue()!="" ){
                                Ext.getCmp("contacto_fijos"+i).setReadOnly( true );
                            }
                        };

                        Ext.getCmp("origen").setValue(res.data.idorigen);
                        $("#origen").attr("value",res.data.origen);

                        Ext.getCmp("destino").setValue(res.data.iddestino);
                        $("#destino").attr("value",res.data.destino);

                        Ext.getCmp("cliente-impoexpo").setValue(res.data.idclientefac);
                        $("#cliente-impoexpo").attr("value",res.data.clientefac);

                        if(Ext.getCmp("agente-impoexpo"))
                        {
                            Ext.getCmp("agente-impoexpo").setValue(res.data.idclienteag);
                            $("#agente-impoexpo").attr("value",res.data.clienteag);
                        }

                        if(Ext.getCmp("otro-aduana"))
                        {
                            Ext.getCmp("otro-aduana").setValue(res.data.idclienteotro);
                            $("#otro-aduana").attr("value",res.data.clienteotro);
                        }
                        if(!Ext.getCmp("idvendedor"))
                        {
                            Ext.getCmp("vendedor").setValue(res.data.idvendedor);
                            $("#vendedor").attr("value",res.data.vendedor);
                        }

                        Ext.getCmp("agente").setValue(res.data.idagente);
                        $("#agente").attr("value",res.data.agente);

                        Ext.getCmp("sucursalagente").setValue(res.data.idsucursalagente);
                        $("#sucursalagente").attr("value",res.data.sucursalagente);

                        if(Ext.getCmp("notify"))
                        {
                            Ext.getCmp("notify").setValue(res.data.idnotify);
                            $("#notify").val(res.data.notify);
                        }
                        $("#idconsignatario").val(res.data.consignatario);

                        if(Ext.getCmp("idimportador"))
                        {
                            Ext.getCmp("idimportador").setValue(res.data.idimportador);
                            $("#idimportador").val(res.data.importador);                            
                        }
                        if(Ext.getCmp("idconsigmaster"))
                        {
                            Ext.getCmp("idconsigmaster").setValue(res.data.idconsigmaster);
                            $("#idconsigmaster").val(res.data.consigmaster);
                        }

                        if(Ext.getCmp("idrepresentante"))
                        {
                            Ext.getCmp("idrepresentante").setValue(res.data.idrepresentante);
                            $("#idrepresentante").val(res.data.representante);
                        }

                        if(Ext.getCmp("tipoexpo"))
                        {
                            Ext.getCmp("tipoexpo").setValue(res.data.idtipoexpo);
                            $("#tipoexpo").val(res.data.tipoexpo);
                        }
                        if(Ext.getCmp('panel-conceptos-fletes'))
                            Ext.getCmp('panel-conceptos-fletes').store.reload();
                    }
                });
            }
            Ext.getCmp("npeso").setValue(record.data.peso);
            Ext.getCmp("npiezas").setValue(record.data.numpiezas);
            Ext.getCmp("nvolumen").setValue(record.data.volumen);
            
            Ext.getCmp("fcharribo").setValue(record.data.fcharribo);
            Ext.getCmp("manifiesto").setValue(record.data.manifiesto);
        } 
        <?
        }
        ?>
		,
        onSelectModalidad: function( combo, record, index)
        {
            if(record)
            {
                <?
                    if($impoexpo== Constantes::TRIANGULACION )
                    {
                    ?>
                        if(Ext.getCmp("PCorteHija"))
                            Ext.getCmp("PCorteHija").show();
                        if(Ext.getCmp("PCorteMaster"))
                            Ext.getCmp("PCorteMaster").show();
                    <?
                    }
                    ?>
                if(record.data.modalidad=="CONSOLIDADO")
                {
                    /*if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").hide();
                    if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").show();*/
                    Ext.getCmp("linea").allowBlank=true;
                }
                else if(record.data.modalidad=="DIRECTO")
                {
                    if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").hide();
                    if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").show();
                    Ext.getCmp("linea").allowBlank=true;
                    /*if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").hide();
                    if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").show();
                    Ext.getCmp("linea").allowBlank=true;*/
                }
                else if(record.data.modalidad=="BACK TO BACK")
                {
                    if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").show();
                    if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").show();
                    Ext.getCmp("linea").allowBlank=false;
                }
                else if(record.data.modalidad=="FCL")
                {
                    Ext.getCmp("linea").allowBlank=false;
                }
                else if(record.data.modalidad=="COLOADING")
                {
                    Ext.getCmp("linea").allowBlank=false;
                }
                else
                    Ext.getCmp("linea").allowBlank=true;
            }
            else
            {
                if(Ext.getCmp("PCorteHija"))
                    Ext.getCmp("PCorteHija").show();
                if(Ext.getCmp("PCorteMaster"))
                    Ext.getCmp("PCorteMaster").show();
                Ext.getCmp("linea").allowBlank=true;
            }
        }
    });
</script>
