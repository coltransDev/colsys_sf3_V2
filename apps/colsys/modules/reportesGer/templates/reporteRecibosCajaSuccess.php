<div align="center" >
<br />
<h3> Reporte Facturas sin Recibo de caja</h3>
<br />
<br />
</div>
<div align="center" class="esconder" style="display: none" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("reportesGer","filtrosReporteRecibosCaja");

if($opcion)
{
?>
<div  >
<div align="center">
<br>
<h3>Estadisticas de   <br>
<?
if( $fechainicial && $fechafinal ){
    echo " fechas de : ".$fechainicial." - ".$fechafinal;
}
?>
</h3>
<br />
<br />
</div>
<table class="tableList" width="1000px" border="1" id="mainTable" align="center" id="panel1">
    <tr><th></th><th>Fecha</th><th>Referencia</th><th>Fecha Factura</th><th>Factura</th><th>Valor</th><th>Cliente</th><th>Sucursal</th><th>Vendedor</th></tr>
        <?        
        foreach($ref as $key=> $r)
        {
        ?>
    <tr><td><?=($key+1)?></td><td><?=Utils::parseDate($r["ca_fchcreado"], 'Y-m-d')?></td><td><?=$r["ca_referencia"]?></td><td><?=$r["ca_fchfactura"]?></td><td><?=$r["ca_factura"]?></td><td align="right"><?=  Utils::formatNumber($r["ca_valor"],0)?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_sucursal"]?></td><td><?=$r["ca_vendedor"]?></td></tr>
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
        //alert("")
        window.print();
        //$(".esconder").show();
    }
</script>