<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
if($modo!=6)
    include_component("widgets", "widgetReporte");
else
    include_component("widgets", "widgetReferencia");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetUsuario");
include_component("widgets", "widgetTercero");
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU047"));
include_component("widgets", "widgetCiudad");

?>
<script type="text/javascript">
    Ext.form.Field.prototype.msgTarget = 'side';
    FormHousePanel = function( config ){
        Ext.apply(this, config);
        
        <?
        if($modo!=6)
        {
        ?>
        this.widgetRef = new WidgetReporte({
                                              fieldLabel: "Reporte",
                                              name: "consecutivo",
                                              hiddenName: "idreporte",
                                              hiddenId: "idreporte",
                                              allowBlank: true,
                                              tipo:1,
                                              impoexpo: this.impoexpo,
                                              transporte: this.transporte
                                              });
        this.widgetRef.addListener("select", this.onSelectReporte, this );
        <?
        }
        else
        {
        ?>
        this.widgetRef = new WidgetReferencia({
                                              fieldLabel: "Referencia",
                                              name: "consecutivo",
                                              allowBlank: true
                                              });
        this.widgetRef.addListener("select", this.onSelectRef, this );
        <?
        }
        ?>
        

        this.widgetCliente = new WidgetCliente({
                                              fieldLabel: "Cliente",
                                              name: "compania",
                                              id: "compania",
                                              hiddenName: "idcliente",
                                              allowBlank: false
                                              });
        this.widgetVendedor = new WidgetUsuario({
                                              fieldLabel: "Vendedor",
                                              name: "nombreVendedor",
                                              id: "nombreVendedor",
                                              hiddenName: "vendedor",
                                              allowBlank: false
                                              });
                                  
        this.widgetTercero = new WidgetTercero({
                                            fieldLabel:this.impoexpo=='<?=Constantes::EXPO?>'?'Consignatario':'Proveedor',                        
                                            tipo: this.impoexpo=='<?=Constantes::EXPO?>'?'Consignatario':'Proveedor',
                                            width: 250,
                                            name: "tercero",           
                                            id: "tercero_id",           
                                            hiddenName: "idtercero",                                                   
                                            allowBlank: false                                            
                                           });
        FormHousePanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',
            items: [{
                        xtype: 'fieldset',
                        title: 'General',
                        autoHeight:true,
                        layout:'column',
                        columns: 2,
                        items :
                        [
                            /*
                             * =========================Column 1 =========================
                             **/
                            {
                                xtype: 'fieldset',
                                columnWidth:.5,
                                layout: 'form',
                                border:false,
                                defaultType: 'textfield',
                                items: [
                                    {
                                        xtype: "hidden",
                                        name: "idmaster",
                                        value: this.idmaster
                                    },
                                    {
                                        xtype: "hidden",
                                        name: "modo",
                                        value: this.modo
                                    },
                                    {
                                        xtype: "hidden",
                                        name: "idhouse"
                                    },
                                    this.widgetRef,
                                    this.widgetVendedor
                                    <?
                                    if($modo!=6)
                                    {
                                    ?>
                                    ,
                                    this.widgetTercero
                                    <?
                                    }
                                    ?>
                                ]
                            },
                            /*
                             * =========================Column 2 =========================
                             **/
                            {
                                xtype: 'fieldset',
                                columnWidth:.5,
                                layout: 'form',
                                border:false,
                                defaultType: 'textfield',
                                items: [
                                    this.widgetCliente,
                                    {
                                        xtype: "textfield",
                                        fieldLabel: "Orden",
                                        name: "numorden",
                                        allowBlank: false
                                    }
                                ]
                            }
                        ]
                    },
                    {
                    xtype:'fieldset',
                    title: 'Información de la carga',
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
                            xtype: 'fieldset',
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
                                    xtype: "textfield",
                                    fieldLabel: "Doc. Transporte",
                                    name:  "doctransporte",
                                    allowBlank: false
                                },
                                <?
                                }
                                ?>
                                {
                                    xtype: 'compositefield',
                                    width:158,
                                    items: [
                                        {
                                            xtype: "numberfield",
                                            fieldLabel: "Piezas",
                                            name:  "numpiezas",
                                            allowNegative: false,
                                            allowDecimals: false,
                                            allowBlank: false,
                                            width:72
                                        },
                                         new WidgetParametros({
                                                            id:'mpiezas',
                                                            name:'mpiezas',
                                                            caso_uso:"CU047",
                                                            width:80,
                                                            idvalor:"valor",
                                                             allowBlank: false
                                                            })
                                    ]
                                },
                                {
                                    xtype: "numberfield",
                                    fieldLabel: "Volumen",
                                    name:  "volumen",
                                    allowNegative: false,
                                    decimalPrecision: 3,
                                    allowBlank: false
                                }
                            ]
                        },
                        /*
                         * =========================Column 2 =========================
                         **/
                        {
                            xtype: 'fieldset',
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
                                    xtype: "datefield",
                                    fieldLabel: "Fch Doc. Transporte",
                                    name:  "fchdoctransporte",
                                    format: "Y-m-d",
                                    allowBlank: false
                                },
                                <?
                                }
                                ?>
                                {
                                    xtype: "numberfield",
                                    fieldLabel: "Peso",
                                    name:  "peso",
                                    allowNegative: false,
                                    decimalPrecision: 3,
                                    allowBlank: false
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

    Ext.extend(FormHousePanel, Ext.form.FormPanel, {
        onSave: function(){
            var form  = this.getForm();
            if( form.isValid() ){
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?=url_for("inoF/formHouseGuardar")?>",                    
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var win = Ext.getCmp("edit-house-win");
                        if( win ){
                            win.close();
                        }
                        if( gridOpener ){
                            var grid = Ext.getCmp( gridOpener);
                            if( grid ){
                                grid.recargar();
                            }
                        }
                        
                        var panel = Ext.getCmp("grid-facturacion-panel");
                        if( panel ){
                            panel.recargar();
                        }else{
                            alert("no se encontro el panel");
                        }
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
            var win = Ext.getCmp("edit-house-win");
            if( win ){
                win.close();
            }
        },
        onRender:function() {
            FormHousePanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            var form  = this.getForm();
            if( this.idhouse ){
                this.load({
                    url:'<?=url_for("inoF/datosFormHousePanel")?>',
                    waitMsg:'Cargando...',
                    params:{
                        idhouse:this.idhouse,
                        modo:this.modo
                    },
                    success:function(response,options){                        
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        
                        form.findField("compania").setRawValue(this.res.data.cliente);
                        form.findField("compania").hiddenField.value = this.res.data.idcliente;
                        form.findField("nombreVendedor").setRawValue(this.res.data.nombreVendedor);
                        form.findField("nombreVendedor").hiddenField.value = this.res.data.vendedor;
                        form.findField("idreporte").setRawValue(this.res.data.reporte);
                        form.findField("idreporte").hiddenField.value = this.res.data.idreporte;                        
                        form.findField("tercero_id").setRawValue(this.res.data.tercero);
                        form.findField("tercero_id").hiddenField.value = this.res.data.idtercero;
                    }
                });
            }
        },
        onSelectRef: function( combo, record, idx ){

            var form = this.getForm();
            form.findField("nombreVendedor").setRawValue(record.data.ca_vendedor);
            form.findField("nombreVendedor").hiddenField.value = record.data.ca_vendedor;            
            form.findField("compania").setValue(record.data.compania);
            form.findField("compania").hiddenField.value = record.data.idcliente;

            form.findField("numpiezas").setValue( record.data.ca_piezas);
            form.findField("peso").setValue( record.data.ca_peso);
            form.findField("volumen").setValue( record.data.ca_volumen);
            
            //form.findField("numorden").setValue(record.data.orden_clie);
        },
        onSelectReporte: function( combo, record, idx ){
            var form = this.getForm();
            form.findField("nombreVendedor").setRawValue(record.data.nombreVendedor);
            form.findField("nombreVendedor").hiddenField.value = record.data.vendedor;
            form.findField("compania").setValue(record.data.compania);
            form.findField("compania").hiddenField.value = record.data.idcliente;
            form.findField("numorden").setValue(record.data.orden_clie);
            this.load({
                url: '<?= url_for("inoF/datosReporteCarga") ?>',
                params :{
                    idreporte:record.data.idreporte,
                    modo: this.modo
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error cargando por favor informe al Depto. de Sistemas<br>'+res.err);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( options.response.responseText );
                    //$("#idtercero").val(res.data.idtercero);                     
                    //Ext.getCmp("tercero").lastQuery=res.data.tercero;
                }
            });
        }
    });
</script>