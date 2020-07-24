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
include_component("widgets", "widgetParametros",array("caso_uso"=>"CU049,CU119,CU223"));
?>

<script type="text/javascript">


    PanelMasterAntecedentes = function( config ){

        Ext.apply(this, config);
        this.items = [{
                xtype: 'fieldset',
                title: 'General',
                autoHeight:true,
                layout:'column',
                columns: 2,
                items :
                    [
                    /*{
                        xtype: "hidden",
                        id: "impoexpo",
                        name: "impoexpo",
                        value: "<?=Constantes::IMPO?>"
                    },*/
                    {
                        xtype: "hidden",
                        id: "transporte",
                        value: "<?=Constantes::MARITIMO?>"
                    },
                    {
                        xtype: "hidden",
                        id: "reportes",
                        name: "reportes",
                        allowBlank: false

                    },
                    {
                        xtype: "hidden",
                        id: "imprimirorigen",
                        name: "imprimirorigen",
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
                        id: "idmaster",
                        name: "idmaster",
                        allowBlank: false
                    },
                    {
                        columnWidth:.5,
                        layout: 'form',
                        xtype: 'fieldset',
                        border:false,
                        defaultType: 'textfield',
                        items: [
                            new WidgetImpoexpo(
                            {
                                fieldLabel: 'Impoexpo',                        
                                id: 'impoexpo',
                                name:'impoexpo',
                                tabIndex:1,
                                value:'<?=Constantes::IMPO?>'
                           }),
                            new WidgetModalidad({fieldLabel: 'Modalidad',
                                id: 'modalidad',
                                name: 'modalidad',
                                linkTransporte: "transporte",
                                linkImpoexpo: "impoexpo",
                                allowBlank: false
                            }),
                            new WidgetCiudad({fieldLabel: 'Ciudad Origen.',
                                id: 'origen',
                                name: 'origen',
                                hiddenName: 'idorigen',
                                allowBlank: false
                            }),
                            new Ext.form.DateField({
                                name: "fchsalida",
                                fieldLabel: "Fecha de Salida",
                                format: "Y-m-d",
                                allowBlank: false
                            }),
                            {
                                name: "motonave",
                                fieldLabel: "Motonave",
                                type: 'textfield',
                                allowBlank: false
                            }
                            ,
                             {
                                name: "viaje",
                                fieldLabel: "No viaje",
                                type: 'textfield',
                                allowBlank: false
                            },
                            {
                                name: "observaciones",
                                id: 'observaciones',
                                fieldLabel: "Observaciones",
                                type: 'textfield',
                                width:330,
                                height:50
                                //allowBlank: false
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
                                allowBlank: false
                            }),
                            new Ext.form.DateField({
                                name: "fchllegada",
                                fieldLabel: "Fecha de Llegada",
                                format: "Y-m-d",
                                allowBlank: false
                            }) ,
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
                            }),
                            new WidgetParametros({
                                id:'tipo',
                                name:'tipo',
                                hiddenName:'ntipo',
                                fieldLabel: "Tipo",
                                caso_uso:"CU119",
                                width:200,
                                idvalor:"id"
                            }),
                            new WidgetParametros({
                                id:'emisionbl',
                                name:'emisionbl',
                                hiddenName: 'idemisionbl',
                                fieldLabel: "Emisión BL Master",
                                caso_uso:"CU223",
                                width:150,
                                idvalor:"id"
                            })
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

        PanelMasterAntecedentes.superclass.constructor.call(this, {
            loadMask: {msg:'Cargando...'},
            id: 'master-antecedentes'           
        });
    };

    Ext.extend(PanelMasterAntecedentes, Ext.form.FormPanel, {
        onRender: function(){
            PanelMasterAntecedentes.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();           
            if(typeof(this.idmaster)!="undefined" && this.idmasterf!="" )
            {
                this.load({
                    url:'<?=url_for("antecedentes/datosReferencia")?>',
                    waitMsg:'Cargando...',
                    params:{idmaster:this.idmaster},
                    success:function(response,options){
                        res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("linea").setRawValue(res.data.linea);
                        Ext.getCmp("linea").hiddenField.value = res.data.idlinea;
                        //Ext.getCmp("origen").setReadOnly(true);
                        //Ext.getCmp("destino").setReadOnly(true);
                        //Ext.getCmp("modalidad").setReadOnly(true);
                        Ext.getCmp("tipo").setValue(res.data.ntipo);
                        $("#tipo").attr("value",res.data.tipo);
                        Ext.getCmp("emisionbl").setValue(res.data.idemisionbl);
                        $("#emisionbl").attr("value",res.data.emisionbl);
                    }
                });
            }
        },
        guardar : function(){            
            var grid = Ext.getCmp("reportes-antecedentes");
            var form = this.getForm();
            var records = grid.getStore().getRange();
            var reportes = [];
            var imprimirorigen = [];

            for( var i=0; i<records.length; i++ ){                
                if( records[i].data.consecutivo!="" && records[i].data.consecutivo!="+" ){
                    reportes.push( records[i].data.consecutivo );
                    imprimirorigen.push( (records[i].data.sel==true) );
                }
            }
            if( reportes.length==0 ){
                Ext.MessageBox.alert('Error Message', "Debe colocar al menos un reporte");
                return false;
            }

            //form.findField("reportes").setValue( reportes.join("|") );
            //form.findField("imprimirorigen").setValue( imprimirorigen.join("|") );
            form.findField("reportes").setValue( JSON.stringify(reportes) );
            form.findField("imprimirorigen").setValue( JSON.stringify(imprimirorigen) );
         
            //var str = JSON.stringify(changes);
            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("antecedentes/guardarPanelMasterAntecedentes")?>",                    
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        if(action.result.idmaster){
                            var idmaster = action.result.idmaster;
                            document.location = "<?=url_for("antecedentes/verPlanilla")?>?idmaster="+idmaster;
                        }
                    },
                    failure:function(form,action){
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        }
    });
</script>
