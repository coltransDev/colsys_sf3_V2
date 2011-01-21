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
                    /*
                     * =========================Column 1 =========================
                     **/
                    {
                        xtype: "hidden",
                        id: "impoexpo",
                        name: "impoexpo",
                        value: "<?=Constantes::IMPO?>"
                    },
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
                                allowBlank: false
                            }),

                            new WidgetCiudad({fieldLabel: 'Ciudad Origen',
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
                                id: 'idlinea',
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
                            }
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
            //boxMinHeight: 300,
            
            id: 'master-antecedentes'
            //tbar: this.tbar,
            

        });
        

    };

    Ext.extend(PanelMasterAntecedentes, Ext.form.FormPanel, {
        onRender: function(){
            // call parent
            PanelMasterAntecedentes.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();           
            if(typeof(this.numRef)!="undefined" && this.numRef!="" )
            {
                this.load({
                    url:'<?=url_for("antecedentes/datosReferencia")?>',
                    waitMsg:'Cargando...',
                    params:{numRef:this.numRef},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("idlinea").setRawValue(this.res.data.linea);
                        Ext.getCmp("idlinea").hiddenField.value = this.res.data.idlinea;
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
                if( records[i].data.consecutivo!="" && records[i].data.consecutivo!="+" ){
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
                    url: "<?=url_for("antecedentes/guardarPanelMasterAntecedentes")?>",
                    //scope:this,
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success:function(form,action){
                        if(action.result.numref){
                            var numref = action.result.numref;
                            document.location = "<?=url_for("antecedentes/verPlanilla")?>?ref="+numref.split(".").join("|");
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
        }

    });

</script>