<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/
use_helper("Javascript");
?>
<h3>Sistema Reporte de negocios</h3>
<br />
<br />
<?=form_tag( "reportesNeg/busquedaReporte?modo=".$modo	)?>
<table width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">		
	<tr>	
		<th colspan="5" style='font-size: 12px; font-weight:bold;'><b><b>Ingrese un criterio para realizar las busqueda</b></b>		</th>		
	</tr>
	<tr>
		
		<td width="123" rowspan="3" class="listar"><b>Buscar por:</b> <br />
			<?
		echo select_tag("criterio", 
							options_for_select( array("numero_de_reporte"=>"N&uacute;mero de reporte", "cliente"=>"Cliente"), "numero_de_reporte" ), "size=5"
						); //, "fecha_reporte"=>"Fecha del reporte"
		?>		</td>
		<td class="listar" colspan="2"><div id="visible" style="visibility:visible"><b>Que contenga la cadena:</b><br />
			<?=input_tag("cadena", "", "size=60")?>
		</div></td>
		<th rowspan="3" colspan="2"><input class="submit" type='submit' name='buscar' value=' Buscar' /></th>
	</tr>
	<tr>
		<td width="141" class="listar"><div id="ocultar" style="visibility:hidden"><b>Fecha Inicial: </b><br />
				<input type="text" name="fchinicial" size="12" value="" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" />
			</div></td>
		<td width="144" class="listar"><div id="ocultardos" style="visibility:hidden"><b>Fecha Final : </b><br />
				<input type="text" name="fchfinal" size="12" value="" ondblclick="popUpCalendar(this, this, 'yyyy-mm-dd')" />
		</div></td>		
	</tr>
	<tr>
		<td class="listar" colspan="2"><center>
				<div id="ocultarvia" style="visibility:hidden"><b>Via : </b><br />
					
					<select name="via">
						<option selected="selected" value="Aereo">A&eacute;reo</option>
						<option value="Maritimo">Mar&iacute;timo</option>
						<option value="Terrestre">Terrestre</option>
						<option value="Aereo/Terrestre">A&eacute;reo / Terrestre</option>
						<option value="Maritimo/Terrestre">Mar&iacute;timo / Terrestre</option>
					</select>
				</div>
			</center></td>
	</tr>
	<tr style="HEIGHT:5">
		<td class="captura" colspan="6"></td>
	</tr>
</table>
</form>
<br />
<br />
<div id="resultados"></div>