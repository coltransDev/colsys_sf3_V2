
<script language="javascript">
var textFocus="destinatario";

var seleccionarContacto = function(){	
	var contactos = document.getElementById("contactos");	
	var selected = contactos.options[contactos.selectedIndex].value;
	var target = document.getElementById(textFocus);	
	
	if( target.value.indexOf(selected)==-1 ){	
		if(target.value){
			target.value+=",";	
		}			
		target.value+=selected;	
	}
	
	
	 
}
</script> 
<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">	
	<tr>
		<th colspan="2">Nuevo correo Electronico</th>

	</tr>
	<tr>
		<td width="454"><div align="left"><b>Remitente:</b> <br />
			<?
				echo "".$user->getNombre()." &lt;".$user->getEmail()."&gt;";
				?>
		</div></td>
	    <td width="246">Contactos</td>
	</tr>
	<tr>
		<td><div align="left"><b>Destinatario:</b> (Por favor separe varios destinatarios con comas)<br>		
				
				<input type="text" name="destinatario" id="destinatario" size="100" onfocus="textFocus='destinatario'"  />
		</div></td>
	    <td rowspan="4" valign="top">
		<?
		if( isset($contacts) ){
			$contactos = explode(",", $contacts);
			$contactos = array_unique($contactos);
			?>
			<select name="contactos" id="contactos" size="8" onDblclick="seleccionarContacto()" >
			<?
			foreach($contactos as $contacto){			
			?>
				<option value="<?=$contacto?>"><?=$contacto?></option> 
			<?
			}
			?>
			</select>
			<?
		}
		?>
		</td>
	</tr>
	<tr>
		<td><div align="left"><b>CC</b>
				<br>
				<input type="text" name="cc" id="cc" size="100" onfocus="textFocus='cc'"  />
				
		</div></td>
    </tr>
	<tr>
		<td><div align="left"><b>Asunto:</b><br />
			<input type="text" name="asunto" id="asunto" size="100" value="<?=isset($subject)?$subject:""?>" />
			
		</div></td>
    </tr>
	<tr>
		<td><div align="left"><b>Solicitar Acuse de recibo:</b> <br />
			<input type="checkbox" name="readreceipt" value="true" checked="checked" />	
		</div></td>
    </tr>
	<tr>
		<td colspan="2">
			<div align="left"><b>Mensaje</b><br>
				<textarea name="mensaje" cols="140" rows="10" ><?=isset($message)?$message:""?></textarea>			
		</div></td>
    </tr>
</table>
