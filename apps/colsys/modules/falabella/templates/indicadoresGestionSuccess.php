<?php

include_component("charts","column");
include_component("charts","pie");
include_component("charts","line");
include_component("falabella", "formMenuIndicadoresPanel");
include_component("pm", "widgetDepartamentos");
include_component("pm", "widgetAsignaciones");
include_component("pm", "widgetGrupos");
include_component("widgets", "widgetPais");
$dataJSON=array();
$grid = $sf_data->getRaw("grid");
$entcarga = $sf_data->getRaw("entcarga");
$indicador = $sf_data->getRaw("indicador");

if($transporte=="A?reo"){
    $rangoMax=10;
}elseif($transporte=="Mar?timo"){
    $rangoMax=15;    
}
//echo "<pre>";print_r($grid);echo "</pre>";
//echo "<pre>";print_r($entcarga);echo "</pre>";

?>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div><br />
<div align="center"  class="mostrar" style="display: none">
    <div style="height: 150px;">
        <div style="font-size: 30px;height: 30px"><b>INDICADORES DE GESTION</b></div>
        <div style="height: 50px"><img src="/images/clientes/falabella_logo.jpg" /></div>
        <div style="font-size: 20px;height: 30px;color: blue"><b><?=strtoupper($pais_origen)?></b></div>
        <div style="font-size: 15px;height: 30px"><b><?=strtoupper($transporte)?></b></div>
        <!--<div style="font-size: 32px;height: 200px"><?=$mesinicial?> a <?=$mesfinal?> de <?=$ano_ini?></div><br><br><br>
        <div style="height: 150px"><img src="/images/logos/logoCOLTRANS.png" /></div>-->
    </div>
</div>

<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>

<?
if($opcion=='buscar'){
?>
<table border="1" class="tableList" align="center" style="font-size: 10" width="90%">
    <tr>
        <th <?if($transporte=="A?reo"){echo "colspan='17'";}elseif($transporte=="Mar?timo"){echo "colspan='20'";}?> style="text-align: center"><b><?echo "ESTADISTICAS DE CARGA ".strtoupper($pais_origen).'<br />'.'Periodo: '.$fechainicial." a ".$fechafinal;
        ?></b></th>
    </tr>
    <?if($transporte=="A?reo"){?>
    <tr>
        <th scope="col" style=" text-align: center"><b>A&ntilde;o</b></th>
        <th scope="col" style=" text-align: center"><b>Mes</b></th>
        <th scope="col" style=" text-align: center"><b>Origen</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Destino</b></th>
        <th scope="col" style=" text-align: center;width: 200px"><b>Proveedor</b></th>
        <th scope="col" style=" text-align: center"><b>Transporte</b></th>
        <th scope="col" style=" text-align: center;width: 100px"><b>Modalidad</b></th>
        <th scope="col" style=" text-align: center"><b>Reporte de Negocio</b></th>
        <th scope="col" style=" text-align: center"><b>Piezas</b></th>
        <th scope="col" style=" text-align: center"><b>Peso</b></th>
        <th scope="col" style=" text-align: center"><b>Volumen</b></th>
        <th scope="col" style=" text-align: center"><b>Fch. Salida</b></th>
        <th scope="col" style=" text-align: center"><b>Fch. Llegada</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Tiempo de Tr?n.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Envio Doc.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Ent. M/cia.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Ing. Asn</b></th>
    </tr>
    <?}elseif($transporte="Mar?timo"){?>
    <tr>
        <th scope="col" style=" text-align: center"><b>A&ntilde;o</b></th>
        <th scope="col" style=" text-align: center"><b>Mes</b></th>
        <th scope="col" style=" text-align: center"><b>Origen</b></th>
        <th scope="col" style=" text-align: center"><b>Destino</b></th>
        <th scope="col" style=" text-align: center;width: 200px"><b>Proveedor</b></th>
        <th scope="col" style=" text-align: center"><b>Transporte</b></th>
        <th scope="col" style=" text-align: center"><b>Modalidad</b></th>
        <th scope="col" style=" text-align: center"><b>Reporte de Negocio</b></th>
        <th scope="col" style=" text-align: center;width: 220px"><b>Tipo Contenedor</b></th>
        <th scope="col" style=" text-align: center"><b># Conten.</b></th>
        <th scope="col" style=" text-align: center"><b>Teus</b></th>
        <th scope="col" style=" text-align: center"><b>Piezas</b></th>
        <th scope="col" style=" text-align: center"><b>Peso</b></th>
        <th scope="col" style=" text-align: center"><b>Volumen</b></th>
        <th scope="col" style=" text-align: center"><b>Fch. Salida</b></th>
        <th scope="col" style=" text-align: center"><b>Fch. Llegada</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Tiempo de Tr?n.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Envio Doc.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Ent. M/cia.</b></th>
        <th scope="col" style=" text-align: center;width: 80px"><b>Fch. Ing. Asn</b></th>
    </tr>
<?
    }
    $total_peso = 0;
    $total_piezas = 0;
    $total_volumen = 0;
    foreach( $resul as  $r){
        
        $idreporte = $r["ca_idreporte"];
        $reporte = Doctrine::getTable("Reporte")->find($idreporte);

        $parametros = ParametroTable::retrieveByCaso("CU103", null, null, '900017447' );
        
        foreach($parametros as $parametro){

            $valor = explode(":", $parametro->getCaValor());
            $name = $valor[0];
            $type = $valor[1];

            switch($name){
                case "fchdocorig":
                    $fchdocorig = $reporte->getProperty($name);
                    break;
                case "fchentregamcia":
                    $fchentregamcia = $reporte->getProperty($name);
                    break;
                case "fchingresoasn":
                    $fchingresoasn = $reporte->getProperty($name);
                    break;
            }
        }
        if($transporte=="A?reo"){
?>
            <tr>
                <td><?=$r["ca_ano"]?></td>
                <td><?=$r["ca_mes"]?></td>
                <td><?=$r["ca_traorigen"]?></td>
                <td><?=$r["ca_ciudestino"]?></td>
                <td><?=$r["ca_nombre"]?></td>
                <td><?=$r["ca_transporte"]?></td>
                <td><?=$r["ca_modalidad"]?></td>
                <td><?=$r["ca_consecutivo"]?></td>
                <td><?=$r["ca_piezas"]?></td>
                <td><?=$r["ca_peso"]?></td>
                <td><?=$r["ca_volumen"]?></td>
                <td><?=$r["ca_fchsalida"]?></td>
                <td><?=$r["ca_fchllegada"]?></td>
                <td style=" text-align: center;"><?=$r["ca_diferencia"]?></td>
                <td style=" text-align: center;"><?=$fchdocorig?></td>
                <td style=" text-align: center;"><?=$fchentregamcia?></td>
                <td style=" text-align: center;"><?=$fchingresoasn?></td>
            </tr>
<?

        }elseif($transporte=="Mar?timo"){
?>
            <tr>
                    <td><?=$r["ca_ano1"]?></td>
                    <td><?=$r["ca_mes1"]?></td>
                    <td><?=$r["ca_traorigen"]?></td>
                    <td><?=$r["ca_ciudestino"]?></td>
                    <td><?=$r["proveedor"]?></td>
                    <td><?=$r["ca_transporte"]?></td>
                    <td><?=$r["ca_modalidad"]?></td>
                    <td><?=$r["ca_consecutivo_sub"]?></td>
                    <td><?=$r["ca_concepto"]?></td>
                    <td><?=$r["ncontenedores"]?></td>
                    <td><?=$r["teus"]?></td>
                    <td><?=$r["ca_piezas"]?></td>
                    <td><?=$r["ca_peso"]?></td>
                    <td><?=$r["ca_volumen"]?></td>
                    <td><?=$r["ca_fchsalida"]?></td>
                    <td><?=$r["ca_fchllegada"]?></td>
                    <td style=" text-align: center;"><?=$r["ca_diferencia"]?></td>
                    <td style=" text-align: center;"><?=$fchdocorig?></td>
                    <td style=" text-align: center;"><?=$fchentregamcia?></td>
                    <td style=" text-align: center;"><?=$fchingresoasn?></td>
            </tr>
            
<?          
        }
        $total_piezas+=$r["ca_piezas"];
        $total_peso+=$r["ca_peso"];
        $total_volumen+=$r["ca_volumen"];
    }    
?>
<br />
<table border="1" class="tableList" align="center" style="font-size: 22" width="35%">
    <tr>
        <th>TOTALES</th>
        <th>Peso = <?=$total_peso?></th>
        <th>Piezas = <?=$total_piezas?></th>
        <th>Volumen = <?=$total_volumen?></th>
    </tr>
</table>
            
            
</table><br /><br /><br />       
        
<table class="tableList" width="700px" border="1" id="mainTable" align="center">
    <?
    $data=array();
    $serieX=array();
    
    foreach($grid[$ano_ini] as $mes=> $g){
        if(!in_array($mes, $serieX)){
            $serieX[]=Utils::mesLargo ($mes);
            $data[$mes]=round((($g["diferencia"]/$g["conta"])?($g["diferencia"]/$g["conta"]):0),1);
        }
    }
    
    $dataJSON=array();
    $dato=array();
    foreach($data as $mes => $d1){
        $dato[]=$d1;        
    }
    $dataJSON[]=array("name"=>$ano_ini,"data"=>$dato);
  
?>
</table>

<div align="center">
</div>
<table align="center" width="60%" border="2" class="box">
    <tr>
        <td>
            <div align="center" id="grafica1" ></div>
        </td>
        <td>
            <div align="center" id="grafica2" ></div>
        </td>
    </tr> 
    <tr>
        <td>
            <div align="center" id="grafica3" ></div>
        </td>
        <td>
            <div align="center" id="grafica4" ></div>
        </td>
    </tr> 
</table>
<!--<table align="center" width="40%" border="2" class="box">
    <tr>
        <td>
            <div align="center" id="grafica1" ></div>
        </td>
    </tr>    
</table>-->
<script type="text/javascript">
    var chart1;
        chart1=new ChartsColumn({
					renderTo: 'grafica1',
                    height: 300,
                    width: 500,
                    title:"TIEMPO DE TRANSITO",
                    titleY:"Dias",
                    maxY: <?=$rangoMax?>,
                                               
                    /*plotBands: [
                        {
                            color: 'blue',
                            width: 2,
                            value: <?//=($indi_FCL[$pais_origen])?$indi_FCL[$pais_origen]:0?>,
                            label: {
                                text: 'Limite FCL',
                                style: {
                                    color: 'blue',
                                    fontWeight: 'bold'
                                }
                            } 
                        }
                    ], */                   
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
				});
</script>

<br>
<br>
<!--<div align="center">
</div>
<table align="center" width="30%" border="2" class="box">
    <tr>
        <td style=" margin: 0 auto" >
            <div align="center" id="grafica2" ></div>
        </td>
    </tr>
</table>-->

<?

$data1=array();
$serieX=array();    

    foreach($entcarga[$ano_ini] as $mes=> $g){
        if(!in_array($mes, $serieX)){
            $serieX[]=Utils::mesLargo ($mes);
            $data1[$mes]=($g["diff_fchentregamcia"]/$g["conta_fchentregamcia"])?($g["diff_fchentregamcia"]/$g["conta_fchentregamcia"]):0;            
        }
    }
    //echo "<pre>";print_r($data1);echo "</pre>";
    $dataJSON=array();
    $dat=array();
    foreach($data1 as $mes => $d){
        $dat[]=$d;        
    }
    $dataJSON[]=array("name"=>$ano_ini,"data"=>$dat);
   
?>

<script type="text/javascript">
    
    var chart2;
        chart2=new ChartsColumn({
					renderTo: 'grafica2',
                    height: 300,
                    width: 500,
                    title:"TIEMPO DE ENTREGA DE LA CARGA POR PARTE DEL SHIPPER",
                    titleY:"Dias",
                    //minY: <?//=$rangoMin?>,
                    minY: -10,
                                        
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
                    
				});	
                
   
</script>

<br>
<br>
<!--<div align="center">
</div>
<table align="center" width="50%" border="2" class="box">
    <tr>
        <td style=" margin: 0 auto" >
            <div align="center" id="grafica3" ></div>
        </td>
    </tr>
</table>-->

<?

$data2=array();
$serieX=array();    

    foreach($entcarga[$ano_ini] as $mes=> $g){
        if(!in_array($mes, $serieX)){
            $serieX[]=Utils::mesLargo ($mes);
            $data2[$mes]=($g["diff_fchdocorig"]/$g["conta_fchdocorig"])?($g["diff_fchdocorig"]/$g["conta_fchdocorig"]):0;
        }
    }
    //echo "<pre>";print_r($data1);echo "</pre>";
    $dataJSON=array();
    $dat2=array();
    foreach($data2 as $mes => $d2){
        $dat2[]=$d2;        
    }
    $dataJSON[]=array("name"=>$ano_ini,"data"=>$dat2);
  
?>

<script type="text/javascript">
    var chart3;
        chart3=new ChartsColumn({
					renderTo: 'grafica3',
                    height: 300,
                    width: 500,
                    title:"TIEMPO DE ENTREGA DOCUMENTACION",
                    titleY:"Dias",
                    minY: -10,
                                        
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>,
                    extraStyle: {
                        legend: {
                        display: 'right'
                        }
                    }
				});	
</script>

<br>
<br>
<!--<div align="center">
</div>
<table align="center" width="20%" border="2" class="box">
    <tr>
        <td style=" margin: 0 auto" >
            <div align="center" id="grafica4" ></div>
        </td>
    </tr>
</table>-->

<?

$data3=array();
$serieX=array();    

    foreach($entcarga[$ano_ini] as $mes=> $g){
        if(!in_array($mes, $serieX)){
            $serieX[]=Utils::mesLargo ($mes);
            $data3[$mes]=($g["diff_fchingresoasn"]/$g["conta_fchingresoasn"])?($g["diff_fchingresoasn"]/$g["conta_fchingresoasn"]):0;
        }
    }
    //echo "<pre>";print_r($data1);echo "</pre>";
    $dataJSON=array();
    $dat3=array();
    foreach($data3 as $mes => $d3){
        $dat3[]=$d3;        
    }
    $dataJSON[]=array("name"=>$ano_ini,"data"=>$dat3);
 
?>

<script type="text/javascript">
    var chart4;
        chart4=new ChartsColumn({
					renderTo: 'grafica4',
                    height: 300,
                    width: 500,
                    title:"INGRESO DE ASN",
                    titleY:"Dias",
                    maxY: 10,
                                        
					serieX: <?=json_encode($serieX)?>,					
				    series: <?=json_encode($dataJSON)?>
                    
				});	
</script>
<?
}
?>
        
<script language="javascript">
   
var tabs = new Ext.FormPanel({
	labelWidth: 75,
	border:true,
	fame:true,
	width: 600,    
	standardSubmit: true,  
        id: 'formPanel',
	items: {
		xtype: 'tabpanel',
		activeTab: 0,
		defaults:{autoHeight:true, bodyStyle:'padding:10px'},
		id: 'tab-panel', 
		items:[
                new FormMenuIndicadoresPanel()              
        ]
	},
	buttons: [
            {
                text: 'Continuar',
                handler: function(){
                            var tp = Ext.getCmp("tab-panel");

                            var owner=Ext.getCmp("formPanel");
                            if( tp.getActiveTab().getId()=="estadisticas"){
                                owner.getForm().getEl().dom.action='<?=url_for("falabella/indicadoresGestion")?>';
                            }
                            owner.getForm().submit();
                }
            }]
});
tabs.render("container");


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