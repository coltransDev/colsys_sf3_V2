<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
$etapas = $sf_data->getRaw("etapas");
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>

<div align="center" class="esconder" ><img src="/images/22x22/printmgr.png" onclick="imprimir()" style="cursor: pointer"/></div>
<div align="center" id="container" class="esconder"></div>
<div align="center" id="container1"></div>
<?
include_component("otm","filtrosListados");

if($opcion)
{
?>
<form id="formdata" name="formdata" method="post" action="/otm/generarStatus">
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>APROBACION DTM Y CONTINUACION DE VIAJE</caption>        
        <tr style ="text-align:center"><th >Reporte</th><th>Referencia</th><th>Fecha de Llegada</th><th>Nit</th><th  >Cliente</th><th>Importador</th><th>Modalidad</th><th>Origen</th><th  >Destino</th><th>Muelle</th> <th>Continuacion</th> <th>DTM</th><th></th></tr>
        
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr ><td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_referencia"]?></td><td><?=$r["ca_fcharribo"]?></td><td><?=$r["ca_idalterno"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_importador"]?></td><td><?=$r["ca_modalidad"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td><td><?=$r["ca_bodega"]?></td>
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/OTM" target="_blank">Ver</a></td><td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank">Ver</a></td>
            <td>
                <input type="checkbox" id="id-<?=$r["ca_consecutivo"]?>" name="ids[]"  value="<?=$r["ca_consecutivo"]?>" t="<?=$r["ca_consecutivo"]?>" onclick="activacion(this)">
                <div id="div-<?=$r["ca_consecutivo"]?>"><textarea id="idt-<?=$r["ca_consecutivo"]?>" name="observaciones[]" disabled ></textarea></div>
            </td>
        </tr>
        <?
        }
        ?>
        <tr >
            <td colspan="11" align="right">
                <select id="idetapa" name="idetapa">
                    <?
                    foreach($etapas as $e)
                    {
                    ?>
                    <option value="<?=$e["id"]?>"><?=$e["nombre"]?></option>
                    <?
                    }
                    ?>
                </select>
            </td>
            <td ><input type="button"  value="Enviar" onclick="enviar_status()"></td>
        </tr>
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