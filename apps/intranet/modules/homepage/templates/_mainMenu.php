<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

?>
<h1>Menu principal</h1>
<ul class="menu">
    <li id="current" class="active item1"><a href="/intranet"><span>Inicio</span></a></li>
    <li id="current" class="active item1"><a href="<?=url_for('adminUsers/mainUsers')?>"><span>Colaboradores</span></a></li>
    <li id="current" class="active item1"><a href="<?=url_for('adminUsers/phoneBook')?>"><span>Directorio Telefónico</span></a></li>
<!--    <li id="current" class="active item1"><a href="<?=url_for('subastas/index')?>"><span>Subastas</span></a></li>-->
</ul>
