<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

  
    
?>


<div align="center" class="yellowbox">
    No es posible editar este articulo <br />
    <?
    $url = "subastas/verArticulo?idarticulo=".$articulo->getCaIdarticulo();
    ?>
    <input type="button" class="button" value="Volver" onClick="document.location.href='<?=url_for($url)?>'" />   
</div>
