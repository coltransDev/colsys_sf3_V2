<?
foreach( $statusList as $status ){
	$txt = "<b>".Utils::fechaMes( $status->getCaFchenvio("Y-m-d") )." ".$status->getCaFchenvio("h:i A" )."&gt;&gt;". $status->getTrackingEtapa()->getCaEtapa()."</b>
	";
	if( $status->getCaIdemail() ){
		?>
		<a href='#' onClick='window.open("<?=url_for("general/verEmail?id=".$status->getCaIdemail())?>")' ><?=$txt?></a>	
		<?			
	}else{
		echo $txt;
	}
	
	$statusTxt = $status->getStatus();					
	?>
	<br />
	<?=$status->getStatus()?> 
	
	<br />
	<?
}
?>