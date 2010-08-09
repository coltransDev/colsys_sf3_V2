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
$usuarios = $sf_data->getRaw("usuarios");
if($impoexpo=="Triangulación")
{
//include_component("widgets", "widgetImpoexpo");
//include_component("widgets", "widgetTransporte");
}
else
{
    include_component("widgets", "widgetContinuacion");
}

?>
<script type="text/javascript">


    FormTrayectoPanel = function( config ){
        Ext.apply(this, config);
        this.widgetCotizacion = new WidgetCotizacion({
                                                      fieldLabel: "Cotización",
                                                      id:"cotizacion",
                                                      hiddenName: "idcotizacion"
                                                      });
        this.widgetCotizacion.addListener("select", this.onSelectCotizacion, this );
<?
        if($impoexpo!="Triangulación")
        {
?>
            this.wgContinuacion=new WidgetContinuacion({fieldLabel: 'Continuación',
                                                    id: 'continuacion',
                                                    name: 'continuacion',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    })

        this.wgContinuacion.addListener("select", this.onSelectContinuacion, this );
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
                            this.widgetCotizacion,
                            {
                                xtype: "datefield",
                                fieldLabel: "Fecha de Despacho",
                                id: "fchdespacho",
                                name: "fchdespacho"
                            },
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
                                new WidgetModalidad({fieldLabel: 'Tipo Envio',
                                                    id: 'modalidad',
                                                    hiddenName: "idmodalidad",
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    }),     
                                new WidgetPais({fieldLabel: 'País Origen',
                                                id: 'tra_origen_id',
                                                linkCiudad: 'origen',
                                                hiddenName:'idtra_origen_id',
                                                pais:'<?=$pais1?>'
                                               }),
                                 
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
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
                                {
                                    xtype: "hidden",
                                    name: "idtra_destino_id",
                                    id: "idtra_destino_id"
                                },
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id',
                                                linkCiudad: 'destino',
                                                hiddenName:'idtra_destino_id',
                                                pais:'<?=$pais2?>'
                                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  linkPais: 'tra_destino_id',                                                  
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino"
                                                }),
                                new WidgetIncoterms({fieldLabel: 'Terminos',
                                                  id: 'terminos',
                                                  hiddenName:"incoterms",
												  width:250
                                                })
                            ]
                        }
                    ]
                },
                <?
                if($impoexpo!="Triangulación")
                {
                    //print_r($usuarios);
                    $keys=array_keys($usuarios);
                    $conta=count($keys);
                ?>
                {
                    xtype:'fieldset',
                    title: 'Continuación de viaje',
                    autoHeight:true,
                    id:'Pcontinuacion',
                    items: [
                        this.wgContinuacion,
                        new WidgetCiudad({fieldLabel: 'Destino Final',
                                                  name: 'continuacion_dest',
                                                  id: 'continuacion_dest',
                                                  idtrafico: 'CO-057'
                                                }),
                        {
                            xtype:'fieldset',
                            title: 'Informar A',
                            autoHeight:true,                            
                            layout:'column',
                            columns: 2,
                            defaults:{
                                columnWidth:'<?=(1/$conta)?>',
                                layout:'form',                        
                                border:false                                
                            },
                            items :[
<?
                            $i=0;

                            for($i=0;$i<$conta;$i++  )
                            {
?>
                            {
                            columnWidth:'<?=(1/$conta)?>',
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype: "radio",
                                    fieldLabel: "<?=$usuarios[$keys[$i]]?>",
                                    labelStyle: 'width:150px',
                                    name: "ca_continuacion_conf",
                                    id: "ca_continuacion_conf_<?=$i?>",
                                    inputValue:"<?=$keys[$i]?>"
                                }
                            ]
                            },
<?
                            }
                        $i++;
?>
                                {
                                    xtype: "hidden",
                                    fieldLabel: "",
                                    name: "ss",
                                    id: "ss",
                                    value:""
                                }
                            ]
                        }
                    ]
                },
                <?
                }
                ?>
                {
                    xtype:'fieldset',
                    title: 'Información de la Mercancia',
                    autoHeight:true,
                    layout:'form',
                    labelWidth: 200,
                    items: [
                        {
                            xtype: 'textarea',
                            fieldLabel: 'Descripción',
                            hideLabel: true,
                            name: 'ca_mercancia_desc',
                            width: 600,
                            grow: true,
                            id:"ca_mercancia_desc"
                        },
                        {
                            xtype: "checkbox",
                            fieldLabel: "¿Es mercancía peligrosa?",
                            id: "ca_mcia_peligrosa"
                        }
                    ]
                }
            ]
        });
    };

    Ext.extend(FormTrayectoPanel, Ext.Panel, {
        onSelectTransporte: function( combo, record, index){
            if(record.data.valor=="Aéreo")
                Ext.getCmp("Pca_comodato").hide();
            else
                Ext.getCmp("Pca_comodato").show();
        }
        ,
        onSelectContinuacion: function( combo, record, index){
//            alert(b.toSource())
            if(record)
            {
                if(record.data.modalidad!=" " && record.data.modalidad!="")
                {
                    Ext.getCmp('idconsignatario').allowBlank=false;
                    Ext.getCmp('bodega_consignar').allowBlank=false;
                }
                else
                {
                    Ext.getCmp('idconsignatario').allowBlank=true;
                    Ext.getCmp('bodega_consignar').allowBlank=true;
                }
            }
            else
            {
                Ext.getCmp('idconsignatario').allowBlank=true;
                Ext.getCmp('bodega_consignar').allowBlank=true;
            }
/*            if(record.data.valor=="Aéreo")
                Ext.getCmp("Pca_comodato").hide();
            else
                Ext.getCmp("Pca_comodato").show();
*/
        }
        ,
        onSelectClase: function( combo, record, index){
            if(record.data.valor=="Importación")
                Ext.getCmp("Pcontinuacion").show();
            else
                Ext.getCmp("Pcontinuacion").hide();

        },
        /*
         * Completa los datos del reporte con la cotización seleccionada.
         **/
        onSelectCotizacion: function( combo, record, index){

            $("#idcotizacion").val(record.data.idcotizacion);
            Ext.getCmp("impoexpo").setValue(record.data.impoexpo);
            Ext.getCmp("transporte").setValue(record.data.transporte);
            Ext.getCmp("modalidad").setValue(record.data.modalidad);

            Ext.getCmp("linea").setValue(record.data.idlinea);
            $("#linea").val(record.data.linea);
            //Ext.getCmp('linea').setText(A)
            //$("#linea").val(record.data.linea);
            Ext.getCmp("tra_origen_id").setValue(record.data.tra_origen);
            Ext.getCmp("origen").setValue(record.data.idorigen);
            $("#origen").val(record.data.origen);
            Ext.getCmp("tra_destino_id").setValue(record.data.tra_destino);
            Ext.getCmp("destino").setValue(record.data.iddestino);
            $("#destino").val(record.data.destino);

            Ext.getCmp("vendedor").setValue(record.data.vendedor);
//            alert(record.data.idvendedor);
            Ext.getCmp("idvendedor").setValue(record.data.idvendedor);
//            alert(Ext.getCmp("idvendedor").getValue());
            //c_ca_usuario


            confirmaciones=record.data.confirmar.split(",");
            for(i=0;i<confirmaciones.length || i<15;i++)
            {
                Ext.getCmp("contacto_"+i).setValue(confirmaciones[i]);
            }
            Ext.getCmp("destino").setValue(record.data.iddestino);

            Ext.getCmp("contacto").setValue(record.data.nombre+" "+record.data.papellido+" "+record.data.sapellido);

            Ext.getCmp("cliente").setValue(record.data.idcliente);
            $("#cliente").attr("value",record.data.compania);

            Ext.getCmp("terminos").setValue(record.data.incoterms);

            Ext.getCmp("ca_obtencionpoliza").setValue(record.data.obtencion);
            Ext.getCmp("ca_idmoneda_vta").setValue(record.data.idmoneda);
            Ext.getCmp("ca_idmoneda_vta").setValue(record.data.idmonedaobtencion);

            Ext.getCmp("ca_primaventa").setValue(record.data.prima_vlr);
            Ext.getCmp("ca_minimaventa").setValue(record.data.prima_min);

            if(record.data.obtencion || record.data.idmoneda || record.data.idmonedaobtencion || record.data.prima_vlr || record.data.prima_min)
                Ext.getCmp('seguros').collapsed=false;

            Ext.getCmp("ca_liberacion").setValue(record.data.prima_min);
            Ext.getCmp("ca_tiempocredito").setValue(record.data.prima_min);
        }

		

    });
</script>