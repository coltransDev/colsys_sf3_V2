<?
foreach( $responses as $response ){
	echo "<b>".($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())."</b> ".$response->getCaCreatedAt("Y-m-d H:i A");
	?>
	<hr />	
	<?
	echo Utils::replace($response->getCaText());
	?>
	<br /><br /><br />
<?	
}
?>