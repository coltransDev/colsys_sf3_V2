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
<table class="tableList" width="600px" border="1" id="mainTable" align="center" >
    <tr><th>Referencia</th><th>Estado</th><th>Cliente</th><th>Ref Transporte <? /*doc transporte*/?></th><? if($empresa=='TPLogistics'){?><th>Agente</th><?}?><th>Proveedor</th><th>Modalidad</th><th >Factura</th><th>Vlr.Facturado</th><th >RC</th><th  >Vol.CMB</th><th  >Utilidad</th> <th>Comisiones</th> <th>Comis/Sobreventa</th><th>Comis/Cobradas</th><th>Comprobantes</th></tr>
        <?
        $pos=1;
        $vendedorant="";        
        //echo "<pre>";print_r($datos["amartinez"][0]);echo "</pre>";
        $pp=1;
        if(count($datos)==0)
        {
            echo "<tr><td colspan='17'>No existen registros</td></tr>";
        }
        else
        {
            foreach($datos as $vendedor=>$dat)
            {
                $totales1=array();
    ?>
            <tr>
                <th colspan="17">Vendedor:<?=$vendedor?></th>
            </tr>
    <?            
                for($i=0;$i<count($dat);$i++)
                {
                    $d=$dat[$i];                    
                    $url="/ino/verReferencia/modo/".$d["tipo"]."/idmaster/".$d["ca_idmaster"];
            ?>
            <tr>
                <td><a href="<?=$url?>" target="_blank"><?=$d["ca_referencia"]?></a></td>
                <td><?=($d["ca_usucerrado"]=="")?"Abierto":"Cerrado"?></td>
                <td><?=$d["ca_compania"]?></td>
                <td><?=$d["ca_doctransporte"]?></td>
                <? if($empresa=='TPLogistics'){?><td><?=$d["a_nombre"]?></td><?}?>
                <td><?=$d["p_nombre"]?></td>
                <td><?=$d["ca_modalidad"]?></td>
                <td><?=$d["facturas"]?></td>
                <td><?=Utils::formatNumber($d["ing_valor"], 0)?></td>
                <td><?=$d["rcaja"]?></td>
                <td  ><?=$d["ca_volumen"]?></td>
                <td><?=Utils::formatNumber($d["ino"], 0)?></td>
                <td><?=Utils::formatNumber(($d["comision_ino"]), 0)?></td>
                <td><?=Utils::formatNumber($d["uti_valor"], 0)?></td>
                <td><?=Utils::formatNumber($d["comision_cobrada"], 0)?></td>
                <td><a href="/inoReportes/verPdf/idcomprobante/<?=$d["comision_idcomprobante"]?>" target="_blank"><?=$d["comision_comprobante"]?></a></td>
                
                <?                
                //TODO ::circular 170
                ?>
            </tr>            
    <?
                $totales1["ing"]+=$d["ing_valor"];
                $totales1["ino"]+=$d["ino"];
                $totales1["comision_ino"]+=$d["comision_ino"];
                $totales1["uti"]+=$d["uti_valor"];
                $totales1["comision_cobrada"]+=$d["comision_cobrada"];
                }
    ?>
            <tr><th colspan="7">Totales</th>
                <th><?=Utils::formatNumber($totales1["ing"], 2)?></th>
                <th></th>
                <th></th>
                <th><?=Utils::formatNumber($totales1["ino"], 2)?></th>
                <th><?=Utils::formatNumber($totales1["comision_ino"], 2)?></th> 
                <th><?=Utils::formatNumber($totales1["uti"], 2)?></th>
                <th><?=Utils::formatNumber($totales1["comision_cobrada"], 2)?></th><th></th><th></th></tr>
            <?
                echo '<tr><td colspan="17"><hr></td></tr>';
                $vendedorant=$vendedor;
                $pp++;
            }
            ?>

            <?
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