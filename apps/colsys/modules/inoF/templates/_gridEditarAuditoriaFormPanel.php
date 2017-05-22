<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
//$tipos = $sf_data->getRaw("tipos");
//$modo = $sf_data->getRaw("modo");
include_component("widgets", "widgetParametros", array("caso_uso" => "CU220"));
include_component("widgets", "widgetMoneda");
include_component("widgets", "widgetSucursales");
include_component("widgets", "widgetUsuario");
$eval = 0;


//$eventos = $sf_data->getRaw("eventos");
//probar sin el getRaw
?>
<script type="text/javascript">
    GridEditarAuditoriaFormPanel = function(config) {

        Ext.apply(this, config);
        this.ctxRecord = null;
        Ext.QuickTips.init();

        //alert("dentro del formulario:"+this.tipo+" accion: "+this.accion+" idevento "+this.idevento);
        <?
        $accion = "<script> document.write(this.accion) </script>";
        $idevento = "<script> document.write(this.evento) </script>";
        $tipo = "<script> document.write(this.tipo) </script>";
        ?>

        this.eventosCombo = new WidgetParametros({
            id: 'evento',
            name: 'evento',
            displayField: 'asunto',
            valueField: 'ca_asunto',
            editable: false,
            forceSelection: true,
            fieldLabel: 'Evento',
            caso_uso: "CU220",
            anchor: '95%',
            selectOnFocus: true,
            //width:80,
            idvalor: "valor",
            blankText: 'Ingrese la descripción del evento',
            allowBlank: false
        });
        
        this.monedas= new WidgetMoneda({
            anchor: '80%',
            fieldLabel: 'Moneda',
            allowBlank: true,
            name: 'moneda',
            tabIndex: 5
        });
        
        this.sucursales= new WidgetSucursales({
            anchor: '95%',
            fieldLabel: 'Sucursal',
            allowBlank: false,
            name: 'sucursal',
            tabIndex: 5  
        /*,
            /*valueField: 'id',
            displayField: 'valor'*/
        });
        
        this.responsableTarea = new WidgetUsuario({
            fieldLabel: "Responsable",
            id: "usucompromiso",
            name: "usucompromiso",
            hiddenName: 'login',
            anchor: '95%',
            allowBlank: false,
            readOnly: true
        });
        
        this.responsableFecha = {
            xtype: 'datefield',
            fieldLabel: "Fecha Respuesta",
            name: 'fchcompromiso',
            id: 'fchcompromiso',
            hiddenName: 'fchcompromiso',
            /*vtype: 'daterange',*/
            endDateField: 'end-date',
            anchor: '95%',
            allowBlank: false,
            format : "m/d/Y"
        };
        
        this.detalleEvento = {
            xtype: 'textarea',
            fieldLabel: 'Hallazgo',
            valueField: 'ca_detalle',
            name: 'detalle',
            anchor: '95%',
            height: 150,
            allowBlank: false
        },
       



               this.valor = {
                    xtype:'numberfield',
                    fieldLabel: 'Valor',
                    name: 'valor',
                    value: 0,
                    allowBlank:true,
                    allowNegative:true,
                    decimalPrecision : 2,
                    anchor: '80%',
                    tabIndex: 4
                },
                
                this.cc = {
                    xtype:'textarea',
                    fieldLabel: 'CC',
                    name: 'cc',
                   /* value: 0,
                    allowBlank:true,*/
                   // allowNegative:true,
                   // decimalPrecision : 2,
                    anchor: '95%'
                    /*,vtype: 'email',*/
                    //vtypeText: 'No ha ingresado una lista de correos, separadas por comas valida'
                    //,tabIndex: 4
                },

                this.idAntecedente = {
                    xtype: 'hidden',
                    name: 'idAntedecente',
                    allowBlank: false
                },
                this.tasadeCambio = {
                    xtype:'numberfield',
                    fieldLabel: 'Tasa de Cambio',
                    name: 'tcambio',
                    id: 'tasacambio_id',
                    value: 0,
                    allowBlank:true,
                    allowNegative:false,
                    decimalPrecision : 2,
                    anchor: '80%',
                    tabIndex: 3,
                    listeners: {
                        change: this.cambiarTasaCambio
                    }
                }

        this.items = [{
                xtype: 'fieldset',
                buttonAlign: 'left',
                activeTab: 0,
                defaults: {autoHeight: true},
                deferredRender: false,
                items: [{
                        title: 'Información General',
                        layout: 'form',
                        bodyStyle: 'padding:10px',
                        items: [
                            {
                                layout: 'column',
                                border: false,
                                columns: 1,
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle: 'padding-right:20px',
                                    border: false
                                },
                                items: [
                                    // Columna 1
                                    {
                                        layout: 'form',
                                        columnWidth: 1,
                                        items: [                                            
                                            this.eventosCombo,
                                            this.detalleEvento,
                                            //this.ids,
                                            /*this.houses,*/
                                            this.sucursales,
                                            this.responsableTarea,
                                            this.responsableFecha,
                                            this.cc,
                                            this.valor,
                                            this.monedas,
                                            this.tasadeCambio
                                            
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }];


        this.buttonns = [
            {
                text: 'Guardar',
                handler: this.guardarItem,
                scope: this
            },
            {
                text: 'Cancelar',
                handler: function() {
                    Ext.getCmp("edit-auditoria-win").close();
                }
            }
        ];


        GridEditarAuditoriaFormPanel.superclass.constructor.call(this, {
            autoHeight: true,
            autoWidth: true,
            id: 'form-auditoria',
            items: this.items,
            buttons: this.buttonns,
            tipo: this.tipo,
            accion: this.accion,
            idevento: this.idevento,
            idmaster: this.idmaster/*,
            detalle: this.detalle,
            evento: this.evento,*/
            
        });

        //this.addEvents({add:true});
    }

    Ext.extend(GridEditarAuditoriaFormPanel, Ext.form.FormPanel, {
        guardarItem: function() {
            //alert("<?= url_for("inoF/formAuditoriaGuardar") ?>?modo="+this.modo+"&idmaster="+ this.idmaster+"&tipo=E");
            var panel = Ext.getCmp("form-auditoria");

            var form = panel.getForm();
            var gridId = this.gridId;
            if (form.isValid()) {
                var grid = Ext.getCmp("grid-auditoria-panel");
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?= url_for("inoF/formAuditoriaGuardar") ?>",
                    //scope:this,
                    waitMsg: 'Guardando...',
                    params: {modo: this.modo, tipo: this.tipo, idmaster: this.idmaster, accion: this.accion, idevento: this.idevento},
                    waitTitle: 'Por favor espere...',
                    success: function(form, action) {
                        var res = Ext.util.JSON.decode(action.response.responseText);
                        if (res.info)
                        {
                            alert(res.info)
                        }
                        var win = Ext.getCmp("edit-auditoria-win");
                        if (win) {
                            win.close();
                        }
                        if (gridId) {
                            var grid = Ext.getCmp(gridId);
                            if (grid) {
                                grid.recargar();
                            }
                        }
                    },
                    // standardSubmit: false,
                    failure: function(form, action) {
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error" + (action.result ? ": " + action.result.errorInfo : "") + " " + (action.response ? "\n Codigo HTTP " + action.response.status : ""));
                    }//end failure block
                });
            } else {
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        cambiarTasaCambio: function() {
            var grid = Ext.getCmp("grid-deduccion-panel");
            var records = grid.store.getRange();
            for (var i = 0; i < records.length; i++) {
                var rec = records[i];
                rec.set("valor", rec.get("neto") * this.getValue());
            }
        },
        /**
         * Form onRender override
         */
        onRender: function() {
            // call parent
            FormHousePanel.superclass.onRender.apply(this, arguments);
            // set wait message target
            var store = Ext.getCmp("grid-house-panel").store;
            var records = store.getRange();

            if (this.idevento) {

                this.getForm().waitMsgTarget = this.getEl();
                var form = this.getForm();
                this.load({
                    url: '<?= url_for("inoF/datosGridAuditoriaFormPanel") ?>',
                    waitMsg: 'Cargando...',
                    params: {idevento: this.idevento,
                        modo: this.modo, tipo: this.tipo, accion: this.accion, idmaster: this.idmaster},
                    success: function(response, options) {
                        this.res = Ext.util.JSON.decode(options.response.responseText);
                        form.findField("evento").setRawValue(this.res.data.ca_asunto);
                        form.findField("detalle").setRawValue(this.res.data.ca_detalle);
                        form.findField("sucursal").setRawValue(this.res.data.ca_sucursal);
                        form.findField("valor").setRawValue(this.res.data.ca_valor);
                        form.findField("tcambio").setRawValue(this.res.data.ca_tcambio);
                        form.findField("moneda").setRawValue(this.res.data.ca_moneda);
                        form.findField("usucompromiso").setRawValue(this.res.data.ca_usucompromiso);
                        form.findField("cc").setRawValue(this.res.data.ca_cc);
                        var fecha = this.res.data.ca_fchcreado.substr(5,2)+'/'+this.res.data.ca_fchcreado.substr(8,2)+'/'+this.res.data.ca_fchcreado.substr(0,4);      
                        form.findField("fchcompromiso").setRawValue(fecha);
                        //form.findField("fchcompromiso").setRawValue('05/12/2013');
                    /*  )  */
                        form.findField("ids").setRawValue(this.res.data.ca_idempresa);
                        
                        //form.findField("ids").hiddenField.value = this.res.data.ids_id;                        
                    }

                });
            }
            //this.inoHouses.setValue(this.idhouse);

            //Ext.getCmp("edit-factura-win").close();

        }
    });

</script>

