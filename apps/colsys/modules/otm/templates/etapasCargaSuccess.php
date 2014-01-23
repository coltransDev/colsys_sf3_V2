<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);

$etapas = $sf_data->getRaw("etapas");
//print_r($etapas);
//$etapas=implode(",", $e["etapas"]);
$reportes = $sf_data->getRaw("reportes");
//echo count($reportes);
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>

<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("otm","filtrosListados",array("url"=>"otm/etapasCarga"));

if($opcion)
{
?>
<form id="formdata" name="formdata" method="post" action="/otm/generarStatus">
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>ETAPAS DE CARGAS</caption>        
        <tr style ="text-align:center"><th>No</th><th >Reporte</th><th style="display:none">Referencia</th><th>Fecha de Llegada</th><th>Nit</th><th  >Cliente</th><th>Modalidad</th><th>Origen</th><th  >Destino</th><th>Muelle</th> <th>Continuacion</th> <th>DTM</th>
            <?
            $i=1;
                foreach($etapas as $e)
                {
            ?>
                    <th width="90"><?=$e["nombre"]?></th>
            <?
                }
            ?>
        </tr>
        
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr ><td><?=$i++?></td><td ><a href="/reportesNeg/consultaReporte/id/<?=$r["ca_idreporte"]?>/modo/Terrestre/impoexpo/OTM-DTA/opcion/otmmin"><?=$r["ca_consecutivo"]?></a></td><td style="display:none"><?=$r["ca_referencia"]?></td><td><?=$r["ca_fcharribo"]?></td><td><?=$r["ca_idalterno"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_modalidad"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td><td><?=$r["ca_bodega"]?></td>
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/OTM" target="_blank">Ver</a></td><td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank">Ver</a></td>
            <?
            foreach($etapas as $e)
            {
                $flag=(stripos($r["etapas"],$e["id"]) === false )?"":"<img src='/images/16x16/button_ok.gif'/>";
            ?>
                <td><?=$flag?></td>
            <?
            }
            ?>
        </tr>
        <?
        }
        ?>
</table>
</form>
<?
}
?>
<script>
    function enviar_status()
    {
        
        if(window.confirm("Esta seguro de Enviar status a todos los reportes seleccionados?"))
        {
            $("#formdata").submit();
            /*
            Ext.MessageBox.wait('Aprobando, Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("/otm/generarStatus") ?>',
                params : {
                    id: '<?=$idreporte?>',
                    tipo: '<?=$tipo?>'
                },
                failure:function(response,options){
                    alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        location.href=location.href;
                    }
                }
            });
                       alert("Status enviados satisfactoriamente");
            */
        }
    }
    
    function activacion(obj)
    {
        id=$("#"+obj.id).attr("t")
        check="";
        visible="";
        if(obj.checked)
        {
            check=false;
            $("#div-"+id).show(500);
        }
        else
        {
            check=true;
            $("#div-"+id).hide(500);
        }
        
        $("#idt-"+id).attr("disabled",check);
    }
</script>