<?
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
include_component("widgets", "widgetLinea");

include_component("widgets", "widgetMultiIncoterms");
include_component("widgets", "widgetAgente");
include_component("widgets", "widgetCliente");
include_component("widgets", "widgetSucursalAgente");
$agente = $sf_data->getRaw("agente");
$linea = $sf_data->getRaw("linea");
$sucursalagente = $sf_data->getRaw("sucursalagente");
$incoterms = $sf_data->getRaw("incoterms");
$resul = $sf_data->getRaw("resul");
?>

<div align="center" >
<br />
<h3> Reporte de carga tr�ficos </h3>
<br />
<?=print_r($cargas)?>
<br />
</div>
<div align="center" id="container"></div>
<script language="javascript">
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	frame:true,
    deferredRender:false,
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
                                            fieldLabel: 'Fecha Ref Ini',
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
                                                        pais:"<?=$pais_origen?>",
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

                                          new WidgetMultiIncoterms({title: 'Terminos',
                                                      fieldLabel:"Incoterms",
                                                      id: 'incoterms',
                                                      name: 'incoterms[]',                                                      
                                                      width:250,
                                                      value:'<?=implode(",", $incoterms)?>'
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
                                            fieldLabel: 'Fecha Ref final',
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
                                                    }),
                                     new WidgetCliente({fieldLabel:'Cliente ',
                                                   width:280,
                                                   id:"cliente",
                                                   name:"cliente",
                                                   hiddenName:"idcliente"
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
        
        cliente_sel='<?=$cliente?>';
        idcliente_sel='<?=$idcliente?>';
        if(cliente_sel!="")
        {
            Ext.getCmp("cliente").setValue(idcliente_sel);
            $("#cliente").val(cliente_sel);
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
if( $incoterms ){
    echo "<br>Incoterms: ".implode(",", $incoterms)." - ";
}

?>
</h3>
<br />
<br />
</div>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr><td>No</td><td>Fecha<br>Embarque</td><td>Fecha<br>Arribo</td><td>Fecha<br>Referencia</td><td>Referencia</td><td>Origen</td><td>Destino</td><td>Linea</td><td>Contenedores</td><td>Teus</td><td>Piezas</td><td>Peso</td><td>Volumen</td></tr>
<?
    $ref="";
    $tvolumen=0;
    $tpiezas=0;
    $tpeso=0;
    $teus=0;

    $nreferencias=0;
    $nhbls=0;
    $nitem=1;
    $totales = array();
    foreach($resul as $r)
    {
    //print_r($r);

        $teus+=$r["teus"];
        $totales["modalidad"][$r["ca_modalidad"]]["origen"][$r["ori_ca_nombre"]][$r["ca_liminferior"]]+=$r["teus"];
        $totales["modalidad"][$r["ca_modalidad"]]["destino"][$r["des_ca_ciudad"]][$r["ca_liminferior"]]+=$r["teus"];
        //$totales["modalidad"][$r["ca_modalidad"]]["destino"][$r["des_ca_ciudad"]]["peso"]+=$r["peso"];
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
            $nreferencias++;
            $arrtmp=explode("-", $r["ca_fchreferencia"]);
            $arrtmp1=explode(".", $r["ca_referencia"]);
            

            if($arrtmp1[2]==1)                
                $arrtmp[0]=  substr($arrtmp[0], 0, 3).$arrtmp1[4];
            
            $totales["modalidad"][$r["ca_modalidad"]]["origen"][$r["ori_ca_nombre"]]["volumen"]+=$r["volumen"];
            $totales["modalidad"][$r["ca_modalidad"]]["destino"][$r["des_ca_ciudad"]]["volumen"]+=$r["volumen"];
        }
        $nhbls+=$r["nhbls"];
        //if($volumen)
        $totales["a�os"][$arrtmp[0]][$arrtmp1[2]]["volumen"]+=$volumen;
        //if($r["teus"])
        $totales["a�os"][$arrtmp[0]][$arrtmp1[2]]["teus"]+=$r["teus"];
?>
    <tr>
        <td><?=$nitem++?></td>
        <td><?=$r["ca_fchembarque"]?></td>
        <td><?=$r["ca_fcharribo"]?></td>
        <td><?=$r["ca_fchreferencia"]?></td>
        <td><a href="/colsys_php/inosea.php?boton=Consultar&id=<?=$r["ca_referencia"]?>" target="_blank"><?=$r["ca_referencia"]?></td>
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
    <tr><td colspan="9">Totales</td>
        <td align="right"><?=$teus?></td>
        <td align="right"><?=number_format($tpiezas,0)?></td><td align="right"><?=number_format($tpeso,2)?></td><td align="right"><?=number_format($tvolumen,2)?></td></tr>

</table>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr>
        <td>
            <div style="float: left;width: 40%">
                <table width="98%" align="left" class="tableList">
                    <tr><th colspan="3">Resumen x A�os </th></tr>
                    <tr><th >A�o-Mes</th><th>CMB</th><th>TEUS</th></tr>
                    <?
                    $totales1=$totales["a�os"];
                    
                    foreach($totales1 as $key => $valor)
                    {
            ?>
                        <tr><th colspan="3"><?=$key?> </th></tr>
            <?
                        foreach($valor as $mes => $valor1)
                        {


            ?>
                        <tr><td ><?=  Utils::mesLargo($mes)?></td><td><?=$valor1["volumen"]?></td><td><?=$valor1["teus"]?></td></tr>
            <?
                        }
                    }
                    ?>
                </table>

            </div>
            <div style="float: left;width: 60%">
                <table width="98%" align="right" class="tableList">
                <tr><th colspan="2">Resumen x Modalidad </th></tr>
                <tr><td>No. Hbls</td><td><?=$nhbls?></td></tr>
                <tr><td>No. Master</td><td><?=$nreferencias?></td></tr>

                <?
                $totales1=$totales["modalidad"];
                //print_r($totales1);
                foreach($totales1 as $modalidad => $valor)
                {

                    $ori=$valor["origen"];
                    arsort($ori,SORT_NUMERIC);

                    $des=$valor["destino"];
                    arsort($des,SORT_NUMERIC);
                    ?>
                    <tr><th colspan="2"><?=$modalidad?></th></tr>
                    <tr><td width="30%">Origen</td>
                       <td width="100%">
                            <table width="100%">
                                <tr>
                                    <th>Pa�s</th><th width="15%">CMB</th><th width="15%">20</th><th width="15%">40</th><th width="20%">Teus</th>
                                </tr>
                                <? 
                                    foreach($ori as $key => $value)
                                    {
                                        $tmod=$value["20"]+$value["40"];
                                ?>
                                    <tr><td><?=$key?></td><td><?=$value["volumen"]?></td><td><?=$value["20"]?></td><td><?=$value["40"]?></td><td><?=$tmod?></td></tr>
                                <?                                
                                    }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <tr><td>Puerto LLegada</td>
                        <td width="100%">
                            <table width="100%">
                                <tr>
                                    <th>Puerto</th><th width="15%">CMB</th><th width="15%">20</th><th width="15%">40</th><th width="20%">Teus</th>
                                </tr>
                                <? 
                                    foreach($des as $key => $value)
                                    {
                                        $tmod=$value["20"]+$value["40"];
                                ?>
                                    <tr><td><?=$key?></td><td><?=$value["volumen"]?></td><td><?=$value["20"]?></td><td><?=$value["40"]?></td><td><?=$tmod?></td></tr>
                                <?  }
                                ?>
                            </table>
                        </td>
                    </tr>
            <?
                }
            ?>
            </table>
            </div>
        </td>
    </tr>
</table>
<?
}
?>