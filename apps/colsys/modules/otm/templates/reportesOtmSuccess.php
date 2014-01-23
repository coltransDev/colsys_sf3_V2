<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($reportes);
$etapas = $sf_data->getRaw("etapas");
$reportes = $sf_data->getRaw("reportes");

include_component("widgets", "widgetCiudad");
?>

<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>

<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("otm","filtrosListados",array("url"=>"otm/reportesOtm"));
if($opcion)
{
?>
<form id="formDatos" name="formDatos" method="post" action="#" >
<table class="tableList" width="600px" border="1" id="mainTable" align="center">
        <caption>OPERACIONES OTM PRESENTADAS</caption>        
        <tr style ="text-align:center"><th>No</th><th >Reporte</th><th>Fecha Presentacion</th><th >Hbl</th><th>Importador</th><th>Modalidad</th><th  >Origen</th><th  >Destino</th> </tr>
        <?
        $pos=1;
        foreach($reportes as $r)
        {
        ?>
        <tr >
            <td><?=$pos++?></td>
            <td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_fchpresentacion"]?></td><td><?=$r["ca_hbls"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_modalidad"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td>
            
        </tr>
        <?
        }
        ?>
        </tr>
</table>

</form>
<?
}
?>
<script>
    function enviar_lista()
    {   
        $("#bguardar").attr("disabled",true);
        $("select[value='']").attr("disabled", true);        
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
    
    function enviar_status()
    {
        
        if(window.confirm("Esta seguro de Enviar status a todos los reportes seleccionados?"))
        {
            $("#formdata").submit();
        }
    }
    
    
    function enviarPresentarDian()
    {   
        if(window.confirm("Esta seguro de marcar para presentacion estos reportes?"))
        {
            $("#bguardar").attr("disabled",true);
            $("select[value='']").attr("disabled", true);        
            $("#formDatos").attr("action", "<?=url_for("otm/presentacionDian")?>");        
            $("#formDatos").submit();        
        }        
    }
    
    function enviarChance()
    {   
        if(window.confirm("Esta seguro de marcar para enviar chance estos reportes?"))
        {
        
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?=url_for("otm/enviarChance")?>',
                method: 'POST',
                form: 'formDatos',
                success: function(a,b){
                    if(a.responseText.search(/error/i)==-1)
                    {
                        alert("Se Actualizo Correctamente");
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