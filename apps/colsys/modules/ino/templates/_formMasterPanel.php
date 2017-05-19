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
    Ext.apply(Ext.form.VTypes, {
        daterange : function(val, field) {
            var date = field.parseDate(val);

            if(!date){
                return false;
            }
            if (field.startDateField) {
                var start = Ext.getCmp(field.startDateField);
                if (!start.maxValue || (date.getTime() != start.maxValue.getTime())) {
                    start.setMaxValue(date);
                    start.validate();
                }
            }
            else if (field.endDateField) {
                var end = Ext.getCmp(field.endDateField);
                if (!end.minValue || (date.getTime() != end.minValue.getTime())) {
                    end.setMinValue(date);
                    end.validate();
                }
            }
            /*
             * Always return true since we're only using this vtype to set the
             * min/max allowed values (these are tested for after the vtype test)
             */
            return true;
        },
        validarMaster: function( val, field ){     
            var transporte = Ext.getCmp("transporte").getValue();
            if( transporte=='<?=Constantes::AEREO?>' ){
                if(val.length!=12){                
                    return false;
                }else {
                    for(i=0;i<val.length;i++)    {
                        if(i==3) {
                            if(val.charAt(i)!='-'){                            
                                return false;
                            }
                        }
                        else {
                            if(val.charAt(i)<'0' || val.charAt(i)>'9'){
                                return false;
                            }
                        }
                    }
                }
            }
            return true;
        },        
        validarMasterText : 'este campo debe tener el formato XXX-XXXXXXXX'
    });

    
    FormMasterPanel = function( config ){
        Ext.apply(this, config);       
        
        this.widgetReporte = new WidgetReporte({
            fieldLabel: "Reporte",
            name: "consecutivo",
            hiddenName: "idreporte",
            hiddenId: "idreporte",
            allowBlank: true,
            tipo:1,
            tabIndex:2,
            transporte: this.transporte,
            impoexpo: this.impoexpo
        });
        this.widgetReporte.addListener("select", this.onSelectReporte, this );
        
               
        this.recImpoexpo = Ext.data.Record.create([            
            {name: 'value', type: 'string'}
        ]);
        
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
                            id: 'idmaster',
                            name: 'idmaster',
                            value: this.idmaster
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
                                    id:             'impoexpo_fld',
                                    name:           'impoexpo',
                                    hiddenName:     'impoexpo',
                                    displayField:   'value',
                                    valueField:     'value',
                                    allowBlank: false,
                                    tabIndex:3,
                                    disabled: !!this.idmaster,
                                    value: this.impoexpo,
                                    store: new Ext.data.Store({
                                        autoLoad : false,
                                        reader: new Ext.data.JsonReader({
                                            root: 'root',
                                                totalProperty: 'total'
                                            },
                                            this.recImpoexpo
                                        ),
                                        proxy: new Ext.data.MemoryProxy({})
                                    })
                                    
                                },                                
                                
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                    name: 'origen',
                                    hiddenName: 'idorigen',
                                    id: 'origen',
                                    allowBlank: false,
                                    tipo:"1",
                                    trafico:"CO-057",
                                    impoexpo:"impoexpo_fld",                                                  
                                    tabIndex:5
                                }),
                                new WidgetLinea({fieldLabel: '<?=($modo==6)?"Proveedor":"Linea"?>', 
                                    linkTransporte: "transporte",
                                    impoexpo:"impoexpo",
                                    activoImpo: true,
                                    activoExpo: true,
                                    name: 'linea',
                                    id: 'linea',
                                    hiddenName: 'idlinea',
                                    hiddenId: "idlinea",
                                    allowBlank: false,
                                    tabIndex:7
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
                                    impoexpo: this.impoexpo,
                                    allowBlank: false                                    
                                }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                    name: 'destino',
                                    id: 'destino',
                                    hiddenName: 'iddestino',
                                    allowBlank: false,
                                    tipo:"2",
                                    impoexpo:"impoexpo_fld",
                                    trafico:"CO-057",
                                    tabIndex:6
                                }),
                                new WidgetAgente({fieldLabel: 'Agente',
                                    linkImpoExpo: "impoexpo_fld",
                                    linkOrigen: "origen",
                                    linkDestino: "destino",
                                    linkListarTodos: "listar_todos",
                                    name:"agente",
                                    hiddenName: 'idagente',                                    
                                    tabIndex:8,
                                    value:"<?=($modo==6)?"COLTRANS S.A.S.":""?>",
                                    hiddenValue:"<?=($modo==6)?"800024075":""?>"
                                }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos",
                                    tabIndex:10
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
                                <? 
                                if($modo!=6)
                                {
                                ?>
                                {
                                    fieldLabel: 'Master',
                                    name: 'ca_master',
                                    width: 120,                                    
                                    tabIndex:15,
                                    vtype: 'validarMaster',
                                    allowBlank: false
                                },
                                <?
                                }
                                ?>
                                {
                                    fieldLabel: 'Peso',
                                    name: 'ca_peso',
                                    xtype: 'numberfield',
                                    width: 120,
                                    allowBlank: false,
                                    tabIndex:17,
                                    allowNegative: false,
                                    decimalPrecision: 3                                    
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Preaviso',
                                    name: 'ca_fchsalida',
                                    id: 'fchsalida',
                                    format:'Y-m-d',
                                    value:"<?=($modo==6)?date("Y-m-d"):""?>",
                                    //vtype: 'daterange',
                                    //endDateField: 'fchllegada', // id of the end date field
                                    width: 120,
                                    allowBlank: false,
                                    tabIndex:19
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
                                    fieldLabel: 'Piezas',
                                    name: 'ca_piezas',
                                    xtype: 'numberfield',
                                    width: 120,
                                    allowBlank: <?=($modo==6)?"true":"false"?>,
                                    tabIndex:16,
                                    allowNegative: false,
                                    allowDecimals: false
                                },
                                {
                                    fieldLabel: 'Volumen',
                                    name: 'ca_volumen',
                                    xtype: 'numberfield',
                                    width: 120,
                                    allowBlank: <?=($modo==6)?"true":"false"?>,
                                    tabIndex:18,
                                    allowNegative: false,
                                    decimalPrecision: 3                                    
                                },
                                {
                                    xtype: 'datefield',
                                    fieldLabel: 'Fecha Llegada',
                                    name: 'ca_fchllegada',
                                    id: 'fchllegada',
                                    format:'Y-m-d',
                                    width: 120,
                                    value:"<?=($modo==6)?date("Y-m-d"):""?>",
                                    //vtype: 'daterange',                                    
                                    //startDateField: 'fchsalida', // id of the start date field
                                    allowBlank: false,
                                    tabIndex:20
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
                            tabIndex:24
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
            var modo = this.modo;
            if( form.isValid() ){
                form.submit({
                    url: "<?= url_for("ino/guardarMaster") ?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params:{
                        idmaster:this.idmaster,
                        modo: this.modo
                    },
                    success:function(form,action){
                        document.location = "<?=url_for("ino/verReferencia")?>?modo="+modo+"&idmaster="+action.result.idmaster;
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
        
            if( this.idmaster ){
                document.location = "<?=url_for("ino/verReferencia")?>?modo="+this.modo+"&idmaster="+this.idmaster;
            }else{
                document.location = "<?=url_for("ino/index")?>?modo="+this.modo;
            }
        },
        onRender:function() {
            FormMasterPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();

            if(this.idmaster )
            {
                this.load({
                    url:'<?= url_for("ino/datosMaster") ?>',
                    waitMsg:'cargando...',
                    params:{
                        idmaster:this.idmaster,
                        modo:this.modo
                    },
                    success:function(response,options){

                        res = Ext.util.JSON.decode( options.response.responseText );

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").val(res.data.linea);
                    }
                });
            }
            
            
            var field = Ext.getCmp("impoexpo_fld");
            
            var newRec = new this.recImpoexpo({                
                value: this.impoexpo
            });

            field.store.addSorted( newRec );
            
            if( this.impoexpo=='<?=  Constantes::IMPO?>'){
                var newRec = new this.recImpoexpo({                
                    value: '<?=  Constantes::TRIANGULACION?>'
                });

                field.store.addSorted( newRec );
            }
        },
        onSelectReporte: function( combo, record, idx ){
            var form = this.getForm();
            //form.findField("nombreVendedor").setRawValue(record.data.nombreVendedor);
            //form.findField("nombreVendedor").hiddenField.value = record.data.vendedor;
            
            this.load({
                url: '<?= url_for("ino/datosReporteCarga") ?>',
                waitMsg:'cargando...',
                params :{
                    idreporte:record.data.idreporte,
                    modo:this.modo
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