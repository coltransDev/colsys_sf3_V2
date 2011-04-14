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
            <?=link_to("OTM-DTA ", "reportesNeg/formReporte?modo=Marítimo&impoexpo=".constantes::OTMDTA )?>
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
include_component("reportesNeg", "filtrosBusqueda");
?>

