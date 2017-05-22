<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/
$tipos = $sf_data->getRaw("tipos");



$data = $sf_data->getRaw("data");

include_component("widgets", "widgetMoneda");
include_component("widgets", "widgetIds");
?>
<script type="text/javascript">
    Ext.form.Field.prototype.msgTarget = 'side';
    FormCostosDiscriminadosPanel = function( config ){
        Ext.apply(this, config);
        
        this.tipos = new Ext.form.ComboBox({
            fieldLabel: 'Tipo',
            valueField:'idtipo',
            displayField:'tipo',
            typeAhead: true,
            width: 400,
            emptyText:'',
            value: '',
            forceSelection:true,
            selectOnFocus:true,
            allowBlank:false,
            name:'tipo',
            id:'tipo',
            hiddenName:'idtipo',
            mode:'local',
            triggerAction: 'all',
            store: new Ext.data.Store({
                autoLoad : true,
                reader: new Ext.data.JsonReader({
                    root: 'root',
                        totalProperty: 'total'
                    },
                    Ext.data.Record.create([
                        {name: 'idtipo', type: 'string'},
                        {name: 'tipo', type: 'string'}
                    ])
                ),
                proxy: new Ext.data.MemoryProxy(<?= json_encode($tipos) ?>)
            })           
        });
        
        this.widgetConceptos = new Ext.form.ComboBox({
            name: "concepto",
            hiddenName: "idconcepto",
            fieldLabel: "Concepto",
            valueField: 'idconcepto',
            displayField: 'concepto',
            typeAhead: true,
            forceSelection: true,
            triggerAction: 'all',
            emptyText:'',
            selectOnFocus: true,        
            lazyRender:true,
            mode: 'local',
            listClass: 'x-combo-list-small',
            submitValue: true,
            allowBlank: false,
            tabIndex: 1,
            store: new Ext.data.Store({
                autoLoad : true,
                reader: new Ext.data.JsonReader(
                {
                    root: 'root',
                    totalProperty: 'total',
                    successProperty: 'success'
                },
                Ext.data.Record.create([
                        {name: 'idconcepto'},
                        {name: 'concepto'},
                        {name: 'transporte'},
                        {name: 'modalidad'}
                    ])
                ),
                proxy: new Ext.data.MemoryProxy( <?= json_encode(array("root" => $data, "total" => count($data))) ?> )
            })
        });
        FormCostosDiscriminadosPanel.superclass.constructor.call(this, {
            deferredRender:false,
            autoHeight:true,
            bodyStyle:"padding: 5px",
            buttonAlign: 'center',
            items: [
                {
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
                                this.tipos,
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
                                    name: "detalles"
                                    
                                }, 
                                this.widgetConceptos,                                
                                {
                                    xtype: "datefield",
                                    fieldLabel: "Fecha Factura",
                                    name: "fchfactura",
                                    allowBlank: false,
                                    maxLength: 30,
                                    tabIndex: 3,
                                    format: 'Y-m-d'
                                },
                                {
                                    xtype: "numberfield",
                                    fieldLabel: "Cambio USD",
                                    name: "tcambio_usd",
                                    id: "tasacambiousd_id",
                                    allowBlank: false,
                                    maxLength: 30,
                                    tabIndex: 3,
                                    listeners: {
                                        change: this.cambiarTasaCambio
                                    }
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
                                new WidgetIds({
                                    fieldLabel: "Proveedor",
                                    name: "id",
                                    hiddenName: 'id'
                                    
                                }),
                                {
                                    xtype: "textfield",
                                    fieldLabel: "Factura",
                                    name: "factura",
                                    allowBlank: false,
                                    maxLength: 30,
                                    tabIndex: 2
                                },
                                new WidgetMoneda({                                    
                                    fieldLabel: "Moneda",
                                    name: "idmoneda",
                                    allowBlank: false,
                                    tabIndex: 4
                                }),
                                {
                                    xtype: "numberfield",
                                    fieldLabel: "Cambio <?=$monedaLocal?>",
                                    name: "tcambio",
                                     id: "tasacambio_id",
                                    allowBlank: false,
                                    maxLength: 30,
                                    tabIndex: 3,
                                    listeners: {
                                        change: this.cambiarTasaCambio
                                    }
                                }
                            ]
                        }
                    ]
                }   
            ],
            tbar:[
                {
                    text: 'Guardar',
                    handler: this.onSave,
                    scope: this,
                    iconCls: 'disk'
                },
                {
                    text: 'Volver',
                    handler: this.onCancel,
                    scope: this,
                    iconCls: 'arrow_left'
                }
            ]
        });
    };

    Ext.extend(FormCostosDiscriminadosPanel, Ext.form.FormPanel, {
        onSave: function(){
            var form  = this.getForm();
                        
            if( form.isValid() ){
                
                var grid = Ext.getCmp("panel-discriminacion");
                var records = grid.store.getRange();
                var result = [];            
                for( var i=0; i<records.length; i++){
                    rec = records[i];
                    if( rec.get("idhouse") ){
                        var str = "idhouse="+rec.get("idhouse")+" ";
                        str += "neto="+rec.get("neto");
                        result.push( str );
                    }

                }
                form.findField("detalles").setValue(result.join("|"));
                
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?=url_for("inoF/formCostosDiscriminadosPanelGuardar")?>",                    
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var win = Ext.getCmp("edit-equipo-win");
                        if( win ){
                            win.close();
                        }
                        if( gridOpener ){
                            var grid = Ext.getCmp( gridOpener);
                            if( grid ){
                                grid.recargar();
                            }
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
            document.location = "<?=url_for("inoF/verReferencia")?>?modo="+this.modo+"&idmaster="+this.idmaster
        },
        onRender:function() {
            FormCostosDiscriminadosPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            var form  = this.getForm();
            if( this.idcomprobante ){
                this.load({
                    url:'<?=url_for("inoF/datosFormCostosDiscriminadosPanel")?>',
                    waitMsg:'Cargando...',
                    params:{
                        idcomprobante:this.idcomprobante,
                        modo:this.modo
                    },
                    success:function(response,options){                        
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        
                        form.findField("id").setRawValue(this.res.data.ids_nombre);
                        form.findField("id").hiddenField.value = this.res.data.ids;
                       
                    }
                });
            }
        },
        cambiarTasaCambio: function(){
            var grid = Ext.getCmp("panel-discriminacion");
            var records = grid.store.getRange();            
            for( var i=0; i<records.length; i++){
                var rec = records[i];
                
                var cmp = Ext.getCmp("tasacambio_id");      
                var cmp2 = Ext.getCmp("tasacambiousd_id");       
                if( cmp && cmp.getValue() && cmp2 && cmp2.getValue() ){     
                    var val =  Math.round( rec.get("neto")*cmp.getValue()/cmp2.getValue() *100)/100;
                    rec.set("valor", val );
                }else{
                    rec.set("valor", 0);
                }                  
            }
        }
    });
</script>