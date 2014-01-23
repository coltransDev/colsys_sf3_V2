<?
$message=$sf_data->getRaw("message");
$messageHtml=$sf_data->getRaw("messageHtml");
?>

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

var seleccionarContacto1 = function(){
	var contactos = document.getElementById("contactos1");
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
<?
/*if( !sfConfig::get("app_smtp_user") ){
?>
<?=image_tag("22x22/alert.gif")?>La autenticación SMTP se encuentra desactivada, es posible que sus mensajes no lleguen al destinatario.
<br />
<br />
<?
}*/
?>

<table width="700px" border="0" cellspacing="0" cellpadding="0" class="tableList">	
	<tr>
		<th colspan="2">Nuevo correo Electronico</th>

	</tr>
	<tr>		
		<td width="454"><div align="left"><b>Remitente:</b> <br />
			<?
			if( isset( $from ) && count($from)>0 ){
				?>
				<select name="from" id="from">
					<?
					foreach( $from as $email ){
					?>
					<option value="<?=$email?>" <?=$user->getEmail()==$email?'selected="selected"':''?>><?=$email?></option>
					<?
					}
					?>
				</select>
				<?
			}else{	
				echo "".$user->getNombre()." &lt;".$user->getEmail()."&gt;";
			}
			?>
		</div></td>
		
        <td width="246"><b>Contactos</b></td>
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
			<input type="checkbox" name="readreceipt" value="false" />	
		</div></td>
    </tr>
	<tr>
		<td colspan="<?=(($contacts1!="")?"1":"2" )?>">
			<div align="left"><b>Mensaje</b><br>
<?
            if(isset($message))
            {
?>
                <textarea name="mensaje" style="width: 100%" rows="10" ><?=isset($message)?$message:""?></textarea>			
<?
            }
            else if(isset($messageHtml))
            {
?>
                <div id="ta"> </div>
                <script>
                    new Ext.form.HtmlEditor({
                    renderTo: 'ta',
                    width: 800,
                    height: 300,
                    value:'<?=isset($messageHtml)?$messageHtml:""?>',
                    name:"mensaje",
                    id:"mensaje"
                });
                </script>
<?
            }
?>
		</div>
            
        </td>
        <?
        if( $contacts1!="" ){
        ?>
        <td valign="top">
            <b><?=$nameContacts1?></b><br>
		<?
		
			$contactos1 = explode(",", $contacts1);
			$contactos1 = array_unique($contactos1);
			?>
			<select name="contactos1" id="contactos1" size="8" onDblclick="seleccionarContacto1()" >
			<?
			foreach($contactos1 as $contacto){
			?>
				<option value="<?=$contacto?>"><?=$contacto?></option> 
			<?
			}
			?>
			</select>			
		</td>
        <?
		}
		?>
    </tr>
</table>
