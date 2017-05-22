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
include_component("widgets", "widgetUsuario");

$eval = 0;
//$eventos = $sf_data->getRaw("eventos");
//probar sin el getRaw
?>
<script type="text/javascript">
    GridAuditoriaSeguimientoFormPanel = function( config ) {

        Ext.apply(this, config);
        this.ctxRecord = null;
       
         this.cc = {
         xtype:'textarea',
         fieldLabel: 'CC',
         name: 'cc',
         anchor: '95%'
         },
    
        
        this.detalleSeguimiento = {
            xtype: 'textarea',
            fieldLabel: 'Detalle',
            name: 'detalle',
            anchor: '95%',
            height: 150,
            allowBlank: false
        },
        
        this.responsableSeguimiento = new WidgetUsuario({
            fieldLabel: "Responsable",
            id: "usucompromiso",
            name: "usucompromiso",
            hiddenName: 'login',
            anchor: '95%',
            allowBlank: true
        });
        
        /*this.responsableFecha = {
            xtype: 'datefield',
            fieldLabel: "Fecha Respuesta",
            name: 'fchcompromiso',
            id: 'fchcompromiso',
            hiddenName: 'fchcompromiso',
            endDateField: 'end-date',
            anchor: '95%',
            allowBlank: false,
            format : "m/d/Y"
        };*/
        
        this.idAntecedente = {
            xtype: 'hidden',
            name: 'idAntedecente',
            allowBlank: false
        },
        
        this.resumenSeguimiento = {
            xtype:'hidden',
            fieldLabel: 'Resumen',
            name: 'evento',
            value: 'seg',
            allowBlank:false,
            anchor: '95%',
            tabIndex: 4
        },

        /*
        include_component("ino", "gridFacturacionWindow");
         **/
        this.items = [{
                xtype:'fieldset',
                buttonAlign: 'left',
                activeTab: 0,
                defaults:{autoHeight:true},
                deferredRender:false,
                items:[{
                        title:'Información General',
                        layout:'form',
                        bodyStyle:'padding:10px',
                        items: [
                            {
                                layout:'column',
                                border: false,
                                columns: 1,
                                defaults: {
                                    // applied to each contained panel
                                    bodyStyle:'padding-right:20px',
                                    border: false
                                },
                                items: [
                                    // Columna 1
                                    {
                                        layout: 'form',
                                        columnWidth:1,
                                        items: [
                                            this.resumenSeguimiento,
                                            this.detalleSeguimiento,   
                                            this.responsableSeguimiento,
                                            this.cc
                                            /*this.responsableFecha*/
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
                handler: function(){
                    Ext.getCmp("edit-auditoria-win").close();
                }
            }
        ];
       
        
        GridAuditoriaSeguimientoFormPanel.superclass.constructor.call(this, {            
            autoHeight: true,
            autoWidth: true,
            id: 'form-auditoria',
            items: this.items,
            buttons: this.buttonns,
            tipo: this.tipo,
            accion: this.accion,
            idevento: this.idevento,
            idmaster: this.idmaster
        });

        //this.addEvents({add:true});
    };

    Ext.extend(GridAuditoriaSeguimientoFormPanel, Ext.form.FormPanel, {
        guardarItem: function(){       
            //alert("<?= url_for("ino/formAuditoriaGuardar") ?>?modo="+this.modo+"&idmaster="+ this.idmaster+"&tipo=E");
            var panel  = Ext.getCmp("form-auditoria");
           
            var form = panel.getForm();
            var gridId = this.gridId;
            if( form.isValid() ){     
                var grid = Ext.getCmp("grid-auditoria-panel");                         
                var gridOpener = this.gridOpener;
                form.submit({
                    url: "<?= url_for("ino/formAuditoriaGuardar") ?>",
                    //scope:this,
                    waitMsg:'Guardando...',
                    params:{modo:this.modo, tipo:this.tipo, idmaster:this.idmaster, accion:this.accion, idevento:this.idevento},
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        if(res.info)
                        {
                            alert(res.info);
                        }
                        var win = Ext.getCmp("edit-auditoria-win");
                        if( win ){
                            win.close();
                        }
                        if( gridId ){
                            var grid = Ext.getCmp( gridId );
                            if( grid ){
                                grid.recargar();
                            }
                        }
                    },
                    // standardSubmit: false,
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        cambiarTasaCambio: function(){
            var grid = Ext.getCmp("grid-deduccion-panel");
            var records = grid.store.getRange();            
            for( var i=0; i<records.length; i++){
                var rec = records[i];
                rec.set("valor", rec.get("neto")*this.getValue());
            }
        },

        /**
         * Form onRender override
         */
        onRender:function() {
            // call parent
            FormHousePanel.superclass.onRender.apply(this, arguments);
            // set wait message target
            var store = Ext.getCmp("grid-house-panel").store;
            var records = store.getRange();
            

            
            if( this.idcomprobante ){
                this.getForm().waitMsgTarget = this.getEl();
                var form  = this.getForm();
                this.load({
                    url:'<?= url_for("ino/datosGridFacturacionFormPanel") ?>',
                    waitMsg:'Cargando...',
                    params:{idcomprobante:this.idcomprobante,
                        modo:this.modo, tipo:this.tipo, accion:this.accion},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        form.findField("ids").setRawValue(this.res.data.ids);
                        form.findField("ids").hiddenField.value = this.res.data.ids_id;                        
                    }

                });
            }
            //this.inoHouses.setValue(this.idhouse);
            
            //Ext.getCmp("edit-factura-win").close();
            
        }        
    });

</script>

