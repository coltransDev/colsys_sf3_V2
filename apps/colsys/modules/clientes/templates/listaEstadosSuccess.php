<?
/**
* Pantalla de bienvenida para el modulo de reportes 
* @author Andres Botero
*/
use_helper('YUICalendar');
?>
<?=form_tag( "clientes/reporteEstados" )?>

<table class="tableForm" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" id="mainTable">		
	<tr>	
		<th colspan="5" style='font-size: 12px; font-weight:bold;'>Reporte Estado de Clientes</th>		
	</tr>
	<tr>	
		<th colspan="5" style='font-size: 10px;'>Ingrese la fecha inicial y final del peri&oacute;do a evaluar</th>		
	</tr>
	<tr>
		<th rowspan="2">&nbsp;</th>

		<td>
			<span class="captura"><b>Fecha Inicial :</b> <br />
				<?=yui_calendar("fchStart", date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y"))), null )?>
			</span>
  		</td>

		<td>
			<span class="captura"><b>Fecha Inicial :</b> <br />
				<?=yui_calendar("fchEnd", date("Y-m-d"), null )?>
			</span>
  		</td>

		<td>
			<span class="captura"><b>Empresa :</b> <br />
				<?=select_tag("empresa", options_for_select(array("Coltrans"=>"Coltrans","Colmas"=>"Colmas")) );?>
			</span>
  		</td>

		<th rowspan="2"><input class="submit" type='submit' name='buscar' value=' Buscar' /></th>
	</tr>
	<tr style="HEIGHT:5">
		<td class="captura" colspan="6"></td>
	</tr>
</table>
<?="</form>";?>