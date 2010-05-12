<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
foreach ($usuarios as $usuario) {

    ?>
<p><b><a href="<?=url_for('users/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> </p>

<br/>
    <?}
?>
