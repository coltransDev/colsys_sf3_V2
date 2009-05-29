<div align="center">
<?
$numtickets = count( $tickets );
$grupo = null;
for( $i =0 ; $i<$numtickets; $i++ ){
	$ticket = $tickets[$i];
	
	if( $ticket->getCaIdgroup()!=$grupo ){ 	
		$grupo = $ticket->getCaIdgroup();
			 
	?>
<br />
<br />

<table width="95%" border="1" class="tableList">
  <tr>
    <th colspan="10"><?=$ticket->getHdeskGroup()->getCaName()?></th>
    </tr>    
  <tr>
    <th width="76">Ticket # </th>
    <th width="223">Titulo</th>
    <th width="69">Usuario</th>
    <th width="72">Fecha</th>
    <th width="58">Tipo</th>
	<th width="58">Proyecto</th>
	<th width="110">Prioridad</th>
	<th width="110">Asignado a</th>
    <th width="132">Fecha Respuesta </th>
    <th width="88">Estado</th>
  </tr>    
  <?
	}
  	
	$class="";
  	if($ticket->getCaAction()!="Abierto"){
	  	$class="blue";
	}else{
		if( $ticket->getCaPriority()=="Media"){
			$class="yellow";
		}
		
		if( $ticket->getCaPriority()=="Alta"){
			$class="pink";
		}
	}
  ?>
  <tr class="<?=$class?>">
    <td><?=link_to($ticket->getCaIdticket(),"helpdesk/verTicket?id=".$ticket->getCaIdticket())?></td>
    <td><?=link_to($ticket->getCaTitle(),"helpdesk/verTicket?id=".$ticket->getCaIdticket())?></td>
    <td><?=$ticket->getCaLogin()?></td>
    <td><?=$ticket->getCaOpened("Y-m-d")?></td>
    <td><?=$ticket->getCaType()?></td>
	<td>
		<?
		if( $ticket->getHdeskProject() ){
			$project = $ticket->getHdeskProject()->getCaName();
			if( $nivel>0 ){
				echo link_to($project ,"helpdesk/listaTickets?opcion=personalizada&project=".$ticket->getHdeskProject()->getCaIdproject());
			}else{
				echo $project;
			}
		}else{
			echo "&nbsp;";
		}
		
		?></td>
	<td><?=$ticket->getCaPriority()?></td>
	<td>
		<?	
		echo $ticket->getCaAssignedto();
		?>
	</td>
    <td>
		<?
		$tarea = $ticket->getNotTarea(); 
		if( $tarea ){
			echo $tarea->getCaFchterminada(  );	
		
		}else{
			echo "&nbsp;";
		}	
		//$ticket->getCaResponsetime("Y-m-d h:i A")
		?></td>
    <td><?=$ticket->getCaAction()?> <?=$nivel>0&&$ticket->getCaAction()=="Abierto"?link_to("Cerrar","helpdesk/cerrarTicket?id=".$ticket->getCaidticket() ):""?></td>
  </tr> 
	<?
	if( !isset($tickets[$i+1])||$tickets[$i+1]->getCaIdgroup()!=$grupo ){ 
	?>
</table>
<?
	}
?>
<?
}
?>
<br />
<br />

</div>