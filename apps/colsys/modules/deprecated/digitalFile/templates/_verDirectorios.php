<?
use_helper("Javascript");
?>
<table width="90%" border="0">
	<tr>
		<th>Referencias</th>
	</tr>
	<?
	foreach( $referencias as $referencia ){
	?>
	
	<tr>
		<td class="mostrar"><?=link_to_remote($referencia->getCaReferencia(), array('update'   => 'panelArchivos',
																	'url'      => "digitalFile/verArchivos?referencia=".$referencia->getCaReferencia(),
																	'loading'  => visual_effect('appear', 'indicator'),
																	'complete' => visual_effect('fade', 'indicator'),
																	) )?></td>
	</tr>
	<?
	}
	?>
</table>
