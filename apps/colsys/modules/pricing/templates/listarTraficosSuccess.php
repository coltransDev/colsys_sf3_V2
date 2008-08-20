
<table class="tableList" width="500">
  <tr>
  	<th>C&oacute;digo</th>
    <th>Trafico</th>
    
  </tr>
  	<?
  	$i=0;
	foreach( $traficos as $trafico ){			
	?>
  <tr class="row<?=$i++%2?> ?>">    
    <td><?=$trafico->getCaidtrafico() ?></td>
    <td><?=link_to($trafico->getCanombre(), "pricing/detallesTrafico?id_trafico=".$trafico->getCaidtrafico())?></td>
  </tr>
  <?
	}
  ?>
</table>

