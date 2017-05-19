<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

$url = "https://www.colsys.com.co".url_for("/survey/formEvaluacion?idevaluacion=".$evaluacion->getCaIdevaluacion());
$ticket = $sf_data->getRaw("ticket");
?>

Apreciado Usuario,


<?
if( $ticket ){
?>
<br />
<br />
Nuestros registros muestran que recientemente un ticket suyo fue cerrado.
<br />
<br />
Por favor tome unos minutos para contarnos su experiencia.
<br />
<br />

<b>Para acceder a la encuesta personalizada por favor haga click en el siguiente link:</b>

<br />
<br />

<a href="<?=$url?>"><?=$url?></a>



<br />
<br />
<b>Ticket:</b>

<br />
#<?=$ticket->getCaIdticket()." ".$ticket->getCaTitle()?>

<br />
<br />
<b>Contenido:</b>
<br />

<?=$ticket->getCaText()?>


<?
}else{
?>
<br />
<br />
Nuestros registros muestran que usted recientemente una encuesta para responder.
<br />
<br />
Por favor tome unos minutos para contarnos su experiencia.
<br />
<br />

<b>Para acceder a la encuesta personalizada por favor haga click en el siguiente link:</b>

<br />


<a href="<?=$url?>"><?=$url?></a>
<?
}
?>



<br />
<br />

<br />
<br />
Sus respuestas son muy importantes para mejorar nuestros servicios.
<br />
<br />

<?
if( $ticket ){
?>
Cordialmente,
<br />
<br />
<?
$group = $ticket->getHdeskGroup();
echo  $group->getDepartamento()->getCaNombre();
}
?>




