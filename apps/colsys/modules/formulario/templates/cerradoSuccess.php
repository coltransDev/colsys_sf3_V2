<div class="formulario-cabecera">
    <? if ($formulario->ca_empresa == 1) { ?>
        <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Colmas SA" />    
    <? } else { ?>
        <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
    <? } ?>
</div>
<div class="resultado">
    <h1>Estimado cliente</h1>
    <br>
    <br>
    <br>
    <p class="align-center">La recolecci�n de datos para �sta encuesta ya fue cerrada.</p>
    <br>
    <br>
    <p class="align-center"><b>Muchas Gracias!!!</b></p>
    <br>
    <br>
    <? if ($formulario->ca_empresa == 1) { ?>
        <p class="align-center">Puede continuar visitando nuestro sitio web  <a href="http://www.colmas.com.co/" target="_BLANK">COLMAS LTDA.</a></p>    
    <? } else { ?>
        <p class="align-center">Puede continuar visitando nuestro sitio web  <a href="http://www.coltrans.com.co/" target="_BLANK">COLTRANS S.A.S</a></p>
    <? } ?>   
    <? if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_notice">
            <? echo $sf_user->getFlash('notice') ?> 
        </div>
    <? endif; ?>
</div>





