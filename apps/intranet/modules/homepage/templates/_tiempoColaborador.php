<?php

/*
 * Informa los Colaboradores que han cumplido 5,10,20,25,30 años laborando en la compañía
@autor: alramirez
*/
if(count($usuarios)>0){  
?>
<br />
<div class="storybox">
    <div class="title"><span>Reconocimiento Especial</span></div>
    <div class="body">
<?
    foreach($usuarios as $usuario){        
        list($ano,$mes,$dia) = explode("-",$usuario->getCaFchingreso());
        $tiempoCumplido = date("Y") - $ano;
?>
        <a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a> <small><?=$usuario->getSucursal()->getEmpresa()->getCaNombre()?> <b><?=$tiempoCumplido?> a&ntilde;os</b> en la compania.</small><br/>
<?
    }
?>
    </div>
</div>
<?
}
?>