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
    <th colspan="7"><?=$ticket->getHdeskGroup()->getCaName()?></th>
    </tr>    
  <tr>
    <th width="86">Ticket # </th>
    <th width="273">Titulo</th>
    <th width="93">Usuario</th>
    <th width="77">Fecha</th>
    <th width="73">Tipo</th>
	<th width="126">Asignado a</th>
    <th width="120">Estado</th>
  </tr>    
  <?
  }
  ?>
  <tr class="<?=$ticket->getCaAction()!="Abierto"?"blue":""?>">
    <td><?=link_to($ticket->getCaIdticket(),"helpdesk/verTicket?id=".$ticket->getCaIdticket())?></td>
    <td><?=link_to($ticket->getCaTitle(),"helpdesk/verTicket?id=".$ticket->getCaIdticket())?></td>
    <td><?=$ticket->getCaLogin()?></td>
    <td><?=$ticket->getCaOpened("Y-m-d")?></td>
    <td><?=$ticket->getCaType()?></td>
	<td><?=$ticket->getCaAssignedto()?></td>
    <td><?=$ticket->getCaAction()?></td>
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