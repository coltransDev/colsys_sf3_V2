<div align="center">

    <b>Desarrollador:</b> <?=$user->getCaNombre()?>

<?
$numtickets = count( $tickets );
$grupo = null;
$lastProject = null;
$project = null;

$hours = 0;

$festivos = Utils::getFestivos();
$fechaInicio = date("Y-m-d H:i:s");

for( $i =0 ; $i<$numtickets; $i++ ){
	$ticket = $tickets[$i];

	if( $ticket->getCaIdgroup()!=$grupo ){
		$grupo = $ticket->getCaIdgroup();
		$ticketsAbiertos = 0;
		$ticketsSinRespuesta = 0;
	?>
		<br />
		<br />

		<table width="95%" border="1" class="tableList" id="table-5">
		  <tr>
			<th width="76">Ticket # </th>
			<th width="223">Titulo</th>
			<th width="69">Usuario</th>
			<th width="72">Fecha</th>
			<th width="58">Tipo</th>
			<th width="110">Proyecto</th>			
			<th width="110">Asignado a</th>			
			<th width="95">Horas de trabajo</th>
            <th width="95">Porcentaje terminado</th>
            <?
            if($option!="view"){
            ?>
            <th width="110">Orden</th>
            <?
            }else{
            ?>
            <th width="110">Estimado de Entrega</th>
            <?
            }
            ?>
		  </tr>
		  <?
	}

	$class="";

	if($ticket->getCaAction()=="Abierto"){
		$ticketsAbiertos++;
	}


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


	if( $ticket->getHdeskProject()->getCaName() ){
		$project = $ticket->getHdeskProject()->getCaName();
	}else{
		$project = "";

	}


  ?>

  <tr class="<?=$class?>" id="row_<?=$ticket->getCaIdticket()?>">
    <td>
      <?
      if( $nivel!=0 || $userId==$ticket->getCaLogin() ){      
          echo link_to($ticket->getCaIdticket(),"helpdesk/verTicket?id=".$ticket->getCaIdticket());
      }else{
          echo $ticket->getCaIdticket();
      }
        ?></td>
    <td><?
      if( $nivel!=0 || $userId==$ticket->getCaLogin() ){
        echo link_to($ticket->getCaTitle(),"helpdesk/verTicket?id=".$ticket->getCaIdticket(), array("class"=>"qtip","title"=>str_replace("\"", "'", $ticket->getCaText())));
      }else{
        echo $ticket->getCaTitle();

      }
     ?>
    </td>

    <td><?=$ticket->getCaLogin()?></td>
    <td><?=Utils::fechaMes($ticket->getCaOpened("Y-m-d"))?></td>
    <td><?=$ticket->getCaType()?></td>


	<td>
	<?

	if(  $project  ){

		if( $nivel>0 ){
			echo link_to($project ,"helpdesk/listaTickets?opcion=personalizada&project=".$ticket->getHdeskProject()->getCaIdproject());
		}else{
			echo $project;
		}
	}else{
		echo "&nbsp;";
	}
	?>
	</td>

	
	<td>
		<?
		echo $ticket->getCaAssignedto();
		?>	</td>

    <?
    if($option!="view"){
    ?>
	<td>
        <input type="text" name="ticket_<?=$ticket->getCaIdticket()?>" id="ticket_<?=$ticket->getCaIdticket()?>" value="<?=$ticket->getCaEstimatedhours()?>" size="6" class="estimatedhoursfld" >
	</td>
    <td>
        <input type="text" name="percent_<?=$ticket->getCaIdticket()?>" id="percent_<?=$ticket->getCaIdticket()?>" value="<?=$ticket->getCaPercentage()?>" size="6" class="percentagefld" >
	</td>
    <td class="dragHandle" >&nbsp;</td>
    <?
    }else{
    ?>   
	<td>
        <?=$ticket->getCaEstimatedhours()?>
	</td>
     <td>
        <?=$ticket->getCaPercentage()?>%
	</td>
    <td>
    <?
    $hours = $ticket->getCaEstimatedhours()-floor($ticket->getCaEstimatedhours()*$ticket->getCaPercentage()/100);
    $fechaInicio =  date("Y-m-d H:i:s", Utils::addTimeWorkingHours( $festivos, $fechaInicio , $hours*3600 ) );
    ?>
        <div class="qtip" title="Este tiempo es estimado puede variar de acuerdo a .."><?=Utils::fechaMes($fechaInicio)?></div>
    </td>
    <?
    }
    ?>
  </tr>
	<?
	if( !isset($tickets[$i+1])||$tickets[$i+1]->getCaIdgroup()!=$grupo ){
	?>
</table>
<br />

<?
	}
?>
<?
}
?>
<br />
<br />

</div>

<script type="text/javascript">
<?
if($option!="view"){
?>
$('#table-5').tableDnD({
        onDrop: function(table, row) {
            //alert($('#table-5').tableDnDSerialize());

            /*
            var rows = table.tBodies[0].rows;

            var lastRow = null;

            for (var i=0; i<rows.length; i++) {
               if( rows[i].id == row.id){
                  alert(  lastRow+" "+row.id );
                  break;
               }
               lastRow = rows[i].id;
            }*/

            


        },
		onDragStart: function(table, row) {
			//alert($('#table-5').tableDnDSerialize());
		}
        ,
        onDragClass: "myDragClass",

        dragHandle: "dragHandle"
    });
<?
}
?>

function save(){      

   <?
   if($option!="view"){
   ?>
    var result  = {};    

    var elements = document.getElementsByClass("estimatedhoursfld");


    for(var i=0; i<elements.length; i++ ){
        target = elements[i];
        result[ "hours_"+target.name.substr(7) ] = target.value;
    }


    var elements = document.getElementsByClass("percentagefld");
     for(var i=0; i<elements.length; i++ ){
        target = elements[i];
        result[ "percentage_"+target.name.substr(8) ] = target.value;
    }


    Ext.Ajax.request(
    {
        waitMsg: 'Guardando cambios...',
        url: '<?=url_for("helpdesk/guardarListPrioridades")?>?'+$('#table-5').tableDnDSerialize(),



        //method: 'POST',
        //Solamente se envian los cambios
        params : result,

        callback :function(options, success, response){

        }


    });
    <?
    }
    ?>
}

</script>

