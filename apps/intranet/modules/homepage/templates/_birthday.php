<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

if (count($usuarios)>0):
?>
<script language="Javascript" type="text/javascript">
		mis_imagenes = new Array("https://localhost/intranet/images/birthday/birthday1.gif","https://localhost/intranet/images/birthday/birthday1.gif","https://localhost/intranet/images/birthday/birthday3.gif")
		mi_imagen = 0
		imgCt = mis_imagenes.length
		function rotacion() {
			if (document.images) {
				mi_imagen++
				if (mi_imagen == imgCt) {
					mi_imagen = 0
				}
				document.anuncio.src=mis_imagenes[mi_imagen]
				setTimeout("rotacion()", 5 * 1000)
			}
		}
</script>    
		
<h1 class="show"><span>CUMPLEA&Ntilde;OS</span></h1><br />
<div>
	<tr>
	    <td width="150" align="center">
	    	<?=image_tag("birthday/birthday1.gif")?>
	    </td>
    </tr>
	<br />
</div>
 
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
        <b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=$usuario->getCaNombre()?></a></b> <small><?=$usuario->getSucursal()->getCa_Nombre()?></small><br />
    <?
    }endif;
    ?>
</div>