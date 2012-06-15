<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
?>

<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<form id="formDatos" name="formDatos" method="post" action="#" >
    
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>APROBACION DTM Y CONTINUACION DE VIAJE</caption>
        <tr><td colspan="7"></td><td><input value="Enviar" type="button" id="bguardar" onclick="enviar_lista()" /></td></tr>
        <tr style ="text-align:center"><th >Reporte</th><th>Nit</th><th  >Cliente</th><th  >Origen</th><th  >Destino</th> <th>Continuacion</th> <th>DTM</th><th>Opciones</th></tr>
        
        <?
        foreach($reportes as $r)
        {
        ?>
        <tr ><td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_idalterno"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td>
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/OTM" target="_blank">Ver</a></td>
            <td>
                
<?
                if($r["ca_iddtm"]=="")
                {
?>
                <a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank" style="display: none" id="a_iddtm_<?=$r["ca_idreporte"]?>">Ver</a>
                <div id="div_iddtm_<?=$r["ca_idreporte"]?>"><input type="text" id="no_iddtm_<?=$r["ca_idreporte"]?>" value="" > <a href="javascript:asigna('<?=$r["ca_idreporte"]?>')">Asignar</a></div>
<?
                }
                else
                {
?>
                <a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank" >Ver</a>
<?
                }
                ?>
            </td>
            <td>
                <select id="rep-<?=$r["ca_consecutivo"]?>" name="reportes[]" class="reportes" >
                    <option value="">...</option>
                    <option value="Aprobar|<?=$r["ca_idreporte"]?>">Aprobar</option>
                    <option value="NoAprobar|<?=$r["ca_idreporte"]?>">No Aprobar</option>
                </select>
            </td>
        </tr>
        <?
        }
        ?>
        <tr><td colspan="7"></td><td><input value="Enviar" type="button" id="bguardar" onclick="enviar_lista()" /></td></tr>
</table>

</form>


<script>
    function enviar_lista()
    {   
        $("#bguardar").attr("disabled",true);
        $("select[value='']").attr("disabled", true);
/*        objs=$("select[value!='']");
        $.each(objs, function(i,item){
            alert(item.value);
        });
*/      
        
        Ext.Ajax.request(
        {
            waitMsg: 'Guardando cambios...',
            url: '<?=url_for("otm/eventoPresentacion")?>',
            method: 'POST',
            form: 'formDatos',
            success: function(a,b){
                if(a.responseText.search(/error/i)==-1)
                {                    
                    alert("Se Actualizo Correctamente");
                    //location.href='<?=url_for("$url")?>';
                    $("#bguardar").attr("disabled",true);
                }
                else
                {
                    alert("Error:"+a.responseText.replace(/<br \/>/gi ,"\n"));
                    $("#bguardar").attr("disabled",false);
                }
           },
           failure: function(a,b){
               alert("Error:"+a.responseText.toString());
               $("#bguardar").attr("disabled",false);
           }
        });
        
    }
    
    
    function asigna(id)
    {
        if(window.confirm("Esta seguro de asignar este numero?"))
        {
            Ext.MessageBox.wait('Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("otm/asignarIdDtm") ?>',
                params :	{                    
                    ca_iddtm: $("#no_iddtm_"+id).val(),
                    ca_idreporte:id
                },
                failure:function(response,options){
                    //alert( response.responseText );
                    Ext.Msg.hide();
                    success = false;
                    Ext.MessageBox.hide();
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        //$("#"+id).html("");                        
                        $("#div_iddtm_"+id).hide();
                        $("#a_iddtm_"+id).show();
                        //$("#"+id).remove();
                        Ext.MessageBox.hide();
                    }
                }
            });
        }        
    }
    
    
</script>