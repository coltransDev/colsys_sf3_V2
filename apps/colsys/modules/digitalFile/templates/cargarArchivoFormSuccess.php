<?php 
echo form_tag("digitalFile/cargarArchivo?referencia=".str_replace(".","|",$referencia)."&factura=".$factura , "name=form1 multipart=true target=uploadFrame") ;
echo input_hidden_tag("tipo" , $tipo );

echo input_hidden_tag("factura" , $factura );
?>
<table width="100%" border="0" class="table1">
	<tr class="rowt">
		<td colspan="2" >&nbsp;</td>
	</tr>
	<tr>
		<td width="50%"><div align="right"><strong>Buscar archivo </strong></div></td>
		<td width="50%"><?php echo input_file_tag('file') ?></td>
	</tr>
	<?
	
	?>
	
	
	<?
	
	?>
	<tr>
		<td colspan="2"><div align="center"><?php echo submit_tag('Subir', "class=button") ?></div></td>
	</tr>
</table>
</form>

<iframe name="uploadFrame" id="uploadFrame" width="300" height="200" style="display:none" ></iframe>


