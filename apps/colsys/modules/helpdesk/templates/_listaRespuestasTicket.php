<?
$responses = $sf_data->getRaw("responses");
foreach( $responses as $response ){
	echo "<b>".($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())."</b> ".Utils::fechaMes($response->getCaCreatedat());
	?>
	<hr />	
	<?
	echo str_replace("\n", "<br />",$response->getCaText());
	?>
	<br /><br /><br />
<?	
}
?>