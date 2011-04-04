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
include_component("reportesNeg", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
if($impoexpo!= Constantes::TRIANGULACION)
{
	include_component("reportesNeg", "formContinuacionPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
}


include_component("widgets", "widgetComerciales");

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
                            {
                                xtype: "datefield",
                                fieldLabel: "Fecha de Despacho",
                                id: "fchdespacho",
                                name: "fchdespacho",
                                format: 'Y-m-d'
                            },

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
                                                      tipo:"1",
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
                                                     id:"linea",
                                                     hiddenName: "idlinea",
                                                     width:300
                                                    }),                                    
                                    new WidgetCiudad({fieldLabel: '<?=$destino?>',                                                      
                                                      id: 'destino',
                                                      idciudad:"destino",
                                                      hiddenName:"iddestino",
                                                      tipo:"2",
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
                if($impoexpo!="Triangulación")
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
