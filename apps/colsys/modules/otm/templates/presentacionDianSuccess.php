<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
$idp = $sf_data->getRaw("idp");

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
        <tr style ="text-align:center"><th >Reporte</th><th >Hbl</th><th>Nit</th><th  >Cliente</th><th  >Origen</th><th  >Destino</th></tr>
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr ><td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_hbls"]?></td><td><?=$r["ca_idalterno"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td>

        </tr>
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