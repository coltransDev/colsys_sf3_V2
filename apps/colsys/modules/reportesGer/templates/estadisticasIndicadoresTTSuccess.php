<?
//echo $nmeses;
include_component("charts","column");
include_component("charts","pie");

$dataJSON=array();
$grid = $sf_data->getRaw("grid");
//echo "<pre>";print_r($grid);echo "</pre>";
?>
<div align="center" >
<br />
<h3> Estadisticas Indicadores de Gesti&oacute;n </h3>
<br />
<br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("reportesGer","filtrosEstadisticasIndicadoresTT");
?>


<?
if($opcion)
{
?>
<div  >
<div align="center">
<br>
<h3>Estadisticas de cargas  <br>
<?
if( $fechainicial && $fechafinal ){
    echo " fechas de : ".$fechainicial." - ".$fechafinal;
}
?>

<div align="center">
<h3>Resumen Comparativo de Negocios Manejados</h3>  <br>
</div>
<div>
    <table class="tableList" width="900px" border="1" id="mainTable" align="center">
    <tr><th>No</th><th>Trafico</th>
        <?
        $year=Utils::addDate( $fechainicial2,0,0,0,"Y");
        $c=1;
        for($i=$year-2;$i<=$year;$i++)
        {
        ?>
        <th><?=$i?></th>
        <th width="12%">Variacion <?=$i?>/<?=$i-1?></th>
        <?
        }
        ?>
        </tr>
        <?
        $serieX=array();
        $dataFechas=array();
        foreach($gridCompara as $key=> $r)
        {
            $serieX[]=".     ".utf8_encode($key);
        ?>
        <tr><td><?=$c++?></td><td><?=$key?></td>
        <?
        $year=Utils::addDate( $fechainicial2,0,0,0,"Y");
        for($i=$year-2;$i<=$year;$i++)
        {
        ?>
        <td class="number"><?=$r[$i]?></td>
        <?
        $var=($r[$i]/$r[$i-1]);
        ?>
        <td class="number"><?=($var>0)?Utils::formatNumber($var-1,2)*100:"0"?>%</td>
        <?
        $dataFechas[$i][]=$r[$i];
        }
        ?>
        </tr>
        <?
        }
        //print_r($serieX);
        $dataJSON=array();
        foreach($dataFechas as $fech => $d)
        {
            $dataJSON[]=array("name"=>$fech,"data"=>$d);
        }
        
        if($totalesCompara)
        {
        ?>
            <tr class="b number"><td colspan="2">totales</td>
        <?
        $year=Utils::addDate( $fechainicial2,0,0,0,"Y");
        for($i=$year-2;$i<=$year;$i++)
        {
        ?>
            <td><?=$totalesCompara[$i] ?></td>
            <td></td>
        <?
            }            

        ?>
            </tr>            
        <?
        }
        //$serieX[]="FCL";
        //$serieX[]="LCL";
        //$serieX[]=$mes;
            $data=array();
            $data_peso=array();
            //$name=$mes;
            
        foreach($grid["2011"] as $modalidad=> $gridMod)
        {
            foreach($gridMod as $mes =>$g)
            {
                if(!in_array($mes, $serieX))
                    $serieX[]=Utils::mesLargo ($mes);
                $data[$modalidad][]=($g["diferencia"]/$g["conta"])?($g["diferencia"]/$g["conta"]):0;
                $data_peso[$mes]+=$g["peso"];
            }
            
        }
        
        $dataJSON[]=array("name"=>"FCL","data"=>$data["FCL"]);
        $dataJSON[]=array("name"=>"LCL","data"=>$data["LCL"]);
        
        
        
        ?>

</table>
    <br>
<br>
<br>
<br>
<div align="center">
<h3>Resumen Comparativo de Negocios Manejados</h3>  <br>
La meta para este indicador está dada por el tiempo transcurrido desde la <br>
fecha de zarpe del buque hasta el arribo al mismo al puerto Colombiano.<br>

Las metas según la ruta y el servicio son las siguientes:<br>
USA LCL 4 días <span style="width: 120px" >&nbsp;</span>USA FCL 8 días
</div>
    <table align="center" width="90%">
    <tr>
        <td style=" margin: 0 auto" >
            
<div align="center" id="grafica1" ></div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica1',
                    height: 800,
                    title:"Movimientos de Traficos",
                    titleY:"Numero de Reportes",
                    plotBands: [
                        {
                            color: 'red',
                            width: 2,
                            value: 4,
                            label: {
                                text: 'Limite LCL',
                                style: {
                                    color: 'red',
                                    fontWeight: 'bold'
                                }
                            } 
                        }
                        ,
                        {
                            color: 'blue',
                            width: 2,
                            value: 8,
                            label: {
                                text: 'Limite FCL',
                                style: {
                                    color: 'blue',
                                    fontWeight: 'bold'
                                }
                            } 
                        }
                    ],                    
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
				});	
</script>



<br>
<br>
<div align="center">
<h3>Grafica por peso embarcado</h3>  <br>
</div>
    <table align="center" width="90%">
    <tr>
        <td style=" margin: 0 auto" >
            
<div align="center" id="grafica2" ></div>
        </td>
    </tr>
</table>

<?
$serieX=array();
$serieX[]="Estados Unidos";
$dataJSON=array();
foreach($data_peso as $mes => $d)
{
    $dataJSON[]=array("name"=>Utils::mesLargo ($mes),"data"=>$d);
}

?>
<script type="text/javascript">
    new ChartsColumn({
					renderTo: 'grafica2',
                    height: 800,
                    title:"Movimientos de Traficos",
                    titleY:"Numero de Reportes",                                       
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
				});	
</script>



<br>
<br>
<div align="center">
<h3>Cumplimiento</h3>  <br>
</div>
    <table align="center" width="90%">
    <tr>
        <td style=" margin: 0 auto" >
            
<div align="center" id="grafica3" ></div>
        </td>
    </tr>
</table>

<?
/*$serieX=array();
$serieX[]="Estados Unidos";
$dataJSON=array();
foreach($data_peso as $mes => $d)
{
    $dataJSON[]=array("name"=>Utils::mesLargo ($mes),"data"=>$d);
}
*/
$dataJSON=array();
$mes=$mesp;
$total=$indicador[$mes]["incumplimiento"]+$indicador[$mes]["cumplimiento"];
//echo $total;
$dataJSON[]=array("Cumplimiento",(($indicador[$mes]["cumplimiento"]/$total)*100));
$dataJSON[]=array("Incumplimiento",(($indicador[$mes]["incumplimiento"]/$total)*100));
?>
<script type="text/javascript">
    new ChartsPie({
					renderTo: 'grafica3',
                    height: 400,
                    title:"Movimientos de Traficos",
                    titleY:"Numero de Reportes",					
				    series: <?=json_encode($dataJSON)?>
				});	
</script>



<script>
    function imprimir()
    {
        $(".esconder").hide();
        Ext.getCmp("tab-panel").hidden=true;
        //alert("")
        window.print();
        //$(".esconder").show();
    }
</script>

<?
}
?>




