<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?
if($key){
?>
<div class="content" align="center">

    <div class="box1" style="width:550px" align="center">

        <h1>No se puede crear el usuario</h1>
        El login ya ha sido usuado. Por favor intente crear el usuario con un login diferente.
        <br />
    </div>
</div>
<?}else{?>
<div class="content" align="center">

    <div class="box1" style="width:550px" align="center">

        <h1>Acceso denegado</h1>
        Usted no posee permisos


    </div>
</div>
<? } ?>

