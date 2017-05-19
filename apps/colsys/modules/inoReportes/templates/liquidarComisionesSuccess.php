<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$datosIno = $sf_data->getRaw("datosIno");
$comVendedores = $sf_data->getRaw("comVendedores");

?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("inoReportes","filtrosListados",array("url"=>"inoReportes/liquidarComisiones","titulo"=>"Reporte Comisiones x Vendedor","permiso"=>$permiso));
if($buscar)
{
?>
<script>
    function ver(id)
    {
        $("#tr_"+id).toggle();
    }
    
    function validate()
    {
        var n = $( "input:checked" ).length;
        if(n<1)
        {
            alert("Debe seleccionar almenos un caso para comisionar");
            return false;
        }
        else
        {
            $("#benviar").attr("disabled", true)
            return true;
        }
    }
</script>
<form id="formDatos" name="formDatos" method="post" action="/inoReportes/comisionarCasos" onsubmit=" return validate()">
<table class="tableList" width="600px" border="1" id="mainTable" align="center" >
    <tr><th>Referencia</th><th>Estado</th><th>Cliente</th><th>Ref Transporte <? /*doc transporte*/?></th><!--<th>Agente</th>--> <th>Proveedor</th><th>Modalidad</th><th >Factura</th><th>Vlr.Facturado</th><th >RC</th><th  >Vol.CMB</th><th  >Utilidad</th> <th>Comisiones</th> <th>Comis/Sobreventa</th><th>Comis/Cobradas</th><th>Comprobantes</th><th></th></tr>
        <?
        $pos=1;
        $vendedorant="";        
        //echo "<pre>";print_r($datosIno);echo "</pre>";
        $pp=1;
        if(count($datosIno)==0)
        {
            echo "<tr><td colspan='17'>No existen registros</td></tr>";
        }
        else
        {
            foreach($datosIno as $vendedor=>$dat)
            {
                $totales=array();
    ?>
            <tr>
                <th colspan="17">Vendedor:<?=$vendedor?></th>
            </tr>
    <?            
                for($i=0;$i<count($dat);$i++)
                {
                    $d=$dat[$i];
                    if(intval($d["comision_ino"])==0 && $casos!="")
                        continue;
                    if($casos=="2" || $casos=="3" )
                    {
                        if($d["facturas"]=="")
                            continue;
                    }
                    if($casos=="3" && $d["ca_stdcircular"] == "Vencido" && $d["comision_ino"]>0)
                        continue;
                        
                    $url="/inoF/verReferenciaExt4/modo/".$d["tipo"]."/idmaster/".$d["ca_idmaster"];
            ?>
            <tr>
                <td><a href="<?=$url?>" target="_blank"><?=$d["ca_referencia"]?></a></td>
                <td><?=($d["ca_usucerrado"]=="")?"Abierto":"Cerrado"?></td>
                <td><?=$d["ca_compania"]?></td>
                <td><?=$d["ca_doctransporte"]?></td>
                <!--<td><?=$d["a_nombre"]?></td>-->
                <td><?=$d["p_nombre"]?></td>
                <td><?=$d["ca_modalidad"]?></td>
                <td><?=$d["facturas"]?></td>
                <td><?=Utils::formatNumber($d["ing_valor"], 0)?></td>
                <td><?=$d["rccaja"]?></td>
                <td  ><?=$d["ca_volumen"]?></td>
                <td><?=Utils::formatNumber($d["ino"], 0)?></td>
                <td><?=Utils::formatNumber(($d["comision_ino"]), 0)?></td>
                <td><?=Utils::formatNumber($d["uti_valor"], 0)?></td>
                <td><?=Utils::formatNumber($d["comision_cobrada"], 0)?></td>
                <td><?=$d["comision_comprobante"]?></td>
                <td>
                <?
                $stdcircular = $d["ca_stdcircular"];    // Se basa en el dato calculado por la vista de clientes
                //$diascircular= TimeUtils::dateDiff($d["ca_fchcircular"],date("Y-m-d"))-366;
                //$d["comision_ino"]=-1;
                
                if($d["ca_usucerrado"]!="" && $d["rccaja"]!="" )
                {
                    //if($diascircular>0)
                    if( $stdcircular == "Vencido" && $d["comision_ino"]>0)
                    {
                        echo "Circular 170 Vencida";
                    }else{
                        if(intval($d["comision_ino"])!=0)
                        {
                ?>
                    <input type="checkbox" name="idhouse[]" value="<?=$d["ca_idhouse"]?>" <?=($d["comision_ino"]<0)?"checked onclick=clickobligatorio(this)":""?>  />
                <?
                        }
                    }
                }
                ?>
                </td>
                <?                
                //TODO ::circular 170
                ?>
            </tr>            
    <?
                $totales["ing"]+=$d["ing_valor"];
                $totales["ino"]+=$d["ino"];
                $totales["comision_ino"]+=$d["comision_ino"];
                $totales["uti"]+=$d["uti_valor"];
                $totales["comision_cobrada"]+=$d["comision_cobrada"];
                }
    ?>
            <tr><th colspan="7">Totales</th>
                <th><?=Utils::formatNumber($totales["ing"], 2)?></th>
                <th></th>
                <th></th>
                <th><?=Utils::formatNumber($totales["ino"], 2)?></th>
                <th><?=Utils::formatNumber($totales["comision_ino"], 2)?></th> 
                <th><?=Utils::formatNumber($totales["uti"], 2)?></th>
                <th><?=Utils::formatNumber($totales["comision_cobrada"], 2)?></th><th></th><th></th></tr>
            <?
                echo '<tr><td colspan="17"><hr></td></tr>';
                $vendedorant=$vendedor;
                $pp++;
            }
            ?>
            <tr>
                <th colspan="17" style="text-align: right" ><input type="submit" value="Cobrar Comisiones" id="benviar"></th>
            </tr>
            <?
        }
        ?>
</table>
</form>

<?
}
?>

<?
if(count($comVendedores)>0)
{
?>
<table class="tableList" width="600px" border="1" id="mainTable" align="center" >
    <tr><th>No Comprobante</th><th>Fecha</th><th>Usuario</th></tr>
    
    <?
    foreach($comVendedores as $cv)
    {
    ?>
    <tr><td><a href="/inoReportes/verPdf/idcomprobante/<?=$cv["ca_idcomprobante"]?>"><?=$cv["ca_consecutivo"]?></a></td><td><?=$cv["ca_fchcomprobante"]?></td><td><?=$cv["ca_usucreado"]?></td></tr>
    <?
    }
    ?>
</table>
<?
}
?>
<script>
    function clickobligatorio(obj)
    {
        obj.checked=true;
    }
</script>