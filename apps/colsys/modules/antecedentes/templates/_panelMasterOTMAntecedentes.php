<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("widgets", "widgetImpoexpo");
include_component("widgets", "widgetTransporte");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");
?>
<script type="text/javascript">
    PanelMasterOTMAntecedentes = function( config ){

        Ext.apply(this, config);
        this.items = [{
                xtype: 'fieldset',
                title: 'General',
                autoHeight:true,
                layout:'column',
                columns: 2,
                items :
                    [                    
                    {
                        xtype: "hidden",
                        id: "transporte",
                        value: "<?=Constantes::TERRESTRE?>"
                    },
                    {
                        xtype: "hidden",
                        id: "reportes",
                        name: "reportes",
                        allowBlank: false

                    },
                    {
                        xtype: "hidden",
                        id: "referencia",
                        name: "referencia",
                        allowBlank: false
                    },
                    {
                        xtype: "hidden",
                        id: 'impoexpo',
                        name:'impoexpo',                                
                        value:'<?=Constantes::OTMDTA?>'
                    },
                    {
                        xtype: "hidden",
                        id: "sel",
                        name: "sel",
                        allowBlank: false
                    },
                    {
                        columnWidth:.5,
                        layout: 'form',
                        xtype: 'fieldset',
                        border:false,
                        defaultType: 'textfield',
                        items: [
                            new WidgetModalidad({fieldLabel: 'Modalidad',
                                id: 'modalidad',
                                name: 'modalidad',
                                linkTransporte: "transporte",
                                linkImpoexpo: "impoexpo",
                                allowBlank: false,
                                listeners:{
                                    select : this.recargar
                                }
                            }),
                            new WidgetCiudad({fieldLabel: 'Ciudad Origen.',
                                id: 'origen',
                                name: 'origen',
                                hiddenName: 'idorigen',
                                allowBlank: false,
                                listeners:{
                                    select : this.recargar
                                }
                            }),
                            new Ext.form.DateField({
                                name: "fchsalida",
                                fieldLabel: "Fecha de Salida",
                                format: "Y-m-d",
                                allowBlank: false
                            }),
                            {
                                name: "motonave",
                                fieldLabel: "Vehiculo",
                                type: 'textfield',
                                allowBlank: false
                            }
                        ]
                    },
                    {
                        columnWidth:.5,
                        layout: 'form',
                        border:false,
                        xtype: 'fieldset',
                        defaultType: 'textfield',
                        items: [
                            new WidgetLinea({fieldLabel: 'Linea',
                                linkTransporte: "transporte",
                                name: 'linea',
                                id: 'linea',
                                hiddenName: 'idlinea',
                                allowBlank: false
                            }),
                            new WidgetCiudad({fieldLabel: 'Ciudad Destino',
                                id: 'destino',
                                name: 'destino',
                                hiddenName: 'iddestino',
                                allowBlank: false,
                                listeners:{
                                    select : this.recargar
                                }
                            }),
                            new Ext.form.DateField({
                                name: "fchllegada",
                                fieldLabel: "Fecha de Llegada",
                                format: "Y-m-d",
                                allowBlank: false
                            }),
                            {
                                name: "viaje",
                                fieldLabel: "No viaje",
                                type: 'textfield',
                                allowBlank: false
                            }/*,
                            {
                                name: "mbls",
                                fieldLabel: "Master",
                                type: 'textfield',
                                allowBlank: false
                            },
                            new Ext.form.DateField({
                                name: "fchmaster",
                                fieldLabel: "Fecha de Master",
                                format: "Y-m-d",
                                allowBlank: false
                            })*/
                        ]
                    }
                ]
            }];        
        this.tbar = [
            {
                text: 'Guardar',
                iconCls: 'disk',
                handler: this.guardar,
                scope: this
            }
        ];

        PanelMasterOTMAntecedentes.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            id: 'master-antecedentes'           
        });
    };

    Ext.extend(PanelMasterOTMAntecedentes, Ext.form.FormPanel, {
        onRender: function(){
            PanelMasterOTMAntecedentes.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();           
            if(typeof(this.numRef)!="undefined" && this.numRef!="" )
            {
                this.load({
                    url:'<?=url_for("antecedentes/datosReferencia")?>',
                    waitMsg:'Cargando...',
                    params:{numRef:this.numRef},
                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("linea").setRawValue(this.res.data.linea);
                        Ext.getCmp("linea").hiddenField.value = this.res.data.idlinea;
                        Ext.getCmp("origen").setReadOnly(true);
                        Ext.getCmp("destino").setReadOnly(true);
                        Ext.getCmp("modalidad").setReadOnly(true);
                    }
                });
            }
        },
        guardar : function(){
            var grid = Ext.getCmp("reportes-antecedentes");
            var form = this.getForm();

            var records = grid.getStore().getRange();
            var reportes = [];            

            for( var i=0; i<records.length; i++ ){                
                if( records[i].data.consecutivo!="" && records[i].data.consecutivo!="+" && records[i].data.sel==true ){
                    reportes.push( records[i].data.consecutivo );
                }
            }
            if( reportes.length==0 ){
                Ext.MessageBox.alert('Error Message', "Debe colocar al menos un reporte");
                return false;
            }
            form.findField("reportes").setValue( reportes.join("|") );

            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("antecedentes/guardarPanelMasterOTMAntecedentes")?>",                    
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        if(action.result.numref){
                            var numref = action.result.numref;
                            //alert("/ino/verReferencia/modo/5/idmaster/"+numref)
                            //document.location = "/inoF/verReferenciaExt4/modo/5/idmaster/"+numref;
                            document.location = "/inoF2/indexExt5/idmaster/"+numref;
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
        recargar : function(combo, record, index){
            
            Ext.getCmp("reportes-antecedentes").store.removeAll();
            load=false;
            if(Ext.getCmp("origen").getValue()!="" && Ext.getCmp("destino").getValue()!="" && Ext.getCmp("modalidad").getValue()!="")
            {
                Ext.getCmp("reportes-antecedentes").store.setBaseParam("origen",Ext.getCmp("origen").getValue());
                Ext.getCmp("reportes-antecedentes").store.setBaseParam("destino",Ext.getCmp("destino").getValue());
                Ext.getCmp("reportes-antecedentes").store.setBaseParam("modalidad",Ext.getCmp("modalidad").getValue());
                Ext.getCmp("reportes-antecedentes").store.load();
            }
        }
    });
</script>