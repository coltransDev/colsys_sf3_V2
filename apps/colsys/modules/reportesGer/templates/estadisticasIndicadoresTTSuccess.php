<?
//echo $nmeses;
include_component("charts","column");
include_component("charts","pie");
include_component("charts","line");
include_component("widgets", "widgetPais");
$dataJSON=array();
$grid = $sf_data->getRaw("grid");
$indicador = $sf_data->getRaw("indicador");
//echo "<pre>";print_r($grid);echo "</pre>";
?>
<div align="center" class="esconder" >
<br />
<h3> Estadisticas Indicadores de Gesti&oacute;n </h3>
<br />
<br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center"  class="mostrar" style="display: none">
    <div style="height: 1500px;">
        <div style="font-size: 50px;height: 250px"><b>INDICADORES DE GESTION</b></div>
        <div style="height: 600px"><img src="/images/clientes/henkel_logo.jpg" /></div>
        <div style="font-size: 32px;height: 300px">Enero-<?=$nom_mes?> de <?=$ano?></div><br><br><br>
        <div style="height: 250px"><img src="/images/logos/logoCOLTRANS.png" /></div>
        </div>
        
        
    </div>
</div>
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

        <?
        //print_r($serieX);
        
 
        
       
        $data=array();
        $data_peso=array();
            
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
        $serieM=$serieX;
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
                    height: 600,
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
$serieX[]=$pais_origen;
$dataJSON=array();
foreach($data_peso as $mes => $d)
{    
    $dataJSON[]=array("name"=>Utils::mesLargo ($mes),"data"=>$d);
}

?>
<script type="text/javascript">
    new ChartsColumn({
					renderTo: 'grafica2',
                    height: 600,
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


<br>
<br>
<div align="center">
<h3>Tendencia del cumplimiento</h3>  <br>
</div>
    <table align="center" width="90%">
    <tr>
        <td style=" margin: 0 auto" >
            
<div align="center" id="grafica4" ></div>
        </td>
    </tr>
</table>

<?
//$serieX=array();
$serieX=$serieM;

$dataJSON=array();
//print_r($indicador);
foreach($indicador as $mes => $d)
{
    $total=$d["cumplimiento"]+$d["incumplimiento"];
    $porcentajeMes[]=(($d["cumplimiento"]/$total)*100);
}

    $total=$d["cumplimiento"]+$d["incumplimiento"];
    $dataJSON[]=array("name"=>"Cumplimiento","data"=>$porcentajeMes);

?>
<script type="text/javascript">
    new ChartsLine({
					renderTo: 'grafica4',
                    height: 400,
                    title:"Movimientos de Traficos",
                    titleY:"Numero de Reportes",                                       
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
				});	
</script>


<script>
    function imprimir()
    {
        $(".esconder").hide();
        $(".mostrar").show();
        Ext.getCmp("tab-panel").hidden=true;
        //alert("")
        window.print();
        //$(".esconder").show();
    }
</script>

<?
}
?>




