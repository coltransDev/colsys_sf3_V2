<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
$user = $sf_data->getRaw("user")
?>
<div >
    <?=$user->getCaNombres()." ".$user->getCaApellidos()?> - <?=$user->getCaCargoweb()?>
    <hr />
    <br />
    <?=$user->getCaHojaVida()?>
    <br />
    <?=link_to("Volver", "homepage/index")?>
</div>