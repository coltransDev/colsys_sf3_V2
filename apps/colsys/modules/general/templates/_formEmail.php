
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
<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableForm">	
	<tr>
		<td width="454"><div align="left"><strong>Remitente:</strong> <br />
			<?
				echo "".$user->getNombre()." &lt;".$user->getEmail()."&gt;";
				?>
		</div></td>
	    <td width="246">Contactos</td>
	</tr>
	<tr>
		<td><div align="left"><strong>Destinatario:</strong> (Por favor separe varios destinatarios con comas)<br>		
				
				<input type="text" name="destinatario" id="destinatario" size="100" onfocus="textFocus='destinatario'"  />
		</div></td>
	    <td rowspan="4" valign="top">
		<?
		if( isset($contacts) ){
			$contactos = explode(",", $contacts);
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
		<td><div align="left"><strong>CC</strong>
				<br>
				<input type="text" name="cc" id="cc" size="100" onfocus="textFocus='cc'"  />
				
		</div></td>
    </tr>
	<tr>
		<td><div align="left"><strong>Asunto:</strong><br />
				<?				
			
			echo input_tag("asunto", isset($subject)?$subject:"" , "size=100");
			?>
		</div></td>
    </tr>
	<tr>
		<td><div align="left"><strong>Solicitar Acuse de recibo:</strong> <br />
				<?=checkbox_tag("readreceipt", "true", true);?>
		</div></td>
    </tr>
	<tr>
		<td colspan="2">
			<div align="left"><strong>Mensaje</strong><br>
				<?				
		echo textarea_tag("mensaje",isset($message)?$message:"", array('size'=>'120x5','rich'=>false, 'width'=>620, 'height'=>'150' ));
		?>
		</div></td>
    </tr>
</table>
