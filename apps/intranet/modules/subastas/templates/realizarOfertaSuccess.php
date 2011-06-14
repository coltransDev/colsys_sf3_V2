<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

if( $articulo->getcaDirecta() || $articulo->getCaUsucomprador() ){
?>
    Felicitaciones!, usted ha adquirido este producto.
<?
}else{
?>
    <input type="button" value="Realizar una oferta" onclick="ofertar()" /> 
    <?
    include_component("subastas", "listaOfertas", array("articulo"=>$articulo));
    ?>
<?
}
?>

