<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero, Mauricio Quinche
*/

?>

<div class="content" align="center">
	<table width="50%" border="0" class="tableList">
	<tr>
        <th scope="col" colspan="3" align="left"><b>Crear un nueva referencia, seleccione el servicio</b></th>
	</tr>
    <tr><td colspan="3"><b>Importaci&oacute;n</b></td></tr>

    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "ino/formIno?modo=Aéreo&impoexpo=Importación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "ino/formIno?modo=Marítimo&impoexpo=Importación")?>
		</div></td>
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
            <?=link_to("Aéreo", "ino/formIno?modo=Aéreo&impoexpo=Exportación" )?>
	</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
            <?=link_to("Marítimo", "ino/formIno?modo=Marítimo&impoexpo=Exportación")?>
	</div></td>
<?
	}
?>
	</tr>


    <tr><td colspan="2" ><b>Triangulaci&oacute;n</b></td></tr>
    <tr style="padding: 10px">
<?
//	if( $nivelAereo>=0 )
    {

?>
        <td align="left">
			<?=link_to("Aéreo", "ino/formIno?modo=Aéreo&impoexpo=Triangulación" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Marítimo", "ino/formIno?modo=Marítimo&impoexpo=Triangulación")?>
		</div></td>
<?
	}
?>
	</tr>
     <tr><td colspan="2" ><b>Otros</b></td></tr>
    <tr>
        <td><div align="left">
			<?=link_to("Otros Servicios", "ino/formInoOs")?>
		</div></td>
    </tr>

</table>

</div>
<br />
<br />

<?
include_component("ino","panelFiltro");
?>