<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/

$grupoReportes = $sf_data->getRaw("grupoReportes");
$grupoReportesRechazadas = $sf_data->getRaw("grupoReportesRechazadas");

if($opcion!="otmmin")
{
?>
<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="3" align="left"><b>Crear un nuevo reporte, seleccione el servicio</b></th>
	</tr>
    <tr><td colspan="3"><b>Importaci&oacute;n</b></td></tr>

    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Importación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Importación")?>
		</div></td>

        <td align="left">
            <?=link_to("OTM-DTA ", "reportesNeg/formReporte?modo=Terrestre&impoexpo=".constantes::OTMDTA )?>
	</td>
<?
	}
?>
	</tr>
    <tr><td colspan="3" ><b>Exportaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
            <?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Exportación" )?>
	</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
            <?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Exportación")?>
	</div></td>
<?
	}
?>
        <td><div align="left">
            <?=link_to("Terrestre ", "reportesNeg/formReporte?modo=Terrestre&impoexpo=Exportación")?>
	</div></td>
	</tr>
<?

//    if( $nivelAduana>=0 )
    {

	?>
    <tr style="display: none">
		<td><div align="left">
			<?=link_to("Aduana", "reportesNeg/formReporte?idcategory=21")?>
		</div></td>
	</tr>
	<?
	}
?>
    <tr><td colspan="2" ><b>Triangulaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/formReporte?modo=Aéreo&impoexpo=Triangulación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/formReporte?modo=Marítimo&impoexpo=Triangulación")?>
		</div></td>
<?
	}
?>
	</tr>
     <tr><td colspan="2" ><b>Otros</b></td></tr>
    <tr>
        <td><div align="left">                
			<?=link_to("Ag", "reportesNeg/indexAg")?>
		</div></td>
        <td><div align="left">
			<?=link_to("Otros Servicios", "reportesNeg/formReporteOs")?>
		</div></td>
    </tr>

</table>

</div>
<?
}
?>

<?
include_component("reportesNeg", "filtrosBusqueda");


if($opcion=="otmmin")
{
?>

<div align="center">
<table width="800px" border="1" class="tableList alignLeft">
    <tr>
        <td colspan="2">
            <div align="center" class="paging">
                Paginas <br/>
    <?
        $paginador="";
        for ($i=1;$i<=$pages;$i++)
        {
            if($page==$i)
                $paginador.=link_to($i, "reportesNeg/indexAg?page=".$i , array('class'  => 'activate') )."  ";
            else
                $paginador.=link_to($i, "reportesNeg/indexAg?page=".$i  )."  ";
        }
        echo $paginador;
    ?>
            </div>
        </td>
    </tr>
	<tr>
		<th width="70" scope="col">Consecutivo</th>
		<th width="668" scope="col">Trayecto</th>
	</tr>
	<?
	foreach( $reportes as $reporte ){
		$origen = $reporte["ca_ciuorigen"];
		$destino = $reporte["ca_ciudestino"];
        $url = "reportesNeg/consultaReporte?id=".$reporte["ca_idreporte"]."&modo=".$reporte["ca_transporte"]."&impoexpo=".Constantes::IMPO;
	?>
	<tr>
		<td rowspan="2"><?=link_to($reporte["ca_consecutivo"], $url )?></td>
		<td  >
			<?="<b>".$reporte["ca_nombre_cli"]."</b> (".$reporte["ca_transporte"]." ".$reporte["ca_modalidad"].")"?>
			</td>
	</tr>
	<tr >
		<td><table width="100%" >
                        <tbody>
                        <tr>
                            <td class="invertir" style="font-weight: bold;">Origen</td>
                            <td class="invertir" style="font-weight: bold;">Destino</td>
                            <td width="20%" class="invertir" style="font-weight: bold;">Fch.Despacho</td>
                            <td width="60%" class="invertir" style="font-weight: bold;">Proveedor</td>
                        </tr>
                        <tr>
                                <td class="listar"><?=$origen?></td>
                                <td class="listar"><?=$destino?></td>
                                <td class="listar"><?=$reporte["ca_fchreporte"]?></td>
                                <td class="listar"><?=$reporte["ca_nombre_pro"]?></td>
                          </tr>
                        </tbody>
			</table></td>
	</tr>
	<?
	}
	?>
    <tr>
        <td colspan="2">
            <div align="center" class="paging">
                Paginas <br/>
    <?
        echo $paginador;
    ?>
            </div>
        </td>
    </tr>
</table>
</div>

<?
}

if(count($grupoReportes)>0)
{
?>
<div align="center">
    <table width="800px" border="1" class="tableList alignLeft">
        <tr>
            <th colspan="8">Pendientes x Aprobar</th>
        </tr>
        <tr>
            <th width="" scope="col">Consecutivo</th>
            <th width="" scope="col">Trayecto</th>
            <th width="" scope="col">Cliente</th>
            <th width="" scope="col">Fecha Envio</th>
            <th width="" scope="col">Usuario Envio</th>
            <th width="" scope="col" colspan='3'>Opciones</th>
        </tr>
<?
    foreach($grupoReportes as $r)
    {
?>
        <tr>
            <td width="" scope="col"><a href="/reportesNeg/verReporte?id=<?=$r["Reporte"]["ca_idreporte"]?>"><?=$r["Reporte"]["ca_consecutivo"]?></a></td>
            <td width="" scope="col"><?=$r["ori_ca_ciudad"]?> - <?=$r["des_ca_ciudad"]?></td>
            <td width="" scope="col"><?=$r["Reporte"]["Contacto"]["Cliente"]["ca_compania"]?></td>
            <td width="" scope="col"><?=$r["ca_fchcreado"]?></td>
            <td width="" scope="col"><?=$r["ca_usucreado"]?></td>
            <td width="" scope="col"><a href="javascript:desbloquear('<?=$r["ca_idantecedente"]?>')">Desbloquear</a></td>
            <td width="" scope="col"><a href="javascript:rechazar('<?=$r["ca_idantecedente"]?>')">Rechazar</a></td>
            <td>
            <a onclick="eliminar('<?=$r["ca_idantecedente"]?>')" href="#">
                <img width="18" height="18" border="0" src="/images/16x16/delete.gif">
            </a>
            </td>
        </tr>
<?
    }
?>
    </table>
    
<?
}
if(count($grupoReportesRechazadas)>0)
{
?>
    <br><br>
<div align="center">
    <table width="800px" border="1" class="tableList alignLeft">
        <tr>
            <th colspan="5">Rechazadas</th>
        </tr>
        <tr>
            <th width="" scope="col">Consecutivo</th>
            <th width="" scope="col">Trayecto</th>
            <th width="" scope="col">Cliente</th>
            <th width="" scope="col">Motivo Rechazo</th>
            <th width="" scope="col">Fecha Envio</th>
            <th width="" scope="col">Usuario Envio</th>
        </tr>
<?
    foreach($grupoReportesRechazadas as $r)
    {
?>
        <tr>
            <td width="" scope="col"><a href="/reportesNeg/verReporte?id=<?=$r["Reporte"]["ca_idreporte"]?>"><?=$r["Reporte"]["ca_consecutivo"]?></a></td>
            <td width="" scope="col"><?=$r["ori_ca_ciudad"]?> - <?=$r["des_ca_ciudad"]?></td>
            <td width="" scope="col"><?=$r["Reporte"]["Contacto"]["Cliente"]["ca_compania"]?></td>
            <td width="" scope="col"><?=$r["ca_propiedades"]?></td>
            <td width="" scope="col"><?=$r["ca_fchcreado"]?></td>
            <td width="" scope="col"><?=$r["ca_usucreado"]?></td>            
        </tr>
<?
    }
?>
    </table>
    
<?
}
?>

<script>
     var idreportetmp='';
    function desbloquear(id)
    {
        idreportetmp=id;
        if(window.confirm("Realmente desea desbloquear el reporte?"))
        {
            Ext.MessageBox.wait('Guardando, Espere por favor', '---');
            Ext.Ajax.request(
            {
                waitMsg: 'Guardando cambios...',
                url: '<?= url_for("reportesNeg/desbloquearReporte") ?>',
                params :	{
                    idantecedente:idreportetmp
                },
                failure:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if(res.err)
                        Ext.MessageBox.alert("Mensaje",'Se presento un error guardando por favor informe al Depto. de Sistemas<br>'+res.err);
                    else
                        Ext.MessageBox.alert("Mensaje",'Se produjo un error, vuelva a intentar o informe al Depto. de Sistema<br>'+res.texto);
                },
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    Ext.MessageBox.alert("Mensaje",'Se guardo correctamente el reporte y fue desbloqueado');
                    if(window.confirm('Desea enviar status inmediatamente?'))
                    {
                        if(res.transporte=='<?=Constantes::AEREO?>')
                            location.href="/traficos/listaStatus/modo/aereo/reporte/"+res.consecutivo;
                        else
                            location.href="/traficos/listaStatus/modo/maritimo/reporte/"+res.consecutivo;
                    }
                    else
                    {
                        location.href=location.href;
                    }
                }
            });
        }
    }
   
    function rechazar(id){
        idreportetmp=id;
        Ext.MessageBox.show({
           title: 'Rechazar Entrega de Reporte',
           msg: 'por favor coloque el motivo por el que rechaza el Reporte de Negocios:',
           width:300,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: rechaza,
           animEl: 'anular-reporte',
           modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        Ext.MessageBox.buttonText.no = "Todas las versiones";
    }

    var rechaza = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                if(btn=="ok")
                    href='/reportesNeg/rechazarReporte?idantecedente='+idreportetmp;
                Ext.MessageBox.wait('enviando Notificacion de rechazo', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        mensaje: text.trim()
                    },
                    failure:function(response,options){
                        alert( response.responseText );
                        Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema al tratar de rechzar el reporte")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            alert("Se envio aviso al depto de traficos")
                            location.href=location.href;
                        }
                    }
                 }
            );
            }
        }
    };
    
    
    function eliminar(id){
        idreportetmp=id;
        Ext.MessageBox.show({
           title: 'Eliminar Entrega de Reporte',
           msg: 'Por favor coloque el motivo por el que elimina la Notificación del Reporte de Negocios:',
           width:300,
           buttons:{
              ok     : "Enviar",
              cancel : "Cancelar"
           },
           multiline: true,
           fn: elimina,
           animEl: 'eliminar-reporte',
           modal: true
        });
        Ext.MessageBox.buttonText.yes = "Version";
        //Ext.MessageBox.buttonText.no = "Todas las versiones";
    }

    var elimina = function(btn, text){
        if( btn == "ok"){
            if( text.trim()==""){
                alert("Debe colocar un motivo");
            }else{
                if(btn=="ok")
                    href='/reportesNeg/rechazarReporte/idantecedente/'+idreportetmp+"/opcion/eliminar";
                Ext.MessageBox.wait('enviando Notificacion de eliminar', '');
                Ext.Ajax.request(
                {
                    waitMsg: 'Enviando...',
                    url: href,
                    params :	{
                        mensaje: text.trim()
                    },
                    failure:function(response,options){
                        alert( response.responseText );
                        Ext.Msg.hide();
                        success = false;
                        alert("Surgio un problema al tratar de eliminar el reporte")
                    },
                    success:function(response,options){
                        var res = Ext.util.JSON.decode( response.responseText );
                        if( res.success ){
                            //alert("Se envio aviso al depto de traficos")
                            location.href=location.href;
                        }
                    }
                 }
            );
            }
        }
    };
</script>