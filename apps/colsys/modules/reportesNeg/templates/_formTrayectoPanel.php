<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("widgets", "widgetCotizacion");

//include_component("widgets", "widgetImpoexpo");
//include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetIncoterms");
include_component("reportesNeg", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
//$usuarios = $sf_data->getRaw("usuarios");
if($impoexpo== Constantes::TRIANGULACION)
{
//include_component("widgets", "widgetImpoexpo");
//include_component("widgets", "widgetTransporte");
}
else
{
	include_component("reportesNeg", "formContinuacionPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
}

if($permiso>=2)
{
    include_component("widgets", "widgetComerciales");
}

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
		if($impoexpo== Constantes::EXPO || ($impoexpo== Constantes::IMPO && $modo== Constantes::AEREO) || ($impoexpo== Constantes::TRIANGULACION ))
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
            //layout:'form',
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
                            <?
                            if($permiso<2)
                            {
                            ?>
                            {
                                xtype: "hidden",
                                id: "idvendedor",
                                name: "idvendedor"
                            }
                            ,
                            {
                                xtype: "textfield",
                                fieldLabel: "Vendedor",
                                id: "vendedor",
                                name: "vendedor"
                            }
                            <?
                            }
                            else
                            {
                            ?>
                            new WidgetComerciales({fieldLabel: 'Vendedor',
                                                    id: 'vendedor',
                                                    name: 'vendedor',
                                                    hiddenName: "idvendedor"
                                                    })
                            <?
                            }
                            ?>
                        ]
                    },
                    {
                    xtype:'fieldset',
                    title: 'Información del trayecto',
                    autoHeight:true,
                   
                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',                        
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items :
                        [
                        /*
                         * =========================Column 1 =========================
                         **/
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype:"hidden",
                                    id: 'impoexpo',
                                    name: 'impoexpo',
                                    value:'<?=$impoexpo?>'
                                },
                                /*new WidgetImpoexpo({fieldLabel: 'Clase',
                                                    id: 'impoexpo',
                                                    name: 'impoexpo',                                                    
                                                    listeners:{select:this.onSelectClase}
                                                    }),*/

                                this.wgModalidad,
                                new WidgetPais({fieldLabel: 'País Origen',
                                                id: 'tra_origen_id',
                                                linkCiudad: 'origen',
                                                hiddenName:'idtra_origen_id',
                                                pais:'<?=$pais1?>',
                                                excluidos:'C0-057'
                                               }),
                                 
                                new WidgetCiudad({fieldLabel: '<?=$origen?>',
                                                  linkPais: 'tra_origen_id',
                                                  id: 'origen',
                                                  idciudad:"origen",
                                                  hiddenName:"idorigen"
                                                }),
                                new WidgetAgente({fieldLabel: 'Agente',
                                                  linkImpoExpo: "impoexpo",
                                                  linkOrigen: "tra_origen_id",
                                                  linkDestino: "tra_destino_id",
                                                  linkListarTodos: "listar_todos",
                                                  id:"agente",
                                                  hiddenName:"idagente",
												  width:350
                                                }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos",
                                    name:"listar_todos"
                                }                                
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
                            items: [

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
												 width:350
                                                }),
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id',
                                                linkCiudad: 'destino',
                                                hiddenName:'idtra_destino_id',
                                                pais:'<?=$pais2?>'
                                               }),

                                new WidgetCiudad({fieldLabel: '<?=$destino?>',
                                                  linkPais: 'tra_destino_id',
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino"
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
                        }
                    ]
                },
                <?
                if($impoexpo!="Triangulación")
                {

                ?>
				new FormContinuacionPanel()
                ,
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

            Ext.getCmp("impoexpo").setValue(record.data.impoexpo);
            Ext.getCmp("transporte").setValue(record.data.transporte);
            Ext.getCmp("modalidad").setValue(record.data.modalidad);

            Ext.getCmp("linea").setValue(record.data.idlinea);
            $("#linea").val(record.data.linea);

            Ext.getCmp("tra_origen_id").setValue(record.data.tra_origen);
            Ext.getCmp("origen").setValue(record.data.idorigen);
            $("#origen").val(record.data.origen);

            Ext.getCmp("tra_destino_id").setValue(record.data.tra_destino);
            Ext.getCmp("destino").setValue(record.data.iddestino);
            $("#destino").val(record.data.destino);

            $("#idvendedor").val(record.data.idvendedor);

            Ext.getCmp("vendedor").setValue(record.data.idvendedor);
            $("#vendedor").val(record.data.vendedor);



            confirmaciones=record.data.confirmar.split(",");
            for(i=0;i<confirmaciones.length || i<15;i++)
            {
                Ext.getCmp("contacto_"+i).setValue(confirmaciones[i]);
            }
            Ext.getCmp("destino").setValue(record.data.iddestino);

            Ext.getCmp("contacto").setValue(record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido);

            Ext.getCmp("cliente").setValue(record.data.idcliente);
            $("#cliente").attr("value",record.data.compania);
            $("#idconcliente").attr("value",record.data.idcontacto);

            if(Ext.getCmp("terminos"))
                Ext.getCmp("terminos").setValue(record.data.incoterms);

            Ext.getCmp("ca_obtencionpoliza").setValue(record.data.obtencion);
            Ext.getCmp("ca_idmoneda_vta").setValue(record.data.idmoneda);
            Ext.getCmp("ca_idmoneda_pol").setValue(record.data.idmonedaobtencion);

            Ext.getCmp("ca_primaventa").setValue(record.data.prima_vlr);
            Ext.getCmp("ca_minimaventa").setValue(record.data.prima_min);

            if(record.data.obtencion!="" || record.data.idmoneda!="" || record.data.idmonedaobtencion!="" || record.data.prima_vlr!="" || record.data.prima_min!="")
            {
                Ext.getCmp('seguros').expand();
            }

//            Ext.getCmp("ca_liberacion").setValue(record.data.prima_min);
//            Ext.getCmp("ca_tiempocredito").setValue(record.data.prima_min);
            $("#destino").val(record.data.destino);
            Ext.getCmp("idproducto").setValue(record.data.idproducto);



//            dias_credito
            //alert(record.data.diascredito);
            diascredito=0;
            if(record.data.diascredito && record.data.diascredito!="null")
                diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";

            Ext.getCmp("ca_tiempocredito").setValue(diascredito);
            
            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"Sí":"No";
            else
                cupo="No";
            //alert(cupo);
            Ext.getCmp("ca_liberacion").setValue(cupo);

        }
        <?
		//if($impoexpo== Constantes::EXPO || ($impoexpo== Constantes::IMPO ))
		{
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
                    if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").hide();
                    if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").show();
                    Ext.getCmp("linea").allowBlank=true;
                }
                else if(record.data.modalidad=="DIRECTO")
                {
                    if(Ext.getCmp("PCorteHija"))
                        Ext.getCmp("PCorteHija").hide();
                    if(Ext.getCmp("PCorteMaster"))
                        Ext.getCmp("PCorteMaster").show();
                    Ext.getCmp("linea").allowBlank=true;
                }
                else if(record.data.modalidad=="BACK TO BACK")
                {
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
		<?
		}
		?>
    });
</script>