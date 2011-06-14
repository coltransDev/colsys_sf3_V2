<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */
?>
<b> 
 &nbsp;&nbsp;Ofertar $
<?
echo Utils::formatNumber( $valor );
?>
</b>
<br />
<br />
<?
foreach( $ofertas as $oferta ){
    
    if( $user->getUserId()==$articulo->getCaUsucreado() ){
        echo $oferta->getCaUsucreado()." ";
    }
    echo Utils::fechaMes($oferta->getCaFchcreado())." <b>".Utils::formatNumber($oferta->getCaValor())."</b><br />";    
}
?>