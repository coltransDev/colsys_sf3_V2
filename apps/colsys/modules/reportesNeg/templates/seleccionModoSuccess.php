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
			<?=link_to("A�reo", "reportesNeg/index?modo=A�reo&impoexpo=Importaci�n" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Mar�timo", "reportesNeg/index?modo=Mar�timo&impoexpo=Importaci�n")?>
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
			<?=link_to("A�reo", "reportesNeg/index?modo=A�reo&impoexpo=Exportaci�n" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Mar�timo", "reportesNeg/index?modo=Mar�timo&impoexpo=Exportaci�n")?>
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
			<?=link_to("A�reo", "reportesNeg/index?modo=A�reo&impoexpo=Triangulaci�n" )?>
		</td>
<?
	}

	if( $nivelMaritimo>=0 ){
?>
        <td><div align="left">
			<?=link_to("Mar�timo", "reportesNeg/index?modo=Mar�timo&impoexpo=Triangulaci�n")?>
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