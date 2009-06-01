<?
foreach( $responses as $response ){
	echo "<b>".($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())."</b> ".Utils::fechaMes($response->getCaCreatedAt("Y-m-d"))." ".$response->getCaCreatedAt("H:i:s");		
	?>
	<hr />	
	<?
	echo Utils::replace($response->getCaText());
	?>
	<br /><br /><br />
<?	
}
?>