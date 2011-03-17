<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_component("helpdesk", "formIndicadoresGestionPanel");
include_component("pm", "widgetAsignaciones");
include_component("pm", "widgetGrupos");

$array = array();
$cuantos_lcs = 0;
$cuantos_lci = 0;
$totales = array();
$total_ing = 0;
$promedio_ing = 0;
$festivos = TimeUtils::getFestivos();
?>
<div align="center" >
<br />
<br />
</div>
<div align="center" id="container"></div
<?
if( $idgsistemas){
?>
<table width="80%" border="1" class="tableList" align="center">
    <tr>
        <th colspan="13" style="text-align: center"><b><?echo $type_est==1?"IDG: USUARIOS ATENDIDOS A TIEMPO ".date("Y-m-d"):($type_est==2?"ESTADISTICA TICKETS CERRADOS ".date("Y-m-d"):"ESTADISTICA TICKETS ABIERTOS ".date("Y-m-d"));
        ?></b></th>
    </tr>
    <tr>
        <th scope="col" style=" text-align: center"><b>Mes</b></th>
        <th scope="col" style=" text-align: center"><b>No. Ticket</b></th>
        <th scope="col" style=" text-align: center"><b>Titulo</b></th>
        <th scope="col" style=" text-align: center"><b>Usuario Asignado</b></th>
        <th scope="col" style=" text-align: center"><b>Fecha Creado</b></th>
        <th scope="col" style=" text-align: center"><b>Hora Creado</b></th>
        <th scope="col" style=" text-align: center"><b><?echo $type_est==1?"Fecha Respuesta":($type_est==2?"Fecha Cierre":"Fecha Ult. Seg.");?></b></th>
        <th scope="col" style=" text-align: center"><b><?echo $type_est==1?"Hora Respuesta":($type_est==2?"Hora Cierre":"Hora Ult. Seg.");?></b></th>
        <th scope="col" style=" text-align: center;width: 110px"><b>Grupo</b></th>
        <th scope="col" style=" text-align: center"><b>Reportado por</b></th>
        <th scope="col" style=" text-align: center"><b><?echo $type_est==1?"C�lculo IDG":($type_est==2?"Cerrado":"Abierto");?></b></th>
        <?if($type_est==3){?>
        <th scope="col" style=" text-align: center"><b>Sin seguimiento hace:</b></th>
        <th scope="col" style=" text-align: center"><b>Porcentaje</b></th>
            <?}?>
        <?if($type_est==1){?><th scope="col"style=" text-align: center"><b>Observaciones</b></th><?}?>

    </tr>
    <?
    foreach( $idgsistemas as  $idgsistema)
    {
        //C�lculo de horas laborales

        $hoy = date("Y-m-d H:i:s");
       
        $group = $idgsistema["ca_name"];
        switch($type_est){
            case 1:
                $fch_terminada = $idgsistema["ca_fchterminada"];
            break;
            case 2:
                $fch_terminada = $idgsistema["fch_close"];
            break;
            case 3:
                $fch_terminada = $idgsistema["fch_ultseg"];
            break;
        }

        
        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($idgsistema["ca_fchcreado"], "%d-%d-%d %d:%d:%d");
        $inicio = mktime($hor, $min, $seg, $mes, $dia, $ano);

        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($fch_terminada, "%d-%d-%d %d:%d:%d");
        $final = mktime($hor, $min, $seg, $mes, $dia, $ano);

        list($ano, $mes, $dia, $hor, $min, $seg) = sscanf($hoy, "%d-%d-%d %d:%d:%d");
        $hoy = mktime($hor, $min, $seg, $mes, $dia, $ano);

        switch($type_est){
            case 1:
                $calculo_seg = TimeUtils::calcDiff( $festivos, $inicio , $final );
            //Verifica si la tarea est� terminada, predetermina un total de 8 horas para tickets abiertos al momento de generar el informe.
                if ($fch_terminada==""){
                    $calculo_seg = '28800';
                }elseif($calculo_seg==0){
                    $calculo_seg = '60';
                }
            break;
            case 2:
                $calculo_seg = TimeUtils::calcDiff( $festivos, $inicio , $final );
            break;
            case 3:
                $calculo_seg = TimeUtils::calcDiff( $festivos, $inicio , $hoy ); // Tiempo que lleva el ticket abierto en seg
                $calculoultsg_seg = TimeUtils::calcDiff( $festivos, $final , $hoy ); // Tiempo hasta la fecha sin seguimiento en seg
                //Pasa los tiempos a formato HH:mm:ss
                $calculoultsg_hms = TimeUtils::workDiff($festivos, $idgsistema["ult_fch"], date("Y-m-d")).' d�as';
            break;
        }

        //Pasa los tiempos a formato HH:mm:ss
         $calculo_hms = TimeUtils::tiempoSegundos( $calculo_seg);
        
        // Establece los l�mites de Control
        if($calculo_hms>$lcs){
            $array_lcs[] = $calculo_seg;
            $cuantos_lcs = count($array_lcs);
        }elseif($calculo_hms<$lci){
            $array_lci[] = $calculo_seg;
            $cuantos_lci = count($array_lci);
        }
        
        //C�lculo de Tiempo por Servicio
        $array[] = $calculo_seg;
        $cuantos=count($array);

        //C�lculo de Tiempo por Ingeniero Asignado
        if(!isset( $totales[$idgsistema["ca_assignedto"]] )){
            $totales[$idgsistema["ca_assignedto"]] = array();
            $totales[$idgsistema["ca_assignedto"]]["total_tickets"] = 0;
            $totales[$idgsistema["ca_assignedto"]]["prom_tiempo"] = 0;
        }
        $totales[$idgsistema["ca_assignedto"]]["total_tickets"]++;
        $totales[$idgsistema["ca_assignedto"]]["prom_tiempo"]+=$calculo_seg;        

    ?>
        <tr>
        <td><?=$idgsistema["mes"]?></td>
        <td><a href="https://www.coltrans.com.co<?=url_for("helpdesk/verTicket?id=".$idgsistema["ca_idticket"])?>"><?=$idgsistema["ca_idticket"]?></a></td>
        <td><?=$idgsistema["ca_title"]?></td>
        <td><?=$idgsistema["ca_assignedto"]?></td>
        <td><?=$idgsistema["fechacreado"]?></td>
        <td><?=$idgsistema["horacreado"]?></td>
        <td><?echo $type_est==1?$idgsistema["fechaterminada"]:($type_est==2?$idgsistema["close_fch"]:$idgsistema["ult_fch"]);?></td>
        <td><?echo $type_est==1?$idgsistema["horaterminada"]:($type_est==2?$idgsistema["close_hou"]:$idgsistema["ult_hou"]);?></td>
        <td><?=$idgsistema["ca_name"]?></td>
        <td><?=$idgsistema["ca_login"]?></td>
        <td style=" text-align: right"><font color="<?echo $calculo_hms>$lcs?"red":($calculo_hms<$lci?"orange":"black")?>"><?=$calculo_hms?></font></td>
        <?if($type_est==3){?>
        <td style=" text-align: right; width: 60px "><?=$calculoultsg_hms?></td>
        <td><?=$idgsistema["ca_percentage"]?></td>
        <?}?>
        <?if($type_est==1){?><td><?=$idgsistema["ca_observaciones"]?></td><?}?>

    </tr>
<?
    }
    $promedio_seg = TimeUtils::array_avg($array);
    $promedio_hms = TimeUtils::tiempoSegundos($promedio_seg);
    $porcentaje_lcs = @round($cuantos_lcs*100/$cuantos,2);
    $porcentaje_lci = round($cuantos_lci*100/$cuantos,2);
?>

</table>
<br />
<table class="tableList" align="center" width="30%">
    <tr>
        <th colspan="4" style="text-align: center"><b>INDICADOR DE GESTION DPTO. DE SISTEMAS</b></th>
    </tr>
    <tr>
        <th colspan="1"><b>Indicador:</b></th>
        <td colspan="3"><?echo $type_est==1?"Usuarios atendidos a tiempo":($type_est==2?"Tickets Cerrados":"Tickets Abiertos");?></td>
    </tr>
    <tr>
        <th colspan="1"><b>Periodo:</b></th>
        <td colspan="3"><b><?=$fechaInicial?></b> al <b><?=$fechaFinal?></b></td>
    </tr>
    <tr>
        <th colspan="1"><b>Grupo:</b></th>
        <td colspan="3"><?=$group?></td>
    </tr>
    <tr>
        <th><b>Producto NO Conforme:</b></th>
        <th>No. Casos:&nbsp;<b><?=$cuantos_lcs?></b></th>
        <th>LCs:&nbsp;<?=$lcs?></th>
        <td><font color="red"><b><?=$porcentaje_lcs?>%</b></font></td>
    </tr>
    <tr>
        <th><b>Promedio Ponderado:</b></th>
        <th>No. Casos:&nbsp;<b><?=$cuantos?></b></th>
        <th>LC:&nbsp;&nbsp;<?=$lc?></th>
        <td><b><?=$promedio_hms?></b></td>
    </tr>
    <tr>
        <th><b>Registros inferiores a lci:</b></th>
        <th>No. Casos:&nbsp;<b><?=$cuantos_lci?></b></th>
        <th>LCi:&nbsp;<?=$lci?></th>
        <td><font color="orange"><b><?=$porcentaje_lci?>%</b></font></td>
    </tr>
</table>
<br />
<br />

<table class="tableList" align="center" width="20%" border="1">
     <tr>
        <th colspan="4" style="text-align: center"><b>ESTADISTICA POR ING. ASIGNADO</b></th>
    </tr>
    <tr>
        <th style="text-align: center"><b>Ingeniero</b></th>
        <th style="text-align: center"><b>No. Casos</b></th>
        <th style="text-align: center"><b>Promedio</b></th>
    </tr>
<?

    foreach( $totales as $key=>$val){
        $promedio = $val["prom_tiempo"]/$val["total_tickets"];
        $promedio_ing = TimeUtils::tiempoSegundos($promedio);
?>
  <tr>
        <th><b><?=$key?></b></th>
        <td align="center"><?=$val["total_tickets"]?></td>
        <td align="center" style=" text-align: right"><?if($promedio_ing>$lcs){?> <font color="red"><?=$promedio_ing?></font><?}elseif($promedio_ing<$lci){?><font color="orange"><?=$promedio_ing?></font><?}else{echo $promedio_ing;}?></td>
  </tr>
<?
    }
?>
  
</table>
<?
}
?>
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
		items:[
                new FormIndicadoresGestionPanel()              
        ]
	},
	buttons: [
            {
                text: 'Continuar',
                handler: function(){
                            var tp = Ext.getCmp("tab-panel");

                            var owner=Ext.getCmp("formPanel");
                            if( tp.getActiveTab().getId()=="estadisticas"){
                                owner.getForm().getEl().dom.action='<?=url_for("helpdesk/reporteIdgSistemas")?>';
                            }
                            owner.getForm().submit();
                }
            }]
});
tabs.render("container");

/*
 //informaci�n a graficar
   var data = [
            ['1erTrim','02:21:57','01:00:00'],
            ['2doTrim','02:21:57','01:00:00'],
            ['3erTrim','02:09:44','01:00:00'],
            ['4toTrim','01:44:37','01:00:00']
   ];

Ext.onReady(function(){

    var store = new Ext.data.ArrayStore({
       fields:[
           {name:'trimestre'},
           {name:'limite_sup', type: 'date', dateFormat: 'H:i:s'},
           {name:'limite_ctr', type: 'date', dateFormat: 'H:i:s'},
           {name:'limite_inf', type: 'date', dateFormat: 'H:i:s'}
       ]
    });
    store.loadData(data); // se carga la info en el store


    new Ext.Panel({
        width: 700,
        height: 400,
        renderTo: document.body,
        title: 'Column Chart with Reload - Hits per Month',
        tbar: [{
            text: 'Load new data set'
            
        }],
        items: {
            xtype: 'linechart',
            store: store,
            xField: 'trimestre',
	    url: '/css/ext/charts.swf',
            xAxis: new Ext.chart.CategoryAxis({
                title: 'A�o'

            }),
            yAxis: new Ext.chart.TimeAxis({
                title: 'Limites',
                labelRenderer: function(date) { return date.format('H:i:s')}

            }),
            series: [{
                yField: 'limite_sup',
                displayName: 'LCS'
            	},{
                type: 'line',
                yField: 'limite_ctr',
                displayName: 'LC'
	            },{
                type: 'line',
                yField: 'limite_inf',
                displayName: 'LCi'
	            }],
            extraStyle: {
               xAxis: {
                   labelRotation: -90
                },
                legend: {
                    display: 'right'
            	}
            }
        }
    });
});

*/

</script>
