<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    <div id="emailForm" align="center">

        <form name="form1" id="form1" method="post" action="<?=url_for("antecedentes/enviarEmailColoader?ref=".str_replace(".","|",$ref->getCaReferencia()))?>" >
            <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
<?
        $subject  = "Notificacion ref: ".$ref->getCaReferencia()."-MBL:".$ref->getCaMbls()."-Mn:".$ref->getCaMotonave()."-ETA:".$ref->getCaFcharribo();
        $message = "";//"Señores ".$ref->getCaReferencia();
        $contacts=$contactos;
        //include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje, "contacts"=>$contactos));
        ?>
<?
$message=$sf_data->getRaw("message");
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
		<th colspan="2">Nuevo correo Electronico de Notificacion</th>

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
		<td><div align="left"><b>Seleccione el motivo de notificacion:</b> <br />
                
            <table>
                <tr><th>hbl</th><th>Cliente</th><th>No Reporte</th><th>Motivo</th></tr>
            <? 
            foreach($house as $h)
            {
            ?>
                <tr><td><?=$h->getCaHbls()?></td><td><?=$h->getCliente()->getCaCompania()?></td><td><?=$h->getReporte()->getCaConsecutivo()?></td>
                    <td><select>
                            <option value="1">ENTREGA TARDE ANTECEDENTES</option> 
                            <option value="2">CAMBIO HBL DESPUES DE HABER ENTERAGADO ANTECEDENTES</option>
                            <option value="3">CAMBIO DE PIEZAS O PESO HBL VS MBL DESPUES DE ENTREGADO</option>
                            <option value="4">CLIENTE SOLICITA CAMBIO DE DESCRIPCION DESPUES DE HABER ENTREGADO ANTECEDENTES</option>
                            <option value="5">REPORTE NO COINCEDE CON EL TIPO DE OPERACION DEL HBL DTA - OTM- D.A.</option>
                            <option value="6">ERROR DE SUMATORIA DE PZS HBL VS MBL</option>
                            <option value="7">ERROR EN FECHAS DE CORTE DE DOCUMENTOS</option>
                            <option value="8">SE MONTAN LOS DOCUMENTOS FINALES AL SISTEMA COLSYS CON ERRORES</option>
                            <option value="9">ERROR EN SUMATORIA DE PESO Y PZS DEL HBL REPARTIDOS EN VARIOS CONTENEDORES</option>
                            <option value="10">ERROR EN ASIGNACION DE REFERENCIA XA EL CASO</option>
                            <option value="11">CAMBIO DE REPORTES CON ALTERACIONES EN COSTOS Y /O DESCRIPCIONES ( VERSIONES )</option>
                        </select></td>
                </tr>
            <?
            }
            ?>
            </table>            
		</div></td>
    </tr>

	<tr>
		<td colspan="<?=(($contacts1!="")?"1":"2" )?>">
			<div align="left"><b>Mensaje</b><br>
                <textarea name="mensaje" style="width: 100%" rows="10" ><?=isset($message)?$message:""?></textarea>			
		</div></td>
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

        <br />         
        
        <input type="submit" value="Enviar" class="button" />
        <br />
        <br />
        </form>
    </div>