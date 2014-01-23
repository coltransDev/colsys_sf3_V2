<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
$idp = $sf_data->getRaw("idp");
$reportes = $sf_data->getRaw("reportes");

?>

<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" class="noprint" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
//include_component("otm","filtrosListados",array("url"=>"otm/listaPuerto"));


?>
<form id="formDatos" name="formDatos" method="post" action="#" >
    
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>OPERACIONES OTM EN PROCESO</caption>
        <tr style ="text-align:center"><th >Reporte</th><th >Hbl</th><th>ETA</th><th  >Cliente</th><th >Destino</th><th >Modalidad</th><th>Vencimiento</th></tr>
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr><td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_hbls"]?></td><td><?=$r["ca_fcharribo"]?></td><td><?=$r["ca_compania"]?></td><td><?=  utf8_decode($r["ca_ciudestino"])?></td><td><?=$r["ca_modalidad"]?></td><td><?=$r["ca_propiedades"]?></td></tr>
        <?
        }
        ?>        
</table>

</form>

<script>
    function imprimir()
    {
        /*$(".esconder").hide();
        $(".mostrar").show();
        Ext.getCmp("tab-panel").hidden=true;
        //alert("")*/
        window.print();
        //$(".esconder").show();
    }
</script>