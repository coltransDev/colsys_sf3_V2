<?php
//error_reporting(E_ALL);

//$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
$nprov = count($reporte->getProveedores());

//$cachedir = 'C:/desarrollo/colsys_sf3/apps/colsys/modules/reportesNeg/cache/';
//$cachedir = '/srv/www/colsys_sf3/apps/colsys/modules/reportesNeg/cache/';

$cachedir = $config = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
$cachetime = 86400;
$cacheext = 'colsys';
$cachepage = md5("formReporte-nprov-$nprov-tiporep-3");
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

include_component("widgets", "widgetCiudad");
include_component("reportesNeg", "formGeneralOsPanel");

include_component("reportesNeg", "formClientePanel",array("tiporep"=>"3","nprov"=>$nprov));

include_component("reportesNeg", "formPreferenciasPanel");


?>
<script type="text/javascript">
    FormReporteOsPanel = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding: 5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        
        this.buttons.push( {
            text   : 'Guardar',
            formBind:true,
            scope:this,
            handler: this.onSave
        } );
        this.buttons.push( {
            text   : 'Finalizar',
            formBind:true,
            scope:this,
            handler: this.onFinalizar
        } );


        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );

        FormReporteOsPanel.superclass.constructor.call(this, {
            labelWidth:80,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,
            id:'idFormReporteOsPanel',
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
                        new FormGeneralOsPanel({bodyStyle:bodyStyle,lazyRender:true}) ,
                        new FormClientePanel({bodyStyle:bodyStyle,lazyRender:true}),
                        new FormPreferenciasPanel({bodyStyle:bodyStyle,lazyRender:true})
                    ]
            }],
            buttons: this.buttons,
            listeners:{
                afterrender:this.onAfterload
            }
        });
    };

<?
    if($cache!="false")
    {
        $fp = fopen($cachefile, 'c');
        $cntACmp =ob_get_contents();
        ob_end_clean();
        $cntACmp=str_replace("\n",' ',$cntACmp);
        $cntACmp=ereg_replace('[[:space:]]+',' ',$cntACmp);
        fwrite($fp, ($cntACmp));
        //@fwrite($fp, trim(gzcompress($cntACmp,6)));
        fclose($fp);
    //    ob_end_flush();
        echo "<script>location.href=location.href.replace('cache/refresh','');</script>";
        exit;
    }

}
?>
var idreporte='<?=$idreporte?>';
    Ext.extend(FormReporteOsPanel, Ext.form.FormPanel, {        
        onFinalizar: function(){
            this.onSave("3");
        },
        onSave: function(opt){
            redire="false";

            if(opt!="3")
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
                    url: "<?=url_for("reportesNeg/guardarReporteOs")?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params: {opcion:opt,redirect:redire,idreporte:idreporte},
                    success: function(gridForm, action) {
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
                width       : '80%',
                height      : '80%',
                closeAction :'close',
                plain       : true,
                title       : "Importar reporte",
                items       : [
                    new listReportesPanel()
                ]
                ,
                buttons: [
                    {
                        text     : 'Importar',
                        scope    : this,
                        handler  : function( ){
                            if(window.confirm("Desea realmente importar este reporte?"))
                            {
                                idnew=Ext.getCmp("reporte").getValue();
                                Ext.Ajax.request(
                                {
                                    waitMsg: 'Guardando cambios...',
                                    url: '<?=url_for("reportesNeg/importarReporte")?>',
                                    params :	{
                                        idreportenew: idnew,
                                        idreporte: <?=$reporte->getCaIdreporte()?>
                                    },
                                        failure:function(response,options){
                                        alert( response.responseText );
                                        success = false;
                                    },

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
                /*foreach( $issues as $issue ){
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
                }*/
?>
                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
                $('.helpL').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "prettyL fancyL" });
       }
       ,
        onRender:function() {
            FormReporteOsPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            if(this.idreporte!="undefined" && this.idreporte!="" )
            {
                this.load({
                    url:'<?=url_for("reportesNeg/datosReporte")?>',
                    waitMsg:'cargando...',
                    params:{idreporte:this.idreporte},
                    success:function(response,options){
                        res = Ext.util.JSON.decode( options.response.responseText );
                    
                        Ext.getCmp("cotizacion").setValue(res.data.cotizacion);

                        Ext.getCmp("cliente").setValue(res.data.idcliente);
                        $("#cliente").attr("value",res.data.cliente);

                        /*for(i=0;i<<?=($nprov>0)?$nprov:0?>;i++)
                        {
                            {
                                if(Ext.getCmp("proveedor"+i))
                                {
                                    Ext.getCmp("proveedor"+i).setValue(eval("res.data.idproveedor"+i));
                                    $("#proveedor"+i).attr("value",eval("res.data.proveedor"+i));
                                }
                            }
                        };*/
                        for( i=0; i<20; i++ ){
                            if( Ext.getCmp("contacto_"+i) && Ext.getCmp("contacto_"+i).getValue()!="" ){
                                Ext.getCmp("contacto_"+i).setReadOnly( true );
                            };
                            if( Ext.getCmp("contacto_fijos"+i) && Ext.getCmp("contacto_fijos"+i).getValue()!="" ){
                                Ext.getCmp("contacto_fijos"+i).setReadOnly( true );
                            }
                        };

                        if(!Ext.getCmp("idvendedor"))
                        {
                            Ext.getCmp("vendedor").setValue(res.data.idvendedor);
                            $("#vendedor").attr("value",res.data.vendedor);
                        }
                    }
                });
            }
        }
    });
</script>
