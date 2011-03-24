<?
include_component("widgets", "widgetModalidad");
include_component("widgets", "widgetPais");
include_component("widgets", "widgetCiudad");
?>
<div align="center" >
<br />
<h3> Reporte de carga traficos </h3>
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
	width: 650,
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
                        xtype:'hidden',
                        name:"opcion",
                        value:"buscar"
                    },
                    {
                            xtype:'datefield',
                            fieldLabel: 'Fecha Inicial',
                            name : 'fechaInicial',
                            format: 'Y-m-d',
                            value: '<?=($fechainicial)?$fechainicial:date("Y-m-")."01"?>'
                    },
                    {
                            xtype:'datefield',
                            fieldLabel: 'Fecha final',
                            name : 'fechaFinal',
                            format: 'Y-m-d',
                            value: '<?=($fechainicial)?$fechafinal:date("Y-m-")."01"?>'
                    },
                     {
                        xtype:"hidden",
                        id: 'impoexpo',
                        name: 'impoexpo',
                        value:'<?=Constantes::IMPO?>'
                    }
                    ,
                    {
                        xtype:"hidden",
                        id: 'transporte',
                        name: 'transporte',
                        value:'<?=Constantes::MARITIMO?>'
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
                    new WidgetPais({fieldLabel: 'Pais origen',
                                        id: 'pais_origen',
                                        name: 'pais_origen',
                                        hiddenName: "idpais_origen",
                                        pais:"todos",
                                        value:"<?=$idpais_origen?>"
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
                new WidgetPais({fieldLabel: 'Pais destino',
                                        id: 'pais_destino',
                                        name: 'pais_destino',
                                        hiddenName: "idpais_destino",
                                        pais:"todos",
                                        value:"<?=$idpais_destino?>"
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
                                    })
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
	}]
});
tabs.render("container");
</script>

<?
if($opcion)
{
?>

<div align="center">
<br>
<h3>Estadisticas de cargas <?=$fechainicial?> <?=$fechafinal?> <br>
<?
if( $idmodalidad ){
    echo "modalidad: ".$idmodalidad." - ";
}
if( $origen ){
    echo "origen: ".$origen." - ";
}
if( $destino ){
    echo "destino: ".$destino." - ";
}

?>
</h3>
<br />
<br />
</div>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr><td>Fecha</td><td>Referencia</td><td>Origen</td><td>Destino</td><td>Linea</td><td>Contenedores</td><td>Teus</td><td>Piezas</td><td>Peso</td><td>Volumen</td></tr>
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
    <tr><td colspan="6">Totales</td>
        <td align="right"><?=$teus?></td>
        <td align="right"><?=number_format($tpiezas,0)?></td><td align="right"><?=number_format($tpeso,2)?></td><td align="right"><?=number_format($tvolumen,2)?></td></tr>

</table>
<?
}
?>