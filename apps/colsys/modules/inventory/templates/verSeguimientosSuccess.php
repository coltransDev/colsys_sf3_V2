<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */


?>

<div class="commentlist">
<?

$seguimientos = $sf_data->getRaw("seguimientos");
$i=0;
foreach( $seguimientos as $seguimiento ){
    ?>
        <div class="entry-<?=$i++%2==0?"even":"odd"?>">
        <div class="entry-date"><?=Utils::fechaMes($seguimiento->getCaFchcreado())?></div>
        <b><?=($seguimiento->getUsuario()?$seguimiento->getUsuario()->getCaNombre():$seguimiento->getCaUsucreado())?></b>


        <br /><br />
        <?=str_replace("\n","<br />",$seguimiento->getCaText())?>

    </div>
    <?
}
?>
</div>