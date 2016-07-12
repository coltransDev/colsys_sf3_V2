<?php

$cachedir = $config = sfConfig::get('app_digitalFile_root').DIRECTORY_SEPARATOR."cache".DIRECTORY_SEPARATOR;
$cachetime = 86400;
$cacheext = 'colsys';


//$nprov=count(explode("|", $reporte->getCaIdproveedor() ));
$nprov = count($reporte->getProveedores());
$trafico=$user->getIdtrafico();
$cachepage = md5("formReporteAG/dep/$dep/impoexpo/$impoexpo/email/$email/nprov-$nprov/rep/".($idreporte>0)."/trafico/$trafico");
$cachefile = $cachedir.$cachepage.'.'.$cacheext;

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
include_component("widgets", "widgetComerciales");
include_component("widgets", "widgetIncoterms");

//if(!$modo ||  $modo=="")
    include_component("widgets", "widgetTransporte");
//if(!$impoexpo)
    include_component("widgets", "widgetImpoexpo");
include_component("reportesNegPlug", "formMercanciaPanel",array("modo"=>$modo,"impoexpo"=>$impoexpo));
include_component("reportesNeg", "formContinuacionPanel",array("tipo"=>"AG","modo"=>$modo,"impoexpo"=>$impoexpo));

include_component("widgets", "widgetContactoCliente");
?>
<script type="text/javascript">
    FormReportePanelAg = function( config ){
        Ext.apply(this, config);
        var bodyStyle = 'padding: 5px 5px 5px 5px;';
        this.res="";
        this.buttons = [];
        
        this.buttons.push( {
            text   : '<?=($idreporte>0)?"Copiar":"Guardar"?>',
            formBind:true,
            scope:this,
            handler: this.onSave
        } );        

        this.buttons.push( {
                text   : 'Cancelar',
                 handler: this.onCancel
            } );

        this.wgContactoCliente = new WidgetContactoCliente({fieldLabel: 'Cliente',
                                                   width: 500,
                                                   id: "cliente",
                                                   hiddenName: "idcliente",
                                                   allowBlank:false,
                                                   displayField:"compania",
                                                   tabIndex:16
                                                  });

        this.wgContactoCliente.addListener("select", this.onSelectContactoCliente, this);

        this.wgImpoexpo=new WidgetImpoexpo({fieldLabel: 'Impoexpo',
                                                id: 'impoexpo',
                                                name:'impoexpo',
                                                tabIndex:2,
                                                value:'<?=$impoexpo?>'
                                               });
        this.wgImpoexpo.addListener("select", this.onSelectImpoexpo, this);

        this.tabindex=25;

        FormReportePanelAg.superclass.constructor.call(this, {
            labelWidth:120,
            frame: true,
            buttonAlign: 'center',
            layout:'fit',
            monitorValid:true,
            fileUpload : true,
            items: [
                {
                    xtype:'fieldset',
                    title: 'General',
                    autoHeight:true,
                    layout:'form',
                    defaults: {width: 200},
                    items :
                    [
                        {
                            xtype: "datefield",
                            fieldLabel: "Fecha de Despacho",
                            id: "fchdespacho",
                            name: "fchdespacho",
                            format: 'Y-m-d',
                            value:'<?=date('Y-m-d')?>',
                            tabIndex:1
                        }
                        <?
                        if($dep==14 || $dep==13 || $dep==16)
                        {
                        ?>
                        ,                        
                            new WidgetParametros({
                                            fieldLabel: "Correo Envio",
                                            id: 'send_email',
                                            hiddenName: 'email_send',
                                            caso_uso: "CU092",
                                            width:150,
                                            idvalor:"valor",
                                            value:"<?=$email?>",
                                            hiddenValue:"<?=$email?>"
                                            })
                         <?
                        }
                         ?>
                        
                    ]
                },
                {
                    xtype:'fieldset',
                    title: 'Información del trayecto',
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
                                <?
                                //if(!$modo ||  $modo=="")
                                {
                                ?>
                                new WidgetTransporte({fieldLabel: 'Transporte',
                                                id: 'transporte',
                                                name:'transporte',
                                                tabIndex:2,
                                                value:'<?=$modo?>'
                                               })
                                <?
                                }/*else
                                {
                                ?>
                                   {
                                        xtype:"hidden",
                                        id: 'transporte',
                                        name: 'transporte',
                                        value:'<?=$modo?>'
                                    }
                                <?
                                }*/
                                ?>
                                               ,
                                               this.wgImpoexpo
                                ,

                                new WidgetCiudad({fieldLabel: 'Ciudad Origen',
                                                  
                                                  id: 'origen',
                                                  idciudad:"origen",
                                                  hiddenName:"idorigen",
                                                  tipo:"1",
                                                  impoexpo:"impoexpo",
                                                  tabIndex:5                                                  
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
                                                    })
                                ,
                                new WidgetCiudad({fieldLabel: 'Ciudad Destino',                                                  
                                                  id: 'destino',
                                                  idciudad:"destino",
                                                  hiddenName:"iddestino",
                                                  tipo:"2",
                                                  impoexpo:"impoexpo",
                                                  tabIndex:7
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
                new FormContinuacionPanel()
                ,
                new FormMercanciaPanel({tabIndex:14}),
                {

                    xtype:'fieldset',
                    title: 'Información del Cliente',
                    autoHeight:true,
                    items: [
                        this.wgContactoCliente,
                        {
                            xtype:"label",
                            id:"img_cli",
                            name:"img_cli"
                        }
                        ,
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
                        },
                        {
                            xtype: "textfield",
                            fieldLabel: "Orden Cliente",
                            name: "orden_clie",
                            id: "orden_clie",
                            width: 300,
                            tabIndex:17
                        },
                        {
                            xtype: "hidden",
                            fieldLabel: "Lib. Automatica",
                            name: "ca_liberacion",
                            id: "ca_liberacion",
                            readOnly: true,
                            width: 100
                        },
                        {
                            xtype: "hidden",
                            fieldLabel: "Tiempo de Crédito",
                            name: "ca_tiempocredito",
                            id: "ca_tiempocredito",
                            readOnly: true,
                            width: 100
                        },
                           new WidgetComerciales({fieldLabel: 'Vendedor',
                                    id: 'vendedor',
                                    name: 'vendedor',
                                    hiddenName: "idvendedor",
                                    tabIndex:18
                                    })

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
                },
                {

                    xtype:'fieldset',
                    title: 'Mensaje para el Representante Comercial',
                    autoHeight:true,
                    items: [
                        {
                            xtype: "textfield",
                            fieldLabel: "Asunto",
                            name: "asunto",
                            id: "asunto",
                            width: 200,
                            value:"Nuevo Reporte AG",
                            tabIndex:22
                        }
                        ,
                        {
                            xtype: 'textarea',
                            fieldLabel: 'Mensaje adicional',
                            name: 'mensaje_comercial',
                            width: 600,
                            grow: true,
                            id:"mensaje_comercial",
                            enableFont: false,
                            enableFontSize: false,
                            enableLinks:  false,
                            enableSourceEdit : false,
                            enableColors : false,
                            enableLists: false,
                            tabIndex:23
                        },
                        {
                            xtype: 'fileuploadfield',
                            id: 'archivo',
                            name:'archivo',
                            width: 250,
                            fieldLabel: 'Adjuntar',
                            emptyText: 'Seleccione un archivo',
                            buttonCfg: {
                                text: '',
                                iconCls: 'upload-icon'
                            },
                            tabIndex:24
                        }
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
    Ext.extend(FormReportePanelAg, Ext.form.FormPanel, {
        
        onSave: function(opt){
            if(!this.idreporte)
            {
                opt=0;
                this.idreporte=0;
            }
            else
                opt=1;

            var form  = this.getForm();
            if( form.isValid() ){
                form.submit({
                    url: "<?=url_for("reportesNeg/guardarReporteAg")?>",
                    params:{opcion:opt,idreporte:this.idreporte},
                    waitMsg:'Guardando...',
                    waitTitle:'Por favor espere...',
                    success: function(gridForm, action) {
                        var res = Ext.util.JSON.decode( action.response.responseText );
                        alert('Se guardo correctamente el reporte');
                        if(window.confirm('Desea enviar status inmediatamente?'))
                        {
                            if(res.transporte=='<?=Constantes::AEREO?>')
                                location.href="/traficos/listaStatus/modo/aereo/reporte/"+res.consecutivo;
                            else
                                location.href="/traficos/listaStatus/modo/maritimo/reporte/"+res.consecutivo;
                        }
                        else
                        {
                            location.href="/reportesNeg/verReporte/id/"+res.idreporte+"/modo/"+res.transporte+"/impoexpo/"+res.impoexpo;
                        }
                    }
                    ,
                    failure:function(gridForm, action){
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
        },
       onAfterload:function()
       {
<?
            if($issues){
                foreach( $issues as $issue ){
                    $info = str_replace("\"", "'",str_replace("\n", "<br />",$issue["t_ca_title"].":<br />".$issue["t_ca_info"]));
                    ?>
                    info = "<?=$info?>";
                    target = $('#<?=$issue["t_ca_field_id"]?>').addClass("help").attr("title",info);
<?
                }
            }
?>
                $('.help').tooltip({track: true, fade: 250, opacity: 1, top: -15, extraClass: "pretty fancy" });
       },
       onSelectContactoCliente: function( combo, record, index){

            Ext.getCmp("idconcliente").setValue(record.get("idcontacto"));
            Ext.getCmp("contacto").setValue(record.get("nombre")+' '+record.get("papellido")+' '+record.get("sapellido") );

            Ext.getCmp("vendedor").setValue(record.data.vendedor);
            $("#vendedor").val(record.data.nombre_ven);

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

            if(record.get("cg"))
                $("#img_cli").html('<img src="/images/CG30.png" />');
            else
                $("#img_cli").html('');

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

            diascredito=(record.get("diascredito"))?record.get("diascredito")+" dias":"0";
            Ext.getCmp("ca_tiempocredito").setValue(diascredito);

            if(record.data.cupo && record.data.cupo!="null")
                cupo=(record.get("cupo")!="")?"Sí":"No";
            else
                cupo="No";

            Ext.getCmp("ca_liberacion").setValue(cupo);

            combo.alertaCliente(record);

            $("#asunto").val("Nuevo Reporte AG "+$("#proveedor0").val()+" / "+$("#cliente").val()) ;

        },
        onSelectImpoexpo: function( combo, record, index){
            if(record.get("valor")=="<?=constantes::IMPO?>")
            {
                Ext.getCmp("tra_destino_id").setValue("CO-057");
                $("#tra_destino_id").val("Colombia");
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
            FormReportePanelAg.superclass.onRender.apply(this, arguments);
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

                        if(!Ext.getCmp("idvendedor"))
                        {
                            Ext.getCmp("vendedor").setValue(res.data.idvendedor);
                            $("#vendedor").attr("value",res.data.vendedor);
                        }
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

                        Ext.getCmp("sucursalagente").setValue(res.data.idsucursalagente);
                        $("#sucursalagente").attr("value",res.data.sucursalagente);
                        
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
