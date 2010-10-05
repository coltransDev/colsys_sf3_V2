<?php
$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
include_component("reportesNeg", "formTrayectoPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
include_component("reportesNeg", "formClientePanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso,"nprov"=>$nprov  ));
include_component("reportesNeg", "formFacturacionPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
include_component("reportesNeg", "formPreferenciasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
include_component("reportesNeg", "formCorteGuiasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"reporte"=>$reporte,"permiso"=>$permiso));

if($impoexpo!="Triangulación")
{
include_component("reportesNeg", "formAduanasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
}
include_component("reportesNeg", "formSegurosPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
if($idreporte!="")
{
    include_component("widgets", "widgetReporte");
}
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

            <?
            if($idreporte)
            {
            ?>
                this.buttons.push( {
                text   : 'Importar',
                 handler: this.onImportar
            } );
            <?
            }
            ?>
        FormReportePanel.superclass.constructor.call(this, {
            labelWidth:80,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,            
            items: [{
                    xtype:'tabpanel',
                    deferredRender : false,
                    activeTab: 0,
                    autoHeight: true,
                    defaults:{
                        layout:'form',
                        hideMode:'offsets'
                    },
                    items:[
                        new FormTrayectoPanel({bodyStyle:bodyStyle,lazyRender:true}) ,
                        new FormClientePanel({bodyStyle:bodyStyle,lazyRender:true}),
						new FormFacturacionPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new FormPreferenciasPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new FormCorteGuiasPanel({bodyStyle:bodyStyle,lazyRender:true}),
                        <?
                        if($impoexpo!="Triangulación")
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
            if(opt!="1" && opt!="2")
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
                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                    }
                    ,
                    failure:function(form,action){
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique los siguientes campos<br>'+res.texto);
                    }//end failure block
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel: function(){
            location.href="/reportesNeg/index";
        }
<?
            if($idreporte)
            {
?>
        ,
        onImportar: function(){


            win = new Ext.Window({
                width       : 230,
                height      : 150,
                closeAction :'close',
                plain       : true,
                title       : "Importar reporte",
                items       : [
                    new WidgetReporte({fieldLabel: 'Reporte',
                                       width: 200,
                                       id: "reporte",
                                       hiddenName: "idreporte"
                                      })

                ]
                ,
                buttons: [
                    {
                        text     : 'Importar',
                        scope    : this,
                        handler  : function( ){
                            if(window.confirm("Desea realmente importar este reporte="))
                            {
                            //alert(Ext.getCmp("reporte").getValue());
                                idnew=Ext.getCmp("reporte").getValue();
                                Ext.Ajax.request(
                                {
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?=url_for("reportesNeg/importarReporte")?>',
                                    params :	{
                                        idreportenew: idnew,
                                        idreporte: <?=$reporte->getCaIdreporte()?>
                                    },
                                    //Ejecuta esta accion en caso de fallo
                                    //(404 error etc, ***NOT*** success=false)
                                        failure:function(response,options){
                                        alert( response.responseText );
                                        success = false;
                                    },
                                    //Ejecuta esta accion cuando el resultado es exitoso
                                    success:function(response,options){
                                        var res = Ext.util.JSON.decode( response.responseText );
                                        if( res.success ){
                                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                                        }
                                    }
                                });
                            }

                        }
                    },
                    {
                        text     : 'Cancelar',
                        handler  : function(){
                            win.close();
                        }
                    }
                ]
            });
            win.show( );


        }
<?
            }
?>
        ,
       onAfterload:function()
       {
<?
                foreach( $issues as $issue ){
                    $info = str_replace("\"", "'",str_replace("\n", "<br />",$issue["t_ca_title"].":<br />".$issue["t_ca_info"]));
                    ?>
                    info = "<?=$info?>";

                    <?
                    if(strlen($info)<400)
                    {
                    ?>
                    target = $('#<?=$issue["t_ca_field_id"]?>').addClass("help").attr("title",info);
                    <?
                    }
                    else
                    {
                    ?>
                    target = $('#<?=$issue["t_ca_field_id"]?>').addClass("helpL").attr("title",info);
                    <?
                    }
                    ?>
<?
                }
?>
                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
                $('.helpL').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "prettyL fancyL" });
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
                        res = Ext.util.JSON.decode( options.response.responseText );
                        if(Ext.getCmp('ca_colmas').getValue()=="Sí")
                            Ext.getCmp('aduanas').expand();
                        else
                            Ext.getCmp('aduanas').collapse();

                        if(Ext.getCmp('ca_seguro').getValue()=="Sí")
                            Ext.getCmp('seguros').expand();
                        else
                            Ext.getCmp('seguros').collapse();

                        Ext.getCmp("cotizacion").setValue(res.data.cotizacion);

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").attr("value",res.data.linea);

                        Ext.getCmp("cliente").setValue(res.data.idcliente);                        
                        $("#cliente").attr("value",res.data.cliente);

                        Ext.getCmp("bodega_consignar").setValue(res.data.idbodega_hd);
                        $("#bodega_consignar").attr("value",res.data.bodega_consignar);
                        for(i=0;i<<?=($nprov>0)?$nprov:0?>;i++)
                        {                            
                            //if(Ext.getCmp("proveedor"+i))
                            {
                                //alert(eval("res.data.idproveedor"+i));
                                if(Ext.getCmp("proveedor"+i))
                                {
                                    Ext.getCmp("proveedor"+i).setValue(eval("res.data.idproveedor"+i));
                                    $("#proveedor"+i).attr("value",eval("res.data.proveedor"+i));
                                }
                            }
                        }
                        for( i=0; i<20; i++ ){
                            if( Ext.getCmp("contacto_"+i) && Ext.getCmp("contacto_"+i).getValue()!="" ){
                                Ext.getCmp("contacto_"+i).setReadOnly( true );
                            }
                            if( Ext.getCmp("contacto_fijos"+i) && Ext.getCmp("contacto_fijos"+i).getValue()!="" ){
                                Ext.getCmp("contacto_fijos"+i).setReadOnly( true );
                            }
                        }

                        Ext.getCmp("origen").setValue(res.data.idorigen);
                        $("#origen").attr("value",res.data.origen);

                        Ext.getCmp("destino").setValue(res.data.iddestino);
                        $("#destino").attr("value",res.data.destino);
                        
                        Ext.getCmp("cliente-impoexpo").setValue(res.data.idclientefac);
                        $("#cliente-impoexpo").attr("value",res.data.clientefac);

                        if(Ext.getCmp("agente-impoexpo"))
                        {
                            Ext.getCmp("agente-impoexpo").setValue(res.data.idclienteag);
                            $("#agente-impoexpo").attr("value",res.data.clienteag);
                        }

                        if(Ext.getCmp("otro-aduana"))
                        {
                            Ext.getCmp("otro-aduana").setValue(res.data.idclienteotro);
                            $("#otro-aduana").attr("value",res.data.clienteotro);
                        }
                        if(!Ext.getCmp("idvendedor"))
                        {                            
                            Ext.getCmp("vendedor").setValue(res.data.idvendedor);
                            $("#vendedor").attr("value",res.data.vendedor);
                        }

                        Ext.getCmp("agente").setValue(res.data.idagente);
                        $("#agente").attr("value",res.data.agente);

                        //$("#cliente").attr("value",res.data.idcliente);
                        $("#notify").val(res.data.notify);


                        $("#idconsignatario").val(res.data.consignatario);

                        $("#idconsigmaster").val(res.data.consigmaster);
                       
                        if(res.data.idmodalidad=="CONSOLIDADO")
                        {
                            if(Ext.getCmp("PCorteMaster"))
                                Ext.getCmp("PCorteMaster").hide();
                            if(Ext.getCmp("PCorteHija"))
                                Ext.getCmp("PCorteHija").show();
                        }
                        else if(res.data.idmodalidad=="DIRECTO")
                        {
                            if(Ext.getCmp("PCorteHija"))
                                Ext.getCmp("PCorteHija").hide();
                            if(Ext.getCmp("PCorteMaster"))
                                Ext.getCmp("PCorteMaster").show();
                        }

                        if(Ext.getCmp("tipoexpo"))
                        {
                            Ext.getCmp("tipoexpo").setValue(res.data.idtipoexpo);
                            $("#tipoexpo").attr("value",res.data.tipoexpo);
                        }


                    }
                });
            }
            else
            {
                //Ext.getCmp('seguros').collapsed=true;
            }
        }
    });
</script>