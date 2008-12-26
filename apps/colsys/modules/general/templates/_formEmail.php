

<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableForm">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><div align="left"><strong>Remitente:</strong> <br />
			<?
				echo "".$user->getNombre()." &lt;".$user->getEmail()."&gt;";
				?>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><strong>Destinatario:</strong> (Por favor separe varios destinatarios con comas)<br>		
				<?				
				//echo form_error("destinatario");			
				echo input_tag("destinatario", "" , "size=120");
				?>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><strong>CC</strong>
				<br>
				<?							
			echo input_tag("cc", "" , "size=120");
			?>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><strong>Asunto:</strong><br />
				<?				
			
			echo input_tag("asunto", isset($subject)?$subject:"" , "size=120");
			?>
		</div></td>
	</tr>
	<tr>
		<td><div align="left"><strong>Solicitar Acuse de recibo:</strong> <br />
				<?=checkbox_tag("readreceipt", "true", true);?>
		</div></td>
	</tr>
	<tr>
		<td>
			<div align="left"><strong>Mensaje</strong><br>
				<?		
		
		echo textarea_tag("mensaje",isset($message)?$message:"", array('size'=>'120x5','rich'=>false, 'width'=>620, 'height'=>'150' ));
		?>
		</div></td>
	</tr>
</table>