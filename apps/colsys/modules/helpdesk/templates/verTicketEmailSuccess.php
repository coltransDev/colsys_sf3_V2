<?
$grupo = $ticket->getHdeskGroup();
$proyecto = $ticket->getHdeskProject();
?>


<h3>Ticket # <?=$ticket->getCaIdTicket()?></h3>

<br>



Por favor siga el siguiente Link: 
<br /><br />
<a href="https://www.coltrans.com.co<?=url_for("helpdesk/verTicket?id=".$ticket->getcaIdticket())?>">https://www.coltrans.com.co<?=url_for("helpdesk/verTicket?id=".$ticket->getcaIdticket())?></a>
<br />
<br />
Vista previa
<br />
<br />

<table width="80%"  border="1" class="tableList" style="border-collapse:collapse;" cellspacing="0">
  <tr>
    <th colspan="2" scope="col">&nbsp;<b><?=Utils::replace($ticket->getCaTitle())?></b></th>
  </tr>
  
 <tr>
    <td width="50%" class="listar"><b>Reportado por:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getCaNombre():$ticket->getCaLogin()?></td>
    <td width="50%" class="listar"><b>Abierto </b> <?=Utils::fechaMes($ticket->getCaOpened("Y-m-d"))." ".$ticket->getCaOpened("H:i:s");	?> </td>
	</tr>
	<tr>
    <td width="50%" class="listar"><b>Contacto:</b> <?=$ticket->getUsuario()?$ticket->getUsuario()->getSucursal()->getCaNombre()." ".$ticket->getUsuario()->getCaExtension():"&nbsp;"?></td>
    <td width="50%" class="listar">&nbsp; </td>
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
			$asignado = $ticket->getAssignedUser();
			if( $asignado ){
				echo $asignado->getCaNombre();
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
			
			<?			
			include_component("helpdesk", "listaRespuestasTicket", array("idticket"=>$ticket->getCaIdticket()) );
			?>	
			</div>		  
			  </td>
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



