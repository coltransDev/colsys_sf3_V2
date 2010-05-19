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

include_component("reportesNeg", "formAduanasPanel");
include_component("reportesNeg", "formSegurosPanel");

?>
<script type="text/javascript">


    FormReportePanel = function( config ){

        Ext.apply(this, config);

        var bodyStyle = 'padding: 5px 5px 5px 5px;';

        this.buttons = [];

        if( this.editable ){
            this.buttons.push( {
                text   : 'Guardar',
                formBind:true,
                scope:this,
                handler: this.onSave
            } );
        }

        if( this.nuevaVersion ){
            this.buttons.push( {
                text   : 'Nueva Version',
                formBind:true,
                scope:this,
                handler: this.onSave
            } );
        }

        if( this.copiar ){
            this.buttons.push( {
                text   : 'Copiar en nuevo reporte',
                formBind:true,
                scope:this,
                handler: this.onSave
            } );
        }

        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );

        FormReportePanel.superclass.constructor.call(this, {
           //border:false,
            //frame:true,
            labelWidth:80,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',            
            //standardSubmit: true,
            
            items: [{
                    xtype:'tabpanel',
                    activeTab: 0,
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
                        new FormCorteGuiasPanel({bodyStyle:bodyStyle}),
                        new FormAduanasPanel({bodyStyle:bodyStyle}),
                        new FormSegurosPanel({bodyStyle:bodyStyle})
                    ]
            }],
            buttons: this.buttons
        });
    };

    Ext.extend(FormReportePanel, Ext.form.FormPanel, {
        onSave: function(){            
            var form  = this.getForm();

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
        },
        onCancel: function(){

        },
        /**
        * Form onRender override
        */
        onRender:function() {

            // call parent
            FormReportePanel.superclass.onRender.apply(this, arguments);

            // set wait message target
            this.getForm().waitMsgTarget = this.getEl();

        } // eo function onRender

    });


</script>