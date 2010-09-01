<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="2" align="left"><b>Seleccione el servicio</b></th>
	</tr>
    <tr><td colspan="2"><b>Importaci&oacute;n</b></td></tr>

    <tr style="padding: 10px">
<?
	if( $nivelAereo>=0 ){
?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/index?modo=Aéreo&impoexpo=Importación" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/index?modo=Marítimo&impoexpo=Importación")?>
		</div></td>
<?
	}
?>
	</tr>
    <tr><td colspan="2" ><b>Exportaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
	if( $nivelAereo>=0 ){
?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/index?modo=Aéreo&impoexpo=Exportación" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/index?modo=Marítimo&impoexpo=Exportación")?>
		</div></td>
<?
	}
?>
	</tr>
<?

    if( $nivelAduana>=0 ){
	?>
    <tr style="display: none">
		<td><div align="left">
			<?=link_to("Aduana", "reportesNeg/index?idcategory=21")?>
		</div></td>
	</tr>
	<?
	}
?>
    <tr><td colspan="2" ><b>Triangulaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
	if( $nivelAereo>=0 ){
?>
        <td align="left">
			<?=link_to("Aéreo", "reportesNeg/index?modo=Aéreo&impoexpo=Triangulación" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Marítimo", "reportesNeg/index?modo=Marítimo&impoexpo=Triangulación")?>
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
			<?=link_to("Otros Servicios", "reportesNeg/indexOs")?>
		</div></td>
    </tr>
	
</table>

</div>