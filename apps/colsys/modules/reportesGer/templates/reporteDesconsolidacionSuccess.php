<?
//echo $nmeses;
include_component("charts","column");


$dataJSON=array();
?>
<div align="center" >
<br />
<h3> Reporte Desconsolidaci&oacute;n</h3>
<br />
<br />
</div>
<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("reportesGer","filtrosReporteDesconsolidacion");
?>


<?
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
    <tr><th>Fecha confirmaci&oacute;n</th><th>Fecha Vaciado</th><th>Referencia</th><th>Diferencia</th></tr>
        <?        
        foreach($ref as $key=> $r)
        {            
            
        ?>
            <tr><td><?=$r["ca_fchconfirmacion"]?></td><td><?=$r["ca_fchvaciado"]?></td><td><?=$r["ca_referencia"]?></td><td><?=$r["diferencia"]?></td></tr>
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