<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$refs = $sf_data->getRaw("refs");
$datos = $sf_data->getRaw("datosIno");
$totales = $sf_data->getRaw("totales");
//print_r($datos);
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("inoReportes","filtrosListados",array("url"=>"inoReportes/reporteComisiones","titulo"=>"Reporte Comisiones x Vendedor","permiso"=>$permiso));
if($buscar)
{
?>
<script>
    function ver(id)
    {
        $("#tr_"+id).toggle();
    }
</script>
<form id="formDatos" name="formDatos" method="post" action="#" >
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <tr>
            <th></th>
            <th>Referencia</th>
            <th>Agente</th> 
            <th>Linea</th>
            <th>Modalidad</th>
            <th >Factura</th>
            <th>Vlr.Facturado</th>
            <th>Estado</th>
            <th  >Vol.CMB</th>
            <th  >Utilidad</th> 
            <th>Comisiones</th> 
            <th>Comis/Sobreventa</th>
            <th>Comis/Cobradas</th>
            <th>Comprobantes</th></tr>
        <?
        $pos=1;
        $vendedorant="";        
        //echo "<pre>";print_r($totales["linea"]);echo "</pre>";
        $pp=1;
        foreach($datos as $vendedor=>$dat)
        {
            $totales1=array();
?>
        <tr>
            <th colspan="14">Vendedor:<?=$vendedor?></th>
        </tr>
<?            
            //for($i=0;$i<count($dat)-1;$i++)
            for($i=0;$i<count($dat);$i++)
            {
                $d=$dat[$i];
                $url="/ino/verReferencia/modo/".$d["tipo"]."/idmaster/".$d["ca_idmaster"];
        ?>
        <tr><td><a href="javascript:ver('<?=$pp.$d["ca_idmaster"]?>')">+</a></td>
            <td><a href="<?=$url?>" target="_blank"><?=$d["ca_referencia"]?></a></td>
            <td><?=$d["IdsAgente"]["Ids"]["ca_nombre"]?></td>
            <td><?=$d["IdsProveedor"]["Ids"]["ca_nombre"]?></td>
            <td><?=$d["ca_modalidad"]?></td>
            <td></td>
            <td><?=Utils::formatNumber($d["InoViIngreso"]["ca_valor"], 2)?></td>
            <td><?=($d["ca_usucerrado"]=="")?"Abierto":"Cerrado"?></td>
            <td  ><?=$d["InoViUnidadesMaster"]["ca_volumen"]?></td>
            <td><?=Utils::formatNumber($d["ino"], 2)?></td> 
            <td><?=Utils::formatNumber(($d["ino"]*0.10), 2)?></td> 
            <td><?=Utils::formatNumber($d["InoViUtilidad"], 2)?></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="display: none" id="tr_<?=$pp.$d["ca_idmaster"]?>">
            <td colspan="14" style="background-color: #EAEAEA">
                <table>
                    <tr>
                        <th>Cliente</th>
                        <th>Doc. Transporte</th>
                        <th>Piezas</th>
                        <th>Peso</th>
                        <th>Volumen</th>
                    </tr>
                    <?
                    foreach($d["InoHouse"] as $house)
                    {
                    ?>
                    <tr>
                        <td><?=$house["ca_idcliente"]?>-<?=$house["Cliente"]["ca_compania"]?></td>
                        <td><?=$house["ca_doctransporte"]?></td>
                        <td><?=$house["ca_numpiezas"]?></td>
                        <td><?=$house["ca_peso"]?></td>
                        <td><?=$house["ca_volumen"]?></td>
                    </tr>
                    <?
                    }
                    ?>
                </table>
            </td>
        </tr>
<?
                $totales["ing"]+=$d["ing_valor"];
                $totales["ino"]+=$d["ino"];
                $totales["comision_ino"]+=$d["comision_ino"];
                $totales["uti"]+=$d["uti_valor"];
                $totales["comision_cobrada"]+=$d["comision_cobrada"];
            }
?>
        <tr><th colspan="6">Totales</th>
            <th><?=Utils::formatNumber($totales["vendedor"][$vendedor]["InoViIngreso"]["valor"], 2)?></th>
            <th></th>
            <th><?=Utils::formatNumber($totales["vendedor"][$vendedor]["volumen"]["valor"],2)?></th>
            <th><?=Utils::formatNumber($totales["vendedor"][$vendedor]["ino"]["valor"], 2)?></th> 
            <th><?=Utils::formatNumber(($totales["vendedor"][$vendedor]["ino"]["valor"]*0.10), 2)?></th> 
            <th><?=Utils::formatNumber($totales["vendedor"][$nvendedor]["InoViUtilidad"]["valor"], 2)?></th>
            <th></th><th></th></tr>
        <?
            echo '<tr><td colspan="14"><hr></td></tr>';
            $vendedorant=$vendedor;
            $pp++;
        }
        ?>
</table>
</form>

<br><br><br><br>
<?
foreach ($tipoTotales as $opcion)
{
?>
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
    <caption >RESUMEN X <?=  strtoupper($opcion)?></caption>
    <tr><th><?=$opcion?></th>
        <th colspan="2"># Embarques</th>
        <th colspan="2">Vlr.Facturado</th>
        <th colspan="2">Vol.CMB</th>
        <th colspan="2">Utilidad</th>
        <th colspan="2">Comis/Sobreventa</th>
    </tr>        
<?
    foreach($totales[$opcion] as $key=>$r)
    {
?>
        <tr>
            <td><?=$key?></td>
            <td><?=Utils::formatNumber($r["nref"]["valor"], 2)?></td><td><?=Utils::formatNumber($r["nref"]["%"], 2)?>%</td>
            <td><?=Utils::formatNumber($r["InoViIngreso"]["valor"], 2)?></td><td><?=Utils::formatNumber($r["InoViIngreso"]["%"], 2)?>%</td>
            <td><?=Utils::formatNumber($r["volumen"]["valor"], 2)?></td><td><?=Utils::formatNumber($r["volumen"]["%"], 2)?>%</td>
            <td><?=Utils::formatNumber($r["ino"]["valor"], 2)?></td><td><?=Utils::formatNumber($r["ino"]["%"], 2)?>%</td>            
            <td><?=Utils::formatNumber($r["InoViUtilidad"]["valor"], 2)?></td><td><?=Utils::formatNumber($r["InoViUtilidad"]["%"], 2)?>%</td>
        </tr>
<?
    }
?>
</table>
<?
}
?>



<?
}
?>