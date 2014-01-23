<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$cargas = $sf_data->getRaw("cargas");
include_component("widgets", "widgetCiudad");
include_component("widgets", "multiWidget");
?>
<style>
    caption{font-weight: bold;font-size: 16px;text-align: center; padding: 5px }
</style>
<div align="center" id="container" class="noprint"></div>
<div align="center" id="container1"></div>
<?
include_component("otm","filtrosListados",array("url"=>"otm/listaTranspColmas","title"=>"Listado de Cargas Colmas"));
if($opcion)
{
    $colspan=10;
?>
<form id="formDatos" name="formDatos" method="post" action="#" >
    <table class="tableList" width="80%" border="1" id="mainTable" align="center" >
        
        <tr style ="text-align:center"><th>No</th><th >Semana</th><th >Referencia</th><th>Cliente</th><th>Modalidad</th><th  >Origen</th><th  >Destino</th><th>Mercancia</th><th>Piezas</th> <th>Peso</th> <th>Volumen</th><th>Coordinador</th></tr>
        <?
        $pos=1;
        $color="";
        foreach($cargas as $c)
        {
        ?>
        <tr  >
            <td ><?=$pos++?></td>
            <td ><?=$c->getCaSemana()?></td><td ><?=$c->getCaReferencia()?></td><td><?=$c->getCliente()->getCaCompania()?></td><td><?=$c->getCaModalidad()?></td><td><?=$c->getOrigen()->getCaCiudad()?></td><td><?=$c->getDestino()->getCaCiudad()?></td><td><?=$c->getCaMercancia()?></td><td><?=$c->getCaPiezas()?></td> <td><?=$c->getCaPeso()?></td> <td><?=$c->getCaVolumen()?></td><td><?=$c->getCaUsucreado()?></td>
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