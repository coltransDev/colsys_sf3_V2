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
			<?=link_to("A�reo", "ino/formIno?modo=A�reo&impoexpo=Importaci�n" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Mar�timo", "ino/formIno?modo=Mar�timo&impoexpo=Importaci�n")?>
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
            <?=link_to("A�reo", "ino/formIno?modo=A�reo&impoexpo=Exportaci�n" )?>
	</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
            <?=link_to("Mar�timo", "ino/formIno?modo=Mar�timo&impoexpo=Exportaci�n")?>
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
			<?=link_to("A�reo", "ino/formIno?modo=A�reo&impoexpo=Triangulaci�n" )?>
		</td>
<?
	}

//	if( $nivelMaritimo>=0 )
    {

?>
        <td><div align="left">
			<?=link_to("Mar�timo", "ino/formIno?modo=Mar�timo&impoexpo=Triangulaci�n")?>
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