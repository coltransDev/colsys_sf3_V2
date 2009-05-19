<h1>Novedades del sistema Colsys</h1>
<?
foreach( $novedades as $novedad ){
?>			
	<br /><br />
	<?=image_tag("16x16/post.gif")?><b><?=$novedad->getCaFchpublicacion("Y-m-d")?> <?=$novedad->getCaAsunto()?></b>
	<br />
	<hr />
	<div class="story">
	<?=nl2br($novedad->getCaDetalle())?>
	</div>
<?	
}
?>
		