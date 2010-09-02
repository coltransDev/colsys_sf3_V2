<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

if (count($usuarios)>0):
?>


<h3 class="show"><span>CUMPLEA&Ntilde;OS</span></h3>
<tr>
    <td width="100">
        <img src="http://gfx.glittergraphicsnow.com/albums/ll149/glittergn/flower/flower022.gif" border="0" alt="Mariposas" width="100" />
    <td>
 </tr>
 
<div class="jamod-content">
    
    <?
    $cont=0;
    foreach ($usuarios as $usuario) {
        if (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d')) {
            $day='HOY';
    ?>
            <b>HOY</b><br/>
    <?
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400)) {
            $day='MA&Ntilde;ANA';
            if($cont==0){
    ?>
            <br/><b>MA&Ntilde;ANA</b><br/>
    <?
            $cont=$cont+1;
            }
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400*2)) {
            $day='PASADO MA&Ntilde;ANA';
        }else {
            $day=Utils::parseDate($usuario->getCaCumpleanos(), 'm-d');
        }
    ?>
        <b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b><br/>
    <?
    }endif;
    ?>
   
</div>
