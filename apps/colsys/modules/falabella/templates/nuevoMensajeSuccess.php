<?
use_helper("Validation");
?>
<form action="<?=url_for('bavaria/enviarEmail')?>">
<?
include_component( "general", "formEmail", array("subject"=>"Correo Notificacion de Embarque Bavaria", "message"=>"Se�ores Bavaria, cordial saludo:\n\nSirvase encontrar adjunto las notificaciones de embarque al d�a de corte:".date("Y-m-d")."\n\nAtentamente:\n\nCOLTRANS S.A." ) )
?>
<br />
<input type="submit" value="Enviar Mensaje">
<input type="reset" value="Cancelar Envio">
</form>