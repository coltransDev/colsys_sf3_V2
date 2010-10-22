<?
/*
* Muestra los resultados de la busqueda del reporte de negocios 
* @author Andres Botero , Mauricio Quinche
*/

?>
<div align="center">

<br />
<br />

<form action="<?=url_for( "reportesNeg/busquedaReporte")?>" method="post">
    <input type="hidden" name="idimpo" id="idimpo" value="<?=$idimpo?>"/>
<table width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" class="tableList alignLeft">
	<tr>
		<th colspan="3" style='font-size: 12px; font-weight:bold;'><b>Sistema Reporte de negocios </b>		</th>
	</tr>
    <tr>
		<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>

    </tr>
	<tr>

		<td width="123"  ><b>Buscar por:</b> <br />
            <select name="criterio" size="7">
						<option selected="selected" value="numero_de_reporte">N&uacute;mero de reporte</option>
						<option value="cliente">Cliente</option>
                        <option value="">Nombre del Consignatario </option>
                        <option value="login">Mis Reportes </option>
                        <option value="proveedor">Nombre del Proveedor </option>
                        <option value="orden_proveedor">No.Orden Proveedor </option>
                        <option value="orden_cliente">No.Orden Cliente </option>
                        <option value="cotizacion">No. Cotización </option>
                        <option value="mercancia_desc">Descripción Mercancia </option>
                        <option value="vendedor">Vendedor </option>
                        <option value="">Borradores </option>
                        <option value="">Tráficos </option>
                        <option value="ciudadorigen">Puerto  </option>
					</select>

		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text"  name="cadena" size="60" />
		</div>
            <br>
            Por Fechas <input type="checkbox" onclick="habFechas(this)">
            <br>
            <div  style="float: left;width: 50%">Fecha Inicial<div id="fecha1"></div></div>
            <div  style="float: left;width: 50%">Fecha Final<div id="fecha2"></div></div>
            <script>
                var fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaInicial',
                        id   : 'fechaInicial',
                        format: 'Y-m-d',
                        value: '<? //=date("Y-m-")."01"?>'
                    }
                );
                fech1.render("fecha1");
                var fech2= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaFinal',
                        id : 'fechaFinal',
                        format: 'Y-m-d',
                        value: '<? //=date("Y-m-d")?>'
                    }
                );
                fech2.render("fecha2");
                function habFechas(obj)
                {
                    fech1.setDisabled(!obj.checked);
                    fech2.setDisabled(!obj.checked);
                }
            </script>

        </td>
		<td  ><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>

</table>
</form>

<br />
<br />
</div>
<script>
function importar(id,idnew)
{
    if(window.confirm("Realmente desea importar este reporte"))
    {
        Ext.MessageBox.wait('Importando reporte, Espere porf favor', 'Importar');
        Ext.Ajax.request(
        {
            waitMsg: 'Guardando cambios...',
            url: '<?=url_for("reportesNeg/importarReporte")?>',
            params :	{
                idreportenew: idnew,
                idreporte: id
            },
                failure:function(response,options){
                alert( response.responseText );
                success = false;
            },
            success:function(response,options){
                var res = Ext.util.JSON.decode( response.responseText );
                if( res.success ){
                    location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/<?=$impoexpo?>/modo/<?=$modo?>";
                }
            }
        });
    }
}
</script>
<div align="center">
<table width="800px" border="1" class="tableList alignLeft">
	<tr>
		<th width="70" scope="col">Consecutivo</th>
		<th width="668" scope="col">Trayecto</th>
	</tr>
	<?
    $consecutivo="";
    if($reportes)
    {
        foreach( $reportes as $reporte ){
            $origen = $reporte->getOrigen();
            $destino = $reporte->getDestino();
        ?>
        <tr>
            <td rowspan="2">
                <?
                if($idimpo>0)
                {
                 ?>
                <a href="javascript:importar('<?=$idimpo?>','<?=$reporte->getCaIdreporte()?>')"><?=$reporte->getCaConsecutivo()." V".$reporte->getCaVersion()?></a>
                <?
                }else
                {
                    $url = "reportesNeg/consultaReporte?id=".$reporte->getCaIdreporte()."&modo=".$reporte->getCaTransporte()."&impoexpo=".$reporte->getCaImpoexpo().($opcion?"&opcion=".$opcion:"");
                    echo link_to($reporte->getCaConsecutivo()." V".$reporte->getCaVersion(), $url );
                
                }
                ?>
            </td>

            <td  >
                <?="<b>".$reporte->getCliente()."</b> (".$reporte->getCaTransporte()." ".$reporte->getCaModalidad().")"?>
                </td>
        </tr>
        <tr >
            <td width="100%"  >
                <table width="100%"  >
                        <tr  style="font-weight: bold;background:#D2D2D2;">
                            <td  >Origen</td>
                            <td  >Destino</td>
                            <td width="15%" >Fch.Despacho</td>
                            <td width="15%" >T.Incoterms</td>
                            <td width="15%" >Orden</td>
                            <td width="15%" >Cot</td>
                        </tr>
                        <tr>
                            <td class="listar"><?=$origen?$origen->getTrafico()."->".$origen->getCaCiudad():"&nbsp;"?></td>
                            <td class="listar"><?=$destino?$destino->getTrafico()."->".$destino->getCaCiudad():"&nbsp;"?></td>
                            <td class="listar"><?=$reporte->getCaFchreporte()?></td>
                            <td class="listar"><?=$reporte->getCaIncoterms()?></td>
                            <td class="listar"><?=$reporte->getCaOrdenClie()?></td>
                            <td class="listar"><?=$reporte->getCaIdcotizacion()?></td>
                        </tr>
                        <tr><td class="invertir" style="font-weight: bold;">Proveedor</td><td colspan="5" class="listar">
                            <?
                            if( $reporte->getCaIdproveedor() ){
                            $values = explode("|", $reporte->getCaIdproveedor());
                            $values2 = explode("|", $reporte->getCaOrdenProv());

                            for($i=0;$i<count($values);$i++)
                            {
                                $tercero = Doctrine::getTable("Tercero")->find($values[$i]);
                                if($tercero)
                                {
                                    echo $tercero->getCaNombre()." - ".  $values2[$i]."<br>";
                                }
                            }
                            }

                            ?>
                            </td></tr>                   
                </table></td>
        </tr>
        <?
        $consecutivo=$reporte->getCaConsecutivo();
        }
    }
	?>
</table>
</div>
