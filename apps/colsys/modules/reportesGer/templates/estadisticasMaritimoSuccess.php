<?
include_component("charts","column");
include_component("widgets","widgetMes");

$year = $sf_data->getRaw("year");
$grid = $sf_data->getRaw("grid");
$puertos = $sf_data->getRaw("puertos");
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" >
    <br />
    <h3> ESTADISTICAS MARITIMO</h3>
    <br />
    <? //= print_r($cargas) ?>
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
                                         new WidgetMes({title: 'Mes',
                                                    fieldLabel: 'Mes',
                                                        id: 'mes',
                                                        name: 'mes',
                                                        hiddenName: "nmes",                                                        
                                                        value:"<?=$mes?>",
                                                        hiddenValue:"<?=$nmes?>"
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
            if ($fechainicial && $fechafinal) {
                echo " fechas de Creacion referencia: " . $fechainicial . " - " . $fechafinal;
            }
            if ($fechaembinicial && $fechaembfinal) {
                echo " fechas de Embarque: " . $fechaembinicial . " - " . $fechaembfinal;
            }
            if ($fechaarrinicial && $fechaarrfinal) {
                echo " fechas de Arribo: " . $fechaarrinicial . " - " . $fechaarrfinal;
            }
            if ($idmodalidad) {
                echo " modalidad: " . $idmodalidad . " - ";
            }
            if ($origen) {
                echo " origen: " . $origen . " - ";
            }
            if ($destino) {
                echo " destino: " . $destino . " - ";
            }
            if ($incoterms) {
                echo "<br>Incoterms: " . implode(",", $incoterms) . " - ";
            }
            ?>
        </h3>
        <br />
        <br />
    </div>
    <table class="tableList" width="900px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO LCL-FCL</caption>
        <tr><th>POD</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>Porcentaje</th><td rowspan="7" width="45%"><div align="center" id="grafica1" ></div></td></tr>
        <?
        $totalTeus=($grid["LCL"][$year]["totales"]["ca_teus"]+$grid["FCL"][$year]["totales"]["ca_teus"]);
        $data=array();
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["LCL"][$year]["ca_teus"]+$g["FCL"][$year]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            ?>
            <tr>
                <td><?=$p?></td>
                <td><?=($g["LCL"][$year]["ca_20pies"]+$g["FCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_40pies"]+$g["FCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_teus"]+$g["FCL"][$year]["ca_teus"])?></td>
                <td><?=$total?>%</td>
            </tr>
            <?            
        }
        //print_r($data);
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
        }   
        {
            $dataJSON[]=array("name"=>"teus","data"=>$data1);
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
        </tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica1',
                    height: 400,
                    title:" ",
                    titleY:"Porcentaje",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>



<table class="tableList" width="900px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO FCL</caption>
        <tr><th>POD</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>Porcentaje</th><td rowspan="7" width="45%"><div align="center" id="grafica2" ></div></td></tr>
        <?
        $totalTeus=$grid["FCL"][$year]["totales"]["ca_teus"];
        $data=array();
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["FCL"][$year]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            ?>
            <tr>
                <td><?=$p?></td>
                <td><?=($g["FCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["FCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["FCL"][$year]["ca_teus"])?></td>
                <td><?=$total?>%</td>
            </tr>
            <?
        }
        //print_r($data);
        $data1=array();
        $dataJSON=array();
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
        }
        {
            $dataJSON[]=array("name"=>"teus","data"=>$data1);
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
        </tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica2',
                    height: 400,
                    title:" ",
                    titleY:"Porcentaje",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>



<table class="tableList" width="900px" border="1" id="mainTable" align="center">
        <caption>PORCENTAJE DE TEUS POR PUERTO LCL</caption>
        <tr><th>POD</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th><th>Porcentaje</th><td rowspan="7" width="45%"><div align="center" id="grafica3" ></div></td></tr>
        <?
        $totalTeus=$grid["LCL"][$year]["totales"]["ca_teus"];
        $data=array();
        foreach ($grid["destino"] as $p=> $g) {
            $total=round((($g["LCL"][$year]["ca_teus"])/$totalTeus)*100,2);
            $data[$p]=$total;
            ?>
            <tr>
                <td><?=$p?></td>
                <td><?=($g["LCL"][$year]["ca_20pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_40pies"])?></td>
                <td><?=($g["LCL"][$year]["ca_teus"])?></td>
                <td><?=$total?>%</td>
            </tr>
            <?
        }
        //print_r($data);
        $data1=array();
        $dataJSON=array();
        foreach($puertos as $p )
        {
            $data1[]=$data[$p];
        }
        {
            $dataJSON[]=array("name"=>"teus","data"=>$data1);
        }
        //$dataJSON=array("name"=>$p,"data"=>$data);
        ?>
        <tr>
            <td align="right" colspan="3">Total Teus</td>
            <td align="right"><?=$totalTeus?></td>
        </tr>
    </table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica3',
                    height: 400,
                    title:" ",
                    titleY:"Porcentaje",
                    xRotation:-30,
					serieX: <?=json_encode($puertos)?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>


<hr><hr>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>FCL</caption>
</table>

<?
ksort($grid["origen"]);
foreach($grid["origen"] as $pais=> $gridO)
{
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <caption><?=$pais?></caption>
        <tr><th>Destino</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th></tr>
        <?
        $data=array();
        ksort($gridO["FCL"][$year]);
        $teus=0;
        foreach ($gridO["FCL"][$year] as $p=> $g) {
            if($p=="totales")
                continue;
            $teus+=$g["ca_teus"];
            $data[$p]=$total;
            ?>
            <tr>
                <td><?=$p?></td>
                <td><?=($g["ca_20pies"])?></td>
                <td><?=($g["ca_40pies"])?></td>
                <td><?=($g["ca_teus"])?></td>
            </tr>
            <?
        }
        ?>
        <tr align="right" style="background-color: #EAEAEA">
            <td colspan="3">Subtotales</td>
            <td ><?=$teus?></td>
        </tr>
    </table>
 <?
}
 ?> 
<hr><hr>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>LCL</caption>
</table>

<?
ksort($grid["origen"]);
foreach($grid["origen"] as $pais=> $gridO)
{
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">
    <caption><?=$pais?></caption>
    <tr><th>Destino</th><th>CMB</th><th>20 Pies</th><th>40 Pies</th><th>TEU's</th></tr>
        <?
        $data=array();
        ksort($gridO["LCL"][$year]);
        $teus=0;
        foreach ($gridO["LCL"][$year] as $p=> $g) {
            if($p=="totales")
                continue;            
            $data[$p]=$total;
            ?>
            <tr align="right">
                <td ><?=$p?></td>
                <td ><?=($g["ca_volumen"])?></td>
                <td ><?=($g["ca_20pies"])?></td>
                <td ><?=($g["ca_40pies"])?></td>
                <td ><?=($g["ca_teus"])?></td>
            </tr>
            <?
        }
        ?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>
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

<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>Participacion FCL</caption>
</table>


<?
//ksort($grid["origen"]);
$totalTeusLCL=($grid["LCL"][$year]["totales"]["ca_teus"]);
$totalTeusFCL=($grid["FCL"][$year]["totales"]["ca_teus"]);

$dataFCL=array();
$dataLCL=array();
    
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th>Pais</th><th>TEU's</th><th>Porcentaje</th></tr>
        <?
        foreach($grid["origen"] as $pais=> $g)
        {
            if(!isset($g["FCL"][$year]["totales"]["ca_teus"]) || $g["FCL"][$year]["totales"]["ca_teus"]=="" || $g["FCL"][$year]["totales"]["ca_teus"]<=0)
                continue;            
            
            $dataFCL[utf8_encode($pais)]=round((($g["FCL"][$year]["totales"]["ca_teus"]/$totalTeusFCL)*100),2);
            $dataFCL1[utf8_encode($pais)]=round(($g["FCL"][$year]["totales"]["ca_teus"]),2);

        ?>
        <tr align="right" >
            <td ><?=$pais?></td>                
            <td ><?=($g["FCL"][$year]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["FCL"][$year]["totales"]["ca_teus"]/$totalTeusFCL)*100),2)?>%</td>                
        </tr>
 <?
        }
$dataJSON=array();
    $data1=array();
    foreach($dataFCL as $p )
    {
        $data1[]=$p;
    }   
    $dataJSON[]=array("name"=>"teus","data"=>$data1);
?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>        
        <td ><?=$totalTeusFCL?></td>
        <td >100%</td>
    </tr>
</table>

<table class="tableList" width="900px" border="1" id="mainTable" align="center">    
    <tr>
        <td><div align="center" id="grafica4" ></div></td>
    </tr>
</table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica4',
                    height: 500,
                    title:" ",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataFCL))?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>

<hr><hr>

<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>Participacion LCL</caption>
</table>

<?
//ksort($grid["origen"]);
  
?>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th>Pais</th><th>TEU's</th><th>Porcentaje</th></tr>
        <?
        foreach($grid["origen"] as $pais=> $g)
        {
            if(!isset($g["LCL"][$year]["totales"]["ca_teus"]) || $g["LCL"][$year]["totales"]["ca_teus"]=="" || $g["LCL"][$year]["totales"]["ca_teus"]<=0)
                continue;
            $dataLCL[utf8_encode($pais)]=round((($g["LCL"][$year]["totales"]["ca_teus"]/$totalTeusLCL)*100),2);
            $dataLCL1[utf8_encode($pais)]=round(($g["LCL"][$year]["totales"]["ca_teus"]),2);
        ?>
        <tr align="right">
            <td ><?=$pais?></td>                
            <td ><?=($g["LCL"][$year]["totales"]["ca_teus"])?></td>
            <td ><?=round((($g["LCL"][$year]["totales"]["ca_teus"]/$totalTeusLCL)*100),2)?>%</td>                
        </tr>
 <?
        }
    $dataJSON=array();
    $data1=array();
    foreach($dataLCL as $p )
    {
        $data1[]=$p;
    }   
    $dataJSON[]=array("name"=>"teus","data"=>$data1);
?>
    <tr align="right" style="background-color: #EAEAEA">
        <td >Subtotales</td>        
        <td ><?=$totalTeusLCL?></td>
        <td >100%</td>
    </tr>
</table>

<br>
<table class="tableList" width="900px" border="1" id="mainTable" align="center">    
    <tr>
        <td><div align="center" id="grafica5" ></div></td>
    </tr>
</table>

<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica5',
                    height: 500,
                    title:" ",
                    titleY:"Porcentaje",
                    xRotation:-90,
					serieX: <?=json_encode(array_keys($dataLCL))?>,
				    series: <?=json_encode($dataJSON)?>
				});	
</script>

<?
//echo "<pre>";  print_r($dataLCL);echo "</pre>";
//arsort($dataLCL);
//arsort($dataFCL);
arsort($dataLCL1);
arsort($dataFCL1);
$totalFcl=0;
$totalLcl=0;
$dataFCLTop=array();
$dataLCLTop=array();
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



//echo "<pre>";  print_r($dataFCLTop);echo "</pre>";
?>

<hr><hr>

<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>Ranking FCL</caption>
</table>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th>Pais</th><th>TEU's</th><th>Porcentaje</th></tr>
<?
foreach($dataFCLTop as $pais=>$d)
{
?>
    <tr align="right" >
        <td ><?=$pais?></td>                
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusFCL)*100),2)?>%</td>                
    </tr>
<?
}
?>
</table>

<hr><hr>

<table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <caption>Ranking LCL</caption>
</table>
<table class="tableList" width="400px" border="1" id="mainTable" align="center">    
    <tr><th>Pais</th><th>TEU's</th><th>Porcentaje</th></tr>


<?
foreach($dataLCLTop as $pais=>$d)
{
?>
    <tr align="right" >
        <td ><?=$pais?></td>                
        <td ><?=($d)?></td>
        <td ><?=round((($d/$totalTeusLCL)*100),2)?>%</td>                
    </tr>
<?
}
?>
</table>
<?

}
?>