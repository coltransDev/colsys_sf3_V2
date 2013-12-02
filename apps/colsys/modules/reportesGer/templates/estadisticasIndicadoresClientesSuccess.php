<?
include_component("charts","column");
include_component("charts","pie");
include_component("charts","line");
$grid = $sf_data->getRaw("grid");
$indicador = $sf_data->getRaw("indicador");
//echo "<pre>";print_r($resul);echo "</pre>";
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

<?
include_component("reportesGer","filtrosEstadisticasIndicadoresClientes");

if($opcion){
?>
    
    <div align="center"><br />
        <div style="text-align: center; text-decoration-color: #0000FF; font-size: 18px;"><b><?echo "INDICADORES DE GESTION <br />"?></div>
        <div style="font-size: 18px; color:  #0000FF;"><b><?=$cliente?></b></div>
        <div style="font-size: 15px;"><?=$fechainicial?> a <?=$fechafinal?>
    </div><br />
<?
    $data=array();
    $dataEnd=array();
    $data_peso=array();
    $serieX = array();

    foreach($grid[$ano_ini] as $modalidad=> $gridMod){
        foreach($gridMod as $mes =>$g){
            if(!in_array($mes, $serieX))
                $serieX[$mes]=Utils::mesLargo ($mes);
            if($transporte=="Marítimo"){
                $data["FCL"][$mes]= (isset($data["FCL"][$mes]))?$data["FCL"][$mes]:null;
                $data["LCL"][$mes]= (isset($data["LCL"][$mes]))?$data["LCL"][$mes]:null;
            }
            if($transporte=="Aéreo"){
                $data["CONSOLIDADO"][$mes]= (isset($data["CONSOLIDADO"][$mes]))?$data["CONSOLIDADO"][$mes]:null;
                $data["BACK TO BACK"][$mes]= (isset($data["BACK TO BACK"][$mes]))?$data["BACK TO BACK"][$mes]:null;
            }
            $data[$modalidad][$mes]=($g["diferencia"]/$g["conta"])?(round($g["diferencia"]/$g["conta"])):0;
            $data_peso[$mes]+=$g["peso"];
            if($g["diferencia"]<0){
                $minY = $g["diferencia"]-1;
            }
        }
    }
    
    foreach($data as $mod => $mes){
        foreach($mes as $km => $vm){
                $dataEnd[$mod][] = $vm;
        }
    }
    
    ksort($serieX); // Organiza los datos por el key
    
    foreach($serieX as $s){
        $serieM[]=$s; // Corre el arreglo empezando por la pocisión 0
    }
    $serieX=$serieM;
    
    if($transporte=="Marítimo"){
        $dataJSON[]=array("name"=>"FCL","data"=>$dataEnd["FCL"]);
        $dataJSON[]=array("name"=>"LCL","data"=>$dataEnd["LCL"]);
        $meta = "<b>Meta LCL".$indi_LCL[$pais_origen]." días - FCL->".$indi_FCL[$pais_origen]." días.</b>";
        $plotLCL = $indi_LCL[$pais_origen];
        $plotFCL = $indi_FCL[$pais_origen];
        $meta = "<b>Meta LCL: ".$indi_LCL[$pais_origen]." días - FCL: ".$indi_FCL[$pais_origen]." días.</b>";
        $linkTransporte = "maritimo";        
    }
    if($transporte=="Aéreo"){
        $dataJSON[]=array("name"=>"CONSOLIDADO","data"=>$dataEnd["CONSOLIDADO"]);
        $dataJSON[]=array("name"=>"BACK TO BACK","data"=>$dataEnd["BACK TO BACK"]);
        $plotAIR = $indi_AIR[$pais_origen];
        $meta = "<b>Meta AEREO: ".$indi_AIR[$pais_origen]." días.</b>";
        $linkTransporte = "aereo";
    }
    
    switch($typeidg){
        case 1:
            $title = $ano_ini."- Coordinación de Embarque - ".$pais_origen." - "."$transporte";
            $leyendaIndicador = "La meta para este indicador está dada por el tiempo transcurrido desde la fecha de la primera instrucción hasta el arribo a puerto Colombiano.<br/>";
            $encFchIni = "Fch. 1er.Instrucci&oacute;n";
            $encFchEnd = "Fch. de Llegada";
            $encIdg = "Coord. Embarque";
            $dataFchIni = "ca_fchcreado";
            $dataFchEnd = "ca_fchllegada";
            break;
        case 2:
            $title = $ano_ini."- Tiempo de Tránsito - ".$pais_origen." - "."$transporte";
            $leyendaIndicador = "La meta para este indicador está dada por el tiempo transcurrido desde la fecha de zarpe y/o despegue hasta el arribo a puerto Colombiano.<br/>";
            $encFchIni = "Fch. Salida";
            $encFchEnd = "Fch. de Llegada";
            $encIdg = "Tiempo de Trán.";
            $dataFchIni = "ca_fchsalida_cd";
            $dataFchEnd = "ca_fchllegada";
            break;
        case 3:
            $title = $ano_ini." - ";
            $title.= $transporte=="Marítimo"?"Oportunidad en el Zarpe":"Oportunidad en el Despegue";
            $title.= " - ".$pais_origen." - ".$transporte;
            $leyendaIndicador = "La meta para este indicador está dada por el tiempo transcurrido desde el primer status de Carga Embarcada, hasta la fecha de zarpe del buque o despegue del avión.<br/>";
            $encFchIni = "Fch. Carga con Reserva";
            $encFchEnd = "Fch. de Salida";
            $encIdg = "Oport. Zarpe/Despegue";
            $dataFchIni = "ca_fchsalida_eta";
            $dataFchEnd = "ca_fchsalida_ccr";
            break;
        case 4:
            $title = $ano_ini."- Oportunidad en la Llegada ".$pais_origen." - "."$transporte";
            $leyendaIndicador = "La meta para este indicador está dada por la diferencia entre la fecha confirmada en el aviso de ETA y la fecha real de llegada.<br/>";
            $encFchIni = "Fch. Informada en ETA";
            $encFchEnd = "Fch. de Llegada";
            $encIdg = "Oport. Llegada";
            $dataFchIni = "ca_fchllegada_eta";
            $dataFchEnd = "ca_fchllegada_cd";
            break;
        case 5:
            $title = $ano_ini."- Oportunidad la Facturación ".$pais_origen." - "."$transporte";
            $leyendaIndicador = "La meta para este indicador está dada por la diferencia entre la fecha de llegada y la fecha de facturación.<br/>";
            $encFchIni = "Fch. Llegada";
            $encFchEnd = "Fch. de Factura";
            $encIdg = "Oport. Facturación";
            $dataFchIni = "ca_fchllegada";
            $dataFchEnd = "ca_fchfactura";
            break;
    }

?>
    <table align="center" width="900" border="3" class="box">
        <tr>
            <td colspan="2">
                <div align="center" id="grafica1" ></div><br />
                    <?=$leyendaIndicador?>
                    <?=$meta?>     
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
    </table><br/>
<?  if($typeidg==2){?>
    <table align="center" width="900" border="3" class="box">
        <tr>
            <td 
                <div align="center" id="grafica4" ></div>
            </td>
        </tr>
    </table>
    <br/><br/>
    <?}?>    
    <form action="#" method="post" name='form1' id="form1" >
        <table border="1" class="tableList" align="center" style="font-size: 10" width="300px">
            <th style="text-align: center" colspan="15"><b><?echo "ESTADISTICAS DE CARGA ".strtoupper($pais_origen).'<br />'.'Periodo: '.$fechainicial." a ".$fechafinal;?></b></th>
            <tr>
                <th scope="col" style=" text-align: center"><b>A&ntilde;o</b></th>
                <th scope="col" style=" text-align: center"><b>Mes</b></th>
                <th scope="col" style=" text-align: center"><b>R.Negocio</b></th>
                <th scope="col" style=" text-align: center; width: 80px"><b>Orden No.</b></th>
                <th scope="col" style=" text-align: center"><b>Origen</b></th>
                <th scope="col" style=" text-align: center"><b>Destino</b></th>
                <th scope="col" style=" text-align: center;width: 200px"><b>Proveedor</b></th>
                <th scope="col" style=" text-align: center"><b>Modalidad</b></th>
                <th scope="col" style=" text-align: center"><b>Piezas</b></th>
                <th scope="col" style=" text-align: center"><b>Peso</b></th>
                <th scope="col" style=" text-align: center"><b>Volumen</b></th>
                <th scope="col" style=" text-align: center; width: 50px"><b><?=$encFchIni?></b></th>
                <th scope="col" style=" text-align: center; width: 50px"><b><?=$encFchEnd?></b></th>
                <th scope="col" style=" text-align: center;width: 50px"><b><?=$encIdg?></b></th>
                <th scope="col" style=" text-align: center;width: 50px"><b>Observaciones</b></th>
            </tr>
<?
            $total_peso = 0;
            $total_piezas = 0;
            $total_volumen = 0;
            $nameObs = "obsIdg".$typeidg."_";
            
            foreach( $resul as  $r){

                $idreporte = $r["ca_idreporte"];
                $reporte = Doctrine::getTable("Reporte")->find($idreporte);            
                $observacionesIdg = $reporte->getProperty("idg".$typeidg);
                
                $total_piezas+=$r["ca_piezas"];
                $total_peso+=$r["ca_peso"];
                $total_volumen+=$r["ca_volumen"];
                $color = "black";
                $Obs = "false";

                $oids = array();
                $oids[] = $idreporte;
                
                if($transporte == "Marítimo"){
                    if($r[$dataIdg] > $indi_LCL[$pais_origen] || $r[$dataIdg] > $indi_FCL[$pais_origen] ){
                        $color = "red";
                        $Obs = "true";
                    }
                }
                if($transporte == "Aéreo"){
                    if($r[$dataIdg] > $indi_AIR[$pais_origen]){
                        $color = "red";
                        $Obs = "true";
                    }
                }
?>
            <tr>
                <td><?=$r["ca_ano1"]?></td>
                <td><?=$r["ca_mes1"]?></td>
                <td><a href="../traficos/listaStatus/modo/<?=$linkTransporte?>?reporte=<?=$r['ca_consecutivo']?>" target='_blank'><?=$r['ca_consecutivo']?></a></td>
                <td><?=$r["ca_orden"]?></td>
                <td><?=$r["ca_traorigen"]?></td>
                <td><?=$r["ca_ciudestino"]?></td>
                <td><?=$r["proveedor"]?></td>
                <td><?=$r["nva_modalidad"]?></td>
                <td><?=$r["ca_piezas"]?></td>
                <td><?=$r["ca_peso"]?></td>
                <td><?=$r["ca_volumen"]?></td>
                <td><?=$r[$dataFchIni]?></td>
                <td><?=$r[$dataFchEnd]?></td>
                <td style=" text-align: center; border-right-color:black; color:<?=$color?>"><?=$r[$dataIdg]?><?//=$r[$dataIdg]==0?1:$r[$dataIdg]?></td>
                <?if($Obs=="true"){?>
                <td><textarea  name='<?=$nameObs?><?=$idreporte?>' value="<?=$observacionesIdg?>" style="width:320px" rows="3" spellcheck="false"><?=$observacionesIdg?></textarea></td>
                <?}?>
                 <input type="hidden" name='oid[]' value="<?=$idreporte?>"/>
            </tr>
<?              
            }    
?>
                 <input type="hidden" name='typeIdg' value="<?=$typeidg?>"/>
        </table>
        <?if($typeidg == 1 || $typeidg == 2){?>
        <table border="0" class="tableList" align="center" style="font-size: 22" width="35%">
            <tr>
                <th>TOTALES</th>
                <th>Peso = <?=$total_peso?></th>
                <th>Piezas = <?=$total_piezas?></th>
                <th>Volumen = <?=$total_volumen?></th>
            </tr>
        </table><?}?><br/>
        <input id="bguardar" class="esconder" type='button' name='accion' value='Guardar' onclick="validar()" />
    </form>
    
    
<!--Gráfica Indicadores-->

<script type="text/javascript">
        Highcharts.setOptions({
            colors: ['#B7E84D', '#62B1FF']
        });
        new ChartsColumn({
            renderTo: 'grafica1',
            width: 900,
            height: 450,
            title:'<?=$title?>',
            titleY:"Dias",
            minY: <?=$minY?$minY:0?>,
            plotBands: [
            <?if($transporte=="Marítimo"){?>
                {
                    color: '#62B1FF',
                    width: 2,
                    value: <?=$plotLCL?$plotLCL:0?>,
                    label: {
                        text: 'Limite LCL',
                        style: {
                            color: '#62B1FF',
                            fontWeight: 'bold'
                        }
                    } 
                }
                ,
                {
                    color: '#B7E84D',
                    width: 2,
                    value: <?=$plotFCL?$plotFCL:0?>,
                    label: {
                        text: 'Limite FCL',
                        style: {
                            color: '#B7E84D',
                            fontWeight: 'bold'
                        }
                    } 
                }
            <?}else if(($transporte=="Aéreo")){?>
                {
                    color: '#62B1FF',
                    width: 2,
                    value: <?=$plotAIR?$plotAIR:0?>,
                    label: {
                        text: 'Limite LCL',
                        style: {
                            color: '#62B1FF',
                            fontWeight: 'bold'
                        }
                    } 
                }
            <?}?>
            ],
            tooltip: { 
                pointFormat: '{series.name}: <b>{point.y}</b>',
            },
            serieX: <?=json_encode($serieX)?>,					
            series: <?=json_encode($dataJSON)?>
        });	
    </script>
    
<!--Gráfica Porcentaje de Cumplimiento-->

<?
    $dataJSON=array();

    foreach($indicador as $mes => $d){
        $total+=$d["incumplimiento"]+$d["cumplimiento"];
        $incumplimiento+=$d["incumplimiento"];
        $cumplimiento+=$d["cumplimiento"];
    }

    $dataJSON[]=array("Cumplimiento",round((($cumplimiento/$total)*100),0));
    $dataJSON[]=array("Incumplimiento",round((($incumplimiento/$total)*100),0));
    
?>
    <script type="text/javascript">
        Highcharts.setOptions({
            colors: ['#2f7ed8', '#AA4643']
        });
        Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
            return {
                radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
                stops: [
                    [0, color],
                    [1, Highcharts.Color(color).brighten(-0.2).get('rgb')] // darken
                ]
            };
		});
        new ChartsPie({
            renderTo: 'grafica2',
            height: 380,
            title:"Porcentaje de Cumplimiento",
            titleY:"",
            plotOptions: {
                pie: {
                    dataLabels: {
                        formatter: function () {
                            /*return Math.round(this.percentage * 100) / 100 + ' %';*/
                            return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
                        },
                        enabled: true,
                        distance: -50,
                        color: 'black',
                    }
                }
            },
            tooltip: { 
                pointFormat: '{series.name}: <b>{point.y}%</b>',
                percentageDecimals: 0
            },
            series: <?=json_encode($dataJSON)?>
        })  
    </script>
    
<!--Gráfica Tendencia de Cumplimiento-->

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
            height: 380,
            //width: 300,
            title:"Tendencia de Cumplimiento",
            titleY:"Porcentaje (%)",
            legend: {
                enabled: false
            },
            serieX: <?=json_encode($serieX)?>,					
            series: <?=json_encode($dataJSON)?>
        });	
    </script>
    <br /><br />
    
<!--Gráfica de Peso-->

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
            height: 350,
            title:"<?=$ano_ini?>"+" - Peso Embarcado - "+ "<?=$pais_origen?>",
            titleY:"Kg",
            serieX: <?=json_encode($serieX)?>,
            series: <?=json_encode($dataJSON)?>
        });
    
        function imprimir(){
            $(".esconder").hide();
            $(".mostrar").show();
            window.print();
        }

        function validar(){
            $("#bguardar").attr("disabled",true);

            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("reportesGer/guardarObservaciones")?>',
                method: 'POST',
                form: 'form1',
                success: function(a,b){
                    if(a.responseText.search(/error/i)==-1){                    
                        alert("Las observaciones se guardaron correctamente");
                        $("#bguardar").attr("disabled",false);
                    }else{
                        alert("Error:"+a.responseText.replace(/<br \/>/gi ,"\n"));
                        $("#bguardar").attr("disabled",false);
                    }
               },
               failure: function(a,b){
                   alert("Error:"+a.responseText.toString());
                   $("#bguardar").attr("disabled",false);
               }
            });
        }
    </script>
<?
}
?>
