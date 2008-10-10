<?


use_helper("YUICalendar", "Modalbox","Javascript", "Validation");
echo form_tag("traficos/verEstatusCarga?modo=".$modo, "name=cuadroStatusForm id=cuadroStatusForm" );
?>
<script language="JavaScript" type="text/javascript">
	
	function seleccionCliente( formName , sel) {
 		
		switch( formName ){			
			case "cuadroStatusForm":	
				var target = document.cuadroStatusForm;					
				target.idcliente.value=document.getElementById("idcliente_"+sel).value;
				target.cliente.value=document.getElementById("compania_"+sel).value; 
				break;
		}
		Modalbox.hide({params:''});
	}
</script>	

						<table width="50%" border="1" class="tableForm">
	<tr>
		<th colspan="2" scope="col">Modulo de status de tr&aacute;ficos </th>
	</tr>

	<tr>
		<td><div align="right"><strong>Cliente:</strong></div></td>
		<td><span class="mostrar">
			<?=include_component("clientes", "comboClientes" )?>			
		</span></td>
	</tr>
	<tr>
		<td colspan="2" class="row1"><div align="center"><strong><?=radiobutton_tag("ver", "activos", true)?> Ver reportes activos: </strong></div></td>
	</tr>
	
	<tr>
		<td colspan="2" class="row1"><div align="center"><strong><?=radiobutton_tag("ver","fecha" ,false)?> Ver entre dos fechas: </strong></div></td>
	</tr>
	
	<tr>
		<td><div align="right"><strong>Fecha Inicial: </strong></div></td>
		<td><div align="left">
			<?=yui_calendar("fechaInicial", date("Y-m-")."01", null, "2008-01-01" )?>
		</div></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Fecha final:</strong> </div></td>
		<td><div align="left">
			<?=yui_calendar("fechaFinal", date("Y-m-d"), null, "2008-03-01" )?>
		</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><strong>
			<?=radiobutton_tag("ver", "reporte", false)?>
Por n&uacute;mero de reporte </strong><br />
<?=input_tag("numreporte")?>
</div></td>
	</tr>
	<tr>
		<td colspan="2"><div align="center"><?=submit_tag("continuar", "class=button")?></div></td>
	</tr>
</table>
</form>
