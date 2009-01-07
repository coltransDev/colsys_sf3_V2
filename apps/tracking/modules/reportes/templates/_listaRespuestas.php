<?
foreach( $respuestas as $respuesta ){

?>	
	<div class="response_status"> 
	<?=Utils::replace($respuesta->getCaRespuesta())?>
	</div>
	
<?
}
?>