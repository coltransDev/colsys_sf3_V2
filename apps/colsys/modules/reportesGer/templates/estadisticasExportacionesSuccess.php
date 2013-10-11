<?php
    include_component("reportesGer","formMenuEstadisticasExportaciones");
    $grid = $sf_data->getRaw("grid");
    $tipo = $sf_data->getRaw("tipo");
    //$nmm = $sf_data->getRaw("nmes");
    foreach($nmm as $m){
        if($m!="")
            $mm[]=str_pad($m, 2, "0", STR_PAD_LEFT);
    }
    
    if (count($mm)>0) {
        $mes = "";
        for($i=0; $i<count($mm);$i++){
            $mes.= Utils::getMonth($mm[$i]).",";
        }
    }
?>

<div align="center" id="container" ></div>

<?
if($opcion){
?>
    <table style="font-size: 10" width="90%" border="1" class="tableList" align="center">
        <tr>
            <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    <?=$mes." de ".$aa."<br />"?>
                    <?=$transporte?$transporte."<br/>":""?>&nbsp;<?=$modalidad?$modalidad."<br/>":""?>
                    <?=$agente?"AGENTE: ".$agente."<br/>":""?>
                    <?=$sucursal?"SUCURSAL: ".$sucursal."<br/>":""?>
                </b></th>
        </tr>    
        <tr>
            <th scope="col" style=" text-align: center">A&ntilde;o</th>
            <th scope="col" style=" text-align: center">Mes</th>
            <th scope="col" style=" text-align: center">Referencia</th>
            <th scope="col" style=" text-align: center">Rep. Negocio</th>
            <th scope="col" style=" text-align: center;width: 300px">Cliente</th>
            <?if(!$agente){?><th scope="col" style=" text-align: center;width: 250px">Agente</th><?}?>
            <th scope="col" style=" text-align: center">Ciudad Origen</th>
            <th scope="col" style=" text-align: center">Pais Destino</th>
            <th scope="col" style=" text-align: center">Ciudad Destino</th>
            <?if(!$transporte){?><th scope="col" style=" text-align: center">Transporte</th><?}?>
            <?if(($transporte && !$modalidad && $transporte!="Aereo" && $transporte!="Terrestre") || (!$transporte) ){?><th scope="col" style=" text-align: center">Modalidad</th><?}?>
            <th scope="col" style=" text-align: center">Peso</th>
            <th scope="col" style=" text-align: center">Peso Volumen</th>
            <?if(!$transporte || $transporte=="Aereo"){?>
            <th scope="col" style=" text-align: center;width: 200px">Aerol&iacute;nea</th>
            <?}
            if (!$transporte || $transporte=="Maritimo"){?>
            <th scope="col" style=" text-align: center;width: 200px">Naviera</th>
            <th scope="col" style=" text-align: center;width: 130px">Concepto</th>
            <th scope="col" style=" text-align: center">TEUS</th>
            <?}?>
            <th scope="col" style=" text-align: center;width: 140px">Comercial</th>
            <th scope="col" style=" text-align: center;width: 70px">INO</th>
            <th scope="col" style=" text-align: center;width: 70px">Estado</th>
        </tr>
<?
    foreach($resul as $r){
?>
        <tr>
            <td><?=$r["ano"]?></td>
            <td><?=$r["mes"]?></td>
            <td><a href="/Coltrans/Expo/ConsultaReferenciaAction.do?referencia=<?=$r["referencia"]?>&consulta="><?=$r["referencia"]?></a></td>
            <td><a href="/reportesNeg/verReporte/id/<?=$r["idreporte"]?>/impoexpo/Exportación/modo/<?=$r["via"]?>"><?=$r["rn"]?></a></td>
            <td><?=$r["cliente"]?></td>
            <?if(!$agente){?><td><?=$r["agente"]?></td><?}?>
            <td><?=$r["ciuorigen"]?></td>
            <td><?=$r["tradestino"]?></td>
            <td><?=$r["ciudestino"]?></td>
            <?if(!$transporte){?><td><?=$r["via"]?></td><?}
            if(($transporte && !$modalidad && $transporte!="Aereo" && $transporte!="Terrestre") || (!$transporte) ){?><td><?=$r["modalidad"]?></td><?}?>
            <td><?=$r["peso"]?></td>
            <td><?=$r["peso_volumen"]?></td>
            <?if(!$transporte || $transporte=="Aereo"){?>
            <td><?=$r["aerolinea"]?></td>
            <?}
            if (!$transporte || $transporte=="Maritimo") {?>
            <td><?=$r["naviera"]?></td>
            <td><?=$r["concepto"]?></td>
            <td><?=$r["teus"]?></td>
            <?}?>
            <td><?=$r["comercial"]?></td>
            <td style=" text-align: right"><?="$".Utils::formatNumber($r["ca_ino"])?></td>
            <td style=" text-align: right"><?=$r["case"]?></td>
        </tr>
<?
        $array[] = $bl;
        $cuantos = count($array);
    }
?>
    </table><br /><br /><br />

    <!--<table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
        <tr>
            <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    <?=$aa."<br />"?>
                    <?=$transporte?$transporte."<br/>":""?>&nbsp;<?=$modalidad?$modalidad."<br/>":""?>
                    <?=$agente?"AGENTE: ".$agente."<br/>":""?>
                    <?=$sucursal?"SUCURSAL: ".$sucursal."<br/>":""?>
                </b></th>
        </tr>
        <tr style ="text-align:center">
            <th>SUCURSAL</th>
<?              
                /*foreach ($grid as $ind=>$gridSucursal){
                    foreach($gridSucursal as $suc => $gridMes){
                        $serieSuc[]=$suc;
                        foreach($gridMes as $mes=>$data){
                        if(!in_array($mes, $serieX))
                            $serieX[] = $mes;
                        }
                    }
                }
                asort($serieSuc);
                $nmeses = count($serieX);
                foreach($serieX as $k=>$mes){
                    echo "<th style ='text-align:center'>".Utils::getMonth($mes)."</th>";
                }*/
?>
            <th style ='text-align:center'>Total</th>
        </tr>-->
    
<?
        /*foreach ($serieSuc as $key=>$suc){ 
            echo "<tr><td>". $suc . "</td>";
            foreach ( $serieX as $k=>$mes ){
                if ($grid["total_negocios"][$suc][$mes] == '') {
                    echo "<td> </td>";
                }
                else{
                    if ($row == 0 and $col == 0){
                        echo "<td style ='text-align:center'>". $grid["total_negocios"][$suc][$mes] . "</td>";
                    }
                    else if ($row != 0 and $col == 0){
                        echo "<td> </td>";
                    }
                    else{
                        echo "<td style ='text-align:center'>". $grid["total_negocios"][$suc][$mes] . "</td>";
                    }			        
                }
                $total[$suc]+=$grid["total_negocios"][$suc][$mes];
                $total_mes[$mes]+=$grid["total_negocios"][$suc][$mes];
            }
            echo "<th style ='text-align:right'><b>".$total[$suc]."</b></th></tr>";
            $total_nal+=$total[$suc];
        }
        echo "<tr><th style ='text-align:right'>Total Nacional</th>";
        foreach($total_mes as $mes=>$data){
            echo "<th style ='text-align:center'><b>".$data."</b></th>";
        }
        //echo "</tr><th colspan=".($nmeses+1).">Total Nacional</th>";
        echo "<th style ='text-align:right'><b>".$total_nal."</b></th></tr></table>";
        
        echo "**********************************************************************************";*/
        ?>
        
        <table style="font-size: 10" width="50%" border="1" class="tableList" align="center">
        <tr>
            <th style="text-align: center" colspan="20"><b>ESTADISTICAS DE EXPORTACIONES <br />
                    <?=$aa."<br />"?>
                    <?=$transporte?$transporte."<br/>":""?>&nbsp;<?=$modalidad?$modalidad."<br/>":""?>
                    <?=$agente?"AGENTE: ".$agente."<br/>":""?>
                    <?=$sucursal?"SUCURSAL: ".$sucursal."<br/>":""?>
                </b></th>
        </tr>
        <tr style ="text-align:center">
            <th>TRANSPORTE</th>
            <th>SUCURSAL</th>
<?              
                foreach ($tipo as $trans => $gridSucursal){
                    $serieTrans[]=$trans;
                    foreach($gridSucursal as $suc => $gridMes){
                        if(!in_array($suc, $serieSuc))
                        $serieSuc[]=$suc;
                        foreach($gridMes as $mes=>$data){
                        if(!in_array($mes, $serieX))
                            $serieX[] = $mes;
                        }
                    }
                }
                asort($serieSuc);
                $nmeses = count($serieX);
                $nsuc = count($serieSuc);
                foreach($serieX as $k=>$mes){
                    echo "<th style ='text-align:center'>".Utils::getMonth($mes)."</th>";
                }
                //echo "<pre>";print_r($serieTrans);echo "</pre>";
?>
            <th style ='text-align:center'>Total</th>
        </tr>    
        <?
        foreach ($serieTrans as $t=>$transp){ 
            echo "<tr><td rowspan=".$nsuc.">". $transp . "</td>";
            foreach ($serieSuc as $s=>$suc){ 
                echo "<td>". $suc . "</td>";
                foreach ( $serieX as $k=>$mes ){
                    if ($tipo[$transp][$suc][$mes] == '') {
                    echo "<td> </td>";
                    }
                    else{
                        if ($row == 0 and $col == 0){
                            echo "<td style ='text-align:center'>". $tipo[$transp][$suc][$mes] . "</td>";
                        }
                        else if ($row != 0 and $col == 0){
                            echo "<td> </td>";
                        }
                        else{
                            echo "<td style ='text-align:center'>". $tipo[$transp][$suc][$mes] . "</td>";
                        }			        
                    }
                    $tipo[$suc]+=$tipo[$transp][$suc][$mes];
                    $tipo_mes[$transp][$mes]+=$tipo[$transp][$suc][$mes];    
                }
                echo "<th style ='text-align:right'><b>".$tipo[$suc]."</b></th></tr>";
                $tipo_nal[$transp]+=$tipo[$suc];
            }
            echo "</tr><tr><th colspan=2 style ='text-align:right'>Total ".$transp."</th>";
            foreach ( $serieX as $k=>$mes ){
                echo "<th style ='text-align:center'><b>".$tipo_mes[$transp][$mes]."</b></th>";
            }
            echo "<th style ='text-align:right'><b>".$tipo_nal[$transp]."</b></th></tr>";
        }
        
        echo "</tr><tr><th colspan=2 style ='text-align:right'>Total Nacional</th>";
        foreach($tipo_mes as $tr=>$gridMes){
            foreach($gridMes as $mes=>$data){
                $tmes[$mes]+=$data;
            }
        }
        foreach ( $serieX as $k=>$mes ){
            echo "<th style ='text-align:center'><b>".$tmes[$mes]."</b></th>";
        }
        foreach($tipo_nal as $tr=>$data){
            $tnal+=$data;
        }
        
        echo "<th style ='text-align:right'><b>".$tnal."</b></th></tr></table>";
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
                new FormMenuEstadisticasExportaciones()              
        ]
	},
	buttons: [
            {
                text: 'Continuar',
                handler: function(){
                            var tp = Ext.getCmp("tab-panel");

                            var owner=Ext.getCmp("formPanel");
                            if( tp.getActiveTab().getId()=="estadisticas"){
                                owner.getForm().getEl().dom.action='<?=url_for("reportesGer/estadisticasExportaciones")?>';
                            }
                            owner.getForm().submit();
                }
            }]
});
tabs.render("container");

 </script>