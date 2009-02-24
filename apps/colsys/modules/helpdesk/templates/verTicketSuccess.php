<?
$grupo = $ticket->getHdeskGroup();
$proyecto = $ticket->getHdeskProject();
?>

<script language="javascript">
	function comentar(  ){		
		document.getElementById( "coment_status_txt" ).style.display = "inline";
		document.getElementById( "coment_status" ).style.display = "none";
	}
	function cancelar_comentar(  ){
		document.getElementById( "coment_status" ).style.display = "inline";
		document.getElementById( "coment_status_txt" ).style.display = "none";
	}
	
	function guardar_comentario(  idticket ){
		cancelar_comentar(  );
		
		var txt = document.getElementById( "coment_status_field" ).value;
		document.getElementById( "coment_status_field" ).value="";
		Ext.Ajax.request( 
			{   
				waitMsg: 'Guardando...',						
				url: '<?=url_for("helpdesk/guardarRespuestaTicket")?>', 														
				params : {
					idticket: idticket,					
					comentario: txt
				},
										
				callback :function(options, success, response){	
					document.getElementById("coments").innerHTML = response.responseText; 
				}	
			 }
		); 				
		
	}
		
</script>


<div align="left" style="margin-left:30px;margin-right:30px;">


<h1>Ticket # <?=$ticket->getCaIdTicket()?></h1>
<br>





<table width="80%"  border="0" class="tableList">
  <tr>
    <th colspan="2" scope="col">&nbsp;<b><?=Utils::replace($ticket->getCaTitle())?></b></th>
  </tr>
  
  <tr>
    <td width="50%" class="listar"><b>Reportado por:</b> <?=$ticket->getCaLogin()?></td>
    <td width="50%" class="listar"><b>Abierto </b> <?=$ticket->getCaOpened("Y-m-d H:i A")?> </td>
  </tr>  
 
   <tr>
    <td class="listar"><b>Departamento:</b>
		<?
		if( $grupo ){
			$departamento = $grupo->getDepartamento();
			echo Utils::replace($departamento->getCaNombre()); 
		}
		?>
	</td>
    <td class="listar"><b>Area: </b>  
		<?
		if( $grupo ){
			echo Utils::replace($grupo->getCaName());
		}
		?>
	</td>
  </tr>
  
  <tr>
  	<td class="listar">
		<b>Proyecto: </b>
		<?
		if( $proyecto ){
			
			echo Utils::replace($proyecto->getCaName()); 
		}
		?>
	</td>
  	<td class="listar">&nbsp;</td>
  </tr>
   <tr>
    <td class="listar">
		<b>Prioridad: </b> 
		<?=$ticket->getcaPriority()?>
	</td>
    <td class="listar">
		<b>Asignado a:</b> 
		<?
		
		if( $ticket->getCaAssignedTo() ){
			echo $ticket->getCaAssignedTo();
		}else{
			if( $nivel>0 && $ticket->getCaAction()=="Abierto" ){
				echo link_to("Tomar asignaci&oacute;n" , "helpdesk/tomarAsignacion?id=".$ticket->getCaIdticket() );
			}
		}
		
		?>
	</td>
  </tr>
  <tr>
    <td class="listar">
		<b>Tipo: </b>
		<?=$ticket->getCaType()?>
	</td>
    <td class="listar">
		<b>Estado: 	</b>
		<?=$ticket->getCaAction()?>
	</td>
  </tr>
  <tr>
    <td class="listar" colspan="2"><b>Descripci&oacute;n</b></td>
  </tr>
  <tr>
    <td colspan="2" class="listar">		
	
	<div class="boxText">
	
	<?=$ticket->getCaText()?>
	</div>
	</td>
    </tr>	
</table>

<br>

<table width="80%"  border="0" class="tableList">
  <tr>
    <th  scope="col"><b> Respuestas</b></th>
  </tr>
  
  <tr>
   
    <td width="86%" class="listar">
		<div class="boxText">
			<div id="coments">
			<?			
			include_component("helpdesk", "listaRespuestasTicket", array("idticket"=>$ticket->getCaIdticket()) );
			?>			  
			</div>
			 <div class="story_coment" id="coment_status_txt" style="display:none" >
				<textarea rows="1" cols="180" id="coment_status_field" onkeyup="autoGrow(this)" onfocus="autoGrow(this)"></textarea>
				<br />
				
				<b><a onclick="guardar_comentario( <?=$ticket->getCaIdticket()?> )"><?=image_tag("16x16/button_ok.gif")?> Guardar</b></a> <b><a onclick="cancelar_comentar()"> <?=image_tag("16x16/button_cancel.gif")?> Cancelar</a></b>
			</div>	
			<div class="story_coment" id="coment_status" onclick="comentar()">
				<b> <?=image_tag("16x16/edit_add.gif")?> Respuesta</b>
			</div>	
			  
		</div>	  </td>
  </tr> 
</table>



<br>
<!--<table width="80%"  border="0" class="tableList">
  <tr>
    <th colspan="2" scope="col"><b>Adjuntos</b></th>
  </tr>
  <tr>
    <td width="50%" class="listar">&nbsp;</td>
    <td width="50%" class="listar">&nbsp;</td>
  </tr> 
</table>-->
</div>



