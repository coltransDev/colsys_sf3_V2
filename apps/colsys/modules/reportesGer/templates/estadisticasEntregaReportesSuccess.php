<?

$reportes = $sf_data->getRaw("reportes");

?>
<div align="center" >
<br />
<h3> Estadísticas Entrega Reportes </h3>
<br />
<br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("reportesGer","filtrosEstadisticasTraficos",array("informe"=>"2"));

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
</h3>
<br />
<br />
</div>
    
<table class="tableList" width="900px" border="1" id="mainTable" align="center" id="panel1">
    <tr>
        <th>Fecha</th>
        <th>No. Reporte</th>
        <th style="width: 150px;">Razon rechazo</th>
        <th>Usuario rechazo</th>
        <th>Fecha rechazo</th>
   </tr>
        <?
        $c=1;
        $lastSucursal="";
        $lastUsuario="";
        foreach($reportes as $key=> $r)
        {   
            if($lastSucursal!=$r["sucursal"]){ 
                $lastSucursal=$r["sucursal"];
                ?>
                <tr class="box"><td colspan="5" style="font-weight:bold; font-size: 14px; color:  #0000ff"><b><?=$r["sucursal"]?></b></td></tr>
                <?
            }
            if($lastUsuario!=$r["ca_nombre"]){
                $lastUsuario=$r["ca_nombre"];
                ?>
                <tr><td colspan="5" style="font-weight:bold; font-size: 11px;"><b><?=$r["ca_nombre"]?></b></td></tr>
                <?
            }
        ?>  
            <tr>
                
                <td><?=$r["ca_fchcreado"]?></td>
                <td><?=$r["reporte"]?></td>
                <td><?=$r["ca_motrechazo"]?></td>
                <td><?=$r["ca_usurechazo"]?></td>
                <td><?=$r["ca_fchrechazo"]?></td>
            </tr>
        <?
        }
        ?>
</table>
    
<?
}
?>

<script>
    function imprimir()
    {
        $(".esconder").hide();
        Ext.getCmp("tab-panel").hidden=true;        
        window.print();        
    }
</script>