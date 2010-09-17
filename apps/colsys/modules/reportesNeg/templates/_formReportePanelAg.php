<?php
include_component("widgets", "widgetTercero");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetComerciales");
include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetImpoexpo");
include_component("reportesNeg", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));

include_component("widgets", "widgetContactoCliente");

?>
<script type="text/javascript">
    FormReportePanelAg = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding: 5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        
        this.buttons.push( {
            text   : 'Guardar',
            formBind:true,
            scope:this,
            handler: this.onSave
        } );
        
        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );

        this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Cliente',
                                                   width: 600,
                                                   id: "cliente",
                                                   hiddenName: "idcliente",
                                                   allowBlank:false,
                                                   displayField:"compania"
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);



        FormReportePanelAg.superclass.constructor.call(this, {
            labelWidth:120,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,
            fileUpload : true,
            items: [
                {
                    xtype:'fieldset',
                    title: 'General',
                    autoHeight:true,

                    layout:'form',
                    defaults: {width: 200},
                    items :
                    [
                        {
                            xtype: "datefield",
                            fieldLabel: "Fecha de Despacho",
                            id: "fchdespacho",
                            name: "fchdespacho",
                            format: 'Y-m-d',
                            value:'<?=date('Y-m-d')?>'
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
                                new WidgetTransporte({fieldLabel: 'Transporte',
                                                id: 'transporte',
                                                name:'transporte'
                                               }),
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
                                                pais:'todos'
                                               }),

                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                                  linkPais: 'tra_origen_id',
                                                  id: 'origen',
                                                  idciudad:"origen",
                                                  hiddenName:"idorigen"
                                                })
                                
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
                                new WidgetImpoexpo({fieldLabel: 'Impoexpo',
                                                id: 'impoexpo',
                                                name:'impoexpo'
                                               }),
                                new WidgetIncoterms({fieldLabel: 'Terminos',
                                                  id: 'terminos',
                                                  hiddenName:"incoterms",
												  width:220
                                                }),
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id',
                                                linkCiudad: 'destino',
                                                hiddenName:'idtra_destino_id',                                                
                                                pais:'todos'
                                               }),

                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  linkPais: 'tra_destino_id',
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino"
                                                })
                                 
                            ]
                        }
                        ,
                        {
                            columnWidth:1,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
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
                        }
                    ]
                },
                new FormMercanciaPanel(),
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
                        },
                        new WidgetTercero({fieldLabel:"Proveedor",
                                            tipo: 'Proveedor',
                                            width: 600,
                                            name: "idproveedor",
                                            hiddenName: "prov",
                                            id:"proveedor",
                                            name:"proveedor"
                                           }),
                                           new WidgetComerciales({fieldLabel: 'Vendedor',
                                                    id: 'vendedor',
                                                    name: 'vendedor',
                                                    hiddenName: "idvendedor"
                                                    })
                         
                    ]
                },
                {

                    xtype:'fieldset',
                    title: 'Documentos',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        new WidgetTercero({fieldLabel:"Consignatario",
                                                    tipo: 'Consignatario',
                                                    width: 600,
                                                    hiddenName: "consig",
                                                    id:"idconsignatario"
                                                   })
                        ,
                        new WidgetTercero({fieldLabel:"Notificar a",
                                                    tipo: 'Notify',
                                                    width: 600,
                                                    hiddenName: "notify",
                                                    id:"idnotify"
                                                   })
                        ,
                        new WidgetTercero({fieldLabel:"Representante",
                                                    tipo: 'Representante',
                                                    width: 600,
                                                    id: "idrepresentante",
                                                    hiddenName: "idrepres"
                                                   })
                    ]
                },
                {

                    xtype:'fieldset',
                    title: 'Mensaje para el Representante Comercial',
                    autoHeight:true,
                    //defaults: {width: 210},
                    items: [
                        {
                            xtype: "textfield",
                            fieldLabel: "Asunto",
                            name: "asunto",
                            id: "asunto",
                            readOnly: true,
                            width: 200,
                            value:"Nuevo Reporte AG"
                        }
                        ,
                        {
                            xtype: 'textarea',
                            fieldLabel: 'Mensaje adicional',                            
                            name: 'mensaje_comercial',
                            width: 600,
                            grow: true,
                            id:"mensaje_comercial"
                        },                    
                        {
                            xtype: 'fileuploadfield',
                            id: 'archivo',
                            name:'archivo',
                            width: 250,
                            fieldLabel: 'Adjuntar',
                            emptyText: 'Seleccione un archivo',
                            buttonCfg: {
                                text: '',
                                iconCls: 'upload-icon'
                            }
                        }

                    ]
                }
                ,
                {
                    xtype:'fieldset',
                    title: 'Informaciones a:',
                    autoHeight:true,
                    layout:'column',
                    columns: 2,

                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                       /* bodyStyle:'padding:4px',*/
                        hideLabels:true,
                        border:true
                    },
                    items: [
                        {
                            defaultType: 'textfield',
                            items: [
                                <?
                                for( $i=0; $i<20; $i++ )
                                {
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                    xtype: "textfield",
                                    fieldLabel: "",
                                    name: "contacto_<?=$i?>",
                                    id: "contacto_<?=$i?>",
                                    readOnly: true,
                                    width: 550,
                                    height :(navigator.appName=="Netscape")?20:22
                                }
                                <?
                                }
                                ?>
                            ]
                        },
                        {
                            defaults: {width: 20},
                            items: [
                                <?
                                for( $i=0; $i<20; $i++ ):
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "",
                                    name: "chkcontacto_<?=$i?>",
                                    id: "chkcontacto_<?=$i?>",
                                    width: 20,
                                    height :20

                                }
                                <?
                                endfor;
                                ?>
                            ]
                        }
                    ]
                }


            ],
            buttons: this.buttons,
            listeners:{
                afterrender:this.onAfterload
            }
        });

















    };

    Ext.extend(FormReportePanelAg, Ext.form.FormPanel, {
        onSave: function(){            
            var form  = this.getForm();
            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("reportesNeg/guardarReporteAg")?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',                    
                    success: function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        alert('Se guardo correctamente el reporte');
                        if(window.confirm('Desea enviar status inmediatamente?'))
                        {
                            if(res.transporte=='<?=Constantes::AEREO?>')
                                location.href="/traficos/listaStatus/modo/maritimo/reporte/"+res.consecutivo;
                            else
                                location.href="/traficos/listaStatus/modo/aereo/reporte/"+res.consecutivo;
                        }
                        else
                        {
                            location.href="/reportesNeg/verReporte/id/"+res.idreporte+"/modo/"+res.transporte+"/impoexpo/"+res.impoexpo;
                        }
                    }
                    ,
                    failure:function(form,action){
                        Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique');
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){
        },
       onAfterload:function()
       {
<?
                foreach( $issues as $issue ){
                    $info = str_replace("\"", "'",str_replace("\n", "<br />",$issue["t_ca_title"].":<br />".$issue["t_ca_info"]));
                    ?>
                    info = "<?=$info?>";

                    target = $('#<?=$issue["t_ca_field_id"]?>').addClass("help").attr("title",info);
<?
                }
?>
                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
       },
       onSelectContactoCliente: function( combo, record, index){ // override default onSelect to do redirect

            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );

            Ext.getCmp("vendedor").setValue(record.data.vendedor);
            $("#vendedor").val(record.data.nombre_ven);

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

            diascredito=(record.get("diascredito"))?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);

            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"Sí":"No";
            else
                cupo="No";

            Ext.getCmp("ca_liberacion").setValue(cupo);

//			Ext.getCmp("preferencias").setValue(record.get("preferencias"));

            combo.alertaCliente(record);

        }
    });
</script>