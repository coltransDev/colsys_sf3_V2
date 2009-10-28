<?
/**
* Pantalla de bienvenida para el modulo de reportes
* @author Andres Botero
*/

?>
<div align="center">

<br />
<br />
<form action="<?=url_for( "reportesNeg/busquedaReporte?modo=".$modo	)?>" method="post">
<table width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" class="tableList">
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

					</select>
		</td>
		<td  ><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<input type="text" name="cadena" size="60" />
		</div></td>
		<td  ><input class="submit" type='submit' name='buscar' value=' Buscar' /></td>
	</tr>

</table>
</form>

<br />
<br />
</div>