<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/
?>

<?
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
?>



