<?
include_component("charts","column");
include_component("charts","pie");
include_component("charts","line");
$grid = $sf_data->getRaw("grid");
$indicador = $sf_data->getRaw("indicador");
//echo "<pre>";print_r($grid);echo "</pre>";
?>
<div align="center" class="esconder" >
    <br />
    <h3>INDICADORES DE GESTION CLIENTES COLTRANS S.A.S.</h3>
    <br /><br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center"  class="mostrar" style="display: none">
    <div style="height: 50px; text-align: left;"><img src="/images/logos/logoCOLTRANS.png" /></div>
</div>

<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
    include_component("reportesGer","filtrosEstadisticasIndicadoresTT");
    if($opcion){
?>
    
    <div align="center"><br />
        <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><?echo "INDICADORES DE GESTION <br />"?></div>
        <div style="font-size: 18px; color:  #0000FF;"><b><?=$cliente?></b></div>
        <div style="font-size: 15px;"><?=$fechainicial?> a <?=$fechafinal?>
    </div><br />
<?
    $data=array();
    $data_peso=array();
    $serieX = array();

    foreach($grid[$ano_ini] as $modalidad=> $gridMod){
        foreach($gridMod as $mes =>$g){
            if(!in_array($mes, $serieX))
                $serieX[$mes]=Utils::mesLargo ($mes);
            $data[$modalidad][]=($g["diferencia"]/$g["conta"])?(round($g["diferencia"]/$g["conta"])):0;
            $data_peso[$mes]+=$g["peso"];
        }
    }
    ksort($serieX); // Organiza los datos por el key
    
    foreach($serieX as $s){
        $serieM[]=$s; // Corre el arreglo empezando por la pocisión 0
    }
    $serieX=$serieM;
    
    $dataJSON[]=array("name"=>"FCL","data"=>$data["FCL"]);
    $dataJSON[]=array("name"=>"LCL","data"=>$data["LCL"]);
?>
    <table align="center" width="70%" border="3" class="box">
        <tr>
            <td colspan="2">
                <div align="center" id="grafica1" ></div><br />
<?
                    if($typeidg==1){
                        $title = $ano_ini."- Coordinación de Embarque - ".$pais_origen;
?>
                        La meta para este indicador está dada por el tiempo transcurrido desde la fecha de la primera instrucción del embarque hasta el arribo al mismo al puerto Colombiano.<br/>
                        Las metas según la ruta y el servicio son las siguientes:<b><?=$pais_origen?> LCL <?=$indi_LCL[$pais_origen]?> días </b><span style="width: 120px" >&nbsp;</span><?=$pais_origen?> FCL <?=$indi_FCL[$pais_origen]?> días
<?
                    }else if ($typeidg==2){
                        $title = $ano_ini."- Tiempo de Tránsito - ".$pais_origen;
?>
                        La meta para este indicador está dada por el tiempo transcurrido desde la fecha de zarpe del buque hasta el arribo al mismo al puerto Colombiano.<br/>
                        Las metas según la ruta y el servicio son las siguientes:<b><?=$pais_origen?> LCL <?=$indi_LCL[$pais_origen]?> días </b><span style="width: 120px" >&nbsp;</span><?=$pais_origen?> FCL <?=$indi_FCL[$pais_origen]?> días
                    <?}?>
            </td>
        </tr>
        <tr>
            <td style="width: 50%">
                <div align="center" id="grafica2" ></div>
            </td>
            <td style="width: 50%">
                <div align="center" id="grafica3" ></div>
            </td>
        </tr> 
    </table>
    
    <script type="text/javascript">
        new ChartsColumn({
            renderTo: 'grafica1',
            height: 600,
            title:'<?=$title?>',
            titleY:"Dias",
            plotBands: [
                {
                    color: 'red',
                    width: 2,
                    value: <?=($indi_LCL[$pais_origen])?$indi_LCL[$pais_origen]:0?>,
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
                    value: <?=($indi_FCL[$pais_origen])?$indi_FCL[$pais_origen]:0?>,
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

<?
    $dataJSON=array();

    foreach($indicador as $mes => $d)
    {
        $total+=$d["incumplimiento"]+$d["cumplimiento"];
        $incumplimiento+=$d["incumplimiento"];
        $cumplimiento+=$d["cumplimiento"];
    }

    $dataJSON[]=array("Cumplimiento",round((($cumplimiento/$total)*100),0));
    $dataJSON[]=array("Incumplimiento",round((($incumplimiento/$total)*100),0));
?>
    <script type="text/javascript">
        new ChartsPie({
            renderTo: 'grafica2',
            height: 400,
            title:"Porcentaje de Cumplimiento",
            titleY:"",
            series: <?=json_encode($dataJSON)?>
        })  
    </script>

<?
    $serieX = array();
    $dataJSON=array();
    
    
    foreach($indicador as $mes => $d){
        $total=$d["cumplimiento"]+$d["incumplimiento"];
        $porcentajeMes[]=round((($d["cumplimiento"]/$total)*100),0);
        $serieX[$mes] = Utils::mesLargo ($mes);
    }
    ksort($serieX); // Organiza los datos por el key
    
    foreach($serieX as $s){
        $serieM[]=$s; // Corre el arreglo empezando por la pocisión 0
    }
    $serieX=$serieM;

    $dataJSON[]=array("name"=>"Cumplimiento","data"=>$porcentajeMes);
?>
    <script type="text/javascript">
        new ChartsLine({
            renderTo: 'grafica3',
            height: 400,
            title:"Tendencia de Cumplimiento",
            titleY:"Porcentaje (%)",                                       
            serieX: <?=json_encode($serieX)?>,					
            series: <?=json_encode($dataJSON)?>
        });	
    </script>
    <br /><br />
    <table align="center" width="70%" border="3" class="box">
        <tr>
            <td 
                <div align="center" id="grafica4" ></div>
            </td>
        </tr>
<?
        $serieX=array();
        $dataJSON=array();
        
        ksort($data_peso);
        foreach($data_peso as $mes => $d){    
            $dataJSON[]=array("name"=>Utils::mesLargo ($mes),"data"=>array($d));
        }
?>
        <script type="text/javascript">
            new ChartsColumn({
                renderTo: 'grafica4',
                height: 600,
                title:"<?=$ano_ini?>"+" - Peso Embarcado - "+ "<?=$pais_origen?>",
                titleY:"Kg",
                serieX: <?=json_encode($serieX)?>,
                series: <?=json_encode($dataJSON)?>
            });
        </script>
    </table><br/><br/>

    <script>
        function imprimir(){
            $(".esconder").hide();
            $(".mostrar").show();
            Ext.getCmp("tab-panel").hidden=true;
            window.print();
        }
    </script>
<?
}
?>