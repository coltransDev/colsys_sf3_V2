<?php

$path=$_SERVER["SCRIPT_NAME"];
$cachedir = $config = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
$cachetime = 86400;
//$cachetime = 1;
$cacheext = 'colsys';

$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
//$trafico=$user->getIdtrafico();
$cachepage = md5("formReporteOtmmin");
$cachefile = $cachedir.$cachepage.'.'.$cacheext;
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

if (time() - $cachetime <$cachelast && $cache!="false" )
{
    readfile($cachefile);
}
else
{
    
ob_start();

include_component("widgets", "widgetTercero");
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetCiudad");
//include_component("widgets", "widgetAgente");
//include_component("widgets", "widgetSucursalAgente");
include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetMuelles");
include_component("reportesNegPlug", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo,"tipo"=>"4"));

include_component("widgets", "widgetBodega",array("modo"=>Constantes::MARITIMO,"impoexpo"=>Constantes::IMPO ));

?>
<script type="text/javascript">
    FormOrdenPanel = function( config ){
        
        Ext.apply(this, config);
        var bodyStyle = 'padding:5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        //if( this.editable )
        {
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
        FormOrdenPanel.superclass.constructor.call(this, {
            labelWidth:120,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,
            id:'idFormReportePanel',
            items: [ 
                {
                    xtype:"hidden",
                    id: 'transporte',
                    name: 'transporte',
                    value:'<?=  Constantes::MARITIMO?>'
                },
                {
                    xtype:"hidden",
                    id: 'impoexpo',
                    name: 'impoexpo',
                    value:'<?=Constantes::IMPO?>'
                }
                ,
                {
                    xtype:'fieldset',
                    title: 'Información general',
                    autoHeight:true,
                    layout:'column',
                    columns: 2,
                    defaults:{
                        columnWidth:0.5,
                        layout:'form',
                        border:false,
                        bodyStyle:'padding:4px'
                    },
                    items :
                    [
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetCiudad({fieldLabel: 'Puerto Origen',
                                                  id: 'origenimpo',
                                                  idciudad:"origenimpo",
                                                  hiddenName:"ca_origenimpo",
                                                  tipo:"1",
                                                  impoexpo:'<?=Constantes::IMPO?>',
                                                  tabIndex:1
                                                })
                                ,
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',                                                  
                                                  id: 'origen',
                                                  idciudad:"origen",
                                                  hiddenName:"idorigen",
                                                  tipo:"1",
                                                  impoexpo:'<?=Constantes::IMPO?>',
                                                  tabIndex:1
                                                }),
                                {
                                    fieldLabel: "Manifiesto",
                                    name: "manifiesto",
                                    id: "ca_manifiesto",
                                    width:200,
                                    tabIndex:7
                                },
                                {
                                    xtype: "datefield",
                                    fieldLabel: "Fecha de Arribo",
                                    id: "ca_fcharribo",
                                    name: "ca_fcharribo",
                                    format: 'Y-m-d'
                                },
                                new WidgetMuelles({
                                    fieldLabel: "Muelle",
                                        id: 'muelle',
                                        name: 'muelle',
                                        hiddenName: "idmuelle",
                                        value:'',
                                        hiddenValue:'',
                                        width:330
                                    })
                            ]
                        },
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetModalidad({fieldLabel: 'Tipo Envio',
                                                    id: 'modalidad',
                                                    hiddenName: "idmodalidad",
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo",
                                                    tabIndex:3
                                                    }),
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',                                                  
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino",
                                                  tipo:"1",
                                                  impoexpo:'<?=Constantes::IMPO?>',
                                                  tabIndex:7
                                                }),
                                {
                                    fieldLabel: "Hbl",
                                    name: "hbl",
                                    id: "ca_hbl",
                                    width:200,
                                    tabIndex:7
                                },
                                {
                                    fieldLabel: "Motonave",
                                    name: "ca_motonave",
                                    id: "ca_motonave",
                                    width:200,
                                    tabIndex:7
                                }
                            ]
                        }/*,                                                
                        {
                            columnWidth:1,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [
                                new WidgetAgente({fieldLabel: 'Agente',
                                                          linkImpoExpo: "impoexpo",
                                                          linkOrigen: "origen",
                                                          linkDestino: "destino",
                                                          linkListarTodos: "listar_todos",
                                                          id:"agente",
                                                          hiddenName:"idagente",
                                                          width:350,
                                                          tabIndex:8
                                                        }),
                                new WidgetSucursalAgente({fieldLabel: 'Sucursal',
                                                      linkAgente: "agente",
                                                      id:"sucursalagente",
                                                      hiddenName:"idsucursalagente",
                                                      width:250,
                                                      tabIndex:8
                                                    }),
                                {
                                    xtype: "checkbox",
                                    fieldLabel: "Listar todos",
                                    id: "listar_todos",
                                    name:"listar_todos",
                                    tabIndex:9
                                }
                            ]
                        }*/
                        
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Información del Proveedor',
                    autoHeight:true,
                    id:'panel-proveedor',
                    items: [
                        {
                           xtype:'button',
                           text: "Agregar",
                           handler:this.agregarProv,
                           tabIndex:10
                        },
                        {
                            xtype:'fieldset',
                            border:false,
                            layout:'column',
                            items: [
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Proveedor ",
                                    items: [
                                        new WidgetTercero({
                                            tipo: 'Proveedor',
                                            width: 400,
                                            name: "idproveedor0",
                                            hiddenName: "prov0",
                                            id:"proveedor0",
                                            tabIndex:11,
                                            autoSelect : false
                                           })
                                    ]
                                },
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Incoterms ",
                                    items: [
                                       new WidgetIncoterms(
                                       {
                                          id: 'terminos0',
                                          hiddenName:"incoterms0",
                                          width:200,
                                          tabIndex:12
                                        })
                                    ]
                                },
                                {
                                    layout:'column',
                                    border:false,
                                    title: "Orden",
                                    items: [
                                    {
                                        xtype: "textfield",
                                        name: "orden_pro0",
                                        id: "orden_pro0",
                                        width:200,
                                        tabIndex:13
                                    }
                                    ]
                                }
                            ]
                        }
                    ]
                },                
                new FormMercanciaPanel({tabIndex:14})
                ,
                {

                    xtype:'fieldset',
                    title: 'Información del Cliente',
                    autoHeight:true,
                    items: [
                        new WidgetTercero({fieldLabel:"Cliente",
                                            tipo: 'Consolcargo',
                                            width: 600,
                                            hiddenName: "idcliente",
                                            id:"cliente",
                                            name:"cliente",
                                            tabIndex:19
                                           }),
                        {
                            xtype: "textfield",
                            fieldLabel: "Orden Cliente",
                            name: "orden_clie",
                            id: "orden_clie",
                            width: 300,
                            tabIndex:17
                        },
                        new WidgetTercero({fieldLabel:"Importador",
                                            tipo: 'Importador',
                                            width: 600,
                                            hiddenName: "ca_idimportador",
                                            id:"idimportador",
                                            name:"idimportador",
                                            tabIndex:19
                                           })
                    ]
                },
                {

                    xtype:'fieldset',
                    title: 'Documentos',
                    autoHeight:true,
                    items: [
                        new WidgetTercero({fieldLabel:"Operador OTM ",
                                                    tipo: 'Consignatario',
                                                    width: 600,
                                                    hiddenName: "consig",
                                                    id:"idconsignatario",
                                                    tabIndex:19
                                                   })
                        ,
                        new WidgetBodega({fieldLabel:"Bodega Destino",
                                            id:"bodega_consignar",
                                            hiddenName:"idbodega_hd",
                                            width:500,                                            
                                            autoSelect:false
                                           })
                        /*,
                        new WidgetTercero({fieldLabel:"Notificar a",
                                                    tipo: 'Notify',
                                                    width: 600,
                                                    hiddenName: "notify",
                                                    id:"idnotify",
                                                    tabIndex:20
                                                   })
                        ,
                        new WidgetTercero({fieldLabel:"Representante",
                                                    tipo: 'Representante',
                                                    width: 600,
                                                    id: "idrepresentante",
                                                    hiddenName: "idrepres",
                                                    tabIndex:21
                                                   }),*/
                        /*{
                            xtype:'fieldset',
                            title:'Liberar A',
                            autoHeight:true,
                            layout:'column',
                            columns:2,
                            defaults:{
                                columnWidth:'0.5',
                                layout:'form',
                                border:false
                            },
                            items :[

                            {
                                columnWidth:'0.2',
                                layout:'form',
                                border:false,
                                defaultType:'textfield',
                                items: [
                                    {
                                        xtype:"radio",
                                        fieldLabel:"Coltrans",
                                        labelStyle:'width:150px',
                                        name:"liberacion",
                                        id:"liberacion_Coltrans",
                                        inputValue:"Coltrans"
                                    }
                                ]
                            },
                            {
                                columnWidth:'0.2',
                                layout:'form',
                                border:false,
                                defaultType:'textfield',
                                items: [                                    
                                    {
                                        xtype:"radio",
                                        fieldLabel:"Consolcargo",
                                        labelStyle:'width:150px',
                                        name:"liberacion_conf",
                                        id:"liberacion_Consolcargo",
                                        inputValue:"Consolcargo"
                                    }
                                ]
                            }
                            ]
                        }*/
                    ]
                },                
                {
                    xtype:'fieldset',
                    title:'Informaciones a:',
                    autoHeight:true,
                    layout:'column',
                    /*hidden:true,*/
                    columns:2,
                    items:[
                        {
                            border:false,
                            title:'Libreta de contactos',
                            autoHeight:true,
                            columns:2,
                            columnWidth:0.5,
                            items:[
                                <?
                                for( $i=0; $i<10; $i++ )
                                {
                                    if( $i!=0){
                                        echo ",";
                                    }
                                ?>
                                {
                                   border:false,
                                    title:'',
                                    autoHeight:true,
                                    layout:'column',
                                    columns:2,
                                    defaults:{

                                        layout:'form',
                                        border:false,
                                        hideLabels:true,
                                        border:true
                                    },
                                    items:[
                                        {
                                            defaultType:'textfield',
                                            items:[
                                                {
                                                    xtype:"textfield",
                                                    fieldLabel:"",
                                                    name:"contacto_<?=$i?>",
                                                    id:"contacto_<?=$i?>",
                                                    readOnly:false,
                                                    width:250,
                                                    height:20
                                                }
                                            ]
                                        },
                                        {
                                            defaults:{width:20},
                                            items:[
                                                {
                                                    xtype:"checkbox",
                                                    fieldLabel:"",
                                                    name:"chkcontacto_<?=$i?>",
                                                    id:"chkcontacto_<?=$i?>",
                                                    width:20,
                                                    height:20
                                                }

                                            ]
                                        }
                                    ]
                                }
                                <?
                                }
                                ?>
                            ]
                        }                        
                    ]
                 }
            ],
            buttons: this.buttons,
             listeners:{
                afterrender:this.onAfterload
            }
        });
    };
<?
    if($cache!="false")
    {
        $fp = fopen($cachefile, 'w');
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
    var i=0;
    var idreporte='<?=$idreporte?>';
    
    Ext.extend(FormOrdenPanel, Ext.form.FormPanel, {
        
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
                    url:"<?=url_for("ordenes/guardarOrdenesOtm")?>",
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    params:{opcion:opt,redirect:redire,idreporte:idreporte},
                    success:function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte con el consecutivo '+res.consecutivo);
                        idreporte=res.idreporte;
                        if(res.redirect=="true" || res.redirect==true)
                            location.href="<?=$path?>/ordenes/consultaOrden/id/"+idreporte;//"/colotm/ordenes/consultaOrden/id/"+res.idreporte;
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
                location.href="/ordenes/consultaOrden/id/"+idreporte;
            }
            else
            {
                location.href="/ordenes/index";
            }
        },
       onAfterload:function()
       {

       }     
        ,
        agregarProv:function()
        {
           tb=new Ext.Panel( {
                            border:false,
                            xtype:'fieldset',
                            layout:'column',
                            bodyCssClass:'x-fieldset',
                            items: [
                                new WidgetTercero({
                                            tipo: 'Proveedor',
                                            width: 400,
                                            name: "idproveedor"+(++i),
                                            hiddenName: "prov"+i,
                                            id:"proveedor"+i,
                                            autoSelect : false
                                           }),
                                new WidgetIncoterms({
                                      id: 'terminos'+i,
                                      hiddenName:"incoterms"+i,
                                      width:200
                                    }),
                                 {
                                    xtype: "textfield",
                                    name: "orden_pro"+i,
                                    id: "orden_pro"+i,
                                    width:200
                                }
                            ]
                        });
            tb.render('panel-proveedor');
        }
        ,onRender:function() {
            FormOrdenPanel.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            if(this.idreporte!="undefined" && this.idreporte!="" )
            {
                this.load({
                    url:'<?=url_for("ordenes/datosReporte")?>',
                    waitMsg:'cargando...',
                    params:{idreporte:this.idreporte},
                    success:function(response,options){
                        res = Ext.util.JSON.decode( options.response.responseText );
                        Ext.getCmp("cliente").setValue(res.data.idcliente);
                        $("#cliente").attr("value",res.data.cliente);

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

                        $("#idconsignatario").val(res.data.consignatario);
                        if(Ext.getCmp("idnotify"))
                        {
                            Ext.getCmp("idnotify").setValue(res.data.idnotify);
                            $("#idnotify").val(res.data.notify);
                        }
                        if(Ext.getCmp("idrepresentante"))
                        {
                            Ext.getCmp("idrepresentante").setValue(res.data.idrepresentante);
                            $("#idrepresentante").attr("value",res.data.representante);
                        }
                         Ext.getCmp("agente").setValue(res.data.idagente);
                        $("#agente").attr("value",res.data.agente);
                        
                        Ext.getCmp("muelle").setValue(res.data.idmuelle);
                        $("#muelle").attr("value",res.data.muelle);
                        
                        Ext.getCmp("idimportador").setValue(res.data.ca_idimportador);
                        $("#idimportador").attr("value",res.data.idimportador);
                        
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
                    }
                });
            }
        }        
    });
    //alert(idreporte);
</script>