<?
use_helper("ExtCalendar");
?>
<form action="<?=url_for("helpdesk/nuevoSeguimiento?id=".$ticket->getCaIdticket())?>" method="post">
<div class="content" align="center">
	<table width="400" border="1" class="tableList">
	<tr>
		<th scope="col">Seguimiento Ticket # <?=$ticket->getCaIdticket()." ".$ticket->getCaTitle() ?></th>
	</tr>
	<tr>
		<td align="center">
			<?
			$tarea = $ticket->getTareaSeguimiento();	
			echo extDatePicker("seguimiento", ($tarea?$tarea->getCaFchvencimiento("Y-m-d"):""));
				
			?></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="Guardar"></td>
	</tr>
</table>
</div>
</form>