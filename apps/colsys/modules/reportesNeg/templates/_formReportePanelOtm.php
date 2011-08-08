<?php
//error_reporting(E_ALL);

$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
$trafico=$user->getIdtrafico();

if($reporte->getCaIdreporte())
{
    include_component("reportesNeg","panelConceptosFletes", array("reporte"=>$reporte));
    $panelConceptos = true;

    if($reporte->getEsOtm())
    {
        include_component("reportesNeg","panelConceptosOtm", array("reporte"=>$reporte));
        $panelConceptosOtm = true;
    }
    else
        $panelConceptosOtm = false;

    /*if($reporte->getCaContinuacion()=="OTM")
    {
        include_component("reportesNeg","panelConceptosOtm", array("reporte"=>$reporte));
        $panelConceptosOtm = true;
    }
    else
        $panelConceptosOtm = false;
*/
    if( $reporte->getCaImpoexpo()!=Constantes::EXPO || $reporte->getCaTiporep()=="3" ){
            include_component("reportesNeg","panelRecargos", array("reporte"=>$reporte));
            $panelRecargos = true;
    }else{
        $panelRecargos = false;
    }


    if( ($reporte->getCaColmas()=="S�" && $reporte->getCaImpoexpo()!=Constantes::TRIANGULACION /*|| substr($reporte->getCaModalidad(),0,6) == "ADUANA"*/ ) || $reporte->getCaTiporep()=="3"){
       include_component("reportesNeg","panelRecargosAduana", array("reporte"=>$reporte));
       $panelAduana = true;
    }else{
       $panelAduana = false;
    }
}
else
{
    $panelConceptos = false;
    $panelConceptosOtm = false;
    $panelRecargos = false;
    $panelAduana = false;
}

$cachedir = $config = sfConfig::get('sf_app_module_dir').DIRECTORY_SEPARATOR."reportesNeg".DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
$cachetime = 14400;
$cacheext = 'colsys';
$cachepage = md5("formReporte-modo-$modo-impoexpo-$impoexpo-permiso-$permiso-nprov-$nprov-trafico-$trafico");
$cachefile = $cachedir.$cachepage.'.'.$cacheext;
//echo $cachefile;
$cache="false";
if($cache=="refresh")
{
    unlink($cachefile);
}
$cachelast=0;


if (file_exists($cachefile) ) {    
    $cachelast = filemtime($cachefile);
} else {
    $cachelast = 0;
}
clearstatcache();
//$cache="false";
if (time() - $cachetime <$cachelast && $cache!="false" )
{    
    readfile($cachefile);
}
else
{

    ob_start();
    include_component("reportesNeg", "formTrayectoPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso,"trafico"=>$trafico));
    include_component("reportesNeg", "formClientePanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso,"nprov"=>$nprov  ));
    include_component("reportesNeg", "formFacturacionPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
    include_component("reportesNeg", "formPreferenciasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));
    include_component("reportesNeg", "formCorteGuiasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"permiso"=>$permiso));

    if($impoexpo!="Triangulaci�n")
    {
        include_component("reportesNeg", "formAduanasPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
    }
    include_component("reportesNeg", "formSegurosPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
/*if($idreporte!="")
{
    include_component("widgets", "widgetReporte");
}*/
//include_component("reportesNeg", "listReportesPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));

    if($cache!="false")
    {
        $fp = fopen($cachefile, 'c');
        $cntACmp =ob_get_contents();
        ob_end_clean();
        $cntACmp=str_replace("\n",' ',$cntACmp);
        $cntACmp=ereg_replace('[[:space:]]+',' ',$cntACmp);
        fwrite($fp, ($cntACmp));
        fclose($fp);
        echo "<script>location.href=location.href.replace('cache/refresh','');</script>";
        exit;
    }

}
?>
<script type="text/javascript">
    FormReportePanel = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding:5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        if( this.editable ){
            this.buttons.push({
                text:'Guardar',
                formBind:true,
                scope:this,
                handler:this.onSave
            } );
            this.buttons.push({
                text:'Finalizar',
                formBind:true,
                scope:this,
                handler:this.onFinalizar
            } );
        }
       
        this.buttons.push({
                text:'Cancelar',
                 handler:this.onCancel
            });

        FormReportePanel.superclass.constructor.call(this, {            
            labelWidth:80,
            frame:true,
            buttonAlign:'center',
            layout:'fit',
            monitorValid:true,
            id:'idFormReportePanel',
            items:[{
                    xtype:'tabpanel',
                    deferredRender:false,
                    activeTab:0,
                    autoHeight:true,
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
                        if($impoexpo!="Triangulaci�n")
                        {
                        ?>
                        new FormAduanasPanel({bodyStyle:bodyStyle}),
                        <?
                        }
                        ?>
                        new FormSegurosPanel({bodyStyle:bodyStyle})
                        <?
                        if($panelConceptos)
                        {
                        ?>
                        ,new PanelConceptosFletes({
                            title:'Con. de fletes',
                            id:'panel-Fletes'
                        })
                        <?
                        }
                        if( $panelConceptosOtm ){
                        ?>
                            ,new PanelConceptosOtm({
                                title:'Otm',
                                id:'panel-Otm'
                            })
                        <?
                        }
                        if( $panelRecargos ){
                        ?>
                            ,new PanelRecargos({
                                title:'Rec. locales',
                                id:'panel-RecargosLocales',
                                transporte:'<?=$modo?>'
                            })
                        <?
                        }
                        if( $panelAduana ){
                        ?>
                        ,new PanelRecargosAduana({
                            title:'Rec. Aduana',
                            id:'panel-Recargos-Aduana'
                        })
                        <?
                    }
                    ?>
                    ]
            }],
            buttons:this.buttons,
            listeners:{
                afterrender:this.onAfterload
            }
        });
    };


var idreporte='<?=$idreporte?>';
    Ext.extend(FormReportePanel, Ext.form.FormPanel, {        
        onFinalizar:function(){
            this.onSave("3");
        },
        onSave:function(opt){
            redire="false";
            
            if(opt!="1" && opt!="2" && opt!="3")
                opt=0;
            else
            {
                redire="true";
                if(opt=="3" && (idreporte=="" || !idreporte) )
                {                    
                    opt=0;
                }                
            }
            if(!opt && !idreporte)
            {
                opt=0;
            }
            else if(!opt && idreporte!="")
            {opt="4"}

            var form  = this.getForm();
            if( form.isValid() ){
                form.submit({
                    url:"<?=url_for("reportesNeg/guardarReporte")?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params:{opcion:opt,redirect:redire,idreporte:idreporte},
                    success:function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte con el consecutivo '+res.consecutivo);
                        idreporte=res.idreporte;
                        if(res.redirect=="true" || res.redirect==true)
                            location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                    }
                    ,
                    failure:function(form,action){
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        if(res.err)
                            Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                        else
                            Ext.MessageBox.alert("Mensaje",'No es posible crear un reporte ya que posee errores en la digitacion, verifique los siguientes campos<br>'+res.texto);
                    }
                });
            }else{
                Ext.MessageBox.alert('Error Message', "Por favor complete todos los datos");
            }
        },
        onCancel:function(){
            if(idreporte>0)
            {
                location.href="/reportesNeg/consultaReporte/id/"+idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
            }
            else
            {
                location.href="/reportesNeg/index";
            }
        }
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
                $('.help').tooltip({track:true, fade:250, opacity:1, top:-15, extraClass:"pretty fancy" });
                $('.helpL').tooltip({track:true, fade:250, opacity:1, top:-15, extraClass:"prettyL fancyL" });
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
                        if(Ext.getCmp('ca_colmas'))
                        {
                            if(Ext.getCmp('ca_colmas').getValue()=="S�")
                                Ext.getCmp('aduanas').expand();
                            else
                                Ext.getCmp('aduanas').collapse();
                        }

                        if(Ext.getCmp('ca_seguro').getValue()=="S�")
                            Ext.getCmp('seguros').expand();
                        else
                            Ext.getCmp('seguros').collapse();
                        

                        Ext.getCmp("cotizacion").setValue(res.data.cotizacion);
                        if(Ext.getCmp("cotizacionotm"))
                            Ext.getCmp("cotizacionotm").setValue(res.data.cotizacionotm);

                        Ext.getCmp("linea").setValue(res.data.idlinea);
                        $("#linea").val(res.data.linea);
                        
                        Ext.getCmp("cliente").setValue(res.data.idcliente);
                        $("#cliente").attr("value",res.data.cliente);

                        Ext.getCmp("bodega_consignar").setValue(res.data.idbodega_hd);
                        $("#bodega_consignar").attr("value",res.data.bodega_consignar);
                        for(i=0;i<<?=($nprov>0)?$nprov:0?>;i++)
                        {
                            {
                                if(Ext.getCmp("proveedor"+i))
                                {
                                    Ext.getCmp("proveedor"+i).setValue(eval("res.data.idproveedor"+i));
                                    $("#proveedor"+i).attr("value",eval("res.data.proveedor"+i));
                                }
                            }
                        };
                        for( i=0; i<20; i++ ){
                            if( Ext.getCmp("contacto_"+i) && Ext.getCmp("contacto_"+i).getValue()!="" ){
                                Ext.getCmp("contacto_"+i).setReadOnly( true );
                            };
                            if( Ext.getCmp("contacto_fijos"+i) && Ext.getCmp("contacto_fijos"+i).getValue()!="" ){
                                Ext.getCmp("contacto_fijos"+i).setReadOnly( true );
                            }
                        };

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

                        Ext.getCmp("sucursalagente").setValue(res.data.idsucursalagente);
                        $("#sucursalagente").attr("value",res.data.sucursalagente);

                        if(Ext.getCmp("notify"))
                        {
                            Ext.getCmp("notify").setValue(res.data.idnotify);
                            $("#notify").val(res.data.notify);
                        }
                        $("#idconsignatario").val(res.data.consignatario);
                        /*if(Ext.getCmp("idconsigmaster"))
                        {                            
                            $("#idconsigmaster").val(res.data.consigmaster);
                        }*/



                        if(Ext.getCmp("idconsigmaster"))
                        {
                            Ext.getCmp("idconsigmaster").setValue(res.data.idconsigmaster);
                            $("#idconsigmaster").attr("value",res.data.consigmaster);
                        }

                        if(Ext.getCmp("idrepresentante"))
                        {
                            Ext.getCmp("idrepresentante").setValue(res.data.idrepresentante);
                            $("#idrepresentante").attr("value",res.data.representante);
                        }
//                        $("#tra_origen_id").val(res.data.tra_origen_id);
//                        $("#idtra_origen_id").val(res.data.idtra_origen_id);

//                        $("#tra_destino_id").val(res.data.tra_destino_id);

                        if(res.data.idmodalidad=="CONSOLIDADO")
                        {
                            /*if(Ext.getCmp("PCorteMaster"))
                            {
                                Ext.getCmp("PCorteMaster").hide();
                            }
                            if(Ext.getCmp("PCorteHija"))
                            {
                                Ext.getCmp("PCorteHija").show();
                            }*/
                        }
                        else if(res.data.idmodalidad=="DIRECTO")
                        {
                             if(Ext.getCmp("PCorteMaster"))
                                Ext.getCmp("PCorteMaster").hide();
                            if(Ext.getCmp("PCorteHija"))
                                Ext.getCmp("PCorteHija").show();
                        };

                        if(Ext.getCmp("tipoexpo"))
                        {
                            Ext.getCmp("tipoexpo").setValue(res.data.idtipoexpo);
                            $("#tipoexpo").attr("value",res.data.tipoexpo);
                        }
                        Ext.getCmp('panel-conceptos-fletes').store.reload();
                    }
                });
            }
        }
    });
</script>
