<div align="center">
	
	<br />
	<form action="<?=url_for( "confirmaciones/busqueda?modo=".$modo )?>" method="post" >
	<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >		
		<tr>	
			<th colspan="3" style='font-size: 12px; font-weight:bold;'> Módulo de Confirmaciones de Llegada</th>
		</tr>
		<tr>	
			<td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar las busqueda</td>
		</tr>
		<tr>
			<td width="88" ><b>Buscar por:</b> <br />
				<?=select_tag("criterio", options_for_select( array("referencia"=>"Número de referencia", "reporte"=>"Número de reporte", "blmaster"=>"BL Master", "motonave"=>"Motonave", "contenedor"=>"No. Contenedor", "blhijo"=>"BL Hijo", "cliente"=>"Nombre del cliente", "NIT"=>"idcliente"), "referencia" ), "size=7" );?>	  </td>
			<td width="337" >&nbsp;
			  <b>Que contenga la cadena:</b><br />
			  <div id="cadena"><?=input_tag("cadena", "", "size=60 ")?></div>
				
		   </td>
		  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
		</tr>
	</table>
</form>	
</div>