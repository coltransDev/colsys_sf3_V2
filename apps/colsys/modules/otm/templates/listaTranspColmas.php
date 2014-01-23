<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$etapas = $sf_data->getRaw("etapas");
include_component("widgets", "widgetCiudad");
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("otm","filtrosListados",array("url"=>"otm/listaTranspColmas"));
if($opcion)
{
    $colspan=10;
?>
<form id="formDatos" name="formDatos" method="post" action="#" >
    <table class="tableList" width="600px" border="1" id="mainTable" align="center" >
        <caption>OPERACIONES OTM EN PROCESO</caption>
        <tr><td colspan="<?=$colspan?>"></td><td><input value="Enviar" type="button" id="bguardar" onclick="enviar_lista()" /></td></tr>
        <tr style ="text-align:center"><th>No</th><th >Reporte</th><th >Hbl</th><th>Importador</th><th>Modalidad</th><th  >Origen</th><th  >Destino</th><th>Dias</th> <th>CV</th> <th>DTM</th><th>Carta Porte</th><th>Opciones</th><th>Presentar</th><th>Chance</th></tr>
        <?
        $pos=1;
        $color="";
        foreach($reportes as $r)
        {
            $color="";
            if($r["dia"]!="")
            {
                if($r["dia"]>=3)
                    $color="green";
                else if($r["dia"]>=2)
                    $color="yellow";
                else 
                    $color="red";
            }
        ?>
        <tr style="background-color: <?=$color?>" >
            <td ><?=$pos++?></td>
            <td ><?=$r["ca_consecutivo"]?></td><td><?=$r["ca_hbls"]?></td><td><?=$r["ca_compania"]?></td><td><?=$r["ca_modalidad"]?></td><td><?=$r["ca_origen"]?></td><td><?=$r["ca_destino"]?></td><td><?=$r["dia"]?></td>
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/OTM" target="_blank">Ver</a></td>
            <td>
<?
                if($r["ca_iddtm"]=="")
                {
?>
                <a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/DTM" target="_blank" style="display: none" id="a_iddtm_<?=$r["ca_idreporte"]?>">Ver</a>
                <div id="div_iddtm_<?=$r["ca_idreporte"]?>"><input type="text" id="no_iddtm_<?=$r["ca_idreporte"]?>" value="" style="width: 35px" > <a href="javascript:asigna('<?=$r["ca_idreporte"]?>')">Asignar</a></div>
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
            <td><a href="/otm/generarPdf/id/<?=$r["ca_consecutivo"]?>/tipo/CP" target="_blank">Ver</a></td>
            <td>
                <select id="rep-<?=$r["ca_consecutivo"]?>" name="reportes[]" class="reportes" >
                    <option value="">...</option>
                    <option value="Aprobar|<?=$r["ca_idreporte"]?>">Aprobar</option>
                    <option value="NoAprobar|<?=$r["ca_idreporte"]?>">No Aprobar</option>
                </select>
            </td>           
            <td>
                <input type="checkbox" id="idp-<?=$r["ca_idreporte"]?>" name="idp[]"  value="<?=$r["ca_idreporte"]?>">
            </td>
            <td>
                <input type="checkbox" id="idc-<?=$r["ca_idreporte"]?>" name="idc[]"  value="<?=$r["ca_idreporte"]?>">
            </td>
        </tr>
        <?
        }
        ?>
        <tr><td colspan="<?=$colspan?>"></td><td><input value="Enviar" type="button" id="bguardar" onclick="enviar_lista()" /></td>

            <td><input type="button"  value="Enviar" onclick="enviarPresentarDian()"></td>
            <td><input type="button"  value="Enviar" onclick="enviarChance()"></td>
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
                        $("#div_iddtm_"+id).hide();
                        $("#a_iddtm_"+id).show();                        
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