<table width="100%" cellspacing="0" border="1" class="tableList">
	<tr>
		<th colspan="<?=$linkEmail?3:2?>">Status del Embarque</th>
	</tr>
	<tr>
		<th width="14%">Fecha</th>
		<th width="86%">Status</th>
		<?
		if( $linkEmail   ){
		?>
		<th >Email</th>	
		<?
		}
		?>
	</tr>				
	<?
	$i=0;
	
	
	foreach( $statusList as $lstatus ){ 
	?>
	<tr>
		<td valign="top"><?=$i==0?"<b>":""?><?=$lstatus->getCaFchenvio()?><?=$i==0?"</b>":""?></td>
		<td valign="top"><?=$i==0?"<b>":""?><?=Utils::replace($lstatus->getStatus())?><?=$i==0?"</b>":""?></td>
		<?
		if( $linkEmail   ){
		?>
		<td valign="top"><?=$lstatus->getCaIdemail()?link_to(image_tag("22x22/email.gif"),"general/verEmail?id=".$lstatus->getCaIdemail()):"&nbsp;"?></td>
		<?
		}
		?>
	</tr>
	<?
		$i++;
	}
	?>
</table>