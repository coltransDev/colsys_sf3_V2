<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/
use_helper("Javascript");
use_helper("Object");
?>
<?=form_tag( "cotizaciones/busquedaCotizacion" )?>
<script language="javascript">
	function cambiarVendedor( field ){
		if( field.value=="vendedor" ){
			document.getElementById("cadena").style.display="none";
			document.getElementById("login").style.display="inline";
		}else{
			document.getElementById("login").style.display="none";
			document.getElementById("cadena").style.display="inline";
		}
	
	}
</script>
<table class="tableForm" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">		
	<tr>	
		<th colspan="4" style='font-size: 12px; font-weight:bold;'>Sistema de Cotizaciones</th>		
	</tr>
	<tr>	
		<th colspan="4" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</th>		
	</tr>
	<tr>
		<th rowspan="2">&nbsp;</th>
		<td width="123" class="listar"><b>Buscar por:</b> <br />
			<?=select_tag("criterio", options_for_select( array("mis_cotizaciones"=>"Mis Cotizaciones", "consecutivo"=>"Consecutivo", "nombre_del_cliente"=>"Nombre del Cliente", "nombre_del_contacto"=>"Nombre del Contacto", "asunto"=>"Asunto", "vendedor"=>"Vendedor", "numero_de_cotizacion"=>"N&uacute;mero de Cotizaci&oacute;n", "sucursal"=>"Sucursal"), "mis_cotizaciones" ), "size=7 onChange='cambiarVendedor(this)'" );?>		
		</td>
		<td class="listar"><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<div id="cadena"><?=input_tag("cadena", "", "size=60")?></div>
			<div id="login" style="display:none">
			<?
			echo select_tag("login", objects_for_select($comerciales, "getCaLogin", "getCaNombre" ) );						
			?>
			</div>
		</div></td>
		<th rowspan="2"><input class="submit" type='submit' name='buscar' value=' Buscar' /></th>
	</tr>
	<tr style="HEIGHT:5">
		<td class="captura" colspan="6"></td>
	</tr>
</table>
<?="</form>";?>