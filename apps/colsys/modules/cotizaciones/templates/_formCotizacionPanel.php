<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_component("widgets", "widgetTercero");

/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */
include_component("cotizaciones", "fieldsEncabezado");
?>
<script type="text/javascript">
    var bodyStyle = "padding: 5px";
    FormCotizacionPanel = function( config ){
        Ext.apply(this, config);

        FormCotizacionPanel.superclass.constructor.call(this, {
            buttonAlign:'center',
            autoHeight:true,
            deferredRender:false,
            defaults:{labelWidth: 120},
            items:[
                {
                    xtype:'tabpanel',
                    deferredRender:false,
                    activeTab:0,
                    autoHeight:true,
                    tbar: [{
                            id:'guardar-encabezado-btn',
                            text: 'Guardar Encabezado',
                            iconCls: 'disk',
                            handler : this.guardarEncabezadoForm,
                            scope: this
                        }],
                    defaults:{
                        layout:'form',
                        hideMode:'offsets',
                        autoWidth:true
                    },

                    items:[
                        new TabGeneralPanel({bodyStyle:bodyStyle,lazyRender:true, idcotizacion: this.idcotizacion}),
                        new TabEntradaPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new TabSalidaPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new TabIdgPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new TabFormatoPanel({bodyStyle:bodyStyle,lazyRender:true})
                    ]
                }
            ]

        });
    };
    Ext.extend(FormCotizacionPanel,Ext.form.FormPanel,{

        guardarEncabezadoForm: function(){

            form = this.getForm();

            if( form.findField("listaclinton").getValue()=="Sí" ){
                Ext.MessageBox.alert("Alerta","Este cliente se encuentra en lista clinton");
                return 0;
            }

            if( form.findField("status").getValue()=="Vetado" ){
                Ext.MessageBox.alert("Alerta","Este cliente se encuentra vetado");
                return 0;
            }


            if( form.isValid() ){
                
                Ext.getCmp("guardar-encabezado-btn").disable();

                form.submit({url:'<?= url_for('cotizaciones/formCotizacionGuardar') ?>',
                    waitMsg:'Salvando Datos básicos de la Cotizaci&oacute;n...',
                    success:function(form,action){
                        <?
                        if( !$cotizacion->getCaIdcotizacion() || !$tarea ){
                        ?>
                            document.location='<?= url_for("cotizaciones/consultaCotizacion?id=") ?>'+action.result.idcotizacion;
                        <?
                        }else{
                        ?>
                            Ext.getCmp("guardar-encabezado-btn").enable();
                        <?
                        }
                        ?>
                    },
                    failure:function(form,action){
                        Ext.getCmp("guardar-encabezado-btn").enable();
                        Ext.MessageBox.alert('Error Message', "Se ha presentado un error"+(action.result?": "+action.result.errorInfo:"")+" "+(action.response?"\n Codigo HTTP "+action.response.status:""));
                    }
                });
            }else{
                Ext.MessageBox.alert('Sistema de Cotizaciones - Error:', '¡Atención: La información básica de la cotización no es válida o está incompleta!');
            }
        },

        onRender:function() {

            FormCotizacionPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            var form = this.getForm();
            this.load({
                url:'<?= url_for("cotizaciones/datosEncabezado") ?>',
                waitMsg:'cargando...',
                params:{idcotizacion:this.idcotizacion},
                success:function(response,options){
                    res = Ext.util.JSON.decode( options.response.responseText );                    
                    form.findField("vendedor").hiddenField.value = res.data.idvendedor;
                    Ext.getCmp("entradaColtrans").setValue( res.data.entrada);
                    Ext.getCmp("entradaColmas").setValue( res.data.entradaColmas);
                    Ext.getCmp("anexosColtrans").setValue( res.data.anexos);
                    Ext.getCmp("anexosColmas").setValue( res.data.anexosColmas);
                }
            });

        }
    });
</script>