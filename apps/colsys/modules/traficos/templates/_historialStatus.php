<?
$statusList = $sf_data->getRaw("statusList");
foreach( $statusList as $status ){
	$txt = "<b>".Utils::fechaMes( $status->getCaFchenvio() )."&gt;&gt;". $status->getTrackingEtapa()->getCaEtapa()."</b>
	";
	if( $status->getCaIdemail() ){
		?>
		<a href='#' onClick='window.open("<?=url_for("email/verEmail?id=".$status->getCaIdemail())?>")' ><?=$txt?></a>
		<?			
	}else{
		echo $txt;
	}
	
	$statusTxt = $status->getStatus();					
	?>
	<br />
	<?=nl2br($status->getStatus())?>
	
	<br />
	<?
}
?>