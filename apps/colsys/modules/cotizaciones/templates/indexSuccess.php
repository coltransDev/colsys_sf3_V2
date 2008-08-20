<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/
use_helper("Javascript");
?>
<h3>Sistema de Cotizaciones</h3>
<?=form_tag( "cotizaciones/busquedaCotizacion" )?>

<table width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">		
	<tr>	
		<th colspan="6" style='font-size: 12px; font-weight:bold;'><b><strong>Ingrese un criterio para realizar las busqueda</strong></b></th>		
	</tr>
	<tr>
		<th rowspan="3"></th>
		<td width="123" class="listar"><b>Buscar por:</b> <br />
			<?=select_tag("criterio", options_for_select( array("mis_cotizaciones"=>"Mis Cotizaciones", "nombre_del_cliente"=>"Nombre del Cliente", "nombre_del_contacto"=>"Nombre del Contacto", "asunto"=>"Asunto", "vendedor"=>"Vendedor", "numero_de_cotizacion"=>"N&uacute;mero de Cotizaci&oacute;n"), "mis_cotizaciones" ), "size=7" );?>		
		</td>
		<td class="listar"><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<?=input_tag("cadena", "", "size=60")?>
		</div></td>
		<th rowspan="3" colspan="2"><input class="submit" type='submit' name='buscar' value=' Buscar' /></th>
	</tr>
	<tr style="HEIGHT:5">
		<td class="captura" colspan="6"></td>
	</tr>
</table>
</form>