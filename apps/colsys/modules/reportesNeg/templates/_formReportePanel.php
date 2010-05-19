<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

include_component("reportesNeg", "formTrayectoPanel");
include_component("reportesNeg", "formClientePanel");
include_component("reportesNeg", "formPreferenciasPanel");
include_component("reportesNeg", "formCorteGuiasPanel");

?>
<script type="text/javascript">


    FormReportePanel = function( config ){

        Ext.apply(this, config);

        var bodyStyle = 'padding: 5px 5px 5px 5px;';

        FormReportePanel.superclass.constructor.call(this, {
           //border:false,
        //frame:true,
        labelWidth:80,
        frame: true,
        buttonAlign: 'center',
        layout:'fit',
        id: "test",
        //standardSubmit: true,


        items: [{
                    xtype:'tabpanel',
                    activeTab: 2,
                    //defaults:{autoHeight: true},
                    //deferredRender:false,
                    autoHeight: true,
                    defaults:{
                        layout:'form',
                        // as we use deferredRender:false we mustn't
                        // render tabs into display:none containers
                        hideMode:'offsets'
                    },
                    items:[
                        new FormTrayectoPanel({bodyStyle:bodyStyle}) ,
                        new FormClientePanel({bodyStyle:bodyStyle}),
                        new FormPreferenciasPanel({bodyStyle:bodyStyle}),
                        new FormCorteGuiasPanel({bodyStyle:bodyStyle})
                    ]
        }],        
        buttons: [
            {
                text   : 'Guardar',
                formBind:true,
                scope:this,
                handler: function(){
                             var form  = Ext.getCmp("test").getForm();

                             if( form.isValid() ){
                                  form.submit({
                                    url: "<?=url_for("reportesNeg/guardarReporte")?>",
                                    //scope:this,
                                    waitMsg:'Guardando...',
                                    waitTitle:'Por favor espere...',
                                    success:function(response,options){

                                       alert("OK");

                                       //Ext.Msg.alert( "Msg "+response.responseText );
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
            },
            {
                text   : 'Cancelar'
            }
        ]


        });


    };

    Ext.extend(FormReportePanel, Ext.Panel, {
       

    });


</script>