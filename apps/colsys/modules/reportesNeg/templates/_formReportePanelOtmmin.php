<?php

$cachedir = $config = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
$cachetime = 86400;
//$cachetime = 1;
$cacheext = 'colsys';

$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
$trafico=$user->getIdtrafico();
$cachepage = md5("formReporteOtmmin");
$cachefile = $cachedir.$cachepage.'.'.$cacheext;
//$cache=false;
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
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursalAgente");
include_component("widgets", "widgetIncoterms");

include_component("reportesNeg", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));

include_component("widgets", "widgetContactoCliente");
?>
<script type="text/javascript">
    FormReportePanelOtmmin = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding: 5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        
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

        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );

        /*this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Cliente',
                                                   width: 500,
                                                   id: "cliente",
                                                   hiddenName: "idcliente",
                                                   allowBlank:false,
                                                   displayField:"compania",
                                                   tabIndex:16,
                                                   tipo:"Agente"
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);*/

        this.tabindex=25;

        FormReportePanelOtmmin.superclass.constructor.call(this, {
            labelWidth:120,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,            
            items: [
                {
                    xtype: "hidden",
                    id: "transporte",
                    name: "transporte",
                    value:"<?=Constantes::MARITIMO?>"
                },
                {
                    xtype: "hidden",                    
                    id: "fchdespacho",
                    name: "fchdespacho",                    
                    value:'<?=date('Y-m-d')?>'                    
                },
                {
                    xtype: "hidden",                    
                    id: "impoexpo",
                    name: "impoexpo",
                    value:'<?=  Constantes::IMPO?>'                    
                },
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
                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',                                                  
                                                  id: 'origen',
                                                  idciudad:"origen",
                                                  hiddenName:"idorigen",
                                                  tipo:"2",
                                                  impoexpo:"impoexpo",
                                                  tabIndex:1
                                                })
                            ]
                        },
                        {
                            columnWidth:.5,
                            layout: 'form',
                            border:false,
                            defaultType: 'textfield',
                            items: [                                
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',                                                  
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino",
                                                  tipo:"2",
                                                  impoexpo:"impoexpo",
                                                  tabIndex:7
                                                }),
                                new WidgetModalidad({fieldLabel: 'Tipo Envio',
                                                    id: 'modalidad',
                                                    hiddenName: "idmodalidad",
                                                    linkTransporte: "transporte",
                                                    linkImpoexpo: "impoexpo",
                                                    tabIndex:3
                                                    })
                            ]
                        }
                        ,
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
                        }
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
                }
                ,
                new FormMercanciaPanel({tabIndex:14}),
                {

                    xtype:'fieldset',
                    title: 'Información del Cliente',
                    autoHeight:true,
                    items: [                        
                        /*this.wgContactoCliente,
                        {
                            xtype: "hidden",
                            id: "idconcliente",
                            name: "idconcliente"
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Contacto",
                            name: "contacto",
                            id: "contacto",
                            readOnly: true,
                            width: 600
                        },*/
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
                        }                        
                        
                    ]
                },
                {

                    xtype:'fieldset',
                    title: 'Documentos',
                    autoHeight:true,
                    items: [
                        new WidgetTercero({fieldLabel:"Consignatario",
                                                    tipo: 'Consignatario',
                                                    width: 600,
                                                    hiddenName: "consig",
                                                    id:"idconsignatario",
                                                    tabIndex:19
                                                   })
                        ,
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
                                                   })
                    ]
                }
                ,
                {
                    xtype:'fieldset',
                    title:'Informaciones a:',
                    autoHeight:true,
                    layout:'column',
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
                                for( $i=0; $i<20; $i++ )
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
                        ,
                        {
                            border:false,
                            title:'Contactos fijos',
                            autoHeight:true,
                            columnWidth:0.5,
                            items:[
                                <?
                                for( $i=0; $i<20; $i++ )
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
                                                    name:"contacto_fijos<?=$i?>",
                                                    id:"contacto_fijos<?=$i?>",
                                                    readOnly:true,
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
                                                    name:"chkcontacto_fijos<?=$i?>",
                                                    id:"chkcontacto_fijos<?=$i?>",
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
        //@fwrite($fp, trim(gzcompress($cntACmp,6)));
        fclose($fp);
    //    ob_end_flush();
        echo "<script>location.href=location.href.replace('cache/refresh','');</script>";
        exit;
    }
}
?>
    var i=0;
    var idreporte='<?=$idreporte?>';
    Ext.extend(FormReportePanelOtmmin, Ext.form.FormPanel, {
        
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
                    url:"<?=url_for("reportesNeg/guardarReporteOtm")?>",
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
       },
       onSelectContactoCliente: function( combo, record, index){

            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );
            
            store=combo.store;
            j=0;
            confirmacionesF=new Array();
            {
                store.each( function( r ){
                    if(r.data.compania==record.get("compania") && r.data.fijo && r.data.email!="")
                    {
                        if( Ext.getCmp("contacto_fijos"+j) ){
                            Ext.getCmp("contacto_fijos"+j).setValue(r.data.email);
                            Ext.getCmp("contacto_fijos"+j).setReadOnly( false );
                            Ext.getCmp("chkcontacto_fijos"+j).setValue( true );
                            confirmacionesF.push(r.data.email);
                            j++;
                        }
                    }
                });
            }


            var confirmar =  record.get("confirmar") ;
			var brokenconfirmar="";
			if(confirmar)
			{
				brokenconfirmar=confirmar.split(",");
				var i=0;
				for(i=0; i<brokenconfirmar.length; i++){
					Ext.getCmp("contacto_"+i).setValue(brokenconfirmar[i]);
					Ext.getCmp("contacto_"+i).setReadOnly( true );
					Ext.getCmp("chkcontacto_"+i).setValue( true );
				}
			}
			for( i=brokenconfirmar.length; i<20; i++ ){
				if( Ext.getCmp("contacto_"+i) ){
					Ext.getCmp("contacto_"+i).setValue("");
					Ext.getCmp("contacto_"+i).setReadOnly( false );
					Ext.getCmp("chkcontacto_"+i).setValue( false );
				}
			}
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
            FormReportePanelOtmmin.superclass.onRender.apply(this, arguments);
            this.getForm().waitMsgTarget = this.getEl();
            if(this.idreporte!="undefined" && this.idreporte!="" )
            {
                this.load({
                    url:'<?=url_for("reportesNeg/datosReporte")?>',
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
                        if(Ext.getCmp("notify"))
                        {
                            Ext.getCmp("notify").setValue(res.data.idnotify);
                            $("#notify").val(res.data.notify);
                        }

                        if(Ext.getCmp("idrepresentante"))
                        {
                            Ext.getCmp("idrepresentante").setValue(res.data.idrepresentante);
                            $("#idrepresentante").attr("value",res.data.representante);
                        }
                         Ext.getCmp("agente").setValue(res.data.idagente);
                        $("#agente").attr("value",res.data.agente);
                        
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
</script>
