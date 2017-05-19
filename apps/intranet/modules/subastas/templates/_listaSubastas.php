<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
if (count($articulos)>0){
    ?>
    <br />
    <div class="storybox">
        <div class="title"><span>Ultimas subastas</span></div>
        <div class="body">
        <?
        foreach ($articulos as $articulo) {            
            ?>
               <a href="<?=url_for('subastas/verArticulo?idarticulo='.$articulo->getCaIdarticulo()) ?>"><?=$articulo->getCaTitulo()?></a> <br />
            <?
        }
        ?>
           <a href="<?=url_for('subastas/index') ?>"><b>Ver mas</b></a> <br />
        </div>
    </div>
<?
}
?>