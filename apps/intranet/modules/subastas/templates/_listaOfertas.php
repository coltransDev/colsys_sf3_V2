<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<b> 
Ofertar $
<?
echo Utils::formatNumber($valor + $articulo->getCaIncremento());
?>
</b>
<br />
<?
foreach( $ofertas as $oferta ){
    echo Utils::fechaMes($oferta->getCaFchcreado())." ".Utils::formatNumber($oferta->getCaValor())."<br />";    
}
?>