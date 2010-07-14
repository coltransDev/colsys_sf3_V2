<?php
include_component("reportesNeg", "formTrayectoPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
include_component("reportesNeg", "formClientePanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
include_component("reportesNeg", "formPreferenciasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
include_component("reportesNeg", "formCorteGuiasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));

if($impoexpo!="Triangulaci�n")
{
include_component("reportesNeg", "formAduanasPanel");
}
include_component("reportesNeg", "formSegurosPanel");

?>
<script type="text/javascript">
    FormReportePanel = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding: 5px 5px 5px 5px;';
        this.res="";
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
                handler: this.onNuevaVersion
            } );
        }
        if( this.copiar ){
            this.buttons.push( {
                text   : 'Copiar en nuevo reporte',
                formBind:true,
                scope:this,
                handler: this.onCopiar
            } );
        }
        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );
        FormReportePanel.superclass.constructor.call(this, {
            labelWidth:80,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,            
            items: [{
                    xtype:'tabpanel',
                    activeTab: 0,
                    autoHeight: true,
                    defaults:{
                        layout:'form',
                        hideMode:'offsets'
                    },
                    items:[
                        new FormTrayectoPanel({bodyStyle:bodyStyle}) ,
                        new FormClientePanel({bodyStyle:bodyStyle}),
                        new FormPreferenciasPanel({bodyStyle:bodyStyle}),
                        new FormCorteGuiasPanel({bodyStyle:bodyStyle}),
                        <?
                        if($impoexpo!="Triangulaci�n")
                        {
                        ?>
                        new FormAduanasPanel({bodyStyle:bodyStyle}),
                        <?
                        }
                        ?>
                        new FormSegurosPanel({bodyStyle:bodyStyle})
                    ]
            }],
            buttons: this.buttons,
            listeners:{
                afterrender:this.onAfterload
            }
        });
    };

    Ext.extend(FormReportePanel, Ext.form.FormPanel, {
        onNuevaVersion: function(){
            this.onSave("2");
        },

        onCopiar: function(){
            this.onSave("1");
        },

        onSave: function(opt){
            if(opt!="1" || opt!="2")
                opt=0;
            var form  = this.getForm();

            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("reportesNeg/guardarReporte?idreporte=".$idreporte)?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params: {opcion:opt},                    
                    success: function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte');
                        if(res.redirect)                            
                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/idcategory/<?=$idcategory?>";
                    }
                    ,
                    failure:function(form,action){
                        Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique');
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){
        },
       onAfterload:function()
       {
<?
                foreach( $issues as $issue ){
                    $info = str_replace("\"", "'",str_replace("\n", "<br />",$issue["t_ca_title"].":<br />".$issue["t_ca_info"]));
                    ?>
                    info = "<?=$info?>";

                    target = $('#<?=$issue["t_ca_field_id"]?>').addClass("help").attr("title",info);
<?
                }
?>
                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
       }
       ,
        onRender:function() {
            FormReportePanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();            
            if(this.idreporte!="undefined" && this.idreporte!="" )
            {
                this.load({
                    url:'<?=url_for("reportesNeg/datosReporte")?>',
                    waitMsg:'cargando...',
                    params:{idreporte:this.idreporte},

                    success:function(response,options){
                        this.res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp('aduanas').collapsed=(Ext.getCmp('ca_colmas').getValue()=="S�")?false:true;
                        Ext.getCmp('seguros').collapsed=(Ext.getCmp('ca_seguro').getValue()=="S�")?false:true;
                        $("#cliente").attr("value",res.data.idcliente);
                    }                    
                });
            }
        }
    });
</script>