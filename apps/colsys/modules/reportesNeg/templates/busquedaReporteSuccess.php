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
                <option value="ca_consecutivo" <?=($criterio=="ca_consecutivo")?"selected":""?>>N&uacute;mero de reporte</option>
                        <option value="ca_nombre_cli" <?=($criterio=="ca_nombre_cli")?"selected":""?>>Cliente</option>
                        <option value="ca_nombre_con" <?=($criterio=="ca_nombre_con")?"selected":""?>>Nombre del Consignatario </option>
                        <option value="ca_login" <?=($criterio=="ca_login")?"selected":""?>>Mis Reportes </option>
                        <option value="ca_nombre_pro" <?=($criterio=="ca_nombre_pro")?"selected":""?>>Nombre del Proveedor </option>
                        <option value="ca_orden_prov" <?=($criterio=="ca_orden_prov")?"selected":""?>>No.Orden Proveedor </option>
                        <option value="ca_orden_clie" <?=($criterio=="ca_orden_clie")?"selected":""?>>No.Orden Cliente </option>
                        <option value="ca_idcotizacion" <?=($criterio=="ca_idcotizacion")?"selected":""?>>No. Cotización </option>
                        <option value="ca_mercancia_desc" <?=($criterio=="ca_mercancia_desc")?"selected":""?>>Descripción Mercancia </option>
                        <option value="ca_login" <?=($criterio=="ca_login")?"selected":""?>>Vendedor </option>
                        <option value="ca_traorigen" <?=($criterio=="ca_traorigen")?"selected":""?>>Tráficos </option>
                        <option value="ca_ciuorigen" <?=($criterio=="ca_ciuorigen")?"selected":""?>>Puerto  </option>
            </select>

		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text"  name="cadena" size="60" value="<?=$cadena?>" />
		</div>
            <br>
            Por Fechas <input type="checkbox" onclick="habFechas(this)">
            <br>
            <div>
            <div  style="float: left;width: 50%">Fecha Inicial<div id="fecha1"></div></div>
            <div  style="float: left;width: 50%">Fecha Final<div id="fecha2"></div></div>
            </div>
            <script>
                var fech1= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaInicial',
                        id   : 'fechaInicial',
                        format: 'Y-m-d',
                        value: '<?=$fechaInicial?>'
                    }
                );
                fech1.render("fecha1");
                var fech2= new Ext.form.DateField(
                    {
                        fieldLabel: 'Fecha Inicial',
                        name : 'fechaFinal',
                        id : 'fechaFinal',
                        format: 'Y-m-d',
                        value: '<?=$fechaFinal?>'
                    }
                );
                fech2.render("fecha2");
                function habFechas(obj)
                {
                    fech1.setDisabled(!obj.checked);
                    fech2.setDisabled(!obj.checked);
                }
            </script>
            <br>&nbsp;
            <div>
                <div  style="float: left;width: 50%">Seguro <select id="seguro" name="seguro"><option value="">...</option><option value="Sí" <?=($seguro=="Sí")?"selected":""?>>Sí</option><option value="No" <?=($seguro=="No")?"selected":""?>>No</option></select></div>
                <div  style="float: left;width: 50%">Aduanas <select id="colmas" name="colmas"><option value="">...</option><option value="Sí" <?=($colmas=="Sí")?"selected":""?>>Sí</option><option value="No" <?=(cadena=="No")?"selected":""?>>No</option></select></div>
            </div>


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
                    location.href="/reportesNeg/consultaReporte/id/"+res.idreporte+"/impoexpo/"+res.impoexpo+"/modo/"+res.transporte;
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

            $origen = $reporte["ca_ciuorigen"];
            $destino = $reporte["ca_ciudestino"];
        ?>
        <tr style="<?=($consecutivo==$reporte["ca_consecutivo"])?"":"border-top: 3px solid #A0A0A0" ?>">
            <td rowspan="2">
                <?
                if($idimpo>0)
                {
                 ?>
                <a href="javascript:importar('<?=$idimpo?>','<?=$reporte["ca_idreporte"]?>')"><?=(($consecutivo==$reporte["ca_consecutivo"])?"":$reporte["ca_consecutivo"])." V".$reporte["ca_version"]?></a>
                <?
                }else
                {
                    $url = "reportesNeg/consultaReporte?id=".$reporte["ca_idreporte"]."&modo=".$reporte["ca_transporte"]."&impoexpo=".(($reporte["ca_impoexpo"]=="OTM/DTA")?"OTM-DTA":$reporte["ca_impoexpo"]).($opcion?"&opcion=".$opcion:"");
                    echo link_to((($consecutivo==$reporte["ca_consecutivo"])?"":$reporte["ca_consecutivo"])." V".$reporte["ca_version"], $url );
                
                }
                if($reporte["ca_usuanulado"]!="")
                    echo "<br>Anulado";
                else if($reporte["ca_usucerrado"]!="")
                    echo "<br>Cerrado";
                ?>
            </td>

            <td  >
                <?="<b>".$reporte["ca_nombre_cli"]."</b> (".$reporte["ca_transporte"]." ".$reporte["ca_modalidad"].") - ".$reporte["ca_nomlinea"]?>
                </td>
        </tr>
        <tr  >
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
                            <td class="listar"><?=$origen?></td>
                            <td class="listar"><?=$destino?></td>
                            <td class="listar"><?=$reporte["ca_fchdespacho"]?></td>
                            <td class="listar"><?=$reporte["ca_incoterms"]?></td>
                            <td class="listar"><?=$reporte["ca_orden_clie"]?></td>
                            <td class="listar"><?=$reporte["ca_idcotizacion"]?></td>
                        </tr>
                        <tr><td class="invertir" style="font-weight: bold;">Proveedor</td><td colspan="5" class="listar">
                            <?
                            if( $reporte["ca_idproveedor"] ){
                            $values = explode("|", $reporte["ca_idproveedor"]);
                            $values2 = explode("|", $reporte["ca_orden_prov"]);

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
            $consecutivo=$reporte["ca_consecutivo"];
        }
    }
	?>
</table>
</div>
