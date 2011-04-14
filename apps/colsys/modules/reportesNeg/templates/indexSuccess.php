<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/
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
			<?=link_to("A�reo", "reportesNeg/formReporte?modo=A�reo&impoexpo=Importaci�n" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Mar�timo", "reportesNeg/formReporte?modo=Mar�timo&impoexpo=Importaci�n")?>
		</div></td>

        <td align="left">
            <?=link_to("OTM-DTA ", "reportesNeg/formReporte?modo=Mar�timo&impoexpo=".constantes::OTMDTA )?>
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
            <?=link_to("A�reo", "reportesNeg/formReporte?modo=A�reo&impoexpo=Exportaci�n" )?>
	</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
            <?=link_to("Mar�timo", "reportesNeg/formReporte?modo=Mar�timo&impoexpo=Exportaci�n")?>
	</div></td>
<?
	}
?>
        <td><div align="left">
            <?=link_to("Terrestre ", "reportesNeg/formReporte?modo=Terrestre&impoexpo=Exportaci�n")?>
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
			<?=link_to("A�reo", "reportesNeg/formReporte?modo=A�reo&impoexpo=Triangulaci�n" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Mar�timo", "reportesNeg/formReporte?modo=Mar�timo&impoexpo=Triangulaci�n")?>
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
include_component("reportesNeg", "filtrosBusqueda");
?>

