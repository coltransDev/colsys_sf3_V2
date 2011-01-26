<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
//include_component("widgets", "widgetImpoexpo");
//include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetAgente");
?>
<script type="text/javascript">
    FormMasterPanel = function( config ){
        Ext.apply(this, config);
        FormMasterPanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',            
            items: [{
                        xtype: 'fieldset',
                        title: 'General',
                        autoHeight:true,
                        layout:'form',
                        defaults: {width: 200},
                        items :
                        [
                            {
                                xtype: "datefield",
                                fieldLabel: "Fecha de Registro",
                                id: "fchreferencia",
                                name: "fchreferencia",
                                allowBlank: false,
                                format:'Y-m-d',
                                value: "<?=date("Y-m-d")?>",
                                tabIndex:1
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
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
/*                                new WidgetImpoexpo({fieldLabel: 'Clase',
                                                    id: 'impoexpo',
                                                    name: 'impoexpo',
                                                    allowBlank: false,
                                                    tabIndex:2
                                                    }),
*/
                                    {
                                        xtype:"hidden",
                                        id: 'impoexpo',
                                        name: 'impoexpo',
                                        value:'<?=$impoexpo?>'
                                    },
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                                    id: 'modalidad',
                                                    name: 'modalidad',
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo",
                                                    allowBlank: false,
                                                    tabIndex:4
                                                    }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                                  name: 'origen',
                                                  hiddenName: 'idorigen',
                                                  id: 'origen',
                                                  allowBlank: false,
                                                  tipo:"1",
                                                  impoexpo:"impoexpo",
                                                  trafico: "<?=$trafico?>",
                                                  tabIndex:6
                                                }),
                                new WidgetAgente({fieldLabel: 'Agente',
                                                  linkImpoExpo: "impoexpo",
                                                  linkOrigen: "origen",
                                                  linkDestino: "destino",
                                                  linkListarTodos: "listar_todos",
                                                  name:"agente",
                                                  hiddenName: 'idagente',
                                                  allowBlank: false,
                                                  tabIndex:8
                                                }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos",
                                    tabIndex:9
                                }
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
/*                                new WidgetTransporte({fieldLabel: 'Transporte',
                                                      id: 'transporte',
                                                      allowBlank: false,
                                                      tabIndex:3
                                                    }),
*/
                                {
                                        xtype:"hidden",
                                        id: 'transporte',
                                        name: 'transporte',
                                        value:'<?=$modo?>'
                                },
                                new WidgetLinea({fieldLabel: 'Linea',
                                                 linkTransporte: "transporte",
                                                 name: 'linea',
                                                 id: 'linea',
                                                 hiddenName: 'idlinea',
                                                 allowBlank: false,
                                                 tabIndex:5
                                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                                  name: 'destino',
                                                  id: 'destino',
                                                  hiddenName: 'iddestino',
                                                  allowBlank: false,
                                                  tipo:"2",
                                                  impoexpo:"impoexpo",
                                                  trafico: "<?=$trafico?>",
                                                  tabIndex:7
                                                })
                            ]
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
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    fieldLabel: 'Master',
                                    name: 'ca_master',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:10
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Salida',
                                    name: 'ca_fchsalida',
                                    format:'Y-m-d',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:12
                                },
                                {
                                    fieldLabel: 'MN/Vuelo',
                                    name: 'ca_motonave',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:14
                                }
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Master',
                                    name: 'ca_fchmaster',
                                    format:'Y-m-d',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:11
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Llegada',
                                    name: 'ca_fchllegada',
                                    format:'Y-m-d',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:13
                                }
                            ]
                        }
                    ]
                }
            ],
            buttons:[
                {
                    text: 'Guardar',
                    handler: this.onSave,
                    scope: this
                },
                {
                    text: 'Cancelar',
                    handler: this.onCancel,
                    scope: this
                }
            ]
        });
    };
    Ext.extend(FormMasterPanel, Ext.form.FormPanel, {
        onSave: function(){        
            var form  = this.getForm();
            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("ino/guardarMaster")?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params:{id:this.id},
                    success:function(form,action){
                        document.location = "/<?="ino/verReferencia"?>?id="+action.result.idmaestra;
                    },
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){
        },
        onRender:function() {
            FormMasterPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();

            if(this.idmaster )
            {
                this.load({
                    url:'<?=url_for("ino/datosMaster")?>',
                    waitMsg:'cargando...',
                    params:{id:this.idmaster},
                    success:function(response,options){

                        res = Ext.util.JSON.decode( options.response.responseText );

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").val(res.data.linea);
                    }
                });
            }



        }
    });
</script>