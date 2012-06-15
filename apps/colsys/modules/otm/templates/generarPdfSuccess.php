<?
//$url= $sf_data->getRaw("url");
//echo $url;
//echo "::".$valido;
?>
<div class="content" align="center">
	<table width='830' cellspacing="1" border="0">
        <?
        if(!$valido || $valido=="")
        {
        ?>
        <tr><td><input value="Aprobar" type="button" onclick="aprobar()"></td></tr>
        <?
        }
        ?>
		<tr>
			<td class="partir" style='text-align:center; font-weight:bold; background:#FF0000;' >Favor Imprimir en Tamaño <b>CARTA</b>. Configure su impresora 8,5 x 11 pulg. ó 216 mm x 279 mm</td>
		</tr>
	</table>	
	<iframe src ='<?=$url?>' width='830' height='650' ></iframe>
	<br />
	<br />

<script>
    function aprobar(id,tipo)
    {
        if(window.confirm("Esta seguro de Aprobar este reporte?"))
        {
            Ext.MessageBox.wait('Aprobando, Espere por favor', '');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("otm/aprobarReporte") ?>',
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
        }
    }
</script>