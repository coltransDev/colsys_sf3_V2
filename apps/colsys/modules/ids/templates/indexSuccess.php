<div class="content" align="center">
<h3>Maestra de proveedores</h3>
<br />

<form action="<?=url_for( "ids/busqueda?modo=".$modo )?>" method="post" >
<script language="javascript">
	
</script>
<table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >		
	<tr>	
		<th colspan="3" style='font-size: 12px; font-weight:bold;'><span style="font-size: 10px;">Ingrese un criterio para realizar las busqueda</span></th>
    </tr>
	
	<tr>
		<td width="88" ><b>Buscar por:</b> <br />
			<select name="criterio" size="7">
				<option value="nombre">Nombre</option>
			</select>
		</td>
		<td width="337" >&nbsp;
		  <div id="visible" ><b>Que contenga la cadena:</b><br />
			<div id="cadena"><input  type='text' name='cadena' value='' size="60" /></div>
			
	  </div></td>
	  <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
	</tr>
</table>
</form>



</div>