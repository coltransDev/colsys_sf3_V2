<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">
#bubble2 {
	list-style: none;
	margin: 20px 0px 0px;
	padding: 0px;
}
#bubble2 li {
	display: inline-block;
	margin: 0px 40px;
	padding: 0px;
	width: 72px;
	height: 72px;
}

#bubble2 li a img {
	position: relative;
	border: none;
}

#bubble2 li a img.large {
	display: none;
}

#bubble2 li a:hover img.small {
	display: none;
	z-index: 0;
}

#bubble2 li a:hover img.large {
	display: block;
	margin-top: -28px;
	margin-left: -28px;
	z-index: 1000;
}


</style>

<?
    if($nivel>=1){
?>

    <div class="storybox" align="center">
    <div class="box1"><b>ESTADISTICAS DPTO. MARITIMO</b></div>
    <div class="body" align="center">
   
<?
    $url = "/images/64x64/informe.png";
    $url2 = "/images/64x64/informe_large.png";
    
?>    
    
    <ul id="bubble2" align="center">
<?
    if($nivel>=2){
?>     
      <li> 
          <a href="<?=url_for("reportesGer/estadisticasMaritimo")?>" title="Estadisticas Gerenciales Marítimo">
        	<img class="small" src="<?=$url?>"/>
        	<img class="large" src="<?=$url2?>"/>
            <span style="color: blue" align="center">Estad&iacute;sticas Mar&iacute;timo</span>
        </a> 
      </li>
<?
    }
    if($nivel==1 or $nivel==3){
?>
      <li> 
          <a href="<?=url_for("reportesGer/impresionbl")?>" title="Genera informe de los BL's impresos en destino por Sucursal,<br/>Agente">
        	<img class="small" src="<?=$url?>"/>
        	<img class="large" src="<?=$url2?>"/>
            <span style="font-size: 20; color: blue">Impresion BL's en destino</span>
        </a> 
      </li>
<?
    }
?>
    </ul>    

    </div>
</div>
<?
    }
?>