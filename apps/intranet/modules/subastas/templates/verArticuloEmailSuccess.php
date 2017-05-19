<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>

<?=$mensaje?>

<br />
<br />


<a class="maintitle"><b><?= $articulo->getCaTitulo() ?></b></a>
<br />




<div class="box1">
    <div class="title"><b>Descripción:</b></div>  
    <div class="body">
<?=nl2br($articulo->getCaDescripcion()) ?>    
    </div>
</div>
<br />
<div class="box1">    
    <div class="title"><b>Forma de Pago:</b></div>

    <div class="body">
<?= $articulo->getCaFormapago() ?>    
    </div>
</div>    

<?
if ($articulo->getCaUsucomprador()) {
    $usuario = $articulo->getUsuComprador();
?>    
<div class="box1">    
    <div class="title"><b>Detalles de Contacto:</b></div>

    <div class="body">
        <b>Valor venta</b> <?=Utils::formatNumber($articulo->getCaValorventa())?><br /> 
    <?= $usuario->getCaNombre() ?> <br />   
    <?= $usuario->getCaExtension() ?> <br />   
    <?= $usuario->getCaEmail() ?> <br />   
    </div>
</div>
<?
}
?>

