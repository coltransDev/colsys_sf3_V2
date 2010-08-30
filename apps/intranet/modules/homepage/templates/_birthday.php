<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

if (count($usuarios)>0):
?>


<h3 class="show"><span>CUMPLEA&Ntilde;OS</span></h3>
<div class="jamod-content">
    <p><?=image_tag("16x16/birthday.jpg")?> Deseamos que tus d&iacute;as esten llenos de paz y felicidad.</p>
    
    <?
    foreach ($usuarios as $usuario) {
        if (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d')) {
            $day='HOY';
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400)) {
            $day='MA&Ntilde;ANA';
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400*2)) {
            $day='PASADO MA&Ntilde;ANA';
        }else {
            $day=Utils::parseDate($usuario->getCaCumpleanos(), 'm-d');
        }
        ?>
    <p><b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> <?=$usuario->getCaIdsucursal().' '.$day?></p>

    <br/>
    <?} ?>


</div>
<? endif;?>

