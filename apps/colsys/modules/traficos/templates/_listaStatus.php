<?
$statusList = $sf_data->getRaw("statusList");
?>
<table style="border:gainsboro; border-collapse: collapse;" width="100%" cellspacing="0" border="1" class="tableList">
	<tr>
		<th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" colspan="<?=$linkEmail?3:2?>">Status del Embarque</th>
	</tr>
	<tr>
		<th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;" width="14%">Fecha</th>
		<th style="background-color: #F8F8F8; padding: 2px; font-weight: bold; font-size: 11px;font-family: Arial,Helvetica,sans-serif;"width="86%">Status</th>
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
        $style=($i==0)?"background-color: #FFFFE7; font-size: 13px;":"font-size: 11px;";
	?>
	<tr>
		<td valign="top" style="padding: 2px; font-family: Arial,Helvetica,sans-serif; <?=$style?>"><?=$i==0?"<b>":""?><?=$lstatus->getCaFchenvio()?><?=$i==0?"</b>":""?></td>
		<td valign="top" style="padding: 2px; font-family: Arial,Helvetica,sans-serif; <?=$style?>"><?=$i==0?"<b>":""?><?=html_entity_decode(Utils::replace($lstatus->getStatus()))?><?=$i==0?"</b>":""?></td>
		<?
		if( $linkEmail   ){
		?>
		<td valign="top"><?=$lstatus->getCaIdemail()?link_to(image_tag("22x22/email.gif"),"email/verEmail?id=".$lstatus->getCaIdemail()):"&nbsp;"?></td>
		<?
		}
		?>
	</tr>
	<?
		$i++;
	}
	?>
</table>