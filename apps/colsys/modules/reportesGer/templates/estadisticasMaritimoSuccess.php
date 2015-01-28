<?
include_component("charts","column");
include_component("widgets","widgetMes");
include_component("widgets","widgetMultiDatos");

$year = $sf_data->getRaw("year");
$grid = $sf_data->getRaw("grid");
$puertos = $sf_data->getRaw("puertos");
$nmes = $sf_data->getRaw("nmes");

$meses = $sf_data->getRaw("meses");

?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center">
    <br />
    <h3> ESTADISTICAS MARITIMO</h3>
    <br />
    <? //= print_r($cargas) ?>
    <br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
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
                                    columnWidth:1,
                                    border:false,
                                    items:
                                        [
                                        {
                                            xtype:'datefield',
                                            fieldLabel: 'Año',
                                            name : 'year',
                                            format: 'Y',
                                            value: '<?= $year ?>'
                                        },                                         
                                         new WidgetMultiDatos({title: 'Mes',
                                                    fieldLabel: 'Mes',
                                                        id: 'mes',
                                                        name: 'mes[]',
                                                        hiddenName: "nmes[]",
                                                        value:'<?=$nmes?implode(",", $nmes):"" ?>',
                                                        listeners:{
                                                            render:function()
                                                            {
                                                                if(this.store.data.length==0)
                                                                {
                                                                    data=<?=json_encode(array("root"=>$meses, "total"=>count($meses), "success"=>true) )?>;
                                                                    this.store.loadData(data);
                                                                }
                                                            },
                                                            focus:function()
                                                            {
                                                                if(this.store.data.length==0)
                                                                {
                                                                    data=<?=json_encode(array("root"=>$meses, "total"=>count($meses), "success"=>true) )?>;
                                                                    this.store.loadData(data);
                                                                }
                                                            }
                                                        }
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
                        owner.getForm().getEl().dom.action='<?= url_for("reportesGer/estadisticasMaritimo") ?>';
                    }
                    owner.getForm().submit();
                }
            }],
        listeners:{afterrender:function(){        
            }

        }
    });
    tabs.render("container");
</script>
<?
if ($opcion) {
    ?>

    <div align="center">
        <br>
        <h3>Estadisticas de cargas  <br>
            <?
            //if ($year!="" ) 
                {
                echo " Año: " . $year . " - " . ($year-1)."<br>";
            }
            echo " Meses: ";
            if (count($nmes)>0 ) {                
                foreach($nmes as $n)
                {
                    echo Utils::mesLargo($n)."-";
                }
            }
            else
                echo "Todos";
            ?>
        </h3>
        <br />
        <br />
    </div>
    <table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO LCL-FCL <?=$year?></caption>
        <tr style ="text-align:center"><th rowspan="2">POD</th><th colspan="4" ><?=$year-1?></th><th colspan="4" ><?=$year?></th><th >Var</th></tr>
        <tr><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th><?=$year-1?>-<?=$year?></th></tr>
        <?
        $totalTeusM=($grid["LCL"][$year]["totales"]["ca_teus"]+$grid["FCL"][$year]["totales"]["ca_teus"]);
        $totalTeus=($grid["LCL"][$year-1]["totales"]["ca_teus"]+$grid["FCL"][$year-1]["totales"]["ca_teus"]);
        $data=array();
        $dataM=array();
        
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["LCL"][$year-1]["ca_teus"]+$g["FCL"][$year-1]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            
            $totalM=round((($g["LCL"][$year]["ca_teus"]+$g["FCL"][$year]["ca_teus"])/$totalTeusM)*100,2);
            $dataM[$p]=$totalM;
            ?>
            <tr align="right">
                <td align="left"><?=$p?></td>
                <td><?=($g["LCL"][$year-1]["ca_20pies"]+$g["FCL"][$year-1]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year-1]["ca_40pies"]+$g["FCL"][$year-1]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year-1]["ca_teus"]+$g["FCL"][$year-1]["ca_teus"])?></td>                
                <td><?=$total?>%</td>
                
                <td><?=($g["LCL"][$year]["ca_20pies"]+$g["FCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_40pies"]+$g["FCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_teus"]+$g["FCL"][$year]["ca_teus"])?></td>
                <td><?=$totalM?>%</td>
                
                <td><?=($g["LCL"][$year]["ca_teus"]+$g["FCL"][$year]["ca_teus"])-($g["LCL"][$year-1]["ca_teus"]+$g["FCL"][$year-1]["ca_teus"]) ?></td>
            </tr>
            <?            
        }
        //print_r($data);
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
            $data2[]=$dataM[$p];
        }   
        {
            $dataJSON[]=array("name"=>($year-1),"data"=>$data2);
            $dataJSON[]=array("name"=>($year),"data"=>$data1);
            
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        //print_r($dataJSON);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
            <td></td>
            <td align="right" colspan="2"></td>
            <td align="right"><?=$totalTeusM?></td>
            <td align="right"><?//=round(( 1-($totalTeus/$totalTeusM) )*100,2);?></td>
            <td align="right"><?=$totalTeusM-$totalTeus?></td>
        </tr>
        <tr><td colspan="10"><div align="center" id="grafica1" ></div></td></tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica1',
                    height: 400,
                    title:" ",
                    titleY:"%",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>

<hr><hr>
<br><br>



<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO FCL <?=$year?></caption>
        <tr style ="text-align:center"><th rowspan="2">POD</th><th colspan="4" ><?=$year-1?></th><th colspan="4" ><?=$year?></th><th >var</th></tr>
        <tr><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th><?=$year-1?>-<?=$year?></th></tr>
        <?
        $totalTeus=($grid["FCL"][$year-1]["totales"]["ca_teus"]);
        $totalTeusM=($grid["FCL"][$year]["totales"]["ca_teus"]);
        $data=array();
        $data1=array();
        $data2=array();
        $dataM=array();
        $dataJSON=array();
        
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["FCL"][$year-1]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            
            $totalM=round((($g["FCL"][$year]["ca_teus"])/$totalTeusM)*100,2);
            $dataM[$p]=$totalM;
            ?>
            <tr align="right">
                <td align="left"><?=$p?></td>
                <td><?=($g["FCL"][$year-1]["ca_20pies"])?></td>
                <td><?=($g["FCL"][$year-1]["ca_40pies"])?></td>
                <td><?=($g["FCL"][$year-1]["ca_teus"])?></td>                
                <td><?=$total?>%</td>
                <td><?=($g["FCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["FCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["FCL"][$year]["ca_teus"])?></td>
                <td><?=$totalM?>%</td>
                <td><?=($g["FCL"][$year]["ca_teus"])-($g["FCL"][$year-1]["ca_teus"]) ?></td>
            </tr>
            <?            
        }
        //print_r($data);
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
            $data2[]=$dataM[$p];
        }   
        {
            $dataJSON[]=array("name"=>($year-1),"data"=>$data2);
            $dataJSON[]=array("name"=>($year),"data"=>$data1);            
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        //print_r($dataJSON);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
            <td></td>
            <td align="right" colspan="2"></td>
            <td align="right"><?=$totalTeusM?></td>
            <td></td>
            <td align="right"><?=$totalTeusM-$totalTeus?></td>
        </tr>
        <tr><td colspan="10"><div align="center" id="grafica2" ></div></td></tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica2',
                    height: 400,
                    title:" ",
                    titleY:"%",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>

<hr><hr>
<br><br>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO LCL </caption>
        <tr style ="text-align:center"><th rowspan="2">POD</th><th colspan="4" ><?=$year-1?></th><th colspan="4" ><?=$year?></th><th >Var</th></tr>
        <tr><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>%</th><th><?=$year-1?>-<?=$year?></th></tr>
        <?
        $totalTeus=($grid["LCL"][$year-1]["totales"]["ca_teus"]);
        $totalTeusM=($grid["LCL"][$year]["totales"]["ca_teus"]);
        $data=array();
        $data1=array();
        $data2=array();
        $dataM=array();
        $dataJSON=array();
        
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["LCL"][$year-1]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            
            $totalM=round((($g["LCL"][$year]["ca_teus"])/$totalTeusM)*100,2);
            $dataM[$p]=$totalM;
            ?>
            <tr align="right">
                <td align="left"><?=$p?></td>
                <td><?=($g["LCL"][$year-1]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year-1]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year-1]["ca_teus"])?></td>                
                <td><?=$total?>%</td>
                
                <td><?=($g["LCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_teus"])?></td>
                <td><?=$totalM?>%</td>
                
                <td><?=($g["LCL"][$year]["ca_teus"]) -($g["LCL"][$year-1]["ca_teus"]) ?></td>
            </tr>
            <?
        }
        //print_r($data);
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
            $data2[]=$dataM[$p];
        }   
        {
            $dataJSON[]=array("name"=>($year-1),"data"=>$data1);
            $dataJSON[]=array("name"=>($year),"data"=>$data2);
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        //print_r($dataJSON);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
            <td></td>
            <td align="right" colspan="3"></td>
            <td align="right"><?=$totalTeusM?></td>
            <td></td>
            <td align="right"><?=$totalTeusM-$totalTeus?></td>
        </tr>
        <tr><td colspan="10"><div align="center" id="grafica3" ></div></td></tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica3',
                    height: 400,
                    title:" ",
                    titleY:"%",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>
<hr><hr>
<br><br>
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>FCL</caption>
</table>

<?
ksort($grid["origen"]);
foreach($grid["origen"] as $pais=> $gridO)
{
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <caption><?=$pais?></caption>
    <tr><th rowspan="2">Destino</th><th colspan="3" style="text-align: center"><?=$year-1?></th> <th colspan="3" style="text-align: center"><?=$year?></th></tr>
    <tr><th>20 Pies</th><th>40 Pies</th><th>TEU's</th> <th>20 Pies</th><th>40 Pies</th><th>TEU's</th></tr>
        <?
        $data=array();
        ksort($gridO["FCL"][$year-1]);
        $teus=$teus1=0;
        foreach ($gridO["FCL"][$year-1] as $p=> $g) {
            if($p=="totales")
                continue;
            $teus+=$g["ca_teus"];
            $teus1+=$gridO["FCL"][$year][$p]["ca_teus"];
            $data[$p]=$total;
            ?>
            <tr align="right">
                <td align="left"><?=$p?></td>
                <td><?=($g["ca_20pies"])?></td>
                <td><?=($g["ca_40pies"])?></td>
                <td><?=($g["ca_teus"])?></td>
                
                <td><?=($gridO["FCL"][$year][$p]["ca_20pies"])?></td>
                <td><?=($gridO["FCL"][$year][$p]["ca_40pies"])?></td>
                <td><?=($gridO["FCL"][$year][$p]["ca_teus"])?></td>
            </tr>
            <?
        }
        ?>
        <tr align="right" style="background-color: #EAEAEA">
            <td colspan="3">Subtotales</td>
            <td ><?=$gridO["FCL"][$year-1]["totales"]["ca_teus"]?></td>
            <td colspan="2"></td>
            <td ><?=$gridO["FCL"][$year]["totales"]["ca_teus"]?></td>
        </tr>
    </table>
 <?
}
 ?> 
<hr><hr>
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>LCL</caption>
</table>

<?
ksort($grid["origen"]);
foreach($grid["origen"] as $pais=> $gridO)
{
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <caption><?=$pais?></caption>
    <tr><th rowspan="2">Destino</th><th colspan="4" style="text-align: center"><?=$year-1?></th> <th colspan="4" style="text-align: center"><?=$year?></th></tr>
    <tr><th>CMB</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th> <th>CMB</th> <th>20 Pies</th><th>40 Pies</th><th>TEU's</th></tr>
        <?
        $data=array();
        ksort($gridO["LCL"][$year-1]);
        $teus=$teus1=0;
//        $tam=(count($gridO["LCL"][$year])> count($gridO["LCL"][$year-1]) )?count($gridO["LCL"][$year]):count($gridO["LCL"][$year-1]);
        foreach ($gridO["LCL"][$year-1] as $p=> $g) {
            if($p=="totales")
                continue;            
            $data[$p]=$total;
            ?>
            <tr align="right">
                <td align="left" ><?=$p?></td>
                <td ><?=($g["ca_volumen"])?></td>
                <td ><?=($g["ca_20pies"])?></td>
                <td ><?=($g["ca_40pies"])?></td>
                <td ><?=($g["ca_teus"])?></td>
                <td><?=($gridO["LCL"][$year][$p]["ca_volumen"])?></td>
                <td><?=($gridO["LCL"][$year][$p]["ca_20pies"])?></td>
                <td><?=($gridO["LCL"][$year][$p]["ca_40pies"])?></td>
                <td><?=($gridO["LCL"][$year][$p]["ca_teus"])?></td>
            </tr>
            <?
        }
        ?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>
        <td ><?=$gridO["LCL"][$year-1]["totales"]["ca_volumen"]?></td>
        <td ><?=$gridO["LCL"][$year-1]["totales"]["ca_20pies"]?></td>
        <td ><?=$gridO["LCL"][$year-1]["totales"]["ca_40pies"]?></td>
        <td ><?=$gridO["LCL"][$year-1]["totales"]["ca_teus"]?></td>
        <td ><?=$gridO["LCL"][$year]["totales"]["ca_volumen"]?></td>
        <td ><?=$gridO["LCL"][$year]["totales"]["ca_20pies"]?></td>
        <td ><?=$gridO["LCL"][$year]["totales"]["ca_40pies"]?></td>
        <td ><?=$gridO["LCL"][$year]["totales"]["ca_teus"]?></td>
    </tr>
</table>
 <?
}
?>
<hr><hr>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>Participacion FCL</caption>
</table>

<?
//ksort($grid["origen"]);
$totalTeusLCL[$year]=($grid["LCL"][$year]["totales"]["ca_teus"]);
$totalTeusFCL[$year]=($grid["FCL"][$year]["totales"]["ca_teus"]);

$totalTeusLCL[$year-1]=($grid["LCL"][$year-1]["totales"]["ca_teus"]);
$totalTeusFCL[$year-1]=($grid["FCL"][$year-1]["totales"]["ca_teus"]);

$dataFCL=array();
$dataLCL=array();
    
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th rowspan="2">Pais</th><th colspan="2"><?=$year-1?></th><th colspan="2"><?=$year?></th></tr>
    <tr><th>TEU's</th><th>%</th> <th>TEU's</th><th>%</th></tr>
        <?
        foreach($grid["origen"] as $pais=> $g)
        {
            if(!isset($g["FCL"][$year-1]["totales"]["ca_teus"]) || $g["FCL"][$year-1]["totales"]["ca_teus"]=="" || $g["FCL"][$year-1]["totales"]["ca_teus"]<=0)
                continue;            
            
            $dataFCL[utf8_encode($pais)]=round((($g["FCL"][$year-1]["totales"]["ca_teus"]/$totalTeusFCL[$year-1])*100),2);
            $dataFCL1[utf8_encode($pais)]=round(($g["FCL"][$year-1]["totales"]["ca_teus"]),2);
            
            $dataFCL_1[utf8_encode($pais)]=round((($g["FCL"][$year]["totales"]["ca_teus"]/$totalTeusFCL[$year])*100),2);
            $dataFCL1_1[utf8_encode($pais)]=round(($g["FCL"][$year]["totales"]["ca_teus"]),2);

        ?>
        <tr align="right" >
            <td ><?=$pais?></td>                
            <td ><?=($g["FCL"][$year-1]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["FCL"][$year-1]["totales"]["ca_teus"]/$totalTeusFCL[$year-1])*100),2)?>%</td>
            
            <td ><?=($g["FCL"][$year]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["FCL"][$year]["totales"]["ca_teus"]/$totalTeusFCL[$year])*100),2)?>%</td>
        </tr>
 <?
        }
/*$dataJSON=array();
    $data1=array();
    foreach($dataFCL as $p )
    {
        $data1[]=$p;
    }   
    $dataJSON[]=array("name"=>"teus","data"=>$data1);
    
    
    $dataJSON2=array();
    $data2=array();
    foreach($dataFCL_1 as $p )
    {
        $data2[]=$p;
    }   
    $dataJSON2[]=array("name"=>"teus","data"=>$data2);
 * 
 */
?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>        
        <td ><?=$totalTeusFCL[$year-1]?></td>
        <td >100%</td>
        <td ><?=$totalTeusFCL[$year]?></td>
        <td >100%</td>
    </tr>
</table>

<!--
<table class="tableList" width="600px" border="1" id="mainTable" align="center">    
    <tr>
        <td><div align="center" id="grafica4" ></div></td>
    </tr>
    <tr>
        <td><div align="center" id="grafica40" ></div></td>
    </tr>
</table>
-->
<script type="text/javascript">
/*
var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica4',
                    height: 500,
                    title:"<?=$year?>",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataFCL))?>,
				    series: <?=json_encode($dataJSON)?>
				});	
var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica40',
                    height: 500,
                    title:"<?=$year-1?>",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataFCL_1))?>,
				    series: <?=json_encode($dataJSON2)?>
				});	
*/
</script>

<hr><hr>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>Participacion LCL</caption>
</table>

<?
//ksort($grid["origen"]);
  
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th rowspan="2">Pais</th><th colspan="2"><?=$year-1?></th><th colspan="2"><?=$year?></th></tr>
    <tr><th>TEU's</th><th>%</th> <th>TEU's</th><th>%</th></tr>
        <?
        foreach($grid["origen"] as $pais=> $g)
        {
            if(!isset($g["LCL"][$year-1]["totales"]["ca_teus"]) || $g["LCL"][$year-1]["totales"]["ca_teus"]=="" || $g["LCL"][$year-1]["totales"]["ca_teus"]<=0)
                continue;            
            
            $dataLCL[utf8_encode($pais)]=round((($g["LCL"][$year-1]["totales"]["ca_teus"]/$totalTeusLCL[$year-1])*100),2);
            $dataLCL1[utf8_encode($pais)]=round(($g["LCL"][$year-1]["totales"]["ca_teus"]),2);
            
            $dataLCL_1[utf8_encode($pais)]=round((($g["LCL"][$year]["totales"]["ca_teus"]/$totalTeusLCL[$year])*100),2);
            $dataLCL1_1[utf8_encode($pais)]=round(($g["LCL"][$year]["totales"]["ca_teus"]),2);

        ?>
        <tr align="right" >
            <td ><?=$pais?></td>                
            <td ><?=($g["LCL"][$year-1]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["LCL"][$year-1]["totales"]["ca_teus"]/$totalTeusLCL[$year-1])*100),2)?>%</td>
            
            <td ><?=($g["LCL"][$year]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["LCL"][$year]["totales"]["ca_teus"]/$totalTeusLCL[$year])*100),2)?>%</td>
        </tr>
 <?
        }

/*  
    $dataJSON=array();
    $data1=array();
    foreach($dataLCL as $p )
    {
        $data1[]=$p;
    }   
    $dataJSON[]=array("name"=>"teus","data"=>$data1);
    
    
    $dataJSON2=array();
    $data2=array();
    foreach($dataLCL_1 as $p )
    {
        $data2[]=$p;
    }   
    $dataJSON2[]=array("name"=>"teus","data"=>$data2);
 * 
 */
?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>        
        <td ><?=$totalTeusLCL[$year-1]?></td>
        <td >100%</td>
        <td ><?=$totalTeusLCL[$year]?></td>
        <td >100%</td>
    </tr>
</table>

<!--<table class="tableList" width="600px" border="1" id="mainTable" align="center">    
    <tr>
        <td><div align="center" id="grafica5" ></div></td>
    </tr>
    <tr>
        <td><div align="center" id="grafica50" ></div></td>
    </tr>
</table>
-->
<script type="text/javascript">
   /* var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica5',
                    height: 500,
                    title:"<?=$year?>",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataLCL))?>,
				    series: <?=json_encode($dataJSON)?>
				});	
var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica50',
                    height: 500,
                    title:"<?=$year-1?>",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataLCL_1))?>,
				    series: <?=json_encode($dataJSON2)?>
				});	
*/
</script>

<?
//echo "<pre>";  print_r($dataLCL);echo "</pre>";
//arsort($dataLCL);
//arsort($dataFCL);
arsort($dataLCL1);
arsort($dataFCL1);

arsort($dataLCL1_1);
arsort($dataFCL1_1);
$totalFcl=0;
$totalLcl=0;
$dataFCLTop=array();
$dataLCLTop=array();

$dataFCLTop_1=array();
$dataLCLTop_1=array();
$i=0;
foreach($dataFCL1 as $pais=>$d)
{
    if($i==10)
        break;
    $dataFCLTop[$pais]=$dataFCL1[$pais];
    $i++;
}
$i=0;
foreach($dataLCL1 as $pais=>$d)
{
    if($i==10)
        break;  
    $dataLCLTop[$pais]=$dataLCL1[$pais];
    $i++;
}
$i=0;
//print_r($dataFCL1_1);
foreach($dataFCL1_1 as $pais=>$d)
{
    if($i==10)
        break;
    $dataFCLTop_1[$pais]=$dataFCL1_1[$pais];
    $i++;
}
$i=0;
foreach($dataLCL1_1 as $pais=>$d)
{
    if($i==10)
        break;  
    $dataLCLTop_1[$pais]=$dataLCL1_1[$pais];
    $i++;
}



//echo "<pre>";  print_r($dataFCLTop);echo "</pre>";
?>

<hr><hr>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>Ranking FCL</caption>
</table>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <tr><td width="50%"><table>
    <tr><th colspan="3"><?=$year-1?></th></tr>
    <tr><th>Pos</th><th>Pais</th><th>TEU's</th><th>%</th></tr> 
<?
$i=0;
foreach($dataFCLTop as $pais=>$d)
{
?>
    <tr align="right" >
        <td><?=++$i?></td>
        <td ><?=utf8_decode($pais)?></td>
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusFCL[$year-1])*100),2)?>%</td>                
    </tr>
<?
}
?>
            </table></td>
    <td width="50%"><table>
    <tr><th colspan="3"><?=$year?></th></tr>
    <tr><th>Pos</th><th>Pais</th><th>TEU's</th><th>%</th></tr> 
<?
$i=0;
foreach($dataFCLTop_1 as $pais=>$d)
{
?>
     <tr align="right" >
         <td><?=++$i?></td>
        <td ><?=utf8_decode($pais)?></td>
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusFCL[$year])*100),2)?>%</td>                
    </tr>
<?
}
?>
            </table></td>
            
    </tr>
</table>

<hr><hr>

<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption>Ranking LCL</caption>
</table>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <tr><td width="50%"><table>
    <tr><th colspan="3"><?=$year-1?></th></tr>
    <tr><th>Pos</th><th>Pais</th><th>TEU's</th><th>%</th></tr> 
<?
$i=0;
foreach($dataLCLTop as $pais=>$d)
{
?>
    <tr align="right" >
        <td><?=++$i?></td>
        <td ><?=utf8_decode($pais)?></td>
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusLCL[$year-1])*100),2)?>%</td>                
    </tr>
<?
}
?>
            </table></td>
    <td width="50%"><table>
    <tr><th colspan="3"><?=$year?></th></tr>
    <tr><th>Pos</th><th>Pais</th><th>TEU's</th><th>%</th></tr> 
<?
$i=0;
foreach($dataLCLTop_1 as $pais=>$d)
{
?>
     <tr align="right" >
         <td><?=++$i?></td>
        <td ><?=utf8_decode($pais)?></td>
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusLCL[$year])*100),2)?>%</td>                
    </tr>
<?
}
?>
            </table></td>
            
    </tr>
</table>
<?

}
?>

<script>
    function imprimir()
    {
        $(".esconder").hide();
        Ext.getCmp("tab-panel").hidden=true;        
        window.print();        
    }
</script>