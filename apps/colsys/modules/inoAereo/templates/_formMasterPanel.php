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

include_component("widgets", "widgetReporte");
?>

<script type="text/javascript">
    FormMasterPanel = function( config ){
        Ext.apply(this, config);       
        
        this.widgetReporte = new WidgetReporte({
                                              fieldLabel: "Reporte",
                                              name: "consecutivo",
                                              hiddenName: "idreporte",
                                              hiddenId: "idreporte",
                                              allowBlank: false,
                                              tipo:1,
                                              tabIndex:2
                                              });
        this.widgetReporte.addListener("select", this.onSelectReporte, this );
        
        FormMasterPanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',            
            items: [{
                    xtype: 'fieldset',
                    title: 'General',
                    autoHeight:true,
                    layout:'column',
                    defaults: {width: 200},
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
                            xtype:"hidden",
                            id: 'referencia',
                            name: 'referencia',
                            value: this.referencia
                        },
                        {
                            xtype:'fieldset',
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                {
                                    xtype: "datefield",
                                    fieldLabel: "Fecha de Registro",
                                    id: "fchreferencia",
                                    name: "fchreferencia",
                                    allowBlank: false,
                                    format:'Y-m-d',
                                    value: "<?= date("Y-m-d") ?>",
                                    tabIndex:1
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
                                this.widgetReporte
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
                                    xtype:          'combo',
                                    mode:           'local',
                                    value:          '',
                                    triggerAction:  'all',
                                    forceSelection: true,
                                    editable:       true,
                                    fieldLabel:     'Tipo',
                                    id:           'impoexpo',
                                    name:           'impoexpo',
                                    hiddenName:     'impoexpo',
                                    displayField:   'value',
                                    valueField:     'value',
                                    allowBlank: false,
                                    store:          new Ext.data.JsonStore({
                                        fields : ['value'],
                                        data   : [
                                            { value: '<?=Constantes::IMPO?>'},
                                            { value: '<?=Constantes::TRIANGULACION?>'}                                            
                                        ]
                                    })
                                },                                
                                
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                    name: 'origen',
                                    hiddenName: 'idorigen',
                                    id: 'origen',
                                    allowBlank: false,
                                    tipo:"1",
                                    impoexpo:"impoexpo",                                                  
                                    tabIndex:6
                                }),
                                new WidgetLinea({fieldLabel: 'Linea',
                                    linkTransporte: "transporte",
                                    name: 'linea',
                                    id: 'linea',
                                    hiddenName: 'idlinea',
                                    hiddenId: "idlinea",
                                    allowBlank: false,
                                    tabIndex:5
                                })
                                
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
                                    value: this.transporte
                                },
                                new WidgetModalidad({fieldLabel: 'Modalidad',
                                    id: 'modalidad',
                                    name: 'modalidad',
                                    linkTransporte: "transporte",
                                    impoexpo: "<?=Constantes::IMPO?>",
                                    allowBlank: false,
                                    tabIndex:4
                                }),
                                
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                    name: 'destino',
                                    id: 'destino',
                                    hiddenName: 'iddestino',
                                    allowBlank: false,
                                    tipo:"2",
                                    impoexpo:"impoexpo",                                                  
                                    tabIndex:7
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
                                    fieldLabel: 'Piezas',
                                    name: 'ca_piezas',
                                    xtype: 'numberfield',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:10,
                                    allowNegative: false,
                                    allowDecimals: false
                                },
                                {
                                    fieldLabel: 'Volumen',
                                    name: 'ca_volumen',
                                    xtype: 'numberfield',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:10,
                                    allowNegative: false,
                                    decimalPrecision: 3                                    
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
                                    fieldLabel: 'MN/Vuelo',
                                    name: 'ca_idnave',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:14
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Llegada',
                                    name: 'ca_fchllegada',
                                    format:'Y-m-d',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:13
                                },
                                {
                                    fieldLabel: 'Peso',
                                    name: 'ca_peso',
                                    xtype: 'numberfield',
                                    width: 200,
                                    allowBlank: false,
                                    tabIndex:10,
                                    allowNegative: false,
                                    decimalPrecision: 3                                    
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Observaciones',
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
                                xtype: 'textarea',                                
                                name: 'ca_observaciones',                                
                                width: 200,
                                allowBlank: true,
                                tabIndex:13
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
                    url: "<?= url_for("inoAereo/guardarMaster") ?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params:{idmaster:this.idmaster},
                    success:function(form,action){
                        document.location = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia="+action.result.referencia;
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
            document.location = "/Coltrans/InoAir/ConsultaReferenciaAction.do?referencia="+this.referencia;
        },
        onRender:function() {
            FormMasterPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();

            if(this.referencia )
            {
                this.load({
                    url:'<?= url_for("inoAereo/datosMaster") ?>',
                    waitMsg:'cargando...',
                    params:{referencia:this.referencia},
                    success:function(response,options){

                        res = Ext.util.JSON.decode( options.response.responseText );

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").val(res.data.linea);
                    }
                });
            }
        },
        onSelectReporte: function( combo, record, idx ){
            var form = this.getForm();
            //form.findField("nombreVendedor").setRawValue(record.data.nombreVendedor);
            //form.findField("nombreVendedor").hiddenField.value = record.data.vendedor;
            
            this.load({
                url: '<?= url_for("inoAereo/datosReporteCarga") ?>',
                params :{
                    idreporte:record.data.idreporte
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error cargando <br />'+res.err);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( options.response.responseText );                   
                    $("#idlinea").val(res.data.idlinea);                    
                    Ext.getCmp("linea").lastQuery=res.data.linea;
                }
            });
        }
    });
</script>