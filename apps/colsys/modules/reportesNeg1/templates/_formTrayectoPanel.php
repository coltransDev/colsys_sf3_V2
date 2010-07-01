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
include_component("widgets", "widgetContinuacion");
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
        
        FormTrayectoPanel.superclass.constructor.call(this, {
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
                                    value:'Importación'
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
                                                hiddenName:'idtra_origen_id'
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
                                                  hiddenName:"idagente"
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
                                /*new WidgetTransporte({fieldLabel: 'Transporte',
                                                      id: 'transporte',
                                                      name:'transporte',                                                      
                                                      listeners:{select:this.onSelectTransporte}
                                                    }),*/
                                {
                                    xtype:"hidden",
                                    id: 'transporte',
                                    name: 'transporte',
                                    value:'<?=$modo?>'
                                },
                                new WidgetLinea({fieldLabel: '<?=$nomLinea?>',
                                                 linkTransporte: "transporte",
                                                 id:"linea",
                                                 hiddenName: "idlinea"
                                                }),
                                {
                                    xtype: "hidden",
                                    name: "idtra_destino_id",
                                    id: "idtra_destino_id"
                                },
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id',
                                                linkCiudad: 'destino',
                                                hiddenName:'idtra_destino_id'
                                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  linkPais: 'tra_destino_id',                                                  
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino"
                                                })
                            ]
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Continuación de viaje',
                    autoHeight:true,
                    id:'Pcontinuacion',
                    items: [
                        new WidgetContinuacion({fieldLabel: 'Continuación',
                                                    id: 'continuacion',
                                                    name: 'continuacion',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo"
                                                    }),
                        new WidgetCiudad({fieldLabel: 'Destino Final',
                                                  name: 'continuacion_dest',
                                                  id: 'continuacion_dest',
                                                  idtrafico: 'CO-057'
                                                })
                    ]
                },
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

            //alert(record.data.compania);

//            alert(a.length);
//           $("#idcliente").attr("value",record.data.compania);
//            alert(record.data.compania);
//            alert($("#cliente").val());

            /*


            {name: 'idproducto', mapping: 'p_ca_idproducto'},
            {name: 'producto', mapping: 'p_ca_producto'},
            {name: 'idlinea', mapping: 'p_ca_idlinea'},
            {name: 'idmodalidad'},
            {name: 'tra_origen', mapping: 'o_ca_idtrafico'},
            {name: 'tra_destino', mapping: 'd_ca_idtrafico'},
			{name: 'origen', mapping: 'o_ca_ciudad'},
            {name: 'destino', mapping: 'd_ca_ciudad'},
            {name: 'idorigen', mapping: 'o_ca_idciudad'},
			{name: 'iddestino', mapping: 'd_ca_idciudad'},
			{name: 'idcontacto', mapping: 'con_ca_idcontacto'},
            {name: 'compania', mapping: 'cl_ca_compania'},
			{name: 'cargo', mapping: 'con_ca_cargo'},
			{name: 'nombre', mapping: 'con_ca_nombres'},
			{name: 'papellido', mapping: 'con_ca_papellido'},
			{name: 'sapellido', mapping: 'con_ca_sapellido'},
			
			
            {name: 'vendedor', mapping: 'c_ca_usuario'},
            {name: 'coordinador', mapping: 'cl_ca_coordinador'}
            */

        }
    });

</script>