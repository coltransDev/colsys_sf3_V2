<?php
include_component("widgets", "widgetTercero");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetComerciales");

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
                                                   allowBlank:false
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);



        FormReportePanelAg.superclass.constructor.call(this, {
            labelWidth:80,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,
            items: [
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
                            {
                                xtype:"hidden",
                                id: 'impoexpo',
                                name: 'impoexpo',
                                value:'<?=$impoexpo?>'
                            },                            
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
                                new WidgetImpoexpo({fieldLabel: 'Impoexpo',
                                                id: 'impo_expo',
                                                name:'impoexpo'
                                               }),
                                
                                new WidgetPais({fieldLabel: 'País Destino',
                                                id: 'tra_destino_id',
                                                linkCiudad: 'destino',
                                                hiddenName:'idtra_destino_id',
                                                pais:'CO-057'
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
                    url: "<?=url_for("reportesNeg/guardarReporteAg?idreporte=".$idreporte)?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',                    
                    success: function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                        if(res.redirect)                            
                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
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
            Ext.getCmp("cliente").setValue(record.get("idcliente"));
            ("#cliente").setValue(record.get("compania"));

            diascredito=(record.get("diascredito")!="")?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);
            cupo=(record.get("cupo")!="")?"Sí":"No";
            //alert(cupo);
            Ext.getCmp("ca_liberacion").setValue(cupo);
            combo.alertaCliente(record);

        }
    });
</script>