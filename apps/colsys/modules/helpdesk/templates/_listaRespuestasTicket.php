<?
foreach( $responses as $response ){
	echo "<b>".($response->getUsuario()?$response->getUsuario()->getCaNombre():$response->getCaLogin())."</b> ".Utils::fechaMes($response->getCaCreatedat());
	?>
	<hr />	
	<?
	echo Utils::replace($response->getCaText());
	?>
	<br /><br /><br />
<?	
}
?>