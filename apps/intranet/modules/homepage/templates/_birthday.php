<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

if (count($usuarios)>0):
?>
 <h1 class="show"><span>Cumplea&ntilde;os</span></h1>
<?=image_tag("birthday/".date("d").".gif")?>                                        
<br />
<div class="jamod-content">
    <?
    $hoy=0;
    $manana=0;
    $pasado=0;
    $posterior=0;
    foreach ($usuarios as $usuario) {
        if (Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d')) {
            $day='HOY';
            if($hoy==0){
    ?>
            <br/><b>HOY</b><br/>
    <?
            $hoy=$hoy+1;
            }
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400)) {
            $day='MA&Ntilde;ANA';
            if($manana==0){
    ?>
            <br/><b>MA&Ntilde;ANA</b><br/>
    <?
            $manana=$manana+1;
            }
        }elseif(Utils::parseDate($usuario->getCaCumpleanos(), 'm-d')==date('m-d',time()+86400*2)) {
            $day='PASADO MA&Ntilde;ANA';
            if($pasado==0){
    ?>
            <br/><b>PASADO MA&Ntilde;ANA</b><br/>
    <?
            $pasado=$pasado+1;
            }
        }else {
            $day=Utils::parseDate($usuario->getCaCumpleanos(), 'M-d');
            if($posterior==0){
    ?>
            <br /><b><?echo $day;?></b><br/>
    <?
            $posterior=$posterior+1;
        	}
        }
    ?>
        <b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> <small><?=$usuario->getSucursal()->getEmpresa()->getCaNombre()?> - <?=$usuario->getSucursal()->getCaNombre()?></small><br />
    <?
    }endif;
    ?>
</div>