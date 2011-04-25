<?
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");
include_component("widgets", "widgetIncoterms");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetSucursalAgente");
$agente = $sf_data->getRaw("agente");
$linea = $sf_data->getRaw("linea");
$sucursalagente = $sf_data->getRaw("sucursalagente");
?>
<div align="center" >
<br />
<h3> Reporte de carga tráficos </h3>
<br />
<?=print_r($cargas)?>
<br />
</div>
<div align="center" id="container"></div>
<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	fame:true,
	width: 900,
	standardSubmit: true,
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel',
		items:[{
			title:'Estadisticas',
			layout:'form',
			defaultType: 'textfield',
			id: 'estadisticas',
            labelWidth: 75,

			items: [
                {
                        xtype:'fieldset',
                        title: 'filtros',
                        autoHeight : true,
                        layout : 'column',
                        columns : 2,
                        defaults:{
                            columnWidth:0.5,
                            layout:'form',
                            border:false,
                            bodyStyle:'padding:4px;'
                        },
                        items :
                        [
                            {
                                xtype:'hidden',
                                name:"opcion",
                                value:"buscar"
                            },
                            {
                                xtype:"hidden",
                                id: 'impoexpo',
                                name: 'impoexpo',
                                value:'<?=Constantes::IMPO?>'
                            },
                            {
                                xtype:"hidden",
                                id: 'transporte',
                                name: 'transporte',
                                value:'<?=Constantes::MARITIMO?>'
                            },
                            {
                                columnWidth:.5,
                                border:false,
                                items:
                                [
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Emb Ini',
                                            name : 'fechaEmbInicial',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaembinicial?>'
                                    },
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Arribo Ini',
                                            name : 'fechaArrInicial',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaarrinicial?>'
                                    },
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Ini',
                                            name : 'fechaInicial',
                                            format: 'Y-m-d',
                                            value: '<?=$fechainicial?>'
                                    }
                                    ,
                                    new WidgetModalidad({fieldLabel: 'Tipo Envio',
                                                        id: 'modalidad',
                                                        hiddenName: "idmodalidad",
                                                        linkTransporte: "transporte",
                                                        linkImpoexpo: "impoexpo",
                                                        value:"<?=$idmodalidad?>"
                                                        })
                                                        ,
                                    new WidgetPais({title: 'Pais origen',
                                                    fieldLabel: 'Pais origen',
                                                        id: 'pais_origen',
                                                        name: 'pais_origen',
                                                        hiddenName: "idpais_origen",
                                                        pais:"todos",
                                                        value:"<?=$idpais_origen?>"
                                                        }),                                    
                                    new WidgetPais({title: 'Pais destino',
                                                        fieldLabel: 'Pais destino',
                                                        id: 'pais_destino',
                                                        name: 'pais_destino',
                                                        hiddenName: "idpais_destino",
                                                        pais:"todos",
                                                        value:"<?=$idpais_destino?>"
                                                        }),
                                    new WidgetAgente({fieldLabel: 'Agente',
                                                      linkImpoExpo: "<?=constantes::IMPO?>",
                                                      linkListarTodos: "all",
                                                      id:"agente",
                                                      hiddenName:"idagente",
                                                      width:350,
                                                      value:"<?=$agente?>",
                                                      hiddenValue:"<?=$idagente?>"
                                                      
                                                    }),
                                    new WidgetIncoterms({title: 'Terminos',
                                                      fieldLabel:"Terminos",
                                                      id: 'terminos',
                                                      hiddenName:"incoterms",
                                                      width:250,
                                                      value:"<?=$incoterms?>"
                                                    })
                              ]
                         },
                         {
                                columnWidth:.5,
                                border:false,
                                items:
                                [
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Emb fin',
                                            name : 'fechaEmbFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaembfinal?>'
                                    },
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha Arribo fin',
                                            name : 'fechaArrFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechaarrfinal?>'
                                    },
                                    {
                                            xtype:'datefield',
                                            fieldLabel: 'Fecha final',
                                            name : 'fechaFinal',
                                            format: 'Y-m-d',
                                            value: '<?=$fechafinal?>'
                                    },
                                    new WidgetLinea({fieldLabel: 'Naviera',
                                                     linkTransporte: "transporte",
                                                     name:"linea",
                                                     id:"linea",
                                                     hiddenName: "idlinea",
                                                     value:"<?=$idlinea?>",
                                                     width:300
                                                    }),
                                     new WidgetCiudad({fieldLabel: 'origen',
                                                      id: 'origen',
                                                      idciudad:"origen",
                                                      hiddenName:"idorigen",
                                                      tipo:"3",
                                                      traficoParent:"pais_origen",
                                                      impoexpo: "impoexpo",
                                                      value:"<?=$origen?>",
                                                      hiddenValue:"<?=$idorigen?>"
                                                    }),
                                     new WidgetCiudad({fieldLabel: 'destino',
                                                      id: 'destino',
                                                      idciudad:"destino",
                                                      hiddenName:"iddestino",
                                                      tipo:"3",
                                                      traficoParent:"pais_destino",
                                                      impoexpo: "impoexpo",
                                                      value:"<?=$destino?>",
                                                      hiddenValue:"<?=$iddestino?>"
                                                    }),
                                     new WidgetSucursalAgente({fieldLabel: 'Sucursal',
                                                      linkAgente: "agente",
                                                      id:"sucursalagente",
                                                      name:"sucursalagente",
                                                      hiddenName:"idsucursalagente",
                                                      width:250,                                                      
                                                      hiddenValue:"<?=$sucursalagente?>",
                                                      value:"<?=$idsucursalagente?>"
                                                    })
                             ]
                         }
                     ]
                }
			]
		}]
	},
	buttons: [
            {
		text: 'Continuar',
		handler: function(){
                    var tp = Ext.getCmp("tab-panel");

                    var owner=Ext.getCmp("formPanel");
                    if( tp.getActiveTab().getId()=="estadisticas"){
                        owner.getForm().getEl().dom.action='<?=url_for("reportesGer/reporteCargaTraficos")?>';
                    }
                    owner.getForm().submit();
            }
	}],
    listeners:{afterrender:function(){

        linea_sel='<?=$linea?>';
        idlinea_sel='<?=$idlinea?>';
        if(linea_sel!="")
        {
            Ext.getCmp("linea").setValue(idlinea_sel);
            $("#linea").val(linea_sel);

        }

        agente_sel='<?=$agente?>';
        idagente_sel='<?=$idagente?>';
        if(agente_sel!="")
        {
            Ext.getCmp("agente").setValue(idagente_sel);
            $("#agente").val(agente_sel);
        }

        suc_agente_sel='<?=$sucursalagente?>';
        idsucagente_sel='<?=$idsucursalagente?>';
        if(suc_agente_sel!="")
        {
            Ext.getCmp("sucursalagente").setValue(idsucagente_sel);
            $("#sucursalagente").val(suc_agente_sel);
        }
    }

    }
});
tabs.render("container");
</script>

<?
if($opcion)
{
?>

<div align="center">
<br>
<h3>Estadisticas de cargas  <br>
<?
if( $fechainicial && $fechafinal ){
    echo " fechas de Creacion referencia: ".$fechainicial." - ".$fechafinal;
}
if( $fechaembinicial && $fechaembfinal ){
    echo " fechas de Embarque: ".$fechaembinicial." - ".$fechaembfinal;
}
if( $fechaarrinicial && $fechaarrfinal ){
    echo " fechas de Arribo: ".$fechaarrinicial." - ".$fechaarrfinal;
}
if( $idmodalidad ){
    echo " modalidad: ".$idmodalidad." - ";
}
if( $origen ){
    echo " origen: ".$origen." - ";
}
if( $destino ){
    echo " destino: ".$destino." - ";
}

?>
</h3>
<br />
<br />
</div>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr><td>Fecha<br>Embarque</td><td>Fecha<br>Arribo</td><td>Fecha<br>Referencia</td><td>Referencia</td><td>Origen</td><td>Destino</td><td>Linea</td><td>Contenedores</td><td>Teus</td><td>Piezas</td><td>Peso</td><td>Volumen</td></tr>
<?
    $ref="";
    $tvolumen=0;
    $tpiezas=0;
    $tpeso=0;
    $teus=0;

    foreach($resul as $r)
    {
    //print_r($r);

        if($r["ca_referencia"]==$ref)
        {
            $volumen="";
            $piezas="";
            $peso="";
        }
        else
        {
            $tvolumen+=$r["volumen"];
            $volumen=number_format($r["volumen"],2);
            $tpiezas+=$r["piezas"];
            $piezas=number_format($r["piezas"],0);
            $tpeso+=$r["peso"];
            $peso=number_format($r["peso"],2);
            $teus+=$r["teus"];

        }
?>
    <tr>
        <td><?=$r["ca_fchembarque"]?></td>
        <td><?=$r["ca_fcharribo"]?></td>
        <td><?=$r["ca_fchreferencia"]?></td>
        <td><?=$r["ca_referencia"]?></td>
        <td><?=$r["ori_ca_ciudad"]?></td>
        <td><?=$r["des_ca_ciudad"]?></td>
        <td><?=$r["ca_nombre"]?></td>
        <td><?=$r["ncontenedores"]?>- <?=$r["ca_concepto"]?></td>
        <td align="right"><?=$r["teus"]?>
        </td><td align="right"><?=$piezas?></td>
        <td align="right"><?=$peso?></td>
        <td align="right"><?=$volumen?></td>
    </tr>
<?
    $ref=$r["ca_referencia"];
    }
?>
    <tr><td colspan="8">Totales</td>
        <td align="right"><?=$teus?></td>
        <td align="right"><?=number_format($tpiezas,0)?></td><td align="right"><?=number_format($tpeso,2)?></td><td align="right"><?=number_format($tvolumen,2)?></td></tr>

</table>
<?
}
?>